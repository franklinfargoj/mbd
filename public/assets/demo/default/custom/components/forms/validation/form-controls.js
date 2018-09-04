function get_checked_value() {
    return $('input[name=is_verified]:checked').val();
}

function lat_long_val() {
    return $('input[name=change_in_lat_long]:checked').val();
}

var FormControls = function () {
	var e = function () {
			$("#m_form_10").validate({
				rules: {
					board_name: {
						required: true
					},
					dep_name: {
						required: true
					},
					res_code: {
						required: true,
					},
					title: {
						required: true,
					},
				},
				invalidHandler: function (e, r) {
					var i = $("#m_form_2_msg");
					i.removeClass("m--hide").show(), mApp.scrollTo(i, -200)
				},
				submitHandler: function (e) {
					$('#wetland_submit').addClass("m-loader m-loader--right m-loader--light").attr("disabled", !0);
                	e.submit();
				}
			})
		},
		r = function () {
			$("#update_profile").validate({
				rules: {
					email: {
						required: !0,
						email: !0
					},
					name: {
						required: !0
					},
					mobilenumber: {
						required: !0,
						minlength: 10,
						maxlength: 10,
						number: true,
					},
				},
				invalidHandler: function (e, r) {
					alert('hello');
					var i = $("#m_form_2_msg");
					i.removeClass("m--hide").show(), mApp.scrollTo(i, -200)
				},
				submitHandler: function (e) {
					$('#submit_update_profile').addClass("m-loader m-loader--right m-loader--light").attr("disabled", !0);
                	e.submit();
				}
			})
		},
		au = function () {
			$("#add_dep_user").validate({
				rules: {
					name: {
						required: !0,
					},
					email: {
						required: !0,
						email: !0,
					},
					mobilenumber: {
						required: !0,
						minlength: 10,
						maxlength: 10,
					},
				},
				invalidHandler: function (e, r) {
					var i = $("#m_form_2_msg");
					i.removeClass("m--hide").show(), mApp.scrollTo(i, -200)
				},
				submitHandler: function (e) {
					$('#submit_add_users').addClass("m-loader m-loader--right m-loader--light").attr("disabled", !0);
                	e.submit();
				}
			})
		},
		cp = function () {
			$("#change_password").validate({
				rules: {
					current_password: {
						required: !0,
					},
					new_password: {
						required: !0,
						minlength: 6,
					},
					confirm_password: {
						required: !0,
						equalTo : "#new_password"
					},
				},
				invalidHandler: function (e, r) {
					var i = $("#m_form_2_msg");
					i.removeClass("m--hide").show(), mApp.scrollTo(i, -200)
				},
				submitHandler: function (e) {
					$('#submit_change_password').addClass("m-loader m-loader--right m-loader--light").attr("disabled", !0);
                	e.submit();
				}
			})
		};
	return {
		init: function () {
			e(), r() , cp() , au()
		}
	}
}();
jQuery(document).ready(function () {
	FormControls.init()
});