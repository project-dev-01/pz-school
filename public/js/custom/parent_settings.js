$(function () {

    // skip_mother_details
    $("#skip_mother_details").on("change", function () {
        
        if ($(this).is(":checked")) {
            
            $(".mother_form").val("");
            if ($("#copy_mother").is(":checked")) {
                $("#copy_others").prop('checked', true)
                value = "copy_others";
                copyparent(value)
            }
            $("#copy_mother").prop('disabled', true);
            $("#mother_details").hide("slow");
        } else {
            $("#copy_mother").prop('disabled', false);
            $("#mother_details").show("slow");
        }
    });
    // skip_father_details
    $("#skip_father_details").on("change", function () {
        if ($(this).is(":checked")) {
            $(".father_form").val("");
            if ($("#copy_father").is(":checked")) {
                $("#copy_others").prop('checked', true)
                value = "copy_others";
                copyparent(value)
            }
            $("#copy_father").prop('disabled', true);
            $("#father_details").hide("slow");
        } else {
            $("#copy_father").prop('disabled', false);
            $("#father_details").show("slow");
        }
    });
   /* $("#passport_expiry_date").datepicker({
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
        autoclose: true,
        yearRange: "-3:+6", // last hundred years
    });

    $("#visa_expiry_date").datepicker({
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
        autoclose: true,
        yearRange: "-3:+6", // last hundred years
    });
    */
    $('#passport_photo').change(function() {
        // var i = $(this).prev('label').clone();
        var file = $('#passport_photo')[0].files[0];
        if(file.size > 2097152) {
            $('#passport_photo_name').text("File greater than 2Mb");
            $("#passport_photo_name").addClass("error");
            $('#passport_photo').val('');
        } else {
            $("#passport_photo_name").removeClass("error");
            $('#passport_photo_name').text(file.name);
        }
    });
    
    $('#visa_photo').change(function() {
        // var i = $(this).prev('label').clone();
        var file = $('#visa_photo')[0].files[0];
        if(file.size > 2097152) {
            $('#visa_photo_name').text("File greater than 2Mb");
            $("#visa_photo_name").addClass("error");
            $('#visa_photo').val('');
        } else {
            $("#visa_photo_name").removeClass("error");
            $('#visa_photo_name').text(file.name);
        }
    });
    $(".number_validation").keypress(function(event){
        console.log(123)
        var regex = new RegExp("^[0-9-+]");
        var key = String.fromCharCode(event.charCode ? event.which : event.charCode);
        if (!regex.test(key)) {
            event.preventDefault();
            return false;
        }
    });
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
        formData.append('parent_id', ref_user_id);
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
    

    $(document).ready(function () {
        $("#japan_postalcode").change(function () {

            var postalCode = $('#japan_postalcode').val();

            var ccou = $('#country').val();
            console.log('sys',ccou)
            var country = 'my/'; // Country Code: my

            var apiUrl = 'https://api.zippopotam.us/' + country + postalCode;

            $.ajax({
                url: apiUrl,
                type: "GET",
                processData: false,
                dataType: 'json',
                contentType: false,
                success: function (response) {
                    if (response.places && response.places.length > 0) {
                        var place = response.places[0];
                        var city = place['place name'];
                        var state = place['state'];
                        $('#japan_address').val(state+' '+city);
                    } else {
                        alert('Postal code not found or invalid.');
                    }
                },
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });


        });
    });
    $("#profileEdit").validate({
        rules: {
            first_name: "required",
            occupation: "required",

            japan_postalcode: "required",
            japan_contact_no: "required",
            japan_emergency_sms: "required",
            japan_address: "required",
            stay_category: "required",

            mother_last_name: "required",
            mother_first_name_furigana: "required",
            mother_first_name_english: "required",
            mother_last_name_furigana: "required",
            mother_last_name_english: "required",
            mother_nationality: "required",
            mother_occupation: "required",

            father_last_name: "required",
            father_last_name_furigana: "required",
            father_last_name_english: "required",
            father_first_name_furigana: "required",
            father_first_name_english: "required",
            father_nationality: "required",
            father_occupation: "required",

            guardian_last_name: "required",
            guardian_last_name_furigana: "required",
            guardian_last_name_english: "required",
            guardian_first_name_furigana: "required",
            guardian_first_name_english: "required",
            father_nationality: "required",
            father_occupation: "required",

            guardian_company_name_japan: "required",
            guardian_company_name_local: "required",
            // guardian_company_phone_number: "required",

            guardian_company_phone_number: {
                required: true,
                minlength: 8
            },
            guardian_employment_status: "required",

            father_first_name: "required",
            father_phone_number: {
                required: true,
                minlength: 8
            },
            father_occupation: "required",
            father_email: {
                required: true,
                email: true
            },
            mother_first_name: "required",

            mother_phone_number: {
                required: true,
                minlength: 8
            },
            mother_occupation: "required",
            mother_email: {
                required: true,
                email: true
            },
            guardian_first_name: "required",
            guardian_relation: "required",
            guardian_phone_number: {
                required: true,
                minlength: 8
            },
            guardian_occupation: "required",
            guardian_email: {
                required: true,
                email: true
            },
            
            "passport_photo": {
                required: function (element) {
                    if ($("#passport_old_photo").val().length < 1) {
                        return true;
                    } else {
                        return false;
                    }
                }
            },
            "japanese_association_membership_image_supplimental": {
                required: function (element) {
                    if ($("#japanese_association_membership_image_supplimental_old").val().length < 1) {
                        return true;
                    } else {
                        return false;
                    }
                }
            },
            "passport_father_photo": {
                required: function (element) {
                    if ($("#passport_father_old_photo").val().length < 1) {
                        return true;
                    } else {
                        return false;
                    }
                }
            },
            "passport_mother_photo": {
                required: function (element) {
                    if ($("#passport_mother_old_photo").val().length < 1) {
                        return true;
                    } else {
                        return false;
                    }
                }
            },
        }
    });

    $('#profileEdit').on('submit', function (e) {
        e.preventDefault();
        console.log('123')
        var parentcheck = $("#profileEdit").valid();
        if (parentcheck === true) {
            var form = this;
            $.ajax({
                url: $(form).attr('action'),
                method: $(form).attr('method'),
                data: new FormData(form),
                processData: false,
                dataType: 'json',
                contentType: false,
                success: function (data) {
                    if (data.code == 200) {
                        toastr.success(data.message);
                        window.location.href = indexParent;
                    } else {
                        toastr.error(data.message);
                    }
                }
            });
        }
    });
});
