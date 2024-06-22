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

        // ログインユーザーのユーザー情報を取得する
        $user            = $this->auth_user_info();
        // $organization_id = $user->organization_id;
        $organization_id = 1;
        $user_id         = $user->id;


        $customer_id = $request->input('customer_id');
        Log::debug('Ajax ChatController create  $customer_id = ' . print_r($customer_id,true));
        // * ログインユーザーのCustomerオブジェクトをjsonから取得する
        // $compacts = $this->json_get_info($user_id);
        // $customer_id     = $compacts['customer_id'];

        Log::info('Ajax ChatController index END');

        // return Message::orderBy('id', 'desc')->get();
        return Message::where('organization_id', $organization_id)
                ->with('user')
                ->orderBy('id', 'desc')
                ->get();

    }

    public function create(Request $request) { // メッセージを登録

        Log::info('Ajax ChatController create START');

        $user            = Auth::user();
        $user_id         = $user->id;
        $organization_id = 1;

        // * ログインユーザーのCustomerオブジェクトをjsonから取得する
        // $compacts = $this->json_get_info($user_id);
        // $customer_id     = $compacts['customer_id'];

        $customer_id = $request->input('customer_id');
        Log::debug('Ajax ChatController create  $customer_id = ' . print_r($customer_id,true));

        $message = $user->messages()->create([
            'body'            => $request->input('message'),
            'to_flg'          => 1,
            'user_id'         => 1,
            'customer_id'     => $customer_id,
            'organization_id' => $organization_id,
        ]);

        Log::info('Ajax ChatController create END');

        broadcast(new MessageCreated($user, $customer_id, $organization_id, $message));

    }

    public function serch(Request $request)
    {
        Log::info('Ajax ChatController serch START');

        //-------------------------------------------------------------
        //- Request パラメータ
        //-------------------------------------------------------------
        $customer_id = $request->Input('customer_id');
        Log::debug('Ajax ChatController serch  $customer_id = ' . print_r($customer_id,true));

        // ログインユーザーのユーザー情報を取得する
        $user            = $this->auth_user_info();
        $organization_id = $user->organization_id;
        $user_id         = $user->id;

        // Customer(ALLレコード)情報を取得する Select用
        $customer_findrec = $this->auth_customer_allrec();

        $messages = Message::where('customer_id', $customer_id)
                        ->orWhere('user_id',      $user_id)
                        ->orderBy('id', 'asc')
                        ->first();

        $common_no = '00_7';
        $compacts = compact( 'messages','customer_findrec','customer_id','common_no' );

        // * ログインユーザーのCustomerオブジェクトをjsonにSetする
        $this->json_put_info_set($user_id, $organization_id, $customer_id);

        Log::info('Ajax ChatController serch END');
        return view( 'chat.index', $compacts );
    }

    /**
     * ログインユーザーのUserオブジェクトを取得する
     */
    public function json_get_info($user_id)
    {
        Log::info('Ajax ChatController json_get_info  START');

        $jsonfile = storage_path() . "/tmp/chattop_info_". $user_id. ".json";

        //JSONファイルの場所とファイル名を記述
        $jsonUrl = $jsonfile;
        if (file_exists($jsonUrl)) {
            $json = file_get_contents($jsonUrl);
            $json = mb_convert_encoding($json, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');

            $obj = [];

            $obj = json_decode($json, true);

            if(empty($obj)){
                // $obj[0] = $this->postUpload_info($user_id);
                Log::info('Ajax ChatController json_get_info empty');
            } else {
                $obj = $obj["res"]["info"];
                Log::info('Ajax ChatController json_get_info not empty');
            }

            foreach($obj as $key => $val) {
                $user_id       = $val["user_id"];
                $o_id          = $val["o_id"];
                $customer_id   = $val["customer_id"];
            }
            // Log::info('Ajax ChatController json_get_info  OK');
        } else {
            // * ログインユーザーのCustomerオブジェクトをjsonにSetする
            $this->json_put_info_set($user_id, 1, 11);
            // echo "データがありません";
            Log::info('Ajax ChatController json_get_info  Nothing');
        }
        $compacts = compact('user_id','o_id','customer_id' );

        Log::info('Ajax ChatController json_get_info  END');
        return  $compacts;
    }

    /**
     * ログインユーザーのUserオブジェクトをSetする
     */
    public function json_put_status($status, $user_id)
    {
        Log::info('Ajax ChatController json_put_status  START');

        $jsonfile = "";
        $arr = array(
            "res" => array(
                "info" => array(
                    [
                        "status"     => $status
                    ]
                )
            )
        );

        $arr_status = json_encode($arr);
        $jsonfile = storage_path() . "/tmp/chattop_info_". $user_id. ".json";

        file_put_contents($jsonfile , $arr_status);
        Log::info('Ajax ChatController json_put_status  END');
    }

    /**
     * ログインユーザーのUserオブジェクトをSetする
     */
    public function json_put_info_set($user_id, $o_id,$customer_id)
    {
        Log::info('Ajax ChatController json_put_info_set  START');

        $arr = array(
            "res" => array(
                "info" => array(
                    [
                        "user_id"        => $user_id,
                        "o_id"           => $o_id,
                        "customer_id"    => $customer_id,
                    ]
                )
            )
        );

        $arr = json_encode($arr);
        $jsonfile = storage_path() . "/tmp/chattop_info_". $user_id. ".json";

        file_put_contents($jsonfile , $arr);
        Log::info('Ajax ChatController json_put_info_set  END');
    }



}
