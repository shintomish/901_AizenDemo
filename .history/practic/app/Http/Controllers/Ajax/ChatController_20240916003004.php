<?php

namespace App\Http\Controllers\Ajax;

// use App\Models\User;
use App\Models\Message;
use App\Events\MessageCreated;
// use App\Events\HelloPusher;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ChatController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() { // 新着順にメッセージ一覧を取得

        Log::info('Ajax ChatController index START');

        // ログインユーザーのユーザー情報を取得する
        $user      = $this->auth_user_info();
        $user_id   = $user->id;
        $organization_id =  1;

        Log::debug('Ajax ChatClientController index  $user_id = ' . print_r($user_id,true));

        Log::info('Ajax ChatController index END');

        // return Message::orderBy('id', 'desc')->get();
        return Message::where('organization_id', $organization_id)
                ->with('user')
                ->orderBy('id', 'desc')
                ->get();

    }

    public function create(Request $request) { // メッセージを登録

        Log::info('Ajax ChatController create START');

        $user      = Auth::user();
        $user_id   = $user->id;
        $organization_id = 1;
        $user_name       = $user->name;
        /**
         * chattopで選択されたcustomer_idを取得する
         */
        $retval = $this->chattop_json_get_info($user_id);
        $customer_id = $retval['customer_id'];

        $message = $user->messages()->create([
            'body'            => $request->input('message'),
            'to_flg'          => 1,
            'user_id'         => $user_id,
            'to_user_id'      => $customer_id,
            'customer_id'     => $customer_id,
            'organization_id' => $organization_id,
        ]);

        Log::info('Ajax ChatController create END');

        $to_flg = 1;
        $to_user_id = $customer_id;

        // event(new MessageCreated($user, $organization_id, $to_flg, $user_id, $to_user_id, $customer_id, $message));
        broadcast(new MessageCreated($user, $organization_id, $to_flg, $user_id, $to_user_id, $customer_id, $message));

        $descrip = $user_name . 'さん から通知がありました';

        $announcement = new Announcement();
        $announcement->from_user_id = $u_id;
        $announcement->title        = $descrip;
        $announcement->description  = $message['body'];
        $announcement->save();               //  Inserts description

        $announcement_read = new AnnouncementRead();
        $announcement_read->user_id         = $to_user_id;
        $announcement_read->announcement_id = $announcement->id;
        $announcement_read->from_user_id    = $u_id;
        $announcement_read->read            = false;
        $announcement_read->save();               //  Inserts


        // return ['status' => 'Message Sent!'];
    }

}
