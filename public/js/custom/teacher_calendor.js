! function (l) {
    "use strict";

    function e() {
        this.$body = l("body"), this.$modal = l("#teacher-modal"), this.$calendar = l("#teacher_calendor"), this.$formEvent = l("#form-event"), this.$btnNewEvent = l("#btn-new-event"), this.$btnDeleteEvent = l("#btn-delete-event"), this.$btnSaveEvent = l("#btn-save-event"), this.$modalTitle = l("#modal-title"), this.$calendarObj = null, this.$selectedEvent = null, this.$newEventData = null
    }
    e.prototype.onEventClick = function (e) {
        console.log("event click");
        // console.log(e);
        console.log(e.event);
        console.log(e.event.id);
        console.log(e.event.title);
        console.log(e.event.start);
        console.log(e.event.end);
        console.log(e.event.extendedProps.subject_name);
        console.log(e.event.extendedProps.teacher_name);
        console.log(e.event.extendedProps.class_name);
        console.log(e.event.extendedProps.section_name);
        var start = e.event.start;
        var end = e.event.end;
        // console.log(e.event.extendedProps.start);
        // console.log(e.event.extendedProps.end);
        // console.log(e.event.extendedProps.subject_name);
        // console.log(e.event.extendedProps.title);
        // console.log(e.event.extendedProps.teacher_name);

        this.$formEvent[0].reset(), this.$formEvent.removeClass("was-validated"), this.$newEventData = null, this.$btnDeleteEvent.show(), this.$modalTitle.text("Edit Event"), this.$modal.modal({
            backdrop: "static"
        }), this.$selectedEvent = e.event,
            l("#event-title").html(this.$selectedEvent.title),
            l("#subject-name").html(e.event.extendedProps.subject_name),
            l("#timing-class").html(start.toLocaleTimeString() + ' - ' + end.toLocaleTimeString()),
            l("#teacher-name").html(e.event.extendedProps.teacher_name)
        // l("#event-category").val(this.$selectedEvent.classNames[0])
    },
        e.prototype.init = function () {

            // var e = new Date(l.now());
            // // current date
            // var d = new Date();
            // var formData = new FormData();
            // formData.append('token', token);
            // formData.append('branch_id', branchID);
            // formData.append('teacher_id', ref_user_id);
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
                eventLimit: !0,
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