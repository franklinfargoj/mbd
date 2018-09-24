<?php

namespace App\Http\Controllers\Common;

use App\OlConsentVerificationQuestionMaster;
use App\OlDemarcationVerificationQuestionMaster;
use App\OlRgRelocationVerificationQuestionMaster;
use App\OlTitBitVerificationQuestionMaster;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use App\olSiteVisitDocuments;
use App\OlApplication;
use App\SocietyOfferLetter;
use App\OlSocietyDocumentsStatus;
use App\OlConsentVerificationDetails;
use App\OlDemarcationVerificationDetails;
use App\OlTitBitVerificationDetails;
use App\OlRelocationVerificationDetails;
use App\OlChecklistScrutiny;
use App\OlApplicationStatus;
use App\OlCapNotes;
use App\Role;
use App\User;
use Config;
use Auth;
use DB;
use Carbon\Carbon;

class CommonController extends Controller
{

    // society and EE documents
    public function getSocietyEEDocuments($applicationId){
      
        $societyId = OlApplication::where('id',$applicationId)->value('society_id');       
        $societyDocuments = SocietyOfferLetter::with(['societyDocuments.documents_Name'])->where('id',$societyId)->get();

        return $societyDocuments;
    } 

    // EE - Scrutiny & Remark page
    public function getEEScrutinyRemark($applicationId){

        $eeScrutinyData = OlApplication::with(['eeApplicationSociety.societyDocuments.documents_Name'])
                ->where('id',$applicationId)->first();

        $this->getVerificationDetails($eeScrutinyData,$applicationId);         
        $this->getChecklistDetails($eeScrutinyData,$applicationId);
        return  $eeScrutinyData;                 
    }

    //get all verifivation details submitted by EE
    protected function getVerificationDetails($eeScrutinyData,$applicationId){

//        $eeScrutinyData ->consentQuetions = OlConsentVerificationDetails::with('consentQuestions')->where('application_id',$applicationId)->get();
        $eeScrutinyData->consentQuetions = OlConsentVerificationQuestionMaster::with(['consentDetails' => function($q) use($applicationId){
            $q->where('application_id', $applicationId);
        }])->get();

//        $eeScrutinyData->DemarkQuetions = OlDemarcationVerificationDetails::with('DemarkQuestions')->where('application_id',$applicationId)->get();
        $eeScrutinyData->DemarkQuetions = OlDemarcationVerificationQuestionMaster::with(['demarkDetails' => function($q) use($applicationId){
            $q->where('application_id', $applicationId);
        }])->get();

//        $eeScrutinyData->TitBitQuetions = OlTitBitVerificationDetails::with('TitBitQuestions')->where('application_id',$applicationId)->get();
        $eeScrutinyData->TitBitQuetions = OlTitBitVerificationQuestionMaster::with(['titBitDetails' => function($q) use($applicationId){
            $q->where('application_id', $applicationId);
        }])->get();

//        $eeScrutinyData->relocationQuetions = OlRelocationVerificationDetails::with('relocationQuestions')->where('application_id',$applicationId)->get();
        $eeScrutinyData->relocationQuetions = OlRgRelocationVerificationQuestionMaster::with(['relocationDetails' => function($q) use($applicationId){
            $q->where('application_id', $applicationId);
        }])->get();
    }

    // get all checklist details submitted by EE
    protected function getChecklistDetails($eeScrutinyData,$applicationId){

        $eeScrutinyData->Consent_checklist = OlChecklistScrutiny::where('application_id',$applicationId)->where('verification_type','CONSENT VERIFICATION')->first(); 

        $eeScrutinyData->Demark_checklist = OlChecklistScrutiny::where('application_id',$applicationId)->where('verification_type','DEMARCATION')->first(); 

        $eeScrutinyData->TitBit_checklist = OlChecklistScrutiny::where('application_id',$applicationId)->where('verification_type','TIT BIT')->first(); 

        $eeScrutinyData->Relocation_checklist = OlChecklistScrutiny::where('application_id',$applicationId)->where('verification_type','RG RELOCATION')->first(); 
        
    } 

    // function used to DyCE Scrutiny & Remark page
    public function getDyceScrutinyRemark($applicationId){
                   
        $applicationData = OlApplication::with(['eeApplicationSociety','visitDocuments'])
                            ->where('id',$applicationId)->first();                   

        if(isset($applicationData))                   
        $applicationData->SiteVisitorOfficers = explode(",",$applicationData->site_visit_officers); 

        return  $applicationData; 
    }  

    // Forward Application page
    public function getForwardApplication($applicationId){

        $applicationData = OlApplication::with(['eeApplicationSociety'])
                ->where('id',$applicationId)->first(); 
                 
        return  $applicationData;
    }

    public function listApplicationData($request)
    {
        $applicationData = OlApplication::with(['applicationLayoutUser', 'eeApplicationSociety', 'olApplicationStatusForLoginListing' => function($q){
            $q->where('user_id', Auth::user()->id)
                ->where('role_id', session()->get('role_id'))
                ->where('society_flag', 0)
                ->orderBy('id', 'desc');
        }])
            ->whereHas('olApplicationStatusForLoginListing' ,function($q){
                $q->where('user_id', Auth::user()->id)
                    ->where('role_id', session()->get('role_id'))
                    ->where('society_flag', 0)
                    ->orderBy('id', 'desc');
            })
            ->select()->get();

        $listArray = [];
        if($request->update_status)
        {
            foreach ($applicationData as $app_data)
            {
                if($app_data->olApplicationStatusForLoginListing[0]->status_id == $request->update_status)
                {
                    $listArray[] = $app_data;
                }
            }
        }
        else
        {
            $listArray =  $applicationData;
        }
        return $listArray;
    }

