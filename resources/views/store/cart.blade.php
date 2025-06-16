@extends('layouts.store.app')

@section('content')

    <div class="w-full md:px-8 lg:px-24 xl:px-72 py-4 md:py-5">
        <div class="flex flex-col md:flex-row divide-x-2 space-y-5 md:space-y-0 divide-neutral-300">
            @if(isset($cart))
              @include('store.partials.cart-items')
            @endif
        </div>
    </div>
    @push('scripts')
        <script>
            function decreaseQuantity(button) {
                let cartItem = button.closest('.cart-item')
                let quantityInput = cartItem.querySelector('#quantity');
                let productId = button.dataset.id;

                quantityInput.value = Number(quantityInput.value) - 1

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
                        console.error('Error updating cart:' .error);
                    })
            }
            function increaseQuantity(button) {
                let cartItem = button.closest('.cart-item')
                let quantityInput = cartItem.querySelector('#quantity');
                let productId = button.dataset.id;

                quantityInput.value = Number(quantityInput.value) + 1

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
                        console.error('Error updating cart:' .error);
                    })

                // updateQuantityView();
            }

        </script>

    @endpush
@endsection
