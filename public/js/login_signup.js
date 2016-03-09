/**
 * Created by vu on 3/9/16.
 */

var SIGNUP = {
    validate_signup: function () {
        $('#form-sign-up').validate({
            rules: {
                firstname: {
                    required: true
                },
                lastname: {
                    required: true
                },
                email: {
                    required: true,
                    email: true
                },
                password: {
                    required: true,
                    minlength: 8
                },
                repassword: {
                    required: true,
                    equalTo: '#password'
                }
            },
            messages: {
                firstname: {
                    required: 'Vui lòng nhập tên.',
                },
                lastname: {
                    required: 'Vui lòng nhập họ.',
                },
                email: {
                    required: 'Vui lòng nhập email.',
                    email: 'Email không đúng'
                },
                password: {
                    required: 'Vui lòng nhập mật khẩu.',
                    minlength: jQuery.validator.format("Mật khẩu tối thiểu {0} ký tự")
                },
                repassword: {
                    required: 'Vui lòng nhập lại mật khẩu.',
                    equalTo: 'Mật khẩu không khớp.'
                }
            },
            errorElement: 'em'
        });
    }
};

var LOGIN = {
    validate_login: function () {
        $('#form-login').validate({
            rules: {
                email: {
                    required: true,
                    email: true
                },
                password: {
                    required: true,
                    minlength: 8
                }
            },
            messages: {
                email: {
                    required: 'Vui lòng nhập email.',
                    email: 'Email không đúng'
                },
                password: {
                    required: 'Vui lòng nhập mật khẩu.',
                    minlength: jQuery.validator.format("Mật khẩu tối thiểu {0} ký tự")
                }
            },
            errorElement: 'em'
        });
    },

    icheck: function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%'
        });
    }
};

$(document).ready(function () {
    SIGNUP.validate_signup();
    LOGIN.icheck();
    LOGIN.validate_login();
});
