<?php

namespace App\Listeners;

use App\Events\SmsHitEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SmsHitEventListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  SmsHitEvent  $event
     * @return void
     */
    public function handle(SmsHitEvent $event)
    {
        //dd($event->mobile);
        $curl_handle=curl_init();
        $data=array(
            'loginID'=>config('commanConfig.sms_settings.loginID'),
            'password'=>config('commanConfig.sms_settings.password'),
            'mobile'=>$event->mobile,
            'text'=>$event->sms,
            'senderid'=>config('commanConfig.sms_settings.senderid'),
            'route_id'=>config('commanConfig.sms_settings.route_id'),
            'Unicode'=>config('commanConfig.sms_settings.Unicode'),
            'IP'=>config('commanConfig.sms_settings.IP'),
        );
        curl_setopt($curl_handle,CURLOPT_URL,'http://www.hindit.co.in/API/pushsms.aspx?'.http_build_query($data));
        curl_setopt($curl_handle,CURLOPT_CONNECTTIMEOUT,2);
        curl_setopt($curl_handle,CURLOPT_RETURNTRANSFER,1);
        $buffer = curl_exec($curl_handle);
        curl_close($curl_handle);
        if (empty($buffer)){
            //dd("Nothing returned from url.");
        }
        else{
            //dd($buffer);
        }
    }
}
