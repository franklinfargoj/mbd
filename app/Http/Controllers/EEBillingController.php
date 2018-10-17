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

    public function AddRates(){
        return view('admin.ee_billing.add-rates');
    }

    public function ArrearsChargesRate(){
        return view('admin.ee_billing.arrears-charges-rate');
    }
    
    public function AddBuilding(){
        return view('admin.ee_billing.add-building');
    }

    public function EditBuilding(){
        return view('admin.ee_billing.edit-building');
    }

    public function ManageMasters(){
        return view('admin.ee_billing.manage-masters');
    }

    public function BillingLevel(){
        return view('admin.ee_billing.billing-level');
    }

    public function WardColony(){
        return view('admin.ee_billing.ward-colony');
    }

    public function AddTenant(){
        return view('admin.ee_billing.add-tenant');
    }

    public function BillGeneration(){
        return view('admin.ee_billing.bill-generation');
    }

    public function SocietyConveyanceApplication(){
        return view('admin.ee_billing.society-conveyance-application');
    }
}