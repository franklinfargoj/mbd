<?php

namespace App\Http\Controllers\ArchitectLayout;

use App\Http\Controllers\Common\CommonController;
use App\Http\Controllers\Controller;
use App\Http\Requests\ArchitectLayout\ArchitectLayoutDetailCrzDpRemark;
use App\Layout\ArchitectLayout;
use App\Layout\ArchitectLayoutCourtMatterDispute;
use App\Layout\ArchitectLayoutDetail;
use App\Layout\ArchitectLayoutDetailCtsPlanDetail;
use App\Layout\ArchitectLayoutDetailEEReport;
use App\Layout\ArchitectLayoutDetailEmReport;
use App\Layout\ArchitectLayoutDetailLandReport;
use App\Layout\ArchitectLayoutDetailPrCardDetail;
use App\Layout\ArchitectLayoutDetailREEReport;
use App\Layout\ArchitectLayoutStatusLog;
use Illuminate\Http\Request;
use Storage;
use Validator;
use DB;
use App\Layout\PrepareLayoutExcelLog;
use App\OlApplicationMaster;
use App\OlApplication;
use Yajra\DataTables\DataTables;

class LayoutArchitectDetailController extends Controller
{
    protected $common;
    protected $list_num_of_records_per_page;
    public function __construct(CommonController $CommonController)
    {
        $this->common = $CommonController;
        $this->list_num_of_records_per_page = config('commanConfig.list_num_of_records_per_page');
    }

    public function list_of_offer_letter_issued($layout_id)
    {
        $layout_id=decrypt($layout_id);
        $ArchitectLayout=ArchitectLayout::find($layout_id);
        $request=new Request;
        $datatables=new DataTables;
        $columns = [
            ['data' => 'rownum','name' => 'rownum','title' => 'Sr No.','searchable' => false],
            ['data' => 'application_no','name' => 'application_no','title' => 'Application No.'],
            ['data' => 'application_master_id','name' => 'application_master_id','title' => 'Model'],
            ['data' => 'created_at','name' => 'created_date','title' => 'Submission Date', 'class' => 'datatable-date'],
            ['data' => 'updated_at','name' => 'updated_at','title' => 'Certificate Issued Date', 'class' => 'datatable-date'],
            ['data' => 'status','name' => 'status','title' => 'Status'],
        ];
        if ($datatables->getRequest()->ajax()) {
        $application_master_arr = OlApplicationMaster::Where('title', 'like', '%New - Offer Letter%')->orWhere('title', 'like', '%Revalidation Of Offer Letter%')->pluck('id')->toArray();

            $ol_applications = OlApplication::where('layout_id', session()->get('layout_id'))->with(['ol_application_master', 'olApplicationStatus' => function($q){
                $q->where('society_flag', '1')->orderBy('id', 'desc');
            } ])->whereIn('application_master_id', $application_master_arr)->where('status_offer_letter',config('commanConfig.applicationStatus.sent_to_society'));
            $ol_applications = $ol_applications->get();

            $reval_master_ids_arr = config('commanConfig.revalidation_master_ids');
            return $datatables->of($ol_applications)
                ->editColumn('rownum', function ($ol_applications) {
                    static $i = 0;
                    $i++;
                    return $i;
                })
                ->editColumn('application_no', function ($ol_applications) use($reval_master_ids_arr) {
                    if(isset($ol_applications->is_noc_application))
                    {
                        $app_type = "<br><span class='m-badge m-badge--danger'>Application for Noc</span>";
                    }
                    elseif($ol_applications->is_noc_cc_application)
                    {
                        $app_type = "<br><span class='m-badge m-badge--warning'>Application for Noc (CC)</span>";
                    }
                    elseif(in_array($ol_applications->application_master_id,$reval_master_ids_arr))
                    {
                        $app_type = "<br><span class='m-badge m-badge--success'>Revalidation Of Offer letter</span>";
                    }
                    else
                    {
                        $app_type = "<br><span class='m-badge m-badge--success'>Application for Offer letter</span>";
                    }

                    return $ol_applications->application_no . $app_type;
                })
                ->editColumn('application_master_id', function ($ol_applications) {
                    return $ol_applications->ol_application_master->model;
                })
                ->editColumn('created_at', function ($ol_applications) {
                    return date(config('commanConfig.dateFormat'), strtotime($ol_applications->created_at));
                })
                ->editColumn('updated_at', function ($ol_applications) {
                    if($ol_applications->status_offer_letter==7)
                    {
                        return date(config('commanConfig.dateFormat'), strtotime($ol_applications->created_at));
                    }
                    return '-';
                })
                ->editColumn('status', function ($ol_applications) {
                    $certificate_link="";
                    $status = explode('_', array_keys(config('commanConfig.applicationStatus'), $ol_applications->olApplicationStatus[0]->status_id)[0]);
                    $status_display = '';
                    foreach($status as $status_value){ $status_display .= ucwords($status_value). ' ';}
                    $status_color = '';
                    if($status_display == 'Sent To Society'){
                        $status_display = 'Approved';
                    }
                    
                    if($ol_applications->status_offer_letter==7)
                    {
                        $certificate_link='<a class="d-flex flex-column align-items-center" title="Offer Letter Download" href="'.config('commanConfig.storage_server').'/'.$ol_applications->offer_letter_document_path.'"
                        target="_blank" rel="noopener"><span class="btn-icon btn-icon--delete"><img src="'.asset('/img/download-icon.svg').'"></span>Offer Letter Download</a>';
                    }
                    return '<div class="d-flex btn-icon-list"><span class="m-badge m-badge--'. config('commanConfig.applicationStatusColor.'.$ol_applications->olApplicationStatus[0]->status_id) .' m-badge--wide">'.$status_display.'</span>'.$certificate_link.'</div>';
                })
                // ->editColumn('model', function ($ol_applications) {
                //     return view('frontend.society.actions', compact('ol_applications', 'status_display'))->render();
                // })
                ->rawColumns(['application_no', 'application_master_id', 'created_at','updated_at','status'])
                ->make(true);
        }

        $html = $datatables->getHtmlBuilder()->columns($columns)->parameters($this->getParameters());
        return view('admin.architect_layout_detail.list_of_issued_offer_letters', compact('html', 'ol_applications', 'ol_application_count','ArchitectLayout'));
    }

