<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Badge extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'icon',
        'description',
    ];

    public function users()
    {
        return $this->belongsToMany(
            User::class,
            'badge_user'
        )
        ->withPivot([
            'kelas_id',
            'earned_at',
        ])
        ->withTimestamps();
    }
}