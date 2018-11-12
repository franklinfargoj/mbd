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
                     <div class='d-flex btn-icon-list'>
                        <a href="{{route('get_tenants', [$value->id])}}" class='d-flex flex-column align-items-center ' style="padding-left: 5px; padding-right: 5px; text-decoration: none; color: #212529; font-size:12px;" ><span class='btn-icon btn-icon--view'><img src="{{asset('/img/view-icon.svg')}}"></span>Tenant Detail</a>
                    
                        <a href="{{route('edit_building', [$value->id])}}" class='d-flex flex-column align-items-center' style="padding-left: 5px; padding-right: 5px; text-decoration: none; color: #212529; font-size:12px;"><span class='btn-icon btn-icon--edit'><img src="{{asset('/img/edit-icon.svg')}}"></span>Edit</a>
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
        {!! $buildings->render() !!}
