$(function () {

    transportVehicleTable();
    $("#transportVehicleForm").validate({
        rules: {
            vehicle_no: "required",
            capacity: "required",
            insurance_renewal: "required",
            driver_name: "required",
            driver_phone: "required",
            driver_license: "required",
        }
    });
    $("#edit-transport-vehicle-form").validate({
        rules: {
            vehicle_no: "required",
            capacity: "required",
            insurance_renewal: "required",
            driver_name: "required",
            driver_phone: "required",
            driver_license: "required",
        }
    });
    // add transportVehicle
    $('#transportVehicleForm').on('submit', function (e) {
        e.preventDefault();
        var transportCheck = $("#transportVehicleForm").valid();
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
                        $('#transport-vehicle-table').DataTable().ajax.reload(null, false);
                        $('.addTransportVehicle').modal('hide');
                        $('.addTransportVehicle').find('form')[0].reset();
                        toastr.success(data.message);
                    } else {
                        toastr.error(data.message);
                    }
                }
            });
        }
    });

    // get all TransportVehicle table
    function transportVehicleTable() {
        $('#transport-vehicle-table').DataTable({
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
                    charset: 'utf-8',
                    bom: true,
                    exportOptions: {
                        columns: 'th:not(:last-child)'
                    }
                },
                {
                extend: 'pdf',
                text: downloadpdf,
                extension: '.pdf',
                charset: 'utf-8',
                bom: true,
                exportOptions: {
                    columns: 'th:not(:last-child)'
                },

            
                customize: function (doc) {
                doc.pageMargins = [50,50,50,50];
                doc.defaultStyle.fontSize = 10;
                doc.styles.tableHeader.fontSize = 12;
                doc.styles.title.fontSize = 14;
                // Remove spaces around page title
                doc.content[0].text = doc.content[0].text.trim();
                /*// Create a Header
                doc['header']=(function(page, pages) {
                    return {
                        columns: [
                            
                            {
                                // This is the right column
                                bold: true,
                                fontSize: 20,
                                color: 'Blue',
                                fillColor: '#fff',
                                alignment: 'center',
                                text: header_txt
                            }
                        ],
                        margin:  [50, 15,0,0]
                    }
                });*/
                // Create a footer
                
                doc['footer']=(function(page, pages) {
                    return {
                        columns: [
                            { alignment: 'left', text: [ footer_txt ],width:400} ,
                            {
                                // This is the right column
                                alignment: 'right',
                                text: ['page ', { text: page.toString() },  ' of ', { text: pages.toString() }],
                                width:100

                            }
                        ],
                        margin: [50, 0,0,0]
                    }
                });
                
            }

                }
            ],
            initComplete: function () {
                var table = this;
                $.ajax({
                    url: transportVehicleList,
                    success: function(data) {
                        console.log(data.data.length);
                        if (data && data.data.length > 0) {
                            console.log('ok');
                            $('#transport-vehicle-table_wrapper .buttons-csv').removeClass('disabled');
                            $('#transport-vehicle-table_wrapper .buttons-pdf').removeClass('disabled');  // Enable all buttons if at least one record exists
                        } else {
                            console.log(data);
                            $('#transport-vehicle-table_wrapper .buttons-csv').addClass('disabled');
                            $('#transport-vehicle-table_wrapper .buttons-pdf').addClass('disabled');               
                        }
                    },
                    error: function() {
                        console.log('error');
                        // Handle error if necessary
                    }
                });
            },
            ajax: transportVehicleList,
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
                    data: 'vehicle_no',
                    name: 'vehicle_no'
                },
                {
                    data: 'capacity',
                    name: 'capacity'
                },
                {
                    data: 'insurance_renewal',
                    name: 'insurance_renewal'
                },
                {
                    data: 'driver_name',
                    name: 'driver_name'
                },
                {
                    data: 'driver_phone',
                    name: 'driver_phone'
                },
                {
                    data: 'driver_license',
                    name: 'driver_license'
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
    $(document).on('click', '#editTransportVehicleBtn', function () {
        var id = $(this).data('id');

        $('.editTransportVehicle').find('form')[0].reset();
        $.post(transportVehicleDetails, { id: id }, function (data) {
            $('.editTransportVehicle').find('input[name="id"]').val(data.data.id);
            $('.editTransportVehicle').find('input[name="vehicle_no"]').val(data.data.vehicle_no);
            $('.editTransportVehicle').find('input[name="capacity"]').val(data.data.capacity);
            $('.editTransportVehicle').find('input[name="insurance_renewal"]').val(data.data.insurance_renewal);
            $('.editTransportVehicle').find('input[name="driver_name"]').val(data.data.driver_name);
            $('.editTransportVehicle').find('input[name="driver_phone"]').val(data.data.driver_phone);
            $('.editTransportVehicle').find('input[name="driver_license"]').val(data.data.driver_license);
            $('.editTransportVehicle').modal('show');
        }, 'json');
        console.log(id);
    });
    // update TransportVehicle
    $('#edit-transport-vehicle-form').on('submit', function (e) {
        e.preventDefault();
        var edt_transportCheck = $("#edit-transport-vehicle-form").valid();
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
                            $('#transport-vehicle-table').DataTable().ajax.reload(null, false);
                            $('.editTransportVehicle').modal('hide');
                            $('.editTransportVehicle').find('form')[0].reset();
                            toastr.success(data.message);
                        } else {
                            $('.editTransportVehicle').modal('hide');
                            $('.editTransportVehicle').find('form')[0].reset();
                            toastr.error(data.message);
                        }
                    }
                }
            });
        }
    });
    // delete TransportVehicleDelete
    $(document).on('click', '#deleteTransportVehicleBtn', function () {
        var id = $(this).data('id');
        console.log('id',id)
        var url = transportVehicleDelete;
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
                        $('#transport-vehicle-table').DataTable().ajax.reload(null, false);
                        toastr.success(data.message);
                    } else {
                        toastr.error(data.message);
                    }
                }, 'json');
            }
        });
    });
});