
$(function () {

    $(".homeWorkAdd").datepicker({
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
        autoclose: true,
        yearRange: "-100:+50", // last hundred years
    });

    $("#department_id").on('change', function (e) {
        e.preventDefault();
        var Selector = '#healthLogBookForm';
        var department_id = $(this).val();
        var classID = "";
        classAllocation(department_id, Selector, classID);
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
    function sectionAllocation(class_id, Selector, sectionID) {
       
        $("#healthLogBookForm").find("#sectionID").empty();
        $("#healthLogBookForm").find("#sectionID").append('<option value="">' + select_class + '</option>');

        $.post(sectionByClass, { token: token, branch_id: branchID, class_id: class_id }, function (res) {
            if (res.code == 200) {
                $.each(res.data, function (key, val) {
                    $("#healthLogBookForm").find("#sectionID").append('<option value="' + val.section_id + '">' + val.section_name + '</option>');
                });
                if (sectionID != '') {
                    $("#healthLogBookForm").find('select[name="section_id"]').val(sectionID);
                }
            }
        }, 'json');
    }
    // change classroom
    $('#changeClassName').on('change', function () {
        var class_id = $(this).val();
        $("#healthLogBookForm").find("#sectionID").empty();
        $("#healthLogBookForm").find("#sectionID").append('<option value="">' + select_class + '</option>');

        $.post(sectionByClass, { token: token, branch_id: branchID, class_id: class_id }, function (res) {
            if (res.code == 200) {
                $.each(res.data, function (key, val) {
                    $("#healthLogBookForm").find("#sectionID").append('<option value="' + val.section_id + '">' + val.section_name + '</option>');
                });
            }
        }, 'json');
    });
    $(document).on('submit', '.submitHomeworkForm', function (e) {
        e.preventDefault();
        var formid = $(this).attr("id")
        formvalidate(formid)
        var homeWork = $("#" + formid).valid();
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
                    console.log('data', 200)
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

    $(document).on('change', '.homework_file', function () {
        console.log(12343333)
        var file = $(this)[0].files[0];
        if (file.size > 2097152) {
            toastr.error("File greater than 2Mb");
            $(this).val('');
        }
    });

    $('#studentHomeworkFilter').on('submit', function (e) {
        e.preventDefault();
        var form = this;
        var formstatus = $('input[name="status"]:checked').val();

        var formsubject = $('#subject').val();
        $.ajax({
            url: $(form).attr('action'),
            method: $(form).attr('method'),
            data: new FormData(form),
            processData: false,
            dataType: 'json',
            contentType: false,
            success: function (data) {
                console.log('cs', data)
                if (data.code == 200) {
                    $("#homeworks").show("slow");
                    if (data.subject != "All") {
                        var sub = homework_list_lang + ' (' + data.subject + ')';

                    } else {
                        var sub = homework_list_lang + ' (' + all_subject_lang + ')';
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
    $("#employeeAttendanceFilter").validate({
        rules: {
            date_of_homework: "required"
        }
    });

    // add Homework
    $('#employeeAttendanceFilter').on('submit', function (e) {
        e.preventDefault();
        var homeworkCheck = $("#employeeAttendanceFilter").valid();
        if (homeworkCheck === true) {
            $(".classRoomHideSHow").show("slow");
            var form = this;
            var formData = new FormData(form);
            var date = $('#date_of_homework').val(); // Get the date value
            console.log(date);
            formData.set('date_of_homework', date); // Set the date in the FormData
            $.ajax({
                url: getHealthLogBooksList,
                method: "post",
                data: formData,
                processData: false,
                dataType: 'json',
                contentType: false,
                success: function (data) {
                     console.log(data)
                    if (data.code == 200) {
                        console.log(data.data);
                        //$('.employeeAttendanceFilter').find('form')[0].reset();
                        // Update the health logbook form with fetched data
                       updateHealthLogBookForm(data.data);
                       healthLogbooksTable(data.data);
                    } else {
                        toastr.error(data.message);
                    }
                }
            });
        }
    });
    function updateHealthLogBookForm(data) {
        // Assuming data is an array of health logbooks
        if (data && data.length > 0) {
            // Assuming you have fields in your form to display health logbook data
            // Replace the following lines with your logic to update the form fields
            $('#date_of_homework').val(data[0].date);
            $('#name').val(data[0].name);
            $('#gender').val(data[0].gender);
            $('#time').val(data[0].time);
            $('#descriptions').val(data[0].event_notes_c);
            $('#temp').val(data[0].temp);
            $('#department_id').val(data[0].department_id);
            if (data[0].department_id != "") {
            var department_id =  data[0].department_id;
            var Selector = '#healthLogBookForm';
            var classID = data[0].class_id;
            classAllocation(department_id, Selector, classID)
            }
            if (data[0].class_id != "") {
                var class_id = data[0].class_id;
                var Selector = '#healthLogBookForm';
                var sectionID = data[0].section_id;
                sectionAllocation(class_id, Selector, sectionID);
            }
            $('#weather').val(data[0].weather);
            $('#humidity').val(data[0].humidity);
            $('#description').val(data[0].event_notes_a);
            $('#remarks').val(data[0].event_notes_b);
            // Update other fields as needed
        }
    }
    function healthLogbooksTable(dataSetNew) {
        
       
        $('#healthLogbooksTable').DataTable({
            processing: true,
            bDestroy: true,
            info: true,
            dom: 'lrt',
            "language": {
    
                "emptyTable": no_data_available,
                "infoFiltered": filter_from_total_entries,
                "zeroRecords": no_matching_records_found,
                "infoEmpty": showing_zero_entries,
                "info": showing_entries,
                "lengthMenu": show_entries,
                "search": datatable_search,
                "paginate": {
                    "next": next,
                    "previous": previous
                },
            },
            paging: false,
            searching: false,
            data: dataSetNew,
            columns: [
                {
                    "targets": 0,
                    "render": function (data, type, row, meta) {
                        return meta.row + 1;
                    }
                },
                {
                    data: 'class_name'
                },
                {
                    data: 'section_name'
                },
                {
                    data: 'name'
                },
                {
                    data: 'gender'
                },
                {
                    data: 'time'
                }, 
                {
                    data: 'event_notes_c'
                }
            ]
        }).on('draw', function () {
        });
    }
    $('#saveButton').on('click', function (e) {
        e.preventDefault();
    
        // Gather data from healthLogBookForm
    var formData = new FormData($('#healthLogBookForm')[0]);
    var temp = $('#temp').val();
    var weather = $('#weather').val();
    var humidity = $('#humidity').val();
    var event_notes_a = $('#description').val();
    var event_notes_b = $('#remarks').val();
    var department_id = $('#department_id').val();
    var changeClassName = $('#changeClassName').val();
    var sectionID = $('#sectionID').val();
    var name = $('#name').val();
    var gender = $('#gender').val();
    var time = $('#time').val();
    var event_notes_c = $('#descriptions').val();
    var date = $('#date_of_homework').val(); // Get the date value

    formData.set('temp', temp);
    formData.set('weather', weather);
    formData.set('humidity', humidity);
    formData.set('event_notes_a', event_notes_a);
    formData.set('event_notes_b', event_notes_b);
    formData.set('department_id', department_id);
    formData.set('changeClassName', changeClassName);
    formData.set('sectionID', sectionID);
    formData.set('name', name);
    formData.set('gender', gender);
    formData.set('time', time);
    formData.set('event_notes_c', event_notes_c);
    formData.set('date', date); // Set the date in the FormData

    // // Log the entire FormData object using entries()
    // for (var pair of formData.entries()) {
    //     console.log(pair[0] + ': ' + pair[1]);
    // }


        // Submit the save form
        $.ajax({
            url: saveHealthLogBooksList,
            method: "post",
            data: formData,
            processData: false,
            contentType: false,
            success: function (data) {
                console.log(data);
                // if ($.fn.DataTable.isDataTable('#healthLogbooksTable')) {
                //     $('#healthLogbooksTable').DataTable().ajax.reload(null, false);
                // }
               // $('#healthLogbooksTable').DataTable().ajax.reload(null, false);
                toastr.success(data.message)
            },
            error: function (xhr, status, error) {
                // Handle error if needed
                toastr.error("Error: " + xhr.status + ": " + xhr.statusText);
            }
        });
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
                            $("#section_id").append('<option value="">' + select_class + '</option>');
                            $.post(sectionByClass, { class_id: classID }, function (res) {
                                if (res.code == 200) {
                                    $.each(res.data, function (key, val) {
                                        $("#section_id").append('<option value="' + val.section_id + '">' + val.section_name + '</option>');
                                    });
                                    $('#section_id').val(sectionID);
                                }
                            }, 'json');
                        }
                        if (sectionID) {
                            $("#subject_id").empty();
                            $("#subject_id").append('<option value="">' + select_subject + '</option>');
                            $.post(subjectByClass, { class_id: classID, section_id: sectionID }, function (res) {
                                console.log('data', res)
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
    function formvalidate(formid) {
        $("#" + formid).validate({
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
        $("#section_id").append('<option value="">' + select_class + '</option>');

        $("#subject_id").empty();
        $("#subject_id").append('<option value="All">' + all_lang + '</option>');
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
        $("#subject_id").append('<option value="All">' + all_lang + '</option>');
        $.post(subjectByClass, { class_id: class_id, section_id: section_id }, function (res) {
            console.log('data', res)
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
                        $('select[name^="subject"] option[value=' + subject + ']').attr("selected", "selected");

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
                        $('select[name^="subject"] option[value=' + subject + ']').attr("selected", "selected");

                    }
                }
            }
        }
    }
});

