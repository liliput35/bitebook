@extends('layouts.content')

@section('title', 'Login')

@section('content') 

<div class="lg:flex lg:justify-between lg:gap-8 lg:w-[95%] xl:w-4/5 lg:mx-auto lg:items-center lg:h-[100vh]">
    <div class="left hidden relative lg:w-[60%] lg:h-[95%] lg:rounded-3xl lg:flex lg:flex-col justify-between p-6 overflow-hidden">

        <img src="{{ asset('images/login-bg.png') }}" 
        class="absolute inset-0 w-full h-full object-cover z-0">
    

        <img src="{{ asset('images/logo.png')}}" alt="" class="w-1/4 relative z-10">

        <div class="bottom-text">
            <h3 class="text-[3.5em] text-white font-bold z-10 relative leading-none">Bite Into</h3> 
            <h3 class="text-[3.5em] text-white font-bold z-10 relative leading-none">Better Bookings.</h3>
        </div>
    </div>


    <div class="w-4/5 mx-auto mt-[30%] md:w-1/2 md:mt-[10%] lg:mx-0 lg:mt-0 lg:w-[40%]">
        <h2 class="text-[2em] font-bold">Welcome Back</h2>
        <p class="text-[1.25em] text-dark-green">Let's get you booked.</p>

        <form method="POST" action="/login" class="mt-[1.5em]">
            @csrf
            <label class="font-medium mb-2">Username</label>
            <input type="text" name="username" placeholder="Enter you username" class="block border-dark-gray border bg-background px-4 py-1 w-full mt-2 rounded-md mb-4">
            <label class="font-medium mb-2">Password</label>
            <input type="password" name="password" placeholder="Enter you password" class="block border-dark-gray border bg-background px-4 py-1 w-full mt-2 rounded-md mb-6">
            <button class="bg-dark-green text-white px-4 py-2 w-full rounded-md shadow-md font-medium">Log In</button>
        </form> 

        <p class="mt-8 text-center text-dark-gray">Don't have an account? <span><a href="{{ url('/signup') }}" class="font-medium text-dark-green">Sign Up</a></span></p>
    </div>
</div>






@endsection