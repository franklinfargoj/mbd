<?php

namespace App\Http\Controllers;
use Yajra\DataTables\DataTables;
use App\MasterEmailTemplates;
use Illuminate\Http\Request;
use Config;

class EmailTemplateController extends Controller
{

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
    public function index(Request $request, DataTables $datatables)
    {
        // dd(MasterEmailTemplates::all());
        $columns = [
            ['data' => 'type','name' => 'type','title' => 'Email type'],
            ['data' => 'body','name' => 'body','title' => 'Body'],
            ['data' => 'actions','name' => 'actions','title' => 'Actions','searchable' => false,'orderable'=>false],
        ];


        if ($datatables->getRequest()->ajax()) {
            
            $email_templates = MasterEmailTemplates::all();
            
            return $datatables->of($email_templates)
                ->editColumn('type', function ($email_templates) {
                    return $email_templates->type;
                })
                ->editColumn('body', function ($email_templates) {
                    return $email_templates->body;
                })
                ->editColumn('actions', function ($email_templates) {
                   return view('admin.email_templates.actions', compact('email_templates'))->render();
                })
                ->rawColumns(['type','from_email','sent_to','subject','body','actions'])
                ->make(true);
        }
        
        $html = $datatables->getHtmlBuilder()->columns($columns)->postAjax()->parameters($this->getParameters());
        return view('admin.email_templates.index', compact('email_templates', 'html'));
    }

    protected function getParameters() {
        return [
            'serverSide' => true,
            'processing' => true,
            'ordering'   =>'isSorted',
            "order"=> [2, "desc" ],
            "pageLength" => $this->list_num_of_records_per_page,
            // 'fixedHeader' => [
            //     'header' => true,
            //     'footer' => true
            // ]
        ];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.email_templates.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->input());
        $input = array(
            'type' => $request->input('type'),
            'body' => $request->input('body')
        );
        MasterEmailTemplates::create($input);
        return redirect()->route('email_templates.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $email_template = MasterEmailTemplates::find($id);
        return view('admin.email_templates.edit',compact('email_template'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd($request->input());
        $input = array(
            'type' => $request->input('type'),
            'body' => $request->input('body')
        );
        MasterEmailTemplates::where('id', $id)->update($input);
        return redirect()->route('email_templates.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
