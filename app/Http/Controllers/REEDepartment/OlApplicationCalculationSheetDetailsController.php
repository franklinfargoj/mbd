<?php

namespace App\Http\Controllers\REEDepartment;

use App\OlApplicationCalculationSheetDetails;
use App\Http\Controllers\Controller;
use App\OlDcrRateMaster;
use App\REENote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OlApplicationCalculationSheetDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
    public function store($id)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\OlApplicationCalculationSheetDetails  $olApplicationCalculationSheetDetails
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $applicationId = $id;$user = Auth::user();
        $calculationSheetDetails = OlApplicationCalculationSheetDetails::where('id','=',$id)->get();

        $dcr_rates = OlDcrRateMaster::all();
        // REE Note download

        $arrData['reeNote'] = REENote::where('application_id', $applicationId)->orderBy('id', 'desc')->first();

        return view('admin.REE_department.calculation_sheet',compact('calculationSheetDetails','applicationId','user','dcr_rates','arrData'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\OlApplicationCalculationSheetDetails  $olApplicationCalculationSheetDetails
     * @return \Illuminate\Http\Response
     */
    public function edit(OlApplicationCalculationSheetDetails $olApplicationCalculationSheetDetails)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\OlApplicationCalculationSheetDetails  $olApplicationCalculationSheetDetails
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OlApplicationCalculationSheetDetails $olApplicationCalculationSheetDetails)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\OlApplicationCalculationSheetDetails  $olApplicationCalculationSheetDetails
     * @return \Illuminate\Http\Response
     */
    public function destroy(OlApplicationCalculationSheetDetails $olApplicationCalculationSheetDetails)
    {
        //
    }

    public function saveCalculationDetails(Request $request)
    {
      //  echo "<pre>";print_r($request->all());exit;

        $this->validate($request, [
            'total_no_of_buildings' => 'required',
        ]);

        OlApplicationCalculationSheetDetails::updateOrCreate(['application_id'=>$request->get('application_id')],$request->all());
        return redirect("ol_calculation_sheet/" . $request->get('application_id'));
    }
}
