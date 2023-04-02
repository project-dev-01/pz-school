$(function () {

    paymentStatusTable();
    $("#paymentStatusForm").validate({
        rules: {
            name: "required"
        }
    });
    $("#edit-payment-status-form").validate({
        rules: {
            name: "required"
        }
    });
    // add paymentStatus
    $('#paymentStatusForm').on('submit', function (e) {
        e.preventDefault();
        var paymentCheck = $("#paymentStatusForm").valid();
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
                        $('#payment-status-table').DataTable().ajax.reload(null, false);
                        $('.addPaymentStatus').modal('hide');
                        $('.addPaymentStatus').find('form')[0].reset();
                        toastr.success(data.message);
                    } else {
                        toastr.error(data.message);
                    }
                }
            });
        }
    });

    // get all PaymentStatus table
    function paymentStatusTable() {
        $('#payment-status-table').DataTable({
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
            ajax: paymentStatusList,
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
    $(document).on('click', '#editPaymentStatusBtn', function () {
        var id = $(this).data('id');

        $('.editPaymentStatus').find('form')[0].reset();
        $.post(paymentStatusDetails, { id: id }, function (data) {
            $('.editPaymentStatus').find('input[name="id"]').val(data.data.id);
            $('.editPaymentStatus').find('input[name="name"]').val(data.data.name);
            $('.editPaymentStatus').modal('show');
        }, 'json');
        console.log(id);
    });
    // update paymentType
    $('#edit-payment-status-form').on('submit', function (e) {
        e.preventDefault();
        var edt_paymentCheck = $("#edit-payment-status-form").valid();
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
                            $('#payment-status-table').DataTable().ajax.reload(null, false);
                            $('.editPaymentStatus').modal('hide');
                            $('.editPaymentStatus').find('form')[0].reset();
                            toastr.success(data.message);
                        } else {
                            $('.editPaymentStatus').modal('hide');
                            $('.editPaymentStatus').find('form')[0].reset();
                            toastr.error(data.message);
                        }
                    }
                }
            });
        }
    });
    // delete PaymentStatusDelete
    $(document).on('click', '#deletePaymentStatusBtn', function () {
        var id = $(this).data('id');
        var url = paymentStatusDelete;
        swal.fire({
            title: 'Are you sure?',
            html: 'You want to <b>delete</b> this Payment Status',
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
                        $('#payment-status-table').DataTable().ajax.reload(null, false);
                        toastr.success(data.message);
                    } else {
                        toastr.error(data.message);
                    }
                }, 'json');
            }
        });
    });
});