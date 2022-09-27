<!DOCTYPE html>
<html lang='{{ str_replace('_', '-', app()->getLocale()) }}'>
    <head>
        <meta charset="utf-8">
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <meta name='csrf-token' content='{{ csrf_token() }}'>
        <meta name='csrf-param' content='_token' />

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel='stylesheet' href='https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap'>
        <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css' rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script src="{{ asset('js/app.js') }}"></script>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            <!-- Page Heading -->
            <header class='bg-white shadow'>
                <div class='max-w-7xl mx-auto px-4 sm:px-6 lg:px-8'>
                    <div class='flex justify-between h-16'>
                        <div class='flex'>
                            <!-- Logo -->
                            <div class='shrink-0 flex items-center'>
                                <h2 class='font-semibold text-xl text-gray-800 leading-tight'>
                                    <a href='{{ route('dashboard') }}'> Менеджер задач </a>
                                </h2>
                            </div>

                            <!-- Navigation Links -->
                            <div class='shrink-0 flex items-center'>
                                <div class='hidden space-x-8 sm:-my-px sm:ml-10 sm:flex'>
                                    <x-nav-link :href="route('tasks.index')" :active="request()->routeIs('tasks.index')">
                                        {{ __('Задачи') }}
                                    </x-nav-link>
                                </div>
                                <div class='hidden space-x-8 sm:-my-px sm:ml-10 sm:flex'>
                                    <x-nav-link :href="route('task_statuses.index')" :active="request()->routeIs('task_statuses.index')">
                                        {{ __('Статусы') }}
                                    </x-nav-link>
                                </div>
                                <div class='hidden space-x-8 sm:-my-px sm:ml-10 sm:flex'>
                                    <x-nav-link :href="route('labels.index')" :active="request()->routeIs('labels.index')">
                                        {{ __('Метки') }}
                                    </x-nav-link>
                                </div>
                            </div>
                        </div>

                        <!-- Settings Dropdown -->
                        <div class='hidden sm:flex sm:items-center sm:ml-6'>
                            @auth
                                <form method='POST' action="{{ route('logout') }}">
                                    @csrf
                                    <a class='btn btn-outline-success' href="{{ route('logout') }} " onclick="event.preventDefault(); this.closest('form').submit();">
                                        {{ __('Log Out') }}
                                    </a>
                                </form>
                            @endauth

                            @guest
                            <div>
                                <a class='btn btn-outline-success' href="{{ route('login') }}"> Вход </a>
                                <a class='btn btn-outline-success' href="{{ route('register') }}"> Регистрация </a>
                            </div>
                            @endguest
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main>
                <div class='container mt-3'>
                    @include('flash::message')
                </div>

                @yield('content')
            </main>
        </div>
    </body>
</html>