    protected function getParameters() {
        return [
            'serverSide' => true,
            'processing' => true,
            'ordering'   =>'isSorted',
            "order"=> [4, "desc" ],
            "pageLength" => $this->list_num_of_records_per_page,
            // 'fixedHeader' => [
            //     'header' => true,
            //     'footer' => true
            // ]
            "filter" => [
                'class' => 'test_class'
            ]
        ];
    }

    public function add_detail($layout_id)
    {
        $add_detail=1;
        $layout_id = decrypt($layout_id);
        $status=getLastStatusIdArchitectLayout($layout_id);

        if($status->status_id==config('commanConfig.architect_layout_status.sent_for_revision') || $status->status_id==config('commanConfig.architect_layout_status.forward') || $status->status_id=!config('commanConfig.architect_layout_status.approved') || $status->status_id==config('commanConfig.architect_layout_status.scrutiny_pending'))
        {
            //dd('ok');
            $add_detail=0;

        }
        //dd($add_detail);
        if (count($this->common->check_layout_details_complete_status($layout_id)) == 0 && $add_detail==1) {
            $ArchitectLayoutDetail = new ArchitectLayoutDetail;
            $ArchitectLayoutDetail->architect_layout_id = $layout_id;
            $ArchitectLayoutDetail->save();
            $forward_application = [
                [
                    'architect_layout_id' => $layout_id,
                    'user_id' => auth()->user()->id,
                    'role_id' => session()->get('role_id'),
                    'status_id' => config('commanConfig.architect_layout_status.sent_for_revision'),
                    'to_user_id' => null,
                    'to_role_id' => null,
                    'open'=>1,
                    'remark' => null,
                ],
            ];
            $this->common->forward_architect_layout($layout_id,$forward_application);
            $set_blank_excel_layout=ArchitectLayout::find($layout_id);
            if($set_blank_excel_layout)
            {
                $set_blank_excel_layout->upload_layout_in_pdf_format="";
                $set_blank_excel_layout->upload_layout_in_excel_format="";
                $set_blank_excel_layout->upload_architect_note="";
                $set_blank_excel_layout->layout_excel_status=0;
                $set_blank_excel_layout->save();
                if($set_blank_excel_layout)
                {
                    $PrepareLayoutExcelLog=new PrepareLayoutExcelLog;
                    $PrepareLayoutExcelLog->architect_layout_id=$layout_id;
                    $PrepareLayoutExcelLog->save();
                }
            }
        } else {
            //dd($layout_id);
            $ArchitectLayoutDetail = ArchitectLayoutDetail::where(['architect_layout_id' => $layout_id])->orderBy('id', 'desc')->first();
            //dd($ArchitectLayoutDetail);
        }
        return redirect(route('architect_layout_detail.edit', ['layout_detail_id' => encrypt($ArchitectLayoutDetail->id)]));
    }

