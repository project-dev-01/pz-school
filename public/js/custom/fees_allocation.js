$(function () {
    // change classes
    $("#class_id").on('change', function (e) {
        e.preventDefault();
        var class_id = $(this).val();
        $("#section_id").empty();
        $("#section_id").append('<option value="">Select Class Name</option>');
        $.post(sectionByClass, { token: token, branch_id: branchID, class_id: class_id }, function (res) {
            if (res.code == 200) {
                $.each(res.data, function (key, val) {
                    $("#section_id").append('<option value="' + val.section_id + '">' + val.section_name + '</option>');
                });
            }
        }, 'json');
    });
    // rules validation
    $("#feesAllocation").validate({
        rules: {
            class_id: "required",
            section_id: "required",
            group_id: "required"
        }
    });
    //
    $('#feesAllocation').on('submit', function (e) {
        e.preventDefault();
        var valid = $("#feesAllocation").valid();
        if (valid === true) {
            var classID = $("#class_id").val();
            var sectionID = $("#section_id").val();
            var groupID = $("#group_id").val();

            var formData = new FormData();
            formData.append('token', token);
            formData.append('branch_id', branchID);
            formData.append('class_id', classID);
            formData.append('section_id', sectionID);
            formData.append('group_id', groupID);
            formData.append('academic_session_id', academic_session_id);

        }
    });
});