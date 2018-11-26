<?php

namespace App\Http\Controllers;

use App\Repositories\Repository;
use App\EmploymentOfArchitect\EoaApplication;
use App\EmploymentOfArchitect\EoaApplicationProjectSheetDetail;
use App\ArchitectApplication;
use App\ArchitectApplicationMark;
use App\ArchitectApplicationStatusLog;
use App\ArchitectCertificate;
use App\Http\Controllers\Common\CommonController;
use App\Http\Requests\architect\CertificateUploadRequest;
use App\Http\Requests\architect\EvaluationMarkRequest;
use App\Role;
use App\User;
use Carbon\Carbon;
use Config;
use File;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Storage;

class ArchitectApplicationController extends Controller
{
    public $header_data = array(
        'menu' => 'Architect Application',
        'menu_url' => 'architect_application',
        'page' => '',
        'side_menu' => 'architect_application',
    );
    protected $list_num_of_records_per_page;
    protected $model;
    protected $CommonController;
    public function __construct(CommonController $CommonController,EoaApplication $EoaApplication,EoaApplicationProjectSheetDetail $EoaApplicationProjectSheetDetail)
    {
        $this->model = new Repository($EoaApplication);
        $this->project_sheet = new Repository($EoaApplicationProjectSheetDetail);
        $this->CommonController = $CommonController;
        $this->list_num_of_records_per_page = Config::get('commanConfig.list_num_of_records_per_page');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Datatables $datatables)
    {
        $application_status = (session()->get('role_name') == config('commanConfig.selection_commitee')) ? config('commanConfig.architect_application_status.shortListed') : '';
        $is_view = session()->get('role_name') == config('commanConfig.junior_architect');
        $is_commitee = session()->get('role_name') == config('commanConfig.selection_commitee');
        $header_data = $this->header_data;
        if ($request->reset) {
            return redirect()->route('architect_application');
        }
        $getData = $request->all();
        $columns = [
            //['data' => 'radio', 'name' => 'radio', 'title' => '', 'searchable' => false],
            // ['data' => 'select', 'name' => 'select', 'title' => '', 'searchable' => false],
            ['data' => 'rownum', 'name' => 'rownum', 'title' => 'Sr No.', 'searchable' => false],
            ['data' => 'application_number', 'name' => 'application_number', 'title' => 'Application Number'],
            ['data' => 'application_date', 'name' => 'application_date', 'title' => 'Application Date'],
            ['data' => 'candidate_name', 'name' => 'candidate_name', 'title' => 'Candidate Name'],
            ['data' => 'email_and_mobile', 'name' => 'email_and_mobile', 'title' => 'Email ID & Mobile No'],
            ['data' => 'grand_total', 'name' => 'grand_total', 'title' => 'Grand Total'],
            ['data' => 'Status', 'name' => 'Status', 'title' => 'Status'],
            ['data' => 'view', 'name' => 'view', 'title' => 'Action']
        ];

        //dd($this->CommonController->architect_applications($request));
        if ($datatables->getRequest()->ajax()) {

            $architect_applications = $this->CommonController->architect_applications($request);
            return $datatables->of($architect_applications)
                // ->editColumn('radio', function ($listArray) {
                //     $url = route('view_architect_application', encrypt($listArray->id));
                //     return '<label class="m-radio m-radio--primary m-radio--link"><input type="radio" onclick="geturl(this.value);" value="' . $url . '" name="village_data_id"><span></span></label>';
                // })
                // ->editColumn('select', function ($architect_applications) {
                //     return view('admin.architect.checkbox', compact('architect_applications'))->render();
                // })
                ->editColumn('rownum', function ($listArray) {
                    static $i = 0; $i++; return $i;
                })
                ->editColumn('application_number', function ($architect_applications) {
                    return $architect_applications->application_number;
                })
                ->editColumn('application_date', function ($architect_applications) {
                    return date('d-m-Y', strtotime($architect_applications->created_at));
                })
                ->editColumn('candidate_name', function ($architect_applications) {
                    return $architect_applications->name_of_applicant;
                })
                ->editColumn('email_and_mobile', function ($architect_applications) {
                    return $architect_applications->user->email."<br>".$architect_applications->user->mobile_no;
                })
                ->editColumn('grand_total', function ($architect_applications) {
                    $total_marks=0;
                    foreach($architect_applications->marks as $mark)
                    {
                        $total_marks=$total_marks+$mark->marks;
                    }
                    return  ($architect_applications->application_marks+$total_marks)==0?'-':($architect_applications->application_marks+$total_marks);
                })
                ->editColumn('Status', function ($architect_applications) {

                    //return isset($architect_applications->ArchitectApplicationStatusForLoginListing[0])?$architect_applications->ArchitectApplicationStatusForLoginListing[0]->status_id:config('commanConfig.architect_applicationStatus.new_application');
                    $status = isset($architect_applications->ArchitectApplicationStatusForLoginListing[0]) ? $architect_applications->ArchitectApplicationStatusForLoginListing[0]->status_id : '1';
                    $config_array = array_flip(config('commanConfig.architect_applicationStatus'));
                    $value = ucwords(str_replace('_', ' ', $config_array[$status]));
                    if ($architect_applications->application_status == 'Final' && $status == 1) {
                        return $architect_applications->application_status;
                    }
                    return '<span class="m-badge m-badge--' . config('commanConfig.architect_applicationStatusColor.' . $status) . ' m-badge--wide">' . $value . ($architect_applications->application_status == 'None' ? '' : ' & ' . $architect_applications->application_status) . '</span>';
                    //return $value . ($architect_applications->application_status == 'None' ? '' : ' & ' . $architect_applications->application_status);
                })
                ->editColumn('view', function ($architect_applications) use($is_commitee,$is_view){
                     return view('admin.architect.view_layout', compact('architect_applications','is_commitee','is_view'))->render();
                })
                
                ->rawColumns(['application_number', 'application_date', 'candidate_name','email_and_mobile', 'grand_total','Status','view'])
                ->make(true);
        }

        $html = $datatables->getHtmlBuilder()->columns($columns)->parameters($this->getParameters());

        return view('admin.architect.index', compact('html', 'header_data', 'shortlisted', 'finalSelected', 'getData', 'is_view', 'is_commitee'));
    }

