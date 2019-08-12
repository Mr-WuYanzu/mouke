<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
/**
 * 课程评论模型类
 * class CurrCommentModel
 * @author   <[<gaojianbo>]>
 * @package  App\Model
 * @date 2019-08-10
 */
class CurrCommentModel extends Model
{
    //指定表名
    public $table='curr_comment';
    //指定主键
    public $primaryKey='curr_comment_id';
    //关闭时间戳自动写入
    public $timestamps=false;
}
