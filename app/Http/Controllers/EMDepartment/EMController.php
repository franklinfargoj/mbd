<?php

namespace App\Http\Controllers\EMDepartment;

use App\EENote;
use App\Http\Controllers\Common\CommonController;
use App\OlApplication;
use App\OlApplicationStatus;
use App\OlChecklistScrutiny;
use App\OlConsentVerificationDetails;
use App\OlConsentVerificationQuestionMaster;
use App\OlDemarcationVerificationDetails;
use App\OlDemarcationVerificationQuestionMaster;
use App\OlRelocationVerificationDetails;
use App\OlRgRelocationVerificationQuestionMaster;
use App\OlSocietyDocumentsMaster;
use App\OlSocietyDocumentsStatus;
use App\OlTitBitVerificationDetails;
use App\OlTitBitVerificationQuestionMaster;
use App\Role;
use App\SocietyOfferLetter;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\DataTables;
use Config;
use DB;
use File;
use Storage;
use App\MasterLayout;
use App\MasterWard;
use App\MasterColony;
use App\MasterBuilding;
use App\MasterTenant;
use App\SocietyDetail;
use App\ServiceChargesRate;
use App\ArrearCalculation;
use App\TransBillGenerate;

class EMController extends Controller
{
    public function __construct()
    {
        $this->comman = new CommonController();
        $this->list_num_of_records_per_page = Config::get('commanConfig.list_num_of_records_per_page');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Datatables $datatables)
    {
        $getData = $request->all();

        //dd(session()->get('layout_id'));
        
        $columns = [
            ['data' => 'radio','name' => 'radio','title' => '','searchable' => false],
            ['data' => 'rownum','name' => 'rownum','title' => 'Sr No.','searchable' => false],
            ['data' => 'application_no','name' => 'application_no','title' => 'Application Number'],
            ['data' => 'submitted_at','name' => 'submitted_at','title' => 'Date', 'class' => 'datatable-date'],
            ['data' => 'eeApplicationSociety.name','name' => 'eeApplicationSociety.name','title' => 'Society Name'],
            ['data' => 'eeApplicationSociety.building_no', 'name' => 'eeApplicationSociety.building_no', 'title' => 'Building No'],
            ['data' => 'eeApplicationSociety.address','name' => 'eeApplicationSociety.address','title' => 'Address','class' => 'datatable-address'],
//            ['data' => 'model','name' => 'model','title' => 'Model'],
            ['data' => 'Status','name' => 'current_status_id','title' => 'Status'],
            // ['data' => 'actions','name' => 'actions','title' => 'Actions','searchable' => false,'orderable'=>false],
        ];

        if ($datatables->getRequest()->ajax()) {

            $ee_application_data =  $this->comman->listApplicationData($request);

            return $datatables->of($ee_application_data)
                ->editColumn('rownum', function ($listArray) {
                    static $i = 0; $i++; return $i;
                })
                ->editColumn('radio', function ($ee_application_data) {
                    $url = route('ee.view_application', $ee_application_data->id);
                    return '<label class="m-radio m-radio--primary m-radio--link"><input type="radio" onclick="geturl(this.value);" value="'.$url.'" name="village_data_id"><span></span></label>';
                })                
                ->editColumn('eeApplicationSociety.name', function ($listArray) {
                    return $listArray->eeApplicationSociety->name;
                })
                ->editColumn('eeApplicationSociety.building_no', function ($listArray) {
                    return $listArray->eeApplicationSociety->building_no;
                })
                ->editColumn('eeApplicationSociety.address', function ($listArray) {
                    return "<span>".$listArray->eeApplicationSociety->address."</span>";
                })
                ->editColumn('Status', function ($listArray) use ($request) {
                    $status = $listArray->olApplicationStatusForLoginListing[0]->status_id;
                    // dd(config('commanConfig.applicationStatusColor.'.$status));
                    if($request->update_status)
                    {
                        if($request->update_status == $status){
                            $config_array = array_flip(config('commanConfig.applicationStatus'));
                            $value = ucwords(str_replace('_', ' ', $config_array[$status]));
                            return '<span class="m-badge m-badge--'. config('commanConfig.applicationStatusColor.'.$status) .' m-badge--wide">'.$value.'</span>';
                        }
                    } else {
                        $config_array = array_flip(config('commanConfig.applicationStatus'));
                        $value = ucwords(str_replace('_', ' ', $config_array[$status]));
                        return '<span class="m-badge m-badge--'. config('commanConfig.applicationStatusColor.'.$status) .' m-badge--wide">'.$value.'</span>';
                    }

                })
                ->editColumn('submitted_at', function ($listArray) {
                    return date(config('commanConfig.dateFormat'), strtotime($listArray->submitted_at));
                })
                // ->editColumn('actions', function ($ee_application_data) use($request) {
                //     return view('admin.ee_department.actions', compact('ee_application_data', 'request'))->render();
                // })
                ->rawColumns(['radio','society_name', 'society_building_no', 'society_address', 'Status', 'submitted_at','eeApplicationSociety.address'])
                ->make(true);
        }
        
        $html = $datatables->getHtmlBuilder()->columns($columns)->parameters($this->getParameters());

        return view('admin.em_department.index', compact('html','header_data','getData'));
    }

    protected function getParameters() {
        return [
            'serverSide' => true,
            'processing' => true,
            'ordering'   =>'isSorted',
            "order"=> [0, "asc" ],
            "pageLength" => $this->list_num_of_records_per_page
        ];
    }

