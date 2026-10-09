<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Media Himpunan - Belajar Matematika Interaktif</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>

<header class="navbar">
    <div class="container navbar-inner">

        <a href="/" class="brand">
            <div class="brand-icon">
                ∪
            </div>

            <div>
                <div class="brand-title">Media Himpunan</div>
                <div class="brand-subtitle">Belajar • Bermain • Berprestasi</div>
            </div>
        </a>

        <nav class="nav-menu" id="navMenu">
            <a href="#beranda" class="nav-link active">Beranda</a>
            <a href="#materi" class="nav-link">Materi</a>
            <a href="#gamifikasi" class="nav-link">Gamifikasi</a>
            <a href="#fitur" class="nav-link">Fitur</a>
            <a href="#tentang" class="nav-link">Tentang</a>
        </nav>

        <div class="nav-actions">
            <button class="btn-login">
                Masuk
            </button>

            <button class="btn-register">
                Daftar Sekarang
            </button>
        </div>

        <button class="mobile-toggle" id="mobileToggle">
            ☰
        </button>

    </div>
</header>


<main>

    {{-- HERO --}}
    <section class="hero" id="beranda">

        <div class="hero-decoration decoration-one"></div>
        <div class="hero-decoration decoration-two"></div>
        <div class="hero-decoration decoration-three"></div>

        <div class="container hero-grid">

            <div class="hero-content">

                <div class="hero-badge">
                    <span class="badge-icon">✨</span>
                    Media Pembelajaran Interaktif
                </div>

                <h1 class="hero-title">
                    Belajar
                    <span class="text-gradient">Himpunan</span>
                    Jadi Lebih Seru!
                </h1>

                <p class="hero-description">
                    Pelajari materi himpunan melalui pengalaman belajar
                    interaktif yang dilengkapi dengan tantangan, poin,
                    level, badge, dan berbagai aktivitas gamifikasi.
                </p>

                <div class="hero-buttons">

                    <a href="#materi" class="btn-primary">
                        <span>Mulai Belajar</span>
                        <span>→</span>
                    </a>

                    <a href="#fitur" class="btn-secondary">
                        <span class="play-icon">▶</span>
                        Lihat Fitur
                    </a>

                </div>

                <div class="hero-trust">

                    <div class="avatar-stack">
                        <div class="avatar">A</div>
                        <div class="avatar">B</div>
                        <div class="avatar">C</div>
                        <div class="avatar avatar-more">+</div>
                    </div>

                    <div>
                        <div class="stars">★★★★★</div>
                        <p>Belajar matematika dengan cara yang lebih menyenangkan.</p>
                    </div>

                </div>

            </div>


            {{-- HERO GAME CARD --}}
            <div class="hero-visual">

                <div class="floating-card float-xp">
                    <div class="floating-icon purple">⚡</div>
                    <div>
                        <span class="float-label">XP Hari Ini</span>
                        <strong>+120 XP</strong>
                    </div>
                </div>

                <div class="floating-card float-streak">
                    <div class="floating-icon orange">🔥</div>
                    <div>
                        <span class="float-label">Streak</span>
                        <strong>5 Hari</strong>
                    </div>
                </div>

                <div class="game-card">

                    <div class="game-card-header">

                        <div class="game-user">
                            <div class="game-avatar">
                                M
                            </div>

                            <div>
                                <small>Selamat datang,</small>
                                <strong>Mahasiswa!</strong>
                            </div>
                        </div>

                        <div class="level-badge">
                            Lv. 4
                        </div>

                    </div>


                    <div class="progress-card">

                        <div class="progress-info">
                            <span>Progress Level</span>
                            <strong>420 / 500 XP</strong>
                        </div>

                        <div class="progress-track">
                            <div class="progress-fill"></div>
                        </div>

                        <div class="progress-bottom">
                            <span>Level 4</span>
                            <span>80 XP lagi 🚀</span>
                        </div>

                    </div>


                    <div class="challenge-card">

                        <div class="challenge-header">

                            <div>
                                <span class="mini-label">TANTANGAN HARI INI</span>
                                <h3>Operasi Himpunan</h3>
                            </div>

                            <div class="heart">
                                ❤️ 3
                            </div>

                        </div>

                        <p>
                            Jika A = {1, 2, 3, 4} dan B = {3, 4, 5},
                            maka A ∩ B adalah...
                        </p>

                        <div class="answer-grid">
                            <button>A. {1, 2}</button>
                            <button class="selected">B. {3, 4}</button>
                            <button>C. {4, 5}</button>
                            <button>D. {1, 5}</button>
                        </div>

                        <div class="challenge-footer">
                            <span>+20 XP</span>
                            <button>Jawab →</button>
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>


    {{-- STATISTICS --}}
    <section class="stats">

        <div class="container stats-grid">

            <div class="stat-item">
                <div class="stat-icon blue">📘</div>

                <div>
                    <strong>7</strong>
                    <span>Materi Utama</span>
                </div>
            </div>

            <div class="stat-item">
                <div class="stat-icon purple">🎯</div>

                <div>
                    <strong>50+</strong>
                    <span>Soal Interaktif</span>
                </div>
            </div>

            <div class="stat-item">
                <div class="stat-icon orange">🏆</div>

                <div>
                    <strong>10+</strong>
                    <span>Achievement</span>
                </div>
            </div>

            <div class="stat-item">
                <div class="stat-icon green">🎮</div>

                <div>
                    <strong>100%</strong>
                    <span>Gamifikasi</span>
                </div>
            </div>

        </div>

    </section>


    {{-- MATERI --}}
    <section class="section material-section" id="materi">

        <div class="container">

            <div class="section-heading">

                <div class="section-badge">
                    📚 MATERI PEMBELAJARAN
                </div>

                <h2>
                    Kuasai Materi
                    <span class="text-gradient">Himpunan</span>
                </h2>

                <p>
                    Materi disusun secara bertahap agar kamu dapat memahami
                    konsep himpunan mulai dari dasar hingga penerapannya.
                </p>

            </div>


            <div class="material-grid">

                <article class="material-card available">

                    <div class="material-top">

                        <div class="material-number">
                            01
                        </div>

                        <span class="status-badge start">
                            Mulai
                        </span>

                    </div>

                    <div class="material-icon icon-blue">
                        ∈
                    </div>

                    <h3>Konsep Dasar Himpunan</h3>

                    <p>
                        Mengenal pengertian himpunan, anggota, simbol,
                        serta contoh dan bukan contoh himpunan.
                    </p>

                    <div class="material-progress">
                        <span>Progress</span>
                        <strong>0%</strong>
                    </div>

                    <div class="small-progress">
                        <div style="width: 0%"></div>
                    </div>

                    <a href="#">
                        Mulai Materi
                        <span>→</span>
                    </a>

                </article>


                <article class="material-card">

                    <div class="material-top">

                        <div class="material-number">
                            02
                        </div>

                        <span class="status-badge">
                            Berikutnya
                        </span>

                    </div>

                    <div class="material-icon icon-purple">
                        { }
                    </div>

                    <h3>Penyajian Himpunan</h3>

                    <p>
                        Pelajari berbagai cara menyatakan himpunan
                        menggunakan kata-kata, notasi dan enumerasi.
                    </p>

                    <div class="material-progress">
                        <span>Progress</span>
                        <strong>0%</strong>
                    </div>

                    <div class="small-progress"></div>

                    <a href="#">
                        Pelajari
                        <span>→</span>
                    </a>

                </article>


                <article class="material-card">

                    <div class="material-top">

                        <div class="material-number">
                            03
                        </div>

                        <span class="status-badge">
                            Berikutnya
                        </span>

                    </div>

                    <div class="material-icon icon-orange">
                        ⊂
                    </div>

                    <h3>Jenis-Jenis Himpunan</h3>

                    <p>
                        Mengenal himpunan kosong, semesta, hingga
                        himpunan bagian dan himpunan kuasa.
                    </p>

                    <div class="material-progress">
                        <span>Progress</span>
                        <strong>0%</strong>
                    </div>

                    <div class="small-progress"></div>

                    <a href="#">
                        Pelajari
                        <span>→</span>
                    </a>

                </article>


                <article class="material-card locked">

                    <div class="material-top">
                        <div class="material-number">04</div>
                        <span class="status-badge lock">
                            🔒 Terkunci
                        </span>
                    </div>

                    <div class="material-icon icon-green">
                        ↔
                    </div>

                    <h3>Relasi Antar Himpunan</h3>

                    <p>
                        Pelajari hubungan serta keterkaitan antara
                        satu himpunan dengan himpunan lainnya.
                    </p>

                    <div class="material-progress">
                        <span>Progress</span>
                        <strong>0%</strong>
                    </div>

                    <div class="small-progress"></div>

                </article>


                <article class="material-card locked">

                    <div class="material-top">
                        <div class="material-number">05</div>

                        <span class="status-badge lock">
                            🔒 Terkunci
                        </span>
                    </div>

                    <div class="material-icon icon-pink">
                        ∪
                    </div>

                    <h3>Operasi Himpunan</h3>

                    <p>
                        Memahami gabungan, irisan, selisih,
                        dan komplemen pada himpunan.
                    </p>

                    <div class="material-progress">
                        <span>Progress</span>
                        <strong>0%</strong>
                    </div>

                    <div class="small-progress"></div>

                </article>


                <article class="material-card locked">

                    <div class="material-top">
                        <div class="material-number">06</div>

                        <span class="status-badge lock">
                            🔒 Terkunci
                        </span>
                    </div>

                    <div class="material-icon icon-cyan">
                        ◯
                    </div>

                    <h3>Diagram Venn</h3>

                    <p>
                        Visualisasikan hubungan dan operasi himpunan
                        melalui diagram Venn.
                    </p>

                    <div class="material-progress">
                        <span>Progress</span>
                        <strong>0%</strong>
                    </div>

                    <div class="small-progress"></div>

                </article>

            </div>


            <div class="material-more">

                <button>
                    Lihat Semua Materi
                    <span>→</span>
                </button>

            </div>

        </div>

    </section>


    {{-- GAMIFICATION --}}
    <section class="section game-section" id="gamifikasi">

        <div class="container game-grid">

            <div class="game-info">

                <div class="section-badge">
                    🎮 BELAJAR SAMBIL BERMAIN
                </div>

                <h2>
                    Naik Level Setiap Kali
                    <span class="text-gradient">Belajar</span>
                </h2>

                <p class="game-description">
                    Setiap aktivitas belajar memberikan XP.
                    Kumpulkan poin, naik level dan raih berbagai
                    penghargaan selama perjalanan belajarmu.
                </p>


                <div class="game-benefits">

                    <div class="benefit">

                        <div class="benefit-icon purple">
                            ⚡
                        </div>

                        <div>
                            <h4>Kumpulkan XP</h4>
                            <p>
                                Selesaikan materi dan quiz untuk
                                mendapatkan experience points.
                            </p>
                        </div>

                    </div>


                    <div class="benefit">

                        <div class="benefit-icon orange">
                            🔥
                        </div>

                        <div>
                            <h4>Pertahankan Streak</h4>
                            <p>
                                Belajar secara rutin setiap hari
                                dan bangun streak terbaikmu.
                            </p>
                        </div>

                    </div>


                    <div class="benefit">

                        <div class="benefit-icon yellow">
                            🏆
                        </div>

                        <div>
                            <h4>Raih Achievement</h4>
                            <p>
                                Buka berbagai badge khusus dari
                                pencapaian belajar.
                            </p>
                        </div>

                    </div>

                </div>

            </div>


            <div class="achievement-panel">

                <div class="panel-header">
                    <div>
                        <span>PENCAPAIANMU</span>
                        <h3>Achievement</h3>
                    </div>

                    <div class="trophy">
                        🏆
                    </div>
                </div>


                <div class="achievement-main">
                    <div class="big-level">
                        <span>LEVEL</span>
                        <strong>4</strong>
                    </div>

                    <div class="level-info">
                        <span>Math Explorer</span>

                        <div class="level-track">
                            <div></div>
                        </div>

                        <small>420 / 500 XP</small>
                    </div>
                </div>


                <div class="badge-grid">

                    <div class="achievement-badge earned">
                        <div>🌟</div>
                        <span>First Step</span>
                    </div>

                    <div class="achievement-badge earned">
                        <div>🔥</div>
                        <span>On Fire</span>
                    </div>

                    <div class="achievement-badge earned">
                        <div>🧠</div>
                        <span>Smart</span>
                    </div>

                    <div class="achievement-badge">
                        <div>🔒</div>
                        <span>Locked</span>
                    </div>

                </div>

            </div>

        </div>

    </section>


    {{-- FEATURES --}}
    <section class="section features" id="fitur">

        <div class="container">

            <div class="section-heading">

                <div class="section-badge">
                    ✨ FITUR PEMBELAJARAN
                </div>

                <h2>
                    Belajar Lebih
                    <span class="text-gradient">Interaktif</span>
                </h2>

                <p>
                    Berbagai fitur dibuat untuk meningkatkan motivasi
                    dan membuat proses belajar menjadi lebih menarik.
                </p>

            </div>


            <div class="feature-grid">

                <div class="feature-card">
                    <div class="feature-icon icon-blue">📖</div>
                    <h3>Materi Interaktif</h3>
                    <p>
                        Materi disajikan secara terstruktur,
                        visual dan mudah dipahami.
                    </p>
                </div>


                <div class="feature-card">
                    <div class="feature-icon icon-purple">🎯</div>
                    <h3>Quiz & Challenge</h3>
                    <p>
                        Uji pemahaman melalui latihan dan tantangan
                        interaktif.
                    </p>
                </div>


                <div class="feature-card">
                    <div class="feature-icon icon-orange">🏆</div>
                    <h3>Leaderboard</h3>
                    <p>
                        Bandingkan pencapaian dan XP dengan
                        mahasiswa lainnya.
                    </p>
                </div>


                <div class="feature-card">
                    <div class="feature-icon icon-green">📈</div>
                    <h3>Progress Belajar</h3>
                    <p>
                        Pantau perkembangan pembelajaran dari
                        waktu ke waktu.
                    </p>
                </div>

            </div>

        </div>

    </section>


    {{-- CTA --}}
    <section class="cta-section">

        <div class="container">

            <div class="cta-card">

                <div class="cta-decoration"></div>

                <div class="cta-content">

                    <div class="cta-badge">
                        🚀 Siap Memulai?
                    </div>

                    <h2>
                        Jadikan Matematika Lebih
                        Menyenangkan
                    </h2>

                    <p>
                        Mulai perjalanan belajar himpunan,
                        kumpulkan XP dan jadilah Math Master!
                    </p>

                    <button>
                        Mulai Belajar Sekarang
                        <span>→</span>
                    </button>

                </div>

                <div class="cta-art">
                    <div class="cta-circle">
                        ∪
                    </div>
                </div>

            </div>

        </div>

    </section>

