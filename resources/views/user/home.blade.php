@extends('layouts.user_pages')

@section('title', 'Home')

@section('user_pages')

<div class="bg-cover bg-center lg:h-[70vh] pt-6" style="background-image: url('{{ asset('images/Hero Section.png') }}')">
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

<div class="w-[90%] mx-auto py-[4em] lg:flex lg:justify-center lg:gap-[5em]">
    <div class="left w-[40%]">
        <h2 class="text-dark-green text-[2.5em] font-semibold mb-6">WHY CHOOSE BITEBOOK?</h2>
        <div class="bg-center bg-cover w-full h-[400px] hidden lg:block" style="background-image: url('{{ asset('images/why-section.png') }}')"></div>
    </div>
    <div class="right lg:w-[40%]">
        <div class="mb-8 text-justify">
            <h3 class="text-dark-green font-semibold mb-2">Stress-Free Event Planning</h3>
            <p>Planning an event has never been easier with BiteBook. Customers can explore menus, customize bundles, and book catering in just a few clicks, while catereers stay in control of every detail</p>
        </div>
        <div class="mb-8 text-justify">
            <h3 class="text-dark-green font-semibold mb-2">Streamlined Catering Management</h3>
            <p>Managing catering services doesn't have to be complicated. A streamlined system keeps menus organized, bookings tracked, and bundles ready to showcase. Less time on logistics means more time creating unforgettable meals.</p>
        </div>
        <div class="mb-8 text-justify">
            <h3 class="text-dark-green font-semibold mb-2">Efficiency Meets Convenience</h3>
            <p>Efficiency and convenience are at the heart of modern catering. By connecting customers and caterers in one platform, every detail stays organized and communication flows easily. The result is better service, happier clients, and events that run seamlessly.</p>
        </div>
        <div class="mb-8 text-justify">
            <h3 class="text-dark-green font-semibold mb-2">Great Food, Great System</h3>
            <p>Great food deserves a great system. From weddings to corporate luncheons, every event is easier to plan when menus, bundles, and bookings live in one place. Stress fades, organization shines, and celebrations feel effortless.</p>
        </div>
    </div>
</div>

<div class="bg-light-green text-white">
    <div class="w-[90%] mx-auto py-[4em] flex flex-col lg:flex-row lg:justify-center lg:gap-[5em] lg:items-center">
        <div class="left order-2 lg:order-1 lg:w-[40%]">
            <div class="bg-cover bg-center w-full h-[600px]" style="background-image: url('{{ asset('images/collage.png') }}')"></div>
        </div>

        <div class="right order-1 mb-[2em] lg:order-2 lg:w-[30%]">
            <h2 class="text-[2.5em] font-semibold mb-3 text-center">MENU</h2>
            <p class="text-justify mb-6">Explore a complete selection of dishes, each crafted to suit different tastes and occasions. The menu is your gateway to variety, giving customers the freedom to choose meals that fit their event perfectiy. Organized and easy to manage, it keeps every option clear and accessible.</p>
            <a class="border px-3 py-1 border-white rounded-full" href="{{route('user.menu')}}">View Menu</a>
        </div>
    </div>
</div>

<div class="">
    <div class="w-[90%] mx-auto py-[4em] lg:flex lg:justify-center lg:items-center lg:gap-[5em]">
        

        <div class="left mb-[2em] lg:w-[30%]">
            <h2 class="text-[2.5em] font-semibold mb-3 text-center">BUNDLES</h2>
            <p class="text-justify mb-6">Simplify event planning with ready-made bundles designed for birthdays, corporate luncheons, and more. Each bundle combines dishes into balanced sets, saving time while ensuring guests enjoy a complete dining experience. Flexible and customizable, bundles make catering effortless.</p>
            <a class="border px-3 py-1 border-dark-green text-dark-green rounded-full" href="{{route('user.bundles')}}">View Bundles</a>
        </div>

        <div class="right lg:w-1/2">
            <img src="{{ asset('images/bundle-collage.png') }}" alt="" class="lg:w-[75%] mx-auto">
        </div>
    </div>
</div>


<div class="pb-[5em]"></div>


@endsection