@extends('layouts.mahasiswa')

@section('title', 'Profil - HIMDAS')

@section('content')

<section class="profile-page">

    <div class="profile-container">


        {{-- ===================================================== --}}
        {{-- HEADER --}}
        {{-- ===================================================== --}}

        <div class="profile-heading">

            <div>

                <span class="profile-eyebrow">
                    AKUN MAHASISWA
                </span>

                <h1>
                    Profil Saya
                </h1>

                <p>
                    Kelola informasi akun yang digunakan
                    selama mengakses media pembelajaran HIMDAS.
                </p>

            </div>

        </div>


        {{-- ===================================================== --}}
        {{-- SUCCESS MESSAGE --}}
        {{-- ===================================================== --}}

        @if(session('success'))

            <div class="profile-success">

                <span>
                    ✓
                </span>

                <div>

                    <strong>
                        Berhasil
                    </strong>

                    <p>
                        {{ session('success') }}
                    </p>

                </div>

            </div>

        @endif



        {{-- ===================================================== --}}
        {{-- PROFILE GRID --}}
        {{-- ===================================================== --}}

        <div class="profile-grid">


            {{-- ================================================= --}}
            {{-- KARTU PROFIL --}}
            {{-- ================================================= --}}

            <div class="profile-card-left">


                <div class="profile-cover"></div>


                <div class="profile-card-content">


                    {{-- AVATAR --}}

                    <div class="profile-avatar">

                        {{ $initial }}

                    </div>


                    {{-- NAME --}}

                    <h2>
                        {{ $user->name }}
                    </h2>


                    {{-- ROLE --}}

                    <span class="profile-role">

                        Mahasiswa

                    </span>


                    {{-- TEXT --}}

                    <p class="profile-description">

                        Akun mahasiswa HIMDAS yang digunakan
                        untuk mengakses materi dan aktivitas
                        pembelajaran.

                    </p>


                    {{-- BUTTONS --}}

                    <div class="profile-action-list">


                        <a
                            href="{{ route('mahasiswa.profile.edit') }}"
                            class="profile-edit-button"
                        >

                            <span>
                                ✎
                            </span>

                            Edit Profil

                        </a>


                        <form
                            action="{{ route('logout') }}"
                            method="POST"
                        >

                            @csrf


                            <button
                                type="submit"
                                class="profile-logout-button"
                            >

                                <span>
                                    ↪
                                </span>

                                Keluar

                            </button>

                        </form>


                    </div>


                </div>

            </div>



            {{-- ================================================= --}}
            {{-- INFORMASI AKUN --}}
            {{-- ================================================= --}}

            <div class="profile-information-card">


                {{-- HEADER --}}

                <div class="profile-information-header">

                    <div class="profile-information-icon">

                        👤

                    </div>


                    <div>

                        <span>
                            DETAIL PROFIL
                        </span>

                        <h2>
                            Informasi Akun
                        </h2>

                        <p>
                            Informasi akun mahasiswa yang sedang aktif.
                        </p>

                    </div>

                </div>



                {{-- ================================================= --}}
                {{-- DATA --}}
                {{-- ================================================= --}}

                <div class="profile-information-list">


                    {{-- NAMA --}}

                    <div class="profile-information-row">

                        <div class="profile-row-icon">
                            👤
                        </div>


                        <div class="profile-row-label">

                            <span>
                                NAMA
                            </span>

                            <strong>
                                Nama Lengkap
                            </strong>

                        </div>


                        <div class="profile-row-value">

                            {{ $user->name }}

                        </div>

                    </div>



                    {{-- EMAIL --}}

                    <div class="profile-information-row">

                        <div class="profile-row-icon">
                            ✉
                        </div>


                        <div class="profile-row-label">

                            <span>
                                EMAIL
                            </span>

                            <strong>
                                Alamat Email
                            </strong>

                        </div>


                        <div class="profile-row-value">

                            {{ $user->email }}

                        </div>

                    </div>



                    {{-- AKSES --}}

                    <div class="profile-information-row">

                        <div class="profile-row-icon">
                            🔑
                        </div>


                        <div class="profile-row-label">

                            <span>
                                AKSES
                            </span>

                            <strong>
                                Jenis Akun
                            </strong>

                        </div>


                        <div class="profile-row-value">

                            <span class="profile-access-badge">

                                {{ $accessLabel }}

                            </span>

                        </div>

                    </div>



                    {{-- KELAS AKTIF --}}

                    <div class="profile-information-row">

                        <div class="profile-row-icon">
                            📚
                        </div>


                        <div class="profile-row-label">

                            <span>
                                KELAS AKTIF
                            </span>

                            <strong>
                                Kelas Pembelajaran
                            </strong>

                        </div>


                        <div class="profile-row-value">

                            {{ $kelas->nama_kelas }}

                        </div>

                    </div>



                    {{-- KODE KELAS --}}

                    <div class="profile-information-row">

                        <div class="profile-row-icon">
                            #
                        </div>


                        <div class="profile-row-label">

                            <span>
                                KODE KELAS
                            </span>

                            <strong>
                                Kode Akses Kelas
                            </strong>

                        </div>


                        <div class="profile-row-value">

                            <span class="profile-class-code">

                                {{ $kelas->kode_kelas }}

                            </span>

                        </div>

                    </div>


                </div>



                {{-- ================================================= --}}
                {{-- FOOTER --}}
                {{-- ================================================= --}}

                <div class="profile-information-footer">

                    <div class="profile-footer-icon">
                        🔒
                    </div>

                    <div>

                        <strong>
                            Informasi Akun
                        </strong>

                        <p>
                            Pastikan nama dan email akunmu sudah benar.
                            Gunakan menu Edit Profil jika ingin
                            memperbarui informasi akun.
                        </p>

                    </div>

                </div>


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

