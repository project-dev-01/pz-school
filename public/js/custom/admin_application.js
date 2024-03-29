$(function () {
    

    $("#enrolled_department").on('change', function (e) {
        e.preventDefault();
        var department_id = $(this).val();
        
        $("#enrolled_grade").empty();
        $("#enrolled_grade").append('<option value="">' + select_grade + '</option>');
        $.post(getGradeByDepartmentUrl,
            {
                branch_id: branchID,
                department_id: department_id
            }, function (res) {
                if (res.code == 200) {
                    $.each(res.data, function (key, val) {
                        $("#enrolled_grade").append('<option value="' + val.id + '">' + val.name + '</option>');
                    });
                }
            }, 'json');
    });
    $("#enrolled_grade").on('change', function (e) {
        e.preventDefault();
        var class_id = $(this).val();
        
        $("#enrolled_class").empty();
        $("#enrolled_class").append('<option value="">' + select_grade + '</option>');
        $.post(getClassByGrade,
            {
                token: token,
                branch_id: branchID,
                class_id: class_id
            }, function (res) {
                if (res.code == 200) {
                    $.each(res.data, function (key, val) {
                        $("#enrolled_class").append('<option value="' + val.section_id + '">' + val.section_name + '</option>');
                    });
                }
            }, 'json');
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
    $('#phase_1_status').on('change', function () {
        var status = $(this).val();
        if(status=="Reject" || status=="Send Back"){

            $("#reason_1").show();
        }else{
            $("#reason_1").hide();
        }
    });
    $('#phase_2_status').on('change', function () {
        var status = $(this).val();
        console.log('sty',status)
        if(status=="Reject" || status=="Send Back"){

            $("#reason_2").show();
        }else{
            $("#reason_2").hide();
        }
    });

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

    $('#nric_photo').change(function () {
        // var i = $(this).prev('label').clone();
        var file = $('#nric_photo')[0].files[0];
        if (file.size > 2097152) {
            $('#nric_photo_name').text("File greater than 2Mb");
            $("#nric_photo_name").addClass("error");
            $('#nric_photo').val('');
        } else {
            $("#nric_photo_name").removeClass("error");
            $('#nric_photo_name').text(file.name);
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

    $('#japanese_association_membership_image_principal').change(function () {
        // var i = $(this).prev('label').clone();
        var file = $('#japanese_association_membership_image_principal')[0].files[0];
        if (file.size > 2097152) {
            $('#japanese_association_membership_image_principal_name').text("File greater than 2Mb");
            $("#japanese_association_membership_image_principal_name").addClass("error");
            $('#japanese_association_membership_image_principal').val('');
        } else {
            $("#japanese_association_membership_image_principal_name").removeClass("error");
            $('#japanese_association_membership_image_principal_name').text(file.name);
        }
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

    //$.noConflict();
    $(document).ready(function () {
        $("#postal_code").change(function () {

            var postalCode = $('#postal_code').val();
            var country = $('#country').val();
            var formData = new FormData();
            formData.append('postalCode', postalCode);
            formData.append('country', country);
            console.log(formData);
            $.ajax({
                url: malaysiaPostalCode,
                type: "POST",
                data: formData,
                processData: false,
                dataType: 'json',
                contentType: false,
                success: function (response) {
                    if (response.places && response.places.length > 0) {
                        var place = response.places[0];
                        var city = place['place name'];
                        var state = place['state'];
                        $('#city').val(city);
                        $('#state').val(state);
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
    // $("#date_of_birth").datepicker({
    //     dateFormat: 'yy-mm-dd',
    //     changeMonth: true,
    //     changeYear: true,
    //     autoclose: true,
    //     yearRange: "-60:+1", // last hundred years
    //     maxDate: 0
    // });
    // $("#expected_enroll_date").datepicker({
    //     dateFormat: 'yy-mm-dd',
    //     changeMonth: true,
    //     changeYear: true,
    //     autoclose: true,
    //     yearRange: "-1:+1", // last hundred years
    //     minDate: 0
    // });
    // $("#trail_date").datepicker({
    //     dateFormat: 'yy-mm-dd',
    //     changeMonth: true,
    //     changeYear: true,
    //     autoclose: true,
    //     yearRange: "-3:+6", // last hundred years
    // });

    // $("#passport_expiry_date").datepicker({
    //     dateFormat: 'yy-mm-dd',
    //     changeMonth: true,
    //     changeYear: true,
    //     autoclose: true,
    //     yearRange: "-10:+10", // last hundred years
    // });

    // $("#visa_expiry_date").datepicker({
    //     dateFormat: 'yy-mm-dd',
    //     changeMonth: true,
    //     changeYear: true,
    //     autoclose: true,
    //     yearRange: "-10:+10", // last hundred years
    // });
    // $("#last_date_of_withdrawal").datepicker({
    //     dateFormat: 'yy-mm-dd',
    //     changeMonth: true,
    //     changeYear: true,
    //     autoclose: true,
    //     yearRange: "-20:+50", // last hundred years
    //     maxDate: 0
    // });
    $("#next").click(function () {
        console.log('etts')
        $("#basic_tab").removeClass("active");
        $("#personal_tab").addClass("active");
    });
    
    $("#passport, #japanese_association_membership_number_student").on("input", function() {
        var regexp = /^[A-Za-z0-9]+$/;
        if (!regexp.test($(this).val())) {
            $(this).val($(this).val().replace(/[^\w]/gi, ''));
        }
    });
    $("#editApplication").validate({
        rules: {
            first_name: "required",
            last_name: "required",
            first_name_furigana: "required",
            last_name_furigana: "required",
            first_name_english: "required",
            last_name_english: "required",
            // mobile_no: "required",
            date_of_birth: "required",
            gender: "required",
            religion: "required",
            nationality: "required",
            school_enrollment_status: "required",
            school_enrollment_status_tendency: "required",
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

            expected_academic_year: "required",
            expected_grade: "required",
            expected_enroll_date: "required",
            remarks: "required",

            // email: {
            //     required: true,
            //     email: true
            // },
            // address_1: "required",
            country: "required",
            city: "required",
            state: "required",
            postal_code: "required",
            academic_grade: "required",
            academic_year: "required",
            grade: "required",
            school_year: "required",
            school_last_attended: "required",
            school_address_1: "required",
            school_country: "required",
            school_city: "required",
            school_state: "required",
            school_postal_code: "required",
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
            last_date_of_withdrawal: "required",
            status: "required",
            phase_2_status: "required",


            postal_code: "required",
            address_unit_no: "required",
            address_condominium: "required",
            address_street: "required",
            address_district: "required",
            passport: "required",
            passport_expiry_date: "required",
            // passport_photo:"required",
            // visa_photo:"required",
            visa_expiry_date: "required",
            visa_type: "required",
            visa_type_others: "required",
            japanese_association_membership_number_student: "required",
            // japanese_association_membership_image_principal:"required",
            // japanese_association_membership_image_supplimental:"required",
            phase2_remarks: "required",
            passport_father_photo: "required",
            passport_mother_photo: "required",

            status_after_approval: "required",
            enrolled_academic_year: "required",
            enrolled_department: "required",
            enrolled_grade: "required",
            enrolled_class: "required",
            phase_2_reason:"required",
            phase_1_reason:"required",
            enrollment:"required",
            stay_category:"required",

            "passport_photo": {
                required: function (element) {
                    if ($("#passport_old_photo").val().length < 1) {
                        return true;
                    } else {
                        return false;
                    }
                }
            },
            "japanese_association_membership_image_principal": {
                required: function (element) {
                    if ($("#japanese_association_membership_image_principal_old").val().length < 1) {
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

    $('#editApplication').on('submit', function (e) {
        e.preventDefault();
        console.log('123')
        var admissionCheck = $("#editApplication").valid();
        if (admissionCheck === true) {
            var form = this;
            $("#overlay").fadeIn(300);
            $.ajax({
                url: $(form).attr('action'),
                method: $(form).attr('method'),
                data: new FormData(form),
                processData: false,
                dataType: 'json',
                contentType: false,
                success: function (data) {
                    $("#overlay").fadeOut(300);
                    if (data.code == 200) {
                        toastr.success(data.message);
                        window.location.href = applicationIndex;
                    } else {
                        toastr.error(data.message);
                    }
                }
            });
        }
    });

    // change 
    $('#phase_2_status').on('change', function () {
        var status = $(this).val();
        $("#status_after_approval").val("");
        $(".academic_details_form").val("");
        $("#academic_details_show").hide();
        if(status=="Approved"){

            $("#enrollment_show").show();
            $("#status_after_approval_show").show();
        }else{
            $("#enrollment_show").hide();
            $("#status_after_approval_show").hide();
        }
    });
    $('#enrollment').on('change', function () {
        var status = $(this).val();
        if(status=="Trail Enrollment"){

            $("#trail_date_show").show();
            $("#official_date_show").hide();
        }else if(status=="Official Enrollment"){
            $("#official_date_show").show();
            $("#trail_date_show").hide();
        }
    });

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
    // skip_guardian_details
    $("#skip_guardian_details").on("change", function () {
        if ($(this).is(":checked")) {
            $("#guardian_details").hide("slow");
        } else {
            $("#guardian_details").show("slow");
        }
    });
    
    $('#visa_type').on('change', function () {
        $("#visa_type_others_show").hide('');
        var check = $(this).val();
        
        $("#visa_type_others").val("");
        if (check == "Others") {
            $("#visa_type_others_show").show('');
        }
    });
    $('.copy_parent_info').on('change', function () {
        var check = $('.copy_parent:checked').val();
        if (check != "others") {
            var field_name = $(this).attr('name');
            var value = $("#" + field_name).val();
            var guard_name = field_name.replace(check, 'guardian');
            $("#" + guard_name).val(value);
        }
    });
    $('.copy_parent').on('change', function () {
        var value = $(this).val();

        // if(value != "others"){
        copyparent(value)
        // }

    });
    function copyparent(value) {

        var last_name = $("#" + value + "_last_name").val();
        $("#guardian_last_name").val(last_name);
        var middle_name = $("#" + value + "_middle_name").val();
        $("#guardian_middle_name").val(middle_name);
        var first_name = $("#" + value + "_first_name").val();
        $("#guardian_first_name").val(first_name);

        var last_name_furigana = $("#" + value + "_last_name_furigana").val();
        $("#guardian_last_name_furigana").val(last_name_furigana);
        var middle_name_furigana = $("#" + value + "_middle_name_furigana").val();
        $("#guardian_middle_name_furigana").val(middle_name_furigana);
        var first_name_furigana = $("#" + value + "_first_name_furigana").val();
        $("#guardian_first_name_furigana").val(first_name_furigana);

        var last_name_english = $("#" + value + "_last_name_english").val();
        $("#guardian_last_name_english").val(last_name_english);
        var middle_name_english = $("#" + value + "_middle_name_english").val();
        $("#guardian_middle_name_english").val(middle_name_english);
        var first_name_english = $("#" + value + "_first_name_english").val();
        $("#guardian_first_name_english").val(first_name_english);

        var email = $("#" + value + "_email").val();
        $("#guardian_email").val(email);
        var phone_number = $("#" + value + "_phone_number").val();
        $("#guardian_phone_number").val(phone_number);
        var occupation = $("#" + value + "_occupation").val();
        $("#guardian_occupation").val(occupation);
    }
    // change 
    $('.re_admission').on('change', function () {
        var value = $(this).val();
        if (value == "yes") {

            $("#last_date").show();
        } else {
            $("#last_date").hide();
        }
    });
    
    
    $('#status_after_approval').on('change', function () {
        var status = $(this).val();
        $(".academic_details_form").val("");
        $("#academic_details_show").hide();
        if(status=="Grade and class fixed"){
            $("#academic_details_show").show();
        }
    });
    $("#department_id").on('change', function (e) {
        e.preventDefault();
        var Selector = '#applicationFilter';
        var department_id = $(this).val();
        var classID = "";
        classAllocation(department_id, Selector, classID);
    });
    function classAllocation(department_id, Selector, classID) {
        $(Selector).find('select[name="academic_grade"]').empty();
        $(Selector).find('select[name="academic_grade"]').append('<option value="">' + select_grade + '</option>');
        if (department_id) {
            $.post(getGradeByDepartmentUrl,
                {
                    branch_id: branchID,
                    department_id: department_id
                }, function (res) {
                    if (res.code == 200) {
                        $.each(res.data, function (key, val) {
                            $(Selector).find('select[name="academic_grade"]').append('<option value="' + val.id + '">' + val.name + '</option>');
                        });
                        if (classID != '') {
                            $(Selector).find('select[name="academic_grade"]').val(classID);
                        }
                    }
                }, 'json');
        }
    }

   

    

    

    // Publish Event 
    $(document).on('click', '#approveApplicationBtn', function () {
        var id = $(this).data('id');
        if ($(this).prop('checked') == true) {
            var value = 1;
            var text = approveApplication;
            var confirmText = approveconfirmButtonText;
        } else {
            var value = 0;
            var text = unapproveApplication;
            var confirmText = unapproveconfirmButtonText;
        }
        swal.fire({
            title: deleteTitle + '?',
            html: text,
            showCancelButton: true,
            showCloseButton: true,
            cancelButtonText: deletecancelButtonText,
            confirmButtonText: confirmText,
            cancelButtonColor: '#d33',
            confirmButtonColor: '#556ee6',
            width: 400,
            allowOutsideClick: false
        }).then(function (result) {
            if (result.value) {
                $.post(applicationApprove, { id: id, status: value }, function (data) {
                    if (data.code == 200) {
                        $('#application-table').DataTable().ajax.reload(null, false);
                        toastr.success(data.message);
                    } else {
                        toastr.error(data.message);
                    }
                }, 'json');
            }
        });
    });

    $(document).ready(function(){

        $(".tabs").click(function(){
            
            $(".tabs").removeClass("active");
            $(".tabs h6").removeClass("font-weight-bold");    
            $(".tabs h6").addClass("text-muted");    
            $(this).children("h6").removeClass("text-muted");
            $(this).children("h6").addClass("font-weight-bold");
            $(this).addClass("active");
        
            current_fs = $(".active");
        
            next_fs = $(this).attr('id');
            next_fs = "#" + next_fs + "_tab";
        
            $("fieldset").removeClass("show");
            $(next_fs).addClass("show");
        
            current_fs.animate({}, {
                step: function() {
                    current_fs.css({
                        'display': 'none',
                        'position': 'relative'
                    });
                    next_fs.css({
                        'display': 'block'
                    });
                }
            });
        });
        
        });
        

    // function setLocalStorageForApplicationList(classObj) {

    //     var applicationListDetails = new Object();
    //     applicationListDetails.academic_year = classObj.academic_year;
    //     applicationListDetails.academic_grade = classObj.academic_grade;
    //     // here to attached to avoid localStorage other users to add
    //     applicationListDetails.branch_id = branchID;
    //     applicationListDetails.role_id = get_roll_id;
    //     applicationListDetails.user_id = ref_user_id;
    //     var applicationListArr = [];
    //     applicationListArr.push(applicationListDetails);
    //     if (get_roll_id == "2") {
    //         // admin
    //         localStorage.removeItem("admin_application_list_details");
    //         localStorage.setItem('admin_application_list_details', JSON.stringify(applicationListArr));
    //     }
    //     return true;
    // }
    // // if localStorage
    // if (typeof admin_application_list_storage !== 'undefined') {
    //     if ((admin_application_list_storage)) {
    //         if (admin_application_list_storage) {
    //             var adminApplicationListStorage = JSON.parse(admin_application_list_storage);
    //             if (adminApplicationListStorage.length == 1) {
    //                 var academicYear, academicGrade, userBranchID, userRoleID, userID;
    //                 adminApplicationListStorage.forEach(function (user) {
    //                     academicYear = user.academic_year;
    //                     academicGrade = user.academic_grade;
    //                     userBranchID = user.branch_id;
    //                     userRoleID = user.role_id;
    //                     userID = user.user_id;
    //                 });
    //                 if ((userBranchID == branchID) && (userRoleID == get_roll_id) && (userID == ref_user_id)) {
                        
    //                     $("#academic_year").val(academicYear);
    //                     $('#academic_grade').val(academicGrade);
    //                     var formData = {
    //                         academic_year: academicYear,
    //                         academic_grade: academicGrade,
    //                     };
    //                     application(formData);
    //                 }
    //             }
    //         }
    //     }
    // }
});