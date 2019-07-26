<?php

namespace App\Http\Controllers\EmailMsg;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\mailMsgSentDetails;
use App\Events\SmsHitEvent;
use App\NocApplication;
use App\OcApplication;
use App\OlApplication;
use App\conveyance\scApplication;
use Config;
use App\User;
use App\Role;
use Mail;
use Hash;
use Auth;
use DB;

class EmailMsgConfigration extends Controller
{
    public $isEmailActive;
     public function __construct(){
        $this->isEmailActive = env('ACTIVE_EMAIL_INTEGRATION');
     }

	// send mail and msg at society registration
	public function SocietyRegistrationEmailMsg($societyDetails){

        if ($this->isEmailActive == 1){
            $mobile = $societyDetails['society_contact_no'];
            $content = config('commanConfig.msg_content.society_registration');
            $this->sendMsg($mobile,$content);

            $email = $societyDetails['society_email'];
            $emailContent = config('commanConfig.email_content.society_registration');
            $emailContent = str_replace("<username>",$email,$emailContent);

            $emailSubject = config('commanConfig.email_subject.society_registration');
            $mailResponse = $this->sendEmail($email,$emailContent,$emailSubject);

            $societyDetails['msg_content'] = $content;
            $societyDetails['mail_content'] = $emailContent;
            $societyDetails['mobile_no'] = $mobile;
            $societyDetails['email'] = $email;
            $mailResponse = $this->saveMailMsgSentDetails($societyDetails);     
        }
	}

	// send mail and msg at society application submission
	public function ApplicationSubmissionEmailMsg($data){

        if ($this->isEmailActive == 1){
            $msgContent = config('commanConfig.msg_content.society_submission');
            $msgContent = str_replace("<application type>",$data->application_type,$msgContent);
            $msgContent = str_replace("<application number>",$data->application_no,$msgContent);

            $this->sendMsg($data->contact_no,$msgContent);

            $emailContent = config('commanConfig.email_content.society_submission');
            $emailContent = str_replace("<application type>",$data->application_type,$emailContent);
            $emailContent = str_replace("<Society name>",$data->name,$emailContent);
            $emailContent = str_replace("<application number>",$data->application_no,$emailContent);
            
            $emailSubject = config('commanConfig.email_subject.society_submission');
            $emailSubject = str_replace("<application type>",$data->application_type,$emailSubject);
            $mailResponse = $this->sendEmail($data->email,$emailContent,$emailSubject);

    		$this->sendMailMsgTouser($data);
    		$this->sendMailMsgToDepartmentHead($data);
        }
	}

	// send email and sms to specific user 
	public function sendMailMsgTouser($data){
        if (isset($data->users) && count($data->users) > 0){
            $userMsgContent = config('commanConfig.msg_content.user_application');
            $userMsgContent = str_replace("<application type>",$data->application_type,$userMsgContent);
            $userMsgContent = str_replace("<Society name>",$data->name,$userMsgContent);
            $userMsgContent = str_replace("<application Number>",$data->application_no,$userMsgContent);

            $userMailContent = config('commanConfig.email_content.user_application');
            $userMailContent = str_replace("<application type>",$data->application_type,$userMailContent);
            $userMailContent =str_replace("<Society name>",$data->name,$userMailContent);
            $userMailContent=str_replace("<application Number>",$data->application_no,$userMailContent);

            $userMailSub = config('commanConfig.email_subject.user_application');
            $userMailSub = str_replace("<application type>",$data->application_type,$userMailSub);

            foreach($data->users as $user){

                $this->sendMsg($user->mobile_no,$userMsgContent);
                $this->sendEmail($user->email,$userMailContent,$userMailSub);

                $userData['msg_content'] = $userMsgContent;
                $userData['mail_content'] = $userMailContent;
                $userData['mobile_no'] = $user->mobile_no;
                $userData['email'] = $user->email;
                $mailResponse = $this->saveMailMsgSentDetails($userData);
            }
        }
	}

