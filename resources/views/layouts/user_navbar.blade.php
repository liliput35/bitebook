<div class="desktop-navbar bg-white hidden lg:block shadow-lg py-5">
    <div class="lg:flex justify-between items-center  w-[90%] mx-auto">
    
        <a href="{{ route('user.home') }}"><img src="{{asset('images/logo-green.png')}}" alt="" class="max-w-[100px]"></a>

        <div class="flex justify-between items-center font-medium text-dark-gray text-[1.25em] gap-[2.5em]">
            <a href="{{ route('user.menu') }}">Menu</a>
            <a href="{{ route('user.bundles') }}">Bundles</a>
            <a href="{{ route('user.inquiries') }}">Inquiries</a> 
            <a href="{{ route('user.bookings') }}">Bookings</a> 

        </div> 

        <div class="flex items-center gap-3">
            <a href="{{ route('user.cart') }}"><img src="{{asset('images/shopping-cart.png')}}" alt="" class="w-[40px]"></a>
            <a href="{{ route('user.profile') }}"><img src="{{asset('images/profile-icon.png')}}" alt=""></a>
        </div>

    </div>
</div>


<div class="navbar bg-dark-green text-white flex items-center justify-between w-[90%] py-2 px-4 rounded-full fixed bottom-[1em] left-0 right-0 mx-auto lg:hidden">
    <a href="{{ route('user.home') }}">Home</a>
    <a href="{{ route('user.menu') }}">Menu</a>
    <a href="{{ route('user.bundles') }}">Bundles</a>
    <a href="{{ route('user.inquiries') }}">Inquiries</a>
    <a href="{{ route('user.bookings') }}">Bookings</a> 
</div>