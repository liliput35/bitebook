@extends('layouts.admin_pages')

@section('title', 'Profile')

@section('admin_pages')

    <div class="w-[90%] mx-auto lg:min-h-[70vh]">
        
        <div class="lg:flex lg:justify-between lg:items-center">
            <div class="">
                <h1 class="text-[2em] font-bold mt-6 lg:text-[2.5em]">Profile Settings</h1>
                <p class="text-dark-gray text-lg leading-none lg:text-[1.5em] mb-6">Manage your catering’s brand public and operational identity</p>


            </div>

        </div>

        <div class="lg:flex lg:gap-6">
            {{-- BUSINESS INFO CARD --}}
            <div class="bg-white shadow-lg p-4 mt-6 rounded-lg lg:order-first lg:w-2/3" id="businessFields">
                <div class="flex justify-between items-center mb-2">
                    <h1 class="text-[1.50rem] font-bold text-dark-green">BUSINESS DETAILS</h1>

                    <button onclick="toggleEdit('business')" id="businessBtn">
                        <img src="{{asset('images/black-edit-icon.png')}}" alt="" class="max-w-[40px] mt-4"> 
                    </button>
                </div>

                <div class="lg:flex lg:gap-6">
                    <div class="mb-2 lg:w-1/2">
                        <label class="font-medium text-light-gray">Company Name</label><br>
                        <input disabled class="input-field border border-light-gray rounded-lg w-full p-2" type="text" name="company_name" value="BiteBook" required>
                        @error('name') <span>{{ $message }}</span> @enderror
                    </div>
                    
                    <div class="mb-2 lg:w-1/2">
                        <label class="font-medium text-light-gray">Contact Person</label><br>
                        <input disabled class="input-field border border-light-gray rounded-lg p-2 lg:w-full" type="text" name="contact_person" value="Mike Wilson" required>
                        @error('price') <span>{{ $message }}</span> @enderror
                    </div> 
                </div>


                <div class="lg:flex lg:gap-6">                
                    <div class="mb-2 lg:w-1/2">
                        <label class="font-medium text-light-gray">Company Email</label><br>
                        <input disabled class="input-field border border-light-gray rounded-lg p-2 lg:w-full" type="text" name="company_email" value="bitebook@gmail.com"required>
                        @error('price') <span>{{ $message }}</span> @enderror
                    </div> 
                    
                    <div class="mb-2 lg:w-1/2">
                        <label class="font-medium text-light-gray">Company Contact Number</label><br>
                        <input disabled class="input-field border border-light-gray rounded-lg p-2 lg:w-full" type="text" name="company_contact_number" value="09-XXX-XXXX" required>
                        @error('price') <span>{{ $message }}</span> @enderror
                    </div> 
                </div>  

                <div class="mb-2 lg:w-1/2">
                    <label class="font-medium text-light-gray">PRICE PER HEAD</label><br>
                    <input disabled class="input-field border border-light-gray rounded-lg p-2 lg:w-full" type="text" name="price_per_head" required>
                    @error('price') <span>{{ $message }}</span> @enderror
                </div>                     
  
            
            </div>
            
            {{-- ADMIN INFO CARD --}}
            <div class="bg-white shadow-lg p-4 mt-6 rounded-lg lg:w-1/3" id="adminFields">
                <div class="flex justify-between items-center mb-2">
                    <h1 class="text-[1.50rem] font-bold text-dark-green">PERSONAL INFORMATION</h1>

                    <button onclick="toggleEdit('admin')" id="adminBtn">
                        <img src="{{asset('images/black-edit-icon.png')}}" alt="" class="max-w-[40px] mt-4"> 
                    </button>
                </div>

                <div class="lg:flex lg:gap-6">
                    <div class="mb-2 lg:w-1/2">
                        <label class="font-medium text-light-gray">First Name</label><br>
                        <input disabled class="input-field border border-light-gray rounded-lg w-full p-2" type="text" name="company_name" value="John" required>
                        @error('name') <span>{{ $message }}</span> @enderror
                    </div>
                    
                    <div class="mb-2 lg:w-1/2">
                        <label class="font-medium text-light-gray">Last Name</label><br>
                        <input disabled class="input-field border border-light-gray rounded-lg p-2 lg:w-full" type="text" name="contact_person" value="Doe" required>
                        @error('price') <span>{{ $message }}</span> @enderror
                    </div> 
                  
                </div>

                <div class="mb-2 lg:w-1/2">
                    <label class="font-medium text-light-gray">Personal Email</label><br>
                    <input disabled class="input-field border border-light-gray rounded-lg p-2 lg:w-full" type="text" name="contact_person" value="johndoe@gmail.com" required>
                    @error('price') <span>{{ $message }}</span> @enderror
                </div> 
                
                <div class="mb-2 lg:w-1/2">
                    <label class="font-medium text-light-gray">Password</label><br>
                    <input disabled class="input-field border border-light-gray rounded-lg p-2 lg:w-full" type="password" name="contact_person" value="meowmeow" required>
                    @error('price') <span>{{ $message }}</span> @enderror
                </div>          

            </div>

        </div>

        <div class="pb-[5em] lg:pb-0"></div>
    </div>


@endsection