@extends('layouts.user_pages')

@section('title', 'Profile')

@section('user_pages')

    <div class="w-[90%] mx-auto lg:min-h-[70vh]">
        
        <div class="lg:flex lg:justify-between lg:items-center">
            <div class="">
                <h1 class="text-[2em] font-bold mt-6 lg:text-[2.5em]">Profile Settings</h1>
                <p class="text-dark-gray text-lg leading-none lg:text-[1.5em] mb-6">Manage your catering’s brand public and operational identity</p>


            </div>

        </div>

        <form method="POST" action="{{ route('user.profile.update') }}">
            @csrf
            @method('PUT')

            <div class="lg:flex lg:gap-6">
                {{-- USER INFO CARD --}}
                <div class="bg-white shadow-lg p-4 rounded-lg lg:order-first lg:w-2/3" id="userFields">
                    <div class="flex justify-between items-center mb-2">
                        <h1 class="text-[1.50rem] font-bold text-dark-green">PERSONAL INFORMATION</h1>
                    
                        <button type="button" onclick="toggleEdit('user')" id="userBtn">
                            <img src="{{asset('images/black-edit-icon.png')}}" alt="" class="max-w-[40px] mt-4"> 
                        </button>

                    </div>

                    @php 
                        $parts = explode(' ', auth()->user()->name, 2);
                    @endphp

                    <div class="lg:flex lg:gap-6">
                        <div class="mb-2 lg:w-1/2">
                            <label class="font-medium text-light-gray">First Name</label><br>
                            <input disabled class="input-field border border-light-gray rounded-lg w-full p-2" type="text" name="first_name" value="{{ $parts[0] ?? '' }}">
                            @error('name') <span>{{ $message }}</span> @enderror
                        </div>
                        
                        <div class="mb-2 lg:w-1/2">
                            <label class="font-medium text-light-gray">Last Name</label><br>
                            <input disabled class="input-field border border-light-gray rounded-lg p-2 lg:w-full" type="text" name="last_name" value="{{ $parts[1] ?? '' }}">
                            @error('price') <span>{{ $message }}</span> @enderror
                        </div> 
                    </div>

                    <div class="mb-2 lg:w-1/2">
                        <label class="font-medium text-light-gray">Username</label><br>
                        <input disabled class="input-field border border-light-gray rounded-lg p-2 lg:w-full" type="text" name="username" value="{{ auth()->user()->username}}">
                        @error('price') <span>{{ $message }}</span> @enderror
                    </div>           
                    
                    <div class="mb-2 lg:w-1/2">
                        <label class="font-medium text-light-gray">Password</label><br>
                        <input disabled class="input-field border border-light-gray rounded-lg p-2 lg:w-full" type="password" name="password" value="******">
                        @error('price') <span>{{ $message }}</span> @enderror
                    </div>                    
                
                </div>
                
                {{-- ORDER HISTORY CARD --}}
                <div class="bg-white shadow-lg p-4 rounded-lg lg:w-1/3">
                    <h1 class="text-[1.50rem] font-bold text-dark-green pb-4">ORDER HISTORY</h1>

                    @forelse($bookings as $booking)
                        <a href="{{ route('user.bookings.show', $booking->id) }}">
                        <div class="flex justify-between items-start border-b py-2">

                            <div>
                                <p class="font-medium text-biteblack">
                                    {{ $booking->event_type }}
                                </p>

                                <p class="text-sm text-dark-green-500">
                                    {{ \Carbon\Carbon::parse($booking->event_date)->format('M d, Y') }}
                                </p>
                            </div>

                            @php
                                $deliveryFee = 500;
                                $total = 0 + $deliveryFee;

                                foreach ($booking->items as $item) {
                                    $total += $item->price * $item->quantity;
                                }

                                if ($booking->bundle) {
                                    $total = $booking->bundle->price_per_head * $booking->guest_count + 500 ;
                                }

                            @endphp

                            <div class="text-right">
                                <p class="font-medium text-dark-green">
                                    ₱ {{ number_format($total, 2) }}
                                </p>
                            </div>
                        </div>

                    @empty

                        <p class="font-medium text-dark-gray"></p>

                    @endforelse

                </div>
            </div>

        </form>

    </div>

        <div class="pb-[5em] lg:pb-0"></div>

    </div>

@endsection