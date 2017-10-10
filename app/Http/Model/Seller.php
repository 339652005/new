<?php
 
namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Seller extends Model
{
    // 模型关联的表
    protected $table = 'dc_seller';
    //表的主键
    public $primaryKey = 'seller_id';
    //允许批量操作的字段
    protected $fillable = ['seller_name', 'seller_pwd','seller_tell','seller_status','seller_auth'];
    //不允许批量操作的字段 // []表示没有去限定
    protected $guarded = [];
    //是否维护时间字段  维护汇报Unknown column 'updated_at'
    public $timestamps = false;
}
