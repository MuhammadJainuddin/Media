@extends('layouts.mahasiswa')

@section('title', 'Challenge Harian - HIMDAS')

@section('content')

<section class="challenge-page">

    <div class="challenge-container">

        {{-- ===================================================== --}}
        {{-- HERO --}}
        {{-- ===================================================== --}}

        <div class="challenge-hero">

            <div class="challenge-hero-content">

                <span class="challenge-eyebrow">
                    CHALLENGE HARIAN
                </span>

                <h1>
                    Tantangan HIMDAS
                </h1>

                <p>
                    Asah kemampuanmu setiap hari melalui
                    {{ $dailyTotal }} challenge acak dari seluruh materi HIMDAS.
                    Setiap subbab memberikan satu tantangan dan soal akan
                    berubah setiap hari.
                </p>

                <small>
                    {{ $todayLabel }}
                </small>

            </div>


            <div class="challenge-class-card">

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
        {{-- ALERT --}}
        {{-- ===================================================== --}}

        @if(session('success'))

            <div class="challenge-alert success">
                ✓ {{ session('success') }}
            </div>

        @endif


        @if(session('error'))

            <div class="challenge-alert error">
                {{ session('error') }}
            </div>

        @endif


        {{-- ===================================================== --}}
        {{-- STATISTIK --}}
        {{-- ===================================================== --}}

        <div class="challenge-stat-grid">


            {{-- SELESAI HARI INI --}}

            <div class="challenge-stat-card">

                <div class="challenge-stat-icon">
                    ⚡
                </div>

                <div>

                    <span>
                        SELESAI HARI INI
                    </span>

                    <strong>
                        {{ $completedCount }}/{{ $dailyTotal }}
                    </strong>

                    <small>
                        Challenge harian
                    </small>

                </div>

            </div>


            {{-- XP HARI INI --}}

            <div class="challenge-stat-card">

                <div class="challenge-stat-icon">
                    ⭐
                </div>

                <div>

                    <span>
                        XP HARI INI
                    </span>

                    <strong>
                        {{ $xpToday }} XP
                    </strong>

                    <small>
                        Termasuk bonus harian
                    </small>

                </div>

            </div>


            {{-- STREAK --}}

            <div class="challenge-stat-card">

                <div class="challenge-stat-icon">
                    🔥
                </div>

                <div>

                    <span>
                        STREAK
                    </span>

                    <strong>
                        {{ $streak }} Hari
                    </strong>

                    <small>
                        Selesaikan {{ $dailyTotal }} challenge per hari
                    </small>

                </div>

            </div>


            {{-- BONUS HARIAN --}}

            <div class="challenge-stat-card">

                <div class="challenge-stat-icon">
                    🎁
                </div>

                <div>

                    <span>
                        BONUS HARIAN
                    </span>

                    <strong>
                        {{ $bonusAwarded ? 'Diperoleh' : '+50 XP' }}
                    </strong>

                    <small>
                        Selesaikan semua challenge hari ini
                    </small>

                </div>

            </div>

        </div>


        {{-- ===================================================== --}}
        {{-- PROGRESS --}}
        {{-- ===================================================== --}}

        <div class="challenge-progress-card">

            <div class="challenge-progress-heading">

                <div>

                    <span>
                        PROGRESS CHALLENGE HARI INI
                    </span>

                    <strong>
                        {{ $completedCount }}
                        dari
                        {{ $dailyTotal }}
                        challenge selesai
                    </strong>

                </div>

                <b>
                    {{ $progress }}%
                </b>

            </div>


            <progress
                class="challenge-progress"
                value="{{ $progress }}"
                max="100"
            ></progress>

        </div>


        {{-- ===================================================== --}}
        {{-- HEADER PAKET --}}
        {{-- ===================================================== --}}

        <div class="challenge-section-heading">

            <div>

                <span>
                    PAKET HARI INI
                </span>

                <h2>
                    {{ $dailyTotal }} Challenge Acak
                </h2>

                <p>
                    Terdapat satu challenge dari masing-masing Subbab 1 sampai
                    Subbab 6. Tingkat kesulitan menentukan XP yang diperoleh.
                </p>

            </div>


            <div class="challenge-xp-legend">

                <span class="easy">
                    Mudah +10 XP
                </span>

                <span class="medium">
                    Sedang +20 XP
                </span>

                <span class="hard">
                    Sulit +30 XP
                </span>

            </div>

        </div>


        {{-- ===================================================== --}}
        {{-- CHALLENGE GRID --}}
        {{-- ===================================================== --}}

        <div class="challenge-grid">

            @foreach($dailyChallenges as $index => $challenge)

                @php

                    $difficultyClass =
                        match ($challenge['difficulty']) {
                            'mudah' => 'easy',
                            'sedang' => 'medium',
                            default => 'hard',
                        };


                    $challengeIcon =
                        match ((int) $challenge['subbab']) {
                            1 => '∈',
                            2 => '{ }',
                            3 => '◯',
                            4 => '⊂',
                            5 => '∪',
                            6 => '★',
                            default => '⚡',
                        };

                @endphp


                <article
                    class="
                        challenge-card
                        {{ $challenge['completed'] ? 'completed' : '' }}
                    "
                >

                    {{-- ============================================= --}}
                    {{-- TOP --}}
                    {{-- ============================================= --}}

                    <div class="challenge-card-top">

                        <div class="challenge-number">

                            {{
                                str_pad(
                                    $index + 1,
                                    2,
                                    '0',
                                    STR_PAD_LEFT
                                )
                            }}

                        </div>


                        <span
                            class="
                                challenge-difficulty
                                {{ $difficultyClass }}
                            "
                        >
                            {{ strtoupper($challenge['difficulty']) }}
                        </span>

                    </div>


                    {{-- ============================================= --}}
                    {{-- ICON --}}
                    {{-- ============================================= --}}

                    <div class="challenge-card-symbol">
                        {{ $challengeIcon }}
                    </div>


                    {{-- ============================================= --}}
                    {{-- SUBBAB --}}
                    {{-- ============================================= --}}

                    <span class="challenge-subchapter">
                        SUBBAB {{ $challenge['subbab'] }}
                    </span>


                    {{-- ============================================= --}}
                    {{-- TITLE --}}
                    {{-- ============================================= --}}

                    <h3>
                        {{ $challenge['title'] }}
                    </h3>


                    {{-- ============================================= --}}
                    {{-- QUESTION PREVIEW --}}
                    {{-- ============================================= --}}

                    <p>
                        {{ $challenge['question'] }}
                    </p>


                    {{-- ============================================= --}}
                    {{-- META --}}
                    {{-- ============================================= --}}

                    <div class="challenge-card-meta">

                        <span>

                            @if($challenge['type'] === 'choice')

                                Pilihan Ganda

                            @else

                                Jawaban Singkat

                            @endif

                        </span>


                        <strong>
                            +{{ $challenge['xp'] }} XP
                        </strong>

                    </div>


                    {{-- ============================================= --}}
                    {{-- STATUS / BUTTON --}}
                    {{-- ============================================= --}}

                    @if($challenge['completed'])


                        @if($challenge['is_correct'])

                            <div class="challenge-result correct">

                                <span>
                                    ✓
                                </span>

                                <div>

                                    <strong>
                                        Jawaban Benar
                                    </strong>

                                    <small>
                                        +{{ $challenge['xp_earned'] }} XP
                                    </small>

                                </div>

                            </div>

                        @else

                            <div class="challenge-result wrong">

                                <span>
                                    ×
                                </span>

                                <div>

                                    <strong>
                                        Sudah Dikerjakan
                                    </strong>

                                    <small>
                                        Jawaban belum tepat
                                    </small>

                                </div>

                            </div>

                        @endif


                    @else

                        <a
                            href="{{
                                route(
                                    'mahasiswa.challenge.show',
                                    [
                                        'key' =>
                                            $challenge['key']
                                    ]
                                )
                            }}"
                            class="challenge-start-button"
                        >

                            <span>
                                Mulai Challenge
                            </span>

                            <b>
                                →
                            </b>

                        </a>

                    @endif

                </article>

            @endforeach

        </div>


        {{-- ===================================================== --}}
        {{-- COMPLETE --}}
        {{-- ===================================================== --}}

        @if($completedCount >= $dailyTotal)

            <div class="challenge-complete-card">

                <div class="challenge-complete-icon">
                    🏆
                </div>

                <span>
                    DAILY COMPLETE
                </span>

                <h2>
                    Challenge Hari Ini Selesai!
                </h2>

                <p>
                    Kamu telah menyelesaikan seluruh
                    {{ $dailyTotal }} challenge hari ini.
                    Paket challenge baru akan dipilih secara otomatis
                    pada hari berikutnya.
                </p>


                @if($bonusAwarded)

                    <strong>
                        🎁 Bonus +50 XP sudah diberikan.
                    </strong>

                @endif

            </div>

        @endif

    </div>

