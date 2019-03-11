
<html>
<div class="consent">
<h3> Variation in NOC REE Scrutiny :</h3>
<table class="table mb-0 table--box-input" cellspacing="0" cellpadding="0" border="1" style="border-collapse: collapse; border-spacing: 0;width:100%">

@if($validReport)
  <tr>
    <th style="width:8%;">Sr.no</th>
    <th style="width:40%;font-size: 15px">Topics</th> 
    <th style="width:20%;font-size: 15px">Yes / No</th>
    <th style="width:40%;font-size: 15px">Comments</th>
  </tr>
  @php $i=1; @endphp
	@foreach($validReport as $data)	
	  <tr>
	    <td style="padding-left: 10px">{{$i}}</td>
	    <td style="font-size: 15px;padding-left: 10px">
	    {{ isset($data->scrutinyQuestions) ? $data->scrutinyQuestions->question : '' }}</td> 
	    <td style="padding-left: 10px">
		    @if(isset($data->answer) && $data->answer == 1)
		    	<span>Yes</span>
		   	@else
		   		<span>No</span>
		   	@endif 	
	    </td>
	    <td style="font-size: 15px;padding-left: 10px;padding-right: 10px">
	    {{ isset($data->remark) ? $data->remark : '' }}</td>
	  </tr>
	  @php $i++; @endphp
	@endforeach
@endif
</table>

<!-- yes answer -->
<table class="table mb-0 table--box-input" cellspacing="0" cellpadding="0" border="1" style="border-collapse: collapse; border-spacing: 0;width:100%;margin-top: 40px"> 

@if($IvalidReport)
  <tr>
    <th style="width:8%;">Sr. no</th> 
    <th style="width:40%;font-size: 15px">Topics</th> 
    <th style="width:20%;font-size: 15px">Yes / No</th>
    <th style="width:40%;font-size: 15px">Comments</th>
  </tr>
  @php $i=1; @endphp
 
	@foreach($IvalidReport as $data)
	
	  <tr>
	    <td style="padding-left: 10px">{{$i}}</td>
	    <td style="font-size: 15px;padding-left: 10px">
	    {{ isset($data->scrutinyQuestions) ? $data->scrutinyQuestions->question : '' }}</td> 
	    <td style="padding-left: 10px">
		    @if(isset($data->answer) && $data->answer == 1)
		    	<span>Yes</span>
		   	@else
		   		<span>No</span>
		   	@endif 	
	    </td>
	    <td style="font-size: 15px;padding-left: 10px;padding-right: 10px">
	    {{ isset($data->remark) ? $data->remark : '' }}</td>
	  </tr>
	  @php $i++; @endphp
	@endforeach
@endif
</table>
</div>
</html>