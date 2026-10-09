@extends('layouts.mahasiswa')

@section('title', 'Leaderboard - HIMDAS')

@section('content')

@php

    $firstPlace =
        $topThree->get(0);

    $secondPlace =
        $topThree->get(1);

    $thirdPlace =
        $topThree->get(2);

@endphp


<section class="leaderboard-page">

    <div class="leaderboard-container">


        {{-- ===================================================== --}}
        {{-- HERO --}}
        {{-- ===================================================== --}}

        <div class="leaderboard-hero">

            <div class="leaderboard-hero-content">

                <span class="leaderboard-eyebrow">
                    PERINGKAT KELAS
                </span>

                <h1>
                    Leaderboard HIMDAS
                </h1>

                <p>
                    Lihat pencapaian mahasiswa berdasarkan total XP
                    yang diperoleh selama belajar di HIMDAS.
                    Terus pelajari materi dan selesaikan Challenge
                    untuk meningkatkan posisi di kelas.
                </p>

            </div>


            <div class="leaderboard-class-card">

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
        {{-- STATISTIK --}}
        {{-- ===================================================== --}}

        <div class="leaderboard-stat-grid">


            {{-- JUMLAH MAHASISWA --}}

            <div class="leaderboard-stat-card">

                <div class="leaderboard-stat-icon">
                    👥
                </div>

                <div>

                    <span>
                        MAHASISWA
                    </span>

                    <strong>
                        {{ $totalStudents }}
                    </strong>

                    <small>
                        Peserta dalam kelas
                    </small>

                </div>

            </div>


            {{-- XP TERTINGGI --}}

            <div class="leaderboard-stat-card">

                <div class="leaderboard-stat-icon">
                    ⭐
                </div>

                <div>

                    <span>
                        XP TERTINGGI
                    </span>

                    <strong>
                        {{ number_format($highestXp, 0, ',', '.') }} XP
                    </strong>

                    <small>
                        Poin tertinggi kelas
                    </small>

                </div>

            </div>


            {{-- RATA RATA XP --}}

            <div class="leaderboard-stat-card">

                <div class="leaderboard-stat-icon">
                    📊
                </div>

                <div>

                    <span>
                        RATA-RATA XP
                    </span>

                    <strong>
                        {{ number_format($averageXp, 0, ',', '.') }} XP
                    </strong>

                    <small>
                        Rata-rata poin kelas
                    </small>

                </div>

            </div>


            {{-- POSISI SAYA --}}

            <div class="leaderboard-stat-card">

                <div class="leaderboard-stat-icon">
                    🏆
                </div>

                <div>

                    <span>
                        POSISI SAYA
                    </span>

                    <strong>

                        @if($myRanking)

                            #{{ $myRanking->rank }}

                        @else

                            -

                        @endif

                    </strong>

                    <small>
                        Ranking saat ini
                    </small>

                </div>

            </div>

        </div>



        {{-- ===================================================== --}}
        {{-- PODIUM --}}
        {{-- ===================================================== --}}

        <div class="leaderboard-section-heading">

            <div>

                <span>
                    TOP 3 MAHASISWA
                </span>

                <h2>
                    Podium Kelas
                </h2>

                <p>
                    Tiga mahasiswa dengan total XP tertinggi
                    dalam kelas aktif saat ini.
                </p>

            </div>

        </div>


        <div class="leaderboard-podium">


            {{-- ================================================= --}}
            {{-- JUARA 2 --}}
            {{-- ================================================= --}}

            <div class="podium-item podium-second">

                @if($secondPlace)

                    <div class="podium-crown">
                        🥈
                    </div>

                    <div class="podium-avatar">
                        {{ $secondPlace->initial }}
                    </div>

                    <span class="podium-rank-label">
                        JUARA 2
                    </span>

                    <h3>
                        {{ $secondPlace->name }}
                    </h3>

                    <strong>
                        {{ number_format($secondPlace->xp, 0, ',', '.') }} XP
                    </strong>

                    <small>
                        {{ $secondPlace->subbab_selesai }}/6 Subbab
                    </small>

                    <div class="podium-stage">
                        2
                    </div>

                @else

                    <div class="podium-empty">
                        <span>🥈</span>

                        <strong>
                            Belum Ada
                        </strong>

                        <small>
                            Menunggu mahasiswa
                        </small>
                    </div>

                @endif

            </div>



            {{-- ================================================= --}}
            {{-- JUARA 1 --}}
            {{-- ================================================= --}}

            <div class="podium-item podium-first">

                @if($firstPlace)

                    <div class="podium-crown first">
                        👑
                    </div>

                    <div class="podium-avatar first">
                        {{ $firstPlace->initial }}
                    </div>

                    <span class="podium-rank-label first">
                        JUARA 1
                    </span>

                    <h3>
                        {{ $firstPlace->name }}
                    </h3>

                    <strong>
                        {{ number_format($firstPlace->xp, 0, ',', '.') }} XP
                    </strong>

                    <small>
                        {{ $firstPlace->subbab_selesai }}/6 Subbab
                    </small>

                    <div class="podium-stage first">
                        1
                    </div>

                @else

                    <div class="podium-empty">
                        <span>🥇</span>

                        <strong>
                            Belum Ada
                        </strong>

                        <small>
                            Menunggu mahasiswa
                        </small>
                    </div>

                @endif

            </div>



            {{-- ================================================= --}}
            {{-- JUARA 3 --}}
            {{-- ================================================= --}}

            <div class="podium-item podium-third">

                @if($thirdPlace)

                    <div class="podium-crown">
                        🥉
                    </div>

                    <div class="podium-avatar">
                        {{ $thirdPlace->initial }}
                    </div>

                    <span class="podium-rank-label">
                        JUARA 3
                    </span>

                    <h3>
                        {{ $thirdPlace->name }}
                    </h3>

                    <strong>
                        {{ number_format($thirdPlace->xp, 0, ',', '.') }} XP
                    </strong>

                    <small>
                        {{ $thirdPlace->subbab_selesai }}/6 Subbab
                    </small>

                    <div class="podium-stage">
                        3
                    </div>

                @else

                    <div class="podium-empty">
                        <span>🥉</span>

                        <strong>
                            Belum Ada
                        </strong>

                        <small>
                            Menunggu mahasiswa
                        </small>
                    </div>

                @endif

            </div>

        </div>



        {{-- ===================================================== --}}
        {{-- RANKING --}}
        {{-- ===================================================== --}}

        <div class="leaderboard-section-heading ranking-heading">

            <div>

                <span>
                    RANKING KELAS
                </span>

                <h2>
                    Peringkat XP Tertinggi
                </h2>

                <p>
                    Ranking ditentukan berdasarkan total XP.
                    Jika XP sama, jumlah subbab yang sudah diselesaikan
                    digunakan sebagai pembanding berikutnya.
                </p>

            </div>


            <div class="leaderboard-ranking-info">
                Top {{ min($totalStudents, 10) }} Mahasiswa
            </div>

        </div>



        {{-- ===================================================== --}}
        {{-- LIST RANKING --}}
        {{-- ===================================================== --}}

        <div class="leaderboard-list-card">

            @forelse($leaderboard as $student)

                <div
                    class="
                        leaderboard-row
                        {{ $student->is_current_user ? 'current-user' : '' }}
                    "
                >

                    {{-- RANK --}}

                    <div
                        class="
                            leaderboard-rank
                            rank-{{ $student->rank <= 3 ? $student->rank : 'other' }}
                        "
                    >

                        @if($student->rank === 1)

                            🥇

                        @elseif($student->rank === 2)

                            🥈

                        @elseif($student->rank === 3)

                            🥉

                        @else

                            {{ $student->rank }}

                        @endif

                    </div>


                    {{-- USER --}}

                    <div class="leaderboard-user">

                        <div class="leaderboard-avatar">
                            {{ $student->initial }}
                        </div>


                        <div>

                            <div class="leaderboard-name">

                                <strong>
                                    {{ $student->name }}
                                </strong>


                                @if($student->is_current_user)

                                    <span class="leaderboard-me-badge">
                                        Kamu
                                    </span>

                                @endif

                            </div>


                            <small>
                                {{ $student->subbab_selesai }}/6 Subbab selesai
                            </small>

                        </div>

                    </div>


                    {{-- PROGRESS --}}

                    <div class="leaderboard-progress-area">

                        <div>

                            <span>
                                PROGRESS MATERI
                            </span>

                            <strong>
                                {{ $student->progress_percent }}%
                            </strong>

                        </div>


                        <progress
                            class="leaderboard-progress"
                            value="{{ $student->progress_percent }}"
                            max="100"
                        ></progress>

                    </div>


                    {{-- XP --}}

                    <div class="leaderboard-xp">

                        <span>
                            TOTAL XP
                        </span>

                        <strong>
                            {{ number_format($student->xp, 0, ',', '.') }} XP
                        </strong>

                    </div>

                </div>

            @empty

                <div class="leaderboard-empty">

                    <div>
                        👥
                    </div>

                    <h3>
                        Belum Ada Data Ranking
                    </h3>

                    <p>
                        Belum ada mahasiswa yang dapat ditampilkan
                        pada leaderboard kelas ini.
                    </p>

                </div>

            @endforelse

        </div>



        {{-- ===================================================== --}}
        {{-- POSISI SAYA --}}
        {{-- ===================================================== --}}

        @if($myRanking)

            <div class="my-rank-card">

                <div class="my-rank-left">

                    <div class="my-rank-icon">
                        🏆
                    </div>


                    <div>

                        <span>
                            POSISI SAYA
                        </span>

                        <h3>
                            Ranking #{{ $myRanking->rank }}
                        </h3>

                        <p>
                            Terus tingkatkan XP melalui materi
                            dan Challenge untuk naik peringkat.
                        </p>

                    </div>

                </div>


                <div class="my-rank-stats">

                    <div>

                        <span>
                            XP
                        </span>

                        <strong>
                            {{ number_format($myRanking->xp, 0, ',', '.') }}
                        </strong>

                    </div>


                    <div>

                        <span>
                            SUBBAB
                        </span>

                        <strong>
                            {{ $myRanking->subbab_selesai }}/6
                        </strong>

                    </div>


                    <div>

                        <span>
                            PROGRESS
                        </span>

                        <strong>
                            {{ $myRanking->progress_percent }}%
                        </strong>

                    </div>

                </div>

            </div>

        @endif



        {{-- ===================================================== --}}
        {{-- INFO --}}
        {{-- ===================================================== --}}

        <div class="leaderboard-info-card">

            <div class="leaderboard-info-icon">
                💡
            </div>

            <div>

                <h3>
                    Bagaimana Cara Naik Peringkat?
                </h3>

                <p>
                    XP diperoleh melalui aktivitas pembelajaran HIMDAS.
                    Selesaikan materi dan jawab Challenge dengan benar
                    untuk menambah XP. Leaderboard akan diperbarui
                    secara otomatis berdasarkan total XP masing-masing
                    mahasiswa dalam kelas.
                </p>

            </div>

        </div>

    </div>

