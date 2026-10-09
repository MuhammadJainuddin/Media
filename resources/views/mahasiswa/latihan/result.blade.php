@extends('layouts.mahasiswa')

@section('title', 'Hasil Latihan Akhir - HIMDAS')

@section('content')

<section class="final-result-page">

    <div class="final-result-header {{ $passed ? 'passed' : 'failed' }}">

        <span class="final-test-eyebrow">
            HASIL LATIHAN AKHIR
        </span>

        <h1>
            {{ $passed ? 'Selamat, Kamu Lulus!' : 'Kamu Belum Lulus' }}
        </h1>

        <p>
            {{ $passed
                ? 'Hasil evaluasi menunjukkan bahwa kamu sudah memahami materi dengan baik.'
                : 'Hasil evaluasi menunjukkan bahwa kamu masih perlu meninjau kembali beberapa materi.' }}
        </p>

    </div>


    <div class="final-result-grid">

        <div class="final-info-card">
            <span>Nilai Akhir</span>
            <strong>{{ $score }}%</strong>
        </div>

        <div class="final-info-card">
            <span>Jawaban Benar</span>
            <strong>{{ $correctCount }}/{{ $totalQuestions }}</strong>
        </div>

        <div class="final-info-card">
            <span>Status</span>
            <strong>{{ $passed ? 'Lulus' : 'Belum Lulus' }}</strong>
        </div>

        <div class="final-info-card">
            <span>Batas Kelulusan</span>
            <strong>80%</strong>
        </div>

    </div>


    <div class="final-result-list-card">

        <h2>
            Ringkasan Soal
        </h2>

        <div class="final-result-list">

            @foreach($results as $item)

                <div class="final-result-item {{ $item['is_correct'] ? 'correct' : 'wrong' }}">

                    <div class="final-result-number">
                        {{ $item['number'] }}
                    </div>

                    <div class="final-result-content">
                        <h3>{{ $item['question'] }}</h3>
                        <p>
                            Jawaban kamu:
                            <strong>{{ $item['selected'] ?? '-' }}</strong>
                        </p>
                    </div>

                    <div class="final-result-status">
                        {{ $item['is_correct'] ? 'Benar' : 'Salah' }}
                    </div>

                </div>

            @endforeach

        </div>

        <div class="final-test-actions">

            <a
                href="{{ route('mahasiswa.dashboard') }}"
                class="final-test-primary-button"
            >
                Kembali ke Dashboard
            </a>

            <form
                action="{{ route('mahasiswa.latihan.reset') }}"
                method="POST"
            >
                @csrf

                <button
                    type="submit"
                    class="final-test-secondary-button"
                >
                    Kerjakan Ulang
                </button>
            </form>

        </div>

    </div>

</section>

@endsection