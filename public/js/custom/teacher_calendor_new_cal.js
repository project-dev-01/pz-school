$(document).ready(function () {

    // go to classroom
    $("#goToClassRoom").on("click", function () {

        var ttclassID = $("#ttclassID").val();
        var ttSectionID = $("#ttSectionID").val();
        var ttSubjectID = $("#ttSubjectID").val();
        var ttDate = $("#ttDate").val();
        var sectionName = $("#section-name").text();
        var subjectName = $("#subject-name").text();

        sessionStorage.removeItem("classroom_details");
        var classDetails = new Object();
        classDetails.class_id = ttclassID;
        classDetails.section_id = ttSectionID;
        classDetails.section_name = sectionName;
        classDetails.subject_id = ttSubjectID;
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
        displayEventTime: false,
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
            url: calendorListTaskCalendor + '?token=' + token + '&branch_id=' + branchID + '&login_id=' + userID,
            type: 'get',
            success: function (response) {
                s = response.data;
                return s;
            }
        }, {
            url: getTimetableCalendor + '?token=' + token + '&branch_id=' + branchID + '&teacher_id=' + ref_user_id,
            type: 'get',
            success: function (response) {
                t = response.data;
                return t;
            }
        }, {
            url: getEventCalendor + '?token=' + token + '&branch_id=' + branchID + '&teacher_id=' + ref_user_id,
            type: 'get',
            success: function (response) {
                m = response.data;
                return m;
            }
        }, {
            url: getEventGroupCalendor + '?token=' + token + '&branch_id=' + branchID + '&teacher_id=' + ref_user_id,
            type: 'get',
            success: function (response) {
                g = response.data;
                return g;
            }
        }, {
            url: getBirthdayCalendor + '?token=' + token + '&branch_id=' + branchID + '&teacher_id=' + ref_user_id,
            type: 'get',
            success: function (response) {
                b = response.data;
                return b;
            }
        }, {
            url: getBulkCalendor + '?token=' + token + '&branch_id=' + branchID + '&teacher_id=' + ref_user_id,
            type: 'get',
            success: function (response) {
                c = response.data;
                return c;
            }
        }, {
            url: getScheduleExamDetailsUrl + '?token=' + token + '&branch_id=' + branchID + '&teacher_id=' + ref_user_id,
            type: 'get',
            success: function (response) {
                dd = response.data;
                return dd;
            }
        }],
        // selectable: true,
        selectHelper: true,
        select: function (e) {
            // var title = prompt('Event Title:');
            $('#addTasksModal').modal('toggle');
            $('.addTasks').find('form')[0].reset();
            var start_dt = moment(e.start).format('DD-MM-YYYY dddd hh:mm A');
            var subonesec = moment(e.end).subtract(1, 'seconds').format('DD-MM-YYYY dddd hh:mm A');
            // var end_dt = moment(e.end).format('DD-MM-YYYY dddd hh:mm A');
            $("#startDate").html(start_dt);
            $("#endDate").html(subonesec);

            $('#saveBtn').click(function () {
                var title = $('#taskTitle').val();
                // var start_date = moment(start).format('YYYY-MM-DD');
                // var end_date = moment(end).format('YYYY-MM-DD');
                var start = e.start;
                var end = e.end;
                var start_date = moment(start).format('YYYY-MM-DD HH:mm:ss');
                var end_date = moment(end).format('YYYY-MM-DD HH:mm:ss');
                var description = $("#taskDescription").val();

                if (title) {
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
                            description: description
                        },
                        success: function (response) {
                            var newData = response.data;
                            $('#addTasksModal').modal('hide')
                            $('.addTasks').find('form')[0].reset();
                            var eventObject = {
                                id: newData.id,
                                title: newData.title,
                                start: newData.start,
                                end: newData.end,
                                description: newData.description,
                                className: newData.className
                            };
                            calendar.addEvent(eventObject);
                        }
                    });
                } else {
                    $('#titleError').html("Enter title here");
                }
                calendar.unselect();

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
                if(e.event.extendedProps.all_day == null) {
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
            } else {
                var start_dt = moment(e.event.start).format('DD-MM-YYYY dddd hh:mm A');
                var subonesec = moment(e.event.end).subtract(1, 'seconds').format('DD-MM-YYYY dddd hh:mm A');

                $('#showTasksModal').modal('toggle');
                $("#calendorID").val(e.event.id);
                $("#startDateDetails").html(start_dt);
                $("#endDateDetails").html(subonesec);
                $("#taskShowTit").html(e.event.title);
                $("#taskShowDesc").html(e.event.extendedProps.description);
                // delete
                $('#deleteEventBtn').click(function () {
                    // $(document).on('click', '#deleteEventBtn', function () {
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
            }
        }
    });

    calendar.render();
    // calendar.render();
    // unbind model
    $("#addTasksModal").on("hidden.bs.modal", function () {
        $('#saveBtn').unbind();
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
});