	// send email and sms to department head
	public function sendMailMsgToDepartmentHead($data){
        if (isset($data->users) && count($data->users) > 0){
            $msgContent = config('commanConfig.msg_content.head_application');
            $msgContent = str_replace("<application type>",$data->application_type,$msgContent);
            $msgContent = str_replace("<Society name>",$data->name,$msgContent);
            $msgContent = str_replace("<application Number>",$data->application_no,$msgContent);
            
            $mailContent = config('commanConfig.email_content.head_application');
            $mailContent = str_replace("<application type>",$data->application_type,$mailContent);
            $mailContent = str_replace("<Society name>",$data->name,$mailContent);
            $mailContent = str_replace("<application Number>",$data->application_no,$mailContent);
            
            $emailSub = config('commanConfig.email_subject.head_application');
            $emailSub = str_replace("<application type>",$data->application_type,$emailSub);

            foreach($data->users as $user){
                $deptHead = $this->getDepartmentHeadDetails($user->id,$data->layout_id);
                if ($deptHead != ''){
                    $this->sendMsg($deptHead->mobile_no,$msgContent);
                    $mailResponse = $this->sendEmail($deptHead->email,$mailContent,$emailSub);
                }
            }
        }
	}

	// get department head details as per user
	public function getDepartmentHeadDetails($userId,$layoutId){

        $headUser = '';
        $user = User::with(['roles'])->where('id', $userId)->first();
        $head = $this->getDepartmentHeadName($user->roles[0]->name);
        if ($head != ''){
            $headRoleId = Role::where('name',$head)->value('id');    
            $headUser = User::where('role_id',$headRoleId)->with(['LayoutUser' => function($q) use($layoutId){
                $q->where('layout_id',$layoutId);
            }])->whereHas('LayoutUser', function($q) use($layoutId) {
               $q->where('layout_id',$layoutId);
            })->first();
        }

        return $headUser;
	}

    public function getDepartmentHeadName($userName){
        $head = '';
        if ($userName == config('commanConfig.ee_junior_engineer') || $userName == config('commanConfig.ee_deputy_engineer') || $userName == config('commanConfig.ee_branch_head')){
            $head = config('commanConfig.ee_branch_head');
        }
        else if ($userName == config('commanConfig.dyce_jr_user') || $userName == config('commanConfig.dyce_deputy_engineer') || $userName == config('commanConfig.dyce_branch_head')){
            $head = config('commanConfig.dyce_branch_head');
        }
        else if ($userName == config('commanConfig.ree_junior') || $userName == config('commanConfig.ree_deputy_engineer') || $userName == config('commanConfig.ree_assistant_engineer') || $userName == config('commanConfig.ree_branch_head')){
            $head = config('commanConfig.ree_branch_head');
        }

        return $head;
    }

	// function to send msg
	public function sendMsg($mobile,$content){
		event(new SmsHitEvent($mobile,$content));
	}

	// function to send email
    public function sendEmail($email,$emailContent,$subject){
        
        $data = array("content" => $emailContent);   
        $a = Mail::send('email/mail_content', $data, function($message) use ($email,$subject) {
            $message->to($email)
                    ->subject($subject);
            $message->from('bhavna.salunkhe@neosofttech.com','MHADA');
        });
       return 'success';
    }

    // save details of sent mail and msg
    public function saveMailMsgSentDetails($data){ 
        try{
            $details = new mailMsgSentDetails();
            $details->user_id     = isset($data['user_id']) ? $data['user_id'] : ''; 
            $details->mobile_no   = isset($data['mobile_no']) ? $data['mobile_no'] : ''; 
            $details->msg_content = isset($data['msg_content']) ? $data['msg_content'] : ''; 
            $details->mail_id 	  = isset($data['email']) ? $data['email'] : ''; 
            $details->mail_content= isset($data['mail_content']) ? $data['mail_content'] : ''; 
            $details->status 	  = 1; 
            $details->save();

            $response['status'] = 'success';
            $response['msg']    = 'sms send successfully';

        }catch(Exception $e){
            $response['status'] = 'error';
            $response['msg']    = 'something went wrong.';            
        }

        return response(json_encode($response), 200);
    }

    // get society and offer letter application data
    public function OlSocietyDetails($applicationId) {
        $applicationData = OlApplication::where('id',$applicationId)->with('ol_application_master','eeApplicationSociety')->first();

        $data = $applicationData->eeApplicationSociety;
        $data['application_no'] = $applicationData->application_no;
        $data['application_type'] = $applicationData->ol_application_master->title."(".$applicationData->ol_application_master->model.")";
        return $data;
    }

