$(document).ready(function(){
	$(document).on('change','#rtiInfoRespondRadios',function(){
		console.log($("input[name='info_post_or_person']:checked"). val());
    if($("input[name='info_post_or_person']:checked"). val()==1)
    {
        $("#infoPostTypeFormgroup").show();
    }
    else{
        $("#infoPostTypeFormgroup").hide();
    }
  });

  $(document).on('change',"input[name='applicant_below_poverty_line']",function(){
    if($("input[name='applicant_below_poverty_line']:checked"). val()==1)
    {
        $("#povertyLineProofFile").show();
    }
    else{
        $("#povertyLineProofFile").hide();
    }
  });

});