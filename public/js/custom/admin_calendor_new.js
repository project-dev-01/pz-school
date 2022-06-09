$(document).ready(function () {

    // $.ajaxSetup({
    //     headers: {
    //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //     }
    // });

    var calendar = $('#new_calendor').fullCalendar({
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
        }],
        // eventSources: [
        //     {
        //         events: function (start, end, timezone, callback) {
        //             $.ajax({
        //                 url: calendorListTaskCalendor + '?token=' + token + '&branch_id=' + branchID + '&login_id=' + userID,
        //                 type: 'GET',
        //                 headers: {
        //                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //                 }, success: function (response) {
        //                     var events = [];
        //                     $(response['data']).each(function () {
        //                         events.push({
        //                             id: $(this).attr('id'),
        //                             title: $(this).attr('title'),
        //                             start: $(this).attr('start'),
        //                             end: $(this).attr('end'),
        //                             className: $(this).attr('className'),
        //                             allDay: $(this).attr('allDay'),
        //                         });
        //                     });
        //                     console.log(events);
        //                     callback(events);
        //                 }
        //             });
        //         }
        //     }
        // ],
        selectable: true,
        selectHelper: true,
        select: function (start, end, allDay) {
            // var title = prompt('Event Title:');
            $('#addTasksModal').modal('toggle');
            $('#saveBtn').click(function () {
                var title = $('#taskTitle').val();
                // var start_date = moment(start).format('YYYY-MM-DD');
                // var end_date = moment(end).format('YYYY-MM-DD');
                var start_date = $.fullCalendar.formatDate(start, 'Y-MM-DD HH:mm:ss');
                var end_date = $.fullCalendar.formatDate(end, 'Y-MM-DD HH:mm:ss');
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
                            $('#new_calendor').fullCalendar('renderEvent', {
                                'id': newData.id,
                                'title': newData.title,
                                'start': newData.start,
                                'end': newData.end,
                                'description': newData.description,
                                'className': newData.className
                                // 'color': newData.color
                            });
                            // calendar.fullCalendar('refetchEvents');
                        }
                    });
                } else {
                    $('#titleError').html("Enter title here");
                }

            });

        },
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

            if (event.birthday) {
                $('#birthday-modal').modal('toggle');
                var start = event.start;
                var end = event.end;
                var setCurDate = formatDate(end);
                $("#name").html(event.name);
                $("#setCurDate").val(setCurDate);
            } else if (event.event_id) {
                $('#admin-modal').modal('toggle');
                var start = event.start_date;
                var end = event.end_date;
                var setCurDate = formatDate(end);
                $("#title").html(event.title);
                $("#type").html(event.event_type);
                $("#start_date").html(event.start_date);
                $("#end_date").html(event.end_date);
                $("#audience").html(event.class_name);
                $("#description").html(event.remarks);
                $("#setCurDate").val(setCurDate);
            } else {
                $('#showTasksModal').modal('toggle');
                $("#taskShowTit").html(event.title);
                $("#taskShowDesc").html(description);

                // this.$modal = l("#admin-modal")
                // var start = e.event.start_date;
                // var end = e.event.end_date;
                // var setCurDate = formatDate(end);
                // this.$newEventData = null, this.$btnDeleteEvent.show(), this.$modalTitle.text("Edit Event"), this.$modal.modal({
                //     backdrop: "static"
                // }), this.$selectedEvent = e.event,
                //     l("#title").html(this.$selectedEvent.title),
                //     l("#type").html(e.event.extendedProps.event_type),
                //     l("#start_date").html(e.event.extendedProps.start_date),
                //     l("#end_date").html(e.event.extendedProps.end_date),
                //     l("#audience").html(e.event.extendedProps.class_name),
                //     l("#description").html(e.event.extendedProps.remarks)
                // l("#setCurDate").val(setCurDate)
            }
            // if (confirm("Are you sure you want to remove it?")) {
            //     var id = event.id;
            //     $.ajax({
            //         url: "/full-calender/action",
            //         type: "POST",
            //         data: {
            //             id: id,
            //             type: "delete"
            //         },
            //         success: function (response) {
            //             calendar.fullCalendar('refetchEvents');
            //             alert("Event Deleted Successfully");
            //         }
            //     })
            // }
        }
    });
    // unbind model
    $("#addTasksModal").on("hidden.bs.modal", function () {
        $('#saveBtn').unbind();
    });
});