    public function edit_detail($layout_detail_id)
    {
        $layout_detail_id = decrypt($layout_detail_id);
        $ArchitectLayoutDetail = ArchitectLayoutDetail::with(['architect_layout', 'ee_reports', 'em_reports', 'ree_reports', 'land_reports'])->where(['id' => $layout_detail_id])->first();
        $ArchitectLayout = ArchitectLayout::with(['master_layout'])->where(['id' => $ArchitectLayoutDetail->architect_layout_id])->first();
        //dd($ArchitectLayout);
        return view('admin.architect_layout_detail.add', compact('ArchitectLayoutDetail', 'ArchitectLayout'));
    }

    public function uploadLatestLayoutAjax(Request $request)
    {
        $response_array = array();
        $file = $request->file('file');
        if ($file->getClientMimeType() == 'application/pdf') {
            $extension = $request->file('file')->getClientOriginalExtension();
            $dir = 'architect_layout_details';
            $filename = uniqid() . '_' . time() . '_' . date('Ymd') . '.' . $extension;
            $storage = Storage::disk('ftp')->putFileAs($dir, $request->file('file'), $filename);
            if ($storage) {
                $ArchitectLayoutDetail = ArchitectLayoutDetail::find($request->architect_layout_detail_id);
                if ($request->field_name == 'latest_layout') {
                    $ArchitectLayoutDetail->latest_layout = $storage;
                }
                if ($request->field_name == 'old_approved_layout') {
                    $ArchitectLayoutDetail->old_approved_layout = $storage;
                }
                if ($request->field_name == 'last_submitted_layout_for_approval') {
                    $ArchitectLayoutDetail->last_submitted_layout_for_approval = $storage;
                }
                if ($request->field_name == 'survey_report') {
                    $ArchitectLayoutDetail->survey_report = $storage;
                }
                $ArchitectLayoutDetail->save();
                $response_array = array(
                    'status' => true,
                    'file_path' => config('commanConfig.storage_server') . "/" . $storage,
                );
            } else {
                $response_array = array(
                    'status' => false,
                );
            }
        } else {
            $response_array = array(
                'status' => false,
                'message' => 'PDF file is required',
            );
        }

        return response()->json($response_array);
    }

    public function architectLyoutDetailPostEEDetails(Request $request)
    {
        $file = $request->file('file');
        if ($file->getClientMimeType() == 'application/pdf') {
            $extension = $request->file('file')->getClientOriginalExtension();
            $dir = 'architect_layout_details';
            $filename = uniqid() . '_' . time() . '_' . date('Ymd') . '.' . $extension;
            $storage = Storage::disk('ftp')->putFileAs($dir, $request->file('file'), $filename);
            if ($storage) {
                $ArchitectLayoutDetailEEReport = ArchitectLayoutDetailEEReport::where(['name_of_documents' => $request->doc_name, 'architect_layout_detail_id' => $request->architect_layout_detail_id])->first();
                if ($ArchitectLayoutDetailEEReport) {
                    $ArchitectLayoutDetailEEReport->architect_layout_detail_id = $request->architect_layout_detail_id;
                    $ArchitectLayoutDetailEEReport->name_of_documents = $request->doc_name;
                    $ArchitectLayoutDetailEEReport->upload_file = $storage;
                    $ArchitectLayoutDetailEEReport->save();
                } else {
                    $ArchitectLayoutDetailEEReport = new ArchitectLayoutDetailEEReport;
                    $ArchitectLayoutDetailEEReport->architect_layout_detail_id = $request->architect_layout_detail_id;
                    $ArchitectLayoutDetailEEReport->name_of_documents = $request->doc_name;
                    $ArchitectLayoutDetailEEReport->upload_file = $storage;
                    $ArchitectLayoutDetailEEReport->save();
                }

                $response_array = array(
                    'status' => true,
                    'file_path' => config('commanConfig.storage_server') . "/" . $storage,
                    'doc_id' => $ArchitectLayoutDetailEEReport->id,
                );
            } else {
                $response_array = array(
                    'status' => false,
                );
            }
        } else {
            $response_array = array(
                'status' => false,
                'message' => 'PDF file is required',
            );
        }
        return response()->json($response_array);
    }

