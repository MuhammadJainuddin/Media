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

    <title>
        @yield('title', 'HIMDAS')
    </title>

    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])

    @stack('styles')

</head>


<body class="student-dashboard-body">

@php

    /*
    |--------------------------------------------------------------------------
    | STATUS HALAMAN
    |--------------------------------------------------------------------------
    */

    $isDashboard =
        request()->routeIs(
            'mahasiswa.dashboard'
        );

    $isMateri =
        request()->routeIs(
            'mahasiswa.materi.*'
        );

    $isLatihan =
        request()->routeIs(
            'mahasiswa.latihan.*'
        );

    $isChallenge =
        request()->routeIs(
            'mahasiswa.challenge.*'
        );

    $isBadge =
        request()->routeIs(
            'mahasiswa.badge.*'
        );

    $isLeaderboard =
        request()->routeIs(
            'mahasiswa.leaderboard.*'
        );

    $isProfile =
        request()->routeIs(
            'mahasiswa.profile.*'
        );


    /*
    |--------------------------------------------------------------------------
    | JUDUL HALAMAN
    |--------------------------------------------------------------------------
    */

    if ($isProfile) {

        $studentPageTitle = 'Profil';

    } elseif ($isLeaderboard) {

        $studentPageTitle = 'Leaderboard';

    } elseif ($isBadge) {

        $studentPageTitle = 'Badge';

    } elseif ($isChallenge) {

        $studentPageTitle = 'Challenge';

    } elseif ($isLatihan) {

        $studentPageTitle = 'Latihan';

    } elseif (
        request()->routeIs('mahasiswa.materi.page')
        ||
        request()->routeIs('mahasiswa.materi.show')
    ) {

        $studentPageTitle =
            'Subbab '
            .
            request()->route('level');

    } elseif ($isMateri) {

        $studentPageTitle = 'Materi';

    } elseif ($isDashboard) {

        $studentPageTitle = 'Dashboard';

    } else {

        $studentPageTitle = 'HIMDAS';

    }


    /*
    |--------------------------------------------------------------------------
    | PROGRESS SIDEBAR
    |--------------------------------------------------------------------------
    */

    if (isset($subbabSelesai)) {

        $sidebarSelesai =
            (int) $subbabSelesai;

    } elseif (
        isset($stats)
        &&
        isset($stats['subbab_selesai'])
    ) {

        $sidebarSelesai =
            (int) $stats['subbab_selesai'];

    } else {

        $sidebarSelesai = 0;

    }


    $sidebarSelesai =
        max(
            0,
            min(
                6,
                $sidebarSelesai
            )
        );


    $sidebarUnlocked =
        $sidebarSelesai >= 6
            ? 6
            : $sidebarSelesai + 1;


    $userName =
        auth()->user()->name;


    $userInitial =
        mb_strtoupper(
            mb_substr(
                trim($userName),
                0,
                1
            )
        );

@endphp



