<?php

namespace App\Http\Controllers\Tripartite;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Common\CommonController;
use App\OlApplication;
use App\Role;
use App\OlApplicationStatus;

class TripartiteDashboardController extends Controller
{
    public function __construct()
    {
        $this->CommonController = new CommonController();
    }



    /*
     * Function for getting dashboard headders along with counts
     *
     * Author: Amar Prajapati.
     *
     * @return array
     */
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
        if($role_id == $reeHeadId || in_array(auth()->user()->role_id, $co) == true){
            $dashboardData_head = $this->getTotalCountsOfApplicationsPending();
        }

        return view('admin.REE_department.dashboard',compact('dashboardData','dashboardData_head'));
    }

    /*
     * Function for getting counts of pending applicatons
     *
     * Author: Amar Prajapati.
     *
     * @return array
     */
    public function getTotalCountsOfApplicationsPending(){

        $coRoleData = $this->CommonController->getCORoles();
        $laRoleData = $this->CommonController->getLARoles();
        $reeRoleData = $this->CommonController->getREERoles();

        $roles = Role::whereIn('name',[config('commanConfig.co_engineer'), config('commanConfig.legal_advisor')])->pluck('id','name');

        $new_tripartite_master_ids = config('commanConfig.tripartite_master_ids');
        $coTotalPendingCount = OlApplicationStatus::whereHas('OlApplication', function($q) use ($new_tripartite_master_ids){
            $q->whereIn('application_master_id', $new_tripartite_master_ids);
        })->where('is_active', 1)
            ->where('status_id',config('commanConfig.applicationStatus.in_process'))
            ->whereIn('role_id',$coRoleData)
            ->get()->count();

        $laTotalPendingCount = OlApplicationStatus::whereHas('OlApplication', function($q) use ($new_tripartite_master_ids){
            $q->whereIn('application_master_id', $new_tripartite_master_ids);
        })->where('is_active', 1)
            ->where('status_id',config('commanConfig.applicationStatus.in_process'))
            ->whereIn('role_id',$laRoleData)
            ->get()->count();

        $reeTotalPendingCount = OlApplicationStatus::whereHas('OlApplication', function($q) use ($new_tripartite_master_ids){
            $q->whereIn('application_master_id', $new_tripartite_master_ids);
        })->where('is_active', 1)
            ->where('status_id', config('commanConfig.applicationStatus.in_process'))
            ->whereIn('role_id', $reeRoleData)
            ->get()->count();

        $societyTotalPendingCount = OlApplicationStatus::whereHas('OlApplication', function($q) {
            $q->where('is_reverted_to_society', 0)
                ->whereIn('current_status_id', [config('commanConfig.applicationStatus.sent_for_stamp_duty_registration'), config('commanConfig.applicationStatus.approved_tripartite_agreement')]);
        })->where('is_active', 1)
            ->whereIn('status_id', [config('commanConfig.applicationStatus.pending'), config('commanConfig.applicationStatus.approved_tripartite_agreement')])
            ->where('society_flag', 1)
            ->get()->count();

        $totalPendingApplications = $coTotalPendingCount + $laTotalPendingCount + $reeTotalPendingCount + $societyTotalPendingCount;


        $dashboardData1 = array();
        $dashboardData1['Total Number of Applications Pending'] = $totalPendingApplications;
        $dashboardData1['Applications Pending at LA'] = $laTotalPendingCount;
        $dashboardData1['Applications Pending at REE'] = $reeTotalPendingCount;
        $dashboardData1['Applications Pending at CO'] = $coTotalPendingCount;
        $dashboardData1['Applications sent to Society'] = $societyTotalPendingCount;

        return $dashboardData1;
    }

    /*
     * Function for getting application data
     *
     * Author: Amar Prajapati.
     *
     * @return array
     */
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


    /*
     * Function for getting all the counts as per status
     *
     * Author: Amar Prajapati.
     *
     * @return array
     */
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
                    case (config('commanConfig.applicationStatus.forwarded') /*&& $application['drafted_offer_letter']*/) : ($application['ol_application_status'][0]['get_role_name']['name'] == config('commanConfig.co_engineer'))? $totalTripartitieAgreementforwardtoLA +=1 : $totalTripartitieAgreementSentForApproval += 1; break;
                    case config('commanConfig.applicationStatus.approved_tripartite_agreement') : ($application['is_approve_offer_letter'] == 1)? $tripartitieagreementIssuedToSociety +=1 : $tripartitieagreementApprovedNotIssuedToSociety += 1 ; break;
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

        return $count;

    }


    /*
     * Function for getting REE dashboard headers alongwith the counts
     *
     * Author: Amar Prajapati.
     *
     * @return array
     */
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
                $dashboardData['Draft Tripartite Agreement Generated'][1] = '?submitted_at_from=&submitted_at_to=&update_status='.config('commanConfig.applicationStatus.draft_tripartite_agreement');

                $dashboardData['Tripartite Agreement Sent for Approval to REE Deputy'][0] = $statusCount['totalTripartitieAgreementSentForApproval'];
