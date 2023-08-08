$(function () {

    // change classroom
    $('#changeClassName').on('change', function () {
        var class_id = $(this).val();
        console.log(class_id);

        $("#byexamfilter").find("#sectionID").empty();
        $("#byexamfilter").find("#sectionID").append('<option value="">'+select_class+'</option>');
        $("#byexamfilter").find("#examnames").empty();
        $("#byexamfilter").find("#examnames").append('<option value="">'+select_exam+'</option>');

        $.post(sectionByClass, { token: token, branch_id: branchID, class_id: class_id, teacher_id: teacher_id }, function (res) {
            if (res.code == 200) {
                $("#section_drp_div").show();
                $.each(res.data, function (key, val) {
                    $("#byexamfilter").find("#sectionID").append('<option value="' + val.section_id + '">' + val.section_name + '</option>');
                });
            }
        }, 'json');
    });
    // change section
    $('#sectionID').on('change', function () {
        var section_id = $(this).val();
        var class_id = $("#changeClassName").val();
        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
        var yyyy = today.getFullYear();

        today = yyyy + '/' + mm + '/' + dd;
        $("#byexamfilter").find("#examnames").empty();
        $("#byexamfilter").find("#examnames").append('<option value="">'+select_exam+'</option>');
        $.post(examsByclassandsection, {
            token: token,
            branch_id: branchID,
            class_id: class_id,
            section_id: section_id,
            academic_session_id: academic_session_id,
            today: today
        }, function (res) {
            if (res.code == 200) {
                $.each(res.data, function (key, val) {
                    $("#byexamfilter").find("#examnames").append('<option value="' + val.id + '">' + val.name + '</option>');
                });
            }
        }, 'json');
    });
    $("#byexamfilter").validate({
        rules: {
            year: "required",
            class_id: "required",
            section_id: "required",
            exam_id: "required",
            registerno: "required"
        }
    });
    $('#byexamfilter').on('submit', function (e) {
        e.preventDefault();
        var byresult = $("#byexamfilter").valid();
        if (byresult === true) {
            globel_gradecount = [];

            var class_id = $("#changeClassName").val();
            var class_name = $('#changeClassName :selected').text();
            var section_id = $("#sectionID").val();
            var exam_id = $("#examnames").val();
            var registerno = $("#registerno").val();
            var year = $("#btwyears").val();
            var semester_id = $("#semester_id").val();
            var session_id = $("#session_id").val();

            var formData = {
                year: year,
                classID: class_id,
                sectionID: section_id,
                semesterID: semester_id,
                sessionID: session_id,
                registerNo: registerno,
                examID: exam_id,
                userID: userID,
            };
            setLocalStorageForExamResultIndividual(formData);
            // download set start
            $("#downExamID").val(exam_id);
            $("#downClassID").val(class_id);
            $("#downSectionID").val(section_id);
            $("#downRegisterNoID").val(registerno);
            $("#downSemesterID").val(semester_id);
            $("#downSessionID").val(session_id);
            $("#downAcademicYear").val(year);
            // download set end

            // list mode            
            var formData = new FormData();
            formData.append('token', token);
            formData.append('branch_id', branchID);
            formData.append('exam_id', exam_id);
            formData.append('class_id', class_id);
            formData.append('section_id', section_id);
            formData.append('registerno', registerno);
            formData.append('academic_year', year);
            formData.append('semester_id', semester_id);
            formData.append('session_id', session_id);

            examResultIndividual(formData);
            
        };
    });

    function examResultIndividual(formData){
        $("#overlay").fadeIn(300);
        $.ajax({
            url: getbyresult,
            method: "POST",
            data: formData,
            processData: false,
            dataType: 'json',
            contentType: false,
            success: function (response) {
                if (response.code == 200) {
                    if (response.data.allbyStudent.length > 0) {
                        var datasetnew = response.data;
                        examresult_details(datasetnew);
                        $("#overlay").fadeOut(300);
                        $('#exam_details_div').show();
                    } else {
                        $('#byStudentTableAppend').empty();
                        $('#byStudentGeneralDetails').empty();
                        $('#exam_details_div').hide();
                        $("#overlay").fadeOut(300);
                        toastr.info('No records are available');
                    }
                } else {
                    toastr.error(data.message);
                }
            }
        });
    }
    
    function setLocalStorageForExamResultIndividual(classObj) {

        var examResultIndividualDetails = new Object();
        examResultIndividualDetails.class_id = classObj.classID;
        examResultIndividualDetails.section_id = classObj.sectionID;
        examResultIndividualDetails.year = classObj.year;
        examResultIndividualDetails.exam_id = classObj.examID;
        examResultIndividualDetails.semester_id = classObj.semesterID;
        examResultIndividualDetails.register_no = classObj.registerNo;
        examResultIndividualDetails.session_id = classObj.sessionID;
        // here to attached to avoid localStorage other users to add
        examResultIndividualDetails.branch_id = branchID;
        examResultIndividualDetails.role_id = get_roll_id;
        examResultIndividualDetails.user_id = ref_user_id;
        var examResultIndividualArr = [];
        examResultIndividualArr.push(examResultIndividualDetails);
        if (get_roll_id == "2") {
            // admin
            localStorage.removeItem("admin_exam_result_individual_details");
            localStorage.setItem('admin_exam_result_individual_details', JSON.stringify(examResultIndividualArr));
        }
        return true;
    }
    // if localStorage
    if (typeof exam_result_individual_storage !== 'undefined') {
        if ((exam_result_individual_storage)) {
            if (exam_result_individual_storage) {
                var examResultIndividualStorage = JSON.parse(exam_result_individual_storage);
                if (examResultIndividualStorage.length == 1) {
                    var classID, year, sectionID, registerNo, examID, semesterID, sessionID, userBranchID, userRoleID, userID;
                    examResultIndividualStorage.forEach(function (user) {
                        classID = user.class_id;
                        year = user.year;
                        sectionID = user.section_id;
                        examID = user.exam_id;
                        registerNo = user.register_no;
                        semesterID = user.semester_id;
                        sessionID = user.session_id;
                        userBranchID = user.branch_id;
                        userRoleID = user.role_id;
                        userID = user.user_id;
                    });
                    if ((userBranchID == branchID) && (userRoleID == get_roll_id) && (userID == ref_user_id)) {
                        $('#changeClassName').val(classID);
                        $("#btwyears").val(year);
                        $('#registerno').val(registerNo);
                        $('#semester_id').val(semesterID);
                        $('#section_id').val(sectionID);
                        $('#session_id').val(sessionID);
                        $('#examnames').val(examID);

                        if(sectionID){
                            
                            var today = new Date();
                            var dd = String(today.getDate()).padStart(2, '0');
                            var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
                            var yyyy = today.getFullYear();

                            today = yyyy + '/' + mm + '/' + dd;
                            $("#byexamfilter").find("#examnames").empty();
                            $("#byexamfilter").find("#examnames").append('<option value="">'+select_exam+'</option>');
                            $.post(examsByclassandsection, {
                                token: token,
                                branch_id: branchID,
                                class_id: classID,
                                section_id: sectionID,
                                academic_session_id: year,
                                today: today
                            }, function (res) {
                                if (res.code == 200) {
                                    $.each(res.data, function (key, val) {
                                        $("#byexamfilter").find("#examnames").append('<option value="' + val.id + '">' + val.name + '</option>');
                                    });
                                    $("#byexamfilter").find("#examnames").val(examID);
                                }
                            }, 'json');
                        }
                        // download set start
                        $("#downExamID").val(examID);
                        $("#downClassID").val(classID);
                        $("#downSemesterID").val(semesterID);
                        $("#downSessionID").val(sessionID);
                        $("#downAcademicYear").val(year);
                        // download set end
                            
                        var formData = new FormData();
                        formData.append('token', token);
                        formData.append('branch_id', branchID);
                        formData.append('exam_id', examID);
                        formData.append('class_id', classID);
                        formData.append('section_id', sectionID);
                        formData.append('registerno', registerNo);
                        formData.append('academic_year', year);
                        formData.append('semester_id', semesterID);
                        formData.append('session_id', sessionID);

                        examResultIndividual(formData);
                    }
                }
            }
        }
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


function setLocalStorageEmployeeAttendanceTeacher(classObj) {

    var employeeAttendanceDetails = new Object();
    employeeAttendanceDetails.date = classObj.date;
    employeeAttendanceDetails.session_id = classObj.sessionID;
    // here to attached to avoid localStorage other users to add
    employeeAttendanceDetails.branch_id = branchID;
    employeeAttendanceDetails.role_id = get_roll_id;
    employeeAttendanceDetails.user_id = ref_user_id;
    var employeeAttendanceClassArr = [];
    employeeAttendanceClassArr.push(employeeAttendanceDetails);
    if (get_roll_id == "4") {
        // teacher
        localStorage.removeItem("teacher_employee_attendance_details");
        localStorage.setItem('teacher_employee_attendance_details', JSON.stringify(employeeAttendanceClassArr));
    }
    return true;
}
function examresult_details(datasetnew) {

    $('#byStudentTableAppend').empty();
    $('#byStudentGeneralDetails').empty();
    var sno = 0;
    var bysubjectAllTable = "";
    var byStudGenDetails = "";
    var headers = datasetnew.headers;
    var grade_list_master = datasetnew.allbyStudent;
    var student_details = datasetnew.student_details;
    // append student details start
    byStudGenDetails += '<div class="table-responsive">' +
        '<table  class="table table-bordered mb-0" id="tbl_general_details">' +
        '<thead>';
    byStudGenDetails += '<tr>' +
        '<th>'+roll_no_lang+'</th>' +
        '<td>' + student_details.register_no + '</td>' +
        '</tr>';
    byStudGenDetails += '<tr>' +
        '<th>'+name_lang+'</th>' +
        '<td>' + student_details.student_name + '</td>' +
        '</tr>';
    byStudGenDetails += '<tr>' +
        '<th>'+dob_lang+'</th>' +
        '<td>' + student_details.birthday + '</td>' +
        '</tr>';
    byStudGenDetails += '<tr>' +
        '<th>'+grade_lang+'</th>' +
        '<td>' + student_details.class_name + '</td>' +
        '</tr>';
    byStudGenDetails += '<tr>' +
        '<th>'+class_lang+'</th>' +
        '<td>' + student_details.section_name + '</td>' +
        '</tr>';
    byStudGenDetails += '</thead></table>' +
        '</div>';
    $("#byStudentGeneralDetails").append(byStudGenDetails);
    // append student details end
    bysubjectAllTable += '<div class="table-responsive">' +
        '<table class="table w-100 nowrap table-bordered table-striped table2excel">' +
        '<thead>';
    bysubjectAllTable += '<tr>' +
        '<th>'+sl_no_lang+'.</th>' +
        '<th>'+student_name_lang+'</th>';
    headers.forEach(function (resps) {
        bysubjectAllTable += '<th>' + resps.subject_name + '</th>';
    });
    bysubjectAllTable += '<th rowspan="2">'+gpa_lang+'</th>';

    bysubjectAllTable += '</tr>';
    bysubjectAllTable += '</thead><tbody>';
    grade_list_master.forEach(function (res) {
        sno++;
        bysubjectAllTable += '<tr>' +
            '<td class="text-center" rowspan="2">';
        bysubjectAllTable += sno +
            '</td>';
        bysubjectAllTable += '<td class="text-center" rowspan="2">' + res.student_name + '</td>';
        headers.forEach(function (resp) {
            // header subject id
            var subject_id = resp.subject_id;
            //subject array
            var marksArr = res.student_class;
            // here find index of array
            var index = marksArr.findIndex(x => x.subject_id === subject_id);
            if (index !== -1) {
                bysubjectAllTable += '<td class="text-center">' + marksArr[index].grade + '</td>';
            } else {
                bysubjectAllTable += '<td class="text-center">-</td>';
            }
        });
        bysubjectAllTable += '<td class="text-center" rowspan="2">' + res.gpa + '</td>';
        bysubjectAllTable += '</tr>';
        // 2nd row
        bysubjectAllTable += '<tr>';
        headers.forEach(function (resp) {
            // header subject id
            var subject_id = resp.subject_id;
            //subject array
            var marksArr = res.student_class;
            // here find index of array
            var index = marksArr.findIndex(x => x.subject_id === subject_id);
            if (index !== -1) {
                bysubjectAllTable += '<td class="text-center">' + marksArr[index].marks + '</td>';
            } else {
                bysubjectAllTable += '<td class="text-center">-</td>';
            }
        });
        bysubjectAllTable += '</tr>';
    });
    bysubjectAllTable += '</tbody></table>' +
        '</div>';
    $("#byStudentTableAppend").append(bysubjectAllTable);
}


