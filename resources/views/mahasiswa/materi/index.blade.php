@extends('layouts.mahasiswa')

@section('title', 'Materi Himpunan - HIMDAS')


@section('content')

<section class="student-material-page">


    {{-- ===================================================== --}}
    {{-- HEADER --}}
    {{-- ===================================================== --}}

    <div class="student-material-header">


        <div>

            <span class="student-material-label">
                MATERI PEMBELAJARAN
            </span>


            <h1>
                Materi Himpunan
            </h1>


            <p>
                “Pahami konsepnya, taklukkan tantangannya,
                dan buktikan kemampuanmu.”
            </p>


            <small>

                Pelajari enam subbab secara berurutan.
                Setiap halaman materi memiliki checkpoint singkat
                untuk memastikan kamu memahami materi sebelum
                melanjutkan. Di akhir setiap subbab terdapat evaluasi
                dengan nilai ketuntasan minimal 80%.

            </small>

        </div>



        {{-- ================================================= --}}
        {{-- PROGRESS --}}
        {{-- ================================================= --}}

        <div class="student-material-progress-box">

            <span>
                PROGRESS MATERI
            </span>


            <strong>

                {{ $subbabSelesai }}

                /

                {{ $totalSubbab }}

            </strong>


            <progress
                value="{{ $progress }}"
                max="100"
                class="student-material-progress"
            ></progress>


            <small>
                {{ $progress }}% selesai
            </small>

        </div>


    </div>



    {{-- ===================================================== --}}
    {{-- SUCCESS --}}
    {{-- ===================================================== --}}

    @if(session('success'))

        <div class="student-material-alert success">

            <span>
                ✓
            </span>

            <span>
                {{ session('success') }}
            </span>

        </div>

    @endif



    {{-- ===================================================== --}}
    {{-- ERROR --}}
    {{-- ===================================================== --}}

    @if(session('error'))

        <div class="student-material-alert">

            <span>
                🔒
            </span>

            <span>
                {{ session('error') }}
            </span>

        </div>

    @endif



    {{-- ===================================================== --}}
    {{-- SECTION TITLE --}}
    {{-- ===================================================== --}}

    <div class="student-material-section-heading">


        <div>

            <span>
                6 LEVEL PEMBELAJARAN
            </span>


            <h2>
                Pilih Subbab
            </h2>


            <p>

                Kamu dapat melihat preview semua subbab.
                Namun, materi hanya dapat dipelajari secara
                berurutan setelah subbab sebelumnya dinyatakan
                tuntas.

            </p>

        </div>



        <div class="material-target-badge">

            Target Ketuntasan

            <strong>
                80%
            </strong>

        </div>


    </div>



    {{-- ===================================================== --}}
    {{-- MATERIAL GRID --}}
    {{-- ===================================================== --}}

    <div class="student-material-grid">


        @foreach($materi as $level => $item)


            @php

                /*
                |--------------------------------------------------------------------------
                | STATUS SUBBAB
                |--------------------------------------------------------------------------
                */

                $selesai =
                    $level <= $subbabSelesai;


                $aktif =
                    !$selesai &&
                    $level === $unlockedLevel;


                $terkunci =
                    $level > $unlockedLevel;


                /*
                |--------------------------------------------------------------------------
                | STATUS TEXT
                |--------------------------------------------------------------------------
                */

                if ($selesai) {

                    $statusClass =
                        'completed';

                    $statusText =
                        'SELESAI';

                } elseif ($aktif) {

                    $statusClass =
                        'active';

                    $statusText =
                        'SEDANG DIPELAJARI';

                } else {

                    $statusClass =
                        'locked';

                    $statusText =
                        'TERKUNCI';

                }

            @endphp



            <button
                type="button"
                class="
                    student-material-card
                    {{ $statusClass }}
                    material-open-button
                "
                data-modal-target="materialModal{{ $level }}"
            >


                {{-- ============================================= --}}
                {{-- CARD TOP --}}
                {{-- ============================================= --}}

                <div class="student-material-card-top">


                    <div class="student-material-number">

                        {{
                            str_pad(
                                $level,
                                2,
                                '0',
                                STR_PAD_LEFT
                            )
                        }}

                    </div>



                    <span
                        class="
                            student-material-status
                            {{ $statusClass }}
                        "
                    >


                        @if($selesai)

                            ✓ {{ $statusText }}

                        @elseif($aktif)

                            ▶ {{ $statusText }}

                        @else

                            🔒 {{ $statusText }}

                        @endif


                    </span>


                </div>



                {{-- ============================================= --}}
                {{-- CARD CONTENT --}}
                {{-- ============================================= --}}

                <div class="student-material-card-content">


                    <div class="student-material-symbol">

                        {{ $item['simbol'] }}

                    </div>



                    <div>


                        <span>

                            SUBBAB {{ $level }}

                        </span>


                        <h3>

                            {{ $item['nama'] }}

                        </h3>


                        <p>

                            {{ $item['deskripsi'] }}

                        </p>


                    </div>


                </div>



                {{-- ============================================= --}}
                {{-- RELASI & FUNGSI LABEL --}}
                {{-- ============================================= --}}

                @if($level === 6)

                    <div
                        style="
                            margin-top: 13px;
                            padding: 9px 11px;
                            border-radius: 10px;
                            background: #f5f3ff;
                            color: #6d28d9;
                            font-size: 8px;
                            font-weight: 700;
                        "
                    >

                        ✦ Termasuk Pengayaan Relasi & Fungsi

                    </div>

                @endif



                {{-- ============================================= --}}
                {{-- CARD FOOTER --}}
                {{-- ============================================= --}}

                <div class="student-material-card-bottom">


                    <span>

                        {{ count($item['topik']) }}

                        pokok pembelajaran

                    </span>


                    <strong>

                        Lihat Detail →

                    </strong>


                </div>


            </button>


        @endforeach


    </div>



    {{-- ===================================================== --}}
    {{-- MODAL PREVIEW SUBBAB --}}
    {{-- ===================================================== --}}

    @foreach($materi as $level => $item)


        @php

            $selesai =
                $level <= $subbabSelesai;


            $terbuka =
                $level <= $unlockedLevel;

        @endphp



        <dialog
            class="student-material-modal"
            id="materialModal{{ $level }}"
        >


            <div class="material-modal-wrapper">


                {{-- ============================================= --}}
                {{-- MODAL TOP --}}
                {{-- ============================================= --}}

                <div class="material-modal-top">


                    <div class="material-modal-symbol">

                        {{ $item['simbol'] }}

                    </div>



                    <button
                        type="button"
                        class="material-modal-close"
                        data-modal-close="materialModal{{ $level }}"
                        aria-label="Tutup"
                    >

                        ×

                    </button>


                </div>



                {{-- ============================================= --}}
                {{-- LABEL --}}
                {{-- ============================================= --}}

                <span class="material-modal-label">

                    SUBBAB

                    {{
                        str_pad(
                            $level,
                            2,
                            '0',
                            STR_PAD_LEFT
                        )
                    }}

                </span>



                {{-- ============================================= --}}
                {{-- TITLE --}}
                {{-- ============================================= --}}

                <h2>

                    {{ $item['nama'] }}

                </h2>



                <p class="material-modal-description">

                    {{ $item['deskripsi'] }}

                </p>



                {{-- ============================================= --}}
                {{-- SPECIAL RELASI & FUNGSI --}}
                {{-- ============================================= --}}

                @if($level === 6)

                    <div
                        style="
                            margin-top: 14px;
                            padding: 12px 14px;
                            border: 1px solid #ddd6fe;
                            border-radius: 12px;
                            background: #f5f3ff;
                        "
                    >

                        <span
                            style="
                                display: block;
                                color: #7c3aed;
                                font-size: 7px;
                                font-weight: 800;
                                letter-spacing: .7px;
                            "
                        >

                            PENGAYAAN MATERI

                        </span>


                        <strong
                            style="
                                display: block;
                                margin-top: 4px;
                                color: #4c1d95;
                                font-size: 11px;
                            "
                        >

                            Pengantar Relasi dan Fungsi

                        </strong>


                        <p
                            style="
                                margin-top: 5px;
                                color: #6b7280;
                                font-size: 8px;
                                line-height: 1.6;
                            "
                        >

                            Setelah memahami penerapan himpunan,
                            kamu juga akan mempelajari hubungan konsep
                            himpunan dengan produk Kartesius, relasi,
                            domain, kodomain, range, dan fungsi.

                        </p>


                    </div>

                @endif



                {{-- ============================================= --}}
                {{-- YANG AKAN DIPELAJARI --}}
                {{-- ============================================= --}}

                <div class="material-modal-learning">


                    <span class="modal-learning-label">

                        YANG AKAN DIPELAJARI

                    </span>



                    <div class="material-modal-topics">


                        @foreach(
                            $item['topik']
                            as $index => $topik
                        )


                            <div class="material-modal-topic">


                                <span>

                                    {{
                                        str_pad(
                                            $index + 1,
                                            2,
                                            '0',
                                            STR_PAD_LEFT
                                        )
                                    }}

                                </span>


                                <p>

                                    {{ $topik }}

                                </p>


                            </div>


                        @endforeach


                    </div>


                </div>



                {{-- ============================================= --}}
                {{-- SISTEM BELAJAR --}}
                {{-- ============================================= --}}

                <div
                    style="
                        margin-top: 14px;
                        padding: 14px;
                        border-radius: 14px;
                        background: #f8fafc;
                    "
                >


                    <span
                        style="
                            color: #2563eb;
                            font-size: 7px;
                            font-weight: 800;
                            letter-spacing: .7px;
                        "
                    >

                        ALUR PEMBELAJARAN

                    </span>



                    <div
                        style="
                            margin-top: 10px;
                            display: grid;
                            grid-template-columns:
                                repeat(4, 1fr);
                            gap: 7px;
                        "
                    >


                        <div
                            style="
                                padding: 9px 5px;
                                border-radius: 9px;
                                background: white;
                                text-align: center;
                            "
                        >

                            <div style="font-size: 15px;">
                                📖
                            </div>

                            <small
                                style="
                                    display: block;
                                    margin-top: 4px;
                                    color: #64748b;
                                    font-size: 7px;
                                "
                            >

                                Materi

                            </small>

                        </div>



                        <div
                            style="
                                padding: 9px 5px;
                                border-radius: 9px;
                                background: white;
                                text-align: center;
                            "
                        >

                            <div style="font-size: 15px;">
                                ❓
                            </div>

                            <small
                                style="
                                    display: block;
                                    margin-top: 4px;
                                    color: #64748b;
                                    font-size: 7px;
                                "
                            >

                                Checkpoint

                            </small>

                        </div>



                        <div
                            style="
                                padding: 9px 5px;
                                border-radius: 9px;
                                background: white;
                                text-align: center;
                            "
                        >

                            <div style="font-size: 15px;">
                                ⚡
                            </div>

                            <small
                                style="
                                    display: block;
                                    margin-top: 4px;
                                    color: #64748b;
                                    font-size: 7px;
                                "
                            >

                                Challenge

                            </small>

                        </div>



                        <div
                            style="
                                padding: 9px 5px;
                                border-radius: 9px;
                                background: white;
                                text-align: center;
                            "
                        >

                            <div style="font-size: 15px;">
                                📝
                            </div>

                            <small
                                style="
                                    display: block;
                                    margin-top: 4px;
                                    color: #64748b;
                                    font-size: 7px;
                                "
                            >

                                Evaluasi

                            </small>

                        </div>


                    </div>


                </div>



                {{-- ============================================= --}}
                {{-- CHALLENGE & TARGET --}}
                {{-- ============================================= --}}

                <div class="material-modal-challenge">


                    <div>

                        <span>
                            AKTIVITAS AKHIR
                        </span>

                        <strong>

                            {{ $item['challenge'] }}

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



                {{-- ============================================= --}}
                {{-- SUBBAB TERBUKA --}}
                {{-- ============================================= --}}

                @if($terbuka)


                    <a
                        href="{{
                            route(
                                'mahasiswa.materi.show',
                                $level
                            )
                        }}"
                        class="material-modal-start"
                    >


                        <span>


                            @if($selesai)

                                Pelajari Kembali

                            @else

                                Mulai Subbab {{ $level }}

                            @endif


                        </span>


                        <span>

                            →

                        </span>


                    </a>



                {{-- ============================================= --}}
                {{-- SUBBAB TERKUNCI --}}
                {{-- ============================================= --}}

                @else


                    <div class="material-modal-locked">


                        <strong>

                            🔒 Subbab Terkunci

                        </strong>


                        <p>

                            Selesaikan Subbab

                            {{ $level - 1 }}

                            dengan nilai minimal 80%
                            untuk membuka materi ini.

                        </p>


                    </div>


                @endif


            </div>


        </dialog>


    @endforeach


