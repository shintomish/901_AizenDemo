{{-- @extends('layouts.app') --}}
@extends('layouts.teach')

<?php
    function formatBytes($bytes, $precision = 2, array $units = null)
    {
        if ( abs($bytes) < 1024 ){
            $precision = 0;
        }

        if ( is_array($units) === false ){
            $units = array('B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
        }

        if ( $bytes < 0 ){
            $sign = '-';
            $bytes = abs($bytes);
        }else{
            $sign = '';
        }
        $exp   = floor(log($bytes) / log(1024));
        $unit  = $units[$exp];
        $bytes = $bytes / pow(1024, floor($exp));
        $bytes = sprintf('%.'.$precision.'f', $bytes);
        return $sign.$bytes.' '.$unit;
    }
?>

@section('content')
    <h2>運動データ送信確認ページ</h2>
    @if (session('message'))
        @if (session('message') == '送信処理を正常終了しました。')
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @else
            <div class="alert alert-danger">
                {{ session('message') }}
            </div>
        @endif
    @endif
    <div class="row">

        <!-- 検索エリア -->
        <form  class="my-2 my-lg-0 ml-2" action="" method="GET">
            {{-- <form  class="my-2 my-lg-0 ml-2" action="{{route('transserch_custom')}}" method="GET"> --}}
            @csrf
            @method('get')
            <style>
                .exright{
                    text-align: right;
                }
            </style>
            <div class="exright">
                <select style="margin-right:5px;width:200px;height:40px;" class="custom-select" id="user_id" name="user_id">
                    @foreach ($users as $user)
                        <option value="{{ $user['id'] }}">{{ $user['name'] }}</option>
                    @endforeach
                    {{-- <option value="1">山田五郎</option>
                    <option value="2">佐藤愛子</option> --}}
                </select>

                <button style="margin-bottom:10px;" type="submit" class="btn btn-secondary btn_sm">送信先</button>
            </div>

            <table class="table table-responsive text-nowrap table-striped table-borderd table_sticky">
                <form method="GET" action="{{ route('top.index') }}">
                    @csrf
                    @method('get')
                <thead>
                    <tr>
                        <th scope="row" class ="fixed01" >ID</th>
                        <th scope="row" class ="fixed02" >顧客名</th>
                        <th scope="row" class ="fixed02" >ファイル名</th>
                        <th scope="row" class ="fixed02" >ファイルサイズ</th>
                        <th scope="row" class ="fixed02" >送信日</th>
                        <th scope="row" class ="fixed02" >未読/既読</th>
                    </tr>
                </thead>

                <tbody>

                    @if($exercises->count())
                        @foreach($exercises as $exercise)
                        <tr>
                            @php
                                $str = sprintf("%05d", $exercise->id);
                            @endphp
                            <td>{{ $str }}</td>
                            <td>
                                @foreach ($users as $user)
                                    @if ($exercise->user_id==$user->id)
                                        {{ $user['name'] }}
                                    @endif
                                @endforeach
                            </td>
                            <td>{{ $exercise->filename }}</td>
                            @php
                                $str = "";
                                if (isset($exercise->created_at)) {
                                    $str = ( new DateTime($exercise->created_at))->format('Y-m-d');
                                }

                                $insize = $exercise->filesize;
                                if ($insize >= 1073741824) {
                                    $fileSize = round($insize / 1024 / 1024 / 1024,1) . ' GB';
                                } elseif ($insize >= 1048576) {
                                    $fileSize = round($insize / 1024 / 1024,1) . ' MB';
                                } elseif ($insize >= 1024) {
                                    $fileSize = round($insize / 1024,1) . ' KB';
                                } else {
                                    $fileSize = $insize . ' bytes';
                                }
                                $temp = $fileSize;

                                if($exercise->urgent_flg == 1) {
                                    $kidoku = '未読';
                                    $textcolor = 'text-danger';
                                } else {
                                    $kidoku = '既読';
                                    $textcolor = 'text-secondary';
                                }
                            @endphp

                            {{-- ファイルサイズ --}}
                            <td class="text-left">{{ $temp }}</td>

                            {{-- 送信日 --}}
                            <td >{{ $str }}</td>

                            {{-- 未読/既読 --}}
                            <td>
                                <h6>
                                    <p class={{ $textcolor }}>{{ $kidoku }}</p>
                                </h6>
                            </td>
                        </tr>
                        @endforeach
                    @else
                        <tr>
                            <td><p>運動データはありません。</p></td>
                            <td><p> </p></td>
                            <td><p> </p></td>
                            <td><p> </p></td>
                            <td><p> </p></td>
                            <td><p> </p></td>
                        </tr>
                    @endif
                </tbody>
            </table>
            {{-- ページネーション / pagination）の表示 --}}
            <ul class="pagination justify-content-center">
                {{ $exercises->appends(request()->query())->render() }}
            </ul>
        </form -->
        <!-- 検索エリア -->
    </div>

    <hr class="mb-4">  {{-- // line --}}

@endsection

@section('scripts')

<!-- Scripts -->
<script src="{{ asset('js/flow.min.js') }}"></script>


@endsection
