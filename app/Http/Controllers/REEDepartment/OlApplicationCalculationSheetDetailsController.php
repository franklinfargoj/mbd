<?php

namespace App\Http\Controllers\REEDepartment;

use App\OlApplicationCalculationSheetDetails;
use App\Http\Controllers\Common\CommonController;
use App\Http\Controllers\Controller;
use App\OlDcrRateMaster;
use App\OlApplication;
use App\REENote;
//use Barryvdh\DomPDF\PDF;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use niklasravnsborg\LaravelPdf\Facades\Pdf as NewPDF;

class OlApplicationCalculationSheetDetailsController extends Controller
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
        $applicationId = decrypt($id);
        // $applicationId = $id; 
        $user = Auth::user();
        $ol_application = $this->CommonController->getOlApplication($applicationId);
        $ol_application->model = OlApplication::with(['ol_application_master'])->where('id',$applicationId)->first();
        $calculationSheetDetails = OlApplicationCalculationSheetDetails::where('application_id','=',$applicationId)->get();

        $dcr_rates = OlDcrRateMaster::all();
        // REE Note download

        $arrData['reeNote'] = REENote::where('application_id', $applicationId)->orderBy('id', 'desc')
                            ->first();

        return view('admin.REE_department.calculation_sheet',compact('calculationSheetDetails','applicationId','user','dcr_rates','arrData','ol_application'));
    }


    public function showRevalCalculationDetails($id)
    {
        $applicationId = $id;$user = Auth::user();
        $ol_application = $this->CommonController->getOlApplication($id);
        $ol_application->model = OlApplication::with(['ol_application_master'])->where('id',$id)->first();

        $calculationSheetDetails = OlApplicationCalculationSheetDetails::where('application_id','=',$id)->get();

        if($calculationSheetDetails === null) {
            $calculationSheetDetails = OlApplicationCalculationSheetDetails::where('society_id', '=', $ol_application->society_id)->get();
        }


        $dcr_rates = OlDcrRateMaster::all();
        // REE Note download

        $arrData['reeNote'] = REENote::where('application_id', $applicationId)->orderBy('id', 'desc')->first();


        return view('admin.REE_department.reval_calculation_sheet',compact('calculationSheetDetails','applicationId','user','dcr_rates','arrData','ol_application'));

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

        OlApplicationCalculationSheetDetails::updateOrCreate(['application_id'=>$request->get('application_id')],$request->all());
        $id = encrypt($request->get('application_id'));
        return redirect("ol_calculation_sheet/" . $id."#".$request->get('redirect_tab'));
    }

    public function saveRevalCalculationDetails(Request $request)
    {

        OlApplicationCalculationSheetDetails::updateOrCreate(['application_id'=>$request->get('application_id')],$request->all());
        return redirect("ol_reval_calculation_sheet/" . $request->get('application_id')."#".$request->get('redirect_tab'));
    }
}