    public function architectLyoutDetailDeleteEEDetail(Request $request)
    {
        //return $request->all();
        $ArchitectLayoutDetailEEReport = ArchitectLayoutDetailEEReport::where('id', $request->ee_doc_delete_id)->first();
        if ($ArchitectLayoutDetailEEReport) {
            $file = $ArchitectLayoutDetailEEReport->upload_file;
            if (Storage::disk('ftp')->has($file)) {
                Storage::disk('ftp')->delete($file);
            }
            $ArchitectLayoutDetailEEReport->delete();
        }
    }

    public function architectLyoutDetailPostEMDetails(Request $request)
    {
        $file = $request->file('file');
        if ($file->getClientMimeType() == 'application/pdf') {
            $extension = $request->file('file')->getClientOriginalExtension();
            $dir = 'architect_layout_details';
            $filename = uniqid() . '_' . time() . '_' . date('Ymd') . '.' . $extension;
            $storage = Storage::disk('ftp')->putFileAs($dir, $request->file('file'), $filename);
            if ($storage) {
                $ArchitectLayoutDetailEMReport = ArchitectLayoutDetailEmReport::where(['name_of_documents' => $request->doc_name, 'architect_layout_detail_id' => $request->architect_layout_detail_id])->first();
                if ($ArchitectLayoutDetailEMReport) {
                    $ArchitectLayoutDetailEMReport->architect_layout_detail_id = $request->architect_layout_detail_id;
                    $ArchitectLayoutDetailEMReport->name_of_documents = $request->doc_name;
                    $ArchitectLayoutDetailEMReport->upload_file = $storage;
                    $ArchitectLayoutDetailEMReport->save();
                } else {
                    $ArchitectLayoutDetailEMReport = new ArchitectLayoutDetailEmReport;
                    $ArchitectLayoutDetailEMReport->architect_layout_detail_id = $request->architect_layout_detail_id;
                    $ArchitectLayoutDetailEMReport->name_of_documents = $request->doc_name;
                    $ArchitectLayoutDetailEMReport->upload_file = $storage;
                    $ArchitectLayoutDetailEMReport->save();
                }

                $response_array = array(
                    'status' => true,
                    'file_path' => config('commanConfig.storage_server') . "/" . $storage,
                    'doc_id' => $ArchitectLayoutDetailEMReport->id,
                );
            } else {
                $response_array = array(
                    'status' => false,
                );
            }
        } else {
            $response_array = array(
                'status' => false,
                'message' => 'PDF file is required',
            );
        }
        return response()->json($response_array);
    }

    public function architectLyoutDetailDeleteEMDetail(Request $request)
    {
        //return $request->all();
        $ArchitectLayoutDetailEMReport = ArchitectLayoutDetailEmReport::where('id', $request->em_doc_delete_id)->first();
        if ($ArchitectLayoutDetailEMReport) {
            $file = $ArchitectLayoutDetailEMReport->upload_file;
            if (Storage::disk('ftp')->has($file)) {
                Storage::disk('ftp')->delete($file);
            }
            $ArchitectLayoutDetailEMReport->delete();
        }
    }

