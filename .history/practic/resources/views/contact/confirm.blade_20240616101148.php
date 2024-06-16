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
        <label for="1" style="margin-top:15px;" >確認</label>
        <div>
            <label for="name"></label>
            {{-- <input id="name" type="hidden" name="name" value="{{ old('name') }}"> --}}
            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" disabled>

        </div>

        <div>
            <label for="age"></label>
            {{-- <input id="age" type="hidden" name="age" value="{{ old('age') }}"> --}}
            <input id="age" type="text" class="form-control" name="age" value="{{ old('age') }}" disabled>
        </div>

        <div>
            <label for="sex-id"></label>
            <input id="sex-id" type="text" class="form-control" name="sex-id" value="男" disabled>
        </div>

        <div>
            <label for="level-id"></label>
            <input id="level-id" type="text" class="form-control"  name="level-id" value="S トップアスリート(世界レベル)">
        </div>

        <div>
            <label for="email"></label>
            <input id="email" type="text" class="form-control"  name="email" value="{{ old('email') }}" disabled>
            {{-- <input id="email_confirmation" type="hidden" name="email_confirmation" value="{{ old('email_confirmation') }}"> --}}
        </div>

        <div>
            <label for="body">お問い合わせ内容</label>
            <textarea id="body" type="text" name="body" class="form-control" value="{{ old('body') }}"></textarea>
        </div>

        <div>
            <button type="submit" name="submitBtnVal" value="back">戻る</button>
            <button type="submit" name="submitBtnVal" value="complete">送信</button>
        </div>

    </form>
</section>
@endsection
