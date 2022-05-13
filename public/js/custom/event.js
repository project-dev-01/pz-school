$(function () {
    eventTable();
    $('#eventForm').on('submit', function(e){
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
                        $('#event-table').DataTable().ajax.reload(null, false);
                        $('.addEvent').modal('hide');
                        $('.addEvent').find('form')[0].reset();
                        toastr.success(data.message);
                    } else {
                        $('.addEvent').modal('hide');
                        $('.addEvent').find('form')[0].reset();
                        toastr.error(data.message);
                    }
                }
            }
        });
    });
    function eventTable() {
        $('#event-table').DataTable({
            processing: true,
            info: true,
            ajax: eventList,
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
    $(document).on('click','#publishEventBtn', function(){
        var event_id = $(this).data('id');
        if($(this).prop('checked') == true){
            var value = 1;
            var text = "Publish";
        }else{
            var value = 0;
            var text = "UnPublish";
        }
        swal.fire({
             title:'Are you sure?',
             html:'You want to <b>'+text+'</b> this Event',
             showCancelButton:true,
             showCloseButton:true,
             cancelButtonText:'Cancel',
             confirmButtonText:'Yes,'+text,
             cancelButtonColor:'#d33',
             confirmButtonColor:'#556ee6',
             width:400,
             allowOutsideClick:false
        }).then(function(result){
              if(result.value){
                  $.post(eventPublish,{id:event_id,status:value}, function(data){
                       if(data.code == 200){
                           $('#event-table').DataTable().ajax.reload(null, false);
                           toastr.success(data.message);
                       }else{
                           toastr.error(data.message);
                       }
                  },'json');
              }
        });
    });
    // $(document).on('click','#publishEventBtn', function(){
    //     var event_id = $(this).data('id');
    //     console.log('event_id',event_id);
    //     if($(this).prop('checked') == true){
    //         var value = 1;
    //     }else{
    //         var value = 0;
    //     }
    //     $.post(eventPublish,{id:event_id,status:value}, function(data){
    //         if(data.code == 200){
    //             $('.publishEvent').modal('show');
    //         }
    //         $('.publishEvent').modal('show');
    //     },'json');
    // });

    // View Event 

    $(document).on('click','#viewEventBtn', function(){
        var event_id = $(this).data('id');
        $('.viewEvent').find('span.error-text').text('');
        $.post(eventDetails,{id:event_id}, function(data){
            console.log('cc',data)
            $('.viewEvent').find('.title').text(data.data.title);
            $('.viewEvent').find('.type').text(data.data.type);
            $('.viewEvent').find('.start_date').text(data.data.start_date);
            $('.viewEvent').find('.end_date').text(data.data.end_date);
            if(data.data.audience==1)
            {
                $('.viewEvent').find('.audience').text("Everyone");
            }else{
                $('.viewEvent').find('.audience').text("Class "+data.data.classname);
            }
            
            $('.viewEvent').find('.description').text(data.data.remarks);
            $('.viewEvent').modal('show');
        },'json');
    });

    // delete Event Type
    $(document).on('click','#deleteEventBtn', function(){
        var event_id = $(this).data('id');
        swal.fire({
             title:'Are you sure?',
             html:'You want to <b>delete</b> this Event',
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
                  $.post(eventDelete,{id:event_id}, function(data){
                       if(data.code == 200){
                           $('#event-table').DataTable().ajax.reload(null, false);
                           toastr.success(data.message);
                       }else{
                           toastr.error(data.message);
                       }
                  },'json');
              }
        });
    });

    $('#class').css("display", "none");
    $('#section').css("display", "none");
    $('select[name=audience]').change(function() {
        var a = $('select[name=audience]').val()
        console.log("select box",a)

        if ( a == "1") {
            $('#class').css("display", "none");
            $('#section').css("display", "none");
        }
        if ( a == "2") {
            $('#class').css("display", "BLOCK");
            $('#section').css("display", "none");
        }
        if ( a == "3") {
            $('#class').css("display", "none");
            $('#section').css("display", "BLOCK");
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
                    $(Selector).find("#section_name").append('<optgroup label="Class '+val.name+'">');
                    $.each(res.data.section, function (key, sec) {
                        if(sec.class_id==val.id)
                        {
                            $(Selector).find("#section_name").append('<option value="' + sec.section_id + '">' + sec.section_name + '</option>');
                        }
                    });  
                    $(Selector).find("#section_name").append('</optgroup>');
                });
            }
        }, 'json');
    }

});