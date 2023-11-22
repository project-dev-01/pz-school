var reasonChart;
$(function () {
    $("#department_id").on('change', function (e) {
        e.preventDefault();
        var Selector = '#bystudentrankfilter';
        var department_id = $(this).val();
        var classID = "";
        classAllocation(department_id, Selector, classID);
    });
    function classAllocation(department_id, Selector, classID) {
        $(Selector).find('select[name="class_id"]').empty();
        $(Selector).find('select[name="class_id"]').append('<option value="">' + select_grade + '</option>');
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
    $('#changeClassName').on('change', function () {
        var class_id = $(this).val();
        $("#bystudentrankfilter").find("#examnames").empty();
        $("#bystudentrankfilter").find("#examnames").append('<option value="">'+select_exam+'</option>');

        $("#bystudentrankfilter").find("#sectionID").empty();
        $("#bystudentrankfilter").find("#sectionID").append('<option value="">'+select_class+'</option>');
        $("#bystudentrankfilter").find("#sectionID").append('<option value="All">All</option>');


        $("#bystudentrankfilter").find("#subjectID").empty();
        $("#bystudentrankfilter").find("#subjectID").append('<option value="">'+select_subject+'</option>');

        $.post(sectionByClass, { token: token, branch_id: branchID, class_id: class_id, teacher_id: teacher_id }, function (res) {
            if (res.code == 200) {
                $("#section_drp_div").show();
                $.each(res.data, function (key, val) {
                    $("#bystudentrankfilter").find("#sectionID").append('<option value="' + val.section_id + '">' + val.section_name + '</option>');
                });
            }
        }, 'json');

    });
    // change section
    $('#sectionID').on('change', function () {
        var section_id = $(this).val();
        var class_id = $("#changeClassName").val();

        
        $("#bystudentrankfilter").find("#examnames").empty();
        $("#bystudentrankfilter").find("#examnames").append('<option value="">'+select_exam+'</option>');

        $("#bystudentrankfilter").find("#subjectID").empty();
        $("#bystudentrankfilter").find("#subjectID").append('<option value="">'+select_subject+'</option>');
        $("#bystudentrankfilter").find("#subjectID").append('<option value="All">All</option>');
        $.post(getbySubjectnames, { token: token, branch_id: branchID, class_id: class_id, teacher_id: ref_user_id, academic_session_id: academic_session_id }, function (res) {
            if (res.code == 200) {
                $.each(res.data, function (key, val) {
                    $("#bystudentrankfilter").find("#subjectID").append('<option value="' + val.subject_id + '">' + val.subject_name + '</option>');
                });
            }
        }, 'json');
    });
    // change section
    $('#subjectID').on('change', function () {
        var section_id = $("#sectionID").val();
        var class_id = $("#changeClassName").val();
        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
        var yyyy = today.getFullYear();

        today = yyyy + '/' + mm + '/' + dd;
        $("#bystudentrankfilter").find("#examnames").empty();
        $("#bystudentrankfilter").find("#examnames").append('<option value="">'+select_exam+'</option>');
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
                    $("#bystudentrankfilter").find("#examnames").append('<option value="' + val.id + '" >' + val.name + '</option>');
                });
            }
        }, 'json');
    });
    $("#bystudentrankfilter").validate({
        rules: {
            department_id: "required",
            year: "required",
            class_id: "required",
            section_id: "required",
            examnames: "required",
            type: "required"
        }
    });
    $('#bystudentrankfilter').on('submit', function (e) {
        e.preventDefault();
        var byclass = $("#bystudentrankfilter").valid();
        if (byclass === true) {
            var year = $("#btwyears").val();
            var semester_id = $("#semester_id").val();
            var session_id = $("#session_id").val();
            var class_id = $("#changeClassName").val();
            var section_id = $("#sectionID").val();
            var subject_id = $("#subjectID").val();
            var exam_id = $("#examnames").val();
            var type = $("#type").val();

            var classObj = {
                year: year,
                classID: class_id,
                branchID: branchID,
                sectionID: section_id,
                subjectID: subject_id,
                semesterID: semester_id,
                sessionID: session_id,
                examID: exam_id,
                type: type,
                userID: userID,
            };
            setLocalStorageForExamResultByStudentRank(classObj);

            // download set start
            $("#downExamID").val(exam_id);
            $("#downClassID").val(class_id);
            $("#downSemesterID").val(semester_id);
            $("#downSessionID").val(session_id);
            $("#downSectionID").val(section_id);
            $("#downSubjectID").val(subject_id);
            $("#downAcademicYear").val(year);
            $("#downType").val(type);
            // download set end

            // var formData = new FormData();
            // formData.append('token', token);
            // formData.append('branch_id', branchID);
            // formData.append('class_id', class_id);
            // formData.append('section_id', section_id);
            // formData.append('subject_id', subject_id);
            // formData.append('exam_id', exam_id);
            // formData.append('semester_id', semester_id);
            // formData.append('session_id', session_id);
            // formData.append('academic_year', year);
            // formData.append('type', type);
            examResultByStudentRank(classObj);
        };
    });
    function examResultByStudentRank(formData){

        console.log('13')
        $("#overlay").fadeIn(300);
        $("#studentRank").show("slow");
        
        $('#student-rank-table').DataTable({
            processing: true,
            info: true,
            bDestroy: true,
            // dom: 'lBfrtip',
            dom: "<'row'<'col-sm-2 col-md-2'l><'col-sm-4 col-md-4'B><'col-sm-6 col-md-6'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-6'i><'col-sm-6'p>>",
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
            buttons: [
                {
                    extend: 'csv',
                    text: downloadcsv,
                    extension: '.csv',
                    charset: 'utf-8',
                    bom: true,
                    exportOptions: {
                        columns: 'th:not(:last-child)'
                    }
                },
                {
                    extend: 'pdf',
                    text: downloadpdf,
                    extension: '.pdf',
                    charset: 'utf-8',
                    bom: true,
                    exportOptions: {
                        columns: 'th:not(:last-child)'
                    },

                
                    customize: function (doc) {
                    doc.pageMargins = [50,50,50,50];
                    doc.defaultStyle.fontSize = 10;
                    doc.styles.tableHeader.fontSize = 12;
                    doc.styles.title.fontSize = 14;
                    // Remove spaces around page title
                    doc.content[0].text = doc.content[0].text.trim();
                    /*// Create a Header
                    doc['header']=(function(page, pages) {
                        return {
                            columns: [
                                
                                {
                                    // This is the right column
                                    bold: true,
                                    fontSize: 20,
                                    color: 'Blue',
                                    fillColor: '#fff',
                                    alignment: 'center',
                                    text: header_txt
                                }
                            ],
                            margin:  [50, 15,0,0]
                        }
                    });*/
                    // Create a footer
                    
                    doc['footer']=(function(page, pages) {
                        return {
                            columns: [
                                { alignment: 'left', text: [ footer_txt ],width:400} ,
                                {
                                    // This is the right column
                                    alignment: 'right',
                                    text: ['page ', { text: page.toString() },  ' of ', { text: pages.toString() }],
                                    width:100

                                }
                            ],
                            margin: [50, 0,0,0]
                        }
                    });
                    
                }
            }
            ],
            serverSide: true,
            ajax: {
                url: allStudentRank,
                data: function (d) {
                        d.class_id = formData.classID,
                        d.section_id = formData.sectionID,
                        d.subject_id = formData.subjectID,
                        d.semester_id = formData.semesterID,
                        d.session_id = formData.sessionID,
                        d.exam_id = formData.examID,
                        d.academic_year = formData.year,
                        d.type = formData.type
                }
            },
            "pageLength": 10,
            "aLengthMenu": [
                [5, 10, 25, 50, -1],
                [5, 10, 25, 50, "All"]
            ],
            columns: [
                {
                    searchable: false,
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                }
                ,
                {
                    data: 'student_name',
                    name: 'student_name'
                },
                {
                    data: 'class_name',
                    name: 'class_name'
                },
                {
                    data: 'section_name',
                    name: 'section_name'
                },
                {
                    data: 'mark',
                    name: 'mark'
                },
                {
                    data: 'rank',
                    name: 'rank'
                },
                {
                    data: 'pass_fail',
                    name: 'pass_fail'
                },
            ],
            columnDefs: [
                {
                    "targets": 1,
                    "className": "table-user",
                    "render": function (data, type, row, meta) {
                        var currentImg = studentImg + row.photo;
                        // var existUrl = UrlExists(currentImg);
                        // console.log(currentImg);
                        var img = (row.photo != null) ? currentImg : defaultImg;
                        var first_name = '<img src="' + img + '" class="mr-2 rounded-circle">' +
                            '<a href="javascript:void(0);" class="text-body font-weight-semibold">' + data + '</a>';
                        return first_name;
                    }
                },
                {
                    "targets": 6,
                    "render": function (data, type, row, meta) {
                        $status = "";
                        if(data=="Pass"){

                            var status = '<span class="badge badge-success">'+data+'</span>';
                        }else if(data=="Fail"){

                            var status = '<span class="badge badge-danger">'+data+'</span>';
                        }
                        return status;
                    }
                },
            ]
        });
        
        $("#overlay").fadeOut(300);
    }

    function setLocalStorageForExamResultByStudentRank(classObj) {

        var examResultByStudentRankDetails = new Object();
        examResultByStudentRankDetails.class_id = classObj.classID;
        examResultByStudentRankDetails.section_id = classObj.sectionID;
        examResultByStudentRankDetails.subject_id = classObj.subjectID;
        examResultByStudentRankDetails.type = classObj.type;
        examResultByStudentRankDetails.year = classObj.year;
        examResultByStudentRankDetails.exam_id = classObj.examID;
        examResultByStudentRankDetails.semester_id = classObj.semesterID;
        examResultByStudentRankDetails.session_id = classObj.sessionID;
        // here to attached to avoid localStorage other users to add
        examResultByStudentRankDetails.branch_id = branchID;
        examResultByStudentRankDetails.role_id = get_roll_id;
        examResultByStudentRankDetails.user_id = ref_user_id;
        var examResultByStudentRankClassArr = [];
        examResultByStudentRankClassArr.push(examResultByStudentRankDetails);
        if (get_roll_id == "2") {
            // admin
            localStorage.removeItem("admin_exam_result_by_student_rank_details");
            localStorage.setItem('admin_exam_result_by_student_rank_details', JSON.stringify(examResultByStudentRankClassArr));
        }
        if (get_roll_id == "4") {
            // teacher
            localStorage.removeItem("teacher_exam_result_by_student_rank_details");
            localStorage.setItem('teacher_exam_result_by_student_rank_details', JSON.stringify(examResultByStudentRankClassArr));
        }
        return true;
    }
    // if localStorage
    if (typeof exam_result_by_student_rank_storage !== 'undefined') {
        if ((exam_result_by_student_rank_storage)) {
            if (exam_result_by_student_rank_storage) {
                var examResultByStudentRankStorage = JSON.parse(exam_result_by_student_rank_storage);
                if (examResultByStudentRankStorage.length == 1) {
                    var classID, year, sectionID, subjectID, type, examID, semesterID, sessionID, userBranchID, userRoleID, userID;
                    examResultByStudentRankStorage.forEach(function (user) {
                        classID = user.class_id;
                        year = user.year;
                        sectionID = user.section_id;
                        subjectID = user.subject_id;
                        examID = user.exam_id;
                        semesterID = user.semester_id;
                        sessionID = user.session_id;
                        userBranchID = user.branch_id;
                        userRoleID = user.role_id;
                        userID = user.user_id;     
                        type = user.type;
                    });
                    if ((userBranchID == branchID) && (userRoleID == get_roll_id) && (userID == ref_user_id)) {
                        $('#changeClassName').val(classID);
                        $("#btwyears").val(year);
                        $('#semester_id').val(semesterID);
                        $('#session_id').val(sessionID);
                        $("#type").val(type);
                        if (classID) {
                            $("#bystudentrankfilter").find("#sectionID").empty();
                            $("#bystudentrankfilter").find("#sectionID").append('<option value="">'+select_class+'</option>');
                            $("#bystudentrankfilter").find("#sectionID").append('<option value="All">All</option>');
                            $.post(sectionByClass, { token: token, branch_id: branchID, class_id: classID, teacher_id: userID }, function (res) {
                                if (res.code == 200) {
                                    $("#section_drp_div").show();
                                    $.each(res.data, function (key, val) {
                                        $("#bystudentrankfilter").find("#sectionID").append('<option value="' + val.section_id + '">' + val.section_name + '</option>');
                                    });
                                    $("#bystudentrankfilter").find("#sectionID").val(sectionID);
                                }
                            }, 'json');
                        }
                        if(sectionID){
                            $("#bystudentrankfilter").find("#subjectID").empty();
                            $("#bystudentrankfilter").find("#subjectID").append('<option value="">'+select_subject+'</option>');
                            $("#bystudentrankfilter").find("#subjectID").append('<option value="All">All</option>');
                            $.post(getbySubjectnames, { token: token, branch_id: branchID, class_id: classID, teacher_id: userID, academic_session_id: year }, function (res) {
                                if (res.code == 200) {
                                    $.each(res.data, function (key, val) {
                                        $("#bystudentrankfilter").find("#subjectID").append('<option value="' + val.subject_id + '">' + val.subject_name + '</option>');
                                    });
                                    $("#bystudentrankfilter").find("#subjectID").val(subjectID);
                                }
                            }, 'json');
                        }
                        if(subjectID){
                            
                            var today = new Date();
                            var dd = String(today.getDate()).padStart(2, '0');
                            var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
                            var yyyy = today.getFullYear();

                            today = yyyy + '/' + mm + '/' + dd;
                            $("#bystudentrankfilter").find("#examnames").empty();
                            $("#bystudentrankfilter").find("#examnames").append('<option value="">'+select_exam+'</option>');
                            $.post(examsByclassandsection, {
                                token: token,
                                branch_id: branchID,
                                class_id: classID,
                                section_id: sectionID,
                                academic_session_id: year,
                                today: today
                            }, function (res) {
                                if (res.code == 200) {
                                    $.each(res.data, function (key, val) {
                                        $("#bystudentrankfilter").find("#examnames").append('<option value="' + val.id + '" >' + val.name + '</option>');
                                    });
                                    $("#bystudentrankfilter").find("#examnames").val(examID);
                                }
                            }, 'json');
                        }
                        
                        // download set start
                        $("#downExamID").val(examID);
                        $("#downClassID").val(classID);
                        $("#downSemesterID").val(sessionID);
                        $("#downSessionID").val(sessionID);
                        $("#downSectionID").val(sectionID);
                        $("#downAcademicYear").val(year);
                        // download set end
                        // var formData = new FormData();
                        // formData.append('token', token);
                        // formData.append('branch_id', branchID);
                        // formData.append('class_id', classID);
                        // formData.append('section_id', sectionID);
                        // formData.append('exam_id', examID);
                        // formData.append('semester_id', semesterID);
                        // formData.append('session_id', sessionID);
                        // formData.append('academic_year', year);
                        // formData.append('type', type);
                        var classObj = {
                            year: year,
                            classID: classID,
                            sectionID: sectionID,
                            subjectID: subjectID,
                            semesterID: semesterID,
                            sessionID: sessionID,
                            examID: examID,
                            type: type,
                        };
                        examResultByStudentRank(classObj);
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

});

function bysubjectdetails_class(datasetnew) {
    $('#bysubjectTableAppend').empty();
    var sno = 0;
    var bysubjectAllTable = "";
    var headers = datasetnew.headers;
    var grade_list_master = datasetnew.grade_list_master;
    bysubjectAllTable += '<div class="table-responsive">' +
        '<table id="tblbycls" class="table w-100 nowrap table-bordered table-striped table2excel" data-tableName="Test Table 1">' +
        '<thead>' +
        '<tr>' +
        '<th class="align-top" rowspan="2">'+sl_no_lang+'</th>' +
        '<th class="align-top" rowspan="2">'+grade_lang+'</th>' +
        '<th class="align-top" rowspan="2">'+class_lang+'</th>' +
        '<th class="align-top" rowspan="2">'+subject_name_lang+'</th>' +
        '<th class="align-top th-sm - 6 rem" rowspan="2">'+total_student_lang+'</th>' +
        '<th class="align-top" rowspan="2">'+absent_lang+'</th>' +
        '<th class="align-top" rowspan="2">'+present_lang+'</th>' +
        '<th class="align-top" rowspan="2">'+subject_teacher_name_lang+'</th>';
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
    grade_list_master.forEach(function (res) {
        sno++;
        bysubjectAllTable += '<tr>' +
            '<td class="text-center" rowspan="2">';
        bysubjectAllTable += sno +
            '</td>';
        bysubjectAllTable += '<td class="text-left" rowspan="2">' +
            '<label for="clsname">' + res.class_name + '</label>' +
            '</td>';
        bysubjectAllTable += '<td class="text-center" rowspan="2">' +
            '<label for="stdcount"> ' + res.section_name + '</label>' +
            '</td>';
        bysubjectAllTable += '<td class="text-left" rowspan="2">' +
            '<label for="clsname">' + res.subject_name + '</label>' +
            '</td>';
        bysubjectAllTable += '<td class="text-left" rowspan="2">' +
            '<label for="clsname">' + res.totalstudentcount + '</label>' +
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
    $("#bysubjectTableAppend").append(bysubjectAllTable);
}
// find matched
function isKey(key, obj) {
    var keys = Object.keys(obj).map(function (x) {
        return x;
    });
    return keys.indexOf(key) !== -1;
}