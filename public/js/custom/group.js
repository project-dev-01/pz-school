$(function () {

    $('#staff').keyup(function(){ 
        var name = $(this).val();
        console.log('staff',name)
        if(name != '')
        {
            $.ajax({
            url:staffName,
            method:"GET",
            data:{token: token, branch_id: branchID, name: name },
            success:function(data){
                $('#staff_list').fadeIn();  
                $('#staff_list').html(data);
            }
            });
        }
    });


    var staffcount = $('#staffCount').val();
    $('#staff_list').on('click','li', function(){
        if(staffcount=="0") {
            $("#staff_table").empty();
        }
        $('#staff').val($(this).text());  
        $('#staff_list').fadeOut();  
        var value = $(this).text();
        var id = $(this).val();
        console.log('val',value)
        console.log('id',id)
        if(value=="No results Found") {
            $('#staff').val("");  
            $('#staff_list').fadeOut();  
         
        } else {
            var id = $(this).val();
            $.post(staffDetails, { token: token, branch_id: branchID, id: id }, function (res) {
                if (res.code == 200) {
                    var staffData = res.data.staff;
                    staff(staffData);
                    $('#staff').val("");  
                }
            }, 'json');
        }
    });
    function staff(staffData) {
        staffcount++;
        var row = "";
        row += '<tr>';
        row += '<input type="hidden"  name="staff_id[]" value="' + staffData.id + '">';
        row += '<td >'+ staffcount +'</td>';
        row += '<td >'+ staffData.name +'</td>';
        row += '<td >'+ staffData.department_name +'</td>';
        row += '<td ></div><button type="button" class=" btn btn-danger removeStaff"><i class="fe-trash-2"></i> </button></td>';
        row += '</tr>';
        
        $("#staff_table").append(row);
    }

    $("#staff_table").on('click', '.removeStaff', function () {
        $(this).parent().parent().remove();
    });

    $('#student').keyup(function(){ 
        var name = $(this).val();
        console.log('student',name)
        if(name != '')
        {
            $.ajax({
            url:studentName,
            method:"GET",
            data:{token: token, branch_id: branchID, name: name },
            success:function(data){
                $('#student_list').fadeIn();  
                $('#student_list').html(data);
            }
            });
        }
    });
    var studentcount = $('#studentCount').val();
    $('#student_list').on('click','li', function(){
        if(studentcount=="0") {
            $("#student_table").empty();
        }
        $('#student').val($(this).text());  
        $('#student_list').fadeOut();  
        var value = $(this).text();
        var id = $(this).val();
        if(value=="No results Found") {
            $('#student').val("");  
            $('#student_list').fadeOut();  
         
        } else {
            var id = $(this).val();
            $.post(studentDetails, { token: token, branch_id: branchID, id: id }, function (res) {
                if (res.code == 200) {
                    var studentData = res.data.student;
                    student(studentData);
                    $('#student').val("");  
                }
            }, 'json');
        }
    });

    function student(studentData) {
        studentcount++;
        var row = "";
        row += '<tr>';
        row += '<input type="hidden"  name="student_id[]" value="' + studentData.id + '">';
        row += '<td >'+ studentcount +'</td>';
        row += '<td >'+ studentData.name +'</td>';
        row += '<td >'+ studentData.class_name +'</td>';
        row += '<td >'+ studentData.section_name +'</td>';
        row += '<td ></div><button type="button" class=" btn btn-danger removeStudent"><i class="fe-trash-2"></i> </button></td>';
        row += '</tr>';

        $("#student_table").append(row);
    }

    $("#student_table").on('click', '.removeStudent', function () {
        $(this).parent().parent().remove();
    });
    

    $('#parents').keyup(function(){ 
        var name = $(this).val();
        console.log('parent',name)
        if(name != '')
        {
            $.ajax({
            url:parentName,
            method:"GET",
            data:{token: token, branch_id: branchID, name: name },
            success:function(data){
                $('#parent_list').fadeIn();  
                $('#parent_list').html(data);
            }
            });
        }
    });

    var parentcount = $('#parentCount').val();
    $('#parent_list').on('click','li', function(){
        if(parentcount=="0") {
            $("#parent_table").empty();
        }
        $('#parents').val($(this).text());  
        $('#parent_list').fadeOut();  
        var value = $(this).text();
        var id = $(this).val();
        console.log('val',value)
        console.log('id',id)
        if(value=="No results Found") {
            $('#parents').val("");  
            $('#parent_list').fadeOut();  
         
        } else {
            var id = $(this).val();
            $.post(parentDetails, { token: token, branch_id: branchID, id: id }, function (res) {
                if (res.code == 200) {
                    var parentData = res.data.parent;
                    parent(parentData);
                    $('#parents').val("");  
                }
            }, 'json');
        }
    });

    function parent(parentData) {
        parentcount++;
        var row = "";
        row += '<tr>';
        row += '<input type="hidden"  name="parent_id[]" value="' + parentData.id + '">';
        row += '<td >'+ parentcount +'</td>';
        row += '<td >'+ parentData.name +'</td>';
        row += '<td >'+ parentData.email +'</td>';
        row += '<td ></div><button type="button" class=" btn btn-danger removeParent"><i class="fe-trash-2"></i> </button></td>';
        row += '</tr>';

        $("#parent_table").append(row);
    }

    $("#parent_table").on('click', '.removeParent', function () {
        $(this).parent().parent().remove();
    });
    groupTable();
    
    $("#groupForm").validate({
        rules: {
            name: "required",
        }
    });
    $('#groupForm').on('submit', function(e){
        e.preventDefault();
        var form = this;
        var groupCheck = $("#groupForm").valid();
        if (groupCheck === true) {
            $.ajax({
                url:$(form).attr('action'),
                method:$(form).attr('method'),
                data:new FormData(form),
                processData:false,
                dataType:'json',
                contentType:false,
                success: function(data){
                    if (data.code == 200) {
                        $('#group-table').DataTable().ajax.reload(null, false);
                        toastr.success(data.message);
                        window.location.href = groupList;
                    } else {
                        toastr.error(data.message);
                    }
                }
            });
        }
    });
    $("#groupEditForm").validate({
        rules: {
            name: "required",
        }
    });
    $('#groupEditForm').on('submit', function(e){
        e.preventDefault();

        var groupCheck = $("#groupEditForm").valid();
        if (groupCheck === true) {
            var form = this;
            $.ajax({
                url:$(form).attr('action'),
                method:$(form).attr('method'),
                data:new FormData(form),
                processData:false,
                dataType:'json',
                contentType:false,
                success: function(data){
                    if (data.code == 200) {
                        $('#group-table').DataTable().ajax.reload(null, false);
                        window.location.href = groupList;
                        toastr.success(data.message);
                    } else {
                        toastr.error(data.message);
                    }
                }
            });
        }
    });
    function groupTable() {
        $('#group-table').DataTable({
            processing: true,
            info: true,
            dom: "<'row'<'col-sm-2 col-md-2'l><'col-sm-4 col-md-4'B><'col-sm-6 col-md-6'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-6'i><'col-sm-6'p>>",
            "language": {
                "infoEmpty": showing_zero_entries,
                "info": showing_entries,
                "lengthMenu": show_entries,
                "search": datatable_search,
                "paginate": {
                    "next": next,
                    "previous": previous
                },
            },
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
            ajax: groupList,
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
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'no_of_members',
                    name: 'no_of_members'
                },
                {
                    data: 'description',
                    name: 'description'
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

    // delete Group Type
    $(document).on('click','#deleteGroupBtn', function(){
        var group_id = $(this).data('id');
        swal.fire({
             title:'Are you sure?',
             html:'You want to <b>delete</b> this Group',
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
                  $.post(groupDelete,{id:group_id}, function(data){
                       if(data.code == 200){
                           $('#group-table').DataTable().ajax.reload(null, false);
                           toastr.success(data.message);
                       }else{
                           toastr.error(data.message);
                       }
                  },'json');
              }
        });
    });

});