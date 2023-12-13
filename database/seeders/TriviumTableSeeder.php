<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class TriviumTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $param = [
            'title' => 'タイトル1',
            'summary' => '総論1',
            'detail' => '詳細1',
        ];
        DB::table('trivia')->insert($param);

        $param = [
            'title' => 'タイトル2',
            'summary' => '総論2',
            'detail' => '詳細2',
        ];
        DB::table('trivia')->insert($param);
    }
}
