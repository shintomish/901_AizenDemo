@extends('layouts.login')

@section('content')
    <style>
        body {
            /* background-color:rgb(239, 247, 208); 2023/11/09 */
            /* background-color:rgb(208, 247, 215) */
            background-color:rgba(218, 175, 162, 0.918)
        }
    </style>
    {{-- <img class="mb-4" src="{{ asset('img/actver.png') }}" alt="" width="80" height="80"> --}}
    {{-- <i class="fas fa-project-diagram"></i> --}}
    {{-- <i class="fas fa-landmark"></i>
    <h1 class="h3 mb-3 fw-normal">{{ config('app.name', 'Laravel') }}</h1> --}}
    <div class='container'>
        <div class='panel panel-default'>
            <div class='panel-heading text-center panel-relative'>
                <h1 class="h3 mb-3 fw-normal">
                    {{-- <i class="fas fa-landmark"></i> --}}
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512 width="200px" height="100px"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M309.5 178.4L447.9 297.1c-1.6 .9-3.2 2-4.8 3c-18 12.4-40.1 20.3-59.2 20.3c-19.6 0-40.8-7.7-59.2-20.3c-22.1-15.5-51.6-15.5-73.7 0c-17.1 11.8-38 20.3-59.2 20.3c-10.1 0-21.1-2.2-31.9-6.2C163.1 193.2 262.2 96 384 96h64c17.7 0 32 14.3 32 32s-14.3 32-32 32H384c-26.9 0-52.3 6.6-74.5 18.4zM160 160A64 64 0 1 1 32 160a64 64 0 1 1 128 0zM306.5 325.9C329 341.4 356.5 352 384 352c26.9 0 55.4-10.8 77.4-26.1l0 0c11.9-8.5 28.1-7.8 39.2 1.7c14.4 11.9 32.5 21 50.6 25.2c17.2 4 27.9 21.2 23.9 38.4s-21.2 27.9-38.4 23.9c-24.5-5.7-44.9-16.5-58.2-25C449.5 405.7 417 416 384 416c-31.9 0-60.6-9.9-80.4-18.9c-5.8-2.7-11.1-5.3-15.6-7.7c-4.5 2.4-9.7 5.1-15.6 7.7c-19.8 9-48.5 18.9-80.4 18.9c-33 0-65.5-10.3-94.5-25.8c-13.4 8.4-33.7 19.3-58.2 25c-17.2 4-34.4-6.7-38.4-23.9s6.7-34.4 23.9-38.4c18.1-4.2 36.2-13.3 50.6-25.2c11.1-9.4 27.3-10.1 39.2-1.7l0 0C136.7 341.2 165.1 352 192 352c27.5 0 55-10.6 77.5-26.1c11.1-7.9 25.9-7.9 37 0z"/></svg>
                </h1>
                <h1 class="h3 mb-3 fw-normal"> {{ config('app.name', 'Laravel') }} </h1>
            </div>
        </div>
    </div>
    <form  id="form-signin" name="form-signin" method="POST" action="{{ route('login') }}">
        @csrf
        <label for="email" class="visually-hidden">{{ __('E-Mail Address') }}</label>

        <input id="email" placeholder={{ __('E-Mail Address') }}  type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

        <label for="password" class="visually-hidden">{{ __('Password') }}</label>

        <input id="password" placeholder={{ __('Password') }} type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

        <div class="checkbox mb-3">
            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

            <label class="form-check-label" for="remember">{{ __('Remember Me') }}</label>
        </div>

        <button type="submit" class="w-100 btn btn-lg btn-primary">{{ __('Login') }}</button>

        @if (Route::has('password.request'))
            <a class="btn btn-link" href="{{ route('password.request') }}">
                {{ __('Forgot Your Password?') }}
            </a>
        @endif

        <p class="mt-5 mb-3 text-muted">AizenSolution Inc &copy; 2011-2024</p>

    </form>
@endsection
