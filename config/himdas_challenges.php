<?php

/*
|--------------------------------------------------------------------------
| BANK CHALLENGE HIMDAS
|--------------------------------------------------------------------------
|
| Total:
| - Subbab 1 = 10 Challenge
| - Subbab 2 = 10 Challenge
| - Subbab 3 = 10 Challenge
| - Subbab 4 = 10 Challenge
| - Subbab 5 = 10 Challenge
| - Subbab 6 = 10 Challenge
|
| Total = 60 Challenge
|
| Tingkat Kesulitan:
| - Mudah  = 10 XP
| - Sedang = 20 XP
| - Sulit  = 30 XP
|
*/


/*
|--------------------------------------------------------------------------
| HELPER PILIHAN GANDA
|--------------------------------------------------------------------------
*/

$choice = static function (
    string $key,
    int $subbab,
    string $title,
    string $difficulty,
    int $xp,
    string $question,
    array $options,
    string $answer
): array {
    return [
        'key' => $key,
        'subbab' => $subbab,
        'title' => $title,
        'difficulty' => $difficulty,
        'xp' => $xp,
        'type' => 'choice',
        'question' => $question,
        'options' => $options,
        'answer' => $answer,
    ];
};


/*
|--------------------------------------------------------------------------
| HELPER JAWABAN SINGKAT
|--------------------------------------------------------------------------
*/

$short = static function (
    string $key,
    int $subbab,
    string $title,
    string $difficulty,
    int $xp,
    string $question,
    string $answer
): array {
    return [
        'key' => $key,
        'subbab' => $subbab,
        'title' => $title,
        'difficulty' => $difficulty,
        'xp' => $xp,
        'type' => 'short',
        'question' => $question,
        'answer' => $answer,
    ];
};


