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
        e.prototype.init = function () {

            var e = new Date(l.now());
            // current date
            var d = new Date();
            var formData = new FormData();
            formData.append('token', token);
            formData.append('branch_id', branchID);
            formData.append('teacher_id', ref_user_id);
            var t = [
                {
                    "id": 1,
                    "start": "2022-03-24 12:10:12",
                    "end": "2022-03-24 13:10:12",
                    "className": "bg-warning",
                    "subject_name": "Mathematics",
                    "title": "Mathematics",
                    "teacher_name": "teacher"
                },
                {
                    "id": 2,
                    "start": "2022-03-24 12:10:12",
                    "end": "2022-03-24 13:10:12",
                    "className": "bg-primary",
                    "subject_name": "English",
                    "title": "English",
                    "teacher_name": "teacher"
                }
            ],

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
                // eventSources: [{
                //     events: function (start, end, timezone, callback) {
                //         $.ajax({
                //             url: getTimetableCalendor,
                //             type: 'get',
                //             dataType: 'json',
                //             data: {
                //                 //  requires UNIX timestamps
                //                 start: start.unix(),
                //                 end: end.unix(),
                //                 token: token,
                //                 branch_id: branchID,
                //                 teacher_id: ref_user_id
                //             },
                //             success: function (doc) {
                //                 console.log(doc);
                //                 var events = [];
                //                 $(doc).find('event').each(function () {
                //                     events.push({
                //                         title: $(this).attr('title'),
                //                         start: $(this).attr('start'), // will be parsed
                //                         end: $(this).attr('end'), // will be parsed
                //                         className: $(this).attr('className')
                //                     });
                //                 });
                //                 callback(doc);
                //                 console.log(doc);
                //             }

                //         });
                //     }
                // }],
                // events: t,
                // events: {
                //     url: getTimetableCalendor,
                //     dataType: 'json',
                //     data:formData,
                //     error: function() {
                //         $('#script-warning').show();
                //     },
                //     success: function(){
                //         alert("successful: You can now do your stuff here. You dont need ajax. Full Calendar will do the ajax call OK? ");   
                //     }
                // },
                eventSources: [{

                    url: getTimetableCalendor + '?token=' + token + '&branch_id=' + branchID + '&teacher_id=' + ref_user_id,
                    type: 'get',
                    // error: function () {
                    //     $('#script-warning').show();
                    // },
                    success: function (response) {
                        console.log("response")
                        console.log(response)
                        // alert(response);
                        return response.data;
                        // $.each(response, function (key, val) {
                        //     console.log(key + val);
                        // });
                        // $.each(function () {
                        //     events.push({
                        //         title: $(this).attr('title'),
                        //         start: $(this).attr('start'), // will be parsed
                        //         end: $(this).attr('end'), // will be parsed
                        //         className: $(this).attr('className')
                        //     });
                        // });
                        // alert("successful: You can now do your stuff here. You dont need ajax. Full Calendar will do the ajax call OK? ");
                    }

                }],
                // eventSources: [{

                //     events: function(start, end, timezone, callback) {
                //         $.ajax({
                //             url     : getTimetableCalendor,
                //             type    : 'get',
                //             dataType: 'json',
                //             data    : formData,
                //             success : function(doc) {
                //                 var events = [];
                //                 $(doc).find('event').each(function() {
                //                     events.push({
                //                         title    : $(this).attr('title'),
                //                         start    : $(this).attr('start'), // will be parsed
                //                         end      : $(this).attr('end'), // will be parsed
                //                         className: $(this).attr('className')
                //                     });
                //                 });
                //                 callback(doc);
                //                 console.log(doc);
                //             }

                //         });
                //     }
                // }],
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