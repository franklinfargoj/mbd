<?php

namespace App\Http\Controllers\Common;

use App\ArchitectApplication;
use App\conveyance\scApplicationLog;
use App\conveyance\RenewalApplicationLog;
use App\Http\Controllers\Dashboard\ArchitectLayoutDashboardController;
use Illuminate\Http\Request;
use App\DashboardHeader;
use App\EENote;
use App\Http\Controllers\Controller;
use App\Layout\ArchitectLayout;
use App\Layout\ArchitectLayoutDetail;
use App\Layout\ArchitectLayoutEEScrtinyQuestionDetail;
use App\Layout\ArchitectLayoutEEScrtinyQuestionMaster;
use App\Layout\ArchitectLayoutEmScrtinyQuestionDetail;
use App\Layout\ArchitectLayoutEmScrtinyQuestionMaster;
use App\Layout\ArchitectLayoutLmScrtinyQuestionDetail;
use App\Layout\ArchitectLayoutLmScrtinyQuestionMaster;
use App\Layout\ArchitectLayoutReeScrtinyQuestionDetail;
use App\Layout\ArchitectLayoutReeScrtinyQuestionMaster;
use App\Layout\ArchitectLayoutStatusLog;
use App\OlDemarcationLandArea;
use App\MasterLayout;
use App\OlApplication;
use App\NocApplication;
use App\NocCCApplication;
use App\OcApplication;
use App\OcApplicationStatusLog;
use App\OlApplicationCalculationSheetDetails;
use App\OlApplicationMaster;
use App\OlApplicationStatus;
use App\NocApplicationStatus;
use App\NocCCApplicationStatus;
use App\OlCapNotes;
use App\OlChecklistScrutiny;
use App\OlConsentVerificationQuestionMaster;
use App\OlDcrRateMaster;
use App\OlDemarcationVerificationQuestionMaster;
use App\OlRgRelocationVerificationQuestionMaster;
use App\OlSharingCalculationSheetDetail;
use App\OlSocietyDocumentsMaster;
use App\OlTitBitVerificationQuestionMaster;
use App\OlSocietyDocumentsStatus;
use App\Permission;
use App\REENote;
use App\Role;
use App\SocietyOfferLetter;
use App\User;
use Auth; 
use Carbon\Carbon;
use Config;
use DB;
use Storage;
use App\EmploymentOfArchitect\EoaApplication;
use App\conveyance\SfApplicationStatusLog;
use App\Http\Controllers\conveyance\conveyanceCommonController;
use App\Http\Controllers\conveyance\renewalCommonController;
use App\ArchitectApplicationStatusLog;
use App\OlConsentVerificationDetails;
use App\OlSocietyDocumentsComment;
use App\mailMsgSentDetails;

class CommonController extends Controller
{

    // society and EE documents
    public function getSocietyEEDocuments($applicationId)
    {
        $application = OlApplication::where('id', $applicationId)->first();
        

        $societyDocuments = OlSocietyDocumentsMaster::where('application_id', $application->application_master_id)->where('is_deleted',0)->orderBy('group')->orderBy('sort_by')->with(['documents_uploaded' => function($q) use ($application){
            $q->where('society_id', $application->society_id)->where('application_id',$application->id)->get();
        }])->get()->groupBy('group');

        return $societyDocuments;
    }

    // EE - Scrutiny & Remark page
    public function getEEScrutinyRemark($applicationId)
    {

        $eeScrutinyData = OlApplication::with(['eeApplicationSociety.societyDocuments.documents_Name'])
            ->where('id', $applicationId)->first();

        $eeScrutinyData->eeNote = EENote::where('application_id', $applicationId)
            ->orderBy('id', 'desc')->get();

        $this->getVerificationDetails($eeScrutinyData, $applicationId);
        $this->getChecklistDetails($eeScrutinyData, $applicationId);
        return $eeScrutinyData;
    }

    //get all verifivation details submitted by EE
    protected function getVerificationDetails($eeScrutinyData, $applicationId)
    {

//        $eeScrutinyData ->consentQuetions = OlConsentVerificationDetails::with('consentQuestions')->where('application_id',$applicationId)->get();
        $eeScrutinyData->consentQuetions = OlConsentVerificationQuestionMaster::with(['consentDetails' => function ($q) use ($applicationId) {
            $q->where('application_id', $applicationId);
        }])->get();

//        $eeScrutinyData->DemarkQuetions = OlDemarcationVerificationDetails::with('DemarkQuestions')->where('application_id',$applicationId)->get();
        $eeScrutinyData->DemarkQuetions = OlDemarcationVerificationQuestionMaster::with(['demarkDetails' => function ($q) use ($applicationId) {
            $q->where('application_id', $applicationId);
        }])->get();

//        $eeScrutinyData->TitBitQuetions = OlTitBitVerificationDetails::with('TitBitQuestions')->where('application_id',$applicationId)->get();
        $eeScrutinyData->TitBitQuetions = OlTitBitVerificationQuestionMaster::with(['titBitDetails' => function ($q) use ($applicationId) {
            $q->where('application_id', $applicationId);
        }])->get();

//        $eeScrutinyData->relocationQuetions = OlRelocationVerificationDetails::with('relocationQuestions')->where('application_id',$applicationId)->get();
        $eeScrutinyData->relocationQuetions = OlRgRelocationVerificationQuestionMaster::with(['relocationDetails' => function ($q) use ($applicationId) {
            $q->where('application_id', $applicationId);
        }])->get();
    }

    // get all checklist details submitted by EE
    protected function getChecklistDetails($eeScrutinyData, $applicationId)
    {

        $eeScrutinyData->Consent_checklist = OlChecklistScrutiny::where('application_id', $applicationId)->where('verification_type', 'CONSENT VERIFICATION')->first();

        $eeScrutinyData->Demark_checklist = OlChecklistScrutiny::where('application_id', $applicationId)->where('verification_type', 'DEMARCATION')->first();

        $eeScrutinyData->TitBit_checklist = OlChecklistScrutiny::where('application_id', $applicationId)->where('verification_type', 'TIT BIT')->first();

        $eeScrutinyData->Relocation_checklist = OlChecklistScrutiny::where('application_id', $applicationId)->where('verification_type', 'RG RELOCATION')->first();

    }

    // function used to DyCE Scrutiny & Remark page
    public function getDyceScrutinyRemark($applicationId)
    {

        $applicationData = OlApplication::with(['eeApplicationSociety', 'visitDocuments'])
            ->where('id', $applicationId)->first();

        if (isset($applicationData) && isset($applicationData->site_visit_officers)) {
            $applicationData->SiteVisitorOfficers = explode(",", $applicationData->site_visit_officers);
        }

        return $applicationData;
    }

    // Forward Application page
    public function getForwardApplication($applicationId)
    {

        $applicationData = OlApplication::with(['eeApplicationSociety'])
            ->where('id', $applicationId)->orderBy('id', 'DESC')->first();

        return $applicationData;
    }



    public function architect_applications($request)
    {
        
        $architect_applications = EoaApplication::with(['ArchitectApplicationStatusForLoginListing' => function ($query) {
            return $query->where(['user_id' => auth()->user()->id, 'role_id' => session()->get('role_id')])->orderBy('id', 'desc');
        }])->whereHas('ArchitectApplicationStatusForLoginListing', function ($q) {
            $q->where('user_id', Auth::user()->id)
                ->where('role_id', session()->get('role_id'))
                ->orderBy('id', 'desc');
        });
        //dd($architect_applications->get());
        if ($request->keyword) {
            $architect_applications->where(function ($query) use ($request) {
                $query->orWhere('application_number', 'like', '%' . $request->keyword . '%');
                $query->orWhere('name_of_applicant', 'like', '%' . $request->keyword . '%');
                //$query->orWhere('candidate_email', 'like', '%' . $request->keyword . '%');
                $query->orWhere('mobile', 'like', '%' . $request->keyword . '%');
            });
        }
        if ($request->application_status) {
            $architect_applications->where('application_status', '=', $request->application_status);
        }

        if ($request->from) {
            $architect_applications->whereDate(DB::raw('DATE(created_at)'), '>=', date('Y-m-d', strtotime($request->from)));
        }

        if ($request->status) {
            $architect_applications->where(DB::raw($request->status), '=', function ($q) {
                $q->from('architect_application_status_logs')
                    ->select('status_id')
                    ->where('user_id', auth()->user()->id)
                    ->where('role_id', session()->get('role_id'))
                    ->where('architect_application_id', '=', DB::raw('eoa_applications.id'))
                    ->limit(1)
                    ->orderBy('id', 'desc');
                    //dd($q->get());
            });
        }

        if ($request->to) {
            $architect_applications->whereDate(DB::raw('DATE(created_at)'), '<=', date('Y-m-d', strtotime($request->to)));
        }
        $architect_application = $architect_applications->orderBY('id','desc')->get();

        return $architect_application;
    }

    // public function architect_applications($request)
    // {
    //     $architect_applications = ArchitectApplication::with(['ArchitectApplicationStatusForLoginListing' => function ($query) {
    //         return $query->where(['user_id' => auth()->user()->id, 'role_id' => session()->get('role_id')])->orderBy('id', 'desc');
    //     }]);

    //     if ($request->keyword) {
    //         $architect_applications->where(function ($query) use ($request) {
    //             $query->orWhere('application_number', 'like', '%' . $request->keyword . '%');
    //             $query->orWhere('candidate_name', 'like', '%' . $request->keyword . '%');
    //             $query->orWhere('candidate_email', 'like', '%' . $request->keyword . '%');
    //             $query->orWhere('candidate_mobile_no', 'like', '%' . $request->keyword . '%');
    //         });
    //     }
    //     if ($request->application_status) {
    //         $architect_applications->where('application_status', '=', $request->application_status);
    //     }

    //     if ($request->from) {
    //         $architect_applications->whereDate('application_date', '>=', date('Y-m-d', strtotime($request->from)));
    //     }

    //     if ($request->status) {
    //         $architect_applications->where(DB::raw($request->status), '=', function ($q) {
    //             $q->from('architect_application_status_logs')
    //                 ->select('status_id')
    //                 ->where('user_id', auth()->user()->id)
    //                 ->where('role_id', session()->get('role_id'))
    //                 ->where('architect_application_id', '=', DB::raw('architect_application.id'))
    //                 ->limit(1)
    //                 ->orderBy('id', 'desc');
    //         });
    //     }

    //     if ($request->to) {
    //         $architect_applications->whereDate('application_date', '<=', date('Y-m-d', strtotime($request->to)));
    //     }
    //     $architect_application = $architect_applications->get();

    //     return $architect_application;
    // }

    public function roles_will_see_all_architect_layouts()
    {
        return array(
            config('commanConfig.architect'),
            config('commanConfig.co_engineer'),
            config('commanConfig.cap_engineer'),
            config('commanConfig.vp_engineer'),
            config('commanConfig.la_engineer'),
            config('commanConfig.land_manager'),
            config('commanConfig.senior_architect_planner')
        );
    }

    public function architect_layout_details($request)
    {
        
        $ArchitectLayoutLayoutdetailsQuery = ArchitectLayout::with(['ArchitectLayoutStatusLogInListing' => function ($q) {
            $q->where('user_id', Auth::user()->id)
                ->where('role_id', session()->get('role_id'))
                ->orderBy('id', 'desc');
        }])->whereHas('ArchitectLayoutStatusLogInListing', function ($q) {
            $q->where('user_id', Auth::user()->id)
                ->where('role_id', session()->get('role_id'))
                ->orderBy('id', 'desc');
        });
        if ($request->update_status) {
            $ArchitectLayoutLayoutdetailsQuery->where(DB::raw($request->update_status), '=', function ($q) {
                $q->from('architect_layout_status_logs')
                    ->select('status_id')
                    ->where('architect_layout_id', '=', DB::raw('architect_layouts.id'))
                    ->where('user_id', Auth::user()->id)
                    ->where('role_id', session()->get('role_id'))
                    ->limit(1)->orderBy('id', 'desc');
            });
        }

        if ($request->title) {
            $ArchitectLayoutLayoutdetailsQuery->where('layout_no', $request->title);
        }

        if ($request->submitted_at_from && $request->submitted_at_to) {
            $ArchitectLayoutLayoutdetailsQuery->whereBetween('added_date', [date('Y-m-d', strtotime($request->submitted_at_from)), date('Y-m-d', strtotime($request->submitted_at_to))]);
        }
        $LayoutUser=\App\LayoutUser::where(['user_id'=>auth()->user()->id])->first();
        $layouts_ids=array();
        $LayoutUser=\App\LayoutUser::where(['user_id'=>auth()->user()->id])->get();
        foreach($LayoutUser as $layout)
        {
            $layouts_ids[]=$layout->layout_id;
        }
        if($LayoutUser)
        {
            if(!in_array(session()->get('role_name'),$this->roles_will_see_all_architect_layouts()))
            {
            $ArchitectLayoutLayoutdetails = $ArchitectLayoutLayoutdetailsQuery->whereIn('layout_name',$layouts_ids);
            }
        }
        
        $ArchitectLayoutLayoutdetails = $ArchitectLayoutLayoutdetailsQuery->orderBy('id','desc')->get();

        return $ArchitectLayoutLayoutdetails;
    }
    public function architect_layout_request_revision($request)
    {
        $ArchitectLayoutRevisionRequestsQuery = ArchitectLayout::with(['ArchitectLayoutStatusLogInListing' => function ($q) {
            $q->where('user_id', Auth::user()->id)
                ->where('role_id', session()->get('role_id'))
                //->limit(1)
                ->orderBy('id', 'desc');
        }])->whereHas('ArchitectLayoutStatusLogInListing', function ($q) {
            $q->where('user_id', Auth::user()->id)
                ->where('role_id', session()->get('role_id'))
                //->limit(1)
                ->orderBy('id', 'desc');
        });
        //dd($ArchitectLayoutRevisionRequestsQuery->get());
        if ($request->update_status) {
            $ArchitectLayoutRevisionRequestsQuery->where(DB::raw($request->update_status), '=', function ($q) {
                $q->from('architect_layout_status_logs')
                    ->select('status_id')
                    ->where('architect_layout_id', '=', DB::raw('architect_layouts.id'))
                    ->where('user_id', Auth::user()->id)
                    ->where('role_id', session()->get('role_id'))
                    ->limit(1)
                    ->orderBy('id', 'desc');
            });
        }
        if ($request->submitted_at_from && $request->submitted_at_to) {
            $ArchitectLayoutRevisionRequestsQuery->whereBetween('added_date', [date('Y-m-d', strtotime($request->submitted_at_from)), date('Y-m-d', strtotime($request->submitted_at_to))]);
        }
        if ($request->title) {
            //dd($request->title);
            $ArchitectLayoutRevisionRequestsQuery->where('layout_no', $request->title);
        }
        $layouts_ids=array();
        $LayoutUser=\App\LayoutUser::where(['user_id'=>auth()->user()->id])->get();
        foreach($LayoutUser as $layout)
        {
            $layouts_ids[]=$layout->layout_id;
        }
        if($LayoutUser)
        {
            if(!in_array(session()->get('role_name'),$this->roles_will_see_all_architect_layouts()))
            {
                $ArchitectLayoutRevisionRequestsQuery = $ArchitectLayoutRevisionRequestsQuery->whereIn('layout_name',$layouts_ids);
            }   
        }
        // query replaced for optimization
        $ArchitectLayoutRevisionRequests = $ArchitectLayoutRevisionRequestsQuery->where(DB::raw(config('commanConfig.architect_layout_status.new_application')), '!=', function ($q) {
            $q->from('architect_layout_status_logs')->select('status_id')->where('architect_layout_id', '=', DB::raw('architect_layouts.id'))->limit(1)->orderBy('id', 'desc');
        })->where(DB::raw(config('commanConfig.architect_layout_status.approved')), '!=', function ($q) {
            $q->from('architect_layout_status_logs')->select('status_id')->where('architect_layout_id', '=', DB::raw('architect_layouts.id'))->limit(1)->orderBy('id', 'desc');
        })->orderBY('id','desc')->get();
        
        // $ArchitectLayoutRevisionRequests = $ArchitectLayoutRevisionRequestsQuery->where(DB::raw(config('commanConfig.architect_layout_status.new_application')), '!=', function ($q) {
        //     $q->from('architect_layout_status_logs')->select('status_id')->where('architect_layout_id', '=', DB::raw('architect_layouts.id'))->where('open',1);
        // })->where(DB::raw(config('commanConfig.architect_layout_status.approved')), '!=', function ($q) {
        //     $q->from('architect_layout_status_logs')->select('status_id')->where('architect_layout_id', '=', DB::raw('architect_layouts.id'))->where('open',1);
        // })->get();
        //dd($ArchitectLayoutRevisionRequests);
        return $ArchitectLayoutRevisionRequests;
    }

    public function forward_architect_layout($architect_layout_id,$forward_application)
    {
      DB::transaction(function () use($architect_layout_id,$forward_application){
        foreach($forward_application as $forward_app)
        {
            ArchitectLayoutStatusLog::where(['architect_layout_id'=>$architect_layout_id,'open'=>1])->update(['open'=>0]);
            ArchitectLayoutStatusLog::where(['architect_layout_id'=>$architect_layout_id,'current_status'=>1,'user_id'=>$forward_app['user_id']])->update(['current_status'=>0]);
            ArchitectLayoutStatusLog::insert([$forward_app]);
        }
        
      });
    }

    public function listApplicationData($request, $application_type = null)
    {
        $applicationData = OlApplication::with(['applicationLayoutUser', 'ol_application_master', 'eeApplicationSociety', 'olApplicationStatusForLoginListing' => function ($q) {
            $q->where('user_id', Auth::user()->id)
                ->where('role_id', session()->get('role_id'))
                ->where('society_flag', 0)
                ->orderBy('id', 'desc');
        }])
            ->whereHas('olApplicationStatusForLoginListing', function ($q) {
                $q->where('user_id', Auth::user()->id)
                    ->where('role_id', session()->get('role_id'))
                    ->where('society_flag', 0)
                    ->orderBy('id', 'desc');
            });

        if ($request->submitted_at_from) {
            $applicationData = $applicationData->whereDate('submitted_at', '>=', date('Y-m-d', strtotime($request->submitted_at_from)));
        }

        if ($request->submitted_at_to) {
            $applicationData = $applicationData->whereDate('submitted_at', '<=', date('Y-m-d', strtotime($request->submitted_at_to)));
        }

        if ($application_type != null && $application_type == "reval") {
            $application_master_arr = OlApplicationMaster::Where('title', 'like', '%Revalidation Of Offer Letter%')->pluck('id')->toArray();
            $applicationData = $applicationData->whereIn('application_master_id', $application_master_arr);
        }
        else if($application_type!=null && $application_type =='tripartite')
        {
            $application_master_arr = OlApplicationMaster::Where('title', 'like', '%Tripartite Agreement%')->pluck('id')->toArray();
            $applicationData = $applicationData->whereIn('application_master_id', $application_master_arr);
        }else
        {
            $application_master_arr = OlApplicationMaster::Where('title', 'like', '%New - Offer Letter%')->pluck('id')->toArray();
            $applicationData = $applicationData->whereIn('application_master_id', $application_master_arr);
        }

        $applicationDataDefine = $applicationData->orderBy('ol_applications.id', 'desc')
            ->select()->get();

        $listArray = [];
        if ($request->update_status) {

            foreach ($applicationDataDefine as $app_data) {
                if ($app_data->olApplicationStatusForLoginListing[0]->status_id == $request->update_status) {
                    $listArray[] = $app_data;
                }
            }
        } else {
            $listArray = $applicationDataDefine;
        }

        return $listArray;
    }

