<div class="desktop-navbar bg-white hidden lg:block shadow-lg py-5">
    <div class="lg:flex justify-between items-center  w-[90%] mx-auto">
    <img src="{{asset('images/logo-green.png')}}" alt="" class="max-w-[100px]">

    <div class="flex justify-between items-center font-medium text-dark-gray text-[1.25em] gap-[2.5em]">
        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
        <a href="{{ route('admin.management') }}">Management</a>
        <a href="{{ route('admin.inquiries') }}">Inquiry</a>
        <a href="{{ route('admin.bookings') }}">Booking</a>
    </div> 

    <div class="flex items-center gap-3">
        <a href=""><img src="{{asset('images/profile-icon.png')}}" alt=""></a>
        <a href="{{ route('logout') }}"><img src="{{asset('images/logout-icon.png')}}" alt="" class="w-[40px]"></a>
    </div>
    
</div>
</div>


<div class="navbar bg-dark-green text-white flex items-center justify-between w-[90%] py-2 px-4 rounded-full fixed bottom-[1em] left-0 right-0 mx-auto lg:hidden">
    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
    <a href="{{ route('admin.management') }}">Management</a>
    <a href="{{ route('admin.inquiries') }}">Inquiry</a>
    <a href="{{ route('admin.bookings') }}">Bookings</a>
</div>