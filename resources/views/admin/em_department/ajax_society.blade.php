        <table class="display table table-responsive table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Sr. No.</th>
                <th>Society Name</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="myTable">
                    <?php $row_no = 1; ?>
        @foreach($societies as $key => $value )
            <tr>    
                <td>{{$row_no++}}</td>
                <td data-search="{{$value->society_name}}">{{$value->society_name}}</td>
               <td>
                    <div class='d-flex btn-icon-list'>
                        <a href="{{route('get_buildings', [$value->id])}}" class='d-flex flex-column align-items-center ' style="padding-left: 5px; padding-right: 5px; text-decoration: none; color: #212529; font-size:12px;"><span class='btn-icon btn-icon--view'><img src="{{asset('/img/view-icon.svg')}}"></span>Society Detail</a>
                    
                        <a href="{{route('soc_bill_level', [$value->id])}}" class='d-flex flex-column align-items-center' style="padding-left: 5px; padding-right: 5px; text-decoration: none; color: #212529; font-size:12px;"><span class='btn-icon btn-icon--edit'><img src="{{asset('/img/edit-icon.svg')}}"></span>Bill Level</a>
                       
                        <a href="{{route('soc_ward_colony', [$value->id])}}" class='d-flex flex-column align-items-center' style="padding-left: 5px; padding-right: 5px; text-decoration: none; color: #212529; font-size:12px;"><span class='btn-icon btn-icon--edit'><img src="{{asset('/img/edit-icon.svg')}}"></span>Ward & colony</a>

                    </div>
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