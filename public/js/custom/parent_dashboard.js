$(function () {
    $("#frm_ldate").datepicker({
        dateFormat: 'dd-mm-yy',
        changeMonth: true,
        changeYear: true,
        autoclose: true,
        yearRange: "-100:+50", // last hundred years
        minDate: 0
    });
    $("#to_ldate").datepicker({
        dateFormat: 'dd-mm-yy',
        changeMonth: true,
        changeYear: true,
        autoclose: true,
        yearRange: "-100:+50", // last hundred years
        minDate: 0
    });
    $('.studentRank').on('change', function () {

        var session_id = $("#sr_session_id").val();
        var semester_id = $("#sr_semester_id").val();
        var exam_id = $("#sr_examnames").val();
        if (exam_id) {

            $.post(getMarksByStudent, { token: token, branch_id: branchID, session_id: session_id, semester_id: semester_id, exam_id: exam_id, student_id: studentID, academic_session_id: academic_session_id }, function (res) {
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
            bySubject += '<tr><td colspan="4">'+no_data_available+'</td></tr>';
        }
        $("#student_rank_body").append(bySubject);
    }
    StudentLeave_tabel();
    // Test Score Analysis radar chart start
    var radar;
    var radarSubjectScore;
    var radarSubjectRank;
    var radarSubjectAvgHighLow;
    callRadarChart();
    function callRadarChart() {
        // test score analysis chart
        $.post(getTestScore, {
            token: token,
            branch_id: branchID,
            student_id: studentID,
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
            student_id: studentID,
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
            student_id: studentID,
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
                student_id: studentID,
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
    // reverse dob
    function convertDigitIn(str) {
        return str.split('-').reverse().join('-');
    }
    // jQuery.validator.addMethod("greaterThan",
    //     function (value, element, params) {
    //         console.log(value);
    //         if (!/Invalid|NaN/.test(new Date(value))) {
    //             return new Date(value) >= new Date($(params).val());
    //         }

    //         return isNaN(value) && isNaN($(params).val())
    //             || (Number(value) >= Number($(params).val()));
    //     }, 'Must be greater than leave from.');
    // jQuery.validator.addMethod("greaterThanDt",
    //     function (value, element, params) {

    //         if (!/Invalid|NaN/.test(new Date(value))) {
    //             return new Date(value) > new Date($(params).val());
    //         }

    //         return isNaN(value) && isNaN($(params).val())
    //             || (Number(value) > Number($(params).val()));
    //     }, 'Must be greater than {0}.');

    $("#stdGeneralDetails").validate({
        rules: {
            changeStdName: "required",
            to_ldate: "required",
            frm_ldate: "required",
            changelevReasons: "required"
        }
    });

    $('#stdGeneralDetails').on('submit', function (e) {
        e.preventDefault();
        var start = convertDigitIn($("#frm_ldate").val());
        var end = convertDigitIn($("#to_ldate").val());
        let startDate = new Date(start);
        let endDate = new Date(end);
        if (startDate > endDate) {
            toastr.error("To date should be greater than leave from");
            $("to_ldate").val("");
            return false;
        }
        var std_details = $("#stdGeneralDetails").valid();

        if (std_details === true) {
            var form = this;
            var class_id = $('option:selected', '#changeStdName').attr('data-classid');
            var section_id = $('option:selected', '#changeStdName').attr('data-sectionid');
            var student_id = $("#changeStdName").val();
            var frm_leavedate = $("#frm_ldate").val();
            var to_leavedate = $("#to_ldate").val();
            var reason = $("#changelevReasons").val();
            var reason_text = $('option:selected', '#changelevReasons').text();
            var remarks = $("#remarks").val();
            // var file = $("#file").val();

            var formData = new FormData();
            formData.append('token', token);
            formData.append('branch_id', branchID);
            formData.append('class_id', class_id);
            formData.append('section_id', section_id);
            formData.append('student_id', student_id);
            formData.append('frm_leavedate', frm_leavedate);
            formData.append('to_leavedate', to_leavedate);
            formData.append('reason', reason);
            formData.append('reason_text', reason_text);
            formData.append('remarks', remarks);
            // formData.append('file', file);
            formData.append('file', $('input[type=file]')[0].files[0]);

            $("#listModeClassID").val(class_id);
            $("#listModeSectionID").val(section_id);
            $("#listModestudentID").val(student_id);
            $("#listModereason").val(reason);
            $("#listModereasontext").val(reason_text);
            //
            $.ajax({
                url: $(form).attr('action'),
                method: $(form).attr('method'),
                data: formData,
                processData: false,
                dataType: 'json',
                contentType: false,
                success: function (response) {
                    if (response.code == 200) {
                        $('#studentleave-table').DataTable().ajax.reload(null, false);
                        toastr.success('Leave apply sucessfully');
                        $('#stdGeneralDetails')[0].reset();

                        // $("#changeStdName").val('');
                        // $("#frm_ldate").val('');
                        // $("#to_ldate").val('');
                        // $("#message").val('');
                        // $("#post_ldate").val('');
                        // $("#remarks").val();
                        $("#file_name").html("");
                    } else {
                        toastr.error(response.message);
                    }
                }
            });
        };
    });
    // student leaves details
    // $('#changelevReasons').on('change', function () {
    //     var Reasons = $("#changelevReasons").val();
    //     if (Reasons == 3) {
    //         $("#remarks_div").show();
    //     }
    //     else {
    //         $("#remarks_div").hide();
    //     }

    // });
    $('#homework_file').change(function () {
        // var i = $(this).prev('label').clone();
        var file = $('#homework_file')[0].files[0].name;
        $('#file_name').html(file);
    });

    $(".datepick").datepicker({
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
        autoclose: true,
        yearRange: "-100:+50", // last hundred years
    });
    // get student leave apply
    function StudentLeave_tabel() {
        $('#studentleave-table').DataTable({
            processing: true,
            bDestroy: true,
            info: true,
            // dom: 'lBfrtip',
            dom: "<'row'<'col-sm-2'l><'col-sm-2'B><'col-sm-8'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            "language": {
                
                "emptyTable": no_data_available,
                "infoFiltered": filter_from_total_entries,
                "zeroRecords": no_matching_records_found,
                "infoEmpty": showing_zero_entries,
                
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
                    exportOptions: {
                        columns: 'th:not(:last-child)'
                    }
                }
            ],
            ajax: stutdentleaveList,
            "pageLength": 5,
            "aLengthMenu": [
                [5, 10, 25, 50, -1],
                [5, 10, 25, 50, "All"]
            ],
            columns: [
                {
                    "targets": 0,
                    "render": function (data, type, row, meta) {
                        return meta.row + 1;
                    }
                }
                ,
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
                    data: 'teacher_remarks',
                    name: 'teacher_remarks'
                },
                {
                    data: 'reason',
                    name: 'reason'
                },
                {
                    data: 'document',
                    name: 'document'
                },
                {
                    data: 'status',
                    name: 'status',
                },
                {
                    data: 'created_at',
                    name: 'created_at',
                },
                {
                    data: 'actions',
                    name: 'actions',
                    orderable: false,
                    searchable: false
                },
            ],
            columnDefs: [
                // {
                //     "targets": 6,
                //     "render": function (data, type, row, meta) {
                //         if (row.status != "Approve") {
                //             var fileUpload = '<div>' +
                //                 '<input type="file" id="reissue_file' + row.id + '" name="file">' +
                //                 '</div>';
                //         } else {
                //             fileUpload = "<p style='text-align: center;''>-</p>";
                //         }

                //         return fileUpload;
                //     }
                // },
                {
                    "targets": 4,
                    "render": function (data, type, row, meta) {
                        var document = "";
                        if (data && data != "null") {
                            document = data;
                        } else {
                            document = '';
                        }
                        return document;
                    }
                },
                {
                    "targets": 6,
                    "render": function (data, type, row, meta) {
                        var document = "";
                        if (data) {
                            document = '<a href="' + StudentDocUrl + '/' + data + '" download ><i class="fas fa-cloud-download-alt" data-toggle="tooltip" title="Click to download..!"></i></a>';
                        } else {
                            document = '<div>' +
                                '<input type="file" id="reissue_file' + row.id + '" name="file">' +
                                '</div>';
                        }
                        return document;
                    }
                },
                {
                    "targets": 7,
                    "render": function (data, type, row, meta) {
                        var badgeColor = "";
                        if (data == "Approve") {
                            badgeColor = "badge-success";
                        }
                        if (data == "Reject") {
                            badgeColor = "badge-danger";
                        }
                        if (data == "Pending") {
                            badgeColor = "badge-warning";
                        }
                        var status = '<span class="badge ' + badgeColor + ' badge-pill">' + data + '</span>';
                        return status;
                    }
                },
                {
                    "targets": 9,
                    "render": function (data, type, row, meta) {
                        if (row.document) {
                            return '-';
                        } else {
                            return '<div class="button-list"><a href="javascript:void(0)" class="btn btn-primary-bl waves-effect waves-light" data-id="' + row.id + '"  data-document="' + row.document + '" id="updateIssueFile">'+upload_lang+'</a></div>';
                        }
                    }
                },

            ]
        }).on('draw', function () {
        });
    }
    // updateIssueFile
    $(document).on('click', '#updateIssueFile', function () {
        var id = $(this).data('id');
        var document = $(this).data('document');

        var reissue_file = $("#reissue_file" + id)[0].files[0];
        // formData.append('file', $('input[type=file]')[0].files[0]);
        // return false;
        var formData = new FormData();
        formData.append('id', id);
        formData.append('document', document);
        formData.append('file', reissue_file);
        $.ajax({
            url: reuploadFileUrl,
            method: "post",
            data: formData,
            processData: false,
            dataType: 'json',
            contentType: false,
            success: function (res) {
                if (res.code == 200) {
                    // $('#studentleave-table').DataTable().ajax.reload(null, false);
                    StudentLeave_tabel();
                    toastr.success(res.message);
                }
                else {
                    toastr.error(res.message);
                }
            }
        });
    });

});