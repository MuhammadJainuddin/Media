@extends('layouts.app')

@section('title', 'Dashboard Dosen - HIMDAS')

@section('content')

<section class="lecturer-dashboard-v4">

    {{-- ========================================================= --}}
    {{-- TOPBAR --}}
    {{-- ========================================================= --}}

    <header class="lecturer-topbar-v4">

        <a
            href="{{ route('dosen.dashboard') }}"
            class="lecturer-brand-v4"
        >

            <div class="lecturer-brand-logo-v4">

                <img
                    src="{{ asset('images/logo-himdas-new.png') }}"
                    alt="Logo HIMDAS"
                >

            </div>

            <div class="lecturer-brand-copy-v4">

                <strong>
                    HIMDAS
                </strong>

                <span>
                    Dashboard Dosen
                </span>

            </div>

        </a>


        <div class="lecturer-topbar-actions-v4">

            <div class="lecturer-user-v4">

                <div class="lecturer-user-avatar-v4">

                    {{
                        mb_strtoupper(
                            mb_substr(
                                auth()->user()->name,
                                0,
                                1
                            )
                        )
                    }}

                </div>

                <div class="lecturer-user-copy-v4">

                    <strong>
                        {{ auth()->user()->name }}
                    </strong>

                    <span>

                        {{
                            auth()->user()->role === 'admin'
                                ? 'Administrator'
                                : 'Dosen'
                        }}

                    </span>

                </div>

            </div>


            <form
                action="{{ route('logout') }}"
                method="POST"
            >

                @csrf

                <button
                    type="submit"
                    class="lecturer-logout-v4"
                >

                    <svg viewBox="0 0 24 24">
                        <path d="M10 4H5C3.9 4 3 4.9 3 6V18C3 19.1 3.9 20 5 20H10" />
                        <path d="M14 8L18 12L14 16" />
                        <path d="M8 12H18" />
                    </svg>

                    <span>
                        Keluar
                    </span>

                </button>

            </form>

        </div>

    </header>


    <div class="lecturer-container-v4">


        {{-- ========================================================= --}}
        {{-- HERO --}}
        {{-- ========================================================= --}}

        <section class="lecturer-hero-v4">

            <div class="lecturer-hero-decoration-v4">
                A ∩ B
            </div>


            <div class="lecturer-hero-copy-v4">

                <span class="lecturer-eyebrow-v4">
                    DASHBOARD DOSEN
                </span>


                <h1>

                    Halo,

                    <span>
                        {{ auth()->user()->name }}
                    </span>

                </h1>


                <p>

                    Kelola kelas, pantau perkembangan pembelajaran,
                    dan temukan mahasiswa yang membutuhkan perhatian
                    melalui satu dashboard HIMDAS.

                </p>


                <div class="lecturer-hero-meta-v4">

                    <span>

                        <svg viewBox="0 0 24 24">
                            <path d="M4 5H20V19H4V5Z" />
                            <path d="M8 9H16M8 13H13" />
                        </svg>

                        {{ $totalKelas }} kelas aktif

                    </span>


                    <span>

                        <svg viewBox="0 0 24 24">
                            <circle cx="8" cy="8" r="3" />
                            <path d="M2 20C2 16.7 4.7 14 8 14" />
                            <circle cx="16" cy="9" r="2.5" />
                            <path d="M13 20C13 17.2 15.2 15 18 15" />
                        </svg>

                        {{ $totalMahasiswa }} mahasiswa

                    </span>

                </div>

            </div>


            <div class="lecturer-hero-progress-v4">

                <div class="lecturer-hero-progress-icon-v4">

                    <svg viewBox="0 0 24 24">
                        <path d="M4 18V11M10 18V6M16 18V9M22 18V3" />
                    </svg>

                </div>


                <span>
                    Rata-rata kelas
                </span>


                <strong>
                    {{ $rataProgress }}%
                </strong>


                <progress
                    value="{{ $rataProgress }}"
                    max="100"
                ></progress>

            </div>

        </section>


        {{-- ========================================================= --}}
        {{-- STATISTIK --}}
        {{-- ========================================================= --}}

        <section class="lecturer-stats-v4">

            <article class="lecturer-stat-v4">

                <div class="lecturer-stat-icon-v4 stat-blue-v4">

                    <svg viewBox="0 0 24 24">
                        <path d="M4 5H20V18H4V5Z" />
                        <path d="M8 9H16M8 13H13" />
                    </svg>

                </div>


                <div>

                    <span>
                        Total Kelas
                    </span>

                    <strong>
                        {{ $totalKelas }}
                    </strong>

                    <small>
                        Kelas yang dikelola
                    </small>

                </div>

            </article>


            <article class="lecturer-stat-v4">

                <div class="lecturer-stat-icon-v4 stat-green-v4">

                    <svg viewBox="0 0 24 24">
                        <circle cx="8" cy="8" r="3" />
                        <path d="M2 20C2 16.7 4.7 14 8 14" />
                        <circle cx="16" cy="9" r="2.5" />
                        <path d="M13 20C13 17.2 15.2 15 18 15" />
                    </svg>

                </div>


                <div>

                    <span>
                        Mahasiswa
                    </span>

                    <strong>
                        {{ $totalMahasiswa }}
                    </strong>

                    <small>
                        Mahasiswa tergabung
                    </small>

                </div>

            </article>


            <article class="lecturer-stat-v4">

                <div class="lecturer-stat-icon-v4 stat-cyan-v4">

                    <svg viewBox="0 0 24 24">
                        <path d="M4 18V11M10 18V6M16 18V9M22 18V3" />
                    </svg>

                </div>


                <div>

                    <span>
                        Rata-rata Progress
                    </span>

                    <strong>
                        {{ $rataProgress }}%
                    </strong>

                    <small>
                        Keseluruhan kelas
                    </small>

                </div>

            </article>


            <article class="lecturer-stat-v4">

                <div class="lecturer-stat-icon-v4 stat-yellow-v4">

                    <svg viewBox="0 0 24 24">
                        <circle cx="12" cy="8" r="5" />
                        <path d="M8.8 12L7 21L12 18L17 21L15.2 12" />
                    </svg>

                </div>


                <div>

                    <span>
                        Badge Diperoleh
                    </span>

                    <strong>
                        {{ $totalBadge }}
                    </strong>

                    <small>
                        Badge aktual mahasiswa
                    </small>

                </div>

            </article>

        </section>


        {{-- ========================================================= --}}
        {{-- INSIGHT RINGKAS --}}
        {{-- ========================================================= --}}

        <section class="lecturer-quick-insight-v4">

            <article>

                <div class="quick-icon-v4 quick-green-v4">

                    <svg viewBox="0 0 24 24">
                        <path d="M5 12L10 17L19 7" />
                    </svg>

                </div>

                <div>

                    <strong>
                        {{ $selesaiMateri }}
                    </strong>

                    <span>
                        Selesai 6 materi
                    </span>

                </div>

            </article>


            <article>

                <div class="quick-icon-v4 quick-cyan-v4">

                    <svg viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="9" />
                        <path d="M12 7V12L16 14" />
                    </svg>

                </div>

                <div>

                    <strong>
                        {{ $aktifHariIni }}
                    </strong>

                    <span>
                        Aktif hari ini
                    </span>

                </div>

            </article>


            <article>

                <div class="quick-icon-v4 quick-orange-v4">

                    <svg viewBox="0 0 24 24">
                        <path d="M12 3L21 20H3L12 3Z" />
                        <path d="M12 9V14M12 17V17.1" />
                    </svg>

                </div>

                <div>

                    <strong>
                        {{ $perluPerhatian }}
                    </strong>

                    <span>
                        Perlu perhatian
                    </span>

                </div>

            </article>


            <article>

                <div class="quick-icon-v4 quick-purple-v4">

                    <svg viewBox="0 0 24 24">
                        <path d="M12 3L14.5 8L20 8.8L16 12.7L17 18L12 15.5L7 18L8 12.7L4 8.8L9.5 8L12 3Z" />
                    </svg>

                </div>

                <div>

                    <strong>
                        {{ number_format($totalXp) }}
                    </strong>

                    <span>
                        Total XP kelas
                    </span>

                </div>

            </article>

        </section>


        {{-- ========================================================= --}}
        {{-- MAIN GRID --}}
        {{-- ========================================================= --}}

        <section class="lecturer-main-grid-v4">


            {{-- ===================================================== --}}
            {{-- BUAT KELAS --}}
            {{-- ===================================================== --}}

            <article class="lecturer-panel-v4">

                <div class="lecturer-panel-heading-v4">

                    <div>

                        <span>
                            KELOLA KELAS
                        </span>

                        <h2>
                            Buat Kelas Baru
                        </h2>

                    </div>


                    <div class="lecturer-panel-icon-v4">

                        <svg viewBox="0 0 24 24">
                            <path d="M12 5V19M5 12H19" />
                        </svg>

                    </div>

                </div>


                <p class="lecturer-panel-description-v4">

                    Buat ruang belajar baru kemudian bagikan
                    kode kelas kepada mahasiswa.

                </p>


                @if(session('success'))

                    <div class="lecturer-alert-v4 lecturer-alert-success-v4">

                        {{ session('success') }}

                    </div>

                @endif


                @if($errors->any())

                    <div class="lecturer-alert-v4 lecturer-alert-error-v4">

                        {{ $errors->first() }}

                    </div>

                @endif


                <form
                    action="{{ route('kelas.store') }}"
                    method="POST"
                    class="lecturer-create-form-v4"
                >

                    @csrf


                    <div class="lecturer-form-group-v4">

                        <label for="nama_kelas">

                            Nama Kelas

                        </label>

                        <input
                            id="nama_kelas"
                            type="text"
                            name="nama_kelas"
                            value="{{ old('nama_kelas') }}"
                            placeholder="Contoh: Matematika Dasar A"
                            required
                        >

                    </div>


                    <div class="lecturer-form-group-v4">

                        <label for="deskripsi">

                            Deskripsi

                        </label>

                        <textarea
                            id="deskripsi"
                            name="deskripsi"
                            placeholder="Tuliskan deskripsi singkat kelas..."
                        >{{ old('deskripsi') }}</textarea>

                    </div>


                    <button
                        type="submit"
                        class="lecturer-create-button-v4"
                    >

                        <span>
                            Buat Kelas
                        </span>

                        <svg viewBox="0 0 24 24">
                            <path d="M12 5V19M5 12H19" />
                        </svg>

                    </button>

                </form>

            </article>


            {{-- ===================================================== --}}
            {{-- KELAS SAYA --}}
            {{-- ===================================================== --}}

            <article class="lecturer-panel-v4">

                <div class="lecturer-panel-heading-v4">

                    <div>

                        <span>
                            KELAS SAYA
                        </span>

                        <h2>
                            Ruang Pembelajaran
                        </h2>

                    </div>


                    <div class="lecturer-panel-icon-v4 panel-cyan-v4">

                        <svg viewBox="0 0 24 24">
                            <path d="M4 5H20V18H4V5Z" />
                            <path d="M8 9H16M8 13H13" />
                        </svg>

                    </div>

                </div>


                <p class="lecturer-panel-description-v4">

                    Pilih kelas untuk melihat progress, badge,
                    XP, challenge, leaderboard, dan aktivitas mahasiswa.

                </p>


                <div class="lecturer-class-grid-v4">

                    @forelse($kelas as $item)

                        <article class="lecturer-class-card-v4">

                            <div class="lecturer-class-card-top-v4">

                                <div class="lecturer-class-symbol-v4">
                                    ∩
                                </div>


                                <span class="lecturer-student-count-v4">

                                    {{ $item->student_count }}
                                    mahasiswa

                                </span>

                            </div>


                            <h3>
                                {{ $item->nama_kelas }}
                            </h3>


                            <p class="lecturer-class-description-v4">

                                {{
                                    $item->deskripsi
                                    ?:
                                    'Kelas pembelajaran HIMDAS.'
                                }}

                            </p>


                            <div class="lecturer-class-code-v4">

                                <span>
                                    KODE KELAS
                                </span>

                                <strong>
                                    {{ $item->kode_kelas }}
                                </strong>

                            </div>


                            <div class="lecturer-class-metrics-v4">

                                <div>

                                    <span>
                                        Progress
                                    </span>

                                    <strong>
                                        {{ $item->average_progress }}%
                                    </strong>

                                </div>


                                <div>

                                    <span>
                                        Badge
                                    </span>

                                    <strong>
                                        {{ $item->total_badges }}
                                    </strong>

                                </div>


                                <div>

                                    <span>
                                        XP
                                    </span>

                                    <strong>
                                        {{ number_format($item->total_xp) }}
                                    </strong>

                                </div>

                            </div>


                            <progress
                                class="lecturer-class-progress-v4"
                                value="{{ $item->average_progress }}"
                                max="100"
                            ></progress>


                            <a
                                href="{{
                                    route(
                                        'dosen.kelas.show',
                                        $item->id
                                    )
                                }}"
                                class="lecturer-open-class-v4"
                            >

                                <span>
                                    Buka Dashboard Kelas
                                </span>

                                <svg viewBox="0 0 24 24">
                                    <path d="M5 12H19M14 7L19 12L14 17" />
                                </svg>

                            </a>

                        </article>


                    @empty

                        <div class="lecturer-empty-v4">

                            <div>

                                <svg viewBox="0 0 24 24">
                                    <path d="M4 5H20V18H4V5Z" />
                                    <path d="M8 9H16M8 13H13" />
                                </svg>

                            </div>

                            <strong>
                                Belum Ada Kelas
                            </strong>

                            <p>

                                Buat kelas pertama untuk mulai
                                memantau perkembangan mahasiswa.

                            </p>

                        </div>

                    @endforelse

                </div>

            </article>

        </section>


        {{-- ========================================================= --}}
        {{-- BOTTOM GRID --}}
        {{-- ========================================================= --}}

        <section class="lecturer-bottom-grid-v4">


            {{-- ===================================================== --}}
            {{-- AKTIVITAS --}}
            {{-- ===================================================== --}}

            <article class="lecturer-panel-v4">

                <div class="lecturer-panel-heading-v4">

                    <div>

                        <span>
                            MONITORING
                        </span>

                        <h2>
                            Aktivitas Terbaru
                        </h2>

                    </div>


                    <div class="lecturer-panel-icon-v4 panel-green-v4">

                        <svg viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="9" />
                            <path d="M12 7V12L9 14" />
                        </svg>

                    </div>

                </div>


                <div class="lecturer-activity-list-v4">

                    @forelse($aktivitasTerbaru as $activity)

                        <div class="lecturer-activity-row-v4">

                            <div class="lecturer-activity-avatar-v4">

                                {{
                                    mb_strtoupper(
                                        mb_substr(
                                            $activity['student']->name,
                                            0,
                                            1
                                        )
                                    )
                                }}

                            </div>


                            <div class="lecturer-activity-copy-v4">

                                <strong>

                                    {{
                                        $activity['student']->name
                                    }}

                                </strong>

                                <span>

                                    {{
                                        $activity['kelas']->nama_kelas
                                    }}

                                    ·

                                    {{
                                        round(
                                            $activity['progress']
                                        )
                                    }}% progress

                                </span>

                            </div>


                            <time>

                                {{
                                    \Carbon\Carbon::parse(
                                        $activity['last_activity_at']
                                    )
                                    ->locale('id')
                                    ->diffForHumans()
                                }}

                            </time>

                        </div>


                    @empty

                        <div class="lecturer-empty-small-v4">

                            <strong>
                                Belum ada aktivitas
                            </strong>

                            <span>

                                Aktivitas mahasiswa akan
                                muncul di bagian ini.

                            </span>

                        </div>

                    @endforelse

                </div>

            </article>


            {{-- ===================================================== --}}
            {{-- INSIGHT --}}
            {{-- ===================================================== --}}

            <article class="lecturer-panel-v4">

                <div class="lecturer-panel-heading-v4">

                    <div>

                        <span>
                            INSIGHT DOSEN
                        </span>

                        <h2>
                            Ringkasan Kelas
                        </h2>

                    </div>


                    <div class="lecturer-panel-icon-v4 panel-orange-v4">

                        <svg viewBox="0 0 24 24">
                            <path d="M12 3L21 20H3L12 3Z" />
                            <path d="M12 9V14M12 17V17.1" />
                        </svg>

                    </div>

                </div>


                <div class="lecturer-summary-list-v4">

                    <div class="lecturer-summary-row-v4">

                        <span class="summary-dot-v4 dot-green-v4"></span>

                        <div>

                            <strong>

                                {{ $selesaiMateri }}
                                mahasiswa

                            </strong>

                            <p>

                                Telah menyelesaikan
                                seluruh 6 materi.

                            </p>

                        </div>

                    </div>


                    <div class="lecturer-summary-row-v4">

                        <span class="summary-dot-v4 dot-cyan-v4"></span>

                        <div>

                            <strong>

                                {{ $aktifHariIni }}
                                mahasiswa

                            </strong>

                            <p>
                                Tercatat aktif hari ini.
                            </p>

                        </div>

                    </div>


                    <div class="lecturer-summary-row-v4">

                        <span class="summary-dot-v4 dot-orange-v4"></span>

                        <div>

                            <strong>

                                {{ $perluPerhatian }}
                                mahasiswa

                            </strong>

                            <p>

                                Memerlukan perhatian
                                berdasarkan aktivitas belajar.

                            </p>

                        </div>

                    </div>


                    <div class="lecturer-summary-row-v4">

                        <span class="summary-dot-v4 dot-purple-v4"></span>

                        <div>

                            <strong>

                                {{ number_format($totalXp) }}
                                XP

                            </strong>

                            <p>

                                Telah dikumpulkan oleh
                                seluruh mahasiswa.

                            </p>

                        </div>

                    </div>

                </div>

            </article>

        </section>

    </div>

