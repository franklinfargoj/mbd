<?php
namespace App\Http\Controllers\CRUDAdmin;
use App\DeletedLayouts;
use App\DeletedUserLayouts;
use App\LayoutUser;
use App\MasterLayout;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Config;
use App\Board;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Yajra\DataTables\DataTables;
use Illuminate\Database\Eloquent\SoftDeletes;
class UserLayoutController extends Controller
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
            ['data' => 'user_id','name' => 'user_id','title' => 'User'],
            ['data' => 'layout_id','name' => 'layout_id','title' => 'Layout'],
            ['data' => 'actions','name' => 'actions','title' => 'Actions','searchable' => false,'orderable'=>false],

        ];


//        $layout_data = $layout_data->selectRaw( DB::raw('@rownum  := @rownum  + 1 AS rownum').',name,division,board,redirect_to');

//        dd($layout_data);
//        return $datatables->of($layout_data);

//        dd(User::where('id',17)->value('name'));
        if ($datatables->getRequest()->ajax()) {

            DB::statement(DB::raw('set @rownum='. (isset($request->start) ? $request->start : 0) ));

            $user_layout_data = LayoutUser::all();

            return $datatables->of($user_layout_data)
                ->editColumn('rownum', function ($user_layout_data) {
                    static $i = 0;
                    $i++;
                    return $i;
                })
                ->editColumn('user_id', function ($user_layout_data) {
                    return User::where('id',$user_layout_data->user_id)->value('name');
                })
                ->editColumn('layout_id', function ($user_layout_data) {
                    return MasterLayout::where('id',$user_layout_data->layout_id)->value('layout_name');
                })
                ->editColumn('actions', function ($user_layout_data) {
                    return view('admin.crud_admin.user_layout.action', compact('user_layout_data'))->render();
                })

                ->rawColumns(['user_id', 'layout_id', 'actions'])
                ->make(true);

        }

        $html = $datatables->getHtmlBuilder()->columns($columns)->parameters($this->getParameters());

        return view('admin.crud_admin.user_layout.index',compact('html'));

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
        $users = User::with('roleDetails')->get()->toArray();
        $layouts = MasterLayout::get()->toArray();
        return view('admin.crud_admin.user_layout.create',compact('users','layouts'));


    }
    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'user_id' => 'required',
            'layout_id' => 'required',
        ]);
        //create the new layout
        $layout = new LayoutUser();
        $layout->layout_id = $request->input('layout_id');
        $layout->user_id = $request->input('user_id');
        $layout->save();

        return redirect()->route('user_layouts.index')
            ->with('success','User Layout Mapped Successfully');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $users = User::get()->toArray();
        $layouts = MasterLayout::get()->toArray();
        $user_layout = LayoutUser::where('id',$id)->first()->toArray();
        return view('admin.crud_admin.user_layout.show',compact('layouts','user_layout','users'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $users = User::get()->toArray();
        $layouts = MasterLayout::get()->toArray();
        $user_layout = LayoutUser::where('id',$id)->first();
        return view('admin.crud_admin.user_layout.edit',compact('layouts','user_layout','users'));
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
            'layout_id'=> 'required',
            'user_id' => 'required',
        ]);

        $user_layout = LayoutUser::FindOrFail($id);
        if(!($request->user_id == $user_layout['user_id']) || !($request->layout_id == $user_layout['layout_id']) ){
            $user_layout = LayoutUser::where('user_id',$request->input('user_id'))->where('layout_id',$request->input('layout_id'))->first();
            if($user_layout == NULL){
                $user_layout = LayoutUser::FindOrFail($id);
                $user_layout->layout_id = $request->input('layout_id');
                $user_layout->user_id = $request->input('user_id');
                $user_layout->save();

                return redirect()->route('user_layouts.index')
                    ->with('success','User Layout Mapping Updated Successfully');
            }
            else{
                return Redirect::back()->with('error','User Layout Mapping Already Exist');
            }
        }
        else{
            return redirect()->route('user_layouts.index')
                ->with('success','User Layout Mapping Updated Successfully');
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Request $request, $id)
    {
        $layoutDetails = LayoutUser::findOrfail($id);
        $layoutDetails->delete();
        //dd($layoutDetails->toArray());


        DeletedUserLayouts::create([
            'user_layouts_details_id' => $id,
            'user_id'            => Auth::user()->id,
            'user_name'          => User::where('id',$layoutDetails->user_id)->value('name'),
            'layout_name'        => MasterLayout::where('id',$layoutDetails->layout_id)->value('layout_name'),
            'day'                => date('l'),
            'date'               => date('Y-m-d'),
            'time'               => date("h:i:s"),
            'reason'             => $request->input('delete_message'),
        ]);

        return redirect()->back()->with(['success'=> 'User Layout deleted succesfully']);
    }

    public function loadDeleteUserLayoutUsingAjax(Request $request){
        $id = $request->id;
        return view('admin.crud_admin.user_layout.userLayoutDeleteReason', compact('id'))->render();
    }

    public function getLayout(Request $request){
        
        try{
            $userId = $request->userId;
            $roleId = User::where('id',$userId)->value('role_id');
            $layoutIds = LayoutUser::with(['user' => function ($query) use($roleId){
                $query->where('role_id',$roleId);
            }])->whereHas('user', function($query) use($roleId){
                $query->where('role_id',$roleId);
            })->pluck('layout_id');

            $layout = MasterLayout::whereNotIn('id',$layoutIds)->get(); 
            $response['status'] = 'success';          
            $response['data'] = $layout;          

        }catch(Exception $e){
            $response['status'] = 'error';
            $response['data'] = '';
        }
        return response(json_encode($response), 200);
    }
}