$(function () {

    // add timetable
    $('#addTimetableForm').on('submit', function (e) {
        e.preventDefault();
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
                    } else {
                        toastr.error(data.message);
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
                    $("#section_id").append('<option value="' + val.id + '">' + val.name + '</option>');
                });
            }
        }, 'json');
    });

	$("#addFilter").validate({
        rules: {
            class_id:"required",
            section_id:"required",
            day:"required"
        }
    });

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

                        $("#form_class_id").val(data.data.class_id);
                        $("#form_section_id").val(data.data.section_id);
                        $("#timetable").show("slow");
                        var subject = data.data.subject;
                        var teacher = data.data.teacher;
                        callout(subject,teacher,0);
                    }
                }
            });
        }
    });

    $("#indexFilter").validate({
        rules: {
            class_id:"required",
            section_id:"required"
        }
    });

    $('#editTimetableModal').on('shown.bs.modal', function() {
        var class_id = $("#edit-modal").data('class_id');
        var section_id = $("#edit-modal").data('section_id');
        $("#edit_class_id").val(class_id); 
        $("#edit_section_id").val(section_id); //value
    
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
                    } else {
                        toastr.error(data.message);
                    }
                }
            });
    });

    $(document).on('click', "#timetable_body input[type='checkbox']", function() {

        $(this).closest('tr').find('select').prop('disabled', this.checked);
    })

    $("#timetable_body").on('click', '.removeTR', function () {
        $(this).parent().parent().parent().remove();
    });

    $("#edit_timetable_body").on('click', '.removeTR', function () {
        $(this).parent().parent().parent().remove();
    });

    $(document).on('change', "#timetable_body input[type='checkbox']", function() {
        $(this).closest('tr').find('select').prop('disabled', this.checked);
    })

    $(document).on('change', "#timetable_body input[type='checkbox']", function() {
        $(this).closest('tr').find('select').prop('disabled', this.checked);
    })
    
    $(document).on('click', "#addMore", function() {
        var lenght_div = $('#timetable_body .iadd').length;

        var class_id = $("#form_class_id").val();
        var section_id = $("#form_section_id").val();
        $.post(subjectByClass, { class_id: class_id , section_id: section_id}, function (res) {
            if (res.code == 200) {
                
                var subject = res.data.subject;
                var teacher = res.data.teacher;
                callout(subject,teacher,lenght_div);
            }
        }, 'json');
    });

    function callout(subject,teacher,value)
    {
        var row = "";
        row += '<tr class="iadd">';
        row += '<td ><div class="checkbox-replace"> ';
        row += '<label class="i-checks"><input type="checkbox" name="timetable[' + value + '][break]" id="' + value + '"><i></i>';
        row += '</label></div></td>';
        row += '<td width="20%" ><div class="form-group">';
        row += '<select  class="form-control subject"  name="timetable[' + value + '][subject]">';
        row += '<option value="">Select Subject</option>';
        $.each(subject, function (key, val) {
            row += '<option value="' + val.id + '">' + val.name + '</option>';
        });
        row += '</select>';
        row += '</div></td>';
        row += '<td width="20%" ><div class="form-group">';
        row += '<select  class="form-control teacher"  name="timetable[' + value + '][teacher]">';
        row += '<option value="">Select Teacher</option>';
        $.each(teacher, function (key, val) {
            row += '<option value="' + val.id + '">' + val.name + '</option>';
        });
        row += '</select>';
        row += '</div></td>';
        row += '<td width="20%"><div class="form-group">';
        row += '<input class="form-control"  type="time" name="timetable[' + value + '][time_start]" >';
        row += '</div></td>';
        row += '<td width="20%"><div class="form-group">';
        row += '<input class="form-control"  type="time" name="timetable[' + value + '][time_end]" >';
        row += '</div></td>';
        row += '<td width="20%"><div class="input-group">';
        row += '<input type="text"  name="timetable[' + value + '][class_room]" value="" class="form-control" >';
        row += '<button type="button" class=" btn btn-danger removeTR"><i class="fas fa-times"></i> </button>';
        row += '</div></td>';
        row += '</tr>';

        // console.log('as',row)
        // return row;
        
        $("#timetable_body").append(row);
    }
			
});