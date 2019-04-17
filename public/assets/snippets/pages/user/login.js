var SnippetLogin = function() {
    jQuery.validator.addMethod("lettersonly", function(value, element) {
        return this.optional(element) || /^[a-z\s]+$/i.test(value);
    }, "Only alphabetical characters");

    var e = $("#m_login"),
        i = function(e, i, a) {
            var t = $('<div class="m-alert m-alert--outline alert alert-' + i + ' alert-dismissible" role="alert">\t\t\t<button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>\t\t\t<span></span>\t\t</div>');
            e.find(".alert").remove(), t.prependTo(e), t.animateClass("fadeIn animated"), t.find("span").html(a)
        },
        a = function() {
            e.removeClass("m-login--forget-password"), e.removeClass("m-login--signin"), e.addClass("m-login--signup"), e.find(".m-login__signup").animateClass("flipInX animated")
        },
        t = function() {
            e.removeClass("m-login--forget-password"), e.removeClass("m-login--signup"), e.addClass("m-login--signin"), e.find(".m-login__signin").animateClass("flipInX animated")
        },
        r = function() {
            e.removeClass("m-login--signin"), e.removeClass("m-login--signup"), e.addClass("m-login--forget-password"), e.find(".m-login__forget-password").animateClass("flipInX animated")
        },
        n = function() {
            $("#m_login_forget_password").click(function(e) {
                e.preventDefault(), r()
            }), $("#m_login_forget_password_cancel").click(function(e) {
                e.preventDefault(), t()
            }), $("#m_login_signup").click(function(e) {
                e.preventDefault(), a()
            }), $("#m_login_signup_cancel").click(function(e) {
                e.preventDefault(), t()
            })
        },
        l = function() {
            $("#m_login_signin_submit").click(function(e) {
                e.preventDefault();
                var a = $(this),
                    t = $(this).closest("form");
                t.validate({
                    rules: {
                        email: {
                            required: !0,
                            email: !0
                        },
                        password: {
                            required: !0
                        },
                        capture_text : "required"
                    }
                }), t.valid() && (a.addClass("m-loader m-loader--right m-loader--light").attr("disabled", !0), setTimeout(function() {
                    $('#sign_in_form').submit();
                }, 500))
            })
        },
        s = function() {
            $("#m_login_signup_submit").click(function(a) {
                a.preventDefault();
                var r = $(this),
                    n = $(this).closest("form");
                n.validate({
                    rules: {
                        firstname: {
                            required: !0
                        },
                        lastname: {
                            required: !0
                        },
                        email: {
                            required: !0,
                            email: !0
                        },
                        mobilenumber: {
                            required: !0,
                            minlength: 10,
            				maxlength: 10,
            				number: true
                        },
                        password: {
                            required: !0,
                            minlength: 6,
                        },
                        rpassword: {
                            required: !0,
                            equalTo : "#password"
                        },
                        agree: {
                            required: !0
                        }
                    }
                }), n.valid() && (r.addClass("m-loader m-loader--right m-loader--light").attr("disabled", !0), 
                setTimeout(function() {
                    var email_val = $('#email_val').val();
                    $.ajax({
                       url : BASE_URL+'login/check_email_valid',
                       type: 'post', 
                       data: {email_val: email_val},
                       success: function(response){ 
                        if(response == '1')
                        {
                          $('#sign_up_form').submit();
                        }
                        else{
                            $('#email_error').show();
                            r.attr("disabled", false);
                            r.removeClass("m-loader m-loader--right m-loader--light");
                        }
                      }
                   }); 
                    //r.removeClass("m-loader m-loader--right m-loader--light").attr("disabled", !1), n.clearForm(), n.validate().resetForm(), t();
                    //a.clearForm(), a.validate().resetForm(), i(a, "success", "Thank you. To complete your registration please check your email.")
                }, 500))
            })
        },
        rti_registration = function() {
            $("#m_login_signin_submit_rti_registration").click(function(e) {
                e.preventDefault();
                var a = $(this),
                    t = $(this).closest("form");
                    // console.log(t)
                t.validate({
                    rules:{
                        name:{
                            required:true
                        },
                        address:{
                            required:true
                        },
                        mobile_no:{
                            required:true,
                            number:true,
                            minlength:10,
                            maxlength:10
                        },
                        email:{
                            required:true,
                            email:true
                        },
                    },
                    messages:{
                        name:{
                            required:"Please enter your name"
                        },
                        address:{
                            required:"Please enter your address"
                        },
                        mobile_no:{
                            required:"Please enter your mobile number",
                            number:"Please enter your valid mobile number",
                            minlength:"Enter a 10 digit mobile number",
                            maxlength:"Enter a 10 digit mobile number"
                        },
                        email:{
                            required:"Please enter your email address",
                            email:"Please enter valid email address"
                        },
                    }
                }), t.valid() && (a.addClass("m-loader m-loader--right m-loader--light").attr("disabled", !0), setTimeout(function() {
                    $('#rti_frontend_register').submit();
                }, 500))
            })
        },
        rti_application_form = function() {
            $("#m_login_signin_submit_rti_application").click(function(e) {
                e.preventDefault();
                var a = $(this),
                    t = $(this).closest("form");
                     
                t.validate({
                    rules:{
                        department_id:{
                            required:true
                        },
                        board_id:{
                            required:true
                        },
                        name:{
                            required:true
                        },
                        address:{
                            required:true
                        },
                        info_subject:{
                            required:true
                        },
                        info_period_from:{
                            required:true
                        },
                        info_period_to:{
                            required:true
                        },
                        info_descr:{
                            required:true
                        },
                        info_post_or_person:{
                            required:true
                        },
                        info_post_type:{
                            required: function(element) {
                                return $('#rtiInfoRespondRadios1').is(':checked')
                              }
                        },
                    }
                }), t.valid() && (a.addClass("m-loader m-loader--right m-loader--light").attr("disabled", !0), setTimeout(function() {
                    $('#rti_application_form').submit();
                }, 500))
            })
        },
        rti_application_status_check = function() {
            $("#rti_application_status_check").click(function(e) {
                e.preventDefault();
                var a = $(this),
                    t = $(this).closest("form");
                    // console.log(t)
                t.validate({
                    rules:{
                        application_no:{
                            required:true
                        },
                        email:{
                            required:true
                        }
                    }
                }), t.valid() && (a.addClass("m-loader m-loader--right m-loader--light").attr("disabled", !0), setTimeout(function() {
                    $('#rti_frontend_application_status_check').submit();
                }, 500))
            })
        },
        scoiety_offer_letter_forgot_password = function() {
            $("#m_login_forget_password_submit_society_offer_letter").click(function(e) {
                e.preventDefault();
                var a = $(this),
                    t = $(this).closest("form");
                    // console.log(t)
                t.validate({
                    rules:{
                        society_email:{
                            required:true,
                        }
                    }
                }), t.valid() && (a.addClass("m-loader m-loader--right m-loader--light").attr("disabled", !0), setTimeout(function() {
                    $('#society_forgot_password_form').submit();
                }, 500))
            })
        },
        scoiety_offer_letter = function() {
            $("#m_login_signup_submit_society_offer_letter").click(function(e) {

                e.preventDefault();
                var a = $(this),
                    // t = $(this).closest("form");
                    t = $("#sign_up_form_society_offer_letter");
                    console.log(t);
                t.validate({
                    rules:{
                        society_name:{
                            required:true,
                            lettersonly: true,
                        },
                        society_address:{
                            required:true
                        },
                        society_building_no:{
                            required:true,
                            // alphanumeric:true
                        },
                        society_registration_no:{
                            required:true,
                            // alphanumeric:true
                        },
                        society_username:{
                            required:true
                        },
                        society_email:{
                            required:true
                        },
                        society_contact_no:{
                            required:true,
                            number:true,
                            minlength:10,
                            maxlength:10
                        },
                        society_password:{
                            required:true,
                            minlength:6,
                            maxlength:10
                        },
                        conf_society_password:{
                            required:true,
                            minlength:6,
                            maxlength:10,
                            equalTo: "#password",
                        },
                        society_architect_name:{
                            required:true,
                            // lettersonly: true,
                        },
                        society_architect_mobile_no:{
                            required:true,
                            number:true,
                            minlength:10,
                            maxlength:10
                        },
                        society_architect_address:{
                            required:true
                        },
                        society_architect_telephone_no:{
                            required:true
                        },
                    },
                    messages:{
                        conf_society_password:{
                            equalTo:"Password doesn't match."
                        },
                        society_contact_no:{
                            number: 'Enter only Numeric Value',
                            minlength: 'Enter Only 10 Characters',
                            maxlength: 'Enter Only 10 Characters'
                        },
                        society_architect_mobile_no:{
                            number: 'Enter only Numeric Value',
                            minlength: 'Enter Only 10 Characters',
                            maxlength: 'Enter Only 10 Characters'
                        }
                    }
                }), t.valid() && (a.addClass("m-loader m-loader--right m-loader--light").attr("disabled", !0), setTimeout(function() {
                    $('#sign_up_form_society_offer_letter').submit();
                }, 500))
            })
        },
        add_village = function() {
            $("#add_village").click(function(e) {
                e.preventDefault();
                var a = $(this),
                    t = $(this).closest("form");
                t.validate({
                    rules: {
                        board_id: {
                            required: !0,
                        },
                        sr_no: {
                            required: !0,
                            number: true
                        },
                        village_name: {
                            required: !0
                        },
                        land_source_id: {
                            required: !0
                        },
                        land_address: {
                            required: !0
                        },
                        district: {
                            required: !0
                        },
                        taluka: {
                            required: !0,
                        },
                        total_area: {
                            required: !0,
                            number: true
                        },
                        possession_date: {
                            required: !0
                        },
                        remark: {
                            required: !0
                        },
                        land_cost: {
                            required: !0,
                            number: true
                        },
                        mhada_name: {
                            required: !0
                        },
                        property_card: {
                            required: !0
                        },
                        property_card_area: {
                            number: true,
                            required: true
                        },
                        property_card_mhada_name: {
                            required: !0
                        },
                        // mhada_name: {
                        //     required: !0
                        // },
                        extract: {
                            required: '.file_upload[value="1"]:checked',
                            accept: "pdf"
                        },
                        other_remark: {
                            required:function(element) {
                                return ($('#remark').val() == 'other');
                            }
                        },
                        other_land_source: {
                            required:function(element) {
                                return ($('#land_source_id').val() == 4);
                            }
                        }
                    },
                    messages: {
                        extract:{
                            accept: "Only pdf allowed",
                        }
                    }
                }), t.valid() && (a.addClass("m-loader m-loader--right m-loader--light").attr("disabled", !0), setTimeout(function() {
                    $('#addVillageDetail').submit();
                }, 500))
            })
        },

        edit_village = function() {
            $("#edit_village").click(function(e) {
                e.preventDefault();
                var a = $(this),
                    t = $(this).closest("form");
                t.validate({
                    rules: {
                        board_id: {
                            required: !0,
                        },
                        sr_no: {
                            required: !0,
                            number: true
                        },
                        village_name: {
                            required: !0
                        },
                        land_source_id: {
                            required: !0
                        },
                        land_address: {
                            required: !0
                        },
                        district: {
                            required: !0
                        },
                        taluka: {
                            required: !0,
                        },
                        total_area: {
                            required: !0,
                            number: true
                        },
                        possession_date: {
                            required: !0
                        },
                        remark: {
                            required: !0
                        },
                        land_cost: {
                            required: !0,
                            number: true
                        },
                        mhada_name: {
                            required: !0
                        },
                        property_card: {
                            required: !0
                        },
                        property_card_area: {
                            number: true,
                            required: true
                        },
                        property_card_mhada_name: {
                            required: !0
                        },
                        extract: {
                            required: function(element) {
                                console.log($('#extract').data('value'));

                                if($('#file_upload').is(':checked')){
                                    if($('#extract').data('value') != ''){
                                        return false;
                                    }
                                }else{
                                    return false;
                                }
                            },
                            accept: "pdf",
                        },
                        other_remark: {
                            required:function(element) {
                                return ($('#remark').val() == 'other');
                            }
                        },
                        other_land_source: {
                            required:function(element) {
                                return ($('#land_source_id').val() == 4);
                            }
                        }
                    },
                    messages: {
                        extract:{
                            accept: "Only pdf allowed",
                        }
                    }
                }), t.valid() && (a.addClass("m-loader m-loader--right m-loader--light").attr("disabled", !0), setTimeout(function() {
                    $('#editVillageDetail').submit();
                }, 500))
            })
        },

        add_society = function() {
            $("#add_society").click(function(e) {
                e.preventDefault();
                var a = $(this),
                    t = $(this).closest("form");
                t.validate({
                    rules: {
                        society_name: {
                            required: !0,
                        },
                        district: {
                            required: !0
                        },
                        taluka: {
                            required: !0
                        },
                        survey_number: {
                            required: !0,
                            number: true
                        },
                        cts_number: {
                            required: !0,
                            number: true
                        },
                        society_address: {
                            required: !0
                        },
                        area: {
                            required: !0,
                            number: true
                        },
                        date_on_service_tax: {
                            required: !0
                        },
                        surplus_charges: {
                            required: !0,
                            number: true
                        },
                        surplus_charges_last_date: {
                            required: !0
                        },
                        other_land_id: {
                            required: !0
                        },
                        society_reg_no: {
                            required: !0,
                        },
                        society_conveyed: {
                            required: !0
                        },
                        date_of_conveyance: {
                            required: '.society_conveyed[value="1"]:checked',
                        },
                        area_of_conveyance: {
                            number:true,
                            required: '.society_conveyed[value="1"]:checked',
                        },
                        village: {
                            required: !0
                        },
                        chairman_mob_no: {
                            minlength: 10,
                            maxlength: 10,
                            number: true
                        },
                        secretary_mob_no: {
                            minlength: 10,
                            maxlength: 10,
                            number: true
                        },
                        layout : {
                            required : true,
                        },
                        society_email_id: {
                            email: !0
                        },
                    },
                }), t.valid() && (a.addClass("m-loader m-loader--right m-loader--light").attr("disabled", !0), setTimeout(function() {
                    $('#addSocietyDetail').submit();
                }, 500))
            })
        },

        edit_society = function() {
            $("#edit_society").click(function(e) {
                e.preventDefault();
                var a = $(this),
                    t = $(this).closest("form");
                t.validate({
                    rules: {
                        society_name: {
                            required: !0,
                        },
                        district: {
                            required: !0
                        },
                        taluka: {
                            required: !0
                        },
                        survey_number: {
                            required: !0,
                            number: true
                        },
                        cts_number: {
                            required: !0,
                            number: true
                        },
                        
                        society_address: {
                            required: !0
                        },
                        area: {
                            required: !0,
                            number: true
                        },
                        date_on_service_tax: {
                            required: !0
                        },
                        society_email_id: {
                            email: !0
                        },
                        surplus_charges: {
                            required: !0,
                            number: true
                        },
                        surplus_charges_last_date: {
                            required: !0
                        },
                        other_land_id: {
                            required: !0
                        },
                        society_reg_no: {
                            required: !0,
                        },
                        society_conveyed: {
                            required: !0
                        },
                        date_of_conveyance: {
                            required: '.society_conveyed[value="1"]:checked',
                        },
                        area_of_conveyance: {
                            required: '.society_conveyed[value="1"]:checked',
                            number: true,
                        },
                        village: {
                            required: !0
                        },
                        chairman_mob_no: {
                            minlength: 10,
                            maxlength: 10,
                            number: true
                        },
                        secretary_mob_no: {
                            minlength: 10,
                            maxlength: 10,
                            number: true
                        },
                        layout : {
                            required : true,
                        }
                    }
                }), t.valid() && (a.addClass("m-loader m-loader--right m-loader--light").attr("disabled", !0), setTimeout(function() {
                    $('#editSocietyDetail').submit();
                }, 500))
            })
        },

        add_lease = function() {
            $("#add_lease, #renew_lease").click(function(e) {
                e.preventDefault();
                var a = $(this),
                    t = $(this).closest("form");
                t.validate({
                    rules: {
                        lease_rule_other: {
                            required: !0,
                            alphanumeric:true

                        },
                        lease_basis: {
                            required: !0,
                            alphanumeric:true
                        },
                        area: {
                            required: !0,
                            number: true
                        },
                        lease_period: {
                            required: !0
                        },
                        lease_start_date: {
                            required: !0
                        },
                        lease_rent: {
                            required: !0,
                            number: true
                        },
                        lease_rent_start_month: {
                            required: !0
                        },
                        interest_per_lease_agreement: {
                            required: !0
                        },
                        lease_renewal_date: {
                            required: !0
                        },
                        lease_renewed_period: {
                            required: !0
                        },
                        rent_per_renewed_lease: {
                            required: !0
                        },
                        interest_per_renewed_lease_agreement: {
                            required: !0
                        },
                        month_rent_per_renewed_lease: {
                            required: !0
                        }
                    }
                }), t.valid() && (a.addClass("m-loader m-loader--right m-loader--light").attr("disabled", !0), setTimeout(function() {
                    $('#addLeaseDetail, #renewLeaseDetail').submit();
                }, 500))
            })
        },

        mhada_user_login = function() {
            $("#mhada-user").click(function(e) {
                e.preventDefault();
                var a = $(this),
                    t = $(this).closest("form");
                t.validate({
                    rules: {
                        email: {
                            required: !0,
                            email: !0
                        },
                        password: {
                            required: !0
                        },
                        captcha : "required"
                    }
                }), t.valid() && (a.addClass("m-loader m-loader--right m-loader--light").attr("disabled", !0), setTimeout(function() {
                    $('#mhadaUser').submit();
                }, 500))
            })
        },

        o = function() {
            $("#m_login_forget_password_submit").click(function(a) {
                a.preventDefault();
                var r = $(this),
                    n = $(this).closest("form");
                n.validate({
                    rules: {
                        email: {
                            required: !0,
                            email: !0
                        }
                    }
                }), n.valid() && (r.addClass("m-loader m-loader--right m-loader--light").attr("disabled", !0), 
                setTimeout(function() {
                    $('#forgot_password_form').submit();
                }, 500))
            })
        };
    return {
        init: function() {
            n(), l(), s(), o(), rti_registration(), rti_application_form(), rti_application_status_check(), scoiety_offer_letter_forgot_password(), scoiety_offer_letter(), add_village(), edit_village(), add_society(), edit_society(), add_lease(), mhada_user_login()
        }
    }
}();
jQuery(document).ready(function() {
    SnippetLogin.init()
});
