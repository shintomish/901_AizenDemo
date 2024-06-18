@extends('layouts.login')

@section('content')

    <body class="antialiased">

    <style>
        body {
            background-color:rgba(218, 175, 162, 0.918)
        }
    </style>
        <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">

            <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
                <div class='container'>
                    <div class='panel panel-default'>
                        <div class='panel-heading text-center panel-relative'>
                            {{-- <h1 class="h3 mb-3 fw-normal"><i class="fas fa-globe"></i></h1> --}}
                            <h1 class="h3 mb-3 fw-normal">
                                {{-- <i class="fas fa-globe"></i> --}}
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M256 0a256 256 0 1 1 0 512A256 256 0 1 1 256 0zM232 120V256c0 8 4 15.5 10.7 20l96 64c11 7.4 25.9 4.4 33.3-6.7s4.4-25.9-6.7-33.3L280 243.2V120c0-13.3-10.7-24-24-24s-24 10.7-24 24z"/></svg>
                            </h1>
                            <h1 class="h3 mb-3 fw-normal"> {{ config('app.name', 'Laravel') }} </h1>
                        </div>
                    </div>
                </div>
            </div>

            <div class='container'>
                <div class='panel panel-default'>
                    <div class='panel-heading text-center panel-relative'>
                        @if (Route::has('login'))
                        {{-- <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block"> --}}
                        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
                            @auth
                                <a href="{{ url('/back') }}" class="text-sm text-gray-700 underline">Back</a>
                            @else
                            <p>
                                <a href="{{ route('login') }}" class="text-center underline">{{ __('Login') }}</a>
                            </p>

                                @if (Route::has('register'))
                                    {{-- <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline">Register</a> --}}
                                @endif
                            @endauth
                        </div>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </body>

    <p class="mt-5 mb-3 text-muted">AizenSolution Inc &copy; 2011-2024</p>

@endsection
