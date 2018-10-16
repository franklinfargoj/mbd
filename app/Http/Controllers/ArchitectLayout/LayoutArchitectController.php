<?php

namespace App\Http\Controllers\ArchitectLayout;

use App\Http\Controllers\Common\CommonController;
use App\Http\Controllers\Controller;
use App\Http\Requests\ArchitectLayout\AddLayout;
use App\Layout\ArchitectLayout;
use App\Layout\ArchitectLayoutDetail;
use App\Layout\ArchitectLayoutStatusLog;
use App\Role;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Layout\ArchitectLayoutScrutinyEMReport;

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
            ['data' => 'radio', 'name' => 'radio', 'title' => '', 'searchable' => false],
            ['data' => 'rownum', 'name' => 'rownum', 'title' => 'Sr No.', 'searchable' => false],
            ['data' => 'layout_no', 'name' => 'layout_no', 'title' => 'Layout No'],
            ['data' => 'layout_name', 'name' => 'layout_name', 'title' => 'Layout Name', 'class' => 'datatable-date'],
            ['data' => 'address', 'name' => 'address', 'title' => 'Society Name'],
            ['data' => 'Status', 'name' => 'Status', 'title' => 'Status'],
        ];

        if ($datatables->getRequest()->ajax()) {

            $architect_layout_data = $this->architect_layouts->architect_layout_data($request);
            $revision_requests = $architect_layout_data['revision_requests'];
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
                ->editColumn('layout_name', function ($listArray) {
                    return $listArray->layout_name;
                })
                ->editColumn('address', function ($listArray) {
                    return $listArray->address;
                })
                ->editColumn('Status', function ($listArray) use ($request) {
                    $status = $listArray->ArchitectLayoutStatusLogInLiosting[0]->status_id;
                    $config_array = array_flip(config('commanConfig.architect_layout_status'));
                    return $value = ucwords(str_replace('_', ' ', $config_array[$status]));

                })
                ->editColumn('added_date', function ($listArray) {
                    return date(config('commanConfig.dateFormat'), strtotime($listArray->added_date));
                })
            // ->editColumn('actions', function ($ee_application_data) use($request) {
            //     return view('admin.ee_department.actions', compact('ee_application_data', 'request'))->render();
            // })
                ->rawColumns(['radio', 'layout_no', 'layout_name', 'address', 'Status', 'added_date'])
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
            ['data' => 'radio', 'name' => 'radio', 'title' => '', 'searchable' => false],
            ['data' => 'rownum', 'name' => 'rownum', 'title' => 'Sr No.', 'searchable' => false],
            ['data' => 'layout_no', 'name' => 'layout_no', 'title' => 'Layout No'],
            ['data' => 'layout_name', 'name' => 'layout_name', 'title' => 'Layout Name', 'class' => 'datatable-date'],
            ['data' => 'address', 'name' => 'address', 'title' => 'Society Name'],
            ['data' => 'Status', 'name' => 'Status', 'title' => 'Status'],
        ];

        if ($datatables->getRequest()->ajax()) {

            $architect_layout_data = $this->architect_layouts->architect_layout_data($request);
            $layout_details = $architect_layout_data['layout_details'];
            return $datatables->of($layout_details)
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
                ->editColumn('layout_name', function ($listArray) {
                    return $listArray->layout_name;
                })
                ->editColumn('address', function ($listArray) {
                    return $listArray->address;
                })
                ->editColumn('Status', function ($listArray) use ($request) {
                    $status = $listArray->ArchitectLayoutStatusLogInLiosting[0]->status_id;
                    $config_array = array_flip(config('commanConfig.architect_layout_status'));
                    return $value = ucwords(str_replace('_', ' ', $config_array[$status]));

                })
                ->editColumn('added_date', function ($listArray) {
                    return date(config('commanConfig.dateFormat'), strtotime($listArray->added_date));
                })
            // ->editColumn('actions', function ($ee_application_data) use($request) {
            //     return view('admin.ee_department.actions', compact('ee_application_data', 'request'))->render();
            // })
                ->rawColumns(['radio', 'layout_no', 'layout_name', 'address', 'Status', 'added_date'])
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
            //"order"=> [4, "asc" ],
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
            'layout_no' => $this->genRand(),
            'layout_name' => $request->layout_name,
            'address' => $request->layout_address,
            'added_date' => Carbon::now(),
        );
        $ArchitectLayout = ArchitectLayout::create($layout_data);
        if ($ArchitectLayout) {
            $ArchitectLayoutDetail = new ArchitectLayoutDetail;
            $ArchitectLayoutDetail->architect_layout_id = $ArchitectLayout->id;
            $ArchitectLayoutDetail->save();
            return redirect(route('architect_layout_detail.edit', ['layout_detail_id' => encrypt($ArchitectLayoutDetail->id)]));
        }
        return back()->withError('something went wrong');
    }

    public function view_architect_layout_details($layout_id)
    {
        $layout_id = decrypt($layout_id);
        $check_layout_details_complete_status = count($this->architect_layouts->check_layout_details_complete_status($layout_id));
        $ArchitectLayout = ArchitectLayout::with(['layout_details'])->find($layout_id);
        $ArchitectLayoutDetail = ArchitectLayoutDetail::where(['architect_layout_id' => $layout_id])->orderBy('id', 'desc')->get();
        return view('admin.architect_layout_detail.view', compact('ArchitectLayout', 'ArchitectLayoutDetail', 'check_layout_details_complete_status'));
    }

    public function forwardLayout(Request $request, $layout_id)
    {
        $architectlogs=array();
        $layout_id = decrypt($layout_id);
        $ArchitectLayout = ArchitectLayout::with(['layout_details'])->find($layout_id);
        $parentData = $this->architect_layouts->getForwardApplicationArchitectParentData();
        $arrData['parentData'] = $parentData['parentData'];
        $arrData['role_name'] = $parentData['role_name'];
        if (session()->get('role_name') == config('commanConfig.architect')) {
            if (session()->get('role_name') != config('commanConfig.LM')) {
                $lm_role_id = Role::where('name', '=', config('commanConfig.land_manager'))->first();
                $arrData['get_forward_lm'] = User::where('role_id', $lm_role_id->id)->get();
                $arrData['lm_role_name'] = strtoupper(str_replace('_', ' ', $lm_role_id->name));
            }

            if (session()->get('role_name') != config('commanConfig.ree_junior')) {
                $ree_role_id = Role::where('name', '=', config('commanConfig.ree_junior'))->first();
                $arrData['get_forward_ree'] = User::where('role_id', $ree_role_id->id)->get();
                $arrData['ree_role_name'] = strtoupper(str_replace('_', ' ', $ree_role_id->name));
            }
            if (session()->get('role_name') != config('commanConfig.ee_junior_engineer')) {
                $ee_role_id = Role::where('name', '=', config('commanConfig.ee_junior_engineer'))->first();
                $arrData['get_forward_ee'] = User::where('role_id', $ee_role_id->id)->get();
                $arrData['ee_role_name'] = strtoupper(str_replace('_', ' ', $ee_role_id->name));
            }
            if (session()->get('role_name') != config('commanConfig.estate_manager')) {
                $em_role_id = Role::where('name', '=', config('commanConfig.estate_manager'))->first();
                $arrData['get_forward_em'] = User::where('role_id', $em_role_id->id)->get();
                $arrData['em_role_name'] = strtoupper(str_replace('_', ' ', $em_role_id->name));
            }

            $architectlogs = $this->architect_layouts->getLogOfArchitectLayoutApplication($layout_id);
            //dd($architectlogs);

        }

        //dd($arrData);
        // if(session()->get('role_name') == config('commanConfig.selection_commitee')) {
        //   $commitee_role_id = Role::where('name', '=', config('commanConfig.junior_architect'))->first();

        //   $arrData['get_forward_commitee'] = User::where('role_id', $commitee_role_id->id)->get();

        //   $arrData['commitee_role_name'] = strtoupper(str_replace('_', ' ', $commitee_role_id->name));
        // }
        return view('admin.architect_layout.forward_architect_layout', compact('arrData', 'ArchitectLayout', 'architectlogs'));
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
                    'status_id' => config('commanConfig.architect_layout_status.forward'),
                    'to_user_id' => $user,
                    'to_role_id' => $user_data->role_id,
                    'remark' => $request->remark,
                    'created_at' => Carbon::now(),
                ];
                $forward_application[] = ['architect_layout_id' => $request->architect_layout_id,
                    'user_id' => $user,
                    'role_id' => $user_data->role_id,
                    'status_id' => config('commanConfig.architect_layout_status.scrutiny_pending'),
                    'to_user_id' => null,
                    'to_role_id' => null,
                    'remark' => $request->remark,
                    'created_at' => Carbon::now()];
            }

        }
        ArchitectLayoutStatusLog::insert($forward_application);

        return redirect(route('architect_layout.index'));
    }

    public function get_scrutiny($layout_id)
    {
        $layout_id=decrypt($layout_id);
        $ArchitectLayout=ArchitectLayout::find($layout_id);
        return view('admin.architect_layout.scrutiny',compact('ArchitectLayout'));
    }

    public function add_scrutiny_report($layout_id)
    {
        $layout_id=decrypt($layout_id);
        $ArchitectLayout=ArchitectLayout::find($layout_id);
        return view('admin.architect_layout.add_scrutiny_report',compact('ArchitectLayout'));
    }

    public function post_scrutiny_report(Request $request)
    {
        if ($request->hasFile('doc_file'))
        {
            dd($request);
        }
        // $doc_file="";
        // $ArchitectLayoutScrutinyEMReport=new ArchitectLayoutScrutinyEMReport;
        // $ArchitectLayoutScrutinyEMReport->user_id=auth()->user()->id;
        // $ArchitectLayoutScrutinyEMReport->architect_layout_id=$request->architect_layout_id;
        // $ArchitectLayoutScrutinyEMReport->name_of_document=$request->document_name;
        // $ArchitectLayoutScrutinyEMReport->file=$doc_file;
        // $ArchitectLayoutScrutinyEMReport->save();
        // return back()->withSuccess('report added successfully!!!');
    }

}