</section>

@endsection



@push('styles')

<style>

/* ========================================================= */
/* PAGE */
/* ========================================================= */

.challenge-page {
    width: 100%;
    padding: 32px;
}

.challenge-container {
    width: 100%;
    max-width: 1280px;
    margin: 0 auto;
}


/* ========================================================= */
/* HERO */
/* ========================================================= */

.challenge-hero {
    display: flex;
    align-items: stretch;
    justify-content: space-between;

    gap: 28px;

    padding: 32px;

    background:
        linear-gradient(
            135deg,
            #ffffff,
            #f6f4ff
        );

    border: 1px solid #e4def8;

    border-radius: 24px;

    box-shadow:
        0 10px 30px
        rgba(15, 23, 42, 0.06);
}

.challenge-hero-content {
    flex: 1;
}

.challenge-eyebrow {
    display: inline-block;

    margin-bottom: 8px;

    color: #7c3aed;

    font-size: 12px;
    font-weight: 800;
    letter-spacing: 1px;
}

.challenge-hero h1 {
    margin: 0;

    color: #0f172a;

    font-size: 34px;
    font-weight: 800;
}

.challenge-hero p {
    max-width: 760px;

    margin: 13px 0 0;

    color: #64748b;

    font-size: 14px;
    line-height: 1.8;
}

