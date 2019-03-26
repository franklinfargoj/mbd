<?php

namespace App\Http\Controllers\EmailMsg;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\mailMsgSentDetails;
use App\Events\SmsHitEvent;
use Config;
use Mail;

class EmailMsgConfigration extends Controller
{
	// send mail and msg at society registration
	public function SocietyRegistrationEmailMsg($societyDetails){
		
		$mobile = $societyDetails['society_contact_no'];
        $content = config('commanConfig.msg_content.society_registration');
        $msgResponse = $this->sendMsg($mobile,$content);

        $email = $societyDetails['society_email'];
        $emailContent = config('commanConfig.email_content.society_registration');
        $emailContent = str_replace("<username>",$email,$emailContent);
        $mailResponse = $this->sendEmail($email,$emailContent);

        $societyDetails['msg_content'] = $content;
        $societyDetails['mail_content'] = $email;
        $societyDetails['mobile_no'] = $mobile;
        $societyDetails['email'] = $emailContent;
        $mailResponse = $this->saveMailMsgSentDetails($societyDetails);
	}

	// send mail and msg at society application submission
	public function ApplicationSubmissionEmailMsg($data){

		$msgContent = config('commanConfig.msg_content.society_submission');
		$msgResponse = $this->sendMsg($data->contact_no,$msgContent);

		$this->sendMailMsgTouser($data->users);
		$this->sendMailMsgToDepartmentHead($data->users);
		// $msgResponse = $this->sendMsg($data->users->mobile_no,$userContent);
	}

	// send email and sms to specific user
	public function sendMailMsgTouser($data){

		$msgContent = config('commanConfig.msg_content.user_application');
		$this->sendMsg($data->mobile_no,$msgContent);
		$mailContent = config('commanConfig.mail_content.user_application');
		$mailResponse = $this->sendEmail($data->email,$mailContent);
	}

	// send email and sms to department head
	public function sendMailMsgToDepartmentHead($data){
		
		$deptHead = $this->getDepartmentHeadDetails($data->id);
		$msgContent = config('commanConfig.msg_content.head_application');
		$this->sendMsg($data->mobile_no,$msgContent);
		$mailContent = config('commanConfig.mail_content.head_application');
		$mailResponse = $this->sendEmail($data->email,$mailContent);
	}

	// get department head details as per user
	public function getDepartmentHeadDetails($userId){
		dd($userId);
	}

	// function to send msg
	private function sendMsg($mobile,$content){
		event(new SmsHitEvent($mobile,$content));
		return 'success';
	}

	// function to send email
    private function sendEmail($email,$emailContent){
        
        $data = array("content" => $emailContent);   
        $a = Mail::send('email/mail_content', $data, function($message) use ($email) {
            $message->to($email)
                    ->subject('Registration on Mumbai board portal');
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
            dd($emailContent);
    }
}
