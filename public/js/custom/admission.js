$(function () {
    // nric validation start
    // var $form_1 = $('#addadmission');
    // $form_1.validate({
    //     debug: true
    // });

    // $('#txt_nric').rules("add", {
    //     required: true
    // });
    $("#department_id").on('change', function (e) {
        e.preventDefault();
        var Selector = '#addadmission';
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
                    department_id: department_id
                }, function (res) {
                    if (res.code == 200) {
                        $.each(res.data, function (key, val) {
                            $(Selector).find('select[name="class_id"]').append('<option value="' + val.id + '">' + val.name + '</option>');
                        });
                        if (classID != '') {
                            $(Selector).find('select[name="class_id"]').val(classID);
                        }
                    }
                }, 'json');
        }
    }
    $('#txt_nric').mask("000000-00-0000", { reverse: true });
    // nric validation end
    $(".number_validation").keypress(function (event) {
        console.log(123)
        var regex = new RegExp("^[0-9-+]");
        var key = String.fromCharCode(event.charCode ? event.which : event.charCode);
        if (!regex.test(key)) {
            event.preventDefault();
            return false;
        }
    });

    $("#admission_date").datepicker({
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
        autoclose: true,
        yearRange: "-3:+6", // last hundred years
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
    $('#nric_photo').change(function() {
        // var i = $(this).prev('label').clone();
        var file = $('#nric_photo')[0].files[0];
        if(file.size > 2097152) {
            $('#nric_photo_name').text("File greater than 2Mb");
            $("#nric_photo_name").addClass("error");
            $('#nric_photo').val('');
        } else {
            $("#nric_photo_name").removeClass("error");
            $('#nric_photo_name').text(file.name);
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
    $('#japanese_association_membership_image_principal').change(function() {
        // var i = $(this).prev('label').clone();
        var file = $('#japanese_association_membership_image_principal')[0].files[0];
        if(file.size > 2097152) {
            $('#japanese_association_membership_image_principal_name').text("File greater than 2Mb");
            $("#japanese_association_membership_image_principal_name").addClass("error");
            $('#japanese_association_membership_image_principal').val('');
        } else {
            $("#japanese_association_membership_image_principal_name").removeClass("error");
            $('#japanese_association_membership_image_principal_name').text(file.name);
        }
    });
    $("#dob").datepicker({
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
        autoclose: true,
        yearRange: "-60:+1", // last hundred years
        maxDate: 0
    });
    $("#visa_type_others_show").hide();

    // Listen for changes in the visa_type dropdown
    $("#visa_type").change(function() {
        // If the selected value is "Others", show the additional input field, otherwise hide it
        if ($(this).val() === "Others") {
            $("#visa_type_others_show").show();
        } else {
            $("#visa_type_others_show").hide();
        }
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
                
                $("#father_form").show("slow"); 
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
                $('#mother_form input').val('');
                $('#mother_form select').val('');
                $('#father_form input, #father_form select').prop('readonly', true);
                $('#mother_form input, #mother_form select').prop('readonly', false);
            } else if (dataParentId === 2) {
                
                $("#mother_form").show("slow"); 
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
                $('#father_form input').val('');
                $('#father_form select').val('');
                $('#mother_form input, #mother_form select').prop('readonly', true);
                $('#father_form input, #father_form select').prop('readonly', false);
            }
        } else {
            var fatherEmail = $('#father_email').val();
            var motherEmail = $('#mother_email').val();
            // Enable all fields if data-parent-id is neither 1 nor 2
            if(guardianEmail == fatherEmail){
                $('#father_form input').val('');
                $('#father_form select').val('');
                $('#father_form input, #father_form select').prop('readonly', false);
            }else if(guardianEmail == motherEmail){
                $('#mother_form input').val('');
                $('#mother_form select').val('');
                $('#mother_form input, #mother_form select').prop('readonly', false);
            }
            
        }
    }
    
    // skip_mother_details
    $("#skip_mother_details").on("change", function () {
        
        if ($(this).is(":checked")) {
            
            $("#mother_form input").val("");
            $("#mother_form select").val("");
            $("#mother_form").hide("slow");
        } else {
            $("#mother_form").show("slow");
        }
    });
    // skip_father_details
    $("#skip_father_details").on("change", function () {
        
        if ($(this).is(":checked")) {
            
            $("#father_form input").val("");
            $("#father_form select").val("");
            $("#father_form").hide("slow");
        } else {
            $("#father_form").show("slow");
        }
    });
    $("#passport, #japanese_association_membership_number_student").on("input", function() {
        var regexp = /^[A-Za-z0-9]+$/;
        if (!regexp.test($(this).val())) {
            $(this).val($(this).val().replace(/[^\w]/gi, ''));
        }
    });
    $(document).ready(function () {
        $("#drp_post_code").change(function () {

            var postalCode = $('#drp_post_code').val();
            var country = $('#drp_country').val();
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
                    console.log(response);
                    if (response.places && response.places.length > 0) {
                        var place = response.places[0];
                        var city = place['place name'];
                        var state = place['state'];
                        $('#drp_city').val(city);
                        $('#drp_state').val(state);
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
    $('#has_dual_nationality_checkbox').change(function() {
        if(this.checked) {
            $('#dual_nationality_container').show();
        } else {
            $('#dual_nationality_container').hide();
        }
    });
    // rules validation
    $("#addadmission").validate({
        rules: {
           // parent_id: "required",
            year: "required",
            // txt_regiter_no: "required",
            txt_emailid: {
                required: true,
                email: true
            },
           // txt_roll_no: "required",
            admission_date: "required",
            classnames: "required",
            department_id: "required",
            class_id: "required",
            section_id: "required",
            school_enrollment_status_tendency:"required",
            // categy: "required",
            fname: "required",
            first_name_english: "required",
            first_name_furigana: "required",
            txt_mobile_no: "required",
            lname: "required",
            last_name_english: "required",
            last_name_furigana: "required",
            dob: "required",
            gender: "required",
            address_unit_no: "required",
            address_condominium: "required",
            address_street: "required",
            address_district: "required",
            drp_city: "required",
            drp_state: "required",
            drp_country: "required",
            drp_post_code: "required",
            txt_religion: "required",
            nationality: "required",
            passport: "required",
            passport_expiry_date: "required",
            passport_photo: "required",
            visa_expiry_date: "required",
            visa_photo: "required",
            visa_type: "required",
            japanese_association_membership_number_student: "required",
            japanese_association_membership_image_principal:"required",
            txt_prev_schname: "required",
            school_country: "required",
            school_state: "required",
            school_city: "required",
            school_postal_code: "required",
            school_enrollment_status: "required",
            father_last_name:"required",
            father_first_name:"required",
            father_last_name_furigana:"required",
            father_first_name_furigana:"required",
            father_last_name_english:"required",
            father_first_name_english:"required",
            father_nationality:"required",
            father_email:"required",
            father_mobile_no:"required",
            father_occupation:"required",
            mother_last_name:"required",
            mother_first_name:"required",
            mother_last_name_furigana:"required",
            mother_first_name_furigana:"required",
            mother_last_name_english:"required",
            mother_first_name_english:"required",
            mother_nationality:"required",
            mother_email:"required",
            mother_mobile_no:"required",
            mother_occupation:"required",
           

           // present_address: "required",
            txt_pwd: {
                required: true,
                minlength: 6
            },
            txt_retype_pwd: {
                required: true,
                minlength: 6,
                equalTo: "#txt_pwd"
            },
        }
    });

    $('#addadmission').on('submit', function (e) {
        e.preventDefault();
        var admissionCheck = $("#addadmission").valid();
        
        if (admissionCheck === true) {
            var form = this;
            console.log(form);
            $.ajax({
                url: $(form).attr('action'),
                method: $(form).attr('method'),
                data: new FormData(form),
                processData: false,
                dataType: 'json',
                contentType: false,
                success: function (data) {
                    console.log(data);
                    if (data.code == 200) {
                        toastr.success(data.message);
                        window.location.href = indexAdmission;
                    } else {
                        toastr.error(data.message);
                    }
                }, error: function (err) {
                    if (err.responseJSON && err.responseJSON.data && err.responseJSON.data.error) {
                        toastr.error(err.responseJSON.data.error);
                    } else {
                        toastr.error('Something went wrong');
                    }
                }
                
            });
        }
    });

    // $("#class_id").on('change', function (e) {
    // $("#users").bind("keydown change", function()
    $('#guardian_name').bind("keydown change", function () {
        var name = $(this).val();
        if (name != '') {
            $.ajax({
                url: parentName,
                method: "GET",
                data: { token: token, branch_id: branchID, name: name },
                success: function (data) {
                    $('#guardian_list').fadeIn();
                    $('#guardian_list').html(data);
                }
            });
        }
    });

    $('#guardian_list').on('click', 'li', function () {

        $('#guardian_name').val($(this).text());
        $('#guardian_list').fadeOut();
        var value = $(this).text();
        if (value == "No results Found") {
            $('#guardian_name').val("");
            $("#guardian_form").hide("slow");
            $("#guardian_photo").hide();

        } else {
            var id = $(this).val();
            $('#guardian_id').val(id);
            $("#guardian_form").show("slow");
            $("#guardian_photo").show();
            $.post(parentDetails, { token: token, branch_id: branchID, id: id }, function (res) {
                if (res.code == 200) {
                    var data = res.data.parent;
                    if (data.photo) {
                        var src = parentImg + "/" + data.photo;
                    } else {
                        var src = defaultImg;
                    }
                    $("#guardian_photo").html('<img src="' + src + '" class="img-fluid d-block rounded" style="width:100px" />');
                    $("#guardian_first_name").val(data.first_name);
                    $("#guardian_last_name").val(data.last_name);
                    $("#guardian_middle_name").val(data.middle_name);
                    $("#guardian_email").val(data.email);
                    $("#guardian_first_name_english").val(data.first_name_english);
                    $("#guardian_last_name_english").val(data.last_name_english);
                    $("#guardian_middle_name_english").val(data.middle_name_english);
                    $("#guardian_first_name_furigana").val(data.first_name_furigana);
                    $("#guardian_last_name_furigana").val(data.last_name_furigana);
                    $("#guardian_middle_name_furigana").val(data.middle_name_furigana);
                    $("#guardian_occupation").val(data.occupation);
                    $("#guardian_mobile_no").val(data.mobile_no);
                    $("#guardian_company_name_japan").val(data.company_name_japan);
                    $("#guardian_company_name_local").val(data.company_name_local);
                    $("#guardian_company_phone_number").val(data.company_phone_number);
                    $("#guardian_employment_status").val(data.employment_status);
                }
            }, 'json');
            copyparent();
        }
    });

    $('#father_name').keyup(function () {
        var name = $(this).val();
        if (name != '') {
            $.ajax({
                url: parentName,
                method: "GET",
                data: { token: token, branch_id: branchID, name: name },
                success: function (data) {
                    $('#father_list').fadeIn();
                    $('#father_list').html(data);
                }
            });
        }
    });

    $('#father_list').on('click', 'li', function () {

        $('#father_name').val($(this).text());
        $('#father_list').fadeOut();
        var value = $(this).text();
        if (value == "No results Found") {
            $('#father_name').val("");
            $("#father_form").hide("slow");
            $("#father_photo").hide();

        } else {
            var id = $(this).val();
            $('#father_id').val(id);
            $("#father_form").show("slow");
            $("#father_photo").show();
            $.post(parentDetails, { token: token, branch_id: branchID, id: id }, function (res) {
                if (res.code == 200) {
                    var data = res.data.parent;
                    if (data.photo) {
                        var src = parentImg + "/" + data.photo;
                    } else {
                        var src = defaultImg;
                    }
                    $("#father_photo").html('<img src="' + src + '" class="img-fluid d-block rounded" style="width:100px" />');
                    $("#father_first_name").val(data.first_name);
                    $("#father_last_name").val(data.last_name);
                    $("#father_email").val(data.email);
                    $("#father_gender").val(data.gender);
                    $("#father_date_of_birth").val(data.date_of_birth);
                    $("#father_passport").val(data.passport);
                    $("#father_country").val(data.country);
                    $("#father_post_code").val(data.post_code);
                    $("#father_address_2").val(data.address_2);
                    $("#father_nric").val(data.nric);
                    $("#father_occupation").val(data.occupation);
                    $("#father_income").val(data.income);
                    $("#father_blooddgrp").val(data.blood_group);
                    $("#father_education").val(data.education);
                    $("#father_mobile_no").val(data.mobile_no);
                    $("#father_state").val(data.state);
                    $("#father_city").val(data.city);
                    $("#father_address").val(data.address);
                }
            }, 'json');
        }
    });


    $('#mother_name').keyup(function () {
        var name = $(this).val();
        if (name != '') {
            $.ajax({
                url: parentName,
                method: "GET",
                data: { token: token, branch_id: branchID, name: name },
                success: function (data) {
                    $('#mother_list').fadeIn();
                    $('#mother_list').html(data);
                }
            });
        }
    });

    $('#mother_list').on('click', 'li', function () {

        $('#mother_name').val($(this).text());
        $('#mother_list').fadeOut();
        var value = $(this).text();
        if (value == "No results Found") {
            $('#mother_name').val("");
            $("#mother_form").hide("slow");
            $("#mother_photo").hide();

        } else {
            var id = $(this).val();
            $('#mother_id').val(id);
            $("#mother_form").show("slow");
            $("#mother_photo").show();
            $.post(parentDetails, { token: token, branch_id: branchID, id: id }, function (res) {
                if (res.code == 200) {
                    var data = res.data.parent;
                    if (data.photo) {
                        var src = parentImg + "/" + data.photo;
                    } else {
                        var src = defaultImg;
                    }
                    $("#mother_photo").html('<img src="' + src + '" class="img-fluid d-block rounded" style="width:100px" />');
                    $("#mother_first_name").val(data.first_name);
                    $("#mother_last_name").val(data.last_name);
                    $("#mother_email").val(data.email);
                    $("#mother_gender").val(data.gender);
                    $("#mother_date_of_birth").val(data.date_of_birth);
                    $("#mother_passport").val(data.passport);
                    $("#mother_country").val(data.country);
                    $("#mother_post_code").val(data.post_code);
                    $("#mother_address_2").val(data.address_2);
                    $("#mother_nric").val(data.nric);
                    $("#mother_occupation").val(data.occupation);
                    $("#mother_income").val(data.income);
                    $("#mother_blooddgrp").val(data.blood_group);
                    $("#mother_education").val(data.education);
                    $("#mother_mobile_no").val(data.mobile_no);
                    $("#mother_state").val(data.state);
                    $("#mother_city").val(data.city);
                    $("#mother_address").val(data.address);
                }
            }, 'json');
        }
    });

    $("#class_id").on('change', function (e) {
        e.preventDefault();
        var class_id = $(this).val();
        getSectionByClass(class_id)
    });

    function getSectionByClass(class_id) {
        $("#section_id").empty();
        $("#section_id").append('<option value="">' + select_class + '</option>');
        $.post(sectionByClass, { class_id: class_id }, function (res) {
            if (res.code == 200) {
                $.each(res.data, function (key, val) {
                    $("#section_id").append('<option value="' + val.section_id + '">' + val.section_name + '</option>');
                });
            }
        }, 'json');
    }

    $("#drp_transport_route").on('change', function (e) {
        e.preventDefault();
        var route_id = $(this).val();
        $("#drp_transport_vechicleno").empty();
        $("#drp_transport_vechicleno").append('<option value="">' + select_vehicle_number + '</option>');
        $.post(vehicleByRoute, { route_id: route_id }, function (res) {
            if (res.code == 200) {
                $.each(res.data, function (key, val) {
                    $("#drp_transport_vechicleno").append('<option value="' + val.vehicle_id + '">' + val.vehicle_no + '</option>');
                });
            }
        }, 'json');
    });



    $("#drp_hostelnam").on('change', function (e) {
        e.preventDefault();
        var hostel_id = $(this).val();
        $("#drp_roomname").empty();
        $("#drp_roomname").append('<option value="">' + select_room_name + '</option>');
        $.post(roomByHostel, { hostel_id: hostel_id }, function (res) {
            if (res.code == 200) {
                $.each(res.data, function (key, val) {
                    $("#drp_roomname").append('<option value="' + val.room_id + '">' + val.room_name + '</option>');
                });
            }
        }, 'json');
    });

    var student_id = $("#student_id").val();
    if (student_id) {
        student(student_id);
    }

    function student(id) {

        $('#student_id').val(id);
        $.post(studentDetails, { token: token, branch_id: branchID, id: id }, function (res) {
            if (res.code == 200) {
                var data = res.data;
                var name = data.first_name + " " + data.last_name;
                $('#sudent_application_id').val(id);
                $('#fname').val(data.first_name);
                $("#lname").val(data.last_name);
                $("#txt_emailid").val(data.email);
                $("#gender").val(data.gender);
                $("#dob").val(data.date_of_birth);
                $("#drp_country").val(data.country);
                $("#drp_state").val(data.state);
                $("#drp_city").val(data.city);
                $("#drp_post_code").val(data.postal_code);
                $("#txtarea_paddress").val(data.address_1);
                $("#txtarea_permanent_address").val(data.address_2);
                $("#txt_prev_schname").val(data.school_last_attended);
                $("#txt_prev_qualify").val(data.grade);
                $("#education").val(data.education);
                $("#txt_regiter_no").val(data.register_number);
                $("#txt_mobile_no").val(data.mobile_no);
                $("#address").val(data.address);
                $("#btwyears").val(data.academic_year);
                $("#class_id").val(data.academic_grade);

                var class_id = data.academic_grade;
                getSectionByClass(class_id);

                if(data.father_first_name != null){

                    if(data.father_first_name.length > 0){
                        $("#father_form").show("slow");
                        $("#father_info").show();
                        $("#father_photo").show();
                        var father_name = data.father_first_name + " " + data.father_last_name;
                        $('#father_name').val(father_name);
                        $("#father_first_name").val(data.father_first_name);
                        $("#father_last_name").val(data.father_last_name);
                        $("#father_mobile_no").val(data.father_phone_number);
                        $("#father_occupation").val(data.father_occupation);
                        $("#father_email").val(data.father_email);
                    }
                }
                if(data.mother_first_name != null){
                if(data.mother_first_name.length > 0){
                    $("#mother_form").show("slow");
                    $("#mother_info").show();
                    $("#mother_photo").show();
                    var mother_name = data.mother_first_name + " " + data.mother_last_name;
                    $('#mother_name').val(mother_name);
                    $("#mother_first_name").val(data.mother_first_name);
                    $("#mother_last_name").val(data.mother_last_name);
                    $("#mother_mobile_no").val(data.mother_phone_number);
                    $("#mother_occupation").val(data.mother_occupation);
                    $("#mother_email").val(data.mother_email);
                }
            }

                if(data.guardian_first_name != null){
                if(data.guardian_first_name.length > 0){
                    $("#guardian_form").show("slow");
                    $("#guardian_info").show();
                    $("#guardian_photo").show();
                    var guardian_name = data.guardian_first_name + " " + data.guardian_last_name;
                    $('#guardian_name').val(guardian_name);
                    $('#guardian_relation').val(data.guardian_relation);
                    $("#guardian_first_name").val(data.guardian_first_name);
                    $("#guardian_last_name").val(data.guardian_last_name);
                    $("#guardian_mobile_no").val(data.guardian_phone_number);
                    $("#guardian_occupation").val(data.guardian_occupation);
                    $("#guardian_email").val(data.guardian_email);
                }
            }
            }
        }, 'json');
    }

    $("#application_id").on('change', function (e) {
        e.preventDefault();

        $('#addadmission')[0].reset();
        $("#father_form").hide("slow");
        $("#mother_form").hide("slow");
        $("#guardian_form").hide("slow");

        var id = $(this).val();
        if (id) {
            var id = $(this).val();
            student(id);
        }
    });
});