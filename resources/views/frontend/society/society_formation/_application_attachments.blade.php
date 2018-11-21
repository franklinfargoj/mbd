<table class="table">
    @php $i=1; @endphp
<input type="hidden" name="sf_application_id" id="sf_application_id" value="{{$sf_application->id}}">
    @foreach ($sf_documents as $item)
    <tr>
        <th>{{$i}}</th>
        <th style="width:30%">{{$item->document_name}}</th>
        <td style="width:30%">
            <div class="custom-file mb-0">
            <input type="hidden" id="document_status_id_{{$i}}" name="document_status_id_[{{$i}}]" value="{{$item->sf_document_status!=""?$item->sf_document_status->id:0}}">
                <input type="hidden" id="master_document_id_{{$i}}" name="master_document_id_[{{$i}}]" value="{{$item->id}}">
                <input onchange="upload_attachment(this.id,{{$i}})" accept="pdf" title="please upload file with pdf extension" type="file" id="extract_{{$i}}" name="document_path[{{$i}}]"
                    class="custom-file-input">
                <label title="" class="custom-file-label" for="extract_{{$i}}">Choose
                    File...</label>
                <span class="help-block"></span>
                
            </div>
        </td>
        <td style="width:35%">
                @php
                $file="";
                $file=$item->sf_document_status!=""?$item->sf_document_status->document_path:'';
                @endphp
            <a style="display:{{$file!=""?'block':'none'}}" target="_blank" id="uploaded_file_{{$i}}" class="btn-link" href="">download</a>
            {{-- <a class="btn-link" target="_blank" style="display:none;" id="uploaded_file_{{$i}}" href="">download</a> --}}
            <span class="text-danger" id="sf_doc_error_{{$i}}"></span>
        </td>
    </tr>
    @php $i++; @endphp
    @endforeach
</table>
