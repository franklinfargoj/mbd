@extends('admin.layouts.app')
@section('content')
<div class="col-md-12">
    <!-- BEGIN: Subheader -->
    <div class="m-subheader px-0 m-subheader--top">
        <div class="d-flex align-items-center">
            <h3 class="m-subheader__title m-subheader__title--separator">Evaluate Application</h3>
            {{-- Breadcrumbs::render('lease_detail',$id) }} --}}
            <div class="ml-auto btn-list">
                <a href="{{ url()->previous() }}" class="btn btn-link"><i class="fa fa-long-arrow-left" style="padding-right: 8px;"></i>Back</a>
            </div>
        </div>
    </div>
    <!-- END: Subheader -->
    <div class="m-portlet m-portlet--mobile">
        @if(Session::has('success'))
        <div class="note note-success">
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
                echo $disable=$is_view==true?'':'disabled';
                @endphp
                <form method="post" action="{{route('save_evaluate_marks')}}">
                    @csrf
                    <input type="hidden" name="application_id" value="{{$architect_application_id}}">
                    <table class="table mb-0 table--box-input">
                        <thead class="thead-default">
                            <tr>
                                <th width="30%">Document Name</th>
                                <th width="30%">Document</th>
                                <th width="10%">Marks</th>
                                <th width="30%">Remark</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $i = 0; @endphp
                            @forelse($application as $row)
                            @php $i = $i + $row->marks; @endphp
                            <tr>
                                <td>{{$row->document_name}}</td>
                                <td><a target="_blank" href="{{ config('commanConfig.storage_server')."/" .$row->document_path}}">document</a></td>
                                <td class="text-center">
                                    <div class="@if($errors->has('marks')) has-error @endif">
                                        <input {{ $disable }} type="text" name="marks[]" class="form-control form-control--custom"
                                            value="{{$row->marks}}">
                                        <input type="hidden" name="id[]" value="{{$row->id}}">

                                        <span class="help-block">{{$errors->first('marks')}}</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="@if($errors->has('remark')) has-error @endif">
                                        <textarea {{ $disable }} name="remark[]" class="form-control form-control--custom form-control--fixed-height">{{$row->remark}}</textarea>
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
                                <td class="text-center">{{$i}}</td>
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
                                        <a href="javascript:void(0);" class="btn btn-secondary">Cancel</a>
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
