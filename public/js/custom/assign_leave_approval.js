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
    //                     '<option value="">'+choose+'</option>' +
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
        var levelOneStaffApproval = $("#levelOneStaffApproval" + staff_id).val();
        var levelTwoStaffApproval = $("#levelTwoStaffApproval" + staff_id).val();
        var levelThreeStaffApproval = $("#levelThreeStaffApproval" + staff_id).val();
        let selectedOptions = [];
        let isValid = true;
        $('.staff-dropdown' + staff_id).each(function () {
            let selectedValue = $(this).val();
            if (levelTwoStaffApproval !== '' && levelOneStaffApproval === '') {
                isValid = false;
                toastr.error('Please select the first dropdown before the second one.');
                return false;
            } else if (levelThreeStaffApproval !== '' && (levelOneStaffApproval === '' || levelTwoStaffApproval === '')) {
                isValid = false;
                toastr.error('Please select the first and second dropdowns before the third one.');
                return false;
            } else if (levelOneStaffApproval === '' && levelTwoStaffApproval === '' && levelThreeStaffApproval === '') {
                isValid = false;
                toastr.error('Please select at least one option.');
                return false;
            }
            console.log(selectedOptions);
            if (selectedOptions.includes(selectedValue)) {
                isValid = false;
                toastr.error(`Staff is selected in multiple dropdowns.`);
                return false; // Exit loop if a duplicate is found
            }
            if (selectedValue != '') {
                selectedOptions.push(selectedValue);
            }
        });

        if (isValid) {
            // alert('Validation successful!');
            var formData = new FormData();
            formData.append('token', token);
            formData.append('branch_id', branchID);
            formData.append('staff_id', staff_id);
            formData.append('level_one_staff_id', levelOneStaffApproval);
            formData.append('level_two_staff_id', levelTwoStaffApproval);
            formData.append('level_three_staff_id', levelThreeStaffApproval);
            // formData.append('assigner_staff_id', assigner_staff_id);
            formData.append('created_by', ref_user_id);
            // Display the key/value pairs
            // for (var pair of formData.entries()) {
            //     console.log(pair[0] + ', ' + pair[1]);
            // }
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
        }

    });
    $(document).on('change', '.enableNextDropdown', function () {
        var enable_id = $(this).data('enablekey');
        var level = $(this).data('level');

        var levelOneStaffApproval = $(".firstDropDown" + enable_id).val();
        var levelTwoStaffApproval = $(".secondDropDown" + enable_id).val();
        if (level == '1') {
            if (levelOneStaffApproval == "") {
                $(".secondDropDown" + enable_id).val('');
                $(".thirdDropDown" + enable_id).val('');
                $(".secondDropDown" + enable_id).prop('disabled', true);
                $(".thirdDropDown" + enable_id).prop('disabled', true);
                return false;
            }
            $(".secondDropDown" + enable_id).prop('disabled', false);
            $(".thirdDropDown" + enable_id).prop('disabled', true);
        }
        if (level == '2') {
            if (levelTwoStaffApproval == "") {
                $(".thirdDropDown" + enable_id).val('');
                $(".thirdDropDown" + enable_id).prop('disabled', true);
                return false;
            }
            $(".thirdDropDown" + enable_id).prop('disabled', false);
        }
    });
});