    public function forwardApplicationForm($request)
    {
        if ($request->check_status == 1) {
            $forward_application = [[
                'application_id' => $request->applicationId,
                'user_id' => Auth::user()->id,
                'role_id' => session()->get('role_id'),
                'status_id' => config('commanConfig.applicationStatus.forwarded'),
                'to_user_id' => $request->to_user_id,
                'to_role_id' => $request->to_role_id,
                'remark' => $request->remark,
                'is_active' => 1,
                'created_at' => Carbon::now(),
            ],

                [
                    'application_id' => $request->applicationId,
                    'user_id' => $request->to_user_id,
                    'role_id' => $request->to_role_id,
                    'status_id' => config('commanConfig.applicationStatus.in_process'),
                    'to_user_id' => null,
                    'to_role_id' => null,
                    'remark' => $request->remark,
                    'is_active' => 1,
                    'created_at' => Carbon::now(),
                ],
            ];

            //Code added by Prajakta >>start
            DB::beginTransaction();
            try {
                OlApplicationStatus::where('application_id',$request->applicationId)
                    ->whereIn('user_id', [Auth::user()->id,$request->to_user_id ])
                    ->update(array('is_active' => 0));

                OlApplicationStatus::insert($forward_application);

                DB::commit();
            } catch (\Exception $ex) {
                DB::rollback();
//                return response()->json(['error' => $ex->getMessage()], 500);
            }
            //Code added by Prajakta >>end

        } else {


            if (session()->get('role_name') == config('commanConfig.cap_engineer') || session()->get('role_name') == config('commanConfig.vp_engineer')) {

                $revert_application = [
                    [
                        'application_id' => $request->applicationId,
                        'user_id' => Auth::user()->id,
                        'role_id' => session()->get('role_id'),
                        'status_id' => config('commanConfig.applicationStatus.reverted'),
                        'to_user_id' => $request->to_child_id,      // replaced user id to child id in case of revert - Neelam
                        'to_role_id' => $request->to_role_id,
                        'remark' => $request->remark,
                        'is_active' => 1,
                        'created_at' => Carbon::now(),
                    ],

                    [
                        'application_id' => $request->applicationId,
                        'user_id' => $request->to_child_id, // replaced user id to child id in case of revert - Neelam
                        'role_id' => $request->to_role_id,
                        'status_id' => config('commanConfig.applicationStatus.in_process'),
                        'to_user_id' => null,
                        'to_role_id' => null,
                        'remark' => $request->remark,
                        'is_active' => 1,
                        'created_at' => Carbon::now(),
                    ],
                ];
            }
            else {
                //Code added by Prajakta >>start
                $to_user_id = $request->to_child_id;
                //Code added by Prajakta >>end

                if($request->to_role_id==28)    // revert to society
                {
                    $revert_application = [
                        [
                            'application_id' => $request->applicationId,
                            'user_id' => Auth::user()->id,
                            'role_id' => session()->get('role_id'),
                            'status_id' => config('commanConfig.applicationStatus.reverted'),
                            'to_user_id' => $request->to_child_id,
                            'to_role_id' => $request->to_role_id,
                            'remark' => $request->remark,
                            'is_active' => 1,
                            'society_flag'=>0,
                            'created_at' => Carbon::now(),
                        ],

                        [

                            'application_id' => $request->applicationId,
                            'user_id' => $request->to_child_id,
                            'role_id' => $request->to_role_id,
                            'status_id' => config('commanConfig.applicationStatus.pending'),
                            'to_user_id' => null,
                            'to_role_id' => null,
                            'remark' => $request->remark,
                            'is_active' => 1,
                            'society_flag'=>1,
                            'created_at' => Carbon::now(),

                        ],
                    ];
                }
                else {
                    $revert_application = [
                        [
                            'application_id' => $request->applicationId,
                            'user_id' => Auth::user()->id,
                            'role_id' => session()->get('role_id'),
                            'status_id' => config('commanConfig.applicationStatus.reverted'),
                            'to_user_id' => $request->to_child_id,
                            'to_role_id' => $request->to_role_id,
                            'remark' => $request->remark,
                            'is_active' => 1,
                            'created_at' => Carbon::now(),
                        ],

                        [
                            'application_id' => $request->applicationId,
                            'user_id' => $request->to_child_id,
                            'role_id' => $request->to_role_id,
                            'status_id' => config('commanConfig.applicationStatus.in_process'),
                            'to_user_id' => null,
                            'to_role_id' => null,
                            'remark' => $request->remark,
                            'is_active' => 1,
                            'created_at' => Carbon::now(),
                        ],
                    ];
                }
            }
          //  dd($revert_application);
            //Code added by Prajakta >>start
            DB::beginTransaction();
            try {
                OlApplicationStatus::where('application_id',$request->applicationId)
                    ->whereIn('user_id', [Auth::user()->id,$request->to_child_id ])
                    ->update(array('is_active' => 0));

                OlApplicationStatus::insert($revert_application);

                DB::commit();
            } catch (\Exception $ex) { echo ($ex->getMessage());exit;
                DB::rollback();
               return response()->json(['error' => $ex->getMessage()], 500);
            }
            //Code added by Prajakta >>end

        }

        return true;
    }

    public function forwardApplicationToCoForOfferLetterGeneration($request, $getCo)
    {
        $forward_application = [[
            'application_id' => $request->applicationId,
            'user_id' => Auth::user()->id,
            'role_id' => session()->get('role_id'),
            'status_id' => config('commanConfig.applicationStatus.forwarded'),
            'to_user_id' => $getCo->user_id,
            'to_role_id' => $getCo->role_id,
            'remark' => $request->remark,
            'is_active' => 1,
            'phase' => 1,
            'created_at' => Carbon::now(),
        ],

            [
                'application_id' => $request->applicationId,
                'user_id' => $getCo->user_id,
                'role_id' => $getCo->role_id,
                'status_id' => config('commanConfig.applicationStatus.offer_letter_generation'),
                'to_user_id' => null,
                'to_role_id' => null,
                'remark' => $request->remark,
                'is_active' => 1,
                'phase' => 1,
                'created_at' => Carbon::now(),
            ],
        ];

        //Code added by Prajakta >>start
        DB::beginTransaction();
        try {
            OlApplicationStatus::where('application_id',$request->applicationId)
                ->whereIn('user_id', [Auth::user()->id,$getCo->user_id ])
                ->update(array('is_active' => 0));

            OlApplicationStatus::insert($forward_application);
            OlApplication::where('id', $request->applicationId)->update(['status_offer_letter' => config('commanConfig.applicationStatus.offer_letter_generation')]);

            DB::commit();
        } catch (\Exception $ex) {
            DB::rollback();
//                return response()->json(['error' => $ex->getMessage()], 500);
        }
        //Code added by Prajakta >>end

        return true;
    }

    public function generateOfferLetterForwardToREE($request, $ree)
    {
        $forward_application = [[
            'application_id' => $request->applicationId,
            'user_id' => Auth::user()->id,
            'role_id' => session()->get('role_id'),
            'status_id' => config('commanConfig.applicationStatus.forwarded'),
            'to_user_id' => $ree->user_id,
            'to_role_id' => $ree->role_id,
            'remark' => $request->remark,
            'is_active' => 1,
            'phase' => 2,
            'created_at' => Carbon::now(),
        ],

            [
                'application_id' => $request->applicationId,
                'user_id' => $ree->user_id,
                'role_id' => $ree->role_id,
                'status_id' => config('commanConfig.applicationStatus.offer_letter_approved'),
                'to_user_id' => null,
                'to_role_id' => null,
                'remark' => $request->remark,
                'is_active' => 1,
                'phase' => 2,
                'created_at' => Carbon::now(),
            ],
        ];

        //Code added by Prajakta >>start
        DB::beginTransaction();
        try {
            OlApplicationStatus::where('application_id',$request->applicationId)
                ->whereIn('user_id', [Auth::user()->id,$ree->user_id])
                ->update(array('is_active' => 0));

            OlApplicationStatus::insert($forward_application);
            OlApplication::where('id', $request->applicationId)->update(['status_offer_letter' => config('commanConfig.applicationStatus.offer_letter_approved'), 'is_approve_offer_letter' => $request->is_approved]);

            DB::commit();
        } catch (\Exception $ex) {
            DB::rollback();
//                return response()->json(['error' => $ex->getMessage()], 500);
        }
        //Code added by Prajakta >>end


        return true;
    }

    public function forwardApprovedApplication($request)
    {
        if ($request->check_status == 1) {
            $forward_application = [[
                'application_id' => $request->applicationId,
                'user_id' => Auth::user()->id,
                'role_id' => session()->get('role_id'),
                'status_id' => config('commanConfig.applicationStatus.forwarded'),
                'to_user_id' => $request->to_user_id,
                'to_role_id' => $request->to_role_id,
                'remark' => $request->remark,
                'is_active' => 1,
                'phase' => 2,
                'created_at' => Carbon::now(),
            ],

                [
                    'application_id' => $request->applicationId,
                    'user_id' => $request->to_user_id,
                    'role_id' => $request->to_role_id,
                    'status_id' => config('commanConfig.applicationStatus.offer_letter_approved'),
                    'to_user_id' => null,
                    'to_role_id' => null,
                    'remark' => $request->remark,
                    'is_active' => 1,
                    'phase' => 2,
                    'created_at' => Carbon::now(),
                ],
            ];

            //Code added by Prajakta >>start
            DB::beginTransaction();
            try {
                OlApplicationStatus::where('application_id',$request->applicationId)
                    ->whereIn('user_id', [Auth::user()->id,$request->to_user_id])
                    ->update(array('is_active' => 0));

                OlApplicationStatus::insert($forward_application);
                OlApplication::where('id', $request->applicationId)->update(['status_offer_letter' => config('commanConfig.applicationStatus.offer_letter_approved')]);

                DB::commit();
            } catch (\Exception $ex) {
                DB::rollback();
//                return response()->json(['error' => $ex->getMessage()], 500);
            }
            //Code added by Prajakta >>end



//            echo "in forward";
            //            dd($forward_application);
             }

        return true;
    }

    public function forwardApplicationToSociety($request)
    {
        $society_details = OlApplicationStatus::where(['society_flag' => 1, 'application_id' => $request->applicationId])->orderBy('id', 'desc')->first();

        $forward_application = [
            [
                'application_id' => $request->applicationId,
                'user_id' => Auth::user()->id,
                'role_id' => session()->get('role_id'),
                'status_id' => config('commanConfig.applicationStatus.sent_to_society'),
                'to_user_id' => $society_details->user_id,
                'society_flag' => 0,
                'to_role_id' => $society_details->role_id,
                'remark' => $request->remark,
                'is_active' => 1,
                'phase' => 2,
                'created_at' => Carbon::now(),
            ],

            [
                'application_id' => $request->applicationId,
                'user_id' => $society_details->user_id,
                'role_id' => $society_details->role_id,
                'status_id' => config('commanConfig.applicationStatus.sent_to_society'),
                'to_user_id' => null,
                'society_flag' => 1,
                'to_role_id' => null,
                'remark' => $request->remark,
                'is_active' => 1,
                'phase' => 2,
                'created_at' => Carbon::now(),
            ],
        ];

        //Code added by Prajakta >>start
        DB::beginTransaction();
        try {
            OlApplicationStatus::where('application_id',$request->applicationId)
                ->whereIn('user_id', [Auth::user()->id,$society_details->user_id])
                ->update(array('is_active' => 0));

            OlApplicationStatus::insert($forward_application);
            OlApplication::where('id', $request->applicationId)->update(['status_offer_letter' => config('commanConfig.applicationStatus.sent_to_society')]);

            DB::commit();
        } catch (\Exception $ex) {
            DB::rollback();
//                return response()->json(['error' => $ex->getMessage()], 500);
        }
        //Code added by Prajakta >>end


        return true;
    }

    public function getCurrentApplicationStatus($application_id)
    {
        $current_application_status = OlApplicationStatus::where('application_id', $application_id)
            ->where('to_user_id', Auth::user()->id)
            ->where('to_role_id', session()->get('role_id'))
            ->where('status_id', config('commanConfig.applicationStatus.forwarded'))->orderBy('id', 'desc')->first();

        return $current_application_status;
    }

    public function getCurrentLoggedInChild($application_id)
    {
        $child_role_id = Role::where('id', session()->get('role_id'))->get(['child_id']);
        $result = json_decode($child_role_id[0]->child_id);
        $status_user = OlApplicationStatus::where(['application_id' => $application_id, 'society_flag' => 0])->pluck('user_id')->toArray();

        $final_child = User::with('roles')->whereIn('id', array_unique($status_user))->whereIn('role_id', $result)->get();

        if(session()->get('role_name') == config('commanConfig.ree_branch_head') && $final_child != "")
        {
            $society_id = OlApplication::where('id',$application_id)->get(['society_id']);
            $SocietyOfferLetter = SocietyOfferLetter::find($society_id);
            $society_user_id = $SocietyOfferLetter[0]->user_id;
            $society_user = User::where('id',$society_user_id)->get();

            $final_child = $final_child->merge($society_user);
        }


        return $final_child;
    }

    public function getForwardApplicationParentData()
    {
        $user = User::with(['roles.parent.parentUser'])->where('users.id', Auth::user()->id)->first();
        $roles = array_get($user, 'roles');
        $parent = array_get($roles[0], 'parent');
        $arrData['parentData'] = array_get($parent, 'parentUser');
        $arrData['role_name'] = strtoupper(str_replace('_', ' ', $parent['name']));

        return $arrData;
    }

    public function getForwardApplicationArchitectParentData()
    {
        $user = User::with(['roles.parent.parentUserArchitect'])->where('users.id', Auth::user()->id)->first();

        $roles = array_get($user, 'roles');
        $parent = array_get($roles[0], 'parent');
        $arrData['parentData'] = array_get($parent, 'parentUserArchitect');
        $arrData['role_name'] = strtoupper(str_replace('_', ' ', $parent['name']));

        return $arrData;
    }

    public function getEEForwardRevertLog($applicationData, $applicationId)
    {

        $ee_branch_head = Role::where('name', config('commanConfig.ee_branch_head'))
            ->value('id');
        // $ee_jr_user = Role::where('name',config('commanConfig.ee_junior_engineer'))
        // ->value('id');
        $applicationData->eeForwardLog = OlApplicationStatus::where('application_id', $applicationId)->where('role_id', $ee_branch_head)->where('status_id', config('commanConfig.applicationStatus.forwarded'))->orderBy('id', 'desc')->first();

        $applicationData->eeRevertLog = OlApplicationStatus::where('application_id', $applicationId)->where('role_id', $ee_branch_head)->where('status_id', config('commanConfig.applicationStatus.reverted'))->where('society_flag', 1)->orderBy('id', 'desc')->first();

        return $applicationData;
    }

    public function getDyceForwardRevertLog($applicationData, $applicationId)
    {

        $dyce_branch_head = Role::where('name', config('commanConfig.dyce_branch_head'))
            ->value('id');
        $dyce_jr_user = Role::where('name', config('commanConfig.dyce_jr_user'))
            ->value('id');
        $applicationData->dyceForwardLog = OlApplicationStatus::where('application_id', $applicationId)->where('role_id', $dyce_branch_head)->where('status_id', config('commanConfig.applicationStatus.forwarded'))->orderBy('id', 'desc')->first();

        $applicationData->dyceRevertLog = OlApplicationStatus::where('application_id', $applicationId)->where('role_id', $dyce_jr_user)->where('status_id', config('commanConfig.applicationStatus.reverted'))->orderBy('id', 'desc')->first();
        return $applicationData;
    }

    public function getREEForwardRevertLog($applicationData, $applicationId)
    {

        $ree_branch_head = Role::where('name', config('commanConfig.ree_branch_head'))->value('id');
        $ree_jr_user = Role::where('name', config('commanConfig.ree_junior'))
            ->value('id');
        $applicationData->reeForwardLog = OlApplicationStatus::where('application_id', $applicationId)->where('role_id', $ree_branch_head)->where('status_id', config('commanConfig.applicationStatus.forwarded'))->orderBy('id', 'desc')->first();

        $applicationData->reeRevertLog = OlApplicationStatus::where('application_id', $applicationId)->where('role_id', $ree_jr_user)->where('status_id', config('commanConfig.applicationStatus.reverted'))->orderBy('id', 'desc')->first();
        return $applicationData;
    }

    public function downloadCapNote($applicationId)
    {

        $capNotes = OlCapNotes::where('application_id', $applicationId)->orderBy('id', 'DESC')->first();
        return $capNotes;
    }

    public function getCurrentStatus($application_id)
    {
        $current_status = OlApplicationStatus::where('application_id', $application_id)
            ->where('user_id', Auth::user()->id)
            ->where('role_id', session()->get('role_id'))
            ->orderBy('id', 'desc')->first();

        return $current_status;
    }

    public function getCurrentStatusOc($application_id)
    {
        $current_status = OcApplicationStatusLog::where('application_id', $application_id)
            ->where('user_id', Auth::user()->id)
            ->where('role_id', session()->get('role_id'))
            ->orderBy('id', 'desc')->first();

        return $current_status;
    }

    public function downloadOfferLetter($applicationId)
    {

        $ol_application = OlApplication::where('id', $applicationId)->with(['request_form', 'applicationMasterLayout', 'eeApplicationSociety'])->first();
        $ol_application->layouts = MasterLayout::all();
       
        return $ol_application;
    }

    public function downloadConsentforOc($applicationId)
    {

        $ol_application = OcApplication::where('id', $applicationId)->with(['request_form', 'applicationMasterLayout', 'eeApplicationSociety'])->first();
        $ol_application->layouts = MasterLayout::all();

        return $ol_application;
    }

    public function ftpFileUpload($folderName, $file, $fileName)
    {
        return Storage::disk('ftp')->putFileAs($folderName, $file, $fileName);
    }


    // For drafting document
    public function ftpGeneratedFileUpload($folder_name, $file, $file_path)
    {
        if (!(Storage::disk('ftp')->has($folder_name))) {
            Storage::disk('ftp')->makeDirectory($folder_name, $mode = 0777, true, true);
        }
        return Storage::disk('ftp')->put($file_path, $file);
    }

    // For retrieving FTP file content
    public function getftpFileContent($file_path)
    {
        return Storage::disk('ftp')->get($file_path);
    }


    public function generateOfferLetterREE($request)
    {
        $forward_application = [[
            'application_id' => $request->applicationId,
            'user_id' => Auth::user()->id,
            'role_id' => session()->get('role_id'),
            'status_id' => config('commanConfig.applicationStatus.forwarded'),
            'to_user_id' => $request->to_user_id,
            'to_role_id' => $request->to_role_id,
            'remark' => $request->remark,
            'is_active' => 1,
            'phase' => 1,
            'created_at' => Carbon::now(),
        ],

            [
                'application_id' => $request->applicationId,
                'user_id' => $request->to_user_id,
                'role_id' => $request->to_role_id,
                'status_id' => config('commanConfig.applicationStatus.offer_letter_generation'),
                'to_user_id' => null,
                'to_role_id' => null,
                'remark' => $request->remark,
                'is_active' => 1,
                'phase'=>1,
                'created_at' => Carbon::now(),
            ],
        ];

        //Code added by Prajakta >>start
        DB::beginTransaction();
        try {
            OlApplicationStatus::where('application_id',$request->applicationId)
                ->whereIn('user_id', [Auth::user()->id,$request->to_user_id ])
                ->update(array('is_active' => 0));

            OlApplicationStatus::insert($forward_application);
            OlApplication::where('id', $request->applicationId)->update(['status_offer_letter' => config('commanConfig.applicationStatus.offer_letter_generation')]);

            DB::commit();
        } catch (\Exception $ex) {
            DB::rollback();
//                return response()->json(['error' => $ex->getMessage()], 500);
        }
        //Code added by Prajakta >>end

        return true;
    }

    public function showCalculationSheet($applicationId)
    {

        $arr = array();
        $arr = Auth::user();
        $model = OlApplication::with('ol_application_master')->where('id', $applicationId)->first();
        if ($model->ol_application_master->model == 'Premium') {
            $arr->calculationSheetDetails = OlApplicationCalculationSheetDetails::where('application_id', '=', $applicationId)->get();

            $arr->blade = 'premiunCalculationSheet';

        } elseif ($model->ol_application_master->model == 'Sharing') {

            $arr->calculationSheetDetails = OlSharingCalculationSheetDetail::where('application_id', '=', $applicationId)->get();

            $arr->blade = 'sharingCalculationSheet';
        }

        $arr->dcr_rates = OlDcrRateMaster::all();

        // $arr->arrData['reeNote'] = REENote::where('application_id', $applicationId)->orderBy('id', 'desc')->first();

        $arr->areeNote = REENote::where('application_id', $applicationId)->orderBy('id', 'desc')->first();

        return $arr;
    }

    public function getOlApplication($applicationId)
    {

        $ol_application = OlApplication::where('id', $applicationId)->with(['request_form', 'applicationMasterLayout', 'eeApplicationSociety', 'ol_application_master','getLayout'])->first();

        return $ol_application;
    }

    public function getOcApplication($applicationId)
    {

        $oc_application = OcApplication::where('id', $applicationId)->with(['request_form', 'applicationMasterLayout', 'eeApplicationSociety', 'ol_application_master'])->first();

        return $oc_application;
    }

    public function getLogOfArchitectLayoutApplication($layout_id)
    {
        $roles = array(config('commanConfig.junior_architect'), config('commanConfig.senior_architect'), config('commanConfig.architect'));

        $status = array(config('commanConfig.architect_layout_status.forward'),config('commanConfig.architect_layout_status.reverted'));

        $architectRoles = Role::whereIn('name', $roles)->pluck('id');
        $Architectlogs = ArchitectLayoutStatusLog::with('getRoleName')->where('architect_layout_id', $layout_id)->whereIn('role_id', $architectRoles)->whereIn('status_id', $status)->get();
        //dd($Architectlogs);
        return $Architectlogs;
    }

    public function getLogOfAppointingArchitectApplication($application_id)
    {
        $roles = array(config('commanConfig.junior_architect'), config('commanConfig.senior_architect'), config('commanConfig.architect'));

        $status = array(config('commanConfig.architect_applicationStatus.forward'),config('commanConfig.architect_applicationStatus.reverted'));

        $architectRoles = Role::whereIn('name', $roles)->pluck('id');
        $Architectlogs = ArchitectApplicationStatusLog::with('getRoleName')->where('architect_application_id', $application_id)->whereIn('role_id', $architectRoles)->whereIn('status_id', $status)->get();
        //dd($Architectlogs);
        return $Architectlogs;
    }

    public function getLogOfEmLayoutApplication($layout_id)
    {
        $roles = array(config('commanConfig.estate_manager'));

        $status = array(config('commanConfig.architect_layout_status.forward'));

        $architectRoles = Role::whereIn('name', $roles)->pluck('id');
        $Architectlogs = ArchitectLayoutStatusLog::with('getRoleName')->where('architect_layout_id', $layout_id)->whereIn('role_id', $architectRoles)->whereIn('status_id', $status)->get();
        //dd($Architectlogs);
        return $Architectlogs;
    }

    public function getLogOfLmLayoutApplication($layout_id)
    {
        $roles = array(config('commanConfig.land_manager'));

        $status = array(config('commanConfig.architect_layout_status.forward'));

        $architectRoles = Role::whereIn('name', $roles)->pluck('id');
        $Architectlogs = ArchitectLayoutStatusLog::with('getRoleName')->where('architect_layout_id', $layout_id)->whereIn('role_id', $architectRoles)->whereIn('status_id', $status)->get();
        //dd($Architectlogs);
        return $Architectlogs;
    }

    public function getLogOfEELayoutApplication($layout_id)
    {
        $roles = array(config('commanConfig.ee_junior_engineer'),config('commanConfig.ee_deputy_engineer'),config('commanConfig.ee_branch_head'));

        $status = array(config('commanConfig.architect_layout_status.forward'),config('commanConfig.architect_layout_status.reverted'));

        $architectRoles = Role::whereIn('name', $roles)->pluck('id');
        $Architectlogs = ArchitectLayoutStatusLog::with('getRoleName')->where('architect_layout_id', $layout_id)->whereIn('role_id', $architectRoles)->whereIn('status_id', $status)->get();
        //dd($Architectlogs);
        return $Architectlogs;
    }

