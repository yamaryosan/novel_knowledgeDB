<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckNavigationPattern
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 履歴チェック
        $history = $request->session()->get('navigation_history') ?: [];

        // 履歴が特定のパターンに一致するかチェック
        if($this->isValidPattern($history)) {
            // 一致したら自宅閲覧モードのランディングページに遷移
            return redirect()->route('s');
        }

        return $next($request);
    }

    // パターンに一致するかチェック
    // 一致する場合はtrueを返す
    protected function isValidPattern(array $history)
    {
        $pattern = ["index", "s"];
        if (count($history) < count($pattern)) {
            return false;
        }
        return $history === $pattern;
    }
}
