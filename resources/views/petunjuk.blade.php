@extends('layouts.app')


@section('title', 'Petunjuk Penggunaan - HIMDAS')


@section('content')

<section class="hguide-page">


    {{-- ===================================================== --}}
    {{-- BACKGROUND --}}
    {{-- ===================================================== --}}

    <div class="hguide-background">

        <div class="hguide-grid-pattern"></div>

        <div class="hguide-orb hguide-orb-one"></div>
        <div class="hguide-orb hguide-orb-two"></div>
        <div class="hguide-orb hguide-orb-three"></div>

        <div class="hguide-math hguide-math-left">
            ∩
        </div>

        <div class="hguide-math hguide-math-right">
            A ∩ B
        </div>

    </div>



    {{-- ===================================================== --}}
    {{-- CONTAINER --}}
    {{-- ===================================================== --}}

    <div class="hguide-container">


        {{-- ================================================= --}}
        {{-- HEADING --}}
        {{-- ================================================= --}}

        <div class="hguide-heading">


            <div class="hguide-eyebrow">

                <span>
                    ✦
                </span>

                PANDUAN PENGGUNAAN

            </div>


            <h1>

                Petunjuk Penggunaan

                <span>
                    HIMDAS
                </span>

            </h1>


            <p>

                Kenali fungsi setiap bagian pada HIMDAS agar proses
                pembelajaran dapat dilakukan dengan lebih mudah,
                nyaman, dan terarah.

            </p>


        </div>



        {{-- ================================================= --}}
        {{-- GUIDE GRID --}}
        {{-- ================================================= --}}

        <div class="hguide-grid">


            {{-- ================================================= --}}
            {{-- 01 BERANDA --}}
            {{-- ================================================= --}}

            <article class="hguide-card hguide-blue">

                <div class="hguide-card-glow"></div>


                <div class="hguide-card-header">


                    <div class="hguide-icon">
                        ⌂
                    </div>


                    <div class="hguide-step">

                        <small>
                            STEP
                        </small>

                        <strong>
                            01
                        </strong>

                    </div>


                </div>



                <div class="hguide-card-body">

                    <span class="hguide-category">
                        HALAMAN UTAMA
                    </span>


                    <h2>
                        Beranda
                    </h2>


                    <p>

                        Halaman utama HIMDAS yang berisi pengenalan
                        media pembelajaran serta akses untuk memulai
                        mempelajari materi Himpunan.

                    </p>


                    <span class="hguide-tag">
                        Halaman Utama
                    </span>

                </div>


            </article>



            {{-- ================================================= --}}
            {{-- 02 TENTANG --}}
            {{-- ================================================= --}}

            <article class="hguide-card hguide-cyan">

                <div class="hguide-card-glow"></div>


                <div class="hguide-card-header">


                    <div class="hguide-icon">
                        i
                    </div>


                    <div class="hguide-step">

                        <small>
                            STEP
                        </small>

                        <strong>
                            02
                        </strong>

                    </div>


                </div>



                <div class="hguide-card-body">

                    <span class="hguide-category">
                        INFORMASI
                    </span>


                    <h2>
                        Tentang
                    </h2>


                    <p>

                        Berisi informasi mengenai HIMDAS, tujuan
                        pengembangan media pembelajaran, dan gambaran
                        singkat fungsi media dalam pembelajaran.

                    </p>


                    <span class="hguide-tag">
                        Informasi HIMDAS
                    </span>

                </div>


            </article>



            {{-- ================================================= --}}
            {{-- 03 MATERI --}}
            {{-- ================================================= --}}

            <article class="hguide-card hguide-green">

                <div class="hguide-card-glow"></div>


                <div class="hguide-card-header">


                    <div class="hguide-icon">
                        📖
                    </div>


                    <div class="hguide-step">

                        <small>
                            STEP
                        </small>

                        <strong>
                            03
                        </strong>

                    </div>


                </div>



                <div class="hguide-card-body">

                    <span class="hguide-category">
                        PEMBELAJARAN
                    </span>


                    <h2>
                        Materi Pembelajaran
                    </h2>


                    <p>

                        Pilih materi Himpunan yang ingin dipelajari.
                        Materi disusun secara bertahap mulai dari konsep
                        dasar hingga penerapan dalam pemecahan masalah.

                    </p>


                    <span class="hguide-tag">
                        Belajar Materi
                    </span>

                </div>


            </article>



            {{-- ================================================= --}}
            {{-- 04 LOGIN --}}
            {{-- ================================================= --}}

            <article class="hguide-card hguide-orange">

                <div class="hguide-card-glow"></div>


                <div class="hguide-card-header">


                    <div class="hguide-icon">
                        →
                    </div>


                    <div class="hguide-step">

                        <small>
                            STEP
                        </small>

                        <strong>
                            04
                        </strong>

                    </div>


                </div>



                <div class="hguide-card-body">

                    <span class="hguide-category">
                        AKSES AKUN
                    </span>


                    <h2>
                        Login
                    </h2>


                    <p>

                        Masuk menggunakan akun yang telah terdaftar
                        untuk mengakses fitur pembelajaran dan menyimpan
                        perkembangan belajar selama menggunakan HIMDAS.

                    </p>


                    <span class="hguide-tag">
                        Masuk Akun
                    </span>

                </div>


            </article>



            {{-- ================================================= --}}
            {{-- 05 LOGOUT --}}
            {{-- ================================================= --}}

            <article class="hguide-card hguide-purple">

                <div class="hguide-card-glow"></div>


                <div class="hguide-card-header">


                    <div class="hguide-icon">
                        ←
                    </div>


                    <div class="hguide-step">

                        <small>
                            STEP
                        </small>

                        <strong>
                            05
                        </strong>

                    </div>


                </div>



                <div class="hguide-card-body">

                    <span class="hguide-category">
                        KEAMANAN AKUN
                    </span>


                    <h2>
                        Logout
                    </h2>


                    <p>

                        Gunakan menu Logout setelah selesai belajar
                        untuk keluar dari akun dan menjaga keamanan
                        data serta sesi pengguna.

                    </p>


                    <span class="hguide-tag">
                        Keluar Akun
                    </span>

                </div>


            </article>



            {{-- ================================================= --}}
            {{-- 06 CONTACT --}}
            {{-- ================================================= --}}

            <article class="hguide-card hguide-pink">

                <div class="hguide-card-glow"></div>


                <div class="hguide-card-header">


                    <div class="hguide-icon">
                        ☎
                    </div>


                    <div class="hguide-step">

                        <small>
                            STEP
                        </small>

                        <strong>
                            06
                        </strong>

                    </div>


                </div>



                <div class="hguide-card-body">

                    <span class="hguide-category">
                        BANTUAN
                    </span>


                    <h2>
                        Contact Person
                    </h2>


                    <p>

                        Jika mengalami kendala saat menggunakan HIMDAS,
                        hubungi contact person yang tersedia untuk
                        mendapatkan bantuan dan informasi lebih lanjut.

                    </p>


                    <span class="hguide-tag">
                        Bantuan
                    </span>

                </div>


            </article>


        </div>



        {{-- ================================================= --}}
        {{-- BOTTOM --}}
        {{-- ================================================= --}}

        <div class="hguide-bottom">


            <div class="hguide-tip">


                <div class="hguide-tip-icon">
                    💡
                </div>


                <div class="hguide-tip-content">

                    <span>
                        TIPS PENGGUNAAN
                    </span>

                    <strong>
                        Belajar secara berurutan
                    </strong>

                    <p>

                        Pelajari materi secara berurutan agar setiap
                        konsep Himpunan dapat dipahami dengan lebih mudah.

                    </p>

                </div>


            </div>



            <div class="hguide-progress">


                <div class="hguide-progress-item">

                    <span>
                        01
                    </span>

                    <strong>
                        Kenali
                    </strong>

                </div>


                <div class="hguide-progress-line"></div>


                <div class="hguide-progress-item">

                    <span>
                        02
                    </span>

                    <strong>
                        Pelajari
                    </strong>

                </div>


                <div class="hguide-progress-line"></div>


                <div class="hguide-progress-item">

                    <span>
                        03
                    </span>

                    <strong>
                        Kuasai
                    </strong>

                </div>


            </div>



            <a
                href="{{ route('home') }}"
                class="hguide-back"
            >

                <span>
                    Kembali ke Beranda
                </span>

                <b>
                    →
                </b>

            </a>


        </div>


    </div>


