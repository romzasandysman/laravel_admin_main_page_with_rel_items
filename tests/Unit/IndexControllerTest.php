<?php

namespace Tests\Unit;

use App\Tables\Filial;
use App\Tables\Station;
use App\Tools\CacheHelper;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use Tests\TestCase;

class IndexControllerTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testIsArrFilialsWithStationsFromCacheTest()
    {
        $this->assertIsArray($this->getArrOfFilials());
    }

    public function testNotEmptyArrayAllStationsWithKeysFilialsIdsFromCacheTest()
    {
        $this->assertNotEmpty($this->getArrOfFilials());
    }

    public function testIsArrFilialsWithStationsFromDBTest()
    {
        $this->assertIsArray($this->getArrOfFilialsFromDB());
    }

    public function testNotEmptyArrayAllStationsWithKeysFilialsIdsFromDBTest()
    {
        $this->assertNotEmpty($this->getArrOfFilialsFromDB());
    }

    private function getArrOfFilials()
    {
        $arFilials = [];
        if (!$arFilials = CacheHelper::getDataFromCacheById(CacheHelper::$cacheIdAllFilials)){
            $arFilials = $this->getArrOfFilialsFromDB();
            CacheHelper::saveDataInCache(CacheHelper::$cacheIdAllFilials,$arFilials);
        }

        return $arFilials;
    }

    private function getArrOfFilialsFromDB()
    {
        $arFilials = Filial::getAllFilials();
        $arStations = Station::getAllStationsWithKeysOfFilialId();

        foreach ($arFilials as $key => $arFilial) {
            if (!$arStations[$key]) continue;

            $arFilials[$key]['STATIONS'] = $arStations[$key];
        }

        return $arFilials;
    }
}
