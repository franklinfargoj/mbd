<?php

namespace App\Http\Controllers\AccountDepartment;
use App\Http\Controllers\Common\CommonController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use Config,Auth,Validator,Excel;
use DB;
use File;
use Storage;
use App\MasterLayout;
use App\LayoutUser;
use App\MasterWard;
use App\MasterColony;
use App\MasterBuilding;
use App\MasterTenant;
use App\SocietyDetail;
use App\ServiceChargesRate;
use App\ArrearsChargesRate;
use App\ArrearCalculation;
use App\TransBillGenerate;
use App\TransPayment;

class AccountController extends Controller
{
    public function __construct()
    {
        $this->comman = new CommonController();
        $this->list_num_of_records_per_page = Config::get('commanConfig.list_num_of_records_per_page');
        $this->PAYMENT_STATUS_NOT_PAID = Config::get('commanConfig.PAYMENT_STATUS_NOT_PAID');
        $this->PAYMENT_STATUS_PAID = Config::get('commanConfig.PAYMENT_STATUS_PAID');
    }

    public function index(Request $request, Datatables $datatables) {
    	$data['layout_data'] = MasterLayout::get();
        
    	return view('admin.account_department.index',$data);	
    }

    public function getBuildingSelectSociety(Request $request) {
    	$html ='';
    	if($request->id){
    		$society = SocietyDetail::find(decrypt($request->id));
    		$building = MasterBuilding::where('society_id', '=', decrypt($request->id))->get();

    		$html = '<select class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input" id="buidling" name="building_id" required><option value="" style="font-weight: normal;">Select Buidling</option>';

            foreach($building as $key => $value){
                $html .= '<option value="'.encrypt($value->id).'">'.$value->name.'</option>';
            }   

            $html .= '</select>';         
    	}
        return $html;
    }

    public function getSocietySelectLayout(Request $request) {
    	$html ='';
    	if($request->has('id')&&!empty($request->id)) {
    		$layout = MasterLayout::find(decrypt($request->id));
	        $wards = MasterWard::where('layout_id', decrypt($request->id))->pluck('id');
	      	$colonies = MasterColony::whereIn('ward_id', $wards)->pluck('id');
	      	$societies = SocietyDetail::whereIn('colony_id', $colonies)->paginate(10);
	      	$societies_data = SocietyDetail::where('society_bill_level', '=', '2')->whereIn('colony_id', $colonies)->get();

	      	$html = '<select class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input" id="society" name="society_id" required><option value="" style="font-weight: normal;">Select Society</option>';

            foreach($societies_data as $key => $value){
                $html .= '<option value="'.encrypt($value->id).'">'.$value->society_name.'</option>';
            }   

            $html .= '</select>';
    	}
    	return $html;
    }

