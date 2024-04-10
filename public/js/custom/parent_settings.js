$(function () {

    // copyparent();
    $('.copy_guardian_info').on('change', function () {
        var dataParentId = $('#guardian_relation').find(':selected').data('parent-id');
        var field_name = $(this).attr('name');
        var value = $("#" + field_name).val();
        if (dataParentId === 1) {
            
            $("#father_details").show("slow"); 
            $('#skip_father_details').prop('checked', false);
            var guard_name = field_name.replace("guardian", 'father');
        }
         if (dataParentId === 2) {
            
            $("#mother_details").show("slow"); 
            $('#skip_mother_details').prop('checked', false);
            var guard_name = field_name.replace("guardian", 'mother');
        }
        $("#" + guard_name).val(value);
    });
    
    $("#guardian_relation").change(function () {
        copyparent();
    });
   
    function copyparent(dataParentId){
        
        var dataParentId = $('#guardian_relation').find(':selected').data('parent-id');
        
       // Check if data-parent-id is 1 for father or 2 for mother
       
       var guardianLastName = $('#guardian_last_name').val();
       var guardianMiddleName = $('#guardian_middle_name').val();
       var guardianFirstName = $('#guardian_first_name').val();
       var guardianLastNameFurigana = $('#guardian_last_name_furigana').val();
       var guardianMiddleNameFurigana = $('#guardian_middle_name_furigana').val();
       var guardianFirstNameFurigana = $('#guardian_first_name_furigana').val();
       var guardianLastNameEnglish = $('#guardian_last_name_english').val();
       var guardianMiddleNameEnglish = $('#guardian_middle_name_english').val();
       var guardianFirstNameEnglish = $('#guardian_first_name_english').val();
       var guardianEmail = $('#guardian_email').val();
       var guardianMobileNo = $('#guardian_mobile_no').val();
       var guardianOccupation = $('#guardian_occupation').val();
       var guardianId = $('#guardian_id').val();
       if (dataParentId === 1 || dataParentId === 2) {
        
            if (dataParentId === 1) {
                
                $("#father_details").show("slow"); 
                $('#skip_father_details').prop('checked', false);
                $('#father_id').val(guardianId);
                $('#father_last_name').val(guardianLastName);
                $('#father_middle_name').val(guardianMiddleName);
                $('#father_first_name').val(guardianFirstName);
                $('#father_last_name_furigana').val(guardianLastNameFurigana);
                $('#father_middle_name_furigana').val(guardianMiddleNameFurigana);
                $('#father_first_name_furigana').val(guardianFirstNameFurigana);
                $('#father_last_name_english').val(guardianLastNameEnglish);
                $('#father_middle_name_english').val(guardianMiddleNameEnglish);
                $('#father_first_name_english').val(guardianFirstNameEnglish);
                $('#father_email').val(guardianEmail);
                $('#father_mobile_no').val(guardianMobileNo);
                $('#father_occupation').val(guardianOccupation);
                $('#mother_details input').val('');
                $('#mother_details select').val('');
                $('#father_details input, #father_details select').prop('readonly', true);
                $('#mother_details input, #mother_details select').prop('readonly', false);
            } else if (dataParentId === 2) {
                
                $("#mother_details").show("slow"); 
                $('#skip_mother_details').prop('checked', false);
                $('#mother_id').val(guardianId);
                $('#mother_last_name').val(guardianLastName);
                $('#mother_middle_name').val(guardianMiddleName);
                $('#mother_first_name').val(guardianFirstName);
                $('#mother_last_name_furigana').val(guardianLastNameFurigana);
                $('#mother_middle_name_furigana').val(guardianMiddleNameFurigana);
                $('#mother_first_name_furigana').val(guardianFirstNameFurigana);
                $('#mother_last_name_english').val(guardianLastNameEnglish);
                $('#mother_middle_name_english').val(guardianMiddleNameEnglish);
                $('#mother_first_name_english').val(guardianFirstNameEnglish);
                $('#mother_email').val(guardianEmail);
                $('#mother_mobile_no').val(guardianMobileNo);
                $('#mother_occupation').val(guardianOccupation);
                $('#father_details input').val('');
                $('#father_details select').val('');
                $('#mother_details input, #mother_details select').prop('readonly', true);
                $('#father_details input, #father_details select').prop('readonly', false);
            }
        } else {
            var fatherEmail = $('#father_email').val();
            var motherEmail = $('#mother_email').val();
            // Enable all fields if data-parent-id is neither 1 nor 2
            if(guardianEmail == fatherEmail){
                $('#father_details input').val('');
                $('#father_details select').val('');
                $('#father_details input, #father_details select').prop('readonly', false);
            }else if(guardianEmail == motherEmail){
                $('#mother_details input').val('');
                $('#mother_details select').val('');
                $('#mother_details input, #mother_details select').prop('readonly', false);
            }
            
        }
    }
    // skip_mother_details
    $("#skip_mother_details").on("change", function () {
        
        if ($(this).is(":checked")) {
            
            $(".mother_details").val("");
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
            $(".father_details").val("");
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
    $("#passport_expiry_date").datepicker({
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
    
    
    $('#passport_father_photo').change(function () {
        // var i = $(this).prev('label').clone();
        var file = $('#passport_father_photo')[0].files[0];
        if (file.size > 2097152) {
            $('#passport_father_photo_name').text("File greater than 2Mb");
            $("#passport_father_photo_name").addClass("error");
            $('#passport_father_photo').val('');
        } else {
            $("#passport_father_photo_name").removeClass("error");
            $('#passport_father_photo_name').text(file.name);
        }
    });

    $('#passport_mother_photo').change(function () {
        // var i = $(this).prev('label').clone();
        var file = $('#passport_mother_photo')[0].files[0];
        if (file.size > 2097152) {
            $('#passport_mother_photo_name').text("File greater than 2Mb");
            $("#passport_mother_photo_name").addClass("error");
            $('#passport_mother_photo').val('');
        } else {
            $("#passport_mother_photo_name").removeClass("error");
            $('#passport_mother_photo_name').text(file.name);
        }
    });

    $('#visa_father_photo').change(function () {
        // var i = $(this).prev('label').clone();
        var file = $('#visa_father_photo')[0].files[0];
        if (file.size > 2097152) {
            $('#visa_father_photo_name').text("File greater than 2Mb");
            $("#visa_father_photo_name").addClass("error");
            $('#visa_father_photo').val('');
        } else {
            $("#visa_father_photo_name").removeClass("error");
            $('#visa_father_photo_name').text(file.name);
        }
    });

    $('#visa_mother_photo').change(function () {
        // var i = $(this).prev('label').clone();
        var file = $('#visa_mother_photo')[0].files[0];
        if (file.size > 2097152) {
            $('#visa_mother_photo_name').text("File greater than 2Mb");
            $("#visa_mother_photo_name").addClass("error");
            $('#visa_mother_photo').val('');
        } else {
            $("#visa_mother_photo_name").removeClass("error");
            $('#visa_mother_photo_name').text(file.name);
        }
    });
    

    $('#japanese_association_membership_image_supplimental').change(function () {
        // var i = $(this).prev('label').clone();
        var file = $('#japanese_association_membership_image_supplimental')[0].files[0];
        if (file.size > 2097152) {
            $('#japanese_association_membership_image_supplimental_name').text("File greater than 2Mb");
            $("#japanese_association_membership_image_supplimental_name").addClass("error");
            $('#japanese_association_membership_image_supplimental').val('');
        } else {
            $("#japanese_association_membership_image_supplimental_name").removeClass("error");
            $('#japanese_association_membership_image_supplimental_name').text(file.name);
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
    $(".dobDatepicker").datepicker({
        dateFormat: 'dd-mm-yy',
        changeMonth: true,
        changeYear: true,
        autoclose: true,
        yearRange: "-100:+50", // last hundred years
    });
    // designation add start
    var sibling_increment = 1;
    $(document).on('click', '#add_sibling', function() {
        console.log(sibling_increment);
        sibling_increment++;
        var siblingAppend = '<tr id="row_sibling' + sibling_increment + '">' +
            '<td>'+
            '<input type="text" class="form-control" id="full_name" name="full_name[]" placeholder="" aria-describedby="inputGroupPrepend">' +
            '</td>' +
            '<td>' +
            '<div class="input-group input-group-merge">' +
            '<div class="input-group-prepend">' +
            '<div class="input-group-text">' +
            '<span class="fas fa-calendar"></span>' +
            '</div>' +
            '</div>' +
            '<input type="text" class="form-control dobDatepicker" name="siblingdob[]" placeholder="' + yyyy_mm_dd + '">' +
            '</div>' +
            '</td>' +
            '<td>' +
           '<input type="text" class="form-control" id="relationship" name="relationship[]" placeholder="" aria-describedby="inputGroupPrepend">'+
            '</td>' +
            '<td>' +
            '<button type="button" name="remove_designation" id="' + sibling_increment + '" class="btn btn-danger btn_remove_designation">X</button>' +
            '</td>' +
            '</tr>';

        var appendDesHtml = $('#dynamic_field_one').append(siblingAppend);
        // Initialize datepicker for the new field
        appendDesHtml.find('.dobDatepicker').datepicker({
            dateFormat: 'dd-mm-yy',
            changeMonth: true,
            changeYear: true,
            autoclose: true,
            yearRange: "-100:+50", // last hundred years
        });

    });
    $(document).on('click', '.btn_remove_designation', function () {
        var button_id = $(this).attr("id");
        $('#row_sibling' + button_id + '').remove();
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
