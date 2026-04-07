@extends('layouts.user_pages')

@section('title', $menuItem->name)

@section('user_pages')

<div class="w-[90%] lg:w-2/3 mx-auto lg:min-h-[100vh] lg:grid lg:grid-cols-2 lg:gap-6 pt-6 lg:pt-[6em]">
    <div class="left bg-red-50 lg:w-[1/2] lg:h-[500px] w-full h-[400px]"></div> 

    <div class="right lg:w-1/2 mt-4 lg:mt-0">
        <h1 class="font-medium text-[1.75em]">{{$menuItem->name}}</h1> 
        <p class="text-[1.25em] mt-2">P {{$menuItem->price}}</p> 
        <p class="text-[1em] text-dark-gray mt-4">{{$menuItem->description}}</p> 

        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-2 rounded mb-2">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="bg-red-100 text-red-700 p-2 rounded mb-2">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('cart.add', $menuItem->id) }}" method="POST">
            @csrf

            <p class="font-medium mt-4">Quantity</p>
            <input 
                type="number" 
                name="quantity"
                value="1"
                min="1"
                class="border-black border p-1"
                required
            > 

            <br>
            <button type="submit" class="px-4 py-1 border border-black rounded-full mt-6">
                Add to Selection
            </button>
        </form> 
    </div>
</div>


@endsection