    public function architectLyoutDetailPostREEDetails(Request $request)
    {
        $file = $request->file('file');
        if ($file->getClientMimeType() == 'application/pdf') {
            $extension = $request->file('file')->getClientOriginalExtension();
            $dir = 'architect_layout_details';
            $filename = uniqid() . '_' . time() . '_' . date('Ymd') . '.' . $extension;
            $storage = Storage::disk('ftp')->putFileAs($dir, $request->file('file'), $filename);
            if ($storage) {
                $ArchitectLayoutDetailREEReport = ArchitectLayoutDetailREEReport::where(['name_of_documents' => $request->doc_name, 'architect_layout_detail_id' => $request->architect_layout_detail_id])->first();
                if ($ArchitectLayoutDetailREEReport) {
                    $ArchitectLayoutDetailREEReport->architect_layout_detail_id = $request->architect_layout_detail_id;
                    $ArchitectLayoutDetailREEReport->name_of_documents = $request->doc_name;
                    $ArchitectLayoutDetailREEReport->upload_file = $storage;
                    $ArchitectLayoutDetailREEReport->save();
                } else {
                    $ArchitectLayoutDetailREEReport = new ArchitectLayoutDetailREEReport;
                    $ArchitectLayoutDetailREEReport->architect_layout_detail_id = $request->architect_layout_detail_id;
                    $ArchitectLayoutDetailREEReport->name_of_documents = $request->doc_name;
                    $ArchitectLayoutDetailREEReport->upload_file = $storage;
                    $ArchitectLayoutDetailREEReport->save();
                }

                $response_array = array(
                    'status' => true,
                    'file_path' => config('commanConfig.storage_server') . "/" . $storage,
                    'doc_id' => $ArchitectLayoutDetailREEReport->id,
                );
            } else {
                $response_array = array(
                    'status' => false,
                );
            }
        } else {
            $response_array = array(
                'status' => false,
                'message' => 'PDF file is required',
            );
        }
        return response()->json($response_array);
    }

    public function architectLyoutDetailDeleteREEDetail(Request $request)
    {
        //return $request->all();
        $ArchitectLayoutDetailREEReport = ArchitectLayoutDetailREEReport::where('id', $request->ree_doc_delete_id)->first();
        if ($ArchitectLayoutDetailREEReport) {
            $file = $ArchitectLayoutDetailREEReport->upload_file;
            if (Storage::disk('ftp')->has($file)) {
                Storage::disk('ftp')->delete($file);
            }
            $ArchitectLayoutDetailREEReport->delete();
        }
    }

    public function architectLyoutDetailPostLandDetails(Request $request)
    {
        $file = $request->file('file');
        if ($file->getClientMimeType() == 'application/pdf') {
            $extension = $request->file('file')->getClientOriginalExtension();
            $dir = 'architect_layout_details';
            $filename = uniqid() . '_' . time() . '_' . date('Ymd') . '.' . $extension;
            $storage = Storage::disk('ftp')->putFileAs($dir, $request->file('file'), $filename);
            if ($storage) {
                $ArchitectLayoutDetailLandReport = ArchitectLayoutDetailLandReport::where(['name_of_documents' => $request->doc_name, 'architect_layout_detail_id' => $request->architect_layout_detail_id])->first();
                if ($ArchitectLayoutDetailLandReport) {
                    $ArchitectLayoutDetailLandReport->architect_layout_detail_id = $request->architect_layout_detail_id;
                    $ArchitectLayoutDetailLandReport->name_of_documents = $request->doc_name;
                    $ArchitectLayoutDetailLandReport->upload_file = $storage;
                    $ArchitectLayoutDetailLandReport->save();
                } else {
                    $ArchitectLayoutDetailLandReport = new ArchitectLayoutDetailLandReport;
                    $ArchitectLayoutDetailLandReport->architect_layout_detail_id = $request->architect_layout_detail_id;
                    $ArchitectLayoutDetailLandReport->name_of_documents = $request->doc_name;
                    $ArchitectLayoutDetailLandReport->upload_file = $storage;
                    $ArchitectLayoutDetailLandReport->save();
                }

                $response_array = array(
                    'status' => true,
                    'file_path' => config('commanConfig.storage_server') . "/" . $storage,
                    'doc_id' => $ArchitectLayoutDetailLandReport->id,
                );
            } else {
                $response_array = array(
                    'status' => false,
                );
            }
        } else {
            $response_array = array(
                'status' => false,
                'message' => 'PDF file is required',
            );
        }
        return response()->json($response_array);
    }

