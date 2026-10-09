@extends('layouts.app')

@section('title', 'Tentang HIMDAS')

@section('content')

<section
    class="about-modern-page"
    id="aboutModernSlider"
>

    {{-- ===================================================== --}}
    {{-- BACKGROUND --}}
    {{-- ===================================================== --}}

    <div class="about-modern-background">
        <div class="about-modern-grid"></div>
        <div class="about-modern-orb orb-one"></div>
        <div class="about-modern-orb orb-two"></div>
        <div class="about-modern-orb orb-three"></div>
    </div>


    {{-- ===================================================== --}}
    {{-- SLIDER --}}
    {{-- ===================================================== --}}

    <div
        class="about-modern-track"
        id="aboutModernTrack"
    >

        {{-- ================================================= --}}
        {{-- SLIDE 1 --}}
        {{-- ================================================= --}}

        <section class="about-modern-slide">

            <div class="about-modern-container">

                {{-- ================================================= --}}
                {{-- LEFT --}}
                {{-- ================================================= --}}

                <div class="about-modern-left">

                    <div class="about-modern-heading">

                        <div class="about-modern-badge">
                            <span>✦</span>
                            HALAMAN TENTANG
                        </div>

                        <h1>
                            Tentang
                            <span>HIMDAS</span>
                        </h1>

                        <p>
                            HIMDAS merupakan media pembelajaran interaktif
                            pada mata kuliah Matematika Dasar yang dikembangkan
                            untuk membantu mahasiswa memahami materi Himpunan
                            dengan cara yang lebih menarik, terarah, dan mudah
                            dipahami.
                        </p>

                    </div>


                    {{-- ================================================= --}}
                    {{-- INFO --}}
                    {{-- ================================================= --}}

                    <div class="about-modern-info-grid">

                        {{-- INFORMASI MAHASISWA --}}

                        <div class="about-modern-card">

                            <div class="about-modern-card-header">

                                <div class="about-modern-card-title">

                                    <div class="about-modern-card-icon blue">
                                        🎓
                                    </div>

                                    <div>
                                        <span>PROFIL PENGEMBANG</span>
                                        <h3>Informasi Mahasiswa</h3>
                                    </div>

                                </div>

                                <span class="about-modern-chip">
                                    Developer
                                </span>

                            </div>


                            <div class="about-modern-data-list">

                                <div class="about-modern-data-row">
                                    <span>Nama Mahasiswa</span>
                                    <strong>[Nama Lengkap]</strong>
                                </div>

                                <div class="about-modern-data-row">
                                    <span>NIM</span>
                                    <strong>[Nomor Induk Mahasiswa]</strong>
                                </div>

                                <div class="about-modern-data-row">
                                    <span>Program Studi</span>
                                    <strong>Pendidikan Ilmu Komputer</strong>
                                </div>

                                <div class="about-modern-data-row">
                                    <span>Fakultas</span>
                                    <strong>[Nama Fakultas]</strong>
                                </div>

                                <div class="about-modern-data-row">
                                    <span>Universitas</span>
                                    <strong>[Nama Universitas]</strong>
                                </div>

                                <div class="about-modern-data-row">
                                    <span>Dosen Pembimbing</span>
                                    <strong>[Nama Dosen]</strong>
                                </div>

                            </div>


                            <div class="about-modern-project">

                                <span>
                                    JUDUL PENGEMBANGAN
                                </span>

                                <strong>
                                    Pengembangan Media Pembelajaran Interaktif
                                    pada Mata Kuliah Matematika Dasar dalam
                                    Materi Himpunan Menggunakan Pendekatan
                                    Gamifikasi
                                </strong>

                            </div>

                        </div>


                        {{-- INFORMASI MEDIA --}}

                        <div class="about-modern-card">

                            <div class="about-modern-card-header">

                                <div class="about-modern-card-title">

                                    <div class="about-modern-card-icon cyan">
                                        📘
                                    </div>

                                    <div>
                                        <span>INFORMASI PEMBELAJARAN</span>
                                        <h3>Informasi Media</h3>
                                    </div>

                                </div>

                                <span class="about-modern-chip cyan">
                                    HIMDAS
                                </span>

                            </div>


                            <div class="about-modern-data-list">

                                <div class="about-modern-data-row">
                                    <span>Nama Media</span>
                                    <strong>HIMDAS</strong>
                                </div>

                                <div class="about-modern-data-row">
                                    <span>Mata Kuliah</span>
                                    <strong>Matematika Dasar</strong>
                                </div>

                                <div class="about-modern-data-row">
                                    <span>Materi Utama</span>
                                    <strong>Himpunan</strong>
                                </div>

                                <div class="about-modern-data-row">
                                    <span>Pendekatan</span>
                                    <strong>Gamifikasi</strong>
                                </div>

                                <div class="about-modern-data-row">
                                    <span>Target Pengguna</span>
                                    <strong>Mahasiswa</strong>
                                </div>

                                <div class="about-modern-data-row">
                                    <span>Jenis Media</span>
                                    <strong>Media Pembelajaran Berbasis Web</strong>
                                </div>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- ================================================= --}}
                {{-- RIGHT --}}
                {{-- ================================================= --}}

                <div class="about-modern-visual">

                    <div class="about-modern-showcase">

                        <div class="showcase-light light-one"></div>
                        <div class="showcase-light light-two"></div>


                        <div class="about-showcase-top">

                            <span>
                                MEDIA PEMBELAJARAN
                            </span>

                            <strong>
                                HIMDAS
                            </strong>

                        </div>


                        {{-- LOGO --}}

                        <div class="about-showcase-logo-area">

                            <div class="about-logo-orbit orbit-a"></div>
                            <div class="about-logo-orbit orbit-b"></div>

                            <div class="about-showcase-logo">

                                <img
                                    src="{{ asset('images/logo-himdas-new.png') }}"
                                    alt="Logo HIMDAS"
                                >

                            </div>

                        </div>


                        {{-- CONTENT --}}

                        <div class="about-showcase-content">

                            <span>
                                HIMPUNAN MATEMATIKA DASAR
                            </span>

                            <h2>
                                Belajar Himpunan
                                <br>
                                Lebih Menarik
                            </h2>

                            <p>
                                HIMDAS dirancang sebagai media pembelajaran
                                berbasis web untuk memberikan pengalaman
                                belajar materi Himpunan yang lebih modern,
                                interaktif, dan mudah digunakan oleh mahasiswa.
                            </p>

                        </div>


                        {{-- FEATURES --}}

                        <div class="about-showcase-features">

                            <div class="about-feature-item">

                                <div class="about-feature-icon blue">
                                    ✦
                                </div>

                                <div>
                                    <strong>Interaktif</strong>

                                    <span>
                                        Materi disajikan melalui tampilan
                                        yang menarik sehingga proses belajar
                                        tidak terasa monoton.
                                    </span>
                                </div>

                            </div>


                            <div class="about-feature-item">

                                <div class="about-feature-icon green">
                                    ✓
                                </div>

                                <div>
                                    <strong>Mudah Dipahami</strong>

                                    <span>
                                        Materi disusun secara bertahap
                                        mulai dari konsep dasar hingga
                                        penerapan Himpunan.
                                    </span>
                                </div>

                            </div>


                            <div class="about-feature-item">

                                <div class="about-feature-icon orange">
                                    ★
                                </div>

                                <div>
                                    <strong>Pendekatan Gamifikasi</strong>

                                    <span>
                                        Elemen gamifikasi digunakan untuk
                                        membuat kegiatan belajar lebih
                                        menarik dan meningkatkan keterlibatan
                                        mahasiswa.
                                    </span>
                                </div>

                            </div>


                            <div class="about-feature-item">

                                <div class="about-feature-icon purple">
                                    ◇
                                </div>

                                <div>
                                    <strong>Fleksibel</strong>

                                    <span>
                                        Media dapat digunakan melalui
                                        perangkat komputer maupun perangkat
                                        mobile yang mendukung browser.
                                    </span>
                                </div>

                            </div>

                        </div>


                        {{-- FOOTER INFO --}}

                        <div class="about-showcase-footer">

                            <div>
                                <span>MATERI</span>
                                <strong>Himpunan</strong>
                                <p>Matematika Dasar</p>
                            </div>

                            <div>
                                <span>PENGGUNA</span>
                                <strong>Mahasiswa</strong>
                                <p>Media Pembelajaran</p>
                            </div>

                        </div>


                        <div class="about-showcase-message">

                            <span>✦</span>

                            <p>
                                Memahami matematika menjadi lebih mudah
                                ketika proses belajar dibuat lebih menarik.
                            </p>

                        </div>

                    </div>

                </div>

            </div>

        </section>



        {{-- ================================================= --}}
        {{-- SLIDE 2 --}}
        {{-- ================================================= --}}

        <section class="about-modern-slide">

            <div class="about-learning-container">

                {{-- HEADING --}}

                <div class="about-learning-heading">

                    <div class="about-modern-badge">
                        <span>✦</span>
                        PEMBELAJARAN HIMDAS
                    </div>

                    <h2>
                        Capaian &
                        <span>Sasaran Pembelajaran</span>
                    </h2>

                    <p>
                        Setelah mempelajari materi Himpunan melalui
                        media HIMDAS, mahasiswa diharapkan mampu
                        menguasai konsep dasar hingga penerapan
                        himpunan dalam penyelesaian masalah.
                    </p>

                </div>


                {{-- ================================================= --}}
                {{-- CONTENT --}}
                {{-- ================================================= --}}

                <div class="about-learning-grid">


                    {{-- ================================================= --}}
                    {{-- CAPAIAN --}}
                    {{-- ================================================= --}}

                    <div class="learning-outcome-panel">

                        <div class="learning-panel-header">

                            <div>

                                <span>
                                    CAPAIAN PEMBELAJARAN
                                </span>

                                <h3>
                                    Setelah Belajar dengan HIMDAS
                                </h3>

                            </div>

                            <div class="learning-panel-icon">
                                🎯
                            </div>

                        </div>


                        <p class="learning-panel-intro">
                            Setelah mempelajari materi Himpunan melalui
                            media HIMDAS, mahasiswa diharapkan mampu:
                        </p>


                        <div class="learning-outcome-list">

                            {{-- 01 --}}

                            <div class="learning-outcome-item">

                                <span class="outcome-number">
                                    01
                                </span>

                                <div>

                                    <strong>
                                        Memahami Konsep Himpunan
                                    </strong>

                                    <p>
                                        Menjelaskan pengertian himpunan dan
                                        membedakan kumpulan yang merupakan
                                        himpunan dan bukan himpunan.
                                    </p>

                                </div>

                            </div>


                            {{-- 02 --}}

                            <div class="learning-outcome-item">

                                <span class="outcome-number">
                                    02
                                </span>

                                <div>

                                    <strong>
                                        Keanggotaan & Kardinalitas
                                    </strong>

                                    <p>
                                        Menentukan keanggotaan suatu himpunan
                                        dan menghitung bilangan kardinalnya.
                                    </p>

                                </div>

                            </div>


                            {{-- 03 --}}

                            <div class="learning-outcome-item">

                                <span class="outcome-number">
                                    03
                                </span>

                                <div>

                                    <strong>
                                        Representasi Himpunan
                                    </strong>

                                    <p>
                                        Menyatakan himpunan dengan cara tabulasi,
                                        deskriptif/pembentuk himpunan, simbol baku,
                                        dan diagram Venn.
                                    </p>

                                </div>

                            </div>


                            {{-- 04 --}}

                            <div class="learning-outcome-item">

                                <span class="outcome-number">
                                    04
                                </span>

                                <div>

                                    <strong>
                                        Jenis & Hubungan Himpunan
                                    </strong>

                                    <p>
                                        Menjelaskan himpunan kosong, himpunan
                                        semesta, kesamaan himpunan, himpunan bagian,
                                        himpunan bagian sejati, himpunan lepas,
                                        himpunan bersilangan, himpunan ekuivalen,
                                        dan himpunan kuasa.
                                    </p>

                                </div>

                            </div>


                            {{-- 05 --}}

                            <div class="learning-outcome-item">

                                <span class="outcome-number">
                                    05
                                </span>

                                <div>

                                    <strong>
                                        Operasi Himpunan
                                    </strong>

                                    <p>
                                        Menentukan hasil operasi irisan, gabungan,
                                        komplemen, selisih, dan beda
                                        setangkup/simetris.
                                    </p>

                                </div>

                            </div>


                            {{-- 06 --}}

                            <div class="learning-outcome-item">

                                <span class="outcome-number">
                                    06
                                </span>

                                <div>

                                    <strong>
                                        Sifat Operasi Himpunan
                                    </strong>

                                    <p>
                                        Menggunakan sifat-sifat operasi himpunan
                                        untuk menyederhanakan atau memeriksa
                                        suatu pernyataan himpunan.
                                    </p>

                                </div>

                            </div>


                            {{-- 07 --}}

                            <div
                                class="
                                    learning-outcome-item
                                    final-outcome
                                "
                            >

                                <span class="outcome-number">
                                    07
                                </span>

                                <div>

                                    <strong>
                                        Penerapan Himpunan
                                    </strong>

                                    <p>
                                        Menerapkan konsep himpunan dalam
                                        penyelesaian masalah melalui diagram Venn
                                        dan aktivitas evaluasi.
                                    </p>

                                </div>

                            </div>

                        </div>

                    </div>


                    {{-- ================================================= --}}
                    {{-- SIDE --}}
                    {{-- ================================================= --}}

                    <div class="learning-side-column">


                        {{-- SASARAN --}}

                        <div class="learning-target-panel">

                            <div class="learning-target-header">

                                <div class="learning-target-icon">
                                    👨‍🎓
                                </div>

                                <div>

                                    <span>
                                        SASARAN PEMBELAJARAN
                                    </span>

                                    <h3>
                                        Pengguna HIMDAS
                                    </h3>

                                </div>

                            </div>


                            <p>
                                Modul ditujukan kepada mahasiswa Program Studi
                                Pendidikan Komputer yang menempuh Mata Kuliah
                                Matematika Dasar. Modul dapat digunakan untuk
                                belajar mandiri maupun sebagai pendamping
                                pembelajaran di kelas dan media HIMDAS.
                            </p>


                            <div class="learning-target-tags">

                                <span>
                                    🎓 Mahasiswa
                                </span>

                                <span>
                                    💻 Pendidikan Komputer
                                </span>

                                <span>
                                    📘 Matematika Dasar
                                </span>

                            </div>

                        </div>


                        {{-- MEDIA --}}

                        <div class="learning-media-panel">

                            <div class="learning-media-top">

                                <div>

                                    <span>
                                        HIMDAS
                                    </span>

                                    <h3>
                                        Pengalaman Belajar Modern
                                    </h3>

                                </div>


                                <img
                                    src="{{ asset('images/logo-himdas-new.png') }}"
                                    alt="Logo HIMDAS"
                                >

                            </div>


                            <div class="learning-media-features">

                                <div>

                                    <span class="mini-feature-icon blue">
                                        ✦
                                    </span>

                                    <strong>
                                        Interaktif
                                    </strong>

                                </div>


                                <div>

                                    <span class="mini-feature-icon green">
                                        ✓
                                    </span>

                                    <strong>
                                        Mudah Dipahami
                                    </strong>

                                </div>


                                <div>

                                    <span class="mini-feature-icon orange">
                                        ★
                                    </span>

                                    <strong>
                                        Gamifikasi
                                    </strong>

                                </div>


                                <div>

                                    <span class="mini-feature-icon purple">
                                        ◇
                                    </span>

                                    <strong>
                                        Fleksibel
                                    </strong>

                                </div>

                            </div>

                        </div>


                        {{-- MESSAGE --}}

                        <div class="learning-message-panel">

                            <span class="learning-message-icon">
                                ✦
                            </span>

                            <div>

                                <span>
                                    HIMDAS
                                </span>

                                <strong>
                                    Memahami matematika menjadi lebih mudah
                                    ketika proses belajar dibuat lebih menarik.
                                </strong>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </section>

    </div>


    {{-- ===================================================== --}}
    {{-- NAVIGATION --}}
    {{-- ===================================================== --}}

    <button
        type="button"
        class="about-modern-arrow about-modern-prev"
        onclick="previousAboutModernSlide()"
        aria-label="Slide sebelumnya"
    >
        ‹
    </button>


    <button
        type="button"
        class="about-modern-arrow about-modern-next"
        onclick="nextAboutModernSlide()"
        aria-label="Slide berikutnya"
    >
        ›
    </button>


    <div class="about-modern-dots">

        <button
            type="button"
            class="about-modern-dot active"
            onclick="goToAboutModernSlide(0)"
            aria-label="Informasi Tentang HIMDAS"
        ></button>

        <button
            type="button"
            class="about-modern-dot"
            onclick="goToAboutModernSlide(1)"
            aria-label="Capaian Pembelajaran"
        ></button>

    </div>

