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
              <?php $row_no = 1; ?>
        @foreach($buildings as $key => $value )
            <tr>
                <td>{{$row_no++}}</td>
                <td>{{$value->building_no}}</td>
                <td>{{$value->name}}</td>
                <td><?php echo isset($value->tenant_count[0]->count) ? $value->tenant_count[0]->count : '0'; ?></td>
                <td>                  
                   
                    {!! Form::open(['method' => 'get', 'route' => 'billing_calculations']) !!}
                    {{ Form::hidden('building_id', $value->id) }}
                    {{ Form::hidden('society_id', $value->society_id) }}
                    {{ Form::button('<span class="btn-icon btn-icon--edit"><img src="/img/view-billing-details-icon.svg"></span> View Billing Details', array('class'=>'btn btn--unstyled p-0 btn--icon-wrap d-flex flex-column align-items-center','type'=>'submit')) }}
                    {!! Form::close() !!}

                    {!! Form::open(['method' => 'get', 'route' => 'generate_receipt_society']) !!}
                    {{ Form::hidden('building_id', $value->id) }}
                    {{ Form::hidden('society_id', $value->society_id) }}     
                    <div class="d-flex btn-icon-list">
                    {{ Form::button('<span class="btn-icon btn-icon--edit"><img src="/img/generate-bill-icon.svg"></span>Generate Reciept', array('class'=>'btn btn--unstyled p-0 btn--icon-wrap d-flex flex-column align-items-center','type'=>'submit')) }}
                    </div>
                    {!! Form::close() !!}
                    
                    {!! Form::open(['method' => 'get', 'route' => 'view_bill_building']) !!}
                    {{ Form::hidden('building_id', $value->id) }}
                    {{ Form::hidden('society_id', $value->society_id) }}                   
                    {{ Form::button('<span class="btn-icon btn-icon--edit"><img src="/img/view-arrears-calculation-icon.svg"></span>View Bill', array('class'=>'btn btn--unstyled p-0 btn--icon-wrap d-flex flex-column align-items-center','type'=>'submit')) }}
                    {!! Form::close() !!}

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
       