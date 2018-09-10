<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Faq;
use App\Http\Requests\faq\CreateFaqRequest;
use App\Http\Requests\faq\UpdateFaqRequest;
use Config;

class FaqController extends Controller
{
    public $header_data = array(
        'menu' => 'FAQ',
        'menu_url' => 'faq',
        'page' => '',
        'side_menu' => 'faq'
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
      $faqs = Faq::all();
      $header_data = $this->header_data;
      return view('admin.faq.index',compact('faqs','header_data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $header_data = $this->header_data;
        return view('admin.faq.add',compact('header_data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateFaqRequest $request)
    {
        $input = $request->except('_token');
        Faq::create($input);
        return redirect('faq')->with(['success'=> 'Record Added succesfully']);
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
    public function edit(Faq $faq)
    {
        $header_data = $this->header_data;
        return view('admin.faq.edit',compact('faq','header_data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFaqRequest $request, $id)
    {
      $faq = Faq::find($id);
      $faq->update($request->except(['_token','method']));
      return redirect('faq')->with(['success'=> 'Record updated succesfully.']);
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

    public function change_status($id)
    {
      $faq = Faq::find($id);
      $staus =($faq->status==0)? 1 : 0;
      $faq->update(['status'=>$staus]);
      return redirect('faq')->with(['success'=> 'Status Changed succesfully.']);
    }
}
