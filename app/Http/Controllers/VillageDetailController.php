<?php

namespace App\Http\Controllers;

use App\Board;
use App\Http\Requests\village_detail\EditVillageDetailRequest;
use App\Http\Requests\village_detail\VillageDetailRequest;
use App\LandSource;
use App\VillageDetail;
use Illuminate\Http\Request;
use DB;
use File;
use Storage;
use Yajra\DataTables\DataTables;
use Config;

class VillageDetailController extends Controller
{
    public $header_data = array(
        'menu' => 'Village Detail',
        'menu_url' => 'village_detail',
        'page' => '',
        'side_menu' => 'village_detail'
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
    public function index(Request $request, Datatables $datatables)
    {
        $header_data = $this->header_data;
        $getData = $request->all();

        $columns = [
            ['data' => 'rownum','name' => 'rownum','title' => 'Sr No.','searchable' => false],
            ['data' => 'villageBoard','name' => 'villageBoard.board_name','title' => 'Board Name'],
            ['data' => 'village_name','name' => 'village_name','title' => 'Village Name'],
            ['data' => 'villageLandSource','name' => 'villageLandSource.source_name','title' => 'Type of Land'],
            ['data' => 'land_address', 'name' => 'land_address', 'title' => 'Land Address'],
            ['data' => 'possession_date','name' => 'possession_date','title' => 'Possession Date'],
            ['data' => 'actions','name' => 'actions','title' => 'Actions','searchable' => false,'orderable'=>false],
        ];

        if ($datatables->getRequest()->ajax()) {

            DB::statement(DB::raw('set @rownum='. (isset($request->start) ? $request->start : 0) ));

            $village_data = VillageDetail::with(['villageLandSource', 'villageBoard']);

//            if($request->office_date_from)
//            {
//                $hearing_data = $hearing_data->whereDate('office_date', '>=', date('Y-m-d', strtotime($request->office_date_from)));
//            }
//
//            if($request->office_date_to)
//            {
//                $hearing_data = $hearing_data->whereDate('office_date', '<=', date('Y-m-d', strtotime($request->office_date_to)));
//            }

            $village_data = $village_data->selectRaw( DB::raw('@rownum  := @rownum  + 1 AS rownum').',village_name, village_detail.id as id, board_id, land_source_id, land_address, possession_date');

            return $datatables->of($village_data)
                ->editColumn('village_name', function ($village_data) {
                    return "<a href='".route('society_detail.index', $village_data->id)."'>$village_data->village_name</a>";
                })
                ->editColumn('villageBoard', function ($village_data) {
                    return $village_data->villageBoard->board_name;
                })
                ->editColumn('villageLandSource', function ($village_data) {
                    return $village_data->villageLandSource->source_name;
                })
                ->editColumn('actions', function ($village_data) {
                    return view('admin.village_detail.actions', compact('village_data'))->render();
                })
                ->rawColumns(['villageBoard', 'villageLandSource', 'village_name', 'actions'])
                ->make(true);
        }

        $html = $datatables->getHtmlBuilder()->columns($columns)->parameters($this->getParameters());

        return view('admin.village_detail.index', compact('html','header_data','getData'));
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
        $arrData['board'] = Board::where('status', 1)->get();
        $arrData['land_source'] = LandSource::where('status', 1)->get();

        return view('admin.village_detail.create', compact('header_data', 'arrData'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VillageDetailRequest $request)
    {
        $village_data = [
            'board_id' => $request->board_id,
            'sr_no' => $request->sr_no,
            'village_name' => $request->village_name,
            'land_source_id' => $request->land_source_id,
            'land_address' => $request->land_address,
            'district' => $request->district,
            'taluka' => $request->taluka,
            'total_area' => $request->total_area,
            'possession_date' => $request->possession_date,
            'remark' => $request->remark,
            '7_12_mhada_name' => $request->mhada_name,
            'property_card' => $request->property_card,
            'property_card_mhada_name' => $request->property_card_mhada_name,
            'land_cost' => $request->land_cost,
        ];
        
        $time = time();

        if($request->file_upload == 1) {
            if ($request->hasFile('extract')) {
                $extension = $request->file('extract')->getClientOriginalExtension();
                if ($extension == "pdf") {
                    $name = File::name($request->file('extract')->getClientOriginalName()) . '_' . $time . '.' . $extension;
                    $path = Storage::putFileAs('/7_12_extract_document', $request->file('extract'), $name, 'public');
                    $village_data['7_12_extract'] = 1;
                    $village_data['extract_file_path'] = $path;
                    $village_data['extract_file_name'] = File::name($request->file('extract')->getClientOriginalName()) . '.' . $extension;
                } else {
                    return redirect()->back()->with('error', 'Invalid type of file uploaded (only pdf allowed)');
                }

            } else {
                return redirect()->back()->with('error', 'Please select file to upload');
            }
        }
        else
        {
            $village_data['7_12_extract'] = 0;
        }
        
        VillageDetail::create($village_data);

        return redirect('/village_detail')->with(['success'=> 'Village added succesfully']);
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
        $header_data = $this->header_data;
        $arrData['board'] = Board::where('status', 1)->get();
        $arrData['land_source'] = LandSource::where('status', 1)->get();
        $arrData['village_data'] = VillageDetail::FindOrFail($id)->toArray();

        return view('admin.village_detail.edit', compact('header_data', 'arrData'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditVillageDetailRequest $request, $id)
    {
        $village = VillageDetail::find($id);
        $village_data = [
            'board_id' => $request->board_id,
            'sr_no' => $request->sr_no,
            'village_name' => $request->village_name,
            'land_source_id' => $request->land_source_id,
            'land_address' => $request->land_address,
            'district' => $request->district,
            'taluka' => $request->taluka,
            'total_area' => $request->total_area,
            'possession_date' => $request->possession_date,
            'remark' => $request->remark,
            '7_12_mhada_name' => $request->mhada_name,
            'property_card' => $request->property_card,
            'property_card_mhada_name' => $request->property_card_mhada_name,
            'land_cost' => $request->land_cost,
        ];

        $time = time();

        if($request->file_upload == 1) {
            if ($request->hasFile('extract')) {
                $extension = $request->file('extract')->getClientOriginalExtension();
                if ($extension == "pdf") {
                    $name = File::name($request->file('extract')->getClientOriginalName()) . '_' . $time . '.' . $extension;
                    $path = Storage::putFileAs('/7_12_extract_document', $request->file('extract'), $name, 'public');
                    $village_data['7_12_extract'] = 1;
                    $village_data['extract_file_path'] = $path;
                    $village_data['extract_file_name'] = File::name($request->file('extract')->getClientOriginalName()) . '.' . $extension;
                } else {
                    return redirect()->back()->with('error', 'Invalid type of file uploaded (only pdf allowed)');
                }

            } else {
                $village_data['extract_file_path'] = $request->extract_file_path;
                $village_data['extract_file_name'] = $request->extract_file_name;
            }
        }
        else {
            $village_data['extract_file_path'] = '';
            $village_data['extract_file_name'] = '';
            $village_data['7_12_extract'] = 0;
        }

        $village->update($village_data);

        return redirect('/village_detail')->with(['success'=> 'Village added succesfully']);
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