$(function () {

    var formData = {
        student_name: null,
        department_id: null,
        class_id: null,
        section_id: null,
        session_id: null
    };
    getStudentList(formData);

    $("#department_id").on('change', function (e) {
        e.preventDefault();
        var Selector = '#editadmission';
        var department_id = $(this).val();
        var classID = "";
        classAllocation(department_id, Selector, classID);
    });
    $("#department_id_filter").on('change', function (e) {
        e.preventDefault();
        var Selector = '#StudentFilter';
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
    $(".number_validation").keypress(function () {
        var regex = new RegExp("^[0-9-+]");
        var key = String.fromCharCode(event.charCode ? event.which : event.charCode);
        if (!regex.test(key)) {
            event.preventDefault();
            return false;
        }
    });
    // $("#student").hide();
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

    $('#passport_photo').change(function () {
        // var i = $(this).prev('label').clone();
        var file = $('#passport_photo')[0].files[0];
        if (file.size > 2097152) {
            $('#passport_photo_name').text("File greater than 2Mb");
            $("#passport_photo_name").addClass("error");
            $('#passport_photo').val('');
        } else {
            $("#passport_photo_name").removeClass("error");
            $('#passport_photo_name').text(file.name);
        }
    });

    $('#visa_photo').change(function () {
        // var i = $(this).prev('label').clone();
        var file = $('#visa_photo')[0].files[0];
        if (file.size > 2097152) {
            $('#visa_photo_name').text("File greater than 2Mb");
            $("#visa_photo_name").addClass("error");
            $('#visa_photo').val('');
        } else {
            $("#visa_photo_name").removeClass("error");
            $('#visa_photo_name').text(file.name);
        }
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
    $('#father_name').keyup(function () {
        var name = $(this).val();
        if (name != '') {
            $.ajax({
                url: parentName,
                method: "GET",
                data: { token: token, branch_id: branchID, name: name },
                success: function (data) {
                    $('#father_list').fadeIn();
                    $('#father_list').html(data);
                }
            });
        }
    });

    $('#father_list').on('click', 'li', function () {

        $('#father_name').val($(this).text());
        $('#father_list').fadeOut();
        var value = $(this).text();
        if (value == "No results Found") {
            $('#father_name').val("");
            $("#father_form").hide("slow");
            $("#father_photo").hide();

        } else {
            var id = $(this).val();
            father(id);
        }
    });

    function father(id) {
        $('#father_id').val(id);
        $("#father_form").show("slow");
        $("#father_info").show();
        $("#father_photo").show();
        $.post(parentDetails, { token: token, branch_id: branchID, id: id }, function (res) {
            if (res.code == 200) {
                var data = res.data.parent;
                if (data.photo) {
                    var src = parentImg + "/" + data.photo;
                } else {
                    var src = defaultImg;
                }
                var name = data.first_name + " " + data.last_name;
                $('#father_name').val(name);
                $("#father_photo").html('<img src="' + src + '" class="img-fluid d-block rounded" style="width:100px" />');
                $("#father_first_name").val(data.first_name);
                $("#father_last_name").val(data.last_name);
                $("#father_email").val(data.email);
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



                $(".father_name").html(name);
                $(".father_date_of_birth").html(data.date_of_birth);
                $(".father_email").html(data.email);
                $(".father_passport").html(data.passport);
                $(".father_country").html(data.country);
                $(".father_post_code").html(data.post_code);
                $(".father_address_2").html(data.address_2);
                $(".father_nric").html(data.nric);
                $(".father_occupation").html(data.occupation);
                $(".father_income").html(data.income);
                $(".father_blood_group").html(data.blood_group);
                $(".father_education").html(data.education);
                $(".father_mobile_no").html(data.mobile_no);
                $(".father_state").html(data.state);
                $(".father_city").html(data.city);
                $(".father_address").html(data.address);
            }
        }, 'json');
    }

    $('#mother_name').keyup(function () {
        var name = $(this).val();
        if (name != '') {
            $.ajax({
                url: parentName,
                method: "GET",
                data: { token: token, branch_id: branchID, name: name },
                success: function (data) {
                    $('#mother_list').fadeIn();
                    $('#mother_list').html(data);
                }
            });
        }
    });

    $('#mother_list').on('click', 'li', function () {

        $('#mother_name').val($(this).text());
        $('#mother_list').fadeOut();
        var value = $(this).text();
        if (value == "No results Found") {
            $('#mother_name').val("");
            $("#mother_form").hide("slow");
            $("#mother_photo").hide();

        } else {
            var id = $(this).val();
            mother(id);
        }
    });

    function mother(id) {
        $('#mother_id').val(id);
        $("#mother_form").show("slow");
        $("#mother_photo").show();
        $("#mother_info").show();
        $.post(parentDetails, { token: token, branch_id: branchID, id: id }, function (res) {
            if (res.code == 200) {
                var data = res.data.parent;
                if (data.photo) {
                    var src = parentImg + "/" + data.photo;
                } else {
                    var src = defaultImg;
                }
                var name = data.first_name + " " + data.last_name;
                $('#mother_name').val(name);
                $("#mother_photo").html('<img src="' + src + '" class="img-fluid d-block rounded" style="width:100px" />');
                $("#mother_first_name").val(data.first_name);
                $("#mother_last_name").val(data.last_name);
                $("#mother_email").val(data.email);
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

                $(".mother_name").html(name);
                $(".mother_date_of_birth").html(data.date_of_birth);
                $(".mother_email").html(data.email);
                $(".mother_passport").html(data.passport);
                $(".mother_country").html(data.country);
                $(".mother_post_code").html(data.post_code);
                $(".mother_address_2").html(data.address_2);
                $(".mother_nric").html(data.nric);
                $(".mother_occupation").html(data.occupation);
                $(".mother_income").html(data.income);
                $(".mother_blood_group").html(data.blood_group);
                $(".mother_education").html(data.education);
                $(".mother_mobile_no").html(data.mobile_no);
                $(".mother_state").html(data.state);
                $(".mother_city").html(data.city);
                $(".mother_address").html(data.address);
            }
        }, 'json');
    }
    // rules validation

    // get student list
    $('#StudentFilter').on('submit', function (e) {
        e.preventDefault();
        // var StudentFilter = $("#StudentFilter").valid();
        // if (StudentFilter === true) {
        var student_name = $('#student_name').val();
        var department_id_filter = $('#department_id_filter').val();
        var class_id = $('#class_id').val();
        var section_id = $('#section_id').val();
        var session_id = $('#session_id').val();

        var classObj = {
            student_name: student_name,
            department_id: department_id_filter,
            classID: class_id,
            sectionID: section_id,
            sessionID: session_id,
            userID: userID,
        };
        // setLocalStorageForStudentList(classObj);

        var formData = {
            student_name: student_name,
            department_id: department_id_filter,
            class_id: class_id,
            section_id: section_id,
            session_id: session_id,
        };
        getStudentList(formData);
        // } else {
        //     $("#student").hide("slow");
        // }

    });
    $('#StudentSettingFilter').on('submit', function (e) {
        e.preventDefault();
        var formData = {
            studentDetails: document.getElementById('checkboxStudentDetails').checked,
            parentDetails: document.getElementById('checkboxParentDetails').checked,
            // schoolDetails: document.getElementById('checkboxSchoolDetails').checked,
            academicDetails: document.getElementById('checkboxAcademic').checked,
            gradeAndClasses: document.getElementById('checkboxGrade').checked,
            gardeClassAcademic: $('#gardeClassAcademic').val(),
            attendance: document.getElementById('checkboxAttendance').checked,
            attendanceAcademic: $('#attendanceAcademic').val(),
            testResult: document.getElementById('checkboxTestResult').checked,
            testResultAcademic: $('#testResultAcademic').val()
            // Add similar lines for other checkboxes as needed
            // Add data for dropdowns if needed
        };
        console.log(formData);
        // Send the data to the server using AJAX
        $.ajax({
            type: 'POST',
            url: studentSettings, // Replace with your Laravel route
            data: formData,
            success: function (response) {
                // Handle success, if needed
                // console.log('Data saved successfully:', response);
                // swal.fire("Success", "Your data has been saved.", "success");
                if (response.code == 200) {
                    toastr.success(response.message);
                    // window.location.href = indexStudent;
                } else {
                    toastr.error(response.message);
                }
            },
            error: function (error) {
                // Handle errors, if needed
                // console.error('Error saving data:', error);
                // swal.fire("Error", "There was an error saving your data.", "error");
                toastr.error(error.message);
            }
        });

    });

    function getStudentList(formData) {
        $("#student").show("slow");
        // set download filter value
        $('#excelStudentName').val(formData.student_name);
        $('#excelDepartment').val(formData.department_id);
        $('#excelClassID').val(formData.class_id);
        $('#excelSectionID').val(formData.section_id);
        $('#excelSession').val(formData.session_id);
        var table = $('#student-table').DataTable({
            processing: true,
            info: true,
            bDestroy: true,
            // dom: 'lBfrtip',
            dom: 'Blfrtip',

            // dom: "<'row'<'col-sm-2 col-md-2'l><'col-sm-6 col-md-6'B><'col-sm-4 col-md-4'f>>" +
            //     "<'row'<'col-sm-12'tr>>" +
            //     "<'row'<'col-sm-6'i><'col-sm-6'p>>",
            // dom: 'C&gt;"clear"&lt;lfrtip',
            // "language": {

            //     "emptyTable": no_data_available,
            //     "infoFiltered": filter_from_total_entries,
            //     "zeroRecords": no_matching_records_found,
            //     "infoEmpty": showing_zero_entries,
            //     "info": showing_entries,
            //     "lengthMenu": show_entries,
            //     "search": datatable_search,
            //     "paginate": {
            //         "next": next,
            //         "previous": previous
            //     },
            // },
            // exportOptions: { rows: ':visible' },
            serverSide: true,
            ajax: {
                url: studentList,
                data: function (d) {
                    d.student_name = formData.student_name,
                        d.class_id = formData.class_id,
                        d.section_id = formData.section_id,
                        d.session_id = formData.session_id
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
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'register_no',
                    name: 'register_no'
                },
                {
                    data: 'roll_no',
                    name: 'roll_no'
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
                        var currentImg = studentImg + row.photo;
                        // var existUrl = UrlExists(currentImg);
                        // console.log(currentImg);
                        var img = (row.photo != null) ? currentImg : defaultImg;
                        var first_name = '<img src="' + img + '" class="mr-2 rounded-circle">' +
                            '<a href="javascript:void(0);" class="text-body font-weight-semibold">' + data + '</a>';
                        return first_name;
                    }
                },
            ]
        });
    }

    // function setLocalStorageForStudentList(classObj) {

    //     var studentListDetails = new Object();
    //     studentListDetails.class_id = classObj.classID;
    //     studentListDetails.section_id = classObj.sectionID;
    //     studentListDetails.student_name = classObj.student_name;
    //     studentListDetails.session_id = classObj.sessionID;
    //     // here to attached to avoid localStorage other users to add
    //     studentListDetails.branch_id = branchID;
    //     studentListDetails.role_id = get_roll_id;
    //     studentListDetails.user_id = ref_user_id;
    //     var studentListClassArr = [];
    //     studentListClassArr.push(studentListDetails);
    //     if (get_roll_id == "2") {
    //         // admin
    //         localStorage.removeItem("admin_student_list_details");
    //         localStorage.setItem('admin_student_list_details', JSON.stringify(studentListClassArr));
    //     }
    //     if (get_roll_id == "4") {
    //         // teacher
    //         localStorage.removeItem("teacher_student_list_details");
    //         localStorage.setItem('teacher_student_list_details', JSON.stringify(studentListClassArr));
    //     }
    //     return true;
    // }
    // // if localStorage
    // if (typeof student_list_storage !== 'undefined') {
    //     if ((student_list_storage)) {
    //         if (student_list_storage) {
    //             var studentListStorage = JSON.parse(student_list_storage);
    //             if (studentListStorage.length == 1) {
    //                 var classID, student_name, sectionID, sessionID, userBranchID, userRoleID, userID;
    //                 studentListStorage.forEach(function (user) {
    //                     classID = user.class_id;
    //                     student_name = user.student_name;
    //                     sectionID = user.section_id;
    //                     sessionID = user.session_id;
    //                     userBranchID = user.branch_id;
    //                     userRoleID = user.role_id;
    //                     userID = user.user_id;
    //                 });
    //                 if ((userBranchID == branchID) && (userRoleID == get_roll_id) && (userID == ref_user_id)) {
    //                     $('#class_id').val(classID);
    //                     $("#student_name").val(student_name);
    //                     $('#session_id').val(sessionID);
    //                     if (classID) {
    //                         $("#section_id").empty();
    //                         $("#section_id").append('<option value="">' + select_class + '</option>');
    //                         $.post(sectionByClass, { class_id: classID }, function (res) {
    //                             if (res.code == 200) {
    //                                 $.each(res.data, function (key, val) {
    //                                     $("#section_id").append('<option value="' + val.section_id + '">' + val.section_name + '</option>');
    //                                 });
    //                                 $("#section_id").val(classID);
    //                             }
    //                         }, 'json');
    //                     }


    //                     var formData = {
    //                         student_name: student_name,
    //                         class_id: classID,
    //                         section_id: sectionID,
    //                         session_id: sessionID,
    //                     };
    //                     getStudentList(formData);
    //                 }
    //             }
    //         }
    //     }
    // }
    // var student_name = $('#student_name').val();
    //     var department_id_filter = $('#department_id_filter').val();
    //     var class_id = $('#class_id').val();
    //     var section_id = $('#section_id').val();
    //     var session_id = $('#session_id').val();

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
            session_id: "required",
            year: "required",
            txt_regiter_no: "required",
            txt_emailid: {
                required: true,
                email: true
            },
            txt_roll_no: "required",
            admission_date: "required",
            classnames: "required",
            department_id: "required",
            class_id: "required",
            section_id: "required",
            // categy: "required",
            fname: "required",
            txt_mobile_no: "required",
            present_address: "required",
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

    // delete Student 
    $(document).on('click', '#deleteStudentBtn', function () {
        var id = $(this).data('id');
        var url = studentDelete;
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
                        $("#student").show("slow");
                        $('#student-table').DataTable().ajax.reload(null, false);
                        toastr.success(data.message);
                    } else {
                        $("#student").hide("slow");
                        toastr.error(data.message);
                    }
                }, 'json');
            }
        });
    });

    $("#drp_transport_route").on('change', function (e) {
        e.preventDefault();
        var route_id = $(this).val();
        $("#drp_transport_vechicleno").empty();
        $("#drp_transport_vechicleno").append('<option value="">' + select_vehicle_number + '</option>');
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
        $("#drp_roomname").append('<option value="">' + select_room_name + '</option>');
        $.post(roomByHostel, { hostel_id: hostel_id }, function (res) {
            if (res.code == 200) {
                $.each(res.data, function (key, val) {
                    $("#drp_roomname").append('<option value="' + val.room_id + '">' + val.room_name + '</option>');
                });
            }
        }, 'json');
    });


    // function getStudentList(formData){
    //     $("#student").show("slow");

    //     $('#student-table').DataTable({
    //         processing: true,
    //         info: true,
    //         bDestroy: true,
    //         // dom: 'lBfrtip',
    //         dom: "<'row'<'col-sm-2 col-md-2'l><'col-sm-4 col-md-4'B><'col-sm-6 col-md-6'f>>" +
    //             "<'row'<'col-sm-12'tr>>" +
    //             "<'row'<'col-sm-6'i><'col-sm-6'p>>",
    //         "language": {

    //             "emptyTable": no_data_available,
    //             "infoFiltered": filter_from_total_entries,
    //             "zeroRecords": no_matching_records_found,
    //             "infoEmpty": showing_zero_entries,
    //             "info": showing_entries,
    //             "lengthMenu": show_entries,
    //             "search": datatable_search,
    //             "paginate": {
    //                 "next": next,
    //                 "previous": previous
    //             },
    //         },
    //         buttons: [
    //             {
    //                 extend: 'csv',
    //                 text: downloadcsv,
    //                 extension: '.csv',
    //                 charset: 'utf-8',
    //                 bom: true,
    //                 exportOptions: {
    //                     columns: 'th:not(:last-child)'
    //                 }
    //             },
    //             {
    //                 extend: 'pdf',
    //                 text: downloadpdf,
    //                 extension: '.pdf',
    //                 charset: 'utf-8',
    //                 bom: true,
    //                 exportOptions: {
    //                     columns: 'th:not(:last-child)'
    //                 },


    //                 customize: function (doc) {
    //                 doc.pageMargins = [50,50,50,50];
    //                 doc.defaultStyle.fontSize = 10;
    //                 doc.styles.tableHeader.fontSize = 12;
    //                 doc.styles.title.fontSize = 14;
    //                 // Remove spaces around page title
    //                 doc.content[0].text = doc.content[0].text.trim();
    //                 /*// Create a Header
    //                 doc['header']=(function(page, pages) {
    //                     return {
    //                         columns: [

    //                             {
    //                                 // This is the right column
    //                                 bold: true,
    //                                 fontSize: 20,
    //                                 color: 'Blue',
    //                                 fillColor: '#fff',
    //                                 alignment: 'center',
    //                                 text: header_txt
    //                             }
    //                         ],
    //                         margin:  [50, 15,0,0]
    //                     }
    //                 });*/
    //                 // Create a footer

    //                 doc['footer']=(function(page, pages) {
    //                     return {
    //                         columns: [
    //                             { alignment: 'left', text: [ footer_txt ],width:400} ,
    //                             {
    //                                 // This is the right column
    //                                 alignment: 'right',
    //                                 text: ['page ', { text: page.toString() },  ' of ', { text: pages.toString() }],
    //                                 width:100

    //                             }
    //                         ],
    //                         margin: [50, 0,0,0]
    //                     }
    //                 });

    //             }
    //         }
    //         ],
    //         serverSide: true,
    //         ajax: {
    //             url: studentList,
    //             data: function (d) {
    //                 d.student_name = formData.student_name,
    //                     d.class_id = formData.class_id,
    //                     d.section_id = formData.section_id,
    //                     d.session_id = formData.session_id
    //             }
    //         },
    //         "pageLength": 10,
    //         "aLengthMenu": [
    //             [5, 10, 25, 50, -1],
    //             [5, 10, 25, 50, "All"]
    //         ],
    //         columns: [
    //             {
    //                 searchable: false,
    //                 data: 'DT_RowIndex',
    //                 name: 'DT_RowIndex'
    //             }
    //             ,
    //             {
    //                 data: 'name',
    //                 name: 'name'
    //             },
    //             {
    //                 data: 'register_no',
    //                 name: 'register_no'
    //             },
    //             {
    //                 data: 'roll_no',
    //                 name: 'roll_no'
    //             },
    //             {
    //                 data: 'gender',
    //                 name: 'gender'
    //             },
    //             {
    //                 data: 'email',
    //                 name: 'email'
    //             },
    //             {
    //                 data: 'actions',
    //                 name: 'actions',
    //                 orderable: false,
    //                 searchable: false
    //             },
    //         ],
    //         columnDefs: [
    //             {
    //                 "targets": 1,
    //                 "className": "table-user",
    //                 "render": function (data, type, row, meta) {
    //                     var currentImg = studentImg + row.photo;
    //                     // var existUrl = UrlExists(currentImg);
    //                     // console.log(currentImg);
    //                     var img = (row.photo != null) ? currentImg : defaultImg;
    //                     var first_name = '<img src="' + img + '" class="mr-2 rounded-circle">' +
    //                         '<a href="javascript:void(0);" class="text-body font-weight-semibold">' + data + '</a>';
    //                     return first_name;
    //                 }
    //             },
    //         ]
    //     });
    // }
});