.profile-page {

    --profile-navy: #172554;
    --profile-blue: #2563eb;
    --profile-blue-dark: #1d4ed8;

    --profile-soft: #eff6ff;
    --profile-soft-2: #dbeafe;
    --profile-soft-3: #bfdbfe;

    --profile-text: #0f172a;
    --profile-muted: #64748b;
    --profile-muted-light: #94a3b8;

    --profile-border: #dbe4ee;

    width: 100%;

    padding: 32px;

}


.profile-container {

    width: 100%;

    max-width: 1180px;

    margin: 0 auto;

}


/* ========================================================= */
/* HEADING */
/* ========================================================= */

.profile-heading {

    display: flex;

    align-items: flex-end;

    justify-content: space-between;

    gap: 20px;

    margin-bottom: 22px;

}


.profile-eyebrow {

    display: block;

    margin-bottom: 6px;

    color:
        var(--profile-blue);

    font-size: 10px;

    font-weight: 800;

    letter-spacing: .9px;

}


.profile-heading h1 {

    margin: 0;

    color:
        var(--profile-text);

    font-size: 30px;

    font-weight: 800;

}


.profile-heading p {

    max-width: 620px;

    margin:
        8px
        0
        0;

    color:
        var(--profile-muted);

    font-size: 12px;

    line-height: 1.7;

}


/* ========================================================= */
/* SUCCESS */
/* ========================================================= */

.profile-success {

    display: flex;

    align-items: center;

    gap: 12px;

    margin-bottom: 18px;

    padding:
        14px
        16px;

    color: #166534;

    background: #f0fdf4;

    border:
        1px solid
        #bbf7d0;

    border-radius: 14px;

}


.profile-success > span {

    width: 34px;
    height: 34px;

    flex-shrink: 0;

    display: flex;

    align-items: center;

    justify-content: center;

    color: #ffffff;

    background: #16a34a;

    border-radius: 50%;

    font-weight: 800;

}


.profile-success strong {

    display: block;

    font-size: 11px;

}


.profile-success p {

    margin:
        2px
        0
        0;

    font-size: 10px;

}


/* ========================================================= */
/* GRID */
/* ========================================================= */

.profile-grid {

    display: grid;

    grid-template-columns:
        330px
        minmax(0, 1fr);

    gap: 22px;

    align-items: stretch;

}


/* ========================================================= */
/* LEFT CARD */
/* ========================================================= */

.profile-card-left {

    overflow: hidden;

    background: #ffffff;

    border:
        1px solid
        var(--profile-border);

    border-radius: 22px;

    box-shadow:
        0 10px 30px
        rgba(15, 23, 42, .055);

}


.profile-cover {

    height: 115px;

    background:
        linear-gradient(
            135deg,
            var(--profile-navy),
            var(--profile-blue)
        );

    position: relative;

}


.profile-cover::before {

    content: '';

    position: absolute;

    width: 150px;

    height: 150px;

    top: -85px;

    right: -45px;

    border-radius: 50%;

    background:
        rgba(
            255,
            255,
            255,
            .10
        );

}


