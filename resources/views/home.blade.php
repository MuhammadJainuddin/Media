@extends('layouts.app')

@section('title', 'HIMDAS - Media Pembelajaran Himpunan')

@section('content')

<div class="main-slider" id="mainSlider">

    <div class="slider-track" id="sliderTrack">

        {{-- ====================================================== --}}
        {{-- SLIDE 1 - BERANDA --}}
        {{-- ====================================================== --}}

        <section class="slide hero-slide himdas-hero-v2">

            <div class="hero-decoration decoration-one"></div>
            <div class="hero-decoration decoration-two"></div>
            <div class="hero-decoration decoration-three"></div>

            <div class="hero-v2-grid-pattern"></div>

            <div class="hero-v2-orb hero-v2-orb-one"></div>
            <div class="hero-v2-orb hero-v2-orb-two"></div>
            <div class="hero-v2-orb hero-v2-orb-three"></div>

            <div class="slide-container hero-layout hero-layout-v2">

                {{-- HERO TEXT --}}

                <div class="hero-text hero-text-v2">

                    <div class="hero-badge hero-badge-v2">

                        <span class="hero-badge-icon">
                            ✦
                        </span>

                        <span>
                            MEDIA PEMBELAJARAN INTERAKTIF GAMIFIKASI
                        </span>

                    </div>

                    <h1 class="hero-title-v2">

                        Selamat Datang

                        <br>

                        di

                        <span class="gradient-text">
                            HIMDAS
                        </span>

                    </h1>

                    <h2 class="hero-subtitle hero-subtitle-v2">
                        Belajar himpunan tidak harus terasa membosankan.
                    </h2>

                    <p class="hero-description-v2">

                        HIMDAS merupakan media pembelajaran interaktif
                        pada mata kuliah Matematika Dasar yang membantu
                        mahasiswa memahami materi himpunan dengan cara
                        yang lebih menarik, menyenangkan, dan berbasis
                        gamifikasi.

                    </p>

                    <div class="hero-actions hero-actions-v2">

                        <button
                            type="button"
                            class="start-button start-button-v2"
                            onclick="goToSlide(1)"
                        >

                            <span class="start-button-play">
                                ▶
                            </span>

                            <span>
                                Mulai Belajar
                            </span>

                            <span class="start-button-arrow">
                                →
                            </span>

                        </button>

                        <a
                            href="{{ route('petunjuk') }}"
                            class="guide-button guide-button-v2"
                        >

                            <span class="guide-play">
                                ▶
                            </span>

                            <span>
                                Lihat Petunjuk
                            </span>

                        </a>

                    </div>

                    <div class="hero-feature-strip">

                        <div class="hero-feature-item">

                            <div class="hero-feature-icon feature-blue">
                                ▤
                            </div>

                            <div>
                                <strong>Materi</strong>
                                <span>Terstruktur</span>
                            </div>

                        </div>

                        <div class="hero-feature-divider"></div>

                        <div class="hero-feature-item">

                            <div class="hero-feature-icon feature-green">
                                🎮
                            </div>

                            <div>
                                <strong>Pembelajaran</strong>
                                <span>Interaktif</span>
                            </div>

                        </div>

                        <div class="hero-feature-divider"></div>

                        <div class="hero-feature-item">

                            <div class="hero-feature-icon feature-purple">
                                ▥
                            </div>

                            <div>
                                <strong>Pengalaman</strong>
                                <span>Berbasis Gamifikasi</span>
                            </div>

                        </div>

                    </div>

                </div>


                {{-- HERO VISUAL --}}

                <div class="hero-image hero-image-v2">

                    <div class="hero-showcase">

                        <div class="hero-math-symbol hero-math-top">
                            ∩
                        </div>

                        <div class="hero-math-symbol hero-math-right">
                            A ∩ B
                        </div>

                        <div class="hero-orbit hero-orbit-one"></div>
                        <div class="hero-orbit hero-orbit-two"></div>

                        <span class="hero-particle particle-one"></span>
                        <span class="hero-particle particle-two"></span>
                        <span class="hero-particle particle-three"></span>
                        <span class="hero-particle particle-four"></span>


                        {{-- LOGO --}}

                        <div class="hero-brand-card-v2">

                            <div class="hero-brand-glow"></div>

                            <div class="hero-brand-inner">

                                <img
                                    src="{{ asset('images/logo-himdas-new.png') }}"
                                    alt="Logo HIMDAS"
                                    class="hero-brand-logo-v2"
                                >

                                <div class="hero-brand-description">

                                    <span>
                                        MEDIA PEMBELAJARAN INTERAKTIF GAMIFIKASI
                                    </span>

                                    <strong>
                                        Matematika Dasar
                                    </strong>

                                    <p>
                                        Materi Himpunan
                                    </p>

                                </div>

                            </div>

                        </div>


                        {{-- BADGE --}}

                        <div class="hero-gamification-card gamification-badge">

                            <div class="gamification-icon badge-icon">
                                🏅
                            </div>

                            <div class="gamification-content">

                                <strong>
                                    Badge
                                </strong>

                                <span>
                                    Koleksi pencapaian belajarmu
                                </span>

                                <div class="mini-badge-row">

                                    <span class="mini-badge mini-gold">★</span>
                                    <span class="mini-badge mini-silver">★</span>
                                    <span class="mini-badge mini-bronze">★</span>
                                    <span class="mini-badge mini-purple">★</span>

                                </div>

                            </div>

                        </div>


                        {{-- XP --}}

                        <div class="hero-gamification-card gamification-xp">

                            <div class="gamification-icon xp-icon">
                                ★
                            </div>

                            <div class="gamification-content">

                                <strong>
                                    XP / Poin
                                </strong>

                                <span>
                                    Kumpulkan poin setiap aktivitas
                                </span>

                                <div class="xp-value">
                                    320 XP
                                </div>

                                <div class="gamification-progress">
                                    <span style="width: 72%;"></span>
                                </div>

                            </div>

                        </div>


                        {{-- CHALLENGE --}}

                        <div class="hero-gamification-card gamification-challenge">

                            <div class="gamification-icon challenge-icon">
                                🎯
                            </div>

                            <div class="gamification-content">

                                <strong>
                                    Challenge
                                </strong>

                                <span>
                                    Selesaikan misi dan raih hadiah
                                </span>

                                <div class="challenge-preview">

                                    <div>
                                        <i class="challenge-check done">✓</i>
                                        <span></span>
                                    </div>

                                    <div>
                                        <i class="challenge-check done">✓</i>
                                        <span></span>
                                    </div>

                                    <div>
                                        <i class="challenge-check"></i>
                                        <span></span>
                                    </div>

                                </div>

                            </div>

                        </div>


                        {{-- LEVEL --}}

                        <div class="hero-gamification-card gamification-level">

                            <div class="gamification-icon level-icon">
                                🏆
                            </div>

                            <div class="gamification-content">

                                <strong>
                                    Level 1
                                </strong>

                                <span>
                                    Terus belajar untuk naik level
                                </span>

                                <div class="gamification-progress level-progress">
                                    <span style="width: 64%;"></span>
                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </section>



        {{-- ====================================================== --}}
        {{-- SLIDE 2 - MATERI --}}
        {{-- ====================================================== --}}

        <section class="slide material-slide material-journey-slide">

            <div class="journey-grid-bg"></div>

            <div class="journey-orb journey-orb-one"></div>
            <div class="journey-orb journey-orb-two"></div>
            <div class="journey-orb journey-orb-three"></div>

            <div class="slide-container material-journey-container">

                {{-- HEADING --}}

                <div class="material-journey-heading">

                    <h2>

                        Taklukkan Himpunan dalam

                        <span>
                            6 Level
                        </span>

                    </h2>

                    <p>

                        Mulai dari konsep dasar hingga pemecahan masalah.
                        Setiap level membawa kamu selangkah lebih dekat
                        menjadi Himpunan Master.

                    </p>

                </div>


                {{-- GAMIFICATION INFO --}}

                <div class="journey-gamification-bar">

                    <div class="journey-game-info">

                        <div class="journey-game-icon game-xp">
                            ★
                        </div>

                        <div>
                            <strong>Kumpulkan XP</strong>
                            <span>Dari setiap aktivitas</span>
                        </div>

                    </div>

                    <div class="journey-game-divider"></div>

                    <div class="journey-game-info">

                        <div class="journey-game-icon game-badge">
                            🏅
                        </div>

                        <div>
                            <strong>Raih Badge</strong>
                            <span>Buka pencapaian baru</span>
                        </div>

                    </div>

                    <div class="journey-game-divider"></div>

                    <div class="journey-game-info">

                        <div class="journey-game-icon game-challenge">
                            ⚡
                        </div>

                        <div>
                            <strong>Challenge</strong>
                            <span>Uji kemampuanmu</span>
                        </div>

                    </div>

                    <div class="journey-game-divider"></div>

                    <div class="journey-game-info">

                        <div class="journey-game-icon game-level">
                            🏆
                        </div>

                        <div>
                            <strong>Naik Level</strong>
                            <span>Selesaikan 6 tahap</span>
                        </div>

                    </div>

                </div>


                {{-- ================================================= --}}
                {{-- 6 LEVEL --}}
                {{-- ================================================= --}}

                <div class="journey-path">

                    <div class="journey-path-line"></div>


                    {{-- LEVEL 1 --}}

                    <button
                        type="button"
                        class="journey-level-card journey-level-blue"
                        onclick="openMaterial(
                            'Pengenal Himpunan',
                            '∈',
                            'Level pertama HIMDAS membahas pengertian himpunan, anggota atau elemen, simbol keanggotaan, serta kardinalitas.',
                            'Pengertian himpunan|Anggota atau elemen himpunan|Simbol ∈ dan ∉|Kardinalitas himpunan'
                        )"
                    >

                        <div class="journey-card-glow"></div>

                        <div class="journey-level-top">

                            <span class="journey-level-number">
                                LEVEL 01
                            </span>

                            <span class="journey-level-tag">
                                Dasar
                            </span>

                        </div>

                        <div class="journey-level-main">

                            <div class="journey-level-symbol">
                                ∈
                            </div>

                            <div class="journey-level-content">

                                <span>
                                    PENGENAL HIMPUNAN
                                </span>

                                <h3>
                                    Mulai Perjalananmu
                                </h3>

                                <p>
                                    Kenali konsep, anggota,
                                    dan kardinalitas himpunan.
                                </p>

                            </div>

                        </div>

                        <div class="journey-level-bottom">

                            <div>

                                <small>
                                    TARGET
                                </small>

                                <strong>
                                    ≥ 80%
                                </strong>

                            </div>

                            <span class="journey-open-button">

                                Lihat Level

                                <b>
                                    →
                                </b>

                            </span>

                        </div>

                    </button>


                    {{-- LEVEL 2 --}}

                    <button
                        type="button"
                        class="journey-level-card journey-level-cyan"
                        onclick="openMaterial(
                            'Pembentuk Himpunan',
                            '{ }',
                            'Pelajari berbagai cara menyatakan himpunan melalui tabulasi, deskripsi, simbol baku, dan representasi visual.',
                            'Tabulasi|Deskriptif|Simbol baku|Representasi himpunan'
                        )"
                    >

                        <div class="journey-card-glow"></div>

                        <div class="journey-level-top">

                            <span class="journey-level-number">
                                LEVEL 02
                            </span>

                            <span class="journey-level-tag">
                                Representasi
                            </span>

                        </div>

                        <div class="journey-level-main">

                            <div class="journey-level-symbol">
                                { }
                            </div>

                            <div class="journey-level-content">

                                <span>
                                    PEMBENTUK HIMPUNAN
                                </span>

                                <h3>
                                    Ubah Representasi
                                </h3>

                                <p>
                                    Nyatakan himpunan melalui
                                    berbagai bentuk penyajian.
                                </p>

                            </div>

                        </div>

                        <div class="journey-level-bottom">

                            <div>

                                <small>
                                    TARGET
                                </small>

                                <strong>
                                    ≥ 80%
                                </strong>

                            </div>

                            <span class="journey-open-button">

                                Lihat Level

                                <b>
                                    →
                                </b>

                            </span>

                        </div>

                    </button>


                    {{-- LEVEL 3 --}}

                    <button
                        type="button"
                        class="journey-level-card journey-level-green"
                        onclick="openMaterial(
                            'Venn Master',
                            '◯',
                            'Pelajari himpunan kosong, semesta, himpunan sama, lepas, bersilangan, ekuivalen, serta visualisasi hubungan antarhimpunan.',
                            'Himpunan kosong|Himpunan semesta|Himpunan sama|Himpunan lepas dan bersilangan|Diagram Venn'
                        )"
                    >

                        <div class="journey-card-glow"></div>

                        <div class="journey-level-top">

                            <span class="journey-level-number">
                                LEVEL 03
                            </span>

                            <span class="journey-level-tag">
                                Visual
                            </span>

                        </div>

                        <div class="journey-level-main">

                            <div class="journey-level-symbol">
                                ◯
                            </div>

                            <div class="journey-level-content">

                                <span>
                                    VENN MASTER
                                </span>

                                <h3>
                                    Kuasai Diagram Venn
                                </h3>

                                <p>
                                    Visualisasikan hubungan
                                    antarhimpunan dengan mudah.
                                </p>

                            </div>

                        </div>

                        <div class="journey-level-bottom">

                            <div>

                                <small>
                                    TARGET
                                </small>

                                <strong>
                                    ≥ 80%
                                </strong>

                            </div>

                            <span class="journey-open-button">

                                Lihat Level

                                <b>
                                    →
                                </b>

                            </span>

                        </div>

                    </button>


                    {{-- LEVEL 4 --}}

                    <button
                        type="button"
                        class="journey-level-card journey-level-purple"
                        onclick="openMaterial(
                            'Subset Master',
                            '⊂',
                            'Level ini membahas subset, subset sejati, dan himpunan kuasa serta keterkaitan antarhimpunan.',
                            'Subset|Subset sejati|Himpunan kuasa|Menentukan banyak subset'
                        )"
                    >

                        <div class="journey-card-glow"></div>

                        <div class="journey-level-top">

                            <span class="journey-level-number">
                                LEVEL 04
                            </span>

                            <span class="journey-level-tag">
                                Menengah
                            </span>

                        </div>

                        <div class="journey-level-main">

                            <div class="journey-level-symbol">
                                ⊂
                            </div>

                            <div class="journey-level-content">

                                <span>
                                    SUBSET MASTER
                                </span>

                                <h3>
                                    Pecahkan Subset
                                </h3>

                                <p>
                                    Pahami subset, subset sejati,
                                    dan himpunan kuasa.
                                </p>

                            </div>

                        </div>

                        <div class="journey-level-bottom">

                            <div>

                                <small>
                                    TARGET
                                </small>

                                <strong>
                                    ≥ 80%
                                </strong>

                            </div>

                            <span class="journey-open-button">

                                Lihat Level

                                <b>
                                    →
                                </b>

                            </span>

                        </div>

                    </button>


                    {{-- LEVEL 5 --}}

                    <button
                        type="button"
                        class="journey-level-card journey-level-orange"
                        onclick="openMaterial(
                            'Operation Master',
                            '∪',
                            'Kuasai irisan, gabungan, komplemen, selisih, beda setangkup, dan sifat-sifat operasi himpunan.',
                            'Irisan|Gabungan|Komplemen|Selisih|Beda setangkup|Sifat operasi'
                        )"
                    >

                        <div class="journey-card-glow"></div>

                        <div class="journey-level-top">

                            <span class="journey-level-number">
                                LEVEL 05
                            </span>

                            <span class="journey-level-tag">
                                Operasi
                            </span>

                        </div>

                        <div class="journey-level-main">

                            <div class="journey-level-symbol">
                                ∪
                            </div>

                            <div class="journey-level-content">

                                <span>
                                    OPERATION MASTER
                                </span>

                                <h3>
                                    Taklukkan Operasi
                                </h3>

                                <p>
                                    Kuasai berbagai operasi
                                    penting pada himpunan.
                                </p>

                            </div>

                        </div>

                        <div class="journey-level-bottom">

                            <div>

                                <small>
                                    TARGET
                                </small>

                                <strong>
                                    ≥ 80%
                                </strong>

                            </div>

                            <span class="journey-open-button">

                                Lihat Level

                                <b>
                                    →
                                </b>

                            </span>

                        </div>

                    </button>


                    {{-- LEVEL 6 --}}

                    <button
                        type="button"
                        class="journey-level-card journey-level-final"
                        onclick="openMaterial(
                            'Himpunan Master',
                            '★',
                            'Level akhir HIMDAS membawa seluruh konsep himpunan ke dalam penerapan, pemecahan masalah, dan evaluasi komprehensif.',
                            'Penerapan konsep himpunan|Pemecahan masalah|Analisis kasus|Evaluasi komprehensif'
                        )"
                    >

                        <div class="journey-card-glow"></div>

                        <div class="journey-level-top">

                            <span class="journey-level-number">
                                FINAL LEVEL
                            </span>

                            <span class="journey-level-tag final-tag">
                                Master
                            </span>

                        </div>

                        <div class="journey-level-main">

                            <div class="journey-level-symbol final-symbol">
                                ★
                            </div>

                            <div class="journey-level-content">

                                <span>
                                    HIMPUNAN MASTER
                                </span>

                                <h3>
                                    Raih Gelar Master
                                </h3>

                                <p>
                                    Terapkan seluruh konsep dalam
                                    pemecahan masalah nyata.
                                </p>

                            </div>

                        </div>

                        <div class="journey-level-bottom">

                            <div>

                                <small>
                                    FINAL
                                </small>

                                <strong>
                                    Master
                                </strong>

                            </div>

                            <span class="journey-open-button">

                                Final Level

                                <b>
                                    →
                                </b>

                            </span>

                        </div>

                    </button>

                </div>


                {{-- BOTTOM CTA --}}

                <div class="journey-bottom-card">

                    <div class="journey-bottom-icon">
                        🚀
                    </div>

                    <div class="journey-bottom-content">

                        <span>
                            SIAP MEMULAI PERJALANAN?
                        </span>

                        <strong>
                            Belajar, selesaikan level, dan jadilah Himpunan Master.
                        </strong>

                    </div>

                    <div class="journey-bottom-reward">

                        <span>
                            REWARD
                        </span>

                        <div>

                            <b>
                                ⭐ XP
                            </b>

                            <b>
                                🏅 Badge
                            </b>

                            <b>
                                🏆 Rank
                            </b>

                        </div>

                    </div>

                    <a
                        href="{{ route('login') }}"
                        class="journey-start-button"
                    >

                        Mulai Sekarang

                        <span>
                            →
                        </span>

                    </a>

                </div>

            </div>

        </section>

    </div>


    {{-- SLIDER DOT --}}

    <div class="slider-navigation">

        <button
            type="button"
            class="slider-dot active"
            onclick="goToSlide(0)"
            aria-label="Beranda"
        ></button>

        <button
            type="button"
            class="slider-dot"
            onclick="goToSlide(1)"
            aria-label="Materi"
        ></button>

    </div>


    {{-- SLIDER ARROW --}}

    <button
        type="button"
        class="slider-arrow slider-prev"
        onclick="previousSlide()"
        aria-label="Slide sebelumnya"
    >
        ‹
    </button>

    <button
        type="button"
        class="slider-arrow slider-next"
        onclick="nextSlide()"
        aria-label="Slide berikutnya"
    >
        ›
    </button>

