        <table class="display table table-responsive table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Sr. No.</th>
                <th>Society Name</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="myTable">
        @foreach($societies as $key => $value )
            <tr>    
                <td>{{$value->id}}</td>
                <td data-search="{{$value->society_name}}">{{$value->society_name}}</td>
               <td>
                    <a class="btn btn-info" href="{{route('get_buildings', [$value->id])}}">Society Detail</a>
                    <a class="btn btn-info" href="{{route('soc_bill_level', [$value->id])}}" >Bill Level</a>
                    <a class="btn btn-info"  href="{{route('soc_ward_colony', [$value->id])}}">Ward & colony</a>
                </td>
            </tr>
        @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th>Sr. No.</th>
                <th>Society Name</th>
                <th>Action</th>
            </tr>
        </tfoot>
        </table>
        {!! $societies->render() !!}