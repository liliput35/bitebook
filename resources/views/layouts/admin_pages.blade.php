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

    function toggleEdit(section) {
        let fields = document.querySelectorAll(`#${section}Fields .input-field`);
        let button = document.getElementById(section + "Btn");

        let isDisabled = fields[0].disabled;

        console.log("clicked") ;

        fields.forEach(input => {
            input.disabled = !isDisabled;
        });

        if (isDisabled) {
            button.innerText = "Save Changes";
            button.classList.add("border-2", "border-dark-gray" "text-biteblack", "text-[1rem]");
        } else {
            button.classList.remove("border-2", "border-dark-gray" "text-biteblack", "text-[1rem]");
            button.innerHTML = `<img src="{{asset('images/black-edit-icon.png')}}" alt="" class="max-w-[40px] mt-4"> `;
        }
    }
</script>