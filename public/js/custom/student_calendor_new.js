$(document).ready(function () {
    // add student report
    $('#addStudentReport').on('submit', function (e) {
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
                    $("#student-modal").modal("hide");
                } else {
                    toastr.error(response.message);
                }
            }
        });

    });
    var student_id = null;
    // it come only parent and student
    if(studentID){
        student_id = studentID;
    }else{
        student_id = ref_user_id;
    }

    var calendar = $('#student_calendor').fullCalendar({
        editable: true,
        eventLimit: true, // allow "more" link when too many events
        eventLimitText: "More", //sets the text for more events
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay,listMonth'
        },
        // events: '/full-calender',

        eventSources: [{
            url: getTimetableCalendorStudent + '?token=' + token + '&branch_id=' + branchID + '&student_id=' + student_id,
            type: 'get',
            success: function (response) {
                t = response.data;
                return t;
            }
        }, {
            url: getEventCalendorStudent + '?token=' + token + '&branch_id=' + branchID + '&student_id=' + student_id,
            type: 'get',
            success: function (response) {
                m = response.data;
                return m;
            }
        }],
        selectable: true,
        selectHelper: true,
        editable: true,
        eventClick: function (event) {
            console.log("event details");
            // console.log(event);
            // console.log(event.id);
            // console.log(event.title);
            console.log(event.id);
            console.log(event.birthday);

            var start_date = moment(event.start).format('YYYY-MM-DD');
            var end_date = moment(event.end).format('YYYY-MM-DD');
            // console.log(start_date);
            // console.log(end_date);
            // console.log(event.description);
            var description = (event.description != "") ? event.description : "-";

            if (event.event_id) {
                $('#event-modal').modal('toggle');
                var start = event.start_date;
                var end = event.end_date;
                // var setCurDate = formatDate(end);
                $("#title").html(event.title);
                $("#type").html(event.event_type);
                $("#start_date").html(event.start_date);
                $("#end_date").html(event.end_date);
                $("#audience").html(event.class_name);
                $("#description").html(event.remarks);
                // $("#setCurDate").val(setCurDate);
            } else {
                console.log("*****88")
                console.log(event.class_id)
                console.log(event)
                console.log(typeof event.start)
                $('#student-modal').modal('toggle');
                // var start = event.start;
                // var end = event.end;
                var start = moment(event.start).format('hh:mm A');
                var end = moment(event.end).format('hh:mm A');
                // set current date
                var setCurDate = moment(event.end).format('YYYY-MM-DD');

                $("#event-title").html(event.title);
                $("#subject-name").html(event.subject_name);
                // $("#timing-class").html(start.toLocaleTimeString() + ' - ' + end.toLocaleTimeString());
                $("#timing-class").html(start + ' - ' + end);
                // l("#timing-class").html(start + ' - ' + end),
                $("#teacher-name").html(event.teacher_name);
                $("#standard-name").html(event.class_name);
                $("#section-name").html(event.section_name);
                $("#ttclassID").val(event.class_id);
                $("#ttSectionID").val(event.section_id);
                $("#ttSubjectID").val(event.subject_id);
                $("#calNotes").val(event.report);
                $("#ttDate").val(event.end);
                $("#setCurDate").val(setCurDate);

            }
        }
    });
});
