@extends('layouts.mahasiswa')

@section('title', 'Badge - HIMDAS')

@section('content')

<section class="badge-page">

    <div class="badge-container">

        {{-- ===================================================== --}}
        {{-- HERO --}}
        {{-- ===================================================== --}}

        <div class="badge-hero">

            <div class="badge-hero-content">

                <span class="badge-eyebrow">
                    PENCAPAIAN HIMDAS
                </span>

                <h1>
                    Koleksi Badge
                </h1>

                <p>
                    Badge diperoleh secara otomatis berdasarkan aktivitas
                    pembelajaranmu di HIMDAS. Selesaikan materi, Challenge Harian,
                    dan Latihan Akhir untuk membuka seluruh badge.
                </p>

            </div>


            <div class="badge-class-card">

                <span>
                    KELAS AKTIF
                </span>

                <strong>
                    {{ $kelas->nama_kelas }}
                </strong>

                <small>
                    {{ $kelas->kode_kelas }}
                </small>

            </div>

        </div>


        {{-- ===================================================== --}}
        {{-- RINGKASAN --}}
        {{-- ===================================================== --}}

        <div class="badge-summary-grid">

            {{-- BADGE DIPEROLEH --}}

            <div class="badge-summary-card">

                <div class="badge-summary-icon">
                    🏅
                </div>

                <div>

                    <span>
                        BADGE DIPEROLEH
                    </span>

                    <strong>
                        {{ $stats['earned'] }}/{{ $stats['total'] }}
                    </strong>

                    <small>
                        Total pencapaianmu
                    </small>

                </div>

            </div>


            {{-- MATERI --}}

            <div class="badge-summary-card">

                <div class="badge-summary-icon">
                    📘
                </div>

                <div>

                    <span>
                        MATERI SELESAI
                    </span>

                    <strong>
                        {{ $stats['subbab_selesai'] }}/6
                    </strong>

                    <small>
                        Subbab terselesaikan
                    </small>

                </div>

            </div>


            {{-- STREAK --}}

            <div class="badge-summary-card">

                <div class="badge-summary-icon">
                    🔥
                </div>

                <div>

                    <span>
                        CHALLENGE STREAK
                    </span>

                    <strong>
                        {{ $stats['challenge_streak'] }} Hari
                    </strong>

                    <small>
                        Target badge: 3 hari
                    </small>

                </div>

            </div>


            {{-- LATIHAN AKHIR --}}

            <div class="badge-summary-card">

                <div class="badge-summary-icon">
                    🏆
                </div>

                <div>

                    <span>
                        LATIHAN AKHIR
                    </span>

                    <strong>

                        @if($stats['latihan_nilai'] !== null)

                            {{
                                rtrim(
                                    rtrim(
                                        number_format(
                                            $stats['latihan_nilai'],
                                            2,
                                            ',',
                                            '.'
                                        ),
                                        '0'
                                    ),
                                    ','
                                )
                            }}%

                        @else

                            Belum

                        @endif

                    </strong>

                    <small>
                        {{
                            $stats['latihan_lulus']
                                ? 'Lulus'
                                : 'Target minimal 80%'
                        }}
                    </small>

                </div>

            </div>

        </div>


        {{-- ===================================================== --}}
        {{-- PROGRESS TOTAL BADGE --}}
        {{-- ===================================================== --}}

        <div class="badge-total-progress-card">

            <div class="badge-total-progress-heading">

                <div>

                    <span>
                        PROGRESS BADGE
                    </span>

                    <strong>
                        {{ $stats['earned'] }}
                        dari
                        {{ $stats['total'] }}
                        badge telah diperoleh
                    </strong>

                </div>

                <b>
                    {{ $stats['percent'] }}%
                </b>

            </div>


            <progress
                class="badge-total-progress"
                value="{{ $stats['percent'] }}"
                max="100"
            ></progress>

        </div>


        {{-- ===================================================== --}}
        {{-- HEADER BADGE --}}
        {{-- ===================================================== --}}

        <div class="badge-section-heading">

            <div>

                <span>
                    BADGE HIMDAS
                </span>

                <h2>
                    Semua Pencapaian
                </h2>

                <p>
                    Setiap badge memiliki syarat yang berbeda.
                    Badge yang belum diperoleh tetap menampilkan progress
                    agar kamu mengetahui apa yang harus diselesaikan.
                </p>

            </div>


            <div class="badge-legend">

                <span class="earned">
                    ✓ Diperoleh
                </span>

                <span class="locked">
                    🔒 Belum Diperoleh
                </span>

            </div>

        </div>


        {{-- ===================================================== --}}
        {{-- GRID BADGE --}}
        {{-- ===================================================== --}}

        <div class="badge-grid">

            @foreach($badges as $badge)

                @php

                    $badgePercent =
                        $badge['progress_target'] > 0
                            ? (int) round(
                                (
                                    $badge['progress_current']
                                    /
                                    $badge['progress_target']
                                )
                                *
                                100
                            )
                            : 0;


                    $badgePercent =
                        max(
                            0,
                            min(
                                100,
                                $badgePercent
                            )
                        );

                @endphp


                <article
                    class="
                        badge-card
                        {{ $badge['unlocked'] ? 'unlocked' : 'locked' }}
                    "
                >

                    {{-- TOP --}}

                    <div class="badge-card-top">

                        <span class="badge-number">
                            BADGE
                            {{
                                str_pad(
                                    $badge['number'],
                                    2,
                                    '0',
                                    STR_PAD_LEFT
                                )
                            }}
                        </span>

                        <span class="badge-category">
                            {{ $badge['category'] }}
                        </span>

                    </div>


                    {{-- ICON --}}

                    <div
                        class="
                            badge-icon
                            {{ $badge['unlocked'] ? 'unlocked' : 'locked' }}
                        "
                    >
                        {{ $badge['icon'] }}
                    </div>


                    {{-- STATUS --}}

                    @if($badge['unlocked'])

                        <div class="badge-status earned">
                            ✓ DIPEROLEH
                        </div>

                    @else

                        <div class="badge-status locked">
                            🔒 BELUM DIPEROLEH
                        </div>

                    @endif


                    {{-- TITLE --}}

                    <h3>
                        {{ $badge['title'] }}
                    </h3>


                    {{-- DESCRIPTION --}}

                    <p class="badge-description">
                        {{ $badge['description'] }}
                    </p>


                    {{-- REQUIREMENT --}}

                    <div class="badge-requirement">

                        <span>
                            SYARAT
                        </span>

                        <p>
                            {{ $badge['requirement'] }}
                        </p>

                    </div>


                    {{-- PROGRESS --}}

                    <div class="badge-progress-box">

                        <div class="badge-progress-heading">

                            <span>
                                PROGRESS
                            </span>

                            <strong>
                                {{ $badgePercent }}%
                            </strong>

                        </div>


                        <progress
                            class="
                                badge-progress
                                {{ $badge['unlocked'] ? 'complete' : '' }}
                            "
                            value="{{ $badgePercent }}"
                            max="100"
                        ></progress>


                        <small>
                            {{ $badge['progress_label'] }}
                        </small>

                    </div>


                    {{-- HIMDAS CHAMPION INFO --}}

                    @if($badge['key'] === 'himdas-champion')

                        <div class="badge-champion-info">

                            <div>

                                <span>
                                    NILAI TERBAIK
                                </span>

                                <strong>

                                    @if(
                                        isset($badge['best_score'])
                                        &&
                                        $badge['best_score'] !== null
                                    )

                                        {{
                                            rtrim(
                                                rtrim(
                                                    number_format(
                                                        $badge['best_score'],
                                                        2,
                                                        ',',
                                                        '.'
                                                    ),
                                                    '0'
                                                ),
                                                ','
                                            )
                                        }}%

                                    @else

                                        -

                                    @endif

                                </strong>

                            </div>


                            <div>

                                <span>
                                    TARGET
                                </span>

                                <strong>
                                    ≥ 80%
                                </strong>

                            </div>

                        </div>

                    @endif


                    {{-- TANGGAL DIPEROLEH --}}

                    @if(
                        $badge['unlocked']
                        &&
                        isset($badge['earned_at'])
                        &&
                        $badge['earned_at']
                    )

                        <div class="badge-earned-date">

                            <span>
                                🗓
                            </span>

                            <small>
                                Diperoleh {{ $badge['earned_at'] }}
                            </small>

                        </div>

                    @endif

                </article>

            @endforeach

        </div>


        {{-- ===================================================== --}}
        {{-- INFORMASI --}}
        {{-- ===================================================== --}}

        <div class="badge-info-card">

            <div class="badge-info-icon">
                💡
            </div>

            <div>

                <h3>
                    Cara Mendapatkan Badge
                </h3>

                <p>
                    Badge tidak perlu diklaim secara manual.
                    Sistem HIMDAS akan membuka badge secara otomatis
                    ketika syaratnya terpenuhi. Teruskan belajar,
                    kerjakan Challenge Harian, dan selesaikan Latihan Akhir
                    untuk melengkapi seluruh koleksimu.
                </p>

            </div>

        </div>

    </div>

