@extends('layouts.user_pages')

@section('title', 'Your Selection')

@section('user_pages')

<div class="w-[90%] mx-auto pt-6 lg:w-1/2 min-h-[70vh]">

    <h1 class="text-2xl font-bold mb-4">Your Selection</h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if(count($cart) > 0)

        @php $grandTotal = 0; @endphp

        @foreach($menuItems as $item)
            @php
                $qty = $cart[$item->id]['quantity'];
                $total = $item->price * $qty;
                $grandTotal += $total;
            @endphp

            <div class="bg-white shadow p-4 rounded mb-3 flex justify-between items-center">

                <!-- LEFT: ITEM INFO -->
                <div>
                    <h2 class="font-semibold">{{ $item->name }}</h2>
                    <p class="text-gray-500">₱{{ $item->price }} each</p>
                    <p class="text-sm text-gray-600">Subtotal: ₱{{ $total }}</p>
                </div>

                <!-- RIGHT: CONTROLS -->
                <div class="flex items-center gap-3">

                    <!-- UPDATE FORM -->
                    <form action="{{ route('cart.update', $item->id) }}" method="POST" class="flex items-center gap-2">
                        @csrf
                        <input 
                            type="number" 
                            name="quantity" 
                            value="{{ $qty }}" 
                            min="1"
                            class="w-16 border rounded p-1"
                        >
                        <button class="border border-dark-green text-dark-green px-3 py-1 rounded">
                            Update
                        </button>
                    </form>

                    <!-- REMOVE -->
                    <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                        @csrf
                        <button class="mt-1">
                            <img src="{{asset('images/delete-icon.png')}}" alt="" class="max-w-[35px]">
                        </button>
                    </form>

                </div>
            </div>
        @endforeach

        <!-- TOTAL -->
        <div class="mt-6 bg-gray-100 p-4 rounded">
            <h2 class="text-xl font-bold">Total: ₱{{ $grandTotal }}</h2>
        </div>

        <!-- ACTION -->
        <div class="mt-4 flex justify-end">
            <a href="{{ route('user.book') }}" 
               class="bg-dark-green text-white px-6 py-2 rounded">
               Proceed to Booking →
            </a>
        </div>

    @else
        <p class="text-gray-500">Your selection is empty.</p>
    @endif

</div>

@endsection