$(function () {

    $(".number_validation").keypress(function(event){
        console.log(123)
        var regex = new RegExp("^[0-9-+]");
        var key = String.fromCharCode(event.charCode ? event.which : event.charCode);
        if (!regex.test(key)) {
            event.preventDefault();
            return false;
        }
    });
    leaveTypeTable();
    $("#leaveTypeForm").validate({
        rules: {
            name: "required",
            leave_days: "required",
            gender: "required"
        }
    });
    $("#edit-leave-type-form").validate({
        rules: {
            name: "required",
            leave_days: "required",
            gender: "required"
        }
    });
    // add leaveType
    $('#leaveTypeForm').on('submit', function (e) {
        e.preventDefault();
        var leaveCheck = $("#leaveTypeForm").valid();
        if (leaveCheck === true) {
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
                        $('#leave-type-table').DataTable().ajax.reload(null, false);
                        $('.addLeaveType').modal('hide');
                        $('.addLeaveType').find('form')[0].reset();
                        toastr.success(data.message);
                    } else {
                        toastr.error(data.message);
                    }
                }
            });
        }
    });

    // get all leaveType table
    function leaveTypeTable() {
        $('#leave-type-table').DataTable({
            processing: true,
            info: true,
            bDestroy: true,
            // dom: 'lBfrtip',
            dom: "<'row'<'col-sm-2 col-md-2'l><'col-sm-4 col-md-4'B><'col-sm-6 col-md-6'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-6'i><'col-sm-6'p>>",
            "language": {
                "info": showing_entries,
                "lengthMenu": show_entries,
                "search": datatable_search,
                "paginate": {
                    "next": next,
                    "previous": previous
                },
            },
            buttons: [
                {
                    extend: 'csv',
                    text: downloadcsv,
                    extension: '.csv',
                    exportOptions: {
                        columns: 'th:not(:last-child)'
                    }
                }, {
                    extend: 'pdf',
                    text: downloadpdf,
                    extension: '.pdf',
                    exportOptions: {
                        columns: 'th:not(:last-child)'
                    }

                }
            ],
            ajax: leaveTypeList,
            "pageLength": 10,
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
                    data: 'short_name',
                    name: 'short_name'
                },
                {
                    data: 'leave_days',
                    name: 'leave_days'
                },
                {
                    data: 'gender',
                    name: 'gender'
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
    // get row
    $(document).on('click', '#editLeaveTypeBtn', function () {
        var id = $(this).data('id');

        $('.editLeaveType').find('form')[0].reset();
        $.post(leaveTypeDetails, { id: id }, function (data) {
            $('.editLeaveType').find('input[name="id"]').val(data.data.id);
            $('.editLeaveType').find('input[name="name"]').val(data.data.name);
            $('.editLeaveType').find('input[name="leave_days"]').val(data.data.leave_days);
            $('.editLeaveType').find('input[name="short_name"]').val(data.data.short_name);
            $('.editLeaveType').find('select[name="gender"]').val(data.data.gender);
            $('.editLeaveType').modal('show');
        }, 'json');
        console.log(id);
    });
    // update LeaveType
    $('#edit-leave-type-form').on('submit', function (e) {
        e.preventDefault();
        var edt_leaveCheck = $("#edit-leave-type-form").valid();
        if (edt_leaveCheck === true) {

            var form = this;
            $.ajax({
                url: $(form).attr('action'),
                method: $(form).attr('method'),
                data: new FormData(form),
                processData: false,
                dataType: 'json',
                contentType: false,
                success: function (data) {
                    if (data.code == 0) {
                        $.each(data.error, function (prefix, val) {
                            $(form).find('span.' + prefix + '_error').text(val[0]);
                        });
                    } else {
                        if (data.code == 200) {
                            $('#leave-type-table').DataTable().ajax.reload(null, false);
                            $('.editLeaveType').modal('hide');
                            $('.editLeaveType').find('form')[0].reset();
                            toastr.success(data.message);
                        } else {
                            $('.editLeaveType').modal('hide');
                            $('.editLeaveType').find('form')[0].reset();
                            toastr.error(data.message);
                        }
                    }
                }
            });
        }
    });
    // delete LeaveTypeDelete
    $(document).on('click', '#deleteLeaveTypeBtn', function () {
        var id = $(this).data('id');
        var url = leaveTypeDelete;
        swal.fire({
            title: 'Are you sure?',
            html: 'You want to <b>delete</b> this Leave Type',
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
                        $('#leave-type-table').DataTable().ajax.reload(null, false);
                        toastr.success(data.message);
                    } else {
                        toastr.error(data.message);
                    }
                }, 'json');
            }
        });
    });

    $(document).on('click', '#restoreLeaveTypeBtn', function () {
        var id = $(this).data('id');
        var name = $(this).data('name');
        var short_name = $(this).data('short_name');
        var leave_days = $(this).data('leave_days');
        var gender = $(this).data('gender');
        var url = leaveTypeRestore;
        swal.fire({
            title: 'Are you sure?',
            html: 'You want to <b>Restore</b> this Leave Type',
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
                    id: id,
                    name: name,
                    short_name: short_name,
                    leave_days: leave_days,
                    gender: gender
                }, function (data) {
                    if (data.code == 200) {
                        $('#leave-type-table').DataTable().ajax.reload(null, false);
                        toastr.success("Leave Type Successfully Restored");
                    } else {
                        toastr.error(data.message);
                    }
                }, 'json');
            }
        });
    });
});