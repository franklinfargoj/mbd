<?php
namespace App\Http\Controllers\CRUDAdmin;
use App\DeletedLayouts;
use App\MasterLayout;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Config;
use App\Board;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use Illuminate\Database\Eloquent\SoftDeletes;
class LayoutController extends Controller
{
    protected $list_num_of_records_per_page;

    public function __construct()
    {
        $this->list_num_of_records_per_page = Config::get('commanConfig.list_num_of_records_per_page');
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request,Datatables $datatables){
        $columns = [
            ['data' => 'rownum','name' => 'rownum','title' => 'Sr No.','searchable' => false],
            ['data' => 'layout_name','name' => 'layout_name','title' => 'Layout Name'],
            ['data' => 'division','name' => 'division','title' => 'Division'],
            ['data' => 'board','name' => 'board','title' => 'Board'],
//            ['data' => 'redirect_to', 'name' => 'redirect_to', 'title' => 'Redirect To'],
            ['data' => 'actions','name' => 'actions','title' => 'Actions','searchable' => false,'orderable'=>false],

        ];


//        $layout_data = $layout_data->selectRaw( DB::raw('@rownum  := @rownum  + 1 AS rownum').',name,division,board,redirect_to');

//        dd($layout_data);
//        return $datatables->of($layout_data);

        if ($datatables->getRequest()->ajax()) {

            DB::statement(DB::raw('set @rownum='. (isset($request->start) ? $request->start : 0) ));

            $layout_data = MasterLayout::all();

            return $datatables->of($layout_data)
                ->editColumn('rownum', function ($layout_data) {
                    static $i = 0;
                    $i++;
                    return $i;
                })
                ->editColumn('name', function ($layout_data) {
                    return $layout_data->layout_name;
                })
                ->editColumn('division', function ($layout_data) {
                    return $layout_data->division;
                })
                ->editColumn('board', function ($layout_data) {
                    return Board::where('id',$layout_data->board)->value('board_name');
                })
//                ->editColumn('redirect_to', function ($layout_data) {
//                    return $layout_data->redirect_to;
//                })
                ->editColumn('actions', function ($layout_data) {
                    return view('admin.crud_admin.layout.action', compact('layout_data'))->render();
                })

                ->rawColumns(['name', 'division', 'board'/*,'redirect_to'*/,'actions'])
                ->make(true);

        }

        $html = $datatables->getHtmlBuilder()->columns($columns)->parameters($this->getParameters());

        return view('admin.crud_admin.layout.index',compact('html'));

    }

    protected function getParameters() {
        return [
            'serverSide' => true,
            'processing' => true,
            'ordering'   =>'isSorted',
            "order"=> [0, "desc" ],
            "pageLength" => $this->list_num_of_records_per_page
        ];
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $arrData['board'] = Board::where('status', 1)->get();
        return view('admin.crud_admin.layout.create',compact('arrData'));

    }
    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'layout_name' => 'required|unique:master_layout,layout_name',
//            'division' => 'required',
            'board' => 'required',
//            'redirect_to' => 'required',
        ]);
        //create the new layout
        $layout = new MasterLayout();
        $layout->layout_name = $request->input('layout_name');
        $layout->division = $request->input('division');
        $layout->board = $request->input('board');
//        $layout->redirect_to = $request->input('redirect_to');
        $layout->save();

        return redirect()->route('layouts.index')
            ->with('success','Layout created successfully');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $arrData['board'] = Board::where('status', 1)->get();
        $layout = MasterLayout::FindOrFail($id)->toArray();

        return view('admin.crud_admin.layout.show', compact( 'layout','arrData'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $arrData['board'] = Board::where('status', 1)->get();
        $layout = MasterLayout::FindOrFail($id)->toArray();
        return view('admin.crud_admin.layout.edit',compact('layout','arrData'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'layout_name'=> 'required',
//            'division' => 'required',
            'board' => 'required',
//            'redirect_to' => 'required',
        ]);


        $layout = MasterLayout::FindOrFail($id);
        if($request->input('layout_name') != $layout['layout_name'] ){
            $layout->layout_name = $request->input('layout_name');
        }
        $layout->division = $request->input('division');
        $layout->board = $request->input('board');
//        $layout->redirect_to = $request->input('redirect_to');
        $layout->save();
        return redirect()->route('layouts.index')
            ->with('success','Layout updated successfully');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Request $request, $id)
    {
        $layoutDetails = MasterLayout::findOrfail($id);
        $layoutDetails->delete();

        DeletedLayouts::create([
            'layout_details_id' => $id,
            'layout_name'          => $layoutDetails->layout_name,
            'day'                => date('l'),
            'date'               => date('Y-m-d'),
            'time'               => date("h:i:s"),
            'reason'             => $request->input('delete_message'),
        ]);

        return redirect()->back()->with(['success'=> 'Layout deleted succesfully']);
    }

    public function loadDeleteLayoutUsingAjax(Request $request){
        $id = $request->id;
        return view('admin.crud_admin.layout.layoutDeleteReason', compact('id'))->render();
    }
}