    public function search(Request $request, Datatables $datatables) {
    	$rules = [
    		'layout_id' => 'required',
    		'society_id' => 'required',
            'building_id' => 'required',
    	];
    	$messages = [
    		'layout_id.required' => 'Select Layout.',
    		'society_id.required' => 'Select Society.',
    		'building_id.required' => 'Select Buidling.',
    	];
    	$validator = Validator::make($request->all(),$rules,$messages);

    	if ($validator->fails()) {
            return redirect('search_accounts')->withErrors($validator)->withInput();
        }

        $layout_id = decrypt($request->layout_id);
        $society_id = decrypt($request->society_id);
        $building_id = decrypt($request->building_id);

        $columns = [
            ['data' => 'rownum','name' => 'rownum','title' => 'Sr No.','searchable' => false],
            ['data' => 'flat_no','name' => 'flat_no','title' => 'Room No'],
            ['data' => 'tenant_name','name' => 'tenant_name','title' => 'Teanat Name'],
            ['data' => 'total_amount', 'name' => 'total_amount', 'title' => 'Final Rent Amount','searchable'=>false],
            ['data' => 'payment_status','name' => 'payment_status','title' => 'Payment Status'],
            ['data' => 'action','name' => 'action','title' => 'Action','searchable'=>false,'orderable'=> false],
            ['data' => 'payment_details','name' => 'payment_details','title' => 'Payment Details','searchable'=>false],
        ];

        $year = date('Y');
        $month = date('m');
      
        if ($datatables->getRequest()->ajax()) {
        	DB::statement(DB::raw('set @rownum='. (isset($request->start) ? $request->start : 0) ));
            $tenants = MasterTenant::selectRaw('@rownum  := @rownum  + 1 AS rownum,master_tenants.*,CONCAT(first_name," ",last_name) as tenant_name')->with(['arrear' => function($query) use($year,$month){
                $query->select('*');
            	$query->where('year',$year);
            	$query->where('month',$month);
            }])->where('building_id',decrypt($request->building_id));
            
            return $datatables->of($tenants)
	            ->addColumn('payment_status', function ($tenants){               
	               	if(count($tenants->arrear) && $this->PAYMENT_STATUS_PAID == $tenants->arrear->first()->payment_status) {
	               		return 'Paid';
	               	} else {
	               		return 'Not Paid';
	               	}
	            })
	            ->addColumn('total_amount', function ($tenants){               
	               	if(count($tenants->arrear)) {
	               		return $tenants->arrear->first()->total_amount;
	               	} else {
	               		return '-';
	               	}
	            })
	            ->editColumn('action', function ($tenants) use ($year){
	                return "<div class='d-flex btn-icon-list'><a href='".url('view_calculations/'.encrypt($tenants->id).'/'.$year)."' class='d-flex flex-column align-items-center'><span class='btn-icon btn-icon--edit'><img src='".asset('/img/edit-icon.svg')."'></span>View Calculations</a></div>";
	            })
	            ->editColumn('payment_details', function ($tenants){
	                return "<div class='d-flex btn-icon-list'><a href='".url('payment_details/'.encrypt($tenants->id))."' class='d-flex flex-column align-items-center'><span class='btn-icon btn-icon--edit'><img src='".asset('/img/edit-icon.svg')."'></span>Edit</a></div>";
	            })
	            ->rawColumns(['action','payment_status','payment_details','total_amount'])
	            ->make(true);
        }
        $society = SocietyDetail::find(decrypt($request->society_id));

        $html = $datatables->getHtmlBuilder()->columns($columns)->parameters($this->getParameters());

        return view('admin.account_department.tenant_list', compact('html','society'));
    }

    protected function getParameters() {
        return [
            'serverSide' => true,
            'processing' => true,
            'ordering'   =>'isSorted',
            "order"=> [1, "asc" ],
            "pageLength" => $this->list_num_of_records_per_page
        ];
    }