.profile-cover::after {

    content: '';

    position: absolute;

    width: 90px;

    height: 90px;

    left: -35px;

    bottom: -35px;

    border-radius: 50%;

    background:
        rgba(
            255,
            255,
            255,
            .08
        );

}


.profile-card-content {

    padding:
        0
        25px
        26px;

    text-align: center;

}


/* ========================================================= */
/* AVATAR */
/* ========================================================= */

.profile-avatar {

    width: 94px;

    height: 94px;

    margin:
        -48px
        auto
        14px;

    position: relative;

    z-index: 2;

    display: flex;

    align-items: center;

    justify-content: center;

    color: #ffffff;

    background:
        linear-gradient(
            135deg,
            #3b82f6,
            #172554
        );

    border:
        5px solid
        #ffffff;

    border-radius: 50%;

    box-shadow:
        0 8px 24px
        rgba(37, 99, 235, .20);

    font-size: 27px;

    font-weight: 800;

    letter-spacing: .5px;

}


.profile-card-content h2 {

    margin: 0;

    color:
        var(--profile-text);

    font-size: 19px;

    font-weight: 800;

    line-height: 1.35;

}


.profile-role {

    display: inline-flex;

    align-items: center;

    justify-content: center;

    margin-top: 8px;

    padding:
        6px
        11px;

    color:
        var(--profile-blue-dark);

    background:
        var(--profile-soft);

    border:
        1px solid
        var(--profile-soft-2);

    border-radius: 999px;

    font-size: 9px;

    font-weight: 800;

}


.profile-description {

    margin:
        17px
        0
        0;

    padding-top: 17px;

    color:
        var(--profile-muted);

    border-top:
        1px solid
        #eef2f7;

    font-size: 10px;

    line-height: 1.7;

}


/* ========================================================= */
/* ACTIONS */
/* ========================================================= */

.profile-action-list {

    display: grid;

    gap: 10px;

    margin-top: 22px;

}


.profile-action-list form {

    margin: 0;

}


.profile-edit-button,
.profile-logout-button {

    width: 100%;

    min-height: 43px;

    display: flex;

    align-items: center;

    justify-content: center;

    gap: 8px;

    border-radius: 12px;

    font-family: inherit;

    font-size: 10px;

    font-weight: 800;

    cursor: pointer;

    transition:
        transform .2s ease,
        box-shadow .2s ease,
        background .2s ease;

}


.profile-edit-button {

    color: #ffffff;

    background:
        linear-gradient(
            135deg,
            var(--profile-blue),
            var(--profile-navy)
        );

    border: none;

    text-decoration: none;

    box-shadow:
        0 8px 18px
        rgba(37, 99, 235, .17);

}


.profile-edit-button:hover {

    transform:
        translateY(-1px);

    box-shadow:
        0 10px 22px
        rgba(37, 99, 235, .22);

}


.profile-logout-button {

    color: #b91c1c;

    background: #fff7f7;

    border:
        1px solid
        #fecaca;

}


.profile-logout-button:hover {

    background: #fef2f2;

    transform:
        translateY(-1px);

}


/* ========================================================= */
/* INFORMATION CARD */
/* ========================================================= */

.profile-information-card {

    padding: 27px;

    background: #ffffff;

    border:
        1px solid
        var(--profile-border);

    border-radius: 22px;

    box-shadow:
        0 10px 30px
        rgba(15, 23, 42, .055);

}


/* ========================================================= */
/* INFO HEADER */
/* ========================================================= */

.profile-information-header {

    display: flex;

    align-items: center;

    gap: 15px;

    padding-bottom: 21px;

    border-bottom:
        1px solid
        #eaf0f6;

}


.profile-information-icon {

    width: 52px;

    height: 52px;

    flex-shrink: 0;

    display: flex;

    align-items: center;

    justify-content: center;

    background:
        linear-gradient(
            135deg,
            var(--profile-soft),
            var(--profile-soft-2)
        );

    border:
        1px solid
        var(--profile-soft-3);

    border-radius: 15px;

    font-size: 23px;

}


.profile-information-header span {

    display: block;

    color:
        var(--profile-blue);

    font-size: 8px;

    font-weight: 800;

    letter-spacing: .7px;

}


