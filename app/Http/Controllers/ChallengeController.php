<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ChallengeController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | KONFIGURASI CHALLENGE
    |--------------------------------------------------------------------------
    */

    private const DAILY_COUNT = 6;

    private const DAILY_BONUS_XP = 50;

    private const BONUS_KEY = '__daily_bonus__';


    /*
    |--------------------------------------------------------------------------
    | HALAMAN UTAMA CHALLENGE
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        [$user, $kelas] = $this->studentContext();

        $date = now()->toDateString();

        /*
        |--------------------------------------------------------------------------
        | AMBIL 6 CHALLENGE HARIAN
        |--------------------------------------------------------------------------
        |
        | Satu challenge dari masing-masing Subbab 1 - 6.
        | Soal di setiap subbab berubah berdasarkan tanggal.
        |
        */

        $dailyChallenges = $this->dailyChallenges(
            (int) $kelas->id,
            $date
        );

        /*
        |--------------------------------------------------------------------------
        | AMBIL HASIL CHALLENGE HARI INI
        |--------------------------------------------------------------------------
        */

        $attempts = DB::table('challenge_attempts')
            ->where('user_id', $user->id)
            ->where('kelas_id', $kelas->id)
            ->whereDate('challenge_date', $date)
            ->get()
            ->keyBy('challenge_key');

        /*
        |--------------------------------------------------------------------------
        | STATUS CHALLENGE
        |--------------------------------------------------------------------------
        */

        $completedCount = 0;

        foreach ($dailyChallenges as &$challenge) {
            $attempt = $attempts->get(
                $challenge['key']
            );

            $challenge['completed'] =
                $attempt !== null;

            $challenge['is_correct'] =
                $attempt
                    ? (bool) $attempt->is_correct
                    : false;

            $challenge['xp_earned'] =
                $attempt
                    ? (int) $attempt->xp_earned
                    : 0;

            if ($attempt) {
                $completedCount++;
            }
        }

        unset($challenge);

        /*
        |--------------------------------------------------------------------------
        | JUMLAH CHALLENGE HARIAN
        |--------------------------------------------------------------------------
        */

        $dailyTotal = self::DAILY_COUNT;

        /*
        |--------------------------------------------------------------------------
        | BONUS
        |--------------------------------------------------------------------------
        */

        $bonusAttempt = $attempts->get(
            self::BONUS_KEY
        );

        $bonusAwarded =
            $bonusAttempt !== null;

        /*
        |--------------------------------------------------------------------------
        | XP HARI INI
        |--------------------------------------------------------------------------
        */

        $xpToday = (int) $attempts->sum(
            'xp_earned'
        );

        /*
        |--------------------------------------------------------------------------
        | PROGRESS
        |--------------------------------------------------------------------------
        */

        $progress = (int) round(
            (
                $completedCount
                /
                $dailyTotal
            )
            *
            100
        );

        /*
        |--------------------------------------------------------------------------
        | STREAK
        |--------------------------------------------------------------------------
        */

        $streak = $this->currentStreak(
            (int) $user->id,
            (int) $kelas->id
        );

        /*
        |--------------------------------------------------------------------------
        | TANGGAL
        |--------------------------------------------------------------------------
        */

        $todayLabel = now()
            ->locale('id')
            ->translatedFormat(
                'l, d F Y'
            );

        return view(
            'mahasiswa.challenge.index',
            compact(
                'kelas',
                'dailyChallenges',
                'dailyTotal',
                'completedCount',
                'xpToday',
                'progress',
                'streak',
                'bonusAwarded',
                'todayLabel'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | HALAMAN SATU CHALLENGE
    |--------------------------------------------------------------------------
    */

    public function show(string $key)
    {
        [$user, $kelas] =
            $this->studentContext();

        $date =
            now()->toDateString();

        /*
        |--------------------------------------------------------------------------
        | CARI CHALLENGE DALAM PAKET HARI INI
        |--------------------------------------------------------------------------
        */

        $challenge = collect(
            $this->dailyChallenges(
                (int) $kelas->id,
                $date
            )
        )->firstWhere(
            'key',
            $key
        );

        if (!$challenge) {
            abort(404);
        }

        /*
        |--------------------------------------------------------------------------
        | CEK SUDAH DIKERJAKAN
        |--------------------------------------------------------------------------
        */

        $attempt = DB::table(
            'challenge_attempts'
        )
            ->where(
                'user_id',
                $user->id
            )
            ->where(
                'kelas_id',
                $kelas->id
            )
            ->whereDate(
                'challenge_date',
                $date
            )
            ->where(
                'challenge_key',
                $key
            )
            ->first();

        if ($attempt) {
            return redirect()
                ->route(
                    'mahasiswa.challenge.index'
                )
                ->with(
                    'error',
                    'Challenge ini sudah kamu kerjakan hari ini.'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | DATA SOAL
        |--------------------------------------------------------------------------
        |
        | Jawaban benar tidak dikirim ke view.
        |
        */

        $question = [
            'key' =>
                $challenge['key'],

            'subbab' =>
                $challenge['subbab'],

            'title' =>
                $challenge['title'],

            'difficulty' =>
                $challenge['difficulty'],

            'xp' =>
                $challenge['xp'],

            'type' =>
                $challenge['type'],

            'question' =>
                $challenge['question'],

            'options' =>
                $challenge['options']
                ?? [],
        ];

        return view(
            'mahasiswa.challenge.show',
            compact(
                'kelas',
                'question'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | PROSES JAWABAN
    |--------------------------------------------------------------------------
    */

    public function answer(
        Request $request,
        string $key
    ) {
        [$user, $kelas] =
            $this->studentContext();

        $date =
            now()->toDateString();

        /*
        |--------------------------------------------------------------------------
        | AMBIL CHALLENGE
        |--------------------------------------------------------------------------
        */

        $challenge = collect(
            $this->dailyChallenges(
                (int) $kelas->id,
                $date
            )
        )->firstWhere(
            'key',
            $key
        );

        if (!$challenge) {
            abort(404);
        }

        /*
        |--------------------------------------------------------------------------
        | CEK DOUBLE SUBMIT
        |--------------------------------------------------------------------------
        */

        $alreadyAnswered = DB::table(
            'challenge_attempts'
        )
            ->where(
                'user_id',
                $user->id
            )
            ->where(
                'kelas_id',
                $kelas->id
            )
            ->whereDate(
                'challenge_date',
                $date
            )
            ->where(
                'challenge_key',
                $key
            )
            ->exists();

        if ($alreadyAnswered) {
            return redirect()
                ->route(
                    'mahasiswa.challenge.index'
                )
                ->with(
                    'error',
                    'Challenge ini sudah kamu kerjakan hari ini.'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | VALIDASI JAWABAN
        |--------------------------------------------------------------------------
        */

        if (
            $challenge['type']
            ===
            'choice'
        ) {
            $validOptions = array_keys(
                $challenge['options']
            );

            $validated = $request->validate(
                [
                    'answer' => [
                        'required',
                        'string',
                        'in:'
                        .
                        implode(
                            ',',
                            $validOptions
                        ),
                    ],
                ],
                [
                    'answer.required' =>
                        'Pilih salah satu jawaban terlebih dahulu.',
                ]
            );
        } else {
            $validated = $request->validate(
                [
                    'answer' => [
                        'required',
                        'string',
                        'max:255',
                    ],
                ],
                [
                    'answer.required' =>
                        'Isi jawaban terlebih dahulu.',
                ]
            );
        }

        /*
        |--------------------------------------------------------------------------
        | NORMALISASI
        |--------------------------------------------------------------------------
        */

        $selected =
            $this->normalizeAnswer(
                $validated['answer']
            );

        $correct =
            $this->normalizeAnswer(
                $challenge['answer']
            );

        /*
        |--------------------------------------------------------------------------
        | BENAR / SALAH
        |--------------------------------------------------------------------------
        */

        $isCorrect =
            $selected === $correct;

        /*
        |--------------------------------------------------------------------------
        | XP
        |--------------------------------------------------------------------------
        |
        | Mudah  = 10 XP
        | Sedang = 20 XP
        | Sulit  = 30 XP
        |
        */

        $baseXp =
            $isCorrect
                ? (int) $challenge['xp']
                : 0;

        $dailyBonusEarned =
            false;

        /*
        |--------------------------------------------------------------------------
        | TRANSAKSI
        |--------------------------------------------------------------------------
        */

        DB::transaction(
            function () use (
                $user,
                $kelas,
                $date,
                $challenge,
                $selected,
                $isCorrect,
                $baseXp,
                &$dailyBonusEarned
            ) {
                /*
                |--------------------------------------------------------------------------
                | SIMPAN HASIL
                |--------------------------------------------------------------------------
                */

                DB::table(
                    'challenge_attempts'
                )->insert(
                    [
                        'user_id' =>
                            $user->id,

                        'kelas_id' =>
                            $kelas->id,

                        'challenge_date' =>
                            $date,

                        'challenge_key' =>
                            $challenge['key'],

                        'selected_answer' =>
                            $selected,

                        'is_correct' =>
                            $isCorrect,

                        'xp_earned' =>
                            $baseXp,

                        'answered_at' =>
                            now(),

                        'created_at' =>
                            now(),

                        'updated_at' =>
                            now(),
                    ]
                );

                /*
                |--------------------------------------------------------------------------
                | TAMBAH XP JIKA BENAR
                |--------------------------------------------------------------------------
                */

                if ($baseXp > 0) {
                    $this->addXp(
                        (int) $user->id,
                        (int) $kelas->id,
                        $baseXp
                    );
                }

                /*
                |--------------------------------------------------------------------------
                | HITUNG CHALLENGE YANG SUDAH DIKERJAKAN
                |--------------------------------------------------------------------------
                */

                $answeredToday = DB::table(
                    'challenge_attempts'
                )
                    ->where(
                        'user_id',
                        $user->id
                    )
                    ->where(
                        'kelas_id',
                        $kelas->id
                    )
                    ->whereDate(
                        'challenge_date',
                        $date
                    )
                    ->where(
                        'challenge_key',
                        '!=',
                        self::BONUS_KEY
                    )
                    ->count();

                /*
                |--------------------------------------------------------------------------
                | CEK BONUS
                |--------------------------------------------------------------------------
                */

                $bonusExists = DB::table(
                    'challenge_attempts'
                )
                    ->where(
                        'user_id',
                        $user->id
                    )
                    ->where(
                        'kelas_id',
                        $kelas->id
                    )
                    ->whereDate(
                        'challenge_date',
                        $date
                    )
                    ->where(
                        'challenge_key',
                        self::BONUS_KEY
                    )
                    ->exists();

                /*
                |--------------------------------------------------------------------------
                | BONUS SELESAI 6 CHALLENGE
                |--------------------------------------------------------------------------
                */

                if (
                    $answeredToday
                    >=
                    self::DAILY_COUNT
                    &&
                    !$bonusExists
                ) {
                    DB::table(
                        'challenge_attempts'
                    )->insert(
                        [
                            'user_id' =>
                                $user->id,

                            'kelas_id' =>
                                $kelas->id,

                            'challenge_date' =>
                                $date,

                            'challenge_key' =>
                                self::BONUS_KEY,

                            'selected_answer' =>
                                'BONUS',

                            'is_correct' =>
                                true,

                            'xp_earned' =>
                                self::DAILY_BONUS_XP,

                            'answered_at' =>
                                now(),

                            'created_at' =>
                                now(),

                            'updated_at' =>
                                now(),
                        ]
                    );

                    $this->addXp(
                        (int) $user->id,
                        (int) $kelas->id,
                        self::DAILY_BONUS_XP
                    );

                    $dailyBonusEarned =
                        true;
                }

                /*
                |--------------------------------------------------------------------------
                | UPDATE AKTIVITAS
                |--------------------------------------------------------------------------
                */

                DB::table(
                    'kelas_user'
                )
                    ->where(
                        'user_id',
                        $user->id
                    )
                    ->where(
                        'kelas_id',
                        $kelas->id
                    )
                    ->update(
                        [
                            'last_activity_at' =>
                                now(),

                            'updated_at' =>
                                now(),
                        ]
                    );
            }
        );

        /*
        |--------------------------------------------------------------------------
        | BENAR
        |--------------------------------------------------------------------------
        */

        if ($isCorrect) {
            $message =
                'Benar! Kamu memperoleh +'
                .
                $baseXp
                .
                ' XP.';

            if ($dailyBonusEarned) {
                $message .=
                    ' Semua 6 challenge hari ini selesai. Bonus +'
                    .
                    self::DAILY_BONUS_XP
                    .
                    ' XP diberikan!';
            }

            return redirect()
                ->route(
                    'mahasiswa.challenge.index'
                )
                ->with(
                    'success',
                    $message
                );
        }

        /*
        |--------------------------------------------------------------------------
        | SALAH
        |--------------------------------------------------------------------------
        */

        $message =
            'Jawaban belum tepat. '
            .
            'Kunci jawaban tidak ditampilkan. '
            .
            'Challenge tetap tercatat sebagai sudah dikerjakan hari ini.';

        if ($dailyBonusEarned) {
            $message .=
                ' Kamu sudah menyelesaikan seluruh 6 challenge hari ini '
                .
                'dan memperoleh bonus +'
                .
                self::DAILY_BONUS_XP
                .
                ' XP.';
        }

        return redirect()
            ->route(
                'mahasiswa.challenge.index'
            )
            ->with(
                'error',
                $message
            );
    }


    /*
    |--------------------------------------------------------------------------
    | USER DAN KELAS
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
                'Halaman Challenge hanya dapat diakses mahasiswa.'
            );
        }

        /*
        |--------------------------------------------------------------------------
        | KELAS AKTIF
        |--------------------------------------------------------------------------
        */

        $kelas = $user
            ->kelasDiikuti()
            ->with('pembuat')
            ->first();

        if (!$kelas) {
            abort(
                403,
                'Bergabunglah ke kelas terlebih dahulu untuk menggunakan Challenge.'
            );
        }

        /*
        |--------------------------------------------------------------------------
        | CHALLENGE TIDAK TERKUNCI
        |--------------------------------------------------------------------------
        |
        | Tidak ada pengecekan subbab_selesai.
        | Mahasiswa dapat membuka Challenge sejak awal.
        |
        */

        return [
            $user,
            $kelas,
        ];
    }


    /*
    |--------------------------------------------------------------------------
    | 6 CHALLENGE HARIAN
    |--------------------------------------------------------------------------
    |
    | Setiap hari:
    |
    | - 1 Challenge dari Subbab 1
    | - 1 Challenge dari Subbab 2
    | - 1 Challenge dari Subbab 3
    | - 1 Challenge dari Subbab 4
    | - 1 Challenge dari Subbab 5
    | - 1 Challenge dari Subbab 6
    |
    | Soal pada masing-masing subbab berubah berdasarkan tanggal.
    |
    */

    private function dailyChallenges(
        int $kelasId,
        string $date
    ): array {
        $bank = collect(
            config(
                'himdas_challenges',
                []
            )
        );

        if ($bank->isEmpty()) {
            abort(
                500,
                'Bank Challenge HIMDAS belum tersedia.'
            );
        }

        /*
        |--------------------------------------------------------------------------
        | SEED
        |--------------------------------------------------------------------------
        */

        $seed =
            'himdas|'
            .
            $kelasId
            .
            '|'
            .
            $date;

        /*
        |--------------------------------------------------------------------------
        | ACAK URUTAN SUBBAB
        |--------------------------------------------------------------------------
        |
        | Seluruh enam subbab tetap muncul,
        | tetapi urutan kartunya dapat berubah setiap hari.
        |
        */

        $subbabOrder = collect(
            [
                1,
                2,
                3,
                4,
                5,
                6,
            ]
        )
            ->sortBy(
                function (
                    int $subbab
                ) use (
                    $seed
                ) {
                    return hash(
                        'sha256',
                        $seed
                        .
                        '|subbab|'
                        .
                        $subbab
                    );
                }
            )
            ->take(
                self::DAILY_COUNT
            )
            ->values();

        /*
        |--------------------------------------------------------------------------
        | PILIH SATU SOAL ACAK PER SUBBAB
        |--------------------------------------------------------------------------
        */

        $selected = [];

        foreach (
            $subbabOrder
            as $subbab
        ) {
            $challenge = $bank
                ->where(
                    'subbab',
                    $subbab
                )
                ->sortBy(
                    function (
                        array $item
                    ) use (
                        $seed
                    ) {
                        return hash(
                            'sha256',
                            $seed
                            .
                            '|challenge|'
                            .
                            $item['key']
                        );
                    }
                )
                ->first();

            if ($challenge) {
                $selected[] =
                    $challenge;
            }
        }

        return $selected;
    }


    /*
    |--------------------------------------------------------------------------
    | NORMALISASI JAWABAN
    |--------------------------------------------------------------------------
    */

    private function normalizeAnswer(
        string $value
    ): string {
        $normalized = preg_replace(
            '/\s+/u',
            '',
            trim($value)
        );

        return mb_strtolower(
            $normalized ?? ''
        );
    }


    /*
    |--------------------------------------------------------------------------
    | TAMBAH XP
    |--------------------------------------------------------------------------
    */

    private function addXp(
        int $userId,
        int $kelasId,
        int $xp
    ): void {
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
            ->increment(
                'xp',
                $xp
            );
    }


    /*
    |--------------------------------------------------------------------------
    | STREAK
    |--------------------------------------------------------------------------
    |
    | Satu hari dinyatakan tuntas jika mahasiswa
    | mengerjakan seluruh 6 Challenge Harian.
    |
    */

    private function currentStreak(
        int $userId,
        int $kelasId
    ): int {
        $rows = DB::table(
            'challenge_attempts'
        )
            ->selectRaw(
                'challenge_date, COUNT(*) as total'
            )
            ->where(
                'user_id',
                $userId
            )
            ->where(
                'kelas_id',
                $kelasId
            )
            ->where(
                'challenge_key',
                '!=',
                self::BONUS_KEY
            )
            ->whereDate(
                'challenge_date',
                '>=',
                now()
                    ->subDays(60)
                    ->toDateString()
            )
            ->groupBy(
                'challenge_date'
            )
            ->get();

        $completedDays = [];

        foreach ($rows as $row) {
            $day = Carbon::parse(
                $row->challenge_date
            )->toDateString();

            $completedDays[$day] =
                (int) $row->total
                >=
                self::DAILY_COUNT;
        }

        /*
        |--------------------------------------------------------------------------
        | HITUNG STREAK
        |--------------------------------------------------------------------------
        */

        $cursor =
            now()->startOfDay();

        /*
        | Jika hari ini belum selesai,
        | streak kemarin tetap ditampilkan.
        */

        if (
            !(
                $completedDays[
                    $cursor->toDateString()
                ]
                ??
                false
            )
        ) {
            $cursor->subDay();
        }

        $streak = 0;

        while (
            $completedDays[
                $cursor->toDateString()
            ]
            ??
            false
        ) {
            $streak++;

            $cursor->subDay();
        }

        return $streak;
    }
}