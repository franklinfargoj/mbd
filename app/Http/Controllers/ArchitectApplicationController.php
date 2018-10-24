<?php

namespace App\Http\Controllers;

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

class ArchitectApplicationController extends Controller
{
    public $header_data = array(
        'menu' => 'Architect Application',
        'menu_url' => 'architect_application',
        'page' => '',
        'side_menu' => 'architect_application',
    );
    protected $list_num_of_records_per_page;
    protected $CommonController;
    public function __construct(CommonController $CommonController)
    {
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
            ['data' => 'select', 'name' => 'select', 'title' => '', 'searchable' => false],
            ['data' => 'rownum', 'name' => 'rownum', 'title' => 'Sr No.', 'searchable' => false],
            ['data' => 'application_number', 'name' => 'application_number', 'title' => 'Application Number'],
            ['data' => 'application_date', 'name' => 'application_date', 'title' => 'Application Date'],
            ['data' => 'candidate_name', 'name' => 'candidate_name', 'title' => 'Candidate Name'],
            ['data' => 'candidate_email', 'name' => 'candidate_email', 'title' => 'Candidate Email'],
            ['data' => 'status', 'name' => 'status', 'title' => 'Status'],
            ['data' => 'actions', 'name' => 'actions', 'title' => 'Actions', 'searchable' => false, 'orderable' => false],
        ];

        //dd($this->CommonController->architect_applications($request));
        if ($datatables->getRequest()->ajax()) {

            $architect_applications = $this->CommonController->architect_applications($request);
            return $datatables->of($architect_applications)
                ->editColumn('select', function ($architect_applications) {
                    return view('admin.architect.checkbox', compact('architect_applications'))->render();
                })
                ->editColumn('rownum', function ($listArray) {
                    static $i = 0; $i++;return $i;
                })
                ->editColumn('application_number', function ($architect_applications) {
                    return $architect_applications->application_number;
                })
                ->editColumn('application_date', function ($architect_applications) {
                    return date('d-m-Y', strtotime($architect_applications->application_date));
                })
                ->editColumn('candidate_name', function ($architect_applications) {
                    return $architect_applications->candidate_name;
                })
                ->editColumn('candidate_email', function ($architect_applications) {
                    return $architect_applications->candidate_email . "<br>" . $architect_applications->candidate_mobile_no;
                })
                ->editColumn('status', function ($architect_applications) {

                    //return isset($architect_applications->ArchitectApplicationStatusForLoginListing[0])?$architect_applications->ArchitectApplicationStatusForLoginListing[0]->status_id:config('commanConfig.architect_applicationStatus.new_application');
                    $status = isset($architect_applications->ArchitectApplicationStatusForLoginListing[0]) ? $architect_applications->ArchitectApplicationStatusForLoginListing[0]->status_id : '1';
                    $config_array = array_flip(config('commanConfig.architect_applicationStatus'));
                    $value = ucwords(str_replace('_', ' ', $config_array[$status]));
                    if ($architect_applications->application_status == 'Final' && $status == 1) {
                        return $architect_applications->application_status;
                    }
                    return $value . ($architect_applications->application_status == 'None' ? '' : ' & ' . $architect_applications->application_status);
                })
                ->editColumn('actions', function ($architect_applications) {
                    return view('admin.architect.actions', compact('architect_applications'))->render();
                })
                ->rawColumns(['select', 'application_number', 'application_date', 'candidate_name', 'candidate_email', 'actions'])
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
            "order" => [7, "desc"],
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
        if (is_array($request->application_id)) {
            if ($request->final == 'final') {
                ArchitectApplication::whereIn('id', $request->application_id)->update(['application_status' => config('commanConfig.architect_application_status.final')]);
                return back()->withSuccess('added to final list');
            }

            if ($request->remove_final == 'remove_final') {
                ArchitectApplication::whereIn('id', $request->application_id)->update(['application_status' => config('commanConfig.architect_application_status.shortListed')]);
                return back()->withSuccess('removed from final list');
            }
        } else {
            return back()->withError('select atlease one application');
        }
    }

    public function shortlist_architect_application(Request $request)
    {
        if (is_array($request->application_id)) {
            if ($request->shortlist == 'shortlist') {
                ArchitectApplication::whereIn('id', $request->application_id)->update(['application_status' => config('commanConfig.architect_application_status.shortListed')]);
                return back()->withSuccess('shortlisted');
            }

            if ($request->remove_shortlist == 'remove_shortlist') {
                ArchitectApplication::whereIn('id', $request->application_id)->update(['application_status' => config('commanConfig.architect_application_status.none')]);
                return back()->withSuccess('removed from shortlisted');
            }

        } else {
            return back()->withError('select atlease one application');
        }
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
        //return decrypt($encryptedId);
        $ArchitectApplication = ArchitectApplication::find(decrypt($encryptedId));
        return view('admin.architect.view_application', compact('ArchitectApplication'));
    }

