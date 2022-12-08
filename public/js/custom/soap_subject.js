$(function () {
    // rules validation
    // $("#addSoapSubjectForm").validate({
    //     rules: {
    //         title: "required",
    //         header: "required",
    //         body: "required",
    //         soap_type_id: "required",
    //     }
    // });
    // save SoapSubject
    $('#addSoapSubjectForm').on('submit', function (e) {
        e.preventDefault();
        console.log('123')
        // var SoapSubjectCheck = $("#addSoapSubjectForm").valid();
        // if (SoapSubjectCheck === true) {
            // $("#overlay").fadeIn(300);
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
                        // $("#overlay").fadeOut(300);
                        $('.addSoapSubject').find('form')[0].reset();
                        toastr.success(data.message);
                        setTimeout(function () {
                            window.location.href = soapIndex;
                        }, 1000);
                    } else {
                        // $("#overlay").fadeOut(300);
                        toastr.error(data.message);
                    }
                }, error: function (err) {
                    // $("#overlay").fadeOut(300);
                    toastr.error(err.responseJSON.data.error ? err.responseJSON.data.error : 'Something went wrong');
                }
            });
        // }
    });

    // rules validation
    // $("#editSoapSubjectForm").validate({
    //     rules: {
    //         title: "required",
    //         header: "required",
    //         body: "required",
    //         soap_type_id: "required",
    //     }

    // });
    // edit SoapSubject
    $('#editSoapSubjectForm').on('submit', function (e) {
        e.preventDefault();
        // var SoapSubjectCheck = $("#editSoapSubjectForm").valid();
        // if (SoapSubjectCheck === true) {
            $("#overlay").fadeIn(300);
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
                        $("#overlay").fadeOut(300);
                        $('.editSoapSubject').find('form')[0].reset();
                        toastr.success(data.message);
                        setTimeout(function () {
                            window.location.href = soapIndex;
                        }, 1000);
                    } else {
                        $("#overlay").fadeOut(300);
                        toastr.error(data.message);
                    }
                }, error: function (err) {
                    $("#overlay").fadeOut(300);
                    toastr.error(err.responseJSON.data.error ? err.responseJSON.data.error : 'Something went wrong');
                }
            });
        // }
    });

    // delete Employee
    $(document).on('click', '.deleteSoapSubjectBtn', function () {
        var id = $(this).data('id');
        var url = soapSubjectDelete;
        swal.fire({
            title: 'Are you sure?',
            html: 'You want to <b>Delete</b> this Record',
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
                        $('#employee-table').DataTable().ajax.reload(null, false);
                        toastr.success(data.message);
                    } else {
                        toastr.error(data.message);
                    }
                }, 'json');
            }
        });
    });
});