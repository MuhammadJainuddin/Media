<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BadgeController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | KONFIGURASI BADGE
    |--------------------------------------------------------------------------
    */

    private const TOTAL_SUBBAB = 6;

    private const DAILY_CHALLENGE_COUNT = 6;

    private const CHALLENGE_STREAK_TARGET = 3;

    private const PASSING_SCORE = 80;

    private const BONUS_KEY = '__daily_bonus__';


    /*
    |--------------------------------------------------------------------------
    | HALAMAN BADGE
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        [
            $user,
            $kelas
        ] = $this->studentContext();


        /*
        |--------------------------------------------------------------------------
        | DATA PROGRESS MAHASISWA
        |--------------------------------------------------------------------------
        |
        | Kita query langsung kelas_user supaya field baru Latihan Akhir
        | tetap terbaca meskipun belum ditambahkan ke withPivot() pada model.
        |
        */

        $progress = DB::table('kelas_user')
            ->where(
                'user_id',
                $user->id
            )
            ->where(
                'kelas_id',
                $kelas->id
            )
            ->first();


        if (!$progress) {
            abort(
                403,
                'Data progress mahasiswa pada kelas tidak ditemukan.'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | SUBBAB SELESAI
        |--------------------------------------------------------------------------
        */

        $subbabSelesai =
            (int) (
                $progress->subbab_selesai
                ??
                0
            );


        $subbabSelesai = max(
            0,
            min(
                self::TOTAL_SUBBAB,
                $subbabSelesai
            )
        );


        /*
        |--------------------------------------------------------------------------
        | DATA LATIHAN AKHIR
        |--------------------------------------------------------------------------
        */

        $latihanNilaiTerbaik =
            $progress->latihan_akhir_nilai_terbaik
            !== null
                ? (float) $progress
                    ->latihan_akhir_nilai_terbaik
                : null;


        $latihanLulus =
            (bool) (
                $progress->latihan_akhir_lulus
                ??
                false
            );


        $latihanLulusAt =
            $progress->latihan_akhir_lulus_at
            ??
            null;


        /*
        |--------------------------------------------------------------------------
        | CHALLENGE
        |--------------------------------------------------------------------------
        */

        $challengeStats =
            $this->challengeStats(
                (int) $user->id,
                (int) $kelas->id
            );


        $maxDailyCompleted =
            $challengeStats[
                'max_daily_completed'
            ];


        $challengeHunterUnlocked =
            $challengeStats[
                'has_completed_daily'
            ];


        $currentStreak =
            $challengeStats[
                'current_streak'
            ];


        $challengeStreakUnlocked =
            $currentStreak
            >=
            self::CHALLENGE_STREAK_TARGET;


        /*
        |--------------------------------------------------------------------------
        | HIMDAS CHAMPION
        |--------------------------------------------------------------------------
        */

        $championUnlocked =
            $subbabSelesai
            >=
            self::TOTAL_SUBBAB
            &&
            $latihanLulus;


        /*
        |--------------------------------------------------------------------------
        | 9 BADGE HIMDAS
        |--------------------------------------------------------------------------
        */

        $badges = [

            /*
            |--------------------------------------------------------------------------
            | BADGE 1
            |--------------------------------------------------------------------------
            */

            [
                'key' =>
                    'pengenal-himpunan',

                'number' =>
                    1,

                'icon' =>
                    '📘',

                'title' =>
                    'Pengenal Himpunan',

                'category' =>
                    'Materi',

                'description' =>
                    'Berhasil menyelesaikan materi dasar tentang pengertian himpunan, keanggotaan, notasi, dan kardinalitas.',

                'requirement' =>
                    'Selesaikan Subbab 1 dan lulus evaluasi subbab dengan nilai minimal 80%.',

                'unlocked' =>
                    $subbabSelesai >= 1,

                'progress_current' =>
                    min(
                        $subbabSelesai,
                        1
                    ),

                'progress_target' =>
                    1,

                'progress_label' =>
                    $subbabSelesai >= 1
                        ? 'Subbab 1 selesai'
                        : 'Selesaikan Subbab 1',
            ],


            /*
            |--------------------------------------------------------------------------
            | BADGE 2
            |--------------------------------------------------------------------------
            */

            [
                'key' =>
                    'pembentuk-himpunan',

                'number' =>
                    2,

                'icon' =>
                    '🧩',

                'title' =>
                    'Pembentuk Himpunan',

                'category' =>
                    'Materi',

                'description' =>
                    'Berhasil memahami berbagai cara menyatakan himpunan menggunakan tabulasi, deskripsi, notasi pembentuk, dan diagram Venn.',

                'requirement' =>
                    'Selesaikan Subbab 2 dan lulus evaluasi subbab dengan nilai minimal 80%.',

                'unlocked' =>
                    $subbabSelesai >= 2,

                'progress_current' =>
                    min(
                        $subbabSelesai,
                        2
                    ),

                'progress_target' =>
                    2,

                'progress_label' =>
                    $subbabSelesai >= 2
                        ? 'Subbab 2 selesai'
                        : 'Progress materi '
                            .
                            $subbabSelesai
                            .
                            '/2',
            ],


            /*
            |--------------------------------------------------------------------------
            | BADGE 3
            |--------------------------------------------------------------------------
            */

            [
                'key' =>
                    'venn-master',

                'number' =>
                    3,

                'icon' =>
                    '⭕',

                'title' =>
                    'Venn Master',

                'category' =>
                    'Materi',

                'description' =>
                    'Berhasil memahami himpunan kosong, himpunan semesta, himpunan sama, lepas, bersilangan, dan ekuivalen.',

                'requirement' =>
                    'Selesaikan Subbab 3 dan lulus evaluasi subbab dengan nilai minimal 80%.',

                'unlocked' =>
                    $subbabSelesai >= 3,

                'progress_current' =>
                    min(
                        $subbabSelesai,
                        3
                    ),

                'progress_target' =>
                    3,

                'progress_label' =>
                    $subbabSelesai >= 3
                        ? 'Subbab 3 selesai'
                        : 'Progress materi '
                            .
                            $subbabSelesai
                            .
                            '/3',
            ],


            /*
            |--------------------------------------------------------------------------
            | BADGE 4
            |--------------------------------------------------------------------------
            */

            [
                'key' =>
                    'subset-master',

                'number' =>
                    4,

                'icon' =>
                    '⊂',

                'title' =>
                    'Subset Master',

                'category' =>
                    'Materi',

                'description' =>
                    'Berhasil menguasai himpunan bagian, subset sejati, banyak subset, dan himpunan kuasa.',

                'requirement' =>
                    'Selesaikan Subbab 4 dan lulus evaluasi subbab dengan nilai minimal 80%.',

                'unlocked' =>
                    $subbabSelesai >= 4,

                'progress_current' =>
                    min(
                        $subbabSelesai,
                        4
                    ),

                'progress_target' =>
                    4,

                'progress_label' =>
                    $subbabSelesai >= 4
                        ? 'Subbab 4 selesai'
                        : 'Progress materi '
                            .
                            $subbabSelesai
                            .
                            '/4',
            ],


            /*
            |--------------------------------------------------------------------------
            | BADGE 5
            |--------------------------------------------------------------------------
            */

            [
                'key' =>
                    'operation-master',

                'number' =>
                    5,

                'icon' =>
                    '∪',

                'title' =>
                    'Operation Master',

                'category' =>
                    'Materi',

                'description' =>
                    'Berhasil menguasai operasi irisan, gabungan, komplemen, selisih, beda setangkup, dan sifat operasi himpunan.',

                'requirement' =>
                    'Selesaikan Subbab 5 dan lulus evaluasi subbab dengan nilai minimal 80%.',

                'unlocked' =>
                    $subbabSelesai >= 5,

                'progress_current' =>
                    min(
                        $subbabSelesai,
                        5
                    ),

                'progress_target' =>
                    5,

                'progress_label' =>
                    $subbabSelesai >= 5
                        ? 'Subbab 5 selesai'
                        : 'Progress materi '
                            .
                            $subbabSelesai
                            .
                            '/5',
            ],


            /*
            |--------------------------------------------------------------------------
            | BADGE 6
            |--------------------------------------------------------------------------
            */

            [
                'key' =>
                    'himpunan-master',

                'number' =>
                    6,

                'icon' =>
                    '★',

                'title' =>
                    'Himpunan Master',

                'category' =>
                    'Materi',

                'description' =>
                    'Berhasil menyelesaikan seluruh materi penerapan himpunan serta pengayaan produk Kartesius, relasi, dan fungsi.',

                'requirement' =>
                    'Selesaikan Subbab 6 dan lulus evaluasi subbab dengan nilai minimal 80%.',

                'unlocked' =>
                    $subbabSelesai >= 6,

                'progress_current' =>
                    $subbabSelesai,

                'progress_target' =>
                    6,

                'progress_label' =>
                    $subbabSelesai >= 6
                        ? 'Seluruh 6 subbab selesai'
                        : 'Progress materi '
                            .
                            $subbabSelesai
                            .
                            '/6',
            ],


            /*
            |--------------------------------------------------------------------------
            | BADGE 7
            |--------------------------------------------------------------------------
            */

            [
                'key' =>
                    'challenge-hunter',

                'number' =>
                    7,

                'icon' =>
                    '⚡',

                'title' =>
                    'Challenge Hunter',

                'category' =>
                    'Challenge',

                'description' =>
                    'Berhasil menuntaskan satu paket Challenge Harian HIMDAS yang terdiri dari enam challenge.',

                'requirement' =>
                    'Kerjakan seluruh 6 Challenge Harian dalam satu hari.',

                'unlocked' =>
                    $challengeHunterUnlocked,

                'progress_current' =>
                    min(
                        $maxDailyCompleted,
                        self::DAILY_CHALLENGE_COUNT
                    ),

                'progress_target' =>
                    self::DAILY_CHALLENGE_COUNT,

                'progress_label' =>
                    $challengeHunterUnlocked
                        ? '6/6 Challenge Harian selesai'
                        : $maxDailyCompleted
                            .
                            '/6 Challenge selesai',
            ],


            /*
            |--------------------------------------------------------------------------
            | BADGE 8
            |--------------------------------------------------------------------------
            */

            [
                'key' =>
                    'challenge-streak',

                'number' =>
                    8,

                'icon' =>
                    '🔥',

                'title' =>
                    'Challenge Streak',

                'category' =>
                    'Challenge',

                'description' =>
                    'Menunjukkan konsistensi belajar dengan menyelesaikan Challenge Harian selama beberapa hari berturut-turut.',

                'requirement' =>
                    'Selesaikan seluruh 6 Challenge Harian selama 3 hari berturut-turut.',

                'unlocked' =>
                    $challengeStreakUnlocked,

                'progress_current' =>
                    min(
                        $currentStreak,
                        self::CHALLENGE_STREAK_TARGET
                    ),

                'progress_target' =>
                    self::CHALLENGE_STREAK_TARGET,

                'progress_label' =>
                    $challengeStreakUnlocked
                        ? 'Streak 3 hari tercapai'
                        : 'Streak '
                            .
                            $currentStreak
                            .
                            '/3 hari',
            ],


            /*
            |--------------------------------------------------------------------------
            | BADGE 9
            |--------------------------------------------------------------------------
            */

            [
                'key' =>
                    'himdas-champion',

                'number' =>
                    9,

                'icon' =>
                    '🏆',

                'title' =>
                    'HIMDAS Champion',

                'category' =>
                    'Pencapaian Akhir',

                'description' =>
                    'Badge tertinggi HIMDAS untuk mahasiswa yang telah menyelesaikan seluruh materi dan lulus Latihan Akhir.',

                'requirement' =>
                    'Selesaikan seluruh 6 subbab dan raih nilai minimal 80% pada Latihan Akhir.',

                'unlocked' =>
                    $championUnlocked,

                /*
                |--------------------------------------------------------------------------
                | PROGRESS CHAMPION
                |--------------------------------------------------------------------------
                |
                | 6 tahap materi + 1 tahap Latihan Akhir.
                |
                */

                'progress_current' =>
                    min(
                        $subbabSelesai,
                        6
                    )
                    +
                    (
                        $latihanLulus
                            ? 1
                            : 0
                    ),

                'progress_target' =>
                    7,

                'progress_label' =>
                    $championUnlocked
                        ? 'Seluruh syarat HIMDAS Champion terpenuhi'
                        : $this->championProgressLabel(
                            $subbabSelesai,
                            $latihanLulus,
                            $latihanNilaiTerbaik
                        ),

                'best_score' =>
                    $latihanNilaiTerbaik,

                'earned_at' =>
                    $championUnlocked
                    &&
                    $latihanLulusAt
                        ? Carbon::parse(
                            $latihanLulusAt
                        )
                            ->locale('id')
                            ->translatedFormat(
                                'd F Y'
                            )
                        : null,
            ],

        ];


        /*
        |--------------------------------------------------------------------------
        | JUMLAH BADGE
        |--------------------------------------------------------------------------
        */

        $totalBadges =
            count($badges);


        $earnedBadges =
            collect($badges)
                ->where(
                    'unlocked',
                    true
                )
                ->count();


        /*
        |--------------------------------------------------------------------------
        | PERSENTASE BADGE
        |--------------------------------------------------------------------------
        */

        $badgePercent =
            $totalBadges > 0
                ? (int) round(
                    (
                        $earnedBadges
                        /
                        $totalBadges
                    )
                    *
                    100
                )
                : 0;


        /*
        |--------------------------------------------------------------------------
        | STATISTIK UNTUK VIEW
        |--------------------------------------------------------------------------
        */

        $stats = [

            'earned' =>
                $earnedBadges,

            'total' =>
                $totalBadges,

            'percent' =>
                $badgePercent,

            'subbab_selesai' =>
                $subbabSelesai,

            'challenge_streak' =>
                $currentStreak,

            'latihan_nilai' =>
                $latihanNilaiTerbaik,

            'latihan_lulus' =>
                $latihanLulus,

        ];


        return view(
            'mahasiswa.badge.index',
            compact(
                'kelas',
                'badges',
                'stats'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | CONTEXT MAHASISWA
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
                'Halaman Badge hanya dapat diakses mahasiswa.'
            );
        }


        $kelas = $user
            ->kelasDiikuti()
            ->with(
                'pembuat'
            )
            ->first();


        if (!$kelas) {
            abort(
                403,
                'Bergabunglah ke kelas terlebih dahulu untuk melihat Badge.'
            );
        }


        return [
            $user,
            $kelas,
        ];
    }


    /*
    |--------------------------------------------------------------------------
    | STATISTIK CHALLENGE
    |--------------------------------------------------------------------------
    */

    private function challengeStats(
        int $userId,
        int $kelasId
    ): array {
        /*
        |--------------------------------------------------------------------------
        | JUMLAH CHALLENGE PER HARI
        |--------------------------------------------------------------------------
        |
        | Bonus harian tidak dihitung sebagai challenge.
        |
        */

        $dailyRows = DB::table(
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
            ->groupBy(
                'challenge_date'
            )
            ->orderBy(
                'challenge_date'
            )
            ->get();


        /*
        |--------------------------------------------------------------------------
        | PROGRESS HARI TERBAIK
        |--------------------------------------------------------------------------
        */

        $maxDailyCompleted =
            0;


        foreach ($dailyRows as $row) {
            $maxDailyCompleted =
                max(
                    $maxDailyCompleted,
                    (int) $row->total
                );
        }


        /*
        |--------------------------------------------------------------------------
        | PERNAH MENYELESAIKAN 6 CHALLENGE DALAM SATU HARI
        |--------------------------------------------------------------------------
        */

        $hasCompletedDaily =
            $maxDailyCompleted
            >=
            self::DAILY_CHALLENGE_COUNT;


        /*
        |--------------------------------------------------------------------------
        | CURRENT STREAK
        |--------------------------------------------------------------------------
        */

        $completedDays = [];


        foreach ($dailyRows as $row) {
            $day = Carbon::parse(
                $row->challenge_date
            )->toDateString();


            $completedDays[$day] =
                (int) $row->total
                >=
                self::DAILY_CHALLENGE_COUNT;
        }


        $cursor =
            now()
                ->startOfDay();


        /*
        |--------------------------------------------------------------------------
        | HARI INI BELUM SELESAI
        |--------------------------------------------------------------------------
        |
        | Kalau hari ini belum selesai, streak kemarin tetap ditampilkan.
        |
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


        $currentStreak =
            0;


        while (
            $completedDays[
                $cursor->toDateString()
            ]
            ??
            false
        ) {
            $currentStreak++;

            $cursor->subDay();
        }


        return [

            'max_daily_completed' =>
                $maxDailyCompleted,

            'has_completed_daily' =>
                $hasCompletedDaily,

            'current_streak' =>
                $currentStreak,

        ];
    }


    /*
    |--------------------------------------------------------------------------
    | LABEL PROGRESS HIMDAS CHAMPION
    |--------------------------------------------------------------------------
    */

    private function championProgressLabel(
        int $subbabSelesai,
        bool $latihanLulus,
        ?float $latihanNilaiTerbaik
    ): string {
        /*
        |--------------------------------------------------------------------------
        | MATERI BELUM SELESAI
        |--------------------------------------------------------------------------
        */

        if (
            $subbabSelesai <
            self::TOTAL_SUBBAB
        ) {
            return
                'Selesaikan materi: '
                .
                $subbabSelesai
                .
                '/6 subbab selesai';
        }


        /*
        |--------------------------------------------------------------------------
        | SUDAH LULUS
        |--------------------------------------------------------------------------
        */

        if ($latihanLulus) {
            return
                'Seluruh syarat HIMDAS Champion terpenuhi';
        }


        /*
        |--------------------------------------------------------------------------
        | SUDAH PERNAH LATIHAN, TAPI NILAI BELUM 80
        |--------------------------------------------------------------------------
        */

        if (
            $latihanNilaiTerbaik
            !==
            null
        ) {
            return
                'Nilai terbaik Latihan Akhir '
                .
                $this->formatScore(
                    $latihanNilaiTerbaik
                )
                .
                '%. Target minimal '
                .
                self::PASSING_SCORE
                .
                '%.';
        }


        /*
        |--------------------------------------------------------------------------
        | BELUM MENGERJAKAN LATIHAN AKHIR
        |--------------------------------------------------------------------------
        */

        return
            'Kerjakan Latihan Akhir dan raih nilai minimal '
            .
            self::PASSING_SCORE
            .
            '%.';
    }


    /*
    |--------------------------------------------------------------------------
    | FORMAT NILAI
    |--------------------------------------------------------------------------
    */

    private function formatScore(
        float $score
    ): string {
        if (
            floor($score)
            ===
            $score
        ) {
            return
                (string) (int) $score;
        }


        return number_format(
            $score,
            2,
            ',',
            '.'
        );
    }
}