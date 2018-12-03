<?php

namespace App\Http\Controllers\ArchitectLayout;

use App\Http\Controllers\Common\CommonController;
use App\Http\Controllers\Controller;
use App\Http\Requests\ArchitectLayout\AddLayout;
use App\Layout\ArchitectLayout;
use App\Layout\ArchitectLayoutDetail;
use App\Layout\ArchitectLayoutEEScrtinyQuestionDetail;
use App\Layout\ArchitectLayoutEmScrtinyQuestionDetail;
use App\Layout\ArchitectLayoutLmScrtinyQuestionDetail;
use App\Layout\ArchitectLayoutReeScrtinyQuestionDetail;
use App\Layout\ArchitectLayoutScrutinyEEReport;
use App\Layout\ArchitectLayoutScrutinyEMReport;
use App\Layout\ArchitectLayoutScrutinyLandReport;
use App\Layout\ArchitectLayoutScrutinyREEReport;
use App\Layout\PrepareLayoutExcelLog;
use App\Role;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Storage;
use Yajra\DataTables\DataTables;

class LayoutArchitectController extends Controller
{
    protected $architect_layouts;
    public function __construct(CommonController $CommonController)
    {
        $this->list_num_of_records_per_page = Config('commanConfig.list_num_of_records_per_page');
        $this->architect_layouts = $CommonController;
    }

    public function index(Request $request, Datatables $datatables)
    {
        $getData = $request->all();
        //return $this->architect_layouts->architect_layout_data($request);
        $columns = [
            // ['data' => 'radio', 'name' => 'radio', 'title' => '', 'searchable' => false],
            ['data' => 'rownum', 'name' => 'rownum', 'title' => 'Sr No.', 'searchable' => false],
            ['data' => 'layout_no', 'name' => 'layout_no', 'title' => 'Layout No'],
            ['data' => 'date', 'name' => 'date', 'title' => 'Date'],
            ['data' => 'layout_name', 'name' => 'layout_name', 'title' => 'Layout Name', 'class' => 'datatable-date'],
            ['data' => 'address', 'name' => 'address', 'title' => 'Layout Address'],
            ['data' => 'Status', 'name' => 'Status', 'title' => 'Status'],
            ['data' => 'view', 'name' => 'view', 'title' => 'Action']
        ];
        $this->architect_layouts->architect_layout_request_revision($request);
        if ($datatables->getRequest()->ajax()) {

            $architect_layout_data = $this->architect_layouts->architect_layout_request_revision($request);
            $revision_requests = $architect_layout_data;
            return $datatables->of($revision_requests)
                ->editColumn('radio', function ($listArray) {
                    $url = route('architect_layout_details.view', encrypt($listArray->id));
                    return '<label class="m-radio m-radio--primary m-radio--link"><input type="radio" onclick="geturl(this.value);" value="' . $url . '" name="village_data_id"><span></span></label>';
                })
                ->editColumn('rownum', function ($listArray) {
                    static $i = 0; $i++;return $i;
                })
                ->editColumn('layout_no', function ($listArray) {
                    return $listArray->layout_no;
                })
                ->editColumn('date', function ($listArray) {
                    return date('d/m/Y', strtotime($listArray->added_date));
                })
                ->editColumn('layout_name', function ($listArray) {
                    return $listArray->layout_name;
                })
                ->editColumn('address', function ($listArray) {
                    return $listArray->address;
                })
                ->editColumn('Status', function ($listArray) use ($request) {
                    $status = $listArray->ArchitectLayoutStatusLogInListing[0]->status_id;
                    $config_array = array_flip(config('commanConfig.architect_layout_status'));
                    $value = ucwords(str_replace('_', ' ', $config_array[$status]=='forward'?'forwarded':$config_array[$status]));
                    return '<span class="m-badge m-badge--' . config('commanConfig.architect_layout_status_color.' . $status) . ' m-badge--wide">' . $value . '</span>';
                    // $config_array = array_flip(config('commanConfig.architect_layout_status'));
                    // return $value = ucwords(str_replace('_', ' ', $config_array[$status]));

                })
                ->editColumn('added_date', function ($listArray) {
                    return date(config('commanConfig.dateFormat'), strtotime($listArray->added_date));
                })
                ->editColumn('view', function ($listArray){
                    return view('admin.architect_layout.view_application_page', compact('listArray'))->render();
               })
            // ->editColumn('actions', function ($ee_application_data) use($request) {
            //     return view('admin.ee_department.actions', compact('ee_application_data', 'request'))->render();
            // })
                ->rawColumns(['radio', 'layout_no', 'added_date', 'layout_name', 'address', 'Status', 'view'])
                ->make(true);
        }

        $html = $datatables->getHtmlBuilder()->columns($columns)->parameters($this->getParameters());

        return view('admin.architect_layout.index', compact('html', 'header_data', 'getData'));
    }

    public function architect_layouts_layout_details(Request $request, Datatables $datatables)
    {
        $getData = $request->all();
        //return $this->architect_layouts->architect_layout_data($request);
        $columns = [
            // ['data' => 'radio', 'name' => 'radio', 'title' => '', 'searchable' => false],
            ['data' => 'rownum', 'name' => 'rownum', 'title' => 'Sr No.', 'searchable' => false],
            ['data' => 'layout_no', 'name' => 'layout_no', 'title' => 'Layout No'],
            ['data' => 'date', 'name' => 'date', 'title' => 'Date'],
            ['data' => 'layout_name', 'name' => 'layout_name', 'title' => 'Layout Name', 'class' => 'datatable-date'],
            ['data' => 'address', 'name' => 'address', 'title' => 'Layout Address'],
            ['data' => 'Status', 'name' => 'Status', 'title' => 'Status'],
            ['data' => 'view', 'name' => 'view', 'title' => 'Action']
        ];
        //$this->architect_layouts->architect_layout_details($request);
        if ($datatables->getRequest()->ajax()) {

            $architect_layout_data = $this->architect_layouts->architect_layout_details($request);
            $layout_details = $architect_layout_data;
            return $datatables->of($layout_details)
                // ->editColumn('radio', function ($listArray) {
                //     $url = route('architect_layout_details.view', encrypt($listArray->id));
                //     return '<label class="m-radio m-radio--primary m-radio--link"><input type="radio" onclick="geturl(this.value);" value="' . $url . '" name="village_data_id"><span></span></label>';
                // })
                ->editColumn('rownum', function ($listArray) {
                    static $i = 0; $i++;return $i;
                })
                ->editColumn('layout_no', function ($listArray) {
                    return $listArray->layout_no;
                })
                ->editColumn('date', function ($listArray) {
                    return date('d/m/Y', strtotime($listArray->added_date));
                })
                ->editColumn('layout_name', function ($listArray) {
                    return $listArray->layout_name;
                })
                ->editColumn('address', function ($listArray) {
                    return $listArray->address;
                })
                ->editColumn('Status', function ($listArray) use ($request) {
                    $status = $listArray->ArchitectLayoutStatusLogInListing[0]->status_id;
                    $config_array = array_flip(config('commanConfig.architect_layout_status'));
                    $value = ucwords(str_replace('_', ' ', $config_array[$status]=='forward'?'forwarded':$config_array[$status]));
                    return '<span class="m-badge m-badge--' . config('commanConfig.architect_layout_status_color.' . $status) . ' m-badge--wide">' . $value . '</span>';
                    // $config_array = array_flip(config('commanConfig.architect_layout_status'));
                    // return $value = ucwords(str_replace('_', ' ', $config_array[$status]));

                })
                ->editColumn('added_date', function ($listArray) {
                    return date(config('commanConfig.dateFormat'), strtotime($listArray->added_date));
                })
                ->editColumn('view', function ($listArray){
                    return view('admin.architect_layout.view_application_page', compact('listArray'))->render();
               })
            // ->editColumn('actions', function ($ee_application_data) use($request) {
            //     return view('admin.ee_department.actions', compact('ee_application_data', 'request'))->render();
            // })
                ->rawColumns(['layout_no', 'added_date', 'layout_name', 'address', 'Status', 'view'])
                ->make(true);
        }

        $html = $datatables->getHtmlBuilder()->columns($columns)->parameters($this->getParameters());

        return view('admin.architect_layout.index', compact('html', 'header_data', 'getData'));
    }

