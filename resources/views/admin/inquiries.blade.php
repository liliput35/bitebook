@extends('layouts.admin_pages')

@section('title', 'Inquiries')

@section('admin_pages')

<div class="w-[90%] mx-auto lg:min-h-[100vh]">

    <div class="flex">
        <div class="w-1/3 border-r">
            @foreach($allInquiries as $inq)
                <a href="{{ route('admin.inquiries', $inq->id) }}" 
                class="block p-3 border-b hover:bg-gray-100">

                    <strong>{{ $inq->sender->name }}</strong>
                    <p class="text-sm text-gray-600 truncate">
                        {{ $inq->message }}
                    </p>
                </a>
            @endforeach
        </div>

        <div class="w-2/3 p-4">
            @if($selectedInquiry)
            @if($selectedInquiry && $selectedInquiry->booking)
                <div class="bg-blue-50 p-4 rounded mb-4">
                    <p><strong>Booking ID:</strong> {{ $selectedInquiry->booking->id }}</p>
                    <p><strong>Event Date:</strong> {{ $selectedInquiry->booking->event_date }}</p>
                    <p><strong>Guests:</strong> {{ $selectedInquiry->booking->guest_count }}</p>

                    @if($selectedInquiry->booking->bundle)
                        <p><strong>Bundle:</strong> {{ $selectedInquiry->booking->bundle->name }}</p>
                    @endif

                    <p><strong>Status:</strong> {{ $selectedInquiry->booking->status }}</p>
                </div>
            @endif

                <!-- MAIN -->
                <div class="bg-gray-100 p-3 rounded mb-3">
                    <strong>{{ $selectedInquiry->sender->name }}</strong>
                    <p>{{ $selectedInquiry->message }}</p>
                </div>

                <!-- REPLIES -->
                @foreach($selectedInquiry->replies as $reply)
                    <div class="ml-6 bg-white border p-3 rounded mb-2">
                        <strong>{{ $reply->sender->name }}</strong>
                        <p>{{ $reply->message }}</p>
                    </div>
                @endforeach

                <!-- REPLY FORM -->
                <form action="{{ route('inquiries.reply', $selectedInquiry->id) }}" method="POST">
                    @csrf
                    <textarea name="message" class="w-full border p-2 rounded"></textarea>
                    <button class="bg-green-600 text-white px-4 py-2 mt-2 rounded">Send</button>
                </form>

            @else
                <p class="text-gray-500">Select an inquiry to view</p>
            @endif
        </div>
    </div>
    

    <div class="pb-[5em] lg:pb-0"></div>
</div>

@endsection