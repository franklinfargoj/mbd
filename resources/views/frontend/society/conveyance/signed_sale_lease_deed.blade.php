@extends('frontend.layouts.sidebarAction')
@section('actions')
    @include('frontend.society.conveyance.actions',compact('sc_application'))
@endsection
@section('css')
<style type="text/css">
    .error{
        display: block;
        color: #ce2323;
        margin-bottom: 17px;
    }
</style>
@endsection
@section('content')
@if (session('success'))
    <div class="alert alert-success society_renewal_agreement">
        <div class="text-center">{{ session('success') }}</div>
    </div>
@endif
@if (session('error'))
    <div class="alert alert-danger society_renewal_agreement">
        <div class="text-center">{{ session('error') }}</div>
    </div>
@endif

@php if($sc_application->scApplicationLog->status_id == config('commanConfig.conveyance_status.Send_society_for_registration_of_sale_&_lease')){
    $readonly = '';
    $disabled = '';
    $forward = 'false';
}else{
    $readonly = 'readonly';
    $forward = 'true';
    $disabled = 'disabled';
}
@endphp

    <div class="col-md-12">
        <!-- BEGIN: Subheader -->
        <div class="m-subheader px-0">
            <div class="d-flex">
                <div class="ml-auto btn-list">
                    <a href="javascript:void(0);" class="btn btn-link"><i class="fa fa-long-arrow-left" style="padding-right: 8px;"></i>Back</a>
                </div>
            </div>
            
            <ul class="nav nav-tabs m-tabs-line m-tabs-line--primary m-tabs-line--2x nav-tabs--custom" role="tablist">
                <li class="nav-item m-tabs__item em_tabs" id="section-1">
                    <a class="nav-link m-tabs__link active show" data-toggle="tab" href="#sale-deed-agreement" role="tab"
                       aria-selected="false">
                        <i class="la la-cog"></i> Sale Deed Agreement
                    </a>
                </li>
                <li class="nav-item m-tabs__item em_tabs" id="section-2">
                    <a class="nav-link m-tabs__link" data-toggle="tab" href="#lease-deed-agreement" role="tab" aria-selected="true">
                        <i class="la la-bell-o"></i> Lease Deed Agreement
                    </a>
                </li>
            </ul>
        </div>

        <div class="tab-content">
            <!-- sale agreement -->
            <div class="tab-pane section-1 active show" id="sale-deed-agreement" role="tabpanel">
                <div class="m-portlet m-portlet--mobile m_panel">
                    <div class="m-portlet__body" style="padding-right: 0;">
                        <div class=" row-list">
                            <div class="row">
                                <div class="col-md-12">
                                    <h5 class="section-title section-title--small mb-0">Download Stamped 
                                    & Signed Agreement</h5>
                                    <p>Click Download to download Sale Deed Agreement.</p>
                                        @if(isset($sale_agreement->document_path))
                                        <a href="{{ config('commanConfig.storage_server') .'/'. $sale_agreement->document_path }}" class="btn btn-primary" target="_blank" rel="noopener">Download</a>
                                        @else
                                            <span class="error"> * Sale Deed Agreement is not uploaded.</span>
                                        @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="m-portlet m-portlet--mobile m_panel">
                    <div class="m-portlet__body" style="padding-right: 0;">        
                        <div class="m-portlet__body m-portlet__body--spaced">
                            <form action="{{ route('upload_signed_sale_lease') }}" id="sale_deed_agreement" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="applicationId" value="{{$sc_application->id }}">
                                <input type="hidden" name="applicationType" value="{{ $sc_application->sc_application_master_id }}">
                                <input type ="hidden" name="type" value="sale">
                                <h5>Upload Sale Registered Agreement Details : </h5>
                                <div class="col-sm-12 row row-list">
                                    <div class="col-xl-5 col-lg-6 form-group focused">
                                        <label class="col-form-label" for="sub_registrar_name">Jt.Sub Registrar Name :</label>
                                        <input type="text" id="sub_registrar_name" name="sub_registrar_name" class="form-control form-control--custom m-input" value="{{ isset($saleRegDetails) ? $saleRegDetails->sub_registrar_name : '' }}" {{$readonly}}>
                                    </div>
                                    <div class="col-xl-5 col-lg-6 form-group focused">
                                        <label class="col-form-label" for="registration_year"> Registration Date :</label>
                                        <input type="text" id="registration_year" name="registration_year" class="form-control form-control--custom m-input m_datepicker" data-date-end-date="+0d" value="{{ isset($saleRegDetails) ? $saleRegDetails->registration_year : '' }}" required readonly="readonly" {{$disabled}}>
                                    </div>
                                </div>
                                <div class="col-sm-12 row">
                                    <div class="col-xl-5 col-lg-6 form-group focused">
                                        <label class="col-form-label" for="registration_no">Registration No :</label>
                                        <input type="text" id="registration_no" name="registration_no" class="form-control form-control--custom m-input" value="{{ isset($saleRegDetails) ? $saleRegDetails->registration_no : '' }}" {{$readonly}}>
                                    </div>
                                    <div class="col-xl-5 col-lg-6 form-group focused">
                                        <label class="col-form-label" for="case_year">Agreement Path :</label>
                                        @if($forward == 'false')
                                        <div class="custom-file">
                                            <input class="custom-file-input pdfcheck" name="sale_document" type="file" id="test-upload_sale_dee" required="required">
                                            <label class="custom-file-label" for="test-upload_sale_dee">Choose file...</label>
                                            <span class="text-danger" id="file_error"></span>
                                            @if(isset($regSaleDocument))
                                                <a target="_blank" class="btn-link" href="{{ config('commanConfig.storage_server').'/'.$regSaleDocument->document_path }}" download>Download</a>
                                            @endif
                                        </div>
                                        @elseif($forward == 'true' && isset($regSaleDocument))
                                            <div class="custom-file">
                                                <a target="_blank" class="btn btn-primary" href="{{ config('commanConfig.storage_server').'/'.$regSaleDocument->document_path }}" download>Download</a>
                                            </div>    
                                        @else
                                        <div class="custom-file">
                                            <span class="error"> * Sale Deed Agreement is not uploaded.</span>
                                        </div>    
                                        @endif
                                    </div>
                                </div>
                                <div class="mt-3 btn-list">
                                    @if($forward == 'false')
                                        <button class="btn btn-primary" type="submit" id="uploadBtn">Submit</button>
                                    @endif
                                    <a href="{{route('society_conveyance.index')}}" class="btn btn-secondary">Cancel</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- lease agreement -->
            <div class="tab-pane section-2" id="lease-deed-agreement" role="tabpanel">
                <div class="m-portlet m-portlet--tabs m-portlet--bordered-semi mb-0 m-portlet--shadow">
                    <div class="m-portlet__body" style="padding-right: 0;">
                        <div class=" row-list">
                            <div class="row">
                                <div class="col-md-12">
                                    <h4 class="section-title section-title--small mb-0">Download Stamped 
                                    & Signed Agreement</h4>
                                        <p>Click Download to download Lease deed agreement in .pdf format.</p>
                                        @if(isset($lease_agreement->document_path))
                                        <a href="{{ config('commanConfig.storage_server') .'/'. $lease_agreement->document_path }}" class="btn btn-primary" target="_blank" rel="noopener">Download</a>
                                        @else
                                            <span class="error"> * Lease Deed Agreement is not uploaded.</span>
                                        @endif
                                </div>
                            </div>
                        </div>
                    </div>  
                </div>      
                <div class="m-portlet m-portlet--mobile m_panel">
                    <div class="m-portlet__body" style="padding-right: 0;">        
                        <div class="m-portlet__body m-portlet__body--spaced">
                            <form action="{{ route('upload_signed_sale_lease') }}" id="sale_deed_agreement" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="applicationId" value="{{$sc_application->id }}">
                                <input type="hidden" name="applicationType" value="{{ $sc_application->sc_application_master_id }}">
                                <input type ="hidden" name="type" value="lease"> 
                                <h5>Upload Lease Registered Agreement Details : </h5>
                                <div class="col-sm-12 row row-list">
                                    <div class="col-xl-5 col-lg-6 form-group focused">
                                        <label class="col-form-label" for="sub_registrar_name">Jt.Sub Registrar Name :</label>
                                        <input type="text" id="sub_registrar_name" name="sub_registrar_name" class="form-control form-control--custom m-input" value="{{ isset($leaseRegDetails) ? $leaseRegDetails->sub_registrar_name : '' }}" {{$readonly}}>
                                    </div>
                                    <div class="col-xl-5 col-lg-6 form-group focused">
                                        <label class="col-form-label" for="registration_year"> Registration Date :</label>
                                        <input type="text" id="registration_year" name="registration_year" class="form-control form-control--custom m-input m_datepicker" data-date-end-date="+0d" value="{{ isset($leaseRegDetails) ? $leaseRegDetails->registration_year : '' }}" required readonly="readonly" {{$disabled}}>
                                    </div>
                                </div>
                                <div class="col-sm-12 row">
                                    <div class="col-xl-5 col-lg-6 form-group focused">
                                        <label class="col-form-label" for="registration_no">Registration No :</label>
                                        <input type="text" id="registration_no" name="registration_no" class="form-control form-control--custom m-input" value="{{ isset($leaseRegDetails) ? $leaseRegDetails->registration_no : '' }}" {{$readonly}}>
                                    </div>
                                    <div class="col-xl-5 col-lg-6 form-group focused">
                                        <label class="col-form-label" for="case_year">Agreement Path :</label>
                                        @if($forward == 'false')
                                            <div class="custom-file">
                                                <input class="custom-file-input pdfcheck" name="lease_document" type="file" id="test-upload_lease_dee" required="required">
                                                <label class="custom-file-label" for="test-upload_lease_dee">Choose file...</label>
                                                <span class="text-danger" id="file_error"></span>
                                                @if(isset($regLeaseDocument))
                                                    <a target="_blank" class="btn-link" href="{{ config('commanConfig.storage_server').'/'.$regLeaseDocument->document_path }}" download>Download</a>
                                                @endif
                                            </div>
                                        @elseif($forward == 'true' && isset($regLeaseDocument))
                                            <div class="custom-file">
                                                <a target="_blank" class="btn btn-primary" href="{{ config('commanConfig.storage_server').'/'.$regLeaseDocument->document_path }}" download>Download</a>
                                            </div>    
                                        @else
                                        <div class="custom-file">
                                            <span class="error"> * Lease Deed Agreement is not uploaded.</span>
                                        </div>    
                                        @endif
                                        
                                    </div>
                                </div>
                                <div class="mt-3 btn-list">
                                    @if($forward == 'false')
                                        <button class="btn btn-primary" type="submit" id="uploadBtn">Submit</button>
                                    @endif
                                    <a href="{{route('society_conveyance.index')}}" class="btn btn-secondary">Cancel</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- forward application -->
            @if($forward == 'false')
                <div class="m-portlet m-portlet--mobile m_panel">
                    <div class="m-portlet__body" style="padding-right: 0;">
                        <div class=" row-list">
                            <div class="row">
                                <div class="col-md-12">
                                    <form action="{{ route('stamp_forward_application') }}" id="ForwardFRM" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="application_id" value="{{$sc_application->id }}">
                                        <input type="hidden" name="applicationType" value="{{ $sc_application->sc_application_master_id }}">
                                        <input type="hidden" name="type" value="register">
                                        <h5 class="section-title section-title--small mb-0">Forward Application</h5>
                                        <div class="mt-3 btn-list">
                                            <button class="btn btn-primary" type="submit" id="forward">Forward Application</button>
                                        </div>
                                    </form>    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

