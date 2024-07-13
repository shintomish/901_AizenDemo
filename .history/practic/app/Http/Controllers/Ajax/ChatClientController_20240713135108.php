<?php

namespace App\Http\Controllers\Ajax;

// use App\Models\User;
// use App\Models\Customer;
use App\Models\Announcement;
use App\Models\AnnouncementRead;

use App\Models\Message;
use App\Events\MessageCreated;
// use App\Events\HelloPusher;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ChatClientController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() { // 新着順にメッセージ一覧を取得

        Log::info('Ajax ChatClientController index START');

        // ログインユーザーのユーザー情報を取得する
        $user  = $this->auth_user_info();
        $user_id         = $user->id;
        $organization_id =  1;

        Log::debug('Ajax ChatClientController index  ログインユーザーの$user_id = ' . print_r($user_id,true));

        Log::info('Ajax ChatClientController index END');

        return Message::where('organization_id', $organization_id)
                ->with('user')
                ->orderBy('id', 'desc')
                ->get();

    }

    public function create(Request $request) { // メッセージを登録

        Log::info('Ajax ChatClientController create START');

        $user            = Auth::user();
        $user_id         = $user->user_id;
        $customer_id     = $user->user_id;
        $organization_id = 1;

        /**
         * chatcliで選択されたuser_idを取得する
         */
        $retval = $this->chatcli_json_get_info($user_id);
        $u_id   = $retval['u_id'];
        $to_user_id   = $retval['customer_id'];

        $message = $user->messages()->create([
            'body'            => $request->input('message'),
            'to_flg'          => 2,
            'to_user_id'      => $to_user_id,
            'user_id'         => $u_id,
            'customer_id'     => $customer_id,
            'organization_id' => 1,
        ]);

        Log::info('Ajax ChatClientController create END');

        $to_flg = 2;

        // イベント発火
        // event(new \App\Events\HelloPusher('テストメッセージbb'));

        // event(new MessageCliantCreated($user, $organization_id, $to_flg, $user_id, $to_user_id, $customer_id, $message));

        broadcast(new MessageCreated($user, $organization_id, $to_flg, $u_id, $to_user_id, $customer_id, $message));

        $announcement_read = new AnnouncementRead();
        $announcement_read->user_id = $user_id;
        $announcement_read->user_id = $user_id;
        $announcement_read->save();               //  Insertsfalse
        // return ['status' => 'Message Sent!'];

    }
}