</section>

@endsection



@push('styles')

<style>

/* ========================================================= */
/* WARNA UTAMA BADGE HIMDAS */
/* ========================================================= */

.badge-page {
    --badge-navy: #172554;
    --badge-navy-dark: #0f1d46;

    --badge-blue: #2563eb;
    --badge-blue-dark: #1d4ed8;
    --badge-blue-light: #3b82f6;

    --badge-soft: #eff6ff;
    --badge-soft-2: #dbeafe;
    --badge-soft-3: #bfdbfe;

    --badge-text: #0f172a;
    --badge-muted: #64748b;
    --badge-muted-light: #94a3b8;

    --badge-border: #dbe4ee;
    --badge-border-blue: #bfdbfe;

    --badge-success: #166534;
    --badge-success-bg: #dcfce7;

    --badge-danger: #991b1b;
    --badge-danger-bg: #fee2e2;

    width: 100%;

    padding: 32px;
}


/* ========================================================= */
/* CONTAINER */
/* ========================================================= */

.badge-container {
    width: 100%;
    max-width: 1280px;

    margin: 0 auto;
}


/* ========================================================= */
/* HERO */
/* ========================================================= */

.badge-hero {
    display: flex;
    align-items: stretch;
    justify-content: space-between;

    gap: 28px;

    padding: 32px;

    background:
        linear-gradient(
            135deg,
            #ffffff 0%,
            #f8fbff 55%,
            #eef6ff 100%
        );

    border:
        1px solid
        var(--badge-border-blue);

    border-radius: 24px;

    box-shadow:
        0 10px 30px
        rgba(15, 23, 42, .055);
}


