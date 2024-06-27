$(function () {
    soapSubCategoryTable();
    $("#soapSubCategoryForm").validate({
        rules: {
            name: "required",
            soap_category_id: "required",
            soap_type_id: "required",
        }
    });
    $("#edit-soap-sub-category-form").validate({
        rules: {
            name: "required",
            soap_category_id: "required",
            soap_type_id: "required",
        }
    });

    $('#soap_type_id').on('change', function () {
        var soap_type_id = $(this).val();
        var IDnames = "#soapSubCategoryForm";
        var category_id = null;
        getCategory(soap_type_id, IDnames, category_id);
    });
    $('#edit_soap_type_id').on('change', function () {
        var soap_type_id = $(this).val();
        var IDnames = "#edit-soap-sub-category-form";
        var category_id = null;
        getCategory(soap_type_id, IDnames, category_id);
    });
    function getCategory(soap_type_id, IDnames, category_id) {

        $(IDnames).find("#soap_category_id").empty();
        $(IDnames).find("#soap_category_id").append('<option value="">'+select_category+'</option>');

        $.post(categoryList, { token: token, branch_id: branchID, soap_type_id: soap_type_id }, function (res) {
            if (res.code == 200) {
                $.each(res.data, function (key, val) {
                    $(IDnames).find("#soap_category_id").append('<option value="' + val.id + '">' + val.name + '</option>');
                });
                if (category_id) {
                    $(IDnames).find('select[name="soap_category_id"]').val(category_id);
                }    
            }
        }, 'json');
    }

    $('#photo').change(function() {
        // var i = $(this).prev('label').clone();
        var file = $('#photo')[0].files[0];
        if(file.size > 10485760) { // 10MB = 10 * 1024 * 1024 bytes
            $('#photo_name').text("File greater than 10Mb");
            $("#photo_name").addClass("error");
            $('#photo').val('');
        } else {
            $("#photo_name").removeClass("error");
            $('#photo_name').text(file.name);
        }
    });
    $('#edit_photo').change(function() {
        // var i = $(this).prev('label').clone();
        var file = $('#edit_photo')[0].files[0];
        if(file.size > 10485760) { // 10MB = 10 * 1024 * 1024 bytes
            $('#edit_photo_name').text("File greater than 10Mb");
            $("#edit_photo_name").addClass("error");
            $('#edit_photo').val('');
        } else {
            $("#edit_photo_name").removeClass("error");
            $('#edit_photo_name').text(file.name);
        }
    });

    $('#addSoapSubCategoryModal').on('hidden.bs.modal', function () {
        // do something…
        $('#photo_name').text("");
    });

    $('#editSoapSubCategoryModal').on('hidden.bs.modal', function () {
        // do something…
        $('#edit_photo_name').text("");
    });

    // add soapSubCategory
    $('#soapSubCategoryForm').on('submit', function (e) {
        e.preventDefault();
        var soapCheck = $("#soapSubCategoryForm").valid();
        if (soapCheck === true) {
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
                        $('#soap-sub-category-table').DataTable().ajax.reload(null, false);
                        $('.addSoapSubCategory').modal('hide');
                        $('.addSoapSubCategory').find('form')[0].reset();
                        toastr.success(data.message);
                    } else {
                        toastr.error(data.message);
                    }
                }
            });
        }
    });

    // get all soapSubCategory table
    function soapSubCategoryTable() {
        $('#soap-sub-category-table').DataTable({
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
            ajax: soapSubCategoryList,
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
                    data: 'soap_category_id',
                    name: 'soap_category_id'
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
    $(document).on('click', '#editSoapSubCategoryBtn', function () {
        var id = $(this).data('id');

        $('.editSoapSubCategory').find('form')[0].reset();
        $.post(soapSubCategoryDetails, { id: id }, function (data) {
            console.log(data);
            var soap_type_id = data.data.soap_type_id;
            var IDnames = "#edit-soap-sub-category-form";
            var category_id = data.data.soap_category_id;
            var img = imageUrl + data.data.photo;
            getCategory(soap_type_id, IDnames, category_id);
            $('.editSoapSubCategory').find('input[name="id"]').val(data.data.id);
            $('.editSoapSubCategory').find('input[name="name"]').val(data.data.name);
            $('.editSoapSubCategory').find('select[name="soap_type_id"]').val(data.data.soap_type_id);
            $('.editSoapSubCategory').find('#edit_photo_name').text(data.data.photo);
            $('.editSoapSubCategory').find('a').attr("href", img);
            $('.editSoapSubCategory').modal('show');
        }, 'json');
    });
    // update SoapSubCategory
    $('#edit-soap-sub-category-form').on('submit', function (e) {
        e.preventDefault();
        var edt_soapCheck = $("#edit-soap-sub-category-form").valid();
        if (edt_soapCheck === true) {

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
                            $('#soap-sub-category-table').DataTable().ajax.reload(null, false);
                            $('.editSoapSubCategory').modal('hide');
                            $('.editSoapSubCategory').find('form')[0].reset();
                            toastr.success(data.message);
                        } else {
                            $('.editSoapSubCategory').modal('hide');
                            $('.editSoapSubCategory').find('form')[0].reset();
                            toastr.error(data.message);
                        }
                    }
                }
            });
        }
    });
    // delete SoapSubCategoryDelete
    $(document).on('click', '#deleteSoapSubCategoryBtn', function () {
        var id = $(this).data('id');
        var url = soapSubCategoryDelete;
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
                        $('#soap-sub-category-table').DataTable().ajax.reload(null, false);
                        toastr.success(data.message);
                    } else {
                        toastr.error(data.message);
                    }
                }, 'json');
            }
        });
    });
});