@extends('layouts.admin_pages')

@section('title', 'Add Item')

@section('admin_pages')

<div class="w-[90%] mx-auto lg:min-h-[100vh]">

    <div class="flex items-center gap-3 mt-12 lg:text-xl">
        <a href="{{route('admin.management')}}" class="font-medium text-dark-gray" >MANAGEMENT</a>
        <p> > </p>
        <a href="{{route('admin.menu')}}" class="font-medium text-dark-gray" >VIEW MENU</a>
        <p> > </p>
        <a href="" class="font-medium text-light-green" >ADD MENU ITEM</a>
    </div>

    <h1 class="text-[2em] font-bold lg:text-[2.5em] mb-6">Add New Menu Item</h1>

    

    {{-- ADD MENU ITEM FORM --}}
    <form action="{{ route('admin.menu.store') }}" method="POST" enctype="multipart/form-data">
        <div class="lg:flex lg:justify-between gap-6">
            @csrf
            <div class="bg-white shadow-lg rounded-xl p-4 lg:w-[60%]">
                <div class="mb-2">
                    <label class="font-medium text-light-gray">DISH NAME</label><br>
                    <input class="border border-light-gray rounded-lg w-full p-2" type="text" name="name" value="{{ old('name') }}" required>
                    @error('name') <span>{{ $message }}</span> @enderror
                </div>

                <div class="mb-2">
                    <label class="font-medium text-light-gray">DESCRIPTION</label><br>
                    <textarea class="border border-light-gray rounded-lg w-full p-2" name="description">{{ old('description') }}</textarea>
                </div>
                
                <div class="lg:flex lg:justify-between lg:gap-4">
                    <div class="mb-2 lg:w-1/2">
                        <label class="font-medium text-light-gray">CATEGORY</label><br>
                        <select name="category_id" required class="border border-light-gray p-2 rounded-lg lg:w-full">
                            <option value="">-- Select Category --</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id') <span>{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-2 lg:w-1/2">
                        <label class="font-medium text-light-gray">PRICE</label><br>
                        <input class="border border-light-gray rounded-lg p-2 lg:w-full" type="number" name="price" step="0.01" value="{{ old('price') }}" required>
                        @error('price') <span>{{ $message }}</span> @enderror
                    </div> 
                </div>
                

                <button class="bg-dark-green text-white font-medium mt-4 py-2 px-4 rounded lg:block hidden" type="submit">Add Item</button>
            </div>

            <div class="bg-white shadow-lg rounded-xl p-4 mt-4 lg:w-[40%] lg:order-first">
                <label class="font-medium text-light-gray">PHOTO</label><br>
                <input type="file" name="image" accept="image/*" class="border border-dashed border-dark-green w-full bg-light-green text-white p-10 rounded-xl lg:h-[70%]">

                @error('image') <span>{{ $message }}</span> @enderror
            </div>

            <button class="bg-dark-green text-white font-medium mt-4 py-2 px-4 rounded lg:hidden" type="submit">Add Item</button>
        </div>

    </form>
    <br>
    
</div>

@endsection