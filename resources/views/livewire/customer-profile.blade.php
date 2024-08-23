<div class="bg-[#1E1F22] h-screen w-screen">

    <!-- Header Start -->
    <nav class="bg-[#1E1F22] p-4 flex justify-between items-center">
        <div>
            <a href="/">
                <img src="{{ asset('storage/urbnlyicontransparent.png') }}" alt="urbnly" class="h-10">
            </a> 
        </div>
        <div class="flex space-x-4 mr-10">
            <a wire:navigate href="/" class="text-white  hover:bg-slate-500 hover:bg-opacity-50 px-3 py-1 rounded h-9 w-18 mr-2 focus:bg-[#60656F] active:bg-[#60656F]">Home</a>
            <a wire:navigate href="/Contacts" class="text-white  hover:bg-slate-500 hover:bg-opacity-50 px-3 py-1 rounded h-9 w-18 mr-2 focus:bg-[#60656F] active:bg-[#60656F]">Contacts</a>
            <a wire:navigate href="/Online-Store" class="text-white  hover:bg-slate-500 hover:bg-opacity-50 px-3 py-1 rounded h-9 w-18 mr-2 focus:bg-[#60656F] active:bg-[#60656F]">Store</a>
        </div>
    </nav>
    <!-- Header End -->
    <div class="mx-auto max-w-7xl px-4 py-4 sm:px-6 lg:px-12">
        <div class="rounded-lg bg-[#313338] p-6 shadow-lg">
            @if ($this->isAuthenticated)
                <div class="flex justify-between space-x-6">
                <div class="flex items-center gap-5">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-24 w-24 text-gray-500">
                        <path fill-rule="evenodd" d="M12 2a10 10 0 100 20 10 10 0 000-20zM8.828 8.828a4 4 0 115.657 5.657 4 4 0 01-5.657-5.657zM4.683 18.317A8.965 8.965 0 0112 15a8.965 8.965 0 017.317 3.317A8.958 8.958 0 0112 21a8.958 8.958 0 01-7.317-2.683z" clip-rule="evenodd" />
                    </svg>
                    <div class="flex">
                        <div class="items-center">
                            <h1 class="view-mode text-2xl font-semibold text-white">{{ $this->user->name }}</h1>
                            <input type="text" value="John Doe" class="edit-mode hidden rounded border border-black bg-[#5F6370] px-2 py-1 text-white" />
                            <p class="view-mode text-white">{{ $this->user->email }}</p>
                            <input type="email" value="john.doe@example.com" class="edit-mode hidden rounded border border-black bg-[#5F6370] px-2 py-1 text-white" />
                        </div>
                    </div>
                </div>
                <a href="/Users/profile" class="flex items-center p-5">
                    <div class="bg-blue-500 h-max py-2 px-5 rounded-lg">
                        Edit User Profile
                    </div>
                </a>
            </div>
            <hr>
            <div class="mt-5 space-y-4">
                <div class="flex gap-5 px-5 py-2 flex-wrap">
                    <div class="w-[45%]">
                        <p class="text-zinc-500 text-sm">DISPLAY NAME</p>
                        <p class="text-white">{{ $this->user->name }}</p>
                    </div>
                    <div class="w-[45%]">
                        <p class="text-zinc-500 text-sm">USERNAME</p>
                        <p class="text-white">{{ $this->user->username }}</p>
                    </div>
                    <div class="w-[45%]">
                        <p class="text-zinc-500 text-sm">EMAIL</p>
                        <p class="text-white">{{ $this->user->email }}</p>
                    </div>
                    <div class="w-[45%]">
                        <p class="text-zinc-500 text-sm">PHONE NUMBER</p>
                        <p class="text-white">{{ $this->user->contact }}</p>
                    </div>
                </div>
                <hr>
                <h2 class="text-xl font-semibold text-white">Recent Orders</h2>
                <div class="mt-4 space-y-4">
                    <!-- Order Item -->
                    @foreach ($orders as $order)
                    <div class="rounded-lg bg-zinc-900 bg-opacity-50 p-4 shadow-md">
                        <div class="flex justify-between">
                            <div>
                            <h3 class="text-lg font-bold text-zinc-200">Order #{{ $order->id }}</h3>
                            <p class="text-zinc-400">Placed on {{ $order->created_at->format('F d, Y') }}</p>
                            <p class="text-zinc-400">Total: Php {{ $order->grand_total }}</p>
                            </div>
                            <div class="flex items-center">
                            @if ($order->status === 'shipped')
                            <span class="rounded-full bg-green-300 px-3 py-1 text-sm text-black bg-opacity-75">Shipped</span>
                            @elseif ($order->status === 'canceled')
                            <span class="rounded-full bg-red-300 px-3 py-1 text-sm text-black bg-opacity-75">Cancelled</span>
                            @elseif ($order->status === 'processing')
                            <span class="rounded-full bg-zinc-300 px-3 py-1 text-sm text-black bg-opacity-75">Processing</span>
                            @else
                            <span class="rounded-full bg-cyan-300 px-3 py-1 text-sm text-black bg-opacity-75">New</span>
                            @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                    <!-- Add more orders as needed -->
                </div>
            </div>
            @else
            <div class="rounded-lg bg-[#313338] p-6 shadow-lg">
                <div class="flex justify-center items-center space-x-6 h-[500px]">
                    <h1 class="text-slate-700 text-3xl">There's No Current Logged In User</h1>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
  