    public function forwardApplicationForm($request)
    {
        if($request->check_status == 1) {
            $forward_application = [[
                'application_id' => $request->applicationId,
                'user_id' => Auth::user()->id,
                'role_id' => session()->get('role_id'),
                'status_id' => config('commanConfig.applicationStatus.forwarded'),
                'to_user_id' => $request->to_user_id,
                'to_role_id' => $request->to_role_id,
                'remark' => $request->remark,
                'created_at' => Carbon::now()
            ],

                [
                    'application_id' => $request->applicationId,
                    'user_id' => $request->to_user_id,
                    'role_id' => $request->to_role_id,
                    'status_id' => config('commanConfig.applicationStatus.in_process'),
                    'to_user_id' => NULL,
                    'to_role_id' => NULL,
                    'remark' => $request->remark,
                    'created_at' => Carbon::now()
                ]
            ];

//            echo "in forward";
//            dd($forward_application);
            OlApplicationStatus::insert($forward_application);
        }
        else{
            $revert_application = [
                [
                    'application_id' => $request->applicationId,
                    'user_id' => Auth::user()->id,
                    'role_id' => session()->get('role_id'),
                    'status_id' => config('commanConfig.applicationStatus.reverted'),
                    'to_user_id' => $request->user_id,
                    'to_role_id' => $request->role_id,
                    'remark' => $request->remark,
                    'created_at' => Carbon::now()
                ],

                [
                    'application_id' => $request->applicationId,
                    'user_id' => $request->user_id,
                    'role_id' => $request->role_id,
                    'status_id' => config('commanConfig.applicationStatus.in_process'),
                    'to_user_id' => NULL,
                    'to_role_id' => NULL,
                    'remark' => $request->remark,
                    'created_at' => Carbon::now()
                ]
            ];
//            echo "in revert";
//            dd($revert_application);
            OlApplicationStatus::insert($revert_application);
        }

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

    public function getForwardApplicationParentData()
    {
        $user = User::with(['roles.parent.parentUser'])->where('id', Auth::user()->id)->first();
        $roles = array_get($user, 'roles');
        $parent = array_get($roles[0], 'parent');
        $arrData['parentData'] = array_get($parent, 'parentUser');
        $arrData['role_name'] = strtoupper(str_replace('_', ' ', $parent['name']));

        return $arrData;
    }

    public function getEEForwardRevertLog($applicationData,$applicationId){
        
        $ee_branch_head = Role::where('name',config('commanConfig.ee_branch_head'))
        ->value('id');
        $ee_jr_user = Role::where('name',config('commanConfig.ee_junior_engineer'))
        ->value('id');
        $applicationData->eeForwardLog = OlApplicationStatus::where('application_id',$applicationId)->where('role_id',$ee_branch_head)->where('status_id', config('commanConfig.applicationStatus.forwarded'))->orderBy('id', 'desc')->first();

        $applicationData->eeRevertLog = OlApplicationStatus::where('application_id',$applicationId)->where('role_id',$ee_jr_user)->where('status_id', config('commanConfig.applicationStatus.reverted'))->where('society_flag',1)->orderBy('id', 'desc')->first();        

       return $applicationData;       
    } 

    public function getDyceForwardRevertLog($applicationData,$applicationId){

        $dyce_branch_head = Role::where('name',config('commanConfig.dyce_branch_head'))
        ->value('id');
        $dyce_jr_user = Role::where('name',config('commanConfig.dyce_jr_user'))
        ->value('id');
        $applicationData->dyceForwardLog = OlApplicationStatus::where('application_id',$applicationId)->where('role_id',$dyce_branch_head)->where('status_id', config('commanConfig.applicationStatus.forwarded'))->orderBy('id', 'desc')->first();

        $applicationData->dyceRevertLog = OlApplicationStatus::where('application_id',$applicationId)->where('role_id',$dyce_jr_user)->where('status_id', config('commanConfig.applicationStatus.reverted'))->orderBy('id', 'desc')->first();                       
       return $applicationData;       
    }  

    public function getREEForwardRevertLog($applicationData,$applicationId){

        $ree_branch_head = Role::where('name',config('commanConfig.ree_branch_head'))
        ->value('id');
        $ree_jr_user = Role::where('name',config('commanConfig.ree_junior'))
        ->value('id');
        $applicationData->reeForwardLog = OlApplicationStatus::where('application_id',$applicationId)->where('role_id',$ree_branch_head)->where('status_id', config('commanConfig.applicationStatus.forwarded'))->orderBy('id', 'desc')->first();

        $applicationData->reeRevertLog = OlApplicationStatus::where('application_id',$applicationId)->where('role_id',$ree_jr_user)->where('status_id', config('commanConfig.applicationStatus.reverted'))->orderBy('id', 'desc')->first();             
       return $applicationData;       
    }

    public function downloadCapNote($applicationId){

        $capNotes = OlCapNotes::where('application_id',$applicationId)->orderBy('id','DESC')->first();
        return $capNotes;
    }              
}
