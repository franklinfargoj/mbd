<?php

namespace App\Http\Controllers\ArchitectLayout;

use App\Http\Controllers\Controller;
use App\Http\Requests\ArchitectLayout\ArchitectLayoutDetailCrzDpRemark;
use App\Layout\ArchitectLayout;
use App\Layout\ArchitectLayoutDetail;
use App\Layout\ArchitectLayoutDetailCtsPlanDetail;
use App\Layout\ArchitectLayoutDetailEEReport;
use App\Layout\ArchitectLayoutDetailEmReport;
use App\Layout\ArchitectLayoutDetailLandReport;
use App\Layout\ArchitectLayoutDetailPrCardDetail;
use App\Layout\ArchitectLayoutDetailREEReport;
use App\Layout\ArchitectLayoutCourtMatterDispute;
use Illuminate\Http\Request;
use Storage;
use Validator;

class LayoutArchitectDetailController extends Controller
{
    public function add_detail($layout_id)
    {
        $layout_id = decrypt($layout_id);
        $ArchitectLayoutDetail = ArchitectLayoutDetail::with(['architect_layout', 'ee_reports', 'em_reports', 'ree_reports', 'land_reports'])->where(['id' => $layout_id])->first();
        //dd();
        return view('admin.architect_layout_detail.add', compact('ArchitectLayoutDetail'));
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

        return back()->withSuccess('Data added successfully');

    }

    public function delete_cts_detail(Request $request)
    {
        $ArchitectLayoutDetailCtsPlanDetail = ArchitectLayoutDetailCtsPlanDetail::where('id', $request->cts_detail_id)->first();
        if ($ArchitectLayoutDetailCtsPlanDetail) {
            return $ArchitectLayoutDetailCtsPlanDetail->delete();
        }
        return false;
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
        return back()->withSuccess('Data added successfully');
    }

    public function delete_prc_detail(Request $request)
    {
        $ArchitectLayoutDetailPrCardDetai = ArchitectLayoutDetailPrCardDetail::where('id', $request->pr_card_detail_id)->first();
        if ($ArchitectLayoutDetailPrCardDetai) {
            $file = $ArchitectLayoutDetailPrCardDetai->upload_pr_card;
            if (Storage::disk('ftp')->has($file)) {
                Storage::disk('ftp')->delete($file);
            }
            return $ArchitectLayoutDetailPrCardDetai->delete();
        }
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
            return back()->withSuccess('data uploaded successfully!!');
        } else {
            return back()->withError('Something went wrong');
        }

    }

    public function view_court_case_or_dispute_on_land($layout_detail_id)
    {
        $layout_detail_id = decrypt($layout_detail_id);
        $ArchitectLayoutDetail = ArchitectLayoutDetail::find($layout_detail_id);
        $courCassesOrDisputes = ArchitectLayoutCourtMatterDispute::all();
        return view('admin.architect_layout_detail.view_court_case_or_dispute', compact('ArchitectLayoutDetail', 'courCassesOrDisputes'));
    }
}
