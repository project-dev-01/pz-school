$(function () {

    $("#attendanceReport").hide();

    $('#attendanceList').datepicker({
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true,
        dateFormat: 'MM yy',
        // autoclose: true,
        yearRange: "-100:+50", // last hundred years
        onClose: function (dateText, inst) {
            $(this).datepicker('setDate', new Date(inst.selectedYear, inst.selectedMonth, 1));
        }
    });
    
    $("#attendanceList").focus(function () {
        $(".ui-datepicker-calendar").hide();
        $("#ui-datepicker-div").position({
            my: "center top",
            at: "center bottom",
            of: $(this)
        });
    });

    // rules validation
    $("#getAttendanceList").validate({
        rules: {
            year_month: "required",
            subject_id: "required"
        }
    });

    $('#getAttendanceList').on('submit', function (e) {
        e.preventDefault();
        var check = $("#getAttendanceList").valid();
        if (check === true) {

            var attendanceList = $("#attendanceList").val();
            var subject_id = $("#subject_id").val();
            var student_id = $("#student_id").val();

            var date = new Date(attendanceList)
            var year_month = ("0" + (date.getMonth() + 1)).slice(-2) + "-" + date.getFullYear();

            // var date = new Date();
            var firstDay = new Date(date.getFullYear(), date.getMonth(), 1);
            var firstDayTd = new Date(date.getFullYear(), date.getMonth(), 1);
            var lastDay = new Date(date.getFullYear(), date.getMonth() + 1, 0);

            var days = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];

            var formData = new FormData();
            formData.append('token', token);
            formData.append('branch_id', branchID);
            formData.append('year_month', year_month);
            formData.append('ref_user_id', ref_user_id);
            formData.append('student_id', student_id);
            formData.append('subject_id', subject_id);

            $.ajax({
                url: getAttendanceList,
                method: 'post',
                data: formData,
                processData: false,
                dataType: 'json',
                contentType: false,
                success: function (response) {
                    console.log(response)
                    if (response.code == 200) {

                        $("#attendanceReport").show();

                        var get_attendance_list = response.data.get_attendance_list;
                        var get_attendance_counts = response.data.get_attendance_counts;

                        $("#attendanceListShow").empty(attendanceListShow);
                        var attendanceListShow = "";
                        var i = 1;
                        if (get_attendance_list.length > 0) {
                            attendanceListShow += '<div class="table-responsive">' +
                                '<table id="attnList" class="table table-bordered mb-0">' +
                                '<thead>' +
                                '<tr>' +
                                '<th>Name</th>';
                            // '<th>' + get_attendance_list[0].first_name + '' + get_attendance_list[0].last_name + '</th>';
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
                                '<tbody>' +
                                '<tr>' +
                                '<td class="text-left">' +
                                '<a class="nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light studentDetails" href="javascript:void(0)" role="button" aria-haspopup="false" aria-expanded="false">' +
                                '<img src="' + defaultImg + '" alt="user-image" class="rounded-circle">' +
                                '</a>' + get_attendance_list[0].first_name + ' ' + get_attendance_list[0].last_name +
                                '</td>';

                            for (var s = firstDayTd; s <= lastDay; s.setDate(s.getDate() + 1)) {
                                // daysOfYear.push(new Date(d));
                                var currentDate = formatDate(new Date(s));

                                var i = 0;
                                get_attendance_list.forEach(function (res) {

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
                            attendanceListShow += '<td>' + get_attendance_counts[0].presentCount + '</td>' +
                                '<td>' + get_attendance_counts[0].absentCount + '</td>' +
                                '<td>' + get_attendance_counts[0].lateCount + '</td>' +
                                '</tr>' +
                                '' +
                                '</tbody>' +
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

                    } else {
                        toastr.error(data.message);
                    }
                }
            });
        }

    });
    // format date
    function formatDate(date) {
        var d = new Date(date),
            month = '' + (d.getMonth() + 1),
            day = '' + d.getDate(),
            year = d.getFullYear();

        if (month.length < 2)
            month = '0' + month;
        if (day.length < 2)
            day = '0' + day;

        return [year, month, day].join('-');
    }
    // export
    $("#exportAttendance").on("click", function () {
        fnExcelReport();
    });
    function fnExcelReport() {
        var table = document.getElementById('attnList'); // id of table
        var tableHTML = table.outerHTML;
        var fileName = 'download.xls';

        var msie = window.navigator.userAgent.indexOf("MSIE ");

        // If Internet Explorer
        if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./)) {
            dummyFrame.document.open('txt/html', 'replace');
            dummyFrame.document.write(tableHTML);
            dummyFrame.document.close();
            dummyFrame.focus();
            return dummyFrame.document.execCommand('SaveAs', true, fileName);
        }
        //other browsers
        else {
            var a = document.createElement('a');
            tableHTML = tableHTML.replace(/  /g, '').replace(/ /g, '%20'); // replaces spaces
            a.href = 'data:application/vnd.ms-excel,' + tableHTML;
            a.setAttribute('download', fileName);
            document.body.appendChild(a);
            a.click();
            document.body.removeChild(a);
        }
    }

    $('#classDate').datepicker({
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true,
        dateFormat: 'MM yy',
        // autoclose: true,
        yearRange: "-100:+50", // last hundred years
        onClose: function (dateText, inst) {
            $(this).datepicker('setDate', new Date(inst.selectedYear, inst.selectedMonth, 1));
        }
    });
    // change classroom
    $('#changeClassName').on('change', function () {
        $(".attendanceReport").hide();
        var class_id = $(this).val();
        $("#attendanceFilter").find("#sectionID").empty();
        $("#attendanceFilter").find("#sectionID").append('<option value="">'+select_section+'</option>');
        $("#attendanceFilter").find("#subjectID").empty();
        $("#attendanceFilter").find("#subjectID").append('<option value="">'+select_subject+'</option>');

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
        $("#attendanceFilter").find("#subjectID").append('<option value="">'+select_subject+'</option>');
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
        console.log('sa')
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

            var formData = new FormData();
            formData.append('token', token);
            formData.append('branch_id', branchID);
            formData.append('class_id', class_id);
            formData.append('section_id', section_id);
            formData.append('subject_id', subject_id);
            formData.append('semester_id', semester_id);
            formData.append('session_id', session_id);
            formData.append('year_month', year_month);

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

});