$(function () {
    if (deptIDs) {
        var Selector = '#attendanceFilter';
        var department_id = deptIDs;
        var classID = classIDS;
        classAllocation(department_id, Selector, classID);
    }
    if (deptIDs && classIDS) {
        $("#attendanceFilter").find("#sectionID").empty();
        $("#attendanceFilter").find("#sectionID").append('<option value="">' + select_class + '</option>');
        $.post(teacherSectionUrl, { token: token, branch_id: branchID, teacher_id: ref_user_id, class_id: classIDS }, function (res) {
            if (res.code == 200) {
                $.each(res.data, function (key, val) {
                    $("#attendanceFilter").find("#sectionID").append('<option value="' + val.section_id + '">' + val.section_name + '</option>');
                });
                if (secIDs != '' || secIDs != null) {
                    $("#attendanceFilter").find('select[name="section_id"]').val(secIDs);
                }
            }
        }, 'json');
    }
    $("#department_id").on('change', function (e) {
        e.preventDefault();
        var Selector = '#attendanceFilter';
        var department_id = $(this).val();
        var classID = "";
        classAllocation(department_id, Selector, classID);
    });
    function classAllocation(department_id, Selector, classID) {
        $(Selector).find('select[name="class_id"]').empty();
        $(Selector).find('select[name="class_id"]').append('<option value="">' + select_grade + '</option>');
        $(Selector).find('select[name="section_id"]').empty();
        $(Selector).find('select[name="section_id"]').append('<option value="">' + select_class + '</option>');
        if (department_id) {
            $.post(getGradeByDepartmentUrl,
                {
                    branch_id: branchID,
                    department_id: department_id,
                    teacher_id: ref_user_id
                }, function (res) {
                    if (res.code == 200) {
                        $.each(res.data, function (key, val) {
                            $(Selector).find('select[name="class_id"]').append('<option value="' + val.id + '">' + val.name + '</option>');
                        });
                        if (classID != '' || classID != null) {
                            $(Selector).find('select[name="class_id"]').val(classID);
                        }
                    }
                }, 'json');
        }
    }
    // change classroom
    $('#changeClassName').on('change', function () {
        $(".attendanceReport").hide();
        var class_id = $(this).val();
        $("#attendanceFilter").find("#sectionID").empty();
        $("#attendanceFilter").find("#sectionID").append('<option value="">' + select_class + '</option>');

        $.post(teacherSectionUrl, { token: token, branch_id: branchID, teacher_id: ref_user_id, class_id: class_id }, function (res) {
            if (res.code == 200) {
                $.each(res.data, function (key, val) {
                    $("#attendanceFilter").find("#sectionID").append('<option value="' + val.section_id + '">' + val.section_name + '</option>');
                });
            }
        }, 'json');
    });
    // change section
    $('#sectionID').on('change', function () {
        var section_id = $(this).val();
        var class_id = $("#changeClassName").val();
        $("#attendanceFilter").find("#subjectID").empty();
        $("#attendanceFilter").find("#subjectID").append('<option value="">' + select_subject + '</option>');
        $.post(teacherSubjectUrl, {
            token: token,
            branch_id: branchID,
            teacher_id: ref_user_id,
            class_id: class_id,
            section_id: section_id,
            class_id: class_id,
            academic_session_id: academic_session_id,
        }, function (res) {
            if (res.code == 200) {
                $.each(res.data, function (key, val) {
                    $("#attendanceFilter").find("#subjectID").append('<option value="' + val.subject_id + '">' + val.subject_name + '</option>');
                });
            }
        }, 'json');
    });

    // rules validation
    // $("#attendanceFilter").validate({
    //     rules: {
    //         class_id: "required",
    //         class_id: "required",
    //         section_id: "required",
    //         subject_id: "required",
    //         pattern: "required",
    //         class_date: "required",
    //     }
    // });

    $('#attendanceFilter').on('submit', function (e) {
        e.preventDefault();
        var department_id = $("#department_id").val();
        var class_id = $("#changeClassName").val();
        var section_id = $("#sectionID").val();
        var pattern = $("#pattern").val();
        var formData = new FormData();
        formData.append('branch_id', branchID);
        formData.append('department_id', department_id);
        formData.append('class_id', class_id);
        formData.append('section_id', section_id);
        formData.append('staff_id', ref_user_id);
        formData.append('pattern', pattern);
        formData.append('academic_session_id', academic_session_id);
        $.ajax({
            url: saveStgPage,
            method: "POST",
            data: formData,
            processData: false,
            dataType: 'json',
            contentType: false,
            success: function (response) {
                if (response.code == 200) {
                    toastr.success(response.message);
                } else {
                    toastr.error(response.message);
                }
            }
        });
        // studentAttendanceList(formData, reportDate, pattern)

    });
});