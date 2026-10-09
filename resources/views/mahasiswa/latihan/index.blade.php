@extends('layouts.mahasiswa')

@section('title', 'Latihan Akhir - HIMDAS')

@section('content')

<section class="final-test-page">

    <div class="final-test-container">

        {{-- ===================================================== --}}
        {{-- HEADER --}}
        {{-- ===================================================== --}}

        <div class="final-test-header">

            <div class="final-test-header-text">

                <span class="final-test-eyebrow">
                    LATIHAN AKHIR
                </span>

                <h1>
                    Evaluasi Keseluruhan Materi
                </h1>

                <p>
                    Latihan akhir digunakan untuk mengukur pemahamanmu
                    setelah menyelesaikan seluruh materi HIMDAS.
                    Soal mencakup konsep himpunan, diagram Venn,
                    subset, operasi himpunan, penerapan himpunan,
                    relasi, dan fungsi.
                </p>

            </div>


            <div class="final-test-class-card">

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
        {{-- ALERT --}}
        {{-- ===================================================== --}}

        @if(session('success'))

            <div class="final-test-alert success">
                ✓ {{ session('success') }}
            </div>

        @endif


        @if(session('error'))

            <div class="final-test-alert error">
                {{ session('error') }}
            </div>

        @endif


        {{-- ===================================================== --}}
        {{-- STATISTIK --}}
        {{-- ===================================================== --}}

        <div class="final-test-stat-grid">

            <div class="final-test-stat-card">

                <div class="final-test-stat-icon">
                    📚
                </div>

                <div>

                    <span>
                        SUBBAB SELESAI
                    </span>

                    <strong>
                        {{ $subbabSelesai }}/{{ $totalSubbab }}
                    </strong>

                    <small>
                        Seluruh materi harus selesai
                    </small>

                </div>

            </div>


            <div class="final-test-stat-card">

                <div class="final-test-stat-icon">
                    📝
                </div>

                <div>

                    <span>
                        JUMLAH SOAL
                    </span>

                    <strong>
                        {{ $totalQuestions }}
                    </strong>

                    <small>
                        Pilihan ganda
                    </small>

                </div>

            </div>


            <div class="final-test-stat-card">

                <div class="final-test-stat-icon">
                    ⏱️
                </div>

                <div>

                    <span>
                        WAKTU
                    </span>

                    <strong>
                        45 Menit
                    </strong>

                    <small>
                        Dimulai saat soal dibuka
                    </small>

                </div>

            </div>


            <div class="final-test-stat-card">

                <div class="final-test-stat-icon">
                    {{ $isUnlocked ? '✅' : '🔒' }}
                </div>

                <div>

                    <span>
                        STATUS
                    </span>

                    <strong>
                        {{ $isUnlocked ? 'Terbuka' : 'Terkunci' }}
                    </strong>

                    <small>
                        {{
                            $isUnlocked
                                ? 'Latihan siap dikerjakan'
                                : 'Selesaikan 6 subbab'
                        }}
                    </small>

                </div>

            </div>

        </div>


        {{-- ===================================================== --}}
        {{-- CONTENT --}}
        {{-- ===================================================== --}}

        <div class="final-test-content-card">

            @if($isUnlocked)

                {{-- ================================================= --}}
                {{-- UNLOCKED --}}
                {{-- ================================================= --}}

                <div class="final-test-ready">

                    <div class="final-test-main-icon">
                        🎯
                    </div>

                    <span class="final-test-ready-label">
                        UJIAN TERBUKA
                    </span>

                    <h2>
                        Latihan Akhir HIMDAS
                    </h2>

                    <p class="final-test-ready-description">
                        Kamu sudah menyelesaikan seluruh enam subbab.
                        Sekarang uji pemahamanmu melalui evaluasi akhir
                        yang mencakup seluruh materi pembelajaran.
                    </p>


                    {{-- ============================================= --}}
                    {{-- TIMER INFO --}}
                    {{-- ============================================= --}}

                    <div class="final-test-time-card">

                        <div class="final-test-time-icon">
                            ⏱️
                        </div>

                        <div>

                            <span>
                                BATAS WAKTU
                            </span>

                            <strong>
                                45 Menit
                            </strong>

                            <p>
                                Waktu mulai berjalan saat kamu membuka
                                soal pertama. Jika waktu habis, latihan
                                otomatis selesai dan jawaban yang belum
                                diisi dianggap tidak benar.
                            </p>

                        </div>

                    </div>


                    {{-- ============================================= --}}
                    {{-- PROGRESS --}}
                    {{-- ============================================= --}}

                    @if($answeredCount > 0)

                        <div class="final-test-progress-box">

                            <div class="final-test-progress-title">

                                <div>

                                    <span>
                                        PROGRESS PENGERJAAN
                                    </span>

                                    <strong>
                                        {{ $answeredCount }}
                                        dari
                                        {{ $totalQuestions }}
                                        soal
                                    </strong>

                                </div>

                                <b>
                                    {{ $completionPercent }}%
                                </b>

                            </div>


                            <progress
                                class="final-test-progress"
                                value="{{ $completionPercent }}"
                                max="100"
                            ></progress>

                        </div>

                    @endif


                    {{-- ============================================= --}}
                    {{-- RULES --}}
                    {{-- ============================================= --}}

                    <div class="final-test-rules">

                        <div class="final-test-rule">

                            <div class="final-test-rule-icon">
                                📝
                            </div>

                            <h3>
                                {{ $totalQuestions }} Soal
                            </h3>

                            <p>
                                Soal diambil dari seluruh materi
                                Subbab 1 sampai Subbab 6.
                            </p>

                        </div>


                        <div class="final-test-rule">

                            <div class="final-test-rule-icon">
                                ⏱️
                            </div>

                            <h3>
                                45 Menit
                            </h3>

                            <p>
                                Timer terus berjalan sejak soal
                                pertama mulai dikerjakan.
                            </p>

                        </div>


                        <div class="final-test-rule">

                            <div class="final-test-rule-icon">
                                🔐
                            </div>

                            <h3>
                                Tanpa Kunci Jawaban
                            </h3>

                            <p>
                                Jawaban benar tidak ditampilkan
                                selama latihan berlangsung.
                            </p>

                        </div>


                        <div class="final-test-rule">

                            <div class="final-test-rule-icon">
                                🎯
                            </div>

                            <h3>
                                Target 80%
                            </h3>

                            <p>
                                Nilai minimal ketuntasan untuk
                                latihan akhir adalah 80%.
                            </p>

                        </div>

                    </div>


                    {{-- ============================================= --}}
                    {{-- INSTRUCTION --}}
                    {{-- ============================================= --}}

                    <div class="final-test-instruction">

                        <div>
                            💡
                        </div>

                        <p>
                            <strong>Petunjuk:</strong>
                            baca pertanyaan dengan teliti, pilih satu jawaban,
                            kemudian tekan tombol
                            <strong>Selanjutnya</strong>.
                            Jawaban akan disimpan selama sesi latihan.
                        </p>

                    </div>


                    {{-- ============================================= --}}
                    {{-- ACTION --}}
                    {{-- ============================================= --}}

                    <div class="final-test-actions">

                        @if($isComplete)

                            <a
                                href="{{ route('mahasiswa.latihan.result') }}"
                                class="final-test-primary-button"
                            >
                                Lihat Hasil Akhir
                                <span>→</span>
                            </a>

                        @else

                            <a
                                href="{{ route('mahasiswa.latihan.show', ['number' => $startNumber]) }}"
                                class="final-test-primary-button"
                            >

                                @if($answeredCount > 0)

                                    Lanjutkan Latihan

                                @else

                                    Mulai Latihan

                                @endif

                                <span>
                                    →
                                </span>

                            </a>

                        @endif


                        @if($answeredCount > 0)

                            <form
                                action="{{ route('mahasiswa.latihan.reset') }}"
                                method="POST"
                            >

                                @csrf

                                <button
                                    type="submit"
                                    class="final-test-reset-button"
                                    onclick="return confirm('Reset semua jawaban dan waktu latihan?');"
                                >
                                    ↻ Reset Latihan
                                </button>

                            </form>

                        @endif

                    </div>

                </div>

            @else

                {{-- ================================================= --}}
                {{-- LOCKED --}}
                {{-- ================================================= --}}

                <div class="final-test-ready">

                    <div class="final-test-main-icon locked">
                        🔒
                    </div>

                    <span class="final-test-ready-label locked">
                        LATIHAN TERKUNCI
                    </span>

                    <h2>
                        Selesaikan Semua Subbab
                    </h2>

                    <p class="final-test-ready-description">
                        Latihan akhir baru dapat dibuka setelah kamu
                        berhasil menyelesaikan seluruh materi dari
                        Subbab 1 sampai Subbab 6.
                    </p>


                    <div class="final-test-progress-box">

                        <div class="final-test-progress-title">

                            <div>

                                <span>
                                    PROGRESS MATERI
                                </span>

                                <strong>
                                    {{ $subbabSelesai }}
                                    dari
                                    {{ $totalSubbab }}
                                    subbab selesai
                                </strong>

                            </div>

                            <b>
                                {{ $materialPercent }}%
                            </b>

                        </div>


                        <progress
                            class="final-test-progress"
                            value="{{ $materialPercent }}"
                            max="100"
                        ></progress>

                    </div>


                    <div class="final-test-actions">

                        <a
                            href="{{ route('mahasiswa.materi.index') }}"
                            class="final-test-primary-button"
                        >
                            Lanjutkan Materi
                            <span>→</span>
                        </a>

                    </div>

                </div>

            @endif

        </div>

    </div>