    public function genRand()
    {
        return time() . rand(100000, 999999);
    }

    protected function getParameters()
    {
        return [
            'serverSide' => true,
            'processing' => true,
            'ordering' => 'isSorted',
            "order" => [0, "asc"],
            "pageLength" => $this->list_num_of_records_per_page,
        ];
    }

    public function add_layout()
    {
        return view('admin.architect_layout.add', compact('header_data'));
    }

    public function store_layout(AddLayout $request)
    {
        $layout_data = array(
            //'layout_no' => $this->genRand(),
            'layout_name' => $request->layout_name,
            'address' => $request->layout_address,
            'added_date' => Carbon::now(),
        );
        $ArchitectLayout = ArchitectLayout::create($layout_data);
        $ArchitectLayout->layout_no=str_pad($ArchitectLayout->id, 5, '0', STR_PAD_LEFT);
        $ArchitectLayout->save();
        if ($ArchitectLayout) {
            $ArchitectLayoutDetail = new ArchitectLayoutDetail;
            $ArchitectLayoutDetail->architect_layout_id = $ArchitectLayout->id;
            $ArchitectLayoutDetail->save();
            $forward_application = [
                [
                    'architect_layout_id' => $ArchitectLayout->id,
                    'user_id' => auth()->user()->id,
                    'role_id' => session()->get('role_id'),
                    'status_id' => config('commanConfig.architect_layout_status.new_application'),
                    'to_user_id' => null,
                    'to_role_id' => null,
                    'open' => 1,
                    'remark' => null,
                ],
            ];
            $this->architect_layouts->forward_architect_layout($ArchitectLayout->id, $forward_application);
            return redirect(route('architect_layout_detail.edit', ['layout_detail_id' => encrypt($ArchitectLayoutDetail->id)]));
        }
        return back()->withError('something went wrong');
    }

    public function view_architect_layout_details($layout_id)
    {
        $layout_id = decrypt($layout_id);
        $check_layout_details_complete_status = count($this->architect_layouts->check_layout_details_complete_status($layout_id));
        $ArchitectLayout = ArchitectLayout::find($layout_id);
        $ArchitectLayoutDetail = ArchitectLayoutDetail::where(['architect_layout_id' => $layout_id])->orderBy('id', 'desc')->get();
        return view('admin.architect_layout_detail.view', compact('ArchitectLayout', 'ArchitectLayoutDetail', 'check_layout_details_complete_status'));
    }

