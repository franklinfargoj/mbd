<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Board;
use App\Department;
use App\BoardDepartment;
use App\Http\Requests\department\CreateDepartmentRequest;
use App\Http\Requests\department\UpdateDepartmentRequest;

class DepartmentController extends Controller
{
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
    public function index()
    {
        $departments = Department::all();
        return view('admin.department.index', compact('departments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $boards = Board::where('status', 1)->get();
        return view('admin.department.add', compact('boards'));
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
        
        return view('admin.department.edit',compact('department', 'boards', 'assignedBoardIds'));
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
}