//                $dashboardData['Offer Letter Approved'] = $statusCount['offerLetterApproved'];
                $dashboardData['Tripartite Agreement Sent for Approval to REE Deputy'][1] = '?submitted_at_from=&submitted_at_to=&update_status='.config('commanConfig.applicationStatus.forwarded');

                $dashboardData['Tripartite Agreement Approved but Not Issued to Society'][0] = $statusCount['tripartitieagreementApprovedNotIssuedToSociety'];
                $dashboardData['Tripartite Agreement Approved but Not Issued to Society'][1] = '?submitted_at_from=&submitted_at_to=&update_status='.config('commanConfig.applicationStatus.approved_tripartite_agreement');

                $dashboardData['Tripartite Agreement Forwarded for Issuing to Society'][0] = $statusCount['tripartitieagreementForwardedForIssueingToSociety'];
                $dashboardData['Tripartite Agreement Forwarded for Issuing to Society'][1] = '?submitted_at_from=&submitted_at_to=&update_status='.config('commanConfig.applicationStatus.forwarded');

                $dashboardData['Tripartite Agreement Approved'][0] = $statusCount['tripartitieagreementIssuedToSociety'];
                $dashboardData['Tripartite Agreement Approved'][1] = '?submitted_at_from=&submitted_at_to=&update_status='.config('commanConfig.applicationStatus.approved_tripartite_agreement');

                break;
            case ($ree['REE deputy Engineer']):
                $dashboardData['Total No of Applications'][0] = $statusCount['totalApplication'];
                $dashboardData['Total No of Applications'][1] = '';

                $dashboardData['Applications Pending'][0] = $statusCount['totalPending'];
                $dashboardData['Applications Pending'][1] = 'pending';

                $dashboardData['Proposals Sent For Approval to REE Assistant'][0] = $statusCount['totalForwarded'];
                $dashboardData['Proposals Sent For Approval to REE Assistant'][1] = '?submitted_at_from=&submitted_at_to=&update_status='.config('commanConfig.applicationStatus.forwarded');

                $dashboardData['Draft Tripartite Agreement Generated'][0] = $statusCount['totalDraftTripartitieAgreementGenereated'];
                $dashboardData['Draft Tripartite Agreement Generated'][1] = '?submitted_at_from=&submitted_at_to=&update_status='.config('commanConfig.applicationStatus.draft_tripartite_agreement');

                $dashboardData['Tripartite Agreement Sent for Approval to REE Assistant'][0] = $statusCount['totalTripartitieAgreementSentForApproval'];
                $dashboardData['Tripartite Agreement Sent for Approval to REE Assistant'][1] = '?submitted_at_from=&submitted_at_to=&update_status='.config('commanConfig.applicationStatus.forwarded');

                $dashboardData['Tripartite Agreement Approved but Not Issued to Society'][0] = $statusCount['tripartitieagreementApprovedNotIssuedToSociety'];
                $dashboardData['Tripartite Agreement Approved but Not Issued to Society'][1] = '?submitted_at_from=&submitted_at_to=&update_status='.config('commanConfig.applicationStatus.approved_tripartite_agreement');

                $dashboardData['Tripartite Agreement Forwarded for Issuing to Society'][0] = $statusCount['tripartitieagreementForwardedForIssueingToSociety'];
                $dashboardData['Tripartite Agreement Forwarded for Issuing to Society'][1] = '?submitted_at_from=&submitted_at_to=&update_status='.config('commanConfig.applicationStatus.forwarded');

                $dashboardData['Tripartite Agreement Approved'][0] = $statusCount['tripartitieagreementIssuedToSociety'];
                $dashboardData['Tripartite Agreement Approved'][1] = '?submitted_at_from=&submitted_at_to=&update_status='.config('commanConfig.applicationStatus.approved_tripartite_agreement');

                break;
            case ($ree['REE Assistant Engineer']):
                $dashboardData['Total No of Applications'][0] = $statusCount['totalApplication'];
                $dashboardData['Total No of Applications'][1] = '';

                $dashboardData['Applications Pending'][0] = $statusCount['totalPending'];
                $dashboardData['Applications Pending'][1] = 'pending';

                $dashboardData['Proposals Sent For Approval to REE Head'][0] = $statusCount['totalForwarded'];
                $dashboardData['Proposals Sent For Approval to REE Head'][1] = '?submitted_at_from=&submitted_at_to=&update_status='.config('commanConfig.applicationStatus.forwarded');

                $dashboardData['Draft Tripartite Agreement Generated'][0] = $statusCount['totalDraftTripartitieAgreementGenereated'];
                $dashboardData['Draft Tripartite Agreement Generated'][1] = '?submitted_at_from=&submitted_at_to=&update_status='.config('commanConfig.applicationStatus.draft_tripartite_agreement');

                $dashboardData['Tripartite Agreement Sent for Approval to REE Head'][0] = $statusCount['totalTripartitieAgreementSentForApproval'];
