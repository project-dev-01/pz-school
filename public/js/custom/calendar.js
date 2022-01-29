! function (l) {
    "use strict";

    function e() {
        this.$body = l("body"), this.$modal = l("#event-modal"), this.$calendar = l("#calendar"), this.$formEvent = l("#form-event"), this.$btnNewEvent = l("#btn-new-event"), this.$btnDeleteEvent = l("#btn-delete-event"), this.$btnSaveEvent = l("#btn-save-event"), this.$modalTitle = l("#modal-title"), this.$calendarObj = null, this.$selectedEvent = null, this.$newEventData = null
    }
    e.prototype.onEventClick = function (e) {
        console.log("event click");
        console.log(e);
        console.log(e.event);
        console.log(e.event.extendedProps.subject);

        this.$formEvent[0].reset(), this.$formEvent.removeClass("was-validated"), this.$newEventData = null, this.$btnDeleteEvent.show(), this.$modalTitle.text("Edit Event"), this.$modal.modal({
            backdrop: "static"
        }), this.$selectedEvent = e.event,
            l("#event-title").html(this.$selectedEvent.title),
            l("#subject-name").html(e.event.extendedProps.subject),
            l("#timing-class").html(e.event.extendedProps.timing),
            l("#teacher-name").html(e.event.extendedProps.teachername),
            l("#event-category").val(this.$selectedEvent.classNames[0])
    }
        ,
        // e.prototype.onSelect = function (e) {
        //     this.$formEvent[0].reset(), this.$formEvent.removeClass("was-validated"), this.$selectedEvent = null, this.$newEventData = e, this.$btnDeleteEvent.hide(), this.$modalTitle.text("Add New Event"), this.$modal.modal({
        //         backdrop: "static"
        //     }), this.$calendarObj.unselect()
        // }, 
        e.prototype.init = function () {
            var e = new Date(l.now());
            new FullCalendarInteraction.Draggable(document.getElementById("external-events"), {
                itemSelector: ".external-event",
                eventData: function (e) {
                    return {
                        title: e.innerText,
                        className: l(e).data("class")
                    }
                }
            });
            // console.log("-0-0-0-0-0-0-")
            // console.log(new Date(l.now() + 158e6))
            // console.log(e)
            var t = [{
                title: "English-(09:00AM - 10:00AM)",
                subject: "English",
                timing: "09:00 AM - 10:00 AM",
                teachername: "Sandy",
                start: new Date(l.now() + 158e6),
                // end: new Date(l.now() + 338e6),
                className: "bg-warning"
            }, {
                title: "Maths-(10:00AM - 11:00AM)",
                subject: "Maths",
                timing: "10:00 AM - 11:00 AM",
                teachername: "Stella",
                start: new Date(l.now() + 158e6),
                // end: e,
                className: "bg-primary"
            },
            {
                title: "Maths-(10:00AM - 11:00AM)",
                subject: "Maths",
                timing: "10:00 AM - 11:00 AM",
                teachername: "Stella",
                start: e,
                // end: e,
                className: "bg-primary"
            }, {
                title: "Geography-(12:00AM - 01:00PM)",
                subject: "Geography",
                timing: "12:00 AM - 01:00 PM",
                teachername: "Amelia",
                start: new Date(l.now() + 168e6),
                className: "bg-info"
            }, {
                title: "Maths-(02:00PM - 03:00PM)-Emma",
                subject: "Maths",
                timing: "02:00 PM - 03:00 PM",
                teachername: "Emma",
                start: new Date(l.now() + 338e6),
                // end: new Date(l.now() + 4056e5),
                className: "bg-primary"
            }],
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
                events: t,
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
            }), a.$formEvent.on("submit", function (e) {
                e.preventDefault();
                var t = a.$formEvent[0];
                if (t.checkValidity()) {
                    if (a.$selectedEvent) a.$selectedEvent.setProp("title", l("#event-title").val()), a.$selectedEvent.setProp("classNames", [l("#event-category").val()]);
                    else {
                        var n = {
                            title: l("#event-title").val(),
                            start: a.$newEventData.date,
                            allDay: a.$newEventData.allDay,
                            className: l("#event-category").val()
                        };
                        a.$calendarObj.addEvent(n)
                    }
                    a.$modal.modal("hide")
                } else e.stopPropagation(), t.classList.add("was-validated")
            }), l(a.$btnDeleteEvent.on("click", function (e) {
                a.$selectedEvent && (a.$selectedEvent.remove(), a.$selectedEvent = null, a.$modal.modal("hide"))
            }))
        }, l.CalendarApp = new e, l.CalendarApp.Constructor = e
}(window.jQuery),
    function () {
        "use strict";
        window.jQuery.CalendarApp.init()
    }();