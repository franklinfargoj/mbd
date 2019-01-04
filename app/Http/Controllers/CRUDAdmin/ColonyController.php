<?php
namespace App\Http\Controllers\CRUDAdmin;
use App\DeletedColony;
use App\MasterColony;
use App\MasterLayout;
use App\MasterWard;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;
use Yajra\DataTables\DataTables;


class ColonyController extends Controller
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
    public function index(Request $request, DataTables $datatables){

        $columns = [
            ['data' => 'rownum','name' => 'rownum','title' => 'Sr No.','searchable' => false],
            ['data' => 'name','name' => 'name','title' => 'Name'],
            ['data' => 'actions','name' => 'actions','title' => 'Actions','searchable' => false,'orderable'=>false],
        ];
//dd($datatables->getRequest()->ajax());
        if ($datatables->getRequest()->ajax()) {
            DB::statement(DB::raw('set @rownum='. (isset($request->start) ? $request->start : 0) ));

            $colony_data = MasterColony::all();
            return $datatables->of($colony_data)
                ->editColumn('rownum', function ($colony_data) {
                    static $i = 0;
                    $i++;
                    return $i;
                })
                ->editColumn('name', function ($colony_data) {
                    return $colony_data->name;
                })
                ->editColumn('actions', function ($colony_data) {
                    return view('admin.crud_admin.colony.action', compact('colony_data'))->render();
                })

                ->rawColumns(['name','actions'])
                ->make(true);

        }

        $html = $datatables->getHtmlBuilder()->columns($columns)->parameters($this->getParameters());

        return view('admin.crud_admin.colony.index',compact('html'));

    }

    protected function getParameters() {
        return [
            'serverSide' => true,
            'processing' => true,
            'ordering'   =>'isSorted',
//            "order"=> [2, "desc" ],
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
        $layouts = MasterLayout::get();
        $wards = MasterWard::get();
        return view('admin.crud_admin.colony.create',compact('layouts','wards'));

    }
    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:master_colonies,name',
            'ward_id' => 'required'
        ]);
        //create the new role
        $colony = new MasterColony();
        $colony->name = $request->input('name');
        $colony->ward_id = $request->input('ward_id');
        $colony->save();

        return redirect()->route('colony.index')
            ->with('success','Colony created successfully');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
//        dd($id);
        $colony = MasterColony::FindOrFail($id)->toArray();
        $layouts = MasterLayout::get();
        $wards = MasterWard::get();
        return view('admin.crud_admin.colony.show', compact( 'colony','wards','layouts'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $colony = MasterColony::FindOrFail($id)->toArray();
        $layouts = MasterLayout::get();
        $wards = MasterWard::get();
        return view('admin.crud_admin.colony.edit',compact('colony','wards','layouts'));
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
            'name' => 'required',
            'ward_id' => 'required'
        ]);

        $colony = MasterColony::FindOrFail($id);
        if($request->input('name') != $colony['name'] ){
            $colony->name = $request->input('name');
        }

        if($request->input('ward_id') != $colony['ward_id'] ){
            $colony->ward_id = $request->input('ward_id');
        }


        $colony->save();
        return redirect()->route('colony.index')
            ->with('success','Colony updated successfully');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Request $request, $id)
    {
        $colonyDetails = MasterColony::findOrfail($id);
        $colonyDetails->delete();

        DeletedColony::create([
            'colony_details_id'  => $id,
            'name'              => $colonyDetails->name,
            'day'               => date('l'),
            'date'              => date('Y-m-d'),
            'time'              => date("h:i:s"),
            'reason'             => $request->input('delete_message'),
        ]);

        return redirect()->back()->with(['success'=> 'Colony deleted succesfully']);
    }

    public function loadDeleteColonyUsingAjax(Request $request){
        $id = $request->id;
        return view('admin.crud_admin.colony.colonyDeleteReason', compact('id'))->render();
    }

    public function loadWardsOfLayoutUsingAjax(Request $request)
    {
        $layout_id = $request->layout_id;

        $wards = MasterWard::where('layout_id', $layout_id)->get();

        $options = '<option value="">Select Ward</option>';

        foreach ($wards as $ward) {
            $options .= '<option value="' . $ward['id'] . '">' . $ward['name'] . '</option>';
        }

        return $options;
    }
}
