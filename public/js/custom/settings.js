$(function () {

    // update profile details
    $('#updateProfileInfo').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            url: $(this).attr('action'),
            method: $(this).attr('method'),
            data: new FormData(this),
            processData: false,
            dataType: 'json',
            contentType: false,
            beforeSend: function () {
                $(document).find('span.error-text').text('');
            },
            success: function (data) {
                if (data.status == 0) {
                    $.each(data.error, function (prefix, val) {
                        $('span.' + prefix + '_error').text(val[0]);
                    });
                } else {
                    $('.user_name').each(function () {
                        $(this).html($('#updateProfileInfo').find($('input[name="name"]')).val());
                    });
                    toastr.success(data.msg);
                    // alert(data.msg);
                }
            }
        });
    });

    // change password

    $('#changeNewPassword').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            url: $(this).attr('action'),
            method: $(this).attr('method'),
            data: new FormData(this),
            processData: false,
            dataType: 'json',
            contentType: false,
            beforeSend: function () {
                $(document).find('span.error-text').text('');
            },
            success: function (data) {
                if (data.status == 0) {
                    $.each(data.error, function (prefix, val) {
                        $('span.' + prefix + '_error').text(val[0]);
                    });
                } else {
                    $('#changeNewPassword')[0].reset();
                    toastr.success(data.msg);
                }
            }
        });
    });

    $('#upload_form').on('change', '#profile_image', function (event) {
        event.preventDefault();
        var formData = new FormData();
        formData.append('id', userID);
        formData.append('token', token);
        // Attach file
        formData.append('profile_image', $('input[type=file]')[0].files[0]);
        $.ajax({
            url: profileUpdateStg,
            method: "POST",
            data: formData,
            dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                if (data.code == 200) {
                    toastr.success(data.message);
                    $('.admin_picture').attr('src', profilePath + "/" + data.data.file_name);
                    $.ajax({
                        type: "POST",
                        url: updateSettingSession,
                        data: { picture: data.data.file_name },
                        success: function (res) {
                            console.log("--------")
                            console.log(res)
                        }
                    });
                } else {
                    toastr.error(data.message);
                }

            }, error: function (err) {
                if (err.responseJSON.code == 422) {
                    toastr.error(err.responseJSON.data.error.profile_image[0] ? err.responseJSON.data.error.profile_image[0] : 'Something went wrong');
                }
            }
        })
    });

});
