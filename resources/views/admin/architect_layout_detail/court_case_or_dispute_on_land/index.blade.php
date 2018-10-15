@extends('admin.layouts.app')

@section('content')
<div class="col-md-12">
    <div class="m-subheader px-0 m-subheader--top">
        <div class="d-flex align-items-center">
            <h3 class="m-subheader__title m-subheader__title--separator">View Court case or Dispute on land Details -
                {{$ArchitectLayoutDetail->architect_layout->layout_name}}</h3>
        </div>
    </div>
    <div class="m-portlet m-portlet--mobile m_panel">
        <div class="portlet-body">
            @if(Session::has('success'))
            <div class="alert alert-success">
                <p> {{ Session::get('success') }} </p>
            </div>
            @endif
            @if(Session::has('error'))
            <div class="alert alert-danger">
                <p> {{ Session::get('error') }} </p>
            </div>
            @endif
            <div class="m-portlet__body m-portlet__body--table m-portlet__body--serial-no">
                <div class="m-subheader">
                    {{-- <div class="d-flex align-items-center">
                        <h3 class="section-title section-title--small">
                        </h3>
                    </div> --}}
                    <div class="mt-auto">
                        <a href="{{route('architect_layout_detail_court_case_or_dispute_on_land.create',['layout_detail_id'=>encrypt($ArchitectLayoutDetail->id)])}}"
                            class="btn btn-primary btn-custom" id="">Add New Details</a>
                        <a href="{{route('architect_layout_detail.add',['layout_id'=>encrypt($ArchitectLayoutDetail->id)])}}"
                            class="btn btn-primary btn-custom">Back</a>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 form-group">
                            <table class="table">
                                <tr>
                                    <th>Date</th>
                                    <th>Name of Document</th>
                                    <th>Description</th>
                                    <th>Supporting Document</th>
                                    <th>Actions</th>
                                </tr>
                                @forelse ($courCassesOrDisputes as $courCassesOrDispute)
                                <tr>
                                    <td>{{date('d/m/Y',strtotime($courCassesOrDispute->created_at))}}</td>
                                    <td>{{$courCassesOrDispute->document_name}}</td>
                                    <td>{{$courCassesOrDispute->description}}</td>
                                    <td><a target="_blank" href="{{config('commanConfig.storage_server').'/'.$courCassesOrDispute->document_file}}">Document</a></td>
                                    <td>
                                        <a href="{{route('architect_layout_detail_court_case_or_dispute_on_land.view',['id'=>encrypt($courCassesOrDispute->id)])}}">View</a>
                                        <a href="{{route('architect_layout_detail_court_case_or_dispute_on_land.edit',['id'=>encrypt($courCassesOrDispute->id)])}}">Edit</a>
                                        {{-- <a href="{{route('architect_layout_detail_court_case_or_dispute_on_land.destroy',['id'=>encrypt($courCassesOrDispute->id)])}}">Delete</a>
                                        --}}
                                        {!! Form::open([
                                        'method' => 'DELETE',
                                        'route' => ['architect_layout_detail_court_case_or_dispute_on_land.destroy',
                                        encrypt($courCassesOrDispute->id)]
                                        ]) !!}
                                        {!! Form::submit('delete', ['class' => 'btn btn-link','onclick' => 'return
                                        confirm(\'Are you sure?\')']) !!}
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5">
                                        No Reocrds Found
                                    </td>
                                </tr>
                                @endforelse
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
