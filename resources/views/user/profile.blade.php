@extends('layouts.user_pages')

@section('title', 'Profile')

@section('user_pages')

    <div class="w-[90%] mx-auto lg:min-h-[100vh]">
        
        <div class="lg:flex lg:justify-between lg:items-center">
            <div class="">
                <h1 class="text-[2em] font-bold mt-6 lg:text-[2.5em]">Profile Settings</h1>
                <p class="text-dark-gray text-lg leading-none lg:text-[1.5em] mb-6">Manage your catering’s brand public and operational identity</p>


            </div>

        </div>

        <div class="lg:flex lg:gap-6">
            {{-- BUSINESS INFO CARD --}}
            <div class="bg-white shadow-lg p-4 rounded-lg lg:order-first lg:w-2/3">
                <h1 class="text-[1.50rem] font-bold text-dark-green">PERSONAL INFORMATION</h1>

                <div class="lg:flex lg:gap-6">
                    <div class="mb-2 lg:w-1/2">
                        <label class="font-medium text-light-gray">First Name</label><br>
                        <input class="border border-light-gray rounded-lg w-full p-2" type="text" name="company_name" value="Rolenz" required>
                        @error('name') <span>{{ $message }}</span> @enderror
                    </div>
                    
                    <div class="mb-2 lg:w-1/2">
                        <label class="font-medium text-light-gray">Last Name</label><br>
                        <input class="border border-light-gray rounded-lg p-2 lg:w-full" type="text" name="contact_person" value="Ciocon" required>
                        @error('price') <span>{{ $message }}</span> @enderror
                    </div> 
                </div>

                <div class="mb-2 lg:w-1/2">
                    <label class="font-medium text-light-gray">Personal Email</label><br>
                    <input class="border border-light-gray rounded-lg p-2 lg:w-full" type="text" name="personal_email" value="rolenz@gmail.com"required>
                    @error('price') <span>{{ $message }}</span> @enderror
                </div>           
                
                <div class="mb-2 lg:w-1/2">
                    <label class="font-medium text-light-gray">Password</label><br>
                    <input class="border border-light-gray rounded-lg p-2 lg:w-full" type="text" name="password" value="meow" required>
                    @error('price') <span>{{ $message }}</span> @enderror
                </div>                    
            
            </div>
            
            {{-- ADMIN INFO CARD --}}
            <div class="bg-white shadow-lg p-4 rounded-lg lg:w-1/3">
                <h1 class="text-[1.50rem] font-bold text-dark-green">ORDER HISTORY</h1>


            </div>

        </div>

    </div>

@endsection