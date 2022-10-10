var reasonChart;
$(function () {
    // $('#bystudent_bodycontent').hide();
    // $('#bystudent_analysis').hide();
    // change classroom
    $('#changeClassName').on('change', function () {
        var class_id = $(this).val();
        $("#bystudentfilter").find("#sectionID").empty();
        $("#bystudentfilter").find("#sectionID").append('<option value="">Select Section</option>');
        $("#bystudentfilter").find("#examnames").empty();
        $("#bystudentfilter").find("#examnames").append('<option value="">Select Exam</option>');
        $.post(sectionByClass, { token: token, branch_id: branchID, class_id: class_id, teacher_id: teacher_id }, function (res) {
            if (res.code == 200) {
                $.each(res.data, function (key, val) {
                    $("#bystudentfilter").find("#sectionID").append('<option value="' + val.section_id + '">' + val.section_name + '</option>');
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
        $("#bystudentfilter").find("#examnames").empty();
        $("#bystudentfilter").find("#examnames").append('<option value="">Select exams</option>');
        $.post(examsByclassandsection, {
            token: token,
            branch_id: branchID,
            class_id: class_id,
            section_id: section_id,
            today: today
        }, function (res) {
            if (res.code == 200) {
                $.each(res.data, function (key, val) {
                    $("#bystudentfilter").find("#examnames").append('<option value="' + val.id + '">' + val.name + '</option>');
                });
            }
        }, 'json');
    });
    $("#bystudentfilter").validate({
        rules: {
            class_id: "required",
            section_id: "required",
            exam_id: "required"
        }
    });
    $('#bystudentfilter').on('submit', function (e) {
        e.preventDefault();
        var byclass = $("#bystudentfilter").valid();
        if (byclass === true) {
            $("#overlay").fadeIn(300);
            $("#bystudent_body").show("slow");
            var class_id = $("#changeClassName").val();
            var section_id = $("#sectionID").val();
            var exam_id = $("#examnames").val();

            $.post(getbyStudent, {
                token: token,
                branch_id: branchID,
                exam_id: exam_id,
                class_id: class_id,
                section_id: section_id
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
        '<th class="align-top" rowspan="3" style="padding-top:72px;">S.no.</th>' +
        '<th class="align-top" rowspan="3" style="padding: 71px 0px 0px 8px;">Student Name</th>' +
        '<th class="text-center" colspan="' + headercount + '" style="padding: 20px 100px 20px 0px;">Subject Name</th>' +
        '</tr>';
    bysubjectAllTable += '<tr>';
    headers.forEach(function (resp) {
        bysubjectAllTable += '<th colspan="2" class="text-center" style="padding:7px 0px 7px 0px;">' + resp.subject_name + '</th>';
    });
    bysubjectAllTable += '</tr>';
    bysubjectAllTable += '<tr>';
    headers.forEach(function (resp) {
        bysubjectAllTable += ' <th class="text-center">Mark</th>' +
            '<th class="text-center">Grade</th>';
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
                bysubjectAllTable += '<td class="text-center" style="padding:7px 0px 7px 0px;">' + marksArr[index].marks + '</td>';
                bysubjectAllTable += '<td class="text-center" style="padding:7px 0px 7px 0px;">' + marksArr[index].grade + '</td>';
            } else {
                bysubjectAllTable += '<td class="text-center" style="padding:7px 0px 7px 0px;">-</td>';
                bysubjectAllTable += '<td class="text-center" style="padding:7px 0px 7px 0px;">-</td>';
            }
        });
        bysubjectAllTable += '</tr>';

    });

    bysubjectAllTable += '</tbody></table>' +
        '</div>';
    $("#byStudentTableAppend").append(bysubjectAllTable);
}