    public function getLogOfReeLayoutApplication($layout_id)
    {
        $roles = array(config('commanConfig.ree_junior'),config('commanConfig.ree_deputy_engineer'),config('commanConfig.ree_assistant_engineer'),config('commanConfig.ree_branch_head'));

        $status = array(config('commanConfig.architect_layout_status.forward'),config('commanConfig.architect_layout_status.reverted'));

        $architectRoles = Role::whereIn('name', $roles)->pluck('id');
        $Architectlogs = ArchitectLayoutStatusLog::with('getRoleName')->where('architect_layout_id', $layout_id)->whereIn('role_id', $architectRoles)->whereIn('status_id', $status)->get();
        //dd($Architectlogs);
        return $Architectlogs;
    }

    public function getLogOfCoLayoutApplication($layout_id)
    {
        $roles = array(config('commanConfig.co_engineer'));

        $status = array(config('commanConfig.architect_layout_status.forward'),config('commanConfig.architect_layout_status.reverted'));

        $architectRoles = Role::whereIn('name', $roles)->pluck('id');
        $Architectlogs = ArchitectLayoutStatusLog::with('getRoleName')->where('architect_layout_id', $layout_id)->whereIn('role_id', $architectRoles)->whereIn('status_id', $status)->get();
        //dd($Architectlogs);
        return $Architectlogs;
    }

    public function getLogOfSapLayoutApplication($layout_id)
    {
        $roles = array(config('commanConfig.senior_architect_planner'));

        $status = array(config('commanConfig.architect_layout_status.forward'),config('commanConfig.architect_layout_status.reverted'));

        $architectRoles = Role::whereIn('name', $roles)->pluck('id');
        $Architectlogs = ArchitectLayoutStatusLog::with('getRoleName')->where('architect_layout_id', $layout_id)->whereIn('role_id', $architectRoles)->whereIn('status_id', $status)->get();
        //dd($Architectlogs);
        return $Architectlogs;
    }
    public function getLogOfCapLayoutApplication($layout_id)
    {
        $roles = array(config('commanConfig.cap_engineer'));

        $status = array(config('commanConfig.architect_layout_status.forward'),config('commanConfig.architect_layout_status.reverted'));

        $architectRoles = Role::whereIn('name', $roles)->pluck('id');
        $Architectlogs = ArchitectLayoutStatusLog::with('getRoleName')->where('architect_layout_id', $layout_id)->whereIn('role_id', $architectRoles)->whereIn('status_id', $status)->get();
        //dd($Architectlogs);
        return $Architectlogs;
    }

    public function getLogOfLALayoutApplication($layout_id)
    {
        $roles = array(config('commanConfig.legal_advisor'));

        $status = array(config('commanConfig.architect_layout_status.forward'));

        $architectRoles = Role::whereIn('name', $roles)->pluck('id');
        $Architectlogs = ArchitectLayoutStatusLog::with('getRoleName')->where('architect_layout_id', $layout_id)->whereIn('role_id', $architectRoles)->whereIn('status_id', $status)->get();
        //dd($Architectlogs);
        return $Architectlogs;
    }

    public function getLogOfVPLayoutApplication($layout_id)
    {
        $roles = array(config('commanConfig.vp_engineer'));

        $status = array(config('commanConfig.architect_layout_status.approved'));

        $architectRoles = Role::whereIn('name', $roles)->pluck('id');
        $Architectlogs = ArchitectLayoutStatusLog::with('getRoleName')->where('architect_layout_id', $layout_id)->whereIn('role_id', $architectRoles)->whereIn('status_id', $status)->get();
        //dd($Architectlogs);
        return $Architectlogs;
    }

    public function getLogsOfEEDepartment($applicationId)
    {

        $roles = array(config('commanConfig.ee_junior_engineer'), config('commanConfig.ee_branch_head'), config('commanConfig.ee_deputy_engineer'), config('commanConfig.society_offer_letter'));

        $status = array(config('commanConfig.applicationStatus.forwarded'), config('commanConfig.applicationStatus.reverted'));

        $eeRoles = Role::whereIn('name', $roles)->pluck('id');
        $EElogs = OlApplicationStatus::with(['getRoleName', 'getRole'])->where('application_id', $applicationId)->whereIn('role_id', $eeRoles)->whereIn('status_id', $status)->get();

        return $EElogs;
    }

    public function getLogsOfDYCEDepartment($applicationId)
    {

        $roles = array(config('commanConfig.dyce_branch_head'), config('commanConfig.dyce_jr_user'), config('commanConfig.dyce_deputy_engineer'));

        $status = array(config('commanConfig.applicationStatus.forwarded'), config('commanConfig.applicationStatus.reverted'));

        $dyceRoles = Role::whereIn('name', $roles)->pluck('id');
        $dycelogs = OlApplicationStatus::with(['getRoleName', 'getRole'])->where('application_id', $applicationId)->whereIn('role_id', $dyceRoles)->whereIn('status_id', $status)->get();

        return $dycelogs;
    }

    public function getLogsOfREEDepartment($applicationId)
    {

        $roles = array(config('commanConfig.ree_junior'), config('commanConfig.ree_branch_head'), config('commanConfig.ree_deputy_engineer'), config('commanConfig.ree_assistant_engineer'));

        $status = array(config('commanConfig.applicationStatus.forwarded'), config('commanConfig.applicationStatus.reverted'));

        $reeRoles = Role::whereIn('name', $roles)->pluck('id');
        $reelogs = OlApplicationStatus::with(['getRoleName', 'getRole'])->where('application_id', $applicationId)->whereIn('role_id', $reeRoles)->whereIn('status_id', $status)->get();

        return $reelogs;
    }

    public function getLogsOfCODepartment($applicationId)
    {

        $roles = config('commanConfig.co_engineer');

        $status = array(config('commanConfig.applicationStatus.forwarded'), config('commanConfig.applicationStatus.reverted'));

        $coRoles = Role::where('name', $roles)->value('id');
        $cologs = OlApplicationStatus::with(['getRoleName', 'getRole'])->where('application_id', $applicationId)->where('role_id', $coRoles)->whereIn('status_id', $status)->get();

        return $cologs;
    }

    public function getLogsOfCAPDepartment($applicationId)
    {

        $roles = config('commanConfig.cap_engineer');

        $status = array(config('commanConfig.applicationStatus.forwarded'), config('commanConfig.applicationStatus.reverted'));

        $capRoles = Role::where('name', $roles)->value('id');
        $caplogs = OlApplicationStatus::with(['getRoleName', 'getRole'])->where('application_id', $applicationId)->where('role_id', $capRoles)->whereIn('status_id', $status)->get();

        return $caplogs;
    }

    public function getLogsOfVPDepartment($applicationId)
    {

        $roles = config('commanConfig.vp_engineer');

        $status = array(config('commanConfig.applicationStatus.forwarded'), config('commanConfig.applicationStatus.reverted'));

        $vpRoles = Role::where('name', $roles)->value('id');
        $vplogs = OlApplicationStatus::with(['getRoleName', 'getRole'])->where('application_id', $applicationId)->where('role_id', $vpRoles)->whereIn('status_id', $status)->get();

        return $vplogs;
    }

    // get all remark and history
    public function getRemarkHistory($applicationId)
    {
        $status = array(config('commanConfig.applicationStatus.forwarded'), config('commanConfig.applicationStatus.reverted'));

        $EElogs = OlApplicationStatus::with(['getRoleName', 'getRole'])->where('application_id', $applicationId)->whereIn('status_id', $status)->orderBy('id','DESC')->get();

        return $EElogs;
    }    

    //check if in layout detail all documents uploaded or not
    public function check_layout_details_complete_status($layout_id)
    {
        $required_details = array();
        $details = ArchitectLayoutDetail::where(['architect_layout_id' => $layout_id])->orderBy('id', 'desc')->with(['cts_plan_details', 'pr_card_details', 'ee_reports', 'em_reports', 'land_reports', 'ree_reports','ArchitectLayoutDetailDpRemark', 'ArchitectLayoutDetailCrzRemark'])->first();
        if ($details) {
            if ($details->latest_layout == "") {
                $required_details[] = "latest layout is required";
            }

            if ($details->old_approved_layout == "") {
                $required_details[] = "old approved layout is required";
            }

            if ($details->last_submitted_layout_for_approval == "") {
                $required_details[] = "last submitted layout for approval is required";
            }

            if ($details->cts_plan == "") {
                $required_details[] = "cts plan is required";
            }

            if ($details->survey_report == "") {
                $required_details[] = "survey report is required";
            }

            if ($details->ArchitectLayoutDetailDpRemark->count()<=0) {
                $required_details[] = "DP remark is required";
            }

            if ($details->ArchitectLayoutDetailCrzRemark->count()<=0) {
                $required_details[] = "CRZ remark is required";
            }
            

            if ($details->ee_reports->count() == 0) {
                $required_details[] = "please upload ee reports";
            }

            if ($details->em_reports->count() == 0) {
                $required_details[] = "please upload em reports";
            }

            if ($details->land_reports->count() == 0) {
                $required_details[] = "please upload land reports";
            }

            if ($details->ree_reports->count() == 0) {
                $required_details[] = "please upload ee reports";
            }

            if ($details->cts_plan_details->count() == 0) {
                $required_details[] = "please upload cts plan details";
            }

            if ($details->pr_card_details->count() == 0) {
                $required_details[] = "please upload pr card details";
            }
        }

        return $required_details;
    }

    public function get_lm_checklist_and_remarks($layout_id, $user_id)
    {
        $latest_architect_layout_detail=ArchitectLayoutDetail::where(['architect_layout_id'=>$layout_id])->orderBy('id','desc')->first();
        $ArchitectLayoutLmScrtinyQuestionMaster = ArchitectLayoutLmScrtinyQuestionMaster::all();
        foreach ($ArchitectLayoutLmScrtinyQuestionMaster as $data) {
            $detail = ArchitectLayoutLmScrtinyQuestionDetail::where(['user_id' => $user_id, 'architect_layout_id' => $layout_id,'architect_layout_detail_id'=>$latest_architect_layout_detail->id, 'architect_layout_lm_scrunity_question_master_id' => $data->id])->first();
            if ($detail) {

            } else {
                $enter_detail = new ArchitectLayoutLmScrtinyQuestionDetail;
                $enter_detail->user_id = $user_id;
                $enter_detail->architect_layout_id = $layout_id;
                $enter_detail->architect_layout_detail_id = $latest_architect_layout_detail->id;
                $enter_detail->architect_layout_lm_scrunity_question_master_id = $data->id;
                $enter_detail->save();
            }
        }

        $final_detail = ArchitectLayoutLmScrtinyQuestionDetail::with(['question'])->where(['user_id' => $user_id, 'architect_layout_id' => $layout_id,'architect_layout_detail_id'=>$latest_architect_layout_detail->id])->get();
        return $final_detail;

    }

    public function get_em_checklist_and_remarks($layout_id, $user_id)
    {
        $latest_architect_layout_detail=ArchitectLayoutDetail::where(['architect_layout_id'=>$layout_id])->orderBy('id','desc')->first();
        $ArchitectLayoutLmScrtinyQuestionMaster = ArchitectLayoutEmScrtinyQuestionMaster::all();
        foreach ($ArchitectLayoutLmScrtinyQuestionMaster as $data) {
            $detail = ArchitectLayoutEmScrtinyQuestionDetail::where(['user_id' => $user_id, 'architect_layout_id' => $layout_id,'architect_layout_detail_id'=>$latest_architect_layout_detail->id, 'architect_layout_em_scrunity_question_master_id' => $data->id])->first();
            if ($detail) {

            } else {
                $enter_detail = new ArchitectLayoutEmScrtinyQuestionDetail;
                $enter_detail->user_id = $user_id;
                $enter_detail->architect_layout_id = $layout_id;
                $enter_detail->architect_layout_detail_id = $latest_architect_layout_detail->id;
                $enter_detail->architect_layout_em_scrunity_question_master_id = $data->id;
                $enter_detail->save();
            }
        }

        $final_detail = ArchitectLayoutEmScrtinyQuestionDetail::with(['question'])->where(['user_id' => $user_id, 'architect_layout_id' => $layout_id,'architect_layout_detail_id'=>$latest_architect_layout_detail->id])->get();
        return $final_detail;

    }

    public function get_ee_checklist_and_remarks($layout_id, $user_id)
    {
        $latest_architect_layout_detail=ArchitectLayoutDetail::where(['architect_layout_id'=>$layout_id])->orderBy('id','desc')->first();
        $ArchitectLayoutLmScrtinyQuestionMaster = ArchitectLayoutEEScrtinyQuestionMaster::all();
        foreach ($ArchitectLayoutLmScrtinyQuestionMaster as $data) {
            //$detail = ArchitectLayoutEEScrtinyQuestionDetail::where(['user_id' => $user_id, 'architect_layout_id' => $layout_id, 'architect_layout_ee_scrunity_question_master_id' => $data->id])->first();
            $detail = ArchitectLayoutEEScrtinyQuestionDetail::where(['architect_layout_id' => $layout_id, 'architect_layout_detail_id'=>$latest_architect_layout_detail->id,'architect_layout_ee_scrunity_question_master_id' => $data->id])->first();
            if ($detail) {

            } else {
                $enter_detail = new ArchitectLayoutEEScrtinyQuestionDetail;
                $enter_detail->user_id = $user_id;
                $enter_detail->architect_layout_id = $layout_id;
                $enter_detail->architect_layout_detail_id = $latest_architect_layout_detail->id;
                $enter_detail->architect_layout_ee_scrunity_question_master_id = $data->id;
                $enter_detail->save();
            }
        }

        $final_detail = ArchitectLayoutEEScrtinyQuestionDetail::with(['question'])->where(['architect_layout_id' => $layout_id,'architect_layout_detail_id'=>$latest_architect_layout_detail->id])->get();
        return $final_detail;

    }

    public function get_ree_checklist_and_remarks($layout_id, $user_id)
    {
        $latest_architect_layout_detail=ArchitectLayoutDetail::where(['architect_layout_id'=>$layout_id])->orderBy('id','desc')->first();
        $ArchitectLayoutLmScrtinyQuestionMaster = ArchitectLayoutReeScrtinyQuestionMaster::all();
        foreach ($ArchitectLayoutLmScrtinyQuestionMaster as $data) {
            $detail = ArchitectLayoutReeScrtinyQuestionDetail::where(['architect_layout_id' => $layout_id,'architect_layout_detail_id'=>$latest_architect_layout_detail->id, 'architect_layout_ree_scrunity_question_master_id' => $data->id])->first();
            if ($detail) {

            } else {
                $enter_detail = new ArchitectLayoutReeScrtinyQuestionDetail;
                $enter_detail->user_id = $user_id;
                $enter_detail->architect_layout_id = $layout_id;
                $enter_detail->architect_layout_detail_id = $latest_architect_layout_detail->id;
                $enter_detail->architect_layout_ree_scrunity_question_master_id = $data->id;
                $enter_detail->save();
            }
        }

        $final_detail = ArchitectLayoutReeScrtinyQuestionDetail::with(['question'])->where(['architect_layout_id' => $layout_id,'architect_layout_detail_id'=>$latest_architect_layout_detail->id])->get();
        return $final_detail;

    }

    /**
     * Common function for displaying form fields in frontend.
     * Author: Amar Prajapati
     * @param $name, $type, $select_arr, $select_arr_key, $value, $readonly
     * @return \Illuminate\Http\Response
     */
    public function form_fields($name, $type, $select_arr = NULL, $selected_arr_key = NULL, $value = NULL, $readonly = NULL, $required = NULL){

        if($type == 'select'){
            foreach($select_arr as $select_arr_key => $select_arr_value){
                if($value == $select_arr_value->id){
                    $selected = 'selected';
                }else{
                    $selected = '';
                }
                $select_arr .= '<option value="'.$select_arr_value->id.'"'.$selected.'>'.$select_arr_value->$selected_arr_key.'</option>';
            }
            $fields = array(
                'select' => '<select data-live-search="true" class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input" id="'.$name.'" name="'.$name.'" required>'.$select_arr.'</select>',
            );
        }else{
            $fields = array(
                'text' => '<input type="text" id="'.$name.'" name="'.$name.'" class="form-control form-control--custom m-input" value="'.$value.'" '.$readonly.' '.$required.'>',
                'password' => '<input type="password" id="'.$name.'" name="'.$name.'" class="form-control form-control--custom m-input" value="'.$value.'" '.$readonly.' '.$required.'>',
                'hidden' => '<input type="hidden" id="'.$name.'" name="'.$name.'" class="form-control form-control--custom m-input" value="'.$value.'" '.$readonly.' '.$required.'>',
                'date' => '<input type="text" id="'.$name.'" name="'.$name.'" class="form-control form-control--custom m-input m_datepicker" value="'.$value.'" '.$readonly.' '.$required.'>',
                'textarea' => '<textarea id="'.$name.'" name="'.$name.'" class="form-control form-control--custom form-control--fixed-height m-input"'.$readonly.' '.$required.'>'.$value.'</textarea>',
                'file' => '<div class="custom-file">
                            <input class="custom-file-input pdfcheck" name="'.$name.'" type="file"
                                   id="'.$name.'" required="required">
                            <label class="custom-file-label" for="'.$name.'">Choose
                                file...</label>
                            <span class="text-danger" id="'.$name.'"></span>
                        </div>',
            );
        }

        return $fields[$type];
    }

    /**
     * Updates status of society conveyance application.
     * Author: Amar Prajapati
     * @param $insert_arr, $status, $sc_application, $status_new
     * @return \Illuminate\Http\Response
     */
    public function sc_application_status_society($insert_arr, $status, $sc_application, $status_new = NULL){
        $status_in_words = array_flip(config('commanConfig.conveyance_status'))[$status];
        $sc_application_last_id = $sc_application->id;
        $sc_application_master_id = $sc_application->sc_application_master_id;

        foreach($insert_arr['users'] as $key => $user){
            $i = 0;
            $insert_application_log[$status_in_words][$key]['application_id'] = $sc_application_last_id;
            $insert_application_log[$status_in_words][$key]['application_master_id'] = $sc_application_master_id;
            $insert_application_log[$status_in_words][$key]['society_flag'] = 1;
            $insert_application_log[$status_in_words][$key]['user_id'] = Auth::user()->id;
            $insert_application_log[$status_in_words][$key]['role_id'] = Auth::user()->role_id;
            $insert_application_log[$status_in_words][$key]['status_id'] = $status;
            $insert_application_log[$status_in_words][$key]['to_user_id'] = $user->id;
            $insert_application_log[$status_in_words][$key]['to_role_id'] = $user->role_id;
            $insert_application_log[$status_in_words][$key]['remark'] = '';
            $insert_application_log[$status_in_words][$key]['is_active'] = 1;
            $insert_application_log[$status_in_words][$key]['created_at'] =date('Y-m-d');
            $application_log_status = $insert_application_log[$status_in_words];

            if($status == 2){
                $status_in_words_1 = array_flip(config('commanConfig.conveyance_status'))[1];
                $insert_application_log[$status_in_words_1][$key]['application_id'] = $sc_application_last_id;
                $insert_application_log[$status_in_words_1][$key]['application_master_id'] = $sc_application_master_id;
                $insert_application_log[$status_in_words_1][$key]['society_flag'] = 0;
                $insert_application_log[$status_in_words_1][$key]['user_id'] = $user->id;
                $insert_application_log[$status_in_words_1][$key]['role_id'] = $user->role_id;
                $insert_application_log[$status_in_words_1][$key]['status_id'] = ($status_new != null) ? $status_new : config('commanConfig.conveyance_status.in_process');
                $insert_application_log[$status_in_words_1][$key]['to_user_id'] = 0;
                $insert_application_log[$status_in_words_1][$key]['to_role_id'] = 0;
                $insert_application_log[$status_in_words_1][$key]['remark'] = '';
                $insert_application_log[$status_in_words_1][$key]['is_active'] = 1;
                $insert_application_log[$status_in_words_1][$key]['created_at'] =date('Y-m-d');
                $application_log_status = array_merge($insert_application_log[$status_in_words], $insert_application_log[$status_in_words_1]);
            }
            $i++;
        }

        $inserted_application_log = scApplicationLog::insert($application_log_status);

        return $inserted_application_log;
    }

    /**
     * Updates status of society renewal application.
     * Author: Amar Prajapati
     * @param $insert_arr, $status, $sc_application
     * @return \Illuminate\Http\Response
     */
    public function sr_application_status_society($insert_arr, $status, $sc_application, $status_new = NULL){
        $status_in_words = array_flip(config('commanConfig.renewal_status'))[$status];
        $sc_application_last_id = $sc_application->id;
        $sc_application_master_id = $sc_application->application_master_id;
        foreach($insert_arr['users'] as $key => $user){
            $i = 0;
            $insert_application_log[$status_in_words][$key]['application_id'] = $sc_application_last_id;
            $insert_application_log[$status_in_words][$key]['application_master_id'] = $sc_application_master_id;
            $insert_application_log[$status_in_words][$key]['society_flag'] = 1;
            $insert_application_log[$status_in_words][$key]['user_id'] = Auth::user()->id;
            $insert_application_log[$status_in_words][$key]['role_id'] = Auth::user()->role_id;
            $insert_application_log[$status_in_words][$key]['status_id'] = $status;
            $insert_application_log[$status_in_words][$key]['to_user_id'] = $user->id;
            $insert_application_log[$status_in_words][$key]['to_role_id'] = $user->role_id;
            $insert_application_log[$status_in_words][$key]['is_active'] = 1;
            $insert_application_log[$status_in_words][$key]['remark'] = '';
            $insert_application_log[$status_in_words][$key]['created_at'] = date('Y-m-d');
            $application_log_status = $insert_application_log[$status_in_words];

            if($status == config('commanConfig.conveyance_status.forwarded')){
                $status_in_words_1 = array_flip(config('commanConfig.applicationStatus'))[1];
                $insert_application_log[$status_in_words_1][$key]['application_id'] = $sc_application_last_id;
                $insert_application_log[$status_in_words_1][$key]['application_master_id'] = $sc_application_master_id;
                $insert_application_log[$status_in_words_1][$key]['society_flag'] = 0;
                $insert_application_log[$status_in_words_1][$key]['user_id'] = $user->id;
                $insert_application_log[$status_in_words_1][$key]['role_id'] = $user->role_id;
                $insert_application_log[$status_in_words_1][$key]['status_id'] = ($status_new != null) ? $status_new : config('commanConfig.renewal_status.in_process');
                $insert_application_log[$status_in_words_1][$key]['to_user_id'] = 0;
                $insert_application_log[$status_in_words_1][$key]['to_role_id'] = 0;
                $insert_application_log[$status_in_words_1][$key]['is_active'] = 1;
                $insert_application_log[$status_in_words_1][$key]['remark'] = '';
                $insert_application_log[$status_in_words_1][$key]['created_at'] = date('Y-m-d');
                $application_log_status = array_merge($insert_application_log[$status_in_words], $insert_application_log[$status_in_words_1]);
            }
            $i++;
        }

        $inserted_application_log = RenewalApplicationLog::insert($application_log_status);
        return $inserted_application_log;
    }

