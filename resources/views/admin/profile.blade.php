@extends('layouts.admin_pages')

@section('title', 'Profile')

@section('admin_pages')

    <div class="w-[90%] mx-auto lg:min-h-[80vh]">
        
        <div class="lg:flex lg:justify-between lg:items-center">
            <div class="">
                <h1 class="text-[2em] font-bold mt-6 lg:text-[2.5em]">Profile Settings</h1>
                <p class="text-dark-gray text-lg leading-none lg:text-[1.5em] mb-6">Manage your catering’s brand public and operational identity</p>


            </div>

        </div>

        <form method="POST" action="{{ route('admin.profile.update') }}" class="mb-6">
            @csrf
            @method('PUT')

            <div class="lg:flex lg:gap-6">
                {{-- BUSINESS INFO CARD --}}
                
                <div class="bg-white shadow-lg p-4 mt-6 rounded-lg lg:order-first lg:w-2/3" id="businessFields">
                    <div class="flex justify-between items-center mb-2">
                        <h1 class="text-[1.50rem] font-bold text-dark-green">BUSINESS DETAILS</h1>

                        <button type="button" onclick="toggleEdit('business')" id="businessBtn">
                            <img src="{{asset('images/black-edit-icon.png')}}" alt="" class="max-w-[40px] mt-4"> 
                        </button>
                    </div>

                    <div class="lg:flex lg:gap-6">
                        <div class="mb-2 lg:w-1/2">
                            <label class="font-medium text-light-gray">Company Name</label><br>
                            <input disabled class="input-field border border-light-gray rounded-lg w-full p-2" type="text" name="company_name" value="{{ $business->company_name ?? '' }}">
                            @error('name') <span>{{ $message }}</span> @enderror
                        </div>
                        
                        <div class="mb-2 lg:w-1/2">
                            <label class="font-medium text-light-gray">Contact Person</label><br>
                            <input disabled class="input-field border border-light-gray rounded-lg p-2 lg:w-full" type="text" name="contact_person" value="{{ $business->contact_person  ?? ''}}">
                            @error('price') <span>{{ $message }}</span> @enderror
                        </div> 
                    </div>


                    <div class="lg:flex lg:gap-6">                
                        <div class="mb-2 lg:w-1/2">
                            <label class="font-medium text-light-gray">Company Email</label><br>
                            <input disabled class="input-field border border-light-gray rounded-lg p-2 lg:w-full" type="text" name="company_email" value="{{ $business->company_email ?? '' }}">
                            @error('price') <span>{{ $message }}</span> @enderror
                        </div> 
                        
                        <div class="mb-2 lg:w-1/2">
                            <label class="font-medium text-light-gray">Company Contact Number</label><br>
                            <input disabled class="input-field border border-light-gray rounded-lg p-2 lg:w-full" type="text" name="company_contact_number" value="{{ $business->company_contact_number  ?? ''}}">
                            @error('price') <span>{{ $message }}</span> @enderror
                        </div> 
                    </div>  

                    <div class="mb-2 lg:w-1/2">
                        <label class="font-medium text-light-gray">Location</label><br>
                        <input disabled class="input-field border border-light-gray rounded-lg p-2 lg:w-full" type="text" name="location" value="{{ $business->location ?? ''}}" >
                        @error('price') <span>{{ $message }}</span> @enderror
                    </div>                     

                
                </div>

                
                {{-- ADMIN INFO CARD --}}
                <div class="bg-white shadow-lg p-4 mt-6 rounded-lg lg:w-1/3" id="adminFields">
                    <div class="flex justify-between items-center mb-2">
                        <h1 class="text-[1.50rem] font-bold text-dark-green">PERSONAL INFORMATION</h1>

                        <button type="button" onclick="toggleEdit('admin')" id="adminBtn">
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
                        <input disabled class="input-field border border-light-gray rounded-lg p-2 lg:w-full" type="password" placeholder="Leave blank to keep current password" name="password">
                        @error('price') <span>{{ $message }}</span> @enderror
                    </div>          

                </div>

            </div>
        </form>

        <a href="{{route('logout')}}" class="py-2 px-6 bg-light-green text-background rounded-lg">Logout</a>

        <div class="pb-[5em] lg:pb-0"></div>
    </div>


@endsection