    public function getsocieties(Request $request, Datatables $datatables){
        // dd($request->id);
        $columns = [
            ['data' => 'rownum','name' => 'rownum','title' => 'Sr No.','searchable' => false],
            ['data' => 'society_name','name' => 'society_name','title' => 'Society Name'],
            ['data' => 'actions','name' => 'actions','title' => 'Actions','searchable' => false,'orderable'=>false],
        ];


        $layouts = DB::table('layout_user')->where('user_id', '=', Auth::user()->id)->pluck('layout_id');
        $layout_data = MasterLayout::whereIn('id', $layouts)->get();
       // dd($layout_data);
        $wards = MasterWard::whereIn('layout_id', $layouts)->pluck('id');
        //dd($wards);
        $colonies = MasterColony::whereIn('ward_id', $wards)->pluck('id');
        //dd($colonies);

        //done by shrikant sabne
        //$societies = SocietyDetail::whereIn('colony_id', $colonies)->paginate(10);
        if ($request->has('id') && '' != $request->get('id')) {

            $wards = MasterWard::where('layout_id', '=', $request->input('id'))->pluck('id');
            $colonies = MasterColony::whereIn('ward_id', $wards)->pluck('id');
            
        }

        if ($datatables->getRequest()->ajax()) {
           
                DB::statement(DB::raw('set @rownum='. (isset($request->start) ? $request->start : 0) ));
                $societies = SocietyDetail::selectRaw('@rownum  := @rownum  + 1 AS rownum,lm_society_detail.*');
                if ($request->has('id') && '' != $request->get('id')) {
                    $societies = $societies->whereIn('colony_id', $colonies);
                }
                
            return $datatables->of($societies)
                ->editColumn('actions', function ($societies){
	                return "<div class='d-flex btn-icon-list'>
                    <a href='".route('get_buildings', [encrypt($societies->id)])."' class='d-flex flex-column align-items-center ' style='padding-left: 5px; padding-right: 5px; text-decoration: none; color: #212529; font-size:12px;'><span class='btn-icon btn-icon--view'><img src='".asset('/img/view-icon.svg')."'></span>Building Details</a>
                
                    <a href='".route('soc_bill_level', [encrypt($societies->id)])."' class='d-flex flex-column align-items-center' style='padding-left: 5px; padding-right: 5px; text-decoration: none; color: #212529; font-size:12px;'><span class='btn-icon btn-icon--edit'><img src='".asset('/img/edit-icon.svg')."'></span>Bill Level</a>
                   
                    <a href='".route('soc_ward_colony', [encrypt($societies->id)])."' class='d-flex flex-column align-items-center' style='padding-left: 5px; padding-right: 5px; text-decoration: none; color: #212529; font-size:12px;'><span class='btn-icon btn-icon--delete'><img src='".asset('/img/generate-bill-icon.svg')."'></span>Ward & colony</a>

                </div>";
	                
                })               
	            ->rawColumns(['actions'])
                ->make(true);
            
        }
     
        $html = $datatables->getHtmlBuilder()->columns($columns)->parameters($this->getParameters());

        return view('admin.em_department.society', compact('layout_data','html'));

    //     if($request->input('id')){            
    //         $wards = MasterWard::where('layout_id', '=', $request->input('id'))->pluck('id');
    //         $colonies = MasterColony::whereIn('ward_id', $wards)->pluck('id');
    //         $societies = SocietyDetail::whereIn('colony_id', $colonies)->paginate(10);
            
    //         return view('admin.em_department.ajax_society', compact('societies'));
            
    //     } elseif(!empty($request->input('search'))) {
                
    //       $layouts = DB::table('layout_user')->where('user_id', '=', Auth::user()->id)->pluck('layout_id');
    //       $layout_data = MasterLayout::whereIn('id', $layouts)->get();
    //       $wards = MasterWard::whereIn('layout_id', $layouts)->pluck('id');
    //       $colonies = MasterColony::whereIn('ward_id', $wards)->pluck('id');
    //       $societies = SocietyDetail::whereIn('colony_id', $colonies)->where('society_name','like', '%'.$request->input('search').'%')->paginate(10);
    //       return view('admin.em_department.ajax_society', compact('societies'));
        
    //     } else {
    
    //     $layouts = DB::table('layout_user')->where('user_id', '=', Auth::user()->id)->pluck('layout_id');
    //     $layout_data = MasterLayout::whereIn('id', $layouts)->get();
    //    // dd($layout_data);
    //     $wards = MasterWard::whereIn('layout_id', $layouts)->pluck('id');
    //     //dd($wards);
    //     $colonies = MasterColony::whereIn('ward_id', $wards)->pluck('id');
    //     //dd($colonies);

    //     //done by shrikant sabne
    //     //$societies = SocietyDetail::whereIn('colony_id', $colonies)->paginate(10);
        
    //     $societies = SocietyDetail::paginate(10);
    //     //dd($societies);
    //     if($request->has('search')) {
    //         return view('admin.em_department.ajax_society', compact('societies'));  
    //     } else {
    //         return view('admin.em_department.society', compact('layout_data','societies'));
    //     }
    //   }
     
    }

