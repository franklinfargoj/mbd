<?php

namespace App\Http\Controllers;

use App\OcApplication;
use App\OcApplicationStatusLog;
use App\OlApplicationStatus;
use App\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Common\CommonController;
use Illuminate\Support\Facades\Auth;

class OcDashboardController extends Controller
{
    public function __construct()
    {
        $this->CommonController = new CommonController();
    }



    /*
     * Function for getting dashboard headders along with counts
     *
     * Author: Prajakta Sisale.
     *
     * @return array
     */
    public function getDashboardHeaders(){
        $role_id = session()->get('role_id');

        $user_id = auth()->id();

        $applicationData = $this->getApplicationData($role_id,$user_id);

        $statusCount = $this->getApplicationStatusCount($applicationData);

//        dd(session()->get('role_name'));
//        die('I am here now');

        if( session()->get('role_name') == config('commanConfig.estate_manager')){
            $dashboardData = $this->getEmDashboardData($statusCount);
//            dd($dashboardData);
        }

        if (in_array(session()->get('role_name'), array(config('commanConfig.ree_junior'), config('commanConfig.ree_deputy_engineer'), config('commanConfig.ree_assistant_engineer'), config('commanConfig.ree_branch_head')))) {
            $ree = $this->CommonController->getREERoles();

            $dashboardData = $this->getReeDashboardData($role_id,$ree,$statusCount);
//            dd($dashboardData);
        }

        return view('admin.REE_department.dashboard',compact('dashboardData','dashboardData_head'));
    }

    /*
     * Function for getting counts of pending applicatons at all department
     *
     * Author: Prajakta Sisale.
     *
     * @return array
     */
    public function getTotalCountsOfApplicationsPending(){

        $coRoleData = $this->CommonController->getCORoles();
        $eeRoleData = $this->CommonController->getEERoles();
        $reeRoleData = $this->CommonController->getREERoles();
        $emRoleData = $this->CommonController->getEMRoles();

        $oc_master_ids = config('commanConfig.oc_master_ids');

        $eeTotalPendingCount = $emTotalPendingCount = $reeTotalPendingCount
        = $coTotalPendingCount = 0;

        $eeTotalPendingCount = OcApplicationStatusLog::where('is_active',1)
            ->where('status_id',config('commanConfig.applicationStatus.in_process'))
            ->whereIn('role_id',$eeRoleData)
            ->get()->count();

        $emTotalPendingCount = OcApplicationStatusLog::where('is_active',1)
            ->where('status_id',config('commanConfig.applicationStatus.in_process'))
            ->whereIn('role_id',$emRoleData)
            ->get()->count();


        $reeTotalPendingCount = OcApplicationStatusLog::whereHas('OcApplication', function($q) use ($oc_master_ids){
            $q->whereIn('application_master_id', $oc_master_ids);
        })->where('is_active',1)
            ->whereIn('status_id',[config('commanConfig.applicationStatus.in_process'),config('commanConfig.applicationStatus.OC_Generation'),config('commanConfig.applicationStatus.OC_Approved')])
            ->whereIn('role_id',$reeRoleData)
            ->get()->count();

        $coTotalPendingCount = OcApplicationStatusLog::whereHas('OcApplication', function($q) use ($oc_master_ids){
            $q->whereIn('application_master_id', $oc_master_ids);
        })->where('is_active',1)
            ->whereIn('status_id',[config('commanConfig.applicationStatus.in_process'),config('commanConfig.applicationStatus.OC_Generation')])
            ->where('role_id',$coRoleData)
            ->get()->count();


        $totalPendingApplications = $eeTotalPendingCount + $emTotalPendingCount + $reeTotalPendingCount + $coTotalPendingCount ;

        $dashboardData1 = array();
        $dashboardData1['Total Number of Applications'] = $totalPendingApplications;
        $dashboardData1['Applications Pending at EE Department'] = $eeTotalPendingCount;
        $dashboardData1['Applications Pending at EM'] = $emTotalPendingCount;
        $dashboardData1['Applications Pending at REE'] = $reeTotalPendingCount;
        $dashboardData1['Applications Pending at CO'] = $coTotalPendingCount;

        return $dashboardData1;

    }

