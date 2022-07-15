$(function () {

    hostelBlockTable();
    $("#hostelBlockForm").validate({
        rules: {
            block_name: "required",
            block_warden: "required",
            total_floor: "required",
        }
    });
    $("#edit-hostel-block-form").validate({
        rules: {
            block_name: "required",
            block_warden: "required",
            total_floor: "required",
        }
    });
    // add hostelBlock
    $('#hostelBlockForm').on('submit', function (e) {
        e.preventDefault();
        var hostelCheck = $("#hostelBlockForm").valid();
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
                        $('#hostel-block-table').DataTable().ajax.reload(null, false);
                        $('.addHostelBlock').modal('hide');
                        $('.addHostelBlock').find('form')[0].reset();
                        toastr.success(data.message);
                    } else {
                        toastr.error(data.message);
                    }
                }
            });
        }
    });

    // get all HostelBlock table
    function hostelBlockTable() {
         $('#hostel-block-table').DataTable({
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
            ajax: hostelBlockList,
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
                    data: 'block_name',
                    name: 'block_name'
                },
                {
                    data: 'block_warden',
                    name: 'block_warden'
                },
                {
                    data: 'total_floor',
                    name: 'total_floor'
                },
                {
                    data: 'block_leader',
                    name: 'block_leader'
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
    $(document).on('click', '#editHostelBlockBtn', function () {
        var id = $(this).data('id');
     
        $('.editHostelBlock').find('form')[0].reset();   
        $.post(hostelBlockDetails, { id: id }, function (data) {
            $('.editHostelBlock').find('input[name="id"]').val(data.data.id);
            $('.editHostelBlock').find('input[name="block_name"]').val(data.data.block_name);
            $('.editHostelBlock').find('input[name="block_warden"]').val(data.data.block_warden);
            $('.editHostelBlock').find('input[name="total_floor"]').val(data.data.total_floor);
            $('.editHostelBlock').find('input[name="block_leader"]').val(data.data.block_leader);
            $('.editHostelBlock').modal('show');
        }, 'json');
        console.log(id);
    });
    // update HostelBlock
    $('#edit-hostel-block-form').on('submit', function (e) {
        e.preventDefault();
        var edt_hostelCheck = $("#edit-hostel-block-form").valid();
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
                            $('#hostel-block-table').DataTable().ajax.reload(null, false);
                            $('.editHostelBlock').modal('hide');
                            $('.editHostelBlock').find('form')[0].reset();
                            toastr.success(data.message);
                        } else {
                            $('.editHostelBlock').modal('hide');
                            $('.editHostelBlock').find('form')[0].reset();
                            toastr.error(data.message);
                        }
                    }
                }
            });
        }
    });
    // delete HostelBlockDelete
    $(document).on('click', '#deleteHostelBlockBtn', function () {
        var id = $(this).data('id');
        var url = hostelBlockDelete;
        swal.fire({
            title: 'Are you sure?',
            html: 'You want to <b>delete</b> this Hostel Block',
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
                        $('#hostel-block-table').DataTable().ajax.reload(null, false);
                        toastr.success(data.message);
                    } else {
                        toastr.error(data.message);
                    }
                }, 'json');
            }
        });
    });
});