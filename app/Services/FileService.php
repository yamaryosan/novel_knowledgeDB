<?php

namespace App\Services;
use Illuminate\Support\Facades\Storage;

class FileService
{
    // アップロード
    public function upload(string $path, $file)
    {
        // アップロード
        $path = Storage::putFile('public', $file);
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
