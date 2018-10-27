<?php

namespace App\Http\Controllers;

use App\EmploymentOfArchitect\EoaApplication;
use App\EmploymentOfArchitect\EoaApplicationFeePaymentDetail;
use App\Repositories\Repository;
use App\Role;
use App\RoleUser;
use App\User;
use Illuminate\Http\Request;
use Validator;

class EmploymentOfArchitectController extends Controller
{
    protected $model, $user;

    public function __construct(EoaApplication $EoaApplication, User $user,EoaApplicationFeePaymentDetail $EoaApplicationFeePaymentDetail)
    {
        // set the model
        $this->user = new Repository($user);
        $this->model = new Repository($EoaApplication);
        $this->fee_payment=new Repository($EoaApplicationFeePaymentDetail);
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
            'address' => 'required',
            'confirm_password' => 'required',
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors();
            return back()->withErrors($errors)->withInput();
        } else {

            $role = Role::where('name', config('commanConfig.appointing_architect'))->first();
            if ($role) {
                $role_id = $role->id;
            } else {
                $role_id = Role::insertGetId([
                    'name' => 'appointing_architect',
                    'redirect_to' => '/appointing_architect/index',
                    'parent_id' => null,
                    'display_name' => 'appointing_architect',
                    'description' => 'appointing_architect',
                ]);
            }

            $user_data = [
                'name' => $request->name,
                'email' => $request->email,
                'mobile_no' => $request->mobile_no,
                'role_id' => $role_id,
                'password' => bcrypt($request->password),
                'address' => $request->address,
                'uploaded_note_path' => 'Test',
            ];
            //dd($this->user->create($user_data));
            $user = $this->user->create($user_data);
            if ($user) {
                $role_user = array(
                    'user_id' => $user->id,
                    'role_id' => $role_id,
                    'start_date' => \Carbon\Carbon::now(),
                    'end_date' => '',
                );
                // dd($role_user);
                if (RoleUser::where(['user_id' => $user->id, 'role_id' => $role_id])->first()) {

                } else {
                    RoleUser::create($role_user);
                }

                return redirect()->route('appointing_architect.login')->with('registered', 'Registered successfully!');
            }
            return redirect()->route('appointing_architect.login')->with('error', 'Something went wrong!');

        }

    }

    public function index(Request $request)
    {
        //dd(session()->all());
        //return $this->model->all();
        return view('employment_of_architect.index');
    }

    public function step1($id)
    {
        $application = $this->model->whereWithFirst(['fee_payment_details'],['id' => $id, 'user_id' => auth()->user()->id]);
        return view('employment_of_architect.form1', compact('application'));
    }

    public function step1_post(Request $request)
    {
        $v = Validator::make($request->all(), [
            'category_of_panel' => 'required',
            'name_of_applicant' => 'required',
            'address' => 'required',
            'city' => 'required',
            'pin' => 'required',
            'mobile' => 'required',
            'off' => 'required',
            'fax' => 'required',
            'res' => 'required',
        ]);
        $application_id = $request->application_id;
        if ($v->fails()) {
            return redirect()->back()->withErrors($v->errors());
        } else {
            
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
                'user_id'=>auth()->user()->id
            ];
            $data = $this->model->updateWhere($form1_data, ['id' => $application_id, 'user_id' => auth()->user()->id]);
            if ($data) {
                $payment_data=[
                    'eoa_application_id'=>$application_id,
                    'receipt_no'=>$request->receipt_no,
                    'cash'=>$request->cash,
                    'pay_order_no'=>$request->pay_order_no,
                    'bank'=>$request->bank,
                    'branch'=>$request->branch,
                    'date_of_payment'=>$request->date_of_payment,
                    'receipt_date'=>$request->receipt_date
                ];
                if($this->fee_payment->whereFirst(['eoa_application_id'=>$application_id]))
                {
                    $this->fee_payment->updateWhere($payment_data, ['eoa_application_id' => $application_id]);
                }else
                {
                    $this->fee_payment->create($payment_data);
                }
                return redirect()->route('appointing_architect.step2', ['id' => $application_id]);
            }
        }

    }

    public function step2(Request $request)
    {
        //dd(session()->all());
        //return $this->model->all();
        return view('employment_of_architect.form2');
    }

    public function step3(Request $request)
    {
        //dd(session()->all());
        //return $this->model->all();
        return view('employment_of_architect.form3');
    }

    public function step4(Request $request)
    {
        //dd(session()->all());
        //return $this->model->all();
        return view('employment_of_architect.form4');
    }

    public function step5(Request $request)
    {
        //dd(session()->all());
        //return $this->model->all();
        return view('employment_of_architect.form5');
    }

    public function step6(Request $request)
    {
        //dd(session()->all());
        //return $this->model->all();
        return view('employment_of_architect.form6');
    }

    public function step7(Request $request)
    {
        //dd(session()->all());
        //return $this->model->all();
        return view('employment_of_architect.form7');
    }

    public function step8(Request $request)
    {
        //dd(session()->all());
        //return $this->model->all();
        return view('employment_of_architect.form8');
    }

}
