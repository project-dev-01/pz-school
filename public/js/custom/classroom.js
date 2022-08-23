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
    var classroom_details = sessionStorage.getItem('classroom_details');
    if (classroom_details) {
        var classroomDetails = JSON.parse(classroom_details);
        if (classroomDetails.length == 1) {
            var classID, sectionID, subjectID, classDate, sectionName, subjectName;
            classroomDetails.forEach(function (user) {
                classID = user.class_id;
                sectionID = user.section_id;
                subjectID = user.subject_id;
                classDate = user.date;
                sectionName = user.section_name;
                subjectName = user.subject_name;
            });
            var format_date = formatDate(classDate);
            var classObj = {
                classID: classID,
                sectionID: sectionID,
                subjectID: subjectID,
                classDate: format_date
            };
            $('#changeClassName').val(classID);
            $("#classroomFilter").find("#sectionID").append('<option selected value="' + sectionID + '">' + sectionName + '</option>');
            $("#classroomFilter").find("#subjectID").append('<option selected value="' + subjectID + '">' + subjectName + '</option>');
            $('#classDate').val(format_date);

            var formData = new FormData();
            formData.append('token', token);
            formData.append('branch_id', branchID);
            formData.append('class_id', classID);
            formData.append('section_id', sectionID);
            formData.append('subject_id', subjectID);
            formData.append('date', convertDigitIn(format_date));
            // list mode
            listModeAjax(formData, classObj);
            // daily report
            getDailyReportRemarksAjax(formData);
            // widget Show
            widgetShow(formData);
            // get Short test
            getShortTestData(formData);
            // student leave apply
            studentleave(formData);
        }
    }
    // onload show start
    $(".classRoomHideSHow").hide();

    $("#classDate").datepicker({
        dateFormat: 'dd-mm-yy',
        changeMonth: true,
        changeYear: true,
        autoclose: true,
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
        $("#classroomFilter").find("#sectionID").append('<option value="">Select Section</option>');
        $("#classroomFilter").find("#subjectID").empty();
        $("#classroomFilter").find("#subjectID").append('<option value="">Select Subject</option>');

        $.post(teacherSectionUrl, { token: token, branch_id: branchID, teacher_id: ref_user_id, class_id: class_id }, function (res) {
            if (res.code == 200) {
                $.each(res.data, function (key, val) {
                    $("#classroomFilter").find("#sectionID").append('<option value="' + val.section_id + '">' + val.section_name + '</option>');
                });
            }
        }, 'json');
    });
    // change section
    $('#sectionID').on('change', function () {
        var section_id = $(this).val();
        var class_id = $("#changeClassName").val();
        $("#classroomFilter").find("#subjectID").empty();
        $("#classroomFilter").find("#subjectID").append('<option value="">Select Subject</option>');
        $.post(teacherSubjectUrl, {
            token: token,
            branch_id: branchID,
            teacher_id: ref_user_id,
            class_id: class_id,
            section_id: section_id
        }, function (res) {
            if (res.code == 200) {
                $.each(res.data, function (key, val) {
                    $("#classroomFilter").find("#subjectID").append('<option value="' + val.subject_id + '">' + val.subject_name + '</option>');
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
            subject_id: "required",
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
            var subjectID = $("#subjectID").val();
            var classDate = $("#classDate").val();
            var semesterID = $("#semester_id").val();
            var sessionID = $("#session_id").val();

            var classObj = {
                classID: classID,
                sectionID: sectionID,
                subjectID: subjectID,
                classDate: classDate,
                semesterID: semesterID,
                sessionID: sessionID
            };
            var formData = new FormData();
            formData.append('token', token);
            formData.append('branch_id', branchID);
            formData.append('class_id', classID);
            formData.append('section_id', sectionID);
            formData.append('subject_id', subjectID);
            formData.append('semester_id', semesterID);
            formData.append('session_id', sessionID);
            formData.append('date', convertDigitIn(classDate));

            // list mode
            listModeAjax(formData, classObj);
            // student leave apply
            studentleave(formData);
            // daily report
            getDailyReportRemarksAjax(formData);
            // widget Show
            widgetShow(formData);
            // get Short test
            getShortTestData(formData);

            //  $("#overlay").fadeOut(300);
        }
    });

    // function
    function getDailyReportRemarksAjax(formData) {

        $.ajax({
            url: getDailyReportRemarks,
            method: "post",
            data: formData,
            processData: false,
            dataType: 'json',
            contentType: false,
            success: function (response) {
                if (response.code == 200) {
                    var dataSetNew = response.data.get_daily_report_remarks;
                    var getDailyReport = response.data.get_daily_report;
                    if (getDailyReport) {
                        var daily_report = (getDailyReport.report != null ? getDailyReport.report : "");
                        $("#daily_report").val(daily_report);
                    } else {
                        $("#daily_report").val('');
                    }
                    getReportRemarks(dataSetNew);
                } else {
                    toastr.error(response.message);
                }
            }
        });
    }
    // functionListModeAJax
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

                // console.log("response")
                // console.log(response)
                // console.log(response.data.get_student_attendence)
                // console.log(response.data.taken_attentance_status.status)
                var dataSetNew = response.data.get_student_attendence;
                if (response.data.taken_attentance_status) {
                    var taken_attentance_status = response.data.taken_attentance_status.status;
                    if (taken_attentance_status) {
                        $("#attendaceTakenSts").html("Taken");
                    } else {
                        $("#attendaceTakenSts").html("Untaken");
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
                    sessionStorage.removeItem("classroom_details");
                    $('#layoutModeGrid').empty();
                    var layoutModeGrid = "";
                    if (dataSetNew.length > 0) {
                        $(".classRoomHideSHow").show("slow");
                        listMode(dataSetNew, date);
                        layoutModeGrid += '<div class="row">';
                        dataSetNew.forEach(function (res) {
                            // layout mode div start
                            layoutModeGrid += layoutMode(res, date);
                            // layout mode div end
                            // list mode start

                            // set value in list mode
                            $("#listModeClassID").val(classObj.classID);
                            $("#listModeSectionID").val(classObj.sectionID);
                            $("#listModeSubjectID").val(classObj.subjectID);
                            $("#listModeSemesterID").val(classObj.semesterID);
                            $("#listModeSessionID").val(classObj.sessionID);
                            $("#listModeSelectedDate").val(convertDigitIn(classObj.classDate));
                            // set value in short test
                            $("#shortTestClassID").val(classObj.classID);
                            $("#shortTestSectionID").val(classObj.sectionID);
                            $("#shortTestSubjectID").val(classObj.subjectID);
                            $("#shortTestSemesterID").val(classObj.semesterID);
                            $("#shortTestSessionID").val(classObj.sessionID);
                            $("#shortTestSelectedDate").val(convertDigitIn(classObj.classDate));
                            // set value in daily report
                            $("#dailyReportClassID").val(classObj.classID);
                            $("#dailyReportSectionID").val(classObj.sectionID);
                            $("#dailyReportSubjectID").val(classObj.subjectID);
                            $("#dailyReportSemesterID").val(classObj.semesterID);
                            $("#dailyReportSessionID").val(classObj.sessionID);
                            $("#dailyReportSelectedDate").val(convertDigitIn(classObj.classDate));
                            // set value in dailyReportRemarks
                            $("#dailyReportRemarksClassID").val(classObj.classID);
                            $("#dailyReportRemarksSectionID").val(classObj.sectionID);
                            $("#dailyReportRemarksSubjectID").val(classObj.subjectID);
                            $("#dailyReportRemarksSemesterID").val(classObj.semesterID);
                            $("#dailyReportRemarksSessionID").val(classObj.sessionID);
                            // list mode end
                        });
                        layoutModeGrid += '</div>';
                    } else {
                        $(".classRoomHideSHow").hide();
                        toastr.info('No students are available');
                    }

                    $("#layoutModeGrid").append(layoutModeGrid);
                    $("#overlay").fadeOut(300);
                } else {
                    toastr.error(response.message);
                    $("#overlay").fadeOut(300);
                }
            }
        });
    }

    // function layout mode
    function layoutMode(res, date) {

        var layoutModeGrid = "";
        var bgColor = "#60a05b";
        layoutModeGrid += '<div class="col-md-3">' +
            '<div class="card">';
        if (res.att_status == "present") {
            bgColor = "#60a05b";
        }
        if (res.att_status == "absent") {
            bgColor = "#de354f";
        }
        if (res.att_status == "late") {
            bgColor = "#358fde";
        }
        if (res.att_status == "excused") {
            bgColor = "#696969";
        }

        var birthday = birthdayDate(res.birthday);
        var bd = "";
        if (birthday == date) {
            bd = '<i class="fas fa-birthday-cake"></i>';
        }

        var img = "";
        if (res.photo) {
            img = studentImg + '/' + res.photo;
        } else {
            img = defaultImg;
        }

        layoutModeGrid += '<div class="card-header" style="background-color:' + bgColor + ';color:white;text-align:left">';
        layoutModeGrid += '<img src="' + img + '" class="mr-2 rounded-circle" height="40" width="40" />' +
            '<label style="color:white;position: absolute;margin-bottom:-6px;overflow-wrap: break-word;">' + res.name + '</label>' + bd +
            '</div>' +
            '</div>' +
            '</div>';
        return layoutModeGrid;
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
            buttons: [
                {
                    extend: 'csv',
                    text: 'Download CSV',
                    extension: '.csv',
                    exportOptions: {
                        columns: 'th:not(:last-child)'
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
                        } else {
                            status = row.att_status;
                        }
                        // if (row.att_status) {
                        //     var att_status = '<select class="form-control changeAttendanceSelect" data-id="' + row.student_id + '" id="attendance' + row.student_id + '" data-style="btn-outline-success" name="attendance[' + meta.row + '][att_status]">' +
                        //         '<option value="">Choose</option>' +
                        //         '<option value="present" ' + (row.current_old_att_status == "present" ? "selected" : "selected") + '>Present</option>' +
                        //         '<option value="absent" ' + (row.current_old_att_status == "absent" ? "selected" : "") + '>Absent</option>' +
                        //         '<option value="late" ' + (row.current_old_att_status == "late" ? "selected" : "") + '>Late</option>' +
                        //         '<option value="excused" ' + (row.current_old_att_status == "excused" ? "selected" : "") + '>Excused</option>' +
                        //         '</select>';
                        // } else {
                        //     if (row.current_old_att_status) {
                        //         var att_status = '<select class="form-control changeAttendanceSelect" data-id="' + row.student_id + '" id="attendance' + row.student_id + '" data-style="btn-outline-success" name="attendance[' + meta.row + '][att_status]">' +
                        //             '<option value="">Choose</option>' +
                        //             '<option value="present" ' + (row.current_old_att_status == "present" ? "selected" : "selected") + '>Present</option>' +
                        //             '<option value="absent" ' + (row.current_old_att_status == "absent" ? "selected" : "") + '>Absent</option>' +
                        //             '<option value="late" ' + (row.current_old_att_status == "late" ? "selected" : "") + '>Late</option>' +
                        //             '<option value="excused" ' + (row.current_old_att_status == "excused" ? "selected" : "") + '>Excused</option>' +
                        //             '</select>';
                        //     } else {
                        //         var att_status = '<select class="form-control changeAttendanceSelect" data-id="' + row.student_id + '" id="attendance' + row.student_id + '" data-style="btn-outline-success" name="attendance[' + meta.row + '][att_status]">' +
                        //             '<option value="">Choose</option>' +
                        //             '<option value="present" ' + (row.att_status == "present" ? "selected" : "selected") + '>Present</option>' +
                        //             '<option value="absent" ' + (row.att_status == "absent" ? "selected" : "") + '>Absent</option>' +
                        //             '<option value="late" ' + (row.att_status == "late" ? "selected" : "") + '>Late</option>' +
                        //             '<option value="excused" ' + (row.att_status == "excused" ? "selected" : "") + '>Excused</option>' +
                        //             '</select>';
                        //     }
                        // }
                        var att_status = '<select class="form-control changeAttendanceSelect list-mode-table" data-id="' + row.student_id + '" id="attendance' + row.student_id + '" data-style="btn-outline-success" name="attendance[' + meta.row + '][att_status]">' +
                            '<option value="">Choose</option>' +
                            '<option value="present" ' + (status == "present" ? "selected" : "selected") + '>Present</option>' +
                            '<option value="absent" ' + (status == "absent" ? "selected" : "") + '>Absent</option>' +
                            '<option value="late" ' + (status == "late" ? "selected" : "") + '>Late</option>' +
                            '<option value="excused" ' + (status == "excused" ? "selected" : "") + '>Excused</option>' +
                            '</select>';
                        return att_status;
                    }
                },
                {
                    "targets": 3,
                    "width": "10%",
                    "render": function (data, type, row, meta) {

                        var att_remark = '<textarea style="display:none;" class="addRemarks" data-id="' + row.student_id + '" id="addRemarks' + row.student_id + '" name="attendance[' + meta.row + '][att_remark]">' + (row.att_remark !== "null" ? row.att_remark : "") + '</textarea>' +
                            '<button type="button" data-id="' + row.student_id + '" class="btn btn-outline-info waves-effect waves-light list-mode-btn" data-toggle="modal" data-target="#stuRemarksPopup" id="editRemarksStudent">Add Remarks</button>';
                        return att_remark;
                    }
                },
                {
                    "targets": 4,
                    "width": "20%",
                    "render": function (data, type, row, meta) {
                        if (row.att_status != "present") {
                            onLoadReasons(row, meta);
                        }
                        var reasons = '<select id="reasons' + row.student_id + '" class="form-control list-mode-table" name="attendance[' + meta.row + '][reasons]">' +
                            '<option value="">Choose</option>' +
                            '</select>';
                        return reasons;
                    }
                },
                {
                    "targets": 5,
                    "width": "15%",
                    "render": function (data, type, row, meta) {

                        // var student_behaviour = '<div class="row">' +
                        //     '<div class="radio_group_1">' +
                        //     '<input type="radio" value="smile" title="smile    " ' + (row.student_behaviour == "smile" ? "checked" : "") + ' name="attendance[' + meta.row + '][student_behaviour]">' +
                        //     '<label for="smile">' +
                        //     '<i class="far fa-smile" style="color:yellow;font-size:22px"></i>' +
                        //     '</label>' +
                        //     '</div>' +
                        //     '<div class="radio_group_1">' +
                        //     '<input type="radio" value="angry" title="angry" ' + (row.student_behaviour == "angry" ? "checked" : "") + ' name="attendance[' + meta.row + '][student_behaviour]">' +
                        //     '<label for="angry">' +
                        //     '<i class="far fa-angry" style="color:red;font-size:22px"></i>' +
                        //     '</label>' +
                        //     '</div>' +
                        //     '<div class="radio_group_1">' +
                        //     '<input type="radio" value="dizzy" title="dizzy" ' + (row.student_behaviour == "dizzy" ? "checked" : "") + ' name="attendance[' + meta.row + '][student_behaviour]">' +
                        //     '<label for="dizzy">' +
                        //     '<i class="far fa-dizzy" style="color:orange;font-size:22px"></i>' +
                        //     '</label>' +
                        //     '</div>' +
                        //     '<div class="radio_group_1">' +
                        //     '<input type="radio" value="surprise" title="surprise" ' + (row.student_behaviour == "surprise" ? "checked" : "") + ' name="attendance[' + meta.row + '][student_behaviour]">' +
                        //     '<label for="surprise">' +
                        //     '<i class="far fa-surprise" style="color:green;font-size:22px"></i>' +
                        //     '</label>' +
                        //     '</div>' +
                        //     '<div class="radio_group_1">' +
                        //     '<input type="radio" value="tired" title="tired" ' + (row.student_behaviour == "tired" ? "checked" : "") + ' name="attendance[' + meta.row + '][student_behaviour]">' +
                        //     '<label for="tired">' +
                        //     '<i class="far fa-tired" style="color:purple;font-size:22px"></i>' +
                        //     '</label>' +
                        //     '</div>' +
                        //     '</div>';
                        var student_behaviour = '<div class="row">' +
                            '<div class="radio_group_1">' +
                            '<input type="radio" value="Engaging" title="Engaging    " ' + (row.student_behaviour == "Engaging" ? "checked" : "") + ' name="attendance[' + meta.row + '][student_behaviour]">' +
                            '<label for="Engaging">' +
                            '<svg xmlns="http://www.w3.org/2000/svg" id="Layer_2" viewBox="0 0 138.1 158.64"><g id="outline"><g><path d="M52.62,151.16s-24.9-17.03-36.71-53.43l-11.22-14.88s-3.22-19.58,13.75-16.58c0,0,13.59,11.9,16.63,11.12,0,0,.44,6.58,.45-14.72l.23-42.02s2.24-11.45,16.87-5.28c0,0,7.95-3.25,7.95,6.67,0,0-.7-26.01,20.72-16.05,0,0,4.56,7.5,4.37,13.91,0,0,4.66-13.32,17.61-9.11,0,0,7.11,2.33,7.11,19.28,0,0,6.78-6.28,15.26-5.03,0,0,9.75-2.19,9.7,19.46v57.13s-12.85,50.6-40.47,49.49l-42.24,.02Z" fill="#ffeee4"/><path d="M110.37,37.51c0-6.88,5.57-12.45,12.45-12.45h0c6.88,0,12.45,5.57,12.45,12.45v57.22s.12,54.51-51.54,59.25" fill="none" stroke="#231f20" stroke-linecap="round" stroke-linejoin="round" stroke-width="5.67"/><path d="M60.56,26.98c0-6.88-5.57-12.45-12.45-12.45s-12.45,5.57-12.45,12.45c0,10.07-.18,15.2-.2,25.28-.01,5.81,.41,11.61,.3,17.42-.03,1.29,.47,6.8-.7,7.72-1.71,1.32-9.55-7.48-11.59-8.93-3.62-2.59-8.27-3.88-12.6-2.4-6.83,2.33-9.94,10.32-6.84,16.72,2.29,4.75,6.29,8.15,9.63,12.11,5.03,5.97,6.73,13.19,9.62,20.23,7.48,18.18,20.67,34.08,40.52,38.84" fill="none" stroke="#231f20" stroke-linecap="round" stroke-linejoin="round" stroke-width="5.67"/><path d="M75.84,89.82s7.15,14.44,15.78,0" fill="none" stroke="#231f20" stroke-linecap="round" stroke-linejoin="round" stroke-width="4.25"/><circle cx="61.29" cy="79.46" r="5.05" fill="#231f20"/><circle cx="103.7" cy="79.46" r="5.05" fill="#231f20"/><ellipse cx="114.44" cy="90.96" rx="11.18" ry="3.97" fill="#faab74"/><ellipse cx="52.62" cy="90.96" rx="11.18" ry="3.97" fill="#faab74"/><path d="M85.47,22.05c0-6.88,5.57-12.45,12.45-12.45h0c6.88,0,12.45,5.57,12.45,12.45V60.51" fill="none" stroke="#71c6cc" stroke-linecap="round" stroke-linejoin="round" stroke-width="5.67"/><path d="M60.56,51.13V15.29c0-6.88,5.57-12.45,12.45-12.45h0c6.88,0,12.45,5.57,12.45,12.45V51.13" fill="none" stroke="#2f338c" stroke-linecap="round" stroke-linejoin="round" stroke-width="5.67"/><circle cx="73.62" cy="154.9" r="3.74" fill="#e9d52b"/></g></g></svg>' +
                            '</label>' +
                            '</div>' +
                            '<div class="radio_group_1">' +
                            '<input type="radio" value="Hyperactive" title="Hyperactive" ' + (row.student_behaviour == "Hyperactive" ? "checked" : "") + ' name="attendance[' + meta.row + '][student_behaviour]">' +
                            '<label for="Hyperactive">' +
                            '<svg xmlns="http://www.w3.org/2000/svg" id="Layer_2" viewBox="0 0 128.12 157.72"><g id="outline"><g><path d="M19.51,101.72s7.42,48.85,37.17,49.14l25.75,1.88s38.54-3.31,42.76-58.01V51.13s1.79-17.08-18.99-10.43l-5.91,4.28-.35-25.87s-9.91-19.8-24.55-1.76c0,0-1.27-20.95-21.05-11.06,0,0-3.5,5.83-4.37,12.22,0,0-8.83-8.64-18.88-1.87,0,0-4.26,1.53-5.98,8.41l.34,38.84s-.91,11.15-5.57,8.91c0,0,14.73,7.3,14.13,13.23,0,0-.47,18.61-14.5,15.68Z" fill="#ca9d83"/><rect x="4.5" y="68.01" width="24.64" height="36.04" rx="12.32" ry="12.32" transform="translate(-61.45 46.56) rotate(-52.17)" fill="#ca9d83"/><ellipse cx="36.34" cy="94.72" rx="11.18" ry="3.97" transform="translate(-5.84 2.45) rotate(-3.58)" fill="#fcc097"/><path d="M75.39,22.05c0-6.88,5.57-12.45,12.45-12.45h0c6.88,0,12.45,5.57,12.45,12.45V60.51" fill="none" stroke="#71c6cc" stroke-linecap="round" stroke-linejoin="round" stroke-width="5.67"/><line x1="125.19" y1="94.72" x2="125.19" y2="62.67" fill="none" stroke="#231f20" stroke-linecap="round" stroke-linejoin="round" stroke-width="5.67"/><path d="M50.49,26.98c0-6.88-5.57-12.45-12.45-12.45s-12.45,5.57-12.45,12.45c0,10.07-.18,15.2-.2,25.27,0,5.14,.02,10.28,.14,15.41,0,0-.63,5.5-8,3.56" fill="none" stroke="#231f20" stroke-linecap="round" stroke-linejoin="round" stroke-width="5.67"/><ellipse cx="100.29" cy="94.72" rx="3.97" ry="11.18" transform="translate(-.63 188.77) rotate(-86.35)" fill="#fcc097"/><rect x="100.29" y="39.95" width="24.9" height="34.33" rx="12.45" ry="12.45" fill="none" stroke="#231f20" stroke-linecap="round" stroke-linejoin="round" stroke-width="5.67"/><polyline points="45.84 74.28 53.39 81.05 44.3 85.7" fill="none" stroke="#231f20" stroke-linecap="round" stroke-linejoin="round" stroke-width="4.25"/><polyline points="93.32 74.4 86.52 81.93 96.06 85.58" fill="none" stroke="#231f20" stroke-linecap="round" stroke-linejoin="round" stroke-width="4.25"/><path d="M64.58,89.64l13.49-.19s1.8,9.55-4.57,10.38c0,0-10.77,2.24-8.92-10.19Z" fill="none" stroke="#231f20" stroke-linecap="round" stroke-linejoin="round" stroke-width="4.25"/><path d="M125.19,94.72s4.15,49.12-42.68,59.25" fill="none" stroke="#231f20" stroke-linecap="round" stroke-linejoin="round" stroke-width="5.67"/><path d="M62.61,152.73c-12.46-1.11-23.94-6.67-31.75-16.55-4.91-6.21-6.77-13.85-9.57-21.1-2.76-7.14-6.92-13.62-12.01-19.31" fill="none" stroke="#231f20" stroke-linecap="round" stroke-linejoin="round" stroke-width="5.67"/><path d="M50.49,51.13V15.29c0-6.88,5.57-12.45,12.45-12.45h0c6.88,0,12.45,5.57,12.45,12.45V51.13" fill="none" stroke="#2f338c" stroke-linecap="round" stroke-linejoin="round" stroke-width="5.67"/><circle cx="72.37" cy="153.97" r="3.74" fill="#e9d52b"/><polygon points="118.11 59.62 114.3 59.47 112.02 62.53 110.98 58.86 107.37 57.64 110.54 55.52 110.59 51.7 113.58 54.06 117.23 52.93 115.91 56.51 118.11 59.62" fill="none" stroke="#231f20" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.27"/><polygon points="24.88 90.62 21.07 90.48 18.79 93.53 17.75 89.87 14.14 88.64 17.31 86.52 17.36 82.71 20.35 85.07 23.99 83.93 22.68 87.51 24.88 90.62" fill="none" stroke="#231f20" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.27"/></g></g></svg>' +
                            '</label>' +
                            '</div>' +
                            '<div class="radio_group_1">' +
                            '<input type="radio" value="Quiet" title="Quiet" ' + (row.student_behaviour == "Quiet" ? "checked" : "") + ' name="attendance[' + meta.row + '][student_behaviour]">' +
                            '<label for="Quiet">' +
                            '<svg xmlns="http://www.w3.org/2000/svg" id="Layer_2" viewBox="0 0 130.25 156.47"><g id="outline"><g><path d="M50.19,151.14s-30.5-5.51-44.26-43.7L2.21,62.67s1.58-11.69,18.55-8.7c0,0,5.01,7.33,7.04,11.77,0,0-.17,18.23-.15-3.07l.23-42.02s2.24-11.45,16.87-5.28c0,0,7.95-3.25,7.95,6.67,0,0-.7-26.01,20.72-16.05,0,0,4.56,7.5,4.37,13.91,0,0,4.66-13.32,17.61-9.11,0,0,7.11,2.33,7.11,19.28,0,0,6.78-6.28,15.26-5.03,0,0,9.75-2.19,9.7,19.46v57.13s-12.85,50.6-40.47,49.49H50.19Z" fill="#fdd3be"/><path d="M102.51,37.51c0-6.88,5.57-12.45,12.45-12.45h0c6.88,0,12.45,5.57,12.45,12.45v57.22s1.29,49.85-47.42,57.48" fill="none" stroke="#231f20" stroke-linecap="round" stroke-linejoin="round" stroke-width="5.67"/><path d="M52.71,26.98c0-6.88-5.57-12.45-12.45-12.45s-12.45,5.57-12.45,12.45c0,10.07-.18,15.2-.2,25.28l.2,13.49c0-6.88-5.57-12.45-12.45-12.45s-12.45,5.57-12.45,12.45c0,17.61-1.16,33.95,6.17,50.43,5.08,11.42,12.67,22.15,23.41,28.85,7.8,4.86,16.84,7.18,26,7.17" fill="none" stroke="#231f20" stroke-linecap="round" stroke-linejoin="round" stroke-width="5.67"/><circle cx="43.98" cy="83.7" r="5.05" fill="#231f20"/><circle cx="88.93" cy="83.7" r="5.05" fill="#231f20"/><ellipse cx="102.64" cy="94.72" rx="11.18" ry="3.97" fill="#faab74"/><ellipse cx="31.05" cy="94.84" rx="11.18" ry="3.97" fill="#faab74"/><line x1="55.11" y1="97.62" x2="78.55" y2="97.62" fill="none" stroke="#231f20" stroke-linecap="round" stroke-linejoin="round" stroke-width="4.25"/><line x1="57.75" y1="92.69" x2="57.75" y2="102.55" fill="none" stroke="#231f20" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.13"/><line x1="63.8" y1="92.69" x2="63.8" y2="102.55" fill="none" stroke="#231f20" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.13"/><line x1="69.86" y1="92.69" x2="69.86" y2="102.55" fill="none" stroke="#231f20" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.13"/><line x1="75.91" y1="92.69" x2="75.91" y2="102.55" fill="none" stroke="#231f20" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.13"/><line x1="27.68" y1="58.78" x2="27.68" y2="79.99" fill="none" stroke="#231f20" stroke-linecap="round" stroke-linejoin="round" stroke-width="5.67"/><circle cx="69.86" cy="152.73" r="3.74" fill="#e9d52b"/><path d="M77.61,22.05c0-6.88,5.57-12.45,12.45-12.45h0c6.88,0,12.45,5.57,12.45,12.45V60.51" fill="none" stroke="#71c6cc" stroke-linecap="round" stroke-linejoin="round" stroke-width="5.67"/><path d="M52.71,51.13V15.29c0-6.88,5.57-12.45,12.45-12.45h0c6.88,0,12.45,5.57,12.45,12.45V51.13" fill="none" stroke="#2f338c" stroke-linecap="round" stroke-linejoin="round" stroke-width="5.67"/></g></g></svg>' +
                            '</label>' +
                            '</div>' +
                            '<div class="radio_group_1">' +
                            '<input type="radio" value="Sleepy" title="Sleepy" ' + (row.student_behaviour == "Sleepy" ? "checked" : "") + ' name="attendance[' + meta.row + '][student_behaviour]">' +
                            '<label for="Sleepy">' +
                            '<svg xmlns="http://www.w3.org/2000/svg" id="Layer_2" viewBox="0 0 130.96 157.72"><g id="outline"><g><path d="M108.86,101.63s-7.42,48.85-37.17,49.14l-25.75,1.88S7.4,149.34,3.18,94.64V51.05s-1.79-17.08,18.99-10.43l5.91,4.28,.35-25.87s9.91-19.8,24.55-1.76c0,0,1.27-20.95,21.05-11.06,0,0,3.5,5.83,4.37,12.22,0,0,8.83-8.64,18.88-1.87,0,0,4.26,1.53,5.98,8.41l-.34,38.84s.91,11.15,5.57,8.91c0,0-14.73,7.3-14.13,13.23,0,0,.47,18.61,14.5,15.68Z" fill="#fddfd2"/><rect x="98.98" y="68.01" width="24.64" height="36.04" rx="12.32" ry="12.32" transform="translate(111.6 226.71) rotate(-127.83)" fill="#fddfd2"/><ellipse cx="27.83" cy="98" rx="11.18" ry="3.97" transform="translate(-6.06 1.93) rotate(-3.58)" fill="#faab74"/><path d="M52.73,22.05c0-6.88-5.57-12.45-12.45-12.45h0c-6.88,0-12.45,5.57-12.45,12.45V60.51" fill="none" stroke="#71c6cc" stroke-linecap="round" stroke-linejoin="round" stroke-width="5.67"/><line x1="2.93" y1="94.72" x2="2.93" y2="62.67" fill="none" stroke="#231f20" stroke-linecap="round" stroke-linejoin="round" stroke-width="5.67"/><path d="M77.63,26.98c0-6.88,5.57-12.45,12.45-12.45s12.45,5.57,12.45,12.45c0,10.07,.18,15.2,.2,25.27,0,5.14-.02,10.28-.14,15.41,0,0,.63,5.5,8,3.56" fill="none" stroke="#231f20" stroke-linecap="round" stroke-linejoin="round" stroke-width="5.67"/><ellipse cx="103.13" cy="104.68" rx="3.97" ry="11.18" transform="translate(-7.92 200.92) rotate(-86.35)" fill="#faab74"/><rect x="98.98" y="68.01" width="24.64" height="36.04" rx="12.32" ry="12.32" transform="translate(111.6 226.71) rotate(-127.83)" fill="none" stroke="#231f20" stroke-linecap="round" stroke-linejoin="round" stroke-width="5.67"/><path d="M27.83,61.83v-9.43c0-6.88-5.57-12.45-12.45-12.45h0c-6.88,0-12.45,5.57-12.45,12.45v9.43" fill="none" stroke="#231f20" stroke-linecap="round" stroke-linejoin="round" stroke-width="5.67"/><path d="M2.93,94.72s-4.15,49.12,42.68,59.25" fill="none" stroke="#231f20" stroke-linecap="round" stroke-linejoin="round" stroke-width="5.67"/><path d="M65.52,152.73c12.46-1.11,23.94-6.67,31.75-16.55,4.91-6.21,6.77-13.85,9.57-21.1,2.76-7.14,6.92-13.62,12.01-19.31" fill="none" stroke="#231f20" stroke-linecap="round" stroke-linejoin="round" stroke-width="5.67"/><path d="M77.63,51.13V15.29c0-6.88-5.57-12.45-12.45-12.45h0c-6.88,0-12.45,5.57-12.45,12.45V51.13" fill="none" stroke="#2f338c" stroke-linecap="round" stroke-linejoin="round" stroke-width="5.67"/><circle cx="55.75" cy="153.97" r="3.74" fill="#e9d52b"/><path d="M37.72,82.37s7.15,14.44,15.78,0" fill="none" stroke="#231f20" stroke-linecap="round" stroke-linejoin="round" stroke-width="4.25"/><path d="M81.22,82.37s7.15,14.44,15.78,0" fill="none" stroke="#231f20" stroke-linecap="round" stroke-linejoin="round" stroke-width="4.25"/><path d="M62.56,96.29h12.45s0,8.39-7.26,8.39c0,0-5.21-1.36-5.19-8.39Z" fill="none" stroke="#231f20" stroke-linecap="round" stroke-linejoin="round" stroke-width="4.25"/><path d="M67.18,100.49c-2.31-.02-5.29,3.5-6.34,5.24-.58,.97-1.2,2.31-.54,3.4,1.05,1.73,4.02,1.61,4.9-.29,.4-.85-.03-1.54-.15-2.38-.1-.69,1.05-5.98,2.13-5.98Z" fill="#fff"/></g></g></svg>' +
                            '</label>' +
                            '</div>' +
                            '<div class="radio_group_1">' +
                            '<input type="radio" value="Uninterested" title="Uninterested" ' + (row.student_behaviour == "Uninterested" ? "checked" : "") + ' name="attendance[' + meta.row + '][student_behaviour]">' +
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


                        var classroom_behaviour = '<div class="row">' +
                            '<div class="radio_group">' +
                            '<input type="radio" class="checkRadioBtn" value="likes" ' + (row.classroom_behaviour == "likes" ? "checked" : "") + ' name="attendance[' + meta.row + '][classroom_behaviour]">' +
                            '<label for="like">' +
                            '<i class="fas fa-thumbs-up"></i>' +
                            '</label>' +
                            '</div>' +
                            '<div class="radio_group">' +
                            '<input type="radio" class="checkRadioBtn" value="dislikes" ' + (row.classroom_behaviour == "dislikes" ? "checked" : "") + ' name="attendance[' + meta.row + '][classroom_behaviour]">' +
                            '<label for="like">' +
                            '<i class="fas fa-thumbs-down rr"></i>' +
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
                    $('#layoutModeGrid').empty();
                    var layoutModeGrid = "";

                    var currentDate = convertDigitIn($("#classDate").val());
                    var date = birthdayDate(currentDate);
                    if (response.data.length > 0) {

                        layoutModeGrid += '<div class="row">';
                        response.data.forEach(function (res) {

                            // layout mode div start
                            layoutModeGrid += layoutMode(res, date);
                            // layout mode div end
                        });
                        layoutModeGrid += '</div>';
                    }

                    $("#layoutModeGrid").append(layoutModeGrid);
                    // $('#saveClassRoomAttendance').prop('disabled', true);
                    // $('#listModeClassRoom').DataTable().ajax.reload(null, false);
                    // $('#addListMode')[0].reset();
                    var classID = $("#changeClassName").val();
                    var sectionID = $("#sectionID").val();
                    var subjectID = $("#subjectID").val();
                    var classDate = $("#classDate").val();
                    var semesterID = $("#semester_id").val();
                    var sessionID = $("#session_id").val();

                    var formData = new FormData();
                    formData.append('token', token);
                    formData.append('branch_id', branchID);
                    formData.append('class_id', classID);
                    formData.append('section_id', sectionID);
                    formData.append('subject_id', subjectID);
                    formData.append('semester_id', semesterID);
                    formData.append('session_id', sessionID);
                    formData.append('date', convertDigitIn(classDate));
                    widgetShow(formData);
                    $("#attendaceTakenSts").html("Taken");

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
        $('#reasons' + studenetID).append('<option value="">Choose</option>');
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
        var attendanceType = row.att_status;
        $('#reasons' + studenetID).empty();
        $('#reasons' + studenetID).append('<option value="">Choose</option>');
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
    // function testfunction(row, meta) {
    //     var studenetID = row.student_id;
    //     var attendanceType = row.att_status;
    //     var reasons = "";
    //     if (attendanceType) {
    //         $.post(getAbsentLateExcuse, {
    //             token: token,
    //             branch_id: branchID,
    //             attendance_type: attendanceType
    //         }, function (res) {
    //             if (res.code == 200) {
    //                 var arrData = res.data;
    //                 reasons += '<select id="reasons' + row.student_id + '" class="form-control" name="attendance[' + meta.row + '][reasons]">' +
    //                     '<option value="">Choose</option>';
    //                 if (arrData.length > 0) {

    //                     $.each(arrData, function (key, val) {
    //                         
    //                         reasons += '<option value="' + val.id + '">' + val.name + '</option>';
    //                     });
    //                     reasons += '</select>';
    //                     
    //                     return reasons;
    //                 } else {
    //                     
    //                     reasons += '</select>';
    //                     
    //                     return reasons;
    //                 }
    //             }
    //         }, 'json');
    //     } else {
    //         reasons += '<select id="reasons' + row.student_id + '" class="form-control" name="attendance[' + meta.row + '][reasons]">' +
    //             '<option value="">Choose</option>';
    //         reasons += '</select>';
    //         
    //         return reasons;
    //     }

    //     
    // }

    // widget function
    function widgetShow(formData) {
        // Display the key/value pairs
        // for (var pair of formData.entries()) {
        //     console.log(pair[0] + ', ' + pair[1]);
        // }
        // return false;
        // widget show
        $.ajax({
            url: getClassRoomWidget,
            method: "post",
            data: formData,
            processData: false,
            dataType: 'json',
            contentType: false,
            success: function (response) {
                var dataSetNew = response.data.get_widget_details;
                var avgAttendance = response.data.avg_attendance;
                var getStudentData = response.data.get_student_data;
                var totalStudent = response.data.total_student;
                var timetable_class = response.data.timetable_class;
                // check count down
                countdownTimeStart(timetable_class);

                var presentCnt = (dataSetNew[0].presentCount ? dataSetNew[0].presentCount : 0);
                var absentCnt = (dataSetNew[0].absentCount ? dataSetNew[0].absentCount : 0);
                var lateCnt = (dataSetNew[0].lateCount ? dataSetNew[0].lateCount : 0);
                var excusedCnt = (dataSetNew[0].excusedCount ? dataSetNew[0].excusedCount : 0);
                var totalStudentCnt = (totalStudent[0].totalStudentCount ? totalStudent[0].totalStudentCount : 0);

                var perfectAttendance = 0;
                if (response.code == 200) {
                    // present absent late count start
                    $("#presentCount").html(presentCnt);
                    $("#absentCount").html(absentCnt);
                    $("#lateCount").html(lateCnt);
                    $("#excuseCount").html(excusedCnt);
                    // present absent late end
                    if (getStudentData.length > 0) {
                        $.each(getStudentData, function (key, val) {
                            // count perfect attendance person
                            if (val.presentCount && val.totalDaysCount) {
                                var attenPercent = (val.presentCount / val.totalDaysCount) * 100;
                                if (attenPercent == 100) {
                                    perfectAttendance++;
                                }
                            }
                        });
                    }
                    // var totalStudentCount = dataSetNew[0].totalStudentCount;

                    var attpresentCount = (avgAttendance[0].presentCount + avgAttendance[0].lateCount);
                    var totalDate = avgAttendance[0].totalDate;
                    var absentCount = avgAttendance[0].absentCount;

                    // perfectAttendance / totalStudentCnt
                    var perfectAttendancePer = (perfectAttendance / totalStudentCnt) * 100;

                    var belowAttendance = (absentCount / (totalDate * totalStudentCnt) * 100);

                    var avg_attendance = (attpresentCount / (totalDate * totalStudentCnt) * 100);

                    $("#perfectAttendance").html((perfectAttendancePer ? Math.round(perfectAttendancePer) : 0) + "%");
                    $("#totalStrength").html("Total Strength: " + totalStudentCnt);
                    $("#belowAttendance").html((belowAttendance ? Math.round(belowAttendance) : 0) + "%");
                    $("#avg_attendance").html((avg_attendance ? Math.round(avg_attendance) : 0) + "%");
                    // getReportRemarks(dataSetNew)
                } else {
                    $("#presentCount").html(presentCnt);
                    $("#absentCount").html(absentCnt);
                    $("#lateCount").html(lateCnt);
                    $("#excuseCount").html(excusedCnt);
                    $("#perfectAttendance").html(perfectAttendance + "%");
                    $("#totalStrength").html("Total Strength: " + totalStudentCnt);
                    $("#belowAttendance").html(0 + "%");
                    $("#avg_attendance").html(0 + "%");

                    // toastr.error(response.message);
                }
            }
        });
    }
    // get daily report remarks
    // function list mode
    function getReportRemarks(dataSetNew) {
        $('#dailyReportRemarks').DataTable().clear().destroy();
        $('#dailyReportRemarks td').empty();
        listTable = $('#dailyReportRemarks').DataTable({
            processing: true,
            bDestroy: true,
            info: true,
            dom: 'lBfrtip',
            paging: false,
            // dom: "<'row'<'col-sm-2'l><'col-sm-2'B><'col-sm-8'f>>" +
            //     "<'row'<'col-sm-12'tr>>" +
            //     "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            buttons: [
                {
                    extend: 'csv',
                    text: 'Download CSV',
                    extension: '.csv',
                    exportOptions: {
                        columns: 'th:not(:last-child)'
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
                    data: 'student_remarks'
                },
                {
                    data: 'teacher_remarks'
                }
            ],
            columnDefs: [
                {
                    "targets": 0,
                    "render": function (data, type, row, meta) {
                        return meta.row + 1;
                    }
                },
                {
                    "targets": 1,
                    "className": "table-user",
                    "render": function (data, type, row, meta) {
                        var img = "";
                        if (row.photo) {
                            img = studentImg + '/' + row.photo;
                        } else {
                            img = defaultImg;
                        }
                        var first_name = '<input type="hidden" name="daily_report_remarks[' + meta.row + '][id]" value="' + row.id + '">' +
                            '<input type="hidden" name="daily_report_remarks[' + meta.row + '][student_id]" value="' + row.student_id + '">' +
                            '<img src="' + img + '" class="mr-2 rounded-circle">' +
                            '<a href="javascript:void(0);" class="text-body font-weight-semibold">' + data + '</a>';
                        return first_name;
                    }
                },
                {
                    "targets": 2,
                    "render": function (data, type, row, meta) {
                        var student_remarks = '<textarea readonly name="daily_report_remarks[' + meta.row + '][student_remarks]" class="form-control" id="example-textarea" rows="2">' + (data != null ? data : "") + '</textarea>';
                        return student_remarks;
                    }
                },
                {
                    "targets": 3,
                    "render": function (data, type, row, meta) {
                        var teacher_remarks = '<textarea name="daily_report_remarks[' + meta.row + '][teacher_remarks]" class="form-control" id="example-textarea" rows="2">' + (data != null ? data : "") + '</textarea>';
                        return teacher_remarks;
                    }
                }
            ]
        }).on('draw', function () {
        });
    }
    // countdown timer
    $("#getShortTest").validate(); //sets up the validator
    $("input[name*='field']").rules("add", "required");
    // short test
    $('#getShortTest').on('submit', function (e) {
        e.preventDefault();
        var form = this;
        var branchCheck = $("#getShortTest").valid();


        var field = $("input[name='field[]']")
            .map(function () { return $(this).val(); }).get();
        var grade = $("select[name='grade[]']")
            .map(function () { return $(this).val(); }).get();
        var testVal = [];
        for (let i = 0; i < field.length; i++) {
            // r[keys[i]] = values[i];
            var r = {};
            if (field[i] != '' && grade[i] != '') {

                if (testVal.length > 0) {
                    var index = testVal.findIndex(x => x.test_name === field[i]);
                    if (index !== -1) {
                        toastr.info("Short test name already exist");
                        return false;
                    }
                }

                r['test_name'] = field[i];
                r['status'] = grade[i];
                testVal.push(r);
            }
        }

        if (branchCheck === true) {
            // return false;
            $.ajax({
                url: $(form).attr('action'),
                method: $(form).attr('method'),
                data: new FormData(form),
                processData: false,
                dataType: 'json',
                contentType: false,
                success: function (response) {
                    if (response.code == 200) {
                        var dateSet = response.data;
                        if (dateSet.length > 0) {
                            shortTestShow(testVal, dateSet);
                        }

                    } else {
                        toastr.error(response.message);
                    }
                }
            });
        }
    });
    // // show short test
    function shortTestShow(testVal, dateSet) {

        // get value short test
        var classID = $("#shortTestClassID").val();
        var sectionID = $("#shortTestSectionID").val();
        var subjectID = $("#shortTestSubjectID").val();
        var classDate = $("#shortTestSelectedDate").val();
        var semesterID = $("#shortTestSemesterID").val();
        var sessionID = $("#shortTestSessionID").val();
        // $(".shortTestHideSHow").show();
        $('#shortTestAppend').empty();
        $('#shortTestTableAppend').empty();

        var shortTestAppend = "";
        var shortTestTable = "";
        var index = 0;
        // console.log("fdsfjfjsdjfjhds")
        // console.log(testVal);
        // console.log(testVal.length);
        // $('#shortTestAppend').empty();
        // var shortTestAppend = "";
        // shortTestAppend += '<tr>' +
        //     '<td>No Data Available</td>' +
        //     '</td>' +
        //     '</tr>';
        // $("#shortTestAppend").append(shortTestAppend);
        shortTestTable += '<div class="table-responsive">' +
            '<table class="table table-striped table-nowrap">' +
            '<thead>' +
            '<tr>' +
            '<th>S.no</th>' +
            '<th>Student Name</th>';
        $.each(testVal, function (key, val) {
            index++;
            shortTestAppend += '<tr>' +
                '<td>' + index + '</td>' +
                '<td class="table-user text-left">' +
                '<label for="test_name">' + val.test_name + '</label>' +
                '</td>' +
                '<td>' +
                '<div class="table-user text-left">' +
                '<label for="status">' + val.status + '</label>' +
                '</div>' +
                '</td>' +
                '</tr>';
            // table add
            shortTestTable += '<th>' + val.test_name + '</th>';
        });
        shortTestTable += '</tr>' +
            '</thead>' +
            '<tbody>';
        var start = 0;
        var indexStart = 0;

        if (dateSet.length > 0) {

            dateSet.forEach(function (res) {
                start++;
                // short test table div start
                shortTestTable += '<tr>' +
                    '<td>';
                if (start == 1) {
                    shortTestTable += '<input type="hidden" name="date" value="' + classDate + '">' +
                        '<input type="hidden" name="class_id" value="' + classID + '">' +
                        '<input type="hidden" name="section_id" value="' + sectionID + '">' +
                        '<input type="hidden" name="subject_id" value="' + subjectID + '">' +
                        '<input type="hidden" name="semester_id" value="' + semesterID + '">' +
                        '<input type="hidden" name="session_id" value="' + sessionID + '">';

                }
                var img = "";
                if (res.photo) {
                    img = studentImg + '/' + res.photo;
                } else {
                    img = defaultImg;
                }
                shortTestTable += start +
                    '</td>' +
                    '<td class="table-user">' +
                    '<img src="' + img + '" class="mr-2 rounded-circle">' +
                    '<a href="javascript:void(0);" class="text-body font-weight-semibold">' + res.name + '</a>' +
                    '</td>';

                // short test table div end
                $.each(testVal, function (key, val) {

                    var marks = "";
                    if (res.test_name) {
                        var test_name = res.test_name.split(",");
                        var test_marks = res.test_marks.split(",");
                        var grade_status = res.grade_status.split(",");
                        var index = test_name.findIndex(x => x === val.test_name);
                        if (index !== -1) {
                            marks = test_marks[index];
                        }
                    }

                    shortTestTable += '<td>' +
                        '<input type="hidden" name="short_test[' + indexStart + '][student_id]" value="' + res.student_id + '">' +
                        '<input type="hidden" name="short_test[' + indexStart + '][test_name][]" value="' + val.test_name + '">' +
                        '<input type="hidden" name="short_test[' + indexStart + '][grade_status][]" value="' + val.status + '">' +
                        '<input type="text" name="short_test[' + indexStart + '][test_marks][]" value="' + marks + '" class="form-control" style="width:100px;">' +
                        '</td>';
                });
                indexStart++;
                shortTestTable += '</tr>';
            });

        }

        $("#shortTestAppend").append(shortTestAppend);

        shortTestTable += '</tbody>' +
            '</table></div>';
        $("#shortTestTableAppend").append(shortTestTable);
    }
    // get short test
    function getShortTestData(formData) {
        $.ajax({
            url: getShortTest,
            method: "post",
            data: formData,
            processData: false,
            dataType: 'json',
            contentType: false,
            success: function (response) {

                if (response.code == 200) {
                    var dateSet = response.data;
                    if (dateSet.length > 0) {
                        var testVal = [];
                        // empty short test tables
                        $('#shortTestAppend').empty();
                        $('#shortTestTableAppend').empty();
                        $('#getShortTest')[0].reset();
                        var testname = response.data[0].test_name;
                        var grade_status = response.data[0].grade_status;
                        if (testname && grade_status) {
                            var field = testname.split(",");
                            var grade = grade_status.split(",");

                            for (let i = 0; i < field.length; i++) {
                                // r[keys[i]] = values[i];
                                var r = {};
                                if (field[i] != '' && grade[i] != '') {
                                    r['test_name'] = field[i];
                                    r['status'] = grade[i];
                                    testVal.push(r);
                                }
                            }

                            shortTestShow(testVal, dateSet);
                        }
                    }

                } else {
                    toastr.error(response.message);
                }
            }
        });
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

    function studentleave() {

        var classID = $("#changeClassName").val();
        var sectionID = $("#sectionID").val();
        var classDate = $("#classDate").val();
        var semesterID = $("#semester_id").val();
        var sessionID = $("#session_id").val();
        var format_date = convertDigitIn(classDate);
        $.get(getStudentLeave, {
            token: token,
            branch_id: branchID,
            teacher_id: ref_user_id,
            class_id: classID,
            section_id: sectionID,
            classDate: format_date
        }, function (response) {
            var dataSetNew = response.data;
            if (response.code == 200) {
                StudentLeave_tbl(dataSetNew);
                // if (response.data.length > 0) {
                //     StudentLeave_tbl(dataSetNew);
                // } else {

                //     toastr.info('No students are available');
                // }
            } else {
                toastr.error(response.message);
            }
        }
        );
    }
    function StudentLeave_tbl(dataSetNew) {
        var local = imgurl;
        $('#stdleaves').DataTable().clear().destroy();
        $('#stdleaves td').empty();
        listTable = $('#stdleaves').DataTable({
            processing: true,
            bDestroy: true,
            info: true,
            dom: 'lBfrtip',
            paging: false,
            // dom: 'lBfrtip',
            // dom: "<'row'<'col-sm-2'l><'col-sm-2'B><'col-sm-8'f>>" +
            //     "<'row'<'col-sm-12'tr>>" +
            //     "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            buttons: [
                {
                    extend: 'csv',
                    text: 'Download CSV',
                    extension: '.csv',
                    exportOptions: {
                        columns: 'th:not(:last-child)'
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
                    "targets": 0,
                    "render": function (data, type, row, meta) {
                        return meta.row + 1;
                    }
                },
                {
                    data: 'name'
                },
                {
                    data: 'from_leave'
                },
                {
                    data: 'to_leave'
                },
                {
                    data: 'reason'
                },
                {
                    data: 'document'
                },
                {
                    data: 'status'
                },
                {
                    data: 'addremarks'
                },
                {
                    data: 'submitbtn'
                }
            ],
            columnDefs: [
                {

                    "targets": 0,
                    "render": function (data, type, row, meta) {
                        return meta.row + 1;
                    }
                },
                {

                    "targets": 1,
                    "className": "table-user",
                    "render": function (data, type, row, meta) {
                        var img = "";
                        if (row.photo) {
                            img = studentImg + '/' + row.photo;
                        } else {
                            img = defaultImg;
                        }
                        var first_name = '<input type="hidden" id="student_leave_tbl_rowid[' + meta.row + '][id]" value="' + row.id + '">' +
                            '<input type="hidden" name="student_leave_upd[' + meta.row + '][student_id]" value="' + row.student_id + '">' +
                            '<img src="' + img + '" class="mr-2 rounded-circle">' +
                            '<a href="javascript:void(0);" class="text-body font-weight-semibold">' + data + '</a>';
                        return first_name;
                    }
                },
                {

                    "targets": 2,
                    "render": function (data, type, row, meta) {
                        var from_leave = '<lable name="student_leave_upd[' + meta.row + ']">' + data + '</label>';
                        return from_leave;
                    }
                },
                {

                    "targets": 3,
                    "render": function (data, type, row, meta) {
                        var to_leave = '<lable name="student_leave_upd[' + meta.row + ']">' + data + '</label>';
                        return to_leave;
                    }
                },
                {

                    "targets": 4,
                    "render": function (data, type, row, meta) {
                        var reason = '<lable name="student_leave_upd[' + meta.row + ']">' + data + '</label>';
                        return reason;
                    }
                },
                {

                    "targets": 5,
                    "render": function (data, type, row, meta) {
                        var document = '<a href="' + local + '/' + data + '" download name="student_leave_upd[' + meta.row + ']"><i class="fas fa-cloud-download-alt" data-toggle="tooltip" title="Click to download..!"></i></a>';


                        return document;
                    }
                },
                {
                    "targets": 6,
                    "render": function (data, type, row, meta) {
                        var status = '<select class="form-control" id="leavestatus' + row.id + '" data-style="btn-outline-success" name="student_leave_upd[' + meta.row + '][status]">' +
                            '<option value="">Choose</option>' +
                            '<option value="Approve"  ' + (data == "Approve" ? "selected" : "") + '>Approve</option>' +
                            '<option value="Reject"  ' + (data == "Reject" ? "selected" : "") + '>Reject</option>' +
                            '<option value="Pending"  ' + (data == "Pending" ? "selected" : "") + '>Pending</option>'
                        '</select>';
                        return status;
                    }
                },
                {
                    "targets": 7,
                    // "width": "10%",
                    "render": function (data, type, row, meta) {

                        var addremarks = '<textarea style="display:none;" class="addRemarksStudent" data-id="' + row.id + '" id="addRemarksStudent' + row.id + '" >' + (row.teacher_remarks !== "null" ? row.teacher_remarks : "") + '</textarea>' +
                            '<button type="button" data-id="' + row.id + '" class="btn btn-outline-info waves-effect waves-light" data-toggle="modal" data-target="#stuLeaveRemarksPopup" id="editLeaveRemarksStudent">Add Remarks</button>';
                        return addremarks;
                    }
                },
                {
                    "targets": 8,
                    // "width": "10%",
                    "render": function (data, type, row, meta) {
                        var submitbtn = '<button type="button" class="btn btn-primary-bl waves-effect waves-light levsub" data-id="' + row.id + '" id="stdLeave">Update</button>';
                        return submitbtn;
                    }
                }
            ]
        }).on('draw', function () {
        });
    }
    $("#stdLeave").validate({
        rules: {
            class_id: "required",
            exam_id: "required"
        }
    });
    $(document).on('click', '#stdLeave', function () {
        var student_leave_tbl_id = $(this).data('id');
        var student_leave_approve = $("#leavestatus" + student_leave_tbl_id).val();

        var teacher_remarks = $("#addRemarksStudent" + student_leave_tbl_id).val();
        var formData = new FormData();
        formData.append('token', token);
        formData.append('branch_id', branchID);
        formData.append('student_leave_tbl_id', student_leave_tbl_id);
        formData.append('student_leave_approve', student_leave_approve);
        formData.append('teacher_remarks', teacher_remarks);
        $.ajax({
            url: teacher_leave_remarks_updated,
            method: "post",
            data: formData,
            processData: false,
            dataType: 'json',
            contentType: false,
            success: function (res) {
                if (res.code == 200) {
                    studentleave();
                    toastr.success('Leave Updated sucessfully');
                }
                else {
                    toastr.error(res.message);

                }
            }
        });

    });
    // student leave remarks 
    // add remarks model
    $('#stuLeaveRemarksPopup').on('show.bs.modal', e => {
        $("#student_leave_remarks").focus();
        var $button = $(e.relatedTarget);
        var studentlev_tbl_ID = $button.attr('data-id');
        var studentlevRemarks = $button.closest('td').find('textarea').val();
        var checknullRemarks = (studentlevRemarks !== "null") ? studentlevRemarks : "";
        $("#studenet_leave_tbl_id").val(studentlev_tbl_ID);
        $("#student_leave_remarks").val(checknullRemarks);
    });

    $('#student_leave_RemarksSave').on('click', function () {
        var studenetlevtblID = $('#studenet_leave_tbl_id').val();
        var student_leave_remarks = $('#student_leave_remarks').val();
        var compain_remarks_tblID = student_leave_remarks;
        $('#addRemarksStudent' + studenetlevtblID).val(compain_remarks_tblID);
        $('#stuLeaveRemarksPopup').modal('hide');
    });

    // classroom clock coundown start

    var intervalId;
    $('#classroom_count_down .countdown-dot').css({
        'background-color': sBackColor
    });

    $('#classroom_count_down .countdown-number-top').css({
        'background-color': sBackColor
    });

    $('#classroom_count_down .countdown-number-bottom').css({
        'background-color': sBackColor
    });

    $('#classroom_count_down .countdown-number-next').css({
        'background-color': sBackColor
    });

    $('#classroom_count_down .countdown-number-next').css({
        'color': sTextColor
    });

    $('#classroom_count_down .countdown-number-top').css({
        'color': sTextColor
    });

    $('#classroom_count_down .countdown-number-bottom').css({
        'color': sTextColor
    });

    $('#classroom_count_down .countdown-dot').css({
        'border-color': sBorderColor
    });

    $('#classroom_count_down .countdown-number-top').css({
        'border-color': sBorderColor
    });

    $('#classroom_count_down .countdown-number-bottom').css({
        'border-color': sBorderColor
    });

    $('#classroom_count_down .countdown-number-next').css({
        'border-color': sBorderColor
    });

    $('#classroom_count_down .countdown-label-container').css({
        'color': sLabelColor
    });

    var days = 24 * 60 * 60,
        hours = 60 * 60,
        minutes = 60;

    var left, d, h, m, s, positions;

    function countdownTimeStart(timetable_class) {

        var curDate = new Date();
        // var CountDownID = document.getElementById("classroom_count_down");
        if (intervalId) {
            clearInterval(intervalId)
            intervalId = null
        }
        if (timetable_class) {
            // var time_end = "19:07:10";
            var time_end = timetable_class.time_end;
            var edt = moment(time_end, 'HH:mm:ss');
            var endDate = edt.toDate();
        } else {
            // if date null
            var returned_endate = moment(curDate).subtract(5, 'minutes');
            var endDate = returned_endate.toDate();
        }
        // console.log(endDate);

        // its end date time of  countdown
        var countDownDate = endDate.getTime();
        // Update the count down every 1 second
        intervalId = setInterval(function () {
            // Get todays date and time
            var now = new Date().getTime();

            // Find the distance between now an the count down date
            var distance = countDownDate - now;
            // Time left
            left = Math.floor((endDate - (new Date())) / 1000);

            if (left < 0) {
                left = 0;
            }

            // days left
            // d = Math.floor(left / days);
            // updateNumbers(1, 2, d, 0, distance);
            // left -= d * days;

            // hours left
            h = Math.floor(left / hours);
            updateNumbers(3, 4, h, 999, distance);
            left -= h * hours;

            // minutes left
            m = Math.floor(left / minutes);
            updateNumbers(5, 6, m, 999, distance);
            left -= m * minutes;

            // seconds left
            s = left;
            updateNumbers(7, 8, s, 999, distance);
            // If the count down is over, write some text 
            if (distance < 0) {
                clearInterval(intervalId);
                return;
            }
        }, 1000);
    }


    function updateNumbers(minor, major, value, forDays, distance) {
        if (forDays == 0) {
            var forDaysClass = '.position-' + parseInt(forDays);
            switchDigit(forDaysClass, Math.floor(value / 100));
        }
        var minorClass = '.position-' + parseInt(minor);
        var majorClass = '.position-' + parseInt(major);

        switchDigit(minorClass, Math.floor(value / 10) % 10);
        switchDigit(majorClass, value % 10);

    }

    function switchDigit(sPosition, iNumber) {
        var oDigit = $(sPosition);
        var oTarget1 = oDigit.parents('.countdown-number-top');
        var iNextNumber = iNumber - 1;
        var sNextPosition = sPosition + '-next';

        if (oDigit.is(':animated') || $(oDigit).html() == iNumber || oTarget1.is(':animated')) {
            return false;
        }

        if (((sPosition == '.position-0' || sPosition == '.position-1' || sPosition == '.position-2' || sPosition == '.position-4' || sPosition == '.position-6' || sPosition == '.position-8') && iNextNumber < 0)) {
            iNextNumber = 9;
        } else if ((sPosition == '.position-3' && iNextNumber < 0)) {
            iNextNumber = 2;
        } else if ((sPosition == '.position-5' || sPosition == '.position-7') && iNextNumber < 0) {
            iNextNumber = 5;
        }

        $(oTarget1).animate({
            borderSpacing: -90
        }, {
            step: function (now, fx) {
                $(this).css('-webkit-transform', 'rotateX(' + now + 'deg)');
                $(this).css('-moz-transform', 'rotateX(' + now + 'deg)');
                $(this).css('transform', 'rotateX(' + now + 'deg)');
            },
            duration: 750,
            complete: function () {
                $(sPosition).each(function () {
                    $(this).html(iNumber);
                });
                $(sNextPosition).each(function () {
                    $(this).html(iNextNumber);
                });

                $(this).css('-webkit-transform', '');
                $(this).css('-moz-transform', '');
                $(this).css('transform', '');
            }
        });

        $('.countdown-number-top .countdown-number-inner ' + sPosition).animate({
            borderSpacing: -90
        }, {
            step: function (now, fx) {
                $(this).css('-webkit-transform', 'rotateX(' + now + 'deg)');
                $(this).css('-moz-transform', 'rotateX(' + now + 'deg)');
                $(this).css('transform', 'rotateX(' + now + 'deg)');
            },
            duration: 750,
            complete: function () {
                $(this).css('-webkit-transform', 'rotateX(180deg)');
                $(this).css('-moz-transform', 'rotateX(180deg)');
                $(this).css('transform', 'rotateX(180deg)');
            }
        });
    }

    resizeClockFonts();

    $(window).resize(function () {
        resizeClockFonts();
    });

    // resize fonts based on container width
    function resizeClockFonts() {

        var numContainerHeight = $('#classroom_count_down .countdown-number-container').height();
        var labelContainerHeight = $('#classroom_count_down .countdown-label-container').height();

        var numFontSize = parseInt(numContainerHeight * .9) + 'px';
        var labelFontsize = parseInt(labelContainerHeight * .9) + 'px';

        $("#classroom_count_down .countdown-number-inner").css({
            'font-size': numFontSize,
            'line-height': parseInt(numContainerHeight) + 'px'
        });

        $('#classroom_count_down .countdown-number-next').css({
            'font-size': numFontSize,
            'line-height': parseInt(numContainerHeight) + 'px'
        });

        $("#classroom_count_down .countdown-label-container").css({
            'font-size': labelFontsize,
            'line-height': parseInt(labelContainerHeight) + 'px'
        });

    }
    // classroom clock coundown end
});