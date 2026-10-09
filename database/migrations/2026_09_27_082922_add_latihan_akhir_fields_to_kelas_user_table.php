<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migration.
     */
    public function up(): void
    {
        Schema::table('kelas_user', function (Blueprint $table) {

            /*
            |--------------------------------------------------------------------------
            | NILAI TERBAIK LATIHAN AKHIR
            |--------------------------------------------------------------------------
            |
            | Menyimpan nilai tertinggi yang pernah diperoleh mahasiswa.
            |
            | Contoh:
            | 75.00
            | 80.00
            | 95.00
            |
            */

            $table->decimal(
                'latihan_akhir_nilai_terbaik',
                5,
                2
            )
            ->nullable()
            ->after('xp');


            /*
            |--------------------------------------------------------------------------
            | STATUS LULUS LATIHAN AKHIR
            |--------------------------------------------------------------------------
            |
            | false = belum lulus
            | true  = sudah mendapatkan nilai minimal 80
            |
            */

            $table->boolean(
                'latihan_akhir_lulus'
            )
            ->default(false)
            ->after('latihan_akhir_nilai_terbaik');


            /*
            |--------------------------------------------------------------------------
            | TANGGAL PERTAMA KALI LULUS
            |--------------------------------------------------------------------------
            |
            | Digunakan untuk Badge HIMDAS Champion.
            |
            */

            $table->timestamp(
                'latihan_akhir_lulus_at'
            )
            ->nullable()
            ->after('latihan_akhir_lulus');

        });
    }


    /**
     * Rollback migration.
     */
    public function down(): void
    {
        Schema::table('kelas_user', function (Blueprint $table) {

            $table->dropColumn([
                'latihan_akhir_nilai_terbaik',
                'latihan_akhir_lulus',
                'latihan_akhir_lulus_at',
            ]);

        });
    }
};