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
    protected $token;
    /**
     * Create a new job instance.
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Cache::add('progress', 0, 1800);
        // ファイル名を取得
        $filename = date('YmdHis') . '.txt';
        // ファイルパスを取得
        $path = 'public/export/' . $filename;
        // ファイルに書き込む
        $trivia = Trivium::all();
        $total = count($trivia);
        $count = 0;

        if (count($trivia) === 0) {
            Cache::forget("exporting:{$this->token}");
        }

        $all_sentence = '';
        foreach ($trivia as $trivium) {
            $all_sentence = '【タイトル】' . $trivium->title . PHP_EOL . '【総論】' . $trivium->summary . PHP_EOL . '【本文】' . $trivium->detail . PHP_EOL;
            Storage::append($path, '【タイトル】' . $all_sentence);
            $count++;
            // 進捗を表示
            $progress = round($count / $total * 100);
            Cache::put('progress', $progress, 1800);
        }
        // ジョブが完了したらトークンをキャッシュから削除
        Cache::forget("exporting:{$this->token}");
    }
}
