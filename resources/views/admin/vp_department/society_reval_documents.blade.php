
    @extends('admin.layouts.sidebarAction')
    @section('actions')
        @include('admin.vp_department.reval_action',compact('ol_application'))
    @endsection
    @section('content')
        <div class="col-md-12">
            <!-- BEGIN: Subheader -->
            <div class="m-subheader px-0 m-subheader--top">
                <div class="d-flex align-items-center">
                    <h3 class="m-subheader__title m-subheader__title--separator">
                        Society Revalidation Documents </h3>
                    {{ Breadcrumbs::render('society_reval_documents_vp',$ol_application->id) }}
                    <a href="{{ url()->previous() }}" class="btn btn-link ml-auto"><i class="fa fa-long-arrow-left" style="padding-right: 8px;"></i>Back</a>
                </div>
            </div>
            <div class="m-portlet m-portlet--creative m-portlet--first m-portlet--bordered-semi mb-0 m-portlet--table">

                <div class="m-portlet__body m-portlet__body--table">
                    <div class="m-section mb-0">
                        <div class="m-section__content mb-0 table-responsive">
                            <table class="table mb-0">
                                <thead class="thead-default">
                                <tr>
                                    <th width="10%"> क्रमांक </th>
                                    <th width="90%"> तपशील </th>
                                    <th> दस्तावेज </th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $i=0; ?>
                                @foreach($societyDocument as $data)
                                    <tr>
                                        <td>{{ $i+1}}.</td>
                                        <td>{{(isset($data->name) ? $data->name : '')}}
                                        </td>
                                        <td class="text-center">
                                            @if(isset($data->reval_documents->society_document_path)) 
                                                @if($data->is_other == 1) 
                                                    <a href="{{ route('view_reval_other_document',[encrypt($ol_application->id),encrypt($data->id)]) }}" class="app-card__details mb-0 btn-link" style="font-size: 14px">View</a>
                                                @else
                                                <a href="{{ asset($data->reval_documents->society_document_path) }}" target="_blank">
                                                    <img class="pdf-icon" src="{{ asset('/img/pdf-icon.svg')}}"></a>
                                                @endif
                                            @else
                                                <h2 class="m--font-danger">
                                                    <i class="fa fa-remove"></i>
                                                </h2>    
                                            @endif
                                        </td>
                                    </tr>
                                    @php $i++; @endphp
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection