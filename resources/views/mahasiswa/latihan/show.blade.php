@extends('layouts.mahasiswa')

@section('title', 'Soal Latihan ' . $number . ' - HIMDAS')

@section('content')

<section class="practice-question-page">

    {{-- ===================================================== --}}
    {{-- HEADER --}}
    {{-- ===================================================== --}}

    <div class="practice-question-top">

        <div class="practice-question-top-left">

            <span class="practice-question-eyebrow">
                LATIHAN AKHIR HIMDAS
            </span>

            <h1>
                Soal {{ $number }} dari {{ $totalQuestions }}
            </h1>

            <p>
                Kerjakan setiap soal dengan teliti.
                Jawaban akan tersimpan ketika kamu menekan tombol
                Selanjutnya atau Selesaikan.
            </p>

        </div>


        {{-- ================================================= --}}
        {{-- TIMER --}}
        {{-- ================================================= --}}

        <div
            class="practice-timer-card"
            id="practiceTimer"
            data-remaining="{{ $remainingSeconds }}"
            data-result-url="{{ route('mahasiswa.latihan.result') }}"
        >

            <span>
                SISA WAKTU
            </span>

            <strong id="practiceTimerText">
                45:00
            </strong>

            <small id="practiceTimerMessage">
                Waktu terus berjalan selama latihan berlangsung.
            </small>

        </div>

    </div>


    {{-- ===================================================== --}}
    {{-- ALERT --}}
    {{-- ===================================================== --}}

    @if(session('success'))

        <div class="lesson-flash success">
            ✓ {{ session('success') }}
        </div>

    @endif


    @if(session('error'))

        <div class="lesson-flash error">
            {{ session('error') }}
        </div>

    @endif


    @if($errors->any())

        <div class="lesson-flash error">

            @foreach($errors->all() as $error)

                <div>
                    {{ $error }}
                </div>

            @endforeach

        </div>

    @endif


    {{-- ===================================================== --}}
    {{-- PROGRESS LATIHAN --}}
    {{-- ===================================================== --}}

    <div class="practice-question-progress-area">

        <div class="practice-progress-info">

            <div>

                <span>
                    PROGRESS LATIHAN
                </span>

                <strong>
                    {{ $answeredCount }}
                    dari
                    {{ $totalQuestions }}
                    soal telah dijawab
                </strong>

            </div>


            <b>
                {{ $progress }}%
            </b>

        </div>


        <progress
            class="practice-progress-native"
            value="{{ $progress }}"
            max="100"
        ></progress>

    </div>


    {{-- ===================================================== --}}
    {{-- QUESTION WRAPPER --}}
    {{-- ===================================================== --}}

    <div class="practice-question-wrapper">


        {{-- ================================================= --}}
        {{-- QUESTION META --}}
        {{-- ================================================= --}}

        <div class="practice-question-meta">

            <span class="practice-question-category">
                {{ $question['category'] ?? 'Latihan Akhir' }}
            </span>

            <span class="practice-question-counter">
                Nomor {{ $number }}
            </span>

        </div>


        {{-- ================================================= --}}
        {{-- JUDUL SOAL --}}
        {{-- ================================================= --}}

        <div class="practice-question-title-box">

            <span>
                TOPIK SOAL
            </span>

            <strong>
                {{ $question['title'] }}
            </strong>

        </div>


        {{-- ================================================= --}}
        {{-- ISI SOAL --}}
        {{-- ================================================= --}}

        <div class="practice-question-content-box">

            <div class="practice-question-number-large">
                {{ $number }}
            </div>

            <div>

                <span class="practice-question-label">
                    PERTANYAAN
                </span>

                <h2>
                    {{ $question['question'] }}
                </h2>

            </div>

        </div>


        {{-- ================================================= --}}
        {{-- FORM JAWABAN --}}
        {{-- ================================================= --}}

        <form
            action="{{ route('mahasiswa.latihan.answer', ['number' => $number]) }}"
            method="POST"
            class="practice-answer-box"
            id="practiceAnswerForm"
        >

            @csrf


            <div class="practice-answer-heading">

                <div>

                    <span>
                        JAWABAN
                    </span>

                    <h3>
                        Pilih satu jawaban yang paling tepat
                    </h3>

                </div>

                <small>
                    Pilihan jawaban tidak langsung dinilai.
                </small>

            </div>


            {{-- ================================================= --}}
            {{-- OPTIONS --}}
            {{-- ================================================= --}}

            <div class="practice-options-list">

                @foreach($question['options'] as $key => $option)

                    @php

                        $currentAnswer =
                            old(
                                'answer',
                                $selectedAnswer
                            );

                    @endphp


                    <label
                        class="practice-option-item"
                        for="answer_{{ $key }}"
                    >

                        <input
                            type="radio"
                            id="answer_{{ $key }}"
                            name="answer"
                            value="{{ $key }}"
                            {{ $currentAnswer === $key ? 'checked' : '' }}
                            required
                        >

                        <span class="practice-option-key">
                            {{ $key }}
                        </span>

                        <span class="practice-option-text">
                            {{ $option }}
                        </span>

                        <span class="practice-option-check">
                            ✓
                        </span>

                    </label>

                @endforeach

            </div>


            {{-- ================================================= --}}
            {{-- INFO --}}
            {{-- ================================================= --}}

            <div class="practice-question-note">

                <span>
                    💡
                </span>

                <p>
                    Jawaban benar tidak akan ditampilkan selama
                    latihan berlangsung. Periksa kembali pilihanmu
                    sebelum melanjutkan ke soal berikutnya.
                </p>

            </div>


            {{-- ================================================= --}}
            {{-- ACTION BUTTON --}}
            {{-- ================================================= --}}

            <div class="practice-question-actions">


                {{-- ============================================= --}}
                {{-- BACK --}}
                {{-- ============================================= --}}

                @if($number > 1)

                    <a
                        href="{{ route('mahasiswa.latihan.show', ['number' => $number - 1]) }}"
                        class="practice-nav-button secondary"
                    >
                        ← Kembali
                    </a>

                @else

                    <a
                        href="{{ route('mahasiswa.latihan.index') }}"
                        class="practice-nav-button secondary"
                    >
                        ← Kembali
                    </a>

                @endif


                {{-- ============================================= --}}
                {{-- NUMBER --}}
                {{-- ============================================= --}}

                <div class="practice-question-number-indicator">

                    <span>
                        NOMOR SOAL
                    </span>

                    <strong>
                        {{ $number }} / {{ $totalQuestions }}
                    </strong>

                </div>


                {{-- ============================================= --}}
                {{-- NEXT / FINISH --}}
                {{-- ============================================= --}}

                <button
                    type="submit"
                    class="practice-nav-button primary"
                >

                    @if($number < $totalQuestions)

                        Simpan & Selanjutnya →

                    @else

                        Selesaikan Latihan ✓

                    @endif

                </button>

            </div>

        </form>

    </div>


    {{-- ===================================================== --}}
    {{-- FOOTER INFO --}}
    {{-- ===================================================== --}}

    <div class="practice-question-footer-info">

        <span>
            🔒 Jawaban disimpan secara sementara selama sesi latihan.
        </span>

        <span>
            ⏱ Batas waktu keseluruhan: 45 menit.
        </span>

    </div>

