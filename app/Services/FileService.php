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
        }
        return true;
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
        $files = Storage::files($this->path);
        $trivia = [];
        foreach ($files as $file) {
            $wholeContent = Storage::get($file);
            if ($this->isOldTypeFile($wholeContent)) {
                $trivia[] = $this->readOldType($wholeContent);
            } else {
                $trivia[] = $this->readNewType($wholeContent);
            }
            // ファイルを削除
            $this->delete($file);
        }
        // 2次元配列の項目を1次元に変換
        $flattenTrivia = $this->flatten($trivia);
        return $flattenTrivia;
    }

    // ファイルを削除
    private function delete($file): void
    {
        Storage::delete($file);
    }

    // 旧タイプの項目のファイルかどうかを判定
    private function isOldTypeFile(string $content): bool
    {
        // 3点リーダーが含まれていれば旧タイプ
        if (gettype(strpos($content, '……')) === 'integer') {
            return true;
        }
        return false;
    }

    // 旧タイプの項目を読み込む
    private function readOldType(string $wholeContent): array
    {
        // 3点リーダーで文字列を分割
        $contentArray = $this->splitByNewline($wholeContent);
        $trivia = [];
        // 項目ごとに分割し、タイトルと詳細を取得
        foreach ($contentArray as $content){
            $trivium = $this->splitByDoubleEllipsis($content);
            $title = $trivium[0];
            $summary = 'EMPTY';
            $detail = $trivium[1];
            $trivia[] = ['title' => $title, 'summary' => $summary, 'detail' => $detail];
        }
        return $trivia;
    }

    // 新タイプの項目を読み込む
    private function readNewType(string $content): array
    {
        // 正規表現を使用して各セクションを抽出
        preg_match("/【タイトル】\n(.+)\n\n【総論】\n(.+)\n\n【本文】\n(.+)/", $content, $matches);
        $title = $matches[1];
        $summary = $matches[2];
        $detail = $matches[3];
        $trivia[] = ['title' => $title, 'summary' => $summary, 'detail' => $detail];
        return $trivia;
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

    // 2次元配列の項目を1次元に変換
    private function flatten(array $trivia): array
    {
        $trivia = array_merge(...$trivia);
        return $trivia;
    }
}
