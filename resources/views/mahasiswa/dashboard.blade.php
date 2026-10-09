@extends('layouts.mahasiswa')

@section('title', 'Dashboard Mahasiswa - HIMDAS')

@section('content')

<div class="student-dashboard-content">

    {{-- ===================================================== --}}
    {{-- BELUM BERGABUNG KELAS --}}
    {{-- ===================================================== --}}

    @if(!$kelas)

        <section class="student-no-class modern-no-class">

            <div class="modern-no-class-icon">

                <svg
                    viewBox="0 0 24 24"
                    aria-hidden="true"
                >
                    <path
                        d="M4 5.5C4 4.7 4.7 4 5.5 4H10C11.1 4 12 4.9 12 6V20C12 18.9 11.1 18 10 18H5.5C4.7 18 4 18.7 4 19.5V5.5Z"
                    />

                    <path
                        d="M20 5.5C20 4.7 19.3 4 18.5 4H14C12.9 4 12 4.9 12 6V20C12 18.9 12.9 18 14 18H18.5C19.3 18 20 18.7 20 19.5V5.5Z"
                    />
                </svg>

            </div>

            <span class="dashboard-eyebrow">
                MULAI BELAJAR
            </span>

            <h1>
                Kamu Belum Bergabung ke Kelas
            </h1>

            <p>
                Masukkan kode kelas yang diberikan dosen
                untuk mulai menggunakan HIMDAS.
            </p>

            <form
                action="{{ route('kelas.join') }}"
                method="POST"
                class="student-join-form"
            >
                @csrf

                <input
                    type="text"
                    name="kode_kelas"
                    placeholder="Contoh: HIM-XIU5EQ"
                    required
                >

                <button type="submit">
                    Gabung Kelas

                    <span>
                        →
                    </span>
                </button>

            </form>

        </section>

    @else

        {{-- ================================================= --}}
        {{-- HERO --}}
        {{-- ================================================= --}}

        <section class="student-dashboard-hero">

            <div class="student-dashboard-hero-copy">

                <span class="dashboard-eyebrow">
                    DASHBOARD MAHASISWA
                </span>

                <h1>
                    Selamat datang,

                    <span>
                        {{ auth()->user()->name }}
                    </span>
                </h1>

                <p>
                    Lanjutkan perjalanan belajarmu dan
                    tingkatkan pencapaianmu di HIMDAS.
                </p>

                <div class="student-dashboard-meta">

                    <span>

                        <svg
                            viewBox="0 0 24 24"
                            aria-hidden="true"
                        >
                            <rect
                                x="3"
                                y="5"
                                width="18"
                                height="16"
                                rx="3"
                            />

                            <path d="M7 3V7" />
                            <path d="M17 3V7" />
                            <path d="M3 10H21" />
                        </svg>

                        {{ $tanggalHariIni }}

                    </span>

                    <span>

                        <svg
                            viewBox="0 0 24 24"
                            aria-hidden="true"
                        >
                            <circle
                                cx="12"
                                cy="12"
                                r="9"
                            />

                            <path d="M12 7V12L15 14" />
                        </svg>

                        Semester {{ $semester }}

                    </span>

                </div>

            </div>


            {{-- KELAS AKTIF --}}

            <div class="student-active-class-card">

                <div class="student-active-class-icon">

                    <svg
                        viewBox="0 0 24 24"
                        aria-hidden="true"
                    >
                        <path d="M4 5H20V18H4V5Z" />
                        <path d="M8 21H16" />
                        <path d="M12 18V21" />
                        <path d="M8 9H16" />
                        <path d="M8 13H13" />
                    </svg>

                </div>

                <div>

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

        </section>


        {{-- ================================================= --}}
        {{-- STATISTIK --}}
        {{-- ================================================= --}}

        <section class="student-stat-grid dashboard-stat-grid">

            {{-- CAPAIAN MATERI --}}

            <article class="student-stat-card modern-stat-card stat-material">

                <div class="student-stat-icon">

                    <svg
                        viewBox="0 0 24 24"
                        aria-hidden="true"
                    >
                        <path
                            d="M4 5.5C4 4.7 4.7 4 5.5 4H10C11.1 4 12 4.9 12 6V20C12 18.9 11.1 18 10 18H5.5C4.7 18 4 18.7 4 19.5V5.5Z"
                        />

                        <path
                            d="M20 5.5C20 4.7 19.3 4 18.5 4H14C12.9 4 12 4.9 12 6V20C12 18.9 12.9 18 14 18H18.5C19.3 18 20 18.7 20 19.5V5.5Z"
                        />
                    </svg>

                </div>

                <div class="student-stat-info">

                    <span>
                        Capaian Materi
                    </span>

                    <strong>
                        {{ $subbabSelesai }}

                        <small>
                            / {{ $totalSubbab }}
                        </small>
                    </strong>

                    <p>
                        Materi telah diselesaikan
                    </p>

                </div>

                <div class="stat-decoration"></div>

            </article>


            {{-- PROGRESS KESELURUHAN --}}

            <article class="student-stat-card modern-stat-card stat-progress">

                <div class="student-stat-icon">

                    <svg
                        viewBox="0 0 24 24"
                        aria-hidden="true"
                    >
                        <path d="M4 18V11" />
                        <path d="M10 18V6" />
                        <path d="M16 18V9" />
                        <path d="M22 18V3" />
                    </svg>

                </div>

                <div class="student-stat-info">

                    <span>
                        Progress Keseluruhan
                    </span>

                    <strong>
                        {{ round($progress) }}%
                    </strong>

                    <progress
                        class="student-dashboard-progress"
                        value="{{ min(100, max(0, (float) $progress)) }}"
                        max="100"
                    ></progress>

                </div>

                <div class="stat-decoration"></div>

            </article>


            {{-- SEDANG DIPELAJARI --}}

            <article class="student-stat-card modern-stat-card stat-current">

                <div class="student-stat-icon">

                    <svg
                        viewBox="0 0 24 24"
                        aria-hidden="true"
                    >
                        <path
                            d="M5 4H19C20.1 4 21 4.9 21 6V18C21 19.1 20.1 20 19 20H5C3.9 20 3 19.1 3 18V6C3 4.9 3.9 4 5 4Z"
                        />

                        <path d="M8 8H16" />
                        <path d="M8 12H16" />
                        <path d="M8 16H13" />
                    </svg>

                </div>

                <div class="student-stat-info">

                    <span>
                        Sedang Dipelajari
                    </span>

                    <strong class="student-current-material">
                        {{ $sedangDipelajari }}
                    </strong>

                    <p>

                        @if(
                            $subbabSelesai >= $totalSubbab
                        )

                            Seluruh materi sudah selesai

                        @else

                            Lanjutkan pembelajaranmu

                        @endif

                    </p>

                </div>

                <div class="stat-decoration"></div>

            </article>


            {{-- CHALLENGE --}}

            <article class="student-stat-card modern-stat-card stat-challenge">

                <div class="student-stat-icon">

                    <svg
                        viewBox="0 0 24 24"
                        aria-hidden="true"
                    >
                        <path
                            d="M13 2L5 14H11L10 22L19 9H13L13 2Z"
                        />
                    </svg>

                </div>

                <div class="student-stat-info">

                    <span>
                        Challenge Hari Ini
                    </span>

                    <strong>
                        {{ $challengeCompletedToday }}

                        <small>
                            / {{ $challengeDailyTotal }}
                        </small>
                    </strong>

                    <p>

                        @if(
                            $challengeCompletedToday
                            >=
                            $challengeDailyTotal
                        )

                            Semua challenge selesai

                        @elseif(
                            $challengeCompletedToday > 0
                        )

                            {{ $challengeXpToday }} XP diperoleh

                        @else

                            Belum mengerjakan challenge

                        @endif

                    </p>

                </div>

                <div class="stat-decoration"></div>

            </article>

        </section>


        {{-- ================================================= --}}
        {{-- BADGE & GAME --}}
        {{-- ================================================= --}}

        <section class="student-middle-grid dashboard-middle-grid">

            {{-- BADGE --}}

            <article class="student-dashboard-panel modern-dashboard-panel">

                <div class="student-panel-heading">

                    <div>

                        <span>
                            PENCAPAIAN
                        </span>

                        <h2>
                            Badge Terbaru
                        </h2>

                    </div>

                    <div class="student-panel-icon achievement-panel-icon">

                        <svg
                            viewBox="0 0 24 24"
                            aria-hidden="true"
                        >
                            <circle
                                cx="12"
                                cy="8"
                                r="5"
                            />

                            <path
                                d="M8.8 12L7 21L12 18L17 21L15.2 12"
                            />
                        </svg>

                    </div>

                </div>


                @if($badgeTerbaru)

                    <div class="latest-badge-box modern-badge-box">

                        <div class="latest-badge-icon">

                            <svg
                                viewBox="0 0 24 24"
                                aria-hidden="true"
                            >
                                <path
                                    d="M12 3L14.5 8.1L20 8.9L16 12.8L17 18.3L12 15.7L7 18.3L8 12.8L4 8.9L9.5 8.1L12 3Z"
                                />
                            </svg>

                        </div>

                        <div class="latest-badge-copy">

                            <span>
                                BADGE TERBUKA
                            </span>

                            <strong>
                                {{ $badgeTerbaru->name }}
                            </strong>

                            <p>
                                {{ $badgeTerbaru->description }}
                            </p>

                        </div>

                    </div>

                @else

                    <div class="student-empty-panel modern-empty-panel">

                        <div class="modern-empty-icon">

                            <svg
                                viewBox="0 0 24 24"
                                aria-hidden="true"
                            >
                                <circle
                                    cx="12"
                                    cy="8"
                                    r="5"
                                />

                                <path
                                    d="M8.8 12L7 21L12 18L17 21L15.2 12"
                                />
                            </svg>

                        </div>

                        <strong>
                            Belum Ada Badge
                        </strong>

                        <p>
                            Selesaikan materi dan challenge
                            untuk mendapatkan pencapaian.
                        </p>

                    </div>

                @endif


                <a
                    href="{{ route('mahasiswa.badge.index') }}"
                    class="dashboard-panel-link"
                >
                    Lihat semua badge

                    <span>
                        →
                    </span>
                </a>

            </article>


            {{-- GAME --}}

            <article class="student-dashboard-panel modern-dashboard-panel">

                <div class="student-panel-heading">

                    <div>

                        <span>
                            GAMIFIKASI
                        </span>

                        <h2>
                            Game Pembelajaran
                        </h2>

                    </div>

                    <div class="student-panel-icon game-panel-icon">

                        <svg
                            viewBox="0 0 24 24"
                            aria-hidden="true"
                        >
                            <path
                                d="M8 8H16C18.7 8 21 10.3 21 13V17C21 18.7 19.7 20 18 20C17.1 20 16.2 19.6 15.6 18.9L14.7 18H9.3L8.4 18.9C7.8 19.6 6.9 20 6 20C4.3 20 3 18.7 3 17V13C3 10.3 5.3 8 8 8Z"
                            />

                            <path d="M8 12V16" />
                            <path d="M6 14H10" />

                            <circle
                                cx="16.5"
                                cy="12.5"
                                r=".8"
                            />

                            <circle
                                cx="18.5"
                                cy="14.5"
                                r=".8"
                            />
                        </svg>

                    </div>

                </div>


                <div class="student-empty-panel modern-empty-panel game-empty-panel">

                    <div class="modern-empty-icon game-empty-icon">

                        <svg
                            viewBox="0 0 24 24"
                            aria-hidden="true"
                        >
                            <path
                                d="M8 8H16C18.7 8 21 10.3 21 13V17C21 18.7 19.7 20 18 20C17.1 20 16.2 19.6 15.6 18.9L14.7 18H9.3L8.4 18.9C7.8 19.6 6.9 20 6 20C4.3 20 3 18.7 3 17V13C3 10.3 5.3 8 8 8Z"
                            />

                            <path d="M8 12V16" />
                            <path d="M6 14H10" />
                        </svg>

                    </div>

                    <strong>
                        Game Segera Hadir
                    </strong>

                    <p>
                        Game pembelajaran akan tersedia
                        sebagai bagian dari aktivitas HIMDAS.
                    </p>

                </div>

            </article>

        </section>


        {{-- ================================================= --}}
        {{-- AKTIVITAS TERAKHIR --}}
        {{-- ================================================= --}}

        <section
            class="
                student-dashboard-panel
                student-activity-panel
                modern-dashboard-panel
            "
        >

            <div class="student-panel-heading">

                <div>

                    <span>
                        RIWAYAT BELAJAR
                    </span>

                    <h2>
                        Aktivitas Terakhir
                    </h2>

                </div>

                <div class="student-panel-icon activity-panel-icon">

                    <svg
                        viewBox="0 0 24 24"
                        aria-hidden="true"
                    >
                        <circle
                            cx="12"
                            cy="12"
                            r="9"
                        />

                        <path d="M12 7V12L9 14" />
                    </svg>

                </div>

            </div>


            <div class="student-activity-content modern-activity-content">

                <div class="activity-status">

                    <div class="activity-dot"></div>

                    <div class="activity-copy">

                        <strong>

                            @if(
                                $subbabSelesai
                                >=
                                $totalSubbab
                            )

                                Menyelesaikan seluruh
                                {{ $totalSubbab }}
                                materi

                            @elseif(
                                $subbabSelesai > 0
                            )

                                Menyelesaikan
                                {{ $subbabSelesai }}
                                dari
                                {{ $totalSubbab }}
                                materi

                            @else

                                Belum memulai materi

                            @endif

                        </strong>

                        <span>

                            @if($aktivitasTerakhir)

                                Aktivitas terakhir:

                                {{
                                    \Carbon\Carbon::parse(
                                        $aktivitasTerakhir
                                    )
                                    ->locale('id')
                                    ->diffForHumans()
                                }}

                            @else

                                Mulai belajar untuk mencatat aktivitas.

                            @endif

                        </span>

                    </div>

                </div>


                <div class="activity-xp">

                    <div class="activity-xp-icon">

                        <svg
                            viewBox="0 0 24 24"
                            aria-hidden="true"
                        >
                            <path
                                d="M12 3L14.5 8L20 8.8L16 12.7L17 18L12 15.5L7 18L8 12.7L4 8.8L9.5 8L12 3Z"
                            />
                        </svg>

                    </div>

                    <div>

                        <strong>
                            {{ $xp }}
                        </strong>

                        <span>
                            Total XP
                        </span>

                    </div>

                </div>

            </div>

        </section>


        {{-- ================================================= --}}
        {{-- LEADERBOARD --}}
        {{-- ================================================= --}}

        <section
            class="
                student-dashboard-panel
                student-leaderboard-panel
                modern-dashboard-panel
            "
            id="leaderboard"
        >

            <div class="student-panel-heading leaderboard-heading">

                <div>

                    <span>
                        PERINGKAT KELAS
                    </span>

                    <h2>
                        Leaderboard
                    </h2>

                </div>


                <div class="leaderboard-heading-actions">

                    @if($peringkat)

                        <div class="student-my-rank">

                            <span>
                                Peringkat kamu
                            </span>

                            <strong>
                                #{{ $peringkat }}
                            </strong>

                        </div>

                    @endif


                    <a
                        href="{{ route('mahasiswa.leaderboard.index') }}"
                        class="leaderboard-all-link"
                    >
                        Lihat Semua

                        <span>
                            →
                        </span>
                    </a>

                </div>

            </div>


            <div class="student-leaderboard-list modern-leaderboard-list">

                @forelse(
                    $leaderboard->take(5)
                    as $student
                )

                    <div
                        class="
                            student-leaderboard-row
                            modern-leaderboard-row
                            {{
                                $student->is_current_user
                                    ? 'student-leaderboard-me'
                                    : ''
                            }}
                        "
                    >

                        {{-- RANK --}}

                        <div
                            class="
                                student-rank-number
                                rank-{{ min($student->rank, 4) }}
                            "
                        >

                            @if($student->rank == 1)

                                <svg
                                    viewBox="0 0 24 24"
                                    aria-hidden="true"
                                >
                                    <path
                                        d="M8 4H16V8C16 11 14.2 13 12 13C9.8 13 8 11 8 8V4Z"
                                    />

                                    <path d="M12 13V17" />
                                    <path d="M8 21H16" />
                                    <path d="M10 17H14V21H10V17Z" />
                                </svg>

                            @else

                                {{ $student->rank }}

                            @endif

                        </div>


                        {{-- AVATAR --}}

                        <div class="student-leaderboard-avatar">

                            {{
                                mb_strtoupper(
                                    mb_substr(
                                        $student->name,
                                        0,
                                        1
                                    )
                                )
                            }}

                        </div>


                        {{-- USER --}}

                        <div class="student-leaderboard-user">

                            <strong>

                                {{ $student->name }}

                                @if(
                                    $student->is_current_user
                                )

                                    <small>
                                        Kamu
                                    </small>

                                @endif

                            </strong>

                            <span>
                                {{
                                    $student
                                        ->progress_percent
                                }}% progress
                            </span>

                        </div>


                        {{-- XP --}}

                        <div class="student-leaderboard-xp">

                            <strong>
                                {{ $student->xp }}
                            </strong>

                            <span>
                                XP
                            </span>

                        </div>

                    </div>

                @empty

                    <div class="student-empty-panel modern-empty-panel">

                        <div class="modern-empty-icon">

                            <svg
                                viewBox="0 0 24 24"
                                aria-hidden="true"
                            >
                                <path
                                    d="M8 4H16V8C16 11 14.2 13 12 13C9.8 13 8 11 8 8V4Z"
                                />

                                <path d="M12 13V17" />
                                <path d="M8 21H16" />
                            </svg>

                        </div>

                        <strong>
                            Leaderboard Belum Tersedia
                        </strong>

                        <p>
                            Belum ada data peringkat di kelas ini.
                        </p>

                    </div>

                @endforelse

            </div>

        </section>

    @endif

</div>

@endsection