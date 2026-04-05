@extends('layouts.admin_pages')

@section('title', 'Management')

@section('admin_pages')

<div class="w-[90%] mx-auto lg:min-h-[100vh]">

    <div class="lg:flex lg:justify-between lg:items-center">
        <div class="">
            <h1 class="text-[2em] font-bold mt-6 lg:text-[2.5em]">Catering Items</h1>
            <p class="text-dark-gray text-lg leading-none lg:text-[1.5em]">Manage your collection of dishes, track seasonal pricing, and update visibility across your booking page</p>
        </div>

        <a href="" class="py-2 px-6 bg-light-green text-background rounded-lg hidden lg:block">+ Add New Item</a>
    </div>

    <!--CARDS -->
    <div class="bg-white shadow-lg p-4 rounded-lg mt-4 lg:bg-background lg:shadow-none lg:flex lg:justify-between lg:gap-6 lg:w-1/2">

        <div class="mb-6 w-full flex items-center gap-3 lg:bg-white lg:shadow-lg lg:p-4 lg:rounded-lg lg:flex-col lg:items-start lg:gap-[5em]">
            
            <div class="w-full flex justify-between">
                <div class="">
                    <h4 class="text-light-gray font-medium leading-none text-[1em]">TOTAL ITEMS</h4>
                    <p class="font-medium text-[1.5em]">{{$totalMenuItems}}</p>
                </div>
            </div>

        </div>

        <div class="mb-6 w-full flex items-center gap-3 lg:bg-white lg:shadow-lg lg:p-4 lg:rounded-lg lg:flex-col lg:items-start lg:gap-[5em]">
            
            <div class="w-full flex justify-between">
                <div class="">
                    <h4 class="text-light-gray font-medium leading-none text-[1em]">TOTAL BUNDLES CREATED</h4>
                    <p class="font-medium text-[1.5em]">8</p>
                </div>
            </div>

        </div>
    </div>
    
    <div class="flex justify-between items-end border-b border-dark-gray pb-2 mb-6">
        <h1 class="text-[2em] font-medium mt-6 lg:text-[2.5em] ">Menu</h1>
        <a href="{{ route('admin.menu') }}" class="text-dark-green font-medium">View All</a>
    </div>
    
    
    {{-- Success message --}}
    @if(session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <div class="items-container lg:grid lg:grid-cols-4 lg:gap-5">

        @forelse($menuItems as $item)
        <div class="item mb-6 bg-white rounded-xl shadow-lg overflow-hidden pb-4">
            <div class="top-row h-[250px] bg-red-300 flex justify-end">
                <p class="mr-4 mt-4 bg-light-gray text-white h-fit px-3 py-1 rounded-full">{{ $item->category->name ?? 'N/A' }}</p>
            </div>
            <div class="bot-row px-4">
                <h4 class="font-medium text-[1.5em] my-1">{{ $item->name }}</h4>
                <p class="font-medium text-dark-green mb-1 text-[1.25em]">P {{ $item->price }}</p>
                <p class="mb-4">{{ $item->description }}</p>
                <div class="flex justify-end">
                    <a href="{{ route('admin.menu.edit', $item->id) }}" class=""><img src="{{asset('images/edit-icon.png')}}" alt="" class="max-w-[40px]"></a>
                </div>
            </div>
        </div>
        @empty 
        <p class="text-center">No menu items yet.</p>
        @endforelse
      

    </div>

    <div class="flex justify-between items-end border-b border-dark-gray pb-2 mb-6">
        <h1 class="text-[2em] font-medium mt-6 lg:text-[2.5em] ">Bundles</h1>
        <a href="" class="text-dark-green font-medium">View All</a>
    </div>

    <div class="items-container lg:grid lg:grid-cols-4 lg:gap-5">

        <div class="item mb-6 bg-white rounded-xl shadow-lg overflow-hidden pb-4">
            <div class="top-row h-[250px] bg-red-300">
            </div>
            <div class="bot-row px-4">
                <h4 class="font-medium text-[1.5em] my-1">Classic Wedding Reception</h4>
                <p class="font-medium text-dark-green mb-1 text-[1.25em]">P 600.00/head</p>
                <p class="mb-4">Standard full course meal...</p>
                <div class="flex justify-end">
                    <a href="" class=""><img src="{{asset('images/inquiries-icon.png')}}" alt=""></a>
                </div>
            </div>
        </div>

        <div class="item mb-6 bg-white rounded-xl shadow-lg overflow-hidden pb-4">
            <div class="top-row h-[250px] bg-red-300">
            </div>
            <div class="bot-row px-4">
                <h4 class="font-medium text-[1.5em] my-1">Classic Wedding Reception</h4>
                <p class="font-medium text-dark-green mb-1 text-[1.25em]">P 600.00/head</p>
                <p class="mb-4">Standard full course meal...</p>
                <div class="flex justify-end">
                    <a href="" class=""><img src="{{asset('images/inquiries-icon.png')}}" alt=""></a>
                </div>
            </div>
        </div>

        <div class="item mb-6 bg-white rounded-xl shadow-lg overflow-hidden pb-4">
            <div class="top-row h-[250px] bg-red-300">
            </div>
            <div class="bot-row px-4">
                <h4 class="font-medium text-[1.5em] my-1">Classic Wedding Reception</h4>
                <p class="font-medium text-dark-green mb-1 text-[1.25em]">P 600.00/head</p>
                <p class="mb-4">Standard full course meal...</p>
                <div class="flex justify-end">
                    <a href="" class=""><img src="{{asset('images/inquiries-icon.png')}}" alt=""></a>
                </div>
            </div>
        </div>

        <div class="item mb-6 bg-white rounded-xl shadow-lg overflow-hidden pb-4">
            <div class="top-row h-[250px] bg-red-300">
            </div>
            <div class="bot-row px-4">
                <h4 class="font-medium text-[1.5em] my-1">Classic Wedding Reception</h4>
                <p class="font-medium text-dark-green mb-1 text-[1.25em]">P 600.00/head</p>
                <p class="mb-4">Standard full course meal...</p>
                <div class="flex justify-end">
                    <a href="" class=""><img src="{{asset('images/inquiries-icon.png')}}" alt=""></a>
                </div>
            </div>
        </div>

       

    </div>

    <div class="pb-[5em]"></div>
    
</div>
@endsection