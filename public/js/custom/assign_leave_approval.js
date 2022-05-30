$(function () {
    // get all sections
    // $('#assign-leave-approval').DataTable({
    //     processing: true,
    //     info: true,
    //     ajax: getAllStaffUrl,
    //     "pageLength": 5,
    //     "aLengthMenu": [
    //         [5, 10, 25, 50, -1],
    //         [5, 10, 25, 50, "All"]
    //     ],
    //     columns: [
    //         {
    //             searchable: false,
    //             data: 'DT_RowIndex',
    //             name: 'DT_RowIndex'
    //         },
    //         {
    //             data: 'name',
    //             name: 'name'
    //         },
    //         {
    //             data: 'department_name',
    //             name: 'department_name'
    //         },
    //         {
    //             data: 'id',
    //             name: 'id'
    //         },
    //         {
    //             data: 'actions',
    //             name: 'actions',
    //             orderable: false,
    //             searchable: false
    //         },
    //     ],
    //     columnDefs: [

    //         {
    //             "targets": 3,
    //             "render": function (data, type, row, meta) {
    //                 var status = '<select class="form-control" id="leavestatus' + row.id + '" data-style="btn-outline-success">' +
    //                     '<option value="">Choose</option>' +
    //                     '<option value="Approve"  ' + (data == "Approve" ? "selected" : "") + '>Approve</option>' +
    //                     '<option value="Reject"  ' + (data == "Reject" ? "selected" : "") + '>Reject</option>' +
    //                     '<option value="Pending"  ' + (data == "Pending" ? "selected" : "") + '>Pending</option>'
    //                 '</select>';
    //                 return status;
    //             }
    //         }
    //     ]
    // }).on('draw', function () {
    // });

    // assign_leave_approval
    $(document).on('click', '.assignLeaveApprove', function () {
        var staff_id = $(this).data('id');
        var assigner_staff_id = $("#staffID_" + staff_id).val();
        console.log(assigner_staff_id);
        console.log(staff_id);
        console.log("#staffID_" + staff_id);

        var formData = new FormData();
        formData.append('token', token);
        formData.append('branch_id', branchID);
        formData.append('staff_id', staff_id);
        formData.append('assigner_staff_id', assigner_staff_id);
        formData.append('created_by', ref_user_id);
        // Display the key/value pairs
        for (var pair of formData.entries()) {
            console.log(pair[0] + ', ' + pair[1]);
        }
        $.ajax({
            url: assignLeaveApprovalUrl,
            method: "post",
            data: formData,
            processData: false,
            dataType: 'json',
            contentType: false,
            success: function (res) {
                if (res.code == 200) {
                    toastr.success(res.message);
                }
                else {
                    toastr.error(res.message);

                }
            }
        });

    });

});
