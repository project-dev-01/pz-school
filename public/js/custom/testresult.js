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
            section_id: section_id,
            class_id: class_id
        }, function (res) {
            if (res.code == 200) {
                $.each(res.data, function (key, val) {
                    $("#testresultFilter").find("#subjectID").append('<option value="' + val.subject_id + '">' + val.subject_name + '</option>');
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
    //
    $('#testresultFilter').on('submit', function (e) {
        e.preventDefault();
        var form = this;
        var classRoom = $("#testresultFilter").valid();

        if (classRoom === true) {

            var class_id = $("#changeClassName").val();
            var section_id = $("#sectionID").val();
            var subject_id = $("#subjectID").val();
            var exam_id = $("#examnames").val();
            var tk = exam_id;
            console.log(tk);
            // list mode
            $.get(getSubjectMarks, { token: token, branch_id: branchID, exam_id: exam_id, class_id: class_id, section_id: section_id, subject_id: subject_id }, function (response) {
                if (response.code == 200) {
                    var dataSetNew = response.data;
                    if (response.code == 200) {
                        if (response.data.length > 0) {
                            $(".subjectmarks").show("slow");
                            bindmarks(dataSetNew);
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
        };
    });
    //Score Validation for datatable 
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
                    console.log("------------");
                    console.log(res);
                    if (res.code == 200) {
                        console.log("-----dsf-------");
                        $('.lbl_grade' + incre_class).text(res.data[0].grade);
                        $('.lbl_grade' + incre_class).val(res.data[0].grade);
                        console.log(res.data[0].grade);


                    }
                    else {
                        console.log(res.data);
                    }
                    // $('.lbl_grade' + incre_class).text(res.data[].grade);
                }
            });

        }
    });
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
                    data: 'ranking'
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
                    "className": "table-user text-left",
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
                        var grade = '<label for="grade" class="lbl_grade' + row.student_id + '" data-id="' +row.student_id + '">' + (data != null ? data : "-") + '</label>' +
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
                            '<input type="hidden" class="lbl_ranking" name="subjectmarks[' + meta.row + '][ranking]" value="' + row.ranking + '">';
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
});
