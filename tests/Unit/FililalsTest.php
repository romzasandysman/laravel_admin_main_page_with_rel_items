<?php

namespace Tests\Unit;

use App\Tables\Filial;
use Tests\TestCase;

class FililalsTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testIsArrayAllFilialsTest()
    {
        $this->assertIsArray(Filial::getAllFilials());
    }

    public function testNotEmptyArrayAllFilialsTest()
    {
        $this->assertNotEmpty(Filial::getAllFilials());
    }
}
