$(function () {
    // change 
    $('#changeClassName').on('change', function () {
        var class_id = $(this).val();
        $("#promotionFilter").find("#sectionID").empty();
        $("#promotionFilter").find("#sectionID").append('<option value="">Select Class</option>');
        $.post(teacherSectionUrl, { token: token, branch_id: branchID, teacher_id: ref_user_id, class_id: class_id }, function (res) {
            if (res.code == 200) {
                $.each(res.data, function (key, val) {
                    $("#promotionFilter").find("#sectionID").append('<option value="' + val.section_id + '">' + val.section_name + '</option>');
                });
            }
        }, 'json');
    });
    // change 
    $('#promoteClassID').on('change', function () {
        var class_id = $(this).val();
        $("#promoteStudentForm").find("#promoteSectionID").empty();
        $("#promoteStudentForm").find("#promoteSectionID").append('<option value="">Select Class</option>');
        $.post(teacherSectionUrl, { token: token, branch_id: branchID, teacher_id: ref_user_id, class_id: class_id }, function (res) {
            if (res.code == 200) {
                $.each(res.data, function (key, val) {
                    $("#promoteStudentForm").find("#promoteSectionID").append('<option value="' + val.section_id + '">' + val.section_name + '</option>');
                });
            }
        }, 'json');
    });
    // rules validation
    $("#promotionFilter").validate({
        rules: {
            year: "required",
            class_id: "required",
            section_id: "required",
            session_id: "required",
            semester_id: "required"
        }
    });
    $('#promotionFilter').on('submit', function (e) {
        e.preventDefault();
        var form = this;
        var promValid = $("#promotionFilter").valid();
        if (promValid === true) {

            var class_id = $("#changeClassName").val();
            var section_id = $("#sectionID").val();
            var semester_id = $("#semester_id").val();
            var session_id = $("#session_id").val();
            var btwyears = $("#btwyears").val();
            var formData = new FormData();
            formData.append('token', token);
            formData.append('branch_id', branchID);
            formData.append('class_id', class_id);
            formData.append('section_id', section_id);
            formData.append('semester_id', semester_id);
            formData.append('session_id', session_id);
            formData.append('academic_session_id', btwyears);
            $("#overlay").fadeIn(300);
            $.ajax({
                url: getStudentListByClassSectionUrl,
                method: "post",
                data: formData,
                processData: false,
                dataType: 'json',
                contentType: false,
                success: function (response) {
                    if (response.code == 200) {
                        var dataSetNew = response.data;
                        if (dataSetNew.length > 0) {
                            $("#show_promotion_details").show();
                            bindStudents(dataSetNew);
                        } else {
                            toastr.error('No students available');
                            $("#show_promotion_details").hide();
                        }
                        $("#overlay").fadeOut(300);
                    } else {
                        $("#show_promotion_details").hide();
                        $("#overlay").fadeOut(300);
                        toastr.error(response.message);
                    }
                }, error: function (err) {
                    $("#show_promotion_details").hide();
                    $("#overlay").fadeOut(300);
                    toastr.error(err.responseJSON.data.error ? err.responseJSON.data.error : 'Something went wrong');
                }
            });
        };
    });
    // rules validation
    $("#promoteStudentForm").validate({
        rules: {
            promote_year: "required",
            promote_class_id: "required",
            promote_section_id: "required",
            promote_semester_id: "required",
            promote_session_id: "required",
        }
    });
    // promote students
    $('#promoteStudentForm').on('submit', function (e) {
        e.preventDefault();
        var form = this;
        // $('#saveClassRoomAttendance').prop('disabled', true);
        var promotionValid = $("#promoteStudentForm").valid();
        if (promotionValid === true) {
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
                    } else {
                        toastr.error(response.message);
                    }
                }
            });
        }
    });

});

// function list mode
function bindStudents(dataSetNew) {
    // reset form
    $('#promoteStudentForm')[0].reset();
    
    listTable = $('#showStudentDetails').DataTable({
        processing: true,
        bDestroy: true,
        info: true,
        dom: 'lrt',
        paging: false,
        searching: false,
        data: dataSetNew,
        columns: [
            {
                searchable: false,
                data: 'DT_RowIndex',
                name: 'DT_RowIndex'
            },
            {
                data: 'name'
            },
            {
                data: 'register_no'
            },
            {
                data: 'student_id'
            }
        ],
        columnDefs: [
            { "bSortable": false, "aTargets": [0, 1, 2, 3] },
            {
                "targets": 0,
                "render": function (data, type, row, meta) {
                    return meta.row + 1;
                }
            },
            {
                "targets": 1,
                "className": "table-user",
                "render": function (data, type, row, meta) {
                    if (row.photo) {
                        var currentImg = parentImg + '/' + row.photo;
                    } else {
                        var currentImg = defaultImg;
                    }
                    var first_name = '<img src="' + currentImg + '" class="mr-2 rounded-circle" alt="No Image">' +
                        '<a href="javascript:void(0);" class="text-body font-weight-semibold">' + data + '</a>';
                    return first_name;
                }
            },
            {
                "targets": 3,
                "render": function (data, type, row, meta) {
                    var promote = '<div class="switchery-demo">' +
                        '<input type="hidden" name="promotion[' + meta.row + '][student_id]" value="' + row.student_id + '">' +
                        '<input type="hidden" name="promotion[' + meta.row + '][register_no]" value="' + row.register_no + '">' +
                        '<input type="hidden" name="promotion[' + meta.row + '][roll_no]" value="' + row.roll_no + '">' +
                        '<input type="checkbox" disabled name="promotion[' + meta.row + '][promotion_status]" checked data-plugin="switchery" data-color="#039cfd" />' +
                        '</div>';
                    return promote;
                }
            }
        ]
    }).on('draw', function () {
    });
}