    public function getbuildings($id, Request $request, Datatables $datatables){
        //$societies = SocietyDetail::whereIn('colony_id', $colonies)->get();
       // dd($id);
       $columns = [
            ['data' => 'rownum','name' => 'rownum','title' => 'Sr No.','searchable' => false],
            ['data' => 'building_no','name' => 'building_no','title' => 'Building / Chawl Number'],
            ['data' => 'name','name' => 'name','title' => 'Building / Chawl Name'],
            ['data' => 'tenant_count','name' => 'tenant_count','title' => 'Tenant Count'],
            ['data' => 'actions','name' => 'actions','title' => 'Actions','searchable' => false,'orderable'=>false],
        ];
        $society_id =decrypt($id);
        $building_name = '';
        $building_no   = '';

        if($request->has('building_name') && !empty($request->building_name)) {
            $building_name = $request->building_name;
        }
        if($request->has('building_no') && !empty($request->building_no)) {
            $building_no = $request->building_no;
        }
        
        if ($datatables->getRequest()->ajax()) {
            DB::statement(DB::raw('set @rownum='. (isset($request->start) ? $request->start : 0) ));
            $buildings =MasterBuilding::with('tenant_count')->where('society_id', '=', decrypt($id))->where(function ($query) use ($request) {
                       $query->orWhere('name', 'like', '%'.$request->building_name.'%')
                         ->orWhere('building_no', 'like', '%'.$request->building_no.'%');
                        })
                        ->selectRaw('@rownum  := @rownum  + 1 AS rownum,master_buildings.*')->orderBy('id','DESC')
                        ->get();
            
            return $datatables->of($buildings)
            ->editColumn('tenant_count', function ($buildings){  
               $value = $buildings->tenant_count->toArray(); 
               if($value) {
                   foreach($value as $i) {
                     return $i['count'];
                   }
                } else {
                    return 0;
                }
            })
            ->editColumn('actions', function ($buildings){
                return "<div class='d-flex btn-icon-list'>
                <a href='".route('get_tenants', [encrypt($buildings->id)])."' class='d-flex flex-column align-items-center ' style='padding-left: 5px; padding-right: 5px; text-decoration: none; color: #212529; font-size:12px;'><span class='btn-icon btn-icon--view'><img src='".asset('/img/view-icon.svg')."'></span>Tenant Details</a>
            
                <a href='".route('edit_building', [encrypt($buildings->id)])."' class='d-flex flex-column align-items-center' style='padding-left: 5px; padding-right: 5px; text-decoration: none; color: #212529; font-size:12px;'><span class='btn-icon btn-icon--edit'><img src='".asset('/img/edit-icon.svg')."'></span>Edit</a>

            </div>";
                
            })               
            ->rawColumns(['actions'])
            ->make(true);
         }
         $html = $datatables->getHtmlBuilder()->columns($columns)->parameters($this->getParameters());
         return view('admin.em_department.building', compact('html', 'society_id','building_name','building_no'));
        // if(!empty($request->input('search'))) {
        //     $society_id = $id;
        //     $buildings = MasterBuilding::with('tenant_count')->where('society_id', '=', decrypt($id))
        //         ->where(function ($query) use ($request) {
        //           $query->orWhere('name', 'like', '%'.$request->input('search').'%')
        //                ->orWhere('building_no', 'like', '%'.$request->input('search').'%');
        //         })
        //         ->paginate(10);
        //     //dd($buildings);
        //     return view('admin.em_department.ajax_building', compact('buildings', 'society_id'));
        // } else {
        //     $society_id =decrypt($id);
        //     $building_name = '';
        //     $building_no   = '';

        //     if($request->has('building_name') && !empty($request->building_name)) {
        //         $building_name = $request->building_name;
        //     }
        //     if($request->has('building_no') && !empty($request->building_no)) {
        //         $building_no = $request->building_no;
        //     }
        //     $buildings = MasterBuilding::with('tenant_count')->where('society_id', '=', decrypt($id))->where(function ($query) use ($request) {
        //           $query->orWhere('name', 'like', '%'.$request->building_name.'%')
        //                ->orWhere('building_no', 'like', '%'.$request->building_no.'%');
        //         })->paginate(10);
        //     //dd($buildings);
        //     if($request->has('search')) {
        //         return view('admin.em_department.ajax_building', compact('buildings', 'society_id'));  
        //     } else {
        //         return view('admin.em_department.building', compact('buildings', 'society_id','building_name','building_no'));
        //     }            
        // }
        
    }

