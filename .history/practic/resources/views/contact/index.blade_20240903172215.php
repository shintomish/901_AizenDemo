@extends('layouts.contact')

@section('content')
    {{-- <h5>問い合わせ</h5> --}}
    <section>
        <div class='container'>
            <div class='panel panel-default'>
                <div class='panel-heading text-center panel-relative'>
                    <h1 class="h3 mb-3 fw-normal">
                        {{-- <i class="fas fa-landmark"></i> --}}
                        {{-- <svg width="50" height="50" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M256 0a256 256 0 1 1 0 512A256 256 0 1 1 256 0zM232 120V256c0 8 4 15.5 10.7 20l96 64c11 7.4 25.9 4.4 33.3-6.7s4.4-25.9-6.7-33.3L280 243.2V120c0-13.3-10.7-24-24-24s-24 10.7-24 24z"/></svg> --}}
                    </h1>
                    <h1 class="h3 mb-3 fw-normal"> {{ config('app.name', 'Laravel') }} </h1>
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
                    <li class="text-danger">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('contact.send') }}" method="POST">
            @csrf
            <h6>
                <ul for="inp" style="margin-bottom:10px;" class="text-primary">以下を入力してください</ul>
            </h6>
            <div>
                {{-- <label for="name"></label> --}}
                <input id="name" style="margin-top:10px;"  placeholder="お名前 必須"  type="text" class="form-control" @error('name') is-invalid @enderror name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
            </div>

            <div>
                {{-- <label for="age"></label> --}}
                <input id="age"  style="margin-top:10px;" placeholder="年齢 必須"  type="text" class="form-control" @error('age') is-invalid @enderror name="age" value="{{ old('age') }}" required autocomplete="age" autofocus>
            </div>

            <!--  性別プルダウン -->
            <div class="form-group">
                {{-- <label for="sex-id"></label> --}}
                <select style="margin-top:10px;" class="form-control" id="sex-id" name="sex_id">
                    {{-- <option value="1">男性</option>
                    <option value="2">女性</option> --}}
                    {{-- //Providers/AppServiceProvider.php --}}
                    @foreach ($loop_sex_flg as $loop_sex_flg2)
                    <option value="{{$loop_sex_flg2['no']}}" @if(old('sex-id')==$loop_sex_flg2['no']) 'selected' @endif > {{$loop_sex_flg2['name']}} </option>
                    @endforeach
                </select>
            </div>

            <!--  スポーツレベルプルダウン -->
            <div class="form-group">
                {{-- <label for="level-id"></label> --}}
                <select style="margin-top:10px;" class="form-control" id="level-id" name="level_id">
                    {{-- <option value="1">S トップアスリート(世界レベル)</option>
                    <option value="2">A アスリート(国内レベル)</option>
                    <option value="3">B アスリート(都道府県レベル)</option>
                    <option value="4">C マスターズ(国際レベル)</option>
                    <option value="5">D マスターズ(国内レベル)</option> --}}
                @foreach ($exelevel as $exelevel2)
                    <option value="{{$exelevel2->id}}" @if(old('level-id')==$exelevel2->id) 'selected' @endif > {{$exelevel2->name}} </option>
                @endforeach
                </select>
            </div>

            <div>
                {{-- <label for="email"></label> --}}
                <input id="email"  style="margin-top:10px;" placeholder="メールアドレス 必須" name="email" type="email" class="form-control" @error('email') is-invalid @enderror name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                {{-- @if($errors->has('email'))
                <p>{{ $errors->first('email') }}</p>
                @endif --}}
            </div>

            <div>
                {{-- <label for="email_confirmation"></label> --}}
                <input id="email_confirmation"  style="margin-top:10px;" placeholder="メールアドレスの確認 必須" type="email" class="form-control" @error('email') is-invalid @enderror name="email_confirmation" value="{{ old('email') }}" required autocomplete="email" autofocus>
                {{-- @if($errors->has('email_confirmation'))
                <p>{{ $errors->first('email_confirmation') }}</p>
                @endif --}}
            </div>

            <div>
                {{-- <label for="body"></label> --}}
                <textarea id="body"  style="margin-top:10px;" placeholder="お問い合わせ内容 必須" class="form-control" type="text" name="body">{{ old('body') }}</textarea>
                {{-- <textarea id="body" style="margin-top:10px;" placeholder="お問い合わせ内容 必須" type="text" class="form-control" @error('body') is-invalid @enderror name="body" value="{{ old('body') }}" required autocomplete="body" autofocus></textarea> --}}

                {{-- @if($errors->has('body'))
                <p>{{ $errors->first('body') }}</p>
                @endif --}}
            </div>

            <button type="submit" style="margin-top:10px;" class="w-50 btn btn-sm btn-primary" name="submitBtnVal" value="complete">送信</button>

            <div>
                {{-- <label for="body"></label> --}}
                <textarea id="body"  style="margin-top:10px;" placeholder="仮登録後、ログインお問い合わせ内容 必須" class="form-control" type="text" name="body"></textarea>
                {{-- <textarea id="body" style="margin-top:10px;" placeholder="お問い合わせ内容 必須" type="text" class="form-control" @error('body') is-invalid @enderror name="body" value="{{ old('body') }}" required autocomplete="body" autofocus></textarea> --}}

                {{-- @if($errors->has('body'))
                <p>{{ $errors->first('body') }}</p>
                @endif --}}
            </div>
        <!-- ５行にしたいテキストエリア 未使用 -->
        <style>
            /** ５行ピッタシに調整 6行*/
            .row-5 {
                height: calc( 1.4em * 4 );
                line-height: 1.3;
                width: 274px;
                margin-top:5px;
                margin-bottom:5px;
            }
        </style>
        </form>
    </section>
@endsection
