$(function () {

    $("#student").hide();
    var father_id = $("#father_id").val();
    if (father_id) {
        father(father_id);
    }

    var mother_id = $("#mother_id").val();
    if (mother_id) {
        mother(mother_id);
    }

    var guardian_id = $("#guardian_id").val();
    if (guardian_id) {
        guardian(guardian_id);
    }

    $("#admission_date").datepicker({
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
        autoclose: true,
    });
    $("#dob").datepicker({
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
        autoclose: true,
    });

    $('#guardian_name').keyup(function () {
        var name = $(this).val();
        if (name != '') {
            $.ajax({
                url: parentName,
                method: "GET",
                data: { token: token, branch_id: branchID, name: name },
                success: function (data) {
                    $('#guardian_list').fadeIn();
                    $('#guardian_list').html(data);
                }
            });
        }
    });

    $('#guardian_list').on('click', 'li', function () {

        $('#guardian_name').val($(this).text());
        $('#guardian_list').fadeOut();
        var value = $(this).text();
        if (value == "No results Found") {
            $('#guardian_name').val("");
            $("#guardian_form").hide("slow");
            $("#guardian_photo").hide();

        } else {
            var id = $(this).val();
            guardian(id);
        }
    });

    function guardian(id) {
        $('#guardian_id').val(id);
        $("#guardian_form").show("slow");
        $("#guardian_info").show();
        $("#guardian_photo").show();
        $.post(parentDetails, { token: token, branch_id: branchID, id: id }, function (res) {
            if (res.code == 200) {
                var data = res.data.parent;
                if (data.photo) {
                    var src = parentImg + "/" + data.photo;
                } else {
                    var src = defaultImg;
                }
                var name = data.first_name + " " + data.last_name;
                $('#guardian_name').val(name);
                $("#guardian_photo").html('<img src="' + src + '" class="img-fluid d-block rounded" style="width:100px" />');
                $("#guardian_first_name").val(data.first_name);
                $("#guardian_last_name").val(data.last_name);
                $("#guardian_email").val(data.email);
                $("#guardian_nric").val(data.nric);
                $("#guardian_gender").val(data.gender);
                $("#guardian_date_of_birth").val(data.date_of_birth);
                $("#guardian_passport").val(data.passport);
                $("#guardian_country").val(data.country);
                $("#guardian_post_code").val(data.post_code);
                $("#guardian_address_2").val(data.address_2);
                $("#guardian_occupation").val(data.occupation);
                $("#guardian_income").val(data.income);
                $("#guardian_blooddgrp").val(data.blood_group);
                $("#guardian_education").val(data.education);
                $("#guardian_mobile_no").val(data.mobile_no);
                $("#guardian_state").val(data.state);
                $("#guardian_city").val(data.city);
                $("#guardian_address").val(data.address);

                $(".guardian_name").html(name);
                $(".guardian_date_of_birth").html(data.date_of_birth);
                $(".guardian_email").html(data.email);
                $(".guardian_passport").html(data.passport);
                $(".guardian_country").html(data.country);
                $(".guardian_post_code").html(data.post_code);
                $(".guardian_address_2").html(data.address_2);
                $(".guardian_nric").html(data.nric);
                $(".guardian_occupation").html(data.occupation);
                $(".guardian_income").html(data.income);
                $(".guardian_blood_group").html(data.blood_group);
                $(".guardian_education").html(data.education);
                $(".guardian_mobile_no").html(data.mobile_no);
                $(".guardian_state").html(data.state);
                $(".guardian_city").html(data.city);
                $(".guardian_address").html(data.address);
            }
        }, 'json');
    }
    $('#father_name').keyup(function () {
        var name = $(this).val();
        if (name != '') {
            $.ajax({
                url: parentName,
                method: "GET",
                data: { token: token, branch_id: branchID, name: name },
                success: function (data) {
                    $('#father_list').fadeIn();
                    $('#father_list').html(data);
                }
            });
        }
    });

    $('#father_list').on('click', 'li', function () {

        $('#father_name').val($(this).text());
        $('#father_list').fadeOut();
        var value = $(this).text();
        if (value == "No results Found") {
            $('#father_name').val("");
            $("#father_form").hide("slow");
            $("#father_photo").hide();

        } else {
            var id = $(this).val();
            father(id);
        }
    });

    function father(id) {
        $('#father_id').val(id);
        $("#father_form").show("slow");
        $("#father_info").show();
        $("#father_photo").show();
        $.post(parentDetails, { token: token, branch_id: branchID, id: id }, function (res) {
            if (res.code == 200) {
                var data = res.data.parent;
                if (data.photo) {
                    var src = parentImg + "/" + data.photo;
                } else {
                    var src = defaultImg;
                }
                var name = data.first_name + " " + data.last_name;
                $('#father_name').val(name);
                $("#father_photo").html('<img src="' + src + '" class="img-fluid d-block rounded" style="width:100px" />');
                $("#father_first_name").val(data.first_name);
                $("#father_last_name").val(data.last_name);
                $("#father_email").val(data.email);
                $("#father_gender").val(data.gender);
                $("#father_date_of_birth").val(data.date_of_birth);
                $("#father_passport").val(data.passport);
                $("#father_country").val(data.country);
                $("#father_post_code").val(data.post_code);
                $("#father_address_2").val(data.address_2);
                $("#father_nric").val(data.nric);
                $("#father_occupation").val(data.occupation);
                $("#father_income").val(data.income);
                $("#father_blooddgrp").val(data.blood_group);
                $("#father_education").val(data.education);
                $("#father_mobile_no").val(data.mobile_no);
                $("#father_state").val(data.state);
                $("#father_city").val(data.city);
                $("#father_address").val(data.address);



                $(".father_name").html(name);
                $(".father_date_of_birth").html(data.date_of_birth);
                $(".father_email").html(data.email);
                $(".father_passport").html(data.passport);
                $(".father_country").html(data.country);
                $(".father_post_code").html(data.post_code);
                $(".father_address_2").html(data.address_2);
                $(".father_nric").html(data.nric);
                $(".father_occupation").html(data.occupation);
                $(".father_income").html(data.income);
                $(".father_blood_group").html(data.blood_group);
                $(".father_education").html(data.education);
                $(".father_mobile_no").html(data.mobile_no);
                $(".father_state").html(data.state);
                $(".father_city").html(data.city);
                $(".father_address").html(data.address);
            }
        }, 'json');
    }

    $('#mother_name').keyup(function () {
        var name = $(this).val();
        if (name != '') {
            $.ajax({
                url: parentName,
                method: "GET",
                data: { token: token, branch_id: branchID, name: name },
                success: function (data) {
                    $('#mother_list').fadeIn();
                    $('#mother_list').html(data);
                }
            });
        }
    });

    $('#mother_list').on('click', 'li', function () {

        $('#mother_name').val($(this).text());
        $('#mother_list').fadeOut();
        var value = $(this).text();
        if (value == "No results Found") {
            $('#mother_name').val("");
            $("#mother_form").hide("slow");
            $("#mother_photo").hide();

        } else {
            var id = $(this).val();
            mother(id);
        }
    });

    function mother(id) {
        $('#mother_id').val(id);
        $("#mother_form").show("slow");
        $("#mother_photo").show();
        $("#mother_info").show();
        $.post(parentDetails, { token: token, branch_id: branchID, id: id }, function (res) {
            if (res.code == 200) {
                var data = res.data.parent;
                if (data.photo) {
                    var src = parentImg + "/" + data.photo;
                } else {
                    var src = defaultImg;
                }
                var name = data.first_name + " " + data.last_name;
                $('#mother_name').val(name);
                $("#mother_photo").html('<img src="' + src + '" class="img-fluid d-block rounded" style="width:100px" />');
                $("#mother_first_name").val(data.first_name);
                $("#mother_last_name").val(data.last_name);
                $("#mother_email").val(data.email);
                $("#mother_gender").val(data.gender);
                $("#mother_date_of_birth").val(data.date_of_birth);
                $("#mother_passport").val(data.passport);
                $("#mother_country").val(data.country);
                $("#mother_post_code").val(data.post_code);
                $("#mother_address_2").val(data.address_2);
                $("#mother_nric").val(data.nric);
                $("#mother_occupation").val(data.occupation);
                $("#mother_income").val(data.income);
                $("#mother_blooddgrp").val(data.blood_group);
                $("#mother_education").val(data.education);
                $("#mother_mobile_no").val(data.mobile_no);
                $("#mother_state").val(data.state);
                $("#mother_city").val(data.city);
                $("#mother_address").val(data.address);

                $(".mother_name").html(name);
                $(".mother_date_of_birth").html(data.date_of_birth);
                $(".mother_email").html(data.email);
                $(".mother_passport").html(data.passport);
                $(".mother_country").html(data.country);
                $(".mother_post_code").html(data.post_code);
                $(".mother_address_2").html(data.address_2);
                $(".mother_nric").html(data.nric);
                $(".mother_occupation").html(data.occupation);
                $(".mother_income").html(data.income);
                $(".mother_blood_group").html(data.blood_group);
                $(".mother_education").html(data.education);
                $(".mother_mobile_no").html(data.mobile_no);
                $(".mother_state").html(data.state);
                $(".mother_city").html(data.city);
                $(".mother_address").html(data.address);
            }
        }, 'json');
    }
    // rules validation
    $("#StudentFilter").validate({
        rules: {
            session_id: "required"
        }
    });

    // get student list
    $('#StudentFilter').on('submit', function (e) {
        e.preventDefault();
        var StudentFilter = $("#StudentFilter").valid();
        if (StudentFilter === true) {
            $("#student").show("slow");
            $('#student-table').DataTable({
                processing: true,
                info: true,
                bDestroy: true,
                // dom: 'lBfrtip',
                dom: "<'row'<'col-sm-2 col-md-2'l><'col-sm-4 col-md-4'B><'col-sm-6 col-md-6'f>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-6'i><'col-sm-6'p>>",
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
                serverSide: true,
                ajax: {
                    url: studentList,
                    data: function (d) {
                        d.student_name = $('#student_name').val(),
                            d.class_id = $('#class_id').val(),
                            d.section_id = $('#section_id').val(),
                            d.session_id = $('#session_id').val()
                    }
                },
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
                    }
                    ,
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'register_no',
                        name: 'register_no'
                    },
                    {
                        data: 'roll_no',
                        name: 'roll_no'
                    },
                    {
                        data: 'gender',
                        name: 'gender'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'actions',
                        name: 'actions',
                        orderable: false,
                        searchable: false
                    },
                ],
                columnDefs: [
                    {
                        "targets": 1,
                        "className": "table-user",
                        "render": function (data, type, row, meta) {
                            var currentImg = studentImg + '/' + row.photo;
                            // var existUrl = UrlExists(currentImg);
                            // console.log(currentImg);
                            var img = (row.photo != null) ? studentImg + '/' + row.photo : defaultImg;
                            var first_name = '<img src="' + img + '" class="mr-2 rounded-circle">' +
                                '<a href="javascript:void(0);" class="text-body font-weight-semibold">' + data + '</a>';
                            return first_name;
                        }
                    },
                ]
            });
        } else {
            $("#student").hide("slow");
        }

    });

    $("#class_id").on('change', function (e) {
        e.preventDefault();
        var class_id = $(this).val();
        $("#section_id").empty();
        $("#section_id").append('<option value="">Select Class Name</option>');
        $.post(sectionByClass, { class_id: class_id }, function (res) {
            if (res.code == 200) {
                $.each(res.data, function (key, val) {
                    $("#section_id").append('<option value="' + val.section_id + '">' + val.section_name + '</option>');
                });
            }
        }, 'json');
    });


    $("#editadmission").validate({
        rules: {
            btwyears: "required",
            txt_regiter_no: "required",
            txt_emailid: {
                required: true,
                email: true
            },
            txt_roll_no: "required",
            admission_date: "required",
            classnames: "required",
            categy: "required",
            fname: "required",
            txt_mobile_no: "required",
            present_address: "required",
            // txt_pwd: {
            //     minlength: 6
            // },
            // txt_retype_pwd: {
            //     minlength: 6,
            //     equalTo: "txt_pwd"
            // },  
            password: {
                // required: $("#password").val().length > 0,
                minlength: 6
            },
            confirm_password: {
                // required: $("#confirm_password").val().length > 0,
                minlength: 6,
                equalTo: "#password"
            }
        }
    });

    $('#editadmission').on('submit', function (e) {
        e.preventDefault();
        var admissionCheck = $("#editadmission").valid();
        if (admissionCheck === true) {
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
                        toastr.success(data.message);
                        window.location.href = indexStudent;
                    } else {
                        toastr.error(data.message);
                    }
                }
            });
        }
    });

    // delete Student 
    $(document).on('click', '#deleteStudentBtn', function () {
        var id = $(this).data('id');
        var url = studentDelete;
        swal.fire({
            title: 'Are you sure?',
            html: 'You want to <b>delete</b> this Student',
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
                        $("#student").show("slow");
                        $('#student_table').DataTable().ajax.reload(null, false);
                        toastr.success(data.message);
                    } else {
                        $("#student").hide("slow");
                        toastr.error(data.message);
                    }
                }, 'json');
            }
        });
    });

    $("#drp_transport_route").on('change', function (e) {
        e.preventDefault();
        var route_id = $(this).val();
        $("#drp_transport_vechicleno").empty();
        $("#drp_transport_vechicleno").append('<option value="">Select Vehicle</option>');
        $.post(vehicleByRoute, { route_id: route_id }, function (res) {
            if (res.code == 200) {
                $.each(res.data, function (key, val) {
                    $("#drp_transport_vechicleno").append('<option value="' + val.vehicle_id + '">' + val.vehicle_no + '</option>');
                });
            }
        }, 'json');
    });



    $("#drp_hostelnam").on('change', function (e) {
        e.preventDefault();
        var hostel_id = $(this).val();
        $("#drp_roomname").empty();
        $("#drp_roomname").append('<option value="">Select Room</option>');
        $.post(roomByHostel, { hostel_id: hostel_id }, function (res) {
            if (res.code == 200) {
                $.each(res.data, function (key, val) {
                    $("#drp_roomname").append('<option value="' + val.room_id + '">' + val.room_name + '</option>');
                });
            }
        }, 'json');
    });
});