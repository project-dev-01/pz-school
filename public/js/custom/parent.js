$(function () {

    $("#passport_expiry_date").datepicker({
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
        autoclose: true,
        yearRange: "-10:+10", // last hundred years
    });

    $("#visa_expiry_date").datepicker({
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
        autoclose: true,
        yearRange: "-10:+10", // last hundred years
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
        yearRange: "-100:+1", // last hundred years
        maxDate: 0
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
    $('#japanese_association_membership_image_supplimental').change(function() {
        // var i = $(this).prev('label').clone();
        var file = $('#japanese_association_membership_image_supplimental')[0].files[0];
        if(file.size > 2097152) {
            $('#japanese_association_membership_image_supplimental_name').text("File greater than 2Mb");
            $("#japanese_association_membership_image_supplimental_name").addClass("error");
            $('#japanese_association_membership_image_supplimental').val('');
        } else {
            $("#japanese_association_membership_image_supplimental_name").removeClass("error");
            $('#japanese_association_membership_image_supplimental_name').text(file.name);
        }
    });
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
    $("#addparent").validate({
        rules: {
            email: {
                required: true,
                email: true
            },

            guardian_last_name: "required",
            guardian_last_name_furigana: "required",
            guardian_last_name_english: "required",
            guardian_first_name_furigana: "required",
            guardian_first_name_english: "required",

            guardian_company_name_japan: "required",
            guardian_company_name_local: "required",

            guardian_company_phone_number: {
                required: true,
                minlength: 8
            },
            guardian_employment_status: "required",
            guardian_first_name: "required",
            guardian_phone_number: {
                required: true,
                minlength: 8
            },
            guardian_occupation: "required",
            // guardian_email: {
            //     required: true,
            //     email: true
            // },
            password: {
                required: true,
                minlength: 6
            },
            confirm_password: {
                required: true,
                minlength: 6,
                equalTo: "#password"
            },
            japan_postalcode: "required",
            japan_address: "required",
            stay_category: "required",
            
            
            japan_contact_no: {
                required: true,
                minlength: 8
            },
            japan_emergency_sms: {
                required: true,
                minlength: 8
            },
        }
    });

    $('#addparent').on('submit', function (e) {
        e.preventDefault();
        var parentcheck = $("#addparent").valid();
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

    $("#editParent").validate({
        rules: {
            guardian_first_name: "required",
            guardian_last_name: "required",
            email: {
                required: true,
                email: true
            },
            guardian_last_name_furigana: "required",
            guardian_last_name_english: "required",
            guardian_first_name_furigana: "required",
            guardian_first_name_english: "required",

            guardian_company_name_japan: "required",
            guardian_company_name_local: "required",
            // guardian_company_phone_number: "required",

            guardian_employment_status: "required",
            // guardian_relation: "required",
            guardian_phone_number: {
                required: true,
                minlength: 8
            },
            guardian_company_phone_number: {
                required: true,
                minlength: 8
            },
            guardian_phone_number: {
                required: true,
                minlength: 8
            },
            password: {
                minlength: 6
            },
            
            "confirm_password": {
                required: function (element) {
                    if ($("#password").val().length > 1) {
                        return true;
                    } else {
                        return false;
                    }
                },
                minlength: 6,
                equalTo: "#password"
            },
            japan_postalcode: "required",
            japan_address: "required",
            stay_category: "required",

            
            japan_contact_no: {
                required: true,
                minlength: 8
            },
            japan_emergency_sms: {
                required: true,
                minlength: 8
            },
        }
    });

    $('#editParent').on('submit', function (e) {
        e.preventDefault();
        console.log('123')
        var parentcheck = $("#editParent").valid();
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


    // delete Parent 
    $(document).on('click', '#deleteParentBtn', function () {
        var id = $(this).data('id');
        var url = parentDelete;
        swal.fire({
            title: deleteTitle + '?',
            html: deleteHtml,
            showCancelButton: true,
            showCloseButton: true,
            cancelButtonText: deletecancelButtonText,
            confirmButtonText: deleteconfirmButtonText,
            cancelButtonColor: '#d33',
            confirmButtonColor: '#556ee6',
            width: 400,
            allowOutsideClick: false
        }).then(function (result) {
            if (result.value) {
                $.post(url, {
                    id: id
                }, function (data) {
                    if (data.code == 200) {
                        $('#parent-table').DataTable().ajax.reload(null, false);
                        toastr.success(data.message);
                    } else {
                        toastr.error(data.message);
                    }
                }, 'json');
            }
        });
    });
  
    // designation add start
    var designation_increment = 1;
    $("#add_department").click(function () {
        designation_increment++;
        var designationAppend = '<tr id="row_designation' + designation_increment + '">' +
            '<td>'
            '<input type="text" class="form-control" id="full_name" value="" name="full_name" placeholder="" aria-describedby="inputGroupPrepend">' +
            '</td>' +
            '<td>' +
            '<div class="input-group input-group-merge">' +
            '<div class="input-group-prepend">' +
            '<div class="input-group-text">' +
            '<span class="fas fa-calendar"></span>' +
            '</div>' +
            '</div>' +
            '<input type="text" class="form-control designationDatepicker" name="designation_start[]" placeholder="' + yyyy_mm_dd + '">' +
            '</div>' +
            '</td>' +
            '<td>' +
           '<input type="text" class="form-control" id="relationship" value="" name="relationship" placeholder="" aria-describedby="inputGroupPrepend">'+
            '</td>' +
            '<td>' +
            '<button type="button" name="remove_designation" id="' + designation_increment + '" class="btn btn-danger btn_remove_designation">X</button>' +
            '</td>' +
            '</tr>';

        var appendDesHtml = $('#dynamic_field_two').append(designationAppend);
        // Initialize datepicker for the new field
        appendDesHtml.find('.designationDatepicker').datepicker({
            dateFormat: 'dd-mm-yy',
            changeMonth: true,
            changeYear: true,
            autoclose: true,
            yearRange: "-100:+50", // last hundred years
        });

    });
    $(document).on('click', '.btn_remove_designation', function () {
        var button_id = $(this).attr("id");
        $('#row_department' + button_id + '').remove();
    });
    // department add end
    function UrlExists(url) {
        // var http = new XMLHttpRequest();
        // http.open('HEAD', url, false);
        // http.send();
        // return http.status != 404;
        $.ajax({
            url: url,
            type: 'HEAD',
            error: function () {
                //file not exists
                return '404';
            },
            success: function () {
                //file exists
                return '200';
            }
        });
    }
});