<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <meta
        name="csrf-token"
        content="{{ csrf_token() }}"
    >

    <title>Daftar - HIMDAS</title>

    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])

</head>


<body class="hmreg-body">


<section class="hmreg-page">


    {{-- ===================================================== --}}
    {{-- BACKGROUND --}}
    {{-- ===================================================== --}}

    <div class="hmreg-background">

        <div class="hmreg-grid-bg"></div>

        <div class="hmreg-orb hmreg-orb-one"></div>

        <div class="hmreg-orb hmreg-orb-two"></div>

        <div class="hmreg-orb hmreg-orb-three"></div>

        <span class="hmreg-math hmreg-math-one">
            A ∩ B
        </span>

        <span class="hmreg-math hmreg-math-two">
            { }
        </span>

    </div>



    {{-- ===================================================== --}}
    {{-- SHELL --}}
    {{-- ===================================================== --}}

    <div class="hmreg-shell">


        {{-- ================================================= --}}
        {{-- LEFT SIDE --}}
        {{-- ================================================= --}}

        <aside class="hmreg-showcase">

            <div class="hmreg-showcase-glow"></div>


            <a
                href="{{ route('home') }}"
                class="hmreg-brand"
            >

                <div class="hmreg-brand-logo">

                    <img
                        src="{{ asset('images/logo-himdas-new.png') }}"
                        alt="Logo HIMDAS"
                    >

                </div>


                <div class="hmreg-brand-copy">

                    <strong>
                        HIMDAS
                    </strong>

                    <span>
                        Media Pembelajaran Interaktif
                    </span>

                </div>

            </a>



            <div class="hmreg-copy">

                <div class="hmreg-copy-badge">

                    <span>
                        ✦
                    </span>

                    MULAI PERJALANANMU

                </div>


                <h1>

                    Buat Akun.

                    <br>

                    Masuk Kelas.

                    <br>

                    <span>
                        Mulai Belajar.
                    </span>

                </h1>


                <p>

                    Daftar sesuai peranmu di HIMDAS.
                    Mahasiswa dapat langsung bergabung ke kelas
                    menggunakan kode yang diberikan dosen.

                </p>

            </div>



            {{-- ================================================= --}}
            {{-- JOURNEY --}}
            {{-- ================================================= --}}

            <div class="hmreg-journey">

                <div class="hmreg-journey-line"></div>


                <div class="hmreg-journey-item">

                    <div class="hmreg-journey-number">
                        01
                    </div>

                    <div>

                        <strong>
                            Buat akun
                        </strong>

                        <span>
                            Isi data dengan benar
                        </span>

                    </div>

                </div>


                <div class="hmreg-journey-item">

                    <div class="hmreg-journey-number">
                        02
                    </div>

                    <div>

                        <strong>
                            Gabung kelas
                        </strong>

                        <span>
                            Gunakan kode dari dosen
                        </span>

                    </div>

                </div>


                <div class="hmreg-journey-item">

                    <div class="hmreg-journey-number">
                        03
                    </div>

                    <div>

                        <strong>
                            Mulai belajar
                        </strong>

                        <span>
                            Raih XP, Badge & Level
                        </span>

                    </div>

                </div>

            </div>



            <div class="hmreg-quote">

                <span>
                    ✦
                </span>

                <p>
                    Satu akun untuk seluruh perjalanan belajar di HIMDAS.
                </p>

            </div>

        </aside>



        {{-- ================================================= --}}
        {{-- RIGHT SIDE --}}
        {{-- ================================================= --}}

        <main class="hmreg-panel">


            {{-- MOBILE LOGO --}}

            <div class="hmreg-mobile-logo">

                <a href="{{ route('home') }}">

                    <img
                        src="{{ asset('images/logo-himdas-new.png') }}"
                        alt="HIMDAS"
                    >

                </a>

            </div>



            {{-- TOP --}}

            <div class="hmreg-top">

                <a
                    href="{{ route('home') }}"
                    class="hmreg-back"
                >

                    <span>
                        ←
                    </span>

                    Beranda

                </a>


                <span class="hmreg-safe">

                    <span>
                        🔒
                    </span>

                    Aman

                </span>

            </div>



            {{-- ================================================= --}}
            {{-- HEADING --}}
            {{-- ================================================= --}}

            <div class="hmreg-heading">

                <span id="registerEyebrow">
                    AKUN MAHASISWA
                </span>


                <h2>
                    Buat Akun HIMDAS
                </h2>


                <p id="registerDescription">

                    Daftar sebagai mahasiswa dan gunakan
                    kode kelas dari dosen.

                </p>

            </div>



            {{-- ================================================= --}}
            {{-- ERROR --}}
            {{-- ================================================= --}}

            @if ($errors->any())

                <div class="hmreg-error">

                    <div class="hmreg-error-icon">
                        !
                    </div>


                    <div>

                        <strong>
                            Pendaftaran belum berhasil
                        </strong>

                        <span>
                            {{ $errors->first() }}
                        </span>

                    </div>

                </div>

            @endif



            {{-- ================================================= --}}
            {{-- FORM --}}
            {{-- ================================================= --}}

            <form
                method="POST"
                action="{{ route('register.process') }}"
                class="hmreg-form"
            >

                @csrf



                {{-- ================================================= --}}
                {{-- ROLE --}}
                {{-- ================================================= --}}

                <div class="hmreg-field">

                    <label class="hmreg-label">
                        Daftar Sebagai
                    </label>


                    <div class="hmreg-role-grid">


                        {{-- MAHASISWA --}}

                        <label class="hmreg-role-option">

                            <input
                                type="radio"
                                name="role"
                                value="mahasiswa"
                                {{ old('role', 'mahasiswa') === 'mahasiswa' ? 'checked' : '' }}
                            >


                            <div class="hmreg-role-card">

                                <div class="hmreg-role-icon student">

                                    <svg
                                        viewBox="0 0 64 64"
                                        aria-hidden="true"
                                    >

                                        <path
                                            d="M6 24L32 11L58 24L32 37L6 24Z"
                                            fill="currentColor"
                                        />

                                        <path
                                            d="M17 31V42C17 48 24 53 32 53C40 53 47 48 47 42V31L32 39L17 31Z"
                                            fill="currentColor"
                                            opacity=".72"
                                        />

                                        <path
                                            d="M56 27V40"
                                            stroke="currentColor"
                                            stroke-width="4"
                                            stroke-linecap="round"
                                        />

                                        <circle
                                            cx="56"
                                            cy="43"
                                            r="3"
                                            fill="currentColor"
                                        />

                                    </svg>

                                </div>


                                <div class="hmreg-role-copy">

                                    <strong>
                                        Mahasiswa
                                    </strong>

                                    <span>
                                        Belajar dan gabung kelas
                                    </span>

                                </div>


                                <div class="hmreg-role-check">
                                    ✓
                                </div>

                            </div>

                        </label>



                        {{-- DOSEN --}}

                        <label class="hmreg-role-option">

                            <input
                                type="radio"
                                name="role"
                                value="dosen"
                                {{ old('role') === 'dosen' ? 'checked' : '' }}
                            >


                            <div class="hmreg-role-card">

                                <div class="hmreg-role-icon lecturer">

                                    <svg
                                        viewBox="0 0 64 64"
                                        aria-hidden="true"
                                    >

                                        <rect
                                            x="20"
                                            y="9"
                                            width="38"
                                            height="30"
                                            rx="5"
                                            fill="currentColor"
                                            opacity=".20"
                                        />

                                        <path
                                            d="M25 15H53V33H25V15Z"
                                            stroke="currentColor"
                                            stroke-width="4"
                                            stroke-linejoin="round"
                                        />

                                        <circle
                                            cx="14"
                                            cy="24"
                                            r="7"
                                            fill="currentColor"
                                        />

                                        <path
                                            d="M4 50C4 41 8 35 14 35C20 35 24 41 24 50"
                                            fill="currentColor"
                                            opacity=".78"
                                        />

                                        <path
                                            d="M29 45H55"
                                            stroke="currentColor"
                                            stroke-width="4"
                                            stroke-linecap="round"
                                        />

                                    </svg>

                                </div>


                                <div class="hmreg-role-copy">

                                    <strong>
                                        Dosen
                                    </strong>

                                    <span>
                                        Buat dan kelola kelas
                                    </span>

                                </div>


                                <div class="hmreg-role-check">
                                    ✓
                                </div>

                            </div>

                        </label>

                    </div>

                </div>



                {{-- ================================================= --}}
                {{-- NAMA --}}
                {{-- ================================================= --}}

                <div class="hmreg-field">

                    <label
                        for="name"
                        class="hmreg-label"
                    >
                        Nama Lengkap
                    </label>


                    <div class="hmreg-input">

                        <span class="hmreg-input-icon">

                            <svg
                                viewBox="0 0 24 24"
                                aria-hidden="true"
                            >

                                <circle
                                    cx="12"
                                    cy="8"
                                    r="4"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                />

                                <path
                                    d="M4 20C4 15.8 7.6 13 12 13C16.4 13 20 15.8 20 20"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                    stroke-linecap="round"
                                />

                            </svg>

                        </span>


                        <input
                            id="name"
                            type="text"
                            name="name"
                            value="{{ old('name') }}"
                            placeholder="Masukkan nama lengkap"
                            autocomplete="name"
                            required
                        >

                    </div>

                </div>



                {{-- ================================================= --}}
                {{-- WHATSAPP --}}
                {{-- ================================================= --}}

                <div
                    class="hmreg-field student-only-field"
                    id="whatsappField"
                >

                    <label
                        for="whatsapp"
                        class="hmreg-label"
                    >
                        Nomor WhatsApp
                    </label>


                    <div class="hmreg-input">

                        <span class="hmreg-input-icon">

                            <svg
                                viewBox="0 0 24 24"
                                aria-hidden="true"
                            >

                                <path
                                    d="M7.2 4.5L9.2 8.5L7.7 10C8.8 12.3 10.7 14.2 13 15.3L14.5 13.8L18.5 15.8C19 16 19.2 16.6 19 17.1L18.2 19.3C18 19.8 17.5 20.1 17 20C9.8 18.9 5.1 14.2 4 7C3.9 6.5 4.2 6 4.7 5.8L6.9 5C7.1 4.9 7.2 4.7 7.2 4.5Z"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.7"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                />

                            </svg>

                        </span>


                        <input
                            id="whatsapp"
                            type="tel"
                            name="whatsapp"
                            value="{{ old('whatsapp') }}"
                            placeholder="Contoh: 081234567890"
                            autocomplete="tel"
                        >

                    </div>


                    <small class="hmreg-help">

                        Digunakan sebagai informasi kontak mahasiswa.

                    </small>

                </div>



                {{-- ================================================= --}}
                {{-- EMAIL --}}
                {{-- ================================================= --}}

                <div class="hmreg-field">

                    <label
                        for="email"
                        class="hmreg-label"
                    >
                        Email
                    </label>


                    <div class="hmreg-input">

                        <span class="hmreg-input-icon">

                            <svg
                                viewBox="0 0 24 24"
                                aria-hidden="true"
                            >

                                <path
                                    d="M3 6H21V18H3V6Z"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                    stroke-linejoin="round"
                                />

                                <path
                                    d="M4 7L12 13L20 7"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                />

                            </svg>

                        </span>


                        <input
                            id="email"
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            placeholder="Masukkan email"
                            autocomplete="email"
                            required
                        >

                    </div>

                </div>



                {{-- ================================================= --}}
                {{-- PASSWORD --}}
                {{-- ================================================= --}}

                <div class="hmreg-password-grid">


                    {{-- PASSWORD --}}

                    <div class="hmreg-password-field">

                        <label
                            for="password"
                            class="hmreg-password-label"
                        >
                            Password
                        </label>


                        <div class="hmreg-password-box">

                            <span class="hmreg-password-icon">

                                <svg
                                    viewBox="0 0 24 24"
                                    aria-hidden="true"
                                >

                                    <rect
                                        x="5"
                                        y="10"
                                        width="14"
                                        height="10"
                                        rx="2"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="1.8"
                                    />

                                    <path
                                        d="M8 10V7C8 4.8 9.8 3 12 3C14.2 3 16 4.8 16 7V10"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="1.8"
                                        stroke-linecap="round"
                                    />

                                </svg>

                            </span>


                            <input
                                id="password"
                                type="password"
                                name="password"
                                placeholder="Minimal 8 karakter"
                                autocomplete="new-password"
                                required
                            >


                            <button
                                type="button"
                                class="hmreg-password-eye"
                                data-target="password"
                                aria-label="Tampilkan password"
                            >

                                <svg
                                    viewBox="0 0 24 24"
                                    aria-hidden="true"
                                >

                                    <path
                                        d="M2.5 12C4.7 8.5 8.1 6.5 12 6.5C15.9 6.5 19.3 8.5 21.5 12C19.3 15.5 15.9 17.5 12 17.5C8.1 17.5 4.7 15.5 2.5 12Z"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="1.7"
                                    />

                                    <circle
                                        cx="12"
                                        cy="12"
                                        r="2.5"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="1.7"
                                    />

                                </svg>

                            </button>

                        </div>

                    </div>



                    {{-- KONFIRMASI PASSWORD --}}

                    <div class="hmreg-password-field">

                        <label
                            for="password_confirmation"
                            class="hmreg-password-label"
                        >
                            Konfirmasi Password
                        </label>


                        <div class="hmreg-password-box">

                            <span class="hmreg-password-icon">

                                <svg
                                    viewBox="0 0 24 24"
                                    aria-hidden="true"
                                >

                                    <rect
                                        x="5"
                                        y="10"
                                        width="14"
                                        height="10"
                                        rx="2"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="1.8"
                                    />

                                    <path
                                        d="M8 10V7C8 4.8 9.8 3 12 3C14.2 3 16 4.8 16 7V10"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="1.8"
                                        stroke-linecap="round"
                                    />

                                    <path
                                        d="M9.2 15.2L11.1 17L15 13.2"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="1.6"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                    />

                                </svg>

                            </span>


                            <input
                                id="password_confirmation"
                                type="password"
                                name="password_confirmation"
                                placeholder="Ulangi password"
                                autocomplete="new-password"
                                required
                            >


                            <button
                                type="button"
                                class="hmreg-password-eye"
                                data-target="password_confirmation"
                                aria-label="Tampilkan konfirmasi password"
                            >

                                <svg
                                    viewBox="0 0 24 24"
                                    aria-hidden="true"
                                >

                                    <path
                                        d="M2.5 12C4.7 8.5 8.1 6.5 12 6.5C15.9 6.5 19.3 8.5 21.5 12C19.3 15.5 15.9 17.5 12 17.5C8.1 17.5 4.7 15.5 2.5 12Z"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="1.7"
                                    />

                                    <circle
                                        cx="12"
                                        cy="12"
                                        r="2.5"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="1.7"
                                    />

                                </svg>

                            </button>

                        </div>

                    </div>

                </div>



                {{-- ================================================= --}}
                {{-- KODE KELAS --}}
                {{-- ================================================= --}}

                <div
                    class="hmreg-field student-only-field"
                    id="classCodeField"
                >

                    <label
                        for="kode_kelas"
                        class="hmreg-label"
                    >
                        Kode Kelas
                    </label>


                    <div class="hmreg-input hmreg-class-input">

                        <span class="hmreg-input-icon">
                            #
                        </span>


                        <input
                            id="kode_kelas"
                            type="text"
                            name="kode_kelas"
                            value="{{ old('kode_kelas') }}"
                            placeholder="Contoh: HIM-7XK2P4"
                            autocomplete="off"
                        >

                    </div>


                    <small class="hmreg-help">

                        Kode kelas diberikan oleh dosen.
                        Mahasiswa wajib bergabung ke kelas
                        saat membuat akun.

                    </small>

                </div>



                {{-- ================================================= --}}
                {{-- BUTTON --}}
                {{-- ================================================= --}}

                <button
                    type="submit"
                    class="hmreg-submit"
                >

                    <span id="registerButtonText">
                        Daftar & Gabung Kelas
                    </span>


                    <b>
                        →
                    </b>

                </button>

            </form>



            {{-- ================================================= --}}
            {{-- FOOTER --}}
            {{-- ================================================= --}}

            <div class="hmreg-footer">

                Sudah punya akun?

                <a href="{{ route('login') }}">
                    Masuk
                </a>

            </div>

        </main>

    </div>

