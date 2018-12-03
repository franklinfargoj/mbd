@extends('admin.layouts.sidebarAction')
@section('actions')
@include('admin.architect.actions',compact('ArchitectApplication'))
@endsection
@section('content')
<div class="col-md-12">
    <!-- BEGIN: Subheader -->
    <div class="m-subheader px-0 m-subheader--top">
        <div class="d-flex align-items-center">
            <h3 class="m-subheader__title m-subheader__title--separator">Evaluate Application</h3>
            {{ Breadcrumbs::render('evaluate_application',$ArchitectApplication->id) }}
            <div class="ml-auto btn-list">
                <a href="{{ url()->previous() }}" class="btn btn-link"><i class="fa fa-long-arrow-left" style="padding-right: 8px;"></i>Back</a>
            </div>
        </div>
    </div>
    <!-- END: Subheader -->
    <div class="m-portlet m-portlet--mobile">
        @if(Session::has('success'))
        <div class="alert alert-success">
            <div class="caption">
                <i class="fa fa-gift"></i> {{Session::get('success')}}
            </div>
            <div class="tools pull-right">
                <a href="" class="remove" data-original-title="" title=""> </a>
            </div>
        </div>
        @endif
        <div class="m-portlet__body m-portlet__body--table">
            <h3 class="section-title section-title--small">Evaluate supporting documents</h3>
            <div class="table-responsive">
                @php
                $disable="";
                $disable=$is_view==true?'':'disabled';
                @endphp
                <form method="post" action="{{route('save_evaluate_marks')}}">
                    @csrf
                    <input type="hidden" name="application_id" value="{{$ArchitectApplication->id}}">
                    <table class="table mb-0 table--box-input">
                        <thead class="thead-default">
                            <tr>
                                <th width="30%">Document Name</th>
                                <th width="20%">Document</th>
                                <th width="20%">Marks</th>
                                <th width="30%">Remark</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $i = 0; @endphp
                            <tr>
                                <td>Application form</td>
                                <td><a target="_blank" href="{{route('view_architect_application',['id'=>encrypt($ArchitectApplication->id)])}}">view</a></td>
                                <td class="text-center">
                                    <div class="@if($errors->has('marks')) has-error @endif">
                                        <input required {{ $disable }} type="number" step="0.01" max="100" name="application_marks" class="form-control form-control--custom marks"
                                    value="{{$ArchitectApplication->application_marks}}">

                                        <span class="help-block">{{$errors->first('marks')}}</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="@if($errors->has('remark')) has-error @endif">
                                        <textarea required {{ $disable }} name="application_remark" class="form-control form-control--custom form-control--fixed-height">{{trim($ArchitectApplication->application_remark)}}</textarea>
                                        <span class="help-block">{{$errors->first('remark')}}</span>
                                    </div>
                                </td>
                            </tr>
                            @php $i=$ArchitectApplication->application_marks; @endphp
                            @forelse($application as $row)
                            @php $i = $i + $row->marks; @endphp
                            <tr>
                                <td>{{$row->document_name}}</td>
                                <td><a target="_blank" href="{{ config('commanConfig.storage_server')."/" .$row->document_path}}">download</a></td>
                                <td class="text-center">
                                    <div class="@if($errors->has('marks')) has-error @endif">
                                        <input required {{ $disable }} type="number" step="0.01" name="marks[]" max="100" class="form-control form-control--custom marks"
                                            value="{{$row->marks?$row->marks:'0.00'}}">
                                        <input type="hidden" name="id[]" value="{{$row->id}}">

                                        <span class="help-block">{{$errors->first('marks')}}</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="@if($errors->has('remark')) has-error @endif">
                                        <textarea required {{ $disable }} name="remark[]" class="form-control form-control--custom form-control--fixed-height">{{$row->remark}}</textarea>
                                        <span class="help-block">{{$errors->first('remark')}}</span>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4">No record found</td>
                            </tr>
                            @endforelse
                            <tr>
                                <td class="font-weight-semi-bold">Grand total</td>
                                <td>&nbsp;</td>
                                <td class="text-center"><span class="grand_total">{{ $i }}<span></td>
                                <td>&nbsp;</td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit mt-5">
                        <div class="m-form__actions px-0">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="btn-list">
                                        <button type="submit" id="" style="display:{{$is_view==false?'none':''}}" class="btn btn-primary">Save</button>
                                        {{-- <a href="javascript:void(0);" class="btn btn-secondary">Cancel</a> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    $(document).on("keydown keyup", ".marks", function() {
    var sum = 0;
    $(".marks").each(function(){
        sum += +$(this).val();
    });
    $(".grand_total").html(sum);
    console.log(sum)
});

    </script>
@endsection
