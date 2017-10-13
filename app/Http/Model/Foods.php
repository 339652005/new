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
    protected $fillable = [ 'foods_name', 'foods_piture','foods_sales','foods_status','foods_desc','foods_price','taocan_id'];
    //
    //不允许批量操作的字段 // []表示没有去限定
    protected $guarded = [];
    //是否维护时间字段  维护汇报Unknown column 'updated_at'
    public $timestamps = false;

    // return $this->hasMany('关联的模型', '外键', '主键');
       
    // 商品关联它 所属类型
    
    // 去商品控制器
   
}
