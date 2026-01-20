<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdminAuth
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // التحقق: هل المستخدم مسجل دخول؟ وهل دوره 'admin'؟
        if (Auth::check() && Auth::user()->role == 'admin') {
            return $next($request);
        }

        // إذا لم يكن مديراً، نوجهه للصفحة الرئيسية مع رسالة خطأ
        return redirect('/')->with('error', 'عذراً، هذه الصفحة للمدراء فقط.');
    }
}