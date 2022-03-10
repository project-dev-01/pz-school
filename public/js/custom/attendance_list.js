$(function () {

    $("#attendanceReport").hide();

    $('#attendanceList').datepicker({
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
                                '<td>' + get_attendance_list[0].first_name + ' ' + get_attendance_list[0].last_name + '</td>';

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

});