    public function viewCalculations(Request $request,$tenant_id,$year, Datatables $datatables) {
    	$data['tenant_id'] = $tenant_id;
    	$data['year']      = $year;
    	$data['tenant']    = MasterTenant::find(decrypt($tenant_id));
    	$data['building']  = MasterBuilding::find($data['tenant']->building_id);

    	$data['society']   = SocietyDetail::find($data['building']->society_id);
    	$data['colony']    = MasterColony::find($data['society']->colony_id);
    	$data['ward']      = MasterWard::find($data['colony']->ward_id);

    	$data['years']     = [];
    	$data['arrears_charges'] = [];
    	$data['arrears_calculations'] = [];

    	if($request->has('selectYear') && !empty($request->selectYear)) {
    		$data['year'] = $request->selectYear;
    	}

        $columns = [
            ['data' => 'month','name' => 'month','title' => 'Month'],
            ['data' => 'year','name' => 'year','title' => 'Year'],
            ['data' => 'old_rate', 'name' => 'old_rate', 'title' => 'Old Rate'],
            ['data' => 'interest_on_old_rate','name' => 'interest_on_old_rate','title' => 'Interest % on Old Rate'],
			['data' => 'revise_rate','name' => 'revise_rate','title' => 'Revised Rate'],
			['data' => 'interest_on_diffrence','name' => 'interest_on_diffrence','title' => 'Interest % on Difference'],
			['data' => 'payment_status','name' => 'payment_status','title' => 'Payment Status'],
            ['data' => 'total_amount','name' => 'total_amount','title' => 'Final Rent Amount'],
		];

		$arrears_charges = ArrearsChargesRate::where('year',$data['year'])->where('society_id',$data['building']->society_id)->where('building_id',$data['tenant']->building_id)->first();
		$data['years'] = ArrearCalculation::selectRaw('Distinct(year)')->where('tenant_id',decrypt($data['tenant_id']))->pluck('year');
		
    	if(!empty($data['tenant_id']) && !empty($data['year'])) {
			$arrears_calculations = ArrearCalculation::
			where('tenant_id',decrypt($data['tenant_id']))->where('year',$data['year'])
			->get();
			if ($datatables->getRequest()->ajax()) {
				
				return $datatables->of($arrears_calculations)
                    ->editColumn('month', function ($arrears_calculations)  {               
                            return date("M", mktime(0, 0, 0, $arrears_calculations->month, 10));
                        })
					->editColumn('old_rate', function ($arrears_calculations)  use($arrears_charges){ if($arrears_charges){     
						  return $arrears_charges->old_rate;	
                        } else {
                            return '-';
                        }
					})
					->editColumn('interest_on_old_rate', function ($arrears_calculations)  use($arrears_charges){   
                        if($arrears_charges){              
						  return $arrears_charges->interest_on_old_rate;	
					    } else {
                            return '-';
                        }
                    })
					->editColumn('revise_rate', function ($arrears_calculations)  use($arrears_charges){               
						if($arrears_charges){  
                            return $arrears_charges->revise_rate;	
					    } else {
                            return '-';
                        }
                    })
					->editColumn('interest_on_diffrence', function ($arrears_calculations)  use($arrears_charges){ 
                        if($arrears_charges){                
						   return $arrears_charges->interest_on_differance;
                        } else {
                            return '-';
                        }
					})
                    ->editColumn('payment_status', function ($arrears_calculations)  use($arrears_charges){               
                        if( $this->PAYMENT_STATUS_PAID == $arrears_calculations->payment_status) {
                            return 'Paid';
                        } else {
                            return 'Not Paid';
                        }  
                    })
					->rawColumns(['month','old_rate','interest_on_old_rate','revise_rate','interest_on_diffrence'])
					->make(true);
			}
	
			if($request->has('is_download') && true == $request->is_download) {
				$filename = time();
				ob_end_clean();
				ob_start();
				return Excel::create($filename, function($excel) use ($data,$arrears_calculations,$arrears_charges) {
					$excel->setTitle('Initiative');
					$excel->sheet('sheet1', function($sheet) use ($data,$arrears_calculations,$arrears_charges) {
						$sheet->loadView('admin.account_department.excel',compact('data','arrears_calculations','arrears_charges'));
					});
				})->export('xls');
			} else {
				$html = $datatables->getHtmlBuilder()->columns($columns)->parameters($this->getParameters());
				return view('admin.account_department.view_calculations',compact('data','html'));
				//return view('admin.account_department.view_calculations',$data);
			}
		}
    }

