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
    if (studentID) {
        student_id = studentID;
    } else {
        student_id = ref_user_id;
    }

    var calendarEl = document.getElementById('student_calendor');

    var calendar = new FullCalendar.Calendar(calendarEl, {
        plugins: ["bootstrap", "interaction", "dayGrid", "timeGrid", "list"],
        slotDuration: "00:05:00",
        // minTime: "08:00:00",
        // maxTime: "19:00:00",
        themeSystem: "bootstrap",
        bootstrapFontAwesome: !1,
        buttonText: {
            today: "Today",
            month: "Month",
            week: "Week",
            day: "Day",
            list: "List",
            prev: "Prev",
            next: "Next"
        },
        defaultView: "dayGridMonth",
        handleWindowResize: !0,
        // height: (window).height() - 200,
        header: {
            left: "prev,next today",
            center: "title",
            right: "dayGridMonth,timeGridWeek,timeGridDay,listMonth"
        },
        // events: t,
        editable: !0,
        droppable: !0,
        eventLimit: !0,
        selectable: !0,
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
        // selectable: true,
        selectHelper: true,
        editable: true,
        eventClick: function (e) {
            console.log("event details");
            if (e.event.extendedProps.event_id) {
                $('#event-modal').modal('toggle');
                var start = e.event.start_date;
                var end = e.event.end_date;
                var setCurDate = formatDate(end);
                $("#title").html(e.event.title);
                $("#type").html(e.event.extendedProps.event_type);
                $("#start_date").html(e.event.extendedProps.start_date);
                $("#end_date").html(e.event.extendedProps.end_date);
                $("#audience").html(e.event.extendedProps.class_name);
                $("#description").html(e.event.extendedProps.remarks);
                $("#setCurDate").val(setCurDate);
            } else if (e.event.extendedProps.time_table_id) {
                $('#student-modal').modal('toggle');
                var start = e.event.start;
                var end = e.event.end;
                var setCurDate = formatDate(end);
                $("#event-title").html(e.event.title);
                $("#subject-name").html(e.event.extendedProps.subject_name);
                $("#timing-class").html(start.toLocaleTimeString() + ' - ' + end.toLocaleTimeString());
                // l("#timing-class").html(start + ' - ' + end),
                $("#teacher-name").html(e.event.extendedProps.teacher_name);
                $("#standard-name").html(e.event.extendedProps.class_name);
                $("#section-name").html(e.event.extendedProps.section_name);
                $("#ttclassID").val(e.event.extendedProps.class_id);
                $("#ttSectionID").val(e.event.extendedProps.section_id);
                $("#ttSubjectID").val(e.event.extendedProps.subject_id);
                $("#calNotes").val(e.event.extendedProps.report);
                $("#ttDate").val(e.event.end);
                $("#setCurDate").val(setCurDate);
            } else {
                console.log("else")
            }
        }
    });
    calendar.render();
});