</section>



<script>

/* =========================================================
   ROLE REGISTER
========================================================= */

const roleInputs =
    document.querySelectorAll(
        'input[name="role"]'
    );


const whatsappField =
    document.getElementById(
        'whatsappField'
    );


const classCodeField =
    document.getElementById(
        'classCodeField'
    );


const whatsappInput =
    document.getElementById(
        'whatsapp'
    );


const classCodeInput =
    document.getElementById(
        'kode_kelas'
    );


const eyebrow =
    document.getElementById(
        'registerEyebrow'
    );


const description =
    document.getElementById(
        'registerDescription'
    );


const buttonText =
    document.getElementById(
        'registerButtonText'
    );


function updateRegisterRole() {

    const selected =
        document.querySelector(
            'input[name="role"]:checked'
        );


    if (!selected) {
        return;
    }


    const isStudent =
        selected.value ===
        'mahasiswa';


    if (whatsappField) {

        whatsappField.classList.toggle(
            'is-hidden',
            !isStudent
        );

    }


    if (classCodeField) {

        classCodeField.classList.toggle(
            'is-hidden',
            !isStudent
        );

    }


    if (whatsappInput) {

        whatsappInput.disabled =
            !isStudent;

        whatsappInput.required =
            isStudent;

    }


    if (classCodeInput) {

        classCodeInput.disabled =
            !isStudent;

        classCodeInput.required =
            isStudent;

    }


    if (isStudent) {

        eyebrow.textContent =
            'AKUN MAHASISWA';


        description.textContent =
            'Daftar sebagai mahasiswa dan gunakan kode kelas dari dosen.';


        buttonText.textContent =
            'Daftar & Gabung Kelas';

    } else {

        eyebrow.textContent =
            'AKUN DOSEN';


        description.textContent =
            'Buat akun dosen untuk membuat dan mengelola kelas pembelajaran.';


        buttonText.textContent =
            'Daftar sebagai Dosen';

    }

}


