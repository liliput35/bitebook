@extends('layouts.admin_pages')

@section('title', 'Bundles')

@section('admin_pages')

<div class="w-[90%] mx-auto lg:min-h-[100vh]">

    <div class="flex items-center gap-3 mt-12 lg:text-xl">
        <a href="{{route('admin.management')}}" class="font-medium text-dark-gray" >MANAGEMENT</a>
        <p> > </p>
        <a href="" class="font-medium text-light-green" >VIEW BUNDLES</a>
    </div>

    <div class="lg:flex lg:justify-between lg:items-center">
        <div class="mb-6">
            <h1 class="text-[2em] font-bold lg:text-[2.5em]">Catering Items</h1>
            <p class="text-dark-gray text-lg leading-none lg:w-[75%]">Manage your collection of dishes, track seasonal pricing, and update visibility across your booking page</p>
        </div>

        <a href="{{ route('admin.management.addbundle')}}" class="py-2 px-6 bg-light-green text-background rounded-lg">+ Add New Bundle</a>
    </div>

    
    <div class="flex justify-between items-end border-b border-dark-gray pb-2 mb-6">
        <h1 class="text-[2em] font-medium mt-6 lg:text-[2.5em] ">Bundles</h1>
        <p class="text-dark-green font-medium">Total Bundles: {{$totalBundles}}</p>
    </div>
    
    
    {{-- Success message --}}
    @if(session('success'))
        <p class="mb-4">{{ session('success') }}</p>
    @endif

    <div class="items-container lg:grid lg:grid-cols-4 lg:gap-5">

        @forelse($bundles as $bundle)
        <div class="item mb-6 bg-white rounded-xl shadow-lg overflow-hidden pb-4">
            <div class="top-row h-[250px] bg-red-300">
            </div>
            <div class="bot-row px-4">
                <h4 class="font-medium text-[1.5em] my-1 truncate">{{ $bundle->name }}</h4>
                <p class="font-medium text-dark-green mb-1 text-[1.25em]">P {{ $bundle->price_per_head }}/head</p>
                <p class="mb-4 truncate">{{ $bundle->description }}</p>
                <div class="flex justify-end">
                    <a href="{{ route('admin.bundles.edit', $bundle->id) }}" class=""><img src="{{asset('images/edit-icon.png')}}" alt="" class="max-w-[40px]"></a>
                </div>
            </div>
        </div>
        @empty 
        <p class="text-center">No bundles yet.</p>
        @endforelse

    </div>

    <div class="pb-[5em] lg:pb-3"></div>
</div>

@endsection