</section>

@endsection



@push('styles')

<style>

/* ========================================================= */
/* GLOBAL */
/* ========================================================= */

html,
body {
    max-width: 100%;
    overflow-x: hidden;
}


.about-modern-page * {
    box-sizing: border-box;
}


/* ========================================================= */
/* PAGE */
/* ========================================================= */

.about-modern-page {
    width: 100%;
    max-width: 100%;

    height:
        calc(
            100dvh - 88px
        );

    min-height: 620px;

    position: relative;

    overflow: hidden;

    isolation: isolate;

    background:
        radial-gradient(
            circle at 4% 8%,
            rgba(37, 99, 235, .09),
            transparent 27%
        ),
        radial-gradient(
            circle at 96% 20%,
            rgba(34, 211, 238, .11),
            transparent 30%
        ),
        linear-gradient(
            135deg,
            #fbfdff,
            #f1f7ff 48%,
            #e9f9ff
        );
}


/* ========================================================= */
/* BACKGROUND */
/* ========================================================= */

.about-modern-background {
    position: absolute;

    inset: 0;

    z-index: 0;

    overflow: hidden;

    pointer-events: none;
}


.about-modern-grid {
    width: 620px;
    height: 620px;

    position: absolute;

    top: -100px;
    right: -90px;

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
        40px 40px;

    mask-image:
        radial-gradient(
            circle,
            #000,
            transparent 72%
        );
}


