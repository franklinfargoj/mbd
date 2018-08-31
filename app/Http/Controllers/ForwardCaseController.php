<?php

namespace App\Http\Controllers;

use App\Board;
use App\ForwardCase;
use App\Hearing;
use Illuminate\Http\Request;

class ForwardCaseController extends Controller
{
    public $header_data = array(
        'menu' => 'Forward Case',
        'menu_url' => 'hearing'
    );

    public function create($id)
    {
        $header_data = $this->header_data;
        $arrData['hearing'] = Hearing::with(['hearingBoard', 'hearingDepartment'])
                                        ->where('id', $id)->first();
        $arrData['board'] = Board::where('status', 1)->get();

        return view('admin.forward_case.create', compact('header_data', 'arrData'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'board' => "required",
            'department' => "required",
            'description' => "required",
        ]);

        $data = [
            'board_id' => $request->board,
            'department_id' => $request->department,
            'hearing_id' => $request->hearing_id,
            'description' => $request->description,
        ];

        ForwardCase::create($data);

        return redirect('hearing')->with(['success'=> 'Record added succesfully']);
    }
}
