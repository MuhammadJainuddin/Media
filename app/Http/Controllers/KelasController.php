<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class KelasController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | BUAT KELAS
    |--------------------------------------------------------------------------
    */
    public function store(Request $request)
    {
        /** @var User|null $user */
        $user = Auth::user();


        /*
        |--------------------------------------------------------------------------
        | PASTIKAN SUDAH LOGIN
        |--------------------------------------------------------------------------
        */

        if (!$user) {
            return redirect()
                ->route('login')
                ->withErrors([
                    'login' => 'Silakan login terlebih dahulu.'
                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | CEK ROLE DOSEN / ADMIN
        |--------------------------------------------------------------------------
        */

        if (
            $user->role !== 'dosen' &&
            $user->role !== 'admin'
        ) {
            abort(403, 'Akun tidak memiliki akses untuk membuat kelas.');
        }


        /*
        |--------------------------------------------------------------------------
        | VALIDASI FORM
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate([
            'nama_kelas' => [
                'required',
                'string',
                'max:255',
            ],

            'deskripsi' => [
                'nullable',
                'string',
                'max:1000',
            ],
        ]);


        /*
        |--------------------------------------------------------------------------
        | GENERATE KODE KELAS
        |--------------------------------------------------------------------------
        */

        do {

            $kode =
                'HIM-' .
                strtoupper(
                    Str::random(6)
                );

        } while (
            Kelas::where(
                'kode_kelas',
                $kode
            )->exists()
        );


        /*
        |--------------------------------------------------------------------------
        | SIMPAN KELAS
        |--------------------------------------------------------------------------
        */

        Kelas::create([
            'created_by' => $user->id,

            'nama_kelas' =>
                $validated['nama_kelas'],

            'kode_kelas' =>
                $kode,

            'deskripsi' =>
                $validated['deskripsi'] ?? null,
        ]);


        /*
        |--------------------------------------------------------------------------
        | KEMBALI KE DASHBOARD
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('dosen.dashboard')
            ->with(
                'success',
                'Kelas berhasil dibuat dengan kode ' . $kode
            );
    }


    /*
    |--------------------------------------------------------------------------
    | MAHASISWA GABUNG KELAS
    |--------------------------------------------------------------------------
    */
    public function join(Request $request)
    {
        /** @var User|null $user */
        $user = Auth::user();


        if (!$user) {
            return redirect()
                ->route('login');
        }


        if ($user->role !== 'mahasiswa') {
            abort(
                403,
                'Hanya mahasiswa yang dapat bergabung ke kelas.'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | NORMALISASI KODE
        |--------------------------------------------------------------------------
        */

        $request->merge([
            'kode_kelas' =>
                strtoupper(
                    trim(
                        $request->input(
                            'kode_kelas',
                            ''
                        )
                    )
                ),
        ]);


        /*
        |--------------------------------------------------------------------------
        | VALIDASI
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate([
            'kode_kelas' => [
                'required',
                'string',
                'max:50',
            ],
        ]);


        /*
        |--------------------------------------------------------------------------
        | CARI KELAS
        |--------------------------------------------------------------------------
        */

        $kelas = Kelas::where(
            'kode_kelas',
            $validated['kode_kelas']
        )->first();


        if (!$kelas) {
            return back()
                ->withErrors([
                    'kode_kelas' =>
                        'Kode kelas tidak ditemukan.'
                ])
                ->withInput();
        }


        /*
        |--------------------------------------------------------------------------
        | CEK APAKAH SUDAH BERGABUNG
        |--------------------------------------------------------------------------
        */

        $sudahGabung = $user
            ->kelasDiikuti()
            ->where(
                'kelas.id',
                $kelas->id
            )
            ->exists();


        if ($sudahGabung) {
            return back()->with(
                'success',
                'Kamu sudah tergabung di kelas tersebut.'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | GABUNG KELAS
        |--------------------------------------------------------------------------
        */

        $user
            ->kelasDiikuti()
            ->attach($kelas->id);


        return back()->with(
            'success',
            'Berhasil bergabung ke kelas ' .
            $kelas->nama_kelas .
            '.'
        );
    }
}