.about-modern-orb {
    position: absolute;

    border-radius: 50%;
}


.about-modern-orb.orb-one {
    width: 330px;
    height: 330px;

    left: -170px;
    top: -80px;

    background:
        rgba(37, 99, 235, .07);
}


.about-modern-orb.orb-two {
    width: 300px;
    height: 300px;

    right: -140px;
    top: 170px;

    background:
        rgba(34, 211, 238, .10);
}


.about-modern-orb.orb-three {
    width: 220px;
    height: 220px;

    right: 30%;
    bottom: -140px;

    background:
        rgba(16, 185, 129, .07);
}


/* ========================================================= */
/* TRACK */
/* ========================================================= */

.about-modern-track {
    width: 100%;
    height: 100%;

    display: flex;

    position: relative;

    z-index: 2;

    transition:
        transform .65s
        cubic-bezier(
            .77,
            0,
            .18,
            1
        );

    will-change:
        transform;
}


.about-modern-slide {
    width: 100%;
    min-width: 100%;
    max-width: 100%;

    height: 100%;

    flex:
        0 0 100%;

    overflow-x: hidden;
    overflow-y: auto;
}


/* ========================================================= */
/* SLIDE 1 */
/* ========================================================= */

.about-modern-container {
    width:
        min(
            1180px,
            calc(100% - 76px)
        );

    min-height: 100%;

    margin:
        0 auto;

    padding:
        26px 0
        44px;

    display: grid;

    grid-template-columns:
        minmax(0, 1.08fr)
        minmax(400px, .92fr);

    align-items: center;

    gap: 36px;
}


