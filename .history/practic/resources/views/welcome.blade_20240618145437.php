@extends('layouts.login')

@section('content')

    <body class="antialiased">

    <style>
        body {
            background-color:rgba(218, 175, 162, 0.918)
        }
    </style>
        <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">

            <div class='container'>
                <div class='panel panel-default'>
                    <div class='panel-heading text-center panel-relative'>

                    </div>
                </div>
            </div>

            <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
                <div class='container'>
                    <div class='panel panel-default'>
                        <div class='panel-heading text-center panel-relative'>
                            {{-- <h1 class="h3 mb-3 fw-normal"><i class="fas fa-globe"></i></h1> --}}
                            <h1 class="h3 mb-3 fw-normal">
                                <i class="fas fa-globe"></i>
                            </h1>
                            <h1 class="h3 mb-3 fw-normal"> {{ config('app.name', 'Laravel') }} </h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>

    <p class="mt-5 mb-3 text-muted">AizenSolution Inc &copy; 2011-2024</p>

@endsection
