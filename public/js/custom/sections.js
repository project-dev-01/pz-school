$(function () {

    // rules validation
    $("#sectionForm").validate({
        rules: {
            name: "required"
        }
    });
    // add section
    $('#sectionForm').on('submit', function (e) {
        e.preventDefault();
        var sectionValid = $("#sectionForm").valid();
        if (sectionValid === true) {
            var sectionName = $("#sectionName").val();
            var formData = new FormData();
            formData.append('token', token);
            formData.append('branch_id', branchID);
            formData.append('name', sectionName);

            $.ajax({
                url: sectionAddUrl,
                method: "post",
                data: formData,
                processData: false,
                dataType: 'json',
                contentType: false,
                success: function (data) {
                    if (data.code == 200) {
                        $('#section-table').DataTable().ajax.reload(null, false);
                        $('.addSection').modal('hide');
                        $('.addSection').find('form')[0].reset();
                        toastr.success(data.message);
                    } else {
                        $('.addSection').modal('hide');
                        $('.addSection').find('form')[0].reset();
                        toastr.error(data.message);
                    }
                }, error: function (err) {
                    toastr.error(err.responseJSON.data.error ? err.responseJSON.data.error : 'Something went wrong');
                }
            });
        }
    });


    // get all sections
    var table = $('#section-table').DataTable({
        processing: true,
        info: true,
        ajax: sectionList,
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
                data: 'actions',
                name: 'actions',
                orderable: false,
                searchable: false
            },
        ]
    }).on('draw', function () {
    });

    // // edit section
    $(document).on('click', '#editSectionBtn', function () {
        var section_id = $(this).data('id');
        $.post(sectionGetRowUrl, {
            section_id: section_id,
            token: token,
            branch_id: branchID
        }, function (data) {
            $('.editSection').find('input[name="sid"]').val(data.data.id);
            $('.editSection').find('input[name="name"]').val(data.data.name);
            $('.editSection').modal('show');
        }, 'json');
    });

    // update section
    $("#sectionEditForm").validate({
        rules: {
            name: "required"
        }
    });
    // update section
    $('#sectionEditForm').on('submit', function (e) {
        e.preventDefault();
        var sectionValid = $("#sectionEditForm").valid();
        if (sectionValid === true) {
            var sectionID = $("#sectionID").val();
            var sectionName = $("#editsectionName").val();
            var formData = new FormData();
            formData.append('sid', sectionID);
            formData.append('token', token);
            formData.append('branch_id', branchID);
            formData.append('name', sectionName);

            $.ajax({
                url: sectionUpdateUrl,
                method: "post",
                data: formData,
                processData: false,
                dataType: 'json',
                contentType: false,
                success: function (data) {
                    if (data.code == 200) {
                        $('#section-table').DataTable().ajax.reload(null, false);
                        $('.editSection').modal('hide');
                        $('.editSection').find('form')[0].reset();
                        toastr.success(data.message);
                    } else {
                        $('.editSection').modal('hide');
                        $('.editSection').find('form')[0].reset();
                        toastr.error(data.message);
                    }
                }, error: function (err) {
                    toastr.error(err.responseJSON.data.error ? err.responseJSON.data.error : 'Something went wrong');
                }
            });
        }
    });

    // delete section
    $(document).on('click', '#deleteSectionBtn', function () {
        var sid = $(this).data('id');
        swal.fire({
            title: 'Are you sure?',
            html: 'You want to <b>delete</b> this section',
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
                $.post(sectionDeleteUrl, {
                    sid: sid,
                    token: token,
                    branch_id: branchID
                }, function (data) {

                    if (data.code == 200) {
                        $('#section-table').DataTable().ajax.reload(null, false);
                        toastr.success(data.message);
                    } else {
                        toastr.error(data.message);
                    }

                }, 'json');
            }
        });
    });

});
