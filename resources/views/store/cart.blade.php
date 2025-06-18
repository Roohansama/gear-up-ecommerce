@extends('layouts.store.app')

@section('content')

    <div class="container w-full">
        <div id="cart-loading-overlay" class="hidden absolute inset-0 bg-white/60 z-50 flex items-center justify-center">
            <div class="loader ease-linear rounded-full border-4 border-t-4 border-gray-200 h-10 w-10 animate-spin border-t-blue-500"></div>
        </div>
        <div class="flex flex-col md:flex-row divide-x-2 space-y-5 md:space-y-0 divide-neutral-300 relative" id="cart-wrapper">
            @if(isset($cart))
                @include('store.partials.cart-items')
            @else
               @include('store.partials.empty-cart')
            @endif
        </div>
    </div>
    @push('scripts')
        <script>
            function showCartLoader() {
                document.getElementById('cart-loading-overlay').classList.remove('hidden');
            }

            function hideCartLoader() {
                document.getElementById('cart-loading-overlay').classList.add('hidden');
            }

            function removeItem(button) {
                let productId = button.dataset.id;

                axios.post('/cart/remove-item', {
                    product_id: productId,
                })
                    .then(response => {
                        console.log(response.data.cart)
                    })
                    .catch(error =>{
                        console.error(error)
                    });

                updateQuantityView();
            }
            function decreaseQuantity(button) {
                let cartItem = button.closest('.cart-item')
                let quantityInput = cartItem.querySelector('#quantity');
                let productId = button.dataset.id;

                showCartLoader();

                let currentQuantity = Number(quantityInput.value);

                if (currentQuantity <= 1) {
                    hideCartLoader();
                    return;
                }

                // quantityInput.value = currentQuantity - 1;

                let quantity = -1;
                axios.post('/cart/update', {
                    product_id: productId,
                    quantity: quantity,
                })
                    .then(response => {
                        // alert(response.data.message);

                        console.log(response.data.cart);
                    })
                    .catch(error => {
                        console.error('Error updating cart:'.error);
                    })
                    .finally(() => {
                        setTimeout(() => {
                            hideCartLoader();
                            updateQuantityView(); // You can also delay this if needed
                        }, 1000);
                    });
            }

            function increaseQuantity(button) {
                showCartLoader();

                let cartItem = button.closest('.cart-item')
                // let quantityInput = cartItem.querySelector('#quantity');
                let productId = button.dataset.id;

                // quantityInput.value = Number(quantityInput.value) + 1

                let quantity = 1;
                axios.post('/cart/update', {
                    product_id: productId,
                    quantity: quantity,
                })
                    .then(response => {
                        // alert(response.data.message);

                        console.log(response.data.cart);
                    })
                    .catch(error => {
                        console.error('Error updating cart:'.error);
                    }).finally(() => {
                    setTimeout(() => {
                        hideCartLoader();
                        updateQuantityView(); // You can also delay this if needed
                    }, 1000);
                });
            }

            function updateQuantityView() {
                // Now fetch the updated partial
                axios.get('/cart/partial')
                    .then(response => {
                        document.getElementById('cart-wrapper').innerHTML = response.data;
                    })
                    .catch(err => {
                        alert("Error updating cart");
                        console.error(err);
                    });
            }
        </script>

    @endpush
@endsection