roleInputs.forEach(
    function (input) {

        input.addEventListener(
            'change',
            updateRegisterRole
        );

    }
);


updateRegisterRole();



/* =========================================================
   PASSWORD TOGGLE
========================================================= */

document
    .querySelectorAll('.hmreg-password-eye')
    .forEach(function (button) {

        button.addEventListener(
            'click',
            function () {

                const target =
                    document.getElementById(
                        button.dataset.target
                    );


                if (!target) {
                    return;
                }


                const isHidden =
                    target.type ===
                    'password';


                target.type =
                    isHidden
                        ? 'text'
                        : 'password';


                button.classList.toggle(
                    'is-visible',
                    isHidden
                );


                button.setAttribute(
                    'aria-label',
                    isHidden
                        ? 'Sembunyikan password'
                        : 'Tampilkan password'
                );

            }
        );

    });

</script>



<style>

/* =========================================================
   RESET
========================================================= */

html,
body {
    margin: 0;

    min-height: 100%;

    max-width: 100%;

    overflow-x: hidden;
}


.hmreg-body {
    min-height: 100dvh;

    color: #172033;

    background:
        #edf7ff;
}


.hmreg-page,
.hmreg-page * {
    box-sizing:
        border-box;
}


/* =========================================================
   PAGE
========================================================= */

