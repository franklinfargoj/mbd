<?php

namespace App\Http\Controllers;

use App\Board;
use App\Department;
use App\ForwardCase;
use App\Hearing;
use App\HearingStatusLog;
use App\Role;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ForwardCaseController extends Controller
{
    public $header_data = array(
        'menu' => 'Forward Case',
        'menu_url' => 'hearing'
    );

    public function create($id)
    {
        $id = decrypt($id);
        $header_data = $this->header_data;
        $arrData['hearing'] = Hearing::with(['hearingBoard', 'hearingDepartment'])
                                        ->where('id', $id)->first();
        $arrData['board'] = Board::where('status', 1)->get();
        $hearing_data = Hearing::with(['hearingStatus', 'hearingApplicationType'])
        ->where('id', $id)
        ->first();

        return view('admin.forward_case.create', compact('header_data', 'arrData', 'hearing_data'));
    }

    public function store(Request $request)
    {
//        dd($request->all());
        $this->validate($request, [
            'board' => "required",
            'department' => "required",
            'description' => "required",
        ]);

        $data = [
            'board_id' => $request->board,
            'department_id' => $request->department,
            'hearing_id' => $request->hearing_id,
            'description' => $request->description,
        ];

        ForwardCase::create($data);

//        dd(session()->all());
        if(session()->has('parent'))
        {
            $role_id = session()->get('parent');
            $user_id = User::where('role_id', $role_id)->get(['id'])->first();
        }

        elseif(session()->has('child'))
        {
            $role_id = session()->get('child');
            $user_id = User::where('role_id', $role_id)->get(['id'])->first();
        }

//        dd([$role_id,$user_id]);
        $parent_role_id = Role::where('id', $request->role_id)->get(['parent_id'])->first();
        $parent_user_id = User::where('role_id', $parent_role_id->parent_id)->get(['id'])->first();

        $hearing_status_log = [
            [
                'hearing_id' => $request->hearing_id,
                'user_id' => Auth::user()->id,
                'role_id' => session()->get('role_id'),
                'hearing_status_id' => config('commanConfig.hearingStatus.forwarded'),
                'to_user_id' => $request->user,
                'to_role_id' => $request->role_id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'hearing_id' => $request->hearing_id,
                'user_id' => $user_id->id,
                'role_id' => $role_id,
                'hearing_status_id' => config('commanConfig.hearingStatus.forwarded'),
                'to_user_id' => NULL,
                'to_role_id' => NULL,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'hearing_id' => $request->hearing_id,
                'user_id' => $request->user,
                'role_id' => $request->role_id,
                'hearing_status_id' => config('commanConfig.hearingStatus.pending'),
                'to_user_id' => NULL,
                'to_role_id' => NULL,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'hearing_id' => $request->hearing_id,
                'user_id' => $parent_user_id->id,
                'role_id' => $parent_role_id->parent_id,
                'hearing_status_id' => config('commanConfig.hearingStatus.pending'),
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
        $id = decrypt($id);
        $header_data = $this->header_data;
        $arrData['hearing'] = Hearing::with(['hearingStatus', 'hearingApplicationType', 'hearingForwardCase' => function($q){
            $q->orderBy('created_at', 'desc');
        }, 'hearingStatusLog' => function($q){
            $q->where('user_id', Auth::user()->id)
                ->where('role_id', session()->get('role_id'));
        }])
            ->where('id', $id)
            ->first();
        $arrData['board'] = Board::where('status', 1)->get();
        $arrData['department'] = Department::where('status', 1)->get();
        $hearing_data = $arrData['hearing'];
//        dd($hearing_data);
        return view('admin.forward_case.edit', compact('header_data', 'arrData', 'hearing_data'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'board' => "required",
            'department' => "required",
            'description' => "required",
        ]);

        $data = [
            'board_id' => $request->board,
            'department_id' => $request->department,
            'hearing_id' => $request->hearing_id,
            'description' => $request->description,
        ];

        ForwardCase::create($data);

        return redirect('hearing')->with(['success'=> 'Record added succesfully']);
    }

    public function show($id){
        $id = decrypt($id);
        $header_data = $this->header_data;
        $arrData['hearing'] = Hearing::with(['hearingStatus', 'hearingApplicationType', 'hearingForwardCase' => function($q){
            $q->orderBy('created_at', 'desc');
        }, 'hearingStatusLog' => function($q){
            $q->where('user_id', Auth::user()->id)
                ->where('role_id', session()->get('role_id'));
        }])
            ->where('id', $id)
            ->first();
        $arrData['board'] = Board::where('status', 1)->get();
        $arrData['department'] = Department::where('status', 1)->get();
        $hearing_data = $arrData['hearing'];
//        dd($hearing_data);
        return view('admin.forward_case.view', compact('header_data', 'arrData', 'hearing_data'));
    }
}
