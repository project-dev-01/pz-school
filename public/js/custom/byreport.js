var reasonChart;
$(function () {
    $('#changeClassName').on('change', function () {
        var class_id = $(this).val();
        $("#bysubjectfilter").find("#examnames").empty();
        $("#bysubjectfilter").find("#examnames").append('<option value="">'+select_exam+'</option>');

        $("#bysubjectfilter").find("#sectionID").empty();

        $("#bysubjectfilter").find("#sectionID").append('<option value="">'+select_class+'</option>');


        $.post(sectionByClass, { token: token, branch_id: branchID, class_id: class_id, teacher_id: teacher_id }, function (res) {
            if (res.code == 200) {
                $("#section_drp_div").show();
                $.each(res.data, function (key, val) {
                    $("#bysubjectfilter").find("#sectionID").append('<option value="' + val.section_id + '">' + val.section_name + '</option>');
                });
            }
        }, 'json');

    });
    $("#department_id").on('change', function (e) {
        e.preventDefault();
        var Selector = '#bysubjectfilter';
        var department_id = $(this).val();
        var classID = "";
        classAllocation(department_id, Selector, classID);
    });
    function classAllocation(department_id, Selector, classID) {
        $(Selector).find('select[name="class_id"]').empty();
        $(Selector).find('select[name="class_id"]').append('<option value="">' + select_grade + '</option>');
        $("#bysubjectfilter").find("#examnames").empty();
        $("#bysubjectfilter").find("#examnames").append('<option value="">'+select_exam+'</option>');

        $("#bysubjectfilter").find("#sectionID").empty();

        $("#bysubjectfilter").find("#sectionID").append('<option value="">'+select_class+'</option>');

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
    // change section
    $('#sectionID').on('change', function () {
        var section_id = $(this).val();
        var class_id = $("#changeClassName").val();
        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
        var yyyy = today.getFullYear();

        today = yyyy + '/' + mm + '/' + dd;
        $("#bysubjectfilter").find("#examnames").empty();
        $("#bysubjectfilter").find("#examnames").append('<option value="">'+select_exam+'</option>');
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
                    $("#bysubjectfilter").find("#examnames").append('<option value="' + val.id + '" >' + val.name + '</option>');
                });
            }
        }, 'json');
    });
    $("#bysubjectfilter").validate({
        rules: {
            department_id: "required",
            year: "required",
            class_id: "required",
            section_id: "required",
            examnames: "required",
            report_type: "required"
        }
    });
    $('#bysubjectfilter').on('submit', function (e) {
        e.preventDefault();
        var byclass = $("#bysubjectfilter").valid();
        if (byclass === true) {
            var year = $("#btwyears").val();
            var department_id = $("#department_id").val();
            var semester_id = $("#semester_id").val();
            var session_id = $("#session_id").val();
            var class_id = $("#changeClassName").val();
            var section_id = $("#sectionID").val();
            var exam_id = $("#examnames").val();
            var report_type = $("#report_type").val();

            var classObj = {
                year: year,
                department_id: department_id,
                classID: class_id,
                sectionID: section_id,
                semesterID: semester_id,
                sessionID: session_id,
                examID: exam_id,
                academic_session_id: academic_session_id,
                report_type:report_type,
            };
            setLocalStorageForExamResultBySubject(classObj);

            // download set start
            $(".downExamID").val(exam_id);
            $(".downDepartmentID").val(department_id);			
            $(".downClassID").val(class_id);
            $(".downSemesterID").val(semester_id);
            $(".downSessionID").val(session_id);
            $(".downSectionID").val(section_id);
            $(".downAcademicYear").val(year);
            
            $(".downReport_type").val(report_type);
            // download set end

            var formData = new FormData();			
            formData.append('token', token);
            formData.append('branch_id', branchID);
            formData.append('department_id', department_id);
            formData.append('class_id', class_id);
            formData.append('section_id', section_id);
            formData.append('exam_id', exam_id);
            formData.append('semester_id', semester_id);
            formData.append('session_id', session_id);
            formData.append('academic_year', year);
            formData.append('report_type', report_type);
            // examResultBySubject(formData);
           
            var formData1 = {
                student_name: '',
                department_id: department_id,
                class_id: class_id,
                section_id: section_id,
                session_id: session_id
            };
            //getStudentList(formData1);
			 // $("#overlay").fadeOut(300);
             if(report_type=='english_communication')
                {
                    $("#byec_body").show("slow");
                    $("#byreport_body").hide("slow");                                       
                    $("#bypersonal_body").hide("slow");
                }
                else if(report_type=='report_card')
                {
                    $("#byec_body").hide("slow");
                    $("#byreport_body").show("slow");                                       
                    $("#bypersonal_body").hide("slow"); 
                }
                else
                {
                    $("#byec_body").hide("slow"); 
                    $("#byreport_body").hide("slow");                                      
                    $("#bypersonal_body").show("slow");
                    if(department_id=='2')
                    {
                        console.log('2');
                        $("#secondary_personal").show("slow");
                        $("#primary_personal").hide("slow"); 
                    }
                    else
                    {
                        console.log('all');
                        $("#student").hide("slow");
                        $("#secondary_personal").hide("slow");
                        $("#primary_personal").show("slow"); 
                    }
                }
        }
		else {
            $("#student").hide("slow");
        }
    });
    function setLocalStorageForExamResultBySubject(classObj) {

        var examResultBySubjectDetails = new Object();
        examResultBySubjectDetails.class_id = classObj.classID;
        examResultBySubjectDetails.section_id = classObj.sectionID;
        examResultBySubjectDetails.year = classObj.year;
        examResultBySubjectDetails.exam_id = classObj.examID;
        examResultBySubjectDetails.semester_id = classObj.semesterID;
        examResultBySubjectDetails.session_id = classObj.sessionID;
        examResultBySubjectDetails.department_id = classObj.department_id;
        examResultBySubjectDetails.report_type = classObj.report_type,
        // here to attached to avoid localStorage other users to add
        examResultBySubjectDetails.branch_id = branchID;
        examResultBySubjectDetails.role_id = get_roll_id;
        examResultBySubjectDetails.user_id = ref_user_id;
        var examResultBySubjectClassArr = [];
        examResultBySubjectClassArr.push(examResultBySubjectDetails);
        if (get_roll_id == "2") {
            // admin
            localStorage.removeItem("admin_exam_result_by_report_details");
            localStorage.setItem('admin_exam_result_by_report_details', JSON.stringify(examResultBySubjectClassArr));
        }
        return true;
    }
     // if localStorage
     if (typeof exam_result_by_report_storage !== 'undefined') {
        if ((exam_result_by_report_storage)) {
            if (exam_result_by_report_storage) {
                var examResultByReportStorage = JSON.parse(exam_result_by_report_storage);
                if (examResultByReportStorage.length == 1) {
                    var classID, year,sectionID,departmentID, examID, userType ,semesterID, sessionID, userBranchID, userRoleID, userID;
                    examResultByReportStorage.forEach(function (user) {
                        departmentID = user.department_id;
                        classID = user.class_id;
                        year = user.year;
                        sectionID = user.section_id;
                        examID = user.exam_id;
                        semesterID = user.semester_id;
                        sessionID = user.session_id;
                        userBranchID = user.branch_id;
                        userRoleID = user.role_id;
                        userID = user.user_id;
                        userType = user.report_type;
                    });
                    if ((userBranchID == branchID) && (userRoleID == get_roll_id) && (userID == ref_user_id)) {
                        //$('#changeClassName').val(classID);
                        $("#btwyears").val(year);
                        $('#report_type').val(report_type);
                        $('#session_id').val(sessionID);
                        $("#department_id").val(departmentID);
                        if(departmentID){
                            
                            $("#resultsByPaper").find("#changeClassName").empty();
                            $("#resultsByPaper").find("#changeClassName").append('<option value="">'+select_class+'</option>');
                            $.post(getGradeByDepartmentUrl, { token: token, branch_id: branchID, department_id: departmentID }, function (res) {
                                if (res.code == 200) {
                                    $.each(res.data, function (key, val) {
                                        $("#changeClassName").append('<option value="' + val.id + '">' + val.name + '</option>');
                                    });
                                    $("#changeClassName").val(classID);
                                }
                            }, 'json');
                        }
                        if (classID) {
                            $("#bysubjectfilter").find("#sectionID").empty();
                            $("#bysubjectfilter").find("#sectionID").append('<option value="">'+select_class+'</option>');
                            $.post(sectionByClass, { token: token, branch_id: branchID, class_id: classID, teacher_id: userID }, function (res) {
                                if (res.code == 200) {
                                    $("#section_drp_div").show();
                                    $.each(res.data, function (key, val) {
                                        $("#bysubjectfilter").find("#sectionID").append('<option value="' + val.section_id + '">' + val.section_name + '</option>');
                                    });
                                    $("#bysubjectfilter").find("#sectionID").val(sectionID);
                                }
                            }, 'json');
                        }
                        if(sectionID){
                            var today = new Date();
                            var dd = String(today.getDate()).padStart(2, '0');
                            var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
                            var yyyy = today.getFullYear();
                    
                            today = yyyy + '/' + mm + '/' + dd;
                            $("#bysubjectfilter").find("#examnames").empty();
                            $("#bysubjectfilter").find("#examnames").append('<option value="">'+select_exam+'</option>');
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
                                        $("#bysubjectfilter").find("#examnames").append('<option value="' + val.id + '" >' + val.name + '</option>');
                                    });
                                    $("#bysubjectfilter").find("#examnames").val(examID);
                                }
                            }, 'json');
                        }
                        
                        // download set start
                        $("#downExamID").val(examID);
                        $("#downClassID").val(classID);
                        $("#semester_id").val(semesterID);
                        $("#downSessionID").val(sessionID);
                        $("#downSectionID").val(sectionID);
                        $("#downAcademicYear").val(year);
                        $("#report_type").val(userType);
                    
                    }
                }
            }
        }
    }

    // find matched
        function isKey(key, obj) {
            var keys = Object.keys(obj).map(function (x) {
                return x;
            });
            return keys.indexOf(key) !== -1;
        }

    
});