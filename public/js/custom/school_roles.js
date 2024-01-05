$(function () {
   
    //
    function selectRefresh() {
        $('.main .select2').select2({
            //-^^^^^^^^--- update here
            tags: true,
            placeholder: "Select an Option",
            allowClear: true,
            width: '100%'
        });
    }
    $('.add').click(function () {
        $('.main').append($('.new-wrap').html());
        selectRefresh();
    });
    //debugger;
    selectRefresh();
    
    eventTypeTable();
    $("#schoolRoleForm").validate({
        rules: {
            name: "required"
        }
    });
    $("#editschoolRoleForm").validate({
        rules: {
            name: "required"
        }
    });
    // add eventType
    $('#schoolRoleForm').on('submit', function (e) {
        e.preventDefault();
        var eventCheck = $("#schoolRoleForm").valid();
        if (eventCheck === true) {
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
                        $('#school-role-table').DataTable().ajax.reload(null, false);
                        $('.addschoolRole').modal('hide');
                        $('.addschoolRole').find('form')[0].reset();
                        toastr.success(data.message);
                    } else {
                        toastr.error(data.message);
                    }
                }
            });
        }
    });

    // get all eventType table
    function eventTypeTable() {
       
        $('#school-role-table').DataTable({
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
            ajax: schoolroleList,
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
                    data: 'role_name',
                    name: 'role_name'
                },
                {
                    data: 'fullname',
                    name: 'fullname'
                },
                {
                    data: 'shortname',
                    name: 'shortname'
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
    $(document).on('click', '#editSchoolRoleBtn', function () {
        var id = $(this).data('id');

        $('.editSchoolRole').find('form')[0].reset();
        $.post(schoolroleDetails, { id: id }, function (data) {
            
            $('.editSchoolRole').find('input[name="id"]').val(data.data.id); 
            $('.editSchoolRole').find('select[name="portal_roleid"]').val(data.data.portal_roleid);          
            $('.editSchoolRole').find('input[name="fullname"]').val(data.data.fullname);
            $('.editSchoolRole').find('input[name="shortname"]').val(data.data.shortname);
            $('.editSchoolRole').modal('show');
        }, 'json');
        console.log(id);
    });
    // update EventType
    $('#edit-school_role-form').on('submit', function (e) {
        e.preventDefault();
        var edt_eventCheck = $("#edit-school_role-form").valid();
        if (edt_eventCheck === true) {

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
                            $('#school-role-table').DataTable().ajax.reload(null, false);
                            $('.editSchoolRole').modal('hide');
                            $('.editSchoolRole').find('form')[0].reset();
                            toastr.success(data.message);
                        } 
                        else {
                            $('.editSchoolRole').modal('hide');
                            $('.editSchoolRole').find('form')[0].reset();
                            toastr.error(data.message);
                        }
                    }
                }
            });
        }
    });
    // delete EventTypeDelete
    $(document).on('click', '#deleteSchoolRoleBtn', function () {
        var id = $(this).data('id');
        var url = schoolroleeDelete;
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
                        $('#school-role-table').DataTable().ajax.reload(null, false);
                        toastr.success(data.message);
                    } else {
                        toastr.error(data.message);
                    }
                }, 'json');
            }
        });
    });
    
});