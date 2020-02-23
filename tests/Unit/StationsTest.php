<?php

namespace Tests\Unit;

use App\Tables\Station;
use Tests\TestCase;

class StationsTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testIsArrayAllStationsWithKeysFilialsIdsTest()
    {
        $this->assertIsArray(Station::getAllStationsWithKeysOfFilialId());
    }

    public function testNotEmptyArrayAllStationsWithKeysFilialsIdsTest()
    {
        $this->assertNotEmpty(Station::getAllStationsWithKeysOfFilialId());
    }

    /**
     * @dataProvider keysForStationsArrWichByFilialsKeys
     */
    public function testHasKeysInStationsWithKeysFilialsIdsTest($keys)
    {
        $this->assertArrayHasKey($keys, Station::getAllStationsWithKeysOfFilialId());
    }

    public function keysForStationsArrWichByFilialsKeys ()
    {
        return array (
            [1],
            [2]
        );
    }
}
