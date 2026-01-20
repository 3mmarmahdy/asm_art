@extends('layouts.app')

@section('content')

{{-- كود التنسيق الخاص بالطباعة (يخفي القوائم ويظهر الفاتورة فقط) --}}
<style>
    @media print {
        body * {
            visibility: hidden; /* إخفاء كل شيء في الصفحة */
        }
        #printable-area, #printable-area * {
            visibility: visible; /* إظهار الفاتورة فقط */
        }
        #printable-area {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
        }
        /* إخفاء الأزرار العلوية عند الطباعة */
        .no-print {
            display: none !important;
        }
    }
</style>

<div class="container mx-auto px-4 py-8 mt-10 pb-32">
    
    {{-- الأزرار العلوية (زر العودة + زر الطباعة) --}}
    <div class="flex justify-between items-center mb-6 no-print">
        <a href="{{ route('admin.orders') }}" class="inline-flex items-center gap-2 text-zinc-500 hover:text-primary transition">
            <span class="material-symbols-outlined">arrow_forward</span>
            <span class="font-bold">عودة للطلبات</span>
        </a>

        {{-- زر الطباعة --}}
        <button onclick="window.print()" class="inline-flex items-center gap-2 bg-zinc-900 dark:bg-white text-white dark:text-black px-6 py-2 rounded-full font-bold hover:scale-105 transition shadow-lg">
            <span class="material-symbols-outlined">print</span>
            <span>طباعة الفاتورة</span>
        </button>
    </div>

    {{-- منطقة الفاتورة (التي سيتم طباعتها) --}}
    <div id="printable-area" class="grid md:grid-cols-3 gap-6">
        
        {{-- القسم الأيمن: المنتجات --}}
        <div class="md:col-span-2 space-y-6">
            <div class="bg-white dark:bg-zinc-800 rounded-3xl p-6 shadow-lg border border-zinc-100 dark:border-zinc-700">
                <h2 class="text-xl font-black text-zinc-900 dark:text-white mb-6 flex items-center gap-2">
                    <span class="material-symbols-outlined text-primary">shopping_bag</span>
                    منتجات الطلب #{{ $order->id }}
                </h2>

                <div class="space-y-4">
                    @foreach($order->items as $item)
                    <div class="flex items-center gap-4 bg-zinc-50 dark:bg-zinc-900/50 p-4 rounded-2xl">
                        <div class="w-16 h-16 bg-white dark:bg-zinc-800 rounded-xl overflow-hidden shadow-sm">
                            <img src="{{ asset($item->product->image) }}" class="w-full h-full object-cover">
                        </div>
                        <div class="flex-1">
                            <h3 class="font-bold text-zinc-900 dark:text-white">{{ $item->product->name }}</h3>
                            <p class="text-sm text-zinc-500">الكمية: <span class="text-primary font-bold">{{ $item->quantity }}</span></p>
                        </div>
                        <div class="text-left">
                            <p class="font-bold text-zinc-900 dark:text-white">{{ $item->price }} ر.ي</p>
                            <p class="text-xs text-zinc-500">للقطعة</p>
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="mt-6 pt-6 border-t border-zinc-100 dark:border-zinc-700 flex justify-between items-center">
                    <span class="font-bold text-zinc-500">الإجمالي الكلي</span>
                    <span class="text-2xl font-black text-primary">{{ $order->total_amount }} ر.ي</span>
                </div>
            </div>
        </div>

        {{-- القسم الأيسر: بيانات العميل --}}
        <div class="space-y-6">
            <div class="bg-white dark:bg-zinc-800 rounded-3xl p-6 shadow-lg border border-zinc-100 dark:border-zinc-700 sticky top-24">
                <h2 class="text-lg font-black text-zinc-900 dark:text-white mb-4">بيانات العميل</h2>
                
                <div class="space-y-4">
                    <div class="flex items-start gap-3">
                        <span class="material-symbols-outlined text-zinc-400 mt-1">person</span>
                        <div>
                            <p class="text-xs text-zinc-500">اسم العميل</p>
                            <p class="font-bold text-zinc-900 dark:text-white">{{ $order->customer_name }}</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-3">
                        <span class="material-symbols-outlined text-zinc-400 mt-1">call</span>
                        <div>
                            <p class="text-xs text-zinc-500">رقم الهاتف</p>
                            <p class="font-bold text-zinc-900 dark:text-white" dir="ltr">{{ $order->customer_phone }}</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-3">
                        <span class="material-symbols-outlined text-zinc-400 mt-1">location_on</span>
                        <div>
                            <p class="text-xs text-zinc-500">العنوان</p>
                            <p class="font-bold text-zinc-900 dark:text-white leading-relaxed">{{ $order->address }}</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start gap-3 pt-4 border-t border-zinc-100 dark:border-zinc-700">
                        <span class="material-symbols-outlined text-zinc-400 mt-1">calendar_today</span>
                        <div>
                            <p class="text-xs text-zinc-500">تاريخ الطلب</p>
                            <p class="font-bold text-zinc-900 dark:text-white">{{ $order->created_at->format('Y-m-d h:i A') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection