$(function () {

    // rules validation
    $("#grade-category-form").validate({
        rules: {
            name: "required"
        }
    });
    // add exam
    $('#grade-category-form').on('submit', function (e) {
        e.preventDefault();
        var Check = $("#grade-category-form").valid();
        if (Check === true) {
            var name = $('.addGradeCategory').find('input[name="name"]').val();

            var formData = new FormData();
            formData.append('token', token);
            formData.append('branch_id', branchID);
            formData.append('name', name);
            $.ajax({
                url: gradeCategoryAdd,
                method: "post",
                data: formData,
                processData: false,
                dataType: 'json',
                contentType: false,
                success: function (data) {
                    if (data.code == 200) {
                        $('#grade-category-table').DataTable().ajax.reload(null, false);
                        $('.addGradeCategory').modal('hide');
                        $('.addGradeCategory').find('form')[0].reset();
                        toastr.success(data.message);
                    } else {
                        $('.addGradeCategory').modal('hide');
                        $('.addGradeCategory').find('form')[0].reset();
                        toastr.error(data.message);
                    }
                }, error: function (err) {
                    toastr.error(err.responseJSON.data.error ? err.responseJSON.data.error : 'Something went wrong');
                }
            });
        }
    });

    // get all exam table for admin
    var table = $('#grade-category-table').DataTable({
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
        ajax: gradeCategoryList,
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
    // get row
    $(document).on('click', '#editGradeCategoryBtn', function () {
        var id = $(this).data('id');
        $('.editGradeCategory').find('form')[0].reset();
        $.post(gradeCategoryDetails, {
            id: id,
            token: token,
            branch_id: branchID
        }, function (data) {
            $('.editGradeCategory').find('input[name="id"]').val(data.data.id);
            $('.editGradeCategory').find('input[name="name"]').val(data.data.name);
            $('.editGradeCategory').modal('show');
        }, 'json');
    });

    // rules validation
    $("#edit-grade-category-form").validate({
        rules: {
            name: "required"
        }
    });
    // update exam
    $('#edit-grade-category-form').on('submit', function (e) {
        e.preventDefault();
        var Check = $("#edit-grade-category-form").valid();
        if (Check === true) {

            var id = $('.editGradeCategory').find('input[name="id"]').val();
            var name = $('.editGradeCategory').find('input[name="name"]').val();

            var formData = new FormData();
            formData.append('token', token);
            formData.append('branch_id', branchID);
            formData.append('id', id);
            formData.append('name', name);

            $.ajax({
                url: gradeCategoryUpdate,
                method: "post",
                data: formData,
                processData: false,
                dataType: 'json',
                contentType: false,
                success: function (data) {
                    if (data.code == 200) {
                        $('#grade-category-table').DataTable().ajax.reload(null, false);
                        $('.editGradeCategory').modal('hide');
                        $('.editGradeCategory').find('form')[0].reset();
                        toastr.success(data.message);
                    } else {
                        $('.editGradeCategory').modal('hide');
                        $('.editGradeCategory').find('form')[0].reset();
                        toastr.error(data.message);
                    }
                }, error: function (err) {
                    toastr.error(err.responseJSON.data.error ? err.responseJSON.data.error : 'Something went wrong');
                }
            });
        }
    });
    // delete
    $(document).on('click', '#deleteGradeCategoryBtn', function () {
        var id = $(this).data('id');
        var url = gradeCategoryDelete;
        swal.fire({
            title: 'Are you sure?',
            html: 'You want to <b>delete</b> this grade category',
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
                    id: id,
                    token: token,
                    branch_id: branchID
                }, function (data) {
                    if (data.code == 200) {
                        $('#grade-category-table').DataTable().ajax.reload(null, false);
                        toastr.success(data.message);
                    } else {
                        toastr.error(data.message);
                    }
                }, 'json');
            }
        });
    });
});