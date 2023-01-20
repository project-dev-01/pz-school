$(function () {
    $(".date-picker").datepicker({
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
        autoclose: true,
    });
    $(".payment_mode").on('change', function (e) {
        e.preventDefault();
        $(".payment_clear").hide();
        var cd = $(this).val();
        
        $(".payment_"+cd).show();
        console.log('cd',cd)
    });
    $("#btwyears").on('change', function (e) {
        e.preventDefault();
        $('#class_id').val("");
        $("#section_id").empty();
        $("#section_id").append('<option value="">Select Class</option>');
        $("#student_id").empty();
        $("#student_id").append('<option value="">Select Student</option>');
        $('#fees_type').val("");
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
            var student_id = $("#student_id").val();

            var formData = new FormData();
            formData.append('token', token);
            formData.append('branch_id', branchID);
            formData.append('class_id', classID);
            formData.append('section_id', sectionID);
            formData.append('academic_session_id', year);
            formData.append('student_id', student_id);
            loadTable(formData);

        }
    });
    function loadTable(formData) {
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
                    data: 'status'
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
                            fsGroup += "- " + day['name'] + "<br>";
                        })
                        return fsGroup;
                    }
                },
                {
                    "targets": 5,
                    "render": function (data, type, row, meta) {
                        var status = ""
                        if (data == 'unpaid') {
                            status = 'badge-danger';
                        } else if (data == 'paid') {
                            status = 'badge-success';
                        } else if (data == 'partly') {
                            status = 'badge-warning';
                        }
                        var status = '<div class="badge label-table ' + status + '">' + data + '</div>';
                        return status;
                    }
                },
                {
                    "targets": 6,
                    "render": function (data, type, row, meta) {
                        editFeesPageUrl = editFeesPageUrl.replace(':id', row.student_id);
                        var action = '<div class="button-list">' +
                            '<a href = "' + editFeesPageUrl + '" class="btn btn-blue btn-sm waves-effect waves-light"> <i class="fe-edit"></i></a>' +
                            '<a href="javascript:void(0)" class="btn btn-danger waves-effect waves-light" data-id="' + row.student_id + '" id="deleteFeesBtn"><i class="fe-trash-2"></i></a>' +
                            '</div>';
                        return action;
                    }
                }

            ]
        }).on('draw', function () {
        });
    }

    // delete DesignationDelete
    $(document).on('click', '#deleteFeesBtn', function () {
        var id = $(this).data('id');
        var url = feesDelete;
        swal.fire({
            title: 'Are you sure?',
            html: 'You want to <b>delete</b> this fees',
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
                        toastr.success(data.message);
                        // $('#getFessStudents').DataTable().ajax.reload(null, false);
                        var classID = $("#class_id").val();
                        var sectionID = $("#section_id").val();
                        var year = $("#btwyears").val();
                        var student_id = $("#student_id").val();

                        var formData = new FormData();
                        formData.append('token', token);
                        formData.append('branch_id', branchID);
                        formData.append('class_id', classID);
                        formData.append('section_id', sectionID);
                        formData.append('academic_session_id', year);
                        formData.append('student_id', student_id);
                        loadTable(formData);
                    } else {
                        toastr.error(data.message);
                    }
                }, 'json');
            }
        });
    });


    // edit Fees Form
    $('#editFeesForm').on('submit', function (e) {
       e.preventDefault();
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
                   // $('#fees-type-table').DataTable().ajax.reload(null, false);
                   // $('.addFeesType').modal('hide');
                   // $('.addFeesType').find('form')[0].reset();
                   toastr.success(data.message);
               } else {
                   toastr.error(data.message);
               }
           }
       });
   });
});