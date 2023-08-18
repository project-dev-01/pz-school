$(document).ready(function () {
    var myString = hiddenWks;
    var workWeekArray = myString.split(",").map(Number);
    // check wether mobile or not
    window.mobilecheck = function () {
        var check = false;
        (function (a) { if (/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i.test(a) || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0, 4))) check = true; })(navigator.userAgent || navigator.vendor || window.opera);
        return check;
    };
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
        slotDuration: "00:30:00",
        // minTime: "08:00:00",
        // maxTime: "19:00:00",
        themeSystem: "bootstrap",
        bootstrapFontAwesome: !1,
        buttonText: {
            prev: previous,
            next: next,
            today: today,
            dayGridMonth: month,
            timeGridWeek: week,
            workWeek: work_week,
            timeGridDay: day,
            listMonth: list
        },
        // timeformat to show
        eventTimeFormat: {
            hour: 'numeric',
            minute: 'numeric',
            omitZeroMinute: true,
            meridiem: 'short'
        },
        allDayText: allday_lang,
        noEventsMessage: no_events_to_display_lang,
        // defaultView: window.mobilecheck() ? "listMonth" : "dayGridMonth",
        defaultView: "timeGridWeek",
        nowIndicator: true, // This will display the current time indicator line
        // displayEventTime: false,
        displayEventTime: true,
        handleWindowResize: !0,
        // height: (window).height() - 200,
        header: {
            left: "prev,next today",
            center: "title",
            right: "dayGridMonth,timeGridWeek,workWeek,timeGridDay,listMonth"
        },
        businessHours: {
            daysOfWeek: [1, 2, 3, 4, 5], // Monday through Friday
            startTime: employee_check_in_time, // Business hours start time (9:00 AM)
            endTime: employee_check_out_time,   // Business hours end time (5:00 PM)
        },
        views: {
            timeGridWeek: { // Basic week view (Sunday to Saturday)
                type: 'timeGridWeek'
            },
            workWeek: { // Work week view (Monday to Friday)
                type: 'timeGridWeek',
                hiddenDays: workWeekArray // Hide Sat and Sun
                // weekends: false, // Exclude weekends
                // weekends: [1,2], // Exclude weekends
            }
        },
        locale: calLang,
        // events: t,
        editable: !0,
        droppable: !0,
        // eventLimit: !0,
        eventLimit: 3, // set limit to show
        selectable: !0,
        eventSources: [
            {
                // backgroundColor:"red",
                // borderColor:"blue",
                events: function (info, successCallback, failureCallback) {
                    $.ajax({
                        url: getPublicHolidays + '?branch_id=' + branchID,
                        dataType: 'json',
                        type: 'get',
                        data: {
                            start: info.startStr,
                            end: info.endStr
                        },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                            'Authorization': 'Bearer ' + token
                        },
                        success: function (response) {
                            hs = response.data;
                            successCallback(hs);
                        },
                        error: function (err) {
                            failureCallback(err);
                        },
                    });
                }
            },
            // calendor events
            {
                events: function (info, successCallback, failureCallback) {
                    $.ajax({
                        url: getTimetableCalendorStudent + '?token=' + token + '&branch_id=' + branchID + '&student_id=' + student_id,
                        dataType: 'json',
                        type: 'get',
                        data: {
                            start: info.startStr,
                            end: info.endStr
                        },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                            'Authorization': 'Bearer ' + token
                        },
                        success: function (response) {
                            s = response.data;
                            successCallback(s);
                        },
                        error: function (err) {
                            failureCallback(err);
                        },
                    });
                }
            },
            {
                events: function (info, successCallback, failureCallback) {
                    $.ajax({
                        url: getEventCalendorStudent + '?token=' + token + '&branch_id=' + branchID + '&student_id=' + student_id,
                        dataType: 'json',
                        type: 'get',
                        data: {
                            start: info.startStr,
                            end: info.endStr
                        },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                            'Authorization': 'Bearer ' + token
                        },
                        success: function (response) {
                            t = response.data;
                            successCallback(t);
                        },
                        error: function (err) {
                            failureCallback(err);
                        },
                    });
                }
            },
            {
                events: function (info, successCallback, failureCallback) {
                    $.ajax({
                        url: getEventGroupCalendorStudent + '?token=' + token + '&branch_id=' + branchID + '&student_id=' + student_id,
                        dataType: 'json',
                        type: 'get',
                        data: {
                            start: info.startStr,
                            end: info.endStr
                        },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                            'Authorization': 'Bearer ' + token
                        },
                        success: function (response) {
                            m = response.data;
                            successCallback(m);
                        },
                        error: function (err) {
                            failureCallback(err);
                        },
                    });
                }
            },
            {
                events: function (info, successCallback, failureCallback) {
                    $.ajax({
                        url: getEventGroupCalendorParent + '?token=' + token + '&branch_id=' + branchID + '&parent_id=' + parent_id,
                        dataType: 'json',
                        type: 'get',
                        data: {
                            start: info.startStr,
                            end: info.endStr
                        },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                            'Authorization': 'Bearer ' + token
                        },
                        success: function (response) {
                            g = response.data;
                            successCallback(g);
                        },
                        error: function (err) {
                            failureCallback(err);
                        },
                    });
                }
            },
            {
                events: function (info, successCallback, failureCallback) {
                    $.ajax({
                        url: getBulkCalendor + '?token=' + token + '&branch_id=' + branchID + '&student_id=' + student_id,
                        dataType: 'json',
                        type: 'get',
                        data: {
                            start: info.startStr,
                            end: info.endStr
                        },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                            'Authorization': 'Bearer ' + token
                        },
                        success: function (response) {
                            b = response.data;
                            successCallback(b);
                        },
                        error: function (err) {
                            failureCallback(err);
                        },
                    });
                }
            },
            {
                events: function (info, successCallback, failureCallback) {
                    $.ajax({
                        url: getScheduleExamDetailsUrl + '?token=' + token + '&branch_id=' + branchID + '&student_id=' + student_id,
                        dataType: 'json',
                        type: 'get',
                        data: {
                            start: info.startStr,
                            end: info.endStr
                        },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                            'Authorization': 'Bearer ' + token
                        },
                        success: function (response) {
                            c = response.data;
                            successCallback(c);
                        },
                        error: function (err) {
                            failureCallback(err);
                        },
                    });
                }
            }
        ],
        // selectable: true,
        selectHelper: true,
        editable: true,
        eventClick: function (e) {
            if (e.event.extendedProps.event_id) {
                $('#event-modal').modal('toggle');
                var start = e.event.start_date;
                var end = e.event.end_date;
                var setCurDate = formatDate(end);
                if (e.event.allDay == "1") {
                    var start_dt = moment(e.event.start).format('DD-MM-YYYY dddd hh:mm A');
                    var end_dt = moment(e.event.end).subtract(1, 'seconds').format('DD-MM-YYYY dddd hh:mm A');
                } else {
                    var start_dt = moment(e.event.start).format('DD-MM-YYYY dddd hh:mm A');
                    var end_dt = moment(e.event.end).format('DD-MM-YYYY dddd hh:mm A');
                }
                $("#title").html(e.event.title);
                $("#type").html(e.event.extendedProps.event_type);
                $("#start_date").html(start_dt);
                $("#end_date").html(end_dt);
                if (e.event.extendedProps.audience == "1") {
                    var aud = e.event.extendedProps.class_name;
                } else if (e.event.extendedProps.audience == "2") {
                    var aud = "<b>Grade  :</b> " + e.event.extendedProps.class_name;
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
                var classStartTime = moment(e.event.start).format('hh:mm A');
                var classEndTime = moment(e.event.end).format('hh:mm A');
                $('#student-modal').modal('toggle');
                
                var start = e.event.start;
                var end = e.event.end;
                var setCurDate = formatDate(end);
                $("#event-title").html(e.event.title);
                $("#subject-name").html(e.event.extendedProps.subject_name);
                $("#timing-class").html(classStartTime + ' - ' + classEndTime);
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
