<?php

namespace App\Tables;

use Illuminate\Database\Eloquent\Model;

class Filial extends Model
{
    protected $primaryKey = 'id_filial';
    public $timestamps = false;

    protected $fillable = ['name_filial'];

    public static function getAllFilials(){
        $dbFilials = self::all();
        $arFilials = [];

        foreach ($dbFilials as $dbFilial){
            $arFilials[$dbFilial->id_filial] = [
                'ID' => $dbFilial->id_filial,
                'NAME' => $dbFilial->name_filial,
            ];
        }

        return $arFilials;
    }

    public function stations()
    {
        return $this->hasMany('App\Tables\Station','id_filial');
    }
}
