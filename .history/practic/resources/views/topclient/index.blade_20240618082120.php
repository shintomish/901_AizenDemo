{{-- @extends('layouts.app') --}}
@extends('layouts.client')
{{-- // ユーザー 運動データダウンロード --}}
@section('content')
    <div class="row">
        <!-- 進捗ｂARエリア -->
        <div class="progress">
            <div id="pgss2" class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
            </div>
        </div>
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


        </table>
    </div>

    {{-- ページネーション / pagination）の表示 --}}
    <ul class="pagination justify-content-center">
        {{-- {{ $billdatas->appends(request()->query())->render() }} --}}
    </ul>

@endsection

@section('part_javascript')

@endsection
