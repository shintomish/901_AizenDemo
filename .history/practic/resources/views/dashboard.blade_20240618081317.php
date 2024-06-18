<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
        <li class="nav-item text-nowrap">
            <a class="nav-link" href="{{ route('logout') }}" onclick="return logout(event);">
                {{-- <span class="text-danger"> --}}
                    {{-- <i class="fa fa-sign-out-alt"></i> ログアウト --}}
                {{-- </span> --}}
                {{-- 2022/10/17 --}}
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

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <x-welcome />
            </div>
        </div>
    </div>
</x-app-layout>
