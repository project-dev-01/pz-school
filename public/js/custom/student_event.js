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
            }else if (data.data.audience == 2) {
                $('.viewEvent').find('.audience').text("Grade :" + data.data.class_name);
            }else if (data.data.audience == 3) {
                $('.viewEvent').find('.audience').text("Group : " + data.data.group_name);
            }

            $('.viewEvent').find('.description').text(data.data.remarks);
            $('.viewEvent').modal('show');
        }, 'json');
    });



});