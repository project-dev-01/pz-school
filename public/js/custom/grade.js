$(function () {

    // rules validation
    $("#grade-form").validate({
        rules: {
            grade: "required",
            grade_point: "required",
            min_mark: "required",
            max_mark: "required",
            status: "required",
            grade_category: "required"
        }
    });
    // add grade
    $('#grade-form').on('submit', function (e) {
        e.preventDefault();
        var gradeCheck = $("#grade-form").valid();
        if (gradeCheck === true) {
            var form = this;
            $.ajax({
                url: $(form).attr('action'),
                method: $(form).attr('method'),
                data: new FormData(form),
                processData: false,
                dataType: 'json',
                contentType: false,
                success: function (data) {
                    if (data.code == 200) {
                        $('#grade-table').DataTable().ajax.reload(null, false);
                        $('.addGrade').modal('hide');
                        $('.addGrade').find('form')[0].reset();
                        toastr.success(data.message);
                    } else {
                        $('.addGrade').modal('hide');
                        $('.addGrade').find('form')[0].reset();
                        toastr.error(data.message);
                    }
                }
            });
        }
    });

    // get all grade table for admin
    var table = $('#grade-table').DataTable({
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
        ajax: gradeList,
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
                data: 'grade_category_name',
                name: 'grade_category_name'
            },
            {
                data: 'notes',
                name: 'notes'
            },
            {
                data: 'grade',
                name: 'grade'
            },
            {
                data: 'grade_point',
                name: 'grade_point'
            },
            {
                data: 'min_mark',
                name: 'min_mark'
            },
            {
                data: 'max_mark',
                name: 'max_mark'
            },
            {
                data: 'status',
                name: 'status'
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
    $(document).on('click', '#editGradeBtn', function () {
        var id = $(this).data('id');
        $('.editGrade').find('form')[0].reset();
        $.post(gradeDetails, { id: id }, function (data) {
            $('.editGrade').find('input[name="id"]').val(data.data.id);
            $('.editGrade').find('input[name="grade"]').val(data.data.grade);
            $('.editGrade').find('input[name="grade_point"]').val(data.data.grade_point);
            $('.editGrade').find('input[name="min_mark"]').val(data.data.min_mark);
            $('.editGrade').find('input[name="max_mark"]').val(data.data.max_mark);
            $('.editGrade').find('select[name="status"]').val(data.data.status);
            $('.editGrade').find('select[name="grade_category"]').val(data.data.grade_category);
            $('.editGrade').find('input[name="notes"]').val(data.data.notes);
            $('.editGrade').modal('show');
        }, 'json');
    });

    // rules validation
    $("#edit-grade-form").validate({
        rules: {
            grade: "required",
            grade_point: "required",
            min_mark: "required",
            max_mark: "required",
            status: "required",
            grade_category: "required"
        }
    });
    // update grade
    $('#edit-grade-form').on('submit', function (e) {
        e.preventDefault();
        var gradeCheck = $("#edit-grade-form").valid();
        if (gradeCheck === true) {
            var form = this;
            $.ajax({
                url: $(form).attr('action'),
                method: $(form).attr('method'),
                data: new FormData(form),
                processData: false,
                dataType: 'json',
                contentType: false,
                success: function (data) {
                    if (data.code == 200) {
                        $('#grade-table').DataTable().ajax.reload(null, false);
                        $('.editGrade').modal('hide');
                        $('.editGrade').find('form')[0].reset();
                        toastr.success(data.message);
                    } else {
                        $('.editGrade').modal('hide');
                        $('.editGrade').find('form')[0].reset();
                        toastr.error(data.message);
                    }
                }
            });
        }
    });
    // delete GradeDelete
    $(document).on('click', '#deleteGradeBtn', function () {
        var id = $(this).data('id');
        var url = gradeDelete;
        swal.fire({
            title: 'Are you sure?',
            html: 'You want to <b>Delete</b> this Grade',
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
                        $('#grade-table').DataTable().ajax.reload(null, false);
                        toastr.success(data.message);
                    } else {
                        toastr.error(data.message);
                    }
                }, 'json');
            }
        });
    });
});