</section>

@endsection


@push('styles')

<style>

/* ==========================================================
   MATIKAN NAVBAR PUBLIC
========================================================== */

.public-navbar,
.navbar {
    display: none !important;
}


/* ==========================================================
   ROOT
========================================================== */

.lecturer-dashboard-v4,
.lecturer-dashboard-v4 * {
    box-sizing: border-box;
}


.lecturer-dashboard-v4 {
    min-height: 100vh;

    color: #172033;

    background:
        radial-gradient(
            circle at 92% 3%,
            rgba(34, 211, 238, .14),
            transparent 27%
        ),
        radial-gradient(
            circle at 4% 93%,
            rgba(37, 99, 235, .08),
            transparent 26%
        ),
        linear-gradient(
            135deg,
            #f8fbff 0%,
            #f0f7ff 48%,
            #ebf8ff 100%
        );
}


.lecturer-dashboard-v4 svg {
    width: 22px;
    height: 22px;

    fill: none;

    stroke: currentColor;

    stroke-width: 1.8;

    stroke-linecap: round;
    stroke-linejoin: round;
}


/* ==========================================================
   TOPBAR
========================================================== */

.lecturer-topbar-v4 {
    min-height: 82px;

    padding:
        12px
        clamp(
            20px,
            4vw,
            58px
        );

    position: sticky;

    top: 0;

    z-index: 100;

    display: flex;

    align-items: center;

    justify-content: space-between;

    gap: 24px;

    background:
        radial-gradient(
            circle at 82% -160%,
            rgba(34, 211, 238, .42),
            transparent 42%
        ),
        linear-gradient(
            105deg,
            #092247 0%,
            #174b82 56%,
            #087f95 100%
        );

    box-shadow:
        0 10px 34px
        rgba(7, 26, 56, .16);
}


