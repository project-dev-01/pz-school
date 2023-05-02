$(function () {

    // rules validation
    $("#yearSubmit").validate({
        rules: {
            name: "required"
        }
    });
    // add
    $('#yearSubmit').on('submit', function (e) {
        e.preventDefault();
        var classValid = $("#yearSubmit").valid();
        if (classValid === true) {
            var academicYear = $("#academicYear").val();
            var formData = new FormData();
            formData.append('token', token);
            formData.append('branch_id', branchID);
            formData.append('name', academicYear);
            $.ajax({
                url: academicYearAddUrl,
                method: "post",
                data: formData,
                processData: false,
                dataType: 'json',
                contentType: false,
                success: function (data) {
                    if (data.code == 200) {
                        $('#academic-year-table').DataTable().ajax.reload(null, false);
                        $('.academicYearModal').modal('hide');
                        $('.academicYearModal').find('form')[0].reset();
                        toastr.success(data.message);
                    } else {
                        $('.academicYearModal').modal('hide');
                        $('.academicYearModal').find('form')[0].reset();
                        toastr.error(data.message);
                    }
                }, error: function (err) {
                    toastr.error(err.responseJSON.data.error ? err.responseJSON.data.error : 'Something went wrong');
                }
            });
        }
    });

    // edit
    $(document).on('click', '#editAcademicBtn', function () {
        var id = $(this).data('id');
        $.post(academicYearGetRowUrl, {
            id: id,
            token: token,
            branch_id: branchID
        }, function (data) {
            console.log(data.data.name);
            $('.editacademicYearModal').find('input[name="id"]').val(data.data.id);
            $('.editacademicYearModal').find('select[name="name"]').val(data.data.name);
            $('.editacademicYearModal').modal('show');
        }, 'json');
    });

    // update
    $("#academicYearUpdateForm").validate({
        rules: {
            name: "required"
        }
    });
    // update
    $('#academicYearUpdateForm').on('submit', function (e) {
        e.preventDefault();
        var valid = $("#academicYearUpdateForm").valid();
        if (valid === true) {
            var acdemicYearID = $("#acdemicYearID").val();
            var editacademicYear = $("#editacademicYear").val();
            var formData = new FormData();
            formData.append('id', acdemicYearID);
            formData.append('token', token);
            formData.append('branch_id', branchID);
            formData.append('name', editacademicYear);

            $.ajax({
                url: academicYearUpdateUrl,
                method: "post",
                data: formData,
                processData: false,
                dataType: 'json',
                contentType: false,
                success: function (data) {
                    if (data.code == 200) {
                        $('#academic-year-table').DataTable().ajax.reload(null, false);
                        $('.editacademicYearModal').modal('hide');
                        $('.editacademicYearModal').find('form')[0].reset();
                        toastr.success(data.message);
                    } else {
                        $('.editacademicYearModal').modal('hide');
                        $('.editacademicYearModal').find('form')[0].reset();
                        toastr.error(data.message);
                    }
                }, error: function (err) {
                    toastr.error(err.responseJSON.data.error ? err.responseJSON.data.error : 'Something went wrong');
                }
            });
        }
    });

    // delete form
    $(document).on('click', '#deleteAcademicBtn', function () {
        var id = $(this).data('id');
        var url = academicYearDeleteUrl;
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
                    id: id,
                    token: token,
                    branch_id: branchID
                }, function (data) {

                    if (data.code == 200) {
                        $('#academic-year-table').DataTable().ajax.reload(null, false);
                        toastr.success(data.message);
                    } else {
                        toastr.error(data.message);
                    }
                }, 'json');
            }
        });
    });

    //GET ALL
    var table = $('#academic-year-table').DataTable({
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
        ajax: academicYearList,
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
});