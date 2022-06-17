$(function () {

    // rules validation
    $("#exam-form").validate({
        rules: {
            name: "required",
            term_id: "required",
            remarks: "required",
        }
    });
    // add exam
    $('#exam-form').on('submit', function (e) {
        e.preventDefault();
        var Check = $("#exam-form").valid();
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
                        $('#exam-table').DataTable().ajax.reload(null, false);
                        $('.addExam').modal('hide');
                        $('.addExam').find('form')[0].reset();
                        toastr.success(data.message);
                    } else {
                        $('.addExam').modal('hide');
                        $('.addExam').find('form')[0].reset();
                        toastr.error(data.message);
                    }
                }
            });
        }
    });

    // get all exam table for admin
    var table = $('#exam-table').DataTable({
        processing: true,
        info: true,
        dom: 'lBfrtip',
        buttons: [
            {
                extend: 'csv',
                text: 'Download CSV',
                extension: '.csv',
                exportOptions: {
                    columns: 'th:not(:last-child)'
                }
            }
        ],
        ajax: examList,
        "pageLength": 5,
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
                data: 'term_id',
                name: 'term_id'
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
    // get row
    $(document).on('click', '#editExamBtn', function () {
        var id = $(this).data('id');
        $('.editExam').find('form')[0].reset();
        $.post(examDetails, { id: id }, function (data) {
            $('.editExam').find('input[name="id"]').val(data.data.id);
            $('.editExam').find('input[name="name"]').val(data.data.name);
            $('.editExam').find('select[name="term_id"]').val(data.data.term_id);
            $('.editExam').find('textarea[name="remarks"]').val(data.data.remarks);
            $('.editExam').modal('show');
        }, 'json');
    });

    // rules validation
    $("#edit-exam-form").validate({
        rules: {
            name: "required",
            term_id: "required",
            remarks: "required",
        }
    });
    // update exam
    $('#edit-exam-form').on('submit', function (e) {
        e.preventDefault();
        var Check = $("#edit-exam-form").valid();
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
                        $('#exam-table').DataTable().ajax.reload(null, false);
                        $('.editExam').modal('hide');
                        $('.editExam').find('form')[0].reset();
                        toastr.success(data.message);
                    } else {
                        $('.editExam').modal('hide');
                        $('.editExam').find('form')[0].reset();
                        toastr.error(data.message);
                    }
                }
            });
        }
    });
    // delete ExamDelete
    $(document).on('click', '#deleteExamBtn', function () {
        var id = $(this).data('id');
        var url = examDelete;
        swal.fire({
            title: 'Are you sure?',
            html: 'You want to <b>delete</b> this Exam',
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
                        $('#exam-table').DataTable().ajax.reload(null, false);
                        toastr.success(data.message);
                    } else {
                        toastr.error(data.message);
                    }
                }, 'json');
            }
        });
    });
});