<?php

declare(strict_types=1);

namespace App\Services;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Collection;
use App\Models\Trivium;

class FileService
{
    protected string $dir_path = "";

    public function __construct(string $dir_path)
    {
        $this->dir_path = $dir_path;
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
            Storage::putFileAs($this->dir_path, $file, $filename);
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
        $files = Storage::files($this->dir_path);
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
        $file = $this->dir_path . $file;
        if (!Storage::exists($file)) {
            dd('ファイルが存在しません', $file);
        }
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
    private function readOldType(string $content): array
    {
        $trivia = [];
        // 正規表現を使用して三点リーダーと改行でタイトルと本文を分割
        $pattern = '/(.*?)……(.*?)(?=(\n|\r\n|\r)|$)/s';
        preg_match_all($pattern, $content, $matches);
        // 項目ごとに分割
        foreach ($matches[0] as $unit_content) {
            // タイトルの文字列を取得
            preg_match('/(.*?)……/s', $unit_content, $match);
            $title = $match[1];
            $title = $this->removeNewline($title);
            // 本文の文字列を取得
            preg_match('/……(.*)/s', $unit_content, $match);
            $detail = $match[1];
            $trivia[] = ['title' => $title, 'summary' => '', 'detail' => $detail];
        }
        return $trivia;
    }

    // 新タイプの項目を読み込む
    private function readNewType(string $content): array
    {
        $trivia = [];
        // 正規表現を使用して各セクションを抽出し、配列に格納
        $pattern = '/(【タイトル】.*?【総論】.*?【本文】.*?)(?=【タイトル】|$)/s';
        preg_match_all($pattern, $content, $matches);
        // 項目ごとに分割
        foreach ($matches[0] as $unit_content) {
            // タイトルの文字列を取得
            preg_match('/【タイトル】(.*?)【総論】/s', $unit_content, $match);
            $title = $match[1];
            $title = $this->removeNewline($title);
            // 総論の文字列を取得
            preg_match('/【総論】(.*?)【本文】/s', $unit_content, $match);
            $summary = $match[1];
            // 本文の文字列を取得
            preg_match('/【本文】(.*)/s', $unit_content, $match);
            $detail = $match[1];
            $trivia[] = ['title' => $title, 'summary' => $summary, 'detail' => $detail];
        }
        return $trivia;
    }

    // 改行コードを文字列から削除
    private function removeNewline(string $content): string
    {
        $no_new_line_content = preg_replace("/\n|\r\n|\r/", '', $content);
        return $no_new_line_content;
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
        $filePath = $this->dir_path . $filename;

        // ファイルを作成
        Storage::put($filePath, '');

        // 項目をファイルに書き込み
        foreach ($trivia as $trivium) {
        // ファイルを開く
            $file = Storage::append($filePath, '');
            // 項目を書き込み
            Storage::append($filePath, '【タイトル】'.$trivium->title.'');
            Storage::append($filePath, '【総論】'.$trivium->summary.'');
            Storage::append($filePath, '【本文】'.$trivium->detail.'');
        }
        return $filename;
    }

    // エクスポートされたファイル一覧を取得
    public function getFiles(): array
    {
        // ファイル一覧を取得
        $files = Storage::files($this->dir_path);
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
