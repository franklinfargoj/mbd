<?php
namespace App\Http\Controllers\CRUDAdmin;
use Illuminate\Http\Request;
use App\Role;
use App\Permission;
use App\Http\Controllers\Controller;
use Config;
use App\DeletedRoles;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use Illuminate\Database\Eloquent\SoftDeletes;
class RoleController extends Controller
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
    public function index(Request $request,Datatables $datatables){
        $columns = [
            ['data' => 'rownum','name' => 'rownum','title' => 'Sr No.','searchable' => false],
            ['data' => 'name','name' => 'name','title' => 'Name'],
            ['data' => 'display_name','name' => 'display_name','title' => 'Display Name'],
            ['data' => 'description','name' => 'description','title' => 'Description'],
            ['data' => 'redirect_to', 'name' => 'redirect_to', 'title' => 'Redirect To'],
            ['data' => 'actions','name' => 'actions','title' => 'Actions','searchable' => false,'orderable'=>false],

        ];


//        $role_data = $role_data->selectRaw( DB::raw('@rownum  := @rownum  + 1 AS rownum').',name,display_name,description,redirect_to');

//        dd($role_data);
//        return $datatables->of($role_data);

        if ($datatables->getRequest()->ajax()) {

            DB::statement(DB::raw('set @rownum='. (isset($request->start) ? $request->start : 0) ));

            $role_data = Role::all();

            return $datatables->of($role_data)
                ->editColumn('rownum', function ($role_data) {
                    static $i = 0;
                    $i++;
                    return $i;
                })
                ->editColumn('name', function ($role_data) {
                    return $role_data->name;
                })
                ->editColumn('display_name', function ($role_data) {
                    return $role_data->display_name;
                })
                ->editColumn('description', function ($role_data) {
                    return $role_data->description;
                })
                ->editColumn('redirect_to', function ($role_data) {
                    return $role_data->redirect_to;
                })
                ->editColumn('actions', function ($role_data) {
                    return view('admin.crud_admin.role.action', compact('role_data'))->render();
                })

                ->rawColumns(['name', 'display_name', 'description','redirect_to','actions'])
                ->make(true);

        }

        $html = $datatables->getHtmlBuilder()->columns($columns)->parameters($this->getParameters());

        return view('admin.crud_admin.role.index',compact('html'));

    }

    protected function getParameters() {
        return [
            'serverSide' => true,
            'processing' => true,
            'ordering'   =>'isSorted',
            "order"=> [5, "desc" ],
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
        return view('admin.crud_admin.role.create');

    }
    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'display_name' => 'required',
            'description' => 'required',
            'redirect_to' => 'required',
        ]);
        //create the new role
        $role = new Role();
        $role->name = $request->input('name');
        $role->display_name = $request->input('display_name');
        $role->description = $request->input('description');
        $role->redirect_to = $request->input('redirect_to');
        $role->save();

        return redirect()->route('roles.index')
            ->with('success','Role created successfully');
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
        $role = Role::FindOrFail($id)->toArray();

        return view('admin.crud_admin.role.show', compact( 'role'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $role = Role::FindOrFail($id)->toArray();
        return view('admin.crud_admin.role.edit',compact('role'));
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
            'name'=> 'required',
            'display_name' => 'required',
            'description' => 'required',
            'redirect_to' => 'required',
        ]);


        $role = Role::FindOrFail($id);
        if($request->input('name') != $role['name'] ){
            $role->name = $request->input('name');
        }
        $role->display_name = $request->input('display_name');
        $role->description = $request->input('description');
        $role->redirect_to = $request->input('redirect_to');
        $role->save();
        return redirect()->route('roles.index')
            ->with('success','Role updated successfully');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Request $request, $id)
    {
        $roleDetails = Role::findOrfail($id);
        $roleDetails->delete();

        DeletedRoles::create([
        'role_details_id' => $id,
        'role_name'          => $roleDetails->name,
        'day'                => date('l'),
        'date'               => date('Y-m-d'),
        'time'               => date("h:i:s"),
        'reason'             => $request->input('delete_message'),
        'ip_address'         => $request->ip()
    ]);

        return redirect()->back()->with(['success'=> 'Role deleted succesfully']);
    }

    public function loadDeleteRoleUsingAjax(Request $request){
        $id = $request->id;
        return view('admin.crud_admin.role.roleDeleteReason', compact('id'))->render();
    }
}