@extends('layouts.mahasiswa')

@section('title', $question['title'] . ' - Challenge HIMDAS')

@section('content')

<section class="challenge-play-page">

    <div class="challenge-play-container">


        {{-- ===================================================== --}}
        {{-- BACK --}}
        {{-- ===================================================== --}}

        <a
            href="{{ route('mahasiswa.challenge.index') }}"
            class="challenge-back-link"
        >
            ← Kembali ke Challenge Harian
        </a>


        {{-- ===================================================== --}}
        {{-- HEADER --}}
        {{-- ===================================================== --}}

        <div class="challenge-play-header">

            <div class="challenge-play-header-left">

                <span class="challenge-play-eyebrow">
                    CHALLENGE HARIAN
                    •
                    SUBBAB {{ $question['subbab'] }}
                </span>

                <h1>
                    {{ $question['title'] }}
                </h1>

                <p>
                    Selesaikan challenge ini dengan teliti.
                    Setiap challenge hanya dapat dikerjakan satu kali
                    pada hari yang sama.
                </p>

            </div>


            {{-- ================================================= --}}
            {{-- REWARD --}}
            {{-- ================================================= --}}

            <div class="challenge-reward-card">

                <span>
                    REWARD
                </span>

                <strong>
                    +{{ $question['xp'] }} XP
                </strong>

                <small>
                    {{ ucfirst($question['difficulty']) }}
                </small>

            </div>

        </div>


        {{-- ===================================================== --}}
        {{-- ERROR --}}
        {{-- ===================================================== --}}

        @if($errors->any())

            <div class="challenge-play-alert">

                @foreach($errors->all() as $error)

                    <div>
                        {{ $error }}
                    </div>

                @endforeach

            </div>

        @endif


        {{-- ===================================================== --}}
        {{-- QUESTION CARD --}}
        {{-- ===================================================== --}}

        <div class="challenge-play-card">


            {{-- ================================================= --}}
            {{-- QUESTION META --}}
            {{-- ================================================= --}}

            <div class="challenge-question-meta">

                <div>

                    <span class="challenge-question-label">
                        PERTANYAAN
                    </span>

                    <small>
                        Subbab {{ $question['subbab'] }}
                    </small>

                </div>


                <div class="challenge-question-badge">

                    @if($question['type'] === 'choice')

                        Pilihan Ganda

                    @else

                        Jawaban Singkat

                    @endif

                </div>

            </div>


            {{-- ================================================= --}}
            {{-- QUESTION --}}
            {{-- ================================================= --}}

            <div class="challenge-question-box">

                <div class="challenge-question-icon">

                    @if($question['subbab'] === 1)

                        ∈

                    @elseif($question['subbab'] === 2)

                        { }

                    @elseif($question['subbab'] === 3)

                        ◯

                    @elseif($question['subbab'] === 4)

                        ⊂

                    @elseif($question['subbab'] === 5)

                        ∪

                    @else

                        ★

                    @endif

                </div>


                <div>

                    <span>
                        SOAL CHALLENGE
                    </span>

                    <h2>
                        {{ $question['question'] }}
                    </h2>

                </div>

            </div>


            {{-- ================================================= --}}
            {{-- FORM ANSWER --}}
            {{-- ================================================= --}}

            <form
                action="{{
                    route(
                        'mahasiswa.challenge.answer',
                        [
                            'key' => $question['key']
                        ]
                    )
                }}"
                method="POST"
                class="challenge-answer-form"
            >

                @csrf


                {{-- ================================================= --}}
                {{-- PILIHAN GANDA --}}
                {{-- ================================================= --}}

                @if($question['type'] === 'choice')

                    <div class="challenge-answer-heading">

                        <span>
                            PILIH JAWABAN
                        </span>

                        <h3>
                            Pilih satu jawaban yang paling tepat
                        </h3>

                    </div>


                    <div class="challenge-options">

                        @foreach($question['options'] as $key => $option)

                            <label
                                class="challenge-option"
                                for="answer_{{ $key }}"
                            >

                                <input
                                    type="radio"
                                    id="answer_{{ $key }}"
                                    name="answer"
                                    value="{{ $key }}"
                                    {{ old('answer') === $key ? 'checked' : '' }}
                                    required
                                >


                                <span class="challenge-option-key">
                                    {{ $key }}
                                </span>


                                <span class="challenge-option-text">
                                    {{ $option }}
                                </span>


                                <span class="challenge-option-check">
                                    ✓
                                </span>

                            </label>

                        @endforeach

                    </div>


                {{-- ================================================= --}}
                {{-- JAWABAN SINGKAT --}}
                {{-- ================================================= --}}

                @else

                    <div class="challenge-answer-heading">

                        <span>
                            JAWABAN SINGKAT
                        </span>

                        <h3>
                            Tuliskan jawabanmu
                        </h3>

                    </div>


                    <div class="challenge-short-answer">

                        <label for="answer">
                            Jawaban
                        </label>

                        <input
                            type="text"
                            id="answer"
                            name="answer"
                            value="{{ old('answer') }}"
                            autocomplete="off"
                            placeholder="Ketik jawaban di sini..."
                            required
                        >

                        <small>
                            Gunakan jawaban singkat dan langsung.
                        </small>

                    </div>

                @endif


                {{-- ================================================= --}}
                {{-- NOTE --}}
                {{-- ================================================= --}}

                <div class="challenge-play-note">

                    <div>
                        💡
                    </div>

                    <p>
                        Pastikan jawabanmu sudah benar sebelum dikirim.
                        Challenge hanya dapat dijawab satu kali hari ini.
                        Jika jawaban salah, kunci jawaban tidak akan ditampilkan.
                    </p>

                </div>


                {{-- ================================================= --}}
                {{-- REWARD INFO --}}
                {{-- ================================================= --}}

                <div class="challenge-reward-info">

                    <div>

                        <span>
                            TINGKAT KESULITAN
                        </span>

                        <strong>
                            {{ ucfirst($question['difficulty']) }}
                        </strong>

                    </div>


                    <div>

                        <span>
                            XP JIKA BENAR
                        </span>

                        <strong>
                            +{{ $question['xp'] }} XP
                        </strong>

                    </div>


                    <div>

                        <span>
                            KESEMPATAN
                        </span>

                        <strong>
                            1 Kali
                        </strong>

                    </div>

                </div>


                {{-- ================================================= --}}
                {{-- ACTION --}}
                {{-- ================================================= --}}

                <div class="challenge-play-actions">

                    <a
                        href="{{ route('mahasiswa.challenge.index') }}"
                        class="challenge-cancel-button"
                    >
                        ← Kembali
                    </a>


                    <button
                        type="submit"
                        class="challenge-submit-button"
                    >

                        <span>
                            Kunci Jawaban
                        </span>

                        <b>
                            →
                        </b>

                    </button>

                </div>

            </form>

        </div>


        {{-- ===================================================== --}}
        {{-- FOOTER INFO --}}
        {{-- ===================================================== --}}

        <div class="challenge-play-footer">

            <span>
                ⚡ Challenge Harian HIMDAS
            </span>

            <span>
                🔒 Jawaban benar tidak ditampilkan jika salah
            </span>

        </div>

    </div>

