$(function () {

    var listTable;
    var addStudentID = [];
    var sTextColor = '#FFFFFF';
    var sBackColor = '#0abab5;';
    var sLabelColor = '#white';
    var sBorderColor = 'white';
    // $(".classRoomHideSHow").show("slow");
    // onload show start
    // classroom details 
    var classroom_attendance = sessionStorage.getItem('classroom_attendance');
    if (classroom_attendance) {
        var classroomDetails = JSON.parse(classroom_attendance);
        if (classroomDetails.length == 1) {
            var classID, sectionID, classDate, sectionName, subjectName, semesterID, sessionID;
            classroomDetails.forEach(function (user) {
                classID = user.class_id;
                sectionID = user.section_id;
                semesterID = user.semester_id;
                sessionID = user.session_id;
                classDate = user.date;
                sectionName = user.section_name;
                subjectName = user.subject_name;
            });
            var format_date = formatDate(classDate);
            var classObj = {
                classID: classID,
                sectionID: sectionID,
                semesterID: semesterID,
                sessionID: sessionID,
                academic_session_id: academic_session_id,
                classDate: format_date
            };
            $('#changeClassName').val(classID);
            $("#classroomFilter").find("#sectionID").append('<option selected value="' + sectionID + '">' + sectionName + '</option>');
            $("#classroomFilter").find("#semester_id").val(semesterID);
            $("#classroomFilter").find("#session_id").val(sessionID);
            $('#classDate').val(format_date);

            var formData = new FormData();
            formData.append('branch_id', branchID);
            formData.append('class_id', classID);
            formData.append('section_id', sectionID);
            formData.append('semester_id', semesterID);
            formData.append('session_id', sessionID);
            formData.append('academic_session_id', academic_session_id);
            formData.append('date', convertDigitIn(format_date));
            // list mode
            listModeAjax(formData, classObj);
        }
    }
    // if localStorage
    if ((teacher_classroom_attendance) && (classroom_attendance === null)) {
        if (teacher_classroom_attendance) {
            var teacherClassroomDetails = JSON.parse(teacher_classroom_attendance);
            if (teacherClassroomDetails.length == 1) {
                var classID, sectionID, classDate, semesterID, sessionID, userBranchID, userRoleID, userID;
                teacherClassroomDetails.forEach(function (user) {
                    classID = user.class_id;
                    sectionID = user.section_id;
                    semesterID = user.semester_id;
                    sessionID = user.session_id;
                    classDate = user.class_date;
                    userBranchID = user.branch_id;
                    userRoleID = user.role_id;
                    userID = user.user_id;
                });
                // check to avoid other user for localstorage
                if ((userBranchID == branchID) && (userRoleID == get_roll_id) && (userID == ref_user_id)) {
                    var dt = convertDigitIn(classDate);
                    var format_date = formatDate(dt);
                    $('#changeClassName').val(classID);
                    if (classID) {
                        $(".classRoomHideSHow").hide();
                        $.post(teacherSectionUrl, { token: token, branch_id: branchID, teacher_id: ref_user_id, class_id: classID }, function (res) {
                            if (res.code == 200) {
                                $.each(res.data, function (key, val) {
                                    $("#classroomFilter").find("#sectionID").append('<option value="' + val.section_id + '" ' + (sectionID == val.section_id ? "selected" : "") + '>' + val.section_name + '</option>');
                                });
                            }
                            // check both class and section
                            if (classID && sectionID) {
                                $.post(teacherSubjectUrl, {
                                    token: token,
                                    branch_id: branchID,
                                    teacher_id: ref_user_id,
                                    class_id: classID,
                                    section_id: sectionID,
                                    academic_session_id: academic_session_id,
                                }, function (res) {
                                    // after set filter
                                    $("#classroomFilter").find("#semester_id").val(semesterID);
                                    $("#classroomFilter").find("#session_id").val(sessionID);
                                    $('#classDate').val(classDate);
                                    var formData = new FormData();
                                    formData.append('branch_id', branchID);
                                    formData.append('class_id', classID);
                                    formData.append('section_id', sectionID);
                                    formData.append('semester_id', semesterID);
                                    formData.append('session_id', sessionID);
                                    formData.append('academic_session_id', academic_session_id);
                                    formData.append('date', convertDigitIn(classDate));
                                    var classObjs = {
                                        classID: classID,
                                        sectionID: sectionID,
                                        semesterID: semesterID,
                                        sessionID: sessionID,
                                        academic_session_id: academic_session_id,
                                        // classDate: format_date
                                        classDate: classDate
                                    };
                                    // list mode
                                    listModeAjax(formData, classObjs);
                                }, 'json');
                            }
                        }, 'json');
                    }
                }
            }
        }
    }
    // onload show start
    $(".classRoomHideSHow").hide();

    $("#classDate").datepicker({
        dateFormat: 'dd-mm-yy',
        changeMonth: true,
        changeYear: true,
        autoclose: true,
        yearRange: "-100:+50", // last hundred years
        maxDate: 0
    });
    // reverse dob
    function convertDigitIn(str) {
        return str.split('-').reverse().join('-');
    }
    // change classroom
    $('#changeClassName').on('change', function () {
        $(".classRoomHideSHow").hide();
        var class_id = $(this).val();
        $("#classroomFilter").find("#sectionID").empty();
        $("#classroomFilter").find("#sectionID").append('<option value="">' + select_class + '</option>');

        $.post(teacherSectionUrl, {
            token: token,
            branch_id: branchID,
            teacher_id: ref_user_id,
            class_id: class_id
        }, function (res) {
            if (res.code == 200) {
                $.each(res.data, function (key, val) {
                    $("#classroomFilter").find("#sectionID").append('<option value="' + val.section_id + '">' + val.section_name + '</option>');
                });
            }
        }, 'json');
    });

    // applyFilter
    // rules validation
    $("#classroomFilter").validate({
        rules: {
            class_id: "required",
            section_id: "required",
            class_date: "required"
        }
    });
    //
    $('#classroomFilter').on('submit', function (e) {
        e.preventDefault();
        var classRoom = $("#classroomFilter").valid();
        if (classRoom === true) {
            //   $("#overlay").fadeIn(300);
            // jQuery("body").prepend('<div id="preloader">Loading...</div>');
            var classID = $("#changeClassName").val();
            var sectionID = $("#sectionID").val();
            var classDate = $("#classDate").val();
            var semesterID = $("#semester_id").val();
            var sessionID = $("#session_id").val();

            var classObj = {
                classID: classID,
                sectionID: sectionID,
                classDate: classDate,
                semesterID: semesterID,
                sessionID: sessionID,
                academic_session_id: academic_session_id
            };
            var formData = new FormData();
            formData.append('branch_id', branchID);
            formData.append('class_id', classID);
            formData.append('section_id', sectionID);
            formData.append('semester_id', semesterID);
            formData.append('session_id', sessionID);
            formData.append('academic_session_id', academic_session_id);
            formData.append('date', convertDigitIn(classDate));
            // set local storage selected
            setLocalStorageForClassroom(classObj);
            // list mode
            listModeAjax(formData, classObj);

            //  $("#overlay").fadeOut(300);
        }
    });
    function setLocalStorageForClassroom(classObj) {
        var teacherClassDetails = new Object();
        teacherClassDetails.class_id = classObj.classID;
        teacherClassDetails.section_id = classObj.sectionID;
        teacherClassDetails.class_date = classObj.classDate;
        teacherClassDetails.semester_id = classObj.semesterID;
        teacherClassDetails.session_id = classObj.sessionID;
        // here to attached to avoid localStorage other users to add
        teacherClassDetails.branch_id = branchID;
        teacherClassDetails.role_id = get_roll_id;
        teacherClassDetails.user_id = ref_user_id;
        var teacherClassroomArr = [];
        teacherClassroomArr.push(teacherClassDetails);
        if (get_roll_id == "2") {
            // admin
            localStorage.removeItem("admin_classroom_attendance");
            localStorage.setItem('admin_classroom_attendance', JSON.stringify(teacherClassroomArr));
        }
        if (get_roll_id == "3") {
            // staff
            localStorage.removeItem("staff_classroom_attendance");
            localStorage.setItem('staff_classroom_attendance', JSON.stringify(teacherClassroomArr));
        }
        if (get_roll_id == "4") {
            // teacher
            localStorage.removeItem("teacher_classroom_attendance");
            localStorage.setItem('teacher_classroom_attendance', JSON.stringify(teacherClassroomArr));
        }
        return true;
    }
    // function List Mode AJax
    function listModeAjax(formDat, classObj) {
        $("#overlay").fadeIn(300);
        $.ajax({
            url: getStudentAttendance,
            method: "post",
            data: formDat,
            processData: false,
            dataType: 'json',
            contentType: false,
            success: function (response) {
                var dataSetNew = response.data.get_student_attendence;
                $("#attendaceTakenSts").empty();
                if (response.data.taken_attentance_status) {
                    var taken_attentance_status = response.data.taken_attentance_status.status;
                    if (taken_attentance_status) {
                        var takenAtt = '<p class="badge bg-soft-success text-success" style="padding: 1.00em 3.4em;font-size: 85%;">' + taken + '</p>';
                        $("#attendaceTakenSts").append(takenAtt);
                    } else {
                        var unTakenAtt = '<p class="badge bg-soft-danger text-danger" style="padding: 1.00em 3.4em;font-size: 85%;">' + untaken + '</p>';
                        $("#attendaceTakenSts").append(unTakenAtt);
                    }
                }
                var currentDate = convertDigitIn($("#classDate").val());
                var date = birthdayDate(currentDate);
                if (response.code == 200) {
                    // remove all students
                    addStudentID = [];
                    // jQuery("#preloader").remove();
                    // $('#saveClassRoomAttendance').prop('disabled', false);
                    // remove dashboard temporary session
                    sessionStorage.removeItem("classroom_attendance");
                    if (dataSetNew.length > 0) {
                        $(".classRoomHideSHow").show("slow");
                        listMode(dataSetNew, date);
                        // list mode start
                        // set value in list mode
                        $("#listModeClassID").val(classObj.classID);
                        $("#listModeSectionID").val(classObj.sectionID);
                        $("#listModeSemesterID").val(classObj.semesterID);
                        $("#listModeSessionID").val(classObj.sessionID);
                        $("#listModeSelectedDate").val(convertDigitIn(classObj.classDate));
                        // list mode end
                    } else {
                        $(".classRoomHideSHow").hide();
                        toastr.info('No students are available');
                    }

                    $("#overlay").fadeOut(300);
                } else {
                    toastr.error(response.message);
                    $("#overlay").fadeOut(300);
                }
            }
        });
    }
    // function list mode
    function listMode(dataSetNew, date) {
        // clear old data in datatable
        $('#listModeClassRoom').DataTable().clear().destroy();
        $('#listModeClassRoom td').empty();

        listTable = $('#listModeClassRoom').DataTable({
            processing: true,
            bDestroy: true,
            info: true,
            // scrollY: '500px',
            // scrollCollapse: true,
            paging: false,
            dom: 'lBfrtip',
            // dom: "<'row'<'col-sm-2'l><'col-sm-2'B><'col-sm-8'f>>" +
            //     "<'row'<'col-sm-12'tr>>" +
            //     "<'row'<'col-sm-5'i><'col-sm-7'p>>",

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
                        doc.pageMargins = [50, 50, 50, 50];
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

                        doc['footer'] = (function (page, pages) {
                            return {
                                columns: [
                                    { alignment: 'left', text: [footer_txt], width: 400 },
                                    {
                                        // This is the right column
                                        alignment: 'right',
                                        text: ['page ', { text: page.toString() }, ' of ', { text: pages.toString() }],
                                        width: 100

                                    }
                                ],
                                margin: [50, 0, 0, 0]
                            }
                        });

                    }

                }
            ],
            data: dataSetNew,
            "pageLength": 10,
            "aLengthMenu": [
                [5, 10, 25, 50, -1],
                [5, 10, 25, 50, "All"]
            ],
            columns: [
                {
                    data: 'student_id'
                },
                {
                    data: 'name'
                },
                {
                    data: 'att_status'
                },
                {
                    data: 'att_remark'
                },
                {
                    data: 'reasons'
                },
                {
                    data: 'student_behaviour'
                },
                {
                    data: 'classroom_behaviour'
                }
            ],
            columnDefs: [
                {
                    "targets": 0,
                    "width": "10%",
                    "render": function (data, type, row, meta) {
                        return meta.row + 1;
                    }
                },
                {
                    "width": "15%",
                    "targets": 1,
                    "className": "table-user",
                    "render": function (data, type, row, meta) {
                        var birthday = birthdayDate(row.birthday);
                        var bd = "";
                        if (birthday == date) {
                            bd = '<i class="fas fa-birthday-cake"></i>';
                        }
                        var img = "";
                        if (row.photo) {
                            img = studentImg + '/' + row.photo;
                        } else {
                            img = defaultImg;
                        }
                        var first_name = '<input type="hidden" name="attendance[' + meta.row + '][attendance_id]" value="' + row.att_id + '">' +
                            '<input type="hidden" name="attendance[' + meta.row + '][student_id]" value="' + row.student_id + '">' +
                            '<input type="hidden" name="attendance[' + meta.row + '][name]" value="' + row.name + '">' +
                            '<img src="' + img + '" class="mr-2 rounded-circle">' +
                            '<a href="javascript:void(0);" class="text-body font-weight-semibold mr-2 width ellipse two-lines">' + data + '</a>' + bd;
                        return first_name;
                    }
                },
                {
                    "targets": 2,
                    "width": "20%",
                    "render": function (data, type, row, meta) {
                        // current_old_att_status
                        var status = "";
                        if (row.att_status) {
                            status = row.att_status;
                        } else if (row.current_old_att_status) {
                            status = row.current_old_att_status;
                        } else if (row.taken_leave_status) {
                            status = "absent";
                        } else {
                            status = row.att_status;
                        }
                        var att_status = '<select class="form-control changeAttendanceSelect list-mode-table" data-id="' + row.student_id + '" id="attendance' + row.student_id + '" data-style="btn-outline-success" name="attendance[' + meta.row + '][att_status]">' +
                            '<option value="">' + choose + '</option>' +
                            '<option value="present" ' + (status == "present" ? "selected" : "selected") + '>' + present_lang + '</option>' +
                            '<option value="absent" ' + (status == "absent" ? "selected" : "") + '>' + absent_lang + '</option>' +
                            '<option value="late" ' + (status == "late" ? "selected" : "") + '>' + late_lang + '</option>' +
                            '<option value="excused" ' + (status == "excused" ? "selected" : "") + '>' + excused_lang + '</option>' +
                            '</select>';
                        return att_status;
                    }
                },
                {
                    "targets": 3,
                    "width": "10%",
                    "render": function (data, type, row, meta) {

                        var att_remark = '<textarea style="display:none;" class="addRemarks" data-id="' + row.student_id + '" id="addRemarks' + row.student_id + '" name="attendance[' + meta.row + '][att_remark]">' + (row.att_remark !== "null" ? row.att_remark : "") + '</textarea>' +
                            '<button type="button" data-id="' + row.student_id + '" class="btn btn-outline-info waves-effect waves-light list-mode-btn" data-toggle="modal" data-target="#stuRemarksPopup" id="editRemarksStudent">' + add_remarks + '</button>';
                        return att_remark;
                    }
                },
                {
                    "targets": 4,
                    "width": "20%",
                    "render": function (data, type, row, meta) {
                        if (row.att_status != "present" || row.taken_leave_status != "present" || row.current_old_att_status != "present") {
                            onLoadReasons(row, meta);
                        }
                        var reasons = '<select id="reasons' + row.student_id + '" class="form-control list-mode-table" name="attendance[' + meta.row + '][reasons]">' +
                            '<option value="">' + choose + '</option>' +
                            '</select>';
                        return reasons;
                    }
                },
                {
                    "targets": 5,
                    "width": "15%",
                    "render": function (data, type, row, meta) {
                        var matches = (row.student_behaviour) ? row.student_behaviour : "";
                        var student_behaviour = '<div class="row">' +
                            '<div class="checkRadioBtn">' +
                            '<input type="checkbox" value="Engaging" title="Engaging    " ' + (has = "Engaging".split(',').every(Set.prototype.has, new Set(matches.split(','))) == true ? "checked" : "") + ' name="attendance[' + meta.row + '][student_behaviour][]">' +
                            '<label for="Engaging">' +
                            '<svg xmlns="http://www.w3.org/2000/svg" id="Layer_2" viewBox="0 0 138.1 158.64"><g id="outline"><g><path d="M52.62,151.16s-24.9-17.03-36.71-53.43l-11.22-14.88s-3.22-19.58,13.75-16.58c0,0,13.59,11.9,16.63,11.12,0,0,.44,6.58,.45-14.72l.23-42.02s2.24-11.45,16.87-5.28c0,0,7.95-3.25,7.95,6.67,0,0-.7-26.01,20.72-16.05,0,0,4.56,7.5,4.37,13.91,0,0,4.66-13.32,17.61-9.11,0,0,7.11,2.33,7.11,19.28,0,0,6.78-6.28,15.26-5.03,0,0,9.75-2.19,9.7,19.46v57.13s-12.85,50.6-40.47,49.49l-42.24,.02Z" fill="#ffeee4"/><path d="M110.37,37.51c0-6.88,5.57-12.45,12.45-12.45h0c6.88,0,12.45,5.57,12.45,12.45v57.22s.12,54.51-51.54,59.25" fill="none" stroke="#231f20" stroke-linecap="round" stroke-linejoin="round" stroke-width="5.67"/><path d="M60.56,26.98c0-6.88-5.57-12.45-12.45-12.45s-12.45,5.57-12.45,12.45c0,10.07-.18,15.2-.2,25.28-.01,5.81,.41,11.61,.3,17.42-.03,1.29,.47,6.8-.7,7.72-1.71,1.32-9.55-7.48-11.59-8.93-3.62-2.59-8.27-3.88-12.6-2.4-6.83,2.33-9.94,10.32-6.84,16.72,2.29,4.75,6.29,8.15,9.63,12.11,5.03,5.97,6.73,13.19,9.62,20.23,7.48,18.18,20.67,34.08,40.52,38.84" fill="none" stroke="#231f20" stroke-linecap="round" stroke-linejoin="round" stroke-width="5.67"/><path d="M75.84,89.82s7.15,14.44,15.78,0" fill="none" stroke="#231f20" stroke-linecap="round" stroke-linejoin="round" stroke-width="4.25"/><circle cx="61.29" cy="79.46" r="5.05" fill="#231f20"/><circle cx="103.7" cy="79.46" r="5.05" fill="#231f20"/><ellipse cx="114.44" cy="90.96" rx="11.18" ry="3.97" fill="#faab74"/><ellipse cx="52.62" cy="90.96" rx="11.18" ry="3.97" fill="#faab74"/><path d="M85.47,22.05c0-6.88,5.57-12.45,12.45-12.45h0c6.88,0,12.45,5.57,12.45,12.45V60.51" fill="none" stroke="#71c6cc" stroke-linecap="round" stroke-linejoin="round" stroke-width="5.67"/><path d="M60.56,51.13V15.29c0-6.88,5.57-12.45,12.45-12.45h0c6.88,0,12.45,5.57,12.45,12.45V51.13" fill="none" stroke="#2f338c" stroke-linecap="round" stroke-linejoin="round" stroke-width="5.67"/><circle cx="73.62" cy="154.9" r="3.74" fill="#e9d52b"/></g></g></svg>' +
                            '</label>' +
                            '</div>' +
                            '<div class="checkRadioBtn">' +
                            '<input type="checkbox" value="Hyperactive" title="Hyperactive" ' + (has = "Hyperactive".split(',').every(Set.prototype.has, new Set(matches.split(','))) == true ? "checked" : "") + ' name="attendance[' + meta.row + '][student_behaviour][]">' +
                            '<label for="Hyperactive">' +
                            '<svg xmlns="http://www.w3.org/2000/svg" id="Layer_2" viewBox="0 0 128.12 157.72"><g id="outline"><g><path d="M19.51,101.72s7.42,48.85,37.17,49.14l25.75,1.88s38.54-3.31,42.76-58.01V51.13s1.79-17.08-18.99-10.43l-5.91,4.28-.35-25.87s-9.91-19.8-24.55-1.76c0,0-1.27-20.95-21.05-11.06,0,0-3.5,5.83-4.37,12.22,0,0-8.83-8.64-18.88-1.87,0,0-4.26,1.53-5.98,8.41l.34,38.84s-.91,11.15-5.57,8.91c0,0,14.73,7.3,14.13,13.23,0,0-.47,18.61-14.5,15.68Z" fill="#ca9d83"/><rect x="4.5" y="68.01" width="24.64" height="36.04" rx="12.32" ry="12.32" transform="translate(-61.45 46.56) rotate(-52.17)" fill="#ca9d83"/><ellipse cx="36.34" cy="94.72" rx="11.18" ry="3.97" transform="translate(-5.84 2.45) rotate(-3.58)" fill="#fcc097"/><path d="M75.39,22.05c0-6.88,5.57-12.45,12.45-12.45h0c6.88,0,12.45,5.57,12.45,12.45V60.51" fill="none" stroke="#71c6cc" stroke-linecap="round" stroke-linejoin="round" stroke-width="5.67"/><line x1="125.19" y1="94.72" x2="125.19" y2="62.67" fill="none" stroke="#231f20" stroke-linecap="round" stroke-linejoin="round" stroke-width="5.67"/><path d="M50.49,26.98c0-6.88-5.57-12.45-12.45-12.45s-12.45,5.57-12.45,12.45c0,10.07-.18,15.2-.2,25.27,0,5.14,.02,10.28,.14,15.41,0,0-.63,5.5-8,3.56" fill="none" stroke="#231f20" stroke-linecap="round" stroke-linejoin="round" stroke-width="5.67"/><ellipse cx="100.29" cy="94.72" rx="3.97" ry="11.18" transform="translate(-.63 188.77) rotate(-86.35)" fill="#fcc097"/><rect x="100.29" y="39.95" width="24.9" height="34.33" rx="12.45" ry="12.45" fill="none" stroke="#231f20" stroke-linecap="round" stroke-linejoin="round" stroke-width="5.67"/><polyline points="45.84 74.28 53.39 81.05 44.3 85.7" fill="none" stroke="#231f20" stroke-linecap="round" stroke-linejoin="round" stroke-width="4.25"/><polyline points="93.32 74.4 86.52 81.93 96.06 85.58" fill="none" stroke="#231f20" stroke-linecap="round" stroke-linejoin="round" stroke-width="4.25"/><path d="M64.58,89.64l13.49-.19s1.8,9.55-4.57,10.38c0,0-10.77,2.24-8.92-10.19Z" fill="none" stroke="#231f20" stroke-linecap="round" stroke-linejoin="round" stroke-width="4.25"/><path d="M125.19,94.72s4.15,49.12-42.68,59.25" fill="none" stroke="#231f20" stroke-linecap="round" stroke-linejoin="round" stroke-width="5.67"/><path d="M62.61,152.73c-12.46-1.11-23.94-6.67-31.75-16.55-4.91-6.21-6.77-13.85-9.57-21.1-2.76-7.14-6.92-13.62-12.01-19.31" fill="none" stroke="#231f20" stroke-linecap="round" stroke-linejoin="round" stroke-width="5.67"/><path d="M50.49,51.13V15.29c0-6.88,5.57-12.45,12.45-12.45h0c6.88,0,12.45,5.57,12.45,12.45V51.13" fill="none" stroke="#2f338c" stroke-linecap="round" stroke-linejoin="round" stroke-width="5.67"/><circle cx="72.37" cy="153.97" r="3.74" fill="#e9d52b"/><polygon points="118.11 59.62 114.3 59.47 112.02 62.53 110.98 58.86 107.37 57.64 110.54 55.52 110.59 51.7 113.58 54.06 117.23 52.93 115.91 56.51 118.11 59.62" fill="none" stroke="#231f20" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.27"/><polygon points="24.88 90.62 21.07 90.48 18.79 93.53 17.75 89.87 14.14 88.64 17.31 86.52 17.36 82.71 20.35 85.07 23.99 83.93 22.68 87.51 24.88 90.62" fill="none" stroke="#231f20" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.27"/></g></g></svg>' +
                            '</label>' +
                            '</div>' +
                            '<div class="checkRadioBtn">' +
                            '<input type="checkbox" value="Quiet" title="Quiet" ' + (has = "Quiet".split(',').every(Set.prototype.has, new Set(matches.split(','))) == true ? "checked" : "") + ' name="attendance[' + meta.row + '][student_behaviour][]">' +
                            '<label for="Quiet">' +
                            '<svg xmlns="http://www.w3.org/2000/svg" id="Layer_2" viewBox="0 0 130.25 156.47"><g id="outline"><g><path d="M50.19,151.14s-30.5-5.51-44.26-43.7L2.21,62.67s1.58-11.69,18.55-8.7c0,0,5.01,7.33,7.04,11.77,0,0-.17,18.23-.15-3.07l.23-42.02s2.24-11.45,16.87-5.28c0,0,7.95-3.25,7.95,6.67,0,0-.7-26.01,20.72-16.05,0,0,4.56,7.5,4.37,13.91,0,0,4.66-13.32,17.61-9.11,0,0,7.11,2.33,7.11,19.28,0,0,6.78-6.28,15.26-5.03,0,0,9.75-2.19,9.7,19.46v57.13s-12.85,50.6-40.47,49.49H50.19Z" fill="#fdd3be"/><path d="M102.51,37.51c0-6.88,5.57-12.45,12.45-12.45h0c6.88,0,12.45,5.57,12.45,12.45v57.22s1.29,49.85-47.42,57.48" fill="none" stroke="#231f20" stroke-linecap="round" stroke-linejoin="round" stroke-width="5.67"/><path d="M52.71,26.98c0-6.88-5.57-12.45-12.45-12.45s-12.45,5.57-12.45,12.45c0,10.07-.18,15.2-.2,25.28l.2,13.49c0-6.88-5.57-12.45-12.45-12.45s-12.45,5.57-12.45,12.45c0,17.61-1.16,33.95,6.17,50.43,5.08,11.42,12.67,22.15,23.41,28.85,7.8,4.86,16.84,7.18,26,7.17" fill="none" stroke="#231f20" stroke-linecap="round" stroke-linejoin="round" stroke-width="5.67"/><circle cx="43.98" cy="83.7" r="5.05" fill="#231f20"/><circle cx="88.93" cy="83.7" r="5.05" fill="#231f20"/><ellipse cx="102.64" cy="94.72" rx="11.18" ry="3.97" fill="#faab74"/><ellipse cx="31.05" cy="94.84" rx="11.18" ry="3.97" fill="#faab74"/><line x1="55.11" y1="97.62" x2="78.55" y2="97.62" fill="none" stroke="#231f20" stroke-linecap="round" stroke-linejoin="round" stroke-width="4.25"/><line x1="57.75" y1="92.69" x2="57.75" y2="102.55" fill="none" stroke="#231f20" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.13"/><line x1="63.8" y1="92.69" x2="63.8" y2="102.55" fill="none" stroke="#231f20" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.13"/><line x1="69.86" y1="92.69" x2="69.86" y2="102.55" fill="none" stroke="#231f20" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.13"/><line x1="75.91" y1="92.69" x2="75.91" y2="102.55" fill="none" stroke="#231f20" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.13"/><line x1="27.68" y1="58.78" x2="27.68" y2="79.99" fill="none" stroke="#231f20" stroke-linecap="round" stroke-linejoin="round" stroke-width="5.67"/><circle cx="69.86" cy="152.73" r="3.74" fill="#e9d52b"/><path d="M77.61,22.05c0-6.88,5.57-12.45,12.45-12.45h0c6.88,0,12.45,5.57,12.45,12.45V60.51" fill="none" stroke="#71c6cc" stroke-linecap="round" stroke-linejoin="round" stroke-width="5.67"/><path d="M52.71,51.13V15.29c0-6.88,5.57-12.45,12.45-12.45h0c6.88,0,12.45,5.57,12.45,12.45V51.13" fill="none" stroke="#2f338c" stroke-linecap="round" stroke-linejoin="round" stroke-width="5.67"/></g></g></svg>' +
                            '</label>' +
                            '</div>' +
                            '<div class="checkRadioBtn">' +
                            '<input type="checkbox" value="Sleepy" title="Sleepy" ' + (has = "Sleepy".split(',').every(Set.prototype.has, new Set(matches.split(','))) == true ? "checked" : "") + ' name="attendance[' + meta.row + '][student_behaviour][]">' +
                            '<label for="Sleepy">' +
                            '<svg xmlns="http://www.w3.org/2000/svg" id="Layer_2" viewBox="0 0 130.96 157.72"><g id="outline"><g><path d="M108.86,101.63s-7.42,48.85-37.17,49.14l-25.75,1.88S7.4,149.34,3.18,94.64V51.05s-1.79-17.08,18.99-10.43l5.91,4.28,.35-25.87s9.91-19.8,24.55-1.76c0,0,1.27-20.95,21.05-11.06,0,0,3.5,5.83,4.37,12.22,0,0,8.83-8.64,18.88-1.87,0,0,4.26,1.53,5.98,8.41l-.34,38.84s.91,11.15,5.57,8.91c0,0-14.73,7.3-14.13,13.23,0,0,.47,18.61,14.5,15.68Z" fill="#fddfd2"/><rect x="98.98" y="68.01" width="24.64" height="36.04" rx="12.32" ry="12.32" transform="translate(111.6 226.71) rotate(-127.83)" fill="#fddfd2"/><ellipse cx="27.83" cy="98" rx="11.18" ry="3.97" transform="translate(-6.06 1.93) rotate(-3.58)" fill="#faab74"/><path d="M52.73,22.05c0-6.88-5.57-12.45-12.45-12.45h0c-6.88,0-12.45,5.57-12.45,12.45V60.51" fill="none" stroke="#71c6cc" stroke-linecap="round" stroke-linejoin="round" stroke-width="5.67"/><line x1="2.93" y1="94.72" x2="2.93" y2="62.67" fill="none" stroke="#231f20" stroke-linecap="round" stroke-linejoin="round" stroke-width="5.67"/><path d="M77.63,26.98c0-6.88,5.57-12.45,12.45-12.45s12.45,5.57,12.45,12.45c0,10.07,.18,15.2,.2,25.27,0,5.14-.02,10.28-.14,15.41,0,0,.63,5.5,8,3.56" fill="none" stroke="#231f20" stroke-linecap="round" stroke-linejoin="round" stroke-width="5.67"/><ellipse cx="103.13" cy="104.68" rx="3.97" ry="11.18" transform="translate(-7.92 200.92) rotate(-86.35)" fill="#faab74"/><rect x="98.98" y="68.01" width="24.64" height="36.04" rx="12.32" ry="12.32" transform="translate(111.6 226.71) rotate(-127.83)" fill="none" stroke="#231f20" stroke-linecap="round" stroke-linejoin="round" stroke-width="5.67"/><path d="M27.83,61.83v-9.43c0-6.88-5.57-12.45-12.45-12.45h0c-6.88,0-12.45,5.57-12.45,12.45v9.43" fill="none" stroke="#231f20" stroke-linecap="round" stroke-linejoin="round" stroke-width="5.67"/><path d="M2.93,94.72s-4.15,49.12,42.68,59.25" fill="none" stroke="#231f20" stroke-linecap="round" stroke-linejoin="round" stroke-width="5.67"/><path d="M65.52,152.73c12.46-1.11,23.94-6.67,31.75-16.55,4.91-6.21,6.77-13.85,9.57-21.1,2.76-7.14,6.92-13.62,12.01-19.31" fill="none" stroke="#231f20" stroke-linecap="round" stroke-linejoin="round" stroke-width="5.67"/><path d="M77.63,51.13V15.29c0-6.88-5.57-12.45-12.45-12.45h0c-6.88,0-12.45,5.57-12.45,12.45V51.13" fill="none" stroke="#2f338c" stroke-linecap="round" stroke-linejoin="round" stroke-width="5.67"/><circle cx="55.75" cy="153.97" r="3.74" fill="#e9d52b"/><path d="M37.72,82.37s7.15,14.44,15.78,0" fill="none" stroke="#231f20" stroke-linecap="round" stroke-linejoin="round" stroke-width="4.25"/><path d="M81.22,82.37s7.15,14.44,15.78,0" fill="none" stroke="#231f20" stroke-linecap="round" stroke-linejoin="round" stroke-width="4.25"/><path d="M62.56,96.29h12.45s0,8.39-7.26,8.39c0,0-5.21-1.36-5.19-8.39Z" fill="none" stroke="#231f20" stroke-linecap="round" stroke-linejoin="round" stroke-width="4.25"/><path d="M67.18,100.49c-2.31-.02-5.29,3.5-6.34,5.24-.58,.97-1.2,2.31-.54,3.4,1.05,1.73,4.02,1.61,4.9-.29,.4-.85-.03-1.54-.15-2.38-.1-.69,1.05-5.98,2.13-5.98Z" fill="#fff"/></g></g></svg>' +
                            '</label>' +
                            '</div>' +
                            '<div class="checkRadioBtn">' +
                            '<input type="checkbox" value="Uninterested" title="Uninterested" ' + (has = "Uninterested".split(',').every(Set.prototype.has, new Set(matches.split(','))) == true ? "checked" : "") + ' name="attendance[' + meta.row + '][student_behaviour][]">' +
                            '<label for="Uninterested">' +
                            '<svg xmlns="http://www.w3.org/2000/svg" id="Layer_2" viewBox="0 0 130.25 155.94"><g id="outline"><g><path d="M80.06,151.14s30.5-5.51,44.26-43.7l3.72-44.77s-1.58-11.69-18.55-8.7c0,0-5.01,7.33-7.04,11.77,0,0,.17,18.23,.15-3.07l-.23-42.02s-2.24-11.45-16.87-5.28c0,0-7.95-3.25-7.95,6.67,0,0,.7-26.01-20.72-16.05,0,0-4.56,7.5-4.37,13.91,0,0-4.66-13.32-17.61-9.11,0,0-11.52,5.49-8.3,32.33,0,0-6.53-6.54-15-5.28,0,0-3.61,1.84-8.76,6.66v57.13s12.85,50.6,40.47,49.49h36.81Z" fill="#fee9dd"/><path d="M27.74,49.73c0-6.88-5.57-12.45-12.45-12.45h0c-6.88,0-12.45,5.57-12.45,12.45v44.99s-1.29,49.85,47.42,57.48" fill="none" stroke="#231f20" stroke-linecap="round" stroke-linejoin="round" stroke-width="5.67"/><path d="M77.54,26.98c0-6.88,5.57-12.45,12.45-12.45s12.45,5.57,12.45,12.45c0,10.07,.18,15.2,.2,25.28l-.2,13.49c0-6.88,5.57-12.45,12.45-12.45,6.88,0,12.45,5.57,12.45,12.45,0,17.61,1.16,33.95-6.17,50.43-5.08,11.42-12.67,22.15-23.41,28.85-7.8,4.86-16.84,7.18-26,7.17" fill="none" stroke="#231f20" stroke-linecap="round" stroke-linejoin="round" stroke-width="5.67"/><ellipse cx="96.32" cy="93.91" rx="11.18" ry="3.97" fill="#faab74"/><ellipse cx="24.73" cy="94.03" rx="11.18" ry="3.97" fill="#faab74"/><line x1="37.08" y1="81.75" x2="46.39" y2="81.75" fill="none" stroke="#231f20" stroke-linecap="round" stroke-linejoin="round" stroke-width="4.25"/><line x1="78.46" y1="81.75" x2="87.77" y2="81.75" fill="none" stroke="#231f20" stroke-linecap="round" stroke-linejoin="round" stroke-width="4.25"/><line x1="102.57" y1="58.78" x2="102.57" y2="79.99" fill="none" stroke="#231f20" stroke-linecap="round" stroke-linejoin="round" stroke-width="5.67"/><circle cx="61.26" cy="152.2" r="3.74" fill="#e9d52b"/><path d="M52.64,22.05c0-6.88-5.57-12.45-12.45-12.45h0c-6.88,0-12.45,5.57-12.45,12.45V60.51" fill="none" stroke="#71c6cc" stroke-linecap="round" stroke-linejoin="round" stroke-width="5.67"/><path d="M77.54,51.13V15.29c0-6.88-5.57-12.45-12.45-12.45h0c-6.88,0-12.45,5.57-12.45,12.45V51.13" fill="none" stroke="#2f338c" stroke-linecap="round" stroke-linejoin="round" stroke-width="5.67"/><path d="M70.15,97.11s-7.15-14.44-15.78,0" fill="none" stroke="#231f20" stroke-linecap="round" stroke-linejoin="round" stroke-width="4.25"/></g></g></svg>' +
                            '</label>' +
                            '</div>' +
                            '</div>';
                        return student_behaviour;
                    }
                },
                {
                    "targets": 6,
                    "width": "10%",
                    "render": function (data, type, row, meta) {

                        var class_beh_matches = (row.classroom_behaviour) ? row.classroom_behaviour : "";
                        var classroom_behaviour = '<div class="row">' +
                            '<div class="checkRadioBtn">' +
                            '<input type="checkbox"  value="likes" title="Like" ' + (likdis = "likes".split(',').every(Set.prototype.has, new Set(class_beh_matches.split(','))) == true ? "checked" : "") + ' name="attendance[' + meta.row + '][classroom_behaviour][]">' +
                            '<label for="like">' +
                            '<i class="fe-thumbs-up"></i>' +
                            '</label>' +
                            '</div>' +
                            '<div class="checkRadioBtn1">' +
                            '<input type="checkbox" value="dislikes" title="Dislike" ' + (likdis = "dislikes".split(',').every(Set.prototype.has, new Set(class_beh_matches.split(','))) == true ? "checked" : "") + ' name="attendance[' + meta.row + '][classroom_behaviour][]">' +
                            '<label for="dislike">' +
                            '<i class="fe-thumbs-down"></i>' +
                            '</label>' +
                            '</div>' +
                            '</div>';


                        return classroom_behaviour;
                    }
                }
            ]
        }).on('draw', function () {
        });
    }
    //
    $('#addListMode').on('submit', function (e) {
        e.preventDefault();
        var form = this;
        // $('#saveClassRoomAttendance').prop('disabled', true);

        $.ajax({
            url: $(form).attr('action'),
            method: $(form).attr('method'),
            data: new FormData(form),
            processData: false,
            dataType: 'json',
            contentType: false,
            success: function (response) {
                if (response.code == 200) {
                    toastr.success(response.message);

                    
                    var classID = $("#changeClassName").val();
                    var sectionID = $("#sectionID").val();
                    var classDate = $("#classDate").val();
                    var semesterID = $("#semester_id").val();
                    var sessionID = $("#session_id").val();

                    var formData = new FormData();
                    formData.append('branch_id', branchID);
                    formData.append('class_id', classID);
                    formData.append('section_id', sectionID);
                    formData.append('semester_id', semesterID);
                    formData.append('session_id', sessionID);
                    formData.append('date', convertDigitIn(classDate));
                    $("#attendaceTakenSts").empty();
                    var taken = '<p class="badge bg-soft-success text-success" style="padding: 1.00em 3.4em;font-size: 85%;">Taken</p>';
                    $("#attendaceTakenSts").append(taken);

                } else {
                    toastr.error(response.message);
                }
            }
        });
    });

    // add remarks model
    $('#stuRemarksPopup').on('show.bs.modal', e => {
        $("#student_remarks").focus();
        var $button = $(e.relatedTarget);
        var studentID = $button.attr('data-id');
        var studentRemarks = $button.closest('td').find('textarea').val();
        var checknullRemarks = (studentRemarks !== "null") ? studentRemarks : "";

        $("#studenetID").val(studentID);
        $("#student_remarks").val(checknullRemarks);
    });
    // save studentRemarksSave
    $('#studentRemarksSave').on('click', function () {
        var studenetID = $('#studenetID').val();
        var student_remarks = $('#student_remarks').val();
        $('#addRemarks' + studenetID).val(student_remarks);
        $('#stuRemarksPopup').modal('hide');
    });


    $('#changeAttendance').on('change', function () {
        $(".changeAttendanceSelect").val($(this).val());
    });
    // change student attendance reasons
    $(document).on('change', '.changeAttendanceSelect', function () {
        var studenetID = $(this).data('id');
        var attendanceType = $('#attendance' + studenetID).val();
        $('#reasons' + studenetID).empty();
        $('#reasons' + studenetID).append('<option value="">' + choose + '</option>');
        $.post(getAbsentLateExcuse, {
            token: token,
            branch_id: branchID,
            attendance_type: attendanceType
        }, function (res) {
            if (res.code == 200) {
                $.each(res.data, function (key, val) {
                    $('#reasons' + studenetID).append('<option value="' + val.id + '">' + val.name + '</option>');
                });
            }
        }, 'json');
    });
    // onLoadReasons
    function onLoadReasons(row, meta) {
        var studenetID = row.student_id;
        var attendanceType = "";
        if (row.att_status) {
            attendanceType = row.att_status;
        } else if (row.current_old_att_status) {
            attendanceType = row.current_old_att_status;
        } else if (row.taken_leave_status) {
            attendanceType = "absent";
        } else {
            attendanceType = row.att_status;
        }
        $('#reasons' + studenetID).empty();
        $('#reasons' + studenetID).append('<option value="">' + choose + '</option>');
        if (attendanceType) {
            $.post(getAbsentLateExcuse, {
                token: token,
                branch_id: branchID,
                attendance_type: attendanceType
            }, function (res) {
                if (res.code == 200) {
                    // var tempStudentID = studenetID;
                    var existID = addStudentID.includes(studenetID);
                    addStudentID.push(studenetID);
                    if (existID === false) {
                        $.each(res.data, function (key, val) {
                            $('#reasons' + studenetID).append('<option value="' + val.id + '" ' + (row.reasons == val.id ? "selected" : "") + '>' + val.name + '</option>');
                        });
                    }
                }
            }, 'json');
        }

    }

    // format dd mm yy
    function formatDate(date) {
        var d = new Date(date),
            month = '' + (d.getMonth() + 1),
            day = '' + d.getDate(),
            year = d.getFullYear();

        if (month.length < 2)
            month = '0' + month;
        if (day.length < 2)
            day = '0' + day;

        return [day, month, year].join('-');
    }

    function birthdayDate(date) {
        var d = new Date(date),
            month = '' + (d.getMonth() + 1),
            day = '' + d.getDate();

        if (month.length < 2)
            month = '0' + month;
        if (day.length < 2)
            day = '0' + day;
        return [day, month].join('-');
    }


});