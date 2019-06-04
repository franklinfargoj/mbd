@extends('admin.layouts.app')

@section('actions')
@include('admin.em_department.action',compact('ol_application'))
@endsection
@section('content')

@if(session()->has('success'))
<div class="alert alert-success display_msg">
    {{ session()->get('success') }}
</div>
@endif

@if(session()->has('warning'))
<div class="alert alert-danger display_msg">
    {{ session()->get('warning') }}
</div>
@endif

<div class="col-md-12">
    <!-- BEGIN: Subheader -->
    <div class="m-subheader px-0 m-subheader--top">
        <div class="d-flex align-items-center" id="search_box">
            <h3 class="m-subheader__title m-subheader__title--separator">Billing Level</h3>
            {{ Breadcrumbs::render('em') }}
            <div class="ml-auto btn-list">
                <a href="{{ url()->previous() }}" class="btn btn-link pull-right"><i class="fa fa-long-arrow-left"
                        style="padding-right: 8px;"></i>Back</a>
            </div>
        </div>
    </div>
    <div class="m-portlet m-portlet--mobile m-portlet--forms-view">
        <div class="m-portlet__body">
            <form class="m-form m-form--rows m-form--label-align-right" method="post" enctype='multipart/form-data' action="{{route('update_soc_bill_level')}}">
                {{ csrf_field() }}
                <input type="hidden" value="{{ old('id', $society[0]->id) }}" name="id" />
                <div class="row">
                    <div class="col-md-12">
                        <h4 class="m-subheader__title--hint mb-4" style="margin-left: 0;">Billing Level for {{$society[0]->society_name}}</h4>
                    </div>
                </div>
                <div class="form-group m-form__group row pt-0">
                    <div class="col-sm-3 form-group">
                        <label class="col-form-label">Select Billing</label>
                        <select class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input" id="soc_bill_level"
                            name="soc_bill_level" required>
                            <option value="" style="font-weight: normal;">Select Billing</option>
                            @foreach($soc_bill_level as $key => $value)
                            <option value="{{ $value->id }}"
                                {{ old("soc_bill_level", $society[0]->society_bill_level) == $value->id ? 'selected' : '' }}>{{
                                $value->name }}</option>
                            @endforeach
                        </select>
                        <span class="help-block error">{{$errors->first('soc_bill_level')}}</span>
                    </div>
                    <div class="col-sm-3 form-group is_conveyanced">
                        <label class="col-form-label">Is Society Conveyanced?</label>
                        <input class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input" type="checkbox" id="is_conveyanced" {{ old('is_conveyanced',$society[0]->is_conveyanced)? 'checked' : ''}} name="is_conveyanced">
                        
                    </div>
                    <div class="col-sm-3 form-group conveyance_type">
                        <label class="col-form-label">Half Conveyanced</label>
                        <input class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input" type="radio" {{ old('conveyanced_type',$society[0]->conveyanced_type)==config('commanConfig.conveyanced_type.half')? 'checked' : ''}} name="conveyanced_type" value="{{config('commanConfig.conveyanced_type.half')}}">
                        <label class="col-form-label">Full Conveyanced</label>
                        <input class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input" type="radio" {{ old('conveyanced_type',$society[0]->conveyanced_type)==config('commanConfig.conveyanced_type.full')? 'checked' : ''}} name="conveyanced_type" value="{{config('commanConfig.conveyanced_type.full')}}">
                        
                    </div>
                    <div class="col-sm-3 form-group lease_and_na_charges_box">
                            <label class="col-form-label">% on lease and NA charges(monthly)</label>
                    <input class="form-control form-control--custom m-input" type="text" id="lease_and_na_charges" name="lease_and_na_charges" value="{{old('lease_and_na_charges',$society[0]->lease_and_na_charges_in_per)}}">
                    @if ($errors->has('lease_and_na_charges'))
                        <div class="error">{{ $errors->first('lease_and_na_charges') }}</div>
                    @endif        
                </div>
                    <div class="col-sm-3 mt-4">
                        <div class="btn-list mt-3">
                            <input type="submit" class="btn btn-primary mhada-btn-pill" name="submit" value="Submit">
                            <a class="btn btn-secondary mhada-btn-pill" href="{{ route('get_societies') }}">Cancel</a>
                        </div>
                    </div>
                </div>
                
            </form>
        </div>
    </div>
    <!-- END: Subheader -->

    <input type="hidden" id="myModalBtn" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal" />

    <!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog">

    </div>
    <!-- END EXAMPLE TABLE PORTLET-->
</div>
@endsection
@section('datatablejs')


<script>
    /*$("#update_status").on("change", function () {
        $("#eeForm").submit();
    });*/

    $(document).ready(function () {
        $('input[name="lease_and_na_charges"]').keyup(function(e){
        if (/\D/g.test(this.value))
        {
            // Filter non-digits from input value.
            this.value = this.value.replace(/\D/g, '');
        }
        });
        $(".is_conveyanced").hide();
        $(".display_msg").delay(5000).slideUp(300);
        var selected_level=$('#soc_bill_level').children("option:selected").val();
            if(selected_level==1)
            {
                $(".is_conveyanced").show();
            }else
            {
                $(".is_conveyanced").hide();
            }

        $('#soc_bill_level').on('change', function() {
            if(this.value==1)
            {
                $(".is_conveyanced").show();
                $(".lease_and_na_charges_box").show()
                $(".conveyance_type").show()
            }else
            {
                $(".is_conveyanced").hide();
                $(".lease_and_na_charges_box").hide()
                $(".conveyance_type").hide()
            }
        });
        
        if ($('#is_conveyanced').is(':checked')) {
            $(".conveyance_type").show()
            //$(".lease_and_na_charges_box").show()
        }else
        {
            $(".conveyance_type").hide()
            //$(".lease_and_na_charges_box").hide()
        }
        
        $('#is_conveyanced').on('change', function() {
            if(this.checked)
            {
                $(".conveyance_type").show()
                $(".lease_and_na_charges_box").show()
            }else
            {
                $(".conveyance_type").hide()
                $(".lease_and_na_charges_box").hide()
            }
        });
        
        if ($('input[name="conveyanced_type"]').is(':checked')) {
            var selected_value=$("input[name='conveyanced_type']:checked").val()
            if(selected_value=='full')
            {
                $(".lease_and_na_charges_box").show()
               // $(".lease_and_na_charges_box").hide()
            }else
            {
                $(".lease_and_na_charges_box").hide()
            }
        }else
        {
            var selected_value=$("input[name='conveyanced_type']:checked").val()
            if(selected_value=='full')
            {
                $(".lease_and_na_charges_box").show()
                //$(".lease_and_na_charges_box").hide()
            }else
            {
                $(".lease_and_na_charges_box").hide()
            }
        }

        $('input[name="conveyanced_type"]').on('click', function() {
            var selected_value=$("input[name='conveyanced_type']:checked").val()
            if(selected_value=='full')
            {
                $(".lease_and_na_charges_box").show()
            }else if(selected_value=='half')
            {
                $(".lease_and_na_charges_box").hide()
            }else
            {

            }
        });
        
    });

</script>
@endsection
