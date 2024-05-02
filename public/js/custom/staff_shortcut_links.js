$(function () {

    shortcutTable();
    $("#shortcutLinkForm").validate({
        rules: {
            name: "required",
            link: "required"
        }
    });
    $("#edit-shortcut-form").validate({
        rules: {
            name: "required",
            link: "required"
        }
    });
    $(document).on('click', '#addShortCutModal', function () {
        

        $('.addShortcut').modal('show');
        $(".addShortcut").css("display", "block"); 

    });
    
    $(".addClose").click(function() { 

        $(".addShortcut").css("display", "none");
        $('.addShortcut').find('form')[0].reset();
        
    });
    // add bank
    $('#shortcutLinkForm').on('submit', function (e) {
        e.preventDefault();
        var bankCheck = $("#shortcutLinkForm").valid();
        if (bankCheck === true) {
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
                   // console.log(data)
                    if (data.code == 200) {
                        $('#shortcut-table').DataTable().ajax.reload(null, false);
                        $('.addShortcut').modal('hide');
                        $('.addShortcut').find('form')[0].reset();
                       // window.location.href = shortcutList;
                        toastr.success(data.message);
                    } else {
                        toastr.error(data.message);
                    }
                }
            });
        }
    });

    // get all bank table
    function shortcutTable() {
         $('#shortcut-table').DataTable({
            processing: true,
            info: true,
            // dom: 'lBfrtip',
            dom:"<'row'<'col-sm-2 col-md-2'l><'col-sm-4 col-md-4'B><'col-sm-6 col-md-6'f>>" +
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
                    url: shortcutList,
                    success: function(data) {
                        console.log(data.data.length);
                        if (data && data.data.length > 0) {
                            console.log('ok');
                            $('#shortcut-table_wrapper .buttons-csv').removeClass('disabled');
                            $('#shortcut-table_wrapper .buttons-pdf').removeClass('disabled');  // Enable all buttons if at least one record exists
                        } else {
                            console.log(data);
                            $('#shortcut-table_wrapper .buttons-csv').addClass('disabled');
                            $('#shortcut-table_wrapper .buttons-pdf').addClass('disabled');               
                        }
                    },
                    error: function() {
                        console.log('error');
                        // Handle error if necessary
                    }
                });
            },
            ajax: shortcutList,
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
                    data: 'sidebar_name',
                    name: 'sidebar_name'
                },
                {
                    data: 'links',
                    name: 'links'
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
    $(document).on('click', '#editShortCutBtn', function () {
        var id = $(this).data('id');
        console.log(id);
        $('.editShortcut').find('form')[0].reset();   
        $(".editShortcut").css("display", "block"); 
        $.post(shortcutDetails, { id: id }, function (data) {
            console.log(data);
            $('.editShortcut').find('input[name="id"]').val(data.data.id);
            $('.editShortcut').find('input[name="name"]').val(data.data.sidebar_name);
            $('.editShortcut').find('input[name="link"]').val(data.data.links);
            $('.editShortcut').modal('show');
        }, 'json');
    });
    // update Bank
    $('#edit-shortcut-form').on('submit', function (e) {
        e.preventDefault();
        var edt_bankCheck = $("#edit-shortcut-form").valid();
        
        if (edt_bankCheck === true) {
            console.log("ggyguy");
            var form = this;
            $.ajax({
                url: $(form).attr('action'),
                method: $(form).attr('method'),
                data: new FormData(form),
                processData: false,
                dataType: 'json',
                contentType: false,
                success: function (data) {
                    console.log(data);
                    if (data.code == 0) {
                        $.each(data.error, function (prefix, val) {
                            $(form).find('span.' + prefix + '_error').text(val[0]);
                        });
                    } else {

                        if (data.code == 200) {
                            $('#shortcut-table').DataTable().ajax.reload(null, false);
                            $('.editShortcut').modal('hide');
                            $('.editShortcut').find('form')[0].reset();
                            toastr.success(data.message);
                        } else {
                            $('.editShortcut').modal('hide');
                            $('.editShortcut').find('form')[0].reset();
                            toastr.error(data.message);
                        }
                    }
                }
            });
        }
    });
    // delete BankDelete
    $(document).on('click', '#deleteShortCutBtn', function () {
        var id = $(this).data('id');
        var url = shortcutDelete;
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
                        $('#shortcut-table').DataTable().ajax.reload(null, false);
                        toastr.success(data.message);
                    } else {
                        toastr.error(data.message);
                    }
                }, 'json');
            }
        });
    });
});