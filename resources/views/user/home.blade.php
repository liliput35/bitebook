@extends('layouts.content')

@section('title', 'Dashboard')

@section('content')


<h1 class="text-2xl font-bold">User Home</h1>

<form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-md">
        Logout
    </button>
</form>

@endsection