</section>

@endsection



@push('styles')

<style>

/* ========================================================= */
/* PAGE */
/* ========================================================= */

.leaderboard-page {
    --lb-navy: #172554;
    --lb-blue: #2563eb;
    --lb-blue-dark: #1d4ed8;
    --lb-blue-light: #3b82f6;

    --lb-soft: #eff6ff;
    --lb-soft-2: #dbeafe;
    --lb-soft-3: #bfdbfe;

    --lb-text: #0f172a;
    --lb-muted: #64748b;
    --lb-muted-light: #94a3b8;

    --lb-border: #dbe4ee;

    width: 100%;

    padding: 32px;
}


.leaderboard-container {
    width: 100%;
    max-width: 1280px;

    margin: 0 auto;
}


/* ========================================================= */
/* HERO */
/* ========================================================= */

.leaderboard-hero {
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
        var(--lb-soft-3);

    border-radius: 24px;

    box-shadow:
        0 10px 30px
        rgba(15, 23, 42, .055);
}


.leaderboard-hero-content {
    flex: 1;
}


.leaderboard-eyebrow {
    display: inline-block;

    margin-bottom: 8px;

    color:
        var(--lb-blue);

    font-size: 12px;
    font-weight: 800;
    letter-spacing: 1px;
}


.leaderboard-hero h1 {
    margin: 0;

    color:
        var(--lb-text);

    font-size: 34px;
    font-weight: 800;
}


