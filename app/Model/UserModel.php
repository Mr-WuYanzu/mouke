<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
    //
    public $table='user';
    public $primarykey='user_id';
    public $timestamps=false;
}
