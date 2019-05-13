<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MasterLayout;
use App\MasterWard;
use App\MasterColony;
use App\SocietyDetail;
use App\MasterBuilding;
use App\MasterTenant;
use Validator,Excel,Input;

class ImportController extends Controller
{
    public function import(Request $request) {
		dd(extension_loaded ('zip'));
    	ini_set('memory_limit', -1);
	    ini_set('max_execution_time', 60);
	    if ($request->method() == 'POST') {
	        $requestData = $request->all();
	        $validator = Validator::make($requestData, ['file' => 'required']);
	        
	        if (empty($validator->messages()->toArray())) {
	            if ($request->hasFile('file') && $request->file('file')->isValid()) {
	                
	                $path = Input::file('file')->getRealPath();
	                $data = Excel::load($path, function ($reader) {
	                })->get();

	                if (!empty($data) && $data->count()) {
	                    foreach ($data as $pKey => $row1) {
	                        foreach ($row1 as $pKey => $row) {
	                            // print_r($row1);
	                            if(!empty($row['2'])&&!empty($row['7'])) {

	                                // DB::beginTransaction();
	                                $layout_id = MasterLayout::where('layout_name','Pant Nagar (Part A &C) Ghatkopar')->value('id');

	                                $ward = MasterWard::where('name',$row['2'])->first();
	                                if(empty($ward)) {
	                                    $ward  = new MasterWard;
	                                    $ward->name = $row['2'];
	                                    $ward->layout_id = $layout_id;
	                                    $ward->description = $row['2'];
	                                    $ward->save();
	                                }

	                                $colony = MasterColony::where('name',$row['3'])->first();
	                                if(empty($colony)) {
	                                    $colony  = new MasterColony;
	                                    $colony->name = $row['3'];
	                                    $colony->ward_id = $ward->id;
	                                    $colony->description = $row['3'];
	                                    $colony->save();
	                                }

	                                $society = SocietyDetail::where('society_name',$row['4'])->first();
	                                if(empty($society)) {
	                                    $society = new SocietyDetail;
	                                    $society->colony_id = $colony->id;
	                                    $society->society_name  = $row['4'];
	                                    $society->layout_id  = $layout_id;
	                                    $society->society_bill_level  = 1;
	                                    $society->save();
	                                }

	                                $building = MasterBuilding::where('society_id',$society->id)->where('name',$row['7'])->first();
	                                if(empty($building)) {
	                                    $building = new MasterBuilding;
	                                    $building->society_id = $society->id;
	                                    $building->building_no = $row['6'];
	                                    $building->name = $row['7'];
	                                    $building->description = $row['7'];
	                                    $building->save();
	                                }

	                                if(!empty($society) && !empty($building)) {
	                                    $tenant = new MasterTenant;
	                                    $tenant->building_id = $building->id;
	                                    $tenant->flat_no = 101;
	                                    $tenant->salutation = 'Shri';
	                                    $tenant->first_name = $row['7'];
	                                    $tenant->email_id = 'test@gmail.com';
	                                    $tenant->use = 'residential';
	                                    $tenant->carpet_area = 370;
	                                    $tenant->tenant_type = 1;
	                                    $tenant->save();
	                                }
	                            }
	                        }
	                    }
	                }
	            }
	        } else {
	            return redirect('import')->withErrors($validator)->withInput();;
	        }
	    }
    }
}