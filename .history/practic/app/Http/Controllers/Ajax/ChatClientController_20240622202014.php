<?php

namespace App\Http\Controllers\Ajax;

// use App\Models\User;
use App\Models\Customer;
use App\Models\Message;
use App\Events\MessageCreated;

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
        $user            = Auth::user();
        $user_id         = $user->user_id;
        // $organization_id = $user->organization_id;
        $organization_id = 1;

        Log::debug('Ajax ChatClientController index  $customer_id = ' . print_r($user_id,true));

        Log::info('Ajax ChatClientController index END');

        return Message::where('organization_id', $organization_id)
                    // ->Where('customer_id', $customer_id)
                    // ->orWhere('customer_id', 1)

                ->with('user')
                ->orderBy('id', 'desc')
                ->get();

    }

    public function create(Request $request) { // メッセージを登録

        Log::info('Ajax ChatClientController create START');

        // ログインユーザーのユーザー情報を取得する
        $user            = Auth::user();
        $user_id         = $user->user_id;
        // $organization_id = $user->organization_id;
        $organization_id = 1;

        // Customer(複数レコード)情報を取得する
        $customer_findrec = $this->auth_customer_findrec();
        $customer_id = $customer_findrec[0]['id'];

        $message = $user->messages()->create([
            'body'            => $request->input('message'),
            'to_flg'          => 2,
            'user_id'         => $user_id,
            'customer_id'     => $user_id,
            'organization_id' => $organization_id,
        ]);

        Log::info('Ajax ChatClientController create END');

        broadcast(new MessageCreated($user, $user_id, $organization_id,$message));
    }
}
