
$(function () {

    $(".homeWorkAdd").datepicker({
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
        autoclose: true,
        yearRange: "-100:+50", // last hundred years
    });

    $("#evaluationFilterForm").validate({
        rules: {
            class_id:"required",
            section_id:"required",
            subject_id:"required"
        }
    });
    // get timetable
    $('#evaluationFilterForm').on('submit', function (e) {
        e.preventDefault();
        var filterCheck = $("#evaluationFilterForm").valid();
        if (filterCheck === true) {
            var classID = $("#class_id").val();
            var sectionID = $("#section_id").val();
            var subjectID = $("#subject_id").val();
            var semester_id = $("#semester_id").val();
            var session_id = $("#session_id").val();

            var classObj = {
                classID: classID,
                sectionID: sectionID,
                subjectID: subjectID,
                semesterID: semester_id,
                sessionID: session_id,
                academic_session_id: academic_session_id,
                userID: userID,
            };

            setLocalStorageForEvaluationReport(classObj);
            var formData = new FormData(this);
            evaluationReportList(formData);
        }
    });
    function evaluationReportList(formData){
        $.ajax({
            url: getEvaluationReport,
            method: "Post",
            data: formData,
            processData: false,
            dataType: 'json',
            contentType: false,
            success: function (data) {
                console.log('cs',data)
                if (data.code == 200) {
                    $("#evaluation").show("slow");
                    $("#homework_table").html(data.table);
                } else {
                    $("#evaluation").hide("slow");
                    toastr.error(data.message);
                }
            }
        });
    }
    
    function setLocalStorageForEvaluationReport(classObj) {

        var evaluationReportDetails = new Object();
        evaluationReportDetails.class_id = classObj.classID;
        evaluationReportDetails.section_id = classObj.sectionID;
        evaluationReportDetails.subject_id = classObj.subjectID;
        evaluationReportDetails.semester_id = classObj.semesterID;
        evaluationReportDetails.session_id = classObj.sessionID;
        // here to attached to avoid localStorage other users to add
        evaluationReportDetails.branch_id = branchID;
        evaluationReportDetails.role_id = get_roll_id;
        evaluationReportDetails.user_id = ref_user_id;
        var evaluationReportClassArr = [];
        evaluationReportClassArr.push(evaluationReportDetails);
        if (get_roll_id == "4") {
            // teacher
            localStorage.removeItem("teacher_evaluation_report_details");
            localStorage.setItem('teacher_evaluation_report_details', JSON.stringify(evaluationReportClassArr));
        }
        return true;
    }
    // if localStorage
    if (typeof teacher_evaluation_report_storage !== 'undefined') {
        if ((teacher_evaluation_report_storage)) {
            if (teacher_evaluation_report_storage) {
                var teacherEvaluationReportStorage = JSON.parse(teacher_evaluation_report_storage);
                if (teacherEvaluationReportStorage.length == 1) {
                    var classID, sectionID, subjectID, semesterID, sessionID, userBranchID, userRoleID, userID;
                    teacherEvaluationReportStorage.forEach(function (user) {
                        classID = user.class_id;
                        sectionID = user.section_id;
                        subjectID = user.subject_id;
                        semesterID = user.semester_id;
                        sessionID = user.session_id;
                        userBranchID = user.branch_id;
                        userRoleID = user.role_id;
                        userID = user.user_id;
                    });
                    if ((userBranchID == branchID) && (userRoleID == get_roll_id) && (userID == ref_user_id)) {
                        $('#class_id').val(classID);
                        $('#semester_id').val(semesterID);
                        $('#session_id').val(sessionID);
                        if (classID) {
                            
                            $("#section_id").empty();
                            $("#section_id").append('<option value="">'+select_class+'</option>');
                            $.post(sectionByClass, { class_id: classID }, function (res) {
                                if (res.code == 200) {
                                    $.each(res.data, function (key, val) {
                                        $("#section_id").append('<option value="' + val.section_id + '">' + val.section_name + '</option>');
                                    });
                                    $('#section_id').val(sectionID);
                                }
                            }, 'json');
                        }
                        if(sectionID){
                            $("#subject_id").empty();
                            $("#subject_id").append('<option value="">'+select_subject+'</option>');
                            $.post(subjectByClass, { class_id: classID, section_id: sectionID }, function (res) {
                                console.log('data',res)
                                if (res.code == 200) {
                                    $.each(res.data, function (key, val) {
                                        $("#subject_id").append('<option value="' + val.subject_id + '">' + val.subject_name + '</option>');
                                    });
                                    $('#subject_id').val(subjectID);
                                }
                            }, 'json');
                        }

                        var formData = new FormData();
                        formData.append('token', token);
                        formData.append('branch_id', branchID);
                        formData.append('class_id', classID);
                        formData.append('section_id', sectionID);
                        formData.append('subject_id', subjectID);
                        formData.append('semester_id', semesterID);
                        formData.append('session_id', sessionID);
                        formData.append('academic_session_id', academic_session_id);
                        // evealuation report
                        evaluationReportList(formData);
                    }
                }
            }
        }
    }
    $('#homework_file').change(function() {
        // var i = $(this).prev('label').clone();
        var file = $('#homework_file')[0].files[0];
        // var size = $('#homework_file')[0].files[0].size;
        if(file.size > 2097152) {
            $('#file_name').text("File greater than 2Mb");
            $("#file_name").addClass("error");
            $('#homework_file').val('');
        } else {
            $("#file_name").removeClass("error");
            $('#file_name').text(file.name);
        }
    });

    // $(document).on('change', '.student_homework_file', function () {
    //     // var i = $(this).prev('label').clone();
    //     var file = $(this)[0].files[0];
    //     // var size = $('#homework_file')[0].files[0].size;
    //     if(file.size > 2097152) {
    //         $(this).parent().text("File greater than 2Mb");
    //         $(this).parent().addClass("error");
    //         $('#homework_file').val('');
    //     } else {
    //         $(this).parent().removeClass("error");
    //         $(this).parent().text(file.name);
    //     }
    // });

    
    $(document).on('change', '.homework_file', function () {
        console.log(12343333)
        var file = $(this)[0].files[0];
        if(file.size > 2097152) {
            toastr.error("File greater than 2Mb");
            $(this).val('');
        }
    });
    
    $('#studentHomeworkFilter').on('submit', function (e) {
        e.preventDefault();
        var form = this;
        var formstatus=$('input[name="status"]:checked').val();
        
        var formsubject=$('#subject').val();
        $.ajax({
            url: $(form).attr('action'),
            method: $(form).attr('method'),
            data: new FormData(form),
            processData: false,
            dataType: 'json',
            contentType: false,
            success: function (data) {
                console.log('cs',data)
                if (data.code == 200) {
                    $("#homeworks").show("slow");
                    if(data.subject!="All")
                    {
                        var sub = homework_list_lang+' ('+data.subject+')';
                        
                    }else{
                        var sub = homework_list_lang+' ('+all_subject_lang+')';
                    }
                    $("#title").html(sub);
                    $("#homework_list").html(data.list);
                } else {
                    $("#homeworks").hide("slow");
                    toastr.error(data.message);
                }
            }
        });
        var classObj = {
            formstatus: formstatus,
            formsubject: formsubject,
            academic_session_id: academic_session_id
        };
       // console.log(academic_session_id);
        setLocalStorageForparenthomework(classObj);
    });

    function setLocalStorageForparenthomework(classObj) {

        var homeworkDetails = new Object();
        homeworkDetails.status = classObj.formstatus;
        homeworkDetails.subject = classObj.formsubject;
        // here to attached to avoid localStorage other users to add
        homeworkDetails.branch_id = branchID;
        homeworkDetails.role_id = get_roll_id;
        homeworkDetails.user_id = ref_user_id;
        var homeworkClassArr = [];
        homeworkClassArr.push(homeworkDetails);
        if (get_roll_id == "5") {
            // Parent
            localStorage.removeItem("parent_homework_details");
            localStorage.setItem('parent_homework_details', JSON.stringify(homeworkClassArr));
        }
        if (get_roll_id == "6") {
            // Parent
            localStorage.removeItem("student_homework_details");
            localStorage.setItem('student_homework_details', JSON.stringify(homeworkClassArr));
        }
       
        return true;
    }

    

    // evaluate Homework
    $('#evaluateHomework').on('submit', function (e) {
        e.preventDefault();
        var form = this;
        $.ajax({
            url: $(form).attr('action'),
            method: $(form).attr('method'),
            data: new FormData(form),
            processData: false,
            dataType: 'json',
            contentType: false,
            success: function (data) {
                    console.log('data',data)
                if (data.code == 200) {
                    $('.firstModal').modal('hide');
                    toastr.success(data.message);
                } else {
                    toastr.error(data.message);
                }
            }
        });
    });

     // rules validation
     $("#addHomeworkForm").validate({
        rules: {
            title: "required",
            class_id: "required",
            section_id: "required",
            subject_id: "required",
            date_of_homework: "required",
            date_of_submission: "required",
            description: "required",
            file: "required",
            schedule_date: {
                required: {
                    publish_later: true
                }
            },
        }
    });

    // add Homework
    $('#addHomeworkForm').on('submit', function (e) {
        e.preventDefault();
        var homeworkCheck = $("#addHomeworkForm").valid();
        if (homeworkCheck === true) {
            var classID = $("#class_id").val();
            var sectionID = $("#section_id").val();
            var subjectID = $("#subject_id").val();
            var semester_id = $("#semester_id").val();
            var session_id = $("#session_id").val();

            var classObj = {
                classID: classID,
                sectionID: sectionID,
                subjectID: subjectID,
                semesterID: semester_id,
                sessionID: session_id,
                academic_session_id: academic_session_id,
                userID: userID,
            };

            setLocalStorageForAddHomework(classObj);
            var form = this;
            $.ajax({
                url: $(form).attr('action'),
                method: $(form).attr('method'),
                data: new FormData(form),
                processData: false,
                dataType: 'json',
                contentType: false,
                success: function (data) {
                        // console.log('data',200)
                    if (data.code == 200) {
                        $('.addHomeworkForm').find('form')[0].reset();
                        toastr.success(data.message);
                        window.location.href = homeworkList;
                    } else {
                        toastr.error(data.message);
                    }
                }
            });
        }
    });
    
    function setLocalStorageForAddHomework(classObj) {

        var addHomeworkDetails = new Object();
        addHomeworkDetails.class_id = classObj.classID;
        addHomeworkDetails.section_id = classObj.sectionID;
        addHomeworkDetails.subject_id = classObj.subjectID;
        addHomeworkDetails.semester_id = classObj.semesterID;
        addHomeworkDetails.session_id = classObj.sessionID;
        // here to attached to avoid localStorage other users to add
        addHomeworkDetails.branch_id = branchID;
        addHomeworkDetails.role_id = get_roll_id;
        addHomeworkDetails.user_id = ref_user_id;
        var addHomeworkClassArr = [];
        addHomeworkClassArr.push(addHomeworkDetails);
        if (get_roll_id == "4") {
            // teacher
            localStorage.removeItem("teacher_add_homework_details");
            localStorage.setItem('teacher_add_homework_details', JSON.stringify(addHomeworkClassArr));
        }
        return true;
    }
    // if localStorage
    if (typeof teacher_add_homework_storage !== 'undefined') {
        if ((teacher_add_homework_storage)) {
            if (teacher_add_homework_storage) {
                var teacherAddHomeworkStorage = JSON.parse(teacher_add_homework_storage);
                if (teacherAddHomeworkStorage.length == 1) {
                    var classID, sectionID, subjectID, semesterID, sessionID, userBranchID, userRoleID, userID;
                    teacherAddHomeworkStorage.forEach(function (user) {
                        classID = user.class_id;
                        sectionID = user.section_id;
                        subjectID = user.subject_id;
                        semesterID = user.semester_id;
                        sessionID = user.session_id;
                        userBranchID = user.branch_id;
                        userRoleID = user.role_id;
                        userID = user.user_id;
                    });
                    if ((userBranchID == branchID) && (userRoleID == get_roll_id) && (userID == ref_user_id)) {
                        $('#class_id').val(classID);
                        $('#semester_id').val(semesterID);
                        $('#session_id').val(sessionID);
                        if (classID) {
                            
                            $("#section_id").empty();
                            $("#section_id").append('<option value="">'+select_class+'</option>');
                            $.post(sectionByClass, { class_id: classID }, function (res) {
                                if (res.code == 200) {
                                    $.each(res.data, function (key, val) {
                                        $("#section_id").append('<option value="' + val.section_id + '">' + val.section_name + '</option>');
                                    });
                                    $('#section_id').val(sectionID);
                                }
                            }, 'json');
                        }
                        if(sectionID){
                            $("#subject_id").empty();
                            $("#subject_id").append('<option value="">'+select_subject+'</option>');
                            $.post(subjectByClass, { class_id: classID, section_id: sectionID }, function (res) {
                                console.log('data',res)
                                if (res.code == 200) {
                                    $.each(res.data, function (key, val) {
                                        $("#subject_id").append('<option value="' + val.subject_id + '">' + val.subject_name + '</option>');
                                    });
                                    $('#subject_id').val(subjectID);
                                }
                            }, 'json');
                        }
                    }
                }
            }
        }
    }


    // publish later
    $("#publish_later").on("change", function () {
        // alert($(this).is(":checked"));
        if ($(this).is(":checked")) {
            $("#schedule").show("slow");
        } else {
            $("#schedule").hide("slow");
        }
    });
    function formvalidate(formid){
        $("#"+formid).validate({
            rules: {
                file: "required",
                remarks: "required",
            }
        });
    }
    

    $(document).on('submit','.submitHomeworkForm', function (e) {
        e.preventDefault();
        var formid = $(this).attr("id")
        formvalidate(formid)
        var homeWork = $("#"+formid).valid();
        if (homeWork === true) {
            var form = this;
            $.ajax({
                url: $(form).attr('action'),
                method: $(form).attr('method'),
                data: new FormData(form),
                processData: false,
                dataType: 'json',
                contentType: false,
                success: function (data) {
                        console.log('data',200)
                    if (data.code == 200) {
                        toastr.success(data.message);
                        window.location.href = homeworkList;
                    } else {
                        toastr.error(data.message);
                    }
                }
            });
        }
    });


    $("#class_id").on('change', function (e) {
        e.preventDefault();
        var class_id = $(this).val();
        
        $("#section_id").empty();
        $("#section_id").append('<option value="">'+select_class+'</option>');
        
        $("#subject_id").empty();
        $("#subject_id").append('<option value="">'+select_subject+'</option>');
        $.post(sectionByClass, { class_id: class_id }, function (res) {
            if (res.code == 200) {
                $.each(res.data, function (key, val) {
                    $("#section_id").append('<option value="' + val.section_id + '">' + val.section_name + '</option>');
                });
            }
        }, 'json');
    });

    $("#section_id").on('change', function (e) {
        e.preventDefault();
        var section_id = $(this).val();
        var class_id = $("#class_id").val();
        
        $("#subject_id").empty();
        $("#subject_id").append('<option value="">'+select_subject+'</option>');
        $.post(subjectByClass, { class_id: class_id, section_id: section_id }, function (res) {
            console.log('data',res)
            if (res.code == 200) {
                $.each(res.data, function (key, val) {
                    $("#subject_id").append('<option value="' + val.subject_id + '">' + val.subject_name + '</option>');
                });
            }
        }, 'json');
    });

    
    $('#evaluation_check').on('change', function (e) {
        e.preventDefault();
        var homework_id = $("#homework_id").val();
        var evaluation = $("#evaluation_check").val();

        var formData = new FormData(); 
        formData.append('homework_id', homework_id);
        formData.append('evaluation', evaluation);
        $.ajax({
            url: homeworkView,
            method: "post",
            data: formData,
            processData: false,
            dataType: 'json',
            contentType: false,
            success: function (res) {
                console.log('cs',res)
                if (res.code == 200) {
                    $("#homework_modal_table").html(res.table);
                    var complete = res.complete;
                    var incomplete = res.incomplete;
                    var checked = res.checked;
                    var unchecked = res.unchecked;
    
                    callchart(complete,incomplete,checked,unchecked);
                    homeworkchart.updateSeries([complete,incomplete]);
                    homeworkevaluationchart.updateSeries([checked,unchecked]);
                    
                }
            }
        });
    });

    $('.firstModal').on('shown.bs.modal', e => {
        var $button = $(e.relatedTarget);
        var homework_id = $button.attr('data-homework_id');
        var semester_id = $("#semester_id").val();
        var session_id = $("#session_id").val();
        $("#homework_id").val(homework_id);
        $.post(homeworkView, { homework_id: homework_id,semester_id: semester_id,session_id: session_id }, function (res) {
            if (res.code == 200) {
                $("#homework_modal_table").html(res.table);
                var complete = res.complete;
                var incomplete = res.incomplete;
                var checked = res.checked;
                var unchecked = res.unchecked;

                callchart(complete,incomplete,checked,unchecked);
                homeworkchart.updateSeries([complete,incomplete]);
                homeworkevaluationchart.updateSeries([checked,unchecked]);
                
            }
        }, 'json');
    }).on('hidden.bs.modal', function (event) {

    });


    function callchart(complete,incomplete,checked,unchecked){

        colors = ["#00b19d", "#f1556c"];
        (dataColors = $("#homework-status").data("colors")) && (colors = dataColors.split(","));
        options = {
            chart: {
                height: 320,
                type: "donut"
            },
            series: [complete,incomplete],
            legend: {
                show: !0,
                position: "bottom",
                horizontalAlign: "center",
                verticalAlign: "middle",
                floating: !1,
                fontSize: "14px",
                offsetX: 0,
                offsetY: 7
            },
            labels: [ complete_lang,incomplete_lang],
            colors: colors,
            responsive: [{
                breakpoint: 600,
                options: {
                    chart: {
                        height: 240
                    },
                    legend: {
                        show: !1
                    }
                }
            }],
            fill: {
                type: "gradient"
            }
        };
        
        homeworkchart = new ApexCharts(document.querySelector("#homework-status"), options);
        homeworkchart.render();

        colors = ["#775DD0", "#FEB019"];
        (dataColors = $("#homework-checked-status").data("colors")) && (colors = dataColors.split(","));
        options = {
            chart: {
                height: 320,
                type: "donut"
            },
            series: [checked,unchecked],
            legend: {
                show: !0,
                position: "bottom",
                horizontalAlign: "center",
                verticalAlign: "middle",
                floating: !1,
                fontSize: "14px",
                offsetX: 0,
                offsetY: 7
            },
            labels: [ checked_lang, unchecked_lang],
            colors: colors,
            responsive: [{
                breakpoint: 600,
                options: {
                    chart: {
                        height: 240
                    },
                    legend: {
                        show: !1
                    }
                }
            }],
            fill: {
                type: "gradient"
            }
        };
        homeworkevaluationchart = new ApexCharts(document.querySelector("#homework-checked-status"), options);
        homeworkevaluationchart.render();
        
    }
    if (get_roll_id == "5") {
    if ((parent_homework_storage)) {
        if (parent_homework_storage) {
            var parenthomeworkStorage = JSON.parse(parent_homework_storage);
            if (parenthomeworkStorage.length == 1) {
                var status, subject, userBranchID, userRoleID, userID;
                parenthomeworkStorage.forEach(function (user) {
                    status = user.status;
                    subject = user.subject;
                    userBranchID = user.branch_id;
                    userRoleID = user.role_id;
                    userID = user.user_id;
                });
                if ((userBranchID == branchID) && (userRoleID == get_roll_id) && (userID == ref_user_id)) {
                    $("input[name='status'][value=" + status + "]").prop('checked', true);
                    $('select[name^="subject"] option[value=' + subject + ']').attr("selected","selected");
                    
                }
            }
        }
    }
    }
    if (get_roll_id == "6") {
        if ((student_homework_storage)) {
            if (student_homework_storage) {
                var studenthomeworkStorage = JSON.parse(student_homework_storage);
                if (studenthomeworkStorage.length == 1) {
                    var status, subject, userBranchID, userRoleID, userID;
                    studenthomeworkStorage.forEach(function (user) {
                        status = user.status;
                        subject = user.subject;
                        userBranchID = user.branch_id;
                        userRoleID = user.role_id;
                        userID = user.user_id;
                    });
                    if ((userBranchID == branchID) && (userRoleID == get_roll_id) && (userID == ref_user_id)) {
                        $("input[name='status'][value=" + status + "]").prop('checked', true);
                        $('select[name^="subject"] option[value=' + subject + ']').attr("selected","selected");
                        
                    }
                }
            }
        }
        }
});

