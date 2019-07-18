@extends('frontend.layouts.sidebarAction')
@section('css')
<style type="text/css">
    .font_w500{
        font-weight: 500;
    }
    .error{
        display: block;
        color: #ce2323;
        margin-bottom: 17px;
    }
</style>
@endsection
@section('actions')
    @include('frontend.society.conveyance.actions',compact('sc_application', 'documents', 'documents_uploaded'))
@endsection
@section('content')
    @php $readonly = '';
    if($sc_application->scApplicationLog->status_id == config('commanConfig.conveyance_status.Verify_sale_&_lease_deed')){
        $readonly = '';
    }else{
        $readonly = 'readonly';
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
            @if (session('success'))
                <div class="alert alert-success society_registered">
                    <div class="text-center">{{ session('success') }}</div>
                </div>
            @endif
            <ul class="nav nav-tabs m-tabs-line m-tabs-line--primary m-tabs-line--2x nav-tabs--custom" role="tablist">
                <li class="nav-item m-tabs__item em_tabs" id="section-2">
                    <a class="nav-link m-tabs__link active show" data-toggle="tab" href="#sale-deed-agreement" role="tab" aria-selected="true">
                        <i class="la la-bell-o"></i> Sale Deed Agreement
                    </a>
                </li>
                <li class="nav-item m-tabs__item em_tabs" id="section-3">
                    <a class="nav-link m-tabs__link" data-toggle="tab" href="#lease-deed-agreement" role="tab" aria-selected="true">
                        <i class="la la-bell-o"></i> Lease Deed Agreement
                    </a>
                </li>
            </ul>
        </div>

        <div class="tab-content">
            <!-- sale deed agreement -->
            <div class="tab-pane section-2" id="sale-deed-agreement" role="tabpanel">
                <div class="m-portlet m-portlet--tabs m-portlet--bordered-semi mb-0">
                    <div class="portlet-body">
                        <form action="{{ route('upload_verified_sale_lease') }}" id="sale_deed_agreement" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" id="application_id" name="application_id" value="{{ $sc_application->id }}">
                            <input type="hidden" id="document_name" name="document_name" value="{{ $sc_application->SaleAgreement }}">
                            <div class="m-portlet__body w-100 row-list" style="padding-right: 0;">
                                <div class="row mt-3">
                                    <div class="col-sm-6">
                                        <span class="hint-text font_w500">Click on 'Download' to download draft Sale Deed Agreement</span>
                                        @if(isset($sc_application->DraftSaleAgreement))
                                            <div class="mt-3">
                                                <a href="{{ config('commanConfig.storage_server') .'/'.$sc_application->DraftSaleAgreement->document_path }}" target="_blank" class="btn btn-primary btn-custom" rel="noopener">Download</a>
                                            </div>
                                        @else    
                                            <span class="error">* Draft Sale Deed Agreement is not uploaded </span>
                                        @endif    
                                    </div>
                                    <div class="col-sm-6 d-flex flex-column h-100 border-left">
                                        <span class="hint-text font_w500">Click on 'Upload' to verified upload Sale Deed Agreement</span>
                                        <div class="custom-file mt-3">
                                            <input class="custom-file-input pdfcheck" name="document_path" type="file" id="test-upload_sale_dee" required="required">
                                            <label class="custom-file-label" for="test-upload_sale_dee">Choose file...</label>
                                            <span class="text-danger" id="file_error"></span>
                                            @if($sc_application->VerifiedSaleAgreement)
                                             <a href="{{ config('commanConfig.storage_server') .'/'.$sc_application->VerifiedSaleAgreement->document_path }}" target="_blank" class="btn btn-link" rel="noopener">Download</a>
                                            @endif 
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 mt-3" style="width: 890px;">
                                <span class="font_w500">Comments</span>
                                    <textarea class="form-control form-control--custom" name="remark" rows="5" cols="30" id="remark" placeholder="Write your comments here" class="form-control" {{ $readonly }}> 
                                    </textarea>
                                </div>
                                <div class="col-xs-12 mt-4">
                                    @if($sc_application->scApplicationLog->status_id == config('commanConfig.conveyance_status.Verify_sale_&_lease_deed'))
                                        <button type="submit" class="btn btn-primary btn-custom" id="saleBtn">Upload</button>
                                    @endif    
                                </div>
                            </div>
                        </form>    
                    </div>
                </div>
            </div>

            <div class="tab-pane section-3" id="lease-deed-agreement" role="tabpanel">
                <!-- lease deed agreement -->
                <div class="m-portlet m-portlet--tabs m-portlet--bordered-semi mb-0">
                    <div class="portlet-body">
                        <form action="{{ route('upload_verified_sale_lease') }}" id="lease_deed_agreement"  method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" id="application_id" name="application_id" value="{{ $sc_application->id }}">
                            <input type="hidden" id="document_name" name="document_name" value="{{ $sc_application->LeaseAgreement }}">
                            <div class="m-portlet__body" style="padding-right: 0;">
                                <div class="row w-100 row-list">
                                    <div class="col-sm-6">
                                        <span class="hint-text font_w500">Click on 'Download' to download Draft Lease Deed Agreement</span>
                                        @if(isset($sc_application->DraftLeaseAgreement))
                                            <div class="mt-3">
                                                <a href="{{ config('commanConfig.storage_server') .'/'.$sc_application->DraftLeaseAgreement->document_path }}" target="_blank" class="btn btn-primary btn-custom" rel="noopener">Download</a>
                                            </div>
                                        @else    
                                            <span class="error">* Draft Lease Deed Agreement is not uploaded </span>
                                        @endif    
                                    </div>
                                    <div class="col-sm-6 d-flex flex-column h-100 border-left">
                                        <span class="hint-text font_w500">Click on 'Upload' to verified upload Lease Deed Agreement</span>
                                           
                                        <div class="custom-file mt-3">
                                            <input class="custom-file-input pdfcheck" name="document_path" type="file"
                                                   id="test-upload_lease_deed" required="required">
                                            <label class="custom-file-label" for="test-upload_lease_deed">Choose file...</label>
                                            <span class="text-danger" id="file_error"></span>
                                            @if($sc_application->VerifiedLeaseAgreement)
                                             <a href="{{ config('commanConfig.storage_server') .'/'.$sc_application->VerifiedLeaseAgreement->document_path }}" target="_blank" class="btn btn-link" rel="noopener">Download</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="d-flex flex-column h-100">
                                        <span class="font_w500"> Comments : </span>
                                        <textarea name="remark" rows="5" cols="30" id="remark" placeholder="Write your comments here" class="form-control form-control--custom" {{ $readonly }}></textarea>
                                        <div class="mt-auto"><br/>
                                        @if($sc_application->scApplicationLog->status_id == config('commanConfig.conveyance_status.Verify_sale_&_lease_deed'))
                                            <button type="submit" class="btn btn-primary btn-custom" id="uploadBtn">Upload</button>
                                        @endif    
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>    
                    </div>
                </div>
            </div>
        </div>
    
        <!-- common upload and submit -->
        @if($sc_application->scApplicationLog->status_id == config('commanConfig.conveyance_status.Verify_sale_&_lease_deed'))
        <div class="m-portlet m-portlet--tabs m-portlet--bordered-semi mb-0">
            <div class="portlet-body">
                <h5>Forward Application</h5>
                <div class="m-portlet__body" style="padding-right: 0;"> 
                    <form action="{{ route('stamp_forward_application') }}" id="ForwardFRM" method="post" enctype="multipart/form-data">
                        @csrf 
                        <input type="hidden" name="type" value="verified">
                        <input type="hidden" id="application_id" name="application_id" value="{{ $sc_application->id }}">
                        <div class="mt-auto"><br/>
                            <button type="submit" class="btn btn-primary btn-custom" id="subbtn">Submit & Forward</button>
                        </div>
                    </form>    
                </div>
            </div>
        </div>
        @endif         
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

            var id = Cookies.get('sectionId');
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
                Cookies.set('sectionId', this.id);
            });

            $('#stamp_duty_letter').validate({
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



            $('#society_resolution').validate({
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

            $('#society_undertaking').validate({
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

$("#subbtn").click(function(){
    var valid = confirm("Are you sure you want to forward application ?");
    if (valid){
        $("#ForwardFRM").submit();
    }else{
        return false;
    }
});    
</script>


@endsection