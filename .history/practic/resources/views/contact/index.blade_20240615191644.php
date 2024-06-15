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
    </div>
        <style>
            body {
                /* background-color:rgb(239, 247, 208); 2023/11/09 */
                background-color:rgba(218, 175, 162, 0.918)
            }
        </style>

        @if($errors->any())
        <div>
            <ul>
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('contact.confirm') }}" method="POST">
            @csrf
            <label for="name"></label>
            <input id="name" placeholder="お名前 必須"  type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

            <label for="age"></label>
            <input id="age" placeholder="年齢 必須"  type="text" class="form-control @error('age') is-invalid @enderror" name="age" value="{{ old('age') }}" required autocomplete="age" autofocus>

            <label for="sex"></label>
            <select class="custom-select" id="sex" name="sex">
                <option value="1" >男性</option>
                <option value="2" >女性</option>
            </select>

            <select class="custom-select" id="level" name="level">
                <option value="1" >S トップアスリート(世界レベル)</option>
                <option value="2" >A アスリート(国内レベル)</option>
            </select>

            <label for="email"></label>
            <input id="email" placeholder="メールアドレス 必須"  type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

            <div>
                <label for="body"></label>
                <textarea id="body" placeholder="お問い合わせ内容 必須" class="form-control" type="text" name="body">{{ old('body') }}</textarea>
                @if($errors->has('body'))
                <p>{{ $errors->first('body') }}</p>
                @endif
            </div>

            <button type="submit" style="margin-top:5px;" class="w-50 btn btn-sm btn-primary" name="submitBtnVal" value="confirm">確認画面へ</button>

        </form>
    </section>
@endsection
