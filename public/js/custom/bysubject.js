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
            year: "required",
            class_id: "required",
            section_id: "required",
            examnames: "required"
        }
    });
    $('#bysubjectfilter').on('submit', function (e) {
        e.preventDefault();
        var byclass = $("#bysubjectfilter").valid();
        if (byclass === true) {
            $("#overlay").fadeIn(300);
            var year = $("#btwyears").val();
            var semester_id = $("#semester_id").val();
            var session_id = $("#session_id").val();
            var class_id = $("#changeClassName").val();
            var section_id = $("#sectionID").val();
            var exam_id = $("#examnames").val();
            // list mode
            $.post(getbySubject, {
                token: token,
                branch_id: branchID,
                exam_id: exam_id,
                class_id: class_id,
                section_id: section_id,
                semester_id: semester_id,
                session_id: session_id,
                academic_year: year
            }, function (response) {
                if (response.code == 200) {
                    if (response.data.grade_list_master.length > 0) {
                        var datasetnew = response.data;
                        bysubjectdetails_class(datasetnew);
                        // download set start
                        $("#downExamID").val(exam_id);
                        $("#downClassID").val(class_id);
                        $("#downSemesterID").val(semester_id);
                        $("#downSessionID").val(session_id);
                        $("#downSectionID").val(section_id);
                        $("#downAcademicYear").val(year);
                        // download set end
                        $("#overlay").fadeOut(300);
                        $("#bysubject_body").show("slow");
                    } else {
                        $("#overlay").fadeOut(300);
                        toastr.info('No records are available');
                    }
                } else {
                    toastr.error(data.message);
                    $('#bysubject_body').hide();
                }

            });
        };
    });


    $(document).on('click', '.exportToExcel', function (e) {
        // var table = $(this).prev('.table2excel');
        var table = $('.table2excel');
        if (table && table.length) {
            var preserveColors = (table.hasClass('table2excel_with_colors') ? true : false);
            $(table).table2excel({
                // exclude: ".noExl",
                name: "By Subject",
                filename: "by_subjects" + new Date().toISOString().replace(/[\-\:\.]/g, "") + ".xls",
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