<?php
 
namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;


class Role extends Model
{
    //模型关联的表
    protected $table = 'dc_role';
    //表的主键
    public $primaryKey = 'role_id';
    //不允许批量操作的字段
    protected $guarded = [];
    //是否维护时间字段
    public $timestamps = false;

    public function users()
    {
        return $this->belongsToMany('App\User', 'user_role', 'role_id', 'user_id');
    }

    public function permissions()
    {
//        return $this->belongsToMany('App\Role', 'user_roles', 'user_id', 'role_id');
        return $this->belongsToMany('App\Http\Model\Permission','permission_role','role_id','permission_id');

    }
}
