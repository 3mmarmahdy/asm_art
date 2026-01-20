@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center p-4 relative overflow-hidden">
    
    <div class="absolute inset-0 bg-zinc-900">
        <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-5"></div>
        <div class="absolute -top-24 -right-24 w-96 h-96 bg-primary/20 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-24 -left-24 w-72 h-72 bg-blue-500/10 rounded-full blur-3xl"></div>
    </div>

    <div class="relative bg-zinc-800/80 backdrop-blur-xl p-8 rounded-3xl shadow-2xl w-full max-w-md border border-zinc-700/50">
        
        <div class="text-center mb-10">
            <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-zinc-900 border-2 border-primary mb-4 shadow-lg shadow-primary/20">
                <span class="material-symbols-outlined text-4xl text-primary">lock_person</span>
            </div>
            <h1 class="text-3xl font-black text-white tracking-tight">مرحباً بعودتك</h1>
            <p class="text-zinc-400 text-sm mt-2">سجل دخولك لإدارة متجرك</p>
        </div>

        <form action="{{ route('login.submit') }}" method="POST" class="space-y-6">
            @csrf
            
            <div class="group">
                <label class="block text-xs font-bold mb-2 text-primary">البريد الإلكتروني</label>
                <div class="relative">
                    <span class="absolute inset-y-0 right-4 flex items-center text-zinc-500 group-focus-within:text-white transition">
                        <span class="material-symbols-outlined text-[20px]">mail</span>
                    </span>
                    <input type="email" name="email" required 
                           class="w-full py-4 pr-12 pl-4 rounded-xl bg-zinc-900/50 border border-zinc-700 text-white placeholder-zinc-600 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition"
                           placeholder="admin@store.com">
                </div>
            </div>

            <div class="group">
                <label class="block text-xs font-bold mb-2 text-primary">كلمة المرور</label>
                <div class="relative">
                    <span class="absolute inset-y-0 right-4 flex items-center text-zinc-500 group-focus-within:text-white transition">
                        <span class="material-symbols-outlined text-[20px]">key</span>
                    </span>
                    <input type="password" name="password" required 
                           class="w-full py-4 pr-12 pl-4 rounded-xl bg-zinc-900/50 border border-zinc-700 text-white placeholder-zinc-600 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition"
                           placeholder="••••••••">
                </div>
            </div>

            <button type="submit" class="w-full bg-primary text-black py-4 rounded-xl font-black text-lg hover:bg-yellow-400 hover:scale-[1.02] transition duration-300 shadow-lg shadow-primary/25 mt-4">
                تسجيل الدخول
            </button>
            
            {{-- ========== الإضافة الجديدة: رابط إنشاء الحساب ========== --}}
            <div class="text-center mt-6 pt-6 border-t border-zinc-700/50">
                <p class="text-sm text-zinc-400">
                    ليس لديك حساب؟
                    <a href="{{ route('register') }}" class="text-primary font-bold hover:text-yellow-300 transition hover:underline">
                        أنشئ حساباً جديداً
                    </a>
                </p>
            </div>
            {{-- ================================================= --}}

            @if(session('error'))
                <p class="text-red-500 text-xs text-center font-bold mt-4 bg-red-500/10 py-2 rounded-lg border border-red-500/20">{{ session('error') }}</p>
            @endif
        </form>
    </div>
</div>
@endsection