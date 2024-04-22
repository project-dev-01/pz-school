$(function () {

    // $('#dual_nationality_container').hide();
    var formData = {
        student_name: null,
        class_id: null,
        section_id: null,
        status: "0",
        academic_year: academic_session_id
    };
    if (studentList !== undefined && studentList !== null) {
        getStudentList(formData);
    }


    // rules validation

    // get student list
    $('#StudentFilter').on('submit', function (e) {
        e.preventDefault();
        // var StudentFilter = $("#StudentFilter").valid();
        // if (StudentFilter === true) {
        // var academic_year = $('#academic_year').val();
        var student_name = $('#student_name').val();
        var department_id_filter = $('#department_id_filter').val();
        var class_id = $('#class_id').val();
        var section_id = $('#section_id').val();
        var session_id = $('#session_id').val();
        var status = $('#student_status').val();

        var classObj = {
            student_name: student_name,
            department_id: department_id_filter,
            classID: class_id,
            sectionID: section_id,
            sessionID: session_id,
            userID: userID,
            status: status,
            // academic_year:academic_year
        };
        // setLocalStorageForStudentList(classObj);

        var formData = {
            status: status,
            student_name: student_name,
            department_id: department_id_filter,
            class_id: class_id,
            section_id: section_id,
            session_id: session_id,
            // academic_year:academic_year
        };
        getStudentList(formData);
        // } else {
        //     $("#student").hide("slow");
        // }

    });
    function getStudentList(formData) {
        $("#student").show("slow");
        // set download filter value
        $('#excelStudentName').val(formData.student_name);
        $('#excelClassID').val(formData.class_id);
        $('#excelSectionID').val(formData.section_id);
        $('#excelStatus').val(formData.status);
        var table = $('#student-table').DataTable({
            processing: true,
            info: true,
            bDestroy: true,
            dom: "<'row'<'col-sm-2 col-md-2'l><'col-sm-4 col-md-4'B><'col-sm-6 col-md-6'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-6'i><'col-sm-6'p>>",
            buttons: [],
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
            // exportOptions: { rows: ':visible' },
            ajax: {
                url: studentList,
                data: function (d) {
                    Object.assign(d, formData);
                }
            },
            pageLength: 10,
            lengthMenu: [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false },
                { data: 'name', name: 'name' },
                { data: 'register_no', name: 'register_no' },
                { data: 'roll_no', name: 'roll_no' },
                { data: 'gender', name: 'gender' },
                { data: 'email', name: 'email' },
                { data: 'actions', name: 'actions', orderable: false, searchable: false }
            ],
            columnDefs: [
                {
                    targets: 1,
                    className: 'table-user',
                    render: function (data, type, row, meta) {
                        var currentImg = studentImg + row.photo;
                        var img = (row.photo != null) ? currentImg : defaultImg;
                        return '<img src="' + img + '" class="mr-2 rounded-circle">' +
                            '<a href="javascript:void(0);" class="text-body font-weight-semibold">' + data + '</a>';
                    }
                }
            ]
        });

    }

    $("#class_id").on('change', function (e) {
        e.preventDefault();
        var class_id = $(this).val();
        $("#section_id").empty();
        $("#section_id").append('<option value="">' + select_class + '</option>');
        $.post(sectionByClass, { class_id: class_id }, function (res) {
            if (res.code == 200) {
                $.each(res.data, function (key, val) {
                    $("#section_id").append('<option value="' + val.section_id + '">' + val.section_name + '</option>');
                });
            }
        }, 'json');
    });

    $("#editadmission").validate({
        rules: {
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
            // categy: "required",
            fname: "required",
            txt_mobile_no: "required",
            school_enrollment_status_tendency: "required",
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
            // japanese_association_membership_image_principal:"required",
            txt_prev_schname: "required",
            school_country: "required",
            school_state: "required",
            school_city: "required",
            school_postal_code: "required",
            school_enrollment_status: "required",
            father_last_name: "required",
            father_first_name: "required",
            father_last_name_furigana: "required",
            father_first_name_furigana: "required",
            father_last_name_english: "required",
            father_first_name_english: "required",
            father_nationality: "required",
            father_email: "required",
            father_mobile_no: "required",
            father_occupation: "required",
            mother_last_name: "required",
            mother_first_name: "required",
            mother_last_name_furigana: "required",
            mother_first_name_furigana: "required",
            mother_last_name_english: "required",
            mother_first_name_english: "required",
            mother_nationality: "required",
            mother_email: "required",
            mother_mobile_no: "required",
            mother_occupation: "required",

            "passport_photo": {
                required: function (element) {
                    if ($("#passport_old_photo").val() == null) {
                        return true;
                    } else {
                        return false;
                    }
                }
            },
            "visa_photo": {
                required: function (element) {
                    if ($("#visa_old_photo").val() == null) {
                        return true;
                    } else {
                        return false;
                    }
                }
            },
            "japanese_association_membership_image_principal": {
                required: function (element) {
                    if ($("#japanese_association_membership_image_principal_old").val() == null) {
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

    $('#editadmission').on('submit', function (e) {
        e.preventDefault();
        var admissionCheck = $("#editadmission").valid();
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
                        window.location.href = indexStudent;
                    } else {
                        toastr.error(data.message);
                    }
                }
            });
        }
    });
});
