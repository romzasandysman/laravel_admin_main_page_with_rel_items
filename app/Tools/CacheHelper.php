<?php
namespace App\Tools;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;

class CacheHelper{
    public static $cacheIdAllFilialsWithStations = 'filials_with_stations';
    public static $cacheIdAllFilials = 'all_filials';
    public static $minute = 36000;

    public static function saveDataInCache($cacheId,$data){
        if (!Cache::has($cacheId)){
           return Cache::put($cacheId,$data,Carbon::now()->addMinutes(self::$minute));
        }
    }

    public static function getDataFromCacheById($cacheId){
        return Cache::get($cacheId);
    }

    public static function clearCacheById($cacheId){
        if (!$cacheId) return false;

        return Cache::forget($cacheId);
    }
}
