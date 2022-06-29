$(function () {

    $("#class_id").on('change', function (e) {
        e.preventDefault();
        var class_id = $(this).val(); 
        console.log("select box",class_id)
        
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

    $(document).on('change', '.distributor_type', function (e) {
        e.preventDefault();

        
        var dist = "";
        var distributor_type =  $(this).val(); 
        
        var id =  $(this).data('id'); 
        var distributor = $(this).closest('td').find('.distributor');
        var class_id = $("#class_id").val();
        var section_id = $("#section_id").val();

        distributor.empty();

        if (distributor_type=="1") {

            distributor.append('<select  class="form-control" name="exam['+id +'][distributor]">');

            $.post(getTeacherList, { 
                token: token,
                branch_id: branchID,
                class_id: class_id,
                section_id: section_id 
            }, function (res) {
                if (res.code == 200) {
                    
                    $.each(res.data, function (key, val) {
                        distributor.find('select').append('<option value="' + val.id + '">' + val.name + '</option>');
                    });
                   
                }
                
            }, 'json');

            distributor.append('</select>');
        } else {
            var dist = '<input type="text" name="exam['+id+'][distributor]" class="form-control"   placeholder="Distributor Name">';
            distributor.append(dist);
        }

    });

    $('.examTimeTable').on('shown.bs.modal', e => {
        var $button = $(e.relatedTarget);
        var exam_id = $button.attr('data-exam_id');
        var class_id = $("#class_id").val();
        var section_id = $("#section_id").val();
        // return false;
        $.post(viewExamTimetable, { exam_id: exam_id,class_id: class_id,section_id: section_id }, function (res) {
            if (res.code == 200) {
                var exam_name = "Exam : "+res.data.details.exam_name;
                var class_section = "Class : "+res.class_section;
                $("#class-section").html(class_section);
                $("#exam").html(exam_name);
                $("#exam-timetable").html(res.table);
            }
        }, 'json');
    }).on('hidden.bs.modal', function (event) {

    });

    $("#examTimetableFilter").validate({
        rules: {
            class_id:"required",
            section_id:"required",
        }
    });

    // get timetable
    $('#examTimetableFilter').on('submit', function (e) {
        e.preventDefault();
        var filterCheck = $("#examTimetableFilter").valid();
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
                                    
                        $("#schedulerow").show("slow");
                        $("#exam-schedule").html(data.table);
                    } else {
                        $("#schedulerow").hide("slow");
                        toastr.error(data.message);
                    }
                }
            });
        }
    });

    $("#addScheduleFilter").validate({
        rules: {
            class_id:"required",
            section_id:"required",
            exam_id:"required",
        }
    });

    // get timetable
    $('#addScheduleFilter').on('submit', function (e) {
        e.preventDefault();
        $("#listrow").hide("slow");
        var filterCheck = $("#addScheduleFilter").valid();
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
                        
                        $("#form_class_id").val(data.class_id);
                        $("#form_section_id").val(data.section_id);
                        $("#form_exam_id").val(data.exam_id);
                        $("#listrow").show("slow");
                        $("#subject-schedule").html(data.table);
                    } else {
                        $("#listrow").hide("slow");
                        toastr.error(data.message);
                    }
                }
            });
        }
    });

    
    $('#addScheduleForm').on('submit', function (e) {
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
                    window.location.href = scheduleList;
                    toastr.success(data.message);
                    $("#overlay").fadeOut(300);
                } else {
                    toastr.error(data.message);
                    $("#overlay").fadeOut(300);
                }
            }
        });
    });
});