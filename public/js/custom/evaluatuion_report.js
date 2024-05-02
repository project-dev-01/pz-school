$(function () {
    // get all leave list
    function HomeworkListShow(class_id, section_id, subject_id, semester_id, session_id) {
        console.log("HomeworkListShow");
        // if (class_id != '') {
        //     // It's not empty or undefined
        //     console.log("not empty");
        //   } else {
        //     // It's empty or undefined
        //     console.log(" empty");
        //     class_id = null;

        //   }
        console.log(class_id);
        console.log(section_id);
        console.log(subject_id);
        console.log(semester_id);
        console.log(session_id);
        $('#homework-table').DataTable({
            processing: true,
            bDestroy: true,
            // dom: 'Bfrtip',
            // buttons: [
            //     'copyHtml5',
            //     'excelHtml5',
            //     'csvHtml5',
            //     'pdfHtml5'
            // ],
            info: true,
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
                    },
                    enabled: false, // Initially disable CSV button
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
                    enabled: false, // Initially disable PDF button

                    customize: function (doc) {
                        doc.pageMargins = [50, 50, 50, 50];
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

                        doc['footer'] = (function (page, pages) {
                            return {
                                columns: [
                                    { alignment: 'left', text: [footer_txt], width: 400 },
                                    {
                                        // This is the right column
                                        alignment: 'right',
                                        text: ['page ', { text: page.toString() }, ' of ', { text: pages.toString() }],
                                        width: 100

                                    }
                                ],
                                margin: [50, 0, 0, 0]
                            }
                        });

                    }
                }
            ],           
            "ajax": {
                url: homeworkTableList,
                cache: false,
                dataType: "json",
                // data: { month:getSelectedMonth },
                // data: formData,
                data: {
                    class_id: class_id,
                    section_id: section_id,
                    subject_id: subject_id,
                    semester_id: semester_id,
                    session_id: session_id
                },
                type: "GET",
                // contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
                // processData: true, // NEEDED, DON'T OMIT THIS
                // headers: {
                // 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                // },
                "dataSrc": function (json) {
                    console.log("json");
                    console.log(json);
                    if (json && json.data.length > 0) {
                        console.log('ok');
                        $('#homework-table_wrapper .buttons-csv').removeClass('disabled');
                        $('#homework-table_wrapper .buttons-pdf').removeClass('disabled');  // Enable all buttons if at least one record exists
                    } else {
                        console.log(data);
                        $('#homework-table_wrapper .buttons-csv').addClass('disabled');
                        $('#homework-table_wrapper .buttons-pdf').addClass('disabled');               
                    }
                    return json.data;
                },
                error: function (error) {
                    // console.log("error")
                    // console.log(error)
                    // noDataAvailable(error);
                }
            },

            "pageLength": 5,
            "aLengthMenu": [
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
                    data: 'title',
                    name: 'title'
                },
                {
                    data: 'date_of_homework',
                    name: 'date_of_homework'
                },
                {
                    data: 'date_of_submission',
                    name: 'date_of_submission'
                },
                {
                    data: 'students_completed',
                    name: 'students_completed'
                },
                {
                    data: 'studentCount',
                    name: 'studentCount'
                },
                {
                    data: 'actions',
                    name: 'actions',
                    orderable: false,
                    searchable: false
                }
            ],
            columnDefs: [
                {
                    "targets": 4,
                    "render": function (data, type, row, meta) {
                        var completed = parseInt(row.students_completed);
                        var studIncompleteCnt = parseInt(row.studentCount);
                        var incompleted = (studIncompleteCnt - completed);
                        var att_status = completed + "/" + incompleted;
                        return att_status;
                    }
                }
            ]
        }).on('draw', function () {
        });
    }
    $("#department_id").on('change', function (e) {
        e.preventDefault();
        var Selector = '#evaluationFilterForm';
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

    // $("#evaluationFilterForm").validate({
    //     rules: {
    //         class_id: "required",
    //         section_id: "required",
    //         subject_id: "required"
    //     }
    // });
    // all Leave Filter
    $('#evaluationFilterForm').on('submit', function (e) {
        e.preventDefault();
        var class_id = $("#class_id").val();
        var section_id = $("#section_id").val();
        var subject_id = $("#subject_id").val();;
        var semester_id = $("#semester_id").val();
        var session_id = $("#session_id").val();
        console.log("-----");
        console.log(class_id);
        console.log(section_id);
        console.log(subject_id);
        console.log(semester_id);
        console.log(session_id);
        var classObj = {
            classID: class_id,
            sectionID: section_id,
            subjectID: subject_id,
            semesterID: semester_id,
            sessionID: session_id,
            academic_session_id: academic_session_id,
            userID: userID,
        };
        HomeworkListShow(class_id, section_id, subject_id, semester_id, session_id);
        setLocalStorageForEvaluationReport(classObj);
    });
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
        if (get_roll_id == "2") {
            // teacher
            localStorage.removeItem("admin_evaluation_report_details");
            localStorage.setItem('admin_evaluation_report_details', JSON.stringify(evaluationReportClassArr));
        }
        return true;
    }
    
    // if localStorage
    if (get_roll_id == "4") {
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
                                $("#subject_id").append('<option value="All">All</option>');
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
                            // evealuation report
                            HomeworkListShow(classID, sectionID, subjectID, semesterID, sessionID);
                        }
                    }
                }
            }else{
                var class_id = null;
                var section_id = null;
                var subject_id = "All";
                var semester_id = null;
                var session_id = null;
                HomeworkListShow(class_id, section_id, subject_id, semester_id, session_id);
            }
        }
    }
     // if localStorage
    if (get_roll_id == "2") {
        if (typeof admin_evaluation_report_storage !== 'undefined') {
            if ((admin_evaluation_report_storage)) {
                if (admin_evaluation_report_storage) {
                    var adminevaluationreportstorage = JSON.parse(admin_evaluation_report_storage);
                    if (adminevaluationreportstorage.length == 1) {
                        var classID, sectionID, subjectID, semesterID, sessionID, userBranchID, userRoleID, userID;
                        adminevaluationreportstorage.forEach(function (user) {
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
                                $("#subject_id").append('<option value="All">All</option>');
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
                            // evealuation report
                            HomeworkListShow(classID, sectionID, subjectID, semesterID, sessionID);
                        }
                    }
                }
            }else{
            
                var class_id = null;
                var section_id = null;
                var subject_id = "All";
                var semester_id = null;
                var session_id = null;
                HomeworkListShow(class_id, section_id, subject_id, semester_id, session_id);
            }
        }
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
                console.log('data', data)
                if (data.code == 200) {
                    $('.firstModal').modal('hide');
                    toastr.success(data.message);
                    var class_id = $("#class_id").val();
                    var section_id = $("#section_id").val();
                    var subject_id = $("#subject_id").val();;
                    var semester_id = $("#semester_id").val();
                    var session_id = $("#session_id").val();
                    console.log("*****");
                    console.log(class_id);
                    console.log(section_id);
                    console.log(subject_id);
                    console.log(semester_id);
                    console.log(session_id);
                    HomeworkListShow(class_id, section_id, subject_id, semester_id, session_id);
                } else {
                    toastr.error(data.message);
                }
            }
        });
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
                console.log('cs', res)
                if (res.code == 200) {
                    $("#homework_modal_table").html(res.table);
                    var complete = res.complete;
                    var incomplete = res.incomplete;
                    var checked = res.checked;
                    var unchecked = res.unchecked;

                    callchart(complete, incomplete, checked, unchecked);
                    homeworkchart.updateSeries([complete, incomplete]);
                    homeworkevaluationchart.updateSeries([checked, unchecked]);

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
        $.post(homeworkView, { homework_id: homework_id, semester_id: semester_id, session_id: session_id }, function (res) {
            if (res.code == 200) {
                $("#homework_modal_table").html(res.table);
                var complete = res.complete;
                var incomplete = res.incomplete;
                var checked = res.checked;
                var unchecked = res.unchecked;

                callchart(complete, incomplete, checked, unchecked);
                homeworkchart.updateSeries([complete, incomplete]);
                homeworkevaluationchart.updateSeries([checked, unchecked]);

            }
        }, 'json');
    }).on('hidden.bs.modal', function (event) {

    });


    function callchart(complete, incomplete, checked, unchecked) {

        colors = ["#00b19d", "#f1556c"];
        (dataColors = $("#homework-status").data("colors")) && (colors = dataColors.split(","));
        options = {
            chart: {
                height: 320,
                type: "donut"
            },
            series: [complete, incomplete],
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
            labels: [complete_lang, incomplete_lang],
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
            series: [checked, unchecked],
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
            labels: [checked_lang, unchecked_lang],
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
    //GET ALL HISTORY
    $('#evaluation-report-history').DataTable({
        processing: true,
        info: true,
        // dom: 'lBfrtip',
        dom: "<'row'<'col-sm-2 col-md-2'l><'col-sm-4 col-md-4'B><'col-sm-6 col-md-6'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-6'i><'col-sm-6'p>>",
        "language": {
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
                    doc.pageMargins = [50, 50, 50, 50];
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

                    doc['footer'] = (function (page, pages) {
                        return {
                            columns: [
                                { alignment: 'left', text: [footer_txt], width: 400 },
                                {
                                    // This is the right column
                                    alignment: 'right',
                                    text: ['page ', { text: page.toString() }, ' of ', { text: pages.toString() }],
                                    width: 100

                                }
                            ],
                            margin: [50, 0, 0, 0]
                        }
                    });

                }
            }
        ],
        ajax: evaluationReportList,
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
            },
            {
                data: 'title',
                name: 'title'
            },
            {
                data: 'date_of_homework',
                name: 'date_of_homework'
            },
            {
                data: 'date_of_submission',
                name: 'date_of_submission'
            },
            {
                data: 'students_completed',
                name: 'students_completed'
            },
            {
                data: 'studentCount',
                name: 'studentCount'
            },
            {
                data: 'actions',
                name: 'actions',
                orderable: false,
                searchable: false
            },
        ],
        columnDefs: [
            {
                "targets": 4,
                "render": function (data, type, row, meta) {
                    var completed = parseInt(row.students_completed);
                    var studIncompleteCnt = parseInt(row.studentCount);
                    var incompleted = (studIncompleteCnt - completed);
                    var att_status = completed + "/" + incompleted;
                    return att_status;
                }
            }
        ]
    }).on('draw', function () {
    });

});