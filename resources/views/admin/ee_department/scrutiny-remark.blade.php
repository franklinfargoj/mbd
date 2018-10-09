@extends('admin.layouts.sidebarAction')
@section('actions')
@include('admin.ee_department.action',compact('ol_application'))
@endsection
@section('content')

@if(session()->has('success'))
<div class="alert alert-success display_msg">
    {{ session()->get('success') }}
</div>
@endif

@if(session()->has('error'))
<div class="alert alert-success display_msg">
    {{ session()->get('error') }}
</div>
@endif

<div class="custom-wrapper">
    <div class="col-md-12">
        <div class="d-flex">
            {{ Breadcrumbs::render('document-submitted',$ol_application->id,$arrData['society_detail']->id) }}
            <div class="ml-auto btn-list">
                <a href="{{ url()->previous() }}" class="btn btn-link"><i class="fa fa-long-arrow-left" style="padding-right: 8px;"></i>Back</a>
            </div>
        </div>
        <div id="tabbed-content" class="">
            <ul id="top-tabs" class="nav nav-tabs m-tabs-line m-tabs-line--primary m-tabs-line--2x nav-tabs--custom tabs">
                <li class="nav-item m-tabs__item active ee_tabs" data-target="#document-scrunity" id="section-1">
                    <a class="nav-link m-tabs__link">
                        <i class="la la-cog"></i> Document Scrutiny
                    </a>
                </li>
                <li class="nav-item m-tabs__item ee_tabs" data-target="#checklist-scrunity" id="section-2">
                    <a class="nav-link m-tabs__link">
                        <i class="la la-cog"></i> Checklist Scrutiny
                    </a>
                </li>
                <li class="nav-item m-tabs__item ee_tabs" data-target="#ee-note" id="section-3">
                    <a class="nav-link m-tabs__link">
                        <i class="la la-cog"></i> EE Note
                    </a>
                </li>
            </ul>
            <div class="m-portlet m-portlet--tabs m-portlet--bordered-semi mb-0">
                <div class="portlet-body">
                    <div class="m-portlet__body m-portlet__body--table m-portlet__body--serial-no">
                        <div class="m-subheader">
                            <div class="d-flex align-items-center">
                                <h3 class="section-title section-title--small">
                                    Society Details:
                                </h3>
                            </div>

                            <div class="row field-row">
                                <div class="col-sm-6 field-col">
                                    <div class="d-flex">
                                        <span class="field-name">Application Number:</span>
                                        <span class="field-value">{{
                                            $arrData['society_detail']->application_no ?
                                            $arrData['society_detail']->application_no : '' }}</span>
                                    </div>
                                </div>
                                <div class="col-sm-6 field-col">
                                    <div class="d-flex">
                                        <span class="field-name">Application Date:</span>
                                        <span class="field-value">{{
                                            $arrData['society_detail']->submitted_at ?
                                            date(config('commanConfig.dateFormat'),
                                            strtotime($arrData['society_detail']->submitted_at)) : ''}}</span>
                                    </div>
                                </div>
                                <div class="col-sm-6 field-col">
                                    <div class="d-flex">
                                        <span class="field-name">Society Name:</span>
                                        <span class="field-value">{{
                                            $arrData['society_detail']->eeApplicationSociety->name }}</span>
                                    </div>
                                </div>
                                <div class="col-sm-6 field-col">
                                    <div class="d-flex">
                                        <span class="field-name">Society Address:</span>
                                        <span class="field-value">{{
                                            $arrData['society_detail']->eeApplicationSociety->address }}</span>
                                    </div>
                                </div>
                                <div class="col-sm-6 field-col">
                                    <div class="d-flex">
                                        <span class="field-name">Building Number:</span>
                                        <span class="field-value">{{
                                            $arrData['society_detail']->eeApplicationSociety->building_no
                                            }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="m-subheader">
                            <div class="d-flex align-items-center">
                                <h3 class="section-title section-title--small">
                                    Appointed Architect Details:
                                </h3>
                            </div>
                            <div class="row field-row">
                                <div class="col-sm-6 field-col">
                                    <div class="d-flex">
                                        <span class="field-name">Name of Architect:</span>
                                        <span class="field-value">{{
                                            $arrData['society_detail']->eeApplicationSociety->name_of_architect
                                            }}</span>
                                    </div>
                                </div>
                                <div class="col-sm-6 field-col">
                                    <div class="d-flex">
                                        <span class="field-name">Architect Mobile Number:</span>
                                        <span class="field-value">{{
                                            $arrData['society_detail']->eeApplicationSociety->architect_mobile_no
                                            }}</span>
                                    </div>
                                </div>
                                <div class="col-sm-6 field-col">
                                    <div class="d-flex">
                                        <span class="field-name">Architect Address:</span>
                                        <span class="field-value">{{
                                            $arrData['society_detail']->eeApplicationSociety->architect_address
                                            }}</span>
                                    </div>
                                </div>
                                <div class="col-sm-6 field-col">
                                    <div class="d-flex">
                                        <span class="field-name">Architect Telephone Number:</span>
                                        <span class="field-value">{{
                                            $arrData['society_detail']->eeApplicationSociety->architect_telephone_no
                                            }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-content">

                @php
                if(isset($arrData['get_last_status']) && ($arrData['get_last_status']->status_id ==
                config('commanConfig.applicationStatus.forwarded')))
                { $style = "display:none";
                $disabled='disabled';
                }elseif (session()->get('role_name') != config('commanConfig.ee_junior_engineer'))
                { $style = "display:none";
                $disabled='disabled';
                }else
                {
                $style = "";
                $disabled="";
                }
                @endphp
                <div class="panel active section-1" id="document-scrunity">
                    <div class="m-portlet m-portlet--tabs m-portlet--bordered-semi mb-0">
                        <div class="portlet-body">
                            <div class="m-portlet__body m-portlet__body--table m-portlet__body--serial-no m-portlet__body--serial-no-pdf">
                                <div class="m-subheader">
                                    <div class="d-flex align-items-center">
                                        <h3 class="section-title section-title--small">
                                            Document Scrutiny Sheet:
                                        </h3>
                                    </div>
                                </div>
                                <div class="m-section__content mb-0 table-responsive">
                                    <table class="table mb-0">
                                        <thead class="thead-default">
                                            <th class="table-data--xs">#</th>
                                            <th>तपशील</th>
                                            <th class="table-data--xs">सोसायटी दस्तावेज</th>
                                            <th class="table-data--lg">टिप्पणी</th>
                                            <th class="table-data--xs">दस्तावेज</th>
                                        </thead>
                                        <tbody>
                                            @php
                                            $i = 1;
                                            @endphp
                                            @foreach($arrData['society_document'] as $document)
                                            <tr>
                                                <td>{{ $i }}.</td>
                                                <td>{{ $document->name }}</td>
                                                @php
                                                $path =
                                                $arrData['society_document_data'][$document->id]['society_document_path'];

                                                @endphp
                                                <td class="text-center"><a download href="{{ asset($path) }}"><img
                                                            class="pdf-icon" src="{{ asset('/img/pdf-icon.svg')}}"></a></td>
                                                <td>
                                                    @php
                                                    if(array_key_exists($document->id,
                                                    $arrData['society_document_data']))
                                                    {
                                                    $comment_by_EE =
                                                    $arrData['society_document_data'][$document->id]['comment_by_EE'];
                                                    $document_status_id =
                                                    $arrData['society_document_data'][$document->id]['id'];

                                                    $ee_document =
                                                    $arrData['society_document_data'][$document->id]['EE_document_path'];
                                                    }
                                                    else
                                                    {
                                                    $comment_by_EE = '';
                                                    $ee_document = '';
                                                    }
                                                    @endphp
                                                    <p class="mb-2">{{ $comment_by_EE }}</p>
                                                    <div class="d-flex btn-list-inline-wrap">
                                                        @if($comment_by_EE && $ee_document)

                                                        <button class="btn btn-link btn-list-inline editDocumentStatus"
                                                            style="cursor: pointer; {{$style}}" data-toggle="modal"
                                                            data-id="{{ $i }}" data-documentStatusId={{ $document_status_id }}
                                                            data-target="#edit-remark-{{$i}}">Edit</button>

                                                        <button class="btn btn-link btn-list-inline deleteDocumentStatus"
                                                            style="cursor: pointer; {{$style}}" data-toggle="modal"
                                                            data-id="{{ $i }}" data-documentStatusId={{ $document_status_id }}
                                                            data-target="#delete-remark-{{$i}}">Delete</button>
                                                        @else
                                                        <button class="btn btn-link btn-list-inline" style="cursor: pointer;{{$style}}"
                                                            data-toggle="modal" data-target="#add-remark-{{$i}}">Add</button>
                                                        @endif

                                                        <div class="modal fade show" id="add-remark-{{$i}}" tabindex="-1"
                                                            role="dialog" aria-labelledby="exampleModalLabel">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">Add
                                                                            Remark</h5>
                                                                        <button style="cursor: pointer;" type="button"
                                                                            class="close" data-dismiss="modal"
                                                                            aria-label="Close">
                                                                            <span aria-hidden="true">×</span>
                                                                        </button>
                                                                    </div>
                                                                    <form class="" action="{{ route('ee-scrutiny-document') }}"
                                                                        method="post" enctype="multipart/form-data">
                                                                        @csrf

                                                                        @php
                                                                        if(array_key_exists($document->id,
                                                                        $arrData['society_document_data']))
                                                                        {
                                                                        $document_status_id =
                                                                        $arrData['society_document_data'][$document->id]['id'];
                                                                        }
                                                                        else
                                                                        {
                                                                        $document_status_id = '';
                                                                        }
                                                                        @endphp

                                                                        <input type="hidden" name="document_status_id"
                                                                            value="{{ $document_status_id }}">
                                                                        <div class="modal-body table--box-input">
                                                                            <div class="mb-4">
                                                                                <label for="remark">Remark:</label>
                                                                                <textarea class="form-control form-control--custom"
                                                                                    name="remark" id="remark_{{ $i }}"
                                                                                    cols="30" rows="5"></textarea>
                                                                            </div>
                                                                            <div class="custom-file">
                                                                                <input class="custom-file-input" name="EE_document_path"
                                                                                    type="file" id="EE_document_path_{{ $i }}"
                                                                                    required="">
                                                                                <label class="custom-file-label" for="EE_document_path_{{ $i }}">Choose
                                                                                    file...</label>
                                                                            </div>
                                                                            <span class="text-danger" id="file_error_{{ $i }}">
                                                                            </span>
                                                                            {{--<div class="mt-auto">
                                                                                <button type="submit" id="btn_{{ $i }}"
                                                                                    class="btn btn-primary btn-custom"
                                                                                    id="uploadBtn">Upload</button>
                                                                            </div>--}}
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="submit" class="btn btn-primary submt_btn"
                                                                                id="submitBtn_{{ $i }}">Save</button>
                                                                            <button type="button" class="btn btn-secondary"
                                                                                data-dismiss="modal">Cancel</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal fade show" id="edit-remark-{{$i}}" tabindex="-1"
                                                            role="dialog" aria-labelledby="exampleModalLabel">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">Edit
                                                                            Remark</h5>
                                                                        <button style="cursor: pointer;" type="button"
                                                                            class="close" data-dismiss="modal"
                                                                            aria-label="Close">
                                                                            <span aria-hidden="true">×</span>
                                                                        </button>
                                                                    </div>
                                                                    <form class="" action="{{ route('edit-ee-scrutiny-document', $arrData['society_document_data'][$document->id]['id']) }}"
                                                                        method="post" enctype="multipart/form-data">
                                                                        @csrf
                                                                        <input type="hidden" name="oldFileName" id="oldFileName_{{ $i }}">
                                                                        <div class="modal-body">
                                                                            <div class="mb-4">
                                                                                <label for="remark">Remark:</label>
                                                                                <textarea class="form-control form-control--custom"
                                                                                    name="comment_by_EE" id="comment_by_EE_{{ $i }}"
                                                                                    cols="30" rows="5"></textarea>
                                                                            </div>

                                                                            <div class="custom-file">
                                                                                <input class="custom-file-input" name="EE_document"
                                                                                    type="file" id="EE_document_{{ $i }}"
                                                                                    required="">
                                                                                <label class="custom-file-label" for="EE_document_{{ $i }}">Choose
                                                                                    file...</label>
                                                                            </div>

                                                                            <span class="text-danger" id="edit_file_error_{{ $i }}"></span>
                                                                            {{--<div class="mt-auto">
                                                                                <button type="submit" class="btn btn-primary btn-custom"
                                                                                    id="uploadBtn">Upload</button>
                                                                            </div>--}}
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="submit" class="btn btn-primary edit_btn"
                                                                                id="editBtn_{{ $i }}">Save</button>
                                                                            <button type="button" class="btn btn-secondary"
                                                                                data-dismiss="modal">Cancel</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal fade show" id="delete-remark-{{$i}}" tabindex="-1"
                                                            role="dialog" aria-labelledby="exampleModalLabel">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel2">Delete
                                                                            Remark</h5>
                                                                        <button style="cursor: pointer;" type="button"
                                                                            class="close" data-dismiss="modal"
                                                                            aria-label="Close">
                                                                            <span aria-hidden="true">×</span>
                                                                        </button>
                                                                    </div>
                                                                    <form class="" action="{{ route('ee-document-scrutiny-delete', $arrData['society_document_data'][$document->id]['id']) }}"
                                                                        method="post" enctype="multipart/form-data">
                                                                        @csrf
                                                                        <input type="hidden" name="fileName" id="fileName_{{ $i }}">
                                                                        <div class="modal-body">
                                                                            <div class="mb-4">
                                                                                <label for="remark">Remark:</label>
                                                                                <textarea class="form-control form-control--custom"
                                                                                    name="remark" id="remark_by_ee_{{ $i }}"
                                                                                    cols="30" rows="5"></textarea>
                                                                            </div>
                                                                            {{--<div class="mt-auto">
                                                                                <button type="submit" class="btn btn-primary btn-custom"
                                                                                    id="uploadBtn2">Upload</button>
                                                                            </div>--}}
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="submit" class="btn btn-primary">Save</button>
                                                                            <button type="button" class="btn btn-secondary"
                                                                                data-dismiss="modal">Cancel</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>

                                                @if(!empty($ee_document))

                                                <td class="text-center"><a download href="{{config('commanConfig.storage_server').'/'.$ee_document}}"><img
                                                            class="pdf-icon" src="{{ asset('/img/pdf-icon.svg')}}"></a></td>
                                                @else
                                                <td></td>
                                                @endif
                                            </tr>

                                            @php
                                            $i++;
                                            @endphp
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="panel section-2" id="checklist-scrunity">
                    <ul id="scrunity-tabs" class="nav nav-pills nav-justified" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active show nested_t" data-toggle="pill" href="#verification" id="nested_tab_1">
                                Consent Verification</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link nested_t" data-toggle="pill" href="#demarcation" id="nested_tab_2">
                                Demarcation</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link nested_t" data-toggle="pill" href="#tit-bit" id="nested_tab_3">
                                Tit-Bit</a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link nested_t" data-toggle="pill" href="#relocation" id="nested_tab_4">
                                R.G. Relocation</a>
                        </li>
                    </ul>
                    <div class="m-portlet m-portlet--no-top-shadow">
                        <div class="tab-content">
                            <div class="tab-pane active nested_tab_1" id="verification">
                                <form class="form--custom" action="{{ route('consent-verfication') }}" method="post">
                                    @csrf
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group row">
                                                <div class="col-sm-4 d-flex align-items-center">
                                                    <label for="name">संस्थेचे नाव:</label>
                                                </div>
                                                <div class="col-sm-8">
                                                    <input type="text" value="{{ $arrData['society_detail']->eeApplicationSociety->name }}"
                                                        class="form-control form-control--custom" disabled id="name">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group row">
                                                <div class="col-sm-4 d-flex align-items-center">
                                                    <label for="building-no">इमारत क्र:</label>
                                                </div>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control form-control--custom"
                                                        disabled value="{{ $arrData['society_detail']->eeApplicationSociety->building_no }}"
                                                        id="building-no" placeholder="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group row">
                                                <div class="col-sm-4 d-flex align-items-center">
                                                    <label for="name">अभिन्यास (Layout):</label>
                                                </div>
                                                <div class="col-sm-8">
                                                    <input type="text" {{$disabled}} class="form-control form-control--custom"
                                                        name="layout" id="name" value="{{ isset($arrData['consent_verification_checkist_data']) ? $arrData['consent_verification_checkist_data']->layout : ''}}"
                                                        required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group row">
                                                <div class="col-sm-4 d-flex align-items-center">
                                                    <label for="notice_detail">नोटीस चा तपशील:</label>
                                                </div>
                                                <div class="col-sm-8">
                                                    <input {{$disabled}} type="text" class="form-control form-control--custom"
                                                        value="{{ isset($arrData['consent_verification_checkist_data']) ? $arrData['consent_verification_checkist_data']->details_of_notice : '' }}"
                                                        name="details_of_notice" id="notice_detail" placeholder=""
                                                        required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group row">
                                                <div class="col-sm-4 d-flex align-items-center">
                                                    <label for="investigation_officer">तपासणी अधिकाऱ्यांचे
                                                        नाव:</label>
                                                </div>
                                                <div class="col-sm-8">
                                                    <input {{$disabled}} type="text" class="form-control form-control--custom"
                                                        value="{{ isset($arrData['consent_verification_checkist_data']) ? $arrData['consent_verification_checkist_data']->investigation_officer_name : ''}}"
                                                        name="investigation_officer_name" id="investigation_officer"
                                                        required>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="scrunity-check-date" class="col-sm-6">
                                            <div class="form-group row">
                                                <div class="col-sm-4 d-flex align-items-center">
                                                    <label for="m_datepicker">तपासणी दिनांक:</label>
                                                </div>
                                                <div class="col-sm-8">
                                                    <input {{$disabled}} type="text" class="form-control form-control--custom m_datepicker"
                                                        value="{{isset($arrData['consent_verification_checkist_data']) ? $arrData['consent_verification_checkist_data']->date_of_investigation : '' }}"
                                                        name="date_of_investigation" required placeholder="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="table-checklist m-portlet__body m-portlet__body--table table--box-input">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead class="thead-default">
                                                    <th>#</th>
                                                    <th class="table-data--xl">मुद्दा / तपशील</th>
                                                    <th>होय</th>
                                                    <th>नाही</th>
                                                    <th>शेरा</th>
                                                </thead>
                                                <tbody>
                                                    @php
                                                    $i = 1;
                                                    @endphp

                                                    <input type="hidden" name="application_id" value="{{ $arrData['society_detail']->id }}">
                                                    @foreach($arrData['consent_verification_question'] as
                                                    $consent_question)
                                                    <input type="hidden" name="question_id[{{$i}}]" value="{{ $consent_question->id }}">
                                                    <tr>
                                                        <td>{{ $i }}.</td>
                                                        <td>{{ $consent_question->question }}</td>
                                                        <td>
                                                            <label class="m-radio m-radio--primary">
                                                                <input {{$disabled}} type="radio" name="answer[{{$i}}]"
                                                                    value="1"
                                                                    {{ (isset($arrData['consent_verification_details_data'][$consent_question->id]) && $arrData['consent_verification_details_data'][$consent_question->id]['answer'] == 1) ? 'checked' : '' }}>
                                                                <span></span>
                                                            </label>
                                                        </td>
                                                        @php
                                                        if(isset($arrData['consent_verification_details_data'][$consent_question->id]['answer'])
                                                        &&
                                                        $arrData['consent_verification_details_data'][$consent_question->id]['answer']
                                                        == 0)
                                                        {
                                                        $checked = 'checked';
                                                        }
                                                        else{
                                                        $checked = '';
                                                        }
                                                        @endphp
                                                        <td>
                                                            <label class="m-radio m-radio--primary">
                                                                <input {{$disabled}} type="radio" name="answer[{{$i}}]"
                                                                    value="0" {{ $checked }}>
                                                                <span></span>
                                                            </label></td>
                                                        <td>
                                                            <textarea {{$disabled}} class="form-control form-control--custom form-control--textarea"
                                                                name="remark[{{$i}}]" id="remark-one">{{ isset($arrData['consent_verification_details_data'][$consent_question->id]) ? $arrData['consent_verification_details_data'][$consent_question->id]['remark'] : '' }}</textarea>
                                                        </td>
                                                    </tr>
                                                    @php
                                                    $i++;
                                                    @endphp
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <button type="submit" style="{{ $style }}" class="btn btn-primary">Save</button>
                                </form>
                            </div>
                            <div class="tab-pane nested_tab_2" id="demarcation">
                                <form class="form--custom" action="{{ route('ee-demarcation') }}" method="post">
                                    @csrf
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group row">
                                                <div class="col-sm-4 d-flex align-items-center">
                                                    <label for="name">संस्थेचे नाव:</label>
                                                </div>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control form-control--custom"
                                                        disabled value="{{ $arrData['society_detail']->eeApplicationSociety->name }}"
                                                        id="name">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group row">
                                                <div class="col-sm-4 d-flex align-items-center">
                                                    <label for="building-no">इमारत क्र:</label>
                                                </div>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control form-control--custom"
                                                        disabled value="{{ $arrData['society_detail']->eeApplicationSociety->building_no }}"
                                                        id="building-no" placeholder="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group row">
                                                <div class="col-sm-4 d-flex align-items-center">
                                                    <label for="name">अभिन्यास (Layout):</label>
                                                </div>
                                                <div class="col-sm-8">
                                                    <input {{$disabled}} type="text" class="form-control form-control--custom"
                                                        required value="{{ isset($arrData['demarcation_checkist_data']) ? $arrData['demarcation_checkist_data']->layout : ''}}"
                                                        name="layout" id="name">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group row">
                                                <div class="col-sm-4 d-flex align-items-center">
                                                    <label for="building-no">नोटीस चा तपशील:</label>
                                                </div>
                                                <div class="col-sm-8">
                                                    <input {{$disabled}} type="text" class="form-control form-control--custom"
                                                        required value="{{ isset($arrData['demarcation_checkist_data']) ? $arrData['demarcation_checkist_data']->details_of_notice : '' }}"
                                                        name="details_of_notice" id="building-no" placeholder="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group row">
                                                <div class="col-sm-4 d-flex align-items-center">
                                                    <label for="name">तपासणी अधिकाऱ्यांचे नाव:</label>
                                                </div>
                                                <div class="col-sm-8">
                                                    <input {{$disabled}} type="text" class="form-control form-control--custom"
                                                        required value="{{ isset($arrData['demarcation_checkist_data']) ? $arrData['demarcation_checkist_data']->investigation_officer_name : ''}}"
                                                        name="investigation_officer_name" id="name">
                                                </div>
                                            </div>
                                        </div>
                                        <div id="scrunity-check-date" class="col-sm-6">
                                            <div class="form-group row">
                                                <div class="col-sm-4 d-flex align-items-center">
                                                    <label for="building-no">स्थळ पाहणी दिनांक:</label>
                                                </div>
                                                <div class="col-sm-8">
                                                    <input {{$disabled}} type="text" class="form-control form-control--custom m_datepicker"
                                                        required value="{{isset($arrData['demarcation_checkist_data']) ? $arrData['demarcation_checkist_data']->date_of_investigation : '' }}"
                                                        name="date_of_investigation" id="demarcation_date" placeholder="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="table-checklist m-portlet__body m-portlet__body--table table--box-input">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead class="thead-default">
                                                    <th>#</th>
                                                    <th class="table-data--xl">मुद्दा / तपशील</th>
                                                    <th>होय</th>
                                                    <th>नाही</th>
                                                    <th>शेरा</th>
                                                </thead>
                                                <tbody>
                                                    @php
                                                    $i = 1;
                                                    @endphp

                                                    <input type="hidden" name="application_id" value="{{ $arrData['society_detail']->id }}">
                                                    @foreach($arrData['demarcation_question'] as
                                                    $demarcation_question)
                                                    <input type="hidden" name="question_id[{{$i}}]" value="{{ $demarcation_question->id }}">
                                                    <tr>
                                                        <td>{{ $i }}.</td>
                                                        <td>{{ $demarcation_question->question }}</td>
                                                        <td>
                                                            <label class="m-radio m-radio--primary">
                                                                <input {{$disabled}} type="radio" name="answer[{{ $i }}]"
                                                                    value="1"
                                                                    {{ (isset($arrData['demarcation_details_data'][$demarcation_question->id]) && $arrData['demarcation_details_data'][$demarcation_question->id]['answer'] == 1) ? 'checked' : '' }}>
                                                                <span></span>
                                                            </label>
                                                        </td>
                                                        @php
                                                        if(isset($arrData['demarcation_details_data'][$demarcation_question->id]['answer'])
                                                        &&
                                                        $arrData['demarcation_details_data'][$demarcation_question->id]['answer']
                                                        == 0)
                                                        {
                                                        $checked_demarcation = 'checked';
                                                        }
                                                        else{
                                                        $checked_demarcation = '';
                                                        }
                                                        @endphp
                                                        <td>
                                                            <label class="m-radio m-radio--primary">
                                                                <input {{$disabled}} type="radio" name="answer[{{ $i }}]"
                                                                    value="0" {{ $checked_demarcation  }}>
                                                                <span></span>
                                                            </label></td>
                                                        <td>
                                                            <textarea class="form-control form-control--custom form-control--textarea"
                                                                name="remark[{{ $i }}]" {{$disabled}} id="remark-one">{{ isset($arrData['demarcation_details_data'][$demarcation_question->id]) ? $arrData['demarcation_details_data'][$demarcation_question->id]['remark'] : '' }}</textarea>
                                                        </td>
                                                    </tr>

                                                    @php
                                                    $i++;
                                                    @endphp
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <button type="submit" style="{{ $style }}" class="btn btn-primary">Save</button>
                                </form>
                            </div>
                            <div class="tab-pane nested_tab_3" id="tit-bit">
                                <form class="form--custom" action="{{ route('ee-tit-bit') }}" method="post">
                                    @csrf
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group row">
                                                <div class="col-sm-4 d-flex align-items-center">
                                                    <label for="name">संस्थेचे नाव:</label>
                                                </div>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control form-control--custom"
                                                        disabled value="{{ $arrData['society_detail']->eeApplicationSociety->name }}"
                                                        id="name">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group row">
                                                <div class="col-sm-4 d-flex align-items-center">
                                                    <label for="building-no">इमारत क्र:</label>
                                                </div>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control form-control--custom"
                                                        disabled value="{{ $arrData['society_detail']->eeApplicationSociety->building_no }}"
                                                        id="building-no" placeholder="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group row">
                                                <div class="col-sm-4 d-flex align-items-center">
                                                    <label for="name">अभिन्यास (Layout):</label>
                                                </div>
                                                <div class="col-sm-8">
                                                    <input {{$disabled}} type="text" class="form-control form-control--custom"
                                                        required value="{{ isset($arrData['tit_bit_checkist_data']) ? $arrData['tit_bit_checkist_data']->layout : ''}}"
                                                        name="layout" id="name">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group row">
                                                <div class="col-sm-4 d-flex align-items-center">
                                                    <label for="building-no">नोटीस चा तपशील:</label>
                                                </div>
                                                <div class="col-sm-8">
                                                    <input {{$disabled}} type="text" class="form-control form-control--custom"
                                                        required value="{{ isset($arrData['tit_bit_checkist_data']) ? $arrData['tit_bit_checkist_data']->details_of_notice : '' }}"
                                                        name="details_of_notice" id="building-no" placeholder="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group row">
                                                <div class="col-sm-4 d-flex align-items-center">
                                                    <label for="name">तपासणी अधिकाऱ्यांचे नाव:</label>
                                                </div>
                                                <div class="col-sm-8">
                                                    <input {{$disabled}} type="text" class="form-control form-control--custom"
                                                        required value="{{ isset($arrData['tit_bit_checkist_data']) ? $arrData['tit_bit_checkist_data']->investigation_officer_name : ''}}"
                                                        name="investigation_officer_name" id="name">
                                                </div>
                                            </div>
                                        </div>
                                        <div id="scrunity-check-date" class="col-sm-6">
                                            <div class="form-group row">
                                                <div class="col-sm-4 d-flex align-items-center">
                                                    <label for="building-no">स्थळ पाहणी दिनांक:</label>
                                                </div>
                                                <div class="col-sm-8">
                                                    <input {{$disabled}} type="text" class="form-control form-control--custom m_datepicker"
                                                        required value="{{isset($arrData['tit_bit_checkist_data']) ? $arrData['tit_bit_checkist_data']->date_of_investigation : '' }}"
                                                        name="date_of_investigation" id="tit_bit_date" placeholder="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="table-checklist m-portlet__body m-portlet__body--table table--box-input">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead class="thead-default">
                                                    <th>#</th>
                                                    <th class="table-data--xl">मुद्दा / तपशील</th>
                                                    <th>होय</th>
                                                    <th>नाही</th>
                                                    <th>शेरा</th>
                                                </thead>
                                                <tbody>
                                                    @php
                                                    $i = 1;
                                                    @endphp

                                                    <input type="hidden" name="application_id" value="{{ $arrData['society_detail']->id }}">

                                                    @foreach($arrData['tit_bit_question'] as $tit_bit)

                                                    <input type="hidden" name="question_id[{{$i}}]" value="{{ $tit_bit->id }}">
                                                    <tr>
                                                        <td>{{ $i }}.</td>
                                                        <td>{{ $tit_bit->question }}</td>
                                                        <td>
                                                            <label class="m-radio m-radio--primary">
                                                                <input {{$disabled}} type="radio" name="answer[{{ $i }}]"
                                                                    value="1"
                                                                    {{ (isset($arrData['tit_bit_details_data'][$tit_bit->id]) && $arrData['tit_bit_details_data'][$tit_bit->id]['answer'] == 1) ? 'checked' : '' }}>
                                                                <span></span>
                                                            </label>
                                                        </td>
                                                        @php
                                                        if(isset($arrData['tit_bit_details_data'][$tit_bit->id]['answer'])
                                                        &&
                                                        $arrData['tit_bit_details_data'][$tit_bit->id]['answer']
                                                        == 0)
                                                        {
                                                        $checked_tit_bit = 'checked';
                                                        }
                                                        else{
                                                        $checked_tit_bit = '';
                                                        }
                                                        @endphp
                                                        <td>
                                                            <label class="m-radio m-radio--primary">
                                                                <input {{$disabled}} type="radio" name="answer[{{ $i }}]"
                                                                    value="0" {{ $checked_tit_bit }}>
                                                                <span></span>
                                                            </label></td>
                                                        <td>
                                                            <textarea {{$disabled}} class="form-control form-control--custom form-control--textarea"
                                                                name="remark[{{ $i }}]" id="remark-one">{{ isset($arrData['tit_bit_details_data'][$tit_bit->id]) ? $arrData['tit_bit_details_data'][$tit_bit->id]['remark'] : '' }}</textarea>
                                                        </td>
                                                    </tr>
                                                    @php
                                                    $i++;
                                                    @endphp
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <button type="submit" style="{{ $style }}" class="btn btn-primary">Save</button>
                                </form>
                            </div>
                            <div class="tab-pane nested_tab_4" id="relocation">
                                <form class="form--custom" action="{{ route('ee-rg-relocation') }}" method="post">
                                    @csrf
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group row">
                                                <div class="col-sm-4 d-flex align-items-center">
                                                    <label for="name">संस्थेचे नाव:</label>
                                                </div>
                                                <div class="col-sm-8">
                                                    <input {{$disabled}} type="text" class="form-control form-control--custom"
                                                        disabled value="{{ $arrData['society_detail']->eeApplicationSociety->name }}"
                                                        id="name">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group row">
                                                <div class="col-sm-4 d-flex align-items-center">
                                                    <label for="building-no">इमारत क्र:</label>
                                                </div>
                                                <div class="col-sm-8">
                                                    <input {{$disabled}} type="text" class="form-control form-control--custom"
                                                        disabled value="{{ $arrData['society_detail']->eeApplicationSociety->building_no }}"
                                                        id="building-no" placeholder="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group row">
                                                <div class="col-sm-4 d-flex align-items-center">
                                                    <label for="name">अभिन्यास (Layout):</label>
                                                </div>
                                                <div class="col-sm-8">
                                                    <input {{$disabled}} type="text" class="form-control form-control--custom"
                                                        required value="{{ isset($arrData['rg_checkist_data']) ? $arrData['rg_checkist_data']->layout : ''}}"
                                                        name="layout" id="name">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group row">
                                                <div class="col-sm-4 d-flex align-items-center">
                                                    <label for="building-no">नोटीस चा तपशील:</label>
                                                </div>
                                                <div class="col-sm-8">
                                                    <input {{$disabled}} type="text" class="form-control form-control--custom"
                                                        name="details_of_notice" id="building-no" placeholder=""
                                                        required value="{{ isset($arrData['rg_checkist_data']) ? $arrData['rg_checkist_data']->details_of_notice : '' }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="table-checklist m-portlet__body m-portlet__body--table table--box-input">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead class="thead-default">
                                                    <th>#</th>
                                                    <th class="table-data--xl">मुद्दा / तपशील</th>
                                                    <th>होय</th>
                                                    <th>नाही</th>
                                                    <th>शेरा</th>
                                                </thead>
                                                <tbody>
                                                    @php
                                                    $i = 1;
                                                    @endphp

                                                    <input type="hidden" name="application_id" value="{{ $arrData['society_detail']->id }}">
                                                    @foreach($arrData['rg_question'] as $rg_question)
                                                    <input type="hidden" name="question_id[{{$i}}]" value="{{ $rg_question->id }}">
                                                    <tr>
                                                        <td>{{ $i }}.</td>
                                                        <td>{{ $rg_question->question }}</td>
                                                        <td>
                                                            <label class="m-radio m-radio--primary">
                                                                <input {{$disabled}} type="radio" name="answer[{{ $i }}]"
                                                                    value="1"
                                                                    {{ (isset($arrData['rg_details_data'][$rg_question->id]) && $arrData['rg_details_data'][$rg_question->id]['answer'] == 1) ? 'checked' : '' }}>
                                                                <span></span>
                                                            </label>
                                                        </td>
                                                        @php
                                                        if(isset($arrData['rg_details_data'][$rg_question->id]['answer'])
                                                        &&
                                                        $arrData['rg_details_data'][$rg_question->id]['answer']
                                                        == 0)
                                                        {
                                                        $checked_rg_location = 'checked';
                                                        }
                                                        else{
                                                        $checked_rg_location = '';
                                                        }
                                                        @endphp
                                                        <td>
                                                            <label class="m-radio m-radio--primary">
                                                                <input {{$disabled}} type="radio" name="answer[{{ $i }}]"
                                                                    value="0" {{ $checked_rg_location }}>
                                                                <span></span>
                                                            </label></td>
                                                        <td>
                                                            <textarea {{$disabled}} class="form-control form-control--custom form-control--textarea"
                                                                name="remark[{{ $i }}]" id="remark-one">{{ isset($arrData['rg_details_data'][$rg_question->id]) ? $arrData['rg_details_data'][$rg_question->id]['remark'] : '' }}</textarea>
                                                        </td>
                                                    </tr>
                                                    @php
                                                    $i++;
                                                    @endphp
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <button type="submit" style="{{ $style }}" class="btn btn-primary">Save</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- <div class="tab-pane" id="three" aria-expanded="false">
                                    three
                                </div> -->

                @php
                if(isset($arrData['get_last_status']) && ($arrData['get_last_status']->status_id ==
                config('commanConfig.applicationStatus.forwarded')))
                $display = "display:none";
                elseif (session()->get('role_name') != config('commanConfig.ee_junior_engineer'))
                $display = "display:none";
                else
                $display = "";
                @endphp
                <div class="panel section-3" id="ee-note">
                    <div class="m-portlet m-portlet--tabs m-portlet--bordered-semi mb-0 m-portlet--shadow">
                        <div class="portlet-body">
                            <div class="m-portlet__body m-portlet__body--table">
                                <div class="m-subheader" style="padding: 0;">
                                    <div class="d-flex align-items-center justify-content-center">
                                        <h3 class="section-title">
                                            Note
                                        </h3>
                                    </div>
                                </div>
                                <div class="m-section__content mb-0 table-responsive">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="d-flex flex-column h-100 two-cols">
                                                    <h5>Download Note</h5>
                                                    <span class="hint-text">Download EE Note uploaded by
                                                        EE</span>
                                                    <div class="mt-auto">

                                                        @if(isset($arrData['eeNote']->document_path))

                                                        <a download href="{{ config('commanConfig.storage_server').'/'.$arrData['eeNote']->document_path}} ">
                                                            <button class="btn btn-primary">

                                                                Download</button>
                                                        </a>
                                                        @else
                                                        <span class="error" style="display: block;color: #ce2323;margin-bottom: 17px;">
                                                            * Note : EE note not available. </span>
                                                        @endif



                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 border-left" style="{{ $display }}">
                                                <div class="d-flex flex-column h-100 two-cols">
                                                    <h5>Upload Note</h5>
                                                    <span class="hint-text">Click on 'Upload' to upload EE
                                                        -
                                                        Note</span>
                                                    <form action="{{ route('ee.upload_ee_note') }}" method="post"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        <input type="hidden" name="application_id" value="{{ $arrData['society_detail']->id }}">
                                                        <div class="custom-file">
                                                            <input class="custom-file-input" name="ee_note" type="file"
                                                                id="test-upload" required="">
                                                            <label class="custom-file-label" for="test-upload">Choose
                                                                file...</label>
                                                        </div>
                                                        <span class="text-danger" id="file_error"></span>
                                                        <div class="mt-auto">
                                                            <button type="submit" style="{{ $style }}" class="btn btn-primary btn-custom upload_note"
                                                                id="uploadBtn">Upload</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="hidden" id="hiddenPart" value="0">
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js"></script>
<script>
    $(".editDocumentStatus, .deleteDocumentStatus").on("click", function () {
        var documentstatusid = $(this).attr('data-documentstatusid');
        var id = $(this).attr('data-id');
        $.ajax({
            type: "POST",
            url: "{{ route('get-ee-scrutiny-data') }}",
            data: {
                "_token": "{{ csrf_token() }}",
                "documentStatusId": documentstatusid,
            },
            cache: false,
            success: function (res) {
                $("#comment_by_EE_" + id).val(res.comment_by_EE);
                $("#oldFileName_" + id).val(res.EE_document_path);

                $("#fileName_" + id).val(res.EE_document_path);
            }
        });
    });

    //        $("#demarcation_date, #tit_bit_date").datepicker();

    $(".submt_btn").click(function () {
        var id = this.id.substr(10, 2);
        console.log(id);
        myfile = $("#EE_document_path_" + id).val();
        var ext = myfile.split('.').pop();
        console.log(ext);
        if (myfile != '') {
            if (ext != "pdf") {
                $("#file_error_" + id).text("Invalid type of file uploaded (only pdf allowed).");
                return false;
            } else {
                $("#file_error_" + id).text("");
                return true;
            }
        } else {
            $("#file_error_" + id).text("This field required");
            return false;
        }
    });

    $(".edit_btn").click(function () {
        var id = this.id.substr(8, 2);
        console.log(id);
        myfile = $("#EE_document_" + id).val();
        var ext = myfile.split('.').pop();

        if (myfile != '') {
            if (ext != "pdf") {
                $("#edit_file_error_" + id).text("Invalid type of file uploaded (only pdf allowed).");
                return false;
            } else {
                $("#edit_file_error_" + id).text("");
                return true;
            }
        } else {
            $("#edit_file_error_" + id).text("This field required");
            return false;
        }
    });

    $(".upload_note").click(function () {
        myfile = $("#test-upload").val();
        var ext = myfile.split('.').pop();
        if (myfile != '') {

            if (ext != "pdf") {
                $("#file_error").text("Invalid type of file uploaded (only pdf allowed).");
                return false;
            } else {
                $("#file_error").text("");
                return true;
            }
        } else {
            $("#file_error").text("This field required");
            return false;
        }
    });

    var link = 0;
    $(document).ready(function () {
        $(".display_msg").delay("slow").slideUp("slow");

        var id = Cookies.get('sectionId');
        if (id != undefined) {
            $(".panel").removeClass('active');
            $(".m-tabs__item").removeClass('active');
            $("#" + id).addClass('active');
            $("." + id).addClass('active');
        }
        //nested tabs
        var nestedTab = Cookies.get('nestedTab');

        if (id != undefined) {
            $(".nested_t").removeClass('active');
            $("#" + nestedTab).addClass('active');
            $(".tab-pane").removeClass('active');
            $("." + nestedTab).addClass('active');
        }
    });

    $(".ee_tabs").on('click', function () {
        $("#hiddenPart").val("1");
        $(".nav-item").removeClass('active');
        Cookies.set('sectionId', this.id);
    });

    $(".nested_t").on('click', function () {
        $("#hiddenPart").val("1");
        Cookies.set('nestedTab', this.id);
    });

</script>
@endsection
