$(function () {
    // change classes
    $("#class_id").on('change', function (e) {
        e.preventDefault();
        var class_id = $(this).val();
        $("#section_id").empty();
        $("#section_id").append('<option value="">Select Class Name</option>');
        $.post(sectionByClass, { token: token, branch_id: branchID, class_id: class_id }, function (res) {
            if (res.code == 200) {
                $.each(res.data, function (key, val) {
                    $("#section_id").append('<option value="' + val.section_id + '">' + val.section_name + '</option>');
                });
            }
        }, 'json');
    });
    // rules validation
    $("#feesAllocation").validate({
        rules: {
            class_id: "required",
            section_id: "required",
            group_id: "required"
        }
    });
    //
    $('#feesAllocation').on('submit', function (e) {
        e.preventDefault();
        var valid = $("#feesAllocation").valid();
        if (valid === true) {
            var classID = $("#class_id").val();
            var sectionID = $("#section_id").val();
            var groupID = $("#group_id").val();

            var formData = new FormData();
            formData.append('token', token);
            formData.append('branch_id', branchID);
            formData.append('class_id', classID);
            formData.append('section_id', sectionID);
            formData.append('fees_group_id', groupID);
            formData.append('academic_session_id', academic_session_id);
            $("#overlay").fadeIn(300);
            $.ajax({
                url: feesAllocatedStudentsList,
                method: "post",
                data: formData,
                processData: false,
                dataType: 'json',
                contentType: false,
                success: function (response) {
                    $('#selectAllchkbox').prop('checked', false); // Unchecks it
                    if (response.code == 200) {
                        var dataSetNew = response.data;
                        if (dataSetNew.length > 0) {
                            $(".feesAllocationStudHideShow").show("slow");
                            // set group id
                            $("#feesAllocationStudGroupID").val(groupID);
                            getFeesAllocation(dataSetNew);
                        } else {
                            $(".feesAllocationStudHideShow").hide();
                            toastr.info('No students are available');
                        }
                        $("#overlay").fadeOut(300);
                    } else {
                        toastr.error(response.message);
                        $("#overlay").fadeOut(300);
                    }
                }
            });

        }
    });
    function getFeesAllocation(dataSetNew) {
        $('#feesAllocationStud').DataTable().clear().destroy();
        $('#feesAllocationStud td').empty();
        listTable = $('#feesAllocationStud').DataTable({
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
                    data: 'id'
                },
                {
                    data: 'allocation_id'
                },
                {
                    data: 'name'
                },
                {
                    data: 'gender'
                },
                {
                    data: 'register_no'
                },
                {
                    data: 'email'
                }
            ],
            columnDefs: [
                {
                    "targets": 0,
                    "className": "checked-area",
                    "render": function (data, type, row, meta) {
                        var student_remarks = '<input type="checkbox" name="student_operations[]" ' + (row.allocation_id != null ? "checked" : "") + ' value="' + row.id + '">';
                        return student_remarks;
                    }
                },
                {
                    "targets": 1,
                    "render": function (data, type, row, meta) {
                        return meta.row + 1;
                    }
                },
                {
                    "targets": 2,
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
                }
            ]
        }).on('draw', function () {
        });
    }

    $('#addFeesAllocationStud').on('submit', function (e) {
        e.preventDefault();
        var form = this;

        $.ajax({
            url: $(form).attr('action'),
            method: $(form).attr('method'),
            data: new FormData(form),
            processData: false,
            dataType: 'json',
            contentType: false,
            success: function (response) {
                if (response.code == 200) {
                    toastr.success(response.message);
                    // $('#addDailyReport')[0].reset();
                } else {
                    toastr.error(response.message);
                }
            }
        });
    });
    $('#selectAllchkbox').prop('checked', false); // Unchecks it
    // script for all checkbox checked / unchecked
    $("#selectAllchkbox").on("change", function (ev) {
        var $chcks = $(".checked-area input[type='checkbox']");
        if ($(this).is(':checked')) {
            $chcks.prop('checked', true).trigger('change');
        } else {
            $chcks.prop('checked', false).trigger('change');
        }
    });
});