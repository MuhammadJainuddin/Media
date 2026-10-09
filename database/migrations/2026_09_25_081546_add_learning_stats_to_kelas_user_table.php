<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('kelas_user', function (Blueprint $table) {

            $table->unsignedInteger('xp')
                ->default(0);

            $table->unsignedInteger('subbab_selesai')
                ->default(0);

            $table->unsignedInteger('total_subbab')
                ->default(6);

            $table->decimal(
                'progress_percent',
                5,
                2
            )->default(0);

            $table->timestamp('last_activity_at')
                ->nullable();

        });
    }

    public function down(): void
    {
        Schema::table('kelas_user', function (Blueprint $table) {

            $table->dropColumn([
                'xp',
                'subbab_selesai',
                'total_subbab',
                'progress_percent',
                'last_activity_at',
            ]);

        });
    }
};