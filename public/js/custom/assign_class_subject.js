$(function () {

    $('#changeClassName').on('change', function () {
        var class_id = $(this).val();
        var IDnames = "#addAssignClassSubject";
        var section_id = null;
        getSections(class_id, IDnames, section_id);
    });
    $('#editchangeClassName').on('change', function () {
        var class_id = $(this).val();
        var IDnames = "#updateAssignClassSubject";
        var section_id = null;
        getSections(class_id, IDnames, section_id);
    });
    function getSections(class_id, IDnames, section_id) {
        $(IDnames).find("#sectionID").empty();
        $(IDnames).find("#sectionID").append('<option value="">Select Section</option>');

        $.post(sectionByClassUrl, { token: token, branch_id: branchID, class_id: class_id }, function (res) {
            if (res.code == 200) {
                $.each(res.data, function (key, val) {
                    $(IDnames).find("#sectionID").append('<option value="' + val.section_id + '">' + val.section_name + '</option>');
                });
                if (section_id) {
                    $(IDnames).find('select[name="section_name"]').val(section_id);
                }
            }
        }, 'json');
    }

    // rules validation
    $("#addAssignClassSubject").validate({
        rules: {
            class_name: "required",
            section_name: "required",
            subject_id: "required"
        }
    });
    // add 
    $('#addAssignClassSubject').on('submit', function (e) {
        e.preventDefault();
        var classValid = $("#addAssignClassSubject").valid();
        if (classValid === true) {
            var changeClassName = $("#changeClassName").val();
            var sectionID = $("#sectionID").val();
            var assignSubjects = $("#assignSubjects").val();

            var formData = new FormData();
            formData.append('token', token);
            formData.append('branch_id', branchID);
            formData.append('class_id', changeClassName);
            formData.append('section_id', sectionID);
            formData.append('subject_id', assignSubjects);
            
            $.ajax({
                url: classAssignAddUrl,
                method: "post",
                data: formData,
                processData: false,
                dataType: 'json',
                contentType: false,
                success: function (data) {
                    
                    if (data.code == 200) {
                        $('#class-assign-subjects-table').DataTable().ajax.reload(null, false);
                        $('.addAssignClassSubjectModal').modal('hide');
                        $('.addAssignClassSubjectModal').find('form')[0].reset();
                        toastr.success(data.message);
                    } else {
                        $('.addAssignClassSubjectModal').modal('hide');
                        $('.addAssignClassSubjectModal').find('form')[0].reset();
                        toastr.error(data.message);
                    }
                }, error: function (err) {
                    toastr.error(err.responseJSON.data.error ? err.responseJSON.data.error : 'Something went wrong');
                }
            });
        }
    });

    // edit 

    $(document).on('click', '#editAssiClassSubBtn', function () {
        var id = $(this).data('id');
        $.post(classAssignGetRowUrl, {
            id: id,
            token: token,
            branch_id: branchID
        }, function (data) {
            var class_id = data.data.class_id;
            var section_id = data.data.section_id;
            
            var IDnames = "#updateAssignClassSubject";
            getSections(class_id, IDnames, section_id);
            $('.editAssClassSubjectModel').find('input[name="assign_class_sub_id"]').val(data.data.id);
            $('.editAssClassSubjectModel').find('select[name="class_name"]').val(data.data.class_id);
            $('.editAssClassSubjectModel').find('select[name="subject_id"]').val(data.data.subject_id);
            $('.editAssClassSubjectModel').modal('show');
        }, 'json');
    });

    // update 
    $("#updateAssignClassSubject").validate({
        rules: {
            class_name: "required",
            section_name: "required",
            subject_id: "required"
        }
    });
    // update 
    $('#updateAssignClassSubject').on('submit', function (e) {
        e.preventDefault();
        var sectionValid = $("#updateAssignClassSubject").valid();
        if (sectionValid === true) {

            var assign_class_sub_id = $("#updateAssignClassSubject").find("input[name=assign_class_sub_id]").val();
            var changeClassName = $("#updateAssignClassSubject").find("select[name=class_name]").val();
            var sectionID = $("#updateAssignClassSubject").find("select[name=section_name]").val();
            var assignSubjects = $("#updateAssignClassSubject").find("select[name=subject_id]").val();

            var formData = new FormData();
            formData.append('token', token);
            formData.append('branch_id', branchID);
            formData.append('id', assign_class_sub_id);
            formData.append('class_id', changeClassName);
            formData.append('section_id', sectionID);
            formData.append('subject_id', assignSubjects);

            $.ajax({
                url: classAssignUpdateUrl,
                method: "post",
                data: formData,
                processData: false,
                dataType: 'json',
                contentType: false,
                success: function (data) {
                    if (data.code == 200) {
                        $('#class-assign-subjects-table').DataTable().ajax.reload(null, false);
                        $('.editAssClassSubjectModel').modal('hide');
                        $('.editAssClassSubjectModel').find('form')[0].reset();
                        toastr.success(data.message);
                    } else {
                        $('.editAssClassSubjectModel').modal('hide');
                        $('.editAssClassSubjectModel').find('form')[0].reset();
                        toastr.error(data.message);
                    }
                }, error: function (err) {
                    toastr.error(err.responseJSON.data.error ? err.responseJSON.data.error : 'Something went wrong');
                }
            });
        }
    });

    // delete form
    $(document).on('click', '#deleteAssiClassSubBtn', function () {
        var id = $(this).data('id');
        var url = classAssignDeleteUrl;
        swal.fire({
            title: 'Are you sure?',
            html: 'You want to <b>delete</b> this assign class subject',
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
                        $('#class-assign-subjects-table').DataTable().ajax.reload(null, false);
                        toastr.success(data.message);
                    } else {
                        toastr.error(data.message);
                    }
                }, 'json');
            }
        });
    });

    //GET ALL 
    var table = $('#class-assign-subjects-table').DataTable({
        processing: true,
        info: true,
        ajax: classAssignSubList,
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
                data: 'class_name',
                name: 'class_name'
            },
            {
                data: 'section_name',
                name: 'section_name'
            },
            {
                data: 'subject_name',
                name: 'subject_name'
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