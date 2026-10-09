@extends('layouts.app')

@section('title', $kelas->nama_kelas . ' - HIMDAS')

@section('content')

<section class="class-dashboard-v4">


    {{-- ========================================================= --}}
    {{-- TOPBAR --}}
    {{-- ========================================================= --}}

    <header class="class-topbar-v4">

        <a
            href="{{ route('dosen.dashboard') }}"
            class="class-brand-v4"
        >

            <div class="class-brand-logo-v4">

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
                    Monitoring Kelas
                </span>

            </div>

        </a>


        <div class="class-topbar-actions-v4">

            <a
                href="{{ route('dosen.dashboard') }}"
                class="class-back-button-v4"
            >

                <svg viewBox="0 0 24 24">
                    <path d="M19 12H5M10 7L5 12L10 17" />
                </svg>

                <span>
                    Dashboard
                </span>

            </a>


            <div class="class-account-v4">

                <div class="class-account-avatar-v4">

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

                <div>

                    <strong>
                        {{ auth()->user()->name }}
                    </strong>

                    <span>
                        Dosen
                    </span>

                </div>

            </div>

        </div>

    </header>


    <div class="class-container-v4">


        {{-- ========================================================= --}}
        {{-- HERO --}}
        {{-- ========================================================= --}}

        <section class="class-hero-v4">

            <div class="class-hero-symbol-v4">
                ∩
            </div>


            <div class="class-hero-copy-v4">

                <span class="class-eyebrow-v4">
                    DASHBOARD KELAS
                </span>


                <h1>
                    {{ $kelas->nama_kelas }}
                </h1>


                <p>

                    {{
                        $kelas->deskripsi
                        ?:
                        'Kelas pembelajaran HIMDAS.'
                    }}

                </p>


                <div class="class-teacher-v4">

                    <svg viewBox="0 0 24 24">
                        <circle cx="12" cy="8" r="4" />
                        <path d="M4 21C4 16.6 7.6 13 12 13C16.4 13 20 16.6 20 21" />
                    </svg>

                    <span>
                        Pengajar
                    </span>

                    <strong>
                        {{ $kelas->pembuat->name }}
                    </strong>

                </div>

            </div>


            <div class="class-code-card-v4">

                <span>
                    KODE KELAS
                </span>

                <strong id="classCode">
                    {{ $kelas->kode_kelas }}
                </strong>


                <button
                    type="button"
                    id="copyClassButton"
                    onclick="copyClassCode()"
                >

                    <svg viewBox="0 0 24 24">
                        <rect
                            x="8"
                            y="8"
                            width="11"
                            height="11"
                            rx="2"
                        />

                        <path d="M16 8V6C16 4.9 15.1 4 14 4H6C4.9 4 4 4.9 4 6V14C4 15.1 4.9 16 6 16H8" />
                    </svg>

                    <span>
                        Salin Kode
                    </span>

                </button>

            </div>

        </section>


        {{-- ========================================================= --}}
        {{-- STATS --}}
        {{-- ========================================================= --}}

        <section class="class-stats-v4">


            <article>

                <div class="class-stat-icon-v4 stat-blue-v4">

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
                        {{ $mahasiswa->count() }}
                    </strong>

                    <small>
                        Terdaftar di kelas
                    </small>

                </div>

            </article>


            <article>

                <div class="class-stat-icon-v4 stat-cyan-v4">

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
                        Perkembangan kelas
                    </small>

                </div>

            </article>


            <article>

                <div class="class-stat-icon-v4 stat-yellow-v4">

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
                        Pencapaian aktual
                    </small>

                </div>

            </article>


            <article>

                <div class="class-stat-icon-v4 stat-purple-v4">

                    <svg viewBox="0 0 24 24">
                        <path d="M12 3L14.5 8L20 8.8L16 12.7L17 18L12 15.5L7 18L8 12.7L4 8.8L9.5 8L12 3Z" />
                    </svg>

                </div>


                <div>

                    <span>
                        Total XP
                    </span>

                    <strong>
                        {{ number_format($totalXp) }}
                    </strong>

                    <small>
                        XP seluruh mahasiswa
                    </small>

                </div>

            </article>


            <article>

                <div class="class-stat-icon-v4 stat-green-v4">

                    <svg viewBox="0 0 24 24">
                        <path d="M5 12L10 17L19 7" />
                    </svg>

                </div>


                <div>

                    <span>
                        Selesai Materi
                    </span>

                    <strong>
                        {{ $selesaiMateri }}
                    </strong>

                    <small>
                        Tuntas 6 subbab
                    </small>

                </div>

            </article>


            <article>

                <div class="class-stat-icon-v4 stat-orange-v4">

                    <svg viewBox="0 0 24 24">
                        <path d="M12 3L21 20H3L12 3Z" />
                        <path d="M12 9V14M12 17V17.1" />
                    </svg>

                </div>


                <div>

                    <span>
                        Perlu Perhatian
                    </span>

                    <strong>
                        {{ $perluPerhatian }}
                    </strong>

                    <small>
                        Perlu dipantau dosen
                    </small>

                </div>

            </article>

        </section>


        {{-- ========================================================= --}}
        {{-- SNAPSHOT --}}
        {{-- ========================================================= --}}

        <section class="class-snapshot-v4">

            <article>

                <div class="class-snapshot-icon-v4">

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

                <div class="class-snapshot-icon-v4">

                    <svg viewBox="0 0 24 24">
                        <path d="M13 2L5 14H11L10 22L19 9H13L13 2Z" />
                    </svg>

                </div>


                <div>

                    <strong>
                        {{ $challengeHariIni }}
                    </strong>

                    <span>
                        Challenge dikerjakan hari ini
                    </span>

                </div>

            </article>


            <article>

                <div class="class-snapshot-icon-v4">

                    <svg viewBox="0 0 24 24">
                        <path d="M5 12L10 17L19 7" />
                    </svg>

                </div>


                <div>

                    <strong>
                        {{ $challengeSelesaiHariIni }}
                    </strong>

                    <span>
                        Mahasiswa tuntaskan 6 challenge
                    </span>

                </div>

            </article>

        </section>


        {{-- ========================================================= --}}
        {{-- TABS --}}
        {{-- ========================================================= --}}

        <nav class="class-tabs-v4">

            <button
                type="button"
                class="class-tab-v4 active"
                data-target="students"
                onclick="openClassTab(this)"
            >

                <svg viewBox="0 0 24 24">
                    <circle cx="8" cy="8" r="3" />
                    <path d="M2 20C2 16.7 4.7 14 8 14" />
                    <circle cx="16" cy="9" r="2.5" />
                </svg>

                <span>
                    Mahasiswa
                </span>

            </button>


            <button
                type="button"
                class="class-tab-v4"
                data-target="progress"
                onclick="openClassTab(this)"
            >

                <svg viewBox="0 0 24 24">
                    <path d="M4 18V11M10 18V6M16 18V9M22 18V3" />
                </svg>

                <span>
                    Progress
                </span>

            </button>


            <button
                type="button"
                class="class-tab-v4"
                data-target="badges"
                onclick="openClassTab(this)"
            >

                <svg viewBox="0 0 24 24">
                    <circle cx="12" cy="8" r="5" />
                    <path d="M8.8 12L7 21L12 18L17 21L15.2 12" />
                </svg>

                <span>
                    Badge
                </span>

            </button>


            <button
                type="button"
                class="class-tab-v4"
                data-target="leaderboard"
                onclick="openClassTab(this)"
            >

                <svg viewBox="0 0 24 24">
                    <path d="M8 4H16V8C16 11 14.2 13 12 13C9.8 13 8 11 8 8V4Z" />
                    <path d="M12 13V17M8 21H16M10 17H14V21H10V17Z" />
                </svg>

                <span>
                    Leaderboard
                </span>

            </button>


            <button
                type="button"
                class="class-tab-v4"
                data-target="activity"
                onclick="openClassTab(this)"
            >

                <svg viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="9" />
                    <path d="M12 7V12L9 14" />
                </svg>

                <span>
                    Aktivitas
                </span>

            </button>

        </nav>


        {{-- ========================================================= --}}
        {{-- MAHASISWA --}}
        {{-- ========================================================= --}}

        <div
            class="class-tab-content-v4 active"
            id="students"
        >

            <article class="class-panel-v4">


                <div class="class-panel-heading-v4">

                    <div>

                        <span>
                            DAFTAR KELAS
                        </span>

                        <h2>
                            Mahasiswa
                        </h2>

                        <p>

                            Cari mahasiswa dan lihat kondisi
                            pembelajaran terbarunya.

                        </p>

                    </div>


                    <label class="class-search-v4">

                        <svg viewBox="0 0 24 24">
                            <circle cx="11" cy="11" r="7" />
                            <path d="M20 20L16.5 16.5" />
                        </svg>

                        <input
                            id="studentSearch"
                            type="search"
                            placeholder="Cari mahasiswa..."
                            autocomplete="off"
                        >

                    </label>

                </div>


                <div class="class-table-wrap-v4">

                    <table
                        class="class-table-v4"
                        id="studentTable"
                    >

                        <thead>

                            <tr>

                                <th>
                                    Mahasiswa
                                </th>

                                <th>
                                    Status
                                </th>

                                <th>
                                    Subbab
                                </th>

                                <th>
                                    Progress
                                </th>

                                <th>
                                    XP
                                </th>

                                <th>
                                    Badge
                                </th>

                                <th>
                                    Aktivitas
                                </th>

                            </tr>

                        </thead>


                        <tbody>

                            @forelse($mahasiswa as $student)

                                @php

                                    $progressMahasiswa =
                                        max(
                                            0,
                                            min(
                                                100,
                                                (float) (
                                                    $student
                                                        ->pivot
                                                        ->progress_percent
                                                    ??
                                                    0
                                                )
                                            )
                                        );


                                    $status =
                                        $student
                                            ->monitoring_status;


                                    $statusLabel =
                                        match($status) {

                                            'completed' =>
                                                'Selesai',

                                            'active' =>
                                                'Aktif',

                                            'attention' =>
                                                'Perlu perhatian',

                                            default =>
                                                'Belum mulai',

                                        };

                                @endphp


                                <tr
                                    data-student-name="{{
                                        mb_strtolower(
                                            $student->name
                                            .
                                            ' '
                                            .
                                            $student->email
                                        )
                                    }}"
                                >

                                    <td>

                                        <div class="class-student-v4">

                                            <div class="class-avatar-v4">

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


                                            <div>

                                                <strong>
                                                    {{ $student->name }}
                                                </strong>

                                                <span>
                                                    {{ $student->email }}
                                                </span>

                                            </div>

                                        </div>

                                    </td>


                                    <td>

                                        <span
                                            class="
                                                class-status-v4
                                                status-{{ $status }}-v4
                                            "
                                        >

                                            {{ $statusLabel }}

                                        </span>

                                    </td>


                                    <td>

                                        <strong class="class-table-number-v4">

                                            {{
                                                (int) (
                                                    $student
                                                        ->pivot
                                                        ->subbab_selesai
                                                    ??
                                                    0
                                                )
                                            }}

                                            /

                                            {{
                                                (int) (
                                                    $student
                                                        ->pivot
                                                        ->total_subbab
                                                    ??
                                                    6
                                                )
                                            }}

                                        </strong>

                                    </td>


                                    <td>

                                        <div class="class-progress-cell-v4">

                                            <progress
                                                value="{{ $progressMahasiswa }}"
                                                max="100"
                                            ></progress>

                                            <strong>
                                                {{ round($progressMahasiswa) }}%
                                            </strong>

                                        </div>

                                    </td>


                                    <td>

                                        <strong class="class-xp-v4">

                                            {{
                                                number_format(
                                                    (int) (
                                                        $student
                                                            ->pivot
                                                            ->xp
                                                        ??
                                                        0
                                                    )
                                                )
                                            }}

                                            XP

                                        </strong>

                                    </td>


                                    <td>

                                        <strong class="class-table-number-v4">

                                            {{
                                                $student
                                                    ->himdas_badge_count
                                            }}

                                        </strong>

                                    </td>


                                    <td>

                                        <span class="class-activity-time-v4">

                                            @if(
                                                $student
                                                    ->pivot
                                                    ->last_activity_at
                                            )

                                                {{
                                                    \Carbon\Carbon::parse(
                                                        $student
                                                            ->pivot
                                                            ->last_activity_at
                                                    )
                                                    ->locale('id')
                                                    ->diffForHumans()
                                                }}

                                            @else

                                                Belum ada

                                            @endif

                                        </span>

                                    </td>

                                </tr>


                            @empty

                                <tr>

                                    <td
                                        colspan="7"
                                        class="class-table-empty-v4"
                                    >

                                        Belum ada mahasiswa
                                        di kelas ini.

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>


                <div
                    class="class-search-empty-v4"
                    id="studentSearchEmpty"
                >

                    Mahasiswa tidak ditemukan.

                </div>

            </article>

        </div>


        {{-- ========================================================= --}}
        {{-- PROGRESS --}}
        {{-- ========================================================= --}}

        <div
            class="class-tab-content-v4"
            id="progress"
        >

            <article class="class-panel-v4">

                <div class="class-panel-heading-v4">

                    <div>

                        <span>
                            PEMBELAJARAN
                        </span>

                        <h2>
                            Progress Mahasiswa
                        </h2>

                        <p>

                            Ringkasan capaian materi,
                            XP, badge, dan Latihan Akhir.

                        </p>

                    </div>

                </div>


                <div class="class-progress-grid-v4">

                    @forelse($mahasiswa as $student)

                        @php

                            $progressMahasiswa =
                                max(
                                    0,
                                    min(
                                        100,
                                        (float) (
                                            $student
                                                ->pivot
                                                ->progress_percent
                                            ??
                                            0
                                        )
                                    )
                                );

                        @endphp


                        <article class="class-progress-card-v4">

                            <div class="class-progress-card-head-v4">

                                <div class="class-student-v4">

                                    <div class="class-avatar-v4">

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


                                    <div>

                                        <strong>
                                            {{ $student->name }}
                                        </strong>

                                        <span>

                                            Subbab

                                            {{
                                                (int) (
                                                    $student
                                                        ->pivot
                                                        ->subbab_selesai
                                                    ??
                                                    0
                                                )
                                            }}

                                            dari

                                            {{
                                                (int) (
                                                    $student
                                                        ->pivot
                                                        ->total_subbab
                                                    ??
                                                    6
                                                )
                                            }}

                                        </span>

                                    </div>

                                </div>


                                <strong class="class-progress-big-number-v4">

                                    {{ round($progressMahasiswa) }}%

                                </strong>

                            </div>


                            <progress
                                class="class-progress-card-bar-v4"
                                value="{{ $progressMahasiswa }}"
                                max="100"
                            ></progress>


                            <div class="class-progress-meta-v4">

                                <div>

                                    <span>
                                        XP
                                    </span>

                                    <strong>

                                        {{
                                            number_format(
                                                (int) (
                                                    $student
                                                        ->pivot
                                                        ->xp
                                                    ??
                                                    0
                                                )
                                            )
                                        }}

                                    </strong>

                                </div>


                                <div>

                                    <span>
                                        Badge
                                    </span>

                                    <strong>

                                        {{
                                            $student
                                                ->himdas_badge_count
                                        }}

                                    </strong>

                                </div>


                                <div>

                                    <span>
                                        Latihan Akhir
                                    </span>

                                    <strong>

                                        @if(
                                            $student
                                                ->himdas_latihan_score
                                            !==
                                            null
                                        )

                                            {{
                                                number_format(
                                                    (float)
                                                    $student
                                                        ->himdas_latihan_score,
                                                    0
                                                )
                                            }}%

                                        @else

                                            —

                                        @endif

                                    </strong>

                                </div>

                            </div>

                        </article>


                    @empty

                        <div class="class-empty-block-v4">

                            Belum ada data progress mahasiswa.

                        </div>

                    @endforelse

                </div>

            </article>

        </div>


        {{-- ========================================================= --}}
        {{-- BADGE --}}
        {{-- ========================================================= --}}

        <div
            class="class-tab-content-v4"
            id="badges"
        >

            <article class="class-panel-v4">

                <div class="class-panel-heading-v4">

                    <div>

                        <span>
                            PENCAPAIAN
                        </span>

                        <h2>
                            Badge Mahasiswa
                        </h2>

                        <p>

                            Badge dihitung berdasarkan progress materi,
                            challenge, streak, dan Latihan Akhir.

                        </p>

                    </div>

                </div>


                <div class="class-badge-list-v4">

                    @forelse($mahasiswa as $student)

                        <article class="class-badge-student-v4">

                            <div class="class-badge-head-v4">

                                <div class="class-student-v4">

                                    <div class="class-avatar-v4">

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


                                    <div>

                                        <strong>
                                            {{ $student->name }}
                                        </strong>

                                        <span>

                                            {{
                                                $student
                                                    ->himdas_badge_count
                                            }}

                                            dari 9 badge terbuka

                                        </span>

                                    </div>

                                </div>


                                <div class="class-badge-total-v4">

                                    {{
                                        $student
                                            ->himdas_badge_count
                                    }}/9

                                </div>

                            </div>


                            <div class="class-earned-badges-v4">

                                @forelse(
                                    $student->himdasBadges
                                    as $badge
                                )

                                    <span class="class-earned-badge-v4">

                                        <svg viewBox="0 0 24 24">
                                            <circle
                                                cx="12"
                                                cy="8"
                                                r="5"
                                            />

                                            <path d="M8.8 12L7 21L12 18L17 21L15.2 12" />
                                        </svg>

                                        <span>
                                            {{ $badge['title'] }}
                                        </span>

                                    </span>


                                @empty

                                    <span class="class-no-badge-v4">

                                        Belum memperoleh badge

                                    </span>

                                @endforelse

                            </div>

                        </article>


                    @empty

                        <div class="class-empty-block-v4">

                            Belum ada mahasiswa di kelas ini.

                        </div>

                    @endforelse

                </div>

            </article>

        </div>


        {{-- ========================================================= --}}
        {{-- LEADERBOARD --}}
        {{-- ========================================================= --}}

        <div
            class="class-tab-content-v4"
            id="leaderboard"
        >

            <article class="class-panel-v4">

                <div class="class-panel-heading-v4">

                    <div>

                        <span>
                            PERINGKAT KELAS
                        </span>

                        <h2>
                            Leaderboard
                        </h2>

                        <p>

                            Peringkat berdasarkan XP,
                            subbab selesai, kemudian nama.

                        </p>

                    </div>

                </div>


                <div class="class-leaderboard-list-v4">

                    @forelse($leaderboard as $student)

                        <article
                            class="
                                class-leaderboard-row-v4
                                rank-{{ min($student->rank, 4) }}-v4
                            "
                        >

                            <div class="class-rank-v4">

                                @if($student->rank <= 3)

                                    <svg viewBox="0 0 24 24">

                                        <path d="M8 4H16V8C16 11 14.2 13 12 13C9.8 13 8 11 8 8V4Z" />

                                        <path d="M12 13V17M8 21H16M10 17H14V21H10V17Z" />

                                    </svg>

                                @else

                                    {{ $student->rank }}

                                @endif

                            </div>


                            <div class="class-student-v4">

                                <div class="class-avatar-v4">

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


                                <div>

                                    <strong>
                                        {{ $student->name }}
                                    </strong>

                                    <span>

                                        {{
                                            round(
                                                (float) (
                                                    $student
                                                        ->pivot
                                                        ->progress_percent
                                                    ??
                                                    0
                                                )
                                            )
                                        }}% progress

                                        ·

                                        {{
                                            $student
                                                ->himdas_badge_count
                                        }} badge

                                    </span>

                                </div>

                            </div>


                            <div class="class-leaderboard-xp-v4">

                                <strong>

                                    {{
                                        number_format(
                                            (int) (
                                                $student
                                                    ->pivot
                                                    ->xp
                                                ??
                                                0
                                            )
                                        )
                                    }}

                                </strong>

                                <span>
                                    XP
                                </span>

                            </div>

                        </article>


                    @empty

                        <div class="class-empty-block-v4">

                            Leaderboard belum tersedia.

                        </div>

                    @endforelse

                </div>

            </article>

        </div>


        {{-- ========================================================= --}}
        {{-- AKTIVITAS --}}
        {{-- ========================================================= --}}

        <div
            class="class-tab-content-v4"
            id="activity"
        >

            <div class="class-activity-grid-v4">


                <article class="class-panel-v4">

                    <div class="class-panel-heading-v4">

                        <div>

                            <span>
                                AKTIVITAS TERBARU
                            </span>

                            <h2>
                                Jejak Belajar
                            </h2>

                            <p>

                                Aktivitas terbaru mahasiswa
                                pada kelas ini.

                            </p>

                        </div>

                    </div>


                    <div class="class-activity-list-v4">

                        @forelse(
                            $aktivitasTerbaru
                            as $student
                        )

                            <div class="class-activity-row-v4">

                                <div class="class-avatar-v4">

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


                                <div>

                                    <strong>
                                        {{ $student->name }}
                                    </strong>

                                    <span>

                                        {{
                                            round(
                                                (float) (
                                                    $student
                                                        ->pivot
                                                        ->progress_percent
                                                    ??
                                                    0
                                                )
                                            )
                                        }}% progress

                                        ·

                                        {{
                                            number_format(
                                                (int) (
                                                    $student
                                                        ->pivot
                                                        ->xp
                                                    ??
                                                    0
                                                )
                                            )
                                        }} XP

                                    </span>

                                </div>


                                <time>

                                    {{
                                        \Carbon\Carbon::parse(
                                            $student
                                                ->pivot
                                                ->last_activity_at
                                        )
                                        ->locale('id')
                                        ->diffForHumans()
                                    }}

                                </time>

                            </div>


                        @empty

                            <div class="class-empty-block-v4">

                                Belum ada aktivitas mahasiswa.

                            </div>

                        @endforelse

                    </div>

                </article>


                <article class="class-panel-v4">

                    <div class="class-panel-heading-v4">

                        <div>

                            <span>
                                PERLU PERHATIAN
                            </span>

                            <h2>
                                Mahasiswa Dipantau
                            </h2>

                            <p>

                                Mahasiswa yang membutuhkan
                                perhatian berdasarkan aktivitas.

                            </p>

                        </div>

                    </div>


                    <div class="class-attention-list-v4">

                        @forelse(
                            $mahasiswaPerluPerhatian
                            as $student
                        )

                            <div class="class-attention-row-v4">

                                <div class="class-avatar-v4">

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


                                <div>

                                    <strong>
                                        {{ $student->name }}
                                    </strong>

                                    <span>

                                        @if(
                                            $student
                                                ->pivot
                                                ->last_activity_at
                                        )

                                            Terakhir aktif

                                            {{
                                                \Carbon\Carbon::parse(
                                                    $student
                                                        ->pivot
                                                        ->last_activity_at
                                                )
                                                ->locale('id')
                                                ->diffForHumans()
                                            }}

                                        @else

                                            Belum memiliki aktivitas

                                        @endif

                                    </span>

                                </div>

                            </div>


                        @empty

                            <div class="class-good-state-v4">

                                <svg viewBox="0 0 24 24">
                                    <path d="M5 12L10 17L19 7" />
                                </svg>


                                <div>

                                    <strong>

                                        Tidak ada mahasiswa
                                        tertinggal

                                    </strong>

                                    <span>

                                        Kondisi aktivitas kelas
                                        saat ini terlihat baik.

                                    </span>

                                </div>

                            </div>

                        @endforelse

                    </div>

                </article>

            </div>

        </div>

    </div>


    <div
        class="class-copy-toast-v4"
        id="copyToast"
    >

        Kode kelas berhasil disalin.

    </div>