/* ========================================================= */
/* HEADING */
/* ========================================================= */

.about-modern-left {
    min-width: 0;
}


.about-modern-heading {
    max-width: 720px;
}


.about-modern-badge {
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

    color: #2563eb;

    background:
        rgba(255, 255, 255, .80);

    backdrop-filter:
        blur(14px);

    box-shadow:
        0 9px 25px
        rgba(37, 99, 235, .06);

    font-size: 8px;

    font-weight: 800;

    letter-spacing: .75px;
}


.about-modern-badge span {
    color: #f59e0b;
}


.about-modern-heading h1 {
    margin-top: 14px;

    color: #0f172a;

    font-size:
        clamp(
            40px,
            3.7vw,
            55px
        );

    line-height: .98;

    letter-spacing: -2px;
}


.about-modern-heading h1 span {
    background:
        linear-gradient(
            90deg,
            #2563eb,
            #06b6d4,
            #10b981
        );

    -webkit-background-clip: text;
    background-clip: text;
    -webkit-text-fill-color: transparent;
}


.about-modern-heading p {
    max-width: 690px;

    margin-top: 11px;

    color: #607187;

    font-size: 10.5px;

    line-height: 1.65;
}


/* ========================================================= */
/* INFO GRID */
/* ========================================================= */

.about-modern-info-grid {
    margin-top: 18px;

    display: grid;

    grid-template-columns:
        1.12fr
        .88fr;

    gap: 14px;
}


.about-modern-card {
    min-width: 0;

    padding: 16px;

    border:
        1px solid
        rgba(255, 255, 255, .94);

    border-radius: 20px;

    background:
        rgba(255, 255, 255, .84);

    backdrop-filter:
        blur(18px);

    box-shadow:
        0 15px 38px
        rgba(30, 72, 120, .085);

    transition:
        transform .25s ease,
        box-shadow .25s ease;
}


.about-modern-card:hover {
    transform:
        translateY(-4px);

    box-shadow:
        0 21px 46px
        rgba(30, 72, 120, .13);
}


.about-modern-card-header {
    padding-bottom: 11px;

    display: flex;

    align-items: center;

    justify-content: space-between;

    gap: 10px;

    border-bottom:
        1px solid
        #e8eef5;
}


.about-modern-card-title {
    display: flex;

    align-items: center;

    gap: 9px;
}


.about-modern-card-icon {
    width: 38px;
    height: 38px;

    flex-shrink: 0;

    display: flex;

    align-items: center;
    justify-content: center;

    border-radius: 11px;

    font-size: 15px;
}


.about-modern-card-icon.blue {
    background:
        #eff6ff;
}


.about-modern-card-icon.cyan {
    background:
        #ecfeff;
}


.about-modern-card-title span {
    display: block;

    color: #2563eb;

    font-size: 7px;

    font-weight: 800;

    letter-spacing: .65px;
}


.about-modern-card-title h3 {
    margin-top: 3px;

    color: #17253d;

    font-size: 13px;

    font-weight: 800;
}


.about-modern-chip {
    padding:
        5px
        8px;

    border-radius: 999px;

    color: #2563eb;

    background: #eff6ff;

    font-size: 7px;

    font-weight: 700;
}


.about-modern-chip.cyan {
    color: #0891b2;

    background: #ecfeff;
}


/* ========================================================= */
/* DATA */
/* ========================================================= */

.about-modern-data-list {
    margin-top: 7px;
}


.about-modern-data-row {
    min-height: 30px;

    padding:
        7px
        2px;

    display: flex;

    align-items: center;

    justify-content: space-between;

    gap: 12px;

    border-bottom:
        1px solid
        #edf2f7;
}


.about-modern-data-row:last-child {
    border-bottom: 0;
}


.about-modern-data-row span {
    color: #7b8da2;

    font-size: 8px;

    line-height: 1.35;
}


.about-modern-data-row strong {
    color: #25384e;

    font-size: 8.5px;

    font-weight: 700;

    line-height: 1.35;

    text-align: right;

    overflow-wrap: anywhere;
}


.about-modern-project {
    margin-top: 9px;

    padding: 10px;

    border:
        1px solid
        rgba(37, 99, 235, .11);

    border-radius: 11px;

    background:
        linear-gradient(
            145deg,
            #f6faff,
            #edf7ff
        );
}


.about-modern-project span {
    display: block;

    color: #2563eb;

    font-size: 6.5px;

    font-weight: 800;

    letter-spacing: .65px;
}


.about-modern-project strong {
    display: block;

    margin-top: 4px;

    color: #41566d;

    font-size: 7.5px;

    line-height: 1.5;
}


/* ========================================================= */
/* SHOWCASE */
/* ========================================================= */

.about-modern-visual {
    min-width: 0;
}


.about-modern-showcase {
    width: 100%;

    max-width: 450px;

    min-height: 545px;

    margin:
        0 auto;

    padding: 20px;

    position: relative;

    overflow: hidden;

    border:
        1px solid
        rgba(255, 255, 255, .18);

    border-radius: 28px;

    background:
        radial-gradient(
            circle at 90% 3%,
            rgba(34, 211, 238, .25),
            transparent 35%
        ),
        linear-gradient(
            145deg,
            #0b234a,
            #174d8e 57%,
            #0e7490
        );

    box-shadow:
        0 28px 70px
        rgba(7, 26, 56, .23);
}