.profile-information-header h2 {

    margin:
        3px
        0
        0;

    color:
        var(--profile-text);

    font-size: 20px;

    font-weight: 800;

}


.profile-information-header p {

    margin:
        5px
        0
        0;

    color:
        var(--profile-muted);

    font-size: 9px;

}


/* ========================================================= */
/* INFO LIST */
/* ========================================================= */

.profile-information-list {

    margin-top: 10px;

}


.profile-information-row {

    min-height: 74px;

    display: grid;

    grid-template-columns:
        42px
        155px
        minmax(0, 1fr);

    align-items: center;

    gap: 14px;

    padding:
        11px
        4px;

    border-bottom:
        1px solid
        #eef2f7;

}


.profile-information-row:last-child {

    border-bottom: none;

}


/* ========================================================= */
/* ROW ICON */
/* ========================================================= */

.profile-row-icon {

    width: 38px;

    height: 38px;

    display: flex;

    align-items: center;

    justify-content: center;

    color:
        var(--profile-blue-dark);

    background:
        var(--profile-soft);

    border:
        1px solid
        var(--profile-soft-2);

    border-radius: 11px;

    font-size: 15px;

    font-weight: 800;

}


/* ========================================================= */
/* LABEL */
/* ========================================================= */

.profile-row-label span {

    display: block;

    color:
        var(--profile-muted-light);

    font-size: 7px;

    font-weight: 800;

    letter-spacing: .5px;

}


.profile-row-label strong {

    display: block;

    margin-top: 3px;

    color:
        var(--profile-text);

    font-size: 10px;

    font-weight: 700;

}


/* ========================================================= */
/* VALUE */
/* ========================================================= */

.profile-row-value {

    min-width: 0;

    color:
        var(--profile-text);

    font-size: 11px;

    font-weight: 700;

    text-align: right;

    word-break: break-word;

}


.profile-access-badge {

    display: inline-flex;

    align-items: center;

    padding:
        6px
        10px;

    color:
        var(--profile-blue-dark);

    background:
        var(--profile-soft);

    border:
        1px solid
        var(--profile-soft-2);

    border-radius: 999px;

    font-size: 8px;

    font-weight: 800;

}


.profile-class-code {

    display: inline-flex;

    align-items: center;

    justify-content: center;

    padding:
        7px
        11px;

    color: #ffffff;

    background:
        linear-gradient(
            135deg,
            var(--profile-blue),
            var(--profile-navy)
        );

    border-radius: 9px;

    font-size: 10px;

    font-weight: 800;

    letter-spacing: .8px;

}


/* ========================================================= */
/* FOOTER INFO */
/* ========================================================= */

.profile-information-footer {

    display: flex;

    align-items: flex-start;

    gap: 13px;

    margin-top: 19px;

    padding: 16px;

    background:
        linear-gradient(
            135deg,
            #eff6ff,
            #f8fbff
        );

    border:
        1px solid
        #bfdbfe;

    border-radius: 14px;

}


.profile-footer-icon {

    width: 36px;

    height: 36px;

    flex-shrink: 0;

    display: flex;

    align-items: center;

    justify-content: center;

    background: #ffffff;

    border:
        1px solid
        #dbeafe;

    border-radius: 10px;

    font-size: 15px;

}


.profile-information-footer strong {

    color:
        var(--profile-text);

    font-size: 10px;

}


.profile-information-footer p {

    margin:
        3px
        0
        0;

    color:
        var(--profile-muted);

    font-size: 9px;

    line-height: 1.6;

}


/* ========================================================= */
/* TABLET */
/* ========================================================= */

@media (max-width: 950px) {

    .profile-grid {

        grid-template-columns:
            280px
            minmax(0, 1fr);

    }


    .profile-information-row {

        grid-template-columns:
            42px
            120px
            minmax(0, 1fr);

    }

}


/* ========================================================= */
/* MOBILE */
/* ========================================================= */

@media (max-width: 760px) {

    .profile-page {

        padding: 18px;

    }


    .profile-grid {

        grid-template-columns: 1fr;

    }


    .profile-heading h1 {

        font-size: 26px;

    }


    .profile-information-card {

        padding: 20px;

    }


    .profile-information-row {

        grid-template-columns:
            40px
            1fr;

        gap: 11px;

    }


    .profile-row-value {

        grid-column:
            2 / -1;

        padding-bottom: 5px;

        text-align: left;

    }

}

</style>

@endpush