$(function () {

    leaveTypeTable();
    $("#leaveTypeForm").validate({
        rules: {
            name: "required"
        }
    });
    $("#edit-leave-type-form").validate({
        rules: {
            name: "required"
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
            bDestroy:true,
            ajax: leaveTypeList,
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
});