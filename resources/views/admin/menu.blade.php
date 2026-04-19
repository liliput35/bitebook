@extends('layouts.admin_pages')

@section('title', 'Menu')

@section('admin_pages')

<div class="w-[90%] mx-auto lg:min-h-[100vh]">

    <div class="flex items-center gap-3 mt-12 lg:text-xl">
        <a href="{{route('admin.management')}}" class="font-medium text-dark-gray" >MANAGEMENT</a>
        <p> > </p>
        <a href="" class="font-medium text-light-green" >VIEW MENU</a>
    </div>

    <div class="lg:flex lg:justify-between lg:items-center">
        <div class="mb-6">
            <h1 class="text-[2em] font-bold lg:text-[2.5em]">Catering Items</h1>
            <p class="text-dark-gray text-lg leading-none lg:w-[75%]">Manage your collection of dishes, track seasonal pricing, and update visibility across your booking page</p>
        </div>

        <a href="{{ route('admin.management.addmenu')}}" class="py-2 px-6 bg-light-green text-background rounded-lg">+ Add New Item</a>
    </div>

    
    <div class="flex justify-between items-end border-b border-dark-gray pb-2 mb-6">
        <h1 class="text-[2em] font-medium mt-6 lg:text-[2.5em] ">Menu</h1>
        <p class="text-dark-green font-medium">Total Items: {{$totalMenuItems}}</p>
    </div>
    
    
    {{-- Success message --}}
    @if(session('success'))
        <p class="mb-4">{{ session('success') }}</p>
    @endif

    <div class="items-container lg:grid lg:grid-cols-4 lg:gap-5">

        @forelse($menuItems as $item)
        <div class="item mb-6 bg-white rounded-xl shadow-lg overflow-hidden pb-4">
            <div class="top-row h-[250px] bg-cover bg-center flex justify-end" style="background-image: url('{{ $item->image_url}}')">
                <p class="mr-4 mt-4 bg-light-gray text-white h-fit px-3 py-1 rounded-full">{{ $item->category->name ?? 'N/A' }}</p>
            </div>
            <div class="bot-row px-4">
                <h4 class="font-medium text-[1.5em] my-1 truncate">{{ $item->name }}</h4>
                <p class="font-medium text-dark-green mb-1 text-[1.25em]">P {{ $item->price }}</p>
                <p class="mb-4 truncate">{{ $item->description }}</p>
                <div class="flex justify-end">
                    <a href="{{ route('admin.menu.edit', $item->id) }}" class=""><img src="{{asset('images/edit-icon.png')}}" alt="" class="max-w-[40px]"></a>
                </div>
            </div>
        </div>
        @empty 
        <p class="text-center">No menu items yet.</p>
        @endforelse

    </div>

    <div class="pb-[5em] lg:pb-3"></div>
</div>

<!--
{{-- Success message --}} 
@if(session('success'))
    <p>{{ session('success') }}</p>
@endif

{{-- ADD MENU ITEM FORM --}}
<br>
<h2> <b>Add Menu Item</b></h2>
<form action="{{ route('admin.menu.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div>
        <label>Name</label>
        <input class="border" type="text" name="name" value="{{ old('name') }}" required>
        @error('name') <span>{{ $message }}</span> @enderror
    </div>
    <div>
        <label>Description</label>
        <textarea class="border"name="description">{{ old('description') }}</textarea>
    </div>
    <div>
        <label>Price</label>
        <input class="border" type="number" name="price" step="0.01" value="{{ old('price') }}" required>
        @error('price') <span>{{ $message }}</span> @enderror
    </div>
    <div>
        <label>Category</label>
        <select name="category_id" required>
            <option value="">-- Select Category --</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
        @error('category_id') <span>{{ $message }}</span> @enderror
    </div>
    <div>
        <label>Image</label>
        <button ><input type="file" name="image" accept="image/*"></button>
        @error('image') <span>{{ $message }}</span> @enderror
    </div>
    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" type="submit">Add Item</button>
</form>
<br>
{{-- MENU ITEMS LIST --}}
<h2>All Menu Items</h2>
<table border="1">
    <thead>
        <tr>
            <th>Name</th>
            <th>Description</th>
            <th>Price</th>
            <th>Category</th>
            <th>Image</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @forelse($menuItems as $item)
        <tr>
            <td>{{ $item->name }}</td>
            <td>{{ $item->description }}</td>
            <td>{{ $item->price }}</td>
            <td>{{ $item->category->name ?? 'N/A' }}</td>
            <td>
                @if($item->image)
                    <img src="{{ asset('storage/' . $item->image) }}" width="60">
                @else
                    No image
                @endif
            </td>
            <td>
                <a href="{{ route('admin.menu.edit', $item->id) }}">
                    <button type="button">Edit</button>
                </a>
                <form action="{{ route('admin.menu.destroy', $item->id) }}" method="POST"
                      onsubmit="return confirm('Delete this item?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="6">No menu items yet.</td>
        </tr>
        @endforelse
    </tbody>
</table>
-->
@endsection