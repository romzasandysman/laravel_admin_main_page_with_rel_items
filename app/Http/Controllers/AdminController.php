<?php

namespace App\Http\Controllers;

use App\Tables\Station;
use App\Tools\CacheHelper;
use Illuminate\Http\Request;
use App\Tables\Filial;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('admin.main_admin');
    }

    public function pageAddFillials(Request $request)
    {
        $nameFilial = $request->get('name_filial');

        if (!empty($nameFilial)){
            if ($this->addNewFilial($nameFilial)){
                CacheHelper::clearCacheById(CacheHelper::$cacheIdAllFilials);
                return redirect()->route('admin.filials',['successMess' => 'филиал успешно добавлен']);
            }else{
                return redirect()->route('admin.filials',['errorMess' => 'Такой филиал уже существует']);
            }
        }
        return view('admin.add_filial',[
            'name_filial' => $nameFilial,
            'successMess' => $request->get('successMess'),
            'errorMess' => $request->get('errorMess'),
        ]);
    }

    public function pageAddStation(Request $request)
    {
        $arDataRequest = $this->getDataFromRequestForStation($request);

        if (!empty($arDataRequest['NAME_STATION'])){
            if ($this->addNewStation($arDataRequest['NAME_STATION'],$arDataRequest['LINK_STATION'],$arDataRequest['ID_FILIAL'])){
                return redirect()->route('admin.station',['successMess' => 'Y']);
            }else{
                return redirect()->route('admin.station',['errorMess' => 'Такая станция уже существует']);
            }
        }
        return view('admin.add_station',[
            'data_station' => $arDataRequest,
            'successMess' => $request->get('successMess'),
            'errorMess' => $request->get('errorMess'),
            'arFilials' => $this->getAllFilials()
        ]);
    }

    private function addNewFilial($nameFilial){
        $filial = Filial::firstOrCreate(['name_filial' => $nameFilial]);
        return $filial->wasRecentlyCreated;
    }

    private function getDataFromRequestForStation(Request $request){
        return [
            'NAME_STATION' => $request->get('name'),
            'LINK_STATION' => $request->get('link'),
            'ID_FILIAL' => $request->get('filial'),
        ];
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