    public function view_cts_detail($layout_detail_id)
    {
        $layout_detail_id = decrypt($layout_detail_id);
        $ArchitectLayoutDetail = ArchitectLayoutDetail::with(['architect_layout', 'cts_plan_details'])->where(['id' => $layout_detail_id])->first();
        return view('admin.architect_layout_detail.view_cts_detail', compact('ArchitectLayoutDetail'));
    }

    public function add_cts_detail($layout_detail_id)
    {
        $layout_detail_id = decrypt($layout_detail_id);
        $ArchitectLayoutDetail = ArchitectLayoutDetail::with(['architect_layout', 'cts_plan_details'])->where(['id' => $layout_detail_id])->first();
        return view('admin.architect_layout_detail.cts_plan_detail', compact('ArchitectLayoutDetail'));
    }

    public function post_cts_detail(Request $request)
    {

        //return $request->all();
        $cts_plan_detail_ids = $request->cts_plan_detail_id;

        if ($request->hasFile('cts_plan_file')) {
            $file = $request->file('cts_plan_file');
            if ($file->getClientMimeType() == 'application/pdf') {
                $extension = $request->file('cts_plan_file')->getClientOriginalExtension();
                $dir = 'architect_layout_details';
                $filename = uniqid() . '_' . time() . '_' . date('Ymd') . '.' . $extension;
                $storage = Storage::disk('ftp')->putFileAs($dir, $request->file('cts_plan_file'), $filename);
                $ArchitectLayoutDetail = ArchitectLayoutDetail::find($request->architect_layout_detail_id);
                $ArchitectLayoutDetail->cts_plan = $storage;
                $ArchitectLayoutDetail->save();
            } else {
                return back()->withError('pdf file is required');
            }
        }
        $k = 0;
        foreach ($request->cts_no as $cts_n) {
            if (isset($cts_plan_detail_ids[$k])) {
                $Cts_plan = ArchitectLayoutDetailCtsPlanDetail::find($cts_plan_detail_ids[$k]);
                $Cts_plan->cts_no = $cts_n;
                $Cts_plan->save();
            } else {
                $Cts_plan = new ArchitectLayoutDetailCtsPlanDetail;
                $Cts_plan->architect_layout_detail_id = $request->architect_layout_detail_id;
                $Cts_plan->cts_no = $cts_n;
                $Cts_plan->save();
            }
            $k++;
        }
        return redirect()->route('architect_layout_detail.edit',['layout_detail_id'=>encrypt($request->architect_layout_detail_id),'#prc-tab'])->withSuccess('data added successfully!!');
        //return back()->withSuccess('Data added successfully');

    }

    public function delete_cts_detail(Request $request)
    {
        $ArchitectLayoutDetailCtsPlanDetail = ArchitectLayoutDetailCtsPlanDetail::where('id', $request->cts_detail_id)->first();
        if ($ArchitectLayoutDetailCtsPlanDetail) {
            if($ArchitectLayoutDetailCtsPlanDetail->delete())
            {
                return response()->json(['status'=>'success','message'=>'deleted successfully!!']);
            }
        }
        return response()->json(['status'=>'fail','message'=>'something went wrong']);
    }

    public function view_prc_detail($layout_detail_id)
    {
        $layout_detail_id = decrypt($layout_detail_id);
        $ArchitectLayoutDetail = ArchitectLayoutDetail::with(['architect_layout', 'cts_plan_details', 'pr_card_details'])->where(['id' => $layout_detail_id])->first();
        return view('admin.architect_layout_detail.view_prc_detail', compact('ArchitectLayoutDetail'));
    }

    public function add_prc_detail($layout_detail_id)
    {
        $layout_detail_id = decrypt($layout_detail_id);
        $ArchitectLayoutDetail = ArchitectLayoutDetail::with(['architect_layout', 'cts_plan_details', 'pr_card_details'])->where(['id' => $layout_detail_id])->first();
        return view('admin.architect_layout_detail.prc_detail', compact('ArchitectLayoutDetail'));
    }

