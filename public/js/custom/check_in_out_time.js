$(function () {

    // $(".timepicker").flatpickr({
    //     enableTime: true,
    //     noCalendar: true,
    //     dateFormat: "H:i",
    //     time_24hr: !0,
    // });
    var check_in_date = flatpickr("#check_in", {
        enableTime: true, noCalendar: true, dateFormat: "H:i",
        onChange: function (selectedDates, dateStr, instance) {
            check_out_date.set('minTime', selectedDates[0]);
        }
    });
    

    var check_out_date = flatpickr("#check_out", {
        enableTime: true, noCalendar: true, dateFormat: "H:i",
    });

    checkInOutTimeTable();
    $("#check-in-out-time-form").validate({
        rules: {
            check_in: "required",
            check_out: "required"
        }
    });

    // get all checkInOutTime table
    function checkInOutTimeTable() {
        $('#check-in-out-time-table').DataTable({
            processing: true,
            info: true,
            bDestroy: true,
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
                    charset: 'utf-8',
                    bom: true,
                    exportOptions: {
                        columns: 'th:not(:last-child)'
                    },
                    enabled: false, // Initially disable PDF button
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
                    enabled: false, // Initially disable PDF button
                }
            ],
            initComplete: function () {
                var table = this;
                $.ajax({
                    url: checkInOutTimeList,
                    success: function(data) {
                        console.log(data.data.length);
                        if (data && data.data.length > 0) {
                            console.log('ok');
                            $('#check-in-out-time-table_wrapper .buttons-csv').removeClass('disabled');
                            $('#check-in-out-time-table_wrapper .buttons-pdf').removeClass('disabled');  // Enable all buttons if at least one record exists
                        } else {
                            console.log(data);
                            $('#check-in-out-time-table_wrapper .buttons-csv').addClass('disabled');
                            $('#check-in-out-time-table_wrapper .buttons-pdf').addClass('disabled');               
                        }
                    },
                    error: function() {
                        console.log('error');
                        // Handle error if necessary
                    }
                });
            },
            ajax: checkInOutTimeList,
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
                    data: 'check_in',
                    name: 'check_in',
                },
                {
                    data: 'check_out',
                    name: 'check_out',
                },
                {
                    data: 'actions',
                    name: 'actions',
                    orderable: false,
                    searchable: false
                },
            ],
            columnDefs: [
                {
                    "targets": 1,
                    "render": function (data, type, row, meta) {
                        var check_in = moment(row.check_in, 'HH:mm:ss').format('HH:mm');
                        return check_in;
                    }
                },
                {
                    "targets": 2,
                    "render": function (data, type, row, meta) {
                        var check_out = moment(row.check_out, 'HH:mm:ss').format('HH:mm');
                        return check_out;
                    }
                },
            ]
        }).on('draw', function () {
        });
    }
    // get row
    $(document).on('click', '#editCheckInOutTimeBtn', function () {
        var id = $(this).data('id');

        $('.editCheckInOutTime').find('form')[0].reset();
        $.post(checkInOutTimeDetails, { id: id }, function (data) {
            $('.editCheckInOutTime').find('input[name="id"]').val(data.data.id);

            var check_in_time = moment(data.data.check_in, 'HH:mm:ss').format('HH:mm');
            // check_in_date.set('time', check_in_time);
            check_in_date.setDate(check_in_time, true, "H:i")
            $('.editCheckInOutTime').find('input[name="check_in"]').val(check_in_time);

            var check_out_time = moment(data.data.check_out, 'HH:mm:ss').format('HH:mm');
            check_out_date.setDate(check_out_time, true, "H:i")
            $('.editCheckInOutTime').find('input[name="check_out"]').val(check_out_time);

            $('.editCheckInOutTime').modal('show');
        }, 'json');
    });
    // update GlobalSetting
    $('#check-in-out-time-form').on('submit', function (e) {
        e.preventDefault();
        var edt_globalCheck = $("#check-in-out-time-form").valid();
        if (edt_globalCheck === true) {

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
                            $('#check-in-out-time-table').DataTable().ajax.reload(null, false);
                            $('.editCheckInOutTime').modal('hide');
                            $('.editCheckInOutTime').find('form')[0].reset();
                            toastr.success(data.message);
                        } else {
                            $('.editCheckInOutTime').modal('hide');
                            $('.editCheckInOutTime').find('form')[0].reset();
                            toastr.error(data.message);
                        }
                    }
                }
            });
        }
    });
});