    protected function getParameters()
    {
        return [
            'serverSide' => true,
            'processing' => true,
           'ordering' => 'isSorted',
            "order" => [0, "asc"],
            "pageLength" => $this->list_num_of_records_per_page,
            // 'fixedHeader' => [
            //     'header' => true,
            //     'footer' => true
            // ]
        ];
    }

    // public function shortlistedIndex()
    // {
    //   $shortlisted = ArchitectApplication::with('ArchitectApplicationStatusForLoginListing')->select('*',\DB::raw("(SELECT SUM(marks) FROM architect_application_marks WHERE architect_application_marks.architect_application_id = architect_application.id) as marks"))
    //                                       ->where('application_status', 3)
    //                                       ->get();
    //   $applications = $finalSelected = array();
    //   $header_data = $this->header_data;
    //   return view('admin.architect.shortlisted',compact('applications','header_data','shortlisted','finalSelected'));
    // }

    public function finalise_architect_application(Request $request)
    {
        //if (is_array($request->application_id)) {
            if ($request->final == 'final') {
                EoaApplication::where('id', $request->application_id)->update(['application_status' => config('commanConfig.architect_application_status.final')]);
                return redirect()->route('architect_application',['application_status'=>2])->withSuccess('added to final list');
            }

            if ($request->remove_final == 'remove_final') {
                EoaApplication::where('id', $request->application_id)->update(['application_status' => config('commanConfig.architect_application_status.shortListed')]);
                return redirect()->route('architect_application')->withSuccess('removed from final list');
            }
        // } else {
        //     return back()->withError('select atlease one application');
        // }
    }

    public function shortlist_architect_application(Request $request)
    {
        //dd($request->all());
        //if (is_array($request->application_id)) {
            if ($request->shortlist == 'shortlist') {
                EoaApplication::where('id', $request->application_id)->update(['application_status' => config('commanConfig.architect_application_status.shortListed')]);
                return redirect()->route('architect_application',['application_status'=>1])->withSuccess('shortlisted');
            }

            if ($request->remove_shortlist == 'remove_shortlist') {
                EoaApplication::where('id', $request->application_id)->update(['application_status' => config('commanConfig.architect_application_status.none')]);
                return redirect()->route('architect_application')->withSuccess('removed from shortlisted');
            }

      //  } else {
      //      return back()->withError('select atlease one application');
      //  }
    }

