$(function () {

    $("#department_id").on('change', function (e) {
        e.preventDefault();
        var Selector = '#resultsByPaper';
        var department_id = $(this).val();
        var classID = "";
        classAllocation(department_id, Selector, classID);
    });
    function classAllocation(department_id, Selector, classID) {
        $(Selector).find('select[name="class_id"]').empty();
        $(Selector).find('select[name="class_id"]').append('<option value="">' + select_grade + '</option>');
        $("#resultsByPaper").find("#sectionID").empty();
        $("#resultsByPaper").find("#sectionID").append('<option value="">'+select_class+'</option>');
        $("#resultsByPaper").find("#examnames").empty();
        $("#resultsByPaper").find("#examnames").append('<option value="">'+select_exam+'</option>');
        $("#resultsByPaper").find("#subjectID").empty();
        $("#resultsByPaper").find("#subjectID").append('<option value="">'+select_subject+'</option>');
        $("#resultsByPaper").find("#paperID").empty();
        $("#resultsByPaper").find("#paperID").append('<option value="">'+select_paper+'</option>');
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
        $("#resultsByPaper").find("#paperID").empty();
        $("#resultsByPaper").find("#paperID").append('<option value="">'+select_paper+'</option>');
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
        $("#resultsByPaper").find("#paperID").empty();
        $("#resultsByPaper").find("#paperID").append('<option value="">'+select_paper+'</option>');
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
        $("#resultsByPaper").find("#paperID").empty();
        $("#resultsByPaper").find("#paperID").append('<option value="">'+select_paper+'</option>');
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
    $('#subjectID').on('change', function () {
        var subject_id = $(this).val();
        var section_id = $("#sectionID").val();
        var class_id = $("#changeClassName").val();
        var exam_id = $("#examnames").val();
        $("#resultsByPaper").find("#paperID").empty();
        $("#resultsByPaper").find("#paperID").append('<option value="">'+select_paper+'</option>');
        // $("#resultsByPaper").find("#paperID").append('<option value="All">'+all+'</option>');
        // paper list
        $.post(subjectByPapers, {
            token: token,
            branch_id: branchID,
            class_id: class_id,
            section_id: section_id,
            subject_id: subject_id,
            academic_session_id: academic_session_id,
            exam_id: exam_id
        }, function (res) {
            if (res.code == 200) {
                $.each(res.data, function (key, val) {
                    $("#resultsByPaper").find("#paperID").append('<option value="' + val.paper_id + '" data-grade_category="' + val.grade_category + '" style="color:green">' + val.paper_name + '</option>');
                });
            }
        }, 'json');
    });
    /*$('#paperID').on('change', function () {
        var paper_id = $(this).val();
        $.post(ExamPaperDetails, {
            token: token,
            branch_id: branchID,
            id: paper_id
        }, function (res) {
            if (res.code == 200) {
                
                if(res.data.score_type=='Grade' || res.data.score_type=='Mark' )
                {
                    
                    $("#downmark").show();
                    $("#downpoints").hide();
                    $("#downfreetext").hide();
                    $("#Marktype").html('<span style="color:green;">'+marktext+'</span>'); 
                }
                else if(res.data.score_type=='Points')
                {
                    $("#downmark").hide();
                    $("#downpoints").show();
                    $("#downfreetext").hide();
                    $("#Marktype").html('<span style="color:green;">'+pointstext+'</span>'); 
                }
                else if(res.data.score_type=='Freetext')
                {
                    
                    $("#downmark").hide();
                    $("#downpoints").hide();
                    $("#downfreetext").show();
                    $("#Marktype").html('<span style="color:green;">'+freetext+'</span>'); 
                }
                else
                {
                    $("#downmark").hide();
                    $("#downpoints").hide();
                    $("#downfreetext").hide();
                    $("#Marktype").html('<span style="color:red;">'+infotext+'</span>'); 
                }
                
            }
        }, 'json');
    });*/
	/*$(document).ready(function(){
    $('#resultsByPaper').on('submit', function(e){
        e.preventDefault();
        
            this.submit();
        
    });
	});*/
    // by paper result
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
      });
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
    if ($('#parent-table').length) {
        $("#resultsByPaper").validate({
            rules: {
                department_id: "required",
                class_id: "required",
                section_id: "required",
                subject_id: "required",
                exam_id: "required"
            }
        });
    }
    $(document).ready(function(){
    $("#resultsByPaper").validate({
        rules: {
            department_id: "required",
            class_id: "required",
            section_id: "required",
            subject_id: "required",
            paper_id: "required",
            semester_id: "required"
        }
    });
    $('#resultsByPaper').on('submit', function (e) {
        e.preventDefault();
        var classRoom = $("#resultsByPaper").valid();
        if (classRoom === true) {
            //   $("#overlay").fadeIn(300);
            // jQuery("body").prepend('<div id="preloader">Loading...</div>');
            var departmentID = $("#department_id").val();
            var classID = $("#changeClassName").val();
            var sectionID = $("#sectionID").val();
            var subjectID = $("#subjectID").val();
            var paperID = $("#paperID").val();
            var examID = $("#examnames").val();
            var semesterID = $("#semester_id").val();

            var classObj = {
                classID: classID,
                sectionID: sectionID,
                subjectID: subjectID,
                departmentID: departmentID,
                semesterID: semesterID,
                exam_id: examID,
                paperID: paperID,
                role_id: get_roll_id,
                user_id: ref_user_id,
                branch_id: branchID,
                academic_session_id: academic_session_id,
            };
            // set local storage selected
            setLocalStorageForClassroom(classObj);
        }
    });
    function setLocalStorageForClassroom(classObj) {
        var teacherClassDetails = new Object();
        teacherClassDetails.class_id = classObj.classID;
        teacherClassDetails.section_id = classObj.sectionID;
        teacherClassDetails.subject_id = classObj.subjectID;
        teacherClassDetails.department_id = classObj.departmentID;
        teacherClassDetails.semester_id = classObj.semesterID;
        teacherClassDetails.paper_id = classObj.paperID;
        teacherClassDetails.role_id = classObj.role_id;
        teacherClassDetails.user_id = classObj.user_id;
        teacherClassDetails.branch_id = classObj.branch_id;
        teacherClassDetails.exam_id = classObj.exam_id;
        teacherClassDetails.academic_session_id = classObj.academic_session_id,
        
        // here to attached to avoid localStorage other users to add
        teacherClassDetails.branch_id = branchID;
        var teacherClassroomArr = [];
        teacherClassroomArr.push(teacherClassDetails);
        if (get_roll_id == "2") {
            // admin
            localStorage.removeItem("admin_exam_import_details");
            localStorage.setItem('admin_exam_import_details', JSON.stringify(teacherClassroomArr));
        }
        return true;
    }
    if (typeof exam_import_result_storage !== 'undefined') {
        console.log(exam_import_result_storage);
        if ((exam_import_result_storage)) {
            if (exam_import_result_storage) {
                var examImportResultStorage = JSON.parse(exam_import_result_storage);
                if (examImportResultStorage.length == 1) {
                    var classID, sectionID, subjectID,departmentID, academicSessionID, examID, semesterID, sessionID,paperID, userBranchID, userRoleID, userID;
                    examImportResultStorage.forEach(function (user) {
                        departmentID = user.department_id;
                        classID = user.class_id;
                        sectionID = user.section_id;
                        subjectID = user.subject_id;
                        examID = user.exam_id;
                        semesterID = user.semester_id;
                        sessionID = user.session_id;
                        userBranchID = user.branch_id;
                        userRoleID = user.role_id;
                        userID = user.user_id;
                        paperID = user.paper_id;
                        academicSessionID = user.academic_session_id;
                      
                    });
                    if ((userBranchID == branchID) && (userRoleID == get_roll_id) && (userID == ref_user_id)) {
                        // $('#changeClassName').val(classID);
                        // $('#semester_id').val(semesterID);
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
                                academic_session_id: academicSessionID,
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
                                academic_session_id: academicSessionID,
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
                        if(paperID){
                            $("#resultsByPaper").find("#paperID").empty();
                            $("#resultsByPaper").find("#paperID").append('<option value="">'+select_paper+'</option>');
                            // $("#resultsByPaper").find("#paperID").append('<option value="All">'+all+'</option>');
                            // paper list
                            $.post(subjectByPapers, {
                                token: token,
                                branch_id: branchID,
                                class_id: classID,
                                section_id: sectionID,
                                subject_id: subjectID,
                                academic_session_id: academicSessionID,
                                exam_id: examID
                            }, function (res) {
                                if (res.code == 200) {
                                    $.each(res.data, function (key, val) {
                                        $("#resultsByPaper").find("#paperID").append('<option value="' + val.paper_id + '" data-grade_category="' + val.grade_category + '" style="color:green">' + val.paper_name + '</option>');
                                    });
                                    $("#resultsByPaper").find("#paperID").val(paperID);
                                }
                            }, 'json');

                        }

                        // download set start
                        // $("#downExamID").val(examID);
                        // $("#downClassID").val(classID);
                        // $("#downSectionID").val(sectionID);
                        // $("#downSemesterID").val(semesterID);
                        // $("#downSessionID").val(sessionID);
                        // $("#downSubjectID").val(subjectID);
                        // $("#downAcademicYear").val(academicSessionID);
                        // download set end
                        // var formData = new FormData();
                        // formData.append('token', token);
                        // formData.append('branch_id', branchID);
                        // formData.append('class_id', classID);
                        // formData.append('section_id', sectionID);
                        // formData.append('subject_id', subjectID);
                        // formData.append('exam_id', examID);
                        // formData.append('semester_id', semesterID);
                        // formData.append('session_id', sessionID);
                        // formData.append('academic_session_id', academicSessionID);
                        // $("#overlay").fadeIn(300);
                        // examPaperResult(formData);
                    }
                }
            }
        }
    }
    $(document).ready(function(){
        $('#fileInput').change(function(){
            var fileName = $(this).val().split('\\').pop();		
            
                //$('#submitbtn').removeAttr("type").attr("type", "submit");	
                $('#submitbtn').show();	
                
                   $('#resultsByPaper').attr('action', newRoute);	
                $('#downloadexcel1').hide();	   		
            
        });
    });
    $(document).on('click', '#savestudentmarks', function (e) {
        e.preventDefault(); // Prevent the default form submission
       
        // Get values from form fields
        var department_id = $("#department_id").val();
        var class_id = $("#changeClassName").val();
        var section_id = $("#sectionID").val();
        var exam_id = $("#examnames").val();
        var subject_id = $("#subjectID").val();
        var paper_id = $("#paperID").val();
        var semester_id = $("#semester_id").val();
        var session_id = $("#session_id").val();
        
        
            var formData = new FormData();
            formData.append('token', token);
            formData.append('branch_id', branchID);
            formData.append('department_id', department_id);
            formData.append('class_id', class_id);
            formData.append('section_id', section_id);
            formData.append('subject_id', subject_id);
            formData.append('exam_id', exam_id);
            formData.append('paper_id', paper_id);
            formData.append('semester_id', semester_id);
            formData.append('session_id', session_id);
            formData.append('file', $('input[type=file]')[0].files[0]);
            formData.append('academic_session_id', academic_session_id);
            //$("#overlay").fadeIn(300);
            $.ajax({
                url: savemarks,
                method: "post",
                data: formData,
                processData: false,
                dataType: 'json',
                contentType: false,
                Accept: 'application/json',
                success: function (data) {
                    if(data.result=='success')
                    {
                        $('#markModal').modal('hide');
                        toastr.success(data.message);
                        setTimeout(function() {
                            window.location.href = window.location;
                        }, 3000);
                    }
                    else

                    {
                        toastr.error(data.message);
                    }
                }
            });
        });
    $(document).on('click', '#submitbtn', function (e) {
        e.preventDefault(); // Prevent the default form submission
        $('#exammark_preview').hide();
        // Get values from form fields
        var department_id = $("#department_id").val();
        var class_id = $("#changeClassName").val();
        var section_id = $("#sectionID").val();
        var exam_id = $("#examnames").val();
        var subject_id = $("#subjectID").val();
        var paper_id = $("#paperID").val();
        var semester_id = $("#semester_id").val();
        var session_id = $("#session_id").val();
        
        // Validate the form
        var isValid = $("#resultsByPaper").valid();
        var marklist=0;
        // Check if the form is valid
        if (isValid) {
            var formData = new FormData();
            formData.append('token', token);
            formData.append('branch_id', branchID);
            formData.append('department_id', department_id);
            formData.append('class_id', class_id);
            formData.append('section_id', section_id);
            formData.append('subject_id', subject_id);
            formData.append('exam_id', exam_id);
            formData.append('paper_id', paper_id);
            formData.append('semester_id', semester_id);
            formData.append('session_id', session_id);
            formData.append('file', $('input[type=file]')[0].files[0]);
            formData.append('academic_session_id', academic_session_id);
            //$("#overlay").fadeIn(300);
            $.ajax({
                url: newRoute,
                method: "post",
                data: formData,
                processData: false,
                dataType: 'json',
                contentType: false,
                Accept: 'application/json',
                success: function (data) {
                    if(data.result=='error')
                    {
                        toastr.error(data.message);
                    }
                    if(data.result=='Success')
                    {
                        $('#exammark_preview').show();
                        appendDataToTable(data.studentlist,data.headerdata);
                        $.each(data.headerdata, function(index, item) {
                            if(item=='Wrong')
                            {
                                marklist++;
                            }                        
                        });
                        if(marklist==0)
                        {
                            toastr.success(data.message);
                            $('.studentmark').show();
                            appendDataToTablemark(data.studentmarks,data.studentlist);
                            
                        }
                        else
                        {
                            $('.studentmark').hide();
                            toastr.error("Check Your Excel datas");
                        }
                        
                    }
                }
            });
        }
    });
    function appendDataToTable(data1,data2) {
        var headerdata1 = $("#headerdata1");
        // Clear existing table rows
        headerdata1.empty();
        // Loop through data and append rows to table
       
        $.each(data1, function(index, item) {
            if(index<8)
                {
                var btncolor= (data2[index] =='Matched')?'success':'danger';
                var row = "<tr ><td>" + item[0] + "</td><td>" + item[1] + "</td><td class='btn btn-" + btncolor + "'>" + data2[index] + "</td></tr>";
                headerdata1.append(row);
                }
          
        });
        
    }
    function appendDataToTablemark(data1,data2) {
        var markdatas = $("#markdatas");
        // Clear existing table rows
        markdatas.empty();
        // Loop through data and append rows to table
        var misdata=0;
        $.each(data1, function(index, item) {
            if(item!='')
            {
                var btncolor= (item['oldmark']['mark_id'] !='')?'warning':'success';
                if(data2[7][1]=='Points')
                {
                    var markbtn=(item['oldmark']['points'] !='' && item['oldmark']['points']!=item[3])?'danger':'success';
                    var markmsg=(item['oldmark']['points'] !='')?'Previous Data : '+item['oldmark']['points'] :'New Data';
                    if(item['oldmark']['point_grade']=='')
                    {
                        misdata++;
                        var markmsg='Wrong Data';
                        var markbtn='danger';
                    }

                }
                else if(data2[7][1]=='Freetext')
                {
                    var markbtn=(item['oldmark']['freetext'] !='' && item['oldmark']['freetext']!=item[3])?'danger':'success';
                    var markmsg=(item['oldmark']['freetext'] !='')?'Previous Data : '+item['oldmark']['freetext'] :'New Data';
                    
                }
                else
                {
                    var markbtn=(item['oldmark']['score'] !='' && item['oldmark']['score']!=item[3])?'danger':'success';
                    var markmsg=(item['oldmark']['score'] !='')?'Previous Data : '+item['oldmark']['score'] :'New Data';
                    
                }
                var statusToLower = item[4].toLowerCase();
                var mark=(statusToLower=='a')?'0':((item[4]!='')?item[3]:'');
                var memobtn=(item['oldmark']['memo'] !='' && item['oldmark']['memo']!=item[5])?'danger':'success';
                var memomsg=(item['oldmark']['memo'] !='')?'Previous Data : '+item['oldmark']['memo'] :'New Data';
                var attbtn=(item['oldmark']['status'] !='' && item['oldmark']['status'][0]!=statusToLower)?'danger':'success';
                var attmsg=(item['oldmark']['status'] !='')?'Previous Data : '+item['oldmark']['status'] :'New Data';
                var row = "<tr><td>" + item[0] + "</td><td class='btn btn-" + btncolor + "'>" + item[1] + "</td><td>" + item[2] + "</td><td class='text-" + markbtn + "' title='" + markmsg + "'>" + mark + "</td><td class='text-" + attbtn + "'  title='" + attmsg + "' >" + item[4] + "</td><td class='text-" + memobtn + "' title='" + memomsg + "' >" + item[5] + "</td></tr>";
                //var row = "<tr><td>" + item[0] + "</td><td class='btn btn-" + btncolor + "'>" + item[1] + "</td><td>" + item[2] + "</td><td class='text-" + markbtn + "' title='" + markmsg + "' data-toggle='tooltip' aria-haspopup='false' aria-expanded='false' data-original-title='" + markmsg + "'>" + mark + "</td><td class='text-" + attbtn + "' data-toggle='tooltip' title='" + attmsg + "' aria-haspopup='false' aria-expanded='false' data-original-title='" + attmsg + "'>" + item[4] + "</td><td class='text-" + memobtn + "' data-toggle='tooltip' title='" + memomsg + "' aria-haspopup='false' aria-expanded='false' data-original-title='" + memomsg + "'>" + item[5] + "</td></tr>";
                markdatas.append(row);
            }            
        
        });
        alert(misdata);
        if(misdata==0)
            {
                $('#save_modelbtn').show();
            }
            else
            {
                $('#save_modelbtn').hide();
            }
        
    }
      
});
});