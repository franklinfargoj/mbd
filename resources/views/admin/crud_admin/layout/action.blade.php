<div class="d-flex btn-icon-list">
    <a class="d-flex flex-column align-items-center" href="{{ route('layouts.show',$layout_data->id) }}"><span
                class="btn-icon btn-icon--view"><img src="{{ asset('/img/view-icon.svg')}}"></span>View</a>
    <a class="d-flex flex-column align-items-center" href="{{ route('layouts.edit', $layout_data->id) }}"><span
                class="btn-icon btn-icon--edit"><img src="{{ asset('/img/edit-icon.svg')}}"></span>Edit</a>
    <a class="d-flex flex-column align-items-center delete-layout" title="Delete" href="Javascript:void(0);" data-id="{{$layout_data->id}}"><span
                class="btn-icon btn-icon--delete"><img src="{{ asset('/img/delete-icon.svg')}}"></span>Delete</a>
</div>