</section>

@endsection



@push('styles')

<style>

/* ========================================================= */
/* PAGE */
/* ========================================================= */

.challenge-play-page {
    width: 100%;
    padding: 32px;
}

.challenge-play-container {
    width: 100%;
    max-width: 1000px;
    margin: 0 auto;
}


/* ========================================================= */
/* BACK */
/* ========================================================= */

.challenge-back-link {
    display: inline-flex;
    align-items: center;

    margin-bottom: 15px;

    color: #475569;

    text-decoration: none;

    font-size: 11px;
    font-weight: 700;

    transition:
        color .2s ease;
}

.challenge-back-link:hover {
    color: #7c3aed;
}


/* ========================================================= */
/* HEADER */
/* ========================================================= */

.challenge-play-header {
    display: flex;
    align-items: stretch;
    justify-content: space-between;

    gap: 24px;

    padding: 30px;

    background:
        linear-gradient(
            135deg,
            #ffffff,
            #f5f3ff
        );

    border: 1px solid #ddd6fe;

    border-radius: 22px;

    box-shadow:
        0 10px 28px
        rgba(15, 23, 42, .05);
}

.challenge-play-header-left {
    flex: 1;
}

.challenge-play-eyebrow {
    color: #7c3aed;

    font-size: 10px;
    font-weight: 800;
    letter-spacing: .8px;
}

.challenge-play-header h1 {
    margin: 7px 0 0;

    color: #0f172a;

    font-size: 30px;
    font-weight: 800;
}

.challenge-play-header p {
    max-width: 650px;

    margin: 10px 0 0;

    color: #64748b;

    font-size: 12px;
    line-height: 1.7;
}


/* ========================================================= */
/* REWARD CARD */
/* ========================================================= */

.challenge-reward-card {
    width: 185px;

    padding: 20px;

    display: flex;
    flex-direction: column;
    justify-content: center;

    color: #ffffff;

    background:
        linear-gradient(
            135deg,
            #6d28d9,
            #2563eb
        );

    border-radius: 17px;

    box-shadow:
        0 10px 24px
        rgba(109, 40, 217, .18);
}

.challenge-reward-card span {
    font-size: 9px;
    font-weight: 800;
    letter-spacing: .7px;

    opacity: .8;
}

