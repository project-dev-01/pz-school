$(function () {

    // change classroom
    $('#changeClassName').on('change', function () {
        $(".testResultHideSHow").hide();
        var class_id = $(this).val();
        $("#resultsByPaper").find("#sectionID").empty();
        $("#resultsByPaper").find("#sectionID").append('<option value="">'+select_class+'</option>');
        $("#resultsByPaper").find("#examnames").empty();
        $("#resultsByPaper").find("#examnames").append('<option value="">'+select_exam+'</option>');
        $("#resultsByPaper").find("#subjectID").empty();
        $("#resultsByPaper").find("#subjectID").append('<option value="">'+select_subject+'</option>');

        $.post(teacherSectionUrl, { token: token, branch_id: branchID, teacher_id: ref_user_id, class_id: class_id }, function (res) {
            if (res.code == 200) {
                $.each(res.data, function (key, val) {
                    $("#resultsByPaper").find("#sectionID").append('<option value="' + val.section_id + '">' + val.section_name + '</option>');
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
        $("#resultsByPaper").find("#examnames").empty();
        $("#resultsByPaper").find("#examnames").append('<option value="">'+select_exam+'</option>');
        $("#resultsByPaper").find("#subjectID").empty();
        $("#resultsByPaper").find("#subjectID").append('<option value="">'+select_subject+'</option>');

        $.post(subjectByExamNames, {
            token: token,
            branch_id: branchID,
            class_id: class_id,
            section_id: section_id,
            academic_session_id: academic_session_id,
            today: today
        }, function (res) {
            if (res.code == 200) {
                $.each(res.data, function (key, val) {
                    $("#resultsByPaper").find("#examnames").append('<option value="' + val.id + '" >' + val.name + '</option>');
                });
            }
        }, 'json');
    });
    // change subject
    $('#examnames').on('change', function () {
        var exam_id = $(this).val();
        var section_id = $("#sectionID").val();
        var class_id = $("#changeClassName").val();
        var teacher_id = teacherID;
        $("#resultsByPaper").find("#subjectID").empty();
        $("#resultsByPaper").find("#subjectID").append('<option value="">'+select_subject+'</option>');
        $.post(examBySubjects, {
            token: token,
            branch_id: branchID,
            class_id: class_id,
            teacher_id: teacher_id,
            section_id: section_id,
            academic_session_id: academic_session_id,
            exam_id: exam_id
        }, function (res) {
            if (res.code == 200) {
                $.each(res.data, function (key, val) {
                    $("#resultsByPaper").find("#subjectID").append('<option value="' + val.subject_id + '">' + val.subject_name + '</option>');
                });
            }
        }, 'json');
    });
    // by paper result
    $(document).on('click', '.exportToExcel', function (e) {
        // var table = $(this).prev('.table2excel');
        var table = $('.table2excel');
        if (table && table.length) {
            var preserveColors = (table.hasClass('table2excel_with_colors') ? true : false);
            $(table).table2excel({
                // exclude: ".noExl",
                name: "By Paper Results",
                filename: downloadFileName + new Date().toISOString().replace(/[\-\:\.]/g, "") + ".xls",
                fileext: ".xls",
                exclude_img: true,
                exclude_links: true,
                exclude_inputs: true,
                preserveColors: preserveColors
            });
        }
    });
    // applyFilter
    // rules validation
    $("#resultsByPaper").validate({
        rules: {
            class_id: "required",
            section_id: "required",
            subject_id: "required",
            exam_id: "required"
        }
    });
    // data bind 
    $('#resultsByPaper').on('submit', function (e) {
        e.preventDefault();
        var valid = $("#resultsByPaper").valid();
        if (valid === true) {
            var class_id = $("#changeClassName").val();
            var section_id = $("#sectionID").val();
            var subject_id = $("#subjectID").val();
            var exam_id = $("#examnames").val();
            var semester_id = $("#semester_id").val();
            var session_id = $("#session_id").val();

            var classObj = {
                classID: class_id,
                sectionID: section_id,
                subjectID: subject_id,
                examID: exam_id,
                semesterID: semester_id,
                sessionID: session_id,
                academic_session_id: academic_session_id,
                userID: userID,
            };

            setLocalStorageForExamPaperResult(classObj);
            var formData = new FormData();
            formData.append('token', token);
            formData.append('branch_id', branchID);
            formData.append('class_id', class_id);
            formData.append('section_id', section_id);
            formData.append('subject_id', subject_id);
            formData.append('exam_id', exam_id);
            formData.append('semester_id', semester_id);
            formData.append('session_id', session_id);
            formData.append('academic_session_id', academic_session_id);
            $("#overlay").fadeIn(300);
            examPaperResult(formData);
        };
    });
    

    function examPaperResult(formData){
        
        $.ajax({
            url: getExamPaperResults,
            method: "post",
            data: formData,
            processData: false,
            dataType: 'json',
            contentType: false,
            success: function (response) {
                if (response.code == 200) {
                    if (response.data.get_subject_paper_marks.length > 0) {
                        var datasetnew = response.data;
                        paperwiseresult(datasetnew);
                        // download set start
                        $("#downExamID").val(formData.exam_id);
                        $("#downClassID").val(formData.class_id);
                        $("#downSectionID").val(formData.section_id);
                        $("#downSemesterID").val(formData.semester_id);
                        $("#downSessionID").val(formData.session_id);
                        $("#downSubjectID").val(formData.subject_id);
                        $("#downAcademicYear").val(formData.academic_session_id);
                        // download set end
                        $("#body_content").show();
                        $("#overlay").fadeOut(300);
                    } else {
                        toastr.info('No records are available');
                        $("#body_content").hide();
                        $("#overlay").fadeOut(300);
                    }
                } else {
                    toastr.error(data.message);
                    $("#body_content").hide();
                    $("#overlay").fadeOut(300);
                }

            }, error: function (err) {
                $("#body_content").hide();
                $("#overlay").fadeOut(300);
                toastr.error(err.responseJSON.data.error ? err.responseJSON.data.error : 'Something went wrong');
            }
        });
    }
    
    function setLocalStorageForExamPaperResult(classObj) {

        var examPaperResultDetails = new Object();
        examPaperResultDetails.class_id = classObj.classID;
        examPaperResultDetails.section_id = classObj.sectionID;
        examPaperResultDetails.subject_id = classObj.subjectID;
        examPaperResultDetails.exam_id = classObj.examID;
        examPaperResultDetails.semester_id = classObj.semesterID;
        examPaperResultDetails.session_id = classObj.sessionID;
        // here to attached to avoid localStorage other users to add
        examPaperResultDetails.branch_id = branchID;
        examPaperResultDetails.role_id = get_roll_id;
        examPaperResultDetails.user_id = ref_user_id;
        var examPaperResultClassArr = [];
        examPaperResultClassArr.push(examPaperResultDetails);
        if (get_roll_id == "4") {
            // teacher
            localStorage.removeItem("teacher_exam_paper_result_details");
            localStorage.setItem('teacher_exam_paper_result_details', JSON.stringify(examPaperResultClassArr));
        }
        return true;
    }
    
    // if localStorage
    if (typeof teacher_exam_paper_result_storage !== 'undefined') {
        if ((teacher_exam_paper_result_storage)) {
            if (teacher_exam_paper_result_storage) {
                var teacherExamPaperResultStorage = JSON.parse(teacher_exam_paper_result_storage);
                if (teacherExamPaperResultStorage.length == 1) {
                    var classID, sectionID, subjectID, examID, semesterID, sessionID, userBranchID, userRoleID, userID;
                    teacherExamPaperResultStorage.forEach(function (user) {
                        classID = user.class_id;
                        sectionID = user.section_id;
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
                        $('#semester_id').val(semesterID);
                        $('#session_id').val(sessionID);
                        if (classID) {
                            
                            $("#resultsByPaper").find("#sectionID").empty();
                            $("#resultsByPaper").find("#sectionID").append('<option value="">'+select_class+'</option>');
                            
                            $.post(teacherSectionUrl, { token: token, branch_id: branchID, teacher_id: userID, class_id: classID }, function (res) {
                                if (res.code == 200) {
                                    $.each(res.data, function (key, val) {
                                        $("#resultsByPaper").find("#sectionID").append('<option value="' + val.section_id + '">' + val.section_name + '</option>');
                                    });
                                    $("#resultsByPaper").find("#sectionID").val(sectionID);
                                }
                            }, 'json');
                        }
                        if(sectionID){
                            
                            var today = new Date();
                            var dd = String(today.getDate()).padStart(2, '0');
                            var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
                            var yyyy = today.getFullYear();

                            today = yyyy + '/' + mm + '/' + dd;
                            $("#resultsByPaper").find("#examnames").empty();
                            $("#resultsByPaper").find("#examnames").append('<option value="">'+select_exam+'</option>');

                            $.post(subjectByExamNames, {
                                token: token,
                                branch_id: branchID,
                                class_id: classID,
                                section_id: sectionID,
                                academic_session_id: academic_session_id,
                                today: today
                            }, function (res) {
                                if (res.code == 200) {
                                    $.each(res.data, function (key, val) {
                                        $("#resultsByPaper").find("#examnames").append('<option value="' + val.id + '" >' + val.name + '</option>');
                                    });
                                    $("#resultsByPaper").find("#examnames").val(examID);
                                }
                            }, 'json');
                        }

                        if(examID){
                            $("#resultsByPaper").find("#subjectID").empty();
                            $("#resultsByPaper").find("#subjectID").append('<option value="">'+select_subject+'</option>');
                            $.post(examBySubjects, {
                                token: token,
                                branch_id: branchID,
                                class_id: classID,
                                teacher_id: userID,
                                section_id: sectionID,
                                academic_session_id: academic_session_id,
                                exam_id: examID
                            }, function (res) {
                                if (res.code == 200) {
                                    $.each(res.data, function (key, val) {
                                        $("#resultsByPaper").find("#subjectID").append('<option value="' + val.subject_id + '">' + val.subject_name + '</option>');
                                    });
                                    $("#resultsByPaper").find("#subjectID").val(subjectID);
                                }
                            }, 'json');
                        }

                        var formData = new FormData();
                        formData.append('token', token);
                        formData.append('branch_id', branchID);
                        formData.append('class_id', classID);
                        formData.append('section_id', sectionID);
                        formData.append('subject_id', subjectID);
                        formData.append('exam_id', examID);
                        formData.append('semester_id', semesterID);
                        formData.append('session_id', sessionID);
                        formData.append('academic_session_id', academic_session_id);
                        $("#overlay").fadeIn(300);
                        examPaperResult(formData);
                    }
                }
            }
        }
    }

    function paperwiseresult(datasetnew) {
        $('#paper_wise_result_body').empty();
        var sno = 0;
        var bysubjectAllTable = "";
        var headers = datasetnew.all_paper;
        var get_subject_paper_marks = datasetnew.get_subject_paper_marks;
        bysubjectAllTable += '<div class="table-responsive">' +
            '<table class="table w-100 nowrap table-bordered table-striped table2excel" data-tableName="Test Table 1">' +
            '<thead>' +
            '<tr>' +
            '<th class="align-top">'+sl_no_lang+'</th>' +
            '<th class="align-top">'+student_name_lang+'</th>';
        headers.forEach(function (resp) {
            bysubjectAllTable += '<th class="text-center">' + resp.paper_name + '</th>';
        });
        bysubjectAllTable += '<th class="align-middle">'+grade_lang+'</th>' +
            '</tr>';
        bysubjectAllTable += '</thead><tbody>';
        get_subject_paper_marks.forEach(function (res) {
            sno++;
            bysubjectAllTable += '<tr>' +
                '<td class="text-center">';
            bysubjectAllTable += sno +
                '</td>';
            bysubjectAllTable += '<td class="text-left">' +
                '<label for="clsname">' + res.name + '</label>' +
                '</td>';
            var paperRow = res.papers;
            paperRow.forEach(function (resp) {
                bysubjectAllTable += '<td class="text-center">' + resp.toFixed(2) + '</td>';
            });
            bysubjectAllTable += '<td class="text-center">' + res.grade + '</td>';
            bysubjectAllTable += '</tr>';
        });

        bysubjectAllTable += '</tbody></table>' +
            '</div>';
        $("#paper_wise_result_body").append(bysubjectAllTable);
    }
});