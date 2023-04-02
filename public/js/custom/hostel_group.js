$(function () {



    hostelGroupTable();
    $(".color").colorpicker({
        format: "auto"
    });

    $("#hostelGroupForm").validate({
        rules: {
            name: "required",
        }
    });
    $('#hostelGroupForm').on('submit', function (e) {
        e.preventDefault();
        var form = this;
        var hostelGroupCheck = $("#hostelGroupForm").valid();
        if (hostelGroupCheck === true) {
            $.ajax({
                url: $(form).attr('action'),
                method: $(form).attr('method'),
                data: new FormData(form),
                processData: false,
                dataType: 'json',
                contentType: false,
                success: function (data) {
                    if (data.code == 200) {
                        $('#hostel-group-table').DataTable().ajax.reload(null, false);
                        toastr.success(data.message);
                        window.location.href = hostelGroupList;
                    } else {
                        toastr.error(data.message);
                    }
                }
            });
        }
    });
    $("#hostelGroupEditForm").validate({
        rules: {
            name: "required",
        }
    });
    $('#hostelGroupEditForm').on('submit', function (e) {
        e.preventDefault();

        var hostelGroupCheck = $("#hostelGroupEditForm").valid();
        if (hostelGroupCheck === true) {
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
                        $('#hostel-group-table').DataTable().ajax.reload(null, false);
                        window.location.href = hostelGroupList;
                        toastr.success(data.message);
                    } else {
                        toastr.error(data.message);
                    }
                }
            });
        }
    });
    function hostelGroupTable() {
        $('#hostel-group-table').DataTable({
            processing: true,
            info: true,
            dom: 'lBfrtip',
            buttons: [
                {
                    extend: 'csv',
                    text: downloadcsv,
                    extension: '.csv',
                    exportOptions: {
                        columns: 'th:not(:last-child)'
                    }
                },
                {
                    extend: 'pdf',
                    text: downloadpdf,
                    extension: '.pdf',
                    exportOptions: {
                        columns: 'th:not(:last-child)'
                    }

                }
            ],
            ajax: hostelGroupList,
            "pageLength": 10,
            "aLengthMenu": [
                [5, 10, 25, 50, -1],
                [5, 10, 25, 50, "All"]
            ],
            columns: [
                //  {data:'id', name:'id'},
                // {
                //     data: 'checkbox',
                //     name: 'checkbox',
                //     orderable: false,
                //     searchable: false
                // },
                {
                    searchable: false,
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'incharge_staff',
                    name: 'incharge_staff'
                },
                {
                    data: 'incharge_student',
                    name: 'incharge_student'
                },
                {
                    data: 'student',
                    name: 'student'
                },
                {
                    data: 'color',
                    name: 'color'
                },
                {
                    data: 'actions',
                    name: 'actions',
                    orderable: false,
                    searchable: false
                },
            ]
        }).on('draw', function () {
        });
    }

    // delete Group Type
    $(document).on('click', '#deleteHostelGroupBtn', function () {
        var group_id = $(this).data('id');
        swal.fire({
            title: 'Are you sure?',
            html: 'You want to <b>delete</b> this Hostel Group',
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
                $.post(hostelGroupDelete, { id: group_id }, function (data) {
                    if (data.code == 200) {
                        $('#hostel-group-table').DataTable().ajax.reload(null, false);
                        toastr.success(data.message);
                    } else {
                        toastr.error(data.message);
                    }
                }, 'json');
            }
        });
    });

});