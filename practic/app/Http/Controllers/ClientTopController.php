<?php

namespace App\Http\Controllers;

// use DateTime;
use App\Models\Exercisedata;
// use App\Models\Customer;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ClientTopController extends Controller
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
        $u_id  = $user->user_id;
        $organization_id =  $user->organization_id;

        Log::info('topclient index START $user->name = ' . print_r($user->name ,true));

        $exercises = Exercisedata::where('organization_id','>=',$organization_id)
                    ->where('customer_id','=',$u_id)
                    ->whereNull('deleted_at')
                    ->orderBy('created_at', 'desc')
                    ->sortable()
                    ->paginate(200);

        $compacts = compact( 'u_id','exercises' );

        Log::info('topclient index END $user->name = ' . print_r($user->name ,true));
        // Log::info('topclient index END');
        return view( 'clienttop.index', $compacts );

    }
    /**
     * [webapi]billdataテーブルの更新
     */
    public function update_api(Request $request)
    {
        Log::info('update_api clienttop START');

        // Log::debug('update_api request = ' .print_r($request->all(),true));
        $id = $request->input('id');

        $urgent_flg     = 2;  // 1:未読 2:既読

        $counts = array();
        $update = [];
        $update['urgent_flg'] = $urgent_flg;
        $update['updated_at'] = date('Y-m-d H:i:s');
        // Log::debug('update_api clienttop update : ' . print_r($update,true));

        $status = array();
        DB::beginTransaction();
        Log::info('update_api clienttop beginTransaction - start');
        try{
            // 更新処理
            Exercisedata::where( 'id', $id )->update($update);

            $status = array( 'error_code' => 0, 'message'  => 'Your data has been changed!' );
            $counts = 1;
            DB::commit();
            Log::info('update_api clienttop beginTransaction - end');
        }
        catch(Exception $e){
            Log::error('update_api clienttop exception : ' . $e->getMessage());
            DB::rollback();
            Log::info('update_api clienttop beginTransaction - end(rollback)');
            echo "エラー：" . $e->getMessage();
            $counts = 0;
            $status = array( 'error_code' => 501, 'message'  => $e->getMessage() );
        }

        Log::info('update_api clienttop END');
        return response()->json([ compact('status','counts') ]);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function serch(Request $request)
    {
        Log::info('topclient serch START');


        Log::info('topclient serch END');

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
    public function show()
    {
        Log::info('topclient show START');

        $disk = 'local';  // or 's3'
        $storage = Storage::disk($disk);
        $file_name = 'user_manual.pdf';
        $pdf_path = 'public/pdf/' . $file_name;
        $file = $storage->get($pdf_path);

        Log::info('topclient show END');

        return response($file, 200)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'inline; filename="' . $file_name . '"');

    }

    public function show_alert($alert_id)
    {
        Log::info('topclient show_alert START');


        Log::info('topclient show_alert END');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show_up($id)
    {
        Log::info('topclient show_up START');

        $exercisedatas = Exercisedata::where('id',$id)
                        ->first();

        $disk = 'local';  // or 's3'
        $storage = Storage::disk($disk);
        // // /var/www/html/storage/app/public/invoice/xls/folder0001/20231011_合同会社グローアップ_00001_請求書.pdf
        // $str  = $billdatas->filepath;
        // $str2 = substr_replace($str, "", 26);       // /var/www/html/storage/app/
        // $filepath = str_replace($str2, '', $str);   // public/invoice/xls/folder0001/20231011_合同会社グローアップ_00001_請求書.pdf
        $filepath = $exercisedatas->filepath;   // public/billdata/user0171/2023年7月末-20230821T050250Z-001.pdf
        $filename = $exercisedatas->filename;   // 2023年7月末-20230821T050250Z-001.pdf
        $pdf_path = $filepath;

        // $pdf_path = "app/userdata/folder0013/gitイントロ.pdf";
        Log::debug('topclient show_up  filename = ' . print_r($filename,true));
        Log::debug('topclient show_up  pdf_path = ' . print_r($pdf_path,true));

        $file = $storage->get($pdf_path);

        if($exercisedatas->extension == 'pdf') {
            
            Log::info('topclient show_up pdf END');

            return response($file, 200)
                ->header('Content-Type', 'application/pdf')
                ->header('Content-Disposition', 'inline; filename="' . $filename . '"');
        } else {
            $mimeType = Storage::mimeType($pdf_path);
            $headers = [
                ['Content-Type' => $mimeType,
                'Content-Disposition' => 'attachment; filename*=UTF-8\'\''.rawurlencode($filename)]
            ];
                    
            Log::info('topclient show_up not pdf END');
            
            return Storage::download($pdf_path, $filename, $headers);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show_up02()
    {
        Log::info('topclient show_up02 電子帳簿保存法 START');

        $disk = 'local';  // or 's3'
        $storage = Storage::disk($disk);
        $file_name = '改正電子帳簿保存法の開始にあたってやるべきこと.pdf';
        $pdf_path = 'public/pdf/' . $file_name;
        $file = $storage->get($pdf_path);

        Log::info('topclient show_up02 電子帳簿保存法 END');

        return response($file, 200)
            ->header('Content-Type', 'application/pdf')
            // ->header('Content-Type', 'application/zip')
            ->header('Content-Disposition', 'inline; filename="' . $file_name . '"');

    }
    // 2023/08/30
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show_up03()
    {
        Log::info('topclient show_up03 法人設立 START');

        $disk = 'local';  // or 's3'
        $storage = Storage::disk($disk);
        $file_name = '法人設立・法人成したタイミングで知っておくべき知識.pdf';
        $pdf_path = 'public/pdf/' . $file_name;
        $file = $storage->get($pdf_path);

        Log::info('topclient show_up03 法人設立 END');

        return response($file, 200)
            ->header('Content-Type', 'application/pdf')
            // ->header('Content-Type', 'application/zip')
            ->header('Content-Disposition', 'inline; filename="' . $file_name . '"');

    }


}