</section>

@endsection


@push('styles')

<style>

/* ========================================================= */
/* PAGE */
/* ========================================================= */

.final-test-page {
    width: 100%;
    padding: 32px;
}

.final-test-container {
    width: 100%;
    max-width: 1280px;
    margin: 0 auto;
}


/* ========================================================= */
/* HEADER */
/* ========================================================= */

.final-test-header {
    display: flex;
    align-items: stretch;
    justify-content: space-between;
    gap: 28px;

    padding: 32px;

    background:
        linear-gradient(
            135deg,
            #ffffff 0%,
            #f1f8ff 100%
        );

    border: 1px solid #dce8f5;
    border-radius: 24px;

    box-shadow:
        0 10px 30px
        rgba(15, 23, 42, 0.06);
}

.final-test-header-text {
    flex: 1;
}

.final-test-eyebrow {
    display: inline-block;
    margin-bottom: 10px;

    color: #2563eb;

    font-size: 13px;
    font-weight: 800;
    letter-spacing: 1px;
}

.final-test-header h1 {
    margin: 0;

    color: #0f172a;

    font-size: 34px;
    line-height: 1.2;
    font-weight: 800;
}

.final-test-header p {
    max-width: 760px;

    margin: 14px 0 0;

    color: #64748b;

    font-size: 15px;
    line-height: 1.8;
}


