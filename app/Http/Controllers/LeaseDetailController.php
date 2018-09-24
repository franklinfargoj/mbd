<?php

namespace App\Http\Controllers;

use App\Http\Requests\lease_detail\LeaseDetailRequest;
use App\LeaseDetail;
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
        $lease_data = LeaseDetail::where(['lm_lease_detail.society_id' => $id])
            ->join('lm_society_detail','lm_lease_detail.society_id','=','lm_society_detail.id')->selectRaw(DB::raw('lm_lease_detail.id as id, lm_lease_detail.lease_rule_16_other,lm_lease_detail.lease_basis,lm_lease_detail.area,lm_lease_detail.lease_period,lm_lease_detail.lease_start_date,lm_lease_detail.lease_rent,lm_lease_detail.lease_rent_start_month,lm_lease_detail.interest_per_lease_agreement,lm_lease_detail.interest_per_lease_agreement,lm_lease_detail.lease_renewal_date,lm_lease_detail.lease_renewed_period,lm_lease_detail.rent_per_renewed_lease,lm_lease_detail.interest_per_renewed_lease_agreement,lm_lease_detail.month_rent_per_renewed_lease,lm_lease_detail.payment_detail,lm_lease_detail.lease_status,lm_society_detail.society_name'));
            $lease_data=$lease_data->orderBy('lm_lease_detail.created_at','desc')->get();
        return view('admin.lease_detail.print_data',compact('lease_data')); 
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Datatables $datatables, $id, $village_id)
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
//            ['data' => 'actions','name' => 'actions','title' => 'Actions','searchable' => false,'orderable'=>false],
        ];


        if($request->excel)
        {
            $lease_data = LeaseDetail::where(['society_id' => $id])
            ->join('lm_society_detail','lm_lease_detail.society_id','=','lm_society_detail.id')->selectRaw(DB::raw('lm_lease_detail.id as id, lm_lease_detail.lease_rule_16_other,lm_lease_detail.lease_basis,lm_lease_detail.area,lm_lease_detail.lease_period,lm_lease_detail.lease_start_date,lm_lease_detail.lease_rent,lm_lease_detail.lease_rent_start_month,lm_lease_detail.interest_per_lease_agreement,lm_lease_detail.interest_per_lease_agreement,lm_lease_detail.lease_renewal_date,lm_lease_detail.lease_renewed_period,lm_lease_detail.rent_per_renewed_lease,lm_lease_detail.interest_per_renewed_lease_agreement,lm_lease_detail.month_rent_per_renewed_lease,lm_lease_detail.payment_detail,lm_lease_detail.lease_status,lm_society_detail.society_name'));
            $dataList=$lease_data->orderBy('lm_lease_detail.created_at','desc')->get();
            
            return Excel::create('lease_detail_'.date('Y_m_d_H_i_s'), function($excel) use($dataList){

                $excel->sheet('mySheet', function($sheet) use($dataList)
                {
                    $sheet->fromArray($dataList);
                });
            })->download('csv');
        }
        if ($datatables->getRequest()->ajax()) {

            DB::statement(DB::raw('set @rownum='. (isset($request->start) ? $request->start : 0) ));

            $lease_data = LeaseDetail::with('leaseSociety')->where(['society_id' => $id])->orderBy('created_at','desc');

            $lease_data = $lease_data->selectRaw( DB::raw('@rownum  := @rownum  + 1 AS rownum').',lease_rule_16_other, lm_lease_detail.id as id, lm_lease_detail.area as area, society_id, lease_period, lease_start_date');

            return $datatables->of($lease_data)
                ->editColumn('lease_start_date', function ($lease_data) {
                    return date(config('commanConfig.dateFormat'), strtotime($lease_data->lease_start_date));
                })
                ->editColumn('leaseSociety', function ($lease_data) {
                    return $lease_data->leaseSociety->society_name;
                })
                ->rawColumns(['leaseSociety'])
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
    public function create($id, $village_id)
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

        return redirect('/lease_detail/'.$request->society_id.'/'.$request->village_id)->with(['success'=> 'Lease added succesfully']);
    }

    public function renewLease($id, $village_id)
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
