
<html>
<div class="consent">
<h3> Variation in Consent Varification :</h3>
<table class="table mb-0 table--box-input" cellspacing="0" cellpadding="0" border="1" style="border-collapse: collapse; border-spacing: 0;width:100%">

@if($report)
  <tr>
    <th style="width:8%;font-size: 14px">Sr.no</th>
    <th style="width:40%;font-size: 14px">मुद्दा / तपशील</th> 
    <th style="width:20%;font-size: 14px">होय / नाही</th>
    <th style="width:40%;font-size: 14px">शेरा</th>
  </tr>
  @php $i=1; @endphp
	@foreach($report as $data)
	
	  <tr>
	    <td style="padding-left: 10px;font-size: 14px">{{$i}}</td>
	    <td style="font-size: 20px;padding-left: 10px;font-size: 14px">
	    {{ isset($data->consentQuestions->question) ? $data->consentQuestions->question : '' }}</td> 
	    <td style="padding-left: 10px;font-size: 14px">
		   		<span>नाही</span>
	    </td>
	    <td style="font-size: 20px;padding-left: 10px;padding-right: 10px;font-size: 14px">
	    {{ isset($data->remark) ? $data->remark : '' }}</td>
	  </tr>
	  @php $i++; @endphp
	@endforeach
@endif
</table>

<!-- yes answer -->
<table class="table mb-0 table--box-input" cellspacing="0" cellpadding="0" border="1" style="border-collapse: collapse; border-spacing: 0;width:100%;margin-top: 40px"> 

@if($validReport)
  <tr>
    <th style="width:8%;">Sr. no</th> 
    <th style="width:40%;font-size: 15px">मुद्दा / तपशील</th> 
    <th style="width:20%;font-size: 15px">होय / नाही</th>
    <th style="width:40%;font-size: 15px">शेरा</th>
  </tr>
  @php $i=1; @endphp
 
	@foreach($validReport as $data)
	
	  <tr>
	    <td style="padding-left: 10px">{{$i}}</td>
	    <td style="font-size: 15px;padding-left: 10px">
	    {{ isset($data->consentQuestions->question) ? $data->consentQuestions->question : '' }}</td> 
	    <td style="padding-left: 10px">
		    	<span>होय</span>
	    </td>
	    <td style="font-size: 15px;padding-left: 10px;padding-right: 10px">
	    {{ isset($data->remark) ? $data->remark : '' }}</td>
	  </tr>
	  @php $i++; @endphp
	@endforeach