</section>

@endsection



{{-- ========================================================= --}}
{{-- STYLE --}}
{{-- ========================================================= --}}

@push('styles')

<style>

.practice-question-page {
    width: 100%;
    padding: 28px;
}


/* ========================================================= */
/* HEADER */
/* ========================================================= */

.practice-question-top {
    display: flex;
    align-items: stretch;
    justify-content: space-between;
    gap: 22px;
    margin-bottom: 20px;
}

.practice-question-top-left {
    flex: 1;
    padding: 26px 28px;
    border: 1px solid #e2e8f0;
    border-radius: 22px;
    background:
        linear-gradient(
            135deg,
            #ffffff,
            #f5f9ff
        );
    box-shadow:
        0 10px 30px
        rgba(15, 23, 42, 0.05);
}

.practice-question-eyebrow {
    display: inline-block;
    margin-bottom: 9px;
    color: #2563eb;
    font-size: 10px;
    font-weight: 800;
    letter-spacing: 0.8px;
}

.practice-question-top-left h1 {
    margin: 0;
    color: #0f172a;
    font-size: 30px;
    font-weight: 800;
}

.practice-question-top-left p {
    max-width: 700px;
    margin: 10px 0 0;
    color: #64748b;
    font-size: 12px;
    line-height: 1.8;
}


/* ========================================================= */
/* TIMER */
/* ========================================================= */

.practice-timer-card {
    width: 225px;
    padding: 22px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    border-radius: 22px;
    color: #ffffff;
    background:
        linear-gradient(
            135deg,
            #172554,
            #1d4ed8
        );
    box-shadow:
        0 12px 28px
        rgba(30, 64, 175, 0.23);
    transition:
        background .3s ease,
        transform .3s ease;
}

.practice-timer-card > span {
    font-size: 9px;
    font-weight: 800;
    letter-spacing: 1px;
    opacity: 0.8;
}