    public function gettenants($id, Request $request, Datatables $datatables){
         $tenament = DB::table('master_tenant_type')->get();

         $columns = [
            ['data' => 'rownum','name' => 'rownum','title' => 'Sr No.','searchable' => false],
            ['data' => 'flat_no','name' => 'flat_no','title' => 'Flat No.'],
            ['data' => 'salutation','name' => 'salutation','title' => 'Salutation'],
            ['data' => 'first_name','name' => 'first_name','title' => 'First Name'],
            ['data' => 'last_name','name' => 'last_name','title' => 'Last Name'],
            ['data' => 'use','name' => 'use','title' => 'Use'],
            ['data' => 'carpet_area','name' => 'carpet_area','title' => 'Carpet Area'],
            ['data' => 'tenant_type','name' => 'tenant_type','title' => 'Tenant Type'],
            ['data' => 'actions','name' => 'actions','title' => 'Actions','searchable' => false,'orderable'=>false]
        ];
        $building_id = $id;
        $society_id = MasterBuilding::find(decrypt($id))->society_id;
        if ($datatables->getRequest()->ajax()) {
            DB::statement(DB::raw('set @rownum='. (isset($request->start) ? $request->start : 0) ));
            $buildings = MasterTenant::selectRaw('@rownum  := @rownum  + 1 AS rownum,master_tenants.*');
            return $datatables->of($buildings)
                ->editColumn('actions', function ($buildings){
                    return "<div class='d-flex btn-icon-list'>
                    <a href='".route('edit_tenant', [encrypt($buildings->id)])."' class='d-flex flex-column align-items-center ' style='padding-left: 5px; padding-right: 5px; text-decoration: none; color: #212529; font-size:12px;'><span class='btn-icon btn-icon--view'><img src='".asset('/img/view-icon.svg')."'></span>Edit</a>
                    <a href='".route('delete_tenant', [encrypt($buildings->id)])."' class='d-flex flex-column align-items-center' onclick='return confirm('Are you sure?')' style='padding-left: 5px; padding-right: 5px; text-decoration: none; color: #212529; font-size:12px;'><span class='btn-icon btn-icon--delete'><img src='".asset('/img/delete-icon.svg')."'></span>Delete</a>

                </div>";
                    
                })               
                ->rawColumns(['actions'])
                ->make(true);
        }
        $html = $datatables->getHtmlBuilder()->columns($columns)->parameters($this->getParameters());
        return view('admin.em_department.tenant', compact('html', 'tenament','building_id','society_id'));
        // if(!empty($request->input('search'))) {
        //     $building_id = $id;
        //     $society_id = MasterBuilding::find(decrypt($id))->society_id;
        //     $buildings = MasterTenant::where('building_id', '=', decrypt($id))
        //          ->where(function ($query) use ($request) {
        //            $query->orWhere('first_name', 'like', '%'.$request->input('search').'%')
        //                 ->orWhere('middle_name', 'like', '%'.$request->input('search').'%')
        //                 ->orWhere('flat_no', 'like', '%'.$request->input('search').'%')
        //                 ->orWhere('last_name', 'like', '%'.$request->input('search').'%');
        //         })->paginate(10);
        //     return view('admin.em_department.ajax_tenant', compact('tenament','buildings', 'building_id','society_id'));
        // } else {
        //     $building_id = $id;
        //     $society_id = MasterBuilding::find(decrypt($id))->society_id;
        //     $buildings = MasterTenant::where('building_id', '=', decrypt($id))->paginate(10);
        //     if($request->has('search')) {
        //         return view('admin.em_department.ajax_tenant', compact('tenament','buildings', 'building_id','society_id'));  
        //     } else {
        //         return view('admin.em_department.tenant', compact('tenament','buildings', 'building_id','society_id'));
        //     }
        // }
        
    }

    public function soc_bill_level($id){
        $society = SocietyDetail::where('id','=',decrypt($id))->get();
        //dd($society);
        $soc_bill_level = DB::table('master_society_bill_level')->get();
       // dd($soc_bill_level);
        return view('admin.em_department.soc_bill_level', compact('society','soc_bill_level'));
    }

    public function soc_ward_colony($id){
        
        $society = SocietyDetail::where('id','=',decrypt($id))->get();
        //dd($society);
        $soc_colony = MasterColony::where('id', '=', $society[0]->colony_id)->first();

        //$soc_colony = MasterColony::first();
        //dd($soc_colony);
        $layouts = DB::table('layout_user')->where('user_id', '=', Auth::user()->id)->pluck('layout_id');
        $layout_data = MasterLayout::whereIn('id', $layouts)->get();
       // dd($layout_data);
        $wards = MasterWard::whereIn('layout_id', $layouts)->get();
        
        $wards_id = MasterWard::whereIn('layout_id', $layouts)->pluck('id');
       
        $colonies = MasterColony::whereIn('ward_id', $wards_id)->get();
        // dd($colonies);
       return view('admin.em_department.soc_ward_colony', compact('society','wards','colonies', 'soc_colony'));
    }

    public function get_wards(Request $request){
    
        if($request->input('id')){
        $wards = MasterWard::where('layout_id', '=', $request->input('id'))->get();

        $html = '<select class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input" id="wards" name="wards">';
        $html .= '<option value="" style="font-weight: normal;">Select ward</option>';

            foreach($wards as $key => $value){
                $html .= '<option value="'.$value->id.'">'.$value->name.'</option>';
            }   
        $html .= '</select>';         

        return $html;
        }
    }

    public function get_colonies(Request $request){
    
        if($request->input('id')){
        $colonies = MasterColony::where('ward_id', '=', $request->input('id'))->get();

        $html = '<select class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input" id="colony" name="colony">';
        $html .= '<option value="" style="font-weight: normal;">Select Colony</option>';

            foreach($colonies as $key => $value){
                $html .= '<option value="'.$value->id.'">'.$value->name.'</option>';
            }   
        $html .= '</select>';         

        return $html;
        }
    }

    public function get_society_select(Request $request){
    
        if($request->input('id')){
        $society = SocietyDetail::where('colony_id', '=', $request->input('id'))->get();

        $html = '<select class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input" id="society" name="society">';
        $html .= '<option value="" style="font-weight: normal;">Select Society</option>';

            foreach($society as $key => $value){
                $html .= '<option value="'.$value->id.'">'.$value->society_name.'</option>';
            }   
        $html .= '</select>';         

        return $html;
        }
    }

