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
    // $('#addTimetableForm').on('submit', function (e) {
    //     console.log($('.time_start_class'))
    //     $('.time_start_class').each(function () {
    //         $(this).rules("add", {
    //             required: true
    //         })
    //     });
    //     e.preventDefault();
    //     if ($('#contactForm').validate().form()) {
    //         alert("validates");
    //     } else {
    //         alert("does not validate");
    //     }
    //     return false;
    //     $("#overlay").fadeIn(300);
    //     var form = this;
    //     $.ajax({
    //         url: $(form).attr('action'),
    //         method: $(form).attr('method'),
    //         data: new FormData(form),
    //         processData: false,
    //         dataType: 'json',
    //         contentType: false,
    //         success: function (data) {
    //             if (data.code == 200) {
    //                 $('.addTimetableForm').find('form')[0].reset();
    //                 toastr.success(data.message);
    //                 window.location.href = timetableList;
    //                 $("#overlay").fadeOut(300);
    //             } else {
    //                 toastr.error(data.message);
    //                 $("#overlay").fadeOut(300);
    //             }
    //         }
    //     });
    // });
    $('#addTimetableForm').on('submit', function (event) {
        console.log($('.time_start_class'))
        $('.time_start_class').each(function () {
            $(this).rules("add", {
                required: true
            })
        });
        $('.time_end_class').each(function () {
            $(this).rules("add", {
                required: true
            })
        });

        event.preventDefault();
        if ($('#addTimetableForm').validate().form()) {
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
        }
    });
    $('#addTimetableForm').validate();

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
            var classID = $("#class_id").val();
            var sectionID = $("#section_id").val();
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
                        $("#form_section_id").val(sectionID);
                        $("#form_semester_id").val(semesterID);
                        $("#form_session_id").val(sessionID);
                        $("#form_day").val(Day);
                        $("#timetable").show("slow");
                        var subject = data.data.subject;
                        var teacher = data.data.teacher;
                        var exam_hall = data.data.exam_hall;


                        if (data.data.timetable == "") {
                            callout(subject, teacher, exam_hall);
                        } else {
                            var cd = data.data.length;
                            count = cd;
                            console.log('cou', count)
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

    $(document).on('click', "#timetable_body input[type='checkbox']", function () {

        var fal = true;
        if (this.checked == true) {
            fal = false;
        }
        $(this).closest('tr').find('.subject').prop('disabled', this.checked);
        $(this).closest('tr').find('.subject').attr('hidden', this.checked);

        $(this).closest('tr').find('.break_type').prop('disabled', fal);
        $(this).closest('tr').find('.break_type').attr('hidden', fal);
    })

    // $("#timetable_body").on('click', '.removeTR', function () {
    //     $(this).parent().parent().remove();
    // });

    // $("#edit_timetable_body").on('click', '.removeTR', function () {
    //     $(this).parent().parent().remove();
    // });
    $("#timetable_body").on('click', '.removeTR', function () {
        $(this).parent().parent().parent().remove();
    });

    $("#edit_timetable_body").on('click', '.removeTR', function () {
        $(this).parent().parent().parent().remove();
    });
    $(document).on('change', "#edit_timetable_body input[type='checkbox']", function () {
        var fal = true;
        if (this.checked == true) {
            fal = false;
        }
        $(this).closest('tr').find('.subject').prop('disabled', this.checked);
        $(this).closest('tr').find('.subject').attr('hidden', this.checked);

        $(this).closest('tr').find('.break_type').prop('disabled', fal);
        $(this).closest('tr').find('.break_type').attr('hidden', fal);
    })

    $(document).on('click', "#addMore", function () {

        var class_id = $("#form_class_id").val();
        var section_id = $("#form_section_id").val();
        var semester_id = $("#form_semester_id").val();
        var session_id = $("#form_session_id").val();
        $.post(subjectByClass, {
            class_id: class_id, section_id: section_id,
            semester_id: semester_id, session_id: session_id
        }, function (res) {
            if (res.code == 200) {

                var subject = res.data.subject;
                var teacher = res.data.teacher;
                var exam_hall = res.data.exam_hall;
                callout(subject, teacher, exam_hall);
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
            branch_id: branchID,
            class_id: class_id,
            section_id: section_id,
            teacher_id: teacher_id
        }, function (res) {
            console.log("------------")
            console.log(res)
            if (res.code == 200) {

            }
        }, 'json');
    });
    $(document).on('change', ".time_start_class", function (e) {
        e.preventDefault();
        var color = $(this).closest('tr');

        color.find(".class_room option").css('background-color', 'white');
        var start_time = $(this).closest('tr').find('.time_start_class').val();
        var end_time = $(this).closest('tr').find('.time_end_class').val();
            
        if (start_time && end_time) {
            var semesterID = $("#semester_id").val();
            var day = $("#day").val();
                $.post(classRoomCheck, {
                    token: token,
                    branch_id: branchID,
                    start_time: start_time,
                    end_time: end_time,
                    semester_id: semesterID,
                    day: day
                }, function (res) {
                    if (res.code == 200) {
                        $.each(res.data, function(index, value) {
                            color.find(".class_room option[value='"+value.class_room+"']").css('background-color', 'red');
                        });
                        // $("option[value='myValue']").css('background-color', 'red');
                    }
                }, 'json');
        }
            
    });
    $(document).on('change', ".time_end_class", function (e) {
        e.preventDefault();
        var color = $(this).closest('tr');
            
        color.find(".class_room option").css('background-color', 'white');
        var start_time = $(this).closest('tr').find('.time_start_class').val();
        var end_time = $(this).closest('tr').find('.time_end_class').val();
            
        if (start_time && end_time) {
            var semesterID = $("#semester_id").val();
            var day = $("#day").val();
                $.post(classRoomCheck, {
                    token: token,
                    branch_id: branchID,
                    start_time: start_time,
                    end_time: end_time,
                    semester_id: semesterID,
                    day: day
                }, function (res) {
                    if (res.code == 200) {
                        $.each(res.data, function(index, value) {
                            color.find(".class_room option[value='"+value.class_room+"']").css('background-color', 'red');
                        });
                        // $("option[value='myValue']").css('background-color', 'red');
                    }
                }, 'json');
        }
            
    });


    function callout(subject, teacher, exam_hall) {

        // let i = 0;
        // var test = "";
        // test += '<select class="form-control select2-multiple-test" data-toggle="select2" multiple="multiple" data-placeholder="Choose ..." ><option   selected="selected">Cat</option><option selected="selected">Dog</option> </select>';
        // $(".boxss").append(test);
        // if(i == 0){
        //     console.log("---");
        //     console.log(i);
        //     $('.select2-multiple-test').select2();
        // }
        // i++;
        // var newtest = "<select class='form-control select2-multiple' data-toggle='select2' multiple='multiple' data-placeholder='Choose ...' ><option   selected='selected'>Cat</option><option selected='selected'>Dog</option> </select>";
        // $("#boxss").append(newtest);
        // $(".boxss").append('<select class="form-control select2-multiple-test" data-toggle="select2" multiple="multiple" data-placeholder="Choose ..." ><option   selected="selected">Cat</option><option selected="selected">Dog</option> </select>');
        // $('.select2-multiple-test').select2();
        var row = "";
        row += '<tr class="iadd">';
        row += '<td ><div class="checkbox-replace"> ';
        row += '<label class="i-checks"><input type="checkbox" name="timetable[' + count + '][break]" id="' + count + '"><i></i>';
        row += '</label></div></td>';
        row += '<td width="20%" ><div class="form-group">';
        row += '<select  class="form-control subject"  name="timetable[' + count + '][subject]">';
        row += '<option value="">Select Subject</option>';
        $.each(subject, function (key, val) {
            row += '<option value="' + val.id + '">' + val.name + '</option>';
        });
        row += '</select>';
        row += '<input class="form-control break_type"  type="text" name="timetable[' + count + '][break_type]" disabled hidden="hidden"></input> ';
        row += '</div></td>';
        row += '<td width="20%" ><div class="form-group main">';
        row += '<select  class="form-control select2-multiple teacher" data-toggle="select2" multiple="multiple" data-placeholder="Choose ..." name="timetable[' + count + '][teacher][]">';
        row += '<option value="">Select Teacher</option>';
        $.each(teacher, function (key, val) {
            row += '<option value="' + val.id + '">' + val.name + '</option>';
        });
        row += '</select>';
        row += '</div></td>';
        row += '<td width="20%"><div class="form-group">';
        row += '<input class="form-control time_start_class"  type="time" name="timetable[' + count + '][time_start]" >';
        row += '</div></td>';
        row += '<td width="20%"><div class="form-group">';
        row += '<input class="form-control time_end_class"  type="time" name="timetable[' + count + '][time_end]" >';
        row += '</div></td>';
        row += '<td width="20%" ><div class="form-group">';
        row += '<select  class="form-control class_room"  name="timetable[' + count + '][class_room]" class="form-control">';
        row += '<option value="">Select Hall</option>';
        $.each(exam_hall, function (key, val) {
            row += '<option value="' + val.id + '">' + val.hall_no + '</option>';
        });
        row += '</select>';
        row += '</div></td>';
        row += '<td width="20%"><div class="form-group">';
        row += '<button type="button" class=" btn btn-danger removeTR"><i class="fas fa-times"></i> </button>';
        row += '</div></td>';
        // row += '</div><button type="button" class=" btn btn-danger removeTR"><i class="fas fa-times"></i> </button></td>';
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

    
    $(document).on('click', '.exportToExcel', function (e) {
        // var table = $(this).prev('.table2excel');
        var table = $('.table2excel');
        if (table && table.length) {
            var preserveColors = (table.hasClass('table2excel_with_colors') ? true : false);
            $(table).table2excel({
                // exclude: ".noExl",
                name: "Timetable",
                filename: "timetable" + new Date().toISOString().replace(/[\-\:\.]/g, "") + ".xls",
                fileext: ".xls",
                exclude_img: true,
                exclude_links: true,
                exclude_inputs: true,
                preserveColors: preserveColors
            });
        }
    });

});