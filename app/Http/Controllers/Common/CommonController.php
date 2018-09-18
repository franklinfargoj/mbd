<?php

namespace App\Http\Controllers\Common;

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
use App\User;
use Config;
use Auth;
use DB;

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

        $eeScrutinyData ->consentQuetions = OlConsentVerificationDetails::with('consentQuestions')->where('application_id',$applicationId)->get();

        $eeScrutinyData->DemarkQuetions = OlDemarcationVerificationDetails::with('DemarkQuestions')->where('application_id',$applicationId)->get(); 

        $eeScrutinyData->TitBitQuetions = OlTitBitVerificationDetails::with('TitBitQuestions')->where('application_id',$applicationId)->get(); 

        $eeScrutinyData->relocationQuetions = OlRelocationVerificationDetails::with('relocationQuestions')->where('application_id',$applicationId)->get();  
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

        // $role = User::with(['roles.parent.parentUser'])->where('id', '2')->first();
        // dd($role);
        $applicationData = OlApplication::with(['eeApplicationSociety'])
                ->where('id',$applicationId)->first(); 
                 
        return  $applicationData;
    }                
}
