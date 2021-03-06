$(function () {

    hostelRoomTable();
    $("#hostelRoomForm").validate({
        rules: {
            name: "required",
            hostel_id: "required",
            no_of_beds: "required",
            block: "required",
            floor: "required",
            bed_fee : "required"
        }
    });
    $("#edit-hostel-room-form").validate({
        rules: {
            name: "required",
            hostel_id: "required",
            no_of_beds: "required",
            block: "required",
            floor: "required",
            bed_fee : "required"
        }
    });
    // add hostelRoom
    $('#hostelRoomForm').on('submit', function (e) {
        e.preventDefault();
        var hostelRoomCheck = $("#hostelRoomForm").valid();
        if (hostelRoomCheck === true) {
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
                        $('#hostel-room-table').DataTable().ajax.reload(null, false);
                        $('.addHostelRoom').modal('hide');
                        $('.addHostelRoom').find('form')[0].reset();
                        toastr.success(data.message);
                    } else {
                        toastr.error(data.message);
                    }
                }
            });
        }
    });

    // get all hostelRoom table
    function hostelRoomTable() {
         $('#hostel-room-table').DataTable({
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
            ajax: hostelRoomList,
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
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'hostel',
                    name: 'hostel'
                },
                {
                    data: 'block',
                    name: 'block'
                },
                {
                    data: 'floor',
                    name: 'floor'
                },
                {
                    data: 'no_of_beds',
                    name: 'no_of_beds'
                },
                {
                    data: 'bed_fee',
                    name: 'bed_fee'
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
    $(document).on('click', '#editHostelRoomBtn', function () {
        var id = $(this).data('id');
     
        $('.editHostelRoom').find('form')[0].reset();   
        $.post(hostelRoomDetails, { id: id }, function (data) {
            $('.editHostelRoom').find('input[name="id"]').val(data.data.id);
            $('.editHostelRoom').find('input[name="name"]').val(data.data.name);
            $('.editHostelRoom').find('select[name="hostel_id"]').val(data.data.hostel_id);
            $('.editHostelRoom').find('input[name="no_of_beds"]').val(data.data.no_of_beds);
            $('.editHostelRoom').find('input[name="block"]').val(data.data.block);
            $('.editHostelRoom').find('input[name="floor"]').val(data.data.floor);
            $('.editHostelRoom').find('input[name="bed_fee"]').val(data.data.bed_fee);
            $('.editHostelRoom').find('textarea[name="remarks"]').text(data.data.remarks);
            $('.editHostelRoom').modal('show');
        }, 'json');
        console.log(id);
    });
    // update HostelRoom
    $('#edit-hostel-room-form').on('submit', function (e) {
        e.preventDefault();
        var edt_hostelRoomCheck = $("#edit-hostel-room-form").valid();
        if (edt_hostelRoomCheck === true) {
      
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
                            $('#hostel-room-table').DataTable().ajax.reload(null, false);
                            $('.editHostelRoom').modal('hide');
                            $('.editHostelRoom').find('form')[0].reset();
                            toastr.success(data.message);
                        } else {
                            $('.editHostelRoom').modal('hide');
                            $('.editHostelRoom').find('form')[0].reset();
                            toastr.error(data.message);
                        }
                    }
                }
            });
        }
    });
    // delete HostelRoomDelete
    $(document).on('click', '#deleteHostelRoomBtn', function () {
        var id = $(this).data('id');
        var url = hostelRoomDelete;
        swal.fire({
            title: 'Are you sure?',
            html: 'You want to <b>delete</b> this Hostel Room',
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
                        $('#hostel-room-table').DataTable().ajax.reload(null, false);
                        toastr.success(data.message);
                    } else {
                        toastr.error(data.message);
                    }
                }, 'json');
            }
        });
    });
});