</section>

@endsection


@push('styles')

<style>

/* ==========================================================
   HIDE PUBLIC NAVBAR
========================================================== */

.public-navbar,
.navbar {
    display: none !important;
}


/* ==========================================================
   ROOT
========================================================== */

.class-dashboard-v4,
.class-dashboard-v4 * {
    box-sizing: border-box;
}


.class-dashboard-v4 {
    min-height: 100vh;

    color: #172033;

    background:
        radial-gradient(
            circle at 94% 3%,
            rgba(34, 211, 238, .15),
            transparent 27%
        ),
        radial-gradient(
            circle at 5% 95%,
            rgba(37, 99, 235, .08),
            transparent 28%
        ),
        linear-gradient(
            135deg,
            #f8fbff,
            #f0f7ff 52%,
            #eaf8ff
        );
}


.class-dashboard-v4 svg {
    width: 21px;
    height: 21px;

    fill: none;

    stroke: currentColor;

    stroke-width: 1.8;

    stroke-linecap: round;
    stroke-linejoin: round;
}


/* ==========================================================
   TOPBAR
========================================================== */

.class-topbar-v4 {
    min-height: 80px;

    padding:
        11px
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

    gap: 20px;

    background:
        radial-gradient(
            circle at 82% -170%,
            rgba(34, 211, 238, .42),
            transparent 42%
        ),
        linear-gradient(
            105deg,
            #092247,
            #174b82 56%,
            #087f95
        );

    box-shadow:
        0 10px 34px
        rgba(7, 26, 56, .16);
}


