<?php

namespace App\Http\Controllers\Tripartite;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\OlApplication;

class TripartiteDashboardController extends Controller
{
    public function getDashboardHeaders(){
        $role_id = session()->get('role_id');

        $user_id = auth()->id();

        $applicationData = $this->getApplicationData($role_id,$user_id);

        $statusCount = $this->getApplicationStatusCount($applicationData);
        dd($applicationData);

        // REE Roles
        $ree = $this->CommonController->getREERoles();

        $dashboardData = $this->getREEDashboardData($role_id,$ree,$statusCount);

        // Reval status Count
        $revalDashboardData = $this->getREEDashboardData($role_id,$ree,$revalStatusCount);

        $reeHeadId = Role::where('name',config('commanConfig.ree_branch_head'))->value('id');

        $dashboardData1 = NULL;
        if($role_id == $reeHeadId){
            $dashboardData1 = $this->CommonController->getTotalCountsOfApplicationsPending();
        }

        // Reval Dashboard data
        $revalDashboardData1 = NULL;
        if($role_id == $reeHeadId){
            $revalDashboardData1 = $this->CommonController->getTotalCountsOfRevalApplicationsPending();
        }

        //Noc dashboard -- Sayan

        $nocModuleController = new SocietyNocController();
        $nocApplication = $nocModuleController->getApplicationListDashboard('REE');

        //Noc for CC dashboard -- Sayan

        $nocforCCModuleController = new SocietyNocforCCController();
        $nocforCCApplication = $nocforCCModuleController->getApplicationListDashboard('REE');

        return view('admin.REE_department.dashboard',compact('dashboardData','dashboardData1','revalDashboardData1','nocApplication','nocforCCApplication','revalDashboardData'));
    }

    public function getApplicationData($role_id,$user_id){

        $new_offer_letter_master_ids = config('commanConfig.tripartite_master_ids');

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


    public function getApplicationStatusCount($applicationData){

        $totalForwarded = $totalReverted = $totalPending = $totalInProcess = $inProcess = 0 ;

        $totalDraftTripartitieAgreementGenereated = $totalTripartitieAgreementSentForApproval = $tripartiteagreementGeneration = 0 ;

        $tripartitieagreementApprovedNotIssuedToSociety = $offerLetterIssuedToSociety = $offerLetterForwardedForIssueingToSociety = 0;

        foreach ($applicationData as $application){
//            echo "<pre>";
//            print_r($application);

            $phase =  $application['ol_application_status'][0]['phase'];
            $status = $application['ol_application_status'][0]['status_id'];
//            print_r($status);
//            echo '=====';
            if($phase == 0){
                switch ( $status )
                {
                    case config('commanConfig.applicationStatus.in_process'): $totalPending += 1; $inProcess += 1; break;
                    case config('commanConfig.applicationStatus.forwarded'): $totalForwarded += 1; break;
                    case config('commanConfig.applicationStatus.reverted'): $totalReverted += 1 ; break;
                    default:
                        ; break;
                }
            }
            if($phase == 1){
                switch ( $status )
                {
                    case config('commanConfig.applicationStatus.offer_letter_generation'): $totalPending += 1; $offerLetterGeneration += 1; break;
                    case (config('commanConfig.applicationStatus.forwarded') /*&& $application['drafted_offer_letter']*/) : $totalOfferLetterSentForApproval += 1; break;
                    case config('commanConfig.applicationStatus.draft_offer_letter_generated') : $totalDraftOfferLetterGenereated += 1 ; break;
                    default:
                        ; break;
                }
            }
            if($phase == 2){
                switch ( $status )
                {

                    case config('commanConfig.applicationStatus.forwarded'): $offerLetterForwardedForIssueingToSociety += 1; break;
                    case config('commanConfig.applicationStatus.offer_letter_approved'): $offerLetterApprovedNotIssuedToSociety += 1; break;
                    case config('commanConfig.applicationStatus.sent_to_society'): $offerLetterIssuedToSociety += 1; break;
                    default:
                        ; break;
                }
            }

        }

        $totalApplication = count($applicationData);

        $count = ['totalPending' => $totalPending,
            'totalForwarded' => $totalForwarded,
            'totalReverted' => $totalReverted,
            'totalApplication' => $totalApplication,
            'totalDraftOfferLetterGenereated' => $totalDraftOfferLetterGenereated,
            'totalOfferLetterSentForApproval' => $totalOfferLetterSentForApproval,
//            'offerLetterApproved' => $offerLetterApproved,
            'offerLetterApprovedNotIssuedToSociety' => $offerLetterApprovedNotIssuedToSociety,
            'offerLetterIssuedToSociety' => $offerLetterIssuedToSociety,
            'offerLetterForwardedForIssueingToSociety' => $offerLetterForwardedForIssueingToSociety,
            'sepeartion'=> ['Total Pending Applications'=> $inProcess,
                'Total Pending Proposals'=> $offerLetterGeneration],
        ];
        return $count;

    }
}