    public function forwardLayout(Request $request, $layout_id)
    {
        $architectlogs = array();
        $layout_id = decrypt($layout_id);
        $ArchitectLayout = ArchitectLayout::with(['layout_details'])->find($layout_id);
        $parentData = $this->architect_layouts->getForwardApplicationArchitectParentData();
        $arrData['parentData'] = $parentData['parentData'];
        $arrData['role_name'] = $parentData['role_name'];
        $architectlogs = $this->architect_layouts->getLogOfArchitectLayoutApplication($layout_id);
        $Emlogs = $this->architect_layouts->getLogOfEmLayoutApplication($layout_id);
        $Lmlogs = $this->architect_layouts->getLogOfLmLayoutApplication($layout_id);
        $EElogs = $this->architect_layouts->getLogOfEELayoutApplication($layout_id);
        $Reelogs = $this->architect_layouts->getLogOfReeLayoutApplication($layout_id);
        $Cologs = $this->architect_layouts->getLogOfCoLayoutApplication($layout_id);
        $Saplogs = $this->architect_layouts->getLogOfSapLayoutApplication($layout_id);
        $Caplogs = $this->architect_layouts->getLogOfCapLayoutApplication($layout_id);
        $LAlogs = $this->architect_layouts->getLogOfLALayoutApplication($layout_id);
        $VPlogs = $this->architect_layouts->getLogOfVPLayoutApplication($layout_id);
        // dd($ArchitectLayout->land_scrutiny_checklist_and_remarks);
        if (session()->get('role_name') == config('commanConfig.architect')) {
            //if (!$ArchitectLayout->land_scrutiny_checklist_and_remarks) {
            if ($ArchitectLayout->upload_layout_in_pdf_format == "" && $ArchitectLayout->upload_layout_in_excel_format == "" && $ArchitectLayout->upload_architect_note == "") {
                if (session()->get('role_name') != config('commanConfig.LM')) {
                    $lm_role_id = Role::where('name', '=', config('commanConfig.land_manager'))->first();
                    $arrData['get_forward_lm'] = User::where('role_id', $lm_role_id->id)->get();
                    $arrData['lm_role_name'] = strtoupper(str_replace('_', ' ', $lm_role_id->name));
                }
            }
            //}

            if (session()->get('role_name') != config('commanConfig.ree_junior')) {
                $ree_role_id = Role::where('name', '=', config('commanConfig.ree_junior'))->first();
                $arrData['get_forward_ree'] = User::where('role_id', $ree_role_id->id)->get();
                $arrData['ree_role_name'] = strtoupper(str_replace('_', ' ', $ree_role_id->name));
            }
            // if (!$ArchitectLayout->ee_scrutiny_checklist_and_remarks) {
            if ($ArchitectLayout->upload_layout_in_pdf_format == "" && $ArchitectLayout->upload_layout_in_excel_format == "" && $ArchitectLayout->upload_architect_note == "") {
                if (session()->get('role_name') != config('commanConfig.ee_junior_engineer')) {
                    $ee_role_id = Role::where('name', '=', config('commanConfig.ee_junior_engineer'))->first();
                    $arrData['get_forward_ee'] = User::where('role_id', $ee_role_id->id)->get();
                    $arrData['ee_role_name'] = strtoupper(str_replace('_', ' ', $ee_role_id->name));
                }
            }
            // }
            //if (!$ArchitectLayout->em_scrutiny_checklist_and_remarks) {
            if ($ArchitectLayout->upload_layout_in_pdf_format == "" && $ArchitectLayout->upload_layout_in_excel_format == "" && $ArchitectLayout->upload_architect_note == "") {
                if (session()->get('role_name') != config('commanConfig.estate_manager')) {
                    $em_role_id = Role::where('name', '=', config('commanConfig.estate_manager'))->first();
                    $arrData['get_forward_em'] = User::where('role_id', $em_role_id->id)->get();
                    $arrData['em_role_name'] = strtoupper(str_replace('_', ' ', $em_role_id->name));
                }
            }
            //}

        }
        if (session()->get('role_name') == config('commanConfig.land_manager') ||
            session()->get('role_name') == config('commanConfig.estate_manager') ||
            session()->get('role_name') == config('commanConfig.ree_branch_head') ||
            session()->get('role_name') == config('commanConfig.ee_branch_head')) {
            if (session()->get('role_name') == config('commanConfig.ree_branch_head')) {

                if ($ArchitectLayout->upload_layout_in_pdf_format == "" && $ArchitectLayout->upload_layout_in_excel_format == "" && $ArchitectLayout->upload_architect_note == "") {
                    if (session()->get('role_name') != config('commanConfig.junior_architect')) {
                        $lm_role_id = Role::where('name', '=', config('commanConfig.junior_architect'))->first();
                        $arrData['get_forward_lm'] = User::where('role_id', $lm_role_id->id)->get();
                        $arrData['lm_role_name'] = strtoupper(str_replace('_', ' ', $lm_role_id->name));
                    }
                } else {
                    if (session()->get('role_name') != config('commanConfig.co_engineer')) {
                        $co_role_id = Role::where('name', '=', config('commanConfig.co_engineer'))->first();
                        $arrData['get_forward_co'] = User::where('role_id', $co_role_id->id)->get();
                        $arrData['co_role_name'] = strtoupper(str_replace('_', ' ', $co_role_id->name));
                    }
                }

            } else {
                if (session()->get('role_name') != config('commanConfig.junior_architect')) {
                    $lm_role_id = Role::where('name', '=', config('commanConfig.junior_architect'))->first();
                    $arrData['get_forward_lm'] = User::where('role_id', $lm_role_id->id)->get();
                    $arrData['lm_role_name'] = strtoupper(str_replace('_', ' ', $lm_role_id->name));
                }
            }

        }

        if (session()->get('role_name') == config('commanConfig.co_engineer')) {
            if (session()->get('role_name') != config('commanConfig.senior_architect_planner')) {
                $sap_role_id = Role::where('name', '=', config('commanConfig.senior_architect_planner'))->first();
                //dd(config('commanConfig.senior_architect_planner'));
                $arrData['get_forward_sap'] = User::where('role_id', $sap_role_id->id)->get();
                $arrData['sap_role_name'] = strtoupper(str_replace('_', ' ', $sap_role_id->name));
            }
        }

        if (session()->get('role_name') == config('commanConfig.senior_architect_planner')) {
            if (session()->get('role_name') != config('commanConfig.cap_engineer')) {
                $cap_role_id = Role::where('name', '=', config('commanConfig.cap_engineer'))->first();
                $arrData['get_forward_cap'] = User::where('role_id', $cap_role_id->id)->get();
                $arrData['cap_role_name'] = strtoupper(str_replace('_', ' ', $cap_role_id->name));
            }
        }

        if (session()->get('role_name') == config('commanConfig.cap_engineer')) {
            if (session()->get('role_name') != config('commanConfig.vp_engineer')) {
                $vp_role_id = Role::where('name', '=', config('commanConfig.vp_engineer'))->first();
                $arrData['get_forward_vp'] = User::where('role_id', $vp_role_id->id)->get();
                $arrData['vp_role_name'] = strtoupper(str_replace('_', ' ', $vp_role_id->name));
            }
            if (session()->get('role_name') != config('commanConfig.legal_advisor')) {
                $la_role_id = Role::where('name', '=', config('commanConfig.legal_advisor'))->first();
                $arrData['get_forward_la'] = User::where('role_id', $la_role_id->id)->get();
                $arrData['la_role_name'] = strtoupper(str_replace('_', ' ', $la_role_id->name));
            }
        }

        if (session()->get('role_name') == config('commanConfig.legal_advisor')) {
            if (session()->get('role_name') != config('commanConfig.vp_engineer')) {
                $vp_role_id = Role::where('name', '=', config('commanConfig.vp_engineer'))->first();
                $arrData['get_forward_vp'] = User::where('role_id', $vp_role_id->id)->get();
                $arrData['vp_role_name'] = strtoupper(str_replace('_', ' ', $vp_role_id->name));
            }
        }

        if (session()->get('role_name') == config('commanConfig.vp_engineer')) {
            if (session()->get('role_name') != config('commanConfig.junior_architect')) {
                $jr_architect_role_id = Role::where('name', '=', config('commanConfig.junior_architect'))->first();
                $arrData['get_forward_lm'] = User::where('role_id', $jr_architect_role_id->id)->get();
                $arrData['lm_role_name'] = strtoupper(str_replace('_', ' ', $jr_architect_role_id->name));
            }
        }
        return view('admin.architect_layout.forward_architect_layout', compact('arrData', 'ArchitectLayout', 'architectlogs', 'Emlogs', 'Lmlogs', 'EElogs', 'Reelogs', 'Cologs', 'Saplogs', 'Caplogs', 'LAlogs', 'VPlogs'));
    }

    public function post_forward_layout(Request $request)
    {
        foreach ($request->to_user_id as $user) {
            $user_data = User::find($user);
            if ($user_data) {
                $forward_application[] = [
                    'architect_layout_id' => $request->architect_layout_id,
                    'user_id' => auth()->user()->id,
                    'role_id' => session()->get('role_id'),
                    'status_id' => (session()->get('role_name') == config('commanConfig.vp_engineer')) ? config('commanConfig.architect_layout_status.approved') : config('commanConfig.architect_layout_status.forward'),
                    'to_user_id' => $user,
                    'to_role_id' => $user_data->role_id,
                    'remark' => $request->remark,
                    'open' => 0,
                    'created_at' => Carbon::now(),
                ];
                $forward_application[] = ['architect_layout_id' => $request->architect_layout_id,
                    'user_id' => $user,
                    'role_id' => $user_data->role_id,
                    'status_id' => (session()->get('role_name') == config('commanConfig.vp_engineer')) ? config('commanConfig.architect_layout_status.approved') : config('commanConfig.architect_layout_status.scrutiny_pending'),
                    'to_user_id' => null,
                    'to_role_id' => null,
                    'remark' => '',
                    'open' => 1,
                    'created_at' => Carbon::now()];
            }
        }
        $this->architect_layouts->forward_architect_layout($request->architect_layout_id, $forward_application);
        //ArchitectLayoutStatusLog::insert($forward_application);
        $ArchitectLayout = ArchitectLayout::find($request->architect_layout_id);
        if ($ArchitectLayout) {
            $ArchitectLayout->sent_for_scrutiny_status = 1;
            $ArchitectLayout->save();
        }

        return redirect(route('architect_layout.index'));
    }

