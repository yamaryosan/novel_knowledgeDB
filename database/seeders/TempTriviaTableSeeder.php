<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class TempTriviaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $param = [
            'title' => '一時タイトル1',
            'summary' => '一時総論1',
            'detail' => '一時詳細1',
            'created_at' => '2021-01-01 00:00:00',
            'updated_at' => '2021-01-01 00:00:00',
        ];
        DB::table('temp_trivia')->insert($param);

        $param = [
            'title' => '一時タイトル2',
            'summary' => '一時総論2',
            'detail' => '一時詳細2',
            'created_at' => '2021-01-01 00:00:00',
            'updated_at' => '2021-01-01 00:00:00',
        ];
        DB::table('temp_trivia')->insert($param);
    }
}
