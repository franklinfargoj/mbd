
<h3>Village - Society Report :(Village : {{$village_names}})</h3>
<table style="border-collapse:collapse;width:100%;text-align:center;padding:5px;" border="1">
    <thead>
    <tr>
        <th>No</th>
        <th>Village Name</th>
        <th>Society Name</th>
        <th>Society Reg. No.</th>
        <th>District</th>
        <th>Taluka</th>
        <th>Layout</th>
        <th>Survey Number</th>
        <th>CTS Number</th>
        <th>Name Of Chairman</th>
        <th>Mobile no. Of Chairman</th>
        <th>Name Of Secretary</th>
        <th>Mobile no. Of Secretary</th>
        <th>Society Address</th>
        <th>Society Email Id</th>
        <th>Date mentioned on service tax letters</th>
        <th>Surplus Charges</th>
        <th>Area</th>
        <th>Last date of paying surplus charges</th>
        <th>Land Name</th>
        <th>Is Society Conveyed ?</th>
        <th>Date Of Conveyance</th>
        <th>Area Of Conveyance</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($data as $key => $datas)
        <tr>
            <td>{{$key + 1}}</td>
            <td>{{$datas->getVillageDetails['village_name']}}</td>
            <td>{{$datas->getSocietyDetails['society_name']}}</td>
            <td>{{$datas->getSocietyDetails['society_reg_no']}}</td>
            <td>{{$datas->getSocietyDetails['getDistrictName']['district_name']}}</td>
            <td>{{$datas->getSocietyDetails['getTalukaName']['taluka_name']}}</td>
            <td>{{$datas->getSocietyDetails->getLayoutName->layout_name}}</td>
            <td>{{$datas->getSocietyDetails['survey_number']}}</td>
            <td>{{$datas->getSocietyDetails['cts_number']}}</td>
            <td>{{$datas->getSocietyDetails['chairman']}}</td>
            <td>{{$datas->getSocietyDetails['chairman_mob_no'] }}</td>
            <td>{{$datas->getSocietyDetails['secretary']}}</td>
            <td>{{$datas->getSocietyDetails['secretary_mob_no']}}</td>
            <td>{{$datas->getSocietyDetails['society_address']}}</td>
            <td>{{$datas->getSocietyDetails['society_email_id']}}</td>
            <td>{{$datas->getSocietyDetails['area']}}</td>
            <td>{{$datas->getSocietyDetails['date_on_service_tax']}}</td>
            <td>{{$datas->getSocietyDetails['surplus_charges']}}</td>
            <td>{{ $datas->getSocietyDetails['surplus_charges_last_date']}}</td>
            <td>{{$datas->getSocietyDetails->getLandName['land_name'] }}</td>
            <td>{{($datas->getSocietyDetails['society_conveyed'] == 1) ? 'yes' : 'no'}}</td>
            <td>{{$datas->getSocietyDetails['date_of_conveyance']}}</td>
            <td>{{$datas->getSocietyDetails['area_of_conveyance']}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
