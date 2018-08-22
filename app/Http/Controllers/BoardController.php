<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Board;
use App\Http\Requests\board\CreateBoardRequest;
use App\Http\Requests\board\UpdateBoardRequest;

class BoardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $boards = Board::all();
        return view('admin.board.index', compact('boards'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.board.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateBoardRequest $request)
    {
        $input = $request->except('_token');
        Board::create($input);
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
        return view('admin.board.edit',compact('board'));
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
}
