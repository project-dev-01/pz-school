$(document).ready(function () {
    var date1 = $("#taskfromDate").flatpickr({
        dateFormat: "Y-m-d",
        onChange: function (selectedDates, dateStr, instance) {
            date2.set('minDate', dateStr)
        }
    });

    var date2 = $("#taskToDate").flatpickr({
        dateFormat: "Y-m-d",
        onChange: function (selectedDates, dateStr, instance) {
            date1.set('maxDate', dateStr)
        }
    });

    var editdate1 = $("#edittaskfromDate").flatpickr({
        dateFormat: "Y-m-d",
        onChange: function (selectedDates, dateStr, instance) {
            editdate2.set('minDate', dateStr)
        }
    });

    var editdate2 = $("#edittaskToDate").flatpickr({
        dateFormat: "Y-m-d",
        onChange: function (selectedDates, dateStr, instance) {
            editdate1.set('maxDate', dateStr)
        }
    });
    // $(".taskdateSlot").flatpickr({mode:"range"});
    // var form_date_from = $(".taskdateSlot").flatpickr({
    //     mode: 'range'
    // });
    // $("#tasktimeSlotStart").flatpickr({ enableTime: !0, noCalendar: !0, dateFormat: "H:i", defaultDate: "01:45" });
    // $("#tasktimeSlotEnd").flatpickr({ enableTime: !0, noCalendar: !0, dateFormat: "H:i", defaultDate: "01:45" });
    $('.allDayCheck').on('change', function (e) {
        if ($(this).is(':checked')) {
            // let fromDateval = $(".taskfromDate").val();
            // $(".taskToDate").val(fromDateval);
            $(".displayTimeSlot").hide();
        } else {
            $(".displayTimeSlot").show();
        }
    });
    // check min data validation
    var check_in_date = flatpickr("#tasktimeSlotStart", {
        enableTime: !0, noCalendar: !0, dateFormat: "H:i",
        onChange: function (selectedDates, dateStr, instance) {
            check_out_date.set('minTime', selectedDates[0]);
            $("#tasktimeSlotEnd").val("");
        }
    });

    var check_out_date = flatpickr("#tasktimeSlotEnd", {
        enableTime: !0, noCalendar: !0, dateFormat: "H:i"
    });
    //
    // check min data validation
    var edit_check_in_date = flatpickr("#editTasktimeSlotStart", {
        enableTime: !0, noCalendar: !0, dateFormat: "H:i",
        onChange: function (selectedDates, dateStr, instance) {
            edit_check_out_date.set('minTime', selectedDates[0]);
            $("#editTasktimeSlotEnd").val("");
        }
    });

    var edit_check_out_date = flatpickr("#editTasktimeSlotEnd", {
        enableTime: !0, noCalendar: !0, dateFormat: "H:i"
    });

    // ("#minmax-timepicker").flatpickr({enableTime:!0,noCalendar:!0,dateFormat:"H:i",minDate:"16:00",maxDate:"22:30"})
    // check wether mobile or not
    window.mobilecheck = function () {
        var check = false;
        (function (a) { if (/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i.test(a) || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0, 4))) check = true; })(navigator.userAgent || navigator.vendor || window.opera);
        return check;
    };
    // go to classroom
    $("#goToClassRoom").on("click", function () {

        var ttclassID = $("#ttclassID").val();
        var ttSectionID = $("#ttSectionID").val();
        var ttSubjectID = $("#ttSubjectID").val();
        var ttsemesterID = $("#ttsemesterID").val();
        var ttsessionID = $("#ttsessionID").val();
        var ttDate = $("#ttDate").val();
        var sectionName = $("#section-name").text();
        var subjectName = $("#subject-name").text();

        sessionStorage.removeItem("classroom_details");
        var classDetails = new Object();
        classDetails.class_id = ttclassID;
        classDetails.section_id = ttSectionID;
        classDetails.section_name = sectionName;
        classDetails.subject_id = ttSubjectID;
        classDetails.semester_id = ttsemesterID;
        classDetails.session_id = ttsessionID;
        classDetails.subject_name = subjectName;
        classDetails.date = ttDate;
        var classroom_details = [];
        classroom_details.push(classDetails);
        sessionStorage.setItem('classroom_details', JSON.stringify(classroom_details));
        window.location = redirectionURL;
    });
    //
    $('#addDailyReport').on('submit', function (e) {
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
                } else {
                    toastr.error(response.message);
                }
            }
        });

    });
    var calendarEl = document.getElementById('teacher_calendor');

    var calendar = new FullCalendar.Calendar(calendarEl, {
        plugins: ["bootstrap", "interaction", "dayGrid", "timeGrid", "list"],
        slotDuration: "00:15:00",
        minTime: "06:00:00",
        maxTime: "24:00:00",
        themeSystem: "bootstrap",
        bootstrapFontAwesome: !1,
        buttonText: {
            today: today,
            month: month,
            week: week,
            day: day,
            list: list,
            prev: previous,
            next: next
        },
        allDayText: allday_lang,
        noEventsMessage: no_events_to_display_lang,
        // defaultView: window.mobilecheck() ? "timeGridWeek" : "dayGridMonth",
        defaultView: "timeGridWeek",
        displayEventTime: false,
        handleWindowResize: !0,
        // height: (window).height() - 200,
        header: {
            left: "prev,next today",
            center: "title",
            right: "dayGridMonth,timeGridWeek,timeGridDay,listMonth"
        },
        locale: calLang,
        // events: t,
        editable: !0,
        droppable: !0,
        eventLimit: !0,
        selectable: !0,
        eventSources: [
            // calendor events
            {
                events: function (info, successCallback, failureCallback) {
                    $.ajax({
                        url: calendorListTaskCalendor + '?token=' + token + '&branch_id=' + branchID + '&login_id=' + userID,
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
                        url: getTimetableCalendor + '?token=' + token + '&branch_id=' + branchID + '&teacher_id=' + ref_user_id,
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
                        url: getEventCalendor + '?token=' + token + '&branch_id=' + branchID + '&teacher_id=' + ref_user_id,
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
                        url: getEventGroupCalendor + '?token=' + token + '&branch_id=' + branchID + '&teacher_id=' + ref_user_id,
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
                        url: getBirthdayCalendor + '?token=' + token + '&branch_id=' + branchID + '&teacher_id=' + ref_user_id,
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
                        url: getBulkCalendor + '?token=' + token + '&branch_id=' + branchID + '&teacher_id=' + ref_user_id,
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
            },
            {
                events: function (info, successCallback, failureCallback) {
                    $.ajax({
                        url: getScheduleExamDetailsUrl + '?token=' + token + '&branch_id=' + branchID + '&teacher_id=' + ref_user_id,
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
                            dd = response.data;
                            successCallback(dd);
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
        select: function (e) {
            let starthminutes = moment(e.start).format('HH:mm');
            let endhminutes = moment(e.end).format('HH:mm');
            let allDay = e.allDay;
            // var title = prompt('Event Title:');
            $('#addTasksModal').modal('toggle');
            $('.addTasks').find('form')[0].reset();
            var selected_start = moment(e.start).format('YYYY-MM-DD');
            var selected_end = moment(e.end).subtract(1, 'seconds').format('YYYY-MM-DD');

            $("#taskAdd").find("#taskfromDate").val(selected_start);
            $("#taskAdd").find("#taskToDate").val(selected_end);
            $("#taskAdd").find("#tasktimeSlotStart").val(starthminutes);
            $("#taskAdd").find("#tasktimeSlotEnd").val(endhminutes);
            if (allDay === true) {
                $("#taskAdd").find("#allDayCheck").prop('checked', true);
                $("#taskAdd").find("#addTimeSlot").hide();
            } else {
                $("#taskAdd").find("#allDayCheck").prop('checked', false);
                $("#taskAdd").find("#addTimeSlot").show();
            }
            // rules validation
            $("#taskAdd").validate({
                rules: {
                    title: "required",
                    taskdateSlot: "required"
                }
            });
            $('#taskAdd').on('submit', function (event) {
                event.preventDefault();
                var taskAdd = $("#taskAdd").valid();
                if (taskAdd === true) {
                    var title = $('#taskTitle').val();
                    var description = $("#taskDescription").val();
                    var taskfromDate = $("#taskfromDate").val();
                    var taskToDate = $("#taskToDate").val();
                    var tasktimeSlotStart = $("#tasktimeSlotStart").val();
                    var tasktimeSlotEnd = $("#tasktimeSlotEnd").val();
                    var allDayCheck = $('#allDayCheck').is(':checked');
                    if (allDayCheck === true) {
                        var startdate = taskfromDate + " " + "00:00:00";
                        var startend = taskToDate + " " + "24:00:00";
                        var start_date = moment(startdate).format('YYYY-MM-DD HH:mm:ss');
                        var end_date = moment(startend).format('YYYY-MM-DD HH:mm:ss');
                    } else {
                        var startdate = taskfromDate + " " + tasktimeSlotStart + ":00";
                        var startend = taskToDate + " " + tasktimeSlotEnd + ":00";
                        var start_date = moment(startdate).format('YYYY-MM-DD HH:mm:ss');
                        var end_date = moment(startend).format('YYYY-MM-DD HH:mm:ss');
                    }
                    $.ajax({
                        url: calendorAddTaskCalendor,
                        type: "POST",
                        dataType: 'json',
                        data: {
                            token: token,
                            branch_id: branchID,
                            title: title,
                            start: start_date,
                            end: end_date,
                            login_id: userID,
                            all_day: allDayCheck,
                            description: description
                        },
                        success: function (response) {
                            var newData = response.data;
                            $('#addTasksModal').modal('hide')
                            $('.addTasks').find('form')[0].reset();
                            let eventObject = {
                                calendor_id: newData.calendor_id,
                                title: newData.title,
                                start: newData.start,
                                end: newData.end,
                                description: newData.description,
                                className: newData.className,
                                allDay: newData.allDay
                            };
                            calendar.addEvent(eventObject);
                        }
                    });
                    calendar.unselect();
                }
            });

        },
        // editable: true,
        eventClick: function (e) {
            //
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
                    // console.log('not')
                } else {
                    $("#start_time_row").hide();
                    $("#end_time_row").hide();
                }

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
            } else if (e.event.extendedProps.birthday) {
                $('#birthday-modal').modal('toggle');
                var start = e.event.start;
                var end = e.event.end;
                var setCurDate = formatDate(end);
                $("#name").html(e.event.extendedProps.name);
                $("#setCurDate").val(setCurDate);
            } else if (e.event.extendedProps.bulk_id) {
                $('#bulk-modal').modal('toggle');
                var start = e.event.start;
                var end = e.event.end;
                var setCurDate = formatDate(end);
                $("#bulk_name").html(e.event.extendedProps.name);
                $("#setCurDate").val(setCurDate);
            } else if (e.event.extendedProps.time_table_id) {
                $('#teacher-modal').modal('toggle');
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
                $("#calNotes").val(e.event.extendedProps.report);
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
            } else if (e.event.extendedProps.calendor_id) {
                var calendor_id = e.event.extendedProps.calendor_id;
                if (calendor_id) {
                    $.ajax({
                        url: calendorEditTaskCalendor,
                        type: "GET",
                        dataType: 'json',
                        data: {
                            token: token,
                            branch_id: branchID,
                            calendor_id: calendor_id
                        },
                        success: function (response) {
                            if (response.code == 200) {
                                var start_dt = moment(response.data.start).format('DD-MM-YYYY dddd hh:mm A');
                                var subonesec = moment(response.data.end).subtract(1, 'seconds').format('DD-MM-YYYY dddd hh:mm A');
                                $('#showTasksModal').modal('toggle');
                                $("#showTasksModal").find("#calendorID").val(calendor_id);
                                $("#startDateDetails").html(start_dt);
                                $("#endDateDetails").html(subonesec);
                                $("#taskShowTit").html(response.data.title);
                                $("#taskShowDesc").html(response.data.description);
                            } else {
                                toastr.error(response.message);
                            }
                        }, error: function (err) {
                            toastr.error(err.responseJSON.data.error ? err.responseJSON.data.error : 'Something went wrong');
                        }
                    });
                }

            }
            $("#editEventBtn").unbind().click(function () {
                $('#taskUpdate')[0].reset();
                $('#showTasksModal').modal('hide');
                $('#updateTasksModal').modal('show');
                var calendor_id = $("#calendorID").val();
                $.ajax({
                    url: calendorEditTaskCalendor,
                    type: "GET",
                    dataType: 'json',
                    data: {
                        token: token,
                        branch_id: branchID,
                        calendor_id: calendor_id
                    },
                    success: function (response) {
                        if (response.code == 200) {
                            if (response.data.allDay == "1") {
                                $("#updateTasksModal").find("#editAllDayCheck").prop('checked', true);
                                $("#updateTasksModal").find("#editTimeSlot").hide();
                            } else {
                                $("#updateTasksModal").find("#editAllDayCheck").prop('checked', false);
                                $("#updateTasksModal").find("#editTimeSlot").show();
                            }
                            var startdt = moment(response.data.start).format('YYYY-MM-DD');
                            var enddt = moment(response.data.end).subtract(1, 'seconds').format('YYYY-MM-DD');
                            var starthminutes = moment(response.data.start).format('HH:mm');
                            var endhminutes = moment(response.data.end).format('HH:mm');
                            $("#updateTasksModal").find("#calendorID").val(response.data.calendor_id);
                            $("#updateTasksModal").find("#taskTitle").val(response.data.title);
                            $("#updateTasksModal").find("#edittaskfromDate").val(startdt);
                            $("#updateTasksModal").find("#edittaskToDate").val(enddt);
                            $("#updateTasksModal").find("#editTasktimeSlotStart").val(starthminutes);
                            $("#updateTasksModal").find("#editTasktimeSlotEnd").val(endhminutes);
                            $("#updateTasksModal").find("#taskDescription").val(response.data.description);

                        } else {
                            toastr.error(response.message);
                        }
                    }, error: function (err) {
                        toastr.error(err.responseJSON.data.error ? err.responseJSON.data.error : 'Something went wrong');
                    }
                });
            });
            // delete
            $("#deleteEventBtn").unbind().click(function () {
                var id = $("#calendorID").val();
                swal.fire({
                    title: 'Are you sure?',
                    html: 'You want to <b>delete</b> this',
                    showCancelButton: true,
                    showCloseButton: true,
                    cancelButtonText: 'Cancel',
                    confirmButtonText: 'Yes, Delete',
                    cancelButtonColor: '#d33',
                    confirmButtonColor: '#556ee6',
                    width: 400,
                    allowOutsideClick: false
                }).then(function (result) {
                    if (result.value) {
                        $.ajax({
                            url: calendorDeleteTaskCalendor,
                            type: "POST",
                            dataType: 'json',
                            data: {
                                token: token,
                                branch_id: branchID,
                                id: id
                            },
                            success: function (response) {
                                if (response.code == 200) {
                                    toastr.success(response.message);
                                    $('#showTasksModal').modal('hide');
                                    e.event.remove(); // try this instead
                                } else {
                                    toastr.error(response.message);
                                }
                            }, error: function (err) {
                                toastr.error(err.responseJSON.data.error ? err.responseJSON.data.error : 'Something went wrong');
                            }
                        });
                    }
                });
            });
            // rules validation
            $("#taskUpdate").validate({
                rules: {
                    title: "required",
                    taskdateSlot: "required"
                }
            });
            // update
            $('#taskUpdate').unbind().on('submit', function (event) {
                event.preventDefault();
                var taskUpdate = $("#taskUpdate").valid();
                if (taskUpdate === true) {
                    // $("#updateCalBtn").unbind().click(function () {
                    e.event.remove();
                    let calendor_id = $("#updateTasksModal").find("#calendorID").val();
                    let title = $("#updateTasksModal").find("#taskTitle").val();
                    let description = $("#updateTasksModal").find("#taskDescription").val();
                    let edittaskfromDate = $("#updateTasksModal").find("#edittaskfromDate").val();
                    let edittaskToDate = $("#updateTasksModal").find("#edittaskToDate").val();
                    let tasktimeSlotStart = $("#updateTasksModal").find("#editTasktimeSlotStart").val();
                    let tasktimeSlotEnd = $("#updateTasksModal").find("#editTasktimeSlotEnd").val();
                    var allDayCheck = $("#updateTasksModal").find('#editAllDayCheck').is(':checked');
                    if (allDayCheck === true) {
                        // var datFm = new Date(edittaskfromDate);
                        // var datTo = new Date(edittaskToDate);
                        // var startOfDayDate = new Date(datFm.getFullYear()
                        //     , datFm.getMonth()
                        //     , datFm.getDate()
                        //     , 00, 00, 01); // start day
                        // var endOfDayDate = new Date(datTo.getFullYear()
                        //     , datTo.getMonth()
                        //     , datTo.getDate()
                        //     , 23, 59, 59); // end of day
                        // var start_date = moment(startOfDayDate).format('YYYY-MM-DD HH:mm:ss');
                        // var end_date = moment(endOfDayDate).format('YYYY-MM-DD HH:mm:ss');
                        // var start_date = moment(e.start).format('YYYY-MM-DD HH:mm:ss');
                        // var end_date = moment(e.end).format('YYYY-MM-DD HH:mm:ss');
                        var startdate = edittaskfromDate + " " + "00:00:00";
                        var startend = edittaskToDate + " " + "24:00:00";

                        var start_date = moment(startdate).format('YYYY-MM-DD HH:mm:ss');
                        var end_date = moment(startend).format('YYYY-MM-DD HH:mm:ss');
                    } else {
                        var startdate = edittaskfromDate + " " + tasktimeSlotStart + ":00";
                        var startend = edittaskToDate + " " + tasktimeSlotEnd + ":00";
                        var start_date = moment(startdate).format('YYYY-MM-DD HH:mm:ss');
                        var end_date = moment(startend).format('YYYY-MM-DD HH:mm:ss');
                    }
                    $.ajax({
                        url: calendorUpdateTaskCalendor,
                        type: "POST",
                        dataType: 'json',
                        data: {
                            token: token,
                            branch_id: branchID,
                            title: title,
                            calendor_id: calendor_id,
                            description: description,
                            start: start_date,
                            end: end_date,
                            all_day: allDayCheck
                        },
                        success: function (response) {
                            var datas = response.data;
                            $('#updateTasksModal').modal('hide')
                            $('#taskUpdate')[0].reset();
                            let obj = {
                                calendor_id: datas.calendor_id,
                                title: datas.title,
                                start: datas.start,
                                end: datas.end,
                                description: datas.description,
                                className: datas.className,
                                allDay: datas.allDay
                            };
                            calendar.addEvent(obj);
                        }
                    });
                    calendar.unselect();
                }
            });
        }
    });

    calendar.render();
    // unbind model
    $("#addTasksModal").on("hidden.bs.modal", function () {
        $('#taskAdd').unbind();
    });


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
    //Call the function here.
    if (window.mobilecheck()) {
        //This will only run if the return value is true.
    }

    // window.mobilecheck = function mobileCheck() {
    //     //Do stuff here...
    //     var isMobile = true;
    //     return isMobile;
    // };

    // //This will always run because window.mobilecheck has been defined.
    // if (window.mobilecheck) {
    //     console.log("<br />Mobile check has been defined");
    // }

    // var isMobile = window.mobilecheck();
    // //We've retrieved the value from mobilecheck now.
    // if (isMobile) {
    //     console.log("<br />This is a mobile device");
    // } else {
    //     console.log("This is not a mobile device");
    // }

});
