$(function () {

    // change branch id for  class and Teacher 
    $("#add_branch_id").on('change', function (e) {
        e.preventDefault();
        var Selector = '#addAssignTeacherForm';
        var branch_id = $(this).val();
        var class_id = "";
        var teacher_id = "";
        if (branch_id) {
            branchTeacherAllocation(branch_id, Selector, class_id, teacher_id);
        }
    });

    $("#edit_branch_id").on('change', function (e) {
        e.preventDefault();
        var Selector = '#editAssignTeacherForm';
        var branch_id = $(this).val();
        if (branch_id) {
            branchTeacherAllocation(branch_id, Selector);
        }
    });

    // branch TeacherAllocation
    function branchTeacherAllocation(branch_id, Selector, class_id, teacher_id) {

        $(Selector).find("#class_name").empty();
        $(Selector).find("#class_name").append('<option value="">Choose Class</option>');
        $(Selector).find("#section_name").empty();
        $(Selector).find("#section_name").append('<option value="">Choose Section</option>');
        $(Selector).find("#class_teacher").empty();
        $(Selector).find("#class_teacher").append('<option value="">Class Teacher</option>');
        $.post(branchbyAssignTeacher, { branch_id: branch_id, token: token }, function (res) {
            if (res.code == 200) {
                $.each(res.data.teacher, function (key, val) {
                    $(Selector).find("#class_teacher").append('<option value="' + val.id + '">' + val.name + '</option>');
                });
                $.each(res.data.class, function (key, val) {
                    $(Selector).find("#class_name").append('<option value="' + val.id + '">' + val.name + '</option>');
                });
                if (class_id != '') {
                    $(Selector).find('select[name="class_name"]').val(class_id);
                }
                if (teacher_id != '') {
                    $(Selector).find('select[name="class_teacher"]').val(teacher_id);
                }
            }
        }, 'json');
    }
    // change section filter
    $(".add_class_name").on('change', function (e) {
        e.preventDefault();
        var Selector = '.addAssignTeachernModal';
        var class_id = $(this).val();
        var sectionID = "";
        if (class_id) {
            sectionAllocation(class_id, Selector, sectionID);
        }
    });
    $(".edit_class_name").on('change', function (e) {
        e.preventDefault();
        var Selector = '.editAssignTeacherModal';
        var class_id = $(this).val();
        var sectionID = "";
        if (class_id) {
            sectionAllocation(class_id, Selector, sectionID);
        }
    });

    // branch TeacherAllocation
    function sectionAllocation(class_id, Selector, sectionID) {

        $(Selector).find("#section_name").empty();
        $(Selector).find("#section_name").append('<option value="">Choose Section</option>');
        $.post(getsectionAllocation, { class_id: class_id, token: token }, function (res) {
            if (res.code == 200) {
                $.each(res.data, function (key, val) {
                    $(Selector).find("#section_name").append('<option value="' + val.id + '">' + val.name + '</option>');
                });
                if (sectionID != '') {
                    $(Selector).find('select[name="section_name"]').val(sectionID);
                }
            }
        }, 'json');
    }

    // save assign teacher
    $('#addAssignTeacherForm').on('submit', function (e) {
        e.preventDefault();
        var form = this;
        $.ajax({
            url: $(form).attr('action'),
            method: $(form).attr('method'),
            data: new FormData(form),
            processData: false,
            dataType: 'json',
            contentType: false,
            beforeSend: function () {
                $(form).find('span.error-text').text('');
            },
            success: function (data) {
                if (data.code == 0) {
                    $.each(data.error, function (prefix, val) {
                        $(form).find('span.' + prefix + '_error').text(val[0]);
                    });
                } else {

                    if (data.code == 200) {
                        $('#assign-teacher-table').DataTable().ajax.reload(null, false);
                        $('.addAssignTeachernModal').modal('hide');
                        $('.addAssignTeachernModal').find('form')[0].reset();
                        toastr.success(data.message);
                    } else {
                        $('.addAssignTeachernModal').modal('hide');
                        $('.addAssignTeachernModal').find('form')[0].reset();
                        toastr.error(data.message);
                    }
                }
            }
        });
    });
    // get all assign teacher table
    var table = $('#assign-teacher-table').DataTable({
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
        ajax: assignTeacherList,
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
                data: 'branch_name',
                name: 'branch_name'
            },
            {
                data: 'class_name',
                name: 'class_name'
            },
            {
                data: 'section_name',
                name: 'section_name'
            },
            {
                data: 'teacher_name',
                name: 'teacher_name'
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

    // edit  assign Teacher
    $(document).on('click', '#editTeacherAllocationBtn', function () {
        var assign_teacher_id = $(this).data('id');
        $('.editAssignTeacherModal').find('form')[0].reset();
        $('.editAssignTeacherModal').find('span.error-text').text('');
        $.post(assignTeacherDetails, { assign_teacher_id: assign_teacher_id }, function (data) {
            $('.editAssignTeacherModal').find('select[name="assign_teacher_id"]').val(data.data.id);
            if (data.data.branch_id != "") {
                var branch_id = data.data.branch_id;
                var Selector = '#editAssignTeacherForm';
                var class_id = data.data.class_id;
                var teacher_id = data.data.teacher_id;
                branchTeacherAllocation(branch_id, Selector, class_id, teacher_id);
            }
            if (data.data.class_id != "") {
                var class_id = data.data.class_id;
                var Selector = '.editAssignTeacherModal';
                var sectionID = data.data.section_id;
                sectionAllocation(class_id, Selector, sectionID);
            }
            $('.editAssignTeacherModal').find('select[name="branch_id"]').val(data.data.branch_id);
            $('.editAssignTeacherModal').find('input[name="assign_teacher_id"]').val(data.data.id);
            $('.editAssignTeacherModal').modal('show');
        }, 'json');
    });

    // update assign teacher
    $('#editAssignTeacherForm').on('submit', function (e) {
        e.preventDefault();
        var form = this;
        $.ajax({
            url: $(form).attr('action'),
            method: $(form).attr('method'),
            data: new FormData(form),
            processData: false,
            dataType: 'json',
            contentType: false,
            beforeSend: function () {
                $(form).find('span.error-text').text('');
            },
            success: function (data) {
                if (data.code == 0) {
                    $.each(data.error, function (prefix, val) {
                        $(form).find('span.' + prefix + '_error').text(val[0]);
                    });
                } else {
                    if (data.code == 200) {
                        $('#assign-teacher-table').DataTable().ajax.reload(null, false);
                        $('.editAssignTeacherModal').modal('hide');
                        $('.editAssignTeacherModal').find('form')[0].reset();
                        toastr.success(data.message);
                    } else {
                        $('.editAssignTeacherModal').modal('hide');
                        $('.editAssignTeacherModal').find('form')[0].reset();
                        toastr.error(data.message);
                    }
                }
            }
        });
    });

    // delete Assigne Teacher
    $(document).on('click', '#deleteTeacherAllocationBtn', function () {
        var assign_teacher_id = $(this).data('id');
        swal.fire({
            title: 'Are you sure?',
            html: 'You want to <b>delete</b> this Assign Teacher',
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
                $.post(deleteAssignTeacher, { assign_teacher_id: assign_teacher_id }, function (data) {
                    if (data.code == 200) {
                        $('#assign-teacher-table').DataTable().ajax.reload(null, false);
                        toastr.success(data.message);
                    } else {
                        toastr.error(data.message);
                    }
                }, 'json');
            }
        });
    });
});