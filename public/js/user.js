/**
 * Created by vu on 3/16/16.
 */

var USER = {
    datatable: function () {
        var table = $('#table-all-user');
        if (table.length > 0) {
            table.DataTable({
                "columnDefs": [
                    {
                        "targets": [0, 4, 5, 6],
                        "searchable": false,
                        "sortable": false
                    },
                ],
                "order": [1, "desc"],
                "language": {
                    "lengthMenu": "Hiện _MENU_ dòng trên một trang",
                    "zeroRecords": "Không tìm thấy",
                    "info": "Trang _PAGE_ trong tổng số _PAGES_ trang",
                    "infoEmpty": "Không có giá trị phù hợp",
                    "infoFiltered": "(kết quả từ _MAX_ bản ghi)",
                    "search": "Tìm kiếm",
                    "oPaginate": {
                        "sFirst": "Đầu tiên",
                        "sPrevious": "Trước",
                        "sNext": "Tiếp",
                        "sLast": "Cuối cùng"
                    },
                }
            });
        }
    },

    generatePassword: function () {
        var btnGenPass = $('#generatePassword');
        btnGenPass.on('click', function () {
            var minLength = 8,
                maxLength = 16,
                randomLength = Math.floor(Math.random() * (maxLength - minLength)) + minLength,
                charset = "abcdefghijklnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_+-=<>?;:",
                retVal = "";
            for (var i = 0, n = charset.length; i < randomLength; ++i) {
                retVal += charset.charAt(Math.floor(Math.random() * n));
            }
            $('input[name=password]').val(retVal);
        });
    },

    deleteUser: function () {
        var elmDelete = $(this);
        var userID = elmDelete.data('user-id');
        var csrfToken = elmDelete.data('csrf-token');
        $.ajax({
            url: '/admin/user/delete/' + userID,
            type: 'post',
            dataType: 'json',
            data: {
                _token: csrfToken
            },
            success: function (data) {
                if (!data.user) {
                    elmDelete.parents('tr').remove();
                }
            }
        });
    },

    validateAddUser: function () {
        var form = $('#form-add-user');
        if (form.length > 0) {
            form.validate({
                rules: {
                    first_name: {
                        required: true
                    },
                    last_name: {
                        required: true
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    password: {
                        required: true,
                        minlength: 8
                    }
                },
                errorPlacement: function (error, element) {
                    return true;
                }
            });
        }
    }
};

$(document).ready(function () {
    USER.datatable();
    USER.generatePassword();
    USER.validateAddUser();
});