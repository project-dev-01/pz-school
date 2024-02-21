$(function () {


    $("#department_id").on('change', function (e) {
        e.preventDefault();
        var department = $(this).val();
        $("#staff_id").empty();
        $("#staff_id").append('<option value="">' + select_employee + '</option>');
        $("#staff_id").append('<option value="All">' + all_lang + '</option>');
        $.post(employeeByDepartment, { token: token, branch_id: branchID, department_id: department }, function (res) {
            if (res.code == 200) {
                $.each(res.data, function (key, val) {
                    $("#staff_id").append('<option value="' + val.id + '">' + val.first_name + ' ' + val.last_name + '</option>');
                });
            }
        }, 'json');
    });
    // rules validation
    $("#employeeAttendanceReport").validate({
        rules: {
            department_id: "required",
            staff_id: "required",
        }
    });

    $('#employeeAttendanceReport').on('submit', function (e) {
        e.preventDefault();
        var check = $("#employeeAttendanceReport").valid();
        if (check === true) {
            var department_id = $("#department_id").val();
            var staff_id = $("#staff_id").val();
            var formData = new FormData();
            formData.append('token', token);
            formData.append('branch_id', branchID);
            formData.append('department_id', department_id);
            formData.append('staff_id', staff_id);
            formData.append('academic_session_id', academic_session_id);
            $("#employee_attendance").hide("slow");
            $.ajax({
                url: getEmployeLeaveList,
                method: 'post',
                data: formData,
                processData: false,
                dataType: 'json',
                contentType: false,
                success: function (response) {
                    console.log("response");
                    console.log(response);
                    if (response.code == 200) {
                        var datasetnew = response.data;
                        $("#downDepartmentID").val(department_id);
                        $("#downStaffID").val(staff_id);
                        $("#downAcademicSessionID").val(academic_session_id);
                        $("#employee_attendance").show("slow");
                        leaveListDetails(datasetnew);
                    } else {
                        toastr.error(data.message);
                    }
                }
            });
        }
    });
    function leaveListDetails(datasetnew) {
        var headers = datasetnew.headers;
        var headerLength = (datasetnew.headers.length * 3);
        var staff_leave_history = datasetnew.staff_leave_history;
       
        $('#leaveListDetailsAppend').empty();
        var leaveListDetailsAppend = '<div class="table-responsive">' +
            '<table id="alreadyTakenLeave" class="table w-100 nowrap table-bordered table-striped table2excel">' +
            '<thead>' +
            '<tr>' +
            '<th style="border-bottom-style: hidden"></th>' +
            // '<th style="border-bottom-style: hidden"></th>' +
            '<th style="border-bottom-style: hidden"></th>' +
            '<th colspan="' + headerLength + '" style="text-align:center;">'+ leave_type_lang +'</th>' +
            '</tr>' +
            '<tr>' +
            '<th style="border-bottom-style: hidden">'+ department_lang +'</th>' +
            // '<th style="border-bottom-style: hidden">Dep Code</th>' +
            '<th style="border-bottom-style: hidden">'+employee_name_lang+'</th>';
        headers.forEach(function (resps) {
            leaveListDetailsAppend += '<th colspan="3" style="text-align:center;">' + resps.name + '</th>';
        });
        leaveListDetailsAppend += '</tr>' +
            '<tr>' +
            '<th></th>' +
            // '<th></th>' +
            '<th></th>';
        headers.forEach(function (resp) {
            leaveListDetailsAppend += '<th>'+entitlement_lang+'</th>' +
                '<th>'+taken_lang+'</th>' +
                '<th>'+balance_lang+'</th>';
        });
        leaveListDetailsAppend += '</tr>' +
            '</thead>' +
            '<tbody>';
        staff_leave_history.forEach(function (respon) {
            // staff_leave_history
            var leave_history = respon.leave_history;
            leaveListDetailsAppend += '<tr>' +
                '<td>' + respon.department_name + '</td>' +
                // '<td>Office1</td>' +
                '<td>' + respon.name + '</td>';
            // get 
            headers.forEach(function (respss) {
                // header subject id
                var id = respss.id;
                // here find index of array
                var index = leave_history.findIndex(x => x.leave_type === id);
                if (index !== -1) {
                    leaveListDetailsAppend += '<td>' + leave_history[index].overall_days_by_hours + '</td>' +
                        '<td>' + leave_history[index].used_leave_days_by_hours + '</td>' +
                        '<td><b>' + leave_history[index].balance_days_by_hours + '</b></td>';
                } else {
                    leaveListDetailsAppend += '<td>-</td>' +
                        '<td>-</td>' +
                        '<td>-</td>';
                }
            });
            leaveListDetailsAppend += '</tr>';
        });
        leaveListDetailsAppend += '</tbody>' +
            '</table>' +
            '<br>' +
            '</div>';
        $("#leaveListDetailsAppend").append(leaveListDetailsAppend);

    }
    $(document).on('click', '.exportToExcel', function (e) {
        // var table = $(this).prev('.table2excel');
        var table = $('.table2excel');
        if (table && table.length) {
            var preserveColors = (table.hasClass('table2excel_with_colors') ? true : false);
            $(table).table2excel({
                // exclude: ".noExl",
                name: "By Student",
                filename: downloadFileName + new Date().toISOString().replace(/[\-\:\.]/g, "") + ".xls",
                fileext: ".xls",
                exclude_img: true,
                exclude_links: true,
                exclude_inputs: true,
                preserveColors: preserveColors
            });
        }
    });
});