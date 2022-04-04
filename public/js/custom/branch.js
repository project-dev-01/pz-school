$(function () {

    var country_id = "";
    var state_id = "";
    var city_id = "";
    branchTable(country_id, state_id, city_id);


    // change country
    $('#country').on('change', function () {
        var country_id = $(this).val();
        $("#filter").find("#state").empty();
        $("#filter").find("#state").append('<option value="">Select State</option>');
        $("#filter").find("#city").empty();
        $("#filter").find("#city").append('<option value="">Select City</option>');
        $.post(getStates, { country_id: country_id }, function (res) {
            console.log('df', res)
            if (res.code == 200) {
                $.each(res.data, function (key, val) {
                    $("#filter").find("#state").append('<option value="' + val.id + '">' + val.name + '</option>');
                });
                // if(country_id == ''){
                //     $("#branch-form").find("#getState").append('<option value="">Select State</option>');
                // }                    
            }
        }, 'json');
    });
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
    $('#editGetCountry').on('change', function () {
        var country_id = $(this).val();
        $("#edit-branch-form").find("#editGetState").empty();
        $("#edit-branch-form").find("#editGetState").append('<option value="">Select State</option>');
        $("#edit-branch-form").find("#editGetCity").empty();
        $("#edit-branch-form").find("#editGetCity").append('<option value="">Select City</option>');
        $.post(getStates, { country_id: country_id }, function (res) {
            if (res.code == 200) {
                $.each(res.data, function (key, val) {
                    $("#edit-branch-form").find("#editGetState").append('<option value="' + val.id + '">' + val.name + '</option>');
                });
                // if(country_id == ''){
                //     $("#branch-form").find("#getState").append('<option value="">Select State</option>');
                // }                    
            }
        }, 'json');
    });
    // change state
    $('#state').on('change', function () {
        var state_id = $(this).val();
        $("#filter").find("#city").empty();
        $("#filter").find("#city").append('<option value="">Select City</option>');
        $.post(getCity, { state_id: state_id }, function (res) {
            if (res.code == 200) {
                $.each(res.data, function (key, val) {
                    $("#filter").find("#city").append('<option value="' + val.id + '">' + val.name + '</option>');
                });
                // if(country_id == ''){
                //     $("#branch-form").find("#getCity").append('<option value="">Select State</option>');
                // }                    
            }
        }, 'json');
    });

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

    $('#editGetState').on('change', function () {
        var state_id = $(this).val();
        $("#edit-branch-form").find("#editGetCity").empty();
        $("#edit-branch-form").find("#editGetCity").append('<option value="">Select City</option>');
        $.post(getCity, { state_id: state_id }, function (res) {
            if (res.code == 200) {
                $.each(res.data, function (key, val) {
                    $("#edit-branch-form").find("#editGetCity").append('<option value="' + val.id + '">' + val.name + '</option>');
                });
                // if(country_id == ''){
                //     $("#branch-form").find("#getCity").append('<option value="">Select State</option>');
                // }                    
            }
        }, 'json');
    });

    // save branch-form
    $('#branch-filter').on('click', function (e) {
        e.preventDefault();
        country_id = $("#country").val();
        state_id = $("#state").val();
        city_id = $("#city").val();

        console.log('dh', country_id)

        branchTable(country_id, state_id, city_id);
    });

    // rules validation
    $("#branch-form").validate({
        rules: {
            name: "required",
            school_name: "required",
            email: {
                required: true,
                email: true
            },
            password: "required",
            mobile_no: "required",
            currency: "required",

            symbol: "required",
            country: "required",
            state: "required",
            city: "required",
            db_name: "required",
            db_username: "required",
            // db_password: "required",
            address: "required"
        }
    });
    //
    $('#branch-form').on('submit', function (e) {
        e.preventDefault();
        // $('#saveBranch').prop('disabled', true);
        var branchCheck = $("#branch-form").valid();
        if (branchCheck === true) {
            var form = this;
            $.ajax({
                url: $(form).attr('action'),    
                method: $(form).attr('method'),
                data: new FormData(form),
                processData: false,
                dataType: 'json',
                contentType: false,
                success: function (data) {
                    console.log("------")
                    console.log(data)
                    if (data.code == 200) {
                        // $('#saveBranch').prop('disabled', false);

                        // $('#branch-table').DataTable().ajax.reload(null, false);
                        $('#branch-form')[0].reset();
                        toastr.success(data.message);
                        // $('[href="#branch-list-tab"]').click();
                        window.location.href = branchShow;
                    } else {
                        // $('#saveBranch').prop('disabled', false);

                        toastr.error(data.message);
                    }
                }
            });
        }
    });


    // get all assign teacher table
    function branchTable(country, state, city) {
        $('#branch-table').DataTable({
            processing: true,
            bDestroy: true,
            // dom: 'Bfrtip',
            // buttons: [
            //     'copyHtml5',
            //     'excelHtml5',
            //     'csvHtml5',
            //     'pdfHtml5'
            // ],
            info: true,
            "ajax": {
                url: branchList,
                cache: false,
                dataType: "json",
                // data: { month:getSelectedMonth },
                // data: formData,
                data: { country_id: country, state_id: state, city_id: city },
                type: "GET",
                // contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
                // processData: true, // NEEDED, DON'T OMIT THIS
                // headers: {
                // 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                // },
                "dataSrc": function (json) {
                    console.log("losing json");
                    console.log(json);
                    return json.data;
                },
                error: function (error) {
                    console.log("error")
                    console.log(error)
                    // noDataAvailable(error);
                }
            },

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
    }

    // rules validation
    $("#edit-branch-form").validate({
        rules: {
            name: "required",
            school_name: "required",
            mobile_no: "required",
            currency: "required",
            symbol: "required",
            country: "required",
            state: "required",
            city: "required",
        }
    });
    // update branch-form
    $('#edit-branch-form').on('submit', function (e) {
        e.preventDefault();
        var branchCheck = $("#edit-branch-form").valid();
        if (branchCheck === true) {
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
                        $('#edit-branch-form')[0].reset();
                        toastr.success(data.message);
                        window.location.href = branchShow;
                    } else {
                        toastr.error(data.message);
                    }
                }
            });
        }
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