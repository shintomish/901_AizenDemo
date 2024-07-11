<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Kyslik\ColumnSortable\Sortable;

class Exelevelname extends Model
{
    use HasFactory;
    use Sortable;

    // 参照させたいSQLのテーブル名を指定
    protected $table = 'exelevelnames';

    //追記(ソートに使うカラムを指定
    public $sortable = ['id','name'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'created_at',
    ];

    protected $dates = [
        'created_at',
    ];

}
