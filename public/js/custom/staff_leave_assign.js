$(function () { 

    $("#department").on('change', function (e) {
        e.preventDefault();
        var department = $(this).val();
        $("#employee").empty();
        $("#employee").append('<option value="">'+select_employee+'</option>');
        $.post(employeeByDepartment, { token: token, branch_id: branchID, department_id: department }, function (res) {
            if (res.code == 200) {
                $.each(res.data, function (key, val) {
                    $("#employee").append('<option value="' + val.id + '">' + val.first_name + ' ' + val.last_name + '</option>');
                });
            }
        }, 'json');
    });
    staffLeaveAssignTable();
    $("#staffLeaveAssignForm").validate({
        rules: {
            staff_id: "required",
            leave_type: "required",
            leave_days: "required",
            academic_session_id: "required",
        }
    });
    $("#edit-staff-leave-assign-form").validate({
        rules: {
            staff_id: "required",
            leave_type: "required",
            leave_days: "required",
            academic_session_id: "required",
        }
    });
    // add staffLeaveAssign
    $('#staffLeaveAssignForm').on('submit', function (e) {
        e.preventDefault();
        console.log('123')
        var leaveCheck = $("#staffLeaveAssignForm").valid();
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
                        $('#staff-leave-assign-table').DataTable().ajax.reload(null, false);
                        $('.addStaffLeaveAssign').modal('hide');
                        $('.addStaffLeaveAssign').find('form')[0].reset();
                        toastr.success(data.message);
                    } else {
                        toastr.error(data.message);
                    }
                }
            });
        }
    });

    // get all StaffLeaveAssign table
    function staffLeaveAssignTable() {
        $('#staff-leave-assign-table').DataTable({
            processing: true,
            info: true,
            bDestroy: true,
            // dom: 'lBfrtip',
            dom: "<'row'<'col-sm-2 col-md-2'l><'col-sm-4 col-md-4'B><'col-sm-6 col-md-6'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-6'i><'col-sm-6'p>>",
            "language": {
                "infoEmpty": showing_zero_entries,
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
            ajax: {
                url: staffLeaveAssignList,
                data: function (d) {
                    d.department = $('#department').val(),
                        d.employee = $('#employee').val()
                }
            },
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
                    data: 'staff_name',
                    name: 'staff_name'
                },
                {
                    data: 'leave_type',
                    name: 'leave_type'
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
    $(document).on('click', '#editStaffLeaveAssignBtn', function () {
        var id = $(this).data('id');

        $('.editStaffLeaveAssign').find('form')[0].reset();
        $.post(staffLeaveAssignDetails, { id: id }, function (data) {
            $('.editStaffLeaveAssign').find('input[name="id"]').val(data.data.id);
            $('.editStaffLeaveAssign').find('select[name="staff_id"]').val(data.data.staff_id);
            $('.editStaffLeaveAssign').find('select[name="leave_type"]').val(data.data.leave_type);
            $('.editStaffLeaveAssign').find('input[name="leave_days"]').val(data.data.leave_days);
            $('.editStaffLeaveAssign').find('select[name="academic_session_id"]').val(data.data.academic_session_id);
            $('.editStaffLeaveAssign').modal('show');
        }, 'json');
        console.log(id);
    });
    // update StaffLeaveAssign
    $('#edit-staff-leave-assign-form').on('submit', function (e) {
        
        $('.leave_days').each(function () {
            $(this).rules("add", {
                required: true
            })
        });
        e.preventDefault();
        var edt_leaveCheck = $("#edit-staff-leave-assign-form").valid();
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
                            toastr.success(data.message);
                            window.location.href = staffLeaveAssignIndex;
                        } else {
                            toastr.error(data.message);
                            window.location.href = staffLeaveAssignIndex;
                        }
                    }
                }
            });
        }
    });
    // delete StaffLeaveAssignDelete
    $(document).on('click', '#deleteStaffLeaveAssignBtn', function () {
        var id = $(this).data('id');
        var url = staffLeaveAssignDelete;
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
                        $('#staff-leave-assign-table').DataTable().ajax.reload(null, false);
                        toastr.success(data.message);
                    } else {
                        toastr.error(data.message);
                    }
                }, 'json');
            }
        });
    });

    $("#staffLeaveAssignFilter").validate({
        rules: {
            department: "required",
        }
    });
    $('#staffLeaveAssignFilter').on('submit', function (e) {
        e.preventDefault();
        var filterCheck = $("#staffLeaveAssignFilter").valid();
        if (filterCheck === true) {
            staffLeaveAssignTable();
        }
    });
});