.hmreg-page {
    min-height:
        100dvh;

    padding:
        24px;

    position:
        relative;

    display:
        flex;

    align-items:
        center;

    justify-content:
        center;

    overflow-x:
        hidden;

    isolation:
        isolate;

    background:
        radial-gradient(
            circle at 7% 8%,
            rgba(37, 99, 235, .14),
            transparent 30%
        ),
        radial-gradient(
            circle at 94% 15%,
            rgba(34, 211, 238, .16),
            transparent 28%
        ),
        radial-gradient(
            circle at 65% 95%,
            rgba(16, 185, 129, .11),
            transparent 30%
        ),
        linear-gradient(
            135deg,
            #f9fcff,
            #eef6ff 48%,
            #e6fbff
        );
}


/* =========================================================
   BACKGROUND
========================================================= */

.hmreg-background {
    position:
        absolute;

    inset:
        0;

    z-index:
        0;

    overflow:
        hidden;

    pointer-events:
        none;
}


.hmreg-grid-bg {
    width:
        700px;

    height:
        700px;

    position:
        absolute;

    right:
        -130px;

    top:
        -160px;

    opacity:
        .16;

    background-image:
        linear-gradient(
            rgba(37, 99, 235, .12) 1px,
            transparent 1px
        ),
        linear-gradient(
            90deg,
            rgba(37, 99, 235, .12) 1px,
            transparent 1px
        );

    background-size:
        42px 42px;
}


