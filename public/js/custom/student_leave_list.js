$(function () {
    // var defaultList = new FormData();
    // defaultList.append('token', token);
    // defaultList.append('branch_id', branchID);
    // studentLeaveList(defaultList);
    // $('#homeRoomPopup').modal('show');
    // $('#nursingPopup').modal('show');
    $("#department_id").on('change', function (e) {
        e.preventDefault();
        var Selector = '#studentLeaveList';
        var department_id = $(this).val();
        var classID = "";
        classAllocation(department_id, Selector, classID);
    });
    $("#changeLevType").on('change', function (e) {
        e.preventDefault();
        var student_leave_type_id = $(this).val();
        $("#changelevReasons1").empty();
        $("#changelevReasons1").append('<option value="">' + select_reason + '</option>');
        $.post(getReasonsByLeaveType, { branch_id: branchID, student_leave_type_id: student_leave_type_id }, function (res) {
            if (res.code == 200) {
                $.each(res.data, function (key, val) {
                    $("#changelevReasons1").append('<option value="' + val.id + '">' + val.name + '</option>');
                });
            }
        }, 'json');
    });
    function classAllocation(department_id, Selector, classID) {
        $(Selector).find('select[name="class_id"]').empty();
        $(Selector).find('select[name="class_id"]').append('<option value="">' + select_grade + '</option>');
        $(Selector).find('select[name="section_id"]').empty();
        $(Selector).find('select[name="section_id"]').append('<option value="">' + select_class + '</option>');
        if (department_id) {
            $.post(getGradeByDepartmentUrl,
                {
                    branch_id: branchID,
                    department_id: department_id
                }, function (res) {
                    if (res.code == 200) {
                        $.each(res.data, function (key, val) {
                            $(Selector).find('select[name="class_id"]').append('<option value="' + val.id + '">' + val.name + '</option>');
                        });
                        if (classID != '') {
                            $(Selector).find('select[name="class_id"]').val(classID);
                        }
                    }
                }, 'json');
        }
    }
    // change class name
    $('#changeClassName').on('change', function () {
        var class_id = $(this).val();
        $("#studentLeaveList").find("#sectionID").empty();
        $("#studentLeaveList").find("#sectionID").append('<option value="">' + select_section + '</option>');

        $.post(sectionByClassUrl, {
            token: token,
            branch_id: branchID,
            class_id: class_id,
            teacher_id: ref_user_id,
            academic_session_id: academic_session_id
        }, function (res) {
            if (res.code == 200) {
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
        var leaveVal = $("#studentLeaveList").valid();
        if (leaveVal === true) {
            var form = this;
            var class_id = $("#changeClassName").val();
            var section_id = $("#sectionID").val();
            var student_name = $("#student_name").val();
            var status = $("#leave_status").val();
            var date = $("#range-datepicker").val();
            // $("#overlay").fadeIn(300);


            // var classObj = {
            //     classID: class_id,
            //     sectionID: section_id,
            //     studentName: student_name,
            //     status: status,
            //     date: date
            // };
            // setLocalStorageStudentLeaveTeacher(classObj);
            var formData = new FormData(); formData.append('token', token);
            formData.append('branch_id', branchID);
            formData.append('class_id', class_id);
            formData.append('section_id', section_id);
            formData.append('student_name', student_name);
            formData.append('status', status);
            formData.append('date', date);
            formData.append('academic_session_id', academic_session_id);
            // // subject division
            studentLeaveList(formData);
        }

    });
    function getstudentLeaveList() {
        var form = this;
        var class_id = $("#changeClassName").val();
        var section_id = $("#sectionID").val();
        var student_name = $("#student_name").val();
        var status = $("#leave_status").val();
        var date = $("#range-datepicker").val();
        var formData = new FormData();
        formData.append('branch_id', branchID);
        formData.append('class_id', class_id);
        formData.append('section_id', section_id);
        formData.append('student_name', student_name);
        formData.append('status', status);
        formData.append('date', date);
        formData.append('academic_session_id', academic_session_id);
        // // subject division
        studentLeaveList(formData);
    }
    function studentLeaveList(formData) {

        $(".studentLeaveShow").hide();
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
    }
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
    $(document).on('click', '.approveRejectLeave', function () {
        var student_leave_tbl_id = $(this).data('id');
        var status = $(this).data('status');
        var formData = new FormData();
        formData.append('branch_id', branchID);
        formData.append('student_leave_tbl_id', student_leave_tbl_id);
        formData.append('status', status);
        if (teacher_type == "nursing_teacher") {
            formData.append('direct_approved', true);
        } else {
            formData.append('direct_approved_by_teacher', true);
        }
        // formData.append('teacher_remarks', teacher_remarks);
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

                    // $('#student-leave-table').DataTable().ajax.reload(null, false);
                    //location.reload();
                    getstudentLeaveList();
                }
                else {
                    toastr.error(res.message);

                }
            }
        });

    });
    $(document).on('click', '#stdLeaveapprovedLeave', function () {
        var student_leave_tbl_id = $("#studentLeaveID").val();
        var status = $("#leave_status_name").val();
        var leave_type = $("#changeLevType").val();
        var reason_id = $("#changelevReasons1").val();
        var remarks = $("#yourRemarks").val();
        var formData = new FormData();
        formData.append('branch_id', branchID);
        formData.append('student_leave_tbl_id', student_leave_tbl_id);
        formData.append('status', status);
        if (teacher_type == "nursing_teacher") {
            formData.append('nursing_leave_type', leave_type);
            formData.append('nursing_reason_id', reason_id);
            formData.append('nursing_teacher_remarks', remarks);
            formData.append('nursing_teacher_status', status);
        } else {
            formData.append('teacher_leave_type', leave_type);
            formData.append('teacher_reason_id', reason_id);
            formData.append('teacher_remarks', remarks);
            formData.append('home_teacher_status', status);
        }

        // Display the key/value pairs
        // for (var pair of formData.entries()) {
        //     console.log(pair[0]+ ', ' + pair[1]); 
        // }
        // return false;
        if (status != '') {
            $('#alert_status').html('');
            $('#leave_status_name').css('border-color', '');
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
                        $('#nursingPopup').modal('hide');
                        //location.reload();
                        getstudentLeaveList();
                    }
                    else {
                        toastr.error(res.message);

                    }
                }
            });
        }
        else {
            $('#leave_status_name').css('border-color', 'red');
            $('#alert_status').html('Required');
        }

    });
    // $(document).on('click', '#stdLeave', function () {
    //     var student_leave_tbl_id = $(this).data('id');
    //     var student_leave_approve = $("#leavestatus" + student_leave_tbl_id).val();
    //     var teacher_remarks = $("#addRemarksStudent" + student_leave_tbl_id).val();
    //     var formData = new FormData();
    //     formData.append('token', token);
    //     formData.append('branch_id', branchID);
    //     formData.append('student_leave_tbl_id', student_leave_tbl_id);
    //     formData.append('student_leave_approve', student_leave_approve);
    //     formData.append('teacher_remarks', teacher_remarks);
    //     $.ajax({
    //         url: teacher_leave_remarks_updated,
    //         method: "post",
    //         data: formData,
    //         processData: false,
    //         dataType: 'json',
    //         contentType: false,
    //         success: function (res) {
    //             if (res.code == 200) {
    //                 // allStudentLeave();
    //                 toastr.success('Leave Updated sucessfully');
    //             }
    //             else {
    //                 toastr.error(res.message);

    //             }
    //         }
    //     });

    // });
    function allStudentLeave(dataSetNew) {

        $('#student-leave-table').DataTable({
            processing: true,
            destroy: true,
            info: true,
            dom: "<'row'<'col-sm-2 col-md-2'l><'col-sm-4 col-md-4'B><'col-sm-6 col-md-6'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-6'i><'col-sm-6'p>>",
                language: {
                    emptyTable: no_data_available,
                    infoFiltered: filter_from_total_entries,
                    zeroRecords: no_matching_records_found,
                    infoEmpty: showing_zero_entries,
                    info: showing_entries,
                    lengthMenu: show_entries,
                    search: datatable_search,
                    paginate: {
                        next: next,
                        previous: previous
                    }
                },
                buttons: [{
                    extend: 'csv',
                    text: downloadcsv,
                    extension: '.csv',
                    charset: 'utf-8',
                    bom: true,
                    exportOptions: {
                        columns: 'th:not(:last-child)'
                    },
                    enabled: false, // Initially disable CSV button
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
                    enabled: false, // Initially disable PDF button
                }
                ],
                initComplete: function () {
                    var table = this;
                    $.ajax({
                        url: dataSetNew,
                        success: function(data) {
                            console.log(data.data.length);
                            if (data && data.data.length > 0) {
                                console.log('ok');
                                $('#student-leave-table_wrapper .buttons-csv').removeClass('disabled');
                                $('#student-leave-table_wrapper .buttons-pdf').removeClass('disabled');  // Enable all buttons if at least one record exists
                            } else {
                                console.log(data);
                                $('#student-leave-table_wrapper .buttons-csv').addClass('disabled');
                                $('#student-leave-table_wrapper .buttons-pdf').addClass('disabled');               
                            }
                        },
                        error: function() {
                            console.log('error');
                            // Handle error if necessary
                        }
                    });
                },
                data: dataSetNew,
                pageLength: 10,
                lengthMenu: [
                    [5, 10, 25, 50, -1],
                    [5, 10, 25, 50, "All"]
                ],
                columns: [{
                    targets: 0,
                    render: function (data, type, row, meta) {
                        return meta.row + 1;
                    }
                },
                {
                    data: 'class_name'
                },
                {
                    data: 'section_name'
                },
                {
                    data: 'attendance_no'
                },
                {
                    data: 'name'
                },
                {
                    data: 'from_leave'
                },
                {
                    data: 'to_leave'
                },
                {
                    data: 'leave_type_name'
                },
                {
                    data: 'reason'
                },
                {
                    data: 'home_teacher_status'
                },
                {
                    data: 'teacher_remarks'
                },
                {
                    data: 'nursing_teacher_status'
                },
                {
                    data: 'nursing_teacher_remarks'
                },
                {
                    data: 'document'
                },
                {
                    data: 'status'
                },
                {
                    data: 'id'
                }
            ],
            columnDefs: [{
                targets: 4,
                className: "table-user",
                render: function (data, type, row, meta) {
                    var first_name = '<img src="' + defaultImg + '" class="mr-2 rounded-circle">' +
                        '<a href="javascript:void(0);" class="text-body font-weight-semibold">' + data + '</a>';
                    return first_name;
                }
            },
            {
                targets: 9,
                render: function (data, type, row, meta) {
                    var status = getStatusBadge(data);
                    return status;
                }
            },
            {
                targets: 11,
                render: function (data, type, row, meta) {
                    var status = getStatusBadge(data);
                    return status;
                }
            },
            {
                targets: 13,
                render: function (data, type, row, meta) {
                    var documentLink = getDocumentLink(row);
                    return documentLink;
                }
            },
            {
                targets: 14,
                render: function (data, type, row, meta) {
                    var status = getStatusBadge(data);
                    return status;
                }
            },
            {
                targets: 15,
                render: function (data, type, row, meta) {
                    var remarksButtons = getRemarksButtons(row);
                    return remarksButtons;
                }
            },
            {
                targets: 16,
                render: function (data, type, row, meta) {
                    var viewDetailsButton = getViewDetailsButton(row);
                    return viewDetailsButton;
                }
            },
            ]
        });
    }
    // Helper functions
    function getStatusBadge(data) {
        var status = '';
        if (data == "Approve") {
            status = '<span class="badge badge-success">' + data + '</span>';
        } else if (data == "Reject") {
            status = '<span class="badge badge-danger">' + data + '</span>';
        } else if (data == "Pending") {
            status = '<span class="badge badge-info">' + data + '</span>';
        }
        return status;
    }

    function getDocumentLink(row) {
        var document = '';
        if (row.document) {
            document = '<a href="' + studentDocUrl + '/' + row.document + '" download target="_blank" class="btn btn-info waves-effect waves-light"><i class="fas fa-cloud-download-alt"></i></a>';
        } else {
            document = '<a href="javascript:void(0)" class="btn btn-secondary waves-effect waves-light"><i class="fas fa-times-circle"></i></a>';
        }
        return document;
    }

    function getRemarksButtons(row) {
        var remarksButtons = '<button type="button" data-id="' + row.id + '" data-status="Approve" class="approveRejectLeave btn btn-success btn-rounded waves-effect waves-light"><span class="btn-label"><i class="mdi mdi-check-all"></i></span>Approve</button>' +
            '&nbsp;<button type="button" data-id="' + row.id + '" data-status="Reject" class="approveRejectLeave btn btn-danger btn-rounded waves-effect waves-light"><span class="btn-label"><i class="mdi mdi-close-circle-outline"></i></span>Reject</button>';
        return remarksButtons;
    }

    function getViewDetailsButton(row) {
        var viewDetailsButton = '<div class="button-list"><a href="javascript:void(0)" class="btn btn-primary-bl waves-effect waves-light" data-id="' + row.id + '"  data-student_id="' + row.student_id + '" id="viewDetails">viewDetails</a></div>';
        return viewDetailsButton;
    }
    //viewDetails
    $(document).on('click', '#viewDetails', function () {
        var student_leave_id = $(this).data('id');
        var student_id = $(this).data('student_id');
        // staffLeaveDetailsShowUrl
        var formData = new FormData();
        formData.append('branch_id', branchID);
        formData.append('student_leave_id', student_leave_id);
        formData.append('student_id', student_id);
        // Display the key/value pairs
        // for (var pair of formData.entries()) {
        //     console.log(pair[0] + ', ' + pair[1]);
        // }
        // formData.append('assign_leave_approval_id', assign_leave_approval_id);
        // formData.append('academic_session_id', academic_session_id);
        $.ajax({
            url: viewStudentLeaveDetailsRow,
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
                    var leave_details = res.data;
                    $('#nursingPopup').modal('show');
                    // var leave_type_details = res.data.leave_type_details;
                    // var assign_leave_approval_details = res.data.assign_leave_approval_details;
                    // // let result = checkValue(assign_leave_approval_details, ref_user_id);

                    // $('#DetailsModal').modal('show');

                    // Parse the date string into a Date object
                    var date = new Date(leave_details.created_at);

                    // Format the date to show time in AM/PM format
                    var formattedDateTime = date.toLocaleString('en-US', {
                        year: 'numeric',
                        month: '2-digit',
                        day: '2-digit',
                        hour: 'numeric',
                        minute: 'numeric',
                        second: 'numeric',
                        hour12: true
                    });

                    var leaveDates = leave_details.from_leave + " / " + leave_details.to_leave;
                    $('#studentLeaveID').val(leave_details.id);
                    $('#studentName').html(leave_details.name);
                    $('#leaveStartEndDate').html(leaveDates);
                    $('#noOfDaysLeave').html(leave_details.total_leave);
                    $('#applyLeaveDate').html(formattedDateTime);
                    $('#documentDetails').html(leave_details.document);
                    $('#showleaveType').html(leave_details.leave_type_name);
                    $('#absentReasonFromParent').html(leave_details.reason);
                    // nursing teacher
                    if (teacher_type == "nursing_teacher") {
                        $('#showleaveTypeTeacher').html(leave_details.teacher_leave_type_name);
                        $('#absentReasonForTeacher').html(leave_details.teacher_reason_name);
                        var student_leave_type_id = leave_details.nursing_leave_type;
                        var nh_reason_id = leave_details.nursing_reason_id;
                        $('#leave_status_name').val(leave_details.nursing_teacher_status);
                        $('#changeLevType').val(leave_details.nursing_leave_type);
                        $('#yourRemarks').val(leave_details.nursing_teacher_remarks);
                    } else {
                        $('#dropLeaveType').html(leave_details.nursing_leave_type_name);
                        $('#absentReason').html(leave_details.nursing_reason_name);
                        var student_leave_type_id = leave_details.teacher_leave_type;
                        var nh_reason_id = leave_details.teacher_reason_id;
                        // $('#showleaveType').html(leave_details.leave_type_name);
                        // $('#absentReasonFromParent').html(leave_details.reason);
                        $('#leave_status_name').val(leave_details.home_teacher_status);
                        $('#changeLevType').val(leave_details.teacher_leave_type);
                        $('#yourRemarks').val(leave_details.teacher_remarks);
                    }
                    $("#changelevReasons").empty();
                    $("#changelevReasons").append('<option value="">' + select_reason + '</option>');
                    if (student_leave_type_id) {
                        $.post(getReasonsByLeaveType, { branch_id: branchID, student_leave_type_id: student_leave_type_id }, function (res) {
                            if (res.code == 200) {
                                $.each(res.data, function (key, val) {
                                    var selected = nh_reason_id == val.id ? "selected" : "";
                                    $("#changelevReasons").append('<option value="' + val.id + '" ' + selected + '>' + val.name + '</option>');
                                });
                            }
                        }, 'json');
                    }
                    // $('#absentReasonForTeacher').html("");
                    // $('#changeLevType').html(leave_details.name);
                    // $('#absentReason').html(leave_details.name);
                    // $('#yourRemarks').html(leave_details.name);
                    // $('#studentLeaveID').html(leave_details.name);

                    // $('#approver_level').val(approver_level);
                    // $('#staffName').html(leave_details.name);
                    // $('#leaveDates').html(leave_details.from_leave + " / " + leave_details.to_leave);

                    // var durationInHours = 0;
                    // if (leave_details.end_time && leave_details.start_time) {
                    //     durationInHours = showHoursMin(leave_details.start_time, leave_details.end_time);
                    // }
                    // var leave_req = (leave_details.date_diff + 1) + '/ ' + durationInHours;

                    // $('#noOfDays').html(leave_req);
                    // $('#applyDate').html(leave_details.created_at);
                    // $('#leaveType').html(leave_details.leave_type_name);
                    // $('#reason').html(leave_details.reason_name);
                    // $('#leaveRequestFor').html(leave_details.leave_request);
                    // // document
                    // var badgeColor = "";
                    // if (leave_details.status == "Approve") {
                    //     badgeColor = "badge-success";
                    // }
                    // if (leave_details.status == "Reject") {
                    //     badgeColor = "badge-danger";
                    // }
                    // if (leave_details.status == "Pending") {
                    //     badgeColor = "badge-warning";
                    // }
                    // var status = '<span class="badge ' + badgeColor + ' badge-pill">' + leave_details.status + '</span>';
                    // var document = '<a href="' + leaveFilesUrl + '/' + leave_details.document + '" download ><i class="fas fa-cloud-download-alt" data-toggle="tooltip" title="Click to download..!"></i></a>';
                    // $('#documents').html(document);
                    // $('#leave_status').html(status);
                    // // set value
                    // $('#1st_approver_remarks').html(leave_details.level_one_staff_remarks);
                    // $('#2nd_approver_remarks').html(leave_details.level_two_staff_remarks);
                    // $('#3rd_approver_remarks').html(leave_details.level_three_staff_remarks);

                    // $('#assiner_remarks').val(staffRemarks);
                    // $('#leave_status_name').val(staffStatus);
                    // $('#alreadyTakenLeave tbody').empty();
                    // $('#myModal').modal('hide');
                    // var takenLeaveDetails = "";
                    // if (leave_type_details.length > 0) {
                    //     $.each(leave_type_details, function (key, val) {
                    //         takenLeaveDetails += '<tr>' +
                    //             '<td>' + val.leave_type_name + '</td>' +
                    //             '<td>' + val.overall_days + ' Days (' + val.overall_days_by_hours + ' hours )' + '</td>' +
                    //             '<td>' + val.used_leave_days + ' Days (' + val.used_leave_days_by_hours + ' hours )' + '</td>' +
                    //             '<td>' + val.applied_leave_days + ' Days (' + val.applied_leave_days_by_hours + ' hours )' + '</td>' +
                    //             '<td>' + val.balance_days + ' Days (' + val.balance_days_by_hours + ' hours )' + '</td>' +
                    //             '</tr>';

                    //     });
                    // } else {
                    //     takenLeaveDetails += '<tr><td colspan="4" style="text-align: center;"> ' + no_data_available + '</td></tr>';

                    // }
                    // $('#alreadyTakenLeave tbody').append(takenLeaveDetails);
                }
                else {
                    // toastr.error(res.message);

                }
            }
        });
    });
    
    // function setLocalStorageStudentLeaveTeacher(classObj) {

    //     var studentLeaveDetails = new Object();
    //     studentLeaveDetails.class_id = classObj.classID;
    //     studentLeaveDetails.section_id = classObj.sectionID;
    //     // here to attached to avoid localStorage other users to add
    //     studentLeaveDetails.branch_id = branchID;
    //     studentLeaveDetails.role_id = get_roll_id;
    //     studentLeaveDetails.user_id = ref_user_id;
    //     var studentLeaveClassArr = [];
    //     studentLeaveClassArr.push(studentLeaveDetails);
    //     if (get_roll_id == "4") {
    //         // teacher
    //         localStorage.removeItem("teacher_student_leave_details");
    //         localStorage.setItem('teacher_student_leave_details', JSON.stringify(studentLeaveClassArr));
    //     }
    //     if (get_roll_id == "2") {
    //         // Admin

    //         localStorage.removeItem("admin_studentleave_details");
    //         localStorage.setItem('admin_studentleave_details', JSON.stringify(studentLeaveClassArr));
    //     }
    //     return true;
    // }

    // if localStorage
    // if (get_roll_id == "4") {
    //     if (typeof teacher_student_leave_storage !== 'undefined') {
    //         if ((teacher_student_leave_storage)) {
    //             if (teacher_student_leave_storage) {

    //                 console.log('test')
    //                 var teacherStudentLeaveStorage = JSON.parse(teacher_student_leave_storage);
    //                 if (teacherStudentLeaveStorage.length == 1) {
    //                     var classID, sectionID, subjectID, studentID, semesterID, sessionID, userBranchID, userRoleID, userID;
    //                     teacherStudentLeaveStorage.forEach(function (user) {
    //                         classID = user.class_id;
    //                         sectionID = user.section_id;
    //                         userBranchID = user.branch_id;
    //                         userRoleID = user.role_id;
    //                         userID = user.user_id;
    //                     });
    //                     if ((userBranchID == branchID) && (userRoleID == get_roll_id) && (userID == ref_user_id)) {

    //                         $("#changeClassName").val(classID);
    //                         var class_id = classID;
    //                         var section_id = sectionID;
    //                         if (classID) {

    //                             $("#studentLeaveList").find("#sectionID").empty();
    //                             $("#studentLeaveList").find("#sectionID").append('<option value="">' + select_section + '</option>');

    //                             $.post(sectionByClassUrl, {
    //                                 token: token,
    //                                 branch_id: branchID,
    //                                 class_id: class_id,
    //                                 teacher_id: ref_user_id,
    //                                 academic_session_id: academic_session_id
    //                             }, function (res) {
    //                                 if (res.code == 200) {
    //                                     console.log(res)
    //                                     $.each(res.data, function (key, val) {
    //                                         $("#studentLeaveList").find("#sectionID").append('<option value="' + val.section_id + '">' + val.section_name + '</option>');
    //                                     });
    //                                     $("#studentLeaveList").find("#sectionID").val(sectionID);
    //                                 }
    //                             }, 'json');
    //                         }
    //                         $("#overlay").fadeIn(300);
    //                         var formData = new FormData();
    //                         formData.append('token', token);
    //                         formData.append('branch_id', branchID);
    //                         formData.append('class_id', class_id);
    //                         formData.append('section_id', section_id);
    //                         // // subject division
    //                         studentLeaveList(formData);
    //                     }
    //                 }
    //             }
    //         }
    //     }
    // }
    // if (get_roll_id == "2") {
    //     if (typeof admin_studentleave_storage !== 'undefined') {
    //         if ((admin_studentleave_storage)) {
    //             if (admin_studentleave_storage) {

    //                 console.log('test')
    //                 var adminStudentLeaveStorage = JSON.parse(admin_studentleave_storage);
    //                 if (adminStudentLeaveStorage.length == 1) {
    //                     var classID, sectionID, subjectID, studentID, semesterID, sessionID, userBranchID, userRoleID, userID;
    //                     adminStudentLeaveStorage.forEach(function (user) {
    //                         classID = user.class_id;
    //                         sectionID = user.section_id;
    //                         userBranchID = user.branch_id;
    //                         userRoleID = user.role_id;
    //                         userID = user.user_id;
    //                     });
    //                     if ((userBranchID == branchID) && (userRoleID == get_roll_id) && (userID == ref_user_id)) {

    //                         $("#changeClassName").val(classID);
    //                         var class_id = classID;
    //                         var section_id = sectionID;
    //                         if (classID) {

    //                             $("#studentLeaveList").find("#sectionID").empty();
    //                             $("#studentLeaveList").find("#sectionID").append('<option value="">' + select_section + '</option>');

    //                             $.post(sectionByClassUrl, {
    //                                 token: token,
    //                                 branch_id: branchID,
    //                                 class_id: class_id,
    //                                 teacher_id: ref_user_id,
    //                                 academic_session_id: academic_session_id
    //                             }, function (res) {
    //                                 if (res.code == 200) {
    //                                     console.log(res)
    //                                     $.each(res.data, function (key, val) {
    //                                         $("#studentLeaveList").find("#sectionID").append('<option value="' + val.section_id + '">' + val.section_name + '</option>');
    //                                     });
    //                                     $("#studentLeaveList").find("#sectionID").val(sectionID);
    //                                 }
    //                             }, 'json');
    //                         }
    //                         $("#overlay").fadeIn(300);
    //                         var formData = new FormData();
    //                         formData.append('token', token);
    //                         formData.append('branch_id', branchID);
    //                         formData.append('class_id', class_id);
    //                         formData.append('section_id', section_id);
    //                         // // subject division
    //                         studentLeaveList(formData);
    //                     }
    //                 }
    //             }
    //         }
    //     }
    // }
    // start
});