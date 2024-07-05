<?php

namespace App\Http\Controllers;

// use DateTime;
use App\Models\User;
// use App\Models\Customer;
use App\Models\Message;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ChatClientController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request) {

        Log::info('ChatClientController index START');

        // ログインユーザーのユーザー情報を取得する
        $user  = $this->auth_user_info();
        $u_id  = $user->id;
        $customer_id     = $user->id;
        $organization_id = 1;

        $messages = Message::select(
                'messages.id              as id'
                // ,'messages.organization_id as organization_id'
                ,'messages.user_id         as user_id'
                ,'messages.to_user_id      as to_user_id'
                ,'messages.customer_id     as customer_id'
                ,'messages.body            as m_body'
                ,'messages.created_at      as m_created_at'
                ,'users.id                 as users_id'
                ,'users.user_id            as users_custom_id'
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
            ->orderBy('messages.id', 'desc')
            ->orderBy('messages.customer_id', 'asc')
            ->get();

        // User情報(事務所社員)を取得する
        $users = User::where('login_flg', 2)
                ->whereNull('deleted_at')
                ->where('id','=', 2)
                ->get();

        $user_id = 1;
        $to_user_id = $user_id;

        Log::debug('ChatClientController index  $user_id = ' . print_r($user_id,true));

        // chatcliで選択されたuser_idをSetする
        $this->chatcli_json_put_info_set($u_id, $to_user_id, $organization_id, $user_id);

        $common_no = '00_7';
        $compacts = compact( 'messages','common_no','users','to_user_id','customer_id','user_id' );

        Log::info('ChatClientController index END');

        return view('chatclient.index', $compacts );

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function serch(Request $request)
    {
        Log::info('ChatClientController serch START');

        //-------------------------------------------------------------
        //- Request パラメータ
        //-------------------------------------------------------------
        $user_id = $request->Input('user_id');
        $to_user_id = $user_id;
        // ログインユーザーのユーザー情報を取得する
        $user  = $this->auth_user_info();
        $u_id  = $user->id;
        $customer_id = $user->id;
        $organization_id =  1;

        /**
         * chatcliで選択されたuser_idをSetする
         */
        $this->chatcli_json_put_info_set($u_id, $to_user_id,$organization_id, $user_id);

        $messages = Message::select(
            'messages.id              as id'
            // ,'messages.organization_id as organization_id'
            ,'messages.user_id         as user_id'
            ,'messages.to_user_id      as to_user_id'
            ,'messages.customer_id     as customer_id'
            ,'messages.body            as m_body'
            ,'messages.created_at      as m_created_at'
            ,'users.id                 as users_id'
            ,'users.user_id            as users_custom_id'
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
        ->where('customers.id','=','customer_id')
        ->whereNull('customers.deleted_at')
        ->orderBy('messages.id', 'desc')
        ->orderBy('messages.customer_id', 'asc')
        ->get();

        // User情報(事務所社員)を取得する
        $users = User::where('login_flg', 2)
                ->whereNull('deleted_at')
                ->get();

        $customer_id = $u_id;

        Log::debug('ChatClientController serch 選択した $user_id = ' . print_r($user_id,true));

        $common_no = '00_7';
        $compacts = compact( 'messages','common_no','users','to_user_id','customer_id','user_id' );

        Log::info('ChatClientController serch END');

        return view('chatclient.index', $compacts );

    }

}
