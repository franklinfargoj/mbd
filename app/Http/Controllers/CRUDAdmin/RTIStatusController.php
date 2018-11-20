<?php
namespace App\Http\Controllers\CRUDAdmin;
use App\MasterRtiStatus;
use App\DeletedRTIStatus;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Config;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;


class RTIStatusController extends Controller
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
            ['data' => 'status_title','name' => 'status_title','title' => 'Status Name'],
            ['data' => 'actions','name' => 'actions','title' => 'Actions','searchable' => false,'orderable'=>false],
        ];
//dd($datatables->getRequest()->ajax());
        if ($datatables->getRequest()->ajax()) {
            DB::statement(DB::raw('set @rownum='. (isset($request->start) ? $request->start : 0) ));

            $status_data = MasterRtiStatus::all();
            return $datatables->of($status_data)
                ->editColumn('rownum', function ($status_data) {
                    static $i = 0;
                    $i++;
                    return $i;
                })
                ->editColumn('status_title', function ($status_data) {
                    return $status_data->status_title;
                })
                ->editColumn('actions', function ($status_data) {
                    return view('admin.crud_admin.rti_status.action', compact('status_data'))->render();
                })

                ->rawColumns(['status_title','actions'])
                ->make(true);

        }

        $html = $datatables->getHtmlBuilder()->columns($columns)->parameters($this->getParameters());

        return view('admin.crud_admin.rti_status.index',compact('html'));

    }

    protected function getParameters() {
        return [
            'serverSide' => true,
            'processing' => true,
            'ordering'   =>'isSorted',
            "order"=> [2, "desc" ],
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
        return view('admin.crud_admin.rti_status.create');

    }
    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'status_title' => 'required|unique:master_rti_status,status_title',
        ]);
        //create the new role
        $status = new MasterRtiStatus();
        $status->status_title = $request->input('status_title');
        $status->save();

        return redirect()->route('rti_status.index')
            ->with('success','RTI Status created successfully');
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
        $status = MasterRtiStatus::FindOrFail($id)->toArray();

        return view('admin.crud_admin.rti_status.show', compact( 'status'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $status = MasterRtiStatus::FindOrFail($id)->toArray();
        return view('admin.crud_admin.rti_status.edit',compact('status'));
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
            'status_title' => 'required',
        ]);

        $status = MasterRtiStatus::FindOrFail($id);
        if($request->input('status_title') != $status['name'] ){
            $status->status_title = $request->input('status_title');
        }

        $status->save();
        return redirect()->route('rti_status.index')
            ->with('success','RTI Status updated successfully');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Request $request, $id)
    {
        $rti_statusDetails = MasterRtiStatus::findOrfail($id);
        $rti_statusDetails->delete();

        DeletedRTIStatus::create([
            'rti_status_details_id' => $id,
            'status_title'          => $rti_statusDetails->status_title,
            'day'                => date('l'),
            'date'               => date('Y-m-d'),
            'time'               => date("h:i:s"),
            'reason'             => $request->input('delete_message'),
        ]);

        return redirect()->back()->with(['success'=> 'RTI status deleted succesfully']);
    }

    public function DeleteRTIStatusUsingAjax(Request $request){
        $id = $request->id;
        return view('admin.crud_admin.rti_status.rtistatusDeleteReason', compact('id'))->render();
    }
}