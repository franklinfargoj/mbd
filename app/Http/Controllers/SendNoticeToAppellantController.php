<?php

namespace App\Http\Controllers;

use App\Hearing;
use App\HearingStatusLog;
use App\SendNoticeToAppellant;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use File;
use Illuminate\Support\Facades\Auth;
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
        $arrData['hearing'] = Hearing::with(['hearingBoard', 'hearingDepartment', 'hearingSchedule', 'hearingStatus', 'hearingApplicationType'])
                                        ->where('id', $id)->first();
        $hearing_data = $arrData['hearing'];

        return view('admin.send_notice_to_appellant.create', compact('header_data', 'arrData', 'hearing_data'));
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
                $name = File::name($request->file('upload_notice')->getClientOriginalName()) . '_' . $time . '.' . $extension;
                $path = Storage::putFileAs('/upload_notice', $request->file('upload_notice'), $name, 'public');
                $data['upload_notice'] = $path;
                $data['upload_notice_filename'] = File::name($request->file('upload_notice')->getClientOriginalName()). '.' . $extension;
            } else {
                return redirect()->back()->with('error','Invalid type of file uploaded (only pdf allowed)');
            }

        }

        SendNoticeToAppellant::create($data);

        $parent_role_id = User::where('role_id', session()->get('parent'))->first();

        $hearing_status_log = [
            [
                'hearing_id' => $request->hearing_id,
                'user_id' => Auth::user()->id,
                'role_id' => session()->get('role_id'),
                'hearing_status_id' => config('commanConfig.hearingStatus.notice_send'),
                'to_user_id' => NULL,
                'to_role_id' => NULL,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            [
                'hearing_id' => $request->hearing_id,
                'user_id' => $parent_role_id->id,
                'role_id' => session()->get('parent'),
                'hearing_status_id' => config('commanConfig.hearingStatus.notice_send'),
                'to_user_id' => NULL,
                'to_role_id' => NULL,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ];

        HearingStatusLog::insert($hearing_status_log);

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
                $name = File::name($request->file('upload_notice')->getClientOriginalName()) . '_' . $time . '.' . $extension;
                $path = Storage::putFileAs('/upload_notice', $request->file('upload_notice'), $name, 'public');
                $data['upload_notice'] = $path;
                $data['upload_notice_filename'] = File::name($request->file('upload_notice')->getClientOriginalName()). '.' . $extension;
            } else {
                return redirect()->back()->with('error','Invalid type of file uploaded (only pdf allowed)');
            }

        }
        else
        {
            $data['upload_notice'] = $request->notice;
            $data['upload_notice_filename'] = $request->upload_notice_filename;
        }

        SendNoticeToAppellant::create($data);

        $parent_role_id = User::where('role_id', session()->get('parent'))->first();

        $hearing_status_log = [
            [
                'hearing_id' => $request->hearing_id,
                'user_id' => Auth::user()->id,
                'role_id' => session()->get('role_id'),
                'hearing_status_id' => config('commanConfig.hearingStatus.notice_send'),
                'to_user_id' => NULL,
                'to_role_id' => NULL,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            [
                'hearing_id' => $request->hearing_id,
                'user_id' => $parent_role_id->id,
                'role_id' => session()->get('parent'),
                'hearing_status_id' => config('commanConfig.hearingStatus.notice_send'),
                'to_user_id' => NULL,
                'to_role_id' => NULL,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ];

        HearingStatusLog::insert($hearing_status_log);

        return redirect('hearing')->with(['success'=> 'Record added succesfully']);
    }
}
