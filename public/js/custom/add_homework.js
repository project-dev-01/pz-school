
$(function () {

    $(".homeWorkAdd").datepicker({
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
        autoclose: true,
        yearRange: "-100:+50", // last hundred years
    });

    

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
