$(function () {
    emailTemplateTable();
    $("#emailTemplateForm").validate({
        rules: {
            type_id: "required",
            subject: "required",
            template_body: "required"
        }
    });
    $("#edit-email-template-form").validate({
        rules: {
            type_id: "required",
            subject: "required",
            template_body: "required"
        }
    });
    // add emailTemplate
    $('#emailTemplateForm').on('submit', function (e) {
        e.preventDefault();
        var emailCheck = $("#emailTemplateForm").valid();
        if (emailCheck === true) {
            var form = this;

            $.ajax({
                url: $(form).attr('action'),
                method: $(form).attr('method'),
                data: new FormData(form),
                processData: false,
                dataType: 'json',
                contentType: false,
                success: function (data) {
                    // console.log("------")
                    console.log(data)
                    if (data.code == 200) {
                        $('#email-template-table').DataTable().ajax.reload(null, false);
                        toastr.success(data.message);
                        window.location.href = emailTemplateIndex;
                    } else {
                        toastr.error(data.message);
                    }
                }
            });
        }
    });

    // get all emailTemplate table
    function emailTemplateTable() {
        $('#email-template-table').DataTable({
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
                    url: emailTemplateList,
                    success: function(data) {
                        console.log(data.data.length);
                        if (data && data.data.length > 0) {
                            console.log('ok');
                            $('#email-template-table_wrapper .buttons-csv').removeClass('disabled');
                            $('#email-template-table_wrapper .buttons-pdf').removeClass('disabled');  // Enable all buttons if at least one record exists
                        } else {
                            console.log(data);
                            $('#email-template-table_wrapper .buttons-csv').addClass('disabled');
                            $('#email-template-table_wrapper .buttons-pdf').addClass('disabled');               
                        }
                    },
                    error: function() {
                        console.log('error');
                        // Handle error if necessary
                    }
                });
            },
            ajax: emailTemplateList,
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
                    data: 'type_id',
                    name: 'type_id'
                },
                {
                    data: 'subject',
                    name: 'subject'
                },
                {
                    data: 'template_body',
                    name: 'template_body'
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
    $(document).on('click', '#editEmailTemplateBtn', function () {
        var id = $(this).data('id');

        $('.editEmailTemplate').find('form')[0].reset();
        $.post(emailTemplateDetails, { id: id }, function (data) {
            $('.editEmailTemplate').find('input[name="id"]').val(data.data.id);
            $('.editEmailTemplate').find('input[name="name"]').val(data.data.name);
            $('.editEmailTemplate').modal('show');
        }, 'json');
        console.log(id);
    });
    // update EmailTemplate
    $('#edit-email-template-form').on('submit', function (e) {
        e.preventDefault();
        var edt_emailCheck = $("#edit-email-template-form").valid();
        if (edt_emailCheck === true) {

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
                            $('#email-template-table').DataTable().ajax.reload(null, false);
                            toastr.success(data.message);
                            window.location.href = emailTemplateIndex;
                        } else {
                            $('.editEmailTemplate').modal('hide');
                            $('.editEmailTemplate').find('form')[0].reset();
                            toastr.error(data.message);
                        }
                    }
                }
            });
        }
    });
    // delete EmailTemplateDelete
    $(document).on('click', '#deleteEmailTemplateBtn', function () {
        var id = $(this).data('id');
        var url = emailTemplateDelete;
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
                        $('#email-template-table').DataTable().ajax.reload(null, false);
                        toastr.success(data.message);
                    } else {
                        toastr.error(data.message);
                    }
                }, 'json');
            }
        });
    });
    
    

    $('.btn_tag').on('click', function() {
        var txtToAdd = $(this).data("value");
        $('.summernote').summernote('editor.insertText', txtToAdd);
    });

    // $('.btn_tag').on('click', function() {
        // var txtToAdd = $(this).data("value");
        // $('textarea#template_body').ckeditor().editor.insertText('some text here');
        
        // CKEDITOR.instances['template_body'].setData(txtToAdd);
        // $('.summernote').ckeditor('editor.insertText', txtToAdd);
    // });
});