    // get society and NOC application data
    public function nocSocietyDetails($applicationId) {
        $applicationData = NocApplication::where('id',$applicationId)->with('noc_application_master','eeApplicationSociety')->first();

        $data = $applicationData->eeApplicationSociety;
        $data['application_no'] = $applicationData->application_no;
        $data['application_type'] = $applicationData->noc_application_master->title."(".$applicationData->noc_application_master->model.")";
        return $data;
    }

    // get society and OC application data
    public function ocSocietyDetails($applicationId) {
        $applicationData = OcApplication::where('id',$applicationId)->with('oc_application_master','eeApplicationSociety')->first();

        $data = $applicationData->eeApplicationSociety;
        $data['application_no'] = $applicationData->application_no;
        $data['application_type'] = $applicationData->oc_application_master->title."(".$applicationData->oc_application_master->model.")";
        return $data;
    } 

    // get society and conveyance application data
    public function conveyanceSocietyDetails($applicationId) {
        $applicationData=scApplication::where('id',$applicationId)->with('societyApplication')->first();
        $data = $applicationData->societyApplication;
        $data['application_no'] = $applicationData->application_no;
        $data['application_type'] = "conveyance";
        return $data;
    }

    // send mail and msg to society on reject offer letter application
    public function RejectApplicationMailMsg($applicationId,$type){
        
        try{
            if ($type == 'offer_letter'){
                $data = $this->OlSocietyDetails($applicationId);
            }
            $emailSubject = config('commanConfig.email_subject.reject_society_application');
            $emailSubject=str_replace("<application type>",$data->application_type,$emailSubject);

            $emailContent = config('commanConfig.email_content.reject_society_application');
            $emailContent=str_replace("<application type>",$data->application_type,$emailContent);
            $emailContent = str_replace("<Society name>",$data->name,$emailContent);
            $emailContent=str_replace("<application Number>",$data->application_no,$emailContent);

            $msgContent = config('commanConfig.msg_content.reject_society_application');
            $msgContent = str_replace("<application type>",$data->application_type,$msgContent);
            $msgContent = str_replace("<Society name>",$data->name,$msgContent);
            $msgContent = str_replace("<application Number>",$data->application_no,$msgContent);

            $this->sendEmail($data->email,$emailContent,$emailSubject);
            $this->sendMsg($data->contact_no,$msgContent);
            $data['mobile_no'] = $data->contact_no;
            $data['msg_content'] = $msgContent;
            $data['mail_content'] = $emailContent;
            $this->saveMailMsgSentDetails($data);

            // revert email and sms to head
            $revertEmailSubject = config('commanConfig.email_subject.reject_user_application');
            $revertEmailSubject = str_replace("<application type>",$data->application_type,$revertEmailSubject);

            $revertEmail = config('commanConfig.email_content.reject_user_application');
            $revertEmail = str_replace("<application type>",$data->application_type,$revertEmail);
            $revertEmail = str_replace("<Society name>",$data->name,$revertEmail);
            $revertEmail = str_replace("<application Number>",$data->application_no,$revertEmail);

            $revertMsg = config('commanConfig.msg_content.reject_user_application');
            $revertMsg = str_replace("<application type>",$data->application_type,$revertMsg);
            $revertMsg = str_replace("<Society name>",$data->name,$revertMsg);
            $revertMsg = str_replace("<application Number>",$data->application_no,$revertMsg);

            $this->sendEmail(Auth::user()->email,$revertEmail,$revertEmailSubject);
            $this->sendMsg(Auth::user()->mobile_no,$revertMsg);
            $data['mobile_no'] = Auth::user()->mobile_no;
            $data['email'] = Auth::user()->email;
            $data['msg_content'] = $revertMsg;
            $data['mail_content'] = $revertEmail;
            $this->saveMailMsgSentDetails($data);

            $response['status'] = 'success';

        }catch(Exception $e){
            $response['status'] = 'error';  
        }

        return response(json_encode($response), 200);
    }

