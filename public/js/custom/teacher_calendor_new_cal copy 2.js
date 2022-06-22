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

    // var calendarEl = document.getElementById('teacher_calendor');

    // var calendar = new FullCalendar.Calendar(calendarEl, {
    //     // initialDate: '2020-09-12',
    //     initialView: 'listWeek',
    //     // defaultView: "timeGridWeek",
    //     nowIndicator: true,
    //     headerToolbar: {
    //         left: 'prev,next today',
    //         center: 'title',
    //         right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
    //     },
    //     navLinks: true, // can click day/week names to navigate views
    //     editable: true,
    //     selectable: true,
    //     selectMirror: true,
    //     dayMaxEvents: true, // allow "more" link when too many events
    //     eventSources: [{
    //         url: calendorListTaskCalendor + '?token=' + token + '&branch_id=' + branchID + '&login_id=' + userID,
    //         type: 'get',
    //         success: function (response) {
    //             s = response.data;
    //             return s;
    //         }
    //     }, {
    //         url: getTimetableCalendor + '?token=' + token + '&branch_id=' + branchID + '&teacher_id=' + ref_user_id,
    //         type: 'get',
    //         success: function (response) {
    //             t = response.data;
    //             return t;
    //         }
    //     }, {
    //         url: getEventCalendor + '?token=' + token + '&branch_id=' + branchID + '&teacher_id=' + ref_user_id,
    //         type: 'get',
    //         success: function (response) {
    //             m = response.data;
    //             return m;
    //         }
    //     }, {
    //         url: getBirthdayCalendor + '?token=' + token + '&branch_id=' + branchID + '&teacher_id=' + ref_user_id,
    //         type: 'get',
    //         success: function (response) {
    //             b = response.data;
    //             return b;
    //         }
    //     }],
    //     selectable: true,
    //     selectHelper: true,
    //     select: function (e) {
    //         // var title = prompt('Event Title:');
    //         $('#addTasksModal').modal('toggle');
    //         $('.addTasks').find('form')[0].reset();
    //         $('#saveBtn').click(function () {
    //             var title = $('#taskTitle').val();
    //             // var start_date = moment(start).format('YYYY-MM-DD');
    //             // var end_date = moment(end).format('YYYY-MM-DD');
    //             var start = e.start;
    //             var end = e.end;
    //             var start_date = moment(start).format('YYYY-MM-DD HH:mm:ss');
    //             var end_date = moment(end).format('YYYY-MM-DD HH:mm:ss');
    //             var description = $("#taskDescription").val();

    //             if (title) {
    //                 $.ajax({
    //                     url: calendorAddTaskCalendor,
    //                     type: "POST",
    //                     dataType: 'json',
    //                     data: {
    //                         token: token,
    //                         branch_id: branchID,
    //                         title: title,
    //                         start: start_date,
    //                         end: end_date,
    //                         login_id: userID,
    //                         description: description
    //                     },
    //                     success: function (response) {
    //                         var newData = response.data;
    //                         $('#addTasksModal').modal('hide')
    //                         $('.addTasks').find('form')[0].reset();
    //                         // $('#teacher_calendor').fullCalendar('renderEvent', {
    //                         //     'id': newData.id,
    //                         //     'title': newData.title,
    //                         //     'start': newData.start,
    //                         //     'end': newData.end,
    //                         //     'description': newData.description,
    //                         //     'className': newData.className
    //                         //     // 'color': newData.color
    //                         // });
    //                         var eventObject = {
    //                             id: newData.id,
    //                             title: newData.title,
    //                             start: newData.start,
    //                             end: newData.end,
    //                             description: newData.description,
    //                             className: newData.className
    //                         };
    //                         calendar.addEvent(eventObject);
    //                         // $('#teacher_calendor').fullCalendar('renderEvent', eventObject, true);
    //                         // calendar.render();
    //                         // calendar.fullCalendar('refetchEvents');
    //                     }
    //                 });
    //             } else {
    //                 $('#titleError').html("Enter title here");
    //             }
    //             calendar.unselect();

    //         });

    //     },
    //     editable: true,
    //     eventClick: function (e) {
    //         //
    //         if (e.event.extendedProps.event_id) {
    //             $('#event-modal').modal('toggle');
    //             var start = e.event.start_date;
    //             var end = e.event.end_date;
    //             var setCurDate = formatDate(end);
    //             $("#title").html(e.event.title);
    //             $("#type").html(e.event.extendedProps.event_type);
    //             $("#start_date").html(e.event.extendedProps.start_date);
    //             $("#end_date").html(e.event.extendedProps.end_date);
    //             $("#audience").html(e.event.extendedProps.class_name);
    //             $("#description").html(e.event.extendedProps.remarks);
    //             $("#setCurDate").val(setCurDate);
    //         } else if (e.event.extendedProps.birthday) {
    //             $('#birthday-modal').modal('toggle');
    //             var start = e.event.start;
    //             var end = e.event.end;
    //             var setCurDate = formatDate(end);
    //             $("#name").html(e.event.extendedProps.name);
    //             $("#setCurDate").val(setCurDate);
    //         } else if (e.event.extendedProps.time_table_id) {
    //             $('#teacher-modal').modal('toggle');
    //             var start = e.event.start;
    //             var end = e.event.end;
    //             var setCurDate = formatDate(end);
    //             $("#event-title").html(e.event.title);
    //             $("#subject-name").html(e.event.extendedProps.subject_name);
    //             $("#timing-class").html(start.toLocaleTimeString() + ' - ' + end.toLocaleTimeString());
    //             // l("#timing-class").html(start + ' - ' + end),
    //             $("#teacher-name").html(e.event.extendedProps.teacher_name);
    //             $("#standard-name").html(e.event.extendedProps.class_name);
    //             $("#section-name").html(e.event.extendedProps.section_name);
    //             $("#ttclassID").val(e.event.extendedProps.class_id);
    //             $("#ttSectionID").val(e.event.extendedProps.section_id);
    //             $("#ttSubjectID").val(e.event.extendedProps.subject_id);
    //             $("#calNotes").val(e.event.extendedProps.report);
    //             $("#ttDate").val(e.event.end);
    //             $("#setCurDate").val(setCurDate);
    //         } else {
    //             $('#showTasksModal').modal('toggle');
    //             $("#taskShowTit").html(e.event.title);
    //             $("#taskShowDesc").html(e.event.extendedProps.description);
    //         }
    //     }
    // });
    var calendarEl = document.getElementById('teacher_calendor');

    var calendar = new FullCalendar.Calendar(calendarEl, {
        plugins: ["bootstrap", "interaction", "dayGrid", "timeGrid", "list"],
        slotDuration: "00:10:00",
        minTime: "08:00:00",
        maxTime: "19:00:00",
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
            url: getBirthdayCalendor + '?token=' + token + '&branch_id=' + branchID + '&teacher_id=' + ref_user_id,
            type: 'get',
            success: function (response) {
                b = response.data;
                return b;
            }
        }],
        // selectable: true,
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
            } else if (e.event.extendedProps.birthday) {
                $('#birthday-modal').modal('toggle');
                var start = e.event.start;
                var end = e.event.end;
                var setCurDate = formatDate(end);
                $("#name").html(e.event.extendedProps.name);
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
                $("#calNotes").val(e.event.extendedProps.report);
                $("#ttDate").val(e.event.end);
                $("#setCurDate").val(setCurDate);
            } else {
                $('#showTasksModal').modal('toggle');
                $("#taskShowTit").html(e.event.title);
                $("#taskShowDesc").html(e.event.extendedProps.description);
            }
        }
        // events: [{
        //     title: 'All Day Event',
        //     start: '2022-06-01',
        // },
        // {
        //     title: 'Long Event',
        //     start: '2022-06-07',
        //     end: '2022-06-10'
        // },
        // {
        //     groupId: 999,
        //     title: 'Repeating Event',
        //     start: '2022-06-06T16:00:00'
        // },
        // {
        //     groupId: 999,
        //     title: 'Repeating Event',
        //     start: '2022-06-16T16:00:00'
        // },
        // {
        //     title: 'Conference',
        //     start: '2022-06-11',
        //     end: '2022-06-13'
        // },
        // {
        //     title: 'Meeting',
        //     start: '2022-06-12T10:30:00',
        //     end: '2022-06-12T12:30:00'
        // },
        // {
        //     title: 'Lunch',
        //     start: '2022-06-12T12:00:00'
        // },
        // {
        //     title: 'Meeting',
        //     start: '2022-06-12T14:30:00'
        // },
        // {
        //     title: 'Happy Hour',
        //     start: '2022-06-12T17:30:00'
        // },
        // {
        //     title: 'Dinner',
        //     start: '2022-06-12T20:00:00'
        // },
        // {
        //     title: 'Birthday Party',
        //     start: '2022-06-13T07:00:00'
        // },
        // {
        //     title: 'Click for Google',
        //     url: 'http://google.com/',
        //     start: '2022-06-28'
        // }
        // ]
    });

    calendar.render();
    // calendar.render();
    // unbind model
    $("#addTasksModal").on("hidden.bs.modal", function () {
        $('#saveBtn').unbind();
    });
});
