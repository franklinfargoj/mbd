@extends('admin.layouts.sidebarAction')
@section('actions')
@include('admin.conveyance.dyco_department.action',compact('applicationId'))
@endsection

@section('content')

@if(session()->has('success'))
<div class="alert alert-success display_msg">
    {{ session()->get('success') }}
</div>
@endif
@if(session()->has('error'))
<div class="alert alert-error display_msg">
    {{ session()->get('error') }}
</div>
@endif

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
                <a class="nav-link m-tabs__link active show" data-toggle="tab" href="#checklist-scrutiny" role="tab"
                    aria-selected="false">
                    <i class="la la-cog"></i> Checklist Scrutiny
                </a>
            </li>
            <li class="nav-item m-tabs__item">
                <a class="nav-link m-tabs__link" data-toggle="tab" href="#dycdo-note" role="tab" aria-selected="true">
                    <i class="la la-bell-o"></i>DyCDO Note
                </a>
            </li>
        </ul>
    </div>

    <div class="tab-content">
        <div class="tab-pane active show" id="checklist-scrutiny" role="tabpanel">
            <div class="m-portlet m-portlet--tabs m-portlet--bordered-semi mb-0 m-portlet--shadow">
                <div class="portlet-body">
                    <div class="m-portlet__body m-portlet__body--table">
                        <div class="m-subheader">
                            <div class="d-flex align-items-center justify-content-center">
                                <h3 class="section-title">
                                    मिळकत व्यव्थापन विनिमय २१(६) नुसार इमारतीचे अभिहस्तांतरण करावयाचा प्रस्थाव
                                </h3>
                            </div>
                        </div>
                        <div class="m-section__content mb-0 table-responsive">
                                <table id="one" class="table mb-0 table--box-input" style="padding-top: 10px;">
                                    <div class="d-flex justify-content-between align-items-center mb-4">
                                        <a target="_blank" href="javascript:void(0);" class="btn print-icon ml-auto"><img
                                                src="{{asset('/img/print-icon.svg')}}" onclick='PrintElem("one");'
                                                style="max-width: 22px"></a>
                                    </div>
                                    <thead class="thead-default">
                                        <tr>
                                            <th class="table-data--xs">
                                                #
                                            </th>
                                            <th>
                                                मुद्दा
                                            </th>
                                            <th class="table-data--md" style="width: 300px">
                                                तपशील
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if($checklist)
                                        <?php $i = 1; ?>
                                            @foreach($checklist as $value)
                                                <tr>
                                                    <td>{{$i}}</td>
                                                    <td>{{ isset($value->name) ? $value->name : '' }}</td>
                                                    <td class="text-center">
                                                    @if($value->is_date == '1')    
                                                        <input type="text" class="txtbox v_text form-control form-control--custom m-input m_datepicker" name="{{ isset($value->id) ? $value->id : '' }}"  value="{{ isset($value->checklistStatus) ? $value->checklistStatus->value : '' }}" aria-describedby="visit_date-error" aria-invalid="false" readonly disabled>
                                                    @else
                                                        <input type="text" name="{{ isset($value->id) ? $value->id : '' }}" class="form-control form-control--custom" value="{{ isset($value->checklistStatus) ? $value->checklistStatus->value : '' }}" readonly>    
                                                    @endif 
                                                    </td>
                                                </tr>  
                                            <?php $i++; ?>
                                            @endforeach
                                        @endif                                               
                                    </tbody>
                                </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane" id="dycdo-note" role="tabpanel">
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
                                        <div class="col-sm-6 border-left">
                                            <div class="d-flex flex-column h-100 two-cols">
                                                <h5>Download DyCDO Note</h5>
                                                <div class="mt-auto">
                                                @if(isset($checklist->dyco_note))
                                                <input type="hidden" name="old_file_name" value="{{ $checklist->dyco_note }}">
                                                <a href="{{ config('commanConfig.storage_server').'/'.$checklist->dyco_note }}">
                                                    <Button type="button" class="s_btn btn btn-primary" id="submitBtn">
                                                        Download </Button>
                                                </a>
                                                @else
                                                <span class="error" style="display: block;color: #ce2323;margin-bottom: 17px;">
                                                    *Note : DYCDO note is not available.</span>
                                                @endif
                                                </div>
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
    </div>
</div>
@endsection
@section('js')
  <script>
    $(".uploadBtn").click(function(){
      myfile = $(".dyco_note").val();
      var ext = myfile.split('.').pop();      
      if (myfile != ''){        
          
          if (ext != "pdf"){
            $("#file_error").text("Invalid type of file uploaded (only pdf allowed).");
            return false;
          }
          else{
            $("#file_error").text("");
            return true;
          }      
      }else{
        $("#file_error").text("This field required");
        return false;
      }
    });  
  </script>
@endsection
