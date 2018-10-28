@extends('admin.layouts.app')
@section('content')

<div class="col-md-12">
    <div class="d-flex form-steps-wrap">
        <button class="btn--unstyled flex-grow-1 form-step-tab active">Step 1</button>
        <button class="btn--unstyled flex-grow-1 form-step-tab active">Step 2</button>
        <button class="btn--unstyled flex-grow-1 form-step-tab">Step 3</button>
        <button class="btn--unstyled flex-grow-1 form-step-tab">Step 4</button>
        <button class="btn--unstyled flex-grow-1 form-step-tab">Step 5</button>
        <button class="btn--unstyled flex-grow-1 form-step-tab">Step 6</button>
        <button class="btn--unstyled flex-grow-1 form-step-tab">Step 7</button>
        <button class="btn--unstyled flex-grow-1 form-step-tab">Step 8</button>
    </div>
    <div class="m-portlet m-portlet--mobile m-portlet--forms-view">
        <h3 class="section-title section-title--small">Form 2:</h3>
        <form id="" role="form" method="post" class="m-form m-form--rows m-form--label-align-right"
    action="{{route('appointing_architect.step2_post')}}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="application_id" value="{{$application->id}}">
            @include('employment_of_architect.partial_personal_details',compact('application'))
            @include('employment_of_architect.partial_payment_details',compact('application'))
            <div class="m-portlet__head px-0 m-portlet__head--top">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <span class="m-portlet__head-icon m--hide">
                            <i class="la la-gear"></i>
                        </span>
                        <h3 class="m-portlet__head-text">
                            Enclosures
                        </h3>
                    </div>
                </div>
            </div>
            @for($i=0;$i<15;$i++)
            <div class="input-row-list">
                <div class="d-flex align-items-end">
                    <label class="mb-0 mr-4 font-weight-semi-bold" for="">{{$i+1}}.</label>
                <input type="hidden" name="enclosure_id[]" value="{{isset($application->enclosures[$i])?$application->enclosures[$i]->id:''}}">
                    <input type="text" id="" name="enclosures[]" class="form-control form-control--custom m-input w-100" value="{{isset($application->enclosures[$i])?$application->enclosures[$i]->enclosure:''}}">
                </div>
                <span class="help-block"></span>
            </div>

            @endfor
            

            <div class="m-checkbox-list mt-5">
                <label class="m-checkbox m-checkbox--primary">
                    <input type="checkbox" name="application_info_and_its_enclosures_verify" value="1"> Is verified by me and the same is correct by my knowledge
                    <span class=""></span>
                </label>
                @if ($errors->has('application_info_and_its_enclosures_verify'))
                    <span class="text-danger">{{ $errors->first('application_info_and_its_enclosures_verify') }}</span>
                @endif
            </div>
            <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                <div class="m-form__actions px-0">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="btn-list">
                                <button type="submit" id="" class="btn btn-primary">Save</button>
                                <a href="" class="btn btn-secondary">Cancel</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection
