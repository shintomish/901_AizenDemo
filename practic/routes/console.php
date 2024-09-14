<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

// use App\Console\Commands\FileTmpDelete;
// use App\Console\Commands\File90Delete;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

        // Schedule::command('command:FileTmpDelete')     // uploadfileのtmpを削除
        //             ->dailyAt('03:55');                 // 毎日AM3:55に実行する

        Schedule::command('cache:clear')
                    ->dailyAt('04:00');                 // 毎日AM4:05に実行する
        Schedule::command('route:clear')
                    ->dailyAt('04:00');                 // 毎日AM4:10に実行する
        Schedule::command('config:clear')
                    ->dailyAt('04:00');                 // 毎日AM4:15に実行する
        Schedule::command('view:clear')
                    ->dailyAt('04:00');                 // 毎日AM4:20に実行する

        Schedule::command('backup:clean')              // 古いバックアップファイルを削除
                 ->dailyAt('04:55');                    // 毎日AM4:55に実行する
        Schedule::command('backup:run --only-db')      // DBのみのバックアップにはオプション「–only-db」を指定します。
                 ->dailyAt('05:00');                    // 毎日AM5:00に実行する

        // Schedule::command('command:File90Delete')         // userdata配下の90日経過したファイルを削除
        //          ->weeklyOn(0, '05:10');                // 毎週日曜日(0)AM5:10に実行する

        Schedule::command('backup:run')
                 ->weeklyOn(0, '06:10');                // 毎週日曜日(0)AM6:00に実行する

        // Schedule::command('cache:clear')
        //         ->dailyAt('23:00')                      // 毎日AM23:00に実行する
        //         ->onSuccess(function () {
        //             Log::info('schedule cache:clear 成功');
        // });

