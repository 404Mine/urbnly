<div>
    <!-- Header Start -->
    <nav class="bg-[#1E1F22] p-4 flex h-16 w-full justify-between items-center bg-opacity-90 backdrop-blur-lg">
        <div>
            <a href="/">
                <img src="{{ asset('storage/urbnlyicontransparent.png') }}" alt="urbnly" class="h-10">
            </a> 
        </div>
        <div class="flex space-x-4 mr-10">
            <a wire:navigate href="/" class="text-white  hover:bg-slate-500 hover:bg-opacity-50 px-3 py-1 rounded h-9 w-18 mr-2 focus:bg-[#60656F] active:bg-[#60656F]">Home</a>
            <a wire:navigate href="/Contacts" class="text-white  hover:bg-slate-500 hover:bg-opacity-50 px-3 py-1 rounded h-9 w-18 mr-2 focus:bg-[#60656F] active:bg-[#60656F]">Contacts</a>
            <a wire:navigate href="/Online-Store" class="text-white  hover:bg-slate-500 hover:bg-opacity-50 px-3 py-1 rounded h-9 w-18 mr-2 focus:bg-[#60656F] active:bg-[#60656F]">Store</a>
            <a href="/Users" class="text-white  hover:bg-slate-500 hover:bg-opacity-50 px-3 py-1 rounded h-9 w-18 mr-2 focus:bg-[#60656F] active:bg-[#60656F]">Login</a>
        </div>
    </nav>
    <!-- Header End -->
    <script>
        function openConfirmationModal(modalId) {
            var modal = document.getElementById(modalId);
            modal.classList.remove('hidden');
        }
        function closeConfirmationModal(modalId) {
            var modal = document.getElementById(modalId);
            modal.classList.add('hidden');
        }

         // Prevent closing the modal when clicking inside it
        function stopPropagation(event) {
            event.stopPropagation();
        }

        document.addEventListener('livewire:navigated', function () {
        // Get all modal elements
        var modals = document.querySelectorAll('.confirmation-modal');

        // Add event listener to each modal
        modals.forEach(function (modal) {
            modal.addEventListener('click', stopPropagation);
        });

        // Add event listener to close modals when clicking outside
        document.addEventListener('click', function (event) {
            if (event.target.classList.contains('confirmation-modal')) {
                closeConfirmationModal(event.target.id);
            }
        });
    });
    </script>

    <!-- Main Content -->
    <div class="bg-[#1E1F22] h-screen py-8">
        <div class="container mx-auto px-4">
            <h1 class="text-2xl font-bold mb-4">Shopping Cart</h1>
            <div class="flex flex-col md:flex-row gap-4">
                <div class="md:w-3/4">
                    <div class="bg-[#313338] rounded-lg shadow-3xl p-6 mb-4">
                        <!-- Cart item table -->
                        <table class="w-full">
                            <thead>
                                <tr>
                                    <th class="text-center font-semibold pb-4">Product Name</th>
                                    <th class="text-left font-semibold pb-4">Price</th>
                                    <th class="text-left font-semibold pb-4">Quantity</th>
                                    <th class="text-left font-semibold pb-4">Total</th>
                                    <th class="text-Center font-semibold pb-4">Delete</th>
                                </tr>
                            </thead>
                            <tbody>

                            @forelse ($cart_items as $item)

                                <!-- Perspradak -->
                                <tr wire:key='{{ $item['product_id'] }}' class="border-t border-zinc-500">
                                    <td class="py-4">
                                        <div class="flex items-center">
                                            <img class="h-16 w-16 mr-4" src="{{ url('storage', $item['image']) }}" alt="{{ $item['name'] }}">
                                            <span class="font-semibold">{{ $item['name'] }}</span>
                                        </div>
                                    </td>
                                    <td class="py-4">{{ Number::currency($item['unit_amount'], 'PHP') }}</td>
                                    <td class="py-4">
                                        <div class="flex items-center">
                                            <button wire:click='decreaseQty({{ $item['product_id'] }})' class="border rounded-md py-2 px-4 mr-2 hover:bg-[#05B6D8] hover:text-gray-100">-</button>
                                            <span class="text-center w-8">{{ $item['quantity'] }}</span>
                                            <button wire:click='increaseQty({{ $item['product_id'] }})' class="border rounded-md py-2 px-4 ml-2 hover:bg-[#05B6D8] hover:text-gray-100">+</button>
                                        </div>
                                    </td>
                                    <td class="py-4">{{ Number::currency($item['total_amount'], 'PHP') }}</td>
                                    <td class="py-2 text-center">
                                        <button onclick="openConfirmationModal('confirmationModal_{{ $item['product_id'] }}')" class="text-rose-500 font-bold">✕</button>
                                    </td>
                                </tr>

                                <!-- Delete Confirmation Modal Start -->
                                <div id="confirmationModal_{{ $item['product_id'] }}" class="fixed inset-0 flex items-center justify-center hidden bg-black bg-opacity-50" onclick="closeConfirmationModal('confirmationModal_{{ $item['product_id'] }}')">
                                    <div class="bg-indigo-950 w-[650px] h-[500px] rounded-3xl p-5 shadow-md">
                                        <div class="flex flex-col gap-5 justify-end h-1/2 items-center mb-10">
                                            <img src="{{ asset('storage/deleteicon.png') }}" alt="check icon" class="h-20 w-max">
                                            <p class="text-2xl text-center text-rose-500">Delete Item</p>
                                        </div>
                                        <div class="h-1/2">
                                            <div class="text-gray-400 h-1/2">
                                                <p class="text-lg text-center">Are you sure you want to delete??</p>
                                            </div>
                                            <div class="text-white flex justify-around">
                                                <button onclick="closeConfirmationModal('confirmationModal_{{ $item['product_id'] }}')" class="w-1/3 px-4 py-2 rounded-xl border border-zinc-500 bg-opacity-25 hover:bg-zinc-500">Cancel</button>
                                                <button wire:click='removeItem({{ $item['product_id'] }})' class="w-1/3 px-4 py-2 rounded-xl bg-rose-500 bg-opacity-50 hover:bg-rose-500">Confirm</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Delete Confirmation Modal End -->

                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-4 text-4xl font-semibold text-slate-700">Cart is Empty!!  :(</td>
                                    </tr>
                                @endforelse
                                    
                            </tbody>
                        </table>
                    </div>
                </div>
    
                <!-- Total price -->
                <div class="md:w-1/4">
                    <div class="bg-[#313338] rounded-lg shadow-md p-6">
                        <h2 class="text-lg font-semibold mb-4">Summary</h2>
                        <div class="flex justify-between mb-2">
                            <span>Subtotal</span>
                            <span>{{ Number::currency($grand_total, 'PHP') }}</span>
                        </div>
                        <div class="flex justify-between mb-2">
                            <span>Taxes</span>
                            <span>{{ Number::currency(0, 'PHP') }}</span>
                        </div>
                        <div class="flex justify-between mb-2">
                            <span>Shipping</span>
                            <span>{{ Number::currency(0, 'PHP') }}</span>
                        </div>
                        <hr class="my-2 border-t-1 border-zinc-500 ">
                        <div class="flex justify-between mb-2">
                            <span class="font-bold">Total</span>
                            <span class="font-bold">{{ Number::currency($grand_total, 'PHP') }}</span>
                        </div>
                        @if ($cart_items)
                        <button wire:navigate href="/Check-Out" class="bg-blue-500 hover:bg-[#037990] hover:text-gray-100 text-white py-2 px-4 rounded-lg mt-4 w-full">Checkout</button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>
