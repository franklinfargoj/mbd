<?php

namespace App\Http\Controllers;

use App\EmploymentOfArchitect\EoaApplication;
use App\Repositories\Repository;
use Illuminate\Http\Request;
use Validator;
use App\Role;

class EmploymentOfArchitectController extends Controller
{
    protected $model, $user;

    public function __construct(EoaApplication $EoaApplication)
    {
        // set the model
        $this->user = new Repository($EoaApplication);
        $this->model = new Repository($EoaApplication);
    }

    public function signup()
    {
        return view('employment_of_architect.signup');
    }

    public function create_user(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users|max:255',
            'mobile_no' => 'required|unique:users|max:255',
            'password' => 'required|same:confirm_password',
            'confirm_password'=>'required'
        ]);
        if ($validator->fails()) {
            $errors=$validator->errors();
            return back()->withErrors($errors);
        } else {
            
            $role = Role::where('name', config('commanConfig.appointing_architect'))->first();
            if($role)
            {
                $role_id=$role->id;
            }else
            {
                $role_id = Role::insertGetId([
                    'name'         => 'appointing_architect',
                    'redirect_to'  => '/appointing_architect',
                    'parent_id'    => NULL,
                    'display_name' => 'appointing_architect',
                    'description'  => 'appointing_architect'
                ]);
            }
            
            $user_data = [
                'name' => $request->name,
                'email' => $request->email,
                'mobile_no' => $request->mobile_no,
                'role_id' => $role_id,
                'password' => bcrypt('password'),
            ];
            //dd('ok');
           if($this->user->create($user_data))
           {
            return redirect()->route('appointing_architect.login')->with('registered', 'Registered successfully!');
           }
           return redirect()->route('appointing_architect.login')->with('error', 'Something went wrong!');

           
        }

    }

    public function index(Request $request)
    {

        //return $this->model->all();
        return view('employment_of_architect.form1');
    }

    public function post_form1(Request $request)
    {
        $form1_data = [
            'category_of_panel' => $request->category_of_panel,
            'name_of_applicant' => $request->name_of_applicant,
            'address' => $request->address,
            'city' => $request->city,
            'pin' => $request->pin,
            'mobile' => $request->mobile,
            'off' => $request->off,
            'fax' => $request->fax,
            'res' => $request->res,
            'category_of_panel' => $request->category_of_panel,
            'category_of_panel' => $request->category_of_panel,
        ];

        $this->model->create($request->only($this->model->getModel()->fillable));
        return $request->all();
    }
}
