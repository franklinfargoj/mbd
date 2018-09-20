<?php

namespace App\Http\Middleware;

use App\Permission;
use App\SocietyOfferLetter;
use Auth;
use Closure;

class CheckSocietyOfferLetterPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {   
        // dd(Auth::user());
        // $current_route = \Request::route()->getName();
        // $society_users = SocietyOfferLetter::with(['roles.permission', 'roles.parent', 'roles.child'])->first();
        // dd($society_users);
        // $roles = array_get($user, 'roles');
        // $parent = array_get($roles[0], 'parent');
        // $child = array_get($roles[0], 'child');
        // $only_permissions =  array_flatten(array_pluck($roles, 'permission'));
        // $permissions =  array_pluck($only_permissions, 'name');

        // dd($current_route);
        return $next($request);
    }
}
