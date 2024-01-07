<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class TestTempTriviaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('test_temp_trivia')->insert([
            'title' => 'test_title',
            'summary' => 'test_summary',
            'detail' => 'test_detail',
            'created_at' => '2024-01-07 14:19:08',
            'updated_at' => '2024-01-07 14:19:08',
        ]);
    }
}