</main>


<footer class="footer" id="tentang">

    <div class="container footer-grid">

        <div>

            <a href="/" class="brand footer-brand">
                <div class="brand-icon">
                    ∪
                </div>

                <div>
                    <div class="brand-title">
                        Media Himpunan
                    </div>

                    <div class="brand-subtitle">
                        Matematika Dasar
                    </div>
                </div>
            </a>

            <p class="footer-description">
                Media pembelajaran interaktif materi himpunan
                dengan pendekatan gamifikasi.
            </p>

        </div>


        <div class="footer-menu">
            <h4>Pembelajaran</h4>
            <a href="#materi">Materi</a>
            <a href="#gamifikasi">Gamifikasi</a>
            <a href="#fitur">Fitur</a>
        </div>


        <div class="footer-menu">
            <h4>Informasi</h4>
            <a href="#">Tentang</a>
            <a href="#">Panduan</a>
            <a href="#">Bantuan</a>
        </div>


        <div class="footer-menu">
            <h4>Proyek</h4>
            <p>
                Pendidikan Ilmu Komputer
            </p>
        </div>

    </div>


    <div class="container footer-bottom">
        <p>
            © {{ date('Y') }} Media Himpunan.
            Media Pembelajaran Matematika Dasar.
        </p>
    </div>

</footer>


<script>
    const mobileToggle = document.getElementById('mobileToggle');
    const navMenu = document.getElementById('navMenu');

    mobileToggle.addEventListener('click', function () {
        navMenu.classList.toggle('show');
    });
</script>

</body>
</html>