.hmreg-orb {
    position:
        absolute;

    border-radius:
        50%;
}


.hmreg-orb-one {
    width:
        370px;

    height:
        370px;

    left:
        -170px;

    top:
        -80px;

    background:
        rgba(37, 99, 235, .08);
}


.hmreg-orb-two {
    width:
        350px;

    height:
        350px;

    right:
        -170px;

    bottom:
        -110px;

    background:
        rgba(6, 182, 212, .10);
}


.hmreg-orb-three {
    width:
        200px;

    height:
        200px;

    left:
        44%;

    bottom:
        -120px;

    background:
        rgba(16, 185, 129, .09);
}


.hmreg-math {
    position:
        absolute;

    color:
        rgba(37, 99, 235, .06);

    font-family:
        Georgia,
        serif;

    user-select:
        none;
}


.hmreg-math-one {
    right:
        4%;

    top:
        7%;

    font-size:
        48px;
}


.hmreg-math-two {
    left:
        5%;

    bottom:
        4%;

    font-size:
        120px;
}


/* =========================================================
   SHELL
========================================================= */

.hmreg-shell {
    width:
        min(
            1180px,
            100%
        );

    position:
        relative;

    z-index:
        3;

    display:
        grid;

    grid-template-columns:
        minmax(0, .88fr)
        minmax(500px, 1.12fr);

    overflow:
        hidden;

    border:
        1px solid
        rgba(255, 255, 255, .90);

    border-radius:
        32px;

    background:
        rgba(255, 255, 255, .72);

    backdrop-filter:
        blur(25px);

    box-shadow:
        0 35px 90px
        rgba(27, 76, 128, .18);
}


/* =========================================================
   SHOWCASE
========================================================= */

.hmreg-showcase {
    min-height:
        790px;

    padding:
        38px;

    position:
        relative;

    overflow:
        hidden;

    color:
        white;

    background:
        radial-gradient(
            circle at 90% 4%,
            rgba(34, 211, 238, .28),
            transparent 32%
        ),
        linear-gradient(
            145deg,
            #0b234a 0%,
            #184d8c 54%,
            #0e7490 100%
        );
}


.hmreg-showcase-glow {
    width:
        330px;

    height:
        330px;

    position:
        absolute;

    right:
        -170px;

    bottom:
        -150px;

    border-radius:
        50%;

    background:
        rgba(52, 211, 153, .16);
}


/* =========================================================
   BRAND
========================================================= */

.hmreg-brand {
    position:
        relative;

    z-index:
        3;

    display:
        flex;

    align-items:
        center;

    gap:
        12px;

    color:
        white;

    text-decoration:
        none;
}


.hmreg-brand-logo {
    width:
        64px;

    height:
        54px;

    display:
        flex;

    align-items:
        center;

    justify-content:
        center;

    border:
        1px solid
        rgba(255, 255, 255, .15);

    border-radius:
        14px;

    background:
        rgba(255, 255, 255, .10);
}


.hmreg-brand-logo img {
    width:
        54px;

    height:
        45px;

    object-fit:
        contain;
}


.hmreg-brand-copy strong {
    display:
        block;

    font-size:
        15px;

    font-weight:
        800;
}


.hmreg-brand-copy span {
    display:
        block;

    margin-top:
        2px;

    color:
        rgba(220, 244, 255, .74);

    font-size:
        8px;
}


/* =========================================================
   COPY
========================================================= */

.hmreg-copy {
    margin-top:
        58px;

    position:
        relative;

    z-index:
        3;
}


.hmreg-copy-badge {
    width:
        fit-content;

    padding:
        7px 10px;

    border:
        1px solid
        rgba(255, 255, 255, .13);

    border-radius:
        999px;

    color:
        #bfeaff;

    background:
        rgba(255, 255, 255, .08);

    font-size:
        7px;

    font-weight:
        800;

    letter-spacing:
        .8px;
}


.hmreg-copy-badge span {
    color:
        #fbbf24;
}


.hmreg-copy h1 {
    margin:
        17px 0 0;

    color:
        white;

    font-size:
        clamp(
            43px,
            4vw,
            57px
        );

    font-weight:
        800;

    line-height:
        .99;

    letter-spacing:
        -2px;
}


.hmreg-copy h1 span {
    color:
        #5eead4;
}


.hmreg-copy p {
    max-width:
        390px;

    margin-top:
        17px;

    color:
        rgba(220, 244, 255, .82);

    font-size:
        11px;

    line-height:
        1.75;
}


/* =========================================================
   JOURNEY
========================================================= */

.hmreg-journey {
    margin-top:
        38px;

    position:
        relative;

    z-index:
        3;

    display:
        grid;

    gap:
        13px;
}


.hmreg-journey-line {
    width:
        2px;

    position:
        absolute;

    left:
        18px;

    top:
        25px;

    bottom:
        25px;

    background:
        linear-gradient(
            #60a5fa,
            #22d3ee,
            #34d399
        );
}


