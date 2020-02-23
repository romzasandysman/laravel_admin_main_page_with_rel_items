<?php

namespace App\Tables;

use Illuminate\Database\Eloquent\Model;

class Grant extends Model
{
    protected $primaryKey = 'id_grant';
    public $timestamps = false;

    public function users()
    {
        return $this->belongsToMany('App\User','users_grants','id_grant','id_user');
    }

    public static function getAdminGroupName(){
        return 'admin';
    }

    public static function getSuperAdminGroupName(){
        return 'super-admin';
    }
}
