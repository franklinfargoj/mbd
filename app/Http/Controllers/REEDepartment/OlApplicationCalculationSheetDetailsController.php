<?php

namespace App\Http\Controllers\REEDepartment;

use App\OlApplicationCalculationSheetDetails;
use App\Http\Controllers\Controller;
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
        return view('admin.REE_department.calculation_sheet',compact('calculationSheetDetails','applicationId','user'));
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
        echo "<pre>"; print_r($request->all());//exit;
       // OlApplicationCalculationSheetDetails::create($request->all());

        OlApplicationCalculationSheetDetails::updateOrCreate(['application_id'=>$request->get('application_id')],$request->all());
      /*  $user = User::firstOrNew($request->all());
        $user->foo = Input::get('foo');
        $user->save();*/
    }
}
