<?php

namespace App\Http\Controllers\Ajax;

// use App\Models\User;
use App\Models\Message;
use App\Events\MessageCreated;

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

    public function index(Request $request) { // 新着順にメッセージ一覧を取得

        Log::info('Ajax ChatController index START');

        //-------------------------------------------------------------
        //- Request パラメータ
        //-------------------------------------------------------------
        $customer_id = $request->Input('customer_id');
        if($customer_id == '') {
            $customer_id = 11;
        }

        // ログインユーザーのユーザー情報を取得する
        $user  = $this->auth_user_info();
        $organization_id =  $user->organization_id;

        // $customer_id = 2;     //customer_id 顧客は2から
        $user_id     = 1;

        Log::debug('Ajax ChatClientController index  $customer_id = ' . print_r($customer_id,true));
        Log::info('Ajax ChatController index END');

        // return Message::orderBy('id', 'desc')->get();
        return Message::where('organization_id', $organization_id)
                ->where('user_id', $user_id)
                ->orWhere('customer_id', '=',$customer_id)
                ->with('user')
                ->orderBy('id', 'desc')
                ->get();

    }

    public function create(Request $request) { // メッセージを登録

        Log::info('Ajax ChatController create START');

        //-------------------------------------------------------------
        //- Request パラメータ
        //-------------------------------------------------------------
        $customer_id = $request->Input('customer_id');
        if($customer_id == '') {
            $customer_id = 11;
        }
        
        $user            = Auth::user();
        $user_id         = $user->id;
        $organization_id = $user->organization_id;

        // Customer(ALLレコード)情報を取得する
        $customer_findrec = $this->auth_customer_findrec();
        // $customer_id = $customer_findrec[0]['id'];

        Log::debug('Ajax ChatClientController create  $customer_id = ' . print_r($customer_id,true));
        //ユーザー
        // if($user->id >= 11){
        //     $user_id = 2;
        // //事務所・管理者
        // } else {
        //     $user_id = 1;
        // }
        
        $message = $user->messages()->create([
            'body'            => $request->input('message'),
            'user_id'         => $user_id,
            'customer_id'     => $customer_id,
            'organization_id' => $organization_id,
        ]);

        Log::info('Ajax ChatController create END');

        // broadcast(new MessageCreated($user, $message))->toOthers();
        broadcast(new MessageCreated($user, $customer_id, $organization_id, $message));

        // return ['status' => 'Message Sent!'];

    }
}
