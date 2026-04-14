@extends('layouts.admin_pages')

@section('title', 'Edit Item')

@section('admin_pages')

<div class="w-[90%] mx-auto lg:min-h-[100vh]">

    <div class="flex items-center gap-3 mt-12 lg:text-xl">
        <a href="{{route('admin.management')}}" class="font-medium text-dark-gray" >MANAGEMENT</a>
        <p> > </p>
        <a href="{{route('admin.menu')}}" class="font-medium text-dark-gray" >VIEW MENU</a>
        <p> > </p>
        <a href="" class="font-medium text-light-green" >EDIT MENU ITEM</a>
    </div>

    <h1 class="text-[2em] font-bold lg:text-[2.5em] mb-6">{{$menuItem->name}}</h1>

    

    {{-- ADD MENU ITEM FORM --}}
    <form action="{{ route('admin.menu.update', $menuItem->id) }}" method="POST" enctype="multipart/form-data">
        <div class="lg:flex lg:justify-between gap-6">
            @csrf
            @method('PUT')

            <div class="bg-white shadow-lg rounded-xl p-4 lg:w-[60%]">
                <div class="mb-2">
                    <label class="font-medium text-light-gray">DISH NAME</label><br>
                    <input class="border border-light-gray rounded-lg w-full p-2" type="text" name="name" value="{{ old('name', $menuItem->name) }}" required>
                    @error('name') <span>{{ $message }}</span> @enderror
                </div>

                <div class="mb-2">
                    <label class="font-medium text-light-gray">DESCRIPTION</label><br>
                    <textarea class="border border-light-gray rounded-lg w-full p-2" name="description">{{ old('description', $menuItem->description) }}</textarea>
                </div>
                
                <div class="lg:flex lg:justify-between lg:gap-4">
                    <div class="mb-2 lg:w-1/2">
                        <label class="font-medium text-light-gray">CATEGORY</label><br>
                        <select name="category_id" required class="border border-light-gray p-2 rounded-lg lg:w-full">
                            <option value="">-- Select Category --</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ $menuItem->category_id == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id') <span>{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-2 lg:w-1/2">
                        <label class="font-medium text-light-gray">PRICE</label><br>
                        <input class="border border-light-gray rounded-lg p-2 lg:w-full" type="number" name="price" step="0.01" value="{{ old('price', $menuItem->price) }}" required>
                        @error('price') <span>{{ $message }}</span> @enderror
                    </div> 
                </div> 

                <div class="mb-2">
                    <label class="font-medium text-light-gray">ACTIVE</label>
                    <input type="checkbox" name="is_active" {{ $menuItem->is_active ? 'checked' : '' }}>
                </div>
                
                <div class="flex gap-4 items-center mt-4">
                    <a href="{{ route('admin.menu') }}" class="py-2 px-4 rounded lg:block hidden border border-dark-green">Cancel</a>
                    <button class="bg-dark-green text-white font-medium py-2 px-4 rounded lg:block hidden" type="submit">Save</button>
                </div>
                
            </div>

            <div class="bg-white shadow-lg rounded-xl p-4 mt-4 lg:w-[40%] lg:order-first">
                <label class="font-medium text-light-gray">PHOTO</label><br>
                <input type="file" name="image" accept="image/*" class="border border-dashed border-dark-green w-full bg-light-green text-white p-10 rounded-xl lg:h-[70%]">

                @error('image') <span>{{ $message }}</span> @enderror
            </div>

            <a href="{{ route('admin.menu') }}" class="py-2 px-4 rounded lg:hidden mr-3 border border-dark-green">Cancel</a>
            <button class="bg-dark-green text-white font-medium mt-4 py-2 px-4 rounded lg:hidden" type="submit">Save</button>
        </div>

    </form>

    <form action="{{ route('admin.menu.destroy', $menuItem->id) }}" method="POST"
                      onsubmit="return confirm('Delete this item?')">
                    @csrf
                    @method('DELETE')
                    <div class="flex justify-end">
                        <button type="submit"><img src="{{asset('images/delete-icon.png')}}" alt="" class="max-w-[40px] mt-4"></button>
                    </div>
    </form>
    
    <div class="pb-[5em] lg:pb-0"></div>
</div>

<!--
@if($errors->any())
    <ul>
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

<form action="{{ route('admin.menu.update', $menuItem->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div>
        <label>Name</label>
        <input class="border" type="text" name="name" value="{{ old('name', $menuItem->name) }}" required>
    </div>
    <div>
        <label>Description</label>
        <textarea class="border" name="description">{{ old('description', $menuItem->description) }}</textarea>
    </div>
    <div>
        <label>Price</label>
        <input class="border" type="number" name="price" step="0.01" value="{{ old('price', $menuItem->price) }}" required>
    </div>
    <div>
        <label>Category</label>
        <select name="category_id" required>
            <option value="">-- Select Category --</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ $menuItem->category_id == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
    </div>
    <div>
        <label>Image</label>
        @if($menuItem->image)
            <img src="{{ asset('storage/' . $menuItem->image) }}" width="80">
        @endif
        <input type="file" name="image" accept="image/*">
    </div>
    <div>
        <label>Active</label>
        <input type="checkbox" name="is_active" {{ $menuItem->is_active ? 'checked' : '' }}>
    </div>

    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" type="submit">Update Item</button>
    <a href="{{ route('admin.menu') }}">Cancel</a>
</form>
-->
@endsection