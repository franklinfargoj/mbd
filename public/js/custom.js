$(document).ready(function() {
  $("#boardForm").validate({
    // errorElement: "span",
    //errorClass : "text-red",
    rules:{
      board_name:"required"
    }
  });

  $("#departmentForm").validate({
    // errorElement: "span",
    //errorClass : "text-red",
    rules:{
      department_name:"required",
    }
  });

  $("#add_resolutionForm").validate({
    // errorElement: "span",
    //errorClass : "text-red",
    rules:{
      board: "required",
      department: "required",
      resolution_type: "required",
      resolution_code: "required",
      title: "required",
      description: "required",
      file: "required",
      language: "required",
      published_date: "required",
      revision_log_message: "required",
    }
  });

  $("#edit_resolutionForm").validate({
    // errorElement: "span",
    //errorClass : "text-red",
    rules:{
      board: "required",
      department: "required",
      resolution_type: "required",
      resolution_code: "required",
      title: "required",
      description: "required",
      file: "required",
      language: "required",
      published_date: "required",
      revision_log_message: "required",
    }
  });

  $("#addHearingForm").validate({
      rules:{
          preceding_officer_name: "required",
          case_year: "required",
          case_number: "required",
          application_type_id: "required",
          applicant_name: "required",
          applicant_mobile_no: {
              required: true,
              minlength: 10,
              maxlength: 10,
              number: true
          },
          applicant_address: "required",
          respondent_name: "required",
          respondent_mobile_no: {
              required: true,
              minlength: 10,
              maxlength: 10,
              number: true
          },
          respondent_address: "required",
          case_type: "required",
          office_year: "required",
          office_number: {
              required: true,
              minlength: 10,
              maxlength: 10,
              number: true
          },
          office_date: "required",
          office_tehsil: "required",
          office_village: "required",
          office_remark: "required",
          department_id: "required",
          hearing_status_id: "required"
      }
  });

    $("#editHearingForm").validate({
        rules:{
            preceding_officer_name: "required",
            case_year: "required",
            application_type_id: "required",
            applicant_name: "required",
            applicant_mobile_no: {
                required: true,
                minlength: 10,
                maxlength: 10,
                number: true
            },
            applicant_address: "required",
            respondent_name: "required",
            respondent_mobile_no: {
                required: true,
                minlength: 10,
                maxlength: 10,
                number: true
            },
            respondent_address: "required",
            case_type: "required",
            office_year: "required",
            office_number: {
                required: true,
                minlength: 10,
                maxlength: 10,
                number: true
            },
            office_date: "required",
            office_tehsil: "required",
            office_village: "required",
            office_remark: "required",
            department_id: "required",
            hearing_status_id: "required"
        }
    });



    $("#createHearingSchedule").validate({
        rules: {
            preceding_number: "required",
            preceding_date: "required",
            preceding_time: "required",
            description: "required",
            update_status: "required",
        }
    });

    $("#prePostSchedule").validate({
        rules: {
            date: "required",
            description: "required",
        }
    });

    $("#uploadCaseJudgement").validate({
        rules: {
            description: "required",
            upload_judgement_case: {
                required: true,
            },
        }
    });

    $("#forwardCase").validate({
        rules: {
            board: "required",
            department: "required",
            description: "required",
        }
    })



  if($("#frontEndRegisterForm").length > 0)
  {
    $("#frontEndRegisterForm").validate({
      rules:{
        name:"required",
        address:"required",
        mobile_no:{
                required: true,
                minlength: 10,
                maxlength: 10,
                number: true
            },
        email:{
                required: true,
                email: true,
              }
      }
    });
  }

  if($("#frontEndRegisterForm").length > 0)
  {
    $("#frontEndRegisterForm").validate({
      rules:{
        name:"required",
        address:"required",
        mobile_no:{
                required: true,
                minlength: 10,
                maxlength: 10,
                number: true
            },
        email:{
                required: true,
                email: true,
              }
      }
    });
  }

  if($("#faqMasterForm").length > 0)
  {
    $("#faqMasterForm").validate({
      rules:{
        question:"required",
        answer:"required",
        status:"required",
      }
    });
  }

  $("#frontendRtiForm").validate({
    rules:{
      board_id:"required",
      department_id:"required",
      fullname:"required",
      address:"required",
      info_subject:"required",
      info_period_from:"required",
      info_period_to:"required",
      info_descr:"required",
      info_post_or_person:"required",
      info_post_type: {
          required: "#rtiInfoRespondRadios:checked"
      },
      applicant_below_poverty_line:"required",
      poverty_line_proof_file: {
          required: "#rtiPovertyLineRadios:checked",
      }
    },
    errorPlacement: function(error, element) {
     console.log(error);
     console.log(element);
   }
  });

  $(document).on('change','#rtiInfoRespondRadios',function(){
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

// function generateDataTable(url)
// {
//     $('.datatable').DataTable({
//         processing: true,
//         serverSide: true,
//         ajax: url,
//         columnDefs: [{
//             targets: ['sr_no', 'sr_no1', 'sr_no2', 'sr_no3', 'sr_no4', 'sr_no5', 'sr_no6'],
//             className: 'mdl-data-table__cell--non-numeric'
//         }]
//     });
// }
