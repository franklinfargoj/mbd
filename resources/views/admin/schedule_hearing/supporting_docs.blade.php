@extends('admin.layouts.sidebarAction')
@section('actions')
    @include('admin.hearing.actions',compact('hearing_data'))
@endsection
@section('content')

    <div class="col-md-12">
        <div class="m-subheader px-0 m-subheader--top">
            <div class="d-flex align-items-center">
                <h3 class="m-subheader__title m-subheader__title--separator">Supporting Documents</h3>
                {{ Breadcrumbs::render('Supporting_docs', $hearing_data->id) }}
            </div>
        </div>
        <!-- END: Subheader -->
    </div>

    @if(isset($documents_data) && (count($documents_data) > 0))
        <div class="m-portlet m-portlet--compact m-portlet--mobile">
            <div class="m-portlet__body">
                <!--begin: Search Form -->
                <div class="m-form m-form--label-align-right">
                    <!-- <div class="form-group m-form__group row align-items-center"> -->

                    <!-- </div> -->
                </div>
                <!--end: Search Form -->
                <!--begin: Datatable -->
                <table class="table">
                    <tr>
                        <th>Sr No</th>
                        <th>Upload Date</th>
                        <th>Document Name</th>
                        <th>Action</th>
                    </tr>
                    @foreach ($documents_data as $key => $data)
                        <tr>
                            <td>{{$key + 1}}</td>
                            <td>{{date('d-m-Y',
                                    strtotime($data->created_at))}}</td>
                            <td>{{$data->document_name}}</td>
                            @php $url= config('commanConfig.storage_server').'/'.$data->document_path ; @endphp
                            <td>
                                <span>
                                    <a href="{{ $url }}"
                                       class="upload_documents" target="_blank"
                                       rel="noopener" download><button type="submit"
                                                                       class="btn btn-primary btn-custom">
                                                                        Download</button></a>
                                {{--<a href="{{ route('delete_supporting_documents',encrypt($data->id)) }}"--}}
                                {{--onclick="alert('Are you sure want to delete ths document ?')" class="upload_documents"><button type="submit"--}}
                                {{--class="btn btn-primary btn-custom">--}}
                                {{--<i class="fa fa-trash"></i></button></a>--}}
                                {{--</span>--}}
                            </td>

                        </tr>

                    @endforeach
                </table>
                <!--end: Datatable -->
            </div>
        </div>


    @else
        <div class="m-portlet m-portlet--compact m-portlet--mobile">
        <h6>No Supporting documnets available by admin.</h6>
        </div>
    @endif



@endsection
