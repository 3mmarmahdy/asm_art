<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // إذا كان المستخدم مسجل دخول + ونوع حسابه مدير (1)
        if (auth()->check() && auth()->user()->is_admin) {
            return $next($request); // تفضل بالدخول
        }

        // غير ذلك.. ارجع للصفحة الرئيسية مع رسالة طرد
        return redirect('/')->with('error', 'غير مصرح لك بدخول هذه المنطقة!');
    }
}