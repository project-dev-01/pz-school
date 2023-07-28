$(function () {
    var attitudeChart;
    var examResultChart;

    // monthly present,late,absent start
    // attendance report start
    colors = ["#1FAB44", "#FEB019", "#EB5234"];
    (dataColors = $("#anylitc-attend").data("colors")) && (colors = dataColors.split(","));
    options = {
        chart: {
            height: 320,
            type: "pie"
        },
        series: [],
        labels: [present_lang, absent_lang, late_lang],
        colors: colors,
        legend: {
            show: !0,
            position: "bottom",
            horizontalAlign: "center",
            verticalAlign: "middle",
            floating: !1,
            fontSize: "14px",
            offsetX: 0,
            offsetY: 7
        },
        title: {
            text: current_month_lang,
            align: 'left',
            margin: 10,
            offsetX: 0,
            offsetY: 0,
            floating: false,
            style: {
                fontSize: '14px',
                fontWeight: 'bold',
                fontFamily: undefined,
                color: '#263238'
            },
        },
        responsive: [{
            breakpoint: 600,
            options: {
                chart: {
                    height: 240
                },
                legend: {
                    show: !1
                }
            }
        }]
    };
    (attReportchart = new ApexCharts(document.querySelector("#anylitc-attend"), options)).render();
    // attendance report end
    // homework report start
    colors = ["#1FAB44", "#f1556c", "#4FC6E1"];
    (dataColors = $("#homework-status").data("colors")) && (colors = dataColors.split(","));
    options = {
        chart: {
            height: 320,
            type: "donut"
        },
        series: [],
        // series: [80, 15, 5],
        legend: {
            show: !0,
            position: "bottom",
            horizontalAlign: "center",
            verticalAlign: "middle",
            floating: !1,
            fontSize: "14px",
            offsetX: 0,
            offsetY: 7
        },
        labels: [complete_lang, incomplete_lang, late_submission_lang],
        colors: colors,
        responsive: [{
            breakpoint: 600,
            options: {
                chart: {
                    height: 240
                },
                legend: {
                    show: !1
                }
            }
        }],
        fill: {
            type: "gradient"
        }
    };
    (homeworkChart = new ApexCharts(document.querySelector("#homework-status"), options)).render();
    // homework report end
    // attitude report start
    // Build the chart
    Highcharts.setOptions({
        // colors: ['#87e680', '#ee4947', '#c2bd11', '#f2ee74', '#ea2522', '#4960c4', '#c21411']
        colors: ['#87e680', '#ee4947', '#c2bd11', '#4960c4', '#ea2522']
    });
    attitudeChart = new Highcharts.Chart({
        chart: {
            renderTo: 'attitude',
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false
        },
        title: {
            text: attitude_lang
        },
        tooltip: {
            formatter: function () {
                return '<b>' + this.point.name + '</b>: ' + this.percentage + ' %';
            }
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    color: '#000000',
                    connectorColor: '#000000',
                    formatter: function () {
                        return '<b>' + this.point.name + '</b>: ' + this.percentage + ' %';
                    },
                },
                showInLegend: true
            }
        },
        legend: {
            align: 'left',
            verticalAlign: 'top',
            layout: 'vertical',
            x: 40,
            y: 50,
            verticalAlign: 'middle',
            useHTML: true,
            itemMarginTop: 7,
            itemMarginBottom: 7,
        },
        series: [{
            type: 'pie',
            name: 'Attitude',
            data: [
                [engaging_lang, 0],
                [hyperactive_lang, 0],
                [quiet_lang, 0],
                [sleepy_lang, 0],
                [uninterested_lang, 0]
            ],
        }],
        responsive: {
            rules: [{
                condition: {
                    maxWidth: 500
                }
            }]
        }
    });
    // attitude report end
    // subject avg chart start
    colors = ["#f672a7"];
    (dataColors = $("#subject-avg-chart-student").data("colors")) && (colors = dataColors.split(","));
    options = {
        chart: {
            height: 380,
            type: "line",
            shadow: {
                enabled: !1,
                color: "#bbb",
                top: 3,
                left: 2,
                blur: 3,
                opacity: 1
            }
        },
        stroke: {
            width: 5,
            curve: "smooth"
        },
        series: [{
            name: average,
            // data: [65,87,65,87]
            data: []

        }],
        title: {
            text: subject_average,
            align: "left",
            style: {
                fontSize: "14px",
                color: "#666"
            }
        },
        fill: {
            type: "gradient",
            gradient: {
                shade: "dark",
                gradientToColors: colors,
                shadeIntensity: 1,
                type: "horizontal",
                opacityFrom: 1,
                opacityTo: 1,
                stops: [0, 100, 100, 100]
            }
        },
        markers: {
            size: 4,
            opacity: .9,
            colors: ["#56c2d6"],
            strokeColor: "#fff",
            strokeWidth: 2,
            style: "inverted",
            hover: {
                size: 7
            }
        },
        yaxis: {
            min: 0,
            max: 100,
            title: {
                text: average
            }
        },
        grid: {
            row: {
                colors: ["transparent", "transparent"],
                opacity: .2
            },
            borderColor: "#185a9d"
        },
        responsive: [{
            breakpoint: 600,
            options: {
                chart: {
                    toolbar: {
                        show: !1
                    }
                },
                legend: {
                    show: !1
                }
            }
        }]
    };
    (subAvgChart = new ApexCharts(document.querySelector("#subject-avg-chart-student"), options)).render();
    // subject avg chart end
    // change class name
    $('#changeClassName').on('change', function () {
        // $(".classRoomHideSHow").hide();
        var class_id = $(this).val();
        $("#analyticCrepFilter").find("#sectionID").empty();
        $("#analyticCrepFilter").find("#sectionID").append('<option value="">' + select_class + '</option>');
        $("#analyticCrepFilter").find("#subjectID").empty();
        $("#analyticCrepFilter").find("#subjectID").append('<option value="">' + select_subject + '</option>');
        $("#analyticCrepFilter").find("#paperID").empty();
        $("#analyticCrepFilter").find("#paperID").append('<option value="">' + select_paper + '</option>');
        $("#analyticCrepFilter").find("#studentID").empty();
        $("#analyticCrepFilter").find("#studentID").append('<option value="">' + select_student + '</option>');
        $.post(teacherSectionUrl, { token: token, branch_id: branchID, teacher_id: ref_user_id, class_id: class_id }, function (res) {
            if (res.code == 200) {
                $.each(res.data, function (key, val) {
                    $("#analyticCrepFilter").find("#sectionID").append('<option value="' + val.section_id + '">' + val.section_name + '</option>');
                });
            }
        }, 'json');
    });
    // change section
    $('#sectionID').on('change', function () {
        var section_id = $(this).val();
        var class_id = $("#changeClassName").val();
        $("#analyticCrepFilter").find("#subjectID").empty();
        $("#analyticCrepFilter").find("#subjectID").append('<option value="">' + select_subject + '</option>');
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
                    $("#analyticCrepFilter").find("#subjectID").append('<option value="' + val.subject_id + '">' + val.subject_name + '</option>');
                });
            }
        }, 'json');
        // getStudentListByClassSection
        $.post(getStudentListByClassSection, {
            token: token,
            branch_id: branchID,
            class_id: class_id,
            section_id: section_id,
            academic_session_id: academic_session_id,
        }, function (respon) {
            if (respon.code == 200) {
                $.each(respon.data, function (key, val) {
                    $("#analyticCrepFilter").find("#studentID").append('<option value="' + val.id + '">' + val.name + '</option>');
                });
            }
        }, 'json');
    });
    // applyFilter
    // rules validation
    $("#analyticCrepFilter").validate({
        rules: {
            class_id: "required",
            section_id: "required",
            subject_id: "required",
            student_id: "required"
        }
    });
    //
    $('#analyticCrepFilter').on('submit', function (e) {
        e.preventDefault();
        var analyticCrip = $("#analyticCrepFilter").valid();
        if (analyticCrip === true) {
            $("#overlay").fadeIn(300);
            //   $("#overlay").fadeIn(300);
            // jQuery("body").prepend('<div id="preloader">Loading...</div>');
            var classID = $("#changeClassName").val();
            var sectionID = $("#sectionID").val();
            var subjectID = $("#subjectID").val();
            var studentID = $("#studentID").val();
            var semester_id = $("#semester_id").val();
            var session_id = $("#session_id").val();

            var classObj = {
                classID: classID,
                sectionID: sectionID,
                subjectID: subjectID,
                studentID: studentID,
                semesterID: semester_id,
                sessionID: session_id,
                academic_session_id: academic_session_id,
                userID: userID,
            };

            var formData = new FormData();
            formData.append('token', token);
            formData.append('branch_id', branchID);
            formData.append('class_id', classID);
            formData.append('section_id', sectionID);
            formData.append('subject_id', subjectID);
            formData.append('student_id', studentID);
            formData.append('semester_id', semester_id);
            formData.append('session_id', session_id);
            formData.append('academic_session_id', academic_session_id);
            // set localstorage selected
            setLocalStorageForAnalytic(classObj);
            // attendance report chart
            attendanceReport(formData);
            // homework report chart
            homeworkReport(formData);
            // attitude report chart
            getAttitudeReport(formData);
            // short test report chart
            getShortTestReport(formData);
            // subject avg report chart
            getSubjectAvgReport(formData);
            // exam result radar chart start
            getExamResultReport(formData);
            // exam result radar chart end
            $("#overlay").fadeOut(300);

        }
    });

    function setLocalStorageForAnalytic(classObj) {

        var analyticDetails = new Object();
        analyticDetails.class_id = classObj.classID;
        analyticDetails.section_id = classObj.sectionID;
        analyticDetails.subject_id = classObj.subjectID;
        analyticDetails.student_id = classObj.studentID;
        analyticDetails.semester_id = classObj.semesterID;
        analyticDetails.session_id = classObj.sessionID;
        // here to attached to avoid localStorage other users to add
        analyticDetails.branch_id = branchID;
        analyticDetails.role_id = get_roll_id;
        analyticDetails.user_id = ref_user_id;
        var analyticClassArr = [];
        analyticClassArr.push(analyticDetails);
        if (get_roll_id == "2") {
            // admin
            localStorage.removeItem("admin_analytic_details");
            localStorage.setItem('admin_analytic_details', JSON.stringify(analyticClassArr));
        }
        if (get_roll_id == "3") {
            // staff
            localStorage.removeItem("staff_analytic_details");
            localStorage.setItem('staff_analytic_details', JSON.stringify(analyticClassArr));
        }
        if (get_roll_id == "4") {
            // teacher
            localStorage.removeItem("teacher_analytic_details");
            localStorage.setItem('teacher_analytic_details', JSON.stringify(analyticClassArr));
        }
        return true;
    }
    // attendance report chart ajax
    function attendanceReport(formData) {
        $.ajax({
            url: getAttendanceLateGraph,
            method: 'post',
            data: formData,
            processData: false,
            dataType: 'json',
            contentType: false,
            success: function (response) {
                if (response.code == 200) {
                    var late_present_graph = response.data;
                    // analytics chart update series start
                    var newLabels = [];
                    var seriesData = [];
                    $('#attendance_card').show();
                    if (late_present_graph.length > 0) {
                        // graph data
                        newLabels.push(late_present_graph[0].month);
                        seriesData.push(late_present_graph[0].presentCount);
                        seriesData.push(late_present_graph[0].absentCount);
                        seriesData.push(late_present_graph[0].lateCount);
                    }
                    attReportchart.updateOptions({
                        series: seriesData
                        // labels: newLabels
                    })
                    // analytics chart update series end

                }
            }
        });
    }
    // homework report chart ajax
    function homeworkReport(formData) {
        $.ajax({
            url: getHomeworkGraphByStudent,
            method: 'post',
            data: formData,
            processData: false,
            dataType: 'json',
            contentType: false,
            success: function (response) {
                if (response.code == 200) {
                    var homework = response.data;
                    // analytics chart update series start
                    var newLabels = [];
                    var seriesData = [];
                    $('#homework_card').show();
                    // graph data
                    seriesData.push(homework.complete);
                    seriesData.push(homework.in_complete);
                    seriesData.push(homework.late_submission);
                    homeworkChart.updateOptions({
                        series: seriesData
                        // labels: newLabels
                    })
                    // analytics chart update series end
                }
            }
        });
    }
    // attitude report chart ajax
    function getAttitudeReport(formData) {
        $.ajax({
            url: getAttitudeGraphByStudent,
            method: 'post',
            data: formData,
            processData: false,
            dataType: 'json',
            contentType: false,
            success: function (response) {
                if (response.code == 200) {
                    var attitude = response.data;
                    // attitude chart update series start
                    if (attitude.length > 0) {
                        $('#attitude_card').show();
                        // graph data
                        var total_no_of_days_date_count = attitude[0].total_no_of_days_date_count;
                        var EngagingCount = attitude[0].EngagingCount;
                        var HyperactiveCount = attitude[0].HyperactiveCount;
                        var QuietCount = attitude[0].QuietCount;
                        var SleepyCount = attitude[0].SleepyCount;
                        var UninterestedCount = attitude[0].UninterestedCount;

                        EngagingCount = ((EngagingCount / total_no_of_days_date_count) * 100);
                        HyperactiveCount = ((HyperactiveCount / total_no_of_days_date_count) * 100);
                        QuietCount = ((QuietCount / total_no_of_days_date_count) * 100);
                        SleepyCount = ((SleepyCount / total_no_of_days_date_count) * 100);
                        UninterestedCount = ((UninterestedCount / total_no_of_days_date_count) * 100);

                        // based on order we push
                        attitudeChart.series[0].setData([
                            [engaging_lang, EngagingCount],
                            [hyperactive_lang, HyperactiveCount],
                            [quiet_lang, QuietCount],
                            [sleepy_lang, SleepyCount],
                            [uninterested_lang, UninterestedCount]
                        ], true);
                    } else {
                        $('#attitude_card').hide();
                    }
                }
            }
        });
    }
    // short test report table ajax
    function getShortTestReport(formData) {

        $.ajax({
            url: getShortTestGraphByStudent,
            method: 'post',
            data: formData,
            processData: false,
            dataType: 'json',
            contentType: false,
            success: function (response) {
                if (response.code == 200) {
                    var shorttest = response.data;
                    $('#shortTest').empty();
                    $('#short_test_card').show();
                    var newRowContent = "";
                    var index = 1;
                    var marks = "marks";
                    var grade = "grade";
                    newRowContent += '<div class="table-responsive">' +
                        '<table class="table table-striped table-nowrap">' +
                        '<thead>' +
                        '<tr>' +
                        '<th>' + sl_no_lang + '</th>' +
                        '<th>' + short_test_name_lang + '</th>' +
                        '<th>' + grade_lang + '</th>' +
                        '<th>' + mark_lang + '</th>' +
                        '</tr>' +
                        '</thead>' +
                        '<tbody>';
                    if (shorttest.length > 0) {
                        $.each(shorttest, function (key, val) {
                            if (val.test_name && val.test_name != '') {
                                var test_name = val.test_name.split(",");
                                var test_marks = val.test_marks.split(",");
                                var grade_status = val.grade_status.split(",");

                                for (i = 0; i < test_name.length; i++) {
                                    newRowContent += '<tr>' +
                                        '<td>' + index + '</td>' +
                                        '<td>' + test_name[i] + '</td>';
                                    if (grade_status[i] == grade) {
                                        newRowContent += '<td>' + test_marks[i] + '</td>';
                                    } else {
                                        newRowContent += '<td> - </td>';
                                    }
                                    if (grade_status[i] == marks) {
                                        newRowContent += '<td>' + test_marks[i] + '</td>';
                                    } else {
                                        newRowContent += '<td> - </td>';
                                    }
                                    '</tr>';
                                    index++;
                                }
                            }
                        });
                    } else {
                        newRowContent += '<tr><td colspan="4" style="text-align: center;"> ' + no_data_available + '</td></tr>';
                    }
                    newRowContent += '</tbody>' +
                        '</table>' +
                        '</div>';
                    $("#shortTest").append(newRowContent);
                }
            }
        });
    }
    // subject avg report chart ajax
    function getSubjectAvgReport(formData) {
        $.ajax({
            url: getSubjectAbgGraphByStudent,
            method: 'post',
            data: formData,
            processData: false,
            dataType: 'json',
            contentType: false,
            success: function (response) {
                if (response.code == 200) {
                    var subjectAvgData = response.data;
                    var averageData = [];
                    var categoryData = [];
                    if (subjectAvgData.length > 0) {
                        // subject avg chart update series start
                        subjectAvgData.forEach(function (res) {
                            averageData.push(res.average);
                            categoryData.push(res.subject_name);
                        });
                        $('#subject_average_card').show();
                        // $('#subject_average_card').show();
                        subAvgChart.updateOptions({
                            xaxis: {
                                type: "datetime",
                                format: 'dd/MM',
                                categories: categoryData
                            }
                        });
                        subAvgChart.updateSeries([{
                            name: average,
                            data: averageData
                        }]);
                        // subject avg chart update series end
                    } else {
                        $('#subject_average_card').hide();
                    }


                }
            }
        });
    }
    // exam result radar chart ajax
    function getExamResultReport(formData) {
        $.ajax({
            url: getExamMarksGraphByStudent,
            method: 'post',
            data: formData,
            processData: false,
            dataType: 'json',
            contentType: false,
            success: function (response) {
                if (response.code == 200) {
                    var exam_details = response.data;
                    var labels = [];
                    var examMarks = [];
                    var marks = [];
                    if (exam_details.length > 0) {
                        labels.push(exam_details[0].subject_name);
                        $('#exam_result_card').show();
                        $.each(exam_details, function (key, value) {

                            var obj = {};
                            obj.label = value.exam_name;
                            obj.backgroundColor = getRandomColor();
                            marks.push(value.score);
                            obj.data = marks;
                            marks = [];
                            examMarks.push(obj);
                        });
                        // chart
                        renderChart(labels, examMarks);
                    } else {
                        $('#exam_result_card').hide();

                    }


                }
            }
        });
    }

    function renderChart(labels, examMarks) {

        if (examResultChart) {
            examResultChart.data.labels = labels;
            examResultChart.data.datasets = examMarks;
            examResultChart.update();
        } else {
            var ctx = document.getElementById("exam-result-analytic").getContext('2d');
            examResultChart = new Chart(ctx, {
                type: 'radar',
                data: {
                    labels: labels,
                    datasets: examMarks
                },
            });
        }


    }

    // random color
    function getRandomColor() {
        var letters = '0123456789ABCDEF';
        var color = '#';
        for (var i = 0; i < 6; i++) {
            color += letters[Math.floor(Math.random() * 16)];
        }
        return color;
    }
    // if localStorage
    if ((teacher_analytic_storage)) {
        if (teacher_analytic_storage) {
            var teacherAnalyticStorage = JSON.parse(teacher_analytic_storage);
            if (teacherAnalyticStorage.length == 1) {
                var classID, sectionID, subjectID, studentID, semesterID, sessionID, userBranchID, userRoleID, userID;
                teacherAnalyticStorage.forEach(function (user) {
                    classID = user.class_id;
                    sectionID = user.section_id;
                    subjectID = user.subject_id;
                    semesterID = user.semester_id;
                    sessionID = user.session_id;
                    studentID = user.student_id;
                    userBranchID = user.branch_id;
                    userRoleID = user.role_id;
                    userID = user.user_id;
                });
                if ((userBranchID == branchID) && (userRoleID == get_roll_id) && (userID == ref_user_id)) {
                    $('#changeClassName').val(classID);
                    if (classID) {
                        $.post(teacherSectionUrl, { token: token, branch_id: branchID, teacher_id: ref_user_id, class_id: classID }, function (res) {
                            if (res.code == 200) {
                                $.each(res.data, function (key, val) {
                                    $("#analyticCrepFilter").find("#sectionID").append('<option value="' + val.section_id + '">' + val.section_name + '</option>');
                                });
                                $("#analyticCrepFilter").find("#sectionID").val(sectionID);
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
                                        if (res.code == 200) {
                                            $.each(res.data, function (key, val) {
                                                $("#analyticCrepFilter").find("#subjectID").append('<option value="' + val.subject_id + '">' + val.subject_name + '</option>');
                                            });
                                            // getStudentListByClassSection
                                            $.post(getStudentListByClassSection, {
                                                token: token,
                                                branch_id: branchID,
                                                class_id: classID,
                                                section_id: sectionID,
                                                academic_session_id: academic_session_id,
                                            }, function (respon) {
                                                if (respon.code == 200) {
                                                    $.each(respon.data, function (key, val) {
                                                        $("#analyticCrepFilter").find("#studentID").append('<option value="' + val.id + '">' + val.name + '</option>');
                                                    });
                                                    $("#analyticCrepFilter").find("#studentID").val(studentID);

                                                }
                                            }, 'json');

                                            $("#analyticCrepFilter").find("#subjectID").val(subjectID);
                                            // after set filter
                                            $("#analyticCrepFilter").find("#semester_id").val(semesterID);
                                            $("#analyticCrepFilter").find("#session_id").val(sessionID);
                                            // $("#analyticCrepFilter").find("#session_id").val(sessionID);
                                            var formData = new FormData();
                                            formData.append('token', token);
                                            formData.append('branch_id', branchID);
                                            formData.append('class_id', classID);
                                            formData.append('section_id', sectionID);
                                            formData.append('subject_id', subjectID);
                                            formData.append('student_id', studentID);
                                            formData.append('semester_id', semesterID);
                                            formData.append('session_id', sessionID);
                                            formData.append('academic_session_id', academic_session_id);
                                            // attendance report chart
                                            attendanceReport(formData);
                                            // homework report chart
                                            homeworkReport(formData);
                                            // attitude report chart
                                            getAttitudeReport(formData);
                                            // short test report chart
                                            getShortTestReport(formData);
                                            // subject avg report chart
                                            getSubjectAvgReport(formData);
                                            // exam result radar chart start
                                            getExamResultReport(formData);
                                            // exam result radar chart end
                                            $("#overlay").fadeOut(300);
                                        }
                                    }, 'json');
                                }
                            }
                        }, 'json');
                    }
                }
            }
        }
    }

});