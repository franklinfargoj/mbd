<?php
namespace App\Http\Controllers\CRUDAdmin;
use App\DeletedUser;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Config;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
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
            ['data' => 'email','name' => 'email','title' => 'Email'],
            ['data' => 'role_id','name' => 'role_id','title' => 'Role'],
            ['data' => 'mobile_no', 'name' => 'mobile_no', 'title' => 'Mobile No'],
            ['data' => 'address', 'name' => 'address', 'title' => 'Address'],
            ['data' => 'service_start_date', 'name' => 'service_start_date', 'title' => 'Service Start Date'],
            ['data' => 'service_end_date', 'name' => 'service_end_date', 'title' => 'Service End Date'],
            ['data' => 'last_login_at', 'name' => 'last_login_at', 'title' => 'Last Login At'],
            ['data' => 'actions','name' => 'actions','title' => 'Actions','searchable' => false,'orderable'=>false],

        ];


//        $role_data = $role_data->selectRaw( DB::raw('@rownum  := @rownum  + 1 AS rownum').',name,display_name,description,redirect_to');

//        dd($role_data);
//        return $datatables->of($role_data);

        if ($datatables->getRequest()->ajax()) {

            DB::statement(DB::raw('set @rownum='. (isset($request->start) ? $request->start : 0) ));

            $user_data = User::all();

            return $datatables->of($user_data)
                ->editColumn('rownum', function ($user_data) {
                    static $i = 0;
                    $i++;
                    return $i;
                })
                ->editColumn('name', function ($user_data) {
                    return $user_data->name;
                })
                ->editColumn('email', function ($user_data) {
                    return $user_data->email;
                })
                ->editColumn('role_id', function ($user_data) {
                    return $user_data->role_id;
                })
                ->editColumn('mobile_no', function ($user_data) {
                    return $user_data->mobile_no;
                })
                ->editColumn('address', function ($user_data) {
                    return $user_data->address;
                })
                ->editColumn('service_start_date', function ($user_data) {
                    return $user_data->service_start_date;
                })
                ->editColumn('service_end_date', function ($user_data) {
                    return $user_data->service_end_date;
                })
                ->editColumn('last_login_at', function ($user_data) {
                    return $user_data->last_login_at;
                })
                ->editColumn('actions', function ($user_data) {
                    return view('admin.crud_admin.user.action', compact('user_data'))->render();
                })

                ->rawColumns(['name', 'email','role_id','mobile_no','address','service_start_date','service_end_date','last_login_at','actions'])
                ->make(true);

        }

        $html = $datatables->getHtmlBuilder()->columns($columns)->parameters($this->getParameters());

        return view('admin.crud_admin.user.index',compact('html'));

    }

    protected function getParameters() {
        return [
            'serverSide' => true,
            'processing' => true,
            'ordering'   =>'isSorted',
            "order"=> [0, "desc" ],
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
        $roles = Role::get();
        return view('admin.crud_admin.user.create',compact('roles'));

    }
    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'mobile_no' => 'max:10|required|regex:/[0-9]{10}/',
            'address' => 'required',
            'password' => 'alpha_num|required|confirmed',
            'service_start_date' => 'required',
            'service_end_date' => 'required'
            ]);

        //create the new user
        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->mobile_no = $request->input('mobile_no');
        $user->address = $request->input('address');
        $user->password = Hash::make($request->input('password'));
//        $user->service_start_date = $request->input('service_start_date');
//        $user->service_end_date = $request->input('service_end_date');
        $user->service_start_date = NULL;
        $user->service_end_date = NULL;
        $user->role_id = $request->input('role_id');
        $user->uploaded_note_path = 'test';

        $user->save();

        return redirect()->route('users.index')
            ->with('success','User created successfully');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $roles = Role::get();
        $user = User::FindOrFail($id)->toArray();

        return view('admin.crud_admin.user.show', compact( 'user','roles'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $roles = Role::get();
        $user = User::FindOrFail($id)->toArray();
        return view('admin.crud_admin.user.edit',compact('user','roles'));
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
            'email' => 'required|email',
            'mobile_no' => 'max:10|required|regex:/[0-9]{10}/',
            'address' => 'required',
            'service_start_date' => 'required',
            'service_end_date' => 'required'
        ]);


        if(!($request->input('password')== null)){
            $this->validate($request, ['password' => 'alpha_num|required|confirmed' ]);
        }

        $user = User::FindOrFail($id);
        $user->name = $request->input('name');
        if($request->input('email') != $user['email'] ){
            $user->email = $request->input('email');
        }
        $user->mobile_no = $request->input('mobile_no');
        $user->address = $request->input('address');
        if ($request->input('password')) {
            $user->password = Hash::make($request->input('password'));
        }
        $user->service_start_date = date('Y-m-d', strtotime($request->input('service_start_date')));
        $user->service_end_date = date('Y-m-d', strtotime($request->input('service_end_date')));
//        $user->service_start_date = NULL;
//        $user->service_end_date = NULL;
        $user->role_id = $request->input('role_id');
        $user->uploaded_note_path = 'test';
//
        $user->save();

        return redirect()->route('users.index')
            ->with('success','user updated successfully');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Request $request, $id)
    {
        $userDetails = User::findOrfail($id);
        $userDetails->delete();

        DeletedUser::create([
            'user_details_id' => $id,
            'email'          => $userDetails->email,
            'day'                => date('l'),
            'date'               => date('Y-m-d'),
            'time'               => date("h:i:s"),
            'reason'             => $request->input('delete_message'),
        ]);

        return redirect()->back()->with(['success'=> 'User deleted succesfully']);
    }

    public function loadDeleteUserUsingAjax(Request $request){
        $id = $request->id;
        return view('admin.crud_admin.user.userDeleteReason', compact('id'))->render();
    }
}