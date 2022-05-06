$(function () {

    // rules validation
    $("#addSubjectSubmit").validate({
        rules: {
            name: "required",
            short_name: "required"
        }
    });
    // add 
    $('#addSubjectSubmit').on('submit', function (e) {
        e.preventDefault();
        var classValid = $("#addSubjectSubmit").valid();
        if (classValid === true) {
            var subjectName = $("#subjectName").val();
            var subjectCode = $("#subjectCode").val();
            var shortName = $("#shortName").val();
            var subjectType = $("#subjectType").val();
            var subjectColor = $("#subjectColor").val();

            var formData = new FormData();
            formData.append('token', token);
            formData.append('branch_id', branchID);
            formData.append('name', subjectName);
            formData.append('short_name', shortName);
            formData.append('subject_code', subjectCode);
            formData.append('subject_type', subjectType);
            formData.append('subject_color', subjectColor);

            $.ajax({
                url: subjectsAddUrl,
                method: "post",
                data: formData,
                processData: false,
                dataType: 'json',
                contentType: false,
                success: function (data) {
                    console.log(data)
                    if (data.code == 200) {
                        $('#subjects-table').DataTable().ajax.reload(null, false);
                        $('.addSubjectModal').modal('hide');
                        $('.addSubjectModal').find('form')[0].reset();
                        toastr.success(data.message);
                    } else {
                        $('.addSubjectModal').modal('hide');
                        $('.addSubjectModal').find('form')[0].reset();
                        toastr.error(data.message);
                    }
                }, error: function (err) {
                    toastr.error(err.responseJSON.data.error ? err.responseJSON.data.error : 'Something went wrong');
                }
            });
        }
    });

    // edit 

    $(document).on('click', '#editSubjectBtn', function () {
        var id = $(this).data('id');
        $.post(subjectsGetRowUrl, {
            id: id,
            token: token,
            branch_id: branchID
        }, function (data) {
            console.log(data)
            $('.editSubjectModel').find('input[name="id"]').val(data.data.id);
            $('.editSubjectModel').find('input[name="name"]').val(data.data.name);
            $('.editSubjectModel').find('input[name="short_name"]').val(data.data.short_name);
            $('.editSubjectModel').find('input[name="subject_code"]').val(data.data.subject_code);
            $('.editSubjectModel').find('select[name="subject_type"]').val(data.data.subject_type);
            $('.editSubjectModel').find('select[name="subject_color_calendor"]').val(data.data.subject_color_calendor);
            $('.editSubjectModel').modal('show');
        }, 'json');
    });

    // update 
    $("#subjectUpdateForm").validate({
        rules: {
            name: "required",
            short_name:"required"
        }
    });
    // update 
    $('#subjectUpdateForm').on('submit', function (e) {
        e.preventDefault();
        var sectionValid = $("#subjectUpdateForm").valid();
        if (sectionValid === true) {

            var editsubjectID = $("#editsubjectID").val();
            var editsubjectName = $("#editsubjectName").val();
            var editsubjectCode = $("#editsubjectCode").val();
            var editshortName = $("#editshortName").val();
            var editsubjectType = $("#editsubjectType").val();
            var editsubjectColor = $("#editsubjectColor").val();

            var formData = new FormData();
            formData.append('token', token);
            formData.append('branch_id', branchID);
            formData.append('id', editsubjectID);
            formData.append('name', editsubjectName);
            formData.append('short_name', editshortName);
            formData.append('subject_code', editsubjectCode);
            formData.append('subject_type', editsubjectType);
            formData.append('subject_color', editsubjectColor);

            $.ajax({
                url: subjectsUpdateUrl,
                method: "post",
                data: formData,
                processData: false,
                dataType: 'json',
                contentType: false,
                success: function (data) {
                    if (data.code == 200) {
                        $('#subjects-table').DataTable().ajax.reload(null, false);
                        $('.editSubjectModel').modal('hide');
                        $('.editSubjectModel').find('form')[0].reset();
                        toastr.success(data.message);
                    } else {
                        $('.editSubjectModel').modal('hide');
                        $('.editSubjectModel').find('form')[0].reset();
                        toastr.error(data.message);
                    }
                }, error: function (err) {
                    toastr.error(err.responseJSON.data.error ? err.responseJSON.data.error : 'Something went wrong');
                }
            });
        }
    });

    // delete form
    $(document).on('click', '#deleteSubjectBtn', function () {
        var id = $(this).data('id');
        var url = subjectsDeleteUrl;
        swal.fire({
            title: 'Are you sure?',
            html: 'You want to <b>delete</b> this subject',
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
                    id: id,
                    token: token,
                    branch_id: branchID
                }, function (data) {

                    if (data.code == 200) {
                        $('#subjects-table').DataTable().ajax.reload(null, false);
                        toastr.success(data.message);
                    } else {
                        toastr.error(data.message);
                    }
                }, 'json');
            }
        });
    });

    //GET ALL 
    var table = $('#subjects-table').DataTable({
        processing: true,
        info: true,
        ajax: subjectsList,
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
            },
            {
                data: 'name',
                name: 'name'
            },
            {
                data: 'short_name',
                name: 'short_name'
            },
            {
                data: 'subject_code',
                name: 'subject_code'
            },
            {
                data: 'subject_type',
                name: 'subject_type'
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
});