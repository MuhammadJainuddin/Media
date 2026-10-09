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

    <title>Masuk - HIMDAS</title>

    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])

</head>


<body class="hmauth-body">


<section class="hmauth-page">


    {{-- ===================================================== --}}
    {{-- BACKGROUND --}}
    {{-- ===================================================== --}}

    <div class="hmauth-background">

        <div class="hmauth-grid"></div>

        <div class="hmauth-orb hmauth-orb-one"></div>
        <div class="hmauth-orb hmauth-orb-two"></div>
        <div class="hmauth-orb hmauth-orb-three"></div>

        <span class="hmauth-math hmauth-math-one">
            ∩
        </span>

        <span class="hmauth-math hmauth-math-two">
            A ∩ B
        </span>

        <span class="hmauth-math hmauth-math-three">
            { }
        </span>

    </div>



    {{-- ===================================================== --}}
    {{-- MAIN --}}
    {{-- ===================================================== --}}

    <div class="hmauth-shell">


        {{-- ================================================= --}}
        {{-- LEFT VISUAL --}}
        {{-- ================================================= --}}

        <aside class="hmauth-showcase">


            <div class="hmauth-showcase-glow"></div>


            <a
                href="{{ route('home') }}"
                class="hmauth-brand"
            >

                <div class="hmauth-brand-logo">

                    <img
                        src="{{ asset('images/logo-himdas-new.png') }}"
                        alt="Logo HIMDAS"
                    >

                </div>


                <div>

                    <strong>
                        HIMDAS
                    </strong>

                    <span>
                        Media Pembelajaran Interaktif
                    </span>

                </div>

            </a>



            <div class="hmauth-showcase-copy">


                <div class="hmauth-showcase-badge">

                    <span>
                        ✦
                    </span>

                    BELAJAR • BERMAIN • BERKEMBANG

                </div>


                <h1>

                    Masuk.

                    <br>

                    Belajar.

                    <br>

                    <span>
                        Naik Level.
                    </span>

                </h1>


                <p>

                    Pelajari materi Himpunan dengan pengalaman belajar
                    yang lebih interaktif melalui level, challenge,
                    badge, XP, dan aktivitas pembelajaran HIMDAS.

                </p>


            </div>



            {{-- ================================================= --}}
            {{-- VISUAL HIMPUNAN --}}
            {{-- ================================================= --}}

            <div class="hmauth-set-visual">


                <div class="hmauth-set-orbit"></div>


                <div class="hmauth-set-circle set-a">

                    <span>
                        A
                    </span>

                </div>


                <div class="hmauth-set-circle set-b">

                    <span>
                        B
                    </span>

                </div>


                <div class="hmauth-set-center">
                    ∩
                </div>


                <span class="hmauth-brace brace-left">
                    {
                </span>

                <span class="hmauth-brace brace-right">
                    }
                </span>


            </div>



            {{-- ================================================= --}}
            {{-- GAMIFICATION INFO --}}
            {{-- ================================================= --}}

            <div class="hmauth-feature-grid">


                <div class="hmauth-feature">

                    <div class="hmauth-feature-icon blue">
                        ★
                    </div>

                    <div>

                        <strong>
                            XP
                        </strong>

                        <span>
                            Kumpulkan poin
                        </span>

                    </div>

                </div>


                <div class="hmauth-feature">

                    <div class="hmauth-feature-icon green">
                        ✓
                    </div>

                    <div>

                        <strong>
                            Progress
                        </strong>

                        <span>
                            Pantau belajarmu
                        </span>

                    </div>

                </div>


                <div class="hmauth-feature">

                    <div class="hmauth-feature-icon orange">
                        ⚡
                    </div>

                    <div>

                        <strong>
                            Challenge
                        </strong>

                        <span>
                            Tantangan harian
                        </span>

                    </div>

                </div>


                <div class="hmauth-feature">

                    <div class="hmauth-feature-icon purple">
                        ◆
                    </div>

                    <div>

                        <strong>
                            Badge
                        </strong>

                        <span>
                            Raih pencapaian
                        </span>

                    </div>

                </div>


            </div>


        </aside>



        {{-- ================================================= --}}
        {{-- LOGIN PANEL --}}
        {{-- ================================================= --}}

        <main class="hmauth-panel">


            <div class="hmauth-mobile-brand">

                <a href="{{ route('home') }}">

                    <img
                        src="{{ asset('images/logo-himdas-new.png') }}"
                        alt="HIMDAS"
                    >

                </a>

            </div>



            <div class="hmauth-panel-top">


                <a
                    href="{{ route('home') }}"
                    class="hmauth-back"
                >

                    <span>
                        ←
                    </span>

                    Beranda

                </a>


                <span class="hmauth-secure">
                    🔒 Aman
                </span>


            </div>



            <div class="hmauth-heading">


                <span>
                    SELAMAT DATANG
                </span>


                <h2>
                    Masuk ke HIMDAS
                </h2>


                <p>
                    Pilih jenis akun lalu masuk untuk melanjutkan aktivitasmu.
                </p>


            </div>



            @if ($errors->any())

                <div class="hmauth-error">

                    <div class="hmauth-error-icon">
                        !
                    </div>

                    <div>

                        <strong>
                            Tidak dapat masuk
                        </strong>

                        <span>
                            {{ $errors->first() }}
                        </span>

                    </div>

                </div>

            @endif



            <form
                action="{{ route('login.process') }}"
                method="POST"
                class="hmauth-form"
            >

                @csrf


                {{-- ================================================= --}}
                {{-- ROLE --}}
                {{-- ================================================= --}}

                <div class="hmauth-field">


                    <label class="hmauth-label">
                        Masuk Sebagai
                    </label>


                    <div class="hmauth-role-grid">


                        {{-- MAHASISWA --}}

                        <label class="hmauth-role-option">


                            <input
                                type="radio"
                                name="login_as"
                                value="mahasiswa"
                                {{ old('login_as', 'mahasiswa') === 'mahasiswa' ? 'checked' : '' }}
                            >


                            <div class="hmauth-role-card">


                                <div class="hmauth-role-icon student-icon">

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


                                <div class="hmauth-role-copy">

                                    <strong>
                                        Mahasiswa
                                    </strong>

                                    <span>
                                        Belajar & selesaikan level
                                    </span>

                                </div>


                                <div class="hmauth-role-check">
                                    ✓
                                </div>


                            </div>


                        </label>



                        {{-- DOSEN / ADMIN --}}

                        <label class="hmauth-role-option">


                            <input
                                type="radio"
                                name="login_as"
                                value="staff"
                                {{ old('login_as') === 'staff' ? 'checked' : '' }}
                            >


                            <div class="hmauth-role-card">


                                <div class="hmauth-role-icon lecturer-icon">

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


                                <div class="hmauth-role-copy">

                                    <strong>
                                        Dosen / Admin
                                    </strong>

                                    <span>
                                        Kelola kelas & pembelajaran
                                    </span>

                                </div>


                                <div class="hmauth-role-check">
                                    ✓
                                </div>


                            </div>


                        </label>


                    </div>


                </div>



                {{-- ================================================= --}}
                {{-- EMAIL --}}
                {{-- ================================================= --}}

                <div class="hmauth-field">


                    <label
                        for="email"
                        class="hmauth-label"
                    >
                        Email
                    </label>


                    <div class="hmauth-input-wrap">


                        <span class="hmauth-input-icon">

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
                            placeholder="contoh@email.com"
                            autocomplete="email"
                            required
                        >


                    </div>


                </div>



                {{-- ================================================= --}}
                {{-- PASSWORD --}}
                {{-- ================================================= --}}

                <div class="hmauth-field">


                    <label
                        for="password"
                        class="hmauth-label"
                    >
                        Password
                    </label>


                    <div class="hmauth-input-wrap">


                        <span class="hmauth-input-icon">

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
                            placeholder="Masukkan password"
                            autocomplete="current-password"
                            required
                        >


                        <button
                            type="button"
                            class="hmauth-password-toggle"
                            data-target="password"
                            aria-label="Tampilkan password"
                        >
                            👁
                        </button>


                    </div>


                </div>



                {{-- ================================================= --}}
                {{-- OPTIONS --}}
                {{-- ================================================= --}}

                <div class="hmauth-options">


                    <label class="hmauth-remember">

                        <input
                            type="checkbox"
                            name="remember"
                        >

                        <span>
                            Ingat saya
                        </span>

                    </label>


                    <a href="#">
                        Lupa password?
                    </a>


                </div>



                {{-- ================================================= --}}
                {{-- SUBMIT --}}
                {{-- ================================================= --}}

                <button
                    type="submit"
                    class="hmauth-submit"
                >

                    <span>
                        Masuk ke HIMDAS
                    </span>

                    <b>
                        →
                    </b>

                </button>


            </form>



            <div class="hmauth-divider">

                <span></span>

                <p>
                    atau
                </p>

                <span></span>

            </div>



            <div class="hmauth-footer">

                Belum punya akun?

                <a href="{{ route('register') }}">
                    Daftar Sekarang
                </a>

            </div>


        </main>


    </div>


