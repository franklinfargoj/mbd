<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Board;
use App\Department;
use App\BoardDepartment;
use App\Http\Requests\department\CreateDepartmentRequest;
use App\Http\Requests\department\UpdateDepartmentRequest;
use Yajra\DataTables\DataTables;
use Config;

class DepartmentController extends Controller
{
    public $header_data = array(
        'menu' => 'Department',
        'menu_url' => 'department',
        'page' => '',
        'side_menu' => 'department'
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
            ['data' => 'department_name','name' => 'department_name','title' => 'Department Name'],
            ['data' => 'status','name' => 'status','title' => 'Status'],
            ['data' => 'actions','name' => 'actions','title' => 'Actions','searchable' => false,'orderable'=>false],
        ];

        if ($datatables->getRequest()->ajax()) {
            
            $departments = Department::all();
            
            return $datatables->of($departments)
                ->editColumn('department_name', function ($departments) {
                    return $departments->department_name;
                })
                ->editColumn('status', function ($departments) {
                    return $departments->status;
                })
                ->editColumn('actions', function ($departments) {
                   return view('admin.department.actions', compact('departments'))->render();
                })
                ->rawColumns(['department_name','status','actions'])
                ->make(true);
        }
        
        $html = $datatables->getHtmlBuilder()->columns($columns)->postAjax()->parameters($this->getParameters());
        return view('admin.department.index', compact('departments','header_data', 'html'));
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
        $boards = Board::where('status', 1)->get();
        $header_data = $this->header_data;
        return view('admin.department.add', compact('boards','header_data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateDepartmentRequest $request)
    {
        $inputs = $request->except('_token','board_id');
        $boardInputs = $request->board_id;

        $department = Department::create($inputs);
        foreach($boardInputs as $board_id)
        {
            BoardDepartment::create([
                'board_id' => $board_id,
                'department_id' => $department->id
            ]);
        }

        return redirect('department')->with(['success'=> 'Record added succesfully']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Department $department)
    {
        $boards = Board::where('status', 1)->get();
        $assignedBoardIds = BoardDepartment::where('department_id', $department->id)->pluck('board_id')->toArray();
        $header_data = $this->header_data;
        return view('admin.department.edit',compact('department', 'boards', 'assignedBoardIds', 'header_data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDepartmentRequest $request, $id)
    {
        $department = Department::find($id);
        $department->update($request->except(['_token','method','board_id']));

        $boardInputs = $request->board_id;
        BoardDepartment::where('department_id', $id)->delete();
        foreach($boardInputs as $board_id)
        {
            BoardDepartment::create([
                'board_id' => $board_id,
                'department_id' => $id
            ]);
        }

        return redirect('department')->with(['success'=> 'Record updated succesfully']);
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
      $department = Department::find($id);
      $status =($department->status==0)? 1 : 0;
      $department->update(['status'=>$status]);
      return redirect('department')->with(['success'=> 'Status Changed succesfully.']);
    }
}
