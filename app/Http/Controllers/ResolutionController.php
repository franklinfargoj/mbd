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
use App\Http\Controllers\Common\CommonController;

class ResolutionController extends Controller
{
    protected $CommonController;
    public $header_data = array(
        'menu' => 'Resolution',
        'menu_url' => 'resolution',
        'page' => '',
        'side_menu' => 'resolution'
    );

    protected $list_num_of_records_per_page;

    public function __construct(CommonController $CommonController)
    {
        $this->CommonController = $CommonController;
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
            
            $resolutions = $resolutions->selectRaw( DB::raw('resolutions.id as id, boards.board_name, departments.department_name, resolution_types.name as resolutionType, title, resolution_code, description, language, reference_link, published_date, filepath, filename, revision_log_message'));
            $resolutions= $resolutions->get();
            // dd($resolutions);

            if(count($resolutions) == 0){
                $dataListMaster = [];
                $dataList = [];
                $dataList['Sr. No.'] = '';
                $dataList['Board'] = '';
                $dataList['Department'] = '';
                $dataList['Resolution Type'] = '';
                $dataList['Resolution Code'] = '';
                $dataList['Title'] = '';
                $dataList['Description'] = '';
                $dataList['Filepath'] = '';
                $dataList['Filename'] = '';
                $dataList['Language'] = '';
                $dataList['Reference Link'] = '';
                $dataList['Published Date'] = '';
                $dataList["Revision Log Message"] = '';
                $dataListMaster[]=$dataList;
            }else{
                $i=1;
                foreach ($resolutions as $dataList_key => $dataList_value) {
                    
                    $dataList = [];
                    $dataList['Sr. No.'] = $i;
                    $dataList['Board'] = $dataList_value['board_name'];
                    $dataList['Department'] = $dataList_value['department_name'];
                    $dataList['Resolution Type'] = $dataList_value['resolutionType'];
                    $dataList['Resolution Code'] = $dataList_value['resolution_code'];
                    $dataList['Title'] = $dataList_value['title'];
                    $dataList['Description'] = $dataList_value['description'];
                    $dataList['Filepath'] = $dataList_value['filepath'];
                    $dataList['Filename'] = $dataList_value['filename'];
                    $dataList['Language'] = $dataList_value['language'];
                    $dataList['Reference Link'] = $dataList_value['reference_link'];
                    $dataList['Published Date'] = $dataList_value['published_date'];
                    $dataList['Revision Log Message'] = $dataList_value['revision_log_message'];
                    
                    $dataListKeys = array_keys($dataList);
                    $dataListMaster[]=$dataList;
                    $i++;
                }
            }

            // dd($dataListMaster);
            return view('admin.print_data',compact('dataListMaster', 'dataListKeys')); 
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
        
        
        if($request->reset)
        {
            return redirect()->route('resolution.index');
        }
        $getData=$request->all();
        if($request->excel)
        {
            $resolutions = Resolution::join('boards', 'resolutions.board_id', '=', 'boards.id')
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
            
            $resolutions = $resolutions->selectRaw( DB::raw('resolutions.id as id, boards.board_name, departments.department_name, resolution_types.name as resolutionType, title, resolution_code, description, language, reference_link, published_date, filepath, filename, revision_log_message'));
            $resolutions= $resolutions->get();
            if(count($resolutions) == 0){
                $dataListMaster = [];
                $dataList = [];
                $dataList['Sr. No.'] = '';
                $dataList['Board'] = '';
                $dataList['Department'] = '';
                $dataList['Resolution Type'] = '';
                $dataList['Resolution Code'] = '';
                $dataList['Title'] = '';
                $dataList['Description'] = '';
                $dataList['Filepath'] = '';
                $dataList['Filename'] = '';
                $dataList['Language'] = '';
                $dataList['Reference Link'] = '';
                $dataList['Published Date'] = '';
                $dataList["Revision Log Message"] = '';
                $dataListMaster[]=$dataList;
            }else{
                $i=1;
                foreach ($resolutions as $dataList_key => $dataList_value) {
                    // dd(array_keys($dataList_value->toArray()));
                    $dataList = [];
                    $dataList['Sr. No.'] = $i;
                    $dataList['Board'] = $dataList_value['board_name'];
                    $dataList['Department'] = $dataList_value['department_name'];
                    $dataList['Resolution Type'] = $dataList_value['resolutionType'];
                    $dataList['Resolution Code'] = $dataList_value['resolution_code'];
                    $dataList['Title'] = $dataList_value['title'];
                    $dataList['Description'] = $dataList_value['description'];
                    $dataList['Filepath'] = $dataList_value['filepath'];
                    $dataList['Filename'] = $dataList_value['filename'];
                    $dataList['Language'] = $dataList_value['language'];
                    $dataList['Reference Link'] = $dataList_value['reference_link'];
                    $dataList['Published Date'] = $dataList_value['published_date'];
                    $dataList['Revision Log Message'] = $dataList_value['revision_log_message'];
                    
                    $dataListKeys = array_keys($dataList);
                    // dd($dataListKeys);
                    $dataListMaster[]=$dataList;
                    $i++;
                }
            }
            return Excel::create('resolution_'.date('Y_m_d_H_i_s'), function($excel) use($dataListMaster){

                $excel->sheet('mySheet', function($sheet) use($dataListMaster)
                {
                    $sheet->fromArray($dataListMaster);
                });
            })->download('csv');
        }

        $columns = [
            ['data' => 'radio','name' => 'radio','title' => '','searchable' => false],
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
                ->editColumn('radio', function ($resolutions) {
                    return '<input type="radio" name="resolutions_id">';
                })
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
                ->rawColumns(['radio', 'board','department','file','published_date','actions'])
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
            "order"=> [9, "desc" ],
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


        $uploadPath = 'resolutions';
        $destinationPath = public_path($uploadPath);
                
        if($request->file('file'))
        {
            $file = $request->file('file');
            $file_name = time().$file->getFileName().'.'.$file->getClientOriginalExtension();
            $path = "/".$uploadPath."/";
            $this->CommonController->ftpFileUpload($uploadPath,$request->file('file'),$file_name);
            $dataToInsert['filepath'] = $path;
            $dataToInsert['filename'] = $file_name;
        }
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
        $uploadPath      = 'resolutions';
        $destinationPath = public_path($uploadPath);

        if ($request->has('file')){ 
            $file      = $request->file('file');
            $file_name = time().$file->getFileName().'.'.$file->getClientOriginalExtension();
            $this->CommonController->ftpFileUpload($uploadPath,$request->file('file'),$file_name);
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
            $resolution->filepath = '/'.$uploadPath.'/';
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
