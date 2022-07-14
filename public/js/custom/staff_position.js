$(function () {

    staffPositionTable();
    $("#staffPositionForm").validate({
        rules: {
            name: "required"
        }
    });
    $("#edit-staff-position-form").validate({
        rules: {
            name: "required"
        }
    });
    // add staffPosition
    $('#staffPositionForm').on('submit', function (e) {
        e.preventDefault();
        var staffCheck = $("#staffPositionForm").valid();
        if (staffCheck === true) {
            var form = this;

            $.ajax({
                url: $(form).attr('action'),
                method: $(form).attr('method'),
                data: new FormData(form),
                processData: false,
                dataType: 'json',
                contentType: false,
                success: function (data) {
                    // console.log("------")
                    console.log(data)
                    if (data.code == 200) {
                        $('#staff-position-table').DataTable().ajax.reload(null, false);
                        $('.addStaffPosition').modal('hide');
                        $('.addStaffPosition').find('form')[0].reset();
                        toastr.success(data.message);
                    } else {
                        toastr.error(data.message);
                    }
                }
            });
        }
    });

    // get all staffPosition table
    function staffPositionTable() {
         $('#staff-position-table').DataTable({
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
            ajax: staffPositionList,
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
    $(document).on('click', '#editStaffPositionBtn', function () {
        var id = $(this).data('id');
     
        $('.editStaffPosition').find('form')[0].reset();   
        $.post(staffPositionDetails, { id: id }, function (data) {
            $('.editStaffPosition').find('input[name="id"]').val(data.data.id);
            $('.editStaffPosition').find('input[name="name"]').val(data.data.name);
            $('.editStaffPosition').modal('show');
        }, 'json');
        console.log(id);
    });
    // update StaffPosition
    $('#edit-staff-position-form').on('submit', function (e) {
        e.preventDefault();
        var edt_staffCheck = $("#edit-staff-position-form").valid();
        if (edt_staffCheck === true) {
      
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
                            $('#staff-position-table').DataTable().ajax.reload(null, false);
                            $('.editStaffPosition').modal('hide');
                            $('.editStaffPosition').find('form')[0].reset();
                            toastr.success(data.message);
                        } else {
                            $('.editStaffPosition').modal('hide');
                            $('.editStaffPosition').find('form')[0].reset();
                            toastr.error(data.message);
                        }
                    }
                }
            });
        }
    });
    // delete StaffPositionDelete
    $(document).on('click', '#deleteStaffPositionBtn', function () {
        var id = $(this).data('id');
        var url = staffPositionDelete;
        swal.fire({
            title: 'Are you sure?',
            html: 'You want to <b>delete</b> this Staff Position',
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
                        $('#staff-position-table').DataTable().ajax.reload(null, false);
                        toastr.success(data.message);
                    } else {
                        toastr.error(data.message);
                    }
                }, 'json');
            }
        });
    });
});