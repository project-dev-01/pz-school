$(function () {
    $(".subjectColor").colorpicker({
        format: "auto"
    });
    // rules validation
    $("#addSubjectSubmit").validate({
        rules: {
            name: "required",
            short_name: "required"
        }
    });
    // add 
    $('#addSubjectSubmit').on('submit', function (e) {
        e.preventDefault();
        var classValid = $("#addSubjectSubmit").valid();
        if (classValid === true) {
            var subjectName = $("#subjectName").val();
            var subjectCode = $("#subjectCode").val();
            var shortName = $("#shortName").val();
            var subjectType = $("#subjectType").val();
            var subjectColor = $("#subjectColor").val();
            var subjectTypeTwo = $("#subjectTypeTwo").val();
            var pdf_report = $("#pdf_report").val();
            var times_per_week = $("#times_per_week").val();
            var order_code = $("#order_code").val();
            var exam_exclude = 0;
            if ($('#excludeExams').is(':checked')) {
                //I am checked
                exam_exclude = 1;
            }
            var formData = new FormData();
            formData.append('token', token);
            formData.append('branch_id', branchID);
            formData.append('name', subjectName);
            formData.append('short_name', shortName);
            formData.append('subject_code', subjectCode);
            formData.append('subject_type', subjectType);
            formData.append('subject_type_2', subjectTypeTwo);
            formData.append('pdf_report', pdf_report);
            formData.append('times_per_week', times_per_week);
            formData.append('exam_exclude', exam_exclude);
            formData.append('subject_color', subjectColor);
            formData.append('order_code', order_code);
            $.ajax({
                url: subjectsAddUrl,
                method: "post",
                data: formData,
                processData: false,
                dataType: 'json',
                contentType: false,
                success: function (data) {
                    console.log(data)
                    if (data.code == 200) {
                        $('#subjects-table').DataTable().ajax.reload(null, false);
                        $('.addSubjectModal').modal('hide');
                        $('.addSubjectModal').find('form')[0].reset();
                        toastr.success(data.message);
                    } else {
                        $('.addSubjectModal').modal('hide');
                        $('.addSubjectModal').find('form')[0].reset();
                        toastr.error(data.message);
                    }
                }, error: function (err) {
                    toastr.error(err.responseJSON.data.error ? err.responseJSON.data.error : 'Something went wrong');
                }
            });
        }
    });

    // edit 

    $(document).on('click', '#editSubjectBtn', function () {
        var id = $(this).data('id');
        $.post(subjectsGetRowUrl, {
            id: id,
            token: token,
            branch_id: branchID
        }, function (data) {
            console.log(data)
            $('.editSubjectModel').find('input[name="id"]').val(data.data.id);
            $('.editSubjectModel').find('input[name="name"]').val(data.data.name);
            $('.editSubjectModel').find('input[name="short_name"]').val(data.data.short_name);
            $('.editSubjectModel').find('input[name="subject_code"]').val(data.data.subject_code);
            $('.editSubjectModel').find('select[name="subject_type"]').val(data.data.subject_type);
            $('.editSubjectModel').find('select[name="subject_type_2"]').val(data.data.subject_type_2);
            $('.editSubjectModel').find('select[name="pdf_report"]').val(data.data.pdf_report);
            $('.editSubjectModel').find('input[name="times_per_week"]').val(data.data.times_per_week);
            $('.editSubjectModel').find('input[name="subject_color_calendor"]').val(data.data.subject_color_calendor);
            $('.editSubjectModel').find('input[name="order_code"]').val(data.data.order_code);
            if (data.data.exam_exclude == "1") {
                $('.editSubjectModel').find('input[name="exam_exclude"]').prop('checked', true);
            } else {
                $('.editSubjectModel').find('input[name="exam_exclude"]').prop('checked', false);
            }
            $('.editSubjectModel').modal('show');
        }, 'json');
    });

    // update 
    $("#subjectUpdateForm").validate({
        rules: {
            name: "required",
            short_name: "required"
        }
    });
    // update 
    $('#subjectUpdateForm').on('submit', function (e) {
        e.preventDefault();
        var sectionValid = $("#subjectUpdateForm").valid();
        if (sectionValid === true) {

            var editsubjectID = $("#editsubjectID").val();
            var editsubjectName = $("#editsubjectName").val();
            var editsubjectCode = $("#editsubjectCode").val();
            var editshortName = $("#editshortName").val();
            var editsubjectType = $("#editsubjectType").val();
            var editsubjectColor = $("#editsubjectColor").val();
            var editsubjectTypeTwo = $("#editsubjectTypeTwo").val();
            var editpdf_report = $("#editpdf_report").val();
            var edit_times_per_week = $("#edit_times_per_week").val();
            var edit_order_code = $("#edit_order_code").val();
            var exam_exclude = 0;
            if ($('#editexcludeExams').is(':checked')) {
                //I am checked
                exam_exclude = 1;
            }
            var formData = new FormData();
            formData.append('token', token);
            formData.append('branch_id', branchID);
            formData.append('id', editsubjectID);
            formData.append('name', editsubjectName);
            formData.append('short_name', editshortName);
            formData.append('subject_code', editsubjectCode);
            formData.append('subject_type', editsubjectType);
            formData.append('subject_type_2', editsubjectTypeTwo);
            formData.append('pdf_report', editpdf_report);
            formData.append('times_per_week', edit_times_per_week);
            formData.append('exam_exclude', exam_exclude);
            formData.append('subject_color', editsubjectColor);
            formData.append('order_code', edit_order_code);

            $.ajax({
                url: subjectsUpdateUrl,
                method: "post",
                data: formData,
                processData: false,
                dataType: 'json',
                contentType: false,
                success: function (data) {
                    if (data.code == 200) {
                        $('#subjects-table').DataTable().ajax.reload(null, false);
                        $('.editSubjectModel').modal('hide');
                        $('.editSubjectModel').find('form')[0].reset();
                        toastr.success(data.message);
                    } else {
                        $('.editSubjectModel').modal('hide');
                        $('.editSubjectModel').find('form')[0].reset();
                        toastr.error(data.message);
                    }
                }, error: function (err) {
                    toastr.error(err.responseJSON.data.error ? err.responseJSON.data.error : 'Something went wrong');
                }
            });
        }
    });

    // delete form
    $(document).on('click', '#deleteSubjectBtn', function () {
        var id = $(this).data('id');
        var url = subjectsDeleteUrl;
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
                    id: id,
                    token: token,
                    branch_id: branchID
                }, function (data) {

                    if (data.code == 200) {
                        $('#subjects-table').DataTable().ajax.reload(null, false);
                        toastr.success(data.message);
                    } else {
                        toastr.error(data.message);
                    }
                }, 'json');
            }
        });
    });

    //GET ALL 
    var table = $('#subjects-table').DataTable({
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
                }
            },
            {
                extend: 'pdfHtml5',
                text: downloadpdf,
                extension: '.pdf',
                charset: 'utf-8',
                bom: true,
                exportOptions: {
                    columns: 'th:not(:last-child)',
                    // format: {
                    //     header: function ( data ) {
                    //         var n = data.indexOf("<select>");
                    //         if (n > -1) {
                    //         return data.substring(0, n);
                    //         } else {
                    //         return data;
                    //         }
                    //     }              
                    // }    
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
        ajax: subjectsList,
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
                data: 'short_name',
                name: 'short_name'
            },
            {
                data: 'subject_code',
                name: 'subject_code'
            },
            {
                data: 'subject_type',
                name: 'subject_type'
            },
            {
                data: 'order_code',
                name: 'order_code'
            },
            {
                data: 'subject_color_calendor',
                name: 'subject_color_calendor'
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
});