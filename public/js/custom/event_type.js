$(function () {

    $(".color").colorpicker({
        format: "auto"
    });

    eventTypeTable();
    $("#eventTypeForm").validate({
        rules: {
            name: "required"
        }
    });
    $("#edit-event-type-form").validate({
        rules: {
            name: "required"
        }
    });
    // add eventType
    $('#eventTypeForm').on('submit', function (e) {
        e.preventDefault();
        var eventCheck = $("#eventTypeForm").valid();
        if (eventCheck === true) {
            var form = this;

            $.ajax({
                url: $(form).attr('action'),
                method: $(form).attr('method'),
                data: new FormData(form),
                processData: false,
                dataType: 'json',
                contentType: false,
                success: function (data) {
                    // console.log("------")
                    console.log(data)
                    if (data.code == 200) {
                        $('#event-type-table').DataTable().ajax.reload(null, false);
                        $('.addEventType').modal('hide');
                        $('.addEventType').find('form')[0].reset();
                        toastr.success(data.message);
                    } else {
                        toastr.error(data.message);
                    }
                }
            });
        }
    });

    // get all eventType table
    function eventTypeTable() {
         $('#event-type-table').DataTable({
            processing: true,
            info: true,
            bDestroy:true,
            // dom: 'lBfrtip',
            dom:"<'row'<'col-sm-2'l><'col-sm-2'B><'col-sm-8'f>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            buttons: [
                {
                    extend: 'csv',
                    text: 'Download CSV',
                    extension: '.csv',
                    exportOptions: {
                        columns: 'th:not(:last-child)'
                    }
                }
            ],
            ajax: eventTypeList,
            "pageLength": 5,
            "aLengthMenu": [
                [5, 10, 25, 50, -1],
                [5, 10, 25, 50, "All"]
            ],
            columns: [
                {
                    searchable: false,
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                }
                ,
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'color',
                    name: 'color'
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
    // get row
    $(document).on('click', '#editEventTypeBtn', function () {
        var id = $(this).data('id');
     
        $('.editEventType').find('form')[0].reset();   
        $.post(eventTypeDetails, { id: id }, function (data) {
            $('.editEventType').find('input[name="id"]').val(data.data.id);
            $('.editEventType').find('input[name="name"]').val(data.data.name);
            $('.editEventType').find('input[name="color"]').val(data.data.color);
            $('.editEventType').modal('show');
        }, 'json');
        console.log(id);
    });
    // update EventType
    $('#edit-event-type-form').on('submit', function (e) {
        e.preventDefault();
        var edt_eventCheck = $("#edit-event-type-form").valid();
        if (edt_eventCheck === true) {
      
            var form = this;
            $.ajax({
                url: $(form).attr('action'),
                method: $(form).attr('method'),
                data: new FormData(form),
                processData: false,
                dataType: 'json',
                contentType: false,
                success: function (data) {
                    if (data.code == 0) {
                        $.each(data.error, function (prefix, val) {
                            $(form).find('span.' + prefix + '_error').text(val[0]);
                        });
                    } else {

                        if (data.code == 200) {
                            $('#event-type-table').DataTable().ajax.reload(null, false);
                            $('.editEventType').modal('hide');
                            $('.editEventType').find('form')[0].reset();
                            toastr.success(data.message);
                        } else {
                            $('.editEventType').modal('hide');
                            $('.editEventType').find('form')[0].reset();
                            toastr.error(data.message);
                        }
                    }
                }
            });
        }
    });
    // delete EventTypeDelete
    $(document).on('click', '#deleteEventTypeBtn', function () {
        var id = $(this).data('id');
        var url = eventTypeDelete;
        swal.fire({
            title: 'Are you sure?',
            html: 'You want to <b>delete</b> this Event Type',
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
                $.post(url, {
                    id: id
                }, function (data) {
                    if (data.code == 200) {
                        $('#event-type-table').DataTable().ajax.reload(null, false);
                        toastr.success(data.message);
                    } else {
                        toastr.error(data.message);
                    }
                }, 'json');
            }
        });
    });
});