var reasonChart;
$(function () {
    // $('#bystudent_bodycontent').hide();
    // $('#bystudent_analysis').hide();
    // change classroom
    // $('#btwyears').on('change', function () {
    //     var class_id = $(this).val();
    //     $("#bystudentfilter").find("#sectionID").empty();
    //     $("#bystudentfilter").find("#sectionID").append('<option value="">'+select_class+'</option>');
    //     $("#bystudentfilter").find("#examnames").empty();
    //     $("#bystudentfilter").find("#examnames").append('<option value="">'+select_exam+'</option>');
    //     $("#bystudentfilter").find("#student_id").empty();
    //     $("#bystudentfilter").find("#student_id").append('<option value="">'+select_student+'</option>');
    //     $.post(sectionByClass, { token: token, branch_id: branchID, class_id: class_id, teacher_id: teacher_id }, function (res) {
    //         if (res.code == 200) {
    //             $.each(res.data, function (key, val) {
    //                 $("#bystudentfilter").find("#sectionID").append('<option value="' + val.section_id + '">' + val.section_name + '</option>');
    //             });
    //         }
    //     }, 'json');

    // });
    // change classroom
    $('#changeClassName').on('change', function () {
        var class_id = $(this).val();
        $("#bystudentfilter").find("#sectionID").empty();
        $("#bystudentfilter").find("#sectionID").append('<option value="">'+select_class+'</option>');
        $("#bystudentfilter").find("#examnames").empty();
        $("#bystudentfilter").find("#examnames").append('<option value="">'+select_exam+'</option>');
        $("#bystudentfilter").find("#student_id").empty();
        $("#bystudentfilter").find("#student_id").append('<option value="">'+select_student+'</option>');
        $.post(sectionByClass, { token: token, branch_id: branchID, class_id: class_id, teacher_id: teacher_id }, function (res) {
            if (res.code == 200) {
                $.each(res.data, function (key, val) {
                    $("#bystudentfilter").find("#sectionID").append('<option value="' + val.section_id + '">' + val.section_name + '</option>');
                });
            }
        }, 'json');
    });
    // change section
    $('#sectionID').on('change', function () {
        var section_id = $(this).val();
        var class_id = $("#changeClassName").val();
        var student_id = "";
        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
        var yyyy = today.getFullYear();

        today = yyyy + '/' + mm + '/' + dd;
        $("#bystudentfilter").find("#examnames").empty();
        $("#bystudentfilter").find("#examnames").append('<option value="">'+select_exam+'</option>');
        $("#bystudentfilter").find("#student_id").empty();
        $("#bystudentfilter").find("#student_id").append('<option value="">'+select_student+'</option>');
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
                    $("#bystudentfilter").find("#examnames").append('<option value="' + val.id + '">' + val.name + '</option>');
                });
            }
        }, 'json');
        var year = $("#btwyears").val();
        getbyStudentDetails(year, class_id, section_id,student_id);
    });
    function getbyStudentDetails(year, class_id, section_id,student_id){
        console.log('tets')
        // var year = $("#btwyears").val();
        $("#student_id").empty();
        $("#student_id").append('<option value="">'+select_student+'</option>');
        $.post(getStudentList, { token: token, branch_id: branchID, class_id: class_id, academic_session_id: year, section_id: section_id }, function (res) {
            if (res.code == 200) {
                $.each(res.data, function (key, val) {
                    $("#student_id").append('<option value="' + val.id + '">' + val.name + '</option>');
                });
                $("#student_id").val(student_id);
            }
        }, 'json');
    }

    $("#bystudentfilter").validate({
        rules: {
            year: "required",
            class_id: "required",
            section_id: "required",
            exam_id: "required"
        }
    });
    $('#bystudentfilter').on('submit', function (e) {
        e.preventDefault();
        var byclass = $("#bystudentfilter").valid();
        if (byclass === true) {
            $("#overlay").fadeIn(300);
            $("#bystudent_body").show("slow");
            var year = $("#btwyears").val();
            var semester_id = $("#semester_id").val();
            var session_id = $("#session_id").val();
            var class_id = $("#changeClassName").val();
            var section_id = $("#sectionID").val();
            var exam_id = $("#examnames").val();
            var student_id = $("#student_id").val();

            var classObj = {
                year: year,
                classID: class_id,
                sectionID: section_id,
                studentID: student_id,
                semesterID: semester_id,
                sessionID: session_id,
                examID: exam_id,
                userID: userID,
            };
            setLocalStorageForExamResultByStudent(classObj);

            
            // download set start
            $("#downExamID").val(exam_id);
            $("#downClassID").val(class_id);
            $("#downSemesterID").val(semester_id);
            $("#downSessionID").val(session_id);
            $("#downSectionID").val(section_id);
            $("#downAcademicYear").val(year);
            // download set end
            var formData = new FormData();
            formData.append('token', token);
            formData.append('branch_id', branchID);
            formData.append('class_id', class_id);
            formData.append('section_id', section_id);
            formData.append('student_id', student_id);
            formData.append('exam_id', exam_id);
            formData.append('semester_id', semester_id);
            formData.append('session_id', session_id);
            formData.append('academic_year', year);
            examResultByStudent(formData);
        };
    });
    function examResultByStudent(formData){

            // list mode
            $.ajax({
                url: getbyStudent,
                method: "Post",
                data: formData,
                processData: false,
                dataType: 'json',
                contentType: false,
                success: function (response) {

                    if (response.code == 200) {
                        if (response.data.allbyStudent.length > 0) {
                            var datasetnew = response.data;
                            bystudentdetails_class(datasetnew);
                            $('#bystudent_bodycontent').show();
                            $("#overlay").fadeOut(300);
                        } else {
                            $("#overlay").fadeOut(300);
                            $('#bystudent_bodycontent').hide();
                            toastr.info('No records are available');
                        }
                    } else {
                        toastr.error(data.message);
                        $('#bystudent_bodycontent').hide();
    
                    }
                }
            });
    }

    function setLocalStorageForExamResultByStudent(classObj) {

        var examResultByStudentDetails = new Object();
        examResultByStudentDetails.class_id = classObj.classID;
        examResultByStudentDetails.section_id = classObj.sectionID;
        examResultByStudentDetails.year = classObj.year;
        examResultByStudentDetails.exam_id = classObj.examID;
        examResultByStudentDetails.student_id = classObj.studentID;
        examResultByStudentDetails.semester_id = classObj.semesterID;
        examResultByStudentDetails.session_id = classObj.sessionID;
        // here to attached to avoid localStorage other users to add
        examResultByStudentDetails.branch_id = branchID;
        examResultByStudentDetails.role_id = get_roll_id;
        examResultByStudentDetails.user_id = ref_user_id;
        var examResultByStudentClassArr = [];
        examResultByStudentClassArr.push(examResultByStudentDetails);
        if (get_roll_id == "4") {
            // teacher
            localStorage.removeItem("teacher_exam_result_by_student_details");
            localStorage.setItem('teacher_exam_result_by_student_details', JSON.stringify(examResultByStudentClassArr));
        }
        return true;
    }
    // if localStorage
    if (typeof teacher_exam_result_by_student_storage !== 'undefined') {
        if ((teacher_exam_result_by_student_storage)) {
            if (teacher_exam_result_by_student_storage) {
                var teacherExamResultByStudentStorage = JSON.parse(teacher_exam_result_by_student_storage);
                if (teacherExamResultByStudentStorage.length == 1) {
                    var classID, year, studentID, sectionID, examID, semesterID, sessionID, userBranchID, userRoleID, userID;
                    teacherExamResultByStudentStorage.forEach(function (user) {
                        classID = user.class_id;
                        year = user.year;
                        sectionID = user.section_id;
                        studentID = user.student_id;
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
                            
                            $("#bystudentfilter").find("#sectionID").empty();
                            $("#bystudentfilter").find("#sectionID").append('<option value="">'+select_class+'</option>');
                            $.post(sectionByClass, { token: token, branch_id: branchID, class_id: classID, teacher_id: userID }, function (res) {
                                if (res.code == 200) {
                                    $.each(res.data, function (key, val) {
                                        $("#bystudentfilter").find("#sectionID").append('<option value="' + val.section_id + '">' + val.section_name + '</option>');
                                    });
                                    $("#bystudentfilter").find("#sectionID").val(sectionID);
                                }
                            }, 'json');
                        }
                        if(sectionID){
                            var today = new Date();
                            var dd = String(today.getDate()).padStart(2, '0');
                            var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
                            var yyyy = today.getFullYear();
                    
                            today = yyyy + '/' + mm + '/' + dd;
                            $("#bystudentfilter").find("#examnames").empty();
                            $("#bystudentfilter").find("#examnames").append('<option value="">'+select_exam+'</option>');
                            $.post(examsByclassandsection, {
                                token: token,
                                branch_id: branchID,
                                class_id: classID,
                                section_id: sectionID,
                                academic_session_id: academic_session_id,
                                today: today
                            }, function (res) {
                                if (res.code == 200) {
                                    $.each(res.data, function (key, val) {
                                        $("#bystudentfilter").find("#examnames").append('<option value="' + val.id + '">' + val.name + '</option>');
                                    });
                                    $("#bystudentfilter").find("#examnames").val(examID);
                                }
                            }, 'json');
                            getbyStudentDetails(year, classID, sectionID,studentID);
                        }
            
                        // download set start
                        $("#downExamID").val(examID);
                        $("#downClassID").val(classID);
                        $("#downSemesterID").val(semesterID);
                        $("#downSessionID").val(sessionID);
                        $("#downSectionID").val(sectionID);
                        $("#downAcademicYear").val(year);
                        // download set end
                        var formData = new FormData();
                        formData.append('token', token);
                        formData.append('branch_id', branchID);
                        formData.append('class_id', classID);
                        formData.append('section_id', sectionID);
                        formData.append('exam_id', examID);
                        formData.append('student_id', studentID);
                        formData.append('semester_id', semesterID);
                        formData.append('session_id', sessionID);
                        formData.append('academic_year', year);
                        examResultByStudent(formData);
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

function bystudentdetails_class(datasetnew) {
    $('#byStudentTableAppend').empty();
    var sno = 0;
    var bysubjectAllTable = "";
    var headers = datasetnew.headers;
    var headercount = datasetnew.headers.length;
    headercount = headercount * 2;
    var grade_list_master = datasetnew.allbyStudent;
    bysubjectAllTable += '<div class="table-responsive">' +
        '<table id="tblbycls" class="table w-100 nowrap table-bordered table-striped table2excel" data-tableName="Test Table 1">' +
        '<thead>';
    bysubjectAllTable += '<tr>' +
        '<th class="align-top" rowspan="3" style="padding-top:72px;">'+sl_no_lang+'</th>' +
        '<th class="align-top" rowspan="3" style="padding: 71px 0px 0px 8px;">'+student_name_lang+'</th>' +
        '<th class="text-center" colspan="' + headercount + '" style="padding: 20px 100px 20px 0px;">'+subject_name_lang+'</th>' +
        '<th class="align-top" rowspan="3" style="padding: 71px 0px 0px 8px;">'+gpa_lang+'</th>' +
        '</tr>';
    bysubjectAllTable += '<tr>';
    headers.forEach(function (resp) {
        bysubjectAllTable += '<th colspan="2" class="text-center" style="padding:7px 0px 7px 0px;">' + resp.subject_name + '</th>';
    });
    bysubjectAllTable += '</tr>';
    bysubjectAllTable += '<tr>';
    headers.forEach(function (resp) {
        bysubjectAllTable += ' <th class="text-center">'+mark_lang+'</th>' +
            '<th class="text-center">'+grade_lang+'</th>';
    });
    bysubjectAllTable += '</tr></thead><tbody>';
    grade_list_master.forEach(function (res) {
        sno++;
        bysubjectAllTable += '<tr>' +
            '<td class="text-center">';
        bysubjectAllTable += sno +
            '</td>';
        bysubjectAllTable += '<td class="text-left">' + res.student_name + '</td>';
        headers.forEach(function (resp) {
            // header subject id
            var subject_id = resp.subject_id;
            //subject array
            var marksArr = res.student_class;
            // here find index of array
            var index = marksArr.findIndex(x => x.subject_id === subject_id);
            if (index !== -1) {
                bysubjectAllTable += '<td class="text-center" style="padding:7px 0px 7px 0px;">' + marksArr[index].marks + '</td>';
                bysubjectAllTable += '<td class="text-center" style="padding:7px 0px 7px 0px;">' + marksArr[index].grade + '</td>';
            } else {
                bysubjectAllTable += '<td class="text-center" style="padding:7px 0px 7px 0px;">-</td>';
                bysubjectAllTable += '<td class="text-center" style="padding:7px 0px 7px 0px;">-</td>';
            }
        });
        bysubjectAllTable += '<td class="text-center">' + res.gpa + '</td>';
        bysubjectAllTable += '</tr>';

    });

    bysubjectAllTable += '</tbody></table>' +
        '</div>';
    $("#byStudentTableAppend").append(bysubjectAllTable);
}