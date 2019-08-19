<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
/**
 * 讲师模型类
 * class TeacherModel
 * @author   <[<gaojianbo>]>
 * @package  App\Model
 * @date 2019-08-10
 */
class QuesModel extends Model
{
    //指定表名
    public $table='ques';
    //指定主键
    public $primaryKey='ques_id';
    //关闭时间戳自动写入
    public $timestamps=false;
}
