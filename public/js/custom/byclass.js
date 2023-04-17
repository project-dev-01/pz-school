$(function () {
    $("#byclass_analysis").hide();
    // change class name
    $('#changeClassName').on('change', function () {
        var class_id = $(this).val();
        $("#byclassfilter").find("#subjectID").empty();
        $("#byclassfilter").find("#subjectID").append('<option value="">'+select_subject+'</option>');
        $("#byclassfilter").find("#examnames").empty();
        $("#byclassfilter").find("#examnames").append('<option value="">'+select_exam+'</option>');
        $.post(getbySubjectnames, { token: token, branch_id: branchID, class_id: class_id, teacher_id: teacher_id, academic_session_id: academic_session_id }, function (res) {
            if (res.code == 200) {
                $.each(res.data, function (key, val) {
                    $("#byclassfilter").find("#subjectID").append('<option value="' + val.subject_id + '">' + val.subject_name + '</option>');
                });
            }
        }, 'json');
    });
    // change section
    $('#subjectID').on('change', function () {
        var subject_id = $(this).val();
        var class_id = $("#changeClassName").val();
        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
        var yyyy = today.getFullYear();
        today = yyyy + '-' + mm + '-' + dd;
        $("#byclassfilter").find("#examnames").empty();
        $("#byclassfilter").find("#examnames").append('<option value="">'+select_exam+'</option>');
        $.post(examsByclassandsubject, {
            token: token,
            branch_id: branchID,
            class_id: class_id,
            subject_id: subject_id,
            today: today,
            academic_session_id: academic_session_id
        }, function (res) {
            if (res.code == 200) {
                $.each(res.data, function (key, val) {
                    $("#byclassfilter").find("#examnames").append('<option value="' + val.id + '">' + val.name + '</option>');
                });
            }
        }, 'json');
    });
    $("#byclassfilter").validate({
        rules: {
            year: "required",
            class_id: "required",
            subject_id: "required",
            exam_id: "required"
        }
    });
    $('#byclassfilter').on('submit', function (e) {
        e.preventDefault();

        var byclass = $("#byclassfilter").valid();
        if (byclass === true) {

            $("#overlay").fadeIn(300);
            var year = $("#btwyears").val();
            var class_id = $("#changeClassName").val();
            var subject_id = $("#subjectID").val();
            var semester_id = $("#semester_id").val();
            var session_id = $("#session_id").val();
            var exam_id = $("#examnames").val();
            // list mode
            $.post(getbyClass, {
                token: token,
                branch_id: branchID,
                exam_id: exam_id,
                class_id: class_id,
                semester_id: semester_id,
                session_id: session_id,
                subject_id: subject_id,
                academic_year: year
            }, function (response) {

                if (response.code == 200) {
                    if (response.data.allbysubject.length > 0) {
                        var datasetnew = response.data;
                        bysubjectdetails(datasetnew);
                        // download set start
                        $("#downExamID").val(exam_id);
                        $("#downClassID").val(class_id);
                        $("#downSemesterID").val(semester_id);
                        $("#downSessionID").val(session_id);
                        $("#downSubjectID").val(subject_id);
                        $("#downAcademicYear").val(year);
                        // download set end
                        $("#overlay").fadeOut(300);
                        $("#byclass_bodycontent").show();
                    } else {
                        $("#overlay").fadeOut(300);
                        toastr.info('No records are available');
                    }
                } else {
                    toastr.error(data.message);
                    $('#byclass_bodycontent').hide();
                }

            });

        };
    });
    // export excel
    $(document).on('click', '.exportToExcel', function (e) {
        // var table = $(this).prev('.table2excel');
        var table = $('.table2excel');
        if (table && table.length) {
            var preserveColors = (table.hasClass('table2excel_with_colors') ? true : false);
            $(table).table2excel({
                // exclude: ".noExl",
                name: "By Class",
                filename: "by_class" + new Date().toISOString().replace(/[\-\:\.]/g, "") + ".xls",
                fileext: ".xls",
                exclude_img: true,
                exclude_links: true,
                exclude_inputs: true,
                preserveColors: preserveColors
            });
        }
    });

});

///
function bysubjectdetails(datasetnew) {

    $('#byclassTableAppend').empty();
    var sno = 0;
    var bysubjectAllTable = "";
    var headers = datasetnew.headers;
    var allbysubject = datasetnew.allbysubject;
    bysubjectAllTable += '<div class="table-responsive">' +
        '<table id="tblbycls" class="table w-100 nowrap table-bordered table-striped table2excel">' +
        '<thead>' +
        '<tr>' +
        '<th class="align-top" rowspan="2">'+sl_no_lang+'</th>' +
        '<th class="align-top" rowspan="2">'+grade_lang+'</th>' +
        '<th class="align-top th-sm - 6 rem" rowspan="2">'+total_student_lang+'</th>' +
        '<th class="align-top" rowspan="2">'+absent_lang+'</th>' +
        '<th class="align-top" rowspan="2">'+present_lang+'</th>' +
        '<th class="align-top" rowspan="2">'+class_teacher_name_lang+'</th>';
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
    allbysubject.forEach(function (res) {
        sno++;
        bysubjectAllTable += '<tr>' +
            '<td class="text-center" rowspan="2">';
        bysubjectAllTable += sno +
            '</td>';
        bysubjectAllTable += '<td class="text-left" rowspan="2">' +
            '<label for="clsname">' + res.name + "(" + res.section_name + ")" + '</label>' +
            '</td>';
        bysubjectAllTable += '<td class="text-center" rowspan="2">' +
            '<label for="stdcount"> ' + res.totalstudentcount + '</label>' +
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
    $("#byclassTableAppend").append(bysubjectAllTable);
}
// find matched
function isKey(key, obj) {
    var keys = Object.keys(obj).map(function (x) {
        return x;
    });
    return keys.indexOf(key) !== -1;
}  