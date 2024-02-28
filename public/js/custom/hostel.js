$(function () {

    hostelTable();

    $(document).on('click', '#addHostel', function () {

        console.log('1')
        $('.select2-selection__rendered').html('<li class="select2-search select2-search--inline"><input class="select2-search__field" type="search" tabindex="0" autocomplete="off" autocorrect="off" autocapitalize="none" spellcheck="false" role="searchbox" aria-autocomplete="list" placeholder="Choose ..." style="width: 424.034px;" aria-controls="select2-block_warden-jy-results" aria-activedescendant="select2-block_warden-jy-result-hnrw-54"></li>');
        $('.select2-search__field').attr('placeholder', warden_name_lang);
        $('#hostelForm').trigger("reset");
    });
    $("#hostelForm").validate({
        rules: {
            name: "required",
            category: "required",
            "watchman[]": "required",
            address: "required",
        }
    });
    $("#edit-hostel-form").validate({
        rules: {
            name: "required",
            category: "required",
            "watchman[]": "required",
            address: "required",
        }
    });
    // add hostel
    $('#hostelForm').on('submit', function (e) {
        e.preventDefault();
        var hostelCheck = $("#hostelForm").valid();
        if (hostelCheck === true) {
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
                        $('#hostel-table').DataTable().ajax.reload(null, false);
                        $('.addHostel').modal('hide');
                        $('.addHostel').find('form')[0].reset();
                        toastr.success(data.message);
                    } else {
                        toastr.error(data.message);
                    }
                }
            });
        }
    });

    // get all hostel table
    function hostelTable() {
        $('#hostel-table').DataTable({
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
            ajax: hostelList,
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
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'category',
                    name: 'category'
                },
                {
                    data: 'watchman',
                    name: 'watchman'
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
    }


    // get row
    // $(document).on('click', '#editHostelBtn', function () {
    //     $('.editHostel').modal('show');

    //     $('.editHostel').on('shown.bs.modal', function () {
    //         $('#watch').focus();
    //     }); 
    // });

    $(document).on('click', '#editHostelBtn', function () {
        var id = $(this).data('id');

        $('#watch').focus();
        $('.editHostel').find('form')[0].reset();
        $('.select2-selection__rendered').html('');

        // $('.select2 select2-container select2-container--default').addClass('check');
        // $('#watchman').attr('data-select2-id','watchman');
        $.post(hostelDetails, { id: id }, function (data) {
            $('.editHostel').find('input[name="id"]').val(data.data.id);
            $('.editHostel').find('input[name="name"]').val(data.data.name);
            $('.editHostel').find('select[name="category"]').val(data.data.category_id);

            var warden_arr = [];
            if(data.data.watchman) {
                var warden_arr = data.data.watchman.split(',');
            }
            $(".watchman").select2();
            $(".watchman").val(warden_arr).trigger("change");
            $('.editHostel').find('input[name="address"]').val(data.data.address);
            $('.editHostel').find('textarea[name="remarks"]').text(data.data.remarks);
            $('.editHostel').modal('show');
            // $('.editHostel').modal('show');
        }, 'json');
        $("#watchman").trigger("chosen:updated");
        console.log(id);
    });
    // update Hostel
    $('#edit-hostel-form').on('submit', function (e) {
        e.preventDefault();
        var edt_hostelCheck = $("#edit-hostel-form").valid();
        if (edt_hostelCheck === true) {

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
                            $('#hostel-table').DataTable().ajax.reload(null, false);
                            $('.editHostel').modal('hide');
                            $('.editHostel').find('form')[0].reset();
                            toastr.success(data.message);
                        } else {
                            $('.editHostel').modal('hide');
                            $('.editHostel').find('form')[0].reset();
                            toastr.error(data.message);
                        }
                    }
                }
            });
        }
    });
    // delete HostelDelete
    $(document).on('click', '#deleteHostelBtn', function () {
        var id = $(this).data('id');
        var url = hostelDelete;
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
                        $('#hostel-table').DataTable().ajax.reload(null, false);
                        toastr.success(data.message);
                    } else {
                        toastr.error(data.message);
                    }
                }, 'json');
            }
        });
    });
});