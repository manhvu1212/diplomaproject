/**
 * Created by vu on 3/16/16.
 */

var USER = {
    datatable: function () {
        $("#table-all-user").DataTable({
            "columnDefs": [
                {
                    "targets": [0],
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
                "infoFiltered": "(filtered from _MAX_ total records)",
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

};

$(document).ready(function () {
    USER.datatable();
});