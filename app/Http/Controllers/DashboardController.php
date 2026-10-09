<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    private const DAILY_CHALLENGE_COUNT = 6;

    private const BONUS_KEY =
        '__daily_bonus__';


    /*
    |--------------------------------------------------------------------------
    | DASHBOARD DOSEN
    |--------------------------------------------------------------------------
    */

    public function dosen()
    {
        /** @var User|null $user */
        $user =
            Auth::user();


        if (!$user) {

            return redirect()
                ->route(
                    'login'
                );

        }


        if (
            !$user->isStaff()
        ) {

            return redirect()
                ->route(
                    'mahasiswa.dashboard'
                );

        }


        /*
        |--------------------------------------------------------------------------
        | KELAS
        |--------------------------------------------------------------------------
        */

        if (
            $user->isAdmin()
        ) {

            $kelas =
                Kelas::query()
                    ->with([
                        'mahasiswa',
                        'pembuat',
                    ])
                    ->latest()
                    ->get();

        } else {

            $kelas =
                $user
                    ->kelasDibuat()
                    ->with([
                        'mahasiswa',
                        'pembuat',
                    ])
                    ->latest()
                    ->get();

        }


        /*
        |--------------------------------------------------------------------------
        | DATA SELURUH KEANGGOTAAN KELAS
        |--------------------------------------------------------------------------
        */

        $memberships =
            collect();


        foreach (
            $kelas
            as $item
        ) {

            $studentCount =
                $item
                    ->mahasiswa
                    ->count();


            $totalProgress = 0;

            $totalBadgeKelas = 0;

            $totalXpKelas = 0;

            $completedStudents = 0;

            $needAttentionCount = 0;


            foreach (
                $item->mahasiswa
                as $student
            ) {

                $progress =
                    $this
                        ->normalizedProgress(
                            $student
                        );


                $totalProgress +=
                    $progress;


                $totalXpKelas +=
                    (int) (
                        $student
                            ->pivot
                            ->xp
                        ??
                        0
                    );


                /*
                |--------------------------------------------------------------------------
                | BADGE AKTUAL MAHASISWA
                |--------------------------------------------------------------------------
                */

                $achievement =
                    $student
                        ->himdasBadgeData(
                            (int)
                            $item->id
                        );


                $badgeCount =
                    (int) (
                        $achievement[
                            'stats'
                        ][
                            'earned'
                        ]
                        ??
                        0
                    );


                $totalBadgeKelas +=
                    $badgeCount;


                $status =
                    $this
                        ->studentMonitoringStatus(
                            $student
                        );


                if (
                    $status
                    ===
                    'completed'
                ) {

                    $completedStudents++;

                }


                if (
                    $status
                    ===
                    'attention'
                ) {

                    $needAttentionCount++;

                }


                $memberships
                    ->push([

                        'student' =>
                            $student,

                        'kelas' =>
                            $item,

                        'progress' =>
                            $progress,

                        'xp' =>
                            (int) (
                                $student
                                    ->pivot
                                    ->xp
                                ??
                                0
                            ),

                        'badge_count' =>
                            $badgeCount,

                        'status' =>
                            $status,

                        'last_activity_at' =>
                            $student
                                ->pivot
                                ->last_activity_at
                            ??
                            null,

                    ]);

            }


            /*
            |--------------------------------------------------------------------------
            | RATA-RATA KELAS
            |--------------------------------------------------------------------------
            */

            $averageProgress =
                $studentCount > 0

                    ? (int) round(
                        $totalProgress
                        /
                        $studentCount
                    )

                    : 0;


            /*
            |--------------------------------------------------------------------------
            | DATA TAMBAHAN UNTUK CARD KELAS
            |--------------------------------------------------------------------------
            */

            $item->setAttribute(
                'student_count',
                $studentCount
            );


            $item->setAttribute(
                'average_progress',
                $averageProgress
            );


            $item->setAttribute(
                'total_badges',
                $totalBadgeKelas
            );


            $item->setAttribute(
                'total_xp',
                $totalXpKelas
            );


            $item->setAttribute(
                'completed_students',
                $completedStudents
            );


            $item->setAttribute(
                'need_attention_count',
                $needAttentionCount
            );

        }


        /*
        |--------------------------------------------------------------------------
        | STATISTIK DASHBOARD
        |--------------------------------------------------------------------------
        */

        $totalKelas =
            $kelas->count();


        $totalMahasiswa =
            $memberships
                ->pluck(
                    'student'
                )
                ->unique(
                    'id'
                )
                ->count();


        $rataProgress =
            $memberships
                ->isNotEmpty()

                ? (int) round(
                    $memberships
                        ->avg(
                            'progress'
                        )
                )

                : 0;


        $totalBadge =
            (int)
            $memberships
                ->sum(
                    'badge_count'
                );


        $totalXp =
            (int)
            $memberships
                ->sum(
                    'xp'
                );


        /*
        |--------------------------------------------------------------------------
        | MAHASISWA SELESAI
        |--------------------------------------------------------------------------
        */

        $selesaiMateri =
            $memberships
                ->where(
                    'status',
                    'completed'
                )
                ->count();


        /*
        |--------------------------------------------------------------------------
        | PERLU PERHATIAN
        |--------------------------------------------------------------------------
        */

        $perluPerhatian =
            $memberships
                ->where(
                    'status',
                    'attention'
                )
                ->count();


        /*
        |--------------------------------------------------------------------------
        | AKTIF HARI INI
        |--------------------------------------------------------------------------
        */

        $aktifHariIni =
            $memberships
                ->filter(
                    function (
                        $item
                    ) {

                        $lastActivity =
                            $item[
                                'last_activity_at'
                            ];


                        return
                            $lastActivity

                            &&

                            Carbon::parse(
                                $lastActivity
                            )
                            ->isToday();

                    }
                )
                ->count();


        /*
        |--------------------------------------------------------------------------
        | AKTIVITAS TERBARU
        |--------------------------------------------------------------------------
        */

        $aktivitasTerbaru =
            $memberships
                ->filter(
                    fn ($item) =>
                        !empty(
                            $item[
                                'last_activity_at'
                            ]
                        )
                )
                ->sortByDesc(
                    function (
                        $item
                    ) {

                        return
                            Carbon::parse(
                                $item[
                                    'last_activity_at'
                                ]
                            )
                            ->timestamp;

                    }
                )
                ->take(
                    6
                )
                ->values();


        return view(
            'dosen.dashboard',
            compact(
                'kelas',
                'totalKelas',
                'totalMahasiswa',
                'rataProgress',
                'totalBadge',
                'totalXp',
                'selesaiMateri',
                'perluPerhatian',
                'aktifHariIni',
                'aktivitasTerbaru'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | DETAIL KELAS DOSEN
    |--------------------------------------------------------------------------
    */

    public function kelasDetail(
        Kelas $kelas
    ) {

        /** @var User|null $user */
        $user =
            Auth::user();


        if (!$user) {

            return redirect()
                ->route(
                    'login'
                );

        }


        if (
            !$user->isStaff()
        ) {

            return redirect()
                ->route(
                    'mahasiswa.dashboard'
                );

        }


        /*
        |--------------------------------------------------------------------------
        | DOSEN HANYA BISA MEMBUKA KELAS MILIKNYA
        |--------------------------------------------------------------------------
        */

        if (
            $user->isDosen()

            &&

            (int)
            $kelas->created_by

            !==

            (int)
            $user->id
        ) {

            abort(
                403,
                'Anda tidak memiliki akses ke kelas ini.'
            );

        }


        $kelas->load(
            'pembuat'
        );


        /*
        |--------------------------------------------------------------------------
        | MAHASISWA
        |--------------------------------------------------------------------------
        */

        $mahasiswa =
            $kelas
                ->mahasiswa()
                ->get();


        /*
        |--------------------------------------------------------------------------
        | HITUNG BADGE & STATUS MAHASISWA
        |--------------------------------------------------------------------------
        */

        foreach (
            $mahasiswa
            as $student
        ) {

            $achievement =
                $student
                    ->himdasBadgeData(
                        (int)
                        $kelas->id
                    );


            $earnedBadges =
                collect(
                    $achievement[
                        'earned_badges'
                    ]
                );


            /*
            |--------------------------------------------------------------------------
            | BADGE UNTUK VIEW
            |--------------------------------------------------------------------------
            */

            $student
                ->setRelation(
                    'himdasBadges',
                    $earnedBadges
                );


            $student
                ->setAttribute(
                    'himdas_badge_count',
                    (int) (
                        $achievement[
                            'stats'
                        ][
                            'earned'
                        ]
                        ??
                        0
                    )
                );


            $student
                ->setAttribute(
                    'himdas_streak',
                    (int) (
                        $achievement[
                            'stats'
                        ][
                            'challenge_streak'
                        ]
                        ??
                        0
                    )
                );


            $student
                ->setAttribute(
                    'himdas_latihan_score',
                    $achievement[
                        'stats'
                    ][
                        'latihan_nilai'
                    ]
                    ??
                    null
                );


            $student
                ->setAttribute(
                    'himdas_latihan_lulus',
                    (bool) (
                        $achievement[
                            'stats'
                        ][
                            'latihan_lulus'
                        ]
                        ??
                        false
                    )
                );


            $student
                ->setAttribute(
                    'monitoring_status',
                    $this
                        ->studentMonitoringStatus(
                            $student
                        )
                );

        }


        /*
        |--------------------------------------------------------------------------
        | LEADERBOARD
        |--------------------------------------------------------------------------
        */

        $leaderboard =
            $mahasiswa
                ->sort(
                    function (
                        $a,
                        $b
                    ) {

                        $xpCompare =
                            (int) (
                                $b
                                    ->pivot
                                    ->xp
                                ??
                                0
                            )
                            <=>
                            (int) (
                                $a
                                    ->pivot
                                    ->xp
                                ??
                                0
                            );


                        if (
                            $xpCompare
                            !==
                            0
                        ) {

                            return
                                $xpCompare;

                        }


                        $subbabCompare =
                            (int) (
                                $b
                                    ->pivot
                                    ->subbab_selesai
                                ??
                                0
                            )
                            <=>
                            (int) (
                                $a
                                    ->pivot
                                    ->subbab_selesai
                                ??
                                0
                            );


                        if (
                            $subbabCompare
                            !==
                            0
                        ) {

                            return
                                $subbabCompare;

                        }


                        return
                            strcasecmp(
                                $a->name,
                                $b->name
                            );

                    }
                )
                ->values();


        foreach (
            $leaderboard
            as $index => $student
        ) {

            $student
                ->setAttribute(
                    'rank',
                    $index + 1
                );

        }


        /*
        |--------------------------------------------------------------------------
        | STATISTIK
        |--------------------------------------------------------------------------
        */

        $jumlahMahasiswa =
            $mahasiswa
                ->count();


        $rataProgress =
            $jumlahMahasiswa > 0

                ? (int) round(
                    $mahasiswa
                        ->avg(
                            fn ($student) =>
                                $this
                                    ->normalizedProgress(
                                        $student
                                    )
                        )
                )

                : 0;


        $totalBadge =
            (int)
            $mahasiswa
                ->sum(
                    'himdas_badge_count'
                );


        $totalXp =
            (int)
            $mahasiswa
                ->sum(
                    fn ($student) =>
                        (int) (
                            $student
                                ->pivot
                                ->xp
                            ??
                            0
                        )
                );


        /*
        |--------------------------------------------------------------------------
        | SELESAI MATERI
        |--------------------------------------------------------------------------
        */

        $selesaiMateri =
            $mahasiswa
                ->filter(
                    fn ($student) =>
                        $student
                            ->monitoring_status
                        ===
                        'completed'
                )
                ->count();


        /*
        |--------------------------------------------------------------------------
        | PERLU PERHATIAN
        |--------------------------------------------------------------------------
        */

        $perluPerhatian =
            $mahasiswa
                ->filter(
                    fn ($student) =>
                        $student
                            ->monitoring_status
                        ===
                        'attention'
                )
                ->count();


        /*
        |--------------------------------------------------------------------------
        | AKTIF HARI INI
        |--------------------------------------------------------------------------
        */

        $aktifHariIni =
            $mahasiswa
                ->filter(
                    function (
                        $student
                    ) {

                        $lastActivity =
                            $student
                                ->pivot
                                ->last_activity_at
                            ??
                            null;


                        return
                            $lastActivity

                            &&

                            Carbon::parse(
                                $lastActivity
                            )
                            ->isToday();

                    }
                )
                ->count();


        /*
        |--------------------------------------------------------------------------
        | JUMLAH CHALLENGE HARI INI
        |--------------------------------------------------------------------------
        */

        $challengeHariIni =
            DB::table(
                'challenge_attempts'
            )
            ->where(
                'kelas_id',
                $kelas->id
            )
            ->whereDate(
                'challenge_date',
                now()
                    ->toDateString()
            )
            ->where(
                'challenge_key',
                '!=',
                self::BONUS_KEY
            )
            ->count();


        /*
        |--------------------------------------------------------------------------
        | MAHASISWA YANG SELESAI 6 CHALLENGE HARI INI
        |--------------------------------------------------------------------------
        */

        $challengeSelesaiHariIni =
            DB::table(
                'challenge_attempts'
            )
            ->selectRaw(
                '
                user_id,
                COUNT(*) as total
                '
            )
            ->where(
                'kelas_id',
                $kelas->id
            )
            ->whereDate(
                'challenge_date',
                now()
                    ->toDateString()
            )
            ->where(
                'challenge_key',
                '!=',
                self::BONUS_KEY
            )
            ->groupBy(
                'user_id'
            )
            ->get()
            ->filter(
                fn ($row) =>
                    (int)
                    $row->total
                    >=
                    self::DAILY_CHALLENGE_COUNT
            )
            ->count();


        /*
        |--------------------------------------------------------------------------
        | AKTIVITAS TERBARU
        |--------------------------------------------------------------------------
        */

        $aktivitasTerbaru =
            $mahasiswa
                ->filter(
                    fn ($student) =>
                        !empty(
                            $student
                                ->pivot
                                ->last_activity_at
                        )
                )
                ->sortByDesc(
                    function (
                        $student
                    ) {

                        return
                            Carbon::parse(
                                $student
                                    ->pivot
                                    ->last_activity_at
                            )
                            ->timestamp;

                    }
                )
                ->take(
                    8
                )
                ->values();


        /*
        |--------------------------------------------------------------------------
        | MAHASISWA PERLU PERHATIAN
        |--------------------------------------------------------------------------
        */

        $mahasiswaPerluPerhatian =
            $mahasiswa
                ->filter(
                    fn ($student) =>
                        $student
                            ->monitoring_status
                        ===
                        'attention'
                )
                ->values();


        return view(
            'dosen.kelas.show',
            compact(
                'kelas',
                'mahasiswa',
                'leaderboard',
                'rataProgress',
                'totalBadge',
                'totalXp',
                'selesaiMateri',
                'perluPerhatian',
                'aktifHariIni',
                'challengeHariIni',
                'challengeSelesaiHariIni',
                'aktivitasTerbaru',
                'mahasiswaPerluPerhatian'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | DASHBOARD MAHASISWA
    |--------------------------------------------------------------------------
    */

    public function mahasiswa()
    {
        /** @var User|null $user */
        $user =
            Auth::user();


        if (!$user) {

            return redirect()
                ->route(
                    'login'
                );

        }


        if (
            !$user->isMahasiswa()
        ) {

            return redirect()
                ->route(
                    'dosen.dashboard'
                );

        }


        /*
        |--------------------------------------------------------------------------
        | KELAS AKTIF
        |--------------------------------------------------------------------------
        */

        $kelas =
            $user
                ->kelasDiikuti()
                ->with(
                    'pembuat'
                )
                ->first();


        /*
        |--------------------------------------------------------------------------
        | TANGGAL
        |--------------------------------------------------------------------------
        */

        $tanggalHariIni =
            now()
                ->locale(
                    'id'
                )
                ->translatedFormat(
                    'l, d F Y'
                );


        /*
        |--------------------------------------------------------------------------
        | SEMESTER
        |--------------------------------------------------------------------------
        */

        $semester =
            now()->month >= 7
                ? 1
                : 2;


        $challengeDailyTotal =
            self::DAILY_CHALLENGE_COUNT;


        /*
        |--------------------------------------------------------------------------
        | BELUM ADA KELAS
        |--------------------------------------------------------------------------
        */

        if (!$kelas) {

            return view(
                'mahasiswa.dashboard',
                [

                    'kelas' =>
                        null,

                    'progress' =>
                        0,

                    'xp' =>
                        0,

                    'subbabSelesai' =>
                        0,

                    'totalSubbab' =>
                        6,

                    'sedangDipelajari' =>
                        'Belum ada materi',

                    'badges' =>
                        collect(),

                    'badgeTerbaru' =>
                        null,

                    'leaderboard' =>
                        collect(),

                    'peringkat' =>
                        null,

                    'tanggalHariIni' =>
                        $tanggalHariIni,

                    'semester' =>
                        $semester,

                    'aktivitasTerakhir' =>
                        null,

                    'challengeCompletedToday' =>
                        0,

                    'challengeDailyTotal' =>
                        $challengeDailyTotal,

                    'challengeXpToday' =>
                        0,

                ]
            );

        }


        /*
        |--------------------------------------------------------------------------
        | PROGRESS
        |--------------------------------------------------------------------------
        */

        $progress =
            max(
                0,
                min(
                    100,
                    (float) (
                        $kelas
                            ->pivot
                            ->progress_percent
                        ??
                        0
                    )
                )
            );


        /*
        |--------------------------------------------------------------------------
        | XP
        |--------------------------------------------------------------------------
        */

        $xp =
            (int) (
                $kelas
                    ->pivot
                    ->xp
                ??
                0
            );


        /*
        |--------------------------------------------------------------------------
        | SUBBAB
        |--------------------------------------------------------------------------
        */

        $subbabSelesai =
            max(
                0,
                min(
                    6,
                    (int) (
                        $kelas
                            ->pivot
                            ->subbab_selesai
                        ??
                        0
                    )
                )
            );


        $totalSubbab =
            (int) (
                $kelas
                    ->pivot
                    ->total_subbab
                ??
                6
            );


        if (
            $totalSubbab
            <=
            0
        ) {

            $totalSubbab = 6;

        }


        /*
        |--------------------------------------------------------------------------
        | MATERI
        |--------------------------------------------------------------------------
        */

        $materi = [

            1 =>
                'Pengertian dan Notasi Himpunan',

            2 =>
                'Jenis-Jenis Himpunan',

            3 =>
                'Himpunan Bagian',

            4 =>
                'Operasi Himpunan',

            5 =>
                'Diagram Venn',

            6 =>
                'Penerapan Himpunan dalam Masalah',

        ];


        if (
            $subbabSelesai
            >=
            $totalSubbab
        ) {

            $sedangDipelajari =
                'Semua materi telah selesai';

        } else {

            $sedangDipelajari =
                $materi[
                    $subbabSelesai
                    +
                    1
                ]
                ??
                'Materi Himpunan';

        }


        /*
        |--------------------------------------------------------------------------
        | BADGE
        |--------------------------------------------------------------------------
        */

        $achievement =
            $user
                ->himdasBadgeData(
                    (int)
                    $kelas->id
                );


        $badges =
            collect(
                $achievement[
                    'earned_badges'
                ]
            );


        $latestBadge =
            $achievement[
                'latest_badge'
            ];


        if (
            $latestBadge
        ) {

            $badgeTerbaru =
                (object) [

                    'name' =>
                        $latestBadge[
                            'title'
                        ],

                    'description' =>
                        $latestBadge[
                            'description'
                        ],

                    'icon' =>
                        $latestBadge[
                            'icon'
                        ],

                ];

        } else {

            $badgeTerbaru =
                null;

        }


        /*
        |--------------------------------------------------------------------------
        | LEADERBOARD
        |--------------------------------------------------------------------------
        */

        $leaderboard =
            $kelas
                ->mahasiswa()
                ->get()
                ->sort(
                    function (
                        $a,
                        $b
                    ) {

                        $xpCompare =
                            (int) (
                                $b
                                    ->pivot
                                    ->xp
                                ??
                                0
                            )
                            <=>
                            (int) (
                                $a
                                    ->pivot
                                    ->xp
                                ??
                                0
                            );


                        if (
                            $xpCompare
                            !==
                            0
                        ) {

                            return
                                $xpCompare;

                        }


                        $subbabCompare =
                            (int) (
                                $b
                                    ->pivot
                                    ->subbab_selesai
                                ??
                                0
                            )
                            <=>
                            (int) (
                                $a
                                    ->pivot
                                    ->subbab_selesai
                                ??
                                0
                            );


                        if (
                            $subbabCompare
                            !==
                            0
                        ) {

                            return
                                $subbabCompare;

                        }


                        return
                            strcasecmp(
                                $a->name,
                                $b->name
                            );

                    }
                )
                ->values();


        $peringkat =
            null;


        foreach (
            $leaderboard
            as $index => $student
        ) {

            $rank =
                $index + 1;


            $student
                ->setAttribute(
                    'rank',
                    $rank
                );


            $student
                ->setAttribute(
                    'xp',
                    (int) (
                        $student
                            ->pivot
                            ->xp
                        ??
                        0
                    )
                );


            $student
                ->setAttribute(
                    'progress_percent',
                    (int) round(
                        $this
                            ->normalizedProgress(
                                $student
                            )
                    )
                );


            $student
                ->setAttribute(
                    'is_current_user',
                    (int)
                    $student->id
                    ===
                    (int)
                    $user->id
                );


            if (
                (int)
                $student->id

                ===

                (int)
                $user->id
            ) {

                $peringkat =
                    $rank;

            }

        }


        /*
        |--------------------------------------------------------------------------
        | AKTIVITAS TERAKHIR
        |--------------------------------------------------------------------------
        */

        $aktivitasTerakhir =
            $kelas
                ->pivot
                ->last_activity_at
            ??
            null;


        /*
        |--------------------------------------------------------------------------
        | CHALLENGE HARI INI
        |--------------------------------------------------------------------------
        */

        $challengeCompletedToday =
            DB::table(
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
                now()
                    ->toDateString()
            )
            ->where(
                'challenge_key',
                '!=',
                self::BONUS_KEY
            )
            ->count();


        /*
        |--------------------------------------------------------------------------
        | XP CHALLENGE HARI INI
        |--------------------------------------------------------------------------
        */

        $challengeXpToday =
            (int)
            DB::table(
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
                now()
                    ->toDateString()
            )
            ->sum(
                'xp_earned'
            );


        return view(
            'mahasiswa.dashboard',
            compact(
                'kelas',
                'progress',
                'xp',
                'subbabSelesai',
                'totalSubbab',
                'sedangDipelajari',
                'badges',
                'badgeTerbaru',
                'leaderboard',
                'peringkat',
                'tanggalHariIni',
                'semester',
                'aktivitasTerakhir',
                'challengeCompletedToday',
                'challengeDailyTotal',
                'challengeXpToday'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | NORMALISASI PROGRESS
    |--------------------------------------------------------------------------
    */

    private function normalizedProgress(
        User $student
    ): float {

        return max(
            0,
            min(
                100,
                (float) (
                    $student
                        ->pivot
                        ->progress_percent
                    ??
                    0
                )
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | STATUS MONITORING
    |--------------------------------------------------------------------------
    */

    private function studentMonitoringStatus(
        User $student
    ): string {

        $subbab =
            (int) (
                $student
                    ->pivot
                    ->subbab_selesai
                ??
                0
            );


        $progress =
            $this
                ->normalizedProgress(
                    $student
                );


        $lastActivity =
            $student
                ->pivot
                ->last_activity_at
            ??
            null;


        /*
        |--------------------------------------------------------------------------
        | SELESAI
        |--------------------------------------------------------------------------
        */

        if (
            $subbab >= 6

            ||

            $progress >= 100
        ) {

            return
                'completed';

        }


        /*
        |--------------------------------------------------------------------------
        | BARU
        |--------------------------------------------------------------------------
        */

        if (
            $progress <= 0

            &&

            !$lastActivity
        ) {

            return
                'new';

        }


        /*
        |--------------------------------------------------------------------------
        | BELUM ADA AKTIVITAS
        |--------------------------------------------------------------------------
        */

        if (!$lastActivity) {

            return
                'attention';

        }


        /*
        |--------------------------------------------------------------------------
        | TIDAK AKTIF > 7 HARI
        |--------------------------------------------------------------------------
        */

        if (
            Carbon::parse(
                $lastActivity
            )
            ->lt(
                now()
                    ->subDays(
                        7
                    )
            )
        ) {

            return
                'attention';

        }


        return
            'active';
    }
}