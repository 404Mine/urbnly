<div>
    <!-- Header Start -->
    <nav class="bg-[#1E1F22] p-4 flex h-16 w-full justify-between items-center bg-opacity-90 backdrop-blur-lg">
        <div>
            <a href="/">
                <img src="{{ asset('storage/urbnlyicontransparent.png') }}" alt="urbnly" class="h-10">
            </a> 
        </div>
        <div class="flex space-x-4 mr-10">
            <a wire:navigate href="/Online-Store" class="text-white  hover:bg-slate-500 hover:bg-opacity-50 px-3 py-1 rounded h-9 w-18 mr-2 focus:bg-[#60656F] active:bg-[#60656F]">Store</a>
            <a wire:navigate href="/Cart-Items" class="text-white  hover:bg-slate-500 hover:bg-opacity-50 px-3 py-1 rounded h-9 w-18 mr-2 focus:bg-[#60656F] active:bg-[#60656F]">Cart</a>
            <a href="/Users" class="text-white  hover:bg-slate-500 hover:bg-opacity-50 px-3 py-1 rounded h-9 w-18 mr-2 focus:bg-[#60656F] active:bg-[#60656F]">Login</a>
        </div>
    </nav>
    <!-- Header End -->
    <!-- MainContent -->
    <div class="bg-[#1E1F22] h-screen py-8">
        <div class="container mx-auto px-4">
            <h1 class="text-3xl font-bold mb-4">Checkout</h1>

            <form wire:submit.prevent='placeOrder'>

                <div class="flex flex-col md:flex-row gap-4">
                    <!-- Left Contents Container -->
                    <div class="md:w-3/4">
                        
                            <!-- Left Contents -->
                            <div class="bg-[#313338] rounded-lg shadow-md p-6 mb-4">
                                <h2 class="font-bold text-lg">Shipping Address</h2>
                                <div class="w-full pt-5 pb-5">
                                    <div class="flex p-2">
                                        <div class="w-1/2 p-3 text-black">
                                            <p class="text-lg text-slate-500">Name</p>
                                            @if ($this->isAuthenticated)
                                            <p class="w-full py-2 text-zinc-500">{{$this->user->name}}</p>
                                            @else
                                            <p class="w-full py-2 text-zinc-500"> &nbsp; </p>
                                            @endif
                                        </div>
                                        <div class="w-1/2 p-3 text-black">
                                            <p class="text-lg text-slate-500">Contact Number</p>
                                            @if ($this->isAuthenticated)
                                            <p class="w-full py-2 text-zinc-500">{{$this->user->contact}}</p>
                                            @else
                                            <p class="w-full py-2 text-zinc-500"> &nbsp; </p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="flex p-2">
                                        <div class="w-full p-3 text-black">
                                            <p class="text-lg text-slate-500">Address</p>
                                            @if ($this->isAuthenticated)
                                            <p class="w-full py-2 text-zinc-500">{{$this->user->address}}</p>
                                            @else
                                            <p class="w-full py-2 text-zinc-500"> &nbsp; </p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <h3 class="font-bold text-lg">Payment & Shipping Options</h3>
                                <div class="flex pt-5 pb-5">
                                    <div class="w-1/2 p-3">
                                        <label for="payment-method" class="block text-lg text-slate-500">Payment Method</label>                   
                                        <select wire:model='payment_method' id="payment-method" required class="block rounded-lg border w-full py-1 px-2 text-black hover:border-[#037990] focus:border-[#05B6D8] focus:ring-2 focus:ring-[#05B6D8] @error('payment_method') border-rose-500 @enderror">
                                            <option class="text-slate-700" value="place_holder">--Select Payment--</option>
                                            <option class="text-slate-700" value="Stripe">Stripe</option>
                                            <option class="text-slate-700" value="COD">Cash on Delivery</option>
                                        </select>
                                        @error('payment_method')
                                        <div class="text-rose-500 text-sm">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="w-1/2 p-3">
                                        <label for="shipping-method" class="block text-lg text-slate-500">Shipping method</label>
                                        <select wire:model='shipping_method' id="shipping-method" required class="block rounded-lg border w-full py-1 px-2 text-black hover:border-[#037990] focus:border-[#05B6D8] focus:ring-2 focus:ring-[#05B6D8] @error('shipping_method') border-rose-500 @enderror">
                                            <option class="text-slate-700" value="place_holder">--Select Payment--</option>
                                            <option class="text-slate-700" value="Lalamove">Lalamove</option>
                                            <option class="text-slate-700" value="J&T">J&T Express</option>
                                            <option class="text-slate-700" value="GRAB">Grab Express</option>
                                            <option class="text-slate-700" value="DPE">Delivery Parcel Express</option>
                                        </select>
                                        @error('shipping_method')
                                        <div class="text-rose-500 text-sm">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <!-- End of Left Contents -->
                        
                    </div>
                    <!-- End of Left Contents Container -->
                    <!-- Right Contents Container -->
                    <div class="md:w-1/4">
                        <!-- Right Contents -->
                        <div class="bg-[#313338] p-5 mb-5 rounded-lg">
                            <h1 class="text-lg font-bold mb-4">Basket Summary</h1>
                            <ul class="divide-y divide-slate-700 dark:divide-gray-700" role="list">
                                @foreach ($cart_items as $ci)
                                <li class="py-3 sm:py-4" wire:key='{{ $ci['product_id'] }}'>
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0">
                                            <img src="{{ url('storage', $ci['image']) }}" alt="{{ $ci['name'] }}" class="w-12 h-12 rounded-full"></img>
                                        </div>
                                        <div class="flex-1 min-w-0 ms-4">
                                            <p class="text-sm font-medium text-gray-700 truncate dark:text-white">{{ $ci['name'] }}</p>
                                            <p class="text-sm text-slate-500 truncate dark:text-slate-500">Quantity: {{ $ci['quantity'] }}</p>
                                        </div>
                                        <div class="inline-flex items-center text-base font-semibold text-gray-700 dark:text-white">
                                            {{ Number::currency($ci['total_amount'], 'PHP') }}
                                        </div>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="bg-[#313338] p-5 mb-5 rounded-lg">
                            <h1 class="text-lg font-bold mb-4">Order Summary</h1>
                            <div class="flex justify-between mb-2">
                                <span>Subtotal</span>
                                <span>{{ Number::currency($grand_total, 'PHP') }}</span>
                            </div>
                            <div class="flex justify-between mb-2">
                                <span>Taxes</span>
                                <span>{{ Number::currency(0, 'PHP') }}</span>
                            </div>
                            <div class="flex justify-between mb-2">
                                <span>Shipping Cost</span>
                                <span>{{ Number::currency(0, 'PHP') }}</span>
                            </div>
                            <hr class="my-2 border-t-2 border-slate-700">
                            <div class="flex justify-between mb-2">
                                <span>Grand Total</span>
                                <span>{{ Number::currency($grand_total, 'PHP') }}</span>
                            </div>
                            <button type="submit" class="bg-[#05B6D8] hover:bg-[#037990] text-white hover:text-gray-100 w-full py-2 lg:py-2 text-base md:text-lg lg:text-xl rounded">Place Order</button>
                        </div>
                        <!-- End of Right Contents -->
                    </div>
                    <!-- End of Right Contents Container -->
                </div>
            
            </form>

        </div>
    </div>
</div>
