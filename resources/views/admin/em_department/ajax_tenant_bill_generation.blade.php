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

                    {!! Form::open(['method' => 'get', 'route' => 'billing_calculations']) !!}
                    {{ Form::hidden('tenant_id', $value->id) }}
                    {{ Form::hidden('building_id', $value->building_id) }}
                    {{ Form::hidden('society_id', $society_id) }}                    
                    {!! Form::submit(trans('View Bill Details'), array('class' => 'btn btn-info mb-10')) !!}
                    {!! Form::close() !!}
                    
                    <a class="btn btn-info mb-10" href="{{route('edit_tenant', [$value->id])}}">Generate Bill</a>

                    {!! Form::open(['method' => 'get', 'route' => 'arrears_calculations']) !!}
                    {{ Form::hidden('tenant_id', $value->id) }}
                    {{ Form::hidden('building_id', $value->building_id) }}
                    {{ Form::hidden('society_id', $society_id) }}
                    {!! Form::submit(trans('Arrear Calculation'), array('class' => 'btn btn-info mb-10')) !!}
                    {!! Form::close() !!}

                    <a class="btn btn-info mb-10" href="{{route('edit_tenant', [$value->id])}}">Regenerate Bill</a>
                    
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
      