$(function () {
    // add designation
    $('#designation-form').on('submit', function (e) {
        e.preventDefault();
        var form = this;
        $.ajax({
            url: $(form).attr('action'),
            method: $(form).attr('method'),
            data: new FormData(form),
            processData: false,
            dataType: 'json',
            contentType: false,
            beforeSend: function () {
                $(form).find('span.error-text').text('');
            },
            success: function (data) {
                if (data.code == 0) {
                    $.each(data.error, function (prefix, val) {
                        $(form).find('span.' + prefix + '_error').text(val[0]);
                    });
                } else {
                    if (data.code == 200) {
                        $('#designation-table').DataTable().ajax.reload(null, false);
                        $('.addDesignation').modal('hide');
                        $('.addDesignation').find('form')[0].reset();
                        toastr.success(data.message);
                    } else {
                        $('.addDesignation').modal('hide');
                        $('.addDesignation').find('form')[0].reset();
                        toastr.error(data.message);
                    }

                }
            }
        });
    });

    // get all designation table
    var table = $('#designation-table').DataTable({
        processing: true,
        info: true,
        ajax: designationList,
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
                data: 'branch_name',
                name: 'branch_name'
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
    // get row
    $(document).on('click', '#editDesignationBtn', function () {
        var id = $(this).data('id');
        $('.editDesignation').find('form')[0].reset();
        $('.editDesignation').find('span.error-text').text('');
        $.post(designationDetails, { id: id }, function (data) {
            console.log("888888888")
            console.log(data)
            $('.editDesignation').find('input[name="id"]').val(data.data.id);
            $('.editDesignation').find('input[name="name"]').val(data.data.name);
            $('.editDesignation').find('select[name="branch_id"]').val(data.data.branch_id);
            $('.editDesignation').modal('show');
        }, 'json');
    });
    // update designation
    $('#edit-designation-form').on('submit', function (e) {
        e.preventDefault();
        var form = this;
        $.ajax({
            url: $(form).attr('action'),
            method: $(form).attr('method'),
            data: new FormData(form),
            processData: false,
            dataType: 'json',
            contentType: false,
            beforeSend: function () {
                $(form).find('span.error-text').text('');
            },
            success: function (data) {
                if (data.code == 0) {
                    $.each(data.error, function (prefix, val) {
                        $(form).find('span.' + prefix + '_error').text(val[0]);
                    });
                } else {

                    if (data.code == 200) {
                        $('#designation-table').DataTable().ajax.reload(null, false);
                        $('.editDesignation').modal('hide');
                        $('.editDesignation').find('form')[0].reset();
                        toastr.success(data.message);
                    } else {
                        $('.editDesignation').modal('hide');
                        $('.editDesignation').find('form')[0].reset();
                        toastr.error(data.message);
                    }
                }
            }
        });
    });
    // delete DesignationDelete
    $(document).on('click', '#deleteDesignationBtn', function () {
        var id = $(this).data('id');
        var url = designationDelete;
        swal.fire({
            title: 'Are you sure?',
            html: 'You want to <b>delete</b> this designation',
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
                        $('#designation-table').DataTable().ajax.reload(null, false);
                        toastr.success(data.message);
                    } else {
                        toastr.error(data.message);
                    }
                }, 'json');
            }
        });
    });
});