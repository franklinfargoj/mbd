<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Resolution;
use App\DeletedResolution;
use App\Board;
use App\ResolutionType;
use Config;

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
    public function index()
    {
        $resolutions = Resolution::all();
        $header_data = $this->header_data;
        return view('admin.resolution.index', compact('resolutions','header_data'));
    }

    public function create()
    {
        $boards = Board::where('status', 1)->get()->toArray();
        $resolutionTypes = ResolutionType::all()->toArray();
        $header_data = $this->header_data;
        return view('admin.resolution.add', compact('header_data', 'boards', 'resolutionTypes'));
    }

    public function store(Request $request)
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

    public function update(Request $request, $id)
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
