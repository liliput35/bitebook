@include('layouts.header')

<main>
    <div class="bg-dark-green py-4 lg:hidden">
        <div class="flex justify-between items-center w-[90%] mx-auto">
            <a href="{{ url()->previous() }}" class="underline text-lg text-white">< Back</a>

            <img src="{{asset('images/logo.png')}}" alt="" class="max-w-[85px]">

            <div class="flex items-center gap-3">
                <a href="{{ route('user.cart') }}"><img src="{{asset('images/shopping-cart-white.png')}}" alt="" class="w-[35px]"></a>
                <a href="{{ route('user.profile') }}"><img src="{{asset('images/profile-icon-white.png')}}" alt="" class="w-[35px]"></a>
            </div>
        </div>
        
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

