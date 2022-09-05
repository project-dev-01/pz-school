$(function () {
    // marks by subject Chart

    // test result subject wise result
    var radar;
    var divradar;
    subjectavgchart();
    function subjectavgchart() {
        colors = ["#f672a7"];
        (dataColors = $("#subject-avg-chart").data("colors")) && (colors = dataColors.split(","));
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
        (chart = new ApexCharts(document.querySelector("#subject-avg-chart"), options)).render();
    }


    // change classroom
    $('#changeClassName').on('change', function () {
        $(".testResultHideSHow").hide();
        var class_id = $(this).val();
        $("#testresultFilter").find("#sectionID").empty();
        $("#testresultFilter").find("#sectionID").append('<option value="">Select Section</option>');
        $("#testresultFilter").find("#examnames").empty();
        $("#testresultFilter").find("#examnames").append('<option value="">Select Exams</option>');
        $("#testresultFilter").find("#subjectID").empty();
        $("#testresultFilter").find("#subjectID").append('<option value="">Select Subject</option>');
        $("#testresultFilter").find("#paperID").empty();
        $("#testresultFilter").find("#paperID").append('<option value="">Select Paper</option>');

        $.post(teacherSectionUrl, { token: token, branch_id: branchID, teacher_id: ref_user_id, class_id: class_id }, function (res) {
            if (res.code == 200) {
                $.each(res.data, function (key, val) {
                    $("#testresultFilter").find("#sectionID").append('<option value="' + val.section_id + '">' + val.section_name + '</option>');
                });
            }
        }, 'json');
    });
    // change section
    $('#sectionID').on('change', function () {
        var section_id = $(this).val();
        var class_id = $("#changeClassName").val();
        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
        var yyyy = today.getFullYear();

        today = yyyy + '/' + mm + '/' + dd;
        $("#testresultFilter").find("#examnames").empty();
        $("#testresultFilter").find("#examnames").append('<option value="">Select Exams</option>');
        $("#testresultFilter").find("#subjectID").empty();
        $("#testresultFilter").find("#subjectID").append('<option value="">Select Subject</option>');
        $("#testresultFilter").find("#paperID").empty();
        $("#testresultFilter").find("#paperID").append('<option value="">Select Paper</option>');

        $.post(subjectByExamNames, {
            token: token,
            branch_id: branchID,
            class_id: class_id,
            section_id: section_id,
            today: today
        }, function (res) {
            if (res.code == 200) {
                $.each(res.data, function (key, val) {
                    $("#testresultFilter").find("#examnames").append('<option value="' + val.id + '" >' + val.name + '</option>');
                });
            }
        }, 'json');
    });
    // change subject
    $('#examnames').on('change', function () {
        var exam_id = $(this).val();
        var section_id = $("#sectionID").val();
        var class_id = $("#changeClassName").val();
        $("#testresultFilter").find("#subjectID").empty();
        $("#testresultFilter").find("#subjectID").append('<option value="">Select Subject</option>');
        $("#testresultFilter").find("#paperID").empty();
        $("#testresultFilter").find("#paperID").append('<option value="">Select Paper</option>');
        $.post(examBySubjects, {
            token: token,
            branch_id: branchID,
            class_id: class_id,
            section_id: section_id,
            exam_id: exam_id
        }, function (res) {
            if (res.code == 200) {
                $.each(res.data, function (key, val) {
                    $("#testresultFilter").find("#subjectID").append('<option value="' + val.subject_id + '">' + val.subject_name + '</option>');
                });
            }
        }, 'json');
    });
    $('#subjectID').on('change', function () {
        var subject_id = $(this).val();
        var section_id = $("#sectionID").val();
        var class_id = $("#changeClassName").val();
        var exam_id = $("#examnames").val();
        $("#testresultFilter").find("#paperID").empty();
        $("#testresultFilter").find("#paperID").append('<option value="">Select Paper</option>');
        // paper list
        $.post(subjectByPapers, {
            token: token,
            branch_id: branchID,
            class_id: class_id,
            section_id: section_id,
            subject_id: subject_id,
            exam_id: exam_id
        }, function (res) {
            if (res.code == 200) {
                console.log("category id by papername")
                console.log(res)
                $.each(res.data, function (key, val) {
                    $("#testresultFilter").find("#paperID").append('<option value="' + val.paper_id + '" data-grade_category="' + val.grade_category + '">' + val.paper_name + '</option>');
                });
            }
        }, 'json');
    });
    // applyFilter
    // rules validation
    $("#testresultFilter").validate({
        rules: {
            class_id: "required",
            section_id: "required",
            subject_id: "required",
            exam_id: "required"
        }
    });
    // data bind 
    $('#testresultFilter').on('submit', function (e) {
        e.preventDefault();
        var form = this;
        var classRoom = $("#testresultFilter").valid();
        // chart.updateOptions( {
        //     xaxis: {
        //         type: "datetime",
        //         format: 'dd/MM',
        //       categories: []
        //     }
        // });
        // chart.updateSeries([{
        //     name: "Average",
        //     data: []
        // }]);
        if (classRoom === true) {

            var class_id = $("#changeClassName").val();
            var section_id = $("#sectionID").val();
            var subject_id = $("#subjectID").val();
            var exam_id = $("#examnames").val();
            var paper_id = $("#paperID").val();
            var semester_id = $("#semester_id").val();
            var session_id = $("#session_id").val();

            // var fmark = $('option:selected', '#examnames').attr('data-full');
            // var pmark = $('option:selected', '#examnames').attr('data-pass');
            var grade_category = $('option:selected', '#paperID').attr('data-grade_category');

            var formData = new FormData();
            formData.append('token', token);
            formData.append('branch_id', branchID);
            formData.append('class_id', class_id);
            formData.append('section_id', section_id);
            formData.append('subject_id', subject_id);
            formData.append('exam_id', exam_id);
            formData.append('paper_id', paper_id);
            formData.append('semester_id', semester_id);
            formData.append('session_id', session_id);
            $("#overlay").fadeIn(300);
            $.ajax({
                url: getSubjectMarks,
                method: "post",
                data: formData,
                processData: false,
                dataType: 'json',
                contentType: false,
                success: function (response) {
                    console.log("response");
                    console.log(response);
                    if (response.code == 200) {
                        var dataSetNew = response.data.get_subject_marks;
                        var get_exam_marks = response.data.get_exam_marks;
                        if (get_exam_marks) {
                            var marks = JSON.parse(get_exam_marks.marks);
                            if (marks.full && marks.pass && grade_category) {
                                $("#fullmark").val(marks.full);
                                $("#passmark").val(marks.pass);
                                $("#grade_category").val(grade_category);
                                if (dataSetNew.length > 0) {
                                    $("#mark_by_subject_card").show();
                                    bindmarks(dataSetNew);
                                    $("#listModeClassID").val(class_id);
                                    $("#listModeSectionID").val(section_id);
                                    $("#listModeSubjectID").val(subject_id);
                                    $("#listModeexamID").val(exam_id);
                                    $("#listModePaperID").val(paper_id);
                                    $("#listModeSemesterID").val(semester_id);
                                    $("#listModeSessionID").val(session_id);
                                } else {
                                    $("#mark_by_subject_card").hide();
                                }
                            } else {
                                toastr.error("Marks details are not available");
                                $("#mark_by_subject_card").hide();
                            }
                        } else {
                            toastr.error("Pass and Fail marks are not given");
                            $("#mark_by_subject_card").hide();
                        }
                        $("#overlay").fadeOut(300);
                    } else {
                        $("#mark_by_subject_card").hide();
                        $("#overlay").fadeOut(300);
                        toastr.error(response.message);
                    }
                }, error: function (err) {
                    $("#mark_by_subject_card").hide();
                    $("#overlay").fadeOut(300);
                    toastr.error(err.responseJSON.data.error ? err.responseJSON.data.error : 'Something went wrong');
                }
            });

            callsubjectaveragechart(formData);

            callbarchart(formData);
            // division chart
            callradarchart(formData);

            calldonutchart(formData);
        };
    });
    function calldonutchart(formData) {

        $.ajax({

            url: getSubjectMarkStatus,
            method: "POST",
            data: formData,
            processData: false,
            dataType: 'json',
            contentType: false,
            success: function (response) {
                if (response.code == 200) {
                    var detail = response.data;
                    var pass = 0;
                    var fail = 0;
                    var inprogress = 0;
                    if (detail.length > 0) {
                        // graph 
                        $('#graphs_card').show();
                        $('#donut-chart').show();
                        detail.forEach(function (res) {
                            if (res.status == "pass") {
                                pass = res.count;
                            }
                            if (res.status == "fail") {
                                fail = res.count;
                            }
                            if (res.status == "null") {
                                inprogress = res.count;
                            }
                        });
                        donutchart(pass, fail, inprogress);
                        donut_chart.updateSeries([pass, fail, inprogress]);
                    } else {
                        $('#graphs_card').hide();
                        $('#donut-chart').hide();
                    }

                } else {
                    toastr.error(data.message);
                }
            }
        });
    }

    function callradarchart(formData) {

        $.ajax({

            url: getSubjectDivisionMark,
            method: "POST",
            data: formData,
            processData: false,
            dataType: 'json',
            contentType: false,
            success: function (response) {
                if (response.code == 200) {
                    var markDetails = response.data.markDetails;
                    var subdiv = response.data.subjectdivision;
                    var data = [];
                    var label = [];
                    if (subdiv.length > 0) {
                        subdiv.forEach(function (res) {
                            label.push(res.subject_division);
                        });

                        if (markDetails.length > 0) {
                            markDetails.forEach(function (res) {
                                var randcol = getRandomColor();
                                var obj = {};
                                var avg = [];
                                obj["label"] = res.exam_name;
                                obj["backgroundColor"] = hexToRGB(randcol, 0.3);
                                obj["borderColor"] = randcol;
                                obj["pointBackgroundColor"] = randcol;
                                obj["pointBorderColor"] = "#fff";
                                obj["pointHoverBackgroundColor"] = "#fff";
                                obj["pointHoverBorderColor"] = randcol;
                                $.each(res.average, function (key, val) {
                                    avg.push(val);
                                });
                                obj["data"] = avg;
                                data.push(obj);

                            });
                            radarChart(label, data);
                            $('#radar-chart').show();
                        } else {
                            $('#radar-chart').hide();
                        }
                    }

                } else {
                    toastr.error(data.message);
                }
            }
        });
    }

    function getRandomColor() {
        var letters = '0123456789ABCDEF';
        var color = '#';
        for (var i = 0; i < 6; i++) {
            color += letters[Math.floor(Math.random() * 16)];
        }
        return color;
    }

    function callbarchart(formData) {

        $.ajax({
            url: getStudentGrade,
            method: "POST",
            data: formData,
            processData: false,
            dataType: 'json',
            contentType: false,
            success: function (response) {
                if (response.code == 200) {
                    var detail = response.data;
                    if (detail.length > 0) {
                        $('#scores_by_graph_card').css('visibility', 'visible');
                        // $('#scores_by_graph_card').show();
                        barchart.setData(detail);
                    } else {
                        $('#scores_by_graph_card').css('visibility', 'hidden');
                        // $('#scores_by_graph_card').hide();
                    }
                } else {
                    toastr.error(data.message);
                }
            }
        });


    }


    function callsubjectaveragechart(formData) {
        $.ajax({
            url: getSubjectAverage,
            method: "post",
            data: formData,
            processData: false,
            dataType: 'json',
            contentType: false,
            success: function (response) {
                if (response.code == 200) {
                    var detail = response.data;
                    var averageData = [];
                    var categoryData = [];
                    if (detail.length > 0) {
                        // graph data
                        detail.forEach(function (res) {
                            averageData.push(res.average);
                            categoryData.push(res.exam_date);
                        });
                        $('#subject_average_card').show();
                        // subjectavgchart();
                        chart.updateOptions({
                            xaxis: {
                                type: "datetime",
                                format: 'dd/MM',
                                categories: categoryData
                            }
                        });
                        chart.updateSeries([{
                            name: "Average",
                            data: averageData
                        }]);
                    } else {
                        $('#subject_average_card').hide();
                    }

                } else {
                    toastr.error(data.message);
                }
            }
        });
    }
    //Score base grade details bind
    $(document).on("change", ".basevalidation", function (e) {
        e.preventDefault();
        var marks_range = $(this).val();

        var fullMark = $("#fullmark").val();
        var passMark = $("#passmark").val();
        var grade_category = $("#grade_category").val();
        // rank
        //Get all total values, sort and remove duplicates
        let totalList = $(".basevalidation")
            .map(function () { return $(this).val() })
            .get()
            .sort(function (a, b) { return a - b })
            .reduce(function (a, b) { if (b != a[0]) a.unshift(b); return a }, [])

        //assign rank
        $(".basevalidation").each(function () {
            let rankVal = $(this).val();
            let studentID = $(this).attr('id');
            let rank = totalList.indexOf(rankVal) + 1;
            $('.lbl_ranking' + studentID).text(rank);
            $('.lbl_ranking' + studentID).val(rank);

        })
        let stuID = $(this).attr('id');
        if (parseInt(marks_range) >= parseInt(passMark)) {
            $('.badgeLabel' + stuID).removeClass('badge-danger');
            $('.badgeLabel' + stuID).addClass('badge-success');
            $('.lbl_pass_fail' + stuID).text('pass');
            $('.lbl_pass_fail' + stuID).val('pass');

        } else {
            $('.badgeLabel' + stuID).removeClass('badge-success');
            $('.badgeLabel' + stuID).addClass('badge-danger');
            $('.lbl_pass_fail' + stuID).text('fail');
            $('.lbl_pass_fail' + stuID).val('fail');
        }

        if (marks_range != '') {
            var incre_class = $(this).attr('id');
            var formData = new FormData();
            formData.append('token', token);
            formData.append('marks_range', marks_range);
            formData.append('grade_category', grade_category);
            formData.append('branch_id', branchID);
            $.ajax({
                url: getMarks_vs_grade,
                method: "post",
                data: formData,
                processData: false,
                dataType: 'json',
                contentType: false,
                success: function (res) {

                    if (res.code == 200) {
                        $('.lbl_grade' + incre_class).text(res.data[0].grade);
                        $('.lbl_grade' + incre_class).val(res.data[0].grade);
                    }
                    else {
                        $('.lbl_grade' + incre_class).text("");
                        $('.lbl_grade' + incre_class).val("");
                    }
                }
            });

        }
    });

    // Add student marks and update also
    $('#addstudentmarks').on('submit', function (e) {
        e.preventDefault();
        var form = this;

        var class_id = $("#listModeClassID").val();
        var section_id = $("#listModeSectionID").val();
        var subject_id = $("#listModeSubjectID").val();
        var exam_id = $("#listModeexamID").val();


        var formData = new FormData();
        formData.append('token', token);
        formData.append('branch_id', branchID);
        formData.append('class_id', class_id);
        formData.append('section_id', section_id);
        formData.append('subject_id', subject_id);
        formData.append('exam_id', exam_id);

        $.ajax({
            url: $(form).attr('action'),
            method: $(form).attr('method'),
            data: new FormData(form),
            processData: false,
            dataType: 'json',
            contentType: false,
            success: function (response) {
                if (response.code == 200) {
                    callsubjectaveragechart(formData);
                    callbarchart(formData);
                    callradarchart(formData);
                    calldonutchart(formData);
                    toastr.success(response.message);
                }
                else {
                    toastr.error(response.message);
                }
            }
        });



    });
    //subject division cut off value calculation
    $(document).on("change", ".cutoff", function (e) {
        e.preventDefault();

        var passMark = $("#passmark").val();

        var studentid = $(this).attr('data-ref-studentid');
        var currentMarks = $(".rowcutoff" + studentid)
            .map(function () { return $(this).val(); }).get();
        var creditPnt = $(".rowcutoff" + studentid)
            .map(function () { return $(this).attr('data-id'); }).get();

        var sumOfScore = 0;
        for (let i = 0; i < creditPnt.length; i++) {
            if (currentMarks[i] != '' && creditPnt[i] != '') {
                var sum = (parseFloat(currentMarks[i]) * parseFloat(creditPnt[i]));
                sumOfScore += sum;
            }
        }
        var dec_sumoff = parseFloat(sumOfScore, 10).toFixed(0);
        $(".total_score" + studentid).html(dec_sumoff);
        $('.tot_score' + studentid).val(dec_sumoff);
        // rank
        //Get all total values, sort and remove duplicates
        let totalList = $(".all_score")
            .map(function () { return $(this).text() })
            .get()
            .sort(function (a, b) { return a - b })
            .reduce(function (a, b) { if (b != a[0]) a.unshift(b); return a }, [])

        //assign rank
        $(".all_score").each(function () {
            let studID = $(this).attr('data-id');
            let rankVal = $('.total_score' + studID).text();
            // total_score
            let rank = totalList.indexOf(rankVal) + 1;
            $('.subdiv_lbl_ranking' + studID).text(rank);
            $('.subdiv_lbl_ranking' + studID).val(rank);

        })

        let marks_range = $('.total_score' + studentid).text();

        // marks range
        if (parseInt(marks_range) >= parseInt(passMark)) {
            $('.subdivbadgeLabel' + studentid).removeClass('badge-danger');
            $('.subdivbadgeLabel' + studentid).addClass('badge-success');
            $('.sub_lbl_pass_fail' + studentid).text('pass');
            $('.sub_lbl_pass_fail' + studentid).val('pass');

        } else {
            $('.subdivbadgeLabel' + studentid).removeClass('badge-success');
            $('.subdivbadgeLabel' + studentid).addClass('badge-danger');
            $('.sub_lbl_pass_fail' + studentid).text('fail');
            $('.sub_lbl_pass_fail' + studentid).val('fail');
        }
        //
        subject_division_cutoff_grade(dec_sumoff, studentid);

    });
    //subject division base grade details bind
    function subject_division_cutoff_grade(marks_range, studentid) {


        if (marks_range != '') {
            var incre_class = $(this).attr('id');
            var formData = new FormData();
            formData.append('token', token);
            formData.append('marks_range', marks_range);
            formData.append('branch_id', branchID);
            $.ajax({
                url: getMarks_vs_grade,
                method: "post",
                data: formData,
                processData: false,
                dataType: 'json',
                contentType: false,
                success: function (res) {
                    if (res.code == 200) {
                        $(".lbl_grade" + studentid).text(res.data[0].grade);
                        $('.lbl_grade' + studentid).val(res.data[0].grade);
                    }
                    else {
                        $(".lbl_grade" + studentid).text("");
                        $('.lbl_grade' + studentid).val("");
                    }
                }
            });

        }

    }
    // subject division
    function subjectdivisionShow(stdetails, subdiv) {
        var classID = $("#changeClassName").val();
        var sectionID = $("#sectionID").val();
        var subjectID = $("#subjectID").val();
        var exam_id = $("#examnames").val();

        $('#subjectdivTableAppend_text').empty();
        var subjectDivTable = "";
        var index = 0;
        subjectDivTable += '<div class="table-responsive">' +
            '<table class="table table-striped table-nowrap">' +
            '<thead>' +
            '<tr>' +
            '<th>S.no</th>' +
            '<th>Student Name</th>';
        $.each(subdiv, function (key, val) {
            index++;
            // table add
            subjectDivTable += '<th>' + val.subject_division + "(" + val.credit_point + ")" + '</th>';

        });
        subjectDivTable += '<th>Status</th>';
        subjectDivTable += '<th>Total Score</th>';
        subjectDivTable += '<th>Grade</th>';
        subjectDivTable += '<th>Pass/Fail</th>';
        subjectDivTable += '<th>Ranking</th>';
        subjectDivTable += '</tr>' +
            '</thead>' +
            '<tbody>';
        var start = 0;
        var indexStart = 0;

        if (stdetails.length > 0) {
            stdetails.forEach(function (res) {
                start++;
                // subject Div Table table div start
                subjectDivTable += '<tr>' +
                    '<td>';
                if (start == 1) {
                    subjectDivTable += '<input type="hidden" name="class_id" value="' + classID + '">' +
                        '<input type="hidden" name="section_id" value="' + sectionID + '">' +
                        '<input type="hidden" name="subject_id" value="' + subjectID + '">' +
                        '<input type="hidden" name="exam_id" value="' + exam_id + '">';

                }
                subjectDivTable += start +
                    '</td>' +
                    '<td class="table-user">' +
                    '<img src="' + defaultImg + '" class="mr-2 rounded-circle">' +
                    '<a href=""  data-toggle="modal" data-target=".studentSubDivMarkModal" data-id="' + res.student_id + '" class="text-body font-weight-semibold studentSubDivChart">' + res.first_name + ' ' + res.last_name + '</a>'
                '</td>';
                // console.log(subdiv.length)
                $.each(subdiv, function (key, val) {

                    var marks;
                    if (res.subject_division) {
                        var subject_division = res.subject_division.split(",");
                        var subjectdivision_scores = res.subjectdivision_scores.split(",");
                        // var grade_status = res.grade_status.split(",");
                        var index = subject_division.findIndex(x => x === val.subject_division);
                        if (index !== -1) {
                            marks = subjectdivision_scores[index];
                        }
                    }
                    // console.log(val.subject_division)
                    // console.log(indexStart)
                    subjectDivTable += '<td>' +
                        '<input type="hidden" name="subjectdiv[' + indexStart + '][student_id]" value="' + res.student_id + '">' +
                        '<input type="hidden" class="sub_lbl_pass_fail' + res.student_id + '" name="subjectdiv[' + indexStart + '][pass_fail]" value="' + res.pass_fail + '">' +
                        '<input type="hidden" name="subjectdiv[' + indexStart + '][total_score]" class="tot_score' + res.student_id + '" data-id="' + res.student_id + '" value="' + (res.total_score ? res.total_score : "") + '">' +
                        '<input type="hidden" name="subjectdiv[' + indexStart + '][grade]" class="lbl_grade' + res.student_id + '" data-id="' + res.student_id + '" value="' + (res.grade ? res.grade : "") + '">' +
                        '<input type="hidden" class="subdiv_lbl_ranking' + res.student_id + '" name="subjectdiv[' + indexStart + '][ranking]" value="' + res.ranking + '">' +
                        '<input type="hidden" name="subjectdiv[' + indexStart + '][subject_division][]" value="' + val.subject_division + '">' +
                        '<input type="text" name="subjectdiv[' + indexStart + '][subjectdivision_scores][]" value="' + (marks ? marks : "") + '" id="' + val.subject_division + indexStart + '" data-ref-studentid="' + res.student_id + '" data-id="' + val.credit_point + '" class="form-control cutoff rowcutoff' + res.student_id + '" style="width:100px;">' +
                        '</td>';

                });
                subjectDivTable += '<td>' +
                    '<select class="form-control" data-style="btn-outline-success" name="subjectdiv[' + indexStart + '][status]">' +
                    '<option value="">Choose</option>' +
                    '<option value="present" ' + (res.status == "present" ? "selected" : "selected") + '>Present</option>' +
                    '<option value="absent" ' + (res.status == "absent" ? "selected" : "") + '>Absent</option>' +
                    '</select>' +
                    '</td>';

                subjectDivTable += '<td>' +
                    '<label class="all_score total_score' + res.student_id + '" data-id="' + res.student_id + '">' + (res.total_score ? res.total_score : 0) + '</label>' +
                    '</td>';
                subjectDivTable += '<td>' +
                    '<label for="grade" class="lbl_grade' + res.student_id + '" data-id="' + res.student_id + '">' + (res.grade ? res.grade : "") + '</label>' +
                    '</td>';

                var passTag = "";
                if (res.pass_fail) {
                    if (res.pass_fail == "pass") {
                        passTag = "badge-success";
                    } else {
                        passTag = "badge-danger";
                    }
                }
                subjectDivTable += '<td>' +
                    '<span class="badge subdivbadgeLabel' + res.student_id + ' ' + passTag + ' badge-pill sub_lbl_pass_fail' + res.student_id + '">' + (res.pass_fail != null ? res.pass_fail : "NILL") + '</span>' +
                    '</td>';
                subjectDivTable += '<td>' +
                    '<label for="ranking" class="subdiv_lbl_ranking' + res.student_id + '">' + (res.ranking ? res.ranking : "0") + '</label>' +
                    '</td>';
                // subject Div Table table div end
                // $.each(stdetails, function (key, val) {

                //     var marks = "";
                //     if (res.test_name) {
                //         var test_name = res.test_name.split(",");
                //         var test_marks = res.test_marks.split(",");
                //         var grade_status = res.grade_status.split(",");
                //         var index = test_name.findIndex(x => x === val.test_name);
                //         if (index !== -1) {
                //             marks = test_marks[index];
                //         }
                //     }

                //     subjectDivTable += '<td>' +
                //         '<input type="hidden" name="short_test[' + indexStart + '][student_id]" value="' + res.student_id + '">' +
                //         '<input type="hidden" name="short_test[' + indexStart + '][test_name][]" value="' + val.test_name + '">' +
                //         '<input type="hidden" name="short_test[' + indexStart + '][grade_status][]" value="' + val.status + '">' +
                //         '<input type="text" name="short_test[' + indexStart + '][test_marks][]" value="' + marks + '" class="form-control" style="width:100px;">' +
                //         '</td>';
                // });
                indexStart++;
                subjectDivTable += '</tr>';
            });
        }

        subjectDivTable += '</tbody>' +
            '</table></div>';
        $("#subjectdivTableAppend_text").append(subjectDivTable);
    }
    // save subject division
    $('#tblsubjectdivSave').on('submit', function (e) {
        e.preventDefault();
        var form = this;

        var class_id = $("#listModeClassID").val();
        var section_id = $("#listModeSectionID").val();
        var subject_id = $("#listModeSubjectID").val();
        var exam_id = $("#listModeexamID").val();


        var formData = new FormData();
        formData.append('token', token);
        formData.append('branch_id', branchID);
        formData.append('class_id', class_id);
        formData.append('section_id', section_id);
        formData.append('subject_id', subject_id);
        formData.append('exam_id', exam_id);

        $.ajax({
            url: $(form).attr('action'),
            method: $(form).attr('method'),
            data: new FormData(form),
            processData: false,
            dataType: 'json',
            contentType: false,
            success: function (response) {
                if (response.code == 200) {

                    callsubjectaveragechart(formData);
                    callbarchart(formData);
                    callradarchart(formData);
                    calldonutchart(formData);
                    toastr.success(response.message);
                }
                else {
                    toastr.error(data.message);
                }
            }
        });
    });

    // function list mode
    function bindmarks(dataSetNew) {
        console.log("dataSetNew")
        console.log(dataSetNew)
        var fullMark = $("#fullmark").val();
        var passMark = $("#passmark").val();

        listTable = $('#stdmarks').DataTable({
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
                    data: 'student_id'
                },
                {
                    data: 'first_name'
                },
                {
                    data: 'score'
                },
                {
                    data: 'grade'
                },
                {
                    data: 'pass_fail'
                },
                {
                    data: 'ranking'
                },
                {
                    data: 'status'
                },
                {
                    data: 'memo'
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
                    "className": "table-user text-left tdcolor",
                    "render": function (data, type, row, meta) {
                        var first_name = '<input type="hidden" name="subjectmarks[' + meta.row + '][studentmarks_tbl_pk_id]" value="' + row.att_id + '">' +
                            '<input type="hidden" name="subjectmarks[' + meta.row + '][student_id]" value="' + row.student_id + '">' +
                            '<input type="hidden" name="subjectmarks[' + meta.row + '][first_name]" value="' + row.first_name + '">' +
                            '<input type="hidden" name="subjectmarks[' + meta.row + '][last_name]" value="' + row.last_name + '">' +
                            '<img src="' + defaultImg + '" class="mr-2 rounded-circle">' +
                            '<a href=""  data-toggle="modal" data-target=".studentMarkModal" data-id="' + row.student_id + '" class="text-body font-weight-semibold studentChart width ellipse two-lines">' + data + '</a>';
                        return first_name;
                    }
                },
                {
                    "targets": 2,
                    "className": "text-center",
                    "render": function (data, type, row, meta) {
                        var score = '<input type="text" maxlength="3" class="form-control basevalidation" name="subjectmarks[' + meta.row + '][score]" id="' + row.student_id + '" value="' + (data != null ? data : "") + '">';

                        return score;
                    }
                },
                {
                    "targets": 3,
                    "className": "text-center",
                    "render": function (data, type, row, meta) {
                        var grade = '<label for="grade" class="lbl_grade' + row.student_id + ' tt-color02 tt-badge" data-id="' + row.student_id + '">' + (data != null ? data : "-") + '</label>' +
                            '<input type="hidden" class="lbl_grade' + row.student_id + '" name="subjectmarks[' + meta.row + '][grade]" value="' + (data != null ? data : "-") + '">';
                        return grade;
                    }
                },
                {
                    "targets": 4,
                    "className": "text-center",
                    "render": function (data, type, row, meta) {
                        var passTag = "";
                        if (data) {
                            if (data == "pass") {
                                passTag = "badge-success";
                            } else {
                                passTag = "badge-danger";
                            }
                        }
                        var pass_fail = '<span class="badge badgeLabel' + row.student_id + ' ' + passTag + ' badge-pill lbl_pass_fail' + row.student_id + '">' + (data != null ? data : "NILL") + '</span>' +
                            '<input type="hidden" class="lbl_pass_fail' + row.student_id + '" name="subjectmarks[' + meta.row + '][pass_fail]" value="' + row.pass_fail + '">';
                        return pass_fail;
                    }
                },
                {
                    "targets": 5,
                    "className": "text-center",
                    "render": function (data, type, row, meta) {

                        var ranking = '<label for="ranking" class="lbl_ranking' + row.student_id + '">' + (data != null ? data : "0") + '</label>' +
                            '<input type="hidden" class="lbl_ranking' + row.student_id + '" name="subjectmarks[' + meta.row + '][ranking]" value="' + row.ranking + '">';

                        return ranking;
                    }
                },
                {
                    "targets": 6,
                    "render": function (data, type, row, meta) {
                        var att_status = '<select class="form-control" data-style="btn-outline-success" name="subjectmarks[' + meta.row + '][status]">' +
                            '<option value="">Choose</option>' +
                            '<option value="present" ' + (row.status == "present" ? "selected" : "selected") + '>Present</option>' +
                            '<option value="absent" ' + (row.status == "absent" ? "selected" : "") + '>Absent</option>' +
                            '</select>';
                        return att_status;
                    }
                },
                {
                    "targets": 7,
                    "className": "text-center",
                    "render": function (data, type, row, meta) {
                        var memo = '<textarea style="display:none;" maxlength="50" class="addRemarks" data-id="' + row.student_id + '" id="addRemarks' + row.student_id + '" name="subjectmarks[' + meta.row + '][memo]">' + (data !== "null" ? data : "") + '</textarea>' +
                            '<button type="button" data-id="' + row.student_id + '" class="btn btn-outline-info waves-effect waves-light list-mode-btn" data-toggle="modal" data-target="#stuRemarksPopup" id="editRemarksStudent">Add Remarks</button>';
                        return memo;
                        
                    }
                }
            ]
        }).on('draw', function () {
        });
    }
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
    function trcolorchange() {
        tables = $('#stdmarks').DataTable({
            "createdRow": function (row, data, dataIndex) {
                if (data[2] == "30") {
                    $(row).addClass('red');
                }

            }
        });
    }
    // test result subject wise result


    $(document).on('click', '.studentChart', function () {
        var studentID = $(this).data('id');

        var class_id = $("#changeClassName").val();
        var section_id = $("#sectionID").val();
        var subject_id = $("#subjectID").val();
        var paper_id = $("#paperID").val();
        var semester_id = $("#semester_id").val();
        var session_id = $("#session_id").val();
        console.log("student click");
        console.log(paper_id);
        console.log(semester_id);
        console.log(session_id);
        var formData = new FormData();
        formData.append('token', token);
        formData.append('branch_id', branchID);
        formData.append('class_id', class_id);
        formData.append('section_id', section_id);
        formData.append('subject_id', subject_id);
        formData.append('student_id', studentID);
        formData.append('paper_id', paper_id);
        formData.append('semester_id', semester_id);
        formData.append('session_id', session_id);
        $("#studentMarkModal").modal('show');
        // return false;
        callstudentchart(formData);
    });

    $(document).on('click', '.studentSubDivChart', function () {
        var studentID = $(this).data('id');

        var class_id = $("#changeClassName").val();
        var section_id = $("#sectionID").val();
        var subject_id = $("#subjectID").val();

        var formData = new FormData();
        formData.append('token', token);
        formData.append('branch_id', branchID);
        formData.append('class_id', class_id);
        formData.append('section_id', section_id);
        formData.append('subject_id', subject_id);
        formData.append('student_id', studentID);
        $("#studentSubDivMarkModal").modal('show');

        callstudentradarchart(formData);
    });


    $('#studentMarkModal').on('hidden.bs.modal', function () {
        student_chart.destroy();
    });

    $('#studentSubDivMarkModal').on('hidden.bs.modal', function () {
        student_div_chart.destroy();
    });

    function callstudentchart(formData) {
        $.ajax({
            url: getStudentSubjectMark,
            method: "POST",
            data: formData,
            dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success: function (response) {
                // return false;
                if (response.code == 200) {
                    console.log('res', response)
                    var mark_details = response.data;
                    var mark = [];
                    var date = [];
                    if (mark_details.length > 0) {

                        mark_details.forEach(function (res) {
                            mark.push(res.score);
                            date.push(res.exam_date);
                        });
                    }
                    studentchart();
                    student_chart.updateOptions({
                        xaxis: {
                            type: "datetime",
                            format: 'dd/MM',
                            categories: date
                        }
                    });
                    student_chart.updateSeries([{
                        name: "Mark",
                        data: mark
                    }]);
                    // chart



                } else {
                    toastr.error(data.message);
                }

            }, error: function (err) {
                if (err.responseJSON.code == 422) {
                    toastr.error(err.responseJSON.data.error.profile_image[0] ? err.responseJSON.data.error.profile_image[0] : 'Something went wrong');
                }
            }
        })
    }

    function callstudentradarchart(formData) {
        $.ajax({
            url: getStudentSubjectMark,
            method: "POST",
            data: formData,
            dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success: function (response) {
                // return false;

                if (response.code == 200) {

                    var studentdetails = response.data.studentdetails;

                    var mark = [];
                    var date = [];
                    if (studentdetails.length > 0) {

                        studentdetails.forEach(function (res) {
                            mark.push(res.total_score);
                            date.push(res.exam_date);
                        });
                        console.log('mark', mark)
                        console.log('date', date)
                    }
                    studentdivchart();
                    student_div_chart.updateOptions({
                        xaxis: {
                            type: "datetime",
                            format: 'dd/MM',
                            categories: date
                        }
                    });
                    student_div_chart.updateSeries([{
                        name: "Mark",
                        data: mark
                    }]);

                    var markDetails = response.data.markDetails;
                    var subdiv = response.data.subjectdivision;
                    var data = [];
                    var label = [];

                    if (subdiv.length > 0) {
                        subdiv.forEach(function (res) {
                            label.push(res.subject_division);
                        });

                        if (markDetails.length > 0) {
                            markDetails.forEach(function (res) {
                                var randcol = getRandomColor();
                                var obj = {};
                                var avg = [];
                                obj["label"] = res.exam_name;
                                obj["backgroundColor"] = hexToRGB(randcol, 0.3);
                                obj["borderColor"] = randcol;
                                obj["pointBackgroundColor"] = randcol;
                                obj["pointBorderColor"] = "#fff";
                                obj["pointHoverBackgroundColor"] = "#fff";
                                obj["pointHoverBorderColor"] = randcol;
                                $.each(res.total, function (key, val) {
                                    avg.push(val);
                                });

                                obj["data"] = avg;
                                data.push(obj);

                            });
                        }

                        studentradarchart(label, data);
                    }

                } else {
                    toastr.error(data.message);
                }

            }, error: function (err) {
                if (err.responseJSON.code == 422) {
                    toastr.error(err.responseJSON.data.error.profile_image[0] ? err.responseJSON.data.error.profile_image[0] : 'Something went wrong');
                }
            }
        })
    }

    function studentchart() {
        studentcolors = ["#6658dd",];
        (studentdataColors = $("#student-subject-mark").data("colors")) && (studentcolors = studentdataColors.split(","));
        var studentoptions = {
            chart: {
                height: 380,
                type: "line",
                zoom: {
                    enabled: !1
                },
                toolbar: {
                    show: !1
                },
                redrawOnParentResize: true
            },
            colors: colors,
            dataLabels: {
                enabled: !0
            },
            stroke: {
                width: [3, 3],
                curve: "smooth"
            },

            series: [{
                name: "Mark",
                data: []
            }],

            xaxis: {
                type: "datetime",
                format: "dd/MM",
                categories: []
            },
            title: {
                text: "Subject Mark",
                align: "left",
                style: {
                    fontSize: "14px",
                    color: "#666"
                }
            },
            grid: {
                row: {
                    colors: ["transparent", "transparent"],
                    opacity: .2
                },
                borderColor: "#f1f3fa"
            },
            markers: {
                style: "inverted",
                size: 6
            },
            yaxis: {
                title: {
                    text: "Mark"
                },
                min: 0,
                max: 100
            },
            legend: {
                position: "top",
                horizontalAlign: "right",
                floating: !0,
                offsetY: -25,
                offsetX: -5
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
        (student_chart = new ApexCharts(document.querySelector("#student-subject-mark"), studentoptions)).render();
    }

    function studentdivchart() {
        studentcolors = ["#6658dd",];
        (studentdataColors = $("#student-div-subject-mark").data("colors")) && (studentcolors = studentdataColors.split(","));
        var studentoptions = {
            chart: {
                height: 380,
                type: "line",
                zoom: {
                    enabled: !1
                },
                toolbar: {
                    show: !1
                },
                redrawOnParentResize: true
            },
            colors: colors,
            dataLabels: {
                enabled: !0
            },
            stroke: {
                width: [3, 3],
                curve: "smooth"
            },

            series: [{
                name: "Mark",
                data: []
            }],

            xaxis: {
                type: "datetime",
                format: "dd/MM",
                categories: []
            },
            title: {
                text: "Subject Mark",
                align: "left",
                style: {
                    fontSize: "14px",
                    color: "#666"
                }
            },
            grid: {
                row: {
                    colors: ["transparent", "transparent"],
                    opacity: .2
                },
                borderColor: "#f1f3fa"
            },
            markers: {
                style: "inverted",
                size: 6
            },
            yaxis: {
                title: {
                    text: "Mark"
                },
                min: 0,
                max: 100
            },
            legend: {
                position: "top",
                horizontalAlign: "right",
                floating: !0,
                offsetY: -25,
                offsetX: -5
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
        (student_div_chart = new ApexCharts(document.querySelector("#student-div-subject-mark"), studentoptions)).render();
    }

    var barchart = Morris.Bar({
        element: 'test-bar-chart',
        data: [],
        xkey: 'y',
        ykeys: ['a'],
        labels: ['Total'],
        dataLabels: !1,
        // resize: !0,
        gridLineColor: "rgba(65, 80, 95, 0.07)",
        barSizeRatio: .2,
        barColors: ["#02c0ce"]

    });

    radarChart();
    function radarChart(labels, obj) {

        if (radar) {
            radar.data.labels = labels;
            radar.data.datasets = obj;
            radar.update();
        } else {
            var ctx = document.getElementById("radar-chart-test-marks").getContext('2d');
            var defaultColors = ["#1abc9c", "#f1556c", "#4a81d4", "#e3eaef"];
            var colors = dataColors ? dataColors.split(",") : defaultColors.concat();

            radar = new Chart(ctx, {
                type: 'radar',
                data: {
                    labels: labels,
                    // labels: labels,
                    datasets: obj
                },
            });
        }

    }


    studentradarchart();
    function studentradarchart(labels, obj) {

        if (divradar) {
            divradar.data.labels = labels;
            divradar.data.datasets = obj;
            divradar.update();
        } else {
            var ctx = document.getElementById("student-radar-chart").getContext('2d');
            var defaultColors = ["#1abc9c", "#f1556c", "#4a81d4", "#e3eaef"];
            var colors = dataColors ? dataColors.split(",") : defaultColors.concat();

            divradar = new Chart(ctx, {
                type: 'radar',
                data: {
                    labels: labels,
                    // labels: labels,
                    datasets: obj
                },
            });
        }

    }

    function donutchart(pass, fail, inprogress) {

        colors = ["#00b19d", "#f1556c", "#775DD0"];
        options = {
            chart: {
                height: 320,
                type: "donut"
            },
            series: [pass, fail, inprogress],
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
            labels: ["Pass", "Fail", "Inprogress"],
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

        donut_chart = new ApexCharts(document.querySelector("#donut-chart-test-summary"), options);
        donut_chart.render();

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

});