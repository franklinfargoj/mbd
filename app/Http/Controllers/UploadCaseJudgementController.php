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
        $this->validate($request,[
            'description' => "required",
            'upload_judgement_case' => "required|mimes:pdf",
        ]);

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
                $name = File::name($request->file('upload_judgement_case')->getClientOriginalName()) . '_' . $time . '.' . $extension;
                $path = Storage::putFileAs('/upload_judgement_case', $request->file('upload_judgement_case'), $name, 'public');
                $data['upload_judgement_case'] = $path;
                $data['judgement_case_filename'] = File::name($request->file('upload_judgement_case')->getClientOriginalName()). '.' . $extension;
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
        $header_data = $this->header_data;
        $arrData['hearing_data'] = Hearing::with('hearingUploadCaseJudgement')->first();

        return view('admin.upload_case_judgement.edit', compact('header_data', 'arrData'));
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
        $this->validate($request,[
            'description' => "required",
        ]);

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
                $name = File::name($request->file('upload_judgement_case')->getClientOriginalName()) . '_' . $time . '.' . $extension;
                $path = Storage::putFileAs('/upload_judgement_case', $request->file('upload_judgement_case'), $name, 'public');
                $data['upload_judgement_case'] = $path;
                $data['judgement_case_filename'] = File::name($request->file('upload_judgement_case')->getClientOriginalName()). '.' . $extension;
            } else {
                return redirect()->back()->with('error','Invalid type of file uploaded (only pdf allowed)');
            }

        }
        else
        {
            $data['upload_judgement_case'] = $request->upload_case;
            $data['judgement_case_filename'] = $request->judgement_case_filename;
        }

        UploadCaseJudgement::create($data);
//
        return redirect('/hearing')->with('success','Case Judgement document uploaded successfully');
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
