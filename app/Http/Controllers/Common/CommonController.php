<?php

namespace App\Http\Controllers\Common;

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
use App\MasterLayout;
use App\OlApplication;
use App\OlApplicationCalculationSheetDetails;
use App\OlApplicationMaster;
use App\OlApplicationStatus;
use App\OlCapNotes;
use App\OlChecklistScrutiny;
use App\OlConsentVerificationQuestionMaster;
use App\OlDcrRateMaster;
use App\OlDemarcationVerificationQuestionMaster;
use App\OlRgRelocationVerificationQuestionMaster;
use App\OlSharingCalculationSheetDetail;
use App\OlTitBitVerificationQuestionMaster;
use App\REENote;
use App\Role;
use App\SocietyOfferLetter;
use App\User;
use Auth;
use Carbon\Carbon;
use Config;
use DB;
use Storage;
use App\ArchitectApplication;

class CommonController extends Controller
{

    // society and EE documents
    public function getSocietyEEDocuments($applicationId)
    {

        $societyId = OlApplication::where('id', $applicationId)->value('society_id');
        $societyDocuments = SocietyOfferLetter::with(['societyDocuments.documents_Name'
            , 'documentComments' => function ($q) {
                $q->orderBy('id', 'desc');
            }])->where('id', $societyId)->get();

        return $societyDocuments;
    }

    // EE - Scrutiny & Remark page
    public function getEEScrutinyRemark($applicationId)
    {

        $eeScrutinyData = OlApplication::with(['eeApplicationSociety.societyDocuments.documents_Name'])
            ->where('id', $applicationId)->first();

        $eeScrutinyData->eeNote = EENote::where('application_id', $applicationId)
            ->orderBy('id', 'desc')->first();

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

        if (isset($applicationData)) {
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
        $architect_applications = ArchitectApplication::with(['ArchitectApplicationStatusForLoginListing' => function ($query) {
            return $query->where(['user_id' => auth()->user()->id, 'role_id' => session()->get('role_id')])->orderBy('id', 'desc');
        }]);

        if ($request->keyword) {
            $architect_applications->where(function ($query) use ($request) {
                $query->orWhere('application_number', 'like', '%' . $request->keyword . '%');
                $query->orWhere('candidate_name', 'like', '%' . $request->keyword . '%');
                $query->orWhere('candidate_email', 'like', '%' . $request->keyword . '%');
                $query->orWhere('candidate_mobile_no', 'like', '%' . $request->keyword . '%');
            });
        }
        if ($request->application_status) {
            $architect_applications->where('application_status', '=', $request->application_status);
        }

        if ($request->from) {
            $architect_applications->whereDate('application_date', '>=', date('Y-m-d', strtotime($request->from)));
        }

        if ($request->status) {
            $architect_applications->where(DB::raw($request->status), '=', function ($q) {
                $q->from('architect_application_status_logs')
                ->select('status_id')
                ->where('user_id', auth()->user()->id)
                ->where('role_id', session()->get('role_id'))
                ->where('architect_application_id', '=', DB::raw('architect_application.id'))
                ->limit(1)
                ->orderBy('id', 'desc');
            });
        }

        if ($request->to) {
            $architect_applications->whereDate('application_date', '<=', date('Y-m-d', strtotime($request->to)));
        }
        $architect_application = $architect_applications->get();

        return $architect_application;
    }

    public function architect_layout_details($request)
    {
        $ArchitectLayoutLayoutdetailsQuery = ArchitectLayout::with(['layout_details', 'ArchitectLayoutStatusLogInListing' => function ($q) {
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

        $ArchitectLayoutLayoutdetails = $ArchitectLayoutLayoutdetailsQuery->get();

        return $ArchitectLayoutLayoutdetails;
    }
    public function architect_layout_request_revision($request)
    {
        $ArchitectLayoutRevisionRequestsQuery = ArchitectLayout::with(['layout_details', 'ArchitectLayoutStatusLogInListing' => function ($q) {
            $q->where('user_id', Auth::user()->id)
                ->where('role_id', session()->get('role_id'))
                ->orderBy('id', 'desc');
        }])->whereHas('ArchitectLayoutStatusLogInListing', function ($q) {
            $q->where('user_id', Auth::user()->id)
                ->where('role_id', session()->get('role_id'))
                ->orderBy('id', 'desc');
        });
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
        $ArchitectLayoutRevisionRequests = $ArchitectLayoutRevisionRequestsQuery->where(DB::raw(config('commanConfig.architect_layout_status.new_application')), '!=', function ($q) {
            $q->from('architect_layout_status_logs')->select('status_id')->where('architect_layout_id', '=', DB::raw('architect_layouts.id'))->limit(1)->orderBy('id', 'desc');
        })->where(DB::raw(config('commanConfig.architect_layout_status.approved')), '!=', function ($q) {
            $q->from('architect_layout_status_logs')->select('status_id')->where('architect_layout_id', '=', DB::raw('architect_layouts.id'))->limit(1)->orderBy('id', 'desc');
        })->get();

        return $ArchitectLayoutRevisionRequests;
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
                    'created_at' => Carbon::now(),
                ],
            ];

            OlApplicationStatus::insert($forward_application);
        } else {
            if (session()->get('role_name') == config('commanConfig.cap_engineer') || session()->get('role_name') == config('commanConfig.vp_engineer')) {
                $revert_application = [
                    [
                        'application_id' => $request->applicationId,
                        'user_id' => Auth::user()->id,
                        'role_id' => session()->get('role_id'),
                        'status_id' => config('commanConfig.applicationStatus.reverted'),
                        'to_user_id' => $request->user_id,
                        'to_role_id' => $request->role_id,
                        'remark' => $request->remark,
                        'created_at' => Carbon::now(),
                    ],

                    [
                        'application_id' => $request->applicationId,
                        'user_id' => $request->user_id,
                        'role_id' => $request->role_id,
                        'status_id' => config('commanConfig.applicationStatus.in_process'),
                        'to_user_id' => null,
                        'to_role_id' => null,
                        'remark' => $request->remark,
                        'created_at' => Carbon::now(),
                    ],
                ];
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
                        'created_at' => Carbon::now(),
                    ],
                ];
            }
//            echo "in revert";
            //            dd($revert_application);
            OlApplicationStatus::insert($revert_application);
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
                'created_at' => Carbon::now(),
            ],
        ];

        OlApplicationStatus::insert($forward_application);
        OlApplication::where('id', $request->applicationId)->update(['status_offer_letter' => config('commanConfig.applicationStatus.offer_letter_generation')]);

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
                'created_at' => Carbon::now(),
            ],
        ];

        OlApplicationStatus::insert($forward_application);
        OlApplication::where('id', $request->applicationId)->update(['status_offer_letter' => config('commanConfig.applicationStatus.offer_letter_approved'), 'is_approve_offer_letter' => $request->is_approved]);

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
                    'created_at' => Carbon::now(),
                ],
            ];

