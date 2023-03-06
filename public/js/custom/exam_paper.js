$(function () {

    $('#changeClassName').on('change', function () {
        var class_id = $(this).val();
        var IDnames = "#addExamPaperModal";
        var subject_id = null;
        getSubjects(class_id, IDnames, subject_id);
    });
    $('#editchangeClassName').on('change', function () {
        var class_id = $(this).val();
        var IDnames = "#editExamPaperModal";
        var subject_id = null;
        getSubjects(class_id, IDnames, subject_id);
    });
    function getSubjects(class_id, IDnames, subject_id) {

        $(IDnames).find("#subjectID").empty();
        $(IDnames).find("#subjectID").append('<option value="">Select Subject</option>');
        $.post(classesByAllSubjects, { token: token, branch_id: branchID, class_id: class_id }, function (res) {
            if (res.code == 200) {
                $.each(res.data, function (key, val) {
                    $(IDnames).find("#subjectID").append('<option value="' + val.subject_id + '">' + val.subject_name + '</option>');
                });
                if (subject_id) {
                    $(IDnames).find('select[name="subject_id"]').val(subject_id);
                }
            }
        }, 'json');
    }

    // rules validation
    $("#exam-paper-form").validate({
        rules: {
            class_id: "required",
            subject_id: "required",
            paper_name: "required",
            paper_type: "required",
            grade_category: "required",
            paper_type: "required"
        }
    });
    // add exam
    $('#exam-paper-form').on('submit', function (e) {
        e.preventDefault();
        var Check = $("#exam-paper-form").valid();
        if (Check === true) {

            var class_id = $('.addExamPaper').find('select[name="class_id"]').val();
            var subject_id = $('.addExamPaper').find('select[name="subject_id"]').val();
            var paper_name = $('.addExamPaper').find('input[name="paper_name"]').val();
            var paper_type = $('.addExamPaper').find('select[name="paper_type"]').val();
            var grade_category = $('.addExamPaper').find('select[name="grade_category"]').val();
            var subject_weightage = $('.addExamPaper').find('input[name="subject_weightage"]').val();
            var notes = $('.addExamPaper').find('textarea[name="notes"]').val();

            var formData = new FormData();
            formData.append('token', token);
            formData.append('branch_id', branchID);
            formData.append('class_id', class_id);
            formData.append('subject_id', subject_id);
            formData.append('paper_name', paper_name);
            formData.append('paper_type', paper_type);
            formData.append('grade_category', grade_category);
            formData.append('subject_weightage', subject_weightage);
            formData.append('notes', notes);
            formData.append('academic_session_id', academic_session_id);

            $.ajax({
                url: examPaperAdd,
                method: "post",
                data: formData,
                processData: false,
                dataType: 'json',
                contentType: false,
                success: function (data) {
                    if (data.code == 200) {
                        $('#exam-paper-table').DataTable().ajax.reload(null, false);
                        $('.addExamPaper').modal('hide');
                        $('.addExamPaper').find('form')[0].reset();
                        toastr.success(data.message);
                    } else {
                        $('.addExamPaper').modal('hide');
                        $('.addExamPaper').find('form')[0].reset();
                        toastr.error(data.message);
                    }
                }
            });
        }
    });

    // get all exam table for admin
    var table = $('#exam-paper-table').DataTable({
        processing: true,
        info: true,
        // dom: 'lBfrtip',
        dom: "<'row'<'col-sm-2 col-md-2'l><'col-sm-4 col-md-4'B><'col-sm-6 col-md-6'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-6'i><'col-sm-6'p>>",
        buttons: [
            {
                extend: 'csv',
                text: 'Download CSV',
                extension: '.csv',
                exportOptions: {
                    columns: 'th:not(:last-child)'
                }
            },
            {
                extend: 'pdf',
                text: 'Download PDF',
                extension: '.pdf',
                exportOptions: {
                    columns: 'th:not(:last-child)'
                }

            }
        ],
        ajax: examPaperList,
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
                data: 'class_name',
                name: 'class_name'
            },
            {
                data: 'subject_name',
                name: 'subject_name'
            },
            {
                data: 'grade_category_name',
                name: 'grade_category_name'
            },
            {
                data: 'paper_name',
                name: 'paper_name'
            },
            {
                data: 'paper_type_name',
                name: 'paper_type_name'
            },
            {
                data: 'subject_weightage',
                name: 'subject_weightage'
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
    $(document).on('click', '#editExamPaperBtn', function () {
        var id = $(this).data('id');
        $('.editExamPaper').find('form')[0].reset();
        $.post(examPaperDetails, {
            id: id,
            token: token,
            branch_id: branchID
        }, function (data) {

            var class_id = data.data.class_id;
            var subject_id = data.data.subject_id;
            var IDnames = "#editExamPaperModal";
            getSubjects(class_id, IDnames, subject_id);

            $('.editExamPaper').find('input[name="id"]').val(data.data.id);
            $('.editExamPaper').find('select[name="class_id"]').val(data.data.class_id);
            $('.editExamPaper').find('input[name="paper_name"]').val(data.data.paper_name);
            $('.editExamPaper').find('select[name="paper_type"]').val(data.data.paper_type);
            $('.editExamPaper').find('select[name="grade_category"]').val(data.data.grade_category);
            $('.editExamPaper').find('input[name="subject_weightage"]').val(data.data.subject_weightage);
            $('.editExamPaper').find('textarea[name="notes"]').val(data.data.notes);
            $('.editExamPaper').modal('show');
        }, 'json');
    });

    // rules validation
    $("#edit-exam-paper-form").validate({
        rules: {
            class_id: "required",
            subject_id: "required",
            paper_name: "required",
            paper_type: "required",
            grade_category: "required",
            paper_type: "required"
        }
    });
    // update exam
    $('#edit-exam-paper-form').on('submit', function (e) {
        e.preventDefault();
        var Check = $("#edit-exam-paper-form").valid();
        if (Check === true) {

            var id = $('.editExamPaper').find('input[name="id"]').val();
            var class_id = $('.editExamPaper').find('select[name="class_id"]').val();
            var subject_id = $('.editExamPaper').find('select[name="subject_id"]').val();
            var paper_name = $('.editExamPaper').find('input[name="paper_name"]').val();
            var paper_type = $('.editExamPaper').find('select[name="paper_type"]').val();
            var grade_category = $('.editExamPaper').find('select[name="grade_category"]').val();
            var subject_weightage = $('.editExamPaper').find('input[name="subject_weightage"]').val();
            var notes = $('.editExamPaper').find('textarea[name="notes"]').val();

            var formData = new FormData();
            formData.append('token', token);
            formData.append('branch_id', branchID);
            formData.append('id', id);
            formData.append('class_id', class_id);
            formData.append('subject_id', subject_id);
            formData.append('paper_name', paper_name);
            formData.append('paper_type', paper_type);
            formData.append('grade_category', grade_category);
            formData.append('subject_weightage', subject_weightage);
            formData.append('notes', notes);
            formData.append('academic_session_id', academic_session_id);

            $.ajax({
                url: examPaperUpdate,
                method: "post",
                data: formData,
                processData: false,
                dataType: 'json',
                contentType: false,
                success: function (data) {
                    if (data.code == 200) {
                        $('#exam-paper-table').DataTable().ajax.reload(null, false);
                        $('.editExamPaper').modal('hide');
                        $('.editExamPaper').find('form')[0].reset();
                        toastr.success(data.message);
                    } else {
                        $('.editExamPaper').modal('hide');
                        $('.editExamPaper').find('form')[0].reset();
                        toastr.error(data.message);
                    }
                }
            });
        }
    });
    // delete ExamDelete
    $(document).on('click', '#deleteExamPaperBtn', function () {
        var id = $(this).data('id');
        var url = examPaperDelete;
        swal.fire({
            title: 'Are you sure?',
            html: 'You want to <b>delete</b> this Exam Paper',
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
                        $('#exam-paper-table').DataTable().ajax.reload(null, false);
                        toastr.success(data.message);
                    } else {
                        toastr.error(data.message);
                    }
                }, 'json');
            }
        });
    });
});