</section>



<script>

    document
        .querySelectorAll('.hmauth-password-toggle')
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

                    const isPassword =
                        target.type === 'password';

                    target.type =
                        isPassword
                            ? 'text'
                            : 'password';

                    button.textContent =
                        isPassword
                            ? '🙈'
                            : '👁';

                }
            );

        });

</script>



<style>

/* =========================================================
   RESET AUTH
========================================================= */

.hmauth-body {
    margin: 0;

    min-height: 100dvh;

    overflow-x: hidden;

    color: #172033;

    background: #eef7ff;
}


.hmauth-page,
.hmauth-page * {
    box-sizing: border-box;
}


/* =========================================================
   PAGE
========================================================= */

.hmauth-page {
    min-height: 100dvh;

    padding:
        28px;

    position: relative;

    display: flex;

    align-items: center;

    justify-content: center;

    overflow: hidden;

    isolation: isolate;

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

.hmauth-background {
    position: absolute;

    inset: 0;

    z-index: 0;

    overflow: hidden;

    pointer-events: none;
}


.hmauth-grid {
    width: 700px;
    height: 700px;

    position: absolute;

    top: -170px;
    right: -130px;

    opacity: .18;

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


.hmauth-orb {
    position: absolute;

    border-radius: 50%;
}


.hmauth-orb-one {
    width: 370px;
    height: 370px;

    left: -170px;
    top: -80px;

    background:
        rgba(37, 99, 235, .08);
}


.hmauth-orb-two {
    width: 350px;
    height: 350px;

    right: -170px;
    bottom: -110px;

    background:
        rgba(6, 182, 212, .10);
}


.hmauth-orb-three {
    width: 200px;
    height: 200px;

    left: 44%;
    bottom: -120px;

    background:
        rgba(16, 185, 129, .09);
}


.hmauth-math {
    position: absolute;

    color:
        rgba(37, 99, 235, .06);

    font-family:
        Georgia,
        serif;

    user-select: none;
}


.hmauth-math-one {
    left: 5%;
    bottom: 7%;

    font-size: 150px;
}


.hmauth-math-two {
    right: 5%;
    top: 7%;

    font-size: 50px;

    font-style: italic;
}


.hmauth-math-three {
    left: 48%;
    top: 3%;

    font-size: 45px;
}


/* =========================================================
   SHELL
========================================================= */

.hmauth-shell {
    width:
        min(
            1160px,
            100%
        );

    position: relative;

    z-index: 3;

    display: grid;

    grid-template-columns:
        minmax(0, .92fr)
        minmax(460px, 1.08fr);

    border:
        1px solid
        rgba(255, 255, 255, .90);

    border-radius:
        32px;

    overflow: hidden;

    background:
        rgba(255, 255, 255, .70);

    backdrop-filter:
        blur(25px);

    box-shadow:
        0 35px 90px
        rgba(27, 76, 128, .18);
}


/* =========================================================
   LEFT SHOWCASE
========================================================= */

.hmauth-showcase {
    min-height: 720px;

    padding:
        38px;

    position: relative;

    overflow: hidden;

    color: white;

    background:
        radial-gradient(
            circle at 90% 5%,
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


.hmauth-showcase-glow {
    width: 300px;
    height: 300px;

    position: absolute;

    right: -150px;
    bottom: -130px;

    border-radius: 50%;

    background:
        rgba(52, 211, 153, .16);
}


.hmauth-brand {
    position: relative;

    z-index: 3;

    display: flex;

    align-items: center;

    gap: 12px;

    color: white;

    text-decoration: none;
}


.hmauth-brand-logo {
    width: 64px;
    height: 54px;

    display: flex;

    align-items: center;

    justify-content: center;

    border:
        1px solid
        rgba(255, 255, 255, .15);

    border-radius:
        14px;

    background:
        rgba(255, 255, 255, .10);
}


.hmauth-brand-logo img {
    width: 54px;
    height: 45px;

    object-fit: contain;
}


.hmauth-brand strong {
    display: block;

    font-size: 15px;

    font-weight: 800;
}


.hmauth-brand span {
    display: block;

    margin-top: 2px;

    color:
        rgba(220, 244, 255, .74);

    font-size: 8px;
}


.hmauth-showcase-copy {
    margin-top: 52px;

    position: relative;

    z-index: 3;
}


.hmauth-showcase-badge {
    width: fit-content;

    padding:
        7px
        10px;

    border:
        1px solid
        rgba(255, 255, 255, .13);

    border-radius:
        999px;

    background:
        rgba(255, 255, 255, .08);

    color: #bfeaff;

    font-size: 7px;

    font-weight: 800;

    letter-spacing: .8px;
}


.hmauth-showcase-badge span {
    color: #fbbf24;
}


.hmauth-showcase-copy h1 {
    margin:
        17px 0
        0;

    color: white;

    font-size:
        clamp(
            43px,
            4vw,
            58px
        );

    font-weight: 800;

    line-height: .98;

    letter-spacing: -2px;
}


.hmauth-showcase-copy h1 span {
    color: #5eead4;
}


.hmauth-showcase-copy p {
    max-width: 400px;

    margin-top: 18px;

    color:
        rgba(220, 244, 255, .82);

    font-size: 11px;

    line-height: 1.75;
}


/* =========================================================
   SET VISUAL
========================================================= */

.hmauth-set-visual {
    width: 260px;
    height: 160px;

    margin:
        30px auto
        0;

    position: relative;

    display: flex;

    align-items: center;

    justify-content: center;
}


.hmauth-set-orbit {
    width: 245px;
    height: 110px;

    position: absolute;

    border:
        1px dashed
        rgba(125, 211, 252, .34);

    border-radius: 50%;

    transform:
        rotate(-8deg);
}


.hmauth-set-circle {
    width: 108px;
    height: 108px;

    position: absolute;

    display: flex;

    align-items: center;

    justify-content: center;

    border:
        2px solid
        rgba(255, 255, 255, .46);

    border-radius: 50%;

    color: white;

    font-size: 22px;

    font-weight: 800;

    backdrop-filter:
        blur(10px);
}


.hmauth-set-circle.set-a {
    left: 32px;

    background:
        rgba(37, 99, 235, .37);
}


.hmauth-set-circle.set-b {
    right: 32px;

    background:
        rgba(16, 185, 129, .32);
}


.hmauth-set-center {
    position: relative;

    z-index: 4;

    color: white;

    font-size: 28px;

    font-weight: 700;
}


.hmauth-brace {
    position: absolute;

    top: 43px;

    color:
        rgba(255, 255, 255, .86);

    font-family:
        Georgia,
        serif;

    font-size: 52px;
}


.brace-left {
    left: -2px;
}


.brace-right {
    right: -2px;
}


/* =========================================================
   FEATURES
========================================================= */

.hmauth-feature-grid {
    margin-top: 24px;

    position: relative;

    z-index: 3;

    display: grid;

    grid-template-columns:
        repeat(
            2,
            minmax(0, 1fr)
        );

    gap: 9px;
}


.hmauth-feature {
    padding: 10px;

    display: flex;

    align-items: center;

    gap: 9px;

    border:
        1px solid
        rgba(255, 255, 255, .11);

    border-radius: 13px;

    background:
        rgba(255, 255, 255, .075);
}


.hmauth-feature-icon {
    width: 32px;
    height: 32px;

    flex-shrink: 0;

    display: flex;

    align-items: center;

    justify-content: center;

    border-radius: 9px;

    font-size: 11px;

    font-weight: 800;
}


.hmauth-feature-icon.blue {
    color: #2563eb;
    background: #eff6ff;
}


.hmauth-feature-icon.green {
    color: #059669;
    background: #ecfdf5;
}


.hmauth-feature-icon.orange {
    color: #d97706;
    background: #fffbeb;
}


.hmauth-feature-icon.purple {
    color: #7c3aed;
    background: #f5f3ff;
}


.hmauth-feature strong {
    display: block;

    color: white;

    font-size: 8px;
}


.hmauth-feature span {
    display: block;

    margin-top: 2px;

    color:
        rgba(213, 238, 249, .72);

    font-size: 6.5px;
}


/* =========================================================
   PANEL
========================================================= */

.hmauth-panel {
    min-width: 0;

    padding:
        38px
        48px
        34px;

    background:
        rgba(255, 255, 255, .89);
}


.hmauth-mobile-brand {
    display: none;
}


.hmauth-panel-top {
    display: flex;

    align-items: center;

    justify-content: space-between;
}


.hmauth-back {
    display: inline-flex;

    align-items: center;

    gap: 6px;

    color: #64748b;

    font-size: 9px;

    font-weight: 700;

    text-decoration: none;
}


.hmauth-back:hover {
    color: #2563eb;
}


.hmauth-secure {
    padding:
        5px
        8px;

    border-radius:
        999px;

    color: #059669;

    background: #ecfdf5;

    font-size: 7px;

    font-weight: 700;
}


/* =========================================================
   HEADING
========================================================= */

.hmauth-heading {
    margin-top: 28px;
}


.hmauth-heading > span {
    color: #2563eb;

    font-size: 7px;

    font-weight: 800;

    letter-spacing: 1.1px;
}


.hmauth-heading h2 {
    margin:
        7px 0
        0;

    color: #172033;

    font-size:
        clamp(
            31px,
            3vw,
            39px
        );

    font-weight: 800;

    line-height: 1.05;

    letter-spacing: -1.2px;
}


.hmauth-heading p {
    margin-top: 8px;

    color: #718196;

    font-size: 10px;

    line-height: 1.55;
}


/* =========================================================
   ERROR
========================================================= */

.hmauth-error {
    margin-top: 18px;

    padding: 11px;

    display: flex;

    align-items: center;

    gap: 9px;

    border:
        1px solid
        #fecaca;

    border-radius: 12px;

    color: #991b1b;

    background: #fff7f7;
}


.hmauth-error-icon {
    width: 30px;
    height: 30px;

    flex-shrink: 0;

    display: flex;

    align-items: center;

    justify-content: center;

    border-radius: 9px;

    color: white;

    background: #ef4444;

    font-weight: 800;
}


.hmauth-error strong {
    display: block;

    font-size: 8px;
}


.hmauth-error span {
    display: block;

    margin-top: 2px;

    font-size: 7px;
}


/* =========================================================
   FORM
========================================================= */

.hmauth-form {
    margin-top: 22px;
}


.hmauth-field + .hmauth-field {
    margin-top: 15px;
}


.hmauth-label {
    display: block;

    margin-bottom: 7px;

    color: #34455b;

    font-size: 9px;

    font-weight: 700;
}


/* =========================================================
   ROLE
========================================================= */

.hmauth-role-grid {
    display: grid;

    grid-template-columns:
        repeat(
            2,
            minmax(0, 1fr)
        );

    gap: 10px;
}


.hmauth-role-option {
    cursor: pointer;
}


.hmauth-role-option input {
    position: absolute;

    opacity: 0;

    pointer-events: none;
}


.hmauth-role-card {
    min-height: 94px;

    padding: 12px;

    position: relative;

    display: flex;

    align-items: center;

    gap: 10px;

    border:
        1px solid
        #dce7f3;

    border-radius: 15px;

    background: #fbfdff;

    transition:
        .22s ease;
}


.hmauth-role-option:hover
.hmauth-role-card {
    border-color:
        #9dc4ff;

    transform:
        translateY(-2px);
}


.hmauth-role-option input:checked
+
.hmauth-role-card {
    border-color:
        #60a5fa;

    background:
        linear-gradient(
            145deg,
            #eff6ff,
            #ecfeff
        );

    box-shadow:
        0 12px 30px
        rgba(37, 99, 235, .10);
}


.hmauth-role-icon {
    width: 48px;
    height: 48px;

    flex-shrink: 0;

    display: flex;

    align-items: center;

    justify-content: center;

    border-radius: 13px;
}


.hmauth-role-icon svg {
    width: 30px;
    height: 30px;
}


.student-icon {
    color: #2563eb;

    background:
        linear-gradient(
            145deg,
            #eff6ff,
            #dbeafe
        );
}


.lecturer-icon {
    color: #059669;

    background:
        linear-gradient(
            145deg,
            #ecfdf5,
            #d1fae5
        );
}


.hmauth-role-copy {
    min-width: 0;
}


.hmauth-role-copy strong {
    display: block;

    color: #1e293b;

    font-size: 10px;

    font-weight: 800;
}


.hmauth-role-copy span {
    display: block;

    margin-top: 3px;

    color: #8291a4;

    font-size: 7px;

    line-height: 1.35;
}


.hmauth-role-check {
    width: 20px;
    height: 20px;

    position: absolute;

    top: 8px;
    right: 8px;

    display: flex;

    align-items: center;

    justify-content: center;

    border-radius: 50%;

    color: white;

    background: #2563eb;

    font-size: 9px;

    font-weight: 800;

    opacity: 0;

    transform:
        scale(.65);

    transition:
        .2s ease;
}


.hmauth-role-option input:checked
+
.hmauth-role-card
.hmauth-role-check {
    opacity: 1;

    transform:
        scale(1);
}


/* =========================================================
   INPUT
========================================================= */

.hmauth-input-wrap {
    height: 53px;

    position: relative;

    display: flex;

    align-items: center;

    border:
        1px solid
        #d8e4f0;

    border-radius: 13px;

    background:
        #fbfdff;

    transition:
        .2s ease;
}


.hmauth-input-wrap:focus-within {
    border-color:
        #60a5fa;

    background: white;

    box-shadow:
        0 0 0 4px
        rgba(37, 99, 235, .07);
}


.hmauth-input-icon {
    width: 46px;

    display: flex;

    align-items: center;

    justify-content: center;

    color: #7890a8;
}


.hmauth-input-icon svg {
    width: 18px;
    height: 18px;
}


.hmauth-input-wrap input {
    width: 100%;
    height: 100%;

    padding:
        0
        45px
        0
        0;

    border: 0;
    outline: 0;

    color: #172033;

    background: transparent;

    font: inherit;

    font-size: 10px;
}


.hmauth-input-wrap input::placeholder {
    color: #a0adbc;
}


.hmauth-password-toggle {
    width: 40px;
    height: 40px;

    position: absolute;

    right: 6px;

    border: 0;

    border-radius: 10px;

    background: transparent;

    cursor: pointer;
}


/* =========================================================
   OPTIONS
========================================================= */

.hmauth-options {
    margin-top: 13px;

    display: flex;

    align-items: center;

    justify-content: space-between;

    gap: 10px;
}


.hmauth-remember {
    display: flex;

    align-items: center;

    gap: 6px;

    color: #718196;

    font-size: 8px;
}


.hmauth-remember input {
    accent-color: #2563eb;
}


.hmauth-options a {
    color: #2563eb;

    font-size: 8px;

    font-weight: 700;

    text-decoration: none;
}


/* =========================================================
   SUBMIT
========================================================= */

.hmauth-submit {
    width: 100%;
    min-height: 52px;

    margin-top: 18px;

    padding:
        0
        18px;

    display: flex;

    align-items: center;

    justify-content: space-between;

    border: 0;

    border-radius: 14px;

    color: white;

    background:
        linear-gradient(
            105deg,
            #2563eb,
            #06b6d4,
            #10b981
        );

    box-shadow:
        0 15px 33px
        rgba(37, 99, 235, .22);

    cursor: pointer;

    font-size: 10px;

    font-weight: 800;

    transition:
        transform .2s ease,
        box-shadow .2s ease;
}


.hmauth-submit:hover {
    transform:
        translateY(-2px);

    box-shadow:
        0 19px 38px
        rgba(37, 99, 235, .29);
}


.hmauth-submit b {
    width: 27px;
    height: 27px;

    display: flex;

    align-items: center;

    justify-content: center;

    border-radius: 50%;

    background:
        rgba(255, 255, 255, .15);

    font-size: 13px;
}


/* =========================================================
   FOOTER
========================================================= */

.hmauth-divider {
    margin:
        19px 0
        14px;

    display: flex;

    align-items: center;

    gap: 10px;
}


.hmauth-divider span {
    height: 1px;

    flex: 1;

    background: #e7eef6;
}


.hmauth-divider p {
    margin: 0;

    color: #a0adbc;

    font-size: 7px;
}


.hmauth-footer {
    color: #77889c;

    font-size: 9px;

    text-align: center;
}


.hmauth-footer a {
    color: #2563eb;

    font-weight: 800;

    text-decoration: none;
}


/* =========================================================
   TABLET
========================================================= */

@media (max-width: 900px) {

    .hmauth-page {
        padding: 20px;
    }


    .hmauth-shell {
        max-width: 620px;

        display: block;
    }


    .hmauth-showcase {
        display: none;
    }


    .hmauth-panel {
        padding:
            30px
            34px
            32px;
    }


    .hmauth-mobile-brand {
        margin-bottom: 20px;

        display: block;

        text-align: center;
    }


    .hmauth-mobile-brand img {
        width: 85px;
        height: 65px;

        object-fit: contain;
    }

}


/* =========================================================
   MOBILE
========================================================= */

@media (max-width: 560px) {

    .hmauth-page {
        padding:
            12px;
    }


    .hmauth-shell {
        border-radius:
            24px;
    }


    .hmauth-panel {
        padding:
            24px
            18px
            26px;
    }


    .hmauth-heading {
        margin-top:
            23px;
    }


    .hmauth-heading h2 {
        font-size:
            30px;
    }


    .hmauth-role-grid {
        grid-template-columns: 1fr;
    }


    .hmauth-role-card {
        min-height: 82px;
    }


    .hmauth-input-wrap {
        height: 51px;
    }


    .hmauth-options {
        align-items: flex-start;
    }

}

</style>


</body>

</html>