<div class="student-app">


    {{-- ===================================================== --}}
    {{-- TOPBAR --}}
    {{-- ===================================================== --}}

    <header class="student-topbar">


        <div class="student-topbar-left">


            {{-- MOBILE BUTTON --}}

            <button
                type="button"
                class="student-mobile-menu-button"
                id="studentMobileMenuButton"
                aria-label="Buka menu navigasi"
                aria-expanded="false"
            >

                <svg
                    viewBox="0 0 24 24"
                    aria-hidden="true"
                >
                    <path
                        d="M4 7H20M4 12H20M4 17H20"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                    />
                </svg>

            </button>



            {{-- BRAND --}}

            <div class="student-brand">

                <a
                    href="{{ route('mahasiswa.dashboard') }}"
                    class="student-brand-logo"
                    aria-label="Dashboard HIMDAS"
                >

                    <img
                        src="{{ asset('images/logo-himdas-new.png') }}"
                        alt="Logo HIMDAS"
                    >

                </a>


                <div class="student-brand-divider"></div>


                <div class="student-brand-copy">

                    <strong>
                        {{ $studentPageTitle }}
                    </strong>

                    <span>
                        Mahasiswa
                    </span>

                </div>

            </div>

        </div>



        {{-- ================================================= --}}
        {{-- PROFILE TOPBAR --}}
        {{-- ================================================= --}}

        <a
            href="{{ route('mahasiswa.profile.index') }}"
            class="student-profile-menu"
        >

            <div class="student-top-avatar">

                {{ $userInitial }}

            </div>


            <div class="student-profile-name">

                <strong>
                    {{ $userName }}
                </strong>

                <span>
                    Mahasiswa
                </span>

            </div>


            <span class="student-profile-arrow">

                <svg
                    viewBox="0 0 24 24"
                    aria-hidden="true"
                >
                    <path
                        d="M9 6L15 12L9 18"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    />
                </svg>

            </span>

        </a>

    </header>



    {{-- ===================================================== --}}
    {{-- BODY --}}
    {{-- ===================================================== --}}

    <div class="student-body-layout">


        {{-- ================================================= --}}
        {{-- SIDEBAR --}}
        {{-- ================================================= --}}

        <aside
            class="student-sidebar"
            id="studentSidebar"
        >


            {{-- MOBILE HEADER --}}

            <div class="student-sidebar-mobile-header">

                <div>

                    <img
                        src="{{ asset('images/logo-himdas-new.png') }}"
                        alt="HIMDAS"
                    >

                </div>


                <button
                    type="button"
                    id="studentSidebarClose"
                    aria-label="Tutup menu"
                >

                    <svg
                        viewBox="0 0 24 24"
                        aria-hidden="true"
                    >
                        <path
                            d="M6 6L18 18M18 6L6 18"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            stroke-linecap="round"
                        />
                    </svg>

                </button>

            </div>



            <nav class="student-sidebar-menu">


                {{-- ================================================= --}}
                {{-- DASHBOARD --}}
                {{-- ================================================= --}}

                <a
                    href="{{ route('mahasiswa.dashboard') }}"
                    class="
                        student-menu-item
                        {{ $isDashboard ? 'active' : '' }}
                    "
                >

                    <span class="student-menu-icon">

                        <svg
                            viewBox="0 0 24 24"
                            aria-hidden="true"
                        >
                            <rect
                                x="3"
                                y="3"
                                width="7"
                                height="7"
                                rx="2"
                            />
                            <rect
                                x="14"
                                y="3"
                                width="7"
                                height="7"
                                rx="2"
                            />
                            <rect
                                x="3"
                                y="14"
                                width="7"
                                height="7"
                                rx="2"
                            />
                            <rect
                                x="14"
                                y="14"
                                width="7"
                                height="7"
                                rx="2"
                            />
                        </svg>

                    </span>

                    <span>
                        Dashboard
                    </span>

                </a>



                {{-- ================================================= --}}
                {{-- MATERI --}}
                {{-- ================================================= --}}

                <div class="student-menu-group">

                    <a
                        href="{{ route('mahasiswa.materi.index') }}"
                        class="
                            student-menu-item
                            {{ $isMateri ? 'active' : '' }}
                        "
                    >

                        <span class="student-menu-icon">

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

                        </span>

                        <span>
                            Materi
                        </span>

                    </a>



                    {{-- SUBBAB --}}

                    @if($isMateri)

                        <div class="student-material-submenu">

                            @for($i = 1; $i <= 6; $i++)

                                @php

                                    $sudahSelesai =
                                        $i <=
                                        $sidebarSelesai;

                                    $terbuka =
                                        $i <=
                                        $sidebarUnlocked;

                                    $routeLevel =
                                        (int) (
                                            request()
                                                ->route('level')
                                            ?? 0
                                        );

                                    $sedangAktif =
                                        (
                                            request()->routeIs(
                                                'mahasiswa.materi.show'
                                            )
                                            ||
                                            request()->routeIs(
                                                'mahasiswa.materi.page'
                                            )
                                        )
                                        &&
                                        $routeLevel === $i;

                                @endphp


                                @if($terbuka)

                                    <a
                                        href="{{
                                            route(
                                                'mahasiswa.materi.show',
                                                [
                                                    'level' => $i
                                                ]
                                            )
                                        }}"
                                        class="
                                            student-submenu-item
                                            {{ $sedangAktif ? 'active' : '' }}
                                            {{ $sudahSelesai ? 'completed' : '' }}
                                        "
                                    >

                                        <span class="student-submenu-number">
                                            {{ $i }}
                                        </span>


                                        <span class="student-submenu-text">
                                            Subbab {{ $i }}
                                        </span>


                                        <span class="student-submenu-status">

                                            @if($sudahSelesai)

                                                ✓

                                            @elseif($sedangAktif)

                                                •

                                            @else

                                                ›

                                            @endif

                                        </span>

                                    </a>

                                @else

                                    <div
                                        class="student-submenu-item locked"
                                        title="Selesaikan subbab sebelumnya terlebih dahulu"
                                    >

                                        <span class="student-submenu-number">
                                            {{ $i }}
                                        </span>

                                        <span class="student-submenu-text">
                                            Subbab {{ $i }}
                                        </span>

                                        <span class="student-submenu-status">
                                            –
                                        </span>

                                    </div>

                                @endif

                            @endfor

                        </div>

                    @endif

                </div>



                {{-- ================================================= --}}
                {{-- LATIHAN --}}
                {{-- ================================================= --}}

                <a
                    href="{{ route('mahasiswa.latihan.index') }}"
                    class="
                        student-menu-item
                        {{ $isLatihan ? 'active' : '' }}
                    "
                >

                    <span class="student-menu-icon">

                        <svg
                            viewBox="0 0 24 24"
                            aria-hidden="true"
                        >
                            <path
                                d="M6 3H18C19.1 3 20 3.9 20 5V19C20 20.1 19.1 21 18 21H6C4.9 21 4 20.1 4 19V5C4 3.9 4.9 3 6 3Z"
                            />

                            <path d="M8 8H16" />
                            <path d="M8 12H16" />
                            <path d="M8 16H13" />
                        </svg>

                    </span>

                    <span>
                        Latihan
                    </span>

                </a>



                {{-- ================================================= --}}
                {{-- CHALLENGE --}}
                {{-- ================================================= --}}

                <a
                    href="{{ route('mahasiswa.challenge.index') }}"
                    class="
                        student-menu-item
                        {{ $isChallenge ? 'active' : '' }}
                    "
                >

                    <span class="student-menu-icon">

                        <svg
                            viewBox="0 0 24 24"
                            aria-hidden="true"
                        >
                            <path
                                d="M13 2L5 14H11L10 22L19 9H13L13 2Z"
                            />
                        </svg>

                    </span>

                    <span>
                        Challenge
                    </span>

                </a>



                {{-- ================================================= --}}
                {{-- GAME --}}
                {{-- ================================================= --}}

                <a
                    href="#"
                    class="student-menu-item"
                    onclick="return false;"
                    title="Game pembelajaran akan dikembangkan"
                >

                    <span class="student-menu-icon">

                        <svg
                            viewBox="0 0 24 24"
                            aria-hidden="true"
                        >
                            <path
                                d="M8 8H16C18.7 8 21 10.3 21 13V17C21 18.7 19.7 20 18 20C17.1 20 16.2 19.6 15.6 18.9L14.7 18H9.3L8.4 18.9C7.8 19.6 6.9 20 6 20C4.3 20 3 18.7 3 17V13C3 10.3 5.3 8 8 8Z"
                            />
                            <path d="M8 12V16" />
                            <path d="M6 14H10" />
                            <circle cx="16.5" cy="12.5" r=".9" />
                            <circle cx="18.5" cy="14.5" r=".9" />
                        </svg>

                    </span>

                    <span>
                        Game
                    </span>

                </a>



                {{-- ================================================= --}}
                {{-- BADGE --}}
                {{-- ================================================= --}}

                <a
                    href="{{ route('mahasiswa.badge.index') }}"
                    class="
                        student-menu-item
                        {{ $isBadge ? 'active' : '' }}
                    "
                >

                    <span class="student-menu-icon">

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

                    </span>

                    <span>
                        Badge
                    </span>

                </a>



                {{-- ================================================= --}}
                {{-- LEADERBOARD --}}
                {{-- ================================================= --}}

                <a
                    href="{{ route('mahasiswa.leaderboard.index') }}"
                    class="
                        student-menu-item
                        {{ $isLeaderboard ? 'active' : '' }}
                    "
                >

                    <span class="student-menu-icon">

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
                            <path
                                d="M8 6H5V8C5 10 6.3 11 8.3 11"
                            />
                            <path
                                d="M16 6H19V8C19 10 17.7 11 15.7 11"
                            />
                        </svg>

                    </span>

                    <span>
                        Leaderboard
                    </span>

                </a>



                {{-- ================================================= --}}
                {{-- PROFILE --}}
                {{-- ================================================= --}}

                <a
                    href="{{ route('mahasiswa.profile.index') }}"
                    class="
                        student-menu-item
                        {{ $isProfile ? 'active' : '' }}
                    "
                >

                    <span class="student-menu-icon">

                        <svg
                            viewBox="0 0 24 24"
                            aria-hidden="true"
                        >
                            <circle
                                cx="12"
                                cy="8"
                                r="4"
                            />
                            <path
                                d="M4 21C4 16.6 7.6 13 12 13C16.4 13 20 16.6 20 21"
                            />
                        </svg>

                    </span>

                    <span>
                        Profil
                    </span>

                </a>

            </nav>



            {{-- ================================================= --}}
            {{-- SIDEBAR FOOTER --}}
            {{-- ================================================= --}}

            <div class="student-sidebar-bottom">

                <div class="student-sidebar-footer-icon">

                    <svg
                        viewBox="0 0 24 24"
                        aria-hidden="true"
                    >
                        <path
                            d="M5 12C5 8.1 8.1 5 12 5C15.9 5 19 8.1 19 12C19 15.9 15.9 19 12 19C8.1 19 5 15.9 5 12Z"
                        />

                        <path
                            d="M2 12C2 6.5 6.5 2 12 2"
                        />

                        <path
                            d="M22 12C22 17.5 17.5 22 12 22"
                        />
                    </svg>

                </div>


                <div>

                    <strong>
                        HIMDAS
                    </strong>

                    <span>
                        6 level pembelajaran
                    </span>

                </div>

            </div>

        </aside>



        {{-- ================================================= --}}
        {{-- MAIN CONTENT --}}
        {{-- ================================================= --}}

        <main class="student-main">

            @yield('content')

        </main>

    </div>