    public function get_building_ajax(Request $request){

            $society_id = $request->input('id');
            $buildings = MasterBuilding::with('tenant_count')->where('society_id', '=', $request->input('id'))
                        ->get();
            //return $buildings;
            return view('admin.em_department.ajax_building_bill_generation', compact('buildings', 'society_id'));
    }

    public function get_building_select(Request $request){
    
        if($request->input('id')){
        $building = MasterBuilding::where('society_id', '=', $request->input('id'))->get();

        $html = '<select class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input" id="building" name="building">';
        $html .= '<option value="" style="font-weight: normal;">Select Building</option>';

            foreach($building as $key => $value){
                $html .= '<option value="'.$value->id.'">'.$value->name.'</option>';
            }   
        $html .= '</select>';         

        return $html;
        }
    }

    public function get_tenant_ajax(Request $request){
         $tenament = DB::table('master_tenant_type')->get();
         $building_id = $request->input('id');
         $society_id = MasterBuilding::where('id', '=', $request->input('id'))->first()->society_id;
         $buildings = MasterTenant::with(['TransBillGenerate' => function($query) use($building_id){
            $query->where('building_id',$building_id)->where('bill_month', '=', date('m'))->where('bill_year', '=', date('Y'));
         }])->where('building_id', '=', $request->input('id'))
                 ->get();

                 // return $buildings;
            return view('admin.em_department.ajax_tenant_bill_generation', compact('tenament','buildings', 'building_id', 'society_id'));
    }

    public function update_soc_ward_colony(Request $request){

        $temp = array(       
            'id' => 'required',
            'wards' => 'required', 
            'colony' => 'required' 
        );

        $this->validate($request, $temp);
        
        $society = SocietyDetail::find($request->input('id'));
        $society->colony_id = $request->input('colony');
        $society->save();

        return redirect()->back()->with('success', 'Society Ward & Colony Details Updated Successfully.');
    }

    public function update_soc_bill_level(Request $request){
        //dd($request->all());
        $temp = array(       
        'id' => 'required',
        'soc_bill_level' => 'required' 
        );
        // validate the Grievances form data.
        $this->validate($request, $temp);

        $society = SocietyDetail::find($request->input('id'));
        $society->society_bill_level = $request->input('soc_bill_level');
        $society->save();

        return redirect()->back()->with('success', 'Society billing level Updated Successfully.');
    }
    
    public function add_building($id){
        return view('admin.em_department.add_building')->with('society_id', decrypt($id));
    }

    public function create_building(Request $request){
        //return $request->all();
         $temp = array(       
        'society_id' => 'required',
        'name' => 'required',
        'building_no' => 'required' 
        );
        // validate the Grievances form data.
        $this->validate($request, $temp);

        $building =  new MasterBuilding;
        $building->society_id = $request->input('society_id');
        $building->name = $request->input('name');
        $building->building_no = $request->input('building_no');
        $building->description = $request->input('name');
        $building->save();

        //return redirect()->back()->with('success', 'Building Added Successfully.');

        return redirect()->route('get_buildings', [encrypt($building->society_id)])->with('success', 'Building Added Successfully.');
    }

    public function edit_building($id){
        $building = MasterBuilding::where('id', '=', decrypt($id))->first();
        return view('admin.em_department.edit_building')->with('building', $building);
        //return $building;
    }

    public function update_building(Request $request){
       // return $request->all();
        $temp = array( 
        'id' => 'required',      
        'society_id' => 'required',
        'name' => 'required',
        'building_no' => 'required' 
        );
        // validate the Grievances form data.
        $this->validate($request, $temp);

        $building = MasterBuilding::find($request->input('id'));
        $building->society_id = $request->input('society_id');
        $building->name = $request->input('name');
        $building->building_no = $request->input('building_no');
        $building->description = $request->input('name');
        $building->save();

       // return redirect()->back()->with('success', 'Building Details Updated Successfully.');
        return redirect()->route('get_buildings', [encrypt($building->society_id)])->with('success', 'Building Details Updated Successfully.');
    }

    /*
    * Add Tenant 
    * @ param    => Building ID 
    * @ Response => Return View with Building ID.
    */
    public function add_tenant($id){
        $tenament = DB::table('master_tenant_type')->get();
        return view('admin.em_department.add_tenant')->with('building_id', $id)->with('tenament',$tenament);
    }

    /*
    * Add Tenant 
    * @ param    => Request Data. 
    * @ Response => Return Success Message.
    */
    public function create_tenant(Request $request){
        //return $request->all();
         $temp = array(       
        'building_id' => 'required',
        'flat_no' => 'required',
        'salutation' => 'required|alpha',
        'first_name' => 'required|alpha',
        'middle_name' => 'required|alpha',
        'last_name' => 'required|alpha',
        'mobile' => 'required|numeric|digits:10',
        'email_id' => 'required|email',
        'use' => 'required',
        'carpet_area' => 'required', 
        'tenant_type' => 'required'
        );
        // validate the Grievances form data.
        $this->validate($request, $temp);

        $tenant =  new MasterTenant;
        $tenant->building_id = $request->input('building_id');
        $tenant->flat_no = $request->input('flat_no');
        $tenant->salutation = $request->input('salutation');
        $tenant->first_name = $request->input('first_name');
        $tenant->middle_name = $request->input('middle_name');
        $tenant->last_name = $request->input('last_name');
        $tenant->mobile = $request->input('mobile');
        $tenant->email_id = $request->input('email_id');
        $tenant->use = $request->input('use');
        $tenant->carpet_area = $request->input('carpet_area');
        $tenant->tenant_type = $request->input('tenant_type');
        $tenant->save();

        //return redirect()->back()->with('success', 'Tenant Added Successfully.');
        return redirect()->route('get_tenants', [encrypt($tenant->building_id)])->with('success', 'Tenant Added Successfully.');
    }

