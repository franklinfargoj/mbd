
<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: 'marathi', sans-serif;
        }
    </style>
</head>
<body>
    <div class="custom-wrapper">
        <div class="col-md-12">
            hi

            <table class="table mb-0" style="padding-top: 10px;" >
                <input name="_token" type="hidden" value="{!! csrf_token() !!}" />
                <input name="application_id" type="hidden" value="{{ $applicationId }}"/>
                <input name="user_id" type="hidden" value="{{ $user->id }}"/>
                <thead class="thead-default">
                <tr>
                    <th class="table-data--xs">
                        #
                    </th>
                    <th>
                        तपशील
                    </th>
                    <th class="table-data--md">
                        रक्कम रु
                    </th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>1.</td>
                    <td>
                        कार्यकारी अभियंता /कुर्ला विभाग यांचे सिमांकन नकाशानुसार
                        भूखंडाचे क्षेत्रफळ
                    </td>
                    <td class="text-center">

                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        1. भाडेपट्टा करारनाम्यानुसार क्षेत्रफळ
                    </td>
                    <td class="text-center">
                        <input type="text" class="total_area form-control form-control--custom" name="area_as_per_lease_agreement"
                               id="area_as_per_lease_agreement" value="{{ isset($calculationSheetDetails[0]->area_as_per_lease_agreement) ? $calculationSheetDetails[0]->area_as_per_lease_agreement : 0 }}" />
                    </td></td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        2. टिट बिट भूखंडाचे क्षेत्र
                    </td>
                    <td class="text-center">
                        <input type="text" class="total_area form-control form-control--custom" name="area_of_tit_bit_plot" id="area_of_tit_bit_plot" value="{{ isset($calculationSheetDetails[0]->area_of_tit_bit_plot) ? $calculationSheetDetails[0]->area_of_tit_bit_plot : 0 }}"/>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        3. आर जी भूखंडाचे क्षेत्र
                    </td>
                    <td class="text-center">
                        <input type="text" class="total_area form-control form-control--custom" name="area_of_rg_plot" id="area_of_rg_plot" value="{{ isset($calculationSheetDetails[0]->area_of_rg_plot) ? $calculationSheetDetails[0]->area_of_rg_plot : 0 }}"/>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        4. NTBNIB भूखंडाचे क्षेत्र
                    </td>
                    <td class="text-center">
                        <input type="text" class="total_area form-control form-control--custom" name="area_of_ntbnib_plot" id="area_of_ntbnib_plot" value="{{ isset($calculationSheetDetails[0]->area_of_ntbnib_plot) ? $calculationSheetDetails[0]->area_of_ntbnib_plot : 0 }}"/>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td class="font-weight-bold">
                        Total भूखंडाचे क्षेत्रफळ
                    </td>
                    <td class="text-center">
                        <input class="form-control form-control--custom" readonly type="text" name="area_of_total_plot" id="area_of_total_plot" /></td>
                </tr>
                <tr>
                    <td>2.</td>
                    <td>
                        अभिनण्यानुसार भूखंडाचे क्षेत्रफळ
                    </td>
                    <td class="text-center">
                        <input type="text" class="form-control form-control--custom" name="area_as_per_introduction" id="area_as_per_introduction" value="{{ isset($calculationSheetDetails[0]->area_as_per_introduction) ? $calculationSheetDetails[0]->area_as_per_introduction : 0 }}"/>
                    </td>
                </tr>
                <tr>
                    <td>3.</td>
                    <td>
                        परिगणनाकरिता ग्राह्य भूखंडाचे क्षेत्रफळ (Min of 1 & 2)
                    </td>
                    <td class="text-center">
                        <input type="text" class="permissible_area total_permissible form-control form-control--custom"  name="area_of_​​subsistence_to_calculate" id="area_of_​​subsistence_to_calculate" value="{{ isset($calculationSheetDetails[0]->area_of_​​subsistence_to_calculate) ? $calculationSheetDetails[0]->area_of_​​subsistence_to_calculate : 0 }}"/>
                    </td>
                </tr>
                <tr>
                    <td>4.</td>
                    <td>
                        अनुज्ञेय चटई क्षेत्र निर्देशांक
                    </td>
                    <td class="text-center">
                        <input type="text" class="permissible_area total_permissible form-control form-control--custom" name="permissible_carpet_area_coordinates" id="permissible_carpet_area_coordinates" value="{{ isset($calculationSheetDetails[0]->permissible_carpet_area_coordinates) ? $calculationSheetDetails[0]->permissible_carpet_area_coordinates : 0 }}"/>
                    </td>
                </tr>
                <tr>
                    <td>5.</td>
                    <td>
                        अनुज्ञेय बांधकाम क्षेत्रफळ
                    </td>
                    <td class="text-center">
                        <input type="text" readonly class="total_permissible form-control form-control--custom" name="permissible_construction_area" id="permissible_construction_area" value="{{ isset($calculationSheetDetails[0]->permissible_construction_area) ? $calculationSheetDetails[0]->permissible_construction_area : 0 }}"/>

                    </td>
                </tr>
                <tr>
                    <td>6.</td>
                    <td>
                        म.न.पा .कडून ल. ओ. आय. पत्रानुसार अनुज्ञेय प्रोरेटा
                        क्षेत्रफळ
                    </td>
                    <td class="text-center">

                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        1. प्रति सदनिका चौ मी क्षेत्रफळ
                    </td>
                    <td class="text-center">
                        <input type="text" class="proratata_area form-control form-control--custom" name="sqm_area_per_slot" id="sqm_area_per_slot" value="{{ isset($calculationSheetDetails[0]->sqm_area_per_slot) ? $calculationSheetDetails[0]->sqm_area_per_slot : 0 }}"/>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        2. एकूण सदनिका
                    </td>
                    <td class="text-center">
                        <input type="text" class="proratata_area total_permissible form-control form-control--custom" name="total_house" id="total_house" value="{{ isset($calculationSheetDetails[0]->total_house) ? $calculationSheetDetails[0]->total_house : 0 }}"/>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td class="font-weight-bold">
                        Total
                    </td>
                    <td class="text-center">
                        <input type="text" readonly class="form-control form-control--custom" name="permissible_proratata_area" id="permissible_proratata_area" />

                    </td>
                </tr>
                <tr>
                    <td>7.</td>
                    <td>
                        अनुज्ञेय प्रोरेटा बांधकाम क्षेत्रफळ (85% पर्यंत सीमित )
                    </td>
                    <td class="text-center">

                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        1. प्रति सदनिका चौ मी प्रोरेटा बांधकाम क्षेत्रफळ
                    </td>
                    <td class="text-center">
                        <input type="text" class="total_permissible form-control form-control--custom" name="per_sq_km_proyerta_construction_area" id="per_sq_km_proyerta_construction_area" value="{{ isset($calculationSheetDetails[0]->per_sq_km_proyerta_construction_area) ? $calculationSheetDetails[0]->per_sq_km_proyerta_construction_area : 0 }}"/>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td class="font-weight-bold">
                        Total
                    </td>
                    <td class="text-center">
                        <input type="text" readonly class="form-control form-control--custom" name="proratata_construction_area" id="proratata_construction_area" />

                    </td>
                </tr>
                <tr>
                    <td>8.</td>
                    <td>
                        मा उपाध्यक्ष / प्रा यांचे अधिकारातील १०% राखीव कोट्यामधून
                        संस्थेस वितरित करावयाचे क्षेत्रफळ
                    </td>
                    <td class="text-center">
                        <input type="text" class="total_permissible form-control form-control--custom" name="area_in_reserved_seats_for_vp_pio" id="area_in_reserved_seats_for_vp_pio" value="{{ isset($calculationSheetDetails[0]->area_in_reserved_seats_for_vp_pio) ? $calculationSheetDetails[0]->area_in_reserved_seats_for_vp_pio : 0 }}"/>
                    </td>
                </tr>
                <tr>
                    <td>9.</td>
                    <td>
                        एकूण अनुज्ञेय बांधकाम क्षेत्रफळ (अ.क्र. ५ + ७ + 8)
                    </td>
                    <td class="text-center">
                        <input type="text" readonly class="remaining_area form-control form-control--custom" name="total_permissible_construction_area" id="total_permissible_construction_area" value="{{ isset($calculationSheetDetails[0]->total_permissible_construction_area) ? $calculationSheetDetails[0]->total_permissible_construction_area : 0 }}"/>

                    </td>
                </tr>
                <tr>
                    <td>10.</td>
                    <td>
                        अस्तित्वातील बांधकाम क्षेत्रफळ (सी - ५७)
                    </td>
                    <td class="text-center">
                        <input type="text" class="remaining_area form-control form-control--custom" name="existing_construction_area" id="existing_construction_area" value="{{ isset($calculationSheetDetails[0]->existing_construction_area) ? $calculationSheetDetails[0]->existing_construction_area : 0 }}"/>
                    </td>
                </tr>
                <tr>
                    <td>11.</td>
                    <td>
                        उर्वरित क्षेत्रफळ (अ.क्र 9. - अ.क्र.10 )
                    </td>
                    <td class="text-center">
                        <input type="text" readonly class="form-control form-control--custom" name="remaining_area" id="remaining_area" />

                    </td>
                </tr>
                <tr>
                    <td>12.</td>
                    <td>
                        रेडीरेकनर २०१८ - १९ , न. भू. क्र. ३५१ (पै), व्हिलेज-
                        हरियाली ,
                        टागोरनगर झोन क्रमांक. ११२/५३५, दर रुपये रु. ५५,९०० /-
                        (पृष्ठ
                        क्रमांक सी - ६०५ ते सी -६०७ )
                    </td>
                    <td class="text-center">
                        <input type="text" class="redirekner_val form-control form-control--custom" name="redirekner_value" id="redirekner_value" value="{{ isset($calculationSheetDetails[0]->redirekner_value) ? $calculationSheetDetails[0]->redirekner_value : 0 }}"/>
                    </td>
                </tr>
                <tr>
                    <td>13.</td>
                    <td>
                        बांधकामाचा दर (रेडीरेकनर २०१८-१९)
                    </td>
                    <td class="text-center">
                        <input type="text" class="redirekner_val form-control form-control--custom" name="redirekner_construction_rate" id="redirekner_construction_rate" value="{{ isset($calculationSheetDetails[0]->redirekner_construction_rate) ? $calculationSheetDetails[0]->redirekner_construction_rate : 0 }}"/>
                    </td>
                </tr>
                <tr>
                    <td>14.</td>
                    <td>
                        LR/RC = ५५,९००/२७५००
                    </td>
                    <td class="text-center">
                        <input type="text" readonly class=" form-control form-control--custom"  name="redirekner_val" id="redirekner_val" />

                    </td>
                </tr>
                <tr>
                    <td>15.</td>
                    <td>
                        उर्वरितचटईक्षेत्राचे अधिमूल्य
                    </td>
                    <td class="text-center">

                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        1. उर्वरित च.क्षे.रहिवासी वापर क्षेत्र
                    </td>
                    <td class="text-center">
                        <input type="text" readonly class="form-control form-control--custom" name="remaining_residential_area" id="remaining_residential_area" value="{{ isset($calculationSheetDetails[0]->remaining_residential_area) ? $calculationSheetDetails[0]->remaining_residential_area : 0 }}"/>

                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        2. दर (DCR % of tb 1 pt 12)
                    </td>
                    <td class="text-center">
                                                <span style="cursor: pointer" data-toggle="modal" data-target="#select-from-dcr">Select
                                                    from DCR</span>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        अधिमूल्य
                    </td>
                    <td class="text-center">
                        <input type="text" readonly class="total_amount form-control form-control--custom" name="balance_of_remaining_area" id="balance_of_remaining_area" value="{{ isset($calculationSheetDetails[0]->balance_of_remaining_area) ? $calculationSheetDetails[0]->balance_of_remaining_area : 0 }}"/>

                    </td>
                </tr>
                <tr>
                    <td>16.</td>
                    <td>
                        दि.०८.१०.२०१३ च्या अधिसूचनेमधील अनु.क्र.५ ए ,नुसार ७ % ऑफ
                        इन्फ्रास्टक्चर शुल्क रक्कम
                    </td>
                    <td class="text-center">
                        <input type="text" readonly class="form-control form-control--custom" name="infrastructure_fee_amount" id="infrastructure_fee_amount" value="{{ isset($calculationSheetDetails[0]->infrastructure_fee_amount) ? $calculationSheetDetails[0]->infrastructure_fee_amount : 0 }}"/>

                    </td>
                </tr>
                <tr>
                    <td>17.</td>
                    <td>
                        उपरोक्त ऑफ साईट इन्फ्रास्ट्रक्चर शुल्क रकमेपैकी म.न.पा.स
                        भरवायची ५/७ रक्कम (५/७ X अनु.क्र.१६)
                    </td>
                    <td class="text-center">
                        <input type="text" readonly class="form-control form-control--custom" name="amount_to_be_paid_to_municipal" id="amount_to_be_paid_to_municipal" value="{{ isset($calculationSheetDetails[0]->amount_to_be_paid_to_municipal) ? $calculationSheetDetails[0]->amount_to_be_paid_to_municipal : 0 }}"/>

                    </td>
                </tr>
                <tr>
                    <td>18.</td>
                    <td>
                        म्हाडाकडे भरवायची ऑफ साईट इन्फ्रास्ट्रक्चर शुल्क रक्कम (२/७
                        *
                        अनु.क्र.१६ )
                    </td>
                    <td class="text-center">
                        <input type="text" readonly class="total_amount form-control form-control--custom" name="offsite_infrastructure_charge_to_mhada" id="offsite_infrastructure_charge_to_mhada" value="{{ isset($calculationSheetDetails[0]->offsite_infrastructure_charge_to_mhada) ? $calculationSheetDetails[0]->offsite_infrastructure_charge_to_mhada : 0 }}"/>

                    </td>
                </tr>
                <tr>
                    <td>19.</td>
                    <td>
                        छाननी शुल्क
                    </td>
                    <td class="text-center">
                        <input type="text" readonly class="total_amount form-control form-control--custom" name="scrutiny_fee" id="scrutiny_fee" value="6000" />

                    </td>
                </tr>
                <tr>
                    <td>20.</td>
                    <td>
                        अभिन्यास मंजुरी शुल्क रु,१०००/ - प्रति गाळा
                    </td>
                    <td class="text-center">
                        <input type="text" readonly class="total_amount form-control form-control--custom" name="layout_approval_fee" id="layout_approval_fee" value="{{ isset($calculationSheetDetails[0]->layout_approval_fee) ? $calculationSheetDetails[0]->layout_approval_fee : 0 }}" />

                    </td>
                </tr>
                <tr>
                    <td>21.</td>
                    <td>
                        डेब्रिज रिमूव्हल शुल्क रु.६६००/- [for 1 building]
                    </td>
                    <td class="text-center">
                        <input type="text" readonly class="total_amount form-control form-control--custom" name="debraj_removal_fee" id="debraj_removal_fee" value="{{ isset($calculationSheetDetails[0]->debraj_removal_fee) ? $calculationSheetDetails[0]->debraj_removal_fee : 0 }}"/>

                    </td>
                </tr>
                <tr>
                    <td>22.</td>
                    <td>
                        पाणी वापर शुल्क (रु.१,००,०००/- ) [for 1 building]
                    </td>
                    <td class="text-center">
                        <input type="text" readonly class="form-control total_amount form-control--custom" name="water_usage_charges" id="water_usage_charges" value="{{ isset($calculationSheetDetails[0]->water_usage_charges) ? $calculationSheetDetails[0]->water_usage_charges : 0 }}" />

                    </td>
                </tr>
                <tr>
                    <td>23.</td>
                    <td>
                        एकूण रक्कम रुपये (अ .क्र.१५+१८+१९+२०+२१+२२)
                    </td>
                    <td class="text-center">
                        <input type="text" readonly class="form-control form-control--custom" name="total_amount_in_rs" id="total_amount_in_rs"value="{{ isset($calculationSheetDetails[0]->total_amount_in_rs) ? $calculationSheetDetails[0]->total_amount_in_rs : 0 }}"/>

                    </td>
                </tr>
                <tr>
                    <td>24.</td>
                    <td>
                        बृहनमुंबई महानगर पालिकेकडे ऑफ साईट इन्फ्रास्ट्रक्चर शुल्क
                        रक्कमपैकी भरणा करावयाची ५/७ रक्कम
                    </td>
                    <td class="text-center">
                        <input type="text" readonly class="form-control form-control--custom" name="offsite_infrastructure_charges_to_municipal_corporation" id="offsite_infrastructure_charges_to_municipal_corporation" value="{{ isset($calculationSheetDetails[0]->offsite_infrastructure_charges_to_municipal_corporation) ? $calculationSheetDetails[0]->offsite_infrastructure_charges_to_municipal_corporation : 0 }}"/>

                    </td>
                </tr>
                <tr><td colspan="3" align="right"><input type="submit" name="submit" class="btn btn-primary" value="Save" /> </td></tr>
                </tbody>
            </table>
        </div>
    </div>
