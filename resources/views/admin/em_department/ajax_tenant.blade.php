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
                    <?php $row_no = 1; ?>
        @foreach($buildings as $key => $value )
            <tr>
                <td>{{$row_no++}}</td>
                <td>{{$value->flat_no}}</td>
                <td>{{$value->salutation}}</td>
                <td>{{$value->first_name}}</td>
                <td>{{$value->middle_name}}</td>
                <td>{{$value->last_name}}</td>
                <td>{{$value->use}}</td>
                <td>{{$value->carpet_area}}</td>
                <td>                    
                    @foreach($tenament as $key2 => $value2)
                     {{ $value->tenant_type == $value2->id ? $value2->name : '' }} 
                    @endforeach
                </td>
                <td>
                    <div class='d-flex btn-icon-list'>
                        <a href="{{route('edit_tenant', [encrypt($value->id)])}}" class='d-flex flex-column align-items-center' style="padding-left: 5px; padding-right: 5px; text-decoration: none; color: #212529; font-size:12px;"><span class='btn-icon btn-icon--edit'><img src="{{asset('/img/edit-icon.svg')}}"></span>Edit</a>

                        <a href="{{route('delete_tenant', [encrypt($value->id)])}}" class='d-flex flex-column align-items-center' style="padding-left: 5px; padding-right: 5px; text-decoration: none; color: #212529; font-size:12px;" onclick="return confirm('Are you sure?')" ><span class='btn-icon btn-icon--delete'><img src="{{asset('/img/delete-icon.svg')}}"></span>Delete</a>

                    </div>
                   
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