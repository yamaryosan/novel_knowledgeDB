<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckNavigationPattern
{
    // 自宅閲覧モードに遷移できる特定のパターン
    const ROUTE_PATTERN = ["recommend", "recommend", "form"];

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
            return redirect()->route('home');
        }

        return $next($request);
    }

    // 履歴の最後が特定のパターンに一致するかチェック
    protected function isValidPattern(array $history)
    {
        $pattern = self::ROUTE_PATTERN;
        if (count($history) < count($pattern)) {
            return false;
        }
        return array_slice($history, -count($pattern)) === $pattern;
    }
}
