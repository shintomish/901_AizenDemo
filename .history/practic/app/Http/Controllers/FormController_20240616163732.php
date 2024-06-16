<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\ContactFormRequest;
use App\Mail\ContactFormAdminMail;
use App\Mail\ContactFormUserMail;

class FormController extends Controller
{
    /**
     * 入力ページ
     */
    public function index()
    {
        Log::info('FormController index START');
        Log::info('FormController index END');
        return view('contact.index');
    }

    /**
     * 確認ページ
     */
    public function confirm()
    {
        Log::info('FormController confirm START');
        Log::info('FormController confirm END');
        return view('contact.confirm');
    }

    /**
     * 完了ページ
     */
    public function complete()
    {
        Log::info('FormController complete START');
        Log::info('FormController complete END');
        return view('contact.complete');
    }

    /**
     * メール送信
     */
    public function sendMail(ContactFormRequest $request)
    {
        // Log::info('FormController sendMail START');

        // //
        // $form_data = $request->validated();

        // // submitボタンの値により分岐させる
        // $submitBtnVal = $request->input('submitBtnVal');
        // switch ($submitBtnVal) {
        //     case 'confirm':
        //         Log::info('FormController sendMail confirm END');
        //         // 確認画面へ
        //         return to_route('contact.confirm')->withInput();
        //         break;
        //     case 'back':
        //         Log::info('FormController sendMail back END');
        //         // 入力画面へ戻る
        //         return to_route('contact')->withInput();
        //         break;
        //     case 'complete':
        //         // 送信先メールアドレス
        //         $email_admin = env('MAIL_FROM_ADDRESS');
        //         $email_user  = $form_data['email'];

        //         // 管理者宛メール
        //         Mail::to($email_admin)->send(new ContactFormAdminMail($form_data));
        //         // ユーザー宛メール
        //         Mail::to($email_user)->send(new ContactFormUserMail($form_data));

        //         Log::info('FormController sendMail complete END');

        //         return to_route('contact.complete');
        //         break;
        //     default:
        //         // エラー
        // }
    }

    /**
     * メール送信
     */
    public function send(ContactFormRequest $request)
    {
        Log::info('FormController send START');

        //
        $form_data = $request->validated();

        // submitボタンの値により分岐させる
        $submitBtnVal = $request->input('submitBtnVal');
        switch ($submitBtnVal) {
            case 'confirm':
                Log::info('FormController send confirm END');
                // 確認画面へ
                return to_route('contact.confirm')->withInput();
                break;
            case 'back':
                Log::info('FormController send back END');
                // 入力画面へ戻る
                return to_route('contact')->withInput();
                break;
            case 'complete':
                // 送信先メールアドレス
                $email_admin = env('MAIL_FROM_ADDRESS');
                $email_user  = $form_data['email'];
                $email_name  = $form_data['name'];

                Log::info('newsrepo sendmail $ret_val = ' . print_r($ret_val, true));
                Log::info('newsrepo sendmail $toadr   = ' . print_r($toadr, true));
                
                // 管理者宛メール
                // Mail::to($email_admin)->send(new ContactFormAdminMail($email_user,$email_name));
                // ユーザー宛メール
                Mail::to($email_user)->send(new ContactFormUserMail($form_data));

                Log::info('FormController send complete END');

                return to_route('contact.complete');
                break;
            default:
                // エラー
        }
    }

}
