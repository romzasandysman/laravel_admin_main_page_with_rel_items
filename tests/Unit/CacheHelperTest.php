<?php

namespace Tests\Unit;

use App\Tools\CacheHelper;
use Tests\TestCase;

class CacheHelperTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */

    public function testSaveDataInSelfCache()
    {
        $this->assertTrue(CacheHelper::saveDataInCache('some_value',$this->someValue()));
    }

    public function testClearCacheById(){
        $this->assertTrue(CacheHelper::clearCacheById(CacheHelper::$cacheIdAllFilials));
    }

    public function someValue(){
        return ['1','2','3'];
    }
}