.challenge-reward-card strong {
    margin-top: 5px;

    font-size: 23px;
    font-weight: 800;
}

.challenge-reward-card small {
    margin-top: 5px;

    font-size: 10px;

    opacity: .8;
}


/* ========================================================= */
/* ERROR */
/* ========================================================= */

.challenge-play-alert {
    margin-top: 16px;

    padding: 14px 16px;

    color: #991b1b;

    background: #fef2f2;

    border: 1px solid #fecaca;

    border-radius: 13px;

    font-size: 12px;
    font-weight: 600;
}


/* ========================================================= */
/* MAIN CARD */
/* ========================================================= */

.challenge-play-card {
    margin-top: 18px;

    padding: 32px;

    background: #ffffff;

    border: 1px solid #e2e8f0;

    border-radius: 22px;

    box-shadow:
        0 14px 35px
        rgba(15, 23, 42, .05);
}


/* ========================================================= */
/* META */
/* ========================================================= */

.challenge-question-meta {
    display: flex;
    align-items: center;
    justify-content: space-between;

    gap: 16px;

    margin-bottom: 15px;
}

.challenge-question-label {
    display: block;

    color: #7c3aed;

    font-size: 9px;
    font-weight: 800;
    letter-spacing: .7px;
}

.challenge-question-meta small {
    display: block;

    margin-top: 3px;

    color: #94a3b8;

    font-size: 9px;
}

.challenge-question-badge {
    padding: 7px 11px;

    color: #6d28d9;

    background: #f5f3ff;

    border-radius: 999px;

    font-size: 9px;
    font-weight: 800;
}


/* ========================================================= */
/* QUESTION */
/* ========================================================= */

.challenge-question-box {
    min-height: 190px;

    display: flex;
    align-items: center;

    gap: 22px;

    padding: 30px;

    background:
        linear-gradient(
            135deg,
            #faf8ff,
            #f1f5ff
        );

    border: 1px solid #ddd6fe;

    border-radius: 20px;
}

.challenge-question-icon {
    width: 62px;
    height: 62px;

    flex-shrink: 0;

    display: flex;
    align-items: center;
    justify-content: center;

    color: #ffffff;

    background:
        linear-gradient(
            135deg,
            #7c3aed,
            #2563eb
        );

    border-radius: 17px;

    font-size: 26px;
    font-weight: 800;
}

.challenge-question-box > div:last-child > span {
    color: #7c3aed;

    font-size: 9px;
    font-weight: 800;
    letter-spacing: .7px;
}

.challenge-question-box h2 {
    margin: 7px 0 0;

    color: #0f172a;

    font-size: 22px;
    font-weight: 700;
    line-height: 1.6;
}


/* ========================================================= */
/* FORM */
/* ========================================================= */

.challenge-answer-form {
    margin-top: 22px;
}

.challenge-answer-heading {
    margin-bottom: 15px;
}

.challenge-answer-heading span {
    color: #7c3aed;

    font-size: 9px;
    font-weight: 800;
    letter-spacing: .7px;
}

.challenge-answer-heading h3 {
    margin: 5px 0 0;

    color: #0f172a;

    font-size: 17px;
    font-weight: 800;
}


/* ========================================================= */
/* OPTIONS */
/* ========================================================= */

.challenge-options {
    display: flex;
    flex-direction: column;

    gap: 11px;
}

