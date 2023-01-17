$(function () {

    $("#btwyears").on('change', function (e) {
        e.preventDefault();
        $('#class_id').val("");
        $("#section_id").empty();
        $("#section_id").append('<option value="">Select Class</option>');
        $("#student_id").empty();
        $("#student_id").append('<option value="">Select Student</option>');
        $('#payment_item').val("");
        $('#payment_status').val("");
    });

    $("#class_id").on('change', function (e) {
        e.preventDefault();
        var class_id = $(this).val();
        $("#section_id").empty();
        $("#section_id").append('<option value="">Select Class</option>');
        $.post(sectionByClass, { token: token, branch_id: branchID, class_id: class_id }, function (res) {
            if (res.code == 200) {
                $.each(res.data, function (key, val) {
                    $("#section_id").append('<option value="' + val.section_id + '">' + val.section_name + '</option>');
                });
            }
        }, 'json');
    });


    $("#section_id").on('change', function (e) {
        e.preventDefault();
        var academic_session_id = $("#btwyears").val();
        var class_id = $("#class_id").val();
        var section_id = $(this).val();
        $("#student_id").empty();
        $("#student_id").append('<option value="">Select Student</option>');
        $.post(getStudentList, { token: token, branch_id: branchID, class_id: class_id, academic_session_id: academic_session_id, section_id: section_id }, function (res) {
            if (res.code == 200) {
                $.each(res.data, function (key, val) {
                    $("#student_id").append('<option value="' + val.id + '">' + val.name + '</option>');
                });
            }
        }, 'json');
    });

    // rules validation
    $("#filterFeesAllocation").validate({
        rules: {
            class_id: "required",
            section_id: "required",
            year: "required"
        }
    });
    //
    $('#filterFeesAllocation').on('submit', function (e) {
        e.preventDefault();
        var valid = $("#filterFeesAllocation").valid();
        if (valid === true) {
            var classID = $("#class_id").val();
            var sectionID = $("#section_id").val();
            var year = $("#btwyears").val();

            var formData = new FormData();
            formData.append('token', token);
            formData.append('branch_id', branchID);
            formData.append('class_id', classID);
            formData.append('section_id', sectionID);
            formData.append('academic_session_id', year);
            $("#overlay").fadeIn(300);
            $.ajax({
                url: getFeesAllocatedStudents,
                method: "post",
                data: formData,
                processData: false,
                dataType: 'json',
                contentType: false,
                success: function (response) {
                    if (response.code == 200) {
                        var dataSetNew = response.data;
                        $(".getFessStudentsHideShow").show("slow");
                        // set group id
                        // $("#getFessStudentsGroupID").val(groupID);
                        getFess(dataSetNew);
                        $("#overlay").fadeOut(300);
                    } else {
                        toastr.error(response.message);
                        $("#overlay").fadeOut(300);
                    }
                }
            });

        }
    });

    function getFess(dataSetNew) {
        $('#getFessStudents').DataTable().clear().destroy();
        $('#getFessStudents td').empty();
        listTable = $('#getFessStudents').DataTable({
            processing: true,
            bDestroy: true,
            info: true,
            dom: 'lBfrtip',
            paging: false,
            "bSort": false,
            buttons: [],
            data: dataSetNew,
            "pageLength": 10,
            "aLengthMenu": [
                [5, 10, 25, 50, -1],
                [5, 10, 25, 50, "All"]
            ],
            columns: [
                {
                    data: 'student_id'
                },
                {
                    data: 'class_name'
                },
                {
                    data: 'section_name'
                },
                {
                    data: 'name'
                },
                {
                    data: 'feegroup'
                },
                {
                    data: 'allocation_id'
                },
                {
                    data: 'email'
                }
            ],
            columnDefs: [
                {
                    "targets": 0,
                    "render": function (data, type, row, meta) {
                        return meta.row + 1;
                    }
                },
                {
                    "targets": 3,
                    "className": "table-user",
                    "render": function (data, type, row, meta) {
                        var img = "";
                        if (row.photo) {
                            img = studentImg + '/' + row.photo;
                        } else {
                            img = defaultImg;
                        }
                        var first_name = '<img src="' + img + '" class="mr-2 rounded-circle">' +
                            '<a href="javascript:void(0);" class="text-body font-weight-semibold">' + data + '</a>';
                        return first_name;
                    }
                },
                {
                    "targets": 4,
                    "render": function (data, type, row, meta) {
                        var fsGroup = "";
                        data.forEach(function (day) {
                            fsGroup += "- " + day['name'];

                        })
                        return fsGroup;
                    }
                },
                {
                    "targets": 5,
                    "render": function (data, type, row, meta) {
                        var status = '<div class="badge label-table badge-warning">Pending</div>';
                        return status;
                    }
                },
                {
                    "targets": 6,
                    "render": function (data, type, row, meta) {
                        var action = '<div class="button-list">' +
                            '<a href = "javascript:void(0)" class="btn btn-blue btn-sm waves-effect waves-light"> <i class="fe-edit"></i></a>' +
                            '<a href="javascript:void(0)" class="btn btn-danger waves-effect waves-light" data-id="" id="deleteFeesGroupBtn"><i class="fe-trash-2"></i></a>' +
                            '</div>';
                        return action;
                    }
                }

            ]
        }).on('draw', function () {
        });
    }
});