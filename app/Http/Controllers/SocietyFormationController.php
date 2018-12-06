<?php

namespace App\Http\Controllers;

use App\conveyance\scApplicationType;
use App\conveyance\SfApplication;
use App\conveyance\SfDocumentStatus;
use App\conveyance\SocietyConveyanceDocumentMaster;
use App\Http\Controllers\Common\CommonController;
use App\Http\Controllers\conveyance\conveyanceCommonController;
use App\Http\Requests\conveyence\SfApplicationRequest;
use App\LayoutUser;
use App\MasterLayout;
use App\Role;
use App\RoleUser;
use App\SocietyOfferLetter;
use App\User;
use Auth;
use Illuminate\Http\Request;

use Yajra\DataTables\DataTables;
use Storage;
use Mpdf\Mpdf;

class SocietyFormationController extends Controller
{
    public function __construct()
    {
        $this->CommonController = new CommonController();
        $this->conveyance_common = new conveyanceCommonController();
        $this->list_num_of_records_per_page = config('commanConfig.list_num_of_records_per_page');
    }

    public function index(Request $request)
    {
        
        $disabled=1;
        $society = SocietyOfferLetter::where('user_id', Auth::user()->id)->first();
        //dd($society);
        $sf_application = SfApplication::where('society_id', $society->id)->with(['scApplicationType', 'sfApplicationLog' => function ($q) {
            $q->where('user_id', Auth::user()->id)
            ->where('role_id', session()->get('role_id'))->orderBy('id', 'desc')->first();
            //$q->where('society_flag', '1')->orderBy('id', 'desc')->first();
        }])->orderBy('id', 'desc')->first();
        //dd($sf_application);
        if($sf_application)
        {
            if($request->print)
            {
                //return view('frontend.society.society_formation.print_application',compact('sf_application'));
                $content = view('frontend.society.society_formation.print_application',compact('sf_application'));
                $folder_name = 'society_formation_certificate';

                $header_file = view('admin.REE_department.offer_letter_header');
                $footer_file = view('admin.REE_department.offer_letter_footer');
                //$pdf = \App::make('dompdf.wrapper');
                $fileName=time() . 'society_formation_certificate.pdf';
                $pdf=new Mpdf([
                    'default_font_size' => 9,
                    'default_font' => 'Times New Roman'
                ]);
                $pdf->autoScriptToLang = true;
                $pdf->autoLangToFont = true;
                $pdf->setAutoBottomMargin = 'stretch';
                $pdf->setAutoTopMargin = 'stretch';
                $pdf->SetHTMLHeader($header_file);
                $pdf->SetHTMLFooter($footer_file);
                $pdf->WriteHTML($content);
                $pdf->Output($fileName, 'D');
            }
            if($sf_application->sfApplicationLog!="")
            {
                if($sf_application->sfApplicationLog->status_id==config('commanConfig.applicationStatus.in_process'))
                {
                    $disabled=0;
                }
                $id = $sf_application->id;
                $sf_documents = SocietyConveyanceDocumentMaster::with(['sf_document_status' => function ($q) use ($id) {
                    return $q->where(['application_id' => $id]);
                }])->where(['application_type_id' => 3])->get();
                //dd($sf_documents);
                $sf_application = SfApplication::find($id);
                return view('frontend.society.society_formation.sf_application', compact('sf_application', 'sf_documents','disabled'));    
    
            }else
            {
                return redirect()->route('society_formation.view_application',['id'=>encrypt($sf_application->id)]);
            }
        }else
        {
            return redirect()->route('society_formation.create');
        }
    }

