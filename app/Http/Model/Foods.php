<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Foods extends Model
{
    //模型关联的表
    protected $table = 'dc_foods';
    //表的主键
    public $primaryKey = 'foods_id';
    //允许批量操作的字段
    protected $fillable = ['foods_name', 'foods_piture','foods_sales','foods_status','foods_desc','foods_price'];
    //不允许批量操作的字段 // []表示没有去限定
    protected $guarded = [];
    //是否维护时间字段  维护汇报Unknown column 'updated_at'
    public $timestamps = false;
}
