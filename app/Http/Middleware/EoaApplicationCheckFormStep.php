<?php

namespace App\Http\Middleware;

use Closure;
use App\EmploymentOfArchitect\EoaApplication;

class EoaApplicationCheckFormStep
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $app_id=$request->route()->parameter('id');
        if($app_id!="")
        {
            $app_id=decrypt($app_id);
            $EoaApplication=EoaApplication::find($app_id);
            if($EoaApplication)
            {
                $form_step=$EoaApplication->form_step;
                if($request->route()->getName()=='appointing_architect.step1' || $request->route()->getName()=='appointing_architect.step1_post')
                {
                }else if($request->route()->getName()=='appointing_architect.step2' || $request->route()->getName()=='appointing_architect.step2_post')
                {
                    if($form_step>=2)
                    {

                    }else
                    {
                        return redirect()->route('appointing_architect.step1',encrypt($app_id));
                    }
                }else if($request->route()->getName()=='appointing_architect.step3' || $request->route()->getName()=='appointing_architect.step3_post')
                {
                    if($form_step>=3)
                    {

                    }else
                    {
                        return redirect()->route('appointing_architect.step2',encrypt($app_id));
                    }
                }else if($request->route()->getName()=='appointing_architect.step4' || $request->route()->getName()=='appointing_architect.step4_post')
                {
                    if($form_step>=4)
                    {

                    }else
                    {
                        return redirect()->route('appointing_architect.step3',encrypt($app_id));
                    }
                }else if($request->route()->getName()=='appointing_architect.step5' || $request->route()->getName()=='appointing_architect.step5_post')
                {
                    if($form_step>=5)
                    {

                    }else
                    {
                        return redirect()->route('appointing_architect.step4',encrypt($app_id));
                    }
                }else if($request->route()->getName()=='appointing_architect.step6' || $request->route()->getName()=='appointing_architect.step6_post')
                {
                    if($form_step>=6)
                    {

                    }else
                    {
                        return redirect()->route('appointing_architect.step5',encrypt($app_id));
                    }
                }else if($request->route()->getName()=='appointing_architect.step7' || $request->route()->getName()=='appointing_architect.step7_post')
                {
                    if($form_step>=7)
                    {

                    }else
                    {
                        return redirect()->route('appointing_architect.step6',encrypt($app_id));
                    }
                }else if($request->route()->getName()=='appointing_architect.step8' || $request->route()->getName()=='appointing_architect.step8_post')
                {
                    if($form_step>=8)
                    {

                    }else
                    {
                        return redirect()->route('appointing_architect.step7',encrypt($app_id));
                    }
                }else
                {

                }
            }
            
        }
        return $next($request);
    }
}
