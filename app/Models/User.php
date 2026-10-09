<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use HasFactory, Notifiable;


    private const TOTAL_SUBBAB = 6;

    private const DAILY_CHALLENGE_COUNT = 6;

    private const CHALLENGE_STREAK_TARGET = 3;

    private const PASSING_SCORE = 80;

    private const BONUS_KEY = '__daily_bonus__';


    protected $fillable = [
        'name',
        'email',
        'whatsapp',
        'password',
        'role',
    ];


    protected $hidden = [
        'password',
        'remember_token',
    ];


    protected function casts(): array
    {
        return [
            'email_verified_at' =>
                'datetime',

            'password' =>
                'hashed',
        ];
    }


    /*
    |--------------------------------------------------------------------------
    | KELAS YANG DIBUAT
    |--------------------------------------------------------------------------
    */

    public function kelasDibuat()
    {
        return $this->hasMany(
            Kelas::class,
            'created_by'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | KELAS YANG DIIKUTI
    |--------------------------------------------------------------------------
    */

    public function kelasDiikuti()
    {
        return $this
            ->belongsToMany(
                Kelas::class,
                'kelas_user'
            )
            ->withPivot([
                'xp',

                'latihan_akhir_nilai_terbaik',
                'latihan_akhir_lulus',
                'latihan_akhir_lulus_at',

                'subbab_selesai',
                'total_subbab',
                'progress_percent',
                'last_activity_at',
            ])
            ->withTimestamps();
    }


    /*
    |--------------------------------------------------------------------------
    | RELASI BADGE LAMA
    |--------------------------------------------------------------------------
    |
    | Tetap dipertahankan agar tidak merusak kode lama.
    |
    */

    public function badges()
    {
        return $this
            ->belongsToMany(
                Badge::class,
                'badge_user'
            )
            ->withPivot([
                'kelas_id',
                'earned_at',
            ])
            ->withTimestamps();
    }


    /*
    |--------------------------------------------------------------------------
    | ROLE
    |--------------------------------------------------------------------------
    */

    public function isMahasiswa(): bool
    {
        return $this->role === 'mahasiswa';
    }


    public function isDosen(): bool
    {
        return $this->role === 'dosen';
    }


    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }


    public function isStaff(): bool
    {
        return in_array(
            $this->role,
            [
                'dosen',
                'admin',
            ],
            true
        );
    }


    /*
    |--------------------------------------------------------------------------
    | DATA BADGE HIMDAS
    |--------------------------------------------------------------------------
    |
    | Badge tidak lagi bergantung pada badge_user.
    |
    | Badge dihitung berdasarkan aktivitas mahasiswa:
    |
    | - Subbab selesai
    | - Challenge Harian
    | - Challenge Streak
    | - Latihan Akhir
    |
    */

    public function himdasBadgeData(
        int $kelasId
    ): array {

        /*
        |--------------------------------------------------------------------------
        | PROGRESS KELAS
        |--------------------------------------------------------------------------
        */

        $progress =
            DB::table(
                'kelas_user'
            )
            ->where(
                'user_id',
                $this->id
            )
            ->where(
                'kelas_id',
                $kelasId
            )
            ->first();


        /*
        |--------------------------------------------------------------------------
        | SUBBAB
        |--------------------------------------------------------------------------
        */

        $subbabSelesai =
            (int) (
                $progress
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


        /*
        |--------------------------------------------------------------------------
        | LATIHAN AKHIR
        |--------------------------------------------------------------------------
        */

        $latihanNilaiTerbaik =
            isset(
                $progress
                    ->latihan_akhir_nilai_terbaik
            )
            &&
            $progress
                ->latihan_akhir_nilai_terbaik
            !== null

                ? (float)
                    $progress
                        ->latihan_akhir_nilai_terbaik

                : null;


        $latihanLulus =
            (bool) (
                $progress
                    ->latihan_akhir_lulus
                ??
                false
            );


        $latihanLulusAt =
            $progress
                ->latihan_akhir_lulus_at
            ??
            null;


        /*
        |--------------------------------------------------------------------------
        | CHALLENGE HARIAN
        |--------------------------------------------------------------------------
        */

        $dailyRows =
            DB::table(
                'challenge_attempts'
            )
            ->selectRaw(
                '
                challenge_date,
                COUNT(*) as total
                '
            )
            ->where(
                'user_id',
                $this->id
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


        $maxDailyCompleted = 0;

        $completedDays = [];


        foreach (
            $dailyRows
            as $row
        ) {

            $total =
                (int)
                $row->total;


            $date =
                Carbon::parse(
                    $row->challenge_date
                )
                ->toDateString();


            $maxDailyCompleted =
                max(
                    $maxDailyCompleted,
                    $total
                );


            $completedDays[
                $date
            ] =
                $total
                >=
                self::DAILY_CHALLENGE_COUNT;

        }


        /*
        |--------------------------------------------------------------------------
        | CURRENT STREAK
        |--------------------------------------------------------------------------
        */

        $cursor =
            now()
                ->startOfDay();


        if (
            !(
                $completedDays[
                    $cursor
                        ->toDateString()
                ]
                ??
                false
            )
        ) {

            $cursor->subDay();

        }


        $currentStreak = 0;


        while (
            $completedDays[
                $cursor
                    ->toDateString()
            ]
            ??
            false
        ) {

            $currentStreak++;

            $cursor->subDay();

        }


        /*
        |--------------------------------------------------------------------------
        | STATUS BADGE KHUSUS
        |--------------------------------------------------------------------------
        */

        $challengeHunterUnlocked =
            $maxDailyCompleted
            >=
            self::DAILY_CHALLENGE_COUNT;


        $challengeStreakUnlocked =
            $currentStreak
            >=
            self::CHALLENGE_STREAK_TARGET;


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
                    'Selesaikan Subbab 1 dan lulus evaluasi dengan nilai minimal 80%.',

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
                    'Selesaikan Subbab 2 dan lulus evaluasi dengan nilai minimal 80%.',

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

                        :
                        'Progress materi '
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
                    'Berhasil memahami himpunan kosong, semesta, sama, lepas, bersilangan, dan ekuivalen.',

                'requirement' =>
                    'Selesaikan Subbab 3 dan lulus evaluasi dengan nilai minimal 80%.',

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

                        :
                        'Progress materi '
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
                    'Selesaikan Subbab 4 dan lulus evaluasi dengan nilai minimal 80%.',

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

                        :
                        'Progress materi '
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
                    'Selesaikan Subbab 5 dan lulus evaluasi dengan nilai minimal 80%.',

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

                        :
                        'Progress materi '
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
                    'Berhasil menyelesaikan seluruh materi penerapan himpunan dan pengayaan pada level akhir.',

                'requirement' =>
                    'Selesaikan Subbab 6 dan lulus evaluasi dengan nilai minimal 80%.',

                'unlocked' =>
                    $subbabSelesai >= 6,

                'progress_current' =>
                    $subbabSelesai,

                'progress_target' =>
                    6,

                'progress_label' =>
                    $subbabSelesai >= 6

                        ? 'Seluruh 6 subbab selesai'

                        :
                        'Progress materi '
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

                        :
                        $maxDailyCompleted
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

                        :
                        'Streak '
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

                        :
                        $this->championProgressLabel(
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
        | BADGE YANG SUDAH DIPEROLEH
        |--------------------------------------------------------------------------
        */

        $earnedBadges =
            collect(
                $badges
            )
            ->where(
                'unlocked',
                true
            )
            ->values();


        $totalBadges =
            count(
                $badges
            );


        $earnedCount =
            $earnedBadges
                ->count();


        return [

            'badges' =>
                $badges,

            'earned_badges' =>
                $earnedBadges,

            'latest_badge' =>
                $earnedBadges
                    ->last(),

            'stats' => [

                'earned' =>
                    $earnedCount,

                'total' =>
                    $totalBadges,

                'percent' =>
                    $totalBadges > 0

                        ? (int) round(
                            (
                                $earnedCount
                                /
                                $totalBadges
                            )
                            *
                            100
                        )

                        : 0,

                'subbab_selesai' =>
                    $subbabSelesai,

                'challenge_streak' =>
                    $currentStreak,

                'max_daily_completed' =>
                    $maxDailyCompleted,

                'latihan_nilai' =>
                    $latihanNilaiTerbaik,

                'latihan_lulus' =>
                    $latihanLulus,
            ],

        ];
    }


    private function championProgressLabel(
        int $subbabSelesai,
        bool $latihanLulus,
        ?float $latihanNilaiTerbaik
    ): string {

        if (
            $subbabSelesai
            <
            self::TOTAL_SUBBAB
        ) {

            return
                'Selesaikan materi: '
                .
                $subbabSelesai
                .
                '/6 subbab selesai';

        }


        if ($latihanLulus) {

            return
                'Seluruh syarat HIMDAS Champion terpenuhi';

        }


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


        return
            'Kerjakan Latihan Akhir dan raih nilai minimal '
            .
            self::PASSING_SCORE
            .
            '%.';
    }


    private function formatScore(
        float $score
    ): string {

        if (
            floor(
                $score
            )
            ===
            $score
        ) {

            return
                (string)
                (int)
                $score;

        }


        return
            number_format(
                $score,
                2,
                ',',
                '.'
            );
    }
}