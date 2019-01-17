<?php

namespace App\Http\Controllers\Tripartite;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Common\CommonController;
use App\OlApplication;
use App\Role;

class TripartiteDashboardController extends Controller
{
    public function __construct()
    {
        $this->CommonController = new CommonController();
        $this->list_num_of_records_per_page = config('commanConfig.list_num_of_records_per_page');
        $this->society_level_billing = config('commanConfig.SOCIETY_LEVEL_BILLING');
    }



    public function getDashboardHeaders(){
        $role_id = session()->get('role_id');

        $user_id = auth()->id();

        $applicationData = $this->getApplicationData($role_id,$user_id);

        $statusCount = $this->getApplicationStatusCount($applicationData);

        // REE Roles
        $ree = $this->CommonController->getREERoles();
        $co = $this->CommonController->getCORoles();
        $co = $co->toArray();
        $la = $this->CommonController->getLARoles();
        $la = $la->toArray();

        $reeHeadId = NULL;

        if(in_array(auth()->user()->role_id, $la) == true){
            $dashboardData = $this->getLADashboardData($role_id, $co, $statusCount);
        }

        if(in_array(auth()->user()->role_id, $co) == true){
            $dashboardData = $this->getCODashboardData($role_id, $co, $statusCount);
        }

        if(in_array(auth()->user()->role_id, $ree) == true){
            $dashboardData = $this->getREEDashboardData($role_id, $ree, $statusCount);
            $reeHeadId = Role::where('name',config('commanConfig.ree_branch_head'))->value('id');
        }

        $dashboardData_head = NULL;

        if($role_id == $reeHeadId){
            $dashboardData_head = $this->CommonController->getTotalCountsOfApplicationsPending();
        }
        //Noc dashboard -- Sayan

//        $nocModuleController = new SocietyNocController();
//        $nocApplication = $nocModuleController->getApplicationListDashboard('REE');

//        dd($dashboardData);
        //Noc for CC dashboard -- Sayan

//        $nocforCCModuleController = new SocietyNocforCCController();
//        $nocforCCApplication = $nocforCCModuleController->getApplicationListDashboard('REE');
        return view('admin.REE_department.dashboard',compact('dashboardData','dashboardData_head'));
    }

