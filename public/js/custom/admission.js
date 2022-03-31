$(function () {
    // rules validation
    $("#addadmission").validate({
        rules: {
            btwyears: "required",
            txt_regiter_no: "required",
            txt_emailid: {
                required: true,
                email: true
            },
            txt_roll_no: "required",
            admission_date: "required",
            classnames: "required",
            categy: "required",
            fname: "required",
            gender: "required",
            blooddgrp: "required",
            txt_mobile_no: "required",
            present_address: "required",
            txt_pwd: {
                required: true,
                minlength: 5
            },
            txt_retype_pwd: {
                required: true,
                minlength: 5
            },          
            txt_banknam: "required",
            txt_relation: "required",
            txt_occupation: "required",            
            txt_guardian_mobileno: "required",            
            txt_guardian_email: "required",            
            drp_hostelnam: "required",
            drp_roomname:"required"       
        }
    });
    $('#addadmission').on('submit', function (e) {
        e.preventDefault();
        var admissionCheck = $("#addadmission").valid();
        if (admissionCheck === true) {
        }
    });
    $("#class_id").on('change', function (e) {
        e.preventDefault(); 
        var class_id = $(this).val();
        console.log(class_id);
        $("#section_id").empty();
        $("#section_id").append('<option value="">Select Class Name</option>');
        $.post(sectionByClass, { class_id: class_id }, function (res) {
            if (res.code == 200) {
                $.each(res.data, function (key, val) {
                    $("#section_id").append('<option value="' + val.section_id + '">' + val.section_name + '</option>');
                });
            }
        }, 'json');
    });
});