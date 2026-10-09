<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | LOGIN PAGE
    |--------------------------------------------------------------------------
    */

    public function showLogin()
    {
        if (Auth::check()) {

            return $this->redirectAuthenticatedUser(
                Auth::user()
            );

        }

        return view('auth.login');
    }


    /*
    |--------------------------------------------------------------------------
    | LOGIN PROCESS
    |--------------------------------------------------------------------------
    */

    public function login(Request $request)
    {
        $request->validate([
            'login_as' => [
                'required',
                'in:mahasiswa,staff',
            ],

            'email' => [
                'required',
                'email',
            ],

            'password' => [
                'required',
                'string',
            ],
        ]);


        if (
            !Auth::attempt(
                [
                    'email' => $request->email,
                    'password' => $request->password,
                ],
                $request->boolean('remember')
            )
        ) {

            throw ValidationException::withMessages([
                'email' =>
                    'Email atau password tidak sesuai.',
            ]);

        }


        $request
            ->session()
            ->regenerate();


        /** @var User $user */
        $user = Auth::user();


        /*
        |--------------------------------------------------------------------------
        | CEK PILIHAN JENIS LOGIN
        |--------------------------------------------------------------------------
        */

        if (
            $request->login_as === 'mahasiswa'
            &&
            $user->role !== 'mahasiswa'
        ) {

            Auth::logout();


            $request
                ->session()
                ->invalidate();


            $request
                ->session()
                ->regenerateToken();


            throw ValidationException::withMessages([
                'email' =>
                    'Akun ini bukan akun mahasiswa.',
            ]);

        }


        if (
            $request->login_as === 'staff'
            &&
            !in_array(
                $user->role,
                [
                    'dosen',
                    'admin',
                ],
                true
            )
        ) {

            Auth::logout();


            $request
                ->session()
                ->invalidate();


            $request
                ->session()
                ->regenerateToken();


            throw ValidationException::withMessages([
                'email' =>
                    'Akun ini bukan akun dosen atau admin.',
            ]);

        }


        return $this->redirectAuthenticatedUser(
            $user
        );
    }


    /*
    |--------------------------------------------------------------------------
    | REGISTER PAGE
    |--------------------------------------------------------------------------
    */

    public function showRegister()
    {
        if (Auth::check()) {

            return $this->redirectAuthenticatedUser(
                Auth::user()
            );

        }


        return view('auth.register');
    }


    /*
    |--------------------------------------------------------------------------
    | REGISTER PROCESS
    |--------------------------------------------------------------------------
    */

    public function register(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | NORMALISASI ROLE
        |--------------------------------------------------------------------------
        */

        $role =
            strtolower(
                trim(
                    (string) $request->input(
                        'role',
                        'mahasiswa'
                    )
                )
            );


        /*
        |--------------------------------------------------------------------------
        | NORMALISASI WHATSAPP
        |--------------------------------------------------------------------------
        */

        $whatsapp = null;


        if ($role === 'mahasiswa') {

            $whatsapp =
                $this->normalizeWhatsapp(
                    $request->input('whatsapp')
                );

        }


        /*
        |--------------------------------------------------------------------------
        | NORMALISASI KODE KELAS
        |--------------------------------------------------------------------------
        */

        $kodeKelas = null;


        if ($role === 'mahasiswa') {

            $kodeKelas =
                strtoupper(
                    trim(
                        (string) $request->input(
                            'kode_kelas'
                        )
                    )
                );

        }


        $request->merge([
            'role' =>
                $role,

            'whatsapp' =>
                $whatsapp,

            'kode_kelas' =>
                $kodeKelas,
        ]);


        /*
        |--------------------------------------------------------------------------
        | VALIDASI
        |--------------------------------------------------------------------------
        */

        $request->validate([
            'role' => [
                'required',
                Rule::in([
                    'mahasiswa',
                    'dosen',
                ]),
            ],


            'name' => [
                'required',
                'string',
                'max:255',
            ],


            'email' => [
                'required',
                'email',
                'max:255',
                'unique:users,email',
            ],


            'password' => [
                'required',
                'string',
                'confirmed',
                'min:8',
            ],


            'whatsapp' => [
                Rule::requiredIf(
                    fn () =>
                        $role === 'mahasiswa'
                ),

                'nullable',
                'string',

                'regex:/^628[0-9]{7,12}$/',

                Rule::unique(
                    'users',
                    'whatsapp'
                ),
            ],


            'kode_kelas' => [
                Rule::requiredIf(
                    fn () =>
                        $role === 'mahasiswa'
                ),

                'nullable',
                'string',
                'max:50',
            ],
        ], [
            'role.required' =>
                'Silakan pilih jenis akun.',

            'role.in' =>
                'Jenis akun tidak valid.',

            'name.required' =>
                'Nama lengkap wajib diisi.',

            'email.required' =>
                'Email wajib diisi.',

            'email.email' =>
                'Format email tidak valid.',

            'email.unique' =>
                'Email tersebut sudah digunakan.',

            'password.required' =>
                'Password wajib diisi.',

            'password.confirmed' =>
                'Konfirmasi password tidak sama.',

            'password.min' =>
                'Password minimal 8 karakter.',

            'whatsapp.required' =>
                'Nomor WhatsApp wajib diisi untuk mahasiswa.',

            'whatsapp.regex' =>
                'Nomor WhatsApp tidak valid. Gunakan nomor Indonesia, misalnya 081234567890.',

            'whatsapp.unique' =>
                'Nomor WhatsApp tersebut sudah digunakan.',

            'kode_kelas.required' =>
                'Kode kelas wajib diisi untuk mahasiswa.',
        ]);


        /*
        |--------------------------------------------------------------------------
        | CEK KELAS MAHASISWA
        |--------------------------------------------------------------------------
        */

        $kelas = null;


        if ($role === 'mahasiswa') {

            $kelas =
                Kelas::where(
                    'kode_kelas',
                    $kodeKelas
                )
                ->first();


            if (!$kelas) {

                throw ValidationException::withMessages([
                    'kode_kelas' =>
                        'Kode kelas tidak ditemukan.',
                ]);

            }

        }


        /*
        |--------------------------------------------------------------------------
        | BUAT USER
        |--------------------------------------------------------------------------
        */

        $user =
            DB::transaction(
                function () use (
                    $request,
                    $role,
                    $whatsapp,
                    $kelas
                ) {

                    $user =
                        User::create([
                            'name' =>
                                $request->name,

                            'email' =>
                                $request->email,

                            'whatsapp' =>
                                $role === 'mahasiswa'
                                    ? $whatsapp
                                    : null,

                            'password' =>
                                $request->password,

                            'role' =>
                                $role,
                        ]);


                    /*
                    |--------------------------------------------------------------------------
                    | MAHASISWA LANGSUNG GABUNG KELAS
                    |--------------------------------------------------------------------------
                    */

                    if (
                        $role === 'mahasiswa'
                        &&
                        $kelas
                    ) {

                        $kelas
                            ->mahasiswa()
                            ->attach(
                                $user->id
                            );

                    }


                    return $user;

                }
            );


        /*
        |--------------------------------------------------------------------------
        | LOGIN OTOMATIS
        |--------------------------------------------------------------------------
        */

        Auth::login(
            $user
        );


        $request
            ->session()
            ->regenerate();


        /*
        |--------------------------------------------------------------------------
        | REDIRECT BERDASARKAN ROLE
        |--------------------------------------------------------------------------
        */

        return $this->redirectAuthenticatedUser(
            $user
        );
    }


    /*
    |--------------------------------------------------------------------------
    | LOGOUT
    |--------------------------------------------------------------------------
    */

    public function logout(Request $request)
    {
        Auth::logout();


        $request
            ->session()
            ->invalidate();


        $request
            ->session()
            ->regenerateToken();


        return redirect()
            ->route('home');
    }


    /*
    |--------------------------------------------------------------------------
    | REDIRECT USER
    |--------------------------------------------------------------------------
    */

    private function redirectAuthenticatedUser(
        User $user
    ) {
        if ($user->role === 'mahasiswa') {

            return redirect()
                ->route(
                    'mahasiswa.dashboard'
                );

        }


        /*
        |--------------------------------------------------------------------------
        | DOSEN & ADMIN
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route(
                'dosen.dashboard'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | NORMALISASI NOMOR WHATSAPP
    |--------------------------------------------------------------------------
    |
    | Input:
    | 081234567890
    | 6281234567890
    | +6281234567890
    | +62 812-3456-7890
    |
    | Disimpan:
    | 6281234567890
    |
    */

    private function normalizeWhatsapp(
        ?string $number
    ): ?string {

        if (!$number) {
            return null;
        }


        $number =
            preg_replace(
                '/[^0-9]/',
                '',
                $number
            );


        if (!$number) {
            return null;
        }


        if (
            str_starts_with(
                $number,
                '0'
            )
        ) {

            $number =
                '62'
                .
                substr(
                    $number,
                    1
                );

        }


        if (
            str_starts_with(
                $number,
                '8'
            )
        ) {

            $number =
                '62'
                .
                $number;

        }


        return $number;
    }
}