<div class="relative inline-block">
    {{-- الزر --}}
    <button 
        wire:click="addToCart" 
        wire:loading.attr="disabled"
        class="w-8 h-8 flex items-center justify-center rounded-full bg-zinc-100 dark:bg-zinc-700 text-zinc-900 dark:text-white shadow-sm hover:bg-primary hover:text-black transition group relative"
    >
        {{-- أيقونة السلة (تختفي عند التحميل) --}}
        <span wire:loading.remove class="material-symbols-outlined text-[18px]">add_shopping_cart</span>
        
        {{-- أيقونة التحميل (تظهر عند الضغط) --}}
        <span wire:loading class="animate-spin h-4 w-4 border-2 border-current border-t-transparent rounded-full"></span>
    </button>

    {{-- رسالة نجاح صغيرة تظهر وتختفي --}}
    @if($showSuccess)
    <div 
        x-data="{ show: true }" 
        x-init="setTimeout(() => show = false, 2000)" 
        x-show="show"
        class="absolute bottom-10 left-1/2 -translate-x-1/2 bg-green-500 text-white text-[10px] font-bold px-2 py-1 rounded-full whitespace-nowrap shadow-lg animate-bounce z-50"
    >
        تمت الإضافة! ✅
    </div>
    @endif
</div>