        // send mail and msg to society on reject offer letter application
    public function approvalNotificationToSociety($applicationId,$type){
        
        try{
            if ($type == 'offer_letter'){
                $data = $this->OlSocietyDetails($applicationId);
            }else if ($type == 'noc'){
               $data = $this->nocSocietyDetails($applicationId); 
            }
            $emailSubject = config('commanConfig.email_subject.society_approval_application');
            $emailSubject = str_replace("<application type>",$data->application_type,$emailSubject);

            $emailContent = config('commanConfig.email_content.society_approval_application');
            $emailContent = str_replace("<application type>",$data->application_type,$emailContent);
            $emailContent = str_replace("<Society name>",$data->name,$emailContent);
            $emailContent = str_replace("<application Number>",$data->application_no,$emailContent);

            $msgContent = config('commanConfig.msg_content.society_approval_application');
            $msgContent = str_replace("<application type>",$data->application_type,$msgContent);
            $msgContent = str_replace("<Society name>",$data->name,$msgContent);
            $msgContent = str_replace("<application Number>",$data->application_no,$msgContent);

            $this->sendEmail($data->email,$emailContent,$emailSubject);
            $this->sendMsg($data->contact_no,$msgContent);
            $data['mobile_no'] = $data->contact_no;
            $data['msg_content'] = $msgContent;
            $data['mail_content'] = $emailContent;
            $this->saveMailMsgSentDetails($data);

            // approve email and sms to head
            $approvalEmailSubject = config('commanConfig.email_subject.user_approval_application');
            $approvalEmailSubject = str_replace("<application type>",$data->application_type,$approvalEmailSubject);

            $approvalEmail = config('commanConfig.email_content.user_approval_application');
            $approvalEmail = str_replace("<application type>",$data->application_type,$approvalEmail);
            $approvalEmail = str_replace("<Society name>",$data->name,$approvalEmail);
            $approvalEmail = str_replace("<application Number>",$data->application_no,$approvalEmail);

            $approvalMsg = config('commanConfig.msg_content.user_approval_application');
            $approvalMsg = str_replace("<application type>",$data->application_type,$approvalMsg);
            $approvalMsg = str_replace("<Society name>",$data->name,$approvalMsg);
            $approvalMsg = str_replace("<application Number>",$data->application_no,$approvalMsg);

            $this->sendEmail(Auth::user()->email,$approvalEmail,$approvalEmailSubject);
            $this->sendMsg(Auth::user()->mobile_no,$approvalMsg);
            $data['mobile_no'] = Auth::user()->mobile_no;
            $data['email'] = Auth::user()->email;
            $data['msg_content'] = $approvalMsg;
            $data['mail_content'] = $approvalEmail;
            $this->saveMailMsgSentDetails($data);

            $response['status'] = 'success';

        }catch(Exception $e){
            $response['status'] = 'error';  
        }

        return response(json_encode($response), 200);
    }

    // testing purpose
    public function abc(){
        $encrypt_password = 1234;
        $hashed = Hash::make($encrypt_password);
        dd($hashed);

    	$to_email = 'bhavanasalunkhe145@gmail.com';
    	$emailContent = config('commanConfig.email_content.society_registration');
    	$emailContent = str_replace("<username>",$to_email,$emailContent);
            // dd($emailContent);
    }

    // send revert notification by sms nd mail to society
    public function RevetApplicationToSociety($applicationId,$type){
        try{
            if ($this->isEmailActive == 1) {
                if ($type == 'oc_module'){
                    $data = $this->ocSocietyDetails($applicationId);
                }else if ($type == 'conveyance'){
                    $data = $this->conveyanceSocietyDetails($applicationId);
                }
                $emailSubject = config('commanConfig.email_subject.revert_society_application');
                $emailSubject=str_replace("<application type>",$data->application_type,$emailSubject);

                $emailContent = config('commanConfig.email_content.revert_society_application');
                $emailContent=str_replace("<application type>",$data->application_type,$emailContent);
                $emailContent = str_replace("<Society name>",$data->name,$emailContent);
                $emailContent=str_replace("<application Number>",$data->application_no,$emailContent);

                $msgContent = config('commanConfig.msg_content.revert_society_application');
                $msgContent = str_replace("<application type>",$data->application_type,$msgContent);
                $msgContent = str_replace("<Society name>",$data->name,$msgContent);
                $msgContent = str_replace("<application Number>",$data->application_no,$msgContent);

                $this->sendEmail($data->email,$emailContent,$emailSubject);
                $this->sendMsg($data->contact_no,$msgContent);
                $data['mobile_no'] = $data->contact_no;
                $data['msg_content'] = $msgContent;
                $data['mail_content'] = $emailContent;
                $this->saveMailMsgSentDetails($data);

                // revert email and sms to head
                $revertEmailSubject = config('commanConfig.email_subject.revert_application');
                $revertEmailSubject = str_replace("<application type>",$data->application_type,$revertEmailSubject);

                $revertEmail = config('commanConfig.email_content.revert_application');
                $revertEmail = str_replace("<application type>",$data->application_type,$revertEmail);
                $revertEmail = str_replace("<Society name>",$data->name,$revertEmail);
                $revertEmail = str_replace("<application Number>",$data->application_no,$revertEmail);

                $revertMsg = config('commanConfig.msg_content.revert_application');
                $revertMsg = str_replace("<application type>",$data->application_type,$revertMsg);
                $revertMsg = str_replace("<Society name>",$data->name,$revertMsg);
                $revertMsg = str_replace("<application Number>",$data->application_no,$revertMsg);

                $this->sendEmail(Auth::user()->email,$revertEmail,$revertEmailSubject);
                $this->sendMsg(Auth::user()->mobile_no,$revertMsg);
                $data['mobile_no'] = Auth::user()->mobile_no;
                $data['email'] = Auth::user()->email;
                $data['msg_content'] = $revertMsg;
                $data['mail_content'] = $revertEmail;
                $this->saveMailMsgSentDetails($data);

                $response['status'] = 'success';
            }
        }catch(Exception $e){

        }
    }

