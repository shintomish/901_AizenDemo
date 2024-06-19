<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Kyslik\ColumnSortable\Sortable;

class Exercisedata extends Model
{
    use HasFactory;
    use Sortable;

    // 参照させたいSQLのテーブル名を指定
    protected $table = 'exercisedatas';

    //追記(ソートに使うカラムを指定
    public $sortable = ['id','filepath','filename','filesize','urgent_flg','created_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'filepath',
        'filename',
        'filesize',
        'organization_id',
        'urgent_flg',
        'user_id',
        'customer_id',
        'created_at',
    ];

    protected $dates = [
        'created_at',
    ];

}