.showcase-light {
    position: absolute;

    border-radius: 50%;

    pointer-events: none;
}


.showcase-light.light-one {
    width: 230px;
    height: 230px;

    right: -120px;
    top: -100px;

    background:
        rgba(34, 211, 238, .12);
}


.showcase-light.light-two {
    width: 190px;
    height: 190px;

    left: -100px;
    bottom: -100px;

    background:
        rgba(37, 99, 235, .12);
}


.about-showcase-top {
    position: relative;

    z-index: 2;

    display: flex;

    align-items: center;

    justify-content: space-between;
}


.about-showcase-top span,
.about-showcase-top strong {
    padding:
        5px
        9px;

    border:
        1px solid
        rgba(255, 255, 255, .10);

    border-radius: 999px;

    color: #e1f7ff;

    background:
        rgba(255, 255, 255, .08);

    font-size: 7px;

    font-weight: 700;
}


/* ========================================================= */
/* LOGO */
/* ========================================================= */

.about-showcase-logo-area {
    height: 155px;

    position: relative;

    display: flex;

    align-items: center;
    justify-content: center;
}


.about-logo-orbit {
    position: absolute;

    border:
        1px solid
        rgba(125, 211, 252, .22);

    border-radius: 50%;
}


.about-logo-orbit.orbit-a {
    width: 215px;
    height: 108px;

    transform:
        rotate(-12deg);
}


.about-logo-orbit.orbit-b {
    width: 140px;
    height: 175px;

    transform:
        rotate(44deg);

    border-style: dashed;
}


.about-showcase-logo {
    width: 125px;
    height: 116px;

    position: relative;

    z-index: 3;

    display: flex;

    align-items: center;
    justify-content: center;

    border:
        1px solid
        rgba(255, 255, 255, .18);

    border-radius: 22px;

    background:
        rgba(255, 255, 255, .11);

    backdrop-filter:
        blur(14px);
}


.about-showcase-logo img {
    width: 100px;

    max-height: 98px;

    object-fit: contain;
}


/* ========================================================= */
/* SHOWCASE TEXT */
/* ========================================================= */

.about-showcase-content {
    max-width: 350px;

    margin:
        -2px auto
        0;

    position: relative;

    z-index: 3;

    text-align: center;
}


.about-showcase-content > span {
    color: #7dd3fc;

    font-size: 7px;

    font-weight: 800;

    letter-spacing: .75px;
}


.about-showcase-content h2 {
    margin-top: 6px;

    color: #ffffff;

    font-size: 24px;

    line-height: 1.08;

    letter-spacing: -.7px;
}


.about-showcase-content p {
    margin-top: 8px;

    color: #cae7f5;

    font-size: 8px;

    line-height: 1.55;
}


/* ========================================================= */
/* FEATURES */
/* ========================================================= */

.about-showcase-features {
    margin-top: 13px;

    position: relative;

    z-index: 4;

    display: grid;

    grid-template-columns:
        repeat(
            2,
            minmax(0, 1fr)
        );

    gap: 8px;
}


.about-feature-item {
    min-width: 0;

    padding:
        9px
        8px;

    display: flex;

    align-items: flex-start;

    gap: 7px;

    border:
        1px solid
        rgba(255, 255, 255, .12);

    border-radius: 12px;

    background:
        rgba(255, 255, 255, .08);

    backdrop-filter:
        blur(10px);
}


.about-feature-icon {
    width: 29px;
    height: 29px;

    flex-shrink: 0;

    display: flex;

    align-items: center;
    justify-content: center;

    border-radius: 8px;

    font-size: 10px;
}


.about-feature-icon.blue {
    color: #2563eb;

    background: #eff6ff;
}


.about-feature-icon.green {
    color: #059669;

    background: #ecfdf5;
}


.about-feature-icon.orange {
    color: #d97706;

    background: #fffbeb;
}


.about-feature-icon.purple {
    color: #7c3aed;

    background: #f5f3ff;
}


.about-feature-item strong {
    display: block;

    color: white;

    font-size: 8px;

    line-height: 1.25;
}


.about-feature-item span {
    display: block;

    margin-top: 2px;

    color: #bbd9e8;

    font-size: 6.5px;

    line-height: 1.4;
}


/* ========================================================= */
/* SHOWCASE FOOTER */
/* ========================================================= */

.about-showcase-footer {
    margin-top: 12px;

    padding: 0;

    display: grid;

    grid-template-columns:
        repeat(
            2,
            1fr
        );

    gap: 8px;

    position: relative;

    z-index: 4;
}


.about-showcase-footer > div {
    padding: 10px;

    border:
        1px solid
        rgba(255, 255, 255, .11);

    border-radius: 11px;

    background:
        rgba(255, 255, 255, .07);
}


.about-showcase-footer span {
    color: #7dd3fc;

    font-size: 6px;

    font-weight: 800;
}


.about-showcase-footer strong {
    display: block;

    margin-top: 3px;

    color: white;

    font-size: 9px;
}


.about-showcase-footer p {
    margin-top: 2px;

    color: #afd0df;

    font-size: 6.5px;
}


.about-showcase-message {
    margin-top: 10px;

    padding-top: 10px;

    position: relative;

    z-index: 4;

    display: flex;

    align-items: flex-start;

    gap: 7px;

    border-top:
        1px solid
        rgba(255, 255, 255, .11);
}


.about-showcase-message span {
    color: #7dd3fc;

    font-size: 11px;
}


.about-showcase-message p {
    color: #d5eaf4;

    font-size: 7.2px;

    line-height: 1.45;
}


/* ========================================================= */
/* SLIDE 2 */
/* ========================================================= */

.about-learning-container {
    width:
        min(
            1140px,
            calc(100% - 76px)
        );

    min-height: 100%;

    margin:
        0 auto;

    padding:
        28px 0
        44px;
}


/* ========================================================= */
/* LEARNING HEADING */
/* ========================================================= */

.about-learning-heading {
    max-width: 790px;

    margin:
        0 auto
        20px;

    text-align: center;
}


.about-learning-heading h2 {
    margin-top: 11px;

    color: #0f172a;

    font-size:
        clamp(
            35px,
            3.5vw,
            48px
        );

    line-height: 1;

    letter-spacing: -1.7px;
}