    public function post_prc_detail(Request $request)
    {
        $request->validate([
            'cts_no' => 'required',
            '*.pr_cards' => 'mimes:pdf',
        ]);
        $pr_card_detail_ids = $request->pr_card_detail_id;
        $cts_no_ids = $request->cts_no;
        $cts_files = $request->file('pr_cards');
        $i = 0;
        if (is_array($cts_no_ids)) {
            foreach ($cts_no_ids as $cts_no_id) {
                if (isset($cts_files[$i])) {
                    $extension = $cts_files[$i]->getClientOriginalExtension();
                    $dir = 'architect_layout_details/pr_cards';
                    $filename = uniqid() . '_' . time() . '_' . date('Ymd') . '.' . $extension;
                    $storage = Storage::disk('ftp')->putFileAs($dir, $cts_files[$i], $filename);
                } else {
                    $storage = "";
                }
                if (isset($pr_card_detail_ids[$i])) {
                    $ArchitectLayoutDetailPrCardDetail = ArchitectLayoutDetailPrCardDetail::find($pr_card_detail_ids[$i]);
                    if ($ArchitectLayoutDetailPrCardDetail) {
                        $ArchitectLayoutDetailPrCardDetail->architect_layout_detail_id = $request->architect_layout_detail_id;
                        $ArchitectLayoutDetailPrCardDetail->architect_layout_detail_cts_plan_detail_id = $cts_no_id;
                        if ($storage != "") {
                            $ArchitectLayoutDetailPrCardDetail->upload_pr_card = $storage;
                        }
                        $ArchitectLayoutDetailPrCardDetail->save();
                    }
                } else {
                    $ArchitectLayoutDetailPrCardDetail = new ArchitectLayoutDetailPrCardDetail;
                    $ArchitectLayoutDetailPrCardDetail->architect_layout_detail_id = $request->architect_layout_detail_id;
                    $ArchitectLayoutDetailPrCardDetail->architect_layout_detail_cts_plan_detail_id = $cts_no_id;
                    if ($storage != "") {
                        $ArchitectLayoutDetailPrCardDetail->upload_pr_card = $storage;
                    }
                    $ArchitectLayoutDetailPrCardDetail->save();
                }
                $i++;
            }
        }
        return redirect()->route('architect_layout_detail.edit',['layout_detail_id'=>encrypt($request->architect_layout_detail_id),'#dp-remark-tab'])->withSuccess('data uploaded successfully!!');
        //return back()->withSuccess('Data added successfully');
    }

    public function delete_prc_detail(Request $request)
    {
        $ArchitectLayoutDetailPrCardDetai = ArchitectLayoutDetailPrCardDetail::where('id', $request->pr_card_detail_id)->first();
        if ($ArchitectLayoutDetailPrCardDetai) {
            $file = $ArchitectLayoutDetailPrCardDetai->upload_pr_card;
            if (Storage::disk('ftp')->has($file)) {
                Storage::disk('ftp')->delete($file);
            }
            if($ArchitectLayoutDetailPrCardDetai->delete())
            {
                return response()->json(['status'=>'success','message'=>'deleted successfully!!']);
            }else
            return response()->json(['status'=>'fail','message'=>'something went wrong']);
        }
        return response()->json(['status'=>'fail','message'=>'something went wrong']);
    }

    public function view_dp_crz_remark($layout_detail_id)
    {
        $layout_detail_id = decrypt($layout_detail_id);
        $ArchitectLayoutDetail = ArchitectLayoutDetail::where(['id' => $layout_detail_id])->first();
        return view('admin.architect_layout_detail.view_dp_crz_remark', compact('ArchitectLayoutDetail'));
    }

    public function add_dp_crz_remark($layout_detail_id)
    {
        $layout_detail_id = decrypt($layout_detail_id);
        $ArchitectLayoutDetail = ArchitectLayoutDetail::where(['id' => $layout_detail_id])->first();
        return view('admin.architect_layout_detail.dp_crz_remark', compact('ArchitectLayoutDetail'));
    }

