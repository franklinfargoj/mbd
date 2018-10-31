<?php

namespace App\Http\Controllers;

use App\EmploymentOfArchitect\EoaApplication;
use App\EmploymentOfArchitect\EoaApplicationEnclosure;
use App\EmploymentOfArchitect\EoaApplicationFeePaymentDetail;
use App\EmploymentOfArchitect\EoaApplicationImportantProjectDetail;
use App\EmploymentOfArchitect\EoaApplicationImportantProjectWorkHandledDetail;
use App\EmploymentOfArchitect\EoaApplicationImportantSeniorProfessionalDetail;
use App\EmploymentOfArchitect\EoaApplicationProjectSheetDetail;
use App\Http\Requests\AppointingArchitect\RegisterUserRequest;
use App\Http\Requests\AppointingArchitect\StepFiveRequest;
use App\Http\Requests\AppointingArchitect\StepFourRequest;
use App\Http\Requests\AppointingArchitect\StepOneRequest;
use App\Http\Requests\AppointingArchitect\StepSevenRequest;
use App\Http\Requests\AppointingArchitect\StepSixRequest;
use App\Http\Requests\AppointingArchitect\StepThreeRequest;
use App\Http\Requests\AppointingArchitect\StepTwoRequest;
use App\Repositories\Repository;
use App\Role;
use App\RoleUser;
use App\User;
use Illuminate\Http\Request;
use Storage;
use Validator;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use App\ArchitectApplicationStatusLog;

class EmploymentOfArchitectController extends Controller
{
    protected $model, $user, $fee_payment, $enclosures, $list_num_of_records_per_page;

    public $header_data = array(
        'menu' => 'Architect Application',
        'menu_url' => 'architect_application',
        'page' => '',
        'side_menu' => 'architect_application',
    );

    public function __construct(EoaApplication $EoaApplication, User $user, EoaApplicationFeePaymentDetail $EoaApplicationFeePaymentDetail, EoaApplicationEnclosure $EoaApplicationEnclosure, EoaApplicationImportantProjectDetail $EoaApplicationImportantProjectDetail, EoaApplicationImportantProjectWorkHandledDetail $EoaApplicationImportantProjectWorkHandledDetail, EoaApplicationImportantSeniorProfessionalDetail $EoaApplicationImportantSeniorProfessionalDetail, EoaApplicationProjectSheetDetail $EoaApplicationProjectSheetDetail)
    {
        // set the model
        $this->user = new Repository($user);
        $this->model = new Repository($EoaApplication);
        $this->fee_payment = new Repository($EoaApplicationFeePaymentDetail);
        $this->enclosures = new Repository($EoaApplicationEnclosure);
        $this->imp_projects = new Repository($EoaApplicationImportantProjectDetail);
        $this->imp_projects_work_handled = new Repository($EoaApplicationImportantProjectWorkHandledDetail);
        $this->imp_senior_professional = new Repository($EoaApplicationImportantSeniorProfessionalDetail);
        $this->project_sheet = new Repository($EoaApplicationProjectSheetDetail);
        $this->list_num_of_records_per_page = config('commanConfig.list_num_of_records_per_page');
    }

    public function signup()
    {
        return view('employment_of_architect.signup');
    }

    public function create_user(RegisterUserRequest $request)
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
                if (RoleUser::where(['user_id' => $user->id, 'role_id' => $role_id])->first()) {

                } else {
                    RoleUser::create($role_user);
                }

