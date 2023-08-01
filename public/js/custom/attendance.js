$(function () {

    $(document).on('change', ".status", function (e) {
        e.preventDefault();
        var status = $(this).val();
        console.log('cv', status)
        if (status == "absent") {
            $(this).closest('tr').find('.checkin').val("");
            $(this).closest('tr').find('.checkout').val("");
            $(this).closest('tr').find('.hours').val("");

            $(this).closest('tr').find('.checkin').prop('readonly', true);
            $(this).closest('tr').find('.checkout').prop('readonly', true);
            $(this).closest('tr').find('.hours').prop('readonly', true);
        } else {
            if (status == "present") {
                $(this).closest('tr').find('.checkin').val(employee_check_in_time);
                $(this).closest('tr').find('.checkout').val(employee_check_out_time);

                var valuein = moment.duration(employee_check_in_time, 'HH:mm');
                var valueout = moment.duration(employee_check_out_time, 'HH:mm');
                var difference = valueout.subtract(valuein);
                
                var hours = ("0" + difference.hours()).slice(-2) + ":" + ("0" + difference.minutes()).slice(-2);
                $(this).closest('tr').find('.hours').val(hours);
            }
            $(this).closest('tr').find('.checkin').prop('readonly', false);
            $(this).closest('tr').find('.checkout').prop('readonly', false);
            $(this).closest('tr').find('.hours').prop('readonly', false);
        }
        
        var reason = $(this).closest('tr').find('.reason');
        reason.empty();
        reason.append('<option value="">'+select_reason+'</option>');
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

    $("#department").on('change', function (e) {
        e.preventDefault();
        var department = $(this).val();
        $("#employee").empty();
        $("#employee").append('<option value="">'+select_employee+'</option>');
        $.post(employeeByDepartment, { token: token, branch_id: branchID, department_id: department }, function (res) {
            if (res.code == 200) {
                $.each(res.data, function (key, val) {
                    $("#employee").append('<option value="' + val.id + '">' + val.first_name + ' ' + val.last_name + '</option>');
                });
            }
        }, 'json');
    });

    $("#employeeReportDepartment").on('change', function (e) {
        e.preventDefault();
        var department = $(this).val();
        $("#employeeReportEmployee").empty();
        $("#employeeReportEmployee").append('<option value="">'+select_employee+'</option>');
        $("#employeeReportEmployee").append('<option value="All">'+all_lang+'</option>');
        $.post(employeeByDepartment, { token: token, branch_id: branchID, department_id: department }, function (res) {
            if (res.code == 200) {
                $.each(res.data, function (key, val) {
                    $("#employeeReportEmployee").append('<option value="' + val.id + '">' + val.first_name + ' ' + val.last_name + '</option>');
                });
            }
        }, 'json');
    });


    $("#employee_attendance_widget").hide();
    $("#employee_attendance_report").hide();

    $('#employeeDate').datepicker({
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
        yearRange: "-100:+50", // last hundred years
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
            department: "required",
            employee: "required",
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
            var department = $("#employeeReportDepartment").val();
            var session = $("#employeeReportSession").val();

            var date = new Date(reportDate)
            var year_month = ("0" + (date.getMonth() + 1)).slice(-2) + "-" + date.getFullYear();

            // var date = new Date();
            var firstDay = new Date(date.getFullYear(), date.getMonth(), 1);
            var firstDayTd = new Date(date.getFullYear(), date.getMonth(), 1);
            var lastDay = new Date(date.getFullYear(), date.getMonth() + 1, 0);
            var days = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];

            //excel download

            $("#excelEmployee").val(employee);
            $("#excelDepartment").val(department);
            $("#excelSession").val(session);
            $("#excelDate").val(year_month);

            var formData = new FormData();
            formData.append('token', token);
            formData.append('branch_id', branchID);
            formData.append('employee', employee);
            formData.append('session', session);
            formData.append('department', department);
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
                        $("#downExcelDepartment").val(department);
                        $("#downExcelDate").val(year_month);

                        $("#employeeAttendanceReportListShow").empty();
                        var attendanceListShow = "";
                        var widgetpresent = 0;
                        var widgetabsent = 0;
                        var widgetlate = 0;
                        var widgetexcused = 0;
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
                                '<th>Total<br>Excused</th>' +
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
                                            if (res.status == "excused") {
                                                color = "btn-info";
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
                                    '<td>' + res.excusedCount + '</td>' +
                                    '</tr>';

                                widgetpresent += res.presentCount;
                                widgetabsent += res.absentCount;
                                widgetlate += res.lateCount;
                                widgetexcused += res.excusedCount;
                            });

                            // add functions tr end
                            attendanceListShow += '</tbody>' +
                                '</table>' +
                                '</div>';
                        } else {
                            attendanceListShow += '<div class="row">' +
                                '<div class="col-md-12 text-center">' +
                                no_data_available +
                                '</div>'
                            '</div>';
                        }
                        $("#widget-present").text(widgetpresent);
                        $("#widget-absent").text(widgetabsent);
                        $("#widget-late").text(widgetlate);
                        $("#widget-excused").text(widgetexcused);
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

    $("#employeeDate").datepicker({
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
        autoclose: true,
        yearRange: "-100:+50", // last hundred years
    });

    var count = 0;
    $("#employeeAttendanceFilter").validate({
        rules: {
            department: "required",
        }
    });
    // add designation
    $('#employeeAttendanceFilter').on('submit', function (e) {
        e.preventDefault();
        var filterCheck = $("#employeeAttendanceFilter").valid();
        if (filterCheck === true) {

            var reportDate = $("#employeeDate").val();
            var employee = $("#employee").val();
            var department = $("#department").val();
            var session_id = $("#session_id").val();


            var date = new Date(reportDate);

            var firstDay = new Date(date.getFullYear(), date.getMonth(), 1);
            var lastDay = new Date(date.getFullYear(), date.getMonth() + 1, 0);

            var formData = new FormData();
            formData.append('token', token);
            formData.append('branch_id', branchID);
            formData.append('employee', employee);
            formData.append('department', department);
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

        $.each(data, function (key, val) {
            var row = "";
            var disabled = "";
            var holiday = "";
            var color = "";
            if(val.holiday == 1){
                var color = "#8e9597";
                var holiday = "disabled";
            }
            row += '<tr id="row' + count + '" style="background-color:'+color+'"> ';
            if (val.details.id) {
                row += '<input type="hidden" name="attendance[' + count + '][id]" value="' + val.details.id + '"'+ holiday +'>';
            } else {
                row += '<input type="hidden" name="attendance[' + count + '][id]" value=""'+ holiday +'>';
            }
            row += '<td width="15%">';
            row += '<div class="form-group">';
            row += '<input type="text" name="attendance[' + count + '][date]" class="form-control" value="' + val.date + '"'+ holiday +'>';
            row += '</div>';
            row += '</td>';
            row += '<td width="10%">';
            row += '<div class="form-group">';
            row += '<select  class="form-control status"  name="attendance[' + count + '][status]"'+ holiday +'>';
            row += '<option value="">'+select_status+'</option>';
            if (val.leave) {
                row += '<option value="present">'+present_lang+'</option>';
                row += '<option value="absent" ' + (val.leave.leave_type == "absent" ? "selected" : "") + '>'+absent_lang+'</option>';
                row += '<option value="late">'+late_lang+'</option>';
                row += '<option value="excused" ' + (val.leave.leave_type == "excused" ? "selected" : "") + '>'+excused_lang+'</option>';
                disabled = "readonly";
            } else {
                row += '<option value="present" ' + (val.details.status == "present" ? "selected" : "") + '>'+present_lang+'</option>';
                row += '<option value="absent"' + (val.details.status == "absent" ? "selected" : "") + '>'+absent_lang+'</option>';
                row += '<option value="late"' + (val.details.status == "late" ? "selected" : "") + '>'+late_lang+'</option>';
                row += '<option value="excused"' + (val.details.status == "excused" ? "selected" : "") + '>'+excused_lang+'</option>';
            }
            row += '</select>';
            row += '</div>';
            row += '</td>';
            row += '<td width="10%">';
            row += '<div class="form-group">';
            row += '<input class="form-control checkin" type="time" name="attendance[' + count + '][check_in]"  value="' + moment(val.details.check_in, 'HH:mm:ss').format('HH:mm') + '" ' + disabled + ''+ holiday +'> ';
            row += '</div>';
            row += '</td>';
            row += '<td width="10%">';
            row += '<div class="form-group">';
            row += '<input class="form-control checkout" type="time" name="attendance[' + count + '][check_out]" value="' + moment(val.details.check_out, 'HH:mm:ss').format('HH:mm') + '" ' + disabled + ''+ holiday +'>';
            row += '</div>';
            row += '</td>';
            row += '<td width="10%">';
            row += '<div class="form-group">';
            if (val.details.hours) {
                row += '<input type="text" name="attendance[' + count + '][hours]" class="form-control hours" value="' + val.details.hours + '" ' + disabled + ' '+ holiday +'>';
            } else {
                row += '<input type="text" name="attendance[' + count + '][hours]" class="form-control hours" value="" ' + disabled + ''+ holiday +'>';
            }
            row += '</div>';
            row += '</td>';
            row += '<td width="15%">';
            row += '<div class="form-group">';
            row += '<select  class="form-control reason"  name="attendance[' + count + '][reason_id]"'+ holiday +'>';
            row += '<option value="">'+select_reason+'s</option>';
            if (val.leave) {
                var reason = val.leave.reason_id;
                var status = "absent";
            } else {
                var reason = val.details.reason_id;
                var status = val.details.status;
            }
            if (status == "absent") {
                console.log('ab_rea', val.absent_reason)
                $.each(val.absent_reason, function (keys, val_rea) {
                    row += '<option value="' + val_rea.id + '" ' + (reason == val_rea.id ? "selected" : "") + '>' + val_rea.name + '</option>';
                });
            } else if (status == "excused") {
                console.log('ex_rea', val.excused_reason)
                $.each(val.excused_reason, function (keys, val_rea) {
                    row += '<option value="' + val_rea.id + '" ' + (reason == val_rea.id ? "selected" : "") + '>' + val_rea.name + '</option>';
                });
            }
            row += '</select>';
            row += '</div>';
            row += '</td>';
            row += '<td width="15%">';

            if (val.leave) {
                row += '<input type="remarks" name="attendance[' + count + '][remarks]" class="form-control" value="' + val.leave.remarks + '"'+ holiday +'>';
            } else {
                if (val.details.remarks) {
                    row += '<input type="remarks" name="attendance[' + count + '][remarks]" class="form-control" value="' + val.details.remarks + '"'+ holiday +'>';
                } else {
                    row += '<input type="remarks" name="attendance[' + count + '][remarks]" class="form-control" value=""'+ holiday +'>';
                }
            }
            row += '</td>';
            row += '</tr>';

            count++;

            $("#employee_attendance_body").append(row);
        });
    }

});