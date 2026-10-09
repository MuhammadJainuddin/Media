<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            [
                'email' =>
                    'admin@himdas.test'
            ],
            [
                'name' =>
                    'Administrator HIMDAS',

                'password' =>
                    'password123',

                'role' =>
                    'admin',
            ]
        );


        User::updateOrCreate(
            [
                'email' =>
                    'dosen@himdas.test'
            ],
            [
                'name' =>
                    'Dosen HIMDAS',

                'password' =>
                    'password123',

                'role' =>
                    'dosen',
            ]
        );
    }
}