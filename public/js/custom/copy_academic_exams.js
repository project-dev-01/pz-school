$(function () {
    // rules validation
    $("#createCopyAssignTeacher").validate({
        rules: {
            academic_session_id: "required",
            copy_academic_session_id: "required"
        }
    });
    $('#createCopyAssignTeacher').on('submit', function (e) {
        e.preventDefault();
        var promValid = $("#createCopyAssignTeacher").valid();
        if (promValid === true) {

            var academic_session_id = $("#academic_session_id").val();
            var copy_academic_session_id = $("#copy_academic_session_id").val();
            var formData = new FormData();
            formData.append('token', token);
            formData.append('branch_id', branchID);
            formData.append('academic_session_id', academic_session_id);
            formData.append('copy_academic_session_id', copy_academic_session_id);
            $.ajax({
                url: acdemicCopyAssignTeacherUrl,
                method: "post",
                data: formData,
                processData: false,
                dataType: 'json',
                contentType: false,
                success: function (data) {
                    if (data.code == 200) {
                        $('#createCopyAssignTeacher')[0].reset();
                        toastr.success(data.message);
                    } else {
                        $('#createCopyAssignTeacher')[0].reset();
                        toastr.error(data.message);
                    }
                }, error: function (err) {
                    toastr.error(err.responseJSON.data.error ? err.responseJSON.data.error : 'Something went wrong');
                }
            });
        };
    });
});