<div class="d-flex btn-icon-list">
        @if($architect_applications->ArchitectApplicationStatusForLoginListing->count()>0)
        
    <a class="d-flex flex-column align-items-center" href="{{route('appointing_architect.view_eoa_application',['id'=>encrypt($architect_applications->id)])}}">
        <span class="btn-icon btn-icon--view">
            <img src="{{ asset('/img/view-icon.svg')}}">
        </span>View
    </a>
    @else
    @php $redirect_route="appointing_architect.step1"; @endphp
    @if($architect_applications->form_step==2)
        @php $redirect_route="appointing_architect.step2"; @endphp
    @elseif($architect_applications->form_step==3)
        @php $redirect_route="appointing_architect.step3"; @endphp
    @elseif($architect_applications->form_step==4)
        @php $redirect_route="appointing_architect.step4"; @endphp
    @elseif($architect_applications->form_step==5)
        @php $redirect_route="appointing_architect.step5"; @endphp
    @elseif($architect_applications->form_step==6)
        @php $redirect_route="appointing_architect.step6"; @endphp
    @elseif($architect_applications->form_step==7)
        @php $redirect_route="appointing_architect.step7"; @endphp
    @elseif($architect_applications->form_step==8)
        @php $redirect_route="appointing_architect.step8"; @endphp
    @elseif($architect_applications->form_step==9)
        @php $redirect_route="appointing_architect.step9"; @endphp
    @elseif($architect_applications->form_step==10)
        @php $redirect_route="appointing_architect.step10"; @endphp
    @else
        @php $redirect_route="appointing_architect.step1"; @endphp
    @endif
    <a class="d-flex flex-column align-items-center" href="{{ route($redirect_route, ['id' => encrypt($architect_applications->id)]) }}">
        <span class="btn-icon btn-icon--edit">
            <img src="{{ asset('/img/edit-icon.svg')}}">
        </span>Edit
        </a>
   @endif
   @if($architect_applications->ArchitectApplicationStatusForLoginListing->count() > 0)
    @php
       $status_id=\App\ArchitectApplicationStatusLog::where(['user_id'=>auth()->user()->id,'role_id'=>session()->get('role_id')])->orderBy('id','desc')->get()[0]->status_id;
    @endphp
    @if($status_id==config('commanConfig.architect_applicationStatus.approved'))
    <a target="_blank" class="d-flex flex-column align-items-center delete-village"  title="Delete"
        href="{{config('commanConfig.storage_server').'/'.$architect_applications->certificate_path}}">
        <span class="btn-icon btn-icon--delete">
            <img src="{{ asset('/img/download-icon.svg')}}">
        </span>certificate
    </a>
    @endif
   @endif
</div>