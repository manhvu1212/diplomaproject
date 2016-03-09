/**
 * Created by vu on 3/9/16.
 */

var LOGIN = {
    validate: function() {
        $('#form-login').validate({
            rules: {
                email: {
                    required: true,
                    email: true
                },
                password: {
                    required: true
                }
            },
            messages: {
                email: {
                    required: 'Vui lòng nhập email.',
                    email: 'Email không đúng'
                },
                password: {
                    required: 'Vui lòng nhập mật khẩu.'
                }
            },
            errorElement: 'em'
        });
    },

    icheck: function() {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%'
        });
    }
};

$(document).ready(function(){
    LOGIN.icheck();
    LOGIN.validate();
});