    /*
     * Function for getting application data
     *
     * Author: Prajakta Sisale.
     *
     * @return array
     */
    public function getApplicationData($role_id,$user_id){

        $oc_master_ids = config('commanConfig.oc_master_ids');

        $applicationData = OcApplication::with(['applicationLayoutUser', 'oc_application_master', 'eeApplicationSociety', 'ocApplicationStatusForLoginListing' => function ($q) use ($role_id,$user_id) {
            $q->where('user_id', $user_id)
                ->where('role_id', $role_id)
                ->where('society_flag', 0)
//                ->where('is_active',1)
                ->orderBy('id', 'desc');
        }])
            ->whereHas('ocApplicationStatusForLoginListing', function ($q) use ($role_id,$user_id) {
                $q->where('user_id', $user_id)
                    ->where('role_id', $role_id)
                    ->where('society_flag', 0)
//                    ->where('is_active',1)
                    ->orderBy('id', 'desc');
            })->whereIn('application_master_id',$oc_master_ids)->get()->toArray();

        return $applicationData;
    }


    /*
     * Function for getting all the counts as per status
     *
     * Author: Prajakta Sisale.
     *
     * @return array
     */
    public function getApplicationStatusCount($applicationData){

        $totalForwarded  = $totalPending = $send_for_compliance = 0 ;

        $totalApprovedOcButNotIssuedtoSociety = $totalForwardedOcForIssueingToSociety = $totalApprovedOcSentToSociety = $totalOcGenerated = 0;

        $ocApproved = 0;

        foreach($applicationData as $application){
            $phase =  $application['oc_application_status_for_login_listing'][0]['phase'];
            $status = $application['oc_application_status_for_login_listing'][0]['status_id'];

            if($phase == 0){
                switch ( $status )
                {
                    case config('commanConfig.applicationStatus.in_process'): $totalPending += 1; break;
                    case config('commanConfig.applicationStatus.forwarded'): $totalForwarded += 1; break;
                    case config('commanConfig.applicationStatus.reverted'): $send_for_compliance += 1 ; break;
                    default:
                        ; break;
                }
            }
            if($phase == 1){
                switch ( $status )
                {
                    case config('commanConfig.applicationStatus.OC_Generation'): $totalOcGenerated += 1; break;
                    case config('commanConfig.applicationStatus.forwarded'): $totalForwarded += 1; break;
                    case config('commanConfig.applicationStatus.reverted'): $send_for_compliance += 1 ; break;
                    default:
                        ; break;
                }
            }
            if($phase == 2){
                switch ( $status )
                {
                    case config('commanConfig.applicationStatus.OC_Approved'): $totalApprovedOcButNotIssuedtoSociety += 1; break;
                    case config('commanConfig.applicationStatus.forwarded'): $totalForwardedOcForIssueingToSociety+= 1; $ocApproved += 1; break;
                    case config('commanConfig.applicationStatus.sent_to_society'): $totalApprovedOcSentToSociety += 1; break;
                    default:
                        ; break;
                }
            }

        }

        $totalApplication = count($applicationData);
        $count = [
            'totalPending' => $totalPending,
            'totalOcGenerated' => $totalOcGenerated,
            'totalForwarded' => $totalForwarded,
            'totalReverted' => $send_for_compliance,
            'totalApplication' => $totalApplication,
            'totalApprovedOcButNotIssuedtoSociety' => $totalApprovedOcButNotIssuedtoSociety,
            'totalForwardedOcForIssueingToSociety' => $totalForwardedOcForIssueingToSociety,
            'totalApprovedOcSentToSociety' => $totalApprovedOcSentToSociety,
            'ocApproved' => $ocApproved,
        ];

        return $count;

    }