.badge-hero-content {
    flex: 1;
}


.badge-eyebrow {
    display: inline-block;

    margin-bottom: 8px;

    color:
        var(--badge-blue);

    font-size: 12px;
    font-weight: 800;

    letter-spacing: 1px;
}


.badge-hero h1 {
    margin: 0;

    color:
        var(--badge-text);

    font-size: 34px;
    font-weight: 800;
}


.badge-hero p {
    max-width: 760px;

    margin:
        13px
        0
        0;

    color:
        var(--badge-muted);

    font-size: 14px;
    line-height: 1.8;
}


/* ========================================================= */
/* CLASS CARD */
/* ========================================================= */

.badge-class-card {
    width: 240px;

    padding: 24px;

    display: flex;
    flex-direction: column;
    justify-content: center;

    color: #ffffff;

    background:
        linear-gradient(
            135deg,
            var(--badge-navy),
            var(--badge-blue-dark)
        );

    border:
        1px solid
        rgba(255, 255, 255, .12);

    border-radius: 20px;

    box-shadow:
        0 12px 26px
        rgba(37, 99, 235, .20);
}


.badge-class-card span {
    font-size: 10px;
    font-weight: 800;

    letter-spacing: .8px;

    opacity: .78;
}


.badge-class-card strong {
    margin-top: 8px;

    font-size: 20px;
    font-weight: 800;
}


