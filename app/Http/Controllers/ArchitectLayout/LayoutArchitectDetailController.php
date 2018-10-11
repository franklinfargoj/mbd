<?php

namespace App\Http\Controllers\ArchitectLayout;

use App\Http\Controllers\Controller;
use App\Layout\ArchitectLayout;
use App\Layout\ArchitectLayoutDetail;
use App\Layout\ArchitectLayoutDetailCtsPlanDetail;
use App\Layout\ArchitectLayoutDetailPrCardDetail;
use Illuminate\Http\Request;
use Storage;

class LayoutArchitectDetailController extends Controller
{
    public function add_detail($layout_id)
    {
        $layout_id = decrypt($layout_id);
        $ArchitectLayoutDetail = ArchitectLayoutDetail::with(['architect_layout'])->where(['id' => $layout_id])->first();
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

    public function add_prc_detail($layout_detail_id)
    {
        $layout_detail_id = decrypt($layout_detail_id);
        $ArchitectLayoutDetail = ArchitectLayoutDetail::with(['architect_layout', 'cts_plan_details', 'pr_card_details'])->where(['id' => $layout_detail_id])->first();
        return view('admin.architect_layout_detail.prc_detail', compact('ArchitectLayoutDetail'));
    }

    public function post_prc_detail(Request $request)
    {
        //dd($request->all());
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

    public function add_dp_crz_remark($layout_detail_id)
    {
        $layout_detail_id = decrypt($layout_detail_id);
        $ArchitectLayoutDetail = ArchitectLayoutDetail::where(['id' => $layout_detail_id])->first();
        return view('admin.architect_layout_detail.dp_crz_remark', compact('ArchitectLayoutDetail'));
    }

    public function post_dp_crz_remark(Request $request)
    {
        dd($request);
    }
}
