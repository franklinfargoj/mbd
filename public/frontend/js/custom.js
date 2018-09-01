$(document).ready(function(){
	$('#rti_frontend_register').validate({
		rules:{
			username:{
				required:true
			},
			address:{
				required:true
			},
			mobile_no:{
				required:true
			},
			email:{
				required:true,
				email:true
			},
		},
		messages:{
			username:{
				required:"Please enter your name"
			},
			address:{
				required:"Please enter your address"
			},
			mobile_no:{
				required:"Please enter your mobile number"
			},
			email:{
				required:"Please enter your email address",
				email:"Please enter valid email address"
			},
		}
	});


});