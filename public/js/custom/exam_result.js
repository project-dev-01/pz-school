$(function () {
    // change classroom
    $('#changeClassName').on('change', function () {
        var class_id = $(this).val();
        console.log(class_id);

        $("#byexamfilter").find("#sectionID").empty();
        $("#byexamfilter").find("#sectionID").append('<option value="">Select Class</option>');
        $("#byexamfilter").find("#examnames").empty();
        $("#byexamfilter").find("#examnames").append('<option value="">Select Exams</option>');

        $.post(sectionByClass, { token: token, branch_id: branchID, class_id: class_id, teacher_id: teacher_id }, function (res) {
            if (res.code == 200) {
                $("#section_drp_div").show();
                $.each(res.data, function (key, val) {
                    $("#byexamfilter").find("#sectionID").append('<option value="' + val.section_id + '">' + val.section_name + '</option>');
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
        $("#byexamfilter").find("#examnames").empty();
        $("#byexamfilter").find("#examnames").append('<option value="">Select exams</option>');
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
                    $("#byexamfilter").find("#examnames").append('<option value="' + val.id + '">' + val.name + '</option>');
                });
            }
        }, 'json');
    });
    $("#byexamfilter").validate({
        rules: {
            year: "required",
            class_id: "required",
            section_id: "required",
            exam_id: "required",
            registerno: "required"
        }
    });
    $('#byexamfilter').on('submit', function (e) {
        e.preventDefault();
        var byresult = $("#byexamfilter").valid();
        if (byresult === true) {
            $("#overlay").fadeIn(300);
            globel_gradecount = [];

            var class_id = $("#changeClassName").val();
            var class_name = $('#changeClassName :selected').text();
            var section_id = $("#sectionID").val();
            var exam_id = $("#examnames").val();
            var registerno = $("#registerno").val();
            var year = $("#btwyears").val();
            var semester_id = $("#semester_id").val();
            var session_id = $("#session_id").val();
            console.log(class_name);
            // list mode            
            var formData = new FormData();
            formData.append('token', token);
            formData.append('branch_id', branchID);
            formData.append('exam_id', exam_id);
            formData.append('class_id', class_id);
            formData.append('section_id', section_id);
            formData.append('registerno', registerno);
            formData.append('academic_year', year);
            formData.append('semester_id', semester_id);
            formData.append('session_id', session_id);

            $.ajax({
                url: getbyresult,
                method: "POST",
                data: formData,
                processData: false,
                dataType: 'json',
                contentType: false,
                success: function (response) {
                    if (response.code == 200) {
                        if (response.data.allbyStudent.length > 0) {
                            var datasetnew = response.data;
                            examresult_details(datasetnew);
                            $("#overlay").fadeOut(300);
                            $('#exam_details_div').show();
                        } else {
                            $('#byStudentTableAppend').empty();
                            $('#byStudentGeneralDetails').empty();
                            $('#exam_details_div').hide();
                            $("#overlay").fadeOut(300);
                            toastr.info('No records are available');
                        }
                    } else {
                        toastr.error(data.message);
                    }
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
function examresult_details(datasetnew) {

    $('#byStudentTableAppend').empty();
    $('#byStudentGeneralDetails').empty();
    var sno = 0;
    var bysubjectAllTable = "";
    var byStudGenDetails = "";
    var headers = datasetnew.headers;
    var headercount = datasetnew.headers.length;
    headercount = headercount * 2;
    var grade_list_master = datasetnew.allbyStudent;
    var student_details = datasetnew.student_details;
    // append student details start
    byStudGenDetails += '<div class="table-responsive">' +
        '<table  class="table table-bordered mb-0" id="tbl_general_details">' +
        '<thead>';
    byStudGenDetails += '<tr>' +
        '<th>Roll No</th>' +
        '<td>' + student_details.register_no + '</td>' +
        '</tr>';
    byStudGenDetails += '<tr>' +
        '<th>Name</th>' +
        '<td>' + student_details.student_name + '</td>' +
        '</tr>';
    byStudGenDetails += '<tr>' +
        '<th>DOB</th>' +
        '<td>' + student_details.birthday + '</td>' +
        '</tr>';
    byStudGenDetails += '<tr>' +
        '<th>Standard</th>' +
        '<td>' + student_details.class_name + '</td>' +
        '</tr>';
    byStudGenDetails += '<tr>' +
        '<th>Class Name</th>' +
        '<td>' + student_details.section_name + '</td>' +
        '</tr>';
    byStudGenDetails += '</thead></table>' +
        '</div>';
    $("#byStudentGeneralDetails").append(byStudGenDetails);
    // append student details end
    bysubjectAllTable += '<div class="table-responsive">' +
        '<table class="table w-100 nowrap table-bordered table-striped table2excel">' +
        '<thead>';
    bysubjectAllTable += '<tr>' +
        '<th>S.no.</th>' +
        '<th>Student Name</th>';
    headers.forEach(function (resps) {
        bysubjectAllTable += '<th>' + resps.subject_name + '</th>';
    });
    bysubjectAllTable += '</tr>';
    bysubjectAllTable += '</thead><tbody>';
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
                bysubjectAllTable += '<td class="text-center">' + marksArr[index].grade + '</td>';
            } else {
                bysubjectAllTable += '<td class="text-center">-</td>';
            }
        });
        bysubjectAllTable += '</tr>';
    });
    bysubjectAllTable += '</tbody></table>' +
        '</div>';
    $("#byStudentTableAppend").append(bysubjectAllTable);
}