    public function get_scrutiny($layout_id)
    {
        $read_only = 0;
        $check_list_and_remarks = array();
        $scrutiny_reports = array();
        $layout_id = decrypt($layout_id);
        $readonly_by_status = 0;

        //get latest detail
        $latest_architect_layout_detail = ArchitectLayoutDetail::where(['architect_layout_id' => $layout_id])->orderBy('id', 'desc')->first();
        $ArchitectLayoutDetail = ArchitectLayout::find($layout_id);
        $status = getLastStatusIdArchitectLayout($layout_id);
        if ($status != "") {
            if ($status->status_id == config('commanConfig.architect_layout_status.forward') ||
                ($status->status_id == config('commanConfig.architect_layout_status.approved'))) {
                $readonly_by_status = 1;
            }
        }
        //get reports uploaded by em
        if (session()->get('role_name') == config('commanConfig.estate_manager')) {
            $scrutiny_reports['architect_layout_em_scrutiny_reports'] = ArchitectLayoutScrutinyEMReport::where(['user_id' => auth()->user()->id, 'architect_layout_id' => $layout_id, 'architect_layout_detail_id' => $latest_architect_layout_detail->id])->get();
            $check_list_and_remarks['em_scrtiny_questions'] = $this->architect_layouts->get_em_checklist_and_remarks($layout_id, auth()->user()->id);
            $post_route_name = route('post_em_checklist_and_remark_report');
            $upload_file_route_name = route('upload_em_checklist_and_remark_report');
            $check_list_and_remarks = $check_list_and_remarks['em_scrtiny_questions'];

            if ($ArchitectLayoutDetail->upload_layout_in_pdf_format != "" && $ArchitectLayoutDetail->upload_layout_in_excel_format != "" && $ArchitectLayoutDetail->upload_architect_note != "") {
                $read_only = 1;
            } else {
                if ($readonly_by_status == 1) {
                    $read_only = 1;
                } else {
                    $read_only = 0;
                }

            }
        }

        //get reports uploaded by lm
        if (session()->get('role_name') == config('commanConfig.land_manager')) {
            $check_list_and_remarks['lm_scrtiny_questions'] = $this->architect_layouts->get_lm_checklist_and_remarks($layout_id, auth()->user()->id);
            $scrutiny_reports['architect_layout_land_scrutiny_reports'] = ArchitectLayoutScrutinyLandReport::where(['user_id' => auth()->user()->id, 'architect_layout_id' => $layout_id, 'architect_layout_detail_id' => $latest_architect_layout_detail->id])->get();
            $post_route_name = route('post_lm_checklist_and_remark_report');
            $upload_file_route_name = route('upload_lm_checklist_and_remark_report');
            $check_list_and_remarks = $check_list_and_remarks['lm_scrtiny_questions'];
            if ($ArchitectLayoutDetail->upload_layout_in_pdf_format != "" && $ArchitectLayoutDetail->upload_layout_in_excel_format != "" && $ArchitectLayoutDetail->upload_architect_note != "") {

                $read_only = 1;
            } else {

                if ($readonly_by_status == 1) {
                    $read_only = 1;
                } else {
                    $read_only = 0;
                }

            }
        }

        //get reports uploaded by ee
        if (session()->get('role_name') == config('commanConfig.ee_junior_engineer') ||
            session()->get('role_name') == config('commanConfig.ee_deputy_engineer') ||
            session()->get('role_name') == config('commanConfig.ee_branch_head')) {
            //dd(session()->get('role_name'));
            $check_list_and_remarks['ee_scrtiny_questions'] = $this->architect_layouts->get_ee_checklist_and_remarks($layout_id, auth()->user()->id);
            //$scrutiny_reports['architect_layout_ee_scrutiny_reports'] = ArchitectLayoutScrutinyEEReport::where(['user_id' => auth()->user()->id, 'architect_layout_id' => $layout_id])->get();
            $scrutiny_reports['architect_layout_ee_scrutiny_reports'] = ArchitectLayoutScrutinyEEReport::where(['architect_layout_id' => $layout_id, 'architect_layout_detail_id' => $latest_architect_layout_detail->id])->get();
            $post_route_name = route('post_ee_checklist_and_remark_report');
            $upload_file_route_name = route('upload_ee_checklist_and_remark_report');
            $check_list_and_remarks = $check_list_and_remarks['ee_scrtiny_questions'];
            if (session()->get('role_name') == config('commanConfig.ee_junior_engineer')) {
                if ($ArchitectLayoutDetail->upload_layout_in_pdf_format != "" && $ArchitectLayoutDetail->upload_layout_in_excel_format != "" && $ArchitectLayoutDetail->upload_architect_note != "") {
                    $read_only = 1;
                } else {
                    if ($readonly_by_status == 1) {
                        $read_only = 1;
                    } else {
                        $read_only = 0;
                    }

                }
            } else {
                $read_only = 1;
            }
        }

        //get reports uploaded by ree
        if (session()->get('role_name') == config('commanConfig.ree_junior') ||
            session()->get('role_name') == config('commanConfig.ree_deputy_engineer') ||
            session()->get('role_name') == config('commanConfig.ree_assistant_engineer') ||
            session()->get('role_name') == config('commanConfig.ree_branch_head')) {
            $check_list_and_remarks['ree_scrtiny_questions'] = $this->architect_layouts->get_ree_checklist_and_remarks($layout_id, auth()->user()->id);
            $scrutiny_reports['architect_layout_ree_scrutiny_reports'] = ArchitectLayoutScrutinyReeReport::where(['architect_layout_id' => $layout_id, 'architect_layout_detail_id' => $latest_architect_layout_detail->id])->get();
            $post_route_name = route('post_ree_checklist_and_remark_report');
            $upload_file_route_name = route('upload_ree_checklist_and_remark_report');
            $check_list_and_remarks = $check_list_and_remarks['ree_scrtiny_questions'];
            if (session()->get('role_name') == config('commanConfig.ree_junior')) {
                if ($ArchitectLayoutDetail->upload_layout_in_pdf_format != "" && $ArchitectLayoutDetail->upload_layout_in_excel_format != "" && $ArchitectLayoutDetail->upload_architect_note != "") {
                    $read_only = 1;
                } else {
                    if ($readonly_by_status == 1) {
                        $read_only = 1;
                    } else {
                        $read_only = 0;
                    }

                }
            } else {
                $read_only = 1;
            }
        }

        $ArchitectLayout = ArchitectLayout::find($layout_id);

        return view('admin.architect_layout.scrutiny', compact('read_only', 'ArchitectLayout', 'scrutiny_reports', 'check_list_and_remarks', 'post_route_name', 'upload_file_route_name'));
    }