.class-brand-v4 {
    display: flex;

    align-items: center;

    gap: 12px;

    color: #ffffff;

    text-decoration: none;
}


.class-brand-logo-v4 {
    width: 70px;
    height: 51px;

    padding: 5px;

    display: flex;

    align-items: center;

    justify-content: center;

    border-radius: 14px;

    background: #ffffff;
}


.class-brand-logo-v4 img {
    width: 100%;
    height: 100%;

    object-fit: contain;
}


.class-brand-v4 strong {
    display: block;

    font-size: 16px;
}


.class-brand-v4 span {
    display: block;

    margin-top: 2px;

    color: #bae6fd;

    font-size: 11px;
}


.class-topbar-actions-v4 {
    display: flex;

    align-items: center;

    gap: 14px;
}


.class-back-button-v4 {
    min-height: 42px;

    padding:
        0 14px;

    display: flex;

    align-items: center;

    gap: 8px;

    border:
        1px solid
        rgba(255, 255, 255, .15);

    border-radius: 12px;

    color: #ffffff;

    background:
        rgba(255, 255, 255, .08);

    font-size: 12px;

    font-weight: 700;

    text-decoration: none;
}


.class-back-button-v4 svg {
    width: 17px;
    height: 17px;
}


.class-account-v4 {
    display: flex;

    align-items: center;

    gap: 9px;
}


