$(function () {

    hostelFloorTable();
    $("#hostelFloorForm").validate({
        rules: {
            floor_name: "required",
            block_id: "required",
            floor_warden: "required",
            total_room: "required",
        }
    });
    $("#edit-hostel-floor-form").validate({
        rules: {
            floor_name: "required",
            block_id: "required",
            floor_warden: "required",
            total_room: "required",
        }
    });
    // add hostelFloor
    $('#hostelFloorForm').on('submit', function (e) {
        e.preventDefault();
        var hostelCheck = $("#hostelFloorForm").valid();
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
                    if (data.code == 200) {
                        $('#hostel-floor-table').DataTable().ajax.reload(null, false);
                        $('.addHostelFloor').modal('hide');
                        $('.addHostelFloor').find('form')[0].reset();
                        toastr.success(data.message);
                    } else {
                        toastr.error(data.message);
                    }
                }
            });
        }
    });

    // get all HostelFloor table
    function hostelFloorTable() {
         $('#hostel-floor-table').DataTable({
            processing: true,
            info: true,
            bDestroy:true,
            dom: 'lBfrtip',
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
            ajax: hostelFloorList,
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
                    data: 'floor_name',
                    name: 'floor_name'
                },
                {
                    data: 'block_id',
                    name: 'block_id'
                },
                {
                    data: 'floor_warden',
                    name: 'floor_warden'
                },
                {
                    data: 'total_room',
                    name: 'total_room'
                },
                {
                    data: 'floor_leader',
                    name: 'floor_leader'
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
    $(document).on('click', '#editHostelFloorBtn', function () {
        var id = $(this).data('id');
     
        $('.editHostelFloor').find('form')[0].reset();   
        $.post(hostelFloorDetails, { id: id }, function (data) {
            $('.editHostelFloor').find('input[name="id"]').val(data.data.id);
            $('.editHostelFloor').find('input[name="floor_name"]').val(data.data.floor_name);
            $('.editHostelFloor').find('input[name="block_id"]').val(data.data.block_id);
            $('.editHostelFloor').find('input[name="floor_warden"]').val(data.data.floor_warden);
            $('.editHostelFloor').find('input[name="total_room"]').val(data.data.total_room);
            $('.editHostelFloor').find('input[name="floor_leader"]').val(data.data.floor_leader);
            $('.editHostelFloor').modal('show');
        }, 'json');
        console.log(id);
    });
    // update HostelFloor
    $('#edit-hostel-floor-form').on('submit', function (e) {
        e.preventDefault();
        var edt_hostelCheck = $("#edit-hostel-floor-form").valid();
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
                            $('#hostel-floor-table').DataTable().ajax.reload(null, false);
                            $('.editHostelFloor').modal('hide');
                            $('.editHostelFloor').find('form')[0].reset();
                            toastr.success(data.message);
                        } else {
                            $('.editHostelFloor').modal('hide');
                            $('.editHostelFloor').find('form')[0].reset();
                            toastr.error(data.message);
                        }
                    }
                }
            });
        }
    });
    // delete HostelFloorDelete
    $(document).on('click', '#deleteHostelFloorBtn', function () {
        var id = $(this).data('id');
        var url = hostelFloorDelete;
        swal.fire({
            title: 'Are you sure?',
            html: 'You want to <b>delete</b> this Hostel Floor',
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
                        $('#hostel-floor-table').DataTable().ajax.reload(null, false);
                        toastr.success(data.message);
                    } else {
                        toastr.error(data.message);
                    }
                }, 'json');
            }
        });
    });
});