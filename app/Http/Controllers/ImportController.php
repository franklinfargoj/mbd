<?php

namespace App\Http\Controllers;

use App\ArrearCalculation;
use App\ArrearsChargesRate;
use App\MasterBuilding;
use App\MasterColony;
use App\MasterLayout;
use App\MasterTenant;
use App\MasterTenantType;
use App\MasterWard;
use App\ServiceChargesRate;
use App\SocietyDetail;
use Excel;
use Illuminate\Http\Request;
use Input;
use Validator;

class ImportController extends Controller
{

    public function monthsBetween($startDate, $endDate)
    {
        $retval = "";

        // Assume YYYY-mm-dd - as is common MYSQL format
        $splitStart = explode('-', $startDate);
        $splitEnd = explode('-', $endDate);

        if (is_array($splitStart) && is_array($splitEnd)) {
            $difYears = $splitEnd[0] - $splitStart[0];
            $difMonths = $splitEnd[1] - $splitStart[1];
            $difDays = $splitEnd[2] - $splitStart[2];

            $retval = ($difDays > 0) ? $difMonths : $difMonths - 1;
            $retval += $difYears * 12;
        }
        return $retval;
    }

    public function import(Request $request)
    {
        //dd(extension_loaded ('zip'));
        ini_set('memory_limit', -1);
        ini_set('max_execution_time', 60);
        if ($request->method() == 'POST') {
            $requestData = $request->all();
            $validator = Validator::make($requestData, ['file' => 'required']);

            if (empty($validator->messages()->toArray())) {
                if ($request->hasFile('file') && $request->file('file')->isValid()) {

                    $path = Input::file('file')->getRealPath();
                    $from_year = '';
                    $data = Excel::load($path, function ($reader) {
                    })->get();

                    if (!empty($data) && $data->count()) {
                        foreach ($data as $pKey => $row1) {
                            foreach ($row1 as $pKey => $row) {

                                if (!empty($row['2']) && !empty($row['7'])) {
                                    if (is_numeric($row['29'])) {
                                        $from_year = ($from_year == "") ? (int) $row['29'] : $from_year;
                                    }

                                    $layout_id = MasterLayout::where('layout_name', $row[1])->value('id');

                                    $ward = MasterWard::where('name', $row['2'])->first();
                                    if (empty($ward)) {
                                        $ward = new MasterWard;
                                        $ward->name = $row['2'];
                                        $ward->layout_id = $layout_id;
                                        $ward->description = $row['2'];
                                        $ward->save();
                                    }

                                    $colony = MasterColony::where('name', $row['3'])->first();
                                    if (empty($colony)) {
                                        $colony = new MasterColony;
                                        $colony->name = $row['3'];
                                        $colony->ward_id = $ward->id;
                                        $colony->description = $row['3'];
                                        $colony->save();
                                    }

                                    $society = SocietyDetail::where('society_name', $row['4'])->first();
                                    if (empty($society)) {
                                        $society = new SocietyDetail;
                                        $society->colony_id = $colony->id;
                                        $society->society_name = $row['4'];
                                        $society->layout_id = $layout_id;
                                        $society->society_bill_level = 1;
                                        $society->save();
                                    }

                                    $building = MasterBuilding::where('society_id', $society->id)->where('name', $row['7'])->first();
                                    if (empty($building)) {
                                        $building = new MasterBuilding;
                                        $building->society_id = $society->id;
                                        $building->building_no = $row['6'];
                                        $building->name = $row['7'];
                                        $building->description = $row['7'];
                                        $building->save();
                                    }
                                    $tenant_type = MasterTenantType::where(['name' => $row['11']])->first();
                                    if ($tenant_type) {
                                        if (!empty($society) && !empty($building)) {
                                            $tenant = MasterTenant::where(['building_id' => $building->id, 'flat_no' => $row['12']])->first();
                                            if ($tenant == null) {
                                                $tenant = new MasterTenant;
                                                $tenant->building_id = $building->id;
                                                $tenant->flat_no = $row['12'];
                                                $tenant->salutation = $row['13'];
                                                $tenant->first_name = $row['14'];
                                                $tenant->middle_name = $row['15'];
                                                $tenant->last_name = $row['16'];
                                                $tenant->mobile = $row['17'];
                                                $tenant->email_id = $row['18'];
                                                $tenant->use = $row['19'];
                                                $tenant->carpet_area = $row['20'];
                                                $tenant->tenant_type = $tenant_type->id;
                                                $tenant->save();
                                            }
                                        }
                                    } else {

                                    }

                                    if ($from_year != "") {
                                        $end_year = explode('-', $row['21']);
                                        for ($j = $from_year; $j <= (int) $end_year[1]; $j++) {
                                            $arrear_rate = ArrearsChargesRate::where([
                                                'society_id' => $society->id,
                                                'building_id' => $building->id,
                                                'year' => $j,
                                                'tenant_type' => $tenant_type->id,
                                            ])->first();
                                            if ($arrear_rate == null) {
                                                $arrear_rate = new ArrearsChargesRate;
                                                $arrear_rate->society_id = $society->id;
                                                $arrear_rate->building_id = $building->id;
                                                $arrear_rate->year = $j;
                                                $arrear_rate->tenant_type = $tenant_type->id;
                                                $arrear_rate->old_rate = $row['22'];
                                                $arrear_rate->revise_rate = $row['24'];
                                                $arrear_rate->interest_on_old_rate = $row['23'];
                                                $arrear_rate->interest_on_differance = $row['25'];
                                                $arrear_rate->save();
                                            }
                                        }
                                    }

                                    if (1 == preg_match('/(0[1-9]|1[0-2])\/\d{4}/', $row['26'])) {
                                        $year_from = explode('/', $row['26']);
                                        $year_to = explode('/', $row['27']);

                                        $date1 = strtotime($year_from[1] . '-' . $year_from[0]);
                                        $date2 = strtotime($year_to[1] . '-' . $year_to[0]);

                                        $months = 0;

                                        while (($date1 = strtotime('+1 MONTH', $date1)) <= $date2) {
                                            $months++;
                                        }

                                        $months = $months + 1;

                                        $ior = $row['23'];
                                        $old_rate = $row['22'];

                                        $iod = $row['25'];
                                        $rate_diff = $row['24'] - $row['22'];
                                        //dump($ior." ".$iod." ".$months);
                                        $ior_per = $ior / 100;
                                        $iod_per = $iod / 100;

                                        $old_intrest_amount = round(($old_rate * $ior_per) * $months, 2);
                                        //dump($old_intrest_amount);
                                        $intrest_on_difference = round(($rate_diff * $iod_per) * $months, 2);
                                        //dump($intrest_on_difference);
                                        $total = ($old_rate * $months) + $old_intrest_amount + ($rate_diff * $months) + $intrest_on_difference;

                                        $arrear_calculation = ArrearCalculation::where([
                                            'society_id' => $society->id,
                                            'building_id' => $building->id,
                                            'tenant_id' => $tenant->id,
                                            'month' => (int) $year_to[0],
                                            'year' => (int) $year_to[1],
                                            'oir_year' => (int) $year_from[1],
                                            'oir_month' => (int) $year_from[0],
                                            'ida_year' => (int) $year_from[1],
                                            'ida_month' => (int) $year_from[0],
                                        ])->first();
                                        if ($arrear_calculation == null) {
                                            $arrear_calculation = new ArrearCalculation;
                                            $arrear_calculation->society_id = $society->id;
                                            $arrear_calculation->building_id = $building->id;
                                            $arrear_calculation->tenant_id = $tenant->id;
                                            $arrear_calculation->month = (int) $year_to[0];
                                            $arrear_calculation->year = (int) $year_to[1];
                                            $arrear_calculation->oir_year = (int) $year_from[1];
                                            $arrear_calculation->oir_month = (int) $year_from[0];
                                            $arrear_calculation->ida_year = (int) $year_from[1];
                                            $arrear_calculation->ida_month = (int) $year_from[0];
                                            $arrear_calculation->total_amount = ceil($total);
                                            $arrear_calculation->payment_status = '0';
                                            $arrear_calculation->difference_amount = $rate_diff;
                                            $arrear_calculation->old_intrest_amount = $old_intrest_amount;
                                            $arrear_calculation->difference_intrest_amount = $intrest_on_difference;
                                            //dump($arrear_calculation);
                                            $arrear_calculation->save();
                                        }

                                    }

                                    if (is_numeric($row['38'])) {
                                        $end_year = explode('-', $row['21']);
                                        for ($j = $end_year[0]; $j <= (int) $end_year[1]; $j++) {
                                            $service_charge = ServiceChargesRate::where([
                                                'society_id' => $society->id,
                                                'building_id' => $building->id,
                                                'year' => $j,
                                                'tenant_type' => $tenant_type->id,
                                            ])->first();
                                            if ($service_charge==null) {
												$service_charge = new ServiceChargesRate;
												$service_charge->society_id=$society->id;
												$service_charge->building_id = $building->id;
                                                $service_charge->year = $j;
												$service_charge->tenant_type = $tenant_type->id;
												$service_charge->water_charges = $row['30'];
												$service_charge->electric_city_charge = $row['31'];
												$service_charge->pump_man_and_repair_charges = $row['32'];
												$service_charge->administrative_charge = $row['33'];
												$service_charge->lease_rent = $row['34'];
												$service_charge->na_assessment=$row['35'];
												$service_charge->external_expender_charge=$row['37'];
												$service_charge->other=$row['38'];
												$service_charge->property_tax=$row['36'];
												$service_charge->save();
                                            }
                                        }
                                    }

                                }
                            }

                        }
                        exit('Successfully uploaded!!!');
                    }
                }
            } else {
                return redirect('import')->withErrors($validator)->withInput();
            }
        }
    }
}