</div>



{{-- ====================================================== --}}
{{-- MODAL --}}
{{-- ====================================================== --}}

<div class="material-modal" id="materialModal">

    <div
        class="modal-overlay"
        onclick="closeMaterial()"
    ></div>

    <div class="modal-box">

        <button
            type="button"
            class="modal-close"
            onclick="closeMaterial()"
            aria-label="Tutup"
        >
            ×
        </button>

        <div
            class="modal-icon"
            id="modalIcon"
        >
            ∈
        </div>

        <span class="modal-label">
            RINGKASAN LEVEL
        </span>

        <h2 id="modalTitle">
            Pengenal Himpunan
        </h2>

        <p
            class="modal-description"
            id="modalDescription"
        >
            Penjelasan materi.
        </p>

        <div class="modal-learning">

            <h4>
                Yang akan dipelajari
            </h4>

            <div
                id="modalPoints"
                class="modal-points"
            ></div>

        </div>

        <a
            href="{{ route('login') }}"
            class="modal-start"
        >

            <span>
                Mulai Pelajari Level
            </span>

            <span>
                →
            </span>

        </a>

    </div>

</div>

@endsection



@push('styles')

<style>

/* ========================================================= */
/* FIX UTAMA SLIDER */
/* ========================================================= */

html,
body {
    max-width: 100%;
    overflow-x: hidden;
}


