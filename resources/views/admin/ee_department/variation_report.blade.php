
<html>
<h3> Variation in Consent Varification :</h3>
<table class="table mb-0 table--box-input" cellspacing="0" cellpadding="0" border="1" style="border-collapse: collapse; border-spacing: 0;width:100%">

@if($report)
  <tr>
    <th style="width:5%;">#</th>
    <th style="width:40%;font-size: 15px">मुद्दा / तपशील</th> 
    <th style="width:20%;font-size: 15px">होय / नाही</th>
    <th style="width:40%;font-size: 15px">शेरा</th>
  </tr>
  @php $i=1; @endphp
	@foreach($report as $data)
	
	  <tr>
	    <td style="padding-left: 10px">{{$i}}</td>
	    <td style="font-size: 15px;padding-left: 10px">
	    {{ isset($data->consentQuestions->question) ? $data->consentQuestions->question : '' }}</td> 
	    <td style="padding-left: 10px">
		    @if(isset($data->answer) && $data->answer == 1)
		    	<span>होय</span>
		   	@else
		   		<span>नाही</span>
		   	@endif 	
	    </td>
	    <td style="font-size: 15px;padding-left: 10px;padding-right: 10px">
	    {{ isset($data->remark) ? $data->remark : '' }}</td>
	  </tr>
	  @php $i++; @endphp
	@endforeach
@endif
</table>
</html>