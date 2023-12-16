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
            'created_at' => '2021-01-01 00:00:00',
            'updated_at' => '2021-01-01 00:00:00',
        ];
        DB::table('trivia')->insert($param);

        $param = [
            'title' => 'タイトル2',
            'summary' => '総論2',
            'detail' => '詳細2',
            'created_at' => '2021-01-02 00:00:00',
            'updated_at' => '2021-01-02 00:00:00',
        ];
        DB::table('trivia')->insert($param);
    }
}