.leaderboard-hero p {
    max-width: 760px;

    margin: 13px 0 0;

    color:
        var(--lb-muted);

    font-size: 14px;
    line-height: 1.8;
}


/* ========================================================= */
/* CLASS CARD */
/* ========================================================= */

.leaderboard-class-card {
    width: 240px;

    padding: 24px;

    display: flex;
    flex-direction: column;
    justify-content: center;

    color: #ffffff;

    background:
        linear-gradient(
            135deg,
            var(--lb-navy),
            var(--lb-blue-dark)
        );

    border-radius: 20px;

    box-shadow:
        0 12px 26px
        rgba(37, 99, 235, .20);
}


.leaderboard-class-card span {
    font-size: 10px;
    font-weight: 800;
    letter-spacing: .8px;

    opacity: .78;
}


.leaderboard-class-card strong {
    margin-top: 8px;

    font-size: 20px;
    font-weight: 800;
}


.leaderboard-class-card small {
    margin-top: 7px;

    font-size: 11px;

    opacity: .8;
}


/* ========================================================= */
/* STAT */
/* ========================================================= */

.leaderboard-stat-grid {
    display: grid;

    grid-template-columns:
        repeat(
            4,
            minmax(0, 1fr)
        );

    gap: 16px;

    margin-top: 20px;
}