    /*
    * Edit Tenant 
    * @ param    => Request id. 
    * @ Response => Return view with tenant details.
    */
    public function edit_tenant($id){
        $tenant = MasterTenant::where('id', '=', decrypt($id))->first();
         $tenament = DB::table('master_tenant_type')->get();
        return view('admin.em_department.edit_tenant')->with('tenant', $tenant)->with('tenament',$tenament);
        //return $building;
    }

    /*
    * Update Tenant 
    * @ param    => Request Data. 
    * @ Response => Return view with Success Message.
    */
    public function update_tenant(Request $request){
       // return $request->all();
        $temp = array(       
        'id' => 'required',
        'building_id' => 'required',
        'flat_no' => 'required',
        'salutation' => 'required|alpha',
        'first_name' => 'required|alpha',
        'middle_name' => 'required|alpha',
        'last_name' => 'required|alpha',
        'mobile' => 'required|numeric|digits:10',
        'email_id' => 'required|email',
        'use' => 'required',
        'carpet_area' => 'required', 
        'tenant_type' => 'required'
        );
        // validate the Grievances form data.
        $this->validate($request, $temp);

        $tenant = MasterTenant::find($request->input('id'));
        $tenant->building_id = $request->input('building_id');
        $tenant->flat_no = $request->input('flat_no');
        $tenant->salutation = $request->input('salutation');
        $tenant->first_name = $request->input('first_name');
        $tenant->middle_name = $request->input('middle_name');
        $tenant->last_name = $request->input('last_name');
        $tenant->mobile = $request->input('mobile');
        $tenant->email_id = $request->input('email_id');
        $tenant->use = $request->input('use');
        $tenant->carpet_area = $request->input('carpet_area');
        $tenant->tenant_type = $request->input('tenant_type');
        $tenant->save();

        //return redirect()->back()->with('success', 'Tenant Added Successfully.');
        return redirect()->route('get_tenants', [encrypt($tenant->building_id)])->with('success', 'Tenant Updated Successfully.');
    }

    public function delete_tenant($id){
        $tenant = MasterTenant::find(decrypt($id));
        $tenant->delete();
        return redirect()->back()->with('success', 'Tenant Removed Successfully.');
    }

    public function generate_soc_bill(Request $request){
        // return $id;
        $layouts = DB::table('layout_user')->where('user_id', '=', Auth::user()->id)->pluck('layout_id');
        $layout_data = MasterLayout::whereIn('id', $layouts)->get();
       // dd($layout_data);
        $wards = MasterWard::whereIn('layout_id', $layouts)->pluck('id');
        $wards_data = MasterWard::whereIn('layout_id', $layouts)->get();

        //dd($wards);
        $colonies = MasterColony::whereIn('ward_id', $wards)->pluck('id');

        $colonies_data = MasterColony::whereIn('ward_id', $wards)->get();

        //dd($colonies);
        $societies_data = SocietyDetail::where('society_bill_level', '=', '1')->whereIn('colony_id', $colonies)->get();

        //return $rate_card;
        return view('admin.em_department.generate_bill', compact('layout_data', 'wards_data', 'colonies_data','societies_data'));

    }

    public function generate_tenant_bill(Request $request){
            // return $id;
        $layouts = DB::table('layout_user')->where('user_id', '=', Auth::user()->id)->pluck('layout_id');
        $layout_data = MasterLayout::whereIn('id', $layouts)->get();
       // dd($layout_data);
        $wards = MasterWard::whereIn('layout_id', $layouts)->pluck('id');
        $wards_data = MasterWard::whereIn('layout_id', $layouts)->get();

        //dd($wards);
        $colonies = MasterColony::whereIn('ward_id', $wards)->pluck('id');

        $colonies_data = MasterColony::whereIn('ward_id', $wards)->get();

        //dd($colonies);
        $societies = SocietyDetail::whereIn('colony_id', $colonies)->pluck('id');
        $societies_data = SocietyDetail::where('society_bill_level', '=', '2')->whereIn('colony_id', $colonies)->get();

        $building_data = MasterBuilding::whereIn('society_id', $societies)->get();

        //return $rate_card;
        return view('admin.em_department.generate_bill_tenant_level', compact('layout_data', 'wards_data', 'colonies_data','societies_data', 'building_data'));

    }

