$(function () {
    // marks by subject Chart

    // test result subject wise result
    var radar;
    var divradar;
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
    (chart = new ApexCharts(document.querySelector("#subject-avg-chart"), options)).render();

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
    $("#department_id").on('change', function (e) {
        e.preventDefault();
        var Selector = '#testresultFilter';
        var department_id = $(this).val();
        var classID = "";
        classAllocation(department_id, Selector, classID);
    });
    function classAllocation(department_id, Selector, classID) {
        $(Selector).find('select[name="class_id"]').empty();
        $(Selector).find('select[name="class_id"]').append('<option value="">' + select_grade + '</option>');
        if (department_id) {
            $.post(getGradeByDepartmentUrl,
                {
                    branch_id: branchID,
                    department_id: department_id
                }, function (res) {
                    if (res.code == 200) {
                        $.each(res.data, function (key, val) {
                            $(Selector).find('select[name="class_id"]').append('<option value="' + val.id + '">' + val.name + '</option>');
                        });
                        if (classID != '') {
                            $(Selector).find('select[name="class_id"]').val(classID);
                        }
                    }
                }, 'json');
        }
    }
    // change classroom
    $('#changeClassName').on('change', function () {
        $(".testResultHideSHow").hide();
        var class_id = $(this).val();
        $("#testresultFilter").find("#sectionID").empty();
        $("#testresultFilter").find("#sectionID").append('<option value="">'+select_class+'</option>');
        $("#testresultFilter").find("#examnames").empty();
        $("#testresultFilter").find("#examnames").append('<option value="">'+select_exam+'</option>');
        $("#testresultFilter").find("#subjectID").empty();
        $("#testresultFilter").find("#subjectID").append('<option value="">'+select_subject+'</option>');
        $("#testresultFilter").find("#paperID").empty();
        $("#testresultFilter").find("#paperID").append('<option value="">'+select_paper+'</option>');

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
        $("#testresultFilter").find("#examnames").append('<option value="">'+select_exam+'</option>');
        $("#testresultFilter").find("#subjectID").empty();
        $("#testresultFilter").find("#subjectID").append('<option value="">'+select_subject+'</option>');
        $("#testresultFilter").find("#paperID").empty();
        $("#testresultFilter").find("#paperID").append('<option value="">'+select_paper+'</option>');

        $.post(subjectByExamNames, {
            token: token,
            branch_id: branchID,
            class_id: class_id,
            section_id: section_id,
            academic_session_id: academic_session_id,
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
        var teacher_id = teacherID;
        $("#testresultFilter").find("#subjectID").empty();
        $("#testresultFilter").find("#subjectID").append('<option value="">'+select_subject+'</option>');
        $("#testresultFilter").find("#paperID").empty();
        $("#testresultFilter").find("#paperID").append('<option value="">'+select_paper+'</option>');
        $.post(examBySubjects, {
            token: token,
            branch_id: branchID,
            class_id: class_id,
            teacher_id: teacher_id,
            section_id: section_id,
            academic_session_id: academic_session_id,
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
        $("#testresultFilter").find("#paperID").append('<option value="">'+select_paper+'</option>');
        // paper list
        $.post(subjectByPapers, {
            token: token,
            branch_id: branchID,
            class_id: class_id,
            section_id: section_id,
            subject_id: subject_id,
            academic_session_id: academic_session_id,
            exam_id: exam_id
        }, function (res) {
            if (res.code == 200) {
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
            department_id : "required",
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
        if (classRoom === true) {

            var class_id = $("#changeClassName").val();
            var section_id = $("#sectionID").val();
            var subject_id = $("#subjectID").val();
            var exam_id = $("#examnames").val();
            var paper_id = $("#paperID").val();
            var semester_id = $("#semester_id").val();
            var session_id = $("#session_id").val();
            var grade_category = $('option:selected', '#paperID').attr('data-grade_category');

            var classObj = {
                classID: class_id,
                sectionID: section_id,
                grade_category: grade_category,
                paperID: paper_id,
                subjectID: subject_id,
                semesterID: semester_id,
                sessionID: session_id,
                examID: exam_id,
                userID: userID,
            };
            setLocalStorageForExamMark(classObj);

            var formData = new FormData();
            formData.append('token', token);
            formData.append('branch_id', branchID);
            formData.append('class_id', class_id);
            formData.append('section_id', section_id);
            formData.append('grade_category', grade_category);
            formData.append('subject_id', subject_id);
            formData.append('exam_id', exam_id);
            formData.append('paper_id', paper_id);
            formData.append('semester_id', semester_id);
            formData.append('session_id', session_id);
            formData.append('academic_session_id', academic_session_id);
            
            // setLocalStorageForTestResult(classObj);
            examMarkList(formData);

            callsubjectaveragechart(formData);

            callbarchart(formData);

            calldonutchart(formData);
        };
    });
    function examMarkList(formData){
        
        $("#overlay").fadeIn(300);
        $.ajax({
            url: getSubjectMarks,
            method: "post",
            data: formData,
            processData: false,
            dataType: 'json',
            contentType: false,
            success: function (response) {
                if (response.code == 200) {
                    var dataSetNew = response.data.get_subject_marks;
                    if (dataSetNew.length > 0) {
                        $("#grade_category").val(formData.get('grade_category'));
                        $("#mark_by_subject_card").show();
                        bindmarks(dataSetNew);
                        $("#listModeClassID").val(formData.get('class_id'));
                        $("#listModeSectionID").val(formData.get('section_id'));
                        $("#listModeSubjectID").val(formData.get('subject_id'));
                        $("#listModeexamID").val(formData.get('exam_id'));
                        $("#listModePaperID").val(formData.get('paper_id'));
                        $("#listModeSemesterID").val(formData.get('semester_id'));
                        $("#listModeSessionID").val(formData.get('session_id'));
                        // download start
                        $("#downClassID").val(formData.get('class_id'));
                        $("#downSectionID").val(formData.get('section_id'));
                        $("#downSubjectID").val(formData.get('subject_id'));
                        $("#downExamID").val(formData.get('exam_id'));
                        $("#downPaperID").val(formData.get('paper_id'));
                        $("#downSemesterID").val(formData.get('semester_id'));
                        $("#downSessionID").val(formData.get('session_id'));
                        $("#downGradeCategory").val(formData.get('grade_category'));
                        $("#downAcademicSessionID").val(formData.get('academic_session_id'));
                        // download end
                    } else {
                        toastr.error("No data available");
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
    }

    function setLocalStorageForExamMark(classObj) {

        var examMarkDetails = new Object();
        examMarkDetails.class_id = classObj.classID;
        examMarkDetails.section_id = classObj.sectionID;
        examMarkDetails.grade_category = classObj.grade_category;
        examMarkDetails.subject_id = classObj.subjectID;
        examMarkDetails.paper_id = classObj.paperID;
        examMarkDetails.exam_id = classObj.examID;
        examMarkDetails.semester_id = classObj.semesterID;
        examMarkDetails.session_id = classObj.sessionID;
        // here to attached to avoid localStorage other users to add
        examMarkDetails.branch_id = branchID;
        examMarkDetails.role_id = get_roll_id;
        examMarkDetails.user_id = ref_user_id;
        var examMarkClassArr = [];
        examMarkClassArr.push(examMarkDetails);
        if (get_roll_id == "2") {
            // admin
            localStorage.removeItem("admin_exam_mark_details");
            localStorage.setItem('admin_exam_mark_details', JSON.stringify(examMarkClassArr));
        }
        if (get_roll_id == "4") {
            // teacher
            localStorage.removeItem("teacher_exam_mark_details");
            localStorage.setItem('teacher_exam_mark_details', JSON.stringify(examMarkClassArr));
        }
        return true;
    }
    // if localStorage
    if (typeof exam_mark_storage !== 'undefined') {
        if ((exam_mark_storage)) {
            if (exam_mark_storage) {
                var examMarkStorage = JSON.parse(exam_mark_storage);
                if (examMarkStorage.length == 1) {
                    var classID, year,sectionID, grade_category, examID, semesterID, sessionID, userBranchID, userRoleID, userID;
                    examMarkStorage.forEach(function (user) {
                        grade_category = user.grade_category;
                        classID = user.class_id;
                        subjectID = user.subject_id;
                        paperID = user.paper_id;
                        sectionID = user.section_id;
                        examID = user.exam_id;
                        semesterID = user.semester_id;
                        sessionID = user.session_id;
                        userBranchID = user.branch_id;
                        userRoleID = user.role_id;
                        userID = user.user_id;
                    });
                    if ((userBranchID == branchID) && (userRoleID == get_roll_id) && (userID == ref_user_id)) {
                        $('#changeClassName').val(classID);
                        $('#semester_id').val(semesterID);
                        $('#session_id').val(sessionID);
                        if (classID) {
                            $("#testresultFilter").find("#sectionID").empty();
                            $("#testresultFilter").find("#sectionID").append('<option value="">'+select_class+'</option>');
                            
                            $.post(teacherSectionUrl, { token: token, branch_id: branchID, teacher_id: userID, class_id: classID }, function (res) {
                                if (res.code == 200) {
                                    $.each(res.data, function (key, val) {
                                        $("#testresultFilter").find("#sectionID").append('<option value="' + val.section_id + '">' + val.section_name + '</option>');
                                    });
                                    $("#testresultFilter").find("#sectionID").val(sectionID);
                                }
                            }, 'json');
                        }
                        if(sectionID){
                            var today = new Date();
                            var dd = String(today.getDate()).padStart(2, '0');
                            var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
                            var yyyy = today.getFullYear();
                    
                            today = yyyy + '/' + mm + '/' + dd;
                            $("#testresultFilter").find("#examnames").empty();
                            $("#testresultFilter").find("#examnames").append('<option value="">'+select_exam+'</option>');
                            $.post(subjectByExamNames, {
                                token: token,
                                branch_id: branchID,
                                class_id: classID,
                                section_id: sectionID,
                                academic_session_id: academic_session_id,
                                today: today
                            }, function (res) {
                                if (res.code == 200) {
                                    $.each(res.data, function (key, val) {
                                        $("#testresultFilter").find("#examnames").append('<option value="' + val.id + '" >' + val.name + '</option>');
                                    });
                                    
                                    $("#testresultFilter").find("#examnames").val(examID);
                                }
                            }, 'json');
                        }
                        if(examID){
                            
                            $("#testresultFilter").find("#subjectID").empty();
                            $("#testresultFilter").find("#subjectID").append('<option value="">'+select_subject+'</option>');
                            $.post(examBySubjects, {
                                token: token,
                                branch_id: branchID,
                                class_id: classID,
                                teacher_id: userID,
                                section_id: sectionID,
                                academic_session_id: academic_session_id,
                                exam_id: examID
                            }, function (res) {
                                if (res.code == 200) {
                                    $.each(res.data, function (key, val) {
                                        $("#testresultFilter").find("#subjectID").append('<option value="' + val.subject_id + '">' + val.subject_name + '</option>');
                                    });
                                    $("#testresultFilter").find("#subjectID").val(subjectID);
                                }
                            }, 'json');
                        }
                        if(subjectID){
                            
                            $("#testresultFilter").find("#paperID").empty();
                            $("#testresultFilter").find("#paperID").append('<option value="">'+select_paper+'</option>');
                            // paper list
                            $.post(subjectByPapers, {
                                token: token,
                                branch_id: branchID,
                                class_id: classID,
                                section_id: sectionID,
                                subject_id: subjectID,
                                academic_session_id: academic_session_id,
                                exam_id: examID
                            }, function (res) {
                                if (res.code == 200) {
                                    $.each(res.data, function (key, val) {
                                        $("#testresultFilter").find("#paperID").append('<option value="' + val.paper_id + '" data-grade_category="' + val.grade_category + '">' + val.paper_name + '</option>');
                                    });
                                    $("#testresultFilter").find("#paperID").val(paperID);
                                }
                            }, 'json');
                        }

                        var formData = new FormData();
                        formData.append('token', token);
                        formData.append('branch_id', branchID);
                        formData.append('class_id', classID);
                        formData.append('section_id', sectionID);
                        formData.append('grade_category', grade_category);
                        formData.append('subject_id', subjectID);
                        formData.append('exam_id', examID);
                        formData.append('paper_id', paperID);
                        formData.append('semester_id', semesterID);
                        formData.append('session_id', sessionID);
                        formData.append('academic_session_id', academic_session_id);

                        $("#overlay").fadeIn(300);
            
                        examMarkList(formData);
            
                        callsubjectaveragechart(formData);
            
                        callbarchart(formData);
            
                        calldonutchart(formData);
                    }
                }
            }
        }
    }
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
                            if (res.status == "Pass") {
                                pass = res.count;
                            }
                            if (res.status == "Fail" || res.status == "Absent") {
                                fail = res.count;
                            }
                            if (res.status == "null" || res.status == "") {
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
                            name: average,
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
        var grade_category = $("#grade_category").val();

        var studID = $(this).attr('id');
        if (marks_range != '') {
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
                    console.log("---");
                    console.log(res);
                    var gradeData = res.data.grade_details;
                    if (res.code == 200) {
                        var min_val = res.data.min_max_value[0].min_mark;
                        var max_val = res.data.min_max_value[0].max_mark;
                        // console.log(min_val);
                        // console.log(min_val);
                        // console.log(gradeData);
                        // console.log(gradeData.length);
                        if (gradeData.length > 0) {
                            if (min_val <= marks_range && max_val >= marks_range) {
                                $('.score' + studID).val(marks_range);
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
                            } else {
                                $('.score' + studID).val('');
                            }
                            $('.lbl_grade' + studID).text(gradeData[0].grade);
                            $('.lbl_grade' + studID).val(gradeData[0].grade);
                            // $('.lbl_grade' + studID).val(gradeData[0].status);
                            if (gradeData[0].status == "Pass") {
                                $('.badgeLabel' + studID).removeClass('badge-danger');
                                $('.badgeLabel' + studID).addClass('badge-success');
                                $('.lbl_pass_fail' + studID).text('Pass');
                                $('.lbl_pass_fail' + studID).val('Pass');

                            } else {
                                $('.badgeLabel' + studID).removeClass('badge-success');
                                $('.badgeLabel' + studID).addClass('badge-danger');
                                $('.lbl_pass_fail' + studID).text('Fail');
                                $('.lbl_pass_fail' + studID).val('Fail');
                            }
                        } else {
                            $('.score' + studID).val("");
                            $('.lbl_grade' + studID).text("-");
                            $('.lbl_grade' + studID).val("");
                            $('.lbl_ranking' + studID).text("-");
                            $('.lbl_ranking' + studID).val("");
                            $('#addRemarks' + studID).val("");
                            // remove class
                            $('.badgeLabel' + studID).removeClass('badge-success');
                            $('.badgeLabel' + studID).removeClass('badge-danger');
                            $('.lbl_pass_fail' + studID).text('-');
                            $('.lbl_pass_fail' + studID).val('-');
                        }
                    }
                    else {
                        $('.lbl_grade' + studID).text("");
                        $('.lbl_grade' + studID).val("");
                        $('.lbl_pass_fail' + studID).text("");
                        $('.lbl_pass_fail' + studID).val("");
                    }
                }
            });

        } else {
            console.log("here dt come");
            console.log(studID);
            $('.lbl_grade' + studID).text("");
            $('.lbl_grade' + studID).val("");
            $('.lbl_pass_fail' + studID).text("");
            $('.lbl_pass_fail' + studID).val("");
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
        var paper_id = $("#listModePaperID").val();
        var semester_id = $("#listModeSemesterID").val();
        var session_id = $("#listModeSessionID").val();

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
        formData.append('academic_session_id', academic_session_id);

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
                    calldonutchart(formData);
                    toastr.success(response.message);
                }
                else {
                    toastr.error(response.message);
                }
            }
        });



    });

    // function list mode
    function bindmarks(dataSetNew) {

        listTable = $('#stdmarks').DataTable({
            processing: true,
            bDestroy: true,
            info: true,
            dom: "<'row'<'col-sm-2 col-md-2'l><'col-sm-4 col-md-4'B><'col-sm-6 col-md-6'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-6'i><'col-sm-6'p>>",
            paging: false,
            "language": {
                
                "emptyTable": no_data_available,
                "infoFiltered": filter_from_total_entries,
                "zeroRecords": no_matching_records_found,
                "infoEmpty": showing_zero_entries,
                "info": showing_entries,
                "lengthMenu": show_entries,
                "search": datatable_search,
                "paginate": {
                    "next": next,
                    "previous": previous
                },
            },
            buttons: [],
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
                    data: 'name'
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
                        var attribue = "";
                        if (row.status == "absent") {
                            attribue = "disabled";
                        }
                        var score = '<input type="number" maxlength="3" ' + attribue + ' class="form-control basevalidation score' + row.student_id + '" name="subjectmarks[' + meta.row + '][score]" id="' + row.student_id + '" value="' + (data != null ? data : "") + '">';

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
                        if (data == "Pass") {
                            passTag = "badge-success";
                        } else if (data == "Fail") {
                            passTag = "badge-danger";
                        } else {
                            if (row.status == "absent") {
                                passTag = "badge-danger";
                            } else {
                                passTag = "-";
                            }
                        }
                        var pass_fail = '<span class="badge badgeLabel' + row.student_id + ' ' + passTag + ' badge-pill lbl_pass_fail' + row.student_id + '" style="padding:5px 20px 5px 20px;">' + (data ? data : "-") + '</span>' +
                            '<input type="hidden" class="lbl_pass_fail' + row.student_id + '" name="subjectmarks[' + meta.row + '][pass_fail]" value="' + row.pass_fail + '">';

                        return pass_fail;
                    }
                },
                {
                    "targets": 5,
                    "className": "text-center",
                    "render": function (data, type, row, meta) {

                        var ranking = '<label for="ranking" class="lbl_ranking' + row.student_id + '">' + (data ? data : "-") + '</label>' +
                            '<input type="hidden" class="lbl_ranking' + row.student_id + '" name="subjectmarks[' + meta.row + '][ranking]" value="' + row.ranking + '">';

                        return ranking;
                    }
                },
                {
                    "targets": 6,
                    "render": function (data, type, row, meta) {
                        var att_status = '<select class="form-control attendance_status" id="' + row.student_id + '" data-style="btn-outline-success" name="subjectmarks[' + meta.row + '][status]">' +
                            '<option value="">'+choose+'</option>' +
                            '<option value="present" ' + (row.status == "present" ? "selected" : "selected") + '>'+present_lang+'</option>' +
                            '<option value="absent" ' + (row.status == "absent" ? "selected" : "") + '>'+absent_lang+'</option>' +
                            '</select>';
                        return att_status;
                    }
                },
                {
                    "targets": 7,
                    "className": "text-center",
                    "render": function (data, type, row, meta) {
                        var attribue = "";
                        if (row.status == "absent") {
                            attribue = "disabled";
                        }
                        var memo = '<textarea style="display:none;" maxlength="50" class="addRemarks" data-id="' + row.student_id + '" id="addRemarks' + row.student_id + '" name="subjectmarks[' + meta.row + '][memo]">' + (data !== "null" ? data : "") + '</textarea>' +
                            '<button type="button" ' + attribue + ' data-id="' + row.student_id + '" id="addRemarks' + row.student_id + '" class="btn btn-outline-info waves-effect waves-light list-mode-btn addRemarks' + row.student_id + '" data-toggle="modal" data-target="#stuRemarksPopup" id="editRemarksStudent">'+add_remarks+'</button>';
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
        formData.append('academic_session_id', academic_session_id);
        $("#studentMarkModal").modal('show');
        // return false;
        callstudentchart(formData);
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
            labels: [pass_lang, fail_lang, inprogress_lang],
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
    // change student attendance status
    $(document).on('change', '.attendance_status', function () {
        // var studenetID = $(this).data('id');
        let value = $(this).val();
        let studenetID = $(this).attr("id");
        console.log(value);
        console.log("studenetID")
        console.log(studenetID)
        if (value == "present") {
            $('.lbl_grade' + studenetID).text("-");
            $('.lbl_grade' + studenetID).val("");
            $('.score' + studenetID).val("");
            $('.lbl_ranking' + studentID).text("-");
            $('.lbl_ranking' + studentID).val("");
            $('#addRemarks' + studenetID).val("");
            // absent
            $('.badgeLabel' + studenetID).removeClass('badge-success');
            $('.badgeLabel' + studenetID).removeClass('badge-danger');
            // $('.badgeLabel' + studenetID).addClass('badge-danger');
            $('.lbl_pass_fail' + studenetID).text('-');
            $('.lbl_pass_fail' + studenetID).val('-');
            // enable
            $('.score' + studenetID).prop('disabled', false);
            $(".addRemarks" + studenetID).prop('disabled', false);

        }
        if (value == "absent") {
            $('.lbl_grade' + studenetID).text("-");
            $('.lbl_grade' + studenetID).val("");
            $('.score' + studenetID).val("");
            $('.lbl_ranking' + studentID).text("-");
            $('.lbl_ranking' + studentID).val("");
            $('#addRemarks' + studenetID).val("");
            // absent
            $('.badgeLabel' + studenetID).removeClass('badge-success');
            $('.badgeLabel' + studenetID).addClass('badge-danger');
            $('.lbl_pass_fail' + studenetID).text('Absent');
            $('.lbl_pass_fail' + studenetID).val('Absent');
            // disable
            $('.score' + studenetID).prop('disabled', true);
            $(".addRemarks" + studenetID).prop('disabled', true);


        }

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
        // var attendanceType = $('#attendance' + studenetID).val();
        // $('#reasons' + studenetID).empty();
        // $('#reasons' + studenetID).append('<option value="">'+choose+'</option>');
        // $.post(getAbsentLateExcuse, {
        //     token: token,
        //     branch_id: branchID,
        //     attendance_type: attendanceType
        // }, function (res) {
        //     if (res.code == 200) {
        //         $.each(res.data, function (key, val) {
        //             $('#reasons' + studenetID).append('<option value="' + val.id + '">' + val.name + '</option>');
        //         });
        //     }
        // }, 'json');
    });

});