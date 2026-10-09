<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MateriController extends Controller
{
    public function index()
    {
        /** @var User|null $user */
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        if ($user->role !== 'mahasiswa') {
            return redirect()->route('dosen.dashboard');
        }

        $kelas = $user
            ->kelasDiikuti()
            ->with('pembuat')
            ->first();

        if (!$kelas) {
            return redirect()
                ->route('mahasiswa.dashboard')
                ->withErrors([
                    'kelas' => 'Silakan bergabung ke kelas terlebih dahulu.',
                ]);
        }

        $totalSubbab = 6;
        $subbabSelesai = $this->normalizeCompletedLevel(
            (int) ($kelas->pivot->subbab_selesai ?? 0),
            $totalSubbab
        );

        $unlockedLevel = $subbabSelesai >= $totalSubbab
            ? $totalSubbab
            : $subbabSelesai + 1;

        $progress = round(($subbabSelesai / $totalSubbab) * 100);
        $materi = $this->materiData();

        return view(
            'mahasiswa.materi.index',
            compact(
                'kelas',
                'materi',
                'subbabSelesai',
                'totalSubbab',
                'unlockedLevel',
                'progress'
            )
        );
    }

    public function show(int $level)
    {
        return redirect()->route(
            'mahasiswa.materi.page',
            [
                'level' => $level,
                'page' => 1,
            ]
        );
    }

    public function page(int $level, int $page)
    {
        [$user, $kelas, $subbabSelesai, $unlockedLevel] =
            $this->studentContext();

        $this->ensureLevelExists($level);
        $this->ensureLevelUnlocked($level, $unlockedLevel);

        $semuaMateri = $this->materiData();
        $materi = $semuaMateri[$level];
        $pages = $materi['pages'];
        $totalPages = count($pages);

        if ($page < 1 || $page > $totalPages) {
            abort(404);
        }

        $levelSelesai = $level <= $subbabSelesai;
        $accessiblePages = $this->accessiblePages(
            $pages,
            $user->id,
            $kelas->id,
            $level,
            $levelSelesai
        );

        if (!in_array($page, $accessiblePages, true)) {
            $lastAccessible = max($accessiblePages);

            return redirect()
                ->route(
                    'mahasiswa.materi.page',
                    [
                        'level' => $level,
                        'page' => $lastAccessible,
                    ]
                )
                ->with(
                    'error',
                    'Jawab checkpoint pada halaman sebelumnya dengan benar sebelum melanjutkan.'
                );
        }

        $halaman = $pages[$page];
        $pageProgress = round(($page / $totalPages) * 100);
        $totalSubbab = 6;
        $overallProgress = round(($subbabSelesai / $totalSubbab) * 100);

        return view(
            'mahasiswa.materi.show',
            compact(
                'user',
                'kelas',
                'materi',
                'halaman',
                'level',
                'page',
                'totalPages',
                'pageProgress',
                'subbabSelesai',
                'totalSubbab',
                'overallProgress',
                'accessiblePages',
                'levelSelesai'
            )
        );
    }

    public function checkpoint(Request $request, int $level, int $page)
    {
        [$user, $kelas, $subbabSelesai, $unlockedLevel] =
            $this->studentContext();

        $this->ensureLevelExists($level);
        $this->ensureLevelUnlocked($level, $unlockedLevel);

        $semuaMateri = $this->materiData();
        $materi = $semuaMateri[$level];
        $pages = $materi['pages'];

        if (!isset($pages[$page])) {
            abort(404);
        }

        $halaman = $pages[$page];

        if (
            ($halaman['type'] ?? 'content') !== 'content' ||
            empty($halaman['checkpoint'])
        ) {
            return redirect()->route(
                'mahasiswa.materi.page',
                [
                    'level' => $level,
                    'page' => $page,
                ]
            );
        }

        $validated = $request->validate([
            'answer' => ['required', 'string', 'max:5'],
        ]);

        $answer = strtoupper($validated['answer']);
        $correct = strtoupper($halaman['checkpoint']['answer']);

        if ($answer !== $correct) {
            return back()
                ->withInput()
                ->with('checkpoint_wrong', true)
                ->with(
                    'checkpoint_feedback',
                    'Jawaban belum tepat. Pelajari kembali penjelasan, contoh, dan catatan pada halaman ini, lalu coba lagi.'
                );
        }

        session()->put(
            $this->checkpointKey(
                $user->id,
                $kelas->id,
                $level,
                $page
            ),
            true
        );

        $nextPage = min($page + 1, count($pages));

        return redirect()
            ->route(
                'mahasiswa.materi.page',
                [
                    'level' => $level,
                    'page' => $nextPage,
                ]
            )
            ->with(
                'success',
                'Jawaban benar. Lanjut ke halaman berikutnya.'
            );
    }

    public function evaluate(Request $request, int $level)
    {
        [$user, $kelas, $subbabSelesai, $unlockedLevel] =
            $this->studentContext();

        $this->ensureLevelExists($level);
        $this->ensureLevelUnlocked($level, $unlockedLevel);

        $semuaMateri = $this->materiData();
        $materi = $semuaMateri[$level];
        $pages = $materi['pages'];
        $totalPages = count($pages);
        $finalPage = $pages[$totalPages];

        if (($finalPage['type'] ?? null) !== 'final_quiz') {
            abort(500, 'Evaluasi akhir subbab belum dikonfigurasi.');
        }

        $levelSelesai = $level <= $subbabSelesai;
        $accessiblePages = $this->accessiblePages(
            $pages,
            $user->id,
            $kelas->id,
            $level,
            $levelSelesai
        );

        if (!in_array($totalPages, $accessiblePages, true)) {
            return redirect()
                ->route(
                    'mahasiswa.materi.page',
                    [
                        'level' => $level,
                        'page' => max($accessiblePages),
                    ]
                )
                ->with(
                    'error',
                    'Selesaikan semua checkpoint materi terlebih dahulu.'
                );
        }

        $validated = $request->validate([
            'answers' => ['required', 'array'],
            'answers.*' => ['required', 'string', 'max:5'],
        ]);

        $questions = $finalPage['questions'];
        $correctCount = 0;
        $results = [];

        foreach ($questions as $index => $question) {
            $selected = strtoupper($validated['answers'][$index] ?? '');
            $correct = strtoupper($question['answer']);
            $isCorrect = $selected === $correct;

            if ($isCorrect) {
                $correctCount++;
            }

            $results[$index] = [
                'selected' => $selected,
                'is_correct' => $isCorrect,
            ];
        }

        $totalQuestions = count($questions);
        $score = $totalQuestions > 0
            ? (int) round(($correctCount / $totalQuestions) * 100)
            : 0;

        $passed = $score >= 80;
        $xpGain = 0;

        if ($passed) {
            $currentCompleted = $this->normalizeCompletedLevel(
                (int) ($kelas->pivot->subbab_selesai ?? 0),
                6
            );

            if ($level > $currentCompleted) {
                $newCompleted = $level;
                $newProgress = round(($newCompleted / 6) * 100, 2);
                $currentXp = (int) ($kelas->pivot->xp ?? 0);
                $xpGain = 100;

                $kelas
                    ->mahasiswa()
                    ->updateExistingPivot(
                        $user->id,
                        [
                            'subbab_selesai' => $newCompleted,
                            'total_subbab' => 6,
                            'progress_percent' => $newProgress,
                            'xp' => $currentXp + $xpGain,
                            'last_activity_at' => now(),
                        ]
                    );
            } else {
                $kelas
                    ->mahasiswa()
                    ->updateExistingPivot(
                        $user->id,
                        [
                            'last_activity_at' => now(),
                        ]
                    );
            }
        } else {
            $kelas
                ->mahasiswa()
                ->updateExistingPivot(
                    $user->id,
                    [
                        'last_activity_at' => now(),
                    ]
                );
        }

        return back()
            ->withInput()
            ->with('quiz_score', $score)
            ->with('quiz_correct', $correctCount)
            ->with('quiz_total', $totalQuestions)
            ->with('quiz_passed', $passed)
            ->with('quiz_results', $results)
            ->with('quiz_xp_gain', $xpGain);
    }

    private function studentContext(): array
    {
        /** @var User|null $user */
        $user = Auth::user();

        if (!$user) {
            abort(401);
        }

        if ($user->role !== 'mahasiswa') {
            abort(403, 'Halaman materi hanya dapat diakses mahasiswa.');
        }

        $kelas = $user
            ->kelasDiikuti()
            ->with('pembuat')
            ->first();

        if (!$kelas) {
            abort(403, 'Silakan bergabung ke kelas terlebih dahulu.');
        }

        $subbabSelesai = $this->normalizeCompletedLevel(
            (int) ($kelas->pivot->subbab_selesai ?? 0),
            6
        );

        $unlockedLevel = $subbabSelesai >= 6
            ? 6
            : $subbabSelesai + 1;

        return [
            $user,
            $kelas,
            $subbabSelesai,
            $unlockedLevel,
        ];
    }

    private function ensureLevelExists(int $level): void
    {
        if ($level < 1 || $level > 6) {
            abort(404);
        }
    }

    private function ensureLevelUnlocked(
        int $level,
        int $unlockedLevel
    ): void {
        if ($level > $unlockedLevel) {
            abort(
                403,
                'Selesaikan subbab sebelumnya dengan nilai minimal 80% terlebih dahulu.'
            );
        }
    }

    private function accessiblePages(
        array $pages,
        int $userId,
        int $kelasId,
        int $level,
        bool $levelSelesai
    ): array {
        $accessible = [1];

        if ($levelSelesai) {
            return array_keys($pages);
        }

        foreach ($pages as $pageNumber => $pageData) {
            if ($pageNumber === 1) {
                continue;
            }

            $previousPage = $pages[$pageNumber - 1] ?? null;

            if (!$previousPage) {
                break;
            }

            if (($previousPage['type'] ?? 'content') === 'content') {
                $passed = session()->get(
                    $this->checkpointKey(
                        $userId,
                        $kelasId,
                        $level,
                        $pageNumber - 1
                    ),
                    false
                );

                if (!$passed) {
                    break;
                }
            }

            $accessible[] = $pageNumber;
        }

        return $accessible;
    }

    private function checkpointKey(
        int $userId,
        int $kelasId,
        int $level,
        int $page
    ): string {
        return "himdas.checkpoint.{$userId}.{$kelasId}.{$level}.{$page}";
    }

    private function normalizeCompletedLevel(
        int $value,
        int $maximum
    ): int {
        if ($value < 0) {
            return 0;
        }

        if ($value > $maximum) {
            return $maximum;
        }

        return $value;
    }

    private function materiData(): array
    {
        return [
            1 => [
                'level' => 1,
                'nama' => 'Pengenal Himpunan',
                'judul' => 'Pengertian, Keanggotaan, dan Kardinalitas',
                'simbol' => '∈',
                'deskripsi' => 'Memahami konsep dasar himpunan, anggota atau elemen, notasi keanggotaan, serta bilangan kardinal.',
                'challenge' => 'Detektif Himpunan',
                'topik' => [
                    'Pengertian himpunan',
                    'Himpunan dan bukan himpunan',
                    'Anggota atau elemen',
                    'Notasi ∈ dan ∉',
                    'Bilangan kardinal',
                ],
                'tujuan' => [
                    'Menjelaskan pengertian himpunan dengan menggunakan bahasa sendiri.',
                    'Membedakan kumpulan yang termasuk himpunan dan bukan himpunan berdasarkan kriteria yang jelas.',
                    'Menentukan anggota dan bukan anggota suatu himpunan dengan tepat.',
                    'Menggunakan simbol ∈ dan ∉ secara benar.',
                    'Menghitung bilangan kardinal suatu himpunan.',
                ],
                'pages' => [
                    1 => [
                        'type' => 'content',
                        'title' => 'Pengertian Himpunan',
                        'subtitle' => 'Mengenal konsep dasar himpunan',
                        'paragraphs' => [
                            'Himpunan adalah kumpulan objek yang keanggotaannya dapat ditentukan dengan jelas atau well defined. Maksudnya, untuk setiap objek yang diperiksa harus ada keputusan yang tegas apakah objek tersebut termasuk sebagai anggota himpunan atau tidak. Kejelasan aturan ini menjadi ciri utama himpunan dalam matematika.',
                            'Objek yang menjadi anggota himpunan dapat berupa bilangan, huruf, nama benda, warna, orang, maupun objek abstrak. Himpunan biasanya diberi nama dengan huruf kapital seperti A, B, atau C, sedangkan anggotanya ditulis di dalam kurung kurawal. Dengan cara ini, suatu kumpulan dapat dinyatakan secara ringkas dan terstruktur.',
                            'Contohnya, kumpulan bilangan genap kurang dari 10 merupakan himpunan karena kita dapat menentukan dengan pasti bahwa anggotanya adalah 2, 4, 6, dan 8. Begitu juga kumpulan bilangan prima kurang dari 20, karena terdapat aturan matematis yang jelas untuk menentukan apakah suatu bilangan termasuk bilangan prima atau tidak.',
                            'Pemahaman tentang himpunan penting karena konsep ini menjadi dasar untuk banyak materi matematika berikutnya. Operasi himpunan, diagram Venn, relasi, dan fungsi semuanya menggunakan gagasan tentang objek, anggota, dan hubungan antar kumpulan. Karena itu, sebelum mempelajari konsep yang lebih lanjut, mahasiswa perlu memahami terlebih dahulu apa yang dimaksud dengan himpunan.',
                        ],
                        'example' => [
                            'title' => 'Contoh',
                            'lines' => [
                                'Kumpulan bilangan genap kurang dari 10 merupakan himpunan: {2, 4, 6, 8}.',
                                'Kumpulan bilangan prima kurang dari 20 juga merupakan himpunan karena anggotanya dapat ditentukan dengan jelas.',
                            ],
                        ],
                        'note' => 'Kata kunci: keanggotaan sebuah himpunan harus well defined atau dapat ditentukan dengan jelas.',
                        'visual' => 'set-basic',
                        'checkpoint' => [
                            'question' => 'Manakah yang merupakan himpunan dalam pengertian matematika?',
                            'options' => [
                                'A' => 'Kumpulan makanan paling enak',
                                'B' => 'Kumpulan mahasiswa rajin',
                                'C' => 'Kumpulan bilangan prima kurang dari 20',
                                'D' => 'Kumpulan film terbaik',
                            ],
                            'answer' => 'C',
                            'explanation' => 'Bilangan prima kurang dari 20 memiliki kriteria objektif sehingga anggotanya dapat ditentukan dengan jelas.',
                        ],
                    ],
                    2 => [
                        'type' => 'content',
                        'title' => 'Himpunan dan Bukan Himpunan',
                        'subtitle' => 'Membedakan kumpulan objektif dan subjektif',
                        'paragraphs' => [
                            'Suatu kumpulan disebut himpunan apabila terdapat kriteria yang jelas dan objektif untuk menentukan anggotanya. Artinya, siapa pun yang menggunakan kriteria yang sama seharusnya memperoleh keputusan keanggotaan yang sama. Contoh yang sederhana adalah kumpulan hari dalam satu minggu atau kumpulan bilangan ganjil kurang dari 10.',
                            'Sebaliknya, kumpulan yang ditentukan oleh penilaian pribadi biasanya bukan himpunan dalam pengertian matematika. Ungkapan seperti makanan yang lezat, film terbaik, atau mahasiswa yang sangat rajin dapat menghasilkan penilaian berbeda dari satu orang ke orang lain. Karena tidak ada batas yang tegas, keanggotaannya tidak dapat ditentukan secara objektif.',
                            'Dalam himpunan, urutan anggota tidak memengaruhi himpunan. Misalnya {1, 2, 3} dan {3, 1, 2} menyatakan himpunan yang sama karena keduanya mempunyai anggota yang sama. Pengulangan anggota juga tidak menghasilkan anggota baru, sehingga {a, a, b, c, b} dipandang sama dengan {a, b, c}.',
                            'Saat menentukan apakah suatu kumpulan merupakan himpunan atau bukan, fokuslah pada aturan keanggotaannya, bukan pada banyaknya anggota. Himpunan dapat memiliki banyak anggota, satu anggota, bahkan tidak memiliki anggota sama sekali. Hal yang paling penting adalah apakah kriterianya dapat digunakan secara tegas untuk memutuskan keanggotaan.',
                        ],
                        'example' => [
                            'title' => 'Bandingkan',
                            'lines' => [
                                'Himpunan: kumpulan warna pada bendera Republik Indonesia.',
                                'Bukan himpunan: kumpulan lukisan yang indah, karena kata “indah” bergantung pada penilaian seseorang.',
                            ],
                        ],
                        'note' => 'Coba tanyakan: “Apakah setiap orang akan memperoleh daftar anggota yang sama?” Jika iya, kumpulan tersebut kemungkinan merupakan himpunan.',
                        'visual' => 'set-vs-nonset',
                        'checkpoint' => [
                            'question' => 'Kumpulan manakah yang bukan himpunan?',
                            'options' => [
                                'A' => 'Bilangan cacah kurang dari 5',
                                'B' => 'Hari dalam satu minggu',
                                'C' => 'Makanan yang lezat',
                                'D' => 'Huruf vokal dalam alfabet',
                            ],
                            'answer' => 'C',
                            'explanation' => '“Lezat” bersifat subjektif sehingga tidak menghasilkan kriteria keanggotaan yang tegas.',
                        ],
                    ],
                    3 => [
                        'type' => 'content',
                        'title' => 'Anggota dan Notasi ∈ / ∉',
                        'subtitle' => 'Menentukan keanggotaan suatu himpunan',
                        'paragraphs' => [
                            'Setiap objek yang termasuk ke dalam suatu himpunan disebut anggota atau elemen himpunan. Anggota biasanya ditulis di dalam kurung kurawal dan dipisahkan dengan tanda koma. Sebagai contoh, jika A = {2, 4, 6, 8}, maka 2, 4, 6, dan 8 merupakan anggota himpunan A.',
                            'Dalam notasi himpunan, simbol ∈ dibaca \'anggota dari\'. Jika 4 merupakan anggota A, pernyataannya ditulis 4 ∈ A. Sebaliknya, simbol ∉ dibaca \'bukan anggota dari\'. Karena 5 tidak terdapat pada A = {2, 4, 6, 8}, maka dapat ditulis 5 ∉ A.',
                            'Penempatan simbol perlu diperhatikan. Elemen ditulis di sebelah kiri, sedangkan nama himpunan ditulis di sebelah kanan. Jadi bentuk seperti 4 ∈ A menyatakan hubungan antara sebuah elemen dengan sebuah himpunan, bukan hubungan antara dua himpunan.',
                            'Notasi keanggotaan membantu kita menuliskan pernyataan matematika dengan singkat dan tepat. Saat membaca suatu soal, mahasiswa perlu memeriksa daftar anggota atau syarat pembentuk himpunan terlebih dahulu sebelum menentukan apakah suatu elemen menggunakan simbol ∈ atau ∉.',
                        ],
                        'example' => [
                            'title' => 'Contoh',
                            'lines' => [
                                'A = {a, b, c, d, e, f}',
                                'a ∈ A',
                                'g ∉ A',
                            ],
                        ],
                        'note' => 'Perhatikan arah simbol: elemen ditulis di sebelah kiri simbol, sedangkan nama himpunan di sebelah kanan.',
                        'visual' => 'membership',
                        'checkpoint' => [
                            'question' => 'Jika A = {2, 4, 6, 8, 10}, pernyataan yang benar adalah ...',
                            'options' => [
                                'A' => '9 ∈ A',
                                'B' => '6 ∉ A',
                                'C' => '10 ∈ A',
                                'D' => '2 ∉ A',
                            ],
                            'answer' => 'C',
                            'explanation' => '10 tercantum sebagai anggota A sehingga 10 ∈ A.',
                        ],
                    ],
                    4 => [
                        'type' => 'content',
                        'title' => 'Bilangan Kardinal',
                        'subtitle' => 'Menghitung banyak anggota himpunan',
                        'paragraphs' => [
                            'Bilangan kardinal adalah banyaknya anggota yang berbeda dalam suatu himpunan. Banyak anggota himpunan A dapat ditulis dengan notasi n(A) atau |A|. Kardinalitas tidak melihat urutan anggota, tetapi hanya menghitung berapa banyak elemen berbeda yang terdapat di dalam himpunan.',
                            'Jika sebuah anggota ditulis berulang, anggota tersebut tetap dihitung satu kali. Misalnya A = {a, b, c, a, d, b}. Walaupun terdapat enam penulisan elemen, anggota yang berbeda hanya a, b, c, dan d. Karena itu n(A) = 4.',
                            'Kardinalitas juga dapat diterapkan pada himpunan kosong. Karena himpunan kosong tidak mempunyai anggota, maka n(∅) = 0. Sebaliknya, jika suatu himpunan memiliki satu anggota saja, kardinalitasnya adalah 1.',
                            'Konsep kardinalitas penting ketika membandingkan himpunan, menentukan himpunan ekuivalen, menghitung banyak subset pada himpunan kuasa, dan menyelesaikan soal diagram Venn. Oleh sebab itu, sebelum menghitung kardinalitas, pastikan terlebih dahulu bahwa anggota yang sama tidak dihitung lebih dari sekali.',
                        ],
                        'example' => [
                            'title' => 'Contoh',
                            'lines' => [
                                'A = {a, b, c, a, d, b}',
                                'Sebagai himpunan, A = {a, b, c, d}.',
                                'Jadi n(A) = 4.',
                            ],
                        ],
                        'note' => 'Sebelum menghitung kardinalitas, hilangkan anggota yang berulang.',
                        'visual' => 'cardinality',
                        'checkpoint' => [
                            'question' => 'Jika A = {1, 2, 2, 3, 4, 4}, maka n(A) adalah ...',
                            'options' => [
                                'A' => '4',
                                'B' => '5',
                                'C' => '6',
                                'D' => '8',
                            ],
                            'answer' => 'A',
                            'explanation' => 'Anggota berbeda pada A adalah {1, 2, 3, 4}, sehingga n(A) = 4.',
                        ],
                    ],
                    5 => [
                        'type' => 'final_quiz',
                        'title' => 'Evaluasi Subbab 1',
                        'subtitle' => 'Pengenal Himpunan',
                        'questions' => [
                            [
                                'question' => '“Kumpulan bilangan genap kurang dari 20” merupakan ...',
                                'options' => ['A' => 'Bukan himpunan', 'B' => 'Himpunan', 'C' => 'Himpunan kosong', 'D' => 'Himpunan semesta'],
                                'answer' => 'B',
                                'explanation' => 'Kriteria bilangan genap kurang dari 20 bersifat jelas dan objektif.',
                            ],
                            [
                                'question' => 'Jika A = {2, 4, 6, 8, 10}, pernyataan yang benar adalah ...',
                                'options' => ['A' => '6 ∈ A', 'B' => '9 ∈ A', 'C' => '10 ∉ A', 'D' => '2 ∉ A'],
                                'answer' => 'A',
                                'explanation' => '6 tercantum sebagai anggota A.',
                            ],
                            [
                                'question' => 'Jika A = {a, b, c, a, d, b}, maka n(A) = ...',
                                'options' => ['A' => '3', 'B' => '4', 'C' => '5', 'D' => '6'],
                                'answer' => 'B',
                                'explanation' => 'Anggota berbeda adalah a, b, c, dan d.',
                            ],
                            [
                                'question' => 'Simbol yang berarti “bukan anggota dari” adalah ...',
                                'options' => ['A' => '∈', 'B' => '∉', 'C' => '⊆', 'D' => '∪'],
                                'answer' => 'B',
                                'explanation' => 'Simbol ∉ menyatakan bukan anggota dari.',
                            ],
                            [
                                'question' => 'Manakah yang bukan himpunan?',
                                'options' => ['A' => 'Bilangan prima kurang dari 10', 'B' => 'Bulan dalam setahun', 'C' => 'Makanan terenak', 'D' => 'Bilangan ganjil kurang dari 10'],
                                'answer' => 'C',
                                'explanation' => '“Terenak” bersifat subjektif.',
                            ],
                        ],
                    ],
                ],
            ],

            2 => [
                'level' => 2,
                'nama' => 'Pembentuk Himpunan',
                'judul' => 'Cara Menyatakan Himpunan',
                'simbol' => '{ }',
                'deskripsi' => 'Mempelajari cara tabulasi, pencirian, simbol baku, dan representasi diagram Venn.',
                'challenge' => 'Ubah Representasi',
                'topik' => [
                    'Cara tabulasi atau enumerasi',
                    'Cara pencirian atau deskriptif',
                    'Notasi pembentuk himpunan',
                    'Simbol baku himpunan bilangan',
                    'Diagram Venn',
                ],
                'tujuan' => [
                    'Menyatakan himpunan dengan cara tabulasi.',
                    'Menyatakan himpunan dengan cara pencirian atau pembentuk himpunan.',
                    'Mengenali simbol baku himpunan bilangan.',
                    'Menggambarkan himpunan melalui diagram Venn.',
                ],
                'pages' => [
                    1 => [
                        'type' => 'content',
                        'title' => 'Cara Tabulasi atau Enumerasi',
                        'subtitle' => 'Menuliskan anggota himpunan satu per satu',
                        'paragraphs' => [
                            'Cara tabulasi atau enumerasi adalah cara menyatakan himpunan dengan menuliskan anggota-anggotanya satu per satu di dalam kurung kurawal. Setiap anggota dipisahkan dengan tanda koma. Cara ini sangat mudah digunakan apabila jumlah anggota himpunan relatif sedikit dan dapat dituliskan secara jelas.',
                            'Sebagai contoh, himpunan bilangan genap positif kurang dari 12 dapat ditulis A = {2, 4, 6, 8, 10}. Dari bentuk ini pembaca dapat langsung melihat seluruh anggota himpunan tanpa harus menafsirkan aturan tambahan.',
                            'Jika sebuah himpunan mempunyai pola yang jelas tetapi anggotanya sangat banyak atau tidak berhingga, tanda titik tiga dapat digunakan. Misalnya N = {1, 2, 3, 4, ...}. Tanda titik tiga menyatakan bahwa pola anggota terus berlanjut mengikuti aturan yang sudah terlihat.',
                            'Walaupun sederhana, penulisan tabulasi harus tetap mengikuti aturan himpunan. Anggota yang sama tidak perlu ditulis berulang dan urutannya tidak menentukan himpunan. Tujuan utama tabulasi adalah memberikan representasi anggota secara eksplisit dan mudah dibaca.',
                        ],
                        'example' => [
                            'title' => 'Contoh',
                            'lines' => [
                                'A = {0, 1, 2, 3, 4, ...}',
                                'B = {0, 1, 4, 9, 16, ..., 100}',
                            ],
                        ],
                        'note' => 'Gunakan tabulasi ketika anggota dapat dituliskan dengan jelas dan jumlahnya tidak terlalu sulit untuk direpresentasikan.',
                        'visual' => 'enumeration',
                        'checkpoint' => [
                            'question' => 'Bentuk tabulasi dari A = {x | 0 ≤ x < 6, x bilangan cacah} adalah ...',
                            'options' => [
                                'A' => '{0, 1, 2, 3, 4, 5}',
                                'B' => '{1, 2, 3, 4, 5, 6}',
                                'C' => '{0, 1, 2, 3, 4, 5, 6}',
                                'D' => '{1, 2, 3, 4, 5}',
                            ],
                            'answer' => 'A',
                            'explanation' => 'Bilangan cacah dimulai dari 0 dan syarat x < 6 membuat anggota terakhirnya 5.',
                        ],
                    ],
                    2 => [
                        'type' => 'content',
                        'title' => 'Cara Pencirian atau Deskriptif',
                        'subtitle' => 'Menyatakan himpunan melalui aturan keanggotaan',
                        'paragraphs' => [
                            'Cara pencirian atau metode pembentuk himpunan menyatakan suatu himpunan melalui sifat atau syarat yang harus dipenuhi oleh anggotanya. Bentuk yang sering digunakan adalah {x | syarat untuk x}, yang dapat dibaca sebagai \'himpunan semua x sedemikian sehingga x memenuhi syarat tertentu\'.',
                            'Metode ini sangat berguna apabila anggota himpunan terlalu banyak untuk dituliskan satu per satu. Misalnya A = {x | 1 < x < 8, x bilangan cacah}. Karena x harus berupa bilangan cacah yang lebih dari 1 dan kurang dari 8, maka bentuk tabulasinya adalah {2, 3, 4, 5, 6, 7}.',
                            'Pada himpunan kontinu, cara pencirian menjadi semakin penting. Misalnya B = {x | 1 < x < 8, x bilangan real}. Himpunan ini mempunyai tak hingga banyak anggota sehingga tidak mungkin dituliskan seluruhnya dengan tabulasi.',
                            'Saat menggunakan cara pencirian, mahasiswa harus memperhatikan dua hal: jenis objek yang dibicarakan dan syarat yang harus dipenuhi. Kesalahan pada salah satu bagian dapat menghasilkan himpunan yang berbeda. Oleh karena itu, baca setiap batas dan jenis bilangan secara teliti.',
                        ],
                        'example' => [
                            'title' => 'Contoh',
                            'lines' => [
                                'A = {x | 1 < x < 8, x bilangan cacah}.',
                                'Dengan tabulasi: A = {2, 3, 4, 5, 6, 7}.',
                            ],
                        ],
                        'note' => 'Tanda “|” dapat dibaca “sedemikian sehingga”.',
                        'visual' => 'builder',
                        'checkpoint' => [
                            'question' => 'Bentuk pencirian yang sesuai untuk {2, 4, 6, 8, 10} adalah ...',
                            'options' => [
                                'A' => '{x | x bilangan genap, 2 ≤ x ≤ 10}',
                                'B' => '{x | x bilangan ganjil, x < 10}',
                                'C' => '{x | x bilangan prima, x ≤ 10}',
                                'D' => '{x | x bilangan cacah, x ≤ 10}',
                            ],
                            'answer' => 'A',
                            'explanation' => 'Semua anggotanya bilangan genap dari 2 sampai 10.',
                        ],
                    ],
                    3 => [
                        'type' => 'content',
                        'title' => 'Simbol Baku Himpunan Bilangan',
                        'subtitle' => 'Mengenal N, Z, Q, R, dan C',
                        'paragraphs' => [
                            'Dalam matematika terdapat beberapa himpunan bilangan yang sangat sering digunakan sehingga mempunyai simbol baku. Penggunaan simbol ini mempersingkat penulisan dan membuat komunikasi matematika lebih efisien. Dalam modul HIMDAS digunakan simbol N, P, Z, Q, R, dan C untuk kelompok bilangan tertentu.',
                            'N menyatakan bilangan asli seperti {1, 2, 3, ...}, sedangkan P dapat digunakan untuk bilangan bulat positif. Z menyatakan bilangan bulat yang mencakup bilangan negatif, nol, dan bilangan positif, misalnya {..., -2, -1, 0, 1, 2, ...}.',
                            'Q menyatakan bilangan rasional, yaitu bilangan yang dapat dinyatakan dalam bentuk p/q dengan q tidak sama dengan nol. R menyatakan bilangan riil yang mencakup bilangan rasional dan irasional pada garis bilangan. C digunakan untuk bilangan kompleks yang secara umum dapat dinyatakan dalam bentuk a + bi.',
                            'Memahami simbol baku penting ketika membaca notasi pembentuk himpunan. Jika sebuah syarat menuliskan x ∈ Z, maka nilai x dibatasi pada bilangan bulat. Jika ditulis x ∈ R, ruang nilai x jauh lebih luas karena mencakup semua bilangan riil.',
                        ],
                        'example' => [
                            'title' => 'Contoh simbol',
                            'lines' => [
                                'N = {1, 2, 3, ...}',
                                'Z = {..., -2, -1, 0, 1, 2, ...}',
                                'Q memuat bilangan yang dapat ditulis p/q dengan q ≠ 0.',
                            ],
                        ],
                        'note' => 'Perhatikan konteks buku atau dosen karena beberapa sumber menggunakan konvensi sedikit berbeda untuk bilangan asli.',
                        'visual' => 'number-sets',
                        'checkpoint' => [
                            'question' => 'Simbol baku untuk himpunan bilangan bulat adalah ...',
                            'options' => ['A' => 'N', 'B' => 'Z', 'C' => 'Q', 'D' => 'R'],
                            'answer' => 'B',
                            'explanation' => 'Z digunakan untuk himpunan bilangan bulat.',
                        ],
                    ],
                    4 => [
                        'type' => 'content',
                        'title' => 'Diagram Venn',
                        'subtitle' => 'Merepresentasikan himpunan secara visual',
                        'paragraphs' => [
                            'Diagram Venn adalah representasi visual yang digunakan untuk menggambarkan himpunan dan hubungan antarhimpunan. Himpunan semesta biasanya digambar sebagai persegi panjang, sedangkan himpunan yang menjadi bagian dari semesta digambar sebagai kurva tertutup atau lingkaran di dalamnya.',
                            'Setiap anggota ditempatkan pada daerah yang sesuai. Jika sebuah anggota termasuk A, anggota tersebut diletakkan di dalam daerah A. Jika anggota termasuk A dan B sekaligus, posisinya berada pada daerah perpotongan kedua himpunan. Anggota semesta yang tidak termasuk A maupun B tetap ditempatkan di dalam persegi panjang semesta tetapi di luar kedua kurva.',
                            'Diagram Venn memudahkan mahasiswa melihat hubungan yang terkadang sulit dipahami hanya melalui simbol. Misalnya, irisan dapat dilihat sebagai daerah yang dimiliki bersama, sedangkan gabungan mencakup seluruh daerah dari kedua himpunan.',
                            'Ketika membuat diagram Venn, tentukan terlebih dahulu himpunan semesta, kemudian gambarkan himpunan-himpunan di dalamnya, lalu tempatkan setiap anggota secara teliti. Langkah ini penting agar satu anggota tidak diletakkan pada daerah yang salah.',
                        ],
                        'example' => [
                            'title' => 'Contoh',
                            'lines' => [
                                'S = {1, 2, 3, 4, 5, 6}',
                                'A = {1, 2, 3}',
                                'B = {3, 4, 5}',
                                'Angka 3 berada pada daerah irisan A dan B.',
                            ],
                        ],
                        'note' => 'Diagram Venn akan sering digunakan pada subbab berikutnya untuk menunjukkan hubungan dan operasi himpunan.',
                        'visual' => 'venn-overlap',
                        'checkpoint' => [
                            'question' => 'Pada S={1,2,3,4,5,6}, A={1,2,3}, dan B={3,4,5}, anggota yang berada pada irisan A dan B adalah ...',
                            'options' => ['A' => '1', 'B' => '2', 'C' => '3', 'D' => '6'],
                            'answer' => 'C',
                            'explanation' => '3 merupakan anggota A sekaligus anggota B.',
                        ],
                    ],
                    5 => [
                        'type' => 'final_quiz',
                        'title' => 'Evaluasi Subbab 2',
                        'subtitle' => 'Pembentuk Himpunan',
                        'questions' => [
                            [
                                'question' => 'Bentuk tabulasi A={x | 0≤x<6, x bilangan cacah} adalah ...',
                                'options' => ['A' => '{0,1,2,3,4,5}', 'B' => '{1,2,3,4,5,6}', 'C' => '{0,1,2,3,4,5,6}', 'D' => '{1,2,3,4,5}'],
                                'answer' => 'A',
                                'explanation' => 'x dimulai dari 0 dan harus kurang dari 6.',
                            ],
                            [
                                'question' => 'Bentuk umum cara pencirian adalah ...',
                                'options' => ['A' => '[x : syarat]', 'B' => '{x | syarat untuk x}', 'C' => '(x, syarat)', 'D' => 'x = syarat'],
                                'answer' => 'B',
                                'explanation' => 'Notasi pembentuk himpunan umum ditulis {x | syarat untuk x}.',
                            ],
                            [
                                'question' => 'Simbol Z menyatakan ...',
                                'options' => ['A' => 'Bilangan asli', 'B' => 'Bilangan bulat', 'C' => 'Bilangan riil', 'D' => 'Bilangan kompleks'],
                                'answer' => 'B',
                                'explanation' => 'Z adalah simbol baku himpunan bilangan bulat.',
                            ],
                            [
                                'question' => 'Dalam diagram Venn, himpunan semesta biasanya digambar sebagai ...',
                                'options' => ['A' => 'Titik', 'B' => 'Garis lurus', 'C' => 'Persegi panjang', 'D' => 'Segitiga'],
                                'answer' => 'C',
                                'explanation' => 'Semesta S biasanya menjadi daerah persegi panjang yang memuat seluruh himpunan yang dibahas.',
                            ],
                            [
                                'question' => 'Jika A={1,2,3} dan B={3,4,5}, elemen yang berada pada kedua himpunan adalah ...',
                                'options' => ['A' => '1', 'B' => '2', 'C' => '3', 'D' => '5'],
                                'answer' => 'C',
                                'explanation' => '3 terdapat di A dan B.',
                            ],
                        ],
                    ],
                ],
            ],

            3 => [
                'level' => 3,
                'nama' => 'Venn Master',
                'judul' => 'Macam-macam dan Relasi Antarhimpunan',
                'simbol' => '◯',
                'deskripsi' => 'Mengenali himpunan kosong, semesta, sama, lepas, bersilangan, dan ekuivalen.',
                'challenge' => 'Venn Challenge',
                'topik' => [
                    'Himpunan kosong',
                    'Himpunan semesta',
                    'Himpunan yang sama',
                    'Himpunan lepas',
                    'Himpunan bersilangan',
                    'Himpunan ekuivalen',
                ],
                'tujuan' => [
                    'Menjelaskan himpunan kosong dan himpunan semesta.',
                    'Menentukan apakah dua himpunan sama.',
                    'Membedakan himpunan lepas dan bersilangan.',
                    'Menjelaskan himpunan ekuivalen berdasarkan kardinalitas.',
                ],
                'pages' => [
                    1 => [
                        'type' => 'content',
                        'title' => 'Himpunan Kosong',
                        'subtitle' => 'Himpunan tanpa anggota',
                        'paragraphs' => [
                            'Himpunan kosong adalah himpunan yang tidak mempunyai anggota. Himpunan kosong dilambangkan dengan ∅ atau dapat dituliskan sebagai { }. Karena tidak memiliki anggota, kardinalitasnya adalah n(∅) = 0.',
                            'Himpunan kosong dapat muncul ketika tidak ada objek yang memenuhi syarat pembentuk suatu himpunan. Contohnya B = {x | 6 < x < 7, x bilangan bulat}. Tidak terdapat bilangan bulat yang lebih dari 6 sekaligus kurang dari 7, sehingga B = ∅.',
                            'Penting untuk membedakan ∅ dengan {∅}. Simbol ∅ adalah himpunan tanpa anggota, sedangkan {∅} adalah himpunan yang memiliki satu anggota, yaitu himpunan kosong itu sendiri. Akibatnya n(∅) = 0, tetapi n({∅}) = 1.',
                            'Konsep himpunan kosong banyak digunakan pada operasi dan relasi antarhimpunan. Misalnya dua himpunan disebut lepas apabila irisannya merupakan himpunan kosong.',
                        ],
                        'example' => [
                            'title' => 'Contoh',
                            'lines' => [
                                'B = {x | 6 < x < 7, x bilangan bulat}.',
                                'Tidak ada bilangan bulat di antara 6 dan 7, sehingga B = ∅.',
                            ],
                        ],
                        'note' => '∅ berbeda dengan {∅}. Himpunan ∅ tidak memiliki anggota, sedangkan {∅} memiliki satu anggota, yaitu himpunan kosong.',
                        'visual' => 'empty-set',
                        'checkpoint' => [
                            'question' => 'Himpunan {x | 3 < x < 4, x bilangan bulat} adalah ...',
                            'options' => ['A' => '{3}', 'B' => '{4}', 'C' => '∅', 'D' => '{3,4}'],
                            'answer' => 'C',
                            'explanation' => 'Tidak ada bilangan bulat yang lebih dari 3 dan kurang dari 4.',
                        ],
                    ],
                    2 => [
                        'type' => 'content',
                        'title' => 'Himpunan Semesta',
                        'subtitle' => 'Himpunan yang memuat seluruh objek pembicaraan',
                        'paragraphs' => [
                            'Himpunan semesta adalah himpunan yang memuat seluruh objek yang sedang menjadi ruang pembicaraan. Himpunan semesta biasanya dinotasikan dengan S. Semua himpunan lain yang dibahas dalam konteks tersebut dianggap berada di dalam S.',
                            'Semesta tidak selalu tunggal. Sebuah himpunan dapat berada pada lebih dari satu semesta selama seluruh anggotanya tercakup. Misalnya A = {a, b, c}; S1 = {a, b, c} dan S2 = {a, b, c, d, e} sama-sama dapat menjadi himpunan semesta bagi A.',
                            'Pemilihan semesta memengaruhi beberapa operasi, terutama komplemen. Komplemen A berisi semua anggota semesta yang tidak termasuk A. Jika himpunan semestanya berubah, hasil komplemen juga dapat berubah.',
                            'Dalam diagram Venn, himpunan semesta digambarkan sebagai persegi panjang yang membungkus seluruh himpunan yang sedang dibicarakan. Karena itu, sebelum mengerjakan soal komplemen atau diagram Venn, selalu identifikasi semestanya terlebih dahulu.',
                        ],
                        'example' => [
                            'title' => 'Contoh',
                            'lines' => [
                                'Jika A adalah himpunan bilangan genap positif kurang dari 10, semesta dapat dipilih sebagai bilangan asli kurang dari 10.',
                            ],
                        ],
                        'note' => 'Pemilihan semesta penting ketika membahas komplemen suatu himpunan.',
                        'visual' => 'universal-set',
                        'checkpoint' => [
                            'question' => 'Jika A={a,b,c}, manakah yang dapat menjadi himpunan semesta A?',
                            'options' => ['A' => '{a,b}', 'B' => '{a,c}', 'C' => '{a,b,c,d}', 'D' => '{d,e,f}'],
                            'answer' => 'C',
                            'explanation' => 'Semesta harus memuat seluruh anggota A.',
                        ],
                    ],
                    3 => [
                        'type' => 'content',
                        'title' => 'Himpunan yang Sama',
                        'subtitle' => 'Kesamaan ditentukan oleh anggota, bukan urutan',
                        'paragraphs' => [
                            'Dua himpunan A dan B dikatakan sama apabila setiap anggota A juga merupakan anggota B dan setiap anggota B juga merupakan anggota A. Hubungan ini ditulis A = B. Jadi kesamaan ditentukan oleh anggotanya, bukan oleh cara atau urutan penulisannya.',
                            'Sebagai contoh, A = {1, 2, 3} dan B = {3, 2, 1} merupakan himpunan yang sama. Walaupun urutan penulisan berbeda, keduanya memuat tepat anggota 1, 2, dan 3.',
                            'Pengulangan anggota juga tidak memengaruhi kesamaan. A = {a, b, c} sama dengan B = {a, a, b, c, c} karena setelah pengulangan diabaikan, anggota yang berbeda tetap sama.',
                            'Untuk memeriksa kesamaan dua himpunan, bandingkan keanggotaan secara dua arah. Jangan hanya memeriksa bahwa semua anggota A berada di B; pastikan juga tidak ada anggota tambahan pada B yang tidak dimiliki A.',
                        ],
                        'example' => [
                            'title' => 'Contoh',
                            'lines' => [
                                'A = {1, 2, 3}',
                                'B = {3, 2, 1}',
                                'Maka A = B.',
                            ],
                        ],
                        'note' => 'Kesamaan himpunan berbeda dari ekuivalensi. Himpunan sama harus memiliki anggota yang sama, sedangkan ekuivalen cukup memiliki kardinalitas yang sama.',
                        'visual' => 'equal-sets',
                        'checkpoint' => [
                            'question' => 'Jika A={1,2,3} dan B={3,2,1}, hubungan yang benar adalah ...',
                            'options' => ['A' => 'A = B', 'B' => 'A ∩ B = ∅', 'C' => 'A ≠ B', 'D' => 'A dan B lepas'],
                            'answer' => 'A',
                            'explanation' => 'Kedua himpunan memiliki anggota yang sama meskipun urutannya berbeda.',
                        ],
                    ],
                    4 => [
                        'type' => 'content',
                        'title' => 'Himpunan Lepas dan Bersilangan',
                        'subtitle' => 'Membaca hubungan melalui irisan',
                        'paragraphs' => [
                            'Dua himpunan disebut lepas atau disjoint apabila tidak mempunyai anggota bersama. Secara simbolik kondisi ini ditulis A ∩ B = ∅. Pada diagram Venn, dua himpunan lepas digambarkan dengan dua daerah yang tidak saling bertumpang tindih.',
                            'Sebaliknya, dua himpunan disebut bersilangan apabila memiliki sekurang-kurangnya satu anggota bersama. Kondisi ini ditulis A ∩ B ≠ ∅. Pada diagram Venn, daerah kedua himpunan saling bertumpang tindih dan anggota bersama ditempatkan pada daerah irisan tersebut.',
                            'Contoh himpunan lepas adalah C = {a, b, c} dan D = {d, e, f}. Tidak ada satu pun anggota yang sama sehingga C ∩ D = ∅. Contoh himpunan bersilangan adalah E = {1, 2, 3, 4} dan F = {3, 4, 5}; anggota 3 dan 4 terdapat pada keduanya.',
                            'Menentukan apakah himpunan lepas atau bersilangan dapat dilakukan dengan mencari irisannya. Jika hasil irisan kosong, kedua himpunan lepas. Jika terdapat setidaknya satu anggota pada hasil irisan, kedua himpunan bersilangan.',
                        ],
                        'example' => [
                            'title' => 'Contoh',
                            'lines' => [
                                'C={a,b,c} dan D={d,e,f} adalah himpunan lepas.',
                                'E={1,2,3,4} dan F={3,4,5} adalah himpunan bersilangan karena 3 dan 4 merupakan anggota bersama.',
                            ],
                        ],
                        'note' => 'Diagram Venn untuk himpunan lepas tidak saling bertumpang tindih; untuk himpunan bersilangan terdapat daerah perpotongan.',
                        'visual' => 'venn-overlap',
                        'checkpoint' => [
                            'question' => 'Jika C={a,b,c} dan D={d,e,f}, maka ...',
                            'options' => ['A' => 'C = D', 'B' => 'C dan D lepas', 'C' => 'C dan D bersilangan', 'D' => 'C ⊆ D'],
                            'answer' => 'B',
                            'explanation' => 'Tidak ada anggota yang sama sehingga C ∩ D = ∅.',
                        ],
                    ],
                    5 => [
                        'type' => 'content',
                        'title' => 'Himpunan Ekuivalen',
                        'subtitle' => 'Kardinalitas yang sama',
                        'paragraphs' => [
                            'Dua himpunan disebut ekuivalen apabila mempunyai jumlah anggota yang sama, walaupun jenis anggotanya dapat berbeda. Jika A dan B ekuivalen, maka n(A) = n(B). Salah satu notasi yang dapat digunakan adalah A ~ B.',
                            'Contohnya A = {a, b, c} dan B = {1, 2, 3}. Kedua himpunan tidak sama karena anggotanya berbeda, tetapi keduanya ekuivalen karena masing-masing mempunyai tiga anggota.',
                            'Kesamaan himpunan dan ekuivalensi merupakan konsep yang berbeda. Himpunan yang sama pasti mempunyai kardinalitas yang sama, tetapi dua himpunan dengan kardinalitas yang sama belum tentu merupakan himpunan yang sama.',
                            'Konsep ekuivalensi berguna ketika membandingkan ukuran himpunan tanpa memperhatikan jenis anggotanya. Karena itu, langkah pertama yang dapat dilakukan adalah menghitung kardinalitas masing-masing himpunan.',
                        ],
                        'example' => [
                            'title' => 'Contoh',
                            'lines' => [
                                'A={a,b,c} dan B={1,2,3}.',
                                'n(A)=3 dan n(B)=3, sehingga A ~ B.',
                            ],
                        ],
                        'note' => 'Ekuivalen tidak berarti sama. Anggota boleh berbeda selama jumlahnya sama.',
                        'visual' => 'equivalent-sets',
                        'checkpoint' => [
                            'question' => 'A={a,b,c} dan B={1,2,3}. Hubungan yang tepat adalah ...',
                            'options' => ['A' => 'A = B', 'B' => 'A ~ B', 'C' => 'A ∩ B ≠ ∅', 'D' => 'A ⊂ B'],
                            'answer' => 'B',
                            'explanation' => 'Kedua himpunan memiliki tiga anggota sehingga ekuivalen.',
                        ],
                    ],
                    6 => [
                        'type' => 'final_quiz',
                        'title' => 'Evaluasi Subbab 3',
                        'subtitle' => 'Venn Master',
                        'questions' => [
                            [
                                'question' => '{x | 3<x<4, x bilangan bulat} adalah ...',
                                'options' => ['A' => '{3}', 'B' => '{4}', 'C' => '∅', 'D' => '{3,4}'],
                                'answer' => 'C',
                                'explanation' => 'Tidak ada bilangan bulat di antara 3 dan 4.',
                            ],
                            [
                                'question' => 'A={1,2,3} dan B={3,2,1}. Maka ...',
                                'options' => ['A' => 'A=B', 'B' => 'A dan B lepas', 'C' => 'A~B saja tetapi tidak sama', 'D' => 'A⊂B'],
                                'answer' => 'A',
                                'explanation' => 'Anggota A dan B sama.',
                            ],
                            [
                                'question' => 'C={a,b,c} dan D={d,e,f}. Maka ...',
                                'options' => ['A' => 'C∩D=∅', 'B' => 'C=D', 'C' => 'C⊂D', 'D' => 'C∩D={a}'],
                                'answer' => 'A',
                                'explanation' => 'C dan D tidak mempunyai anggota bersama.',
                            ],
                            [
                                'question' => 'E={1,2,3,4} dan F={3,4,5}. Maka E dan F ...',
                                'options' => ['A' => 'Lepas', 'B' => 'Bersilangan', 'C' => 'Sama', 'D' => 'Kosong'],
                                'answer' => 'B',
                                'explanation' => 'E dan F memiliki anggota bersama 3 dan 4.',
                            ],
                            [
                                'question' => 'Dua himpunan disebut ekuivalen jika ...',
                                'options' => ['A' => 'Semua anggotanya sama', 'B' => 'Kardinalitasnya sama', 'C' => 'Irisannya kosong', 'D' => 'Semestanya sama'],
                                'answer' => 'B',
                                'explanation' => 'Ekuivalensi ditentukan oleh kesamaan banyak anggota.',
                            ],
                        ],
                    ],
                ],
            ],

            4 => [
                'level' => 4,
                'nama' => 'Subset Master',
                'judul' => 'Himpunan Bagian dan Himpunan Kuasa',
                'simbol' => '⊆',
                'deskripsi' => 'Mempelajari subset, subset sejati, dan seluruh himpunan bagian melalui himpunan kuasa.',
                'challenge' => 'Subset Mission',
                'topik' => [
                    'Himpunan bagian atau subset',
                    'Himpunan bagian sejati',
                    'Menentukan subset',
                    'Himpunan kuasa P(A)',
                    'Banyak anggota himpunan kuasa',
                ],
                'tujuan' => [
                    'Menentukan apakah suatu himpunan merupakan subset dari himpunan lain.',
                    'Membedakan subset dan subset sejati.',
                    'Menuliskan semua subset sebuah himpunan sederhana.',
                    'Menentukan himpunan kuasa dan banyak anggotanya.',
                ],
                'pages' => [
                    1 => [
                        'type' => 'content',
                        'title' => 'Himpunan Bagian atau Subset',
                        'subtitle' => 'Memahami hubungan A ⊆ B',
                        'paragraphs' => [
                            'Himpunan A disebut himpunan bagian atau subset dari B apabila setiap anggota A juga merupakan anggota B. Hubungan ini dinotasikan A ⊆ B. Jadi yang diperiksa bukan apakah A dan B mempunyai beberapa anggota yang sama, tetapi apakah seluruh anggota A terdapat di B.',
                            'Sebagai contoh, A = {1, 2} dan B = {1, 2, 3, 4}. Karena setiap anggota A terdapat di B, maka A ⊆ B. Namun B bukan subset dari A karena anggota 3 dan 4 tidak terdapat di A.',
                            'Setiap himpunan merupakan subset dari dirinya sendiri, sehingga A ⊆ A selalu benar. Selain itu, himpunan kosong merupakan subset dari setiap himpunan. Kedua fakta ini penting ketika menyusun semua subset suatu himpunan.',
                            'Untuk memeriksa hubungan subset, telusuri setiap anggota himpunan yang berada di sebelah kiri simbol ⊆. Jika ditemukan satu saja anggota yang tidak terdapat pada himpunan di sebelah kanan, maka hubungan subset tersebut tidak benar.',
                        ],
                        'example' => [
                            'title' => 'Contoh',
                            'lines' => [
                                'A={1,2} dan B={1,2,3,4}.',
                                'Karena 1 dan 2 juga terdapat di B, maka A ⊆ B.',
                            ],
                        ],
                        'note' => 'Setiap himpunan merupakan subset dari dirinya sendiri.',
                        'visual' => 'subset',
                        'checkpoint' => [
                            'question' => 'Jika A={1,2} dan B={1,2,3,4}, pernyataan yang benar adalah ...',
                            'options' => ['A' => 'A ⊆ B', 'B' => 'B ⊆ A', 'C' => 'A ∩ B = ∅', 'D' => 'A = B'],
                            'answer' => 'A',
                            'explanation' => 'Semua anggota A terdapat di B.',
                        ],
                    ],
                    2 => [
                        'type' => 'content',
                        'title' => 'Himpunan Bagian Sejati',
                        'subtitle' => 'Subset yang tidak sama dengan himpunan induknya',
                        'paragraphs' => [
                            'Himpunan bagian sejati adalah subset yang tidak sama dengan himpunan induknya. Jika A ⊆ B dan terdapat setidaknya satu anggota B yang tidak terdapat di A, maka A disebut himpunan bagian sejati dari B. Hubungan ini dapat ditulis A ⊂ B.',
                            'Contohnya A = {1, 2} dan B = {1, 2, 3}. A merupakan subset B dan A tidak sama dengan B karena B mempunyai anggota 3 yang tidak terdapat pada A. Oleh karena itu A ⊂ B.',
                            'Perbedaan utama antara subset dan subset sejati terletak pada kemungkinan kesamaan. A ⊆ B masih memungkinkan A = B, sedangkan A ⊂ B menegaskan bahwa A bukan B.',
                            'Ketika menjawab soal, periksa dua kondisi secara berurutan: pertama pastikan semua anggota A terdapat di B, kemudian periksa apakah B mempunyai anggota tambahan. Jika kedua kondisi terpenuhi, A adalah himpunan bagian sejati dari B.',
                        ],
                        'example' => [
                            'title' => 'Contoh',
                            'lines' => [
                                'A={1,2} dan B={1,2,3}.',
                                'A ⊂ B karena semua anggota A ada di B dan B mempunyai anggota tambahan, yaitu 3.',
                            ],
                        ],
                        'note' => 'A ⊂ B menyatakan A benar-benar lebih kecil sebagai himpunan daripada B.',
                        'visual' => 'proper-subset',
                        'checkpoint' => [
                            'question' => 'Jika A={1,2} dan B={1,2,3}, maka ...',
                            'options' => ['A' => 'A=B', 'B' => 'A⊂B', 'C' => 'B⊂A', 'D' => 'A∩B=∅'],
                            'answer' => 'B',
                            'explanation' => 'A merupakan subset B dan B memiliki anggota tambahan.',
                        ],
                    ],
                    3 => [
                        'type' => 'content',
                        'title' => 'Menentukan Semua Subset',
                        'subtitle' => 'Menyusun himpunan bagian secara sistematis',
                        'paragraphs' => [
                            'Untuk menentukan semua subset suatu himpunan, kita perlu membentuk setiap kemungkinan pilihan anggota, mulai dari tidak memilih anggota sama sekali sampai memilih seluruh anggota. Karena itu himpunan kosong dan himpunan itu sendiri selalu termasuk dalam daftar subset.',
                            'Jika A = {a, b}, subset-subsetnya adalah ∅, {a}, {b}, dan {a, b}. Kita dapat mengelompokkannya berdasarkan banyak anggota: subset tanpa anggota, subset beranggota satu, lalu subset beranggota dua.',
                            'Untuk himpunan dengan lebih banyak anggota, proses pencarian subset harus dilakukan secara sistematis agar tidak ada kombinasi yang terlewat. Salah satu cara adalah mengelompokkan subset berdasarkan ukuran atau banyak anggotanya.',
                            'Jumlah seluruh subset dari himpunan yang memiliki n anggota adalah 2ⁿ. Rumus ini dapat digunakan untuk memeriksa apakah daftar subset yang dibuat sudah lengkap.',
                        ],
                        'example' => [
                            'title' => 'Contoh',
                            'lines' => [
                                'Jika A={a,b}, semua subset A adalah ∅, {a}, {b}, dan {a,b}.',
                            ],
                        ],
                        'note' => 'Mengelompokkan subset berdasarkan banyak anggota membantu menghindari subset yang terlewat.',
                        'visual' => 'subset-list',
                        'checkpoint' => [
                            'question' => 'Berapa banyak subset dari A={a,b}?',
                            'options' => ['A' => '2', 'B' => '3', 'C' => '4', 'D' => '6'],
                            'answer' => 'C',
                            'explanation' => 'Subsetnya adalah ∅, {a}, {b}, dan {a,b}.',
                        ],
                    ],
                    4 => [
                        'type' => 'content',
                        'title' => 'Himpunan Kuasa',
                        'subtitle' => 'Mengumpulkan seluruh subset menjadi P(A)',
                        'paragraphs' => [
                            'Himpunan kuasa dari A, ditulis P(A), adalah himpunan yang anggotanya berupa seluruh subset dari A. Karena himpunan kosong dan A sendiri merupakan subset dari A, keduanya selalu terdapat di dalam P(A).',
                            'Jika A = {a, b}, maka P(A) = {∅, {a}, {b}, {a, b}}. Perhatikan bahwa anggota P(A) bukan lagi elemen tunggal a atau b, melainkan himpunan-himpunan yang menjadi subset dari A.',
                            'Jika n(A) = n, maka banyak anggota himpunan kuasa adalah |P(A)| = 2ⁿ. Contohnya jika A mempunyai 3 anggota, maka P(A) mempunyai 2³ = 8 anggota.',
                            'Konsep himpunan kuasa memperlihatkan hubungan antara sebuah himpunan dengan seluruh kemungkinan subsetnya. Pemahaman ini juga membantu ketika mempelajari relasi, karena relasi dapat dipandang sebagai himpunan bagian dari suatu produk Kartesius.',
                        ],
                        'example' => [
                            'title' => 'Contoh',
                            'lines' => [
                                'A={a,b,c}.',
                                'P(A)={∅,{a},{b},{c},{a,b},{a,c},{b,c},{a,b,c}}.',
                                '|P(A)|=8=2³.',
                            ],
                        ],
                        'note' => 'Rumus 2ⁿ menunjukkan setiap anggota A memiliki dua kemungkinan pada subset: dipilih atau tidak dipilih.',
                        'visual' => 'power-set',
                        'checkpoint' => [
                            'question' => 'Jika n(A)=5, maka |P(A)| adalah ...',
                            'options' => ['A' => '5', 'B' => '10', 'C' => '25', 'D' => '32'],
                            'answer' => 'D',
                            'explanation' => '|P(A)|=2⁵=32.',
                        ],
                    ],
                    5 => [
                        'type' => 'final_quiz',
                        'title' => 'Evaluasi Subbab 4',
                        'subtitle' => 'Subset Master',
                        'questions' => [
                            [
                                'question' => 'A={1,2} dan B={1,2,3,4}. Maka ...',
                                'options' => ['A' => 'A⊆B', 'B' => 'B⊆A', 'C' => 'A=B', 'D' => 'A∩B=∅'],
                                'answer' => 'A',
                                'explanation' => 'Semua anggota A terdapat di B.',
                            ],
                            [
                                'question' => 'Semua subset A={a,b} adalah ...',
                                'options' => ['A' => '{a},{b}', 'B' => '∅,{a},{b},{a,b}', 'C' => '{a,b}', 'D' => '∅,{a,b}'],
                                'answer' => 'B',
                                'explanation' => 'P(A) harus memuat himpunan kosong, subset satu anggota, dan A sendiri.',
                            ],
                            [
                                'question' => 'Jika A={1,2,3}, maka |P(A)|= ...',
                                'options' => ['A' => '3', 'B' => '6', 'C' => '8', 'D' => '9'],
                                'answer' => 'C',
                                'explanation' => '2³=8.',
                            ],
                            [
                                'question' => 'Jika n(A)=5, banyak anggota P(A) adalah ...',
                                'options' => ['A' => '10', 'B' => '25', 'C' => '32', 'D' => '64'],
                                'answer' => 'C',
                                'explanation' => '2⁵=32.',
                            ],
                            [
                                'question' => 'Jika A⊆B dan A≠B, hubungan yang lebih khusus dapat ditulis ...',
                                'options' => ['A' => 'A⊂B', 'B' => 'A=B', 'C' => 'A∩B=∅', 'D' => 'B⊂A'],
                                'answer' => 'A',
                                'explanation' => 'A merupakan himpunan bagian sejati dari B.',
                            ],
                        ],
                    ],
                ],
            ],

            5 => [
                'level' => 5,
                'nama' => 'Operation Master',
                'judul' => 'Operasi dan Sifat Operasi Himpunan',
                'simbol' => '∪',
                'deskripsi' => 'Menguasai irisan, gabungan, komplemen, selisih, beda setangkup, dan sifat-sifat operasi himpunan.',
                'challenge' => 'Operation Arena',
                'topik' => [
                    'Irisan',
                    'Gabungan',
                    'Komplemen',
                    'Selisih',
                    'Beda setangkup',
                    'Sifat-sifat operasi himpunan',
                ],
                'tujuan' => [
                    'Menentukan hasil irisan dan gabungan dua himpunan.',
                    'Menentukan komplemen dan selisih himpunan.',
                    'Menentukan beda setangkup dua himpunan.',
                    'Menggunakan sifat operasi himpunan untuk menyederhanakan bentuk himpunan.',
                ],
                'pages' => [
                    1 => [
                        'type' => 'content',
                        'title' => 'Irisan',
                        'subtitle' => 'Anggota yang berada pada kedua himpunan',
                        'paragraphs' => [
                            'Irisan dua himpunan A dan B adalah himpunan yang memuat anggota yang terdapat pada A dan B secara bersamaan. Operasi ini dinotasikan A ∩ B. Kata kunci yang dapat membantu adalah \'dan\' karena sebuah elemen harus memenuhi keanggotaan pada kedua himpunan.',
                            'Jika A = {1, 2, 3, 4} dan B = {3, 4, 5, 6}, maka A ∩ B = {3, 4}. Anggota 1 dan 2 hanya terdapat di A, sedangkan 5 dan 6 hanya terdapat di B, sehingga tidak termasuk dalam irisan.',
                            'Pada diagram Venn, irisan ditunjukkan oleh daerah yang saling bertumpang tindih. Semua elemen yang ditempatkan pada daerah tersebut merupakan anggota bersama kedua himpunan.',
                            'Jika A dan B tidak mempunyai anggota yang sama, hasil irisannya adalah himpunan kosong. Kondisi A ∩ B = ∅ menunjukkan bahwa kedua himpunan tersebut lepas.',
                        ],
                        'example' => [
                            'title' => 'Contoh',
                            'lines' => [
                                'A={1,2,3,4} dan B={3,4,5,6}.',
                                'A∩B={3,4}.',
                            ],
                        ],
                        'note' => 'Cari hanya anggota yang muncul di kedua himpunan.',
                        'visual' => 'venn-intersection',
                        'checkpoint' => [
                            'question' => 'A={1,2,3,4} dan B={3,4,5,6}. A∩B adalah ...',
                            'options' => ['A' => '{1,2}', 'B' => '{3,4}', 'C' => '{5,6}', 'D' => '{1,2,3,4,5,6}'],
                            'answer' => 'B',
                            'explanation' => '3 dan 4 terdapat di A sekaligus B.',
                        ],
                    ],
                    2 => [
                        'type' => 'content',
                        'title' => 'Gabungan',
                        'subtitle' => 'Semua anggota tanpa pengulangan',
                        'paragraphs' => [
                            'Gabungan A dan B adalah himpunan yang memuat semua anggota yang terdapat pada A atau B. Operasi ini ditulis A ∪ B. Anggota yang terdapat pada kedua himpunan tetap ditulis satu kali karena pengulangan tidak diperhitungkan dalam himpunan.',
                            'Jika A = {1, 2, 3, 4} dan B = {3, 4, 5, 6}, maka A ∪ B = {1, 2, 3, 4, 5, 6}. Anggota 3 dan 4 tidak ditulis dua kali walaupun terdapat pada A dan B.',
                            'Pada diagram Venn, gabungan mencakup seluruh daerah A dan seluruh daerah B, termasuk daerah perpotongannya. Kata kunci yang sering digunakan dalam soal adalah \'A atau B\' atau \'sekurang-kurangnya salah satu\'.',
                            'Dalam soal kardinalitas, banyak anggota gabungan dua himpunan dapat dihitung dengan n(A ∪ B) = n(A) + n(B) - n(A ∩ B). Irisan dikurangkan karena anggota pada bagian tersebut sebelumnya terhitung dua kali.',
                        ],
                        'example' => [
                            'title' => 'Contoh',
                            'lines' => [
                                'A={1,2,3} dan B={3,4,5}.',
                                'A∪B={1,2,3,4,5}.',
                            ],
                        ],
                        'note' => 'Jika anggota muncul pada kedua himpunan, tulis satu kali saja.',
                        'visual' => 'venn-union',
                        'checkpoint' => [
                            'question' => 'A={1,2,3} dan B={3,4,5}. A∪B adalah ...',
                            'options' => ['A' => '{3}', 'B' => '{1,2,4,5}', 'C' => '{1,2,3,4,5}', 'D' => '{1,2}'],
                            'answer' => 'C',
                            'explanation' => 'Gabungan memuat seluruh anggota A atau B tanpa pengulangan.',
                        ],
                    ],
                    3 => [
                        'type' => 'content',
                        'title' => 'Komplemen dan Selisih',
                        'subtitle' => 'Mencari anggota yang tidak termasuk bagian tertentu',
                        'paragraphs' => [
                            'Komplemen A adalah himpunan semua anggota semesta S yang tidak termasuk A. Komplemen dapat ditulis A′ atau Aᶜ. Karena bergantung pada himpunan semesta, semesta harus diketahui sebelum menentukan komplemen.',
                            'Jika S = {1, 2, 3, 4, 5, 6} dan A = {2, 4, 6}, maka A′ = {1, 3, 5}. Setiap anggota semesta diperiksa, lalu anggota yang tidak terdapat pada A dimasukkan ke dalam komplemen.',
                            'Selisih A terhadap B, ditulis A - B, adalah himpunan anggota A yang bukan anggota B. Operasi ini tidak bersifat komutatif, sehingga A - B pada umumnya berbeda dengan B - A.',
                            'Sebagai contoh, jika A = {1, 2, 3, 4} dan B = {3, 4, 5}, maka A - B = {1, 2}, sedangkan B - A = {5}. Perhatikan dari himpunan mana proses pengurangan dimulai.',
                        ],
                        'example' => [
                            'title' => 'Contoh',
                            'lines' => [
                                'S={1,2,3,4,5,6,7,8}, A={2,4,6,8}; maka A′={1,3,5,7}.',
                                'A={1,2,3,4}, B={3,4,5}; maka A−B={1,2}.',
                            ],
                        ],
                        'note' => 'Komplemen selalu bergantung pada semesta yang digunakan.',
                        'visual' => 'venn-difference',
                        'checkpoint' => [
                            'question' => 'S={1,2,3,4,5,6}, A={2,4,6}. A′ adalah ...',
                            'options' => ['A' => '{1,3,5}', 'B' => '{2,4,6}', 'C' => '{1,2,3}', 'D' => '∅'],
                            'answer' => 'A',
                            'explanation' => 'Anggota semesta yang tidak berada di A adalah 1,3,5.',
                        ],
                    ],
                    4 => [
                        'type' => 'content',
                        'title' => 'Beda Setangkup',
                        'subtitle' => 'Anggota yang berada tepat pada salah satu himpunan',
                        'paragraphs' => [
                            'Beda setangkup atau beda simetris A dan B memuat anggota yang berada tepat pada salah satu dari dua himpunan, tetapi tidak berada pada keduanya sekaligus. Operasi ini dapat dinotasikan dengan A △ B.',
                            'Beda setangkup dapat dinyatakan sebagai (A - B) ∪ (B - A). Artinya, kita mengambil anggota yang hanya berada pada A dan anggota yang hanya berada pada B, kemudian menggabungkannya.',
                            'Jika A = {1, 2, 3, 4} dan B = {3, 4, 5, 6}, maka A - B = {1, 2} dan B - A = {5, 6}. Karena itu A △ B = {1, 2, 5, 6}.',
                            'Pada diagram Venn, daerah beda setangkup adalah dua bagian luar dari A dan B tanpa daerah irisan. Jadi anggota yang dimiliki bersama oleh kedua himpunan tidak termasuk dalam hasil.',
                        ],
                        'example' => [
                            'title' => 'Contoh',
                            'lines' => [
                                'A={1,2,3,4}, B={3,4,5,6}.',
                                'A−B={1,2} dan B−A={5,6}.',
                                'A△B={1,2,5,6}.',
                            ],
                        ],
                        'note' => 'Anggota pada daerah irisan tidak masuk ke dalam beda setangkup.',
                        'visual' => 'venn-symmetric',
                        'checkpoint' => [
                            'question' => 'A={1,2,3,4}, B={3,4,5,6}. A△B adalah ...',
                            'options' => ['A' => '{3,4}', 'B' => '{1,2,5,6}', 'C' => '{1,2,3,4,5,6}', 'D' => '∅'],
                            'answer' => 'B',
                            'explanation' => 'Beda setangkup mengambil anggota yang hanya berada di salah satu himpunan.',
                        ],
                    ],
                    5 => [
                        'type' => 'content',
                        'title' => 'Sifat-sifat Operasi Himpunan',
                        'subtitle' => 'Menyederhanakan dan memeriksa bentuk himpunan',
                        'paragraphs' => [
                            'Operasi himpunan mempunyai sejumlah sifat yang membantu menyederhanakan bentuk dan memeriksa kebenaran suatu pernyataan. Sifat yang digunakan dalam modul meliputi identitas, dominasi, komplemen, idempoten, penyerapan, komutatif, asosiatif, distributif, dan hukum De Morgan.',
                            'Sifat identitas antara lain A ∪ ∅ = A dan A ∩ S = A. Sifat dominasi menyatakan A ∩ ∅ = ∅ dan A ∪ S = S. Sifat idempoten menyatakan bahwa menggabungkan atau mengiris suatu himpunan dengan dirinya sendiri tidak mengubah himpunan tersebut.',
                            'Sifat komutatif menunjukkan bahwa urutan A dan B dapat dipertukarkan pada irisan dan gabungan, sedangkan sifat asosiatif mengatur cara pengelompokan tiga himpunan. Sifat distributif menghubungkan operasi irisan dan gabungan dalam bentuk yang serupa dengan distributif pada aljabar.',
                            'Hukum De Morgan sangat penting saat bekerja dengan komplemen, yaitu (A ∪ B)′ = A′ ∩ B′ dan (A ∩ B)′ = A′ ∪ B′. Untuk menggunakannya dengan benar, perhatikan bahwa operasi gabungan berubah menjadi irisan dan sebaliknya setelah komplemen didistribusikan.',
                        ],
                        'example' => [
                            'title' => 'Beberapa sifat',
                            'lines' => [
                                'A∪∅=A dan A∩S=A.',
                                'A∪A=A dan A∩A=A.',
                                'A∪B=B∪A dan A∩B=B∩A.',
                            ],
                        ],
                        'note' => 'Sifat operasi membantu memeriksa apakah dua bentuk himpunan sebenarnya ekuivalen.',
                        'visual' => 'laws',
                        'checkpoint' => [
                            'question' => 'Menurut hukum De Morgan, (A∪B)′ sama dengan ...',
                            'options' => ['A' => 'A′∪B′', 'B' => 'A′∩B′', 'C' => 'A∩B', 'D' => 'A−B'],
                            'answer' => 'B',
                            'explanation' => 'Komplemen dari gabungan sama dengan irisan dari komplemen masing-masing himpunan.',
                        ],
                    ],
                    6 => [
                        'type' => 'final_quiz',
                        'title' => 'Evaluasi Subbab 5',
                        'subtitle' => 'Operation Master',
                        'questions' => [
                            [
                                'question' => 'A={1,2,3,4} dan B={3,4,5,6}. A∩B adalah ...',
                                'options' => ['A' => '{1,2}', 'B' => '{3,4}', 'C' => '{5,6}', 'D' => '{1,2,3,4,5,6}'],
                                'answer' => 'B',
                                'explanation' => 'Irisan berisi anggota bersama.',
                            ],
                            [
                                'question' => 'A={1,2,3,4} dan B={3,4,5,6}. A∪B adalah ...',
                                'options' => ['A' => '{3,4}', 'B' => '{1,2,5,6}', 'C' => '{1,2,3,4,5,6}', 'D' => '∅'],
                                'answer' => 'C',
                                'explanation' => 'Gabungan memuat seluruh anggota tanpa pengulangan.',
                            ],
                            [
                                'question' => 'S={1,2,3,4,5,6,7,8}, A={2,4,6,8}. A′ adalah ...',
                                'options' => ['A' => '{1,3,5,7}', 'B' => '{2,4,6,8}', 'C' => '{1,2,3,4}', 'D' => '∅'],
                                'answer' => 'A',
                                'explanation' => 'Komplemen A berisi anggota S yang tidak terdapat di A.',
                            ],
                            [
                                'question' => 'A△B untuk A={1,2,3,4} dan B={3,4,5,6} adalah ...',
                                'options' => ['A' => '{3,4}', 'B' => '{1,2,5,6}', 'C' => '{1,2,3,4,5,6}', 'D' => '{1,2}'],
                                'answer' => 'B',
                                'explanation' => 'Anggota irisan 3 dan 4 tidak termasuk beda setangkup.',
                            ],
                            [
                                'question' => '(A∪B)′ menurut De Morgan sama dengan ...',
                                'options' => ['A' => 'A′∪B′', 'B' => 'A′∩B′', 'C' => 'A∩B', 'D' => 'A−B'],
                                'answer' => 'B',
                                'explanation' => 'Itulah bentuk hukum De Morgan untuk komplemen gabungan.',
                            ],
                        ],
                    ],
                ],
            ],

            6 => [
                'level' => 6,
                'nama' => 'Himpunan Master',
                'judul' => 'Penerapan Himpunan, Relasi, dan Fungsi',
                'simbol' => '★',
                'deskripsi' => 'Menerapkan konsep himpunan dalam pemecahan masalah serta menghubungkannya dengan pengantar relasi dan fungsi.',
                'challenge' => 'Final Challenge',
                'topik' => [
                    'Penerapan himpunan pada masalah kontekstual',
                    'Pemecahan masalah dengan diagram Venn',
                    'Produk Kartesius',
                    'Pengertian relasi',
                    'Domain, kodomain, dan range',
                    'Pengertian fungsi',
                    'Fungsi dan bukan fungsi',
                    'Representasi relasi dan fungsi',
                ],
                'tujuan' => [
                    'Menerapkan konsep himpunan pada masalah kontekstual.',
                    'Menggunakan diagram Venn untuk menyelesaikan masalah.',
                    'Menjelaskan hubungan himpunan dengan produk Kartesius, relasi, dan fungsi.',
                    'Menentukan domain, kodomain, dan range suatu relasi.',
                    'Membedakan relasi yang merupakan fungsi dan bukan fungsi.',
                ],
                'pages' => [
                    1 => [
                        'type' => 'content',
                        'title' => 'Penerapan Himpunan',
                        'subtitle' => 'Menggunakan himpunan untuk memodelkan data',
                        'paragraphs' => [
                            'Konsep himpunan dapat digunakan untuk memodelkan kelompok data dalam kehidupan sehari-hari. Misalnya, mahasiswa dapat dikelompokkan berdasarkan minat, pilihan mata kuliah, kegiatan organisasi, atau karakteristik lain yang dapat ditentukan dengan jelas.',
                            'Diagram Venn membantu memperlihatkan apakah seseorang hanya termasuk satu kelompok, termasuk beberapa kelompok sekaligus, atau tidak termasuk kelompok mana pun. Representasi ini membuat informasi yang berbentuk angka menjadi lebih mudah dianalisis.',
                            'Untuk dua kelompok P dan M, banyak anggota yang berada pada sekurang-kurangnya salah satu kelompok dapat dihitung dengan n(P ∪ M) = n(P) + n(M) - n(P ∩ M). Pengurangan bagian irisan diperlukan agar anggota yang mengikuti kedua kelompok tidak dihitung dua kali.',
                            'Dalam contoh modul, terdapat 40 mahasiswa, 24 menyukai pemrograman, 18 menyukai matematika, dan 10 menyukai keduanya. Maka n(P ∪ M) = 24 + 18 - 10 = 32. Karena total mahasiswa 40, terdapat 40 - 32 = 8 mahasiswa yang tidak termasuk kedua kelompok.',
                        ],
                        'example' => [
                            'title' => 'Contoh dari modul',
                            'lines' => [
                                'Dalam kelas 40 mahasiswa, 24 menyukai pemrograman, 18 menyukai matematika, dan 10 menyukai keduanya.',
                                'n(P∪M)=24+18−10=32.',
                                'Jadi 32 mahasiswa menyukai minimal salah satu dari dua bidang tersebut.',
                            ],
                        ],
                        'note' => 'Sisa mahasiswa di luar P∪M dapat dihitung dari jumlah seluruh mahasiswa dikurangi n(P∪M).',
                        'visual' => 'venn-application',
                        'checkpoint' => [
                            'question' => 'Dari 40 mahasiswa, 24 menyukai P, 18 menyukai M, dan 10 menyukai keduanya. Berapa yang menyukai minimal salah satu?',
                            'options' => ['A' => '28', 'B' => '30', 'C' => '32', 'D' => '42'],
                            'answer' => 'C',
                            'explanation' => '24+18−10=32.',
                        ],
                    ],
                    2 => [
                        'type' => 'content',
                        'title' => 'Pemecahan Masalah dengan Diagram Venn',
                        'subtitle' => 'Membaca daerah hanya A, hanya B, keduanya, dan di luar keduanya',
                        'paragraphs' => [
                            'Dalam soal cerita yang melibatkan dua kelompok, langkah pertama adalah menentukan himpunan semesta dan setiap himpunan yang dibicarakan. Setelah itu identifikasi data yang menunjukkan anggota kedua kelompok, anggota hanya satu kelompok, dan anggota di luar kedua kelompok.',
                            'Bagian irisan sebaiknya diisi terlebih dahulu karena data \'keduanya\' menjadi dasar untuk menentukan bagian hanya A dan hanya B. Jika n(A) adalah jumlah seluruh anggota A dan n(A ∩ B) diketahui, maka jumlah hanya A diperoleh dari n(A) - n(A ∩ B).',
                            'Setelah daerah hanya A, irisan, dan hanya B diketahui, gabungan dapat dihitung dengan menjumlahkan ketiga daerah tersebut. Jika jumlah seluruh semesta diketahui, anggota yang tidak termasuk A maupun B diperoleh dari n(S) - n(A ∪ B).',
                            'Strategi ini mengurangi kesalahan hitung karena setiap bagian pada diagram mempunyai makna yang jelas. Selalu cocokkan kembali jumlah seluruh daerah dengan jumlah anggota semesta sebagai langkah pemeriksaan akhir.',
                        ],
                        'example' => [
                            'title' => 'Contoh',
                            'lines' => [
                                'Dari 40 mahasiswa tadi, hanya pemrograman = 24−10=14.',
                                'Hanya matematika = 18−10=8.',
                                'Tidak menyukai keduanya = 40−32=8.',
                            ],
                        ],
                        'note' => 'Urutan aman: isi irisan → hitung hanya masing-masing himpunan → hitung gabungan → hitung bagian luar.',
                        'visual' => 'venn-application',
                        'checkpoint' => [
                            'question' => 'Pada data 40 mahasiswa tersebut, berapa yang tidak menyukai pemrograman maupun matematika?',
                            'options' => ['A' => '8', 'B' => '10', 'C' => '14', 'D' => '18'],
                            'answer' => 'A',
                            'explanation' => 'n(P∪M)=32, sehingga di luar kedua himpunan ada 40−32=8 mahasiswa.',
                        ],
                    ],
                    3 => [
                        'type' => 'content',
                        'title' => 'Produk Kartesius',
                        'subtitle' => 'Pengayaan: jembatan dari himpunan menuju relasi',
                        'pengayaan' => true,
                        'paragraphs' => [
                            'Produk Kartesius merupakan pengayaan yang menghubungkan konsep himpunan dengan materi relasi dan fungsi. Produk Kartesius A × B adalah himpunan semua pasangan berurutan (a, b) dengan a merupakan anggota A dan b merupakan anggota B.',
                            'Pasangan berurutan memperhatikan posisi. Pasangan (1, a) tidak sama dengan (a, 1) karena komponen pertama dan kedua mempunyai peran yang berbeda. Oleh sebab itu A × B pada umumnya tidak sama dengan B × A.',
                            'Jika A = {1, 2} dan B = {a, b}, maka A × B = {(1,a), (1,b), (2,a), (2,b)}. Setiap anggota A dipasangkan dengan setiap anggota B sehingga semua kemungkinan pasangan terbentuk.',
                            'Jika n(A) = m dan n(B) = n, maka banyak pasangan pada A × B adalah m × n. Produk Kartesius menjadi dasar pembentukan relasi karena sebuah relasi dari A ke B dapat dipilih dari pasangan-pasangan yang terdapat pada A × B.',
                        ],
                        'example' => [
                            'title' => 'Contoh pengayaan',
                            'lines' => [
                                'A={1,2} dan B={a,b}.',
                                'A×B={(1,a),(1,b),(2,a),(2,b)}.',
                            ],
                        ],
                        'note' => 'Urutan pada pasangan berurutan penting: (1,a) tidak sama dengan (a,1).',
                        'visual' => 'cartesian',
                        'checkpoint' => [
                            'question' => 'Jika A={1,2} dan B={a,b}, berapa banyak anggota A×B?',
                            'options' => ['A' => '2', 'B' => '3', 'C' => '4', 'D' => '6'],
                            'answer' => 'C',
                            'explanation' => 'n(A×B)=n(A)×n(B)=2×2=4.',
                        ],
                    ],
                    4 => [
                        'type' => 'content',
                        'title' => 'Pengertian Relasi',
                        'subtitle' => 'Pengayaan: hubungan antara dua himpunan',
                        'pengayaan' => true,
                        'paragraphs' => [
                            'Relasi dari himpunan A ke himpunan B adalah hubungan yang memasangkan anggota A dengan anggota B berdasarkan aturan tertentu. Relasi dapat dinyatakan melalui pasangan berurutan, diagram panah, tabel, atau bentuk representasi lain yang menunjukkan pasangan yang terbentuk.',
                            'Dalam sudut pandang himpunan, relasi dari A ke B merupakan himpunan bagian dari A × B. Artinya, tidak semua pasangan pada produk Kartesius harus digunakan; relasi hanya memilih pasangan yang memenuhi aturan hubungan yang sedang dibahas.',
                            'Misalnya A = {1, 2, 3} dan B = {a, b}. Jika relasi R = {(1,a), (2,a), (3,b)}, maka R menghubungkan 1 dengan a, 2 dengan a, dan 3 dengan b. Pasangan yang tidak tercantum bukan bagian dari relasi tersebut.',
                            'Relasi belum tentu merupakan fungsi. Sebuah relasi dapat memasangkan satu anggota domain dengan lebih dari satu anggota kodomain atau bahkan tidak memasangkan sebagian anggota domain. Syarat yang lebih khusus baru diterapkan ketika kita membahas fungsi.',
                        ],
                        'example' => [
                            'title' => 'Contoh pengayaan',
                            'lines' => [
                                'A={1,2,3}, B={2,4,6}.',
                                'Relasi “dua kali dari” dapat ditulis R={(1,2),(2,4),(3,6)}.',
                            ],
                        ],
                        'note' => 'Relasi dapat direpresentasikan dengan pasangan berurutan, diagram panah, tabel, atau grafik.',
                        'visual' => 'mapping-relation',
                        'checkpoint' => [
                            'question' => 'Relasi dari A ke B merupakan ...',
                            'options' => ['A' => 'Himpunan bagian dari A×B', 'B' => 'Selalu sama dengan A×B', 'C' => 'Himpunan kosong saja', 'D' => 'Gabungan A dan B'],
                            'answer' => 'A',
                            'explanation' => 'Secara formal, relasi dari A ke B adalah subset dari produk Kartesius A×B.',
                        ],
                    ],
                    5 => [
                        'type' => 'content',
                        'title' => 'Domain, Kodomain, dan Range',
                        'subtitle' => 'Pengayaan: membaca komponen sebuah relasi',
                        'pengayaan' => true,
                        'paragraphs' => [
                            'Pada relasi dan fungsi terdapat tiga istilah penting, yaitu domain, kodomain, dan range. Domain adalah himpunan asal yang menyediakan elemen pertama pada pasangan berurutan. Kodomain adalah himpunan tujuan yang telah ditentukan sebagai tempat kemungkinan hasil berada.',
                            'Range adalah bagian dari kodomain yang benar-benar memperoleh pasangan dari domain. Karena itu range selalu merupakan subset dari kodomain, tetapi range tidak harus sama dengan seluruh kodomain.',
                            'Sebagai contoh, A = {1, 2, 3} dan B = {a, b, c}, dengan R = {(1,a), (2,a), (3,b)}. Domainnya adalah {1, 2, 3}, kodomainnya {a, b, c}, sedangkan range-nya {a, b}. Elemen c berada pada kodomain tetapi tidak menjadi range karena tidak mendapat pasangan.',
                            'Membedakan kodomain dan range penting saat menentukan sifat suatu fungsi. Kodomain ditetapkan sejak awal, sedangkan range ditentukan oleh hasil pemetaan yang benar-benar terjadi.',
                        ],
                        'example' => [
                            'title' => 'Contoh pengayaan',
                            'lines' => [
                                'A={1,2,3}, B={a,b,c,d}, R={(1,a),(2,b),(3,b)}.',
                                'Domain={1,2,3}.',
                                'Kodomain={a,b,c,d}.',
                                'Range={a,b}.',
                            ],
                        ],
                        'note' => 'Range selalu merupakan subset dari kodomain.',
                        'visual' => 'domain-range',
                        'checkpoint' => [
                            'question' => 'Jika R={(1,a),(2,b),(3,b)} dengan kodomain B={a,b,c,d}, range R adalah ...',
                            'options' => ['A' => '{1,2,3}', 'B' => '{a,b}', 'C' => '{a,b,c,d}', 'D' => '{c,d}'],
                            'answer' => 'B',
                            'explanation' => 'Anggota kodomain yang benar-benar mendapat pasangan hanya a dan b.',
                        ],
                    ],
                    6 => [
                        'type' => 'content',
                        'title' => 'Pengertian Fungsi',
                        'subtitle' => 'Pengayaan: relasi khusus',
                        'pengayaan' => true,
                        'paragraphs' => [
                            'Fungsi adalah relasi khusus dari suatu himpunan domain ke himpunan kodomain. Syarat utamanya adalah setiap anggota domain harus mempunyai tepat satu pasangan di kodomain. Kata \'setiap\' dan \'tepat satu\' merupakan bagian terpenting dari definisi ini.',
                            'Satu anggota kodomain boleh menerima pasangan dari lebih dari satu anggota domain. Hal tersebut tidak melanggar definisi fungsi. Yang tidak diperbolehkan adalah satu anggota domain tidak mempunyai pasangan atau mempunyai dua pasangan berbeda.',
                            'Misalnya A = {1, 2, 3} dan B = {a, b}. Relasi f = {(1,a), (2,a), (3,b)} merupakan fungsi karena 1, 2, dan 3 masing-masing mempunyai tepat satu pasangan.',
                            'Fungsi dapat digambarkan dengan diagram panah. Untuk memeriksanya, perhatikan setiap elemen pada domain. Jika masing-masing memiliki satu dan hanya satu panah keluar, relasi tersebut memenuhi syarat sebagai fungsi.',
                        ],
                        'example' => [
                            'title' => 'Contoh pengayaan',
                            'lines' => [
                                'A={1,2,3}, B={a,b}.',
                                'f={(1,a),(2,a),(3,b)} merupakan fungsi dari A ke B.',
                            ],
                        ],
                        'note' => 'Kunci mengecek fungsi: setiap anggota domain harus muncul tepat satu kali sebagai komponen pertama.',
                        'visual' => 'mapping-function',
                        'checkpoint' => [
                            'question' => 'f={(1,a),(2,a),(3,b)} dari A={1,2,3} ke B={a,b} merupakan fungsi karena ...',
                            'options' => ['A' => 'Semua anggota B dipakai', 'B' => 'Setiap anggota A memiliki tepat satu pasangan', 'C' => 'A dan B memiliki banyak anggota sama', 'D' => 'Tidak ada pasangan berurutan'],
                            'answer' => 'B',
                            'explanation' => 'Syarat fungsi adalah setiap anggota domain mempunyai tepat satu pasangan di kodomain.',
                        ],
                    ],
                    7 => [
                        'type' => 'content',
                        'title' => 'Fungsi dan Bukan Fungsi',
                        'subtitle' => 'Pengayaan: menguji diagram dan pasangan berurutan',
                        'pengayaan' => true,
                        'paragraphs' => [
                            'Untuk menentukan apakah suatu relasi merupakan fungsi, fokuskan pemeriksaan pada anggota domain. Setiap anggota domain harus muncul atau mendapat pasangan, dan masing-masing hanya boleh mempunyai satu hasil.',
                            'Jika suatu anggota domain tidak mempunyai pasangan, relasi tersebut bukan fungsi karena syarat \'setiap anggota domain\' tidak terpenuhi. Jika satu anggota domain mempunyai dua pasangan yang berbeda, relasi tersebut juga bukan fungsi karena melanggar syarat \'tepat satu\'.',
                            'Sebaliknya, beberapa anggota domain boleh dipasangkan ke anggota kodomain yang sama. Misalnya 1 → a, 2 → a, dan 3 → b tetap merupakan fungsi. Tidak ada larangan bahwa satu anggota kodomain hanya boleh menerima satu pasangan.',
                            'Pada diagram panah, fungsi dapat diperiksa dengan menghitung panah keluar dari setiap anggota domain. Tepat satu panah keluar dari masing-masing anggota domain berarti fungsi; nol atau lebih dari satu panah keluar menunjukkan bukan fungsi.',
                        ],
                        'example' => [
                            'title' => 'Bandingkan',
                            'lines' => [
                                'Fungsi: {(1,a),(2,a),(3,b)}.',
                                'Bukan fungsi: {(1,a),(1,b),(2,a),(3,b)} karena 1 mempunyai dua pasangan berbeda.',
                            ],
                        ],
                        'note' => 'Pada diagram panah, setiap titik di domain harus mempunyai tepat satu panah keluar.',
                        'visual' => 'mapping-not-function',
                        'checkpoint' => [
                            'question' => 'Manakah yang bukan fungsi dari A={1,2,3} ke B={a,b}?',
                            'options' => [
                                'A' => '{(1,a),(2,a),(3,b)}',
                                'B' => '{(1,b),(2,b),(3,b)}',
                                'C' => '{(1,a),(1,b),(2,a),(3,b)}',
                                'D' => '{(1,a),(2,b),(3,a)}',
                            ],
                            'answer' => 'C',
                            'explanation' => 'Anggota domain 1 mempunyai dua pasangan berbeda, yaitu a dan b.',
                        ],
                    ],
                    8 => [
                        'type' => 'content',
                        'title' => 'Rangkuman Himpunan, Relasi, dan Fungsi',
                        'subtitle' => 'Menghubungkan seluruh konsep',
                        'pengayaan' => true,
                        'paragraphs' => [
                            'Himpunan memberikan dasar untuk mengelompokkan objek dan menentukan anggota secara jelas. Dari dua himpunan, kita dapat membentuk produk Kartesius yang berisi seluruh pasangan berurutan yang mungkin antara anggota himpunan pertama dan himpunan kedua.',
                            'Relasi dibentuk dengan memilih sebagian pasangan berurutan dari produk Kartesius berdasarkan aturan tertentu. Melalui relasi, kita mengenal domain sebagai himpunan asal, kodomain sebagai himpunan tujuan, dan range sebagai anggota kodomain yang benar-benar mendapat pasangan.',
                            'Fungsi merupakan relasi yang memenuhi syarat lebih khusus, yaitu setiap anggota domain harus dipasangkan tepat satu kali. Dengan demikian, setiap fungsi adalah relasi, tetapi tidak setiap relasi merupakan fungsi.',
                            'Alur Himpunan → Produk Kartesius → Relasi → Fungsi menunjukkan bahwa konsep-konsep tersebut saling berhubungan. Pemahaman yang kuat terhadap himpunan membantu mahasiswa membaca pasangan berurutan, menentukan domain dan range, serta memeriksa apakah suatu relasi memenuhi syarat sebagai fungsi.',
                        ],
                        'example' => [
                            'title' => 'Alur konsep',
                            'lines' => [
                                'Himpunan → Produk Kartesius → Relasi → Fungsi.',
                                'Diagram Venn membantu membaca hubungan antarhimpunan, sedangkan diagram panah membantu membaca relasi dan fungsi.',
                            ],
                        ],
                        'note' => 'Bagian relasi dan fungsi merupakan materi pengayaan yang ditambahkan untuk menghubungkan konsep himpunan dengan materi lanjutan Matematika Dasar.',
                        'visual' => 'concept-flow',
                        'checkpoint' => [
                            'question' => 'Pernyataan yang tepat adalah ...',
                            'options' => ['A' => 'Setiap relasi pasti fungsi', 'B' => 'Setiap fungsi merupakan relasi', 'C' => 'Range selalu sama dengan kodomain', 'D' => 'Produk Kartesius selalu merupakan fungsi'],
                            'answer' => 'B',
                            'explanation' => 'Fungsi adalah relasi khusus, sehingga setiap fungsi merupakan relasi tetapi tidak setiap relasi merupakan fungsi.',
                        ],
                    ],
                    9 => [
                        'type' => 'final_quiz',
                        'title' => 'Evaluasi Subbab 6',
                        'subtitle' => 'Himpunan Master + Pengayaan Relasi dan Fungsi',
                        'questions' => [
                            [
                                'question' => 'Dalam kelas 40 mahasiswa, 24 menyukai P, 18 menyukai M, dan 10 menyukai keduanya. n(P∪M)= ...',
                                'options' => ['A' => '28', 'B' => '30', 'C' => '32', 'D' => '42'],
                                'answer' => 'C',
                                'explanation' => '24+18−10=32.',
                            ],
                            [
                                'question' => 'Dari data yang sama, banyak mahasiswa yang tidak menyukai keduanya adalah ...',
                                'options' => ['A' => '8', 'B' => '10', 'C' => '18', 'D' => '32'],
                                'answer' => 'A',
                                'explanation' => '40−32=8.',
                            ],
                            [
                                'question' => 'Jika A={1,2} dan B={a,b}, n(A×B)= ...',
                                'options' => ['A' => '2', 'B' => '3', 'C' => '4', 'D' => '6'],
                                'answer' => 'C',
                                'explanation' => '2×2=4 pasangan berurutan.',
                            ],
                            [
                                'question' => 'R={(1,a),(2,b),(3,b)} dengan kodomain {a,b,c}. Range R adalah ...',
                                'options' => ['A' => '{1,2,3}', 'B' => '{a,b}', 'C' => '{a,b,c}', 'D' => '{c}'],
                                'answer' => 'B',
                                'explanation' => 'Anggota kodomain yang mendapat pasangan adalah a dan b.',
                            ],
                            [
                                'question' => 'Manakah yang merupakan fungsi dari A={1,2,3} ke B={a,b}?',
                                'options' => [
                                    'A' => '{(1,a),(1,b),(2,a),(3,b)}',
                                    'B' => '{(1,a),(2,a),(3,b)}',
                                    'C' => '{(1,a),(2,b)}',
                                    'D' => '{(1,a),(2,b),(3,a),(3,b)}',
                                ],
                                'answer' => 'B',
                                'explanation' => 'Setiap anggota domain 1,2,3 mempunyai tepat satu pasangan.',
                            ],
                        ],
                    ],
                ],
            ],
        ];
    }
}
