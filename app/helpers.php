<?php

use App\ArchitectApplicationStatusLog;
use App\Layout\ArchitectLayout;
use App\Layout\ArchitectLayoutDetail;
use App\Layout\ArchitectLayoutScrutinyEMReport;
use App\Layout\ArchitectLayoutStatusLog;
use App\RtiForwardApplication;
use App\Layout\ArchitectLayoutScrutinyLandReport;
use App\Layout\ArchitectLayoutScrutinyEEReport;
use App\Layout\ArchitectLayoutScrutinyReeReport;

function getArchitectApplicationStatus()
{

}

function converNumberToWord($number)
{
    $numberToWords = new \NumberToWords\NumberToWords();
    $numberTransformer = $numberToWords->getNumberTransformer('en');
    return $numberTransformer->toWords($number);
}

function getLastStatusIdArchitectLayout($layout_id)
{
    return ArchitectLayoutStatusLog::where(['user_id' => Auth::user()->id, 'role_id' => session()->get('role_id'), 'architect_layout_id' => $layout_id])->orderBy('id', 'desc')->first();
}

function getLastStatusIdArchitectApplication($id)
{
    return ArchitectApplicationStatusLog::where(['user_id' => Auth::user()->id, 'role_id' => session()->get('role_id'), 'architect_application_id' => $id])->orderBy('id', 'desc')->first();
}

function getCurrentStatusOfRtiApplicationForCurrentUSer($application_id)
{
    return RtiForwardApplication::where(['user_id' => Auth::user()->id, 'role_id' => session()->get('role_id'), 'application_id' => $application_id])->orderBy('id', 'desc')->first();

}

function check_report_uploaded_by_ee_ree_lm_em($layout_id)
{
    $report_uploaded = 1;
    $ArchitectLayoutDetail = ArchitectLayout::find($layout_id);
        $latest_architect_layout_detail = ArchitectLayoutDetail::where(['architect_layout_id' => $layout_id])->orderBy('id', 'desc')->first();
        if (session()->get('role_name') == config('commanConfig.estate_manager')) {
            $scrutiny_reports['architect_layout_em_scrutiny_reports'] = ArchitectLayoutScrutinyEMReport::where(['user_id' => auth()->user()->id, 'architect_layout_id' => $layout_id, 'architect_layout_detail_id' => $latest_architect_layout_detail->id])->count();
            if ($scrutiny_reports['architect_layout_em_scrutiny_reports'] > 0) {
                $report_uploaded = 1;
            } else {
                $report_uploaded = 0;
            }
		}
		if (session()->get('role_name') == config('commanConfig.land_manager')) {
			$scrutiny_reports['architect_layout_land_scrutiny_reports'] = ArchitectLayoutScrutinyLandReport::where(['user_id' => auth()->user()->id, 'architect_layout_id' => $layout_id, 'architect_layout_detail_id' => $latest_architect_layout_detail->id])->count();
			if ($scrutiny_reports['architect_layout_land_scrutiny_reports'] > 0) {
                $report_uploaded = 1;
            } else {
                $report_uploaded = 0;
            }
		}
		if (session()->get('role_name') == config('commanConfig.ee_junior_engineer')) {
			$scrutiny_reports['architect_layout_ee_scrutiny_reports'] = ArchitectLayoutScrutinyEEReport::where(['architect_layout_id' => $layout_id, 'architect_layout_detail_id' => $latest_architect_layout_detail->id])->count();
			if ($scrutiny_reports['architect_layout_ee_scrutiny_reports'] > 0) {
                $report_uploaded = 1;
            } else {
                $report_uploaded = 0;
            }
		}
		if (session()->get('role_name') == config('commanConfig.ree_junior')) {
			$scrutiny_reports['architect_layout_ree_scrutiny_reports'] = ArchitectLayoutScrutinyReeReport::where(['architect_layout_id' => $layout_id, 'architect_layout_detail_id' => $latest_architect_layout_detail->id])->count();
			if ($scrutiny_reports['architect_layout_ree_scrutiny_reports'] > 0) {
                $report_uploaded = 1;
            } else {
                $report_uploaded = 0;
            }
		}
	
    return $report_uploaded;
}
