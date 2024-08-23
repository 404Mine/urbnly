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
        <link rel="icon" href="{{ asset('storage/urbnlyicontransparent.png') }}">

        <!-- Font Library -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;700&display=swap" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@100;300;700&display=swap" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Alumni+Sans+Pinstripe&display=swap" rel="stylesheet">

        <!-- CSS Library -->
        @vite('resources/css/common.css')
        @vite('resources/css/homepageloading.css')
        
        <link rel="stylesheet" href="{{ asset('css/customcss/common.css') }}">
        <link rel="stylesheet" href="{{ asset('css/customcss/homepageloading.css') }}">
        

        <!-- JS Library -->
        @vite('resources/js/nodrag.js')
        <script src="{{ asset('js/customjs/nodrag.js') }}"></script>
        <!-- Removed this for it seem to not have any effect -->
        <!-- <script src="https://kit.fontawesome.com/68a472a798.js" crossorigin="anonymous"></script> -->
    </head>
    <body>
        <!-- Maincontent -->
        <main id="home" class="home page">
            <div class="homepagebackground">
                <!-- Header -->
                <header>
                    <a href="/">
                        <svg class="logo" width="150" height="50" viewbox="0 0 455.000000 152.000000">
                            <path d="M172 72.5v47.5h3.5c3.2 0 3.5-.2 3.5-3.1v-3.1l2.8 3c3.3 3.5 7.8 4.6 15.8 4 6.5-.6 10.1-2.9 12.9-8.4 1.9-3.6 2-5.9 2-30.4 0-28.8-.2-30.3-5.7-34.3-3-2.2-11.5-3.4-17.1-2.3-1.9.4-4.6 1.7-6.1 3.1l-2.6 2.4v-25.9h-9v47.5zm28.5-19l2.5 2.4v53.2l-2.5 2.4c-1.9 2-3.4 2.5-7.7 2.5-6.8 0-9.2-1.7-10.7-7.4-1.4-5.7-1.5-43.8-.1-48.8s4.3-6.8 10.8-6.8c4.3 0 5.8.5 7.7 2.5zM327 72.5v47.5h9v-95h-9v47.5zM129.7 46.2c-2.1.6-5.1 2.3-6.7 3.9l-2.9 2.9-.3-3.2c-.3-3-.6-3.3-4-3.6l-3.8-.3v74.1h9v-29c0-32.4.2-33.4 6.5-36.4 1.9-.9 5.8-2 8.5-2.3 4.9-.6 5-.7 5-3.9 0-3.3-.1-3.4-3.7-3.3-2.1.1-5.5.6-7.6 1.1zM264.3 46.4c-1.7.8-3.8 2.7-4.6 4.3l-1.5 2.8-.7-3.8c-.7-3.5-.9-3.7-4.6-3.7h-3.9v74h10v-31.3c0-35.1-.1-34.8 7.1-36.7 5.5-1.5 10.6-.3 12.7 2.8 1.5 2.3 1.7 6.5 2 33.9l.3 31.3h8.9v-30.8c0-17.1-.4-32.3-1-34.3-.5-1.9-2.4-4.8-4-6.4-2.8-2.6-3.9-3-10.3-3.2-4.7-.2-8.3.2-10.4 1.1zM32.2 77.7c.3 29.4.4 32.1 2.3 35.8 2.8 5.7 7.2 7.7 15.7 7.3 6.3-.3 7-.6 10.8-4.3l4-3.9v3.7c0 3.7.1 3.7 4 3.7h4v-74h-9v30c0 32.7-.3 34.4-5.5 36.8-4.6 2.1-11.3 1.5-14-1.3l-2.5-2.4v-63.1h-10.1l.3 31.7zM369 47c0 .5 3.9 17.4 8.6 37.5l8.6 36.6-2.6 4.4c-2.9 4.9-7.6 7.1-12.8 6.1-2.7-.5-2.9-.4-2.6 2.2.3 2.6.5 2.7 6.8 3 3.5.2 7.4.1 8.6-.2 3.4-.9 8.3-5.4 10.5-9.9 1.8-3.4 18.9-75.5 18.9-79.4 0-1-1.1-1.3-4.2-1.1l-4.2.3-6.1 30c-3.4 16.5-6.4 30.6-6.6 31.4-.3.7-3.1-11.2-6.3-26.5-8.1-39.1-6.8-35.4-12.1-35.4-2.5 0-4.5.4-4.5 1z"/>
                        </svg>
                    </a>
                </header>
                <nav>
                    <ul>
                        <li>
                            <a href="#concept">Concept</a>
                        </li>
                        <li>
                            <a href="/Contacts">Contacts</a>
                        </li>
                        <li>
                            <a href="/Online-Store">Online Store</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </main>
        <div id="concept" class="concept page">
            <div class="concept_left">
                <h1>Concept</h1>
                <p>
                    Urbnly aims to caters small local apparel stores. This website's
                local stores can sell their own products.
                </p>
                <p>
                    Urbnly isn't just for local store apparels, but users can freely
                    buy products that is being sold by each stores that is offered!
                </p>
            </div>
            <div class="concept_right">
                <h2>urbnly</h2>
                <p>Local Aesthetic from the Philippines</p>
            </div>
        </div>
        <!-- Loading Page Screen -->
        <div class="loading">
            <img src="{{ asset('storage/urbnlywp.webp') }}" alt="" width="100%" height="100%">
        </div>
    </body>
</html>