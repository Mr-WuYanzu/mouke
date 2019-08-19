<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
/**
 * 订阅课程模型类
 * class SubscribeCurrModel
 * @author   <[<gaojianbo>]>
 * @package  App\Model
 * @date 2019-08-17
 */
class SubscribeCurrModel extends Model
{
    //指定表名
    public $table='subscribe_curr';
    //指定主键
    public $primaryKey='sub_id';
    //关闭时间戳自动写入
    public $timestamps=false;
}
