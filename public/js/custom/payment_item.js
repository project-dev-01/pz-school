$(function () {

    paymentItemTable();
    $("#paymentItemForm").validate({
        rules: {
            name: "required"
        }
    });
    $("#edit-payment-item-form").validate({
        rules: {
            name: "required"
        }
    });
    // add paymentItem
    $('#paymentItemForm').on('submit', function (e) {
        e.preventDefault();
        var paymentCheck = $("#paymentItemForm").valid();
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
                        $('#payment-item-table').DataTable().ajax.reload(null, false);
                        $('.addPaymentItem').modal('hide');
                        $('.addPaymentItem').find('form')[0].reset();
                        toastr.success(data.message);
                    } else {
                        toastr.error(data.message);
                    }
                }
            });
        }
    });

    // get all PaymentItem table
    function paymentItemTable() {
        $('#payment-item-table').DataTable({
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
            ajax: paymentItemList,
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
    $(document).on('click', '#editPaymentItemBtn', function () {
        var id = $(this).data('id');

        $('.editPaymentItem').find('form')[0].reset();
        $.post(paymentItemDetails, { id: id }, function (data) {
            $('.editPaymentItem').find('input[name="id"]').val(data.data.id);
            $('.editPaymentItem').find('input[name="name"]').val(data.data.name);
            $('.editPaymentItem').modal('show');
        }, 'json');
        console.log(id);
    });
    // update paymentType
    $('#edit-payment-item-form').on('submit', function (e) {
        e.preventDefault();
        var edt_paymentCheck = $("#edit-payment-item-form").valid();
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
                            $('#payment-item-table').DataTable().ajax.reload(null, false);
                            $('.editPaymentItem').modal('hide');
                            $('.editPaymentItem').find('form')[0].reset();
                            toastr.success(data.message);
                        } else {
                            $('.editPaymentItem').modal('hide');
                            $('.editPaymentItem').find('form')[0].reset();
                            toastr.error(data.message);
                        }
                    }
                }
            });
        }
    });
    // delete PaymentItemDelete
    $(document).on('click', '#deletePaymentItemBtn', function () {
        var id = $(this).data('id');
        var url = paymentItemDelete;
        swal.fire({
            title: 'Are you sure?',
            html: 'You want to <b>delete</b> this Payment Item',
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
                        $('#payment-item-table').DataTable().ajax.reload(null, false);
                        toastr.success(data.message);
                    } else {
                        toastr.error(data.message);
                    }
                }, 'json');
            }
        });
    });
});