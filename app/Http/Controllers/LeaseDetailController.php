<?php

namespace App\Http\Controllers;

use App\Http\Requests\lease_detail\LeaseDetailRequest;
use App\LeaseDetail;
use App\SocietyDetail;
use App\MasterMonth;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Config;
use DB;
use Excel;

class LeaseDetailController extends Controller
{
    public $header_data = array(
        'menu' => 'Lease Detail',
        'menu_url' => 'lease_detail',
        'page' => '',
        'side_menu' => 'lease_detail'
    );

    protected $list_num_of_records_per_page;

    public function __construct()
    {
        $this->list_num_of_records_per_page = Config::get('commanConfig.list_num_of_records_per_page');
    }

    public function print_data(Request $request,$id)
    {
        $lease_data = LeaseDetail::with(['lease_rent_start_month_rel', 'month_rent_per_renewed_lease_rel'])->where(['lm_lease_detail.society_id' => $id])
            ->join('lm_society_detail','lm_lease_detail.society_id','=','lm_society_detail.id')->selectRaw(DB::raw('lm_lease_detail.id as id, lm_lease_detail.lease_rule_16_other,lm_lease_detail.lease_basis,lm_lease_detail.area,lm_lease_detail.lease_period,lm_lease_detail.lease_start_date,lm_lease_detail.lease_rent,lm_lease_detail.lease_rent_start_month,lm_lease_detail.interest_per_lease_agreement,lm_lease_detail.interest_per_lease_agreement,lm_lease_detail.lease_renewal_date,lm_lease_detail.lease_renewed_period,lm_lease_detail.rent_per_renewed_lease,lm_lease_detail.interest_per_renewed_lease_agreement,lm_lease_detail.month_rent_per_renewed_lease,lm_lease_detail.payment_detail,lm_lease_detail.lease_status,lm_society_detail.society_name'));
            $dataLists=$lease_data->orderBy('lm_lease_detail.created_at','desc')->get();
            // dd($dataLists);
            if(count($dataLists) == 0){
                $dataListMaster = [];
                $dataList = [];
                $dataList['id'] = '';
                $dataList['Lease rule 16 & other'] = '';
                $dataList['School/society/ others on lease basis'] = '';
                $dataList['Area'] = '';
                $dataList['Lease Period'] = '';
                $dataList['Start date of lease'] = '';
                $dataList['Land rent / lease rent'] = '';
                $dataList['Month to start collection of lease rent'] = '';
                $dataList['Interest as per Lease agreement, in %'] = '';
                $dataList['Date of Renewal of lease'] = '';
                $dataList['Period of renewed Lease'] = '';
                $dataList['Lease rent as per renewed lease'] = '';
                $dataList['Interest as per renewed Lease agreement, in %'] = '';
                $dataList['Month to start collection of lease rent as per renewed lease'] = '';
                $dataListMaster[]=$dataList;
            }else{
                $i=1;
                foreach ($dataLists as $dataList_key => $dataList_value) {
                    
                    // dd($dataList_value->month_rent_per_renewed_lease_rel->month_name);
                    $dataList = [];
                    $dataList['id'] = $i;
                    $dataList['Lease rule 16 & other'] = $dataList_value['lease_rule_16_other'];
                    $dataList['School/society/ others on lease basis'] = $dataList_value['lease_basis'];
                    $dataList['Area'] = $dataList_value['area'];
                    $dataList['Lease Period'] = $dataList_value['lease_period'];
                    $dataList['Start date of lease'] = $dataList_value['lease_start_date'];
                    $dataList['Land rent / lease rent'] = $dataList_value['lease_rent'];
                    $dataList['Month to start collection of lease rent'] = $dataList_value->lease_rent_start_month_rel->month_name;
                    $dataList['Interest as per Lease agreement, in %'] = $dataList_value['interest_per_lease_agreement'];
                    $dataList['Date of Renewal of lease'] = $dataList_value['lease_renewal_date'];
                    $dataList['Period of renewed Lease'] = $dataList_value['lease_renewed_period'];
                    $dataList['Lease rent as per renewed lease'] = $dataList_value['rent_per_renewed_lease'];
                    $dataList['Interest as per renewed Lease agreement, in %'] = $dataList_value['interest_per_renewed_lease_agreement'];
                    $dataList['Month to start collection of lease rent as per renewed lease'] = $dataList_value->month_rent_per_renewed_lease_rel->month_name;
                    
                    $dataListKeys = array_keys($dataList);
                    $dataListMaster[]=$dataList;
                    $i++;
                }
            }
            
        return view('admin.print_data',compact('dataListMaster', 'dataListKeys')); 
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Datatables $datatables, $id)
    {
        $header_data = $this->header_data;
        $getData = $request->all();

        $count = LeaseDetail::with('leaseSociety')->where(['society_id' => $id, 'lease_status' => 1])->get()->count();
        $columns = [
            ['data' => 'rownum','name' => 'rownum','title' => 'Sr No.','searchable' => false],
            ['data' => 'lease_rule_16_other','name' => 'lease_rule_16_other','title' => 'Lease rule 16 & other'],
            ['data' => 'area','name' => 'area','title' => 'Area'],
            ['data' => 'leaseSociety','name' => 'leaseSociety.society_name','title' => 'Society Name'],
            ['data' => 'lease_period','name' => 'lease_period','title' => 'Lease Period'],
            ['data' => 'lease_start_date', 'name' => 'lease_start_date', 'title' => 'Lease Start Date'],
           ['data' => 'actions','name' => 'actions','title' => 'Actions','searchable' => false,'orderable'=>false],
        ];


        if($request->excel)
        {
            $lease_data = LeaseDetail::where(['society_id' => $id])
            ->join('lm_society_detail','lm_lease_detail.society_id','=','lm_society_detail.id')->selectRaw(DB::raw('lm_lease_detail.id as id, lm_lease_detail.lease_rule_16_other,lm_lease_detail.lease_basis,lm_lease_detail.area,lm_lease_detail.lease_period,lm_lease_detail.lease_start_date,lm_lease_detail.lease_rent,lm_lease_detail.lease_rent_start_month,lm_lease_detail.interest_per_lease_agreement,lm_lease_detail.interest_per_lease_agreement,lm_lease_detail.lease_renewal_date,lm_lease_detail.lease_renewed_period,lm_lease_detail.rent_per_renewed_lease,lm_lease_detail.interest_per_renewed_lease_agreement,lm_lease_detail.month_rent_per_renewed_lease,lm_lease_detail.payment_detail,lm_lease_detail.lease_status,lm_society_detail.society_name'));
            $dataLists=$lease_data->orderBy('lm_lease_detail.created_at','desc')->get();
            if(count($dataLists) == 0){
                $dataListMaster = [];
                $dataList = [];
                $dataList['id'] = '';
                $dataList['Lease rule 16 & other'] = '';
                $dataList['School/society/ others on lease basis'] = '';
                $dataList['Area'] = '';
                $dataList['Lease Period'] = '';
                $dataList['Start date of lease'] = '';
                $dataList['Land rent / lease rent'] = '';
                $dataList['Month to start collection of lease rent'] = '';
                $dataList['Interest as per Lease agreement, in %'] = '';
                $dataList['Date of Renewal of lease'] = '';
                $dataList['Period of renewed Lease'] = '';
                $dataList['Lease rent as per renewed lease'] = '';
                $dataList['Interest as per renewed Lease agreement, in %'] = '';
                $dataList['Month to start collection of lease rent as per renewed lease'] = '';
                $dataListMaster[]=$dataList;
            }else{
                $i=1;
                foreach ($dataLists as $dataList_key => $dataList_value) {
                    
                    // dd($dataList_key);
                    $dataList = [];
                    $dataList['id'] = $i;
                    $dataList['Lease rule 16 & other'] = $dataList_value['lease_rule_16_other'];
                    $dataList['School/society/ others on lease basis'] = $dataList_value['lease_basis'];
                    $dataList['Area'] = $dataList_value['area'];
                    $dataList['Lease Period'] = $dataList_value['lease_period'];
                    $dataList['Start date of lease'] = $dataList_value['lease_start_date'];
                    $dataList['Land rent / lease rent'] = $dataList_value['lease_rent'];
                    $dataList['Month to start collection of lease rent'] = $dataList_value['lease_rent_start_month'];
                    $dataList['Interest as per Lease agreement, in %'] = $dataList_value['interest_per_lease_agreement'];
                    $dataList['Date of Renewal of lease'] = $dataList_value['lease_renewal_date'];
                    $dataList['Period of renewed Lease'] = $dataList_value['lease_renewed_period'];
                    $dataList['Lease rent as per renewed lease'] = $dataList_value['rent_per_renewed_lease'];
                    $dataList['Interest as per renewed Lease agreement, in %'] = $dataList_value['interest_per_renewed_lease_agreement'];
                    $dataList['Month to start collection of lease rent as per renewed lease'] = $dataList_value['month_rent_per_renewed_lease'];
                   $dataListMaster[]=$dataList;
                    $i++;
                }
            // dd($dataListMaster);
            }
            // dd($dataListMaster);
            return Excel::create('lease_detail_'.date('Y_m_d_H_i_s'), function($excel) use($dataListMaster){

                $excel->sheet('mySheet', function($sheet) use($dataListMaster)
                {
                    $sheet->fromArray($dataListMaster);
                });
            })->download('csv');
        }
        if ($datatables->getRequest()->ajax()) {

            DB::statement(DB::raw('set @rownum='. (isset($request->start) ? $request->start : 0) ));

            $lease_data = LeaseDetail::with('leaseSociety')->where(['society_id' => $id])->orderBy('created_at','desc');

            $lease_data = $lease_data->selectRaw( DB::raw('@rownum  := @rownum  + 1 AS rownum').',lease_rule_16_other, lm_lease_detail.id as id, lm_lease_detail.area as area, society_id, lease_period, lease_start_date, lease_status');

            return $datatables->of($lease_data)
                ->editColumn('rownum', function ($lease_data) {
                        static $i = 0;
                        $i++;
                        return $i;
                    })
                ->editColumn('lease_start_date', function ($lease_data) {
                    return date(config('commanConfig.dateFormat'), strtotime($lease_data->lease_start_date));
                })
                ->editColumn('leaseSociety', function ($lease_data) {
                    return $lease_data->leaseSociety->society_name;
                })
                ->editColumn('actions', function ($lease_data) {
                    return view('admin.lease_detail.actions', compact('lease_data'))->render();
                })
                ->rawColumns(['lease_start_date', 'leaseSociety', 'actions'])
                ->make(true);
        }

        $html = $datatables->getHtmlBuilder()->columns($columns)->parameters($this->getParameters());

        return view('admin.lease_detail.index', compact('html','header_data','getData', 'count', 'id', 'village_id'));
    }

