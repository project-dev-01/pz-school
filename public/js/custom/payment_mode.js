$(function () {

    paymentModeTable();
    $("#paymentModeForm").validate({
        rules: {
            name: "required"
        }
    });
    $("#edit-payment-mode-form").validate({
        rules: {
            name: "required"
        }
    });
    // add paymentMode
    $('#paymentModeForm').on('submit', function (e) {
        e.preventDefault();
        var paymentCheck = $("#paymentModeForm").valid();
        if (paymentCheck === true) {
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
                        $('#payment-mode-table').DataTable().ajax.reload(null, false);
                        $('.addPaymentMode').modal('hide');
                        $('.addPaymentMode').find('form')[0].reset();
                        toastr.success(data.message);
                    } else {
                        toastr.error(data.message);
                    }
                }
            });
        }
    });

    // get all PaymentMode table
    function paymentModeTable() {
        $('#payment-mode-table').DataTable({
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
            ajax: paymentModeList,
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
    $(document).on('click', '#editPaymentModeBtn', function () {
        var id = $(this).data('id');

        $('.editPaymentMode').find('form')[0].reset();
        $.post(paymentModeDetails, { id: id }, function (data) {
            $('.editPaymentMode').find('input[name="id"]').val(data.data.id);
            $('.editPaymentMode').find('input[name="name"]').val(data.data.name);
            $('.editPaymentMode').modal('show');
        }, 'json');
        console.log(id);
    });
    // update paymentType
    $('#edit-payment-mode-form').on('submit', function (e) {
        e.preventDefault();
        var edt_paymentCheck = $("#edit-payment-mode-form").valid();
        if (edt_paymentCheck === true) {

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
                            $('#payment-mode-table').DataTable().ajax.reload(null, false);
                            $('.editPaymentMode').modal('hide');
                            $('.editPaymentMode').find('form')[0].reset();
                            toastr.success(data.message);
                        } else {
                            $('.editPaymentMode').modal('hide');
                            $('.editPaymentMode').find('form')[0].reset();
                            toastr.error(data.message);
                        }
                    }
                }
            });
        }
    });
    // delete PaymentModeDelete
    $(document).on('click', '#deletePaymentModeBtn', function () {
        var id = $(this).data('id');
        var url = paymentModeDelete;
        swal.fire({
            title: 'Are you sure?',
            html: 'You want to <b>delete</b> this Payment Mode',
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
                        $('#payment-mode-table').DataTable().ajax.reload(null, false);
                        toastr.success(data.message);
                    } else {
                        toastr.error(data.message);
                    }
                }, 'json');
            }
        });
    });
});