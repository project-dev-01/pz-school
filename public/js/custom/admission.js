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
                minlength: 6
            },
            txt_retype_pwd: {
                required: true,
                minlength: 6
            },          
            txt_name: "required",
            txt_relation: "required",
            txt_occupation: "required",            
            txt_guardian_mobileno: "required",            
            txt_guardian_email: "required",  
            
            txt_guardian_pwd: {
                required: true,
                minlength: 6
            },
            txt_guardian_retyppwd: {
                required: true,
                minlength: 6
            },          
        }
    });

    $('#addadmission').on('submit', function (e) {
        e.preventDefault();
        var admissionCheck = $("#addadmission").valid();
        if (admissionCheck === true) {
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
                        window.location.href = indexAdmission;
                    } else {
                        toastr.error(data.message);
                    }
                }
            });
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

    $("#drp_transport_route").on('change', function (e) {
        e.preventDefault(); 
        var route_id = $(this).val();
        $("#drp_transport_vechicleno").empty();
        $("#drp_transport_vechicleno").append('<option value="">Select Vehicle</option>');
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
        $("#drp_roomname").append('<option value="">Select Room</option>');
        $.post(roomByHostel, { hostel_id: hostel_id }, function (res) {
            if (res.code == 200) {
                $.each(res.data, function (key, val) {
                    $("#drp_roomname").append('<option value="' + val.room_id + '">' + val.room_name + '</option>');
                });
            }
        }, 'json');
    });
});