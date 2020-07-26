<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    
    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tailwindcss/ui@latest/dist/tailwind-ui.min.css">
</head>

<body class="bg-gray-100 h-screen antialiased leading-none">
    <div id="app">
        <nav class="bg-gray-800">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between h-16">
                    <div class="flex items-center">
                        {{-- LOGO --}}
                        <div class="flex-shrink-0">
                            <a href="{{ url('/') }}">
                                <h1 class="font-bold text-white">
                                    {{ config('app.name', 'Clube do Livro') }}
                                </h1>
                            </a>
                        </div>
                        {{-- MENU FULL-WIDTH --}}
                        <div class="hidden md:block">
                            <div class="ml-10 flex items-baseline">
                                @guest
                                @else
                                <a href="/home"
                                    class="{{ Request::is('home') ? 'bg-gray-900' : '' }} px-3 py-2 rounded-md text-sm font-medium text-white focus:outline-none focus:text-white focus:bg-gray-700 hover:text-white hover:bg-gray-700 ">
                                    Início
                                </a>
                                <a href="/books"
                                    class="{{ Request::is('books') ? 'bg-gray-900' : '' }} ml-4 px-3 py-2 rounded-md text-sm font-medium text-white focus:outline-none focus:text-white focus:bg-gray-700 hover:text-white hover:bg-gray-700 ">
                                    Livros
                                </a>
                                <a href="/elections"
                                    class="{{ Request::is('elections') ? 'bg-gray-900' : '' }} ml-4 px-3 py-2 rounded-md text-sm font-medium text-white focus:outline-none focus:text-white focus:bg-gray-700 hover:text-white hover:bg-gray-700 ">
                                    Votações
                                </a>
                                @endguest
                            </div>
                        </div>
                    </div>
                    @guest
                    {{-- LINKS WHEN LOGGED OUT --}}
                    <div class="flex items-baseline">
                        <a class="no-underline hover:underline text-gray-300 text-sm p-3"
                            href="{{ route('login') }}">{{ __('Login') }}</a>
                        @if (Route::has('register'))
                        <a class="no-underline hover:underline text-gray-300 text-sm p-3"
                            href="{{ route('register') }}">{{ __('Registrar') }}</a>
                        @endif
                    </div>
                    @else
                    <div class="hidden md:block">
                        <div class="ml-4 flex items-center md:ml-6">
                            {{-- PROFILE COMPONENT --}}
                            <profile-component
                                name="{{ auth()->user()->name }}"
                                profileimage="{{ url('/images/profile.png') }}"
                                rotalogout="{{ route('logout') }}"></profile-component>

                            {{-- LOGOUT FORM --}}
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                                {{ csrf_field() }}
                            </form>
                        </div>
                    </div>
                    <div class="-mr-2 flex md:hidden">
                        {{-- HAMBURGER BUTTON --}}
                        <hamburger-menu inline-template>
                            <div>
                                <button @click="onClick"
                                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:bg-gray-700 focus:text-white">
                                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                        <path class="inline-flex" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                        <path class="hidden" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>
                        </hamburger-menu>
                    </div>
                    @endguest
                </div>
            </div>
            {{-- COLLAPSED MENU --}}
            <collapsed-menu inline-template>
                <div>
                    <div v-if="isMenuOpen" class="md:hidden">
                        @guest

                        @else
                        <div class="px-2 pt-2 pb-3 sm:px-3">
                            <a href="/home"
                                class="{{ Request::is('home') ? 'bg-gray-900' : '' }} block px-3 py-2 rounded-md text-base font-medium text-white focus:outline-none focus:text-white focus:bg-gray-700">
                                Início
                            </a>
                            <a href="/books"
                                class="{{ Request::is('books') ? 'bg-gray-900' : '' }} block px-3 py-2 rounded-md text-base font-medium text-white focus:outline-none focus:text-white focus:bg-gray-700">
                                Livros
                            </a>
                            <a href="/elections"
                                class="{{ Request::is('elections') ? 'bg-gray-900' : '' }} block px-3 py-2 rounded-md text-base font-medium text-white focus:outline-none focus:text-white focus:bg-gray-700">
                                Votações
                            </a>
                        </div>
                        <div class="pt-4 pb-3 border-t border-gray-700">
                            {{-- PROFILE INFO --}}
                            <div class="flex items-center px-5">
                                <div class="flex-shrink-0">
                                    <img class="h-10 w-10 rounded-full"
                                        src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                                        alt="" />
                                </div>
                                <div class="ml-3">
                                    <div class="text-base font-medium leading-none text-white">
                                        {{ auth()->user()->name }}</div>
                                    <div class="mt-1 text-sm font-medium leading-none text-gray-400">
                                        {{ auth()->user()->email }}</div>
                                </div>
                            </div>
                            <div class="mt-3 px-2" role="menu" aria-orientation="vertical" aria-labelledby="user-menu"
                                role="menuitem">
                                <a href="#"
                                    class="block px-3 py-2 rounded-md text-base font-medium text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700"
                                    role="menuitem">Perfil</a>
                                <a href="{{ route('logout') }} "
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                    class="mt-1 block px-3 py-2 rounded-md text-base font-medium text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700"
                                    role="menuitem">Sair</a>
                            </div>
                        </div>
                        @endguest
                    </div>
                </div>
            </collapsed-menu>
        </nav>

        @yield('content')
    </div>
</body>



</html>
