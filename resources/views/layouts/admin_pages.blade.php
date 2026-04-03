@include('layouts.header')

<main>
    @include('layouts.admin_navbar')
    @yield('admin_pages')
    @include('layouts.admin_footer')

</main>