.class-account-avatar-v4 {
    width: 41px;
    height: 41px;

    display: flex;

    align-items: center;

    justify-content: center;

    border-radius: 50%;

    color: #17427e;

    background: #ffffff;

    font-size: 13px;

    font-weight: 800;
}


.class-account-v4 strong {
    display: block;

    max-width: 190px;

    overflow: hidden;

    color: #ffffff;

    font-size: 12px;

    text-overflow: ellipsis;

    white-space: nowrap;
}


.class-account-v4 span {
    display: block;

    margin-top: 2px;

    color: #bae6fd;

    font-size: 10px;
}


/* ==========================================================
   CONTAINER
========================================================== */

.class-container-v4 {
    width:
        min(
            1380px,
            calc(100% - 52px)
        );

    margin: 0 auto;

    padding:
        36px 0
        58px;
}


/* ==========================================================
   HERO
========================================================== */

.class-hero-v4 {
    min-height: 245px;

    padding:
        38px 40px;

    position: relative;

    overflow: hidden;

    display: flex;

    align-items: center;

    justify-content: space-between;

    gap: 35px;

    border-radius: 28px;

    color: #ffffff;

    background:
        radial-gradient(
            circle at 95% 0,
            rgba(34, 211, 238, .34),
            transparent 33%
        ),
        linear-gradient(
            120deg,
            #0b2c5b,
            #1e528e 58%,
            #087d93
        );

    box-shadow:
        0 20px 48px
        rgba(13, 55, 97, .18);
}


