$(function () {


    $('#employeeDate').datepicker({
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true,
        dateFormat: 'MM yy',
        // autoclose: true,
        yearRange: "-100:+50", // last hundred years
        onClose: function (dateText, inst) {
            $(this).datepicker('setDate', new Date(inst.selectedYear, inst.selectedMonth, 1));
        }
    });

    $("#employeeDate").focus(function () {
        $(".ui-datepicker-calendar").hide();
        $("#ui-datepicker-div").position({
            my: "center top",
            at: "center bottom",
            of: $(this)
        });
    });

    $('#employeeReportDate').datepicker({
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true,
        dateFormat: 'MM yy',
        // autoclose: true,
        yearRange: "-100:+50", // last hundred years
        onClose: function (dateText, inst) {
            $(this).datepicker('setDate', new Date(inst.selectedYear, inst.selectedMonth, 1));
        }
    });

    $("#employeeReportDate").focus(function () {
        $(".ui-datepicker-calendar").hide();
        $("#ui-datepicker-div").position({
            my: "center top",
            at: "center bottom",
            of: $(this)
        });
    });
    // $("#employeeReportDate").datepicker({
    //     dateFormat: 'yy-mm-dd',
    //     changeMonth: true,
    //     changeYear: true,
    //     autoclose: true,
    //     yearRange: "-60:+1", // last hundred years
    //     maxDate: 0
    // });

    // $("#employeeDate").datepicker({
    //     dateFormat: 'yy-mm-dd',
    //     changeMonth: true,
    //     changeYear: true,
    //     autoclose: true,
    //     yearRange: "-60:+1", // last hundred years
    //     maxDate: 0
    // });
    

    $("#pattern").on("change", function() {
        var pattern = $(this).val();
        $(".dates").hide();
        $(".tables").hide();
        if (pattern == "Term") {
            $("#term").show();
            $("#month").hide();
            $("#day").hide();
            $("#year").hide();
            $("#subject").hide();
        } else if (pattern == "Month") {
            $("#subject").show();
            $("#month").show();
            $("#term").hide();
            $("#day").hide();
            $("#year").hide();
        } else if (pattern == "Day") {
            $("#day").show();
            $("#month").hide();
            $("#term").hide();
            $("#year").hide();
            $("#subject").hide();
        } else if (pattern == "Year") {
            $("#year").show();
            $("#month").hide();
            $("#term").hide();
            $("#day").hide();
            $("#subject").hide();
        }
    });

    $(".attendanceReport").hide();
    var reasonChart;
    // monthly present,late,absent start
    colors = ["#1FAB44", "#FEB019", "#EB5234"];
    (dataColors = $("#late-present-absent").data("colors")) && (colors = dataColors.split(","));
    options = {
        chart: {
            height: 380,
            type: "line"
        },
        stroke: {
            width: 2,
            curve: "smooth"
        },
        series: [],
        colors: colors,
        fill: {
            type: "solid",
            opacity: [.35, 1]
        },
        labels: [],
        markers: {
            size: 0
        },
        // yaxis: [{
        //     min: 0,
        //     max: 100,
        //     labels: {
        //         formatter: function (val, index) {
        //             return val;
        //         }
        //     }
        // }, {
        //     min: 0,
        //     max: 100,
        //     opposite: !0,
        //     labels: {
        //         formatter: function (val, index) {
        //             return val;
        //         }
        //     }
        // }
        // ],
        tooltip: {
            shared: !0,
            intersect: !1,
            y: {
                formatter: function (e) {
                    return void 0 !== e ? e.toFixed(0) : e
                }
            }
        },
        legend: {
            offsetY: 7
        }
    };
    (chart = new ApexCharts(document.querySelector("#late-present-absent"), options)).render();
    // monthly present,late,absent end
    $('#classDate').datepicker({
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true,
        dateFormat: 'MM yy',
        // autoclose: true,
        yearRange: "-100:+50", // last hundred years
        onClose: function (dateText, inst) {
            $(this).datepicker('setDate', new Date(inst.selectedYear, inst.selectedMonth, 1));
        }
    });

    var dates = [];
    getHolidays();
    function getHolidays(){
        $.get(holidayList, { token: token, branch_id: branchID}, function (res) {
            if (res.code == 200) {
                $.each(res.data, function (key, val) {
                    dates.push(val.date);
                });
            }
        }, 'json');
    }

    function DisableDates(date) {

        var string = jQuery.datepicker.formatDate('yy-mm-dd', date);
        var day = date.getDay();
        return [(day > 0 && day < 6 && dates.indexOf(string) == -1), ""];
    }

    $("#patternDay").datepicker({
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
        autoclose: true,
        yearRange: "-100:+50",
        maxDate: 0,
        beforeShowDay: DisableDates,
    });
    $('#patternYear').datepicker({
        changeMonth: false,
        changeYear: true,
        showButtonPanel: true,
        dateFormat: 'yy',
        // autoclose: true,
        yearRange: "-100:+50", // last hundred years
        onClose: function (dateText, inst) {
            $(this).datepicker('setDate', new Date(inst.selectedYear, inst.selectedMonth, 1));
        }
    });
    $("#patternYear").focus(function () {
        $(".ui-datepicker-calendar").hide();
        $("#ui-datepicker-div").position({
            my: "center top",
            at: "center bottom",
            of: $(this)
        });
    });

    $('#patternMonth').datepicker({
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true,
        dateFormat: 'MM yy',
        // autoclose: true,
        yearRange: "-100:+50", // last hundred years
        onClose: function (dateText, inst) {
            $(this).datepicker('setDate', new Date(inst.selectedYear, inst.selectedMonth, 1));
        }
    });
    $("#patternMonth").focus(function () {
        $(".ui-datepicker-calendar").hide();
        $("#ui-datepicker-div").position({
            my: "center top",
            at: "center bottom",
            of: $(this)
        });
    });


    $("#classDate").focus(function () {
        $(".ui-datepicker-calendar").hide();
        $("#ui-datepicker-div").position({
            my: "center top",
            at: "center bottom",
            of: $(this)
        });
    });
    $("#department_id").on('change', function (e) {
        e.preventDefault();
        var Selector = '#attendanceFilter';
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
                    department_id: department_id,
                    teacher_id: ref_user_id
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
        $(".attendanceReport").hide();
        var class_id = $(this).val();
        $("#attendanceFilter").find("#sectionID").empty();
        $("#attendanceFilter").find("#sectionID").append('<option value="">' + select_class + '</option>');
        $("#attendanceFilter").find("#subjectID").empty();
        $("#attendanceFilter").find("#subjectID").append('<option value="">' + select_subject + '</option>');

        $.post(teacherSectionUrl, { token: token, branch_id: branchID,academic_session_id: academic_session_id, teacher_id: ref_user_id, class_id: class_id }, function (res) {
            if (res.code == 200) {
                $.each(res.data, function (key, val) {
                    $("#attendanceFilter").find("#sectionID").append('<option value="' + val.section_id + '">' + val.section_name + '</option>');
                });
            }
        }, 'json');
    });
    // change section
    $('#sectionID').on('change', function () {
        var section_id = $(this).val();
        var class_id = $("#changeClassName").val();
        $("#attendanceFilter").find("#subjectID").empty();
        $("#attendanceFilter").find("#subjectID").append('<option value="">' + select_subject + '</option>');
        $.post(teacherSubjectUrl, {
            token: token,
            branch_id: branchID,
            teacher_id: ref_user_id,
            class_id: class_id,
            section_id: section_id,
            class_id: class_id,
            academic_session_id: academic_session_id,
        }, function (res) {
            if (res.code == 200) {
                $.each(res.data, function (key, val) {
                    $("#attendanceFilter").find("#subjectID").append('<option value="' + val.subject_id + '">' + val.subject_name + '</option>');
                });
            }
        }, 'json');
    });

    // rules validation
    $("#attendanceFilter").validate({
        rules: {
            department_id: "required",
            class_id: "required",
            section_id: "required",
            subject_id: "required",
            semester_id: "required",
            pattern: "required",
            class_date: "required",
        }
    });

    $('#attendanceFilter').on('submit', function (e) {
        e.preventDefault();
        var check = $("#attendanceFilter").valid();
        if (check === true) {

            var class_id = $("#changeClassName").val();
            var section_id = $("#sectionID").val();
            var subject_id = $("#subjectID").val();
            var pattern = $("#pattern").val();

            if (pattern == "Day") {
                var year_month = $("#patternDay").val();
            } else if (pattern == "Month") {
                var reportDate = $("#patternMonth").val();
                var date = new Date(reportDate)
                var year_month = ("0" + (date.getMonth() + 1)).slice(-2) + "-" + date.getFullYear();

            } else if (pattern == "Term") {

                var year_month = $("#patternTerm").val();
            } else if (pattern == "Year") {

                var year_month = $("#patternYear").val();
            }

            // var date = new Date();
            //excel download

                
            $("#excelSubject").val(subject_id);
            $("#excelClass").val(class_id);
            $("#excelSection").val(section_id);
            $("#excelDate").val(year_month);
            $("#excelPattern").val(pattern);
            // pdf doMonthwnload
            $("#downExcelSubject").val(subject_id);
            $("#downExcelClass").val(class_id);
            $("#downExcelSection").val(section_id);
            $("#downExcelDate").val(year_month);
            $("#downExcelPattern").val(pattern);

            var formData = new FormData();
            formData.append('token', token);
            formData.append('branch_id', branchID);
            formData.append('class_id', class_id);
            formData.append('section_id', section_id);
            formData.append('subject_id', subject_id);
            // formData.append('semester_id', semester_id);
            // formData.append('session_id', session_id);
            formData.append('year_month', year_month);
            formData.append('pattern', pattern);
            formData.append('academic_session_id', academic_session_id);


            var classObj = {
                classID: class_id,
                sectionID: section_id,
                subjectID: subject_id,
                // semesterID: semester_id,
                // sessionID: session_id,
                date: year_month,
                pattern: pattern,
                academic_session_id: academic_session_id,
                userID: userID,
            };

            setLocalStorageForStudentAttendance(classObj);

            studentAttendanceList(formData, reportDate, pattern)
        }

    });
    function studentAttendanceList(formData, reportDate, pattern) {

        console.log('123',getAttendanceListTeacher)
        var date = new Date(reportDate)
        var firstDay = new Date(date.getFullYear(), date.getMonth(), 1);
        var firstDayTd = new Date(date.getFullYear(), date.getMonth(), 1);
        var lastDay = new Date(date.getFullYear(), date.getMonth() + 1, 0);

        var days = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
        $.ajax({
            url: getAttendanceListTeacher,
            method: 'post',
            data: formData,
            processData: false,
            dataType: 'json',
            contentType: false,
            success: function (response) {

                if (response.code == 200) {

                    $(".attendanceReport").show();

                    var get_attendance_list = response.data.student_details;
                    $("#attendanceListShow").empty();
                    $("#count-show").empty();
                    $("#daily-present-late-chart").hide();
                    var attendanceListShow = "";
                    var countShow = "";
                    var i = 1;
                    if (pattern == "Day") {

                        var count = response.data.count;
                        attendanceListShow += '<div class="table-responsive">' +
                            '<table class="table w-100 table-bordered mb-0">' +
                            '<thead>' +
                            '<tr>' +
                            '<th>#</th>' +
                            '<th>' + name_lang + '</th>' +
                            '<th>' + name_english_lang + '</th>' +
                            '<th>' + grade_lang + '</th>' +
                            '<th>' + class_lang + '</th>' +
                            '<th>' + status_lang + '</th>' +
                            '<th>' + remarks_lang + '</th>' +
                            '</tr>' +
                            '</thead>' +
                            '<tbody>';
                        if (get_attendance_list.length > 0) {
                            // add functions tr start
                            get_attendance_list.forEach(function (res) {
                                var name_english = "";
                                if(typeof(res.name_english) != "undefined" && res.name_english !== null) {
                                    name_english = res.name_english;
                                }
                                var remarks = "";
                                if(typeof(res.remarks) != "undefined" && res.remarks != null && res.remarks != "null") {
                                    remarks = res.remarks;
                                }
                                var status = "";
                                if(res.status=="absent"){
                                    status = "Absent";
                                }else if(res.status=="present"){
                                    status = "Present";
                                }
                                attendanceListShow += '<tr>' +
                                    '<td>'+i+'</td >'+
                                    '<td>'+res.first_name + ' ' + res.last_name +'</td>'+
                                    '<td>' + name_english + '</td>' +
                                    '<td>' + res.class_name + '</td>' +
                                    '<td>' + res.section_name + '</td>' +
                                    '<td>' + status + '</td>' +
                                    '<td>' + remarks + '</td>' +
                                    '</tr>';
                                    i++;
                            });
                        } else {
                            attendanceListShow += '<tr> <td colspan="7" class="text-center">'+no_data_available +'</td></tr>';
                        }
                        attendanceListShow += '</tbody>' +
                            '</table>' +
                            '</div>';
                        countShow += '<table><tr><th style="text-align:center"> '+ total_students_lang +' : '+ count.totalCount +' </th><th style="text-align:center"> '+ present_students_lang +' : '+ count.presentCount +' </th><th style="text-align:center"> '+ absent_students_lang + ': '+ count.absentCount +' </th><table/>';
                    
                    } else if (pattern == "Month") {

                        $("#daily-present-late-chart").show();
                        var late_present_graph = response.data.late_present_graph;
                        if (get_attendance_list.length > 0) {
                            attendanceListShow += '<div class="table-responsive">' +
                                '<table id="attnList" class="table table-bordered mb-0">' +
                                '<thead>' +
                                '<tr>' +
                                '<th>' + name_lang + '</th>';
                            // '<th>' + get_attendance_list.first_name + '' + get_attendance_list.last_name + '</th>';
                            for (var d = firstDay; d <= lastDay; d.setDate(d.getDate() + 1)) {
                                // daysOfYear.push(new Date(d));
                                var ds = new Date(d);
                                var dayName = days[ds.getDay()];
                                attendanceListShow += '<th>' + dayName + '<br>' + (i++) + '</th>';
                            }

                            attendanceListShow += '<th>' + total_lang + '<br>' + present_lang + '</th>' +
                                '<th>' + total_lang + '<br>' + absent_lang + '</th>' +
                                '<th>' + total_lang + '<br>' + late_lang + '</th>' +
                                '</tr>' +
                                '</thead>' +
                                '<tbody>';
                            // add functions tr start
                            get_attendance_list.forEach(function (res) {
                                attendanceListShow += '<tr>' +
                                    '<td class="text-center studentRow" style="display:block;">' +
                                    // '<a class="nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light studentDetails" data-toggle="modal" data-id="' + res.student_id + '" data-toggle="dropdown" href="javascript:void(0)" role="button" aria-haspopup="false" aria-expanded="false">' +
                                    '<a class="nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light studentDetails" href="javascript:void(0)" role="button" aria-haspopup="false" aria-expanded="false">' +
                                    '<input type="hidden" value="' + res.student_id + '">';
                                // '<a class="nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light" data-toggle="modal" data-target="#latedetails" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">' +
                                if (res.photo) {
                                    attendanceListShow += '<img src="' + studentImg + '/' + res.photo + '" alt="user-image" class="rounded-circle">';
                                } else {
                                    attendanceListShow += '<img src="' + defaultImg + '" alt="user-image" class="rounded-circle">';
                                }
                                attendanceListShow += '</a>' + res.first_name + ' ' + res.last_name +
                                    '</td>';

                                var attendance_details = res.attendance_details;

                                
                                for (var s = firstDayTd; s <= lastDay; s.setDate(s.getDate() + 1)) {
                                    // daysOfYear.push(new Date(d));
                                    var currentDate = formatDate(new Date(s));

                                    var i = 0;
                                    var bg = "";
                                    var title = "";
                                    attendance_details.forEach(function (res) {

                                        if (currentDate == res.date) {
                                            var color = "";
                                            if (res.status == "present") {
                                                color = "btn-success";
                                            }
                                            if (res.status == "absent") {
                                                color = "btn-danger";
                                            }
                                            if (res.status == "late") {
                                                color = "btn-warning";
                                            }
                                            if(res.remarks != null && res.homeroom_teacher_remarks != null){

                                                if(res.remarks != res.homeroom_teacher_remarks){

                                                    title = "Homeroom Teacher : "+res.homeroom_teacher_remarks+" \n Nursing Teacher :"+res.remarks;
                                                   
                                                    bg = "#5c595b";
                                                }
                                            }
                                            attendanceListShow += '<td style="background-color:' + bg + '">' +
                                                '<input type="hidden" value="' + res.status + '" ></input>' +
                                                '<button type="button"  data-toggle="tooltip"  href="javascript:void(0)" role="button" aria-haspopup="false" aria-expanded="false" title="' + title + '" class="btn btn-xs ' + color + ' waves-effect waves-light"><i class="mdi mdi-check"></i></button>' +
                                                '</td>';
                                            i = 1;
                                        }

                                    });
                                    if (i == 0) {
                                        attendanceListShow += '<td style="background-color: #ddd; cursor: not-allowed;"></td>';
                                        i = 1;
                                    }
                                }
                                firstDayTd = new Date(date.getFullYear(), date.getMonth(), 1);

                                attendanceListShow += '<td>' + res.presentCount + '</td>' +
                                    '<td>' + res.absentCount + '</td>' +
                                    '<td>' + res.lateCount + '</td>' +
                                    '</tr>';
                            });


                            // add functions tr end
                            attendanceListShow += '</tbody>' +
                                '</table>' +
                                '</div>';
                        } else {
                            attendanceListShow += '<div class="row">' +
                                '<div class="col-md-12 text-center">' +
                                no_data_available +
                                '</div>'
                            '</div>';
                        }

                        countShow += '<table ><tr><th><button type="button" style="background-color: #5c595b;" class="btn btn-xs btn-success waves-effect waves-light"><i class="mdi mdi-ufo"></i>'+reason_lang+'</button></th><th><button type="button" class="btn btn-xs btn-success waves-effect waves-light"><i class="mdi mdi-check"></i>'+present_lang+'</button></th><th><button type="button" class="btn btn-xs btn-danger waves-effect waves-light"><i class="mdi mdi-close"></i>'+absent_lang+'</button></th><th><button type="button" class="btn btn-xs btn-info waves-effect waves-light"><i class="mdi mdi-ufo"></i> '+holiday_lang+'</button></th><th><button type="button" class="btn btn-xs btn-warning waves-effect waves-light"><i class="mdi mdi-clock-outline"></i> '+late_lang+'</button></th></tr></table>';
                        
                        var newLabels = [];
                        var absentData = [];
                        var lateData = [];
                        var presentData = [];
                        if (late_present_graph.length > 0) {
                            // graph data
                            late_present_graph.forEach(function (res) {
                                newLabels.push(res.date);
                                absentData.push(res.absentCount);
                                lateData.push(res.lateCount);
                                presentData.push(res.presentCount);
                            });
                        }
                        chart.updateSeries([{
                            name: present_lang,
                            type: "line",
                            data: presentData
                        }, {
                            name: late_lang,
                            type: "line",
                            data: lateData
                        }, {
                            name: absent_lang,
                            type: "line",
                            data: absentData
                        }]);
                        chart.updateOptions({
                            labels: newLabels
                        })
                    } else if(pattern == "Term"){

                        var count = response.data.count;
                        attendanceListShow += '<div class="table-responsive">' +
                            '<table class="table w-100 table-bordered mb-0">' +
                            '<thead>' +
                            '<tr>' +
                            '<th>#</th>' +
                            '<th>' + name_lang + '</th>' +
                            '<th>' + name_english_lang + '</th>' +
                            '<th>' + grade_lang + '</th>' +
                            '<th>' + class_lang + '</th>' +
                            '<th>' + semester_lang + '</th>' +
                            '<th>' + no_of_present_lang + '</th>' +
                            '<th>' + no_of_absent_lang + '</th>' +
                            '<th>' + no_of_late_lang + '</th>' +
                            '<th>' + remarks_lang + '</th>' +
                            '</tr>' +
                            '</thead>' +
                            '<tbody>';
                        if (get_attendance_list.length > 0) {
                            // add functions tr start
                            get_attendance_list.forEach(function (res) {
                                var name_english = "";
                                if(typeof(res.name_english) != "undefined" && res.name_english !== null) {
                                    name_english = res.name_english;
                                }
                                var remarks = "";
                                if(typeof(res.remarks) != "undefined" && res.remarks !== null && res.remarks != "null") {
                                    remarks = res.remarks;
                                }
                                attendanceListShow += '<tr>' +
                                    '<td>'+i+'</td >'+
                                    '<td>'+res.first_name + ' ' + res.last_name +'</td>'+
                                    '<td>' + name_english + '</td>' +
                                    '<td>' + res.class_name + '</td>' +
                                    '<td>' + res.section_name + '</td>' +
                                    '<td>' + res.semester_name + '</td>' +
                                    '<td>' + res.presentCount + '</td>' +
                                    '<td>' + res.absentCount + '</td>' +
                                    '<td>' + res.lateCount + '</td>' +
                                    '<td>' + remarks + '</td>' +
                                    '</tr>';
                                    i++;
                            });
                        } else {
                            attendanceListShow += '<tr> <td colspan="10" class="text-center">'+no_data_available +'</td></tr>';
                        }
                        attendanceListShow += '</tbody>' +
                            '</table>' +
                            '</div>';
                        countShow += '<table><tr><th style="text-align:center"> '+ total_students_lang +' : '+ count.total_students +' </th><th style="text-align:center"> '+ total_school_days_lang +' : '+ count.total_school_days +' </th><th style="text-align:center"> '+ total_holidays_lang + ': '+ count.total_holidays +' </th><table/>';
                    
                    } else if(pattern == "Year"){

                        var count = response.data.count;
                        attendanceListShow += '<div class="table-responsive">' +
                            '<table class="table w-100 table-bordered mb-0">' +
                            '<thead>' +
                            '<tr>' +
                            '<th>#</th>' +
                            '<th>' + name_lang + '</th>' +
                            '<th>' + name_english_lang + '</th>' +
                            '<th>' + grade_lang + '</th>' +
                            '<th>' + class_lang + '</th>' +
                            '<th>' + no_of_present_lang + '</th>' +
                            '<th>' + no_of_absent_lang + '</th>' +
                            '<th>' + no_of_late_lang + '</th>' +
                            '<th>' + remarks_lang + '</th>' +
                            '</tr>' +
                            '</thead>' +
                            '<tbody>';
                        if (get_attendance_list.length > 0) {
                            // add functions tr start
                            get_attendance_list.forEach(function (res) {
                                var name_english = "";
                                if(typeof(res.name_english) != "undefined" && res.name_english !== null) {
                                    name_english = res.name_english;
                                }
                                var remarks = "";
                                if(typeof(res.remarks) != "undefined" && res.remarks !== null && res.remarks != "null") {
                                    remarks = res.remarks;
                                }
                                attendanceListShow += '<tr>' +
                                    '<td>'+i+'</td >'+
                                    '<td>'+res.first_name + ' ' + res.last_name +'</td>'+
                                    '<td>' + name_english + '</td>' +
                                    '<td>' + res.class_name + '</td>' +
                                    '<td>' + res.section_name + '</td>' +
                                    '<td>' + res.presentCount + '</td>' +
                                    '<td>' + res.absentCount + '</td>' +
                                    '<td>' + res.lateCount + '</td>' +
                                    '<td>' + remarks + '</td>' +
                                    '</tr>';
                                    i++;
                            });
                        } else {
                            attendanceListShow += '<tr> <td colspan="9" class="text-center">'+no_data_available +'</td></tr>';
                        }
                        attendanceListShow += '</tbody>' +
                            '</table>' +
                            '</div>';
                        countShow += '<table><tr><th style="text-align:center"> '+ total_students_lang +' : '+ count.total_students +' </th><th style="text-align:center"> '+ total_school_days_lang +' : '+ count.total_school_days +' </th><th style="text-align:center"> '+ total_holidays_lang + ': '+ count.total_holidays +' </th><table/>';
                    
                    }
                    $("#attendanceListShow").append(attendanceListShow);
                    $("#count-show").append(countShow);

                } else {
                    toastr.error(data.message);
                }
            }
        });
    }


    function setLocalStorageForStudentAttendance(classObj) {

        var studentAttendanceReportDetails = new Object();
        studentAttendanceReportDetails.class_id = classObj.classID;
        studentAttendanceReportDetails.section_id = classObj.sectionID;
        studentAttendanceReportDetails.subject_id = classObj.subjectID;
        studentAttendanceReportDetails.semester_id = classObj.semesterID;
        studentAttendanceReportDetails.session_id = classObj.sessionID;
        studentAttendanceReportDetails.date = classObj.date;
        // here to attached to avoid localStorage other users to add
        studentAttendanceReportDetails.branch_id = branchID;
        studentAttendanceReportDetails.role_id = get_roll_id;
        studentAttendanceReportDetails.user_id = ref_user_id;
        var studentAttendanceReportClassArr = [];
        studentAttendanceReportClassArr.push(studentAttendanceReportDetails);
        if (get_roll_id == "4") {
            // teacher
            localStorage.removeItem("teacher_student_attendance_report_details");
            localStorage.setItem('teacher_student_attendance_report_details', JSON.stringify(studentAttendanceReportClassArr));
        }
        if (get_roll_id == "2") {
            // Admin
            localStorage.removeItem("admin_studentattentanceReport_details");
            localStorage.setItem('admin_studentattentanceReport_details', JSON.stringify(studentAttendanceReportClassArr));
        }
        return true;
    }


    // if localStorage
    // if (get_roll_id == "4") {
    //     // teacher
    //     if (typeof teacher_student_attendance_report_storage !== 'undefined') {
    //         if ((teacher_student_attendance_report_storage)) {
    //             if (teacher_student_attendance_report_storage) {
    //                 var teacherStudentAttendanceReportStorage = JSON.parse(teacher_student_attendance_report_storage);
    //                 if (teacherStudentAttendanceReportStorage.length == 1) {
    //                     var classID, date, sectionID, subjectID, semesterID, sessionID, userBranchID, userRoleID, userID;
    //                     teacherStudentAttendanceReportStorage.forEach(function (user) {
    //                         classID = user.class_id;
    //                         sectionID = user.section_id;
    //                         subjectID = user.subject_id;
    //                         semesterID = user.semester_id;
    //                         sessionID = user.session_id;
    //                         date = user.date;
    //                         userBranchID = user.branch_id;
    //                         userRoleID = user.role_id;
    //                         userID = user.user_id;
    //                     });
    //                     if ((userBranchID == branchID) && (userRoleID == get_roll_id) && (userID == ref_user_id)) {
    //                         $('#changeClassName').val(classID);
    //                         $('#classDate').val(date);
    //                         $('#semesterID').val(semesterID);
    //                         $('#sessionID').val(sessionID);
    //                         if (classID) {

    //                             $("#attendanceFilter").find("#sectionID").empty();
    //                             $("#attendanceFilter").find("#sectionID").append('<option value="">' + select_class + '</option>');
    //                             $.post(teacherSectionUrl, { token: token, branch_id: branchID, teacher_id: userID, class_id: classID }, function (res) {
    //                                 if (res.code == 200) {
    //                                     $.each(res.data, function (key, val) {
    //                                         $("#attendanceFilter").find("#sectionID").append('<option value="' + val.section_id + '">' + val.section_name + '</option>');
    //                                     });
    //                                     $("#attendanceFilter").find("#sectionID").val(sectionID)
    //                                 }
    //                             }, 'json');
    //                         }
    //                         if (sectionID) {
    //                             $("#attendanceFilter").find("#subjectID").empty();
    //                             $("#attendanceFilter").find("#subjectID").append('<option value="">' + select_subject + '</option>');
    //                             $.post(teacherSubjectUrl, {
    //                                 token: token,
    //                                 branch_id: branchID,
    //                                 teacher_id: userID,
    //                                 class_id: classID,
    //                                 section_id: sectionID,
    //                                 academic_session_id: academic_session_id,
    //                             }, function (res) {
    //                                 if (res.code == 200) {
    //                                     $.each(res.data, function (key, val) {
    //                                         $("#attendanceFilter").find("#subjectID").append('<option value="' + val.subject_id + '">' + val.subject_name + '</option>');
    //                                     });
    //                                     $("#attendanceFilter").find("#subjectID").val(subjectID)
    //                                 }
    //                             }, 'json');
    //                         }

    //                         var reportDate = date;
    //                         var class_id = classID;
    //                         var section_id = sectionID
    //                         var subject_id = subjectID
    //                         var semester_id = semesterID
    //                         var session_id = sessionID

    //                         var date = new Date(reportDate)
    //                         var year_month = ("0" + (date.getMonth() + 1)).slice(-2) + "-" + date.getFullYear();
    //                         //excel download

    //                         $("#excelSubject").val(subject_id);
    //                         $("#excelClass").val(class_id);
    //                         $("#excelSection").val(section_id);
    //                         $("#excelSemester").val(semester_id);
    //                         $("#excelSession").val(session_id);
    //                         $("#excelDate").val(year_month);
    //                         // pdf download
    //                         $("#downExcelSubject").val(subject_id);
    //                         $("#downExcelClass").val(class_id);
    //                         $("#downExcelSection").val(section_id);
    //                         $("#downExcelSemester").val(semester_id);
    //                         $("#downExcelSession").val(session_id);
    //                         $("#downExcelDate").val(year_month);

    //                         var formData = new FormData();
    //                         formData.append('token', token);
    //                         formData.append('branch_id', branchID);
    //                         formData.append('class_id', class_id);
    //                         formData.append('section_id', section_id);
    //                         formData.append('subject_id', subject_id);
    //                         formData.append('semester_id', semester_id);
    //                         formData.append('session_id', session_id);
    //                         formData.append('year_month', year_month);
    //                         formData.append('academic_session_id', academic_session_id);

    //                         studentAttendanceList(formData, reportDate);
    //                     }
    //                 }
    //             }
    //         }
    //     }
    // }
    // if (get_roll_id == "2") {
    //     // teacher
    //     if (typeof admin_studentattentanceReport_storage !== 'undefined') {
    //         if ((admin_studentattentanceReport_storage)) {
    //             if (admin_studentattentanceReport_storage) {
    //                 var adminStudentAttendanceReportStorage = JSON.parse(admin_studentattentanceReport_storage);
    //                 if (adminStudentAttendanceReportStorage.length == 1) {
    //                     var classID, date, sectionID, subjectID, semesterID, sessionID, userBranchID, userRoleID, userID;
    //                     adminStudentAttendanceReportStorage.forEach(function (user) {
    //                         classID = user.class_id;
    //                         sectionID = user.section_id;
    //                         subjectID = user.subject_id;
    //                         semesterID = user.semester_id;
    //                         sessionID = user.session_id;
    //                         date = user.date;
    //                         userBranchID = user.branch_id;
    //                         userRoleID = user.role_id;
    //                         userID = user.user_id;
    //                     });
    //                     if ((userBranchID == branchID) && (userRoleID == get_roll_id) && (userID == ref_user_id)) {
    //                         $('#changeClassName').val(classID);
    //                         $('#classDate').val(date);
    //                         $('#semesterID').val(semesterID);
    //                         $('#sessionID').val(sessionID);
    //                         if (classID) {

    //                             $("#attendanceFilter").find("#sectionID").empty();
    //                             $("#attendanceFilter").find("#sectionID").append('<option value="">' + select_class + '</option>');
    //                             $.post(teacherSectionUrl, { token: token, branch_id: branchID, teacher_id: userID, class_id: classID }, function (res) {
    //                                 if (res.code == 200) {
    //                                     $.each(res.data, function (key, val) {
    //                                         $("#attendanceFilter").find("#sectionID").append('<option value="' + val.section_id + '">' + val.section_name + '</option>');
    //                                     });
    //                                     $("#attendanceFilter").find("#sectionID").val(sectionID)
    //                                 }
    //                             }, 'json');
    //                         }
    //                         if (sectionID) {
    //                             $("#attendanceFilter").find("#subjectID").empty();
    //                             $("#attendanceFilter").find("#subjectID").append('<option value="">' + select_subject + '</option>');
    //                             $.post(teacherSubjectUrl, {
    //                                 token: token,
    //                                 branch_id: branchID,
    //                                 teacher_id: userID,
    //                                 class_id: classID,
    //                                 section_id: sectionID,
    //                                 academic_session_id: academic_session_id,
    //                             }, function (res) {
    //                                 if (res.code == 200) {
    //                                     $.each(res.data, function (key, val) {
    //                                         $("#attendanceFilter").find("#subjectID").append('<option value="' + val.subject_id + '">' + val.subject_name + '</option>');
    //                                     });
    //                                     $("#attendanceFilter").find("#subjectID").val(subjectID)
    //                                 }
    //                             }, 'json');
    //                         }

    //                         var reportDate = date;
    //                         var class_id = classID;
    //                         var section_id = sectionID
    //                         var subject_id = subjectID
    //                         var semester_id = semesterID
    //                         var session_id = sessionID

    //                         var date = new Date(reportDate)
    //                         var year_month = ("0" + (date.getMonth() + 1)).slice(-2) + "-" + date.getFullYear();
    //                         //excel download

    //                         $("#excelSubject").val(subject_id);
    //                         $("#excelClass").val(class_id);
    //                         $("#excelSection").val(section_id);
    //                         $("#excelSemester").val(semester_id);
    //                         $("#excelSession").val(session_id);
    //                         $("#excelDate").val(year_month);
    //                         // pdf download
    //                         $("#downExcelSubject").val(subject_id);
    //                         $("#downExcelClass").val(class_id);
    //                         $("#downExcelSection").val(section_id);
    //                         $("#downExcelSemester").val(semester_id);
    //                         $("#downExcelSession").val(session_id);
    //                         $("#downExcelDate").val(year_month);

    //                         var formData = new FormData();
    //                         formData.append('token', token);
    //                         formData.append('branch_id', branchID);
    //                         formData.append('class_id', class_id);
    //                         formData.append('section_id', section_id);
    //                         formData.append('subject_id', subject_id);
    //                         formData.append('semester_id', semester_id);
    //                         formData.append('session_id', session_id);
    //                         formData.append('year_month', year_month);
    //                         formData.append('academic_session_id', academic_session_id);

    //                         studentAttendanceList(formData, reportDate);
    //                     }
    //                 }
    //             }
    //         }
    //     }
    // }
    // studentDetails
    $(document).on('click', '.studentDetails', function () {
        var studentID = $(this).find('input').val();
        var classDate = $("#classDate").val();
        var class_id = $("#changeClassName").val();
        var section_id = $("#sectionID").val();
        var subject_id = $("#subjectID").val();

        var date = new Date(classDate)
        var year_month = ("0" + (date.getMonth() + 1)).slice(-2) + "-" + date.getFullYear();

        var formData = new FormData();
        formData.append('token', token);
        formData.append('branch_id', branchID);
        formData.append('class_id', class_id);
        formData.append('section_id', section_id);
        formData.append('subject_id', subject_id);
        formData.append('year_month', year_month);
        formData.append('student_id', studentID);
        $("#latedetails").modal('show');

        $.ajax({
            url: getReasonsByStudent,
            method: "POST",
            data: formData,
            dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success: function (response) {
                if (response.code == 200) {

                    var late_details = response.data;
                    var labels = [];
                    var resonsCount = [];
                    if (late_details.length > 0) {
                        $.each(late_details[0], function (key, value) {

                            labels.push(key);
                            resonsCount.push(value);
                        });
                    }
                    // chart
                    renderChart(labels, resonsCount);

                } else {
                    toastr.error(data.message);
                }

            }, error: function (err) {
                if (err.responseJSON.code == 422) {
                    toastr.error(err.responseJSON.data.error.profile_image[0] ? err.responseJSON.data.error.profile_image[0] : 'Something went wrong');
                }
            }
        })

    });

    function renderChart(labels, resonsCount) {

        if (reasonChart) {
            reasonChart.data.labels = labels;
            reasonChart.data.datasets[0].data = resonsCount;
            reasonChart.update();
        } else {
            var ctx = document.getElementById("reason-chart").getContext('2d');
            var defaultColors = ["#1abc9c", "#f1556c", "#4a81d4", "#e3eaef"];
            var colors = dataColors ? dataColors.split(",") : defaultColors.concat();

            reasonChart = new Chart(ctx, {
                type: 'radar',
                data: {
                    // labels: ["Fever", "Bus Breakdown", "Book Missing", "Others"],
                    labels: labels,
                    datasets: [{
                        label: "Reasons",
                        backgroundColor: hexToRGB(colors[0], 0.3),
                        borderColor: colors[0],
                        pointBackgroundColor: colors[0],
                        pointBorderColor: "#fff",
                        pointHoverBackgroundColor: "#fff",
                        pointHoverBorderColor: colors[0],
                        data: resonsCount
                    }]
                },
            });
        }


    }
    function hexToRGB(hex, alpha) {
        var r = parseInt(hex.slice(1, 3), 16),
            g = parseInt(hex.slice(3, 5), 16),
            b = parseInt(hex.slice(5, 7), 16);

        if (alpha) {
            return "rgba(" + r + ", " + g + ", " + b + ", " + alpha + ")";
        } else {
            return "rgb(" + r + ", " + g + ", " + b + ")";
        }
    }



    // Employee Attendance


    $(document).on('change', ".status", function (e) {
        e.preventDefault();
        var status = $(this).val();

        if (status == "absent") {
            $(this).closest('tr').find('.checkin').val("");
            $(this).closest('tr').find('.checkout').val("");
            $(this).closest('tr').find('.hours').val("");

            $(this).closest('tr').find('.checkin').prop('readonly', true);
            $(this).closest('tr').find('.checkout').prop('readonly', true);
            $(this).closest('tr').find('.hours').prop('readonly', true);

        } else {
            if (status == "present") {
                $(this).closest('tr').find('.checkin').val(employee_check_in_time);
                $(this).closest('tr').find('.checkout').val(employee_check_out_time);

                var valuein = moment.duration(employee_check_in_time, 'HH:mm');
                var valueout = moment.duration(employee_check_out_time, 'HH:mm');
                var difference = valueout.subtract(valuein);

                var hours = ("0" + difference.hours()).slice(-2) + ":" + ("0" + difference.minutes()).slice(-2);
                $(this).closest('tr').find('.hours').val(hours);
            }
            $(this).closest('tr').find('.checkin').prop('readonly', false);
            $(this).closest('tr').find('.checkout').prop('readonly', false);
            $(this).closest('tr').find('.hours').prop('readonly', false);
        }

        var reason = $(this).closest('tr').find('.reason');
        reason.empty();
        reason.append('<option value="">' + select_reason + '</option>');
        $.post(getTeacherAbsentExcuse, {
            token: token,
            branch_id: branchID,
            status: status
        }, function (res) {
            if (res.code == 200) {
                $.each(res.data, function (key, val) {
                    reason.append('<option value="' + val.id + '">' + val.name + '</option>');
                });
            }
        }, 'json');
    });

    $(document).on('change', ".checkin", function (e) {
        e.preventDefault();
        var checkin = $(this).val();
        var checkout = $(this).closest('tr').find('.checkout').val();

        if (checkout) {
            var valuein = moment.duration(checkin, 'HH:mm');
            var valueout = moment.duration(checkout, 'HH:mm');
            if (valuein < valueout) {
                var difference = valueout.subtract(valuein);

                var hours = ("0" + difference.hours()).slice(-2) + ":" + ("0" + difference.minutes()).slice(-2);
                $(this).closest('tr').find('.hours').val(hours);
            } else {
                $(this).closest('tr').find('.checkin').val("");
                $(this).closest('tr').find('.hours').val("");
                alert('Check In Value Must be Lesser Than Check Out')
            }

        }
    });

    $(document).on('change', ".checkout", function (e) {
        e.preventDefault();
        var checkout = $(this).val();
        var checkin = $(this).closest('tr').find('.checkin').val();

        if (checkin) {
            var valuein = moment.duration(checkin, 'HH:mm');
            var valueout = moment.duration(checkout, 'HH:mm');
            if (valuein < valueout) {
                var difference = valueout.subtract(valuein);

                var hours = ("0" + difference.hours()).slice(-2) + ":" + ("0" + difference.minutes()).slice(-2);
                $(this).closest('tr').find('.hours').val(hours);
            } else {
                $(this).closest('tr').find('.checkout').val("");
                $(this).closest('tr').find('.hours').val("");
                alert('Check Out Value Must be Greater Than Check In')
            }

        }
    });

    // $("#department").on('change', function (e) {
    //     e.preventDefault(); 
    //     var department = $(this).val();
    //     $("#employee").empty();
    //     $("#employee").append('<option value="">'+select_employee+'</option>');
    //     $.post(employeeByDepartment, { token: token, branch_id: branchID, department_id: department }, function (res) {
    //         if (res.code == 200) {
    //             $.each(res.data, function (key, val) {
    //                 $("#employee").append('<option value="' + val.id + '">' + val.first_name + ' ' + val.last_name + '</option>');
    //             });
    //         }
    //     }, 'json');
    // });

    // $("#employeeReportDepartment").on('change', function (e) {
    //     e.preventDefault(); 
    //     var department = $(this).val();
    //     $("#employeeReportEmployee").empty();
    //     $("#employeeReportEmployee").append('<option value="">'+select_employee+'</option>');
    //     $("#employeeReportEmployee").append('<option value="All">All</option>');
    //     $.post(employeeByDepartment, { token: token, branch_id: branchID, department_id: department }, function (res) {
    //         if (res.code == 200) {
    //             $.each(res.data, function (key, val) {
    //                 $("#employeeReportEmployee").append('<option value="' + val.id + '">' + val.first_name + ' ' + val.last_name + '</option>');
    //             });
    //         }
    //     }, 'json');
    // });


    $("#employee_attendance_widget").hide();
    $("#employee_attendance_report").hide();

    // rules validation
    $("#employeeAttendanceReport").validate({
        rules: {
            date: "required",
            session_id: "required",
        }
    });

    $('#employeeAttendanceReport').on('submit', function (e) {
        e.preventDefault();
        var check = $("#employeeAttendanceReport").valid();
        if (check === true) {

            var reportDate = $("#employeeReportDate").val();
            var employee = $("#employeeReportEmployee").val();
            var session = $("#employeeReportSession").val();
            // var department = $("#employeeReportDepartment").val();

            var date = new Date(reportDate)
            var year_month = ("0" + (date.getMonth() + 1)).slice(-2) + "-" + date.getFullYear();

            //excel download
            $("#excelEmployee").val(employee);
            $("#excelSession").val(session);
            $("#excelDate").val(year_month);



            var classObj = {
                employee: employee,
                date: reportDate,
                sessionID: session,
                academic_session_id: academic_session_id,
                userID: userID,
            };

            setLocalStorageForEmployeeAttendanceReport(classObj);
            var formData = new FormData();
            formData.append('token', token);
            formData.append('branch_id', branchID);
            formData.append('employee', employee);
            formData.append('session', session);
            // formData.append('department', department);
            formData.append('date', year_month);

            employeeAttendanceReportList(formData, reportDate);
        }

    });
    function employeeAttendanceReportList(formData, reportDate) {
        var date = new Date(reportDate)
        // var date = new Date();
        var firstDay = new Date(date.getFullYear(), date.getMonth(), 1);
        var firstDayTd = new Date(date.getFullYear(), date.getMonth(), 1);
        var lastDay = new Date(date.getFullYear(), date.getMonth() + 1, 0);
        var days = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
        $.ajax({
            url: getEmployeAttendanceReportList,
            method: 'post',
            data: formData,
            processData: false,
            dataType: 'json',
            contentType: false,
            success: function (response) {

                if (response.code == 200) {

                    $("#employee_attendance_widget").show();
                    $("#employee_attendance_report").show();

                    var get_attendance_list = response.data.staff_details;
                    // var late_present_graph = response.data.late_present_graph;
                    // pdf download
                    $("#downExcelEmployee").val(employee);
                    $("#downExcelSession").val(session);
                    $("#downExcelDate").val(year_month);

                    $("#employeeAttendanceReportListShow").empty(attendanceListShow);
                    var attendanceListShow = "";
                    var widgetpresent = 0;
                    var widgetabsent = 0;
                    var widgetlate = 0;
                    var widgetexcused = 0;
                    var i = 1;
                    if (get_attendance_list.length > 0) {
                        attendanceListShow += '<div class="table-responsive">' +
                            '<table id="attnList" class="table table-bordered mb-0">' +
                            '<thead>' +
                            '<tr>' +
                            '<th>' + session_lang + '</th><th>' + name_lang + '</th>';
                        // '<th>' + get_attendance_list.first_name + '' + get_attendance_list.last_name + '</th>';
                        for (var d = firstDay; d <= lastDay; d.setDate(d.getDate() + 1)) {
                            // daysOfYear.push(new Date(d));
                            var ds = new Date(d);
                            var dayName = days[ds.getDay()];
                            attendanceListShow += '<th>' + dayName + '<br>' + (i++) + '</th>';
                        }

                        attendanceListShow += '<th>' + total_lang + '<br>' + present_lang + '</th>' +
                            '<th>' + total_lang + '<br>' + absent_lang + '</th>' +
                            '<th>' + total_lang + '<br>' + late_lang + '</th>' +
                            '<th>' + total_lang + '<br>' + excused_lang + '</th>' +
                            '</tr>' +
                            '</thead>' +
                            '<tbody>';
                        // add functions tr start
                        get_attendance_list.forEach(function (res) {

                            var cur_session = "";
                            if (res.session_name == "Morning") {
                                var cur_session = morning_lang;
                            }
                            attendanceListShow += '<tr>' +
                                '<td>' + cur_session + '</td>' +
                                '<td class="text-left staffRow">' +
                                '<a class="nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light staffDetails" href="javascript:void(0)" role="button" aria-haspopup="false" aria-expanded="false">' +
                                '<input type="hidden" value="' + res.staff_id + '">';
                            // '<a class="nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light" data-toggle="modal" data-target="#latedetails" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">' +
                            if (res.photo) {
                                attendanceListShow += '<img src="' + staffImg + '/' + res.photo + '" alt="user-image" class="rounded-circle">';
                            } else {
                                attendanceListShow += '<img src="' + defaultImg + '" alt="user-image" class="rounded-circle">';
                            }
                            attendanceListShow += '</a>' + res.first_name + ' ' + res.last_name + '</td>';

                            var attendance_details = res.attendance_details;

                            for (var s = firstDayTd; s <= lastDay; s.setDate(s.getDate() + 1)) {
                                // daysOfYear.push(new Date(d));
                                var currentDate = formatDate(new Date(s));

                                var i = 0;
                                attendance_details.forEach(function (res) {

                                    if (currentDate == res.date) {
                                        var color = "";
                                        if (res.status == "present") {
                                            color = "btn-success";
                                        }
                                        if (res.status == "absent") {
                                            color = "btn-danger";
                                        }
                                        if (res.status == "late") {
                                            color = "btn-warning";
                                        }
                                        if (res.status == "excused") {
                                            color = "btn-info";
                                        }
                                        attendanceListShow += '<td>' +
                                            '<input type="hidden" value="' + res.status + '" ></input>' +
                                            '<button type="button" class="btn btn-xs ' + color + ' waves-effect waves-light"><i class="mdi mdi-check"></i></button>' +
                                            '</td>';
                                        i = 1;
                                    }

                                });
                                if (i == 0) {
                                    attendanceListShow += '<td style="background-color: #ddd; cursor: not-allowed;"></td>';
                                    i = 1;
                                }
                            }
                            firstDayTd = new Date(date.getFullYear(), date.getMonth(), 1);

                            attendanceListShow += '<td>' + res.presentCount + '</td>' +
                                '<td>' + res.absentCount + '</td>' +
                                '<td>' + res.lateCount + '</td>' +
                                '<td>' + res.excusedCount + '</td>' +
                                '</tr>';

                            widgetpresent += res.presentCount;
                            widgetabsent += res.absentCount;
                            widgetlate += res.lateCount;
                            widgetexcused += res.excusedCount;
                        });

                        // add functions tr end
                        attendanceListShow += '</tbody>' +
                            '</table>' +
                            '</div>';
                    } else {
                        attendanceListShow += '<div class="row">' +
                            '<div class="col-md-12 text-center">' +
                            no_data_available +
                            '</div>'
                        '</div>';
                    }
                    $("#widget-present").text(widgetpresent);
                    $("#widget-absent").text(widgetabsent);
                    $("#widget-late").text(widgetlate);
                    $("#widget-excused").text(widgetexcused);
                    $("#employeeAttendanceReportListShow").append(attendanceListShow);
                    // var newLabels = [];
                    // var absentData = [];
                    // var lateData = [];
                    // var presentData = [];
                    // if (late_present_graph.length > 0) {
                    //     // graph data
                    //     late_present_graph.forEach(function (res) {
                    //         newLabels.push(res.date);
                    //         absentData.push(res.absentCount);
                    //         lateData.push(res.lateCount);
                    //         presentData.push(res.presentCount);
                    //     });
                    // }
                    // chart.updateSeries([{
                    //     name: "PRESENT",
                    //     type: "line",
                    //     data: presentData
                    // }, {
                    //     name: "LATE",
                    //     type: "line",
                    //     data: lateData
                    // }, {
                    //     name: "Absent",
                    //     type: "line",
                    //     data: absentData
                    // }]);
                    // chart.updateOptions({
                    //     labels: newLabels
                    // })

                } else {
                    toastr.error(data.message);
                }
            }
        });

    }

    function setLocalStorageForEmployeeAttendanceReport(classObj) {

        var employeeAttendanceDetails = new Object();
        employeeAttendanceDetails.date = classObj.date;
        employeeAttendanceDetails.employee = classObj.employee;
        employeeAttendanceDetails.session_id = classObj.sessionID;
        // here to attached to avoid localStorage other users to add
        employeeAttendanceDetails.branch_id = branchID;
        employeeAttendanceDetails.role_id = get_roll_id;
        employeeAttendanceDetails.user_id = ref_user_id;
        var employeeAttendanceClassArr = [];
        employeeAttendanceClassArr.push(employeeAttendanceDetails);
        if (get_roll_id == "4") {
            // teacher
            localStorage.removeItem("teacher_employee_attendance_report_details");
            localStorage.setItem('teacher_employee_attendance_report_details', JSON.stringify(employeeAttendanceClassArr));
        }
        return true;
    }
    // if localStorage
    if (typeof teacher_employee_attendance_report_storage !== 'undefined') {
        if ((teacher_employee_attendance_report_storage)) {
            if (teacher_employee_attendance_report_storage) {
                var teacherEmployeeAttendanceReportStorage = JSON.parse(teacher_employee_attendance_report_storage);
                if (teacherEmployeeAttendanceReportStorage.length == 1) {
                    var employee, date, sessionID, userBranchID, userRoleID, userID;
                    teacherEmployeeAttendanceReportStorage.forEach(function (user) {
                        employee = user.employee;
                        date = user.date;
                        sessionID = user.session_id;
                        userBranchID = user.branch_id;
                        userRoleID = user.role_id;
                        userID = user.user_id;
                    });
                    if ((userBranchID == branchID) && (userRoleID == get_roll_id) && (userID == ref_user_id)) {
                        $('#employeeReportDate').val(date);
                        $('#employeeReportSession').val(sessionID);

                        var reportDate = date;
                        var employee = employee;
                        var session = sessionID;
                        // var department = $("#employeeReportDepartment").val();

                        var date = new Date(reportDate)
                        var year_month = ("0" + (date.getMonth() + 1)).slice(-2) + "-" + date.getFullYear();

                        //excel download
                        $("#excelEmployee").val(employee);
                        $("#excelSession").val(session);
                        $("#excelDate").val(year_month);

                        var formData = new FormData();
                        formData.append('token', token);
                        formData.append('branch_id', branchID);
                        formData.append('employee', employee);
                        formData.append('session', session);
                        // formData.append('department', department);
                        formData.append('date', year_month);

                        employeeAttendanceReportList(formData, reportDate);

                    }
                }
            }
        }
    }
    // $("#employeeDate").datepicker({
    //     dateFormat: 'MM yy',
    //     changeMonth: true,
    //     changeYear: true,
    //     showButtonPanel: true,

    //     onClose: function(dateText, inst) {
    //         var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
    //         var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
    //         $(this).val($.datepicker.formatDate('MM yy', new Date(year, month, 1)));
    //     }
    // });

    // $("#employeeDate").focus(function () {
    //     $(".ui-datepicker-calendar").hide();
    //     $("#ui-datepicker-div").position({
    //         my: "center top",
    //         at: "center bottom",
    //         of: $(this)
    //     });
    // });

    var count = 0;
    $("#employeeAttendanceFilter").validate({
        rules: {
            date: "required",
            session_id: "required",
        }
    });
    // add designation
    $('#employeeAttendanceFilter').on('submit', function (e) {
        e.preventDefault();
        var filterCheck = $("#employeeAttendanceFilter").valid();
        if (filterCheck === true) {

            var reportDate = $("#employeeDate").val();
            var employee = $("#employee").val();
            var session_id = $("#session_id").val();

            var classObj = {
                date: reportDate,
                sessionID: session_id
            };
            setLocalStorageEmployeeAttendanceTeacher(classObj);

            var date = new Date(reportDate);

            var firstDay = new Date(date.getFullYear(), date.getMonth(), 1);
            var lastDay = new Date(date.getFullYear(), date.getMonth() + 1, 0);

            var formData = new FormData();
            formData.append('token', token);
            formData.append('branch_id', branchID);
            formData.append('employee', employee);
            formData.append('session_id', session_id);

            formData.append('firstDay', formatDate(new Date(firstDay)));
            formData.append('lastDay', formatDate(new Date(lastDay)));

            $("#employee_attendance").hide("slow");
            $("#employee_attendance_body").empty();
            $("#employee_form_employee").val(employee);
            $("#employee_form_session_id").val(session_id);

            getEmployeeAttendanceList(formData)
        }
    });

    function getEmployeeAttendanceList(formData) {
        $.ajax({
            url: getEmployeAttendanceList,
            method: 'post',
            data: formData,
            processData: false,
            dataType: 'json',
            contentType: false,
            success: function (data) {
                if (data.code == 200) {
                    $("#employee_attendance").show("slow");
                    callout(data.data)
                }
            }
        });
    }


    function setLocalStorageEmployeeAttendanceTeacher(classObj) {

        var employeeAttendanceDetails = new Object();
        employeeAttendanceDetails.date = classObj.date;
        employeeAttendanceDetails.session_id = classObj.sessionID;
        // here to attached to avoid localStorage other users to add
        employeeAttendanceDetails.branch_id = branchID;
        employeeAttendanceDetails.role_id = get_roll_id;
        employeeAttendanceDetails.user_id = ref_user_id;
        var employeeAttendanceClassArr = [];
        employeeAttendanceClassArr.push(employeeAttendanceDetails);
        if (get_roll_id == "4") {
            // teacher
            localStorage.removeItem("teacher_employee_attendance_details");
            localStorage.setItem('teacher_employee_attendance_details', JSON.stringify(employeeAttendanceClassArr));
        }
        return true;
    }


    $(document).ready(function () {
        // Function to get a value from local storage if not present
        function getValueFromLocalStorage(t_e_atten_details, s_e_atten_report_details, s_e_atten_details, t_s_atten_report_details, t_e_atten_report_details) {
            // Check if the value exists in local storage
            if (localStorage.getItem(t_e_atten_details) == null) {
                const monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
                const d = new Date();
                $("#employeeDate").val(monthNames[d.getMonth()] + " " + d.getFullYear());
            }
            if (localStorage.getItem(s_e_atten_report_details) == null) {
                const monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
                const d = new Date();
                $("#employeeReportDate").val(monthNames[d.getMonth()] + " " + d.getFullYear());
            }
            if (localStorage.getItem(s_e_atten_details) == null) {
                const monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
                const d = new Date();
                //$("#employeeDate").val(monthNames[d.getMonth()] + " " + d.getFullYear());
            }
            if (localStorage.getItem(t_s_atten_report_details) == null) {
                const monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
                const d = new Date();
                $("#classDate").val(monthNames[d.getMonth()] + " " + d.getFullYear());
            }
            if (localStorage.getItem(t_e_atten_report_details) == null) {
                const monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
                const d = new Date();
                $("#employeeReportDate").val(monthNames[d.getMonth()] + " " + d.getFullYear());
            }
        }

        // Usage example:
        const local_key1 = 'teacher_employee_attendance_details';
        const local_key2 = 'staff_emp_attentancereport_details';
        const local_key3 = 'staff_emp_attentance_details';
        const local_key4 = 'teacher_student_attendance_report_details';
        const local_key5 = 'teacher_employee_attendance_report_details';
        const value = getValueFromLocalStorage(local_key1, local_key2, local_key3, local_key4, local_key5);
    });



    /*$( document ).ready(function() {
        const monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
        const d = new Date();
        $("#classDate").val(monthNames[d.getMonth()] + " " + d.getFullYear());
    });*/




    // if localStorage 
    if (typeof teacher_employee_attendance_storage !== 'undefined') {
        if ((teacher_employee_attendance_storage)) {
            if (teacher_employee_attendance_storage) {
                var teacherEmployeeAttendanceStorage = JSON.parse(teacher_employee_attendance_storage);
                if (teacherEmployeeAttendanceStorage.length == 1) {
                    var classID, sectionID, subjectID, studentID, semesterID, sessionID, userBranchID, userRoleID, userID;
                    teacherEmployeeAttendanceStorage.forEach(function (user) {
                        date = user.date;
                        sessionID = user.session_id;
                        userBranchID = user.branch_id;
                        userRoleID = user.role_id;
                        userID = user.user_id;
                    });
                    if ((userBranchID == branchID) && (userRoleID == get_roll_id) && (userID == ref_user_id)) {
                        $('#session_id').val(sessionID);
                        $('#employeeDate').val(date);

                        var reportDate = date;
                        var employee = userID;
                        var session_id = sessionID;

                        var date = new Date(reportDate);

                        var firstDay = new Date(date.getFullYear(), date.getMonth(), 1);
                        var lastDay = new Date(date.getFullYear(), date.getMonth() + 1, 0);

                        var formData = new FormData();
                        formData.append('token', token);
                        formData.append('branch_id', branchID);
                        formData.append('employee', employee);
                        formData.append('session_id', session_id);

                        formData.append('firstDay', formatDate(new Date(firstDay)));
                        formData.append('lastDay', formatDate(new Date(lastDay)));

                        $("#employee_attendance").hide("slow");
                        $("#employee_attendance_body").empty();
                        $("#employee_form_employee").val(employee);
                        $("#employee_form_session_id").val(session_id);

                        getEmployeeAttendanceList(formData)
                    }
                }
            }
        }
    }

    // add Employee Attendance
    $('#addEmployeeAttendanceForm').on('submit', function (e) {
        e.preventDefault();
        // $("#overlay").fadeIn(300);
        var form = this;
        $.ajax({
            url: $(form).attr('action'),
            method: $(form).attr('method'),
            data: new FormData(form),
            processData: false,
            dataType: 'json',
            contentType: false,
            success: function (data) {
                if (data.code == 200) {
                    toastr.success(data.message);
                    // $("#overlay").fadeOut(300);
                } else {
                    toastr.error(data.message);
                    // $("#overlay").fadeOut(300);
                }
            }
        });
    });

    function callout(data) {
        $.each(data, function (key, val) {
            var row = "";
            var disabled = "";
            var holiday = "";
            var color = "";
            var fontColor = "";
            if (val.holiday == 1) {
                var color = "#D3D3D3";
                var holiday = "";
                fontColor = "color: red";
            }
            row += '<tr id="row' + count + '" style="background-color:' + color + '"> ';
            if (val.details.id) {
                row += '<input type="hidden" name="attendance[' + count + '][id]" value="' + val.details.id + '"' + holiday + '>';
            } else {
                row += '<input type="hidden" name="attendance[' + count + '][id]" value="">' + holiday + '';
            }
            row += '<td width="15%">';
            row += '<div class="form-group">';
            row += '<input type="text" name="attendance[' + count + '][date]" class="form-control" value="' + val.date + '"' + holiday + '>';
            row += '</div>';
            row += '</td>';
            row += '<td width="10%">';
            row += '<div class="form-group">';
            row += '<select  class="form-control status"  name="attendance[' + count + '][status]"' + holiday + '>';
            row += '<option value="">' + select_status + '</option>';
            if (val.leave) {
                row += '<option value="present">' + present_lang + '</option>';
                row += '<option value="absent" ' + (val.leave.leave_type == "absent" ? "selected" : "") + '>' + absent_lang + '</option>';
                row += '<option value="late">' + late_lang + '</option>';
                row += '<option value="excused" ' + (val.leave.leave_type == "excused" ? "selected" : "") + '>' + excused_lang + '</option>';
                disabled = "readonly";
            } else {
                row += '<option value="present" ' + (val.details.status == "present" ? "selected" : "") + '>' + present_lang + '</option>';
                row += '<option value="absent"' + (val.details.status == "absent" ? "selected" : "") + '>' + absent_lang + '</option>';
                row += '<option value="late"' + (val.details.status == "late" ? "selected" : "") + '>' + late_lang + '</option>';
                row += '<option value="excused"' + (val.details.status == "excused" ? "selected" : "") + '>' + excused_lang + '</option>';
            }
            row += '</select>';
            row += '</div>';
            row += '</td>';
            row += '<td width="10%">';
            row += '<div class="form-group">';
            row += '<input class="form-control checkin" style="' + fontColor + '" type="time" name="attendance[' + count + '][check_in]"  value="' + moment(val.details.check_in, 'HH:mm:ss').format('HH:mm') + '" ' + disabled + '' + holiday + '> ';
            row += '</div>';
            row += '</td>';
            row += '<td width="10%">';
            row += '<div class="form-group">';
            row += '<input class="form-control checkout" style="' + fontColor + '" type="time" name="attendance[' + count + '][check_out]" value="' + moment(val.details.check_out, 'HH:mm:ss').format('HH:mm') + '" ' + disabled + '' + holiday + '>';
            row += '</div>';
            row += '</td>';
            row += '<td width="10%">';
            row += '<div class="form-group">';
            if (val.details.hours) {
                row += '<input type="text" style="' + fontColor + '" name="attendance[' + count + '][hours]" class="form-control hours" value="' + val.details.hours + '" ' + disabled + ' ' + holiday + '>';
            } else {
                row += '<input type="text" style="' + fontColor + '" name="attendance[' + count + '][hours]" class="form-control hours" value="" ' + disabled + '' + holiday + '>';
            }
            row += '</div>';
            row += '</td>';
            row += '<td width="15%">';
            row += '<div class="form-group">';
            row += '<select  class="form-control reason"  name="attendance[' + count + '][reason_id]"' + holiday + '>';
            row += '<option value="">' + select_reason + 's</option>';
            if (val.leave) {
                var reason = val.leave.reason_id;
                var status = "absent";
            } else {
                var reason = val.details.reason_id;
                var status = val.details.status;
            }
            if (status == "absent") {
                $.each(val.absent_reason, function (keys, val_rea) {
                    row += '<option value="' + val_rea.id + '" ' + (reason == val_rea.id ? "selected" : "") + '>' + val_rea.name + '</option>';
                });
            } else if (status == "excused") {
                $.each(val.excused_reason, function (keys, val_rea) {
                    row += '<option value="' + val_rea.id + '" ' + (reason == val_rea.id ? "selected" : "") + '>' + val_rea.name + '</option>';
                });
            }
            row += '</select>';
            row += '</div>';
            row += '</td>';
            row += '<td width="15%">';

            if (val.leave) {
                row += '<input type="remarks" name="attendance[' + count + '][remarks]" class="form-control" value="' + val.leave.remarks + '"' + holiday + '>';
            } else {
                if (val.details.remarks) {
                    row += '<input type="remarks" name="attendance[' + count + '][remarks]" class="form-control" value="' + val.details.remarks + '"' + holiday + '>';
                } else {
                    row += '<input type="remarks" name="attendance[' + count + '][remarks]" class="form-control" value=""' + holiday + '>';
                }
            }
            row += '</td>';
            row += '</tr>';

            count++;

            $("#employee_attendance_body").append(row);
        });
    }
});