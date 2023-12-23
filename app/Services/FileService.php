<?php

declare(strict_types=1);

namespace App\Services;
use Illuminate\Support\Facades\Storage;

class FileService
{
    protected string $path = "";

    public function __construct(string $path)
    {
        $this->path = $path;
    }

    // アップロード
    public function upload(array $files)
    {
        foreach ($files as $file) {
            // ファイル名を取得
            $filename = $file->getClientOriginalName();

            // テキストファイルかどうかを判定
            if (!$this->isTextfile($file)) {
                return false;
            }

            // ファイルをアップロード
            Storage::putFileAs($this->path, $file, $filename);
            return true;
        }
    }

    // テキストファイルかどうかを判定
    public function isTextfile($file)
    {
        // ファイルの拡張子を取得
        $extension = $file->getClientOriginalExtension();

        // 拡張子がtxtでなければエラー
        if ($extension != 'txt') {
            return false;
        }

        return true;
    }

    // ファイルを読み込み、配列に格納
    public function read(): array
    {
        // ファイルを読み込み、配列に格納
        $trivia = [];
        foreach (Storage::files($this->path) as $file) {
            $fileWholeContent = Storage::get($file);
            $eachContent = $this->splitByNewline($fileWholeContent);
            // 項目ごとにタイトルと総論に分割
            foreach ($eachContent as $content) {
                $content = $this->splitByDoubleEllipsis($content);
                // タイトルと総論を取得
                $title = $content[0];
                $summary = 'EMPTY';
                $detail = $content[1];
                $trivia[] = ['title' => $title, 'summary' => $summary, 'detail' => $detail];
            }
        }
        // ファイルを削除
        $this->delete($file);

        return $trivia;
    }

    // ファイルを削除
    private function delete($file): void
    {
        Storage::delete($file);
    }

    // 改行コードでファイルの内容を分割
    private function splitByNewline(string $content): array
    {
        $content = explode("\r\n", $content);
        return $content;
    }

    // 3点リーダー2つで文字列を分割
    private function splitByDoubleEllipsis(string $content): array
    {
        $content = explode('……', $content);
        return $content;
    }
}