.hmreg-journey-item {
    position:
        relative;

    z-index:
        2;

    display:
        flex;

    align-items:
        center;

    gap:
        12px;
}


.hmreg-journey-number {
    width:
        38px;

    height:
        38px;

    flex-shrink:
        0;

    display:
        flex;

    align-items:
        center;

    justify-content:
        center;

    border:
        1px solid
        rgba(255, 255, 255, .20);

    border-radius:
        50%;

    color:
        white;

    background:
        rgba(255, 255, 255, .12);

    backdrop-filter:
        blur(10px);

    font-size:
        8px;

    font-weight:
        800;
}


.hmreg-journey-item strong {
    display:
        block;

    color:
        white;

    font-size:
        10px;
}


.hmreg-journey-item span {
    display:
        block;

    margin-top:
        2px;

    color:
        rgba(218, 241, 250, .70);

    font-size:
        7px;
}


.hmreg-quote {
    margin-top:
        42px;

    padding:
        12px;

    position:
        relative;

    z-index:
        3;

    display:
        flex;

    gap:
        8px;

    border:
        1px solid
        rgba(255, 255, 255, .10);

    border-radius:
        13px;

    background:
        rgba(255, 255, 255, .07);
}


.hmreg-quote span {
    color:
        #7dd3fc;
}


.hmreg-quote p {
    margin:
        0;

    color:
        rgba(223, 244, 252, .86);

    font-size:
        8px;

    line-height:
        1.5;
}


/* =========================================================
   PANEL
========================================================= */

.hmreg-panel {
    min-width:
        0;

    padding:
        34px 45px 30px;

    background:
        rgba(255, 255, 255, .90);
}


.hmreg-mobile-logo {
    display:
        none;
}


.hmreg-top {
    display:
        flex;

    align-items:
        center;

    justify-content:
        space-between;
}


.hmreg-back {
    display:
        inline-flex;

    align-items:
        center;

    gap:
        6px;

    color:
        #64748b;

    font-size:
        9px;

    font-weight:
        700;

    text-decoration:
        none;

    transition:
        color .2s ease;
}


.hmreg-back:hover {
    color:
        #2563eb;
}


.hmreg-safe {
    padding:
        5px 8px;

    display:
        inline-flex;

    align-items:
        center;

    gap:
        4px;

    border-radius:
        999px;

    color:
        #059669;

    background:
        #ecfdf5;

    font-size:
        7px;

    font-weight:
        700;
}


/* =========================================================
   HEADING
========================================================= */

.hmreg-heading {
    margin-top:
        20px;
}


.hmreg-heading > span {
    color:
        #2563eb;

    font-size:
        7px;

    font-weight:
        800;

    letter-spacing:
        1.1px;
}


.hmreg-heading h2 {
    margin:
        6px 0 0;

    color:
        #172033;

    font-size:
        clamp(
            29px,
            2.8vw,
            37px
        );

    font-weight:
        800;

    line-height:
        1.05;

    letter-spacing:
        -1.15px;
}


.hmreg-heading p {
    margin-top:
        7px;

    color:
        #718196;

    font-size:
        9.5px;

    line-height:
        1.5;
}


/* =========================================================
   ERROR
========================================================= */

.hmreg-error {
    margin-top:
        14px;

    padding:
        10px;

    display:
        flex;

    align-items:
        center;

    gap:
        9px;

    border:
        1px solid
        #fecaca;

    border-radius:
        11px;

    color:
        #991b1b;

    background:
        #fff7f7;
}


.hmreg-error-icon {
    width:
        30px;

    height:
        30px;

    flex-shrink:
        0;

    display:
        flex;

    align-items:
        center;

    justify-content:
        center;

    border-radius:
        9px;

    color:
        white;

    background:
        #ef4444;

    font-weight:
        800;
}


.hmreg-error strong {
    display:
        block;

    font-size:
        8px;
}


.hmreg-error span {
    display:
        block;

    margin-top:
        2px;

    font-size:
        7px;
}


/* =========================================================
   FORM
========================================================= */

.hmreg-form {
    margin-top:
        17px;
}


.hmreg-field {
    min-width:
        0;
}


.hmreg-field + .hmreg-field,
.hmreg-password-grid + .hmreg-field {
    margin-top:
        12px;
}


.hmreg-label,
.hmreg-password-label {
    display:
        flex;

    align-items:
        center;

    min-height:
        18px;

    margin-bottom:
        6px;

    color:
        #34455b;

    font-size:
        8.5px;

    font-weight:
        700;

    line-height:
        1.2;
}


/* =========================================================
   ROLE
========================================================= */

.hmreg-role-grid {
    display:
        grid;

    grid-template-columns:
        repeat(
            2,
            minmax(0, 1fr)
        );

    gap:
        9px;
}


.hmreg-role-option {
    min-width:
        0;

    cursor:
        pointer;
}


.hmreg-role-option input {
    position:
        absolute;

    opacity:
        0;

    pointer-events:
        none;
}


.hmreg-role-card {
    min-height:
        82px;

    padding:
        11px;

    position:
        relative;

    display:
        flex;

    align-items:
        center;

    gap:
        9px;

    border:
        1px solid
        #dce7f3;

    border-radius:
        14px;

    background:
        #fbfdff;

    transition:
        border-color .22s ease,
        transform .22s ease,
        box-shadow .22s ease,
        background .22s ease;
}


