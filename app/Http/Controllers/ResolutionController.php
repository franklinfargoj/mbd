<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Resolution;
use App\DeletedResolution;
use App\Board;
use App\ResolutionType;
use Config;
use App\Http\Requests\resolution\CreateResolutionRequest;
use App\Http\Requests\resolution\UpdateResolutionRequest;
use Yajra\DataTables\DataTables;
use DB;
use App\Department;
use Illuminate\Support\Facades\Storage;
use Excel;

class ResolutionController extends Controller
{
    public $header_data = array(
        'menu' => 'Resolution',
        'menu_url' => 'resolution',
        'page' => '',
        'side_menu' => 'resolution'
    );

    protected $list_num_of_records_per_page;

    public function __construct()
    {
        $this->list_num_of_records_per_page = Config::get('commanConfig.list_num_of_records_per_page');
    }
    

    public function print_data(Request $request)
    {
        $resolutions = Resolution::with(['board','department','resolutionType'])->join('boards', 'resolutions.board_id', '=', 'boards.id')
            ->join('departments', 'resolutions.department_id', '=', 'departments.id')
            ->join('resolution_types', 'resolutions.resolution_type_id', '=', 'resolution_types.id');
            
            if($request->title)
            {
                $resolutions = $resolutions->where('title', 'like', '%'.$request->title.'%');
            }

            if($request->resolution_type_id)
            {
                $resolutions = $resolutions->where('resolution_type_id', $request->resolution_type_id);
            }

            if($request->board_id)
            {
                $resolutions = $resolutions->where('board_id', $request->board_id);
            }
        
            if($request->published_from_date)
            {
                $resolutions = $resolutions->whereDate('published_date', '>=', date('Y-m-d', strtotime($request->published_from_date)));
            }

            if($request->published_to_date)
            {
                $resolutions = $resolutions->whereDate('published_date', '<=', date('Y-m-d', strtotime($request->published_to_date)));
            }
            
            $resolutions = $resolutions->selectRaw( DB::raw('resolutions.id as id, boards.board_name, departments.department_name, resolution_types.name as resolutionType, title, resolution_code, published_date, filepath, filename'));
            $resolutions= $resolutions->get();
            //dd($resolutions);
            return view('admin.resolution.print_data',compact('resolutions')); 
    }
    

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Datatables $datatables)
    {   

        $header_data = $this->header_data;
        $boards = Board::where('status', 1)->get()->toArray();
        $resolutionTypes = ResolutionType::all()->toArray();
        $getData = $request->all();
        
        if($request->excel)
        {
            $resolutions = Resolution::with(['board','department','resolutionType'])->join('boards', 'resolutions.board_id', '=', 'boards.id')
            ->join('departments', 'resolutions.department_id', '=', 'departments.id')
            ->join('resolution_types', 'resolutions.resolution_type_id', '=', 'resolution_types.id');
            
            if($request->title)
            {
                $resolutions = $resolutions->where('title', 'like', '%'.$request->title.'%');
            }

            if($request->resolution_type_id)
            {
                $resolutions = $resolutions->where('resolution_type_id', $request->resolution_type_id);
            }

            if($request->board_id)
            {
                $resolutions = $resolutions->where('board_id', $request->board_id);
            }
        
            if($request->published_from_date)
            {
                $resolutions = $resolutions->whereDate('published_date', '>=', date('Y-m-d', strtotime($request->published_from_date)));
            }

            if($request->published_to_date)
            {
                $resolutions = $resolutions->whereDate('published_date', '<=', date('Y-m-d', strtotime($request->published_to_date)));
            }
            
            $resolutions = $resolutions->selectRaw( DB::raw('resolutions.id as id, boards.board_name, departments.department_name, resolution_types.name as resolutionType, title, resolution_code, published_date, filepath, filename'));
            $dataList= $resolutions->get();
            return Excel::create('resolution_'.date('Y_m_d_H_i_s'), function($excel) use($dataList){

                $excel->sheet('mySheet', function($sheet) use($dataList)
                {
                    $sheet->fromArray($dataList);
                });
            })->download('csv');
        }

        $columns = [
            ['data' => 'rownum','name' => 'rownum','title' => 'Sr No.','searchable' => false],
            ['data' => 'board','name' => 'board.board_name','title' => 'Board Name'],
            ['data' => 'department','name' => 'department.department_name','title' => 'Department Name'],
            ['data' => 'resolutionType','name' => 'resolutionType.name','title' => 'Resolution Type'],
            ['data' => 'title', 'name' => 'title', 'title' => 'Title/Subject'],
            ['data' => 'resolution_code','name' => 'resolution_code','title' => 'Resolution Code'],
            ['data' => 'published_date','name' => 'published_date','title' => 'Published Date','searchable' => false],
            ['data' => 'file','name' => 'file','title' => 'File','searchable' => false, 'orderable'=>false],
            ['data' => 'actions','name' => 'actions','title' => 'Actions','searchable' => false,'orderable'=>false],
        ];
        
        if ($datatables->getRequest()->ajax()) {
            
            
            DB::statement(DB::raw('set @rownum='. (isset($request->start) ? $request->start : 0) ));
            
            $resolutions = Resolution::with(['board','department','resolutionType']);
            
            if($request->title)
            {
                $resolutions = $resolutions->where('title', 'like', '%'.$request->title.'%');
            }

            if($request->resolution_type_id)
            {
                $resolutions = $resolutions->where('resolution_type_id', $request->resolution_type_id);
            }

            if($request->board_id)
            {
                $resolutions = $resolutions->where('board_id', $request->board_id);
            }
        
            if($request->published_from_date)
            {
                $resolutions = $resolutions->whereDate('published_date', '>=', date('Y-m-d', strtotime($request->published_from_date)));
            }

            if($request->published_to_date)
            {
                $resolutions = $resolutions->whereDate('published_date', '<=', date('Y-m-d', strtotime($request->published_to_date)));
            }
            
            $resolutions = $resolutions->selectRaw( DB::raw('@rownum  := @rownum  + 1 AS rownum').', resolutions.id as id, board_id, department_id, resolution_type_id, title, resolution_code, published_date, filepath, filename');
            
            return $datatables->of($resolutions)
                ->editColumn('board', function ($resolutions) {
                    return $resolutions->board->board_name;
                })
                ->editColumn('department', function ($resolutions) {
                    return $resolutions->department->department_name;
                })
                ->editColumn('resolutionType', function ($resolutions) {
                    return $resolutions->resolutionType->name;
                })
                ->editColumn('file', function ($resolutions) {
                    return view('admin.resolution.downloads', compact('resolutions'))->render();
                    // return $resolutions->filename;
                })
                ->editColumn('published_date', function ($resolutions) {
                    return date('d-m-Y',strtotime($resolutions->published_date));
                })
                ->editColumn('actions', function ($resolutions) {
                   return view('admin.resolution.actions', compact('resolutions'))->render();
                })
                ->rawColumns(['board','department','file','published_date','actions'])
                ->make(true);
        }
        
        $html = $datatables->getHtmlBuilder()->columns($columns)->parameters($this->getParameters());
        
        return view('admin.resolution.index', compact('html','header_data','boards','resolutionTypes','getData'));
    }

    protected function getParameters() {
        return [
            'serverSide' => true,
            'processing' => true,
            'ordering'   =>'isSorted',
            "order"=> [8, "desc" ],
            "pageLength" => $this->list_num_of_records_per_page,
            // 'fixedHeader' => [
            //     'header' => true,
            //     'footer' => true
            // ]
        ];
    }


    public function create()
    {

        $boards = Board::where('status', 1)->get()->toArray();
        $resolutionTypes = ResolutionType::all()->toArray();
        $header_data = $this->header_data;
        return view('admin.resolution.add', compact('header_data', 'boards', 'resolutionTypes'));
    }

    public function store(CreateResolutionRequest $request)
    {
        $dataToInsert = [
            'board_id' => $request->board,
            'department_id' => $request->department,
            'resolution_type_id' => $request->resolution_type,
            'resolution_code' => $request->resolution_code,
            'title' => $request->title,
            'description' => $request->description,
            'language' => $request->language,
            'reference_link' => $request->reference_link,
            'published_date' => date('Y-m-d',strtotime($request->published_date)),
            'revision_log_message' => $request->revision_log_message
        ];


        // dd($request->toArray());
        $uploadPath = '/uploads/resolutions';
        $destinationPath = public_path($uploadPath);
                
        if($request->file('file'))
        {
            $file = $request->file('file');
            $file_name = time().$file->getFileName().'.'.$file->getClientOriginalExtension();
            
            Storage::disk(env('FILESYSTEM_DRIVER'))->putFileAs('Resolution',$request->file('file'),$file_name);
            if($file->move($destinationPath, $file_name))
            {
                $dataToInsert['filepath'] = $uploadPath.'/';
                $dataToInsert['filename'] = $file_name;
            }
        }
        // dd($dataToInsert);
        Resolution::create($dataToInsert);

        return redirect('resolution')->with(['success'=> 'Record added succesfully']);
    }

    public function edit($id)
    {
        $resolution = Resolution::findOrFail($id);
        $boards = Board::where('status', 1)->get()->toArray();
        $resolutionTypes = ResolutionType::all()->toArray();

        //display department name as per id
        $resolution->department_name = Department::where('id',$resolution->department_id)
                                                  ->value('department_name');
        $header_data = $this->header_data;
        return view('admin.resolution.edit', compact('header_data', 'boards', 'resolutionTypes', 'resolution'));
    }

    public function update(UpdateResolutionRequest $request, $id)
    {
        $uploadPath      = '/uploads/resolutions';
        $destinationPath = public_path($uploadPath);

        if ($request->has('file')){ 
            $file      = $request->file('file');
            $file_name = time().$file->getFileName().'.'.$file->getClientOriginalExtension();
            $file->move($destinationPath, $file_name);
        }

        $resolution = Resolution::findOrFail($id);
        $resolution->board_id             = $request->board_id;
        $resolution->department_id        = $request->department;
        $resolution->resolution_type_id   = $request->resolution_type;
        $resolution->resolution_code      = $request->resolution_code;
        $resolution->title                = $request->title;
        $resolution->description          = $request->description;
        $resolution->language             = $request->language;
        $resolution->reference_link       = $request->reference_link;
        $resolution->published_date       = date('Y-m-d',strtotime($request->published_date));
        $resolution->revision_log_message = $request->revision_log_message;

        if ($request->has('file')) {
            $resolution->filepath = $uploadPath.'/';
            $resolution->filename = $file_name;
        }
        $resolution->save();
        // ]);        
        // $resolution->update([
        //     'board_id' => $request->board_id,
        //     'department_id' => $request->department,
        //     'resolution_type_id' => $request->resolution_type,
        //     'resolution_code' => $request->resolution_code,
        //     'title' => $request->title,
        //     'description' => $request->description,
        //     if ($request->has('file')) {
        //     'filepath' => $request->$file_name,
        //     'filename' => $request->$file_name,
        //     }
        //     'language' => $request->language,
        //     'reference_link' => $request->reference_link,
        //     'published_date' => $request->published_date,
        //     'revision_log_message' => $request->revision_log_message
        // ]);

        return redirect('resolution')->with(['success'=> 'Record updated succesfully']);
    }

    public function destroy(Request $request, $id)
    {
        $resolution = Resolution::findOrFail($id);
        
        $resolution->delete();
        DeletedResolution::create([
            'resolution_id' => $resolution->id,
            'resolution_type_id' => $resolution->resolution_type_id,
            'title' => $resolution->title,
            'description' => $resolution->description,
            'filepath' => $resolution->filepath,
            'filename' => $resolution->filename,
            'reason_for_delete' => $request->input('delete_message'),
            // 'created_at' => $date
        ]);

        return redirect()->back()->with(['success'=> 'Record deleted succesfully']);
    }

    public function loadDeleteReasonOfResolutionUsingAjax(Request $request)
    {
        $id = $request->id;
        return view('admin.resolution.resolutionDeleteReason', compact('id'))->render();
    }
}