.challenge-option {
    position: relative;

    min-height: 60px;

    display: flex;
    align-items: center;

    gap: 14px;

    padding: 12px 15px;

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

.challenge-option:hover {
    border-color: #c4b5fd;

    background: #faf5ff;

    transform: translateY(-1px);
}

.challenge-option input {
    position: absolute;

    opacity: 0;

    pointer-events: none;
}

.challenge-option-key {
    width: 36px;
    height: 36px;

    flex-shrink: 0;

    display: flex;
    align-items: center;
    justify-content: center;

    color: #6d28d9;

    background: #ede9fe;

    border-radius: 10px;

    font-size: 11px;
    font-weight: 800;
}

.challenge-option-text {
    flex: 1;

    color: #334155;

    font-size: 12px;
    font-weight: 600;
    line-height: 1.55;
}

.challenge-option-check {
    width: 29px;
    height: 29px;

    flex-shrink: 0;

    display: flex;
    align-items: center;
    justify-content: center;

    color: transparent;

    border: 2px solid #cbd5e1;

    border-radius: 50%;

    font-size: 10px;
    font-weight: 800;
}


/* ========================================================= */
/* SELECTED OPTION */
/* ========================================================= */

.challenge-option:has(input:checked) {
    border-color: #7c3aed;

    background: #f5f3ff;

    box-shadow:
        0 7px 18px
        rgba(124, 58, 237, .08);
}

.challenge-option:has(input:checked)
.challenge-option-key {
    color: #ffffff;

    background: #7c3aed;
}

.challenge-option:has(input:checked)
.challenge-option-check {
    color: #ffffff;

    background: #7c3aed;

    border-color: #7c3aed;
}


/* ========================================================= */
/* SHORT ANSWER */
/* ========================================================= */

.challenge-short-answer label {
    display: block;

    margin-bottom: 8px;

    color: #475569;

    font-size: 11px;
    font-weight: 700;
}

.challenge-short-answer input {
    width: 100%;
    height: 56px;

    padding: 0 16px;

    color: #0f172a;

    background: #f8fafc;

    border: 1px solid #cbd5e1;

    border-radius: 13px;

    outline: none;

    font-family: inherit;
    font-size: 13px;

    transition:
        border-color .2s ease,
        box-shadow .2s ease;
}

.challenge-short-answer input:focus {
    border-color: #7c3aed;

    box-shadow:
        0 0 0 3px
        rgba(124, 58, 237, .09);
}

.challenge-short-answer small {
    display: block;

    margin-top: 7px;

    color: #94a3b8;

    font-size: 9px;
}


/* ========================================================= */
/* NOTE */
/* ========================================================= */

.challenge-play-note {
    display: flex;
    align-items: flex-start;

    gap: 11px;

    margin-top: 18px;

    padding: 14px 16px;

    color: #475569;

    background: #fff7ed;

    border: 1px solid #fed7aa;

    border-radius: 13px;
}

.challenge-play-note > div {
    font-size: 18px;
}

.challenge-play-note p {
    margin: 0;

    font-size: 10px;
    line-height: 1.65;
}


/* ========================================================= */
/* REWARD INFO */
/* ========================================================= */

.challenge-reward-info {
    display: grid;

    grid-template-columns:
        repeat(
            3,
            minmax(0, 1fr)
        );

    gap: 12px;

    margin-top: 18px;
}

.challenge-reward-info > div {
    padding: 14px;

    text-align: center;

    background: #f8fafc;

    border: 1px solid #e2e8f0;

    border-radius: 13px;
}

.challenge-reward-info span {
    display: block;

    color: #64748b;

    font-size: 8px;
    font-weight: 800;
    letter-spacing: .5px;
}

.challenge-reward-info strong {
    display: block;

    margin-top: 4px;

    color: #0f172a;

    font-size: 12px;
    font-weight: 800;
}


/* ========================================================= */
/* ACTIONS */
/* ========================================================= */

.challenge-play-actions {
    display: flex;
    align-items: center;
    justify-content: space-between;

    gap: 14px;

    margin-top: 22px;
}

.challenge-cancel-button,
.challenge-submit-button {
    min-height: 45px;

    display: inline-flex;
    align-items: center;
    justify-content: center;

    padding: 0 20px;

    border-radius: 12px;

    font-family: inherit;
    font-size: 11px;
    font-weight: 800;

    text-decoration: none;

    cursor: pointer;

    transition:
        transform .2s ease,
        box-shadow .2s ease;
}

.challenge-cancel-button {
    color: #475569;

    background: #f1f5f9;

    border: 1px solid #cbd5e1;
}

.challenge-submit-button {
    gap: 12px;

    color: #ffffff;

    background:
        linear-gradient(
            135deg,
            #7c3aed,
            #2563eb
        );

    border: none;

    box-shadow:
        0 8px 18px
        rgba(124, 58, 237, .18);
}

.challenge-submit-button b {
    font-size: 15px;
}

.challenge-cancel-button:hover,
.challenge-submit-button:hover {
    transform: translateY(-2px);
}


/* ========================================================= */
/* FOOTER */
/* ========================================================= */

.challenge-play-footer {
    display: flex;
    align-items: center;
    justify-content: center;

    gap: 24px;

    margin-top: 15px;

    color: #94a3b8;

    font-size: 9px;
}


/* ========================================================= */
/* RESPONSIVE */
/* ========================================================= */

@media (max-width: 760px) {

    .challenge-play-page {
        padding: 18px;
    }


    .challenge-play-header {
        flex-direction: column;

        padding: 24px;
    }


    .challenge-reward-card {
        width: 100%;
    }


    .challenge-play-card {
        padding: 22px;
    }


    .challenge-question-box {
        flex-direction: column;
        align-items: flex-start;

        padding: 22px;
    }


    .challenge-question-box h2 {
        font-size: 18px;
    }


    .challenge-reward-info {
        grid-template-columns: 1fr;
    }


    .challenge-play-actions {
        flex-direction: column;
    }


    .challenge-cancel-button,
    .challenge-submit-button {
        width: 100%;
    }


    .challenge-play-footer {
        flex-direction: column;

        gap: 6px;
    }

}

</style>

@endpush