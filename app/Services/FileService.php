<?php

declare(strict_types=1);

namespace App\Services;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Collection;
use App\Models\Trivium;
use App\Models\DummyArticle;

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
        // ダミー記事のファイルは除外
        $files = array_filter($files, function ($file) {
            return !preg_match('/DUMMY_ARTICLE.txt/', $file);
        });
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

    // ダミー記事に関するファイルを読み込み、配列に格納
    public function readDummyArticle(): array
    {
        // ファイルを読み込み、配列に格納
        $dummy_article_file_name = "DUMMY_ARTICLE.txt";
        $files = Storage::files($this->dir_path);

        // ダミー記事のファイルがなければエラー
        if (!in_array($this->dir_path . $dummy_article_file_name, $files)) {
            dd('ダミー記事のファイルがありません');
        }

        $dummy_article_file = Storage::get($this->dir_path . $dummy_article_file_name);

        // ダミー記事のファイルを削除
        $this->delete($this->dir_path . $dummy_article_file_name);

        // ダミー記事を読み込み、配列に格納
        $dummy_article = $this->readNewType($dummy_article_file);

        return $dummy_article;
    }

    // ダミー記事のファイルかどうかを判定
    public function isDummyArticleFile($file): bool
    {
        // ファイルの拡張子を取得
        $extension = $file->getClientOriginalExtension();

        // 拡張子がtxtでなければエラー
        if ($extension != 'txt') {
            return false;
        }

        // ファイル名を取得
        $filename = $file->getClientOriginalName();

        // ファイル名がDUMMY_ARTICLE.txtでなければエラー
        if ($filename != 'DUMMY_ARTICLE.txt') {
            return false;
        }

        return true;
    }

    // ファイルを削除
    public function delete($file): void
    {
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
