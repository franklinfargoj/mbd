<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FrontendUser;
use Session;

class FrontendRegisterController extends Controller
{
  public function showRegisterForm()
  {
    return view('frontend_user_register');
  }

  public function frontendRegister(Request $request)
  {
      $validatedData = $request->validate([
         'name' => 'required|max:255',
         'address' => 'required|max:255',
         'email' => 'required|email',
         'mobile_no' => 'required|numeric|max:10',
     ]);

     if($validatedData->fails()){
        return redirect()->back()
                 ->withErrors($validatedData)
                 ->withInput();
      }
      else{
        $email    = $request->get('email');
        $mobileNo = $request->get('mobile_no');

        $getUser = FrontendUser::select('id')->where(['email'=>$email,'mobile_no'=>$mobileNo])->latest()->first();
        $rti = RtiForm::where('frontend_user_id',$getUser->id)->first();

        if(count($rti)>0){
            Session::put('fronendLoginId',$getUser->id);
        }
        else{
            $frontendUser = FrontendUser::create($request->except(['_token']));
            Session::put('fronendLoginId',$frontendUser->id);
        }

        return redirect('');




      }
  }

}