    // public function finalIndex()
    // {
    //   $finalSelected = ArchitectApplication::with('ArchitectApplicationStatusForLoginListing')->select('*',\DB::raw("(SELECT SUM(marks) FROM architect_application_marks WHERE architect_application_marks.architect_application_id = architect_application.id) as marks"))
    //                                       ->where('application_status', 4)
    //                                       ->get();
    //   $applications = $shortlisted = array();
    //   $header_data = $this->header_data;
    //   return view('admin.architect.final',compact('applications','header_data','shortlisted','finalSelected'));
    // }

    public function viewApplication($encryptedId)
    {
        $id = decrypt($encryptedId);
        $application = $this->model->whereWithFirst([
            'enclosures',
            'supporting_documents',
            'project_sheets',
            'imp_senior_professionals',
            'fee_payment_details',
            'imp_projects',
            'imp_project_work_handled'
        ], 
        ['id' => $id]);
        $work_in_hand=$application->project_sheets->where('work_completed',0);
        $work_completed=$application->project_sheets->where('work_completed',1);
        return view('admin.architect.view_application', compact('application','work_in_hand','work_completed'));
    }

    public function evaluateApplication($encryptedId)
    {
        $id = decrypt($encryptedId);
        $ArchitectApplication = EoaApplication::find(decrypt($encryptedId));
        // $architect_application_id = ArchitectApplication::find($id);
        // $architect_application_id = $architect_application_id->id;
        $app=\DB::table('eoa_applications')->where('id',$id)->first();
        $is_view = session()->get('role_name') == config('commanConfig.junior_architect');
        if($app->application_status >= config('commanConfig.architect_application_status.shortListed'))
        {
            $is_view=false;
        }
        
        $application = ArchitectApplicationMark::where('architect_application_id', $id)->get();
        $header_data = $this->header_data;
        return view('admin.architect.evaluate', compact('application', 'header_data', 'is_view','ArchitectApplication'));
    }

    public function saveEvaluateMarks(EvaluationMarkRequest $request)
    {
        //dd($request->all());
        $marks = $request->get('marks');
        $ids = $request->get('id');
        $remark = $request->get('remark');

        foreach ($ids as $key => $id) {
            ArchitectApplicationMark::where('id', $id)->update(['marks' => $marks[$key], 'remark' => $remark[$key]]);
        }

        $EoaApplication=EoaApplication::find($request->application_id);
        if($EoaApplication)
        {
            $EoaApplication->application_marks=$request->application_marks;
            $EoaApplication->application_remark=$request->application_remark;
            $EoaApplication->save();
        }
        // $forward_application = [
        //     [
        //         'architect_application_id' => $request->application_id,
        //         'user_id' => auth()->user()->id,
        //         'role_id' => session()->get('role_id'),
        //         'status_id' => config('commanConfig.architect_applicationStatus.scrutiny_pending'),
        //         'to_user_id' => null,
        //         'to_role_id' => null,
        //         'remark' => null,
        //         'changed_at' => Carbon::now(),
        //     ],
        // ];

        // ArchitectApplicationStatusLog::insert($forward_application);
        return redirect()->back()->with('success', "Marks updated succesfully!!!");
    }

    public function getGenerateCertificate($encryptedId)
    {
        $ArchitectApplication = EoaApplication::find(decrypt($encryptedId));
        if ($ArchitectApplication->drafted_certificate != null) {
            return redirect()->route('finalCertificateGenerate', ['id' => $encryptedId]);
        }
        return view('admin.architect.generate_certificate', compact('ArchitectApplication','header_data', 'encryptedId'));
    }

