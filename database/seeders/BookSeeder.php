<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BookSeeder extends Seeder
{
    public function run()
    {
        $now = Carbon::now();

        $books = [
            [
                'title' => 'Introduction to Algorithms',
                'description' => 'A comprehensive guide to algorithms and data structures.',
                'author' => 'Thomas H. Cormen',
                'category_id' => 1,
                'file_path' => 'books/algorithms.pdf',
                'uploaded_by' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        DB::table('books')->insert($books);
    }
}