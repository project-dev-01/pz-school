$(function () {

    $("#admission_date").datepicker({
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
        autoclose: true,
    });
    $("#dob").datepicker({
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
        autoclose: true,
    });
    // rules validation
    $("#addadmission").validate({
        rules: {
            
            parent_id: "required",
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
            lname: "required",
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

    $('#guardian_name').keyup(function(){ 
        var name = $(this).val();
        if(name != '')
        {
            $.ajax({
            url:parentName,
            method:"GET",
            data:{token: token, branch_id: branchID, name: name },
            success:function(data){
                $('#guardian_list').fadeIn();  
                $('#guardian_list').html(data);
            }
            });
        }
    });

    $('#guardian_list').on('click','li', function(){
        
        $('#guardian_name').val($(this).text());  
        $('#guardian_list').fadeOut();  
        var value = $(this).text();
        if(value=="No results Found") {
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
                    $("#guardian_nric").val(data.nric);
                    $("#guardian_gender").val(data.gender);
                    $("#guardian_date_of_birth").val(data.date_of_birth);
                    $("#guardian_passport").val(data.passport);
                    $("#guardian_country").val(data.country);
                    $("#guardian_post_code").val(data.post_code);
                    $("#guardian_address_2").val(data.address_2);
                    $("#guardian_occupation").val(data.occupation);
                    $("#guardian_income").val(data.income);
                    $("#guardian_blooddgrp").val(data.blood_group);
                    $("#guardian_education").val(data.education);
                    $("#guardian_mobile_no").val(data.mobile_no);
                    $("#guardian_state").val(data.state);
                    $("#guardian_city").val(data.city);
                    $("#guardian_address").val(data.address);
                }
            }, 'json');
        }
    });

    $('#father_name').keyup(function(){ 
        var name = $(this).val();
        if(name != '')
        {
            $.ajax({
            url:parentName,
            method:"GET",
            data:{token: token, branch_id: branchID, name: name },
            success:function(data){
                $('#father_list').fadeIn();  
                $('#father_list').html(data);
            }
            });
        }
    });

    $('#father_list').on('click','li', function(){
        
        $('#father_name').val($(this).text());  
        $('#father_list').fadeOut();  
        var value = $(this).text();
        if(value=="No results Found") {
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


    $('#mother_name').keyup(function(){ 
        var name = $(this).val();
        if(name != '')
        {
            $.ajax({
            url:parentName,
            method:"GET",
            data:{token: token, branch_id: branchID, name: name },
            success:function(data){
                $('#mother_list').fadeIn();  
                $('#mother_list').html(data);
            }
            });
        }
    });

    $('#mother_list').on('click','li', function(){
        
        $('#mother_name').val($(this).text());  
        $('#mother_list').fadeOut();  
        var value = $(this).text();
        if(value=="No results Found") {
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