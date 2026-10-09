@extends('layouts.mahasiswa')

@section('title', 'Subbab ' . $level . ' - ' . $materi['nama'] . ' - HIMDAS')

@section('content')

<section class="lesson-page">

    <div class="lesson-top-grid">

        <div class="lesson-title-card">

            <span class="lesson-eyebrow">
                SUBBAB {{ str_pad($level, 2, '0', STR_PAD_LEFT) }}
            </span>

            <h1>
                {{ $materi['nama'] }}
            </h1>

            <p>
                {{ $materi['judul'] }}
            </p>

        </div>


        <div class="lesson-level-progress-card">

            <span>
                PROGRESS SUBBAB
            </span>

            <strong>
                {{ $page }} / {{ $totalPages }}
            </strong>

            <progress
                value="{{ $pageProgress }}"
                max="100"
                class="lesson-progress"
            ></progress>

            <small>
                {{ $pageProgress }}% halaman
            </small>

        </div>

    </div>


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


    <div class="lesson-layout">

        <main class="lesson-main-column">

            <section class="lesson-objective-card">

                <div class="lesson-card-heading">
                    <span>TUJUAN PEMBELAJARAN</span>
                    <h2>{{ $materi['judul'] }}</h2>
                </div>

                <ol>
                    @foreach($materi['tujuan'] as $tujuan)
                        <li>{{ $tujuan }}</li>
                    @endforeach
                </ol>

            </section>


            @if(($halaman['type'] ?? 'content') === 'content')

                <article class="lesson-content-card">

                    <div class="lesson-content-heading">

                        <div>

                            @if(!empty($halaman['pengayaan']))
                                <span class="lesson-enrichment-badge">
                                    PENGAYAAN RELASI & FUNGSI
                                </span>
                            @else
                                <span class="lesson-page-number">
                                    HALAMAN {{ $page }}
                                </span>
                            @endif

                            <h2>
                                {{ $halaman['title'] }}
                            </h2>

                            <p>
                                {{ $halaman['subtitle'] }}
                            </p>

                        </div>

                        <div class="lesson-symbol-box">
                            {{ $materi['simbol'] }}
                        </div>

                    </div>


                    <div class="lesson-paragraphs">

                        @foreach($halaman['paragraphs'] as $paragraph)

                            <p>
                                {{ $paragraph }}
                            </p>

                        @endforeach

                    </div>


                    @if(!empty($halaman['visual']))

                        <div class="lesson-visual-wrap">


                            @if($halaman['visual'] === 'set-basic')

                                <div class="lesson-simple-set">

                                    <span>A</span>

                                    <strong>
                                        { 2, 4, 6, 8 }
                                    </strong>

                                </div>


                            @elseif($halaman['visual'] === 'set-vs-nonset')

                                <div class="lesson-compare-visual">

                                    <div>

                                        <span>
                                            HIMPUNAN
                                        </span>

                                        <strong>
                                            {2, 4, 6, 8}
                                        </strong>

                                        <small>
                                            Kriterianya jelas
                                        </small>

                                    </div>


                                    <div>

                                        <span>
                                            BUKAN HIMPUNAN
                                        </span>

                                        <strong>
                                            “makanan terenak”
                                        </strong>

                                        <small>
                                            Bersifat subjektif
                                        </small>

                                    </div>

                                </div>


                            @elseif($halaman['visual'] === 'membership')

                                <div class="lesson-membership-visual">

                                    <div class="membership-set">

                                        <span>
                                            A
                                        </span>

                                        <b>2</b>
                                        <b>4</b>
                                        <b>6</b>
                                        <b>8</b>

                                    </div>


                                    <div class="membership-statements">

                                        <strong>
                                            4 ∈ A
                                        </strong>

                                        <strong>
                                            5 ∉ A
                                        </strong>

                                    </div>

                                </div>


                            @elseif($halaman['visual'] === 'cardinality')

                                <div class="lesson-cardinality-visual">

                                    <span>
                                        A = { a, b, c, a, d, b }
                                    </span>

                                    <strong>
                                        → { a, b, c, d }
                                    </strong>

                                    <b>
                                        n(A) = 4
                                    </b>

                                </div>


                            @elseif($halaman['visual'] === 'enumeration')

                                <div class="lesson-formula-visual">
                                    A = {0, 1, 2, 3, 4, ...}
                                </div>


                            @elseif($halaman['visual'] === 'builder')

                                <div class="lesson-formula-visual">
                                    A = { x | 1 &lt; x &lt; 8, x bilangan cacah }
                                </div>


                            @elseif($halaman['visual'] === 'number-sets')

                                <div class="lesson-number-sets">

                                    <span>N</span>
                                    <span>Z</span>
                                    <span>Q</span>
                                    <span>R</span>
                                    <span>C</span>

                                </div>


                            @elseif(in_array($halaman['visual'], [
                                'venn-overlap',
                                'venn-intersection',
                                'venn-union',
                                'venn-difference',
                                'venn-symmetric',
                                'venn-application'
                            ], true))

                                <div class="lesson-venn">

                                    <div class="lesson-venn-label-s">
                                        S
                                    </div>

                                    <div class="lesson-circle circle-a">
                                        <span>A</span>
                                    </div>

                                    <div class="lesson-circle circle-b">
                                        <span>B</span>
                                    </div>

                                    <div class="lesson-venn-caption">
                                        {{ $halaman['title'] }}
                                    </div>

                                </div>


                            @elseif($halaman['visual'] === 'empty-set')

                                <div class="lesson-empty-visual">

                                    <strong>
                                        ∅
                                    </strong>

                                    <span>
                                        tidak mempunyai anggota
                                    </span>

                                </div>


                            @elseif($halaman['visual'] === 'universal-set')

                                <div class="lesson-universal-visual">

                                    <span>
                                        S
                                    </span>

                                    <div>
                                        A
                                    </div>

                                </div>


                            @elseif($halaman['visual'] === 'equal-sets')

                                <div class="lesson-equality-visual">

                                    <span>
                                        {1,2,3}
                                    </span>

                                    <strong>
                                        =
                                    </strong>

                                    <span>
                                        {3,2,1}
                                    </span>

                                </div>


                            @elseif($halaman['visual'] === 'equivalent-sets')

                                <div class="lesson-equality-visual">

                                    <span>
                                        {a,b,c}
                                    </span>

                                    <strong>
                                        ~
                                    </strong>

                                    <span>
                                        {1,2,3}
                                    </span>

                                </div>


                            @elseif(in_array($halaman['visual'], ['subset', 'proper-subset'], true))

                                <div class="lesson-subset-visual">

                                    <div class="outer-set">

                                        <span>
                                            B
                                        </span>

                                        <div class="inner-set">
                                            <span>A</span>
                                        </div>

                                    </div>


                                    <strong>

                                        {{
                                            $halaman['visual'] === 'proper-subset'
                                                ? 'A ⊂ B'
                                                : 'A ⊆ B'
                                        }}

                                    </strong>

                                </div>


                            @elseif($halaman['visual'] === 'subset-list')

                                <div class="lesson-formula-visual">
                                    ∅, {a}, {b}, {a,b}
                                </div>


                            @elseif($halaman['visual'] === 'power-set')

                                <div class="lesson-formula-visual">
                                    |P(A)| = 2ⁿ
                                </div>


                            @elseif($halaman['visual'] === 'laws')

                                <div class="lesson-laws-visual">

                                    <span>
                                        A ∪ ∅ = A
                                    </span>

                                    <span>
                                        A ∩ S = A
                                    </span>

                                    <span>
                                        (A ∪ B)′ = A′ ∩ B′
                                    </span>

                                </div>


                            @elseif($halaman['visual'] === 'cartesian')

                                <div class="lesson-cartesian-visual">

                                    <span>
                                        A={1,2}
                                    </span>

                                    <span>
                                        B={a,b}
                                    </span>

                                    <strong>
                                        {(1,a),(1,b),(2,a),(2,b)}
                                    </strong>

                                </div>


                            @elseif(in_array($halaman['visual'], [
                                'mapping-relation',
                                'domain-range',
                                'mapping-function',
                                'mapping-not-function'
                            ], true))

                                <div class="lesson-mapping-visual {{ $halaman['visual'] }}">

                                    <div class="mapping-column">

                                        <span class="mapping-title">
                                            A
                                        </span>

                                        <b>1</b>
                                        <b>2</b>
                                        <b>3</b>

                                    </div>


                                    <div class="mapping-arrows">

                                        <span>→</span>
                                        <span>→</span>
                                        <span>→</span>

                                        @if($halaman['visual'] === 'mapping-not-function')

                                            <span class="extra-arrow">
                                                ↗
                                            </span>

                                        @endif

                                    </div>


                                    <div class="mapping-column">

                                        <span class="mapping-title">
                                            B
                                        </span>

                                        <b>a</b>
                                        <b>b</b>
                                        <b>c</b>

                                    </div>

                                </div>


                            @elseif($halaman['visual'] === 'concept-flow')

                                <div class="lesson-concept-flow">

                                    <span>
                                        Himpunan
                                    </span>

                                    <b>
                                        →
                                    </b>

                                    <span>
                                        Produk Kartesius
                                    </span>

                                    <b>
                                        →
                                    </b>

                                    <span>
                                        Relasi
                                    </span>

                                    <b>
                                        →
                                    </b>

                                    <span>
                                        Fungsi
                                    </span>

                                </div>

                            @endif

                        </div>

                    @endif


                    @if(!empty($halaman['example']))

                        <div class="lesson-example-card">

                            <span>
                                {{ $halaman['example']['title'] }}
                            </span>

                            @foreach($halaman['example']['lines'] as $line)

                                <p>
                                    {{ $line }}
                                </p>

                            @endforeach

                        </div>

                    @endif


                    @if(!empty($halaman['note']))

                        <div class="lesson-note-card">

                            <strong>
                                💡 Ingat
                            </strong>

                            <p>
                                {{ $halaman['note'] }}
                            </p>

                        </div>

                    @endif

                </article>


                {{-- ================================================= --}}
                {{-- CHECKPOINT --}}
                {{-- ================================================= --}}

                <section class="lesson-checkpoint-card">

                    <div class="lesson-card-heading">

                        <span>
                            CHECKPOINT HALAMAN
                        </span>

                        <h2>
                            Coba dulu sebelum lanjut
                        </h2>

                    </div>


                    <p class="lesson-checkpoint-question">
                        {{ $halaman['checkpoint']['question'] }}
                    </p>


                    <form
                        action="{{ route('mahasiswa.materi.checkpoint', ['level' => $level, 'page' => $page]) }}"
                        method="POST"
                    >

                        @csrf


                        <div class="lesson-options">

                            @foreach($halaman['checkpoint']['options'] as $key => $option)

                                <label class="lesson-option">

                                    <input
                                        type="radio"
                                        name="answer"
                                        value="{{ $key }}"
                                        {{ old('answer') === $key ? 'checked' : '' }}
                                        required
                                    >

                                    <span class="lesson-option-key">
                                        {{ $key }}
                                    </span>

                                    <span>
                                        {{ $option }}
                                    </span>

                                </label>

                            @endforeach

                        </div>


                        @if(session('checkpoint_wrong'))

                            <div class="lesson-answer-feedback wrong">

                                <strong>
                                    Belum tepat.
                                </strong>

                                <p>
                                    {{ session('checkpoint_feedback') }}
                                </p>

                            </div>

                        @endif


                        <div class="lesson-bottom-actions">

                            @if($page > 1)

                                <a
                                    href="{{ route('mahasiswa.materi.page', ['level' => $level, 'page' => $page - 1]) }}"
                                    class="lesson-secondary-button"
                                >
                                    ← Kembali
                                </a>

                            @else

                                <a
                                    href="{{ route('mahasiswa.materi.index') }}"
                                    class="lesson-secondary-button"
                                >
                                    ← Daftar Materi
                                </a>

                            @endif


                            <button
                                type="submit"
                                class="lesson-primary-button"
                            >
                                Periksa & Lanjut →
                            </button>

                        </div>

                    </form>

                </section>


            {{-- ================================================= --}}
            {{-- EVALUASI AKHIR --}}
            {{-- ================================================= --}}

            @else


                <section class="lesson-final-card">

                    <div class="lesson-card-heading">

                        <span>
                            EVALUASI AKHIR SUBBAB
                        </span>

                        <h2>
                            {{ $halaman['title'] }}
                        </h2>

                        <p>
                            {{ $halaman['subtitle'] }}
                        </p>

                    </div>


                    <div class="lesson-final-info">

                        <div>

                            <span>
                                JUMLAH SOAL
                            </span>

                            <strong>
                                {{ count($halaman['questions']) }}
                            </strong>

                        </div>


                        <div>

                            <span>
                                NILAI MINIMAL
                            </span>

                            <strong>
                                80%
                            </strong>

                        </div>


                        <div>

                            <span>
                                REWARD LEVEL
                            </span>

                            <strong>
                                +100 XP
                            </strong>

                        </div>

                    </div>


                    {{-- ================================================= --}}
                    {{-- HASIL EVALUASI --}}
                    {{-- ================================================= --}}

                    @if(session()->has('quiz_score'))

                        <div class="lesson-result-card {{ session('quiz_passed') ? 'passed' : 'failed' }}">

                            <div>

                                <span>
                                    HASIL EVALUASI
                                </span>

                                <strong>
                                    {{ session('quiz_score') }}%
                                </strong>

                            </div>


                            <p>
                                {{ session('quiz_correct') }}
                                dari
                                {{ session('quiz_total') }}
                                jawaban benar.
                            </p>


                            @if(session('quiz_passed'))

                                <b>

                                    ✓ Tuntas.

                                    @if($level < 6)

                                        Subbab berikutnya telah terbuka.

                                    @else

                                        Seluruh subbab telah diselesaikan.

                                    @endif


                                    @if(session('quiz_xp_gain', 0) > 0)

                                        Kamu memperoleh
                                        +{{ session('quiz_xp_gain') }} XP.

                                    @endif

                                </b>

                            @else

                                <b>
                                    Nilai belum mencapai 80%.
                                    Pelajari kembali materi pada subbab ini lalu coba evaluasi lagi.
                                </b>

                            @endif

                        </div>

                    @endif


                    {{-- ================================================= --}}
                    {{-- FORM EVALUASI --}}
                    {{-- ================================================= --}}

                    <form
                        action="{{ route('mahasiswa.materi.evaluate', $level) }}"
                        method="POST"
                        class="lesson-final-form"
                    >

                        @csrf


                        @foreach($halaman['questions'] as $index => $question)

                            @php

                                $result =
                                    session('quiz_results.' . $index);

                                $resultIsCorrect =
                                    $result
                                        ? (bool) data_get(
                                            $result,
                                            'is_correct',
                                            false
                                        )
                                        : false;

                            @endphp


                            <article class="lesson-quiz-question">

                                <div class="lesson-quiz-number">
                                    {{ $index + 1 }}
                                </div>


                                <div class="lesson-quiz-content">

                                    <h3>
                                        {{ $question['question'] }}
                                    </h3>


                                    <div class="lesson-options">

                                        @foreach($question['options'] as $key => $option)

                                            @php

                                                $isSelected =
                                                    old(
                                                        'answers.' . $index
                                                    ) === $key;

                                                $optionClass = '';


                                                /*
                                                |--------------------------------------------------------------------------
                                                | JANGAN TAMPILKAN KUNCI JAWABAN
                                                |--------------------------------------------------------------------------
                                                |
                                                | Hanya jawaban yang dipilih mahasiswa
                                                | yang diberi warna.
                                                |
                                                */

                                                if (
                                                    $result &&
                                                    $isSelected
                                                ) {

                                                    $optionClass =
                                                        $resultIsCorrect
                                                            ? 'correct'
                                                            : 'wrong';

                                                }

                                            @endphp


                                            <label class="lesson-option {{ $optionClass }}">

                                                <input
                                                    type="radio"
                                                    name="answers[{{ $index }}]"
                                                    value="{{ $key }}"
                                                    {{ $isSelected ? 'checked' : '' }}
                                                    required
                                                >

                                                <span class="lesson-option-key">
                                                    {{ $key }}
                                                </span>

                                                <span>
                                                    {{ $option }}
                                                </span>

                                            </label>

                                        @endforeach

                                    </div>


                                    {{-- ================================================= --}}
                                    {{-- FEEDBACK --}}
                                    {{-- ================================================= --}}

                                    @if($result)

                                        <div class="lesson-question-feedback {{ $resultIsCorrect ? 'correct' : 'wrong' }}">

                                            @if($resultIsCorrect)

                                                <strong>
                                                    ✓ Jawaban kamu benar.
                                                </strong>

                                                <p>
                                                    Bagus. Pemahamanmu pada bagian ini sudah tepat.
                                                </p>

                                            @else

                                                <strong>
                                                    Jawaban belum tepat.
                                                </strong>

                                                <p>
                                                    Jawaban yang benar tidak ditampilkan.
                                                    Pelajari kembali materi pada subbab ini,
                                                    lalu coba evaluasi lagi.
                                                </p>

                                            @endif

                                        </div>

                                    @endif

                                </div>

                            </article>

                        @endforeach


                        <div class="lesson-bottom-actions">

                            <a
                                href="{{ route('mahasiswa.materi.page', [
                                    'level' => $level,
                                    'page' => max(1, $page - 1)
                                ]) }}"
                                class="lesson-secondary-button"
                            >
                                ← Kembali ke Materi
                            </a>


                            <button
                                type="submit"
                                class="lesson-primary-button"
                            >
                                Selesaikan Evaluasi
                            </button>

                        </div>

                    </form>


                    {{-- ================================================= --}}
                    {{-- NEXT LEVEL --}}
                    {{-- ================================================= --}}

                    @if(session('quiz_passed'))

                        <div class="lesson-next-level-box">

                            @if($level < 6)

                                <a
                                    href="{{ route('mahasiswa.materi.show', $level + 1) }}"
                                    class="lesson-primary-button"
                                >
                                    Buka Subbab {{ $level + 1 }} →
                                </a>

                            @else

                                <a
                                    href="{{ route('mahasiswa.dashboard') }}"
                                    class="lesson-primary-button"
                                >
                                    Kembali ke Dashboard →
                                </a>

                            @endif

                        </div>

                    @endif

                </section>

            @endif

        </main>


        {{-- ================================================= --}}
        {{-- SIDEBAR KANAN --}}
        {{-- ================================================= --}}

        <aside class="lesson-side-column">


            <div class="lesson-side-card">

                <span class="lesson-side-label">
                    PROGRESS MATERI
                </span>

                <h3>
                    {{ $materi['nama'] }}
                </h3>

                <progress
                    value="{{ $pageProgress }}"
                    max="100"
                    class="lesson-progress"
                ></progress>

                <strong>
                    {{ $pageProgress }}%
                </strong>

            </div>


            <div class="lesson-side-card">

                <span class="lesson-side-label">
                    NAVIGASI HALAMAN
                </span>


                <div class="lesson-page-navigation">

                    @for($i = 1; $i <= $totalPages; $i++)

                        @php

                            $isAccessible =
                                in_array(
                                    $i,
                                    $accessiblePages,
                                    true
                                );

                            $isCurrent =
                                $i === $page;

                        @endphp


                        @if($isAccessible)

                            <a
                                href="{{ route('mahasiswa.materi.page', [
                                    'level' => $level,
                                    'page' => $i
                                ]) }}"
                                class="{{ $isCurrent ? 'active' : '' }}"
                            >

                                @if($i === $totalPages)

                                    Evaluasi

                                @else

                                    Halaman {{ $i }}

                                @endif

                            </a>

                        @else

                            <span class="locked">

                                🔒

                                @if($i === $totalPages)

                                    Evaluasi

                                @else

                                    Halaman {{ $i }}

                                @endif

                            </span>

                        @endif

                    @endfor

                </div>

            </div>


            <div class="lesson-side-card">

                <span class="lesson-side-label">
                    PROGRESS KESELURUHAN
                </span>

                <h3>
                    {{ $subbabSelesai }}
                    /
                    {{ $totalSubbab }}
                    Subbab
                </h3>

                <progress
                    value="{{ $overallProgress }}"
                    max="100"
                    class="lesson-progress"
                ></progress>

                <strong>
                    {{ $overallProgress }}%
                </strong>

            </div>

        </aside>

    </div>

</section>

@endsection