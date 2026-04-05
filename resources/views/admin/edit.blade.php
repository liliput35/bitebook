@extends('layouts.content')

@section('title', 'Edit Menu Item')

@section('content')
<h1 class="text-2xl font-bold">Edit Menu Item</h1>
@include('layouts.navbar')

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

@endsection