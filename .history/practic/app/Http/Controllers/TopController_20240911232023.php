<?php

namespace App\Http\Controllers;

// use Validator;
use App\Models\User;
use App\Models\Customer;
use App\Models\Exercisedata;
use App\Models\Exelevelname;

use Illuminate\Http\Request;

// use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use League\CommonMark\Extension\CommonMark\Renderer\Block\ThematicBreakRenderer;

class TopController extends Controller
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

        Log::info('office top index START $user->name = ' . print_r($user->name ,true));

        $organization  = $this->auth_user_organization();
        $organization_id = $organization->id;

        $users = User::where('organization_id','>=',$organization_id)
                    ->where('id','>=',11)
                    ->whereNull('deleted_at')
                    ->get();

        //  * Customer(個人のレコード)件数を取得する
        $customer_count = $this->auth_customer_individual_count();
        //  * Customer(個人のレコード)情報を取得する
        $customer_findrec = $this->auth_customer_individual();
        if($customer_count <> 0){
            $customer_id = $customer_findrec[0]['id'];
        } else {
            $customer_id = 0;
        }
        Log::debug('office top index customer_count  = ' . print_r($customer_count ,true));


        Log::debug('office top index customer_id  = ' . print_r($customer_id ,true));

        $exercises = Exercisedata::where('organization_id','>=',$organization_id)
                    ->whereNull('deleted_at')
                    ->sortable()
                    ->paginate(200);

        $common_no = '00_3';

        // * 今年の年を取得
        // $nowyear = $this->get_now_year();
        $jsonfile = storage_path() . "/tmp/customer_info_status_". $customer_id. ".json";

        $customer_count = $this->auth_customer_individual_count();
        $compacts = compact( 'userid','users','customer_count','customer_findrec','customer_id','exercises','common_no','jsonfile' );

        Log::info('office top index END $user->name = ' . print_r($user->name ,true));
        return view( 'top.index', $compacts);
    }

    /**
     * [webapi]Customerテーブルの更新
     */
    public function update_api(Request $request)
    {
        Log::info('office top update_api top START');


        Log::info('office top update_api top END');

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
        Log::info('top show START');
        Log::info('top show END');
    }

    public function serch(Request $request)
    {
        Log::info('top serch START');

        //-------------------------------------------------------------
        //- Request パラメータ
        //-------------------------------------------------------------
        $customer_id = $request->Input('customer_id');

        // ログインユーザーのユーザー情報を取得する
        $user  = $this->auth_user_info();
        $u_id = $user->id;
        $organization_id =  $user->organization_id;

        //  * Customer(個人のレコード)件数を取得する
        $customer_count = $this->auth_customer_individual_count();
        //  * Customer(個人のレコード)情報を取得する
        $customer_findrec = $this->auth_customer_individual();

        $customers = Customer::where('id',$customer_id)
                    ->orderBy('id', 'asc')
                    ->first();

        $jsonfile = storage_path() . "/tmp/customer_info_status_". $customer_id. ".json";

        $compacts = compact( 'customer_findrec','customer_count','customer_id','jsonfile' );

        Log::info('top serch END');
        return view( 'top.index', $compacts );
    }

}
