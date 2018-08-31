<?php

namespace App\Http\Controllers;

use App\Hearing;
use App\UploadCaseJudgement;
use Illuminate\Http\Request;
use File;
use Storage;

class UploadCaseJudgementController extends Controller
{
    public $header_data = array(
        'menu' => 'Hearing',
        'menu_url' => 'hearing',
        'upload' => 'Upload Case Document'
    );
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
    public function create($id)
    {
        $header_data = $this->header_data;
        $arrData['hearing_data'] = Hearing::where('id', $id)->first();

        return view('admin.upload_case_judgement.add', compact('header_data', 'arrData'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = [
            'hearing_id' => $request->hearing_id,
            'description' => $request->description,
            'case_year' => $request->case_year,
            'case_number' => $request->case_number,
        ];

        $time = time();
        if($request->hasFile('upload_judgement_case')) {
            $extension = $request->file('upload_judgement_case')->getClientOriginalExtension();
            if ($extension == "pdf") {
                $case_template_name = File::name($request->file('upload_judgement_case')->getClientOriginalName()) . '_' . $time . '.' . $extension;
                $case_template_path = Storage::putFileAs('/upload_judgement_case', $request->file('upload_judgement_case'), $case_template_name, 'public');
                $data['upload_judgement_case'] = $case_template_path;
            } else {
                return redirect()->back()->with('error','Invalid type of file uploaded (only pdf allowed)');
            }

        }
        UploadCaseJudgement::create($data);
//
        return redirect('/hearing')->with('success','Case Judgement document uploaded successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