.about-learning-heading h2 span {
    background:
        linear-gradient(
            90deg,
            #2563eb,
            #06b6d4,
            #10b981
        );

    -webkit-background-clip: text;
    background-clip: text;
    -webkit-text-fill-color: transparent;
}


.about-learning-heading p {
    max-width: 660px;

    margin:
        9px auto
        0;

    color: #66798e;

    font-size: 9.5px;

    line-height: 1.55;
}


/* ========================================================= */
/* LEARNING GRID */
/* ========================================================= */

.about-learning-grid {
    display: grid;

    grid-template-columns:
        minmax(0, 1.6fr)
        minmax(330px, .8fr);

    gap: 16px;
}


/* ========================================================= */
/* PANELS */
/* ========================================================= */

.learning-outcome-panel,
.learning-target-panel,
.learning-media-panel,
.learning-message-panel {
    border:
        1px solid
        rgba(255, 255, 255, .94);

    background:
        rgba(255, 255, 255, .84);

    backdrop-filter:
        blur(17px);

    box-shadow:
        0 15px 38px
        rgba(30, 72, 120, .08);
}


.learning-outcome-panel {
    padding: 17px;

    border-radius: 20px;
}


.learning-panel-header {
    display: flex;

    align-items: center;

    justify-content: space-between;

    gap: 12px;
}


.learning-panel-header span,
.learning-target-header span,
.learning-media-top span,
.learning-message-panel > div > span {
    color: #2563eb;

    font-size: 7px;

    font-weight: 800;

    letter-spacing: .7px;
}


.learning-panel-header h3,
.learning-target-header h3,
.learning-media-top h3 {
    margin-top: 3px;

    color: #17253d;

    font-size: 13px;

    font-weight: 800;
}


.learning-panel-icon {
    width: 40px;
    height: 40px;

    flex-shrink: 0;

    display: flex;

    align-items: center;
    justify-content: center;

    border-radius: 11px;

    background: #fff7df;

    font-size: 16px;
}


.learning-panel-intro {
    margin-top: 8px;

    color: #708196;

    font-size: 8px;

    line-height: 1.5;
}


/* ========================================================= */
/* OUTCOMES */
/* ========================================================= */

.learning-outcome-list {
    margin-top: 10px;

    display: grid;

    grid-template-columns:
        repeat(
            2,
            minmax(0, 1fr)
        );

    gap: 8px;
}


.learning-outcome-item {
    min-width: 0;

    min-height: 72px;

    padding:
        10px;

    display: grid;

    grid-template-columns:
        34px
        minmax(0, 1fr);

    gap: 9px;

    align-items: flex-start;

    border:
        1px solid
        #e5edf6;

    border-radius: 12px;

    background:
        linear-gradient(
            145deg,
            #fbfdff,
            #f6faff
        );
}


.learning-outcome-item.final-outcome {
    grid-column:
        1 / -1;

    min-height: 64px;

    border-color:
        rgba(37, 99, 235, .15);

    background:
        linear-gradient(
            145deg,
            #f2f8ff,
            #ecfeff
        );
}


.outcome-number {
    width: 34px;
    height: 34px;

    display: flex;

    align-items: center;
    justify-content: center;

    border-radius: 9px;

    color: #2563eb;

    background: #eff6ff;

    font-size: 8px;

    font-weight: 800;
}


.final-outcome
.outcome-number {
    color: white;

    background:
        linear-gradient(
            135deg,
            #2563eb,
            #06b6d4,
            #10b981
        );
}


.learning-outcome-item strong {
    display: block;

    color: #30465d;

    font-size: 9.5px;

    font-weight: 800;

    line-height: 1.3;
}


.learning-outcome-item p {
    margin-top: 4px;

    color: #718298;

    font-size: 8px;

    line-height: 1.45;
}


/* ========================================================= */
/* SIDE COLUMN */
/* ========================================================= */

.learning-side-column {
    display: grid;

    align-content: start;

    gap: 12px;
}


.learning-target-panel,
.learning-media-panel {
    padding: 16px;

    border-radius: 18px;
}


/* TARGET */

.learning-target-header {
    display: flex;

    align-items: center;

    gap: 10px;
}


.learning-target-icon {
    width: 41px;
    height: 41px;

    flex-shrink: 0;

    display: flex;

    align-items: center;
    justify-content: center;

    border-radius: 11px;

    background:
        linear-gradient(
            145deg,
            #eff6ff,
            #ecfeff
        );

    font-size: 16px;
}


.learning-target-panel > p {
    margin-top: 11px;

    color: #5d7187;

    font-size: 8.5px;

    line-height: 1.55;
}


.learning-target-tags {
    margin-top: 10px;

    display: flex;

    flex-wrap: wrap;

    gap: 6px;
}


.learning-target-tags span {
    padding:
        5px
        7px;

    border:
        1px solid
        #e3ebf4;

    border-radius: 8px;

    color: #4c647c;

    background: #f8fbff;

    font-size: 7px;

    font-weight: 650;
}


/* ========================================================= */
/* MEDIA PANEL */
/* ========================================================= */

.learning-media-top {
    display: flex;

    align-items: center;

    justify-content: space-between;

    gap: 12px;
}


.learning-media-top img {
    width: 64px;
    height: 52px;

    object-fit: contain;
}


.learning-media-features {
    margin-top: 11px;

    display: grid;

    grid-template-columns:
        repeat(
            2,
            minmax(0, 1fr)
        );

    gap: 7px;
}


.learning-media-features > div {
    min-height: 46px;

    padding:
        8px;

    display: flex;

    align-items: center;

    gap: 7px;

    border:
        1px solid
        #e9eff6;

    border-radius: 10px;

    background: #fafcff;
}


.mini-feature-icon {
    width: 27px;
    height: 27px;

    display: flex;

    align-items: center;
    justify-content: center;

    flex-shrink: 0;

    border-radius: 7px;

    font-size: 9px;
}


.mini-feature-icon.blue {
    color: #2563eb;

    background: #eff6ff;
}


.mini-feature-icon.green {
    color: #059669;

    background: #ecfdf5;
}


.mini-feature-icon.orange {
    color: #d97706;

    background: #fffbeb;
}


.mini-feature-icon.purple {
    color: #7c3aed;

    background: #f5f3ff;
}


