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
        
        $columns = [
            ['data' => 'rownum','name' => 'rownum','title' => 'Sr No.','searchable' => false],
            ['data' => 'board','name' => 'board.board_name','title' => 'Board Name'],
            ['data' => 'department','name' => 'department.department_name','title' => 'Department Name'],
            ['data' => 'resolutionType','name' => 'resolutionType.name','title' => 'Resolution Type'],
            ['data' => 'title', 'name' => 'title', 'title' => 'Title/Subject'],
            ['data' => 'resolution_code','name' => 'resolution_code','title' => 'Resolution Code'],
            ['data' => 'published_date','name' => 'published_date','title' => 'Published Date','searchable' => false],
            ['data' => 'file','name' => 'file','title' => 'File','searchable' => false],
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

            $resolutions = $resolutions->selectRaw( DB::raw('@rownum  := @rownum  + 1 AS rownum').', id, board_id, department_id, resolution_type_id, title, resolution_code, published_date, filepath, filename');
            
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
                    return 'Yet to implement';
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
        Resolution::create([
            'board_id' => $request->board_id,
            'department_id' => $request->department_id,
            'resolution_type_id' => $request->resolution_type_id,
            'resolution_code' => $request->resolution_code,
            'title' => $request->title,
            'description' => $request->description,
            //'filepath' => $request->,
            //'filename' => $request->,
            'language' => $request->language,
            'reference_link' => $request->reference_link,
            'published_date' => $request->published_date,
            'revision_log_message' => $request->revision_log_message
        ]);

        return redirect('resolution')->with(['success'=> 'Record added succesfully']);
    }

    public function edit($id)
    {
        $resolution = Resolution::findOrFail($id);
        $boards = Board::where('status', 1)->get()->toArray();
        $resolutionTypes = ResolutionType::all()->toArray();
        $header_data = $this->header_data;
        return view('admin.resolution.edit', compact('header_data', 'boards', 'resolutionTypes', 'resolution'));
    }

    public function update(UpdateResolutionRequest $request, $id)
    {
        $resolution = Resolution::findOrFail($id);
        $resolution->update([
            'board_id' => $request->board_id,
            'department_id' => $request->department_id,
            'resolution_type_id' => $request->resolution_type_id,
            'resolution_code' => $request->resolution_code,
            'title' => $request->title,
            'description' => $request->description,
            //'filepath' => $request->,
            //'filename' => $request->,
            'language' => $request->language,
            'reference_link' => $request->reference_link,
            'published_date' => $request->published_date,
            'revision_log_message' => $request->revision_log_message
        ]);

        return redirect('resolution')->with(['success'=> 'Record updated succesfully']);
    }

    public function destroy($id)
    {
        $resolution = Resolution::findOrFail($id);

        DeletedResolution::create([
            'resolution_id' => $resolution->id,
            'resolution_type_id' => $resolution->resolution_type_id,
            'title' => $resolution->title,
            'description' => $resolution->description,
            'filepath' => $resolution->filepath,
            'filename' => $resolution->filename,
            'reason_for_delete' => 'Not Required'
        ]);

        $resolution->delete();

        return redirect()->back()->with(['success'=> 'Record deleted succesfully']);
    }
}