</body>
    <script>
        $(document).ready(function () {


            $('input').on('keypress', function (event) {
                var regex = new RegExp("^[0-9]+$");
                var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
                if (!regex.test(key)) {
                    event.preventDefault();
                    return false;
                }
            });


            var sum = 0;
            $(".total_area").each(function(){
                sum += +$(this).val();
            });
            $("#area_of_total_plot").val(sum);

            $("#permissible_construction_area").val($("#area_of_​​subsistence_to_calculate").val()*$("#permissible_carpet_area_coordinates").val());

            $("#permissible_proratata_area").val($("#sqm_area_per_slot").val()*$("#total_house").val());

            $("#proratata_construction_area").val($("#per_sq_km_proyerta_construction_area").val()*$("#total_house").val());


            var sub = parseFloat($("#total_permissible_construction_area").val()) - parseFloat($("#existing_construction_area").val());
            $("#remaining_area").val(sub);
            $("#remaining_residential_area").val(sub);



            if (parseFloat($("#redirekner_construction_rate").val()) === 0 || isNaN(parseFloat($("#redirekner_construction_rate").val()))) {
                $("#redirekner_val").val(null);
            }
            else {
                var div = parseFloat($("#redirekner_value").val()) / parseFloat($("#redirekner_construction_rate").val());
                $("#redirekner_val").val(div.toFixed(2));
            }


          /*  var balance = $("#remaining_residential_area").val() * ( $("input[name=dcr_rate_in_percentage]:checked").val() / 100 ) ;
            $("#balance_of_remaining_area").val(balance.toFixed(2));*/


            $("#infrastructure_fee_amount").val((parseFloat($("#remaining_area").val()) * parseFloat($("#redirekner_value").val()) * (7/100)).toFixed(2));

            var fee_amount = (parseFloat($("#remaining_area").val()) * parseFloat($("#redirekner_value").val()) * (7/100)).toFixed(2);
            $("#infrastructure_fee_amount").val(fee_amount);
            $("#amount_to_be_paid_to_municipal").val(5/7 * fee_amount);
            $("#offsite_infrastructure_charges_to_municipal_corporation").val(5/7 * fee_amount);
            $("#offsite_infrastructure_charge_to_mhada").val(2/7 * fee_amount);

            $("#layout_approval_fee").val(1000*$("#total_house").val());


            $("#debraj_removal_fee").val(6600 * $("#total_no_of_buildings").val());
            $("#water_usage_charges").val(100000 * $("#total_no_of_buildings").val());

            var total_amount = 0;
            $(".total_amount").each(function(){
               // alert($(this).attr('id') + ' => ' +$(this).val());
                total_amount += +$(this).val();
               //alert(total_amount);
            });
            $("#total_amount_in_rs").val(total_amount);



            /*var offsite_infra_fee = ($("#remaining_area").val() * (7/100)) * ($("#area_in_reserved_seats_for_vp_pio").val() - $("#total_permissible_construction_area").val());

            $("#off_site_infrastructure_fee").val(offsite_infra_fee.toFixed(2));*/

            $("#amount_to_be_paid_to_municipal1").val((5/7 * $("#off_site_infrastructure_fee").val()).toFixed(2));
            $("#offsite_infrastructure_charge_to_mhada1").val((2/7 * $("#off_site_infrastructure_fee").val()).toFixed(2));
            $("#offsite_infrastructure_charge_to_mhada1_installment").val((2/7 * $("#off_site_infrastructure_fee").val()).toFixed(2));

            $("#non_profit_duty").val(1/4 * $("#remaining_area_of_resident_area_balance").val());
            $("#non_profit_duty_installment").val(1/4 * $("#remaining_area_of_resident_area_balance").val());


            var first_installment = 0;
            $(".first_installment").each(function(){
                first_installment += +$(this).val();
            });
            $("#payment_of_first_installment").val(first_installment);

            $("#payment_of_remaining_installment").val($("#off_site_infrastructure_fee").val());
        })
    </script>
    <script>
        $(document).on("keyup", "#total_no_of_buildings", function() {
            $("#debraj_removal_fee").val(6600 * $("#total_no_of_buildings").val());
            $("#water_usage_charges").val(100000 * $("#total_no_of_buildings").val());

            var total_amount = 0;
            $(".total_amount").each(function(){
                total_amount += +$(this).val();
            });
            $("#total_amount_in_rs").val(total_amount);
        });

        $(document).on("keyup", ".total_area", function() {
            var sum = 0;
            $(".total_area").each(function(){
                sum += +$(this).val();
            });
            $("#area_of_total_plot").val(sum);
        });

        $(document).on("keyup", ".permissible_area", function() {

            $("#permissible_construction_area").val($("#area_of_​​subsistence_to_calculate").val()*$("#permissible_carpet_area_coordinates").val());
        });


        $(document).on("keyup", ".proratata_area", function() {

            $("#permissible_proratata_area").val($("#sqm_area_per_slot").val()*$("#total_house").val());
        });

        $(document).on("keyup", "#per_sq_km_proyerta_construction_area", function() {

            $("#proratata_construction_area").val($(this).val()*$("#total_house").val());
        });

        $(document).on("keyup", "#total_house", function() {

            $("#proratata_construction_area").val($("#per_sq_km_proyerta_construction_area").val()*$(this).val());
            $("#layout_approval_fee").val(1000*$(this).val());

            var total_amount = 0;
            $(".total_amount").each(function(){
                total_amount += +$(this).val();
            });
            $("#total_amount_in_rs").val(total_amount);
        });


        $(document).on("keyup", ".total_permissible", function() {

            var total = parseFloat($("#permissible_construction_area").val()) + parseFloat($("#proratata_construction_area").val()) + parseFloat($('#area_in_reserved_seats_for_vp_pio').val());
            $("#total_permissible_construction_area").val(total);
        });

        $(document).on("keyup", ".remaining_area", function() {

            if(parseFloat($("#total_permissible_construction_area").val()) <  parseFloat($("#existing_construction_area").val()) )
            {
                alert('अस्तित्वातील बांधकाम क्षेत्रफळ should be less than एकूण अनुज्ञेय बांधकाम क्षेत्रफळ'); return false;

            }

            var sub = parseFloat($("#total_permissible_construction_area").val()) - parseFloat($("#existing_construction_area").val());
            $("#remaining_area").val(sub);
            $("#remaining_residential_area").val(sub);

            if($('input[type=radio][name=dcr_rate_in_percentage]').is(':checked')) {
                var balance = $("#remaining_residential_area").val() * ($("input[type=radio][name=dcr_rate_in_percentage]").val() / 100);
                $("#balance_of_remaining_area").val(balance.toFixed(2));
            }

        });


        $(document).on("keyup", ".redirekner_val", function() {

            if (parseFloat($("#redirekner_construction_rate").val()) === 0 || isNaN(parseFloat($("#redirekner_construction_rate").val()))) {
                $("#redirekner_val").val(null);
            }
            else {
                var div = parseFloat($("#redirekner_value").val()) / parseFloat($("#redirekner_construction_rate").val());
                $("#redirekner_val").val(div.toFixed(2));
            }


        });


        $(document).on("change", "input[type=radio][name=dcr_rate_in_percentage]", function() {

            var balance = $("#remaining_residential_area").val() * ( $(this).val() / 100 ) ;
            $("#balance_of_remaining_area").val(balance.toFixed(2));

            var total_amount = 0;
            $(".total_amount").each(function(){
                total_amount += +$(this).val();
            });
            $("#total_amount_in_rs").val(total_amount);

        });


        $(document).on("keyup", "#redirekner_value", function() {
            var fee_amount = (parseFloat($("#remaining_area").val()) * parseFloat($("#redirekner_value").val()) * (7/100)).toFixed(2);
            $("#infrastructure_fee_amount").val(fee_amount);
            $("#amount_to_be_paid_to_municipal").val(5/7 * fee_amount);
            $("#offsite_infrastructure_charges_to_municipal_corporation").val(5/7 * fee_amount);
            $("#offsite_infrastructure_charge_to_mhada").val(2/7 * fee_amount);

            var total_amount = 0;
            $(".total_amount").each(function(){
                total_amount += +$(this).val();
            });
            $("#total_amount_in_rs").val(total_amount);

        });

        $(document).on("change paste keyup", ".total_amount", function() {
            var total_amount = 0;
            $(".total_amount").each(function(){
                total_amount += +$(this).val();
            });
            $("#total_amount_in_rs").val(total_amount);
        });

        $(document).on("keyup", "#remaining_area_of_resident_area_balance", function() {
            $("#non_profit_duty").val(1/4 * $(this).val());
            $("#non_profit_duty_installment").val(1/4 * $(this).val());
        });


        $(document).on("keyup", "#off_site_infrastructure_fee", function() {

            $("#amount_to_be_paid_to_municipal1").val((5/7 * $(this).val()).toFixed(2));
            $("#offsite_infrastructure_charge_to_mhada1").val((2/7 * $(this).val()).toFixed(2));
            $("#offsite_infrastructure_charge_to_mhada1_installment").val((2/7 * $(this).val()).toFixed(2));
        });


    </script>
