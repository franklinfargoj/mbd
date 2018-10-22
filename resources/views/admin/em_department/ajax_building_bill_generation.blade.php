    <table id="example" class="display table table-responsive table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Sr. No.</th>
                <th>Building / Chawl Number</th>
                <th>Building / Chawl Name</th>
                <th>Number of Tenant</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="myTable">
        @foreach($buildings as $key => $value )
            <tr>
                <td>{{$value->id}}</td>
                <td>{{$value->building_no}}</td>
                <td>{{$value->name}}</td>
                <td><?php echo isset($value->tenant_count[0]->count) ? $value->tenant_count[0]->count : '0'; ?></td>
                <td>
                    <a class="btn btn-info" href="{{route('get_tenants', [$value->id])}}"> Generate Bill</a>
                   
                    {!! Form::open(['method' => 'Post', 'route' => 'arrears_calculations']) !!}
                    @csrf
                    {{ Form::hidden('id', $value->id) }}
                    {{ Form::hidden('society_id', $value->society_id) }}
                    {!! Form::submit(trans('View Billing Details'), array('class' => 'btn btn-info')) !!}
                    {!! Form::close() !!}
                    
                    {!! Form::open(['method' => 'Post', 'route' => 'arrears_calculations']) !!}
                    @csrf
                    {{ Form::hidden('id', $value->id) }}
                    {{ Form::hidden('society_id', $value->society_id) }}
                    {!! Form::submit(trans('View Arrear Calculation'), array('class' => 'btn btn-info')) !!}
                    {!! Form::close() !!}

                    <a class="btn btn-info" href="{{route('edit_building', [$value->id])}}">Regenerate Bill</a>
                </td>
            </tr>
        @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th>Sr. No.</th>
                <th>Building / Chawl Number</th>
                <th>Building / Chawl Name</th>
                <th>Number of Tenant</th>
                <th>Action</th>
            </tr>
        </tfoot>
        </table>
       