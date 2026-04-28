@extends('layouts.admin_pages')

@section('title', 'Create Booking')

@section('admin_pages')

<div class="w-[90%] mx-auto pb-[5em] lg:pb-[2em]">

    <h1 class="text-2xl font-bold mt-6">New Booking</h1>

    @if(session('error'))
        <div class="bg-red-100 text-red-700 p-2 rounded mt-2">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('admin.book.store') }}" method="POST">
        @csrf

        <!-- MODE SELECT -->
        <div class="bg-white shadow p-4 rounded mt-4">
            <label class="font-medium">Select Type</label>
            <select id="mode" class="border p-2 w-full mt-2">
                <option value="custom">Custom Menu</option>
                <option value="bundle">Bundle</option>
            </select>
        </div>

        <!-- BOOKING DETAILS -->
        <div class="bg-white shadow p-4 rounded mt-4">
            <input type="text" name="event_type" placeholder="Event Type" class="border p-2 w-full mb-2">
            <input type="date" name="event_date" class="border p-2 w-full mb-2" min="{{ date('Y-m-d') }}" value="{{ date('Y-m-d') }}">
            <input type="number" name="guest_count" id="guest_count" placeholder="Guest Count" class="border p-2 w-full mb-2" min="1">
            <input type="text" name="venue" placeholder="Venue" class="border p-2 w-full">
        </div>

        <!-- ================= CUSTOM MENU ================= -->
        <div id="custom-section" class="bg-white shadow-lg rounded-xl p-4 mt-4">
            <p class="font-medium text-light-gray">ADD MENU ITEMS</p>

            <div id="items-container">
                <div class="flex gap-2 mb-2 item-row">
                    <select name="new_items[0][menu_item_id]" class="border p-2 w-1/2">
                        <option value="">Select Item</option>
                        @foreach($menuItems as $menu)
                            <option value="{{ $menu->id }}">{{ $menu->name }}</option>
                        @endforeach
                    </select>

                    <input type="number" name="new_items[0][quantity]" class="border p-2 w-1/4" placeholder="Qty" min="1">

                    <button type="button" class="booking-remove-row bg-red-500 text-white px-3 rounded">X</button>
                </div>
            </div>

            <button type="button" id="booking-add-row" class="bg-light-green text-white px-4 py-2 rounded">
                + Add Item
            </button>
        </div>

        <!-- ================= BUNDLE ================= -->
        <div id="bundle-section" class="hidden bg-white shadow-lg rounded-xl p-4 mt-4">

            <label>Select Bundle</label>
            <select name="bundle_id" id="bundleSelect" class="border p-2 w-full mb-4">
                <option value="">Select Bundle</option>
                @foreach($bundles as $bundle)
                    <option value="{{ $bundle->id }}">{{ $bundle->name }}</option>
                @endforeach
            </select>

            @foreach($bundles as $bundle)
                <div class="bundle-box hidden" data-bundle="{{ $bundle->id }}">
                    @foreach($bundle->requirements as $req)

                        <div class="mb-4">
                            <p class="font-bold">
                                Select {{ $req->required_quantity }} from {{ $req->category->name }}
                            </p>

                            @foreach($req->category->menuItems as $item)
                                <label class="block">
                                    <input type="checkbox"
                                        name="selections[{{ $req->category_id }}][]"
                                        value="{{ $item->id }}">
                                    {{ $item->name }}
                                </label>
                            @endforeach
                        </div>

                    @endforeach
                </div>
            @endforeach

        </div>

        <!-- SUBMIT -->
        <button class="bg-dark-green text-white px-6 py-2 rounded mt-4">
            Create Booking
        </button>

    </form>

</div>

@endsection