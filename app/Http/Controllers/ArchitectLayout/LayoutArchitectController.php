<?php

namespace App\Http\Controllers\ArchitectLayout;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Common\CommonController;
use Yajra\DataTables\DataTables;
use App\Layout\ArchitectLayout;
use Carbon\Carbon;
use App\Http\Requests\ArchitectLayout\AddLayout;
use App\Layout\ArchitectLayoutDetail;

class LayoutArchitectController extends Controller
{
    protected $architect_layouts;
    public function __construct(CommonController $CommonController)
    {
        $this->architect_layouts=$CommonController;
        $this->list_num_of_records_per_page = Config('commanConfig.list_num_of_records_per_page');
    }

    public function index(Request $request, Datatables $datatables)
    {
        $getData = $request->all();
        //return $this->architect_layouts->architect_layout_data($request);
        $columns = [
            ['data' => 'radio','name' => 'radio','title' => '','searchable' => false],
            ['data' => 'rownum','name' => 'rownum','title' => 'Sr No.','searchable' => false],
            ['data' => 'layout_no','name' => 'layout_no','title' => 'Layout No'],
            ['data' => 'layout_name','name' => 'layout_name','title' => 'Layout Name', 'class' => 'datatable-date'],
            ['data' => 'address','name' => 'address','title' => 'Society Name'],
            ['data' => 'Status','name' => 'Status','title' => 'Status'],
        ];

        if ($datatables->getRequest()->ajax()) {

            $architect_layout_data =  $this->architect_layouts->architect_layout_data($request);

            return $datatables->of($architect_layout_data)
                ->editColumn('radio', function ($listArray) {
                    $url = route('architect_layout_details.view', encrypt($listArray->id));
                    return '<label class="m-radio m-radio--primary m-radio--link"><input type="radio" onclick="geturl(this.value);" value="'.$url.'" name="village_data_id"><span></span></label>';
                })       
                ->editColumn('rownum', function ($listArray) {
                    static $i = 0; $i++; return $i;
                })             
                ->editColumn('layout_no', function ($listArray) {
                    return $listArray->layout_no;
                })
                ->editColumn('layout_name', function ($listArray) {
                    return $listArray->layout_name;
                })
                ->editColumn('address', function ($listArray) {
                    return $listArray->address;
                })
                ->editColumn('Status', function ($listArray) use ($request) {
                    return "New Application";

                })
                ->editColumn('added_date', function ($listArray) {
                    return date(config('commanConfig.dateFormat'), strtotime($listArray->added_date));
                })
                // ->editColumn('actions', function ($ee_application_data) use($request) {
                //     return view('admin.ee_department.actions', compact('ee_application_data', 'request'))->render();
                // })
                ->rawColumns(['radio','layout_no','layout_name', 'address', 'Status', 'added_date'])
                ->make(true);
        }

        $html = $datatables->getHtmlBuilder()->columns($columns)->parameters($this->getParameters());

        return view('admin.architect_layout.index', compact('html','header_data','getData'));
    }

    public function genRand()
    {
       return time().rand(100000, 999999);
    }

    protected function getParameters() {
        return [
            'serverSide' => true,
            'processing' => true,
            'ordering'   =>'isSorted',
            //"order"=> [4, "asc" ],
            "pageLength" => $this->list_num_of_records_per_page
        ];
    }

    public function add_layout()
    {
        return view('admin.architect_layout.add',compact('header_data'));
    }

    public function store_layout(AddLayout $request)
    {
        $layout_data=array(
            'layout_no'=> $this->genRand(),
            'layout_name'=> $request->layout_name,
            'address'=> $request->layout_address,
            'added_date'=> Carbon::now()
        );
        $ArchitectLayout=ArchitectLayout::create($layout_data);
        if($ArchitectLayout)
        {
            $ArchitectLayoutDetail=new ArchitectLayoutDetail;
            $ArchitectLayoutDetail->architect_layout_id=$ArchitectLayout->id;
            $ArchitectLayoutDetail->save();
            return redirect(route('architect_layout_detail.add',['layout_id'=>encrypt($ArchitectLayoutDetail->id)]));
        }
        return back()->withError('something went wrong');
    }

    public function view_architect_layout_details($layout_id)
    {
        $layout_id=decrypt($layout_id);
        $ArchitectLayout=ArchitectLayout::with(['layout_details'])->find($layout_id);
        return view('admin.architect_layout_detail.view',compact('ArchitectLayout'));
    }
    
}
