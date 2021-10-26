<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Door middel van defer wordt de javascript pas ingeladen als de pagina is ingeladen
   https://developer.mozilla.org/en-US/docs/Web/HTML/Element/script -->
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>

<body class="h-screen overflow-hidden flex items-center justify-center" style="background: #edf2f7;">
<div class="h-screen w-full flex overflow-hidden">
    <nav class="flex flex-col bg-gray-200 dark:bg-gray-900 w-64 px-12 pt-4 pb-6">
        <!-- SideNavBar -->

        <div class="flex flex-row border-b items-center justify-between pb-2">
            <!-- Hearder -->
            <span class="text-lg font-semibold capitalize dark:text-gray-300">
				my admin
			</span>

            <span class="relative ">
				<a
                    class="hover:text-green-500 dark-hover:text-green-300
					text-gray-600 dark:text-gray-300"
                    href="inbox/">
					<svg
                        width="24"
                        height="24"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round">
						<path
                            d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
						<path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
					</svg>
				</a>
				<div
                    class="absolute w-2 h-2 rounded-full bg-green-500
					dark-hover:bg-green-300 right-0 mb-5 bottom-0"></div>
			</span>

        </div>

        <div class="mt-8">
            <!-- User info -->
            <img
                class="h-12 w-12 rounded-full object-cover"
                src="https://appzzang.me/data/editor/1608/f9c387cb6bd7a0b004f975cd92cbe2d9_1471626325_6802.png"
                alt="enoshima profile"/>
            <h2
                class="mt-4 text-xl dark:text-gray-300 font-extrabold capitalize">
                Hello
                @guest
                    Guest
                @else
                    {{ Auth::user()->name }}
                @endguest
            </h2>
            <span class="text-sm dark:text-gray-300">
				<span class="font-semibold text-green-600 dark:text-green-300">
					Role....
				</span>
			</span>
        </div>

        <ul class="mt-2 text-gray-600">
            <!-- Links -->
            @guest
                <li class="mt-8">
                    <a href="{{ route('login') }}">
                        <span class="ml-2 capitalize font-medium text-black dark:text-gray-300">{{ __('Login') }}</span>
                    </a>
                </li>
                @if (Route::has('register'))
                    <li class="mt-8">
                        <a href="{{ route('register') }}">
                            <span class="ml-2 capitalize font-medium text-black dark:text-gray-300">{{ __('Register') }}</span>
                        </a>
                    </li>
                    @endif
            @else
                <li class="mt-8">
                    <a href="{{ route('categories.index') }}" class="flex ">
                        <span class="ml-2 capitalize font-medium text-black dark:text-gray-300">Category Admin</span>
                    </a>
                </li>
                <li class="mt-8">
                    <a href="{{ route('products.index') }}" class="flex ">
                        <span class="ml-2 capitalize font-medium text-black dark:text-gray-300">Product Admin</span>
                    </a>
                </li>
            @endguest
        </ul>

        <div class="mt-auto flex items-center text-red-700 dark:text-red-400">
            <!-- important action -->
            <a href="{{ route('logout') }}" class="flex items-center" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                <svg class="fill-current h-5 w-5" viewBox="0 0 24 24">
                    <path
                        d="M16 17v-3H9v-4h7V7l5 5-5 5M14 2a2 2 0 012
						2v2h-2V4H5v16h9v-2h2v2a2 2 0 01-2 2H5a2 2 0 01-2-2V4a2 2
						0 012-2h9z"></path>
                </svg>
                <span class="ml-2 capitalize font-medium"> {{ __('Logout') }}</span>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </nav>
    <main
        class="flex-1 flex flex-col bg-gray-100 dark:bg-gray-700 transition
		duration-500 ease-in-out overflow-y-auto">
        <div class="mx-10 my-2">
            <nav
                class="flex flex-row justify-between border-b
				dark:border-gray-600 dark:text-gray-400 transition duration-500
				ease-in-out">
                <div class="flex">
                    <!-- Top NavBar -->
                    @yield('topmenu_items')
                </div>

                <div class="flex items-center select-none">
					<span
                        class="hover:text-green-500 dark-hover:text-green-300
						cursor-pointer mr-3 transition duration-500 ease-in-out">
						<svg viewBox="0 0 512 512" class="h-5 w-5 fill-current">
							<path
                                d="M505 442.7L405.3
								343c-4.5-4.5-10.6-7-17-7H372c27.6-35.3 44-79.7
								44-128C416 93.1 322.9 0 208 0S0 93.1 0 208s93.1
								208 208 208c48.3 0 92.7-16.4 128-44v16.3c0 6.4
								2.5 12.5 7 17l99.7 99.7c9.4 9.4 24.6 9.4 33.9
								0l28.3-28.3c9.4-9.4 9.4-24.6.1-34zM208 336c-70.7
								0-128-57.2-128-128 0-70.7 57.2-128 128-128 70.7 0
								128 57.2 128 128 0 70.7-57.2 128-128 128z"></path>
						</svg>
					</span>
                    <input
                        class="w-12 bg-transparent focus:outline-none"
                        placeholder="Search"/>
                </div>
            </nav>

            <div
                class="pb-2 flex items-center justify-between text-gray-600
				dark:text-gray-400 border-b dark:border-gray-600">

                @yield('content')

            </div>
        </div>
    </main>
</div>
</body>
</html>