.learning-media-features strong {
    color: #4d6279;

    font-size: 8px;

    line-height: 1.3;
}


/* ========================================================= */
/* MESSAGE */
/* ========================================================= */

.learning-message-panel {
    padding: 12px;

    display: flex;

    align-items: center;

    gap: 10px;

    border-radius: 15px;

    background:
        linear-gradient(
            145deg,
            #eff6ff,
            #ecfeff
        );
}


.learning-message-icon {
    width: 36px;
    height: 36px;

    flex-shrink: 0;

    display: flex;

    align-items: center;
    justify-content: center;

    border-radius: 10px;

    color: white;

    background:
        linear-gradient(
            135deg,
            #2563eb,
            #06b6d4
        );

    font-size: 14px;
}


.learning-message-panel strong {
    display: block;

    margin-top: 3px;

    color: #364c64;

    font-size: 8px;

    line-height: 1.45;
}


/* ========================================================= */
/* NAVIGATION */
/* ========================================================= */

.about-modern-arrow {
    width: 40px;
    height: 40px;

    position: absolute;

    z-index: 30;

    top: 50%;

    transform:
        translateY(-50%);

    display: flex;

    align-items: center;
    justify-content: center;

    border:
        1px solid
        rgba(255, 255, 255, .94);

    border-radius: 50%;

    color: #2563eb;

    background:
        rgba(255, 255, 255, .91);

    backdrop-filter:
        blur(15px);

    box-shadow:
        0 9px 24px
        rgba(30, 72, 120, .13);

    font-size: 21px;

    cursor: pointer;

    transition:
        .22s ease;
}


.about-modern-arrow:hover {
    color: white;

    background:
        linear-gradient(
            135deg,
            #2563eb,
            #06b6d4
        );

    transform:
        translateY(-50%)
        scale(1.06);
}


.about-modern-prev {
    left: 13px;
}


.about-modern-next {
    right: 13px;
}


.about-modern-dots {
    position: absolute;

    z-index: 31;

    left: 50%;
    bottom: 12px;

    transform:
        translateX(-50%);

    display: flex;

    gap: 6px;
}


.about-modern-dot {
    width: 7px;
    height: 7px;

    padding: 0;

    border: 0;

    border-radius: 999px;

    background: #bac9d8;

    cursor: pointer;

    transition:
        .25s ease;
}


.about-modern-dot.active {
    width: 28px;

    background:
        linear-gradient(
            90deg,
            #2563eb,
            #06b6d4,
            #10b981
        );
}


/* ========================================================= */
/* NORMAL LAPTOP */
/* ========================================================= */

@media (max-width: 1280px) {

    .about-modern-container {
        width:
            calc(100% - 70px);

        grid-template-columns:
            minmax(0, 1fr)
            400px;

        gap: 25px;
    }


    .about-modern-heading h1 {
        font-size: 46px;
    }


    .about-modern-heading p {
        font-size: 9.5px;
    }


    .about-modern-data-row span {
        font-size: 7.5px;
    }


    .about-modern-data-row strong {
        font-size: 8px;
    }


    .about-modern-showcase {
        min-height: 525px;
    }


    .about-learning-container {
        width:
            calc(100% - 70px);
    }


    .about-learning-heading h2 {
        font-size: 41px;
    }


    .learning-outcome-item strong {
        font-size: 9px;
    }


    .learning-outcome-item p {
        font-size: 7.5px;
    }

}


/* ========================================================= */
/* LAPTOP PENDEK - 1366x768 DLL */
/* ========================================================= */

@media (min-width: 901px) and (max-height: 800px) {

    .about-modern-container {
        padding:
            15px 0
            35px;
    }


    .about-modern-heading h1 {
        margin-top: 8px;

        font-size: 41px;
    }


    .about-modern-heading p {
        margin-top: 7px;

        font-size: 9px;
    }


    .about-modern-info-grid {
        margin-top: 12px;
    }


    .about-modern-card {
        padding: 13px;
    }


    .about-modern-data-row {
        min-height: 26px;

        padding:
            5px
            1px;
    }


    .about-modern-data-row span {
        font-size: 7px;
    }


    .about-modern-data-row strong {
        font-size: 7.5px;
    }


    .about-modern-project {
        padding: 8px;
    }


    .about-modern-project strong {
        font-size: 7px;
    }


    .about-modern-showcase {
        min-height: 495px;
    }


    .about-showcase-logo-area {
        height: 135px;
    }


    .about-showcase-content h2 {
        font-size: 22px;
    }


    .about-showcase-content p {
        font-size: 7.5px;
    }


    .about-feature-item strong {
        font-size: 7.5px;
    }


    .about-feature-item span {
        font-size: 6px;
    }


    /* SLIDE 2 */

    .about-learning-container {
        padding:
            14px 0
            35px;
    }


    .about-learning-heading {
        margin-bottom: 12px;
    }


    .about-learning-heading h2 {
        margin-top: 7px;

        font-size: 37px;
    }


    .about-learning-heading p {
        margin-top: 6px;

        font-size: 8.5px;
    }


    .learning-outcome-panel {
        padding: 13px;
    }


    .learning-outcome-list {
        margin-top: 7px;

        gap: 6px;
    }


    .learning-outcome-item {
        min-height: 59px;

        padding: 8px;

        grid-template-columns:
            30px
            minmax(0, 1fr);
    }


    .outcome-number {
        width: 30px;
        height: 30px;

        font-size: 7px;
    }


    .learning-outcome-item strong {
        font-size: 8.5px;
    }


    .learning-outcome-item p {
        margin-top: 2px;

        font-size: 7px;

        line-height: 1.35;
    }


    .learning-target-panel,
    .learning-media-panel {
        padding: 13px;
    }


    .learning-target-panel > p {
        font-size: 7.5px;
    }


    .learning-target-tags span {
        font-size: 6.5px;
    }


    .learning-media-features strong {
        font-size: 7.5px;
    }


    .learning-message-panel strong {
        font-size: 7.5px;
    }

}


/* ========================================================= */
/* TABLET */
/* ========================================================= */

