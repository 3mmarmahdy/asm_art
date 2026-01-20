@extends('layouts.app')

@section('content')
<div class="p-4 max-w-lg mx-auto w-full mt-6">
    
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-xl font-bold flex items-center gap-2 text-zinc-900 dark:text-white">
            <span class="material-symbols-outlined text-primary">add_circle</span>
            إضافة منتج جديد
        </h2>
        <a href="{{ route('products.index') }}" class="text-xs font-bold text-zinc-400 hover:text-zinc-900 dark:hover:text-white transition">إلغاء</a>
    </div>

    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="flex flex-col gap-5 bg-white dark:bg-zinc-800 p-6 rounded-2xl shadow-sm border border-zinc-100 dark:border-zinc-700">
        @csrf

        <div>
            <label class="block text-xs font-bold mb-2 text-zinc-500 dark:text-zinc-400">اسم المنتج</label>
            <input type="text" name="name" required class="w-full p-3 rounded-xl bg-zinc-50 dark:bg-zinc-900 border-none focus:ring-2 focus:ring-primary text-zinc-900 dark:text-white transition">
        </div>

        <div>
            <label class="block text-xs font-bold mb-2 text-zinc-500 dark:text-zinc-400">القسم</label>
            <select name="category_id" required class="w-full p-3 rounded-xl bg-zinc-50 dark:bg-zinc-900 border-none focus:ring-2 focus:ring-primary text-zinc-900 dark:text-white transition">
                <option value="" disabled selected>-- اختر القسم --</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="flex gap-4">
            <div class="flex-1">
                <label class="block text-xs font-bold mb-2 text-zinc-500 dark:text-zinc-400">السعر</label>
                <input type="number" name="price" required class="w-full p-3 rounded-xl bg-zinc-50 dark:bg-zinc-900 border-none focus:ring-2 focus:ring-primary text-zinc-900 dark:text-white transition">
            </div>
            <div class="flex-1">
                <label class="block text-xs font-bold mb-2 text-zinc-500 dark:text-zinc-400">الكمية</label>
                <input type="number" name="quantity" value="1" required class="w-full p-3 rounded-xl bg-zinc-50 dark:bg-zinc-900 border-none focus:ring-2 focus:ring-primary text-zinc-900 dark:text-white transition">
            </div>
        </div>

        <div>
            <label class="block text-xs font-bold mb-2 text-zinc-500 dark:text-zinc-400">الوصف</label>
            <textarea name="description" rows="3" class="w-full p-3 rounded-xl bg-zinc-50 dark:bg-zinc-900 border-none focus:ring-2 focus:ring-primary text-zinc-900 dark:text-white transition resize-none"></textarea>
        </div>

        <div>
            <label class="block text-xs font-bold mb-2 text-zinc-500 dark:text-zinc-400">صورة المنتج</label>
            <div class="relative">
                <input type="file" name="image" required accept="image/*" class="w-full p-2 rounded-xl bg-zinc-50 dark:bg-zinc-900 text-zinc-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-bold file:bg-zinc-200 dark:file:bg-zinc-700 file:text-zinc-700 dark:file:text-white hover:file:bg-primary transition">
            </div>
        </div>

        <button type="submit" class="mt-2 w-full bg-zinc-900 dark:bg-white text-white dark:text-black py-4 rounded-xl font-bold hover:bg-primary dark:hover:bg-primary transition shadow-lg flex justify-center items-center gap-2">
            <span class="material-symbols-outlined text-lg">save</span>
            حفظ المنتج
        </button>
    </form>
</div>
@endsection