$(function () {

    $(document).on('change', '#terms_condition', function () {
        if ($(this).prop('checked') == false) {
            $('#submit').prop('disabled', true);
            $('#submit').prop('disabled', true);
        } else {
            $('#submit').prop('disabled', false);
            $('#submit').prop('disabled', false);
        }

    });
    
    $(".number_validation").keypress(function () {
        console.log(123)
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
});