.badge-class-card small {
    margin-top: 7px;

    font-size: 11px;

    opacity: .8;
}


/* ========================================================= */
/* SUMMARY */
/* ========================================================= */

.badge-summary-grid {
    display: grid;

    grid-template-columns:
        repeat(
            4,
            minmax(0, 1fr)
        );

    gap: 16px;

    margin-top: 20px;
}


.badge-summary-card {
    min-height: 116px;

    display: flex;
    align-items: center;

    gap: 15px;

    padding: 20px;

    background: #ffffff;

    border:
        1px solid
        var(--badge-border);

    border-radius: 18px;

    box-shadow:
        0 8px 24px
        rgba(15, 23, 42, .04);

    transition:
        border-color .2s ease,
        transform .2s ease,
        box-shadow .2s ease;
}


.badge-summary-card:hover {
    transform:
        translateY(-2px);

    border-color:
        #bfdbfe;

    box-shadow:
        0 12px 28px
        rgba(37, 99, 235, .07);
}


.badge-summary-icon {
    width: 48px;
    height: 48px;

    flex-shrink: 0;

    display: flex;
    align-items: center;
    justify-content: center;

    background:
        linear-gradient(
            135deg,
            #eff6ff,
            #dbeafe
        );

    border:
        1px solid
        #dbeafe;

    border-radius: 14px;

    font-size: 22px;
}


.badge-summary-card span {
    display: block;

    color:
        var(--badge-muted);

    font-size: 9px;
    font-weight: 800;

    letter-spacing: .5px;
}


.badge-summary-card strong {
    display: block;

    margin-top: 4px;

    color:
        var(--badge-text);

    font-size: 21px;
    font-weight: 800;
}


.badge-summary-card small {
    display: block;

    margin-top: 4px;

    color:
        var(--badge-muted-light);

    font-size: 10px;
}


/* ========================================================= */
/* TOTAL PROGRESS */
/* ========================================================= */

.badge-total-progress-card {
    margin-top: 18px;

    padding: 20px;

    background: #ffffff;

    border:
        1px solid
        var(--badge-border);

    border-radius: 17px;

    box-shadow:
        0 7px 22px
        rgba(15, 23, 42, .035);
}


.badge-total-progress-heading {
    display: flex;
    align-items: center;
    justify-content: space-between;

    gap: 20px;

    margin-bottom: 12px;
}


.badge-total-progress-heading span {
    display: block;

    color:
        var(--badge-muted);

    font-size: 9px;
    font-weight: 800;

    letter-spacing: .5px;
}


.badge-total-progress-heading strong {
    display: block;

    margin-top: 4px;

    color:
        var(--badge-text);

    font-size: 13px;
}


.badge-total-progress-heading b {
    color:
        var(--badge-blue);

    font-size: 18px;
}


.badge-total-progress {
    width: 100%;
    height: 12px;

    border: none;

    appearance: none;
    -webkit-appearance: none;
}


.badge-total-progress::-webkit-progress-bar {
    background: #e2e8f0;

    border-radius: 999px;
}


.badge-total-progress::-webkit-progress-value {
    background:
        linear-gradient(
            90deg,
            var(--badge-blue-light),
            var(--badge-blue),
            var(--badge-navy)
        );

    border-radius: 999px;
}


.badge-total-progress::-moz-progress-bar {
    background:
        linear-gradient(
            90deg,
            var(--badge-blue-light),
            var(--badge-blue),
            var(--badge-navy)
        );

    border-radius: 999px;
}


