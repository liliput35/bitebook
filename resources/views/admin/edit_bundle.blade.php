@extends('layouts.admin_pages')

@section('title', 'Edit Bundle')

@section('admin_pages')

<div class="w-[90%] mx-auto lg:min-h-[100vh]">

    <div class="flex items-center gap-3 mt-12 lg:text-xl">
        <a href="{{route('admin.management')}}" class="font-medium text-dark-gray" >MANAGEMENT</a>
        <p> > </p>
        <a href="{{route('admin.bundles')}}" class="font-medium text-dark-gray" >VIEW BUNDLES</a>
        <p> > </p>
        <a href="" class="font-medium text-light-green" >ADD BUNDLE</a>
    </div>

    <h1 class="text-[2em] font-bold lg:text-[2.5em] mb-6">{{$bundle->name}}</h1>


    {{-- ADD MENU ITEM FORM --}}
    <form action="{{ route('admin.bundles.update', $bundle->id) }}" method="POST" enctype="multipart/form-data">
        <div class="lg:flex lg:justify-between gap-6">
            @csrf
            @method('PUT')

            <div class="bg-white shadow-lg rounded-xl p-4 lg:w-[60%]">
                <div class="mb-2">
                    <label class="font-medium text-light-gray">DISH NAME</label><br>
                    <input class="border border-light-gray rounded-lg w-full p-2" type="text" name="name" value="{{ old('name', $bundle->name) }}" required>
                    @error('name') <span>{{ $message }}</span> @enderror
                </div>

                <div class="mb-2">
                    <label class="font-medium text-light-gray">DESCRIPTION</label><br>
                    <textarea class="border border-light-gray rounded-lg w-full p-2" name="description">{{ old('description', $bundle->description) }}</textarea>
                </div>
                
                <div class="mb-2 lg:w-1/2">
                    <label class="font-medium text-light-gray">PRICE PER HEAD</label><br>
                    <input class="border border-light-gray rounded-lg p-2 lg:w-full" type="number" name="price_per_head" step="0.01" value="{{ old('price_per_head', $bundle->price_per_head) }}" required>
                    @error('price') <span>{{ $message }}</span> @enderror
                </div> 
                
                <div class="flex gap-4 items-center mt-4">
                    <a href="{{ route('admin.bundles') }}" class="py-2 px-4 rounded lg:block hidden border border-dark-green">Cancel</a>
                    <button class="bg-dark-green text-white font-medium py-2 px-4 rounded lg:block hidden" type="submit">Save</button>
                </div>
                
            </div>

            <div class="bg-white shadow-lg rounded-xl p-4 mt-4 lg:w-[40%] lg:order-first">
                <label class="font-medium text-light-gray">PHOTO</label><br>
                <input type="file" name="image" accept="image/*" class="border border-dashed border-dark-green w-full bg-light-green text-white p-10 rounded-xl lg:h-[70%]">

                @error('image') <span>{{ $message }}</span> @enderror
            </div>

            <div class="bg-white shadow-lg rounded-xl p-4 mt-4">
                <div id="requirements-container">
                    <p class="font-medium text-light-gray">REQUIREMENTS</p>

                    @foreach($bundle->requirements as $req)
                        <div class="flex gap-2 mb-2 requirement-row">
                            <select name="requirements[]" class="border p-2 rounded w-1/2">
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ $category->id == $req->category_id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>

                            <input 
                                type="number" 
                                name="quantities[]" 
                                value="{{ $req->required_quantity }}"
                                class="border p-2 rounded w-1/4"
                            >

                            <button type="button" class="remove-row bg-red-500 text-white px-3 rounded">X</button>
                        </div>
                    @endforeach
                </div>
                
                <button type="button" id="add-row" class="bg-light-green text-white px-4 py-2 rounded">
                    + Add Category
                </button>
            </div>

            <a href="{{ route('admin.bundles') }}" class="py-2 px-4 rounded lg:hidden mr-3 border border-dark-green">Cancel</a>
            <button class="bg-dark-green text-white font-medium mt-4 py-2 px-4 rounded lg:hidden" type="submit">Save</button>
        </div>

    </form>

    <form action="{{ route('admin.bundles.destroy', $bundle->id) }}" method="POST" id="deleteForm">
        @csrf
        @method('DELETE')
        <div class="flex justify-end">
            <button type="button" onclick="openDeleteModal()">
                <img src="{{asset('images/delete-icon.png')}}" class="max-w-[40px] mt-4">
            </button>
        </div>
    </form>

    <!-- DELETE MODAL -->
    <div id="deleteModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        
        <div class="bg-white rounded-xl shadow-lg p-6 w-[90%] max-w-md">
            <h2 class="text-lg font-semibold mb-4">Delete Bundle</h2>
            <p class="text-sm text-gray-600 mb-6">
                Are you sure you want to delete this bundle? This action cannot be undone.
            </p>

            <div class="flex justify-end gap-3">
                <button onclick="closeDeleteModal()" 
                    class="px-4 py-2 border rounded-lg">
                    Cancel
                </button>

                <!-- REAL DELETE FORM BUTTON -->
                <button onclick="submitDeleteForm()" 
                    class="bg-red-500 text-white px-4 py-2 rounded-lg">
                    Delete
                </button>
            </div>
        </div>

    </div>
    
    <div class="pb-[5em] lg:pb-0"></div>
</div>

<script>
    function openDeleteModal() {
        document.getElementById('deleteModal').classList.remove('hidden');
        document.getElementById('deleteModal').classList.add('flex');
    }

    function closeDeleteModal() {
        document.getElementById('deleteModal').classList.add('hidden');
        document.getElementById('deleteModal').classList.remove('flex');
    }

    function submitDeleteForm() {
        document.getElementById('deleteForm').submit();
    }
</script>


@endsection