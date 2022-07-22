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
                    calendar.refetchEvents();
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

    var parent_id = ref_user_id;

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
        }, {
            url: getEventGroupCalendorStudent + '?token=' + token + '&branch_id=' + branchID + '&student_id=' + student_id,
            type: 'get',
            success: function (response) {
                g = response.data;
                return g;
            }
        }, {
            url: getEventGroupCalendorParent + '?token=' + token + '&branch_id=' + branchID + '&parent_id=' + parent_id,
            type: 'get',
            success: function (response) {
                p = response.data;
                return p;
            }
        }, {
            url: getBulkCalendor + '?token=' + token + '&branch_id=' + branchID + '&student_id=' + student_id,
            type: 'get',
            success: function (response) {
                c = response.data;
                return c;
            }
        }, {
            url: getScheduleExamDetailsUrl + '?token=' + token + '&branch_id=' + branchID + '&student_id=' + student_id,
            type: 'get',
            success: function (response) {
                dd = response.data;
                return dd;
            }
        }],
        // selectable: true,
        selectHelper: true,
        editable: true,
        eventClick: function (e) {
            if (e.event.extendedProps.event_id) {
                $('#event-modal').modal('toggle');
                var start = e.event.start_date;
                var end = e.event.end_date;
                var setCurDate = formatDate(end);
                $("#title").html(e.event.title);
                $("#type").html(e.event.extendedProps.event_type);
                $("#start_date").html(e.event.extendedProps.start_date);
                $("#end_date").html(e.event.extendedProps.end_date);
                if (e.event.extendedProps.all_day == null) {
                    $("#start_time").html(e.event.extendedProps.start_time);
                    $("#end_time").html(e.event.extendedProps.end_time);
                    $("#start_time_row").show();
                    $("#end_time_row").show();
                    console.log('not')
                } else {
                    $("#start_time_row").hide();
                    $("#end_time_row").hide();
                }
                if (e.event.extendedProps.audience == "1") {
                    var aud = e.event.extendedProps.class_name;
                } else if (e.event.extendedProps.audience == "2") {
                    var aud = "<b>Standard  :</b> " + e.event.extendedProps.class_name;
                } else if (e.event.extendedProps.audience == "3") {
                    var aud = "<b>Group  :</b> " + e.event.extendedProps.class_name;
                }
                $("#audience").html(aud);
                $("#description").html(e.event.extendedProps.remarks);
                $("#setCurDate").val(setCurDate);
            } else if (e.event.extendedProps.bulk_id) {
                $('#bulk-modal').modal('toggle');
                var start = e.event.start;
                var end = e.event.end;
                var setCurDate = formatDate(end);
                $("#bulk_name").html(e.event.extendedProps.name);
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
                $("#ttsemesterID").val(e.event.extendedProps.semester_id);
                $("#ttsessionID").val(e.event.extendedProps.session_id);
                $("#calNotes").val(e.event.extendedProps.student_remarks);
                $("#ttDate").val(e.event.end);
                $("#setCurDate").val(setCurDate);
            } else if (e.event.extendedProps.schedule_id) {
                $('#examScheduleModal').modal('toggle');
                var time_start = e.event.extendedProps.time_start;
                var time_end = e.event.extendedProps.time_end;
                // var setCurDate = formatDate(end);
                $("#examName").html(e.event.extendedProps.exam_name);
                $("#examStandard").html(e.event.extendedProps.class_name);
                $("#examClass").html(e.event.extendedProps.section_name);
                $("#examSubject").html(e.event.extendedProps.subject_name);
                $("#examTiming").html(tConvert(time_start) + ' - ' + tConvert(time_end));
            } else {
                // console.log("else")
            }
        }
    });
    calendar.render();
    function tConvert(time) {
        // Check correct time format and split into components
        time = time.toString().match(/^([01]\d|2[0-3])(:)([0-5]\d)(:[0-5]\d)?$/) || [time];

        if (time.length > 1) { // If time format correct
            time = time.slice(1);  // Remove full string match value
            time[5] = +time[0] < 12 ? 'AM' : 'PM'; // Set AM/PM
            time[0] = +time[0] % 12 || 12; // Adjust hours
        }
        return time.join(''); // return adjusted time or original string
    }
});
