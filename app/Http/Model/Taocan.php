<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Taocan extends Model
{
    //模型关联的表
    protected $table = 'dc_taocan';
    //表的主键
    public $primaryKey = 'taocan_id';
    //允许批量操作的字段
    protected $fillable = ['taocan_name','taocan_price'];
    //不允许批量操作的字段 // []表示没有去限定
    protected $guarded = [];
    //是否维护时间字段  维护汇报Unknown column 'updated_at'
    public $timestamps = false;
}
