<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use App\Models\Trivium;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;

class WriteTriviaToFileJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $timeout = 1800;
    /**
     * Create a new job instance.
     */
    public function __construct()
    {
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // ファイル名を取得
        $filename = date('YmdHis') . '.txt';
        // ファイルパスを取得
        $path = 'public/export/' . $filename;
        // ファイルに書き込む
        $trivia = Trivium::all();
        $total = count($trivia);
        $count = 0;

        foreach ($trivia as $trivium) {
            Storage::append($path, '【タイトル】' . $trivium->title);
            Storage::append($path, '【総論】' . $trivium->summary);
            Storage::append($path, '【本文】' . $trivium->detail);
            $count++;
            // 進捗を表示
            $progress = round($count / $total * 100);
            Cache::put('progress', $progress, 1800);
        }
    }
}
