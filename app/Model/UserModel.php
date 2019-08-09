<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
    //
    protected $table='user';
    protected $primarykey='user_id';
    public $timestamps=false;
}
