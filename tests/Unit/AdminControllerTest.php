<?php

namespace Tests\Unit;

use App\Http\Controllers\AdminController;
use App\Tables\Filial;
use App\Tables\Station;
use App\Tools\CacheHelper;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Tests\TestCase;

class AdminControllerTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */

    public function testAddNewFilialWichExist()
    {
        $this->assertTrue($this->addNewFilial('test4'));
    }

    public function testAddNewFilialWichNotExist()
    {
        $this->assertFalse($this->addNewFilial('test3'));
    }

    public function testAddNewStationIfNotExist()
    {
        $this->assertTrue($this->addNewStation('test', 'test', 1));
    }

    public function testAddNewStationIfExist()
    {
        $this->assertFalse($this->addNewStation('test', 'test', 1));
    }

    public function testWhenEmptyRequestGetRequestData()
    {
        $myRequest = new Request();
        $this->assertEmpty($this->getDataFromRequestForStation($myRequest)['NAME_STATION']);
    }

    public function testWhenNotEmptyRequestGetRequestData()
    {
        $myRequest = new Request();
        $myRequest->merge(['name' => 'test3']);
        $this->assertNotEmpty($this->getDataFromRequestForStation($myRequest));
    }

    public function testGetAllFilials()
    {
        $this->assertNotEmpty($this->getAllFilials());
    }

    private function addNewFilial($nameFilial){
        $filial = Filial::firstOrCreate(['name_filial' => $nameFilial]);
        return $filial->wasRecentlyCreated;
    }

    private function addNewStation($nameStation, $linkStation, $idOfFilial){
        $station = Station::firstOrCreate(
            [
                'id_filial' => $idOfFilial,
                'name_station' => $nameStation,
                'link_station' => $linkStation,
            ]
        );
        return $station->wasRecentlyCreated;
    }

    private function getDataFromRequestForStation(Request $request){
        return [
            'NAME_STATION' => $request->get('name'),
            'LINK_STATION' => $request->get('link'),
            'ID_FILIAL' => $request->get('filial'),
        ];
    }

    private function getAllFilials(){
        $arFilials = [];
        if (!$arFilials = CacheHelper::getDataFromCacheById(CacheHelper::$cacheIdAllFilials)){
            $arFilials = Filial::getAllFilials();
            $arSortFilials = [];

            foreach ($arFilials as $arFilial){
                $arSortFilials[$arFilial['ID']] = $arFilial['NAME'];
            }
            $arFilials = $arSortFilials;
            CacheHelper::saveDataInCache(CacheHelper::$cacheIdAllFilials,$arSortFilials);
        }

        return $arFilials;
    }
}
