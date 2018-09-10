<?php

namespace App\Http\Controllers;

use App\Http\Requests\society_detail\SocietyDetailRequest;
use App\OtherLand;
use App\SocietyDetail;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Config;
use DB;

class SocietyController extends Controller
{
    public $header_data = array(
        'menu' => 'Society Detail',
        'menu_url' => 'society_detail',
        'page' => '',
        'side_menu' => 'society_detail'
    );

    protected $list_num_of_records_per_page;

    public function __construct()
    {
        $this->list_num_of_records_per_page = Config::get('commanConfig.list_num_of_records_per_page');
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

        $columns = [
            ['data' => 'rownum','name' => 'rownum','title' => 'Sr No.','searchable' => false],
            ['data' => 'society_name','name' => 'society_name','title' => 'Society Name'],
            ['data' => 'societyVillage','name' => 'societyVillage.village_name','title' => 'Village Name'],
            ['data' => 'survey_number','name' => 'survey_number','title' => 'Survey Number'],
            ['data' => 'society_address','name' => 'society_address','title' => 'Society Address'],
            ['data' => 'surplus_charges', 'name' => 'surplus_charges', 'title' => 'Surplus Charges'],
//            ['data' => 'actions','name' => 'actions','title' => 'Actions','searchable' => false,'orderable'=>false],
        ];

        if ($datatables->getRequest()->ajax()) {

            DB::statement(DB::raw('set @rownum='. (isset($request->start) ? $request->start : 0) ));

            $society_data = SocietyDetail::with('societyVillage')->where('village_id', $id);

//            if($request->office_date_from)
//            {
//                $hearing_data = $hearing_data->whereDate('office_date', '>=', date('Y-m-d', strtotime($request->office_date_from)));
//            }
//
//            if($request->office_date_to)
//            {
//                $hearing_data = $hearing_data->whereDate('office_date', '<=', date('Y-m-d', strtotime($request->office_date_to)));
//            }

            $society_data = $society_data->selectRaw( DB::raw('@rownum  := @rownum  + 1 AS rownum').',society_name, society_detail.id as id, village_id, survey_number, society_address, surplus_charges');

            return $datatables->of($society_data)
                ->editColumn('societyVillage', function ($society_data) {
                    return $society_data->societyVillage->village_name;
                })
                ->editColumn('society_name', function ($society_data) {
                    return "<a href='".route('lease_detail.index', $society_data->id)."'>$society_data->society_name</a>";
                })
                ->rawColumns(['societyVillage', 'society_name'])
                ->make(true);
        }

        $html = $datatables->getHtmlBuilder()->columns($columns)->parameters($this->getParameters());

        return view('admin.society_detail.index', compact('html','header_data','getData', 'id'));
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
        $arrData['other_land'] = OtherLand::where('status', 1)->get();

        return view('admin.society_detail.create', compact('header_data', 'arrData', 'id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SocietyDetailRequest $request)
    {
        $society_data = [
            'society_name' => $request->society_name,
            'district' => $request->district,
            'taluka' => $request->taluka,
            'survey_number' => $request->survey_number,
            'cts_number' => $request->cts_number,
            'chairman' => $request->chairman,
            'society_address' => $request->society_address,
            'area' => $request->area,
            'date_on_service_tax' => $request->date_on_service_tax,
            'surplus_charges' => $request->surplus_charges,
            'surplus_charges_last_date' => $request->surplus_charges_last_date,
            'village_id' => $request->village_id,
            'other_land_id' => $request->other_land_id
        ];

        SocietyDetail::create($society_data);

        return redirect('/society_detail/'.$request->village_id)->with(['success'=> 'Society added succesfully']);
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
