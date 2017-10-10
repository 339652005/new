<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    //模型关联的表
    protected $table = 'dc_shop';
    //表的主键
    public $primaryKey = 'shop_id';
    //允许批量操作的字段
    protected $fillable = ['shop_name', 'shop_addr','shop_x','shop_status','shop_y','shop_desc','shop_logo','shop_zhizhao','shop_licence'];
    //不允许批量操作的字段 // []表示没有去限定
    protected $guarded = [];
    //是否维护时间字段  维护汇报Unknown column 'updated_at'
    public $timestamps = false;
}