</section>

@endsection



@push('styles')

<style>

/* =========================================================
   PETUNJUK HIMDAS
   SEMUA CLASS DIBUAT KHUSUS AGAR TIDAK BENTROK APP.CSS
========================================================= */

.hguide-page,
.hguide-page * {
    box-sizing: border-box;
}


.hguide-page {
    width: 100%;

    min-height:
        calc(
            100dvh - 88px
        );

    position: relative;

    overflow-x: hidden;

    background:
        radial-gradient(
            circle at 4% 7%,
            rgba(37, 99, 235, .11),
            transparent 29%
        ),
        radial-gradient(
            circle at 96% 18%,
            rgba(34, 211, 238, .16),
            transparent 30%
        ),
        radial-gradient(
            circle at 76% 100%,
            rgba(16, 185, 129, .10),
            transparent 28%
        ),
        linear-gradient(
            135deg,
            #fbfdff 0%,
            #f1f7ff 47%,
            #e9f9ff 100%
        );

    isolation: isolate;
}


/* =========================================================
   BACKGROUND
========================================================= */

.hguide-background {
    position: absolute;

    inset: 0;

    z-index: 0;

    overflow: hidden;

    pointer-events: none;
}


.hguide-grid-pattern {
    width: 650px;
    height: 650px;

    position: absolute;

    right: -100px;
    top: -120px;

    opacity: .14;

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

    mask-image:
        radial-gradient(
            circle,
            #000,
            transparent 70%
        );
}


