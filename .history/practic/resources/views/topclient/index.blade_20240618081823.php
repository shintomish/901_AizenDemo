{{-- @extends('layouts.app') --}}
@extends('layouts.client')
{{-- // ユーザー 運動データダウンロード --}}
@section('content')
    <div class="row">
        <div class="progress">
            <div id="pgss2" class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
            </div>
        </div>
        <!-- 検索エリア -->

        <!-- 検索エリア -->
    </div>

    <div class="table-responsive">

        <table class="table table-striped table-borderd">
            <thead>
                <tr>
                    <th class="text-left"scope="col">ID</th>
                    <th scope="col">受信ファイル名</th>
                    <th class="text-left" scope="col">ファイルサイズ</th>
                    <th scope="col">受信日</th>
                    <th scope="col">操作</th>
                </tr>
            </thead>

            <tbody id="table" >

            </tbody>
            <style>
                /* 点滅 */
                .light_box{
                    width: 40px;
                    height: 40px;
                    margin: 5px auto;
                    opacity: 0;
                    background-color:rgb(255, 0, 0);
                    border-radius: 3.0rem;
                    animation: flash 1.5s infinite linear;
                    color:rgb(254, 254, 254);
                }
                @keyframes flash {
                    50% {
                    opacity: 1;
                    }
                }
            </style>


        </table>
    </div>

    {{-- ページネーション / pagination）の表示 --}}
    <ul class="pagination justify-content-center">
        {{-- {{ $billdatas->appends(request()->query())->render() }} --}}
    </ul>

@endsection

@section('part_javascript')

@endsection
