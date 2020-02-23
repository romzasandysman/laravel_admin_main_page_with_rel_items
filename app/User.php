<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable
{
    use Notifiable;

    public $timestamps = false;
    protected $primaryKey = 'id_user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roles()
    {
        return $this->belongsToMany('App\Tables\Grant','users_grants','id_user','id_grant');
    }

    public static function getUserGrants($idUser){
        if (!$idUser) return null;

        $arRoles = [];
        $user = self::find($idUser);

        foreach ($user->roles as $role){
            $arRoles[$role->grant_name] = [
                'ROLE' => $role->grant_name,
                'ROLE_RUS' => $role->grant_name_rus,
            ];
        }

        return $arRoles;
    }
}
