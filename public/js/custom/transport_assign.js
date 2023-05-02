$(function () {

    transportAssignTable();
    $("#transportAssignForm").validate({
        rules: {
            route_id: "required",
            stoppage_id: "required",
            vehicle_id: "required",
        }
    });
    $("#edit-transport-assign-form").validate({
        rules: {
            route_id: "required",
            stoppage_id: "required",
            vehicle_id: "required",
        }
    });
    // add transportAssign
    $('#transportAssignForm').on('submit', function (e) {
        e.preventDefault();
        var transportCheck = $("#transportAssignForm").valid();
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
                        $('#transport-assign-table').DataTable().ajax.reload(null, false);
                        $('.addTransportAssign').modal('hide');
                        $('.addTransportAssign').find('form')[0].reset();
                        toastr.success(data.message);
                    } else {
                        toastr.error(data.message);
                    }
                }
            });
        }
    });

    // get all TransportAssign table
    function transportAssignTable() {
        $('#transport-assign-table').DataTable({
            processing: true,
            info: true,
            bDestroy: true,
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
            ajax: transportAssignList,
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
                    data: 'route_name',
                    name: 'route_name'
                },
                {
                    data: 'stop_position',
                    name: 'stop_position'
                },
                {
                    data: 'vehicle_no',
                    name: 'vehicle_no'
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
    $(document).on('click', '#editTransportAssignBtn', function () {
        var id = $(this).data('id');

        $('.editTransportAssign').find('form')[0].reset();
        $.post(transportAssignDetails, { id: id }, function (data) {
            $('.editTransportAssign').find('input[name="id"]').val(data.data.id);
            $('.editTransportAssign').find('input[name="route_id"]').val(data.data.route_id);
            $('.editTransportAssign').find('input[name="stoppage_id"]').val(data.data.stoppage_id);
            $('.editTransportAssign').find('input[name="vehicle_id"]').val(data.data.vehicle_id);
            $('.editTransportAssign').modal('show');
        }, 'json');
        console.log(id);
    });
    // update TransportAssign
    $('#edit-transport-assign-form').on('submit', function (e) {
        e.preventDefault();
        var edt_transportCheck = $("#edit-transport-assign-form").valid();
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
                            $('#transport-assign-table').DataTable().ajax.reload(null, false);
                            $('.editTransportAssign').modal('hide');
                            $('.editTransportAssign').find('form')[0].reset();
                            toastr.success(data.message);
                        } else {
                            $('.editTransportAssign').modal('hide');
                            $('.editTransportAssign').find('form')[0].reset();
                            toastr.error(data.message);
                        }
                    }
                }
            });
        }
    });
    // delete TransportAssignDelete
    $(document).on('click', '#deleteTransportAssignBtn', function () {
        var id = $(this).data('id');
        var url = transportAssignDelete;
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
                        $('#transport-assign-table').DataTable().ajax.reload(null, false);
                        toastr.success(data.message);
                    } else {
                        toastr.error(data.message);
                    }
                }, 'json');
            }
        });
    });
});