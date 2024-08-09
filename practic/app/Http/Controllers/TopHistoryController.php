<?php

namespace App\Http\Controllers;

// use Validator;
use App\Models\User;
use App\Models\Customer;
use App\Models\Exercisedata;

use Illuminate\Http\Request;

// use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TopHistoryController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // ログインユーザーのユーザー情報を取得する
        $user  = $this->auth_user_info();
        $userid = $user->id;

        Log::info('office tophistory index START $user->name = ' . print_r($user->name ,true));

        $organization  = $this->auth_user_organization();
        $organization_id = $organization->id;

        $users = User::where('organization_id','>=',$organization_id)
                    ->where('id','>=',11)
                    ->whereNull('deleted_at')
                    ->get();

        $data['count'] = Exercisedata::whereNull('deleted_at')->count();
        Log::debug('office tophistory index $data[count]  = ' . print_r($data['count'] ,true));

        // データあり
        if( $data['count'] > 0 ) {
            $ret_val = Exercisedata::whereNull('deleted_at')
                        ->orderBy('created_at', 'desc')
                        ->first();
            $customer_id = $ret_val->customer_id;
        } else {
            $customer_id = 1;
        }

        Log::debug('office tophistory index customer_id  = ' . print_r($customer_id ,true));

        //  * Customer(個人のレコード)件数を取得する
        $customer_count = $this->auth_customer_individual_count();   

        //  * Customer(個人のレコード)情報を取得する
        $customer_findrec = $this->auth_customer_individual();

        $exercises = Exercisedata::where('organization_id','>=',$organization_id)
                    ->where('customer_id','=',$customer_id)
                    ->whereNull('deleted_at')
                    ->orderBy('created_at', 'desc')
                    ->sortable()
                    ->paginate(200);

        $common_no = '00_3';

        // * 今年の年を取得
        // $nowyear = $this->get_now_year();

        $compacts = compact( 'userid','users','exercises','customer_count','customer_findrec','customer_id','common_no' );

        Log::info('office tophistory index END $user->name = ' . print_r($user->name ,true));
        return view( 'tophistory.index', $compacts);
    }

    /**
     * [webapi]Customerテーブルの更新
     */
    public function update_api(Request $request)
    {
        Log::info('office tophistory update_api top START');


        Log::info('office tophistory update_api top END');

    }

    public function post(Request $data)
    {
        // Log::info('top post START');
        // Log::info('top post END');
        // // ホーム画面へリダイレクト
        // return redirect('/user');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        Log::info('tophistory show START');
        Log::info('tophistory show END');
    }

    public function serch(Request $request)
    {
        Log::info('office tophistory serch START');

        //-------------------------------------------------------------
        //- Request パラメータ
        //-------------------------------------------------------------
        $customer_id = $request->Input('customer_id');

        // ログインユーザーのユーザー情報を取得する
        $user  = $this->auth_user_info();
        $u_id = $user->id;
        $organization_id =  $user->organization_id;

        // Customer(ALLレコード)情報を取得する
        // $customer_findrec = $this->auth_customer_allrec();
        //  * Customer(個人のレコード)情報を取得する
        $customer_findrec = $this->auth_customer_individual();

        $exercises = Exercisedata::where('organization_id','>=',$organization_id)
                    ->where('customer_id','=',$customer_id)
                    ->whereNull('deleted_at')
                    ->sortable()
                    ->paginate(200);

        $jsonfile = storage_path() . "/tmp/customer_info_status_". $customer_id. ".json";

        $compacts = compact( 'exercises','customer_findrec','customer_id','jsonfile' );

        Log::info('office tophistory serch END');

        return view( 'tophistory.index', $compacts );
    }
}
