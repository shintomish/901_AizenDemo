<?php

namespace App\Http\Controllers;

// use DateTime;
// use App\Models\User;
// use App\Models\Customer;
use App\Models\Announcement;
use App\Models\AnnouncementRead;
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

        //  * Customer(個人のレコード)件数を取得する
        $customer_count = $this->auth_customer_individual_count();
        //  * Customer(個人のレコード)情報を取得する
        $customer_findrec = $this->auth_customer_individual();
        if($customer_count <> 0){
            $customer_id = 11;
            $to_user_id  = 11;
        } else {
            $customer_id = 0;
            $to_user_id  = 0;
        }

        // 選択されたcustomer_idをSetする
        $this->chattop_json_put_info_set($user_id, $to_user_id,$organization_id, $customer_id);

        $common_no = '00_7';
        $compacts = compact( 'messages', 'customer_count','customer_findrec', 'user_id', 'to_user_id','customer_id', 'common_no');

            
        $announcement_id = 0;
        $announcement = Announcement::where('from_user_id', $to_user_id)
            ->first();

        if(!is_null($announcement)) {
            $announcement_id = $announcement->id;
        }

        Log::debug('ChatController index  $announcement_id = ' . print_r($announcement_id,true));

        // $announcement_read = AnnouncementRead::where('from_user_id', $to_user_id)
        //     ->where('announcement_id', $announcement_id)
        //     ->first();
        $announcement_read = AnnouncementRead::where('from_user_id', $to_user_id)
            ->where('user_id', $user_id)
            ->where('read', false)
            ->get();

        //更新
        if(!is_null($announcement_read)) {
            $announcement_read_write = AnnouncementRead::where('from_user_id', $to_user_id)
                ->where('user_id', $user_id)
                ->where('read', false)
                ->update([
                    'read'  =>  $true,
                ]);
        }

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

        $to_user_id = $customer_id;

        // ログインユーザーのユーザー情報を取得する
        $user     = $this->auth_user_info();
        $user_id  = $user->id;
        $organization_id = 1;

        // 選択されたcustomer_idをSetする
        $this->chattop_json_put_info_set($user_id, $to_user_id, $organization_id, $customer_id);
        //  * Customer(個人のレコード)件数を取得する
        $customer_count = $this->auth_customer_individual_count();
        // Customer(ALLレコード)情報を取得する
        $customer_findrec = $this->auth_customer_individual();

        $messages = Message::select(
            'messages.id              as id'
            // ,'messages.organization_id as organization_id'
            ,'messages.user_id         as user_id'
            ,'messages.to_user_id      as to_user_id'
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

        $common_no = '00_7';
        $compacts = compact( 'messages', 'customer_count', 'customer_findrec', 'user_id', 'to_user_id', 'customer_id', 'common_no');

        $announcement_id = 0;
        $announcement = Announcement::where('from_user_id', $to_user_id)
            ->first();

        if(!is_null($announcement)) {
            $announcement_id = $announcement->id;
        }

        Log::debug('ChatController serch  $announcement_id = ' . print_r($announcement_id,true));

        // $announcement_read = AnnouncementRead::where('from_user_id', $to_user_id)
        //     ->where('announcement_id', $announcement_id)
        //     ->first();
        $announcement_read = AnnouncementRead::where('from_user_id', $to_user_id)
            ->where('user_id', $user_id)
            ->where('read', false)
            ->get();

        if(!is_null($announcement_read)) {
            $announcement_read->read = true;
            $announcement_read->update();
        }

        Log::info('ChatController serch END');
        return view( 'chat.index', $compacts );
    }
}