.challenge-hero small {
    display: block;

    margin-top: 13px;

    color: #475569;

    font-size: 12px;
    font-weight: 700;
}


/* ========================================================= */
/* CLASS CARD */
/* ========================================================= */

.challenge-class-card {
    width: 240px;

    padding: 24px;

    display: flex;
    flex-direction: column;
    justify-content: center;

    color: #ffffff;

    border-radius: 20px;

    background:
        linear-gradient(
            135deg,
            #4c1d95,
            #7c3aed
        );

    box-shadow:
        0 12px 26px
        rgba(109, 40, 217, 0.18);
}

.challenge-class-card span {
    font-size: 10px;
    font-weight: 800;
    letter-spacing: .8px;

    opacity: .8;
}

.challenge-class-card strong {
    margin-top: 8px;

    font-size: 20px;
    font-weight: 800;
}

.challenge-class-card small {
    margin-top: 7px;

    font-size: 11px;

    opacity: .8;
}


/* ========================================================= */
/* ALERT */
/* ========================================================= */

.challenge-alert {
    margin-top: 18px;

    padding: 14px 18px;

    border-radius: 14px;

    font-size: 13px;
    font-weight: 600;
}

.challenge-alert.success {
    color: #166534;

    background: #f0fdf4;

    border: 1px solid #bbf7d0;
}

.challenge-alert.error {
    color: #991b1b;

    background: #fef2f2;

    border: 1px solid #fecaca;
}


/* ========================================================= */
/* STATISTICS */
/* ========================================================= */

.challenge-stat-grid {
    display: grid;

    grid-template-columns:
        repeat(
            4,
            minmax(0, 1fr)
        );

    gap: 16px;

    margin-top: 20px;
}

.challenge-stat-card {
    min-height: 116px;

    display: flex;
    align-items: center;

    gap: 15px;

    padding: 20px;

    background: #ffffff;

    border: 1px solid #e2e8f0;

    border-radius: 18px;

    box-shadow:
        0 8px 24px
        rgba(15, 23, 42, .04);
}

.challenge-stat-icon {
    width: 48px;
    height: 48px;

    flex-shrink: 0;

    display: flex;
    align-items: center;
    justify-content: center;

    background: #f5f3ff;

    border-radius: 14px;

    font-size: 22px;
}

.challenge-stat-card span {
    display: block;

    color: #64748b;

    font-size: 9px;
    font-weight: 800;
    letter-spacing: .5px;
}

.challenge-stat-card strong {
    display: block;

    margin-top: 4px;

    color: #0f172a;

    font-size: 21px;
    font-weight: 800;
}

.challenge-stat-card small {
    display: block;

    margin-top: 4px;

    color: #94a3b8;

    font-size: 10px;
}


/* ========================================================= */
/* PROGRESS */
/* ========================================================= */

.challenge-progress-card {
    margin-top: 18px;

    padding: 20px;

    background: #ffffff;

    border: 1px solid #e2e8f0;

    border-radius: 17px;
}

.challenge-progress-heading {
    display: flex;
    align-items: center;
    justify-content: space-between;

    gap: 18px;

    margin-bottom: 12px;
}

.challenge-progress-heading span {
    display: block;

    color: #64748b;

    font-size: 9px;
    font-weight: 800;
}