//            echo "in forward";
            //            dd($forward_application);
            OlApplicationStatus::insert($forward_application);
            OlApplication::where('id', $request->applicationId)->update(['status_offer_letter' => config('commanConfig.applicationStatus.offer_letter_approved')]);
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
                'created_at' => Carbon::now(),
            ],
        ];

        OlApplicationStatus::insert($forward_application);
        OlApplication::where('id', $request->applicationId)->update(['status_offer_letter' => config('commanConfig.applicationStatus.sent_to_society')]);

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

    public function downloadOfferLetter($applicationId)
    {

        $ol_application = OlApplication::where('id', $applicationId)->with(['request_form', 'applicationMasterLayout', 'eeApplicationSociety'])->first();
        $ol_application->layouts = MasterLayout::all();

        return $ol_application;
    }

    public function ftpFileUpload($folderName, $file, $fileName)
    {
        return Storage::disk('ftp')->putFileAs($folderName, $file, $fileName);
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
                'created_at' => Carbon::now(),
            ],
        ];

        OlApplicationStatus::insert($forward_application);
        OlApplication::where('id', $request->applicationId)->update(['status_offer_letter' => config('commanConfig.applicationStatus.offer_letter_generation')]);

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

        $ol_application = OlApplication::where('id', $applicationId)->with(['request_form', 'applicationMasterLayout', 'eeApplicationSociety', 'ol_application_master'])->first();

        return $ol_application;
    }

    public function getLogOfArchitectLayoutApplication($layout_id)
    {
        $roles = array(config('commanConfig.junior_architect'), config('commanConfig.senior_architect'), config('commanConfig.achitect'));

        $status = array(config('commanConfig.architect_layout_status.forward'));

        $architectRoles = Role::whereIn('name', $roles)->pluck('id');
        $Architectlogs = ArchitectLayoutStatusLog::with('getRoleName')->where('architect_layout_id', $layout_id)->whereIn('role_id', $architectRoles)->whereIn('status_id', $status)->get();

        return $Architectlogs;
    }

    public function getLogsOfEEDepartment($applicationId)
    {

        $roles = array(config('commanConfig.ee_junior_engineer'), config('commanConfig.ee_branch_head'), config('commanConfig.ee_deputy_engineer'), config('commanConfig.society_offer_letter'));

        $status = array(config('commanConfig.applicationStatus.forwarded'), config('commanConfig.applicationStatus.reverted'));

        $eeRoles = Role::whereIn('name', $roles)->pluck('id');
        $EElogs = OlApplicationStatus::with(['getRoleName','getRole'])->where('application_id', $applicationId)->whereIn('role_id', $eeRoles)->whereIn('status_id', $status)->get();

        return $EElogs;
    }

    public function getLogsOfDYCEDepartment($applicationId)
    {

        $roles = array(config('commanConfig.dyce_branch_head'), config('commanConfig.dyce_jr_user'), config('commanConfig.dyce_deputy_engineer'));

        $status = array(config('commanConfig.applicationStatus.forwarded'), config('commanConfig.applicationStatus.reverted'));

        $dyceRoles = Role::whereIn('name', $roles)->pluck('id');
        $dycelogs = OlApplicationStatus::with(['getRoleName','getRole'])->where('application_id', $applicationId)->whereIn('role_id', $dyceRoles)->whereIn('status_id', $status)->get();

        return $dycelogs;
    }

    public function getLogsOfREEDepartment($applicationId)
    {

        $roles = array(config('commanConfig.ree_junior'), config('commanConfig.ree_branch_head'), config('commanConfig.ree_deputy_engineer'), config('commanConfig.ree_assistant_engineer'));

       $status = array(config('commanConfig.applicationStatus.forwarded'), config('commanConfig.applicationStatus.reverted'));

        $reeRoles = Role::whereIn('name', $roles)->pluck('id');
        $reelogs = OlApplicationStatus::with(['getRoleName','getRole'])->where('application_id', $applicationId)->whereIn('role_id', $reeRoles)->whereIn('status_id', $status)->get();

        return $reelogs;
    }

    public function getLogsOfCODepartment($applicationId)
    {

        $roles = config('commanConfig.co_engineer');

        $status = array(config('commanConfig.applicationStatus.forwarded'), config('commanConfig.applicationStatus.reverted'));

        $coRoles = Role::where('name', $roles)->value('id');
        $cologs = OlApplicationStatus::with(['getRoleName','getRole'])->where('application_id', $applicationId)->where('role_id', $coRoles)->whereIn('status_id', $status)->get();

        return $cologs;
    } 

    public function getLogsOfCAPDepartment($applicationId)
    {

        $roles = config('commanConfig.cap_engineer');

        $status = array(config('commanConfig.applicationStatus.forwarded'), config('commanConfig.applicationStatus.reverted'));

        $capRoles = Role::where('name', $roles)->value('id');
        $caplogs = OlApplicationStatus::with(['getRoleName','getRole'])->where('application_id', $applicationId)->where('role_id', $capRoles)->whereIn('status_id', $status)->get();

        return $caplogs;
    }  

    public function getLogsOfVPDepartment($applicationId)
    {

        $roles = config('commanConfig.vp_engineer');

        $status = array(config('commanConfig.applicationStatus.forwarded'), config('commanConfig.applicationStatus.reverted'));

        $vpRoles = Role::where('name', $roles)->value('id');
        $vplogs = OlApplicationStatus::with(['getRoleName','getRole'])->where('application_id', $applicationId)->where('role_id', $vpRoles)->whereIn('status_id', $status)->get();

        return $vplogs;
    }            

    //check if in layout detail all documents uploaded or not
    public function check_layout_details_complete_status($layout_id)
    {
        $required_details = array();
        $details = ArchitectLayoutDetail::where(['architect_layout_id' => $layout_id])->orderBy('id', 'desc')->with(['cts_plan_details', 'pr_card_details', 'ee_reports', 'em_reports', 'land_reports', 'ree_reports'])->first();
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

            if ($details->dp_letter == "") {
                $required_details[] = "dp letter is required";
            }

            if ($details->dp_plan == "") {
                $required_details[] = "dp plan is required";
            }

            if ($details->crz_letter == "") {
                $required_details[] = "crz letter is required";
            }

            if ($details->crz_plan == "") {
                $required_details[] = "crz plan is required";
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
        $ArchitectLayoutLmScrtinyQuestionMaster = ArchitectLayoutLmScrtinyQuestionMaster::all();
        foreach ($ArchitectLayoutLmScrtinyQuestionMaster as $data) {
            $detail = ArchitectLayoutLmScrtinyQuestionDetail::where(['user_id' => $user_id, 'architect_layout_id' => $layout_id, 'architect_layout_lm_scrunity_question_master_id' => $data->id])->first();
            if ($detail) {

            } else {
                $enter_detail = new ArchitectLayoutLmScrtinyQuestionDetail;
                $enter_detail->user_id = $user_id;
                $enter_detail->architect_layout_id = $layout_id;
                $enter_detail->architect_layout_lm_scrunity_question_master_id = $data->id;
                $enter_detail->save();
            }
        }

        $final_detail = ArchitectLayoutLmScrtinyQuestionDetail::with(['question'])->where(['user_id' => $user_id, 'architect_layout_id' => $layout_id])->get();
        return $final_detail;

    }

    public function get_em_checklist_and_remarks($layout_id, $user_id)
    {
        $ArchitectLayoutLmScrtinyQuestionMaster = ArchitectLayoutEmScrtinyQuestionMaster::all();
        foreach ($ArchitectLayoutLmScrtinyQuestionMaster as $data) {
            $detail = ArchitectLayoutEmScrtinyQuestionDetail::where(['user_id' => $user_id, 'architect_layout_id' => $layout_id, 'architect_layout_em_scrunity_question_master_id' => $data->id])->first();
            if ($detail) {

            } else {
                $enter_detail = new ArchitectLayoutEmScrtinyQuestionDetail;
                $enter_detail->user_id = $user_id;
                $enter_detail->architect_layout_id = $layout_id;
                $enter_detail->architect_layout_em_scrunity_question_master_id = $data->id;
                $enter_detail->save();
            }
        }

        $final_detail = ArchitectLayoutEmScrtinyQuestionDetail::with(['question'])->where(['user_id' => $user_id, 'architect_layout_id' => $layout_id])->get();
        return $final_detail;

    }

    public function get_ee_checklist_and_remarks($layout_id, $user_id)
    {
        $ArchitectLayoutLmScrtinyQuestionMaster = ArchitectLayoutEEScrtinyQuestionMaster::all();
        foreach ($ArchitectLayoutLmScrtinyQuestionMaster as $data) {
            $detail = ArchitectLayoutEEScrtinyQuestionDetail::where(['user_id' => $user_id, 'architect_layout_id' => $layout_id, 'architect_layout_ee_scrunity_question_master_id' => $data->id])->first();
            if ($detail) {

            } else {
                $enter_detail = new ArchitectLayoutEEScrtinyQuestionDetail;
                $enter_detail->user_id = $user_id;
                $enter_detail->architect_layout_id = $layout_id;
                $enter_detail->architect_layout_ee_scrunity_question_master_id = $data->id;
                $enter_detail->save();
            }
        }

        $final_detail = ArchitectLayoutEEScrtinyQuestionDetail::with(['question'])->where(['user_id' => $user_id, 'architect_layout_id' => $layout_id])->get();
        return $final_detail;

    }

    public function get_ree_checklist_and_remarks($layout_id, $user_id)
    {
        $ArchitectLayoutLmScrtinyQuestionMaster = ArchitectLayoutReeScrtinyQuestionMaster::all();
        foreach ($ArchitectLayoutLmScrtinyQuestionMaster as $data) {
            $detail = ArchitectLayoutReeScrtinyQuestionDetail::where(['user_id' => $user_id, 'architect_layout_id' => $layout_id, 'architect_layout_ree_scrunity_question_master_id' => $data->id])->first();
            if ($detail) {

            } else {
                $enter_detail = new ArchitectLayoutReeScrtinyQuestionDetail;
                $enter_detail->user_id = $user_id;
                $enter_detail->architect_layout_id = $layout_id;
                $enter_detail->architect_layout_ree_scrunity_question_master_id = $data->id;
                $enter_detail->save();
            }
        }

        $final_detail = ArchitectLayoutReeScrtinyQuestionDetail::with(['question'])->where(['user_id' => $user_id, 'architect_layout_id' => $layout_id])->get();
        return $final_detail;

    }
}