    /**
     * Updates status of society formation application.
     * Author: Sudesh Jadhav
     * @param $insert_arr, $status, $sc_application
     * @return \Illuminate\Http\Response
     */
    public function sf_application_status_society($insert_arr, $status, $sc_application){
        $status_in_words = array_flip(config('commanConfig.formation_status'))[$status];
        $sc_application_last_id = $sc_application->id;
        $sc_application_master_id = $sc_application->sc_application_master_id;
        foreach($insert_arr['users'] as $key => $user){
            $i = 0;
            $insert_application_log[$status_in_words][$key]['application_id'] = $sc_application_last_id;
            $insert_application_log[$status_in_words][$key]['application_master_id'] = $sc_application_master_id;
            $insert_application_log[$status_in_words][$key]['society_flag'] = 1;
            $insert_application_log[$status_in_words][$key]['user_id'] = Auth::user()->id;
            $insert_application_log[$status_in_words][$key]['role_id'] = Auth::user()->role_id;
            $insert_application_log[$status_in_words][$key]['status_id'] = $status;
            $insert_application_log[$status_in_words][$key]['to_user_id'] = $user->id;
            $insert_application_log[$status_in_words][$key]['to_role_id'] = $user->role_id;
            $insert_application_log[$status_in_words][$key]['remark'] = '';
            $insert_application_log[$status_in_words][$key]['created_at'] = date('Y-m-d');
            $application_log_status = $insert_application_log[$status_in_words];

            if($status == config('commanConfig.formation_status.forwarded')){
                $status_in_words_1 = array_flip(config('commanConfig.formation_status'))[1];
                $insert_application_log[$status_in_words_1][$key]['application_id'] = $sc_application_last_id;
                $insert_application_log[$status_in_words_1][$key]['application_master_id'] = $sc_application_master_id;
                $insert_application_log[$status_in_words_1][$key]['society_flag'] = 0;
                $insert_application_log[$status_in_words_1][$key]['user_id'] = $user->id;
                $insert_application_log[$status_in_words_1][$key]['role_id'] = $user->role_id;
                $insert_application_log[$status_in_words_1][$key]['status_id'] = config('commanConfig.formation_status.in_process');
                $insert_application_log[$status_in_words_1][$key]['to_user_id'] = 0;
                $insert_application_log[$status_in_words_1][$key]['to_role_id'] = 0;
                $insert_application_log[$status_in_words_1][$key]['remark'] = '';
                $insert_application_log[$status_in_words_1][$key]['created_at'] = date('Y-m-d');
                $insert_application_log[$status_in_words_1][$key]['open']=1;
                $insert_application_log[$status_in_words_1][$key]['current_status']=1;
                $application_log_status = array_merge($insert_application_log[$status_in_words], $insert_application_log[$status_in_words_1]);
            }
            $i++;
        }
        DB::transaction(function () use($sc_application_last_id,$application_log_status){
        foreach($application_log_status as $application_log_statu)
        {
            SfApplicationStatusLog::where(['application_id'=>$sc_application_last_id,'open'=>1])->update(['open'=>0]);
            SfApplicationStatusLog::where(['application_id'=>$sc_application_last_id,'current_status'=>1,'user_id'=>$application_log_statu['user_id']])->update(['current_status'=>0]);
            $inserted_application_log = SfApplicationStatusLog::insert([$application_log_statu]);
        }
        });
       // return $inserted_application_log;
    }

    /**
     * Updates status of society tripartite application.
     * Author: Amar Prajapati
     * @param $insert_arr, $status, $sc_application, $status_new
     * @return \Illuminate\Http\Response
     */
    public function tripartite_application_status_society($insert_arr, $status, $sc_application, $status_new = NULL){
        $status_in_words = array_flip(config('commanConfig.applicationStatus'))[$status];
        $sc_application_last_id = $sc_application->id;
        $sc_application_master_id = $sc_application->application_master_id;

        foreach($insert_arr['users'] as $key => $user){
            $i = 0;
            $insert_application_log[$status_in_words][$key]['application_id'] = $sc_application_last_id;
            $insert_application_log[$status_in_words][$key]['society_flag'] = 1;
            $insert_application_log[$status_in_words][$key]['user_id'] = Auth::user()->id;
            $insert_application_log[$status_in_words][$key]['role_id'] = Auth::user()->role_id;
            $insert_application_log[$status_in_words][$key]['status_id'] = $status;
            $insert_application_log[$status_in_words][$key]['to_user_id'] = $user->id;
            $insert_application_log[$status_in_words][$key]['to_role_id'] = $user->role_id;
            $insert_application_log[$status_in_words][$key]['remark'] = '';
            $insert_application_log[$status_in_words][$key]['is_active'] = 1;
            $insert_application_log[$status_in_words][$key]['phase'] = ($sc_application->current_status_id == config('commanConfig.applicationStatus.approved_tripartite_agreement') || $sc_application->current_status_id == config('commanConfig.applicationStatus.draft_tripartite_agreement'))? 1 : 0 ;
            $insert_application_log[$status_in_words][$key]['created_at'] = date('Y-m-d');
            $application_log_status = $insert_application_log[$status_in_words];

            if($status == 2){
                $status_in_words_1 = array_flip(config('commanConfig.conveyance_status'))[1];
                $insert_application_log[$status_in_words_1][$key]['application_id'] = $sc_application_last_id;
                $insert_application_log[$status_in_words_1][$key]['society_flag'] = 0;
                $insert_application_log[$status_in_words_1][$key]['user_id'] = $user->id;
                $insert_application_log[$status_in_words_1][$key]['role_id'] = $user->role_id;
                $insert_application_log[$status_in_words_1][$key]['status_id'] = ($status_new != null) ? $status_new : config('commanConfig.conveyance_status.in_process');
                $insert_application_log[$status_in_words_1][$key]['to_user_id'] = 0;
                $insert_application_log[$status_in_words_1][$key]['to_role_id'] = 0;
                $insert_application_log[$status_in_words_1][$key]['remark'] = '';
                $insert_application_log[$status_in_words_1][$key]['is_active'] = 1;
                $insert_application_log[$status_in_words_1][$key]['phase'] = ($sc_application->current_status_id == config('commanConfig.applicationStatus.approved_tripartite_agreement') || $sc_application->current_status_id == config('commanConfig.applicationStatus.draft_tripartite_agreement'))? 1 : 0 ;
                $insert_application_log[$status_in_words_1][$key]['created_at'] = date('Y-m-d');
                $application_log_status = array_merge($insert_application_log[$status_in_words], $insert_application_log[$status_in_words_1]);
            }
            $i++;
        }

        $inserted_application_log = OlApplicationStatus::insert($application_log_status);
        return $inserted_application_log;
    }


    // Reval society-REE documents
    public function getRevalSocietyREEDocuments($applicationId)
    {

        $application_details = OlApplication::where('id', $applicationId)->get();
       $documnts_ids = OlSocietyDocumentsMaster::where('application_id' ,'=' ,$application_details[0]->application_master_id)->pluck('id')->toArray();

        $societyDocuments = SocietyOfferLetter::with(['societyRevalDocuments' => function($q) use($documnts_ids) {
            $q->whereIn('document_id', $documnts_ids);
        }])->where('id', $application_details[0]->society_id)->get();

        return $societyDocuments;
    }


    /**
     * Show the offer letter dashboard.
     *
     * Author: Prajakta Sisale.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        $role_id = session()->get('role_id');
        $user_id = Auth::id();

        // conveyance dashboard
        $conveyanceCommonController = new conveyanceCommonController();
        $conveyanceDashboard = $conveyanceCommonController->ConveyanceDashboard();
        $conveyanceRoles     = $conveyanceCommonController->getConveyanceRoles();
        $pendingApplications = $conveyanceCommonController->getApplicationPendingAtDepartment();

        $renewal = new renewalCommonController();

        $renewalDashboard = $renewal->RenewalDashboard();
        $renewalRoles     = $renewal->getRenewalRoles();
        $renewalPendingApplications = $renewal->getApplicationPendingAtDepartment();         

        $applicationData = $this->getApplicationData($role_id,$user_id);

        // Reval APplication data

        $revalApplicationData = $this->getRevalApplicationData($role_id,$user_id);

        $statusCount = $this->getApplicationStatusCount($applicationData);

        // Reval status Count
        $revalStatusCount = $this->getApplicationStatusCount($revalApplicationData);

        // EE Roles
        $ee = $this->getEERoles();

        // DYCE Roles
        $dyce = $this->getDyceRoles();

        // CAP
        $cap = Role::where('name',config('commanConfig.cap_engineer'))->value('id');

        // VP
        $vp = Role::where('name',config('commanConfig.vp_engineer'))->value('id');

        $dashboardData = [];


        if(in_array($role_id ,$ee))
            $dashboardData = $this->getEEDashboardData($role_id,$ee,$statusCount);


        if(in_array($role_id ,$dyce))
            $dashboardData = $this->getDyceDashboardData($role_id,$dyce,$statusCount);

        if($cap == $role_id){
            $dashboardData = $this->getCapDashboardData($statusCount);
            $revalDashboardData = $this->getCapDashboardData($revalStatusCount);
        }

        if($vp == $role_id){
            $dashboardData = $this->getVpDashboardData($statusCount);
            $revalDashboardData = $this->getVpDashboardData($revalStatusCount);
        }

        $dashboardData1 = NULL;
        $eeHeadId = Role::where('name',config('commanConfig.ee_branch_head'))->value('id');

        $dyceHeadId = Role::where('name',config('commanConfig.dyce_branch_head'))->value('id');

        if($role_id == $eeHeadId){
            $dashboardData1 = $this->getToatalPendingApplicationsAtUser($ee);
        }
        if($role_id == $dyceHeadId){
            $dashboardData1 = $this->getToatalPendingApplicationsAtUser($dyce);
        }

        return view('admin.common.ol_dashboard',compact('dashboardData','revalDashboardData','dashboardData1','conveyanceDashboard','conveyanceRoles','pendingApplications','renewalDashboard','renewalRoles','renewalPendingApplications'));

    }

    /**
     * Show the offer letter dashboard using ajax.
     *
     * Author: Prajakta Sisale.
     *
     *  @return json response
     */
    public function ajaxDashboard(Request $request)
    {
        if ($request->ajax()) {

            $role_id = session()->get('role_id');
            $user_id = Auth::id();

            // EE Roles
            $ee = $this->getEERoles();

            // DYCE Roles
            $dyce = $this->getDyceRoles();

            // CAP
            $cap = Role::where('name', config('commanConfig.cap_engineer'))->value('id');

            // VP
            $vp = Role::where('name', config('commanConfig.vp_engineer'))->value('id');

            if ($request->module_name == "Offer Letter") {
                $applicationData = $this->getApplicationData($role_id, $user_id);

                $statusCount = $this->getApplicationStatusCount($applicationData);

                $dashboardData = [];

                if (in_array($role_id, $ee))
                    $dashboardData = $this->getEEDashboardData($role_id, $ee, $statusCount);

                if (in_array($role_id, $dyce))
                    $dashboardData = $this->getDyceDashboardData($role_id, $dyce, $statusCount);

                if ($cap == $role_id) {
                    $dashboardData = $this->getCapDashboardData($statusCount);
//                    $revalDashboardData = $this->getCapDashboardData($revalStatusCount);
                }

                if ($vp == $role_id) {
                    $dashboardData = $this->getVpDashboardData($statusCount);
//                    $revalDashboardData = $this->getVpDashboardData($revalStatusCount);
                }

                return $dashboardData;

            }


            if ($request->module_name == "Offer Letter Subordinate Pendency") {

                $dashboardData = NULL;
                $eeHeadId = Role::where('name', config('commanConfig.ee_branch_head'))->value('id');

                $dyceHeadId = Role::where('name', config('commanConfig.dyce_branch_head'))->value('id');

                if ($role_id == $eeHeadId) {
                    $dashboardData = $this->getToatalPendingApplicationsAtUser($ee);
                }
                if ($role_id == $dyceHeadId) {
                    $dashboardData = $this->getToatalPendingApplicationsAtUser($dyce);
                }

                return $dashboardData;
            }

            if ($request->module_name == "Society Conveyance") {
                $conveyanceCommonController = new conveyanceCommonController();
                $conveyanceDashboard = $conveyanceCommonController->ConveyanceDashboard();
                return $conveyanceDashboard;
            }

            if ($request->module_name == "Society Renewal") {
                $renewal = new renewalCommonController();
                $renewalDashboard = $renewal->RenewalDashboard();
                return $renewalDashboard;
            }

            if ($request->module_name == "Offer Letter Revalidation") {
                $revalApplicationData = $this->getRevalApplicationData($role_id, $user_id);

                $revalStatusCount = $this->getApplicationStatusCount($revalApplicationData);

                if ($cap == $role_id) {
                    $revalDashboardData = $this->getCapDashboardData($revalStatusCount);
                }

                if ($vp == $role_id) {
                    $revalDashboardData = $this->getVpDashboardData($revalStatusCount);
                }
                return $revalDashboardData;
            }

            if ($request->module_name == "Revision in Layout") {

                $data = array();
                $this->architect_dashboard = new ArchitectLayoutDashboardController();

                if (in_array(session()->get('role_name'), array(config('commanConfig.ee_junior_engineer'), config('commanConfig.ee_deputy_engineer'), config('commanConfig.ee_branch_head')))) {
                    $data['Total Number of Applications'] = $this->architect_dashboard->total_no_of_appln_for_revision();
                    $data['Application Pending'] = $this->architect_dashboard->pending_layout_before_layout_and_excel();
                    $data['Application Forwarded'] = $this->architect_dashboard->forwarded_layout_before_layout_and_excel();

                    return $data;
                    //                    if(session()->get('role_name')==config('commanConfig.ee_branch_head'))
//                    {
//                        $data['jr_ee_pending'] = $this->architect_dashboard->ee_pending_at_role(config('commanConfig.ee_junior_engineer'));
//                        $data['dy_ee_pending'] = $this->architect_dashboard->ee_pending_at_role(config('commanConfig.ee_deputy_engineer'));
//                        $data['head_ee_pending'] = $this->architect_dashboard->ee_pending_at_role(config('commanConfig.ee_branch_head'));
//                    }
                }


//                if (in_array(session()->get('role_name'), array(config('commanConfig.co_engineer')))) {
//                    $data['total_no_of_layout'] = $this->architect_dashboard->total_number_of_layouts();
//                    $data['layout_in_process'] = $this->architect_dashboard->total_no_of_appln_for_revision_and_approval();
//                    $data['approved_by_vp'] = $this->architect_dashboard->approved_layouts();
//                    $data['total_no_of_appln_for_revision'] = $this->architect_dashboard->total_no_of_appln_for_revision();
//                    $data['pending_at_current_user'] = $this->architect_dashboard->pending_layout_before_layout_and_excel(1);
//                    $data['sent_to_ee'] = $this->architect_dashboard->sent_to_ee();
//                    $data['sent_to_ree'] = $this->architect_dashboard->sent_to_ree();
//                    $data['sent_to_lm'] = $this->architect_dashboard->sent_to_lm();
//                    $data['sent_to_em'] = $this->architect_dashboard->sent_to_em();
//                    $data['approved_layouts'] = $this->architect_dashboard->approved_layouts();
//                    $data['appln_sent_for_arroval'] = $this->architect_dashboard->appln_sent_for_arroval();
//                    $data['pending_at_ree'] = $this->architect_dashboard->pending_at_ree();
//                    $data['pending_at_co'] = $this->architect_dashboard->pending_at_co();
//                    $data['pending_at_cap'] = $this->architect_dashboard->pending_at_cap();
//                    $data['pending_at_sap'] = $this->architect_dashboard->pending_at_sap();
//                    $data['pending_at_la'] = $this->architect_dashboard->pending_at_la();
//                    $data['pending_at_vp'] = $this->architect_dashboard->pending_at_vp();
//                }


                if (in_array(session()->get('role_name'), array(config('commanConfig.vp_engineer')))) {
                    $data['Total Number of Layouts'] = $this->architect_dashboard->total_number_of_layouts();
                    $data['Layouts in Process'] = $this->architect_dashboard->total_no_of_appln_for_revision_and_approval();
                    $data['Layouts Approved by VP'] = $this->architect_dashboard->approved_layouts();
                    return $data;
                }

            }

            if ($request->module_name == "Layout Approval") {
                $this->architect_dashboard = new ArchitectLayoutDashboardController();

                if (session()->get('role_name') == config('commanConfig.ee_branch_head')) {
                    $ee_jr = $this->architect_dashboard->ee_pending_at_role(config('commanConfig.ee_junior_engineer'));
                    $ee_dy = $this->architect_dashboard->ee_pending_at_role(config('commanConfig.ee_deputy_engineer'));
                    $ee_head = $this->architect_dashboard->ee_pending_at_role(config('commanConfig.ee_branch_head'));

                    $data['Total Number of Applications'] = $ee_jr + $ee_dy + $ee_head;
                    $data['Pending at JE / SE'] = $ee_jr;
                    $data['Pending at  Deputy Engineer'] = $ee_dy;
                    $data['Pending at EE'] = $ee_head;
                    return $data;
                }

                if (in_array(session()->get('role_name'), array(config('commanConfig.vp_engineer')))){
                    $data['Total No of Layout for Approval'] = $this->architect_dashboard->appln_sent_for_arroval();;
                    $data['Application Pending'] = $this->architect_dashboard->pending_layout_before_layout_and_excel(1);
                    $data['Application Approved & Sent to Architect'] = $this->architect_dashboard->vp_approved_and_forwarded_layout();
                    $data['Application Sent Back to CAP'] = $this->architect_dashboard->reverted_layout_before_layout_and_excel(1);
                    return $data;
                }

                if (in_array(session()->get('role_name'), array(config('commanConfig.cap_engineer')))) {
                    $data['Total Number of Applications'] = $this->architect_dashboard->appln_sent_for_arroval();;
                    $data['Applications Pending'] = $this->architect_dashboard->pending_layout_before_layout_and_excel(1);
                    $data['Applications Forwarded'] = $this->architect_dashboard->forwarded_layout_before_layout_and_excel(1);
                    $data['Applications Reverted'] = $this->architect_dashboard->reverted_layout_before_layout_and_excel(1);
                    return $data;
                }
            }
        }
    }


    /*
     * Function for getting application's data.

     * Author :Prajakta Sisale.
     *
     * @param $role_id,$user_id
     *
     * @return array
     */
    public function getApplicationData($role_id,$user_id){

        $new_offer_letter_master_ids = config('commanConfig.new_offer_letter_master_ids');

        $applicationData = OlApplication::with([
            'olApplicationStatus' => function ($q) use ($role_id,$user_id) {
                $q->where('user_id', $user_id)
                    ->where('role_id', $role_id)
                    ->where('society_flag', 0)
                    ->where('is_active',1)
                    ->orderBy('id', 'desc');
            }])
            ->whereHas('olApplicationStatus', function ($q) use ($role_id,$user_id) {
                $q->where('user_id', $user_id)
                    ->where('role_id', $role_id)
                    ->where('society_flag', 0)
                    ->where('is_active',1)
                    ->orderBy('id', 'desc');
            })->whereIn('application_master_id',$new_offer_letter_master_ids)->get()->toArray();

        return $applicationData;
    }


    /*
     * Function for getting application's data.

     * Author :Prajakta Sisale.
     *
     * @param $role_id,$user_id
     *
     * @return array
     */
    public function getRevalApplicationData($role_id,$user_id){

        $reval_application_type_ids= config('commanConfig.revalidation_master_ids');

        $applicationData = OlApplication::with([
            'olApplicationStatus' => function ($q) use ($role_id,$user_id) {
                $q->where('user_id', $user_id)
                    ->where('role_id', $role_id)
                    ->where('society_flag', 0)
                    ->where('is_active',1)
                    ->orderBy('id', 'desc');
            }])
            ->whereHas('olApplicationStatus', function ($q) use ($role_id,$user_id) {
                $q->where('user_id', $user_id)
                    ->where('role_id', $role_id)
                    ->where('society_flag', 0)
                    ->where('is_active',1)
                    ->orderBy('id', 'desc');
            })->whereIn('application_master_id',$reval_application_type_ids)->get()->toArray();

        return $applicationData;
    }

