$(function () {

    transportStoppageTable();
    $("#transportStoppageForm").validate({
        rules: {
            stop_position: "required",
            stop_time: "required",
            route_fare: "required",
        }
    });
    $("#edit-transport-stoppage-form").validate({
        rules: {
            stop_position: "required",
            stop_time: "required",
            route_fare: "required",
        }
    });
    // add transportStoppage
    $('#transportStoppageForm').on('submit', function (e) {
        e.preventDefault();
        var transportCheck = $("#transportStoppageForm").valid();
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
                        $('#transport-stoppage-table').DataTable().ajax.reload(null, false);
                        $('.addTransportStoppage').modal('hide');
                        $('.addTransportStoppage').find('form')[0].reset();
                        toastr.success(data.message);
                    } else {
                        toastr.error(data.message);
                    }
                }
            });
        }
    });

    // get all TransportStoppage table
    function transportStoppageTable() {
         $('#transport-stoppage-table').DataTable({
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
            ajax: transportStoppageList,
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
                    data: 'stop_position',
                    name: 'stop_position'
                },
                {
                    data: 'stop_time',
                    name: 'stop_time'
                },
                {
                    data: 'route_fare',
                    name: 'route_fare'
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
    $(document).on('click', '#editTransportStoppageBtn', function () {
        var id = $(this).data('id');
     
        $('.editTransportStoppage').find('form')[0].reset();   
        $.post(transportStoppageDetails, { id: id }, function (data) {
            $('.editTransportStoppage').find('input[name="id"]').val(data.data.id);
            $('.editTransportStoppage').find('input[name="stop_position"]').val(data.data.stop_position);
            $('.editTransportStoppage').find('input[name="stop_time"]').val(data.data.stop_time);
            $('.editTransportStoppage').find('input[name="route_fare"]').val(data.data.route_fare);
            $('.editTransportStoppage').modal('show');
        }, 'json');
        console.log(id);
    });
    // update TransportStoppage
    $('#edit-transport-stoppage-form').on('submit', function (e) {
        e.preventDefault();
        var edt_transportCheck = $("#edit-transport-stoppage-form").valid();
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
                            $('#transport-stoppage-table').DataTable().ajax.reload(null, false);
                            $('.editTransportStoppage').modal('hide');
                            $('.editTransportStoppage').find('form')[0].reset();
                            toastr.success(data.message);
                        } else {
                            $('.editTransportStoppage').modal('hide');
                            $('.editTransportStoppage').find('form')[0].reset();
                            toastr.error(data.message);
                        }
                    }
                }
            });
        }
    });
    // delete TransportStoppageDelete
    $(document).on('click', '#deleteTransportStoppageBtn', function () {
        var id = $(this).data('id');
        var url = transportStoppageDelete;
        swal.fire({
            title: 'Are you sure?',
            html: 'You want to <b>delete</b> this Transport Stoppage',
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
                        $('#transport-stoppage-table').DataTable().ajax.reload(null, false);
                        toastr.success(data.message);
                    } else {
                        toastr.error(data.message);
                    }
                }, 'json');
            }
        });
    });
});