<?php

declare(strict_types=1);

namespace App\Services;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Collection;
use App\Models\Trivium;

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

            // ファイルサイズを判定
            if (!$this->isProperSize($file)) {
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

    // 適切なサイズのファイルかどうかを判定
    public function isProperSize($file): bool
    {
        // ファイルサイズを取得
        $size = $file->getSize();

        // 20MB以上ならエラー
        if ($size >= 20000000) {
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
    public function delete($file): void
    {
        if (!Storage::exists($this->path . $file)) {
            dd('ファイルが存在しません', $this->path . $file);
        }
        Storage::delete($this->path . $file);
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
            $summary = '';
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

    // エクスポート
    public function export(Collection $trivia): string
    {
        // ファイル名を取得
        $filename = date('Ymd_Hi') . '.txt';
        // ファイルパスを取得
        $path = $this->path . $filename;

        // ファイルを作成
        Storage::put($path, '');

        // 項目をファイルに書き込み
        foreach ($trivia as $trivium) {
        // ファイルを開く
            $file = Storage::append($path, '');
            // 項目を書き込み
            Storage::append($path, '【タイトル】'.$trivium->title.'');
            Storage::append($path, '【総論】'.$trivium->summary.'');
            Storage::append($path, '【本文】'.$trivium->detail.'');
        }
        return $filename;
    }

    // エクスポートされたファイル一覧を取得
    public function getFiles(): array
    {
        // ファイル一覧を取得
        $files = Storage::files($this->path);
        if (empty($files)) {
            return [];
        }
        // ファイル名、アップロード日時、項目数を取得
        foreach ($files as $file) {
            $filename = basename($file);
            $uploaded_at = date('Y-m-d H:i:s', Storage::lastModified($file));
            $article_count = $this->article_count($file);
            $fileArray[] = ['filename' => $filename, 'uploaded_at' => $uploaded_at, 'article_count' => $article_count];
        }
        return $fileArray;
    }

    // 項目数を取得
    public function article_count($file): int
    {
        $article = Storage::get($file);
        $article = explode('【タイトル】', $article);
        $count = count($article) - 1;
        return $count;
    }
}
