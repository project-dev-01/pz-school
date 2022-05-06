$(function () {

    $('#eventTypeForm').on('submit', function(e){
        e.preventDefault();
        var form = this;
        $.ajax({
            url:$(form).attr('action'),
            method:$(form).attr('method'),
            data:new FormData(form),
            processData:false,
            dataType:'json',
            contentType:false,
            beforeSend: function(){
                 $(form).find('span.error-text').text('');
            },
            success: function(data){
                if (data.code == 0) {
                    $.each(data.error, function (prefix, val) {
                        $(form).find('span.' + prefix + '_error').text(val[0]);
                    });
                } else {

                    if (data.code == 200) {
                        $('#event-type-table').DataTable().ajax.reload(null, false);
                        $('.addEventType').modal('hide');
                        $('.addEventType').find('form')[0].reset();
                        toastr.success(data.message);
                    } else {
                        $('.addEventType').modal('hide');
                        $('.addEventType').find('form')[0].reset();
                        toastr.error(data.message);
                    }
                }
            }
        });
    });
    //GET ALL Event Type
    var table = $('#event-type-table').DataTable({
        processing: true,
        info: true,
        ajax: eventTypeList,
        "pageLength": 5,
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
                data: 'branch_name',
                name: 'branch_name'
            },
            {
                data: 'name',
                name: 'name'
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

    
    // edit Event Type

    $(document).on('click','#editEventTypeBtn', function(){
        var event_type_id = $(this).data('id');
        $('.editEventType').find('form')[0].reset();
        $('.editEventType').find('span.error-text').text('');
        $.post(eventTypeDetails,{event_type_id:event_type_id}, function(data){
            $('.editEventType').find('input[name="event_type_id"]').val(data.data.id);
            $('.editEventType').find('input[name="name"]').val(data.data.name);
            $('.editEventType').find('select[name="branch_id"]').val(data.data.branch_id);
            $('.editEventType').modal('show');
        },'json');
    });

    // update Event Type
    $('#eventTypeEditForm').on('submit', function(e){
        e.preventDefault();
        var form = this;
        $.ajax({
            url:$(form).attr('action'),
            method:$(form).attr('method'),
            data:new FormData(form),
            processData:false,
            dataType:'json',
            contentType:false,
            beforeSend: function(){
                 $(form).find('span.error-text').text('');
            },
            success: function(data){

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
    });

    
    // delete Event Type
    $(document).on('click','#deleteEventTypeBtn', function(){
        var event_type_id = $(this).data('id');
        swal.fire({
             title:'Are you sure?',
             html:'You want to <b>delete</b> this Event Type',
             showCancelButton:true,
             showCloseButton:true,
             cancelButtonText:'Cancel',
             confirmButtonText:'Yes, Delete',
             cancelButtonColor:'#d33',
             confirmButtonColor:'#556ee6',
             width:400,
             allowOutsideClick:false
        }).then(function(result){
              if(result.value){
                  $.post(eventTypeDelete,{event_type_id:event_type_id}, function(data){
                       if(data.code == 200){
                           $('#event-type-table').DataTable().ajax.reload(null, false);
                           toastr.success(data.message);
                       }else{
                           toastr.error(data.message);
                       }
                  },'json');
              }
        });
    });

});