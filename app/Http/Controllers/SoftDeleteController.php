<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Trivium;
use App\Models\TempTrivium;
use App\Models\SoftDeleteTrivium;

class SoftDeleteController extends Controller
{
    public function index()
    {
        $softDeleteTrivia = SoftDeleteTrivium::all();
        $previousPageUrl = route('home');
        return view('soft_delete.index', compact('softDeleteTrivia', 'previousPageUrl'));
    }

    // 復元のためのプレビュー
    public function preview(int $id)
    {
        $softDeleteTrivium = SoftDeleteTrivium::findOrFail($id);
        $previousPageUrl = route('soft_delete_index');

        $id = $softDeleteTrivium->id;
        $title = $softDeleteTrivium->title ?? '';
        $summary = $softDeleteTrivium->summary ?? '';
        $detail = $softDeleteTrivium->detail ?? '';
        $previousPageUrl = route('soft_delete_index');
        return view('soft_delete.preview', compact('id', 'title', 'summary', 'detail', 'previousPageUrl'));
    }

    // 復元
    public function restore(int $id)
    {
        // 論理削除用DBのレコードを削除
        $softDeleteTrivium = SoftDeleteTrivium::findOrFail($id);
        $softDeleteTrivium->delete();

        // DBのレコードを復元
        $tempTrivium = new TempTrivium();
        $tempTrivium->title = $softDeleteTrivium->title;
        $tempTrivium->summary = $softDeleteTrivium->summary;
        $tempTrivium->detail = $softDeleteTrivium->detail;
        $tempTrivium->created_at = $softDeleteTrivium->created_at;
        $tempTrivium->updated_at = $softDeleteTrivium->updated_at;
        $tempTrivium->save();

        // トップページにリダイレクト
        $msg = "「{$tempTrivium->title}」を復元完了";
        return redirect()->route('home')->with('flash_succeed_message', $msg);
    }

    // 論理削除
    public function soft_delete(int $id)
    {
        // 論理削除用DBのレコードを作成
        $tempTrivium = Trivium::findOrFail($id);
        $softDeleteTrivium = new SoftDeleteTrivium();
        $softDeleteTrivium->title = $tempTrivium->title;
        $softDeleteTrivium->summary = $tempTrivium->summary;
        $softDeleteTrivium->detail = $tempTrivium->detail;
        $softDeleteTrivium->created_at = $tempTrivium->created_at;
        $softDeleteTrivium->updated_at = $tempTrivium->updated_at;
        $softDeleteTrivium->save();

        // DBのレコードを削除
        $tempTrivium = Trivium::findOrFail($id);
        $msg = "「{$tempTrivium->title}」を一時削除しました";
        $tempTrivium->delete();

        // トップページにリダイレクト
        return redirect()->route('home')->with('flash_succeed_message', $msg);
    }

    // 削除
    public function delete(int $id)
    {
        // DBのレコードを削除
        $softDeleteTrivium = SoftDeleteTrivium::findOrFail($id);
        $msg = "「{$softDeleteTrivium->title}」を一時削除完了";
        $softDeleteTrivium->delete();

        // トップページにリダイレクト
        return redirect()->route('home')->with('flash_succeed_message', $msg);
    }
}
