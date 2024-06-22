<?php

namespace App\Http\Controllers;

// use DateTime;
use App\Models\User;
use App\Models\Customer;
use App\Models\Message;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ChatController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {

        Log::info('ChatController index START');

        // ログインユーザーのユーザー情報を取得する
        $user     = $this->auth_user_info();
        $user_id  = $user->id;
        $organization_id =  1;

        // Customer(ALLレコード)情報を取得する
        $customer_findrec = $this->auth_customer_allrec();
        // $customer_id = $customer_findrec[0]['id'];

        // * ログインユーザーのCustomerオブジェクトをjsonから取得する
        $compacts = $this->json_get_info($user_id);
        $customer_id     = $compacts['customer_id'];
        $user_id         = $compacts['user_id'];

        Log::debug('ChatController index customer_id  = ' . print_r($customer_id ,true));

        $messages = Message::select(
                'messages.id              as id'
                // ,'messages.organization_id as organization_id'
                ,'messages.to_flg          as to_flg'
                ,'messages.user_id         as user_id'
                ,'messages.customer_id     as customer_id'
                ,'messages.body            as m_body'
                ,'messages.created_at      as m_created_at'
                ,'users.id                 as users_id'
                ,'users.name               as users_name'
                ,'customers.id             as customers_id'
                ,'customers.business_name  as business_name'
            )
            ->leftJoin('users', function ($join) {
                $join->on('messages.user_id', '=', 'users.id');
            })
            ->leftJoin('customers', function ($join) {
                $join->on('messages.customer_id', '=', 'customers.id');
            })
            ->whereNull('customers.deleted_at')
            ->whereNull('users.deleted_at')
            ->orderBy('messages.id', 'desc')
            ->orderBy('messages.customer_id', 'asc')
            ->paginate(300);

            $organization_id = 1;
            $users = User::where('organization_id','=',$organization_id)
                            // ->where('login_flg','=', 1 )  //顧客
                            ->whereNull('deleted_at')
                            ->get();
            $customers = Customer::where('organization_id','=',$organization_id)
                            ->whereNull('deleted_at')
                            ->get();

        $common_no = '00_7';
        $compacts = compact( 'messages','common_no','users','customers','customer_findrec','customer_id','user_id' );

        Log::info('ChatController index END');

        return view('chat.index', $compacts );
    }

    public function serch(Request $request)
    {
        Log::info('ChatController serch START');

        //-------------------------------------------------------------
        //- Request パラメータ
        //-------------------------------------------------------------
        $customer_id = $request->Input('customer_id');
        Log::debug('ChatController serch  $customer_id = ' . print_r($customer_id,true));

        // ログインユーザーのユーザー情報を取得する
        $user  = $this->auth_user_info();
        $u_id = $user->id;
        $organization_id =  $user->organization_id;

        // Customer(ALLレコード)情報を取得する
        $customer_findrec = $this->auth_customer_allrec();

        $messages = Message::where('customer_id',$customer_id)
                        ->orderBy('id', 'asc')
                        ->first();
        // * ログインユーザーのCustomerオブジェクトをjsonにSetする
        $this->json_put_info_set($user_id, 1, 11);

        $common_no = '00_7';
        $compacts = compact( 'messages','customer_findrec','customer_id','common_no' );

        Log::info('ChatController serch END');
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
