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
                // console.log(userID);
                // console.log("jsdfdsfj");
                // console.log(response)
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
        }],
        selectable: true,
        selectHelper: true,
        select: function (e) {
            // var title = prompt('Event Title:');
            $('#addTasksModal').modal('toggle');
            $('.addTasks').find('form')[0].reset();
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
                            // $('#teacher_calendor').fullCalendar('renderEvent', {
                            //     'id': newData.id,
                            //     'title': newData.title,
                            //     'start': newData.start,
                            //     'end': newData.end,
                            //     'description': newData.description,
                            //     'className': newData.className
                            //     // 'color': newData.color
                            // });
                            var eventObject = {
                                id: newData.id,
                                title: newData.title,
                                start: newData.start,
                                end: newData.end,
                                description: newData.description,
                                className: newData.className
                            };
                            calendar.addEvent(eventObject);
                            // $('#teacher_calendor').fullCalendar('renderEvent', eventObject, true);
                            // calendar.render();
                            // calendar.fullCalendar('refetchEvents');
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
            }  else {
                console.log(e)
                console.log(e.event)
                $('#showTasksModal').modal('toggle');
                $("#taskShowTit").html(e.event.title);
                $("#taskShowDesc").html(e.event.extendedProps.description);
            }
        }
    });

    calendar.render();
    // unbind model
    $("#addTasksModal").on("hidden.bs.modal", function () {
        $('#saveBtn').unbind();
    });
});
