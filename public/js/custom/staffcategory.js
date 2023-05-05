$(function () {

    staffcategoryTable();
    $("#addstaffcategory").validate({
        rules: {
            name: "required"
        }
    });
    $("#edit-staffcategory-form").validate({
        rules: {
            name: "required"
        }
    });
    // add department
    $('#addstaffcategory').on('submit', function (e) {
        e.preventDefault();
        var deptCheck = $("#addstaffcategory").valid();
        if (deptCheck === true) {
            var form = this;
            console.log('enterd');
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
                        $('#staffcategory-table').DataTable().ajax.reload(null, false);
                        $('.addstaffcategory').modal('hide');
                        $('.addstaffcategory').find('form')[0].reset();
                        toastr.success(data.message);
                    } else {
                        toastr.error(data.message);
                    }
                }
            });
        }
    });

    // get all staffcategory table
    function staffcategoryTable() {
        console.log('hai');
        $('#staffcategory-table').DataTable({
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
            ajax: staffcategoryList,
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
    $(document).on('click', '#editstaffcategoryBtn', function () {
        var id = $(this).data('id');

        $('.editstaffcatg').find('form')[0].reset();
        $.post(staffcategoryDetails, { id: id }, function (data) {
            $('.editstaffcatg').find('input[name="id"]').val(data.data.id);
            $('.editstaffcatg').find('input[name="name"]').val(data.data.name);
            $('.editstaffcatg').modal('show');
        }, 'json');
        console.log(id);
    });
    // update department
    // update section
    $('#edit-staffcategory-form').on('submit', function (e) {
        e.preventDefault();
        var edt_deptCheck = $("#edit-staffcategory-form").valid();
        if (edt_deptCheck === true) {
            console.log('enter');
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
                            $('#staffcategory-table').DataTable().ajax.reload(null, false);
                            $('.editstaffcatg').modal('hide');
                            $('.editstaffcatg').find('form')[0].reset();
                            toastr.success(data.message);
                        } else {
                            $('.editstaffcatg').modal('hide');
                            $('.editstaffcatg').find('form')[0].reset();
                            toastr.error(data.message);
                        }
                    }
                }
            });
        }
    });
    // delete departmentDelete
    $(document).on('click', '#deletstaffcategoryBtn', function () {
        var id = $(this).data('id');
        var url = staffcategoryDelete;
        swal.fire({
            title: 'Are you sure?',
            html: 'You want to <b>delete</b> this department',
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
                        $('#staffcategory-table').DataTable().ajax.reload(null, false);
                        toastr.success(data.message);
                    } else {
                        toastr.error(data.message);
                    }
                }, 'json');
            }
        });
    });
});