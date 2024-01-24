$(function () {
    $('#sr_class_id').on('change', function () {
        var class_id = $(this).val();
        $("#sr_section_id").empty();
        $("#sr_section_id").append('<option value="">' + select_class + '</option>');
        $("#sr_examnames").empty();
        $("#sr_examnames").append('<option value="">' + select_exam + '</option>');
        $("#sr_student_id").empty();
        $("#sr_student_id").append('<option value="">' + select_student + '</option>');

        $.post(teacherSectionUrl, { token: token, branch_id: branchID, teacher_id: ref_user_id, class_id: class_id }, function (res) {
            if (res.code == 200) {
                $.each(res.data, function (key, val) {
                    $("#sr_section_id").append('<option value="' + val.section_id + '">' + val.section_name + '</option>');
                });
            }
        }, 'json');
    });
    // change section
    $('#sr_section_id').on('change', function () {
        var section_id = $(this).val();
        var class_id = $("#sr_class_id").val();
        var academic_session_id = $("#sr_btwyears").val();
        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
        var yyyy = today.getFullYear();

        today = yyyy + '/' + mm + '/' + dd;
        $("#sr_examnames").empty();
        $("#sr_examnames").append('<option value="">' + select_exam + '</option>');
        $("#sr_student_id").empty();
        $("#sr_student_id").append('<option value="">' + select_student + '</option>');

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
                    $("#sr_examnames").append('<option value="' + val.id + '" >' + val.name + '</option>');
                });
            }
        }, 'json');
        $.post(getStudentList, { token: token, branch_id: branchID, class_id: class_id, academic_session_id: academic_session_id, section_id: section_id }, function (res) {
            if (res.code == 200) {
                $.each(res.data, function (key, val) {
                    $("#sr_student_id").append('<option value="' + val.id + '">' + val.name + '</option>');
                });
            }
        }, 'json');
    });
    $('.studentRank').on('change', function () {

        var session_id = $("#sr_session_id").val();
        var semester_id = $("#sr_semester_id").val();
        var student_id = $("#sr_student_id").val();
        var academic_session_id = $("#sr_btwyears").val();
        var exam_id = $("#sr_examnames").val();
        if (exam_id) {

            $.post(getMarksByStudent, { token: token, branch_id: branchID, session_id: session_id, semester_id: semester_id, exam_id: exam_id, student_id: student_id, academic_session_id: academic_session_id }, function (res) {
                console.log('124', res)
                if (res.code == 200) {
                    var datasetnew = res.data;
                    bystudentdetails(datasetnew);
                }
            }, 'json');
        } else {
            $('#class_rank').empty();
            $('#class_total').empty();
            $('#student_rank_body').empty();
            $("#student_rank_body").append('<tr><td class="text-center" colspan="4">' + no_data_available + '</td></tr>');
        }

    });

    function bystudentdetails(datasetnew) {
        $('#student_rank_body').empty();
        $('#class_rank').empty();
        $('#class_total').empty();
        var sno = 0;
        var bySubject = "";
        var subjects = datasetnew.details;
        var rank = datasetnew.rank.rank;
        var total = datasetnew.rank.mark;
        $("#class_total").text(total);
        $("#class_rank").text(rank);
        if (subjects.length > 0) {
            subjects.forEach(function (res) {
                sno++;
                bySubject += '<tr><td>' + sno + '</td>';
                bySubject += '<td>' + res.subject_name + '</td>';
                bySubject += '<td>' + res.mark + '</td>';
                bySubject += '<td>' + res.rank + '</td>';
                bySubject += '</tr>';
            });
        } else {
            bySubject += '<tr><td colspan="4">' + no_data_available + '</td></tr>';
        }
        $("#student_rank_body").append(bySubject);
    }

    $('#st_class_id').on('change', function () {
        var class_id = $(this).val();
        $("#st_section_id").empty();
        $("#st_section_id").append('<option value="">' + select_class + '</option>');
        $("#st_student_id").empty();
        $("#st_student_id").append('<option value="">' + select_student + '</option>');

        $.post(teacherSectionUrl, { token: token, branch_id: branchID, teacher_id: ref_user_id, class_id: class_id }, function (res) {
            if (res.code == 200) {
                $.each(res.data, function (key, val) {
                    $("#st_section_id").append('<option value="' + val.section_id + '">' + val.section_name + '</option>');
                });
            }
        }, 'json');
    });
    // change section
    $('#st_section_id').on('change', function () {
        var section_id = $(this).val();
        var class_id = $("#st_class_id").val();
        var academic_session_id = $("#st_btwyears").val();
        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
        var yyyy = today.getFullYear();

        today = yyyy + '/' + mm + '/' + dd;
        $("#st_student_id").empty();
        $("#st_student_id").append('<option value="">' + select_student + '</option>');
        $.post(getStudentList, { token: token, branch_id: branchID, class_id: class_id, academic_session_id: academic_session_id, section_id: section_id }, function (res) {
            if (res.code == 200) {
                $.each(res.data, function (key, val) {
                    $("#st_student_id").append('<option value="' + val.id + '">' + val.name + '</option>');
                });
            }
        }, 'json');
    });

    $('.studentSemester').on('change', function () {
        var student_id = $("#st_student_id").val();
        var academic_session_id = $("#st_btwyears").val();
        if (student_id) {

            $.post(all_exam_subject_scores, { token: token, branch_id: branchID, student_id: student_id, academic_session_id: academic_session_id }, function (res) {

                if (res.code == 200) {
                    var datasetnew = res.data;
                    bystudentSemester(datasetnew);
                }
            }, 'json');
        } else {
            $('#st_semester_wise_head').empty();
            $('#st_semester_wise_body').empty();
        }

    });


    function bystudentSemester(datasetnew) {
        $('#st_semester_wise_head').empty();
        $('#st_semester_wise_body').empty();
        var headone = "<tr>";
        $.each(datasetnew, function (key, val) {
            var count = val.exam_marks.length;
            if (key == 0) {
                headone += '<th rowspan="2">#</th><th rowspan="2">Exam Name</th>';
                headone += '<th colspan="' + count + '">Subjects</th>';
            }
        });
        headone += '</tr>';
        headone += "<tr>";
        $.each(datasetnew, function (key1, val1) {
            var marks = val1.exam_marks;
            $.each(marks, function (key2, val2) {
                if (key1 == 0) {
                    headone += ' <th>' + val2.subject_name + '</th>';
                }
            });
        });
        headone += '</tr>';
        // console.log('headone', headone)
        var body = "";
        $.each(datasetnew, function (key3, val3) {
            body += '<tr>';
            var sl = key3 + 1;
            body += '<td>' + sl + '</td>';
            body += '<td>' + val3.exam_name + '</td>';
            var marks1 = val3.exam_marks;
            $.each(marks1, function (key4, val4) {
                body += ' <td>' + val4.mark + '</td>';
            });
            body += '</tr>';
        });
        $("#st_semester_wise_head").append(headone);
        $("#st_semester_wise_body").append(body);
    }

    $('#ems_class_id').on('change', function () {
        var class_id = $(this).val();
        $("#ems_section_id").empty();
        $("#ems_section_id").append('<option value="">' + select_class + '</option>');
        $("#ems_student_id").empty();
        $("#ems_student_id").append('<option value="">' + select_student + '</option>');

        $.post(teacherSectionUrl, { token: token, branch_id: branchID, teacher_id: ref_user_id, class_id: class_id }, function (res) {
            if (res.code == 200) {
                $.each(res.data, function (key, val) {
                    $("#ems_section_id").append('<option value="' + val.section_id + '">' + val.section_name + '</option>');
                });
            }
        }, 'json');
    });
    // change section
    $('#ems_section_id').on('change', function () {
        var section_id = $(this).val();
        var class_id = $("#ems_class_id").val();
        var academic_session_id = $("#ems_btwyears").val();
        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
        var yyyy = today.getFullYear();

        today = yyyy + '/' + mm + '/' + dd;
        $("#ems_student_id").empty();
        $("#ems_student_id").append('<option value="">' + select_student + '</option>');
        $.post(getStudentList, { token: token, branch_id: branchID, class_id: class_id, academic_session_id: academic_session_id, section_id: section_id }, function (res) {
            if (res.code == 200) {
                $.each(res.data, function (key, val) {
                    $("#ems_student_id").append('<option value="' + val.id + '">' + val.name + '</option>');
                });
            }
        }, 'json');
    });

    $('#st10_class_id').on('change', function () {
        var class_id = $(this).val();
        $("#st10_section_id").empty();
        $("#st10_section_id").append('<option value="">' + select_class + '</option>');
        $("#st10_examnames").empty();
        $("#st10_examnames").append('<option value="">' + select_exam + '</option>');

        $.post(teacherSectionUrl, { token: token, branch_id: branchID, teacher_id: ref_user_id, class_id: class_id }, function (res) {
            if (res.code == 200) {
                $.each(res.data, function (key, val) {
                    $("#st10_section_id").append('<option value="' + val.section_id + '">' + val.section_name + '</option>');
                });
            }
        }, 'json');
    });
    // change section
    $('#st10_section_id').on('change', function () {
        var section_id = $(this).val();
        var class_id = $("#st10_class_id").val();
        var academic_session_id = $("#st10_btwyears").val();
        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
        var yyyy = today.getFullYear();

        today = yyyy + '/' + mm + '/' + dd;
        $("#st10_examnames").empty();
        $("#st10_examnames").append('<option value="">' + select_exam + '</option>');

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
                    $("#st10_examnames").append('<option value="' + val.id + '" >' + val.name + '</option>');
                });
            }
        }, 'json');
    });
    $('.studentTop').on('change', function () {

        var session_id = $("#st10_session_id").val();
        var semester_id = $("#st10_semester_id").val();
        var class_id = $("#st10_class_id").val();
        var section_id = $("#st10_section_id").val();
        var academic_session_id = $("#st10_btwyears").val();
        var exam_id = $("#st10_examnames").val();
        var type = "top";
        var subject_id = "All";
        if (exam_id) {

            $.post(getTenStudent, {
                branch_id: branchID,
                class_id: class_id,
                section_id: section_id,
                session_id: session_id,
                semester_id: semester_id,
                exam_id: exam_id,
                type: type,
                subject_id: subject_id,
                academic_session_id: academic_session_id
            }, function (res) {
                if (res.code == 200) {
                    $('#' + type + '_student_table').empty();
                    var datasetnew = res.data;
                    if(datasetnew.length == 0){
                        $('#' + type + '_student_table').append('<tr><td class="text-center" colspan="5">' + no_data_available + '</td></tr>');
                    }else{
                        topstudent(datasetnew, type);
                    }
                }
            }, 'json');
        } else {
            $('#' + type + '_student_table').empty();
            $('#' + type + '_student_table').append('<tr><td  class="text-center" colspan="5">' + no_data_available + '</td></tr>');
                    
        }

    });


    $('#sb10_class_id').on('change', function () {
        var class_id = $(this).val();
        $("#sb10_section_id").empty();
        $("#sb10_section_id").append('<option value="">' + select_class + '</option>');
        $("#sb10_examnames").empty();
        $("#sb10_examnames").append('<option value="">' + select_exam + '</option>');

        $.post(teacherSectionUrl, { token: token, branch_id: branchID, teacher_id: ref_user_id, class_id: class_id }, function (res) {
            if (res.code == 200) {
                $.each(res.data, function (key, val) {
                    $("#sb10_section_id").append('<option value="' + val.section_id + '">' + val.section_name + '</option>');
                });
            }
        }, 'json');
    });
    // change section
    $('#sb10_section_id').on('change', function () {
        var section_id = $(this).val();
        var class_id = $("#sb10_class_id").val();
        var academic_session_id = $("#sb10_btwyears").val();
        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
        var yyyy = today.getFullYear();

        today = yyyy + '/' + mm + '/' + dd;
        $("#sb10_examnames").empty();
        $("#sb10_examnames").append('<option value="">' + select_exam + '</option>');

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
                    $("#sb10_examnames").append('<option value="' + val.id + '" >' + val.name + '</option>');
                });
            }
        }, 'json');
    });
    $('.studentBottom').on('change', function () {

        var session_id = $("#sb10_session_id").val();
        var semester_id = $("#sb10_semester_id").val();
        var class_id = $("#sb10_class_id").val();
        var section_id = $("#sb10_section_id").val();
        var academic_session_id = $("#sb10_btwyears").val();
        var exam_id = $("#sb10_examnames").val();
        var type = "bottom";
        var subject_id = "All";
        if (exam_id) {

            $.post(getTenStudent, {
                branch_id: branchID,
                class_id: class_id,
                section_id: section_id,
                session_id: session_id,
                semester_id: semester_id,
                exam_id: exam_id,
                type: type,
                subject_id: subject_id,
                academic_session_id: academic_session_id
            }, function (response) {
                
                if (response.code == 200) {
                    $('#' + type + '_student_table').empty();
                    var datasetnew = response.data;
                    if(datasetnew.length == 0){
                        $('#' + type + '_student_table').append('<tr><td  class="text-center" colspan="5">' + no_data_available + '</td></tr>');
                    }else{
                        topstudent(datasetnew, type);
                    }
                }

            }, 'json');
        } else {
            $('#' + type + '_student_table').empty();
            $('#' + type + '_student_table').append('<tr><td  class="text-center" colspan="5">' + no_data_available + '</td></tr>');
                    
        }

    });

    function topstudent(datasetnew, type) {

        var sno = 0;
        var byStudent = "";
        // var students = datasetnew.details;
        var students = datasetnew;
        $.each(students, function (key, res) {
            sno++;
                if (sno < 11) {
                    byStudent += '<tr><td>' + sno + '</td>';
                    byStudent += '<td>' + res.student_name + '</td>';
                    byStudent += '<td>' + res.total_mark + '</td>';
                    byStudent += '<td>' + res.mark + '</td>';
                    byStudent += '<td>' + res.rank + '</td>';
                    byStudent += '</tr>';
                }
        });
        $('#' + type + '_student_table').append(byStudent);
    }

    var radar;
    var radarSubjectScore;
    var radarSubjectRank;
    var radarSubjectAvgHighLow;

    $('.examMarkStatus').on('change', function () {

        $("#scoreExamID").empty();
        var student_id = $("#ems_student_id").val();
        var academic_id = $("#ems_btwyears").val();
        if (student_id) {
            $.get(examByStudent, { token: token, branch_id: branchID, student_id: student_id, academic_session_id: academic_id }, function (res) {
                if (res.code == 200) {
                    console.log('123', res)
                    $.each(res.data, function (key, val) {
                        $("#scoreExamID").append('<option value="' + val.id + '">' + val.name + '</option>');
                    });
                }
            }, 'json');
            callRadarChart();
        }
    });
    function callRadarChart() {

        var student_id = $("#ems_student_id").val();
        var academic_id = $("#ems_btwyears").val();
        // $.post(getTestScore, {
        //     token: token,
        //     branch_id: branchID,
        //     student_id: student_id,
        //     academic_session_id: academic_id
        // }, function (response) {
        //     console.log('incl',response)
        //     if (response.code == 200) {
        //         var subjects = response.data.headers;
        //         var marks = response.data.allbyStudent;
        //         var data = [];
        //         var label = [];
        //         if (subjects.length > 0 && marks.length) {
        //             subjects.forEach(function (res) {
        //                 label.push(res.subject_name);
        //             });
        //             $.each(marks, function (key, value) {
        //                 var randcol = getRandomColor();
        //                 var obj = {};
        //                 var score = [];
        //                 obj["label"] = value.exam_name;
        //                 obj["backgroundColor"] = hexToRGB(randcol, 0.3);
        //                 obj["borderColor"] = randcol;
        //                 obj["pointBackgroundColor"] = randcol;
        //                 obj["pointBorderColor"] = "#fff";
        //                 obj["pointHoverBackgroundColor"] = "#fff";
        //                 obj["pointHoverBorderColor"] = randcol;
        //                 $.each(value.student_class, function (keys, val) {
        //                     let mark = parseInt(val.marks);
        //                     score.push(mark);
        //                 });
        //                 obj["data"] = score;
        //                 data.push(obj);
        //             });
        //             testScoreAnalysisChart(label, data);
        //         }
        //     }
        // }, 'json');
        // all exam subject scores
        $.post(allExamSubjectScores, {
            token: token,
            branch_id: branchID,
            student_id: student_id,
            academic_session_id: academic_id
        }, function (response) {
            if (response.code == 200) {
                var scores = response.data;
                var data = [];
                var label = [];
                if (scores.length > 0) {
                    let labelCount = 0;
                    $.each(scores, function (key, value) {
                        var randcol = getRandomColor();
                        var obj = {};
                        var score = [];
                        obj["label"] = value.exam_name;
                        obj["backgroundColor"] = hexToRGB(randcol, 0.3);
                        obj["borderColor"] = randcol;
                        obj["pointBackgroundColor"] = randcol;
                        obj["pointBorderColor"] = "#fff";
                        obj["pointHoverBackgroundColor"] = "#fff";
                        obj["pointHoverBorderColor"] = randcol;
                        $.each(value.exam_marks, function (keys, val) {
                            let mark = parseInt(val.mark);
                            score.push(mark);
                            if (labelCount == 0) {
                                label.push(val.subject_name);
                            }
                        });
                        obj["data"] = score;
                        data.push(obj);
                        labelCount++;
                    });
                    allExamSubjectScoresChart(label, data);
                }
            }
        }, 'json');
        // all exam subject ranks
        $.post(allExamSubjectRanks, {
            token: token,
            branch_id: branchID,
            student_id: student_id,
            academic_session_id: academic_id
        }, function (response) {
            if (response.code == 200) {
                var all_rank = response.data;
                var data = [];
                var label = [];
                if (all_rank.length > 0) {
                    let labelCount = 0;
                    $.each(all_rank, function (key, value) {
                        var randcol = getRandomColor();
                        var obj = {};
                        var ranks = [];
                        obj["label"] = value.exam_name;
                        obj["backgroundColor"] = hexToRGB(randcol, 0.3);
                        obj["borderColor"] = randcol;
                        obj["pointBackgroundColor"] = randcol;
                        obj["pointBorderColor"] = "#fff";
                        obj["pointHoverBackgroundColor"] = "#fff";
                        obj["pointHoverBorderColor"] = randcol;
                        $.each(value.exam_rank, function (keys, val) {
                            let rank = parseInt(val.rank.rank);
                            ranks.push(rank);
                            if (labelCount == 0) {
                                label.push(val.subject_name);
                            }
                        });
                        obj["data"] = ranks;
                        data.push(obj);
                        labelCount++;
                    });
                    allExamSubjectRankChart(label, data);
                }
            }
        }, 'json');
    }
    // function testScoreAnalysisChart(labels, obj) {
    //     if (radar) {
    //         radar.data.labels = labels;
    //         radar.data.datasets = obj;
    //         radar.update();
    //     } else {
    //         var ctx = document.getElementById("radar-chart-test-marks").getContext('2d');
    //         radar = new Chart(ctx, {
    //             type: 'radar',
    //             data: {
    //                 labels: labels,
    //                 datasets: obj
    //             },
    //         });
    //     }
    // }
    // Test Score Analysis end
    // all exam subject scores start
    function allExamSubjectScoresChart(labels, obj) {
        if (radarSubjectScore) {
            radarSubjectScore.data.labels = labels;
            radarSubjectScore.data.datasets = obj;
            radarSubjectScore.update();
        } else {
            var ctx = document.getElementById("allExamSubjectScoresChart").getContext('2d');
            radarSubjectScore = new Chart(ctx, {
                type: 'radar',
                data: {
                    labels: labels,
                    datasets: obj
                },
            });
        }
    }
    // all exam subject scores end
    // all exam subject ranks start
    function allExamSubjectRankChart(labels, obj) {
        if (radarSubjectRank) {
            radarSubjectRank.data.labels = labels;
            radarSubjectRank.data.datasets = obj;
            radarSubjectRank.update();
        } else {
            var ctx = document.getElementById("allExamSubjectRankChart").getContext('2d');
            radarSubjectRank = new Chart(ctx, {
                type: 'radar',
                data: {
                    labels: labels,
                    datasets: obj
                },
            });
        }
    }
    // all_exam_subject_ranks
    // exam  subject mark high low avg start
    $('#scoreExamID').on('change', function () {
        var exam_id = $(this).val();
        var student_id = $("#ems_student_id").val();
        var academic_id = $("#ems_btwyears").val();
        if (exam_id) {
            // exam subject mark High Low Avg
            $.post(examSubjectMarkHighLowAvg, {
                token: token,
                branch_id: branchID,
                student_id: student_id,
                academic_session_id: academic_id,
                exam_id: exam_id
            }, function (response) {
                if (response.code == 200) {
                    var highLowAvg = response.data;
                    var alllabel = ['my', 'highest', 'average', 'lowest'];
                    var data = [];
                    var label = [];
                    var marks = [];
                    var max_marks = [];
                    var min_marks = [];
                    var avg_marks = [];
                    if (highLowAvg.length > 0) {
                        $.each(highLowAvg, function (key, value) {
                            let mark = parseInt(value.mark);
                            let max = parseInt(value.max);
                            let min = parseInt(value.min);
                            let avg = parseInt(value.avg);
                            marks.push(mark);
                            max_marks.push(max);
                            min_marks.push(min);
                            avg_marks.push(avg);
                            label.push(value.subject_name);
                        });
                        $.each(alllabel, function (key, value) {
                            var obj = {};
                            var randcol = getRandomColor();
                            obj["label"] = value;
                            obj["backgroundColor"] = hexToRGB(randcol, 0.3);
                            obj["borderColor"] = randcol;
                            obj["pointBackgroundColor"] = randcol;
                            obj["pointBorderColor"] = "#fff";
                            obj["pointHoverBackgroundColor"] = "#fff";
                            obj["pointHoverBorderColor"] = randcol;
                            if (value == "my") {
                                obj["data"] = marks;
                            } else if (value == "highest") {
                                obj["data"] = max_marks;
                            } else if (value == "average") {
                                obj["data"] = avg_marks;
                            } else if (value == "lowest") {
                                obj["data"] = min_marks;
                            } else {
                                obj["data"] = [];
                            }
                            data.push(obj);
                        });
                        subjectMarkHighLowAvg(label, data);
                    }
                }
            }, 'json');
        }

    });
    function subjectMarkHighLowAvg(labels, obj) {
        if (radarSubjectAvgHighLow) {
            radarSubjectAvgHighLow.data.labels = labels;
            radarSubjectAvgHighLow.data.datasets = obj;
            radarSubjectAvgHighLow.update();
        } else {
            var ctx = document.getElementById("examSubjectMarkHighLowAvg").getContext('2d');
            radarSubjectAvgHighLow = new Chart(ctx, {
                type: 'radar',
                data: {
                    labels: labels,
                    datasets: obj
                },
            });
        }
    }
    // exam  subject mark high low avg end
    function getRandomColor() {
        var letters = '0123456789ABCDEF';
        var color = '#';
        for (var i = 0; i < 6; i++) {
            color += letters[Math.floor(Math.random() * 16)];
        }
        return color;
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
    $.ajax({
        url: staffLeaveHistoryDashboardUrl, // Replace with your API endpoint
        method: 'GET',
        dataType: 'json',
        data: {
            branch_id: branchID,
            academic_session_id: academic_session_id
        },
        success: function (response) {
            // dataSetNew
            var dataSetNew = response.data;
            staffLeaveList(dataSetNew);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            // console.error('Example 2 Error:', textStatus, errorThrown);
            staffLeaveList([]);
        }
    });
    function staffLeaveList(dataSetNew) {
        // clear old data in datatable
        $('#staff-leave-list').DataTable().clear().destroy();
        $('#staff-leave-list td').empty();

        $('#staff-leave-list').DataTable({
            processing: true,
            bDestroy: true,
            info: true,
            dom: "<'row'<'col-sm-2 col-md-2'l><'col-sm-4 col-md-4'B><'col-sm-6 col-md-6'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-6'i><'col-sm-6'p>>",

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
            buttons: [
                {
                    extend: 'csv',
                    text: downloadcsv,
                    extension: '.csv',
                    charset: 'utf-8',
                    bom: true,
                    exportOptions: {
                        columns: 'th:not(:last-child)'
                    }
                },
                {
                    extend: 'pdf',
                    text: downloadpdf,
                    extension: '.pdf',
                    charset: 'utf-8',
                    bom: true,
                    exportOptions: {
                        columns: 'th:not(:last-child)'
                    },


                    customize: function (doc) {
                        doc.pageMargins = [50, 50, 50, 50];
                        doc.defaultStyle.fontSize = 10;
                        doc.styles.tableHeader.fontSize = 12;
                        doc.styles.title.fontSize = 14;
                        // Remove spaces around page title
                        doc.content[0].text = doc.content[0].text.trim();
                        /*// Create a Header
                        doc['header']=(function(page, pages) {
                            return {
                                columns: [
                                    
                                    {
                                        // This is the right column
                                        bold: true,
                                        fontSize: 20,
                                        color: 'Blue',
                                        fillColor: '#fff',
                                        alignment: 'center',
                                        text: header_txt
                                    }
                                ],
                                margin:  [50, 15,0,0]
                            }
                        });*/
                        // Create a footer

                        doc['footer'] = (function (page, pages) {
                            return {
                                columns: [
                                    { alignment: 'left', text: [footer_txt], width: 400 },
                                    {
                                        // This is the right column
                                        alignment: 'right',
                                        text: ['page ', { text: page.toString() }, ' of ', { text: pages.toString() }],
                                        width: 100

                                    }
                                ],
                                margin: [50, 0, 0, 0]
                            }
                        });

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
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'leave_type_name',
                    name: 'leave_type_name'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'from_leave',
                    name: 'from_leave'
                },
                {
                    data: 'to_leave',
                    name: 'to_leave'
                },
                {
                    data: 'reason_name',
                    name: 'reason_name'
                },
                {
                    data: 'status',
                    name: 'status'
                }
            ],
            columnDefs: [
                {
                    "targets": 0,
                    "render": function (data, type, row, meta) {
                        return meta.row + 1;
                    }
                }
            ]
        }).on('draw', function () {
        });
    }
});