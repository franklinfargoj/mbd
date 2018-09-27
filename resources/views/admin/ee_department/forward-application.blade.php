@extends('admin.layouts.app')
@section('content')

<div class="custom-wrapper">
    <div class="col-md-12">
        <div class="">
            <div class="m-portlet__head">
                <div class="m-portlet__head-tools">
                    <ul class="nav nav-tabs m-tabs-line m-tabs-line--primary m-tabs-line--2x nav-tabs--custom">
                        {{--<li class="nav-item m-tabs__item" data-target="#document-scrunity">
                            <a class="nav-link m-tabs__link active show" data-toggle="tab" href="#scrutiny-history-tab">
                                <i class="la la-cog"></i> Scrutiny History
                            </a>
                        </li>--}}
                        <li class="nav-item m-tabs__item">
                            <a class="nav-link m-tabs__link active show" data-toggle="tab" href="#forward-application-tab">
                                <i class="la la-cog"></i> Forward Application
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
                                                    <span class="field-value">{{ $arrData['society_detail']->application_no }}</span>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 field-col">
                                                <div class="d-flex">
                                                    <span class="field-name">Application Date:</span>
                                                    <span class="field-value">{{ date(config('commanConfig.dateFormat'), strtotime($arrData['society_detail']->submitted_at)) }}</span>
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

                            {{--<div class="tab-pane active show" id="scrutiny-history-tab">
                                <div class="m-portlet m-portlet--tabs m-portlet--bordered-semi mb-0">
                                    <div class="portlet-body">
                                        <div class="m-portlet__body m-portlet__body--table m-portlet__body--serial-no m-portlet__body--serial-no-pdf">
                                            <div class="border-bottom pb-2">
                                                <h3 class="section-title section-title--small mb-2">
                                                    Remark History:
                                                </h3>
                                                <span class="hint-text d-block">Remark by EE</span>
                                            </div>
                                            <div class="remarks-section">
                                                <div class="m-scrollable m-scroller ps ps--active-y remarks-section-container"
                                                    data-scrollbar-shown="true" data-scrollable="true" data-max-height="200">
                                                    <div class="remarks-section__data">
                                                        <p class="remarks-section__data__row"><span>Date:</span><span>12/09/2018</span></p>
                                                        <p class="remarks-section__data__row"><span>Time:</span><span>11:09
                                                                am</span></p>
                                                        <p class="remarks-section__data__row"><span>Action:</span><span>Sent
                                                                to Society</span></p>
                                                        <p class="remarks-section__data__row"><span>Description:</span><span>Lorem
                                                                ipsum dolor sit amet consectetur adipisicing elit.
                                                                Error, tempore facere! Ipsa nisi repudiandae
                                                                architecto!</span></p>
                                                    </div>
                                                    <div class="remarks-section__data">
                                                        <p class="remarks-section__data__row"><span>Date:</span><span>12-09-2018</span></p>
                                                        <p class="remarks-section__data__row"><span>Time:</span><span>11:09 am</span></p>
                                                        <p class="remarks-section__data__row"><span>Action:</span><span>Sent to Society</span></p>
                                                        <p class="remarks-section__data__row"><span>Description:</span><span>Lorem ipsum dolor sit amet consectetur adipisicing elit. Error, tempore facere! Ipsa nisi repudiandae architecto!</span></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>--}}

                            <div class="tab-pane active show" id="forward-application-tab">
                                <div class="m-portlet m-portlet--tabs m-portlet--bordered-semi mb-0">
                                    <div class="portlet-body">
                                        <div class="m-portlet__body m-portlet__body--table m-portlet__body--serial-no m-portlet__body--serial-no-pdf">
                                            <div class="">
                                                <h3 class="section-title section-title--small">
                                                    Remark and Suggestions:
                                                </h3>
                                            </div>
                                            <div class="remarks-suggestions">
                                                <form action="{{ route('forward-application') }}" id="forwardApplication" method="post">
                                                    @csrf
                                                    <input type="hidden" name="application_id" value="{{ $arrData['society_detail']->id }}">
                                                    <input type="hidden" name="to_role_id" id="to_role_id">

                                                    <div class="m-form__group form-group">
                                                        <div class="m-radio-inline">
                                                            <label class="m-radio m-radio--primary">
                                                                <input type="radio" name="remarks-suggestion" class="forward-application" value="1" checked> Forward Application
                                                                <span></span>
                                                            </label>
                                                            <label class="m-radio m-radio--primary">
                                                                <input type="hidden" name="check_status" class="check_status" value="1">
                                                                {{--<input type="hidden" name="user_id" value="{{ isset($arrData['application_status']) ? $arrData['application_status']->user_id : '' }}">--}}
                                                                <input type="hidden" name="user_id">
                                                                {{--<input type="hidden" name="role_id" value="{{ isset($arrData['application_status']) ? $arrData['application_status']->role_id : '' }}">--}}
                                                                <input type="hidden" name="role_id">

                                                                @if(session()->get('role_name') != config('commanConfig.ee_junior_engineer'))
                                                                    <input type="radio" name="remarks-suggestion" class="forward-application" value="0"> Revert Application
                                                                @endif
                                                                <span></span>
                                                            </label>
                                                        </div>
                                                        <div class="form-group m-form__group row mt-3 parent-data">
                                                            <label class="col-form-label col-lg-2 col-sm-12">
                                                                Forward To:
                                                            </label>
                                                            <div class="col-lg-4 col-md-9 col-sm-12">
                                                                <select class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input" name="to_user_id" id="to_user_id">
                                                                    @if($arrData['parentData'])
                                                                        @foreach($arrData['parentData'] as $parent)
                                                                            <option value="{{ $parent->id }}" data-role="{{ $parent->role_id }}">{{ $parent->name }} ({{ $arrData['role_name'] }})</option>
                                                                        @endforeach
                                                                    @else
                                                                        @foreach($arrData['get_forward_dyce'] as $parent)
                                                                            <option value="{{ $parent->id }}" data-role="{{ $parent->role_id }}">{{ $parent->name }} ({{ $arrData['dyce_role_name'] }})</option>
                                                                        @endforeach
                                                                    @endif
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="form-group m-form__group row mt-3 child-data" style="display: none">
                                                            <label class="col-form-label col-lg-2 col-sm-12">
                                                                Revert To:
                                                            </label>
                                                            <div class="col-lg-4 col-md-9 col-sm-12">
                                                                <select class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input" name="to_child_id" id="to_child_id">
                                                                    @if(isset($arrData['application_status']))
                                                                        @foreach($arrData['application_status'] as $child)
                                                                            <option value="{{ $child->id }}" data-role="{{ $child->role_id }}">{{ $child->name }} ({{ strtoupper(str_replace('_', ' ',$child->roles[0]->name)) }})</option>
                                                                        @endforeach
                                                                    @endif
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="mt-3">
                                                            <label for="remark">Remark:</label>
                                                            <textarea class="form-control form-control--custom" name="remark" id="remark" cols="30" rows="5"></textarea>
                                                        </div>
                                                        <div class="mt-3 btn-list">
                                                            <button type="submit" class="btn btn-primary">Save</button>
                                                            {{--<button type="submit" class="btn btn-primary">Sign & Forward</button>
                                                            <button type="submit" class="btn btn-primary">Forward</button>--}}
                                                            <button type="button" onclick="window.location.href='{{ url("/ee") }}'" class="btn btn-secondary">Cancel</button>
                                                        </div>
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
@endsection

@section('js')
    <script>
        $(".forward-application").change(function () {
            var data = $(this).val();

            if(data == 1)
            {
                $(".parent-data").show();
                $(".child-data").hide();
                $(".check_status").val(1)
            }
            else
            {
                $(".parent-data").hide();
                $(".child-data").show();
                $(".check_status").val(0);
            }
        });

        $("#forwardApplication").on("submit", function () {
            var data = $(".check_status").val();
            if(data == 1) {
                var id = $("#to_user_id").find('option:selected').attr("data-role");
            }
            else
            {
                var id = $("#to_child_id").find('option:selected').attr("data-role");
            }

            $("#to_role_id").val(id);
        });
    </script>
@endsection
