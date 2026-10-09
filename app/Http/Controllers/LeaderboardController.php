<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LeaderboardController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | KONFIGURASI
    |--------------------------------------------------------------------------
    */

    private const TOTAL_SUBBAB = 6;

    private const MAX_LEADERBOARD = 10;


    /*
    |--------------------------------------------------------------------------
    | HALAMAN LEADERBOARD
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
        | AMBIL SELURUH MAHASISWA DALAM KELAS
        |--------------------------------------------------------------------------
        |
        | Ranking utama berdasarkan XP.
        |
        | Jika XP sama:
        |
        | 1. Mahasiswa dengan subbab selesai lebih banyak berada di atas.
        | 2. Jika masih sama, nama digunakan agar urutan stabil.
        |
        */

        $students = DB::table('kelas_user')
            ->join(
                'users',
                'users.id',
                '=',
                'kelas_user.user_id'
            )
            ->where(
                'kelas_user.kelas_id',
                $kelas->id
            )
            ->where(
                'users.role',
                'mahasiswa'
            )
            ->select(
                'users.id',
                'users.name',
                'kelas_user.xp',
                'kelas_user.subbab_selesai',
                'kelas_user.last_activity_at'
            )
            ->orderByDesc(
                'kelas_user.xp'
            )
            ->orderByDesc(
                'kelas_user.subbab_selesai'
            )
            ->orderBy(
                'users.name'
            )
            ->get();


        /*
        |--------------------------------------------------------------------------
        | BERIKAN NOMOR RANKING
        |--------------------------------------------------------------------------
        */

        $rankings = $students
            ->values()
            ->map(
                function (
                    $student,
                    int $index
                ) use (
                    $user
                ) {
                    /*
                    |--------------------------------------------------------------------------
                    | RANK
                    |--------------------------------------------------------------------------
                    */

                    $student->rank =
                        $index + 1;


                    /*
                    |--------------------------------------------------------------------------
                    | XP
                    |--------------------------------------------------------------------------
                    */

                    $student->xp =
                        (int) (
                            $student->xp
                            ??
                            0
                        );


                    /*
                    |--------------------------------------------------------------------------
                    | SUBBAB
                    |--------------------------------------------------------------------------
                    */

                    $student->subbab_selesai =
                        max(
                            0,
                            min(
                                self::TOTAL_SUBBAB,
                                (int) (
                                    $student->subbab_selesai
                                    ??
                                    0
                                )
                            )
                        );


                    /*
                    |--------------------------------------------------------------------------
                    | PROGRESS MATERI
                    |--------------------------------------------------------------------------
                    */

                    $student->progress_percent =
                        (int) round(
                            (
                                $student->subbab_selesai
                                /
                                self::TOTAL_SUBBAB
                            )
                            *
                            100
                        );


                    /*
                    |--------------------------------------------------------------------------
                    | MAHASISWA YANG SEDANG LOGIN
                    |--------------------------------------------------------------------------
                    */

                    $student->is_current_user =
                        (int) $student->id
                        ===
                        (int) $user->id;


                    /*
                    |--------------------------------------------------------------------------
                    | INISIAL
                    |--------------------------------------------------------------------------
                    */

                    $student->initial =
                        $this->initial(
                            $student->name
                        );


                    return $student;
                }
            );


        /*
        |--------------------------------------------------------------------------
        | TOP 3
        |--------------------------------------------------------------------------
        |
        | Digunakan untuk podium.
        |
        */

        $topThree =
            $rankings
                ->take(3)
                ->values();


        /*
        |--------------------------------------------------------------------------
        | TOP 10
        |--------------------------------------------------------------------------
        |
        | Digunakan untuk daftar ranking utama.
        |
        */

        $leaderboard =
            $rankings
                ->take(
                    self::MAX_LEADERBOARD
                )
                ->values();


        /*
        |--------------------------------------------------------------------------
        | POSISI MAHASISWA LOGIN
        |--------------------------------------------------------------------------
        */

        $myRanking =
            $rankings
                ->firstWhere(
                    'is_current_user',
                    true
                );


        /*
        |--------------------------------------------------------------------------
        | JUMLAH MAHASISWA
        |--------------------------------------------------------------------------
        */

        $totalStudents =
            $rankings->count();


        /*
        |--------------------------------------------------------------------------
        | XP TERTINGGI
        |--------------------------------------------------------------------------
        */

        $highestXp =
            $rankings->isNotEmpty()
                ? (int) $rankings
                    ->first()
                    ->xp
                : 0;


        /*
        |--------------------------------------------------------------------------
        | RATA-RATA XP
        |--------------------------------------------------------------------------
        */

        $averageXp =
            $rankings->isNotEmpty()
                ? (int) round(
                    $rankings
                        ->avg(
                            'xp'
                        )
                )
                : 0;


        /*
        |--------------------------------------------------------------------------
        | SUBBAB UNTUK SIDEBAR
        |--------------------------------------------------------------------------
        |
        | Layout mahasiswa menggunakan variabel ini untuk menentukan
        | progress subbab pada menu Materi.
        |
        */

        $subbabSelesai =
            $myRanking
                ? (int)
                    $myRanking
                        ->subbab_selesai
                : 0;


        /*
        |--------------------------------------------------------------------------
        | KIRIM KE VIEW
        |--------------------------------------------------------------------------
        */

        return view(
            'mahasiswa.leaderboard.index',
            compact(
                'kelas',
                'topThree',
                'leaderboard',
                'myRanking',
                'totalStudents',
                'highestXp',
                'averageXp',
                'subbabSelesai'
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


        /*
        |--------------------------------------------------------------------------
        | VALIDASI USER
        |--------------------------------------------------------------------------
        */

        if (!$user instanceof User) {
            abort(401);
        }


        /*
        |--------------------------------------------------------------------------
        | HANYA MAHASISWA
        |--------------------------------------------------------------------------
        */

        if (
            $user->role !==
            'mahasiswa'
        ) {
            abort(
                403,
                'Leaderboard hanya dapat diakses mahasiswa.'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | KELAS AKTIF
        |--------------------------------------------------------------------------
        */

        $kelas = $user
            ->kelasDiikuti()
            ->with(
                'pembuat'
            )
            ->first();


        if (!$kelas) {
            abort(
                403,
                'Bergabunglah ke kelas terlebih dahulu untuk melihat Leaderboard.'
            );
        }


        return [
            $user,
            $kelas,
        ];
    }


    /*
    |--------------------------------------------------------------------------
    | INISIAL NAMA
    |--------------------------------------------------------------------------
    |
    | Contoh:
    |
    | Muhammad Jainuddin = MJ
    | Andi               = A
    |
    */

    private function initial(
        string $name
    ): string {
        $words = preg_split(
            '/\s+/u',
            trim($name)
        );


        if (
            !$words
            ||
            count($words) === 0
        ) {
            return '?';
        }


        /*
        |--------------------------------------------------------------------------
        | SATU KATA
        |--------------------------------------------------------------------------
        */

        if (
            count($words) === 1
        ) {
            return mb_strtoupper(
                mb_substr(
                    $words[0],
                    0,
                    1
                )
            );
        }


        /*
        |--------------------------------------------------------------------------
        | DUA ATAU LEBIH KATA
        |--------------------------------------------------------------------------
        */

        $first =
            mb_substr(
                $words[0],
                0,
                1
            );


        $last =
            mb_substr(
                $words[
                    count($words) - 1
                ],
                0,
                1
            );


        return mb_strtoupper(
            $first
            .
            $last
        );
    }
}