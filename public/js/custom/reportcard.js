$(function () {
    $("#reportcart_filter").validate({
        rules: {
            exam_id: "required"
        }
    });
    $('#reportcart_filter').on('submit', function (e) {
        e.preventDefault();
        var byclass = $("#reportcart_filter").valid();
        if (byclass === true) {
            $("#overlay").fadeIn(300);
            var student_id = null;
            // it come only parent and student
            if (studentID) {
                student_id = studentID;
            } else {
                student_id = ref_user_id;
            }
            var exam_id = $("#examnames").val();
            $.post(getbyreportcard, {
                token: token,
                branch_id: branchID,
                exam_id: exam_id,
                student_id: student_id
            }, function (response) {

                if (response.code == 200) {
                    if (response.data.allbyStudent.length > 0) {
                        var datasetnew = response.data;
                        bystudentdetails_class(datasetnew);
                        $('#bystudent_bodycontent').show();
                        $("#overlay").fadeOut(300);
                    } else {
                        $("#overlay").fadeOut(300);
                        toastr.info('No records are available');
                    }
                } else {
                    toastr.error(data.message);
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
                name: "By Student",
                filename: "by_student" + new Date().toISOString().replace(/[\-\:\.]/g, "") + ".xls",
                fileext: ".xls",
                exclude_img: true,
                exclude_links: true,
                exclude_inputs: true,
                preserveColors: preserveColors
            });
        }
    });

});

function bystudentdetails_class(datasetnew) {
    $('#byStudentTableAppend').empty();
    var sno = 0;
    var bysubjectAllTable = "";
    var headers = datasetnew.headers;
    var headercount = datasetnew.headers.length;
    headercount = headercount * 2;
    console.log(headercount);
    var grade_list_master = datasetnew.allbyStudent;
    bysubjectAllTable += '<div class="table-responsive">' +
        '<table id="tblbycls" class="table w-100 nowrap table-bordered table-striped table2excel" data-tableName="Test Table 1">' +
        '<thead>';
    bysubjectAllTable += '<tr>' +
        '<th class="align-top" rowspan="3">'+sl_no_lang+'</th>' +
        '<th class="align-top" rowspan="3">'+student_name_lang+'</th>' +
        '<th class="text-center" colspan="' + headercount + '">'+subject_name_lang+'</th>' +
        '</tr>';
    bysubjectAllTable += '<tr>';
    headers.forEach(function (resp) {
        bysubjectAllTable += '<th colspan="2" class="text-center">' + resp.subject_name + '</th>';
    });
    bysubjectAllTable += '</tr>';
    bysubjectAllTable += '<tr>';
    headers.forEach(function (resp) {
        bysubjectAllTable += ' <th class="text-center">'+mark_lang+'</th>' +
            '<th class="text-center">'+grade_lang+'</th>';
    });
    bysubjectAllTable += '</tr></thead><tbody>';
    grade_list_master.forEach(function (res) {
        sno++;
        bysubjectAllTable += '<tr>' +
            '<td class="text-center">';
        bysubjectAllTable += sno +
            '</td>';
        bysubjectAllTable += '<td class="text-left">' + res.student_name + '</td>';
        headers.forEach(function (resp) {
            // header subject id
            var subject_id = resp.subject_id;
            //subject array
            var marksArr = res.student_class;
            // here find index of array
            var index = marksArr.findIndex(x => x.subject_id === subject_id);
            if (index !== -1) {
                bysubjectAllTable += '<td class="text-center">' + marksArr[index].marks + '</td>';
                bysubjectAllTable += '<td class="text-center">' + marksArr[index].grade + '</td>';
            } else {
                bysubjectAllTable += '<td class="text-center">-</td>';
                bysubjectAllTable += '<td class="text-center">-</td>';
            }
        });
        bysubjectAllTable += '</tr>';

    });

    bysubjectAllTable += '</tbody></table>' +
        '</div>';
    $("#byStudentTableAppend").append(bysubjectAllTable);
}