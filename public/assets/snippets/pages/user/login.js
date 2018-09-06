var SnippetLogin = function() {
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
                        }
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
                    // console.log(t)
                t.validate({
                    rules:{
                        board_name:{
                            required:true
                        },
                        department_name:{
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
                            required:true
                        },
                    }
                }), t.valid() && (a.addClass("m-loader m-loader--right m-loader--light").attr("disabled", !0), setTimeout(function() {
                    $('#rti_application_form').submit();
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
                            required: !0
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
                            required: !0
                        },
                        total_area: {
                            required: !0
                        },
                        possession_date: {
                            required: !0
                        },
                        remark: {
                            required: !0
                        },
                        land_cost: {
                            required: !0
                        },
                        land_cost: {
                            required: !0
                        },
                        mhada_name: {
                            required: !0
                        },
                        property_card: {
                            required: !0
                        },
                        property_card_mhada_name: {
                            required: !0
                        },
                        mhada_name: {
                            required: !0
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
                            required: !0
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
                            required: !0
                        },
                        total_area: {
                            required: !0
                        },
                        possession_date: {
                            required: !0
                        },
                        remark: {
                            required: !0
                        },
                        land_cost: {
                            required: !0
                        },
                        land_cost: {
                            required: !0
                        },
                        mhada_name: {
                            required: !0
                        },
                        property_card: {
                            required: !0
                        },
                        property_card_mhada_name: {
                            required: !0
                        },
                        mhada_name: {
                            required: !0
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
                            required: !0
                        },
                        cts_number: {
                            required: !0
                        },
                        chairman: {
                            required: !0
                        },
                        society_address: {
                            required: !0
                        },
                        area: {
                            required: !0
                        },
                        date_on_service_tax: {
                            required: !0
                        },
                        surplus_charges: {
                            required: !0
                        },
                        surplus_charges_last_date: {
                            required: !0
                        },
                        other_land_id: {
                            required: !0
                        },
                    }
                }), t.valid() && (a.addClass("m-loader m-loader--right m-loader--light").attr("disabled", !0), setTimeout(function() {
                    $('#addSocietyDetail').submit();
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
                        },
                        lease_basis: {
                            required: !0
                        },
                        area: {
                            required: !0
                        },
                        lease_period: {
                            required: !0
                        },
                        lease_start_date: {
                            required: !0
                        },
                        lease_rent: {
                            required: !0
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
            n(), l(), s(), o(), rti_registration(), rti_application_form(), add_village(), edit_village(), add_society(), add_lease()
        }
    }
}();
jQuery(document).ready(function() {
    SnippetLogin.init()
});