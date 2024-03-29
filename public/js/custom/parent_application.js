$(function () {
    $(".number_validation").keypress(function(event){
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
        yearRange: "-60:+1", // last hundred years
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

    $('#nric_photo').change(function () {
        // var i = $(this).prev('label').clone();
        var file = $('#nric_photo')[0].files[0];
        if (file.size > 2097152) {
            $('#nric_photo_name').text("File greater than 2Mb");
            $("#nric_photo_name").addClass("error");
            $('#nric_photo').val('');
        } else {
            $("#nric_photo_name").removeClass("error");
            $('#nric_photo_name').text(file.name);
        }
    });


    $('#japanese_association_membership_image_supplimental').change(function () {
        // var i = $(this).prev('label').clone();
        var file = $('#japanese_association_membership_image_supplimental')[0].files[0];
        if (file.size > 2097152) {
            $('#japanese_association_membership_image_supplimental_name').text("File greater than 2Mb");
            $("#japanese_association_membership_image_supplimental_name").addClass("error");
            $('#japanese_association_membership_image_supplimental').val('');
        } else {
            $("#japanese_association_membership_image_supplimental_name").removeClass("error");
            $('#japanese_association_membership_image_supplimental_name').text(file.name);
        }
    });

    $('#japanese_association_membership_image_principal').change(function () {
        // var i = $(this).prev('label').clone();
        var file = $('#japanese_association_membership_image_principal')[0].files[0];
        if (file.size > 2097152) {
            $('#japanese_association_membership_image_principal_name').text("File greater than 2Mb");
            $("#japanese_association_membership_image_principal_name").addClass("error");
            $('#japanese_association_membership_image_principal').val('');
        } else {
            $("#japanese_association_membership_image_principal_name").removeClass("error");
            $('#japanese_association_membership_image_principal_name').text(file.name);
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


    $(document).ready(function () {
        $("#postal_code").change(function () {
            var postalCode = $('#postal_code').val();
            var country = $('#country').val();
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
                        $('#city').val(city);
                        $('#state').val(state);
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
    $("#expected_enroll_date").datepicker({
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
        autoclose: true,
        yearRange: "-1:+1", // last hundred years
        minDate: 0
    });
    
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
    $("#next").click(function(){
            console.log('etts')
        $("#basic_tab").removeClass("active");
        $("#personal_tab").addClass("active");
    });
    
    // skip_prev_school_details
    $("#skip_prev_school_details").on("change", function () {
        
        if ($(this).is(":checked")) {
            
            $(".prev_school_form").val("");
            $("#prev_school_details").hide("slow");
        } else {
            $("#prev_school_details").show("slow");
        }
    });
    // skip_mother_details
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
    $("#addApplication").validate({
        rules: {
            first_name: "required",
            last_name: "required",
            first_name_furigana: "required",
            last_name_furigana: "required",
            first_name_english: "required",
            last_name_english: "required",
            // mobile_no: "required",
            date_of_birth: "required",
            gender: "required",
            religion: "required",
            nationality: "required",
            school_enrollment_status: "required",
            school_enrollment_status_tendency: "required",
            mother_last_name: "required",
            mother_first_name_furigana: "required",
            mother_first_name_english: "required",
            mother_last_name_furigana: "required",
            mother_last_name_english: "required",
            mother_nationality: "required",
            mother_occupation: "required",

            father_last_name: "required",
            father_last_name_furigana: "required",
            father_last_name_english: "required",
            father_first_name_furigana: "required",
            father_first_name_english: "required",
            father_nationality: "required",
            father_occupation: "required",

            guardian_last_name: "required",
            guardian_last_name_furigana: "required",
            guardian_last_name_english: "required",
            guardian_first_name_furigana: "required",
            guardian_first_name_english: "required",
            father_nationality: "required",
            father_occupation: "required",

            guardian_company_name_japan: "required",
            guardian_company_name_local: "required",
            // guardian_company_phone_number: "required",

            guardian_company_phone_number: {
                required: true,
                minlength: 8
            },
            guardian_employment_status: "required",

            expected_academic_year: "required",
            expected_grade: "required",
            expected_enroll_date: "required",
            remarks: "required",

            // email: {
            //     required: true,
            //     email: true
            // },
            // address_1: "required",
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
            father_phone_number: {
                required: true,
                minlength: 8
            },
            father_occupation: "required",
            father_email: {
                required: true,
                email: true
            },
            mother_first_name: "required",

            mother_phone_number: {
                required: true,
                minlength: 8
            },
            mother_occupation: "required",
            mother_email: {
                required: true,
                email: true
            },
            guardian_first_name: "required",
            guardian_relation: "required",
            guardian_phone_number: {
                required: true,
                minlength: 8
            },
            guardian_occupation: "required",
            guardian_email: {
                required: true,
                email: true
            },
            last_date_of_withdrawal: "required"

        }
    });

    $('#addApplication').on('submit', function (e) {
        e.preventDefault();
        console.log('123')
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
                        window.location.href = applicationIndex;
                    } else {
                        toastr.error(data.message);
                    }
                }
            });
        }
    });
    $("#passport, #japanese_association_membership_number_student").on("input", function() {
        var regexp = /^[A-Za-z0-9]+$/;
        if (!regexp.test($(this).val())) {
            $(this).val($(this).val().replace(/[^\w]/gi, ''));
        }
    });
    $("#editApplication").validate({
        rules: {
            first_name: "required",
            last_name: "required",
            first_name_furigana: "required",
            last_name_furigana: "required",
            first_name_english: "required",
            last_name_english: "required",
            // mobile_no: "required",
            date_of_birth: "required",
            gender: "required",
            religion: "required",
            nationality: "required",
            school_enrollment_status: "required",
            school_enrollment_status_tendency: "required",
            mother_last_name: "required",
            mother_first_name_furigana: "required",
            mother_first_name_english: "required",
            mother_last_name_furigana: "required",
            mother_last_name_english: "required",
            mother_nationality: "required",
            mother_occupation: "required",

            father_last_name: "required",
            father_last_name_furigana: "required",
            father_last_name_english: "required",
            father_first_name_furigana: "required",
            father_first_name_english: "required",
            father_nationality: "required",
            father_occupation: "required",

            guardian_last_name: "required",
            guardian_last_name_furigana: "required",
            guardian_last_name_english: "required",
            guardian_first_name_furigana: "required",
            guardian_first_name_english: "required",
            father_nationality: "required",
            father_occupation: "required",

            guardian_company_name_japan: "required",
            guardian_company_name_local: "required",
            // guardian_company_phone_number: "required",

            guardian_company_phone_number: {
                required: true,
                minlength: 8
            },
            guardian_employment_status: "required",

            expected_academic_year: "required",
            expected_grade: "required",
            expected_enroll_date: "required",
            remarks: "required",

            // email: {
            //     required: true,
            //     email: true
            // },
            // address_1: "required",
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
            father_phone_number: {
                required: true,
                minlength: 8
            },
            father_occupation: "required",
            father_email: {
                required: true,
                email: true
            },
            mother_first_name: "required",

            mother_phone_number: {
                required: true,
                minlength: 8
            },
            mother_occupation: "required",
            mother_email: {
                required: true,
                email: true
            },
            guardian_first_name: "required",
            guardian_relation: "required",
            guardian_phone_number: {
                required: true,
                minlength: 8
            },
            guardian_occupation: "required",
            guardian_email: {
                required: true,
                email: true
            },
            last_date_of_withdrawal: "required",
            status: "required",
            phase_2_status: "required",


            postal_code: "required",
            address_unit_no: "required",
            address_condominium: "required",
            address_street: "required",
            address_district: "required",
            passport: "required",
            passport_expiry_date: "required",
            // passport_photo:"required",
            // visa_photo:"required",
            visa_expiry_date: "required",
            visa_type: "required",
            visa_type_others: "required",
            stay_category:"required",
            japanese_association_membership_number_student: "required",
            // japanese_association_membership_image_principal:"required",
            // japanese_association_membership_image_supplimental:"required",
            phase2_remarks: "required",
            // passport_father_photo: "required",
            // passport_mother_photo: "required",


            "passport_photo": {
                required: function (element) {
                    if ($("#passport_old_photo").val().length < 1) {
                        return true;
                    } else {
                        return false;
                    }
                }
            },
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

        }
    });

    $('#editApplication').on('submit', function (e) {
        e.preventDefault();
        console.log('123')
        var admissionCheck = $("#editApplication").valid();
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
                        window.location.href = applicationIndex;
                    } else {
                        toastr.error(data.message);
                    }
                }
            });
        }
    });

    $('#visa_type').on('change', function () {
        $("#visa_type_others_show").hide('');
        var check = $(this).val();
        
        $("#visa_type_others").val("");
        if (check == "Others") {
            $("#visa_type_others_show").show('');
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
    // change 
    
    
    $('.re_admission').on('change', function () {
        var value = $(this).val();
        if (value == "yes") {

            $("#last_date").show();
        } else {
            $("#last_date").hide();
        }
    });
    application();
    function application() {
        $('#application-table').DataTable({
            processing: true,
            info: true,
            bDestroy: true,
            // dom: 'lBfrtip',
            dom: "<'row'<'col-sm-2 col-md-2'l><'col-sm-4 col-md-4'B><'col-sm-6 col-md-6'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-6'i><'col-sm-6'p>>",
            "language": {

                "emptyTable": no_data_available,
                "infoFiltered": filter_from_total_entries,
                "zeroRecords": no_matching_records_found,
                "infoEmpty": showing_zero_entries,
                "info": showing_entries,
                "lengthMenu": show_entries,
                "search": datatable_search,
                "paginate": {
                    "next": next,
                    "previous": previous
                },
            },
            buttons: [
                {
                    extend: 'csv',
                    text: downloadcsv,
                    extension: '.csv',
                    charset: 'utf-8',
                    bom: true,
                    exportOptions: {
                        columns: 'th:not(:last-child)'
                    }
                },
                {
                    extend: 'pdf',
                    text: downloadpdf,
                    extension: '.pdf',
                    charset: 'utf-8',
                    bom: true,
                    exportOptions: {
                        columns: 'th:not(:last-child)'
                    },

                
                    customize: function (doc) {
                    doc.pageMargins = [50,50,50,50];
                    doc.defaultStyle.fontSize = 10;
                    doc.styles.tableHeader.fontSize = 12;
                    doc.styles.title.fontSize = 14;
                    // Remove spaces around page title
                    doc.content[0].text = doc.content[0].text.trim();
                    /*// Create a Header
                    doc['header']=(function(page, pages) {
                        return {
                            columns: [
                                
                                {
                                    // This is the right column
                                    bold: true,
                                    fontSize: 20,
                                    color: 'Blue',
                                    fillColor: '#fff',
                                    alignment: 'center',
                                    text: header_txt
                                }
                            ],
                            margin:  [50, 15,0,0]
                        }
                    });*/
                    // Create a footer
                    
                    doc['footer']=(function(page, pages) {
                        return {
                            columns: [
                                { alignment: 'left', text: [ footer_txt ],width:400} ,
                                {
                                    // This is the right column
                                    alignment: 'right',
                                    text: ['page ', { text: page.toString() },  ' of ', { text: pages.toString() }],
                                    width:100

                                }
                            ],
                            margin: [50, 0,0,0]
                        }
                    });
                    
                }
            }
            ],
            serverSide: true,
            ajax: {
                url: applicationList,
                data: function (d) {
                    
                    d.academic_year = $('#academic_year').val(),
                    d.academic_grade = $('#academic_grade').val()
                }
            },
            "pageLength": 10,
            "aLengthMenu": [
                [5, 10, 25, 50, -1],
                [5, 10, 25, 50, "All"]
            ],
            columns: [
                {
                    searchable: false,
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                }
                ,
                {
                    data: 'register_number',
                    name: 'register_number'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'name_english',
                    name: 'name_english'
                },
                {
                    data: 'name_common',
                    name: 'name_common'
                },
                {
                    data: 'type',
                    name: 'type'
                },
                {
                    data: 'gender',
                    name: 'gender'
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'academic_year',
                    name: 'academic_year'
                },
                {
                    data: 'academic_grade',
                    name: 'academic_grade'
                },
                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'phase_2_status',
                    name: 'phase_2_status',
                },
                {
                    data: 'actions',
                    name: 'actions',
                    orderable: false,
                    searchable: false
                },
            ],
        });
    }

    
    // delete Application 
    $(document).on('click', '#deleteApplicationBtn', function () {
        var id = $(this).data('id');
        var url = applicationDelete;
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
                        $('#application-table').DataTable().ajax.reload(null, false);
                        toastr.success(data.message);
                    } else {
                        toastr.error(data.message);
                    }
                }, 'json');
            }
        });
    });

    
    // get application list
    $('#applicationFilter').on('submit', function (e) {
        e.preventDefault();
        var formData = {
            academic_year: $('#academic_year').val(),
            academic_grade: $('#academic_grade').val(),
        };
        setLocalStorageForApplicationList(formData);
        application(formData);
    });

    // Publish Event 
    $(document).on('click', '#approveApplicationBtn', function () {
        var id = $(this).data('id');
        if ($(this).prop('checked') == true) {
            var value = 1;
            var text = approveApplication;
            var confirmText = approveconfirmButtonText;
        } else {
            var value = 0;
            var text = unapproveApplication;
            var confirmText = unapproveconfirmButtonText;
        }
        swal.fire({
            title: deleteTitle + '?',
            html: text,
            showCancelButton: true,
            showCloseButton: true,
            cancelButtonText: deletecancelButtonText,
            confirmButtonText: confirmText,
            cancelButtonColor: '#d33',
            confirmButtonColor: '#556ee6',
            width: 400,
            allowOutsideClick: false
        }).then(function (result) {
            if (result.value) {
                $.post(applicationApprove, { id: id, status: value }, function (data) {
                    if (data.code == 200) {
                        $('#application-table').DataTable().ajax.reload(null, false);
                        toastr.success(data.message);
                    } else {
                        toastr.error(data.message);
                    }
                }, 'json');
            }
        });
    });

    
    
    $(document).on('click', '#viewApplicationBtn', function () {
        var id = $(this).data('id');
        $('.viewApplication').find('span.error-text').text('');
        $.post(applicationDetails, { id: id,token: token,branch_id: branchID }, function (data) {
            console.log('cc', data)
            var name = data.data.first_name + " " + data.data.last_name;
            $('.viewApplication').find('.name').text(name);
            $('.viewApplication').find('.gender').text(data.data.gender);
            $('.viewApplication').find('.academic_year').text(data.data.academic_year);
            $('.viewApplication').find('.academic_grade').text(data.data.academic_grade);
            $('.viewApplication').find('.date_of_birth').text(data.data.date_of_birth);
            $('.viewApplication').find('.mobile_no').text(data.data.mobile_no);
            $('.viewApplication').find('.email').text(data.data.email);
            $('.viewApplication').find('.address_1').text(data.data.address_1);
            $('.viewApplication').find('.address_2').text(data.data.address_2);
            $('.viewApplication').find('.country').text(data.data.country);
            $('.viewApplication').find('.state').text(data.data.state);
            $('.viewApplication').find('.city').text(data.data.city);
            $('.viewApplication').find('.postal_code').text(data.data.postal_code);

            $('.viewApplication').find('.school_year').text(data.data.school_year);
            $('.viewApplication').find('.grade').text(data.data.grade);
            $('.viewApplication').find('.school_last_attended').text(data.data.school_last_attended);
            $('.viewApplication').find('.school_address_1').text(data.data.school_address_1);
            $('.viewApplication').find('.school_address_2').text(data.data.school_address_2);
            $('.viewApplication').find('.school_country').text(data.data.school_country);
            $('.viewApplication').find('.school_city').text(data.data.school_city);
            $('.viewApplication').find('.school_state').text(data.data.school_state);
            $('.viewApplication').find('.school_postal_code').text(data.data.school_postal_code);
            
            var mother_name = data.data.mother_first_name + " " + data.data.mother_last_name;
            $('.viewApplication').find('.mother_name').text(mother_name);
            $('.viewApplication').find('.mother_email').text(data.data.mother_email);
            $('.viewApplication').find('.mother_occupation').text(data.data.mother_occupation);
            $('.viewApplication').find('.mother_phone_number').text(data.data.mother_phone_number);
            
            var father_name = data.data.father_first_name + " " + data.data.father_last_name;
            $('.viewApplication').find('.father_name').text(father_name);
            $('.viewApplication').find('.father_email').text(data.data.father_email);
            $('.viewApplication').find('.father_occupation').text(data.data.father_occupation);
            $('.viewApplication').find('.father_phone_number').text(data.data.father_phone_number);
            
            var guardian_name = data.data.guardian_first_name + " " + data.data.guardian_last_name;
            $('.viewApplication').find('.guardian_name').text(guardian_name);
            $('.viewApplication').find('.guardian_relation').text(data.data.guardian_relation);
            $('.viewApplication').find('.guardian_email').text(data.data.guardian_email);
            $('.viewApplication').find('.guardian_occupation').text(data.data.guardian_occupation);
            $('.viewApplication').find('.guardian_phone_number').text(data.data.guardian_phone_number);
            $('.viewApplication').modal('show');
        }, 'json');
    });

    $(document).ready(function(){

        $(".tabs").click(function(){
            
            $(".tabs").removeClass("active");
            $(".tabs h6").removeClass("font-weight-bold");    
            $(".tabs h6").addClass("text-muted");    
            $(this).children("h6").removeClass("text-muted");
            $(this).children("h6").addClass("font-weight-bold");
            $(this).addClass("active");
        
            current_fs = $(".active");
        
            next_fs = $(this).attr('id');
            next_fs = "#" + next_fs + "_tab";
        
            $("fieldset").removeClass("show");
            $(next_fs).addClass("show");
        
            current_fs.animate({}, {
                step: function() {
                    current_fs.css({
                        'display': 'none',
                        'position': 'relative'
                    });
                    next_fs.css({
                        'display': 'block'
                    });
                }
            });
        });
        
        });
        

    function setLocalStorageForApplicationList(classObj) {

        var applicationListDetails = new Object();
        applicationListDetails.academic_year = classObj.academic_year;
        applicationListDetails.academic_grade = classObj.academic_grade;
        // here to attached to avoid localStorage other users to add
        applicationListDetails.branch_id = branchID;
        applicationListDetails.role_id = get_roll_id;
        applicationListDetails.user_id = ref_user_id;
        var applicationListArr = [];
        applicationListArr.push(applicationListDetails);
        if (get_roll_id == "5") {
            // parent
            localStorage.removeItem("guest_application_list_details");
            localStorage.setItem('guest_application_list_details', JSON.stringify(applicationListArr));
        }
        return true;
    }
    // if localStorage
    if (typeof parent_application_list_storage !== 'undefined') {
        if ((parent_application_list_storage)) {
            if (parent_application_list_storage) {
                var adminApplicationListStorage = JSON.parse(parent_application_list_storage);
                if (adminApplicationListStorage.length == 1) {
                    var academicYear, academicGrade, userBranchID, userRoleID, userID;
                    adminApplicationListStorage.forEach(function (user) {
                        academicYear = user.academic_year;
                        academicGrade = user.academic_grade;
                        userBranchID = user.branch_id;
                        userRoleID = user.role_id;
                        userID = user.user_id;
                    });
                    if ((userBranchID == branchID) && (userRoleID == get_roll_id) && (userID == ref_user_id)) {
                        
                        $("#academic_year").val(academicYear);
                        $('#academic_grade').val(academicGrade);
                        var formData = {
                            academic_year: academicYear,
                            academic_grade: academicGrade,
                        };
                        application(formData);
                    }
                }
            }
        }
    }

});