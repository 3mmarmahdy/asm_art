@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center p-4">
    <div class="max-w-md w-full bg-white dark:bg-zinc-800 rounded-3xl shadow-xl overflow-hidden border border-zinc-100 dark:border-zinc-700">
        
        {{-- رأس البطاقة --}}
        <div class="p-8 text-center bg-zinc-50 dark:bg-black/20">
            <h2 class="text-2xl font-black text-zinc-900 dark:text-white mb-2">إنشاء حساب جديد</h2>
            <p class="text-sm text-zinc-500">انضم إلينا واستمتع بتجربة تسوق فريدة</p>
        </div>

        {{-- نموذج التسجيل --}}
        <form action="{{ route('register.submit') }}" method="POST" class="p-8 space-y-5">
            @csrf

            {{-- الاسم --}}
            <div>
                <label class="block text-xs font-bold mb-2 text-zinc-500 dark:text-zinc-400">الاسم الكامل</label>
                <input type="text" name="name" value="{{ old('name') }}" required 
                       class="w-full p-3 rounded-xl bg-zinc-50 dark:bg-zinc-900 border-none focus:ring-2 focus:ring-primary text-zinc-900 dark:text-white transition"
                       placeholder="مثال: عمار صادق">
                @error('name') <span class="text-red-500 text-xs font-bold mt-1 block">{{ $message }}</span> @enderror
            </div>

            {{-- البريد الإلكتروني --}}
            <div>
                <label class="block text-xs font-bold mb-2 text-zinc-500 dark:text-zinc-400">البريد الإلكتروني</label>
                <input type="email" name="email" value="{{ old('email') }}" required 
                       class="w-full p-3 rounded-xl bg-zinc-50 dark:bg-zinc-900 border-none focus:ring-2 focus:ring-primary text-zinc-900 dark:text-white transition"
                       placeholder="name@example.com">
                @error('email') <span class="text-red-500 text-xs font-bold mt-1 block">{{ $message }}</span> @enderror
            </div>

            {{-- كلمة المرور --}}
            <div>
                <label class="block text-xs font-bold mb-2 text-zinc-500 dark:text-zinc-400">كلمة المرور</label>
                <input type="password" name="password" required 
                       class="w-full p-3 rounded-xl bg-zinc-50 dark:bg-zinc-900 border-none focus:ring-2 focus:ring-primary text-zinc-900 dark:text-white transition"
                       placeholder="******">
                @error('password') <span class="text-red-500 text-xs font-bold mt-1 block">{{ $message }}</span> @enderror
            </div>

            {{-- تأكيد كلمة المرور --}}
            <div>
                <label class="block text-xs font-bold mb-2 text-zinc-500 dark:text-zinc-400">تأكيد كلمة المرور</label>
                <input type="password" name="password_confirmation" required 
                       class="w-full p-3 rounded-xl bg-zinc-50 dark:bg-zinc-900 border-none focus:ring-2 focus:ring-primary text-zinc-900 dark:text-white transition"
                       placeholder="******">
            </div>

            {{-- زر التسجيل --}}
            <button type="submit" class="w-full bg-primary text-zinc-900 py-4 rounded-xl font-black hover:bg-yellow-400 transition shadow-lg shadow-primary/20">
                تسجيل حساب
            </button>

            {{-- رابط تسجيل الدخول --}}
            <div class="text-center mt-6">
                <span class="text-xs text-zinc-400">لديك حساب بالفعل؟</span>
                <a href="{{ route('login') }}" class="text-xs font-bold text-primary hover:underline">سجل دخولك الآن</a>
            </div>
        </form>
    </div>
</div>
@endsection