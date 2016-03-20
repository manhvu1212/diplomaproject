/**
 * Created by vu on 3/16/16.
 */

var SITE = {
    icheck: function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%'
        });
    },
    checkAll: function() {
        var eleCheck = $('.checkall');
        eleCheck.on('ifChecked', function(){
            $('input[type=checkbox]').iCheck('check');
        });
        eleCheck.on('ifUnchecked', function(){
            $('input[type=checkbox]').iCheck('uncheck');
        });
    },
    confirmationAll: function() {
        $('[data-toggle=confirmation]').confirmation();
    }
};

$(document).ready(function () {
    SITE.icheck();
    SITE.checkAll();
    SITE.confirmationAll();
});