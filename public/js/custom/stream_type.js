$(function () {

    streamTypeTable();
    $("#streamTypeForm").validate({
        rules: {
            name: "required"
        }
    });
    $("#edit-stream-type-form").validate({
        rules: {
            name: "required"
        }
    });
    // add streamType
    $('#streamTypeForm').on('submit', function (e) {
        e.preventDefault();
        var streamCheck = $("#streamTypeForm").valid();
        if (streamCheck === true) {
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
                        $('#stream-type-table').DataTable().ajax.reload(null, false);
                        $('.addStreamType').modal('hide');
                        $('.addStreamType').find('form')[0].reset();
                        toastr.success(data.message);
                    } else {
                        toastr.error(data.message);
                    }
                }
            });
        }
    });

    // get all StreamType table
    function streamTypeTable() {
        $('#stream-type-table').DataTable({
            processing: true,
            info: true,
            // dom: 'lBfrtip',
            dom: "<'row'<'col-sm-2 col-md-2'l><'col-sm-4 col-md-4'B><'col-sm-6 col-md-6'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-6'i><'col-sm-6'p>>",
            buttons: [
                {
                    extend: 'csv',
                    text: 'Download CSV',
                    extension: '.csv',
                    exportOptions: {
                        columns: 'th:not(:last-child)'
                    }
                },
                {
                    extend: 'pdf',
                    text: 'Download PDF',
                    extension: '.pdf',
                    exportOptions: {
                        columns: 'th:not(:last-child)'
                    }

                }
            ],
            ajax: streamTypeList,
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
    $(document).on('click', '#editStreamTypeBtn', function () {
        var id = $(this).data('id');

        $('.editStreamType').find('form')[0].reset();
        $.post(streamTypeDetails, { id: id }, function (data) {
            $('.editStreamType').find('input[name="id"]').val(data.data.id);
            $('.editStreamType').find('input[name="name"]').val(data.data.name);
            $('.editStreamType').modal('show');
        }, 'json');
        console.log(id);
    });
    // update StreamType
    $('#edit-stream-type-form').on('submit', function (e) {
        e.preventDefault();
        var edt_streamCheck = $("#edit-stream-type-form").valid();
        if (edt_streamCheck === true) {

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
                            $('#stream-type-table').DataTable().ajax.reload(null, false);
                            $('.editStreamType').modal('hide');
                            $('.editStreamType').find('form')[0].reset();
                            toastr.success(data.message);
                        } else {
                            $('.editStreamType').modal('hide');
                            $('.editStreamType').find('form')[0].reset();
                            toastr.error(data.message);
                        }
                    }
                }
            });
        }
    });
    // delete StreamTypeDelete
    $(document).on('click', '#deleteStreamTypeBtn', function () {
        var id = $(this).data('id');
        var url = streamTypeDelete;
        swal.fire({
            title: 'Are you sure?',
            html: 'You want to <b>delete</b> this Stream Type',
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
                        $('#stream-type-table').DataTable().ajax.reload(null, false);
                        toastr.success(data.message);
                    } else {
                        toastr.error(data.message);
                    }
                }, 'json');
            }
        });
    });
});