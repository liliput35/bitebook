@extends('layouts.user_pages')

@section('title', 'Book Event')

@section('user_pages')

<div class="w-[90%] mx-auto pt-6 min-h-[70vh] lg:w-1/2">

    <h1 class="text-2xl font-bold mb-4">Book Your Event</h1>

    <form action="{{ route('user.book.store') }}" method="POST">
        @csrf

        <!-- EVENT INFO -->
        <div class="mb-4">
            <label>Event Type</label>
            <input type="text" name="event_type" class="border p-2 w-full" required>
        </div>

        <div class="mb-4">
            <label>Event Date</label>
            <input type="date" name="event_date" class="border p-2 w-full" required>
        </div>

        <div class="mb-4">
            <label>Guest Count</label>
            <input type="number" name="guest_count" min="1" class="border p-2 w-full" required>
        </div>

        <!-- SUMMARY -->
        <div class="bg-gray-100 p-4 rounded mb-4">
            <h2 class="font-bold mb-2">Summary</h2>

            @if($bundle)
                <p><strong>Bundle:</strong> {{ $bundle->name }}</p>
                <p>₱{{ $bundle->price_per_head }} / head</p>
                <p>Guests: {{ $bundleData['quantity'] }}</p>
                <p class="font-semibold">Total: ₱{{ $total }}</p>

                <!-- UPDATE QUANTITY -->
                <form action="{{ route('bundle.update') }}" method="POST" class="mt-2">
                    @csrf
                    <input type="number" name="quantity" value="{{ $bundleData['quantity'] }}" min="1" class="border p-1">
                    <button class="border border-dark-green text-dark-green px-3 py-1 rounded">
                        Update
                    </button>
                </form>

                <!-- REMOVE -->
                <form action="{{ route('bundle.remove') }}" method="POST" class="mt-2">
                    @csrf
                    <button class="mt-1">
                            <img src="{{asset('images/delete-icon.png')}}" alt="" class="max-w-[35px]">
                        </button>
                </form>
            @else
                @foreach($menuItems as $item)
                    <p>
                        {{ $item->name }} x {{ $cart[$item->id]['quantity'] }}
                    </p>
                @endforeach

                <p class="mt-2 font-semibold">Total: ₱{{ $total }}</p>
            @endif
        </div>

        <button class="bg-green-600 text-white px-6 py-2 rounded">
            Confirm Booking
        </button>

    </form>

</div>

@endsection