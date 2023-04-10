$(function () {

    // rules validation
    $("#designation-form").validate({
        rules: {
            name: "required",
        }
    });
    // add designation
    $('#designation-form').on('submit', function (e) {
        e.preventDefault();
        var designationCheck = $("#designation-form").valid();
        if (designationCheck === true) {
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
            });
        }
    });

    // get all designation table for admin
    var table = $('#designation-table').DataTable({
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
        ajax: designationList,
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
        $.post(designationDetails, { id: id }, function (data) {
            $('.editDesignation').find('input[name="id"]').val(data.data.id);
            $('.editDesignation').find('input[name="name"]').val(data.data.name);
            $('.editDesignation').modal('show');
        }, 'json');
    });

     // rules validation
     $("#edit-designation-form").validate({
        rules: {
            name: "required",
        }
    });
    // update designation
    $('#edit-designation-form').on('submit', function (e) {
        e.preventDefault();
        var designationCheck = $("#edit-designation-form").valid();
        if (designationCheck === true) {
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
            });
        }
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