    public function getApplicationData($role_id,$user_id){

        $new_offer_letter_master_ids = config('commanConfig.tripartite_master_ids');
        $applicationData = OlApplication::with([
            'olApplicationStatus' => function ($q) use ($role_id,$user_id) {
                $q->with(['getRoleName'])->where('user_id', $user_id)
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

        $totalForwarded = $totalReverted = $totalPending = $totalInProcess = $inProcess = $send_for_compliance = 0 ;
        $totalDraftTripartitieAgreementGenereated = $totalTripartitieAgreementSentForApproval = $tripartiteagreementGeneration = 0 ;

        $tripartitieagreementApprovedNotIssuedToSociety = $tripartitieagreementIssuedToSociety = $tripartitieagreementForwardedForIssueingToSociety = $totalTripartitieAgreementforwardtoLA = 0;

        foreach ($applicationData as $application){

            $phase =  $application['ol_application_status'][0]['phase'];
            $status = $application['ol_application_status'][0]['status_id'];

            if($phase == 0){
                switch ( $status )
                {
                    case config('commanConfig.applicationStatus.in_process'): $totalPending += 1; $inProcess += 1; break;
                    case config('commanConfig.applicationStatus.forwarded'): $totalForwarded += 1; break;
                    case config('commanConfig.applicationStatus.reverted'): $totalReverted += 1 ; break;
                    case config('commanConfig.applicationStatus.sent_for_stamp_duty_registration'): $send_for_compliance += 1 ; break;
                    default:
                        ; break;
                }
            }

            if($phase == 1){
                switch ( $status )
                {
                    case config('commanConfig.applicationStatus.in_process'): $totalPending += 1; $tripartiteagreementGeneration += 1; break;
                    case (config('commanConfig.applicationStatus.forwarded') /*&& $application['drafted_offer_letter']*/) : ($application['ol_application_status'][0]['get_role_name']['name'] == config('commanConfig.legal_advisor'))? $totalTripartitieAgreementforwardtoLA +=1 : $totalForwarded +=1 ; $totalTripartitieAgreementSentForApproval += 1; break;
                    case config('commanConfig.applicationStatus.approved_tripartite_agreement') : $totalDraftTripartitieAgreementGenereated += 1 ; break;
                    case config('commanConfig.applicationStatus.sent_for_stamp_duty_registration'): $send_for_compliance += 1 ; break;
                    default:
                        ; break;
                }
            }

        }

        $totalApplication = count($applicationData);

        $count = [
            'totalPending' => $totalPending,
            'totalForwarded' => $totalForwarded,
            'totalReverted' => $totalReverted,
            'totalApplication' => $totalApplication,
            'totalDraftTripartitieAgreementGenereated' => $totalDraftTripartitieAgreementGenereated,
            'totalTripartitieAgreementSentForApproval' => $totalTripartitieAgreementSentForApproval,
            'tripartitieagreementApprovedNotIssuedToSociety' => $tripartitieagreementApprovedNotIssuedToSociety,
            'tripartitieagreementIssuedToSociety' => $tripartitieagreementIssuedToSociety,
            'tripartitieagreementForwardedForIssueingToSociety' => $tripartitieagreementForwardedForIssueingToSociety,
            'tripartitie_agreement_sent_for_compliance_to_society' => $send_for_compliance,
            'tripartitie_agreement_forward_to_la' => $totalTripartitieAgreementforwardtoLA,
            'separation'=> [
                'Total Pending Applications'=> $totalPending,
                'Total Pending Proposals'=> $totalTripartitieAgreementSentForApproval
            ],
        ];

//        dd($count);
        return $count;

    }


    public function getREEDashboardData($role_id, $ree, $statusCount)
    {
        switch ($role_id) {
            case ($ree['REE Junior Engineer']):
                $dashboardData['Total No of Applications'][0] = $statusCount['totalApplication'];
                $dashboardData['Total No of Applications'][1] = '';

                $dashboardData['Applications Pending'][0] = $statusCount['totalPending'];
                $dashboardData['Applications Pending'][1] = 'pending';

                $dashboardData['Proposals Sent For Approval to REE Deputy'][0] = $statusCount['totalForwarded'];
                $dashboardData['Proposals Sent For Approval to REE Deputy'][1] = '?submitted_at_from=&submitted_at_to=&update_status='.config('commanConfig.applicationStatus.forwarded');

                $dashboardData['Draft Tripartite Agreement Generated'][0] = $statusCount['totalDraftTripartitieAgreementGenereated'];
                $dashboardData['Draft Tripartite Agreement Generated'][1] = '?submitted_at_from=&submitted_at_to=&update_status='.config('commanConfig.applicationStatus.draft_tripartite_generated');

                $dashboardData['Tripartite Agreement Sent for Approval to REE Deputy'][0] = $statusCount['totalTripartitieAgreementSentForApproval'];
//                $dashboardData['Offer Letter Approved'] = $statusCount['offerLetterApproved'];
                $dashboardData['Tripartite Agreement Sent for Approval to REE Deputy'][1] = '?submitted_at_from=&submitted_at_to=&update_status='.config('commanConfig.applicationStatus.forwarded');

                $dashboardData['Tripartite Agreement Approved but Not Issued to Society'][0] = $statusCount['tripartitieagreementApprovedNotIssuedToSociety'];
                $dashboardData['Tripartite Agreement Approved but Not Issued to Society'][1] = '?submitted_at_from=&submitted_at_to=&update_status='.config('commanConfig.applicationStatus.draft_tripartite_approved');

                $dashboardData['Tripartite Agreement Forwarded for Issuing to Society'][0] = $statusCount['tripartitieagreementForwardedForIssueingToSociety'];
                $dashboardData['Tripartite Agreement Forwarded for Issuing to Society'][1] = '?submitted_at_from=&submitted_at_to=&update_status='.config('commanConfig.applicationStatus.forwarded');

                break;
            case ($ree['REE deputy Engineer']):
                $dashboardData['Total No of Applications'][0] = $statusCount['totalApplication'];
                $dashboardData['Total No of Applications'][1] = '';

                $dashboardData['Applications Pending'][0] = $statusCount['totalPending'];
                $dashboardData['Applications Pending'][1] = 'pending';

                $dashboardData['Proposals Sent For Approval to REE Assistant'][0] = $statusCount['totalForwarded'];
                $dashboardData['Proposals Sent For Approval to REE Assistant'][1] = '?submitted_at_from=&submitted_at_to=&update_status='.config('commanConfig.applicationStatus.forwarded');

                $dashboardData['Draft Tripartite Agreement Generated'][0] = $statusCount['totalDraftTripartitieAgreementGenereated'];
                $dashboardData['Draft Tripartite Agreement Generated'][1] = '?submitted_at_from=&submitted_at_to=&update_status='.config('commanConfig.applicationStatus.draft_tripartite_generated');

                $dashboardData['Tripartite Agreement Sent for Approval to REE Assistant'][0] = $statusCount['totalTripartitieAgreementSentForApproval'];
                $dashboardData['Tripartite Agreement Sent for Approval to REE Assistant'][1] = '?submitted_at_from=&submitted_at_to=&update_status='.config('commanConfig.applicationStatus.forwarded');

                $dashboardData['Tripartite Agreement Approved but Not Issued to Society'][0] = $statusCount['tripartitieagreementApprovedNotIssuedToSociety'];
                $dashboardData['Tripartite Agreement Approved but Not Issued to Society'][1] = '?submitted_at_from=&submitted_at_to=&update_status='.config('commanConfig.applicationStatus.draft_tripartite_approved');

                $dashboardData['Tripartite Agreement Forwarded for Issuing to Society'][0] = $statusCount['tripartitieagreementForwardedForIssueingToSociety'];
                $dashboardData['Tripartite Agreement Forwarded for Issuing to Society'][1] = '?submitted_at_from=&submitted_at_to=&update_status='.config('commanConfig.applicationStatus.forwarded');

                break;
            case ($ree['REE Assistant Engineer']):
                $dashboardData['Total No of Applications'][0] = $statusCount['totalApplication'];
                $dashboardData['Total No of Applications'][1] = '';

                $dashboardData['Applications Pending'][0] = $statusCount['totalPending'];
                $dashboardData['Applications Pending'][1] = 'pending';

                $dashboardData['Proposals Sent For Approval to REE Head'][0] = $statusCount['totalForwarded'];
                $dashboardData['Proposals Sent For Approval to REE Head'][1] = '?submitted_at_from=&submitted_at_to=&update_status='.config('commanConfig.applicationStatus.forwarded');

                $dashboardData['Draft Tripartite Agreement Generated'][0] = $statusCount['totalDraftTripartitieAgreementGenereated'];
                $dashboardData['Draft Tripartite Agreement Generated'][1] = '?submitted_at_from=&submitted_at_to=&update_status='.config('commanConfig.applicationStatus.draft_tripartite_generated');

                $dashboardData['Tripartite Agreement Sent for Approval to REE Head'][0] = $statusCount['totalTripartitieAgreementSentForApproval'];
//                $dashboardData['Offer Letter Approved'] = $statusCount['offerLetterApproved'];
                $dashboardData['Tripartite Agreement Sent for Approval to REE Head'][1] = '?submitted_at_from=&submitted_at_to=&update_status='.config('commanConfig.applicationStatus.forwarded');

                $dashboardData['Tripartite Agreement Approved but Not Issued to Society'][0] = $statusCount['tripartitieagreementApprovedNotIssuedToSociety'];
                $dashboardData['Tripartite Agreement Approved but Not Issued to Society'][1] = '?submitted_at_from=&submitted_at_to=&update_status='.config('commanConfig.applicationStatus.draft_tripartite_approved');

                $dashboardData['Tripartite Agreement Forwarded for Issuing to Society'][0] = $statusCount['tripartitieagreementForwardedForIssueingToSociety'];
                $dashboardData['Tripartite Agreement Forwarded for Issuing to Society'][1] = '?submitted_at_from=&submitted_at_to=&update_status='.config('commanConfig.applicationStatus.forwarded');

                break;
            case ($ree['ree_engineer']):
                $dashboardData['Total No of Applications'][0] = $statusCount['totalApplication'];
                $dashboardData['Total No of Applications'][1] = '';

                $dashboardData['Applications Pending'][0] = $statusCount['totalPending'];
                $dashboardData['Applications Pending'][1] = 'pending';

                $dashboardData['Application Sent for Compliance to Society'][0] = $statusCount['tripartitie_agreement_sent_for_compliance_to_society'];
                $dashboardData['Application Sent for Compliance to Society'][1] = '?submitted_at_from=&submitted_at_to=&update_status='.config('commanConfig.applicationStatus.forwarded');

                $dashboardData['Proposals Sent For Approval to CO'][0] = $statusCount['totalForwarded'];
                $dashboardData['Proposals Sent For Approval to CO'][1] = '?submitted_at_from=&submitted_at_to=&update_status='.config('commanConfig.applicationStatus.forwarded');

                $dashboardData['Draft Tripartite Agreement Generated'][0] = $statusCount['totalDraftTripartitieAgreementGenereated'];
                $dashboardData['Draft Tripartite Agreement Generated'][1] = '?submitted_at_from=&submitted_at_to=&update_status='.config('commanConfig.applicationStatus.draft_tripartite_generated');

                $dashboardData['Tripartite Agreement Sent for Approval to CO'][0] = $statusCount['totalTripartitieAgreementSentForApproval'];
//                $dashboardData['Offer Letter Approved'] = $statusCount['offerLetterApproved'];
                $dashboardData['Tripartite Agreement Sent for Approval to CO'][1] = '?submitted_at_from=&submitted_at_to=&update_status='.config('commanConfig.applicationStatus.forwarded');

                $dashboardData['Tripartite Agreement Approved but Not Issued to Society'][0] = $statusCount['tripartitieagreementApprovedNotIssuedToSociety'];
                $dashboardData['Tripartite Agreement Approved but Not Issued to Society'][1] = '?submitted_at_from=&submitted_at_to=&update_status='.config('commanConfig.applicationStatus.draft_tripartite_approved');

                $dashboardData['Tripartite Agreement Forwarded for Issuing to Society'][0] = $statusCount['tripartitieagreementForwardedForIssueingToSociety'];
                $dashboardData['Tripartite Agreement Forwarded for Issuing to Society'][1] = '?submitted_at_from=&submitted_at_to=&update_status='.config('commanConfig.applicationStatus.forwarded');

                break;
            default:
                ;
                break;
        }

        $dashboardData = array($dashboardData,$statusCount['separation']);

        return $dashboardData;
    }

    public function getCODashboardData($role_id, $ree, $statusCount)
    {
        $dashboardData['Total No of Applications'][0] = $statusCount['totalApplication'];
        $dashboardData['Total No of Applications'][1] = '';

        $dashboardData['Applications Pending'][0] = $statusCount['totalPending'];
        $dashboardData['Applications Pending'][1] = 'pending';

        $dashboardData['Proposals Sent For Approval'][0] = $statusCount['totalForwarded'];
        $dashboardData['Proposals Sent For Approval'][1] = '?submitted_at_from=&submitted_at_to=&update_status='.config('commanConfig.applicationStatus.forwarded');

        $dashboardData['Draft Tripartite Agreement Generated'][0] = $statusCount['totalDraftTripartitieAgreementGenereated'];
        $dashboardData['Draft Tripartite Agreement Generated'][1] = '?submitted_at_from=&submitted_at_to=&update_status='.config('commanConfig.applicationStatus.draft_tripartite_generated');

        $dashboardData['Tripartite Agreement forwarded to LA'][0] = $statusCount['tripartitie_agreement_forward_to_la'];
        $dashboardData['Tripartite Agreement forwarded to LA'][1] = '?submitted_at_from=&submitted_at_to=&update_status='.config('commanConfig.applicationStatus.forwarded');

        $dashboardData['Agreement Approved'][0] = $statusCount['tripartitieagreementApprovedNotIssuedToSociety'];
        $dashboardData['Agreement Approved'][1] = '?submitted_at_from=&submitted_at_to=&update_status='.config('commanConfig.applicationStatus.draft_tripartite_approved');

//        $dashboardData['Tripartite Agreement Forwarded for Issuing to Society'][0] = $statusCount['tripartitieagreementForwardedForIssueingToSociety'];
//        $dashboardData['Tripartite Agreement Forwarded for Issuing to Society'][1] = '?submitted_at_from=&submitted_at_to=&update_status='.config('commanConfig.applicationStatus.forwarded');

        $dashboardData = array($dashboardData, $statusCount['separation']);

        return $dashboardData;
    }

    public function getLADashboardData($role_id, $ree, $statusCount)
    {
        $dashboardData['Total No of Applications'][0] = $statusCount['totalApplication'];
        $dashboardData['Total No of Applications'][1] = '';

        $dashboardData['Applications Pending'][0] = $statusCount['totalPending'];
        $dashboardData['Applications Pending'][1] = 'pending';

        $dashboardData['Application forwarded to CO'][0] = $statusCount['totalForwarded'];
        $dashboardData['Application forwarded to CO'][1] = '?submitted_at_from=&submitted_at_to=&update_status='.config('commanConfig.applicationStatus.forwarded');

        $dashboardData = array($dashboardData, $statusCount['separation']);

        return $dashboardData;
    }
}
