<!DOCTYPE html>

<html class="dark" lang="en">
<head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Ammar's Art</title>

<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>

<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;700;800;900&display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet"/>

<script src="{{ asset('js/config.js') }}"></script>
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body class="bg-background-light dark:bg-background-dark font-display">
<div class="relative flex h-auto min-h-screen w-full flex-col bg-background-light dark:bg-background-dark">

<!-- Top App Bar -->
<div class="flex items-center bg-background-light dark:bg-background-dark p-4 pb-2 justify-between sticky top-0 z-10">
    <div class="flex size-12 shrink-0 items-center justify-start">
        <span class="material-symbols-outlined text-zinc-900 dark:text-white">search</span>
    </div>

    <h2 class="text-zinc-900 dark:text-white text-lg font-bold leading-tight tracking-[-0.015em] flex-1 text-center">
        Kalimah
    </h2>

    <div class="flex w-12 items-center justify-end">
        <a href="{{ route('cart.index') }}"
           class="flex max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-12 bg-transparent text-zinc-900 dark:text-white gap-2 text-base font-bold leading-normal tracking-[0.015em] min-w-0 p-0">
            <span class="material-symbols-outlined">shopping_cart</span>
        </a>
    </div>
</div>

<!-- Hero Section -->
<div class="@container">
<div class="@[480px]:p-4">
<div class="flex min-h-[480px] flex-col gap-6 bg-cover bg-center bg-no-repeat @[480px]:gap-8 @[480px]:rounded-xl items-center justify-center p-4"
style='background-image: linear-gradient(rgba(10, 25, 49, 0.4) 0%, rgba(10, 25, 49, 0.7) 100%), url("https://lh3.googleusercontent.com/aida-public/AB6AXuBG-CppD0wh8LcnVcV1Qb7NNEyHhyZv2Re-HwXm9e-hfK8qcp11ao0u2pg9u_0nfMj-aAWeYJ61PsYk3MZUeB8bDZhAwfKmL_w5KllmVG8Hfvh4QsHxXlHNUUYrKoHj_dPX4V8_L5h7pp0fb3Y8_Hb_eSGlkps3q62Nf9MirjX9gsFQdhTvoFHoC5Qt336CbnlmKElqjN7PltCTBTjnMZ20LBU045jjdS9qTSF8fR9hVAmdIg7qFTlrTUa5jjXscMZMni0bbcsOE-0");'>

<div class="flex flex-col gap-2 text-center">
<h1 class="text-white text-4xl font-black leading-tight tracking-[-0.033em] @[480px]:text-5xl">
The Art of Writing
</h1>
<h2 class="text-white text-sm @[480px]:text-base">
Discover Our Exquisite Collection of Calligraphy Supplies
</h2>
</div>

<a href="{{ route('products.index') }}"
class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-10 px-4 @[480px]:h-12 @[480px]:px-5 bg-[#D4AF37] text-primary text-sm font-bold">
<span class="truncate">Shop Our Collection</span>
</a>

</div>
</div>
</div>

<!-- Featured Products -->
<h2 class="text-zinc-900 dark:text-white text-[22px] font-bold px-4 pb-3 pt-5">Featured Products</h2>

{{-- Debug (يمكنك حذفه لاحقًا) --}}
<div class="px-4 text-red-600 text-sm font-bold">COUNT: {{ $products->count() }}</div>

<div class="grid grid-cols-2 gap-4 px-4">

@foreach($products as $product)
    <div class="flex flex-col gap-2">
        <div class="relative w-full aspect-square rounded-xl bg-cover bg-center"
            @php
    $bg = $product->image ?: 'https://via.placeholder.com/400';
    
@endphp
<div class="flex flex-col gap-2">
    @php
        $bg = $product->image ?: 'https://via.placeholder.com/400';
    @endphp

    <div class="relative w-full aspect-square rounded-xl bg-cover bg-center"
         style="background-image: url('{{ $bg }}');">

        <form action="{{ route('cart.add', $product->id) }}" method="POST" class="absolute bottom-2 right-2">
            @csrf
            <button type="submit"
                    class="flex h-8 w-8 items-center justify-center rounded-full bg-primary/80 backdrop-blur-sm">
                <span class="material-symbols-outlined text-white text-lg">add_shopping_cart</span>
            </button>
        </form>

    </div>

    <div class="flex flex-col">
        <h3 class="text-sm font-bold text-zinc-900 dark:text-white">{{ $product->name }}</h3>
        <p class="text-sm font-medium icon-gold">${{ $product->price }}</p>
    </div>
</div>

<div class="relative w-full aspect-square rounded-xl bg-cover bg-center"
     style="background-image: url('{{ $bg }}');">


            <form action="{{ route('cart.add', $product->id) }}" method="POST" class="absolute bottom-2 right-2">
                @csrf
                <button type="submit"
                        class="flex h-8 w-8 items-center justify-center rounded-full bg-primary/80 backdrop-blur-sm">
                    <span class="material-symbols-outlined text-white text-lg">add_shopping_cart</span>
                </button>
            </form>

        </div>
        

        <div class="flex flex-col">
            <h3 class="text-sm font-bold text-zinc-900 dark:text-white">{{ $product->name }}</h3>
            <p class="text-sm font-medium icon-gold">${{ $product->price }}</p>
        </div>
    </div>
@endforeach

</div>


<div class="h-24"></div>

<!-- Bottom Navigation -->
<div class="fixed bottom-0 left-0 right-0 h-20 bg-background-light/80 dark:bg-background-dark/80 backdrop-blur-lg border-t">
<div class="flex justify-around items-center h-full px-4">

<a href="{{ url('/') }}" class="flex flex-col items-center gap-1 text-[#D4AF37]">
<span class="material-symbols-outlined">home</span>
<span class="text-xs font-bold">Home</span>
</a>

<a href="{{ route('products.index') }}" class="flex flex-col items-center gap-1 text-zinc-500">
<span class="material-symbols-outlined">store</span>
<span class="text-xs font-medium">Shop</span>
</a>

<a href="{{ route('wishlist.index') }}" class="flex flex-col items-center gap-1 text-zinc-500">
<span class="material-symbols-outlined">favorite</span>
<span class="text-xs font-medium">Wishlist</span>
</a>

<a href="{{ route('profile.index') }}" class="flex flex-col items-center gap-1 text-zinc-500">
<span class="material-symbols-outlined">person</span>
<span class="text-xs font-medium">Profile</span>
</a>

</div>
</div>

</div>
</body>
</html>