.practice-timer-card > strong {
    display: block;
    margin-top: 7px;
    font-size: 34px;
    font-weight: 800;
    letter-spacing: 2px;
}

.practice-timer-card > small {
    display: block;
    margin-top: 7px;
    font-size: 9px;
    line-height: 1.5;
    opacity: 0.8;
}

.practice-timer-card.warning {
    background:
        linear-gradient(
            135deg,
            #b45309,
            #f59e0b
        );
}

.practice-timer-card.danger {
    background:
        linear-gradient(
            135deg,
            #991b1b,
            #dc2626
        );
    animation:
        practiceTimerPulse
        1.4s
        infinite;
}

@keyframes practiceTimerPulse {

    0%,
    100% {
        transform: scale(1);
    }

    50% {
        transform: scale(1.02);
    }

}


/* ========================================================= */
/* PROGRESS */
/* ========================================================= */

.practice-question-progress-area {
    padding: 17px 20px;
    margin-bottom: 20px;
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 16px;
}

.practice-progress-info {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 16px;
    margin-bottom: 10px;
}

.practice-progress-info span {
    display: block;
    color: #64748b;
    font-size: 8px;
    font-weight: 800;
    letter-spacing: 0.7px;
}

.practice-progress-info strong {
    display: block;
    margin-top: 3px;
    color: #0f172a;
    font-size: 11px;
}

.practice-progress-info b {
    color: #2563eb;
    font-size: 15px;
}

.practice-progress-native {
    width: 100%;
    height: 11px;
    border: none;
    border-radius: 999px;
    overflow: hidden;
}

.practice-progress-native::-webkit-progress-bar {
    border-radius: 999px;
    background: #e2e8f0;
}

.practice-progress-native::-webkit-progress-value {
    border-radius: 999px;
    background:
        linear-gradient(
            90deg,
            #2563eb,
            #06b6d4
        );
}

.practice-progress-native::-moz-progress-bar {
    border-radius: 999px;
    background:
        linear-gradient(
            90deg,
            #2563eb,
            #06b6d4
        );
}


/* ========================================================= */
/* QUESTION WRAPPER */
/* ========================================================= */

.practice-question-wrapper {
    padding: 26px;
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 24px;
    box-shadow:
        0 15px 38px
        rgba(15, 23, 42, 0.055);
}

.practice-question-meta {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 14px;
    margin-bottom: 14px;
}

.practice-question-category,
.practice-question-counter {
    display: inline-flex;
    align-items: center;
    min-height: 27px;
    padding: 0 11px;
    border-radius: 999px;
    font-size: 8px;
    font-weight: 800;
}

.practice-question-category {
    color: #1d4ed8;
    background: #eff6ff;
}

.practice-question-counter {
    color: #475569;
    background: #f1f5f9;
}


/* ========================================================= */
/* TITLE */
/* ========================================================= */

.practice-question-title-box {
    padding: 15px 18px;
    margin-bottom: 14px;
    text-align: center;
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 14px;
}

.practice-question-title-box span {
    display: block;
    color: #94a3b8;
    font-size: 8px;
    font-weight: 800;
    letter-spacing: 0.8px;
}

.practice-question-title-box strong {
    display: block;
    margin-top: 5px;
    color: #0f172a;
    font-size: 14px;
}


/* ========================================================= */
/* QUESTION */
/* ========================================================= */

.practice-question-content-box {
    min-height: 190px;
    display: flex;
    align-items: center;
    gap: 20px;
    padding: 30px;
    margin-bottom: 18px;
    border: 1px solid #dbeafe;
    border-radius: 20px;
    background:
        linear-gradient(
            135deg,
            #f8fbff,
            #eff6ff
        );
}

.practice-question-number-large {
    width: 54px;
    height: 54px;
    flex-shrink: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 15px;
    color: #ffffff;
    background:
        linear-gradient(
            135deg,
            #2563eb,
            #0284c7
        );
    font-size: 18px;
    font-weight: 800;
}

.practice-question-label {
    color: #2563eb;
    font-size: 8px;
    font-weight: 800;
    letter-spacing: 0.8px;
}

.practice-question-content-box h2 {
    max-width: 900px;
    margin: 7px 0 0;
    color: #0f172a;
    font-size: 21px;
    font-weight: 700;
    line-height: 1.6;
}


/* ========================================================= */
/* ANSWER */
/* ========================================================= */

.practice-answer-box {
    padding: 24px;
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 19px;
}

.practice-answer-heading {
    display: flex;
    align-items: flex-end;
    justify-content: space-between;
    gap: 16px;
    margin-bottom: 18px;
}

