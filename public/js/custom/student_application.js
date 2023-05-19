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
            parent_type: "required",
            parent_relation: "required",
            parent_first_name: "required",
            parent_phone_number: "required",
            parent_occupation: "required",
            parent_email: {
                required: true,
                email: true
            },
            secondary_type: "required",
            secondary_relation: "required",
            secondary_first_name: "required",
            secondary_phone_number: "required",
            secondary_occupation: "required",
            secondary_email: {
                required: true,
                email: true
            },
            emergency_contact_person: "required",
            emergency_contact_first_name: "required",
            emergency_contact_phone_number: "required",

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