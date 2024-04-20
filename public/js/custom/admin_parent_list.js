$(function () {

    var formData = {
        status: ""
    };
    if (parentList !== undefined && parentList !== null) {
        getParentList(formData);
    }
    $('#parentFilter').on('submit', function (e) {
        e.preventDefault();
        var status = $('#parent_status').val();
        var formData = {
            status: status
        };
        getParentList(formData);

    });

    function getParentList(formData) {

        
        var table = $('#parent-table').DataTable({
            processing: true,
            serverSide: true,
            info: true,
            bDestroy: true,
            dom: 'Blfrtip',
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
            // exportOptions: { rows: ':visible' },
            serverSide: true,
            ajax: {
                url: parentList,
                data: function (d) {
                    Object.assign(d, formData);
                }
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
            pageLength: 10,
            lengthMenu: [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false },
                { data: 'name', name: 'name' },
                { data: 'occupation', name: 'occupation' },
                { data: 'email', name: 'email' },
                { data: 'actions', name: 'actions', orderable: false, searchable: false }
            ],
            columnDefs: [
                {
                    targets: 1,
                    className: 'table-user',
                    render: function (data, type, row, meta) {
                        var currentImg = parentImg + '/'+ row.photo;
                        
                        var img = (row.photo != null) ? currentImg : defaultImg;
                        return '<img src="' + img + '" class="mr-2 rounded-circle">' +
                            '<a href="javascript:void(0);" class="text-body font-weight-semibold">' + data + '</a>';
                    }
                }
            ]
        });
    }
        // delete Parent 
        $(document).on('click', '#deleteParentBtn', function () {
            var id = $(this).data('id');
            var url = parentDelete;
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
                            $('#parent-table').DataTable().ajax.reload(null, false);
                            toastr.success(data.message);
                        } else {
                            toastr.error(data.message);
                        }
                    }, 'json');
                }
            });
        });
});