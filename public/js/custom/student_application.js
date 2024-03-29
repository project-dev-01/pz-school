$(function () {
    

    $("#verifyApplication").validate({
        rules: {
            email: {
                required: true,
                email: true
            },
        }
    });


    $('#verifyApplication').on('submit', function (e) {
        e.preventDefault();
        
        var admissionCheck = $("#verifyApplication").valid();
        if (admissionCheck === true) {
            
            $("#overlay").fadeIn(300);
            var form = this;
            $.ajax({
                url: $(form).attr('action'),
                method: $(form).attr('method'),
                data: new FormData(form),
                processData: false,
                dataType: 'json',
                contentType: false,
                success: function (data) {
                    
                    // toastr.success("Email Verification Sended Successfully");
                    $("#overlay").fadeOut(300);
                    if (data.code == 200) {
                        $('#verify_email').val("");
                        toastr.success(data.message);
                    } else {
                        toastr.error(data.message);
                    }
                }
            });
        }
    });
    $(document).on('change', '#terms_condition', function () {
        
        if ($(this).prop('checked') == false) {
            $('#submit').prop('disabled', true);
            $('#submit').prop('disabled', true);
        } else {
            $('#aggrement').modal({ backdrop: 'static', keyboard: false })
            $('#aggrement').modal('show')
            $('#submit').prop('disabled', false);
            $('#submit').prop('disabled', false);
        }

    });
    $(document).on('change', '#submit_instruction', function () {
        if ($(this).prop('checked') == true) {
            window.open("https://app.box.com/s/bimvbk6e3txoxqpkbhnqalgt3s123eu3", '_blank');
            // $(this).prop('disabled', true);
        }
    });
    
    $(".number_validation").keypress(function () {
        var regex = new RegExp("^[0-9-+]");
        var key = String.fromCharCode(event.charCode ? event.which : event.charCode);
        if (!regex.test(key)) {
            event.preventDefault();
            return false;
        }
    });
    $("#date_of_birth").datepicker({
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
        autoclose: true,
        yearRange: "-100:+50", // last hundred years
        maxDate: 0
    });

    $("#addApplication").validate({
        rules: {
            first_name: "required",
            mobile_no: "required",
            email: {
                required: true,
                email: true
            },
            address_1: "required",
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
            father_phone_number: "required",
            father_occupation: "required",
            father_email: {
                required: true,
                email: true
            },
            mother_first_name: "required",
            mother_phone_number: "required",
            mother_occupation: "required",
            mother_email: {
                required: true,
                email: true
            },
            guardian_first_name: "required",
            guardian_relation: "required",
            guardian_phone_number: "required",
            guardian_occupation: "required",
            guardian_email: {
                required: true,
                email: true
            },
            verify_email:"required",
        }
    });


    $('#addApplication').on('submit', function (e) {
        e.preventDefault();
        
        var admissionCheck = $("#addApplication").valid();
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
                        window.location.href = application;
                    } else {
                        toastr.error(data.message);
                    }
                }
            });
        }
    });

    
    // verify email required 
    $(".verify_email").on("click", function () {
        var details = $(this).val()+"_details";
        console.log('this',details)
        $("#"+details).show("slow");
        $(".skip").prop( "disabled", false )
        // $(".skip").prop( "checked", true )
        $("#skip_"+details).prop( "disabled", true )
        $("#skip_"+details).prop( "checked", false )
        // if ($(this).is(":checked")) {
        //     $("#mother_details").hide("slow");
        // } else {
        //     $("#mother_details").show("slow");
        // }
    });
    // skip_mother_details
    $("#skip_mother_details").on("change", function () {
        if ($(this).is(":checked")) {
            $("#mother_details").hide("slow");
        } else {
            $("#mother_details").show("slow");
        }
    });
    // skip_father_details
    $("#skip_father_details").on("change", function () {
        if ($(this).is(":checked")) {
            $("#father_details").hide("slow");
        } else {
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

    
});