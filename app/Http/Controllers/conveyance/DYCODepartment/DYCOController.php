<?php

namespace App\Http\Controllers\conveyance\DYCODepartment;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DYCOController extends Controller
{
    public function showChecklist(Request $request){
    	return view('admin.conveyance.dyco_department.checklist_office_note');
    }
}