    /*
     * Function for getting application's status counts.

     * Author :Prajakta Sisale.
     *
     * @param $applicationData
     *
     * @return array
     */
    public function getApplicationStatusCount($applicationData){

        $totalForwarded = $totalReverted = $totalPending = $totalInProcess = 0 ;

        foreach ($applicationData as $application){

//            dd($application['ol_application_status'][0]['status_id']);
            $status = $application['ol_application_status'][0]['status_id'];
//            print_r($status);
//            echo '=====';
            switch ( $status )
            {
                case config('commanConfig.applicationStatus.in_process'): $totalPending += 1; break;
                case config('commanConfig.applicationStatus.forwarded'): $totalForwarded += 1; break;
                case config('commanConfig.applicationStatus.reverted'): $totalReverted += 1 ; break;
                default:
                    ; break;
            }
        }
//        dd($totalForwarded);
        $totalApplication = count($applicationData);

        $count = ['totalPending' => $totalPending,
                  'totalForwarded' => $totalForwarded,
                  'totalReverted' => $totalReverted,
                  'totalApplication' => $totalApplication
        ];
        return $count;

    }

    /*
     * Function for getting EE roles.
     *
     * Author :Prajakta Sisale.
     *
     * @return array
     */
    public function getEERoles(){
//        $ee_jr_id = Role::where('name',config('commanConfig.ee_junior_engineer'))->value('id');
//        $ee_head_id = Role::where('name',config('commanConfig.ee_branch_head'))->value('id');
//        $ee_deputy_id = Role::where('name', config('commanConfig.ee_deputy_engineer'))->value('id');
//        $ee = ['ee_jr_id'=>$ee_jr_id,
//            'ee_head_id'=>$ee_head_id,
//            'ee_deputy_id'=>$ee_deputy_id];
//        return $ee;
        $roles = array(config('commanConfig.ee_junior_engineer'),config('commanConfig.ee_deputy_engineer'),config('commanConfig.ee_branch_head'));
        return Role::whereIn('name', $roles)->pluck('id','name')->toArray();
    }

    /*
    * Function for getting DYCE roles.
    *
    * Author :Prajakta Sisale.
    *
    * @return array
    */
    public function getDyceRoles(){
        $roles = array(config('commanConfig.dyce_jr_user'),config('commanConfig.dyce_branch_head'),config('commanConfig.dyce_deputy_engineer'));
        return Role::whereIn('name', $roles)->pluck('id','name')->toArray();
//        $dyce_jr_id = Role::where('name',config('commanConfig.dyce_jr_user'))->value('id');
//        $dyce_head_id = Role::where('name',config('commanConfig.dyce_branch_head'))->value('id');
//        $dyce_deputy_id = Role::where('name', config('commanConfig.dyce_deputy_engineer'))->value('id');
//        $dyce = ['dyce_jr_id' => $dyce_jr_id,
//                 'dyce_head_id' => $dyce_head_id,
//                 'dyce_deputy_id' => $dyce_deputy_id];
//        return $dyce;
    }

    /*
    * Function for getting EE dashboard data.
    *
    * @param $role_id,$ee,$statusCount
    *
    * Author :Prajakta Sisale.
    *
    * @return array
    */
    public function getEEDashboardData($role_id,$ee,$statusCount)
    {
//        dd($ee);
        switch ($role_id) {
            case ($ee['ee_junior_engineer']):
                $dashboardData['Total Number of Applications'][0] = $statusCount['totalApplication'];
                $dashboardData['Total Number of Applications'][1] = '';
                $dashboardData['Applications Pending'][0] = $statusCount['totalPending'];
                $dashboardData['Applications Pending'][1] = '?submitted_at_from=&submitted_at_to=&update_status='.config('commanConfig.applicationStatus.in_process');
                $dashboardData['Applications Forwarded to EE Deputy'][0] = $statusCount['totalForwarded'];
                $dashboardData['Applications Forwarded to EE Deputy'][1] = '?submitted_at_from=&submitted_at_to=&update_status='.config('commanConfig.applicationStatus.forwarded');
//                $dashboardData['Application Pending'] = '?submitted_at_from=&submitted_at_to=&update_status=4';
                break;
            case ($ee['ee_engineer']):
                $dashboardData['Total Number of Applications'][0] = $statusCount['totalApplication'];
                $dashboardData['Total Number of Applications'][1] = '';
                $dashboardData['Applications Pending'][0] = $statusCount['totalPending'];
                $dashboardData['Applications Pending'][1] = '?submitted_at_from=&submitted_at_to=&update_status='.config('commanConfig.applicationStatus.in_process');
                $dashboardData['Applications Sent for Compliance'][0] = $statusCount['totalReverted'];
                $dashboardData['Applications Sent for Compliance'][1] = '?submitted_at_from=&submitted_at_to=&update_status='.config('commanConfig.applicationStatus.reverted');
                $dashboardData['Applications Forwarded to DyCE Junior'][0] = $statusCount['totalForwarded'];
                $dashboardData['Applications Forwarded to DyCE Junior'][1] = '?submitted_at_from=&submitted_at_to=&update_status='.config('commanConfig.applicationStatus.forwarded');
                break;
            case ($ee['ee_dy_engineer']):
                $dashboardData['Total Number of Applications'][0] = $statusCount['totalApplication'];
                $dashboardData['Total Number of Applications'][1] = '';
                $dashboardData['Applications Pending'][0] = $statusCount['totalPending'];
                $dashboardData['Applications Pending'][1] = '?submitted_at_from=&submitted_at_to=&update_status='.config('commanConfig.applicationStatus.in_process');
                $dashboardData['Applications Sent for Compliance'][0] = $statusCount['totalReverted'];
                $dashboardData['Applications Sent for Compliance'][1] = '?submitted_at_from=&submitted_at_to=&update_status='.config('commanConfig.applicationStatus.reverted');
                $dashboardData['Applications Forwarded to EE Head'][0] = $statusCount['totalForwarded'];
                $dashboardData['Applications Forwarded to EE Head'][1] = '?submitted_at_from=&submitted_at_to=&update_status='.config('commanConfig.applicationStatus.forwarded');
                break;
            default:
                ;
                break;
        }

//        dd($dashboardData);
        return $dashboardData;
    }

    /*
    * Function for getting DYCE dashboard data.
    *
    * @param $role_id,$dyce,$statusCount
    *
    * Author :Prajakta Sisale.
    *
    * @return array
    */
    public function getDyceDashboardData($role_id,$dyce,$statusCount){
//        dd($dyce);
        switch ($role_id)
        {
            case ($dyce['dyce_junior_engineer']):
                $dashboardData['Total Number of Applications'][0] = $statusCount['totalApplication'];
                $dashboardData['Total Number of Applications'][1] = '';
                $dashboardData['Applications Pending'][0] = $statusCount['totalPending'];
                $dashboardData['Applications Pending'][1] = '?submitted_at_from=&office_date_to=&update_status='.config('commanConfig.applicationStatus.in_process');
                $dashboardData['Applications Forwarded to DYCE Deputy'][0] = $statusCount['totalForwarded'];
                $dashboardData['Applications Forwarded to DYCE Deputy'][1] = '?submitted_at_from=&office_date_to=&update_status='.config('commanConfig.applicationStatus.forwarded');
                break;
            case ($dyce['dyce_engineer']):
                $dashboardData['Total Number of Applications'][0] = $statusCount['totalApplication'];
                $dashboardData['Total Number of Applications'][1] = '';
                $dashboardData['Applications Pending'][0] = $statusCount['totalPending'];
                $dashboardData['Applications Pending'][1] = '?submitted_at_from=&office_date_to=&update_status='.config('commanConfig.applicationStatus.in_process');
                $dashboardData['Applications Sent for Compliance'][0] = $statusCount['totalReverted'];
                $dashboardData['Applications Sent for Compliance'][1] = '?submitted_at_from=&office_date_to=&update_status='.config('commanConfig.applicationStatus.reverted');
                $dashboardData['Applications Forwarded to REE Junior'][0] = $statusCount['totalForwarded'] ;
                $dashboardData['Applications Forwarded to REE Junior'][1] = '?submitted_at_from=&office_date_to=&update_status='.config('commanConfig.applicationStatus.forwarded');
                break;
            case ($dyce['dyce_deputy_engineer']):
                $dashboardData['Total Number of Applications'][0] = $statusCount['totalApplication'];
                $dashboardData['Total Number of Applications'][1] = '';
                $dashboardData['Applications Pending'][0] = $statusCount['totalPending'];
                $dashboardData['Applications Pending'][1] = '?submitted_at_from=&office_date_to=&update_status='.config('commanConfig.applicationStatus.in_process');
                $dashboardData['Applications Sent for Compliance'][0] = $statusCount['totalReverted'];
                $dashboardData['Applications Sent for Compliance'][1] = '?submitted_at_from=&office_date_to=&update_status='.config('commanConfig.applicationStatus.reverted');
                $dashboardData['Applications Forwarded to DYCE Head'][0] = $statusCount['totalForwarded'] ;
                $dashboardData['Applications Forwarded to DYCE Head'][1] = '?submitted_at_from=&office_date_to=&update_status='.config('commanConfig.applicationStatus.forwarded');
                break;
            default:
                ; break;
        }
        return $dashboardData;
    }

    /*
    * Function for getting CAP dashboard data.
    *
    * @param $statusCount
    *
    * Author :Prajakta Sisale.
    *
    * @return array
    */
    public function getCapDashboardData($statusCount){
        $dashboardData['Total Number of Applications'][0] = $statusCount['totalApplication'];
        $dashboardData['Total Number of Applications'][1] = '';
        $dashboardData['Applications Pending'][0] = $statusCount['totalPending'];
        $dashboardData['Applications Pending'][1] = '?submitted_at_from=&submitted_at_to=&update_status='.config('commanConfig.applicationStatus.in_process');
        $dashboardData['Applications Sent for Compliance To CO'][0] = $statusCount['totalReverted'];
        $dashboardData['Applications Sent for Compliance To CO'][1] = '?submitted_at_from=&submitted_at_to=&update_status='.config('commanConfig.applicationStatus.reverted');
        $dashboardData['Applications Forwarded to VP'][0] = $statusCount['totalForwarded'] ;
        $dashboardData['Applications Forwarded to VP'][1] = '?submitted_at_from=&submitted_at_to=&update_status='.config('commanConfig.applicationStatus.forwarded');
        return $dashboardData;
    }

    /*
    * Function for getting VP dashboard data.
    *
    * @param $statusCount
    *
    * Author :Prajakta Sisale.
    *
    * @return array
    */
    public function getVpDashboardData($statusCount){
        $dashboardData['Total Number of Applications'][0] = $statusCount['totalApplication'];
        $dashboardData['Total Number of Applications'][1] = '';
        $dashboardData['Applications Pending'][0] = $statusCount['totalPending'];
        $dashboardData['Applications Pending'][1] = '?submitted_at_from=&submitted_at_to=&update_status='.config('commanConfig.applicationStatus.in_process');
        $dashboardData['Applications Sent for Compliance To Cap'][0] = $statusCount['totalReverted'];
        $dashboardData['Applications Sent for Compliance To Cap'][1] = '?submitted_at_from=&submitted_at_to=&update_status='.config('commanConfig.applicationStatus.reverted');
        $dashboardData['Applications Forwarded to REE Junior'][0] = $statusCount['totalForwarded'] ;
        $dashboardData['Applications Forwarded to REE Junior'][1] = '?submitted_at_from=&submitted_at_to=&update_status='.config('commanConfig.applicationStatus.forwarded');
        return $dashboardData;
    }

    public function getCurrentRoleFolderName(){

        if (session()->get('role_name') == config('commanConfig.co_engineer')) {
            $folder = 'co_department';

        }else if (session()->get('role_name') == config('commanConfig.ree_junior') || session()->get('role_name') == config('commanConfig.ree_deputy_engineer') || session()->get('role_name') == config('commanConfig.ree_assistant_engineer') || session()->get('role_name') == config('commanConfig.ree_branch_head')) {
            $folder = 'REE_department';

        } else if (session()->get('role_name') == config('commanConfig.cap_engineer')) {
            $folder = 'cap_department';
        }  else if (session()->get('role_name') == config('commanConfig.vp_engineer')) {
            $folder = 'vp_department';
        }else if (session()->get('role_name') == config('commanConfig.dyce_jr_user') || session()->get('role_name') == config('commanConfig.dyce_branch_head') || session()->get('role_name') == config('commanConfig.dyce_deputy_engineer')) {
            $folder = 'DYCE_department';
        }else if (session()->get('role_name') == config('commanConfig.ee_junior_engineer') || session()->get('role_name') == config('commanConfig.ee_branch_head') || session()->get('role_name') == config('commanConfig.ee_deputy_engineer')){
            $folder = 'ee_department';
        }
        return $folder;

    }

    public function listApplicationDataNoc($request, $application_type = null)
    {
        if(isset($request['dashboard_redicted']) && $request['dashboard_redicted'] == 1)
        {
            $applicationData = NocApplication::with(['applicationLayoutUser', 'noc_application_master', 'eeApplicationSociety', 'nocApplicationStatusForLoginListing' => function ($q) {
                $q->where('society_flag', 0)
                ->orderBy('id', 'desc');
            }])
            ->whereHas('nocApplicationStatusForLoginListing', function ($q) {
                $q->where('society_flag', 0)
                    ->orderBy('id', 'desc');
            });

        }else{
        $applicationData = NocApplication::with(['applicationLayoutUser', 'noc_application_master', 'eeApplicationSociety', 'nocApplicationStatusForLoginListing' => function ($q) {
            $q->where('user_id', Auth::user()->id)
                ->where('role_id', session()->get('role_id'))
                ->where('society_flag', 0)
                ->orderBy('id', 'desc');
        }])
            ->whereHas('nocApplicationStatusForLoginListing', function ($q) {
                $q->where('user_id', Auth::user()->id)
                    ->where('role_id', session()->get('role_id'))
                    ->where('society_flag', 0)
                    ->orderBy('id', 'desc');
            });
        }

        if ($request->submitted_at_from) {
            $applicationData = $applicationData->whereDate('submitted_at', '>=', date('Y-m-d', strtotime($request->submitted_at_from)));
        }

        if ($request->submitted_at_to) {
            $applicationData = $applicationData->whereDate('submitted_at', '<=', date('Y-m-d', strtotime($request->submitted_at_to)));
        }

/*        if ($application_type != null && $application_type == "reval") {
            $application_master_arr = OlApplicationMaster::Where('title', 'like', '%Revalidation Of Offer Letter%')->pluck('id')->toArray();
            $applicationData = $applicationData->whereIn('application_master_id', $application_master_arr);
        }*/

        $applicationDataDefine = $applicationData->orderBy('noc_applications.id', 'desc')
            ->select()->get();

        $listArray = [];
        if ($request->update_status) {

            foreach ($applicationDataDefine as $app_data) {
                if ($app_data->nocApplicationStatusForLoginListing[0]->status_id == $request->update_status) {
                    $listArray[] = $app_data;
                }
            }
        } else {
            $listArray = $applicationDataDefine;
        }

        return $listArray;
    }

    public function listApplicationDataNocforCC($request, $application_type = null)
    {
        if(isset($request['dashboard_redicted']) && $request['dashboard_redicted'] == 1)
        {
            $applicationData = NocCCApplication::with(['applicationLayoutUser', 'noc_application_master', 'eeApplicationSociety', 'nocApplicationStatusForLoginListing' => function ($q) {
                $q->where('society_flag', 0)
                ->orderBy('id', 'desc');
            }])
            ->whereHas('nocApplicationStatusForLoginListing', function ($q) {
                $q->where('society_flag', 0)
                    ->orderBy('id', 'desc');
            });
        }else{

            $applicationData = NocCCApplication::with(['applicationLayoutUser', 'noc_application_master', 'eeApplicationSociety', 'nocApplicationStatusForLoginListing' => function ($q) {
                $q->where('user_id', Auth::user()->id)
                    ->where('role_id', session()->get('role_id'))
                    ->where('society_flag', 0)
                    ->orderBy('id', 'desc');
            }])
                ->whereHas('nocApplicationStatusForLoginListing', function ($q) {
                    $q->where('user_id', Auth::user()->id)
                        ->where('role_id', session()->get('role_id'))
                        ->where('society_flag', 0)
                        ->orderBy('id', 'desc');
                });
            
        }

        if ($request->submitted_at_from) {
            $applicationData = $applicationData->whereDate('submitted_at', '>=', date('Y-m-d', strtotime($request->submitted_at_from)));
        }

        if ($request->submitted_at_to) {
            $applicationData = $applicationData->whereDate('submitted_at', '<=', date('Y-m-d', strtotime($request->submitted_at_to)));
        }

/*        if ($application_type != null && $application_type == "reval") {
            $application_master_arr = OlApplicationMaster::Where('title', 'like', '%Revalidation Of Offer Letter%')->pluck('id')->toArray();
            $applicationData = $applicationData->whereIn('application_master_id', $application_master_arr);
        }*/

        $applicationDataDefine = $applicationData->orderBy('noc_cc_applications.id', 'desc')
            ->select()->get();

        $listArray = [];
        if ($request->update_status) {

            foreach ($applicationDataDefine as $app_data) {
                if ($app_data->nocApplicationStatusForLoginListing[0]->status_id == $request->update_status) {
                    $listArray[] = $app_data;
                }
            }
        } else {
            $listArray = $applicationDataDefine;
        }

        return $listArray;
    }

    public function listApplicationDataOc($request)
    {
        if(isset($request['dashboard_redicted']) && $request['dashboard_redicted'] == 1)
        {
            $applicationData = OcApplication::with(['applicationLayoutUser', 'oc_application_master', 'eeApplicationSociety', 'ocApplicationStatusForLoginListing' => function ($q) {
                $q->where('society_flag', 0)
                ->orderBy('id', 'desc');
            }])
            ->whereHas('ocApplicationStatusForLoginListing', function ($q) {
                $q->where('society_flag', 0)
                    ->orderBy('id', 'desc');
            });
        }else{

            $applicationData = OcApplication::with(['applicationLayoutUser', 'oc_application_master', 'eeApplicationSociety', 'ocApplicationStatusForLoginListing' => function ($q) {
                $q->where('user_id', Auth::user()->id)
                    ->where('role_id', session()->get('role_id'))
                    ->where('society_flag', 0)
                    ->orderBy('id', 'desc');
            }])
                ->whereHas('ocApplicationStatusForLoginListing', function ($q) {
                    $q->where('user_id', Auth::user()->id)
                        ->where('role_id', session()->get('role_id'))
                        ->where('society_flag', 0)
                        ->orderBy('id', 'desc');
                });
            
        }

        if ($request->submitted_at_from) {
            $applicationData = $applicationData->whereDate('submitted_at', '>=', date('Y-m-d', strtotime($request->submitted_at_from)));
        }

        if ($request->submitted_at_to) {
            $applicationData = $applicationData->whereDate('submitted_at', '<=', date('Y-m-d', strtotime($request->submitted_at_to)));
        }

        $applicationDataDefine = $applicationData->orderBy('oc_applications.id', 'desc')
            ->select()->get();

        $listArray = [];
        if ($request->update_status) {

            foreach ($applicationDataDefine as $app_data) {
                if ($app_data->ocApplicationStatusForLoginListing[0]->status_id == $request->update_status) {
                    $listArray[] = $app_data;
                }
            }
        } else {
            $listArray = $applicationDataDefine;
        }

        return $listArray;
    }

    public function downloadNoc($applicationId)
    {

        $noc_application = NocApplication::where('id', $applicationId)->with(['request_form', 'applicationMasterLayout', 'eeApplicationSociety'])->first();
        $noc_application->layouts = MasterLayout::all();

        return $noc_application;
    }

    public function downloadNocforCC($applicationId)
    {

        $noc_application = NocCCApplication::where('id', $applicationId)->with(['request_form', 'applicationMasterLayout', 'eeApplicationSociety'])->first();
        $noc_application->layouts = MasterLayout::all();

        return $noc_application;
    }

    public function getNocApplication($applicationId)
    {

        $noc_application = NocApplication::where('id', $applicationId)->with(['request_form', 'applicationMasterLayout', 'eeApplicationSociety', 'noc_application_master'])->first();

        return $noc_application;
    }

    public function getNocforCCApplication($applicationId)
    {

        $noc_application = NocCCApplication::where('id', $applicationId)->with(['request_form', 'applicationMasterLayout', 'eeApplicationSociety', 'noc_application_master'])->first();

        return $noc_application;
    }

    public function getSocietyNocDocuments($applicationId)
    {

        $societyId = NocApplication::where('id', $applicationId)->value('society_id');
        $societyDocuments = SocietyOfferLetter::with(['societyNocDocuments.documents_Name'
            , 'documentCommentsNoc' => function ($q) {
                $q->orderBy('id', 'desc');
            }])->where('id', $societyId)->get();

        return $societyDocuments;
    }

    public function getSocietyNocCCDocuments($applicationId)
    {

        $societyId = NocCCApplication::where('id', $applicationId)->value('society_id');
        $societyDocuments = SocietyOfferLetter::with(['societyNocCCDocuments.documents_Name'
            , 'documentCommentsNocCC' => function ($q) {
                $q->orderBy('id', 'desc');
            }])->where('id', $societyId)->get();

        return $societyDocuments;
    }

    public function getCurrentStatusNoc($application_id)
    {
        $current_status = NocApplicationStatus::where('application_id', $application_id)
            ->where('user_id', Auth::user()->id)
            ->where('role_id', session()->get('role_id'))
            ->orderBy('id', 'desc')->first();

        return $current_status;
    }

    public function getCurrentStatusNocCC($application_id)
    {
        $current_status = NocCCApplicationStatus::where('application_id', $application_id)
            ->where('user_id', Auth::user()->id)
            ->where('role_id', session()->get('role_id'))
            ->orderBy('id', 'desc')->first();

        return $current_status;
    }

    public function getCurrentStatusNocforCC($application_id)
    {
        $current_status = NocCCApplicationStatus::where('application_id', $application_id)
            ->where('user_id', Auth::user()->id)
            ->where('role_id', session()->get('role_id'))
            ->orderBy('id', 'desc')->first();

        return $current_status;
    }

    public function getForwardNocApplication($applicationId)
    {

        $applicationData = NocApplication::with(['eeApplicationSociety'])
            ->where('id', $applicationId)->orderBy('id', 'DESC')->first();

        return $applicationData;
    }

