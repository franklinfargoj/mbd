        <table id="example" class="display table table-responsive table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Sr. No.</th>
                <th>Flat No.</th>
                <th>Saluation</th>
                <th>First Name</th>
                <th>Middle Name</th>
                <th>Last Name</th>
                <th>Use</th>
                <th>Carpet Area</th>
                <th>Tenant Type</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="myTable">
        @foreach($buildings as $key => $value )
            <tr>
                <td>{{$value->id}}</td>
                <td>{{$value->flat_no}}</td>
                <td>{{$value->saluation}}</td>
                <td>{{$value->first_name}}</td>
                <td>{{$value->middle_name}}</td>
                <td>{{$value->last_name}}</td>
                <td>{{$value->use}}</td>
                <td>{{$value->carpet_area}}</td>
                <td>{{$value->tenant_type}}</td>
                <td>
                    <a class="btn btn-info" href="{{route('edit_tenant', [$value->id])}}">Edit</a>
                    <a class="btn btn-danger" onclick="return confirm('Are you sure?')" href="{{route('delete_tenant', [$value->id])}}">Delete</a>
                </td>
            </tr>
        @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th>Sr. No.</th>
                <th>Flat No.</th>
                <th>Saluation</th>
                <th>First Name</th>
                <th>Middle Name</th>
                <th>Last Name</th>
                <th>Use</th>
                <th>Carpet Area</th>
                <th>Tenant Type</th>
                <th>Action</th>
            </tr>
        </tfoot>
        </table>
        {!! $buildings->render() !!}