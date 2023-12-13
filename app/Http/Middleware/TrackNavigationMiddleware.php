<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TrackNavigationMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 現在のルート名を取得
        $currentRoute = $request->path();

        // セッションにナビゲーション履歴があれば取得、なければ初期化
        if(!$request->session()->has('navigation_history')){
            session(['navigation_history' => []]);
        }

        // セッションにナビゲーション履歴を追加
        $history = session('navigation_history');
        $history[] = $currentRoute;

        // セッションにナビゲーション履歴を保存
        session(['navigation_history' => $history]);

        return $next($request);
    }
}