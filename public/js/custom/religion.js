$(function () {

    religionTable();
    $("#religionForm").validate({
        rules: {
            name: "required"
        }
    });
    $("#edit-religion-form").validate({
        rules: {
            name: "required"
        }
    });
    // add religion
    $('#religionForm').on('submit', function (e) {
        e.preventDefault();
        var religionCheck = $("#religionForm").valid();
        if (religionCheck === true) {
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
                        $('#religion-table').DataTable().ajax.reload(null, false);
                        $('.addReligion').modal('hide');
                        $('.addReligion').find('form')[0].reset();
                        toastr.success(data.message);
                    } else {
                        toastr.error(data.message);
                    }
                }
            });
        }
    });

    // get all Religion table
    function religionTable() {
         $('#religion-table').DataTable({
            processing: true,
            info: true,
            dom: 'lBfrtip',
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
            ajax: religionList,
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
    $(document).on('click', '#editReligionBtn', function () {
        var id = $(this).data('id');
     
        $('.editReligion').find('form')[0].reset();   
        $.post(religionDetails, { id: id }, function (data) {
            $('.editReligion').find('input[name="id"]').val(data.data.id);
            $('.editReligion').find('input[name="name"]').val(data.data.name);
            $('.editReligion').modal('show');
        }, 'json');
        console.log(id);
    });
    // update Religion
    $('#edit-religion-form').on('submit', function (e) {
        e.preventDefault();
        var edt_religionCheck = $("#edit-religion-form").valid();
        if (edt_religionCheck === true) {
      
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
                            $('#religion-table').DataTable().ajax.reload(null, false);
                            $('.editReligion').modal('hide');
                            $('.editReligion').find('form')[0].reset();
                            toastr.success(data.message);
                        } else {
                            $('.editReligion').modal('hide');
                            $('.editReligion').find('form')[0].reset();
                            toastr.error(data.message);
                        }
                    }
                }
            });
        }
    });
    // delete ReligionDelete
    $(document).on('click', '#deleteReligionBtn', function () {
        var id = $(this).data('id');
        var url = religionDelete;
        swal.fire({
            title: 'Are you sure?',
            html: 'You want to <b>delete</b> this Religion',
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
                        $('#religion-table').DataTable().ajax.reload(null, false);
                        toastr.success(data.message);
                    } else {
                        toastr.error(data.message);
                    }
                }, 'json');
            }
        });
    });
});