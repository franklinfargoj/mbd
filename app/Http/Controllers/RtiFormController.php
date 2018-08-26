<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Board;
use App\Department;
use App\RtiForm;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\rti\RtiFormSubmitRequest;
use App\Http\Requests\rti\SearchRtiFrontendRequest;


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
        $time = time();
        $input['unique_id'] = $time;
        $input['frontend_user_id'] = Session::get('fronendLoginId');
        $input['applicant_name'] = $request->get('fullname');
        $input['applicant_addr'] = $request->get('address');
        Session::put('rtiFormId',$input['unique_id']);

        if($request->hasFile('poverty_line_proof_file'))
        {
            $extension = $request->file('poverty_line_proof_file')->getClientOriginalExtension();
            $path = Storage::putFileAs( '/poverty_files', $request->file('poverty_line_proof_file'), $time.'.'.$extension, 'public');
            $input['poverty_line_proof'] = $request->get($time.'.'.$extension);
        }
        RtiForm::create($input);
        return redirect('rti_form_success');
    }

    public function rtiFormSuccess()
    {
        return view('admin.rti_form.rtiFormSuccess');
    }

    public function rtiFormSuccessClose()
    {
        Session::flush();
        return redirect('/');
    }


    public function searchRtiForm()
    {

    }
}
