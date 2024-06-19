@extends('layouts.client')

{{-- // ユーザー 運動データダウンロード --}}
@section('content')
<h2>運動データダウンロード</h2>
    <div class="row">
        <!-- 進捗BARエリア -->
        {{-- <div class="progress">
            <div id="pgss2" class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
            </div>
        </div> --}}
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
                    <th scope="col">未読/既読</th>
                    <th scope="col"></th>
                    <th scope="col">操作</th>
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

                        // 既読フラグ(1):未読 (2):未読
                        if($exercise->urgent_flg == 1) {
                            $strvalue = "ダウンロード";
                            $clsvalue = "btn btn-danger btn-lg";
                            $strstyle = "color:red";
                            $strnews  = "NEW";
                            $clslight = "light_box";    //点滅
                        } else {
                            $strvalue = "ダウンロード";
                            $clsvalue = "btn btn-secondary btn-lg";
                            $strstyle = "";
                            $strnews  = "";
                            $clslight = "";
                        }
                        @endphp

                        {{-- ファイルサイズ --}}
                        <td class="text-left">{{ $temp }}</td>

                        {{-- 受信日 --}}
                        <td >{{ $str }}</td>

                        {{-- 未読/既読 --}}
                        <td>
                            <h6>
                                <p class={{ $textcolor }}>{{ $kidoku }}</p>
                            </h6>
                        </td>
                        <td>
                            <h6 >
                                <p name="shine_{{$exercise->id}}" id="shine_{{$exercise->id}}" class="{{$clslight}}" ><label name="label_{{$exercise->id}}" style="margin-top:10px;" >{{$strnews}}</label>
                                </p>
                            </h6>
                        </td>
                        <td>
            <input class="btn btn-secondary btn-sm" type="submit" id="btn_del_{{$exercise->id}}" name="btn_del_{{$exercise->id}}" id2="btn_del_{{$exercise->urgent_flg}}" value="ダウンロード" >
                        </td>
                    </tr>
                    @endforeach
                @else
                    <tr>
                        <td><p>ダウンロードデータはありません。</p></td>
                        <td><p> </p></td>
                        <td><p> </p></td>
                        <td><p> </p></td>
                        <td><p> </p></td>
                        <td><p> </p></td>
                        <td><p> </p></td>
                    </tr>
                @endif
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
            <script type="text/javascript">
                $('input[name^="btn_del_"]').click( function(e){
                    // alert('ダウンロードbtnClick');
                    var wok_id       = $(this).attr("name").replace('btn_del_', '');
                    var this_id      = $(this).attr("id");
                    var urgent_flg   = $(this).attr("id2").replace('btn_del_', '');
                    var url          = "pdf/" + wok_id;
                    $('#temp_form').method = 'POST';
                    $('#temp_form').submit();
                    var popup = window.open(url,"preview","width=800, height=600, top=200, left=500 scrollbars=yes");

                });

            </script>
        </table>
    </div>

    {{-- ページネーション / pagination）の表示 --}}
    <ul class="pagination justify-content-center">
        {{ $exercises->appends(request()->query())->render() }}
    </ul>

@endsection

@section('part_javascript')

@endsection
