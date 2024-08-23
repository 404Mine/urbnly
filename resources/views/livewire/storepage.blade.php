<div class="h-full bg-[#1E1F22]" id="main">
    <!-- Header Start -->
    <div class="fixed z-50 flex h-16 w-full items-center justify-between bg-[#1E1F22] bg-opacity-90 p-5 backdrop-blur-lg">
        <div class="flex items-center justify-center gap-5">
            <a href="/">
                <img class="h-10 mix-blend-lighten" src="https://cdn.discordapp.com/attachments/781365149646454856/1248698376187543572/urbnly_logo.png?ex=66649c7c&is=66634afc&hm=a15f3ddf85130e6e764b4c344591ab943e3a6e8c49d7dadfea63b65a5730b9fa&" alt="Urbnly Icon" />
            </a>
        </div>

        <div class="flex items-center justify-center gap-10">
            <a wire:navigate href="/Cart-Items">
                <div class="flex items-center justify-center gap-3 rounded-xl p-2 px-5 text-lg transition-all hover:bg-slate-500 hover:bg-opacity-50 hover:text-zinc-100">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                    </svg>
                    Cart
                </div>
            </a>
            <!-- Condition if the User is Logged In or Nah -->
            @if ($this->isAuthenticated)
            <a href="/Users">                                              <!-- FIX THIS TO CREATE A DROPDOWN LIKE THINGY -->
                <div class="flex h-max w-12 items-center justify-center gap-3 rounded-full p-2 hover:bg-slate-500 hover:bg-opacity-50 hover:text-zinc-100">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    </svg>
                </div>
            </a>
            @else
            <a href="/Users">
                <div class="flex items-center justify-center gap-3 rounded-xl p-2 px-5 text-lg transition-all hover:bg-slate-500 hover:bg-opacity-50 hover:text-zinc-100">Login</div>
            </a>
            @endif
            <!-- End of Condition -->
        </div>
    </div>
  <!-- Header End -->
    <script>
        document.addEventListener('livewire:navigated', () => {
            const openModalBtn = document.querySelectorAll('.openModalBtn');
            const closeModalBtn = document.querySelectorAll('.closeModalBtn');

            openModalBtn.forEach(btn => {
                btn.addEventListener('click', () => {
                    const modalTarget = btn.getAttribute('data-modal-target');
                    const productModal = document.getElementById(modalTarget);
                    productModal.classList.remove('hidden');
                });
            });

            closeModalBtn.forEach(btn => {
                btn.addEventListener('click', () => {
                    const modalTarget = btn.getAttribute('data-modal-target');
                    const productModal = document.getElementById(modalTarget);
                    productModal.classList.add('hidden');
                });
            });

            window.addEventListener('click', (e) => {
                openModalBtn.forEach(btn => {
                    const modalTarget = btn.getAttribute('data-modal-target');
                    const productModal = document.getElementById(modalTarget);
                    if (e.target === productModal) {
                        productModal.classList.add('hidden');
                    }
                });
            });
        });
    </script>
    <!-- Main Content -->
    <main class="flex pt-16">
        <!-- Filtering Options Start -->
        <div class="m-5 w-[10%] bg-[#1E1F22] bg-opacity-90 p-5 backdrop-blur-lg">
            <div class="py-10">
              <p class="text-xl">Sex</p>
              <ul>
                @foreach ($sex as $sex)
                <li class="px-2 py-2 wire:key={{ $sex->id }}">
                    <input wire:model.live="selected_sexes" id="{{ $sex->slug }}" type="checkbox" value="{{ $sex->id }}" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="{{ $sex->slug }}" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ $sex->name }}</label>
                </li>
                @endforeach
              </ul>
            </div>
            <div class="py-10">
              <p class="text-xl">Categories</p>
              <ul>
                @foreach ($category as $category)
                <li class="px-2 py-2 wire:key={{ $category->id }}">
                    <input wire:model.live="selected_categories" id="{{ $category->slug }}" type="checkbox" value="{{ $category->id }}" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="{{ $category->slug }}" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ $category->name }}</label>
                </li>
                @endforeach
              </ul>
            </div>
            <div class="py-10">
              <p class="text-xl">Body Types</p>
              <ul>
                @foreach ($bodytype as $bodytype)
                <li class="px-2 py-2 wire:key={{ $bodytype->id }}">
                    <input wire:model.live="selected_bodytypes" id="{{ $bodytype->slug }}" type="checkbox" value="{{ $bodytype->id }}" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="{{ $bodytype->slug }}" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ $bodytype->name }}</label>
                </li>
                @endforeach
              </ul>
            </div>
          </div>
        <!-- Filtering Options End -->
        <!-- Online Store Start -->
        <div class="m-5 w-[90%] rounded-xl bg-[#313338] p-5 flex flex-col items-center">
            <div class="w-max h-auto">
                <img src="https://media.discordapp.net/attachments/781365149646454856/1248740964428677262/ul3transparent.webp?ex=6664c426&is=666372a6&hm=9de34ce199dfcf11678f864748c89f97c04f392fd130bd9ca1e3f120a8040b41&=&format=webp&width=716&height=284" alt="urbnlylogo.jpg">
            </div>
            <!-- Dynamic Display Container Start -->
            <div class="w-full text-center p-3">
                <p class="text-xl pb-5">Available Stores</p>
                <!-- Store Display Start -->
                <div class="flex gap-10 justify-center mb-10">
                    @foreach($store as $store)
                    <a href="" class="flex-shrink-0">
                        <div style="background-image: url('{{ url('storage', $store->image) }}');" class="w-40 h-40 rounded-xl bg-no-repeat bg-cover bg-top border-2 border-black">
                            <div class="backdrop-brightness-[30%] rounded-xl w-full h-full hover:backdrop-brightness-50">
                                <div class="text-white p-5 flex justify-center items-end h-full">
                                    <p>{{$store->name}}</p>
                                </div>
                            </div>
                        </div>
                    </a>
                    @endforeach
                </div>
                <!-- Store Display End -->
                <p class="text-xl pb-5">Available Products</p>
                <!-- Product Display Start -->
                <div class="w-5/6 mx-auto">
                    <div class="flex justify-start gap-10 flex-wrap p-5">
                        @foreach($product as $product)
                        <div class="w-72 bg-zinc-600 bg-opacity-25 shadow-md rounded-xl duration-500 hover:scale-105 hover:shadow-xl">
                            <button class="openModalBtn" data-modal-target="productModal{{$product->id}}">
                                <img src="{{ url('storage', $product->images[0]) }}" alt="Product" class="h-80 w-72 object-cover rounded-t-xl" />
                                <div class="px-4 py-3 w-72">
                                    <span class="text-gray-400 mr-3 uppercase text-xs">{{$product->store->name}}</span>
                                    <p class="text-lg font-bold text-white truncate block capitalize">{{ $product->name }}</p>
                                    <div class="flex items-center justify-between">
                                        <div class="text-green-500">
                                            <p class="text-lg font-semibold text-inherit cursor-auto my-3">₱ {{$product->price}}</p>
                                        </div>
                                        <div class="p-3 rounded-full hover:bg-zinc-500 hover:bg-opacity-25 transition-all">
                                            <a href="#" onclick="event.stopPropagation(); event.preventDefault();" wire:click.prevent='addToCart({{ $product->id }})'>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-bag-plus" viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd" d="M8 7.5a.5.5 0 0 1 .5.5v1.5H10a.5.5 0 0 1 0 1H8.5V12a.5.5 0 0 1-1 0v-1.5H6a.5.5 0 0 1 0-1h1.5V8a.5.5 0 0 1 .5-.5z" />
                                                    <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5z" />
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </button>
                        </div>
                        <!-- Product Modal Start -->
                        <div id="productModal{{$product->id}}" class="fixed inset-0 flex items-center justify-center hidden bg-black bg-opacity-50">
                            <div class="bg-[#1E1F22] rounded-lg shadow-lg w-96">
                                <div class="p-4 text-start">
                                    <div class="flex justify-center">
                                        @if(count($product->images) > 1)
                                            @foreach ($product->images as $image)
                                            <div class="relative w-[100px] h-[300px] overflow-hidden hover:w-full hover:scale-100 hover:shadow-xl transition-all">
                                                <!-- Thumbnail image -->
                                                <img src="{{ url('storage', $image) }}" alt="Product Image" class="w-full h-full object-cover rounded-lg mx-3">
                                            </div>
                                            @endforeach
                                        @else
                                            <div class="w-full h-[300px] flex items-center justify-center">
                                                <img src="{{ url('storage', $product->images[0]) }}" alt="Product Image" class="w-full h-[300px] object-cover rounded-lg">
                                            </div>
                                        @endif
                                    </div>
                                    <h2 class="mt-4 text-xl font-bold">{{ $product->name }}</h2>
                                    <p class="mt-2 text-white text-opacity-50">{{ $product->store->name }}</p>
                                    <p class="mt-2 text-white text-opacity-50">{!! $product->description !!}</p>
                                    <p class="mt-2 text-lg font-semibold">₱ {{ $product->price }}</p>
                                    <div class="mt-4 w-full flex gap-5 justify-center">
                                        <button class="closeModalBtn w-3/4 px-4 py-2 bg-zinc-600 bg-opacity-25 hover:bg-red-500 hover:bg-opacity-15 rounded" data-modal-target="productModal{{$product->id}}">✕ Close</button>
                                        <button wire:click.prevent='addToCart({{ $product->id }})' class="w-1/4 px-2 py-2 bg-blue-500 hover:bg-[#037990] hover:text-gray-100 text-white rounded flex justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                                            </svg>                                      
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Product Modal End -->
                        @endforeach
                    </div>
                <div>
                <!-- Product Display End -->
            </div>
            <!-- Dynamic Display Container End -->
        </div>
        <!-- Online Store End -->
    </main>
    <!-- End of Main Content -->
</div>
