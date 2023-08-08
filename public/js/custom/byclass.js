$(function () {
    $("#byclass_analysis").hide();
    // change class name
    $('#changeClassName').on('change', function () {
        var class_id = $(this).val();
        $("#byclassfilter").find("#subjectID").empty();
        $("#byclassfilter").find("#subjectID").append('<option value="">'+select_subject+'</option>');
        $("#byclassfilter").find("#examnames").empty();
        $("#byclassfilter").find("#examnames").append('<option value="">'+select_exam+'</option>');
        $.post(getbySubjectnames, { token: token, branch_id: branchID, class_id: class_id, teacher_id: teacher_id, academic_session_id: academic_session_id }, function (res) {
            if (res.code == 200) {
                $.each(res.data, function (key, val) {
                    $("#byclassfilter").find("#subjectID").append('<option value="' + val.subject_id + '">' + val.subject_name + '</option>');
                });
            }
        }, 'json');
    });
    // change section
    $('#subjectID').on('change', function () {
        var subject_id = $(this).val();
        var class_id = $("#changeClassName").val();
        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
        var yyyy = today.getFullYear();
        today = yyyy + '-' + mm + '-' + dd;
        $("#byclassfilter").find("#examnames").empty();
        $("#byclassfilter").find("#examnames").append('<option value="">'+select_exam+'</option>');
        $.post(examsByclassandsubject, {
            token: token,
            branch_id: branchID,
            class_id: class_id,
            subject_id: subject_id,
            today: today,
            academic_session_id: academic_session_id
        }, function (res) {
            if (res.code == 200) {
                $.each(res.data, function (key, val) {
                    $("#byclassfilter").find("#examnames").append('<option value="' + val.id + '">' + val.name + '</option>');
                });
            }
        }, 'json');
    });
    $("#byclassfilter").validate({
        rules: {
            year: "required",
            class_id: "required",
            subject_id: "required",
            exam_id: "required"
        }
    });
    $('#byclassfilter').on('submit', function (e) {
        e.preventDefault();

        var byclass = $("#byclassfilter").valid();
        if (byclass === true) {
            var year = $("#btwyears").val();
            var class_id = $("#changeClassName").val();
            var subject_id = $("#subjectID").val();
            var semester_id = $("#semester_id").val();
            var session_id = $("#session_id").val();
            var exam_id = $("#examnames").val();
            
            var classObj = {
                year: year,
                classID: class_id,
                subjectID: subject_id,
                semesterID: semester_id,
                sessionID: session_id,
                examID: exam_id,
                userID: userID,
            };
            setLocalStorageForExamResultByClass(classObj);

            // download set start
            $("#downExamID").val(exam_id);
            $("#downClassID").val(class_id);
            $("#downSemesterID").val(semester_id);
            $("#downSessionID").val(session_id);
            $("#downSubjectID").val(subject_id);
            $("#downAcademicYear").val(year);
            // download set end
            var formData = new FormData();
            formData.append('token', token);
            formData.append('branch_id', branchID);
            formData.append('year', year);
            formData.append('class_id', class_id);
            formData.append('subject_id', subject_id);
            formData.append('exam_id', exam_id);
            formData.append('semester_id', semester_id);
            formData.append('session_id', session_id);
            formData.append('academic_year', year);
            examResultByClass(formData);

        };
    });
    function examResultByClass(formData){
        $("#overlay").fadeIn(300);
            // list mode
            $.ajax({
                url: getbyClass,
                method: "Post",
                data: formData,
                processData: false,
                dataType: 'json',
                contentType: false,
                success: function (response) {

                    if (response.code == 200) {
                        if (response.data.allbysubject.length > 0) {
                            var datasetnew = response.data;
                            bysubjectdetails(datasetnew);
                            $("#overlay").fadeOut(300);
                            $("#byclass_bodycontent").show();
                        } else {
                            $("#overlay").fadeOut(300);
                            toastr.info('No records are available');
                        }
                    } else {
                        toastr.error(data.message);
                        $('#byclass_bodycontent').hide();
                    }
                }
            });
    }

    function setLocalStorageForExamResultByClass(classObj) {

        var examResultByClassDetails = new Object();
        examResultByClassDetails.class_id = classObj.classID;
        examResultByClassDetails.year = classObj.year;
        examResultByClassDetails.exam_id = classObj.examID;
        examResultByClassDetails.subject_id = classObj.subjectID;
        examResultByClassDetails.semester_id = classObj.semesterID;
        examResultByClassDetails.session_id = classObj.sessionID;
        // here to attached to avoid localStorage other users to add
        examResultByClassDetails.branch_id = branchID;
        examResultByClassDetails.role_id = get_roll_id;
        examResultByClassDetails.user_id = ref_user_id;
        var examResultByClassClassArr = [];
        examResultByClassClassArr.push(examResultByClassDetails);
        if (get_roll_id == "2") {
            // admin
            localStorage.removeItem("admin_exam_result_by_class_details");
            localStorage.setItem('admin_exam_result_by_class_details', JSON.stringify(examResultByClassClassArr));
        }
        if (get_roll_id == "4") {
            // teacher
            localStorage.removeItem("teacher_exam_result_by_class_details");
            localStorage.setItem('teacher_exam_result_by_class_details', JSON.stringify(examResultByClassClassArr));
        }
        return true;
    }
    // if localStorage
    if (typeof exam_result_by_class_storage !== 'undefined') {
        if ((exam_result_by_class_storage)) {
            if (exam_result_by_class_storage) {
                var ExamResultByClassStorage = JSON.parse(exam_result_by_class_storage);
                if (ExamResultByClassStorage.length == 1) {
                    var classID, year, subjectID, examID, semesterID, sessionID, userBranchID, userRoleID, userID;
                    ExamResultByClassStorage.forEach(function (user) {
                        classID = user.class_id;
                        year = user.year;
                        subjectID = user.subject_id;
                        examID = user.exam_id;
                        semesterID = user.semester_id;
                        sessionID = user.session_id;
                        userBranchID = user.branch_id;
                        userRoleID = user.role_id;
                        userID = user.user_id;
                    });
                    if ((userBranchID == branchID) && (userRoleID == get_roll_id) && (userID == ref_user_id)) {
                        $('#changeClassName').val(classID);
                        $("#btwyears").val(year);
                        $('#semester_id').val(semesterID);
                        $('#session_id').val(sessionID);
                        if (classID) {
                            
                            $("#byclassfilter").find("#subjectID").empty();
                            $("#byclassfilter").find("#subjectID").append('<option value="">'+select_subject+'</option>');
                            $.post(getbySubjectnames, { token: token, branch_id: branchID, class_id: classID, teacher_id: userID, academic_session_id: academic_session_id }, function (res) {
                                if (res.code == 200) {
                                    $.each(res.data, function (key, val) {
                                        $("#byclassfilter").find("#subjectID").append('<option value="' + val.subject_id + '">' + val.subject_name + '</option>');
                                    });
                                    $("#byclassfilter").find("#subjectID").val(subjectID);
                                }
                            }, 'json');
                        }
                        if(subjectID){
                            var today = new Date();
                            var dd = String(today.getDate()).padStart(2, '0');
                            var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
                            var yyyy = today.getFullYear();
                            today = yyyy + '-' + mm + '-' + dd;
                            $("#byclassfilter").find("#examnames").empty();
                            $("#byclassfilter").find("#examnames").append('<option value="">'+select_exam+'</option>');
                            $.post(examsByclassandsubject, {
                                token: token,
                                branch_id: branchID,
                                class_id: classID,
                                subject_id: subjectID,
                                today: today,
                                academic_session_id: academic_session_id
                            }, function (res) {
                                if (res.code == 200) {
                                    $.each(res.data, function (key, val) {
                                        $("#byclassfilter").find("#examnames").append('<option value="' + val.id + '">' + val.name + '</option>');
                                    });
                                    $("#byclassfilter").find("#examnames").val(examID);
                                }
                            }, 'json');
                        }
                        
                        // download set start
                        $("#downExamID").val(examID);
                        $("#downClassID").val(classID);
                        $("#downSemesterID").val(semesterID);
                        $("#downSessionID").val(sessionID);
                        $("#downSubjectID").val(subjectID);
                        $("#downAcademicYear").val(year);
                        // download set end
                        var formData = new FormData();
                        formData.append('token', token);
                        formData.append('branch_id', branchID);
                        formData.append('year', year);
                        formData.append('class_id', classID);
                        formData.append('exam_id', examID);
                        formData.append('subject_id', subjectID);
                        formData.append('semester_id', semesterID);
                        formData.append('session_id', sessionID);
                        formData.append('academic_year', year);
                        examResultByClass(formData);
                    }
                }
            }
        }
    }
    // export excel
    $(document).on('click', '.exportToExcel', function (e) {
        // var table = $(this).prev('.table2excel');
        var table = $('.table2excel');
        if (table && table.length) {
            var preserveColors = (table.hasClass('table2excel_with_colors') ? true : false);
            $(table).table2excel({
                // exclude: ".noExl",
                name: "By Class",
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

///
function bysubjectdetails(datasetnew) {

    $('#byclassTableAppend').empty();
    var sno = 0;
    var bysubjectAllTable = "";
    var headers = datasetnew.headers;
    var allbysubject = datasetnew.allbysubject;
    bysubjectAllTable += '<div class="table-responsive">' +
        '<table id="tblbycls" class="table w-100 nowrap table-bordered table-striped table2excel">' +
        '<thead>' +
        '<tr>' +
        '<th class="align-top" rowspan="2">'+sl_no_lang+'</th>' +
        '<th class="align-top" rowspan="2">'+grade_lang+'</th>' +
        '<th class="align-top th-sm - 6 rem" rowspan="2">'+total_student_lang+'</th>' +
        '<th class="align-top" rowspan="2">'+absent_lang+'</th>' +
        '<th class="align-top" rowspan="2">'+present_lang+'</th>' +
        '<th class="align-top" rowspan="2">'+class_teacher_name_lang+'</th>';
    headers.forEach(function (resp) {
        bysubjectAllTable += '<th class="text-center">' + resp.grade + '</th>';
    });
    bysubjectAllTable += '<th class="align-middle" rowspan="2">'+pass_lang+'</th>' +
        '<th class="align-middle" rowspan="2">'+g_lang+'</th>' +
        '<th class="align-middle" rowspan="2">'+gpa_lang+'</th>' +
        '<th class="align-middle" rowspan="2">%</th>' +
        '</tr>';
    bysubjectAllTable += '<tr>';
    headers.forEach(function (resp) {
        bysubjectAllTable += '<td class="text-center">%</td>';
    });
    bysubjectAllTable += '</tr></thead><tbody>';
    allbysubject.forEach(function (res) {
        sno++;
        bysubjectAllTable += '<tr>' +
            '<td class="text-center" rowspan="2">';
        bysubjectAllTable += sno +
            '</td>';
        bysubjectAllTable += '<td class="text-left" rowspan="2">' +
            '<label for="clsname">' + res.name + "(" + res.section_name + ")" + '</label>' +
            '</td>';
        bysubjectAllTable += '<td class="text-center" rowspan="2">' +
            '<label for="stdcount"> ' + res.totalstudentcount + '</label>' +
            '</td>';
        bysubjectAllTable += '<td class="text-left">' +
            '<label for="clsname">' + res.absent_count + '</label>' +
            '</td>';
        bysubjectAllTable += '<td class="text-center">' +
            '<label for="stdcount">' + res.present_count + '</label>' +
            '</td>';
        bysubjectAllTable += '<td class="text-left" rowspan="2">' +
            '<label for="clsname">' + res.teacher_name + '</label>' +
            '</td>';
        headers.forEach(function (resp) {
            var obj = res.gradecnt;
            var exists = isKey(resp.grade, obj); // true
            if (exists) {
                Object.keys(obj).forEach(key => {
                    if (resp.grade == key) {
                        // bysubjectAllTable += '<td class="text-center">' + key, obj[key] + '</td>';
                        bysubjectAllTable += '<td class="text-center">' + obj[key] + '</td>';
                    }
                });
            } else {
                bysubjectAllTable += '<td class="text-center">0</td>';
            }
        });
        bysubjectAllTable += '<td class="text-center">' + res.pass_count + '</td>' +
            '<td class="text-center">' + res.fail_count + '</td>' +
            '<td class="text-center" rowspan="2">' + res.gpa + '</td>' +
            '<td class="text-center" rowspan="2">' + res.pass_percentage + '</td>';
        bysubjectAllTable += '</tr>';
        // show another row percentage
        bysubjectAllTable += '<tr>';
        var absentPer = (res.absent_count / res.totalstudentcount) * 100;
        absentPer = parseFloat(absentPer, 10).toFixed(2);
        var presentPer = (res.present_count / res.totalstudentcount) * 100;
        presentPer = parseFloat(presentPer, 10).toFixed(2);
        bysubjectAllTable += '<td class="text-left">' +
            '<label for="clsname">' + absentPer + '</label>' +
            '</td>';
        bysubjectAllTable += '<td class="text-center">' +
            '<label for="stdcount">' + presentPer + '</label>' +
            '</td>';
        headers.forEach(function (resp) {
            var obj = res.gradecnt;
            var exists = isKey(resp.grade, obj); // true
            if (exists) {
                Object.keys(obj).forEach(key => {
                    if (resp.grade == key) {
                        // bysubjectAllTable += '<td class="text-center">' + key, obj[key] + '</td>';
                        var gradepercentage = (obj[key] / res.totalstudentcount) * 100;
                        gradepercentage = parseFloat(gradepercentage, 10).toFixed(2);
                        bysubjectAllTable += '<td class="text-center">' + gradepercentage + '</td>';
                    }
                });
            } else {
                bysubjectAllTable += '<td class="text-center">0</td>';
            }
        });
        bysubjectAllTable += '<td class="text-center">' + res.pass_percentage + '</td>' +
            '<td class="text-center">' + res.fail_percentage + '</td>';
        bysubjectAllTable += '</tr>';
    });
    bysubjectAllTable += '</tbody></table>' +
        '</div>';
    $("#byclassTableAppend").append(bysubjectAllTable);
}
// find matched
function isKey(key, obj) {
    var keys = Object.keys(obj).map(function (x) {
        return x;
    });
    return keys.indexOf(key) !== -1;
}  