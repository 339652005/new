<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    //模型关联的表
    protected $table = 'dc_permission';
    //表的主键
    public $primaryKey = 'permission_id';
    //不允许批量操作的字段
    protected $guarded = [];
    //是否维护时间字段
    public $timestamps = false;
}
