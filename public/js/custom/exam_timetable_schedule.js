$(function () {

    $('.examTimeTable').on('shown.bs.modal', e => {
        var $button = $(e.relatedTarget);
        var exam_id = $button.attr('data-exam_id');
        var class_id = $("#class_id").val();
        var section_id = $("#section_id").val();
        var semester_id = $("#semester_id").val();
        var session_id = $("#session_id").val();
        // return false;
        $.post(viewExamTimetable, {
            exam_id: exam_id, class_id: class_id, section_id: section_id,
            semester_id: semester_id, session_id: session_id
        }, function (res) {
            if (res.code == 200) {
                var exam_name = "Exam : " + res.data.details.exam_name;
                var class_section = "Class : " + res.class_section;
                $("#class-section").html(class_section);
                $("#exam").html(exam_name);
                $("#exam-timetable").html(res.table);
            }
        }, 'json');
    }).on('hidden.bs.modal', function (event) {

    });
});