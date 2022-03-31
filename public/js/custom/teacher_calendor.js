! function (l) {
    "use strict";
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

    function e() {
        this.$body = l("body"), this.$modal = l("#teacher-modal"), this.$calendar = l("#teacher_calendor"), this.$formEvent = l("#addDailyReport"), this.$btnNewEvent = l("#btn-new-event"), this.$btnDeleteEvent = l("#btn-delete-event"), this.$btnSaveEvent = l("#btn-save-event"), this.$modalTitle = l("#modal-title"), this.$calendarObj = null, this.$selectedEvent = null, this.$newEventData = null
    }
    e.prototype.onEventClick = function (e) {

        var start = e.event.start;
        var end = e.event.end;
        var setCurDate = formatDate(end);
        console.log("--------")
        console.log(start)
        console.log(e.event)
        console.log(end)
        this.$formEvent[0].reset(), this.$formEvent.removeClass("was-validated"), this.$newEventData = null, this.$btnDeleteEvent.show(), this.$modalTitle.text("Edit Event"), this.$modal.modal({
            backdrop: "static"
        }), this.$selectedEvent = e.event,
            l("#event-title").html(this.$selectedEvent.title),
            l("#subject-name").html(e.event.extendedProps.subject_name),
            l("#timing-class").html(start.toLocaleTimeString() + ' - ' + end.toLocaleTimeString()),
            l("#teacher-name").html(e.event.extendedProps.teacher_name)
        l("#standard-name").html(e.event.extendedProps.class_name)
        l("#section-name").html(e.event.extendedProps.section_name),
            l("#ttclassID").val(e.event.extendedProps.class_id),
            l("#ttSectionID").val(e.event.extendedProps.section_id),
            l("#ttSubjectID").val(e.event.extendedProps.subject_id),
            l("#calNotes").val(e.event.extendedProps.report),
            l("#ttDate").val(e.event.end),
            l("#setCurDate").val(setCurDate)

        // l("#event-category").val(this.$selectedEvent.classNames[0])
    },
        e.prototype.init = function () {

            var t = [],

                a = this;
            a.$calendarObj = new FullCalendar.Calendar(a.$calendar[0], {
                plugins: ["bootstrap", "interaction", "dayGrid", "timeGrid", "list"],
                slotDuration: "00:15:00",
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
                // defaultView: "dayGridMonth",
                defaultView: "timeGridWeek",
                handleWindowResize: !0,
                height: l(window).height() - 200,
                header: {
                    left: "prev,next today",
                    center: "title",
                    right: "dayGridMonth,timeGridWeek,timeGridDay,listMonth"
                },
                // get events details start
                eventSources: [{
                    url: getTimetableCalendor + '?token=' + token + '&branch_id=' + branchID + '&teacher_id=' + ref_user_id,
                    type: 'get',
                    success: function (response) {
                        t = response.data;
                        console.log(t)
                        return t;
                    }
                }],
                // get events details start
                editable: !0,
                droppable: !0,
                // eventLimit: !0,
                eventLimit: true, // allow "more" link when too many events
                eventLimitText: "More", //sets the text for more events
                selectable: !0,
                dateClick: function (e) {
                    a.onSelect(e)
                },
                eventClick: function (e) {
                    a.onEventClick(e)
                }
            }), a.$calendarObj.render(), a.$btnNewEvent.on("click", function (e) {
                a.onSelect({
                    date: new Date,
                    allDay: !0
                })
            })
        }, l.CalendarApp = new e, l.CalendarApp.Constructor = e
}(window.jQuery),
    function () {
        "use strict";
        window.jQuery.CalendarApp.init()
    }();