/* ========================================================= */
/* SECTION HEADING */
/* ========================================================= */

.badge-section-heading {
    display: flex;
    align-items: flex-end;
    justify-content: space-between;

    gap: 20px;

    margin:
        30px
        0
        17px;
}


.badge-section-heading > div:first-child > span {
    color:
        var(--badge-blue);

    font-size: 10px;
    font-weight: 800;

    letter-spacing: .7px;
}


.badge-section-heading h2 {
    margin:
        5px
        0
        0;

    color:
        var(--badge-text);

    font-size: 25px;
    font-weight: 800;
}


.badge-section-heading p {
    max-width: 720px;

    margin:
        7px
        0
        0;

    color:
        var(--badge-muted);

    font-size: 12px;
    line-height: 1.7;
}


/* ========================================================= */
/* LEGEND */
/* ========================================================= */

.badge-legend {
    display: flex;

    gap: 7px;

    flex-wrap: wrap;
}


.badge-legend span {
    padding:
        7px
        11px;

    border-radius: 999px;

    font-size: 9px;
    font-weight: 800;
}


.badge-legend .earned {
    color:
        var(--badge-success);

    background:
        var(--badge-success-bg);
}


.badge-legend .locked {
    color: #64748b;

    background: #f1f5f9;
}


/* ========================================================= */
/* GRID */
/* ========================================================= */

.badge-grid {
    display: grid;

    grid-template-columns:
        repeat(
            3,
            minmax(0, 1fr)
        );

    gap: 18px;
}


/* ========================================================= */
/* BADGE CARD */
/* ========================================================= */

.badge-card {
    position: relative;

    min-height: 510px;

    display: flex;
    flex-direction: column;

    padding: 22px;

    overflow: hidden;

    background: #ffffff;

    border:
        1px solid
        var(--badge-border);

    border-radius: 20px;

    box-shadow:
        0 10px 28px
        rgba(15, 23, 42, .045);

    transition:
        transform .2s ease,
        box-shadow .2s ease,
        border-color .2s ease;
}


.badge-card:hover {
    transform:
        translateY(-3px);

    border-color:
        #93c5fd;

    box-shadow:
        0 15px 34px
        rgba(37, 99, 235, .10);
}


/* BADGE SUDAH TERBUKA */

.badge-card.unlocked {
    border-color:
        #bfdbfe;

    background:
        linear-gradient(
            180deg,
            #f8fbff 0%,
            #ffffff 42%
        );
}


/* GARIS AKSEN */

.badge-card.unlocked::before {
    content: '';

    position: absolute;

    top: 0;
    left: 0;
    right: 0;

    height: 4px;

    background:
        linear-gradient(
            90deg,
            var(--badge-navy),
            var(--badge-blue)
        );
}


/* BADGE TERKUNCI */

.badge-card.locked {
    background:
        #fbfcfe;

    border-color:
        #e2e8f0;
}


/* ========================================================= */
/* CARD TOP */
/* ========================================================= */

.badge-card-top {
    display: flex;
    align-items: center;
    justify-content: space-between;

    gap: 10px;
}


.badge-number {
    color:
        var(--badge-muted-light);

    font-size: 8px;
    font-weight: 800;

    letter-spacing: .6px;
}


.badge-category {
    padding:
        6px
        9px;

    color:
        var(--badge-blue-dark);

    background:
        var(--badge-soft);

    border:
        1px solid
        var(--badge-soft-2);

    border-radius: 999px;

    font-size: 8px;
    font-weight: 800;
}


/* ========================================================= */
/* BADGE ICON */
/* ========================================================= */

.badge-icon {
    width: 82px;
    height: 82px;

    margin:
        22px
        auto
        13px;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 50%;

    font-size: 38px;

    transition:
        transform .2s ease;
}


.badge-card:hover .badge-icon {
    transform:
        scale(1.04);
}


