$(function () {

    // change class name
    $('#changeClassName').on('change', function () {
        $(".studentLeaveShow").hide();
        var class_id = $(this).val();
        $("#studentLeaveList").find("#sectionID").empty();
        $("#studentLeaveList").find("#sectionID").append('<option value="">'+select_section+'</option>');

        $.post(sectionByClassUrl, {
            token: token,
            branch_id: branchID,
            class_id: class_id,
            teacher_id: ref_user_id,
            academic_session_id:academic_session_id
        }, function (res) {
            if (res.code == 200) {
                console.log(res)
                $.each(res.data, function (key, val) {
                    $("#studentLeaveList").find("#sectionID").append('<option value="' + val.section_id + '">' + val.section_name + '</option>');
                });
            }
        }, 'json');
    });
    // change teacher class
    // $('#changeTeacherClassName').on('change', function () {
    //     $(".studentLeaveShow").hide();
    //     var class_id = $(this).val();
    //     $("#studentLeaveList").find("#sectionID").empty();
    //     $("#studentLeaveList").find("#sectionID").append('<option value="">'+select_section+'</option>');

    //     $.post(sectionByClassUrl, { token: token, branch_id: branchID, class_id: class_id, teacher_id: ref_user_id }, function (res) {
    //         if (res.code == 200) {
    //             console.log(res)
    //             $.each(res.data, function (key, val) {
    //                 $("#studentLeaveList").find("#sectionID").append('<option value="' + val.section_id + '">' + val.section_name + '</option>');
    //             });
    //         }
    //     }, 'json');
    // });
    // applyFilter
    // rules validation
    $("#studentLeaveList").validate({
        rules: {
            class_id: "required",
            section_id: "required"
        }
    });
    // data bind 
    $('#studentLeaveList').on('submit', function (e) {
        e.preventDefault();
        var form = this;
        var classRoom = $("#studentLeaveList").valid();
        if (classRoom === true) {

            var class_id = $("#changeClassName").val();
            var section_id = $("#sectionID").val();
            $("#overlay").fadeIn(300);
            var formData = new FormData();
            formData.append('token', token);
            formData.append('branch_id', branchID);
            formData.append('class_id', class_id);
            formData.append('section_id', section_id);
            // // subject division
            $.ajax({
                url: allStutdentLeaveList,
                method: "post",
                data: formData,
                processData: false,
                dataType: 'json',
                contentType: false,
                success: function (response) {
                    if (response.code == 200) {
                        var dataSet = response.data;
                        allStudentLeave(dataSet);
                        $(".studentLeaveShow").show("slow");
                    } else {
                        toastr.error(response.message);
                    }
                    $("#overlay").fadeOut(300);
                }
            });

        };
    });
    // add remarks model
    $('#stuLeaveRemarksPopup').on('show.bs.modal', e => {
        $("#student_leave_remarks").focus();
        var $button = $(e.relatedTarget);
        var studentlev_tbl_ID = $button.attr('data-id');
        var studentlevRemarks = $button.closest('td').find('textarea').val();
        var checknullRemarks = (studentlevRemarks !== "null") ? studentlevRemarks : "";
        $("#studenet_leave_tbl_id").val(studentlev_tbl_ID);
        $("#student_leave_remarks").val(checknullRemarks);
    });

    $('#student_leave_RemarksSave').on('click', function () {
        var studenetlevtblID = $('#studenet_leave_tbl_id').val();
        var student_leave_remarks = $('#student_leave_remarks').val();
        var compain_remarks_tblID = student_leave_remarks;
        $('#addRemarksStudent' + studenetlevtblID).val(compain_remarks_tblID);
        $('#stuLeaveRemarksPopup').modal('hide');
    });
    $(document).on('click', '#stdLeave', function () {
        var student_leave_tbl_id = $(this).data('id');
        var student_leave_approve = $("#leavestatus" + student_leave_tbl_id).val();
        var teacher_remarks = $("#addRemarksStudent" + student_leave_tbl_id).val();
        var formData = new FormData();
        formData.append('token', token);
        formData.append('branch_id', branchID);
        formData.append('student_leave_tbl_id', student_leave_tbl_id);
        formData.append('student_leave_approve', student_leave_approve);
        formData.append('teacher_remarks', teacher_remarks);
        $.ajax({
            url: teacher_leave_remarks_updated,
            method: "post",
            data: formData,
            processData: false,
            dataType: 'json',
            contentType: false,
            success: function (res) {
                if (res.code == 200) {
                    // allStudentLeave();
                    toastr.success('Leave Updated sucessfully');
                }
                else {
                    toastr.error(res.message);

                }
            }
        });

    });
    function allStudentLeave(dataSetNew) {

        $('#student-leave-table').DataTable({
            processing: true,
            bDestroy: true,
            info: true,
            // dom: 'lBfrtip',
            dom: "<'row'<'col-sm-2 col-md-2'l><'col-sm-4 col-md-4'B><'col-sm-6 col-md-6'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-6'i><'col-sm-6'p>>",
            "language": {
                "info": showing_entries,
                "lengthMenu": show_entries,
                "search": datatable_search,
                "paginate": {
                    "next": next,
                    "previous": previous
                },
            },
            buttons: [
                {
                    extend: 'csv',
                    text: downloadcsv,
                    extension: '.csv',
                    exportOptions: {
                        columns: 'th:not(:last-child)'
                    }
                },
                {
                    extend: 'pdf',
                    text: downloadpdf,
                    extension: '.pdf',
                    exportOptions: {
                        columns: 'th:not(:last-child)'
                    }

                }
            ],
            data: dataSetNew,
            "pageLength": 10,
            "aLengthMenu": [
                [5, 10, 25, 50, -1],
                [5, 10, 25, 50, "All"]
            ],
            columns: [
                {
                    "targets": 0,
                    "render": function (data, type, row, meta) {
                        return meta.row + 1;
                    }
                },
                {
                    data: 'name'
                },
                {
                    data: 'class_name'
                },
                {
                    data: 'section_name'
                },
                {
                    data: 'from_leave'
                },
                {
                    data: 'to_leave'
                },
                {
                    data: 'status'
                },
                {
                    data: 'reason'
                },
                {
                    data: 'document'
                },
                {
                    data: 'teacher_remarks'
                }
            ],
            columnDefs: [
                {

                    "targets": 1,
                    "className": "table-user",
                    "render": function (data, type, row, meta) {
                        var first_name = '<img src="' + defaultImg + '" class="mr-2 rounded-circle">' +
                            '<a href="javascript:void(0);" class="text-body font-weight-semibold">' + data + '</a>';
                        return first_name;
                    }
                },
                {
                    "targets": 6,
                    "render": function (data, type, row, meta) {
                        var status = '<select class="form-control" id="leavestatus' + row.id + '" data-style="btn-outline-success" name="student_leave_upd[' + meta.row + '][status]">' +
                            '<option value="">'+choose+'</option>' +
                            '<option value="Approve"  ' + (data == "Approve" ? "selected" : "") + '>Approve</option>' +
                            '<option value="Reject"  ' + (data == "Reject" ? "selected" : "") + '>Reject</option>' +
                            '<option value="Pending"  ' + (data == "Pending" ? "selected" : "") + '>Pending</option>'
                        '</select>';
                        return status;
                    }
                },
                {
                    "targets": 8,
                    "render": function (data, type, row, meta) {
                        var document = "";
                        if (data) {
                            var document = '<a href="' + studentDocUrl + '/' + data + '" download ><i class="fas fa-cloud-download-alt" data-toggle="tooltip" title="Click to download..!"></i></a>';
                        } else {
                            document = "-";
                        }
                        return document;
                    }
                },
                {
                    "targets": 9,
                    "render": function (data, type, row, meta) {

                        var addremarks = '<textarea style="display:none;" class="addRemarksStudent" data-id="' + row.id + '" id="addRemarksStudent' + row.id + '" >' + (row.teacher_remarks !== "null" ? row.teacher_remarks : "") + '</textarea>' +
                            '<button type="button" data-id="' + row.id + '" class="btn btn-outline-info waves-effect waves-light" data-toggle="modal" data-target="#stuLeaveRemarksPopup" id="editLeaveRemarksStudent">Add Remarks</button>';
                        return addremarks;
                    }
                },
                {
                    "targets": 10,
                    "render": function (data, type, row, meta) {
                        var submitbtn = '<button type="button" class="btn btn-primary-bl waves-effect waves-light levsub" data-id="' + row.id + '" id="stdLeave">Update</button>';
                        return submitbtn;
                    }
                },
            ]
        }).on('draw', function () {
        });
    }

});