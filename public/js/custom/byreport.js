var reasonChart;
$(function () {
    $('#changeClassName').on('change', function () {
        var class_id = $(this).val();
        $("#bysubjectfilter").find("#examnames").empty();
        $("#bysubjectfilter").find("#examnames").append('<option value="">' + select_exam + '</option>');

        $("#bysubjectfilter").find("#sectionID").empty();

        $("#bysubjectfilter").find("#sectionID").append('<option value="">' + select_class + '</option>');


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
        $("#bysubjectfilter").find("#examnames").append('<option value="">' + select_exam + '</option>');

        $("#bysubjectfilter").find("#sectionID").empty();

        $("#bysubjectfilter").find("#sectionID").append('<option value="">' + select_class + '</option>');

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
        $("#bysubjectfilter").find("#examnames").append('<option value="">' + select_exam + '</option>');
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
                report_type: report_type,
            };
            // console.log(classObj);
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
            var formData1 = {
                department_id: department_id,
                class_id: class_id,
                section_id: section_id,
                academic_year: year
            };
            // $("#overlay").fadeOut(300);
            hideUnhideReport(report_type, department_id, formData1);

        }
        else {
            $("#student").hide("slow");
        }
    });
    function hideUnhideReport(reportType, departmentId, formData1) {
        if (reportType == 'english_communication') {
            $("#byec_body").show("slow");
            $("#byreport_body").hide("slow");
            $("#bypersonal_body").hide("slow");
        } else if (reportType == 'report_card') {
            $("#byec_body").hide("slow");
            $("#byreport_body").show("slow");
            $("#bypersonal_body").hide("slow");
        } else {
            $("#byec_body").hide("slow");
            $("#byreport_body").hide("slow");
            $("#bypersonal_body").show("slow");
            if (departmentId == '2') {
                $("#secondary_personal").show("slow");
                $("#primary_personal").hide("slow");
            } else {
                $("#student").hide("slow");
                $("#secondary_personal").hide("slow");
                $("#primary_personal").show("slow");
            }
        }
        // Ensure formData1 is valid before calling getStudentList
        if (formData1 && Object.keys(formData1).length > 0) {
            // console.log("Calling getStudentList with:", formData1);
            getStudentList(formData1, reportType);
        } else {
            // console.error("formData1 is invalid:", formData1);
        }
    }
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
                    var classID, year, sectionID, departmentID, examID, reportType, semesterID, sessionID, userBranchID, userRoleID, userID;
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
                        reportType = user.report_type;
                    });
                    if ((userBranchID == branchID) && (userRoleID == get_roll_id) && (userID == ref_user_id)) {
                        //$('#changeClassName').val(classID);
                        $("#btwyears").val(year);
                        $('#report_type').val(report_type);
                        $('#session_id').val(sessionID);
                        $("#department_id").val(departmentID);
                        if (departmentID) {

                            $("#resultsByPaper").find("#changeClassName").empty();
                            $("#resultsByPaper").find("#changeClassName").append('<option value="">' + select_class + '</option>');
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
                            $("#bysubjectfilter").find("#sectionID").append('<option value="">' + select_class + '</option>');
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
                        if (sectionID) {
                            var today = new Date();
                            var dd = String(today.getDate()).padStart(2, '0');
                            var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
                            var yyyy = today.getFullYear();

                            today = yyyy + '/' + mm + '/' + dd;
                            $("#bysubjectfilter").find("#examnames").empty();
                            $("#bysubjectfilter").find("#examnames").append('<option value="">' + select_exam + '</option>');
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
                        // $("#downSemesterID").val(sessionID);
                        $("#semester_id").val(semesterID);
                        $("#downSessionID").val(sessionID);
                        $("#downSectionID").val(sectionID);
                        $("#downAcademicYear").val(year);
                        $("#report_type").val(reportType);
                        // download set end
                        var formData = new FormData();
                        formData.append('token', token);
                        formData.append('branch_id', branchID);
                        formData.append('class_id', classID);
                        formData.append('section_id', sectionID);
                        formData.append('exam_id', examID);
                        formData.append('semester_id', semesterID);
                        formData.append('session_id', sessionID);
                        formData.append('academic_year', year);
                        var formData1 = {
                            department_id: departmentID,
                            class_id: classID,
                            section_id: sectionID,
                            academic_year: year
                        };
                        // console.log("formData1");
                        // console.log(formData1);
                        // download set start
                        $(".downExamID").val(examID);
                        $(".downDepartmentID").val(departmentID);
                        $(".downClassID").val(classID);
                        $(".downSemesterID").val(semesterID);
                        $(".downSessionID").val(sessionID);
                        $(".downSectionID").val(sectionID);
                        $(".downAcademicYear").val(year);

                        $(".downReport_type").val(reportType);
                        // download set end

                        hideUnhideReport(reportType, departmentID, formData1);
                    }
                }
            }
        }
    }

    function getStudentList(formData, reportType) {
        if (reportType == 'english_communication') {
            var studentTableID = '#ec-student-table';
        } else if (reportType == 'report_card') {
            var studentTableID = '#student-table';
        } else if (reportType == 'personal_test_result') {
            var studentTableID = '#student-table';
        } else {
            // def
            var studentTableID = '#student-table';
        }
        var table = $(studentTableID).DataTable({
            processing: true,
            info: true,
            bDestroy: true,
            dom: 'Blfrtip',
            dom: "<'row'<'col-sm-2 col-md-2'l><'col-sm-4 col-md-4'B><'col-sm-6 col-md-6'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-6'i><'col-sm-6'p>>",
            language: {
                emptyTable: no_data_available,
                infoFiltered: filter_from_total_entries,
                zeroRecords: no_matching_records_found,
                infoEmpty: showing_zero_entries,
                info: showing_entries,
                lengthMenu: show_entries,
                search: datatable_search,
                paginate: {
                    next: next,
                    previous: previous
                },
            },
            // serverSide: true,
            ajax: {
                url: studentList,
                data: function (d) {
                    d.department_id = formData.department_id,
                        d.class_id = formData.class_id,
                        d.section_id = formData.section_id,
                        d.academic_year = formData.academic_year
                },
                dataSrc: function (json) {
                    // console.log("json"); // Log the JSON response to check its validity
                    // console.log(json); // Log the JSON response to check its validity
                    return json.data;
                },
                error: function (xhr, error, thrown) {
                    // console.error("Error occurred: ", error, thrown); // Log any error that occurs during the AJAX request
                    // console.error("Response Text: ", xhr.responseText); // Log the server response text
                }
            },
            pageLength: 10,
            aLengthMenu: [
                [5, 10, 25, 50, -1],
                [5, 10, 25, 50, "All"]
            ],
            columns: [
                {
                    searchable: false,
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'register_no',
                    name: 'register_no'
                },
                {
                    data: 'attendance_no',
                    name: 'attendance_no'
                },
                {
                    data: 'gender',
                    name: 'gender'
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'actions',
                    name: 'actions',
                    orderable: false,
                    searchable: false
                },
            ]
        });
    }

    $(document).on('click', '.exportToExcel', function (e) {
        // var table = $(this).prev('.table2excel');
        var table = $('.table2excel');
        if (table && table.length) {
            var preserveColors = (table.hasClass('table2excel_with_colors') ? true : false);
            $(table).table2excel({
                // exclude: ".noExl",
                name: "By Subject",
                filename: downloadFileName + new Date().toISOString().replace(/[\-\:\.]/g, "") + ".xls",
                fileext: ".xls",
                exclude_img: true,
                exclude_links: true,
                exclude_inputs: true,
                preserveColors: preserveColors
            });
        }
    });
    // find matched
    function isKey(key, obj) {
        var keys = Object.keys(obj).map(function (x) {
            return x;
        });
        return keys.indexOf(key) !== -1;
    }
    $('.induvidualStudents tbody').on('click', '.individual_pdf', function () {
        var student_id = $(this).val();
        var byclass = $("#bysubjectfilter").valid();
        if (byclass === true) {
            var year = $(".downAcademicYear").val();
            var department_id = $(".downDepartmentID").val();
            var semester_id = $(".downSemesterID").val();
            var session_id = $(".downSessionID").val();
            var class_id = $(".downClassID").val();
            var section_id = $(".downSectionID").val();
            var exam_id = $(".downExamID").val();
            var report_type = $(".downReport_type").val();

            // download set start
            $(".downExamID").val(exam_id);
            $(".downDepartmentID").val(department_id);
            $(".downClassID").val(class_id);
            $(".downSemesterID").val(semester_id);
            $(".downSessionID").val(session_id);
            $(".downSectionID").val(section_id);
            $(".downAcademicYear").val(year);
            $(".downReport_type").val(report_type);
            $(".downstudent_id").val(student_id);
            if (report_type == 'english_communication') {
                $('#individual_pdf').attr('action', downbyecreport);
            }
            if (report_type == 'report_card') {
                $('#individual_pdf').attr('action', downbyreportcard);
            }
            if (report_type == 'personal_test_result') {
                $('#individual_pdf').attr('action', downbypersoanalreport);
            }
            $('#individual_pdf').submit();
        }
    });

});