/* ICON DIPEROLEH */

.badge-icon.unlocked {
    background:
        linear-gradient(
            135deg,
            #eff6ff 0%,
            #dbeafe 55%,
            #bfdbfe 100%
        );

    border:
        4px solid
        #ffffff;

    outline:
        1px solid
        #bfdbfe;

    box-shadow:
        0 8px 24px
        rgba(37, 99, 235, .18);
}


/* ICON TERKUNCI */

.badge-icon.locked {
    filter:
        grayscale(1);

    opacity: .42;

    background:
        #e2e8f0;

    border:
        4px solid
        #ffffff;

    outline:
        1px solid
        #dbe4ee;
}


/* ========================================================= */
/* STATUS */
/* ========================================================= */

.badge-status {
    width: max-content;

    margin:
        0
        auto
        10px;

    padding:
        6px
        10px;

    border-radius: 999px;

    font-size: 8px;
    font-weight: 800;

    letter-spacing: .5px;
}


.badge-status.earned {
    color:
        var(--badge-success);

    background:
        var(--badge-success-bg);

    border:
        1px solid
        #bbf7d0;
}


.badge-status.locked {
    color: #64748b;

    background:
        #f1f5f9;

    border:
        1px solid
        #e2e8f0;
}


/* ========================================================= */
/* TEXT */
/* ========================================================= */

.badge-card h3 {
    margin: 0;

    text-align: center;

    color:
        var(--badge-text);

    font-size: 19px;
    font-weight: 800;

    line-height: 1.4;
}


.badge-description {
    margin:
        9px
        0
        0;

    text-align: center;

    color:
        var(--badge-muted);

    font-size: 11px;
    line-height: 1.7;
}


/* ========================================================= */
/* REQUIREMENT */
/* ========================================================= */

.badge-requirement {
    margin-top: 18px;

    padding: 14px;

    background:
        #f8fafc;

    border:
        1px solid
        #e2e8f0;

    border-radius: 13px;
}


.badge-card.unlocked .badge-requirement {
    background:
        #f8fbff;

    border-color:
        #dbeafe;
}


.badge-requirement span {
    color:
        var(--badge-blue);

    font-size: 8px;
    font-weight: 800;

    letter-spacing: .6px;
}


.badge-requirement p {
    margin:
        5px
        0
        0;

    color: #475569;

    font-size: 10px;
    line-height: 1.6;
}


/* ========================================================= */
/* INDIVIDUAL PROGRESS */
/* ========================================================= */

.badge-progress-box {
    margin-top: auto;

    padding-top: 18px;
}


.badge-progress-heading {
    display: flex;
    align-items: center;
    justify-content: space-between;

    margin-bottom: 8px;
}


.badge-progress-heading span {
    color:
        var(--badge-muted);

    font-size: 8px;
    font-weight: 800;
}


.badge-progress-heading strong {
    color:
        var(--badge-blue-dark);

    font-size: 10px;
    font-weight: 800;
}


.badge-progress {
    width: 100%;
    height: 9px;

    border: none;

    appearance: none;
    -webkit-appearance: none;
}


.badge-progress::-webkit-progress-bar {
    background:
        #e2e8f0;

    border-radius: 999px;
}


/* PROGRESS BELUM SELESAI */

.badge-progress::-webkit-progress-value {
    background:
        linear-gradient(
            90deg,
            #93c5fd,
            #60a5fa
        );

    border-radius: 999px;
}


/* PROGRESS COMPLETE */

.badge-progress.complete::-webkit-progress-value {
    background:
        linear-gradient(
            90deg,
            var(--badge-blue-light),
            var(--badge-blue),
            var(--badge-navy)
        );
}


.badge-progress::-moz-progress-bar {
    background:
        linear-gradient(
            90deg,
            #93c5fd,
            #60a5fa
        );

    border-radius: 999px;
}