.hguide-orb {
    position: absolute;

    border-radius: 50%;
}


.hguide-orb-one {
    width: 330px;
    height: 330px;

    left: -180px;
    top: 70px;

    background:
        rgba(37, 99, 235, .07);
}


.hguide-orb-two {
    width: 330px;
    height: 330px;

    right: -160px;
    top: 260px;

    background:
        rgba(6, 182, 212, .08);
}


.hguide-orb-three {
    width: 200px;
    height: 200px;

    left: 43%;
    bottom: -120px;

    background:
        rgba(16, 185, 129, .08);
}


.hguide-math {
    position: absolute;

    color:
        rgba(37, 99, 235, .045);

    font-family:
        Georgia,
        serif;

    user-select: none;
}


.hguide-math-left {
    left: 3%;
    bottom: 3%;

    font-size: 135px;
}


.hguide-math-right {
    right: 3%;
    top: 20%;

    font-size: 50px;

    font-style: italic;
}


/* =========================================================
   CONTAINER
========================================================= */

.hguide-container {
    width:
        min(
            1240px,
            calc(100% - 56px)
        );

    min-height:
        calc(
            100dvh - 88px
        );

    margin:
        0 auto;

    padding:
        clamp(
            20px,
            3.2vh,
            34px
        )
        0
        clamp(
            24px,
            3vh,
            38px
        );

    position: relative;

    z-index: 3;
}


/* =========================================================
   HEADING
========================================================= */

.hguide-heading {
    max-width: 850px;

    margin:
        0 auto
        clamp(
            16px,
            2.3vh,
            24px
        );

    text-align: center;
}


.hguide-eyebrow {
    display: inline-flex;

    align-items: center;

    gap: 7px;

    padding:
        7px
        13px;

    border:
        1px solid
        rgba(37, 99, 235, .11);

    border-radius: 999px;

    color:
        #2563eb;

    background:
        rgba(255, 255, 255, .82);

    backdrop-filter:
        blur(16px);

    box-shadow:
        0 9px 24px
        rgba(37, 99, 235, .06);

    font-size:
        8px;

    font-weight:
        800;

    letter-spacing:
        .8px;
}


.hguide-eyebrow span {
    color:
        #f59e0b;
}


.hguide-heading h1 {
    margin:
        11px 0
        0;

    color:
        #0f172a;

    font-size:
        clamp(
            36px,
            3.35vw,
            50px
        );

    font-weight:
        800;

    line-height:
        1;

    letter-spacing:
        -1.8px;
}


.hguide-heading h1 span {
    background:
        linear-gradient(
            90deg,
            #2563eb,
            #06b6d4,
            #10b981
        );

    -webkit-background-clip:
        text;

    background-clip:
        text;

    -webkit-text-fill-color:
        transparent;
}


.hguide-heading p {
    max-width: 680px;

    margin:
        9px auto
        0;

    color:
        #64748b;

    font-size:
        clamp(
            9px,
            .72vw,
            11px
        );

    line-height:
        1.6;
}


/* =========================================================
   GRID
========================================================= */

.hguide-grid {
    width: 100%;

    display: grid;

    grid-template-columns:
        repeat(
            3,
            minmax(0, 1fr)
        );

    gap:
        clamp(
            10px,
            1vw,
            15px
        );
}


/* =========================================================
   CARD
========================================================= */