.public-main {
    width: 100%;
    max-width: 100%;
    overflow-x: hidden;
}


.main-slider {
    width: 100%;
    max-width: 100%;

    height:
        calc(
            100dvh - 88px
        );

    min-height: 610px;

    position: relative;

    overflow: hidden;
}


.slider-track {
    width: 100%;
    height: 100%;

    min-width: 0;

    display: flex;

    transition:
        transform .65s
        cubic-bezier(
            .77,
            0,
            .18,
            1
        );

    will-change: transform;
}


.slide {
    width: 100%;
    min-width: 100%;
    max-width: 100%;

    height: 100%;

    flex:
        0 0 100%;

    position: relative;

    overflow: hidden;
}


.slide-container {
    min-width: 0;
}



/* ========================================================= */
/* HERO */
/* ========================================================= */

.himdas-hero-v2 {
    isolation: isolate;
}


.hero-layout-v2 {
    grid-template-columns:
        minmax(0, .92fr)
        minmax(500px, 1.08fr);

    gap: 36px;
}


/* HERO BACKGROUND */

.hero-v2-grid-pattern {
    width: 520px;
    height: 520px;

    position: absolute;

    top: 0;
    right: 0;

    opacity: .22;

    background-image:
        linear-gradient(
            rgba(37,99,235,.11) 1px,
            transparent 1px
        ),
        linear-gradient(
            90deg,
            rgba(37,99,235,.11) 1px,
            transparent 1px
        );

    background-size:
        38px 38px;

    mask-image:
        linear-gradient(
            135deg,
            transparent,
            #000
        );

    pointer-events: none;
}