.badge-progress.complete::-moz-progress-bar {
    background:
        linear-gradient(
            90deg,
            var(--badge-blue-light),
            var(--badge-blue),
            var(--badge-navy)
        );
}


.badge-progress-box > small {
    display: block;

    margin-top: 7px;

    color:
        var(--badge-muted);

    font-size: 9px;
    line-height: 1.5;
}


/* ========================================================= */
/* HIMDAS CHAMPION INFO */
/* ========================================================= */

.badge-champion-info {
    display: grid;

    grid-template-columns:
        repeat(
            2,
            minmax(0, 1fr)
        );

    gap: 9px;

    margin-top: 13px;
}


.badge-champion-info > div {
    padding: 10px;

    text-align: center;

    background:
        var(--badge-soft);

    border:
        1px solid
        var(--badge-soft-2);

    border-radius: 10px;
}


.badge-champion-info span {
    display: block;

    color:
        var(--badge-blue);

    font-size: 7px;
    font-weight: 800;

    letter-spacing: .4px;
}


.badge-champion-info strong {
    display: block;

    margin-top: 3px;

    color:
        var(--badge-text);

    font-size: 11px;
}


/* ========================================================= */
/* EARNED DATE */
/* ========================================================= */

.badge-earned-date {
    display: flex;
    align-items: center;
    justify-content: center;

    gap: 6px;

    margin-top: 12px;

    color:
        var(--badge-blue);
}


.badge-earned-date small {
    font-size: 9px;
    font-weight: 700;
}


/* ========================================================= */
/* INFORMATION */
/* ========================================================= */

.badge-info-card {
    display: flex;
    align-items: flex-start;

    gap: 16px;

    margin-top: 25px;

    padding: 22px;

    background:
        linear-gradient(
            135deg,
            #eff6ff,
            #f8fbff
        );

    border:
        1px solid
        #bfdbfe;

    border-radius: 18px;

    box-shadow:
        0 8px 24px
        rgba(37, 99, 235, .04);
}


.badge-info-icon {
    width: 48px;
    height: 48px;

    flex-shrink: 0;

    display: flex;
    align-items: center;
    justify-content: center;

    background: #ffffff;

    border:
        1px solid
        #dbeafe;

    border-radius: 14px;

    box-shadow:
        0 5px 15px
        rgba(37, 99, 235, .08);

    font-size: 22px;
}


.badge-info-card h3 {
    margin: 0;

    color:
        var(--badge-text);

    font-size: 15px;
    font-weight: 800;
}


.badge-info-card p {
    max-width: 850px;

    margin:
        6px
        0
        0;

    color:
        var(--badge-muted);

    font-size: 11px;
    line-height: 1.7;
}


/* ========================================================= */
/* RESPONSIVE - TABLET */
/* ========================================================= */

@media (max-width: 1100px) {

    .badge-summary-grid {
        grid-template-columns:
            repeat(
                2,
                minmax(0, 1fr)
            );
    }


    .badge-grid {
        grid-template-columns:
            repeat(
                2,
                minmax(0, 1fr)
            );
    }

}


/* ========================================================= */
/* RESPONSIVE - MOBILE */
/* ========================================================= */

@media (max-width: 760px) {

    .badge-page {
        padding: 18px;
    }


    .badge-hero {
        flex-direction: column;

        padding: 24px;
    }


    .badge-hero h1 {
        font-size: 28px;
    }


    .badge-hero p {
        font-size: 12px;
    }


    .badge-class-card {
        width: 100%;
    }


    .badge-summary-grid {
        grid-template-columns: 1fr;
    }


    .badge-total-progress-heading {
        align-items: flex-start;
    }


    .badge-section-heading {
        flex-direction: column;
        align-items: stretch;
    }


    .badge-grid {
        grid-template-columns: 1fr;
    }


    .badge-card {
        min-height: auto;
    }


    .badge-info-card {
        flex-direction: column;
    }

}

</style>

@endpush