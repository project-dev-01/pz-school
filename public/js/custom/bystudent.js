var globel_gradecount = [];
var reasonChart;
$(function () {

    // change classroom
    $('#changeClassName').on('change', function () {
        var class_id = $(this).val();
        console.log(class_id);
        if (class_id != "All") {
            $("#bystudentfilter").find("#sectionID").empty();
            $("#bystudentfilter").find("#sectionID").append('<option value="">Select Section</option>');

            $.post(sectionByClass, { class_id: class_id }, function (res) {
                if (res.code == 200) {
                    console.log(res);
                    $("#section_drp_div").show();
                    $.each(res.data, function (key, val) {
                        $("#bystudentfilter").find("#sectionID").append('<option value="' + val.section_id + '">' + val.section_name + '</option>');
                    });
                }
            }, 'json');
        }
        else if (class_id == "All") {
            $("#bystudentfilter").find("#examnames").empty();
            $("#bystudentfilter").find("#examnames").append('<option value="">Select Exam</option>');
            $.post(Allexams, { token: token, branch_id: branchID }, function (res) {
                if (res.code == 200) {
                    $("#section_drp_div").hide();
                    $.each(res.data, function (key, val) {
                        $("#bystudentfilter").find("#examnames").append('<option value="' + val.id + '">' + val.name + '</option>');
                    });
                }
            }, 'json');
        }

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
        $.get(examsByclassandsection, {
            token: token,
            branch_id: branchID,
            class_id: class_id,
            section_id: section_id,
            today: today
        }, function (res) {
            if (res.code == 200) {
                $.each(res.data, function (key, val) {
                    var marks = JSON.parse(val.marks);
                    $("#bystudentfilter").find("#examnames").append('<option value="' + val.id + '" data-full="' + marks.full + '" data-pass="' + marks.pass + '">' + val.name + '</option>');
                });
            }
        }, 'json');
    });
    $("#bystudentfilter").validate({
        rules: {
            class_id: "required",
            //  section_id: "required",
            exam_id: "required"
        }
    });
    $('#bystudentfilter').on('submit', function (e) {
        e.preventDefault();
        var byclass = $("#bystudentfilter").valid();
        if (byclass === true) {
            globel_gradecount = [];

            var class_id = $("#changeClassName").val();
            var Selected_classname = $('#changeClassName :selected').text();
            var section_id = $("#sectionID").val();
            var exam_id = $("#examnames").val();
            if (class_id != "All") {
                var fmark = $('option:selected', '#examnames').attr('data-full');
                var pmark = $('option:selected', '#examnames').attr('data-pass');
                $("#fullmark").val(fmark);
                $("#passmark").val(pmark);
                console.log('enterd');
                // list mode
                $.get(getbyStudent, { token: token, branch_id: branchID, exam_id: exam_id, class_id: class_id, section_id: section_id }, function (response) {

                    if (response.code == 200) {
                        if (response.data.length > 0) {
                            var datasetnew = response.data;
                            bystudentdetails_class(datasetnew);
                            console.log(datasetnew);

                            //byclass_chart(class_id, section_id, exam_id);
                            console.log('end');
                        } else {

                            toastr.info('No records are available');
                        }
                    } else {
                        toastr.error(data.message);
                    }

                });
            }
            else if (class_id == "All") {
                $.get(getbySubjectAllstd, { token: token, branch_id: branchID, exam_id: exam_id }, function (response) {

                    if (response.code == 200) {
                        console.log(response.data);
                        if (response.data.length > 0) {
                            var datasetnew = response.data;
                            bysubjectdetails_all(datasetnew);


                        } else {

                            toastr.info('No records are available');
                        }
                    } else {
                        toastr.error(data.message);
                    }

                });
            }

        };
    });


});


function bystudentdetails_class(datasetnew) {
    $('#bystudent_header').empty();
    $('#bystudent_body').empty();
    var sno = 0;
    var sno_bdy = 0;
    var sno_bdy_main = 0;
    var subject_name_header = "";
    var bysubjectAllTable = "";
    console.log(datasetnew);
    // header start 
    datasetnew.forEach(function (res) {
        sno++;
        if (sno === 1) {
            console.log(res.total_subject_count);
            var headercount = res.total_subject_count * 2;
            console.log(headercount);
            subject_name_header += '<tr>' +
                '<th class="align-middle" rowspan="3">S.no.</th>' +
                '<th class="align-middle" rowspan="3">Student Name</th>' +
                '<th class="text-center" colspan="' + headercount + '">Subject Name</th>' +
                '</tr>';
            subject_name_header += '<tr>';
            var subject_headers = res.sub_header;
            console.log(subject_headers);
            var split_subnam = subject_headers.subject_name;
            console.log(split_subnam);
            let subject_names = split_subnam.split(',');
            console.log(subject_names);
            subject_names.forEach(function (sub_name) {
                subject_name_header += '<th colspan="2" class="align-top" data-id="' + sub_name + '">' + sub_name + '</th>';
            });
            subject_name_header += '</tr>';
            subject_name_header += '<tr>';
            subject_names.forEach(function (snm) {
                subject_name_header += '  <th class="align-top">Mark</th>' +
                    '<th class="align-top">Grade</th>';
            });

        }

    });
    subject_name_header += '</tr>';
    $('#bystudent_header').append(subject_name_header);

    // body tag start 
    var globel_subjectname;
    datasetnew.forEach(function (response) {
        //console.log(response);
        sno_bdy++;

        if (sno_bdy > 1) {
            var total_subject_count = response.total_subject_count;
            //console.log(sno_bdy);
            var marks_grade = response.both_exam_marksgrade;

            //console.log(marks_grade);
            // std count and names
            marks_grade.forEach(function (mg) {
            //    console.log(mg.student_id);
                //if (mg.student_id > 0) {
                sno_bdy_main++;
                bysubjectAllTable += '<tr>' +
                    '<td class="text-center">';
                bysubjectAllTable += sno_bdy_main +
                    '</td>';
                bysubjectAllTable += '<td class="text-left">' + mg.first_name + '</td>';
                var split_subnam = mg.scoremarks;
                let arr = split_subnam.split(',');
                //console.log(arr);
                arr.forEach(function (sbnam) {
                  //  console.log(sbnam);
                        bysubjectAllTable += '<td class="align-top">' + sbnam + '</td>' ;
                                      
                });
               // console.log('loop exit');
                // '<td class="align-top">' + mg.score + '</td>' +
                // '<td class="align-top">' + mg.grade + '</td>'+

                bysubjectAllTable += '</tr>';
          
            });
        }
    });
    $("#bystudent_body").append(bysubjectAllTable);
}



