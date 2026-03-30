@extends('layouts.content')

@section('title', 'Sign Up')

@section('content') 

<div class="w-4/5 mx-auto mt-[30%]">
    <h2 class="text-[2em] font-bold">Create an Account</h2>
    <p class="text-[1.25em] text-dark-green">You are moments away from getting started!</p>

    <form method="POST" action="/signup" class="mt-[1.5em]">
        @csrf
        <div class="flex justify-between gap-2">
            <div class="">
                <label class="font-bold mb-2">First Name</label>
                <input type="text" name="firstname" placeholder="First Name" class="block border-dark-gray border bg-background px-4 py-1 w-full mt-2 rounded-md mb-4">
            </div>
            <div class="">
                <label class="font-bold mb-2">Last Name</label>
                <input type="text" name="firstname" placeholder="Last Name" class="block border-dark-gray border bg-background px-4 py-1 w-full mt-2 rounded-md mb-4">
            </div>
        </div>
        <label class="font-bold mb-2">Username</label>
        <input type="text" name="username" placeholder="Enter you username" class="block border-dark-gray border bg-background px-4 py-1 w-full mt-2 rounded-md mb-4">
        <label class="font-bold mb-2">Password</label>
        <input type="password" name="password" placeholder="Enter you password" class="block border-dark-gray border bg-background px-4 py-1 w-full mt-2 rounded-md mb-6">
        <button class="bg-dark-green text-white px-4 py-2 w-full rounded-md shadow-md">Log In</button>
    </form> 

    <p class="mt-8 text-center text-dark-gray">Already have an account? <span><a href="{{ url('/login') }}" class="font-bold text-dark-green">Log In</a></span></p>
</div>




@endsection