    public function getForwardNocCCApplication($applicationId)
    {

        $applicationData = NocCCApplication::with(['eeApplicationSociety'])
            ->where('id', $applicationId)->orderBy('id', 'DESC')->first();

        return $applicationData;
    }

    public function getForwardOcApplication($applicationId)
    {

        $applicationData = OcApplication::with(['eeApplicationSociety'])
            ->where('id', $applicationId)->orderBy('id', 'DESC')->first();

        return $applicationData;
    }

    public function getCurrentLoggedInChildNoc($application_id)
    {
        $child_role_id = Role::where('id', session()->get('role_id'))->get(['child_id']);
        $result []= json_decode($child_role_id[0]->child_id);
        $status_user = NocApplicationStatus::where(['application_id' => $application_id, 'society_flag' => 0])->pluck('user_id')->toArray();

        $final_child = User::with('roles')->whereIn('id', array_unique($status_user))->whereIn('role_id', $result)->get();

        return $final_child;
    }

    public function getCurrentLoggedInChildNocCC($application_id)
    {
        $child_role_id = Role::where('id', session()->get('role_id'))->get(['child_id']);
        $result = json_decode($child_role_id[0]->child_id);
        $status_user = NocCCApplicationStatus::where(['application_id' => $application_id, 'society_flag' => 0])->pluck('user_id')->toArray();

        $final_child = User::with('roles')->whereIn('id', array_unique($status_user))->whereIn('role_id', $result)->get();

        return $final_child;
    }

    public function getCurrentLoggedInChildOc($application_id)
    {
        $role_name = session()->get('role_name');
        $app_details = OcApplication::with(['oc_application_master'])->where('id',$application_id)->first();
        $child_role_id = Role::where('id', session()->get('role_id'))->get(['child_id']);
        $result = json_decode($child_role_id[0]->child_id);

        if($app_details->OC_Generation_status == 0 && $role_name == 'ree_engineer')
        {
            $role_ids = Role::where('name','like', 'ee_junior_engineer')->orWhere('name','like', 'EM')->pluck('id')->toArray();

            $result = array_merge($result,$role_ids);
        }
        $status_user = OcApplicationStatusLog::where(['application_id' => $application_id, 'society_flag' => 0])->pluck('user_id')->toArray();

        $final_child = User::with(['roles'])->whereIn('id', array_unique($status_user))->whereIn('role_id', $result)->whereHas('roles', function ($q) {
                $q->where('name','!=','ee_engineer');
            })->get();

        return $final_child;
    }

    public function getLogsOfREEDepartmentForNOC($applicationId)
    {

        $roles = array(config('commanConfig.ree_junior'), config('commanConfig.ree_branch_head'), config('commanConfig.ree_deputy_engineer'), config('commanConfig.ree_assistant_engineer'));

        $status = array(config('commanConfig.applicationStatus.forwarded'), config('commanConfig.applicationStatus.reverted'));

        $reeRoles = Role::whereIn('name', $roles)->pluck('id');
        $reelogs = NocApplicationStatus::with(['getRoleName', 'getRole'])->where('application_id', $applicationId)->whereIn('role_id', $reeRoles)->whereIn('status_id', $status)->get();

        return $reelogs;
    }

    public function getLogsOfREEDepartmentForNOCforCC($applicationId)
    {

        $roles = array(config('commanConfig.ree_junior'), config('commanConfig.ree_branch_head'), config('commanConfig.ree_deputy_engineer'), config('commanConfig.ree_assistant_engineer'));

        $status = array(config('commanConfig.applicationStatus.forwarded'), config('commanConfig.applicationStatus.reverted'));

        $reeRoles = Role::whereIn('name', $roles)->pluck('id');
        $reelogs = NocCCApplicationStatus::with(['getRoleName', 'getRole'])->where('application_id', $applicationId)->whereIn('role_id', $reeRoles)->whereIn('status_id', $status)->get();

        return $reelogs;
    }

    public function getLogsOfREEDepartmentForOc($applicationId)
    {

        $roles = array(config('commanConfig.ree_junior'), config('commanConfig.ree_branch_head'), config('commanConfig.ree_deputy_engineer'), config('commanConfig.ree_assistant_engineer'));

        $status = array(config('commanConfig.applicationStatus.forwarded'), config('commanConfig.applicationStatus.reverted'));

        $reeRoles = Role::whereIn('name', $roles)->pluck('id');
        $reelogs = OcApplicationStatusLog::with(['getRoleName', 'getRole'])->where('application_id', $applicationId)->whereIn('role_id', $reeRoles)->whereIn('status_id', $status)->get();

        return $reelogs;
    }

    public function getLogsOfCODepartmentForNOC($applicationId)
    {

        $roles = config('commanConfig.co_engineer');

        $status = array(config('commanConfig.applicationStatus.forwarded'), config('commanConfig.applicationStatus.reverted'));

        $coRoles = Role::where('name', $roles)->value('id');
        $cologs = NocApplicationStatus::with(['getRoleName', 'getRole'])->where('application_id', $applicationId)->where('role_id', $coRoles)->whereIn('status_id', $status)->get();

        return $cologs;
    }

    public function getLogsOfCODepartmentForNOCforCC($applicationId)
    {

        $roles = config('commanConfig.co_engineer');

        $status = array(config('commanConfig.applicationStatus.forwarded'), config('commanConfig.applicationStatus.reverted'));

        $coRoles = Role::where('name', $roles)->value('id');
        $cologs = NocCCApplicationStatus::with(['getRoleName', 'getRole'])->where('application_id', $applicationId)->where('role_id', $coRoles)->whereIn('status_id', $status)->get();

        return $cologs;
    }

    public function getLogsOfCODepartmentForOc($applicationId)
    {

        $roles = config('commanConfig.co_engineer');

        $status = array(config('commanConfig.applicationStatus.forwarded'), config('commanConfig.applicationStatus.reverted'));

        $coRoles = Role::where('name', $roles)->value('id');
        $cologs = OcApplicationStatusLog::with(['getRoleName', 'getRole'])->where('application_id', $applicationId)->where('role_id', $coRoles)->whereIn('status_id', $status)->get();

        return $cologs;
    }

    public function getLogsOfEEDepartmentforOc($applicationId)
    {

        $roles = array(config('commanConfig.ee_junior_engineer'), config('commanConfig.ee_branch_head'), config('commanConfig.ee_deputy_engineer'));

        $status = array(config('commanConfig.applicationStatus.forwarded'), config('commanConfig.applicationStatus.reverted'));

        $eeRoles = Role::whereIn('name', $roles)->pluck('id');
        $EElogs = OcApplicationStatusLog::with(['getRoleName', 'getRole'])->where('application_id', $applicationId)->whereIn('role_id', $eeRoles)->whereIn('status_id', $status)->get();

        return $EElogs;
    }

    public function getLogsOfEMforOc($applicationId)
    {
        $roles = array(config('commanConfig.estate_manager'));

        $status = array(config('commanConfig.applicationStatus.forwarded'));
        $em_role = Role::whereIn('name', $roles)->pluck('id');
        $emLogs = OcApplicationStatusLog::with('getRoleName','getRole')->where('application_id', $applicationId)->whereIn('role_id', $em_role)->whereIn('status_id', $status)->get();
        //dd($Architectlogs);
        return $emLogs;
    }

    public function generateNOCREE($request)
    {
        if ($request->check_status == 1) {
            $forward_application = [[
                'application_id' => $request->applicationId,
                'user_id' => Auth::user()->id,
                'role_id' => session()->get('role_id'),
                'status_id' => config('commanConfig.applicationStatus.forwarded'),
                'to_user_id' => $request->to_user_id,
                'to_role_id' => $request->to_role_id,
                'remark' => $request->remark,
                'is_active' => 1,
                'phase'=>1,
                'created_at' => Carbon::now(),
            ],

            [
                'application_id' => $request->applicationId,
                'user_id' => $request->to_user_id,
                'role_id' => $request->to_role_id,
                'status_id' => config('commanConfig.applicationStatus.NOC_Generation'),
                'to_user_id' => null,
                'to_role_id' => null,
                'remark' => $request->remark,
                'is_active' => 1,
                'phase'=>1,
                'created_at' => Carbon::now(),
            ],
            ];

            NocApplicationStatus::where('application_id',$request->applicationId)->update(array('is_active' => 0));

            NocApplicationStatus::insert($forward_application);

        }else {
            $revert_application = [
                [
                    'application_id' => $request->applicationId,
                    'user_id' => Auth::user()->id,
                    'role_id' => session()->get('role_id'),
                    'status_id' => config('commanConfig.applicationStatus.reverted'),
                    'to_user_id' => $request->to_child_id,
                    'to_role_id' => $request->to_role_id,
                    'remark' => $request->remark,
                    'is_active' => 1,
                    'phase'=>1,
                    'created_at' => Carbon::now(),
                ],

                [
                    'application_id' => $request->applicationId,
                    'user_id' => $request->to_child_id,
                    'role_id' => $request->to_role_id,
                    'status_id' => config('commanConfig.applicationStatus.NOC_Generation'),
                    'to_user_id' => null,
                    'to_role_id' => null,
                    'remark' => $request->remark,
                    'is_active' => 1,
                    'phase'=>1,
                    'created_at' => Carbon::now(),
                ],
            ];

            NocApplicationStatus::where('application_id',$request->applicationId)->update(array('is_active' => 0));

            NocApplicationStatus::insert($revert_application);
        }

        DB::beginTransaction();
        try {

           NocApplication::where('id', $request->applicationId)->update(['noc_generation_status' => config('commanConfig.applicationStatus.NOC_Generation')]);

            DB::commit();
        } catch (\Exception $ex) {
            DB::rollback();
//                return response()->json(['error' => $ex->getMessage()], 500);
        }
        
        //NocApplication::where('id', $request->applicationId)->update(['noc_generation_status' => config('commanConfig.applicationStatus.NOC_Generation')]);

        return true;
    }

    public function generateNOCforCCREE($request)
    {
        if ($request->check_status == 1) {
            $forward_application = [[
                'application_id' => $request->applicationId,
                'user_id' => Auth::user()->id,
                'role_id' => session()->get('role_id'),
                'status_id' => config('commanConfig.applicationStatus.forwarded'),
                'to_user_id' => $request->to_user_id,
                'to_role_id' => $request->to_role_id,
                'remark' => $request->remark,
                'is_active' => 1,
                'phase'=>1,
                'created_at' => Carbon::now(),
            ],

            [
                'application_id' => $request->applicationId,
                'user_id' => $request->to_user_id,
                'role_id' => $request->to_role_id,
                'status_id' => config('commanConfig.applicationStatus.NOC_Generation'),
                'to_user_id' => null,
                'to_role_id' => null,
                'remark' => $request->remark,
                'is_active' => 1,
                'phase'=>1,
                'created_at' => Carbon::now(),
            ],
            ];

            NocCCApplicationStatus::where('application_id',$request->applicationId)->update(array('is_active' => 0));

            NocCCApplicationStatus::insert($forward_application);

        }else {
            $revert_application = [
                [
                    'application_id' => $request->applicationId,
                    'user_id' => Auth::user()->id,
                    'role_id' => session()->get('role_id'),
                    'status_id' => config('commanConfig.applicationStatus.reverted'),
                    'to_user_id' => $request->to_child_id,
                    'to_role_id' => $request->to_role_id,
                    'remark' => $request->remark,
                    'created_at' => Carbon::now(),
                ],

                [
                    'application_id' => $request->applicationId,
                    'user_id' => $request->to_child_id,
                    'role_id' => $request->to_role_id,
                    'status_id' => config('commanConfig.applicationStatus.NOC_Generation'),
                    'to_user_id' => null,
                    'to_role_id' => null,
                    'remark' => $request->remark,
                    'created_at' => Carbon::now(),
                ],
            ];

            NocCCApplicationStatus::where('application_id',$request->applicationId)->update(array('is_active' => 0));
            NocCCApplicationStatus::insert($revert_application);
        }
        
        NocCCApplication::where('id', $request->applicationId)->update(['noc_generation_status' => config('commanConfig.applicationStatus.NOC_Generation')]);

        return true;
    }

    public function generateOcREE($request)
    {
        if ($request->check_status == 1) {
            $forward_application = [[
                'application_id' => $request->applicationId,
                'user_id' => Auth::user()->id,
                'role_id' => session()->get('role_id'),
                'status_id' => config('commanConfig.applicationStatus.forwarded'),
                'to_user_id' => $request->to_user_id,
                'to_role_id' => $request->to_role_id,
                'remark' => $request->remark,
                'is_active' => 1,
                'phase'=>1,
                'created_at' => Carbon::now(),
            ],

            [
                'application_id' => $request->applicationId,
                'user_id' => $request->to_user_id,
                'role_id' => $request->to_role_id,
                'status_id' => config('commanConfig.applicationStatus.OC_Generation'),
                'to_user_id' => null,
                'to_role_id' => null,
                'remark' => $request->remark,
                'is_active' => 1,
                'phase'=>1,
                'created_at' => Carbon::now(),
            ],
            ];

            OcApplicationStatusLog::where('application_id',$request->applicationId)->update(array('is_active' => 0));

            OcApplicationStatusLog::insert($forward_application);

        }else {
            $revert_application = [
                [
                    'application_id' => $request->applicationId,
                    'user_id' => Auth::user()->id,
                    'role_id' => session()->get('role_id'),
                    'status_id' => config('commanConfig.applicationStatus.reverted'),
                    'to_user_id' => $request->to_child_id,
                    'to_role_id' => $request->to_role_id,
                    'remark' => $request->remark,
                    'created_at' => Carbon::now(),
                ],

                [
                    'application_id' => $request->applicationId,
                    'user_id' => $request->to_child_id,
                    'role_id' => $request->to_role_id,
                    'status_id' => config('commanConfig.applicationStatus.OC_Generation'),
                    'to_user_id' => null,
                    'to_role_id' => null,
                    'remark' => $request->remark,
                    'created_at' => Carbon::now(),
                ],
            ];

            OcApplicationStatusLog::where('application_id',$request->applicationId)->update(array('is_active' => 0));
            OcApplicationStatusLog::insert($revert_application);
        }
        
        OcApplication::where('id', $request->applicationId)->update(['OC_Generation_status' => config('commanConfig.applicationStatus.OC_Generation')]);

        return true;
    }

    public function forwardApprovedNocApplication($request)
    {
        if ($request->check_status == 1) {
            $forward_application = [[
                'application_id' => $request->applicationId,
                'user_id' => Auth::user()->id,
                'role_id' => session()->get('role_id'),
                'status_id' => config('commanConfig.applicationStatus.forwarded'),
                'to_user_id' => $request->to_user_id,
                'to_role_id' => $request->to_role_id,
                'remark' => $request->remark,
                'is_active' => 1,
                'phase' => 2,
                'created_at' => Carbon::now(),
            ],

            [
                'application_id' => $request->applicationId,
                'user_id' => $request->to_user_id,
                'role_id' => $request->to_role_id,
                'status_id' => config('commanConfig.applicationStatus.NOC_Issued'),
                'to_user_id' => null,
                'to_role_id' => null,
                'remark' => $request->remark,
                'is_active' => 1,
                'phase' => 2,
                'created_at' => Carbon::now(),
            ],
        ];


            DB::beginTransaction();
            try {
                NocApplicationStatus::where('application_id',$request->applicationId)->update(array('is_active' => 0));

                NocApplicationStatus::insert($forward_application);
                NocApplication::where('id', $request->applicationId)->update(['noc_generation_status' => config('commanConfig.applicationStatus.NOC_Issued')]);

                DB::commit();
            } catch (\Exception $ex) {
                DB::rollback();
//                return response()->json(['error' => $ex->getMessage()], 500);
            }

            /*NocApplicationStatus::insert($forward_application);
            NocApplication::where('id', $request->applicationId)->update(['noc_generation_status' => config('commanConfig.applicationStatus.NOC_Issued')]);*/
        }

        return true;
    }

    public function forwardApprovedNocfoCCApplication($request)
    {
        if ($request->check_status == 1) {
            $forward_application = [[
                'application_id' => $request->applicationId,
                'user_id' => Auth::user()->id,
                'role_id' => session()->get('role_id'),
                'status_id' => config('commanConfig.applicationStatus.forwarded'),
                'to_user_id' => $request->to_user_id,
                'to_role_id' => $request->to_role_id,
                'remark' => $request->remark,
                'is_active' => 1,
                'phase' => 2,
                'created_at' => Carbon::now(),
            ],

            [
                'application_id' => $request->applicationId,
                'user_id' => $request->to_user_id,
                'role_id' => $request->to_role_id,
                'status_id' => config('commanConfig.applicationStatus.NOC_Issued'),
                'to_user_id' => null,
                'to_role_id' => null,
                'remark' => $request->remark,
                'is_active' => 1,
                'phase' => 2,
                'created_at' => Carbon::now(),
            ],
        ];


            DB::beginTransaction();
            try {
                NocCCApplicationStatus::where('application_id',$request->applicationId)->update(array('is_active' => 0));

                NocCCApplicationStatus::insert($forward_application);
                NocCCApplication::where('id', $request->applicationId)->update(['noc_generation_status' => config('commanConfig.applicationStatus.NOC_Issued')]);

                DB::commit();
            } catch (\Exception $ex) {
                DB::rollback();
//                return response()->json(['error' => $ex->getMessage()], 500);
            }

            /*NocCCApplicationStatus::insert($forward_application);
            NocCCApplication::where('id', $request->applicationId)->update(['noc_generation_status' => config('commanConfig.applicationStatus.NOC_Issued')]);*/
        }

        return true;
    }

    public function forwardApprovedOcApplication($request)
    {
        if ($request->check_status == 1) {
            $forward_application = [[
                'application_id' => $request->applicationId,
                'user_id' => Auth::user()->id,
                'role_id' => session()->get('role_id'),
                'status_id' => config('commanConfig.applicationStatus.forwarded'),
                'to_user_id' => $request->to_user_id,
                'to_role_id' => $request->to_role_id,
                'remark' => $request->remark,
                'is_active' => 1,
                'phase' => 2,
                'created_at' => Carbon::now(),
            ],

            [
                'application_id' => $request->applicationId,
                'user_id' => $request->to_user_id,
                'role_id' => $request->to_role_id,
                'status_id' => config('commanConfig.applicationStatus.OC_Approved'),
                'to_user_id' => null,
                'to_role_id' => null,
                'remark' => $request->remark,
                'is_active' => 1,
                'phase' => 2,
                'created_at' => Carbon::now(),
            ],
        ];


            DB::beginTransaction();
            try {
                OcApplicationStatusLog::where('application_id',$request->applicationId)->update(array('is_active' => 0));

                OcApplicationStatusLog::insert($forward_application);
                OcApplication::where('id', $request->applicationId)->update(['OC_Generation_status' => config('commanConfig.applicationStatus.OC_Approved')]);

                DB::commit();
            } catch (\Exception $ex) {
                DB::rollback();
//                return response()->json(['error' => $ex->getMessage()], 500);
            }
        }

        return true;
    }

    public function forwardNocApplicationForm($request)
    {
        if ($request->check_status == 1) {
            $forward_application = [[
                'application_id' => $request->applicationId,
                'user_id' => Auth::user()->id,
                'role_id' => session()->get('role_id'),
                'status_id' => config('commanConfig.applicationStatus.forwarded'),
                'to_user_id' => $request->to_user_id,
                'to_role_id' => $request->to_role_id,
                'remark' => $request->remark,
                'is_active' => 1,
                'created_at' => Carbon::now(),
            ],

            [
                'application_id' => $request->applicationId,
                'user_id' => $request->to_user_id,
                'role_id' => $request->to_role_id,
                'status_id' => config('commanConfig.applicationStatus.in_process'),
                'to_user_id' => null,
                'to_role_id' => null,
                'remark' => $request->remark,
                'is_active' => 1,
                'created_at' => Carbon::now(),
            ],
            ];

            DB::beginTransaction();
            try {
                NocApplicationStatus::where('application_id',$request->applicationId)->update(array('is_active' => 0));

                NocApplicationStatus::insert($forward_application);

                DB::commit();
            } catch (\Exception $ex) {
                DB::rollback();
//                return response()->json(['error' => $ex->getMessage()], 500);
            }

            //NocApplicationStatus::insert($forward_application);
        } else {
            $revert_application = [
                [
                    'application_id' => $request->applicationId,
                    'user_id' => Auth::user()->id,
                    'role_id' => session()->get('role_id'),
                    'status_id' => config('commanConfig.applicationStatus.reverted'),
                    'to_user_id' => $request->to_child_id,
                    'to_role_id' => $request->to_role_id,
                    'remark' => $request->remark,
                    'is_active' => 1,
                    'created_at' => Carbon::now(),
                ],

                [
                    'application_id' => $request->applicationId,
                    'user_id' => $request->to_child_id,
                    'role_id' => $request->to_role_id,
                    'status_id' => config('commanConfig.applicationStatus.in_process'),
                    'to_user_id' => null,
                    'to_role_id' => null,
                    'remark' => $request->remark,
                    'is_active' => 1,
                    'created_at' => Carbon::now(),
                ],
            ];

            DB::beginTransaction();
            try {
                NocApplicationStatus::where('application_id',$request->applicationId)->update(array('is_active' => 0));

                NocApplicationStatus::insert($revert_application);

                DB::commit();
            } catch (\Exception $ex) {
                DB::rollback();
//                return response()->json(['error' => $ex->getMessage()], 500);
            }

            //NocApplicationStatus::insert($revert_application);
        }

        return true;
    }