//                $dashboardData['Offer Letter Approved'] = $statusCount['offerLetterApproved'];
                $dashboardData['Tripartite Agreement Sent for Approval to REE Head'][1] = '?submitted_at_from=&submitted_at_to=&update_status='.config('commanConfig.applicationStatus.forwarded');

                $dashboardData['Tripartite Agreement Approved but Not Issued to Society'][0] = $statusCount['tripartitieagreementApprovedNotIssuedToSociety'];
                $dashboardData['Tripartite Agreement Approved but Not Issued to Society'][1] = '?submitted_at_from=&submitted_at_to=&update_status='.config('commanConfig.applicationStatus.approved_tripartite_agreement');

                $dashboardData['Tripartite Agreement Forwarded for Issuing to Society'][0] = $statusCount['tripartitieagreementForwardedForIssueingToSociety'];
                $dashboardData['Tripartite Agreement Forwarded for Issuing to Society'][1] = '?submitted_at_from=&submitted_at_to=&update_status='.config('commanConfig.applicationStatus.forwarded');

                $dashboardData['Tripartite Agreement Approved'][0] = $statusCount['tripartitieagreementIssuedToSociety'];
                $dashboardData['Tripartite Agreement Approved'][1] = '?submitted_at_from=&submitted_at_to=&update_status='.config('commanConfig.applicationStatus.approved_tripartite_agreement');

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
                $dashboardData['Draft Tripartite Agreement Generated'][1] = '?submitted_at_from=&submitted_at_to=&update_status='.config('commanConfig.applicationStatus.draft_tripartite_agreement');

                $dashboardData['Tripartite Agreement Sent for Approval to CO'][0] = $statusCount['totalTripartitieAgreementSentForApproval'];
