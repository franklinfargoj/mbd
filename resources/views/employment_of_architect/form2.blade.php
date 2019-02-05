@extends('admin.layouts.sidebarAction')
@section('actions')
@include('employment_of_architect.actions',compact('application'))
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

<div class="col-md-12">
    <div class="d-flex form-steps-wrap">
        <a href="{{ route("appointing_architect.step1",['id'=>encrypt($application->id)]) }}" class="btn--unstyled flex-grow-1 form-step-tab active">Step
            1<span>Basic Details</span></a>
        <a href="{{ route("appointing_architect.step2",['id'=>encrypt($application->id)]) }}" class="btn--unstyled flex-grow-1 form-step-tab active">Step
            2<span>Enclosures</span></a>
        <a href="{{ route("appointing_architect.step3",['id'=>encrypt($application->id)]) }}" class="btn--unstyled flex-grow-1 form-step-tab">Step
            3<span>Details of Consultants</span></a>
        <a href="{{ route("appointing_architect.step4",['id'=>encrypt($application->id)]) }}" class="btn--unstyled flex-grow-1 form-step-tab">Step
            4<span>Important Projects</span></a>
        <a href="{{ route("appointing_architect.step5",['id'=>encrypt($application->id)]) }}" class="btn--unstyled flex-grow-1 form-step-tab">Step
            5<span>Work Handled</span></a>
        <a href="{{ route("appointing_architect.step6",['id'=>encrypt($application->id)]) }}" class="btn--unstyled flex-grow-1 form-step-tab">Step
            6<span>Details of Firm</span></a>
        <a href="{{ route("appointing_architect.step7",['id'=>encrypt($application->id)]) }}" class="btn--unstyled flex-grow-1 form-step-tab">Step
            7<span>Work In Hand</span></a>
        <a href="{{ route("appointing_architect.step8",['id'=>encrypt($application->id)]) }}" class="btn--unstyled flex-grow-1 form-step-tab">Step
            8<span>Works Completed</span></a>
        <a href="{{ route("appointing_architect.step9",['id'=>encrypt($application->id)]) }}" class="btn--unstyled flex-grow-1 form-step-tab ">Step
            9<span>Supporting Documents</span></a>
    </div>
    <div class="m-portlet m-portlet--mobile m-portlet--forms-view m-portlet--forms-compact">
        <div class="m-portlet__body m-portlet__body--table">
            <h3 class="section-title section-title--small">EMPANELMENT OF ARCHITECT/CONSULTANT WITH MHADA</h3>
            <form id="appointing_architect_step2" role="form" method="post" class="m-form m-form--rows m-form--label-align-right"
                action="{{route('appointing_architect.step2_post',['id'=>encrypt($application->id)])}}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="application_id" value="{{$application->id}}">
                {{-- @include('employment_of_architect.partial_personal_details',compact('application'))
                @include('employment_of_architect.partial_payment_details',compact('application')) --}}
                {{-- <div class="m-portlet__head px-0 m-portlet__head--top">
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
                </div> --}}
                @php
                $enclosuers_count=0;
                $enclosuers_count=$application->enclosures->count();
                $enclosuers_count=$enclosuers_count>4?$enclosuers_count:4;
                @endphp
                <div class="form-group m-form__group row">
                    <div class="loader" style="display:none;"></div>
                    <table class="table enclosuers">
                        <thead>
                            <tr>
                                <th>Enclosure Name</th>
                                <th>Upload File</th>
                            </tr>
                            <thead>
                            <tbody>
                                @for($i=0;$i<$enclosuers_count;$i++) <tr class="cloneme">
                                    <td>
                                        <div class="form-group">
                                            {{-- <label class="mb-0 mr-4 font-weight-semi-bold sr_no" for="">{{$i+1}}.</label>
                                            --}}
                                            <input type="hidden" id="enclosure_id_{{$i}}" name="enclosure_id[{{$i}}]"
                                                value="{{isset($application->enclosures[$i])?$application->enclosures[$i]->id:''}}">
                                            <input type="text" id="" name="enclosures[{{$i}}]" class="form-control form-control--custom m-input w-100"
                                                value="{{isset($application->enclosures[$i])?$application->enclosures[$i]->enclosure:''}}">
                                            <span class="help-block"></span>

                                        </div>
                                    </td>
                                    <td>
                                        @php
                                        $file="";
                                        $file=isset($application->enclosures)?$application->enclosures[$i]->file:'';
                                        @endphp
                                        <div class="custom-file mb-0 form-group">
                                            <input data-file-type="enclosures" accept="pdf" title="please upload file with pdf extension"
                                                type="file" id="extract_enclosure_file_{{$i}}" name="enclosure_file[{{$i}}]"
                                                class="custom-file-input" onChange="upload_enclosure_file(this)">
                                            <label title="" class="custom-file-label" for="extract_enclosure_file_{{$i}}">Choose
                                                File...</label>
                                            <span class="help-block"></span>
                                        </div>
                                        <a id="enclosure_file_link_{{$i}}" style="display:{{$file!=''?'block':'none'}}"
                                            target="_blank" class="btn-link download-row" href="{{config('commanConfig.storage_server').'/'.$file}}">download</a>
                                        @if($i>3)
                                        <h2 class='m--font-danger remove-row'><i title='Delete' class='fa fa-remove'></i></h2>
                                        @endif
                                    </td>
                                    </tr>
                                    @endfor
                            </tbody>
                    </table>
                </div>
                <div class="form-group">
                    <a id="add-more" class="btn--add-delete add">add more<a>
                </div>

                <div class="m-checkbox-list mt-2">
                    <div class="d-flex">
                        <span class="star">*</span>
                        <label class="m-checkbox m-checkbox--primary ml-3">
                            <input {{$application->application_info_and_its_enclosures_verify==1?"checked":""}} type="checkbox"
                                name="application_info_and_its_enclosures_verify" value="1"> Above mentioned details is
                            verified by
                            me & correct
                            as per my knowledge
                            <span class=""></span>
                        </label>
                        @if ($errors->has('application_info_and_its_enclosures_verify'))
                        <span class="text-danger">{{ $errors->first('application_info_and_its_enclosures_verify') }}</span>
                        @endif
                    </div>
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
</div>