.hguide-card {
    --guide-color:
        #2563eb;

    --guide-soft:
        #eff6ff;

    min-width: 0;

    min-height:
        clamp(
            180px,
            21vh,
            208px
        );

    padding:
        clamp(
            14px,
            1.2vw,
            18px
        );

    position: relative;

    overflow: hidden;

    border:
        1px solid
        rgba(255, 255, 255, .96);

    border-radius:
        21px;

    background:
        linear-gradient(
            145deg,
            rgba(255, 255, 255, .97),
            rgba(248, 251, 255, .89)
        );

    backdrop-filter:
        blur(18px);

    box-shadow:
        0 15px 36px
        rgba(30, 72, 120, .09);

    transition:
        transform .25s ease,
        box-shadow .25s ease,
        border-color .25s ease;
}


.hguide-card::before {
    content: "";

    width: 100%;
    height: 4px;

    position: absolute;

    top: 0;
    left: 0;

    background:
        var(--guide-color);
}


.hguide-card:hover {
    transform:
        translateY(-5px);

    border-color:
        color-mix(
            in srgb,
            var(--guide-color) 18%,
            white
        );

    box-shadow:
        0 22px 48px
        rgba(30, 72, 120, .14);
}


.hguide-card-glow {
    width: 150px;
    height: 150px;

    position: absolute;

    right: -70px;
    bottom: -80px;

    border-radius: 50%;

    background:
        var(--guide-color);

    opacity:
        .05;

    pointer-events: none;
}


/* =========================================================
   CARD COLORS
========================================================= */

.hguide-blue {
    --guide-color:
        #2563eb;

    --guide-soft:
        #eff6ff;
}


.hguide-cyan {
    --guide-color:
        #06b6d4;

    --guide-soft:
        #ecfeff;
}


.hguide-green {
    --guide-color:
        #10b981;

    --guide-soft:
        #ecfdf5;
}


.hguide-orange {
    --guide-color:
        #f59e0b;

    --guide-soft:
        #fffbeb;
}


.hguide-purple {
    --guide-color:
        #8b5cf6;

    --guide-soft:
        #f5f3ff;
}


.hguide-pink {
    --guide-color:
        #ec4899;

    --guide-soft:
        #fdf2f8;
}


/* =========================================================
   HEADER CARD
========================================================= */

.hguide-card-header {
    position: relative;

    z-index: 2;

    display: flex;

    align-items: flex-start;

    justify-content: space-between;

    gap: 10px;
}


.hguide-icon {
    width:
        clamp(
            39px,
            3vw,
            46px
        );

    height:
        clamp(
            39px,
            3vw,
            46px
        );

    flex-shrink: 0;

    display: flex;

    align-items: center;

    justify-content: center;

    border:
        1px solid
        rgba(255, 255, 255, .88);

    border-radius:
        13px;

    color:
        var(--guide-color);

    background:
        var(--guide-soft);

    box-shadow:
        inset
        0 1px 0
        rgba(255, 255, 255, .95);

    font-size:
        clamp(
            14px,
            1.15vw,
            17px
        );

    font-weight:
        800;
}


.hguide-step {
    text-align:
        right;
}


.hguide-step small {
    display: block;

    color:
        #9eafc1;

    font-size:
        7px;

    font-weight:
        800;

    letter-spacing:
        .75px;
}


.hguide-step strong {
    display: block;

    margin-top:
        1px;

    color:
        var(--guide-color);

    font-size:
        clamp(
            18px,
            1.45vw,
            22px
        );

    font-weight:
        800;

    line-height:
        1;
}


/* =========================================================
   BODY CARD
========================================================= */

.hguide-card-body {
    margin-top:
        clamp(
            10px,
            1.5vh,
            14px
        );

    position: relative;

    z-index: 2;
}


.hguide-category {
    display: block;

    color:
        var(--guide-color);

    font-size:
        7px;

    font-weight:
        800;

    letter-spacing:
        .75px;
}


.hguide-card-body h2 {
    margin:
        4px 0
        0;

    color:
        #17253d;

    font-size:
        clamp(
            15px,
            1.2vw,
            18px
        );

    font-weight:
        800;

    line-height:
        1.25;

    letter-spacing:
        -.3px;
}


.hguide-card-body p {
    margin-top:
        7px;

    color:
        #64748b;

    font-size:
        clamp(
            9px,
            .78vw,
            11px
        );

    line-height:
        1.55;
}