.hmreg-role-option:hover
.hmreg-role-card {
    border-color:
        #9dc4ff;

    transform:
        translateY(-2px);
}


.hmreg-role-option input:checked
+
.hmreg-role-card {
    border-color:
        #60a5fa;

    background:
        linear-gradient(
            145deg,
            #eff6ff,
            #ecfeff
        );

    box-shadow:
        0 12px 28px
        rgba(37, 99, 235, .10);
}


.hmreg-role-icon {
    width:
        44px;

    height:
        44px;

    flex-shrink:
        0;

    display:
        flex;

    align-items:
        center;

    justify-content:
        center;

    border-radius:
        12px;
}


.hmreg-role-icon svg {
    width:
        28px;

    height:
        28px;
}


.hmreg-role-icon.student {
    color:
        #2563eb;

    background:
        #eff6ff;
}


.hmreg-role-icon.lecturer {
    color:
        #059669;

    background:
        #ecfdf5;
}


.hmreg-role-copy {
    min-width:
        0;
}


.hmreg-role-copy strong {
    display:
        block;

    color:
        #1e293b;

    font-size:
        9.5px;

    font-weight:
        800;
}


.hmreg-role-copy span {
    display:
        block;

    margin-top:
        2px;

    color:
        #8291a4;

    font-size:
        6.5px;

    line-height:
        1.35;
}


.hmreg-role-check {
    width:
        19px;

    height:
        19px;

    position:
        absolute;

    top:
        7px;

    right:
        7px;

    display:
        flex;

    align-items:
        center;

    justify-content:
        center;

    border-radius:
        50%;

    color:
        white;

    background:
        #2563eb;

    font-size:
        8px;

    font-weight:
        800;

    opacity:
        0;

    transform:
        scale(.6);

    transition:
        .2s ease;
}


.hmreg-role-option input:checked
+
.hmreg-role-card
.hmreg-role-check {
    opacity:
        1;

    transform:
        scale(1);
}


/* =========================================================
   NORMAL INPUT
========================================================= */

.hmreg-input {
    width:
        100%;

    height:
        49px;

    position:
        relative;

    display:
        flex;

    align-items:
        center;

    overflow:
        hidden;

    border:
        1px solid
        #d8e4f0;

    border-radius:
        12px;

    background:
        #fbfdff;

    transition:
        border-color .2s ease,
        box-shadow .2s ease,
        background .2s ease;
}


.hmreg-input:hover {
    border-color:
        #bdcee1;
}


.hmreg-input:focus-within {
    border-color:
        #60a5fa;

    background:
        white;

    box-shadow:
        0 0 0 4px
        rgba(37, 99, 235, .07);
}


.hmreg-input-icon {
    width:
        43px;

    height:
        100%;

    flex:
        0 0 43px;

    display:
        flex;

    align-items:
        center;

    justify-content:
        center;

    color:
        #7890a8;

    font-size:
        10px;
}


.hmreg-input-icon svg {
    width:
        17px;

    height:
        17px;
}


.hmreg-input input {
    min-width:
        0;

    width:
        100%;

    height:
        100%;

    padding:
        0 14px 0 0;

    border:
        0;

    outline:
        0;

    color:
        #172033;

    background:
        transparent;

    font:
        inherit;

    font-size:
        9.5px;
}


.hmreg-input input::placeholder {
    color:
        #a0adbc;
}


.hmreg-help {
    display:
        block;

    margin-top:
        5px;

    color:
        #8b9aab;

    font-size:
        7px;

    line-height:
        1.4;
}


/* =========================================================
   PASSWORD GRID
========================================================= */

.hmreg-password-grid {
    width:
        100%;

    margin-top:
        12px;

    display:
        grid;

    grid-template-columns:
        repeat(
            2,
            minmax(0, 1fr)
        );

    gap:
        12px;

    align-items:
        end;
}


.hmreg-password-field {
    min-width:
        0;

    width:
        100%;
}


/* PASSWORD BOX */

.hmreg-password-box {
    width:
        100%;

    height:
        49px;

    position:
        relative;

    display:
        flex;

    align-items:
        center;

    overflow:
        hidden;

    border:
        1px solid
        #d8e4f0;

    border-radius:
        12px;

    background:
        linear-gradient(
            145deg,
            #fbfdff,
            #f8fbff
        );

    transition:
        border-color .2s ease,
        box-shadow .2s ease,
        background .2s ease;
}


.hmreg-password-box:hover {
    border-color:
        #bdcee1;
}


.hmreg-password-box:focus-within {
    border-color:
        #60a5fa;

    background:
        white;

    box-shadow:
        0 0 0 4px
        rgba(37, 99, 235, .07);
}


/* PASSWORD LEFT ICON */

.hmreg-password-icon {
    width:
        43px;

    height:
        100%;

    flex:
        0 0 43px;

    display:
        flex;

    align-items:
        center;

    justify-content:
        center;

    color:
        #7890a8;
}


.hmreg-password-icon svg {
    width:
        17px;

    height:
        17px;
}


/* PASSWORD INPUT */

