<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\IsAdmin;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

/*
|--------------------------------------------------------------------------
| 1. روابط المصادقة
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');

/*
|--------------------------------------------------------------------------
| 2. روابط العميل العامة
|--------------------------------------------------------------------------
*/
Route::get('/', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/search', [ProductController::class, 'search'])->name('products.search');

// السلة
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{id}', [CartController::class, 'addToCart'])->name('cart.add');
Route::delete('/cart/{id}', [CartController::class, 'destroy'])->name('cart.destroy');

// الدفع
Route::get('/checkout', [OrderController::class, 'index'])->name('checkout.index');
Route::post('/checkout', [OrderController::class, 'store'])->name('checkout.store');


/*
|--------------------------------------------------------------------------
| 3. روابط المدير (المحمية)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', IsAdmin::class])->group(function () {
    
    // إدارة المنتجات
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');

    // إدارة الطلبات (تم التصحيح هنا لاستخدام الدالة الجديدة adminIndex)
    Route::get('/admin/orders', [OrderController::class, 'adminIndex'])->name('admin.orders');
    Route::get('/admin/orders/{id}', [OrderController::class, 'show'])->name('admin.orders.show');
});

/*
|--------------------------------------------------------------------------
| 4. عرض المنتج
|--------------------------------------------------------------------------
*/
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');


Route::get('/setup-users', function () {
    try {
        // 1. إنشاء حساب المدير
        $admin = User::updateOrCreate(
            ['email' => 'admin@asm-store.com'],
            [
                'name'     => 'Admin Manager',
                'password' => Hash::make('password123'),
                'role'     => 'admin', // افترضنا أن اسم العمود role
            ]
        );

        // 2. إنشاء حساب مستخدم عادي (زبون)
        $user = User::updateOrCreate(
            ['email' => 'user@asm-store.com'],
            [
                'name'     => 'Normal Customer',
                'password' => Hash::make('password123'),
                'role'     => 'user', // صلاحية مستخدم عادي
            ]
        );

        return "<h1>تمت العملية بنجاح! ✅</h1>
                <p><strong>المدير:</strong> admin@asm-store.com <br> <strong>كلمة المرور:</strong> password123</p>
                <hr>
                <p><strong>المستخدم:</strong> user@asm-store.com <br> <strong>كلمة المرور:</strong> password123</p>";

    } catch (\Exception $e) {
        return "حدث خطأ: " . $e->getMessage();
    }
});