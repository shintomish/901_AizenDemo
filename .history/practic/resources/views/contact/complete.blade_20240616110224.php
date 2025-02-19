@extends('layouts.contact')

<section>
    <h1>
        お問い合わせ完了
    </h1>

    <div><a href="/">Home</a></div>
</section>
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

        @if($errors->any())
            <div>
                <ul>
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('contact.send') }}" method="POST">
            @csrf
            <h6>
                <label for="1" style="margin-bottom:10px;" class="text-warning">以下を入力してください</label>
            </h6>
            <div>
                {{-- <label for="name"></label> --}}
                <input id="name" style="margin-top:10px;"  placeholder="お名前 必須"  type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
            </div>

            <div>
                {{-- <label for="age"></label> --}}
                <input id="age"  style="margin-top:10px;" placeholder="年齢 必須"  type="text" class="form-control @error('age') is-invalid @enderror" name="age" value="{{ old('age') }}" required autocomplete="age" autofocus>
            </div>

            <!--  性別プルダウン -->
            <div class="form-group">
                {{-- <label for="sex-id"></label> --}}
                <select  style="margin-top:10px;" class="form-control" id="sex-id" name="sex_id">
                    <option value="1">男性</option>
                    <option value="2">女性</option>
                </select>
            </div>

            <!--  スポーツレベルプルダウン -->
            <div class="form-group">
                {{-- <label for="level-id"></label> --}}
                <select  style="margin-top:10px;" class="form-control" id="level-id" name="level_id">
                    <option value="1">S トップアスリート(世界レベル)</option>
                    <option value="2">A アスリート(国内レベル)</option>
                    <option value="3">B アスリート(都道府県レベル)</option>
                    <option value="4">C マスターズ(国際レベル)</option>
                    <option value="5">D マスターズ(国内レベル)</option>
                </select>
            </div>

            <div>
                {{-- <label for="email"></label> --}}
                <input id="email"  style="margin-top:10px;" placeholder="メールアドレス 必須" name="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                {{-- @if($errors->has('email'))
                <p>{{ $errors->first('email') }}</p>
                @endif --}}
            </div>

            <div>
                {{-- <label for="email_confirmation"></label> --}}
                <input id="email_confirmation"  style="margin-top:10px;" placeholder="メールアドレスの確認 必須" type="email" class="form-control @error('email') is-invalid @enderror" name="email_confirmation" value="{{ old('email') }}" required autocomplete="email" autofocus>
                {{-- @if($errors->has('email_confirmation'))
                <p>{{ $errors->first('email_confirmation') }}</p>
                @endif --}}
            </div>

            <div>
                {{-- <label for="body"></label> --}}
                {{-- <textarea id="body" placeholder="お問い合わせ内容 必須" class="form-control" type="text" name="body">{{ old('body') }}</textarea> --}}
                <textarea id="body"  style="margin-top:10px;" placeholder="お問い合わせ内容 必須" type="text" class="form-control @error('body') is-invalid @enderror" name="body" value="{{ old('body') }}" required autocomplete="body" autofocus></textarea>

                {{-- @if($errors->has('body'))
                <p>{{ $errors->first('body') }}</p>
                @endif --}}
            </div>

            <button type="submit" style="margin-top:10px;" class="w-50 btn btn-sm btn-primary" name="submitBtnVal" value="complete">送信</button>

        </form>
    </section>
@endsection