.hmreg-password-box input {
    min-width:
        0;

    width:
        100%;

    height:
        100%;

    padding:
        0 43px 0 0;

    border:
        0;

    outline:
        0;

    color:
        #172033;

    background:
        transparent;

    font:
        inherit;

    font-size:
        9.5px;
}


.hmreg-password-box input::placeholder {
    color:
        #a0adbc;
}


/* EYE BUTTON */

.hmreg-password-eye {
    width:
        35px;

    height:
        35px;

    position:
        absolute;

    top:
        50%;

    right:
        6px;

    transform:
        translateY(-50%);

    display:
        flex;

    align-items:
        center;

    justify-content:
        center;

    border:
        0;

    border-radius:
        9px;

    color:
        #77889d;

    background:
        transparent;

    cursor:
        pointer;

    transition:
        color .2s ease,
        background .2s ease;
}


.hmreg-password-eye:hover,
.hmreg-password-eye.is-visible {
    color:
        #2563eb;

    background:
        #eff6ff;
}


.hmreg-password-eye svg {
    width:
        17px;

    height:
        17px;
}


/* =========================================================
   STUDENT FIELDS
========================================================= */

.student-only-field {
    max-height:
        160px;

    opacity:
        1;

    overflow:
        hidden;

    transition:
        opacity .25s ease,
        max-height .3s ease,
        margin .3s ease;
}


.student-only-field.is-hidden {
    max-height:
        0;

    margin-top:
        0 !important;

    opacity:
        0;

    pointer-events:
        none;
}


/* =========================================================
   SUBMIT
========================================================= */

.hmreg-submit {
    width:
        100%;

    min-height:
        50px;

    margin-top:
        17px;

    padding:
        0 17px;

    display:
        flex;

    align-items:
        center;

    justify-content:
        space-between;

    border:
        0;

    border-radius:
        13px;

    color:
        white;

    background:
        linear-gradient(
            105deg,
            #2563eb,
            #06b6d4,
            #10b981
        );

    box-shadow:
        0 15px 32px
        rgba(37, 99, 235, .22);

    cursor:
        pointer;

    font-size:
        9.5px;

    font-weight:
        800;

    transition:
        transform .2s ease,
        box-shadow .2s ease;
}


.hmreg-submit:hover {
    transform:
        translateY(-2px);

    box-shadow:
        0 19px 38px
        rgba(37, 99, 235, .28);
}


.hmreg-submit b {
    width:
        27px;

    height:
        27px;

    display:
        flex;

    align-items:
        center;

    justify-content:
        center;

    border-radius:
        50%;

    background:
        rgba(255, 255, 255, .15);

    font-size:
        13px;
}


/* =========================================================
   FOOTER
========================================================= */

.hmreg-footer {
    margin-top:
        16px;

    color:
        #77889c;

    font-size:
        8.5px;

    text-align:
        center;
}


.hmreg-footer a {
    color:
        #2563eb;

    font-weight:
        800;

    text-decoration:
        none;
}


/* =========================================================
   NORMAL LAPTOP
========================================================= */

@media (max-width: 1200px) {

    .hmreg-page {
        padding:
            18px;
    }


    .hmreg-shell {
        grid-template-columns:
            minmax(390px, .86fr)
            minmax(470px, 1.14fr);
    }


    .hmreg-showcase {
        padding:
            32px;

        min-height:
            760px;
    }


    .hmreg-panel {
        padding:
            30px 36px;
    }


    .hmreg-copy h1 {
        font-size:
            48px;
    }

}


/* =========================================================
   TABLET
========================================================= */

@media (max-width: 950px) {

    .hmreg-page {
        padding:
            20px;
    }


    .hmreg-shell {
        max-width:
            650px;

        display:
            block;
    }


    .hmreg-showcase {
        display:
            none;
    }


    .hmreg-panel {
        padding:
            30px 35px 32px;
    }


    .hmreg-mobile-logo {
        margin-bottom:
            18px;

        display:
            block;

        text-align:
            center;
    }


    .hmreg-mobile-logo img {
        width:
            85px;

        height:
            64px;

        object-fit:
            contain;
    }

}


/* =========================================================
   MOBILE
========================================================= */

@media (max-width: 620px) {

    .hmreg-page {
        padding:
            10px;
    }


    .hmreg-shell {
        border-radius:
            23px;
    }


    .hmreg-panel {
        padding:
            23px 17px 26px;
    }


    .hmreg-role-grid {
        grid-template-columns:
            1fr;
    }


    .hmreg-role-card {
        min-height:
            76px;
    }


    .hmreg-password-grid {
        grid-template-columns:
            1fr;

        gap:
            12px;
    }


    .hmreg-password-label {
        min-height:
            auto;
    }


    .hmreg-heading h2 {
        font-size:
            29px;
    }


    .hmreg-input,
    .hmreg-password-box {
        height:
            50px;
    }

}


/* =========================================================
   SMALL MOBILE
========================================================= */

@media (max-width: 390px) {

    .hmreg-panel {
        padding:
            21px 14px 24px;
    }


    .hmreg-heading h2 {
        font-size:
            26px;
    }


    .hmreg-role-card {
        padding:
            10px;
    }


    .hmreg-role-icon {
        width:
            40px;

        height:
            40px;
    }

}

</style>


</body>

</html>