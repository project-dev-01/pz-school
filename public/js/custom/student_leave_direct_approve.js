$(function () {

    // $("#department_id").on('change', function (e) {
    //     e.preventDefault();
    //     var Selector = '#stdGeneralDetails';
    //     var department_id = $(this).val();
    //     var classID = "";
    //     classAllocation(department_id, Selector, classID);
    // });
    $("#directchangeLevType").on('change', function (e) {
        e.preventDefault();
        var student_leave_type_id = $(this).val();
        $("#stdGeneralDetails").find("#changelevReasons").empty();
        $("#stdGeneralDetails").find("#changelevReasons").append('<option value="">' + select_reason + '</option>');
        $.post(getReasonsByLeaveType, { branch_id: branchID, student_leave_type_id: student_leave_type_id }, function (res) {
            if (res.code == 200) {
                $.each(res.data, function (key, val) {
                    $("#stdGeneralDetails").find("#changelevReasons").append('<option value="' + val.id + '">' + val.name + '</option>');
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
    $('#directClassName').on('change', function () {
        var class_id = $(this).val();
        $("#stdGeneralDetails").find("#directsectionID").empty();
        $("#stdGeneralDetails").find("#directsectionID").append('<option value="">' + select_section + '</option>');

        $.post(sectionByClassUrl, {
            token: token,
            branch_id: branchID,
            class_id: class_id,
            teacher_id: ref_user_id,
            academic_session_id: academic_session_id
        }, function (res) {
            if (res.code == 200) {
                console.log(res)
                $.each(res.data, function (key, val) {
                    $("#stdGeneralDetails").find("#directsectionID").append('<option value="' + val.section_id + '">' + val.section_name + '</option>');
                });
            }
        }, 'json');
    });
    $("#directsectionID").on('change', function (e) {
        e.preventDefault();
        var class_id = $("#directClassName").val();
        var section_id = $(this).val();
        $("#stdGeneralDetails").find("#changeStdName").empty();
        $("#stdGeneralDetails").find("#changeStdName").append('<option value="">' + select_student + '</option>');
        $.post(getStudentList, { token: token, branch_id: branchID, class_id: class_id, academic_session_id: academic_session_id, section_id: section_id }, function (res) {
            if (res.code == 200) {
                $.each(res.data, function (key, val) {
                    $("#stdGeneralDetails").find("#changeStdName").append('<option value="' + val.id + '">' + val.name + '</option>');
                });
            }
        }, 'json');
    });
    $("#frm_ldate").datepicker({
        dateFormat: 'dd-mm-yy',
        changeMonth: true,
        changeYear: true,
        autoclose: true,
        yearRange: "-100:+50", // last hundred years
        minDate: 0
    });
    $("#to_ldate").datepicker({
        dateFormat: 'dd-mm-yy',
        changeMonth: true,
        changeYear: true,
        autoclose: true,
        yearRange: "-100:+50", // last hundred years
        minDate: 0
    });
    $("#to_ldate").on('change', function () {
        let frm_ldate = $("#frm_ldate").val();
        let to_ldate = $("#to_ldate").val();
        const businessDays = getBusinessDays(convertDigitIn(frm_ldate), convertDigitIn(to_ldate));
        $("#total_leave").val(businessDays);
    });
    // reverse dob
    function convertDigitIn(str) {
        return str.split('-').reverse().join('-');
    }
    const getBusinessDays = (startDate, endDate) => {
        const start = new Date(startDate);
        const end = new Date(endDate);
        const current = new Date(startDate);
        const dates = [];

        while (current <= end) {
            if (current.getDay() !== 6 && current.getDay() !== 0) {
                dates.push(new Date(current));
            }

            current.setDate(current.getDate() + 1);
        }

        return dates.length;
    }
    $('#leave_file').change(function () {
        var file = $('#leave_file')[0].files[0];
        if (file.size > 2097152) {
            $('#file_name').text("File greater than 2Mb");
            $("#file_name").addClass("error");
            $('#leave_file').val('');
        } else {
            $("#file_name").removeClass("error");
            $('#file_name').text(file.name);
        }
    });
    // rules validation
    $("#stdGeneralDetails").validate({
        rules: {
            direct_department_id: "required",
            class_id: "required",
            section_id: "required",
            changeStdName: "required",
            to_ldate: "required",
            frm_ldate: "required",
            total_leave: "required",
            directchangeLevType: "required",
            changelevReasons: "required",
            stud_leave_status: "required"
        }
    });
    $('#stdGeneralDetails').on('submit', function (e) {
        e.preventDefault();
        var start = convertDigitIn($("#frm_ldate").val());
        var end = convertDigitIn($("#to_ldate").val());
        let startDate = new Date(start);
        let endDate = new Date(end);
        if (startDate > endDate) {
            toastr.error("To date should be greater than leave from");
            $("to_ldate").val("");
            return false;
        }
        var std_details = $("#stdGeneralDetails").valid();

        if (std_details === true) {
            var form = this;
            var class_id = $('#directClassName').val();
            var section_id = $('#directsectionID').val();
            var student_id = $("#changeStdName").val();
            var frm_leavedate = $("#frm_ldate").val();
            var to_leavedate = $("#to_ldate").val();
            var total_leave = $("#total_leave").val();
            var changeLevType = $("#directchangeLevType").val();
            var reason = $("#changelevReasons").val();
            var remarks = $("#txtarea_prev_remarks").val();
            var leave_status = $("#stud_leave_status").val();

            var formData = new FormData();
            formData.append('branch_id', branchID);
            formData.append('class_id', class_id);
            formData.append('section_id', section_id);
            formData.append('student_id', student_id);
            formData.append('frm_leavedate', frm_leavedate);
            formData.append('to_leavedate', to_leavedate);
            formData.append('total_leave', total_leave);
            formData.append('change_lev_type', changeLevType);
            formData.append('reason', reason);
            formData.append('remarks', remarks);
            formData.append('leave_status', leave_status);
            formData.append('file', $('input[type=file]')[0].files[0]);
            // Display the key/value pairs
            // for (var pair of formData.entries()) {
            //     console.log(pair[0] + ', ' + pair[1]);
            // }
            // return false;
            $.ajax({
                url: $(form).attr('action'),
                method: $(form).attr('method'),
                data: formData,
                processData: false,
                dataType: 'json',
                contentType: false,
                success: function (response) {
                    if (response.code == 200) {
                        // $('#studentleave-table').DataTable().ajax.reload(null, false);
                        toastr.success('Leave apply sucessfully');
                        $('#stdGeneralDetails')[0].reset();
                        $("#file_name").html("");
                    } else {
                        toastr.error(response.message);
                    }
                }
            });
        };
    });
    // studentAllReasons
    $(document).on('click', '#studentAllReasons', function () {
        // staffLeaveDetailsShowUrl
        $.get(leaveTypeWiseGetAllReason,
            {
                branch_id: branchID
            }, function (res) {                
                $("#showAllReasons").empty();
                $('#knowtheReasons').modal('show');
                if (res.code == 200) {
                    const jsonObject = JSON.parse(res.data);
                    var appendData = displayLeaveTypesAndReasonsTable(jsonObject);
                    $("#showAllReasons").append(appendData);
                }
            }, 'json');
    });
    // Function to parse reasons JSON string
    function parseReasons(reasonsString) {
        return JSON.parse(reasonsString);
    }
    // Function to display leave types and corresponding reasons in a table format
    function displayLeaveTypesAndReasonsTable(data) {
        const table = document.createElement('table');
        table.classList.add('table', 'table-responsive');

        const thead = document.createElement('thead');
        const tbody = document.createElement('tbody');

        const headerRow = thead.insertRow();
        const leaveTypesSet = new Set();

        // Extract unique leave types
        Object.values(data).forEach(entry => {
            leaveTypesSet.add(entry.leave_type);
        });

        const uniqueLeaveTypes = Array.from(leaveTypesSet);

        // Create table headers with leave types
        uniqueLeaveTypes.forEach(leaveType => {
            const header = document.createElement('th');
            header.textContent = leaveType;
            headerRow.appendChild(header);
        });

        // Find reasons for each leave type and populate the table
        const maxReasonsCount = Math.max(...Object.values(data).map(entry => parseReasons(entry.reasons).length));

        for (let i = 0; i < maxReasonsCount; i++) {
            const row = tbody.insertRow();

            uniqueLeaveTypes.forEach(leaveType => {
                const cell = row.insertCell();
                const reasons = Object.values(data)
                    .filter(entry => entry.leave_type === leaveType)
                    .map(entry => parseReasons(entry.reasons))
                    .flat();

                if (reasons[i]) {
                    cell.textContent = reasons[i].reason;
                }
            });
        }

        table.appendChild(thead);
        table.appendChild(tbody);
        return table;
        // document.body.appendChild(table); // Append the table to the body or your desired element
    }
    //viewDetails
    // $(document).on('click', '#viewDetails', function () {
    //     var student_leave_id = $(this).data('id');
    //     var student_id = $(this).data('student_id');
    //     // staffLeaveDetailsShowUrl
    //     var formData = new FormData();
    //     formData.append('branch_id', branchID);
    //     formData.append('student_leave_id', student_leave_id);
    //     formData.append('student_id', student_id);
    //     // Display the key/value pairs
    //     // for (var pair of formData.entries()) {
    //     //     console.log(pair[0] + ', ' + pair[1]);
    //     // }
    //     // formData.append('assign_leave_approval_id', assign_leave_approval_id);
    //     // formData.append('academic_session_id', academic_session_id);
    //     $.ajax({
    //         url: viewStudentLeaveDetailsRow,
    //         method: "post",
    //         data: formData,
    //         processData: false,
    //         dataType: 'json',
    //         contentType: false,
    //         success: function (res) {
    //             console.log("------****----");
    //             console.log(res);
    //             if (res.code == 200) {
    //                 // $('#all-leave-list').DataTable().ajax.reload(null, false);
    //                 // toastr.success(res.message);
    //                 // DetailsModal
    //                 var leave_details = res.data;
    //                 console.log(leave_details);
    //                 $('#nursingPopup').modal('show');
    //                 // var leave_type_details = res.data.leave_type_details;
    //                 // var assign_leave_approval_details = res.data.assign_leave_approval_details;
    //                 // // let result = checkValue(assign_leave_approval_details, ref_user_id);

    //                 // $('#DetailsModal').modal('show');

    //                 // Parse the date string into a Date object
    //                 var date = new Date(leave_details.created_at);

    //                 // Format the date to show time in AM/PM format
    //                 var formattedDateTime = date.toLocaleString('en-US', {
    //                     year: 'numeric',
    //                     month: '2-digit',
    //                     day: '2-digit',
    //                     hour: 'numeric',
    //                     minute: 'numeric',
    //                     second: 'numeric',
    //                     hour12: true
    //                 });

    //                 var leaveDates = leave_details.from_leave + " / " + leave_details.to_leave;
    //                 $('#studentLeaveID').val(leave_details.id);
    //                 $('#studentName').html(leave_details.name);
    //                 $('#leaveStartEndDate').html(leaveDates);
    //                 $('#noOfDaysLeave').html(leave_details.total_leave);
    //                 $('#applyLeaveDate').html(formattedDateTime);
    //                 $('#documentDetails').html(leave_details.document);
    //                 $('#showleaveType').html(leave_details.leave_type_name);
    //                 $('#absentReasonFromParent').html(leave_details.reason);
    //                 // nursing teacher
    //                 if (teacher_type == "nursing_teacher") {
    //                     console.log("-----" + teacher_type)
    //                     $('#showleaveTypeTeacher').html(leave_details.teacher_leave_type_name);
    //                     $('#absentReasonForTeacher').html(leave_details.teacher_reason_name);
    //                     var student_leave_type_id = leave_details.nursing_leave_type;
    //                     var nh_reason_id = leave_details.nursing_reason_id;
    //                     $('#leave_status_name').val(leave_details.nursing_teacher_status);
    //                     $('#changeLevType').val(leave_details.nursing_leave_type);
    //                     $('#yourRemarks').val(leave_details.nursing_teacher_remarks);
    //                 } else {
    //                     $('#dropLeaveType').html(leave_details.nursing_leave_type_name);
    //                     $('#absentReason').html(leave_details.nursing_reason_name);
    //                     console.log("-****--" + teacher_type)
    //                     var student_leave_type_id = leave_details.teacher_leave_type;
    //                     var nh_reason_id = leave_details.teacher_reason_id;
    //                     // $('#showleaveType').html(leave_details.leave_type_name);
    //                     // $('#absentReasonFromParent').html(leave_details.reason);
    //                     $('#leave_status_name').val(leave_details.home_teacher_status);
    //                     $('#changeLevType').val(leave_details.teacher_leave_type);
    //                     $('#yourRemarks').val(leave_details.teacher_remarks);
    //                 }
    //                 console.log("leave_details")
    //                 console.log(leave_details)
    //                 console.log(student_leave_type_id)
    //                 console.log(nh_reason_id)
    //                 $("#changelevReasons").empty();
    //                 $("#changelevReasons").append('<option value="">' + select_reason + '</option>');
    //                 if (student_leave_type_id) {
    //                     $.post(getReasonsByLeaveType, { branch_id: branchID, student_leave_type_id: student_leave_type_id }, function (res) {
    //                         if (res.code == 200) {
    //                             $.each(res.data, function (key, val) {
    //                                 var selected = nh_reason_id == val.id ? "selected" : "";
    //                                 $("#changelevReasons").append('<option value="' + val.id + '" ' + selected + '>' + val.name + '</option>');
    //                             });
    //                         }
    //                     }, 'json');
    //                 }
    //                 // $('#absentReasonForTeacher').html("");
    //                 // $('#changeLevType').html(leave_details.name);
    //                 // $('#absentReason').html(leave_details.name);
    //                 // $('#yourRemarks').html(leave_details.name);
    //                 // $('#studentLeaveID').html(leave_details.name);

    //                 // $('#approver_level').val(approver_level);
    //                 // $('#staffName').html(leave_details.name);
    //                 // $('#leaveDates').html(leave_details.from_leave + " / " + leave_details.to_leave);

    //                 // var durationInHours = 0;
    //                 // if (leave_details.end_time && leave_details.start_time) {
    //                 //     durationInHours = showHoursMin(leave_details.start_time, leave_details.end_time);
    //                 // }
    //                 // var leave_req = (leave_details.date_diff + 1) + '/ ' + durationInHours;

    //                 // $('#noOfDays').html(leave_req);
    //                 // $('#applyDate').html(leave_details.created_at);
    //                 // $('#leaveType').html(leave_details.leave_type_name);
    //                 // $('#reason').html(leave_details.reason_name);
    //                 // $('#leaveRequestFor').html(leave_details.leave_request);
    //                 // // document
    //                 // var badgeColor = "";
    //                 // if (leave_details.status == "Approve") {
    //                 //     badgeColor = "badge-success";
    //                 // }
    //                 // if (leave_details.status == "Reject") {
    //                 //     badgeColor = "badge-danger";
    //                 // }
    //                 // if (leave_details.status == "Pending") {
    //                 //     badgeColor = "badge-warning";
    //                 // }
    //                 // var status = '<span class="badge ' + badgeColor + ' badge-pill">' + leave_details.status + '</span>';
    //                 // var document = '<a href="' + leaveFilesUrl + '/' + leave_details.document + '" download ><i class="fas fa-cloud-download-alt" data-toggle="tooltip" title="Click to download..!"></i></a>';
    //                 // $('#documents').html(document);
    //                 // $('#leave_status').html(status);
    //                 // // set value
    //                 // $('#1st_approver_remarks').html(leave_details.level_one_staff_remarks);
    //                 // $('#2nd_approver_remarks').html(leave_details.level_two_staff_remarks);
    //                 // $('#3rd_approver_remarks').html(leave_details.level_three_staff_remarks);

    //                 // $('#assiner_remarks').val(staffRemarks);
    //                 // $('#leave_status_name').val(staffStatus);
    //                 // $('#alreadyTakenLeave tbody').empty();
    //                 // $('#myModal').modal('hide');
    //                 // var takenLeaveDetails = "";
    //                 // if (leave_type_details.length > 0) {
    //                 //     $.each(leave_type_details, function (key, val) {
    //                 //         takenLeaveDetails += '<tr>' +
    //                 //             '<td>' + val.leave_type_name + '</td>' +
    //                 //             '<td>' + val.overall_days + ' Days (' + val.overall_days_by_hours + ' hours )' + '</td>' +
    //                 //             '<td>' + val.used_leave_days + ' Days (' + val.used_leave_days_by_hours + ' hours )' + '</td>' +
    //                 //             '<td>' + val.applied_leave_days + ' Days (' + val.applied_leave_days_by_hours + ' hours )' + '</td>' +
    //                 //             '<td>' + val.balance_days + ' Days (' + val.balance_days_by_hours + ' hours )' + '</td>' +
    //                 //             '</tr>';

    //                 //     });
    //                 // } else {
    //                 //     takenLeaveDetails += '<tr><td colspan="4" style="text-align: center;"> ' + no_data_available + '</td></tr>';

    //                 // }
    //                 // $('#alreadyTakenLeave tbody').append(takenLeaveDetails);
    //             }
    //             else {
    //                 // toastr.error(res.message);

    //             }
    //         }
    //     });
    // });
});