.challenge-progress-heading strong {
    display: block;

    margin-top: 4px;

    color: #0f172a;

    font-size: 13px;
}

.challenge-progress-heading b {
    color: #7c3aed;

    font-size: 18px;
}

.challenge-progress {
    width: 100%;
    height: 12px;

    border: none;
}

.challenge-progress::-webkit-progress-bar {
    background: #e2e8f0;

    border-radius: 999px;
}

.challenge-progress::-webkit-progress-value {
    background:
        linear-gradient(
            90deg,
            #7c3aed,
            #2563eb
        );

    border-radius: 999px;
}

.challenge-progress::-moz-progress-bar {
    background:
        linear-gradient(
            90deg,
            #7c3aed,
            #2563eb
        );

    border-radius: 999px;
}


/* ========================================================= */
/* SECTION HEADING */
/* ========================================================= */

.challenge-section-heading {
    display: flex;
    align-items: flex-end;
    justify-content: space-between;

    gap: 20px;

    margin:
        30px
        0
        17px;
}

.challenge-section-heading > div:first-child > span {
    color: #7c3aed;

    font-size: 10px;
    font-weight: 800;
    letter-spacing: .7px;
}

.challenge-section-heading h2 {
    margin: 5px 0 0;

    color: #0f172a;

    font-size: 25px;
    font-weight: 800;
}

.challenge-section-heading p {
    max-width: 700px;

    margin: 7px 0 0;

    color: #64748b;

    font-size: 12px;
    line-height: 1.7;
}


/* ========================================================= */
/* XP LEGEND */
/* ========================================================= */

.challenge-xp-legend {
    display: flex;

    gap: 7px;

    flex-wrap: wrap;
}

.challenge-xp-legend span {
    padding: 7px 10px;

    border-radius: 999px;

    font-size: 9px;
    font-weight: 800;
}

.challenge-xp-legend .easy {
    color: #166534;

    background: #dcfce7;
}

.challenge-xp-legend .medium {
    color: #92400e;

    background: #fef3c7;
}

.challenge-xp-legend .hard {
    color: #991b1b;

    background: #fee2e2;
}


/* ========================================================= */
/* GRID */
/* ========================================================= */

.challenge-grid {
    display: grid;

    grid-template-columns:
        repeat(
            3,
            minmax(0, 1fr)
        );

    gap: 18px;
}


/* ========================================================= */
/* CARD */
/* ========================================================= */

.challenge-card {
    min-height: 365px;

    display: flex;
    flex-direction: column;

    padding: 22px;

    background: #ffffff;

    border: 1px solid #e2e8f0;

    border-radius: 20px;

    box-shadow:
        0 10px 28px
        rgba(15, 23, 42, .045);

    transition:
        transform .2s ease,
        box-shadow .2s ease,
        border-color .2s ease;
}

.challenge-card:hover {
    transform: translateY(-3px);

    border-color: #c4b5fd;

    box-shadow:
        0 15px 34px
        rgba(15, 23, 42, .08);
}

.challenge-card.completed {
    background: #fbfdff;
}


/* ========================================================= */
/* CARD TOP */
/* ========================================================= */

