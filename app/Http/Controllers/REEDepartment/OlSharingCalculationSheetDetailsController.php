<?php

namespace App\Http\Controllers\REEDepartment;
use App\Http\Controllers\Controller;
use App\OlSharingCalculationSheetDetail;
use App\Http\Controllers\Common\CommonController;
use Illuminate\Http\Request;

use App\OlDcrRateMaster;
use App\OlApplication;
use Illuminate\Support\Facades\Auth;
use App\REENote;

class OlSharingCalculationSheetDetailsController extends Controller
{
    public function __construct()
    {
        $this->CommonController = new CommonController();
    }    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\OlSharingCalculationSheetDetail  $olSharingCalculationSheetDetail
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $applicationId = $id;$user = Auth::user();
        $ol_application = $this->CommonController->getOlApplication($id);
        $ol_application->model = OlApplication::with(['ol_application_master'])->where('id',$id)->first();        
        $calculationSheetDetails = OlSharingCalculationSheetDetail::where('application_id','=',$id)->get();

        $dcr_rates = OlDcrRateMaster::all();
        // REE Note download

        $arrData['reeNote'] = REENote::where('application_id', $applicationId)->orderBy('id', 'desc')->first();

        return view('admin.REE_department.sharing_calculation_sheet',compact('calculationSheetDetails','applicationId','user','dcr_rates','arrData','ol_application'));

    }


    public function showRevalSharingCalculationDetails($id)
    {
        $applicationId = $id;$user = Auth::user();
        $ol_application = $this->CommonController->getOlApplication($id);
        $ol_application->model = OlApplication::with(['ol_application_master'])->where('id',$id)->first();
       // $calculationSheetDetails = OlSharingCalculationSheetDetail::where('society_id', '=', $ol_application->society_id)->first();


        $calculationSheetDetails = OlSharingCalculationSheetDetail::where('application_id','=',$id)->get();

        if($calculationSheetDetails === null) {
            $calculationSheetDetails = OlSharingCalculationSheetDetail::where('society_id', '=', $ol_application->society_id)->get();
        }



        $dcr_rates = OlDcrRateMaster::all();
        // REE Note download

        $arrData['reeNote'] = REENote::where('application_id', $applicationId)->orderBy('id', 'desc')->first();

        return view('admin.REE_department.reval_sharing_calculation_sheet',compact('calculationSheetDetails','applicationId','user','dcr_rates','arrData','ol_application'));

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\OlSharingCalculationSheetDetail  $olSharingCalculationSheetDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(OlSharingCalculationSheetDetail $olSharingCalculationSheetDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\OlSharingCalculationSheetDetail  $olSharingCalculationSheetDetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OlSharingCalculationSheetDetail $olSharingCalculationSheetDetail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\OlSharingCalculationSheetDetail  $olSharingCalculationSheetDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(OlSharingCalculationSheetDetail $olSharingCalculationSheetDetail)
    {
        //
    }

    public function saveCalculationDetails(Request $request)
    {

        OlSharingCalculationSheetDetail::updateOrCreate(['application_id'=>$request->get('application_id')],$request->all());
        return redirect("ol_sharing_calculation_sheet/" . $request->get('application_id')."#".$request->get('redirect_tab'));
    }

    public function saveRevalCalculationDetails(Request $request)
    {

        OlSharingCalculationSheetDetail::updateOrCreate(['application_id'=>$request->get('application_id')],$request->all());
        return redirect("ol_reval_sharing_calculation_sheet/" . $request->get('application_id')."#".$request->get('redirect_tab'));
    }
}