    /*
     * Function for getting REE dashboard headers alongwith the counts
     *
     * Author: Prajakta Sisale.
     *
     * @return array
     */
    public function getREEDashboardData($role_id, $ree, $statusCount)
    {
        switch ($role_id) {
            case ($ree['REE Junior Engineer']):
                $dashboardData['Total Number of Applications'][0] = $statusCount['totalApplication'];
                $dashboardData['Total Number of Applications'][1] = '';

                $dashboardData['Applications Pending'][0] = $statusCount['totalPending'];
                $dashboardData['Applications Pending'][1] = '?submitted_at_from=&submitted_at_to=&update_status='.config('commanConfig.applicationStatus.in_process');

                $dashboardData['OC Generated but Pending for Approval'][0] = $statusCount['totalOcGenerated'];
                $dashboardData['OC Generated but Pending for Approval'][1] = '?submitted_at_from=&submitted_at_to=&update_status='.config('commanConfig.applicationStatus.OC_Generation');

                $dashboardData['OC Sent For Approval to REE Deputy'][0] = $statusCount['totalForwarded'];
                $dashboardData['OC Sent For Approval to REE Deputy'][1] = '?submitted_at_from=&submitted_at_to=&update_status='.config('commanConfig.applicationStatus.forwarded');

                $dashboardData['OC Approved but Not Issued to Society'][0] = $statusCount['totalApprovedOcButNotIssuedtoSociety'];
                $dashboardData['OC Approved but Not Issued to Society'][1] = '?submitted_at_from=&submitted_at_to=&update_status='.config('commanConfig.applicationStatus.OC_Approved');

                $dashboardData['OC Forwarded for Issuing to Society'][0] = $statusCount['totalForwardedOcForIssueingToSociety'];
                $dashboardData['OC Forwarded for Issuing to Society'][1] = '?submitted_at_from=&submitted_at_to=&update_status='.config('commanConfig.applicationStatus.forwarded');

                break;
            case ($ree['REE deputy Engineer']):
                $dashboardData['Total Number of Applications'][0] = $statusCount['totalApplication'];
                $dashboardData['Total Number of Applications'][1] = '';

                $dashboardData['Applications Pending'][0] = $statusCount['totalPending'];
                $dashboardData['Applications Pending'][1] = '?submitted_at_from=&submitted_at_to=&update_status='.config('commanConfig.applicationStatus.in_process');

                $dashboardData['OC Generated but Pending for Approval'][0] = $statusCount['totalOcGenerated'];
                $dashboardData['OC Generated but Pending for Approval'][1] = '?submitted_at_from=&submitted_at_to=&update_status='.config('commanConfig.applicationStatus.OC_Generation');

                $dashboardData['Applications Reverted'][0] = $statusCount['totalReverted'];
                $dashboardData['Applications Reverted'][1] = '?submitted_at_from=&submitted_at_to=&update_status='.config('commanConfig.applicationStatus.reverted');

                $dashboardData['OC Sent For Approval to REE Assistant'][0] = $statusCount['totalForwarded'];
                $dashboardData['OC Sent For Approval to REE Assistant'][1] = '?submitted_at_from=&submitted_at_to=&update_status='.config('commanConfig.applicationStatus.forwarded');

                $dashboardData['OC Approved but Not Issued to Society'][0] = $statusCount['totalApprovedOcButNotIssuedtoSociety'];
                $dashboardData['OC Approved but Not Issued to Society'][1] = '?submitted_at_from=&submitted_at_to=&update_status='.config('commanConfig.applicationStatus.OC_Approved');

                $dashboardData['OC Forwarded for Issuing to Society'][0] = $statusCount['totalForwardedOcForIssueingToSociety'];
                $dashboardData['OC Forwarded for Issuing to Society'][1] = '?submitted_at_from=&submitted_at_to=&update_status='.config('commanConfig.applicationStatus.forwarded');

                break;
            case ($ree['REE Assistant Engineer']):
                $dashboardData['Total Number of Applications'][0] = $statusCount['totalApplication'];
                $dashboardData['Total Number of Applications'][1] = '';

                $dashboardData['Applications Pending'][0] = $statusCount['totalPending'];
                $dashboardData['Applications Pending'][1] = '?submitted_at_from=&submitted_at_to=&update_status='.config('commanConfig.applicationStatus.in_process');

                $dashboardData['OC Generated but Pending for Approval'][0] = $statusCount['totalOcGenerated'];
                $dashboardData['OC Generated but Pending for Approval'][1] = '?submitted_at_from=&submitted_at_to=&update_status='.config('commanConfig.applicationStatus.OC_Generation');

                $dashboardData['Applications Reverted'][0] = $statusCount['totalReverted'];
                $dashboardData['Applications Reverted'][1] = '?submitted_at_from=&submitted_at_to=&update_status='.config('commanConfig.applicationStatus.reverted');

                $dashboardData['OC Sent For Approval to REE Head'][0] = $statusCount['totalForwarded'];
                $dashboardData['OC Sent For Approval to REE Head'][1] = '?submitted_at_from=&submitted_at_to=&update_status='.config('commanConfig.applicationStatus.forwarded');

                $dashboardData['OC Approved but Not Issued to Society'][0] = $statusCount['totalApprovedOcButNotIssuedtoSociety'];
                $dashboardData['OC Approved but Not Issued to Society'][1] = '?submitted_at_from=&submitted_at_to=&update_status='.config('commanConfig.applicationStatus.OC_Approved');

                $dashboardData['OC Forwarded for Issuing to Society'][0] = $statusCount['totalForwardedOcForIssueingToSociety'];
                $dashboardData['OC Forwarded for Issuing to Society'][1] = '?submitted_at_from=&submitted_at_to=&update_status='.config('commanConfig.applicationStatus.forwarded');

                break;
            case ($ree['ree_engineer']):
                $dashboardData['Total Number of Applications'][0] = $statusCount['totalApplication'];
                $dashboardData['Total Number of Applications'][1] = '';

                $dashboardData['Applications Pending'][0] = $statusCount['totalPending'];
                $dashboardData['Applications Pending'][1] = '?submitted_at_from=&submitted_at_to=&update_status='.config('commanConfig.applicationStatus.in_process');

                $dashboardData['OC Generated but Pending for Approval'][0] = $statusCount['totalOcGenerated'];
                $dashboardData['OC Generated but Pending for Approval'][1] = '?submitted_at_from=&submitted_at_to=&update_status='.config('commanConfig.applicationStatus.OC_Generation');

                $dashboardData['Applications Reverted'][0] = $statusCount['totalReverted'];
                $dashboardData['Applications Reverted'][1] = '?submitted_at_from=&submitted_at_to=&update_status='.config('commanConfig.applicationStatus.reverted');

                $dashboardData['OC Sent For Approval to CO'][0] = $statusCount['totalForwarded'];
                $dashboardData['OC Sent For Approval to CO'][1] = '?submitted_at_from=&submitted_at_to=&update_status='.config('commanConfig.applicationStatus.forwarded');

                $dashboardData['OC Approved but Not Issued to Society'][0] = $statusCount['totalApprovedOcButNotIssuedtoSociety'];
                $dashboardData['OC Approved but Not Issued to Society'][1] = '?submitted_at_from=&submitted_at_to=&update_status='.config('commanConfig.applicationStatus.OC_Approved');

                $dashboardData['OC Forwarded for Issuing to Society'][0] = $statusCount['totalForwardedOcForIssueingToSociety'];
                $dashboardData['OC Forwarded for Issuing to Society'][1] = '?submitted_at_from=&submitted_at_to=&update_status='.config('commanConfig.applicationStatus.forwarded');
                
                $dashboardData['Approved Oc Sent To Society'][0] = $statusCount['totalApprovedOcSentToSociety'];
                $dashboardData['Approved Oc Sent To Society'][1] = '?submitted_at_from=&submitted_at_to=&update_status='.config('commanConfig.applicationStatus.sent_to_society');


                break;
            default:
                ;
                break;
        }

        $dashboardData = array($dashboardData/*,$statusCount['separation']*/);

//        dd($dashboardData);
        return $dashboardData;
    }

