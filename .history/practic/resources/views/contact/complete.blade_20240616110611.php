@extends('layouts.contact')

@section('content')
    {{-- <h5>問い合わせ</h5> --}}
    <section>
        <div class='container'>
            <div class='panel panel-default'>
                <div class='panel-heading text-center panel-relative'>
                    <h1 class="h3 mb-3 fw-normal"><i class="fas fa-landmark"></i></h1>
                    {{-- <h1 class="h3 mb-3 fw-normal"> {{ config('app.name', 'Laravel') }} </h1> --}}
                    <h1 class="h3 mb-3 fw-normal">トレーニングメニュー提供サービス</h1>
                </div>
            </div>
        </div>

        <style>
            body {
                /* background-color:rgb(239, 247, 208); 2023/11/09 */
                background-color:rgba(218, 175, 162, 0.918)
            }
        </style>
            <h3>
                <label for="1" style="margin-bottom:10px;" class="text-success">お問い合わせ完了</label>
            </h3>
            <div><a href="/">Home</a></div>
    </section>
@endsection