.leaderboard-stat-card {
    min-height: 116px;

    display: flex;
    align-items: center;

    gap: 15px;

    padding: 20px;

    background: #ffffff;

    border:
        1px solid
        var(--lb-border);

    border-radius: 18px;

    box-shadow:
        0 8px 24px
        rgba(15, 23, 42, .04);
}


.leaderboard-stat-icon {
    width: 48px;
    height: 48px;

    flex-shrink: 0;

    display: flex;
    align-items: center;
    justify-content: center;

    background:
        linear-gradient(
            135deg,
            var(--lb-soft),
            var(--lb-soft-2)
        );

    border:
        1px solid
        var(--lb-soft-2);

    border-radius: 14px;

    font-size: 22px;
}


.leaderboard-stat-card span {
    display: block;

    color:
        var(--lb-muted);

    font-size: 9px;
    font-weight: 800;
    letter-spacing: .5px;
}


.leaderboard-stat-card strong {
    display: block;

    margin-top: 4px;

    color:
        var(--lb-text);

    font-size: 21px;
    font-weight: 800;
}


.leaderboard-stat-card small {
    display: block;

    margin-top: 4px;

    color:
        var(--lb-muted-light);

    font-size: 10px;
}


/* ========================================================= */
/* SECTION HEADING */
/* ========================================================= */

.leaderboard-section-heading {
    display: flex;
    align-items: flex-end;
    justify-content: space-between;

    gap: 20px;

    margin:
        30px
        0
        17px;
}


.leaderboard-section-heading > div:first-child > span {
    color:
        var(--lb-blue);

    font-size: 10px;
    font-weight: 800;
    letter-spacing: .7px;
}


.leaderboard-section-heading h2 {
    margin: 5px 0 0;

    color:
        var(--lb-text);

    font-size: 25px;
    font-weight: 800;
}


.leaderboard-section-heading p {
    max-width: 720px;

    margin: 7px 0 0;

    color:
        var(--lb-muted);

    font-size: 12px;
    line-height: 1.7;
}


/* ========================================================= */
/* PODIUM */
/* ========================================================= */

.leaderboard-podium {
    min-height: 370px;

    display: grid;

    grid-template-columns:
        repeat(
            3,
            minmax(0, 1fr)
        );

    align-items: end;

    gap: 18px;

    padding:
        38px
        32px
        0;

    background:
        linear-gradient(
            135deg,
            #ffffff,
            #eff6ff
        );

    border:
        1px solid
        var(--lb-soft-3);

    border-radius: 24px;

    box-shadow:
        0 10px 30px
        rgba(15, 23, 42, .045);
}


.podium-item {
    text-align: center;
}


.podium-crown {
    min-height: 38px;

    font-size: 29px;
}


.podium-crown.first {
    font-size: 34px;
}


