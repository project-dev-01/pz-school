$(function () {

    $("#indexFilter").validate({
        rules: {
            class_id: "required",
            section_id: "required",
        }
    });

    // get student list
    $('#indexFilter').on('submit', function (e) {
        e.preventDefault();
        console.log('id',123)
        var filterCheck = $("#indexFilter").valid();
        if (filterCheck === true) {
            var form = this;
            $.ajax({
                url: $(form).attr('action'),
                method: $(form).attr('method'),
                data: new FormData(form),
                processData: false,
                dataType: 'json',
                contentType: false,
                success: function (data) {
                    if (data.code == 200) {
                        $("#student").show("slow");
                        $("#student_table").html(data.table);
                    } else {
                        $("#student").hide("slow");
                        toastr.error(data.message);
                    }
                }
            });
        }
    });

    $("#class_id").on('change', function (e) {
        e.preventDefault();
        var class_id = $(this).val();
        $("#section_id").empty();
        $("#section_id").append('<option value="">Select Class Name</option>');
        $.post(sectionByClass, { class_id: class_id }, function (res) {
            if (res.code == 200) {
                $.each(res.data, function (key, val) {
                    $("#section_id").append('<option value="' + val.section_id + '">' + val.section_name + '</option>');
                });
            }
        }, 'json');
    });


    $("#editadmission").validate({
        rules: {
            btwyears: "required",
            txt_regiter_no: "required",
            txt_emailid: {
                required: true,
                email: true
            },
            txt_roll_no: "required",
            admission_date: "required",
            classnames: "required",
            categy: "required",
            fname: "required",
            lname: "required",
            txt_mobile_no: "required",
            present_address: "required",
            txt_pwd: {
                required: true,
                minlength: 6
            },
            txt_retype_pwd: {
                required: true,
                minlength: 6
            },          
            txt_name: "required",
            txt_relation: "required",
            txt_occupation: "required",            
            txt_guardian_mobileno: "required",            
            txt_guardian_email: "required",  
            
            txt_guardian_pwd: {
                required: true,
                minlength: 6
            },
            txt_guardian_retyppwd: {
                required: true,
                minlength: 6
            },          
        }
    });

    $('#editadmission').on('submit', function (e) {
        e.preventDefault();
        var admissionCheck = $("#editadmission").valid();
        if (admissionCheck === true) {
            var form = this;
            $.ajax({
                url: $(form).attr('action'),
                method: $(form).attr('method'),
                data: new FormData(form),
                processData: false,
                dataType: 'json',
                contentType: false,
                success: function (data) {
                    if (data.code == 200) {
                        toastr.success(data.message);
                    } else {
                        toastr.error(data.message);
                    }
                }
            });
        }
    });

    // delete Student 
   $(document).on('click', '#deleteStudentBtn', function () {
    var id = $(this).data('id');
    var url = studentDelete;
    swal.fire({
        title: 'Are you sure?',
        html: 'You want to <b>delete</b> this Student',
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
                    $('#student-table').DataTable().ajax.reload(null, false);
                    toastr.success(data.message);
                } else {
                    toastr.error(data.message);
                }
            }, 'json');
        }
    });
});
});