<header class=" w-full bg-black text-amber-400 shadow py-4">
    <div class="container mx-auto flex flex-wrap items-center justify-between gap-4">
        <!-- Logo -->
        <a href="{{route('store.index')}}"
           class="text-xl font-bold w-full sm:w-auto text-center sm:text-left cursor-pointer">Gear Up Ecommerce</a>

        <!-- Search Bar -->
        <div class="w-full px-3 md:px-0 sm:flex-1">
            <input
                type="text"
                class="bg-neutral-700 w-full max-h-10 rounded-full px-4 py-2 text-white placeholder:text-gray-400"
                placeholder="Search products..."
            >
        </div>

        <!-- User and Cart -->
        <div class="flex items-center justify-end w-full sm:w-auto space-x-4 px-3 md:px-0 relative">
            <!-- User Icon -->
            <svg xmlns="http://www.w3.org/2000/svg" fill="orange" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="orange" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z"/>
            </svg>

            <!-- Divider -->
            <div class="h-6 sm:h-8 bg-neutral-700 w-[1px]"></div>

            <!-- Cart -->
            <a href="{{route('store.cart')}}"
               class="flex items-center border rounded-xl px-3 py-2 text-sm space-x-2 hover:bg-neutral-800 transition cursor-pointer" id="cart-icon">
                <span>CART / RS 0</span>
                <svg xmlns="http://www.w3.org/2000/svg" fill="orange" viewBox="0 0 24 24" stroke-width="1.5"
                     stroke="orange" class="size-5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z"/>
                </svg>
            </a>
            <div class="flex hidden bg-white min-h-[150px] w-[250px] px-3 md:px-0 absolute top-12 border-1 border-gray-300" id="cart-modal">
                <div class="flex flex-col h-full w-full text-center items-center space-y-5 text-black font-light">
                    <h1 class="text-2xl">You cart is currently empty :(</h1>
                </div>
            </div>
        </div>


    </div>

</header>

@push('scripts')
    <script>
        const cartModal = document.getElementById('cart-modal');
        const cartIcon = document.getElementById('cart-icon');
        const mainDiv = document.getElementById('main');
        var timeoutId = null;

        mainDiv.addEventListener('click', (e)=>{
            if (cartModal.contains(e.target)) {
                // Click is inside the excluded area, do nothing
                return;
            }
            cartModal.classList.add('hidden');
        });

        cartIcon.addEventListener('mouseover', () => {
            clearTimeout(timeoutId);
            cartModal.classList.remove('hidden');

        });
        cartIcon.addEventListener('mouseout', () => {
            timeoutId = setTimeout( () => {
                cartModal.classList.add('hidden');
            },3000);

        });


        function getCartModal(data) {
            axios.post('/cart/modal',{
                data,
            })
                .then(response => {
                    // console.log(response.data);
                    cartModal.innerHTML = response.data;
                    cartModal.classList.remove('hidden');
                    timeoutId = setTimeout(() => {
                        cartModal.classList.add('hidden');
                    },3000);
                    console.log(timeoutId);
                })
                .catch(error => {
                    console.log(error);
                })

            cartModal.addEventListener('mouseover', () => {
                clearTimeout(timeoutId);
                console.log('mouseover');
            })
            cartModal.addEventListener('mouseout', () => {
                timeoutId = setTimeout(() => {
                    cartModal.classList.add('hidden');
                },3000);
                console.log('mouseout');
            })
        }
    </script>

    <script type="module">
        if (window.Echo) {
            Echo.channel('orders')
                .listen('CartNotificationEvent', (e) => {
                    // console.log('event listened',e.data[e.index]);
                    getCartModal(e.data[e.index]);
                });
        } else {
            console.warn('Echo not loaded');
        }
    </script>


@endpush