.class-hero-symbol-v4 {
    position: absolute;

    right: 30%;
    bottom: -140px;

    color:
        rgba(255, 255, 255, .045);

    font-family:
        Georgia,
        serif;

    font-size: 280px;

    line-height: 1;

    pointer-events: none;
}


.class-hero-copy-v4 {
    position: relative;

    z-index: 1;

    max-width: 760px;
}


.class-eyebrow-v4 {
    color: #7dd3fc;

    font-size: 11px;

    font-weight: 800;

    letter-spacing: 1.2px;
}


.class-hero-v4 h1 {
    margin-top: 9px;

    font-size:
        clamp(
            37px,
            4vw,
            54px
        );

    font-weight: 800;

    line-height: 1.08;

    letter-spacing: -1.6px;
}


.class-hero-v4 p {
    max-width: 700px;

    margin-top: 10px;

    color: #cbe7f8;

    font-size: 14px;

    line-height: 1.7;
}


.class-teacher-v4 {
    margin-top: 18px;

    display: flex;

    flex-wrap: wrap;

    align-items: center;

    gap: 8px;

    color: #d9effb;

    font-size: 12px;
}


.class-teacher-v4 svg {
    width: 18px;
    height: 18px;
}


.class-teacher-v4 strong {
    color: #ffffff;

    font-size: 12px;
}


/* ==========================================================
   CODE
========================================================== */

.class-code-card-v4 {
    width: 255px;

    flex-shrink: 0;

    padding: 22px;

    position: relative;

    z-index: 1;

    border:
        1px solid
        rgba(255, 255, 255, .18);

    border-radius: 20px;

    background:
        rgba(255, 255, 255, .11);

    backdrop-filter:
        blur(14px);
}


.class-code-card-v4 > span {
    display: block;

    color: #bae6fd;

    font-size: 10px;

    font-weight: 800;

    letter-spacing: .9px;
}


.class-code-card-v4 > strong {
    display: block;

    margin-top: 7px;

    font-size: 24px;

    letter-spacing: .7px;
}


.class-code-card-v4 button {
    min-height: 42px;

    margin-top: 16px;

    padding:
        0 13px;

    display: flex;

    align-items: center;

    gap: 8px;

    border: 0;

    border-radius: 11px;

    color: #17427e;

    background: #ffffff;

    font: inherit;

    font-size: 12px;

    font-weight: 700;

    cursor: pointer;
}


.class-code-card-v4 button svg {
    width: 16px;
    height: 16px;
}


/* ==========================================================
   STATISTICS
========================================================== */

.class-stats-v4 {
    margin-top: 18px;

    display: grid;

    grid-template-columns:
        repeat(
            6,
            minmax(0, 1fr)
        );

    gap: 13px;
}


.class-stats-v4 article {
    min-width: 0;

    min-height: 125px;

    padding: 17px;

    display: flex;

    align-items: center;

    gap: 11px;

    border:
        1px solid
        rgba(148, 163, 184, .15);

    border-radius: 19px;

    background:
        rgba(255, 255, 255, .93);

    box-shadow:
        0 10px 28px
        rgba(32, 73, 120, .055);
}


.class-stat-icon-v4 {
    width: 45px;
    height: 45px;

    flex-shrink: 0;

    display: flex;

    align-items: center;

    justify-content: center;

    border-radius: 13px;
}


.class-stat-icon-v4 svg {
    width: 19px;
    height: 19px;
}


.stat-blue-v4 {
    color: #2563eb;

    background: #eff6ff;
}


.stat-cyan-v4 {
    color: #0891b2;

    background: #ecfeff;
}


.stat-yellow-v4 {
    color: #d97706;

    background: #fff7e6;
}


.stat-purple-v4 {
    color: #7c3aed;

    background: #f5f3ff;
}


.stat-green-v4 {
    color: #059669;

    background: #ecfdf5;
}


.stat-orange-v4 {
    color: #ea580c;

    background: #fff7ed;
}


.class-stats-v4 span {
    display: block;

    color: #7b8b9e;

    font-size: 11px;
}


.class-stats-v4 strong {
    display: block;

    margin-top: 4px;

    color: #10182b;

    font-size: 24px;

    line-height: 1.05;
}


.class-stats-v4 small {
    display: block;

    margin-top: 5px;

    color: #97a5b5;

    font-size: 9px;
}


/* ==========================================================
   SNAPSHOT
========================================================== */

.class-snapshot-v4 {
    margin-top: 15px;

    padding:
        15px 19px;

    display: grid;

    grid-template-columns:
        repeat(
            3,
            minmax(0, 1fr)
        );

    gap: 13px;

    border:
        1px solid
        rgba(148, 163, 184, .14);

    border-radius: 18px;

    background:
        rgba(255, 255, 255, .86);
}


.class-snapshot-v4 article {
    display: flex;

    align-items: center;

    gap: 11px;
}


