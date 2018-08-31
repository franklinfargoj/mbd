<?php

namespace App\Http\Controllers;

use App\Hearing;
use App\SendNoticeToAppellant;
use Illuminate\Http\Request;
use File;
use Storage;

class SendNoticeToAppellantController extends Controller
{
    public $header_data = array(
        'menu' => 'Send Notice to Appellant',
        'menu_url' => 'hearing'
    );

    public function create($id)
    {
        $header_data = $this->header_data;
        $arrData['hearing'] = Hearing::with(['hearingBoard', 'hearingDepartment', 'hearingSchedule'])
                                        ->where('id', $id)->first();

        return view('admin.send_notice_to_appellant.create', compact('header_data', 'arrData'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'upload_notice' => "required|mimes:pdf",
            'comment' => "required",
        ]);

        $data = [
            'hearing_id' => $request->hearing_id,
            'comment' => $request->comment,
        ];

        $time = time();
        if($request->hasFile('upload_notice')) {
            $extension = $request->file('upload_notice')->getClientOriginalExtension();
            if ($extension == "pdf") {
                $case_template_name = File::name($request->file('upload_notice')->getClientOriginalName()) . '_' . $time . '.' . $extension;
                $case_template_path = Storage::putFileAs('/upload_notice', $request->file('upload_notice'), $case_template_name, 'public');
                $data['upload_notice'] = $case_template_path;
            } else {
                return redirect()->back()->with('error','Invalid type of file uploaded (only pdf allowed)');
            }

        }

        SendNoticeToAppellant::create($data);

        return redirect('hearing')->with(['success'=> 'Record added succesfully']);
    }

    public function edit($id)
    {
        $header_data = $this->header_data;
        $arrData['hearing'] = Hearing::with(['hearingBoard', 'hearingDepartment', 'hearingSchedule', 'hearingSendNoticeToAppellant'])
                                        ->where('id', $id)->first();

        return view('admin.send_notice_to_appellant.edit', compact('header_data', 'arrData'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'comment' => "required",
        ]);

        $data = [
            'hearing_id' => $request->hearing_id,
            'comment' => $request->comment,
        ];

        $time = time();
        if($request->hasFile('upload_notice')) {
            $extension = $request->file('upload_notice')->getClientOriginalExtension();
            if ($extension == "pdf") {
                $case_template_name = File::name($request->file('upload_notice')->getClientOriginalName()) . '_' . $time . '.' . $extension;
                $case_template_path = Storage::putFileAs('/upload_notice', $request->file('upload_notice'), $case_template_name, 'public');
                $data['upload_notice'] = $case_template_path;
            } else {
                return redirect()->back()->with('error','Invalid type of file uploaded (only pdf allowed)');
            }

        }
        else
        {
            $data['upload_notice'] = $request->notice;
        }

        SendNoticeToAppellant::create($data);

        return redirect('hearing')->with(['success'=> 'Record added succesfully']);
    }
}
