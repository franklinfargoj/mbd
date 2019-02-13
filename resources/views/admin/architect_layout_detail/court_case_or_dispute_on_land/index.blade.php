@extends('admin.layouts.app')

@section('content')
<div class="col-md-12">
    <div class="m-subheader px-0 m-subheader--top">
        <div class="d-flex align-items-center">
            <h3 class="m-subheader__title m-subheader__title--separator">Court case or Dispute -
                {{$ArchitectLayoutDetail->architect_layout->master_layout!=""?$ArchitectLayoutDetail->architect_layout->master_layout->layout_name:''}}</h3>
            <div class="ml-auto btn-list">
                <a href="{{route('architect_layout_detail.edit',['layout_detail_id'=>encrypt($ArchitectLayoutDetail->id),'#court-case-or-dispute-on-land-section'])}}" class="btn btn-link"><i class="fa fa-long-arrow-left"
                        style="padding-right: 8px;"></i>Back</a>
                {{-- <a href="#" target="_blank" id="download_application_form" class="btn print-icon" rel="noopener"
                    onclick="printContent('printdiv')"><img src="{{asset('/img/print-icon.svg')}}" title="print"></a> --}}
            </div>
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
            <div class="m-portlet__body m-portlet__body--table m-portlet__body--serial-no dataTables_wrapper">
                <div class="m-subheader">
                    {{-- <div class="d-flex align-items-center">
                        <h3 class="section-title section-title--small">
                        </h3>
                    </div> --}}
                    <div class="d-flex">
                        <div class="mt-auto ml-auto">
                            <a href="{{route('architect_layout_detail_court_case_or_dispute_on_land.create',['layout_detail_id'=>encrypt($ArchitectLayoutDetail->id)])}}"
                                class="btn btn-primary btn-custom" id="">Add New Details</a>
                        </div>
                    </div>
                    <div class="table-scrollable">
                        <table class="table dataTable">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Name of Document</th>
                                    <th>Description</th>
                                    <th>Supporting Document</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            @forelse ($courCassesOrDisputes as $courCassesOrDispute)
                            <tr>
                                <td>{{date('d/m/Y',strtotime($courCassesOrDispute->created_at))}}</td>
                                <td>{{$courCassesOrDispute->document_name}}</td>
                                <td>{{$courCassesOrDispute->description}}</td>
                                <td><a class="btn-link" target="_blank" href="{{config('commanConfig.storage_server').'/'.$courCassesOrDispute->document_file}}"><img class="pdf-icon" src="{{ asset('/img/pdf-icon.svg')}}"></a></td>
                                <td>
                                    <div class="d-flex btn-icon-list">
                                        <a class="btn btn--unstyled p-0 btn--icon-wrap d-flex align-items-center flex-column"
                                            href="{{route('architect_layout_detail_court_case_or_dispute_on_land.view',['id'=>encrypt($courCassesOrDispute->id)])}}">
                                            <span class="btn-icon btn-icon--view">
                                                <img src="{{ asset('/img/view-icon.svg')}}">
                                            </span>View
                                        </a>
                                        <a class="btn btn--unstyled p-0 btn--icon-wrap d-flex align-items-center flex-column"
                                            href="{{route('architect_layout_detail_court_case_or_dispute_on_land.edit',['id'=>encrypt($courCassesOrDispute->id)])}}">
                                            <span class="btn-icon btn-icon--edit">
                                                <img src="{{ asset('/img/edit-icon.svg')}}">
                                            </span>Edit
                                        </a>
                                        {{-- <a href="{{route('architect_layout_detail_court_case_or_dispute_on_land.destroy',['id'=>encrypt($courCassesOrDispute->id)])}}">Delete</a>
                                        --}}
                                        {!! Form::open([
                                        'method' => 'DELETE',
                                        'class' => 'd-flex btn-submit-icon',
                                        'route' =>
                                        ['architect_layout_detail_court_case_or_dispute_on_land.destroy',
                                        encrypt($courCassesOrDispute->id)]
                                        ]) !!}
                                        <button type="submit" name="delete" value="delete" class="btn btn--unstyled p-0 btn--icon-wrap d-flex align-items-center flex-column">
                                            <span class="btn-icon btn-icon--delete">
                                                <img src="{{ asset('/img/shortlist-remove-icon.svg')}}">
                                            </span>Delete
                                        </button>
                                        {{-- {!! Form::submit('delete', ['class' => 'btn btn--unstyled p-0
                                        btn--icon-wrap d-flex align-items-center flex-column','onclick' => 'return
                                        confirm(\'Are you sure?\')']) !!} --}}
                                        {!! Form::close() !!}
                                    </div>
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
@endsection
