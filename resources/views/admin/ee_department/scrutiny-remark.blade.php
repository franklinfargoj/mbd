@extends('admin.layouts.app')
@section('content')

    <div class="custom-wrapper">
        <div class="col-md-12">
            <div id="tabbed-content" class="">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-tools">
                        <ul id="top-tabs" class="nav nav-tabs m-tabs-line m-tabs-line--primary m-tabs-line--2x nav-tabs--custom tabs">
                            <li class="nav-item m-tabs__item active" data-target="#document-scrunity">
                                <a class="nav-link m-tabs__link">
                                    <i class="la la-cog"></i> Document Scrutiny
                                </a>
                            </li>
                            <li class="nav-item m-tabs__item" data-target="#checklist-scrunity">
                                <a class="nav-link m-tabs__link">
                                    <i class="la la-cog"></i> Checklist Scrutiny
                                </a>
                            </li>
                            <li class="nav-item m-tabs__item" data-target="#ee-note">
                                <a class="nav-link m-tabs__link">
                                    <i class="la la-cog"></i> EE Note
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="m-grid__item m-grid__item--fluid m-wrapper">
                    <div class="row">
                        <div class="col-md-12">
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
                                                        <span class="field-value">{{ $arrData['society_detail']->application_no ? $arrData['society_detail']->application_no : '' }}</span>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 field-col">
                                                    <div class="d-flex">
                                                        <span class="field-name">Application Date:</span>
                                                        <span class="field-value">{{ $arrData['society_detail']->submitted_at ? date(config('commanConfig.dateFormat'), strtotime($arrData['society_detail']->submitted_at)) : ''}}</span>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 field-col">
                                                    <div class="d-flex">
                                                        <span class="field-name">Society Name:</span>
                                                        <span class="field-value">{{ $arrData['society_detail']->eeApplicationSociety->name }}</span>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 field-col">
                                                    <div class="d-flex">
                                                        <span class="field-name">Society Address:</span>
                                                        <span class="field-value">{{ $arrData['society_detail']->eeApplicationSociety->address }}</span>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 field-col">
                                                    <div class="d-flex">
                                                        <span class="field-name">Building Number:</span>
                                                        <span class="field-value">{{ $arrData['society_detail']->eeApplicationSociety->building_no }}</span>
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
                                                        <span class="field-value">{{ $arrData['society_detail']->eeApplicationSociety->name_of_architect }}</span>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 field-col">
                                                    <div class="d-flex">
                                                        <span class="field-name">Architect Mobile Number:</span>
                                                        <span class="field-value">{{ $arrData['society_detail']->eeApplicationSociety->architect_mobile_no }}</span>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 field-col">
                                                    <div class="d-flex">
                                                        <span class="field-name">Architect Address:</span>
                                                        <span class="field-value">{{ $arrData['society_detail']->eeApplicationSociety->architect_address }}</span>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 field-col">
                                                    <div class="d-flex">
                                                        <span class="field-name">Architect Telephone Number:</span>
                                                        <span class="field-value">{{ $arrData['society_detail']->eeApplicationSociety->architect_telephone_no }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-content">

                                @php
                                    if(isset($arrData['get_last_status']) && ($arrData['get_last_status']->status_id == config('commanConfig.applicationStatus.forwarded')))
                                        $style = "display:none";
                                    else
                                        $style = "";
                                @endphp
                                <div class="panel active" id="document-scrunity">
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
                                                                    $path = $arrData['society_document_data'][$document->id]['society_document_path'];

                                                                @endphp
                                                                <td class="text-center"><a download href="{{ asset($path) }}"><img class="pdf-icon" src="{{ asset('/img/pdf-icon.svg')}}"></a></td>
                                                                <td>
                                                                    @php
                                                                        if(array_key_exists($document->id, $arrData['society_document_data']))
                                                                        {
                                                                            $comment_by_EE = $arrData['society_document_data'][$document->id]['comment_by_EE'];
                                                                            $document_status_id = $arrData['society_document_data'][$document->id]['id'];
                                                                            $ee_document = $arrData['society_document_data'][$document->id]['EE_document_path'];
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

                                                                            <button class="btn btn-link btn-list-inline editDocumentStatus" style="cursor: pointer; {{$style}}"
                                                                                    data-toggle="modal" data-id="{{ $i }}" data-documentStatusId={{ $document_status_id }} data-target="#edit-remark-{{$i}}">Edit</button>

                                                                            <button class="btn btn-link btn-list-inline deleteDocumentStatus" style="cursor: pointer; {{$style}}"
                                                                                    data-toggle="modal" data-id="{{ $i }}" data-documentStatusId={{ $document_status_id }} data-target="#delete-remark-{{$i}}">Delete</button>
                                                                        @else
                                                                            <button class="btn btn-link btn-list-inline" style="cursor: pointer;{{$style}}"
                                                                                    data-toggle="modal" data-target="#add-remark-{{$i}}">Add</button>
                                                                        @endif

                                                                        <div class="modal fade show" id="add-remark-{{$i}}" tabindex="-1" role="dialog"
                                                                             aria-labelledby="exampleModalLabel">
                                                                            <div class="modal-dialog" role="document">
                                                                                <div class="modal-content">
                                                                                    <div class="modal-header">
                                                                                        <h5 class="modal-title" id="exampleModalLabel">Add
                                                                                            Remark</h5>
                                                                                        <button style="cursor: pointer;" type="button" class="close"
                                                                                                data-dismiss="modal" aria-label="Close">
                                                                                            <span aria-hidden="true">×</span>
                                                                                        </button>
                                                                                    </div>
                                                                                    <form class="" action="{{ route('ee-scrutiny-document') }}" method="post" enctype="multipart/form-data">
                                                                                        @csrf

                                                                                        @php
                                                                                            if(array_key_exists($document->id, $arrData['society_document_data']))
                                                                                            {
                                                                                                $document_status_id = $arrData['society_document_data'][$document->id]['id'];
                                                                                            }
                                                                                            else
                                                                                            {
                                                                                                $document_status_id = '';
                                                                                            }
                                                                                        @endphp

                                                                                        <input type="hidden" name="document_status_id" value="{{ $document_status_id }}">
                                                                                        <div class="modal-body">
                                                                                            <div class="mb-4">
                                                                                                <label for="remark">Remark:</label>
                                                                                                <textarea class="form-control form-control--custom"
                                                                                                          name="remark" id="remark_{{ $i }}" cols="30" rows="5"></textarea>
                                                                                            </div>
                                                                                            <div class="custom-file">
                                                                                                <input class="custom-file-input" name="EE_document_path" type="file"
                                                                                                       id="EE_document_path_{{ $i }}" required="">
                                                                                                <label class="custom-file-label" for="EE_document_path_{{ $i }}">Choose
                                                                                                    file...</label>
                                                                                            </div>
                                                                                            {{--<div class="mt-auto">
                                                                                                <button type="submit" class="btn btn-primary btn-custom"
                                                                                                        id="uploadBtn">Upload</button>
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
                                                                        <div class="modal fade show" id="edit-remark-{{$i}}" tabindex="-1" role="dialog"
                                                                                 aria-labelledby="exampleModalLabel">
                                                                                <div class="modal-dialog" role="document">
                                                                                    <div class="modal-content">
                                                                                        <div class="modal-header">
                                                                                            <h5 class="modal-title" id="exampleModalLabel">Edit
                                                                                                Remark</h5>
                                                                                            <button style="cursor: pointer;" type="button" class="close"
                                                                                                    data-dismiss="modal" aria-label="Close">
                                                                                                <span aria-hidden="true">×</span>
                                                                                            </button>
                                                                                        </div>
                                                                                        <form class="" action="{{ route('edit-ee-scrutiny-document', $arrData['society_document_data'][$document->id]['id']) }}" method="post" enctype="multipart/form-data">
                                                                                            @csrf
                                                                                            <input type="hidden" name="oldFileName" id="oldFileName_{{ $i }}">
                                                                                            <div class="modal-body">
                                                                                                <div class="mb-4">
                                                                                                    <label for="remark">Remark:</label>
                                                                                                    <textarea class="form-control form-control--custom"
                                                                                                              name="comment_by_EE" id="comment_by_EE_{{ $i }}" cols="30" rows="5"></textarea>
                                                                                                </div>
                                                                                                <div class="custom-file">
                                                                                                    <input class="custom-file-input" name="EE_document" type="file"
                                                                                                           id="EE_document_{{ $i }}">
                                                                                                    <label class="custom-file-label" for="EE_document_{{ $i }}">Choose
                                                                                                        file...</label>
                                                                                                </div>
                                                                                                {{--<div class="mt-auto">
                                                                                                    <button type="submit" class="btn btn-primary btn-custom"
                                                                                                            id="uploadBtn">Upload</button>
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
                                                                        <div class="modal fade show" id="delete-remark-{{$i}}" tabindex="-1" role="dialog"
                                                                             aria-labelledby="exampleModalLabel">
                                                                            <div class="modal-dialog" role="document">
                                                                                <div class="modal-content">
                                                                                    <div class="modal-header">
                                                                                        <h5 class="modal-title" id="exampleModalLabel2">Delete
                                                                                            Remark</h5>
                                                                                        <button style="cursor: pointer;" type="button" class="close"
                                                                                                data-dismiss="modal" aria-label="Close">
                                                                                            <span aria-hidden="true">×</span>
                                                                                        </button>
                                                                                    </div>
                                                                                    <form class="" action="{{ route('ee-document-scrutiny-delete', $arrData['society_document_data'][$document->id]['id']) }}" method="post" enctype="multipart/form-data">
                                                                                        @csrf
                                                                                        <input type="hidden" name="fileName" id="fileName_{{ $i }}">
                                                                                        <div class="modal-body">
                                                                                            <div class="mb-4">
                                                                                                <label for="remark">Remark:</label>
                                                                                                <textarea class="form-control form-control--custom"
                                                                                                          name="remark" id="remark_by_ee_{{ $i }}" cols="30" rows="5"></textarea>
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
                                                                    <td class="text-center"><a download href="{{ asset($ee_document) }}"><img class="pdf-icon" src="{{ asset('/img/pdf-icon.svg')}}"></a></td>
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

                                <div class="panel" id="checklist-scrunity">
                                    <div class="m-portlet">
                                        <div class="tab-pane--nested-tabs__inner">
                                            <div>
                                                <ul id="scrunity-tabs" class="nav nav-pills nav-justified" role="tablist">
                                                    <li class="nav-item">
                                                        <a class="nav-link active show" data-toggle="pill" href="#verification">
                                                            Consent Verification</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" data-toggle="pill" href="#demarcation">
                                                            Demarcation</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" data-toggle="pill" href="#tit-bit">
                                                            Tit-Bit</a>
                                                    </li>
                                                    <li class="nav-item ">
                                                        <a class="nav-link" data-toggle="pill" href="#relocation">
                                                            R.G. Relocation</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="verification">
                                                <form class="form--custom" action="{{ route('consent-verfication') }}" method="post">
                                                    @csrf
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <div class="form-group row">
                                                                <div class="col-sm-4 d-flex align-items-center">
                                                                    <label for="name">संस्थेचे नाव:</label>
                                                                </div>
                                                                <div class="col-sm-8">
                                                                    <input type="text" value="{{ $arrData['society_detail']->eeApplicationSociety->name }}" class="form-control form-control--custom"
                                                                          disabled id="name">
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
                                                                         disabled value="{{ $arrData['society_detail']->eeApplicationSociety->building_no }}"  id="building-no" placeholder="">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group row">
                                                                <div class="col-sm-4 d-flex align-items-center">
                                                                    <label for="name">अभिन्यास (Layout):</label>
                                                                </div>
                                                                <div class="col-sm-8">
                                                                    <input type="text" class="form-control form-control--custom" name="layout" id="name" value="{{ isset($arrData['consent_verification_checkist_data']) ? $arrData['consent_verification_checkist_data']->layout : ''}}" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group row">
                                                                <div class="col-sm-4 d-flex align-items-center">
                                                                    <label for="notice_detail">नोटीस चा तपशील:</label>
                                                                </div>
                                                                <div class="col-sm-8">
                                                                    <input type="text" class="form-control form-control--custom" value="{{ isset($arrData['consent_verification_checkist_data']) ? $arrData['consent_verification_checkist_data']->details_of_notice : '' }}"
                                                                           name="details_of_notice" id="notice_detail" placeholder="" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group row">
                                                                <div class="col-sm-4 d-flex align-items-center">
                                                                    <label for="investigation_officer">तपासणी अधिकाऱ्यांचे नाव:</label>
                                                                </div>
                                                                <div class="col-sm-8">
                                                                    <input type="text" class="form-control form-control--custom" value="{{ isset($arrData['consent_verification_checkist_data']) ? $arrData['consent_verification_checkist_data']->investigation_officer_name : ''}}"
                                                                           name="investigation_officer_name" id="investigation_officer" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div id="scrunity-check-date" class="col-sm-6">
                                                            <div class="form-group row">
                                                                <div class="col-sm-4 d-flex align-items-center">
                                                                    <label for="m_datepicker">तपासणी दिनांक:</label>
                                                                </div>
                                                                <div class="col-sm-8">
                                                                    <input type="text" class="form-control form-control--custom" value="{{isset($arrData['consent_verification_checkist_data']) ? $arrData['consent_verification_checkist_data']->date_of_investigation : '' }}"
                                                                           name="date_of_investigation" id="m_datepicker" required placeholder="">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="table-checklist m-portlet__body m-portlet__body--table">
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
                                                                @foreach($arrData['consent_verification_question'] as $consent_question)
                                                                    <input type="hidden" name="question_id[{{$i}}]" value="{{ $consent_question->id }}">
                                                                    <tr>
                                                                        <td>{{ $i }}.</td>
                                                                        <td>{{ $consent_question->question }}</td>
                                                                        <td>
                                                                            <label class="m-radio m-radio--primary">
                                                                                <input type="radio" name="answer[{{$i}}]" value="1" {{ (isset($arrData['consent_verification_details_data'][$consent_question->id]) && $arrData['consent_verification_details_data'][$consent_question->id]['answer'] == 1) ? 'checked' : 'checked' }}>
                                                                                <span></span>
                                                                            </label>
                                                                        </td>
                                                                        <td>
                                                                            <label class="m-radio m-radio--primary">
                                                                                <input type="radio" name="answer[{{$i}}]" value="0" {{ (isset($arrData['consent_verification_details_data'][$consent_question->id]) && $arrData['consent_verification_details_data'][$consent_question->id]['answer'] == 0) ? 'checked' : '' }}>
                                                                                <span></span>
                                                                            </label></td>
                                                                        <td>
                                                                            <textarea class="form-control form-control--custom form-control--textarea"
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
                                            <div class="tab-pane" id="demarcation">
                                                <form class="form--custom" action="{{ route('ee-demarcation') }}" method="post">
                                                    @csrf
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <div class="form-group row">
                                                                <div class="col-sm-4 d-flex align-items-center">
                                                                    <label for="name">संस्थेचे नाव:</label>
                                                                </div>
                                                                <div class="col-sm-8">
                                                                    <input type="text" class="form-control form-control--custom" disabled value="{{ $arrData['society_detail']->eeApplicationSociety->name }}"
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
                                                                    <input type="text" class="form-control form-control--custom" disabled value="{{ $arrData['society_detail']->eeApplicationSociety->building_no }}"
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
                                                                    <input type="text" class="form-control form-control--custom" required value="{{ isset($arrData['demarcation_checkist_data']) ? $arrData['demarcation_checkist_data']->layout : ''}}"
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
                                                                    <input type="text" class="form-control form-control--custom" required value="{{ isset($arrData['demarcation_checkist_data']) ? $arrData['demarcation_checkist_data']->details_of_notice : '' }}"
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
                                                                    <input type="text" class="form-control form-control--custom" required value="{{ isset($arrData['demarcation_checkist_data']) ? $arrData['demarcation_checkist_data']->investigation_officer_name : ''}}"
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
                                                                    <input type="text" class="form-control form-control--custom" required value="{{isset($arrData['demarcation_checkist_data']) ? $arrData['demarcation_checkist_data']->date_of_investigation : '' }}"
                                                                          name="date_of_investigation" id="demarcation_date" placeholder="">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="table-checklist m-portlet__body m-portlet__body--table">
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
                                                                @foreach($arrData['demarcation_question'] as $demarcation_question)
                                                                    <input type="hidden" name="question_id[{{$i}}]" value="{{ $demarcation_question->id }}">
                                                                    <tr>
                                                                        <td>{{ $i }}.</td>
                                                                        <td>{{ $demarcation_question->question }}</td>
                                                                        <td>
                                                                            <label class="m-radio m-radio--primary">
                                                                                <input type="radio" name="answer[{{ $i }}]" value="1" {{ (isset($arrData['demarcation_details_data'][$demarcation_question->id]) && $arrData['demarcation_details_data'][$demarcation_question->id]['answer'] == 1) ? 'checked' : 'checked' }}>
                                                                                <span></span>
                                                                            </label>
                                                                        </td>
                                                                        <td>
                                                                            <label class="m-radio m-radio--primary">
                                                                                <input type="radio" name="answer[{{ $i }}]" value="0" {{ (isset($arrData['demarcation_details_data'][$demarcation_question->id]) && $arrData['demarcation_details_data'][$demarcation_question->id]['answer'] == 1) ? 'checked' : '' }}>
                                                                                <span></span>
                                                                            </label></td>
                                                                        <td>
                                                                            <textarea class="form-control form-control--custom form-control--textarea"
                                                                                      name="remark[{{ $i }}]" id="remark-one">{{ isset($arrData['demarcation_details_data'][$demarcation_question->id]) ? $arrData['demarcation_details_data'][$demarcation_question->id]['remark'] : '' }}</textarea>
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
                                            <div class="tab-pane" id="tit-bit">
                                                <form class="form--custom" action="{{ route('ee-tit-bit') }}" method="post">
                                                    @csrf
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <div class="form-group row">
                                                                <div class="col-sm-4 d-flex align-items-center">
                                                                    <label for="name">संस्थेचे नाव:</label>
                                                                </div>
                                                                <div class="col-sm-8">
                                                                    <input type="text" class="form-control form-control--custom" disabled value="{{ $arrData['society_detail']->eeApplicationSociety->name }}"
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
                                                                    <input type="text" class="form-control form-control--custom" disabled value="{{ $arrData['society_detail']->eeApplicationSociety->building_no }}"
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
                                                                    <input type="text" class="form-control form-control--custom" required value="{{ isset($arrData['tit_bit_checkist_data']) ? $arrData['tit_bit_checkist_data']->layout : ''}}"
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
                                                                    <input type="text" class="form-control form-control--custom" required value="{{ isset($arrData['tit_bit_checkist_data']) ? $arrData['tit_bit_checkist_data']->details_of_notice : '' }}"
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
                                                                    <input type="text" class="form-control form-control--custom" required value="{{ isset($arrData['tit_bit_checkist_data']) ? $arrData['tit_bit_checkist_data']->investigation_officer_name : ''}}"
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
                                                                    <input type="text" class="form-control form-control--custom" required value="{{isset($arrData['tit_bit_checkist_data']) ? $arrData['tit_bit_checkist_data']->date_of_investigation : '' }}"
                                                                           name="date_of_investigation" id="tit_bit_date" placeholder="">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="table-checklist m-portlet__body m-portlet__body--table">
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
                                                                                <input type="radio" name="answer[{{ $i }}]" value="1" {{ (isset($arrData['tit_bit_details_data'][$tit_bit->id]) && $arrData['tit_bit_details_data'][$tit_bit->id]['answer'] == 1) ? 'checked' : 'checked' }}>
                                                                                <span></span>
                                                                            </label>
                                                                        </td>
                                                                        <td>
                                                                            <label class="m-radio m-radio--primary">
                                                                                <input type="radio" name="answer[{{ $i }}]" value="0" {{ (isset($arrData['tit_bit_details_data'][$tit_bit->id]) && $arrData['tit_bit_details_data'][$tit_bit->id]['answer'] == 0) ? 'checked' : '' }}>
                                                                                <span></span>
                                                                            </label></td>
                                                                        <td>
                                                                            <textarea class="form-control form-control--custom form-control--textarea"
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
                                            <div class="tab-pane" id="relocation">
                                                <form class="form--custom" action="{{ route('ee-rg-relocation') }}" method="post">
                                                    @csrf
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <div class="form-group row">
                                                                <div class="col-sm-4 d-flex align-items-center">
                                                                    <label for="name">संस्थेचे नाव:</label>
                                                                </div>
                                                                <div class="col-sm-8">
                                                                    <input type="text" class="form-control form-control--custom" disabled value="{{ $arrData['society_detail']->eeApplicationSociety->name }}"
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
                                                                    <input type="text" class="form-control form-control--custom" disabled value="{{ $arrData['society_detail']->eeApplicationSociety->building_no }}"
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
                                                                    <input type="text" class="form-control form-control--custom" required value="{{ isset($arrData['rg_checkist_data']) ? $arrData['rg_checkist_data']->layout : ''}}"
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
                                                                    <input type="text" class="form-control form-control--custom"
                                                                          name="details_of_notice" id="building-no" placeholder="" required value="{{ isset($arrData['rg_checkist_data']) ? $arrData['rg_checkist_data']->details_of_notice : '' }}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="table-checklist m-portlet__body m-portlet__body--table">
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
                                                                                <input type="radio" name="answer[{{ $i }}]" value="1" {{ (isset($arrData['rg_details_data'][$rg_question->id]) && $arrData['rg_details_data'][$rg_question->id]['answer'] == 1) ? 'checked' : 'checked' }}>
                                                                                <span></span>
                                                                            </label>
                                                                        </td>
                                                                        <td>
                                                                            <label class="m-radio m-radio--primary">
                                                                                <input type="radio" name="answer[{{ $i }}]" value="0" {{ (isset($arrData['rg_details_data'][$rg_question->id]) && $arrData['rg_details_data'][$rg_question->id]['answer'] == 0) ? 'checked' : '' }}>
                                                                                <span></span>
                                                                            </label></td>
                                                                        <td>
                                                                            <textarea class="form-control form-control--custom form-control--textarea"
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
                                    if(isset($arrData['get_last_status']) && ($arrData['get_last_status']->status_id == config('commanConfig.applicationStatus.forwarded')))
                                        $display = "display:none";
                                    else
                                        $display = "";
                                @endphp
                                <div class="panel" id="ee-note">
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
                                                                    REE</span>
                                                                    <div class="mt-auto">
                                                                        @php
                                                                            $href = isset($arrData['eeNote']->document_path) ? asset($arrData['eeNote']->document_path) : "#";
                                                                        @endphp
                                                                        <a href="{{ $href }}" download class="btn btn-primary">Download Note
                                                                            Format</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 border-left" style="{{ $display }}">
                                                                <div class="d-flex flex-column h-100 two-cols">
                                                                    <h5>Upload Note</h5>
                                                                    <span class="hint-text">Click on 'Upload' to upload EE
                                                                    -
                                                                    Note</span>
                                                                    <form action="{{ route('ee.upload_ee_note') }}" method="post" enctype="multipart/form-data">
                                                                        @csrf
                                                                        <input type="hidden" name="application_id" value="{{ $arrData['society_detail']->id }}">
                                                                        <div class="custom-file">
                                                                            <input class="custom-file-input" name="ee_note" type="file"
                                                                                   id="test-upload" required="">
                                                                            <label class="custom-file-label" for="test-upload">Choose
                                                                                file...</label>
                                                                        </div>
                                                                        <div class="mt-auto">
                                                                            <button type="submit" style="{{ $style }}" class="btn btn-primary btn-custom"
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

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
    <script>
        $(".editDocumentStatus, .deleteDocumentStatus").on("click", function(){
            var documentstatusid = $(this).attr('data-documentstatusid');
            var id = $(this).attr('data-id');
            $.ajax({
                type:"POST",
                url:"{{ route('get-ee-scrutiny-data') }}",
                data:{
                    "_token": "{{ csrf_token() }}",
                    "documentStatusId": documentstatusid,
                },
                cache:false,
                success:function(res){
                    $("#comment_by_EE_" + id).val(res.comment_by_EE);
                    $("#oldFileName_" + id).val(res.EE_document_path);

                    $("#fileName_" + id).val(res.EE_document_path);
                }
            });
        });

        $("#demarcation_date, #tit_bit_date").datepicker();


    </script>
@endsection
