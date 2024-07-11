<html>
    <head>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    </head>
    <body>
        <div id="app">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                お知らせ機能サンプル
                <div class="collapse navbar-collapse">
                    <ul class="navbar-nav ml-auto">

                        <!-- ③ 独自コンポーネントを表示 -->
                        <v-dropdown-nav-item v-model:items="announcements">

                            <!-- 表示するアイコン -->
                            <i class="far fa-bell"></i>

                            <!-- フッターは任意です -->
                            <template v-slot:footer>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item text-center text-secondary" href="#">
                                    <small>全てのお知らせを見る</small>
                                </a>
                            </template>

                        </v-dropdown-nav-item>

                    </ul>
                </div>
            </nav>
        </div>

        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
        <script src="https://unpkg.com/vue@3.0.2/dist/vue.global.prod.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.min.js"></script>

        <script>

            // ① ドロップダウンを表示するVueコンポーネントを定義
            const dropdownNavItemComponent = {
                props: ['items'],
                computed: {
                    hasItem() {

                        return (
                            Object.keys(this.items).length > 0 &&
                            this.items.data.length > 0
                        );

                    }
                },
                template:

            };

            Vue.createApp({
                data() {
                    return {
                        announcements: {}
                    }
                },
                mounted() {

                    const url = '{{ route('announcement.list') }}';
                    axios.get(url)
                        .then(response => {

                            this.announcements = response.data;

                        });

                }
            })
            .component('v-dropdown-nav-item', dropdownNavItemComponent) // ② コンポーネントをセット
            .mount('#app');

        </script>
    </body>
</html>

