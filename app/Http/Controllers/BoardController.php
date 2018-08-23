<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Board;
use App\Department;
use App\Http\Requests\board\CreateBoardRequest;
use App\Http\Requests\board\UpdateBoardRequest;
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
    public function index()
    {
        $boards = Board::all();
        $header_data = $this->header_data;
        return view('admin.board.index', compact('boards','header_data'));
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
}