.hero-v2-orb {
    position: absolute;

    border-radius: 50%;

    pointer-events: none;
}


.hero-v2-orb-one {
    width: 90px;
    height: 90px;

    right: 18%;
    top: 7%;

    background:
        radial-gradient(
            circle at 30% 25%,
            #ffffff,
            #9be7ff 24%,
            rgba(37,99,235,.3) 62%,
            transparent 70%
        );

    opacity: .58;
}


.hero-v2-orb-two {
    width: 38px;
    height: 38px;

    right: 8%;
    bottom: 13%;

    background:
        radial-gradient(
            circle at 30% 25%,
            #ffffff,
            #67e8f9,
            rgba(37,99,235,.15)
        );

    opacity: .7;
}


.hero-v2-orb-three {
    width: 24px;
    height: 24px;

    right: 34%;
    bottom: 8%;

    background:
        linear-gradient(
            135deg,
            #34d399,
            #22d3ee
        );

    opacity: .5;
}


/* HERO TEXT */

.hero-text-v2 {
    max-width: 590px;
}


.hero-badge-v2 {
    padding:
        9px
        15px;

    border:
        1px solid
        rgba(37,99,235,.11);

    background:
        rgba(255,255,255,.74);

    backdrop-filter:
        blur(14px);

    box-shadow:
        0 12px 32px
        rgba(37,99,235,.06);
}


.hero-badge-icon {
    width: 18px;
    height: 18px;

    display: inline-flex;

    align-items: center;
    justify-content: center;

    border-radius: 6px;

    color:
        #2563eb !important;

    background:
        #eff6ff;

    font-size: 9px;
}


.hero-title-v2 {
    max-width: 610px !important;

    margin-top:
        25px !important;

    font-size:
        clamp(
            42px,
            4.1vw,
            64px
        ) !important;

    line-height:
        .99 !important;

    letter-spacing:
        -3px !important;
}


.hero-title-v2 .gradient-text {
    font-size:
        1.04em;
}


.hero-subtitle-v2 {
    margin-top: 24px;

    color: #112c58;

    font-size: 16px;

    font-weight: 700;
}


.hero-description-v2 {
    max-width:
        590px !important;

    margin-top:
        14px !important;

    color:
        #5e7089 !important;

    font-size:
        11px !important;

    line-height:
        1.9 !important;
}


/* HERO BUTTON */

.hero-actions-v2 {
    margin-top: 28px;

    gap: 14px;
}


.start-button-v2 {
    min-width: 172px;

    padding:
        13px
        18px;

    border:
        1px solid
        rgba(255,255,255,.4);

    border-radius: 13px;

    background:
        linear-gradient(
            110deg,
            #2563eb 0%,
            #06b6d4 53%,
            #10b981 100%
        );

    box-shadow:
        0 13px 30px
        rgba(37,99,235,.23);

    font-weight: 700;
}


.start-button-play {
    width: 27px;
    height: 27px;

    display: inline-flex;

    align-items: center;
    justify-content: center;

    border-radius: 50%;

    color: #2563eb;

    background:
        rgba(255,255,255,.92);

    font-size: 8px;
}


.start-button-arrow {
    margin-left: auto;

    font-size: 16px;
}


.guide-button-v2 {
    min-height: 51px;

    padding:
        11px
        19px;

    background:
        rgba(255,255,255,.66);

    backdrop-filter:
        blur(14px);

    font-weight: 600;
}


/* MINI FEATURES */

.hero-feature-strip {
    margin-top: 28px;

    display: flex;

    align-items: center;

    gap: 17px;
}


.hero-feature-item {
    display: flex;

    align-items: center;

    gap: 10px;
}


.hero-feature-icon {
    width: 36px;
    height: 36px;

    flex-shrink: 0;

    display: flex;

    align-items: center;
    justify-content: center;

    border-radius: 11px;

    font-size: 14px;
}


.feature-blue {
    color: #2563eb;
    background: #eaf3ff;
}


.feature-green {
    color: #059669;
    background: #e8fbf3;
}


.feature-purple {
    color: #7c3aed;
    background: #f2edff;
}


.hero-feature-item strong {
    display: block;

    color: #243b5a;

    font-size: 8px;
}


.hero-feature-item span {
    display: block;

    margin-top: 1px;

    color: #7c8ca0;

    font-size: 7px;
}


.hero-feature-divider {
    width: 1px;
    height: 27px;

    background:
        #d8e4f2;
}


/* ========================================================= */
/* HERO SHOWCASE */
/* ========================================================= */

.hero-image-v2 {
    min-height: 520px;
}


.hero-showcase {
    width: 590px;
    height: 520px;

    position: relative;

    display: flex;

    align-items: center;
    justify-content: center;
}


.hero-brand-card-v2 {
    width: 380px;
    height: 350px;

    position: relative;

    z-index: 5;

    overflow: hidden;

    display: flex;

    align-items: center;
    justify-content: center;

    border:
        1px solid
        rgba(255,255,255,.95);

    border-radius: 34px;

    background:
        linear-gradient(
            145deg,
            rgba(255,255,255,.96),
            rgba(250,253,255,.88)
        );

    backdrop-filter:
        blur(26px);

    box-shadow:
        0 35px 80px
        rgba(33,89,145,.18);
}


.hero-brand-glow {
    width: 300px;
    height: 300px;

    position: absolute;

    left: 50%;
    top: 45%;

    transform:
        translate(-50%,-50%);

    border-radius: 50%;

    background:
        radial-gradient(
            circle,
            rgba(6,182,212,.17),
            rgba(37,99,235,.07) 47%,
            transparent 73%
        );
}


.hero-brand-inner {
    position: relative;

    z-index: 2;

    text-align: center;
}


.hero-brand-logo-v2 {
    width: 235px;
    max-height: 230px;

    object-fit: contain;

    transition:
        transform .35s ease;
}


.hero-brand-card-v2:hover
.hero-brand-logo-v2 {
    transform:
        scale(1.035);
}


.hero-brand-description {
    text-align: center;
}


.hero-brand-description > span {
    display: block;

    color: #2563eb;

    font-size: 6px;

    font-weight: 800;

    letter-spacing:
        1.15px;
}


.hero-brand-description strong {
    display: block;

    margin-top: 7px;

    color: #172033;

    font-size: 13px;
}


.hero-brand-description p {
    margin-top: 2px;

    color: #7d8da0;

    font-size: 8px;
}


/* ORBIT */

.hero-orbit {
    position: absolute;

    z-index: 2;

    border:
        1px solid
        rgba(37,99,235,.23);

    border-radius: 50%;

    pointer-events: none;
}


