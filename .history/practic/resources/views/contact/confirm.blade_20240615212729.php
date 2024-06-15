@extends('layouts.contact')

@section('content')

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

    <form action="{{ route('contact.confirm') }}" method="POST">
        @csrf

        <div>
            <label for="name">お名前</label>
            {{-- <input id="name" type="hidden" name="name" value="{{ old('name') }}"> --}}
            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}">

        </div>

        <div>
            <label for="age">年齢</label>
            {{ old('age') }}
            <input id="age" type="hidden" name="age" value="{{ old('age') }}">
        </div>

        <div>
            <label for="sex-id">性別</label>
            {{ old('sex-id') }}
            <input id="sex-id" type="hidden" name="sex-id" value="{{ old('sex-id') }}">
        </div>

        <div>
            <label for="level-id">レベル</label>
            {{ old('level-id') }}
            <input id="level-id" type="hidden" name="level-id" value="{{ old('level-id') }}">
        </div>

        <div>
            <label for="email">メールアドレス</label>
            {{ old('email') }}
            <input id="email" type="hidden" name="email" value="{{ old('email') }}">
            <input id="email_confirmation" type="hidden" name="email_confirmation" value="{{ old('email_confirmation') }}">
        </div>

        <div>
            <label for="body">お問い合わせ内容</label>
            {{ old('body') }}
            <input id="body" type="hidden" name="body" value="{{ old('body') }}">
        </div>

        <div>
            <button type="submit" name="submitBtnVal" value="back">戻る</button>
            <button type="submit" name="submitBtnVal" value="complete">送信</button>
        </div>

    </form>
</section>
@endsection
