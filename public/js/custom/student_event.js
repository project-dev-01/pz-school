$(function () {

    $(".timepicker").flatpickr({
        enableTime: !0,
        noCalendar: !0,
        dateFormat: "H:i",
        time_24hr: !0,
        defaultDate: "08:30"
    });


    eventTable();


    function eventTable() {
        $('#event-table').DataTable({
            processing: true,
            info: true,
            dom: 'lBfrtip',
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
            ajax: eventList,
            "pageLength": 10,
            "aLengthMenu": [
                [5, 10, 25, 50, -1],
                [5, 10, 25, 50, "All"]
            ],
            columns: [
                //  {data:'id', name:'id'},
                // {
                //     data: 'checkbox',
                //     name: 'checkbox',
                //     orderable: false,
                //     searchable: false
                // },
                {
                    searchable: false,
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'title',
                    name: 'title'
                },
                {
                    data: 'type',
                    name: 'type'
                },
                {
                    data: 'classname',
                    name: 'classname'
                },
                {
                    data: 'start_date',
                    name: 'start_date'
                },
                {
                    data: 'end_date',
                    name: 'end_date'
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



    $(document).on('click', '#viewEventBtn', function () {
        var event_id = $(this).data('id');
        $('.viewEvent').find('span.error-text').text('');
        $.post(eventDetails, { id: event_id }, function (data) {
            console.log('cc', data)
            $('.viewEvent').find('.title').text(data.data.title);
            $('.viewEvent').find('.type').text(data.data.type_name);
            $('.viewEvent').find('.start_date').text(data.data.start_date);
            $('.viewEvent').find('.end_date').text(data.data.end_date);
            if (data.data.audience == 1) {
                $('.viewEvent').find('.audience').text("Everyone");
            } else {
                $('.viewEvent').find('.audience').text("Class " + data.data.classname);
            }

            $('.viewEvent').find('.description').text(data.data.remarks);
            $('.viewEvent').modal('show');
        }, 'json');
    });



});