.podium-avatar {
    width: 68px;
    height: 68px;

    margin:
        6px
        auto
        11px;

    display: flex;
    align-items: center;
    justify-content: center;

    color: #ffffff;

    background:
        linear-gradient(
            135deg,
            #64748b,
            #475569
        );

    border:
        4px solid
        #ffffff;

    border-radius: 50%;

    box-shadow:
        0 8px 20px
        rgba(15, 23, 42, .13);

    font-size: 20px;
    font-weight: 800;
}


.podium-avatar.first {
    width: 82px;
    height: 82px;

    background:
        linear-gradient(
            135deg,
            var(--lb-navy),
            var(--lb-blue)
        );

    font-size: 24px;
}


.podium-rank-label {
    display: inline-block;

    padding:
        5px
        9px;

    color:
        var(--lb-muted);

    background:
        #f1f5f9;

    border-radius: 999px;

    font-size: 8px;
    font-weight: 800;
    letter-spacing: .5px;
}


.podium-rank-label.first {
    color:
        var(--lb-blue-dark);

    background:
        var(--lb-soft-2);
}


.podium-item h3 {
    margin:
        9px
        0
        0;

    color:
        var(--lb-text);

    font-size: 16px;
    font-weight: 800;

    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}


.podium-item > strong {
    display: block;

    margin-top: 5px;

    color:
        var(--lb-blue);

    font-size: 15px;
    font-weight: 800;
}


.podium-item > small {
    display: block;

    margin-top: 3px;

    color:
        var(--lb-muted);

    font-size: 9px;
}


.podium-stage {
    height: 105px;

    margin-top: 15px;

    display: flex;
    align-items: center;
    justify-content: center;

    color: #ffffff;

    background:
        linear-gradient(
            180deg,
            #64748b,
            #475569
        );

    border-radius:
        16px
        16px
        0
        0;

    font-size: 32px;
    font-weight: 800;
}


.podium-stage.first {
    height: 145px;

    background:
        linear-gradient(
            180deg,
            var(--lb-blue),
            var(--lb-navy)
        );

    font-size: 38px;
}


/* ========================================================= */
/* EMPTY PODIUM */
/* ========================================================= */

.podium-empty {
    min-height: 220px;

    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;

    color:
        var(--lb-muted);
}


.podium-empty span {
    font-size: 32px;

    filter: grayscale(1);

    opacity: .45;
}


.podium-empty strong {
    margin-top: 10px;

    color:
        var(--lb-text);

    font-size: 13px;
}


.podium-empty small {
    margin-top: 4px;

    font-size: 9px;
}


/* ========================================================= */
/* RANKING HEADING */
/* ========================================================= */

.ranking-heading {
    margin-top: 34px;
}


.leaderboard-ranking-info {
    padding:
        8px
        12px;

    color:
        var(--lb-blue-dark);

    background:
        var(--lb-soft);

    border:
        1px solid
        var(--lb-soft-2);

    border-radius: 999px;

    font-size: 9px;
    font-weight: 800;
}


/* ========================================================= */
/* LIST CARD */
/* ========================================================= */

.leaderboard-list-card {
    overflow: hidden;

    background: #ffffff;

    border:
        1px solid
        var(--lb-border);

    border-radius: 20px;

    box-shadow:
        0 10px 28px
        rgba(15, 23, 42, .045);
}


/* ========================================================= */
/* ROW */
/* ========================================================= */

.leaderboard-row {
    display: grid;

    grid-template-columns:
        60px
        minmax(220px, 1.4fr)
        minmax(200px, 1fr)
        130px;

    align-items: center;

    gap: 16px;

    min-height: 92px;

    padding:
        16px
        20px;

    border-bottom:
        1px solid
        #edf2f7;

    transition:
        background .2s ease;
}


.leaderboard-row:last-child {
    border-bottom: none;
}


.leaderboard-row:hover {
    background:
        #f8fbff;
}


.leaderboard-row.current-user {
    position: relative;

    background:
        linear-gradient(
            90deg,
            #eff6ff,
            #ffffff
        );
}


.leaderboard-row.current-user::before {
    content: '';

    position: absolute;

    top: 0;
    bottom: 0;
    left: 0;

    width: 4px;

    background:
        var(--lb-blue);
}


/* ========================================================= */
/* RANK */
/* ========================================================= */

