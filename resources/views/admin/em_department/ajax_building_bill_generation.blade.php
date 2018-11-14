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
                <td class="text-center"><?php echo isset($value->tenant_count[0]->count) ? $value->tenant_count[0]->count : '0'; ?></td>
                <td class="d-flex btn-submit-icon society-bill-actions">
                    <!-- <a class="btn btn-info mb-10" href="{{route('get_tenants', [$value->id])}}"> Generate Bill</a> -->

                    {!! Form::open(['method' => 'get', 'route' => 'generateBuildingBill', 'class'=>'']) !!}
                    {{ Form::hidden('building_id', $value->id) }}
                    {{ Form::hidden('society_id', $value->society_id) }}
                    {{ Form::button('<span class="btn-icon btn-icon--view"><img src="img/generate-bill-icon.svg"></span>Generate Bill', array('class'=>'btn btn--unstyled p-0 btn--icon-wrap d-flex flex-column align-items-center','type'=>'submit')) }}
                    {!! Form::close() !!}

                    {!! Form::open(['method' => 'get', 'route' => 'billing_calculations']) !!}
                    {{ Form::hidden('building_id', $value->id) }}
                    {{ Form::hidden('society_id', $value->society_id) }}
                    {{ Form::button('<span class="btn-icon btn-icon--edit"><img src="img/view-billing-details-icon.svg"></span>View Billing Details', array('class'=>'btn btn--unstyled p-0 btn--icon-wrap d-flex flex-column align-items-center','type'=>'submit')) }}
                    {!! Form::close() !!}
                    
                    {!! Form::open(['method' => 'get', 'route' => 'arrears_calculations']) !!}
                    {{ Form::hidden('building_id', $value->id) }}
                    {{ Form::hidden('society_id', $value->society_id) }}                  
                    {{ Form::button('<span class="btn-icon btn-icon--delete"><img src="img/view-arrears-calculation-icon.svg"></span>View Arrear Calculation', array('class'=>'btn btn--unstyled p-0 btn--icon-wrap d-flex flex-column align-items-center','type'=>'submit')) }}
                    {!! Form::close() !!}
                       
                    <div class="d-flex btn-icon-list"> 
                        <button class="btn btn--unstyled p-0 btn--icon-wrap d-flex flex-column align-items-center">
                            <span class="btn-icon btn-icon--regenerate">
                                <img src="{{ asset('/img/regenerate-bill-icon.svg')}}">
                            </span>Regenerate Bill
                        </button>
                    </div>

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
       