/* ========================================================= */
/* CLASS CARD */
/* ========================================================= */

.final-test-class-card {
    width: 240px;

    padding: 24px;

    display: flex;
    flex-direction: column;
    justify-content: center;

    color: white;

    border-radius: 20px;

    background:
        linear-gradient(
            135deg,
            #1e3a8a,
            #0284c7
        );
}

.final-test-class-card span {
    font-size: 11px;
    font-weight: 700;
    letter-spacing: .8px;

    opacity: .8;
}

.final-test-class-card strong {
    margin-top: 8px;

    font-size: 21px;
    line-height: 1.3;
}

.final-test-class-card small {
    margin-top: 8px;

    font-size: 12px;

    opacity: .8;
}


/* ========================================================= */
/* ALERT */
/* ========================================================= */

.final-test-alert {
    margin-top: 18px;

    padding: 15px 18px;

    border-radius: 14px;

    font-size: 14px;
    font-weight: 600;
}

.final-test-alert.success {
    color: #166534;
    background: #f0fdf4;
    border: 1px solid #bbf7d0;
}

.final-test-alert.error {
    color: #991b1b;
    background: #fef2f2;
    border: 1px solid #fecaca;
}


/* ========================================================= */
/* STAT */
/* ========================================================= */

.final-test-stat-grid {
    display: grid;

    grid-template-columns:
        repeat(
            4,
            minmax(0, 1fr)
        );

    gap: 18px;

    margin-top: 22px;
}

