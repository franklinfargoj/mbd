<div class="d-flex btn-icon-list">
    <a class="d-flex flex-column align-items-center" href="{{ route('society_detail.show', $society_data->id) }}"><span
            class="btn-icon btn-icon--view"><img src="{{ asset('/img/view-icon.svg')}}"></span>View</a>
    <a class="d-flex flex-column align-items-center" href="{{ route('society_detail.edit', $society_data->id) }}"><span
            class="btn-icon btn-icon--edit"><img src="{{ asset('/img/edit-icon.svg')}}"></span>Edit</a>
    <a class="d-flex flex-column align-items-center" href="{{ route('lease_detail.index', encrypt($society_data->id)) }}"><span
                class="btn-icon btn-icon--delete"><i style="color: #fff;" class="fa fa-file-text-o lease-icon"></i></span>Lease</a>
    {{--<a title="Delete" href="Javascript:void(0);" onclick="deleteVillage({{$society_data->id}});">Delete</a>--}}
</div>
