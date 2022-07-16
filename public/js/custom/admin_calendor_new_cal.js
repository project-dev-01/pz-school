$(document).ready(function () {
    var calendarEl = document.getElementById('new_calendor');

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
            url: calendorListTaskCalendor + '?token=' + token + '&branch_id=' + branchID + '&login_id=' + userID,
            type: 'get',
            success: function (response) {
                m = response.data;
                return m;
            }
        }, {
            url: getBirthdayCalendorAdmin + '?token=' + token + '&branch_id=' + branchID,
            type: 'get',
            success: function (response) {
                b = response.data;
                return b;
            }
        }, {
            url: getEventCalendorAdmin + '?token=' + token + '&branch_id=' + branchID,
            type: 'get',
            success: function (response) {
                m = response.data;
                return m;
            }
        }, {
            url: getBulkCalendor + '?token=' + token + '&branch_id=' + branchID,
            type: 'get',
            success: function (response) {
                c = response.data;
                return c;
            }
        }, {
            url: getScheduleExamDetailsUrl + '?token=' + token + '&branch_id=' + branchID,
            type: 'get',
            success: function (response) {
                dd = response.data;
                return dd;
            }
        }],
        selectable: true,
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
            // save
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
                $('#admin-modal').modal('toggle');
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
                $("#audience").html(e.event.extendedProps.class_name);
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
            }
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
    });

    calendar.render();
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
