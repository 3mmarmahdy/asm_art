<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
{
    // إنشاء حساب المدير
    \App\Models\User::factory()->create([
        'name' => 'Admin Ammar',
        'email' => 'admin@store.com', // إيميل المدير
        'password' => bcrypt('123456'), // كلمة المرور (مشفرة)
        'is_admin' => true, // سنميز المدير بهذا الحقل
    ]);
}
}
