! function (l) {
    "use strict";

    function e() {
        this.$body = l("body"), this.$modal = l("#teacher-modal"), this.$calendar = l("#teacher_calendor"), this.$formEvent = l("#form-event"), this.$btnNewEvent = l("#btn-new-event"), this.$btnDeleteEvent = l("#btn-delete-event"), this.$btnSaveEvent = l("#btn-save-event"), this.$modalTitle = l("#modal-title"), this.$calendarObj = null, this.$selectedEvent = null, this.$newEventData = null
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
            l("#teacher-name").html(e.event.extendedProps.teacher_name),
            l("#event-category").val(this.$selectedEvent.classNames[0])
    },
        // e.prototype.onSelect = function (e) {
        //     this.$formEvent[0].reset(), this.$formEvent.removeClass("was-validated"), this.$selectedEvent = null, this.$newEventData = e, this.$btnDeleteEvent.hide(), this.$modalTitle.text("Add New Event"), this.$modal.modal({
        //         backdrop: "static"
        //     }), this.$calendarObj.unselect()
        // }, 
        e.prototype.init = function () {

            var e = new Date(l.now());
            // new FullCalendarInteraction.Draggable(document.getElementById("external-events"), {
            //     itemSelector: ".external-event",
            //     eventData: function (e) {
            //         return {
            //             title: e.innerText,
            //             className: l(e).data("class")
            //         }
            //     }
            // });

            // current date
            var d = new Date();

            var currentD = formatDate(d);
            var currentDPlusOne = formatDate(d.setDate(d.getDate() + 1));
            var currentDPlusTwo = formatDate(d.setDate(d.getDate() + 1));
            var currentDPlusThree = formatDate(d.setDate(d.getDate() + 1));
            var currentDPlusFour = formatDate(d.setDate(d.getDate() + 1));

            var formData = new FormData();
            formData.append('token', token);
            formData.append('branch_id', branchID);
            formData.append('teacher_id', ref_user_id);
            var data = [];
            // ajax data
            $.ajax({
                url: getTimetableCalendor,
                method: "post",
                data: formData,
                processData: false,
                dataType: 'json',
                contentType: false,
                success: function (response) {
                    console.log("response")
                    console.log(response)
                    if (response.code == 200) {
                        data = response.data;
                        var t = data;

                    }
                }
            });

            // var t = [
            //     // today day 1
            //     {
            //         title: "English",
            //         subject: "English",
            //         timing: "08:30 AM - 09:30 AM",
            //         teacher_name: "Sandy",
            //         start: currentD + " 08:30:00",
            //         // start: start.setHours(start.getHours() + 8),
            //         // end: new Date(l.now() + 338e6),
            //         className: "bg-warning"
            //     }, {
            //         title: "Maths",
            //         subject: "Maths",
            //         timing: "09:30 AM - 10:30 AM",
            //         teacher_name: "Stella",
            //         start: currentD + " 09:30:00",
            //         // start: new Date(l.now() + 158e6),
            //         // end: e,
            //         className: "bg-primary"
            //     }
            // ],
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