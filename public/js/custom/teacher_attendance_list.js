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
    // change classroom
    $('#changeClassName').on('change', function () {
        $(".attendanceReport").hide();
        var class_id = $(this).val();
        $("#attendanceFilter").find("#sectionID").empty();
        $("#attendanceFilter").find("#sectionID").append('<option value="">Select Section</option>');
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
            class_date: "required"
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
            formData.append('class_id', class_id);
            formData.append('section_id', section_id);
            formData.append('subject_id', subject_id);
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
                                    '<td class="text-left studentRow">' +
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
                    console.log(labels,resonsCount);
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


});