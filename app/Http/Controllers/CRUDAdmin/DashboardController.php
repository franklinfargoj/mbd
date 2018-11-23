<?php
/**
 * Class DashboardController for Dashboard.
 *
 * Author : Prajakta Sisale.
 */
namespace App\Http\Controllers\CRUDAdmin;
use App\Http\Controllers\Controller;



class DashboardController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        return view('admin.crud_admin.dashboard');
    }

}