<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use App\MasterLayout;
use App\SocietyDetail;
use App\VillageDetail;
use App\VillageSociety;
use DB;
use Illuminate\Http\Request;
use Mpdf\Mpdf;
use Excel;

class LandController extends Controller
{
    /**
     * Show the form for Report.
     *
     * Author: Prajakta Sisale.
     *
     * @return \Illuminate\Http\Response
     */
    public function land_village_society_reports()
    {
        $villages = VillageDetail::get();

        $layouts = MasterLayout::get();

        return view('admin.reports.land.village_society_reports',compact('villages','layouts'));
    }
    /**
     * Generate the village - society report.
     *
     * Author: Prajakta Sisale.
     *
     * @return \Illuminate\Http\Response
     */
    public function village_society_reports(Request $request)
    {

        $village_ids = $request->village_id;

        $village_names = VillageDetail::whereIn('id',$village_ids)->pluck('village_name')->toArray();

//        $societies = SocietyDetail::whereHas('Villages', function($q) use ($village_ids){
//            $q->whereIn('id',$village_ids);
//        })->get();

        $societies = VillageSociety::with('getVillageDetails','getSocietyDetails')
            ->whereIn('village_id',$village_ids)
            ->orderBy('village_id')
            ->get();

        if($request->pdf == 'pdf'){
            $report_format = $request->pdf;
        }
        else{
            $report_format = $request->excel;
        }

        if($societies){
            $result = $this->generateVillageSocietyReport($societies, $report_format, $village_names);
            if(!$result){
                return back()->with('error', 'No Record Found');
            }
        }else{
            return back()->with('error', 'No Record Found');

        }
    }

    /**
     * Generate the Report in excel or pdf format.
     *
     * Author: Prajakta Sisale.
     *
     * @return \Illuminate\Http\Response
     */
    public function generateVillageSocietyReport($data, $report_format, $village_names){
        $fileName = date('Y_m_d_H_i_s') . '_village_society_report.pdf';
        $village_names = implode(',',$village_names);

        if (count($data) > 0) {

            if($report_format == 'pdf')
            {
                $content = view('admin.reports.land._village_society_report', compact('data','village_names'));
                $header_file = '';
                $footer_file = '';

                $pdf = new Mpdf([
                    'default_font_size' => 9,
                    'default_font' => 'Times New Roman',
                ]);
                $pdf->autoScriptToLang = true;
                $pdf->autoLangToFont = true;
                $pdf->setAutoBottomMargin = 'stretch';
                $pdf->setAutoTopMargin = 'stretch';
                $pdf->SetHTMLHeader($header_file);
                $pdf->SetHTMLFooter($footer_file);
                $pdf->WriteHTML($content);
                $pdf->Output($fileName, 'D');
            }
            if($report_format == 'excel')
            {

                $dataListMaster = [];
                $i=1;
                foreach ($data as $datas) {
                    $dataList = [];
                    $dataList['id'] = $i;
                    $dataList['Village'] = $datas->getVillageDetails->village_name;
                    $dataList['Society Name'] = $datas->getSocietyDetails['society_name'] ;
                    $dataList['Society Reg. No.'] = $datas->getSocietyDetails['society_reg_no'] ;
                    $dataList['District'] = $datas->getSocietyDetails['getDistrictName']['district_name'] ;
                    $dataList['Taluka'] = $datas->getSocietyDetails['getTalukaName']['taluka_name'] ;
                    $dataList['Layout'] = $datas->getSocietyDetails->getLayoutName->layout_name  ?? NULL;
                    $dataList['Survey Number'] = $datas->getSocietyDetails['survey_number'] ;
                    $dataList['CTS Number'] = $datas->getSocietyDetails['cts_number'] ;
                    $dataList['Name Of Chairman'] = $datas->getSocietyDetails['chairman'] ?? NULL;
                    $dataList['Mobile no. Of Chairman'] = $datas->getSocietyDetails['chairman_mob_no'] ?? NULL;
                    $dataList['Name Of Secretary'] = $datas->getSocietyDetails['secretary'] ?? NULL;
                    $dataList['Mobile no. Of Secretary'] = $datas->getSocietyDetails['secretary_mob_no'] ?? NULL;
                    $dataList['Society Address'] = $datas->getSocietyDetails['society_address'] ;
                    $dataList['Society Email Id'] = $datas->getSocietyDetails['society_email_id'] ?? NULL;
                    $dataList['Area'] = $datas->getSocietyDetails['area'] ;
                    $dataList['Date mentioned on service tax letters'] = $datas->getSocietyDetails['date_on_service_tax'] ;
                    $dataList['Surplus Charges'] = $datas->getSocietyDetails['surplus_charges'] ;
                    $dataList['Last date of paying surplus charges'] = $datas->getSocietyDetails['surplus_charges_last_date'] ;
                    $dataList['Land Name'] = $datas->getSocietyDetails->getLandName['land_name'] ;
                    $dataList['Is Society Conveyed ?'] = ($datas->getSocietyDetails['society_conveyed'] == 1) ? 'yes' : 'no';;
                    $dataList['Date Of Conveyance'] = $datas->getSocietyDetails['date_of_conveyance'] ?? NULL;
                    $dataList['Area Of Conveyance'] = $datas->getSocietyDetails['area_of_conveyance'] ?? NULL;
                    $dataListKeys = array_keys($dataList);
                    $dataListMaster[]=$dataList;
                    $i++;
                }

                $village_names = str_replace(',','_',$village_names);
                return Excel::create(date('Y_m_d_H_i_s') . '_village_society_'.$village_names, function($excel) use($dataListMaster){

                    $excel->sheet('mySheet', function($sheet) use($dataListMaster)
                    {
                        $sheet->fromArray($dataListMaster);
                    });
                })->download('csv');
            }

            return true;

        } else {
            return false;
        }
    }