    public function getFinalCertificateGenerate($encryptedId)
    {
        
        $uploadPath = '/uploads/temp_certificate';
        $destination = public_path($uploadPath);
        $certificate_generated = 0;
        $ArchitectApplication = EoaApplication::with(['statusLog'=>function($query){
            return $query->where('user_id',auth()->user()->id)->where('role_id',session()->get('role_id'))->orderBY('id','desc')->limit(1);
        }])->find(decrypt($encryptedId));
        //dd($ArchitectApplication->statusLog);
        if ($ArchitectApplication) {
            if ($ArchitectApplication->drafted_certificate == null) {
                
                $content = view('admin.architect.certificate', compact('ArchitectApplication'));
                $pdf = \App::make('dompdf.wrapper');
                $pdf->loadHTML($content);
                $fileName = $ArchitectApplication->id . $ArchitectApplication->application_number . '.pdf';
                $folder_name = 'temp_certificate';
                if (!(\Storage::disk('ftp')->has($folder_name))) {
                    \Storage::disk('ftp')->makeDirectory($folder_name, $mode = 0777, true, true);
                }
                $filePath = $folder_name . "/" . $fileName;
                // $file_local = \Storage::disk('local')->get($filePath);
                \Storage::disk('ftp')->put($filePath, $pdf->output());
                $ArchitectApplication->drafted_certificate = $filePath;
                $ArchitectApplication->certificate_path = $filePath;
                $ArchitectApplication->save();
            }
            return view('admin.architect.final_generate_certificate', compact('header_data', 'encryptedId', 'ArchitectApplication'));
        }

    }

    public function edit_certificate($encryptedId)
    {
        $ArchitectApplication = EoaApplication::find(decrypt($encryptedId));
        return view('admin.architect.edit_certificate', compact('ArchitectApplication'));
    }

    public function update_certificate(Request $request)
    {
        //dd('ok');
        $ArchitectApplication = EoaApplication::where('id', $request->applicationId)->first();
        $uploadPath = '/uploads/temp_certificate';
        $destination = public_path($uploadPath);
        $content = $request->ckeditorText;
        File::put($destination . "/" . $ArchitectApplication->id . $ArchitectApplication->application_number . ".txt", $content);
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($content);
        $fileName = $ArchitectApplication->id . $ArchitectApplication->application_number . '.pdf';
        $draftedCertificate = $uploadPath . "/" . $fileName;
        if ((!is_dir($destination))) {
            File::makeDirectory($destination, $mode = 0777, true, true);
        }
        $pdf->save(storage_path() . "/temp_certificate" . "/" . $fileName);
        $folder_name = 'temp_certificate';
        if (!(\Storage::disk('ftp')->has($folder_name))) {
            \Storage::disk('ftp')->makeDirectory($folder_name, $mode = 0777, true, true);
        }
        $filePath = $folder_name . "/" . $fileName;
        $file_local = \Storage::disk('local')->get($filePath);
        \Storage::disk('ftp')->put($filePath, $file_local);
        $ArchitectApplication->certificate_path = $filePath;
        $ArchitectApplication->save();
        // ArchitectCertificate::create([
        //     'architect_application_id' => $ArchitectApplication->id,
        //     'certificate_name' => $folder_name . "/" . $fileName,
        //     'certificate_path' => $folder_name,
        // ]);
        return redirect('finalCertificateGenerate/' . encrypt($request->applicationId));
    }

    // public function getTempCertificateGenerate($encryptedId)
    // {
    //   $application = ArchitectApplication::select('*',\DB::raw("(SELECT SUM(marks) FROM architect_application_marks WHERE architect_application_marks.architect_application_id = architect_application.id) as marks"))
    //   ->where('id',decrypt($encryptedId))
    //   ->first();

    //   $ArchitectApplication=ArchitectApplication::find(decrypt($encryptedId));
    //   $content=view('admin.architect.certificate',compact('ArchitectApplication'));

    //   $phpWord = new \PhpOffice\PhpWord\PhpWord();
    //   $section = $phpWord->addSection();
    //   $text = $section->addText("Applicant Number: ".$application->application_number);
    //   $text = $section->addText("Applicant Name: ".$application->candidate_name);
    //   $text = $section->addText("Applicant Email: ".$application->candidate_email);
    //   $text = $section->addText("Applicant Mobile NO: ".$application->candidate_mobile_no);

    //   $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
    //   try {
    //   $objWriter->save(storage_path('temp_certificate/'.$application->application_number.'.docx'));
    //   } catch (Exception $e) {
    //   }
    //   return response()->download(storage_path('temp_certificate/'.$application->application_number.'.docx'));
    // }

