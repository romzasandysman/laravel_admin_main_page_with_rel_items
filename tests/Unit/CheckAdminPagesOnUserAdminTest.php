<?php


namespace Tests\Unit;


use App\Tables\Grant;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;
use App\User;

class CheckAdminPagesOnUserAdminTest extends TestCase
{

    public function testIsAdminInRoles(){
        $this->assertTrue($this->checkUserIsAdmin(['admin' => ['data'],'super-admin' => ['data']]));
    }


    public function testNotIsAdminInRoles(){
        $this->assertFalse($this->checkUserIsAdmin(['user' => ['data']]));
    }

    private function checkUserIsAdmin($arRoles){
        if (!$arRoles) return false;

        return !empty($arRoles[Grant::getAdminGroupName()]) || !empty($arRoles[Grant::getSuperAdminGroupName()]);
    }
}
