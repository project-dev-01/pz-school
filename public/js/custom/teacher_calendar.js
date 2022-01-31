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

            // current date
            var d = new Date();
            
            var currentD = formatDate(d);
            var currentDPlusOne = formatDate(d.setDate(d.getDate() + 1));
            var currentDPlusTwo = formatDate(d.setDate(d.getDate() + 1));
            var currentDPlusThree = formatDate(d.setDate(d.getDate() + 1));
            var currentDPlusFour = formatDate(d.setDate(d.getDate() + 1));

            var t = [
                // today day 1
                {
                    title: "English-(08:30AM - 09:30AM)",
                    subject: "English",
                    timing: "08:30 AM - 09:30 AM",
                    teachername: "Sandy",
                    start: currentD + " 08:30:00",
                    // start: start.setHours(start.getHours() + 8),
                    // end: new Date(l.now() + 338e6),
                    className: "bg-warning"
                },
                {
                    title: "English-(10:30AM - 11:30AM)",
                    subject: "English",
                    timing: "10:30 AM - 11:30 AM",
                    teachername: "Sandy",
                    start: currentD + " 10:30:00",
                    // end: e,
                    className: "bg-warning"
                }, {
                    title: "English -(01:30PM - 02:30PM)-Emma",
                    subject: "English",
                    timing: "01:30PM - 02:30PM",
                    teachername: "Sandy",
                    start: currentD + " 13:30:00",
                    // end: new Date(l.now() + 4056e5),
                    className: "bg-warning"
                },
                // tommorrow day 2
                
                {
                    title: "English-(10:30AM - 11:30AM)",
                    subject: "English",
                    timing: "10:30 AM - 11:30 AM",
                    teachername: "Sandy",
                    start: currentDPlusOne + " 10:30:00",
                    // end: e,
                    className: "bg-warning"
                }, {
                    title: "English -(01:30PM - 02:30PM)-Emma",
                    subject: "English",
                    timing: "01:30PM - 02:30PM",
                    teachername: "Sandy",
                    start: currentDPlusOne + " 13:30:00",
                    // end: new Date(l.now() + 4056e5),
                    className: "bg-warning"
                },
                {
                    title: "English-(02:30AM - 03:30AM)",
                    subject: "English",
                    timing: "02:30 AM - 03:30 AM",
                    teachername: "Sandy",
                    start: currentDPlusOne + " 14:30:00",
                    // start: start.setHours(start.getHours() + 8),
                    // end: new Date(l.now() + 338e6),
                    className: "bg-warning"
                },
                // day 3
                {
                    title: "English-(09:30AM - 10:30AM)",
                    subject: "English",
                    timing: "09:30 AM - 10:30 AM",
                    teachername: "Sandy",
                    start: currentDPlusTwo + " 09:30:00",
                    // start: start.setHours(start.getHours() + 8),
                    // end: new Date(l.now() + 338e6),
                    className: "bg-warning"
                },
                {
                    title: "English-(10:30AM - 11:30AM)",
                    subject: "English",
                    timing: "10:30 AM - 11:30 AM",
                    teachername: "Sandy",
                    start: currentDPlusTwo + " 10:30:00",
                    // end: e,
                    className: "bg-warning"
                }, {
                    title: "English -(01:30PM - 02:30PM)-Emma",
                    subject: "English",
                    timing: "01:30PM - 02:30PM",
                    teachername: "Sandy",
                    start: currentDPlusTwo + " 13:30:00",
                    // end: new Date(l.now() + 4056e5),
                    className: "bg-warning"
                },
                // day 4
                {
                    title: "English-(08:30AM - 09:30AM)",
                    subject: "English",
                    timing: "08:30 AM - 09:30 AM",
                    teachername: "Sandy",
                    start: currentDPlusThree + " 08:30:00",
                    // start: start.setHours(start.getHours() + 8),
                    // end: new Date(l.now() + 338e6),
                    className: "bg-warning"
                },
                {
                    title: "English-(11:30AM - 12:30PM)",
                    subject: "English",
                    timing: "11:30 AM - 12:30 PM",
                    teachername: "Sandy",
                    start: currentDPlusThree + " 11:30:00",
                    // end: e,
                    className: "bg-warning"
                }, {
                    title: "English -(01:30PM - 02:30PM)-Emma",
                    subject: "English",
                    timing: "01:30PM - 02:30PM",
                    teachername: "Sandy",
                    start: currentDPlusThree + " 13:30:00",
                    // end: new Date(l.now() + 4056e5),
                    className: "bg-warning"
                },
                // day 5
                {
                    title: "English-(08:30AM - 09:30AM)",
                    subject: "English",
                    timing: "08:30 AM - 09:30 AM",
                    teachername: "Sandy",
                    start: currentDPlusFour + " 08:30:00",
                    // start: start.setHours(start.getHours() + 8),
                    // end: new Date(l.now() + 338e6),
                    className: "bg-warning"
                },
                {
                    title: "English-(10:30AM - 11:30AM)",
                    subject: "English",
                    timing: "10:30 AM - 11:30 AM",
                    teachername: "Sandy",
                    start: currentDPlusFour + " 10:30:00",
                    // end: e,
                    className: "bg-warning"
                }, {
                    title: "English -(02:30PM - 03:30PM)-Emma",
                    subject: "English",
                    timing: "02:30 PM - 03:30 PM",
                    teachername: "Sandy",
                    start: currentDPlusFour + " 14:30:00",
                    // end: new Date(l.now() + 4056e5),
                    className: "bg-warning"
                }
            ],
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