! function (l) {
    "use strict";

    function e() {
        this.$body = l("body"), this.$modal = l("#admin-modal"), this.$calendar = l("#admin_calendor"),  this.$btnNewEvent = l("#btn-new-event"), this.$btnDeleteEvent = l("#btn-delete-event"), this.$btnSaveEvent = l("#btn-save-event"), this.$modalTitle = l("#modal-title"), this.$calendarObj = null, this.$selectedEvent = null, this.$newEventData = null
    }
    e.prototype.onEventClick = function (e) {

        var start = e.event.start_date;
        var end = e.event.end_date;
        var setCurDate = formatDate(end);
         this.$newEventData = null, this.$btnDeleteEvent.show(), this.$modalTitle.text("Edit Event"), this.$modal.modal({
            backdrop: "static"
        }), this.$selectedEvent = e.event,
            l("#title").html(this.$selectedEvent.title),
            l("#type").html(e.event.extendedProps.event_type),
            l("#start_date").html(e.event.extendedProps.start_date),
            l("#end_date").html(e.event.extendedProps.end_date),
            l("#audience").html(e.event.extendedProps.class_name),
            l("#description").html(e.event.extendedProps.remarks)
            l("#setCurDate").val(setCurDate)

        // l("#event-category").val(this.$selectedEvent.classNames[0])
    },
        e.prototype.init = function () {
            var m = [],

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
                    url: getEventCalendorAdmin + '?token=' + token + '&branch_id=' + branchID,
                    type: 'get',
                    success: function (response) {
                        m = response.data;
                        return m;
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