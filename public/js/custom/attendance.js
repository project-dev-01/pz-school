$(function () {
    $("#employee_attendance_report").hide();

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
    // rules validation
    $("#employeeAttendanceReport").validate({
        rules: {
            employee: "required",
            date: "required",
        }
    });

    $('#employeeAttendanceReport').on('submit', function (e) {
        e.preventDefault();
        var check = $("#employeeAttendanceReport").valid();
        if (check === true) {

            var reportDate = $("#employeeReportDate").val();
            var employee = $("#employeeReportEmployee").val();

            var date = new Date(reportDate)
            var year_month = ("0" + (date.getMonth() + 1)).slice(-2) + "-" + date.getFullYear();

            // var date = new Date();
            var firstDay = new Date(date.getFullYear(), date.getMonth(), 1);
            var firstDayTd = new Date(date.getFullYear(), date.getMonth(), 1);
            var lastDay = new Date(date.getFullYear(), date.getMonth() + 1, 0);

            var days = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];

            var formData = new FormData();
            formData.append('token', token);
            formData.append('branch_id', branchID);
            formData.append('employee', employee);
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

                        $("#employee_attendance_report").show();

                        var get_attendance_list = response.data.staff_details;
                        // var late_present_graph = response.data.late_present_graph;


                        $("#employeeAttendanceReportListShow").empty(attendanceListShow);
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
                                '<th>Total<br>Holiday</th>' +
                                '</tr>' +
                                '</thead>' +
                                '<tbody>';
                            // add functions tr start
                            get_attendance_list.forEach(function (res) {
                                attendanceListShow += '<tr>' +
                                    '<td class="text-left staffRow">' +
                                    '<a class="nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light staffDetails" href="javascript:void(0)" role="button" aria-haspopup="false" aria-expanded="false">' +
                                    '<input type="hidden" value="' + res.staff_id + '">';
                                    // '<a class="nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light" data-toggle="modal" data-target="#latedetails" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">' +
                                    if(res.photo) {
                                        attendanceListShow +=  '<img src="' + staffImg + '/' +res.photo + '" alt="user-image" class="rounded-circle">';
                                    }else{
                                        attendanceListShow +=  '<img src="' + defaultImg + '" alt="user-image" class="rounded-circle">';
                                    }
                                attendanceListShow +=  '</a>' + res.first_name + ' ' + res.last_name + '</td>';

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
                                            if (res.status == "holiday") {
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
    });

    var count = 0;
    $("#employeeAttendanceFilter").validate({
        rules: {
            employee: "required",
            date: "required",
        }
    });
    // add designation
    $('#employeeAttendanceFilter').on('submit', function (e) {
        e.preventDefault();
        var filterCheck = $("#employeeAttendanceFilter").valid();
        if (filterCheck === true) {

            $("#employee_attendance").hide("slow");
            $("#employee_attendance_body").empty();
            var date = $("#employeeDate").val();
            $("#employee_form_date").val(date);

            var form = this;
            $.ajax({
                url: $(form).attr('action'),
                method: $(form).attr('method'),
                data: new FormData(form),
                processData: false,
                dataType: 'json',
                contentType: false,
                success: function (data) {
                    console.log('att',data)
                    if (data.code == 200) {
                        $("#employee_attendance").show("slow");
                        $("#employee_attendance_body").html(data.data);
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
            row += '<tr id="row'+count+'"> ';
            if(val.id)
            {
                row += '<input type="hidden" name="attendance[' + count + '][id]" value="' + val.id +'">';
            }else{
                row += '<input type="hidden" name="attendance[' + count + '][id]" value="">';
            }
            row += '<td width="15%">';
            row += '<div class="form-group">';
            row += '<input type="text" name="attendance[' + count + '][staff]" class="form-control" value="' + val.staff_name +'">';
            row += '<input type="hidden" name="attendance[' + count + '][staff_id]" value="' + val.staff_id +'">';
            row += '</div>';
            row += '</td>';
            row += '<td width="15%">';
            row += '<div class="form-group">';
            row += '<input type="text" name="attendance[' + count + '][department]" class="form-control" value="' + val.department_name +'">';
            row += '</div>';
            row += '</td>';
            row += '<td width="20%">';
            row += '<div class="form-group">';
            row += '<select  class="form-control"  name="attendance[' + count + '][status]">';
            row += '<option value="">Select Status</option>';
            if(val.status == "present")
            {
                row += '<option value="present" Selected>Present</option>';
                row += '<option value="absent">Absent</option>';
                row += '<option value="holiday">Holiday</option>';
            }else if(val.status == "absent")
            {
                row += '<option value="present">Present</option>';
                row += '<option value="absent" Selected>Absent</option>';
                row += '<option value="holiday">Holiday</option>';
            }else if(val.status == "holiday")
            {
                row += '<option value="present">Present</option>';
                row += '<option value="absent">Absent</option>';
                row += '<option value="holiday" Selected>Holiday</option>';
            }else{
                row += '<option value="present">Present</option>';
                row += '<option value="absent">Absent</option>';
                row += '<option value="holiday">Holiday</option>';
            }
            row += '</select>';
            row += '</div>';
            row += '</td>';
            row += '<td width="10%">';
            row += '<div class="form-group">';
            row += '<input class="form-control" type="time" name="attendance[' + count + '][check_in]" value="' + val.check_in + '">';
            row += '</div>';
            row += '</td>';
            row += '<td width="10%">';
            row += '<div class="form-group">';
            row += '<input class="form-control" type="time" name="attendance[' + count + '][check_out]" value="' + val.check_out + '">';
            row += '</div>';
            row += '</td>';
            row += '<td width="10%">';
            row += '<div class="form-group">';
            if(val.hours)
            {
                row += '<input type="remarks" name="attendance[' + count + '][hours]" class="form-control" value="' + val.hours + '">';
            }else{
                row += '<input type="remarks" name="attendance[' + count + '][hours]" class="form-control" value="">';
            }
            row += '</div>';
            row += '</td>';
            row += '<td width="20%">'; 
            if(val.remarks)
            {
                row += '<input type="remarks" name="attendance[' + count + '][remarks]" class="form-control" value="' + val.remarks + '">';
            }else{
                row += '<input type="remarks" name="attendance[' + count + '][remarks]" class="form-control" value="">';
            }
            row += '</td>';
            row += '</tr>';

            count++;

            $("#employee_attendance_body").append(row);
        });
    }

});