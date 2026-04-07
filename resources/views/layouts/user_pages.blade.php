@include('layouts.header')

<main>
    <div class="bg-dark-green py-4 flex justify-center lg:hidden">
        <img src="{{asset('images/logo.png')}}" alt="" class="max-w-[85px]">
    </div>
    @include('layouts.user_navbar')
    @yield('user_pages')
    @include('layouts.admin_footer')

</main> 
