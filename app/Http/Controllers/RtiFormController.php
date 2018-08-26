<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Board;
use App\Department;
use App\RtiForm;
use App\Http\Requests\rti\RtiFormSubmitRequest;

class RtiFormController extends Controller
{
    public function showFrontendForm()
    {
        if(Session::has('fronendLoginId'))
        {
            $boards = Board::where('status',1)->get();
            $departments = Department::where('status',1)->get();
            return view('frontendRtiForm',compact('departments','boards'));
        }
        else{
            return redirect('/frontend_register');
        }
    }

    public function saveFrontendForm(RtiFormSubmitRequest $request)
    {
        $input = $request->except(['_token']);
        $input['unique_id'] = time();
        Session::put('rtiFormId',$input['unique_id']);
        RtiForm::create($input);

        return redirect('rti_form_success');
    }

    public function rtiFormSuccess()
    {

    }
}
