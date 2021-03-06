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
        labels: ["Present", "Absent", "Late"],
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
            text: "Current Month",
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
        labels: ["Complete", "Incomplete", "Late Submission"],
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
            text: 'Attitude'
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
                ['<i class="far fa-smile" style="font-size:20px;color:#87e680"> smile</i> ', 0],
                ['<i class="far fa-angry" style="font-size:20px;color:#ee4947"> angry</i> ', 0],
                ['<i class="far fa-dizzy" style="font-size:20px;color:#c2bd11"> dizzy</i> ', 0,],
                ['<i class="far fa-surprise" style="font-size:20px;color:#4960c4"> surprise</i>  ', 0],
                ['<i class="far fa-tired" style="font-size:20px;color:#ea2522"> tired</i> ', 0]
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
            name: "Average",
            // data: [65,87,65,87]
            data: []

        }],
        title: {
            text: "Subject Average",
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
                text: "Average"
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
        $("#analyticCrepFilter").find("#sectionID").append('<option value="">Select Section</option>');
        $("#analyticCrepFilter").find("#subjectID").empty();
        $("#analyticCrepFilter").find("#subjectID").append('<option value="">Select Subject</option>');
        $("#analyticCrepFilter").find("#studentID").empty();
        $("#analyticCrepFilter").find("#studentID").append('<option value="">Select Student</option>');
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
        $("#analyticCrepFilter").find("#subjectID").append('<option value="">Select Subject</option>');
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
                    $("#analyticCrepFilter").find("#subjectID").append('<option value="' + val.subject_id + '">' + val.subject_name + '</option>');
                });
            }
        }, 'json');
        // getStudentListByClassSection
        $.post(getStudentListByClassSection, {
            token: token,
            branch_id: branchID,
            class_id: class_id,
            section_id: section_id
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
        console.log("analyticCrip");
        console.log(analyticCrip);
        if (analyticCrip === true) {
            $("#overlay").fadeIn(300);
            //   $("#overlay").fadeIn(300);
            // jQuery("body").prepend('<div id="preloader">Loading...</div>');
            var classID = $("#changeClassName").val();
            var sectionID = $("#sectionID").val();
            var subjectID = $("#subjectID").val();
            var studentID = $("#studentID").val();
            console.log("-----");
            console.log(classID);
            console.log(sectionID);
            console.log(subjectID);
            console.log(studentID);

            var formData = new FormData();
            formData.append('token', token);
            formData.append('branch_id', branchID);
            formData.append('class_id', classID);
            formData.append('section_id', sectionID);
            formData.append('subject_id', subjectID);
            formData.append('student_id', studentID);
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
                        var smileCount = attitude[0].smileCount;
                        var angryCount = attitude[0].angryCount;
                        var dizzyCount = attitude[0].dizzyCount;
                        var surpriseCount = attitude[0].surpriseCount;
                        var tiredCount = attitude[0].tiredCount;

                        smileCount = ((smileCount / total_no_of_days_date_count) * 100);
                        angryCount = ((angryCount / total_no_of_days_date_count) * 100);
                        dizzyCount = ((dizzyCount / total_no_of_days_date_count) * 100);
                        surpriseCount = ((surpriseCount / total_no_of_days_date_count) * 100);
                        tiredCount = ((tiredCount / total_no_of_days_date_count) * 100);

                        // based on order we push
                        // attitudeChart.series[0].setData([
                        //     ['smile',smileCount],
                        //     ['angry',angryCount],
                        //     ['dizzy',dizzyCount],
                        //     ['surprise',surpriseCount],
                        //     ['tired',tiredCount]
                        // ], true);
                        attitudeChart.series[0].setData([
                            ['<i class="far fa-smile" style="font-size:20px;color:#87e680"> smile</i> ', smileCount],
                            ['<i class="far fa-angry" style="font-size:20px;color:#ee4947"> angry</i> ', angryCount],
                            ['<i class="far fa-dizzy" style="font-size:20px;color:#c2bd11"> dizzy</i> ', dizzyCount],
                            ['<i class="far fa-surprise" style="font-size:20px;color:#4960c4"> surprise</i> ', surpriseCount],
                            ['<i class="far fa-tired" style="font-size:20px;color:#ea2522"> tired</i> ', tiredCount]
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
                console.log("shoert test");
                console.log(response);
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
                        '<th>S.no</th>' +
                        '<th>Short Test Name</th>' +
                        '<th>Grade</th>' +
                        '<th>Mark</th>' +
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
                        newRowContent += '<tr><td colspan="4" style="text-align: center;"> No Data Available</td></tr>';
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
                            categoryData.push(res.exam_date);
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
                            name: "Average",
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
                    console.log("response")
                    console.log(response)
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


});