    /**
     * Generate the village - society area report.
     *
     * Author: Prajakta Sisale.
     *
     * @return \Illuminate\Http\Response
     */
    public function village_society_area_reports(Request $request)
    {

        $village_ids = $request->village_id;

        $village_names = VillageDetail::whereIn('id',$village_ids)->pluck('village_name')->toArray();

//        $societies = SocietyDetail::whereHas('Villages', function($q) use ($village_ids){
//            $q->whereIn('id',$village_ids);
//        })->get();

        $societies = VillageSociety::with('getVillageDetails','getSocietyDetails')
            ->whereIn('village_id',$village_ids)
            ->orderBy('village_id')
            ->get();

        if($request->pdf == 'pdf'){
            $report_format = $request->pdf;
        }
        else{
            $report_format = $request->excel;
        }

        if($societies){
            $result = $this->generateVillageSocietyAreaReport($societies, $report_format, $village_names);
            if(!$result){
                return back()->with('error', 'No Record Found');
            }
        }else{
            return back()->with('error', 'No Record Found');

        }
    }

    /**
     * Generate the Report in excel or pdf format.
     *
     * Author: Prajakta Sisale.
     *
     * @return \Illuminate\Http\Response
     */
    public function generateVillageSocietyAreaReport($data, $report_format, $village_names){

        $fileName = date('Y_m_d_H_i_s') . '_village_society_report.pdf';
        $village_names = implode(',',$village_names);

        if (count($data) > 0) {

            $dataListMaster = [];
            $i=1;
            $total_society_area = 0;
            $total_village_area = 0;

            foreach ($data as $key => $datas) {

                $dataList = [];
                $dataList['id'] = $i;


                if($key > 0){
                    if($datas->getVillageDetails->village_name == $dataListMaster[$key - 1]['Village Name']){
                        $village = $datas->getVillageDetails->village_name;
                    }

                    if($village == $datas->getVillageDetails->village_name){
                        $dataList['Village Name'] = "";
                        $dataList['Village Total Area(m.sq.)'] = "";
                    }else{
                        $dataList['Village Name'] = $datas->getVillageDetails->village_name;
                        $village_area = $datas->getVillageDetails->total_area;
                        $dataList['Village Total Area(m.sq.)'] = $village_area;

                        $total_village_area += $village_area;

                    }
                } else{
                    $dataList['Village Name'] = $datas->getVillageDetails->village_name;
                    $village_area = $datas->getVillageDetails->total_area;
                    $dataList['Village Total Area(m.sq.)'] = $village_area;
                    $total_village_area += $village_area;

                }

                $dataList['Society Name'] = $datas->getSocietyDetails['society_name'] ;
                $dataList['Society Area(m.sq.)'] = $datas->getSocietyDetails['area'] ;

                $total_society_area += $datas->getSocietyDetails['area'];

                $dataListKeys = array_keys($dataList);
                $dataListMaster[]=$dataList;
                $i++;
            }

            $dataListMaster[] = [ 'id' => '',
                'Village Name' => '',
                'Village Total Area(m.sq.)' => '',
                'Society Name'=> '',
                'Society Area(m.sq.)'=> ''
            ];

            $dataListMaster[] = [ 'id' => '',
                'Village Name' => 'Village Total Area(m.sq.)',
                'Village Total Area(m.sq.)' => $total_village_area,
                'Society Name'=> 'Society Total Area(m.sq.)',
                'Society Area(m.sq.)'=> $total_society_area
            ];

            if($report_format == 'pdf')
            {
                $content = view('admin.reports.land._village_society_area_report', compact('dataListMaster','village_names'));
                $header_file = '';
                $footer_file = '';

                $pdf = new Mpdf([
                    'default_font_size' => 9,
                    'default_font' => 'Times New Roman',
                ]);
                $pdf->autoScriptToLang = true;
                $pdf->autoLangToFont = true;
                $pdf->setAutoBottomMargin = 'stretch';
                $pdf->setAutoTopMargin = 'stretch';
                $pdf->SetHTMLHeader($header_file);
                $pdf->SetHTMLFooter($footer_file);
                $pdf->WriteHTML($content);
                $pdf->Output($fileName, 'D');
            }
            if($report_format == 'excel')
            {

                $village_names = str_replace(',','_',$village_names);
                return Excel::create(date('Y_m_d_H_i_s') . '_village_society_area'.$village_names, function($excel) use($dataListMaster){

                    $excel->sheet('mySheet', function($sheet) use($dataListMaster)
                    {
                        $sheet->fromArray($dataListMaster);
                    });
                })->download('csv');
            }

            return true;

        } else {
            return false;
        }
    }