    /*
     * Function for getting CO dashboard headers alongwith the counts
     *
     * Author: Prajakta Sisale.
     *
     * @return array
     */
    public function getCODashboardData( $statusCount)
    {
        $dashboardData['Total Number of Applications'][0] = $statusCount['totalApplication'];
        $dashboardData['Total Number of Applications'][1] = '';

        $dashboardData['Applications Pending'][0] = $statusCount['totalPending'];
        $dashboardData['Applications Pending'][1] = '?submitted_at_from=&submitted_at_to=&update_status='.config('commanConfig.applicationStatus.in_process');

        $dashboardData['OC Generated but Pending for Approval'][0] = $statusCount['totalOcGenerated'];
        $dashboardData['OC Generated but Pending for Approval'][1] = '?submitted_at_from=&submitted_at_to=&update_status='.config('commanConfig.applicationStatus.OC_Generation');

        $dashboardData['Applications Reverted'][0] = $statusCount['totalReverted'];
        $dashboardData['Applications Reverted'][1] = '?submitted_at_from=&submitted_at_to=&update_status='.config('commanConfig.applicationStatus.reverted');

        $dashboardData['OC Approved & Sent For Issuing to Society'][0] = $statusCount['ocApproved'];
        $dashboardData['OC Approved & Sent For Issuing to Society'][1] = '?submitted_at_from=&submitted_at_to=&update_status='.config('commanConfig.applicationStatus.forwarded');


        $dashboardData = array($dashboardData);

        return $dashboardData;
    }

    /*
     * Function for getting EM dashboard headers alongwith the counts
     *
     * Author: Prajakta Sisale.
     *
     * @return array
     */
    public function getEmDashboardData($statusCount)
    {
        $dashboardData['Total Number of Applications'][0] = $statusCount['totalApplication'];
        $dashboardData['Total Number of Applications'][1] = '';

        $dashboardData['Applications Pending'][0] = $statusCount['totalPending'];
        $dashboardData['Applications Pending'][1] = '?submitted_at_from=&submitted_at_to=&update_status='.config('commanConfig.applicationStatus.in_process');

        $dashboardData['Application forwarded to REE'][0] = $statusCount['totalForwarded'];
        $dashboardData['Application forwarded to REE'][1] = '?submitted_at_from=&submitted_at_to=&update_status='.config('commanConfig.applicationStatus.forwarded');

        $dashboardData = array($dashboardData);
        return $dashboardData;
    }

