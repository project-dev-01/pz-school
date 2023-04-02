$(function () {

    lateReasonTable();
    $("#lateReasonForm").validate({
        rules: {
            name: "required"
        }
    });
    $("#edit-late-reason-form").validate({
        rules: {
            name: "required"
        }
    });
    // add lateReason
    $('#lateReasonForm').on('submit', function (e) {
        e.preventDefault();
        var lateReasonCheck = $("#lateReasonForm").valid();
        if (lateReasonCheck === true) {
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
                        $('#late-reason-table').DataTable().ajax.reload(null, false);
                        $('.addLateReason').modal('hide');
                        $('.addLateReason').find('form')[0].reset();
                        toastr.success(data.message);
                    } else {
                        toastr.error(data.message);
                    }
                }
            });
        }
    });

    // get all late Reason table
    function lateReasonTable() {
         $('#late-reason-table').DataTable({
            processing: true,
            info: true,
            // dom: 'lBfrtip',
            dom:"<'row'<'col-sm-2 col-md-2'l><'col-sm-4 col-md-4'B><'col-sm-6 col-md-6'f>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-6'i><'col-sm-6'p>>",
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
            ajax: lateReasonList,
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
                },
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
    $(document).on('click', '#editLateReasonBtn', function () {
        var id = $(this).data('id');
     
        $('.editLateReason').find('form')[0].reset();   
        $.post(lateReasonDetails, { id: id }, function (data) {
            $('.editLateReason').find('input[name="id"]').val(data.data.id);
            $('.editLateReason').find('input[name="name"]').val(data.data.name);
            $('.editLateReason').modal('show');
        }, 'json');
        console.log(id);
    });
    // update Race
    $('#edit-late-reason-form').on('submit', function (e) {
        e.preventDefault();
        var edt_lateReasonCheck = $("#edit-late-reason-form").valid();
        if (edt_lateReasonCheck === true) {
      
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
                            $('#late-reason-table').DataTable().ajax.reload(null, false);
                            $('.editLateReason').modal('hide');
                            $('.editLateReason').find('form')[0].reset();
                            toastr.success(data.message);
                        } else {
                            $('.editLateReason').modal('hide');
                            $('.editLateReason').find('form')[0].reset();
                            toastr.error(data.message);
                        }
                    }
                }
            });
        }
    });
    // delete LateReasonDelete
    $(document).on('click', '#deleteLateReasonBtn', function () {
        var id = $(this).data('id');
        var url = lateReasonDelete;
        swal.fire({
            title: 'Are you sure?',
            html: 'You want to <b>delete</b> this Late Reason',
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
                        $('#late-reason-table').DataTable().ajax.reload(null, false);
                        toastr.success(data.message);
                    } else {
                        toastr.error(data.message);
                    }
                }, 'json');
            }
        });
    });
});