    public function list(Request $request,DataTables $datatables)
    {
        $society = SocietyOfferLetter::where('user_id', Auth::user()->id)->first();
        $sf_application = SfApplication::where('society_id', $society->id)->with(['scApplicationType', 'sfApplicationLog' => function ($q) {
            $q->where('society_flag', '1')->orderBy('id', 'desc')->first();
        }])->orderBy('id', 'desc')->first();
        if($sf_application)
        {
            if($sf_application->sfApplicationLog!="")
            {

            }else
            {
                return redirect()->route('society_formation.view_application',['id'=>encrypt($sf_application->id)]);
            }
        }else
        {
            return redirect()->route('society_formation.create');
        }



        $columns = [
            // ['data' => 'radio','name' => 'radio','title' => '','searchable' => false],
            ['data' => 'rownum','name' => 'rownum','title' => 'Sr No.','searchable' => false],
            ['data' => 'application_no','name' => 'application_no','title' => 'Application No.'],
            ['data' => 'application_master_id','name' => 'application_master_id','title' => 'Application Type'],
            ['data' => 'created_at','name' => 'created_date','title' => 'Submission Date', 'class' => 'datatable-date'],
            ['data' => 'status','name' => 'status','title' => 'Status'],
            ['data' => 'action','name' => 'action','title' => 'Action']
        ];
        $getRequest = $request->all();
        $society_details = SocietyOfferLetter::where('user_id', Auth::user()->id)->first();
        if ($datatables->getRequest()->ajax()) {
            $sf_applications = SfApplication::where('society_id', $society_details->id)->with(['scApplicationType' => function($q){
                $q->where('application_type', config('commanConfig.applicationType.Formation'))->first();
            }, 'sfApplicationLog' => function($q){
                $q->where('user_id', Auth::user()->id)
                ->where('role_id', session()->get('role_id'))->orderBy('id', 'desc')->first();
                //$q->where('society_flag', '1')->orderBy('id', 'desc')->first();
            } ])->orderBy('id', 'desc');

            if($request->application_master_id)
            {
                $sf_applications = $sf_applications->where('application_master_id', 'like', '%'.$request->application_master_id.'%');
            }
            $sf_applications = $sf_applications->get();

            return $datatables->of($sf_applications)
                // ->editColumn('radio', function ($sf_applications) {
                //     $url = route('society_formation.index');
                //     return '<label class="m-radio m-radio--primary m-radio--link"><input type="radio" onclick="geturl(this.value);" value="'.$url.'" name="sf_applications_id"><span></span></label>';
                // })
                ->editColumn('rownum', function ($sf_applications) {
                    static $i = 0;
                    $i++;
                    return $i;
                })
                ->editColumn('application_no', function ($sf_applications) {
                    return $sf_applications->application_no;
                })
                ->editColumn('application_master_id', function ($sf_applications) {
                    return $sf_applications->scApplicationType->application_type;
                })
                ->editColumn('created_at', function ($sf_applications) {
                    return date(config('commanConfig.dateFormat'), strtotime($sf_applications->created_at));
                })
                ->editColumn('status', function ($sf_applications) {
                    $status=  $sf_applications->sfApplicationLog->status_id;
                    $status_display = array_keys(config('commanConfig.applicationStatus'), $sf_applications->sfApplicationLog->status_id)[0];
                    return '<span class="m-badge m-badge--'. config('commanConfig.applicationStatusColor.'.$status) .' m-badge--wide">'.$status_display.'</span>';
                })
                ->editColumn('action', function ($sf_applications) {
                    $action_parm="<div class='d-flex btn-icon-list'>";
                    $action_parm.='<a class="d-flex flex-column align-items-center" href="'.route('society_formation.index').'"><span class="btn-icon btn-icon--view">
                        <img src="'. asset('/img/view-icon.svg').'">
                    </span>View
                </a>';
                if($sf_applications->no_due_certificate!="")
                    {
                        $action_parm=$action_parm.'<a target="_blank" class="d-flex flex-column align-items-center delete-village" href="'.config('commanConfig.storage_server')."/".$sf_applications->no_due_certificate.'">
                    <span class="btn-icon btn-icon--delete">
                        <img src="'.asset('/img/download-icon.svg').'">
                     </span>no due certificate
                    </a>';
                    }
                    $action_parm.="</div>";
                    return $action_parm;
                })
                ->rawColumns(['application_no', 'application_master_id', 'created_at','status','action'])
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
            "order"=> [3, "desc" ],
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

    public function create()
    {
        $society_details = SocietyOfferLetter::where('user_id', Auth::user()->id)->first();
        $sc_application_master_id = scApplicationType::where(['application_type' => config('commanConfig.applicationType.Formation')])->value('id');
        //dd($society_details);
        $layouts = MasterLayout::all();
        $getPreviousScApplicationData = SfApplication::where(['society_id'=>$society_details->id])->first();
        //dd($getPreviousScApplicationData);
        $sc = new SfApplication;
        $fillable_field_names = $sc->getFillable();
        if (in_array('language_id', $fillable_field_names) == true || in_array('society_id', $fillable_field_names) == true) {
            $field_name = array_flip($fillable_field_names);
            unset($field_name['language_id'], $field_name['society_id'], $field_name['template_file']);
            $fields_names = array_flip($field_name);
            $field_names = array_values($fields_names);
        }
        $comm_func = $this->CommonController;
        return view('frontend.society.society_formation.index', compact('getPreviousScApplicationData', 'sc_application_master_id', 'layouts', 'society_details', 'field_names', 'comm_func'));
    }

    public function store(SfApplicationRequest $request)
    {
        //return $request->all();
        $SfApplication = SfApplication::find($request->sf_application_id);
        if ($SfApplication) {
            $SfApplication->proposed_society_name = $request->proposed_society_name;
            $SfApplication->save();
        } else {
            $SfApplication = new SfApplication;
            $SfApplication->layout_id = $request->layout_id;
            $SfApplication->society_id = $request->society_id;
            $SfApplication->sc_application_master_id = $request->sc_application_master_id;
            $SfApplication->society_name = $request->society_name;
            $SfApplication->proposed_society_name = $request->proposed_society_name;
            $SfApplication->building_no = $request->building_no;
            $SfApplication->save();
            $SfApplication=SfApplication::find($SfApplication->id);
            $SfApplication->application_no=config('commanConfig.mhada_code').str_pad($SfApplication->id, 5, '0', STR_PAD_LEFT);
            $SfApplication->save();
        }

        if ($SfApplication) {
            return redirect()->route('society_formation.view_application', ['id' => encrypt($SfApplication->id)]);
        } else {
            return back()->withError('Something went wrong');
        }
    }

    public function view_application(Request $request,$id)
    {
        //dd($request->all());
        $id = decrypt($id);
        $sf_documents = SocietyConveyanceDocumentMaster::with(['sf_document_status' => function ($q) use ($id) {
            return $q->where(['application_id' => $id]);
        }])->where(['application_type_id' => 3])->get();
        
        $sf_application = SfApplication::find($id);
        return view('frontend.society.society_formation.sf_application', compact('sf_application', 'sf_documents'));
    }

    public function upload_sf_application_attachment(Request $request)
    {
        //return $request->file('file');
        $response_array = array();
        $file = $request->file('file');
        if ($file->getClientMimeType() == 'application/pdf') {
            $has_file_name = SfDocumentStatus::where(['id' => $request->document_status_id, 'application_id' => $request->sf_application_id])->first();
            $extension = $request->file('file')->getClientOriginalExtension();
            $dir = 'sf_applications';
            if ($has_file_name) {
                $filename = explode('/', $has_file_name->document_path);
                $filename = $filename[1];
            } else {
                $filename = uniqid() . '_' . time() . '_' . date('Ymd') . '.' . $extension;
            }
            $storage = Storage::disk('ftp')->putFileAs($dir, $request->file('file'), $filename);
            if ($storage) {
                $SfDocumentStatus = SfDocumentStatus::where(['id' => $request->document_status_id, 'application_id' => $request->sf_application_id])->first();
                if ($SfDocumentStatus) {
                    $SfDocumentStatus->document_path = $storage;
                    $SfDocumentStatus->application_id = $request->sf_application_id;
                    $SfDocumentStatus->user_id = auth()->user()->id;
                    $SfDocumentStatus->society_flag = 1;
                    $SfDocumentStatus->document_id = $request->master_document_id;
                } else {
                    $SfDocumentStatus = new SfDocumentStatus;
                    $SfDocumentStatus->document_path = $storage;
                    $SfDocumentStatus->application_id = $request->sf_application_id;
                    $SfDocumentStatus->user_id = auth()->user()->id;
                    $SfDocumentStatus->society_flag = 1;
                    $SfDocumentStatus->document_id = $request->master_document_id;
                }

                $SfDocumentStatus->save();
                $response_array = array(
                    'status' => true,
                    'file_path' => config('commanConfig.storage_server') . "/" . $storage,
                    'doc_id' => $SfDocumentStatus->id,
                );
            } else {
                $response_array = array(
                    'status' => false,
                );
            }
        } else {
            $response_array = array(
                'status' => false,
                'message' => 'PDF file is required',
            );
        }

        return response()->json($response_array);
    }

    public function sf_submit_application(Request $request)
    {
        $society = SocietyOfferLetter::where('user_id', Auth::user()->id)->first();
        $sf_application = SfApplication::where('society_id', $society->id)->with(['scApplicationType', 'sfApplicationLog' => function ($q) {
            $q->where('society_flag', '1')->orderBy('id', 'desc')->first();
        }])->orderBy('id', 'desc')->first();
        $role_id = Role::where('name', config('commanConfig.dycdo_engineer'))->first();
        $user_ids = RoleUser::where('role_id', $role_id->id)->get();
        $layout_user_ids = LayoutUser::where('layout_id', $sf_application->layout_id)->whereIn('user_id', $user_ids)->get();

        foreach ($layout_user_ids as $key => $value) {
            $select_user_ids[] = $value['user_id'];
        }

        $users = User::whereIn('id', $select_user_ids)->get();
        if (count($users) > 0) {
            $insert_arr = array(
                'users' => $users,
            );
            $inserted_application_log = $this->CommonController->sf_application_status_society($insert_arr, config('commanConfig.applicationStatus.forwarded'), $sf_application);
        }
        return redirect()->route('society_formation.index');
    }

}
