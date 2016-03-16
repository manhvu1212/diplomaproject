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
        $('.checkall').on('ifChecked', function(){
            $('input[type=checkbox]').iCheck('check');
        });
        $('.checkall').on('ifUnchecked', function(){
            $('input[type=checkbox]').iCheck('uncheck');
        });
    }
};

$(document).ready(function () {
    SITE.icheck();
    SITE.checkAll();
});