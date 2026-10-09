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
        Schema::create('challenge_attempts', function (Blueprint $table) {

            $table->id();

            /*
            |--------------------------------------------------------------------------
            | USER
            |--------------------------------------------------------------------------
            */

            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();


            /*
            |--------------------------------------------------------------------------
            | KELAS
            |--------------------------------------------------------------------------
            */

            $table->foreignId('kelas_id')
                ->constrained('kelas')
                ->cascadeOnDelete();


            /*
            |--------------------------------------------------------------------------
            | TANGGAL CHALLENGE
            |--------------------------------------------------------------------------
            */

            $table->date('challenge_date');


            /*
            |--------------------------------------------------------------------------
            | ID / KEY CHALLENGE
            |--------------------------------------------------------------------------
            |
            | Contoh:
            | s1-detektif-01
            | s5-demorgan-06
            | __daily_bonus__
            |
            */

            $table->string(
                'challenge_key',
                100
            );


            /*
            |--------------------------------------------------------------------------
            | JAWABAN MAHASISWA
            |--------------------------------------------------------------------------
            */

            $table->string(
                'selected_answer',
                255
            )
            ->nullable();


            /*
            |--------------------------------------------------------------------------
            | STATUS BENAR / SALAH
            |--------------------------------------------------------------------------
            */

            $table->boolean(
                'is_correct'
            )
            ->default(false);


            /*
            |--------------------------------------------------------------------------
            | XP YANG DIDAPAT
            |--------------------------------------------------------------------------
            */

            $table->unsignedInteger(
                'xp_earned'
            )
            ->default(0);


            /*
            |--------------------------------------------------------------------------
            | WAKTU MENJAWAB
            |--------------------------------------------------------------------------
            */

            $table->timestamp(
                'answered_at'
            )
            ->nullable();


            /*
            |--------------------------------------------------------------------------
            | CREATED_AT & UPDATED_AT
            |--------------------------------------------------------------------------
            */

            $table->timestamps();


            /*
            |--------------------------------------------------------------------------
            | CEGAH CHALLENGE YANG SAMA DIJAWAB DUA KALI
            |--------------------------------------------------------------------------
            |
            | User yang sama
            | Kelas yang sama
            | Tanggal yang sama
            | Challenge yang sama
            |
            */

            $table->unique(
                [
                    'user_id',
                    'kelas_id',
                    'challenge_date',
                    'challenge_key',
                ],
                'challenge_attempt_unique'
            );


            /*
            |--------------------------------------------------------------------------
            | INDEX UNTUK MEMPERCEPAT QUERY HARIAN
            |--------------------------------------------------------------------------
            */

            $table->index(
                [
                    'user_id',
                    'kelas_id',
                    'challenge_date',
                ],
                'challenge_attempt_daily_index'
            );

        });
    }


    /**
     * Rollback migration.
     */
    public function down(): void
    {
        Schema::dropIfExists(
            'challenge_attempts'
        );
    }
};