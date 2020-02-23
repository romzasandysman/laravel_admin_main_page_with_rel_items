<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tables\Filial;
use App\Tables\Station;
use App\Tools\CacheHelper;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;

class IndexController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('index.index')->with(['filials' => $this->getArrOfFilials()]);
    }

    private function getArrOfFilials(){
        $arFilials = [];
        if (!$arFilials = CacheHelper::getDataFromCacheById(CacheHelper::$cacheIdAllFilialsWithStations)){
            $arFilials = $this->getArrOfFilialsFromDB();
            CacheHelper::saveDataInCache(CacheHelper::$cacheIdAllFilialsWithStations,$arFilials);
        }

        return $arFilials;
    }

    private function getArrOfFilialsFromDB()
    {
        $arFilials = Filial::getAllFilials();
        $arStations = Station::getAllStationsWithKeysOfFilialId();

        foreach ($arFilials as $key => $arFilial) {
            if (empty($arStations[$key])) continue;

            $arFilials[$key]['STATIONS'] = $arStations[$key];
        }

        return $arFilials;
    }
}