    public function generateBuildingBill(Request $request) {

        if($request->has('building_id') && '' != $request->building_id) {

            $request->building_id = decrypt($request->building_id);
            $request->society_id  = decrypt($request->society_id);            

            $data['building'] = MasterBuilding::find($request->building_id);
            $data['society'] = SocietyDetail::find($data['building']->society_id);
            $data['serviceChargesRate'] = ServiceChargesRate::selectRaw('Sum(water_charges) as water_charges,sum(electric_city_charge) as electric_city_charge,sum(pump_man_and_repair_charges) as  pump_man_and_repair_charges,sum(external_expender_charge) as external_expender_charge,sum(administrative_charge) as administrative_charge, sum(lease_rent) as lease_rent,sum(na_assessment) as na_assessment, sum(other) as other')->where('building_id',$request->building_id)->where('year',date('Y'))->first();

         //  dd($data['serviceChargesRate']); 
            if(!$data['serviceChargesRate']){
                return redirect()->back()->with('warning', 'Service charge Rates Not added into system.');
            }

            $data['arreasCalculation'] = ArrearCalculation::where('building_id',$request->building_id)->where('payment_status','0')->orderby('year','month')->get();
                
            $data['number_of_tenants'] = MasterBuilding::with('tenant_count')->where('id',$request->building_id)->first();
             //dd($data['number_of_tenants']->tenant_count()->first());
            if(!$data['number_of_tenants']->tenant_count()->first()) {
                return redirect()->back()->with('warning', 'Number of Tenants Is zero.');
            }

            $data['month'] = date('m');
            $data['year'] = date('Y');
            $data['consumer_number'] = substr(sprintf('%08d', $data['building']->society_id),0,8).'|'.substr(sprintf('%08d', $data['building']->id),0,8);

            $data['check'] = TransBillGenerate::where('building_id', '=', $request->building_id)
                                ->where('society_id', '=', $request->society_id)
                                ->where('bill_month', '=', $data['month'])
                                ->where('bill_year', '=', $data['year'])
                                ->first();
            $data['regenate'] = false;                    
            if($request->has('regenate') && true == $request->regenate) {
                $data['regenate'] = true;
            }
            return view('admin.em_department.generate_building_bill',$data);

        }
    }

    public function generateTenantBill(Request $request) {
        // print_r($request->all());exit;
        if($request->has('building_id') && '' != $request->building_id && $request->has('tenant_id') && '' != $request->tenant_id) {
            $request->building_id = decrypt($request->building_id);
            $request->tenant_id  = decrypt($request->tenant_id);

            $data['building'] = MasterBuilding::find($request->building_id);
            $data['society'] = SocietyDetail::find($data['building']->society_id);
            $data['tenant'] = MasterTenant::where('building_id',$data['building']->id)->where('id',$request->tenant_id)->first();

            $data['serviceChargesRate'] = ServiceChargesRate::selectRaw('Sum(water_charges) as water_charges,sum(electric_city_charge) as electric_city_charge,sum(pump_man_and_repair_charges) as  pump_man_and_repair_charges,sum(external_expender_charge) as external_expender_charge,sum(administrative_charge) as administrative_charge, sum(lease_rent) as lease_rent,sum(na_assessment) as na_assessment, sum(other) as other')->where('building_id',$request->building_id)->where('year',date('Y') )->first();

            if(!$data['serviceChargesRate']){
                //dd($data);
                return redirect()->back()->with('warning', 'Service charge Rates Not added into system.');
            }

            $data['arreasCalculation'] = ArrearCalculation::where('tenant_id',$request->tenant_id)->where('payment_status','0')->get();

            $data['month'] = date('m');
            $data['year'] = date('Y');
            $data['consumer_number'] = substr(sprintf('%08d', $data['building']->id),0,8).'|'.substr(sprintf('%08d', $data['tenant']->id),0,8);

            $data['check'] = TransBillGenerate::where('tenant_id', '=', $request->tenant_id)
                                    ->where('bill_month', '=', $data['month'])
                                    ->where('bill_year', '=', $data['year'])
                                    ->first();
            $data['regenate'] = false;                    
            if($request->has('regenate') && true == $request->regenate) {
                $data['regenate'] = true;
            }
            return view('admin.em_department.generate_tenant_bill',$data);
        }
    }

    public function create_tenant_bill(Request $request){

            if($request->arrear_id && (count($request->arrear_id) > 0)){
                $arrear_id = implode(",",$request->arrear_id);
                //dd($arrear_id);
            } else {
                $arrear_id = '';
            }
            $check = '';
            if($request->has('regenate')&& false == $request->regenate) {

                $check = TransBillGenerate::where('tenant_id', '=', $request->tenant_id)
                                    ->where('bill_month', '=', $request->bill_month)
                                    ->where('bill_year', '=', $request->bill_year)
                                    ->first();
            }

        if(is_null($check) || $check == ''){
            $bill = new TransBillGenerate;
            $bill->tenant_id = $request->tenant_id;
            $bill->building_id = $request->building_id;
            $bill->society_id = $request->society_id;
            $bill->bill_from = $request->bill_from;
            $bill->bill_to = $request->bill_to;
            $bill->bill_month = $request->bill_month;
            $bill->bill_year = $request->bill_year;
            if($request->no_of_tenant)
            {
                $bill->monthly_bill = $request->monthly_bill / $request->no_of_tenant;
            }else {
                $bill->monthly_bill = $request->monthly_bill;
            }
            
            $bill->arrear_bill = $request->arrear_bill;
            $bill->arrear_id = $arrear_id;
            $bill->total_bill = $request->total_bill;
            $bill->bill_date = $request->bill_date;
            $bill->due_date = $request->due_date;
            $bill->consumer_number = $request->consumer_number;
            $bill->total_service_after_due = $request->total_service_after_due;
            $bill->late_fee_charge = $request->late_fee_charge;
            $bill->status = 'Generated';
            $bill->save();

            return redirect()->back()->with('success', 'Bill Generated Successfully.')->with('regenate',false);
        } else {
            $message = ' Bill Already Generated on '.$check->bill_date; 
            return redirect()->back()->with('warning', $message);
        }
    }

