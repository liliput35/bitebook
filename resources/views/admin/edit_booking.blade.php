@extends('layouts.admin_pages')

@section('title', 'Edit Booking')

@section('admin_pages')

<div class="w-[90%] mx-auto">

    <h1 class="text-2xl font-bold mt-6">Edit Booking</h1>

    @if(session('error'))
        <div class="bg-red-100 text-red-700 p-2 rounded my-4">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('admin.bookings.update', $booking->id) }}" method="POST">
        @csrf

        <!-- BOOKING DETAILS -->
        <div class="bg-white shadow p-4 rounded mt-4">
            <input type="text" name="event_type" value="{{ $booking->event_type }}" class="border p-2 w-full mb-2">
            <input type="date" name="event_date" value="{{ $booking->event_date }}" class="border p-2 w-full mb-2">
            <input type="number" name="guest_count" value="{{ $booking->guest_count }}" class="border p-2 w-full mb-2">
            <input type="text" name="venue" value="{{ $booking->venue }}" class="border p-2 w-full">
        </div>

        <!-- FROM HERE -->
        <!-- EXISTING ITEMS -->
        <div class="bg-white shadow-lg rounded-xl p-4 mt-4">
            <p class="font-medium text-light-gray mb-2">CURRENT MENU</p>

            <!-- IF BUNDLE -->
            @if($booking->bundle)

                <div class="">
                    <h1 class="text-2xl font-bold mb-4">
                        Edit Bundle: {{ $bundle->name }}
                    </h1>

                    @foreach($bundle->requirements as $req)
                        <div class="mb-6 ">

                            <h2 class="font-bold mb-2">
                                Select {{ $req->required_quantity }} from {{ $req->category->name }}
                            </h2>

                            <div class="grid grid-cols-2 gap-2">
                                @foreach($req->category->menuItems as $item)

                                    <label class="border p-2 flex items-center gap-2 rounded">
                                        <input type="checkbox"
                                            name="selections[{{ $req->category_id }}][]"
                                            value="{{ $item->id }}"
                                            {{ in_array($item->id, $existingSelections[$req->category_id] ?? []) ? 'checked' : '' }}>
                                        {{ $item->name }}
                                    </label>

                                @endforeach
                            </div>

                        </div>
                    @endforeach
                </div>

            <!-- ELSE (CUSTOM MENU) -->
            @else

                @foreach($booking->items as $item)
                    <div class="flex gap-2 mb-2">
                        <span class="w-1/2 p-2 bg-gray-100 rounded">
                            {{ $item->menuItem->name }}
                        </span>

                        <input type="number"
                            name="existing_items[{{ $item->id }}][quantity]"
                            value="{{ $item->quantity }}"
                            class="border p-2 w-1/4">

                        <label class="flex items-center">
                            <input type="checkbox" name="existing_items[{{ $item->id }}][delete]">
                            <span class="ml-1 text-red-500">Remove</span>
                        </label>
                    </div>
                @endforeach

                <!-- ADD NEW ITEMS -->
                <div class="bg-white shadow-lg rounded-xl p-4 mt-4">
                    <p class="font-medium text-light-gray">ADD MENU ITEMS</p>

                    <div id="items-container">
                        <div class="flex gap-2 mb-2 item-row">
                            <select name="new_items[0][menu_item_id]" class="border p-2 w-1/2">
                                <option value="">Select Item</option>
                                @foreach($menuItems as $menu)
                                    <option value="{{ $menu->id }}">{{ $menu->name }}</option>
                                @endforeach
                            </select>

                            <input type="number" name="new_items[0][quantity]" class="border p-2 w-1/4" placeholder="Qty">

                            <button type="button" class="booking-remove-row bg-red-500 text-white px-3 rounded">X</button>
                        </div>
                    </div>

                    <button type="button" id="booking-add-row" class="bg-light-green text-white px-4 py-2 rounded">
                        + Add Item
                    </button>
                </div>
            @endif
        </div>

        
        <!-- TO HERE -->


        <button class="bg-dark-green text-white px-6 py-2 rounded mt-4">
            Save Changes
        </button>

    </form>

    <div class="lg:pb-[2em] pb-[5em]"></div>
</div>

@endsection 

