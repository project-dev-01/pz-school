$(function () {

    absentReasonTable();
    $("#absentReasonForm").validate({
        rules: {
            name: "required"
        }
    });
    $("#edit-absent-reason-form").validate({
        rules: {
            name: "required"
        }
    });
    // add absentReason
    $('#absentReasonForm').on('submit', function (e) {
        e.preventDefault();
        var absentReasonCheck = $("#absentReasonForm").valid();
        if (absentReasonCheck === true) {
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
                        $('#absent-reason-table').DataTable().ajax.reload(null, false);
                        $('.addAbsentReason').modal('hide');
                        $('.addAbsentReason').find('form')[0].reset();
                        toastr.success(data.message);
                    } else {
                        toastr.error(data.message);
                    }
                }
            });
        }
    });

    // get all absent Reason table
    function absentReasonTable() {
        $('#absent-reason-table').DataTable({
            processing: true,
            info: true,
            // dom: 'lBfrtip',
            dom: "<'row'<'col-sm-2 col-md-2'l><'col-sm-4 col-md-4'B><'col-sm-6 col-md-6'f>>" +
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
            ajax: absentReasonList,
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
    $(document).on('click', '#editAbsentReasonBtn', function () {
        var id = $(this).data('id');

        $('.editAbsentReason').find('form')[0].reset();
        $.post(absentReasonDetails, { id: id }, function (data) {
            $('.editAbsentReason').find('input[name="id"]').val(data.data.id);
            $('.editAbsentReason').find('input[name="name"]').val(data.data.name);
            $('.editAbsentReason').modal('show');
        }, 'json');
        console.log(id);
    });
    // update Race
    $('#edit-absent-reason-form').on('submit', function (e) {
        e.preventDefault();
        var edt_absentReasonCheck = $("#edit-absent-reason-form").valid();
        if (edt_absentReasonCheck === true) {

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
                            $('#absent-reason-table').DataTable().ajax.reload(null, false);
                            $('.editAbsentReason').modal('hide');
                            $('.editAbsentReason').find('form')[0].reset();
                            toastr.success(data.message);
                        } else {
                            $('.editAbsentReason').modal('hide');
                            $('.editAbsentReason').find('form')[0].reset();
                            toastr.error(data.message);
                        }
                    }
                }
            });
        }
    });
    // delete AbsentReasonDelete
    $(document).on('click', '#deleteAbsentReasonBtn', function () {
        var id = $(this).data('id');
        var url = absentReasonDelete;
        swal.fire({
            title: 'Are you sure?',
            html: 'You want to <b>delete</b> this Absent Reason',
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
                        $('#absent-reason-table').DataTable().ajax.reload(null, false);
                        toastr.success(data.message);
                    } else {
                        toastr.error(data.message);
                    }
                }, 'json');
            }
        });
    });
});