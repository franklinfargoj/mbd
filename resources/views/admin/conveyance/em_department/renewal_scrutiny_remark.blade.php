@extends('admin.layouts.app')
@section('css')

@section('content')

    <div class="col-md-12">
        <!-- BEGIN: Subheader -->
        <div class="m-subheader px-0">
            <div class="d-flex">
                {{-- {{ Breadcrumbs::render('calculation_sheet',$ol_application->id) }} --}}
                <div class="ml-auto btn-list">
                    <a href="javascript:void(0);" class="btn btn-link"><i class="fa fa-long-arrow-left" style="padding-right: 8px;"></i>Back</a>
                </div>
            </div>
            <ul class="nav nav-tabs m-tabs-line m-tabs-line--primary m-tabs-line--2x nav-tabs--custom" role="tablist">
                <li class="nav-item m-tabs__item">
                    <a class="nav-link m-tabs__link active show" data-toggle="tab" href="#no-dues-certificate" role="tab"
                       aria-selected="false">
                        <i class="la la-cog"></i> No Dues Certificate
                    </a>
                </li>
                <li class="nav-item m-tabs__item">
                    <a class="nav-link m-tabs__link" data-toggle="tab" href="#list-of-bonafide_allottes" role="tab" aria-selected="true">
                        <i class="la la-bell-o"></i> List of Bonafide Allottes
                    </a>
                </li>
                <li class="nav-item m-tabs__item">
                    <a class="nav-link m-tabs__link" data-toggle="tab" href="#covering-letter" role="tab" aria-selected="true">
                        <i class="la la-bell-o"></i> Covering Letter
                    </a>
                </li>
            </ul>
        </div>

        <div class="tab-content">
                <div class="tab-pane active show" id="no-dues-certificate" role="tabpanel">
                <!-- society details div here -->
                <div class="m-portlet m-portlet--tabs m-portlet--bordered-semi mb-0">
                    <div class="portlet-body">
                        <div class="m-portlet__body m-portlet__body--table m-portlet__body--serial-no">
                            <form id="noDuesCerti" action="{{route('em.save_renewal_no_dues_certificate')}}" method="POST">
                                @csrf
                                {{--<input type="hidden" id="applicationId" name="applicationId" value="{{$applicatonId}}">--}}
                                <textarea id="ckeditorText" name="ckeditorText" style="display: none;">

                                    <div style="float: left; padding-left: 15px;">
                                        <span style="font-weight: bold; font-size: 20px; ">Subject:</span>
                                        <div style="float: left;line-height: 2.0; padding-left: 20px;">
                                        <p style="font-size: 15px; ">It is to certify that Building No. ____________ consisting of _____________ T/S under the _____________ Scheme at __________ In favour of ___________
Co-op. Housing Society Ltd. Have paid all the dues in respect of above bldg./bldgs. Including the final sale price for the bldg. and premium of the land as
                                            follow:</p>
                                        </div>
                                        <p style="float: left;line-height: 2.0; padding-left: 20px; font-size: 15px; ">
                                            5. Final Sale Price of the Bldg/bldgs.<br/>

                                            (A) Cost of Construction<span style="padding-left: 30px;">________________</span><br/>

                                            (B) Premium Land<span style="padding-left: 68px;">________________</span><br/>

                                            <span style="padding-left: 70px;">Total<span style="padding-left: 88px;">________________</span></span>
                                        </p>
                                    </div>

                                </textarea>
                                <input type="submit" value="save" style="background-color: #f0791b;border-color: #f0791b;color: #fff !important;font-family: Poppins;cursor: pointer;display: inline-block;font-weight: 400;text-align: center;white-space: nowrap;vertical-align: middle;border: 1px solid transparent;transition: all .15s ease-in-out;border-radius: .25rem;line-height: 1.25;padding: .65rem 1.25rem;font-size: 1rem;">

                            </form>
                        </div>
                    </div>
                </div>
            </div>
                <div class="tab-pane" id="list-of-bonafide_allottes" role="tabpanel">
                <div class="m-portlet m-portlet--tabs m-portlet--bordered-semi mb-0 m-portlet--shadow">
                    <div class="portlet-body">
                        <div class="m-portlet__body m-portlet__body--table">
                            <div class="m-subheader">
                                <div class="d-flex align-items-center justify-content-center">
                                    <h3 class="section-title text-uppercase">List of Allotte</h3>
                                </div>
                            </div>
                            <div class="m-section__content mb-0 table-responsive">
                                <form class="nav-tabs-form" role="form" method="POST" action="">
                                    <table id="one" class="table mb-0 table--box-input" style="padding-top: 10px;">
                                        <div class="d-flex justify-content-between align-items-center mb-4">
                                            <a target="_blank" href="javascript:void(0);" class="btn print-icon ml-auto"><img
                                                        src="{{asset('/img/print-icon.svg')}}" onclick='PrintElem("one");'
                                                        style="max-width: 22px"></a>
                                        </div>
                                        <thead class="thead-default">
                                        <tr>
                                            <th class="table-data--xs">Sr. No</th>
                                            <th>Tenement No.</th>
                                            <th class="table-data--md">Name of Tenant</th>
                                            <th>Residential / Non Residential</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>1.</td>
                                            <td>A3A3</td>
                                            <td>A .N.Joshi</td>
                                            <td>Residential</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                <div class="tab-pane" id="covering-letter" role="tabpanel">
                    <div class="panel" id="ee-note">
                        <div class="m-portlet m-portlet--tabs m-portlet--bordered-semi mb-0 m-portlet--shadow">
                            <div class="portlet-body">
                                <div class="m-portlet__body m-portlet__body--table">
                                    <div class="m-section__content mb-0 table-responsive">
                                        <div class="container">
                                            <div>
                                                <span><h5>Covering Letter</h5></span>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="d-flex flex-column h-100 two-cols">
                                                        <h5>Upload letter</h5>
                                                        <span class="hint-text">Click on 'Upload' to upload covering letter.</span>
                                                        <form action="{{ route('em.upload_covering_letter') }}" method="post" enctype="multipart/form-data">
                                                            @csrf
                                                            <div class="custom-file">
                                                                <input class="custom-file-input" name="covering_letter" type="file"
                                                                       id="test-upload" required="">
                                                                <label class="custom-file-label" for="test-upload">Choose
                                                                    file...</label>
                                                                <span class="help-block">
                                                @if(session('error_uploaded_file'))
                                                                        {{session('error_uploaded_file')}}
                                                                    @endif
                                            </span>
                                                                {{--<input type="hidden" name="id" value="{{ $application_details->id }}">--}}
                                                            </div>
                                                            <div class="mt-auto">
                                                                <button type="submit" class="btn btn-primary btn-custom"
                                                                        id="uploadBtn">Upload</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>

                                                <div class="col-sm-6 border-left">
                                                    <div class="d-flex flex-column h-100 two-cols">
                                                        <h5>Download Note</h5>
                                                        <span class="hint-text">Download covering letter in .doc format</span>
                                                        <div class="mt-auto">
                                                            <a title="Donwload Offer Letter Application" href="{{ route('society_offer_letter_application_download') }}" target="_blank" class="btn btn-primary" rel="noopener"><i class="icon-pencil"></i>Donwload Offer Letter Application</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
@endsection
@section('js')
<script src="{{ asset('vendor/unisharp/laravel-ckeditor/ckeditor.js') }}"></script>
<script>
    CKEDITOR.disableAutoInline = true;
    CKEDITOR.replace('ckeditorText', {
        height: 700,
        allowedContent: true
    });

</script>
    @endsection