    public function forwardNocCCApplicationForm($request)
    {
        if ($request->check_status == 1) {
            $forward_application = [[
                'application_id' => $request->applicationId,
                'user_id' => Auth::user()->id,
                'role_id' => session()->get('role_id'),
                'status_id' => config('commanConfig.applicationStatus.forwarded'),
                'to_user_id' => $request->to_user_id,
                'to_role_id' => $request->to_role_id,
                'remark' => $request->remark,
                'is_active' => 1,
                'created_at' => Carbon::now(),
            ],

            [
                'application_id' => $request->applicationId,
                'user_id' => $request->to_user_id,
                'role_id' => $request->to_role_id,
                'status_id' => config('commanConfig.applicationStatus.in_process'),
                'to_user_id' => null,
                'to_role_id' => null,
                'remark' => $request->remark,
                'is_active' => 1,
                'created_at' => Carbon::now(),
            ],
            ];

            DB::beginTransaction();
            try {
                NocCCApplicationStatus::where('application_id',$request->applicationId)->update(array('is_active' => 0));

                NocCCApplicationStatus::insert($forward_application);

                DB::commit();
            } catch (\Exception $ex) {
                DB::rollback();
//                return response()->json(['error' => $ex->getMessage()], 500);
            }

            //NocCCApplicationStatus::insert($forward_application);
        } else {
            $revert_application = [
                [
                    'application_id' => $request->applicationId,
                    'user_id' => Auth::user()->id,
                    'role_id' => session()->get('role_id'),
                    'status_id' => config('commanConfig.applicationStatus.reverted'),
                    'to_user_id' => $request->to_child_id,
                    'to_role_id' => $request->to_role_id,
                    'remark' => $request->remark,
                    'is_active' => 1,
                    'created_at' => Carbon::now(),
                ],

                [
                    'application_id' => $request->applicationId,
                    'user_id' => $request->to_child_id,
                    'role_id' => $request->to_role_id,
                    'status_id' => config('commanConfig.applicationStatus.in_process'),
                    'to_user_id' => null,
                    'to_role_id' => null,
                    'remark' => $request->remark,
                    'is_active' => 1,
                    'created_at' => Carbon::now(),
                ],
            ];

            DB::beginTransaction();
            try {
                NocCCApplicationStatus::where('application_id',$request->applicationId)->update(array('is_active' => 0));

                NocCCApplicationStatus::insert($revert_application);

                DB::commit();
            } catch (\Exception $ex) {
                DB::rollback();
//                return response()->json(['error' => $ex->getMessage()], 500);
            }

            //NocCCApplicationStatus::insert($revert_application);
        }

        return true;
    }

    public function forwardOcApplicationForm($request)
    {
        if ($request->check_status == 1) {
            $forward_application = [[
                'application_id' => $request->applicationId,
                'user_id' => Auth::user()->id,
                'role_id' => session()->get('role_id'),
                'status_id' => config('commanConfig.applicationStatus.forwarded'),
                'to_user_id' => $request->to_user_id,
                'to_role_id' => $request->to_role_id,
                'remark' => $request->remark,
                'is_active' => 1,
                'created_at' => Carbon::now(),
            ],

            [
                'application_id' => $request->applicationId,
                'user_id' => $request->to_user_id,
                'role_id' => $request->to_role_id,
                'status_id' => config('commanConfig.applicationStatus.in_process'),
                'to_user_id' => null,
                'to_role_id' => null,
                'remark' => $request->remark,
                'is_active' => 1,
                'created_at' => Carbon::now(),
            ],
            ];

            DB::beginTransaction();
            try {
                OcApplicationStatusLog::where('application_id',$request->applicationId)->update(array('is_active' => 0));

                OcApplicationStatusLog::insert($forward_application);

                DB::commit();
            } catch (\Exception $ex) {
                DB::rollback();
//                return response()->json(['error' => $ex->getMessage()], 500);
            }
        } else {
            $revert_application = [
                [
                    'application_id' => $request->applicationId,
                    'user_id' => Auth::user()->id,
                    'role_id' => session()->get('role_id'),
                    'status_id' => config('commanConfig.applicationStatus.reverted'),
                    'to_user_id' => $request->to_child_id,
                    'to_role_id' => $request->to_role_id,
                    'remark' => $request->remark,
                    'is_active' => 1,
                    'created_at' => Carbon::now(),
                ],

                [
                    'application_id' => $request->applicationId,
                    'user_id' => $request->to_child_id,
                    'role_id' => $request->to_role_id,
                    'status_id' => config('commanConfig.applicationStatus.in_process'),
                    'to_user_id' => null,
                    'to_role_id' => null,
                    'remark' => $request->remark,
                    'is_active' => 1,
                    'created_at' => Carbon::now(),
                ],
            ];

            DB::beginTransaction();
            try {
                OcApplicationStatusLog::where('application_id',$request->applicationId)->update(array('is_active' => 0));

                OcApplicationStatusLog::insert($revert_application);

                DB::commit();
            } catch (\Exception $ex) {
                DB::rollback();
//                return response()->json(['error' => $ex->getMessage()], 500);
            }
        }

        return true;
    }

    public function generateNOCforwardToREE($request, $ree)
    {
        $forward_application = [[
            'application_id' => $request->applicationId,
            'user_id' => Auth::user()->id,
            'role_id' => session()->get('role_id'),
            'status_id' => config('commanConfig.applicationStatus.forwarded'),
            'to_user_id' => $ree->user_id,
            'to_role_id' => $ree->role_id,
            'remark' => $request->remark,
            'is_active' => 1,
            'phase' => 2,
            'created_at' => Carbon::now(),
        ],

        [
            'application_id' => $request->applicationId,
            'user_id' => $ree->user_id,
            'role_id' => $ree->role_id,
            'status_id' => config('commanConfig.applicationStatus.NOC_Issued'),
            'to_user_id' => null,
            'to_role_id' => null,
            'remark' => $request->remark,
            'is_active' => 1,
            'phase' => 2,
            'created_at' => Carbon::now(),
        ],
        ];

        DB::beginTransaction();
        try {
            NocApplicationStatus::where('application_id',$request->applicationId)->update(array('is_active' => 0));

            NocApplicationStatus::insert($forward_application);
            NocApplication::where('id', $request->applicationId)->update(['noc_generation_status' => config('commanConfig.applicationStatus.NOC_Issued')]);

            DB::commit();
        } catch (\Exception $ex) {
            DB::rollback();
//                return response()->json(['error' => $ex->getMessage()], 500);
        }

        /*NocApplicationStatus::insert($forward_application);
        NocApplication::where('id', $request->applicationId)->update(['noc_generation_status' => config('commanConfig.applicationStatus.NOC_Issued')]);*/

        return true;
    }

    public function generateNOCforCCforwardToREE($request, $ree)
    {
        $forward_application = [[
            'application_id' => $request->applicationId,
            'user_id' => Auth::user()->id,
            'role_id' => session()->get('role_id'),
            'status_id' => config('commanConfig.applicationStatus.forwarded'),
            'to_user_id' => $ree->user_id,
            'to_role_id' => $ree->role_id,
            'remark' => $request->remark,
            'is_active' => 1,
            'phase' => 2,
            'created_at' => Carbon::now(),
        ],

        [
            'application_id' => $request->applicationId,
            'user_id' => $ree->user_id,
            'role_id' => $ree->role_id,
            'status_id' => config('commanConfig.applicationStatus.NOC_Issued'),
            'to_user_id' => null,
            'to_role_id' => null,
            'remark' => $request->remark,
            'is_active' => 1,
            'phase' => 2,
            'created_at' => Carbon::now(),
        ],
        ];

        DB::beginTransaction();
        try {
            NocCCApplicationStatus::where('application_id',$request->applicationId)->update(array('is_active' => 0));

            NocCCApplicationStatus::insert($forward_application);
            NocCCApplication::where('id', $request->applicationId)->update(['noc_generation_status' => config('commanConfig.applicationStatus.NOC_Issued')]);

            DB::commit();
        } catch (\Exception $ex) {
            DB::rollback();
//                return response()->json(['error' => $ex->getMessage()], 500);
        }

        /*NocCCApplicationStatus::insert($forward_application);
        NocCCApplication::where('id', $request->applicationId)->update(['noc_generation_status' => config('commanConfig.applicationStatus.NOC_Issued')]);*/

        return true;
    }

    public function generateOCforwardToREE($request, $ree)
    {
        $forward_application = [[
            'application_id' => $request->applicationId,
            'user_id' => Auth::user()->id,
            'role_id' => session()->get('role_id'),
            'status_id' => config('commanConfig.applicationStatus.forwarded'),
            'to_user_id' => $ree->user_id,
            'to_role_id' => $ree->role_id,
            'remark' => $request->remark,
            'is_active' => 1,
            'phase' => 2,
            'created_at' => Carbon::now(),
        ],

        [
            'application_id' => $request->applicationId,
            'user_id' => $ree->user_id,
            'role_id' => $ree->role_id,
            'status_id' => config('commanConfig.applicationStatus.OC_Approved'),
            'to_user_id' => null,
            'to_role_id' => null,
            'remark' => $request->remark,
            'is_active' => 1,
            'phase' => 2,
            'created_at' => Carbon::now(),
        ],
        ];

        DB::beginTransaction();
        try {
            OcApplicationStatusLog::where('application_id',$request->applicationId)->update(array('is_active' => 0));

            OcApplicationStatusLog::insert($forward_application);
            OcApplication::where('id', $request->applicationId)->update(['OC_Generation_status' => config('commanConfig.applicationStatus.OC_Approved')]);

            DB::commit();
        } catch (\Exception $ex) {
            DB::rollback();
//                return response()->json(['error' => $ex->getMessage()], 500);
        }

        return true;
    }

    public function getREEForwardRevertLogNoc($applicationData, $applicationId)
    {

        $ree_branch_head = Role::where('name', config('commanConfig.ree_branch_head'))->value('id');
        $ree_jr_user = Role::where('name', config('commanConfig.ree_junior'))
            ->value('id');
        $applicationData->reeForwardLog = NocApplicationStatus::where('application_id', $applicationId)->where('role_id', $ree_branch_head)->where('status_id', config('commanConfig.applicationStatus.forwarded'))->orderBy('id', 'desc')->first();

        $applicationData->reeRevertLog = NocApplicationStatus::where('application_id', $applicationId)->where('role_id', $ree_jr_user)->where('status_id', config('commanConfig.applicationStatus.reverted'))->orderBy('id', 'desc')->first();
        return $applicationData;
    }

    public function getREEForwardRevertLogNocforCC($applicationData, $applicationId)
    {

        $ree_branch_head = Role::where('name', config('commanConfig.ree_branch_head'))->value('id');
        $ree_jr_user = Role::where('name', config('commanConfig.ree_junior'))
            ->value('id');
        $applicationData->reeForwardLog = NocCCApplicationStatus::where('application_id', $applicationId)->where('role_id', $ree_branch_head)->where('status_id', config('commanConfig.applicationStatus.forwarded'))->orderBy('id', 'desc')->first();

        $applicationData->reeRevertLog = NocCCApplicationStatus::where('application_id', $applicationId)->where('role_id', $ree_jr_user)->where('status_id', config('commanConfig.applicationStatus.reverted'))->orderBy('id', 'desc')->first();
        return $applicationData;
    }

    public function getREEForwardRevertLogOc($applicationData, $applicationId)
    {

        $ree_branch_head = Role::where('name', config('commanConfig.ree_branch_head'))->value('id');
        $ree_jr_user = Role::where('name', config('commanConfig.ree_junior'))
            ->value('id');
        $applicationData->reeForwardLog = OcApplicationStatusLog::where('application_id', $applicationId)->where('role_id', $ree_branch_head)->where('status_id', config('commanConfig.applicationStatus.forwarded'))->orderBy('id', 'desc')->first();

        $applicationData->reeRevertLog = OcApplicationStatusLog::where('application_id', $applicationId)->where('role_id', $ree_jr_user)->where('status_id', config('commanConfig.applicationStatus.reverted'))->orderBy('id', 'desc')->first();
        return $applicationData;
    }

    public function forwardNocApplicationToSociety($request)
    {
        $society_details = NocApplicationStatus::where(['society_flag' => 1, 'application_id' => $request->applicationId])->orderBy('id', 'desc')->first();

        $forward_application = [
            [
                'application_id' => $request->applicationId,
                'user_id' => Auth::user()->id,
                'role_id' => session()->get('role_id'),
                'status_id' => config('commanConfig.applicationStatus.sent_to_society'),
                'to_user_id' => $society_details->user_id,
                'society_flag' => 0,
                'to_role_id' => $society_details->role_id,
                'remark' => $request->remark,
                'is_active' => 1,
                'phase' => 2,
                'created_at' => Carbon::now(),
            ],

            [
                'application_id' => $request->applicationId,
                'user_id' => $society_details->user_id,
                'role_id' => $society_details->role_id,
                'status_id' => config('commanConfig.applicationStatus.sent_to_society'),
                'to_user_id' => null,
                'society_flag' => 1,
                'to_role_id' => null,
                'remark' => $request->remark,
                'is_active' => 1,
                'phase' => 2,
                'created_at' => Carbon::now(),
            ],
        ];

        DB::beginTransaction();
        try {
            NocApplicationStatus::where('application_id',$request->applicationId)->update(array('is_active' => 0));

            NocApplicationStatus::insert($forward_application);
            NocApplication::where('id', $request->applicationId)->update(['noc_generation_status' => config('commanConfig.applicationStatus.sent_to_society') , 'is_issued_to_society' => 1]);

            DB::commit();
        } catch (\Exception $ex) {
            DB::rollback();
//                return response()->json(['error' => $ex->getMessage()], 500);
        }

        /*NocApplicationStatus::insert($forward_application);
        NocApplication::where('id', $request->applicationId)->update(['noc_generation_status' => config('commanConfig.applicationStatus.sent_to_society') , 'is_issued_to_society' => 1]);*/

        return true;
    }

    public function forwardNocCCApplicationToSociety($request)
    {
        $society_details = NocCCApplicationStatus::where(['society_flag' => 1, 'application_id' => $request->applicationId])->orderBy('id', 'desc')->first();

        $forward_application = [
            [
                'application_id' => $request->applicationId,
                'user_id' => Auth::user()->id,
                'role_id' => session()->get('role_id'),
                'status_id' => config('commanConfig.applicationStatus.sent_to_society'),
                'to_user_id' => $society_details->user_id,
                'society_flag' => 0,
                'to_role_id' => $society_details->role_id,
                'remark' => $request->remark,
                'is_active' => 1,
                'phase' => 2,
                'created_at' => Carbon::now(),
            ],

            [
                'application_id' => $request->applicationId,
                'user_id' => $society_details->user_id,
                'role_id' => $society_details->role_id,
                'status_id' => config('commanConfig.applicationStatus.sent_to_society'),
                'to_user_id' => null,
                'society_flag' => 1,
                'to_role_id' => null,
                'remark' => $request->remark,
                'is_active' => 1,
                'phase' => 2,
                'created_at' => Carbon::now(),
            ],
        ];

        DB::beginTransaction();
        try {
            NocCCApplicationStatus::where('application_id',$request->applicationId)->update(array('is_active' => 0));

            NocCCApplicationStatus::insert($forward_application);
            NocCCApplication::where('id', $request->applicationId)->update(['noc_generation_status' => config('commanConfig.applicationStatus.sent_to_society') , 'is_issued_to_society' => 1]);

            DB::commit();
        } catch (\Exception $ex) {
            DB::rollback();
//                return response()->json(['error' => $ex->getMessage()], 500);
        }

        /*NocCCApplicationStatus::insert($forward_application);
        NocCCApplication::where('id', $request->applicationId)->update(['noc_generation_status' => config('commanConfig.applicationStatus.sent_to_society') , 'is_issued_to_society' => 1]);*/

        return true;
    }

    public function forwardOcApplicationToSociety($request)
    {
        $society_details = OcApplicationStatusLog::where(['society_flag' => 1, 'application_id' => $request->applicationId])->orderBy('id', 'desc')->first();

        $forward_application = [
            [
                'application_id' => $request->applicationId,
                'user_id' => Auth::user()->id,
                'role_id' => session()->get('role_id'),
                'status_id' => config('commanConfig.applicationStatus.sent_to_society'),
                'to_user_id' => $society_details->user_id,
                'society_flag' => 0,
                'to_role_id' => $society_details->role_id,
                'remark' => $request->remark,
                'is_active' => 1,
                'phase' => 2,
                'created_at' => Carbon::now(),
            ],

            [
                'application_id' => $request->applicationId,
                'user_id' => $society_details->user_id,
                'role_id' => $society_details->role_id,
                'status_id' => config('commanConfig.applicationStatus.sent_to_society'),
                'to_user_id' => null,
                'society_flag' => 1,
                'to_role_id' => null,
                'remark' => $request->remark,
                'is_active' => 1,
                'phase' => 2,
                'created_at' => Carbon::now(),
            ],
        ];

        DB::beginTransaction();
        try {
            OcApplicationStatusLog::where('application_id',$request->applicationId)->update(array('is_active' => 0));

            OcApplicationStatusLog::insert($forward_application);
            OcApplication::where('id', $request->applicationId)->update(['OC_Generation_status' => config('commanConfig.applicationStatus.sent_to_society') , 'is_approve_oc' => 1]);

            DB::commit();
        } catch (\Exception $ex) {
            DB::rollback();
//                return response()->json(['error' => $ex->getMessage()], 500);
        }

        return true;
    }

    public function revertNocApplicationToSociety($request)
    {
        $society_details = NocApplicationStatus::where(['society_flag' => 1, 'application_id' => $request->applicationId])->orderBy('id', 'desc')->first();

        $revert_application = [
            [
                'application_id' => $request->applicationId,
                'user_id' => Auth::user()->id,
                'role_id' => session()->get('role_id'),
                'status_id' => config('commanConfig.applicationStatus.reverted'),
                'to_user_id' => $society_details->user_id,
                'society_flag' => 0,
                'to_role_id' => $society_details->role_id,
                'remark' => $request->remark,
                'is_active' => 1,
                'phase' => 3,
                'created_at' => Carbon::now(),
            ],

            [
                'application_id' => $request->applicationId,
                'user_id' => $society_details->user_id,
                'role_id' => $society_details->role_id,
                'status_id' => config('commanConfig.applicationStatus.reverted'),
                'to_user_id' => null,
                'society_flag' => 1,
                'to_role_id' => null,
                'remark' => $request->remark,
                'is_active' => 1,
                'phase' => 3,
                'created_at' => Carbon::now(),
            ],
        ];

        DB::beginTransaction();
        try {
            NocApplicationStatus::where('application_id',$request->applicationId)->update(array('is_active' => 0));

           NocApplicationStatus::insert($revert_application);
           NocApplication::where('id', $request->applicationId)->update(['noc_generation_status' => config('commanConfig.applicationStatus.reverted')]);

            DB::commit();
        } catch (\Exception $ex) {
            DB::rollback();
//                return response()->json(['error' => $ex->getMessage()], 500);
        }
/*
        NocApplicationStatus::insert($revert_application);
        NocApplication::where('id', $request->applicationId)->update(['noc_generation_status' => config('commanConfig.applicationStatus.reverted')]);
*/
        return true;
    }

    public function revertNocforCCApplicationToSociety($request)
    {
        $society_details = NocCCApplicationStatus::where(['society_flag' => 1, 'application_id' => $request->applicationId])->orderBy('id', 'desc')->first();

        $revert_application = [
            [
                'application_id' => $request->applicationId,
                'user_id' => Auth::user()->id,
                'role_id' => session()->get('role_id'),
                'status_id' => config('commanConfig.applicationStatus.reverted'),
                'to_user_id' => $society_details->user_id,
                'society_flag' => 0,
                'to_role_id' => $society_details->role_id,
                'remark' => $request->remark,
                'is_active' => 1,
                'phase' => 3,
                'created_at' => Carbon::now(),
            ],

            [
                'application_id' => $request->applicationId,
                'user_id' => $society_details->user_id,
                'role_id' => $society_details->role_id,
                'status_id' => config('commanConfig.applicationStatus.reverted'),
                'to_user_id' => null,
                'society_flag' => 1,
                'to_role_id' => null,
                'remark' => $request->remark,
                'is_active' => 1,
                'phase' => 3,
                'created_at' => Carbon::now(),
            ],
        ];

        DB::beginTransaction();
        try {
            NocCCApplicationStatus::where('application_id',$request->applicationId)->update(array('is_active' => 0));

           NocCCApplicationStatus::insert($revert_application);
           NocCCApplication::where('id', $request->applicationId)->update(['noc_generation_status' => config('commanConfig.applicationStatus.reverted')]);

            DB::commit();
        } catch (\Exception $ex) {
            DB::rollback();
//                return response()->json(['error' => $ex->getMessage()], 500);
        }

        /*NocCCApplicationStatus::insert($revert_application);
        NocCCApplication::where('id', $request->applicationId)->update(['noc_generation_status' => config('commanConfig.applicationStatus.reverted')]);*/

        return true;
    }

    public function revertOcApplicationToSociety($request)
    {
        $society_details = OcApplicationStatusLog::where(['society_flag' => 1, 'application_id' => $request->applicationId])->orderBy('id', 'desc')->first();

        $revert_application = [
            [
                'application_id' => $request->applicationId,
                'user_id' => Auth::user()->id,
                'role_id' => session()->get('role_id'),
                'status_id' => config('commanConfig.applicationStatus.reverted'),
                'to_user_id' => $society_details->user_id,
                'society_flag' => 0,
                'to_role_id' => $society_details->role_id,
                'remark' => $request->remark,
                'is_active' => 1,
                'phase' => 3,
                'created_at' => Carbon::now(),
            ],

            [
                'application_id' => $request->applicationId,
                'user_id' => $society_details->user_id,
                'role_id' => $society_details->role_id,
                'status_id' => config('commanConfig.applicationStatus.reverted'),
                'to_user_id' => null,
                'society_flag' => 1,
                'to_role_id' => null,
                'remark' => $request->remark,
                'is_active' => 1,
                'phase' => 3,
                'created_at' => Carbon::now(),
            ],
        ];

        DB::beginTransaction();
        try {
            OcApplicationStatusLog::where('application_id',$request->applicationId)->update(array('is_active' => 0));

           OcApplicationStatusLog::insert($revert_application);
           OcApplication::where('id', $request->applicationId)->update(['OC_Generation_status' => config('commanConfig.applicationStatus.reverted')]);

            DB::commit();
        } catch (\Exception $ex) {
            DB::rollback();
//                return response()->json(['error' => $ex->getMessage()], 500);
        }

        return true;
    }

