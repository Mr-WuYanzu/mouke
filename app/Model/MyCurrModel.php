<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
/**
 * 用户课程关联模型类
 * class MyCurrModel
 * @author   <[<gaojianbo>]>
 * @package  App\Model
 * @date 2019-08-17
 */
class MyCurrModel extends Model
{
    //指定表名
    public $table='my_curr';
    //指定主键
    public $primaryKey='id';
    //关闭时间戳自动写入
    public $timestamps=false;
}