.challenge-card-top {
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.challenge-number {
    width: 42px;
    height: 42px;

    display: flex;
    align-items: center;
    justify-content: center;

    color: #ffffff;

    background: #172554;

    border-radius: 12px;

    font-size: 12px;
    font-weight: 800;
}

.challenge-difficulty {
    padding: 7px 10px;

    border-radius: 999px;

    font-size: 8px;
    font-weight: 800;
    letter-spacing: .5px;
}

.challenge-difficulty.easy {
    color: #166534;

    background: #dcfce7;
}

.challenge-difficulty.medium {
    color: #92400e;

    background: #fef3c7;
}

.challenge-difficulty.hard {
    color: #991b1b;

    background: #fee2e2;
}


/* ========================================================= */
/* SYMBOL */
/* ========================================================= */

.challenge-card-symbol {
    width: 60px;
    height: 60px;

    margin-top: 20px;

    display: flex;
    align-items: center;
    justify-content: center;

    color: #6d28d9;

    background:
        linear-gradient(
            135deg,
            #f5f3ff,
            #ede9fe
        );

    border-radius: 17px;

    font-size: 25px;
    font-weight: 800;
}


/* ========================================================= */
/* CONTENT */
/* ========================================================= */

.challenge-subchapter {
    margin-top: 16px;

    color: #7c3aed;

    font-size: 9px;
    font-weight: 800;
    letter-spacing: .7px;
}

.challenge-card h3 {
    margin: 6px 0 0;

    color: #0f172a;

    font-size: 18px;
    font-weight: 800;
    line-height: 1.4;
}

.challenge-card p {
    margin: 9px 0 0;

    color: #64748b;

    font-size: 11px;
    line-height: 1.7;
}


/* ========================================================= */
/* META */
/* ========================================================= */

.challenge-card-meta {
    display: flex;
    align-items: center;
    justify-content: space-between;

    gap: 12px;

    margin-top: auto;

    padding-top: 18px;
}

.challenge-card-meta span {
    color: #64748b;

    font-size: 9px;
    font-weight: 600;
}

.challenge-card-meta strong {
    color: #7c3aed;

    font-size: 11px;
    font-weight: 800;
}


/* ========================================================= */
/* START BUTTON */
/* ========================================================= */

.challenge-start-button {
    min-height: 43px;

    margin-top: 14px;

    display: flex;
    align-items: center;
    justify-content: space-between;

    padding: 0 16px;

    color: #ffffff;

    text-decoration: none;

    background:
        linear-gradient(
            135deg,
            #7c3aed,
            #2563eb
        );

    border-radius: 11px;

    font-size: 10px;
    font-weight: 800;

    transition:
        transform .2s ease,
        box-shadow .2s ease;
}

.challenge-start-button:hover {
    transform: translateY(-1px);

    box-shadow:
        0 8px 18px
        rgba(124, 58, 237, .20);
}

.challenge-start-button b {
    font-size: 15px;
}


/* ========================================================= */
/* RESULT */
/* ========================================================= */

.challenge-result {
    min-height: 53px;

    margin-top: 14px;

    display: flex;
    align-items: center;

    gap: 11px;

    padding: 10px 13px;

    border-radius: 11px;
}

.challenge-result > span {
    width: 30px;
    height: 30px;

    flex-shrink: 0;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 9px;

    font-size: 13px;
    font-weight: 800;
}

.challenge-result strong {
    display: block;

    font-size: 10px;
}

.challenge-result small {
    display: block;

    margin-top: 2px;

    font-size: 8px;
}

.challenge-result.correct {
    color: #166534;

    background: #f0fdf4;

    border: 1px solid #bbf7d0;
}

.challenge-result.correct > span {
    color: #ffffff;

    background: #16a34a;
}

.challenge-result.wrong {
    color: #991b1b;

    background: #fef2f2;

    border: 1px solid #fecaca;
}

.challenge-result.wrong > span {
    color: #ffffff;

    background: #dc2626;
}


/* ========================================================= */
/* DAILY COMPLETE */
/* ========================================================= */

.challenge-complete-card {
    margin-top: 25px;

    padding: 32px;

    text-align: center;

    background:
        linear-gradient(
            135deg,
            #f5f3ff,
            #eff6ff
        );

    border: 1px solid #ddd6fe;

    border-radius: 22px;
}

.challenge-complete-icon {
    font-size: 40px;
}

.challenge-complete-card > span {
    display: inline-block;

    margin-top: 9px;

    color: #7c3aed;

    font-size: 10px;
    font-weight: 800;
    letter-spacing: .8px;
}

.challenge-complete-card h2 {
    margin: 7px 0 0;

    color: #0f172a;

    font-size: 25px;
}

.challenge-complete-card p {
    max-width: 650px;

    margin: 9px auto 0;

    color: #64748b;

    font-size: 12px;
    line-height: 1.7;
}

.challenge-complete-card strong {
    display: block;

    margin-top: 11px;

    color: #6d28d9;

    font-size: 13px;
}


/* ========================================================= */
/* RESPONSIVE */
/* ========================================================= */

@media (max-width: 1100px) {

    .challenge-stat-grid {
        grid-template-columns:
            repeat(
                2,
                minmax(0, 1fr)
            );
    }


    .challenge-grid {
        grid-template-columns:
            repeat(
                2,
                minmax(0, 1fr)
            );
    }

}


@media (max-width: 760px) {

    .challenge-page {
        padding: 18px;
    }


    .challenge-hero {
        flex-direction: column;

        padding: 24px;
    }


    .challenge-class-card {
        width: 100%;
    }


    .challenge-stat-grid {
        grid-template-columns: 1fr;
    }


    .challenge-section-heading {
        flex-direction: column;
        align-items: stretch;
    }


    .challenge-grid {
        grid-template-columns: 1fr;
    }

}

</style>

@endpush