    /**
     * Generate the layout - village - society area report.
     *
     * Author: Prajakta Sisale.
     *
     * @return \Illuminate\Http\Response
     */
    public function village_society_layout_area_reports(Request $request)
    {

        $layout_ids = $request->layout_id;



        $layout_names = MasterLayout::whereIn('id',$layout_ids)->pluck('layout_name')->toArray();

        dd($layout_names);

        if($request->pdf == 'pdf'){
            $report_format = $request->pdf;
        }
        else{
            $report_format = $request->excel;
        }

//        if($societies){
//            $result = $this->generateVillageSocietyLayoutAreaReport($societies, $report_format, $layout_names);
//            if(!$result){
//                return back()->with('error', 'No Record Found');
//            }
//        }else{
//            return back()->with('error', 'No Record Found');
//
//        }
    }


//    /**
//     * Generate the Report in excel or pdf format.
//     *
//     * Author: Prajakta Sisale.
//     *
//     * @return \Illuminate\Http\Response
//     */
//    public function generateVillageSocietyLayoutAreaReport($data, $report_format, $village_names){
//
//        $fileName = date('Y_m_d_H_i_s') . '_village_society_report.pdf';
//        $village_names = implode(',',$village_names);
//
//        if (count($data) > 0) {
//
//            if($report_format == 'pdf')
//            {
//                $content = view('admin.reports.land._village_society_report', compact('data','village_names'));
//                $header_file = '';
//                $footer_file = '';
//
//                $pdf = new Mpdf([
//                    'default_font_size' => 9,
//                    'default_font' => 'Times New Roman',
//                ]);
//                $pdf->autoScriptToLang = true;
//                $pdf->autoLangToFont = true;
//                $pdf->setAutoBottomMargin = 'stretch';
//                $pdf->setAutoTopMargin = 'stretch';
//                $pdf->SetHTMLHeader($header_file);
//                $pdf->SetHTMLFooter($footer_file);
//                $pdf->WriteHTML($content);
//                $pdf->Output($fileName, 'D');
//            }
//            if($report_format == 'excel')
//            {
//
//                $dataListMaster = [];
//                $i=1;
//                $total_society_area = 0;
//                $total_village_area = 0;
//
//                foreach ($data as $key => $datas) {
////                    if($key > 0){
////                        echo '<pre>';
////                        print_r('if'.($key - 1));
////                        if($datas->getVillageDetails->village_name == $dataListMaster[$key - 1]['Village Name']){
////                            echo '<pre>';
////                            print_r('if'.($key - 1));
////                            $dataList['Village Name'] = "";
////                        }else{
////                            echo '<pre>';
////                            print_r('ifelse'.($key - 1));
//////                            $dataList['Village Name'] = $datas->getVillageDetails->village_name;
////                        }
////                    }else{
////                        echo '<pre>';
////                        print_r('else'.($key - 1));
//////                        $dataList['Village Name'] = $datas->getVillageDetails->village_name;
////                    }
//
//
//                    $dataList = [];
//                    $dataList['id'] = $i;
//
//
//                    if($key > 0){
//                        if($datas->getVillageDetails->village_name == $dataListMaster[$key - 1]['Village Name']){
//                            $village = $datas->getVillageDetails->village_name;
//                        }
//
//                        if($village == $datas->getVillageDetails->village_name){
//                            $dataList['Village Name'] = "";
//                            $dataList['Village Total Area(m.sq.)'] = "";
//                        }else{
//                            $dataList['Village Name'] = $datas->getVillageDetails->village_name;
//                            $village_area = $datas->getVillageDetails->total_area;
//                            $dataList['Village Total Area(m.sq.)'] = $village_area;
//
//                            $total_village_area += $village_area;
//
//                        }
//                    } else{
//                        $dataList['Village Name'] = $datas->getVillageDetails->village_name;
//                        $village_area = $datas->getVillageDetails->total_area;
//                        $dataList['Village Total Area(m.sq.)'] = $village_area;
//                        $total_village_area += $village_area;
//
//                    }
//
//                    $dataList['Society Name'] = $datas->getSocietyDetails['society_name'] ;
//                    $dataList['Society Area(m.sq.)'] = $datas->getSocietyDetails['area'] ;
//
//                    $total_society_area += $datas->getSocietyDetails['area'];
////                    $dataList['Society total Area'] = $total_society_area;
////                    $dataList['Society Reg. No.'] = $datas->getSocietyDetails['society_reg_no'] ;
////                    $dataList['District'] = $datas->getSocietyDetails['getDistrictName']['district_name'] ;
////                    $dataList['Taluka'] = $datas->getSocietyDetails['getTalukaName']['taluka_name'] ;
////                    $dataList['Layout'] = $datas->getSocietyDetails->getLayoutName->layout_name  ?? NULL;
////                    $dataList['Survey Number'] = $datas->getSocietyDetails['survey_number'] ;
////                    $dataList['CTS Number'] = $datas->getSocietyDetails['cts_number'] ;
////                    $dataList['Name Of Chairman'] = $datas->getSocietyDetails['chairman'] ?? NULL;
////                    $dataList['Mobile no. Of Chairman'] = $datas->getSocietyDetails['chairman_mob_no'] ?? NULL;
////                    $dataList['Name Of Secretary'] = $datas->getSocietyDetails['secretary'] ?? NULL;
////                    $dataList['Mobile no. Of Secretary'] = $datas->getSocietyDetails['secretary_mob_no'] ?? NULL;
////                    $dataList['Society Address'] = $datas->getSocietyDetails['society_address'] ;
////                    $dataList['Society Email Id'] = $datas->getSocietyDetails['society_email_id'] ?? NULL;
////                    $dataList['Date mentioned on service tax letters'] = $datas->getSocietyDetails['date_on_service_tax'] ;
////                    $dataList['Surplus Charges'] = $datas->getSocietyDetails['surplus_charges'] ;
////                    $dataList['Last date of paying surplus charges'] = $datas->getSocietyDetails['surplus_charges_last_date'] ;
////                    $dataList['Land Name'] = $datas->getSocietyDetails->getLandName['land_name'] ;
////                    $dataList['Is Society Conveyed ?'] = ($datas->getSocietyDetails['society_conveyed'] == 1) ? 'yes' : 'no';;
////                    $dataList['Date Of Conveyance'] = $datas->getSocietyDetails['date_of_conveyance'] ?? NULL;
////                    $dataList['Area Of Conveyance'] = $datas->getSocietyDetails['area_of_conveyance'] ?? NULL;
//
//
//                    $dataListKeys = array_keys($dataList);
//                    $dataListMaster[]=$dataList;
//                    $i++;
//                }
//
//                $dataListMaster[] = [ 'id' => '',
//                    'Village Name' => '',
//                    'Village Total Area(m.sq.)' => '',
//                    'Society Name'=> '',
//                    'Society Area(m.sq.)'=> ''
//                ];
//
//                $dataListMaster[] = [ 'id' => '',
//                    'Village Name' => 'Village Total Area(m.sq.)',
//                    'Village Total Area(m.sq.)' => $total_village_area,
//                    'Society Name'=> 'Society Total Area(m.sq.)',
//                    'Society Area(m.sq.)'=> $total_society_area
//                ];
//
//                $village_names = str_replace(',','_',$village_names);
//                return Excel::create(date('Y_m_d_H_i_s') . '_village_society_area'.$village_names, function($excel) use($dataListMaster){
//
//                    $excel->sheet('mySheet', function($sheet) use($dataListMaster)
//                    {
//                        $sheet->fromArray($dataListMaster);
//                    });
//                })->download('csv');
//            }
//
//            return true;
//
//        } else {
//            return false;
//        }
//    }
}