@extends('layouts.admin_pages')

@section('title', 'Edit Booking Bundle')

@section('admin_pages')

<div class="w-[90%] mx-auto pt-6 lg:w-1/2">

    <h1 class="text-2xl font-bold mb-4">
        Edit Bundle: {{ $bundle->name }}
    </h1>

    @if(session('error'))
        <div class="bg-red-100 text-red-700 p-2 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('admin.booking.bundle.update', $booking->id) }}" method="POST">
        @csrf

        @foreach($bundle->requirements as $req)
            <div class="mb-6 bg-white shadow p-4 rounded">

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

        <button class="bg-dark-green text-white px-6 py-2 rounded">
            Save Changes
        </button>
    </form>

</div>

@endsection