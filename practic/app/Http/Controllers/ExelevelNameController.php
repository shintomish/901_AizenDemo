<?php

namespace App\Http\Controllers;

use Validator;
// use DateTime;
use App\Models\Exelevelname;
// use App\Models\Organization;
// use App\Models\Customer;
// use App\Models\Parameter;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
// use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
// use Illuminate\Support\Facades\Hash;

class ExelevelNameController extends Controller
{
    //timestamps利用しない
    public $timestamps = false;

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
    public function index(Request $request)
    {
        Log::info('exelevelname index START');

        // $organization  = $this->auth_user_organization();
        // $organization_id = $organization->id;

        // customersを取得
        $exelevelnames = DB::table('exelevelnames')
                ->whereNull('deleted_at')
                ->paginate(10);

        $common_no ='90_1';

        $compacts = compact( 'common_no','exelevelnames');

        Log::info('exelevelname index END');
        return view( 'exelevelname.index', $compacts );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Log::info('exelevelname create START');

        Log::info('exelevelname create END');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Log::info('exelevelname store START');

        Log::info('exelevelname store END');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        Log::info('exelevelname show START');
        Log::info('exelevelname show END');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        Log::info('exelevelname edit START');


        Log::info('exelevelname edit END');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Log::info('exelevelname destroy START');

        Log::info('destroy END');
    }

    /**
     *
     */
    public function get_validator(Request $request,$id)
    {
        $rules   = ['organization_id' => 'required',
                    'name'            => [
                                            'required',
                                            Rule::unique('exelevelnames','name')->ignore($id)->whereNull('deleted_at'),
                                        ],
                    'exelevelname_id'         =>    'required',
                    'login_flg'       => [
                                            'min:1',        //指定された値以上か
                                            // 'regex:/^[顧客|社員|所属]+$/u',
                                            'integer',
                                            'required',
                                        ],
                    'admin_flg'       => [
                                            'min:1',        //指定された値以上か
                                            // 'regex:/^[顧客|社員|所属]+$/u',
                                            'integer',
                                            'required',
                                        ],
                    'email'           => [
                                            'required',
                                            Rule::unique('exelevelnames','email')->ignore($id)->whereNull('deleted_at'),
                                        ],
                    'password'        =>    'confirmed',
                ];

        $messages = [
                    'organization_id.required' => '組織名は入力必須項目です。',
                    'name.required'            => 'ユーザー名は入力必須項目です。',
                    'name.unique'              => 'そのユーザー名は既に登録されています。',
                    'exelevelname_id.required'         => '顧客名は入力必須項目です。',
                    'login_flg.min'            => '利用区分は顧客|社員|所属から選択してください。',
                    'login_flg.required'       => '利用区分は入力必須項目です。',
                    'admin_flg.min'            => '管理区分は一般|管理者から選択してください。',
                    'admin_flg.required'       => '管理区分は入力必須項目です。',
                    'email.required'           => 'Eメールは入力必須項目です。',
                    'email.unique'             => 'そのEメールは既に登録されています。',
                    'password.confirmed'       => '確認用のパスワードと一致しません。',
                    ];

        $validator = Validator::make($request->all(), $rules, $messages);

        return $validator;
    }
    public function jsonResponse($data, $code = 200)
    {
        return response()->json(
            $data,
            $code,
            ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
            JSON_UNESCAPED_UNICODE
        );
    }
}
