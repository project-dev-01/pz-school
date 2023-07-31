$(function () {
    var class_id = null;
    var section_id = null;
    var subject_id = "All";
    var semester_id = null;
    var session_id = null;
    HomeworkList(class_id, section_id, subject_id, semester_id, session_id);
    // get all leave list
    function HomeworkList(class_id, section_id, subject_id, semester_id, session_id) {
        $('#homework-table').DataTable({
            processing: true,
            bDestroy: true,
            // dom: 'Bfrtip',
            // buttons: [
            //     'copyHtml5',
            //     'excelHtml5',
            //     'csvHtml5',
            //     'pdfHtml5'
            // ],
            info: true,
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
                        doc.pageMargins = [50, 50, 50, 50];
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

                        doc['footer'] = (function (page, pages) {
                            return {
                                columns: [
                                    { alignment: 'left', text: [footer_txt], width: 400 },
                                    {
                                        // This is the right column
                                        alignment: 'right',
                                        text: ['page ', { text: page.toString() }, ' of ', { text: pages.toString() }],
                                        width: 100

                                    }
                                ],
                                margin: [50, 0, 0, 0]
                            }
                        });

                    }
                }
            ],
            "ajax": {
                url: homeworkTableList,
                cache: false,
                dataType: "json",
                // data: { month:getSelectedMonth },
                // data: formData,
                data: {
                    class_id: class_id,
                    section_id: section_id,
                    subject_id: subject_id,
                    semester_id: semester_id,
                    session_id: session_id
                },
                type: "GET",
                // contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
                // processData: true, // NEEDED, DON'T OMIT THIS
                // headers: {
                // 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                // },
                "dataSrc": function (json) {
                    return json.data;
                },
                error: function (error) {
                    // console.log("error")
                    // console.log(error)
                    // noDataAvailable(error);
                }
            },

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
                },
                {
                    data: 'title',
                    name: 'title'
                },
                {
                    data: 'date_of_homework',
                    name: 'date_of_homework'
                },
                {
                    data: 'date_of_submission',
                    name: 'date_of_submission'
                },
                {
                    data: 'students_completed',
                    name: 'students_completed'
                },
                {
                    data: 'studentCount',
                    name: 'studentCount'
                },
                {
                    data: 'actions',
                    name: 'actions',
                    orderable: false,
                    searchable: false
                }
            ],
            columnDefs: [
                {
                    "targets": 4,
                    "render": function (data, type, row, meta) {
                        var completed = parseInt(row.students_completed);
                        var studIncompleteCnt = parseInt(row.studentCount);
                        var incompleted = (studIncompleteCnt - completed);
                        var att_status = completed + "/" + incompleted;
                        return att_status;
                    }
                }
            ]
        }).on('draw', function () {
        });
    }

    // $("#evaluationFilterForm").validate({
    //     rules: {
    //         class_id: "required",
    //         section_id: "required",
    //         subject_id: "required"
    //     }
    // });
    // all Leave Filter
    $('#evaluationFilterForm').on('submit', function (e) {
        e.preventDefault();
        var class_id = $("#class_id").val();
        var section_id = $("#section_id").val();
        var subject_id = $("#subject_id").val();;
        var semester_id = $("#semester_id").val();
        var session_id = $("#session_id").val();
        console.log("---")
        console.log(class_id)
        console.log(section_id)
        console.log(subject_id)
        console.log(semester_id)
        console.log(session_id)
        HomeworkList(class_id, section_id, subject_id, semester_id, session_id);
    });
    //GET ALL HISTORY
    $('#evaluation-report-history').DataTable({
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
                    doc.pageMargins = [50, 50, 50, 50];
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

                    doc['footer'] = (function (page, pages) {
                        return {
                            columns: [
                                { alignment: 'left', text: [footer_txt], width: 400 },
                                {
                                    // This is the right column
                                    alignment: 'right',
                                    text: ['page ', { text: page.toString() }, ' of ', { text: pages.toString() }],
                                    width: 100

                                }
                            ],
                            margin: [50, 0, 0, 0]
                        }
                    });

                }
            }
        ],
        ajax: evaluationReportList,
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
            },
            {
                data: 'title',
                name: 'title'
            },
            {
                data: 'date_of_homework',
                name: 'date_of_homework'
            },
            {
                data: 'date_of_submission',
                name: 'date_of_submission'
            },
            {
                data: 'students_completed',
                name: 'students_completed'
            },
            {
                data: 'studentCount',
                name: 'studentCount'
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
                "targets": 4,
                "render": function (data, type, row, meta) {
                    var completed = parseInt(row.students_completed);
                    var studIncompleteCnt = parseInt(row.studentCount);
                    var incompleted = (studIncompleteCnt - completed);
                    var att_status = completed + "/" + incompleted;
                    return att_status;
                }
            }
        ]
    }).on('draw', function () {
    });
    
});