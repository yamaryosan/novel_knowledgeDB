<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class DummyArticleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = File::get("database/data/dummy_articles.json");
        $data = json_decode($json);

        foreach ($data as $obj) {
            DB::table('dummy_articles')->insert([
                'title' => $obj->title,
                'summary' => $obj->summary,
                'detail' => $obj->detail,
                'created_at' => $obj->created_at,
                'updated_at' => $obj->updated_at,
            ]);
        }
    }
}
