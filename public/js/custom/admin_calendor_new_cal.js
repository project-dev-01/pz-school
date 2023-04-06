$(document).ready(function () {
    // check wether mobile or not
    window.mobilecheck = function () {
        var check = false;
        (function (a) { if (/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i.test(a) || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0, 4))) check = true; })(navigator.userAgent || navigator.vendor || window.opera);
        return check;
    };
    var calendarEl = document.getElementById('new_calendor');

    var calendar = new FullCalendar.Calendar(calendarEl, {
        plugins: ["bootstrap", "interaction", "dayGrid", "timeGrid", "list"],
        slotDuration: "00:15:00",
        // minTime: "08:00:00",
        // maxTime: "19:00:00",
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
        defaultView: window.mobilecheck() ? "listMonth" : "dayGridMonth",
        displayEventTime: false,
        handleWindowResize: !0,
        // height: (window).height() - 200,
        header: {
            left: "prev,next today",
            center: "title",
            right: "dayGridMonth,timeGridWeek,timeGridDay,listMonth"
        },
        locale: langCalendar,
        // events: t,
        editable: !0,
        // editable: true,
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
            url: getEventGroupCalendorAdmin + '?token=' + token + '&branch_id=' + branchID,
            type: 'get',
            success: function (response) {
                g = response.data;
                return g;
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
            var start_dt = moment(e.start).format('DD-MM-YYYY');
            // var start_dt = moment(e.start).format('DD-MM-YYYY dddd hh:mm A');
            var subonesec = moment(e.end).subtract(1, 'seconds').format('DD-MM-YYYY');
            // var subonesec = moment(e.end).subtract(1, 'seconds').format('DD-MM-YYYY dddd hh:mm A');

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
                            let eventObject = {
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
                if (e.event.extendedProps.all_day == null) {
                    $("#start_time").html(e.event.extendedProps.start_time);
                    $("#end_time").html(e.event.extendedProps.end_time);
                    $("#start_time_row").show();
                    $("#end_time_row").show();
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
                var start_dt = moment(e.event.start).format('DD-MM-YYYY');
                // var start_dt = moment(e.event.start).format('DD-MM-YYYY dddd hh:mm A');
                var subonesec = moment(e.event.end).subtract(1, 'seconds').format('DD-MM-YYYY');
                // var subonesec = moment(e.event.end).subtract(1, 'seconds').format('DD-MM-YYYY dddd hh:mm A');

                $('#showTasksModal').modal('toggle');
                $("#calendorID").val(e.event.id);
                $("#startDateDetails").html(start_dt);
                $("#endDateDetails").html(subonesec);
                $("#taskShowTit").html(e.event.title);
                $("#taskShowDesc").html(e.event.extendedProps.description);
            }
            $("#editEventBtn").unbind().click(function () {
                $('#taskUpdate')[0].reset();
                // $(document).on('click', '#deleteEventBtn', function () {
                // var id = $("#calendorID").val();
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
                            var start_dt = moment(response.data.start).format('DD-MM-YYYY');
                            var subonesec = moment(response.data.end).subtract(1, 'seconds').format('DD-MM-YYYY');
                            $("#updateTasksModal").find("#calendorID").val(response.data.id);
                            $("#updateTasksModal").find("#taskTitle").val(response.data.title);
                            $("#updateTasksModal").find("#taskDescription").val(response.data.description);
                            $("#updateTasksModal").find("#startDate").html(start_dt);
                            $("#updateTasksModal").find("#endDate").html(subonesec);
                        } else {
                            toastr.error(response.message);
                        }
                    }, error: function (err) {
                        console.log(err);
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
            // update
            $("#updateCalBtn").unbind().click(function () {
                e.event.remove();
                let calendor_id = $("#updateTasksModal").find("#calendorID").val();
                let title = $("#updateTasksModal").find("#taskTitle").val();
                let description = $("#updateTasksModal").find("#taskDescription").val();
                if (title) {
                    $.ajax({
                        url: calendorUpdateTaskCalendor,
                        type: "POST",
                        dataType: 'json',
                        data: {
                            token: token,
                            branch_id: branchID,
                            title: title,
                            calendor_id: calendor_id,
                            description: description
                        },
                        success: function (response) {
                            var datas = response.data;
                            $('#updateTasksModal').modal('hide')
                            $('#taskUpdate')[0].reset();
                            let obj = {
                                id: datas.id,
                                title: datas.title,
                                start: datas.start,
                                end: datas.end,
                                description: datas.description,
                                className: datas.className
                            };
                            calendar.addEvent(obj);
                        }
                    });
                } else {
                    $('#titleError').html("Enter title here");
                }
                calendar.unselect();

            });
        }
    });

    calendar.render();
    // unbind model
    $("#addTasksModal").on("hidden.bs.modal", function () {
        $('#saveBtn').unbind();
    });
    // unbind model
    // $("#updateTasksModal").on("hidden.bs.modal", function () {
    //     $('#updateCalBtn').unbind();
    // });
    


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

    function GetCalendarDateRange() {
        var calendar = $('#new_calendor').fullCalendar('getCalendar');
        var view = calendar.view;
        var start = view.start._d;
        var end = view.end._d;
        var dates = { start: start, end: end };
        return dates;
    }
});
