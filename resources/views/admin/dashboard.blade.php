@extends('layouts.admin_pages')

@section('title', 'Dashboard')

@section('admin_pages')

<div class="bg-dark-green py-4 flex justify-center lg:hidden">
    <img src="{{asset('images/logo.png')}}" alt="" class="max-w-[85px]">
</div>

<div class="w-[90%] mx-auto lg:min-h-[100vh]">


    <div class="lg:flex lg:justify-between lg:items-center">
        <div class="">
            <h1 class="text-[2em] font-bold mt-6 lg:text-[2.5em]">Welcome back, Chef</h1>
            <p class="text-dark-gray text-lg leading-none lg:text-[1.5em]">Here is what's simmering in your kitchen today.</p>
        </div>

        <a href="" class="py-2 px-6 bg-light-green text-background rounded-lg hidden lg:block">+ New Booking</a>
    </div>
    
    <!-- dashboard misc info -->
    <div class="bg-white shadow-lg p-4 rounded-lg mt-4 lg:bg-background lg:shadow-none lg:flex lg:justify-between lg:gap-6">

        <div class="mb-6 w-full flex items-center gap-3 lg:bg-white lg:shadow-lg lg:p-4 lg:rounded-lg lg:flex-col lg:items-start lg:gap-[5em]">
            <div class="desktop-icon-grp lg:flex lg:justify-between lg:w-full">
                <img src="{{asset('images/revenue-icon.png')}}" alt="" class="max-w-[30px]">
                <p class="font-medium text-light-green hidden lg:block">+12%</p>

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
                    <p class="font-medium text-[1.5em]">Birria Tray</p>
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
            
                <div class="event ml-6 mb-6 relative after:content[''] after:h-4 after:w-4 after:bg-dark-green after:left-[-1.85rem] after:top-0 after:absolute after:rounded-full lg:mb-12">
                    <p class="text-[1em] font-medium text-dark-green leading-none">TOMORROW, 6:00 PM</p>
                    <h3 class="text-[1.5em] font-medium">Venue Something</h3>
                    <p class="text-dark-gray leading-none">Wedding Reception</p>
                </div>
            
                <div class="event ml-6 mb-6 relative after:content[''] after:h-4 after:w-4 after:bg-dark-green after:left-[-1.85rem] after:top-0 after:absolute after:rounded-full lg:mb-12">
                    <p class="text-[1em] font-medium text-dark-green leading-none">TOMORROW, 6:00 PM</p>
                    <h3 class="text-[1.5em] font-medium">Venue Something</h3>
                    <p class="text-dark-gray leading-none">Wedding Reception</p>
                </div>
            

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
                        <tr class="block lg:table-row mb-10 lg:mb-0 bg-white lg:bg-transparent rounded-2xl p-6 lg:p-0 shadow-sm lg:shadow-none border border-gray-100 lg:border-none">
                            
                            <td class="block lg:table-cell px-0 lg:px-4 lg:py-4">
                                <div class="flex items-center gap-4">
                                    <h3 class="text-[1.5em] lg:text-[1.25em] text-dark-green lg:text-biteblack lg:font-normal font-medium">Birthday Catering</h3>
                                    <a href="" class="lg:hidden"><img src="{{asset('images/view-icon.png')}}" class="max-w-[20px]" alt=""></a>
                                </div>
                            </td>

                            <td class="block lg:table-cell px-0 lg:px-4 py-2 lg:py-4">
                                <p class="lg:hidden text-[0.75em] text-dark-gray font-medium uppercase">Customer</p>
                                <h4 class="text-[1em] font-medium lg:font-normal lg:text-[1.25em] lg:text-dark-gray">Michael Jordan</h4>
                            </td>

                
                            <td class="inline-block lg:table-cell px-0 lg:px-4 py-2 lg:py-4 mr-8 lg:mr-0">
                                <p class="lg:hidden text-[0.75em] text-dark-gray font-medium uppercase">Date</p>
                                <h4 class="text-[1em] font-medium lg:font-normal lg:text-[1.25em] lg:text-dark-gray">Apr 14, 2026</h4>
                            </td>

                            <td class="inline-block lg:table-cell px-0 lg:px-4 py-2 lg:py-4">
                                <p class="lg:hidden text-[0.75em] text-dark-gray font-medium uppercase mb-1">Status</p>
                                <span class="status-pill status-new lg:text-[1em]">NEW</span>
                            </td>

                            <td class="hidden lg:table-cell px-4 py-4 text-left">
                                <a href=""><img src="{{asset('images/view-icon.png')}}" class="max-w-[25px]" alt="View"></a>
                            </td>
                        </tr>
                        
                        <tr class="block lg:table-row mb-10 lg:mb-0 bg-white lg:bg-transparent rounded-2xl p-6 lg:p-0 shadow-sm lg:shadow-none border border-gray-100 lg:border-none">
                            
                            <td class="block lg:table-cell px-0 lg:px-4 lg:py-4">
                                <div class="flex items-center gap-4">
                                    <h3 class="text-[1.5em] lg:text-[1.25em] text-dark-green lg:text-biteblack lg:font-normal font-medium">Birthday Catering</h3>
                                    <a href="" class="lg:hidden"><img src="{{asset('images/view-icon.png')}}" class="max-w-[20px]" alt=""></a>
                                </div>
                            </td>

                            <td class="block lg:table-cell px-0 lg:px-4 py-2 lg:py-4">
                                <p class="lg:hidden text-[0.75em] text-dark-gray font-medium uppercase">Customer</p>
                                <h4 class="text-[1em] font-medium lg:font-normal lg:text-[1.25em] lg:text-dark-gray">Michael Jordan</h4>
                            </td>

                
                            <td class="inline-block lg:table-cell px-0 lg:px-4 py-2 lg:py-4 mr-8 lg:mr-0">
                                <p class="lg:hidden text-[0.75em] text-dark-gray font-medium uppercase">Date</p>
                                <h4 class="text-[1em] font-medium lg:font-normal lg:text-[1.25em] lg:text-dark-gray">Apr 14, 2026</h4>
                            </td>

                            <td class="inline-block lg:table-cell px-0 lg:px-4 py-2 lg:py-4">
                                <p class="lg:hidden text-[0.75em] text-dark-gray font-medium uppercase mb-1">Status</p>
                                <span class="status-pill status-confirmed lg:text-[1em]">CONFIRMED</span>
                            </td>

                            <td class="hidden lg:table-cell px-4 py-4 text-left">
                                <a href=""><img src="{{asset('images/view-icon.png')}}" class="max-w-[25px]" alt="View"></a>
                            </td>
                        </tr>
                        
                        <tr class="block lg:table-row mb-10 lg:mb-0 bg-white lg:bg-transparent rounded-2xl p-6 lg:p-0 shadow-sm lg:shadow-none border border-gray-100 lg:border-none">
                            
                            <td class="block lg:table-cell px-0 lg:px-4 lg:py-4">
                                <div class="flex items-center gap-4">
                                    <h3 class="text-[1.5em] lg:text-[1.25em] text-dark-green lg:text-biteblack lg:font-normal font-medium">Birthday Catering</h3>
                                    <a href="" class="lg:hidden"><img src="{{asset('images/view-icon.png')}}" class="max-w-[20px]" alt=""></a>
                                </div>
                            </td>

                            <td class="block lg:table-cell px-0 lg:px-4 py-2 lg:py-4">
                                <p class="lg:hidden text-[0.75em] text-dark-gray font-medium uppercase">Customer</p>
                                <h4 class="text-[1em] font-medium lg:font-normal lg:text-[1.25em] lg:text-dark-gray">Michael Jordan</h4>
                            </td>

                
                            <td class="inline-block lg:table-cell px-0 lg:px-4 py-2 lg:py-4 mr-8 lg:mr-0">
                                <p class="lg:hidden text-[0.75em] text-dark-gray font-medium uppercase">Date</p>
                                <h4 class="text-[1em] font-medium lg:font-normal lg:text-[1.25em] lg:text-dark-gray">Apr 14, 2026</h4>
                            </td>

                            <td class="inline-block lg:table-cell px-0 lg:px-4 py-2 lg:py-4">
                                <p class="lg:hidden text-[0.75em] text-dark-gray font-medium uppercase mb-1">Status</p>
                                <span class="status-pill status-responded lg:text-[1em]">RESPONDED</span>
                            </td>

                            <td class="hidden lg:table-cell px-4 py-4 text-left">
                                <a href=""><img src="{{asset('images/view-icon.png')}}" class="max-w-[25px]" alt="View"></a>
                            </td>
                        </tr>
                        
                        </tbody>
                </table>
            </div>
        
        </div> 
    </div>
    
</div>


@endsection