$(function () {

    $('#changeClassName').on('change', function () {
        var class_id = $(this).val();
        var IDnames = "#addAssignTeacherForm";
        var section_id = null;
        getSections(class_id, IDnames, section_id);
    });
    $('#editchangeClassName').on('change', function () {
        var class_id = $(this).val();
        var IDnames = "#editAssignTeacherForm";
        var section_id = null;
        getSections(class_id, IDnames, section_id);
    });
    function getSections(class_id, IDnames, section_id) {
        $(IDnames).find("#sectionID").empty();
        $(IDnames).find("#sectionID").append('<option value="">'+select_class+'</option>');

        $.post(sectionByClassUrl, { token: token, branch_id: branchID, class_id: class_id }, function (res) {
            if (res.code == 200) {
                $.each(res.data, function (key, val) {
                    $(IDnames).find("#sectionID").append('<option value="' + val.section_id + '">' + val.section_name + '</option>');
                });
                if (section_id) {
                    $(IDnames).find('select[name="section_name"]').val(section_id);
                }
            }
        }, 'json');
    }
    // rules validation
    $("#addAssignTeacherForm").validate({
        rules: {
            class_name: "required",
            section_name: "required",
            class_teacher: "required",
            type: "required"
        }
    });
    // add 
    $('#addAssignTeacherForm').on('submit', function (e) {
        e.preventDefault();
        var classValid = $("#addAssignTeacherForm").valid();
        if (classValid === true) {
            var changeClassName = $("#changeClassName").val();
            var sectionID = $("#sectionID").val();
            var assignClassTeacher = $("#assignClassTeacher").val();
            var subjectType = $("#subjectType").val();

            var formData = new FormData();
            formData.append('token', token);
            formData.append('branch_id', branchID);
            formData.append('class_id', changeClassName);
            formData.append('section_id', sectionID);
            formData.append('teacher_id', assignClassTeacher);
            formData.append('type', subjectType);
            formData.append('academic_session_id', academic_session_id);

            $.ajax({
                url: assignTeacherAddUrl,
                method: "post",
                data: formData,
                processData: false,
                dataType: 'json',
                contentType: false,
                success: function (data) {
                    if (data.code == 200) {
                        $('#assign-class-teacher-table').DataTable().ajax.reload(null, false);
                        $('.addAssignTeachernModal').modal('hide');
                        $('.addAssignTeachernModal').find('form')[0].reset();
                        toastr.success(data.message);
                    } else {
                        $('.addAssignTeachernModal').modal('hide');
                        $('.addAssignTeachernModal').find('form')[0].reset();
                        toastr.error(data.message);
                    }
                }, error: function (err) {
                    toastr.error(err.responseJSON.data.error ? err.responseJSON.data.error : 'Something went wrong');
                }
            });
        }
    });

    // edit 

    $(document).on('click', '#editClsTeacherBtn', function () {
        var id = $(this).data('id');
        $.post(assignTeacherDetailsUrl, {
            id: id,
            token: token,
            branch_id: branchID
        }, function (data) {
            var class_id = data.data.class_id;
            var section_id = data.data.section_id;
            var IDnames = "#editAssignTeacherForm";
            getSections(class_id, IDnames, section_id);
            $('.editAssignTeacherModal').find('input[name="assign_teacher_id"]').val(data.data.id);
            $('.editAssignTeacherModal').find('select[name="class_name"]').val(data.data.class_id);
            $('.editAssignTeacherModal').find('select[name="class_teacher"]').val(data.data.teacher_id);
            $('.editAssignTeacherModal').find('select[name="type"]').val(data.data.type);
            $('.editAssignTeacherModal').modal('show');
        }, 'json');
    });

    // update 
    $("#editAssignTeacherForm").validate({
        rules: {
            class_name: "required",
            section_name: "required",
            class_teacher: "required",
            type: "required"
        }
    });
    // update 
    $('#editAssignTeacherForm').on('submit', function (e) {
        e.preventDefault();
        var sectionValid = $("#editAssignTeacherForm").valid();
        if (sectionValid === true) {

            var id = $("#editAssignTeacherForm").find("input[name=assign_teacher_id]").val();
            var className = $("#editAssignTeacherForm").find("select[name=class_name]").val();
            var sectionName = $("#editAssignTeacherForm").find("select[name=section_name]").val();
            var classTeacher = $("#editAssignTeacherForm").find("select[name=class_teacher]").val();
            var type = $("#editAssignTeacherForm").find("select[name=type]").val();

            var formData = new FormData();
            formData.append('id', id);
            formData.append('token', token);
            formData.append('branch_id', branchID);
            formData.append('class_id', className);
            formData.append('section_id', sectionName);
            formData.append('teacher_id', classTeacher);
            formData.append('type', type);
            formData.append('academic_session_id', academic_session_id);

            // return false;
            $.ajax({
                url: assignTeacherUpdateUrl,
                method: "post",
                data: formData,
                processData: false,
                dataType: 'json',
                contentType: false,
                success: function (data) {
                    if (data.code == 200) {
                        $('#assign-class-teacher-table').DataTable().ajax.reload(null, false);
                        $('.editAssignTeacherModal').modal('hide');
                        $('.editAssignTeacherModal').find('form')[0].reset();
                        toastr.success(data.message);
                    } else {
                        $('.editAssignTeacherModal').modal('hide');
                        $('.editAssignTeacherModal').find('form')[0].reset();
                        toastr.error(data.message);
                    }
                }, error: function (err) {
                    toastr.error(err.responseJSON.data.error ? err.responseJSON.data.error : 'Something went wrong');
                }
            });
        }
    });

    // delete form
    $(document).on('click', '#deleteClsTeacherBtn', function () {
        var id = $(this).data('id');
        var url = assignTeacherDeleteUrl;
        swal.fire({
            title: 'Are you sure?',
            html: 'You want to <b>delete</b> assign teacher',
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
                        $('#assign-class-teacher-table').DataTable().ajax.reload(null, false);
                        toastr.success(data.message);
                    } else {
                        toastr.error(data.message);
                    }
                }, 'json');
            }
        });
    });

    //GET ALL 
    var table = $('#assign-class-teacher-table').DataTable({
        processing: true,
        info: true,
        // dom: 'lBfrtip',
        dom: "<'row'<'col-sm-2 col-md-2'l><'col-sm-4 col-md-4'B><'col-sm-6 col-md-6'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-6'i><'col-sm-6'p>>",
        "language": {
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
        ajax: assignTeacherList,
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
                data: 'section_name',
                name: 'section_name'
            },
            {
                data: 'teacher_name',
                name: 'teacher_name'
            },
            {
                data: 'type',
                name: 'type'
            },
            {
                data: 'actions',
                name: 'actions',
                orderable: false,
                searchable: false
            },
        ], columnDefs: [

            {
                "targets": 4,
                "className": "text-center",
                "render": function (data, type, row, meta) {
                    var passTag = "";
                    var type = "";
                    if (data == "0") {
                        passTag = "badge-success";
                        type = "Main";
                    }
                    if (data == "1") {
                        passTag = "badge-warning";
                        type = "Sub";
                    }
                    if (data == "2") {
                        passTag = "badge-warning";
                        type = "Alternative";
                    }
                    var pass_fail = '<span class="badge badgeLabel ' + passTag + ' badge-pill" style="padding: 6px 6px 6px 6px; margin-left: -10px;">' + type + '</span>';
                    return pass_fail;
                }
            }
        ]
    }).on('draw', function () {
    });
});