.final-test-stat-card {
    min-height: 120px;

    display: flex;
    align-items: center;
    gap: 16px;

    padding: 22px;

    background: white;

    border: 1px solid #e2e8f0;
    border-radius: 18px;

    box-shadow:
        0 8px 24px
        rgba(15, 23, 42, .045);
}

.final-test-stat-icon {
    width: 48px;
    height: 48px;

    flex-shrink: 0;

    display: flex;
    align-items: center;
    justify-content: center;

    background: #eff6ff;

    border-radius: 14px;

    font-size: 22px;
}

.final-test-stat-card span {
    display: block;

    color: #64748b;

    font-size: 11px;
    font-weight: 800;
    letter-spacing: .5px;
}

.final-test-stat-card strong {
    display: block;

    margin-top: 5px;

    color: #0f172a;

    font-size: 24px;
    font-weight: 800;
}

.final-test-stat-card small {
    display: block;

    margin-top: 5px;

    color: #94a3b8;

    font-size: 12px;
}


/* ========================================================= */
/* CONTENT */
/* ========================================================= */

.final-test-content-card {
    margin-top: 22px;

    padding: 42px;

    background: white;

    border: 1px solid #e2e8f0;
    border-radius: 24px;

    box-shadow:
        0 15px 40px
        rgba(15, 23, 42, .055);
}

.final-test-ready {
    max-width: 980px;

    margin: 0 auto;

    text-align: center;
}

.final-test-main-icon {
    width: 80px;
    height: 80px;

    display: flex;
    align-items: center;
    justify-content: center;

    margin: 0 auto 16px;

    border-radius: 22px;

    background:
        linear-gradient(
            135deg,
            #dbeafe,
            #cffafe
        );

    font-size: 36px;
}

.final-test-main-icon.locked {
    background: #f1f5f9;
}

.final-test-ready-label {
    display: inline-block;

    color: #16a34a;

    font-size: 12px;
    font-weight: 800;
    letter-spacing: .8px;
}

.final-test-ready-label.locked {
    color: #64748b;
}

.final-test-ready h2 {
    margin: 8px 0 0;

    color: #0f172a;

    font-size: 31px;
    font-weight: 800;
}

.final-test-ready-description {
    max-width: 680px;

    margin: 14px auto 28px;

    color: #64748b;

    font-size: 15px;
    line-height: 1.8;
}


/* ========================================================= */
/* TIME */
/* ========================================================= */

.final-test-time-card {
    max-width: 720px;

    display: flex;
    align-items: center;
    gap: 18px;

    margin: 0 auto 28px;

    padding: 22px 24px;

    text-align: left;

    color: #1e3a8a;

    background: #eff6ff;

    border: 1px solid #bfdbfe;
    border-radius: 18px;
}

.final-test-time-icon {
    width: 55px;
    height: 55px;

    flex-shrink: 0;

    display: flex;
    align-items: center;
    justify-content: center;

    background: white;

    border-radius: 15px;

    font-size: 25px;
}

.final-test-time-card span {
    display: block;

    font-size: 11px;
    font-weight: 800;
    letter-spacing: .6px;
}

.final-test-time-card strong {
    display: block;

    margin-top: 3px;

    font-size: 22px;
}

.final-test-time-card p {
    margin: 5px 0 0;

    color: #475569;

    font-size: 13px;
    line-height: 1.6;
}


/* ========================================================= */
/* PROGRESS */
/* ========================================================= */

.final-test-progress-box {
    max-width: 720px;

    margin: 0 auto 28px;

    padding: 20px;

    text-align: left;

    background: #f8fafc;

    border: 1px solid #e2e8f0;
    border-radius: 16px;
}

.final-test-progress-title {
    display: flex;
    align-items: center;
    justify-content: space-between;

    gap: 20px;

    margin-bottom: 13px;
}

.final-test-progress-title span {
    display: block;

    color: #64748b;

    font-size: 10px;
    font-weight: 800;
}

.final-test-progress-title strong {
    display: block;

    margin-top: 4px;

    color: #0f172a;

    font-size: 14px;
}

