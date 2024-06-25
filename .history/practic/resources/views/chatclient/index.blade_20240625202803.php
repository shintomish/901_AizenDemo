@extends('layouts.api3_index')

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

    <body>
        <div id="chat">

            <form  class="my-2 my-lg-0 ml-2" action="{{route('chatclientserch')}}" method="GET">
                @csrf
                @method('get')
                <style>
                    .exright{
                        text-align: right;
                    }
                </style>
                <div class="exright">
                    <select style="margin-right:5px;width:150px;height:40px;" class="custom-select" id="user_id" name="user_id">
                        @foreach ($users as $user)
                            @if ($user['id']==$user_id)
                            <option selected="selected" value="{{ $user['id'] }}">{{ $user['name'] }}</option>
                            @else
                            <option value="{{ $user['id'] }}">{{ $user['name'] }}</option>
                            @endif
                        @endforeach
                    </select>
                    <button style="margin-bottom:10px;" type="submit" class="btn btn-primary btn_sm">送信先</button>
                </div>
            </form>
            <br>
            <div class="col-2">
                <label for="comment">コメント</label>
            </div>

            <textarea  style="" class="row-5" v-model="message"></textarea>

            <br>
            <button class="btn btn-secondary btn-sm" @click="send()">送信</button>

            {{-- Line --}}
            <hr>
            @php

            @endphp
            {{--  チャットルーム  --}}
            <div class="row-6" id="room">
                <ul class="" v-for="(m, key) in messages" :key="key">
                    {{-- 事務所はグリーン --}}
                    <template v-if="m.to_flg === 1 && m.user_id === {{ $user_id }} && m.customer_id === {{ $customer_id }}">
                        <div class="recieve" style="text-align: right">
                        <span style="color: green" v-text="m.created_at"></span>
                        <span style="color: green"> :</span>&nbsp;
                        <span style="color: green" v-text="m.user.name"></span>
                        <span style="color: green">  </span>&nbsp;
                        <div><span class="u-pre-wrap" style="color: rgb(8, 81, 238)" v-text="m.body"></span></div>
                        </div>
                    </template >
                    <template v-else-if="m.to_flg === 2 && m.user_id === {{ $user_id }} && m.customer_id === {{ $customer_id }}">
                        <div class="send" style="text-align: left">
                        <span style="color: rgb(238, 104, 8)" v-text="m.business_name"></span>
                        <span style="color: rgb(238, 104, 8)"> :</span>&nbsp;
                        <span style="color: rgb(238, 104, 8)" v-text="m.created_at"></span>
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
            new Vue({
                el: '#chat',
                data: {
                    message: '',
                    messages: []
                },
                methods: {
                    getMessages() {
                        const url = "{{ route('ajaxchatclientin') }}";
                        axios.get(url)
                        .then((response) => {
                            this.messages = response.data;
                        });
                    },
                    send() {
                        const url = "{{ route('ajaxchatclientcr') }}";
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
