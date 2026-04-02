<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $now = Carbon::now();

        DB::table('categories')->insert([
            ['name' => 'Computer Science', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Engineering', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Medicine', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Economics', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Literature', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Islamic Studies', 'created_at' => $now, 'updated_at' => $now],
        ]);
    }
}