    public function postFinalCertificateGenerate(CertificateUploadRequest $request)
    {
            //dd('ok');
        if ($request->hasFile('certificate')) {
            $applicationId = decrypt($request->get('ap_no'));
            $application = EoaApplication::where('id', $applicationId)->first();
            $extension = $request->file('certificate')->getClientOriginalExtension();
            //\Storage::disk('ftp')->put($filePath, $pdf->output());
            //$path = \Storage::putFileAs('/architect_certificates', $request->file('certificate'), $applicationId . $application->application_number . '.' . $extension, 'public');
            $dir = 'architect_certificates';
            $filename = $applicationId . $application->application_number . '.' . $extension;
            $storage = Storage::disk('ftp')->putFileAs($dir, $request->file('certificate'), $filename);
            $application->certificate_path = $storage;
            $application->final_signed_certificate_status = 1;
            $application->save();
            //EoaApplication::create($input);
            return redirect()->back()->with('success', "Certificate Uploaded succesfully.");
        } else {
            return redirect()->back()->with('error', "Look like something went wrong.");
        }
    }

    public function getForwardApplication($encryptedId)
    {
        $ArchitectApplication = EoaApplication::find(decrypt($encryptedId));
        $arrData['architect_details'] = EoaApplication::where('id', decrypt($encryptedId))->first();

        $parentData = $this->CommonController->getForwardApplicationArchitectParentData();
        $arrData['parentData'] = $parentData['parentData'];
        $arrData['role_name'] = $parentData['role_name'];

        if (session()->get('role_name') != config('commanConfig.junior_architect')) {
            $status_user = EoaApplication::where(['id' => decrypt($encryptedId)])->pluck('id')->toArray();
        }

        if (session()->get('role_name') == config('commanConfig.selection_commitee')) {
            $commitee_role_id = Role::where('name', '=', config('commanConfig.junior_architect'))->first();

            $arrData['get_forward_commitee'] = User::where('role_id', $commitee_role_id->id)->get();

            $arrData['commitee_role_name'] = strtoupper(str_replace('_', ' ', $commitee_role_id->name));
        } else {
            //dd('ok');
            $commitee_role_id = Role::where('name', '=', config('commanConfig.selection_commitee'))->first();

            $arrData['get_forward_commitee'] = User::where('role_id', $commitee_role_id->id)->get();

            $arrData['commitee_role_name'] = strtoupper(str_replace('_', ' ', $commitee_role_id->name));
        }

        return view('admin.architect.forward_application', compact('arrData','ArchitectApplication'));
    }

    public function forward_application(Request $request)
    {
        $forward_application = [
            [
                'architect_application_id' => $request->application_id,
                'user_id' => auth()->user()->id,
                'role_id' => session()->get('role_id'),
                'status_id' => config('commanConfig.architect_applicationStatus.forward'),
                'to_user_id' => $request->to_user_id,
                'to_role_id' => $request->to_role_id,
                'remark' => $request->remark,
                'changed_at' => Carbon::now(),
            ],
            [
                'architect_application_id' => $request->application_id,
                'user_id' => $request->to_user_id,
                'role_id' => $request->to_role_id,
                'status_id' => config('commanConfig.architect_applicationStatus.scrutiny_pending'),
                'to_user_id' => null,
                'to_role_id' => null,
                'remark' => $request->remark,
                'changed_at' => Carbon::now(),
            ],
        ];

        if (ArchitectApplicationStatusLog::insert($forward_application)) {
            return redirect()->route('architect_application');
        }
    }

    public function send_to_candidate(Request $request)
    {
        $applicationId=decrypt($request->applicationId);
        $EoaApplication=EoaApplication::find($applicationId);
        $to_user_id=$EoaApplication->user->id;
        $to_role_id=$EoaApplication->user->role_id;
        $forward_application = [
            [
                'architect_application_id' => $applicationId,
                'user_id' => auth()->user()->id,
                'role_id' => session()->get('role_id'),
                'status_id' => config('commanConfig.architect_applicationStatus.approved'),
                'to_user_id' => $to_user_id,
                'to_role_id' => $to_role_id,
                'remark' => '',
                'changed_at' => Carbon::now(),
            ],
            [
                'architect_application_id' => $applicationId,
                'user_id' => $to_user_id,
                'role_id' => $to_role_id,
                'status_id' => config('commanConfig.architect_applicationStatus.approved'),
                'to_user_id' => null,
                'to_role_id' => null,
                'remark' => $request->comment,
                'changed_at' => Carbon::now(),
            ],
        ];
        //dd($forward_application);
        if (ArchitectApplicationStatusLog::insert($forward_application)) {
            return redirect()->route('architect_application');
        }else
        {
            return back()->withError('something went wrong');
        }
         
    }   

}
