$(function () {
    // change department filter
    $("#department_id").on('change', function (e) {
        e.preventDefault();
        var Selector = '#addFilter';
        var department_id = $(this).val();
        var classID = "";
        if (department_id) {
            classAllocation(department_id, Selector, classID);
        }
    });
    // change department filter
    $("#index_department_id").on('change', function (e) {
        e.preventDefault();
        var Selector = '#indexFilter';
        var department_id = $(this).val();
        var classID = "";
        if (department_id) {
            classAllocation(department_id, Selector, classID);
        }
    });

    function classAllocation(department_id, Selector, classID) {

        $(Selector).find("#class_id").empty();
        $(Selector).find("#class_id").append('<option value="">' + select_grade + '</option>');
        if (department_id) {
            $.post(getGradeByDepartmentUrl,
                {
                    branch_id: branchID,
                    department_id: department_id
                }, function (res) {
                    if (res.code == 200) {
                        $.each(res.data, function (key, val) {
                            $(Selector).find("#class_id").append('<option value="' + val.id + '">' + val.name + '</option>');
                        });
                        if (classID != '') {
                            $(Selector).find('select[name="class_id"]').val(classID);
                        }
                    }
                }, 'json');
        }
    }
    // change 
    $('#changeClassName').on('change', function () {
        var class_id = $(this).val();
        $("#copyeditTimetableForm").find("#sectionID").empty();
        $("#copyeditTimetableForm").find("#sectionID").append('<option value="">' + select_class + '</option>');

        $.post(teacherSectionUrl, { token: token, branch_id: branchID, teacher_id: ref_user_id, class_id: class_id }, function (res) {
            if (res.code == 200) {
                $.each(res.data, function (key, val) {
                    $("#copyeditTimetableForm").find("#sectionID").append('<option value="' + val.section_id + '">' + val.section_name + '</option>');
                });
            }
        }, 'json');
    });
    // function selectRefresh() {
    //     console.log("sdsd")
    //     $('.main .select2-multiple').select2({
    //         //-^^^^^^^^--- update here
    //         tags: true,
    //         placeholder: "Select an Option",
    //         allowClear: true,
    //         width: '100%'
    //     });
    // }
    // $('.select2-multiple').select2();
    $('.select2-multiple-plus').select2();
    // add timetable
    // $('#addTimetableForm').on('submit', function (e) {
    //     console.log($('.time_start_class'))
    //     $('.time_start_class').each(function () {
    //         $(this).rules("add", {
    //             required: true
    //         })
    //     });
    //     e.preventDefault();
    //     if ($('#contactForm').validate().form()) {
    //         alert("validates");
    //     } else {
    //         alert("does not validate");
    //     }
    //     return false;
    //     $("#overlay").fadeIn(300);
    //     var form = this;
    //     $.ajax({
    //         url: $(form).attr('action'),
    //         method: $(form).attr('method'),
    //         data: new FormData(form),
    //         processData: false,
    //         dataType: 'json',
    //         contentType: false,
    //         success: function (data) {
    //             if (data.code == 200) {
    //                 $('.addTimetableForm').find('form')[0].reset();
    //                 toastr.success(data.message);
    //                 window.location.href = timetableList;
    //                 $("#overlay").fadeOut(300);
    //             } else {
    //                 toastr.error(data.message);
    //                 $("#overlay").fadeOut(300);
    //             }
    //         }
    //     });
    // });
    $('#addTimetableForm').on('submit', function (event) {
        console.log($('.time_start_class'))
        $('.time_start_class').each(function () {
            $(this).rules("add", {
                required: true
            })
        });
        $('.time_end_class').each(function () {
            $(this).rules("add", {
                required: true
            })
        });

        event.preventDefault();
        if ($('#addTimetableForm').validate().form()) {
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
                        $('.addTimetableForm').find('form')[0].reset();
                        toastr.success(data.message);
                        window.location.href = timetableList;
                        $("#overlay").fadeOut(300);
                    } else {
                        toastr.error(data.message);
                        $("#overlay").fadeOut(300);
                    }
                }
            });
        }
    });
    $('#addTimetableForm').validate();

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

    $("#addFilter").validate({
        rules: {
            department_id: "required",
            class_id: "required",
            section_id: "required",
            day: "required",
        }
    });
    var count = 0;
    // add designation
    $('#addFilter').on('submit', function (e) {
        e.preventDefault();
        var filterCheck = $("#addFilter").valid();
        if (filterCheck === true) {

            $("#timetable").hide("slow");
            $(".teacher").empty();
            $(".teacher").append('<option value="">' + select_teacher + '</option>');
            $(".subject").empty();
            $(".subject").append('<option value="">' + select_subject + '</option>');

            // var table = document.getElementById("timetable_table");
            // var length = table.tBodies[0].rows.length
            // console.log('length',length)
            // if(length>1)
            // {
            $("#timetable_body").empty();
            // }
            var department_id = $("#department_id").val();
            var classID = $("#class_id").val();
            var sectionID = $("#section_id").val();
            var semesterID = $("#semester_id").val();
            var sessionID = $("#session_id").val();
            var Day = $("#day").val();

            var classObj = {
                department_id: department_id,
                class_id: classID,
                section_id: sectionID,
                semester_id: semesterID,
                session_id: sessionID,
                day: Day,
                academic_session_id: academic_session_id
            };
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
                        $("#form_class_id").val(classID);
                        $("#form_section_id").val(sectionID);
                        $("#form_semester_id").val(semesterID);
                        $("#form_session_id").val(sessionID);
                        $("#form_day").val(Day);
                        $("#timetable").show("slow");
                        var subject = data.data.subject;
                        var teacher = data.data.teacher;
                        var exam_hall = data.data.exam_hall;


                        if (data.data.timetable == "") {
                            callout(subject, teacher, exam_hall);
                        } else {
                            var cd = data.data.length;
                            count = cd;
                            console.log('cou', count)
                            $("#timetable_body").append(data.data.timetable);
                            $('.select2-multiple').select2();

                        }

                    }
                }
            });

            setLocalStorageForadminaddschedule(classObj);
        }
    });

    function setLocalStorageForadminaddschedule(classObj) {

        var addschedule = new Object();

        addschedule.department_id = classObj.department_id;
        addschedule.class_id = classObj.class_id;
        addschedule.section_id = classObj.section_id;
        addschedule.semester_id = classObj.semester_id;
        addschedule.session_id = classObj.session_id;
        addschedule.day = classObj.day;
        // here to attached to avoid localStorage other users to add
        addschedule.branch_id = branchID;
        addschedule.role_id = get_roll_id;
        addschedule.user_id = ref_user_id;
        var addscheduleArr = [];
        addscheduleArr.push(addschedule);
        if (get_roll_id == "2") {
            // Parent
            localStorage.removeItem("admin_add_schedule_details");
            localStorage.setItem('admin_add_schedule_details', JSON.stringify(addscheduleArr));
        }

        return true;
    }
    $("#indexFilter").validate({
        rules: {
            index_department_id: "required",
            class_id: "required",
            section_id: "required",
        }
    });

    $('#editTimetableModal').on('shown.bs.modal', function () {
        var class_id = $("#edit-modal").data('class_id');
        var section_id = $("#edit-modal").data('section_id');
        var semester_id = $("#edit-modal").data('semester_id');
        var session_id = $("#edit-modal").data('session_id');
        $("#edit_class_id").val(class_id);
        $("#edit_section_id").val(section_id);
        $("#edit_semester_id").val(semester_id);
        $("#edit_session_id").val(session_id);//value

        // use the above data however you want
    })
    // get timetable
    $('#indexFilter').on('submit', function (e) {
        e.preventDefault();
        var filterCheck = $("#indexFilter").valid();
        if (filterCheck === true) {
            var form = this;

            var department_id = $("#index_department_id").val();
            var classID = $("#class_id").val();
            var sectionID = $("#section_id").val();
            var semesterID = $("#semester_id").val();
            var sessionID = $("#session_id").val();
            var classObj = {
                department_id: department_id,
                classID: classID,
                sectionID: sectionID,
                semesterID: semesterID,
                sessionID: sessionID
            };
            setLocalStorageTimetableTeacher(classObj);
            $.ajax({
                url: $(form).attr('action'),
                method: $(form).attr('method'),
                data: new FormData(form),
                processData: false,
                dataType: 'json',
                contentType: false,
                success: function (data) {

                    if (data.code == 200) {

                        $("#edit-modal").attr("data-class_id", data.class_id);
                        $("#edit-modal").attr("data-section_id", data.section_id);
                        $("#edit-modal").attr("data-semester_id", data.semester_id);
                        $("#edit-modal").attr("data-session_id", data.session_id);
                        $("#timetablerow").show("slow");
                        $("#timetable").html(data.timetable);
                        // download set start
                        $("#downClassID").val(data.class_id);
                        $("#downSectionID").val(data.section_id);
                        $("#downSemesterID").val(data.semester_id);
                        $("#downSessionID").val(data.session_id);
                        $("#downAcademicYear").val(academic_session_id);
                        // download set end
                    } else {
                        $("#timetablerow").hide("slow");
                        toastr.error(data.message);
                    }
                }
            });
        }
    });
    function setLocalStorageTimetableTeacher(classObj) {

        var timetableDetails = new Object();
        timetableDetails.department_id = classObj.department_id;
        timetableDetails.class_id = classObj.classID;
        timetableDetails.section_id = classObj.sectionID;
        timetableDetails.semester_id = classObj.semesterID;
        timetableDetails.session_id = classObj.sessionID;
        // here to attached to avoid localStorage other users to add
        timetableDetails.branch_id = branchID;
        timetableDetails.role_id = get_roll_id;
        timetableDetails.user_id = ref_user_id;
        var timeTableClassArr = [];
        timeTableClassArr.push(timetableDetails);
        if (get_roll_id == "4") {
            // teacher
            localStorage.removeItem("teacher_timetable_details");
            localStorage.setItem('teacher_timetable_details', JSON.stringify(timeTableClassArr));
        }
        if (get_roll_id == "2") {
            // teacher
            localStorage.removeItem("admin_schedule_list_details");
            localStorage.setItem('admin_schedule_list_details', JSON.stringify(timeTableClassArr));
        }
        return true;
    }
    if (get_roll_id == "4") {
        // if localStorage
        if (typeof teacher_timetable_det !== 'undefined') {
            // variable is come
            if ((teacher_timetable_det)) {
                if (teacher_timetable_det) {
                    var teacherTimeTableStorage = JSON.parse(teacher_timetable_det);
                    if (teacherTimeTableStorage.length == 1) {
                        var classID, sectionID, semesterID, sessionID, userBranchID, userRoleID, userID;
                        teacherTimeTableStorage.forEach(function (user) {
                            classID = user.class_id;
                            sectionID = user.section_id;
                            semesterID = user.semester_id;
                            sessionID = user.session_id;
                            userBranchID = user.branch_id;
                            userRoleID = user.role_id;
                            userID = user.user_id;
                        });
                        if ((userBranchID == branchID) && (userRoleID == get_roll_id) && (userID == ref_user_id)) {
                            console.log("f");
                            $("#indexFilter").find("#class_id").val(classID);
                            $.post(sectionByClass, { class_id: classID }, function (res) {
                                if (res.code == 200) {
                                    $.each(res.data, function (key, val) {
                                        $("#section_id").append('<option value="' + val.section_id + '">' + val.section_name + '</option>');
                                    });
                                    $("#indexFilter").find("#section_id").val(sectionID);
                                    $("#indexFilter").find("#semester_id").val(semesterID);
                                    $("#indexFilter").find("#session_id").val(sessionID);

                                }
                            }, 'json');

                            var formData = new FormData();
                            formData.append('token', token);
                            formData.append('branch_id', branchID);
                            formData.append('class_id', classID);
                            formData.append('section_id', sectionID);
                            formData.append('semester_id', semesterID);
                            formData.append('session_id', sessionID);
                            $.ajax({
                                url: timetableFilter,
                                method: "post",
                                data: formData,
                                processData: false,
                                dataType: 'json',
                                contentType: false,
                                success: function (data) {

                                    if (data.code == 200) {
                                        $("#edit-modal").attr("data-class_id", data.class_id);
                                        $("#edit-modal").attr("data-section_id", data.section_id);
                                        $("#edit-modal").attr("data-semester_id", data.semester_id);
                                        $("#edit-modal").attr("data-session_id", data.session_id);
                                        $("#timetablerow").show("slow");
                                        $("#timetable").html(data.timetable);
                                        // download set start
                                        $("#downClassID").val(data.class_id);
                                        $("#downSectionID").val(data.section_id);
                                        $("#downSemesterID").val(data.semester_id);
                                        $("#downSessionID").val(data.session_id);
                                        $("#downAcademicYear").val(academic_session_id);
                                        // download set end
                                    } else {
                                        $("#timetablerow").hide("slow");
                                    }
                                }
                            });
                        }
                    }
                }
            }
        }
    }
    if (get_roll_id == "2") {
        // if localStorage
        if (typeof admin_schedule_list_storage !== 'undefined') {
            // variable is come
            if ((admin_schedule_list_storage)) {
                if (admin_schedule_list_storage) {
                    var adminschedulelistStorage = JSON.parse(admin_schedule_list_storage);
                    if (adminschedulelistStorage.length == 1) {
                        var department_id, classID, sectionID, semesterID, sessionID, userBranchID, userRoleID, userID;
                        adminschedulelistStorage.forEach(function (user) {
                            department_id = user.department_id;
                            classID = user.class_id;
                            sectionID = user.section_id;
                            semesterID = user.semester_id;
                            sessionID = user.session_id;
                            userBranchID = user.branch_id;
                            userRoleID = user.role_id;
                            userID = user.user_id;
                        });
                        if ((userBranchID == branchID) && (userRoleID == get_roll_id) && (userID == ref_user_id)) {
                            console.log("f");
                            var Selector = '#indexFilter';
                            $(Selector).find('select[name="index_department_id"]').val(department_id);
                            if (department_id) {
                                $(Selector).find('select[name="class_id"]').empty();
                                $(Selector).find('select[name="class_id"]').append('<option value="">' + select_grade + '</option>');
                                $(Selector).find('select[name="section_id"]').empty();
                                $(Selector).find('select[name="section_id"]').append('<option value="">' + select_class + '</option>');
                                $.post(getGradeByDepartmentUrl, {
                                    branch_id: branchID,
                                    department_id: department_id
                                }, function (res) {
                                    if (res.code == 200) {
                                        $.each(res.data, function (key, val) {
                                            $(Selector).find('select[name="class_id"]').append('<option value="' + val.id + '">' + val.name + '</option>');
                                        });
                                        if (class_id != '') {
                                            $(Selector).find('select[name="class_id"]').val(classID);
                                        }
                                        // after success
                                        $.post(sectionByClass, {
                                            token: token, branch_id: branchID, class_id: classID
                                        }, function (res) {
                                            if (res.code == 200) {
                                                $.each(res.data, function (key, val) {
                                                    var selected = (sectionID == val.section_id) ? 'selected' : '';
                                                    $(Selector).find('select[name="section_id"]').append('<option value="' + val.section_id + '" ' + selected + '>' + val.section_name + '</option>');
                                                });
                                            }
                                        }, 'json');
                                    }
                                }, 'json');
                            }
                            $(Selector).find('select[name="semester_id"]').val(semesterID);
                            $(Selector).find('select[name="session_id"]').val(sessionID);
                            var formData = new FormData();
                            formData.append('department_id', department_id);
                            formData.append('branch_id', branchID);
                            formData.append('class_id', classID);
                            formData.append('section_id', sectionID);
                            formData.append('semester_id', semesterID);
                            formData.append('session_id', sessionID);
                            $.ajax({
                                url: timetableFilter,
                                method: "post",
                                data: formData,
                                processData: false,
                                dataType: 'json',
                                contentType: false,
                                success: function (data) {

                                    if (data.code == 200) {
                                        $("#edit-modal").attr("data-class_id", data.class_id);
                                        $("#edit-modal").attr("data-section_id", data.section_id);
                                        $("#edit-modal").attr("data-semester_id", data.semester_id);
                                        $("#edit-modal").attr("data-session_id", data.session_id);
                                        $("#timetablerow").show("slow");
                                        $("#timetable").html(data.timetable);
                                        // download set start
                                        $("#downClassID").val(data.class_id);
                                        $("#downSectionID").val(data.section_id);
                                        $("#downSemesterID").val(data.semester_id);
                                        $("#downSessionID").val(data.session_id);
                                        $("#downAcademicYear").val(academic_session_id);
                                        // download set end
                                    } else {
                                        $("#timetablerow").hide("slow");
                                    }
                                }
                            });
                        }
                    }
                }
            }
        }
    }
    // update timetable
    $('#editTimetableForm').on('submit', function (e) {
        e.preventDefault();
        var form = this;
        $("#overlay").fadeIn(300);
        $.ajax({
            url: $(form).attr('action'),
            method: $(form).attr('method'),
            data: new FormData(form),
            processData: false,
            dataType: 'json',
            contentType: false,
            success: function (data) {
                if (data.code == 200) {
                    $('.editTimetableForm').find('form')[0].reset();
                    toastr.success(data.message);
                    window.location.href = timetableList;
                    $("#overlay").fadeOut(300);
                } else {
                    toastr.error(data.message);
                    $("#overlay").fadeOut(300);
                }
            }
        });
    });
    // update timetable copy
    // rules validation
    $("#copyeditTimetableForm").validate({
        rules: {
            year: "required",
            class_id: "required",
            section_id: "required",
            semester_id: "required",
            session_id: "required"
        }
    });
    $('#copyeditTimetableForm').on('submit', function (e) {
        e.preventDefault();
        var valid = $("#copyeditTimetableForm").valid();
        if (valid === true) {
            var form = this;
            $("#overlay").fadeIn(300);
            $.ajax({
                url: $(form).attr('action'),
                method: $(form).attr('method'),
                data: new FormData(form),
                processData: false,
                dataType: 'json',
                contentType: false,
                success: function (data) {
                    if (data.code == 200) {
                        // $('.copyeditTimetableForm').find('form')[0].reset();
                        toastr.success(data.message);
                        window.location.href = timetableList;
                        $("#overlay").fadeOut(300);
                    } else {
                        toastr.error(data.message);
                        $("#overlay").fadeOut(300);
                    }
                }
            });
        }
    });
    $(document).on('click', "#timetable_body input[type='checkbox']", function () {

        var fal = true;
        if (this.checked == true) {
            fal = false;
        }
        $(this).closest('tr').find('.subject').prop('disabled', this.checked);
        $(this).closest('tr').find('.subject').attr('hidden', this.checked);

        $(this).closest('tr').find('.break_type').prop('disabled', fal);
        $(this).closest('tr').find('.break_type').attr('hidden', fal);
    })

    // $("#timetable_body").on('click', '.removeTR', function () {
    //     $(this).parent().parent().remove();
    // });

    // $("#edit_timetable_body").on('click', '.removeTR', function () {
    //     $(this).parent().parent().remove();
    // });
    $("#timetable_body").on('click', '.removeTR', function () {
        $(this).parent().parent().parent().remove();
    });

    $("#edit_timetable_body").on('click', '.removeTR', function () {
        $(this).parent().parent().parent().remove();
    });
    $(document).on('change', "#edit_timetable_body input[type='checkbox']", function () {
        var fal = true;
        if (this.checked == true) {
            fal = false;
        }
        $(this).closest('tr').find('.subject').prop('disabled', this.checked);
        $(this).closest('tr').find('.subject').attr('hidden', this.checked);

        $(this).closest('tr').find('.break_type').prop('disabled', fal);
        $(this).closest('tr').find('.break_type').attr('hidden', fal);
    })

    $(document).on('click', "#addMore", function () {

        var class_id = $("#form_class_id").val();
        var section_id = $("#form_section_id").val();
        var semester_id = $("#form_semester_id").val();
        var session_id = $("#form_session_id").val();
        $.post(subjectByClass, {
            class_id: class_id, section_id: section_id,
            semester_id: semester_id, session_id: session_id
        }, function (res) {
            if (res.code == 200) {

                var subject = res.data.subject;
                var teacher = res.data.teacher;
                var exam_hall = res.data.exam_hall;
                callout(subject, teacher, exam_hall);
            }
        }, 'json');
    });
    $(document).on('change', ".subByTeacher", function () {

        var teacher_id = $(this).data('id');
        var class_id = $("#form_class_id").val();
        var section_id = $("#form_section_id").val();
        console.log(teacher_id);
        console.log(class_id);
        console.log(section_id);
        $.post(teacherSubjectUrl, {
            token: token,
            branch_id: branchID,
            class_id: class_id,
            section_id: section_id,
            teacher_id: teacher_id
        }, function (res) {
            console.log("------------")
            console.log(res)
            if (res.code == 200) {

            }
        }, 'json');
    });
    $(document).on('change', ".time_start_class", function (e) {
        e.preventDefault();
        var color = $(this).closest('tr');

        color.find(".class_room option").css('background-color', 'white');
        color.find(".class_room option").css('color', 'black');
        var start_time = $(this).closest('tr').find('.time_start_class').val();
        var end_time = $(this).closest('tr').find('.time_end_class').val();

        if (start_time && end_time) {
            var semesterID = $("#semester_id").val();
            var day = $("#day").val();
            $.post(classRoomCheck, {
                token: token,
                branch_id: branchID,
                start_time: start_time,
                end_time: end_time,
                semester_id: semesterID,
                day: day
            }, function (res) {
                if (res.code == 200) {
                    $.each(res.data, function (index, value) {
                        color.find(".class_room option[value='" + value.class_room + "']").css('background-color', 'red');
                        color.find(".class_room option[value='" + value.class_room + "']").css('color', 'white');
                    });
                    // $("option[value='myValue']").css('background-color', 'red');
                }
            }, 'json');
        }

    });
    $(document).on('change', ".time_end_class", function (e) {
        e.preventDefault();
        var color = $(this).closest('tr');

        color.find(".class_room option").css('background-color', 'white');
        color.find(".class_room option").css('color', 'black');
        var start_time = $(this).closest('tr').find('.time_start_class').val();
        var end_time = $(this).closest('tr').find('.time_end_class').val();

        if (start_time && end_time) {
            var semesterID = $("#semester_id").val();
            var day = $("#day").val();
            $.post(classRoomCheck, {
                token: token,
                branch_id: branchID,
                start_time: start_time,
                end_time: end_time,
                semester_id: semesterID,
                day: day
            }, function (res) {
                console.log('da', res)
                if (res.code == 200) {
                    $.each(res.data, function (index, value) {
                        color.find(".class_room option[value='" + value.class_room + "']").css('background-color', 'red');
                        color.find(".class_room option[value='" + value.class_room + "']").css('color', 'white');


                        color.find(".teacher option[value='" + value.teacher + "']").css('background-color', 'red');
                        color.find(".teacher option[value='" + value.teacher + "']").css('color', 'white');
                    });
                    // $("option[value='myValue']").css('background-color', 'red');
                }
            }, 'json');
        }

    });

    $(document).on('click', ".select2-selection__rendered", function (e) {
        e.preventDefault();

        var start_time = $(this).closest('tr').find('.time_start_class').val();
        var end_time = $(this).closest('tr').find('.time_end_class').val();

        if (start_time && end_time) {
            var semesterID = $("#semester_id").val();
            var day = $("#day").val();
            $.post(classRoomCheck, {
                token: token,
                branch_id: branchID,
                start_time: start_time,
                end_time: end_time,
                semester_id: semesterID,
                day: day
            }, function (res) {
                if (res.code == 200) {
                    $.each(res.data, function (index, value) {

                        var teacher = value.teacher_id;
                        $('.select2-results__options li').each(function () {
                            var id = this.id.substring(this.id.lastIndexOf('-') + 1);
                            if (teacher == id) {
                                $("#" + this.id).css('background-color', 'red');
                                $("#" + this.id).css('color', 'white');
                            }
                        });
                    });
                    // $("option[value='myValue']").css('background-color', 'red');
                }
            }, 'json');
        }

    });


    function callout(subject, teacher, exam_hall) {

        // let i = 0;
        // var test = "";
        // test += '<select class="form-control select2-multiple-test" data-toggle="select2" multiple="multiple" data-placeholder="Choose ..." ><option   selected="selected">Cat</option><option selected="selected">Dog</option> </select>';
        // $(".boxss").append(test);
        // if(i == 0){
        //     console.log("---");
        //     console.log(i);
        //     $('.select2-multiple-test').select2();
        // }
        // i++;
        // var newtest = "<select class='form-control select2-multiple' data-toggle='select2' multiple='multiple' data-placeholder='Choose ...' ><option   selected='selected'>Cat</option><option selected='selected'>Dog</option> </select>";
        // $("#boxss").append(newtest);
        // $(".boxss").append('<select class="form-control select2-multiple-test" data-toggle="select2" multiple="multiple" data-placeholder="Choose ..." ><option   selected="selected">Cat</option><option selected="selected">Dog</option> </select>');
        // $('.select2-multiple-test').select2();
        var row = "";
        row += '<tr class="iadd">';
        row += '<td ><div class="checkbox-replace"> ';
        row += '<label class="i-checks"><input type="checkbox" name="timetable[' + count + '][break]" id="' + count + '"><i></i>';
        row += '</label></div></td>';
        row += '<td width="20%" ><div class="form-group">';
        row += '<select  class="form-control subject"  name="timetable[' + count + '][subject]">';
        row += '<option value="">' + select_subject + '</option>';
        $.each(subject, function (key, val) {
            row += '<option value="' + val.id + '">' + val.name + '</option>';
        });
        row += '</select>';
        row += '<input class="form-control break_type"  type="text" name="timetable[' + count + '][break_type]" disabled hidden="hidden"></input> ';
        row += '</div></td>';
        row += '<td width="20%" ><div class="form-group main">';
        row += '<select  class="form-control select2-multiple teacher" data-toggle="select2" multiple="multiple" data-placeholder="Choose ..." name="timetable[' + count + '][teacher][]">';
        row += '<option value="">' + select_teacher + '</option>';
        $.each(teacher, function (key, val) {
            row += '<option value="' + val.id + '">' + val.name + '</option>';
        });
        row += '</select>';
        row += '</div></td>';
        row += '<td width="20%"><div class="form-group">';
        row += '<input class="form-control time_start_class"  type="time" name="timetable[' + count + '][time_start]" >';
        row += '</div></td>';
        row += '<td width="20%"><div class="form-group">';
        row += '<input class="form-control time_end_class"  type="time" name="timetable[' + count + '][time_end]" >';
        row += '</div></td>';
        row += '<td width="20%" ><div class="form-group">';
        row += '<select  class="form-control class_room"  name="timetable[' + count + '][class_room]" class="form-control">';
        row += '<option value="">' + select_hall + '</option>';
        $.each(exam_hall, function (key, val) {
            row += '<option value="' + val.id + '">' + val.hall_no + '</option>';
        });
        row += '</select>';
        row += '</div></td>';
        row += '<td width="20%"><div class="form-group">';
        row += '<button type="button" class=" btn btn-danger removeTR"><i class="fas fa-times"></i> </button>';
        row += '</div></td>';
        // row += '</div><button type="button" class=" btn btn-danger removeTR"><i class="fas fa-times"></i> </button></td>';
        // row += '<td width="20%"><div class="input-group">';
        // row += '<input type="text"  name="timetable[' + count + '][class_room]" value="" class="form-control" >';
        // row += '<button type="button" class=" btn btn-danger removeTR"><i class="fas fa-times"></i> </button>';
        // row += '</div></td>';
        row += '</tr>';

        count++;
        // console.log('as',row)
        // return row;

        $("#timetable_body").append(row);
        $('.select2-multiple').select2();
    }


    $(document).on('click', '.exportToExcel', function (e) {
        // var table = $(this).prev('.table2excel');
        var table = $('.table2excel');
        if (table && table.length) {
            var preserveColors = (table.hasClass('table2excel_with_colors') ? true : false);
            $(table).table2excel({
                // exclude: ".noExl",
                name: "Timetable",
                filename: downloadFileName + new Date().toISOString().replace(/[\-\:\.]/g, "") + ".xls",
                fileext: ".xls",
                exclude_img: true,
                exclude_links: true,
                exclude_inputs: true,
                preserveColors: preserveColors
            });
        }
    });
    if (get_roll_id == "2") {
        if (typeof admin_add_schedule_storage !== 'undefined') {
            if (admin_add_schedule_storage) {
                var adminaddschedulestorage = JSON.parse(admin_add_schedule_storage);
                if (adminaddschedulestorage.length == 1) {
                    var department_id, class_id, section_id, day, semester_id, session_id, userBranchID, userRoleID, userID;
                    adminaddschedulestorage.forEach(function (user) {
                        department_id = user.department_id;
                        class_id = user.class_id;
                        section_id = user.section_id;
                        day = user.day;
                        semester_id = user.semester_id;
                        session_id = user.session_id;
                        userBranchID = user.branch_id;
                        userRoleID = user.role_id;
                        userID = user.user_id;
                    });
                    if ((userBranchID == branchID) && (userRoleID == get_roll_id) && (userID == ref_user_id)) {
                        var Selector = '#addFilter';
                        $(Selector).find('select[name="department_id"]').val(department_id);
                        if (department_id) {
                            $(Selector).find('select[name="class_id"]').empty();
                            $(Selector).find('select[name="class_id"]').append('<option value="">' + select_grade + '</option>');
                            $(Selector).find('select[name="section_id"]').empty();
                            $(Selector).find('select[name="section_id"]').append('<option value="">' + select_class + '</option>');
                            $.post(getGradeByDepartmentUrl, {
                                branch_id: branchID,
                                department_id: department_id
                            }, function (res) {
                                if (res.code == 200) {
                                    $.each(res.data, function (key, val) {
                                        $(Selector).find('select[name="class_id"]').append('<option value="' + val.id + '">' + val.name + '</option>');
                                    });
                                    if (class_id != '') {
                                        $(Selector).find('select[name="class_id"]').val(class_id);
                                    }
                                    // after success
                                    $.post(sectionByClass, {
                                        token: token, branch_id: branchID, class_id: class_id
                                    }, function (res) {
                                        if (res.code == 200) {
                                            $.each(res.data, function (key, val) {
                                                var selected = (section_id == val.section_id) ? 'selected' : '';
                                                $(Selector).find('select[name="section_id"]').append('<option value="' + val.section_id + '" ' + selected + '>' + val.section_name + '</option>');
                                            });
                                        }
                                    }, 'json');
                                }
                            }, 'json');
                        }
                        // $('select[name^="class_id"] option[value=' + class_id + ']').attr("selected", "selected");

                        // $("#section_id").empty();
                        // $("#section_id").append('<option value="">' + select_class + '</option>');
                        // $.post(sectionByClass, { class_id: class_id }, function (res) {
                        //     if (res.code == 200) {
                        //         $.each(res.data, function (key, val) {
                        //             var selected = (section_id == val.section_id) ? 'selected' : '';
                        //             $("#section_id").append('<option value="' + val.section_id + '" ' + selected + '>' + val.section_name + '</option>');
                        //         });
                        //     }
                        // }, 'json');
                        $(Selector).find('select[name="day"]').val(day);
                        $(Selector).find('select[name="semester_id"]').val(semester_id);
                        $(Selector).find('select[name="session_id"]').val(session_id);
                        // $('select[name^="day"] option[value=' + day + ']').attr("selected", "selected");
                        // $('select[name^="semester_id"] option[value=' + semester_id + ']').attr("selected", "selected");
                        // $('select[name^="session_id"] option[value=' + session_id + ']').attr("selected", "selected");

                    }
                }
            }
        }
    }
});