return [

    /*
    |--------------------------------------------------------------------------
    | SUBBAB 1
    | PENGENAL HIMPUNAN
    |--------------------------------------------------------------------------
    */


    $choice(
        's1-detektif-01',
        1,
        'Detektif Himpunan',
        'mudah',
        10,
        'Manakah yang merupakan himpunan karena keanggotaannya dapat ditentukan dengan jelas?',
        [
            'A' => 'Kumpulan makanan terenak',
            'B' => 'Kumpulan bilangan genap kurang dari 12',
            'C' => 'Kumpulan film paling bagus',
            'D' => 'Kumpulan mahasiswa paling rajin',
        ],
        'B'
    ),


    $choice(
        's1-anggota-02',
        1,
        'Cek Keanggotaan',
        'mudah',
        10,
        'Jika A = {2, 4, 6, 8, 10}, pernyataan yang benar adalah ...',
        [
            'A' => '5 ∈ A',
            'B' => '8 ∈ A',
            'C' => '6 ∉ A',
            'D' => '2 ∉ A',
        ],
        'B'
    ),


    $choice(
        's1-anggota-03',
        1,
        'Bukan Anggota',
        'mudah',
        10,
        'Jika B = {a, i, u, e, o}, pernyataan yang benar adalah ...',
        [
            'A' => 'b ∈ B',
            'B' => 'u ∉ B',
            'C' => 'e ∈ B',
            'D' => 'o ∉ B',
        ],
        'C'
    ),


    $choice(
        's1-kardinal-04',
        1,
        'Hitung Kardinalitas',
        'sedang',
        20,
        'Jika C = {1, 2, 2, 3, 4, 4, 4}, berapakah n(C)?',
        [
            'A' => '4',
            'B' => '5',
            'C' => '6',
            'D' => '7',
        ],
        'A'
    ),


    $choice(
        's1-detektif-05',
        1,
        'Objektif atau Subjektif?',
        'sedang',
        20,
        'Manakah kumpulan yang BUKAN merupakan himpunan?',
        [
            'A' => 'Nama hari dalam seminggu',
            'B' => 'Bilangan prima kurang dari 20',
            'C' => 'Mahasiswa yang memiliki NIM genap',
            'D' => 'Dosen yang paling menyenangkan',
        ],
        'D'
    ),


    $choice(
        's1-notasi-06',
        1,
        'Misi Simbol',
        'mudah',
        10,
        'Jika 7 bukan anggota himpunan P, notasi yang tepat adalah ...',
        [
            'A' => '7 ∈ P',
            'B' => '7 ∉ P',
            'C' => 'P ∈ 7',
            'D' => 'P ∉ 7',
        ],
        'B'
    ),


    $short(
        's1-kardinal-07',
        1,
        'Kardinal Cepat',
        'sedang',
        20,
        'A = {m, a, t, e, m, a, t, i, k, a}. Tuliskan banyak anggota berbeda dari A.',
        '6'
    ),


    $choice(
        's1-konsep-08',
        1,
        'Kriteria Himpunan',
        'mudah',
        10,
        'Syarat utama suatu kumpulan disebut himpunan dalam matematika adalah ...',
        [
            'A' => 'Anggotanya harus bilangan',
            'B' => 'Anggotanya harus lebih dari dua',
            'C' => 'Keanggotaannya dapat ditentukan dengan jelas',
            'D' => 'Harus digambar dengan diagram Venn',
        ],
        'C'
    ),


    $short(
        's1-kardinal-09',
        1,
        'Prima Hunter',
        'sedang',
        20,
        'P adalah himpunan bilangan prima kurang dari 15. Berapakah n(P)?',
        '6'
    ),


    $choice(
        's1-anggota-10',
        1,
        'Keanggotaan Kilat',
        'sulit',
        30,
        'Diketahui D = {x | x bilangan ganjil positif kurang dari 10}. Pernyataan yang benar adalah ...',
        [
            'A' => '8 ∈ D',
            'B' => '9 ∈ D',
            'C' => '10 ∈ D',
            'D' => '2 ∈ D',
        ],
        'B'
    ),



    /*
    |--------------------------------------------------------------------------
    | SUBBAB 2
    | PEMBENTUK HIMPUNAN
    |--------------------------------------------------------------------------
    */


    $choice(
        's2-tabulasi-01',
        2,
        'Ubah ke Tabulasi',
        'mudah',
        10,
        'A = {x | 0 ≤ x < 5, x bilangan cacah}. Bentuk tabulasinya adalah ...',
        [
            'A' => '{0,1,2,3,4}',
            'B' => '{1,2,3,4,5}',
            'C' => '{0,1,2,3,4,5}',
            'D' => '{1,2,3,4}',
        ],
        'A'
    ),


    $choice(
        's2-pembentuk-02',
        2,
        'Notasi Pembentuk',
        'sedang',
        20,
        'Manakah notasi pembentuk yang sesuai untuk A = {2,4,6,8}?',
        [
            'A' => '{x | x bilangan genap, 0 < x < 10}',
            'B' => '{x | x bilangan ganjil, 0 < x < 10}',
            'C' => '{x | x bilangan prima, x < 10}',
            'D' => '{x | x bilangan asli, x > 8}',
        ],
        'A'
    ),


    $choice(
        's2-simbol-03',
        2,
        'Kode Bilangan',
        'mudah',
        10,
        'Simbol baku untuk himpunan bilangan bulat adalah ...',
        [
            'A' => 'N',
            'B' => 'Z',
            'C' => 'Q',
            'D' => 'R',
        ],
        'B'
    ),


    $choice(
        's2-simbol-04',
        2,
        'Kenali Bilangan Rasional',
        'mudah',
        10,
        'Simbol baku untuk himpunan bilangan rasional adalah ...',
        [
            'A' => 'N',
            'B' => 'Z',
            'C' => 'Q',
            'D' => 'C',
        ],
        'C'
    ),


    $choice(
        's2-enumerasi-05',
        2,
        'Lanjutkan Pola',
        'sedang',
        20,
        'B = {0,1,4,9,16,...}. Anggota berikutnya adalah ...',
        [
            'A' => '20',
            'B' => '24',
            'C' => '25',
            'D' => '32',
        ],
        'C'
    ),


    $choice(
        's2-deskriptif-06',
        2,
        'Baca Deskripsi',
        'sedang',
        20,
        'Deskripsi yang tepat untuk A = {2,3,5,7} adalah ...',
        [
            'A' => 'Bilangan genap kurang dari 10',
            'B' => 'Bilangan prima kurang dari 10',
            'C' => 'Bilangan ganjil kurang dari 10',
            'D' => 'Bilangan asli kurang dari 5',
        ],
        'B'
    ),


    $choice(
        's2-venn-07',
        2,
        'Posisi di Diagram Venn',
        'sedang',
        20,
        'Dalam diagram Venn, himpunan semesta biasanya digambarkan sebagai ...',
        [
            'A' => 'Titik',
            'B' => 'Lingkaran kecil',
            'C' => 'Persegi panjang yang memuat himpunan-himpunan lain',
            'D' => 'Garis bilangan',
        ],
        'C'
    ),


    $choice(
        's2-tabulasi-08',
        2,
        'Tabulasi Ganjil',
        'mudah',
        10,
        'Himpunan bilangan ganjil positif kurang dari 10 dalam bentuk tabulasi adalah ...',
        [
            'A' => '{1,3,5,7,9}',
            'B' => '{2,4,6,8}',
            'C' => '{0,2,4,6,8}',
            'D' => '{1,2,3,4,5}',
        ],
        'A'
    ),


    $choice(
        's2-simbol-09',
        2,
        'Real Number Check',
        'sedang',
        20,
        'Simbol baku yang umum digunakan untuk himpunan bilangan real adalah ...',
        [
            'A' => 'R',
            'B' => 'N',
            'C' => 'Z',
            'D' => 'Q',
        ],
        'A'
    ),


    $choice(
        's2-representasi-10',
        2,
        'Representasi Master',
        'sulit',
        30,
        'Manakah pasangan representasi yang ekuivalen?',
        [
            'A' => '{2,4,6} dan {x | x bilangan genap, 0 < x < 7}',
            'B' => '{1,3,5} dan {x | x bilangan genap, x < 6}',
            'C' => '{2,3,5} dan {x | x bilangan ganjil, x < 6}',
            'D' => '{1,2,3} dan {x | x > 3}',
        ],
        'A'
    ),



    /*
    |--------------------------------------------------------------------------
    | SUBBAB 3
    | VENN MASTER
    |--------------------------------------------------------------------------
    */


    $choice(
        's3-kosong-01',
        3,
        'Empty Set Alert',
        'mudah',
        10,
        'Himpunan {x | 3 < x < 4, x bilangan bulat} adalah ...',
        [
            'A' => '{3}',
            'B' => '{4}',
            'C' => '∅',
            'D' => '{3,4}',
        ],
        'C'
    ),


    $choice(
        's3-semesta-02',
        3,
        'Semesta yang Tepat',
        'sedang',
        20,
        'Jika A = {2,4,6,8}, himpunan semesta yang mungkin adalah ...',
        [
            'A' => '{1,3,5,7}',
            'B' => '{1,2,3,4,5,6,7,8,9,10}',
            'C' => '{2,4}',
            'D' => '{6,8}',
        ],
        'B'
    ),


    $choice(
        's3-sama-03',
        3,
        'Sama atau Tidak?',
        'mudah',
        10,
        'Jika A = {1,2,3} dan B = {3,2,1}, maka ...',
        [
            'A' => 'A = B',
            'B' => 'A ≠ B',
            'C' => 'A dan B lepas',
            'D' => 'A ∩ B = ∅',
        ],
        'A'
    ),


    $choice(
        's3-lepas-04',
        3,
        'Deteksi Himpunan Lepas',
        'sedang',
        20,
        'A = {1,2,3} dan B = {4,5,6}. Hubungan A dan B adalah ...',
        [
            'A' => 'Sama',
            'B' => 'Bersilangan',
            'C' => 'Lepas',
            'D' => 'Ekuivalen saja',
        ],
        'C'
    ),


    $choice(
        's3-silang-05',
        3,
        'Bersilangan',
        'sedang',
        20,
        'E = {1,2,3,4} dan F = {3,4,5}. Mengapa E dan F bersilangan?',
        [
            'A' => 'Tidak memiliki anggota sama',
            'B' => 'Memiliki sebagian anggota sama tetapi tidak sama seluruhnya',
            'C' => 'Jumlah anggotanya sama',
            'D' => 'Keduanya kosong',
        ],
        'B'
    ),


    $choice(
        's3-ekuivalen-06',
        3,
        'Ekuivalen',
        'mudah',
        10,
        'A = {a,b,c} dan B = {1,2,3}. Hubungan yang benar adalah ...',
        [
            'A' => 'A = B',
            'B' => 'A ekuivalen dengan B',
            'C' => 'A himpunan bagian B',
            'D' => 'A dan B pasti bersilangan',
        ],
        'B'
    ),


    $choice(
        's3-ekuivalen-07',
        3,
        'Kardinal Sama',
        'sedang',
        20,
        'P = {2,4,6,8} dan Q = {a,b,c,d}. Pernyataan yang tepat adalah ...',
        [
            'A' => 'P = Q',
            'B' => 'P dan Q ekuivalen',
            'C' => 'P subset Q',
            'D' => 'Q subset P',
        ],
        'B'
    ),


    $choice(
        's3-relasi-08',
        3,
        'Relasi Antarhimpunan',
        'sulit',
        30,
        'A = {1,2,3} dan B = {2,3,4}. Pernyataan paling tepat adalah ...',
        [
            'A' => 'A dan B lepas',
            'B' => 'A = B',
            'C' => 'A dan B bersilangan',
            'D' => 'A ⊂ B',
        ],
        'C'
    ),


    $choice(
        's3-kosong-09',
        3,
        'Kosong atau Tidak',
        'mudah',
        10,
        'Manakah yang merupakan himpunan kosong?',
        [
            'A' => 'Bilangan prima genap',
            'B' => 'Bilangan asli antara 5 dan 6',
            'C' => 'Bilangan ganjil kurang dari 5',
            'D' => 'Bilangan bulat negatif',
        ],
        'B'
    ),


    $choice(
        's3-sama-10',
        3,
        'Urutan Tidak Penting',
        'sedang',
        20,
        'Dalam himpunan, urutan penulisan anggota ...',
        [
            'A' => 'Menentukan kesamaan himpunan',
            'B' => 'Tidak memengaruhi kesamaan himpunan',
            'C' => 'Harus selalu naik',
            'D' => 'Harus selalu alfabetis',
        ],
        'B'
    ),



    /*
    |--------------------------------------------------------------------------
    | SUBBAB 4
    | SUBSET MASTER
    |--------------------------------------------------------------------------
    */


    $choice(
        's4-subset-01',
        4,
        'Subset Mission',
        'mudah',
        10,
        'Jika A = {1,2} dan B = {1,2,3,4}, maka ...',
        [
            'A' => 'A ⊆ B',
            'B' => 'B ⊆ A',
            'C' => 'A = B',
            'D' => 'A ∩ B = ∅',
        ],
        'A'
    ),


    $choice(
        's4-proper-02',
        4,
        'Subset Sejati',
        'sedang',
        20,
        'Jika A = {1,2} dan B = {1,2,3}, pernyataan yang benar adalah ...',
        [
            'A' => 'A = B',
            'B' => 'A ⊂ B',
            'C' => 'B ⊂ A',
            'D' => 'A dan B lepas',
        ],
        'B'
    ),


    $short(
        's4-count-03',
        4,
        'Hitung Semua Subset',
        'mudah',
        10,
        'Berapa banyak subset dari A = {a,b}?',
        '4'
    ),


    $short(
        's4-power-04',
        4,
        'Power Set',
        'sedang',
        20,
        'Jika n(A) = 3, berapa banyak anggota P(A)?',
        '8'
    ),


    $short(
        's4-power-05',
        4,
        'Power Set Pro',
        'sedang',
        20,
        'Jika n(B) = 5, tentukan |P(B)|.',
        '32'
    ),


    $choice(
        's4-empty-06',
        4,
        'Subset Universal',
        'mudah',
        10,
        'Pernyataan mana yang selalu benar untuk setiap himpunan A?',
        [
            'A' => '∅ ⊆ A',
            'B' => 'A ⊂ ∅',
            'C' => 'A = ∅',
            'D' => 'A tidak mempunyai subset',
        ],
        'A'
    ),


    $choice(
        's4-self-07',
        4,
        'Subset Diri Sendiri',
        'mudah',
        10,
        'Untuk setiap himpunan A, hubungan A terhadap dirinya sendiri adalah ...',
        [
            'A' => 'A ⊆ A',
            'B' => 'A ∩ A = ∅',
            'C' => 'A bukan subset A',
            'D' => 'A selalu kosong',
        ],
        'A'
    ),


    $choice(
        's4-list-08',
        4,
        'Cari Subset Salah',
        'sedang',
        20,
        'Jika A = {1,2,3}, manakah yang BUKAN subset A?',
        [
            'A' => '{1,3}',
            'B' => '{2}',
            'C' => '∅',
            'D' => '{1,4}',
        ],
        'D'
    ),


    $choice(
        's4-proper-09',
        4,
        'Sejati atau Bukan',
        'sulit',
        30,
        'Manakah yang merupakan subset tetapi BUKAN subset sejati dari A = {1,2,3}?',
        [
            'A' => '{1}',
            'B' => '{1,2}',
            'C' => '{1,2,3}',
            'D' => '∅',
        ],
        'C'
    ),


    $short(
        's4-count-10',
        4,
        'Subset 4 Anggota',
        'sulit',
        30,
        'Sebuah himpunan memiliki 4 anggota. Berapa banyak subset yang dimilikinya?',
        '16'
    ),



    /*
    |--------------------------------------------------------------------------
    | SUBBAB 5
    | OPERATION MASTER
    |--------------------------------------------------------------------------
    */


    $choice(
        's5-intersection-01',
        5,
        'Operation Arena: Irisan',
        'mudah',
        10,
        'A = {1,2,3,4} dan B = {3,4,5,6}. A ∩ B = ...',
        [
            'A' => '{1,2}',
            'B' => '{3,4}',
            'C' => '{5,6}',
            'D' => '{1,2,3,4,5,6}',
        ],
        'B'
    ),


    $choice(
        's5-union-02',
        5,
        'Operation Arena: Gabungan',
        'mudah',
        10,
        'A = {1,2,3} dan B = {3,4,5}. A ∪ B = ...',
        [
            'A' => '{3}',
            'B' => '{1,2,4,5}',
            'C' => '{1,2,3,4,5}',
            'D' => '{1,2}',
        ],
        'C'
    ),


    $choice(
        's5-complement-03',
        5,
        'Komplemen',
        'sedang',
        20,
        'S = {1,2,3,4,5,6,7,8}, A = {2,4,6,8}. A′ = ...',
        [
            'A' => '{1,3,5,7}',
            'B' => '{2,4,6,8}',
            'C' => '{1,2,3,4}',
            'D' => '∅',
        ],
        'A'
    ),


    $choice(
        's5-difference-04',
        5,
        'Selisih Himpunan',
        'sedang',
        20,
        'A = {1,2,3,4}, B = {3,4,5,6}. A − B = ...',
        [
            'A' => '{1,2}',
            'B' => '{3,4}',
            'C' => '{5,6}',
            'D' => '{1,2,5,6}',
        ],
        'A'
    ),


    $choice(
        's5-symmetric-05',
        5,
        'Beda Setangkup',
        'sulit',
        30,
        'A = {1,2,3,4}, B = {3,4,5,6}. A △ B = ...',
        [
            'A' => '{3,4}',
            'B' => '{1,2,5,6}',
            'C' => '{1,2,3,4,5,6}',
            'D' => '∅',
        ],
        'B'
    ),


    $choice(
        's5-demorgan-06',
        5,
        'De Morgan',
        'sulit',
        30,
        'Menurut hukum De Morgan, (A ∪ B)′ sama dengan ...',
        [
            'A' => 'A′ ∪ B′',
            'B' => 'A′ ∩ B′',
            'C' => 'A ∩ B',
            'D' => 'A − B',
        ],
        'B'
    ),


    $choice(
        's5-identity-07',
        5,
        'Sifat Identitas',
        'mudah',
        10,
        'Manakah sifat yang benar?',
        [
            'A' => 'A ∪ ∅ = A',
            'B' => 'A ∩ ∅ = A',
            'C' => 'A ∪ A = ∅',
            'D' => 'A ∩ S = ∅',
        ],
        'A'
    ),


    $choice(
        's5-idempotent-08',
        5,
        'Sifat Idempoten',
        'sedang',
        20,
        'Hasil A ∩ A adalah ...',
        [
            'A' => '∅',
            'B' => 'S',
            'C' => 'A',
            'D' => 'A′',
        ],
        'C'
    ),


    $choice(
        's5-commutative-09',
        5,
        'Komutatif',
        'sedang',
        20,
        'Sifat komutatif pada gabungan dinyatakan oleh ...',
        [
            'A' => 'A ∪ B = B ∪ A',
            'B' => 'A ∪ ∅ = A',
            'C' => 'A ∩ A = A',
            'D' => 'A ∩ (B ∪ C) = (A ∩ B) ∪ (A ∩ C)',
        ],
        'A'
    ),


    $choice(
        's5-combo-10',
        5,
        'Operasi Bertingkat',
        'sulit',
        30,
        'A = {1,2,3}, B = {3,4}, C = {2,3,5}. Nilai (A ∪ B) ∩ C adalah ...',
        [
            'A' => '{2,3}',
            'B' => '{3,4}',
            'C' => '{1,2,3,4,5}',
            'D' => '{5}',
        ],
        'A'
    ),



    /*
    |--------------------------------------------------------------------------
    | SUBBAB 6
    | HIMPUNAN MASTER + RELASI DAN FUNGSI
    |--------------------------------------------------------------------------
    */


    $short(
        's6-application-01',
        6,
        'Himpunan Master: Survei',
        'sedang',
        20,
        'Dalam kelas 40 mahasiswa, 24 menyukai pemrograman, 18 menyukai matematika, dan 10 menyukai keduanya. Berapa yang menyukai minimal salah satu?',
        '32'
    ),


    $short(
        's6-application-02',
        6,
        'Himpunan Master: Tidak Memilih',
        'sulit',
        30,
        'Dari data 40 mahasiswa: 24 suka pemrograman, 18 suka matematika, dan 10 suka keduanya. Berapa mahasiswa yang tidak menyukai keduanya?',
        '8'
    ),


    $short(
        's6-cartesian-03',
        6,
        'Produk Kartesius',
        'mudah',
        10,
        'Jika A = {1,2} dan B = {a,b,c}, berapa banyak anggota A × B?',
        '6'
    ),


    $choice(
        's6-relation-04',
        6,
        'Relasi Detective',
        'mudah',
        10,
        'Relasi dari himpunan A ke himpunan B merupakan ...',
        [
            'A' => 'Subset dari A × B',
            'B' => 'Selalu sama dengan A × B',
            'C' => 'Himpunan kosong saja',
            'D' => 'Gabungan A dan B',
        ],
        'A'
    ),


    $choice(
        's6-domain-05',
        6,
        'Domain Hunter',
        'sedang',
        20,
        'Diketahui R = {(1,a),(2,b),(3,b)}. Domain dari R adalah ...',
        [
            'A' => '{a,b}',
            'B' => '{1,2,3}',
            'C' => '{a,b,c}',
            'D' => '{1,2,3,a,b}',
        ],
        'B'
    ),


    $choice(
        's6-range-06',
        6,
        'Range Hunter',
        'sedang',
        20,
        'Diketahui R = {(1,a),(2,b),(3,b)} dengan kodomain {a,b,c,d}. Range dari R adalah ...',
        [
            'A' => '{1,2,3}',
            'B' => '{a,b}',
            'C' => '{a,b,c,d}',
            'D' => '{c,d}',
        ],
        'B'
    ),


    $choice(
        's6-function-07',
        6,
        'Function Mission',
        'sedang',
        20,
        'Relasi f = {(1,a),(2,a),(3,b)} dari A = {1,2,3} ke B = {a,b} merupakan fungsi karena ...',
        [
            'A' => 'Setiap anggota A mempunyai tepat satu pasangan di B',
            'B' => 'Semua anggota B harus mempunyai pasangan berbeda',
            'C' => 'A dan B harus memiliki jumlah anggota yang sama',
            'D' => 'Setiap anggota A boleh mempunyai dua pasangan',
        ],
        'A'
    ),


    $choice(
        's6-notfunction-08',
        6,
        'Function or Not?',
        'sulit',
        30,
        'Manakah relasi dari A = {1,2} ke B = {a,b} yang BUKAN merupakan fungsi?',
        [
            'A' => '{(1,a),(2,b)}',
            'B' => '{(1,a),(2,a)}',
            'C' => '{(1,a),(1,b),(2,a)}',
            'D' => '{(1,b),(2,b)}',
        ],
        'C'
    ),


    $choice(
        's6-codomain-09',
        6,
        'Kodomain Check',
        'sedang',
        20,
        'Jika f: A → B, maka himpunan B disebut ...',
        [
            'A' => 'Domain',
            'B' => 'Kodomain',
            'C' => 'Range',
            'D' => 'Subset sejati',
        ],
        'B'
    ),


    $short(
        's6-comprehensive-10',
        6,
        'Final Daily Challenge',
        'sulit',
        30,
        'Sebuah kelas berisi 50 mahasiswa. Sebanyak 30 mengikuti komunitas pemrograman, 25 mengikuti komunitas desain, dan 12 mengikuti keduanya. Berapa mahasiswa yang mengikuti minimal satu komunitas?',
        '43'
    ),

];