$(function () {
    AllLeaveListShow(level_one_status = "All", level_two_status = "All", level_three_status = "All");
    // get all leave list
    function AllLeaveListShow(level_one_status, level_two_status, level_three_status) {
        $('#all-leave-list').DataTable({
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
            // dom: 'lBfrtip',
            dom: "<'row'<'col-sm-2 col-md-2'l><'col-sm-4 col-md-4'B><'col-sm-6 col-md-6'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-6'i><'col-sm-6'p>>",
            "language": {

                "emptyTable": no_data_available,
                "infoFiltered": filter_from_total_entries,
                "zeroRecords": no_matching_records_found,
                "infoEmpty": showing_zero_entries,
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
                    charset: 'utf-8',
                    bom: true,
                    exportOptions: {
                        columns: 'th:not(:last-child)'
                    }
                },
                {
                    extend: 'pdf',
                    text: downloadpdf,
                    extension: '.pdf',
                    charset: 'utf-8',
                    bom: true,
                    exportOptions: {
                        columns: 'th:not(:last-child)'
                    },


                    customize: function (doc) {
                        doc.pageMargins = [50, 50, 50, 50];
                        doc.defaultStyle.fontSize = 10;
                        doc.styles.tableHeader.fontSize = 12;
                        doc.styles.title.fontSize = 14;
                        // Remove spaces around page title
                        doc.content[0].text = doc.content[0].text.trim();
                        /*// Create a Header
                        doc['header']=(function(page, pages) {
                            return {
                                columns: [
                                    
                                    {
                                        // This is the right column
                                        bold: true,
                                        fontSize: 20,
                                        color: 'Blue',
                                        fillColor: '#fff',
                                        alignment: 'center',
                                        text: header_txt
                                    }
                                ],
                                margin:  [50, 15,0,0]
                            }
                        });*/
                        // Create a footer

                        doc['footer'] = (function (page, pages) {
                            return {
                                columns: [
                                    { alignment: 'left', text: [footer_txt], width: 400 },
                                    {
                                        // This is the right column
                                        alignment: 'right',
                                        text: ['page ', { text: page.toString() }, ' of ', { text: pages.toString() }],
                                        width: 100

                                    }
                                ],
                                margin: [50, 0, 0, 0]
                            }
                        });

                    }
                }
            ],
            "ajax": {
                url: AllLeaveList,
                cache: false,
                dataType: "json",
                // data: { month:getSelectedMonth },
                // data: formData,
                data: {
                    level_one_status: level_one_status,
                    level_two_status: level_two_status,
                    level_three_status: level_three_status,
                    staff_id: ref_user_id,
                    academic_session_id: academic_session_id
                },
                type: "GET",
                // contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
                // processData: true, // NEEDED, DON'T OMIT THIS
                // headers: {
                // 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                // },
                "dataSrc": function (json) {
                    return json.data;
                },
                error: function (error) {
                    // console.log("error")
                    // console.log(error)
                    // noDataAvailable(error);
                }
            },

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
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'leave_type_name',
                    name: 'leave_type_name'
                },
                {
                    data: 'total_leave',
                    name: 'total_leave'
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
                    data: 'level_one_status',
                    name: 'level_one_status',
                },
                {
                    data: 'level_two_status',
                    name: 'level_two_status',
                },
                {
                    data: 'level_three_status',
                    name: 'level_three_status',
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
                    "targets": 7,
                    "render": function (data, type, row, meta) {
                        var document = '<a href="' + leaveFilesUrl + '/' + data + '" download name="student_leave_upd[' + meta.row + ']"><i class="fas fa-cloud-download-alt" data-toggle="tooltip" title="Click to download..!"></i></a>';
                        return document;
                    }
                },
                {
                    "targets": 8,
                    "render": function (data, type, row, meta) {
                        if (row.level_one_staff_id) {
                            var badgeColor = "";
                            if (data == "Approve") {
                                badgeColor = "badge-success";
                            }
                            if (data == "Reject") {
                                badgeColor = "badge-danger";
                            }
                            if (data == "Pending") {
                                badgeColor = "badge-warning";
                            }
                            var status = '<span class="badge ' + badgeColor + ' badge-pill">' + data + '</span>';
                            return status;
                        } else {
                            return '-';
                        }

                    }
                },
                {
                    "targets": 9,
                    "render": function (data, type, row, meta) {
                        if (row.level_two_staff_id) {
                            var badgeColor = "";
                            if (data == "Approve") {
                                badgeColor = "badge-success";
                            }
                            if (data == "Reject") {
                                badgeColor = "badge-danger";
                            }
                            if (data == "Pending") {
                                badgeColor = "badge-warning";
                            }
                            var status = '<span class="badge ' + badgeColor + ' badge-pill">' + data + '</span>';
                            return status;
                        } else {
                            return '-';
                        }
                    }
                },
                {
                    "targets": 10,
                    "render": function (data, type, row, meta) {
                        if (row.level_three_staff_id) {
                            var badgeColor = "";
                            if (data == "Approve") {
                                badgeColor = "badge-success";
                            }
                            if (data == "Reject") {
                                badgeColor = "badge-danger";
                            }
                            if (data == "Pending") {
                                badgeColor = "badge-warning";
                            }
                            var status = '<span class="badge ' + badgeColor + ' badge-pill">' + data + '</span>';
                            return status;
                        } else {
                            return '-';
                        }
                    }
                },
                // {
                //     "targets": 9,
                //     "render": function (data, type, row, meta) {

                //         var addremarks = '<textarea style="display:none;" class="addRemarksAdmin" data-id="' + row.id + '" id="addRemarksAdmin' + row.id + '" >' + (row.assiner_remarks !== "null" ? row.assiner_remarks : "") + '</textarea>' +
                //             '<button type="button" data-id="' + row.id + '" class="btn btn-outline-info waves-effect waves-light" data-toggle="modal" data-target="#LeaveRemarksPopup">Add Remarks</button>';
                //         return addremarks;
                //     }
                // }
            ]
        }).on('draw', function () {
        });
    }
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
    //viewDetails
    $(document).on('click', '#viewDetails', function () {
        var leave_id = $(this).data('id');
        var assign_leave_approval_id = $(this).data('assign_leave_approval_id');
        var staff_id = $(this).data('staff_id');
        // staffLeaveDetailsShowUrl
        var formData = new FormData();
        formData.append('token', token);
        formData.append('branch_id', branchID);
        formData.append('leave_id', leave_id);
        formData.append('staff_id', staff_id);
        formData.append('assign_leave_approval_id', assign_leave_approval_id);
        formData.append('academic_session_id', academic_session_id);

        $.ajax({
            url: staffLeaveDetailsShowUrl,
            method: "post",
            data: formData,
            processData: false,
            dataType: 'json',
            contentType: false,
            success: function (res) {
                if (res.code == 200) {
                    // $('#all-leave-list').DataTable().ajax.reload(null, false);
                    // toastr.success(res.message);
                    // DetailsModal
                    var leave_details = res.data.leave_details;
                    var leave_type_details = res.data.leave_type_details;
                    var assign_leave_approval_details = res.data.assign_leave_approval_details;
                    let result = checkValue(assign_leave_approval_details, ref_user_id);
                    var staffStatus = "";
                    var staffRemarks = "";
                    var approver_level = 0;
                    // level 1 db column name
                    if (result == 'level_one_staff_id') {
                        staffStatus = leave_details.level_one_status;
                        staffRemarks = leave_details.level_one_staff_remarks;
                        approver_level = 1;
                    } else if (result == 'level_two_staff_id') {
                        staffStatus = leave_details.level_two_status;
                        staffRemarks = leave_details.level_two_staff_remarks;
                        approver_level = 2;
                    } else if (result == 'level_three_staff_id') {
                        staffStatus = leave_details.level_three_status;
                        staffRemarks = leave_details.level_three_staff_remarks;
                        approver_level = 3;
                    }
                    $('#DetailsModal').modal('show');
                    $('#leave_id').val(leave_details.id);
                    $('#approver_level').val(approver_level);
                    $('#staffName').html(leave_details.name);
                    $('#leaveDates').html(leave_details.from_leave + " / " + leave_details.to_leave);
                    $('#noOfDays').html(leave_details.date_diff + 1);
                    $('#applyDate').html(leave_details.created_at);
                    $('#leaveType').html(leave_details.leave_type_name);
                    $('#reason').html(leave_details.reason_name);
                    // document
                    var badgeColor = "";
                    if (leave_details.status == "Approve") {
                        badgeColor = "badge-success";
                    }
                    if (leave_details.status == "Reject") {
                        badgeColor = "badge-danger";
                    }
                    if (leave_details.status == "Pending") {
                        badgeColor = "badge-warning";
                    }
                    var status = '<span class="badge ' + badgeColor + ' badge-pill">' + leave_details.status + '</span>';
                    var document = '<a href="' + leaveFilesUrl + '/' + leave_details.document + '" download ><i class="fas fa-cloud-download-alt" data-toggle="tooltip" title="Click to download..!"></i></a>';
                    $('#documents').html(document);
                    $('#leave_status').html(status);
                    // set value
                    $('#1st_approver_remarks').html(leave_details.level_one_staff_remarks);
                    $('#2nd_approver_remarks').html(leave_details.level_two_staff_remarks);
                    $('#3rd_approver_remarks').html(leave_details.level_three_staff_remarks);

                    $('#assiner_remarks').val(staffRemarks);
                    $('#leave_status_name').val(staffStatus);
                    $('#alreadyTakenLeave tbody').empty();
                    // $('#myModal').modal('hide');
                    var takenLeaveDetails = "";
                    if (leave_type_details.length > 0) {
                        $.each(leave_type_details, function (key, val) {
                            var used_leave = 0;
                            if (val.used_leave) {
                                used_leave = val.used_leave;
                            }
                            var bal = val.total_leave - val.used_leave;
                            var applied_leave = val.applied_leave !== null ? val.applied_leave : 0;
                            takenLeaveDetails += '<tr>' +
                                '<td>' + val.leave_name + '</td>' +
                                '<td>' + val.total_leave + '</td>' +
                                '<td>' + used_leave + '</td>' +
                                '<td>' + applied_leave + '</td>' +
                                '<td>' + bal + '</td>' +
                                '</tr>';

                        });
                    } else {
                        takenLeaveDetails += '<tr><td colspan="4" style="text-align: center;"> ' + no_data_available + '</td></tr>';

                    }
                    $('#alreadyTakenLeave tbody').append(takenLeaveDetails);
                }
                else {
                    // toastr.error(res.message);

                }
            }
        });
    });
    // approved leave
    $(document).on('click', '#approvedLeave', function () {
        var leave_id = $("#leave_id").val();
        var status = $("#leave_status_name").val();

        var assiner_remarks = $("#assiner_remarks").val();
        var approver_level = $("#approver_level").val();
        var formData = new FormData();
        formData.append('token', token);
        formData.append('branch_id', branchID);
        formData.append('academic_session_id', academic_session_id);
        formData.append('leave_id', leave_id);
        formData.append('status', status);
        formData.append('assiner_remarks', assiner_remarks);
        formData.append('staff_id', ref_user_id);
        formData.append('approver_level', approver_level);
        // Display the key/value pairs
        // for (var pair of formData.entries()) {
        //     console.log(pair[0] + ', ' + pair[1]);
        // }

        // return false;
        $.ajax({
            url: leaveApprovedUrl,
            method: "post",
            data: formData,
            processData: false,
            dataType: 'json',
            contentType: false,
            success: function (res) {
                if (res.code == 200) {
                    toastr.success(res.message);
                    $('#all-leave-list').DataTable().ajax.reload(null, false);
                    $('#DetailsModal').modal('hide');
                }
                else {
                    toastr.error(res.message);
                }
            }
        });

    });
    // all Leave Filter
    $('#allLeaveFilter').on('submit', function (e) {
        e.preventDefault();
        var level_one_status = $("#levelOneStatus").val();
        var level_two_status = $("#levelTwoStatus").val();
        var level_three_status = $("#levelThreeStatus").val();
        var classObj = {
            level_one_status: level_one_status,
            level_two_status: level_two_status,
            level_three_status: level_three_status,
            academic_session_id: academic_session_id,
            userID: userID,
        };
        setLocalStorageForAllLeave(classObj);
        AllLeaveListShow(level_one_status, level_two_status, level_three_status);
    });
    function checkValue(obj, value) {
        for (let key in obj) {
            if (obj[key] == value) {
                return key;
            }
        }
        return false;
    }

    function setLocalStorageForAllLeave(classObj) {

        var adminallleavesDetails = new Object();
        adminallleavesDetails.level_one_status = classObj.level_one_status;
        adminallleavesDetails.level_two_status = classObj.level_two_status;
        adminallleavesDetails.level_three_status = classObj.level_three_status;
        // here to attached to avoid localStorage other users to add
        adminallleavesDetails.branch_id = branchID;
        adminallleavesDetails.role_id = get_roll_id;
        adminallleavesDetails.user_id = ref_user_id;
        var adminallleavesClassArr = [];
        adminallleavesClassArr.push(adminallleavesDetails);
        if (get_roll_id == "2") {
            // Admin

            localStorage.removeItem("admin_alltleaves_details");
            localStorage.setItem('admin_alltleaves_details', JSON.stringify(adminallleavesClassArr));
        }
        return true;
    }
    if (get_roll_id == "2") {
        if (typeof admin_allleaves_storage !== 'undefined') {
            if ((admin_allleaves_storage)) {
                if (admin_allleaves_storage) {

                    var adminallLeaveStorage = JSON.parse(admin_allleaves_storage);
                    if (adminallLeaveStorage.length == 1) {
                        var level_one_status, level_two_status, level_three_status, userBranchID, userRoleID, userID;
                        adminallLeaveStorage.forEach(function (user) {
                            level_one_status = user.level_one_status;
                            level_two_status = user.level_two_status;
                            level_three_status = user.level_three_status;
                            userBranchID = user.branch_id;
                            userRoleID = user.role_id;
                            userID = user.user_id;
                        });
                        if ((userBranchID == branchID) && (userRoleID == get_roll_id) && (userID == ref_user_id)) {

                            var level_one_status = $("#levelOneStatus").val();
                            var level_two_status = $("#levelTwoStatus").val();
                            var level_three_status = $("#levelThreeStatus").val();
                            AllLeaveListShow(level_one_status, level_two_status, level_three_status);
                        }
                    }
                }
            }
        }
    }


});