    public function add_scrutiny_report($layout_id)
    {
        $layout_id = decrypt($layout_id);

        $ArchitectLayout = ArchitectLayout::find($layout_id);
        return view('admin.architect_layout.add_scrutiny_report', compact('ArchitectLayout'));
    }

    public function post_scrutiny_report(Request $request)
    {
        $this->validate($request, [
            'document_name' => 'required',
            'doc_file' => 'required|mimes:pdf',
        ]);
        //get latest detail
        $latest_architect_layout_detail = ArchitectLayoutDetail::where(['architect_layout_id' => $request->architect_layout_id])->orderBy('id', 'desc')->first();

        if (session()->get('role_name') == config('commanConfig.estate_manager')) {
            $extension = $request->file('doc_file')->getClientOriginalExtension();
            $dir = 'architect_layout_details';
            $filename = uniqid() . '_' . time() . '_' . date('Ymd') . '.' . $extension;
            $storage = Storage::disk('ftp')->putFileAs($dir, $request->file('doc_file'), $filename);
            if ($storage) {
                $ArchitectLayoutScrutinyEMReport = new ArchitectLayoutScrutinyEMReport;
                $ArchitectLayoutScrutinyEMReport->user_id = auth()->user()->id;
                $ArchitectLayoutScrutinyEMReport->architect_layout_id = $request->architect_layout_id;
                $ArchitectLayoutScrutinyEMReport->architect_layout_detail_id = $latest_architect_layout_detail->id;
                $ArchitectLayoutScrutinyEMReport->name_of_document = $request->document_name;
                $ArchitectLayoutScrutinyEMReport->file = $storage;
                $ArchitectLayoutScrutinyEMReport->save();
                return redirect(route('architect_layout_get_scrtiny', ['layout_id' => encrypt($request->architect_layout_id)]));
            }
            return back()->withError('file not able to upload');
        }

        if (session()->get('role_name') == config('commanConfig.land_manager')) {
            $extension = $request->file('doc_file')->getClientOriginalExtension();
            $dir = 'architect_layout_details';
            $filename = uniqid() . '_' . time() . '_' . date('Ymd') . '.' . $extension;
            $storage = Storage::disk('ftp')->putFileAs($dir, $request->file('doc_file'), $filename);
            if ($storage) {
                $ArchitectLayoutScrutinyLandReport = new ArchitectLayoutScrutinyLandReport;
                $ArchitectLayoutScrutinyLandReport->user_id = auth()->user()->id;
                $ArchitectLayoutScrutinyLandReport->architect_layout_id = $request->architect_layout_id;
                $ArchitectLayoutScrutinyLandReport->architect_layout_detail_id = $latest_architect_layout_detail->id;
                $ArchitectLayoutScrutinyLandReport->name_of_document = $request->document_name;
                $ArchitectLayoutScrutinyLandReport->file = $storage;
                $ArchitectLayoutScrutinyLandReport->save();
                return redirect(route('architect_layout_get_scrtiny', ['layout_id' => encrypt($request->architect_layout_id)]));
            }
            return back()->withError('file not able to upload');
        }

        if (session()->get('role_name') == config('commanConfig.ee_junior_engineer')) {
            $extension = $request->file('doc_file')->getClientOriginalExtension();
            $dir = 'architect_layout_details';
            $filename = uniqid() . '_' . time() . '_' . date('Ymd') . '.' . $extension;
            $storage = Storage::disk('ftp')->putFileAs($dir, $request->file('doc_file'), $filename);
            if ($storage) {
                $ArchitectLayoutScrutinyLandReport = new ArchitectLayoutScrutinyEEReport;
                $ArchitectLayoutScrutinyLandReport->user_id = auth()->user()->id;
                $ArchitectLayoutScrutinyLandReport->architect_layout_id = $request->architect_layout_id;
                $ArchitectLayoutScrutinyLandReport->architect_layout_detail_id = $latest_architect_layout_detail->id;
                $ArchitectLayoutScrutinyLandReport->name_of_document = $request->document_name;
                $ArchitectLayoutScrutinyLandReport->file = $storage;
                $ArchitectLayoutScrutinyLandReport->save();
                return redirect(route('architect_layout_get_scrtiny', ['layout_id' => encrypt($request->architect_layout_id)]));
            }
            return back()->withError('file not able to upload');
        }

        if (session()->get('role_name') == config('commanConfig.ree_junior')) {
            $extension = $request->file('doc_file')->getClientOriginalExtension();
            $dir = 'architect_layout_details';
            $filename = uniqid() . '_' . time() . '_' . date('Ymd') . '.' . $extension;
            $storage = Storage::disk('ftp')->putFileAs($dir, $request->file('doc_file'), $filename);
            if ($storage) {
                $ArchitectLayoutScrutinyLandReport = new ArchitectLayoutScrutinyREEReport;
                $ArchitectLayoutScrutinyLandReport->user_id = auth()->user()->id;
                $ArchitectLayoutScrutinyLandReport->architect_layout_id = $request->architect_layout_id;
                $ArchitectLayoutScrutinyLandReport->architect_layout_detail_id = $latest_architect_layout_detail->id;
                $ArchitectLayoutScrutinyLandReport->name_of_document = $request->document_name;
                $ArchitectLayoutScrutinyLandReport->file = $storage;
                $ArchitectLayoutScrutinyLandReport->save();
                return redirect(route('architect_layout_get_scrtiny', ['layout_id' => encrypt($request->architect_layout_id)]));
            }
            return back()->withError('file not able to upload');
        }

        return back()->withError('something went wrong');
    }