.hguide-tag {
    width:
        fit-content;

    margin-top:
        clamp(
            8px,
            1.1vh,
            12px
        );

    padding:
        5px
        9px;

    display: inline-flex;

    align-items: center;

    border-radius:
        999px;

    color:
        var(--guide-color);

    background:
        var(--guide-soft);

    font-size:
        clamp(
            7px,
            .55vw,
            8px
        );

    font-weight:
        700;
}


/* =========================================================
   BOTTOM PANEL
========================================================= */

.hguide-bottom {
    margin-top:
        clamp(
            10px,
            1.7vh,
            16px
        );

    padding:
        11px
        14px;

    display: grid;

    grid-template-columns:
        minmax(0, 1fr)
        auto
        auto;

    align-items: center;

    gap: 17px;

    border:
        1px solid
        rgba(255, 255, 255, .96);

    border-radius:
        19px;

    background:
        rgba(255, 255, 255, .80);

    backdrop-filter:
        blur(18px);

    box-shadow:
        0 14px 34px
        rgba(30, 72, 120, .08);
}


/* =========================================================
   TIP
========================================================= */

.hguide-tip {
    min-width: 0;

    display: flex;

    align-items: center;

    gap: 10px;
}


.hguide-tip-icon {
    width: 40px;
    height: 40px;

    flex-shrink: 0;

    display: flex;

    align-items: center;
    justify-content: center;

    border-radius:
        11px;

    background:
        linear-gradient(
            145deg,
            #fffbea,
            #fff2b9
        );

    font-size:
        16px;
}


.hguide-tip-content span {
    display: block;

    color:
        #f59e0b;

    font-size:
        6px;

    font-weight:
        800;

    letter-spacing:
        .7px;
}


.hguide-tip-content strong {
    display: block;

    margin-top:
        2px;

    color:
        #21364d;

    font-size:
        9px;

    font-weight:
        800;
}


.hguide-tip-content p {
    margin-top:
        2px;

    color:
        #738498;

    font-size:
        7px;

    line-height:
        1.4;
}


/* =========================================================
   PROGRESS
========================================================= */

.hguide-progress {
    display: flex;

    align-items: center;

    gap:
        7px;
}


.hguide-progress-item {
    min-width:
        52px;

    text-align:
        center;
}


.hguide-progress-item span {
    width: 25px;
    height: 25px;

    margin:
        0 auto;

    display: flex;

    align-items: center;
    justify-content: center;

    border-radius: 50%;

    color:
        #2563eb;

    background:
        #eff6ff;

    font-size:
        6px;

    font-weight:
        800;
}


.hguide-progress-item strong {
    display: block;

    margin-top:
        3px;

    color:
        #52677e;

    font-size:
        6px;
}


.hguide-progress-line {
    width: 22px;
    height: 1px;

    background:
        linear-gradient(
            90deg,
            #60a5fa,
            #22d3ee
        );
}


/* =========================================================
   BACK BUTTON
========================================================= */

.hguide-back {
    min-height:
        39px;

    padding:
        0
        14px;

    display: inline-flex;

    align-items: center;
    justify-content: center;

    gap: 9px;

    border-radius:
        11px;

    color:
        #ffffff;

    background:
        linear-gradient(
            105deg,
            #2563eb,
            #06b6d4,
            #10b981
        );

    box-shadow:
        0 10px 24px
        rgba(37, 99, 235, .20);

    font-size:
        8px;

    font-weight:
        800;

    text-decoration:
        none;

    transition:
        .2s ease;
}


.hguide-back:hover {
    transform:
        translateY(-2px);

    box-shadow:
        0 15px 30px
        rgba(37, 99, 235, .26);
}


.hguide-back b {
    font-size:
        12px;
}


/* =========================================================
   DESKTOP LAPTOP
========================================================= */

@media (max-width: 1300px) {

    .hguide-container {
        width:
            calc(
                100% - 46px
            );
    }


    .hguide-heading h1 {
        font-size:
            clamp(
                34px,
                3.4vw,
                45px
            );
    }


    .hguide-card {
        min-height:
            180px;
    }

}


/* =========================================================
   LAPTOP DENGAN TINGGI LEBIH PENDEK
   TULISAN TIDAK DIPERKECIL EKSTREM
========================================================= */

