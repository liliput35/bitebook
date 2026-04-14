@include('layouts.header')

<main>
    <div class="bg-dark-green py-4 flex justify-center lg:hidden">
        <img src="{{asset('images/logo.png')}}" alt="" class="max-w-[85px]">
    </div>
    @include('layouts.admin_navbar')
    @yield('admin_pages')
    @include('layouts.admin_footer')

</main> 

<script>
    document.getElementById('add-row').addEventListener('click', function () {
        let container = document.getElementById('requirements-container');
        let row = document.querySelector('.requirement-row').cloneNode(true);

        row.querySelector('input').value = '';

        container.appendChild(row);
    });

    document.addEventListener('click', function (e) {
        if (e.target.classList.contains('remove-row')) {
            if (document.querySelectorAll('.requirement-row').length > 1) {
                e.target.parentElement.remove();
            }
        }
    });
</script>