$(function () {

    // change country
    $('#getCountry').on('change', function () {
        var country_id = $(this).val();
        $("#branch-form").find("#getState").empty();
        $("#branch-form").find("#getState").append('<option value="">Select State</option>');
        $("#branch-form").find("#getCity").empty();
        $("#branch-form").find("#getCity").append('<option value="">Select City</option>');
        $.post(getStates, { country_id: country_id }, function (res) {
            if (res.code == 200) {
                $.each(res.data, function (key, val) {
                    $("#branch-form").find("#getState").append('<option value="' + val.id + '">' + val.name + '</option>');
                });
                // if(country_id == ''){
                //     $("#branch-form").find("#getState").append('<option value="">Select State</option>');
                // }                    
            }
        }, 'json');
    });
    // change state
    $('#getState').on('change', function () {
        var state_id = $(this).val();
        $("#branch-form").find("#getCity").empty();
        $("#branch-form").find("#getCity").append('<option value="">Select City</option>');
        $.post(getCity, { state_id: state_id }, function (res) {
            if (res.code == 200) {
                $.each(res.data, function (key, val) {
                    $("#branch-form").find("#getCity").append('<option value="' + val.id + '">' + val.name + '</option>');
                });
                // if(country_id == ''){
                //     $("#branch-form").find("#getCity").append('<option value="">Select State</option>');
                // }                    
            }
        }, 'json');
    });

    // save branch-form
    $('#branch-form').on('submit', function (e) {
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
                    console.log("------")
                    console.log(data)
                    if (data.code == 200) {
                        $('#branch-table').DataTable().ajax.reload(null, false);
                        $('#branch-form')[0].reset();
                        toastr.success(data.message);
                        $('[href="#branch-list-tab"]').click();
                    } else {
                        toastr.error(data.message);
                    }

                }
            }
        });
    });

    // get all assign teacher table
    var table = $('#branch-table').DataTable({
        processing: true,
        info: true,
        ajax: branchList,
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
                data: 'name',
                name: 'name'
            },
            {
                data: 'school_name',
                name: 'school_name'
            },
            {
                data: 'email',
                name: 'email'
            },
            {
                data: 'mobile_no',
                name: 'mobile_no'
            },
            {
                data: 'currency',
                name: 'currency'
            },
            {
                data: 'symbol',
                name: 'symbol'
            },
            {
                data: 'country_name',
                name: 'country_name'
            },
            {
                data: 'state_name',
                name: 'state_name'
            },
            {
                data: 'city_name',
                name: 'city_name'
            },
            {
                data: 'address',
                name: 'address'
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

    // update branch-form
    $('#edit-branch-form').on('submit', function (e) {
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
                        $('#edit-branch-form')[0].reset();
                        toastr.success(data.message);
                        window.location.href = branchShow;
                    } else {
                        toastr.error(data.message);
                    }

                }
            }
        });
    });

    // delete branch
    $(document).on('click', '#deleteBranchBtn', function () {
        var id = $(this).data('id');
        var url = deleteBranch;
        swal.fire({
            title: 'Are you sure?',
            html: 'You want to <b>delete</b> this branch <br> <b>*Note:</b> This data will be permanently deleted',
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
                        $('#branch-table').DataTable().ajax.reload(null, false);
                        toastr.success(data.message);
                    } else {
                        toastr.error(data.message);
                    }
                }, 'json');
            }
        });
    });
});