@endsection
@section('datatablejs')
    <script src="{{ asset('vendor/unisharp/laravel-ckeditor/ckeditor.js') }}"></script>
    <script>
        CKEDITOR.disableAutoInline = true;
        CKEDITOR.replace('ckeditorText', {
            height: 700,
            allowedContent: true
        });

    </script>
    <script src="https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js"></script>
    <script>
        $(document).ready(function () {

            //cookies setting for tabs
            $(".display_msg").delay("slow").slideUp("slow");

            var id = Cookies.get('sectionid');
            if (id != undefined) {
                //alert(id);


                $(".tab-pane").removeClass('active');
                $(".nav-link").removeClass('active');
                $(".m-tabs__item").removeClass('active');
                $("#" + id+ " a").addClass('active');

                $("." + id).addClass('active');
            }

            $(".em_tabs").on('click', function () {
                $(".nav-link").removeClass('active');
                Cookies.set('sectionid', this.id);
            });

            function showUploadedFileName() {
                $('.custom-file-input').change(function (e) {
                    $(this).parents('.custom-file').find('.custom-file-label').text(e.target.files[0].name);
                });
            }
            showUploadedFileName();

            $('#sale_deed_agreement').validate({
                rules:{
                    document_path: {
                        required:true,
                        extension:'pdf'
                    }
                },
                messages:{
                    document_path: {
                        required: 'File is required to upload.',
                        extension: 'File only in pdf format is required.'
                    }
                }
            });

            $('#lease_deed_agreement').validate({
                rules:{
                    document_path: {
                        required:true,
                        extension:'pdf'
                    }
                },
                messages:{
                    document_path: {
                        required: 'File is required to upload.',
                        extension: 'File only in pdf format is required.'
                    }
                }
            });

            $('.society_registered').delay("slow").slideUp("slow");

        });

    $("#forward").click(function(){
        var valid = confirm("Are you sure you want to forward application ?");
        if (valid){
            $("#ForwardFRM").submit();
        }else{
            return false;
        }
    });        
    </script>


@endsection