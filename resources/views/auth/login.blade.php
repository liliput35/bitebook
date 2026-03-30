@extends('layouts.content')

@section('title', 'Login')

@section('content') 

<div class="w-4/5 mx-auto mt-[30%]">
    <h2 class="text-[2em] font-bold">Welcome Back</h2>
    <p class="text-[1.25em] text-dark-green">Let's get you booked.</p>

    <form method="POST" action="/login" class="mt-[1.5em]">
        @csrf
        <label class="font-bold mb-2">Username</label>
        <input type="text" name="username" placeholder="Enter you username" class="block border-dark-gray border bg-background px-4 py-1 w-full mt-2 rounded-md mb-4">
        <label class="font-bold mb-2">Password</label>
        <input type="password" name="password" placeholder="Enter you password" class="block border-dark-gray border bg-background px-4 py-1 w-full mt-2 rounded-md mb-6">
        <button class="bg-dark-green text-white px-4 py-2 w-full rounded-md shadow-md">Log In</button>
    </form> 

    <p class="mt-8 text-center text-dark-gray">Don't have an account? <span><a href="{{ url('/signup') }}" class="font-bold text-dark-green">Sign Up</a></span></p>
</div>




@endsection