.class-snapshot-icon-v4 {
    width: 39px;
    height: 39px;

    flex-shrink: 0;

    display: flex;

    align-items: center;

    justify-content: center;

    border-radius: 11px;

    color: #2563eb;

    background: #eff6ff;
}


.class-snapshot-icon-v4 svg {
    width: 17px;
    height: 17px;
}


.class-snapshot-v4 strong {
    display: block;

    color: #172033;

    font-size: 16px;
}


.class-snapshot-v4 span {
    display: block;

    margin-top: 2px;

    color: #7c8da1;

    font-size: 11px;
}


/* ==========================================================
   TABS
========================================================== */

.class-tabs-v4 {
    margin-top: 18px;

    padding: 7px;

    display: flex;

    gap: 6px;

    overflow-x: auto;

    border:
        1px solid
        rgba(148, 163, 184, .15);

    border-radius: 16px;

    background:
        rgba(255, 255, 255, .9);
}


.class-tab-v4 {
    min-height: 45px;

    padding:
        0 15px;

    flex: 0 0 auto;

    display: flex;

    align-items: center;

    gap: 8px;

    border: 0;

    border-radius: 11px;

    color: #60748d;

    background: transparent;

    font: inherit;

    font-size: 12px;

    font-weight: 700;

    cursor: pointer;

    transition:
        .2s ease;
}


.class-tab-v4 svg {
    width: 17px;
    height: 17px;
}


.class-tab-v4:hover {
    background: #f1f7fd;
}


.class-tab-v4.active {
    color: #ffffff;

    background:
        linear-gradient(
            110deg,
            #2563eb,
            #06b6d4
        );

    box-shadow:
        0 8px 18px
        rgba(37, 99, 235, .17);
}


.class-tab-content-v4 {
    display: none;

    margin-top: 17px;
}


.class-tab-content-v4.active {
    display: block;
}


/* ==========================================================
   PANEL
========================================================== */

