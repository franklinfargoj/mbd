<?php

namespace App\Http\Controllers\REEDepartment;
use App\Http\Controllers\Controller;
use App\OlSharingCalculationSheetDetail;
use Illuminate\Http\Request;

use App\OlDcrRateMaster;
use Illuminate\Support\Facades\Auth;
use App\REENote;

class OlSharingCalculationSheetDetailsController extends Controller
{
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
        $calculationSheetDetails = OlSharingCalculationSheetDetail::where('application_id','=',$id)->get();

        $dcr_rates = OlDcrRateMaster::all();
        // REE Note download

        $arrData['reeNote'] = REENote::where('application_id', $applicationId)->orderBy('id', 'desc')->first();

        return view('admin.REE_department.sharing_calculation_sheet',compact('calculationSheetDetails','applicationId','user','dcr_rates','arrData'));

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
        //echo "<pre>";print_r($request->all());exit;

        OlSharingCalculationSheetDetail::updateOrCreate(['application_id'=>$request->get('application_id')],$request->all());
        return redirect("ol_sharing_calculation_sheet/" . $request->get('application_id')."#".$request->get('redirect_tab'));
    }
}