    //delete srutiny report
    public function delete_scrutiny_report(Request $request)
    {
        //return $request->all();
        $report_id=decrypt($request->report_id);
        if (session()->get('role_name') == config('commanConfig.estate_manager')) {
            $ArchitectLayoutScrutinyEMReport=ArchitectLayoutScrutinyEMReport::find($report_id);
            $file = $ArchitectLayoutScrutinyEMReport->file;
            if (Storage::disk('ftp')->has($file)) {
                Storage::disk('ftp')->delete($file);
            }
            if($ArchitectLayoutScrutinyEMReport->delete())
            {
                return back()->withSuccess('record deleted!');
            }else
            {
                return back()->withError('something went wrong');
            }
        }
        if (session()->get('role_name') == config('commanConfig.land_manager')) {
            $ArchitectLayoutScrutinyLandReport=ArchitectLayoutScrutinyLandReport::find($report_id);
            $file = $ArchitectLayoutScrutinyLandReport->file;
            if (Storage::disk('ftp')->has($file)) {
                Storage::disk('ftp')->delete($file);
            }
            if($ArchitectLayoutScrutinyLandReport->delete())
            {
                return back()->withSuccess('record deleted!');
            }else
            {
                return back()->withError('something went wrong');
            }
        }
        if (session()->get('role_name') == config('commanConfig.ee_junior_engineer')) {
            $ArchitectLayoutScrutinyEEReport=ArchitectLayoutScrutinyEEReport::find($report_id);
            $file = $ArchitectLayoutScrutinyEEReport->file;
            if (Storage::disk('ftp')->has($file)) {
                Storage::disk('ftp')->delete($file);
            }
            if($ArchitectLayoutScrutinyEEReport->delete())
            {
                return back()->withSuccess('record deleted!');
            }else
            {
                return back()->withError('something went wrong');
            }
        }
        if (session()->get('role_name') == config('commanConfig.ree_junior')) {
            $ArchitectLayoutScrutinyREEReport=ArchitectLayoutScrutinyREEReport::find($report_id);
            $file = $ArchitectLayoutScrutinyREEReport->file;
            if (Storage::disk('ftp')->has($file)) {
                Storage::disk('ftp')->delete($file);
            }
            if($ArchitectLayoutScrutinyREEReport->delete())
            {
                return back()->withSuccess('record deleted!');
            }else
            {
                return back()->withError('something went wrong');
            }
        }
    }

