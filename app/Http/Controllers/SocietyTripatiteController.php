<?php

namespace App\Http\Controllers;

use App\OlApplication;
use Illuminate\Http\Request;
use App\SocietyOfferLetter;
use App\MasterLayout;
use App\OlRequestForm;
use App\Http\Controllers\Common\CommonController;
use App\Role;
use App\RoleUser;
use App\LayoutUser;
use App\User;
use Config;

class SocietyTripatiteController extends Controller
{
    public function __construct()
    {
        $this->CommonController = new CommonController();
        $this->list_num_of_records_per_page = Config::get('commanConfig.list_num_of_records_per_page');
    }

    /**
     * Shows tripatite application form.
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function show_tripatite_self($id){
        $society_details = SocietyOfferLetter::where('user_id', auth()->user()->id)->first();
        $layouts = MasterLayout::all();
        $routes=array();
        $ol_form_request_fields = new OlRequestForm;

        foreach($ol_form_request_fields->getFillable() as $key => $value){
            if(in_array($value, config('commanConfig.tripartite_fields'))){
                $form_fields[] = $value;
            }
        }
        $layouts = MasterLayout::all();
        $comm_func = $this->CommonController;

        return view('frontend.society.tripatite.show_tripatite_self', compact('society_details', 'id', 'layouts', 'form_fields', 'layouts', 'comm_func'));
    }

    /**
     * Shows tripatite application form.
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function save_tripatite_self(Request $request){
//        dd($request->all());
        $ol_request_form_details = new OlRequestForm;
        $ol_request_form_details = $ol_request_form_details->getFillable();
        $ol_request_form['society_id'] = $request->society_id;
        foreach($request->all() as $key => $ol_request_form_detail){
            if(in_array($key, $ol_request_form_details) == true){
                $ol_request_form[$key] = $ol_request_form_detail;
            }
        }
        $ol_request_form_id = OlRequestForm::create($ol_request_form);
        $input_arr_ol_applications = array(
            'user_id' => auth()->user()->id,
            'language_id' => 1,
            'society_id' => $request->society_id,
            'layout_id' => $request->layout_id,
            'request_form_id' => $ol_request_form_id->id,
            'application_master_id' => $request->application_master_id,
            'application_no' => str_pad($ol_request_form_id, 5, '0', STR_PAD_LEFT),
            'current_status_id' => config('commanConfig.applicationStatus.in_process')
        );
        $ol_application = OlApplication::create($input_arr_ol_applications);

        $role_id = Role::where('name', config('commanConfig.ree_junior'))->first();
        $user_ids = RoleUser::where('role_id', $role_id->id)->get();
        $layout_user_ids = LayoutUser::where('layout_id', $request->input('layout_id'))->whereIn('user_id', $user_ids)->get();

        foreach ($layout_user_ids as $key => $value) {
            $select_user_ids[] = $value['user_id'];
        }
        $users = User::whereIn('id', $select_user_ids)->get();
        $insert_arr = array(
            'users' => $users
        );

        $this->CommonController->tripartite_application_status_society($insert_arr, config('commanConfig.applicationStatus.pending'), $ol_application);
        return redirect()->back();
    }

    public function show_tripatite_dev($id){
        $society_details = SocietyOfferLetter::where('user_id', auth()->user()->id)->first();
        $layouts = MasterLayout::all();
         dd($society_details);
        return view('frontend.society.tripatite.show_tripatite_dev', compact('society_details', 'id', 'layouts'));
    }

    /**
     * Shows tripatite application form.
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function save_tripatite_dev(Request $request){
        dd($request->all());
    }
}