.lecturer-brand-v4 {
    display: flex;

    align-items: center;

    gap: 13px;

    color: #ffffff;

    text-decoration: none;
}


.lecturer-brand-logo-v4 {
    width: 72px;
    height: 52px;

    padding: 5px;

    display: flex;

    align-items: center;

    justify-content: center;

    border-radius: 14px;

    background: #ffffff;

    box-shadow:
        0 8px 22px
        rgba(0, 0, 0, .12);
}


.lecturer-brand-logo-v4 img {
    width: 100%;
    height: 100%;

    object-fit: contain;
}


.lecturer-brand-copy-v4 strong {
    display: block;

    font-size: 16px;

    font-weight: 800;
}


.lecturer-brand-copy-v4 span {
    display: block;

    margin-top: 2px;

    color: #bae6fd;

    font-size: 11px;

    font-weight: 500;
}


.lecturer-topbar-actions-v4 {
    display: flex;

    align-items: center;

    gap: 16px;
}


.lecturer-user-v4 {
    display: flex;

    align-items: center;

    gap: 10px;
}


.lecturer-user-avatar-v4 {
    width: 42px;
    height: 42px;

    display: flex;

    align-items: center;

    justify-content: center;

    border-radius: 50%;

    color: #17427e;

    background: #ffffff;

    font-size: 14px;

    font-weight: 800;
}


