<?php
namespace App\Http\Controllers\CRUDAdmin;
use App\ApplicationStatusMaster;
use App\DeletedApplicationStatus;
use Illuminate\Http\Request;
use App\Role;
use App\Permission;
use App\Http\Controllers\Controller;
use Config;
use App\DeletedRoles;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;
use Yajra\DataTables\DataTables;


class ApplicationStatusController extends Controller
{
    protected $list_num_of_records_per_page;

    public function __construct()
    {
        $this->list_num_of_records_per_page = Config::get('commanConfig.list_num_of_records_per_page');
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request, DataTables $datatables){

        $columns = [
            ['data' => 'rownum','name' => 'rownum','title' => 'Sr No.','searchable' => false],
            ['data' => 'status_name','name' => 'status_name','title' => 'Status Name'],
            ['data' => 'actions','name' => 'actions','title' => 'Actions','searchable' => false,'orderable'=>false],
        ];
//dd($datatables->getRequest()->ajax());
        if ($datatables->getRequest()->ajax()) {
            DB::statement(DB::raw('set @rownum='. (isset($request->start) ? $request->start : 0) ));

            $status_data = ApplicationStatusMaster::all();
            return $datatables->of($status_data)
                ->editColumn('rownum', function ($status_data) {
                    static $i = 0;
                    $i++;
                    return $i;
                })
                ->editColumn('status_name', function ($status_data) {
                    return $status_data->status_name;
                })
                ->editColumn('actions', function ($status_data) {
                    return view('admin.crud_admin.application_status.action', compact('status_data'))->render();
                })

                ->rawColumns(['status_name','actions'])
                ->make(true);

        }

        $html = $datatables->getHtmlBuilder()->columns($columns)->parameters($this->getParameters());

        return view('admin.crud_admin.application_status.index',compact('html'));

    }

    protected function getParameters() {
        return [
            'serverSide' => true,
            'processing' => true,
            'ordering'   =>'isSorted',
//            "order"=> [2, "desc" ],
            "pageLength" => $this->list_num_of_records_per_page
        ];
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.crud_admin.application_status.create');

    }
    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'status_name' => 'required|unique:application_status_master,status_name',
        ]);
        //create the new role
        $status = new ApplicationStatusMaster();
        $status->status_name = $request->input('status_name');
        $status->save();

        return redirect()->route('application_status.index')
            ->with('success','Application Status created successfully');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
//        dd($id);
        $status = ApplicationStatusMaster::FindOrFail($id)->toArray();

        return view('admin.crud_admin.application_status.show', compact( 'status'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $status = ApplicationStatusMaster::FindOrFail($id)->toArray();
        return view('admin.crud_admin.application_status.edit',compact('status'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'status_name' => 'required',
        ]);

        $status = ApplicationStatusMaster::FindOrFail($id);
        if($request->input('status_name') != $status['name'] ){
            $status->status_name = $request->input('status_name');
        }

        $status->save();
        return redirect()->route('application_status.index')
            ->with('success','Application Status updated successfully');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Request $request, $id)
    {
        $application_statusDetails = ApplicationStatusMaster::findOrfail($id);
        $application_statusDetails->delete();

        DeletedApplicationStatus::create([
            'application_status_details_id' => $id,
            'status_name'          => $application_statusDetails->status_name,
            'day'                => date('l'),
            'date'               => date('Y-m-d'),
            'time'               => date("h:i:s"),
            'reason'             => $request->input('delete_message'),
        ]);

        return redirect()->back()->with(['success'=> 'Application status deleted succesfully']);
    }

    public function loadDeleteApplicationStatusUsingAjax(Request $request){
        $id = $request->id;
        return view('admin.crud_admin.application_status.applicationstatusDeleteReason', compact('id'))->render();
    }
}