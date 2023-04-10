$(function () {

    soapNotesTable();
    $("#soapNotesForm").validate({
        rules: {
            notes: "required",
            soap_category_id: "required",
            soap_sub_category_id: "required",
            soap_type_id: "required"
        }
    });
    $("#edit-soap-notes-form").validate({
        rules: {
            notes: "required",
            soap_category_id: "required",
            soap_sub_category_id: "required",
            soap_type_id: "required"
        }
    });

    

    $('#soap_type_id').on('change', function () {
        var soap_type_id = $(this).val();
        var IDnames = "#soapNotesForm";
        var category_id = "#soap_category_id";
        var selected_category_id = null;
        getCategory(soap_type_id, IDnames, category_id, selected_category_id);
    });
    $('#edit_soap_type_id').on('change', function () {
        var soap_type_id = $(this).val();
        var IDnames = "#edit-soap-notes-form";
        var category_id = "#edit_soap_category_id";
        var selected_category_id = null;
        getCategory(soap_type_id, IDnames, selected_category_id);
    });
    function getCategory(soap_type_id, IDnames,category_id, selected_category_id) {

        $(IDnames).find(category_id).empty();
        $(IDnames).find(category_id).append('<option value="">'+select_category+'</option>');
        $(IDnames).find("#soap_sub_category_id").empty();
        $(IDnames).find("#soap_sub_category_id").append('<option value="">'+select_sub_category+'</option>');

        $.post(categoryList, { token: token, branch_id: branchID, soap_type_id: soap_type_id }, function (res) {
            if (res.code == 200) {
                $.each(res.data, function (key, val) {
                    $(IDnames).find(category_id).append('<option value="' + val.id + '">' + val.name + '</option>');
                });
                if (selected_category_id) {
                    $(IDnames).find('select[name="soap_category_id"]').val(selected_category_id);
                } 
            }
        }, 'json');
    }

    $('#soap_category_id').on('change', function () {
        var soap_category_id = $(this).val();
        var IDnames = "#soapNotesForm";
        var sub_category_id = null;
        getSubCategory(soap_category_id, IDnames, sub_category_id);
    });
    $('#edit_soap_category_id').on('change', function () {
        var soap_category_id = $(this).val();
        var IDnames = "#edit-soap-notes-form";
        var sub_category_id = null;
        getSubCategory(soap_category_id, IDnames, sub_category_id);
    });
    function getSubCategory(soap_category_id, IDnames, sub_category_id) {

        $(IDnames).find("#soap_sub_category_id").empty();
        $(IDnames).find("#soap_sub_category_id").append('<option value="">'+select_sub_category+'</option>');

        $.post(subCategoryList, { token: token, branch_id: branchID, soap_category_id: soap_category_id }, function (res) {
            if (res.code == 200) {
                $.each(res.data, function (key, val) {
                    $(IDnames).find("#soap_sub_category_id").append('<option value="' + val.id + '">' + val.name + '</option>');
                });
                if (sub_category_id) {
                    $(IDnames).find('select[name="soap_sub_category_id"]').val(sub_category_id);
                } 
                
            }
        }, 'json');
    }

    // add soapNotes
    $('#soapNotesForm').on('submit', function (e) {
        e.preventDefault();
        var soapCheck = $("#soapNotesForm").valid();
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
                        $('#soap-notes-table').DataTable().ajax.reload(null, false);
                        $('.addSoapNotes').modal('hide');
                        $('.addSoapNotes').find('form')[0].reset();
                        toastr.success(data.message);
                    } else {
                        toastr.error(data.message);
                    }
                }
            });
        }
    });

    // get all soapNotes table
    function soapNotesTable() {
        $('#soap-notes-table').DataTable({
            processing: true,
            info: true,
            bDestroy: true,
            // dom: 'lBfrtip',
            dom: "<'row'<'col-sm-2 col-md-2'l><'col-sm-4 col-md-4'B><'col-sm-6 col-md-6'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-6'i><'col-sm-6'p>>",
            "language": {
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
                    exportOptions: {
                        columns: 'th:not(:last-child)'
                    }
                },
                {
                    extend: 'pdf',
                    text: downloadpdf,
                    extension: '.pdf',
                    exportOptions: {
                        columns: 'th:not(:last-child)'
                    }

                }
            ],
            ajax: soapNotesList,
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
                    data: 'soap_category_id',
                    name: 'soap_category_id'
                },
                {
                    data: 'soap_sub_category_id',
                    name: 'soap_sub_category_id'
                },
                {
                    data: 'notes',
                    name: 'notes'
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
    $(document).on('click', '#editSoapNotesBtn', function () {
        var id = $(this).data('id');

        $('.editSoapNotes').find('form')[0].reset();
        $.post(soapNotesDetails, { id: id }, function (data) {
            
            var soap_type_id = data.data.soap_type_id;
            var soap_category_id = data.data.soap_category_id;
            var category_id = "#edit_soap_category_id";
            var IDnames = "#edit-soap-notes-form";
            var sub_category_id = data.data.soap_sub_category_id;
            getCategory(soap_type_id, IDnames, category_id, soap_category_id);
            getSubCategory(soap_category_id, IDnames, sub_category_id);
            $('.editSoapNotes').find('input[name="id"]').val(data.data.id);
            $('.editSoapNotes').find('input[name="notes"]').val(data.data.notes);
            $('.editSoapNotes').find('select[name="soap_type_id"]').val(data.data.soap_type_id);
            $('.editSoapNotes').modal('show');
        }, 'json');
        console.log(id);
    });
    // update SoapNotes
    $('#edit-soap-notes-form').on('submit', function (e) {
        e.preventDefault();
        var edt_soapCheck = $("#edit-soap-notes-form").valid();
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
                            $('#soap-notes-table').DataTable().ajax.reload(null, false);
                            $('.editSoapNotes').modal('hide');
                            $('.editSoapNotes').find('form')[0].reset();
                            toastr.success(data.message);
                        } else {
                            $('.editSoapNotes').modal('hide');
                            $('.editSoapNotes').find('form')[0].reset();
                            toastr.error(data.message);
                        }
                    }
                }
            });
        }
    });
    // delete SoapNotesDelete
    $(document).on('click', '#deleteSoapNotesBtn', function () {
        var id = $(this).data('id');
        var url = soapNotesDelete;
        swal.fire({
            title: 'Are you sure?',
            html: 'You want to <b>delete</b> this Event Type',
            showCancelButton: true,
            showCloseButton: true,
            cancelButtonText: 'Cancel',
            confirmButtonText: 'Yes, Delete',
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
                        $('#soap-notes-table').DataTable().ajax.reload(null, false);
                        toastr.success(data.message);
                    } else {
                        toastr.error(data.message);
                    }
                }, 'json');
            }
        });
    });
});