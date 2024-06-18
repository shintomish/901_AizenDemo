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
                    // change_invoice_info( this_id        // 対象コントロール
                    //                     , wok_id        // invoiceテーブルのID
                    //                     , urgent_flg    // invoiceテーブルのurgent_flgの値
                    //                     );
                });

            </script>

            {{-- 進捗バー --}}
            <script>
                $(function () {
                    var count = 0;
                    $(document).on('click','#submit_new',function(){
                        if( !confirm('一括ダウンロードしますか？') ){
                            /* キャンセルの時の処理 */
                            return false;
                        }  else {
                            /*　OKの時の処理 */
                            progress(count);

                            // return true;
                        }
                            // progress(count);
                    });

                    function progress(count){
                        setTimeout(function(){
                            $("#pgss2").css({'width':count+'%'});
                            $("#pgss2").prop('aria-valuenow', count)
                            $("#pgss2").text(count + '%');
                            count++;
                            if(count == 100) {
                                $("#pgss2").hide();
                                // $("#pgss2").css({'width':0+'%'});
                                return;
                            }
                            progress(count);
                        },90);
                    }
                })
            </script>
        </table>
    </div>

    {{-- ページネーション / pagination）の表示 --}}
    <ul class="pagination justify-content-center">
        {{-- {{ $billdatas->appends(request()->query())->render() }} --}}
    </ul>

@endsection

@section('part_javascript')

@endsection
