<?php

namespace App\Http\Middleware;

use App\Tables\Grant;
use App\User;

use Closure;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;

class CheckAdminPagesOnUserAdmin
{
    /**
     * Обработка входящего запроса.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $arRoles = User::getUserGrants(Auth::id());

        if ($this->checkUserIsAdmin($arRoles) || (is_null(Auth::id()))) {
            return $next($request);
        }

        return abort(404);
    }

    private function checkUserIsAdmin($arRoles){
        if (!$arRoles) return false;

        return !empty($arRoles[Grant::getAdminGroupName()]) || !empty($arRoles[Grant::getSuperAdminGroupName()]);
    }
}
