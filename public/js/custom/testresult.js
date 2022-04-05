$(function () {

    // change classroom
    $('#changeClassName').on('change', function () {
        // $(".classRoomHideSHow").hide();
        var class_id = $(this).val();
        $("#testresultFilter").find("#sectionID").empty();
        $("#testresultFilter").find("#sectionID").append('<option value="">Select Section</option>');
        $("#testresultFilter").find("#subjectID").empty();
        $("#testresultFilter").find("#subjectID").append('<option value="">Select Subject</option>');

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
        $("#testresultFilter").find("#subjectID").empty();
        $("#testresultFilter").find("#subjectID").append('<option value="">Select Subject</option>');
        $.post(teacherSubjectUrl, {
            token: token,
            branch_id: branchID,
            teacher_id: ref_user_id,
            class_id: class_id,
            section_id: section_id
        }, function (res) {
            if (res.code == 200) {
                $.each(res.data, function (key, val) {
                    $("#testresultFilter").find("#subjectID").append('<option value="' + val.subject_id + '">' + val.subject_name + '</option>');
                });
            }
        }, 'json');
    });
    // change subject
    $('#subjectID').on('change', function () {
        var subject_id = $(this).val();
        var section_id = $("#sectionID").val();
        var class_id = $("#changeClassName").val();
        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
        var yyyy = today.getFullYear();

        today = yyyy + '/' + mm + '/' + dd;
        $("#testresultFilter").find("#examnames").empty();
        $("#testresultFilter").find("#examnames").append('<option value="">Select Exams</option>');
        $.get(examsList, {
            token: token,
            branch_id: branchID,
            class_id: class_id,
            section_id: section_id,
            subject_id: subject_id,
            today:today
        }, function (res) {
            if (res.code == 200) {
                console.log(res.data);
                $.each(res.data, function (key, val) {
                    var marks = JSON.parse(val.marks);
                    $("#testresultFilter").find("#examnames").append('<option value="' + val.id + '" data-full="'+marks.full+'" data-pass="'+marks.pass+'">' + val.name + '</option>');
                    
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
        
        var fmark = $('option:selected', '#examnames').attr('data-full');
        var pmark = $('option:selected', '#examnames').attr('data-pass');
        $("#fullmark").val(fmark);
        $("#passmark").val(pmark);
        
        if (classRoom === true) {

            var class_id = $("#changeClassName").val();
            var section_id = $("#sectionID").val();
            var subject_id = $("#subjectID").val();
            var exam_id = $("#examnames").val();

            var formData = new FormData();
            formData.append('token', token);
            formData.append('branch_id', branchID);
            formData.append('class_id', class_id);
            formData.append('section_id', section_id);
            formData.append('subject_id', subject_id);

            // list mode
            $.get(getSubjectMarks, { token: token, branch_id: branchID, exam_id: exam_id, class_id: class_id, section_id: section_id, subject_id: subject_id }, function (response) {
                if (response.code == 200) {
                    var dataSetNew = response.data;
                    if (response.code == 200) {
                        if (response.data.length > 0) {
                            $(".subjectmarks").show("slow");
                            bindmarks(dataSetNew);
                            $("#testexecution").hide();
                            $("#listModeClassID").val(class_id);
                            $("#listModeSectionID").val(section_id);
                            $("#listModeSubjectID").val(subject_id);
                            $("#listModeexamID").val(exam_id);
                            console.log('end');
                        } else {
                            $(".subjectmarks").hide();
                            toastr.info('No records are available');
                        }

                        //$("#layoutModeGrid").append(layoutModeGrid);
                    } else {
                        toastr.error(data.message);
                    }
                }
            });
            // subject division
            $.ajax({
                url: getsubjectdivision,
                method: "post",
                data: formData,
                processData: false,
                dataType: 'json',
                contentType: false,
                success: function (response) {
                    if (response.code == 200) {
                        var stdetails = response.data.studentdetails;
                        var subdiv = response.data.subjectdivision;
                        console.log(stdetails.length);
                        if (subdiv.length > 0) {
                            $('#subjectdivTableAppend').show();
                            subjectdivisionShow(stdetails, subdiv);
                            $("#testexecution").show();
                        }
                        else {
                            $('#subjectdivTableAppend').hide();
                        }
                    } else {
                        toastr.error(data.message);
                    }
                }
            });
        };
    });

    //Score base grade details bind
    $(document).on("change", ".basevalidation", function (e) {
        e.preventDefault();
        console.log('enter');
        var marks_range = $(this).val();  
        if (marks_range != '') {
            var incre_class = $(this).attr('id');
            console.log(incre_class)
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
                    console.log(res);
                    if (res.code == 200) {                    
                        $('.lbl_grade' + incre_class).text(res.data[0].grade);
                        $('.lbl_grade' + incre_class).val(res.data[0].grade);
                        console.log(res.data[0].grade);
                    }
                    else {
                        console.log(res.data);
                    }             
                }
            });

        }
    });
    // Add student marks and update also
    $('#addstudentmarks').on('submit', function (e) {
        e.preventDefault();
        var form = this;
        $.ajax({
            url: $(form).attr('action'),
            method: $(form).attr('method'),
            data: new FormData(form),
            processData: false,
            dataType: 'json',
            contentType: false,
            success: function (response) {
                console.log(response);
                if (response.code == 200) {
                    toastr.success(response.message);
                    console.log(response.message);
                }
                else {
                    toastr.error(data.message);
                }
            }
        });
    });
    //subject division cut off value calculation
    $(document).on("change", ".cutoff", function (e) {
        e.preventDefault();
        console.log('cutoffenter');
        var get_value = $(this).val();


        var current_textbox_id = $(this).attr('id');
        var credit_point = $(this).attr('data-id');
        var studentid = $(this).attr('data-ref-studentid');
        var current_total_score = $(".tot_score" + studentid).html();


        var cutoff_value = get_value * credit_point;
        var sumoff = parseFloat(cutoff_value) + parseFloat(current_total_score);
        // var dec = parseFloat(cutoff_value, 10).toFixed(2);
        // $("#" + current_textbox_id).val(dec);


        var dec_sumoff = parseFloat(sumoff, 10).toFixed(0);
        $(".tot_score" + studentid).html(dec_sumoff);
        subject_division_cutoff_grade(dec_sumoff, studentid);

    });
    //subject division base grade details bind
    function subject_division_cutoff_grade(marks_range, studentid) {

        console.log(marks_range, studentid);

        if (marks_range != '') {
            var incre_class = $(this).attr('id');
            console.log(incre_class)
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
                    console.log(res);
                    if (res.code == 200) {   
                        $(".lbl_grade" + studentid).text(res.data[0].grade);
                        $('.lbl_grade' + studentid).val(res.data[0].grade);
                        console.log(res.data[0].grade);
                    }
                    else {
                        console.log(res.data);
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
        var shortTestTable = "";
        var index = 0;
        shortTestTable += '<div class="table-responsive">' +
            '<table class="table table-striped table-nowrap">' +
            '<thead>' +
            '<tr>' +
            '<th>S.no</th>' +
            '<th>Student Name</th>';
        $.each(subdiv, function (key, val) {
            index++;
            // table add
            shortTestTable += '<th>' + val.subject_division + "(" + val.credit_point + ")" + '</th>';

        });
        shortTestTable += '<th>Total Score</th>';
        shortTestTable += '<th>Grade</th>';
        shortTestTable += '<th>Ranking</th>';
        shortTestTable += '</tr>' +
            '</thead>' +
            '<tbody>';
        var start = 0;
        var indexStart = 0;

        if (stdetails.length > 0) {
            stdetails.forEach(function (res) {
                start++;
                // short test table div start
                shortTestTable += '<tr>' +
                    '<td>';
                if (start == 1) {
                    shortTestTable += '<input type="hidden" name="date" value="' + classID + '">' +
                        '<input type="hidden" name="section_id" value="' + sectionID + '">' +
                        '<input type="hidden" name="subject_id" value="' + subjectID + '">';

                }
                shortTestTable += start +
                    '</td>' +
                    '<td class="table-user">' +
                    '<img src="' + defaultImg + '" class="mr-2 rounded-circle">' +
                    '<a href="javascript:void(0);" class="text-body font-weight-semibold">' + res.first_name + ' ' + res.last_name + '</a>' +
                    '</td>';
                $.each(subdiv, function (key, val) {
                    shortTestTable += '<td>' +
                        '<input type="text" id="' + val.subject_division + start + '" data-ref-studentid="' + res.student_id + '" data-id="' + val.credit_point + '" class="form-control cutoff" style="width:100px;">' +

                        '</td>';
                });
                shortTestTable += '<td>' +
                    '<label for="tot_score" class="tot_score' + res.student_id + '" data-id="' + res.student_id + '">0</label>' +
                    '</td>';
                shortTestTable += '<td>' +
                    '<label for="grade" class="lbl_grade' + res.student_id + '" data-id="' + res.student_id + '">-</label>' +
                    '</td>';
                shortTestTable += '<td>' +
                    '<label for="ranking" class="lbl_ranking" data-id="">0</label>' +
                    '</td>';
                // short test table div end
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

                //     shortTestTable += '<td>' +
                //         '<input type="hidden" name="short_test[' + indexStart + '][student_id]" value="' + res.student_id + '">' +
                //         '<input type="hidden" name="short_test[' + indexStart + '][test_name][]" value="' + val.test_name + '">' +
                //         '<input type="hidden" name="short_test[' + indexStart + '][grade_status][]" value="' + val.status + '">' +
                //         '<input type="text" name="short_test[' + indexStart + '][test_marks][]" value="' + marks + '" class="form-control" style="width:100px;">' +
                //         '</td>';
                // });
                indexStart++;
                shortTestTable += '</tr>';
            });
        }

        shortTestTable += '</tbody>' +
            '</table></div>';
        $("#subjectdivTableAppend_text").append(shortTestTable);
    }
    // function list mode
    function bindmarks(dataSetNew) {
        listTable = $('#stdmarks').DataTable({
            processing: true,
            bDestroy: true,
            info: true,
            data: dataSetNew,
            "pageLength": 10,
            "aLengthMenu": [
                [5, 10, 25, 50, -1],
                [5, 10, 25, 50, "All"]
            ],
            buttons: [
                {
                    text: 'Run',
                    action: function (e, dt, node, config) {
                        plainArray = listTable.rows({ search: 'applied' }).data().toArray();
                        for (var x = 0; x < plainArray.length; x++) {
                            console.log(plainArray[x]);
                        }
                    }
                }
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
                    data: 'rank_place'
                },
                {
                    data: 'memo'
                }
            ],
            columnDefs: [
                {
                    "targets": 0,
                    "width": "10%",
                    "render": function (data, type, row) {
                        if (!data) {
                            return '-';
                        } else {
                            var restaurant_id = data;
                            return restaurant_id;
                        }
                    }
                },
                {
                    "targets": 1,
                    "width": "20%",
                    "className": "table-user text-left tdcolor",
                    "render": function (data, type, row, meta) {
                        var first_name = '<input type="hidden" name="subjectmarks[' + meta.row + '][studentmarks_tbl_pk_id]" value="' + row.att_id + '">' +
                            '<input type="hidden" name="subjectmarks[' + meta.row + '][student_id]" value="' + row.student_id + '">' +
                            '<input type="hidden" name="subjectmarks[' + meta.row + '][first_name]" value="' + row.first_name + '">' +
                            '<input type="hidden" name="subjectmarks[' + meta.row + '][last_name]" value="' + row.last_name + '">' +
                            '<img src="' + defaultImg + '" class="mr-2 rounded-circle">' +
                            '<a href="javascript:void(0);" class="text-body font-weight-semibold">' + data + '</a>';
                        return first_name;
                    }
                },
                {
                    "targets": 2,
                    "width": "10%",
                    "className": "text-center",
                    "render": function (data, type, row, meta) {
                        var score = '<input type="text" maxlength="3" class="form-control basevalidation" name="subjectmarks[' + meta.row + '][score]" id="' + row.student_id + '" value="' + (data != null ? data : "0") + '">';

                        return score;
                    }
                },
                {
                    "targets": 3,
                    "width": "15%",
                    "className": "text-center",
                    "render": function (data, type, row, meta) {
                        var grade = '<label for="grade" class="lbl_grade' + row.student_id + ' tt-color02 tt-badge" data-id="' + row.student_id + '">' + (data != null ? data : "-") + '</label>' +
                            '<input type="hidden" class="lbl_grade' + row.student_id + '" name="subjectmarks[' + meta.row + '][grade]" value="' + (data != null ? data : "-") + '">';
                        return grade;
                    }
                },
                {
                    "targets": 4,
                    "width": "15%",
                    "className": "text-center",
                    "render": function (data, type, row, meta) {

                        var ranking = '<label for="ranking" class="lbl_ranking">' + (data != null ? data : "0") + '</label>' +
                            '<input type="hidden" class="lbl_ranking" name="subjectmarks[' + meta.row + '][ranking]" value="' + row.rank_place + '">';
                        return ranking;
                    }
                },
                {
                    "targets": 5,
                    "width": "30%",
                    "className": "text-center",
                    "render": function (data, type, row, meta) {
                        var memo = '<input type="text" maxlength="45" class="form-control" name="subjectmarks[' + meta.row + '][memo]" id="' + row.student_id + '" class="form-control" value="' + (data != null ? data : "") + '">';
                        return memo;
                    }
                }
            ]
        }).on('draw', function () {
        });
    }
    function trcolorchange()
    {
        console.log('color');
        tables = $('#stdmarks').DataTable({
            "createdRow": function( row, data, dataIndex ) {
                     if ( data[2] == "30" ) {        
                 $(row).addClass('red');             
               }             
        
            }
          });
    }
});
