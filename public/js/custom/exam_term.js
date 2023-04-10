$(function () {

    // rules validation
    $("#exam-term-form").validate({
        rules: {
            name: "required",
        }
    });
    // add exam-term
    $('#exam-term-form').on('submit', function (e) {
        e.preventDefault();
        var Check = $("#exam-term-form").valid();
        if (Check === true) {
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
                        $('#exam-term-table').DataTable().ajax.reload(null, false);
                        $('.addExamTerm').modal('hide');
                        $('.addExamTerm').find('form')[0].reset();
                        toastr.success(data.message);
                    } else {
                        $('.addExamTerm').modal('hide');
                        $('.addExamTerm').find('form')[0].reset();
                        toastr.error(data.message);
                    }
                }
            });
        }
    });

    // get all exam-term table for admin
    var table = $('#exam-term-table').DataTable({
        processing: true,
        info: true,
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
        ajax: examTermList,
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
    $(document).on('click', '#editExamTermBtn', function () {
        var id = $(this).data('id');
        $('.editExamTerm').find('form')[0].reset();
        $.post(examTermDetails, { id: id }, function (data) {
            $('.editExamTerm').find('input[name="id"]').val(data.data.id);
            $('.editExamTerm').find('input[name="name"]').val(data.data.name);
            $('.editExamTerm').modal('show');
        }, 'json');
    });

    // rules validation
    $("#edit-exam-term-form").validate({
        rules: {
            name: "required",
        }
    });
    // update exam-term
    $('#edit-exam-term-form').on('submit', function (e) {
        e.preventDefault();
        var Check = $("#edit-exam-term-form").valid();
        if (Check === true) {
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
                        $('#exam-term-table').DataTable().ajax.reload(null, false);
                        $('.editExamTerm').modal('hide');
                        $('.editExamTerm').find('form')[0].reset();
                        toastr.success(data.message);
                    } else {
                        $('.editExamTerm').modal('hide');
                        $('.editExamTerm').find('form')[0].reset();
                        toastr.error(data.message);
                    }
                }
            });
        }
    });
    // delete ExamTermDelete
    $(document).on('click', '#deleteExamTermBtn', function () {
        var id = $(this).data('id');
        var url = examTermDelete;
        swal.fire({
            title: 'Are you sure?',
            html: 'You want to <b>delete</b> this Exam Term',
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
                        $('#exam-term-table').DataTable().ajax.reload(null, false);
                        toastr.success(data.message);
                    } else {
                        toastr.error(data.message);
                    }
                }, 'json');
            }
        });
    });
});