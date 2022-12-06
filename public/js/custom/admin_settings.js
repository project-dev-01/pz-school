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
                console.log("-$$$$-");
                console.log(data);
                if (data.status == 0) {
                    $.each(data.error, function (prefix, val) {
                        $('span.' + prefix + '_error').text(val[0]);
                    });
                } else {
                    console.log("----");
                    console.log(data);

                    // $('.user_name').each(function () {
                    //     $(this).html($('#updateProfileInfo').find($('input[name="name"]')).val());
                    // });
                    // toastr.success(data.msg);
                    // alert(data.msg);
                    if (data.code == 200) {
                        console.log(data.code);
                        // $('.user_name').each(function () {
                        //     $(this).html($('#updateProfileInfo').find($('input[name="name"]')).val());
                        // });
                        toastr.success(data.message);
                        location.reload();
                    } else {
                        console.log(data.code);
                        toastr.error(data.message);
                    }
                }
            }, error: function (err) {
                toastr.error(err.responseJSON.data.error ? err.responseJSON.data.error : 'Something went wrong');
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
                    if (data.code == 200) {
                        $('#changeNewPassword')[0].reset();
                        toastr.success(data.message);
                    } else if (data.code == 422) {
                        if (data.data.error.old) {
                            toastr.error(data.data.error.old[0]);
                        }
                        if (data.data.error.password) {
                            toastr.error(data.data.error.password[0]);
                        }
                        if (data.data.error.confirmed) {
                            toastr.error(data.data.error.confirmed[0]);
                        }
                    } else {
                        toastr.error(data.message);
                    }

                }
            }, error: function (err) {
                if (err.responseJSON.code == 422) {
                    toastr.error(err.responseJSON.data.error.oldpassword[0] ? err.responseJSON.data.error.oldpassword[0] : 'Something went wrong');
                }
            }
        });
    });

    $('#upload_form').on('change', '#profile_image', function (event) {
        event.preventDefault();
        var formData = new FormData();
        formData.append('id', userID);
        formData.append('token', token);
        formData.append('branch_id', branchID);
        formData.append('staff_id', ref_user_id);
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
    // upload logo
    $('#upload_form').on('change', '#change_logo', function (event) {
        event.preventDefault();
        var formData = new FormData();
        // formData.append('id', userID);
        formData.append('id', branchID);
        formData.append('token', token);
        // Attach file
        formData.append('change_logo', $('input[type=file]')[0].files[0]);
        $.ajax({
            url: changeLogoUrl,
            method: "POST",
            data: formData,
            dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                console.log(data)
                if (data.code == 200) {
                    toastr.success(data.message);
                    $('.school_logo_picture').attr('src', subLogoPath + "/" + data.data.logo);
                    $.ajax({
                        type: "POST",
                        url: updateLogoSession,
                        data: { school_logo: data.data.logo },
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
