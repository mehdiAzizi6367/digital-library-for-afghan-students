<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    public function run()
    {
        $now = Carbon::now();

        DB::table('users')->insert([
            [
                'name' => 'samiullah',
                'email' => 'samiaziziazizi6367@gmail.com',
                'password' => Hash::make('samiullah'),
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'ahmad',
                'email' => 'ahmadaziziazizi6367@example.com',
                'password' => Hash::make('ahmadazizi'),
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'ohammad',
                'email' => 'mohammad@example.com',
                'password' => Hash::make('mohammad'),
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'samim',
                'email' => 'samim@example.com',
                'password' => Hash::make('samimazizi'),
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }
}