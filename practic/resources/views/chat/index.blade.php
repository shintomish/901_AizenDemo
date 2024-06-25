@extends('layouts.api2_index')

@section('content')
    <h2>チャット</h2>

    {{-- Line --}}
    <hr class="mb-4">

    <style>
        /** ５行ピッタシに調整 6行*/
        .row-5 {
            height: calc( 1.4em * 3 );
            line-height: 1.3;
            /* max-width: 600px; */
            width: 700px;
        }
        .row-6 {
            overflow:auto;
            width:700px;
            height:500px;
            padding:5px;
            border:2px dotted #ffffff;
            color:#e8e8e8;
            /* background-color:#5bc6ed; */
            line-height:1.5em;
        }
    </style>

    <script src="{{ asset('js/app.js')}}"></script>

    <script src="https://cdn.jsdelivr.net/npm/vue-moment@4.1.0/dist/vue-moment.min.js"></script>
    <body>
        <div id="chat">

            <form  class="my-2 my-lg-0 ml-2" action="{{route('chatserch')}}" method="GET">
                @csrf
                @method('get')
                <style>
                    .exright{
                        text-align: right;
                    }
                </style>
                <div class="exright">
                    <select style="margin-right:5px;width:200px;height:40px;" class="custom-select" id="customer_id" name="customer_id">
                        @foreach ($customer_findrec as $customer_findrec2)
                            @if ($customer_findrec2['id']==$customer_id)
                        <option selected="selected" value="{{ $customer_findrec2['id'] }}">{{ $customer_findrec2['business_name'] }}</option>
                            @else
                                <option value="{{ $customer_findrec2['id'] }}">{{ $customer_findrec2['business_name'] }}</option>
                            @endif
                        @endforeach
                    </select>
                    <button style="margin-bottom:10px;" type="submit" class="btn btn-primary btn_sm">送信先</button>
                </div>
            </form>

            <br>
            <div class="col-50">
                <label for="comment">コメント</label>
            </div>

            <textarea  class="row-5" v-model="message"></textarea>

            <br>
            <button class="btn btn-secondary btn-sm" @click="send()">送信</button>

            {{-- Line --}}
            <hr>
            @php
                // $user_id = 1;
                // $customer_id = 21;
            @endphp
            {{--  チャットルーム  --}}
            <div class="row-6" id="room">
                <ul class="" v-for="(m, key) in messages" :key="key">
                    {{-- 事務所はグリーン {!! nl2br(htmlspecialchars("m.body")) !!} --}}
                    <template v-if="m.to_flg === 1 && m.user_id === {{ $user_id }} && m.customer_id === {{ $customer_id }}">
                        <div class="send" style="text-align: left">
                        <span style="color: green" v-text="m.user.name"></span>
                        <span style="color: green"> :</span>&nbsp;
                        <span style="color: green" v-text="m.created_at" ></span>
                        <span style="color: green">  </span>&nbsp;
                        <div><span class="u-pre-wrap" style="color: rgb(8, 81, 238)" v-text="m.body"></span></div>
                        </div>
                    </template >
                    <template v-else-if="m.to_flg === 2 && m.customer_id === {{ $customer_id }}">
                        <div class="recieve" style="text-align: right">
                        <span style="color: rgb(238, 104, 8)" v-text="m.created_at" ></span>
                        <span style="color: rgb(238, 104, 8)"> :</span>&nbsp;
                        <span style="color: rgb(238, 104, 8)" v-text="m.user.name"></span>
                        <span style="color: rgb(238, 104, 8)">  </span>&nbsp;
                        <div><span class="u-pre-wrap" style="color: rgb(8, 81, 238)" v-text="m.body"></span></div>
                        </div>
                    </template >
                </ul>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.min.js"></script>

        <script>

            var app = new Vue({
            // new Vue({
                el: '#chat',
                data: {
                    message: '',
                    messages: []
                },
                methods: {
                    getMessages() {
                        // const url = '/ajax/chat';
                        const url = "{{ route('ajaxchatin') }}";
                        axios.get(url)
                        .then((response) => {

                            this.messages = response.data;

                        });
                    },
                    send() {
                        const url = "{{ route('ajaxchatcr') }}";
                        const params = { message: this.message};
                        axios.post(url, params)
                        .then((response) => {
                            // 成功したらメッセージをクリア
                            this.message = '';
                            this.getMessages(); // メッセージを再読込 2024/06/25 再表示
                        });
                        console.log('send');
                        // this.getMessages(); // メッセージを再読込 2024/0624 再表示
                    }
                },
                mounted() {
                    console.log('mounted');
                    this.getMessages();
                    Echo.channel('chat')
                    .listen('MessageCreated', (e) => {
                        this.getMessages(); // メッセージを再読込
                    });
                }
            });

        </script>
        {{-- 2022/11/01 --}}
        <style lang=scss scoped>
            .u-pre-wrap{
                white-space: pre-wrap;
                margin-left: 0px;
            }
        </style>

    </body>

    {{-- Line --}}
    <hr class="mb-4">

@endsection

@section('part_javascript')
{{-- ChangeSideBar("nav-item-system-user"); --}}
    <script type="text/javascript">

    </script>
@endsection
