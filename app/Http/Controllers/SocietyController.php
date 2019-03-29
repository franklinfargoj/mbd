<?php

namespace App\Http\Controllers;

use App\District;
use App\Http\Requests\society_detail\SocietyDetailRequest;
use App\LeaseDetail;
use App\MasterLayout;
use App\OtherLand;
use App\SocietyDetail;
use App\MasterSociety;
use App\Taluka;
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
        $getData = [
            'society_name' =>session()->get('society_name'),
            'sr_no' =>session()->get('sr_no'),
            'village' =>session()->get('village'),
            'society_layout'    => session()->get('society_layout'),
        ];

        $society_data = SocietyDetail::with('getDistrictName','getTalukaName','getLayoutName')
            ->leftjoin('other_land','lm_society_detail.other_land_id', '=', 'other_land.id')
            ->leftjoin('village_societies','village_societies.society_id','=','lm_society_detail.id');

        if($getData['society_name'])
        {
            $society_data = $society_data->where('society_name', 'like', '%'.$getData['society_name'].'%');
        }

        if($getData['society_layout'])
        {
            $society_data = $society_data->where('layout_id', '=', $getData['society_layout']);
        }

        if($getData['village'])
        {
            $society_data = $society_data->whereHas('Villages', function($qu) use ($getData){
                $qu->where('id',$getData['village']);
            });
        }

        if($getData['sr_no'])
        {
            $society_data = $society_data->where('survey_number', 'like', '%'.$getData['sr_no'].'%');
        }

        $current_date = date('Y-m-d');

        if(isset($getData['lease_status'])){
            if($getData['lease_status'] == 1)
            {
                session()->put('lease_status',$getData['lease_status']);

                $society_data = $society_data->whereHas('societyLease',function($q) use($current_date){
                    $q->where('lease_renewal_date','>', $current_date)->where('lease_status',1);
                });

            }
            elseif($getData['lease_status'] == 0) {
                session()->put('lease_status',$getData['lease_status']);
                $society_data = $society_data->whereHas('societyLease',function($q) use($current_date){
                    $q->where('lease_renewal_date','<', $current_date)->where('lease_status',1);
                });
            }
        }

        $society_data = $society_data->selectRaw( DB::raw('lm_society_detail.id,
            lm_society_detail.society_name,
            lm_society_detail.district,
            lm_society_detail.taluka,
            lm_society_detail.village,
            lm_society_detail.survey_number,
            lm_society_detail.cts_number,
            lm_society_detail.chairman,
            lm_society_detail.society_address,
            lm_society_detail.area,
            lm_society_detail.society_reg_no,
            lm_society_detail.society_email_id,
            lm_society_detail.secretary,
            lm_society_detail.secretary_mob_no,
            lm_society_detail.chairman_mob_no,
            lm_society_detail.society_conveyed,
            lm_society_detail.date_of_conveyance,
            lm_society_detail.area_of_conveyance,
            lm_society_detail.layout_id,       
            lm_society_detail.date_on_service_tax,
            lm_society_detail.surplus_charges,
            lm_society_detail.surplus_charges_last_date,
            other_land.land_name'))->distinct('id')->get();
            if(count($society_data) == 0){
                $dataListMaster = [];
                $dataList = [];
                $dataList['Sr. No.'] = '';
                $dataList['Society Name'] = '';
                $dataList['Society Reg. No.'] = '';
                $dataList['District'] = '';
                $dataList['Taluka'] = '';
                $dataList['Village'] = ''   ;
                $dataList['Layout'] = '';
                $dataList['Survey Number'] = '';
                $dataList['CTS Number'] = '';
                $dataList['Name Of Chairman'] = '';
                $dataList['Mobile no. Of Chairman'] = '';
                $dataList['Name Of Secretary'] = '';
                $dataList['Mobile no. Of Secretary'] = '';
                $dataList['Society Address'] = '';
                $dataList['Society Email Id'] = '';
                $dataList['Area'] = '';
                $dataList['Date mentioned on service tax letters'] = '';
                $dataList['Surplus Charges'] = '';
                $dataList['Last date of paying surplus charges'] = '';
                $dataList['Land Name'] = '';
                $dataList['Is Society Conveyed ?'] = '';
                $dataList['Date Of Conveyance'] = '';
                $dataList['Area Of Conveyance'] = '';
                $dataListKeys = array_keys($dataList);
                $dataListMaster[]=$dataList;
            }else{
                $i=1;
                foreach ($society_data as $dataList_key => $dataList_value) {
                    $dataList = [];
                    $dataList['Sr. No.'] = $i;   
                    $dataList['Society Name'] = $dataList_value['society_name'];
                    $dataList['Society Reg. No.'] = $dataList_value['society_reg_no'];
                    $dataList['District'] = $dataList_value['getDistrictName']['district_name'];
                    $dataList['Taluka'] = $dataList_value['getTalukaName']['taluka_name'];
                    $dataList['Village'] = $this->getVillages($dataList_value['id']);
//                    $layout_name = MasterLayout::where('id',$dataList_value['layout_id'])->value('layout_name');
                    $dataList['Layout'] = $dataList_value['getLayoutName']['layout_name'] ?? NULL;
                    $dataList['Survey Number'] = $dataList_value['survey_number'];
                    $dataList['CTS Number'] = $dataList_value['cts_number'];
                    $dataList['Name Of Chairman'] = $dataList_value['chairman'] ?? NULL;
                    $dataList['Mobile no. Of Chairman'] = $dataList_value['chairman_mob_no'] ?? NULL;
                    $dataList['Name Of Secretary'] = $dataList_value['secretary'] ?? NULL;
                    $dataList['Mobile no. Of Secretary'] = $dataList_value['secretary_mob_no'] ?? NULL;
                    $dataList['Society Address'] = $dataList_value['society_address'];
                    $dataList['Society Email Id'] = $dataList_value['society_email_id'] ?? NULL;
                    $dataList['Area'] = $dataList_value['area'];
                    $dataList['Date mentioned on service tax letters'] = $dataList_value['date_on_service_tax'];
                    $dataList['Surplus Charges'] = $dataList_value['surplus_charges'];
                    $dataList['Last date of paying surplus charges'] = $dataList_value['surplus_charges_last_date'];
                    $dataList['Land Name'] = $dataList_value['land_name'];
                    $dataList['Is Society Conveyed ?'] = ($dataList_value['society_conveyed'] == 1) ? 'yes' : 'no';;
                    $dataList['Date Of Conveyance'] = $dataList_value['date_of_conveyance'] ?? NULL;
                    $dataList['Area Of Conveyance'] = $dataList_value['area_of_conveyance'] ?? NULL;

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
        //dd('ok');
        $header_data = $this->header_data;
        $getData = $request->all();
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
            $getData = [
                'society_name'=> session()->get('society_name'),
                'sr_no'       => session()->get('sr_no'),
                'village'     => session()->get('village'),
                'lease_status'=> session()->get('lease_status'),
                'society_layout'       => session()->get('society_layout'),
            ];

            $society_data = SocietyDetail::with('getDistrictName','getTalukaName','getLayoutName')->leftjoin('other_land','lm_society_detail.other_land_id', '=', 'other_land.id')
            ->leftjoin('village_societies','village_societies.society_id','=','lm_society_detail.id')
            ->leftjoin('lm_lease_detail','lm_lease_detail.society_id','=','lm_society_detail.id');


            if($getData['society_name'])
            {
                $society_data = $society_data->where('society_name', 'like', '%'.$getData['society_name'].'%');
            }
            //dd($getData);
            if($getData['society_layout'])
            {
                $society_data = $society_data->where('layout_id', '=', $getData['society_layout']);
            }

//
            if($getData['village'])
            {
                $society_data = $society_data->whereHas('Villages', function($qu) use ($getData){
                    $qu->where('id',$getData['village']);
                });
            }

            if($getData['sr_no'])
            {
                $society_data = $society_data->where('survey_number', 'like', '%'.$getData['sr_no'].'%');
            }

            $current_date = date('Y-m-d');

            if(isset($getData['lease_status'])){
                if($getData['lease_status'] == 1)
                {
                    session()->put('lease_status',$getData['lease_status']);

                    $society_data = $society_data->whereHas('societyLease',function($q) use($current_date){
                        $q->where('lease_renewal_date','>', $current_date)->where('lease_status',1);
                    });

                }
                elseif($getData['lease_status'] == 0) {
                    session()->put('lease_status',$getData['lease_status']);
                    $society_data = $society_data->whereHas('societyLease',function($q) use($current_date){
                        $q->where('lease_renewal_date','<', $current_date)->where('lease_status',1);
                    });
                }
            }

            $society_data = $society_data->selectRaw( DB::raw('lm_society_detail.id,
            lm_society_detail.society_name,
            lm_society_detail.district,
            lm_society_detail.taluka,
            lm_society_detail.village,
            lm_society_detail.survey_number,
            lm_society_detail.cts_number,
            lm_society_detail.chairman,
            lm_society_detail.society_address,
            lm_society_detail.area,
            lm_society_detail.society_reg_no,
            lm_society_detail.society_email_id,
            lm_society_detail.secretary,
            lm_society_detail.secretary_mob_no,
            lm_society_detail.chairman_mob_no,
            lm_society_detail.society_conveyed,
            lm_society_detail.date_of_conveyance,
            lm_society_detail.area_of_conveyance,
            lm_society_detail.layout_id,       
            lm_society_detail.date_on_service_tax,
            lm_society_detail.surplus_charges,
            lm_society_detail.surplus_charges_last_date,
            other_land.land_name'))->distinct('id')->get();
            //dd($society_data);
            if(count($society_data) == 0){
                $dataListMaster = [];
                $dataList = [];
                $dataList['Sr. No.'] = '';
                $dataList['Society Name'] = '';
                $dataList['Society Reg. No.'] = '';
                $dataList['District'] = '';
                $dataList['Taluka'] = '';
                $dataList['Village'] = ''   ;
                $dataList['Layout'] = '';
                $dataList['Survey Number'] = '';
                $dataList['CTS Number'] = '';
                $dataList['Name Of Chairman'] = '';
                $dataList['Mobile no. Of Chairman'] = '';
                $dataList['Name Of Secretary'] = '';
                $dataList['Mobile no. Of Secretary'] = '';
                $dataList['Society Address'] = '';
                $dataList['Society Email Id'] = '';
                $dataList['Area'] = '';
                $dataList['Date mentioned on service tax letters'] = '';
                $dataList['Surplus Charges'] = '';
                $dataList['Last date of paying surplus charges'] = '';
                $dataList['Land Name'] = '';
                $dataList['Is Society Conveyed ?'] = '';
                $dataList['Date Of Conveyance'] = '';
                $dataList['Area Of Conveyance'] = '';

                $dataListMaster[]=$dataList;
                $dataListKeys = array_keys($dataList);
            }else{
                $i=1;
                foreach ($society_data as $dataList_key => $dataList_value) {

                    $dataList = [];
                    $dataList['Sr. No.'] = $i;
                    $dataList['Society Name'] = $dataList_value['society_name'];
                    $dataList['Society Reg. No.'] = $dataList_value['society_reg_no'];
                    $dataList['District'] = $dataList_value['getDistrictName']['district_name'];
                    $dataList['Taluka'] = $dataList_value['getTalukaName']['taluka_name'];
                    $dataList['Village'] = $this->getVillages($dataList_value['id']);
                    $dataList['Layout'] = $dataList_value['getLayoutName']['layout_name'] ?? NULL;
//                    $layout_name = MasterLayout::where('id',$dataList_value['layout_id'])->value('layout_name');
//                    $dataList['Layout'] = $layout_name ?? NULL;
                    $dataList['Survey Number'] = $dataList_value['survey_number'];
                    $dataList['CTS Number'] = $dataList_value['cts_number'];
                    $dataList['Name Of Chairman'] = $dataList_value['chairman'] ?? NULL;
                    $dataList['Mobile no. Of Chairman'] = $dataList_value['chairman_mob_no'] ?? NULL;
                    $dataList['Name Of Secretary'] = $dataList_value['secretary'] ?? NULL;
                    $dataList['Mobile no. Of Secretary'] = $dataList_value['secretary_mob_no'] ?? NULL;
                    $dataList['Society Address'] = $dataList_value['society_address'];
                    $dataList['Society Email Id'] = $dataList_value['society_email_id'] ?? NULL;
                    $dataList['Area'] = $dataList_value['area'];
                    $dataList['Date mentioned on service tax letters'] = $dataList_value['date_on_service_tax'];
                    $dataList['Surplus Charges'] = $dataList_value['surplus_charges'];
                    $dataList['Last date of paying surplus charges'] = $dataList_value['surplus_charges_last_date'];
                    $dataList['Land Name'] = $dataList_value['land_name'];
                    $dataList['Is Society Conveyed ?'] = ($dataList_value['society_conveyed'] == 1) ? 'yes' : 'no';;
                    $dataList['Date Of Conveyance'] = $dataList_value['date_of_conveyance'] ?? NULL;
                    $dataList['Area Of Conveyance'] = $dataList_value['area_of_conveyance'] ?? NULL;

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

        // lease count
        $lease_count = $this->getNotificationCount();
        session()->put('lease_end_date_count', $lease_count);


//        $current_date = date('Y-m-d');
//
//        if($request->lease_status == 1)
//        {
//            session()->put('lease_status',$request->lease_status);
//
//            $society_data = $society_data->whereHas('societyLease',function($q) use($request ,$current_date){
//                $q->where('lease_renewal_date','>', $current_date)->where('lease_status',1);
//            });
//
//        }
//        elseif($request->lease_status == 0) {
//            session()->put('lease_status',$request->lease_status);
//            $society_data = $society_data->whereHas('societyLease',function($q) use($request ,$current_date){
//                $q->where('lease_renewal_date','<', $current_date)->where('lease_status',1);
//            });
//        }
//        else
//        {
//            session()->forget('lease_status');
//        }

        if ($datatables->getRequest()->ajax()) {

            // DB::statement(DB::raw('set @rownum='. (isset($request->start) ? $request->start : 0) ));
            $society_data = SocietyDetail::orderBy('id', 'desc');

//        dd($society_data);
            if($request->society_name)
            {
                session()->put('society_name',$request->society_name);
                $society_data = $society_data->where('society_name', 'like', '%'.$request->society_name.'%');
            }else{
                session()->forget('society_name');
            }

            if($request->society_layout)
            {
                session()->put('society_layout',$request->society_layout);
                $society_data = $society_data->where('layout_id', '=', $request->society_layout);
            }else{
                session()->forget('society_layout');
            }
            //layout_id
            if($request->village)
            {
                session()->put('village',$request->village);
                $society_data = $society_data->whereHas('Villages', function($qu) use ($request){
                    $qu->where('id',$request->village);
                });
            }else{
                session()->forget('village');
            }

            if($request->sr_no)
            {
                session()->put('sr_no',$request->sr_no);
                $society_data = $society_data->where('survey_number', 'like', '%'.$request->sr_no.'%');
            }else{
                session()->forget('sr_no');
            }

            $current_date = date('Y-m-d');

            if(isset($request->lease_status)){
                if($request->lease_status == 1)
                {
                    session()->put('lease_status',$request->lease_status);

                    $society_data = $society_data->whereHas('societyLease',function($q) use($request ,$current_date){
                        $q->where('lease_renewal_date','>', $current_date)->where('lease_status',1);
                    });

                }
                elseif($request->lease_status == 0) {
                    session()->put('lease_status',$request->lease_status);
                    $society_data = $society_data->whereHas('societyLease',function($q) use($request ,$current_date){
                        $q->where('lease_renewal_date','<', $current_date)->where('lease_status',1);
                    });
                }
            }else
            {
                session()->forget('lease_status');
            }


            $society_data = $society_data->get();

            return $datatables->of($society_data)

                ->editColumn('rownum', function ($society_data) {
                    static $i = 0;
                    $i++;
                    return $i;
                })
                ->editColumn('societyVillage', function ($society_data) {
                    $village_string="";
                    foreach($society_data->Villages as $village)
                     {
                        $village_string.= $village->village_name.",";
                     }
                    return "<span>".trim($village_string,',')."</span>";
                })
                ->editColumn('society_name', function ($society_data) {
                    return $society_data->society_name;
                })
                ->editColumn('actions', function ($society_data) {
                    return view('admin.society_detail.actions', compact('society_data'))->render();
                })
                ->rawColumns(['societyVillage', 'society_name', 'actions'])
                ->make(true);
        }
        $villages = VillageDetail::get();
        $layouts = MasterLayout::get();
        //dd($layouts);
        $html = $datatables->getHtmlBuilder()->columns($columns)->parameters($this->getParameters());

        return view('admin.society_detail.index', compact('html','header_data','villages','getData','layouts'));
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
        $arrData['layouts'] = MasterLayout::get();
        $districts = District::get();
        $talukas = Taluka::get();
//        dd($arrData);
        return view('admin.society_detail.create', compact('header_data', 'arrData','districts','talukas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SocietyDetailRequest $request)
    {
        $request->validate([
            'villages'=>'required|array|min:1'
        ]); 
        $society_data = [
            'society_name' => $request->society_name,
            'society_reg_no' => $request->society_reg_no,
            'district' => $request->district,
            'taluka' => $request->taluka,
            'survey_number' => $request->survey_number,
            'cts_number' => $request->cts_number,
            'society_address' => $request->society_address,
            'area' => $request->area,
            'date_on_service_tax' => $request->date_on_service_tax,
            'surplus_charges' => $request->surplus_charges,
            'surplus_charges_last_date' => $request->surplus_charges_last_date,
//            'village' => $request->village_id,
            'other_land_id' => $request->other_land_id,
            'layout_id' => $request->layout,
            'society_conveyed' => $request->society_conveyed,
            'chairman' => $request->chairman,
            'chairman_mob_no' => $request->chairman_mob_no,
            'secretary' => $request->secretary,
            'secretary_mob_no' => $request->secretary_mob_no,
            'society_email_id' => $request->society_email_id
        ];
        if($request->society_conveyed){
            $society_data += [
                'area_of_conveyance' => $request->area_of_conveyance,
                'date_of_conveyance' => $request->date_of_conveyance
            ];
        }

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
        $id = decrypt($id);
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
        $arrData['layouts'] = MasterLayout::get();

        $districts = District::get();
        $talukas = Taluka::get();

        return view('admin.society_detail.show', compact('header_data', 'arrData', 'id','villages_belongs','districts','talukas'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $id = decrypt($id);
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
        $arrData['layouts'] = MasterLayout::get();

        $districts = District::get();
        $talukas = Taluka::get();

        return view('admin.society_detail.edit', compact('header_data', 'arrData', 'id','villages_belongs','districts','talukas'));
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
        $request->validate([
            'villages'=>'required|array|min:1'
        ]);
        $society = SocietyDetail::find($id);

        $society_data = [
            'society_name' => $request->society_name,
            'society_reg_no' => $request->society_reg_no,
            'district' => $request->district,
            'taluka' => $request->taluka,
            'survey_number' => $request->survey_number,
            'cts_number' => $request->cts_number,
            'society_address' => $request->society_address,
            'area' => $request->area,
            'date_on_service_tax' => $request->date_on_service_tax,
            'surplus_charges' => $request->surplus_charges,
            'surplus_charges_last_date' => $request->surplus_charges_last_date,
            //'village_id' => $request->village_id,
            'other_land_id' => $request->other_land_id,
            'layout_id' => $request->layout,
            'society_conveyed' => $request->society_conveyed,
            'chairman' => $request->chairman,
            'chairman_mob_no' => $request->chairman_mob_no,
            'secretary' => $request->secretary,
            'secretary_mob_no' => $request->secretary_mob_no,
            'society_email_id' => $request->society_email_id
        ];

        if($request->society_conveyed){
            $society_data += [
                'area_of_conveyance' => $request->area_of_conveyance,
                'date_of_conveyance' => $request->date_of_conveyance
            ];
        }else{
            $society_data += [
                'area_of_conveyance' => NULL,
                'date_of_conveyance' => NULL
            ];
        }

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

    public function show_end_date_lease(Request $request, Datatables $datatables){
        $header_data = $this->header_data;
        $getData = $request->all();
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
        $society_datas = SocietyDetail::orderBy('id', 'desc')->get();
        $lease_detail = LeaseDetail::with('leaseSociety')->where('lease_status',1)->get();
        $society_data = [];
        $lease_count = 0;
        foreach($society_datas as $society_datas_key => $society_datas_val){
            foreach($lease_detail as $lease_detail_key => $lease_detail_val){
//                $lease_start_date = $lease_detail_val->lease_start_date;
//                $lease_period = '+'.$lease_detail_val->lease_period.' years';
//                $lease_end_date = date('Y-m-d', strtotime($lease_period, strtotime($lease_detail_val->lease_start_date)));
////                $current_date = date('Y-m-d', strtotime('+3 days'));
//                $current_date = date('Y-m-d');
//                $notification_from_date = date('Y-m-d', strtotime('-3 days',strtotime($lease_end_date)));

                if ($lease_detail_val->lease_renewed_period) {

                    $lease_start_date = $lease_detail_val->lease_renewal_date;
                    $lease_period = '+' . $lease_detail_val->lease_renewed_period . ' years';
                    $lease_end_date = date('Y-m-d', strtotime($lease_period, strtotime($lease_start_date)));
                    $current_date = date('Y-m-d');
                    $notification_from_date = date('Y-m-d', strtotime('-3 days', strtotime($lease_end_date)));
                }
                else{
                    $lease_start_date = $lease_detail_val->lease_start_date;
                    $lease_period = '+' . $lease_detail_val->lease_period . ' years';
                    $lease_end_date = date('Y-m-d', strtotime($lease_period, strtotime($lease_start_date)));
                    $current_date = date('Y-m-d');
                    $notification_from_date = date('Y-m-d', strtotime('-3 days', strtotime($lease_end_date)));
                }


                if(($society_datas_val->id == $lease_detail_val->society_id)){
                    if ($current_date >= $notification_from_date) {
                        if ($lease_detail_val->lease_renewed_period){
                            $notification_to_date = date('Y-m-d', strtotime('-1 day', strtotime($lease_detail_val->lease_renewal_date)));
                            if ($current_date < $notification_to_date) {
                                $society_data[] = $society_datas_val;
                                $lease_count++;
                            }
                        }
                        else {
                            $society_data[] = $society_datas_val;
                            $lease_count++;
                        }
                    }
                }
            }
        }
        session()->put('lease_end_date_count', $lease_count);
//        dd($society_data);
        if ($datatables->getRequest()->ajax()) {

            // DB::statement(DB::raw('set @rownum='. (isset($request->start) ? $request->start : 0) ));
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
                    return $society_data->society_name;
                })
                ->editColumn('actions', function ($society_data) {
                    return view('admin.society_detail.actions', compact('society_data'))->render();
                })
                ->rawColumns(['societyVillage', 'society_name', 'actions'])
                ->make(true);
        }

        $html = $datatables->getHtmlBuilder()->columns($columns)->parameters($this->getParameters());

        $villages = VillageDetail::get();
        $layouts = MasterLayout::get();

        return view('admin.society_detail.index', compact('html','villages','header_data','getData', 'id','layouts'));
    }



    public function getNotificationCount(){
        $lease_detail = LeaseDetail::with('leaseSociety')->where('lease_status',1)->get();

//        dd($lease_detail);
        $lease_count = 0;
        foreach($lease_detail as $lease_detail_val) {
            if ($lease_detail_val->lease_renewed_period) {

                $lease_start_date = $lease_detail_val->lease_renewal_date;
                $lease_period = '+' . $lease_detail_val->lease_renewed_period . ' years';
                $lease_end_date = date('Y-m-d', strtotime($lease_period, strtotime($lease_start_date)));
                $current_date = date('Y-m-d');
                $notification_from_date = date('Y-m-d', strtotime('-3 days', strtotime($lease_end_date)));
            }
            else{
                $lease_start_date = $lease_detail_val->lease_start_date;
                $lease_period = '+' . $lease_detail_val->lease_period . ' years';
                $lease_end_date = date('Y-m-d', strtotime($lease_period, strtotime($lease_start_date)));
                $current_date = date('Y-m-d');
                $notification_from_date = date('Y-m-d', strtotime('-3 days', strtotime($lease_end_date)));

            }
            if ($current_date >= $notification_from_date) {
                if ($lease_detail_val->lease_renewed_period){
                    $notification_to_date = date('Y-m-d', strtotime('-1 day', strtotime($lease_detail_val->lease_renewal_date)));
                    if ($current_date < $notification_to_date) {
                        $lease_count++;
                    }
                }
                else {
                    $lease_count++;
                }
            }
        }
//        echo "<br/>===>>>>";print_r($lease_count);
//die();

//        dd($lease_count);
        return $lease_count;

    }
}

