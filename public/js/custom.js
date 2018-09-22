$(document).ready(function() {

    //toggle password
    $(".toggle-password").click(function() {

        $(this).toggleClass("fa-eye fa-eye-slash");
        var input = $($(this).attr("toggle"));
        if (input.attr("type") == "password") {
          input.attr("type", "text");
        } else {
          input.attr("type", "password");
        }
      });

    // Initializing date picker

    $(".m_datepicker").datepicker({
        todayHighlight: !0,
        templates: {
            leftArrow: '<i class="la la-angle-left"></i>',
            rightArrow: '<i class="la la-angle-right"></i>'
        },
        autoclose: true,
        format: 'dd-mm-yyyy'
    })

    // Custom select box for data tables

    $(".dataTables_wrapper select").addClass("m-bootstrap-select m_selectpicker form-control--custom");

    // Show uploaded file name inside label

  $('.custom-file-input').change(function (e) {
      $(this).parents('.custom-file').find('.custom-file-label').text(e.target.files[0].name);
      console.log(document.querySelector(".custom-file-label"));
      console.log("file", e.target.files[0].name)
  });

  //Tabbed Content

  var tabs = document.querySelector('.tabs');
  var tabsList = document.querySelectorAll('.tabs li');
  var panels = document.querySelectorAll('.panel');
  if(tabs) {
      tabs.addEventListener('click', function(e) {
          if(e.target.tagName == 'A'){
              var targetPanel = document.querySelector(e.target.parentElement.dataset.target);
              Array.from(tabsList).forEach(function(item){
                  if(item.classList.contains("active")) {
                      item.classList.remove("active");
                  }
              });
              e.target.parentElement.classList.add("active");
              Array.from(panels).forEach(function(panel) {
                  if(panel == targetPanel){
                      panel.classList.add('active');
                  }else{
                      panel.classList.remove('active');
                  }
              });
          }
      });
  }

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
      language: "required",
      published_date: "required",
      revision_log_message: "required",
      file: {
        extension : "pdf",
        required  : function(element) {
                      if ($("#File_name").text() == ""){
                          return true;
                      } else {
                          return false;
                      }
                    }
      },      
    },
    messages : {
      file : {
        extension : "The file must be a file of type: pdf."
      }
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
                extension: "pdf"
            },
        },
        messages:{
            upload_judgement_case: {
                extension: "Only pdf format allowed"
            }
        }
    });

    $("#editUploadCaseJudgement").validate({
        rules: {
            description: "required",
        }
    });

    $("#forwardCase").validate({
        rules: {
            board: "required",
            department: "required",
            description: "required",
        }
    });

    $("#sendNoticeToAppellant").validate({
        rules: {
            upload_notice: {
                required: true,
                extension: "pdf"
            },
            comment: "required",
        },
        messages: {
            upload_notice: {
                extension: "Only pdf allowed"
            }
        }
    });

    $("#editSendNoticeToAppellant").validate({
        rules: {
            comment: "required",
        }
    });



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
  
  $(document).on('change',"input[name='info_post_or_person']",function(){
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

  $("#DeleteVillageReason").validate({
    rules : {
      delete_message : "required",
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


// var verificationTab = document.querySelector("#verification");
// var demarcationTab = document.querySelector("#demarcation");
// var titbitTab = document.querySelector("#titbit");
// var relocationTab = document.querySelector("#relocation");

// var scrunityCheckDate = document.querySelector("#scrunity-check-date");
// var scrunityPlaceDate = document.querySelector("#scrunity-place-date");

// var scrunityTabs = document.querySelector("#scrunity-tabs li");

// console.log("run");

// scrunityTabs.addEventListener("click", function() {
//     debugger;
//     if(verificationTab.classList.contains("active")) {
//         scrunityPlaceDate.style.display = "none";
//     } else {
//         scrunityPlaceDate.style.display = "block";
//     }
    
//     if(demarcationTab.classList.contains("active") || titbitTab.classList.contains("active") || relocationTab.classList.contains("active")) {
//         scrunityCheckDate.style.display = "block";
//     } else {
//         scrunityCheckDate.style.display = "none";
//     }
// });


// tabbed content inner

// const tabsInner = document.querySelector('.tabs-inner');
// const panelsInner = document.querySelectorAll('.panel-inner');
// tabsInner.addEventListener('click', (e) => {
//   if(e.target.tagName == 'LI'){
//     const targetPanel = document.querySelector(e.target.dataset.target);
//     Array.from(panelsInner).forEach((panels) => {
//       console.log(panels);
//       if(panels == targetPanel){
//         panels.classList.add('active');
//       }else{
//         panels.classList.remove('active');
//       }
//     });
//   }
// });