.practice-answer-heading span {
    color: #2563eb;
    font-size: 8px;
    font-weight: 800;
    letter-spacing: 0.8px;
}

.practice-answer-heading h3 {
    margin: 5px 0 0;
    color: #0f172a;
    font-size: 17px;
    font-weight: 800;
}

.practice-answer-heading small {
    color: #94a3b8;
    font-size: 9px;
}


/* ========================================================= */
/* OPTIONS */
/* ========================================================= */

.practice-options-list {
    display: flex;
    flex-direction: column;
    gap: 11px;
}

.practice-option-item {
    position: relative;
    display: flex;
    align-items: center;
    gap: 13px;
    min-height: 56px;
    padding: 11px 15px;
    cursor: pointer;
    background: #f8fafc;
    border: 1px solid #dbe4ee;
    border-radius: 14px;
    transition:
        border-color .2s ease,
        background .2s ease,
        transform .2s ease,
        box-shadow .2s ease;
}

.practice-option-item:hover {
    border-color: #93c5fd;
    background: #eff6ff;
    transform: translateY(-1px);
}

.practice-option-item input {
    position: absolute;
    opacity: 0;
    pointer-events: none;
}

.practice-option-key {
    width: 34px;
    height: 34px;
    flex-shrink: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #1d4ed8;
    background: #dbeafe;
    border-radius: 10px;
    font-size: 10px;
    font-weight: 800;
}

.practice-option-text {
    flex: 1;
    color: #334155;
    font-size: 11px;
    font-weight: 600;
    line-height: 1.5;
}

.practice-option-check {
    width: 27px;
    height: 27px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: transparent;
    border: 2px solid #cbd5e1;
    border-radius: 50%;
    font-size: 10px;
    font-weight: 800;
}

.practice-option-item:has(input:checked) {
    border-color: #2563eb;
    background: #eff6ff;
    box-shadow:
        0 7px 18px
        rgba(37, 99, 235, 0.08);
}

.practice-option-item:has(input:checked)
.practice-option-key {
    color: #ffffff;
    background: #2563eb;
}

.practice-option-item:has(input:checked)
.practice-option-check {
    color: #ffffff;
    border-color: #2563eb;
    background: #2563eb;
}


/* ========================================================= */
/* NOTE */
/* ========================================================= */

.practice-question-note {
    display: flex;
    align-items: flex-start;
    gap: 10px;
    margin-top: 17px;
    padding: 13px 15px;
    color: #475569;
    background: #f8fafc;
    border-radius: 12px;
}

.practice-question-note > span {
    font-size: 17px;
}

.practice-question-note p {
    margin: 0;
    font-size: 9px;
    line-height: 1.6;
}


/* ========================================================= */
/* ACTIONS */
/* ========================================================= */

.practice-question-actions {
    display: grid;
    grid-template-columns:
        1fr auto 1fr;
    align-items: center;
    gap: 15px;
    margin-top: 22px;
}

.practice-nav-button {
    min-height: 43px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 0 20px;
    border: none;
    border-radius: 11px;
    text-decoration: none;
    cursor: pointer;
    font-family: inherit;
    font-size: 10px;
    font-weight: 800;
    transition:
        transform .2s ease,
        box-shadow .2s ease;
}

.practice-nav-button.secondary {
    justify-self: start;
    min-width: 145px;
    color: #334155;
    background: #f1f5f9;
    border: 1px solid #cbd5e1;
}

.practice-nav-button.primary {
    justify-self: end;
    min-width: 180px;
    color: #ffffff;
    background:
        linear-gradient(
            135deg,
            #2563eb,
            #0284c7
        );
    box-shadow:
        0 8px 20px
        rgba(37, 99, 235, 0.18);
}

.practice-nav-button:hover {
    transform: translateY(-2px);
}

.practice-question-number-indicator {
    min-width: 125px;
    padding: 8px 14px;
    text-align: center;
    color: #475569;
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 11px;
}

.practice-question-number-indicator span {
    display: block;
    font-size: 7px;
    font-weight: 800;
    letter-spacing: 0.7px;
}

.practice-question-number-indicator strong {
    display: block;
    margin-top: 3px;
    color: #0f172a;
    font-size: 11px;
}


/* ========================================================= */
/* FOOTER */
/* ========================================================= */

.practice-question-footer-info {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 24px;
    margin-top: 15px;
    color: #94a3b8;
    font-size: 8px;
}


/* ========================================================= */
/* RESPONSIVE */
/* ========================================================= */

