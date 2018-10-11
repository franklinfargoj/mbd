// $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
//     var hash = $(e.target).attr('href');
//     if (history.pushState) {
//       history.pushState(null, null, hash);
//     } else {
//       location.hash = hash;
//     }
//   });
  
//   var hash = window.location.hash;
//   if (hash) {
//     $('.nav-link[href="' + hash + '"]').tab('show');
// }

$(document).ready(function () {

    //toggle password
    $(".toggle-password").click(function () {

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
    $("#dataTableBuilder_filter input").addClass("form-control--custom");

    // Show uploaded file name inside label

    $('.custom-file-input').change(function (e) {
        $(this).parents('.custom-file').find('.custom-file-label').text(e.target.files[0].name);
        console.log(document.querySelector(".custom-file-label"));
        console.log("file", e.target.files[0].name)
    });

    // store the currently selected tab in the hash value
    // $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) { location.replace($(e.target).attr("href")); });
    // // switch to the currently selected tab when loading the page
    // $('.nav-tabs a[href="' + window.location.hash + '"]').tab('show');

    // $('a[data-toggle="tab"]').on('click', function (e) {

    //     var theTabId = $(this).attr('href');
    //     var activeTabs = (window.localStorage.getItem('activeTab') ? window.localStorage.getItem('activeTab').split(',') : []);

    //     var $sameLevelTabs = $(e.target).parents('.nav-tabs').find('[data-toggle="tab"]');

    //     $.each($sameLevelTabs, function (index, element) {
    //         var tabId = $(element).attr('href');
    //         if (theTabId != tabId && activeTabs.indexOf(tabId) !== -1) {
    //             activeTabs.splice(activeTabs.indexOf(tabId), 1);
    //         }
    //     });

    //     //unique tabs
    //     if (activeTabs.indexOf($(e.target).attr('href')) === -1) {
    //         activeTabs.push($(e.target).attr('href'));
    //     }

    //     window.localStorage.setItem('activeTab', activeTabs.join(','));

    // });

    // var activeTabs = window.localStorage.getItem('activeTab');
    // if (activeTabs) {
    //     var activeTabs = (window.localStorage.getItem('activeTab') ? window.localStorage.getItem('activeTab').split(',') : []);
    //     $.each(activeTabs, function (index, element) {
    //         $('[data-toggle="tab"][href="' + element + '"]').tab('show');
    //     });
    // }

    

    //Tabbed Content

    var tabs = document.querySelector('.tabs');
    var tabsList = document.querySelectorAll('.tabs li');
    var panels = document.querySelectorAll('.panel');
    if (tabs) {
        tabs.addEventListener('click', function (e) {
            if (e.target.tagName == 'A') {
                var targetPanel = document.querySelector(e.target.parentElement.dataset.target);
                Array.from(tabsList).forEach(function (item) {
                    if (item.classList.contains("active")) {
                        item.classList.remove("active");
                    }
                });
                e.target.parentElement.classList.add("active");
                Array.from(panels).forEach(function (panel) {
                    if (panel == targetPanel) {
                        panel.classList.add('active');
                    } else {
                        panel.classList.remove('active');
                    }
                });
            }
        });
    }

    $('.show_actions').on('click', function(){
        var view_route = $(this).attr('data-value');
        window.location = view_route;
    });

    $("#boardForm").validate({
        // errorElement: "span",
        //errorClass : "text-red",
        rules: {
            board_name: "required"
        }
    });

    $("#departmentForm").validate({
        // errorElement: "span",
        //errorClass : "text-red",
        rules: {
            department_name: "required",
        }
    });

    $("#add_resolutionForm").validate({
        // errorElement: "span",
        //errorClass : "text-red",
        rules: {
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
        rules: {
            board: "required",
            department: "required",
            resolution_type: "required",
            resolution_code: "required",
            title: "required",
            description: "required",
            language: "required",
            published_date: "required",
            revision_log_message: "required",
            //   file: {
            //     extension : "pdf",
            //     required  : function(element) {
            //                   if ($("#File_name").text() == ""){
            //                       return true;
            //                   } else {
            //                       return false;
            //                   }
            //                 }
            //   },      
        },
        messages: {
            file: {
                extension: "The file must be a file of type: pdf."
            }
        }
    });

    $("#addHearingForm").validate({
        rules: {
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
        rules: {
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
            preceding_number: {
                required: true,
                number: true
            },
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
        messages: {
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
            user: "required"
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



    if ($("#frontEndRegisterForm").length > 0) {
        $("#frontEndRegisterForm").validate({
            rules: {
                name: "required",
                address: "required",
                mobile_no: {
                    required: true,
                    minlength: 10,
                    maxlength: 10,
                    number: true
                },
                email: {
                    required: true,
                    email: true,
                }
            }
        });
    }

    if ($("#frontEndRegisterForm").length > 0) {
        $("#frontEndRegisterForm").validate({
            rules: {
                name: "required",
                address: "required",
                mobile_no: {
                    required: true,
                    minlength: 10,
                    maxlength: 10,
                    number: true
                },
                email: {
                    required: true,
                    email: true,
                }
            }
        });
    }

    if ($("#faqMasterForm").length > 0) {
        $("#faqMasterForm").validate({
            rules: {
                question: "required",
                answer: "required",
                status: "required",
            }
        });
    }

    $("#frontendRtiForm").validate({
        rules: {
            board_id: "required",
            department_id: "required",
            fullname: "required",
            address: "required",
            info_subject: "required",
            info_period_from: "required",
            info_period_to: "required",
            info_descr: "required",
            info_post_or_person: "required",
            info_post_type: {
                required: "#rtiInfoRespondRadios:checked"
            },
            applicant_below_poverty_line: "required",
            poverty_line_proof_file: {
                required: "#rtiPovertyLineRadios:checked",
            }
        },
        errorPlacement: function (error, element) {
            console.log(error);
            console.log(element);
        }
    });

    $(document).on('change', "input[name='info_post_or_person']", function () {
        if ($("input[name='info_post_or_person']:checked").val() == 1) {
            $("#infoPostTypeFormgroup").show();
        } else {
            $("#infoPostTypeFormgroup").hide();
        }
    });

    $(document).on('change', "input[name='applicant_below_poverty_line']", function () {
        if ($("input[name='applicant_below_poverty_line']:checked").val() == 1) {
            $("#povertyLineProofFile").show();
        } else {
            $("#povertyLineProofFile").hide();
        }
    });

    $("#DeleteVillageReason").validate({
        rules: {
            delete_message: "required",
        }
    });

    // Insert Records

    var dataRecords = document.getElementById("dataTableBuilder_length");
    var dataRecordsLabel = document.querySelector("#dataTableBuilder_length label");
    var dataPaginate = document.getElementById("dataTableBuilder_paginate");

    if (dataRecords) {
        dataRecords.parentElement.removeChild(dataRecords);
        dataPaginate.parentElement.parentElement.classList.add("align-items-center")
        dataPaginate.parentElement.classList.add("d-flex", "justify-content-end");
        dataPaginate.parentElement.insertBefore(dataRecords, dataPaginate);

        $(dataRecordsLabel).contents().filter(function() {
            return this.nodeType === 3; 
        }).remove();
    }

    // Insert SearchBox

    var dataSearch = document.getElementById("dataTableBuilder_filter");
    var dataSearchBoxPlacement = document.querySelector(".m-subheader.px-0.m-subheader--top .d-flex.align-items-center");

    if (dataSearch) {
        var dataSearchLabel = document.querySelector("#dataTableBuilder_filter label");
        $('#dataTableBuilder_wrapper input[type="search"]').attr('placeholder', 'Search');
        
        dataSearchBoxPlacement.appendChild(dataSearch);

        if(!dataSearch.previousElementSibling.classList.contains("btn-list")) {
            dataSearch.classList.add("ml-auto");
        }

        $(dataSearchLabel).contents().filter(function() {
            return this.nodeType === 3; 
        }).remove();
    }

    // console.log("input", dataSearch.querySelector("label input"));
    // dataSearch.querySelector("label input").addEventListener("keyup", function() {
    //     console.log("search", dataPaginate.children[0]);
    //     if(dataPaginate.children[0].getAttribute("style").indexOf("hidden") !== -1) {
    //         dataPaginate.children[0].style.display = "none";
    //     } else {
    //         dataPaginate.children[0].style.display = "";
    //     }
    // });

    //role validations

    $("#addrole").validate({
        // errorElement: "span",
        //errorClass : "text-red",
        rules: {
            name: "required",
            display_name: "required",
            description: "required",
            redirect_to: "required",
        }
    });

    $("#editrole").validate({
        // errorElement: "span",
        //errorClass : "text-red",
        rules: {
            name: "required",
            display_name: "required",
            description: "required",
            redirect_to: "required",
        }
    });

    $("#DeleteRoleReason").validate({
        rules: {
            delete_message: "required",
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
function geturl(view_route){
        console.log(view_route);
       // var view_route = $(this).attr('data-value');
        window.location = view_route; 
    }