    public function create_society_bill(Request $request){
        $check = '';
        if($request->has('regenate')&& false == $request->regenate) {
        $check = TransBillGenerate::where('building_id', '=', $request->building_id)
            ->where('society_id', '=', $request->society_id)
            ->where('bill_month', '=', $request->bill_month)
            ->where('bill_year', '=', $request->bill_year)
            ->first();
        }

        if(is_null($check) || $check == ''){

            $tenants = MasterTenant::where('building_id',$request->building_id)->get();
            $request->monthly_bill = $request->monthly_bill / $request->no_of_tenant;
            if($tenants){
                foreach($tenants as $row => $key){

                    $consumer_number = 'BL-'.substr(sprintf('%08d', $request->building_id),0,8).'|'.substr(sprintf('%08d', $key->id),0,8);
                    $arreasCalculation = ArrearCalculation::where('tenant_id',$key->id)->where('payment_status','0')->get();
                    $arrear_bill = 0;
                    $total_bill = 0;
                    $arrear_id = '';
                    if(!$arreasCalculation->isEmpty()){ 
                      foreach($arreasCalculation as $calculation){
                         $arrear_bill = $arrear_bill + $calculation->total_amount;
                         $arrearID[] = $calculation->id; 
                      }
                      $arrear_id = implode(",",$arrearID);                      
                    }  

                    $total_bill  = $request->monthly_bill + $arrear_bill;
                    $total_after_due = $total_bill * 0.02; 
                    $total_service_after_due = $total_bill + $total_after_due; 

                        $data =  [
                                    'tenant_id'  => $key->id,
                                    'building_id'    => $key->building_id,
                                    'society_id'     => $request->society_id,
                                    'bill_from'    => $request->bill_from,
                                    'bill_to'    => $request->bill_to,
                                    'bill_month' => $request->bill_month,
                                    'bill_year' => $request->bill_year,
                                    'monthly_bill' => $request->monthly_bill,
                                    'arrear_bill' => $arrear_bill,
                                    'arrear_id' => $arrear_id,
                                    'total_bill' => $total_bill,
                                    'bill_date' => $request->bill_date,
                                    'due_date' => $request->due_date,
                                    'consumer_number' => $consumer_number,
                                    'total_service_after_due' => $total_service_after_due,
                                    'late_fee_charge' => $total_after_due,
                                    'status' => 'Generated',
                                ];
                        $bill[] = TransBillGenerate::insertGetId($data);
                }
                
               if(isset($bill)){
                    $ids = implode(",",$bill);
                    $association = DB::table('building_tenant_bill_association')->insert(['building_id' => $request->building_id, 'bill_id' => $ids, 'bill_month' => $request->bill_month, 'bill_year' => $request->bill_year]);
                } else { 
                                   
                }     
                //dd($bill);
                $request->regenate = false;
                return redirect()->back()->with('success', 'Bill Generated Successfully.');                   
            } else {
                return redirect()->back()->with('success', 'Check bill details once.');    
            }
            
        } else {
            $message = ' Bill Already Generated on '.$check->bill_date; 
            return redirect()->back()->with('warning', $message);
        }
    }

     public function get_building_select_updated(Request $request){
    
        if($request->input('id')){
            $society = SocietyDetail::find($request->input('id'));
            if(Config::get('commanConfig.SOCIETY_LEVEL_BILLING') == $society->society_bill_level) {
                $html ='<div class="col-md-12" style="margin-top:10px;margin-bottom: 10px;">
                    <div class="row align-items-center mb-0">                            
                            <div class="col-md-12">
                                <div class="form-group m-form__group ">
                                    Billing Level : Society Level Biiling
                                </div>
                            </div>                          
                    </div>
                </div>';
            $society_id = $request->input('id');
            $buildings = MasterBuilding::with(['TransBillGenerate'=>function($query) use($society_id){
                $query->where('society_id', '=', $society_id)->where('bill_month', '=', date('m'))->where('bill_year', '=', date('Y'));
            }])->with('tenant_count')->where('society_id', '=', $request->input('id'))
                        ->get();
            // return $buildings;

            $html .= view('admin.em_department.ajax_building_bill_generation', compact('buildings', 'society_id'))->render();
            return $html;

            } else {
                
                $building = MasterBuilding::where('society_id', '=', $request->input('id'))->get();
                $html = '<div class="col-md-12" style="margin-top:10px;margin-bottom: 10px;">
                    <div class="row align-items-center mb-0">                            
                            <div class="col-md-12">
                                <div class="form-group m-form__group ">
                                    Billing Level : Tenant Level Biiling
                                </div>
                            </div>                          
                    </div>
                </div>
                <div class="col-md-12" style="margin-top:10px;margin-bottom: 10px;">
                    <div class="row align-items-center mb-0">                            
                            <div class="col-md-4">
                                <div class="form-group m-form__group">
                <select class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input" id="building" name="building">';
                $html .= '<option value="" style="font-weight: normal;">Select Building</option>';

                    foreach($building as $key => $value){
                        $html .= '<option value="'.$value->id.'">'.$value->name.'</option>';
                    }   
                $html .= '</select></div>
                            </div>                          
                    </div>
                </div>';         

                return $html;
            }
        }
    }
}
