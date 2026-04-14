@extends('layouts.user_pages')

@section('title', 'Home')

@section('user_pages')

<div class="bg-red-900 lg:h-[70vh]">
    <div class="w-[90%] mx-auto">

        <div class="h-[50vh] flex flex-col justify-between py-[4em] text-white lg:flex-row">

            <div class="left text-[2.5em] font-semibold">
                <h2>BITE INTO</h2>
                <h2>BETTER BOOKINGS</h2>
            </div>

            <div class="right lg:w-[30%] lg:mt-[20em]">
                <p class="text-justify mb-6">Planning an event has never been easier with BiteBook. Customers can explore menus, customize bundles, and book catering in just a few clicks, while catereers stay in control of every detail. Wheter it's a wedding, birthday, or corporate luncheon, BiteBook ensures every celebration is smooth and memorable</p>

                <a href="{{route('user.menu')}}" class="px-3 py-1 border border-white rounded-full">Explore Menu</a>
            </div>
        </div>
    </div>
</div>

<div class="w-[90%] mx-auto py-[4em] lg:flex lg:justify-between">
    <div class="left w-1/2">
        <h2 class="text-dark-green text-[2.5em] font-semibold mb-6">WHY CHOOSE BITEBOOK?</h2>
        <div class="bg-red-100 w-full h-[400px] hidden lg:block"></div>
    </div>
    <div class="right lg:w-[40%]">
        <div class="mb-8 text-justify">
            <h3 class="text-dark-green font-semibold mb-2">Stress-Free Event Planning</h3>
            <p>Planning an event has never been easier with BiteBook. Customers can explore menus, customize bundles, and book catering in just a few clicks, while catereers stay in control of every detail</p>
        </div>
        <div class="mb-8 text-justify">
            <h3 class="text-dark-green font-semibold mb-2">Stress-Free Event Planning</h3>
            <p>Planning an event has never been easier with BiteBook. Customers can explore menus, customize bundles, and book catering in just a few clicks, while catereers stay in control of every detail</p>
        </div>
        <div class="mb-8 text-justify">
            <h3 class="text-dark-green font-semibold mb-2">Stress-Free Event Planning</h3>
            <p>Planning an event has never been easier with BiteBook. Customers can explore menus, customize bundles, and book catering in just a few clicks, while catereers stay in control of every detail</p>
        </div>
        <div class="mb-8 text-justify">
            <h3 class="text-dark-green font-semibold mb-2">Stress-Free Event Planning</h3>
            <p>Planning an event has never been easier with BiteBook. Customers can explore menus, customize bundles, and book catering in just a few clicks, while catereers stay in control of every detail</p>
        </div>
    </div>
</div>

<div class="bg-light-green text-white">
    <div class="w-[90%] mx-auto py-[4em] flex flex-col lg:flex-row lg:justify-between">
        <div class="left order-2 lg:order-1 lg:w-[50%]">
            <div class="bg-red-100 w-full h-[400px]"></div>
        </div>

        <div class="right order-1 mb-[2em] lg:order-2 lg:w-[40%]">
            <h2 class="text-[2.5em] font-semibold mb-3 text-center">MENU</h2>
            <p class="text-justify mb-6 lg:w-1/2">Planning an event has never been easier with BiteBook. Customers can explore menus, customize bundles, and book catering in just a few clicks, while catereers stay in control of every detail</p>
            <a class="border px-3 py-1 border-white rounded-full" href="{{route('user.menu')}}">View Menu</a>
        </div>
    </div>
</div>

<div class="">
    <div class="w-[90%] mx-auto py-[4em] lg:flex lg:justify-between">
        

        <div class="left mb-[2em] lg:w-[40%]">
            <h2 class="text-[2.5em] font-semibold mb-3 text-center">BUNDLES</h2>
            <p class="text-justify mb-6">Planning an event has never been easier with BiteBook. Customers can explore menus, customize bundles, and book catering in just a few clicks, while catereers stay in control of every detail</p>
            <a class="border px-3 py-1 border-dark-green text-dark-green rounded-full" href="{{route('user.bundles')}}">View Bundles</a>
        </div>

        <div class="right lg:w-1/2">
            <div class="bg-red-100 w-full h-[400px]"></div>
        </div>
    </div>
</div>


<div class="pb-[5em]"></div>


@endsection