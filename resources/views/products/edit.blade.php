@extends('layouts.app')

@section('content')
<div class="p-4 max-w-lg mx-auto w-full mt-6">
    
    {{-- عرض رسائل الأخطاء لمعرفة السبب في حال الفشل مستقبلاً --}}
    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="flex items-center justify-between mb-6">
        <h2 class="text-xl font-bold flex items-center gap-2 text-zinc-900 dark:text-white">
            <span class="material-symbols-outlined text-primary">edit_square</span>
            تعديل المنتج
        </h2>
        <a href="{{ route('products.index') }}" class="text-xs font-bold text-zinc-400 hover:text-zinc-900 dark:hover:text-white transition">إلغاء</a>
    </div>

    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="flex flex-col gap-5 bg-white dark:bg-zinc-800 p-6 rounded-2xl shadow-sm border border-zinc-100 dark:border-zinc-700">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-xs font-bold mb-2 text-zinc-500 dark:text-zinc-400">اسم المنتج</label>
            <input type="text" name="name" value="{{ old('name', $product->name) }}" required class="w-full p-3 rounded-xl bg-zinc-50 dark:bg-zinc-900 border-none focus:ring-2 focus:ring-primary text-zinc-900 dark:text-white transition">
        </div>

        {{-- 🟢 هنا تمت إضافة اختيار القسم الذي كان ناقصاً --}}
        <div>
            <label class="block text-xs font-bold mb-2 text-zinc-500 dark:text-zinc-400">القسم</label>
            <select name="category_id" required class="w-full p-3 rounded-xl bg-zinc-50 dark:bg-zinc-900 border-none focus:ring-2 focus:ring-primary text-zinc-900 dark:text-white transition">
                <option value="" disabled>اختر القسم</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="flex gap-4">
            <div class="flex-1">
                <label class="block text-xs font-bold mb-2 text-zinc-500 dark:text-zinc-400">السعر</label>
                <input type="number" name="price" value="{{ old('price', $product->price) }}" required class="w-full p-3 rounded-xl bg-zinc-50 dark:bg-zinc-900 border-none focus:ring-2 focus:ring-primary text-zinc-900 dark:text-white transition">
            </div>
            <div class="flex-1">
                <label class="block text-xs font-bold mb-2 text-zinc-500 dark:text-zinc-400">الكمية</label>
                <input type="number" name="quantity" value="{{ old('quantity', $product->quantity) }}" required class="w-full p-3 rounded-xl bg-zinc-50 dark:bg-zinc-900 border-none focus:ring-2 focus:ring-primary text-zinc-900 dark:text-white transition">
            </div>
        </div>

        <div>
            <label class="block text-xs font-bold mb-2 text-zinc-500 dark:text-zinc-400">الوصف</label>
            <textarea name="description" rows="3" class="w-full p-3 rounded-xl bg-zinc-50 dark:bg-zinc-900 border-none focus:ring-2 focus:ring-primary text-zinc-900 dark:text-white transition resize-none">{{ old('description', $product->description) }}</textarea>
        </div>

        <div class="flex items-center gap-4 bg-zinc-50 dark:bg-zinc-900 p-3 rounded-xl border border-dashed border-zinc-300 dark:border-zinc-700">
            @if($product->image)
                <img src="{{ asset($product->image) }}" class="w-16 h-16 rounded-lg object-cover bg-white" alt="current">
            @endif
            <div class="flex-1">
                <label class="block text-xs font-bold mb-1 text-zinc-500 dark:text-zinc-400">تغيير الصورة</label>
                <input type="file" name="image" accept="image/*" class="w-full text-xs text-zinc-500 file:mr-2 file:py-1 file:px-3 file:rounded-full file:border-0 file:text-xs file:font-bold file:bg-zinc-200 dark:file:bg-zinc-700 file:text-zinc-700 dark:file:text-white hover:file:bg-primary transition">
            </div>
        </div>

        <button type="submit" class="mt-2 w-full bg-zinc-900 dark:bg-white text-white dark:text-black py-4 rounded-xl font-bold hover:bg-primary dark:hover:bg-primary transition shadow-lg">
            حفظ التعديلات
        </button>
    </form>
</div>
@endsection