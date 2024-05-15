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
            school_roleid: "required",
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
    $("#editParent").validate({
        rules: {
            guardian_first_name: "required",
            guardian_last_name: "required",
            email: {
                required: true,
                email: true
            },
            school_roleid: "required",
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
            // passport_father_photo:"required",
            // passport_mother_photo:"required",
            
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
  
    $(".dobDatepicker").datepicker({
        dateFormat: 'dd-mm-yy',
        changeMonth: true,
        changeYear: true,
        autoclose: true,
        yearRange: "-100:+50", // last hundred years
    });
    // designation add start
    var sibling_increment = 1;
    $(document).on('click', '#add_sibling', function() {
        console.log(sibling_increment);
        sibling_increment++;
        var siblingAppend = '<tr id="row_sibling' + sibling_increment + '">' +
            '<td>'+
            '<input type="text" class="form-control" id="full_name" name="full_name[]" placeholder="" aria-describedby="inputGroupPrepend">' +
            '</td>' +
            '<td>' +
            '<div class="input-group input-group-merge">' +
            '<div class="input-group-prepend">' +
            '<div class="input-group-text">' +
            '<span class="fas fa-calendar"></span>' +
            '</div>' +
            '</div>' +
            '<input type="text" class="form-control dobDatepicker" name="siblingdob[]" placeholder="' + yyyy_mm_dd + '">' +
            '</div>' +
            '</td>' +
            '<td>' +
           '<input type="text" class="form-control" id="relationship" name="relationship[]" placeholder="" aria-describedby="inputGroupPrepend">'+
            '</td>' +
            '<td>' +
            '<button type="button" name="remove_designation" id="' + sibling_increment + '" class="btn btn-danger btn_remove_designation">X</button>' +
            '</td>' +
            '</tr>';

        var appendDesHtml = $('#dynamic_field_one').append(siblingAppend);
        // Initialize datepicker for the new field
        appendDesHtml.find('.dobDatepicker').datepicker({
            dateFormat: 'dd-mm-yy',
            changeMonth: true,
            changeYear: true,
            autoclose: true,
            yearRange: "-100:+50", // last hundred years
        });

    });
    $(document).on('click', '.btn_remove_designation', function () {
        var button_id = $(this).attr("id");
        $('#row_sibling' + button_id + '').remove();
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
function toggleBasicDetails(student_id) {
    var prevSelectedCard = document.querySelector('.card-body.clicked');
    if (prevSelectedCard) {
        prevSelectedCard.classList.remove('clicked');
    }
    var cardBody = document.querySelector(`#child_${student_id}`);
   
    if (cardBody) {
        // Toggle the 'clicked' class to change the background color
        cardBody.classList.toggle('clicked');
    }
   //    var student_id = document.getElementById("student_id").value;
    var basicDetailsSection = document.getElementById("basic_details");
    var fatherSection = document.getElementById("father_details");
    var motherSection = document.getElementById("mother_details");
    var siblingSection = document.getElementById("sibling");
    var motherFatherSection = document.getElementById("mother_father_photo");
    var motherFatherSections = document.getElementById("mother_father_photos");
    var motherFatherSectionss = document.getElementById("mother_father_photoss");
    var passportdetails = document.getElementById("passportdetails");
    console.log(student_id);
    if (student_id) {
        $.post(parentDetailsAccStudentId, { token: token, branch_id: branchID, student_id: student_id }, function (res) {
            console.log(res.data);
            if (res.code == 200) {
                var data = res.data.father;
                var motherdata = res.data.mother;
                // if (data.photo) {
                //     var src = parentImg + "/" + data.photo;
                // } else {
                //     var src = defaultImg;
                // }
                $("#father_id").val(data.id);
                $("#father_first_name").val(data.first_name);
                $("#father_middle_name").val(data.middle_name);
                $("#father_last_name").val(data.last_name);
                $("#father_last_name_furigana").val(data.last_name_furigana);
                $("#father_middle_name_furigana").val(data.middle_name_furigana);
                $("#father_first_name_furigana").val(data.first_name_furigana);
                $("#father_last_name_english").val(data.last_name_english);
                $("#father_middle_name_english").val(data.middle_name_english);
                $("#father_first_name_english").val(data.first_name_english);
                $("#father_nationality").val(data.nationality);
                var nationalityName = data.nationality;
                var countryCode = getCountryCodeByNationality(nationalityName);
                // Find the flag element within the .selected-flag container and update its class
                $(".father .selected-flag .flag").removeClass().addClass("flag " + countryCode);
                $("#father_email").val(data.email);
                $("#father_occupation").val(data.occupation);
                $("#father_mobile_no").val(data.mobile_no);
                $("#passport_father_old_photo").val(data.passport_photo);
                var passportFatherPhoto = data.passport_photo;
                if (passportFatherPhoto) {
                    var passportFatherImageUrl = userImageUrl + passportFatherPhoto;
                    $("#passport_father_photo_link").attr("href", passportFatherImageUrl).show();
                } else {
                    $("#passport_father_photo_link").hide();
                }
                $("#visa_father_old_photo").val(data.visa_photo);
                // Set visa father photo link
                var visaFatherPhoto = data.visa_photo;
                if (visaFatherPhoto) {
                    var visaFatherImageUrl = userImageUrl + visaFatherPhoto;
                    $("#visa_father_photo_link").attr("href", visaFatherImageUrl).show();
                } else {
                    $("#visa_father_photo_link").hide();
                }

                $("#mother_id").val(motherdata.id)
                $("#mother_first_name").val(motherdata.first_name);
                $("#mother_last_name").val(motherdata.last_name);
                $("#mother_middle_name").val(motherdata.middle_name);
                $("#mother_last_name_furigana").val(motherdata.last_name_furigana);
                $("#mother_middle_name_furigana").val(motherdata.middle_name_furigana);
                $("#mother_first_name_furigana").val(motherdata.first_name_furigana);
                $("#mother_last_name_english").val(motherdata.last_name_english);
                $("#mother_middle_name_english").val(motherdata.middle_name_english);
                $("#mother_first_name_english").val(motherdata.first_name_english);
                $("#mother_nationality").val(motherdata.nationality);
                var nationalityName1 = motherdata.nationality;
                var countryCode1 = getCountryCodeByNationality(nationalityName1);
                // Find the flag element within the .selected-flag container and update its class
                $(".mother .selected-flag .flag").removeClass().addClass("flag " + countryCode1);
                $("#mother_email").val(motherdata.email);
                $("#mother_occupation").val(motherdata.occupation);
                $("#mother_mobile_no").val(motherdata.mobile_no);
                $("#passport_mother_old_photo").val(motherdata.passport_photo);
                // Set passport mother photo link
                var passportMotherPhoto = motherdata.passport_photo;
                if (passportMotherPhoto) {
                    var passportMotherImageUrl = userImageUrl + passportMotherPhoto;
                    $("#passport_mother_photo_link").attr("href", passportMotherImageUrl).show();
                } else {
                    $("#passport_mother_photo_link").hide();
                }
                $("#visa_mother_old_photo").val(motherdata.visa_photo);
                // Set visa mother photo link
                var visaMotherPhoto = motherdata.visa_photo;
                if (visaMotherPhoto) {
                    var visaMotherImageUrl = userImageUrl + visaMotherPhoto;
                    $("#visa_mother_photo_link").attr("href", visaMotherImageUrl).show();
                } else {
                    $("#visa_mother_photo_link").hide();
                }
            }
        }, 'json');
         $.post(studentDetailsAccStudentId, { token: token, branch_id: branchID, id: student_id }, function (res) {
            console.log(res.data);
            if (res.code == 200) {
                var studentData = res.data.student;
                console.log(studentData.relation);
                $("#guardian_relation").val(studentData.relation);
                $("#student_id").val(studentData.id);
                populateSiblingData(studentData);
               
            }
    }, 'json');
    basicDetailsSection.classList.add("show");
    fatherSection.classList.add("show");
    motherSection.classList.add("show");
    siblingSection.classList.add("show");
    motherFatherSection.classList.add("show");
    motherFatherSections.classList.add("show");
    motherFatherSectionss.classList.add("show");
    passportdetails.classList.add("show");
    }
}
// Function to populate sibling data rows
function populateSiblingData(siblingData) {
   
     // Check if any of the sibling data arrays are empty
     if (!siblingData.sibling_full_name || !siblingData.sibling_dob || !siblingData.sibling_relationship) {
        // Display a message or perform specific actions for empty data
        console.log("Sibling data arrays are empty.");
        // For example, show an alert or update UI accordingly
        return; // Exit the function if data arrays are empty
    }
     $("#dynamic_field_one").empty();
    // Split the sibling data strings by commas to separate individual values
    var names = siblingData.sibling_full_name.split(',');
    var dobs = siblingData.sibling_dob.split(',');
    var relationships = siblingData.sibling_relationship.split(',');

    // Iterate over the sibling entries (assuming all arrays are of the same length)
    for (var i = 0; i < names.length; i++) {
        var name = names[i] ? names[i].trim() : ''; // Trim whitespace if not empty
    var dob = dobs[i] ? dobs[i].trim() : ''; // Trim whitespace if not empty
    var relation = relationships[i] ? relationships[i].trim() : '';

        // Create sibling data object
        var siblingObject = {
            sibling_full_name: name,
            sibling_dob: dob,
            sibling_relationship: relation
        };
        var isFirstRow = (i === 0);
        // Call the function to populate the sibling data row
        populateSingleSiblingRow(siblingObject,isFirstRow);
    }
}

// Function to populate a single sibling data row
function populateSingleSiblingRow(siblingObject,isFirstRow) {
    // Extract sibling details from the object
    var name = siblingObject.sibling_full_name || '';
    var dob = siblingObject.sibling_dob || '';
    var relation = siblingObject.sibling_relationship || '';

    // Create HTML for the sibling row
    var html = `
        <tr class="department-row">
            <td>
                <input type="text" class="form-control" name="full_name[]" value="${name}">
            </td>
            <td>
                <div class="input-group input-group-merge">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <span class="fas fa-calendar"></span>
                        </div>
                    </div>
                    <input type="text" class="form-control dobDatepicker" name="siblingdob[]" placeholder="{{ __('messages.yyyy_mm_dd') }}" value="${dob}">
                </div>
            </td>
            <td>
                <input type="text" class="form-control" name="relationship[]" value="${relation}">
            </td>
            <td>
            ${isFirstRow ? `<button type="button" name="add_sibling" id="add_sibling" class="btn btn-primary">${addButton} +</button>` : `<button type="button" class="btn btn-danger btn_remove_sibling">X</button>`}
        </td>
        </tr>
    `;

    // Append the HTML to the dynamic field container
    $("#dynamic_field_one").append(html);

    // Initialize datepicker for the new field
    $('.dobDatepicker').datepicker({
        dateFormat: 'yy-mm-dd', // Set appropriate date format
        changeMonth: true,
        changeYear: true,
        autoclose: true,
        yearRange: "-100:+50" // last hundred years
    });
}
var countryCodes = {
"Afghanistan": "af",
"Åland Islands": "ax",
"Albania": "al",
"Algeria": "dz",
"American Samoa": "as",
"Andorra": "ad",
"Angola": "ao",
"Anguilla": "ai",
"Antarctica": "aq",
"Antigua and Barbuda": "ag",
"Argentina": "ar",
"Armenia": "am",
"Aruba": "aw",
"Australia": "au",
"Austria": "at",
"Azerbaijan": "az",
"Bahamas": "bs",
"Bahrain": "bh",
"Bangladesh": "bd",
"Barbados": "bb",
"Belarus": "by",
"Belgium": "be",
"Belize": "bz",
"Benin": "bj",
"Bermuda": "bm",
"Bhutan": "bt",
"Bolivia (Plurinational State of)": "bo",
"Bonaire, Sint Eustatius and Saba": "bq",
"Bosnia and Herzegovina": "ba",
"Botswana": "bw",
"Bouvet Island": "bv",
"Brazil": "br",
"British Indian Ocean Territory": "io",
"United States Minor Outlying Islands": "um",
"Virgin Islands (British)": "vg",
"Virgin Islands (U.S.)": "vi",
"Brunei Darussalam": "bn",
"Bulgaria": "bg",
"Burkina Faso": "bf",
"Burundi": "bi",
"Cambodia": "kh",
"Cameroon": "cm",
"Canada": "ca",
"Cabo Verde": "cv",
"Cayman Islands": "ky",
"Central African Republic": "cf",
"Chad": "td",
"Chile": "cl",
"China": "cn",
"Christmas Island": "cx",
"Cocos (Keeling) Islands": "cc",
"Colombia": "co",
"Comoros": "km",
"Congo": "cg",
"Congo (Democratic Republic of the)": "cd",
"Cook Islands": "ck",
"Costa Rica": "cr",
"Croatia": "hr",
"Cuba": "cu",
"Curaçao": "cw",
"Cyprus": "cy",
"Czech Republic": "cz",
"Denmark": "dk",
"Djibouti": "dj",
"Dominica": "dm",
"Dominican Republic": "do",
"Ecuador": "ec",
"Egypt": "eg",
"El Salvador": "sv",
"Equatorial Guinea": "gq",
"Eritrea": "er",
"Estonia": "ee",
"Eswatini": "sz",
"Ethiopia": "et",
"Falkland Islands (Malvinas)": "fk",
"Faroe Islands": "fo",
"Fiji": "fj",
"Finland": "fi",
"France": "fr",
"French Guiana": "gf",
"French Polynesia": "pf",
"French Southern Territories": "tf",
"Gabon": "ga",
"Gambia": "gm",
"Georgia": "ge",
"Germany": "de",
"Ghana": "gh",
"Gibraltar": "gi",
"Greece": "gr",
"Greenland": "gl",
"Grenada": "gd",
"Guadeloupe": "gp",
"Guam": "gu",
"Guatemala": "gt",
"Guernsey": "gg",
"Guinea": "gn",
"Guinea-Bissau": "gw",
"Guyana": "gy",
"Haiti": "ht",
"Heard Island and McDonald Islands": "hm",
"Holy See": "va",
"Honduras": "hn",
"Hong Kong": "hk",
"Hungary": "hu",
"Iceland": "is",
"India": "in",
"Indonesia": "id",
"Côte d'Ivoire": "ci",
"Iran (Islamic Republic of)": "ir",
"Iraq": "iq",
"Ireland": "ie",
"Isle of Man": "im",
"Israel": "il",
"Italy": "it",
"Jamaica": "jm",
"Japan": "jp",
"Jersey": "je",
"Jordan": "jo",
"Kazakhstan": "kz",
"Kenya": "ke",
"Kiribati": "ki",
"Kuwait": "kw",
"Kyrgyzstan": "kg",
"Lao People's Democratic Republic": "la",
"Latvia": "lv",
"Lebanon": "lb",
"Lesotho": "ls",
"Liberia": "lr",
"Libya": "ly",
"Liechtenstein": "li",
"Lithuania": "lt",
"Luxembourg": "lu",
"Macao": "mo",
"Madagascar": "mg",
"Malawi": "mw",
"Malaysia": "my",
"Maldives": "mv",
"Mali": "ml",
"Malta": "mt",
"Marshall Islands": "mh",
"Martinique": "mq",
"Mauritania": "mr",
"Mauritius": "mu",
"Mayotte": "yt",
"Mexico": "mx",
"Micronesia (Federated States of)": "fm",
"Moldova (Republic of)": "md",
"Monaco": "mc",
"Mongolia": "mn",
"Montenegro": "me",
"Montserrat": "ms",
"Morocco": "ma",
"Mozambique": "mz",
"Myanmar": "mm",
"Namibia": "na",
"Nauru": "nr",
"Nepal": "np",
"Netherlands": "nl",
"New Caledonia": "nc",
"New Zealand": "nz",
"Nicaragua": "ni",
"Niger": "ne",
"Nigeria": "ng",
"Niue": "nu",
"Norfolk Island": "nf",
"Korea (Democratic People's Republic of)": "kp",
"Northern Mariana Islands": "mp",
"Norway": "no",
"Oman": "om",
"Pakistan": "pk",
"Palau": "pw",
"Palestine, State of": "ps",
"Panama": "pa",
"Papua New Guinea": "pg",
"Paraguay": "py",
"Peru": "pe",
"Philippines": "ph",
"Pitcairn": "pn",
"Poland": "pl",
"Portugal": "pt",
"Puerto Rico": "pr",
"Qatar": "qa",
"Republic of North Macedonia": "mk",
"Romania": "ro",
"Russian Federation": "ru",
"Rwanda": "rw",
"Réunion": "re",
"Saint Barthélemy": "bl",
"Saint Helena, Ascension and Tristan da Cunha": "sh",
"Saint Kitts and Nevis": "kn",
"Saint Lucia": "lc",
"Saint Martin (French part)": "mf",
"Saint Pierre and Miquelon": "pm",
"Saint Vincent and the Grenadines": "vc",
"Samoa": "ws",
"San Marino": "sm",
"Sao Tome and Principe": "st",
"Saudi Arabia": "sa",
"Senegal": "sn",
"Serbia": "rs",
"Seychelles": "sc",
"Sierra Leone": "sl",
"Singapore": "sg",
"Sint Maarten (Dutch part)": "sx",
"Slovakia": "sk",
"Slovenia": "si",
"Solomon Islands": "sb",
"Somalia": "so",
"South Africa": "za",
"South Georgia and the South Sandwich Islands": "gs",
"Korea (Republic of)": "kr",
"South Sudan": "ss",
"Spain": "es",
"Sri Lanka": "lk",
"Sudan": "sd",
"Suriname": "sr",
"Svalbard and Jan Mayen": "sj",
"Sweden": "se",
"Switzerland": "ch",
"Syrian Arab Republic": "sy",
"Taiwan": "tw",
"Tajikistan": "tj",
"Tanzania, United Republic of": "tz",
"Thailand": "th",
"Timor-Leste": "tl",
"Togo": "tg",
"Tokelau": "tk",
"Tonga": "to",
"Trinidad and Tobago": "tt",
"Tunisia": "tn",
"Turkey": "tr",
"Turkmenistan": "tm",
"Turks and Caicos Islands": "tc",
"Tuvalu": "tv",
"Uganda": "ug",
"Ukraine": "ua",
"United Arab Emirates": "ae",
"United Kingdom of Great Britain and Northern Ireland": "gb",
"United States of America": "us",
"Uruguay": "uy",
"Uzbekistan": "uz",
"Vanuatu": "vu",
"Venezuela (Bolivarian Republic of)": "ve",
"Viet Nam": "vn",
"Wallis and Futuna": "wf",
"Western Sahara": "eh",
"Yemen": "ye",
"Zambia": "zm",
"Zimbabwe": "zw"
};


// Function to retrieve country code based on nationality name
function getCountryCodeByNationality(nationalityName) {
return countryCodes[nationalityName];
}
function openBasicDetails() {
    var basicDetailsRow = document.querySelector('.basic-details-row');
    var basicDetailsSection = document.getElementById("basic_details");

    if (basicDetailsRow) {
        // Count the number of child cards
        var childCount = basicDetailsRow.querySelectorAll('.card').length;
        console.log(childCount);
        // Toggle the visibility of the basic details row based on child count
        if (childCount > 0) {
            // Show the basic details row if it's currently hidden
            if (basicDetailsRow.style.display === 'none') {
                basicDetailsRow.style.display = 'block'; // Show the row
            } 
        }else {
            // Hide the basic details row if it's currently visible
            basicDetailsRow.style.display = 'block'; // Hide the row
            basicDetailsSection.classList.add('show');
        }
    }

    

    
    $('#edit_status').change(function() {
        // $(document).on('change', '#edit_status', function () {
            if ($(this).is(":checked")) {
                var statusconfirmButtonText = statusLockText;
                var statusHtml = statusLockHtml;
            } else {
                var statusconfirmButtonText = statusUnLockText;
                var statusHtml = statusUnLockHtml;
            }
            swal.fire({
                title: statusTitle + '?',
                html: statusHtml,
                showCancelButton: true,
                showCloseButton: true,
                cancelButtonText: statuscancelButtonText,
                confirmButtonText: statusconfirmButtonText,
                cancelButtonColor: '#d33',
                confirmButtonColor: '#556ee6',
                width: 400,
                allowOutsideClick: false
            }).then(function (result) {
                if (result.value) {
                    if($("#edit_status").is(":checked")){
                        $("#edit_status").prop('checked', true);
                    }else{
    
                        $("#edit_status").prop('checked', false);
                    }
                }else{
                    if($("#edit_status").is(":checked")){
                        $("#edit_status").prop('checked', false);
                    }else{
    
                        $("#edit_status").prop('checked', true);
                    }
    
                }
            });
        });
}