.class-panel-v4 {
    min-width: 0;

    padding: 28px;

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


.class-panel-heading-v4 {
    display: flex;

    align-items: center;

    justify-content: space-between;

    gap: 18px;
}


.class-panel-heading-v4
>
div:first-child
>
span {
    color: #2563eb;

    font-size: 10px;

    font-weight: 800;

    letter-spacing: 1px;
}


.class-panel-heading-v4 h2 {
    margin-top: 5px;

    color: #162033;

    font-size: 23px;
}


.class-panel-heading-v4 p {
    margin-top: 6px;

    color: #77899f;

    font-size: 12px;

    line-height: 1.55;
}


/* ==========================================================
   SEARCH
========================================================== */

.class-search-v4 {
    width: 270px;

    min-height: 46px;

    padding:
        0 13px;

    display: flex;

    align-items: center;

    gap: 9px;

    border:
        1px solid
        #d9e5f1;

    border-radius: 12px;

    background: #fbfdff;
}


.class-search-v4 svg {
    width: 17px;
    height: 17px;

    color: #7890a8;
}


.class-search-v4 input {
    min-width: 0;

    width: 100%;

    border: 0;

    outline: 0;

    color: #172033;

    background: transparent;

    font: inherit;

    font-size: 12px;
}


/* ==========================================================
   TABLE
========================================================== */

.class-table-wrap-v4 {
    margin-top: 21px;

    overflow-x: auto;
}


.class-table-v4 {
    width: 100%;

    min-width: 1000px;

    border-collapse: collapse;
}


.class-table-v4 th {
    padding:
        13px 12px;

    color: #66788d;

    background: #f5f8fc;

    font-size: 11px;

    font-weight: 700;

    text-align: left;
}


.class-table-v4 th:first-child {
    border-radius:
        11px 0 0 11px;
}


.class-table-v4 th:last-child {
    border-radius:
        0 11px 11px 0;
}


.class-table-v4 td {
    padding:
        14px 12px;

    border-bottom:
        1px solid
        #e9eff5;

    color: #4b6078;

    font-size: 12px;

    vertical-align: middle;
}


.class-student-v4 {
    min-width: 0;

    display: flex;

    align-items: center;

    gap: 11px;
}


.class-avatar-v4 {
    width: 40px;
    height: 40px;

    flex-shrink: 0;

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


.class-student-v4 strong {
    display: block;

    max-width: 220px;

    overflow: hidden;

    color: #1d2939;

    font-size: 13px;

    text-overflow: ellipsis;

    white-space: nowrap;
}


.class-student-v4
span:not(.class-avatar-v4) {
    display: block;

    margin-top: 3px;

    color: #8a99aa;

    font-size: 10px;
}


/* ==========================================================
   STATUS
========================================================== */

.class-status-v4 {
    padding:
        6px 9px;

    display: inline-flex;

    align-items: center;

    border-radius: 999px;

    font-size: 10px;

    font-weight: 700;

    white-space: nowrap;
}


.status-completed-v4 {
    color: #047857;

    background: #ecfdf5;
}


.status-active-v4 {
    color: #0369a1;

    background: #f0f9ff;
}


.status-attention-v4 {
    color: #b45309;

    background: #fffbeb;
}


.status-new-v4 {
    color: #64748b;

    background: #f1f5f9;
}


.class-table-number-v4 {
    color: #334155;

    font-size: 12px;
}


/* ==========================================================
   PROGRESS TABLE
========================================================== */

.class-progress-cell-v4 {
    min-width: 165px;

    display: flex;

    align-items: center;

    gap: 10px;
}


.class-progress-cell-v4 progress,
.class-progress-card-bar-v4 {
    width: 100%;

    height: 8px;

    border: 0;

    appearance: none;

    -webkit-appearance: none;
}


.class-progress-cell-v4 progress::-webkit-progress-bar,
.class-progress-card-bar-v4::-webkit-progress-bar {
    border-radius: 999px;

    background: #e6edf5;
}


.class-progress-cell-v4 progress::-webkit-progress-value,
.class-progress-card-bar-v4::-webkit-progress-value {
    border-radius: 999px;

    background:
        linear-gradient(
            90deg,
            #2563eb,
            #06b6d4,
            #10b981
        );
}


.class-progress-cell-v4 progress::-moz-progress-bar,
.class-progress-card-bar-v4::-moz-progress-bar {
    border-radius: 999px;

    background:
        linear-gradient(
            90deg,
            #2563eb,
            #06b6d4,
            #10b981
        );
}


.class-progress-cell-v4 strong {
    flex-shrink: 0;

    color: #172033;

    font-size: 11px;
}


.class-xp-v4 {
    color: #7c3aed;

    font-size: 12px;

    white-space: nowrap;
}


.class-activity-time-v4 {
    color: #78899e;

    font-size: 11px;

    white-space: nowrap;
}


/* ==========================================================
   PROGRESS CARDS
========================================================== */

.class-progress-grid-v4 {
    margin-top: 21px;

    display: grid;

    grid-template-columns:
        repeat(
            2,
            minmax(0, 1fr)
        );

    gap: 15px;
}


.class-progress-card-v4 {
    padding: 20px;

    border:
        1px solid
        #dfe9f3;

    border-radius: 17px;

    background:
        linear-gradient(
            145deg,
            #ffffff,
            #f8fbff
        );
}


.class-progress-card-head-v4 {
    display: flex;

    align-items: center;

    justify-content: space-between;

    gap: 15px;
}


.class-progress-big-number-v4 {
    color: #2563eb;

    font-size: 24px;

    white-space: nowrap;
}


.class-progress-card-bar-v4 {
    margin-top: 17px;
}


.class-progress-meta-v4 {
    margin-top: 15px;

    display: grid;

    grid-template-columns:
        repeat(
            3,
            1fr
        );

    gap: 9px;
}


.class-progress-meta-v4 > div {
    padding:
        11px;

    border-radius: 10px;

    background: #f4f8fc;
}


.class-progress-meta-v4 span {
    display: block;

    color: #8999ab;

    font-size: 10px;
}


.class-progress-meta-v4 strong {
    display: block;

    margin-top: 3px;

    color: #1e293b;

    font-size: 14px;
}


/* ==========================================================
   BADGE
========================================================== */

.class-badge-list-v4 {
    margin-top: 21px;

    display: grid;

    gap: 12px;
}


.class-badge-student-v4 {
    padding: 18px;

    border:
        1px solid
        #dfe9f3;

    border-radius: 16px;

    background: #fbfdff;
}


.class-badge-head-v4 {
    display: flex;

    align-items: center;

    justify-content: space-between;

    gap: 15px;
}


.class-badge-total-v4 {
    padding:
        7px 11px;

    border-radius: 10px;

    color: #2563eb;

    background: #eff6ff;

    font-size: 12px;

    font-weight: 800;
}


.class-earned-badges-v4 {
    margin-top: 14px;

    display: flex;

    flex-wrap: wrap;

    gap: 8px;
}


.class-earned-badge-v4 {
    min-height: 34px;

    padding:
        6px 10px;

    display: flex;

    align-items: center;

    gap: 6px;

    border:
        1px solid
        #dbe7f3;

    border-radius: 999px;

    color: #31506f;

    background: #ffffff;

    font-size: 11px;

    font-weight: 600;
}


.class-earned-badge-v4 svg {
    width: 15px;
    height: 15px;

    color: #d97706;
}


.class-no-badge-v4 {
    color: #8b9aad;

    font-size: 12px;
}


/* ==========================================================
   LEADERBOARD
========================================================== */

.class-leaderboard-list-v4 {
    margin-top: 21px;

    display: grid;

    gap: 9px;
}


.class-leaderboard-row-v4 {
    min-height: 70px;

    padding:
        10px 13px;

    display: grid;

    grid-template-columns:
        45px
        minmax(0, 1fr)
        auto;

    align-items: center;

    gap: 12px;

    border:
        1px solid
        #e7edf4;

    border-radius: 14px;

    background: #fbfdff;
}


.class-rank-v4 {
    width: 38px;
    height: 38px;

    display: flex;

    align-items: center;

    justify-content: center;

    border-radius: 10px;

    color: #64748b;

    background: #f1f5f9;

    font-size: 13px;

    font-weight: 800;
}


.class-rank-v4 svg {
    width: 18px;
    height: 18px;
}


.rank-1-v4
.class-rank-v4 {
    color: #d97706;

    background: #fff7df;
}


.rank-2-v4
.class-rank-v4 {
    color: #64748b;

    background: #f1f5f9;
}


.rank-3-v4
.class-rank-v4 {
    color: #b45309;

    background: #fff7ed;
}


.class-leaderboard-xp-v4 {
    text-align: right;
}


.class-leaderboard-xp-v4 strong {
    display: block;

    color: #7c3aed;

    font-size: 17px;
}


.class-leaderboard-xp-v4 span {
    color: #8d9cad;

    font-size: 10px;
}


/* ==========================================================
   ACTIVITY
========================================================== */

.class-activity-grid-v4 {
    display: grid;

    grid-template-columns:
        1.2fr
        .8fr;

    gap: 18px;
}


.class-activity-list-v4,
.class-attention-list-v4 {
    margin-top: 20px;

    display: grid;

    gap: 10px;
}


.class-activity-row-v4 {
    min-width: 0;

    padding:
        12px 13px;

    display: grid;

    grid-template-columns:
        40px
        minmax(0, 1fr)
        auto;

    align-items: center;

    gap: 11px;

    border:
        1px solid
        #e8eef5;

    border-radius: 12px;

    background: #fbfdff;
}


.class-activity-row-v4 strong,
.class-attention-row-v4 strong {
    display: block;

    overflow: hidden;

    color: #233044;

    font-size: 13px;

    text-overflow: ellipsis;

    white-space: nowrap;
}


.class-activity-row-v4
span:not(.class-avatar-v4),
.class-attention-row-v4
span:not(.class-avatar-v4) {
    display: block;

    margin-top: 3px;

    color: #8393a6;

    font-size: 11px;
}


.class-activity-row-v4 time {
    color: #7d8fa4;

    font-size: 11px;

    white-space: nowrap;
}


.class-attention-row-v4 {
    padding:
        12px 13px;

    display: grid;

    grid-template-columns:
        40px
        minmax(0, 1fr);

    align-items: center;

    gap: 11px;

    border:
        1px solid
        #e8eef5;

    border-radius: 12px;

    background: #fbfdff;
}


.class-good-state-v4 {
    padding: 17px;

    display: flex;

    align-items: center;

    gap: 12px;

    border:
        1px solid
        #bbf7d0;

    border-radius: 13px;

    color: #166534;

    background: #f0fdf4;
}


.class-good-state-v4 svg {
    width: 22px;
    height: 22px;

    flex-shrink: 0;
}


.class-good-state-v4 strong {
    display: block;

    font-size: 13px;
}


.class-good-state-v4 span {
    display: block;

    margin-top: 3px;

    font-size: 11px;

    line-height: 1.45;
}


/* ==========================================================
   EMPTY
========================================================== */

.class-table-empty-v4,
.class-empty-block-v4 {
    padding: 28px !important;

    color: #7b8da2;

    text-align: center;

    font-size: 12px;
}


.class-search-empty-v4 {
    display: none;

    margin-top: 16px;

    padding: 20px;

    border-radius: 13px;

    color: #718198;

    background: #f7faff;

    text-align: center;

    font-size: 12px;
}


/* ==========================================================
   TOAST
========================================================== */

.class-copy-toast-v4 {
    position: fixed;

    right: 24px;
    bottom: 24px;

    z-index: 500;

    padding:
        12px 16px;

    border-radius: 12px;

    color: #ffffff;

    background: #0f766e;

    box-shadow:
        0 12px 30px
        rgba(15, 118, 110, .25);

    font-size: 12px;

    font-weight: 700;

    opacity: 0;

    pointer-events: none;

    transform:
        translateY(10px);

    transition:
        .22s ease;
}


.class-copy-toast-v4.show {
    opacity: 1;

    transform:
        translateY(0);
}


/* ==========================================================
   RESPONSIVE
========================================================== */

@media (max-width: 1200px) {

    .class-stats-v4 {
        grid-template-columns:
            repeat(
                3,
                minmax(0, 1fr)
            );
    }


    .class-progress-grid-v4 {
        grid-template-columns:
            1fr;
    }

}


@media (max-width: 900px) {

    .class-container-v4 {
        width:
            calc(
                100% - 30px
            );

        padding-top: 26px;
    }


    .class-hero-v4 {
        align-items: stretch;

        flex-direction: column;
    }


    .class-code-card-v4 {
        width: 100%;
    }


    .class-snapshot-v4 {
        grid-template-columns:
            1fr;
    }


    .class-activity-grid-v4 {
        grid-template-columns:
            1fr;
    }


    .class-panel-heading-v4 {
        align-items: stretch;

        flex-direction: column;
    }


    .class-search-v4 {
        width: 100%;
    }

}


@media (max-width: 680px) {

    .class-topbar-v4 {
        min-height: 72px;

        padding:
            9px 13px;
    }


    .class-brand-v4 > div:last-child,
    .class-account-v4 > div:last-child {
        display: none;
    }


    .class-brand-logo-v4 {
        width: 60px;
        height: 46px;
    }


    .class-back-button-v4 span {
        display: none;
    }


    .class-back-button-v4 {
        width: 42px;

        padding: 0;

        justify-content: center;
    }


    .class-hero-v4 {
        min-height: 0;

        padding: 25px;

        border-radius: 21px;
    }


    .class-hero-v4 h1 {
        font-size: 34px;
    }


    .class-hero-v4 p {
        font-size: 13px;
    }


    .class-stats-v4 {
        grid-template-columns:
            repeat(
                2,
                minmax(0, 1fr)
            );
    }


    .class-panel-v4 {
        padding: 20px;
    }


    .class-progress-card-head-v4 {
        align-items: flex-start;

        flex-direction: column;
    }


    .class-progress-meta-v4 {
        grid-template-columns:
            1fr;
    }


    .class-badge-head-v4 {
        align-items: flex-start;

        flex-direction: column;
    }


    .class-activity-row-v4 {
        grid-template-columns:
            40px
            minmax(0, 1fr);
    }


    .class-activity-row-v4 time {
        grid-column: 2;
    }

}


@media (max-width: 430px) {

    .class-stats-v4 {
        grid-template-columns:
            1fr;
    }


    .class-tabs-v4 {
        padding: 5px;
    }


    .class-tab-v4 {
        min-height: 42px;

        padding:
            0 12px;
    }

}

</style>

@endpush


@push('scripts')

<script>

function openClassTab(button)
{
    const targetId =
        button.getAttribute(
            'data-target'
        );


    document
        .querySelectorAll(
            '.class-tab-v4'
        )
        .forEach(
            function (tab) {

                tab.classList.remove(
                    'active'
                );

            }
        );


    document
        .querySelectorAll(
            '.class-tab-content-v4'
        )
        .forEach(
            function (content) {

                content.classList.remove(
                    'active'
                );

            }
        );


    button.classList.add(
        'active'
    );


    const target =
        document.getElementById(
            targetId
        );


    if (target) {

        target.classList.add(
            'active'
        );

    }
}


function copyClassCode()
{
    const codeElement =
        document.getElementById(
            'classCode'
        );


    const button =
        document.getElementById(
            'copyClassButton'
        );


    const toast =
        document.getElementById(
            'copyToast'
        );


    if (!codeElement) {

        return;

    }


    const code =
        codeElement
            .textContent
            .trim();


    const success =
        function () {

            if (button) {

                const label =
                    button.querySelector(
                        'span'
                    );


                if (label) {

                    label.textContent =
                        'Tersalin';


                    setTimeout(
                        function () {

                            label.textContent =
                                'Salin Kode';

                        },
                        1500
                    );

                }

            }


            if (toast) {

                toast.classList.add(
                    'show'
                );


                setTimeout(
                    function () {

                        toast.classList.remove(
                            'show'
                        );

                    },
                    1800
                );

            }

        };


    if (
        navigator.clipboard
        &&
        navigator.clipboard.writeText
    ) {

        navigator.clipboard
            .writeText(
                code
            )
            .then(
                success
            )
            .catch(
                function () {

                    fallbackCopyClassCode(
                        code,
                        success
                    );

                }
            );

    } else {

        fallbackCopyClassCode(
            code,
            success
        );

    }
}


function fallbackCopyClassCode(
    code,
    callback
)
{
    const textarea =
        document.createElement(
            'textarea'
        );


    textarea.value =
        code;


    textarea.style.position =
        'fixed';


    textarea.style.left =
        '-9999px';


    document.body.appendChild(
        textarea
    );


    textarea.focus();

    textarea.select();


    document.execCommand(
        'copy'
    );


    document.body.removeChild(
        textarea
    );


    callback();
}


/* ==========================================================
   SEARCH MAHASISWA
========================================================== */

const studentSearch =
    document.getElementById(
        'studentSearch'
    );


if (studentSearch) {

    studentSearch.addEventListener(
        'input',
        function () {

            const keyword =
                this.value
                    .toLowerCase()
                    .trim();


            const rows =
                document.querySelectorAll(
                    '#studentTable tbody tr[data-student-name]'
                );


            let visible =
                0;


            rows.forEach(
                function (row) {

                    const value =
                        row.getAttribute(
                            'data-student-name'
                        )
                        ||
                        '';


                    const show =
                        value.includes(
                            keyword
                        );


                    row.style.display =
                        show
                            ? ''
                            : 'none';


                    if (show) {

                        visible++;

                    }

                }
            );


            const empty =
                document.getElementById(
                    'studentSearchEmpty'
                );


            if (empty) {

                empty.style.display =
                    visible === 0
                    &&
                    rows.length > 0

                        ? 'block'

                        : 'none';

            }

        }
    );

}

</script>

@endpush