    public function post_dp_crz_remark(Request $request)
    {
        $validator = Validator::make($request->all(), (new ArchitectLayoutDetailCrzDpRemark)->rules());
        $dp_letter = "";
        $dp_plan = "";
        $crz_letter = "";
        $crz_plan = "";

        $ArchitectLayoutDetail = ArchitectLayoutDetail::find($request->architect_layout_detail_id);
        if ($ArchitectLayoutDetail->dp_letter == "" && !$request->hasFile('dp_remark_letter')) {
            $validator->after(function ($validator) {
                $validator->errors()->add('dp_remark_letter', 'Dp letter is required');
            });
        }
        if ($ArchitectLayoutDetail->dp_plan == "" && !$request->hasFile('dp_remark_plan')) {
            $validator->after(function ($validator) {
                $validator->errors()->add('dp_remark_plan', 'DP Plan is required');
            });
        }
        if ($ArchitectLayoutDetail->crz_letter == "" && !$request->hasFile('crz_remark_letter')) {
            $validator->after(function ($validator) {

                $validator->errors()->add('crz_remark_letter', 'CRZ letter is required');
            });
        }
        if ($ArchitectLayoutDetail->crz_plan == "" && !$request->hasFile('crz_remark_plan')) {
            $validator->after(function ($validator) {
                $validator->errors()->add('crz_remark_plan', 'CRZ Plan is required');
            });
        }
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        if ($request->hasFile('dp_remark_letter')) {
            $extension = $request->file('dp_remark_letter')->getClientOriginalExtension();
            $dir = 'architect_layout_details';
            $filename = uniqid() . '_' . time() . '_' . date('Ymd') . '.' . $extension;
            $dp_letter = Storage::disk('ftp')->putFileAs($dir, $request->file('dp_remark_letter'), $filename);
        }
        if ($request->hasFile('dp_remark_plan')) {
            $extension = $request->file('dp_remark_plan')->getClientOriginalExtension();
            $dir = 'architect_layout_details';
            $filename = uniqid() . '_' . time() . '_' . date('Ymd') . '.' . $extension;
            $dp_plan = Storage::disk('ftp')->putFileAs($dir, $request->file('dp_remark_plan'), $filename);
        }
        if ($request->hasFile('crz_remark_letter')) {
            $extension = $request->file('crz_remark_letter')->getClientOriginalExtension();
            $dir = 'architect_layout_details';
            $filename = uniqid() . '_' . time() . '_' . date('Ymd') . '.' . $extension;
            $crz_letter = Storage::disk('ftp')->putFileAs($dir, $request->file('crz_remark_letter'), $filename);
        }
        if ($request->hasFile('crz_remark_plan')) {
            $extension = $request->file('crz_remark_plan')->getClientOriginalExtension();
            $dir = 'architect_layout_details';
            $filename = uniqid() . '_' . time() . '_' . date('Ymd') . '.' . $extension;
            $crz_plan = Storage::disk('ftp')->putFileAs($dir, $request->file('crz_remark_plan'), $filename);
        }
        if ($dp_letter != "") {
            $ArchitectLayoutDetail->dp_letter = $dp_letter;
        }
        if ($dp_plan != "") {
            $ArchitectLayoutDetail->dp_plan = $dp_plan;
        }
        if ($crz_letter != "") {
            $ArchitectLayoutDetail->crz_letter = $crz_letter;
        }
        if ($crz_plan != "") {
            $ArchitectLayoutDetail->crz_plan = $crz_plan;
        }
        $ArchitectLayoutDetail->dp_comment = $request->dp_comment;
        $ArchitectLayoutDetail->crz_comment = $request->crz_comment;
        $ArchitectLayoutDetail->save();
        if ($ArchitectLayoutDetail) {
            return redirect()->route('architect_layout_detail.edit',['layout_detail_id'=>encrypt($ArchitectLayoutDetail->id),'#layouts_upload'])->withSuccess('data uploaded successfully!!');
        } else {
            return back()->withError('Something went wrong');
        }

    }

    public function view_court_case_or_dispute_on_land($layout_detail_id)
    {
        $layout_detail_id = decrypt($layout_detail_id);
        $ArchitectLayoutDetail = ArchitectLayoutDetail::find($layout_detail_id);
        $courCassesOrDisputes = ArchitectLayoutCourtMatterDispute::where(['architect_layout_detail_id'=>$layout_detail_id])->get();
        return view('admin.architect_layout_detail.view_court_case_or_dispute', compact('ArchitectLayoutDetail', 'courCassesOrDisputes'));
    }
}
