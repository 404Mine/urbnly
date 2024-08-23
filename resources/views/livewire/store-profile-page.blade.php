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

    <!-- Main Content Start -->
    <div class="bg-[#1E1F22] p-10">
        <div class="container mx-auto p-20 pt-10">
            <div class="flex flex-col md:flex-row gap-8">
                <div class="md:w-3/4">
                    <h1 class="text-3xl font-bold mb-4">Store Profile</h1>
                     <!-- Left Contents Start -->
                     <div class="bg-[#313338] rounded-lg shadow-md p-6 mb-4">
                        <div class="flex items-center">
                            <img src="" alt="store.icon" class="w-20 h-20 rounded-full mr-5">
                            <h2 class=" font-bold text-3xl">sample store name</h2>
                        </div>
                        <div class="w-full">
                            <hr class="my-2 border-t-1 border-zinc-600">
                            <h2 class=" font-semibold text-2xl">Store Products</h2>
                            <section id="Products" class="w-fit mx-auto grid grid-cols-1 md:grid-cols-3 sm:grid-cols-2 justify-items-center justify-center gap-y-7 gap-x-7 my-5">
                                <!-- Product Card Start -->
                                
                                <div class="w-auto bg-zinc-900 shadow-md rounded-xl duration-500 hover:scale-105 hover:shadow-xl">
                                    <img src="" alt="Product" class="w-full h-3/4 object-cover rounded-t-xl" />
                                    <div class="px-4 py-3 w-full">
                                        <span class="text-gray-400 mr-3 uppercase text-xs">sample store name</span>
                                        <p class="flex text-lg font-bold text-white capitalize">"sample product name</p>
                                        <div class="flex items-center">
                                            <p class="text-lg font-semibold text-white cursor-auto mt-3">Php 1000</p>
                                            <div class="ml-auto">
                                                <a href="/Users/user-products">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="20" height="20" class="bi bi-pencil">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536-11.036 11.036H4.196V16.27l11.036-11.036zM4 20h16v2H4z"/>
                                                    </svg>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Product Card End -->
                            </section>
                        </div>
                    </div>
                    <!--Left Contents End -->
                </div>
                <!-- Right Contents -->
                <div class="md:w-1/4" >
                    <div class="bg-[#313338] mt-12 p-5 rounded-lg">
                        <div class="text-2xl font-bold">Store Details</div>
                        <hr class="my-2  border-t-1 border-gray-700">
                        <div class="text-left text-lg font-semibold text-slate-500">Location: </div>
                        <div class="text-right mb-4">sample store location</div>
                        <div class="text-left text-lg font-semibold text-slate-500" >Contact:</div>
                        <div class="text-right mb-4">sample store contact</div>
                        <div class="text-left text-lg font-semibold text-slate-500" >Email:</div>
                        <div class="text-right mb-4">sample store email</div>
                        <div class="text-left text-lg font-semibold text-slate-500" >Owner's Name:</div>
                        <div class="text-right mb-4">sample store owner</div>
                        <div class="text-left text-lg font-semibold text-slate-500" >Member since:</div>
                        <div class="text-right mb-4 text-gray-400">sample store member date</div>
                    </div>
                </div>
                <!-- Right Contents End -->
            </div>
        </div>
    </div>
    <!-- Main Content End -->
</div>
