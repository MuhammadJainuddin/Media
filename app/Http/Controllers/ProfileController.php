<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | HALAMAN PROFIL
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        [
            $user,
            $kelas,
            $subbabSelesai
        ] = $this->studentContext();


        /*
        |--------------------------------------------------------------------------
        | INISIAL NAMA
        |--------------------------------------------------------------------------
        |
        | Muhammad Jainuddin = MJ
        | Andi               = A
        |
        */

        $initial =
            $this->initial(
                $user->name
            );


        /*
        |--------------------------------------------------------------------------
        | LABEL AKSES
        |--------------------------------------------------------------------------
        */

        $accessLabel =
            'Mahasiswa';


        return view(
            'mahasiswa.profile.index',
            compact(
                'user',
                'kelas',
                'subbabSelesai',
                'initial',
                'accessLabel'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | HALAMAN EDIT PROFIL
    |--------------------------------------------------------------------------
    */

    public function edit()
    {
        [
            $user,
            $kelas,
            $subbabSelesai
        ] = $this->studentContext();


        $initial =
            $this->initial(
                $user->name
            );


        return view(
            'mahasiswa.profile.edit',
            compact(
                'user',
                'kelas',
                'subbabSelesai',
                'initial'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | UPDATE PROFIL
    |--------------------------------------------------------------------------
    */

    public function update(
        Request $request
    ) {
        [
            $user,
            $kelas,
            $subbabSelesai
        ] = $this->studentContext();


        /*
        |--------------------------------------------------------------------------
        | VALIDASI DATA
        |--------------------------------------------------------------------------
        */

        $validated =
            $request->validate(
                [
                    'name' => [
                        'required',
                        'string',
                        'max:100',
                    ],

                    'email' => [
                        'required',
                        'email',
                        'max:255',

                        Rule::unique(
                            'users',
                            'email'
                        )
                        ->ignore(
                            $user->id
                        ),
                    ],

                    /*
                    |--------------------------------------------------------------------------
                    | PASSWORD LAMA
                    |--------------------------------------------------------------------------
                    |
                    | Hanya wajib jika mahasiswa ingin mengganti password.
                    |
                    */

                    'current_password' => [
                        'nullable',
                        'required_with:password',
                        'string',
                    ],

                    /*
                    |--------------------------------------------------------------------------
                    | PASSWORD BARU
                    |--------------------------------------------------------------------------
                    |
                    | Kosongkan jika tidak ingin mengganti password.
                    |
                    */

                    'password' => [
                        'nullable',
                        'string',
                        'min:8',
                        'confirmed',
                    ],
                ],
                [
                    'name.required' =>
                        'Nama wajib diisi.',

                    'name.max' =>
                        'Nama maksimal 100 karakter.',

                    'email.required' =>
                        'Email wajib diisi.',

                    'email.email' =>
                        'Format email tidak valid.',

                    'email.unique' =>
                        'Email tersebut sudah digunakan oleh akun lain.',

                    'current_password.required_with' =>
                        'Masukkan password saat ini untuk mengganti password.',

                    'password.min' =>
                        'Password baru minimal 8 karakter.',

                    'password.confirmed' =>
                        'Konfirmasi password baru tidak sama.',
                ]
            );


        /*
        |--------------------------------------------------------------------------
        | CEK PASSWORD LAMA
        |--------------------------------------------------------------------------
        */

        if (
            !empty(
                $validated['password']
            )
        ) {
            if (
                !Hash::check(
                    $validated[
                        'current_password'
                    ],
                    $user->password
                )
            ) {
                return back()
                    ->withErrors(
                        [
                            'current_password' =>
                                'Password saat ini tidak benar.',
                        ]
                    )
                    ->withInput();
            }
        }


        /*
        |--------------------------------------------------------------------------
        | UPDATE NAMA
        |--------------------------------------------------------------------------
        */

        $user->name =
            trim(
                $validated['name']
            );


        /*
        |--------------------------------------------------------------------------
        | UPDATE EMAIL
        |--------------------------------------------------------------------------
        */

        $user->email =
            strtolower(
                trim(
                    $validated['email']
                )
            );


        /*
        |--------------------------------------------------------------------------
        | UPDATE PASSWORD JIKA DIISI
        |--------------------------------------------------------------------------
        */

        if (
            !empty(
                $validated['password']
            )
        ) {
            $user->password =
                Hash::make(
                    $validated[
                        'password'
                    ]
                );
        }


        /*
        |--------------------------------------------------------------------------
        | SIMPAN
        |--------------------------------------------------------------------------
        */

        $user->save();


        /*
        |--------------------------------------------------------------------------
        | KEMBALI KE PROFIL
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route(
                'mahasiswa.profile.index'
            )
            ->with(
                'success',
                'Profil berhasil diperbarui.'
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
        | CEK LOGIN
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
                'Halaman Profil hanya dapat diakses mahasiswa.'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | KELAS AKTIF
        |--------------------------------------------------------------------------
        |
        | Untuk saat ini profil mengikuti kelas mahasiswa yang aktif
        | seperti fitur HIMDAS lainnya.
        |
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
        | KEAMANAN SEMENTARA
        |--------------------------------------------------------------------------
        |
        | Nanti alur login + kode kelas akan kita rapikan sendiri.
        |
        */

if (!$kelas) {
    abort(
        403,
        'Data kelas mahasiswa tidak ditemukan.'
    );
}


        /*
        |--------------------------------------------------------------------------
        | PROGRESS UNTUK SIDEBAR
        |--------------------------------------------------------------------------
        |
        | Bukan ditampilkan di halaman Profil.
        | Hanya diperlukan layout mahasiswa.
        |
        */

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
                    6,
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
    | INISIAL NAMA
    |--------------------------------------------------------------------------
    */

    private function initial(
        string $name
    ): string {
        $words =
            preg_split(
                '/\s+/u',
                trim(
                    $name
                )
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
        | DUA KATA ATAU LEBIH
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