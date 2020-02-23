<?php


namespace Tests\Unit;


use Illuminate\Support\Facades\Auth;
use Tests\TestCase;
use App\User;

class UserTest extends TestCase
{

    public function testGetRolesOfUserNotEmpty(){
        $this->assertNotEmpty($this->getUserGrants(1));
    }

    public function testGetRolesOfUserIsAdmin(){
        $this->assertArrayHasKey('admin',$this->getUserGrants(1));
    }

    private function getUserGrants($idUser){
        if (!$idUser) return null;

        $arRoles = [];
        $user = User::find($idUser);

        foreach ($user->roles as $role){
            $arRoles[$role->grant_name] = [
                'ROLE' => $role->grant_name,
                'ROLE_RUS' => $role->grant_name_rus,
            ];
        }

        return $arRoles;
    }
}
