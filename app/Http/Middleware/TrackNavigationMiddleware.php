<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TrackNavigationMiddleware
{
    // ナビゲーション履歴の最大数
    const MAX_HISTORY = 10;

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 現在のルート名を取得
        $currentRoute = $request->path();

        // セッションを定義
        $session = $request->session();

        // セッションにナビゲーション履歴があれば取得、なければ初期化
        if(!$session->get('navigation_history')){
            $session->put('navigation_history', []);
        }

        // ナビゲーション履歴に現在のルート名を追加
        $history = $session->get('navigation_history');
        $history[] = $currentRoute;

        // 履歴が一定以上あれば古いものから削除
        if(count($history) > self::MAX_HISTORY){
            array_shift($history);
        }

        // セッションにナビゲーション履歴を保存
        $session->put('navigation_history', $history);

        return $next($request);
    }
}