    public function evaluateApplication($encryptedId)
    {
        $id = decrypt($encryptedId);

        $architect_application_id = ArchitectApplication::find($id);
        $architect_application_id = $architect_application_id->id;
        $is_view = session()->get('role_name') == config('commanConfig.junior_architect');
        $application = ArchitectApplicationMark::where('architect_application_id', $id)->get();
        $header_data = $this->header_data;
        return view('admin.architect.evaluate', compact('architect_application_id', 'application', 'header_data', 'is_view'));
    }

    public function saveEvaluateMarks(EvaluationMarkRequest $request)
    {
        //dd($request->application_id);
        $marks = $request->get('marks');
        $ids = $request->get('id');
        $remark = $request->get('remark');

        foreach ($ids as $key => $id) {
            ArchitectApplicationMark::where('id', $id)->update(['marks' => $marks[$key], 'remark' => $remark[$key]]);
        }
        $forward_application = [
            [
                'architect_application_id' => $request->application_id,
                'user_id' => auth()->user()->id,
                'role_id' => session()->get('role_id'),
                'status_id' => config('commanConfig.architect_applicationStatus.scrutiny_pending'),
                'to_user_id' => null,
                'to_role_id' => null,
                'remark' => null,
                'changed_at' => Carbon::now(),
            ],
        ];

        ArchitectApplicationStatusLog::insert($forward_application);
        return redirect()->back()->with('success', "Marks updated succesfully!!!");
    }

    public function getGenerateCertificate($encryptedId)
    {
        $ArchitectApplication = ArchitectApplication::find(decrypt($encryptedId));
        if ($ArchitectApplication->drafted_certificate != null) {
            return redirect()->route('finalCertificateGenerate', ['id' => $encryptedId]);
        }
        return view('admin.architect.generate_certificate', compact('header_data', 'encryptedId'));
    }

    public function getFinalCertificateGenerate($encryptedId)
    {
        $uploadPath = '/uploads/temp_certificate';
        $destination = public_path($uploadPath);
        $certificate_generated = 0;
        $ArchitectApplication = ArchitectApplication::find(decrypt($encryptedId));
        if ($ArchitectApplication) {
            if ($ArchitectApplication->drafted_certificate == null) {
                if ((!is_dir($destination))) {
                    File::makeDirectory($destination, $mode = 0777, true, true);
                }
                $content = view('admin.architect.certificate', compact('ArchitectApplication'));
                File::put($destination . "/" . $ArchitectApplication->id . $ArchitectApplication->application_number . ".txt", $content);
                $ArchitectApplication->drafted_certificate = 'uploads/temp_certificate/' . $ArchitectApplication->id . $ArchitectApplication->application_number . ".txt";
                $ArchitectApplication->save();
            }
            return view('admin.architect.final_generate_certificate', compact('header_data', 'encryptedId', 'ArchitectApplication'));
        }

    }

    public function edit_certificate($encryptedId)
    {
        $ArchitectApplication = ArchitectApplication::find(decrypt($encryptedId));
        return view('admin.architect.edit_certificate', compact('ArchitectApplication'));
    }

    public function update_certificate(Request $request)
    {
        $ArchitectApplication = ArchitectApplication::where('id', $request->applicationId)->first();
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
        ArchitectCertificate::create([
            'architect_application_id' => $ArchitectApplication->id,
            'certificate_name' => $folder_name . "/" . $fileName,
            'certificate_path' => $folder_name,
        ]);
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

        if ($request->hasFile('certificate')) {
            $applicationId = decrypt($request->get('ap_no'));
            $application = ArchitectApplication::where('id', $applicationId)->first();
            $extension = $request->file('certificate')->getClientOriginalExtension();
            $path = \Storage::putFileAs('/architect_certificates', $request->file('certificate'), $applicationId . $application->application_number . '.' . $extension, 'public');
            $input['architect_application_id'] = $applicationId;
            $input['certificate_name'] = $applicationId . $application->application_number;
            $input['certificate_path'] = $path;
            $application->certificate_path = $path;
            $application->final_signed_certificate_status = 1;
            $application->save();
            ArchitectCertificate::create($input);
            return redirect()->back()->with('success', "Certificate Uploaded succesfully.");
        } else {
            return redirect()->back()->with('error', "Look like something went wrong.");
        }
    }

    public function getForwardApplication($encryptedId)
    {
        $arrData['architect_details'] = ArchitectApplication::where('id', decrypt($encryptedId))->first();

        $parentData = $this->CommonController->getForwardApplicationArchitectParentData();
        $arrData['parentData'] = $parentData['parentData'];
        $arrData['role_name'] = $parentData['role_name'];

        if (session()->get('role_name') != config('commanConfig.junior_architect')) {
            $status_user = ArchitectApplication::where(['id' => decrypt($encryptedId)])->pluck('id')->toArray();
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

        return view('admin.architect.forward_application', compact('arrData'));
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

}
