<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EEBillingController extends Controller
{
    public function Login(){
        return view('admin.ee_billing.login');
    }

    public function Dashboard(){
        return view('admin.ee_billing.dashboard');
    }

    public function ListOfSocieties(){
        return view('admin.ee_billing.list-of-societies');
    }
}