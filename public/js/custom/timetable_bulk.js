$(function () {

    // function selectRefresh() {
    //     console.log("sdsd")
    //     $('.main .select2-multiple').select2({
    //         //-^^^^^^^^--- update here
    //         tags: true,
    //         placeholder: "Select an Option",
    //         allowClear: true,
    //         width: '100%'
    //     });
    // }
    // $('.select2-multiple').select2();
    $('.select2-multiple-plus').select2();
    // add timetable
    $('#addTimetableForm').on('submit', function (e) {
        e.preventDefault();
        $("#overlay").fadeIn(300);
        var form = this;
        $.ajax({
            url: $(form).attr('action'),
            method: $(form).attr('method'),
            data: new FormData(form),
            processData: false,
            dataType: 'json',
            contentType: false,
            success: function (data) {
                if (data.code == 200) {
                    $('.addTimetableForm').find('form')[0].reset();
                    toastr.success(data.message);
                    window.location.href = timetableList;
                    $("#overlay").fadeOut(300);
                } else {
                    toastr.error(data.message);
                    $("#overlay").fadeOut(300);
                }
            }
        });
    });

    $("#class_id").on('change', function (e) {
        e.preventDefault();
        var class_id = $(this).val();

        $("#section_id").empty();
        $("#section_id").append('<option value="">Select Class Name</option>');
        $.post(sectionByClass, { class_id: class_id }, function (res) {
            if (res.code == 200) {
                $.each(res.data, function (key, val) {
                    $("#section_id").append('<option value="' + val.section_id + '">' + val.section_name + '</option>');
                });
            }
        }, 'json');
    });

    $("#addFilter").validate({
        rules: {
            class_id: "required",
            section_id: "required",
            day: "required",
        }
    });
    var count = 0;
    // add designation
    $('#addFilter').on('submit', function (e) {
        e.preventDefault();
        var filterCheck = $("#addFilter").valid();
        if (filterCheck === true) {

            $("#timetable").hide("slow");
            $(".teacher").empty();
            $(".teacher").append('<option value="">Select Teacher</option>');
            $(".subject").empty();
            $(".subject").append('<option value="">Select Subject</option>');

            // var table = document.getElementById("timetable_table");
            // var length = table.tBodies[0].rows.length
            // console.log('length',length)
            // if(length>1)
            // {
            $("#timetable_body").empty();
            // }
            var classID = $("#bulk_class_id").val();
            var semesterID = $("#semester_id").val();
            var sessionID = $("#session_id").val();
            var Day = $("#day").val();


            var form = this;
            $.ajax({
                url: $(form).attr('action'),
                method: $(form).attr('method'),
                data: new FormData(form),
                processData: false,
                dataType: 'json',
                contentType: false,
                success: function (data) {
                    if (data.code == 200) {
                        $("#form_class_id").val(classID);
                        $("#form_semester_id").val(semesterID);
                        $("#form_session_id").val(sessionID);
                        $("#form_day").val(Day);
                        $("#timetable").show("slow");
                        var teacher = data.data.teacher;
                        console.log('teacher',teacher)
                        var exam_hall = data.data.exam_hall;

                        if (data.data.timetable == "") {
                            callout( teacher, exam_hall);
                        } else {
                            var cd = data.data.length;
                            count = cd;
                            $("#timetable_body").append(data.data.timetable);
                            $('.select2-multiple').select2();

                        }

                    }
                }
            });
        }
    });

    $("#indexFilter").validate({
        rules: {
            class_id: "required",
            section_id: "required",
        }
    });

    $('#editTimetableModal').on('shown.bs.modal', function () {
        var class_id = $("#edit-modal").data('class_id');
        var section_id = $("#edit-modal").data('section_id');
        var semester_id = $("#edit-modal").data('semester_id');
        var session_id = $("#edit-modal").data('session_id');
        $("#edit_class_id").val(class_id);
        $("#edit_section_id").val(section_id);
        $("#edit_semester_id").val(semester_id);
        $("#edit_session_id").val(session_id);//value

        // use the above data however you want
    })
    // get timetable
    $('#indexFilter').on('submit', function (e) {
        e.preventDefault();
        var filterCheck = $("#indexFilter").valid();
        if (filterCheck === true) {
            var form = this;
            $.ajax({
                url: $(form).attr('action'),
                method: $(form).attr('method'),
                data: new FormData(form),
                processData: false,
                dataType: 'json',
                contentType: false,
                success: function (data) {

                    if (data.code == 200) {
                        $("#edit-modal").attr("data-class_id", data.class_id);
                        $("#edit-modal").attr("data-section_id", data.section_id);
                        $("#edit-modal").attr("data-semester_id", data.semester_id);
                        $("#edit-modal").attr("data-session_id", data.session_id);
                        $("#timetablerow").show("slow");
                        $("#timetable").html(data.timetable);
                    } else {
                        $("#timetablerow").hide("slow");
                        toastr.error(data.message);
                    }
                }
            });
        }
    });

    // update timetable
    $('#editTimetableForm').on('submit', function (e) {
        e.preventDefault();
        var form = this;
        $("#overlay").fadeIn(300);
        $.ajax({
            url: $(form).attr('action'),
            method: $(form).attr('method'),
            data: new FormData(form),
            processData: false,
            dataType: 'json',
            contentType: false,
            success: function (data) {
                if (data.code == 200) {
                    $('.editTimetableForm').find('form')[0].reset();
                    toastr.success(data.message);
                    window.location.href = timetableList;
                    $("#overlay").fadeOut(300);
                } else {
                    toastr.error(data.message);
                    $("#overlay").fadeOut(300);
                }
            }
        });
    });

    $("#timetable_body").on('click', '.removeTR', function () {
        $(this).parent().parent().remove();
    });

    $("#edit_timetable_body").on('click', '.removeTR', function () {
        $(this).parent().parent().remove();
    });

    $(document).on('change', "#edit_timetable_body input[type='checkbox']", function () {
        $(this).closest('tr').find('select').prop('disabled', this.checked);
    })

    $(document).on('click', "#addMore", function () {

        var class_id = $("#form_class_id").val();
        $.post(subjectByClass, { class_id: class_id}, function (res) {
            if (res.code == 200) {
                var teacher = res.data.teacher;
                var exam_hall = res.data.exam_hall;
                callout(teacher, exam_hall);
            }
        }, 'json');
    });
    $(document).on('change', ".subByTeacher", function () {

        var teacher_id = $(this).data('id');
        var class_id = $("#form_class_id").val();
        var section_id = $("#form_section_id").val();
        console.log(teacher_id);
        console.log(class_id);
        console.log(section_id);
        $.post(teacherSubjectUrl, {
            token: token,
            branch_id: class_id,
            class_id: branchID,
            section_id: section_id,
            teacher_id: teacher_id
        }, function (res) {
            console.log("------------")
            console.log(res)
            if (res.code == 200) {

            }
        }, 'json');
    });


    function callout( teacher, exam_hall) {
        var row = "";
        row += '<tr class="iadd">';
        row += '<td ><div class="checkbox-replace"> ';
        row += '<label class="i-checks"><input type="checkbox" name="timetable[' + count + '][break]" id="' + count + '"><i></i>';
        row += '</label></div></td>';
        row += '<td width="20%" ><div class="form-group">';
        row += '<input class="form-control break_type"  type="text" name="timetable[' + count + '][break_type]" ></input> ';
        row += '</div></td>';
        row += '<td width="20%" ><div class="form-group main">';
        row += '<select  class="form-control select2-multiple teacher" data-toggle="select2" multiple="multiple" data-placeholder="Choose ..." name="timetable[' + count + '][teacher][]">';
        row += '<option value="">Select Teacher</option>';
        row += '<option value="0">All</option>';
        $.each(teacher, function (key, val) {
            row += '<option value="' + val.id + '">' + val.name + '</option>';
        });
        row += '</select>';
        row += '</div></td>';
        row += '<td width="20%"><div class="form-group">';
        row += '<input class="form-control"  type="time" name="timetable[' + count + '][time_start]" >';
        row += '</div></td>';
        row += '<td width="20%"><div class="form-group">';
        row += '<input class="form-control"  type="time" name="timetable[' + count + '][time_end]" >';
        row += '</div></td>';
        row += '<td width="20%" ><div class="form-group">';
        row += '<select  class="form-control class_room"  name="timetable[' + count + '][class_room]" class="form-control">';
        row += '<option value="">Select Hall</option>';
        $.each(exam_hall, function (key, val) {
            row += '<option value="' + val.id + '">' + val.hall_no + '</option>';
        });
        row += '</select>';
        row += '</div><button type="button" class=" btn btn-danger removeTR"><i class="fas fa-times"></i> </button></td>';
        // row += '<td width="20%"><div class="input-group">';
        // row += '<input type="text"  name="timetable[' + count + '][class_room]" value="" class="form-control" >';
        // row += '<button type="button" class=" btn btn-danger removeTR"><i class="fas fa-times"></i> </button>';
        // row += '</div></td>';
        row += '</tr>';

        count++;
        // console.log('as',row)
        // return row;

        $("#timetable_body").append(row);
        $('.select2-multiple').select2();
    }

});