//                $dashboardData['Offer Letter Approved'] = $statusCount['offerLetterApproved'];
                $dashboardData['Tripartite Agreement Sent for Approval to CO'][1] = '?submitted_at_from=&submitted_at_to=&update_status='.config('commanConfig.applicationStatus.forwarded');

                $dashboardData['Tripartite Agreement Approved but Not Issued to Society'][0] = $statusCount['tripartitieagreementApprovedNotIssuedToSociety'];
                $dashboardData['Tripartite Agreement Approved but Not Issued to Society'][1] = '?submitted_at_from=&submitted_at_to=&update_status='.config('commanConfig.applicationStatus.approved_tripartite_agreement');

                $dashboardData['Tripartite Agreement Forwarded for Issuing to Society'][0] = $statusCount['tripartitieagreementForwardedForIssueingToSociety'];
                $dashboardData['Tripartite Agreement Forwarded for Issuing to Society'][1] = '?submitted_at_from=&submitted_at_to=&update_status='.config('commanConfig.applicationStatus.forwarded');

                $dashboardData['Tripartite Agreement Approved'][0] = $statusCount['tripartitieagreementIssuedToSociety'];
                $dashboardData['Tripartite Agreement Approved'][1] = '?submitted_at_from=&submitted_at_to=&update_status='.config('commanConfig.applicationStatus.approved_tripartite_agreement');

                break;
            default:
                ;
                break;
        }

        $dashboardData = array($dashboardData,$statusCount['separation']);

        return $dashboardData;
    }

    /*
     * Function for getting CO dashboard headers alongwith the counts
     *
     * Author: Amar Prajapati.
     *
     * @return array
     */
    public function getCODashboardData($role_id, $ree, $statusCount)
    {
        $dashboardData['Total No of Applications'][0] = $statusCount['totalApplication'];
        $dashboardData['Total No of Applications'][1] = '';

        $dashboardData['Applications Pending'][0] = $statusCount['totalPending'];
        $dashboardData['Applications Pending'][1] = 'pending';

        $dashboardData['Proposals Sent For Approval'][0] = $statusCount['totalForwarded'];
        $dashboardData['Proposals Sent For Approval'][1] = '?submitted_at_from=&submitted_at_to=&update_status='.config('commanConfig.applicationStatus.in_process');

        $dashboardData['Draft Tripartite Agreement Generated'][0] = $statusCount['totalDraftTripartitieAgreementGenereated'];
        $dashboardData['Draft Tripartite Agreement Generated'][1] = '?submitted_at_from=&submitted_at_to=&update_status='.config('commanConfig.applicationStatus.draft_tripartite_agreement');

        $dashboardData['Tripartite Agreement forwarded to LA'][0] = $statusCount['tripartitie_agreement_forward_to_la'];
        $dashboardData['Tripartite Agreement forwarded to LA'][1] = '?submitted_at_from=&submitted_at_to=&update_status='.config('commanConfig.applicationStatus.forwarded');

        $dashboardData['Agreement Approved'][0] = $statusCount['tripartitieagreementApprovedNotIssuedToSociety'];
        $dashboardData['Agreement Approved'][1] = '?submitted_at_from=&submitted_at_to=&update_status='.config('commanConfig.applicationStatus.approved_tripartite_agreement');

        $dashboardData['Tripartite Agreement Approved but Not Issued to Society'][0] = $statusCount['tripartitieagreementApprovedNotIssuedToSociety'];
        $dashboardData['Tripartite Agreement Approved but Not Issued to Society'][1] = '?submitted_at_from=&submitted_at_to=&update_status='.config('commanConfig.applicationStatus.approved_tripartite_agreement');
//        $dashboardData['Tripartite Agreement Forwarded for Issuing to Society'][0] = $statusCount['tripartitieagreementForwardedForIssueingToSociety'];
//        $dashboardData['Tripartite Agreement Forwarded for Issuing to Society'][1] = '?submitted_at_from=&submitted_at_to=&update_status='.config('commanConfig.applicationStatus.forwarded');

        $dashboardData = array($dashboardData, $statusCount['separation']);

        return $dashboardData;
    }

    /*
     * Function for getting LA dashboard headers alongwith the counts
     *
     * Author: Amar Prajapati.
     *
     * @return array
     */
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
