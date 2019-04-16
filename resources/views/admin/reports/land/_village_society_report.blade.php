
<h3>Village - Society Report :(Village : {{$village_names}})</h3>
<table style="border-collapse:collapse;width:100%;text-align:center;padding:5px;" border="1">
    <thead>
    <tr>
        <th>Sr.No</th>
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
    @foreach ($dataListMaster as $key => $data)
        <tr>
            <td>{{$data['id']}}</td>
            <td>{{$data['Village']}}</td>
            <td>{{$data['Society Name']}}</td>
            <td>{{$data['Society Reg. No.']}}</td>
            <td>{{$data['District']}}</td>
            <td>{{$data['Taluka']}}</td>
            <td>{{$data['Layout']}}</td>
            <td>{{$data['Survey Number']}}</td>
            <td>{{$data['CTS Number']}}</td>
            <td>{{$data['Name Of Chairman']}}</td>
            <td>{{$data['Mobile no. Of Chairman'] }}</td>
            <td>{{$data['Name Of Secretary']}}</td>
            <td>{{$data['Mobile no. Of Secretary']}}</td>
            <td>{{$data['Society Address']}}</td>
            <td>{{$data['Society Email Id']}}</td>
            <td>{{$data['Area']}}</td>
            <td>{{$data['Date mentioned on service tax letters']}}</td>
            <td>{{$data['Surplus Charges']}}</td>
            <td>{{$data['Last date of paying surplus charges']}}</td>
            <td>{{$data['Land Name'] }}</td>
            <td>{{$data['Is Society Conveyed ?']}}</td>
            <td>{{$data['Date Of Conveyance']}}</td>
            <td>{{$data['Area Of Conveyance']}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
