@extends('layouts.app')

@section('content')
<div class="p-6 min-h-screen pb-24">
    <h1 class="text-2xl font-black mb-6 text-zinc-900 dark:text-white flex items-center gap-2">
        <span class="material-symbols-outlined text-primary">shield_person</span>
        لوحة تحكم الطلبات
    </h1>

    <div class="overflow-x-auto bg-white dark:bg-zinc-800 rounded-2xl shadow-sm border border-zinc-100 dark:border-zinc-700">
        <table class="w-full text-sm text-right">
            <thead class="text-xs text-zinc-500 uppercase bg-zinc-50 dark:bg-zinc-900/50 border-b dark:border-zinc-700">
                <tr>
                    <th class="px-6 py-4">رقم الطلب</th>
                    <th class="px-6 py-4">العميل</th>
                    <th class="px-6 py-4">المبلغ</th>
                    <th class="px-6 py-4">التاريخ</th>
                    <th class="px-6 py-4">الحالة</th>
                    <th class="px-6 py-4">عرض</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                <tr class="border-b dark:border-zinc-700 hover:bg-zinc-50 dark:hover:bg-zinc-700/50 transition">
                    <td class="px-6 py-4 font-bold">#{{ $order->id }}</td>
                    <td class="px-6 py-4 text-zinc-900 dark:text-white font-medium">
                        {{ $order->customer_name }}
                        <div class="text-[10px] text-zinc-500">{{ $order->customer_phone }}</div>
                    </td>
                    <td class="px-6 py-4 font-black text-primary">{{ $order->total_amount }}</td>
                    <td class="px-6 py-4 text-zinc-500">{{ $order->created_at->diffForHumans() }}</td>
                    <td class="px-6 py-4">
                        <span class="bg-yellow-100 text-yellow-800 text-xs font-bold px-2.5 py-0.5 rounded-full dark:bg-yellow-900/30 dark:text-yellow-300">
                            {{ $order->status }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        <a href="{{ route('admin.orders.show', $order->id) }}" class="text-zinc-400 hover:text-primary transition">
                            <span class="material-symbols-outlined">visibility</span>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        
        @if($orders->isEmpty())
            <div class="p-8 text-center text-zinc-500">لا توجد طلبات حتى الآن 😴</div>
        @endif
    </div>
</div>
@endsection