.lecturer-user-copy-v4 strong {
    display: block;

    max-width: 210px;

    overflow: hidden;

    color: #ffffff;

    font-size: 13px;

    font-weight: 700;

    text-overflow: ellipsis;

    white-space: nowrap;
}


.lecturer-user-copy-v4 span {
    display: block;

    margin-top: 2px;

    color: #bae6fd;

    font-size: 10px;
}


.lecturer-logout-v4 {
    min-height: 42px;

    padding:
        0 15px;

    display: flex;

    align-items: center;

    gap: 8px;

    border:
        1px solid
        rgba(255, 255, 255, .16);

    border-radius: 12px;

    color: #ffffff;

    background:
        rgba(255, 255, 255, .09);

    font: inherit;

    font-size: 12px;

    font-weight: 700;

    cursor: pointer;

    transition:
        .2s ease;
}


.lecturer-logout-v4:hover {
    background:
        rgba(255, 255, 255, .16);

    transform:
        translateY(-1px);
}


.lecturer-logout-v4 svg {
    width: 17px;
    height: 17px;
}


/* ==========================================================
   CONTAINER
========================================================== */

.lecturer-container-v4 {
    width:
        min(
            1380px,
            calc(100% - 52px)
        );

    margin: 0 auto;

    padding:
        38px 0
        56px;
}


/* ==========================================================
   HERO
========================================================== */

.lecturer-hero-v4 {
    min-height: 220px;

    padding:
        34px 36px;

    position: relative;

    overflow: hidden;

    display: flex;

    align-items: center;

    justify-content: space-between;

    gap: 36px;

    border:
        1px solid
        rgba(255, 255, 255, .92);

    border-radius: 28px;

    background:
        rgba(255, 255, 255, .88);

    box-shadow:
        0 20px 48px
        rgba(27, 72, 120, .09);
}


.lecturer-hero-decoration-v4 {
    position: absolute;

    right: 23%;
    top: -30px;

    color:
        rgba(37, 99, 235, .035);

    font-family:
        Georgia,
        serif;

    font-size: 120px;

    font-style: italic;

    pointer-events: none;
}


.lecturer-hero-copy-v4 {
    position: relative;

    z-index: 1;

    max-width: 820px;
}


.lecturer-eyebrow-v4 {
    color: #2563eb;

    font-size: 11px;

    font-weight: 800;

    letter-spacing: 1.2px;
}


.lecturer-hero-v4 h1 {
    margin-top: 8px;

    color: #111b31;

    font-size:
        clamp(
            34px,
            3.4vw,
            50px
        );

    font-weight: 800;

    line-height: 1.12;

    letter-spacing: -1.6px;
}


.lecturer-hero-v4 h1 span {
    background:
        linear-gradient(
            90deg,
            #2563eb,
            #06b6d4,
            #10b981
        );

    -webkit-background-clip: text;

    background-clip: text;

    -webkit-text-fill-color:
        transparent;
}


.lecturer-hero-v4 p {
    max-width: 760px;

    margin-top: 13px;

    color: #66788f;

    font-size: 14px;

    line-height: 1.75;
}


.lecturer-hero-meta-v4 {
    margin-top: 20px;

    display: flex;

    flex-wrap: wrap;

    gap: 10px;
}


.lecturer-hero-meta-v4 span {
    min-height: 37px;

    padding:
        8px 13px;

    display: flex;

    align-items: center;

    gap: 8px;

    border:
        1px solid
        #e0eaf4;

    border-radius: 999px;

    color: #50667e;

    background: #ffffff;

    font-size: 12px;

    font-weight: 600;
}


.lecturer-hero-meta-v4 svg {
    width: 17px;
    height: 17px;

    color: #2563eb;
}


.lecturer-hero-progress-v4 {
    width: 250px;

    flex-shrink: 0;

    padding: 22px;

    position: relative;

    z-index: 1;

    border:
        1px solid
        #dbe8f5;

    border-radius: 20px;

    background:
        linear-gradient(
            145deg,
            #ffffff,
            #f4faff
        );

    box-shadow:
        0 10px 26px
        rgba(30, 64, 100, .05);
}


.lecturer-hero-progress-icon-v4 {
    width: 45px;
    height: 45px;

    display: flex;

    align-items: center;

    justify-content: center;

    border-radius: 13px;

    color: #0891b2;

    background: #e9fbff;
}


.lecturer-hero-progress-icon-v4 svg {
    width: 20px;
    height: 20px;
}


.lecturer-hero-progress-v4 > span {
    display: block;

    margin-top: 14px;

    color: #7b8da2;

    font-size: 12px;
}


.lecturer-hero-progress-v4 > strong {
    display: block;

    margin-top: 3px;

    color: #111827;

    font-size: 32px;

    line-height: 1;
}


.lecturer-hero-progress-v4 progress,
.lecturer-class-progress-v4 {
    width: 100%;

    height: 8px;

    margin-top: 14px;

    border: 0;

    appearance: none;

    -webkit-appearance: none;
}


.lecturer-hero-progress-v4 progress::-webkit-progress-bar,
.lecturer-class-progress-v4::-webkit-progress-bar {
    border-radius: 999px;

    background: #e5edf5;
}


.lecturer-hero-progress-v4 progress::-webkit-progress-value,
.lecturer-class-progress-v4::-webkit-progress-value {
    border-radius: 999px;

    background:
        linear-gradient(
            90deg,
            #2563eb,
            #06b6d4,
            #10b981
        );
}


.lecturer-hero-progress-v4 progress::-moz-progress-bar,
.lecturer-class-progress-v4::-moz-progress-bar {
    border-radius: 999px;

    background:
        linear-gradient(
            90deg,
            #2563eb,
            #06b6d4,
            #10b981
        );
}


/* ==========================================================
   STATS
========================================================== */

.lecturer-stats-v4 {
    margin-top: 20px;

    display: grid;

    grid-template-columns:
        repeat(
            4,
            minmax(0, 1fr)
        );

    gap: 16px;
}


.lecturer-stat-v4 {
    min-width: 0;

    min-height: 135px;

    padding: 20px;

    display: flex;

    align-items: center;

    gap: 15px;

    border:
        1px solid
        rgba(148, 163, 184, .16);

    border-radius: 20px;

    background:
        rgba(255, 255, 255, .92);

    box-shadow:
        0 11px 30px
        rgba(32, 73, 120, .06);
}


.lecturer-stat-icon-v4 {
    width: 50px;
    height: 50px;

    flex-shrink: 0;

    display: flex;

    align-items: center;

    justify-content: center;

    border-radius: 14px;
}


.lecturer-stat-icon-v4 svg {
    width: 22px;
    height: 22px;
}


.stat-blue-v4 {
    color: #2563eb;

    background: #edf5ff;
}


.stat-green-v4 {
    color: #059669;

    background: #eafbf3;
}


.stat-cyan-v4 {
    color: #0891b2;

    background: #e9fbff;
}


.stat-yellow-v4 {
    color: #d97706;

    background: #fff7e6;
}


.lecturer-stat-v4 span {
    display: block;

    color: #75879d;

    font-size: 12px;

    font-weight: 500;
}


.lecturer-stat-v4 strong {
    display: block;

    margin-top: 4px;

    color: #10182b;

    font-size: 29px;

    line-height: 1.1;
}


.lecturer-stat-v4 small {
    display: block;

    margin-top: 6px;

    color: #93a2b4;

    font-size: 10px;
}


/* ==========================================================
   QUICK INSIGHT
========================================================== */

.lecturer-quick-insight-v4 {
    margin-top: 16px;

    padding:
        16px 20px;

    display: grid;

    grid-template-columns:
        repeat(
            4,
            minmax(0, 1fr)
        );

    gap: 16px;

    border:
        1px solid
        rgba(148, 163, 184, .14);

    border-radius: 19px;

    background:
        rgba(255, 255, 255, .84);

    box-shadow:
        0 8px 25px
        rgba(32, 73, 120, .035);
}


.lecturer-quick-insight-v4 article {
    min-width: 0;

    display: flex;

    align-items: center;

    gap: 12px;
}


.quick-icon-v4 {
    width: 39px;
    height: 39px;

    flex-shrink: 0;

    display: flex;

    align-items: center;

    justify-content: center;

    border-radius: 11px;
}


.quick-icon-v4 svg {
    width: 17px;
    height: 17px;
}


.quick-green-v4 {
    color: #059669;

    background: #ecfdf5;
}


.quick-cyan-v4 {
    color: #0891b2;

    background: #ecfeff;
}


.quick-orange-v4 {
    color: #ea580c;

    background: #fff7ed;
}


.quick-purple-v4 {
    color: #7c3aed;

    background: #f5f3ff;
}


.lecturer-quick-insight-v4 strong {
    display: block;

    color: #172033;

    font-size: 16px;
}


.lecturer-quick-insight-v4 span {
    display: block;

    margin-top: 2px;

    color: #78899e;

    font-size: 11px;
}


/* ==========================================================
   MAIN GRID
========================================================== */

.lecturer-main-grid-v4 {
    margin-top: 20px;

    display: grid;

    grid-template-columns:
        minmax(320px, .72fr)
        minmax(0, 1.72fr);

    gap: 20px;

    align-items: start;
}


.lecturer-panel-v4 {
    min-width: 0;

    padding: 26px;

    border:
        1px solid
        rgba(148, 163, 184, .15);

    border-radius: 23px;

    background:
        rgba(255, 255, 255, .94);

    box-shadow:
        0 13px 34px
        rgba(32, 73, 120, .065);
}


.lecturer-panel-heading-v4 {
    display: flex;

    align-items: center;

    justify-content: space-between;

    gap: 16px;
}


.lecturer-panel-heading-v4
>
div:first-child
>
span {
    color: #2563eb;

    font-size: 10px;

    font-weight: 800;

    letter-spacing: 1px;
}


.lecturer-panel-heading-v4 h2 {
    margin-top: 5px;

    color: #162033;

    font-size: 21px;

    line-height: 1.25;
}


.lecturer-panel-icon-v4 {
    width: 44px;
    height: 44px;

    flex-shrink: 0;

    display: flex;

    align-items: center;

    justify-content: center;

    border-radius: 13px;

    color: #2563eb;

    background: #eff6ff;
}


.lecturer-panel-icon-v4 svg {
    width: 19px;
    height: 19px;
}


.panel-cyan-v4 {
    color: #0891b2;

    background: #ecfeff;
}


.panel-green-v4 {
    color: #059669;

    background: #ecfdf5;
}


.panel-orange-v4 {
    color: #d97706;

    background: #fff7ed;
}


.lecturer-panel-description-v4 {
    margin-top: 9px;

    color: #6f8197;

    font-size: 12px;

    line-height: 1.65;
}


/* ==========================================================
   ALERT
========================================================== */

.lecturer-alert-v4 {
    margin-top: 16px;

    padding:
        11px 13px;

    border-radius: 11px;

    font-size: 12px;
}


.lecturer-alert-success-v4 {
    color: #166534;

    border:
        1px solid
        #bbf7d0;

    background: #f0fdf4;
}


.lecturer-alert-error-v4 {
    color: #991b1b;

    border:
        1px solid
        #fecaca;

    background: #fff7f7;
}


/* ==========================================================
   FORM
========================================================== */

.lecturer-create-form-v4 {
    margin-top: 20px;
}


.lecturer-form-group-v4
+
.lecturer-form-group-v4 {
    margin-top: 16px;
}


.lecturer-form-group-v4 label {
    display: block;

    margin-bottom: 8px;

    color: #35465c;

    font-size: 13px;

    font-weight: 700;
}


.lecturer-form-group-v4 input,
.lecturer-form-group-v4 textarea {
    width: 100%;

    border:
        1px solid
        #d5e2ef;

    border-radius: 13px;

    outline: none;

    color: #172033;

    background: #fbfdff;

    font: inherit;

    font-size: 13px;

    transition:
        .2s ease;
}


