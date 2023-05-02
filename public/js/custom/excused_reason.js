$(function () {

    excusedReasonTable();
    $("#excusedReasonForm").validate({
        rules: {
            name: "required"
        }
    });
    $("#edit-excused-reason-form").validate({
        rules: {
            name: "required"
        }
    });
    // add excusedReason
    $('#excusedReasonForm').on('submit', function (e) {
        e.preventDefault();
        var excusedReasonCheck = $("#excusedReasonForm").valid();
        if (excusedReasonCheck === true) {
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
                        $('#excused-reason-table').DataTable().ajax.reload(null, false);
                        $('.addExcusedReason').modal('hide');
                        $('.addExcusedReason').find('form')[0].reset();
                        toastr.success(data.message);
                    } else {
                        toastr.error(data.message);
                    }
                }
            });
        }
    });

    // get all excused Reason table
    function excusedReasonTable() {
        $('#excused-reason-table').DataTable({
            processing: true,
            info: true,
            // dom: 'lBfrtip',
            dom: "<'row'<'col-sm-2 col-md-2'l><'col-sm-4 col-md-4'B><'col-sm-6 col-md-6'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-6'i><'col-sm-6'p>>",
            "language": {
                
                "emptyTable": no_data_available,
                "infoFiltered": filter_from_total_entries,
                "zeroRecords": no_matching_records_found,
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
            ajax: excusedReasonList,
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
    $(document).on('click', '#editExcusedReasonBtn', function () {
        var id = $(this).data('id');

        $('.editExcusedReason').find('form')[0].reset();
        $.post(excusedReasonDetails, { id: id }, function (data) {
            $('.editExcusedReason').find('input[name="id"]').val(data.data.id);
            $('.editExcusedReason').find('input[name="name"]').val(data.data.name);
            $('.editExcusedReason').modal('show');
        }, 'json');
        console.log(id);
    });
    // update Race
    $('#edit-excused-reason-form').on('submit', function (e) {
        e.preventDefault();
        var edt_excusedReasonCheck = $("#edit-excused-reason-form").valid();
        if (edt_excusedReasonCheck === true) {

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
                            $('#excused-reason-table').DataTable().ajax.reload(null, false);
                            $('.editExcusedReason').modal('hide');
                            $('.editExcusedReason').find('form')[0].reset();
                            toastr.success(data.message);
                        } else {
                            $('.editExcusedReason').modal('hide');
                            $('.editExcusedReason').find('form')[0].reset();
                            toastr.error(data.message);
                        }
                    }
                }
            });
        }
    });
    // delete ExcusedReasonDelete
    $(document).on('click', '#deleteExcusedReasonBtn', function () {
        var id = $(this).data('id');
        var url = excusedReasonDelete;
        swal.fire({
            title: deleteTitle + '?',
            html: deleteHtml,
            showCancelButton: true,
            showCloseButton: true,
            cancelButtonText: deletecancelButtonText,
            confirmButtonText: deleteconfirmButtonText,
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
                        $('#excused-reason-table').DataTable().ajax.reload(null, false);
                        toastr.success(data.message);
                    } else {
                        toastr.error(data.message);
                    }
                }, 'json');
            }
        });
    });
});