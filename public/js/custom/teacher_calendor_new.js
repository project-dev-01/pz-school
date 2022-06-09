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
    
    var calendar = $('#teacher_calendor').fullCalendar({
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
                console.log("calendorListTaskCalendor");
                console.log(response)
                s = response.data;
                return s;
            }
        }, {
            url: getTimetableCalendor + '?token=' + token + '&branch_id=' + branchID + '&teacher_id=' + ref_user_id,
            type: 'get',
            success: function (response) {
                console.log("getTimetableCalendor");
                console.log(response)
                t = response.data;
                return t;
            }
        }, {
            url: getEventCalendor + '?token=' + token + '&branch_id=' + branchID + '&teacher_id=' + ref_user_id,
            type: 'get',
            success: function (response) {
                console.log("getEventCalendor");
                console.log(response)
                m = response.data;
                return m;
            }
        }, {
            url: getBirthdayCalendor + '?token=' + token + '&branch_id=' + branchID + '&teacher_id=' + ref_user_id,
            type: 'get',
            success: function (response) {
                console.log("getBirthdayCalendor");
                console.log(response)
                b = response.data;
                return b;
            }
        }],
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
                            $('#teacher_calendor').fullCalendar('renderEvent', {
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
                // var setCurDate = formatDate(end);
                $("#name").html(event.name);
                // $("#setCurDate").val(setCurDate);
            } else if (event.event_id) {
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

            } else if (event.class_id) {
                console.log("*****88")
                console.log(event.class_id)
                console.log(event)
                console.log(typeof event.start)
                $('#teacher-modal').modal('toggle');
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

            } else {
                $('#showTasksModal').modal('toggle');
                $("#taskShowTit").html(event.title);
                $("#taskShowDesc").html(description);
            }
        }
    });
    // unbind model
    $("#addTasksModal").on("hidden.bs.modal", function () {
        $('#saveBtn').unbind();
    });
});
