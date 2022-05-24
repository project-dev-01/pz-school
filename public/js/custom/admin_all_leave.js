$(function () {
    // get all leave list
    $('#all-leave-list').DataTable({
        processing: true,
        info: true,
        ajax: AllLeaveList,
        "pageLength": 5,
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
                data: 'name',
                name: 'name'
            },
            {
                data: 'leave_type_name',
                name: 'leave_type_name'
            },
            {
                data: 'date_diff',
                name: 'date_diff'
            },
            {
                data: 'from_leave',
                name: 'from_leave'
            },
            {
                data: 'to_leave',
                name: 'to_leave'
            },
            {
                data: 'reason_name',
                name: 'reason_name'
            },
            {
                data: 'document',
                name: 'document'
            },
            {
                data: 'status',
                name: 'status',
            },
            {
                data: 'assiner_remarks',
                name: 'assiner_remarks'
            },
            {
                data: 'created_at',
                name: 'created_at',
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
                "targets": 3,
                "render": function (data, type, row, meta) {
                    return data + 1;
                }
            },
            {
                "targets": 8,
                "render": function (data, type, row, meta) {
                    var status = '<select class="form-control" id="leavestatus' + row.id + '" data-style="btn-outline-success">' +
                        '<option value="">Choose</option>' +
                        '<option value="Approve"  ' + (data == "Approve" ? "selected" : "") + '>Approve</option>' +
                        '<option value="Reject"  ' + (data == "Reject" ? "selected" : "") + '>Reject</option>' +
                        '<option value="Pending"  ' + (data == "Pending" ? "selected" : "") + '>Pending</option>'
                    '</select>';
                    return status;
                }
            },
            {
                "targets": 7,
                "render": function (data, type, row, meta) {
                    var document = '<a href="' + leaveFilesUrl + '/' + data + '" download name="student_leave_upd[' + meta.row + ']"><i class="fas fa-cloud-download-alt" data-toggle="tooltip" title="Click to download..!"></i></a>';
                    return document;
                }
            },
            {
                "targets": 9,
                "render": function (data, type, row, meta) {

                    var addremarks = '<textarea style="display:none;" class="addRemarksAdmin" data-id="' + row.id + '" id="addRemarksAdmin' + row.id + '" >' + (row.assiner_remarks !== "null" ? row.assiner_remarks : "") + '</textarea>' +
                        '<button type="button" data-id="' + row.id + '" class="btn btn-outline-info waves-effect waves-light" data-toggle="modal" data-target="#LeaveRemarksPopup">Add Remarks</button>';
                    return addremarks;
                }
            }
        ]
    }).on('draw', function () {
    });
    // add remarks model
    $('#LeaveRemarksPopup').on('show.bs.modal', e => {
        $("#leave_remarks").focus();
        var $button = $(e.relatedTarget);
        var lev_tbl_ID = $button.attr('data-id');
        var levRemarks = $button.closest('td').find('textarea').val();
        var checknullRemarks = (levRemarks !== "null") ? levRemarks : "";
        $("#leave_tbl_id").val(lev_tbl_ID);
        $("#leave_remarks").val(checknullRemarks);
    });

    $('#leave_RemarksSave').on('click', function () {
        var studenetlevtblID = $('#leave_tbl_id').val();
        var leave_remarks = $('#leave_remarks').val();
        var compain_remarks_tblID = leave_remarks;
        $('#addRemarksAdmin' + studenetlevtblID).val(compain_remarks_tblID);
        $('#LeaveRemarksPopup').modal('hide');
    });
    // approved leave
    $(document).on('click', '#approvedLeave', function () {
        var leave_id = $(this).data('id');
        var status = $("#leavestatus" + leave_id).val();

        var assiner_remarks = $("#addRemarksAdmin" + leave_id).val();

        var formData = new FormData();
        formData.append('token', token);
        formData.append('branch_id', branchID);
        formData.append('leave_id', leave_id);
        formData.append('status', status);
        formData.append('assiner_remarks', assiner_remarks);
        $.ajax({
            url: leaveApprovedUrl,
            method: "post",
            data: formData,
            processData: false,
            dataType: 'json',
            contentType: false,
            success: function (res) {
                if (res.code == 200) {
                    $('#all-leave-list').DataTable().ajax.reload(null, false);
                    toastr.success(res.message);
                }
                else {
                    toastr.error(res.message);

                }
            }
        });

    });
});