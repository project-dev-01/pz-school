$(function () {

    educationTable();
    $("#educationForm").validate({
        rules: {
            name: "required"
        }
    });
    $("#edit-education-form").validate({
        rules: {
            name: "required"
        }
    });
    // add education
    $('#educationForm').on('submit', function (e) {
        e.preventDefault();
        var educationCheck = $("#educationForm").valid();
        if (educationCheck === true) {
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
                        $('#education-table').DataTable().ajax.reload(null, false);
                        $('.addEducation').modal('hide');
                        $('.addEducation').find('form')[0].reset();
                        toastr.success(data.message);
                    } else {
                        toastr.error(data.message);
                    }
                }
            });
        }
    });

    // get all Education table
    function educationTable() {
         $('#education-table').DataTable({
            processing: true,
            info: true,
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
            ajax: educationList,
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
    $(document).on('click', '#editEducationBtn', function () {
        var id = $(this).data('id');
     
        $('.editEducation').find('form')[0].reset();   
        $.post(educationDetails, { id: id }, function (data) {
            $('.editEducation').find('input[name="id"]').val(data.data.id);
            $('.editEducation').find('input[name="name"]').val(data.data.name);
            $('.editEducation').modal('show');
        }, 'json');
        console.log(id);
    });
    // update Education
    $('#edit-education-form').on('submit', function (e) {
        e.preventDefault();
        var edt_educationCheck = $("#edit-education-form").valid();
        if (edt_educationCheck === true) {
      
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
                            $('#education-table').DataTable().ajax.reload(null, false);
                            $('.editEducation').modal('hide');
                            $('.editEducation').find('form')[0].reset();
                            toastr.success(data.message);
                        } else {
                            $('.editEducation').modal('hide');
                            $('.editEducation').find('form')[0].reset();
                            toastr.error(data.message);
                        }
                    }
                }
            });
        }
    });
    // delete EducationDelete
    $(document).on('click', '#deleteEducationBtn', function () {
        var id = $(this).data('id');
        var url = educationDelete;
        swal.fire({
            title: 'Are you sure?',
            html: 'You want to <b>delete</b> this Stream Type',
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
                        $('#education-table').DataTable().ajax.reload(null, false);
                        toastr.success(data.message);
                    } else {
                        toastr.error(data.message);
                    }
                }, 'json');
            }
        });
    });
});