.lecturer-form-group-v4 input {
    height: 52px;

    padding:
        0 15px;
}


.lecturer-form-group-v4 textarea {
    min-height: 130px;

    padding:
        14px 15px;

    resize: vertical;

    line-height: 1.6;
}


.lecturer-form-group-v4 input:focus,
.lecturer-form-group-v4 textarea:focus {
    border-color: #60a5fa;

    background: #ffffff;

    box-shadow:
        0 0 0 4px
        rgba(37, 99, 235, .07);
}


.lecturer-create-button-v4 {
    width: 100%;

    min-height: 52px;

    margin-top: 18px;

    padding:
        0 16px;

    display: flex;

    align-items: center;

    justify-content: space-between;

    border: 0;

    border-radius: 13px;

    color: #ffffff;

    background:
        linear-gradient(
            105deg,
            #2563eb,
            #06b6d4,
            #10b981
        );

    box-shadow:
        0 13px 27px
        rgba(37, 99, 235, .17);

    font: inherit;

    font-size: 13px;

    font-weight: 800;

    cursor: pointer;

    transition:
        .2s ease;
}


.lecturer-create-button-v4:hover {
    transform:
        translateY(-2px);

    box-shadow:
        0 17px 32px
        rgba(37, 99, 235, .22);
}


.lecturer-create-button-v4 svg {
    width: 18px;
    height: 18px;
}


/* ==========================================================
   CLASS GRID
========================================================== */

.lecturer-class-grid-v4 {
    margin-top: 20px;

    display: grid;

    grid-template-columns:
        repeat(
            2,
            minmax(0, 1fr)
        );

    gap: 16px;
}


.lecturer-class-card-v4 {
    min-width: 0;

    padding: 20px;

    border:
        1px solid
        #dce8f3;

    border-radius: 18px;

    background:
        linear-gradient(
            145deg,
            #ffffff,
            #f8fbff
        );

    transition:
        transform .22s ease,
        box-shadow .22s ease,
        border-color .22s ease;
}


.lecturer-class-card-v4:hover {
    transform:
        translateY(-4px);

    border-color:
        #bfdbfe;

    box-shadow:
        0 16px 34px
        rgba(30, 72, 116, .10);
}


.lecturer-class-card-top-v4 {
    display: flex;

    align-items: center;

    justify-content: space-between;

    gap: 12px;
}


.lecturer-class-symbol-v4 {
    width: 43px;
    height: 43px;

    display: flex;

    align-items: center;

    justify-content: center;

    border-radius: 12px;

    color: #2563eb;

    background: #eff6ff;

    font-size: 21px;

    font-weight: 700;
}


.lecturer-student-count-v4 {
    padding:
        6px 10px;

    border-radius: 999px;

    color: #047857;

    background: #ecfdf5;

    font-size: 11px;

    font-weight: 700;
}


.lecturer-class-card-v4 h3 {
    margin-top: 15px;

    color: #172033;

    font-size: 17px;
}


.lecturer-class-description-v4 {
    min-height: 38px;

    margin-top: 6px;

    color: #73859b;

    font-size: 12px;

    line-height: 1.55;
}


.lecturer-class-code-v4 {
    margin-top: 13px;

    padding:
        11px 12px;

    border-radius: 11px;

    background: #f4f8fc;
}


.lecturer-class-code-v4 span {
    display: block;

    color: #8b9bae;

    font-size: 10px;

    font-weight: 600;
}


.lecturer-class-code-v4 strong {
    display: block;

    margin-top: 3px;

    color: #2563eb;

    font-size: 14px;

    letter-spacing: .6px;
}


.lecturer-class-metrics-v4 {
    margin-top: 12px;

    display: grid;

    grid-template-columns:
        repeat(
            3,
            1fr
        );

    gap: 8px;
}


.lecturer-class-metrics-v4 > div {
    padding:
        10px;

    border-radius: 10px;

    background: #f8fbff;
}


.lecturer-class-metrics-v4 span {
    display: block;

    color: #8e9daf;

    font-size: 10px;
}


.lecturer-class-metrics-v4 strong {
    display: block;

    margin-top: 3px;

    color: #1e293b;

    font-size: 14px;
}


.lecturer-open-class-v4 {
    min-height: 44px;

    margin-top: 15px;

    padding:
        0 13px;

    display: flex;

    align-items: center;

    justify-content: space-between;

    border-radius: 11px;

    color: #2563eb;

    background:
        linear-gradient(
            90deg,
            #eff6ff,
            #ecfeff
        );

    font-size: 12px;

    font-weight: 700;

    text-decoration: none;

    transition:
        .2s ease;
}


.lecturer-open-class-v4:hover {
    color: #1d4ed8;

    background:
        linear-gradient(
            90deg,
            #dbeafe,
            #cffafe
        );
}


.lecturer-open-class-v4 svg {
    width: 17px;
    height: 17px;
}


/* ==========================================================
   BOTTOM
========================================================== */

.lecturer-bottom-grid-v4 {
    margin-top: 20px;

    display: grid;

    grid-template-columns:
        minmax(0, 1.35fr)
        minmax(300px, .65fr);

    gap: 20px;
}


.lecturer-activity-list-v4,
.lecturer-summary-list-v4 {
    margin-top: 19px;

    display: grid;

    gap: 10px;
}


