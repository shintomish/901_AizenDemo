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
            <input id="name" placeholder="お名前 必須"  type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

            <input id="age" placeholder="年齢 必須"  type="text" class="form-control @error('age') is-invalid @enderror" name="age" value="{{ old('age') }}" required autocomplete="age" autofocus>

            <input id="email" placeholder="メールアドレス 必須"  type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>


            <div>
                <label for="body">お問い合わせ内容<span>必須</span></label>
                <textarea id="body"  class="form-control" type="text" name="body">{{ old('body') }}</textarea>
                @if($errors->has('body'))
                <p>{{ $errors->first('body') }}</p>
                @endif
            </div>

            <div>
                <button type="submit" name="submitBtnVal" value="confirm">確認画面へ</button>
            </div>

        </form>
    </section>
@endsection
