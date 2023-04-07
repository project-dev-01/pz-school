$(function () {

    $('#changeClassName').on('change', function () {
        var class_id = $(this).val();
        var IDnames = "#addAssignClassSubject";
        var section_id = null;
        getSections(class_id, IDnames, section_id);
    });
    $('#editchangeClassName').on('change', function () {
        var class_id = $(this).val();
        var IDnames = "#updateAssignClassSubject";
        var section_id = null;
        getSections(class_id, IDnames, section_id);
    });
    function getSections(class_id, IDnames, section_id) {

        $(IDnames).find("#assignSubjects").empty();
        $(IDnames).find("#assignSubjects").append('<option value="">'+select_subject+'</option>');
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
    //
    $('#sectionID').on('change', function () {
        var class_id = $("#changeClassName").val();
        var section_id = $(this).val();
        var IDnames = "#addAssignClassSubject";
        var subject_id = null;
        getSectionsBySub(class_id, IDnames, section_id, subject_id);
    });
    $('.editsectionID').on('change', function () {
        var class_id = $("#editchangeClassName").val();
        var section_id = $(this).val();
        var IDnames = "#updateAssignClassSubject";
        var subject_id = null;
        getSectionsBySub(class_id, IDnames, section_id, subject_id);
    });
    function getSectionsBySub(class_id, IDnames, section_id, subject_id) {
        $(IDnames).find("#assignSubjects").empty();
        $(IDnames).find("#assignSubjects").append('<option value="">'+select_subject+'</option>');

        $.post(getAssignClassSubjUrl, {
            token: token,
            branch_id: branchID,
            class_id: class_id,
            section_id: section_id,
            academic_session_id: academic_session_id
        }, function (res) {
            if (res.code == 200) {
                $.each(res.data, function (key, val) {
                    $(IDnames).find("#assignSubjects").append('<option value="' + val.subject_id + '">' + val.subject_name + '</option>');
                });
                if (subject_id) {
                    $(IDnames).find('select[name="subject_id"]').val(subject_id);
                }
            }
        }, 'json');
    }
    // rules validation
    $("#addAssignClassSubject").validate({
        rules: {
            class_name: "required",
            section_name: "required",
            subject_id: "required",
            class_teacher: "required",
            type: "required"
        }
    });
    // add 
    $('#addAssignClassSubject').on('submit', function (e) {
        e.preventDefault();
        var classValid = $("#addAssignClassSubject").valid();
        if (classValid === true) {
            var changeClassName = $("#changeClassName").val();
            var sectionID = $("#sectionID").val();
            var assignSubjects = $("#assignSubjects").val();
            var assignClassTeacher = $("#assignClassTeacher").val();
            var subjectType = $("#subjectType").val();

            var formData = new FormData();
            formData.append('token', token);
            formData.append('branch_id', branchID);
            formData.append('class_id', changeClassName);
            formData.append('section_id', sectionID);
            formData.append('subject_id', assignSubjects);
            formData.append('teacher_id', assignClassTeacher);
            formData.append('type', subjectType);
            formData.append('academic_session_id', academic_session_id);

            $.ajax({
                url: classAssignTeacherAddUrl,
                method: "post",
                data: formData,
                processData: false,
                dataType: 'json',
                contentType: false,
                success: function (data) {

                    if (data.code == 200) {
                        $('#class-assign-subjects-teacher-table').DataTable().ajax.reload(null, false);
                        $('.addAssignClassSubjectModal').modal('hide');
                        $('.addAssignClassSubjectModal').find('form')[0].reset();
                        toastr.success(data.message);
                    } else {
                        $('.addAssignClassSubjectModal').modal('hide');
                        $('.addAssignClassSubjectModal').find('form')[0].reset();
                        toastr.error(data.message);
                    }
                }, error: function (err) {
                    toastr.error(err.responseJSON.data.error ? err.responseJSON.data.error : 'Something went wrong');
                }
            });
        }
    });

    // edit 

    $(document).on('click', '#editAssiClassSubTeacBtn', function () {
        var id = $(this).data('id');
        $.post(classAssignTeacherGetRowUrl, {
            id: id,
            token: token,
            branch_id: branchID
        }, function (data) {
            console.log("res " + data.data)
            console.log("type " + data.data.type)
            var class_id = data.data.class_id;
            var section_id = data.data.section_id;
            var subject_id = data.data.subject_id;

            var IDnames = "#updateAssignClassSubject";
            getSections(class_id, IDnames, section_id);
            getSectionsBySub(class_id, IDnames, section_id, subject_id);
            $('.editAssClassSubjectModel').find('input[name="assign_class_sub_id"]').val(data.data.id);
            $('.editAssClassSubjectModel').find('select[name="class_name"]').val(data.data.class_id);
            $('.editAssClassSubjectModel').find('select[name="subject_id"]').val(data.data.subject_id);
            $('.editAssClassSubjectModel').find('select[name="class_teacher"]').val(data.data.teacher_id);
            $('.editAssClassSubjectModel').find('select[name="type"]').val(data.data.type);
            $('.editAssClassSubjectModel').modal('show');
        }, 'json');
    });

    // update 
    $("#updateAssignClassSubject").validate({
        rules: {
            class_name: "required",
            section_name: "required",
            subject_id: "required",
            class_teacher: "required",
            type: "required"
        }
    });
    // update 
    $('#updateAssignClassSubject').on('submit', function (e) {
        e.preventDefault();
        var sectionValid = $("#updateAssignClassSubject").valid();
        if (sectionValid === true) {

            var assign_class_sub_id = $("#updateAssignClassSubject").find("input[name=assign_class_sub_id]").val();
            var changeClassName = $("#updateAssignClassSubject").find("select[name=class_name]").val();
            var sectionID = $("#updateAssignClassSubject").find("select[name=section_name]").val();
            var assignSubjects = $("#updateAssignClassSubject").find("select[name=subject_id]").val();
            var classTeacher = $("#updateAssignClassSubject").find("select[name=class_teacher]").val();
            var type = $("#updateAssignClassSubject").find("select[name=type]").val();

            var formData = new FormData();
            formData.append('token', token);
            formData.append('branch_id', branchID);
            formData.append('id', assign_class_sub_id);
            formData.append('class_id', changeClassName);
            formData.append('section_id', sectionID);
            formData.append('subject_id', assignSubjects);
            formData.append('teacher_id', classTeacher);
            formData.append('type', type);
            formData.append('academic_session_id', academic_session_id);

            $.ajax({
                url: classAssignTeacherUpdateUrl,
                method: "post",
                data: formData,
                processData: false,
                dataType: 'json',
                contentType: false,
                success: function (data) {
                    if (data.code == 200) {
                        $('#class-assign-subjects-teacher-table').DataTable().ajax.reload(null, false);
                        $('.editAssClassSubjectModel').modal('hide');
                        $('.editAssClassSubjectModel').find('form')[0].reset();
                        toastr.success(data.message);
                    } else {
                        $('.editAssClassSubjectModel').modal('hide');
                        $('.editAssClassSubjectModel').find('form')[0].reset();
                        toastr.error(data.message);
                    }
                }, error: function (err) {
                    toastr.error(err.responseJSON.data.error ? err.responseJSON.data.error : 'Something went wrong');
                }
            });
        }
    });

    // delete form
    $(document).on('click', '#deleteAssiClassSubTeacBtn', function () {
        var id = $(this).data('id');
        var url = classAssignTeacherDeleteUrl;
        swal.fire({
            title: 'Are you sure?',
            html: 'You want to <b>delete</b> this assign subject teacher',
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
                        $('#class-assign-subjects-teacher-table').DataTable().ajax.reload(null, false);
                        toastr.success(data.message);
                    } else {
                        toastr.error(data.message);
                    }
                }, 'json');
            }
        });
    });

    //GET ALL 
    var table = $('#class-assign-subjects-teacher-table').DataTable({
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
        ajax: classAssignTeacherSubList,
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
                data: 'subject_name',
                name: 'subject_name'
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
        ],
        columnDefs: [
            {
                "targets": 5,
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
                        type = "Alternative";
                    }
                    var pass_fail = '<span class="badge badgeLabel ' + passTag + ' badge-pill ">' + type + '</span>';
                    return pass_fail;
                }
            }
        ]
    }).on('draw', function () {
    });
});