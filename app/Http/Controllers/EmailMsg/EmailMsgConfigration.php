<?php

namespace App\Http\Controllers\EmailMsg;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\mailMsgSentDetails;
use App\Events\SmsHitEvent;
use Config;
use App\User;
use Mail;

class EmailMsgConfigration extends Controller
{
	// send mail and msg at society registration
	public function SocietyRegistrationEmailMsg($societyDetails){
		
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

	// send mail and msg at society application submission
	public function ApplicationSubmissionEmailMsg($data){

        $msgContent = config('commanConfig.msg_content.society_submission');
        $msgContent = str_replace("<application type>",$data->application_type,$msgContent);
        $msgContent = str_replace("<application number>",$data->application_no,$msgContent);
        // $this->sendMsg($data->contact_no,$msgContent);

        $emailContent = config('commanConfig.email_content.society_submission');
        $emailContent = str_replace("<application type>",$data->application_type,$emailContent);
        $emailContent = str_replace("<Society name>",$data->name,$emailContent);
        $emailContent = str_replace("<application number>",$data->application_no,$emailContent);
        
        $emailSubject = config('commanConfig.email_subject.society_submission');
        $emailSubject = str_replace("<application type>",$data->application_type,$emailSubject);
        // $mailResponse = $this->sendEmail($data->email,$emailContent,$emailSubject);
        
		$this->sendMailMsgTouser($data);
		$this->sendMailMsgToDepartmentHead($data);
		// $msgResponse = $this->sendMsg($data->users->mobile_no,$userContent);
	}

	// send email and sms to specific user 
	public function sendMailMsgTouser($data){

        $userMsgContent = config('commanConfig.msg_content.user_application');
        $userMsgContent = str_replace("<application type>",$data->application_type,$userMsgContent);
        $userMsgContent = str_replace("<Society name>",$data->name,$userMsgContent);
        $userMsgContent = str_replace("<application Number>",$data->application_no,$userMsgContent);

        $userMailContent = config('commanConfig.email_content.user_application');
        $userMailContent = str_replace("<application type>",$data->application_type,$userMailContent);
        $userMailContent = str_replace("<Society name>",$data->name,$userMailContent);
        $userMailContent = str_replace("<application Number>",$data->application_no,$userMailContent);

        $userMailSub = config('commanConfig.email_subject.user_application');
        $userMailSub = str_replace("<application type>",$data->application_type,$userMailSub);

        // $this->sendMsg($data->users->mobile_no,$userMsgContent);
        // $this->sendEmail($data->users->email,$userMailContent,$userMailSub);

        $userData['msg_content'] = $userMsgContent;
        $userData['mail_content'] = $userMailContent;
        $userData['mobile_no'] = $data->users->mobile_no;
        $userData['email'] = $data->users->email;
        $mailResponse = $this->saveMailMsgSentDetails($userData);
	}

	// send email and sms to department head
	public function sendMailMsgToDepartmentHead($data){

		$deptHead = $this->getDepartmentHeadDetails($data->users->id,$data->layout_id);
        // dd()
		$msgContent = config('commanConfig.msg_content.head_application');
		$this->sendMsg($data->mobile_no,$msgContent);
		$mailContent = config('commanConfig.mail_content.head_application');
		$mailResponse = $this->sendEmail($data->email,$mailContent);
	}

	// get department head details as per user
	public function getDepartmentHeadDetails($userId,$layoutId){

        $user = User::with(['roles'])->where('id', $userId)->first();
        $this->getDepartmentHeadName($user->roles[0]->name);
        
        $parentRoleId = $user->roles[0]->parent_id;
        
        $parentUser = User::where('role_id',$parentRoleId)->with(['LayoutUser' => function($q) use($layoutId){
            $q->where('layout_id',$layoutId);
        }])->whereHas('LayoutUser', function($q) use($layoutId) {
           $q->where('layout_id',$layoutId);
        })->first();

        return $parentUser;
	}

    public function getDepartmentHeadName($userName){
        
        if ($userName == config('commanConfig.ree_junior') || $userName == config('commanConfig.ree_junior') || $userName == config('commanConfig.ree_junior')){

        }
    }

	// function to send msg
	private function sendMsg($mobile,$content){
		event(new SmsHitEvent($mobile,$content));
		// return 'success';
	}

	// function to send email
    private function sendEmail($email,$emailContent,$subject){
        
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

    public function abc(){
    	$to_email = 'bhavanasalunkhe145@gmail.com';
    	$emailContent = config('commanConfig.email_content.society_registration');
    	$emailContent = str_replace("<username>",$to_email,$emailContent);
            // dd($emailContent);
    }
}
