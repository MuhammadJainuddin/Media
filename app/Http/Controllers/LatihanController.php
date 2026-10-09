<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LatihanController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | KONFIGURASI LATIHAN AKHIR
    |--------------------------------------------------------------------------
    */

    private const DURATION_MINUTES = 45;

    private const PASSING_SCORE = 80;

    private const TOTAL_SUBBAB = 6;


    /*
    |--------------------------------------------------------------------------
    | HALAMAN UTAMA LATIHAN
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        [
            $user,
            $kelas,
            $subbabSelesai
        ] = $this->studentContext();

        $totalSubbab =
            self::TOTAL_SUBBAB;

        $isUnlocked =
            $subbabSelesai >=
            $totalSubbab;

        $questions =
            $this->questions();

        $totalQuestions =
            count($questions);

        /*
        |--------------------------------------------------------------------------
        | JAWABAN YANG SUDAH TERSIMPAN
        |--------------------------------------------------------------------------
        */

        $answers =
            session(
                $this->answerSessionKey(
                    (int) $user->id,
                    (int) $kelas->id
                ),
                []
            );

        $answeredCount =
            count($answers);

        $completionPercent =
            $totalQuestions > 0
                ? (int) round(
                    (
                        $answeredCount
                        /
                        $totalQuestions
                    )
                    *
                    100
                )
                : 0;

        /*
        |--------------------------------------------------------------------------
        | PROGRESS MATERI
        |--------------------------------------------------------------------------
        */

        $materialPercent =
            (int) round(
                (
                    $subbabSelesai
                    /
                    $totalSubbab
                )
                *
                100
            );

        /*
        |--------------------------------------------------------------------------
        | TIMER
        |--------------------------------------------------------------------------
        */

        $deadline =
            session(
                $this->deadlineSessionKey(
                    (int) $user->id,
                    (int) $kelas->id
                )
            );

        $timerStarted =
            $deadline !== null;

        $remainingSeconds =
            $deadline
                ? max(
                    0,
                    (int) $deadline
                    -
                    now()->timestamp
                )
                : self::DURATION_MINUTES
                    *
                    60;

        /*
        |--------------------------------------------------------------------------
        | SOAL PERTAMA YANG BELUM DIJAWAB
        |--------------------------------------------------------------------------
        */

        $firstUnanswered =
            $this->firstUnanswered(
                $answers,
                $totalQuestions
            );

        $startNumber =
            $firstUnanswered
                ??
                1;

        $isComplete =
            $answeredCount >=
            $totalQuestions;

        return view(
            'mahasiswa.latihan.index',
            compact(
                'kelas',
                'subbabSelesai',
                'totalSubbab',
                'isUnlocked',
                'totalQuestions',
                'answeredCount',
                'completionPercent',
                'materialPercent',
                'timerStarted',
                'remainingSeconds',
                'startNumber',
                'isComplete'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | HALAMAN SOAL
    |--------------------------------------------------------------------------
    */

    public function show(
        int $number
    ) {
        [
            $user,
            $kelas,
            $subbabSelesai
        ] = $this->studentContext();

        /*
        |--------------------------------------------------------------------------
        | CEK LATIHAN TERBUKA
        |--------------------------------------------------------------------------
        */

        if (
            $subbabSelesai <
            self::TOTAL_SUBBAB
        ) {
            return redirect()
                ->route(
                    'mahasiswa.latihan.index'
                )
                ->with(
                    'error',
                    'Selesaikan seluruh 6 subbab terlebih dahulu.'
                );
        }

        $questions =
            $this->questions();

        $totalQuestions =
            count($questions);

        /*
        |--------------------------------------------------------------------------
        | VALIDASI NOMOR SOAL
        |--------------------------------------------------------------------------
        */

        if (
            $number < 1
            ||
            $number > $totalQuestions
        ) {
            abort(404);
        }

        /*
        |--------------------------------------------------------------------------
        | SESSION KEY
        |--------------------------------------------------------------------------
        */

        $answerKey =
            $this->answerSessionKey(
                (int) $user->id,
                (int) $kelas->id
            );

        $deadlineKey =
            $this->deadlineSessionKey(
                (int) $user->id,
                (int) $kelas->id
            );

        $finishedKey =
            $this->finishedSessionKey(
                (int) $user->id,
                (int) $kelas->id
            );

        $timeoutKey =
            $this->timeoutSessionKey(
                (int) $user->id,
                (int) $kelas->id
            );

        /*
        |--------------------------------------------------------------------------
        | JIKA LATIHAN SUDAH SELESAI
        |--------------------------------------------------------------------------
        */

        if (session()->has($finishedKey)) {
            return redirect()
                ->route(
                    'mahasiswa.latihan.result'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | MULAI TIMER
        |--------------------------------------------------------------------------
        |
        | Timer baru dimulai ketika mahasiswa membuka soal pertama.
        |
        */

        $deadline =
            session($deadlineKey);

        if (!$deadline) {
            $deadline =
                now()
                    ->addMinutes(
                        self::DURATION_MINUTES
                    )
                    ->timestamp;

            session()->put(
                $deadlineKey,
                $deadline
            );

            session()->forget(
                $timeoutKey
            );
        }

        /*
        |--------------------------------------------------------------------------
        | CEK WAKTU
        |--------------------------------------------------------------------------
        */

        $remainingSeconds =
            (int) $deadline
            -
            now()->timestamp;

        if ($remainingSeconds <= 0) {
            session()->put(
                $timeoutKey,
                true
            );

            return redirect()
                ->route(
                    'mahasiswa.latihan.result'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | JAWABAN
        |--------------------------------------------------------------------------
        */

        $answers =
            session(
                $answerKey,
                []
            );

        /*
        |--------------------------------------------------------------------------
        | BATASI LOMPAT SOAL
        |--------------------------------------------------------------------------
        |
        | Mahasiswa tidak dapat langsung membuka soal yang jauh
        | sebelum menjawab soal sebelumnya.
        |
        */

        $firstUnanswered =
            $this->firstUnanswered(
                $answers,
                $totalQuestions
            );

        if (
            $firstUnanswered !== null
            &&
            $number >
            $firstUnanswered
        ) {
            return redirect()
                ->route(
                    'mahasiswa.latihan.show',
                    [
                        'number' =>
                            $firstUnanswered
                    ]
                );
        }

        /*
        |--------------------------------------------------------------------------
        | DATA SOAL
        |--------------------------------------------------------------------------
        |
        | Answer key tidak dikirim ke view.
        |
        */

        $rawQuestion =
            $questions[
                $number - 1
            ];

        $question = [
            'title' =>
                $rawQuestion['title'],

            'category' =>
                $rawQuestion['category'],

            'question' =>
                $rawQuestion['question'],

            'options' =>
                $rawQuestion['options'],
        ];

        $selectedAnswer =
            $answers[$number]
            ??
            null;

        $answeredCount =
            count($answers);

        $progress =
            (int) round(
                (
                    $answeredCount
                    /
                    $totalQuestions
                )
                *
                100
            );

        return view(
            'mahasiswa.latihan.show',
            compact(
                'kelas',
                'question',
                'number',
                'totalQuestions',
                'selectedAnswer',
                'answeredCount',
                'progress',
                'remainingSeconds'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | SIMPAN JAWABAN
    |--------------------------------------------------------------------------
    */

    public function storeAnswer(
        Request $request,
        int $number
    ) {
        [
            $user,
            $kelas,
            $subbabSelesai
        ] = $this->studentContext();

        if (
            $subbabSelesai <
            self::TOTAL_SUBBAB
        ) {
            return redirect()
                ->route(
                    'mahasiswa.latihan.index'
                );
        }

        $questions =
            $this->questions();

        $totalQuestions =
            count($questions);

        if (
            $number < 1
            ||
            $number > $totalQuestions
        ) {
            abort(404);
        }

        /*
        |--------------------------------------------------------------------------
        | SESSION KEY
        |--------------------------------------------------------------------------
        */

        $answerKey =
            $this->answerSessionKey(
                (int) $user->id,
                (int) $kelas->id
            );

        $deadlineKey =
            $this->deadlineSessionKey(
                (int) $user->id,
                (int) $kelas->id
            );

        $finishedKey =
            $this->finishedSessionKey(
                (int) $user->id,
                (int) $kelas->id
            );

        $timeoutKey =
            $this->timeoutSessionKey(
                (int) $user->id,
                (int) $kelas->id
            );

        /*
        |--------------------------------------------------------------------------
        | CEK TIMER
        |--------------------------------------------------------------------------
        */

        $deadline =
            session($deadlineKey);

        if (
            !$deadline
            ||
            now()->timestamp >
            (int) $deadline
        ) {
            session()->put(
                $timeoutKey,
                true
            );

            return redirect()
                ->route(
                    'mahasiswa.latihan.result'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | VALIDASI JAWABAN
        |--------------------------------------------------------------------------
        */

        $question =
            $questions[
                $number - 1
            ];

        $validAnswers =
            array_keys(
                $question['options']
            );

        $validated =
            $request->validate(
                [
                    'answer' => [
                        'required',
                        'string',
                        'in:'
                        .
                        implode(
                            ',',
                            $validAnswers
                        ),
                    ],
                ],
                [
                    'answer.required' =>
                        'Pilih salah satu jawaban terlebih dahulu.',
                ]
            );

        /*
        |--------------------------------------------------------------------------
        | SIMPAN JAWABAN
        |--------------------------------------------------------------------------
        */

        $answers =
            session(
                $answerKey,
                []
            );

        $answers[$number] =
            strtoupper(
                $validated['answer']
            );

        session()->put(
            $answerKey,
            $answers
        );

        /*
        |--------------------------------------------------------------------------
        | SOAL TERAKHIR
        |--------------------------------------------------------------------------
        */

        if (
            count($answers)
            >=
            $totalQuestions
        ) {
            /*
            |--------------------------------------------------------------------------
            | TANDA LATIHAN SUDAH DIKUMPULKAN
            |--------------------------------------------------------------------------
            |
            | Ini penting agar jika halaman hasil dibuka setelah deadline,
            | latihan tidak dianggap timeout jika sebelumnya sudah selesai.
            |
            */

            session()->put(
                $finishedKey,
                now()->timestamp
            );

            session()->forget(
                $timeoutKey
            );

            return redirect()
                ->route(
                    'mahasiswa.latihan.result'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | LANJUT SOAL
        |--------------------------------------------------------------------------
        */

        $nextNumber =
            $this->firstUnanswered(
                $answers,
                $totalQuestions
            );

        if ($nextNumber === null) {
            return redirect()
                ->route(
                    'mahasiswa.latihan.result'
                );
        }

        return redirect()
            ->route(
                'mahasiswa.latihan.show',
                [
                    'number' =>
                        $nextNumber
                ]
            );
    }


    /*
    |--------------------------------------------------------------------------
    | HASIL LATIHAN
    |--------------------------------------------------------------------------
    */

    public function result()
    {
        [
            $user,
            $kelas,
            $subbabSelesai
        ] = $this->studentContext();

        if (
            $subbabSelesai <
            self::TOTAL_SUBBAB
        ) {
            return redirect()
                ->route(
                    'mahasiswa.latihan.index'
                );
        }

        $questions =
            $this->questions();

        $totalQuestions =
            count($questions);

        /*
        |--------------------------------------------------------------------------
        | SESSION KEYS
        |--------------------------------------------------------------------------
        */

        $answerKey =
            $this->answerSessionKey(
                (int) $user->id,
                (int) $kelas->id
            );

        $deadlineKey =
            $this->deadlineSessionKey(
                (int) $user->id,
                (int) $kelas->id
            );

        $finishedKey =
            $this->finishedSessionKey(
                (int) $user->id,
                (int) $kelas->id
            );

        $timeoutKey =
            $this->timeoutSessionKey(
                (int) $user->id,
                (int) $kelas->id
            );

        /*
        |--------------------------------------------------------------------------
        | DATA SESSION
        |--------------------------------------------------------------------------
        */

        $answers =
            session(
                $answerKey,
                []
            );

        $deadline =
            session($deadlineKey);

        $finishedAt =
            session($finishedKey);

        $timedOut =
            (bool) session(
                $timeoutKey,
                false
            );

        /*
        |--------------------------------------------------------------------------
        | DETEKSI TIMEOUT
        |--------------------------------------------------------------------------
        |
        | Jika sudah selesai sebelum batas waktu,
        | kunjungan ulang ke halaman hasil tidak mengubahnya menjadi timeout.
        |
        */

        if (
            !$finishedAt
            &&
            $deadline
            &&
            now()->timestamp >
            (int) $deadline
        ) {
            $timedOut =
                true;

            session()->put(
                $timeoutKey,
                true
            );
        }

        /*
        |--------------------------------------------------------------------------
        | JIKA BELUM SELESAI DAN BELUM TIMEOUT
        |--------------------------------------------------------------------------
        */

        if (!$timedOut) {
            $firstUnanswered =
                $this->firstUnanswered(
                    $answers,
                    $totalQuestions
                );

            if (
                $firstUnanswered !== null
                &&
                !$finishedAt
            ) {
                return redirect()
                    ->route(
                        'mahasiswa.latihan.show',
                        [
                            'number' =>
                                $firstUnanswered
                        ]
                    );
            }
        }

        /*
        |--------------------------------------------------------------------------
        | NILAI
        |--------------------------------------------------------------------------
        */

        $correctCount = 0;

        $results = [];

        foreach (
            $questions
            as $index => $question
        ) {
            $number =
                $index + 1;

            $selected =
                $answers[$number]
                ??
                null;

            $isCorrect =
                $selected !== null
                &&
                strtoupper($selected)
                ===
                strtoupper(
                    $question['correct']
                );

            if ($isCorrect) {
                $correctCount++;
            }

            /*
            |--------------------------------------------------------------------------
            | JANGAN KIRIM KUNCI JAWABAN
            |--------------------------------------------------------------------------
            */

            $results[] = [
                'number' =>
                    $number,

                'category' =>
                    $question['category'],

                'question' =>
                    $question['question'],

                'selected' =>
                    $selected
                    ??
                    '-',

                'is_correct' =>
                    $isCorrect,
            ];
        }

        $score =
            $totalQuestions > 0
                ? (int) round(
                    (
                        $correctCount
                        /
                        $totalQuestions
                    )
                    *
                    100
                )
                : 0;

        $passed =
            $score >=
            self::PASSING_SCORE;

        /*
        |--------------------------------------------------------------------------
        | SIMPAN NILAI KE DATABASE
        |--------------------------------------------------------------------------
        |
        | Ini bagian penting untuk sistem Badge.
        |
        */

        $this->saveFinalResult(
            (int) $user->id,
            (int) $kelas->id,
            $score,
            $passed
        );

        return view(
            'mahasiswa.latihan.result',
            compact(
                'kelas',
                'results',
                'score',
                'correctCount',
                'totalQuestions',
                'passed',
                'timedOut'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | RESET LATIHAN
    |--------------------------------------------------------------------------
    */

    public function reset()
    {
        [
            $user,
            $kelas
        ] = $this->studentContext();

        /*
        |--------------------------------------------------------------------------
        | HANYA SESSION YANG DIHAPUS
        |--------------------------------------------------------------------------
        |
        | Nilai terbaik di database TIDAK dihapus.
        | Jadi badge yang sudah diperoleh tidak hilang.
        |
        */

        session()->forget([
            $this->answerSessionKey(
                (int) $user->id,
                (int) $kelas->id
            ),

            $this->deadlineSessionKey(
                (int) $user->id,
                (int) $kelas->id
            ),

            $this->finishedSessionKey(
                (int) $user->id,
                (int) $kelas->id
            ),

            $this->timeoutSessionKey(
                (int) $user->id,
                (int) $kelas->id
            ),
        ]);

        return redirect()
            ->route(
                'mahasiswa.latihan.index'
            )
            ->with(
                'success',
                'Latihan berhasil direset. Nilai terbaik yang pernah diperoleh tetap tersimpan.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | SIMPAN HASIL LATIHAN AKHIR
    |--------------------------------------------------------------------------
    */

    private function saveFinalResult(
        int $userId,
        int $kelasId,
        int $score,
        bool $passed
    ): void {
        $pivot = DB::table(
            'kelas_user'
        )
            ->where(
                'user_id',
                $userId
            )
            ->where(
                'kelas_id',
                $kelasId
            )
            ->first();

        if (!$pivot) {
            return;
        }

        /*
        |--------------------------------------------------------------------------
        | NILAI TERBAIK SEBELUMNYA
        |--------------------------------------------------------------------------
        */

        $previousBest =
            $pivot
                ->latihan_akhir_nilai_terbaik
                !== null
                ? (float)
                    $pivot
                        ->latihan_akhir_nilai_terbaik
                : null;

        /*
        |--------------------------------------------------------------------------
        | TENTUKAN NILAI TERBAIK BARU
        |--------------------------------------------------------------------------
        */

        $bestScore =
            $previousBest === null
                ? $score
                : max(
                    $previousBest,
                    $score
                );

        /*
        |--------------------------------------------------------------------------
        | STATUS LULUS
        |--------------------------------------------------------------------------
        |
        | Sekali lulus, status tetap lulus.
        |
        */

        $alreadyPassed =
            (bool)
            $pivot
                ->latihan_akhir_lulus;

        $finalPassed =
            $alreadyPassed
            ||
            $passed;

        /*
        |--------------------------------------------------------------------------
        | TANGGAL PERTAMA LULUS
        |--------------------------------------------------------------------------
        */

        $passedAt =
            $pivot
                ->latihan_akhir_lulus_at;

        if (
            !$alreadyPassed
            &&
            $passed
        ) {
            $passedAt =
                now();
        }

        /*
        |--------------------------------------------------------------------------
        | UPDATE DATABASE
        |--------------------------------------------------------------------------
        */

        DB::table(
            'kelas_user'
        )
            ->where(
                'user_id',
                $userId
            )
            ->where(
                'kelas_id',
                $kelasId
            )
            ->update(
                [
                    'latihan_akhir_nilai_terbaik' =>
                        $bestScore,

                    'latihan_akhir_lulus' =>
                        $finalPassed,

                    'latihan_akhir_lulus_at' =>
                        $passedAt,

                    'last_activity_at' =>
                        now(),

                    'updated_at' =>
                        now(),
                ]
            );
    }


    /*
    |--------------------------------------------------------------------------
    | DATA MAHASISWA + KELAS
    |--------------------------------------------------------------------------
    */

    private function studentContext(): array
    {
        $user =
            Auth::user();

        if (!$user instanceof User) {
            abort(401);
        }

        if (
            $user->role !==
            'mahasiswa'
        ) {
            abort(
                403,
                'Latihan akhir hanya dapat diakses mahasiswa.'
            );
        }

        $kelas = $user
            ->kelasDiikuti()
            ->with('pembuat')
            ->first();

        if (!$kelas) {
            abort(
                403,
                'Bergabunglah ke kelas terlebih dahulu.'
            );
        }

        $subbabSelesai =
            (int) (
                $kelas
                    ->pivot
                    ->subbab_selesai
                ??
                0
            );

        $subbabSelesai =
            max(
                0,
                min(
                    self::TOTAL_SUBBAB,
                    $subbabSelesai
                )
            );

        return [
            $user,
            $kelas,
            $subbabSelesai,
        ];
    }


    /*
    |--------------------------------------------------------------------------
    | SESSION KEY JAWABAN
    |--------------------------------------------------------------------------
    */

    private function answerSessionKey(
        int $userId,
        int $kelasId
    ): string {
        return
            'himdas.final.'
            .
            $userId
            .
            '.'
            .
            $kelasId
            .
            '.answers';
    }


    /*
    |--------------------------------------------------------------------------
    | SESSION KEY DEADLINE
    |--------------------------------------------------------------------------
    */

    private function deadlineSessionKey(
        int $userId,
        int $kelasId
    ): string {
        return
            'himdas.final.'
            .
            $userId
            .
            '.'
            .
            $kelasId
            .
            '.deadline';
    }


    /*
    |--------------------------------------------------------------------------
    | SESSION KEY FINISHED
    |--------------------------------------------------------------------------
    */

    private function finishedSessionKey(
        int $userId,
        int $kelasId
    ): string {
        return
            'himdas.final.'
            .
            $userId
            .
            '.'
            .
            $kelasId
            .
            '.finished_at';
    }


    /*
    |--------------------------------------------------------------------------
    | SESSION KEY TIMEOUT
    |--------------------------------------------------------------------------
    */

    private function timeoutSessionKey(
        int $userId,
        int $kelasId
    ): string {
        return
            'himdas.final.'
            .
            $userId
            .
            '.'
            .
            $kelasId
            .
            '.timeout';
    }


    /*
    |--------------------------------------------------------------------------
    | CARI SOAL PERTAMA YANG BELUM DIJAWAB
    |--------------------------------------------------------------------------
    */

    private function firstUnanswered(
        array $answers,
        int $totalQuestions
    ): ?int {
        for (
            $number = 1;
            $number <= $totalQuestions;
            $number++
        ) {
            if (
                !array_key_exists(
                    $number,
                    $answers
                )
            ) {
                return $number;
            }
        }

        return null;
    }


    /*
    |--------------------------------------------------------------------------
    | BANK SOAL LATIHAN AKHIR
    |--------------------------------------------------------------------------
    */

    private function questions(): array
    {
        return [

            /*
            |--------------------------------------------------------------------------
            | SUBBAB 1
            |--------------------------------------------------------------------------
            */

            [
                'category' =>
                    'Subbab 1',

                'title' =>
                    'Pengertian Himpunan',

                'question' =>
                    'Manakah kumpulan yang merupakan himpunan karena keanggotaannya dapat ditentukan dengan jelas?',

                'options' => [
                    'A' =>
                        'Kumpulan makanan terenak',

                    'B' =>
                        'Kumpulan mahasiswa paling rajin',

                    'C' =>
                        'Kumpulan bilangan genap kurang dari 10',

                    'D' =>
                        'Kumpulan film paling bagus',
                ],

                'correct' =>
                    'C',
            ],


            [
                'category' =>
                    'Subbab 1',

                'title' =>
                    'Keanggotaan Himpunan',

                'question' =>
                    'Jika A = {2, 4, 6, 8}, pernyataan yang benar adalah ...',

                'options' => [
                    'A' =>
                        '3 ∈ A',

                    'B' =>
                        '4 ∉ A',

                    'C' =>
                        '6 ∈ A',

                    'D' =>
                        '8 ∉ A',
                ],

                'correct' =>
                    'C',
            ],


            [
                'category' =>
                    'Subbab 1',

                'title' =>
                    'Kardinalitas',

                'question' =>
                    'Jika A = {a, b, c, d}, maka n(A) adalah ...',

                'options' => [
                    'A' => '3',
                    'B' => '4',
                    'C' => '5',
                    'D' => '6',
                ],

                'correct' =>
                    'B',
            ],


            /*
            |--------------------------------------------------------------------------
            | SUBBAB 2
            |--------------------------------------------------------------------------
            */

            [
                'category' =>
                    'Subbab 2',

                'title' =>
                    'Cara Tabulasi',

                'question' =>
                    'A = {x | 0 ≤ x < 5, x bilangan cacah}. Bentuk tabulasinya adalah ...',

                'options' => [
                    'A' =>
                        '{0,1,2,3,4}',

                    'B' =>
                        '{1,2,3,4,5}',

                    'C' =>
                        '{0,1,2,3,4,5}',

                    'D' =>
                        '{1,2,3,4}',
                ],

                'correct' =>
                    'A',
            ],


            [
                'category' =>
                    'Subbab 2',

                'title' =>
                    'Simbol Baku',

                'question' =>
                    'Simbol baku untuk himpunan bilangan bulat adalah ...',

                'options' => [
                    'A' => 'N',
                    'B' => 'Z',
                    'C' => 'Q',
                    'D' => 'R',
                ],

                'correct' =>
                    'B',
            ],


            [
                'category' =>
                    'Subbab 2',

                'title' =>
                    'Diagram Venn',

                'question' =>
                    'Jika A = {1,2,3} dan B = {3,4,5}, banyak anggota A ∩ B adalah ...',

                'options' => [
                    'A' => '0',
                    'B' => '2',
                    'C' => '1',
                    'D' => '3',
                ],

                'correct' =>
                    'C',
            ],


            /*
            |--------------------------------------------------------------------------
            | SUBBAB 3
            |--------------------------------------------------------------------------
            */

            [
                'category' =>
                    'Subbab 3',

                'title' =>
                    'Himpunan Kosong',

                'question' =>
                    'Himpunan {x | 3 < x < 4, x bilangan bulat} adalah ...',

                'options' => [
                    'A' =>
                        '{3}',

                    'B' =>
                        '{4}',

                    'C' =>
                        '∅',

                    'D' =>
                        '{3,4}',
                ],

                'correct' =>
                    'C',
            ],


            [
                'category' =>
                    'Subbab 3',

                'title' =>
                    'Kesamaan Himpunan',

                'question' =>
                    'Jika A = {1,2,3} dan B = {3,2,1}, maka hubungan A dan B adalah ...',

                'options' => [
                    'A' =>
                        'A = B',

                    'B' =>
                        'A ≠ B',

                    'C' =>
                        'A dan B lepas',

                    'D' =>
                        'A ⊂ B',
                ],

                'correct' =>
                    'A',
            ],


            [
                'category' =>
                    'Subbab 3',

                'title' =>
                    'Himpunan Ekuivalen',

                'question' =>
                    'A = {a,b,c} dan B = {1,2,3}. Hubungan A dan B adalah ...',

                'options' => [
                    'A' =>
                        'Sama',

                    'B' =>
                        'Ekuivalen',

                    'C' =>
                        'Subset',

                    'D' =>
                        'Bersilangan',
                ],

                'correct' =>
                    'B',
            ],


            /*
            |--------------------------------------------------------------------------
            | SUBBAB 4
            |--------------------------------------------------------------------------
            */

            [
                'category' =>
                    'Subbab 4',

                'title' =>
                    'Subset',

                'question' =>
                    'Jika A = {1,2} dan B = {1,2,3}, maka ...',

                'options' => [
                    'A' =>
                        'A ⊆ B',

                    'B' =>
                        'B ⊆ A',

                    'C' =>
                        'A = B',

                    'D' =>
                        'A ∩ B = ∅',
                ],

                'correct' =>
                    'A',
            ],


            [
                'category' =>
                    'Subbab 4',

                'title' =>
                    'Banyak Subset',

                'question' =>
                    'Berapa banyak subset dari A = {a,b}?',

                'options' => [
                    'A' => '2',
                    'B' => '3',
                    'C' => '4',
                    'D' => '6',
                ],

                'correct' =>
                    'C',
            ],


            [
                'category' =>
                    'Subbab 4',

                'title' =>
                    'Himpunan Kuasa',

                'question' =>
                    'Jika n(A) = 5, banyak anggota P(A) adalah ...',

                'options' => [
                    'A' => '10',
                    'B' => '16',
                    'C' => '32',
                    'D' => '64',
                ],

                'correct' =>
                    'C',
            ],


            /*
            |--------------------------------------------------------------------------
            | SUBBAB 5
            |--------------------------------------------------------------------------
            */

            [
                'category' =>
                    'Subbab 5',

                'title' =>
                    'Irisan',

                'question' =>
                    'A = {1,2,3,4} dan B = {3,4,5,6}. A ∩ B adalah ...',

                'options' => [
                    'A' =>
                        '{1,2}',

                    'B' =>
                        '{3,4}',

                    'C' =>
                        '{5,6}',

                    'D' =>
                        '{1,2,3,4,5,6}',
                ],

                'correct' =>
                    'B',
            ],


            [
                'category' =>
                    'Subbab 5',

                'title' =>
                    'Gabungan',

                'question' =>
                    'A = {1,2,3} dan B = {3,4,5}. A ∪ B adalah ...',

                'options' => [
                    'A' =>
                        '{3}',

                    'B' =>
                        '{1,2,4,5}',

                    'C' =>
                        '{1,2,3,4,5}',

                    'D' =>
                        '{1,2}',
                ],

                'correct' =>
                    'C',
            ],


            [
                'category' =>
                    'Subbab 5',

                'title' =>
                    'Komplemen',

                'question' =>
                    'S = {1,2,3,4,5,6} dan A = {2,4,6}. Komplemen A adalah ...',

                'options' => [
                    'A' =>
                        '{1,3,5}',

                    'B' =>
                        '{2,4,6}',

                    'C' =>
                        '{1,2,3}',

                    'D' =>
                        '{4,5,6}',
                ],

                'correct' =>
                    'A',
            ],


            [
                'category' =>
                    'Subbab 5',

                'title' =>
                    'Sifat Operasi',

                'question' =>
                    'Menurut hukum De Morgan, (A ∪ B)′ sama dengan ...',

                'options' => [
                    'A' =>
                        'A′ ∪ B′',

                    'B' =>
                        'A′ ∩ B′',

                    'C' =>
                        'A ∩ B',

                    'D' =>
                        'A − B',
                ],

                'correct' =>
                    'B',
            ],


            /*
            |--------------------------------------------------------------------------
            | SUBBAB 6
            |--------------------------------------------------------------------------
            */

            [
                'category' =>
                    'Subbab 6',

                'title' =>
                    'Penerapan Himpunan',

                'question' =>
                    'Dalam kelas 40 mahasiswa, 24 menyukai pemrograman, 18 menyukai matematika, dan 10 menyukai keduanya. Berapa mahasiswa yang menyukai minimal salah satu?',

                'options' => [
                    'A' => '28',
                    'B' => '30',
                    'C' => '32',
                    'D' => '42',
                ],

                'correct' =>
                    'C',
            ],


            [
                'category' =>
                    'Subbab 6',

                'title' =>
                    'Produk Kartesius',

                'question' =>
                    'Jika A = {1,2} dan B = {a,b}, banyak anggota A × B adalah ...',

                'options' => [
                    'A' => '2',
                    'B' => '3',
                    'C' => '4',
                    'D' => '6',
                ],

                'correct' =>
                    'C',
            ],


            [
                'category' =>
                    'Subbab 6',

                'title' =>
                    'Range Relasi',

                'question' =>
                    'R = {(1,a),(2,b),(3,b)}. Range dari R adalah ...',

                'options' => [
                    'A' =>
                        '{1,2,3}',

                    'B' =>
                        '{a,b}',

                    'C' =>
                        '{1,a}',

                    'D' =>
                        '{a,b,1,2,3}',
                ],

                'correct' =>
                    'B',
            ],


            [
                'category' =>
                    'Subbab 6',

                'title' =>
                    'Pengertian Fungsi',

                'question' =>
                    'Suatu relasi dari A ke B disebut fungsi apabila ...',

                'options' => [
                    'A' =>
                        'Setiap anggota B harus mempunyai tepat satu pasangan di A',

                    'B' =>
                        'Setiap anggota A mempunyai tepat satu pasangan di B',

                    'C' =>
                        'Setiap anggota A mempunyai minimal dua pasangan di B',

                    'D' =>
                        'Jumlah anggota A dan B harus sama',
                ],

                'correct' =>
                    'B',
            ],

        ];
    }
}