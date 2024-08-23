<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Metadata -->
        <meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- Identity of Website -->
        <meta name="keywords" content="URBNLY, Urbnly Online Store, Urbnly Website">
        <meta name="description" content="Urbnly is a website that gives emphasis on 
        local apparel products. This website will only be available for few days after 
        passing my subject :>">
        <meta property="og:title" content="Urbnly Website is created by NotFound">
        <meta property="og:type" content="website">
        <meta property="og:site_nane" content="Urbnly">

        <!-- Force to Recache -->
        <meta http-equiv="Cache-Cotnrol" content="no-cache, no-store, must-revalidate">
		<meta http-equiv="Pragma" content="no-cache">

        <!-- Website Title & Icon -->
        <title>Urbnly</title>
        <link rel="icon" href="elements/urbnlyicon.jpg">

        <!-- CSS Library -->
        @vite('resources/css/app.css')
        @vite('resources/css/addedoutput.css')
        <link rel="stylesheet" href="{{ asset('css/customcss/addedoutput.css') }}">
        <link rel="stylesheet" href="{{ asset('build/assets/app-DiKUzZ_v.css') }}">

        <!-- JS Library -->
        @vite('resources/js/app.js')
        <script src="{{ asset('build/assets/app-DkDdL2UM.js') }}"></script>
        <script src="https://unpkg.com/alpinejs" defer></script>
    </head>
    <body class="cstmdbgc">
        <!-- Wrap -->
        <div class="h-full cstmdbgc">
            <!-- Header -->
            <div class="fixed w-full h-16 p-5 flex justify-between items-center z-50 cstmdbgc">
                <div class="flex gap-5 justify-center items-center">
                    urbnly
                </div>
                <div class="flex gap-5 justify-center items-center">
                    <div x-data="{ 
                        slideOverOpen: false 
                    }"
                    class="relative z-50 w-auto h-auto">
                    <button @click="slideOverOpen=true" class="inline-flex items-center justify-center h-10 px-4 py-2 text-sm font-medium transition-colors bg-sky-800 border rounded-md active:bg-slate-800 focus:bg-slate-800 focus:outline-none focus:ring-2 focus:ring-neutral-200/60 focus:ring-offset-2 disabled:opacity-50 disabled:pointer-events-none">Open</button>
                    <template x-teleport="body">
                        <div 
                            x-show="slideOverOpen"
                            @keydown.window.escape="slideOverOpen=false"
                            class="relative z-[99]">
                            <div x-show="slideOverOpen" x-transition.opacity.duration.600ms @click="slideOverOpen = false" class="fixed inset-0 bg-black bg-opacity-10"></div>
                            <div class="fixed inset-0 overflow-hidden">
                                <div class="absolute inset-0 overflow-hidden">
                                    <div class="fixed inset-y-0 right-0 flex max-w-full pl-10">
                                        <div 
                                            x-show="slideOverOpen" 
                                            @click.away="slideOverOpen = false"
                                            x-transition:enter="transform transition ease-in-out duration-500 sm:duration-700" 
                                            x-transition:enter-start="translate-x-full" 
                                            x-transition:enter-end="translate-x-0" 
                                            x-transition:leave="transform transition ease-in-out duration-500 sm:duration-700" 
                                            x-transition:leave-start="translate-x-0" 
                                            x-transition:leave-end="translate-x-full" 
                                            class="w-screen max-w-md">
                                            <div class="flex flex-col h-full py-5 overflow-y-scroll bg-slate-900 border-l shadow-lg border-sky-500">
                                                <div class="px-4 sm:px-5">
                                                    <div class="flex items-start justify-between pb-1">
                                                        <h2 class="text-base font-semibold leading-6 text-gray-900" id="slide-over-title">Filters</h2>
                                                        <div class="flex items-center h-auto ml-3">
                                                            <button @click="slideOverOpen=false" class="absolute top-0 right-0 z-30 flex items-center justify-center px-3 py-2 mt-4 mr-5 space-x-1 text-xs font-medium uppercase border rounded-md border-neutral-200 text-neutral-600 hover:bg-slate-800">
                                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path></svg>
                                                                <span>Close</span>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="relative flex-1 px-4 mt-5 sm:px-5">
                                                    <div class="absolute inset-0 px-4 sm:px-5">
                                                        <div class="relative h-full overflow-hidden rounded-md border-neutral-300 p-5">
                                                            <div>
                                                                <p class="pt-3 pb-3">Sex</p>
                                                                <div class="p-3 pl-5">
                                                                    <div class="flex items-center mb-4">
                                                                        <input id="default-checkbox" type="checkbox" value="" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                                                        <label for="default-checkbox" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Male</label>
                                                                    </div>
                                                                    <div class="flex items-center">
                                                                        <input checked id="checked-checkbox" type="checkbox" value="" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                                                        <label for="checked-checkbox" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Female</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div>
                                                                <p class="pt-3 pb-3">Categories</p>
                                                                <div class="p-3 pl-5">
                                                                    <div class="flex items-center mb-4">
                                                                        <input id="default-checkbox" type="checkbox" value="" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                                                        <label for="default-checkbox" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Category 1</label>
                                                                    </div>
                                                                    <div class="flex items-center">
                                                                        <input checked id="checked-checkbox" type="checkbox" value="" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                                                        <label for="checked-checkbox" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Category 2</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div>
                                                                <p class="pt-3 pb-3">Body Type</p>
                                                                <div class="p-3 pl-5">
                                                                    <div class="flex items-center mb-4">
                                                                        <input id="default-checkbox" type="checkbox" value="" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                                                        <label for="default-checkbox" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Body Type 1</label>
                                                                    </div>
                                                                    <div class="flex items-center">
                                                                        <input checked id="checked-checkbox" type="checkbox" value="" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                                                        <label for="checked-checkbox" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Body Type 2</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </template>
                </div>
                </div>
            </div>
            <main class="pt-16 overflow-y-visible">
                <div class="flex justify-center p-3">
                    <div class="flex justify-center h-max shrink">
                        <img src="{{ asset('storage/ul3transparent.webp') }}" alt="notworking" height="50%">
                    </div>
                </div>
                <div>
                    <div class="p-5">
                        <p class="text-3xl flex justify-center">Available Stores</p>
                        <div class="flex gap-5 p-5 overflow-x-auto">
                            <a href="" class="flex cstma">
                                <div style="background-image: url('https://i.pinimg.com/originals/63/ec/a9/63eca9f6be85af069fbd1dd9d4a5a1a6.jpg');" class="min-w-40 min-h-40 rounded-xl bg-no-repeat bg-cover bg-top bg-scroll border-2 border-black">
                                    <div class="backdrop-brightness-50 rounded-xl w-full h-full hover:backdrop-brightness-75">
                                        <div class="text-white p-5 flex justify-center items-end h-full">
                                            <p>Minami Fashion</p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <a href="" class="flex cstma">
                                <div style="background-image: url('https://pbs.twimg.com/media/F48Dx0SaAAAH-Le?format=jpg&name=large');" class="min-w-40 min-h-40 rounded-xl bg-no-repeat bg-cover bg-top bg-scroll border-2 border-black">
                                    <div class="backdrop-brightness-50 rounded-xl w-full h-full hover:backdrop-brightness-75">
                                        <div class="text-white p-5 flex justify-center items-end h-full">
                                            <p>Tuyu Fashion</p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <a href="" class="flex cstma">
                                <div style="background-image: url('https://pbs.twimg.com/media/FdvFY08aAAAfCM2.jpg');" class="min-w-40 min-h-40 rounded-xl bg-no-repeat bg-cover bg-top bg-scroll border-2 border-black">
                                    <div class="backdrop-brightness-50 rounded-xl w-full h-full hover:backdrop-brightness-75">
                                        <div class="text-white p-5 flex justify-center items-end h-full">
                                            <p>ZTMY APPRL</p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="p-3">
                        <p class="text-3xl flex justify-center">Available Items</p>
                        <div class="flex pt-5 gap-3 flex-wrap md:gap-10">
                            <a class="flex cstma">
                                <div class="p-4 w-40 min-h-60 max-h-60 rounded-2xl bg-zinc-600 bg-opacity-25">
                                    <div class="h-1/2 overflow-hidden border-2 border-black ">
                                        <img src="https://us03-imgcdn.ymcart.com/65728/2023/11/21/7/b/7b7c6db51d1d31db.jpg?x-oss-process=image/quality,Q_90/auto-orient,1/resize,m_lfit,w_500,h_500" class="w-max h-max" alt="">
                                    </div>
                                    <div class="pt-3">
                                        <p class="font-bold text-lg">Rim Virtual Hoodies</p>
                                        <p>₱59.99</p>
                                    </div>
                                </div>
                            </a>
                            <a class="flex cstma">
                                <div class="p-4 w-40 min-h-60 max-h-60 rounded-2xl bg-zinc-600 bg-opacity-25">
                                    <div class="h-1/2 overflow-hidden border-2 border-black flex items-center">
                                        <img src="https://ih1.redbubble.net/image.3337343290.6390/ssrco,slim_fit_t_shirt,womens,c0daed:cfa586e239,front,square_product,600x600.jpg" class="w-max h-max" alt="">
                                    </div>
                                    <div class="pt-3">
                                        <p class="font-bold text-lg">Rim Virtual Hoodies</p>
                                        <p>₱59.99</p>
                                    </div>
                                </div>
                            </a>
                            <a class="flex cstma">
                                <div class="p-4 w-40 min-h-60 max-h-60 rounded-2xl bg-zinc-600 bg-opacity-25">
                                    <div class="h-1/2 overflow-hidden border-2 border-black flex items-center">
                                        <img src="https://pbs.twimg.com/media/F7B7jqBbcAAFYOw.jpg" class="w-max h-max" alt="">
                                    </div>
                                    <div class="pt-3">
                                        <p class="font-bold text-lg">Rim Virtual Hoodiesss</p>
                                        <p>₱59.99</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </body>
    </html>