    public function paymentDetails(Request $request,$tenant_id, Datatables $datatables) {
    	if(!empty($tenant_id)) {
    		$data['year'] = date('Y');
    		if($request->has('selectYear') && !empty($request->selectYear)) {
	    		$data['year'] = $request->selectYear;
	    	}

    		$data['tenant']    = MasterTenant::find(decrypt($tenant_id));
    		$building  = MasterBuilding::find($data['tenant']->building_id);
	    	$society   = SocietyDetail::find($building->society_id);
	    	$data['colony']    = MasterColony::find($society->colony_id);
	    	$ward      = MasterWard::find($data['colony']->ward_id);
			$columns = [
				['data' => 'bill_month','name' => 'bill_month','title' => 'Month'],
				['data' => 'amount','name' => 'amount','title' => 'Amount'],
				['data' => 'status', 'name' => 'status', 'title' => 'Status'],
				['data' => 'payment_mode','name' => 'payment_mode','title' => 'Payment Mode'],
				['data' => 'created_at','name' => 'created_at','title' => 'Date Of Payment'],
				['data' => 'action','name' => 'action','title' => 'Action','orderable'=> false],
			];
			$data['years'] = ArrearCalculation::selectRaw('Distinct(year)')->where('tenant_id',decrypt($tenant_id))->pluck('year');

			if ($datatables->getRequest()->ajax()) {
				$paymentDetails = TransBillGenerate::where('tenant_id',decrypt($tenant_id))->with('trans_payment')->where('bill_year',$data['year'])->get();

				return $datatables->of($paymentDetails)
					->editColumn('bill_month', function ($paymentDetails)  {               
						return date("M", mktime(0, 0, 0, $paymentDetails->bill_month, 10));
					})
					->editColumn('amount', function ($paymentDetails)  {               
						if(count($paymentDetails->trans_payment)){
							return $paymentDetails->trans_payment->first()->amount_paid;
						} else {
                            return '-';
                        }
					})
					->editColumn('payment_mode', function ($paymentDetails)  {               
						if(count($paymentDetails->trans_payment))
						{
							return $paymentDetails->trans_payment->first()->mode_of_payment;
						} else {
                            return '-';
                        }
					})
					->editColumn('created_at', function ($paymentDetails)  {               
						if(count($paymentDetails->trans_payment))
						{
							return date('d-m-Y',strtotime($paymentDetails->trans_payment->first()->created_at));
						} else {
                            return '-';
                        }
					})
					->editColumn('action', function ($paymentDetails)  use($society,$tenant_id,$building){               
						$data= "<div class='d-flex btn-icon-list'>
								<a href='".route('view_bill_tenant', ['tenant_id'=>$tenant_id,'building_id'=>encrypt($building->id),'society_id'=>encrypt($society->id)])."' class='d-flex flex-column align-items-center ' style='padding-left: 5px; padding-right: 5px; text-decoration: none; color: #212529; font-size:12px;'><span class='btn-icon btn-icon--edit'><img src='".asset('/img/view-billing-details-icon.svg')."'></span>View Bill</a>
                               ";
                        if($paymentDetails->status == "paid") {
                            $data.= " <a href='".route('downloadReceipt', ['tenant_id'=>$tenant_id,'building_id'=>encrypt($building->id),'bill_no'=>encrypt($paymentDetails->id),'flag'=>1])."' class='d-flex flex-column align-items-center ' style='padding-left: 5px; padding-right: 5px; text-decoration: none; color: #212529; font-size:12px;'><span class='btn-icon btn-icon--edit'><img src='".asset('/img/view-billing-details-icon.svg')."'></span>View Receipt</a>
                                </div>";
                        } else {
                            $data.="</div>";
                        }
                        return $data;
					})
					->rawColumns(['bill_month','amount','payment_mode','action'])
					->make(true);
			}
    		// $data['paymentDetails'] = TransPayment::where('tenant_id',decrypt($tenant_id))->with('bill_details')->get();
    		
    		$html = $datatables->getHtmlBuilder()->columns($columns)->parameters($this->getParameters());
    		
    		return view('admin.account_department.payment_details',compact('html','data','ward','society','building'));
    	}
    }

    public function viewBill(Request $request) {

    	if($request->has('building_id') && '' != $request->building_id && $request->has('tenant_id') && '' != $request->tenant_id) {
            $request->building_id = decrypt($request->building_id);
            $request->tenant_id  = decrypt($request->tenant_id);

            $data['building'] = MasterBuilding::find($request->building_id);
            $data['society'] = SocietyDetail::find($data['building']->society_id);
            $data['tenant'] = MasterTenant::where('building_id',$data['building']->id)->where('id',$request->tenant_id)->first();

            $data['serviceChargesRate'] = ServiceChargesRate::selectRaw('Sum(water_charges) as water_charges,sum(electric_city_charge) as electric_city_charge,sum(pump_man_and_repair_charges) as  pump_man_and_repair_charges,sum(external_expender_charge) as external_expender_charge,sum(administrative_charge) as administrative_charge, sum(lease_rent) as lease_rent,sum(na_assessment) as na_assessment, sum(other) as other')->where('building_id',$request->building_id)->where('year',date('Y') . '-' . (date('y') + 1))->first();

            if(!$data['serviceChargesRate']){
                //dd($data);
                return redirect()->back()->with('warning', 'Service charge Rates Not added into system.');
            }

            $data['arreasCalculation'] = ArrearCalculation::where('tenant_id',$request->tenant_id)->where('payment_status','0')->get();

            $data['month'] = date('m');
            $data['year'] = date('Y') . '-' . (date('y') + 1);
            $data['consumer_number'] = substr(sprintf('%08d', $data['building']->id),0,8).'|'.substr(sprintf('%08d', $data['tenant']->id),0,8);

            return view('admin.em_department.generate_tenant_bill',$data);
        }
    }
}
