$(function () {

    $("#passport_expiry_date").datepicker({
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
        autoclose: true,
        yearRange: "-3:+6", // last hundred years
    });

    $("#visa_expiry_date").datepicker({
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
        autoclose: true,
        yearRange: "-3:+6", // last hundred years
    });

    if ($('#skip_prev_school_details').is(":checked")) {
            
        $(".prev_school_form").val("");
        $("#prev_school_details").hide("slow");
    } else {
        $("#prev_school_details").show("slow");
    }

    // skip_prev_school_details
    $("#skip_prev_school_details").on("change", function () {
        
        if ($(this).is(":checked")) {
            
            $(".prev_school_form").val("");
            $("#prev_school_details").hide("slow");
        } else {
            $("#prev_school_details").show("slow");
        }
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
    $('#nric_photo').change(function() {
        // var i = $(this).prev('label').clone();
        var file = $('#nric_photo')[0].files[0];
        if(file.size > 2097152) {
            $('#nric_photo_name').text("File greater than 2Mb");
            $("#nric_photo_name").addClass("error");
            $('#nric_photo').val('');
        } else {
            $("#nric_photo_name").removeClass("error");
            $('#nric_photo_name').text(file.name);
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
    $("#visa_type_others_show").hide();

    // Listen for changes in the visa_type dropdown
    $("#visa_type").change(function() {
        // If the selected value is "Others", show the additional input field, otherwise hide it
        if ($(this).val() === "Others") {
            $("#visa_type_others_show").show();
        } else {
            $("#visa_type_others_show").hide();
        }
    });
    
    $(document).on('click', ".remand", function () {
        var name = $(this).attr("remand");
        console.log("name",name)
        $("#"+name+"_view").show();
    });
    
    $(document).on('click', ".remove", function () {
        var name = $(this).attr("remand");
        $("#"+name+"_view").hide();
    });

    $('#student-update-table').DataTable({
        processing: true,
        info: true,
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
                },
                enabled: false // Initially disable CSV button
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
                enabled: false, // Initially disable PDF button
            
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
        initComplete: function () {
            var table = this;
            $.ajax({
                url: studentUpdateList,
                success: function(data) {
                    console.log(data.data.length);
                    if (data && data.data.length > 0) {
                        console.log('ok');
                        $('#student-update-table_wrapper .buttons-csv').removeClass('disabled');
                        $('#student-update-table_wrapper .buttons-pdf').removeClass('disabled');  // Enable all buttons if at least one record exists
                    } else {
                        console.log(data);
                        $('#student-update-table_wrapper .buttons-csv').addClass('disabled');
                        $('#student-update-table_wrapper .buttons-pdf').addClass('disabled');               
                    }
                },
                error: function() {
                    console.log('error');
                    // Handle error if necessary
                }
            });
        },
        ajax: studentUpdateList,
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
                data: 'name',
                name: 'name'
            },
            {
                data: 'roll_no',
                name: 'roll_no'
            },
            {
                data: 'email',
                name: 'email'
            },
            {
                data: 'status',
                name: 'status',
                orderable: false,
                searchable: false
            },
            {
                data: 'actions',
                name: 'actions',
                orderable: false,
                searchable: false
            },
        ],
        columnDefs: [
            {
                "targets": 1,
                "className": "table-user",
                "render": function (data, type, row, meta) {

                    // if ((row.photo != null) || (row.photo != "")) {
                    if (row.photo) {
                        var currentImg = parentImg + '/' + row.photo;
                    } else {
                        var currentImg = defaultImg;
                    }
                    var img = currentImg;
                    var first_name = '<img src="' + img + '" class="mr-2 rounded-circle" alt="No Image">' +
                        '<a href="javascript:void(0);" class="text-body font-weight-semibold">' + data + '</a>';
                    return first_name;
                }
            }
        ]
    }).on('draw', function () {
    });
    $(".number_validation").keypress(function () {
        var regex = new RegExp("^[0-9-+]");
        var key = String.fromCharCode(event.charCode ? event.which : event.charCode);
        if (!regex.test(key)) {
            event.preventDefault();
            return false;
        }
    });
    $("#student").hide();
    var father_id = $("#father_id").val();
    if (father_id) {
        father(father_id);
    }

    var mother_id = $("#mother_id").val();
    if (mother_id) {
        mother(mother_id);
    }

    var guardian_id = $("#guardian_id").val();
    if (guardian_id) {
        guardian(guardian_id);
    }

    $("#admission_date").datepicker({
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
        autoclose: true,
        yearRange: "-3:+6", // last hundred years
    });
    $("#dob").datepicker({
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
        autoclose: true,
        yearRange: "-60:+1", // last hundred years
        maxDate: 0
    });

    $('#guardian_name').keyup(function () {
        var name = $(this).val();
        if (name != '') {
            $.ajax({
                url: parentName,
                method: "GET",
                data: { token: token, branch_id: branchID, name: name },
                success: function (data) {
                    $('#guardian_list').fadeIn();
                    $('#guardian_list').html(data);
                }
            });
        }
    });

    $('#guardian_list').on('click', 'li', function () {

        $('#guardian_name').val($(this).text());
        $('#guardian_list').fadeOut();
        var value = $(this).text();
        if (value == "No results Found") {
            $('#guardian_name').val("");
            $("#guardian_form").hide("slow");
            $("#guardian_photo").hide();

        } else {
            var id = $(this).val();
            guardian(id);
        }
    });

    function guardian(id) {
        $('#guardian_id').val(id);
        $("#guardian_form").show("slow");
        $("#guardian_info").show();
        $("#guardian_photo").show();
        $.post(parentDetails, { token: token, branch_id: branchID, id: id }, function (res) {
            if (res.code == 200) {
                var data = res.data.parent;
                if (data.photo) {
                    var src = parentImg + "/" + data.photo;
                } else {
                    var src = defaultImg;
                }
                var name = data.first_name + " " + data.last_name;
                $('#guardian_name').val(name);
                $("#guardian_photo").html('<img src="' + src + '" class="img-fluid d-block rounded" style="width:100px" />');
                $("#guardian_first_name").val(data.first_name);
                $("#guardian_last_name").val(data.last_name);
                $("#guardian_email").val(data.email);
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

                $(".guardian_name").html(name);
                $(".guardian_date_of_birth").html(data.date_of_birth);
                $(".guardian_email").html(data.email);
                $(".guardian_passport").html(data.passport);
                $(".guardian_country").html(data.country);
                $(".guardian_post_code").html(data.post_code);
                $(".guardian_address_2").html(data.address_2);
                $(".guardian_nric").html(data.nric);
                $(".guardian_occupation").html(data.occupation);
                $(".guardian_income").html(data.income);
                $(".guardian_blood_group").html(data.blood_group);
                $(".guardian_education").html(data.education);
                $(".guardian_mobile_no").html(data.mobile_no);
                $(".guardian_state").html(data.state);
                $(".guardian_city").html(data.city);
                $(".guardian_address").html(data.address);
            }
        }, 'json');
    }
    $("#txt_passport, #japanese_association_membership_number_student").on("input", function() {
        var regexp = /^[A-Za-z0-9]+$/;
        if (!regexp.test($(this).val())) {
            $(this).val($(this).val().replace(/[^\w]/gi, ''));
        }
    });
    $(document).ready(function () {
        $("#drp_post_code").change(function () {
            var postalCode = $('#drp_post_code').val();
            var country = $('#drp_country').val();
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
                        $('#drp_city').val(city);
                        $('#drp_state').val(state);
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
    $('#has_dual_nationality_checkbox').change(function() {
        if(this.checked) {
            $('#dual_nationality_container').show();
        } else {
            $('#dual_nationality_container').hide();
        }
    });
    $("#updateStudentProfile").validate({
        rules: {
           
            fname: "required",
            txt_mobile_no: "required",
            school_enrollment_status_tendency:"required",
            // categy: "required",
            fname: "required",
            first_name_english: "required",
            first_name_furigana: "required",
            // txt_mobile_no: "required",
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
            txt_passport: "required",
            passport_expiry_date: "required",
            visa_type_others: "required",
            visa_expiry_date: "required",
            visa_photo: "required",
            visa_type: "required",
            japanese_association_membership_number_student: "required",
            txt_prev_schname: "required",
            school_country: "required",
            school_state: "required",
            school_city: "required",
            school_postal_code: "required",
            school_enrollment_status: "required",
          

            "passport_photo": {
                required: function (element) {
                    if ($("#passport_old_photo").val().length < 1) {
                        return true;
                    } else {
                        return false;
                    }
                }
            },

            "visa_photo": {
                required: function (element) {
                    if ($("#visa_old_photo").val().length < 1) {
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
            // txt_pwd: {
            //     minlength: 6
            // },
            // txt_retype_pwd: {
            //     minlength: 6,
            //     equalTo: "txt_pwd"
            // },  
            password: {
                // required: $("#password").val().length > 0,
                minlength: 6
            },
            confirm_password: {
                // required: $("#confirm_password").val().length > 0,
                minlength: 6,
                equalTo: "#password"
            }
        }
    });
    
    $('#updateStudentProfile').on('submit', function (e) {
        e.preventDefault();
        var studentProfilecheck = $("#updateStudentProfile").valid();
        if (studentProfilecheck === true) {
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
                    } else {
                        toastr.error(data.message);
                    }
                }
            });
        }
    });
    
    
    
    $('#updateStudentInfo').on('submit', function (e) {
        e.preventDefault();
        console.log('123')
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
                        window.location.href = studentUpdateMenu;
                    } else {
                        toastr.error(data.message);
                    }
                }
            });
    });

});
