$(function () {

    $("#department_id").on('change', function (e) {
        e.preventDefault();
        var Selector = '#examTimetableFilter';
        var department_id = $(this).val();
        var classID = "";
        classAllocation(department_id, Selector, classID);
    });
    $("#add_department_id").on('change', function (e) {
        e.preventDefault();
        var Selector = '#addScheduleFilter';
        var department_id = $(this).val();
        var classID = "";
        classAllocation(department_id, Selector, classID);
    });
    function classAllocation(department_id, Selector, classID) {
        $(Selector).find('select[name="class_id"]').empty();
        $(Selector).find('select[name="class_id"]').append('<option value="">' + select_grade + '</option>');
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

    $("#class_id").on('change', function (e) {
        e.preventDefault();
        var class_id = $(this).val();
        console.log("select box", class_id)

        $("#section_id").empty();
        $("#section_id").append('<option value="">'+select_class+'</option>');
        $.post(sectionByClass, { class_id: class_id }, function (res) {
            if (res.code == 200) {
                $.each(res.data, function (key, val) {
                    $("#section_id").append('<option value="' + val.section_id + '">' + val.section_name + '</option>');
                });
            }
        }, 'json');
    });

    $(document).on('change', '.distributor_type', function (e) {
        e.preventDefault();


        var dist = "";
        var distributor_type = $(this).val();

        var id = $(this).data('id');
        var distributor = $(this).closest('td').find('.distributor');
        var class_id = $("#class_id").val();
        var section_id = $("#section_id").val();

        distributor.empty();

        if (distributor_type == "1") {

            distributor.append('<select  class="form-control" name="exam[' + id + '][distributor]">');

            $.post(getTeacherList, {
                token: token,
                branch_id: branchID,
                class_id: class_id,
                section_id: section_id,
                academic_session_id: academic_session_id
            }, function (res) {
                if (res.code == 200) {

                    $.each(res.data, function (key, val) {
                        distributor.find('select').append('<option value="' + val.id + '">' + val.name + '</option>');
                    });

                }

            }, 'json');

            distributor.append('</select>');
        } else {
            var dist = '<input type="text" name="exam[' + id + '][distributor]" class="form-control"   placeholder="Distributor Name">';
            distributor.append(dist);
        }

    });

    $('.examTimeTable').on('shown.bs.modal', e => {
        var $button = $(e.relatedTarget);
        var exam_id = $button.attr('data-exam_id');
        var class_id = $("#class_id").val();
        var section_id = $("#section_id").val();
        var semester_id = $("#semester_id").val();
        var session_id = $("#session_id").val();
        // return false;
        $.post(viewExamTimetable, {
            exam_id: exam_id, class_id: class_id, section_id: section_id,
            semester_id: semester_id, session_id: session_id
        }, function (res) {
            if (res.code == 200) {
                var exam_name = exam_lang + res.data.details.exam_name;
                var class_section = grade_lang + res.class_section;
                $("#class-section").html(class_section);
                $("#exam").html(exam_name);
                $("#exam-timetable").html(res.table);
                // set value
                $("#downloadExcel").find("#exam_name").val(res.data.details.exam_name);
                $("#downloadExcel").find("#class_section_name").val(res.class_section);
                $("#downloadExcel").find("#exam_id").val(exam_id);
                $("#downloadExcel").find("#class_id").val(class_id);
                $("#downloadExcel").find("#section_id").val(section_id);
                $("#downloadExcel").find("#semester_id").val(semester_id);
                $("#downloadExcel").find("#session_id").val(session_id);
            }
        }, 'json');
    }).on('hidden.bs.modal', function (event) {

    });

    $("#examTimetableFilter").validate({
        rules: {
            department_id:  "required",
            class_id: "required", 
            section_id: "required",
        }
    });

    // get timetable
    $('#examTimetableFilter').on('submit', function (e) {
        e.preventDefault();
        var filterCheck = $("#examTimetableFilter").valid();
        if (filterCheck === true) {
            
            // var formData 
            var semester_id = $("#semester_id").val();
            var session_id = $("#session_id").val();
            var class_id = $("#class_id").val();
            var section_id = $("#section_id").val();
            formData = new FormData();
            formData.append('token', token);
            formData.append('branch_id', branchID);
            formData.append('class_id', class_id);
            formData.append('section_id', section_id);
            formData.append('semester_id', semester_id);
            formData.append('session_id', session_id);

            var classObj = {
                classID: class_id,
                branchID: branchID,
                sectionID: section_id,
                semesterID: semester_id,
                sessionID: session_id,
                userID: userID,
            };
            setLocalStorageForExamTimeTableList(classObj);

            examTimetableList(formData);

            
        }
    });

    function examTimetableList(formData){
        $("#overlay").fadeIn(300);
            $.ajax({
                url: listExamTimetable,
                method: "Post",
                data: formData,
                processData: false,
                dataType: 'json',
                contentType: false,
                success: function (data) {

                    if (data.code == 200) {

                        $("#schedulerow").show("slow");
                        $("#exam-schedule").html(data.table);
                    } else {
                        $("#schedulerow").hide("slow");
                        toastr.error(data.message);
                    }
                    $("#overlay").fadeOut(300);
                }
            });
    }

    function setLocalStorageForExamTimeTableList(classObj) {

        var examTimetableListDetails = new Object();
        examTimetableListDetails.class_id = classObj.classID;
        examTimetableListDetails.section_id = classObj.sectionID;
        examTimetableListDetails.semester_id = classObj.semesterID;
        examTimetableListDetails.session_id = classObj.sessionID;
        // here to attached to avoid localStorage other users to add
        examTimetableListDetails.branch_id = branchID;
        examTimetableListDetails.role_id = get_roll_id;
        examTimetableListDetails.user_id = ref_user_id;
        var examTimetableListArr = [];
        examTimetableListArr.push(examTimetableListDetails);
        if (get_roll_id == "2") {
            // admin
            localStorage.removeItem("admin_exam_timetable_list_details");
            localStorage.setItem('admin_exam_timetable_list_details', JSON.stringify(examTimetableListArr));
        }
        return true;
    }
    // if localStorage
    if (typeof exam_timetable_list_storage !== 'undefined') {
        if ((exam_timetable_list_storage)) {
            if (exam_timetable_list_storage) {
                var examTimetableListStorage = JSON.parse(exam_timetable_list_storage);
                if (examTimetableListStorage.length == 1) {
                    var classID, sectionID, semesterID, sessionID, userBranchID, userRoleID, userID;
                    examTimetableListStorage.forEach(function (user) {
                        classID = user.class_id;
                        sectionID = user.section_id;
                        semesterID = user.semester_id;
                        sessionID = user.session_id;
                        userBranchID = user.branch_id;
                        userRoleID = user.role_id;
                        userID = user.user_id;     
                    });
                    if ((userBranchID == branchID) && (userRoleID == get_roll_id) && (userID == ref_user_id)) {
                        $('#class_id').val(classID);
                        $('#semester_id').val(semesterID);
                        $('#session_id').val(sessionID);
                        if (classID) {
                            $("#section_id").empty();
                            $("#section_id").append('<option value="">'+select_class+'</option>');
                            $.post(sectionByClass, { token: token, branch_id: branchID, class_id: classID, teacher_id: userID }, function (res) {
                                if (res.code == 200) {
                                    $("#section_drp_div").show();
                                    $.each(res.data, function (key, val) {
                                        $("#section_id").append('<option value="' + val.section_id + '">' + val.section_name + '</option>');
                                    });
                                    $("#section_id").val(sectionID);
                                }
                            }, 'json');
                        }

                        var formData = new FormData();
                        formData.append('token', token);
                        formData.append('branch_id', branchID);
                        formData.append('class_id', classID);
                        formData.append('section_id', sectionID);
                        formData.append('semester_id', semesterID);
                        formData.append('session_id', sessionID);
                        examTimetableList(formData);
                    }
                }
            }
        }
    }

    $("#addScheduleFilter").validate({
        rules: {
            department_id : "required",
            class_id: "required",
            section_id: "required",
            exam_id: "required",
        }
    });

    // get timetable
    $('#addScheduleFilter').on('submit', function (e) {
        e.preventDefault();
        $("#listrow").hide("slow");
        var filterCheck = $("#addScheduleFilter").valid();
        if (filterCheck === true) {
            var form = this;
            $.ajax({
                url: $(form).attr('action'),
                method: $(form).attr('method'),
                data: new FormData(form),
                processData: false,
                dataType: 'json',
                contentType: false,
                success: function (data) {
                    // console.log("___________")
                    // console.log(data)
                    if (data.code == 200) {

                        $("#form_class_id").val(data.class_id);
                        $("#form_section_id").val(data.section_id);
                        $("#form_exam_id").val(data.exam_id);
                        $("#form_session_id").val(data.session_id);
                        $("#form_semester_id").val(data.semester_id);
                        $("#listrow").show("slow");
                        $("#subject-schedule").html(data.table);
                    } else {
                        $("#listrow").hide("slow");
                        toastr.error(data.message);
                    }
                }
            });
        }
    });


    $('#addScheduleForm').on('submit', function (e) {
        e.preventDefault();
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
                if (data.code == 200) {
                    window.location.href = scheduleList;
                    toastr.success(data.message);
                    $("#overlay").fadeOut(300);
                } else {
                    toastr.error(data.message);
                    $("#overlay").fadeOut(300);
                }
            }
        });
    });


    // delete Exam Timetable
    $(document).on('click', '#deleteExamTimetableBtn', function () {
        var class_id = $("#class_id").val();
        var section_id = $("#section_id").val();
        var semester_id = $("#semester_id").val();
        var session_id = $("#session_id").val();
        var exam_id = $(this).data('id');
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
                $.post(examDelete, {
                    exam_id: exam_id, class_id: class_id, section_id: section_id,
                    semester_id: semester_id, session_id: session_id
                }, function (data) {
                    if (data.code == 200) {
                        $("#schedulerow").show("slow");
                        $("#exam-schedule").html(data.table);
                        toastr.success(data.message);
                    } else {
                        $("#schedulerow").hide("slow");
                        toastr.error(data.message);
                    }
                }, 'json');
            }
        });
    });
});