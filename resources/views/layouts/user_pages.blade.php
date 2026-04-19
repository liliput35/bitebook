@include('layouts.header')

<main>
    <div class="bg-dark-green py-4 flex justify-center lg:hidden">
        <img src="{{asset('images/logo.png')}}" alt="" class="max-w-[85px]">
    </div>
    @include('layouts.user_navbar')
    @yield('user_pages')
    @include('layouts.admin_footer')

</main> 

<script>
   function toggleEdit(section) {
        let container = document.getElementById(`${section}Fields`);
        let fields = container.querySelectorAll('.input-field');
        let button = document.getElementById(section + "Btn");
        let form = document.querySelector('form'); 

        let isDisabled = fields[0].disabled;

        if (isDisabled) {
            // ENABLE inputs
            fields.forEach(input => {
                input.disabled = false;

                if (input.type === "password") {
                    input.value = "";
                }
            });

            button.innerText = "Save Changes";
            button.classList.add(
                "border-2",
                "border-dark-gray",
                "text-biteblack",
                "text-[1rem]",
                "rounded-lg",
                "px-2"
            );

        } else {
            fields.forEach(input => input.disabled = false);

            form.submit();
        }
    }   
</script>

