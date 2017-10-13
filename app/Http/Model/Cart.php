<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    //模型关联的表
    protected $table = 'dc_cart';
    //表的主键
    public $primaryKey = 'cart_id';
    //允许批量操作的字段
    protected $fillable = [ ];
    //不允许批量操作的字段 // []表示没有去限定
    protected $guarded = [];
    //是否维护时间字段  维护汇报Unknown column 'updated_at'
    public $timestamps = false;

     /*public function type()  // 原来shop模型
    {
      return $this->belongsTo('App\Http\Model\type', 'type_id', 'type_id');
    }*/
}
