$(function () {

    // rules validation
    $("#exam-hall-form").validate({
        rules: {
            hall_no: "required",
            no_of_seats: "required",
        }
    });
    // add exam-hall
    $('#exam-hall-form').on('submit', function (e) {
        e.preventDefault();
        var Check = $("#exam-hall-form").valid();
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
                        $('#exam-hall-table').DataTable().ajax.reload(null, false);
                        $('.addExamHall').modal('hide');
                        $('.addExamHall').find('form')[0].reset();
                        toastr.success(data.message);
                    } else {
                        $('.addExamHall').modal('hide');
                        $('.addExamHall').find('form')[0].reset();
                        toastr.error(data.message);
                    }
                }
            });
        }
    });

    // get all exam-hall table for admin
    var table = $('#exam-hall-table').DataTable({
        processing: true,
        info: true,
        // dom: 'lBfrtip',
        dom:"<'row'<'col-sm-2'l><'col-sm-2'B><'col-sm-8'f>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-5'i><'col-sm-7'p>>",
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
        ajax: examHallList,
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
                data: 'hall_no',
                name: 'hall_no'
            },
            {
                data: 'id',
                name: 'id'
            },
            {
                data: 'no_of_seats',
                name: 'no_of_seats'
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
    $(document).on('click', '#editExamHallBtn', function () {
        var id = $(this).data('id');
        $('.editExamHall').find('form')[0].reset();
        $.post(examHallDetails, { id: id }, function (data) {
            $('.editExamHall').find('input[name="id"]').val(data.data.id);
            $('.editExamHall').find('input[name="hall_no"]').val(data.data.hall_no);
            $('.editExamHall').find('input[name="no_of_seats"]').val(data.data.no_of_seats);
            $('.editExamHall').modal('show');
        }, 'json');
    });

    // rules validation
    $("#edit-exam-hall-form").validate({
        rules: {
            hall_no: "required",
            no_of_seats: "required",
        }
    });
    // update exam-hall
    $('#edit-exam-hall-form').on('submit', function (e) {
        e.preventDefault();
        var Check = $("#edit-exam-hall-form").valid();
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
                        $('#exam-hall-table').DataTable().ajax.reload(null, false);
                        $('.editExamHall').modal('hide');
                        $('.editExamHall').find('form')[0].reset();
                        toastr.success(data.message);
                    } else {
                        $('.editExamHall').modal('hide');
                        $('.editExamHall').find('form')[0].reset();
                        toastr.error(data.message);
                    }
                }
            });
        }
    });
    // delete ExamHallDelete
    $(document).on('click', '#deleteExamHallBtn', function () {
        var id = $(this).data('id');
        var url = examHallDelete;
        swal.fire({
            title: 'Are you sure?',
            html: 'You want to <b>delete</b> this Exam Hall',
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
                        $('#exam-hall-table').DataTable().ajax.reload(null, false);
                        toastr.success(data.message);
                    } else {
                        toastr.error(data.message);
                    }
                }, 'json');
            }
        });
    });
});