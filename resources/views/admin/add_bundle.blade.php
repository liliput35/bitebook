@extends('layouts.admin_pages')

@section('title', 'Add Item')

@section('admin_pages')

<div class="w-[90%] mx-auto lg:min-h-[100vh]">

    <div class="flex items-center gap-3 mt-12 lg:text-xl">
        <a href="{{route('admin.management')}}" class="font-medium text-dark-gray" >MANAGEMENT</a>
        <p> > </p>
        <a href="{{route('admin.bundles')}}" class="font-medium text-dark-gray" >VIEW BUNDLES</a>
        <p> > </p>
        <a href="" class="font-medium text-light-green" >ADD BUNDLE</a>
    </div>

    <h1 class="text-[2em] font-bold lg:text-[2.5em] mb-6">Add New Bundle</h1>

    

    {{-- ADD BUNDLE FORM --}}
    <form action="{{ route('admin.bundles.store') }}" method="POST" enctype="multipart/form-data">
        <div class="lg:flex lg:justify-between gap-6">
            @csrf
            <div class="bg-white shadow-lg rounded-xl p-4 lg:w-[60%]">
                <div class="mb-2">
                    <label class="font-medium text-light-gray">BUNDLE NAME</label><br>
                    <input class="border border-light-gray rounded-lg w-full p-2" type="text" name="name" value="{{ old('name') }}" required>
                    @error('name') <span>{{ $message }}</span> @enderror
                </div>

                <div class="mb-2">
                    <label class="font-medium text-light-gray">DESCRIPTION</label><br>
                    <textarea class="border border-light-gray rounded-lg w-full p-2" name="description">{{ old('description') }}</textarea>
                </div>
                
                <div class="mb-2 lg:w-1/2">
                    <label class="font-medium text-light-gray">PRICE PER HEAD</label><br>
                    <input class="border border-light-gray rounded-lg p-2 lg:w-full" type="number" name="price_per_head" step="0.01" value="{{ old('price') }}" required>
                    @error('price') <span>{{ $message }}</span> @enderror
                </div> 
                

                <button class="bg-dark-green text-white font-medium mt-4 py-2 px-4 rounded lg:block hidden" type="submit">Add Bundle</button>
            </div>

            <div class="bg-white shadow-lg rounded-xl p-4 mt-4 lg:w-[40%] lg:order-first">
                <label class="font-medium text-light-gray">PHOTO</label><br>
                <input type="file" name="image" accept="image/*" class="border border-dashed border-dark-green w-full bg-light-green text-white p-10 rounded-xl lg:h-[70%]">

                @error('image') <span>{{ $message }}</span> @enderror
            </div>

            <div class="bg-white shadow-lg rounded-xl p-4 mt-4">
                <div id="requirements-container" class="">
                    <p class="font-medium text-light-gray">REQUIREMENTS</p>
                    <div class="flex gap-2 mb-2 requirement-row">
                        <select name="requirements[]" class="border p-2 rounded w-1/2">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>

                        <input type="number" name="quantities[]" class="border p-2 rounded w-1/4" placeholder="Qty">

                        <button type="button" class="remove-row bg-red-500 text-white px-3 rounded">X</button>
                    </div>

                </div>
                
                <button type="button" id="add-row" class="bg-light-green text-white px-4 py-2 rounded">
                    + Add Category
                </button>
            </div>
            

            <button class="bg-dark-green text-white font-medium mt-4 py-2 px-4 rounded lg:hidden" type="submit">Add Bundle</button>
        </div>

    </form>
    <br>
    
    <div class="pb-[5em] lg:pb-0"></div>
</div>

@endsection