    /*
     * Function for getting EE dashboard headers alongwith the counts
     *
     * Author: Prajakta Sisale.
     *
     * @return array
     */
    public function getEeDashboardData($role_id,$ee,$statusCount)
    {
        switch ($role_id) {
            case ($ee['ee_junior_engineer']):
                $dashboardData['Total Number of Applications'][0] = $statusCount['totalApplication'];
                $dashboardData['Total Number of Applications'][1] = '';
                $dashboardData['Applications Pending'][0] = $statusCount['totalPending'];
                $dashboardData['Applications Pending'][1] = '?submitted_at_from=&submitted_at_to=&update_status='.config('commanConfig.applicationStatus.in_process');
                $dashboardData['Scrutiny Complete & Send to EE Deputy'][0] = $statusCount['totalForwarded'];
                $dashboardData['Scrutiny Complete & Send to EE Deputy'][1] = '?submitted_at_from=&submitted_at_to=&update_status='.config('commanConfig.applicationStatus.forwarded');
//                $dashboardData['Application Pending'] = '?submitted_at_from=&submitted_at_to=&update_status=4';
                break;
            case ($ee['ee_engineer']):
                $dashboardData['Total Number of Applications'][0] = $statusCount['totalApplication'];
                $dashboardData['Total Number of Applications'][1] = '';
                $dashboardData['Applications Pending'][0] = $statusCount['totalPending'];
                $dashboardData['Applications Pending'][1] = '?submitted_at_from=&submitted_at_to=&update_status='.config('commanConfig.applicationStatus.in_process');
                $dashboardData['Applications Sent for Compliance'][0] = $statusCount['totalReverted'];
                $dashboardData['Applications Sent for Compliance'][1] = '?submitted_at_from=&submitted_at_to=&update_status='.config('commanConfig.applicationStatus.reverted');
                $dashboardData['Scrutiny Complete & Send to REE Junior'][0] = $statusCount['totalForwarded'];
                $dashboardData['Scrutiny Complete & Send to REE Junior'][1] = '?submitted_at_from=&submitted_at_to=&update_status='.config('commanConfig.applicationStatus.forwarded');
                break;
            case ($ee['ee_dy_engineer']):
                $dashboardData['Total Number of Applications'][0] = $statusCount['totalApplication'];
                $dashboardData['Total Number of Applications'][1] = '';
                $dashboardData['Applications Pending'][0] = $statusCount['totalPending'];
                $dashboardData['Applications Pending'][1] = '?submitted_at_from=&submitted_at_to=&update_status='.config('commanConfig.applicationStatus.in_process');
                $dashboardData['Applications Sent for Compliance'][0] = $statusCount['totalReverted'];
                $dashboardData['Applications Sent for Compliance'][1] = '?submitted_at_from=&submitted_at_to=&update_status='.config('commanConfig.applicationStatus.reverted');
                $dashboardData['Scrutiny Complete & Send to EE Head'][0] = $statusCount['totalForwarded'];
                $dashboardData['Scrutiny Complete & Send to EE Head'][1] = '?submitted_at_from=&submitted_at_to=&update_status='.config('commanConfig.applicationStatus.forwarded');
                break;
            default:
                ;
                break;
        }

//
//
//        $dashboardData['Total Number of Applications'][0] = $statusCount['totalApplication'];
//        $dashboardData['Total Number of Applications'][1] = '';
//
//        $dashboardData['Applications Pending'][0] = $statusCount['totalPending'];
//        $dashboardData['Applications Pending'][1] = '?submitted_at_from=&submitted_at_to=&update_status='.config('commanConfig.applicationStatus.in_process');
//
//        $dashboardData['Application forwarded to REE'][0] = $statusCount['totalForwarded'];
//        $dashboardData['Application forwarded to REE'][1] = '?submitted_at_from=&submitted_at_to=&update_status='.config('commanConfig.applicationStatus.forwarded');
//
//        $dashboardData['Application sent for Compliance'][0] = $statusCount['totalForwarded'];
//        $dashboardData['Application Reverted to REE'][1] = '?submitted_at_from=&submitted_at_to=&update_status='.config('commanConfig.applicationStatus.forwarded');
//
        $dashboardData = array($dashboardData);
        return $dashboardData;
    }


}
