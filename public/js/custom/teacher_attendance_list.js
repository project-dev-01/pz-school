$(function () {

    $(".attendanceReport").hide();
    var reasonChart;
    // monthly present,late,absent start
    colors = ["#1FAB44", "#FEB019", "#EB5234"];
    (dataColors = $("#late-present-absent").data("colors")) && (colors = dataColors.split(","));
    options = {
        chart: {
            height: 380,
            type: "line"
        },
        stroke: {
            width: 2,
            curve: "smooth"
        },
        series: [],
        colors: colors,
        fill: {
            type: "solid",
            opacity: [.35, 1]
        },
        labels: [],
        markers: {
            size: 0
        },
        // yaxis: [{
        //     min: 0,
        //     max: 100,
        //     labels: {
        //         formatter: function (val, index) {
        //             return val;
        //         }
        //     }
        // }, {
        //     min: 0,
        //     max: 100,
        //     opposite: !0,
        //     labels: {
        //         formatter: function (val, index) {
        //             return val;
        //         }
        //     }
        // }
        // ],
        tooltip: {
            shared: !0,
            intersect: !1,
            y: {
                formatter: function (e) {
                    return void 0 !== e ? e.toFixed(0) : e
                }
            }
        },
        legend: {
            offsetY: 7
        }
    };
    (chart = new ApexCharts(document.querySelector("#late-present-absent"), options)).render();
    // monthly present,late,absent end
    $('#classDate').datepicker({
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true,
        dateFormat: 'MM yy',
        // autoclose: true,

        onClose: function (dateText, inst) {
            $(this).datepicker('setDate', new Date(inst.selectedYear, inst.selectedMonth, 1));
        }
    });

    $("#classDate").focus(function () {
        $(".ui-datepicker-calendar").hide();
        $("#ui-datepicker-div").position({
            my: "center top",
            at: "center bottom",
            of: $(this)
        });
    });
    // change classroom
    $('#changeClassName').on('change', function () {
        $(".attendanceReport").hide();
        var class_id = $(this).val();
        $("#attendanceFilter").find("#sectionID").empty();
        $("#attendanceFilter").find("#sectionID").append('<option value="">Select Class</option>');
        $("#attendanceFilter").find("#subjectID").empty();
        $("#attendanceFilter").find("#subjectID").append('<option value="">Select Subject</option>');

        $.post(teacherSectionUrl, { token: token, branch_id: branchID, teacher_id: ref_user_id, class_id: class_id }, function (res) {
            if (res.code == 200) {
                $.each(res.data, function (key, val) {
                    $("#attendanceFilter").find("#sectionID").append('<option value="' + val.section_id + '">' + val.section_name + '</option>');
                });
            }
        }, 'json');
    });
    // change section
    $('#sectionID').on('change', function () {
        var section_id = $(this).val();
        var class_id = $("#changeClassName").val();
        $("#attendanceFilter").find("#subjectID").empty();
        $("#attendanceFilter").find("#subjectID").append('<option value="">Select Subject</option>');
        $.post(teacherSubjectUrl, {
            token: token,
            branch_id: branchID,
            teacher_id: ref_user_id,
            class_id: class_id,
            section_id: section_id,
            class_id: class_id,
            academic_session_id: academic_session_id,
        }, function (res) {
            if (res.code == 200) {
                $.each(res.data, function (key, val) {
                    $("#attendanceFilter").find("#subjectID").append('<option value="' + val.subject_id + '">' + val.subject_name + '</option>');
                });
            }
        }, 'json');
    });

    // rules validation
    $("#attendanceFilter").validate({
        rules: {
            class_id: "required",
            section_id: "required",
            subject_id: "required",
            class_date: "required",
            session_id: "required",
            semester_id: "required"
        }
    });

    $('#attendanceFilter').on('submit', function (e) {
        e.preventDefault();
        var check = $("#attendanceFilter").valid();
        if (check === true) {

            var attendanceList = $("#classDate").val();
            var class_id = $("#changeClassName").val();
            var section_id = $("#sectionID").val();
            var subject_id = $("#subjectID").val();
            var semester_id = $("#semesterID").val();
            var session_id = $("#sessionID").val();

            var date = new Date(attendanceList)
            var year_month = ("0" + (date.getMonth() + 1)).slice(-2) + "-" + date.getFullYear();

            // var date = new Date();
            var firstDay = new Date(date.getFullYear(), date.getMonth(), 1);
            var firstDayTd = new Date(date.getFullYear(), date.getMonth(), 1);
            var lastDay = new Date(date.getFullYear(), date.getMonth() + 1, 0);

            var days = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
            //excel download

            $("#excelSubject").val(subject_id);
            $("#excelClass").val(class_id);
            $("#excelSection").val(section_id);
            $("#excelSemester").val(semester_id);
            $("#excelSession").val(session_id);
            $("#excelDate").val(year_month);
            // pdf download
            $("#downExcelSubject").val(subject_id);
            $("#downExcelClass").val(class_id);
            $("#downExcelSection").val(section_id);
            $("#downExcelSemester").val(semester_id);
            $("#downExcelSession").val(session_id);
            $("#downExcelDate").val(year_month);

            var formData = new FormData();
            formData.append('token', token);
            formData.append('branch_id', branchID);
            formData.append('class_id', class_id);
            formData.append('section_id', section_id);
            formData.append('subject_id', subject_id);
            formData.append('semester_id', semester_id);
            formData.append('session_id', session_id);
            formData.append('year_month', year_month);
            formData.append('academic_session_id', academic_session_id);

            $.ajax({
                url: getAttendanceListTeacher,
                method: 'post',
                data: formData,
                processData: false,
                dataType: 'json',
                contentType: false,
                success: function (response) {

                    if (response.code == 200) {

                        $(".attendanceReport").show();

                        var get_attendance_list = response.data.student_details;
                        var late_present_graph = response.data.late_present_graph;


                        $("#attendanceListShow").empty(attendanceListShow);
                        var attendanceListShow = "";
                        var i = 1;
                        if (get_attendance_list.length > 0) {
                            attendanceListShow += '<div class="table-responsive">' +
                                '<table id="attnList" class="table table-bordered mb-0">' +
                                '<thead>' +
                                '<tr>' +
                                '<th>Name</th>';
                            // '<th>' + get_attendance_list.first_name + '' + get_attendance_list.last_name + '</th>';
                            for (var d = firstDay; d <= lastDay; d.setDate(d.getDate() + 1)) {
                                // daysOfYear.push(new Date(d));
                                var ds = new Date(d);
                                var dayName = days[ds.getDay()];
                                attendanceListShow += '<th>' + dayName + '<br>' + (i++) + '</th>';
                            }

                            attendanceListShow += '<th>Total<br>Present</th>' +
                                '<th>Total<br>Absent</th>' +
                                '<th>Total<br>Late</th>' +
                                '</tr>' +
                                '</thead>' +
                                '<tbody>';
                            // add functions tr start
                            get_attendance_list.forEach(function (res) {
                                attendanceListShow += '<tr>' +
                                    '<td class="text-left studentRow" style="display:grid;">' +
                                    // '<a class="nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light studentDetails" data-toggle="modal" data-id="' + res.student_id + '" data-toggle="dropdown" href="javascript:void(0)" role="button" aria-haspopup="false" aria-expanded="false">' +
                                    '<a class="nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light studentDetails" href="javascript:void(0)" role="button" aria-haspopup="false" aria-expanded="false">' +
                                    '<input type="hidden" value="' + res.student_id + '">' +
                                    // '<a class="nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light" data-toggle="modal" data-target="#latedetails" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">' +
                                    '<img src="' + defaultImg + '" alt="user-image" class="rounded-circle">' +
                                    '</a>' + res.first_name + ' ' + res.last_name +
                                    '</td>';

                                var attendance_details = res.attendance_details;

                                for (var s = firstDayTd; s <= lastDay; s.setDate(s.getDate() + 1)) {
                                    // daysOfYear.push(new Date(d));
                                    var currentDate = formatDate(new Date(s));

                                    var i = 0;
                                    attendance_details.forEach(function (res) {

                                        if (currentDate == res.date) {
                                            var color = "";
                                            if (res.status == "present") {
                                                color = "btn-success";
                                            }
                                            if (res.status == "absent") {
                                                color = "btn-danger";
                                            }
                                            if (res.status == "late") {
                                                color = "btn-warning";
                                            }
                                            attendanceListShow += '<td>' +
                                                '<input type="hidden" value="' + res.status + '" ></input>' +
                                                '<button type="button" class="btn btn-xs ' + color + ' waves-effect waves-light"><i class="mdi mdi-check"></i></button>' +
                                                '</td>';
                                            i = 1;
                                        }

                                    });
                                    if (i == 0) {
                                        attendanceListShow += '<td style="background-color: #ddd; cursor: not-allowed;"></td>';
                                        i = 1;
                                    }
                                }
                                firstDayTd = new Date(date.getFullYear(), date.getMonth(), 1);

                                attendanceListShow += '<td>' + res.presentCount + '</td>' +
                                    '<td>' + res.absentCount + '</td>' +
                                    '<td>' + res.lateCount + '</td>' +
                                    '</tr>';
                            });


                            // add functions tr end
                            attendanceListShow += '</tbody>' +
                                '</table>' +
                                '</div>';
                        } else {
                            attendanceListShow += '<div class="row">' +
                                '<div class="col-md-12 text-center">' +
                                'No data found' +
                                '</div>'
                            '</div>';
                        }

                        $("#attendanceListShow").append(attendanceListShow);
                        var newLabels = [];
                        var absentData = [];
                        var lateData = [];
                        var presentData = [];
                        if (late_present_graph.length > 0) {
                            // graph data
                            late_present_graph.forEach(function (res) {
                                newLabels.push(res.date);
                                absentData.push(res.absentCount);
                                lateData.push(res.lateCount);
                                presentData.push(res.presentCount);
                            });
                        }
                        chart.updateSeries([{
                            name: "PRESENT",
                            type: "line",
                            data: presentData
                        }, {
                            name: "LATE",
                            type: "line",
                            data: lateData
                        }, {
                            name: "Absent",
                            type: "line",
                            data: absentData
                        }]);
                        chart.updateOptions({
                            labels: newLabels
                        })

                    } else {
                        toastr.error(data.message);
                    }
                }
            });
        }

    });

    // studentDetails
    $(document).on('click', '.studentDetails', function () {
        var studentID = $(this).find('input').val();
        var classDate = $("#classDate").val();
        var class_id = $("#changeClassName").val();
        var section_id = $("#sectionID").val();
        var subject_id = $("#subjectID").val();

        var date = new Date(classDate)
        var year_month = ("0" + (date.getMonth() + 1)).slice(-2) + "-" + date.getFullYear();

        var formData = new FormData();
        formData.append('token', token);
        formData.append('branch_id', branchID);
        formData.append('class_id', class_id);
        formData.append('section_id', section_id);
        formData.append('subject_id', subject_id);
        formData.append('year_month', year_month);
        formData.append('student_id', studentID);
        $("#latedetails").modal('show');

        $.ajax({
            url: getReasonsByStudent,
            method: "POST",
            data: formData,
            dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success: function (response) {
                if (response.code == 200) {

                    var late_details = response.data;
                    var labels = [];
                    var resonsCount = [];
                    if (late_details.length > 0) {
                        $.each(late_details[0], function (key, value) {

                            labels.push(key);
                            resonsCount.push(value);
                        });
                    }
                    console.log(labels, resonsCount);
                    // chart
                    renderChart(labels, resonsCount);

                } else {
                    toastr.error(data.message);
                }

            }, error: function (err) {
                if (err.responseJSON.code == 422) {
                    toastr.error(err.responseJSON.data.error.profile_image[0] ? err.responseJSON.data.error.profile_image[0] : 'Something went wrong');
                }
            }
        })

    });

    function renderChart(labels, resonsCount) {

        if (reasonChart) {
            reasonChart.data.labels = labels;
            reasonChart.data.datasets[0].data = resonsCount;
            reasonChart.update();
        } else {
            var ctx = document.getElementById("reason-chart").getContext('2d');
            var defaultColors = ["#1abc9c", "#f1556c", "#4a81d4", "#e3eaef"];
            var colors = dataColors ? dataColors.split(",") : defaultColors.concat();

            reasonChart = new Chart(ctx, {
                type: 'radar',
                data: {
                    // labels: ["Fever", "Bus Breakdown", "Book Missing", "Others"],
                    labels: labels,
                    datasets: [{
                        label: "Reasons",
                        backgroundColor: hexToRGB(colors[0], 0.3),
                        borderColor: colors[0],
                        pointBackgroundColor: colors[0],
                        pointBorderColor: "#fff",
                        pointHoverBackgroundColor: "#fff",
                        pointHoverBorderColor: colors[0],
                        data: resonsCount
                    }]
                },
            });
        }


    }
    function hexToRGB(hex, alpha) {
        var r = parseInt(hex.slice(1, 3), 16),
            g = parseInt(hex.slice(3, 5), 16),
            b = parseInt(hex.slice(5, 7), 16);

        if (alpha) {
            return "rgba(" + r + ", " + g + ", " + b + ", " + alpha + ")";
        } else {
            return "rgb(" + r + ", " + g + ", " + b + ")";
        }
    }



    // Employee Attendance


    $(document).on('change', ".status", function (e) {
        e.preventDefault();
        var status = $(this).val();

        if (status == "absent") {
            $(this).closest('tr').find('.checkin').val("");
            $(this).closest('tr').find('.checkout').val("");
            $(this).closest('tr').find('.hours').val("");

            $(this).closest('tr').find('.checkin').prop('readonly', true);
            $(this).closest('tr').find('.checkout').prop('readonly', true);
            $(this).closest('tr').find('.hours').prop('readonly', true);

        } else {
            $(this).closest('tr').find('.checkin').prop('readonly', false);
            $(this).closest('tr').find('.checkout').prop('readonly', false);
            $(this).closest('tr').find('.hours').prop('readonly', false);
        }

        var reason = $(this).closest('tr').find('.reason');
        reason.empty();
        reason.append('<option value="">Select Reason</option>');
        $.post(getTeacherAbsentExcuse, {
            token: token,
            branch_id: branchID,
            status: status
        }, function (res) {
            if (res.code == 200) {
                $.each(res.data, function (key, val) {
                    reason.append('<option value="' + val.id + '">' + val.name + '</option>');
                });
            }
        }, 'json');
    });

    $(document).on('change', ".checkin", function (e) {
        e.preventDefault();
        var checkin = $(this).val();
        var checkout = $(this).closest('tr').find('.checkout').val();

        if (checkout) {
            var valuein = moment.duration(checkin, 'HH:mm');
            var valueout = moment.duration(checkout, 'HH:mm');
            if (valuein < valueout) {
                var difference = valueout.subtract(valuein);

                var hours = ("0" + difference.hours()).slice(-2) + ":" + ("0" + difference.minutes()).slice(-2);
                $(this).closest('tr').find('.hours').val(hours);
            } else {
                $(this).closest('tr').find('.checkin').val("");
                $(this).closest('tr').find('.hours').val("");
                alert('Check In Value Must be Lesser Than Check Out')
            }

        }
    });

    $(document).on('change', ".checkout", function (e) {
        e.preventDefault();
        var checkout = $(this).val();
        var checkin = $(this).closest('tr').find('.checkin').val();

        if (checkin) {
            var valuein = moment.duration(checkin, 'HH:mm');
            var valueout = moment.duration(checkout, 'HH:mm');
            if (valuein < valueout) {
                var difference = valueout.subtract(valuein);

                var hours = ("0" + difference.hours()).slice(-2) + ":" + ("0" + difference.minutes()).slice(-2);
                $(this).closest('tr').find('.hours').val(hours);
            } else {
                $(this).closest('tr').find('.checkout').val("");
                $(this).closest('tr').find('.hours').val("");
                alert('Check Out Value Must be Greater Than Check In')
            }

        }
    });

    // $("#department").on('change', function (e) {
    //     e.preventDefault(); 
    //     var department = $(this).val();
    //     $("#employee").empty();
    //     $("#employee").append('<option value="">Select Employee</option>');
    //     $.post(employeeByDepartment, { token: token, branch_id: branchID, department_id: department }, function (res) {
    //         if (res.code == 200) {
    //             $.each(res.data, function (key, val) {
    //                 $("#employee").append('<option value="' + val.id + '">' + val.first_name + ' ' + val.last_name + '</option>');
    //             });
    //         }
    //     }, 'json');
    // });

    // $("#employeeReportDepartment").on('change', function (e) {
    //     e.preventDefault(); 
    //     var department = $(this).val();
    //     $("#employeeReportEmployee").empty();
    //     $("#employeeReportEmployee").append('<option value="">Select Employee</option>');
    //     $("#employeeReportEmployee").append('<option value="All">All</option>');
    //     $.post(employeeByDepartment, { token: token, branch_id: branchID, department_id: department }, function (res) {
    //         if (res.code == 200) {
    //             $.each(res.data, function (key, val) {
    //                 $("#employeeReportEmployee").append('<option value="' + val.id + '">' + val.first_name + ' ' + val.last_name + '</option>');
    //             });
    //         }
    //     }, 'json');
    // });


    $("#employee_attendance_widget").hide();
    $("#employee_attendance_report").hide();

    $('#employeeDate').datepicker({
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true,
        dateFormat: 'MM yy',
        // autoclose: true,

        onClose: function (dateText, inst) {
            $(this).datepicker('setDate', new Date(inst.selectedYear, inst.selectedMonth, 1));
        }
    });

    $("#employeeDate").focus(function () {
        $(".ui-datepicker-calendar").hide();
        $("#ui-datepicker-div").position({
            my: "center top",
            at: "center bottom",
            of: $(this)
        });
    });

    $('#employeeReportDate').datepicker({
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true,
        dateFormat: 'MM yy',
        // autoclose: true,

        onClose: function (dateText, inst) {
            $(this).datepicker('setDate', new Date(inst.selectedYear, inst.selectedMonth, 1));
        }
    });

    $("#employeeReportDate").focus(function () {
        $(".ui-datepicker-calendar").hide();
        $("#ui-datepicker-div").position({
            my: "center top",
            at: "center bottom",
            of: $(this)
        });
    });
    // rules validation
    $("#employeeAttendanceReport").validate({
        rules: {
            date: "required",
            session_id: "required",
        }
    });

    $('#employeeAttendanceReport').on('submit', function (e) {
        e.preventDefault();
        var check = $("#employeeAttendanceReport").valid();
        if (check === true) {

            var reportDate = $("#employeeReportDate").val();
            var employee = $("#employeeReportEmployee").val();
            var session = $("#employeeReportSession").val();
            // var department = $("#employeeReportDepartment").val();

            var date = new Date(reportDate)
            var year_month = ("0" + (date.getMonth() + 1)).slice(-2) + "-" + date.getFullYear();

            // var date = new Date();
            var firstDay = new Date(date.getFullYear(), date.getMonth(), 1);
            var firstDayTd = new Date(date.getFullYear(), date.getMonth(), 1);
            var lastDay = new Date(date.getFullYear(), date.getMonth() + 1, 0);
            var days = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];

            //excel download
            $("#excelEmployee").val(employee);
            $("#excelSession").val(session);
            $("#excelDate").val(year_month);

            var formData = new FormData();
            formData.append('token', token);
            formData.append('branch_id', branchID);
            formData.append('employee', employee);
            formData.append('session', session);
            // formData.append('department', department);
            formData.append('date', year_month);

            $.ajax({
                url: getEmployeAttendanceReportList,
                method: 'post',
                data: formData,
                processData: false,
                dataType: 'json',
                contentType: false,
                success: function (response) {

                    if (response.code == 200) {

                        $("#employee_attendance_widget").show();
                        $("#employee_attendance_report").show();

                        var get_attendance_list = response.data.staff_details;
                        // var late_present_graph = response.data.late_present_graph;
                        // pdf download
                        $("#downExcelEmployee").val(employee);
                        $("#downExcelSession").val(session);
                        $("#downExcelDate").val(year_month);

                        $("#employeeAttendanceReportListShow").empty(attendanceListShow);
                        var attendanceListShow = "";
                        var widgetpresent = 0;
                        var widgetabsent = 0;
                        var widgetlate = 0;
                        var i = 1;
                        if (get_attendance_list.length > 0) {
                            attendanceListShow += '<div class="table-responsive">' +
                                '<table id="attnList" class="table table-bordered mb-0">' +
                                '<thead>' +
                                '<tr>' +
                                '<th>Session Name</th><th>Name</th>';
                            // '<th>' + get_attendance_list.first_name + '' + get_attendance_list.last_name + '</th>';
                            for (var d = firstDay; d <= lastDay; d.setDate(d.getDate() + 1)) {
                                // daysOfYear.push(new Date(d));
                                var ds = new Date(d);
                                var dayName = days[ds.getDay()];
                                attendanceListShow += '<th>' + dayName + '<br>' + (i++) + '</th>';
                            }

                            attendanceListShow += '<th>Total<br>Present</th>' +
                                '<th>Total<br>Absent</th>' +
                                '<th>Total<br>Late</th>' +
                                '</tr>' +
                                '</thead>' +
                                '<tbody>';
                            // add functions tr start
                            get_attendance_list.forEach(function (res) {
                                attendanceListShow += '<tr>' +
                                    '<td>' + res.session_name + '</td>' +
                                    '<td class="text-left staffRow">' +
                                    '<a class="nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light staffDetails" href="javascript:void(0)" role="button" aria-haspopup="false" aria-expanded="false">' +
                                    '<input type="hidden" value="' + res.staff_id + '">';
                                // '<a class="nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light" data-toggle="modal" data-target="#latedetails" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">' +
                                if (res.photo) {
                                    attendanceListShow += '<img src="' + staffImg + '/' + res.photo + '" alt="user-image" class="rounded-circle">';
                                } else {
                                    attendanceListShow += '<img src="' + defaultImg + '" alt="user-image" class="rounded-circle">';
                                }
                                attendanceListShow += '</a>' + res.first_name + ' ' + res.last_name + '</td>';

                                var attendance_details = res.attendance_details;

                                for (var s = firstDayTd; s <= lastDay; s.setDate(s.getDate() + 1)) {
                                    // daysOfYear.push(new Date(d));
                                    var currentDate = formatDate(new Date(s));

                                    var i = 0;
                                    attendance_details.forEach(function (res) {

                                        if (currentDate == res.date) {
                                            var color = "";
                                            if (res.status == "present") {
                                                color = "btn-success";
                                            }
                                            if (res.status == "absent") {
                                                color = "btn-danger";
                                            }
                                            if (res.status == "late") {
                                                color = "btn-warning";
                                            }
                                            attendanceListShow += '<td>' +
                                                '<input type="hidden" value="' + res.status + '" ></input>' +
                                                '<button type="button" class="btn btn-xs ' + color + ' waves-effect waves-light"><i class="mdi mdi-check"></i></button>' +
                                                '</td>';
                                            i = 1;
                                        }

                                    });
                                    if (i == 0) {
                                        attendanceListShow += '<td style="background-color: #ddd; cursor: not-allowed;"></td>';
                                        i = 1;
                                    }
                                }
                                firstDayTd = new Date(date.getFullYear(), date.getMonth(), 1);

                                attendanceListShow += '<td>' + res.presentCount + '</td>' +
                                    '<td>' + res.absentCount + '</td>' +
                                    '<td>' + res.lateCount + '</td>' +
                                    '</tr>';

                                widgetpresent += res.presentCount;
                                widgetabsent += res.absentCount;
                                widgetlate += res.lateCount;
                            });

                            // add functions tr end
                            attendanceListShow += '</tbody>' +
                                '</table>' +
                                '</div>';
                        } else {
                            attendanceListShow += '<div class="row">' +
                                '<div class="col-md-12 text-center">' +
                                'No data found' +
                                '</div>'
                            '</div>';
                        }
                        $("#widget-present").text(widgetpresent);
                        $("#widget-absent").text(widgetabsent);
                        $("#widget-late").text(widgetlate);
                        $("#employeeAttendanceReportListShow").append(attendanceListShow);
                        // var newLabels = [];
                        // var absentData = [];
                        // var lateData = [];
                        // var presentData = [];
                        // if (late_present_graph.length > 0) {
                        //     // graph data
                        //     late_present_graph.forEach(function (res) {
                        //         newLabels.push(res.date);
                        //         absentData.push(res.absentCount);
                        //         lateData.push(res.lateCount);
                        //         presentData.push(res.presentCount);
                        //     });
                        // }
                        // chart.updateSeries([{
                        //     name: "PRESENT",
                        //     type: "line",
                        //     data: presentData
                        // }, {
                        //     name: "LATE",
                        //     type: "line",
                        //     data: lateData
                        // }, {
                        //     name: "Absent",
                        //     type: "line",
                        //     data: absentData
                        // }]);
                        // chart.updateOptions({
                        //     labels: newLabels
                        // })

                    } else {
                        toastr.error(data.message);
                    }
                }
            });
        }

    });
    // $("#employeeDate").datepicker({
    //     dateFormat: 'MM yy',
    //     changeMonth: true,
    //     changeYear: true,
    //     showButtonPanel: true,

    //     onClose: function(dateText, inst) {
    //         var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
    //         var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
    //         $(this).val($.datepicker.formatDate('MM yy', new Date(year, month, 1)));
    //     }
    // });

    // $("#employeeDate").focus(function () {
    //     $(".ui-datepicker-calendar").hide();
    //     $("#ui-datepicker-div").position({
    //         my: "center top",
    //         at: "center bottom",
    //         of: $(this)
    //     });
    // });

    $("#employeeDate").datepicker({
        dateFormat: 'MM yy',
        changeMonth: true,
        changeYear: true,
        autoclose: true,
    });

    var count = 0;
    $("#employeeAttendanceFilter").validate({
        rules: {
            date: "required",
            session_id: "required",
        }
    });
    // add designation
    $('#employeeAttendanceFilter').on('submit', function (e) {
        e.preventDefault();
        var filterCheck = $("#employeeAttendanceFilter").valid();
        if (filterCheck === true) {

            var reportDate = $("#employeeDate").val();
            var employee = $("#employee").val();
            var session_id = $("#session_id").val();


            var date = new Date(reportDate);

            var firstDay = new Date(date.getFullYear(), date.getMonth(), 1);
            var lastDay = new Date(date.getFullYear(), date.getMonth() + 1, 0);

            var formData = new FormData();
            formData.append('token', token);
            formData.append('branch_id', branchID);
            formData.append('employee', employee);
            formData.append('session_id', session_id);

            formData.append('firstDay', formatDate(new Date(firstDay)));
            formData.append('lastDay', formatDate(new Date(lastDay)));

            $("#employee_attendance").hide("slow");
            $("#employee_attendance_body").empty();
            $("#employee_form_employee").val(employee);
            $("#employee_form_session_id").val(session_id);

            $.ajax({
                url: getEmployeAttendanceList,
                method: 'post',
                data: formData,
                processData: false,
                dataType: 'json',
                contentType: false,
                success: function (data) {
                    if (data.code == 200) {
                        $("#employee_attendance").show("slow");
                        callout(data.data)
                    }
                }
            });
        }
    });

    // add Employee Attendance
    $('#addEmployeeAttendanceForm').on('submit', function (e) {
        e.preventDefault();
        // $("#overlay").fadeIn(300);
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
                    // $("#overlay").fadeOut(300);
                } else {
                    toastr.error(data.message);
                    // $("#overlay").fadeOut(300);
                }
            }
        });
    });

    function callout(data) {
        console.log('123',data)
        $.each(data, function (key, val) {
            console.log('12s',val)
            var row = "";
            var disabled = "";
            row += '<tr id="row' + count + '"> ';
            if (val.details.id) {
                row += '<input type="hidden" name="attendance[' + count + '][id]" value="' + val.details.id + '">';
            } else {
                row += '<input type="hidden" name="attendance[' + count + '][id]" value="">';
            }
            row += '<td width="15%">';
            row += '<div class="form-group">';
            row += '<input type="text" name="attendance[' + count + '][date]" class="form-control" value="' + val.date + '">';
            row += '</div>';
            row += '</td>';
            row += '<td width="10%">';
            row += '<div class="form-group">';
            row += '<select  class="form-control status"  name="attendance[' + count + '][status]">';
            row += '<option value="">Select Status</option>';
            if (val.leave) {
                row += '<option value="present">Present</option>';
                row += '<option value="absent" ' + (val.leave.leave_type == "absent" ? "selected" : "") + '>Absent</option>';
                row += '<option value="late">Late</option>';
                row += '<option value="excused" ' + (val.leave.leave_type == "excused" ? "selected" : "") + '>Excused</option>';
                disabled = "readonly";
            } else {
                row += '<option value="present" ' + (val.details.status == "present" ? "selected" : "") + '>Present</option>';
                row += '<option value="absent"' + (val.details.status == "absent" ? "selected" : "") + '>Absent</option>';
                row += '<option value="late"' + (val.details.status == "late" ? "selected" : "") + '>Late</option>';
                row += '<option value="excused"' + (val.details.status == "excused" ? "selected" : "") + '>Excused</option>';
            }
            row += '</select>';
            row += '</div>';
            row += '</td>';
            row += '<td width="10%">';
            row += '<div class="form-group">';
            row += '<input class="form-control checkin" type="time" name="attendance[' + count + '][check_in]"  value="' + moment(val.details.check_in, 'HH:mm:ss').format('HH:mm') + '" ' + disabled + '> ';
            row += '</div>';
            row += '</td>';
            row += '<td width="10%">';
            row += '<div class="form-group">';
            row += '<input class="form-control checkout" type="time" name="attendance[' + count + '][check_out]" value="' + moment(val.details.check_out, 'HH:mm:ss').format('HH:mm') + '" ' + disabled + '>';
            row += '</div>';
            row += '</td>';
            row += '<td width="10%">';
            row += '<div class="form-group">';
            if (val.details.hours) {
                row += '<input type="text" name="attendance[' + count + '][hours]" class="form-control hours" value="' + val.details.hours + '" ' + disabled + ' >';
            } else {
                row += '<input type="text" name="attendance[' + count + '][hours]" class="form-control hours" value="" ' + disabled + '>';
            }
            row += '</div>';
            row += '</td>';
            row += '<td width="15%">';
            row += '<div class="form-group">';
            row += '<select  class="form-control reason"  name="attendance[' + count + '][reason_id]">';
            row += '<option value="">Select Reasons</option>';
            if (val.leave) {
                var reason = val.leave.reason_id;
                var status = "absent";
            } else {
                var reason = val.details.reason_id;
                var status = val.details.status;
            }
            if (status == "absent") {
                $.each(val.absent_reason, function (keys, val_rea) {
                    row += '<option value="' + val_rea.id + '" ' + (reason == val_rea.id ? "selected" : "") + '>' + val_rea.name + '</option>';
                });
            } else if (status == "excused") {
                $.each(val.excused_reason, function (keys, val_rea) {
                    row += '<option value="' + val_rea.id + '" ' + (reason == val_rea.id ? "selected" : "") + '>' + val_rea.name + '</option>';
                });
            }
            row += '</select>';
            row += '</div>';
            row += '</td>';
            row += '<td width="15%">';

            if (val.leave) {
                row += '<input type="remarks" name="attendance[' + count + '][remarks]" class="form-control" value="' + val.leave.remarks + '">';
            } else {
                if (val.details.remarks) {
                    row += '<input type="remarks" name="attendance[' + count + '][remarks]" class="form-control" value="' + val.details.remarks + '">';
                } else {
                    row += '<input type="remarks" name="attendance[' + count + '][remarks]" class="form-control" value="">';
                }
            }
            row += '</td>';
            row += '</tr>';

            count++;

            $("#employee_attendance_body").append(row);
        });
    }

});