.leaderboard-rank {
    width: 42px;
    height: 42px;

    display: flex;
    align-items: center;
    justify-content: center;

    color:
        var(--lb-text);

    background:
        #f1f5f9;

    border-radius: 12px;

    font-size: 13px;
    font-weight: 800;
}


.leaderboard-rank.rank-1,
.leaderboard-rank.rank-2,
.leaderboard-rank.rank-3 {
    font-size: 20px;
}


/* ========================================================= */
/* USER */
/* ========================================================= */

.leaderboard-user {
    min-width: 0;

    display: flex;
    align-items: center;

    gap: 12px;
}


.leaderboard-avatar {
    width: 44px;
    height: 44px;

    flex-shrink: 0;

    display: flex;
    align-items: center;
    justify-content: center;

    color: #ffffff;

    background:
        linear-gradient(
            135deg,
            var(--lb-navy),
            var(--lb-blue)
        );

    border-radius: 13px;

    font-size: 12px;
    font-weight: 800;
}


.leaderboard-name {
    min-width: 0;

    display: flex;
    align-items: center;

    gap: 7px;
}


.leaderboard-name strong {
    color:
        var(--lb-text);

    font-size: 12px;
    font-weight: 800;

    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}


.leaderboard-user small {
    display: block;

    margin-top: 4px;

    color:
        var(--lb-muted);

    font-size: 9px;
}


.leaderboard-me-badge {
    flex-shrink: 0;

    padding:
        4px
        7px;

    color:
        var(--lb-blue-dark);

    background:
        var(--lb-soft-2);

    border-radius: 999px;

    font-size: 7px;
    font-weight: 800;
}


/* ========================================================= */
/* PROGRESS */
/* ========================================================= */

.leaderboard-progress-area > div {
    display: flex;
    align-items: center;
    justify-content: space-between;

    gap: 10px;

    margin-bottom: 7px;
}


.leaderboard-progress-area span {
    color:
        var(--lb-muted);

    font-size: 8px;
    font-weight: 800;
}


.leaderboard-progress-area strong {
    color:
        var(--lb-blue);

    font-size: 9px;
    font-weight: 800;
}


.leaderboard-progress {
    width: 100%;
    height: 8px;

    border: none;

    appearance: none;
    -webkit-appearance: none;
}


.leaderboard-progress::-webkit-progress-bar {
    background:
        #e2e8f0;

    border-radius: 999px;
}


.leaderboard-progress::-webkit-progress-value {
    background:
        linear-gradient(
            90deg,
            var(--lb-blue-light),
            var(--lb-blue),
            var(--lb-navy)
        );

    border-radius: 999px;
}


.leaderboard-progress::-moz-progress-bar {
    background:
        linear-gradient(
            90deg,
            var(--lb-blue-light),
            var(--lb-blue),
            var(--lb-navy)
        );

    border-radius: 999px;
}


/* ========================================================= */
/* XP */
/* ========================================================= */

.leaderboard-xp {
    text-align: right;
}


.leaderboard-xp span {
    display: block;

    color:
        var(--lb-muted);

    font-size: 8px;
    font-weight: 800;
}


.leaderboard-xp strong {
    display: block;

    margin-top: 4px;

    color:
        var(--lb-blue-dark);

    font-size: 14px;
    font-weight: 800;
}


/* ========================================================= */
/* EMPTY */
/* ========================================================= */

.leaderboard-empty {
    padding: 50px 25px;

    text-align: center;
}


.leaderboard-empty > div {
    font-size: 38px;
}


.leaderboard-empty h3 {
    margin:
        12px
        0
        0;

    color:
        var(--lb-text);

    font-size: 17px;
}


.leaderboard-empty p {
    margin:
        7px
        auto
        0;

    max-width: 450px;

    color:
        var(--lb-muted);

    font-size: 11px;
    line-height: 1.7;
}


/* ========================================================= */
/* MY RANK */
/* ========================================================= */

.my-rank-card {
    display: flex;
    align-items: center;
    justify-content: space-between;

    gap: 25px;

    margin-top: 22px;

    padding: 24px;

    color: #ffffff;

    background:
        linear-gradient(
            135deg,
            var(--lb-navy),
            var(--lb-blue-dark)
        );

    border-radius: 20px;

    box-shadow:
        0 12px 30px
        rgba(37, 99, 235, .18);
}


