$(function () {

    // rules validation
    $("#exam-hall-form").validate({
        rules: {
            hall_no: "required",
            no_of_seats: "required",
        }
    });
    // add exam-hall
    $('#exam-hall-form').on('submit', function (e) {
        e.preventDefault();
        var Check = $("#exam-hall-form").valid();
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
                        $('#exam-hall-table').DataTable().ajax.reload(null, false);
                        $('.addExamHall').modal('hide');
                        $('.addExamHall').find('form')[0].reset();
                        toastr.success(data.message);
                    } else {
                        $('.addExamHall').modal('hide');
                        $('.addExamHall').find('form')[0].reset();
                        toastr.error(data.message);
                    }
                }
            });
        }
    });

    // get all exam-hall table for admin
    var table = $('#exam-hall-table').DataTable({
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
                url: examHallList,
                success: function(data) {
                    console.log(data.data.length);
                    if (data && data.data.length > 0) {
                        console.log('ok');
                        $('#exam-hall-table_wrapper .buttons-csv').removeClass('disabled');
                        $('#exam-hall-table_wrapper .buttons-pdf').removeClass('disabled');  // Enable all buttons if at least one record exists
                    } else {
                        console.log(data);
                        $('#exam-hall-table_wrapper .buttons-csv').addClass('disabled');
                        $('#exam-hall-table_wrapper .buttons-pdf').addClass('disabled');               
                    }
                },
                error: function() {
                    console.log('error');
                    // Handle error if necessary
                }
            });
        },
        ajax: examHallList,
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
                data: 'hall_no',
                name: 'hall_no'
            },
            {
                data: 'no_of_seats',
                name: 'no_of_seats'
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
    $(document).on('click', '#editExamHallBtn', function () {
        var id = $(this).data('id');
        $('.editExamHall').find('form')[0].reset();
        $.post(examHallDetails, { id: id }, function (data) {
            $('.editExamHall').find('input[name="id"]').val(data.data.id);
            $('.editExamHall').find('input[name="hall_no"]').val(data.data.hall_no);
            $('.editExamHall').find('input[name="no_of_seats"]').val(data.data.no_of_seats);
            $('.editExamHall').modal('show');
        }, 'json');
    });

    // rules validation
    $("#edit-exam-hall-form").validate({
        rules: {
            hall_no: "required",
            no_of_seats: "required",
        }
    });
    // update exam-hall
    $('#edit-exam-hall-form').on('submit', function (e) {
        e.preventDefault();
        var Check = $("#edit-exam-hall-form").valid();
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
                        $('#exam-hall-table').DataTable().ajax.reload(null, false);
                        $('.editExamHall').modal('hide');
                        $('.editExamHall').find('form')[0].reset();
                        toastr.success(data.message);
                    } else {
                        $('.editExamHall').modal('hide');
                        $('.editExamHall').find('form')[0].reset();
                        toastr.error(data.message);
                    }
                }
            });
        }
    });
    // delete ExamHallDelete
    $(document).on('click', '#deleteExamHallBtn', function () {
        var id = $(this).data('id');
        var url = examHallDelete;
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
                        $('#exam-hall-table').DataTable().ajax.reload(null, false);
                        toastr.success(data.message);
                    } else {
                        toastr.error(data.message);
                    }
                }, 'json');
            }
        });
    });
});