.hero-orbit-one {
    width: 500px;
    height: 370px;

    transform:
        rotate(-13deg);

    border-color:
        rgba(37,99,235,.25)
        rgba(16,185,129,.28)
        rgba(6,182,212,.22)
        rgba(37,99,235,.13);
}


.hero-orbit-two {
    width: 435px;
    height: 475px;

    transform:
        rotate(54deg);

    border-style: dashed;

    opacity: .36;
}


/* PARTICLES */

.hero-particle {
    position: absolute;

    z-index: 9;

    border:
        3px solid
        white;

    border-radius: 50%;
}


.particle-one {
    width: 16px;
    height: 16px;

    left: 38px;
    top: 185px;

    background: #3b82f6;
}


.particle-two {
    width: 13px;
    height: 13px;

    right: 24px;
    top: 196px;

    background: #10b981;
}


.particle-three {
    width: 11px;
    height: 11px;

    left: 105px;
    bottom: 58px;

    background: #22d3ee;
}


.particle-four {
    width: 10px;
    height: 10px;

    right: 112px;
    bottom: 38px;

    background: #34d399;
}


.hero-math-symbol {
    position: absolute;

    color:
        rgba(37,99,235,.12);

    pointer-events: none;
}


.hero-math-top {
    top: 9px;
    left: 112px;

    font-size: 62px;
}


.hero-math-right {
    top: 58px;
    right: 3px;

    font-size: 27px;

    font-family:
        Georgia,
        serif;

    font-style: italic;
}


/* GAMIFICATION */

.hero-gamification-card {
    position: absolute;

    z-index: 12;

    display: flex;

    align-items: flex-start;

    gap: 11px;

    padding: 14px;

    border:
        1px solid
        rgba(255,255,255,.9);

    border-radius: 18px;

    background:
        linear-gradient(
            145deg,
            rgba(255,255,255,.93),
            rgba(246,251,255,.82)
        );

    backdrop-filter:
        blur(18px);

    box-shadow:
        0 18px 40px
        rgba(30,78,130,.14);

    transition:
        transform .3s ease,
        box-shadow .3s ease;
}


.hero-gamification-card:hover {
    z-index: 20;

    box-shadow:
        0 23px 48px
        rgba(30,78,130,.2);
}


.gamification-icon {
    width: 43px;
    height: 43px;

    flex-shrink: 0;

    display: flex;

    align-items: center;
    justify-content: center;

    border-radius: 13px;

    font-size: 21px;
}


.badge-icon {
    background:
        linear-gradient(
            145deg,
            #fff7d9,
            #ffebaa
        );
}


.xp-icon {
    color: #f59e0b;

    background:
        linear-gradient(
            145deg,
            #fff9df,
            #fff0bc
        );
}


.challenge-icon {
    background:
        linear-gradient(
            145deg,
            #fff1f2,
            #ffe4e6
        );
}


.level-icon {
    background:
        linear-gradient(
            145deg,
            #fff7d8,
            #ffedb2
        );
}


.gamification-content {
    min-width: 0;

    flex: 1;
}


.gamification-content strong {
    display: block;

    color: #13294d;

    font-size: 11px;
}


.gamification-content > span {
    display: block;

    max-width: 122px;

    margin-top: 3px;

    color: #71839a;

    font-size: 7px;

    line-height: 1.45;
}


.gamification-badge {
    width: 218px;

    top: 34px;
    left: 5px;

    transform:
        rotate(4deg);

    animation:
        heroFloatOne
        5.6s
        ease-in-out
        infinite;
}


.mini-badge-row {
    margin-top: 8px;

    display: flex;

    gap: 5px;
}


.mini-badge {
    width: 23px;
    height: 23px;

    display: flex;

    align-items: center;
    justify-content: center;

    border-radius: 50%;

    color: white;

    font-size: 8px;
}


.mini-gold {
    background: #f59e0b;
}


.mini-silver {
    background: #94a3b8;
}


.mini-bronze {
    background: #d97706;
}


.mini-purple {
    background: #8b5cf6;
}


.gamification-xp {
    width: 205px;

    top: 68px;
    right: -6px;

    transform:
        rotate(-3deg);

    animation:
        heroFloatTwo
        6.3s
        ease-in-out
        infinite;
}


.xp-value {
    margin-top: 7px;

    color: #1683d8;

    font-size: 17px;

    font-weight: 800;
}


.gamification-progress {
    height: 6px;

    margin-top: 7px;

    overflow: hidden;

    border-radius: 99px;

    background:
        #e2eaf4;
}


.gamification-progress span {
    height: 100%;

    display: block;

    border-radius: inherit;

    background:
        linear-gradient(
            90deg,
            #2563eb,
            #06b6d4,
            #10b981
        );
}


.gamification-challenge {
    width: 210px;

    left: -17px;
    bottom: 30px;

    transform:
        rotate(-5deg);

    animation:
        heroFloatTwo
        6s
        ease-in-out
        infinite
        reverse;
}


.challenge-preview {
    margin-top: 8px;

    display: grid;

    gap: 5px;
}


.challenge-preview > div {
    display: flex;

    align-items: center;

    gap: 6px;
}


.challenge-preview > div > span {
    width: 75px;
    height: 5px;

    display: block;

    border-radius: 99px;

    background:
        #dce6f2;
}


.challenge-check {
    width: 14px;
    height: 14px;

    display: flex;

    align-items: center;
    justify-content: center;

    border:
        1px solid
        #cbd5e1;

    border-radius: 50%;

    color: white;

    font-size: 8px;

    font-style: normal;
}


.challenge-check.done {
    border-color: #10b981;

    background: #10b981;
}


.gamification-level {
    width: 205px;

    right: -9px;
    bottom: 38px;

    transform:
        rotate(5deg);

    animation:
        heroFloatOne
        6.7s
        ease-in-out
        infinite
        reverse;
}


/* ========================================================= */
/* LEARNING JOURNEY */
/* ========================================================= */

.material-journey-slide {
    overflow-x: hidden;

    overflow-y: auto;

    background:
        radial-gradient(
            circle at 7% 7%,
            rgba(37,99,235,.14),
            transparent 28%
        ),
        radial-gradient(
            circle at 93% 17%,
            rgba(34,211,238,.17),
            transparent 29%
        ),
        radial-gradient(
            circle at 78% 95%,
            rgba(16,185,129,.11),
            transparent 28%
        ),
        linear-gradient(
            135deg,
            #fbfdff 0%,
            #f1f7ff 46%,
            #e9f9ff 100%
        );
}


.material-journey-slide *,
.material-journey-container,
.journey-gamification-bar,
.journey-path,
.journey-bottom-card {
    box-sizing: border-box;
}


.material-journey-container {
    width:
        min(
            1040px,
            calc(100% - 56px)
        ) !important;

    max-width: 1040px;

    height: auto;

    min-height: 100%;

    margin:
        0 auto;

    padding:
        18px 0
        28px !important;

    position: relative;

    z-index: 3;
}


/* BACKGROUND */

.journey-grid-bg {
    width: 650px;
    height: 650px;

    position: absolute;

    top: 0;
    right: -80px;

    opacity: .15;

    background-image:
        linear-gradient(
            rgba(37,99,235,.12) 1px,
            transparent 1px
        ),
        linear-gradient(
            90deg,
            rgba(37,99,235,.12) 1px,
            transparent 1px
        );

    background-size:
        42px 42px;

    pointer-events: none;
}


