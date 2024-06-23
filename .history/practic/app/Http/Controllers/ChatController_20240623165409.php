<?php

namespace App\Http\Controllers;

// use DateTime;
use App\Models\User;
use App\Models\Customer;
use App\Models\Message;
// use Illuminate\Http\Request;
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

        $messages = Message::select(
                'messages.id              as id'
                // ,'messages.organization_id as organization_id'
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
            ->get();

        // Customer(ALLレコード)情報を取得する
        $customer_findrec = $this->auth_customer_allrec();

        $common_no = '00_7';
        $
        $compacts = compact( 'messages', 'customer_findrec','customer_id','common_no' );

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

        // ログインユーザーのユーザー情報を取得する
        $user  = $this->auth_user_info();
        $u_id  = $user->id;
        $organization_id = 1;

        // Customer(ALLレコード)情報を取得する
        $customer_findrec = $this->auth_customer_allrec();

        $messages = Message::select(
            'messages.id              as id'
            // ,'messages.organization_id as organization_id'
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
        ->get();

        // $jsonfile = storage_path() . "/tmp/customer_info_status_". $customer_id. ".json";

        $common_no = '00_7';
        $compacts = compact( 'messages', 'customer_findrec','customer_id','common_no' );

        Log::info('ChatController serch END');
        return view( 'chat.index', $compacts );
    }

}
