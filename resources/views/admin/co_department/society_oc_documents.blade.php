@extends('admin.layouts.sidebarAction')
@section('actions')
    @include('admin.co_department.action_oc',compact('oc_application'))
@endsection
@section('css')
<link href="{{asset('/frontend/css/dyce_scrutiny.css')}}" rel="stylesheet" type="text/css" />
<style type="text/css">
  .heading{
      font-weight: 500;
      font-size: 15px;
  }
</style>
@endsection
@section('content')
@php
    $floor = ['Ground','Stilt','parking'];
    $i = 1;
@endphp

<div class="col-md-12">
    <!-- BEGIN: Subheader -->
    <div class="m-subheader px-0 m-subheader--top">
        <div class="d-flex align-items-center">
            <h3 class="m-subheader__title m-subheader__title--separator">
                Society Documents </h3>
                {{ Breadcrumbs::render('society_oc_documents_co',$oc_application->id) }}
            <a href="{{ url()->previous() }}" class="btn btn-link ml-auto"><i class="fa fa-long-arrow-left" style="padding-right: 8px;"></i>Back</a>
        </div>
    </div>

    <!-- society and Appointed Architect details -->
    <div class="m-portlet m-portlet--mobile m_panel">
        <div class="m-portlet__body m-portlet__body--table main_panel">
            <table class="table mb-0">
                <thead class="thead-default">
                    <th class="table-data--xs">अ क्र.</th>
                    <th>तपशील</th>
                    <th class="table-data--xs">दस्तावेज</th>
                </thead>
                <tbody>
                    <?php $i=1; ?>
                     @if($societyDocuments)
                        @foreach($societyDocuments as $data)
                           <tr>
                              <td>{{ $i}}.</td>
                              <td>{{($data->name)}}
                                @if($data->is_optional == 0)
                                    @if($data->full_oc_document == 0)
                                        <span class="compulsory-text">
                                        <small>(Compulsory Document)</small></span>
                                    @elseif($data->full_oc_document == 1 && $oc_application->request_form->is_full_oc == 1)   
                                        <span class="compulsory-text">
                                        <small>(Compulsory Document)</small></span>
                                    @else
                                        <span class="compulsory-text"> <small>
                                        <span style="color: green;">
                                        (Optional Document)</small> </span>    
                                    @endif    
                                @else
                                <span class="compulsory-text"> <small>
                                <span style="color: green;">
                                (Optional Document)</small> </span>
                                @endif
                              </td>
                              <td class="text-center">
                                 @if(isset($data->oc_documents_uploaded[0]->society_document_path))
                                 <a target="_blank" href="{{ asset($data->oc_documents_uploaded[0]->society_document_path) }}">
                                 <img class="pdf-icon" src="{{ asset('/img/pdf-icon.svg')}}"></a>
                                 @else
                                 <h2 class="m--font-danger">
                                      <i class="fa fa-remove"></i>
                                  </h2>
                                 @endif
                              </td>
                           </tr>
                        @php $i++; @endphp
                        @endforeach
                     @endif
                </tbody>
            </table>
        </div>
    </div>

    <!-- constructed building details table -->
    <div class="m-portlet m-portlet--creative m-portlet--first m-portlet--bordered-semi mb-0">
        <div class="m-portlet__body m-portlet__body--table">
            <div class="m-section__content mb-0 table-responsive">
                <span class="heading">Details of newly constructed building</span>
                  <table class="table mb-0">
                      <thead class="thead-default">
                          <tr>
                              <th> Name </th>
                              <th> Values </th>
                          </tr>
                      </thead>
                      <tbody>
                          <tr>
                              <td>Floors <span class="star">*</span></td>
                              <td>
                                  <div class="row col-md-12">
                                      <div class="col-md-6">
                                          <select class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input" id="floor" name="floor" disabled>
                                          @if(isset($floor))
                                              @foreach($floor as $value)
                                                  @if(isset($conDetails) && $value == $conDetails->floor)
                                                      <option value="{{ $value }}" selected>{{ $value }}</option>
                                                  @else
                                                      <option value="{{ $value }}">{{ $value }}</option>
                                                  @endif
                                              @endforeach    
                                          @endif
                                          </select>
                                      </div>    
                                      <div class="col-md-6">
                                          <select class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input" id="floor_no" name="floor_no" data-live-search="true" disabled>
                                          @for($i=1;$i<=100;$i++)
                                              @if(isset($conDetails) && $i == $conDetails->floor_no)
                                                  <option value="{{$i}}" selected>{{ $i }}</option>
                                              @else
                                                  <option value="{{$i}}">{{ $i }}</option>
                                              @endif
                                          @endfor    
                                          </select>
                                      </div>
                                  </div>        
                              </td>
                          </tr>
                          <tr>
                              <td>No of rehab tenements <span class="star">*</span></td>
                              <td>
                                  <input type="text" id="rehab_tenements" name="rehab_tenements" class="form-control form-control--custom m-input" value="{{ isset($conDetails) ? $conDetails->rehab_tenements : '' }}" readonly>  
                              </td>
                          </tr>
                          <tr>
                              <td>No of sale tenements <span class="star">*</span></td>
                              <td>
                                  <input type="text" id="sale_tenements" name="sale_tenements" class="form-control form-control--custom m-input" value="{{ isset($conDetails) ? $conDetails->sale_tenements : '' }}" readonly>
                              </td>
                          </tr>
                          <tr>
                              <td>No of MHADA tenements <span class="star">*</span></td>
                              <td>
                                 <input type="text" id="mhada_tenements" name="mhada_tenements" class="form-control form-control--custom m-input" value="{{ isset($conDetails) ? $conDetails->mhada_tenements : '' }}"  readonly> 
                              </td>
                          </tr>
                          <tr>
                              <td>Total No of constructed tenements <span class="star">*</span></td>
                              <td>
                                 <input type="text" id="constructed_tenements" name="constructed_tenements" class="form-control form-control--custom m-input" value="{{ isset($conDetails) ? $conDetails->constructed_tenements : '' }}" readonly> 
                              </td>
                          </tr>
                      </tbody>
                  </table>
            </div>
        </div>
    </div> 
</div>

@if($comments) 
<div class="col-md-12">
    <div class="m-portlet m-portlet--creative m-portlet--first m-portlet--bordered-semi mb-0">
        <div class="m-portlet__body m-portlet__body--table">
            <div class="m-portlet__body m-portlet__body--table m-portlet__body--serial-no m-portlet__body--serial-no-pdf">
                <div class="">
                    <h3 class="section-title section-title--small">Society Comments :</h3>
                </div>
                    <div class="remarks-suggestions table--box-input">
                        <div class="mt-3">
                            <label for="society_documents_comment">Additional Information</label>
                                <textarea name="society_documents_comment" rows="5" cols="30" id="society_documents_comment" class="form-control form-control--custom" readonly>{{ $comments->society_documents_comment }}</textarea>
                        </div>
                    </div>
            </div>
        </div>
    </div>  
</div> 
@endif
@endsection