    protected function getParameters() {
        return [
            'serverSide' => true,
            'processing' => true,
            'ordering'   =>'isSorted',
            "order"=> [5, "desc" ],
            "pageLength" => $this->list_num_of_records_per_page
        ];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $header_data = $this->header_data;
        $arrData['month_data'] = MasterMonth::all();

        return view('admin.lease_detail.create', compact('header_data', 'arrData', 'id', 'village_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LeaseDetailRequest $request)
    {
        $lease_detail = [
            'lease_rule_16_other' => $request->lease_rule_other,
            'lease_basis' => $request->lease_basis,
            'area' => $request->area,
            'lease_period' => $request->lease_period,
            'lease_start_date' => $request->lease_start_date,
            'lease_rent' => $request->lease_rent,
            'lease_rent_start_month' => $request->lease_rent_start_month,
            'interest_per_lease_agreement' => $request->interest_per_lease_agreement,
            'lease_renewal_date' => $request->lease_renewal_date,
            'lease_renewed_period' => $request->lease_renewed_period,
            'rent_per_renewed_lease' => $request->rent_per_renewed_lease,
            'interest_per_renewed_lease_agreement' => $request->interest_per_renewed_lease_agreement,
            'month_rent_per_renewed_lease' => $request->month_rent_per_renewed_lease,
            'society_id' => $request->society_id,
            'lease_status' => 1
        ];

        LeaseDetail::create($lease_detail);

        return redirect('/lease_detail/'.$request->society_id)->with(['success'=> 'Lease added succesfully']);
    }

    public function renewLease($id)
    {
        $header_data = $this->header_data;
        $arrData['month_data'] = MasterMonth::all();
        $arrData['lease_data'] = LeaseDetail::where(['society_id' => $id, 'lease_status' => 1])->first();
        
        return view('admin.lease_detail.renew-lease', compact('header_data', 'arrData', 'id', 'village_id'));
    }

    public function updateLease(LeaseDetailRequest $request, $id)
    {
        $lease_data = LeaseDetail::where('society_id', $id)->update(['lease_status' => 0]);

        $lease_detail = [
            'lease_rule_16_other' => $request->lease_rule_other,
            'lease_basis' => $request->lease_basis,
            'area' => $request->area,
            'lease_period' => $request->lease_period,
            'lease_start_date' => $request->lease_start_date,
            'lease_rent' => $request->lease_rent,
            'lease_rent_start_month' => $request->lease_rent_start_month,
            'interest_per_lease_agreement' => $request->interest_per_lease_agreement,
            'lease_renewal_date' => $request->lease_renewal_date,
            'lease_renewed_period' => $request->lease_renewed_period,
            'rent_per_renewed_lease' => $request->rent_per_renewed_lease,
            'interest_per_renewed_lease_agreement' => $request->interest_per_renewed_lease_agreement,
            'month_rent_per_renewed_lease' => $request->month_rent_per_renewed_lease,
            'society_id' => $request->society_id,
            'lease_status' => 1
        ];

        LeaseDetail::create($lease_detail);

        return redirect('/lease_detail/'.$request->society_id.'/'.$request->village_id)->with(['success'=> 'Lease renewed succesfully']);
    }

    public function showLatestLease($id, $society_id){
        $header_data = $this->header_data;
        $arrData['month_data'] = MasterMonth::all();
        $arrData['lease_data'] = LeaseDetail::where(['id' => $id,'society_id' => $society_id, 'lease_status' => 1])->first();
        // dd($arrData['lease_data']);
        $village = SocietyDetail::where('id', $society_id)->first();
        $village_id = $village->village_id;
        // dd($society_id);
        return view('admin.lease_detail.edit-lease', compact('header_data', 'arrData', 'id', 'society_id', 'village_id'));
    }

    public function updateLatestLease(Request $request, $id){
        $lease_data = LeaseDetail::where('id', $id)->first();
        $lease_detail = [
            'lease_rule_16_other' => $request->lease_rule_other,
            'lease_basis' => $request->lease_basis,
            'area' => $request->area,
            'lease_period' => $request->lease_period,
            'lease_start_date' => $request->lease_start_date,
            'lease_rent' => $request->lease_rent,
            'lease_rent_start_month' => $request->lease_rent_start_month,
            'interest_per_lease_agreement' => $request->interest_per_lease_agreement,
            'lease_renewal_date' => $request->lease_renewal_date,
            'lease_renewed_period' => $request->lease_renewed_period,
            'rent_per_renewed_lease' => $request->rent_per_renewed_lease,
            'interest_per_renewed_lease_agreement' => $request->interest_per_renewed_lease_agreement,
            'month_rent_per_renewed_lease' => $request->month_rent_per_renewed_lease,
            'lease_status' => 1
        ];

        LeaseDetail::where('id', $id)->update($lease_detail);
        // $village_id = SocietyDetail::where('id', $lease_data->society_id)->first();
        return redirect('/lease_detail/'.$request->society_id.'/'.$request->village_id)->with(['success'=> 'Lease updated succesfully']);
    }

    public function viewLease($id, $society_id){
        $header_data = $this->header_data;
        $arrData['month_data'] = MasterMonth::all();
        $arrData['lease_data'] = LeaseDetail::where(['id' => $id,'society_id' => $society_id])->first();
         //dd($arrData['lease_data']);
        $village = SocietyDetail::where('id', $society_id)->first();
        $village_id = $village->village_id;
        return view('admin.lease_detail.view-lease', compact('header_data', 'arrData', 'id', 'society_id', 'village_id'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
