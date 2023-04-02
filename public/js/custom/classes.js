$(function () {

    // rules validation
    $("#classSubmit").validate({
        rules: {
            name: "required",
            short_name: "required"
        }
    });
    // add classes
    $('#classSubmit').on('submit', function (e) {
        e.preventDefault();
        var classValid = $("#classSubmit").valid();
        if (classValid === true) {
            var className = $("#className").val();
            var nameNumeric = $("#nameNumeric").val();
            var short_name = $("#short_name").val();
            var formData = new FormData();
            formData.append('token', token);
            formData.append('branch_id', branchID);
            formData.append('name', className);
            formData.append('short_name', short_name);
            formData.append('name_numeric', nameNumeric);
            $.ajax({
                url: classesAddUrl,
                method: "post",
                data: formData,
                processData: false,
                dataType: 'json',
                contentType: false,
                success: function (data) {
                    console.log(data)
                    if (data.code == 200) {
                        $('#class-table').DataTable().ajax.reload(null, false);
                        $('.addClassModal').modal('hide');
                        $('.addClassModal').find('form')[0].reset();
                        toastr.success(data.message);
                    } else {
                        $('.addClassModal').modal('hide');
                        $('.addClassModal').find('form')[0].reset();
                        toastr.error(data.message);
                    }
                }, error: function (err) {
                    toastr.error(err.responseJSON.data.error ? err.responseJSON.data.error : 'Something went wrong');
                }
            });
        }
    });

    // edit class

    $(document).on('click', '#editClassBtn', function () {
        var class_id = $(this).data('id');
        $.post(classesGetRowUrl, {
            class_id: class_id,
            token: token,
            branch_id: branchID
        }, function (data) {
            $('.editClassModal').find('input[name="class_id"]').val(data.data.id);
            $('.editClassModal').find('input[name="name"]').val(data.data.name);
            $('.editClassModal').find('input[name="short_name"]').val(data.data.short_name);
            $('.editClassModal').find('input[name="name_numeric"]').val(data.data.name_numeric);
            $('.editClassModal').modal('show');
        }, 'json');
    });

    // update class
    $("#classesUpdateForm").validate({
        rules: {
            name: "required",
            short_name: "required"
        }
    });
    // update class
    $('#classesUpdateForm').on('submit', function (e) {
        e.preventDefault();
        var sectionValid = $("#classesUpdateForm").valid();
        if (sectionValid === true) {
            var classID = $("#classID").val();
            var editclassName = $("#editclassName").val();
            var editnameNumeric = $("#editnameNumeric").val();
            var edit_short_name = $("#edit_short_name").val();
            var formData = new FormData();
            formData.append('class_id', classID);
            formData.append('token', token);
            formData.append('branch_id', branchID);
            formData.append('name', editclassName);
            formData.append('short_name', edit_short_name);
            formData.append('name_numeric', editnameNumeric);

            $.ajax({
                url: classesUpdateUrl,
                method: "post",
                data: formData,
                processData: false,
                dataType: 'json',
                contentType: false,
                success: function (data) {
                    if (data.code == 200) {
                        $('#class-table').DataTable().ajax.reload(null, false);
                        $('.editClassModal').modal('hide');
                        $('.editClassModal').find('form')[0].reset();
                        toastr.success(data.message);
                    } else {
                        $('.editClassModal').modal('hide');
                        $('.editClassModal').find('form')[0].reset();
                        toastr.error(data.message);
                    }
                }, error: function (err) {
                    toastr.error(err.responseJSON.data.error ? err.responseJSON.data.error : 'Something went wrong');
                }
            });
        }
    });

    // delete form
    $(document).on('click', '#deleteClassBtn', function () {
        var class_id = $(this).data('id');
        var url = classDeleteUrl;
        swal.fire({
            title: 'Are you sure?',
            html: 'You want to <b>delete</b> this Grade',
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
                    class_id: class_id,
                    token: token,
                    branch_id: branchID
                }, function (data) {

                    if (data.code == 200) {
                        $('#class-table').DataTable().ajax.reload(null, false);
                        toastr.success(data.message);
                    } else {
                        toastr.error(data.message);
                    }
                }, 'json');
            }
        });
    });

    //GET ALL CLASSES
    var table = $('#class-table').DataTable({
        processing: true,
        info: true,
        // dom: 'lBfrtip',
        dom: "<'row'<'col-sm-2 col-md-2'l><'col-sm-4 col-md-4'B><'col-sm-6 col-md-6'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-6'i><'col-sm-6'p>>",
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
        ajax: classList,
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
                data: 'name_numeric',
                name: 'name_numeric'
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