@media (min-width: 981px) and (max-height: 820px) {

    .hguide-container {
        padding:
            14px 0
            18px;
    }


    .hguide-heading {
        margin-bottom:
            11px;
    }


    .hguide-eyebrow {
        padding:
            5px
            10px;

        font-size:
            7px;
    }


    .hguide-heading h1 {
        margin-top:
            7px;

        font-size:
            35px;
    }


    .hguide-heading p {
        margin-top:
            5px;

        font-size:
            9px;
    }


    .hguide-grid {
        gap:
            9px;
    }


    .hguide-card {
        min-height:
            162px;

        padding:
            12px;
    }


    .hguide-icon {
        width:
            36px;

        height:
            36px;

        font-size:
            14px;
    }


    .hguide-step small {
        font-size:
            6px;
    }


    .hguide-step strong {
        font-size:
            17px;
    }


    .hguide-card-body {
        margin-top:
            8px;
    }


    .hguide-category {
        font-size:
            6px;
    }


    .hguide-card-body h2 {
        font-size:
            14px;
    }


    .hguide-card-body p {
        margin-top:
            5px;

        font-size:
            8px;

        line-height:
            1.4;
    }


    .hguide-tag {
        margin-top:
            6px;

        padding:
            4px
            7px;

        font-size:
            6.5px;
    }


    .hguide-bottom {
        margin-top:
            8px;

        padding:
            8px
            10px;
    }


    .hguide-tip-icon {
        width:
            32px;

        height:
            32px;

        font-size:
            13px;
    }


    .hguide-tip-content strong {
        font-size:
            8px;
    }


    .hguide-tip-content p {
        font-size:
            6px;
    }

}


/* =========================================================
   TABLET
========================================================= */

@media (max-width: 980px) {

    .hguide-page {
        min-height:
            calc(
                100dvh - 76px
            );
    }


    .hguide-container {
        width:
            calc(
                100% - 36px
            );

        min-height:
            auto;

        padding:
            28px 0
            40px;
    }


    .hguide-heading {
        margin-bottom:
            20px;
    }


    .hguide-heading h1 {
        font-size:
            38px;
    }


    .hguide-heading p {
        max-width:
            620px;

        font-size:
            10px;
    }


    .hguide-grid {
        grid-template-columns:
            repeat(
                2,
                minmax(0, 1fr)
            );

        gap:
            12px;
    }


    .hguide-card {
        min-height:
            205px;

        padding:
            17px;
    }


    .hguide-card-body h2 {
        font-size:
            17px;
    }


    .hguide-card-body p {
        font-size:
            10px;
    }


    .hguide-bottom {
        grid-template-columns:
            minmax(0, 1fr)
            auto;
    }


    .hguide-progress {
        display:
            none;
    }

}


/* =========================================================
   SMALL TABLET
========================================================= */

@media (max-width: 720px) {

    .hguide-container {
        width:
            calc(
                100% - 28px
            );
    }


    .hguide-heading h1 {
        font-size:
            34px;
    }


    .hguide-bottom {
        grid-template-columns:
            1fr;

        align-items:
            stretch;
    }


    .hguide-back {
        width:
            100%;

        min-height:
            43px;

        font-size:
            9px;
    }

}


/* =========================================================
   MOBILE
========================================================= */

@media (max-width: 580px) {

    .hguide-container {
        width:
            calc(
                100% - 22px
            );

        padding:
            24px 0
            34px;
    }


    .hguide-heading {
        margin-bottom:
            18px;
    }


    .hguide-eyebrow {
        font-size:
            7px;
    }


    .hguide-heading h1 {
        font-size:
            30px;

        line-height:
            1.08;
    }


    .hguide-heading p {
        font-size:
            9px;
    }


    .hguide-grid {
        grid-template-columns:
            1fr;

        gap:
            12px;
    }


    .hguide-card {
        min-height:
            auto;

        padding:
            17px;
    }


    .hguide-icon {
        width:
            44px;

        height:
            44px;

        font-size:
            16px;
    }


    .hguide-step strong {
        font-size:
            20px;
    }


    .hguide-category {
        font-size:
            7px;
    }


    .hguide-card-body h2 {
        font-size:
            17px;
    }


    .hguide-card-body p {
        font-size:
            10px;

        line-height:
            1.6;
    }


    .hguide-tag {
        font-size:
            7px;
    }


    .hguide-tip-content strong {
        font-size:
            10px;
    }


    .hguide-tip-content p {
        font-size:
            8px;
    }

}


/* =========================================================
   SMALL MOBILE
========================================================= */

@media (max-width: 390px) {

    .hguide-heading h1 {
        font-size:
            27px;
    }


    .hguide-card {
        padding:
            15px;
    }


    .hguide-card-body h2 {
        font-size:
            16px;
    }


    .hguide-card-body p {
        font-size:
            9.5px;
    }

}

</style>

@endpush