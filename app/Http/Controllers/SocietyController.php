<?php

namespace App\Http\Controllers;

use App\Http\Requests\society_detail\SocietyDetailRequest;
use App\OtherLand;
use App\SocietyDetail;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Config;
use DB;
use Excel;

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


    public function print_data($id)
    {
        $society_data = SocietyDetail::with('societyVillage')
            ->join('lm_village_detail', 'lm_village_detail.id', '=', 'lm_society_detail.village_id')
            ->join('other_land','lm_society_detail.other_land_id', '=', 'other_land.id')
            ->where('village_id', $id);
            $society_data = $society_data->selectRaw( DB::raw('lm_society_detail.society_name,lm_society_detail.district,lm_society_detail.taluka,lm_society_detail.village,lm_society_detail.survey_number,lm_society_detail.cts_number,lm_society_detail.chairman,lm_society_detail.society_address,lm_society_detail.area,lm_society_detail.date_on_service_tax,lm_society_detail.surplus_charges,lm_society_detail.surplus_charges_last_date,lm_village_detail.village_name,other_land.land_name'))->get();
            //dd($society_data);
            if(count($society_data) == 0){
                $dataListMaster = [];
                $dataList = [];
                $dataList['id'] = '';
                $dataList['Society Name'] = '';
                $dataList['District'] = '';
                $dataList['Taluka'] = '';
                $dataList['Survey Number'] = '';
                $dataList['CTS Number'] = '';
                $dataList['Chairman'] = '';
                $dataList['Society Address'] = '';
                $dataList['Area'] = '';
                $dataList['Date mentioned on service tax letters'] = '';
                $dataList['Surplus Charges'] = '';
                $dataList['Lease rent as per renewed lease'] = '';
                $dataList['Last date of paying surplus charges'] = '';
                $dataList['Land Name'] = '';
                $dataListMaster[]=$dataList;
            }else{
                foreach ($society_data as $dataList_key => $dataList_value) {
                    $i=1;
                    $dataList = [];
                    $dataList['id'] = $i;
                    $dataList['Society Name'] = $dataList_value['society_name'];
                    $dataList['District'] = $dataList_value['district'];
                    $dataList['Taluka'] = $dataList_value['taluka'];
                    $dataList['Village'] = $dataList_value['village'];
                    $dataList['Survey Number'] = $dataList_value['survey_number'];
                    $dataList['CTS Number'] = $dataList_value['cts_number'];
                    $dataList['Chairman'] = $dataList_value['chairman'];
                    $dataList['Society Address'] = $dataList_value['society_address'];
                    $dataList['Area'] = $dataList_value['area'];
                    $dataList['Date mentioned on service tax letters'] = $dataList_value['date_on_service_tax'];
                    $dataList['Surplus Charges'] = $dataList_value['surplus_charges'];
                    $dataList['Lease rent as per renewed lease'] = $dataList_value['surplus_charges_last_date'];
                    $dataList['Last date of paying surplus charges'] = $dataList_value['village_name'];
                    $dataList['Land Name'] = $dataList_value['land_name'];
                    
                    $dataListKeys = array_keys($dataList);
                    $dataListMaster[]=$dataList;
                    $i++;
                }
            }
            return view('admin.society_detail.print_data',compact('dataListMaster', 'dataListKeys')); 
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
            ['data' => 'actions','name' => 'actions','title' => 'Actions','searchable' => false,'orderable'=>false],
        ];
        if($request->excel)
        {
            $society_data = SocietyDetail::join('lm_village_detail', 'lm_village_detail.id', '=', 'lm_society_detail.village_id')
            ->join('other_land','lm_society_detail.other_land_id', '=', 'other_land.id')
            ->where('village_id', $id);
            $society_data = $society_data->selectRaw( DB::raw('lm_society_detail.id,lm_society_detail.society_name,lm_society_detail.district,lm_society_detail.taluka,lm_society_detail.village,lm_society_detail.survey_number,lm_society_detail.cts_number,lm_society_detail.chairman,lm_society_detail.society_address,lm_society_detail.area,lm_society_detail.date_on_service_tax,lm_society_detail.surplus_charges,lm_society_detail.surplus_charges_last_date,lm_village_detail.village_name,other_land.land_name'))->get();
            if(count($society_data) == 0){
                $dataListMaster = [];
                $dataList = [];
                $dataList['id'] = '';
                $dataList['Society Name'] = '';
                $dataList['District'] = '';
                $dataList['Taluka'] = '';
                $dataList['Survey Number'] = '';
                $dataList['CTS Number'] = '';
                $dataList['Chairman'] = '';
                $dataList['Society Address'] = '';
                $dataList['Area'] = '';
                $dataList['Date mentioned on service tax letters'] = '';
                $dataList['Surplus Charges'] = '';
                $dataList['Lease rent as per renewed lease'] = '';
                $dataList['Last date of paying surplus charges'] = '';
                $dataList['Land Name'] = '';
                $dataListMaster[]=$dataList;
            }else{
                foreach ($society_data as $dataList_key => $dataList_value) {
                    $i=1;
                    $dataList = [];
                    $dataList['id'] = $i;
                    $dataList['Society Name'] = $dataList_value['society_name'];
                    $dataList['District'] = $dataList_value['district'];
                    $dataList['Taluka'] = $dataList_value['taluka'];
                    $dataList['Village'] = $dataList_value['village'];
                    $dataList['Survey Number'] = $dataList_value['survey_number'];
                    $dataList['CTS Number'] = $dataList_value['cts_number'];
                    $dataList['Chairman'] = $dataList_value['chairman'];
                    $dataList['Society Address'] = $dataList_value['society_address'];
                    $dataList['Area'] = $dataList_value['area'];
                    $dataList['Date mentioned on service tax letters'] = $dataList_value['date_on_service_tax'];
                    $dataList['Surplus Charges'] = $dataList_value['surplus_charges'];
                    $dataList['Lease rent as per renewed lease'] = $dataList_value['surplus_charges_last_date'];
                    $dataList['Last date of paying surplus charges'] = $dataList_value['village_name'];
                    $dataList['Land Name'] = $dataList_value['land_name'];
                    
                    $dataListKeys = array_keys($dataList);
                    $dataListMaster[]=$dataList;
                    $i++;
                }
            }
            // dd($dataListMaster);
            return Excel::create('society_details_'.date('Y_m_d_H_i_s'), function($excel) use($dataListMaster){

                $excel->sheet('mySheet', function($sheet) use($dataListMaster)
                {
                    $sheet->fromArray($dataListMaster);
                });
            })->download('csv');
        }
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

            $society_data = $society_data->selectRaw( DB::raw('@rownum  := @rownum  + 1 AS rownum').',society_name, lm_society_detail.id as id, village_id, survey_number, society_address, surplus_charges');

            return $datatables->of($society_data)
                ->editColumn('societyVillage', function ($society_data) {
                    return $society_data->societyVillage->village_name;
                })
                ->editColumn('society_name', function ($society_data) {
                    return "<a href='".route('lease_detail.index', [$society_data->id, $society_data->societyVillage->id])."'>$society_data->society_name</a>";
                })
                ->editColumn('actions', function ($society_data) {
                    return view('admin.society_detail.actions', compact('society_data'))->render();
                })
                ->rawColumns(['societyVillage', 'society_name', 'actions'])
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
            "order"=> [6, "desc" ],
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
        $header_data = $this->header_data;
        $arrData['other_land'] = OtherLand::where('status', 1)->get();
        $arrData['society_data'] = SocietyDetail::FindOrFail($id);

        return view('admin.society_detail.show', compact('header_data', 'arrData', 'id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $header_data = $this->header_data;
        $arrData['other_land'] = OtherLand::where('status', 1)->get();
        $arrData['society_data'] = SocietyDetail::FindOrFail($id);

        return view('admin.society_detail.edit', compact('header_data', 'arrData', 'id'));
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
        $society = SocietyDetail::find($id);

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

        $society->update($society_data);

        return redirect('/society_detail/'.$request->village_id)->with(['success'=> 'Society updated succesfully']);
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
