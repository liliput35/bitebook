@extends('layouts.admin_pages')

@section('title', 'Dashboard')

@section('admin_pages')



<div class="w-[90%] mx-auto lg:min-h-[100vh]">


    <div class="lg:flex lg:justify-between lg:items-center">
        <div class="">
            <h1 class="text-[2em] font-bold mt-6 lg:text-[2.5em]">Welcome back, Chef</h1>
            <p class="text-dark-gray text-lg leading-none lg:text-[1.5em]">Here is what's simmering in your kitchen today.</p>
        </div>

        <a href="{{route('admin.book')}}" class="py-2 px-6 bg-light-green text-background rounded-lg hidden lg:block">+ New Booking</a>
    </div>
    
    <!-- dashboard misc info -->
    <div class="bg-white shadow-lg p-4 rounded-lg mt-4 lg:bg-background lg:shadow-none lg:flex lg:justify-between lg:gap-6">

        <div class="mb-6 w-full flex items-center gap-3 lg:bg-white lg:shadow-lg lg:p-4 lg:rounded-lg lg:flex-col lg:items-start lg:gap-[5em]">
            <div class="desktop-icon-grp lg:flex lg:justify-between lg:w-full">
                <img src="{{asset('images/revenue-icon.png')}}" alt="" class="max-w-[30px]">
                <p class="font-medium text-light-green hidden lg:block"></p>

            </div>

            <div class="w-full flex justify-between">
                <div class="">
                    <h4 class="text-light-gray font-medium leading-none text-[1em]">TOTAL REVENUE</h4>
                    <p class="font-medium text-[1.5em]">₱{{ number_format($totalRevenue) }}</p>
                </div>

                <p class="font-medium text-light-green lg:hidden">+12%</p>
            </div>
        </div>
        <div class="mb-6 w-full flex items-center gap-3 lg:bg-white lg:shadow-lg lg:p-4 lg:rounded-lg lg:flex-col lg:items-start lg:gap-[5em]">
            <div class="desktop-icon-grp lg:flex lg:justify-between lg:w-full">
                <img src="{{asset('images/inquiries-icon.png')}}" alt="" class="max-w-[30px]">
                <p class="font-medium text-light-green hidden lg:block"></p>

            </div>

            <div class="w-full flex justify-between">
                <div class="">
                    <h4 class="text-light-gray font-medium leading-none text-[1em]">NEW INQUIRIES</h4>
                    <p class="font-medium text-[1.5em]">{{ $newInquiries }}</p>
                </div>

                <p class="font-medium text-light-green lg:hidden"></p>
            </div>
        </div>
        <div class="mb-6 w-full flex items-center gap-3 lg:bg-white lg:shadow-lg lg:p-4 lg:rounded-lg lg:flex-col lg:items-start lg:gap-[5em]">
            <div class="desktop-icon-grp lg:flex lg:justify-between lg:w-full">
                <img src="{{asset('images/bookings-icon.png')}}" alt="" class="max-w-[30px]">
                <p class="font-medium text-light-green hidden lg:block">This Month</p>

            </div>

            <div class="w-full flex justify-between">
                <div class="">
                    <h4 class="text-light-gray font-medium leading-none text-[1em]">UPCOMING BOOKINGS</h4>
                    <p class="font-medium text-[1.5em]">{{ $upcomingBookings }}</p>
                </div>

                <p class="font-medium text-light-green lg:hidden">This Month</p>
            </div>
        </div>
        <div class="mb-6 w-full flex items-center gap-3 lg:bg-white lg:shadow-lg lg:p-4 lg:rounded-lg lg:flex-col lg:items-start lg:gap-[5em]">
            <div class="desktop-icon-grp lg:flex lg:justify-between lg:w-full">
                <img src="{{asset('images/popular-icon.png')}}" alt="" class="max-w-[30px]">
                <p class="font-medium text-light-green hidden lg:block"></p>

            </div>

            <div class="w-full flex justify-between">
                <div class="">
                    <h4 class="text-light-gray font-medium leading-none text-[1em]">MOST POPULAR</h4>
                    <p class="font-medium text-[1.5em]">{{ $mostPopularItem ? $mostPopularItem->name : 'N/A' }}</p>
                </div>

                <p class="font-medium text-light-green lg:hidden"></p>
            </div>
        </div>

    </div>

    <div class="bottom-row lg:flex lg:gap-6">
        <!-- dashboard this week -->
        <div class="bg-white shadow-lg p-4 rounded-lg mt-4 lg:w-1/3">
            <h1 class="text-[1.75em] font-medium">This Week</h1> 

            <div class="event-group mt-4 relative before:content-[''] before:absolute before:left-0 before:top-0 before:w-1 before:h-full before:bg-dark-gray">

                @if($bookingsThisWeek->isEmpty())
                    <p class="ml-4">No events this week</p>
                @else 
                    @foreach($bookingsThisWeek as $booking)
                        <div class="event ml-6 mb-6 relative after:content[''] after:h-4 after:w-4 after:bg-dark-green after:left-[-1.85rem] after:top-0 after:absolute after:rounded-full lg:mb-12">
                            <p class="text-[1em] font-medium text-dark-green leading-none">{{ $booking->event_date }}</p>
                            <h3 class="text-[1.5em] font-medium">{{ $booking->event_type }}</h3>
                            <p class="text-dark-gray leading-none">{{ $booking->guest_count }} guests</p>
                        </div>
                    @endforeach
                @endif

            </div>
        </div>

        <!--dashboard recent inquires -->
        <div class="bg-white shadow-lg p-4 rounded-lg mt-4 lg:order-first lg:w-2/3">
            <h1 class="text-[1.75em] font-medium">Recent Inquires</h1> 

            <div class="recent-inquiries mt-4">
                <table class="w-full border-separate border-spacing-y-4 lg:border-spacing-y-0">
                    <thead class="hidden lg:table-header-group">
                        <tr class="text-left text-dark-gray text-[1em] font-medium uppercase">
                            <th class="px-4 pb-2">Event Type</th>
                            <th class="px-4 pb-2">Customer</th>
                            <th class="px-4 pb-2">Date</th>
                            <th class="px-4 pb-2">Status</th>
                            <th class="px-4 pb-2">Action</th>
                        </tr>
                    </thead>

                    <tbody class="block lg:table-row-group">
                        @if($recentInquiries->isEmpty())
                            <p>No inquiries</p>
                        @else
                            @foreach($recentInquiries as $inquiry)
                                <tr class="block lg:table-row mb-10 lg:mb-0 bg-white lg:bg-transparent rounded-2xl p-6 lg:p-0 shadow-sm lg:shadow-none border border-gray-100 lg:border-none">
                                    
                                    <td class="block lg:table-cell px-0 lg:px-4 lg:py-4">
                                        <div class="flex items-center gap-4">
                                            <h3 class="text-[1.5em] lg:text-[1.25em] text-dark-green lg:text-biteblack lg:font-normal font-medium">{{ $inquiry->booking->event_type ?? 'N/A' }}</h3>
                                            <a href="" class="lg:hidden"><img src="{{asset('images/view-icon.png')}}" class="max-w-[20px]" alt=""></a>
                                        </div>
                                    </td>

                                    <td class="block lg:table-cell px-0 lg:px-4 py-2 lg:py-4">
                                        <p class="lg:hidden text-[0.75em] text-dark-gray font-medium uppercase">Customer</p>
                                        <h4 class="text-[1em] font-medium lg:font-normal lg:text-[1.25em] lg:text-dark-gray">{{ $inquiry->sender->name ?? 'N/A' }}</h4>
                                    </td>

                        
                                    <td class="inline-block lg:table-cell px-0 lg:px-4 py-2 lg:py-4 mr-8 lg:mr-0">
                                        <p class="lg:hidden text-[0.75em] text-dark-gray font-medium uppercase">Date</p>
                                        <h4 class="text-[1em] font-medium lg:font-normal lg:text-[1.25em] lg:text-dark-gray">{{ $inquiry->created_at->format('M d, Y') ?? 'N/A' }}</h4>
                                    </td>

                                    <td class="inline-block lg:table-cell px-0 lg:px-4 py-2 lg:py-4">
                                        <p class="lg:hidden text-[0.75em] text-dark-gray font-medium uppercase mb-1">Status</p>
                                        <span class="status-pill 
                                            @if($inquiry->status === 'new') status-new 
                                            @elseif($inquiry->status === 'confirmed') status-confirmed 
                                            @elseif($inquiry->status === 'responded') status-responded 
                                            @endif
                                            lg:text-[1em]">

                                            {{ strtoupper($inquiry->status) }}
                                        </span>
                                    </td>

                                    <td class="hidden lg:table-cell px-4 py-4 text-left">
                                        <a href="{{ route('admin.inquiries', $inquiry->id) }}"><img src="{{asset('images/view-icon.png')}}" class="max-w-[25px]" alt="View"></a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        
                        </tbody>
                </table>
            </div>
        
        </div> 
    </div>

    <div class="pb-[5em] lg:pb-3"></div>
    
</div>


@endsection