    //upload lm checklist and remark files
    public function upload_lm_checklist_and_remark_report(Request $request)
    {
        //get latest detail
        $latest_architect_layout_detail = ArchitectLayoutDetail::where(['architect_layout_id' => $request->architect_layout_id])->orderBy('id', 'desc')->first();

        $file = $request->file('file');
        if ($file->getClientMimeType() == 'application/pdf') {
            $extension = $request->file('file')->getClientOriginalExtension();
            $dir = 'architect_layout_details';
            $filename = uniqid() . '_' . time() . '_' . date('Ymd') . '.' . $extension;
            $storage = Storage::disk('ftp')->putFileAs($dir, $request->file('file'), $filename);
            if ($storage) {
                $enter_detail = ArchitectLayoutLmScrtinyQuestionDetail::where(['architect_layout_id' => $request->architect_layout_id, 'architect_layout_detail_id' => $latest_architect_layout_detail->id, 'id' => $request->report_id, 'user_id' => auth()->user()->id])->first();
                if ($enter_detail) {
                    $enter_detail->file = $storage;
                    $enter_detail->save();

                } else {
                    $enter_detail = new ArchitectLayoutLmScrtinyQuestionDetail;
                    $enter_detail->user_id = auth()->user()->id;
                    $enter_detail->architect_layout_id = $request->architect_layout_id;
                    $enter_detail->architect_layout_detail_id = $latest_architect_layout_detail->id;
                    $enter_detail->architect_layout_lm_scrunity_question_master_id = 0;
                    $enter_detail->file = $storage;
                    $enter_detail->save();
                }

                $response_array = array(
                    'status' => true,
                    'file_path' => config('commanConfig.storage_server') . "/" . $storage,
                    'doc_id' => $enter_detail->id,
                );
            } else {
                $response_array = array(
                    'status' => false,
                    'message' => 'file not uploaded',
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

    //upload lm checklist and remark data
    public function post_lm_checklist_and_remark_report(Request $request)
    {
        //get latest detail
        $latest_architect_layout_detail = ArchitectLayoutDetail::where(['architect_layout_id' => $request->architect_layout_id])->orderBy('id', 'desc')->first();

        $lables = $request->lable;
        $remarks = $request->remark;
        $j = 0;
        foreach ($request->report_id as $report_ids) {
            $detail = ArchitectLayoutLmScrtinyQuestionDetail::where(['id' => $report_ids, 'architect_layout_id' => $request->architect_layout_id, 'architect_layout_detail_id' => $latest_architect_layout_detail->id])->first();
            if ($detail) {
                if (isset($lables[$j])) {
                    if ($lables[$j] == 1) {
                        $detail->label1 = 1;
                        $detail->label2 = 0;
                    }
                    if ($lables[$j] == 2) {
                        $detail->label1 = 0;
                        $detail->label2 = 1;
                    }
                }

                $detail->remark = isset($remarks[$j]) ? $remarks[$j] : '';
                $detail->save();

            }
            $j++;
        }
        return back()->withSuccess('Check list & Remarks updated');
    }

    //upload em checklist and remark files
    public function upload_em_checklist_and_remark_report(Request $request)
    {
        //get latest detail
        $latest_architect_layout_detail = ArchitectLayoutDetail::where(['architect_layout_id' => $request->architect_layout_id])->orderBy('id', 'desc')->first();

        $file = $request->file('file');
        if ($file->getClientMimeType() == 'application/pdf') {
            $extension = $request->file('file')->getClientOriginalExtension();
            $dir = 'architect_layout_details';
            $filename = uniqid() . '_' . time() . '_' . date('Ymd') . '.' . $extension;
            $storage = Storage::disk('ftp')->putFileAs($dir, $request->file('file'), $filename);
            if ($storage) {
                $enter_detail = ArchitectLayoutEmScrtinyQuestionDetail::where(['architect_layout_id' => $request->architect_layout_id, 'architect_layout_detail_id' => $latest_architect_layout_detail->id, 'id' => $request->report_id, 'user_id' => auth()->user()->id])->first();
                if ($enter_detail) {
                    $enter_detail->file = $storage;
                    $enter_detail->save();

                } else {
                    $enter_detail = new ArchitectLayoutEmScrtinyQuestionDetail;
                    $enter_detail->user_id = auth()->user()->id;
                    $enter_detail->architect_layout_id = $request->architect_layout_id;
                    $enter_detail->architect_layout_detail_id = $latest_architect_layout_detail->id;
                    $enter_detail->architect_layout_em_scrunity_question_master_id = 0;
                    $enter_detail->file = $storage;
                    $enter_detail->save();
                }

                $response_array = array(
                    'status' => true,
                    'file_path' => config('commanConfig.storage_server') . "/" . $storage,
                    'doc_id' => $enter_detail->id,
                );
            } else {
                $response_array = array(
                    'status' => false,
                    'message' => 'file not uploaded',
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

    //upload em checklist and remark data
    public function post_em_checklist_and_remark_report(Request $request)
    {
        //get latest detail
        $latest_architect_layout_detail = ArchitectLayoutDetail::where(['architect_layout_id' => $request->architect_layout_id])->orderBy('id', 'desc')->first();

        $lables = $request->lable;
        $remarks = $request->remark;
        $j = 0;
        foreach ($request->report_id as $report_ids) {
            $detail = ArchitectLayoutEmScrtinyQuestionDetail::where(['id' => $report_ids, 'architect_layout_id' => $request->architect_layout_id, 'architect_layout_detail_id' => $latest_architect_layout_detail->id])->first();
            if ($detail) {
                if (isset($lables[$j])) {
                    if ($lables[$j] == 1) {
                        $detail->label1 = 1;
                        $detail->label2 = 0;
                    }
                    if ($lables[$j] == 2) {
                        $detail->label1 = 0;
                        $detail->label2 = 1;
                    }
                }

                $detail->remark = isset($remarks[$j]) ? $remarks[$j] : '';
                $detail->save();

            }
            $j++;
        }
        return back()->withSuccess('Check list & Remarks updated');
    }

    //upload ee checklist and remark files
    public function upload_ee_checklist_and_remark_report(Request $request)
    {
        //get latest detail
        $latest_architect_layout_detail = ArchitectLayoutDetail::where(['architect_layout_id' => $request->architect_layout_id])->orderBy('id', 'desc')->first();

        if (session()->get('role_name') == config('commanConfig.ee_junior_engineer')) {
            $file = $request->file('file');
            if ($file->getClientMimeType() == 'application/pdf') {
                $extension = $request->file('file')->getClientOriginalExtension();
                $dir = 'architect_layout_details';
                $filename = uniqid() . '_' . time() . '_' . date('Ymd') . '.' . $extension;
                $storage = Storage::disk('ftp')->putFileAs($dir, $request->file('file'), $filename);
                if ($storage) {
                    $enter_detail = ArchitectLayoutEEScrtinyQuestionDetail::where(['architect_layout_id' => $request->architect_layout_id, 'architect_layout_detail_id' => $latest_architect_layout_detail->id, 'id' => $request->report_id, 'user_id' => auth()->user()->id])->first();
                    if ($enter_detail) {
                        $enter_detail->file = $storage;
                        $enter_detail->save();

                    } else {
                        $enter_detail = new ArchitectLayoutEEScrtinyQuestionDetail;
                        $enter_detail->user_id = auth()->user()->id;
                        $enter_detail->architect_layout_id = $request->architect_layout_id;
                        $enter_detail->architect_layout_detail_id = $latest_architect_layout_detail->id;
                        $enter_detail->architect_layout_ee_scrunity_question_master_id = 0;
                        $enter_detail->file = $storage;
                        $enter_detail->save();
                    }

                    $response_array = array(
                        'status' => true,
                        'file_path' => config('commanConfig.storage_server') . "/" . $storage,
                        'doc_id' => $enter_detail->id,
                    );
                } else {
                    $response_array = array(
                        'status' => false,
                        'message' => 'file not uploaded',
                    );
                }

            } else {
                $response_array = array(
                    'status' => false,
                    'message' => 'PDF file is required',
                );
            }
        } else {
            $response_array = array(
                'status' => false,
                'message' => 'Something went wrong',
            );
        }

        return response()->json($response_array);
    }

    //upload ee checklist and remark data
    public function post_ee_checklist_and_remark_report(Request $request)
    {
        //get latest detail
        $latest_architect_layout_detail = ArchitectLayoutDetail::where(['architect_layout_id' => $request->architect_layout_id])->orderBy('id', 'desc')->first();

        if (session()->get('role_name') == config('commanConfig.ee_junior_engineer')) {
            $lables = $request->lable;
            $remarks = $request->remark;
            $j = 0;
            foreach ($request->report_id as $report_ids) {
                $detail = ArchitectLayoutEEScrtinyQuestionDetail::where(['id' => $report_ids, 'architect_layout_id' => $request->architect_layout_id, 'architect_layout_detail_id' => $latest_architect_layout_detail->id])->first();
                if ($detail) {
                    if (isset($lables[$j])) {
                        if ($lables[$j] == 1) {
                            $detail->label1 = 1;
                            $detail->label2 = 0;
                        }
                        if ($lables[$j] == 2) {
                            $detail->label1 = 0;
                            $detail->label2 = 1;
                        }
                    }

                    $detail->remark = isset($remarks[$j]) ? $remarks[$j] : '';
                    $detail->save();

                }
                $j++;
            }
            return back()->withSuccess('Check list & Remarks updated');
        } else {
            return back()->withError('something went wrong');
        }
    }

    //upload ree checklist and remark files
    public function upload_ree_checklist_and_remark_report(Request $request)
    {
        //get latest detail
        $latest_architect_layout_detail = ArchitectLayoutDetail::where(['architect_layout_id' => $request->architect_layout_id])->orderBy('id', 'desc')->first();

        if (session()->get('role_name') == config('commanConfig.ree_junior')) {
            $file = $request->file('file');
            if ($file->getClientMimeType() == 'application/pdf') {
                $extension = $request->file('file')->getClientOriginalExtension();
                $dir = 'architect_layout_details';
                $filename = uniqid() . '_' . time() . '_' . date('Ymd') . '.' . $extension;
                $storage = Storage::disk('ftp')->putFileAs($dir, $request->file('file'), $filename);
                if ($storage) {
                    $enter_detail = ArchitectLayoutReeScrtinyQuestionDetail::where(['architect_layout_id' => $request->architect_layout_id, 'architect_layout_detail_id' => $latest_architect_layout_detail->id, 'id' => $request->report_id, 'user_id' => auth()->user()->id])->first();
                    if ($enter_detail) {
                        $enter_detail->file = $storage;
                        $enter_detail->save();

                    } else {
                        $enter_detail = new ArchitectLayoutReeScrtinyQuestionDetail;
                        $enter_detail->user_id = auth()->user()->id;
                        $enter_detail->architect_layout_id = $request->architect_layout_id;
                        $enter_detail->architect_layout_detail_id = $latest_architect_layout_detail->id;
                        $enter_detail->architect_layout_ree_scrunity_question_master_id = 0;
                        $enter_detail->file = $storage;
                        $enter_detail->save();
                    }

                    $response_array = array(
                        'status' => true,
                        'file_path' => config('commanConfig.storage_server') . "/" . $storage,
                        'doc_id' => $enter_detail->id,
                    );
                } else {
                    $response_array = array(
                        'status' => false,
                        'message' => 'file not uploaded',
                    );
                }

            } else {
                $response_array = array(
                    'status' => false,
                    'message' => 'PDF file is required',
                );
            }
        } else {
            $response_array = array(
                'status' => false,
                'message' => 'Something went wrong',
            );
        }

        return response()->json($response_array);
    }

    //upload ee checklist and remark data
    public function post_ree_checklist_and_remark_report(Request $request)
    {
        //get latest detail
        $latest_architect_layout_detail = ArchitectLayoutDetail::where(['architect_layout_id' => $request->architect_layout_id])->orderBy('id', 'desc')->first();

        if (session()->get('role_name') == config('commanConfig.ree_junior')) {
            $lables = $request->lable;
            $remarks = $request->remark;
            $j = 0;
            foreach ($request->report_id as $report_ids) {
                $detail = ArchitectLayoutReeScrtinyQuestionDetail::where(['id' => $report_ids, 'architect_layout_id' => $request->architect_layout_id, 'architect_layout_detail_id' => $latest_architect_layout_detail->id])->first();
                if ($detail) {
                    if (isset($lables[$j])) {
                        if ($lables[$j] == 1) {
                            $detail->label1 = 1;
                            $detail->label2 = 0;
                        }
                        if ($lables[$j] == 2) {
                            $detail->label1 = 0;
                            $detail->label2 = 1;
                        }
                    }
                    $detail->remark = isset($remarks[$j]) ? $remarks[$j] : '';
                    $detail->save();
                }
                $j++;
            }
            return back()->withSuccess('Check list & Remarks updated');
        } else {
            return back()->withError('something went wrong');
        }
    }

    public function get_scrutiny_of_ee_em_lm_ree($layout_id)
    {
        $layout_id = decrypt($layout_id);
        //get latest detail
        $latest_architect_layout_detail = ArchitectLayoutDetail::where(['architect_layout_id' => $layout_id])->orderBy('id', 'desc')->first();
        //dd($latest_architect_layout_detail->id);
        $ArchitectLayout = ArchitectLayout::with(['layout_details', 'ee_scrutiny_reports' => function ($q) use ($latest_architect_layout_detail) {
            return $q->where('architect_layout_detail_id', $latest_architect_layout_detail->id);
        }, 'em_scrutiny_reports' => function ($q) use ($latest_architect_layout_detail) {
            return $q->where('architect_layout_detail_id', $latest_architect_layout_detail->id);
        }, 'land_scrutiny_reports' => function ($q) use ($latest_architect_layout_detail) {
            return $q->where('architect_layout_detail_id', $latest_architect_layout_detail->id);
        }, 'ree_scrutiny_reports' => function ($q) use ($latest_architect_layout_detail) {
            return $q->where('architect_layout_detail_id', $latest_architect_layout_detail->id);
        }, 'ee_scrutiny_checklist_and_remarks' => function ($q) use ($latest_architect_layout_detail) {
            return $q->where('architect_layout_detail_id', $latest_architect_layout_detail->id);
        }, 'land_scrutiny_checklist_and_remarks' => function ($q) use ($latest_architect_layout_detail) {
            return $q->where('architect_layout_detail_id', $latest_architect_layout_detail->id);
        }, 'em_scrutiny_checklist_and_remarks' => function ($q) use ($latest_architect_layout_detail) {
            return $q->where('architect_layout_detail_id', $latest_architect_layout_detail->id);
        }, 'ree_scrutiny_checklist_and_remarks' => function ($q) use ($latest_architect_layout_detail) {
            return $q->where('architect_layout_detail_id', $latest_architect_layout_detail->id);
        }])->find($layout_id);
        //dd($ArchitectLayout);
        return view('admin.architect_layout.scrutiny_of_ee_em_lm_ree', compact('ArchitectLayout'));
    }

    public function prepare_layout_excel($layout_id)
    {
        $layout_id = decrypt($layout_id);
        $ArchitectLayout = ArchitectLayout::find($layout_id);
        return view('admin.architect_layout.prepare_layout_and_excel', compact('ArchitectLayout'));
    }

    public function uploadLayoutandExcelAjax(Request $request)
    {

        $response_array = array();
        $file = $request->file('file');
        //dd($file->getClientMimeType());
        if($request->field_name=='layout_in_excel')
        {
            if($file->getClientMimeType() != 'application/vnd.ms-excel')
            {
                $response_array = array(
                    'status' => false,
                    'message' => 'XLS file is required',
                );
                return response()->json($response_array);
            }
            
        }
        if ($file->getClientMimeType() == 'application/pdf' || $request->field_name=='layout_in_excel') {
            $extension = $request->file('file')->getClientOriginalExtension();
            $dir = 'architect_layout_details';
            $filename = uniqid() . '_' . time() . '_' . date('Ymd') . '.' . $extension;
            $storage = Storage::disk('ftp')->putFileAs($dir, $request->file('file'), $filename);
            if ($storage) {
                $ArchitectLayout = ArchitectLayout::find($request->architect_layout_id);
                if ($request->field_name == 'layout_in_pdf') {
                    $ArchitectLayout->upload_layout_in_pdf_format = $storage;
                    $get_id = PrepareLayoutExcelLog::where(['architect_layout_id' => $request->architect_layout_id])->orderBy('id', 'desc')->first();
                    if ($get_id) {
                        $PrepareLayoutExcelLog = PrepareLayoutExcelLog::find($get_id->id);
                        $PrepareLayoutExcelLog->upload_layout_in_pdf_format = $storage;
                        $PrepareLayoutExcelLog->save();
                    } else {

                        $PrepareLayoutExcelLog = new PrepareLayoutExcelLog;
                        $PrepareLayoutExcelLog->architect_layout_id = $request->architect_layout_id;
                        $PrepareLayoutExcelLog->upload_layout_in_pdf_format = $storage;
                        $PrepareLayoutExcelLog->save();
                    }
                }
                if ($request->field_name == 'layout_in_excel') {
                    $ArchitectLayout->upload_layout_in_excel_format = $storage;
                    $get_id = PrepareLayoutExcelLog::where(['architect_layout_id' => $request->architect_layout_id])->orderBy('id', 'desc')->first();
                    if ($get_id) {
                        $PrepareLayoutExcelLog = PrepareLayoutExcelLog::find($get_id->id);
                        $PrepareLayoutExcelLog->upload_layout_in_excel_format = $storage;
                        $PrepareLayoutExcelLog->save();

                    } else {

                        $PrepareLayoutExcelLog = new PrepareLayoutExcelLog;
                        $PrepareLayoutExcelLog->architect_layout_id = $request->architect_layout_id;
                        $PrepareLayoutExcelLog->upload_layout_in_excel_format = $storage;
                        $PrepareLayoutExcelLog->save();
                    }
                }
                if ($request->field_name == 'upload_architect_note') {
                    $ArchitectLayout->upload_architect_note = $storage;
                    $get_id = PrepareLayoutExcelLog::where(['architect_layout_id' => $request->architect_layout_id])->orderBy('id', 'desc')->first();
                    if ($get_id) {
                        $PrepareLayoutExcelLog = PrepareLayoutExcelLog::find($get_id->id);
                        $PrepareLayoutExcelLog->upload_architect_note = $storage;
                        $PrepareLayoutExcelLog->save();
                    } else {

                        $PrepareLayoutExcelLog = new PrepareLayoutExcelLog;
                        $PrepareLayoutExcelLog->architect_layout_id = $request->architect_layout_id;
                        $PrepareLayoutExcelLog->upload_architect_note = $storage;
                        $PrepareLayoutExcelLog->save();
                    }
                }

                if ($ArchitectLayout->upload_layout_in_pdf_format != "" && $ArchitectLayout->upload_layout_in_excel_format != "" && $ArchitectLayout->upload_architect_note != "") {
                   //layout_excel_status updated to show only ree role to head architect
                    $ArchitectLayout->layout_excel_status = 1;
                }
                $ArchitectLayout->save();
                $response_array = array(
                    'status' => true,
                    'file_path' => config('commanConfig.storage_server') . "/" . $storage,
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

}
