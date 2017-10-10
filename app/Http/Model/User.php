<?php

namespace App\Http\Model;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    // protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    // protected $fillable = ['name', 'email', 'password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    // protected $hidden = ['password', 'remember_token'];

     //模型关联的表
    protected $table = 'dc_user';
    //表的主键
    public $primaryKey = 'user_id';
    //允许批量操作的字段
    protected $fillable = ['user_name', 'user_pwd','user_tell','users_statu','user_auth'];
    //不允许批量操作的字段 // []表示没有去限定
    protected $guarded = [];
    //是否维护时间字段  维护汇报Unknown column 'updated_at'
    public $timestamps = false;
}
