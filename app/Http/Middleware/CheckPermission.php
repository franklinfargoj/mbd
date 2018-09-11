<?php

namespace App\Http\Middleware;

use App\User;
use Closure;
use Illuminate\Support\Facades\Auth;

class CheckPermission
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
        $current_route = \Request::route()->getName();

        $user = User::with(['roles.permission'])->where('id', Auth::user()->id)->first();
        $roles = array_get($user, 'roles');
        $only_permissions =  array_flatten(array_pluck($roles, 'permission'));
        $permissions =  array_pluck($only_permissions, 'name');

        if(in_array($current_route, $permissions))
        {
            session(['permission' => $permissions]);
            session(['role_name' => $roles->first()->name]);
            session(['role_id' => $roles->first()->id]);
            return $next($request);
        }

        abort(404);
    }
}