</div>



{{-- MOBILE OVERLAY --}}

<div
    class="student-sidebar-overlay"
    id="studentSidebarOverlay"
></div>



{{-- ===================================================== --}}
{{-- MOBILE SIDEBAR SCRIPT --}}
{{-- ===================================================== --}}

<script>

(function () {

    const body =
        document.body;

    const openButton =
        document.getElementById(
            'studentMobileMenuButton'
        );

    const closeButton =
        document.getElementById(
            'studentSidebarClose'
        );

    const overlay =
        document.getElementById(
            'studentSidebarOverlay'
        );


    function openSidebar() {

        body.classList.add(
            'student-sidebar-open'
        );

        if (openButton) {

            openButton.setAttribute(
                'aria-expanded',
                'true'
            );

        }

    }


    function closeSidebar() {

        body.classList.remove(
            'student-sidebar-open'
        );

        if (openButton) {

            openButton.setAttribute(
                'aria-expanded',
                'false'
            );

        }

    }


    if (openButton) {

        openButton.addEventListener(
            'click',
            openSidebar
        );

    }


    if (closeButton) {

        closeButton.addEventListener(
            'click',
            closeSidebar
        );

    }


    if (overlay) {

        overlay.addEventListener(
            'click',
            closeSidebar
        );

    }


    document
        .querySelectorAll(
            '.student-sidebar a'
        )
        .forEach(function (link) {

            link.addEventListener(
                'click',
                function () {

                    if (
                        window.innerWidth
                        <=
                        960
                    ) {

                        closeSidebar();

                    }

                }
            );

        });


    document.addEventListener(
        'keydown',
        function (event) {

            if (
                event.key ===
                'Escape'
            ) {

                closeSidebar();

            }

        }
    );


    window.addEventListener(
        'resize',
        function () {

            if (
                window.innerWidth
                >
                960
            ) {

                closeSidebar();

            }

        }
    );

})();

</script>


@stack('scripts')


</body>

</html>