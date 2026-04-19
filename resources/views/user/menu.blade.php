@extends('layouts.user_pages')

@section('title', 'Menu')

@section('user_pages')

<div class="w-[90%] mx-auto lg:min-h-[100vh]">

    
    <div class="border-b border-dark-gray pb-2 mb-6">
        <h1 class="text-[2em] font-bold lg:text-[2.5em]">DISCOVER DISHES FOR EVERY OCCASION</h1>
    </div>
    
    
    {{-- Success message --}}
    @if(session('success'))
        <p class="mb-4">{{ session('success') }}</p>
    @endif

    <div class="items-container lg:grid lg:grid-cols-4 lg:gap-5">

        @forelse($menuItems as $item)
        <div class="item mb-6 bg-white rounded-xl shadow-lg overflow-hidden pb-4">
            <div class="top-row h-[250px] bg-red-300 flex justify-end">
                <p class="mr-4 mt-4 bg-light-gray text-white h-fit px-3 py-1 rounded-full">{{ $item->category->name ?? 'N/A' }}</p>
            </div>
            <div class="bot-row px-4">
                <h4 class="font-medium text-[1.5em] my-1 truncate">{{ $item->name }}</h4>
                <p class="font-medium text-dark-green mb-1 text-[1.25em]">P {{ $item->price }}</p>
                <p class="mb-4 truncate">{{ $item->description }}</p>
                <div class="flex justify-end">
                    <a href="{{ route('user.menu.item', $item->id) }}" class=""><img src="{{asset('images/add-icon.png')}}" alt="" class="max-w-[40px]"></a>
                </div>
            </div>
        </div>
        @empty 
        <p class="text-center">No menu items yet.</p>
        @endforelse

    </div>

    <div class="pb-[5em] lg:pb-3"></div>
</div>


@endsection