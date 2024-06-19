<?php

namespace App\Http\Controllers;

// use Validator;
use App\Models\User;
// use App\Models\Customer;
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

        $exercises = Exercisedata::where('organization_id','>=',$organization_id)
                    ->whereNull('deleted_at')
                    ->sortable()
                    ->paginate(200);

        $common_no = '00_3';

        // * 今年の年を取得
        $nowyear = $this->get_now_year();

        $compacts = compact( 'userid','users','exercises','common_no' );

        Log::info('office tophistory index END $user->name = ' . print_r($user->name ,true));
        return view( 'tophistory.index', $compacts);
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

}
