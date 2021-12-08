$(function () {

    // change section filter

    $("#classNameFilter").on('change', function (e) {
        e.preventDefault();
        var ClassName = '.addAssignTeachernModal';
        var class_id = $(this).val();
        var formData = new FormData();
        formData.append('class_id', class_id);
        var sectionID ="";
        if (class_id) {
            sectionAllocation(formData,ClassName,sectionID);
        }
    });
    $("#editclassNameFilter").on('change', function (e) {
        e.preventDefault();
        var ClassName = '.editAssignTeacherModal';
        var class_id = $(this).val();
        var formData = new FormData();
        formData.append('class_id', class_id);
        var sectionID ="";
        if (class_id) {
            sectionAllocation(formData,ClassName,sectionID);
        }
    });

    function sectionAllocation(formData,ClassName,sectionID){
        $.ajax({
            url:getsectionAllocation,
            method:"post",
            data:formData,
            processData:false,
            dataType:'json',
            contentType:false,
            success: function (res) {
                if(res.code == 1){
                    $(ClassName).find("#section_name").empty();
                    $(ClassName).find("#section_name").append('<option value="">Choose Section</option>');
                    $.each(res.data, function(key, val){
                        $(ClassName).find("#section_name").append('<option value="' + val.section_id + '">' + val.section_name + '</option>');
                    });
                    if(sectionID != ''){
                        $(ClassName).find('select[name="section_name"]').val(sectionID);
                    }                    
                }
            }

        });
    }
    // save assign teacher
    $('#addAssignTeacherForm').on('submit', function(e){
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
                  if(data.code == 0){
                      $.each(data.error, function(prefix, val){
                          $(form).find('span.'+prefix+'_error').text(val[0]);
                      });
                  }else{
                      $('#assign-teacher-table').DataTable().ajax.reload(null, false);
                      $('.addAssignTeachernModal').modal('hide');
                      $('.addAssignTeachernModal').find('form')[0].reset();
                      toastr.success(data.msg);
                  }
            }
        });
    });

    // get all assign teacher table
    var table = $('#assign-teacher-table').DataTable({
        processing: true,
        info: true,
        ajax: assignTeacherList,
        "pageLength": 5,
        "aLengthMenu": [
            [5, 10, 25, 50, -1],
            [5, 10, 25, 50, "All"]
        ],
        columns: [
            {
                data: 'DT_RowIndex',
                name: 'DT_RowIndex'
            },
            {
                data: 'class_name',
                name: 'class_name'
            },
            {
                data: 'section_name',
                name: 'section_name'
            },
            {
                data: 'teacher_name',
                name: 'teacher_name'
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

    // edit class

    $(document).on('click','#editTeacherAlloBtn', function(){
        var id = $(this).data('id');
        $('.editAssignTeacherModal').find('form')[0].reset();
        $('.editAssignTeacherModal').find('span.error-text').text('');
        $.post(assignTeacherDetails,{id:id}, function(data){
            var ClassName = '.editAssignTeacherModal';
            var class_id = data.details.class_id;
            var formData = new FormData();
            formData.append('class_id', class_id);
            if (class_id) {
                var sectionID = data.details.section_id;
                sectionAllocation(formData,ClassName,sectionID);
            }
            $('.editAssignTeacherModal').find('input[name="teacher_id"]').val(data.details.id);
            $('.editAssignTeacherModal').find('select[name="class_name"]').val(data.details.class_id);
            $('.editAssignTeacherModal').find('select[name="class_teacher"]').val(data.details.teacher_id);
            $('.editAssignTeacherModal').modal('show');
        },'json');
    });

    // update assign teacher

    $('#assignTeacherUpdate').on('submit', function(e){
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
                  if(data.code == 0){
                      $.each(data.error, function(prefix, val){
                          $(form).find('span.'+prefix+'_error').text(val[0]);
                      });
                  }else{
                      $('#assign-teacher-table').DataTable().ajax.reload(null, false);
                      $('.editAssignTeacherModal').modal('hide');
                      $('.editAssignTeacherModal').find('form')[0].reset();
                      toastr.success(data.msg);
                  }
            }
        });
    });
    // delete Teacher Allocation
    $(document).on('click', '#deleteTeacherAlloBtn', function () {
        var teacher_id = $(this).data('id');
        var url = deleteAssignTeacher;
        swal.fire({
            title: 'Are you sure?',
            html: 'You want to <b>delete</b> this Assign Teacher',
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
                    teacher_id: teacher_id
                }, function (data) {
                    if (data.code == 1) {
                        $('#assign-teacher-table').DataTable().ajax.reload(null, false);
                        toastr.success(data.msg);
                    } else {
                        toastr.error(data.msg);
                    }
                }, 'json');
            }
        });
    });
});