@extends('layouts.admin_pages')

@section('title', 'Bookings')

@section('admin_pages')

<div class="w-[90%] mx-auto lg:min-h-[100vh]">
    
    <div class="mb-6 mt-6">
        <h1 class="text-[2em] font-bold lg:text-[2.5em]">Bookings</h1>
        <p class="text-dark-gray text-lg leading-none lg:w-[75%]">Oversee your dish collection, monitor seasonal prices, and refresh visibility on your booking page.</p>
    </div>
    
        @foreach($bookings as $date => $group)
            <div class="flex justify-between items-end border-b border-dark-gray pb-2 mb-6">
                <h1 class="text-[2em] font-medium mt-6 lg:text-[2.5em]">{{ $date }}</h1>
            </div>
            <div class="lg:grid lg:grid-cols-3 lg:w-2/3 lg:gap-4">
                @forelse($group as $booking)
                <a href="{{ route('admin.bookings.show', $booking->id) }}">
                    <div class="bg-white shadow-lg p-4 rounded-lg mb-3">
                        <p class="text-dark-green font-medium">{{ $date }}</p>
                        <p class="text-[1.25em] text-black font-medium">{{ $booking->event_type }}</p>
                        <p class="text-[1em] text-dark-gray font-medium">{{ $booking->user->name }}</p>
                    </div>
                </a>
                @empty
                    <p class="text-center">No bookings yet.</p>
                @endforelse
            </div>
        @endforeach

        <div class="pb-[5em] lg:pb-3"></div>
    </div>


@endsection