<?php

namespace App\Http\Controllers;
use App\SocietyConveyance;
use App\SocietyOfferLetter;
use App\OlApplication;
use Yajra\DataTables\DataTables;
use Auth;
use App\Http\Controllers\Common\CommonController;
use Config;
use Maatwebsite\Excel\Facades\Excel;
use File;
use App\LayoutUser;
use App\MasterLayout;

use Illuminate\Http\Request;

class SocietyConveyanceController extends Controller
{

    protected $list_num_of_records_per_page;

    public function __construct()
    {
        $this->CommonController = new CommonController();
        $this->list_num_of_records_per_page = Config::get('commanConfig.list_num_of_records_per_page');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(DataTables $datatables, Request $request)
    {
//        $society_details = SocietyOfferLetter::where('user_id', Auth::user()->id)->first();
//        $sc = SocietyConveyance::where('society_id', $society_details->id)->first();
//        dd($sc);
        $columns = [
            ['data' => 'rownum','name' => 'rownum','title' => 'Sr No.','searchable' => false],
            ['data' => 'application_no','name' => 'application_no','title' => 'Application No.'],
            ['data' => 'application_master_id','name' => 'application_master_id','title' => 'Application Type'],
            ['data' => 'created_at','name' => 'created_date','title' => 'Submission Date', 'class' => 'datatable-date'],
            ['data' => 'status','name' => 'status','title' => 'Status'],
            ['data' => 'actions','name' => 'actions','title' => 'Actions','searchable' => false,'orderable'=>false],
        ];
        $getRequest = $request->all();
        $society_details = SocietyOfferLetter::where('user_id', Auth::user()->id)->first();
        $ol_application_count = count(SocietyConveyance::where('society_id', $society_details->id)->get());
        if ($datatables->getRequest()->ajax()) {
            $ol_applications = SocietyConveyance::where('society_id', $society_details->id)->with(['ol_application_master', 'olApplicationStatus' => function($q){
                $q->where('society_flag', '1')->orderBy('id', 'desc');
            } ]);

            if($request->application_master_id)
            {
                $ol_applications = $ol_applications->where('application_master_id', 'like', '%'.$request->application_master_id.'%');
            }
            $ol_applications = $ol_applications->get();
            // dd($ol_applications);
            return $datatables->of($ol_applications)
                ->editColumn('rownum', function ($ol_applications) {
                    static $i = 0;
                    $i++;
                    return $i;
                })
                ->editColumn('application_no', function ($ol_applications) {
                    return $ol_applications->application_no;
                })
                ->editColumn('application_master_id', function ($ol_applications) {
                    return $ol_applications->ol_application_master->title;
                })
                ->editColumn('created_at', function ($ol_applications) {
                    return date(config('commanConfig.dateFormat'), strtotime($ol_applications->created_at));
                })
                ->editColumn('status', function ($ol_applications) {
                    $status = explode('_', array_keys(config('commanConfig.applicationStatus'), $ol_applications->olApplicationStatus[0]->status_id)[0]);
                    $status_display = '';
                    foreach($status as $status_value){ $status_display .= ucwords($status_value). ' ';}
                    $status_color = '';
                    if($status_display == 'Sent To Society '){
                        $status_display = 'Approved';
                    }

                    return '<span class="m-badge m-badge--'. config('commanConfig.applicationStatusColor.'.$ol_applications->olApplicationStatus[0]->status_id) .' m-badge--wide">'.$status_display.'</span>';
                })
                ->editColumn('actions', function ($ol_applications) {
                    $status = explode('_', array_keys(config('commanConfig.applicationStatus'), $ol_applications->olApplicationStatus[0]->status_id)[0]);
                    $status_display = '';
                    foreach($status as $status_value){ $status_display .= ucwords($status_value). ' ';}
                    // dd($ol_applications->offer_letter_document_path);
                    return view('frontend.society.actions', compact('ol_applications', 'status_display'))->render();
                })
                ->rawColumns(['application_no', 'application_master_id', 'created_at','status','actions'])
                ->make(true);
        }

        $html = $datatables->getHtmlBuilder()->columns($columns)->parameters($this->getParameters());
        return view('frontend.society.conveyance.index', compact('html'));
    }

    protected function getParameters() {
        return [
            'serverSide' => true,
            'processing' => true,
            'ordering'   =>'isSorted',
            "order"=> [5, "desc" ],
            "pageLength" => $this->list_num_of_records_per_page,
            // 'fixedHeader' => [
            //     'header' => true,
            //     'footer' => true
            // ]
            "filter" => [
                'class' => 'test_class'
            ]
        ];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $society_details = SocietyOfferLetter::where('user_id', Auth::user()->id)->first();
        $sc = new SocietyConveyance;
        $fillable_field_names = $sc->getFillable();
        if(in_array('language_id', $fillable_field_names) == true || in_array('society_id', $fillable_field_names) == true){
            $field_name = array_flip($fillable_field_names);
            unset($field_name['language_id'], $field_name['society_id']);
            $fields_names = array_flip($field_name);
            $field_names = array_values($fields_names);
        }
//        $field_names = array_chunk($sc->getFillable(), ceil(count($sc->getFillable()) / 2));
//        $field_names_left = $field_names[0];
//        $field_names_right = $field_names[1];
        $layouts = MasterLayout::all();
//        dd($society_details);
        return view('frontend.society.conveyance.add', compact('layouts', 'field_names', 'society_details'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->file('template')) {
//            dd($request->file('template'));
            $file = $request->file('template');
            $file_name = time() . $file->getFileName() . '.' . $file->getClientOriginalExtension();
            $extension = $request->file('template')->getClientOriginalExtension();
            $request->flash();
            if ($extension == "xls") {
                $time = time();
                $name = File::name(str_replace(' ', '_',$request->file('template')->getClientOriginalName())) . '_' . $time . '.' . $extension;
                $folder_name = "society_conveyance_documents";
                $path = config('commanConfig.storage_server') . '/' . $folder_name . '/' . $name;
                $fileUpload = $this->CommonController->ftpFileUpload($folder_name, $request->file('template'), $name);
                $count = 0;
                $sc_excel_headers = [];
                Excel::load($request->file('template')->getRealPath(), function ($reader)use(&$count, &$sc_excel_headers) {
                    if(count($reader->toArray()) > 0){
                        $excel_headers = $reader->first()->keys()->toArray();
                        $sc_excel_headers = config('commanConfig.sc_excel_headers');

                        foreach($excel_headers as $excel_headers_key => $excel_headers_val){
                            $excel_headers_value = strtolower(str_replace(str_split('\\/- '), '_', $sc_excel_headers[$excel_headers_key]));
                            if($excel_headers_value == $excel_headers_val){
                                $count++;
                            }else{
                                $exploded = explode('_', $excel_headers_value);
                                foreach($exploded as $exploded_key => $exploded_value){
                                    if(!empty(strpos($excel_headers_val, $exploded_value))){
                                        $count++;
                                    }
                                }
                            }
                        }
                    }
                });

                if($count != 0){
                    if($count == count($sc_excel_headers)){
                        $input = $request->all();
                        unset($input['layout_id'], $input['template'], $input['_token']);
                        $sc_id = SocietyConveyance::updateOrCreate($input);

                        return redirect()->route('society_conveyance.index');
                    }else{
                        return redirect()->route('society_conveyance.create')->withErrors('error', "Excel file headers doesn't match")->withInput();
                    }
                }else{
                    dd('empty');
                    return redirect()->route('society_conveyance.create')->withErrors('error', "Excel file is empty.")->withInput();
                }
            }
        }else{
            return redirect()->route('society_conveyance.create')->withErrors('error', "Excel file headers doesn't match")->withInput();
        }
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

    /**
     * Download excel.
     *
     * @param  void
     * @return \Illuminate\Http\Response
     */
    public function download_excel()
    {
        $headers = config('commanConfig.sc_excel_headers');
        Excel::create('society_details', function($excel) use ($headers){
            $excel->sheet('Sheet 1', function($sheet) use($headers) {
                $sheet->fromArray($headers);
            });
        })->export('xls');
        return redirect()->route('society_conveyance.create');
    }
}