    public function getREERoles(){
//        $ree_jr_id = Role::where('name',config('commanConfig.ree_junior'))->value('id');
//        $ree_head_id = Role::where('name',config('commanConfig.ree_branch_head'))->value('id');
//        $ree_deputy_id = Role::where('name', config('commanConfig.ree_deputy_engineer'))->value('id');
//        $ree_ass_id = Role::where('name', config('commanConfig.ree_assistant_engineer'))->value('id');
//        $ree = ['ree_jr_id' => $ree_jr_id,
//            'ree_head_id' => $ree_head_id,
//            'ree_deputy_id' => $ree_deputy_id,
//            'ree_ass_id' => $ree_ass_id];

//        return $ree;
        $roles = array(config('commanConfig.ree_junior'),config('commanConfig.ree_branch_head'),config('commanConfig.ree_deputy_engineer'),config('commanConfig.ree_assistant_engineer'));
        return Role::whereIn('name', $roles)->pluck('id','name')->toArray();

    }

    /*
     * Function for getting total count of all department dashboard for ree
     *
     * Author :Prajakta Sisale.
     *
     * @return array
     */
    public function getTotalCountsOfApplicationsPending(){

        $eeRoleData = $this->getEERoles();
        $dyceRoleData = $this->getDyceRoles();
        $reeRoleData = $this->getREERoles();
//        $coRoleData = Role::where('name',config('commanConfig.co_engineer'))->value('id');
//        $vpRoleData = Role::where('name',config('commanConfig.vp_engineer'))->value('id');
//        $capRoleData = Role::where('name',config('commanConfig.cap_engineer'))->value('id');

        $roles = Role::whereIn('name',[config('commanConfig.co_engineer'),config('commanConfig.vp_engineer'),config('commanConfig.cap_engineer')])->pluck('id','name');
//        dd($roles);

        //SELECT COUNT(*) FROM `ol_application_status_log` WHERE `is_active`=1 AND `role_id` IN (21) AND `status_id`= 1

//        $eeTotalPendingCount = $dyceTotalPendingCount = $reeTotalPendingCount
//        = $coTotalPendingCount = $vpTotalPendingCount = $capTotalPendingCount = 0;

        $eeTotalPendingCount = OlApplicationStatus::where('is_active',1)
            ->where('status_id',config('commanConfig.applicationStatus.in_process'))
            ->whereIn('role_id',$eeRoleData)
            ->get()->count();

        $dyceTotalPendingCount = OlApplicationStatus::where('is_active',1)
            ->where('status_id',config('commanConfig.applicationStatus.in_process'))
            ->whereIn('role_id',$dyceRoleData)
            ->get()->count();

        $new_offer_letter_master_ids = config('commanConfig.new_offer_letter_master_ids');

        $reeTotalPendingCount = OlApplicationStatus::whereHas('OlApplication', function($q) use ($new_offer_letter_master_ids){
                $q->whereIn('application_master_id', $new_offer_letter_master_ids);
            })->where('is_active',1)
            ->whereIn('status_id',[config('commanConfig.applicationStatus.offer_letter_generation'),config('commanConfig.applicationStatus.in_process'),config('commanConfig.applicationStatus.offer_letter_approved')])
            ->whereIn('role_id',$reeRoleData)
            ->get()->count();

        $coTotalPendingCount = OlApplicationStatus::whereHas('OlApplication', function($q) use ($new_offer_letter_master_ids){
            $q->whereIn('application_master_id', $new_offer_letter_master_ids);
        })->where('is_active',1)
            ->whereIn('status_id',[config('commanConfig.applicationStatus.offer_letter_generation'),config('commanConfig.applicationStatus.in_process'),config('commanConfig.applicationStatus.offer_letter_approved')])
            ->where('role_id',$roles['co_engineer'])
            ->get()->count();

        $vpTotalPendingCount = OlApplicationStatus::whereHas('OlApplication', function($q) use ($new_offer_letter_master_ids){
            $q->whereIn('application_master_id', $new_offer_letter_master_ids);
        })->where('is_active',1)
            ->whereIn('status_id',[config('commanConfig.applicationStatus.offer_letter_generation'),config('commanConfig.applicationStatus.in_process'),config('commanConfig.applicationStatus.offer_letter_approved')])
            ->where('role_id',$roles['vp_engineer'])
            ->get()->count();

        $capTotalPendingCount = OlApplicationStatus::whereHas('OlApplication', function($q) use ($new_offer_letter_master_ids){
            $q->whereIn('application_master_id', $new_offer_letter_master_ids);
        })->where('is_active',1)
            ->whereIn('status_id',[config('commanConfig.applicationStatus.offer_letter_generation'),config('commanConfig.applicationStatus.in_process'),config('commanConfig.applicationStatus.offer_letter_approved')])
            ->where('role_id',$roles['cap_engineer'])
            ->get()->count();

        $totalPendingApplications = $eeTotalPendingCount + $dyceTotalPendingCount + $reeTotalPendingCount
            + $coTotalPendingCount + $vpTotalPendingCount + $capTotalPendingCount;


        $dashboardData1 = array();
        $dashboardData1['Total Number of Applications'] = $totalPendingApplications;
        $dashboardData1['Applications Pending at EE Department'] = $eeTotalPendingCount;
        $dashboardData1['Applications Pending at DyCE'] = $dyceTotalPendingCount;
        $dashboardData1['Applications Pending at REE'] = $reeTotalPendingCount;
        $dashboardData1['Applications Pending at CO'] = $coTotalPendingCount;
//                $dashboardData['Offer Letter Approved'] = $statusCount['offerLetterApproved'];
        $dashboardData1['Applications Pending at CAP'] = $capTotalPendingCount;
        $dashboardData1['Applications Pending at VP'] = $vpTotalPendingCount;

        return $dashboardData1;


    }


    /*
     * Function for getting total count of all department dashboard for ree
     *
     * Author :Prajakta Sisale.
     *
     * @return array
     */
    public function getTotalCountsOfRevalApplicationsPending(){

        $eeRoleData = $this->getEERoles();
        $dyceRoleData = $this->getDyceRoles();
        $reeRoleData = $this->getREERoles();
//        $coRoleData = Role::where('name',config('commanConfig.co_engineer'))->value('id');
//        $vpRoleData = Role::where('name',config('commanConfig.vp_engineer'))->value('id');
//        $capRoleData = Role::where('name',config('commanConfig.cap_engineer'))->value('id');

        $roles = Role::whereIn('name',[config('commanConfig.co_engineer'),config('commanConfig.vp_engineer'),config('commanConfig.cap_engineer')])->pluck('id','name');
//        dd($roles);

        //SELECT COUNT(*) FROM `ol_application_status_log` WHERE `is_active`=1 AND `role_id` IN (21) AND `status_id`= 1

//        $eeTotalPendingCount = $dyceTotalPendingCount = $reeTotalPendingCount
//        = $coTotalPendingCount = $vpTotalPendingCount = $capTotalPendingCount = 0;

        $eeTotalPendingCount = OlApplicationStatus::where('is_active',1)
            ->where('status_id',config('commanConfig.applicationStatus.in_process'))
            ->whereIn('role_id',$eeRoleData)
            ->get()->count();

        $dyceTotalPendingCount = OlApplicationStatus::where('is_active',1)
            ->where('status_id',config('commanConfig.applicationStatus.in_process'))
            ->whereIn('role_id',$dyceRoleData)
            ->get()->count();

        $reval_application_type_ids= config('commanConfig.revalidation_master_ids');

        $reeTotalPendingCount = OlApplicationStatus::whereHas('OlApplication', function($q) use ($reval_application_type_ids){
            $q->whereIn('application_master_id', $reval_application_type_ids);
        })->where('is_active',1)
            ->whereIn('status_id',[config('commanConfig.applicationStatus.offer_letter_generation'),config('commanConfig.applicationStatus.in_process'),config('commanConfig.applicationStatus.offer_letter_approved')])
            ->whereIn('role_id',$reeRoleData)
            ->get()->count();

        $coTotalPendingCount = OlApplicationStatus::whereHas('OlApplication', function($q) use ($reval_application_type_ids){
            $q->whereIn('application_master_id', $reval_application_type_ids);
        })->where('is_active',1)
            ->whereIn('status_id',[config('commanConfig.applicationStatus.offer_letter_generation'),config('commanConfig.applicationStatus.in_process'),config('commanConfig.applicationStatus.offer_letter_approved')])
            ->where('role_id',$roles['co_engineer'])
            ->get()->count();

        $vpTotalPendingCount = OlApplicationStatus::whereHas('OlApplication', function($q) use ($reval_application_type_ids){
            $q->whereIn('application_master_id', $reval_application_type_ids);
        })->where('is_active',1)
            ->whereIn('status_id',[config('commanConfig.applicationStatus.offer_letter_generation'),config('commanConfig.applicationStatus.in_process'),config('commanConfig.applicationStatus.offer_letter_approved')])
            ->where('role_id',$roles['vp_engineer'])
            ->get()->count();

        $capTotalPendingCount = OlApplicationStatus::whereHas('OlApplication', function($q) use ($reval_application_type_ids){
            $q->whereIn('application_master_id', $reval_application_type_ids);
        })->where('is_active',1)
            ->whereIn('status_id',[config('commanConfig.applicationStatus.offer_letter_generation'),config('commanConfig.applicationStatus.in_process'),config('commanConfig.applicationStatus.offer_letter_approved')])
            ->where('role_id',$roles['cap_engineer'])
            ->get()->count();

        $totalPendingApplications = $eeTotalPendingCount + $dyceTotalPendingCount + $reeTotalPendingCount
            + $coTotalPendingCount + $vpTotalPendingCount + $capTotalPendingCount;


        $dashboardData1 = array();
        $dashboardData1['Total Number of Applications'] = $totalPendingApplications;
        $dashboardData1['Applications Pending at EE Department'] = $eeTotalPendingCount;
        $dashboardData1['Applications Pending at DyCE'] = $dyceTotalPendingCount;
        $dashboardData1['Applications Pending at REE'] = $reeTotalPendingCount;
        $dashboardData1['Applications Pending at CO'] = $coTotalPendingCount;
//                $dashboardData['Offer Letter Approved'] = $statusCount['offerLetterApproved'];
        $dashboardData1['Applications Pending at CAP'] = $capTotalPendingCount;
        $dashboardData1['Applications Pending at VP'] = $vpTotalPendingCount;

        return $dashboardData1;


    }

    /*
     * Function for getting DYCE roles.
     *
     *  @param $roleIds
     *
     * Author :Prajakta Sisale.
     *
     * @return array
     */
    public function getToatalPendingApplicationsAtUser($roleIds){

        $users =User::whereIn('role_id',$roleIds)
            ->get()->toArray();

        $total_pending_at_department = 0;
        foreach ($users as $user){

            $count = OlApplicationStatus::where('user_id',$user['id'])
                ->where('status_id',config('commanConfig.applicationStatus.in_process'))
                ->where('is_active',1)->get()->count();
            $dashboardData1['Application Pending At '.$user['name']] = $count;

            $total_pending_at_department += $count;

        }
        $dashboardData1['Total Number of Applications'] = $total_pending_at_department;
        return array_reverse($dashboardData1);
    }

    public function getDYCDORoles(){
        $roles = array(config('commanConfig.dycdo_engineer'),config('commanConfig.dyco_engineer'));
        $count =  Role::whereIn('name', $roles)->pluck('id');  
        return  $count;   
            
    }         

    public function getEERoles1(){
        
        $roles = array(config('commanConfig.ee_junior_engineer'),config('commanConfig.ee_deputy_engineer'),config('commanConfig.ee_branch_head'));
        return Role::whereIn('name', $roles)->pluck('id')->toArray();
    }     

    public function getEMRoles(){
        
        $roles = array(config('commanConfig.estate_manager'));
        return Role::whereIn('name', $roles)->pluck('id');       
    }    

    public function getJTCORoles(){

        $roles = array(config('commanConfig.joint_co'));
        return Role::whereIn('name', $roles)->pluck('id');        
    }    

    public function getCORoles(){

        $roles = array(config('commanConfig.co_engineer'));
        return Role::whereIn('name', $roles)->pluck('id');        
    }    

    public function getLARoles(){

        $roles = array(config('commanConfig.legal_advisor'));
        return Role::whereIn('name', $roles)->pluck('id');        
    }    

    public function getArchitectRoles(){

        $roles = array(config('commanConfig.junior_architect'),config('commanConfig.senior_architect'),config('commanConfig.architect'));
        return Role::whereIn('name', $roles)->pluck('id');        
    }

    public function getSocietyDocumentsforOC($applicationId)
    {

        $societyId = OcApplication::where('id', $applicationId)->value('society_id');
        $societyDocuments = SocietyOfferLetter::with(['societyOcDocuments.documents_Name'
            , 'documentCommentsforOc' => function ($q) {
                $q->orderBy('id', 'desc');
            }])->where('id', $societyId)->get();

        return $societyDocuments;
    }     

    public function get_tripartite_agreements($ol_application_id, $agreement_type)
    {
        $ol_application = $this->getOlApplication($ol_application_id);
        $document_type_id = $ol_application->application_master_id;
        $agreement_type = $agreement_type;
        $OlSocietyDocumentsMaster = OlSocietyDocumentsMaster::where(['application_id' => $document_type_id, 'name' => $agreement_type])->first();
        if ($OlSocietyDocumentsMaster) {
            $documents_id = $OlSocietyDocumentsMaster->id;
            return OlSocietyDocumentsStatus::where(['society_id' => $ol_application->society_id, 'document_id' => $OlSocietyDocumentsMaster->id])->orderBy('id','desc')->first();
        }
        return null;
    }

    public function set_tripartite_agreements($ol_application, $agreement_type, $path, $status_id = 0)
    {
        $document_type_id = $ol_application->application_master_id;
        $agreement_type = $agreement_type;
        $OlSocietyDocumentsMaster = OlSocietyDocumentsMaster::where(['application_id' => $document_type_id, 'name' => $agreement_type])->first();
        if ($OlSocietyDocumentsMaster) {
            $document_type_id = $ol_application->application_master_id;
            $agreement_type = $agreement_type;

            $OlSocietyDocumentsStatus = new OlSocietyDocumentsStatus;
            $OlSocietyDocumentsStatus->society_id = $ol_application->society_id;
            $OlSocietyDocumentsStatus->document_id = $OlSocietyDocumentsMaster->id;
            $OlSocietyDocumentsStatus->society_document_path = $path;
            $OlSocietyDocumentsStatus->status_id = $status_id;
            $OlSocietyDocumentsStatus->save();
            if ($OlSocietyDocumentsStatus) {
                return $OlSocietyDocumentsStatus;
            }
        }
        return null;
    }

    // EE - Scrutiny & Remark page
    public function eeScrutinyRemark(Request $request,$applicationId){
        
        $applicationId = decrypt($applicationId);
        $ol_application = $this->getOlApplication($applicationId);
        $eeScrutinyData = $this->getEEScrutinyRemark($applicationId);
        $ol_application->model = OlApplication::with(['ol_application_master'])->where('id',$applicationId)->first();
        $folder = $this->getCurrentRoleFolderName();
        $consentCount = OlConsentVerificationDetails::where('application_id',$applicationId)->count();
        $landDetails = OlDemarcationLandArea::where('application_id',$applicationId)->first();
        $societyDocument = $this->getSocietyEEDocuments($applicationId);
        $societyComments = $this->getSocietyDocumentComments($applicationId); 
       
        return view('admin.common.view_ee_scrutiny_remark',compact('eeScrutinyData','ol_application','folder','consentCount','landDetails','societyDocument','societyComments'));
    }

    // DyCE Scrutiny & Remark page
    public function dyceScrutinyRemark(Request $request,$applicationId){

        $applicationId = decrypt($applicationId);
        $ol_application = $this->getOlApplication($applicationId);
        $ol_application->model = OlApplication::with(['ol_application_master'])->where('id',$applicationId)->first();
        $applicationData = $this->getDyceScrutinyRemark($applicationId);
        $folder = $this->getCurrentRoleFolderName();
        return view('admin.common.view_dyce_scrutiny',compact('ol_application','applicationData','folder'));
    }

    /**
     * Updates profile of logged in users.
     * Author: Amar Prajapati
     * @param void
     * @return \Illuminate\Http\Response
     */
    public function profile(){
        $users = auth()->user();
//        dd($users);
        $user_profile = new User;
        $field_names = $user_profile->getFillable();
        $field_names = array_flip($field_names);
        $non_req_fields_arr = array('address', 'role_id', 'uploaded_note_path');
        $non_req_fields = array_flip($non_req_fields_arr);
        $append_fields = array('confirm_password', 'id');
        foreach($non_req_fields as $key => $value){
            if(in_array($key, $field_names)){
                unset($field_names[$key]);
            }
        }
        $field_names = array_flip($field_names);
        $field_names = array_merge($field_names, $append_fields);
        $comm_func = $this;
        return view('frontend.profile', compact('field_names', 'non_req_fields_arr', 'users', 'comm_func'));
    }


    /**
     * Updates profile of logged in users.
     * Author: Amar Prajapati
     * @param void
     * @return \Illuminate\Http\Response
     */
    public function update_profile(Request $request){
        $validated_fields = SocietyOfferLetter::validate($request);
        $errors = $validated_fields->errors();
        $id = decrypt($request->id);

        if($validated_fields->fails()){
            $request->flash();
            if($request->is_email_check != null){
                return $errors;
            }
            else{
                $input = array(
                    'name' => $request->input('name'),
                    'password' => bcrypt($request->input('new_password')),
                    'mobile_no' => $request->input('mobile_no'),
                );
                if($request->input('new_password') == null){
                    unset($input['password']);
                }

                //Code added by Amar Prajapati >>start
                DB::beginTransaction();
                try {

                    User::where('id', $id)->update($input);
                    if(session()->all()['role_name'] == config('commanConfig.society_offer_letter')){
                        $input['contact_no'] = $input['mobile_no'];
                        unset($input['mobile_no']);
                        SocietyOfferLetter::where('id', $id)->update($input);
                    }

                    DB::commit();
                } catch (\Exception $ex) {
                    DB::rollback();
                    return redirect()->route('society.profile')->with('error', 'Something went wrong!');
                }
                //Code added by Amar Prajapati >>end

                return redirect()->back()->with('success', 'Profile updated successfully!');
            }
        }else{

        }
    }

    // get comments which is given by society
    public function getSocietyDocumentComments($applicationId){
        
        $comments = OlSocietyDocumentsComment::where('application_id',$applicationId)
        ->orderBy('id','desc')->first();
        return $comments;
    }

    // view common society and EE document page 
    public function societyEEDocuments(Request $request,$applicationId){

        // $id = '';
        $applicationId = decrypt($applicationId);
        $ol_application = $this->getOlApplication($applicationId);
        $societyDocument = $this->getSocietyEEDocuments($applicationId);
        $societyComments = $this->getSocietyDocumentComments($applicationId);
        // $societyDocuments = $this->getSocietyEEDocuments($applicationId);
        
        // if ($societyDocuments){
        //     foreach($societyDocuments[0]->societyDocuments as $data){
        //         if ($data->documents_Name[0]->is_multiple == 1){

        //             if ($id != $data->document_id){
        //                 $documents [] = $data;
        //                 $id = $data->document_id;
        //             }

        //         }else{
        //             $documents[] = $data;
        //         }
        //     }                    
        // }

        $folder = $this->getCurrentRoleFolderName();
        $ol_application->model = OlApplication::with(['ol_application_master'])->where('id',$applicationId)->first();

       return view('admin.common.view_society_ee_documents',compact('societyDocument','ol_application','folder','societyComments')); 
    }    

    // view multiple documents in society and EE document page
    public function viewMultipleDocuments(Request $request,$applicationId,$documentId){
        
        $documentId = decrypt($documentId);
        $applicationId = decrypt($applicationId);
        $ol_application = $this->getOlApplication($applicationId); 
        $documents = OlSocietyDocumentsStatus::where('document_id',$documentId)
        ->where('society_id',$ol_application->society_id)->orderBy('id','desc')->get();
        $folder = $this->getCurrentRoleFolderName();
        $ol_application->model = OlApplication::with(['ol_application_master'])->where('id',$applicationId)->first();
        
        return view('admin.common.view_multiple_documents',compact('ol_application','documents','folder'));
    }

    // save details of send msg
    public function saveMsgSentDetails($mobile,$text,$userId){ 

        try{
            $data = new mailMsgSentDetails();
            $data->user_id     = $userId; 
            $data->mobile_no   = $mobile; 
            $data->msg_content = $text; 
            $data->save();

            $response['status'] = 'success';
            $response['msg']    = 'sms send successfully';

        }catch(Exception $e){
            $response['status'] = 'error';
            $response['msg']    = 'something went wrong.';            
        }

        return response(json_encode($response), 200);
    }

    public function getDepartmentHead($userName,$layoutId){
        
        $head = [];
        if ($userName == config('commanConfig.ee_junior_engineer') || $userName == config('commanConfig.ee_deputy_engineer')){
            $headName = config('commanConfig.ee_branch_head');
        }
        $users = Role::where('name',$headName)->with(['parentUserArchitect.Layouts' => function ($query) use($layoutId){
           $query->where('layout_id',$layoutId); 
        }])->whereHas('parentUserArchitect.Layouts', function ($query) use($layoutId){
            $query->where('layout_id',$layoutId);
        })->first();
        
        if ($users){
            foreach($users->parentUserArchitect as $user){
                if (count($user->Layouts) > 0){
                    $head []= $user;
                }
            }            
        }
        return $head;
    }
}
