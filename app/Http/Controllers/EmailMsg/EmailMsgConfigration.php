<?php

namespace App\Http\Controllers\EmailMsg;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\mailMsgSentDetails;
use App\Events\SmsHitEvent;
use App\OlApplication;
use Config;
use App\User;
use App\Role;
use Mail;
use Hash;
use Auth;

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
            $societyDetails['mail_content'] = $email;
            $societyDetails['mobile_no'] = $mobile;
            $societyDetails['email'] = $emailContent;
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

    // send mail and msg to society on reject offer letter application
    public function RejectApplicationMailMsg($applicationId){
        
        try{
            $applicationData = OlApplication::where('id',$applicationId)->with('ol_application_master','eeApplicationSociety')->first();

            $data = $applicationData->eeApplicationSociety;
            $data['application_no'] = $applicationData->application_no;
            $data['application_type'] = $applicationData->ol_application_master->title."(".$applicationData->ol_application_master->model.")";
            
            $emailSubject = config('commanConfig.email_subject.reject_application');
            $emailSubject = str_replace("<application type>",$data->application_type,$emailSubject);

            $emailContent = config('commanConfig.email_content.reject_application');
            $emailContent = str_replace("<application type>",$data->application_type,$emailContent);
            $emailContent = str_replace("<Society name>",$data->name,$emailContent);
            $emailContent = str_replace("<application Number>",$data->application_no,$emailContent);

            $msgContent = config('commanConfig.msg_content.reject_application');
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
}
