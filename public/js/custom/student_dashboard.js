$(function () {
    $('.studentRank').on('change', function () {

        var session_id = $("#sr_session_id").val();
        var semester_id = $("#sr_semester_id").val();
        var exam_id = $("#sr_examnames").val();
        if (exam_id) {

            $.post(getMarksByStudent, { token: token, branch_id: branchID, session_id: session_id, semester_id: semester_id, exam_id: exam_id, student_id: ref_user_id, academic_session_id: academic_session_id }, function (res) {
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
            bySubject += '<tr><td colspan="4">No data available</td></tr>';
        }
        $("#student_rank_body").append(bySubject);
    }
    var radar;
    var radarSubjectScore;
    var radarSubjectRank;
    var radarSubjectAvgHighLow;
    callRadarChart();
    function callRadarChart() {
        $.post(getTestScore, {
            token: token,
            branch_id: branchID,
            student_id: ref_user_id,
            academic_session_id: academic_session_id
        }, function (response) {
            if (response.code == 200) {
                // var marks = response.data.marks;
                // var subjects = response.data.subjects;
                var subjects = response.data.headers;
                var marks = response.data.allbyStudent;
                var data = [];
                var label = [];
                if (subjects.length > 0 && marks.length) {
                    subjects.forEach(function (res) {
                        label.push(res.subject_name);
                    });
                    $.each(marks, function (key, value) {
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
                        $.each(value.student_class, function (keys, val) {
                            let mark = parseInt(val.marks);
                            score.push(mark);
                        });
                        obj["data"] = score;
                        data.push(obj);
                    });
                    testScoreAnalysisChart(label, data);
                }
            }
        }, 'json');
        // all exam subject scores
        $.post(allExamSubjectScores, {
            token: token,
            branch_id: branchID,
            student_id: ref_user_id,
            academic_session_id: academic_session_id
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
            student_id: ref_user_id,
            academic_session_id: academic_session_id
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
    function testScoreAnalysisChart(labels, obj) {
        if (radar) {
            radar.data.labels = labels;
            radar.data.datasets = obj;
            radar.update();
        } else {
            var ctx = document.getElementById("radar-chart-test-marks").getContext('2d');
            radar = new Chart(ctx, {
                type: 'radar',
                data: {
                    labels: labels,
                    datasets: obj
                },
            });
        }
    }
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
        if (exam_id) {
            // exam subject mark High Low Avg
            $.post(examSubjectMarkHighLowAvg, {
                token: token,
                branch_id: branchID,
                student_id: ref_user_id,
                academic_session_id: academic_session_id,
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
});