</section>

@endsection



{{-- ========================================================= --}}
{{-- JAVASCRIPT --}}
{{-- ========================================================= --}}

@push('scripts')

<script>

document.addEventListener(
    'DOMContentLoaded',
    function () {


        /*
        |--------------------------------------------------------------------------
        | OPEN BUTTON
        |--------------------------------------------------------------------------
        */

        var openButtons =
            document.querySelectorAll(
                '.material-open-button'
            );


        /*
        |--------------------------------------------------------------------------
        | CLOSE BUTTON
        |--------------------------------------------------------------------------
        */

        var closeButtons =
            document.querySelectorAll(
                '.material-modal-close'
            );


        /*
        |--------------------------------------------------------------------------
        | MODALS
        |--------------------------------------------------------------------------
        */

        var modals =
            document.querySelectorAll(
                '.student-material-modal'
            );


        /*
        |--------------------------------------------------------------------------
        | OPEN MODAL
        |--------------------------------------------------------------------------
        */

        openButtons.forEach(
            function (button) {


                button.addEventListener(
                    'click',
                    function () {


                        var modalId =
                            button.getAttribute(
                                'data-modal-target'
                            );


                        if (!modalId) {

                            return;

                        }


                        var modal =
                            document.getElementById(
                                modalId
                            );


                        if (!modal) {

                            return;

                        }


                        if (
                            typeof modal.showModal ===
                            'function'
                        ) {

                            modal.showModal();

                        }


                    }
                );


            }
        );


        /*
        |--------------------------------------------------------------------------
        | CLOSE MODAL
        |--------------------------------------------------------------------------
        */

        closeButtons.forEach(
            function (button) {


                button.addEventListener(
                    'click',
                    function () {


                        var modalId =
                            button.getAttribute(
                                'data-modal-close'
                            );


                        if (!modalId) {

                            return;

                        }


                        var modal =
                            document.getElementById(
                                modalId
                            );


                        if (modal) {

                            modal.close();

                        }


                    }
                );


            }
        );


        /*
        |--------------------------------------------------------------------------
        | CLICK BACKDROP
        |--------------------------------------------------------------------------
        */

        modals.forEach(
            function (modal) {


                modal.addEventListener(
                    'click',
                    function (event) {


                        if (
                            event.target ===
                            modal
                        ) {

                            modal.close();

                        }


                    }
                );


            }
        );


        /*
        |--------------------------------------------------------------------------
        | ESCAPE
        |--------------------------------------------------------------------------
        */

        document.addEventListener(
            'keydown',
            function (event) {


                if (
                    event.key !==
                    'Escape'
                ) {

                    return;

                }


                modals.forEach(
                    function (modal) {


                        if (modal.open) {

                            modal.close();

                        }


                    }
                );


            }
        );


    }
);

</script>

@endpush