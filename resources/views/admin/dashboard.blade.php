@extends('layouts.content')

@section('title', 'Dashboard')

@section('content')

<div class="bg-dark-green py-4 flex justify-center md:hidden">
    <img src="{{asset('images/logo.png')}}" alt="" class="max-w-[85px]">
</div>

<div class="w-[90%] mx-auto">

    <h1 class="text-[2em] font-bold mt-6">Welcome back, Chef</h1>
    <p class="text-dark-gray text-lg leading-none">Here is what's simmering in your kitchen today.</p>

    <div class="bg-white shadow-lg p-4 rounded-lg mt-4">
        <div class="mb-6 w-full flex items-center gap-2">
            <img src="{{asset('images/revenue-icon.png')}}" alt="" class="mw-[25px]">
            <div class="w-full flex justify-between">
                <div class="">
                    <h4 class="text-light-gray font-medium leading-none">TOTAL REVENUE</h4>
                    <p class="font-medium text-[1.5em]">P0000.00</p>
                </div>

                <p class="font-medium text-light-green">+12%</p>
            </div>
        </div>
        <div class="mb-6 w-full flex items-center gap-2">
            <img src="{{asset('images/inquiries-icon.png')}}" alt="" class="mw-[25px]">
            <div class="w-full flex justify-between">
                <div class="">
                    <h4 class="text-light-gray font-medium leading-none">TOTAL REVENUE</h4>
                    <p class="font-medium text-[1.5em]">P0000.00</p>
                </div>

                <p class="font-medium text-light-green">+12%</p>
            </div>
        </div>
        <div class="mb-6 w-full flex items-center gap-2">
            <img src="{{asset('images/bookings-icon.png')}}" alt="" class="mw-[25px]">
            <div class="w-full flex justify-between">
                <div class="">
                    <h4 class="text-light-gray font-medium leading-none">TOTAL REVENUE</h4>
                    <p class="font-medium text-[1.5em]">P0000.00</p>
                </div>

                <p class="font-medium text-light-green">+12%</p>
            </div>
        </div>
        <div class="mb-6 w-full flex items-center gap-2">
            <img src="{{asset('images/popular-icon.png')}}" alt="" class="mw-[25px]">
            <div class="w-full flex justify-between">
                <div class="">
                    <h4 class="text-light-gray font-medium leading-none">TOTAL REVENUE</h4>
                    <p class="font-medium text-[1.5em]">P0000.00</p>
                </div>

                <p class="font-medium text-light-green">+12%</p>
            </div>
        </div>

    </div>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-md mt-8">
            Logout
        </button>
    </form>
</div>

@include('layouts.admin_navbar') 

@endsection