.my-rank-left {
    display: flex;
    align-items: center;

    gap: 15px;
}


.my-rank-icon {
    width: 54px;
    height: 54px;

    flex-shrink: 0;

    display: flex;
    align-items: center;
    justify-content: center;

    background:
        rgba(255, 255, 255, .12);

    border:
        1px solid
        rgba(255, 255, 255, .13);

    border-radius: 15px;

    font-size: 24px;
}


.my-rank-left span {
    font-size: 8px;
    font-weight: 800;
    letter-spacing: .7px;

    opacity: .75;
}


.my-rank-left h3 {
    margin:
        4px
        0
        0;

    font-size: 20px;
    font-weight: 800;
}


.my-rank-left p {
    margin:
        5px
        0
        0;

    font-size: 10px;
    line-height: 1.5;

    opacity: .78;
}


.my-rank-stats {
    display: grid;

    grid-template-columns:
        repeat(
            3,
            minmax(80px, 1fr)
        );

    gap: 10px;
}


.my-rank-stats > div {
    min-width: 90px;

    padding:
        11px
        14px;

    text-align: center;

    background:
        rgba(255, 255, 255, .10);

    border:
        1px solid
        rgba(255, 255, 255, .12);

    border-radius: 12px;
}


.my-rank-stats span {
    display: block;

    font-size: 7px;
    font-weight: 800;

    opacity: .7;
}


.my-rank-stats strong {
    display: block;

    margin-top: 3px;

    font-size: 13px;
    font-weight: 800;
}


/* ========================================================= */
/* INFO */
/* ========================================================= */

.leaderboard-info-card {
    display: flex;
    align-items: flex-start;

    gap: 16px;

    margin-top: 22px;

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
}


.leaderboard-info-icon {
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

    font-size: 22px;
}


.leaderboard-info-card h3 {
    margin: 0;

    color:
        var(--lb-text);

    font-size: 15px;
    font-weight: 800;
}


.leaderboard-info-card p {
    max-width: 850px;

    margin:
        6px
        0
        0;

    color:
        var(--lb-muted);

    font-size: 11px;
    line-height: 1.7;
}


/* ========================================================= */
/* RESPONSIVE TABLET */
/* ========================================================= */

@media (max-width: 1100px) {

    .leaderboard-stat-grid {
        grid-template-columns:
            repeat(
                2,
                minmax(0, 1fr)
            );
    }


    .leaderboard-row {
        grid-template-columns:
            50px
            minmax(190px, 1fr)
            170px
            110px;
    }


    .my-rank-card {
        flex-direction: column;
        align-items: stretch;
    }

}


/* ========================================================= */
/* RESPONSIVE MOBILE */
/* ========================================================= */

@media (max-width: 760px) {

    .leaderboard-page {
        padding: 18px;
    }


    .leaderboard-hero {
        flex-direction: column;

        padding: 24px;
    }


    .leaderboard-hero h1 {
        font-size: 28px;
    }


    .leaderboard-class-card {
        width: 100%;
    }


    .leaderboard-stat-grid {
        grid-template-columns: 1fr;
    }


    .leaderboard-section-heading {
        flex-direction: column;
        align-items: stretch;
    }


    .leaderboard-podium {
        min-height: auto;

        grid-template-columns: 1fr;

        align-items: stretch;

        padding: 22px;
    }


    .podium-first {
        order: 1;
    }


    .podium-second {
        order: 2;
    }


    .podium-third {
        order: 3;
    }


    .podium-stage,
    .podium-stage.first {
        height: 58px;

        border-radius: 13px;

        font-size: 22px;
    }


    .leaderboard-row {
        grid-template-columns:
            48px
            1fr;

        gap: 11px;

        padding: 15px;
    }


    .leaderboard-progress-area {
        grid-column:
            2 / -1;
    }


    .leaderboard-xp {
        grid-column:
            2 / -1;

        text-align: left;
    }


    .my-rank-left {
        align-items: flex-start;
    }


    .my-rank-stats {
        grid-template-columns:
            repeat(
                3,
                1fr
            );
    }


    .my-rank-stats > div {
        min-width: 0;
    }


    .leaderboard-info-card {
        flex-direction: column;
    }

}

</style>

@endpush