<?php

namespace App\Http\Controllers;

use App\EmploymentOfArchitect\EoaApplication;
use App\EmploymentOfArchitect\EoaApplicationEnclosure;
use App\EmploymentOfArchitect\EoaApplicationFeePaymentDetail;
use App\EmploymentOfArchitect\EoaApplicationImportantProjectDetail;
use App\Repositories\Repository;
use App\Role;
use App\RoleUser;
use App\User;
use Illuminate\Http\Request;
use Validator;
use Yajra\DataTables\DataTables;

class EmploymentOfArchitectController extends Controller
{
    protected $model, $user, $fee_payment, $enclosures, $list_num_of_records_per_page;

    public $header_data = array(
        'menu' => 'Architect Application',
        'menu_url' => 'architect_application',
        'page' => '',
        'side_menu' => 'architect_application',
    );

    public function __construct(EoaApplication $EoaApplication, User $user, EoaApplicationFeePaymentDetail $EoaApplicationFeePaymentDetail, EoaApplicationEnclosure $EoaApplicationEnclosure, EoaApplicationImportantProjectDetail $EoaApplicationImportantProjectDetail)
    {
        // set the model
        $this->user = new Repository($user);
        $this->model = new Repository($EoaApplication);
        $this->fee_payment = new Repository($EoaApplicationFeePaymentDetail);
        $this->enclosures = new Repository($EoaApplicationEnclosure);
        $this->imp_projects = new Repository($EoaApplicationImportantProjectDetail);
        $this->list_num_of_records_per_page = config('commanConfig.list_num_of_records_per_page');
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

    public function index(Request $request, Datatables $datatables)
    {
        $header_data = $this->header_data;
        $columns = [
            ['data' => 'rownum', 'name' => 'rownum', 'title' => 'Sr No.', 'searchable' => false],
            ['data' => 'application_number', 'name' => 'application_number', 'title' => 'Application Number'],
            ['data' => 'application', 'name' => 'application', 'title' => 'Application'],
            ['data' => 'application_date', 'name' => 'application_date', 'title' => 'Application Date'],
            ['data' => 'actions', 'name' => 'actions', 'title' => 'Actions', 'searchable' => false, 'orderable' => false],
        ];

        if ($datatables->getRequest()->ajax()) {

            $architect_applications = $this->model->all();
            return $datatables->of($architect_applications)
                ->editColumn('rownum', function ($listArray) {
                    static $i = 0; $i++;return $i;
                })
                ->editColumn('application_number', function ($architect_applications) {
                    return $architect_applications->id;
                })
                ->editColumn('application', function ($architect_applications) {
                    return "application";
                })
                ->editColumn('application_date', function ($architect_applications) {
                    return date('d-m-Y', strtotime($architect_applications->created_at));
                })
                ->editColumn('actions', function ($architect_applications) {
                    return "<a href='" . route('appointing_architect.step1', ['id' => $architect_applications->id]) . "'>edit</a>";
                })
                ->rawColumns(['select', 'application_number', 'application', 'application_date', 'actions'])
                ->make(true);
        }

        $html = $datatables->getHtmlBuilder()->columns($columns)->parameters($this->getParameters());

        //return view('admin.architect.index', compact('html', 'header_data', 'shortlisted', 'finalSelected', 'getData', 'is_view', 'is_commitee'));
        //dd(session()->all());
        //return $this->model->all();
        return view('employment_of_architect.index', compact('html', 'header_data'));
    }

    protected function getParameters()
    {
        return [
            'serverSide' => true,
            'processing' => true,
            'ordering' => 'isSorted',
            "order" => [4, "desc"],
            "pageLength" => $this->list_num_of_records_per_page,
            // 'fixedHeader' => [
            //     'header' => true,
            //     'footer' => true
            // ]
        ];
    }

    public function step1($id)
    {
        $application = $this->model->whereWithFirst(['fee_payment_details'], ['id' => $id, 'user_id' => auth()->user()->id]);
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
                'user_id' => auth()->user()->id,
            ];
            $data = $this->model->updateWhere($form1_data, ['id' => $application_id, 'user_id' => auth()->user()->id]);
            if ($data) {
                $payment_data = [
                    'eoa_application_id' => $application_id,
                    'receipt_no' => $request->receipt_no,
                    'cash' => $request->cash,
                    'pay_order_no' => $request->pay_order_no,
                    'bank' => $request->bank,
                    'branch' => $request->branch,
                    'date_of_payment' => date('Y-m-d', strtotime($request->date_of_payment)),
                    'receipt_date' => date('Y-m-d', strtotime($request->receipt_date)),
                ];

                if ($this->fee_payment->whereFirst(['eoa_application_id' => $application_id])) {
                    $this->fee_payment->updateWhere($payment_data, ['eoa_application_id' => $application_id]);
                } else {
                    $this->fee_payment->create($payment_data);
                }

                return redirect()->route('appointing_architect.step2', ['id' => $application_id]);
            }
        }

    }

    public function step2($id)
    {
        $application = $this->model->whereWithFirst(['fee_payment_details', 'enclosures'], ['id' => $id, 'user_id' => auth()->user()->id]);
        //dd($application->enclosures[0]);
        return view('employment_of_architect.form2', compact('application'));
    }

    public function step2_post(Request $request)
    {
        $v = Validator::make($request->all(), [
            'application_info_and_its_enclosures_verify' => 'required',
        ], [
            'application_info_and_its_enclosures_verify.required' => 'The application info and its enclosures acceptance is required',
        ]);
        $application_id = $request->application_id;
        if ($v->fails()) {
            return redirect()->back()->withErrors($v->errors());
        } else {

            $enclosure_id = $request->enclosure_id;
            $j = 0;
            foreach ($request->enclosures as $enclosure) {
                $enclosures_array = array();
                if (isset($enclosure_id[$j])) {
                    $enclosures_array = array('eoa_application_id' => $application_id, 'enclosure' => $enclosure);
                    $this->enclosures->updateWhere($enclosures_array, ['id' => $enclosure_id[$j], 'eoa_application_id' => $application_id]);
                } else {
                    $enclosures_array = array('eoa_application_id' => $application_id, 'enclosure' => $enclosure);
                    $this->enclosures->create($enclosures_array);
                }
                $j++;
            }
            $this->model->updateWhere(['application_info_and_its_enclosures_verify' => $request->application_info_and_its_enclosures_verify], ['id' => $application_id]);
            return redirect()->route('appointing_architect.step3', ['id' => $application_id]);
        }
    }

    public function step3($id)
    {
        $application = $this->model->whereWithFirst(['fee_payment_details', 'enclosures'], ['id' => $id, 'user_id' => auth()->user()->id]);
        return view('employment_of_architect.form3', compact('application'));
    }

    public function step3_post(Request $request)
    {
        $v = Validator::make($request->all(), [
            'details_of_establishment' => 'required',
            'branch_office_details' => 'required',
            'staff_architects' => 'required',
            'staff_engineers' => 'required',
            'staff_supporting_tech' => 'required',
            'staff_supporting_nontech' => 'required',
            'staff_others' => 'required',
            'staff_total' => 'required',
            'is_cad_facility' => 'required',
            'cad_facility_no_of_computers' => 'required',
            'cad_facility_no_of_printers' => 'required',
            'cad_facility_no_of_plotters' => 'required',
            'reg_with_council_of_architecture_principle' => 'required',
            'reg_with_council_of_architecture_associate' => 'required',
            'reg_with_council_of_architecture_partner' => 'required',
            'reg_with_council_of_architecture_total_registered_persons' => 'required',
            'award_prizes_etc' => 'required',
            'other_information' => 'required',
        ]);

        if ($v->fails()) {
            return redirect()->back()->withErrors($v->errors());
        } else {
            $application_id = $request->application_id;
            $step3_data = [
                'details_of_establishment' => $request->details_of_establishment,
                'branch_office_details' => $request->branch_office_details,
                'staff_architects' => $request->staff_architects,
                'staff_engineers' => $request->staff_engineers,
                'staff_supporting_tech' => $request->staff_supporting_tech,
                'staff_supporting_nontech' => $request->staff_supporting_nontech,
                'staff_others' => $request->staff_others,
                'staff_total' => $request->staff_total,
                'is_cad_facility' => $request->is_cad_facility,
                'cad_facility_no_of_computers' => $request->cad_facility_no_of_computers,
                'cad_facility_no_of_printers' => $request->cad_facility_no_of_printers,
                'cad_facility_no_of_plotters' => $request->cad_facility_no_of_plotters,
                'reg_with_council_of_architecture_principle' => $request->reg_with_council_of_architecture_principle,
                'reg_with_council_of_architecture_associate' => $request->reg_with_council_of_architecture_associate,
                'reg_with_council_of_architecture_partner' => $request->reg_with_council_of_architecture_partner,
                'reg_with_council_of_architecture_total_registered_persons' => $request->reg_with_council_of_architecture_total_registered_persons,
                'award_prizes_etc' => $request->award_prizes_etc,
                'other_information' => $request->other_information,
            ];
            if ($this->model->updateWhere($step3_data, ['id' => $application_id])) {
                return redirect()->route('appointing_architect.step4', ['id' => $application_id]);
            } else {
                return back()->withError('Something went wrong');
            }
        }
    }

    public function step4($id)
    {
        $application = $this->model->whereWithFirst(['fee_payment_details', 'enclosures'], ['id' => $id, 'user_id' => auth()->user()->id]);
        dd($this->imp_projects);
        return view('employment_of_architect.form4');
    }

    public function step4_post(Request $request)
    {
        $v = Validator::make($request->all(), [
            '*.name_of_client' => 'required',
            '*.location' => 'required',
            '*.category_of_client' => 'required',
        ]);

        if ($v->fails()) {
            return redirect()->back()->withErrors($v->errors());
        } else {
            
            $imp_project_id = $request->imp_project_id;
            $name_of_clients = $request->name_of_client;
            $locations = $request->location;
            $category_of_clients = $request->category_of_client;
            $i = 0;
            $application_id = $request->application_id;
            foreach ($name_of_clients as $name_of_client) {
                $imp_project_data_array = array();
                if (isset($imp_project_id[$i])) {
                    $imp_project_data_array_with_id[] = [
                        'eoa_application_id' => $application_id,
                        'name_of_client' => $name_of_client,
                        'location' => $locations[$i],
                        'category_of_client' => $name_of_clients[$i],
                    ];
                    $this->imp_projects->updateWhere($imp_project_data_array_with_id, ['id' => $imp_project_id[$i], 'eoa_application_id' => $application_id]);
                } else {
                    $imp_project_data_array_without_id[] = [
                        'eoa_application_id' => $application_id,
                        'name_of_client' => $name_of_client,
                        'location' => $locations[$i],
                        'category_of_client' => $name_of_clients[$i],
                    ];
                    $this->imp_projects->create($imp_project_data_array_without_id);
                }

                $i++;
            }
            return redirect()->route('appointing_architect.step5', ['id' => $application_id]);
            //$this->imp_projects->create($imp_project_data_array_without_id);
        }
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
