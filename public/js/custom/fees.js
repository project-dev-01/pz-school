$(function () {

    $("#btwyears").on('change', function (e) {
        e.preventDefault(); 
        $('#class_id').val("");
        $("#section_id").empty();
        $("#section_id").append('<option value="">Select Class</option>');
        $("#student_id").empty();
        $("#student_id").append('<option value="">Select Student</option>');
        $('#payment_item').val("");
        $('#payment_status').val("");
    });

    $("#class_id").on('change', function (e) {
        e.preventDefault(); 
        var class_id = $(this).val();
        $("#section_id").empty();
        $("#section_id").append('<option value="">Select Class</option>');
        $.post(sectionByClass, { token: token, branch_id: branchID,class_id: class_id }, function (res) {
            if (res.code == 200) {
                $.each(res.data, function (key, val) {
                    $("#section_id").append('<option value="' + val.section_id + '">' + val.section_name + '</option>');
                });
            }
        }, 'json');
    });
    

    $("#section_id").on('change', function (e) {
        e.preventDefault(); 
        var academic_session_id = $("#btwyears").val();
        var class_id = $("#class_id").val();
        var section_id = $(this).val();
        $("#student_id").empty();
        $("#student_id").append('<option value="">Select Student</option>');
        $.post(getStudentList, { token: token, branch_id: branchID,class_id: class_id, academic_session_id: academic_session_id,section_id: section_id }, function (res) {
            if (res.code == 200) {
                $.each(res.data, function (key, val) {
                    $("#student_id").append('<option value="' + val.id + '">' + val.name + '</option>');
                });
            }
        }, 'json');
    });
});