<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Resolution;
use App\Board;
use App\ResolutionType;
use Yajra\DataTables\DataTables;
use DB;

class FrontendResolutionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Datatables $datatables)
    {
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
            ['data' => 'file','name' => 'file','title' => 'File','searchable' => false]
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
                ->rawColumns(['board','department','file','published_date'])
                ->make(true);
        }
        
        $html = $datatables->getHtmlBuilder()->columns($columns)->parameters($this->getParameters());
        
        return view('frontend_resolution_list', compact('html','boards','resolutionTypes','getData'));
    }

    protected function getParameters() {
        return [
            'serverSide' => true,
            'processing' => true,
            'ordering'   =>'isSorted',
            // 'fixedHeader' => [
            //     'header' => true,
            //     'footer' => true
            // ]
        ];
    }
}