                return redirect()->route('appointing_architect.login')->with('registered', 'Registered successfully!');
            }
            return redirect()->route('appointing_architect.login')->with('error', 'Something went wrong!');

        }

    }

    public function genRand()
    {
        return time() . rand(100000, 999999);
    }

    public function index(Request $request, Datatables $datatables)
    {

        if (!$this->model->all()) {
            $app = $this->model->getModel();
            $app->user_id = auth()->user()->id;
            $app->application_number = $this->genRand();
            $app->save();
            return redirect()->route('appointing_architect.step1', ['id' => encrypt($app->id)]);
        }
        $header_data = $this->header_data;
        $columns = [
            ['data' => 'rownum', 'name' => 'rownum', 'title' => 'Sr No.', 'searchable' => false],
            ['data' => 'application_number', 'name' => 'application_number', 'title' => 'Application Number'],
            ['data' => 'application', 'name' => 'application', 'title' => 'Application'],
            ['data' => 'application_date', 'name' => 'application_date', 'title' => 'Application Date'],
            ['data' => 'status', 'name' => 'status', 'title' => 'Status'],
            ['data' => 'actions', 'name' => 'actions', 'title' => 'Actions', 'searchable' => false, 'orderable' => false],
        ];

        if ($datatables->getRequest()->ajax()) {

            $architect_applications = $this->model->all();
            return $datatables->of($architect_applications)
                ->editColumn('rownum', function ($listArray) {
                    static $i = 0; $i++;return $i;
                })
                ->editColumn('application_number', function ($architect_applications) {
                    return $architect_applications->application_number;
                })
                ->editColumn('application', function ($architect_applications) {
                    return "application";
                })
                ->editColumn('application_date', function ($architect_applications) {
                    return date('d-m-Y', strtotime($architect_applications->created_at));
                })
                ->editColumn('status', function ($architect_applications) {
                    return $architect_applications->ArchitectApplicationStatusForLoginListing->count()>0?'sent':'new application';
                })
                ->editColumn('actions', function ($architect_applications) {
                    
                    return view('employment_of_architect.action', compact('architect_applications'))->render();
                })
                ->rawColumns(['select', 'application_number', 'application', 'application_date', 'status','actions'])
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
            "order" => [5, "desc"],
            "pageLength" => $this->list_num_of_records_per_page,
            // 'fixedHeader' => [
            //     'header' => true,
            //     'footer' => true
            // ]
        ];
    }

    public function step1($id)
    {
        $id = decrypt($id);
        $application = $this->model->whereWithFirst(['fee_payment_details'], ['id' => $id, 'user_id' => auth()->user()->id]);
        return view('employment_of_architect.form1', compact('application'));
    }

    public function step1_post(StepOneRequest $request, $id)
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
                'form_step' => 2,
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

                return redirect()->route('appointing_architect.step2', ['id' => encrypt($application_id)]);
            }
        }

    }

    public function step2($id)
    {
        $id = decrypt($id);
        $application = $this->model->whereWithFirst(['fee_payment_details', 'enclosures'], ['id' => $id, 'user_id' => auth()->user()->id]);
        //dd($application->enclosures[0]);
        return view('employment_of_architect.form2', compact('application'));
    }

    public function step2_post(StepTwoRequest $request, $id)
    {

        $application_id = $request->application_id;
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
        $this->model->updateWhere(['application_info_and_its_enclosures_verify' => $request->application_info_and_its_enclosures_verify, 'form_step' => 3], ['id' => $application_id]);
        return redirect()->route('appointing_architect.step3', ['id' => encrypt($application_id)]);
    }

    public function step3($id)
    {
        $id = decrypt($id);
        $application = $this->model->whereWithFirst(['fee_payment_details', 'enclosures'], ['id' => $id, 'user_id' => auth()->user()->id]);
        return view('employment_of_architect.form3', compact('application'));
    }

    public function step3_post(StepThreeRequest $request, $id)
    {
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
            'form_step' => 4,
        ];
        if ($this->model->updateWhere($step3_data, ['id' => $application_id])) {
            return redirect()->route('appointing_architect.step4', ['id' => encrypt($application_id)]);
        } else {
            return back()->withError('Something went wrong');
        }
    }

    public function step4($id)
    {
        $id = decrypt($id);
        $application = $this->model->whereWithFirst(['imp_projects'], ['id' => $id, 'user_id' => auth()->user()->id]);
        //dd($this->imp_projects);
        return view('employment_of_architect.form4', compact('application'));
    }

    public function step4_post(StepFourRequest $request, $id)
    {
        $imp_project_id = $request->imp_project_id;
        $name_of_clients = $request->name_of_client;
        $locations = $request->location;
        $category_of_clients = $request->category_of_client;
        $i = 0;
        $application_id = $request->application_id;
        foreach ($name_of_clients as $name_of_client) {
            $imp_project_data_array = array();
            if (isset($imp_project_id[$i])) {
                $imp_project_data_array = [
                    'eoa_application_id' => $application_id,
                    'name_of_client' => $name_of_client,
                    'location' => $locations[$i],
                    'category_of_client' => $category_of_clients[$i],
                ];
                $this->imp_projects->updateWhere($imp_project_data_array, ['id' => $imp_project_id[$i], 'eoa_application_id' => $application_id]);
            } else {
                $imp_project_data_array = [
                    'eoa_application_id' => $application_id,
                    'name_of_client' => $name_of_client,
                    'location' => $locations[$i],
                    'category_of_client' => $name_of_clients[$i],
                ];
                $this->imp_projects->create($imp_project_data_array);
            }

            $i++;
        }
        $this->model->updateWhere(['form_step' => 5], ['id' => $application_id]);
        return redirect()->route('appointing_architect.step5', ['id' => encrypt($application_id)]);
    }

    public function delete_imp_project(Request $request)
    {
        $id = $request->delete_imp_project_id;
        if ($this->imp_projects->delete($id)) {
            return response()->json(['status' => 0, 'description' => 'deleted successfully']);
        } else {
            return response()->json(['status' => 1, 'description' => 'something went wrong']);
        }
    }

    public function step5($id)
    {
        $id = decrypt($id);
        $application = $this->model->whereWithFirst(['imp_project_work_handled', 'imp_projects'], ['id' => $id, 'user_id' => auth()->user()->id]);
        return view('employment_of_architect.form5', compact('application'));
    }

    public function step5_post(StepFiveRequest $request, $id)
    {
        $imp_project_work_handled_id = $request->imp_project_work_handled_id;
        $eoa_application_imp_project_detail_id = $request->eoa_application_imp_project_detail_id;
        $no_of_dwelling = $request->no_of_dwelling;
        $land_area_in_sq_mt = $request->land_area_in_sq_mt;
        $built_up_area_in_sq_mt = $request->built_up_area_in_sq_mt;
        $value_of_work_in_rs = $request->value_of_work_in_rs;
        $year_of_completion_start = $request->year_of_completion_start;
        $i = 0;
        $application_id = $request->application_id;
        foreach ($eoa_application_imp_project_detail_id as $name_of_client) {
            $imp_project_data_array = array();
            if (isset($imp_project_work_handled_id[$i])) {
                $imp_project_data_array = [
                    'eoa_application_id' => $application_id,
                    'eoa_application_imp_project_detail_id' => $request->eoa_application_imp_project_detail_id[$i],
                    'no_of_dwelling' => $no_of_dwelling[$i],
                    'land_area_in_sq_mt' => $land_area_in_sq_mt[$i],
                    'built_up_area_in_sq_mt' => $built_up_area_in_sq_mt[$i],
                    'value_of_work_in_rs' => $value_of_work_in_rs[$i],
                    'year_of_completion_start' => $year_of_completion_start[$i],
                ];
                $this->imp_projects_work_handled->updateWhere($imp_project_data_array, ['id' => $imp_project_work_handled_id[$i], 'eoa_application_id' => $application_id]);
            } else {
                $imp_project_data_array = [
                    'eoa_application_id' => $application_id,
                    'eoa_application_imp_project_detail_id' => $request->eoa_application_imp_project_detail_id[$i],
                    'no_of_dwelling' => $no_of_dwelling[$i],
                    'land_area_in_sq_mt' => $land_area_in_sq_mt[$i],
                    'built_up_area_in_sq_mt' => $built_up_area_in_sq_mt[$i],
                    'value_of_work_in_rs' => $value_of_work_in_rs[$i],
                    'year_of_completion_start' => $year_of_completion_start[$i],
                ];
                $this->imp_projects_work_handled->create($imp_project_data_array);
            }

            $i++;
        }
        $this->model->updateWhere(['form_step' => 6], ['id' => $application_id]);
        return redirect()->route('appointing_architect.step6', ['id' => encrypt($application_id)]);

    }

    public function delete_imp_project_work_handled(Request $request)
    {
        $id = $request->delete_imp_project_id;
        if ($this->imp_projects_work_handled->delete($id)) {
            return response()->json(['status' => 0, 'description' => 'deleted successfully']);
        } else {
            return response()->json(['status' => 1, 'description' => 'something went wrong']);
        }
    }

    public function delete_imp_senior_professional(Request $request)
    {
        $id = $request->delete_imp_project_id;
        if ($this->imp_senior_professional->delete($id)) {
            return response()->json(['status' => 0, 'description' => 'deleted successfully']);
        } else {
            return response()->json(['status' => 1, 'description' => 'something went wrong']);
        }
    }

    public function delete_project_sheet_detail(Request $request)
    {
        $id = $request->delete_imp_project_id;
        if ($this->project_sheet->delete($id)) {
            return response()->json(['status' => 0, 'description' => 'deleted successfully']);
        } else {
            return response()->json(['status' => 1, 'description' => 'something went wrong']);
        }
    }

    public function step6($id)
    {
        $id = decrypt($id);
        $application = $this->model->whereWithFirst(['imp_senior_professionals'], ['id' => $id, 'user_id' => auth()->user()->id]);
        return view('employment_of_architect.form6', compact('application'));
    }

    public function step6_post(StepSixRequest $request, $id)
    {
        $imp_senior_professional_id = $request->imp_senior_professional_id;
        $category = $request->category;
        $name = $request->name;
        $qualifications = $request->qualifications;
        $year_of_qualification = $request->year_of_qualification;
        $len_of_service_with_firm_in_year = $request->len_of_service_with_firm_in_year;
        $len_of_service_with_firm_in_month = $request->len_of_service_with_firm_in_month;
        $i = 0;
        $application_id = $request->application_id;
        foreach ($category as $category) {
            $imp_project_data_array = array();
            if (isset($imp_senior_professional_id[$i])) {
                $imp_project_data_array = [
                    'eoa_application_id' => $application_id,
                    'category' => $category,
                    'name' => $name[$i],
                    'qualifications' => $qualifications[$i],
                    'year_of_qualification' => $year_of_qualification[$i],
                    'len_of_service_with_firm_in_year' => $len_of_service_with_firm_in_year[$i],
                    'len_of_service_with_firm_in_month' => $len_of_service_with_firm_in_month[$i],
                ];
                $this->imp_senior_professional->updateWhere($imp_project_data_array, ['id' => $imp_senior_professional_id[$i], 'eoa_application_id' => $application_id]);
            } else {
                $imp_project_data_array = [
                    'eoa_application_id' => $application_id,
                    'category' => $category,
                    'name' => $name[$i],
                    'qualifications' => $qualifications[$i],
                    'year_of_qualification' => $year_of_qualification[$i],
                    'len_of_service_with_firm_in_year' => $len_of_service_with_firm_in_year[$i],
                    'len_of_service_with_firm_in_month' => $len_of_service_with_firm_in_month[$i],
                ];
                $this->imp_senior_professional->create($imp_project_data_array);
            }

            $i++;
        }
        $this->model->updateWhere(['form_step' => 7], ['id' => $application_id]);
        return redirect()->route('appointing_architect.step7', ['id' => encrypt($application_id)]);
    }

    public function step7($id)
    {
        $id = decrypt($id);
        $application = $this->model->whereWithFirst(['project_sheets' => function ($q) {
            return $q->where('work_completed', 0);
        }], ['id' => $id, 'user_id' => auth()->user()->id]);
        return view('employment_of_architect.form7', compact('application'));
    }

    public function step7_post(StepSevenRequest $request, $id)
    {
        $storage = "";
        if ($request->hasFile('copy_of_agreement')) {
            $file = $request->file('copy_of_agreement');
            $extension = $request->file('copy_of_agreement')->getClientOriginalExtension();
            $dir = 'appointing_architect_application';
            $filename = uniqid() . '_' . time() . '_' . date('Ymd') . '.' . $extension;
            $storage = Storage::disk('ftp')->putFileAs($dir, $request->file('copy_of_agreement'), $filename);
        }
        $application_id = $request->application_id;
        $project_sheet_detail_id = $request->project_sheet_detail_id;
        $data_array = [
            'eoa_application_id' => $application_id,
            'name_of_project' => $request->name_of_project,
            'location' => $request->location,
            'name_of_client' => $request->name_of_client,
            'address' => $request->address,
            'tel_no' => $request->tel_no,
            'built_up_area_in_sq_m' => $request->built_up_area_in_sq_m,
            'land_area_in_sq_m' => $request->land_area_in_sq_m,
            'estimated_value_of_project' => $request->estimated_value_of_project,
            'completed_value_of_project' => $request->completed_value_of_project,
            'date_of_start' => date('Y-m-d', strtotime($request->date_of_start)),
            'date_of_completion' => date('Y-m-d', strtotime($request->date_of_completion)),
            'whether_service_terminated_by_client' => $request->whether_service_terminated_by_client,
            'salient_features_of_project' => $request->salient_features_of_project,
            'reason_for_delay_if_any' => $request->reason_for_delay_if_any,
            'work_completed' => 0,
        ];

        if ($storage != "") {
            $data_array['copy_of_agreement'] = $storage;
        }

        if ($project_sheet_detail_id != "") {

            $this->project_sheet->updateWhere($data_array, ['id' => $project_sheet_detail_id, 'eoa_application_id' => $application_id]);
            $this->model->updateWhere(['form_step' => 8], ['id' => $application_id]);
        } else {
            $this->project_sheet->create($data_array);
            $this->model->updateWhere(['form_step' => 8], ['id' => $application_id]);
        }

        return back()->withSuccess('data saved successfully!!!');
    }

    public function step8($id)
    {
        $id = decrypt($id);
        $application = $this->model->whereWithFirst(['project_sheets' => function ($q) {
            return $q->where('work_completed', 1);
        }], ['id' => $id, 'user_id' => auth()->user()->id]);
        return view('employment_of_architect.form8', compact('application'));
    }

    public function step8_post(StepSevenRequest $request, $id)
    {
        $storage = "";
        if ($request->hasFile('copy_of_agreement')) {
            $file = $request->file('copy_of_agreement');
            $extension = $request->file('copy_of_agreement')->getClientOriginalExtension();
            $dir = 'appointing_architect_application';
            $filename = uniqid() . '_' . time() . '_' . date('Ymd') . '.' . $extension;
            $storage = Storage::disk('ftp')->putFileAs($dir, $request->file('copy_of_agreement'), $filename);
        }
        $application_id = $request->application_id;
        $project_sheet_detail_id = $request->project_sheet_detail_id;
        $data_array = [
            'eoa_application_id' => $application_id,
            'name_of_project' => $request->name_of_project,
            'location' => $request->location,
            'name_of_client' => $request->name_of_client,
            'address' => $request->address,
            'tel_no' => $request->tel_no,
            'built_up_area_in_sq_m' => $request->built_up_area_in_sq_m,
            'land_area_in_sq_m' => $request->land_area_in_sq_m,
            'estimated_value_of_project' => $request->estimated_value_of_project,
            'completed_value_of_project' => $request->completed_value_of_project,
            'date_of_start' => date('Y-m-d', strtotime($request->date_of_start)),
            'date_of_completion' => date('Y-m-d', strtotime($request->date_of_completion)),
            'whether_service_terminated_by_client' => $request->whether_service_terminated_by_client,
            'salient_features_of_project' => $request->salient_features_of_project,
            'reason_for_delay_if_any' => $request->reason_for_delay_if_any,
            'work_completed' => 1,
        ];
        if ($storage != "") {
            $data_array['copy_of_agreement'] = $storage;
        }
        if ($project_sheet_detail_id != "") {

            $this->project_sheet->updateWhere($data_array, ['id' => $project_sheet_detail_id, 'eoa_application_id' => $application_id]);
            $this->model->updateWhere(['form_step' => 9], ['id' => $application_id]);
        } else {
            $this->project_sheet->create($data_array);
            $this->model->updateWhere(['form_step' => 9], ['id' => $application_id]);
        }

        return back()->withSuccess('data saved successfully!!!');
    }

    public function send_to_architect(Request $request)
    {
        $get_user = User::where(['email' => 'junior_architect@gmail.com'])->first();
        if ($get_user) {
            $forward_application = [
                [
                    'architect_application_id' => $request->app_id,
                    'user_id' => auth()->user()->id,
                    'role_id' => session()->get('role_id'),
                    'status_id' => config('commanConfig.architect_applicationStatus.forward'),
                    'to_user_id' => $get_user->id,
                    'to_role_id' => $get_user->role_id,
                    'remark' => '',
                    'changed_at' => Carbon::now(),
                ],
                [
                    'architect_application_id' => $request->app_id,
                    'user_id' => $get_user->id,
                    'role_id' => $get_user->role_id,
                    'status_id' => config('commanConfig.architect_applicationStatus.scrutiny_pending'),
                    'to_user_id' => null,
                    'to_role_id' => null,
                    'remark' => '',
                    'changed_at' => Carbon::now(),
                ],
            ];
            if (ArchitectApplicationStatusLog::insert($forward_application)) {
                return redirect()->route('appointing_architect.index');
            }
        } else {
            return back()->withError('something went wrong');
        }

        // $forward_application = [
        //     [
        //         'architect_application_id' => $request->app_id,
        //         'user_id' => auth()->user()->id,
        //         'role_id' => session()->get('role_id'),
        //         'status_id' => config('commanConfig.architect_applicationStatus.forward'),
        //         'to_user_id' => $request->to_user_id,
        //         'to_role_id' => $request->to_role_id,
        //         'remark' => $request->remark,
        //         'changed_at' => Carbon::now(),
        //     ],
        //     [
        //         'architect_application_id' => $request->application_id,
        //         'user_id' => $request->to_user_id,
        //         'role_id' => $request->to_role_id,
        //         'status_id' => config('commanConfig.architect_applicationStatus.scrutiny_pending'),
        //         'to_user_id' => null,
        //         'to_role_id' => null,
        //         'remark' => $request->remark,
        //         'changed_at' => Carbon::now(),
        //     ],
        // ];

        // if (ArchitectApplicationStatusLog::insert($forward_application)) {
        //     return redirect()->route('architect_application');
        // }
        return $request->all();
    }

}
