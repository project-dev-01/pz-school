$(function () {

    feesTypeTable();
    $("#feesTypeForm").validate({
        rules: {
            name: "required"
        }
    });
    $("#edit-fees-type-form").validate({
        rules: {
            name: "required"
        }
    });
    // add feesType
    $('#feesTypeForm').on('submit', function (e) {
        e.preventDefault();
        var FeesCheck = $("#feesTypeForm").valid();
        if (FeesCheck === true) {
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
                        $('#fees-type-table').DataTable().ajax.reload(null, false);
                        $('.addFeesType').modal('hide');
                        $('.addFeesType').find('form')[0].reset();
                        toastr.success(data.message);
                    } else {
                        toastr.error(data.message);
                    }
                }
            });
        }
    });

    // get all feesType table
    function feesTypeTable() {
        $('#fees-type-table').DataTable({
            processing: true,
            info: true,
            // dom: 'lBfrtip',
            dom: "<'row'<'col-sm-2 col-md-2'l><'col-sm-4 col-md-4'B><'col-sm-6 col-md-6'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-6'i><'col-sm-6'p>>",
            "language": {
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
            ajax: feesTypeList,
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
    $(document).on('click', '#editFeesTypeBtn', function () {
        var id = $(this).data('id');

        $('.editFeesType').find('form')[0].reset();
        $.post(feesTypeDetails, { id: id }, function (data) {
            $('.editFeesType').find('input[name="id"]').val(data.data.id);
            $('.editFeesType').find('input[name="name"]').val(data.data.name);
            $('.editFeesType').modal('show');
        }, 'json');
        console.log(id);
    });
    // update FeesType
    $('#edit-fees-type-form').on('submit', function (e) {
        e.preventDefault();
        var edt_feesCheck = $("#edit-fees-type-form").valid();
        if (edt_feesCheck === true) {

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
                            $('#fees-type-table').DataTable().ajax.reload(null, false);
                            $('.editFeesType').modal('hide');
                            $('.editFeesType').find('form')[0].reset();
                            toastr.success(data.message);
                        } else {
                            $('.editFeesType').modal('hide');
                            $('.editFeesType').find('form')[0].reset();
                            toastr.error(data.message);
                        }
                    }
                }
            });
        }
    });
    // delete FeesTypeDelete
    $(document).on('click', '#deleteFeesTypeBtn', function () {
        var id = $(this).data('id');
        var url = feesTypeDelete;
        swal.fire({
            title: 'Are you sure?',
            html: 'You want to <b>delete</b> this Fees Type',
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
                        $('#fees-type-table').DataTable().ajax.reload(null, false);
                        toastr.success(data.message);
                    } else {
                        toastr.error(data.message);
                    }
                }, 'json');
            }
        });
    });
});