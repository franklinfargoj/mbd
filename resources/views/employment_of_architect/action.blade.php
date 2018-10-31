<div class="d-flex btn-icon-list">
        @if($architect_applications->ArchitectApplicationStatusForLoginListing->count()>0)
    <a class="d-flex flex-column align-items-center" href="#">
        <span class="btn-icon btn-icon--view">
            <img src="{{ asset('/img/view-icon.svg')}}">
        </span>View
    </a>
    @else
    <a class="d-flex flex-column align-items-center" href="{{ route('appointing_architect.step1', ['id' => encrypt($architect_applications->id)]) }}">
        <span class="btn-icon btn-icon--edit">
            <img src="{{ asset('/img/edit-icon.svg')}}">
        </span>Edit
        </a>
   @endif
</div>