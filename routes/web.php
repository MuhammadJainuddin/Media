<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MateriController;
use App\Http\Controllers\LatihanController;
use App\Http\Controllers\ChallengeController;
use App\Http\Controllers\BadgeController;
use App\Http\Controllers\LeaderboardController;
use App\Http\Controllers\ProfileController;


/*
|--------------------------------------------------------------------------
| PUBLIC PAGE
|--------------------------------------------------------------------------
|
| Halaman yang dapat dibuka tanpa login.
|
*/

Route::view(
    '/',
    'home'
)->name('home');


Route::view(
    '/tentang',
    'tentang'
)->name('tentang');


Route::view(
    '/petunjuk',
    'petunjuk'
)->name('petunjuk');


/*
|--------------------------------------------------------------------------
| GUEST / AUTHENTICATION
|--------------------------------------------------------------------------
|
| Hanya dapat diakses ketika pengguna belum login.
|
*/

Route::middleware('guest')
    ->group(function () {

        /*
        |--------------------------------------------------------------------------
        | LOGIN
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/login',
            [AuthController::class, 'showLogin']
        )->name('login');


        Route::post(
            '/login',
            [AuthController::class, 'login']
        )->name('login.process');


        /*
        |--------------------------------------------------------------------------
        | REGISTER MAHASISWA
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/register',
            [AuthController::class, 'showRegister']
        )->name('register');


        Route::post(
            '/register',
            [AuthController::class, 'register']
        )->name('register.process');

    });


/*
|--------------------------------------------------------------------------
| AUTHENTICATED USER
|--------------------------------------------------------------------------
|
| Semua route di bawah hanya dapat digunakan
| setelah pengguna berhasil login.
|
*/

Route::middleware('auth')
    ->group(function () {

        /*
        |--------------------------------------------------------------------------
        | LOGOUT
        |--------------------------------------------------------------------------
        */

        Route::post(
            '/logout',
            [AuthController::class, 'logout']
        )->name('logout');


        /*
        |--------------------------------------------------------------------------
        | DOSEN / ADMIN
        |--------------------------------------------------------------------------
        */


        /*
        |--------------------------------------------------------------------------
        | DASHBOARD DOSEN
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/dosen/dashboard',
            [DashboardController::class, 'dosen']
        )->name('dosen.dashboard');


        /*
        |--------------------------------------------------------------------------
        | DETAIL KELAS DOSEN
        |--------------------------------------------------------------------------
        |
        | Berisi:
        |
        | - Daftar mahasiswa
        | - Progress pembelajaran
        | - Subbab selesai
        | - XP
        | - Badge
        | - Leaderboard
        |
        */

        Route::get(
            '/dosen/kelas/{kelas}',
            [DashboardController::class, 'kelasDetail']
        )->name('dosen.kelas.show');


        /*
        |--------------------------------------------------------------------------
        | MEMBUAT KELAS
        |--------------------------------------------------------------------------
        */

        Route::post(
            '/kelas',
            [KelasController::class, 'store']
        )->name('kelas.store');


        /*
        |--------------------------------------------------------------------------
        | MAHASISWA
        |--------------------------------------------------------------------------
        */


        /*
        |--------------------------------------------------------------------------
        | DASHBOARD MAHASISWA
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/mahasiswa/dashboard',
            [DashboardController::class, 'mahasiswa']
        )->name('mahasiswa.dashboard');


        /*
        |--------------------------------------------------------------------------
        | BERGABUNG KE KELAS
        |--------------------------------------------------------------------------
        |
        | Mahasiswa bergabung menggunakan kode kelas.
        |
        */

        Route::post(
            '/kelas/join',
            [KelasController::class, 'join']
        )->name('kelas.join');


        /*
        |--------------------------------------------------------------------------
        | MATERI MAHASISWA
        |--------------------------------------------------------------------------
        */


        /*
        |--------------------------------------------------------------------------
        | 1. DAFTAR 6 SUBBAB
        |--------------------------------------------------------------------------
        |
        | URL:
        |
        | /mahasiswa/materi
        |
        | Menampilkan:
        |
        | Subbab 1 - Pengenal Himpunan
        | Subbab 2 - Pembentuk Himpunan
        | Subbab 3 - Venn Master
        | Subbab 4 - Subset Master
        | Subbab 5 - Operation Master
        | Subbab 6 - Himpunan Master
        |
        */

        Route::get(
            '/mahasiswa/materi',
            [MateriController::class, 'index']
        )->name('mahasiswa.materi.index');


        /*
        |--------------------------------------------------------------------------
        | 2. MULAI / DETAIL SUBBAB
        |--------------------------------------------------------------------------
        |
        | Contoh:
        |
        | /mahasiswa/materi/1
        | /mahasiswa/materi/2
        | /mahasiswa/materi/3
        | /mahasiswa/materi/4
        | /mahasiswa/materi/5
        | /mahasiswa/materi/6
        |
        */

        Route::get(
            '/mahasiswa/materi/{level}',
            [MateriController::class, 'show']
        )
        ->whereNumber('level')
        ->name('mahasiswa.materi.show');


        /*
        |--------------------------------------------------------------------------
        | 3. HALAMAN ISI MATERI
        |--------------------------------------------------------------------------
        |
        | Setiap subbab memiliki beberapa halaman materi.
        |
        */

        Route::get(
            '/mahasiswa/materi/{level}/halaman/{page}',
            [MateriController::class, 'page']
        )
        ->whereNumber('level')
        ->whereNumber('page')
        ->name('mahasiswa.materi.page');


        /*
        |--------------------------------------------------------------------------
        | 4. CHECKPOINT HALAMAN
        |--------------------------------------------------------------------------
        |
        | Mahasiswa harus menjawab checkpoint dengan benar
        | sebelum melanjutkan ke halaman berikutnya.
        |
        */

        Route::post(
            '/mahasiswa/materi/{level}/halaman/{page}/checkpoint',
            [MateriController::class, 'checkpoint']
        )
        ->whereNumber('level')
        ->whereNumber('page')
        ->name('mahasiswa.materi.checkpoint');


        /*
        |--------------------------------------------------------------------------
        | 5. EVALUASI AKHIR SUBBAB
        |--------------------------------------------------------------------------
        |
        | Ketuntasan minimal 80%.
        |
        | Jika mahasiswa berhasil:
        |
        | - Subbab dinyatakan selesai
        | - Progress diperbarui
        | - Mendapat XP
        | - Subbab berikutnya terbuka
        | - Badge subbab dapat diperoleh
        |
        */

        Route::post(
            '/mahasiswa/materi/{level}/evaluasi',
            [MateriController::class, 'evaluate']
        )
        ->whereNumber('level')
        ->name('mahasiswa.materi.evaluate');


        /*
        |--------------------------------------------------------------------------
        | LATIHAN AKHIR MAHASISWA
        |--------------------------------------------------------------------------
        |
        | Latihan akhir merupakan evaluasi keseluruhan
        | setelah mahasiswa menyelesaikan seluruh
        | Subbab 1 sampai Subbab 6.
        |
        */


        /*
        |--------------------------------------------------------------------------
        | 1. HALAMAN UTAMA LATIHAN
        |--------------------------------------------------------------------------
        |
        | URL:
        |
        | /mahasiswa/latihan
        |
        | Jika seluruh subbab belum selesai:
        | - Latihan terkunci
        |
        | Jika 6 subbab selesai:
        | - Tombol mulai latihan aktif
        |
        */

        Route::get(
            '/mahasiswa/latihan',
            [LatihanController::class, 'index']
        )->name('mahasiswa.latihan.index');


        /*
        |--------------------------------------------------------------------------
        | 2. HALAMAN SOAL LATIHAN
        |--------------------------------------------------------------------------
        |
        | Contoh:
        |
        | /mahasiswa/latihan/soal/1
        | /mahasiswa/latihan/soal/2
        | ...
        |
        */

        Route::get(
            '/mahasiswa/latihan/soal/{number}',
            [LatihanController::class, 'show']
        )
        ->whereNumber('number')
        ->name('mahasiswa.latihan.show');


        /*
        |--------------------------------------------------------------------------
        | 3. SIMPAN JAWABAN SOAL
        |--------------------------------------------------------------------------
        */

        Route::post(
            '/mahasiswa/latihan/soal/{number}',
            [LatihanController::class, 'storeAnswer']
        )
        ->whereNumber('number')
        ->name('mahasiswa.latihan.answer');


        /*
        |--------------------------------------------------------------------------
        | 4. HASIL LATIHAN AKHIR
        |--------------------------------------------------------------------------
        |
        | Menampilkan:
        |
        | - Nilai akhir
        | - Jumlah jawaban benar
        | - Jumlah soal
        | - Status lulus / belum lulus
        | - Ringkasan jawaban
        |
        | Nilai terbaik juga disimpan ke kelas_user
        | untuk kebutuhan Badge HIMDAS Champion.
        |
        */

        Route::get(
            '/mahasiswa/latihan/hasil',
            [LatihanController::class, 'result']
        )->name('mahasiswa.latihan.result');


        /*
        |--------------------------------------------------------------------------
        | 5. RESET / ULANGI LATIHAN
        |--------------------------------------------------------------------------
        |
        | Menghapus jawaban latihan dari session.
        | Nilai terbaik yang sudah tersimpan di database tidak dihapus.
        |
        */

        Route::post(
            '/mahasiswa/latihan/reset',
            [LatihanController::class, 'reset']
        )->name('mahasiswa.latihan.reset');


        /*
        |--------------------------------------------------------------------------
        | CHALLENGE HARIAN MAHASISWA
        |--------------------------------------------------------------------------
        |
        | Challenge:
        |
        | - Langsung terbuka sejak mahasiswa masuk kelas
        | - Tidak membutuhkan 6 subbab selesai
        | - Mengambil soal dari bank Challenge HIMDAS
        | - 6 Challenge dipilih setiap hari
        | - Satu Challenge dari setiap Subbab 1 - 6
        | - Soal berubah setiap hari
        | - Memiliki XP berdasarkan tingkat kesulitan
        | - Memiliki bonus harian
        | - Digunakan untuk membangun streak
        |
        */


        /*
        |--------------------------------------------------------------------------
        | 1. HALAMAN UTAMA CHALLENGE
        |--------------------------------------------------------------------------
        |
        | URL:
        |
        | /mahasiswa/challenge
        |
        | Menampilkan:
        |
        | - 6 Challenge hari ini
        | - Progress Challenge
        | - XP hari ini
        | - Streak
        | - Bonus harian
        |
        */

        Route::get(
            '/mahasiswa/challenge',
            [ChallengeController::class, 'index']
        )->name('mahasiswa.challenge.index');


        /*
        |--------------------------------------------------------------------------
        | 2. HALAMAN MENGERJAKAN CHALLENGE
        |--------------------------------------------------------------------------
        |
        | Contoh:
        |
        | /mahasiswa/challenge/s1-detektif-01
        | /mahasiswa/challenge/s4-power-05
        | /mahasiswa/challenge/s6-function-07
        |
        */

        Route::get(
            '/mahasiswa/challenge/{key}',
            [ChallengeController::class, 'show']
        )
        ->where(
            'key',
            '[A-Za-z0-9\-]+'
        )
        ->name('mahasiswa.challenge.show');


        /*
        |--------------------------------------------------------------------------
        | 3. SIMPAN JAWABAN CHALLENGE
        |--------------------------------------------------------------------------
        |
        | Setelah mahasiswa menjawab:
        |
        | - Jawaban diperiksa
        | - Hasil disimpan
        | - XP diberikan jika benar
        | - Challenge ditandai selesai
        | - Tidak dapat dijawab ulang pada hari yang sama
        |
        */

        Route::post(
            '/mahasiswa/challenge/{key}',
            [ChallengeController::class, 'answer']
        )
        ->where(
            'key',
            '[A-Za-z0-9\-]+'
        )
        ->name('mahasiswa.challenge.answer');


        /*
        |--------------------------------------------------------------------------
        | BADGE MAHASISWA
        |--------------------------------------------------------------------------
        |
        | Badge merupakan penghargaan pencapaian mahasiswa
        | berdasarkan aktivitas pembelajaran di HIMDAS.
        |
        | Total Badge:
        |
        | 1. Pengenal Himpunan
        | 2. Pembentuk Himpunan
        | 3. Venn Master
        | 4. Subset Master
        | 5. Operation Master
        | 6. Himpunan Master
        | 7. Challenge Hunter
        | 8. Challenge Streak
        | 9. HIMDAS Champion
        |
        */


        /*
        |--------------------------------------------------------------------------
        | HALAMAN BADGE
        |--------------------------------------------------------------------------
        |
        | URL:
        |
        | /mahasiswa/badge
        |
        | Badge dihitung otomatis berdasarkan:
        |
        | - Subbab yang sudah diselesaikan
        | - Challenge Harian
        | - Streak Challenge
        | - Kelulusan Latihan Akhir
        |
        */

        Route::get(
            '/mahasiswa/badge',
            [BadgeController::class, 'index']
        )->name('mahasiswa.badge.index');


        /*
        |--------------------------------------------------------------------------
        | LEADERBOARD MAHASISWA
        |--------------------------------------------------------------------------
        |
        | Leaderboard menampilkan peringkat mahasiswa
        | dalam kelas aktif yang sama.
        |
        | Ranking utama berdasarkan:
        |
        | 1. Total XP tertinggi
        | 2. Jumlah subbab selesai
        | 3. Nama mahasiswa
        |
        | XP dapat diperoleh dari aktivitas pembelajaran
        | seperti penyelesaian materi dan Challenge.
        |
        */


        /*
        |--------------------------------------------------------------------------
        | HALAMAN LEADERBOARD
        |--------------------------------------------------------------------------
        |
        | URL:
        |
        | /mahasiswa/leaderboard
        |
        | Menampilkan:
        |
        | - Podium 3 mahasiswa terbaik
        | - Ranking kelas
        | - Total XP
        | - Progress materi
        | - Posisi mahasiswa yang sedang login
        | - Jumlah mahasiswa
        | - XP tertinggi
        | - Rata-rata XP kelas
        |
        */

        Route::get(
            '/mahasiswa/leaderboard',
            [LeaderboardController::class, 'index']
        )->name('mahasiswa.leaderboard.index');


        /*
        |--------------------------------------------------------------------------
        | PROFIL MAHASISWA
        |--------------------------------------------------------------------------
        |
        | Halaman Profil digunakan untuk menampilkan
        | informasi akun mahasiswa yang sedang login.
        |
        | Informasi yang ditampilkan:
        |
        | - Nama
        | - Email
        | - Akses / Role
        | - Kelas Aktif
        | - Kode Kelas
        |
        | Profil tidak menampilkan ulang progress pembelajaran
        | karena informasi tersebut sudah tersedia di Dashboard.
        |
        */


        /*
        |--------------------------------------------------------------------------
        | 1. HALAMAN PROFIL
        |--------------------------------------------------------------------------
        |
        | URL:
        |
        | /mahasiswa/profile
        |
        */

        Route::get(
            '/mahasiswa/profile',
            [ProfileController::class, 'index']
        )->name('mahasiswa.profile.index');


        /*
        |--------------------------------------------------------------------------
        | 2. HALAMAN EDIT PROFIL
        |--------------------------------------------------------------------------
        |
        | URL:
        |
        | /mahasiswa/profile/edit
        |
        | Mahasiswa dapat mengubah:
        |
        | - Nama
        | - Email
        | - Password secara opsional
        |
        */

        Route::get(
            '/mahasiswa/profile/edit',
            [ProfileController::class, 'edit']
        )->name('mahasiswa.profile.edit');


        /*
        |--------------------------------------------------------------------------
        | 3. UPDATE PROFIL
        |--------------------------------------------------------------------------
        |
        | Digunakan untuk menyimpan perubahan data akun.
        |
        | Jika password baru tidak diisi,
        | password lama tetap digunakan.
        |
        */

        Route::patch(
            '/mahasiswa/profile',
            [ProfileController::class, 'update']
        )->name('mahasiswa.profile.update');

    });
    