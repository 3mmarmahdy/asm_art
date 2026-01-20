@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8 mt-10">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-black text-zinc-900 dark:text-white">إدارة الطلبات</h1>
        <span class="bg-primary/20 text-primary px-4 py-1 rounded-full text-sm font-bold">
            عدد الطلبات: {{ $orders->count() }}
        </span>
    </div>

    <div class="bg-white dark:bg-zinc-800 rounded-3xl shadow-xl overflow-hidden border border-zinc-100 dark:border-zinc-700">
        <div class="overflow-x-auto">
            <table class="w-full text-right">
                <thead class="bg-zinc-50 dark:bg-zinc-900/50">
                    <tr>
                        <th class="px-6 py-4 text-xs font-bold text-zinc-500 uppercase">رقم الطلب</th>
                        <th class="px-6 py-4 text-xs font-bold text-zinc-500 uppercase">العميل</th>
                        <th class="px-6 py-4 text-xs font-bold text-zinc-500 uppercase">الهاتف</th>
                        <th class="px-6 py-4 text-xs font-bold text-zinc-500 uppercase">الإجمالي</th>
                        <th class="px-6 py-4 text-xs font-bold text-zinc-500 uppercase">التاريخ</th>
                        <th class="px-6 py-4 text-xs font-bold text-zinc-500 uppercase">الإجراءات</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-100 dark:divide-zinc-700">
                    @forelse($orders as $order)
                    <tr class="hover:bg-zinc-50 dark:hover:bg-zinc-700/50 transition">
                        <td class="px-6 py-4 font-bold text-zinc-900 dark:text-white">#{{ $order->id }}</td>
                        <td class="px-6 py-4 text-zinc-700 dark:text-zinc-300">{{ $order->customer_name }}</td>
                        <td class="px-6 py-4 text-zinc-500 text-sm" dir="ltr">{{ $order->customer_phone }}</td>
                        <td class="px-6 py-4 font-bold text-primary">{{ $order->total_amount }} ر.ي</td>
                        <td class="px-6 py-4 text-zinc-400 text-sm">{{ $order->created_at->format('Y-m-d') }}</td>
                        <td class="px-6 py-4">
                            <a href="{{ route('admin.orders.show', $order->id) }}" class="inline-flex items-center gap-1 bg-primary text-black px-3 py-1.5 rounded-lg text-xs font-bold hover:bg-yellow-400 transition">
                                <span class="material-symbols-outlined text-[16px]">visibility</span>
                                تفاصيل
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center text-zinc-500">
                            لا توجد طلبات حتى الآن
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection