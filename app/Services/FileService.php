<?php

declare(strict_types=1);

namespace App\Services;
use Illuminate\Support\Facades\Storage;

class FileService
{
    // アップロード
    public function upload(string $path, array $files)
    {
        foreach ($files as $file) {
            // ファイル名を取得
            $filename = $file->getClientOriginalName();

            // テキストファイルかどうかを判定
            if (!$this->isTextfile($file)) {
                return false;
            }

            // ファイルをアップロード
            Storage::putFileAs($path, $file, $filename);
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
    public function read($file)
    {
        // ファイルを読み込み、配列に格納
        $trivia = file($file);

        // 配列の要素の末尾に改行コードが含まれている場合、削除
        foreach ($trivia as $key => $value) {
            $trivia[$key] = rtrim($value, "\r\n");
        }

        return $trivia;
    }
}
