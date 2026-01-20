<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Cart; // لا تنسَ إضافة هذا السطر لنستطيع التعامل مع السلة
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    // ==========================
    //  قسم تسجيل الدخول
    // ==========================
    public function showLogin() {
        return view('auth.login');
    }

    public function login(Request $request) {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // حفظ رقم الجلسة القديم قبل أن يتغير عند تسجيل الدخول
        $oldSessionId = Session::getId();

        if (Auth::attempt($credentials)) {
            
            // ✨ اللمسة السحرية: نقل سلة الزائر إلى المستخدم المسجل ✨
            // نبحث عن أي منتجات في السلة برقم الجلسة القديم، ونحدثها لتصبح برقم المستخدم
            Cart::where('session_id', $oldSessionId)->update(['user_id' => Auth::id()]);

            $request->session()->regenerate();
            
            if (Auth::user()->is_admin) {
                return redirect()->route('admin.orders'); 
            }
            return redirect()->route('products.index');
        }

        return back()->with('error', 'البيانات غير صحيحة، حاول مجدداً 🚫');
    }

    // ==========================
    //  قسم إنشاء حساب جديد
    // ==========================
    
    public function showRegister() {
        return view('auth.register');
    }

    public function register(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // حفظ الجلسة القديمة لنقل السلة
        $oldSessionId = Session::getId();

        Auth::login($user);

        // ✨ نقل السلة أيضاً عند التسجيل الجديد ✨
        Cart::where('session_id', $oldSessionId)->update(['user_id' => $user->id]);

        return redirect()->route('products.index')->with('success', 'تم إنشاء الحساب بنجاح! أهلاً بك 🎉');
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}