@endif
</table>
</div>
@if(isset($landDetails))
    <div class="demarcation" style="margin-top:500px">
    	<h3> Variation in Demarcation Varification :</h3>
    	<table class="table mb-0 table--box-input" cellspacing="0" cellpadding="0" border="1" style="border-collapse: collapse; border-spacing: 0;width:100%;margin-top: 40px">
         <tr>
                <th style="width:10%">Sr.no</th>
                <th style="width:40%;font-size: 15px">Area</th>
                <th style="width:40%;font-size: 15px">Value (sq.mt)</th>
            <tr>
                <tr>
                <td style="padding-left: 10px">1</td>
                <td style="padding-left: 10px">एकूण भूखंडाचे क्षेत्रफळ</td>
                <td style="padding-left: 10px">{{ isset($landDetails->total_area) ? $landDetails->total_area : '' }}</td>
                
                </tr>
                <tr>
                <td style="padding-left: 10px">1.a</td>

                <td style="padding-left: 10px">भाडेपट्टा करारनामा नुसार क्षेत्रफळ </td>
                <td style="padding-left: 10px">{{ isset($landDetails->lease_agreement_area) ? $landDetails->lease_agreement_area : '' }}</td>
            </tr> 
                                           
            <tr>
                 <td style="padding-left: 10px">1.b</td>    
                <td style="padding-left: 10px">टिट बिट भूखंडाचे क्षेत्रफळ  </td>
                <td style="padding-left: 10px">{{ isset($landDetails->tit_bit_area) ? $landDetails->tit_bit_area : '' }}</td>
            </tr>
            <tr>
                 <td style="padding-left: 10px">1.c</td>    
                <td style="padding-left: 10px">आर जी भूखंडाचे क्षेत्रफळ </td>
                <td style="padding-left: 10px">{{ isset($landDetails->rg_plot_area) ? $landDetails->rg_plot_area : '' }}</td>
            </tr>
            <tr>
                 <td style="padding-left: 10px">1.d</td>    
                <td style="padding-left: 10px">पि जि भूखंडाचे क्षेत्रफळ</td>
                <td style="padding-left: 10px">{{ isset($landDetails->pg_plot_area) ? $landDetails->pg_plot_area : '' }}</td>
            </tr>
            <tr>
                 <td style="padding-left: 10px">1.e</td>    
                <td style="padding-left: 10px">Road setback  area </td>
                <td style="padding-left: 10px">{{ isset($landDetails->road_setback_area) ? $landDetails->road_setback_area : '' }}</td>
            </tr>
            <tr>
                <td style="padding-left: 10px">1.f</td>    
                <td style="padding-left: 10px">Encroachment area</td>
                <td style="padding-left: 10px">{{ isset($landDetails->encroachment_area) ? $landDetails->encroachment_area : '' }}</td>
            </tr>
            <tr>
                 <td style="padding-left: 10px">1.g</td>    
                <td style="padding-left: 10px">O.B Building area </td>
                <td style="padding-left: 10px">{{ isset($landDetails->ob_building_area) ? $landDetails->ob_building_area : '' }}</td>

            </tr>
            <tr>
                 <td style="padding-left: 10px">1.h</td>    
                <td style="padding-left: 10px">इतर क्षेत्रफळ </td>
                <td style="padding-left: 10px">{{ isset($landDetails->another_area) ? $landDetails->another_area : '' }}</td>

            </tr>
               <tr>
                <td style="padding-left: 10px">2.</td>
                <td style="padding-left: 10px">अभिन्यासातील भूखंडाचे क्षेत्रफळ </td>
                <td style="padding-left: 10px">{{ isset($landDetails->stag_plot_area) ? $landDetails->stag_plot_area : '' }}</td>
            </tr> 
            </tr>
               <tr>
                <td style="padding-left: 10px">3.</td>
                <td style="padding-left: 10px:font-size:16px;"><b>Variation Area</b></td>
                <td style="padding-left: 10px">
                    @php 
                    $area = $landDetails->total_area - $landDetails->stag_plot_area;
                    @endphp

                    <b> {{isset($area) ? $area : '' }} </b>
               </td>
            </tr>  
            @if(isset($demQuestion) && $demQuestion->demarkDetails->answer == 1)
            <tr>
                <td style="padding-left: 10px">4.</td>
                <td style="padding-left: 10px">{{$demQuestion->question}}</td>
                <td style="padding-left: 10px">{{$demQuestion->demarkDetails->crz_area}}
               </td>
            </tr> 
            @endif 
        </table>
    </div>
@endif

@if(isset($dueDetails) && $dueDetails->noDuesDetails->answer == 0)
    <div class="" style="margin-top: 60px">
        <h3> Variation in No Due Certificate :</h3>
        <table class="table mb-0 table--box-input" cellspacing="0" cellpadding="0" border="1" style="border-collapse: collapse; border-spacing: 0;width:100%">
          <tr>
            <th style="width:8%;">Sr.no</th>
            <th style="width:40%;font-size: 15px">मुद्दा / तपशील</th> 
            <th style="width:20%;font-size: 15px">होय / नाही</th>
            <th style="width:40%;font-size: 15px">शेरा</th>
          </tr>
          <tr>
            <td style="padding-left: 10px">1</td>
            <td style="font-size: 15px;padding-left: 10px">
            {{ isset($dueDetails->question) ? $dueDetails->question : '' }}</td> 
            <td style="padding-left: 10px">
                    <span>नाही</span>
            </td>
            <td style="font-size: 15px;padding-left: 10px;padding-right: 10px">
            {{ isset($dueDetails->noDuesDetails) ? $dueDetails->noDuesDetails->remark : '' }}</td>
          </tr>
        </table>
    </div>    
@endif
</html>