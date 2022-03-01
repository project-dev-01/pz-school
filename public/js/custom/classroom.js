$(function () {

    var listTable;

    $("#classDate").datepicker({
        dateFormat: 'dd-mm-yy',
        changeMonth: true,
        changeYear: true,
        autoclose: true,
    });
    // reverse dob
    function convertDigitIn(str) {
        return str.split('-').reverse().join('-');
    }
    // change classroom
    $('#changeClassName').on('change', function () {
        var class_id = $(this).val();
        $("#classroomFilter").find("#sectionID").empty();
        $("#classroomFilter").find("#sectionID").append('<option value="">Select Section</option>');
        $("#classroomFilter").find("#subjectID").empty();
        $("#classroomFilter").find("#subjectID").append('<option value="">Select Subject</option>');

        $.post(teacherSectionUrl, { token: token, branch_id: branchID, teacher_id: userID, class_id: class_id }, function (res) {
            if (res.code == 200) {
                $.each(res.data, function (key, val) {
                    $("#classroomFilter").find("#sectionID").append('<option value="' + val.section_id + '">' + val.section_name + '</option>');
                });
            }
        }, 'json');
    });
    // change section
    $('#sectionID').on('change', function () {
        var section_id = $(this).val();
        var class_id = $("#changeClassName").val();
        $("#classroomFilter").find("#subjectID").empty();
        $("#classroomFilter").find("#subjectID").append('<option value="">Select Subject</option>');
        $.post(teacherSubjectUrl, {
            token: token,
            branch_id: branchID,
            teacher_id: userID,
            class_id: class_id,
            section_id: section_id,
            class_id: class_id
        }, function (res) {
            if (res.code == 200) {
                $.each(res.data, function (key, val) {
                    $("#classroomFilter").find("#subjectID").append('<option value="' + val.subject_id + '">' + val.subject_name + '</option>');
                });
            }
        }, 'json');
    });

    // applyFilter
    // rules validation
    $("#classroomFilter").validate({
        rules: {
            class_id: "required",
            section_id: "required",
            subject_id: "required",
            class_date: "required"
        }
    });
    //
    $('#classroomFilter').on('submit', function (e) {
        e.preventDefault();
        var classRoom = $("#classroomFilter").valid();
        if (classRoom === true) {

            var classID = $("#changeClassName").val();
            var sectionID = $("#sectionID").val();
            var subjectID = $("#subjectID").val();
            var classDate = $("#classDate").val();

            var formData = new FormData();
            formData.append('token', token);
            formData.append('branch_id', branchID);
            formData.append('class_id', classID);
            formData.append('section_id', sectionID);
            formData.append('subject_id', subjectID);
            formData.append('date', convertDigitIn(classDate));
            $.ajax({
                url: getStudentAttendance,
                method: "post",
                data: formData,
                processData: false,
                dataType: 'json',
                contentType: false,
                success: function (response) {

                    var dataSetNew = response.data;

                    if (response.code == 200) {
                        $('#layoutModeGrid').empty();
                        var layoutModeGrid = "";
                        if (response.data.length > 0) {

                            layoutModeGrid += '<div class="row">';
                            response.data.forEach(function (res) {

                                // layout mode div start
                                layoutModeGrid += layoutMode(res);
                                // layout mode div end
                                // list mode start
                                listMode(dataSetNew);
                                $("#listModeClassID").val(classID);
                                $("#listModeSectionID").val(sectionID);
                                $("#listModeSubjectID").val(subjectID);
                                $("#listModeSelectedDate").val(convertDigitIn(classDate));
                                // list mode end
                            });
                            layoutModeGrid += '</div>';
                        }

                        $("#layoutModeGrid").append(layoutModeGrid);
                    } else {
                        toastr.error(data.message);
                    }
                }
            });
        }
    });

    // function layout mode
    function layoutMode(res) {
        var layoutModeGrid = "";
        var bgColor = "#60a05b";
        layoutModeGrid += '<div class="col-md-3">' +
            '<div class="card">';
        if (res.att_status == "present") {
            bgColor = "#60a05b";
        }
        if (res.att_status == "absent") {
            bgColor = "#de354f";
        }
        if (res.att_status == "late") {
            bgColor = "#358fde";
        }
        layoutModeGrid += '<div class="card-header" style="background-color:' + bgColor + ';color:white;text-align:left">';
        layoutModeGrid += '<img src="' + defaultImg + '" class="mr-2 rounded-circle" height="40" />' +
            '<label style="text-align:center">' + res.first_name + ' ' + res.last_name + '</label>' +
            '</div>' +
            '</div>' +
            '</div>';
        return layoutModeGrid;
    }
    // function list mode
    function listMode(dataSetNew) {
        listTable = $('#listModeClassRoom').DataTable({
            processing: true,
            bDestroy: true,
            info: true,
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
                    data: 'att_status'
                },
                {
                    data: 'att_remark'
                },
                {
                    data: 'reasons'
                },
                {
                    data: 'student_behaviour'
                },
                {
                    data: 'classroom_behaviour'
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
                    "width": "15%",
                    "className": "table-user",
                    "render": function (data, type, row, meta) {
                        var first_name = '<input type="hidden" name="attendance[' + meta.row + '][attendance_id]" value="' + row.att_id + '">' +
                            '<input type="hidden" name="attendance[' + meta.row + '][student_id]" value="' + row.student_id + '">' +
                            '<input type="hidden" name="attendance[' + meta.row + '][first_name]" value="' + row.first_name + '">' +
                            '<input type="hidden" name="attendance[' + meta.row + '][last_name]" value="' + row.last_name + '">' +
                            '<img src="' + defaultImg + '" class="mr-2 rounded-circle">' +
                            '<a href="javascript:void(0);" class="text-body font-weight-semibold">' + data + '</a>';
                        return first_name;
                    }
                },
                {
                    "targets": 2,
                    "width": "20%",
                    "render": function (data, type, row, meta) {
                        row.att_status
                        var att_status = '<select class="form-control changeAttendanceSelect" data-style="btn-outline-success" name="attendance[' + meta.row + '][att_status]">' +
                            '<option value="">Choose</option>' +
                            '<option value="present" ' + (row.att_status == "present" ? "selected" : "") + '>Present</option>' +
                            '<option value="absent" ' + (row.att_status == "absent" ? "selected" : "") + '>Absent</option>' +
                            '<option value="late" ' + (row.att_status == "late" ? "selected" : "") + '>Late</option>' +
                            '<option value="excused" ' + (row.att_status == "excused" ? "selected" : "") + '>Excused</option>' +
                            '</select>';



                        return att_status;
                    }
                },
                {
                    "targets": 3,
                    "width": "10%",
                    "render": function (data, type, row, meta) {

                        var att_remark = '<textarea style="display:none;" class="addRemarks" data-id="' + row.student_id + '" id="addRemarks' + row.student_id + '" name="attendance[' + meta.row + '][att_remark]">' + row.att_remark + '</textarea>' +
                            '<button type="button" data-id="' + row.student_id + '" class="btn btn-outline-info waves-effect waves-light" data-toggle="modal" data-target="#stuRemarksPopup" id="editRemarksStudent">Add Remarks</button>';
                        return att_remark;
                    }
                },
                {
                    "targets": 4,
                    "width": "15%",
                    "render": function (data, type, row, meta) {
                        var reasons = '<select id="reasons" class="form-control" name="attendance[' + meta.row + '][reasons]">' +
                            '<option value="">Choose</option>' +
                            '<option value="fever" ' + (row.reasons == "fever" ? "selected" : "") + '>Fever</option>' +
                            '<option value="breakdown" ' + (row.reasons == "breakdown" ? "selected" : "") + '>Bus Breakdown</option>' +
                            '<option value="book_missing" ' + (row.reasons == "book_missing" ? "selected" : "") + '>Book Missing</option>' +
                            '<option value="others" ' + (row.reasons == "others" ? "selected" : "") + '>Others</option>' +
                            '</select>';
                        return reasons;
                    }
                },
                {
                    "targets": 5,
                    "width": "10%",
                    "render": function (data, type, row, meta) {
                        var student_behaviour = '<span class="star-rating star-5">' +
                            '<input type="radio" name="attendance[' + meta.row + '][student_behaviour]" ' + (row.student_behaviour == "1" ? "checked" : "") + ' value="1"><i></i>' +
                            '<input type="radio" name="attendance[' + meta.row + '][student_behaviour]" ' + (row.student_behaviour == "2" ? "checked" : "") + ' value="2"><i></i>' +
                            '<input type="radio" name="attendance[' + meta.row + '][student_behaviour]" ' + (row.student_behaviour == "3" ? "checked" : "") + ' value="3"><i></i>' +
                            '<input type="radio" name="attendance[' + meta.row + '][student_behaviour]" ' + (row.student_behaviour == "4" ? "checked" : "") + ' value="4"><i></i>' +
                            '<input type="radio" name="attendance[' + meta.row + '][student_behaviour]" ' + (row.student_behaviour == "5" ? "checked" : "") + ' value="5"><i></i>' +
                            '</span>';
                        return student_behaviour;
                    }
                },
                {
                    "targets": 6,
                    "width": "10%",
                    "render": function (data, type, row, meta) {

                        var classroom_behaviour = '<label>' +
                            '<input type="radio" value="likes" ' + (row.classroom_behaviour == "likes" ? "checked" : "") + ' name="attendance[' + meta.row + '][classroom_behaviour]">' +
                            '<i class="far fa-thumbs-up" style="font-size:20px;color:blue"></i>' +
                            '</label>' +
                            '<label>' +
                            '<input type="radio" value="dislikes" ' + (row.classroom_behaviour == "dislikes" ? "checked" : "") + ' name="attendance[' + meta.row + '][classroom_behaviour]">' +
                            '<i class="far fa-thumbs-down" style="font-size:20px;color:blue"></i>' +
                            '</label>';


                        return classroom_behaviour;
                    }
                }
            ]
        }).on('draw', function () {
        });
    }
    //
    $('#addformdata').on('submit', function (e) {
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
                if (response.code == 200) {
                    toastr.success(response.message);
                    $('#layoutModeGrid').empty();
                    var layoutModeGrid = "";
                    if (response.data.length > 0) {

                        layoutModeGrid += '<div class="row">';
                        response.data.forEach(function (res) {

                            // layout mode div start
                            layoutModeGrid += layoutMode(res);
                            // layout mode div end
                        });
                        layoutModeGrid += '</div>';
                    }

                    $("#layoutModeGrid").append(layoutModeGrid);
                } else {
                    toastr.error(data.message);
                }
            }
        });
    });

    // add remarks model
    $('#stuRemarksPopup').on('show.bs.modal', e => {
        $("#student_remarks").focus();
        var $button = $(e.relatedTarget);
        var studentID = $button.attr('data-id');
        var studentRemarks = $button.closest('td').find('textarea').val();
        $("#studenetID").val(studentID);
        $("#student_remarks").val(studentRemarks);
    });
    // save studentRemarksSave
    $('#studentRemarksSave').on('click', function () {
        var studenetID = $('#studenetID').val();
        var student_remarks = $('#student_remarks').val();
        $('#addRemarks' + studenetID).val(student_remarks);
        $('#stuRemarksPopup').modal('hide');
    });
    $('#changeAttendance').on('change', function () {
        $(".changeAttendanceSelect").val($(this).val());
    });
});