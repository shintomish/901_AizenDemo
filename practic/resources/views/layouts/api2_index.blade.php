<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <meta name="generator" content="">

        <!-- favicon.ico -->
        <link rel="shortcut icon" href="{{ asset('/favicon.ico') }}">

        <!-- Saite Seal -->

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Tytle -->
        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Bootstrap core CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

        <!-- Scripts -->

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="{{ asset('css/back/dashboard.css') }}" rel="stylesheet">

        <!-- jQuery -->
        <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src = "https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

        <!-- flash_message -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
        <script src = "https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

        <!-- Place your kit's code here -->
        <script src="https://kit.fontawesome.com/376cff10ff.js" crossorigin="anonymous"></script>

        {{-- pusher --}}

        <style>
            .bd-placeholder-img {
                font-size: 1.125rem;
                text-anchor: middle;
                -webkit-user-select: none;
                -moz-user-select: none;
                user-select: none;
            }
            @media (min-width: 768px) {
                .bd-placeholder-img-lg {
                font-size: 3.5rem;
                }
            }
        </style>

    </head>

    <body>
        <div id=’app’></div>
        <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
            <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="{{ route('top') }}">{{ config('app.name', 'Laravel') }}</a>
            <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="form-control bg-dark w-100" type="text" placeholder="" aria-label="Search"></div>
            <ul class="navbar-nav px-3">
                <li class="nav-item text-nowrap">
                    <a class="nav-link" href="{{ route('logout') }}" onclick="return logout(event);">
                        <h5 >
                            <span class="text-danger">
                                <i class="fa fa-sign-out-alt"></i> ログアウト
                            </span>
                        </h5>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    <script type="text/javascript">
                        function logout(event){
                                event.preventDefault();
                                var check = confirm("ログアウトしますか？");
                                if(check){
                                    document.getElementById('logout-form').submit();
                                }
                        }
                    </script>
                </li>
            </ul>
        </header>

        <div class="container-fluid">
            <div class="row">
                <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                    <div class="position-sticky pt-3">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link active">
                                    <i class="fas fa-address-card"></i>
                                    {{-- {{ $user->name }} --}}
                                    <?php $user = Auth::user(); ?>{{ $user->name }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link">
                                    <a class="nav-link" href="{{route('top')}}">
                                    {{-- <a class="nav-link" href="{{route('media-library')}}"> --}}
                                    <i class="fas fa-laptop-house"></i>
                                    ホーム
                                </a>
                            </li>

                            <h3 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                                <span>メニュー</span>
                                <a class="link-secondary" href="#" aria-label="Add a new report">
                                    <span data-feather="plus-circle"></span>
                                </a>
                            </h3>

                            <li class="nav-item">
                                <a class="nav-link" href="{{route('user.index')}}">
                                    {{-- <span data-feather="users"></span> --}}
                                    <i class="fas fa-user-friends"></i>
                                    利用者管理
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="{{route('exelevelname.index')}}">
                                    {{-- <span data-feather="users"></span> --}}
                                    <i class="fas fa-user-alt"></i>
                                    スポーツレベル
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="{{route('chatin')}}">
                                    <i class="fas fa-wifi"></i>
                                    チャット
                                </a>
                            </li>


                            <h3 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                                <span>運動データ</span>
                                <a class="link-secondary" href="#" aria-label="Add a new report">
                                    <span data-feather="plus-circle"></span>
                                </a>
                            </h3>

                            <ul class="nav flex-column mb-2">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('top')}}">
                                        <i class="fas fa-file-upload"></i>
                                        データアップロード
                                    </a>
                                </li>
                            </ul>
                            <ul class="nav flex-column mb-2">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('tophis')}}">
                                        <i class="fas fa-file-upload"></i>
                                        データ送信確認
                                    </a>
                                </li>
                            </ul>
                        </ul>
                    </div>
                </nav>

                <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">

                        <!-- 検索エリア -->
                        @switch ($common_no)
                            @case ('00_1')
                                <!-- タイトル -->
                                <h3>利用者管理</h3>
                                <form  class="form-inline my-2 my-lg-0 ml-2" action="{{route('userserch')}}" method="GET">
                                @break;
                            @case ('90_1')
                                @break;
                            @case ('00_2')
                                @break;
                            @case ('00_3')
                                <!-- タイトル -->
                                <!-- TOP -->
                                @break;
                            @case ('00_4')
                                <!-- タイトル -->
                                {{-- <h3>複数法人</h3> --}}
                                @break;
                            @case ('01')
                                <!-- layouts.upload 検索が日付でdatapickを使用-->
                                {{-- <h3>アップロードユーザー一覧</h3> --}}
                                @break;
                            @case ('02')
                                <!-- layouts.costomer-->
                                {{-- <h3>NEWS作成</h3> --}}
                                @break;
                            <!-- 03以降 顧客名検索 -->
                            @case ('03')
                                <!-- タイトル -->
                                {{-- <h3>納期特例</h3> --}}
                                @break;
                            @case ('04')
                                <!-- タイトル -->
                                {{-- <h3>年末調整</h3> --}}
                                @break;
                            @case ('05')
                                <!-- タイトル -->
                                {{-- <h3>会計未処理事業者</h3> --}}
                                @break;
                            @case ('06')
                                <!-- タイトル -->
                                {{-- <h3>顧問料金</h3> --}}
                                @break;
                            @case ('07')
                                <!-- タイトル -->
                                {{-- <h3>税理士業務処理簿</h3> --}}
                                @break;
                            @case ('07_2')
                                <!-- タイトル -->
                                {{-- <h3>税理士業務処理簿</h3> --}}
                                @break;
                            @case ('08')
                                <!-- タイトル -->
                                {{-- <h3>業務名管理</h3> --}}
                                @break;
                            @case ('09')
                                <!-- タイトル -->
                                {{-- <h3>進捗チェック</h3> --}}
                                @break;
                            @case ('09_1')
                                <!-- タイトル input -->
                                {{-- <h3>進捗チェック</h3> --}}
                                @break;
                            @case ('10')
                                <!-- タイトル -->
                                {{-- <h3>スケジュール</h3> --}}
                                @break;
                            @case ('00_7')
                                <!-- タイトル -->
                                {{-- <h3>会社申請・設立</h3> --}}
                                @break;
                            @default:
                                @break;
                        @endswitch

                        @csrf
                        @method('get')

                        <!-- 検索エリア -->
                        <div class='btn-toolbar' role="toolbar">
                            <div class="input-group">
                            </div>
                        </div>
                        </form>
                    </div>
                    
                    <div id="page">
                        <div id="contents">
                            @yield('content')
                        </div><!-- / #contents -->
                    </div><!-- #page -->
                    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" ></script>
                    @yield('scripts')

                    <!-- フラッシュメッセージ -->
                    @include('components.toastr')

                </main>
            </div>
        </div>

        <script src="{{ asset('js/app.js')}}" defer></script>

    </body>

</html>
