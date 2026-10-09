<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $table = 'kelas';

    protected $fillable = [
        'created_by',
        'nama_kelas',
        'kode_kelas',
        'deskripsi',
    ];


    public function pembuat()
    {
        return $this->belongsTo(
            User::class,
            'created_by'
        );
    }


    public function mahasiswa()
    {
        return $this
            ->belongsToMany(
                User::class,
                'kelas_user'
            )
            ->withPivot([
                'xp',

                'latihan_akhir_nilai_terbaik',
                'latihan_akhir_lulus',
                'latihan_akhir_lulus_at',

                'subbab_selesai',
                'total_subbab',
                'progress_percent',
                'last_activity_at',
            ])
            ->withTimestamps();
    }
}