    //send application for verification to society in conveyance module
    // public function sendVerificationToSociety($applicationId,$type){
    //     DB::beginTransaction();
    //     try{
    //         // $societyUrl = env('APP_URL');
    //         // $url = $societyUrl.'/society_offer_letter';

    //         if ($this->isEmailActive == 1) {
    //             if ($type == 'conveyance'){
    //                 $data = $this->conveyanceSocietyDetails($applicationId);
    //             }

    //             $emailSubject = config('commanConfig.email_subject.verification_society_application');
    //             $emailSubject=str_replace("<application type>",$data->application_type,$emailSubject);

    //             $emailContent = config('commanConfig.email_content.verification_society_application');
    //             $emailContent=str_replace("<application type>",$data->application_type,$emailContent);
    //             $emailContent = str_replace("<Society name>",$data->name,$emailContent);
    //             $emailContent=str_replace("<application Number>",$data->application_no,$emailContent);
    //             // $emailContent=str_replace("<society_link>",'<a href="'.$url.'">Society Login</a>');

    //             // dd($emailContent);
    //             $msgContent = config('commanConfig.msg_content.verification_society_application');
    //             $msgContent = str_replace("<application type>",$data->application_type,$msgContent);
    //             $msgContent = str_replace("<Society name>",$data->name,$msgContent);
    //             $msgContent = str_replace("<application Number>",$data->application_no,$msgContent);
    //             // $msgContent = str_replace("<society_link>",'<a href="'.$url.'">Society Login</a>');
                

    //             $this->sendEmail($data->email,$emailContent,$emailSubject);
    //             $this->sendMsg($data->contact_no,$msgContent);
    //             $data['mobile_no'] = $data->contact_no;
    //             $data['msg_content'] = $msgContent;
    //             $data['mail_content'] = $emailContent;
    //             $this->saveMailMsgSentDetails($data);

    //             //send verification sms and mail to DYCO head

    //             $headEmailSubject = config('commanConfig.email_subject.verification_user_application');
    //             $headEmailSubject = str_replace("<application type>",$data->application_type,$headEmailSubject);

    //             $headEmail = config('commanConfig.email_content.verification_user_application');
    //             $headEmail = str_replace("<application type>",$data->application_type,$headEmail);
    //             $headEmail = str_replace("<Society name>",$data->name,$headEmail);
    //             $headEmail = str_replace("<application Number>",$data->application_no,$headEmail);

    //             $headMsg = config('commanConfig.msg_content.verification_user_application');
    //             $headMsg = str_replace("<application type>",$data->application_type,$headMsg);
    //             $headMsg = str_replace("<Society name>",$data->name,$headMsg);
    //             $headMsg = str_replace("<application Number>",$data->application_no,$headMsg);

