<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\frontenUser\RegisterRequest;
use App\FrontendUser;
use App\RtiForm;
use Session;

class FrontendRegisterController extends Controller
{
  public function showRegisterForm()
  {
    return view('frontend_user_register');
  }

  public function frontendRegister(RegisterRequest $request)
  {
        $email    = $request->get('email');
        $mobileNo = $request->get('mobile_no');

        $getUser = FrontendUser::select('id')->where(['email'=>$email,'mobile_no'=>$mobileNo])->latest()->first();
        if(!empty($getUser))
        {
          $rti = RtiForm::where('frontend_user_id',$getUser->id)->first();
          if(count($rti)>0){
              Session::put('fronendLoginId',$getUser->id);
          }
          else{
              $frontendUser = FrontendUser::create($request->except(['_token']));
              Session::put('fronendLoginId',$frontendUser->id);
          }
        }
        else{
          $frontendUser = FrontendUser::create($request->except(['_token']));
          Session::put('fronendLoginId',$frontendUser->id);
        }
        return redirect('rti_form');
  }

}
