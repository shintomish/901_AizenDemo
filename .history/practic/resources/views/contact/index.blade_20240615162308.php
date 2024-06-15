@extends('layouts.contact')

@section('content')
    {{-- <h5>問い合わせ</h5> --}}
    <section>
        <div class='container'>
            <div class='panel panel-default'>
                <div class='panel-heading text-center panel-relative'>
                    <h1 class="h3 mb-3 fw-normal"><i class="fas fa-landmark"></i></h1>
                    <h1 class="h3 mb-3 fw-normal"> {{ config('app.name', 'Laravel') }} </h1>
                </div>
            </div>
        </div>
        <style>
            body {
                /* background-color:rgb(239, 247, 208); 2023/11/09 */
                background-color:rgb(208, 247, 215)
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
            <input id="name" placeholder="お名前 必須"  type="text" class="form-control @error('name') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

            <div>
                <label for="name">お名前<span>必須</span></label>
                <input id="name"  class="form-control" type="text" name="name" value="{{ old('name') }}">
                @if($errors->has('name'))
                <p>{{ $errors->first('name') }}</p>
                @endif
            </div>

            <div>
                <label for="name_kana">フリガナ<span>必須</span></label>
                <input id="name_kana"  class="form-control" type="text" name="name_kana" value="{{ old('name_kana') }}">
                @error('name_kana')
                <p>{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="phone">電話番号</label>
                <input id="phone"  class="form-control" type="text" name="phone" value="{{ old('phone') }}">
                @error('phone')
                <p>{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="email">メールアドレス<span>必須</span></label>
                <input id="email"  class="form-control" type="email" name="email" value="{{ old('email') }}">
                @if($errors->has('email'))
                <p>{{ $errors->first('email') }}</p>
                @endif
            </div>

            <div>
                <label for="email_confirmation">メールアドレスの確認<span>必須</span></label>
                <input id="email_confirmation"  class="form-control" type="email" name="email_confirmation" value="{{ old('email_confirmation') }}">
                @if($errors->has('email_confirmation'))
                <p>{{ $errors->first('email_confirmation') }}</p>
                @endif
            </div>

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
