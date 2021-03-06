$(function () {



    $("#date_of_birth").datepicker({
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
        autoclose: true,
    });
    $("#addparent").validate({
        rules: {
            first_name: "required",
            email: {
                required: true,
                email: true
            },
            occupation: "required",
            mobile_no: "required",
            password: {
                required: true,
                minlength: 6
            },
            confirm_password: {
                required: true,
                minlength: 6,
                equalTo: "#password"
            },
        }
    });

    $('#addparent').on('submit', function (e) {
        e.preventDefault();
        var parentcheck = $("#addparent").valid();
        if (parentcheck === true) {
            var form = this;
            $.ajax({
                url: $(form).attr('action'),
                method: $(form).attr('method'),
                data: new FormData(form),
                processData: false,
                dataType: 'json',
                contentType: false,
                success: function (data) {
                    if (data.code == 200) {
                        toastr.success(data.message);
                        window.location.href = indexParent;
                    } else {
                        toastr.error(data.message);
                    }
                }
            });
        }
    });

    $("#editParent").validate({
        rules: {
            first_name: "required",
            email: {
                required: true,
                email: true
            },
            occupation: "required",
            mobile_no: "required",
            password: {
                minlength: 6
            },
            confirm_password: {
                minlength: 6,
                equalTo: "#password"
            },
        }
    });

    $('#editParent').on('submit', function (e) {
        e.preventDefault();
        console.log('123')
        var parentcheck = $("#editParent").valid();
        if (parentcheck === true) {
            var form = this;
            $.ajax({
                url: $(form).attr('action'),
                method: $(form).attr('method'),
                data: new FormData(form),
                processData: false,
                dataType: 'json',
                contentType: false,
                success: function (data) {
                    if (data.code == 200) {
                        toastr.success(data.message);
                        window.location.href = indexParent;
                    } else {
                        toastr.error(data.message);
                    }
                }
            });
        }
    });


    parentTable();

    // get all parent table
    function parentTable() {
        $('#parent-table').DataTable({
            processing: true,
            info: true,
            // dom: 'lBfrtip',
            dom:"<'row'<'col-sm-2'l><'col-sm-2'B><'col-sm-8'f>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            buttons: [
                {
                    extend: 'csv',
                    text: 'Download CSV',
                    extension: '.csv',
                    exportOptions: {
                        columns: 'th:not(:last-child)'
                    }
                }
            ],
            ajax: parentList,
            "pageLength": 5,
            "aLengthMenu": [
                [5, 10, 25, 50, -1],
                [5, 10, 25, 50, "All"]
            ],
            columns: [
                {
                    searchable: false,
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                }
                ,
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'occupation',
                    name: 'occupation'
                },
                {
                    data: 'mobile_no',
                    name: 'mobile_no'
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'actions',
                    name: 'actions',
                    orderable: false,
                    searchable: false
                },
            ],
            columnDefs: [
                {
                    "targets": 1,
                    "className": "table-user",
                    "render": function (data, type, row, meta) {
                        // var currentImg = parentImg + '/' + row.photo;
                        // var existUrl = UrlExists(currentImg);
                        // console.log(existUrl);
                        var img = (row.photo != null) ? parentImg + '/' + row.photo : defaultImg;
                        var first_name = '<img src="' + img + '" class="mr-2 rounded-circle" alt="No Image">' +
                            '<a href="javascript:void(0);" class="text-body font-weight-semibold">' + data + '</a>';
                        return first_name;
                    }
                }
            ]
        }).on('draw', function () {
        });
    }

    // delete Parent 
    $(document).on('click', '#deleteParentBtn', function () {
        var id = $(this).data('id');
        var url = parentDelete;
        swal.fire({
            title: 'Are you sure?',
            html: 'You want to <b>delete</b> this Parent',
            showCancelButton: true,
            showCloseButton: true,
            cancelButtonText: 'Cancel',
            confirmButtonText: 'Yes, Delete',
            cancelButtonColor: '#d33',
            confirmButtonColor: '#556ee6',
            width: 400,
            allowOutsideClick: false
        }).then(function (result) {
            if (result.value) {
                $.post(url, {
                    id: id
                }, function (data) {
                    if (data.code == 200) {
                        $('#parent-table').DataTable().ajax.reload(null, false);
                        toastr.success(data.message);
                    } else {
                        toastr.error(data.message);
                    }
                }, 'json');
            }
        });
    });

    function UrlExists(url) {
        // var http = new XMLHttpRequest();
        // http.open('HEAD', url, false);
        // http.send();
        // return http.status != 404;
        $.ajax({
            url: url,
            type: 'HEAD',
            error: function () {
                //file not exists
                return '404';
            },
            success: function () {
                //file exists
                return '200';
            }
        });
    }
});