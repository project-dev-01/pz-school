$(function () {
    // $("#analysis_graph").hide();
    // change classroom
    // $('#changeClassName').on('change', function () {
    //     var class_id = $(this).val();
    //     console.log(class_id);
    //     if (class_id != "All") {
    //         $("#byoverallfilter").find("#sectionID").empty();
    //         $("#byoverallfilter").find("#sectionID").append('<option value="">'+select_subject+'</option>');

    //         $.post(getbySubjectnames, { token: token, branch_id: branchID, class_id: class_id }, function (res) {
    //             if (res.code == 200) {
    //                 $("#section_drp_div").show();
    //                 $.each(res.data, function (key, val) {
    //                     $("#byoverallfilter").find("#sectionID").append('<option value="' + val.subject_id + '">' + val.subject_name + '</option>');
    //                 });
    //             }
    //         }, 'json');
    //     }
    //     else if (class_id == "All") {
    //         $("#byoverallfilter").find("#sectionID").empty();
    //         $("#byoverallfilter").find("#sectionID").append('<option value="">'+select_subject+'</option>');

    //         $.get(getbysubjectnamesall, { token: token, branch_id: branchID, class_id: class_id }, function (res) {
    //             if (res.code == 200) {
    //                 $("#section_drp_div").show();
    //                 $.each(res.data, function (key, val) {
    //                     $("#byoverallfilter").find("#sectionID").append('<option value="' + val.subject_id + '">' + val.subject_name + '</option>');
    //                 });
    //             }
    //         }, 'json');
    //     }

    // });
    $("#byoverallfilter").validate({
        rules: {
            class_id: "required",
            //  section_id: "required",
            exam_id: "required",
            year: "required"
        }
    });
    $('#byoverallfilter').on('submit', function (e) {
        e.preventDefault();

        var byclass = $("#byoverallfilter").valid();
        if (byclass === true) {
            var class_id = $("#changeClassName").val();
            var exam_id = $("#examnames").val();
            var year = $("#btwyears").val();
            var semester_id = $("#semester_id").val();
            var session_id = $("#session_id").val();
            // get overall
            
            var formData = {
                year: year,
                classID: class_id,
                semesterID: semester_id,
                sessionID: session_id,
                examID: exam_id,
                userID: userID,
            };
            setLocalStorageForExamResultOverall(formData);
            // download set start
            $("#downExamID").val(exam_id);
            $("#downClassID").val(class_id);
            $("#downSemesterID").val(semester_id);
            $("#downSessionID").val(session_id);
            $("#downAcademicYear").val(year);
            // download set end

            overallList(formData);
        };
    });
    function overallList(formData){

        $("#overlay").fadeIn(300);
        $.post(getoverall, {
            token: token,
            branch_id: branchID,
            exam_id: formData.examID,
            class_id: formData.classID,
            semester_id: formData.semesterID,
            session_id: formData.sessionID,
            academic_year: formData.year
        }, function (response) {

            if (response.code == 200) {
                if (response.data.allbysubject.length > 0) {
                    var datasetnew = response.data;
                    overall_subject(datasetnew);
                    $("#body_content").show();
                    $("#overlay").fadeOut(300);
                } else {
                    toastr.info('No records are available');
                    $("#overlay").fadeOut(300);
                }
            } else {
                toastr.error(data.message);
                $("#body_content").hide();
                $("#overlay").fadeOut(300);
            }

        });
    }
    // by overall

    function setLocalStorageForExamResultOverall(classObj) {

        var examResultOverallDetails = new Object();
        examResultOverallDetails.class_id = classObj.classID;
        examResultOverallDetails.year = classObj.year;
        examResultOverallDetails.exam_id = classObj.examID;
        examResultOverallDetails.semester_id = classObj.semesterID;
        examResultOverallDetails.session_id = classObj.sessionID;
        // here to attached to avoid localStorage other users to add
        examResultOverallDetails.branch_id = branchID;
        examResultOverallDetails.role_id = get_roll_id;
        examResultOverallDetails.user_id = ref_user_id;
        var examResultOverallArr = [];
        examResultOverallArr.push(examResultOverallDetails);
        if (get_roll_id == "2") {
            // admin
            localStorage.removeItem("admin_exam_result_overall_details");
            localStorage.setItem('admin_exam_result_overall_details', JSON.stringify(examResultOverallArr));
        }
        return true;
    }
    // if localStorage
    if (typeof exam_result_overall_storage !== 'undefined') {
        if ((exam_result_overall_storage)) {
            if (exam_result_overall_storage) {
                var examResultOverallStorage = JSON.parse(exam_result_overall_storage);
                if (examResultOverallStorage.length == 1) {
                    var classID, year, examID, semesterID, sessionID, userBranchID, userRoleID, userID;
                    examResultOverallStorage.forEach(function (user) {
                        classID = user.class_id;
                        year = user.year;
                        sectionID = user.section_id;
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
                        $('#examnames').val(examID);
                        var formData = {
                            year: year,
                            classID: classID,
                            semesterID: semesterID,
                            sessionID: sessionID,
                            examID: examID,
                            userID: userID,
                        };
                        // download set start
                        $("#downExamID").val(examID);
                        $("#downClassID").val(classID);
                        $("#downSemesterID").val(semesterID);
                        $("#downSessionID").val(sessionID);
                        $("#downAcademicYear").val(year);
                        // download set end
            
                        overallList(formData);
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
                name: "By Overall",
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

function overall_subject(datasetnew) {
    $('#overall_body').empty();
    var sno = 0;
    var bysubjectAllTable = "";
    var headers = datasetnew.headers;
    var allbysubject = datasetnew.allbysubject;
    bysubjectAllTable += '<div class="table-responsive">' +
        '<table id="tblbycls" class="table w-100 nowrap table-bordered table-striped table2excel" data-tableName="Test Table 1">' +
        '<thead>' +
        '<tr>' +
        '<th class="align-top" rowspan="2">'+sl_no_lang+'</th>' +
        '<th class="align-top" rowspan="2">'+subject_name_lang+'</th>' +
        '<th class="align-top th-sm - 6 rem" rowspan="2">'+total_student_lang+'</th>' +
        '<th class="align-top" rowspan="2">'+absent_lang+'</th>' +
        '<th class="align-top" rowspan="2">'+present_lang+'</th>';
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
            '<label for="clsname">' + res.subject_name + '</label>' +
            '</td>';
        bysubjectAllTable += '<td class="text-left" rowspan="2">' +
            '<label for="clsname">' + res.addAllStudCnt + '</label>' +
            '</td>';
        bysubjectAllTable += '<td class="text-left">' +
            '<label for="clsname">' + res.absentCnt + '</label>' +
            '</td>';
        bysubjectAllTable += '<td class="text-center">' +
            '<label for="stdcount">' + res.presentCnt + '</label>' +
            '</td>';
        headers.forEach(function (resp) {
            var obj = res.gradecnt;
            var exists = isKey(resp.grade, obj); // true
            if (exists) {
                Object.keys(obj).forEach(key => {
                    if (resp.grade == key) {
                        // bysubjectAllTable += '<td class="text-center">' + key, obj[key] + '</td>';
                        bysubjectAllTable += '<td class="text-center">' + obj[key] + '</td>';
                        // bysubjectAllTable += '<td class="text-center">' + key + '</td>';
                    }
                });
            } else {
                bysubjectAllTable += '<td class="text-center">0</td>';
            }
        });
        bysubjectAllTable += '<td class="text-center">' + res.passCnt + '</td>' +
            '<td class="text-center">' + res.failCnt + '</td>' +
            '<td class="text-center" rowspan="2">' + res.gpa + '</td>' +
            '<td class="text-center" rowspan="2">' + res.pass_percentage + '</td>';
        bysubjectAllTable += '</tr>';
        // show another row percentage
        bysubjectAllTable += '<tr>';
        var absentPer = (res.absentCnt / res.addAllStudCnt) * 100;
        absentPer = parseFloat(absentPer, 10).toFixed(2);
        var presentPer = (res.presentCnt / res.addAllStudCnt) * 100;
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
                        var gradepercentage = (obj[key] / res.addAllStudCnt) * 100;
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
    $("#overall_body").append(bysubjectAllTable);
}
// find matched
function isKey(key, obj) {
    var keys = Object.keys(obj).map(function (x) {
        return x;
    });
    return keys.indexOf(key) !== -1;
}