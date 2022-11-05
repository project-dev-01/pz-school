$(function () {

    transportRouteTable();
    $("#transportRouteForm").validate({
        rules: {
            name: "required",
            start_place: "required",
            stop_place: "required",
        }
    });
    $("#edit-transport-route-form").validate({
        rules: {
            name: "required",
            start_place: "required",
            stop_place: "required",
        }
    });
    // add transportRoute
    $('#transportRouteForm').on('submit', function (e) {
        e.preventDefault();
        var transportCheck = $("#transportRouteForm").valid();
        if (transportCheck === true) {
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
                        $('#transport-route-table').DataTable().ajax.reload(null, false);
                        $('.addTransportRoute').modal('hide');
                        $('.addTransportRoute').find('form')[0].reset();
                        toastr.success(data.message);
                    } else {
                        toastr.error(data.message);
                    }
                }
            });
        }
    });

    // get all TransportRoute table
    function transportRouteTable() {
        $('#transport-route-table').DataTable({
            processing: true,
            info: true,
            bDestroy: true,
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
            ajax: transportRouteList,
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
                    data: 'start_place',
                    name: 'start_place'
                },
                {
                    data: 'stop_place',
                    name: 'stop_place'
                },
                {
                    data: 'remarks',
                    name: 'remarks'
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
    $(document).on('click', '#editTransportRouteBtn', function () {
        var id = $(this).data('id');

        $('.editTransportRoute').find('form')[0].reset();
        $.post(transportRouteDetails, { id: id }, function (data) {
            $('.editTransportRoute').find('input[name="id"]').val(data.data.id);
            $('.editTransportRoute').find('input[name="name"]').val(data.data.name);
            $('.editTransportRoute').find('input[name="start_place"]').val(data.data.start_place);
            $('.editTransportRoute').find('input[name="stop_place"]').val(data.data.stop_place);
            $('.editTransportRoute').find('textarea[name="remarks"]').text(data.data.remarks);
            $('.editTransportRoute').modal('show');
        }, 'json');
        console.log(id);
    });
    // update TransportRoute
    $('#edit-transport-route-form').on('submit', function (e) {
        e.preventDefault();
        var edt_transportCheck = $("#edit-transport-route-form").valid();
        if (edt_transportCheck === true) {

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
                            $('#transport-route-table').DataTable().ajax.reload(null, false);
                            $('.editTransportRoute').modal('hide');
                            $('.editTransportRoute').find('form')[0].reset();
                            toastr.success(data.message);
                        } else {
                            $('.editTransportRoute').modal('hide');
                            $('.editTransportRoute').find('form')[0].reset();
                            toastr.error(data.message);
                        }
                    }
                }
            });
        }
    });
    // delete TransportRouteDelete
    $(document).on('click', '#deleteTransportRouteBtn', function () {
        var id = $(this).data('id');
        var url = transportRouteDelete;
        swal.fire({
            title: 'Are you sure?',
            html: 'You want to <b>delete</b> this Transport Route',
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
                        $('#transport-route-table').DataTable().ajax.reload(null, false);
                        toastr.success(data.message);
                    } else {
                        toastr.error(data.message);
                    }
                }, 'json');
            }
        });
    });
});