@media (max-width: 900px) {

    .about-modern-page {
        height:
            calc(
                100dvh - 76px
            );

        min-height: 570px;
    }


    .about-modern-container {
        width:
            calc(100% - 44px);

        display: block;

        padding:
            30px 0
            60px;
    }


    .about-modern-heading {
        max-width: 720px;

        margin:
            0 auto;

        text-align: center;
    }


    .about-modern-heading p {
        margin:
            10px auto
            0;
    }


    .about-modern-info-grid {
        max-width: 720px;

        margin:
            18px auto
            0;

        grid-template-columns:
            repeat(
                2,
                minmax(0, 1fr)
            );
    }


    .about-modern-visual {
        max-width: 720px;

        margin:
            20px auto
            0;
    }


    .about-modern-showcase {
        max-width: 720px;
    }


    .about-learning-container {
        width:
            calc(100% - 44px);

        padding:
            28px 0
            60px;
    }


    .about-learning-grid {
        grid-template-columns: 1fr;
    }


    .learning-side-column {
        grid-template-columns:
            repeat(
                2,
                minmax(0, 1fr)
            );
    }


    .learning-message-panel {
        grid-column:
            1 / -1;
    }

}


/* ========================================================= */
/* MOBILE */
/* ========================================================= */

@media (max-width: 650px) {

    .about-modern-container,
    .about-learning-container {
        width:
            calc(100% - 28px);
    }


    .about-modern-heading h1 {
        font-size: 35px;
    }


    .about-modern-heading p {
        font-size: 10px;
    }


    .about-modern-info-grid {
        grid-template-columns: 1fr;
    }


    .about-modern-data-row span {
        font-size: 8px;
    }


    .about-modern-data-row strong {
        font-size: 8.5px;
    }


    .about-modern-showcase {
        min-height: 555px;
    }


    .about-learning-heading h2 {
        font-size: 31px;
    }


    .about-learning-heading p {
        font-size: 9.5px;
    }


    .learning-outcome-list {
        grid-template-columns: 1fr;
    }


    .learning-outcome-item.final-outcome {
        grid-column: auto;
    }


    .learning-outcome-item strong {
        font-size: 10px;
    }


    .learning-outcome-item p {
        font-size: 8.5px;
    }


    .learning-side-column {
        grid-template-columns: 1fr;
    }


    .learning-message-panel {
        grid-column: auto;
    }


    .learning-target-panel > p {
        font-size: 9px;
    }


    .learning-target-tags span {
        font-size: 7.5px;
    }


    .learning-media-features strong {
        font-size: 8.5px;
    }


    .learning-message-panel strong {
        font-size: 8.5px;
    }


    .about-modern-arrow {
        width: 34px;
        height: 34px;

        font-size: 18px;
    }


    .about-modern-prev {
        left: 3px;
    }


    .about-modern-next {
        right: 3px;
    }

}


/* ========================================================= */
/* SMALL MOBILE */
/* ========================================================= */

@media (max-width: 450px) {

    .about-modern-container,
    .about-learning-container {
        width:
            calc(100% - 22px);
    }


    .about-modern-heading h1 {
        font-size: 31px;
    }


    .about-modern-badge {
        font-size: 7px;
    }


    .about-modern-data-row {
        align-items: flex-start;

        flex-direction: column;

        gap: 3px;
    }


    .about-modern-data-row strong {
        text-align: left;
    }


    .about-showcase-features {
        grid-template-columns: 1fr;
    }


    .about-modern-showcase {
        min-height: 690px;
    }


    .about-feature-item strong {
        font-size: 8.5px;
    }


    .about-feature-item span {
        font-size: 7px;
    }


    .about-learning-heading h2 {
        font-size: 28px;
    }


    .learning-media-features {
        grid-template-columns: 1fr;
    }

}

</style>

@endpush



@push('scripts')

<script>

    let currentAboutModernSlide = 0;

    const totalAboutModernSlides = 2;

    const aboutModernTrack =
        document.getElementById(
            'aboutModernTrack'
        );

    const aboutModernDots =
        document.querySelectorAll(
            '.about-modern-dot'
        );

    const aboutModernSlider =
        document.getElementById(
            'aboutModernSlider'
        );


    function goToAboutModernSlide(index) {

        if (index < 0) {
            index =
                totalAboutModernSlides - 1;
        }

        if (
            index >=
            totalAboutModernSlides
        ) {
            index = 0;
        }


        currentAboutModernSlide =
            index;


        if (aboutModernTrack) {

            aboutModernTrack.style.transform =
                `translate3d(-${currentAboutModernSlide * 100}%, 0, 0)`;

        }


        aboutModernDots.forEach(
            function (
                dot,
                dotIndex
            ) {

                dot.classList.toggle(
                    'active',
                    dotIndex === currentAboutModernSlide
                );

            }
        );

    }


    function nextAboutModernSlide() {

        goToAboutModernSlide(
            currentAboutModernSlide + 1
        );

    }


    function previousAboutModernSlide() {

        goToAboutModernSlide(
            currentAboutModernSlide - 1
        );

    }


    /*
    ============================================================
    SWIPE
    ============================================================
    */

    let aboutStartX = 0;

    let aboutEndX = 0;


    if (aboutModernSlider) {

        aboutModernSlider.addEventListener(
            'touchstart',
            function (event) {

                aboutStartX =
                    event
                        .changedTouches[0]
                        .screenX;

            },
            {
                passive: true
            }
        );


        aboutModernSlider.addEventListener(
            'touchend',
            function (event) {

                aboutEndX =
                    event
                        .changedTouches[0]
                        .screenX;


                const difference =
                    aboutStartX -
                    aboutEndX;


                if (
                    difference >
                    60
                ) {

                    nextAboutModernSlide();

                }


                if (
                    difference <
                    -60
                ) {

                    previousAboutModernSlide();

                }

            },
            {
                passive: true
            }
        );

    }


    /*
    ============================================================
    KEYBOARD
    ============================================================
    */

    document.addEventListener(
        'keydown',
        function (event) {

            if (
                event.key ===
                'ArrowRight'
            ) {

                nextAboutModernSlide();

            }


            if (
                event.key ===
                'ArrowLeft'
            ) {

                previousAboutModernSlide();

            }

        }
    );


    /*
    ============================================================
    RESIZE
    ============================================================
    */

    window.addEventListener(
        'resize',
        function () {

            if (aboutModernTrack) {

                aboutModernTrack.style.transform =
                    `translate3d(-${currentAboutModernSlide * 100}%, 0, 0)`;

            }

        }
    );

</script>

@endpush