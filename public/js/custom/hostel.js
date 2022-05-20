$(function () {

    hostelTable();
    $("#hostelForm").validate({
        rules: {
            name: "required"
        }
    });
    $("#edit-hostel-form").validate({
        rules: {
            name: "required"
        }
    });
    // add hostel
    $('#hostelForm').on('submit', function (e) {
        e.preventDefault();
        var hostelCheck = $("#hostelForm").valid();
        if (hostelCheck === true) {
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
                        $('#hostel-table').DataTable().ajax.reload(null, false);
                        $('.addHostel').modal('hide');
                        $('.addHostel').find('form')[0].reset();
                        toastr.success(data.message);
                    } else {
                        toastr.error(data.message);
                    }
                }
            });
        }
    });

    // get all hostel table
    function hostelTable() {
         $('#hostel-table').DataTable({
            processing: true,
            info: true,
            ajax: hostelList,
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
                    data: 'category',
                    name: 'category'
                },
                {
                    data: 'watchman',
                    name: 'watchman'
                },
                {
                    data: 'remarks',
                    name: 'remarks'
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
    $(document).on('click', '#editHostelBtn', function () {
        var id = $(this).data('id');
     
        $('.editHostel').find('form')[0].reset();   
        $.post(hostelDetails, { id: id }, function (data) {
            $('.editHostel').find('input[name="id"]').val(data.data.id);
            $('.editHostel').find('input[name="name"]').val(data.data.name);
            $('.editHostel').find('select[name="category"]').val(data.data.category_id);
            $('.editHostel').find('input[name="watchman"]').val(data.data.watchman);
            $('.editHostel').find('input[name="address"]').val(data.data.address);
            $('.editHostel').find('textarea[name="remarks"]').text(data.data.remarks);
            $('.editHostel').modal('show');
        }, 'json');
        console.log(id);
    });
    // update Hostel
    $('#edit-hostel-form').on('submit', function (e) {
        e.preventDefault();
        var edt_hostelCheck = $("#edit-hostel-form").valid();
        if (edt_hostelCheck === true) {
      
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
                            $('#hostel-table').DataTable().ajax.reload(null, false);
                            $('.editHostel').modal('hide');
                            $('.editHostel').find('form')[0].reset();
                            toastr.success(data.message);
                        } else {
                            $('.editHostel').modal('hide');
                            $('.editHostel').find('form')[0].reset();
                            toastr.error(data.message);
                        }
                    }
                }
            });
        }
    });
    // delete HostelDelete
    $(document).on('click', '#deleteHostelBtn', function () {
        var id = $(this).data('id');
        var url = hostelDelete;
        swal.fire({
            title: 'Are you sure?',
            html: 'You want to <b>delete</b> this Hostel',
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
                        $('#hostel-table').DataTable().ajax.reload(null, false);
                        toastr.success(data.message);
                    } else {
                        toastr.error(data.message);
                    }
                }, 'json');
            }
        });
    });
});