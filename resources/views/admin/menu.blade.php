@extends('layouts.content')

@section('title', 'Menu')

@section('content')
<h1 class="text-2xl font-bold">Menu Management</h1>
@include('layouts.admin_navbar')

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

@endsection