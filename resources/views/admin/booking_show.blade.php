@extends('layouts.admin_pages')

@section('title', 'Booking Details')

@section('admin_pages')

<div class="w-[90%] mx-auto lg:min-h-[100vh]">
    
    <!-- Header -->
    <div class="mb-6 mt-6">
        <h1 class="text-[2em] font-bold lg:text-[2.5em]">Booking Details</h1>
        <p class="text-dark-gray text-lg leading-none lg:w-[75%]">
            View full details of the selected booking.
        </p>
    </div>
    
    <!-- Center Wrapper -->
    <div class="flex justify-center">
        
        <!-- Booking Card -->
        <div class="bg-white shadow-lg p-6 rounded-lg mt-4 w-full lg:w-2/3">

            <div class="mb-4">
                <!-- Date -->
                <div class="flex justify-between items-center">
                    <h1 class="text-[1.8em] text-dark-green font-medium lg:text-[2.5em]">
                        {{ \Carbon\Carbon::parse($booking->event_date)->format('gA | F j, Y') }}
                    </h1>

                    <a href="{{ route('admin.bookings.edit', $booking->id) }}"><img src="{{asset('images/edit-icon.png')}}" alt=""></a>
                </div> 

                <!-- Customer -->
                <div class="mt-2">
                    <p class="text-[1.25em] text-black font-medium lg:text-[2.5em]">
                        {{ $booking->user->name }}
                    </p>
                </div>
            </div>
            <!-- Details -->
            <div class="grid lg:grid-cols-3 gap-4 mb-6">
                <div class="lg:bg-white lg:shadow-lg p-4 rounded-lg">
                    <p class="text-light-gray font-medium">EVENT TYPE</p>
                    <p class="text-[1.25em] text-dark-gray font-medium">
                        {{ $booking->event_type }}
                    </p>
                </div>
                <div class="lg:bg-white lg:shadow-lg p-4 rounded-lg">
                    <p class="text-light-gray font-medium">GUEST COUNT</p>
                    <p class="text-[1.25em] text-dark-gray font-medium">
                        {{ $booking->guest_count }}
                    </p>
                </div>

                <div class="lg:bg-white lg:shadow-lg p-4 rounded-lg">
                    <p class="text-light-gray font-medium">VENUE</p>
                    <p class="text-[1.25em] text-dark-gray font-medium capitalize">
                        {{ $booking->venue }}
                    </p>
                </div>
            </div>

            <div class="mt-2">
                <p class="text-[1.25em] text-black font-medium lg:text-[1.5em]">
                    Menu Summary:
                </p>
            </div>

           <div class="mt-3">
                @if($booking->bundle)
                    <p class="text-[1.25em] font-medium text-dark-green mb-2">{{ $booking->bundle->name }}</p>
                @endif

                @if($booking->items->count() > 0)

                    <!-- ITEMS -->
                    @foreach($booking->items as $item)
                        @php
                            $lineTotal = $item->price * $item->quantity;
                        @endphp

                        <div class="flex justify-between text-[1.1em] mb-4 lg:mb-2">
                            <p>{{ $item->menuItem->name ?? 'Item' }}</p>
                            @if(!$booking->bundle)
                                <p class="text-gray-500">₱{{ number_format($lineTotal, 2) }}</p>
                            @endif
                        </div>
                    @endforeach

                    <!-- DIVIDER -->
                    <div class="border-t my-3"></div>

                    <!-- SUBTOTAL -->
                    <div class="flex text-light-gray justify-between text-[1.1em] mb-2">
                        <p>Subtotal</p>
                        @if($booking->bundle)
                            <p>₱{{ number_format($bundleTotal, 2) }}</p>
                        @else
                            <p>₱{{ number_format($subtotal, 2) }}</p>
                        @endif
                    </div>

                    <!-- DELIVERY -->
                    <div class="flex text-light-gray justify-between text-[1.1em] mb-2">
                        <p>Delivery & Setup</p>
                        <p>₱{{ number_format($delivSetup, 2) }}</p>
                    </div>

                    <!-- TOTAL -->
                    <div class="flex justify-between text-[1.3em] font-bold mt-3">
                        <p>Estimated Total</p>
                        <p>₱{{ number_format($booking->total_price, 2) }}</p>
                    </div>

                @else
                    <p class="text-gray-500">No menu items selected.</p>
                @endif

            </div>

        </div>

    </div>

    <div class="w-1/2 mx-auto lg:w-2/3 bg-white shadow-lg p-4 rounded-lg mt-6">
        <form action="{{ route('inquiries.store') }}" method="POST" class="mt-6">
            @csrf
            <input type="hidden" name="booking_id" value="{{ $booking->id }}">

            <textarea 
                name="message" 
                placeholder="Propose changes or message the client..."
                class="w-full border p-2 rounded"
                required
            ></textarea>

            <button class="bg-dark-green text-white px-4 py-2 mt-2 rounded">
                Propose Changes
            </button>
        </form>
    </div>

    <div class="pb-[5em]"></div>
</div>

@endsection