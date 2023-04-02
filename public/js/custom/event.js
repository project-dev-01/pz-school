$(function () {

    $(".timepicker").flatpickr({
        enableTime: !0,
        noCalendar: !0,
        dateFormat: "H:i",
        time_24hr: !0,
        defaultDate: "08:30"
    });

    $(".edittimepicker").flatpickr({
        enableTime: !0,
        noCalendar: !0,
        dateFormat: "H:i",
        time_24hr: !0,
    });



    // all day checkbox
    $("#allDay").on("change", function () {
        if ($(this).is(":checked")) {
            // $(".time").hide("slow");

            $('.time').css("display", "none");
        } else {

            $('.time').css("display", "block");
            // $(".time").show("slow");
        }
    });

    $("#event_start_date").datepicker({
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
        autoclose: true,
        yearRange: "-100:+50", // last hundred years
    });
    $("#event_end_date").datepicker({
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
        autoclose: true,
        yearRange: "-100:+50", // last hundred years
    });

    $('#event_start_date').change(function () {
        var name = $(this).val();
        $("#event_end_date").val(name);
    });



    $("#edit_event_start_date").datepicker({
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
        autoclose: true,
        yearRange: "-100:+50", // last hundred years
    });
    $("#edit_event_end_date").datepicker({
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
        autoclose: true,
        yearRange: "-100:+50", // last hundred years
    });



    $('#edit_event_start_date').change(function () {
        var name = $(this).val();
        $("#edit_event_end_date").val(name);
    });

    eventTable();

    $("#eventForm").validate({
        rules: {
            title: "required",
            type: "required",
            audience: "required",
            start_date: "required",
            end_date: "required",
            start_time: "required",
            end_time: "required",
        }
    });
    $('#eventForm').on('submit', function (e) {
        e.preventDefault();
        var form = this;

        if ($("#audience").val() == "2") {
            var classes = ($("#classes").val()).length;
            if (classes == 0) {
                $(form).find('span.class_error').text("This field is required.");
                return false;
            } else {
                $(form).find('span.class_error').text("");
            }
        }

        if ($("#audience").val() == "3") {
            var group = ($("#group_row").val()).length;
            if (group == 0) {
                $(form).find('span.group_error').text("This field is required.");
                return false;
            } else {
                $(form).find('span.group_error').text("");
            }
        }


        //Date validate
        var startDate = $("#event_start_date").val();
        var endDate = $("#event_end_date").val();
        if (startDate > endDate) {
            $(form).find('span.end_date_error').text("End Date should be greater than Start Date.");
            $("#event_end_date").val("");
            return false;
        } else {
            $(form).find('span.end_date_error').text("");
        }

        //Time Validation
        if ($('#allDay').is(":checked")) {
            $(form).find('span.end_time_error').text("");
        } else {
            var startTime = $("#add_start_time").val();
            var endTime = $("#add_end_time").val();
            if (startTime > endTime) {
                $(form).find('span.end_time_error').text("End Time should be greater than Start Time.");
                $("#add_end_time").val("");
                return false;
            } else {
                $(form).find('span.end_time_error').text("");
            }
        }



        var eventCheck = $("#eventForm").valid();
        if (eventCheck === true) {
            $.ajax({
                url: $(form).attr('action'),
                method: $(form).attr('method'),
                data: new FormData(form),
                processData: false,
                dataType: 'json',
                contentType: false,
                beforeSend: function () {
                    $(form).find('span.error-text').text('');
                },
                success: function (data) {
                    if (data.code == 200) {
                        $('#event-table').DataTable().ajax.reload(null, false);
                        toastr.success(data.message);
                        window.location.href = eventList;
                    } else {
                        toastr.error(data.message);
                    }
                }
            });
        }
    });
    $("#eventEditForm").validate({
        rules: {
            title: "required",
            type: "required",
            audience: "required",
            start_date: "required",
            end_date: "required",
            start_time: "required",
            end_time: "required",
        }
    });
    $('#eventEditForm').on('submit', function (e) {
        e.preventDefault();


        if ($("#edit_audience").val() == "2") {
            var classes = ($("#edit_classes").val()).length;
            if (classes == 0) {
                $(form).find('span.class_error').text("This field is required.");
                return false;
            } else {
                $(form).find('span.class_error').text("");
            }
        }
        if ($("#edit_audience").val() == "3") {
            var group = ($("#edit_group_row").val()).length;
            if (group == 0) {
                $(form).find('span.group_error').text("This field is required.");
                return false;
            } else {
                $(form).find('span.group_error').text("");
            }
        }

        //Date validate
        var startDate = $("#edit_event_start_date").val();
        var endDate = $("#edit_event_end_date").val();
        if (startDate > endDate) {
            $(form).find('span.end_date_error').text("End Date should be greater than Start Date.");
            $("#edit_event_end_date").val("");
            return false;
        } else {
            $(form).find('span.end_date_error').text("");
        }

        //Time Validation
        if ($('#allDay').is(":checked")) {
            $(form).find('span.end_time_error').text("");
        } else {
            var startTime = $("#edit_start_time").val();
            var endTime = $("#edit_end_time").val();
            if (startTime > endTime) {
                $(form).find('span.end_time_error').text("End Time should be greater than Start Time.");
                $("#edit_end_time").val("");
                return false;
            } else {
                $(form).find('span.end_time_error').text("");
            }
        }
        var eventCheck = $("#eventEditForm").valid();
        if (eventCheck === true) {
            var form = this;
            $.ajax({
                url: $(form).attr('action'),
                method: $(form).attr('method'),
                data: new FormData(form),
                processData: false,
                dataType: 'json',
                contentType: false,
                beforeSend: function () {
                    $(form).find('span.error-text').text('');
                },
                success: function (data) {
                    if (data.code == 0) {
                        $.each(data.error, function (prefix, val) {
                            $(form).find('span.' + prefix + '_error').text(val[0]);
                        });
                    } else {
                        if (data.code == 200) {
                            $('#event-table').DataTable().ajax.reload(null, false);
                            window.location.href = eventList;
                            toastr.success(data.message);
                        } else {
                            toastr.error(data.message);
                        }
                    }
                }
            });
        }
    });
    function eventTable() {
        $('#event-table').DataTable({
            processing: true,
            info: true,
            dom: "<'row'<'col-sm-2 col-md-2'l><'col-sm-4 col-md-4'B><'col-sm-6 col-md-6'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-6'i><'col-sm-6'p>>",
            //dom: 'lBfrtip',
            buttons: [
                {
                    extend: 'csv',
                    text: downloadcsv,
                    extension: '.csv',
                    exportOptions: {
                        columns: 'th:not(:last-child)'
                    }
                },
                {
                    extend: 'pdf',
                    text: downloadpdf,
                    extension: '.pdf',
                    exportOptions: {
                        columns: 'th:not(:last-child)'
                    }

                }
            ],
            ajax: eventList,
            "pageLength": 10,
            "aLengthMenu": [
                [5, 10, 25, 50, -1],
                [5, 10, 25, 50, "All"]
            ],
            columns: [
                //  {data:'id', name:'id'},
                // {
                //     data: 'checkbox',
                //     name: 'checkbox',
                //     orderable: false,
                //     searchable: false
                // },
                {
                    searchable: false,
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'title',
                    name: 'title'
                },
                {
                    data: 'type',
                    name: 'type'
                },
                {
                    data: 'classname',
                    name: 'classname'
                },
                {
                    data: 'start_date',
                    name: 'start_date'
                },
                {
                    data: 'end_date',
                    name: 'end_date'
                },
                {
                    data: 'publish',
                    name: 'publish',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'actions',
                    name: 'actions',
                    orderable: false,
                    searchable: false
                },
            ]
        }).on('draw', function () {
        });
    }


    // Publish Event 
    $(document).on('click', '#publishEventBtn', function () {
        var event_id = $(this).data('id');
        if ($(this).prop('checked') == true) {
            var value = 1;
            var text = "Publish";
        } else {
            var value = 0;
            var text = "UnPublish";
        }
        swal.fire({
            title: 'Are you sure?',
            html: 'You want to <b>' + text + '</b> this Event',
            showCancelButton: true,
            showCloseButton: true,
            cancelButtonText: 'Cancel',
            confirmButtonText: 'Yes,' + text,
            cancelButtonColor: '#d33',
            confirmButtonColor: '#556ee6',
            width: 400,
            allowOutsideClick: false
        }).then(function (result) {
            if (result.value) {
                $.post(eventPublish, { id: event_id, status: value }, function (data) {
                    if (data.code == 200) {
                        $('#event-table').DataTable().ajax.reload(null, false);
                        toastr.success(data.message);
                    } else {
                        toastr.error(data.message);
                    }
                }, 'json');
            }
        });
    });

    // get row
    $(document).on('click', '#editEventBtn', function () {
        var id = $(this).data('id');
        //  return false;
        $('.editEvent').find('form')[0].reset();
        $.post(eventDetails, { id: id }, function (data) {
            $('.editEvent').find('input[name="id"]').val(data.data.id);
            $('.editEvent').find('input[name="title"]').val(data.data.title);
            $('.editEvent').find('select[name="type"]').val(data.data.type);
            $('.editEvent').find('input[name="start_date"]').val(data.data.start_date);
            $('.editEvent').find('input[name="end_date"]').val(data.data.end_date);
            $('.editEvent').find('select[name="audience"]').val(data.data.audience);
            if (data.data.audience == 2) {
                $('#edit_class').css("display", "Block");
                $('.editEvent').find('select[name="class"]').val(data.data.class);
            }
            $('.editEvent').find('input[name="description"]').val(data.data.description);
            $('.editEvent').modal('show');
        }, 'json');
    });

    $(document).on('click', '#viewEventBtn', function () {
        var event_id = $(this).data('id');
        $('.viewEvent').find('span.error-text').text('');
        $.post(eventDetails, { id: event_id }, function (data) {
            console.log('cc', data)
            $('.viewEvent').find('.title').text(data.data.title);
            $('.viewEvent').find('.type').text(data.data.type_name);
            $('.viewEvent').find('.start_date').text(data.data.start_date);
            $('.viewEvent').find('.end_date').text(data.data.end_date);
            if (data.data.audience == 1) {
                $('.viewEvent').find('.audience').text("Everyone");
            } else {
                $('.viewEvent').find('.audience').text("Class " + data.data.classname);
            }

            $('.viewEvent').find('.description').text(data.data.remarks);
            $('.viewEvent').modal('show');
        }, 'json');
    });

    // delete Event Type
    $(document).on('click', '#deleteEventBtn', function () {
        var event_id = $(this).data('id');
        swal.fire({
            title: 'Are you sure?',
            html: 'You want to <b>delete</b> this Event',
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
                $.post(eventDelete, { id: event_id }, function (data) {
                    if (data.code == 200) {
                        $('#event-table').DataTable().ajax.reload(null, false);
                        toastr.success(data.message);
                    } else {
                        toastr.error(data.message);
                    }
                }, 'json');
            }
        });
    });

    $('#class').css("display", "none");
    $('#group_row').css("display", "none");
    $('select[name=audience]').change(function () {
        var a = $('select[name=audience]').val()

        if (a == "1") {
            $('#class').css("display", "none");
            $('#group_row').css("display", "none");
        }
        if (a == "2") {
            $('#class').css("display", "BLOCK");
            $('#group_row').css("display", "none");
        }
        if (a == "3") {
            $('#class').css("display", "none");
            $('#group_row').css("display", "BLOCK");
        }
    });


    $('select[name=audience]').change(function () {
        var a = $('select[name=audience]').val();
        console.log("select box", a)

        if (a == "1") {
            $('#edit_class').css("display", "none");
            $('#edit_group_row').css("display", "none");
        }
        if (a == "2") {
            $('#edit_class').css("display", "BLOCK");
            $('#edit_group_row').css("display", "none");
        }
        if (a == "3") {
            $('#edit_class').css("display", "none");
            $('#edit_group_row').css("display", "BLOCK");
        }
    });

    // change branch id in add class,section and type in evvent 
    $("#branch_id").on('change', function (e) {
        e.preventDefault();
        var Selector = '#eventForm';
        var branch_id = $(this).val();
        if (branch_id) {
            branchEvent(branch_id, Selector);
        }
    });
    // branch Event
    function branchEvent(branch_id, Selector) {

        $(Selector).find("#type").empty();
        $(Selector).find("#type").append('<option value="">Select Type</option>');
        $(Selector).find("#class_name").empty();
        $(Selector).find("#class_name").append('<option value="">Choose Class</option>');
        $(Selector).find("#section_name").empty();
        $(Selector).find("#section_name").append('<option value="">Select Section</option>');
        $.post(branchByEvent, { branch_id: branch_id, token: token }, function (res) {
            if (res.code == 200) {
                $.each(res.data.eventType, function (key, val) {
                    $(Selector).find("#type").append('<option value="' + val.id + '">' + val.name + '</option>');
                });
                $.each(res.data.class, function (key, val) {
                    $(Selector).find("#class_name").append('<option value="' + val.id + '">' + val.name + '</option>');
                    $(Selector).find("#section_name").append('<optgroup label="Class ' + val.name + '">');
                    $.each(res.data.section, function (key, sec) {
                        if (sec.class_id == val.id) {
                            $(Selector).find("#section_name").append('<option value="' + sec.section_id + '">' + sec.section_name + '</option>');
                        }
                    });
                    $(Selector).find("#section_name").append('</optgroup>');
                });
            }
        }, 'json');
    }

});