@endsection
@section('js')
<script>
    function upload_enclosure_file(e) {
        $(".loader").show();
        var file_id = e.getAttribute('id');

        var get_index = file_id.split('_');
        get_index = get_index[get_index.length - 1];

        var file_data = $('#' + file_id).prop('files')[0];
        var enclosure_id = $('#' + 'enclosure_id_' + get_index).val();
        var file_type = e.getAttribute('data-file-type');

        var form_data = new FormData();
        form_data.append('file', file_data);
        form_data.append('enclosure_id', enclosure_id);
        form_data.append('field_name', file_type);

        $.ajaxSetup({
            headers: {
                'X-CSRF-Token': '{{csrf_token()}}'
            }
        });
        $.ajax({
            url: "{{route('appointing_architect.upload_enclosure_file')}}",
            data: form_data,
            type: 'POST',
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                $(".loader").hide();
                $('.custom-file-label').each(function (index, label) {
                    if(index==get_index)
                    {
                        var newCount = get_index;
                        if (label.getAttribute('for').indexOf('enclosure') !== -1) {
                            label.setAttribute('for', 'extract_enclosure_' + newCount);

                            label.textContent = "Choose File...";
                            var customFileWrap = $(label.closest('.form-group'));

                            if (customFileWrap.hasClass('has-success')) {
                                customFileWrap.removeClass('has-success');
                            }
                        }
                    } 
                });
                if (data.status == true) {
                    if (file_type == 'enclosures') {
                        $("#enclosure_file_link_" + get_index).prop("href", data.file_path)
                        $("#enclosure_file_link_" + get_index).css("display", "block");
                    }
                } else {
                    //console.log(data.status+" "+data.message)
                }
            }
        });
    }
    $(document).ready(function () {
        $('#add-more').click(function (e) {
            e.preventDefault();
            var application_id = $('input[name=application_id]').val();
            var count = $('.cloneme').length;
            // alert(count)
            var clone = $('.enclosuers .cloneme:first').clone().find('input').val('').end();
            clone.find('input[name="enclosure_id[0]"]')[0].setAttribute('id', 'enclosure_id_' + count)
            clone.find('input[name="enclosure_id[0]"]')[0].setAttribute('name', 'enclosure_id[' + count +
                ']')
            clone.find('input[name="enclosures[0]"]')[0].setAttribute('name', 'enclosures[' + count +
                ']')
            clone.find('.custom-file-input').each(function (index, input) {
                var newCount = count;
                if (input.getAttribute('id').indexOf('enclosure_file') !== -1) {
                    input.setAttribute('id', 'extract_enclosure_file_' + newCount);
                    input.setAttribute('name', 'enclosure_file[' + newCount + ']');
                    input.setAttribute('accept', 'pdf')
                    // input.setAttribute('required', 'required');
                }
            });

            // var uploadLabel = clone.find('.custom-file-label');

            clone.find('#enclosure_file_link_0')[0].style.display = "none";
            clone.find('#enclosure_file_link_0')[0].setAttribute('id', 'enclosure_file_link_' + count);


            clone.find('.custom-file-label').each(function (index, label) {
                var newCount = count;
                if (label.getAttribute('for').indexOf('enclosure_file') !== -1) {
                    label.setAttribute('for', 'extract_enclosure_file_' + newCount);
                }

                label.textContent = "Choose File...";

                var customFileWrap = $(label.closest('.form-group'));

                if (customFileWrap.hasClass('has-success')) {
                    customFileWrap.removeClass('has-success');
                }
            });
            //clone.find('.sr_no').html(count + '.')
            clone.find("td:last").append(
                "<h2 class='m--font-danger remove-row'><i title='Delete' class='fa fa-remove'></i></h2>");
            $('.enclosuers').append(clone);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-Token': '{{csrf_token()}}'
                }
            });
            var thisInstance = $(this);
            $.ajax({
                url: "{{route('appointing_architect.add_enclosure')}}",
                method: 'POST',
                data: {
                    application_id: application_id
                },
                success: function (data) {
                    if (data.status == 0) {
                        console.log(count);
                        clone.find('input[name="enclosure_id[' + count + ']"]')[0].setAttribute(
                            'value', data.enclosure_id)
                        $('table.enclosuers').append(clone);
                        showUploadedFile();
                    } else {
                        alert('something went wrong');
                    }
                }
            })
        });

        $('.enclosuers').on('click', '.fa-remove', function () {
            var delete_id = $(this).closest('tr').find('input')[0].value;
            if (delete_id != "") {
                if (confirm('are you sure?')) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-Token': '{{csrf_token()}}'
                        }
                    });
                    var thisInstance = $(this);
                    $.ajax({
                        url: "{{route('appointing_architect.delete_enclosure')}}",
                        method: 'POST',
                        data: {
                            delete_enclosure: delete_id
                        },
                        success: function (data) {
                            //console.log(data);
                            if (data.status == 0) {
                                thisInstance.closest('td').parent().remove()
                            } else {
                                alert('something went wrong');
                            }
                        }
                    })
                }
            } else {
                $(this).closest('td').parent().remove()
            }

        })
    })



    function showUploadedFile() {
        $('.custom-file-input').change(function (e) {
            $(this).parents('.custom-file').find('.custom-file-label').text(e.target.files[0].name);
        });
    }

</script>
@endsection
