@extends('layouts.user_pages')

@section('title', 'Inquiries')

@section('user_pages')

<div class="lg:min-h-[100vh] ">
    <div class="ml-3 mb-6 lg:hidden">
            <h1 class="text-[2em] font-bold mt-6 lg:text-[2.5em]">Inquiries</h1>
            <p class="text-dark-gray text-lg leading-none lg:text-[1.5em]">Manage your potential bookings.</p>
    </div>


    <div class="flex">
        <div class="w-1/3 border-r lg:bg-[#F5F3EC]  lg:pl-12 lg:min-h-[100vh] lg:max-h-[auto]">
            <div class="ml-3 mb-6 hidden lg:block">
                <h1 class="text-[2em] font-bold mt-6 lg:text-[2.5em]">Inquiries</h1>
                <p class="text-dark-gray text-lg leading-none lg:text-[1.5em]">Manage your potential bookings.</p>
            </div>
            @foreach($allInquiries as $inq)
                <a href="{{ route('user.inquiries', $inq->id) }}" 
                class="block p-3 border-b hover:bg-gray-100">

                    <div class="flex justify-between items-center">
                        <p class="text-sm">{{ $inq-> created_at->format('M d, Y')}}</p>
                        <div class="status-pill status-{{$inq->status}} lg:hidden"></div>
                        <p class="status-pill status-{{$inq->status}} hidden lg:block">{{$inq->status}}</p>
                    </div>

                    <strong>{{ $inq->sender->name }}</strong>
                    <p class="hidden lg:block text-light-green">{{$inq-> booking->event_type}}</p>

                    <p class="text-sm text-dark-gray truncate">
                        {{ $inq->message }}
                    </p> 

                </a>
            @endforeach
        </div>

        <div class="w-2/3 p-4 lg:mt-12 lg:pr-12">
            @if($selectedInquiry)
            @if($selectedInquiry && $selectedInquiry->booking)
                
                

                <div class="flex justify-between items-center mb-3">
                    <h2 class="text-[2em] font-semibold">{{$selectedInquiry->sender->name}}</h2> 
                    <p class="status-pill status-{{$selectedInquiry->status}}">{{$selectedInquiry->status}}</p>
                </div>
                <div class="lg:grid lg:grid-cols-3 gap-4 lg:mb-6 bg-white shadow-lg rounded-lg lg:bg-none lg:shadow-none mb-3">
                    <div class="lg:bg-white lg:shadow-lg lg:p-4 p-2 rounded-lg">
                        <p class="text-light-gray font-medium">EVENT TYPE</p>
                        <p class="text-[1.25em] text-dark-gray font-medium">{{$selectedInquiry->booking->event_type}}</p>
                    </div>
                    <div class="lg:bg-white lg:shadow-lg lg:p-4 p-2 rounded-lg">
                        <p class="text-light-gray font-medium">GUEST COUNT</p>
                        <p class="text-[1.25em] text-dark-gray font-medium">{{ $selectedInquiry->booking->guest_count }}</p>
                    </div>
                    <div class="lg:bg-white lg:shadow-lg lg:p-4 p-2 rounded-lg">
                        <p class="text-light-gray font-medium">EVENT DATE</p>
                        <p class="text-[1.25em] text-dark-gray font-medium">{{$selectedInquiry->booking->event_date}}</p>
                    </div>
                </div>
            @endif

                <!-- MAIN -->
                <div class="bg-gray-100 p-3 rounded mb-3">
                    <strong>{{ $selectedInquiry->sender->name }}</strong>
                    <small>{{$selectedInquiry-> created_at->format('M d, Y')}}</small>
                    <p>{{ $selectedInquiry->message }}</p>
                </div>

                <!-- REPLIES -->
                 <!-- REPLIES -->
                @foreach($selectedInquiry->replies as $reply)

                    @if($reply->sender->role === 'user')
                        <!-- ADMIN MESSAGE (RIGHT SIDE) -->
                        <div class="flex justify-end w-full">
                            <div class="bg-blue-100 border p-3 rounded mb-2 w-[70%]">
                                <div class="text-right">
                                    <strong>{{ $reply->sender->name }}</strong>
                                    <small class="block text-xs text-gray-500">
                                        {{ $reply->created_at->format('M d, Y') }}
                                    </small>
                                </div>
                                <p class="mt-1">{{ $reply->message }}</p>
                            </div>
                        </div>

                    @else
                        <!-- USER MESSAGE (LEFT SIDE) -->
                        <div class="flex justify-start w-full">
                            <div class="bg-gray-100 border p-3 rounded mb-2 w-[70%]">
                                <strong>{{ $reply->sender->name }}</strong>
                                <small class="block text-xs text-gray-500">
                                    {{ $reply->created_at->format('M d, Y') }}
                                </small>
                                <p class="mt-1">{{ $reply->message }}</p>
                            </div>
                        </div>

                    @endif

                @endforeach

                <!-- REPLY FORM -->
                <form action="{{ route('user.inquiries.reply', $selectedInquiry->id) }}" method="POST">
                    @csrf
                    <textarea name="message" class="w-full border p-2 rounded"></textarea>
                    <button class="bg-green-600 text-white px-4 py-2 mt-2 rounded">Send</button>
                </form>

            @else
                <p class="text-gray-500">Select an inquiry to view</p>
            @endif
        </div>
    </div>
    

    <div class="pb-[5em] lg:pb-3"></div>
</div>

@endsection