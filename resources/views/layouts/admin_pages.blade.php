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
    // =======================
    // BUNDLE REQUIREMENTS
    // =======================
    let addRowBtn = document.getElementById('add-row');

    if (addRowBtn) {
        addRowBtn.addEventListener('click', function () {
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
    }


    // =======================
    // BOOKING ITEMS
    // =======================
    let bookingAddBtn = document.getElementById('booking-add-row');
    let index = 1;

    if (bookingAddBtn) {
        bookingAddBtn.addEventListener('click', function () {
            let container = document.getElementById('items-container');
            let row = document.querySelector('.item-row').cloneNode(true);

            // RESET VALUES
            row.querySelector('select').name = `new_items[${index}][menu_item_id]`;
            row.querySelector('select').value = '';

            row.querySelector('input').name = `new_items[${index}][quantity]`;
            row.querySelector('input').value = '';

            container.appendChild(row);
            index++;
        });

        document.addEventListener('click', function (e) {
            if (e.target.classList.contains('booking-remove-row')) {
                let rows = document.querySelectorAll('.item-row');

                if (rows.length > 1) {
                    e.target.parentElement.remove();
                }
            }
        });
    }


    // TOGGLE MODE
    let mode = document.getElementById('mode');
    let custom = document.getElementById('custom-section');
    let bundle = document.getElementById('bundle-section');

    mode.addEventListener('change', function () {
        if (this.value === 'bundle') {
            custom.classList.add('hidden');
            bundle.classList.remove('hidden');
        } else {
            custom.classList.remove('hidden');
            bundle.classList.add('hidden');
        }
    });

    // SHOW SELECTED BUNDLE REQUIREMENTS
    let bundleSelect = document.getElementById('bundleSelect');

    if (bundleSelect) {
        bundleSelect.addEventListener('change', function () {

            document.querySelectorAll('.bundle-box').forEach(box => {
                box.classList.add('hidden');
            });

            let selected = document.querySelector(`[data-bundle="${this.value}"]`);
            if (selected) selected.classList.remove('hidden');
        });
    }

    function toggleEdit(section) {
        let container = document.getElementById(`${section}Fields`);
        let fields = container.querySelectorAll('.input-field');
        let button = document.getElementById(section + "Btn");

        let form = document.querySelector('form'); 

        let isDisabled = fields[0].disabled;

        fields.forEach(input => {
            input.disabled = !isDisabled;
        });

        if (isDisabled) {
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
            form.submit(); // ✅ SAFE submit
        }
    }

</script>
