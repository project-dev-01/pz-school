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
        // dom: 'lBfrtip',
        dom: "<'row'<'col-sm-2 col-md-2'l><'col-sm-4 col-md-4'B><'col-sm-6 col-md-6'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-6'i><'col-sm-6'p>>",
        // dom:"<'row'<'col-sm-2'l><'col-sm-2'B><'col-sm-4'><'col-sm-4'f>>" +
        //             "<'row'<'col-sm-12'tr>>" +
        //             "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        buttons: [
            {
                extend: 'csv',
                text: 'Download CSV',
                extension: '.csv',
                exportOptions: {
                    columns: 'th:not(:last-child)'
                }
            },
            {
                extend: 'pdf',
                text: 'Download PDF',
                extension: '.pdf',
                exportOptions: {
                    columns: 'th:not(:last-child)'
                }

            }
        ],
        ajax: sectionList,
        "pageLength": 10,
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
                data: 'id',
                name: 'id'
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
