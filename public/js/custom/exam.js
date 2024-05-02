$(function () {

    // rules validation
    $("#exam-form").validate({
        rules: {
            name: "required",
            term_id: "required",
            remarks: "required",
        }
    });
    // add exam
    $('#exam-form').on('submit', function (e) {
        e.preventDefault();
        var Check = $("#exam-form").valid();
        if (Check === true) {
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
                        $('#exam-table').DataTable().ajax.reload(null, false);
                        $('.addExam').modal('hide');
                        $('.addExam').find('form')[0].reset();
                        toastr.success(data.message);
                    } else {
                        $('.addExam').modal('hide');
                        $('.addExam').find('form')[0].reset();
                        toastr.error(data.message);
                    }
                }
            });
        }
    });

    // get all exam table for admin
    var table = $('#exam-table').DataTable({
        processing: true,
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
                },
                enabled: false, // Initially disable CSV button
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
                url: examList,
                success: function(data) {
                    console.log(data.data.length);
                    if (data && data.data.length > 0) {
                        console.log('ok');
                        $('#exam-table_wrapper .buttons-csv').removeClass('disabled');
                        $('#exam-table_wrapper .buttons-pdf').removeClass('disabled');  // Enable all buttons if at least one record exists
                    } else {
                        console.log(data);
                        $('#exam-table_wrapper .buttons-csv').addClass('disabled');
                        $('#exam-table_wrapper .buttons-pdf').addClass('disabled');               
                    }
                },
                error: function() {
                    console.log('error');
                    // Handle error if necessary
                }
            });
        },
        ajax: examList,
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
                data: 'name',
                name: 'name'
            },
            {
                data: 'term_id',
                name: 'term_id'
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
    // get row
    $(document).on('click', '#editExamBtn', function () {
        var id = $(this).data('id');
        $('.editExam').find('form')[0].reset();
        $.post(examDetails, { id: id }, function (data) {
            $('.editExam').find('input[name="id"]').val(data.data.id);
            $('.editExam').find('input[name="name"]').val(data.data.name);
            $('.editExam').find('select[name="term_id"]').val(data.data.term_id);
            $('.editExam').find('textarea[name="remarks"]').val(data.data.remarks);
            $('.editExam').modal('show');
        }, 'json');
    });

    // rules validation
    $("#edit-exam-form").validate({
        rules: {
            name: "required",
            term_id: "required",
            remarks: "required",
        }
    });
    // update exam
    $('#edit-exam-form').on('submit', function (e) {
        e.preventDefault();
        var Check = $("#edit-exam-form").valid();
        if (Check === true) {
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
                        $('#exam-table').DataTable().ajax.reload(null, false);
                        $('.editExam').modal('hide');
                        $('.editExam').find('form')[0].reset();
                        toastr.success(data.message);
                    } else {
                        $('.editExam').modal('hide');
                        $('.editExam').find('form')[0].reset();
                        toastr.error(data.message);
                    }
                }
            });
        }
    });
    // delete ExamDelete
    $(document).on('click', '#deleteExamBtn', function () {
        var id = $(this).data('id');
        var url = examDelete;
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
                        $('#exam-table').DataTable().ajax.reload(null, false);
                        toastr.success(data.message);
                    } else {
                        toastr.error(data.message);
                    }
                }, 'json');
            }
        });
    });
});