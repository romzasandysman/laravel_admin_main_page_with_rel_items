<?php

namespace App\Tables;

use Illuminate\Database\Eloquent\Model;

class Station extends Model
{
    protected $primaryKey = 'id_station';
    public $timestamps = false;

    protected $fillable = ['id_filial','name_station','link_station'];

    public static function getAllStationsWithKeysOfFilialId(){
        $dbStations = self::all();
        $arStations = [];

        foreach ($dbStations as $dbStation){
            $arStations[$dbStation->id_filial][] = [
                'ID' => $dbStation->id_station,
                'NAME' => $dbStation->name_station,
                'LINK' => $dbStation->link_station,
            ];
        }

        return $arStations;
    }

    public function filial()
    {
        return $this->belongsTo('App\Tables\Filial','filial_id');
    }
}