    //             $this->sendEmail(Auth::user()->email,$headEmail,$headEmailSubject);
    //             $this->sendMsg(Auth::user()->mobile_no,$headMsg);
    //             $data['mobile_no'] = Auth::user()->mobile_no;
    //             $data['email'] = Auth::user()->email;
    //             $data['msg_content'] = $headMsg;
    //             $data['mail_content'] = $headEmail;
    //             $this->saveMailMsgSentDetails($data);
    //             $response['status'] = 'success';
    //         }
    //         DB::commit();
    //     }catch(Exception $e){
    //         dd($e);
    //         DB::rollback();
    //     }
    // }

    //send application to pay stamp duty to society in conveyance 
    // public function sendStampDutyToSociety($applicationId,$type){
    //     DB::beginTransaction();
    //     try{
    //         // $societyUrl = env('APP_URL');
    //         // $url = $societyUrl.'/society_offer_letter';

    //         if ($this->isEmailActive == 1) {
    //             if ($type == 'conveyance'){
    //                 $data = $this->conveyanceSocietyDetails($applicationId);
    //             }

    //             $emailSubject=config('commanConfig.email_subject.stamp_society_application');
    //             $emailSubject=str_replace("<application type>",$data->application_type,$emailSubject);

    //             $emailContent = config('commanConfig.email_content.stamp_society_application');
    //             $emailContent=str_replace("<application type>",$data->application_type,$emailContent);
    //             $emailContent = str_replace("<Society name>",$data->name,$emailContent);
    //             $emailContent=str_replace("<application Number>",$data->application_no,$emailContent);
    //             // $emailContent=str_replace("<society_link>",'<a href="'.$url.'">Society Login</a>');

    //             $msgContent = config('commanConfig.msg_content.stamp_society_application');
    //             $msgContent = str_replace("<application type>",$data->application_type,$msgContent);
    //             $msgContent = str_replace("<Society name>",$data->name,$msgContent);
    //             $msgContent = str_replace("<application Number>",$data->application_no,$msgContent);
    //             // $msgContent = str_replace("<society_link>",'<a href="'.$url.'">Society Login</a>');
                
    //             $this->sendEmail($data->email,$emailContent,$emailSubject);
    //             $this->sendMsg($data->contact_no,$msgContent);
    //             $data['mobile_no'] = $data->contact_no;
    //             $data['msg_content'] = $msgContent;
    //             $data['mail_content'] = $emailContent;
    //             $this->saveMailMsgSentDetails($data);

    //             //send stamp duty sms and mail to DYCO head

    //             $headEmailSubject = config('commanConfig.email_subject.stamp_user_application');
    //             $headEmailSubject = str_replace("<application type>",$data->application_type,$headEmailSubject);

    //             $headEmail = config('commanConfig.email_content.stamp_user_application');
    //             $headEmail = str_replace("<application type>",$data->application_type,$headEmail);
    //             $headEmail = str_replace("<Society name>",$data->name,$headEmail);
    //             $headEmail = str_replace("<application Number>",$data->application_no,$headEmail);

    //             $headMsg = config('commanConfig.msg_content.stamp_user_application');
    //             $headMsg = str_replace("<application type>",$data->application_type,$headMsg);
    //             $headMsg = str_replace("<Society name>",$data->name,$headMsg);
    //             $headMsg = str_replace("<application Number>",$data->application_no,$headMsg);

    //             $this->sendEmail(Auth::user()->email,$headEmail,$headEmailSubject);
    //             $this->sendMsg(Auth::user()->mobile_no,$headMsg);
    //             $data['mobile_no'] = Auth::user()->mobile_no;
    //             $data['email'] = Auth::user()->email;
    //             $data['msg_content'] = $headMsg;
    //             $data['mail_content'] = $headEmail;
    //             $this->saveMailMsgSentDetails($data);
    //             $response['status'] = 'success';
    //         }
    //         DB::commit();
    //     }catch(Exception $e){
    //         dd($e);
    //         DB::rollback();
    //     }
    // }