@media (max-width: 900px) {

    .practice-question-top {
        flex-direction: column;
    }

    .practice-timer-card {
        width: 100%;
    }

    .practice-question-actions {
        grid-template-columns: 1fr;
    }

    .practice-nav-button.secondary,
    .practice-nav-button.primary {
        width: 100%;
        justify-self: stretch;
    }

    .practice-question-number-indicator {
        width: 100%;
    }

}


@media (max-width: 600px) {

    .practice-question-page {
        padding: 16px;
    }

    .practice-question-top-left,
    .practice-question-wrapper {
        padding: 20px;
    }

    .practice-question-content-box {
        flex-direction: column;
        align-items: flex-start;
        padding: 22px;
    }

    .practice-question-content-box h2 {
        font-size: 18px;
    }

    .practice-answer-heading {
        flex-direction: column;
        align-items: flex-start;
    }

    .practice-question-footer-info {
        flex-direction: column;
        gap: 5px;
    }

}

</style>

@endpush



{{-- ========================================================= --}}
{{-- SCRIPT TIMER --}}
{{-- ========================================================= --}}

@push('scripts')

<script>

document.addEventListener(
    'DOMContentLoaded',
    function () {

        const timerElement =
            document.getElementById(
                'practiceTimer'
            );

        const timerText =
            document.getElementById(
                'practiceTimerText'
            );

        const timerMessage =
            document.getElementById(
                'practiceTimerMessage'
            );


        if (
            !timerElement ||
            !timerText
        ) {
            return;
        }


        let remainingSeconds =
            parseInt(
                timerElement.dataset.remaining,
                10
            );


        if (
            Number.isNaN(
                remainingSeconds
            )
        ) {
            remainingSeconds = 0;
        }


        const resultUrl =
            timerElement.dataset.resultUrl;


        /*
        |--------------------------------------------------------------------------
        | DEADLINE CLIENT
        |--------------------------------------------------------------------------
        |
        | Menggunakan waktu akhir sehingga timer tetap tepat
        | walaupun browser sempat lag atau tab tidak aktif.
        |
        */

        const clientDeadline =
            Date.now()
            +
            (
                remainingSeconds
                *
                1000
            );


        function getRemaining()
        {
            return Math.max(
                0,
                Math.ceil(
                    (
                        clientDeadline
                        -
                        Date.now()
                    )
                    /
                    1000
                )
            );
        }


        function renderTimer()
        {
            const remaining =
                getRemaining();


            const minutes =
                Math.floor(
                    remaining / 60
                );


            const seconds =
                remaining % 60;


            timerText.textContent =
                String(minutes)
                    .padStart(
                        2,
                        '0'
                    )
                +
                ':'
                +
                String(seconds)
                    .padStart(
                        2,
                        '0'
                    );


            /*
            |--------------------------------------------------------------------------
            | WARNA TIMER
            |--------------------------------------------------------------------------
            */

            timerElement
                .classList
                .remove(
                    'warning',
                    'danger'
                );


            if (
                remaining <= 300
                &&
                remaining > 60
            ) {

                timerElement
                    .classList
                    .add(
                        'warning'
                    );


                if (timerMessage) {

                    timerMessage.textContent =
                        'Waktu tersisa kurang dari 5 menit.';

                }

            }


            if (
                remaining <= 60
            ) {

                timerElement
                    .classList
                    .add(
                        'danger'
                    );


                if (timerMessage) {

                    timerMessage.textContent =
                        'Segera selesaikan. Waktu hampir habis!';

                }

            }


            /*
            |--------------------------------------------------------------------------
            | WAKTU HABIS
            |--------------------------------------------------------------------------
            */

            if (
                remaining <= 0
            ) {

                timerText.textContent =
                    '00:00';


                if (timerMessage) {

                    timerMessage.textContent =
                        'Waktu habis. Memproses hasil latihan...';

                }


                return false;

            }


            return true;
        }


        /*
        |--------------------------------------------------------------------------
        | INITIAL RENDER
        |--------------------------------------------------------------------------
        */

        if (!renderTimer()) {

            window.location.replace(
                resultUrl
            );

            return;

        }


        /*
        |--------------------------------------------------------------------------
        | INTERVAL
        |--------------------------------------------------------------------------
        */

        const timerInterval =
            window.setInterval(
                function () {

                    const stillRunning =
                        renderTimer();


                    if (!stillRunning) {

                        window.clearInterval(
                            timerInterval
                        );


                        setTimeout(
                            function () {

                                window.location.replace(
                                    resultUrl
                                );

                            },
                            600
                        );

                    }

                },
                1000
            );

    }
);

</script>

@endpush