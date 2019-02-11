@extends('admin.layouts.sidebarAction')
@section('actions')
    @include('admin.'.$folder.'.action',compact('ol_application'))
@endsection
@section('css') 
<style>
    .loader {
    position: fixed;
    left: 0px;
    top: 0px;
    width: 100%;
    height: 100%;
    z-index: 9999;
    background: url('/img/loading-spinner-blue.gif') 50% 50% no-repeat rgb(249,249,249);
    opacity: .8;
}
</style>
@endsection
@section('content')
<div class="loader" style="display:none;"></div>
<div class="col-md-12"> 
    <!-- BEGIN: Subheader -->
    <div class="m-subheader px-0 m-subheader--top">
        <div class="d-flex align-items-center"> 
            <h3 class="m-subheader__title m-subheader__title--separator">Document Submitted By Society</h3>
            @if (session()->get('role_name') == config('commanConfig.ee_junior_engineer') || session()->get('role_name') == config('commanConfig.ee_branch_head') || session()->get('role_name') == config('commanConfig.ee_deputy_engineer'))
                {{ Breadcrumbs::render('document-submitted',$ol_application->id) }}

            @elseif(session()->get('role_name') == config('commanConfig.dyce_jr_user') || session()->get('role_name') == config('commanConfig.dyce_branch_head') || session()->get('role_name') == config('commanConfig.dyce_deputy_engineer'))    

                {{ Breadcrumbs::render('society_EE_documents',$ol_application->id) }}

            @elseif (session()->get('role_name') == config('commanConfig.ree_junior') || session()->get('role_name') == config('commanConfig.ree_deputy_engineer') || session()->get('role_name') == config('commanConfig.ree_assistant_engineer') || session()->get('role_name') == config('commanConfig.ree_branch_head')) 

                {{ Breadcrumbs::render('society_EE_documents_ree',$ol_application->id) }}

            @elseif(session()->get('role_name') == config('commanConfig.co_engineer'))    
                {{ Breadcrumbs::render('society_EE_documents_co',$ol_application->id) }}
            @endif
            <a href="{{ url()->previous() }}" class="btn btn-link ml-auto"><i class="fa fa-long-arrow-left" style="padding-right: 8px;"></i>Back</a>
        </div>
    </div> 
    <!-- END: Subheader -->

        @if(count($documents) > 0)   
        <div class="m-portlet m-portlet--creative m-portlet--first m-portlet--bordered-semi mb-0" style="max-height: 1200px;"> 
            <div class="m-portlet__body m-portlet__body--table">  
                <div class="col-sm-10 table-responsive" style="top: 25px;left: 30px;">
                    <table class="mt-2 table table-hover" id="dtBasicExample"> 
                        <thead>
                            <tr>
                                <th>Sr.no</th>
                                <th>Name</th>
                                <th>Document</th>   
                            </tr>
                        </thead>    
                        <tbody>
                                @php $i = 1;@endphp 
                                @foreach($documents as $document)
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td> {{ isset($document->member_name) ? $document->member_name : '' }} </td>
                                    <td class=""> 
                                        <a class="btn-link" href="{{ config('commanConfig.storage_server').'/'.$document->society_document_path }}" download target="_blank"> Download </a> 
                                    </td> 
                                </tr>
                                @php $i++;@endphp 
                                @endforeach 
                        </tbody>    
                    </table>
                </div> 
            </div>    
        </div>   
        @endif
</div>

@endsection
@section('js')
<script type="text/javascript">
    
    $(document).ready(function () {
      $('#dtBasicExample').DataTable();
      $('.dataTables_length').addClass('bs-select');

      $('#dtBasicExample_wrapper > .row:first-child').remove();
    });  

    $('table').dataTable({searching: false, ordering:false, info: false});
</script>
@endsection


