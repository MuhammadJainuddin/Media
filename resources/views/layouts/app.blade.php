<!DOCTYPE html>

<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <meta
        name="description"
        content="HIMDAS - Media Pembelajaran Interaktif Matematika Dasar pada Materi Himpunan dengan Pendekatan Gamifikasi"
    >

    <meta
        name="csrf-token"
        content="{{ csrf_token() }}"
    >

    <meta
        name="theme-color"
        content="#0f2f68"
    >

    <title>
        @yield(
            'title',
            'HIMDAS'
        )
    </title>


    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])


    @stack('styles')

</head>


<body class="public-site-body">


    {{-- ===================================================== --}}
    {{-- NAVBAR --}}
    {{-- ===================================================== --}}

    <header
        class="navbar public-navbar"
        id="publicNavbar"
    >

        <div class="nav-container public-nav-container">


            {{-- ================================================= --}}
            {{-- LOGO --}}
            {{-- ================================================= --}}

            <a
                href="{{ route('home') }}"
                class="logo public-logo"
                aria-label="HIMDAS - Beranda"
            >

                <img
                    src="{{ asset('images/logo-himdas-new.png') }}"
                    alt="Logo HIMDAS"
                    class="logo-image public-logo-image"
                >

            </a>



            {{-- ================================================= --}}
            {{-- DESKTOP / MOBILE NAVIGATION --}}
            {{-- ================================================= --}}

            <nav
                class="nav-menu public-nav-menu"
                id="navMenu"
                aria-label="Navigasi utama"
            >


                {{-- BERANDA --}}

                <a
                    href="{{ route('home') }}"
                    class="
                        nav-link
                        public-nav-link
                        {{
                            request()->routeIs('home')
                                ? 'active'
                                : ''
                        }}
                    "
                    @if(request()->routeIs('home'))
                        aria-current="page"
                    @endif
                >

                    <span>
                        Beranda
                    </span>

                </a>



                {{-- TENTANG --}}

                <a
                    href="{{ route('tentang') }}"
                    class="
                        nav-link
                        public-nav-link
                        {{
                            request()->routeIs('tentang')
                                ? 'active'
                                : ''
                        }}
                    "
                    @if(request()->routeIs('tentang'))
                        aria-current="page"
                    @endif
                >

                    <span>
                        Tentang
                    </span>

                </a>



                {{-- PETUNJUK --}}

                <a
                    href="{{ route('petunjuk') }}"
                    class="
                        nav-link
                        public-nav-link
                        {{
                            request()->routeIs('petunjuk')
                                ? 'active'
                                : ''
                        }}
                    "
                    @if(request()->routeIs('petunjuk'))
                        aria-current="page"
                    @endif
                >

                    <span>
                        Petunjuk
                    </span>

                </a>



                {{-- ================================================= --}}
                {{-- LOGIN --}}
                {{-- ================================================= --}}

                <a
                    href="{{ route('login') }}"
                    class="
                        login-button
                        public-login-button
                    "
                >

                    <span class="public-login-icon">

                        <svg
                            width="17"
                            height="17"
                            viewBox="0 0 24 24"
                            fill="none"
                            aria-hidden="true"
                        >

                            <path
                                d="M9 5H5.8C4.806 5 4 5.806 4 6.8V17.2C4 18.194 4.806 19 5.8 19H9"
                                stroke="currentColor"
                                stroke-width="1.8"
                                stroke-linecap="round"
                            />

                            <path
                                d="M14 8L18 12L14 16"
                                stroke="currentColor"
                                stroke-width="1.8"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            />

                            <path
                                d="M8 12H18"
                                stroke="currentColor"
                                stroke-width="1.8"
                                stroke-linecap="round"
                            />

                        </svg>

                    </span>


                    <span>
                        Masuk
                    </span>

                </a>


            </nav>



            {{-- ================================================= --}}
            {{-- MOBILE MENU BUTTON --}}
            {{-- ================================================= --}}

            <button
                type="button"
                class="
                    mobile-menu-button
                    public-mobile-menu-button
                "
                id="mobileMenuButton"
                aria-label="Buka menu navigasi"
                aria-controls="navMenu"
                aria-expanded="false"
            >

                <span></span>

                <span></span>

                <span></span>

            </button>


        </div>

    </header>



    {{-- ===================================================== --}}
    {{-- MOBILE BACKDROP --}}
    {{-- ===================================================== --}}

    <button
        type="button"
        class="public-nav-backdrop"
        id="navBackdrop"
        aria-label="Tutup menu navigasi"
        tabindex="-1"
    ></button>



    {{-- ===================================================== --}}
    {{-- CONTENT --}}
    {{-- ===================================================== --}}

    <main class="public-main">

        @yield('content')

    </main>



    {{-- ===================================================== --}}
    {{-- GLOBAL PUBLIC SCRIPT --}}
    {{-- ===================================================== --}}

    <script>

        document.addEventListener(
            'DOMContentLoaded',
            function () {

                /*
                |--------------------------------------------------------------------------
                | ELEMENTS
                |--------------------------------------------------------------------------
                */

                const navbar =
                    document.getElementById(
                        'publicNavbar'
                    );


                const mobileMenuButton =
                    document.getElementById(
                        'mobileMenuButton'
                    );


                const navMenu =
                    document.getElementById(
                        'navMenu'
                    );


                const navBackdrop =
                    document.getElementById(
                        'navBackdrop'
                    );


                /*
                |--------------------------------------------------------------------------
                | OPEN MOBILE MENU
                |--------------------------------------------------------------------------
                */

                function openMobileMenu() {

                    if (
                        !navMenu
                        ||
                        !mobileMenuButton
                    ) {
                        return;
                    }


                    navMenu.classList.add(
                        'show'
                    );


                    mobileMenuButton.classList.add(
                        'active'
                    );


                    mobileMenuButton.setAttribute(
                        'aria-expanded',
                        'true'
                    );


                    if (navBackdrop) {

                        navBackdrop.classList.add(
                            'show'
                        );

                    }


                    document.body.classList.add(
                        'public-menu-open'
                    );

                }


                /*
                |--------------------------------------------------------------------------
                | CLOSE MOBILE MENU
                |--------------------------------------------------------------------------
                */

                function closeMobileMenu() {

                    if (
                        !navMenu
                        ||
                        !mobileMenuButton
                    ) {
                        return;
                    }


                    navMenu.classList.remove(
                        'show'
                    );


                    mobileMenuButton.classList.remove(
                        'active'
                    );


                    mobileMenuButton.setAttribute(
                        'aria-expanded',
                        'false'
                    );


                    if (navBackdrop) {

                        navBackdrop.classList.remove(
                            'show'
                        );

                    }


                    document.body.classList.remove(
                        'public-menu-open'
                    );

                }


                /*
                |--------------------------------------------------------------------------
                | TOGGLE MOBILE MENU
                |--------------------------------------------------------------------------
                */

                if (
                    mobileMenuButton
                    &&
                    navMenu
                ) {

                    mobileMenuButton.addEventListener(
                        'click',
                        function () {

                            if (
                                navMenu.classList.contains(
                                    'show'
                                )
                            ) {

                                closeMobileMenu();

                            } else {

                                openMobileMenu();

                            }

                        }
                    );

                }


                /*
                |--------------------------------------------------------------------------
                | BACKDROP
                |--------------------------------------------------------------------------
                */

                if (navBackdrop) {

                    navBackdrop.addEventListener(
                        'click',
                        function () {

                            closeMobileMenu();

                        }
                    );

                }


                /*
                |--------------------------------------------------------------------------
                | CLOSE AFTER CLICKING LINK
                |--------------------------------------------------------------------------
                */

                document
                    .querySelectorAll(
                        '.public-nav-menu a'
                    )
                    .forEach(
                        function (link) {

                            link.addEventListener(
                                'click',
                                function () {

                                    closeMobileMenu();

                                }
                            );

                        }
                    );


                /*
                |--------------------------------------------------------------------------
                | ESCAPE KEY
                |--------------------------------------------------------------------------
                */

                document.addEventListener(
                    'keydown',
                    function (event) {

                        if (
                            event.key ===
                            'Escape'
                        ) {

                            closeMobileMenu();

                        }

                    }
                );


                /*
                |--------------------------------------------------------------------------
                | RESIZE
                |--------------------------------------------------------------------------
                */

                window.addEventListener(
                    'resize',
                    function () {

                        if (
                            window.innerWidth
                            >
                            650
                        ) {

                            closeMobileMenu();

                        }

                    }
                );


                /*
                |--------------------------------------------------------------------------
                | NAVBAR SCROLL EFFECT
                |--------------------------------------------------------------------------
                */

                function updateNavbarState() {

                    if (!navbar) {
                        return;
                    }


                    if (
                        window.scrollY
                        >
                        12
                    ) {

                        navbar.classList.add(
                            'scrolled'
                        );

                    } else {

                        navbar.classList.remove(
                            'scrolled'
                        );

                    }

                }


                updateNavbarState();


                window.addEventListener(
                    'scroll',
                    updateNavbarState,
                    {
                        passive: true
                    }
                );

            }
        );

    </script>



    {{-- ===================================================== --}}
    {{-- PAGE SCRIPTS --}}
    {{-- ===================================================== --}}

    @stack('scripts')


</body>

</html>