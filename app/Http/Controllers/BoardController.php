<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use function foo\func;
use Illuminate\Http\Request;
use App\Board;
use App\Department;
use App\Http\Requests\board\CreateBoardRequest;
use App\Http\Requests\board\UpdateBoardRequest;
use Yajra\DataTables\DataTables;
use Config;

class BoardController extends Controller
{
    public $header_data = array(
        'menu' => 'Board',
        'menu_url' => 'board',
        'page' => '',
        'side_menu' => 'board'
    );

    protected $list_num_of_records_per_page;

    public function __construct()
    {
        $this->list_num_of_records_per_page = Config::get('commanConfig.list_num_of_records_per_page');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Datatables $datatables)
    {
        
        $header_data = $this->header_data;
        $columns = [
            ['data' => 'board_name','name' => 'board_name','title' => 'Board Name'],
            ['data' => 'status','name' => 'status','title' => 'Status'],
            ['data' => 'actions','name' => 'actions','title' => 'Actions','searchable' => false,'orderable'=>false],
        ];

        if ($datatables->getRequest()->ajax()) {
            
            $boards = Board::all();
            
            return $datatables->of($boards)
                ->editColumn('board_name', function ($boards) {
                    return $boards->board_name;
                })
                ->editColumn('status', function ($boards) {
                    return $boards->status;
                })
                ->editColumn('actions', function ($boards) {
                   return view('admin.board.actions', compact('boards'))->render();
                })
                ->rawColumns(['board_name','status','actions'])
                ->make(true);
        }
        
        $html = $datatables->getHtmlBuilder()->columns($columns)->parameters($this->getParameters());

        return view('admin.board.index', compact('boards', 'html','header_data'));
    }

    protected function getParameters() {
        return [
            'serverSide' => true,
            'processing' => true,
            'ordering'   =>'isSorted',
            "order"=> [2, "desc" ],
            "pageLength" => $this->list_num_of_records_per_page,
            // 'fixedHeader' => [
            //     'header' => true,
            //     'footer' => true
            // ]
        ];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $header_data = $this->header_data;
        return view('admin.board.add', compact('header_data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateBoardRequest $request)
    {
        $inputs = $request->except('_token');
        Board::create($inputs);
        return redirect('board')->with(['success'=> 'Record added succesfully']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Board $board)
    {
        $header_data = $this->header_data;
        return view('admin.board.edit',compact('board','header_data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBoardRequest $request, $id)
    {
        $board = Board::find($id);
        $board->update($request->except(['_token','method']));

        return redirect('board')->with(['success'=> 'Record updated succesfully']);
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

    public function change_status($id)
    {
      $board = Board::find($id);
      $status =($board->status==0)? 1 : 0;
      $board->update(['status'=>$status]);
      return redirect('board')->with(['success'=> 'Status Changed succesfully.']);
    }

    public function loadDepartmentsOfBoardUsingAjax(Request $request)
    {
        $departments = Department::whereHas('boardDepartments', function($q) use ($request){
            $q->where('board_id', $request->board_id);
        })->get()->toArray();

        $options = '<option value="">Select Department</option>';

        foreach($departments as $departmentVal)
        {
            $options .= '<option value="'.$departmentVal['id'].'">'.$departmentVal['department_name'].'</option>';
        }

        return $options;
    }

    public function loadDepartmentsOfBoardForHearing(Request $request)
    {
        $logged_in_role_name = session()->get('role_name');

        if($logged_in_role_name == config('commanConfig.joint_co_pa') || $logged_in_role_name == config('commanConfig.joint_co'))
        {
//            $role = Role::where('name', config('commanConfig.co'))->get()->toArray();
            $role_name = config('commanConfig.co');
        }
        if($logged_in_role_name == config('commanConfig.co_pa') || $logged_in_role_name == config('commanConfig.co'))
        {
//            $role = Role::where('name', config('commanConfig.joint_co'))->get()->toArray();
            $role_name = config('commanConfig.joint_co');
        }
//        dd($role);

        $department_id = Department::where('department_name', $role_name)->get(['id']);


        $departments = Department::whereHas('boardDepartments', function($q) use ($request, $department_id){
            $q->where('board_id', $request->board_id)
                ->whereIn('department_id', $department_id);
        })->get()->toArray();

        $options = '<option value="">Select Department</option>';

        foreach ($departments as $departmentVal) {
            $options .= '<option value="' . $departmentVal['id'] . '">' . $departmentVal['department_name'] . '</option>';
        }

        return $options;
    }

    public function getDepartmentUser(Request $request)
    {
        $logged_in_role_name = session()->get('role_name');

        if($logged_in_role_name == config('commanConfig.co_pa') || $logged_in_role_name == config('commanConfig.co'))
        {
            $role_name = config('commanConfig.joint_co_pa');
        }

        if($logged_in_role_name == config('commanConfig.joint_co_pa') || $logged_in_role_name == config('commanConfig.joint_co'))
        {
            $role_name = config('commanConfig.co_pa');
        }

        $role_id = Role::where('name', $role_name)->first();

        $users = User::whereHas('boardUser' , function($q) use($request){
            $q->where('board_id', $request->board_id);
        })->where('role_id', $role_id->id)->get()->toArray();


        $options = '';
        if($request->department_id) {
            foreach ($users as $userData) {
                $options .= '<option data-role="' . $userData['role_id'] . '" value="' . $userData['id'] . '">' . $userData['name'] . '</option>';
            }
        }
        return $options;
    }
}