    //send application for registration to society in conveyance 
    public function scSendToSociety($applicationId,$module,$type){

        DB::beginTransaction();
        try{
            // $societyUrl = env('APP_URL');
            // $url = $societyUrl.'/society_offer_letter';

            if ($this->isEmailActive == 1) {

                if ($type == 'verify'){
                    $emailSubject=config('commanConfig.email_subject.verification_society_application');
                    $emailContent=config('commanConfig.email_content.verification_society_application');
                    $msgContent = config('commanConfig.msg_content.verification_society_application');
                    $headEmailSubject=config('commanConfig.email_subject.verification_user_application');
                    $headEmail = config('commanConfig.email_content.verification_user_application');
                    $headMsg = config('commanConfig.msg_content.verification_user_application');
                    
                }
                else if ($type == 'stamp'){
                    $emailSubject=config('commanConfig.email_subject.stamp_society_application');
                    $emailContent = config('commanConfig.email_content.stamp_society_application');
                    $msgContent = config('commanConfig.msg_content.stamp_society_application');
                    $headEmailSubject = config('commanConfig.email_subject.stamp_user_application');
                    $headEmail = config('commanConfig.email_content.stamp_user_application');
                    $headMsg = config('commanConfig.msg_content.stamp_user_application');
                    
                }
                else if ($type == 'register'){
                    $emailSubject=config('commanConfig.email_subject.register_society_application');
                    $emailContent = config('commanConfig.email_content.register_society_application');
                    $msgContent = config('commanConfig.msg_content.register_society_application');
                    $headEmailSubject = config('commanConfig.email_subject.register_user_application');
                    $headEmail = config('commanConfig.email_content.register_user_application');
                    $headMsg = config('commanConfig.msg_content.register_user_application');
                    
                }else if ($type == 'final'){
                    $emailSubject=config('commanConfig.email_subject.final_society_application');
                    $emailContent = config('commanConfig.email_content.final_society_application');
                    $msgContent = config('commanConfig.msg_content.final_society_application');
                    $headEmailSubject = config('commanConfig.email_subject.final_user_application');
                    $headEmail = config('commanConfig.email_content.final_user_application');
                    $headMsg = config('commanConfig.msg_content.final_user_application');
                    
                }
                if ($module == 'conveyance'){
                    $data = $this->conveyanceSocietyDetails($applicationId);
                    $emailContent=str_replace('<module>','Society Conveyance',$emailContent);
                    $msgContent=str_replace("<module>",'Society Conveyance',$msgContent);
                    $headEmail=str_replace("<module>",'Society Conveyance',$headEmail);
                    $headMsg=str_replace("<module>",'Society Conveyance',$headMsg);
                }

                $emailSubject=str_replace("<application type>",$data->application_type,$emailSubject);

                $emailContent=str_replace("<application type>",$data->application_type,$emailContent);
                $emailContent = str_replace("<Society name>",$data->name,$emailContent);
                $emailContent=str_replace("<application Number>",$data->application_no,$emailContent);
                // $emailContent=str_replace("<society_link>",'<a href="'.$url.'">Society Login</a>');

                $msgContent = str_replace("<application type>",$data->application_type,$msgContent);
                $msgContent = str_replace("<Society name>",$data->name,$msgContent);
                $msgContent = str_replace("<application Number>",$data->application_no,$msgContent);
                // $msgContent = str_replace("<society_link>",'<a href="'.$url.'">Society Login</a>');

                $this->sendEmail($data->email,$emailContent,$emailSubject);
                $this->sendMsg($data->contact_no,$msgContent);
                $data['mobile_no'] = $data->contact_no;
                $data['msg_content'] = $msgContent;
                $data['mail_content'] = $emailContent;
                $this->saveMailMsgSentDetails($data);

                //send stamp duty sms and mail to DYCO head
                
                $headEmailSubject = str_replace("<application type>",$data->application_type,$headEmailSubject);
                
                $headEmail = str_replace("<application type>",$data->application_type,$headEmail);
                $headEmail = str_replace("<Society name>",$data->name,$headEmail);
                $headEmail = str_replace("<application Number>",$data->application_no,$headEmail);

                $headMsg = str_replace("<application type>",$data->application_type,$headMsg);
                $headMsg = str_replace("<Society name>",$data->name,$headMsg);
                $headMsg = str_replace("<application Number>",$data->application_no,$headMsg);

                $this->sendEmail(Auth::user()->email,$headEmail,$headEmailSubject);
                $this->sendMsg(Auth::user()->mobile_no,$headMsg);
                $data['mobile_no'] = Auth::user()->mobile_no;
                $data['email'] = Auth::user()->email;
                $data['msg_content'] = $headMsg;
                $data['mail_content'] = $headEmail;
                $this->saveMailMsgSentDetails($data);
                $response['status'] = 'success';
            }
            DB::commit();
        }catch(Exception $e){
            dd($e);
            DB::rollback();
        }
    }
}    
