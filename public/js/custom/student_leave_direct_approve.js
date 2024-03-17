$(function () {

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
        // minDate: 0
    });
    $("#to_ldate").datepicker({
        dateFormat: 'dd-mm-yy',
        changeMonth: true,
        changeYear: true,
        autoclose: true,
        yearRange: "-100:+50", // last hundred years
        // minDate: 0
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
                    console.log(res.data);
                    console.log(jsonObject);
                    // return false;
                    var appendData = displayLeaveTypesAndReasonsTable(jsonObject);
                    $("#showAllReasons").append(appendData);

                }
            }, 'json');
    });
    // Function to parse reasons JSON string
    function parseReasons(reasonsString) {
        return JSON.parse(reasonsString);
    }
    function displayLeaveTypesAndReasonsTable(data) {
        const table = document.createElement('table');
        table.classList.add('table', 'table-striped');

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
                    .map(entry => ({
                        leave_type_id: entry.leave_type_id, // Include the unique identifier (leave_type_id)
                        reason_id: parseReasons(entry.id)[i], // Include the unique identifier (leave_type_id)
                        reason: parseReasons(entry.reasons)[i]
                    }))
                    .filter(reason => reason);

                if (reasons.length > 0) {
                    const reasonObject = reasons[0].reason; // Access the 'reason' property from the first reason object
                    // Check if the reason is an object (assuming it's a string)
                    const reasonText = typeof reasonObject === 'object' ? reasonObject.reason : reasonObject;

                    cell.textContent = reasonText;

                    // Add a click event listener to each cell
                    cell.addEventListener('click', function () {
                        var selectedLeaveTypeId = reasons[0].leave_type_id;
                        var selectedReasonId = reasons[0].reason_id.id;
                        $("#directchangeLevType").val(selectedLeaveTypeId);

                        // Find the select element
                        $.post(getReasonsByLeaveType, { branch_id: branchID, student_leave_type_id: selectedLeaveTypeId }, function (res) {
                            if (res.code == 200) {
                                $("#changelevReasons").empty();
                                $.each(res.data, function (key, val) {
                                    $("#changelevReasons").append('<option value="' + val.id + '">' + val.name + '</option>');
                                });
                                $("#changelevReasons").val(selectedReasonId);
                            }
                        }, 'json');
                        // Close the modal after selecting the leave type
                        $('#knowtheReasons').modal('hide');
                    });
                    // Add CSS for cell hover color
                    cell.classList.add('hoverable-cell');

                }
            });
        }

        table.appendChild(thead);
        table.appendChild(tbody);
        // document.body.appendChild(table); // Append the table to the body

        // Add CSS for sticky header and cell hover color
        const style = document.createElement('style');
        style.textContent = `
        table {
            font-family: Verdana;
            font-size: 14px;
            border-collapse: collapse;
            width: 600px;
            table-layout: fixed;
        }
        th {
            position: sticky;
            top: 0;
            background-color: #333;
            color: white;
            padding: 15px;
            text-align: left;
            z-index: 2; /* Ensures the header stays above other content */
        }
        .hoverable-cell:hover {
            background-color: yellow;
        }
        td {
            padding: 10px;
            text-align: left;
            z-index: 1; /* Ensures cells stay below header */
        }
        `;
        document.head.appendChild(style);
        return table;
    }

});