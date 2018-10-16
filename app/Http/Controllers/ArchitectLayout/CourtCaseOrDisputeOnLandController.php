<?php

namespace App\Http\Controllers\ArchitectLayout;

use App\Http\Controllers\Controller;
use App\Http\Requests\ArchitectLayout\CourtCaseOrDisputeOnLand;
use App\Layout\ArchitectLayoutCourtMatterDispute;
use App\Layout\ArchitectLayoutDetail;
use Illuminate\Http\Request;
use Storage;

class CourtCaseOrDisputeOnLandController extends Controller
{
    public function index($layout_detail_id)
    {
        $layout_detail_id = decrypt($layout_detail_id);
        $ArchitectLayoutDetail = ArchitectLayoutDetail::find($layout_detail_id);
        $courCassesOrDisputes = ArchitectLayoutCourtMatterDispute::where(['architect_layout_detail_id'=>$layout_detail_id])->get();
        return view('admin.architect_layout_detail.court_case_or_dispute_on_land.index', compact('ArchitectLayoutDetail', 'courCassesOrDisputes'));
    }

    public function create($layout_detail_id)
    {
        $layout_detail_id = decrypt($layout_detail_id);
        $ArchitectLayoutDetail = ArchitectLayoutDetail::find($layout_detail_id);
        return view('admin.architect_layout_detail.court_case_or_dispute_on_land.create', compact('ArchitectLayoutDetail'));
    }

    public function store(CourtCaseOrDisputeOnLand $request)
    {
        $extension = $request->file('doc_file')->getClientOriginalExtension();
        $dir = 'architect_layout_details';
        $filename = uniqid() . '_' . time() . '_' . date('Ymd') . '.' . $extension;
        $storage = Storage::disk('ftp')->putFileAs($dir, $request->file('doc_file'), $filename);
        if ($storage) {
            $ArchitectLayoutCourtMatterDispute = new ArchitectLayoutCourtMatterDispute;
            $ArchitectLayoutCourtMatterDispute->architect_layout_detail_id = $request->architect_layout_detail_id;
            $ArchitectLayoutCourtMatterDispute->document_name = $request->document_name;
            $ArchitectLayoutCourtMatterDispute->document_file = $storage;
            $ArchitectLayoutCourtMatterDispute->description = $request->description;
            $ArchitectLayoutCourtMatterDispute->save();
            if ($ArchitectLayoutCourtMatterDispute) {
                return back()->withSuccess('Details Added Successfully!!!');
            }
            return back()->withError('Something Went Wrong');
        } else {
            return back()->withError('File Not Uploaded');
        }
    }

    public function edit($id)
    {
        $id = decrypt($id);
        $courCassesOrDisputes = ArchitectLayoutCourtMatterDispute::find($id);
        $ArchitectLayoutDetail = ArchitectLayoutDetail::find($courCassesOrDisputes->architect_layout_detail_id);
        return view('admin.architect_layout_detail.court_case_or_dispute_on_land.edit', compact('ArchitectLayoutDetail', 'courCassesOrDisputes'));
    }

    public function update(Request $request)
    {
        $this->validate($request, ['document_name' => 'required',
            'description' => 'required']);
        $ArchitectLayoutCourtMatterDispute = ArchitectLayoutCourtMatterDispute::where(['id' => $request->court_case_or_dispute_on_land_id, 'architect_layout_detail_id' => $request->architect_layout_detail_id])->first();
        if ($ArchitectLayoutCourtMatterDispute) {
            $ArchitectLayoutCourtMatterDispute->architect_layout_detail_id = $request->architect_layout_detail_id;
            $ArchitectLayoutCourtMatterDispute->document_name = $request->document_name;
            $ArchitectLayoutCourtMatterDispute->description = $request->description;
            $ArchitectLayoutCourtMatterDispute->save();
            if ($ArchitectLayoutCourtMatterDispute) {
                if ($request->hasFile('doc_file')) {
                    $this->validate($request, [
                        'doc_file' => 'required|mimes:pdf']);
                    $extension = $request->file('doc_file')->getClientOriginalExtension();
                    $dir = 'architect_layout_details';
                    $filename = uniqid() . '_' . time() . '_' . date('Ymd') . '.' . $extension;
                    $storage = Storage::disk('ftp')->putFileAs($dir, $request->file('doc_file'), $filename);
                    $ArchitectLayoutCourtMatterDispute->document_file = $storage;
                    $ArchitectLayoutCourtMatterDispute->save();
                }
                return back()->withSuccess('Details Added Successfully!!!');
            }
            return back()->withError('Something Went Wrong');
        }
        return back()->withError('Something Went Wrong');
    }

    public function show($id)
    {
        $id = decrypt($id);
        $courCassesOrDisputes = ArchitectLayoutCourtMatterDispute::find($id);
        $ArchitectLayoutDetail = ArchitectLayoutDetail::find($courCassesOrDisputes->architect_layout_detail_id);
        return view('admin.architect_layout_detail.court_case_or_dispute_on_land.show', compact('ArchitectLayoutDetail', 'courCassesOrDisputes'));
    }

    public function destroy(Request $request, $id)
    {
        $id = decrypt($id);
        $courCassesOrDisputes = ArchitectLayoutCourtMatterDispute::find($id);
        if ($courCassesOrDisputes) {
            $courCassesOrDisputes->delete();
            return back()->withSuccess('deleted successfully');
        }
        return back()->withError('Could not delete');
    }
}
