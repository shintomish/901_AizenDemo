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
            <label class="text-left" for="name">{{ __('お名前') }}<span class="badge badge-danger ml-2">{{ __('必須') }}</span></label>
            <input id="name" placeholder="お名前"  type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

            <label class="text-left" for="age">{{ __('年齢') }}<span class="badge badge-danger ml-2">{{ __('必須') }}</span></label>
            <input id="age" placeholder="年齢"  type="text" class="form-control @error('age') is-invalid @enderror" name="age" value="{{ old('age') }}" required autocomplete="age" autofocus>

            <!--  性別プルダウン -->
            <div class="form-group">
                <label class="text-left" for="sex-id">{{ __('性別') }}<span class="badge badge-danger ml-2">{{ __('必須') }}</span></label>
                <select class="form-control" id="sex-id" name="sex_id">
                    <option value="1">男性</option>
                    <option value="2">女性</option>
                </select>
            </div>

            <!--  スポーツレベルプルダウン -->
            <div class="form-group">
                <label class="text-left" for="level-id">{{ __('スポーツレベル') }}<span class="badge badge-danger ml-2">{{ __('必須') }}</span></label>
                <select class="form-control" id="level-id" name="level_id">
                    <option value="1">S トップアスリート(世界レベル)</option>
                    <option value="2">A アスリート(国内レベル)</option>
                    <option value="3">B アスリート(都道府県レベル)</option>
                    <option value="4">C マスターズ(国際レベル)</option>
                    <option value="5">D マスターズ(国内レベル)</option>
                </select>
            </div>

            <label class="text-left" for="email">{{ __('メールアドレス') }}<span class="badge badge-danger ml-2">{{ __('必須') }}</span></label>
            <input id="email" placeholder="メールアドレス"  type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

            <div>
                <label class="text-left" for="body">お問い合わせ内容</label>
                <textarea id="body" placeholder="お問い合わせ内容" class="form-control" type="text" name="body">{{ old('body') }}</textarea>
                @if($errors->has('body'))
                <p>{{ $errors->first('body') }}</p>
                @endif
            </div>

            <button type="submit" style="margin-top:5px;" class="w-50 btn btn-sm btn-primary" name="submitBtnVal" value="confirm">確認画面へ</button>

        </form>
    </section>
@endsection
