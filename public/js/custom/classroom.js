$(function () {

    var listTable;
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
            section_id: section_id,
            class_id: class_id
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

            var classObj = {
                classID: classID,
                sectionID: sectionID,
                subjectID: subjectID,
                classDate: classDate
            };
            var formData = new FormData();
            formData.append('token', token);
            formData.append('branch_id', branchID);
            formData.append('class_id', classID);
            formData.append('section_id', sectionID);
            formData.append('subject_id', subjectID);
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

                var dataSetNew = response.data;

                if (response.code == 200) {
                    // jQuery("#preloader").remove();
                    // $('#saveClassRoomAttendance').prop('disabled', false);
                    // remove dashboard temporary session
                    sessionStorage.removeItem("classroom_details");
                    $('#layoutModeGrid').empty();
                    var layoutModeGrid = "";
                    if (response.data.length > 0) {
                        $(".classRoomHideSHow").show("slow");
                        listMode(dataSetNew);
                        layoutModeGrid += '<div class="row">';
                        response.data.forEach(function (res) {
                            // layout mode div start
                            layoutModeGrid += layoutMode(res);
                            // layout mode div end
                            // list mode start

                            // set value in list mode
                            $("#listModeClassID").val(classObj.classID);
                            $("#listModeSectionID").val(classObj.sectionID);
                            $("#listModeSubjectID").val(classObj.subjectID);
                            $("#listModeSelectedDate").val(convertDigitIn(classObj.classDate));
                            // set value in short test
                            $("#shortTestClassID").val(classObj.classID);
                            $("#shortTestSectionID").val(classObj.sectionID);
                            $("#shortTestSubjectID").val(classObj.subjectID);
                            $("#shortTestSelectedDate").val(convertDigitIn(classObj.classDate));
                            // set value in daily report
                            $("#dailyReportClassID").val(classObj.classID);
                            $("#dailyReportSectionID").val(classObj.sectionID);
                            $("#dailyReportSubjectID").val(classObj.subjectID);
                            $("#dailyReportSelectedDate").val(convertDigitIn(classObj.classDate));
                            // set value in dailyReportRemarks
                            $("#dailyReportRemarksClassID").val(classObj.classID);
                            $("#dailyReportRemarksSectionID").val(classObj.sectionID);
                            $("#dailyReportRemarksSubjectID").val(classObj.subjectID);
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
    function layoutMode(res) {
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
        layoutModeGrid += '<div class="card-header" style="background-color:' + bgColor + ';color:white;text-align:left">';
        layoutModeGrid += '<img src="' + defaultImg + '" class="mr-2 rounded-circle" height="40" />' +
            '<label style="text-align:center">' + res.first_name + ' ' + res.last_name + '</label>' +
            '</div>' +
            '</div>' +
            '</div>';
        return layoutModeGrid;
    }
    // function list mode
    function listMode(dataSetNew) {
        listTable = $('#listModeClassRoom').DataTable({
            processing: true,
            bDestroy: true,
            info: true,
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
                    data: 'first_name'
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
                    "render": function (data, type, row) {
                        if (!data) {
                            return '-';
                        } else {
                            var restaurant_id = data;
                            return restaurant_id;
                        }
                    }
                },
                {
                    "targets": 1,
                    "width": "15%",
                    "className": "table-user",
                    "render": function (data, type, row, meta) {
                        var first_name = '<input type="hidden" name="attendance[' + meta.row + '][attendance_id]" value="' + row.att_id + '">' +
                            '<input type="hidden" name="attendance[' + meta.row + '][student_id]" value="' + row.student_id + '">' +
                            '<input type="hidden" name="attendance[' + meta.row + '][first_name]" value="' + row.first_name + '">' +
                            '<input type="hidden" name="attendance[' + meta.row + '][last_name]" value="' + row.last_name + '">' +
                            '<img src="' + defaultImg + '" class="mr-2 rounded-circle">' +
                            '<a href="javascript:void(0);" class="text-body font-weight-semibold">' + data + '</a>';
                        return first_name;
                    }
                },
                {
                    "targets": 2,
                    "width": "20%",
                    "render": function (data, type, row, meta) {
                        var att_status = '<select class="form-control changeAttendanceSelect" data-style="btn-outline-success" name="attendance[' + meta.row + '][att_status]">' +
                            '<option value="">Choose</option>' +
                            '<option value="present" ' + (row.att_status == "present" ? "selected" : "selected") + '>Present</option>' +
                            '<option value="absent" ' + (row.att_status == "absent" ? "selected" : "") + '>Absent</option>' +
                            '<option value="late" ' + (row.att_status == "late" ? "selected" : "") + '>Late</option>' +
                            '<option value="excused" ' + (row.att_status == "excused" ? "selected" : "") + '>Excused</option>' +
                            '</select>';



                        return att_status;
                    }
                },
                {
                    "targets": 3,
                    "width": "10%",
                    "render": function (data, type, row, meta) {

                        var att_remark = '<textarea style="display:none;" class="addRemarks" data-id="' + row.student_id + '" id="addRemarks' + row.student_id + '" name="attendance[' + meta.row + '][att_remark]">' + (row.att_remark !== "null" ? row.att_remark : "") + '</textarea>' +
                            '<button type="button" data-id="' + row.student_id + '" class="btn btn-outline-info waves-effect waves-light" data-toggle="modal" data-target="#stuRemarksPopup" id="editRemarksStudent">Add Remarks</button>';
                        return att_remark;
                    }
                },
                {
                    "targets": 4,
                    "width": "15%",
                    "render": function (data, type, row, meta) {
                        var reasons = '<select id="reasons" class="form-control" name="attendance[' + meta.row + '][reasons]">' +
                            '<option value="">Choose</option>' +
                            '<option value="fever" ' + (row.reasons == "fever" ? "selected" : "") + '>Fever</option>' +
                            '<option value="breakdown" ' + (row.reasons == "breakdown" ? "selected" : "") + '>Bus Breakdown</option>' +
                            '<option value="book_missing" ' + (row.reasons == "book_missing" ? "selected" : "") + '>Book Missing</option>' +
                            '<option value="others" ' + (row.reasons == "others" ? "selected" : "") + '>Others</option>' +
                            '</select>';
                        return reasons;
                    }
                },
                {
                    "targets": 5,
                    "width": "10%",
                    "render": function (data, type, row, meta) {

                        // var student_behaviour = '<div class="rating">' +
                        //     '<input type="radio" id="rating-1' + meta.row + '" name="attendance[' + meta.row + '][student_behaviour]" ' + (row.student_behaviour == "1" ? "checked" : "") + ' value="1">' +
                        //     '<label for="rating-1' + meta.row + '"></label>' +
                        //     '<input type="radio" id="rating-2' + meta.row + '" name="attendance[' + meta.row + '][student_behaviour]" ' + (row.student_behaviour == "2" ? "checked" : "") + ' value="2">' +
                        //     '<label for="rating-2' + meta.row + '"></label>' +
                        //     '<input type="radio" id="rating-3' + meta.row + '" name="attendance[' + meta.row + '][student_behaviour]" ' + (row.student_behaviour == "3" ? "checked" : "") + ' value="3">' +
                        //     '<label for="rating-3' + meta.row + '"></label>' +
                        //     '<input type="radio" id="rating-4' + meta.row + '" name="attendance[' + meta.row + '][student_behaviour]" ' + (row.student_behaviour == "4" ? "checked" : "") + ' value="4">' +
                        //     '<label for="rating-4' + meta.row + '"></label>' +
                        //     '<input type="radio" id="rating-5' + meta.row + '" name="attendance[' + meta.row + '][student_behaviour]" ' + (row.student_behaviour == "5" ? "checked" : "") + ' value="5">' +
                        //     '<label for="rating-5' + meta.row + '"></label>' +
                        //     '</div>';
                        // var student_behaviour = '<div class="rating">' +
                        //     '<input type="radio" class="checkRadioBtn" id="rating-5' + meta.row + '" name="attendance[' + meta.row + '][student_behaviour]" ' + (row.student_behaviour == "5" ? "checked" : "") + ' value="5">' +
                        //     '<label for="rating-5' + meta.row + '"></label>' +
                        //     '<input type="radio" class="checkRadioBtn" id="rating-4' + meta.row + '" name="attendance[' + meta.row + '][student_behaviour]" ' + (row.student_behaviour == "4" ? "checked" : "") + ' value="4">' +
                        //     '<label for="rating-4' + meta.row + '"></label>' +
                        //     '<input type="radio" class="checkRadioBtn" id="rating-3' + meta.row + '" name="attendance[' + meta.row + '][student_behaviour]" ' + (row.student_behaviour == "3" ? "checked" : "") + ' value="3">' +
                        //     '<label for="rating-3' + meta.row + '"></label>' +
                        //     '<input type="radio" class="checkRadioBtn" id="rating-2' + meta.row + '" name="attendance[' + meta.row + '][student_behaviour]" ' + (row.student_behaviour == "2" ? "checked" : "") + ' value="2">' +
                        //     '<label for="rating-2' + meta.row + '"></label>' +
                        //     '<input type="radio" class="checkRadioBtn" id="rating-1' + meta.row + '" name="attendance[' + meta.row + '][student_behaviour]" ' + (row.student_behaviour == "1" ? "checked" : "") + ' value="1">' +
                        //     '<label for="rating-1' + meta.row + '"></label>' +
                        //     '</div>';

                        var student_behaviour = '<div class="row">' +
                            '<div class="radio_group_1">' +
                            '<input type="radio" value="smile" title="smile    " ' + (row.student_behaviour == "smile" ? "checked" : "") + ' name="attendance[' + meta.row + '][student_behaviour]">' +
                            '<label for="smile">' +
                            '<i class="far fa-smile"></i>' +
                            '</label>' +
                            '</div>' +
                            '<div class="radio_group_1">' +
                            '<input type="radio" value="angry" title="angry" ' + (row.student_behaviour == "angry" ? "checked" : "") + ' name="attendance[' + meta.row + '][student_behaviour]">' +
                            '<label for="angry">' +
                            '<i class="far fa-angry"></i>' +
                            '</label>' +
                            '</div>' +
                            '<div class="radio_group_1">' +
                            '<input type="radio" value="dizzy" title="dizzy" ' + (row.student_behaviour == "dizzy" ? "checked" : "") + ' name="attendance[' + meta.row + '][student_behaviour]">' +
                            '<label for="dizzy">' +
                            '<i class="far fa-dizzy"></i>' +
                            '</label>' +
                            '</div>' +
                            '<div class="radio_group_1">' +
                            '<input type="radio" value="surprise" title="surprise" ' + (row.student_behaviour == "surprise" ? "checked" : "") + ' name="attendance[' + meta.row + '][student_behaviour]">' +
                            '<label for="surprise">' +
                            '<i class="far fa-surprise"></i>' +
                            '</label>' +
                            '</div>' +
                            '<div class="radio_group_1">' +
                            '<input type="radio" value="tired" title="tired" ' + (row.student_behaviour == "tired" ? "checked" : "") + ' name="attendance[' + meta.row + '][student_behaviour]">' +
                            '<label for="tired">' +
                            '<i class="far fa-tired"></i>' +
                            '</label>' +
                            '</div>' +
                            '</div>';


                        // var student_behaviour = '<span class="rating">' +
                        //     '<input type="radio" name="attendance[' + meta.row + '][student_behaviour]" ' + (row.student_behaviour == "1" ? "checked" : "") + ' value="1"><i></i>' +
                        //     '<input type="radio" name="attendance[' + meta.row + '][student_behaviour]" ' + (row.student_behaviour == "2" ? "checked" : "") + ' value="2"><i></i>' +
                        //     '<input type="radio" name="attendance[' + meta.row + '][student_behaviour]" ' + (row.student_behaviour == "3" ? "checked" : "") + ' value="3"><i></i>' +
                        //     '<input type="radio" name="attendance[' + meta.row + '][student_behaviour]" ' + (row.student_behaviour == "4" ? "checked" : "") + ' value="4"><i></i>' +
                        //     '<input type="radio" name="attendance[' + meta.row + '][student_behaviour]" ' + (row.student_behaviour == "5" ? "checked" : "") + ' value="5"><i></i>' +
                        //     '</span>';
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
                            '<i class="fas fa-thumbs-down"></i>' +
                            '</label>' +
                            '</div>' +
                            '</div>';


                        // var classroom_behaviour = '<label>' +
                        //     '<input type="radio" value="likes" ' + (row.classroom_behaviour == "likes" ? "checked" : "") + ' name="attendance[' + meta.row + '][classroom_behaviour]">' +
                        //     '<i class="far fa-thumbs-up" style="font-size:20px;color:blue"></i>' +
                        //     '</label>' +
                        //     '<label>' +
                        //     '<input type="radio" value="dislikes" ' + (row.classroom_behaviour == "dislikes" ? "checked" : "") + ' name="attendance[' + meta.row + '][classroom_behaviour]">' +
                        //     '<i class="far fa-thumbs-down" style="font-size:20px;color:blue"></i>' +
                        //     '</label>';


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
                    if (response.data.length > 0) {

                        layoutModeGrid += '<div class="row">';
                        response.data.forEach(function (res) {

                            // layout mode div start
                            layoutModeGrid += layoutMode(res);
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

                    var formData = new FormData();
                    formData.append('token', token);
                    formData.append('branch_id', branchID);
                    formData.append('class_id', classID);
                    formData.append('section_id', sectionID);
                    formData.append('subject_id', subjectID);
                    formData.append('date', convertDigitIn(classDate));
                    widgetShow(formData)

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
    // widget function
    function widgetShow(formData) {
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
        listTable = $('#dailyReportRemarks').DataTable({
            processing: true,
            bDestroy: true,
            info: true,
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
                    data: 'first_name'
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
                        var first_name = '<input type="hidden" name="daily_report_remarks[' + meta.row + '][id]" value="' + row.id + '">' +
                            '<input type="hidden" name="daily_report_remarks[' + meta.row + '][student_id]" value="' + row.student_id + '">' +
                            '<img src="' + defaultImg + '" class="mr-2 rounded-circle">' +
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

        // $(".shortTestHideSHow").show();
        $('#shortTestAppend').empty();
        $('#shortTestTableAppend').empty();

        var shortTestAppend = "";
        var shortTestTable = "";
        var index = 0;
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
                        '<input type="hidden" name="subject_id" value="' + subjectID + '">';

                }

                shortTestTable += start +
                    '</td>' +
                    '<td class="table-user">' +
                    '<img src="' + defaultImg + '" class="mr-2 rounded-circle">' +
                    '<a href="javascript:void(0);" class="text-body font-weight-semibold">' + res.first_name + ' ' + res.last_name + '</a>' +
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

    // Set the date we're counting down to
    var intervalId;

    function countdownTimeStart(timetable_class) {

        var d = new Date();
        var CountDownID = document.getElementById("classroom_count_down");
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
            var returned_endate = moment(d).subtract(5, 'minutes');
            var endDate = returned_endate.toDate();
        }
        // its end date time of  countdown
        var countDownDate = endDate.getTime();
        // Update the count down every 1 second
        intervalId = setInterval(function () {

            // Get todays date and time
            var now = new Date().getTime();

            // Find the distance between now an the count down date
            var distance = countDownDate - now;

            // Time calculations for days, hours, minutes and seconds
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);
            // Output the result in an element with id
            CountDownID.innerHTML = hours + "h " +
                minutes + "m " + seconds + "s ";
            // If the count down is over, write some text 
            if (distance < 0) {
                clearInterval(intervalId);
                CountDownID.innerHTML = "00:00:00";
                return;
            }
        }, 1000);
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

    function studentleave() {

        var classID = $("#changeClassName").val();
        var sectionID = $("#sectionID").val();
        var classDate = $("#classDate").val();
        var format_date = convertDigitIn(classDate);
        console.log("---");
        console.log(classID);
        console.log(sectionID);
        console.log(format_date);
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
                console.log(response);
                StudentLeave_tbl(dataSetNew);
                // if (response.data.length > 0) {
                //     console.log('response');
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
        console.log(local);
        listTable = $('#stdleaves').DataTable({
            processing: true,
            bDestroy: true,
            info: true,
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
                        var first_name = '<input type="hidden" id="student_leave_tbl_rowid[' + meta.row + '][id]" value="' + row.id + '">' +
                            '<input type="hidden" name="student_leave_upd[' + meta.row + '][student_id]" value="' + row.student_id + '">' +
                            '<img src="' + defaultImg + '" class="mr-2 rounded-circle">' +
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
                    "width": "10%",
                    "render": function (data, type, row, meta) {

                        var addremarks = '<textarea style="display:none;" class="addRemarksStudent" data-id="' + row.id + '" id="addRemarksStudent' + row.id + '" >'+ (row.teacher_remarks !== "null" ? row.teacher_remarks : "") +'</textarea>' +
                            '<button type="button" data-id="' + row.id + '" class="btn btn-outline-info waves-effect waves-light" data-toggle="modal" data-target="#stuLeaveRemarksPopup" id="editLeaveRemarksStudent">Add Remarks</button>';
                        return addremarks;
                    }
                },
                {
                    "targets": 8,
                    "width": "10%",
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
        console.log(student_leave_approve, teacher_remarks);
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
});