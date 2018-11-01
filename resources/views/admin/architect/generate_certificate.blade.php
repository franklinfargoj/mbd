@extends('admin.layouts.sidebarAction')
@section('actions')
@include('admin.architect.actions',compact('ArchitectApplication'))
@endsection
@section('content')
<div class="col-md-12">
    <div class="m-subheader px-0 m-subheader--top">
        <div class="d-flex align-items-center">
            <h3 class="m-subheader__title m-subheader__title--separator">Issue certificated to selected candidate</h3>
        </div>
        @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif
    </div>
    <div class="m-portlet">
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
        <h3 class="section-title section-title--small">Generate Certificate</h3>
        <span class="hint-text">To generate draft certificate click on 'Generate' button</span>
        <a href="{{url('finalCertificateGenerate/'.$encryptedId)}}" class="btn btn-primary mt-3" role="button">Generate</a>
    </div>
</div>

@endsection
