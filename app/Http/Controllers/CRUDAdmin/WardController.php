<?php
namespace App\Http\Controllers\CRUDAdmin;
use App\DeletedWard;
use App\MasterWard;
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


class WardController extends Controller
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
            ['data' => 'name','name' => 'name','title' => 'Name'],
            ['data' => 'actions','name' => 'actions','title' => 'Actions','searchable' => false,'orderable'=>false],
        ];
//dd($datatables->getRequest()->ajax());
        if ($datatables->getRequest()->ajax()) {
            DB::statement(DB::raw('set @rownum='. (isset($request->start) ? $request->start : 0) ));

            $ward_data = MasterWard::all();
            return $datatables->of($ward_data)
                ->editColumn('rownum', function ($ward_data) {
                    static $i = 0;
                    $i++;
                    return $i;
                })
                ->editColumn('name', function ($ward_data) {
                    return $ward_data->name;
                })
                ->editColumn('actions', function ($ward_data) {
                    return view('admin.crud_admin.wards.action', compact('ward_data'))->render();
                })

                ->rawColumns(['name','actions'])
                ->make(true);

        }

        $html = $datatables->getHtmlBuilder()->columns($columns)->parameters($this->getParameters());

        return view('admin.crud_admin.wards.index',compact('html'));

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
        return view('admin.crud_admin.wards.create');

    }
    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:master_wards,name',
        ]);
        //create the new role
        $ward = new MasterWard();
        $ward->name = $request->input('name');
        $ward->save();

        return redirect()->route('ward.index')
            ->with('success','Ward created successfully');
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
        $ward = MasterWard::FindOrFail($id)->toArray();

        return view('admin.crud_admin.wards.show', compact( 'ward'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $ward = MasterWard::FindOrFail($id)->toArray();
        return view('admin.crud_admin.wards.edit',compact('ward'));
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
            'name' => 'required',
        ]);

        $ward = MasterWard::FindOrFail($id);
        if($request->input('name') != $ward['name'] ){
            $ward->name = $request->input('name');
        }

        $ward->save();
        return redirect()->route('ward.index')
            ->with('success','Ward updated successfully');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Request $request, $id)
    {
        $wardsDetails = MasterWard::findOrfail($id);
        $wardsDetails->delete();

        DeletedWard::create([
            'wards_details_id'  => $id,
            'name'              => $wardsDetails->name,
            'day'               => date('l'),
            'date'              => date('Y-m-d'),
            'time'              => date("h:i:s"),
            'reason'             => $request->input('delete_message'),
        ]);

        return redirect()->back()->with(['success'=> 'Ward deleted succesfully']);
    }

    public function loadDeleteWardUsingAjax(Request $request){
        $id = $request->id;
        return view('admin.crud_admin.wards.wardDeleteReason', compact('id'))->render();
    }
}
