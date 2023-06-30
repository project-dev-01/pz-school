$(function () {
    // $("#analysis_graph").hide();
    // change classroom
    // $('#changeClassName').on('change', function () {
    //     var class_id = $(this).val();
    //     console.log(class_id);
    //     if (class_id != "All") {
    //         $("#byoverallfilter").find("#sectionID").empty();
    //         $("#byoverallfilter").find("#sectionID").append('<option value="">'+select_subject+'</option>');

    //         $.post(getbySubjectnames, { token: token, branch_id: branchID, class_id: class_id }, function (res) {
    //             if (res.code == 200) {
    //                 $("#section_drp_div").show();
    //                 $.each(res.data, function (key, val) {
    //                     $("#byoverallfilter").find("#sectionID").append('<option value="' + val.subject_id + '">' + val.subject_name + '</option>');
    //                 });
    //             }
    //         }, 'json');
    //     }
    //     else if (class_id == "All") {
    //         $("#byoverallfilter").find("#sectionID").empty();
    //         $("#byoverallfilter").find("#sectionID").append('<option value="">'+select_subject+'</option>');

    //         $.get(getbysubjectnamesall, { token: token, branch_id: branchID, class_id: class_id }, function (res) {
    //             if (res.code == 200) {
    //                 $("#section_drp_div").show();
    //                 $.each(res.data, function (key, val) {
    //                     $("#byoverallfilter").find("#sectionID").append('<option value="' + val.subject_id + '">' + val.subject_name + '</option>');
    //                 });
    //             }
    //         }, 'json');
    //     }

    // });
    $("#byoverallfilter").validate({
        rules: {
            class_id: "required",
            //  section_id: "required",
            exam_id: "required",
            year: "required"
        }
    });
    $('#byoverallfilter').on('submit', function (e) {
        e.preventDefault();

        var byclass = $("#byoverallfilter").valid();
        if (byclass === true) {

            $("#overlay").fadeIn(300);
            var class_id = $("#changeClassName").val();
            var exam_id = $("#examnames").val();
            var year = $("#btwyears").val();
            var semester_id = $("#semester_id").val();
            var session_id = $("#session_id").val();
            // get overall
            $.post(getoverall, {
                token: token,
                branch_id: branchID,
                exam_id: exam_id,
                class_id: class_id,
                semester_id: semester_id,
                session_id: session_id,
                academic_year: year
            }, function (response) {

                if (response.code == 200) {
                    if (response.data.allbysubject.length > 0) {
                        var datasetnew = response.data;
                        overall_subject(datasetnew);
                        // download set start
                        $("#downExamID").val(exam_id);
                        $("#downClassID").val(class_id);
                        $("#downSemesterID").val(semester_id);
                        $("#downSessionID").val(session_id);
                        $("#downAcademicYear").val(year);
                        // download set end
                        $("#body_content").show();
                        $("#overlay").fadeOut(300);
                    } else {
                        toastr.info('No records are available');
                        $("#overlay").fadeOut(300);
                    }
                } else {
                    toastr.error(data.message);
                    $("#body_content").hide();
                    $("#overlay").fadeOut(300);
                }

            });


        };
    });
    // by overall
    $(document).on('click', '.exportToExcel', function (e) {
        // var table = $(this).prev('.table2excel');
        var table = $('.table2excel');
        if (table && table.length) {
            var preserveColors = (table.hasClass('table2excel_with_colors') ? true : false);
            $(table).table2excel({
                // exclude: ".noExl",
                name: "By Overall",
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

function overall_subject(datasetnew) {
    $('#overall_body').empty();
    var sno = 0;
    var bysubjectAllTable = "";
    var headers = datasetnew.headers;
    var allbysubject = datasetnew.allbysubject;
    bysubjectAllTable += '<div class="table-responsive">' +
        '<table id="tblbycls" class="table w-100 nowrap table-bordered table-striped table2excel" data-tableName="Test Table 1">' +
        '<thead>' +
        '<tr>' +
        '<th class="align-top" rowspan="2">'+sl_no_lang+'</th>' +
        '<th class="align-top" rowspan="2">'+subject_name_lang+'</th>' +
        '<th class="align-top th-sm - 6 rem" rowspan="2">'+total_student_lang+'</th>' +
        '<th class="align-top" rowspan="2">'+absent_lang+'</th>' +
        '<th class="align-top" rowspan="2">'+present_lang+'</th>';
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
            '<label for="clsname">' + res.subject_name + '</label>' +
            '</td>';
        bysubjectAllTable += '<td class="text-left" rowspan="2">' +
            '<label for="clsname">' + res.addAllStudCnt + '</label>' +
            '</td>';
        bysubjectAllTable += '<td class="text-left">' +
            '<label for="clsname">' + res.absentCnt + '</label>' +
            '</td>';
        bysubjectAllTable += '<td class="text-center">' +
            '<label for="stdcount">' + res.presentCnt + '</label>' +
            '</td>';
        headers.forEach(function (resp) {
            var obj = res.gradecnt;
            var exists = isKey(resp.grade, obj); // true
            if (exists) {
                Object.keys(obj).forEach(key => {
                    if (resp.grade == key) {
                        // bysubjectAllTable += '<td class="text-center">' + key, obj[key] + '</td>';
                        bysubjectAllTable += '<td class="text-center">' + obj[key] + '</td>';
                        // bysubjectAllTable += '<td class="text-center">' + key + '</td>';
                    }
                });
            } else {
                bysubjectAllTable += '<td class="text-center">0</td>';
            }
        });
        bysubjectAllTable += '<td class="text-center">' + res.passCnt + '</td>' +
            '<td class="text-center">' + res.failCnt + '</td>' +
            '<td class="text-center" rowspan="2">' + res.gpa + '</td>' +
            '<td class="text-center" rowspan="2">' + res.pass_percentage + '</td>';
        bysubjectAllTable += '</tr>';
        // show another row percentage
        bysubjectAllTable += '<tr>';
        var absentPer = (res.absentCnt / res.addAllStudCnt) * 100;
        absentPer = parseFloat(absentPer, 10).toFixed(2);
        var presentPer = (res.presentCnt / res.addAllStudCnt) * 100;
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
                        var gradepercentage = (obj[key] / res.addAllStudCnt) * 100;
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
    $("#overall_body").append(bysubjectAllTable);
}
// find matched
function isKey(key, obj) {
    var keys = Object.keys(obj).map(function (x) {
        return x;
    });
    return keys.indexOf(key) !== -1;
}