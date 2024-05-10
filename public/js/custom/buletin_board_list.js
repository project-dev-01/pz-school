$(function () {
    buletinTable();
    function buletinTable() {
        $('#buletin-table').DataTable({
            processing: true,
            info: true,
            dom: "<'row'<'col-sm-2 col-md-2'l><'col-sm-4 col-md-4'B><'col-sm-6 col-md-6'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-6'i><'col-sm-6'p>>",
            //dom: 'lBfrtip',
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
                    url: buletinBoardList,
                    success: function(data) {
                        console.log(data.data.length);
                        if (data && data.data.length > 0) {
                            console.log('ok');
                            $('#buletin-table_wrapper .buttons-csv').removeClass('disabled');
                            $('#buletin-table_wrapper .buttons-pdf').removeClass('disabled');  // Enable all buttons if at least one record exists
                        } else {
                            console.log(data);
                            $('#buletin-table_wrapper .buttons-csv').addClass('disabled');
                            $('#buletin-table_wrapper .buttons-pdf').addClass('disabled');               
                        }
                    },
                    error: function() {
                        console.log('error');
                        // Handle error if necessary
                    }
                });
            },
            ajax: buletinBoardList,
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
                    data: 'discription',
                    name: 'discription',
                    render: function(data, type, row) {
                        if (type === 'display' || type === 'filter') {
                            // Preserve whitespace and display line breaks
                            return '<div style="white-space: pre-line;">' + data + '</div>';
                        }
                        return data;
                    }
                },
                {
                    data: 'file',
                    name: 'file',
                    render: function(data, type, full, meta) {
                        // Check if data is not null and not empty
                        if (data && data.trim() !== '') {
                            // Split the data string into an array of file names
                            var files = data.split(',');
                            var fileLinks = '';
                            // Iterate over each file in the array
                            files.forEach(function(file) {
                                // Trim the file name and construct the file link
                                var trimmedFile = file.trim();
                                var fileLink = image_url + trimmedFile;
                                // Append the file link wrapped in a <div> to the fileLinks string
                                fileLinks += '<div><a href="' + fileLink + '" target="_blank">' + trimmedFile + '</a></div>';
                            });
                            // Return the generated HTML
                            return fileLinks;
                        } else {
                            // Return empty string if data is null or empty
                            return '<span class="text-muted">' + no_file_uploaded_txt +'</span>';
                        }
                    }
                },
                {
                    data: 'target_user',
                    name: 'target_user'
                },{
                    data: 'publish_date',
                    name: 'publish_date',
                    render: function(data, type, row) {
                        if (data && (type === 'display' || type === 'filter')) {
                            // Split the datetime string into date and time parts
                            var parts = data.split(' ');
                            // Display only the date part (assuming it's the first part of the split string)
                            return parts[0];
                        }
                        return data;
                    }
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
    // $('#buletin-table').on('click', '.view-description', function() {
    //     // Get the full description from the data-description attribute of the button
    //     var fullDescription = $(this).data('description');

    //     // Update modal body with full description
    //     $('#descriptionModalBody').text(fullDescription);
    // });



    $(document).on('click', '#viewBuletinBtn', function () {
        var buletin_id = $(this).data('id');
        $('.viewBuletin').find('span.error-text').text('');
        $.post(buletinBoardDetails, { id: buletin_id }, function (data) {
            console.log(data);
            $('.viewBuletin').find('.title').text(data.data.title);
            $('.viewBuletin').find('.file').html(data.data.file ? data.data.file.split(',').map(function(file) {
                var trimmedFile = file.trim();
                var fileLink = image_url + trimmedFile;
                // Append the file link wrapped in a <div> to the fileLinks string
                return '<div><a href="' + fileLink + '" target="_blank">' + trimmedFile + '</a></div>';
            }).join('') : '<span class="text-muted">' + no_file_uploaded_txt +'</span>');
            $('.viewBuletin').find('.publish_date').text(data.data.publish_date);
            $('.viewBuletin').find('.publish_end_date').text(data.data.publish_end_date);
           
            var targetUserValues = data.data.target_user.split(',');
            if (targetUserValues.includes('5')) {
                var content = data.data.name + "<br>";

                if (data.data.grade_name !== null) {
                    content += "Grade: " + data.data.grade_name + "<br>";
                }

                if (data.data.section_name !== null) {
                    content += "Class: " + data.data.section_name + "<br>";
                }

                if (data.data.parent_name !== null) {
                    content += "Parent: " + data.data.parent_name;
                }
                $('.viewBuletin').find('.target_user').html(content);
              
            } else if (targetUserValues.includes('4')) {
                var content = data.data.name + "<br>";

                if (data.data.department_name !== null) {
                    content += "Department: " + data.data.department_name + "<br>";
                }
                $('.viewBuletin').find('.target_user').html(content);
            }else{
                var content = data.data.name + "<br>";

                if (data.data.grade_name !== null) {
                    content += "Grade: " + data.data.grade_name + "<br>";
                }

                if (data.data.section_name !== null) {
                    content += "Class: " + data.data.section_name + "<br>";
                }

                if (data.data.student_name !== null) {
                    content += "Student: " + data.data.student_name;
                }
                $('.viewBuletin').find('.target_user').html(content);
                
            }
            
            $('.viewBuletin').find('.description').html(data.data.discription);
            $('.viewBuletin').modal('show');
        }, 'json');
    });

    // delete Event Type
    $(document).on('click', '#deleteBuletin_boardBtn', function () {
        var buletin_id = $(this).data('id');
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
                $.post(buletinBoardDelete, { id: buletin_id }, function (data) {
                    if (data.code == 200) {
                        $('#buletin-table').DataTable().ajax.reload(null, false);
                        toastr.success(data.message);
                    } else {
                        toastr.error(data.message);
                    }
                }, 'json');
            }
        });
    });
});