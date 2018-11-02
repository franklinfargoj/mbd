<span class="d-flex btn-icon-list">
    <a class="d-flex flex-column align-items-center" href="{{route('view_architect_application', encrypt($architect_applications->id))}}">
        <span class="btn-icon btn-icon--view">
            <img src="{{ asset('/img/view-icon.svg')}}">
        </span>View
    </a>
    @php 
    $app=DB::table('eoa_applications')->where('id',$architect_applications->id)->first(); 
    $status_id=\App\ArchitectApplicationStatusLog::where(['user_id'=>auth()->user()->id,'role_id'=>session()->get('role_id'),'architect_application_id'=>$architect_applications->id])->orderBy('id','desc')->first();
    
    @endphp
    @if($is_commitee==true)
    <form method="post" action="{{route('finalise_architect_application')}}" >
        @else
        <form method="post" action="{{route('shortlist_architect_application')}}" class="d-flex btn-submit-icon">
            @endif
            @csrf
            <input type="hidden" name="application_id" value="{{$architect_applications->id}}">
            @if($is_view==true)
                @if($status_id['status_id']!=config('commanConfig.architect_applicationStatus.forward'))
                    @if($app->application_status!=config('commanConfig.architect_application_status.final'))
                        @if($app->application_status!=config('commanConfig.architect_application_status.shortListed'))
                        <button type="submit" name="shortlist" value="shortlist" class="btn btn--unstyled p-0 btn--icon-wrap d-flex align-items-center flex-column">
                            <span class="btn-icon btn-icon--edit">
                                <img src="{{ asset('/img/shortlist-view-icon.svg')}}">
                            </span>Shortlist
                        </button>
                        @else
                        <button type="submit" name="remove_shortlist" value="remove_shortlist" class="btn btn--unstyled p-0 btn--icon-wrap d-flex align-items-center flex-column">
                            <span class="btn-icon btn-icon--delete">
                                    <img src="{{ asset('/img/shortlist-remove-icon.svg')}}">
                            </span>Remove from<span class="d-block">Shortlisted List</span>
                        </button>
                        @endif
                    @endif
                @endif
            @endif
            @if($is_commitee==true)
                @if($status_id['status_id']!=config('commanConfig.architect_applicationStatus.forward'))
                    @if($app->application_status!=config('commanConfig.architect_application_status.final'))
                    <button type="submit" name="final" value="final" class="btn btn-primary">
                        <span class="btn-icon btn-icon--delete">
                            <img src="{{ asset('/img/shortlist-add-icon.svg')}}">
                        </span>Add to Final list
                    </button>
                    @else
                    <button type="submit" name="remove_final" value="remove_final" class="btn btn-primary">
                        <span class="btn-icon btn-icon--delete">
                                <img src="{{ asset('/img/shortlist-remove-icon.svg')}}">
                        </span>Remove from<span class="d-block">Final list</span></button>
                    @endif
                @endif
            @endif
        </form>
</span>
