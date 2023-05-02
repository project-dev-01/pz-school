$(function () {

    hostelCategoryTable();
    $("#hostelCategoryForm").validate({
        rules: {
            name: "required"
        }
    });
    $("#edit-hostel-category-form").validate({
        rules: {
            name: "required"
        }
    });
    // add hostelCategory
    $('#hostelCategoryForm').on('submit', function (e) {
        e.preventDefault();
        var eventCheck = $("#hostelCategoryForm").valid();
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
                        $('#hostel-category-table').DataTable().ajax.reload(null, false);
                        $('.addHostelCategory').modal('hide');
                        $('.addHostelCategory').find('form')[0].reset();
                        toastr.success(data.message);
                    } else {
                        toastr.error(data.message);
                    }
                }
            });
        }
    });

    // get all hostelCategory table
    function hostelCategoryTable() {
        $('#hostel-category-table').DataTable({
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
            ajax: hostelCategoryList,
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
    $(document).on('click', '#editHostelCategoryBtn', function () {
        var id = $(this).data('id');

        $('.editHostelCategory').find('form')[0].reset();
        $.post(hostelCategoryDetails, { id: id }, function (data) {
            $('.editHostelCategory').find('input[name="id"]').val(data.data.id);
            $('.editHostelCategory').find('input[name="name"]').val(data.data.name);
            $('.editHostelCategory').modal('show');
        }, 'json');
        console.log(id);
    });
    // update HostelCategory
    $('#edit-hostel-category-form').on('submit', function (e) {
        e.preventDefault();
        var edt_eventCheck = $("#edit-hostel-category-form").valid();
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
                            $('#hostel-category-table').DataTable().ajax.reload(null, false);
                            $('.editHostelCategory').modal('hide');
                            $('.editHostelCategory').find('form')[0].reset();
                            toastr.success(data.message);
                        } else {
                            $('.editHostelCategory').modal('hide');
                            $('.editHostelCategory').find('form')[0].reset();
                            toastr.error(data.message);
                        }
                    }
                }
            });
        }
    });
    // delete HostelCategoryDelete
    $(document).on('click', '#deleteHostelCategoryBtn', function () {
        var id = $(this).data('id');
        var url = hostelCategoryDelete;
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
                        $('#hostel-category-table').DataTable().ajax.reload(null, false);
                        toastr.success(data.message);
                    } else {
                        toastr.error(data.message);
                    }
                }, 'json');
            }
        });
    });
});