.final-test-progress-title b {
    color: #2563eb;

    font-size: 18px;
}

.final-test-progress {
    width: 100%;
    height: 12px;

    border: none;
}

.final-test-progress::-webkit-progress-bar {
    background: #e2e8f0;
    border-radius: 999px;
}

.final-test-progress::-webkit-progress-value {
    background:
        linear-gradient(
            90deg,
            #2563eb,
            #06b6d4
        );

    border-radius: 999px;
}

.final-test-progress::-moz-progress-bar {
    background:
        linear-gradient(
            90deg,
            #2563eb,
            #06b6d4
        );

    border-radius: 999px;
}


/* ========================================================= */
/* RULES */
/* ========================================================= */

.final-test-rules {
    display: grid;

    grid-template-columns:
        repeat(
            4,
            minmax(0, 1fr)
        );

    gap: 16px;

    margin-top: 28px;
}

.final-test-rule {
    min-height: 190px;

    padding: 22px 18px;

    text-align: center;

    background: #f8fafc;

    border: 1px solid #e2e8f0;
    border-radius: 18px;
}

.final-test-rule-icon {
    width: 52px;
    height: 52px;

    display: flex;
    align-items: center;
    justify-content: center;

    margin: 0 auto 13px;

    background: white;

    border-radius: 14px;

    font-size: 24px;
}

.final-test-rule h3 {
    margin: 0;

    color: #0f172a;

    font-size: 16px;
    font-weight: 800;
}

.final-test-rule p {
    margin: 9px 0 0;

    color: #64748b;

    font-size: 13px;
    line-height: 1.6;
}


/* ========================================================= */
/* INSTRUCTION */
/* ========================================================= */

.final-test-instruction {
    max-width: 760px;

    display: flex;
    align-items: flex-start;
    gap: 13px;

    margin: 26px auto 0;

    padding: 18px 20px;

    text-align: left;

    color: #475569;

    background: #fff7ed;

    border: 1px solid #fed7aa;
    border-radius: 16px;
}

.final-test-instruction > div {
    font-size: 22px;
}

.final-test-instruction p {
    margin: 0;

    font-size: 13px;
    line-height: 1.7;
}


/* ========================================================= */
/* BUTTON */
/* ========================================================= */

.final-test-actions {
    display: flex;
    align-items: center;
    justify-content: center;

    gap: 14px;

    margin-top: 30px;
}

.final-test-primary-button,
.final-test-reset-button {
    min-height: 48px;

    display: inline-flex;
    align-items: center;
    justify-content: center;

    gap: 12px;

    padding: 0 24px;

    border-radius: 13px;

    font-family: inherit;
    font-size: 14px;
    font-weight: 800;

    text-decoration: none;
    cursor: pointer;
}

.final-test-primary-button {
    color: white;

    border: none;

    background:
        linear-gradient(
            135deg,
            #2563eb,
            #0284c7
        );

    box-shadow:
        0 10px 22px
        rgba(37, 99, 235, .20);
}

.final-test-reset-button {
    color: #475569;

    background: white;

    border: 1px solid #cbd5e1;
}

.final-test-primary-button:hover,
.final-test-reset-button:hover {
    transform: translateY(-2px);
}


/* ========================================================= */
/* RESPONSIVE */
/* ========================================================= */

@media (max-width: 1100px) {

    .final-test-stat-grid,
    .final-test-rules {
        grid-template-columns:
            repeat(
                2,
                minmax(0, 1fr)
            );
    }

}


@media (max-width: 760px) {

    .final-test-page {
        padding: 18px;
    }

    .final-test-header {
        flex-direction: column;
        padding: 24px;
    }

    .final-test-class-card {
        width: 100%;
    }

    .final-test-stat-grid,
    .final-test-rules {
        grid-template-columns: 1fr;
    }

    .final-test-content-card {
        padding: 25px;
    }

    .final-test-ready h2 {
        font-size: 25px;
    }

    .final-test-time-card {
        align-items: flex-start;
    }

    .final-test-actions {
        flex-direction: column;
    }

    .final-test-primary-button,
    .final-test-reset-button {
        width: 100%;
    }

}

</style>

@endpush