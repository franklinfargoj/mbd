<?php

namespace App\Http\Controllers;

use App\Http\Requests\society_detail\SocietyDetailRequest;
use App\OtherLand;
use App\SocietyDetail;
use App\VillageDetail;
use App\VillageSociety;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Config;
use DB;
use Excel;
use Session;

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

    public function getVillages($society_id)
    {
        $village_string="";
        $Society=SocietyDetail::with('Villages')->where('id',$society_id)->first();
        foreach($Society->Villages as $village)
        {
            $village_string.=$village->village_name.", ";
        }
       return trim($village_string,', ');
    }

    public function print_data()
    {
        $society_data = SocietyDetail::join('other_land','lm_society_detail.other_land_id', '=', 'other_land.id')
            ->join('village_societies','village_societies.society_id','=','lm_society_detail.id');
            $society_data = $society_data->selectRaw( DB::raw('lm_society_detail.id,lm_society_detail.society_name,lm_society_detail.district,lm_society_detail.taluka,lm_society_detail.village,lm_society_detail.survey_number,lm_society_detail.cts_number,lm_society_detail.chairman,lm_society_detail.society_address,lm_society_detail.area,lm_society_detail.date_on_service_tax,lm_society_detail.surplus_charges,lm_society_detail.surplus_charges_last_date,other_land.land_name'))->distinct('id')->get();
            if(count($society_data) == 0){
                $dataListMaster = [];
                $dataList = [];
                $dataList['Sr. No.'] = '';
                $dataList['Society Name'] = '';
                $dataList['District'] = '';
                $dataList['Taluka'] = '';
                $dataList['Village'] = ''   ;
                $dataList['Survey Number'] = '';
                $dataList['CTS Number'] = '';
                $dataList['Chairman'] = '';
                $dataList['Society Address'] = '';
                $dataList['Area'] = '';
                $dataList['Date mentioned on service tax letters'] = '';
                $dataList['Surplus Charges'] = '';
                $dataList['Last date of paying surplus charges'] = '';
                $dataList['Land Name'] = '';
                $dataListMaster[]=$dataList;
                $dataListKeys = array_keys($dataList);
            }else{
                $i=1;
                foreach ($society_data as $dataList_key => $dataList_value) {
                    $dataList = [];
                    $dataList['Sr. No.'] = $i;   
                    $dataList['Society Name'] = $dataList_value['society_name'];
                    $dataList['District'] = $dataList_value['district'];
                    $dataList['Taluka'] = $dataList_value['taluka'];
                    $dataList['Village'] = $this->getVillages($dataList_value['id']);
                    $dataList['Survey Number'] = $dataList_value['survey_number'];
                    $dataList['CTS Number'] = $dataList_value['cts_number'];
                    $dataList['Chairman'] = $dataList_value['chairman'];
                    $dataList['Society Address'] = $dataList_value['society_address'];
                    $dataList['Area'] = $dataList_value['area'];
                    $dataList['Date mentioned on service tax letters'] = $dataList_value['date_on_service_tax'];
                    $dataList['Surplus Charges'] = $dataList_value['surplus_charges'];
                    $dataList['Last date of paying surplus charges'] = $dataList_value['surplus_charges_last_date'];
                    $dataList['Land Name'] = $dataList_value['land_name'];
                    
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
    public function index(Request $request, Datatables $datatables)
    {
        $header_data = $this->header_data;
        $getData = $request->all();
        if($request->end_lease_date_count != null){
            Session::put('is_lease_notification_click', 1);
        }else{
            Session::forget('is_lease_notification_click');
        }
//        dd(Session::has('is_lease_notification_click'));
        $columns = [
            // ['data' => 'radio','name' => 'radio','title' => '','searchable' => false],
            ['data' => 'rownum','name' => 'rownum','title' => 'Sr No.','searchable' => false],
            ['data' => 'society_name','name' => 'society_name','title' => 'Society Name'],
            ['data' => 'societyVillage', 'class'=> 'datatable-village', 'name' => 'societyVillage.village_name','title' => 'Village Name'],
            ['data' => 'survey_number','name' => 'survey_number','title' => 'Survey Number'],
            ['data' => 'society_address','name' => 'society_address','title' => 'Society Address'],
            ['data' => 'surplus_charges', 'name' => 'surplus_charges', 'title' => 'Surplus Charges'],
            ['data' => 'actions','name' => 'actions','title' => 'Actions','searchable' => false,'orderable'=>false],
        ];
        if($request->excel)
        {
            $society_data = SocietyDetail::join('other_land','lm_society_detail.other_land_id', '=', 'other_land.id')
            ->join('village_societies','village_societies.society_id','=','lm_society_detail.id');
            $society_data = $society_data->selectRaw( DB::raw('lm_society_detail.id,lm_society_detail.society_name,lm_society_detail.district,lm_society_detail.taluka,lm_society_detail.village,lm_society_detail.survey_number,lm_society_detail.cts_number,lm_society_detail.chairman,lm_society_detail.society_address,lm_society_detail.area,lm_society_detail.date_on_service_tax,lm_society_detail.surplus_charges,lm_society_detail.surplus_charges_last_date,other_land.land_name'))->distinct('id')->get();
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
                $dataList['Last date of paying surplus charges'] = '';
                $dataList['Land Name'] = '';
                $dataListMaster[]=$dataList;
            }else{
                $i=1;
                foreach ($society_data as $dataList_key => $dataList_value) {
                    
                    $dataList = [];
                    $dataList['id'] = $i;
                    $dataList['Society Name'] = $dataList_value['society_name'];
                    $dataList['District'] = $dataList_value['district'];
                    $dataList['Taluka'] = $dataList_value['taluka'];
                    $dataList['Village'] = $this->getVillages($dataList_value['id']);
                    $dataList['Survey Number'] = $dataList_value['survey_number'];
                    $dataList['CTS Number'] = $dataList_value['cts_number'];
                    $dataList['Chairman'] = $dataList_value['chairman'];
                    $dataList['Society Address'] = $dataList_value['society_address'];
                    $dataList['Area'] = $dataList_value['area'];
                    $dataList['Date mentioned on service tax letters'] = $dataList_value['date_on_service_tax'];
                    $dataList['Surplus Charges'] = $dataList_value['surplus_charges'];
                    $dataList['Last date of paying surplus charges'] = $dataList_value['surplus_charges_last_date'];
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

            // DB::statement(DB::raw('set @rownum='. (isset($request->start) ? $request->start : 0) ));
             $society_data = SocietyDetail::orderBy('id', 'desc')->get();
            // $society_data = VillageDetail::with('Societies')->whereHas('Societies')->where('id',$id);
            //$society_data= array_get($society_data, 'Societies')!=null?array_get($society_data, 'Societies'):[];

            // $society_data = $society_data->selectRaw( DB::raw('@rownum  := @rownum  + 1 AS rownum').',society_name, lm_society_detail.id as id, village_id, survey_number, society_address, surplus_charges');
//            dd($society_data);

            return $datatables->of($society_data)
                // ->editColumn('radio', function ($society_data) {
                //     $url = route('society_detail.show', $society_data->id);
                //     return '<label class="m-radio m-radio--primary m-radio--link"><input type="radio" onclick="geturl(this.value);" value="'.$url.'" name="village_data_id"><span></span></label>';
                // })
                ->editColumn('rownum', function ($society_data) {
                    static $i = 0;
                    $i++;
                    return $i;
                })
                ->editColumn('societyVillage', function ($society_data) {
                    $village_string="";
                    foreach($society_data->Villages as $viilage)
                     {
                        $village_string.= $viilage->village_name.",";
                     }   
                    return "<span>".trim($village_string,',')."</span>";
                })
                ->editColumn('society_name', function ($society_data) {
                    return "<a href='".route('lease_detail.index', [$society_data->id])."'>$society_data->society_name</a>";
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
    public function create()
    {
        $header_data = $this->header_data;
        $arrData['other_land'] = OtherLand::where('status', 1)->get();
        $arrData['villages'] = VillageDetail::get();

        return view('admin.society_detail.create', compact('header_data', 'arrData'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SocietyDetailRequest $request)
    {
        //dd($request->all());
        $request->validate([
            'villages'=>'required|array|min:1'
        ]); 
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
            //'village_id' => $request->village_id,
            'other_land_id' => $request->other_land_id
        ];

        $society_detail=SocietyDetail::create($society_data);
        $society_detail->Villages()->attach($request->villages);

        return redirect('/society_detail/')->with(['success'=> 'Society added succesfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $villages_belongs=array();
        $header_data = $this->header_data;
        $arrData['other_land'] = OtherLand::where('status', 1)->get();
        $arrData['society_data'] = SocietyDetail::FindOrFail($id);
        $arrData['villages'] = VillageDetail::get();
        $has_villages=VillageSociety::where('society_id',$id)->get();
        foreach($has_villages as $has_village)
        {
            $villages_belongs[]=$has_village->village_id;
        }

        return view('admin.society_detail.show', compact('header_data', 'arrData', 'id','villages_belongs'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $villages_belongs=array();
        $header_data = $this->header_data;
        $arrData['other_land'] = OtherLand::where('status', 1)->get();
        $arrData['society_data'] = SocietyDetail::FindOrFail($id);
        $has_villages=VillageSociety::where('society_id',$id)->get();
        foreach($has_villages as $has_village)
        {
            $villages_belongs[]=$has_village->village_id;
        }
        $arrData['villages'] = VillageDetail::get();
        return view('admin.society_detail.edit', compact('header_data', 'arrData', 'id','villages_belongs'));
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
        //dd($request->all());
        $request->validate([
            'villages'=>'required|array|min:1'
        ]);
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
            'other_land_id' => $request->other_land_id
        ];

        $society->update($society_data);
        $society->Villages()->sync($request->villages);

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