.lecturer-activity-row-v4 {
    min-width: 0;

    padding:
        12px 13px;

    display: grid;

    grid-template-columns:
        42px
        minmax(0, 1fr)
        auto;

    align-items: center;

    gap: 12px;

    border:
        1px solid
        #e8eef5;

    border-radius: 13px;

    background: #fbfdff;
}


.lecturer-activity-avatar-v4 {
    width: 40px;
    height: 40px;

    display: flex;

    align-items: center;

    justify-content: center;

    border-radius: 11px;

    color: #ffffff;

    background:
        linear-gradient(
            145deg,
            #2563eb,
            #06b6d4
        );

    font-size: 12px;

    font-weight: 800;
}


.lecturer-activity-copy-v4 {
    min-width: 0;
}


.lecturer-activity-copy-v4 strong {
    display: block;

    overflow: hidden;

    color: #243247;

    font-size: 13px;

    text-overflow: ellipsis;

    white-space: nowrap;
}


.lecturer-activity-copy-v4 span {
    display: block;

    margin-top: 3px;

    color: #8191a4;

    font-size: 11px;
}


.lecturer-activity-row-v4 time {
    color: #8191a4;

    font-size: 11px;

    white-space: nowrap;
}


.lecturer-summary-row-v4 {
    padding:
        12px 13px;

    display: flex;

    align-items: flex-start;

    gap: 11px;

    border-radius: 12px;

    background: #f8fbff;
}


.summary-dot-v4 {
    width: 9px;
    height: 9px;

    margin-top: 5px;

    flex-shrink: 0;

    border-radius: 50%;
}


.dot-green-v4 {
    background: #10b981;
}


.dot-cyan-v4 {
    background: #06b6d4;
}


.dot-orange-v4 {
    background: #f59e0b;
}


.dot-purple-v4 {
    background: #8b5cf6;
}


.lecturer-summary-row-v4 strong {
    display: block;

    color: #233044;

    font-size: 13px;
}


.lecturer-summary-row-v4 p {
    margin-top: 3px;

    color: #8191a4;

    font-size: 11px;

    line-height: 1.55;
}


/* ==========================================================
   EMPTY
========================================================== */

.lecturer-empty-v4 {
    grid-column:
        1 / -1;

    padding: 36px;

    border:
        1px dashed
        #d5e2ed;

    border-radius: 16px;

    color: #75869a;

    background: #fbfdff;

    text-align: center;
}


.lecturer-empty-v4 > div {
    width: 52px;
    height: 52px;

    margin: 0 auto;

    display: flex;

    align-items: center;

    justify-content: center;

    border-radius: 14px;

    color: #2563eb;

    background: #eff6ff;
}


.lecturer-empty-v4 strong {
    display: block;

    margin-top: 12px;

    color: #334155;

    font-size: 14px;
}


.lecturer-empty-v4 p {
    margin-top: 5px;

    font-size: 12px;

    line-height: 1.5;
}


.lecturer-empty-small-v4 {
    padding: 23px;

    border:
        1px dashed
        #dbe5ef;

    border-radius: 13px;

    text-align: center;

    background: #fbfdff;
}


.lecturer-empty-small-v4 strong {
    display: block;

    color: #334155;

    font-size: 13px;
}


.lecturer-empty-small-v4 span {
    display: block;

    margin-top: 4px;

    color: #8494a7;

    font-size: 11px;
}


/* ==========================================================
   RESPONSIVE
========================================================== */

@media (max-width: 1180px) {

    .lecturer-stats-v4 {
        grid-template-columns:
            repeat(
                2,
                minmax(0, 1fr)
            );
    }


    .lecturer-main-grid-v4 {
        grid-template-columns:
            1fr;
    }

}


@media (max-width: 900px) {

    .lecturer-container-v4 {
        width:
            calc(
                100% - 30px
            );

        padding-top: 26px;
    }


    .lecturer-hero-v4 {
        align-items: stretch;

        flex-direction: column;
    }


    .lecturer-hero-progress-v4 {
        width: 100%;
    }


    .lecturer-quick-insight-v4 {
        grid-template-columns:
            repeat(
                2,
                minmax(0, 1fr)
            );
    }


    .lecturer-class-grid-v4 {
        grid-template-columns:
            1fr;
    }


    .lecturer-bottom-grid-v4 {
        grid-template-columns:
            1fr;
    }

}


@media (max-width: 650px) {

    .lecturer-topbar-v4 {
        min-height: 72px;

        padding:
            9px 13px;
    }


    .lecturer-brand-copy-v4,
    .lecturer-user-copy-v4 {
        display: none;
    }


    .lecturer-brand-logo-v4 {
        width: 60px;
        height: 46px;
    }


    .lecturer-logout-v4 {
        width: 42px;

        padding: 0;

        justify-content: center;
    }


    .lecturer-logout-v4 span {
        display: none;
    }


    .lecturer-hero-v4 {
        min-height: 0;

        padding: 24px;

        border-radius: 21px;
    }


    .lecturer-hero-v4 h1 {
        font-size: 31px;
    }


    .lecturer-hero-v4 p {
        font-size: 13px;
    }


    .lecturer-stats-v4 {
        grid-template-columns:
            1fr;
    }


    .lecturer-quick-insight-v4 {
        grid-template-columns:
            1fr;
    }


    .lecturer-panel-v4 {
        padding: 20px;
    }


    .lecturer-class-metrics-v4 {
        grid-template-columns:
            1fr;
    }


    .lecturer-activity-row-v4 {
        grid-template-columns:
            40px
            minmax(0, 1fr);
    }


    .lecturer-activity-row-v4 time {
        grid-column: 2;
    }

}

</style>

@endpush