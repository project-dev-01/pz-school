$(function () {
    
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

    $("#date").datepicker({
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
        autoclose: true,
        yearRange: "-3:+6", // last hundred years
    });
    
    // rules validation
    $("#addstudentmedical").validate({
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
            // txt_religion: "required",
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
            "dual_nationality": {
                required: function (element) {
                    return $("#has_dual_nationality_checkbox").is(":checked");
                },
                notEqualToNationality: true
            },
        
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

  
});