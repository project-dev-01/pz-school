$(function () {

    departmentTable();
    $("#departmentForm").validate({
        rules: {
            department_name: "required"
        }
    });
    $("#edit-department-form").validate({
        rules: {
            name: "required"
        }
    });
    // add department
    $('#departmentForm').on('submit', function (e) {
        e.preventDefault();
        var deptCheck = $("#departmentForm").valid();
        if (deptCheck === true) {
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
                        $('#department-table').DataTable().ajax.reload(null, false);
                        $('.addDepartment').modal('hide');
                        $('.addDepartment').find('form')[0].reset();
                        toastr.success(data.message);
                    } else {
                        toastr.error(data.message);
                    }
                }
            });
        }
    });

    // get all department table
    function departmentTable() {
        $('#department-table').DataTable({
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
            ajax: departmentList,
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
    $(document).on('click', '#editDepartmentBtn', function () {
        var id = $(this).data('id');

        $('.editDepartment').find('form')[0].reset();
        $.post(departmentDetails, { id: id }, function (data) {
            $('.editDepartment').find('input[name="id"]').val(data.data.id);
            $('.editDepartment').find('input[name="name"]').val(data.data.name);
            $('.editDepartment').modal('show');
        }, 'json');
        console.log(id);
    });
    // update department
    // update section
    $('#edit-department-form').on('submit', function (e) {
        e.preventDefault();
        var edt_deptCheck = $("#edit-department-form").valid();
        if (edt_deptCheck === true) {

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
                            $('#department-table').DataTable().ajax.reload(null, false);
                            $('.editDepartment').modal('hide');
                            $('.editDepartment').find('form')[0].reset();
                            toastr.success(data.message);
                        } else {
                            $('.editDepartment').modal('hide');
                            $('.editDepartment').find('form')[0].reset();
                            toastr.error(data.message);
                        }
                    }
                }
            });
        }
    });
    // delete departmentDelete
    $(document).on('click', '#deleteDepartmentBtn', function () {
        var id = $(this).data('id');
        var url = departmentDelete;
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
                        $('#department-table').DataTable().ajax.reload(null, false);
                        toastr.success(data.message);
                    } else {
                        toastr.error(data.message);
                    }
                }, 'json');
            }
        });
    });
});