.journey-orb {
    position: absolute;

    border-radius: 50%;

    pointer-events: none;
}


.journey-orb-one {
    width: 220px;
    height: 220px;

    left: -115px;
    bottom: 50px;

    background:
        rgba(37,99,235,.07);
}


.journey-orb-two {
    width: 290px;
    height: 290px;

    right: -145px;
    top: 170px;

    background:
        rgba(6,182,212,.08);
}


.journey-orb-three {
    width: 135px;
    height: 135px;

    left: 44%;
    bottom: -85px;

    background:
        rgba(16,185,129,.09);
}


/* ========================================================= */
/* HEADING */
/* ========================================================= */

.material-journey-heading {
    max-width: 860px;

    margin:
        0 auto
        14px;

    text-align: center;
}


.material-journey-heading h2 {
    margin: 0;

    color: #0f172a;

    font-size:
        clamp(
            27px,
            2.65vw,
            38px
        );

    font-weight: 800;

    line-height: 1.12;

    letter-spacing:
        -1.25px;
}


.material-journey-heading h2 span {
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


.material-journey-heading p {
    max-width: 620px;

    margin:
        7px auto
        0;

    color: #64748b;

    font-size: 8px;

    line-height: 1.6;
}


/* ========================================================= */
/* GAMIFICATION BAR */
/* ========================================================= */

.journey-gamification-bar {
    width: 100%;

    max-width: 850px;

    margin:
        0 auto
        13px;

    padding: 7px;

    display: grid;

    grid-template-columns:
        1fr auto
        1fr auto
        1fr auto
        1fr;

    align-items: center;

    border:
        1px solid
        rgba(255,255,255,.9);

    border-radius: 17px;

    background:
        rgba(255,255,255,.69);

    backdrop-filter:
        blur(16px);

    box-shadow:
        0 12px 30px
        rgba(30,72,120,.07);
}


.journey-game-info {
    min-width: 0;

    padding:
        6px
        8px;

    display: flex;

    align-items: center;

    gap: 8px;

    border-radius: 11px;

    transition:
        .2s ease;
}


.journey-game-info:hover {
    transform:
        translateY(-2px);

    background:
        rgba(247,251,255,.95);
}


.journey-game-icon {
    width: 31px;
    height: 31px;

    flex-shrink: 0;

    display: flex;

    align-items: center;
    justify-content: center;

    border-radius: 9px;

    font-size: 13px;
}


.game-xp {
    color: #f59e0b;
    background: #fffbeb;
}


.game-badge {
    background: #fff7dd;
}


.game-challenge {
    background: #f5f3ff;
}


.game-level {
    background: #ecfdf5;
}


.journey-game-info strong {
    display: block;

    color: #263b56;

    font-size: 7px;
}


.journey-game-info span {
    display: block;

    margin-top: 2px;

    color: #94a3b8;

    font-size: 5.7px;
}


.journey-game-divider {
    width: 1px;
    height: 27px;

    background:
        #dfe9f4;
}


/* ========================================================= */
/* LEVEL GRID */
/* ========================================================= */

.journey-path {
    width: 100%;

    max-width: 990px;

    min-width: 0;

    margin:
        0 auto;

    position: relative;

    display: grid;

    grid-template-columns:
        repeat(
            3,
            minmax(0,1fr)
        );

    gap: 11px;
}


.journey-path-line {
    height: 2px;

    position: absolute;

    z-index: 0;

    left: 7%;
    right: 7%;
    top: 50%;

    background:
        linear-gradient(
            90deg,
            transparent,
            rgba(37,99,235,.17),
            rgba(6,182,212,.24),
            rgba(16,185,129,.18),
            transparent
        );

    pointer-events: none;
}


/* ========================================================= */
/* LEVEL CARD */
/* ========================================================= */

.journey-level-card {
    --journey-color:
        #2563eb;

    width: 100%;

    min-width: 0;

    min-height: 160px;

    padding: 13px;

    position: relative;

    z-index: 2;

    overflow: hidden;

    display: flex;

    flex-direction: column;

    text-align: left;

    border:
        1px solid
        rgba(255,255,255,.94);

    border-radius: 18px;

    background:
        linear-gradient(
            145deg,
            rgba(255,255,255,.96),
            rgba(247,251,255,.88)
        );

    backdrop-filter:
        blur(15px);

    box-shadow:
        0 12px 31px
        rgba(30,72,120,.085);

    cursor: pointer;

    transition:
        transform .25s ease,
        box-shadow .25s ease,
        border-color .25s ease;
}


.journey-level-card::before {
    content: "";

    width: 100%;
    height: 4px;

    position: absolute;

    top: 0;
    left: 0;

    background:
        var(--journey-color);
}


.journey-card-glow {
    width: 110px;
    height: 110px;

    position: absolute;

    right: -50px;
    bottom: -55px;

    border-radius: 50%;

    background:
        var(--journey-color);

    opacity: .055;

    transition:
        .3s ease;
}


.journey-level-card:hover {
    transform:
        translateY(-5px);

    box-shadow:
        0 19px 42px
        rgba(30,72,120,.14);
}


.journey-level-card:hover
.journey-card-glow {
    transform:
        scale(1.3);

    opacity: .09;
}


.journey-level-blue {
    --journey-color:
        #2563eb;
}


.journey-level-cyan {
    --journey-color:
        #06b6d4;
}


.journey-level-green {
    --journey-color:
        #10b981;
}


.journey-level-purple {
    --journey-color:
        #8b5cf6;
}


.journey-level-orange {
    --journey-color:
        #f59e0b;
}


.journey-level-final {
    --journey-color:
        #0f4c81;

    color: white;

    border:
        1px solid
        rgba(255,255,255,.15);

    background:
        radial-gradient(
            circle at 90% 5%,
            rgba(34,211,238,.22),
            transparent 36%
        ),
        linear-gradient(
            135deg,
            #0b234a,
            #174d8e,
            #0e7490
        );

    box-shadow:
        0 17px 37px
        rgba(7,26,56,.18);
}


.journey-level-final::before {
    background:
        linear-gradient(
            90deg,
            #22d3ee,
            #34d399
        );
}


/* LEVEL TOP */

.journey-level-top {
    display: flex;

    align-items: center;

    justify-content: space-between;

    gap: 7px;
}


.journey-level-number {
    color:
        var(--journey-color);

    font-size: 6px;

    font-weight: 800;

    letter-spacing:
        .7px;
}


.journey-level-final
.journey-level-number {
    color: #7dd3fc;
}


.journey-level-tag {
    padding:
        3px
        7px;

    border-radius: 999px;

    color:
        var(--journey-color);

    background:
        rgba(239,246,255,.85);

    font-size: 5.5px;

    font-weight: 750;
}


.journey-level-final
.journey-level-tag {
    color: #dff8ff;

    background:
        rgba(255,255,255,.10);
}


/* LEVEL MAIN */

.journey-level-main {
    margin-top: 9px;

    display: grid;

    grid-template-columns:
        45px
        minmax(0,1fr);

    align-items: center;

    gap: 9px;
}


.journey-level-symbol {
    width: 44px;
    height: 44px;

    display: flex;

    align-items: center;
    justify-content: center;

    border:
        1px solid
        rgba(255,255,255,.85);

    border-radius: 12px;

    color:
        var(--journey-color);

    background:
        rgba(239,246,255,.82);

    font-size: 18px;

    font-weight: 800;
}


.journey-level-final
.journey-level-symbol {
    color: white;

    border-color:
        rgba(255,255,255,.14);

    background:
        rgba(255,255,255,.10);
}


.journey-level-content {
    min-width: 0;
}


.journey-level-content > span {
    display: block;

    color:
        var(--journey-color);

    font-size: 5.2px;

    font-weight: 800;

    letter-spacing:
        .58px;
}


.journey-level-final
.journey-level-content > span {
    color: #7dd3fc;
}


.journey-level-content h3 {
    margin-top: 2px;

    color: #13233c;

    font-size: 10px;

    font-weight: 800;

    line-height: 1.2;

    overflow-wrap: anywhere;
}


.journey-level-final
.journey-level-content h3 {
    color: #ffffff;
}


.journey-level-content p {
    margin-top: 4px;

    color: #718198;

    font-size: 5.7px;

    line-height: 1.4;

    overflow-wrap: anywhere;
}


.journey-level-final
.journey-level-content p {
    color: #c8e7f6;
}


/* LEVEL FOOTER */

.journey-level-bottom {
    margin-top: auto;

    padding-top: 8px;

    display: flex;

    align-items: flex-end;

    justify-content: space-between;

    gap: 7px;

    border-top:
        1px solid
        #edf2f7;
}


.journey-level-final
.journey-level-bottom {
    border-color:
        rgba(255,255,255,.11);
}


.journey-level-bottom small {
    display: block;

    color: #a0aec0;

    font-size: 5px;

    font-weight: 750;
}


.journey-level-bottom strong {
    display: block;

    color:
        var(--journey-color);

    font-size: 7.5px;
}


.journey-level-final
.journey-level-bottom strong {
    color: white;
}


.journey-open-button {
    display: inline-flex;

    align-items: center;

    gap: 5px;

    color:
        var(--journey-color);

    font-size: 5.7px;

    font-weight: 800;
}


.journey-open-button b {
    width: 19px;
    height: 19px;

    display: flex;

    align-items: center;
    justify-content: center;

    border-radius: 6px;

    color: white;

    background:
        var(--journey-color);

    font-size: 8px;
}


.journey-level-final
.journey-open-button {
    color: #dff8ff;
}


.journey-level-final
.journey-open-button b {
    color: #0b234a;

    background:
        #7dd3fc;
}


/* ========================================================= */
/* BOTTOM CTA */
/* ========================================================= */

.journey-bottom-card {
    width: 100%;

    max-width: 990px;

    min-width: 0;

    margin:
        11px auto
        0;

    padding:
        9px
        11px;

    display: grid;

    grid-template-columns:
        auto
        minmax(0,1fr)
        auto
        auto;

    align-items: center;

    gap: 11px;

    border:
        1px solid
        rgba(255,255,255,.92);

    border-radius: 16px;

    background:
        rgba(255,255,255,.72);

    backdrop-filter:
        blur(17px);

    box-shadow:
        0 11px 28px
        rgba(30,72,120,.07);
}


.journey-bottom-icon {
    width: 36px;
    height: 36px;

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

    font-size: 15px;
}


.journey-bottom-content span {
    display: block;

    color: #2563eb;

    font-size: 5.4px;

    font-weight: 800;
}


.journey-bottom-content strong {
    display: block;

    margin-top: 2px;

    color: #17253d;

    font-size: 7.5px;
}


.journey-bottom-reward {
    padding:
        0
        11px;

    border-left:
        1px solid
        #dce7f2;
}


.journey-bottom-reward > span {
    display: block;

    margin-bottom: 3px;

    color: #94a3b8;

    font-size: 5px;
}


.journey-bottom-reward > div {
    display: flex;

    gap: 5px;
}


.journey-bottom-reward b {
    padding:
        3px
        6px;

    border-radius: 6px;

    color: #455b73;

    background: #f4f8fc;

    font-size: 5.5px;
}


.journey-start-button {
    min-height: 34px;

    padding:
        0
        11px;

    display: flex;

    align-items: center;
    justify-content: center;

    gap: 7px;

    border-radius: 10px;

    color: white;

    background:
        linear-gradient(
            105deg,
            #2563eb,
            #06b6d4,
            #10b981
        );

    box-shadow:
        0 9px 20px
        rgba(37,99,235,.18);

    font-size: 6px;

    font-weight: 800;

    text-decoration: none;
}


.journey-start-button:hover {
    transform:
        translateY(-2px);
}


/* ========================================================= */
/* ANIMATIONS */
/* ========================================================= */

@keyframes heroFloatOne {

    0%,
    100% {
        translate: 0 0;
    }

    50% {
        translate: 0 -8px;
    }

}


@keyframes heroFloatTwo {

    0%,
    100% {
        translate: 0 0;
    }

    50% {
        translate: 0 7px;
    }

}


/* ========================================================= */
/* RESPONSIVE - LAPTOP */
/* ========================================================= */

@media (max-width: 1180px) {

    .material-journey-container {
        width:
            calc(100% - 44px) !important;
    }


    .material-journey-heading h2 {
        font-size:
            clamp(
                26px,
                3vw,
                34px
            );
    }


    .journey-path {
        gap: 10px;
    }


    .journey-level-card {
        min-height: 158px;

        padding: 12px;
    }


    .hero-layout-v2 {
        grid-template-columns:
            minmax(0,.9fr)
            minmax(460px,1.1fr);

        gap: 20px;
    }


    .hero-showcase {
        width: 520px;
        height: 500px;

        transform:
            scale(.90);
    }

}


/* ========================================================= */
/* RESPONSIVE - WINDOW LAPTOP SEMPIT */
/* ========================================================= */

@media (max-width: 980px) {

    .main-slider {
        height:
            calc(
                100dvh - 76px
            );

        min-height:
            560px;
    }


    .slide {
        overflow-y: auto;
        overflow-x: hidden;
    }


    .material-journey-container {
        width:
            calc(100% - 36px) !important;

        padding:
            24px 0
            55px !important;
    }


    .material-journey-heading {
        max-width: 700px;
    }


    .material-journey-heading h2 {
        font-size: 29px;
    }


    .material-journey-heading p {
        max-width: 560px;
    }


    .journey-gamification-bar {
        max-width: 680px;

        grid-template-columns:
            repeat(
                2,
                minmax(0,1fr)
            );

        gap: 4px;
    }


    .journey-game-divider {
        display: none;
    }


    .journey-path {
        max-width: 700px;

        grid-template-columns:
            repeat(
                2,
                minmax(0,1fr)
            );

        gap: 11px;
    }


    .journey-path-line {
        display: none;
    }


    .journey-level-card {
        min-height: 160px;
    }


    .journey-bottom-card {
        max-width: 700px;

        grid-template-columns:
            auto
            minmax(0,1fr)
            auto;
    }


    .journey-bottom-reward {
        display: none;
    }


    .hero-layout-v2 {
        display: flex;

        flex-direction: column;

        gap: 20px;

        padding-bottom: 70px;
    }


    .hero-text-v2 {
        margin: auto;

        text-align: center;
    }


    .hero-feature-strip,
    .hero-actions-v2 {
        justify-content: center;
    }


    .hero-image-v2 {
        min-height: 470px;
    }


    .hero-showcase {
        margin: auto;
    }

}


/* ========================================================= */
/* TABLET */
/* ========================================================= */

@media (max-width: 700px) {

    .material-journey-container {
        width:
            calc(100% - 28px) !important;
    }


    .material-journey-heading h2 {
        font-size: 27px;
    }


    .material-journey-heading p {
        max-width: 500px;

        font-size: 7.4px;
    }


    .journey-gamification-bar {
        grid-template-columns:
            repeat(
                2,
                minmax(0,1fr)
            );
    }


    .journey-path {
        max-width: 500px;

        grid-template-columns: 1fr;
    }


    .journey-level-card {
        min-height: 150px;
    }


    .journey-bottom-card {
        max-width: 500px;

        grid-template-columns:
            auto
            minmax(0,1fr);
    }


    .journey-start-button {
        grid-column:
            1 / -1;

        width: 100%;
    }


    .hero-feature-strip {
        display: grid;

        grid-template-columns: 1fr;

        max-width: 250px;

        margin:
            25px auto
            0;

        gap: 8px;
    }


    .hero-feature-divider {
        display: none;
    }


    .hero-feature-item {
        padding:
            8px
            10px;

        border:
            1px solid
            #e4edf7;

        border-radius: 12px;

        background:
            rgba(255,255,255,.72);
    }


    .hero-showcase {
        width: 540px;
        height: 500px;

        position: relative;

        left: 50%;

        margin-left: -270px;

        transform:
            scale(.70);

        transform-origin:
            top center;
    }


    .hero-image-v2 {
        min-height: 370px;
    }

}


/* ========================================================= */
/* MOBILE */
/* ========================================================= */

@media (max-width: 480px) {

    .main-slider {
        height:
            calc(
                100dvh - 76px
            );

        min-height: 520px;
    }


    .material-journey-container {
        width:
            calc(100% - 22px) !important;

        padding-top:
            22px !important;
    }


    .material-journey-heading h2 {
        font-size: 23px;

        letter-spacing:
            -.75px;
    }


    .material-journey-heading p {
        font-size: 7px;
    }


    .journey-gamification-bar {
        grid-template-columns: 1fr;
    }


    .journey-game-info {
        justify-content: flex-start;
    }


    .journey-level-main {
        grid-template-columns:
            42px
            minmax(0,1fr);
    }


    .journey-level-symbol {
        width: 40px;
        height: 40px;

        font-size: 16px;
    }


    .journey-level-content h3 {
        font-size: 9.5px;
    }


    .hero-title-v2 {
        font-size:
            37px !important;

        letter-spacing:
            -2px !important;
    }


    .hero-description-v2 {
        font-size:
            9.5px !important;
    }


    .hero-actions-v2 {
        width: 100%;

        flex-direction: column;
    }


    .hero-showcase {
        transform:
            scale(.60);
    }


    .hero-image-v2 {
        min-height: 320px;
    }

}


/* ========================================================= */
/* REDUCED MOTION */
/* ========================================================= */

@media (prefers-reduced-motion: reduce) {

    .hero-gamification-card {
        animation:
            none !important;
    }

}

</style>

@endpush



@push('scripts')

<script>

    let currentSlide = 0;

    const totalSlides = 2;

    const sliderTrack =
        document.getElementById(
            'sliderTrack'
        );

    const sliderDots =
        document.querySelectorAll(
            '.slider-dot'
        );

    const slider =
        document.getElementById(
            'mainSlider'
        );


    function goToSlide(index) {

        if (index < 0) {
            index =
                totalSlides - 1;
        }

        if (index >= totalSlides) {
            index = 0;
        }

        currentSlide =
            index;

        if (sliderTrack) {

            sliderTrack.style.transform =
                `translate3d(-${currentSlide * 100}%, 0, 0)`;

        }

        sliderDots.forEach(
            function (
                dot,
                dotIndex
            ) {

                dot.classList.toggle(
                    'active',
                    dotIndex === currentSlide
                );

            }
        );

    }


    function nextSlide() {

        goToSlide(
            currentSlide + 1
        );

    }


    function previousSlide() {

        goToSlide(
            currentSlide - 1
        );

    }


    let touchStartX = 0;
    let touchEndX = 0;


    if (slider) {

        slider.addEventListener(
            'touchstart',
            function (event) {

                touchStartX =
                    event
                        .changedTouches[0]
                        .screenX;

            },
            {
                passive: true
            }
        );


        slider.addEventListener(
            'touchend',
            function (event) {

                touchEndX =
                    event
                        .changedTouches[0]
                        .screenX;

                handleSwipe();

            },
            {
                passive: true
            }
        );

    }


    function handleSwipe() {

        const difference =
            touchStartX -
            touchEndX;

        if (difference > 60) {
            nextSlide();
        }

        if (difference < -60) {
            previousSlide();
        }

    }


    function openMaterial(
        title,
        icon,
        description,
        points
    ) {

        const modal =
            document.getElementById(
                'materialModal'
            );

        const modalTitle =
            document.getElementById(
                'modalTitle'
            );

        const modalIcon =
            document.getElementById(
                'modalIcon'
            );

        const modalDescription =
            document.getElementById(
                'modalDescription'
            );

        const pointsContainer =
            document.getElementById(
                'modalPoints'
            );


        if (
            !modal
            ||
            !modalTitle
            ||
            !modalIcon
            ||
            !modalDescription
            ||
            !pointsContainer
        ) {
            return;
        }


        modalTitle.textContent =
            title;

        modalIcon.textContent =
            icon;

        modalDescription.textContent =
            description;

        pointsContainer.innerHTML =
            '';


        points
            .split('|')
            .forEach(
                function (point) {

                    const item =
                        document.createElement(
                            'div'
                        );

                    item.className =
                        'modal-point';

                    item.textContent =
                        point;

                    pointsContainer.appendChild(
                        item
                    );

                }
            );


        modal.classList.add(
            'show'
        );

        document.body.classList.add(
            'modal-open'
        );

    }


    function closeMaterial() {

        const modal =
            document.getElementById(
                'materialModal'
            );

        if (!modal) {
            return;
        }

        modal.classList.remove(
            'show'
        );

        document.body.classList.remove(
            'modal-open'
        );

    }


    document.addEventListener(
        'keydown',
        function (event) {

            const modal =
                document.getElementById(
                    'materialModal'
                );

            const modalOpen =
                modal
                &&
                modal.classList.contains(
                    'show'
                );


            if (
                event.key === 'Escape'
                &&
                modalOpen
            ) {

                closeMaterial();

                return;

            }


            if (modalOpen) {
                return;
            }


            if (
                event.key ===
                'ArrowRight'
            ) {

                nextSlide();

            }


            if (
                event.key ===
                'ArrowLeft'
            ) {

                previousSlide();

            }

        }
    );


    /*
    |--------------------------------------------------------------------------
    | JAGA POSISI SLIDE SAAT UKURAN WINDOW BERUBAH
    |--------------------------------------------------------------------------
    |
    | Ini penting agar ketika browser dikecilkan/dibesarkan,
    | slide kedua tetap berada tepat pada posisinya dan slide pertama
    | tidak mengintip dari sisi kiri.
    |
    */

    window.addEventListener(
        'resize',
        function () {

            if (sliderTrack) {

                sliderTrack.style.transform =
                    `translate3d(-${currentSlide * 100}%, 0, 0)`;

            }

        }
    );

</script>

@endpush