<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Manager extends Model
{
    //
    //模型关联的表 
    protected $table = 'dc_manager';
    //表的主键
    public $primaryKey = 'manager_id';
    //允许批量操作的字段
    protected $fillable = ['manager_name', 'manager_pwd','manager_tell','manager_status','manager_auth','manager_id','manager_email'];
    //不允许批量操作的字段 // []表示没有去限定
    protected $guarded = [];
    //是否维护时间字段  维护汇报Unknown column 'updated_at'
    public $timestamps = false;
}
