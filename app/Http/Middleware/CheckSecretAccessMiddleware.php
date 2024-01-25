<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckSecretAccessMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // セッションに職場閲覧モードアクセス用フラグがなければ、トップページにリダイレクト
        if(!session('access_granted'))
        {
            return redirect()->route('top');
        }
        return $next($request);
    }
}
